<?php

class CommonController extends Controller {

    /**
     * Declares class-based actions.
     */
    public function actions() {
        return array(
            'captcha' => array(
                'class' => 'CCaptchaAction',
                'backColor' => 0xFFFFFF,
            ),
            'page' => array(
                'class' => 'CViewAction',
            ),
        );
    }

    //取子配件组列表
    function actionGetChildGroup(){
    	$groupPID = $_POST['groupPID'];
    	$groupID = $_POST['groupID'];
    	 
    	//查询该配件组
    	$partsGroupModel = RPCClient::call('CommonService_queryCorepartsGroup',array('groupPID'=>$groupID));
    
    	//显示列表
    	$this->renderPartial('groupselect', array('groupID' => $groupID,'groupPID' => $groupPID,'partsGroup' => $partsGroupModel));
    }
    
    //取配件组包含的配件列表
    function actionGetPartsByGroup() {
    	$groupID = $_POST['groupID'];
    
    	//查询该配件组
    	$partsModel = RPCClient::call('CommonService_queryCorepartsByGroup',array('groupID'=>$groupID));
    	 
    	//显示列表
    	$this->renderPartial('partsselect', array('parts' => $partsModel));
    }
    
    //取地区列表
    public function actionGetChildAdminArea() {
    	//检查参数
    	if(!isset($_POST["areaCode"]) || empty($_POST["areaCode"])){
    		$this->renderPartial('//common/areaselect');
    		exit;
    	}
    	//参数
    	$areaCode = $_POST['areaCode'];
    	$areaCodeHead = rtrim($areaCode,'0');
    	$areaCodeLike = '';
    	$hasChildren = '1';
    	//是否是直辖市
    	if(in_array($areaCodeHead, array('11','12','31','50'))){
    		$areaCodeLike = $areaCodeHead.'%';
    		$hasChildren = '0';
    	}else if(strlen($areaCodeHead) == 2){
			$areaCodeLike = $areaCodeHead.'%00';
    	}else if(strlen($areaCodeHead) == 4){
    		$areaCodeLike = $areaCodeHead.'%';
    	}
    	
    	//区域信息
    	$arealist = RPCClient::call('CommonService_queryAdminAreas',array('areaCode'=>$areaCode));

    	//显示列表
    	$this->renderPartial('areaselect', array('areas' => $arealist,'hasChildren' => $hasChildren));
    }
}