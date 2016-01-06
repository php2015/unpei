<?php

class ServicecompanyController extends Controller {

    /**
     * 我的黄页
     */
    public function actionIndex() {
        if ($_POST) {
            $this->actionSaveserviceorgan();
        }
        $OrganID = Yii::app()->user->getOrganID();
        $display = 'block';
        $flag = $_GET['flag'];
        if ($flag == 'update') {
            $display = 'none';
        }
        $model = Organ::model()->with('service')->findByPk($OrganID);
        $opentime = explode(",", $model['service']['OpenTime']);
        if (empty($model)) {
            $model = new Organ();
            $display = 'none';
        }

        // 机构照片
        $photosql = 'select * from `{{organ_photo}}` where OrganID=' . $OrganID;
        $organphotos = Yii::app()->jpdb->createCommand($photosql)->queryAll();
        $this->render('index', array(
            'model' => $model,
            'opentime' => $opentime,
            'display' => $display,
            'organphotos' => $organphotos,
        ));
    }

    /**
     * 公司信息保存
     */
    public function actionSaveserviceorgan() {
        $OrganID = Yii::app()->user->getOrganID();

        $Organ = Yii::app()->request->getParam("Organ");
        $arr = Yii::app()->request->getParam("telPhone");
        $TelPhone = "";
        foreach ($arr as $key => $val) {
            if (empty($val))
                continue;
            $TelPhone .= $val . ",";
        }
        $model = Organ::model()->findByPK($OrganID);
        if (empty($model)) {
            $model = new Organ();
        }
        //保存organ数据
        $model->attributes = $Organ;
        $model->TelPhone = trim($TelPhone, ',');

        //判断基本信息是否为空，为空则不提交
        if ($Organ) {
            //接收删除图片的地址
            $photoId = Yii::app()->request->getParam("photoId");
            //判断是否删除图片
            if (!empty($photoId)) {
                $imageids = explode(',', $photoId);
                foreach ($imageids as $imageid) {
                    $picture = OrganPhoto::model()->find('Path=:img AND OrganID=:OrganID', array(':img' => $imageid, ':OrganID' => $OrganID));
                    //判断该图片路径是否存在数据库中
                    if (empty($picture)) {
                        $ftp = new Ftp();
                        $res = $ftp->delete_file($imageid);
                        $ftp->close();
                    } else {
                        OrganPhoto::model()->deleteAll('Path=:img AND OrganID=:OrganID', array(':img' => $imageid, ':OrganID' => $OrganID));
                        $ftp = new Ftp();
                        $res = $ftp->delete_file($picture->Path);
                        $ftp->close();
                    }
                }
            }

            //接收上传图片地址
            $goodsImages = Yii::app()->request->getParam("goodsImages");
            //判断是否有上传图片
            if (!empty($goodsImages)) {
                $imglegth = count($goodsImages);
                for ($i = 0; $i < $imglegth; $i++) {
                    $goodsImg = new OrganPhoto();
                    $goodsImg->OrganID = $OrganID;
                    $goodsImg->Path = $goodsImages[$i];
                    $goodsImg->save();
                }
            }

            //判断是否上传营业执照
            $BLPoto = Yii::app()->request->getParam("BLPoto");
            if ($model->BLPoto != $BLPoto) {
                if (!empty($model->BLPoto)) {
                    $ftp = new Ftp();
                    $res = $ftp->delete_file($model->BLPoto);
                    $ftp->close();
                }
                $model->BLPoto = $BLPoto;
            }

            //接收service数据
            $service = Yii::app()->request->getParam("Service");
            $opentime = Yii::app()->request->getParam("OpenTime");
            //保存service数据
            $servicemodel = Service::model()->find("OrganID=:organid", array(":organid" => $OrganID));
            if (empty($servicemodel)) {//判断是否第一次添加
                $servicemodel = new Service();
                $servicemodel->OrganID = $OrganID;
            }
            $servicemodel->PositionCount = $service['PositionCount'];
            $servicemodel->TechnicianCount = $service['TechnicianCount'];
            $servicemodel->ParkingDigits = $service['ParkingDigits'];
            $servicemodel->ReservationMode = $service['ReservationMode'];
            $servicemodel->ShopArea = $service['ShopArea'];
            $servicemodel->OpenTime = $opentime[0] . ',' . $opentime[1] . ',' . $opentime[2] . ',' . $opentime[3];

            //$model->attributes = $Organ;

            if ($servicemodel->save() && $model->save()) {
                //保存成功
                //$file->saveAs(Yii::app()->params['uploadPath'].$model->Logo, true);
                $this->redirect(array('index'));
            } else {
                var_dump($goodsImg->errors);
                die;
            }
        }
    }

    /**
     * 验证机构名称 手机号码 邮箱是否重复
     */
    public function actionCheckorgan() {
        /* $model = Yii::app()->db->createCommand()
          ->select("OrganID as organID")
          ->from("jpd_user")
          ->where("id=:userid", array(":userid" => Yii::app()->user->id))
          ->queryRow(); */
        $OrganID = Yii::app()->user->getOrganID();
        if (empty($OrganID)) {
            $organID = 0;
        } else {
            $organID = $OrganID;
        }
        $name = $_GET['name'];
        if (!empty($name)) {
            $model = Organ::model()->findAll("ID!=:organID and OrganName=:name", array(":organID" => $organID, ":name" => $name));
            if (!empty($model)) {
                $message = "机构名称已存在,不可重复";
            } else {
                $mobilephone = $_GET['mobilephone'];
                if (!empty($mobilephone)) {
                    $model = Organ::model()->findAll("ID!=:organID and Phone=:mobilephone", array(":organID" => $organID, ":mobilephone" => $mobilephone));
//                        $model=Yii::app()->db->createCommand()
//                            ->select('id')
//                            ->from("tbl_user")
//                            ->where("id!=:employID and username=:username",  array(":employID"=>$employID,":username"=>$username))
//                            ->queryAll();
                    if (!empty($model)) {
                        $message = "手机号码已被使用";
                    } else {
                        $email = $_GET['email'];
                        if (!empty($email)) {
                            $model = Organ::model()->findAll("ID!=:organID and Email=:email", array(
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
