<?php

class UploadController extends Controller {

    public function actionSendEmail() {
        Yii::import('application.modules.user.UserModule');
        $email = urldecode($_POST['email']);
        $subject = urldecode($_POST['subject']);
        $message = urldecode($_POST['message']);
        if ($email) {
            UserModule::sendMail($email, $subject, $message);
        }
    }

    public function filters() {
        return array(
        );
    }

    //登录验证 (此方法放在UploadController中)
    public function actionLogincheck() {
        Yii::import('application.modules.user.UserModule');
        Yii::import('application.modules.pap.services.DefaultService');
        $time = $_SERVER['REQUEST_TIME'];
        //$organID = Yii::app()->user->getOrganID(); 获取不到
        $organID = isset($_GET['OrganID']) ? $_GET['OrganID'] : '0';
        $UserID = isset($_GET['UserID']) ? $_GET['UserID'] : '0';
        //$username = Yii::app()->user->getState('userName');
        $username = isset($_GET['username']) ? $_GET['username'] : '0';
        $ip = isset($_GET['ip']) ? $_GET['ip'] : '127.0.0.1';
        $ipnum = sprintf("%u", ip2long($ip));
        //登陆地
        $loginaddrsql = ' select Province,City from jpd_ip where ' . $ipnum . ' between inet_aton(beginip) and inet_aton(endip)';
        $loginaddrres = Yii::app()->jpdb->createCommand($loginaddrsql)->queryRow();
        if (!$loginaddrres) {
            //系统未录入ip对应的地址
            $remind = '用户 ' . $username . ' 于 ' . date('Y-m-d H:i', $time) . ' 异常登陆';
            $warn = '用户 ' . $username . ' 于 ' . date('Y-m-d H:i', $time) . ' 异常登陆,登录IP为: ' . $ip . '，此ip在嘉配ip库中无记录。';
        } else {
            //判断用户是否在允许地登陆
            $allowloginsql = ' select ID from jpd_login_address where OrganID=' . $organID . ' and Province=' . $loginaddrres['Province'] . ' and (City=' . $loginaddrres['City'] . ' or City=0 or ' . $loginaddrres['City'] . '=0)';
            $allowloginres = Yii::app()->jpdb->createCommand($allowloginsql)->queryRow();
            if ($allowloginres) {
                //用户在允许登陆地登陆
                return;
            } else {
                //用户不在允许登陆地登陆，判断是否位于危险省份
                //用户当前登陆地址
                $loginaddr = Area::getCity($loginaddrres['Province']) . Area::getCity($loginaddrres['City']);
                $risksql = 'select ID from jpd_risk_area where Province=' . $loginaddrres['Province'] . ' and (City=' . $loginaddrres['City'] . ' or City=0)';
                $riskres = Yii::app()->jpdb->createCommand($risksql)->queryRow();
                //获取机构信息
                $organsql = 'select Province,City,Area,Address from jpd_organ where ID=' . $organID;
                $organres = Yii::app()->jpdb->createCommand($organsql)->queryRow();
                $organaddr = Area::getCity($organres['Province']) . Area::getCity($organres['City']) . Area::getCity($organres['Area']) . $organres['Address'];
                if ($riskres) {
                    //用户在危险地区登陆
                    $remind = '用户 ' . $username . ' 于 ' . date('Y-m-d H:i', $time) . ' 异常登陆';
                    $warn = '用户 ' . $username . ' 于 ' . date('Y-m-d H:i', $time) . ' 在 ' . $loginaddr . ' 登陆(该地址属于警告地址),该账号所属机构地址为： ' . $organaddr;
                } else {
                    //用户不在危险地区登陆
                    $remind = '用户 ' . $username . ' 于 ' . date('Y-m-d H:i', $time) . ' 异常登陆';
                    $warn = '用户 ' . $username . ' 于 ' . date('Y-m-d H:i', $time) . ' 在 ' . $loginaddr . ' 登陆,该账号所属机构地址为： ' . $organaddr;
                }
            }
        }
        $params['organID'] = $organID;
        $params['UserID'] = $UserID;
        $params['subject'] = '由你配用户异常登陆提醒';
        $params['remind'] = $remind;
        $params['warn'] = $warn;
        DefaultService::sendwarnemail($params);
    }

