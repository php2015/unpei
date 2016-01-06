<?php

class ServicemainController extends Controller {

    public $layout = '//layouts/service';

    /*
     * 经营黄页登记--相关信息显示
     */

    public function actionIndex() {
        $userId = Commonmodel::getOrganID();
        $validate = new Service();
        $display = 'block';
        $flag = $_GET['flag'];
        if ($flag == 'update') {
            $display = 'none';
        }

        //获取机构照片
        $photo = ServicePhoto::model()->findAll("userId=:userId", array(":userId" => $userId));
        //获取修理厂基础信息
        $model = Service::model()->find("userId=:userId", array(":userId" => $userId));
        if (empty($model)) {
            $model = new Service;
            $display = "none";
        }
        $this->render('index', array(
            'photo' => $photo,
            'model' => $model,
            'display' => $display
        ));
    }

    /*
     * 将阿拉伯数字转换成中文
     */

    public function getNum($number) {
        $arr = array("一", "二", "三", "四", "五", "六", "日");
        switch ($number) {
            case 1: return $arr[0];
                break;
            case 2: return $arr[1];
                break;
            case 3: return $arr[2];
                break;
            case 4: return $arr[3];
                break;
            case 5: return $arr[4];
                break;
            case 6: return $arr[5];
                break;
            case 7: return $arr[6];
                break;
        }
    }

    public function actionSaveorgan() {
        $userId = Commonmodel::getOrganID();
        //执行添加或修改操作
        if ($_POST['Service']) {
            $userId = Commonmodel::getOrganID();
            $service = $_POST['Service'];
            //获取营业时间、经营区域、地址
            $openTime = $_POST['startWeek'] . "," . $_POST['endWeek'] . "," . $_POST['startTime'] . "," . $_POST['endTime'];
            $service['serviceOpenTime'] = $openTime;
            $service['serviceProvince'] = $_POST['serviceProvince'];
            $service['serviceCity'] = $_POST['serviceCity'];
            $service['serviceArea'] = $_POST['serviceArea'];
            $service['serviceRegionProvince'] = $_POST['serviceRegionProvince'];
            $service['serviceRegionCity'] = $_POST['serviceRegionCity'];
            $service['serviceRegionArea'] = $_POST['serviceRegionArea'];
            $rsType == false;
            // 添加机构照片
            if ($_POST['organImages']) {
                $organImages = $_POST['organImages'];
                $imglegth = count($organImages);
                for ($i = 0; $i < $imglegth; $i++) {
                    $organImg = new ServicePhoto();
                    $organImg->userId = $userId;
                    $organImg->addTime = date("Y-m-d", time());
                    $organImg->photoName = $organImages[$i];
                    $organImg->save();
                }
                $rsType = true;
            } else {
                $rsType = true;
            }
            // 删除机构照片
            if (!empty($_POST['photoName'])) {
                $photoName = $_POST['photoName'];   //该处传过来的其实是图片名称
                $imagenames = explode(',', $photoName);
                foreach ($imagenames as $imagename) {
                    $myfileurl = Yii::app()->params['uploadPath'] . $imagename;
                    $oldpic = ServicePhoto::model()->find("photoName=:name", array(":name" => $imagename));
                    if ($oldpic) {
                        //存入数据库后删除
                        $bools = ServicePhoto::model()->deleteAll("photoName=:name", array(":name" => $imagename));
                        if ($bools) {
                            if (file_exists($myfileurl)) {
                                unlink($myfileurl);
                            }
                        }
                    } else {
                        //添加时删除（未存入数据库）
                        if (file_exists($myfileurl)) {
                            unlink($myfileurl);
                        }
                    }
                }
                $rsType = true;
            } else {
                $rsType = true;
            }
            //判断机构信息是否存在，存在则修改，不存在则添加
            $model = Service::model()->find("userId=:userId", array(":userId" => $userId));
            if (!empty($service)) {
                if (empty($model)) {
                    $model = new Service;
                    $model->userId = $userId;
                    $model->attributes = $service;
                    if ($model->save()) {
                        $user = User::model()->findByPk($userId);
                        $user->OrganID = $userId;
                        $user->save();
                    }
                    $rsType = true;
                }
                $model->attributes = $service;
                if ($model->updateByPk($userId, $service)) {
                    $rsType = true;
                }
            } else {
                $rsType = true;
            }
            if ($rsType) {
                echo json_encode('OK');
            } else {
                echo json_encode('NoOk');
            }
        }
    }

    /**
     * 验证机构名称 手机号码 邮箱是否重复
     */
    public function actionCheckorgan() {
        $model = Yii::app()->db->createCommand()
                ->select("OrganID as organID")
                ->from("tbl_user")
                ->where("id=:userid", array(":userid" => Yii::app()->user->id))
                ->queryRow();
        if (empty($model['organID'])) {
            $organID = 0;
        } else {
            $organID = $model['organID'];
        }
        $name = $_GET['name'];
        if (!empty($name)) {
            $model = Service::model()->findAll("userId!=:organID and serviceName=:name", array(
                ":organID" => $organID,
                ":name" => $name));
            if (!empty($model)) {
                $message = "机构名称已存在,不可重复";
            } else {
                $phone = $_GET['phone'];
                if (!empty($phone)) {
                    $model = Service::model()->findAll("userId!=:organID and serviceCellPhone=:phone", array(
                        ":organID" => $organID,
                        ":phone" => $phone));
                    if (!empty($model)) {
                        $message = "手机号码已被使用";
                    } else {
                        $email = $_GET['email'];
                        if (!empty($email)) {
                            $model = Service::model()->findAll("userId!=:organID and serviceEmail=:email", array(
                                ":organID" => $organID,
                                ":email" => $email));
                            if (!empty($model)) {
                                $message = "邮箱已被使用";
                            }
                        }
                    }
                }
            }
        }
        if (empty($message)) {
            $result = TRUE;
        } else {
            $result = FALSE;
        }
        $resu['result'] = $result;
        $resu['message'] = $message;
        echo json_encode($resu);
    }

}