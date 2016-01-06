<?php

class MaintenanceController extends Controller {

    //public  $layout = 'application.modules.autodata.views.layouts.column4';
    public $layout = '//layouts/jpdata';

    //查询首页
    public function actionIndex() {
        $this->render('index');
    }

    /**
     * 养护周期查询-查询前市场车型养护知识
     */
    public function actionQueryFrontVehicleMaintenance() {
        //检查参数
        if (!isset($_POST['vehicleID']) || empty($_POST['vehicleID'])) {
            exit;
        }
        $vehicleID = $_POST['vehicleID'];
        //前市场车辆养护周期查询日志参数
        $userID = Yii::app()->user->id;
        //车型参数信息
        $vehicleModel = RPCClient::call('VehicleService_queryMtcVehicleDetail', array('vehicleMtcID' => $vehicleID));
        //车型保养周期知识信息
        $maintenanceModel = RPCClient::call('MaintenanceService_queryFrontVehicleMaintenanceinfo', array('vehicleID' => $vehicleID));
        //车型保养项目信息
        $maintenanceItemModel = RPCClient::call('MaintenanceService_queryFrontVehicleMaintenanceIteminfo', array('vehicleID' => $vehicleID));
        //车辆保养项目展示结果计算
        $maintenceHead = array();
        $maintenceLeft = array();
        $maintenceBody = array();
        if ($maintenanceModel && $maintenanceItemModel && count($maintenanceItemModel) > 0) {
            //表格头部
            $firstMileage = $maintenanceModel['FirstMileage'];
            $firstPeriod = $maintenanceModel['FirstPeriod'];
            $maintenceHead[0]['content'] = $firstMileage . "km/<br />" . $firstPeriod . "个月";
            $maintenceHead[0]['mileage'] = $firstMileage;
            $maintenceHead[0]['period'] = $firstPeriod;
            $secondMileage = $maintenanceModel['SecondMileage'];
            $secondPeriod = $maintenanceModel['SecondPeriod'];
            $intervalMileage = $maintenanceModel['IntervalMileage'];
            $intervalPeriod = $maintenanceModel['IntervalPeriod'];
            $mileageCount = $secondMileage;
            $periodCount = $secondPeriod;
            $headNum = 1;
            while ($mileageCount <= 200000 && $periodCount <= 120) {
                $maintenceHead[$headNum]['content'] = $mileageCount . "km/<br />" . $periodCount . "个月";
                $maintenceHead[$headNum]['mileage'] = $mileageCount;
                $maintenceHead[$headNum]['period'] = $periodCount;
                $mileageCount += $intervalMileage;
                $periodCount += $intervalPeriod;
                $headNum ++;
            }
            //表格中部
            for ($i = 0; $i < count($maintenanceItemModel); $i++) {
                $maintenceLeft[] = $maintenanceItemModel[$i]['ItemName'];
                $mileage = $maintenanceItemModel[$i]['Mileage'];
                $period = $maintenanceItemModel[$i]['Period'];
                $desc = $maintenanceItemModel[$i]['Desc'];
                $inFirst = $maintenanceItemModel[$i]['InFirst'];
                $inSecond = $maintenanceItemModel[$i]['InSecond'];
                if ($inFirst == '1') {
                    $maintenceBody[$i][0] = $desc;
                }
                if ($inSecond == '1') {
                    $maintenceBody[$i][1] = $desc;
                }
                for ($j = 2; $j < count($maintenceHead); $j++) {
                    if (empty($mileage) || empty($period)) {
                        $maintenceBody[$i][$j] = "";
                    } else if ($maintenceHead[$j]['mileage'] % $mileage == 0 || $maintenceHead[$j]['period'] % $period == 0) {
                        $maintenceBody[$i][$j] = $desc;
                    } else {
                        $maintenceBody[$i][$j] = "";
                    }
                }
            }
            //组合数据
            $maintenanceItem = array('head' => $maintenceHead, 'left' => $maintenceLeft, 'body' => $maintenceBody);
        }
        //车型易损件更换知识信息
        $wearpartModel = RPCClient::call('MaintenanceService_queryFrontVehicleWearpartinfo', array('vehicleID' => $vehicleID));
        //养护周期查询日志

        $logmantenanceinfo = array('vehicleID' => $vehicleID, 'userID' => $userID);
        try {
            $url = Yii::app()->controller->getRoute();
            //把ID转换成对应的车型主组,子组
            $params['main'] = D::querymainlog($vehicleID);
            //插入mongo日志
            $oper = F::getoperation($url, $info =='前市场车型查询', $params);
        } catch (Exception $ex) {
            
        }
        RPCClient::call('LogService_logUserQueryMaintenance', $logmantenanceinfo);
        //返回信息数组
        $model = array('vehicleID' => $vehicleID, 'vehicle' => $vehicleModel, 'maintenanceModel' => $maintenanceModel,
            'maintenanceItem' => $maintenanceItem, 'wearpartModel' => $wearpartModel);
        //返回页面
        $this->renderPartial('info', $model);
    }

}
