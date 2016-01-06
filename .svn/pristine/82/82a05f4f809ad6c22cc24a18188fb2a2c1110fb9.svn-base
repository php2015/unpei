<?php

/*
 * 经销商客服设置
 */

class CsController extends Controller {

    //客服列表
    public function actionIndex() {
        $params['organID'] = Yii::app()->user->getOrganID();
        $lists = CsService::getcslists($params);
        $this->render('index', array('lists' => $lists));
    }

    //新建、编辑客服
    public function actionNew() {
        $params['organID'] = Yii::app()->user->getOrganID();
        $id = Yii::app()->request->getParam('id');
        if (Yii::app()->request->isAjaxRequest) {
            $params['Name'] = trim(Yii::app()->request->getParam('Name'));
            $params['QQ'] = trim(Yii::app()->request->getParam('QQ'));
            if ($id == null) {
                CsService::addcs($params);
            } else {
                $params['ID'] = $id;
                CsService::editcs($params);
            }
        } else {
            if ($id) {
                $params['id'] = $id;
                $params['check']=1;
                $datas = CsService::getcsinfo($params);
            } else {
                $sql = 'select count(*) as count from jpd_cs_qq where OrganID=' . $params['organID'];
                $count = Yii::app()->jpdb->createCommand($sql)->queryRow();
                if($count['count']==5)
                    throw new CHttpException(400);
            }
        }
        $this->render('add', array('datas' => $datas));
    }
    
    //删除客服
    public function actionDel(){
        if(Yii::app()->request->IsAjaxRequest){
            $id=Yii::app()->request->getParam('id');
            $count=  JpdCsQq::model()->deleteByPk($id);
            echo json_encode(array('res'=>$count));
        }
    }

}

?>
