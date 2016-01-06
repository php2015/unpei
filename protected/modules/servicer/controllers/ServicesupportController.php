<?php

/*
 * 服务支持
 */

class ServicesupportController extends Controller {

    public function actionIndex() {
        //配件登记表单提交
        if ($_POST) {
            $this->actionAddparts();
        }
        //根据车牌号获取服务信息
        $LicensePlate = urldecode(Yii::app()->request->getParam("LicensePlate"));
        $OrganID = Yii::app()->user->getOrganID();
        $sql = "SELECT jsc.ID AS CarID, jsc.Mileage, jsc.UseNature, jsc.BuyTime, jsc.VinCode, jsc.Car, jsc.Code, 
                jsco.City, jsco.Email, jsco.DrivingLicense, jsco.ID AS OwnerID, jsco.`Name`, jsc.Relation, jsc.PartsLevel, 
                jsco.NickName, jsco.Phone, jsco.QQ, jsco.Sex FROM jpd_service_car AS jsc LEFT JOIN 
                jpd_service_car_owner AS jsco ON jsc.OwnerID = jsco.ID WHERE jsc.Status = 0 
                AND jsc.OrganID = '{$OrganID}' AND jsc.LicensePlate = '{$LicensePlate}'";
        $datas = Yii::app()->jpdb->createCommand($sql)->queryAll();
        $data = $datas[0];
        $data['BuyTime'] = $data['BuyTime'] ? date('Y-m-d', $data['BuyTime']) : "";
        $data['ParentID'] = '';
        $data['cityArr'] = array();
        if (!empty($data['City'])) {
            $data['ParentID'] = Area::model()->findByPK($data['City'])->ParentID;
            $data['cityArr'] = Area::model()->findAll("ParentID = {$data['ParentID']}");
        }
        //获取省信息
        $area = Area::model()->findAll('Grade = 1');
        //配件登记信息页面
        $dataProvider = RPCClient::call('SupportService_getServiceData', array('CarID' => $data['CarID']));
        $this->render('index', array('data' => $data, 'dataProvider' => $dataProvider, 'LicensePlate' => $LicensePlate, 'area' => $area));
    }

    /*
     * 车牌号检索
     */

    public function actionLicenseplate() {
        $keyword = Yii::app()->request->getParam('keyword');
        $OrganID = Yii::app()->user->getOrganID();
        if ($keyword) {
            $keyword = trim($keyword);
            $keyword = str_replace(' ', '%', $keyword);
            $keyword = strtoupper($keyword);
        }
        $sql = 'select DISTINCT( `LicensePlate`) as title from `jpd_service_car` '
                . 'where `LicensePlate` like "%' . $keyword . '%" AND OrganID = '
                . $OrganID . ' AND Status = 0 order by `CreateTime` Desc limit 0,10';
        $datas = Yii::app()->jpdb->createCommand($sql)->queryAll();
        echo json_encode(array('data' => $datas));
    }
    
    public function actionLicenseplateone() {
        $keyword = Yii::app()->request->getParam('keyword');
        $OrganID = Yii::app()->user->getOrganID();
        if ($keyword) {
            $keyword = trim($keyword);
            $keyword = str_replace(' ', '%', $keyword);
            $keyword = strtoupper($keyword);
        }
        $sql = 'select DISTINCT( `LicensePlate`) as title from `jpd_service_car` '
                . 'where `LicensePlate` = "' . $keyword . '" AND OrganID = '
                . $OrganID . ' AND Status = 0';
        $datas = Yii::app()->jpdb->createCommand($sql)->queryAll();
        if($datas){
            echo 1;die;
        }  else {
            echo 0;die;
        }
        //echo json_encode(array('data' => $datas));
    }

    /*
     * 所在城市
     */
    public function actionGetcity() {
        if (!Yii::app()->request->isAjaxRequest) {
            exit;
        }
        $city = Yii::app()->request->getParam("city");
        $criteria = new CDbCriteria();
        $criteria->select = "ID, Name";
        if (empty($city)) {
            $criteria->addCondition("t.Grade = 1");
        } else {
            $criteria->addCondition("t.ParentID = {$city}");
            $criteria->addCondition("t.Grade = 2");
        }
        $model = Area::model()->findAll($criteria);
        $data = array();
        foreach ($model as $key => $val) {
            $data[$key] = array();
            $data[$key]['ID'] = $val['ID'];
            $data[$key]['Name'] = $val['Name'];
        }
        echo json_encode($data);exit();
    }