    //用户配额操作异常处理
    public function actionQuota() {
        Yii::import('application.modules.user.UserModule');
        Yii::import('application.modules.pap.services.DefaultService');
        $t = $_SERVER['REQUEST_TIME'];
        if ($_GET['Handle'] == 'adddefault') {
            $params['organID'] = 0;
            $params['UserID'] = 0;
            $params['subject'] = '由你配系统默认参数未设置提醒';
            $remind = '由你配系统默认配额提醒百分比设置,已添加默认值为: ' . $_GET['Default'] . '。系统参数类别为:system，key名为:QuotaRemind';
            $params['remind'] = $remind;
            $params['warn'] = $remind;
            DefaultService::sendwarnemail($params);
            die;
        }
        $params['organID'] = isset($_GET['OrganID']) ? $_GET['OrganID'] : '0';
        $params['UserID'] = isset($_GET['UserID']) ? $_GET['UserID'] : '0';
        $time = isset($_GET['Time']) ? $_GET['Time'] : '100';
        $username = isset($_GET['username']) ? $_GET['username'] : '0';
        $route = isset($_GET['Route']) ? str_replace('-', '/', $_GET['Route']) : 'fail url';
        $params['subject'] = '由你配用户操作配额异常提醒';
        $remind = '用户 ' . $username . ' 于 ' . date('Y-m-d H:i:s', $t) . ' 操作配额异常';
        $warn = '用户 ' . $username . ' 于 ' . date('Y-m-d H:i:s', $t) . ' 在 ' . $route . ' 操作配额异常' . '。当前操作次数为' . $time . '次';
        $params['remind'] = $remind;
        $params['warn'] = $warn;
        DefaultService::sendwarnemail($params);
    }

