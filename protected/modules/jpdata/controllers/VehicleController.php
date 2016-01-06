<?php

class VehicleController extends Controller {

    public $layout = '//layouts/jpdata';

    //public  $layout = 'application.modules.autodata.views.layouts.column3';
    //查询首页
    public function actionIndex() {
        $this->render('index');
    }

    public function actionCode() {
        $this->render('code');
    }

    public function actions() {
        return array(
            'captcha' => array(
                'class' => 'CCaptchaAction',
                'minLength' => 4,
                'maxLength' => 4,
                'backColor' => 0xFFFFFF,
                'width' => 60,
                'height' => 40
            )
        );
    }

    //验证验证码
    public function actionCheckcode() {
        $codetxt = Yii::app()->request->getParam('code');
        $code = $this->createAction('captcha')->getVerifyCode();
        if (trim($codetxt) == $code) {
            $cookie = Yii::app()->request->getCookies();
            unset($cookie['checkcode']);
            unset(Yii::app()->session['frontmodelquery']);
            echo json_encode(array('msg' => 'code success', 'success' => 1));
        } else {
            echo json_encode(array('msg' => 'code fail', 'success' => 2));
        }
    }

    /**
     * EPC配件查询-厂家信息查询
     * @return [{"makeId":"",'name':""},{"makeId":"",'name':""}]
     */
    public function actionEpcMakes() {
        $epcMakes = RPCClient::call('VehicleService_queryEpcMakes');
        echo json_encode($epcMakes);
    }

    /**
     * EPC配件查询-依据整车厂家查询车系名称
     * @param make 车型Id
     * @return [{"seriesId":"",'name':""},{"seriesId":"",'name':""}]
     */
    public function actionEpcSeries() {
        //检查参数
        $make = Yii::app()->request->getParam('make');
        if (!$make) {
            echo json_encode(array());
            Yii::app()->end();
        }
        $epcSeries = RPCClient::call('VehicleService_queryEpcSeries', array('make' => $make));
        echo json_encode($epcSeries);
    }

    /**
     * EPC配件查询-依据整车厂家、车系查询车型年款
     * @param make 车型Id
     * @param series 车系Id
     * @return [{"year":""},{"year":""}]
     */
    public function actionEpcSeriesYears() {
        //检查参数
        $make = Yii::app()->request->getParam('make');
        $series = Yii::app()->request->getParam('series');
        if (!$make || !series) {
            echo json_encode(array());
            Yii::app()->end();
        }
        $epcSeriesYear = RPCClient::call('VehicleService_queryEpcSeriesYears', array('make' => $make, 'series' => $series));
        echo json_encode($epcSeriesYear);
    }

    /**
     * EPC配件查询-查询车型
     * @param make 车型Id
     * @param series 车系Id
     * @param year 年款
     * @return [{"modelId":"",'name':""},{"modelId":"",'name':""}]
     */
    public function actionEpcModels() {
        //检查参数
        $make = Yii::app()->request->getParam('make');
        $series = Yii::app()->request->getParam('series');
        $year = Yii::app()->request->getParam('year');
        if (!$make || !series) {
            echo json_encode(array());
            Yii::app()->end();
        }
        $epcModels = RPCClient::call('VehicleService_queryEpcModels', array('make' => $make, 'series' => $series, 'year' => $year));
        echo json_encode($epcModels);
    }

    /**
     *
     * 前市场车型查询-厂家信息查询
     * @return [{"makeId":"",'name':""},{"makeId":"",'name':""}]
     */
    public function actionFrontMakes() {
        $frontMakes = RPCClient::call('VehicleService_queryFrontMakes');
        echo json_encode($frontMakes);
    }

    /**
     * 前市场车型查询-依据整车厂家查询车系名称
     * @param make 车型Id
     * @return [{"seriesId":"",'name':""},{"seriesId":"",'name':""}]
     */
    public function actionFrontSeries() {
        //检查参数
        $make = Yii::app()->request->getParam('make');
        if (!$make) {
            echo json_encode(array());
            Yii::app()->end();
        }
        //$make = $_POST['make'];
        $frontSeries = RPCClient::call('VehicleService_queryFrontSeries', array('make' => $make));
        echo json_encode($frontSeries);
    }