    /*
     * 配件登记弹出窗
     */
    public function actionAddpartsdialog() {
        if (!Yii::app()->request->isAjaxRequest) {
            exit;
        }
        $RecordID = Yii::app()->request->getParam('id');
        $CarID = Yii::app()->request->getParam('CarID');
        $data = array();
        if (!empty($RecordID)) {
            $data = RPCClient::call('SupportService_getServiceDataByServiceIDList', array('ServiceID' => $RecordID));
        }
        $item = RPCClient::call('SupportService_getMaintenanceItemData');
        return $this->renderPartial('addparts', array('data' => $data, 'item' => $item, 'RecordID' => $RecordID, 'CarID' => $CarID));
    }

    /*
     * 添加服务支持车主、车辆信息
     */
    public function actionAddservicedata() {
        $OrganID = Yii::app()->user->getOrganID();

        //添加车主信息
        $carowenrmodel = new ServiceCarOwner();
        $carowenrmodel->Name = Yii::app()->request->getParam("OwnerName");
        $carowenrmodel->Phone = Yii::app()->request->getParam("Phone");
        $carowenrmodel->NickName = Yii::app()->request->getParam("NickName");
        $carowenrmodel->Sex = Yii::app()->request->getParam("Sex");
        $carowenrmodel->City = Yii::app()->request->getParam("City");
        $carowenrmodel->Email = Yii::app()->request->getParam("Email");
        $carowenrmodel->QQ = Yii::app()->request->getParam("QQ");
        $carowenrmodel->DrivingLicense = Yii::app()->request->getParam("DrivingLicense");
        $carowenrmodel->OrganID = $OrganID;
        $carowenrmodel->CreateTime = time();

        if ($carowenrmodel->save()) {
            //添加车辆信息
            $carmodel = new ServiceCar();
            $carmodel->OrganID = $OrganID;
            $carmodel->OwnerID = $carowenrmodel->ID;
            $carmodel->Car = Yii::app()->request->getParam("Car");
            $carmodel->LicensePlate = Yii::app()->request->getParam("LicensePlate");
            $carmodel->UseNature = Yii::app()->request->getParam("UseNature");
            $carmodel->VinCode = Yii::app()->request->getParam("VinCode");
            $carmodel->BuyTime = strtotime(Yii::app()->request->getParam("BuyTime"));
            $carmodel->Mileage = Yii::app()->request->getParam("Mileage");
            $carmodel->Code = Yii::app()->request->getParam("Code");
            $carmodel->Relation = Yii::app()->request->getParam("Relation");
            $carmodel->PartsLevel = Yii::app()->request->getParam("PartsLevel");
            $carmodel->CreateTime = time();
            if ($carmodel->save()) {
                echo json_encode(array('result'=>1,'msg'=>"保存成功！"));exit;
                //$this->redirect(array('index', 'LicensePlate'=> urlencode($carmodel->LicensePlate)));
            } else {
                $carowenrmodel->deleteByPk($carowenrmodel->ID);
                echo json_encode(array('result'=>0,'msg'=>"保存车辆信息失败！"));exit;
                //throw new CHttpException(400, '保存车辆信息失败！');
            }
        } else {
            //var_dump($carowenrmodel->errors);die;
            echo json_encode(array('result'=>0,'msg'=>"保存车主信息失败！"));exit;
            //throw new CHttpException(400, '保存车主信息失败！');
        }
    }

    /*
     * 检查服务（车牌）信息
     */

    public function actionCheckservicedata() {
        $OrganID = Yii::app()->user->getOrganID();
        $LicensePlate = Yii::app()->request->getParam("LicensePlate");
        $model = ServiceCar::model()->findAll('LicensePlate = :LicensePlate AND OrganID = :OrganID AND Status = 0', array(':LicensePlate' => $LicensePlate, ':OrganID' => $OrganID));
        if ($model) {
            echo 1;
        } else {
            echo 0;
        }
    }

    /*
     * 配件登记
     */

