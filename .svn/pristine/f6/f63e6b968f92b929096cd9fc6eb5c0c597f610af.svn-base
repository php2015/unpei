<?php

class ReserveController extends Controller {

    public function actionIndex() {
        $OrganID = Yii::app()->user->getOrganID();
        $criteria = new CDbCriteria();
        $arr['LicensePlate'] = Yii::app()->request->getParam("LicensePlate");
        $arr['ReserveTime'] = Yii::app()->request->getParam("ReserveTime");
        $ReserveTime = strtotime($arr['ReserveTime']);
        $arr['ReserveNum'] = Yii::app()->request->getParam("ReserveNum");
//        $arr['Make'] = Yii::app()->request->getParam("Make");
        $arr['Car'] = Yii::app()->request->getParam("Car");
        $arr['Code'] = Yii::app()->request->getParam("Code");
//        $arr['Engine'] = Yii::app()->request->getParam("Engine");
        if (!empty($arr['LicensePlate'])) {// 车牌号
            $criteria->addSearchCondition('licenseplate', "{$arr['LicensePlate']}", "AND");
        }
//        if (!empty($arr['Make'])) {// 厂家
//            $criteria->addSearchCondition('Make', "{$arr['Make']}", "AND");
//        }
        if (!empty($arr['Code'])) {// 车型编码
            $criteria->addCondition("Code = '{$arr['Code']}'", "AND");
        }
//        if (!empty($arr['Engine'])) {// 发动机
//            $criteria->addSearchCondition('Engine', "{$arr['Engine']}", "AND");
//        }
        if (!empty($arr['ReserveTime'])) {// 预约时间
            $criteria->addSearchCondition('ReserveTime', "{$ReserveTime}", "AND");
        }
        if (!empty($arr['ReserveNum'])) {// 预约号
            $criteria->addSearchCondition('ReserveNum', "{$arr['ReserveNum']}", "AND");
        }
        $criteria->order = "t.ID DESC"; //排序条件:t.CreateTime,t.ID倒叙
        $criteria->addCondition("t.OrganID = {$OrganID}");
        $dataProvider=new CActiveDataProvider('ServiceReserve',
                array(
                    'criteria'=>$criteria,
                    'pagination'=>array(
                      'pageSize'=>'10'
                        ),
                ));
        $data = $dataProvider->getData();
        //var_dump($data);die;
        foreach ($data as $key => $val){
            $val['ReserveTime'] = date("Y-m-d",$val['ReserveTime'])." ".$val['BeginTime'].":00-".$val['EndTime'].":00";
        }
        $dataProvider->setData($data);
        $this->render('index',array('dataProvider'=>$dataProvider, 'arr'=>$arr));
    }

    /*
     * 预约登记页面
     */
    public function actionReserve() {
        $this->render('reserve');
    }
    
    /*
     * 修改预约登记页面
     */
    public function actionEditreserve() {
        $ID = Yii::app()->request->getParam("id");
        if(empty($ID)){
            throw new CHttpException(400, '无预约信息！');
        }
        $model = ServiceReserve::model()->findByPk($ID);
        $this->render('editreserve',array("model"=>$model));
    }
    
    /*
     * 删除预约登记信息
     */
    public function actionDelreserve(){
        $ID = Yii::app()->request->getParam("id");
        if(empty($ID)){
            exit;
        }
        $result = ServiceReserve::model()->deleteByPk($ID);
        if($result){
            echo json_encode(array('errorMsg'=>'删除成功！'));exit;
        }else{
            echo json_encode(array('errorMsg'=>'删除失败！'));exit;
        }
    }