    /**
     * 前市场车型查询-依据整车厂家车型查询车型年款
     * @param make 车型Id
     * @param series 车系Id
     * @return [{"year":""},{"year":""}]
     */
    public function actionFrontSeriesYears() {
        //检查参数
        $make = Yii::app()->request->getParam('make');
        $series = Yii::app()->request->getParam('series');
        if (!$make || !series) {
            echo json_encode(array());
            Yii::app()->end();
        }
        $frontSeriesYears = RPCClient::call('VehicleService_queryFrontSeriesYears', array('make' => $make, 'series' => $series));
        echo json_encode($frontSeriesYears);
    }

    /**
     * 前市场车型查询-依据整车厂家查询车型名称列表
     * @param make 车型Id
     * @param series 车系Id
     * @param year 年款
     * @return [{"modelId":"",'name':""},{"modelId":"",'name':""}]
     */
    public function actionFrontModels() {
        //检查参数
        $make = Yii::app()->request->getParam('make');
        $series = Yii::app()->request->getParam('series');
        $year = Yii::app()->request->getParam('year');
        if (!$make || !series) {
            echo json_encode(array());
            Yii::app()->end();
        }
        $frontModels = RPCClient::call('VehicleService_queryFrontModels', array('make' => $make, 'series' => $series, 'year' => $year));
        echo json_encode($frontModels);
    }

    /**
     * 前市场车型查询-依据车型编码查询车型
     * @param code 车型编码
     * @return [{"modelId":"","name":"","code":""},{"modelId":"",'name':"","code":""}]
     */
    public function actionFrontModelsByCode() {
        //检查参数
        $code = Yii::app()->request->getParam('code');
        if (!$code) {
            echo json_encode(array());
            Yii::app()->end();
        }
        $frontModels = RPCClient::call('VehicleService_queryFrontModelsByCode', array('code' => $code));
        echo json_encode($frontModels);
    }

    /**
     * 前市场车型查询-查询车型信息
     */
    public function actionFrontModelInfo() {
        //检查参数
        if (!isset($_POST['modelId']) || empty($_POST['modelId'])) {
            Yii::app()->end();
        }
        $modelId = $_POST['modelId'];

        //车型详细信息
        $frontModelDetail = $this->getFrontModelDetail($modelId);

        //前市场车型查询日志
        try {
            $url = Yii::app()->controller->getRoute();
            //把ID转换成对应的车型主组,子组
            $params['jpvehicle'] = D::queryfrontvelog($modelId);
            //插入mongo日志
            $oper = F::getoperation($url, $info == null, $params);
            $loginfo = array('modelId' => $modelId, 'userId' => Yii::app()->user->id);
            RPCClient::call('LogService_logFrontModelQuery', $loginfo);
        } catch (Exception $e) {
            
        }

        //返回页面
        $this->renderPartial('vehicledetail', $frontModelDetail);
    }

    //根据车型编码查询车型信息
    public function actionFrontCodeInfo() {
        //检查参数
        $code = trim(Yii::app()->request->getParam('code'));
        if (!$code) {
            echo json_encode(array());
            Yii::app()->end();
        }
        $frontModels = RPCClient::call('VehicleService_queryFrontModelsByCode', array('code' => $code));
        $modelId = $frontModels["modelId"];

        //车型详细信息
        $frontModelDetail = $this->getFrontModelDetail($modelId);

        //前市场车型查询日志
        try {
            $url = Yii::app()->controller->getRoute();
            //把ID转换成对应的车型主组,子组
            $params['vehiclecode'] = $code;
            //插入mongo日志
            $oper = F::getoperation($url, $info == null, $params);
            $loginfo = array('modelId' => $modelId, 'userId' => Yii::app()->user->id);
            RPCClient::call('LogService_logFrontModelQuery', $loginfo);
        } catch (Exception $e) {
            
        }

        //返回页面
        $this->renderPartial('vehicledetail', $frontModelDetail);
    }

