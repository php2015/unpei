<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
Class PrivatemsgController extends Controller{
    
    public function actionIndex(){
        $this->pageTitle=Yii::app()->name."-聊天记录";
//        $page=!empty($_GET['page'])?$_GET['page']:1;
//        Yii::app()->session['page']=$page;
        $userid=Yii::app()->user->id;
        $res=ChatService::getSessionList($userid);
        $this->render('index',array('relativer'=>$res));
    }
    public function actionMsg(){
        if (Yii::app()->request->isAjaxRequest) {
//         $page=Yii::app()->session['page'];
//         $pagesize=10;
//         $page=$pagesize*($page-1);
         $touserid=Yii::app()->request->getParam('touserid');
         $sessionid=Yii::app()->request->getParam('sessionid');
         $params=array('touserid'=>$touserid,'sessionid'=>$sessionid);
         $organinfo=  ChatService::getuserinfo($touserid);
         $record=ChatService::lists($params);
//         $touser=Yii::app()->chatmongodb->getDbInstance()->record->find(array("sessionid" => $sessionid))->limit($pagesize)->skip($page);
//          if($touser){
//            foreach($touser as $k=>$value){
//              $datas[$k]=$value;
//            }
//        }
         $pageData=array(
             'total_rows'=>count($record),
             'list_rows'=>10,
             'page_name'=>'page',
             'ajax_func_name'=>'',
             'method'=>''
         );
         $page=new Pagination($pageData);
         $page=$page->show(1);
        }
        $this->renderPartial('msg',array('organinfo'=>$organinfo,'record'=>$record,'page'=>$page));
    }
    public function actionClosed(){
        $userid=Yii::app()->user->id;
        $res=ChatService::getSessionList($userid);
        $this->renderPartial('contact',array('relativer'=>$res));
    }
}

