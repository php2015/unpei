<?php

class CompanyController extends Controller {

    /**
     * 我的黄页
     */
    public function actionIndex() {
        if ($_POST) {
            $this->actionSaveorgan();
        }
        $identity = Yii::app()->user->identity;
        $OrganID = Yii::app()->user->getOrganID();
        if ($identity == 1) {
            $model = Organ::model()->with('maker')->findByPk($OrganID);
        } elseif ($identity == 2) {
            $model = Organ::model()->with('dealer')->findByPk($OrganID);
        } elseif ($identity == 3) {
            $model = Organ::model()->with('service')->findByPk($OrganID);
        }
        if (empty($model)) {
            $model = new Organ();
        }
        if ($identity == 1 && empty($model['maker'])) {
            $model['maker'] = new Make();
        } elseif ($identity == 2 && empty($model['dealer'])) {
            $model['dealer'] = new Dealer();
        } elseif ($identity == 3 && empty($model['service'])) {
            $model['service'] = new Service();
        }

        // 机构照片
        $photosql = 'select * from `{{organ_photo}}` where OrganID=' . $OrganID;
        $organphoto = Yii::app()->jpdb->createCommand($photosql)->queryAll();
        foreach ($organphoto as $val) {
            $organphotos[$val['Purpose']][] = $val;
        }
        if ($identity == 2){
            $Brand_sql = "SELECT b.BrandName, a.ID, a.url1, a.url2 FROM pap_dealer_brand AS a LEFT JOIN pap_brand AS b "
                    . "ON a.BrandID = b.ID WHERE a.OrganID = {$OrganID}";
            $organphotos[1] = Yii::app()->papdb->createCommand($Brand_sql)->queryAll();
        }
        $this->render('index', array(
            'model' => $model,
            'identity' => $identity,
            'organphotos' => $organphotos,
        ));
    }