    /**
     * 查询车型的详细信息
     */
    public function getFrontModelDetail($modelId) {
        //车型参数信息
        $modelParams = RPCClient::call('VehicleService_queryFrontModelParams', array('modelId' => $modelId));
        //车型图片信息
        $modelPics = RPCClient::call('VehicleService_queryFrontModelPics', array('modelId' => $modelId));
        //图片URL加密
        $imageencode = Yii::app()->params['imgencode'];
        $imgserver = Yii::app()->params['imgserver'];
        for ($i = 0; $i < count($modelPics); $i++) {
            $vehiclepic = $modelPics[$i]['originPic'];
            $originpic = CommonUtil::generateImgUrl($vehiclepic, $imgserver, 'vehicle_origin');
            $smallpic = CommonUtil::generateImgUrl($vehiclepic, $imgserver, 'vehicle_small');
            $thumbpic = CommonUtil::generateImgUrl($vehiclepic, $imgserver, 'vehicle_thumb');
            $orgnsignurl = CommonUtil::encodeImgUrl($originpic, $imageencode);
            $smallsignurl = CommonUtil::encodeImgUrl($smallpic, $imageencode);
            $thumbsignurl = CommonUtil::encodeImgUrl($thumbpic, $imageencode);
            $modelPics[$i]['originPic'] = $orgnsignurl;
            $modelPics[$i]['smallPic'] = $smallsignurl;
            $modelPics[$i]['thumbPic'] = $thumbsignurl;
        }
        //返回信息数组
        $modelDetail = array('modelId' => $modelId, 'modelParams' => $modelParams, 'modelPics' => $modelPics);
        return $modelDetail;
    }

    /**
     *
     * EPC配件搜索-厂家信息查询
     */
    public function actionEpcMakesWithPartname() {
        //检查参数
        if (!isset($_POST['partname']) || empty($_POST['partname'])) {
            echo json_encode(array());
            Yii::app()->end();
        }
        if (strlen($_POST['partname']) < 2) {
            echo json_encode(array());
            Yii::app()->end();
        }
        $partname = $_POST['partname'];
        $epcMakes = RPCClient::call('VehicleService_queryEpcMakesWithPartname', array('partname' => $partname));
        echo json_encode($epcMakes);
    }

    /**
     * EPC配件搜索-依据整车厂家查询车系名称
     */
    public function actionEpcSeriesWithPartname() {
        //检查参数
        if (!isset($_POST['make']) || empty($_POST['make'])) {
            echo json_encode(array());
            Yii::app()->end();
        }
        if (!isset($_POST['partname']) || empty($_POST['partname'])) {
            echo json_encode(array());
            Yii::app()->end();
        }
        $partname = $_POST['partname'];
        $makeId = $_POST['make'];
        $frontSeries = RPCClient::call('VehicleService_queryEpcSeriesWithPartname', array('makeId' => $makeId, 'partname' => $partname));
        echo json_encode($frontSeries);
    }

    /**
     * EPC配件搜索-依据整车厂家车型查询车型年款
     */
    public function actionEpcSeriesYearsWithPartname() {
        //检查参数
        if (!isset($_POST['make']) || empty($_POST['make'])) {
            echo json_encode(array());
            Yii::app()->end();
        }
        if (!isset($_POST['series']) || empty($_POST['series'])) {
            echo json_encode(array());
            Yii::app()->end();
        }
        if (!isset($_POST['partname']) || empty($_POST['partname'])) {
            echo json_encode(array());
            Yii::app()->end();
        }
        $partname = $_POST['partname'];
        $makeId = $_POST['make'];
        $seriesId = $_POST['series'];
        $epcSeriesYears = RPCClient::call('VehicleService_queryEpcSeriesYearsWithPartname', array('makeId' => $makeId, 'seriesId' => $seriesId, 'partname' => $partname));
        echo json_encode($epcSeriesYears);
    }

    /**
     * EPC配件搜索-依据整车厂家查询车型名称列表
     */
    public function actionEpcModelsWithPartname() {
        //检查参数
        if (!isset($_POST['make']) || empty($_POST['make'])) {
            echo json_encode(array());
            Yii::app()->end();
        }
        if (!isset($_POST['series']) || empty($_POST['series'])) {
            echo json_encode(array());
            Yii::app()->end();
        }
        if (!isset($_POST['partname']) || empty($_POST['partname'])) {
            echo json_encode(array());
            Yii::app()->end();
        }
        $partname = $_POST['partname'];
        $makeId = $_POST['make'];
        $seriesId = $_POST['series'];
        $year = $_POST['year'];
        $epcModels = RPCClient::call('VehicleService_queryEpcModelsWithPartname', array('makeId' => $makeId, 'seriesId' => $seriesId, 'year' => $year, 'partname' => $partname));
        echo json_encode($epcModels);
    }

