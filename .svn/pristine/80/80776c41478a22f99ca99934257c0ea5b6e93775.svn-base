<?php

class ChatController extends Controller {

    //public $layout = '//layouts/column2';


    public function filters() {
        return array(
        );
    }

    //获取用户信息
    public function actionGetinfo() {
        $sid = Yii::app()->request->getParam("sid");
        $rs = Yii::app()->cache->get('Yii.CCacheHttpSession.' . $sid);
        $rs = explode(";", $rs);
        foreach ($rs as $val) {
            $cval = explode("|", $val);
            $data[$cval[0]] = unserialize($cval[1]);
        }
        echo json_encode($data);
    }

    //获取用户sessionID
    public function actionGetSessionid() {
        $params['userid'] = Yii::app()->request->getParam('userid');
        $params['touserid'] = Yii::app()->request->getParam('touserid');
        $params['notsave'] = Yii::app()->request->getParam('status');
        echo json_encode(RemindService::checkSID($params));
    }

    //聊天消息 chatsession
    public function actionChatsession() {
        $params['userid'] = Yii::app()->request->getParam('userid');
        $params['touserid'] = Yii::app()->request->getParam('touserid');
        $params['sessionid'] = Yii::app()->request->getParam('sessionid');
        $params['hasnew'] = Yii::app()->request->getParam('hasnew');
        $chat = RemindService::chat_session($params);
        echo json_encode($chat);
    }

    //聊天消息记录表
    public function actionSaverecord() {
        $params['sessionid'] = Yii::app()->request->getParam('sessionid');
        $params['userid'] = Yii::app()->request->getParam('userid');
        $params['touserid'] = Yii::app()->request->getParam('touserid');
        $params['imgsrc'] = Yii::app()->request->getParam('imgsrc');
        $params['time'] = Yii::app()->request->getParam('time');
        $params['msg'] = Yii::app()->request->getParam('msg');
        $params['ftype'] = Yii::app()->request->getParam('ftype');
        $params['fname'] = Yii::app()->request->getParam('fname');
        $params['isread'] = Yii::app()->request->getParam('isread');
//        var_dump($params);exit;
        $record = RemindService::saveRecord($params);
        echo json_encode($record);
    }

    //聊天消息 获取sessionid
    public function actionGetchat() {
        $userid = Yii::app()->request->getParam('userid');
        $rs = Yii::app()->chatmongodb->getDbInstance()->chat_sessions->find(array("userid" => $userid));
        foreach ($rs as $ks => $v) {
            $data[$ks] = $v['sessionid'];
        }
        echo json_encode($data);
    }

    public function actionGetoldmessage() {
        $userid = Yii::app()->request->getParam('userid');
        $result = Yii::app()->chatmongodb->getDbInstance()->record->find(array("touserid" => $userid, "isread" => "false"));
        $data = array();
        foreach ($result as $rs) {
            $data[] = $rs;
        }
        echo json_encode($data);
    }

    public function actionChangeoldmessage() {
        $userid = Yii::app()->request->getParam('userid');
        $result = Yii::app()->chatmongodb->getDbInstance()->record->update(array("touserid" => $userid, "isread" => "false"), array('$set' => array('isread' => "true")), array('multiple' => true));
    }