    // 处理上传的图片
    public function actionUploadify() {
        $organID = $_POST['fileClass'];
        $add = $_POST['add'];
        $role = $_POST['role'] ? $_POST['role'] : 0;
        if (!empty($_FILES)) {
            $fileNames = $_FILES['Filedata']['name'];
            //复制文件到目的地址
            $ImgName = $fileNames;
            $file_path = pathinfo($fileNames);      // 获取文件信息
            $aa = explode('#', $file_path ['filename']); // 不含后缀名文件 $file_path ['filename']
            $GoodsNO = $aa[0];
            $fileName = $this->getRandomName($fileNames);
            if ($add == '1') {
                $data = $this->getGoodsName($GoodsNO, $organID, $role);
                if (!$data) {
                    $rs = array('code' => 150, 'msg' => '上传失败！' . $ImgName . '找不到对应商品');
                    echo json_encode($rs);
                    exit;
                }
                $GoodsName = $data['Name'];
                $GoodsID = $data['ID'];
            }
            if ($role == 'second') {
                $afileDir = "dealer/" . $organID . '/goods/small/';
                $bfileDir = "dealer/" . $organID . '/goods/normal/';
                $mfileDir = "dealer/" . $organID . '/goods/thumb/';
            } else if ($role == 'first') {
                $fileDir = "maker/images/" . $organID . '/';
            } else if ($role == 'inquiryupload') {
                $fileDir = "servicer/images/inquiry/" . $organID . '/';
            } else if ($role == 1) {
                $fileDir = "maker/" . $organID . '/';
            } else if ($role == 2) {
                $fileDir = "dealer/" . $organID . '/';
            } else if ($role == 3) {
                $fileDir = "servicer/" . $organID . '/';
            }

            $afilePath = Yii::app()->params['uploadPath'] . 'tmp/' . $afileDir;
            $bfilePath = Yii::app()->params['uploadPath'] . 'tmp/' . $bfileDir;
            $mfilePath = Yii::app()->params['uploadPath'] . 'tmp/' . $mfileDir;
            if (!file_exists($afilePath)) {
                mkdir($afilePath, 0777, true);
                chmod($afilePath, 0777);
            }
            if (!file_exists($bfilePath)) {
                mkdir($bfilePath, 0777, true);
                chmod($bfilePath, 0777);
            }
            if (!file_exists($mfilePath)) {
                mkdir($mfilePath, 0777, true);
                chmod($mfilePath, 0777);
            }

            $targetFile = $bfilePath . 'A' . $fileName;
            //var_dump($targetFile);
            $imgurlname = $bfileDir . 'A' . $fileName;       // 新文件名
            $newimgname = $afileDir . 'A' . $fileName; //缩放后的文件名
            $mimgname = $mfileDir . 'A' . $fileName; //缩略小图的文件名
//            $bimgname = $fileDir . 'B' . $fileName; //原图的文件名

            $tmpfile = $_FILES['Filedata']['tmp_name'];
            if ($role == 'second') {
                $sql = "select * from {{dealer_goods_image_relation}} where OrganID=" . $organID . " and ImageName='" . $ImgName . "'";
            } else if ($role == 'first') {
                $sql = "select * from {{make_goods_image_relation}} where OrganID=" . $organID . " and ImageName='" . $ImgName . "'";
            }

            $datas = DBUtil::query($sql);
            if ($add == '0') {
                $datas = 0;
            }
            if (!$datas) {
                @move_uploaded_file($tmpfile, $targetFile);
                //定义缩略图名称
                $newfile = $afilePath . 'A' . $fileName;
                $mnewfile = $mfilePath . 'A' . $fileName;
                $bnewfile = $bfilePath . 'A' . $fileName;
                //定义缩略图尺寸
                $width = 350;
                $height = 350;

                $mwidth = 80;
                $mheight = 80;



                //获得原图相关信息
                $arr = getimagesize($targetFile);
                $ratio_orig = $arr[0] / $arr[1];
                //生成一个缩略图资源
                $thumb = ImageCreateTrueColor($width, $height);

                $mthumb = ImageCreateTrueColor($mwidth, $mheight);
                //图片尺寸的缩放
                if ($width / $height > $ratio_orig) {
                    $width = $height * $ratio_orig;
                    $x = (350 - $width) / 2;
                    $y = 0;
                } else {
                    $height = $width / $ratio_orig;
                    $x = 0;
                    $y = (350 - $height) / 2;
                }

                if ($mwidth / $mheight > $ratio_orig) {
                    $mwidth = $mheight * $ratio_orig;
                    $mx = (80 - $mwidth) / 2;
                    $my = 0;
                } else {
                    $mheight = $mwidth / $ratio_orig;
                    $mx = 0;
                    $my = (80 - $mheight) / 2;
                }
                //分配一个白色
                $color = imagecolorAllocate($thumb, 255, 255, 255);
                $mcolor = imagecolorAllocate($mthumb, 255, 255, 255);
                //将缩略图资源填充颜色
                imagefill($thumb, 0, 0, $color);
                imagefill($mthumb, 0, 0, $mcolor);
                // 1 为 GIF 格式、 2 为 JPEG/JPG 格式、3 为 PNG 格式
                //获得原图的资源
                if ($arr[2] == 1) {
                    $image = imagecreatefromgif($targetFile);
                } else if ($arr[2] == 3) {
                    $image = imagecreatefrompng($targetFile);
                } else if ($arr[2] == 2) {
                    $image = imagecreatefromjpeg($targetFile);
                }
                if ($arr[2] == 1) {
                    $mimage = imagecreatefromgif($targetFile);
                } else if ($arr[2] == 3) {
                    $mimage = imagecreatefrompng($targetFile);
                } else if ($arr[2] == 2) {
                    $mimage = imagecreatefromjpeg($targetFile);
                }
                //将原图生成缩略图资源
                imagecopyresized($thumb, $image, $x, $y, 0, 0, $width, $height, $arr[0], $arr[1]);
                imagecopyresized($mthumb, $mimage, $mx, $my, 0, 0, $mwidth, $mheight, $arr[0], $arr[1]);
                //将缩略图资源生成图片
                if ($arr[2] == 1) {
                    imagegif($thumb, $newfile);
                } else if ($arr[2] == 3) {
                    imagepng($thumb, $newfile);
                } else if ($arr[2] == 2) {
                    imagejpeg($thumb, $newfile);
                }
                if ($arr[2] == 1) {
                    imagegif($mthumb, $mnewfile);
                } else if ($arr[2] == 3) {
                    imagepng($mthumb, $mnewfile);
                } else if ($arr[2] == 2) {
                    imagejpeg($mthumb, $mnewfile);
                }
                $ftp = new Ftp();
                $ftp->uploadfile($mnewfile, $mimgname);
                $ftp->uploadfile($bnewfile, $imgurlname);
                $res = $ftp->uploadfile($newfile, $newimgname);
                $ftp->close();
                if ($res['success']) {
                    //删除本地文件                  
                    @unlink($targetFile);
                    @unlink($newfile);
                    @unlink($mnewfile);
                    if ($add == '1') {
//                    $rs = array('code' => 200, 'filename' => $newimgname, 'GoodsNO' => $GoodsNO, 'ImgName' => $ImgName, 'GoodsName' => $GoodsName, 'GoodsID' => $GoodsID, 'msg' => '上传成功！');
                    } else {
                        $rs = array('code' => 200, 'filename' => $newimgname, 'ftpfileurl' => $res['url'], 'ImgName' => $ImgName, 'msg' => '上传成功');
                    }
                }
            } else {
                $rs = array('code' => 100, 'msg' => '上传失败！' . $ImgName . '已经上传');
                echo json_encode($rs);
                exit;
            }
        } else {
            $rs = array('code' => 100, 'msg' => '上传失败！');
        }
        echo json_encode($rs);
    }