    /**
     *
     * 养护周期查询-厂家信息查询
     */
    public function actionQueryMtcMake() {
        $vehicleMake = RPCClient::call('VehicleService_queryMtcVehicleMake');
        echo json_encode($vehicleMake);
    }

    /**
     * 养护周期查询-依据整车厂家查询车系名称
     */
    public function actionQueryMtcCarByMake() {
        //检查参数
        if (!isset($_POST['make']) || empty($_POST['make'])) {
            Yii::app()->end();
        }
        $make = $_POST['make'];
        $vehicleCar = RPCClient::call('VehicleService_queryMtcVehicleCarByMake', array('make' => $make));
        echo json_encode($vehicleCar);
    }

    /**
     * 养护周期查询-依据整车厂家车型查询车型发动机
     */
    public function actionQueryMtcEngineByMake() {
        //检查参数
        if (!isset($_POST['make']) || empty($_POST['make'])) {
            Yii::app()->end();
        }
        if (!isset($_POST['car']) || empty($_POST['car'])) {
            Yii::app()->end();
        }
        $make = $_POST['make'];
        $car = $_POST['car'];
        $vehicleEngine = RPCClient::call('VehicleService_queryMtcVehicleEngineByMake', array('make' => $make, 'car' => $car));
        echo json_encode($vehicleEngine);
    }

    /**
     * 显示车型详情页面
     */
    public function actionShow() {
        //检查参数
        if (!isset($_GET["vehicleID"]) || empty($_GET["vehicleID"])) {
            $this->redirect(array('/vehicle/index'));
        }
        //参数
        $vehicleID = $_GET['vehicleID'];

        //车型详细信息
        $vehicleDetail = $this->getFrontVehicleDetail($vehicleID);

        //页面直接显示
        $vehicleDetail['isRedirect'] = true;

        $this->render('vehicledetail', $vehicleDetail);
    }

    //--goods--
    /**
     * GOODS配件查询-厂家信息查询
     * @return [{"makeId":"",'name':""},{"makeId":"",'name':""}]
     */
    public function actionGoodsMakes() {
        $goodsMakes = RPCClient::call('VehicleService_queryGoodsMakes');
        echo json_encode($goodsMakes);
    }

    /**
     * GOODS配件查询-依据整车厂家查询车系名称
     * @param make 车型Id
     * @return [{"seriesId":"",'name':""},{"seriesId":"",'name':""}]
     */
    public function actionGoodsSeries() {
        //检查参数
        $make = Yii::app()->request->getParam('make');
        if (!$make) {
            echo json_encode(array());
            Yii::app()->end();
        }
        $goodsSeries = RPCClient::call('VehicleService_queryGoodsSeries', array('make' => $make));
        echo json_encode($goodsSeries);
    }

    /**
     * GOODS配件查询-依据整车厂家查询车系名称-关联主营车系
     * @param make 车型Id
     * @return [{"seriesId":"",'name':""},{"seriesId":"",'name':""}]
     */
    public function actionGoodsSerieself() {
        //检查参数
        $make = Yii::app()->request->getParam('make');
        if (!$make) {
            echo json_encode(array());
            Yii::app()->end();
        }
        $goodsSeries = RPCClient::call('VehicleService_queryGoodsSerieself', array('make' => $make));
        echo json_encode($goodsSeries);
    }

    /**
     * GOODS配件查询-依据整车厂家、车系查询车型年款
     * @param make 车型Id
     * @param series 车系Id
     * @return [{"year":""},{"year":""}]
     */
    public function actionGoodsSeriesYears() {
        //检查参数
        $make = Yii::app()->request->getParam('make');
        $series = Yii::app()->request->getParam('series');
        if (!$make || !series) {
            echo json_encode(array());
            Yii::app()->end();
        }
        $goodsSeriesYear = RPCClient::call('VehicleService_queryGoodsSeriesYears', array('make' => $make, 'series' => $series));
        echo json_encode($goodsSeriesYear);
    }

    /**
     * GOODS配件查询-查询车型
     * @param make 车型Id
     * @param series 车系Id
     * @param year 年款
     * @return [{"modelId":"",'name':""},{"modelId":"",'name':""}]
     */
    public function actionGoodsModels() {
        //检查参数
        $make = Yii::app()->request->getParam('make');
        $series = Yii::app()->request->getParam('series');
        $year = Yii::app()->request->getParam('year');
        if (!$make || !series) {
            echo json_encode(array());
            Yii::app()->end();
        }
        $goodsModels = RPCClient::call('VehicleService_queryGoodsModels', array('make' => $make, 'series' => $series, 'year' => $year));
        echo json_encode($goodsModels);
    }