    public function actionUploadFile() {
        $path = $_POST['path'];
        if (!empty($_FILES)) {
            $oldfileName = $_FILES['Filedata']['name'];
            $ext = substr($oldfileName, strrpos($oldfileName, ".") + 1);
            $filesize = $_FILES['Filedata']['size']; //上传文件大小
            $fileName = $this->getRandomName($oldfileName);
            $tmpFile = $_FILES['Filedata']['tmp_name']; //缓存文件路径
            //$type = $_FILES['Filedata']['type']; //上传文件类型
            $tp = array('gif', 'jpg', 'png', 'bmp', 'jpeg', 'doc', 'docx', 'xls', 'xlsx', 'txt');
            //检查上传文件是否在允许上传的类型
            if (!in_array($ext, $tp)) {
                echo json_encode(array('code' => 1, 'msg' => '只能发送图片、文档、表格等文件'));
                die;
            }
            if (in_array($ext, array('gif', 'jpg', 'png', 'bmp', 'jpeg'))) {
                $ftype = 1;
            } else {
                $ftype = 2;
            }
            //检查文件大小
            $max_size = 2 * 1024 * 1024;   //2M
            if ($filesize > $max_size) {
                echo json_encode(array('code' => 0, 'msg' => '上传文件大小超过限制,不允许超过2M '));
                die;
            }
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
                echo json_encode(array('code' => 200, 'ftype' => $ftype, 'fileurl' => $fileurl, 'filename' => $oldfileName, 'msg' => '上传成功！'));
            } else {
                echo json_encode(array('code' => 0, 'msg' => $res['msg']));
            }
        } else {
            echo json_encode(array('code' => 0, 'msg' => '请选择文件！'));
        }
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

    //获取聊天机构信息
    public function actionChatOrgan() {
        if (Yii::app()->request->isAjaxRequest) {
            $id = Yii::app()->user->id;
            $name = trim(Yii::app()->request->getParam('chars'));
            if ($name) {
                $wname1 = "";
                $OrganID = Yii::app()->user->getOrganID();
                $wname2 = "and OrganID!='$OrganID' and a.OrganName like '%$name%'";
                $sql = "SELECT a.OrganName,a.Logo,d.ID,d.UserName,d.IsMain,d.name FROM `jpd_organ` a 
                        left join 
                        (select b.ID,b.UserName,b.OrganID,b.IsMain,c.name from jpd_user b 
                        left join jpd_organ_employees c on b.EmployeID=c.ID
                        where b.ID!=$id $wname1) as d
                        on a.ID=d.OrganID
                        where IsBlack='0' and IsFreeze='0' and IsAuth='0' and Status!='0'$wname2
                        order by a.ID asc ";
                $res1 = Yii::app()->jpdb->createCommand($sql)->queryAll();
                //  $sql1 = str_replace($wname1, ' and c.name like '%$name%'', $sql);
                //  $sql2 = str_replace($wname2, " and a.OrganName like '%$name%'", $sql1);
                //  $res2 = Yii::app()->jpdb->createCommand($sql2)->queryAll();
                //  $res = array_merge($res1, $res2);
                $res = $res1;
                $upload = F::uploadUrl();
                $arr = array();
                foreach ($res as $k => $v) {
                    $name = $v['IsMain'] == '1' ? $v['OrganName'] : $v['OrganName'] . '-' . $v['UserName'];
                    $v['Organ'] = '<div class="suggestion_img"><img src="' . ($v['Logo'] ? ($upload . $v['Logo']) : '') . '"/></div>'
                            . '<div class="suggestion_organ" title = "' . $name . '">' . $name
                            . '</div><div style="clear:both"></div>';
                    $arr[$k] = array('id' => $v['ID'], 'img' => $upload . $v['Logo'], 'name' => $name, 'data' => $v['Organ']);
                }
                echo json_encode($arr);
            } else {
                echo json_encode(array());
            }
        }
    }

    //聊天
    public function actionSendmsg() {
        if (Yii::app()->request->isAjaxRequest) {
            $userid = Yii::app()->user->getOrganID();
            $touserid = Yii::app()->request->getParam('touserid');
            $msg = Yii::app()->request->getParam('msg');
            $imgsrc = Yii::app()->request->getParam('imgsrc');
            if (!$imgsrc) {
                $imgsrc = F::uploadUrl() . Organ::model()->findByPk($touserid)->attributes['Logo'];
            }
            echo json_encode(array('rows' => array(
                    array('type' => 'mine', 'msg' => $msg, 'time' => date('Y-m-d H:i:s'), 'id' => $userid),
                    array('type' => 'receive', 'msg' => '么么，你好！', 'time' => date('Y-m-d H:i:s'),
                        'id' => $touserid, 'imgsrc' => $imgsrc),
                ))
            );
        }
    }

}