    //获得商品名称
    function getGoodsName($GoodsNO, $organID, $role) {
        if ($role == 'second') {
            $sql = "select ID,Name from {{dealer_goods}} where OrganID=" . $organID . " and GoodsNO='" . $GoodsNO . "'";
        } else if ($role == 'first') {
            $sql = "select a.goods_ID as ID,a.goods_name as Name from tbl_make_goods_version as a,tbl_make_goods as b where a.OrganID=" . $organID . " and a.goods_no='" . $GoodsNO . "'and b.ISdelete=0 and b.NewVersion = a.version_name and b.id=a.goods_id";
        }
        $data = DBUtil::query($sql) ? DBUtil::query($sql) : 0;
        return $data;
    }

    //生成图片名称
    function getRandomName($filename) {

        $pos = strrpos($filename, ".");
        $fileExt = strtolower(substr($filename, $pos));
        //ini_set('date.timezone', 'Asia/Shanghai');
        $t = getdate();
        $year = $t[year];
        $mon = $t[mon] > 10 ? $t[mon] : "0" . $t[mon];
        $day = $t[mday] > 10 ? $t[mday] : "0" . $t[mday];
        $hours = $t[hours] > 10 ? $t[hours] : "0" . $t[hours];
        $minutes = $t[minutes] > 10 ? $t[minutes] : "0" . $t[minutes];
        $seconds = $t[seconds] > 10 ? $t[seconds] : "0" . $t[seconds];
        return $year . $mon . $day . $hours . $minutes . $seconds . rand(1000, 9999) . $fileExt;
    }

    //上传附件
    public function actionFtpUpload() {
        $path = $_POST['path'];
        if (!empty($_FILES)) {
            $oldfileName = $_FILES['Filedata']['name'];
            $filesize = $_FILES['Filedata']['size'];
            $fileName = $this->getRandomName($oldfileName);
            $tmpFile = $_FILES['Filedata']['tmp_name']; //缓存文件路径
            //上传文件临时保存路径
            $tmpsavepath = Yii::app()->params['uploadPath'] . 'tmp/';
            if (!file_exists($tmpsavepath)) {
                if (!@mkdir($tmpsavepath, 0777, true)) {
                    echo json_encode(array('code' => 0, 'msg' => '临时保存目录创建失败 - ' . $tmpsavepath));
                    die;
                } else {
                    chmod($tmpsavepath, 0777);
                }
            }
            //检查目录写权限
            if (@is_writable($tmpsavepath) === false) {
                echo json_encode(array('code' => 0, 'msg' => '临时保存目录没有写权限 - ' . $tmpsavepath));
                die;
            }
            //检查文件大小
            $max_size = 2 * 1024 * 1024;   //2M
            if ($filesize > $max_size) {
                echo json_encode(array('code' => 0, 'msg' => '上传文件大小超过限制,不允许超过2M '));
                die;
            }
            $tmpsavefile = $tmpsavepath . basename($tmpFile);
            if (@move_uploaded_file($tmpFile, $tmpsavefile) === false) {
                echo json_encode(array('code' => 0, 'msg' => '文件保存失败 - ' . $tmpsavefile));
                die;
            }
            $fileurl = $path . $fileName;            // 新文件名
            $ftp = new Ftp();
            $res = $ftp->uploadfile($tmpsavefile, $fileurl);
            $ftp->close();
            if ($res['success']) {
                @unlink($tmpsavefile);   //删除临时文件
                echo json_encode(array('code' => 200, 'fileurl' => $fileurl, 'ftpfileurl' => $res['url'], 'filename' => $oldfileName, 'msg' => '上传成功！'));
            } else {
                echo json_encode(array('code' => 0, 'msg' => $res['msg']));
            }
        } else {
            echo json_encode(array('code' => 0, 'msg' => '请选择文件！'));
        }
    }

    //ftp附件下载
    public function actionFtpDownload() {
        if (Yii::app()->user->isGuest) {
            echo json_encode(array('res' => 0, 'msg' => '请先登录'));
            die;
        }
        $fileurl = Yii::app()->request->getParam('fileurl');
        $filename = Yii::app()->request->getParam('filename');
        if ($fileurl) {
            $res = Ftp::down($fileurl, $filename);
            if ($res['success'] === false) {
                echo json_encode(array('res' => 0, 'msg' => $res['msg']));
            }
        } else {
            echo json_encode(array('res' => 0, 'msg' => '文件路径不能为空'));
        }
    }

    //ftp删除已上传附件
    public function actionFtpDelfile() {
        if (Yii::app()->user->isGuest) {
            echo json_encode(array('res' => 0, 'msg' => '请先登录'));
            die;
        }
        if (Yii::app()->request->isAjaxRequest) {
            $path = Yii::app()->request->getParam('path');
            $ftp = new Ftp();
            $res = $ftp->delete_file($path);
            $ftp->close();
            if ($res['success']) {
                echo json_encode(array('res' => 1));
            } else {
                echo json_encode(array('res' => 0));
            }
        }
    }

}

?>