    /*
     * 添加预约登记信息
     */
    public function actionAddreserveinfo() {
        $data = array();
        $data['LicensePlate'] = Yii::app()->request->getParam('LicensePlate');
        //$data['Make'] = Yii::app()->request->getParam('Make');
        $data['Car'] = Yii::app()->request->getParam('Car');
        $data['Code'] = Yii::app()->request->getParam('Code');
        $data['Mileage'] = Yii::app()->request->getParam('Mileage');
        $data['OwnerName'] = Yii::app()->request->getParam('OwnerName');
        $data['Phone'] = Yii::app()->request->getParam('Phone');
        $data['StartTime'] = Yii::app()->request->getParam('StartTime');
        $data['ReserveTime'] = Yii::app()->request->getParam('ReserveTime');
        $data['BeginTime'] = Yii::app()->request->getParam('BeginTime');
        $data['EndTime'] = Yii::app()->request->getParam('EndTime');
        $data['Remark'] = Yii::app()->request->getParam('Remark');
        $data['OrganID'] = Yii::app()->user->getOrganID();
//        $CarID = Yii::app()->request->getParam('CarID');
//        $OwnerID = Yii::app()->request->getParam('OwnerID');
        
        //暂时不需要添加到车主、车辆管理中去
        //如果车主信息为空 添加车主信息
//        if(empty($OwnerID)){
//            $Owner = $this->AddOwner($data['OwnerName'],$data['Phone']);
//        }
        //如果车辆信息为空 添加车辆信息
        //$this->AddCar($Owner->ID,$CarID,$data);
        
        $model = new ServiceReserve();
        $model->CreateTime = time();
        $count = ServiceReserve::model()->count("ReserveTime = '" . strtotime($data['ReserveTime']) . "' AND OrganID = '{$data['OrganID']}'");
        $data['ReserveNum'] = date('ymd', strtotime($data['ReserveTime'])) . sprintf("%04d", $count + 1);

        $data['StartTime'] = strtotime($data['StartTime']);
        $data['ReserveTime'] = strtotime($data['ReserveTime']);
        $model->attributes = $data;

        if ($model->save()) {
            $maintenance = array();
            $num = 0;
            //计算车辆上路月数
            $month = $this->getMonthNum($data['StartTime'], $data['ReserveTime']);
            $maintenanceModel = RPCClient::call('ReserveService_queryFrontVehicleMaintenanceIteminfo', array('Code' => $data['Code']));
            //echo json_encode($maintenanceModel);exit();
            foreach ($maintenanceModel as $key => $val) {
                //免维护
                if ($val['Period'] == 0) {
                    continue;
                }
                if (floor($month / $val['Period']) == 0) {
                    //首保
                    if ($val['InFirst'] == '1') {
                        if (($data['Mileage'] >= $val['FirstMileage'] && $data['Mileage'] < $val['SecondMileage']) || ($month >= $val['FirstPeriod'] && $month < $val['SecondPeriod'])) {
                            $maintenance[$num] = array();
                            $maintenance[$num]['name'] = $val['Name'];
                            $maintenance[$num]['code'] = $val['Code'];
                            $num++;
                            continue;
                        }
                    }
                    //二保
                    if ($val['InSecond'] == '1') {
                        if (($data['Mileage'] >= $val['SecondMileage'] && $data['Mileage'] < ($val['SecondMileage'] + $val['IntervalMileage'])) || ($month >= $val['SecondPeriod'] && $month < ($val['SecondPeriod'] + $val['IntervalPeriod']))) {
                            $maintenance[$num] = array();
                            $maintenance[$num]['name'] = $val['Name'];
                            $maintenance[$num]['code'] = $val['Code'];
                            $num++;
                            continue;
                        }
                    }
                } else {
                    //二保以后
                    if ($month % $val['Period'] != 0 && floor(($month % $val['Period']) / $val['IntervalPeriod']) != 0) {
                        continue;
                    } else {
                        $k = floor($month / $val['IntervalPeriod']);
                        if ($data['Mileage'] >= ($val['SecondMileage'] + $val['IntervalMileage'] * $num)) {
                            if ($data['Mileage'] % $val['Mileage'] != 0 || floor(($month % $val['Mileage']) / $val['IntervalMileage']) != 0) {
                                continue;
                            } else {
                                $maintenance[$num] = array();
                                $maintenance[$num]['name'] = $val['Name'];
                                $maintenance[$num]['code'] = $val['Code'];
                                $num++;
                                continue;
                            }
                        } else {
                            $maintenance[$num] = array();
                            $maintenance[$num]['name'] = $val['Name'];
                            $maintenance[$num]['code'] = $val['Code'];
                            $num++;
                            continue;
                        }
                    }
                }
            }
            return $this->renderPartial('maintenance', array('maintenance' => $maintenance, 'maintenanceModel' => $maintenanceModel, 'modelID' => $model->ID, 'ReserveNum' => $model->ReserveNum));
        }else{
            echo json_encode($model->errors);die;
        }
    }
    
    /*
     * 添加车主信息
     */
    public function AddOwner($Name, $Phone){
        $model = new ServiceCarOwner();
        $model->Name = $Name;
        $model->Phone = $Phone;
        $model->OrganID = Yii::app()->user->getOrganID();
        $model->DrivingLicense = "-";
        $model->CreateTime = time();
        if($model->save()){
            return $model;
        }else{
            throw new CHttpException(400, '添加车主信息失败！');
        }
    }

    /*
     * 添加车辆信息
     */
    public function AddCar($OwnerID, $CarID, $arr){
        if ($CarID){
            $model = ServiceCar::model()->findByPk($CarID);
        }else{
            $model = new ServiceCar();
            $model->Car = $arr['Car'];
            $model->LicensePlate = $arr['LicensePlate'];
            $model->BuyTime = $arr['BuyTime'];
            $model->Mileage = $arr['Mileage'];
            $model->OrganID = Yii::app()->user->getOrganID();
            $model->CreateTime = time();
        }
        
        $model->OwnerID = $OwnerID;
        if($model->save()){
            return 1;
        }else{
            throw new CHttpException(400, '添加车辆信息失败！');
        }
    }