    public function actiongoodsYear() {
        $seriesId = $make = Yii::app()->request->getParam('seriesId');
        $sql = "select distinct Year as year FROM {{front_model}} a where seriesid =" . $seriesId . " order by year asc";
        $models = Yii::app()->jpdb->createCommand($sql)->queryAll();
        $year = array();
        $new_models = array();
        $new_models[0] = $seriesId;
        foreach ($models as $key => $value) {
            $sqln = "select sum(t.Number) as number from {{front_model}} a left outer join {{number_goods}} t  on a.ModelID=t.ReID and t.Type=2 where a.seriesid=" . $seriesId . " and Year=" . $value['year'];
            $sum = Yii::app()->jpdb->createCommand($sqln)->queryAll();
            $new_models[$key + 1]["year"] = $value['year'];
            $new_models[$key + 1]["number"] = $sum[0]['number'];
        }
        echo json_encode($new_models);
    }

    public function actiongoodsYearModels() {
        $seriesId = $make = Yii::app()->request->getParam('seriesId');
        $year = Yii::app()->request->getParam('year');
        $sql = "select a.modelid as modelId, a.name as name, a.ename as ename, a.year as year, a.code as code,t.Number as number FROM {{front_model}} a left outer join {{number_goods}} t on a.ModelID=t.ReID and t.Type=2 where seriesid =" . $seriesId . " and year ='" . $year . "'";
        $models = Yii::app()->jpdb->createCommand($sql)->queryAll();
//        $year = array();
        $new_models = array();
        foreach ($models as $key => $value) {
            $new_models[$key]['modelId'] = $value['modelId'];
            $new_models[$key]['name'] = $value['name'];
            $new_models[$key]['year'] = $value['year'];
            $new_models[$key]['ename'] = $value['ename'];
            $new_models[$key]['code'] = $value['code'];
            $new_models[$key]['number'] = $value['number'];
        }
        echo json_encode($new_models);
    }

    //前市场查询次数限制 - 1分钟十次 
    public function actionCheck() {
        $cookie = Yii::app()->request->getCookies();
        if ($cookie['checkcode'] && $cookie['checkcode']->value == 1) {
            echo json_encode(array('res' => 0, 'msg' => '请先验证'));
            exit;
        }
        $num = 10;        //规定次数
        $time_count = 60; //规定时间
        $time = $_SERVER['REQUEST_TIME'];
        $array = Yii::app()->session['frontmodelquery'];
        if (empty($array)) {
            $array[] = $time;
            Yii::app()->session['frontmodelquery'] = $array;
            //继续操作
            echo json_encode(array('res' => 1, 'msg' => '创建session'));
        } else {
            if (count($array) == $num) {
                $start_Time = $array[0];
                if ($time_count >= ($time - $start_Time)) {
                    //对时间进行判断，如果超过规定时间就返回错误信息，
                    $cookie = new CHttpCookie('checkcode', 1);
                    $cookie->expire = time() + 60 * 60 * 24;  //有限期1个小时
                    Yii::app()->request->cookies['checkcode'] = $cookie;
                    echo json_encode(array('res' => 0, 'msg' => '查询次数过多', 'first' => date("H:i:s", $start_Time), 'now' => date("H:i:s", $time), 'time' => count($array)));
                } else {
                    //如果没有超过时间，将数组删除第一个，并且将$time添加到末尾
                    array_shift($array);
                    array_push($array, $time);
                    Yii::app()->session['frontmodelquery'] = $array;
                    //继续操作
                    echo json_encode(array('res' => 1, 'msg' => '时间未到,正在查询', 'first' => date("H:i:s", $start_Time), 'now' => date("H:i:s", $time), 'time' => count($array)));
                }
            } else {
                $array[] = $time;
                Yii::app()->session['frontmodelquery'] = $array;
                //继续操作
                echo json_encode(array('res' => 1, 'msg' => '不到十条,正在查询', 'first' => date("H:i:s", $array[0]), 'now' => date("H:i:s", $time), 'time' => count($array)));
            }
        }
    }

}