    public function actionAddparts() {
        $UserID = Yii::app()->user->id;
        $RecordID = Yii::app()->request->getParam("RecordID");
        $Item = Yii::app()->request->getParam("Item");
        $partsnum = Yii::app()->request->getParam("partsnum");
        $GoodsName = Yii::app()->request->getParam("PartName");
        $GoodsNum = Yii::app()->request->getParam("OE");
        $PartsLevel = Yii::app()->request->getParam("PartsLevel");
        $Brand = Yii::app()->request->getParam("Brand");
        $num = Yii::app()->request->getParam("num");
        $partsID = Yii::app()->request->getParam("partsID");
        $delIDs = Yii::app()->request->getParam("delID");
        $time = time();

        if(!empty($delIDs)) {//删除配件
            SupportParts::model()->updateAll(array('Status' => 1), "ID IN ({$delIDs}) ");
        }
        if(!empty($RecordID)){
            //不为空   修改配件信息
            $RecordModel = SupportRecord::model()->findByPk($RecordID);
            $RecordModel->UpdateTime = time();
            if(empty($Item)){
                $RecordModel->updateByPk($RecordID, array('Status'=>1));
            }
        }  else {
            //为空  新增配件信息
            $RecordModel = new SupportRecord();
            $RecordModel->CreateTime = $time;
            $RecordModel->OrganID = Yii::app()->user->getOrganID();
        }
        if(empty($Item)){
            $this->redirect(array("index", 'LicensePlate' => Yii::app()->request->getParam("LicensePlate")));
        }
        $RecordModel->CarID = Yii::app()->request->getParam("CarID");
        $RecordModel->Mileage = Yii::app()->request->getParam("Mileage");
        $RecordModel->Remark = Yii::app()->request->getParam("Remark");
        $RecordModel->UserID = $UserID;
        if($RecordModel->save()){
            $k = 0;
            $sql = "INSERT INTO jpd_support_parts (RecordID, ItemID, GoodsName, Brand, Num, GoodsNum, PartsLevel, CreateTime, Status) values ";
            foreach ($Item as $key => $val) {
                for ($i = 0; $i < $partsnum[$key]; $i++) {
                    if(!empty($partsID[$k])){ //修改
                        if(empty($val) || empty($GoodsName[$k]) || empty($num[$k])){//保养项目、商品名字、商品数量为空时直接删除
                            SupportParts::model()->updateByPk($partsID[$k], array('Status'=>1));
                            $k++;continue;
                        }  else { 
                            SupportParts::model()->updateByPk($partsID[$k], 
                                    array(
                                        'RecordID' => $RecordModel->ID,
                                        'ItemID' => $val,
                                        'GoodsName' => $GoodsName[$k],
                                        'Brand' => $Brand[$k],
                                        'Num' => $num[$k],
                                        'GoodsNum' => $GoodsNum[$k],
                                        'PartsLevel' => $PartsLevel[$k],
                                        'UpdateTime' => $time
                                    ));
                            $k++;continue;
                        }
                    }else{ //新增
                        if(empty($val) || empty($GoodsName[$k]) || empty($num[$k])){
                            $k++;continue;
                        }
                        $insert .= "({$RecordModel->ID}, {$val}, '{$GoodsName[$k]}', '{$Brand[$k]}', {$num[$k]}, '{$GoodsNum[$k]}', '{$PartsLevel[$k]}', {$time}, 0),";
                        $k++;
                    }
                }
            }
            if(!empty($insert)){
                $sql = $sql.rtrim($insert, ",");
                $result = Yii::app()->jpdb->createCommand($sql)->execute();
                if (!$result) {
                    $RecordModel->deleteByPk($RecordModel->ID);
                    throw new CHttpException(400, '配件登记失败！');
                }
            }
            //echo $insert;die;
        } else {
            throw new CHttpException(400, '配件登记失败！');
        }
        $this->redirect(array("index",'LicensePlate'=>Yii::app()->request->getParam("LicensePlate")));
    }

    /*
     * 删除配件登记信息
     */
    public function actionDelpartsdata() {
        if (!Yii::app()->request->isAjaxRequest) {
            exit;
        }
        $RecordID = Yii::app()->request->getParam('id');
        $res1 = SupportParts::model()->updateAll(array('UpdateTime' => time(),'Status' => 1), 'RecordID = :RecordID',array('RecordID'=>$RecordID));
        if(!empty($res1)){
            $res2 = SupportRecord::model()->updateByPk($RecordID, array('UpdateTime' => time(),'Status' => 1));
        }
        echo json_encode($res2);die;
    }
}