    /*
     * 修改预约登记信息
     */
    public function actionEditreserveinfo() {
        $data = array();
        $ID = Yii::app()->request->getParam('id');
        $data['LicensePlate'] = Yii::app()->request->getParam('LicensePlate');
        $data['Car'] = Yii::app()->request->getParam('Car');
        $data['Code'] = Yii::app()->request->getParam('Code');
        $data['Mileage'] = Yii::app()->request->getParam('Mileage');
        $data['OwnerName'] = Yii::app()->request->getParam('OwnerName');
        $data['Phone'] = Yii::app()->request->getParam('Phone');
        $data['StartTime'] = Yii::app()->request->getParam('StartTime');
        $data['ReserveTime'] = Yii::app()->request->getParam('ReserveTime');
        $data['BeginTime'] = Yii::app()->request->getParam('BeginTime');
        $data['EndTime'] = Yii::app()->request->getParam('EndTime');
        $data['Remark'] = Yii::app()->request->getParam('Remark');
        $data['OrganID'] = Yii::app()->user->getOrganID();

        $model = ServiceReserve::model()->findByPk($ID);

        if ($model['ReserveTime'] != strtotime($data['ReserveTime'])) {
            $count = ServiceReserve::model()->count("ReserveTime = '" . strtotime($data['ReserveTime']) . "' AND OrganID = '{$data['OrganID']}'");
            $data['ReserveNum'] = date('ymd', strtotime($data['ReserveTime'])) . sprintf("%04d", $count + 1);
        }
        $data['StartTime'] = strtotime($data['StartTime']);
        $data['ReserveTime'] = strtotime($data['ReserveTime']);
        $model->attributes = $data;
        $model->UpdateTime = time();
        $model->save();
        echo 1;exit;
    }

    /*
     * 计算两个日期相差月数
     */

    function getMonthNum($date1_stamp, $date2_stamp) {
        list($date_1['y'], $date_1['m']) = explode("-", date('Y-m', $date1_stamp));
        list($date_2['y'], $date_2['m']) = explode("-", date('Y-m', $date2_stamp));
        return abs($date_1['y'] - $date_2['y']) * 12 + $date_2['m'] - $date_1['m'];
    }

    /*
     * 根据车牌号查询预约登记信息
     */

    public function actionQueryreserveinfo() {
        $OrganID = Yii::app()->user->getOrganID();
        $LicensePlate = Yii::app()->request->getParam('LicensePlate');
        if (!isset($LicensePlate) || empty($LicensePlate)) {
            echo json_encode(array());
            Yii::app()->end();
        }
        $sql = "select DISTINCT jsr.LicensePlate, jsc.Car AS carname, jsc.Mileage, jsc.OwnerID, 
                jsr.Remark, jsc.BuyTime, jsc.Code, jsco.Name, jsco.Phone, jsc.ID 
                from jpd_service_car as jsc left join jpd_service_reserve as jsr on jsc.LicensePlate = jsr.LicensePlate
                left join jpd_service_car_owner as jsco on jsc.OwnerID = jsco.ID
                WHERE jsc.OrganID = '{$OrganID}' AND jsc.LicensePlate = '{$LicensePlate}' AND jsc.Status = 0 
                ORDER BY jsr.CreateTime DESC ";
        $data = Yii::app()->jpdb->createCommand($sql)->queryAll();
        $data[0]['StartTime'] = "";
        if ($data[0]['BuyTime']) {
            $data[0]['StartTime'] = date("Y-m-d", $data[0]['BuyTime']);
        }
        echo json_encode($data[0]);exit();
    }

    /*
     * 根据code搜索商品
     */

    public function actionSearchgoods() {
        $code = Yii::app()->request->getParam('code');
        $GoodsData = RPCClient::call('ReserveService_getGoodsData', array('code' => $code, 'rows' => 1000));
        return $this->renderPartial('goodsdialog', array('goodsdata' => $GoodsData));
    }

    /*
     * 生成采购单
     */

    public function actionAddpurchase() {
        if (!Yii::app()->request->isAjaxRequest) {
            exit;
        }
        $goodsIDarr = Yii::app()->request->getParam('goodsID');
        if (empty(array_filter($goodsIDarr))) {
            echo json_encode(array('result' => '0', "msg" => "请选择所需配件！"));
            exit;
        } else {
            $sql = 'insert into `pap_reserve_purchase` (GoodsID,Num,GcategoryCode,ReserveID,OrganID,CreateTime) values ';
            $gcategoryCodearr = Yii::app()->request->getParam('gcategoryCode');
            $numarr = Yii::app()->request->getParam('num');
            $reserveID = Yii::app()->request->getParam('reserveID');
            $OrganID = Yii::app()->user->getOrganID();
            $CreateTime = strtotime(date('Y-m-d'));
            foreach ($goodsIDarr as $key => $val) {
                if (empty($val))
                    continue;
                if ($numarr[$key] == 0) {
                    continue;
                }
                $insert .= "('$val','$numarr[$key]','$gcategoryCodearr[$key]','$reserveID','$OrganID','$CreateTime'),";
            }
            if (!isset($insert)) {
                echo json_encode(array('result' => '0', "msg" => "错误：配件数为0！"));
                exit;
            }
            $sql .= rtrim($insert, ',');
            $result = Yii::app()->papdb->createCommand($sql)->execute();
            echo json_encode(array('result' => '1', "msg" => $result));
            exit();
        }
    }

}
