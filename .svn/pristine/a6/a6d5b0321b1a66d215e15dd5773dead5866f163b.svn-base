<?php

class PartsController extends Controller {

    //模板层
    public $layout = '//layouts/jpdata';

    //public  $layout = 'application.modules.autodata.views.layouts.column1';
    //查询首页
    public function actionIndex() {
        $this->render('index');
    }

    /**
     * 配件组查询
     */
    public function actionPartChildGroups() {
        //检查参数
        if (!isset($_POST['modelId']) || empty($_POST['modelId'])) {
            echo json_encode(array());
            Yii::app()->end();
        }
        $groupId = empty($_POST['groupId']) ? 0 : $_POST['groupId'];
        $modelId = $_POST['modelId'];
        $partGroups = RPCClient::call('PartsService_queryChildGroups', array('modelId' => $modelId, 'groupId' => $groupId));
        echo json_encode($partGroups);
    }

    /**
     * 
     * 查询车型子组图片和配件列表信息
     */
    public function actionGroupInfo() {
        //检查参数
        if (!isset($_POST['modelId']) || empty($_POST['modelId'])) {
            Yii::app()->end();
        }
        if (!isset($_POST['groupId']) || empty($_POST['groupId'])) {
            Yii::app()->end();
        }
        $userId = Yii::app()->user->id;
        $modelId = Yii::app()->request->getParam('modelId');
        $groupId = Yii::app()->request->getParam('groupId');

        //用户车型权限检查,依据不同权限返回不同的数据
        //$hasPerm = Yii::app()->user->checkPermission(array('vehicleEpcID'=>$vehicleEpcID));
        $hasPerm = true;
        //子组信息
        $groupInfo = RPCClient::call('PartsService_queryGroupInfo', array('modelId' => $modelId, 'groupId' => $groupId, 'hasPerm' => $hasPerm));
        //图片URL加密
        if ($groupInfo) {
            $picture = trim($groupInfo['picture'], '/');
            $imgserver = Yii::app()->params['imgserver'];
            $imageencode = Yii::app()->params['imgencode'];
            $originpic = CommonUtil::generateImgUrl($picture, $imgserver, 'parts');
            $signurl = CommonUtil::encodeImgUrl($originpic, $imageencode);
            $groupInfo['picture'] = $signurl;
        }
        //配件列表信息
        $groupParts = RPCClient::call('PartsService_queryGroupParts', array('modelId' => $modelId, 'groupId' => $groupId, 'hasPerm' => $hasPerm));
        try {
            $url = Yii::app()->controller->getRoute();
            //把ID转换成对应的车型主组,子组
            $params['parts'] = D::querypvlog($modelId, $groupId);
            //插入mongo日志
            $oper = F::getoperation($url, $info == null, $params);
            //epc查询日志
            $loginfoArr = array('userId' => $userId, 'querytype' => 0, 'modelId' => $modelId, 'groupId' => $groupId);
            RPCClient::call('LogService_logQueryEpc', $loginfoArr);
        } catch (Exception $e) {
            
        }
        //返回页面
        $this->renderPartial('vehicleparts', array('groupInfo' => $groupInfo, 'groupParts' => $groupParts, 'modelId' => $modelId, 'hasPerm' => $hasPerm));
    }

    /**
     * 配件详细信息
     * 
     */
    public function actionPartInfo() {
        if (!isset($_POST['modelId']) || empty($_POST['modelId'])) {
            Yii::app()->end();
        }
        if (!isset($_POST['partId']) || empty($_POST['partId'])) {
            Yii::app()->end();
        }
        $userId = Yii::app()->user->id;
        $modelId = $_POST['modelId'];
        $partId = $_POST['partId'];
        //用户车型权限检查,如果没有权限则不返回相应的信息 	  
        //$hasPerm = Yii::app()->user->checkPermission(array('vehicleEpcID'=>$vehicleEpcID));
        $hasPerm = true;
        if (!$hasPerm) {
            $this->renderPartial('partsdetail', array('hasPerm' => false));
            Yii::app()->end();
        }
        //查询配件详情
        $partInfo = RPCClient::call('PartsService_queryPartInfo', array('partId' => $partId));
        //图片URL加密
        if ($partInfo) {
            $picture = trim($partInfo['picture'], '/');
            $imgserver = Yii::app()->params['imgserver'];
            $imageencode = Yii::app()->params['imgencode'];
            $originpic = CommonUtil::generateImgUrl($picture, $imgserver, 'parts');
            $signurl = CommonUtil::encodeImgUrl($originpic, $imageencode);
            $partInfo['picture'] = $signurl;
        }

        try {
            $url = Yii::app()->controller->getRoute();
            //把ID转换成对应的车型主组,子组
            $params['partsdetail'] = D::querypvdetailog($modelId,$partId);
            //插入mongo日志
            $oper = F::getoperation($url, $info == null, $params);
            //epc查询日志
            $loginfoArr = array('userId' => $userId, 'querytype' => 1, 'modelId' => $modelId, 'partId' => $partId);
            RPCClient::call('LogService_logQueryEpc', $loginfoArr);
        } catch (Exception $e) {
            
        }

        $this->renderPartial('partsdetail', array('part' => $partInfo, 'hasPerm' => true));
    }

    /**
     * 依据oe号搜索配件
     */
    public function actionSearchPartsByOeno() {

        if (!isset($_POST['oeno']) && empty($_POST['oeno'])) {

            Yii::app()->end();
        }
        if (strlen(str_replace('*', '', $_POST['oeno'])) < 3) {
            Yii::app()->end();
        }
        $oeno = Yii::app()->request->getparam('oeno');
        $makeId = Yii::app()->request->getparam('make');
        //查询配件
        $partslist = RPCClient::call('PartsService_queryPartsByOeno', array('oeno' => $oeno, 'makeId' => $makeId));
        try {
            $url = Yii::app()->controller->getRoute();
            //把ID转换成对应的车型主组,子组
            $params['partsoe'] = D::querypvoelog($oeno, $makeId);
            //插入mongo日志
            $oper = F::getoperation($url, $info == null, $params);
        } catch (Exception $ex) {
            
        }
        //返回结果
        $this->renderPartial('oenoresult', array('parts' => $partslist));
    }

    /**
     * 依据配件名称搜索配件
     */
    public function actionSearchPartsByPartname() {
        if (!isset($_POST['partname']) && empty($_POST['partname'])) {
            Yii::app()->end();
        }
        if (!isset($_POST['modelId']) || empty($_POST['modelId'])) {
            Yii::app()->end();
        }
        $partname = $_POST['partname'];
        $modelId = $_POST['modelId'];

        //查询配件
        $partslist = RPCClient::call('PartsService_queryPartsByPartname', array('partname' => $partname, 'modelId' => $modelId));
        try {
            $url = Yii::app()->controller->getRoute();
            //把ID转换成对应的车型主组,子组
            $params['partsname'] = D::querypvnamelog($partname, $modelId);
            //插入mongo日志
            $oper = F::getoperation($url, $info == null, $params);
        } catch (Exception $ex) {
            
        }
        //返回结果
        $this->renderPartial('partnameresult', array('parts' => $partslist));
    }

}