    /**
     * 公司信息保存
     */
    public function actionSaveorgan() {
        $OrganID = Yii::app()->user->getOrganID();
        $identity = Yii::app()->user->identity;

        $Organ = Yii::app()->request->getParam("Organ");
        $arr = Yii::app()->request->getParam("telPhone");
        $TelPhone = "";
        foreach ($arr as $val) {
            if (empty($val)) {
                continue;
            }
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
                $this->delorganphoto($photoId);
            }

            //接收上传图片地址
            $goodsImages = Yii::app()->request->getParam("goodsImages");
            //判断是否有上传图片
            if (!empty($goodsImages)) {
                $this->saveorganphoto($goodsImages);
            }

            //判断是否上传营业执照
            $BLPoto = Yii::app()->request->getParam("BLPoto");
            if ($model->BLPoto != $BLPoto) {
                if (!empty($model->BLPoto)) {
                    $ftp = new Ftp();
                    $ftp->delete_file($model->BLPoto);
                    $ftp->close();
                }
                $model->BLPoto = $BLPoto;
            }
            
            //判断是否上传门店照片
            $ShopPoto = trim(Yii::app()->request->getParam("ShopPoto"),",");
            $delShopPoto = trim(Yii::app()->request->getParam("delShopPoto"),",");
            if ($ShopPoto) {
                $ShopPotos = explode(",",$ShopPoto);
                $delShopPotos = explode(",",$delShopPoto);
                foreach ($ShopPotos as $val) {
                    if(!in_array($val, $delShopPotos)){
                        $this->savePhotoInfoToMysql($val, $OrganID, 2);
                    }
                }
            }
            if ($identity == 1) {
                $this->savemakerdata();
            } elseif ($identity == 2) {
                $this->savedealerdata();
            } elseif ($identity == 3) {
                $this->saveservicedata();
            }

            if (!$model->save()) {
                //var_dump($model->errors);die;
                throw new CHttpException(400, '保存机构信息失败！');
            } else {
                //更新登陆时保存的session信息
                Yii::app()->user->updateSession();
            }
        }
        $this->redirect(array("index"));
    }
    
    /**
     * 品牌授权书上传保存
     */
    public function actionSavebrandphoto() {
        $id = Yii::app()->request->getParam("id");
        $path = Yii::app()->request->getParam("path");
        $type = Yii::app()->request->getParam("type");
        
        if(Yii::app()->request->isPostRequest){
            if($type == 1){
                $result = DealerBrand::model()->updateByPk($id,array("url1" => $path));
            }else{
                $result = DealerBrand::model()->updateByPk($id,array("url2" => $path));
            }
        }
        if($result){
            $model = DealerBrand::model()->findByPk($id);
            Yii::app()->redis->set('Brand' . $model->BrandID . 'o' . $model->OrganID, 'true');
            echo json_encode(array("result"=>1,"msg"=>"上传成功！"));
        }else{
            echo json_encode(array("result"=>0,"msg"=>"上传失败！"));
        }
    }
    
    /*
     * 将图片路径保存到数据库
     */

    private function savePhotoInfoToMysql($Path, $OrganID, $Purpose) {
        if (empty($Path) || empty($OrganID) || empty($Purpose)) {
            return FALSE;
        }
        $photo = OrganPhoto::model()->find("Path = '{$Path}' AND OrganID = {$OrganID} AND Purpose = {$Purpose}");
        if (!$photo) {
            $photo = new OrganPhoto;
        }
        $photo->Path = $Path;
        $photo->OrganID = $OrganID;
        $photo->Purpose = $Purpose;
        if (!$photo->save()) {
            var_dump($photo->errors);
            die;
        }
    }
    
    /*
     * 删除门店图片
     */

    public function actionDelshopshoto() {
        $path = Yii::app()->request->getParam("path");
        if(Yii::app()->request->isPostRequest){
            $result = OrganPhoto::model()->deleteAll("Path = '{$path}'");
        }
        if($result){
            echo json_encode(1);
        }else{
            echo json_encode(0);
        }
    }
    
    /*
     * 删除品牌授权书图片
     */

    public function actionDelbrandshoto() {
        $id = Yii::app()->request->getParam("key");
        $type = Yii::app()->request->getParam("app");
        if(Yii::app()->request->isPostRequest){
            if($type == "one"){
                $result = DealerBrand::model()->updateByPk( $id, array("url1"=>""));
            }else{
                $result = DealerBrand::model()->updateByPk( $id, array("url2"=>""));
            }
        }
        if($result){
            $model = DealerBrand::model()->findByPk($id);
            Yii::app()->redis->set('Brand' . $model->BrandID . 'o' . $model->OrganID, 'false');
            echo json_encode(array("result"=>1,"msg"=>"删除成功！"));
        }else{
            echo json_encode(array("result"=>0,"msg"=>"数据删除失败！"));
        }
    }

    /*
     * 保存修理厂机构信息
     */

    public function saveservicedata() {
        $OrganID = Yii::app()->user->getOrganID();
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
        $servicemodel->ServiceType = $service['ServiceType'];
        $servicemodel->OpenTime = $opentime[0] . ',' . $opentime[1] . ',' . $opentime[2] . ',' . $opentime[3];

        if (!$servicemodel->save()) {
            //var_dump($servicemodel->errors);die;
            throw new CHttpException(400, '保存机构信息失败！');
        }
    }

    /*
     * 保存经销商机构信息
     */

    public function savedealerdata() {
        $OrganID = Yii::app()->user->getOrganID();

        //接收dealer数据
        $dealer = Yii::app()->request->getParam("Dealer");
        //保存dealer数据
        $dealermodel = Dealer::model()->find("OrganID=:organid", array(":organid" => $OrganID));
        if (empty($dealermodel)) {//判断是否第一次添加
            $dealermodel = new Dealer();
            $dealermodel->OrganID = $OrganID;
        }
        $dealermodel->SaleMoney = $dealer['SaleMoney'];
        $dealermodel->SaleDomain = $dealer['SaleDomain'];
        $dealermodel->ShopArea = $dealer['ShopArea'];
        if (!$dealermodel->save()) {
            //var_dump($dealermodel->errors);die;
            throw new CHttpException(400, '保存机构信息失败！');
        }
    }

    /*
     * 保存生产商机构信息
     */

    public function savemakerdata() {
        $OrganID = Yii::app()->user->getOrganID();
        //接收make数据
        $make = Yii::app()->request->getParam("Make");
        //保存make数据
        $makemodel = Make::model()->find("OrganID=:organid", array(":organid" => $OrganID));
        if (empty($makemodel)) {//判断是否第一次添加
            $makemodel = new Make();
            $makemodel->OrganID = $OrganID;
        }
        $makemodel->SaleMoney = $make['SaleMoney'];
        $makemodel->SaleDomain = $make['SaleDomain'];
        if (!$makemodel->save()) {
            //var_dump($makemodel->errors);die;
            throw new CHttpException(400, '保存机构信息失败！');
        }
    }

    /*
     * 保存机构图片到数据库
     */

    public function saveorganphoto($goodsImages) {
        $OrganID = Yii::app()->user->getOrganID();
        $imglegth = count($goodsImages);
        $sql = "INSERT INTO jpd_organ_photo (OrganID,Path) values";
        for ($i = 0; $i < $imglegth; $i++) {
            $insert .= "('{$OrganID}','{$goodsImages[$i]}'),";
        }

        if (!empty($insert)) {
            $sql .= rtrim($insert, ",");
        }
        $result = Yii::app()->jpdb->createCommand($sql)->execute();
        if (!$result) {
            throw new CHttpException(400, '保存机构图片失败！');
        }
    }

    /*
     * 删除机构图片
     */

    public function delorganphoto($photoId) {
        $imageids = explode(',', $photoId);
        $OrganID = Yii::app()->user->getOrganID();
        $ftp = new Ftp();
        foreach ($imageids as $imageid) {
            $picture = OrganPhoto::model()->find('Path=:img AND OrganID=:OrganID', array(':img' => $imageid, ':OrganID' => $OrganID));
            //判断该图片路径是否存在数据库中
            if (empty($picture)) {
                $res = $ftp->delete_file($imageid);
            } else {
                OrganPhoto::model()->deleteAll('Path=:img AND OrganID=:OrganID', array(':img' => $imageid, ':OrganID' => $OrganID));
                $res = $ftp->delete_file($picture->Path);
            }
        }
        $ftp->close();
    }

    /**
     * 验证机构名称 手机号码 邮箱是否重复
     */
    public function actionCheckorgan() {
        $OrganID = Yii::app()->user->getOrganID();
        if (empty($OrganID)) {
            $organID = 0;
        } else {
            $organID = $OrganID;
        }
        $name = Yii::app()->request->getParam('name');
        if (!empty($name)) {
            $model = Organ::model()->findAll("ID!=:organID and OrganName=:name", array(":organID" => $organID, ":name" => $name));
            if (!empty($model)) {
                $message = "机构名称已存在,不可重复";
            } else {
//                $mobilephone = Yii::app()->request->getParam('mobilephone');
//                if (!empty($mobilephone)) {
//                    $model = Organ::model()->findAll("ID!=:organID and Phone=:mobilephone", array(":organID" => $organID, ":mobilephone" => $mobilephone));
//                    if (!empty($model)) {
//                        $message = "手机号码已被使用";
//                    } else {
//                        $email = Yii::app()->request->getParam('email');
//                        if (!empty($email)) {
//                            $model = Organ::model()->findAll("ID!=:organID and Email=:email", array(
//                                ":organID" => $organID,
//                                ":email" => $email));
//                            if (!empty($model)) {
//                                $message = "邮箱已被使用";
//                            }else{
//                                $qq = Yii::app()->request->getParam("qq");
//                                if(!empty($qq)){
//                                    $model = Organ::model()->findAll("ID!=:organID and QQ=:QQ", array(
//                                        ":organID" => $organID,
//                                        ":QQ" => $qq));
//                                    if (!empty($model)) {
//                                        $message = "QQ号已被使用";
//                                    }
//                                }
//                            }
//                        }
//                    }
//                }
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
