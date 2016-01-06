<?php

/*
 * 经销商物流配送管理
 */

class LogisticsController extends Controller {

    //物流配送列表
    public function actionIndex() {
        $organID = Yii::app()->user->getOrganID();
        $lists = LogisticsService::getlists(array('organID' => $organID));
        $this->render('index', array('lists' => $lists));
    }

    //物流配送添加页面
    public function actionAdd() {
        $params['organID'] = Yii::app()->user->getOrganID();
        $logid = Yii::app()->request->getParam('logid');
        if (Yii::app()->request->isAjaxRequest) {
            $params['name'] = Yii::app()->request->getParam('name');
            $params['desc'] = Yii::app()->request->getParam('desc');
            $params['p'] = Yii::app()->request->getParam('p');
            $params['c'] = Yii::app()->request->getParam('c');
            $params['a'] = Yii::app()->request->getParam('a');
            if ($logid == null) {
                LogisticsService::addwuliu($params);
            }else{
                $params['logid']=$logid;
                LogisticsService::editwuliu($params);
            }
        }
        if ($logid) {
            $params['logid']=$logid;
            $datas=LogisticsService::getwuliuinfo($params);
            
        }
        $this->render('add', array('datas' => $datas));
    }
    
    //物流配送删除
    public function actionDel(){
        if(Yii::app()->request->isAjaxRequest){
            $logid = Yii::app()->request->getParam('logid');
            LogisticsService::delwuliu($logid);
        }
    }

}

?>
