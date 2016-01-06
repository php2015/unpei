<?php

class GoodsbrandController extends Controller {

    public $layout = '//layouts/maker';

    public function actionIndex() {
        $this->render('index');
    }

    public function actionIndexdata() {
        $criteria = new CDbCriteria;
        $criteria->select = '*'; //'BrandID,BrandName,Pinyin,Remarks';
        $criteria->order = 'CreateTime desc';
        $criteria->addCondition('OrganID='.Commonmodel::getOrganID());
        $res = MakeGoodsBrand::model()->findAll($criteria);
        $count = count($res);
        $page = new CPagination($count);
        $page->pageSize = $_GET['rows'];
        $page->applyLimit($criteria);
        $res = MakeGoodsBrand::model()->findAll($criteria);
        $data = array();
        if (is_array($res)) {
            foreach ($res as $key => $val) {
                $data[$key] = $val->attributes;
                $sQl='select count(b.goods_brand)as number from tbl_make_goods a,tbl_make_goods_version b where b.goods_brand='.$val->BrandID.' and b.organID='.$val->OrganID.' and a.IsSale=0 and a.ISdelete=0 and  a.NewVersion=b.version_name and a.id=b.goods_id';
                $query=Yii::app()->db->createCommand($sQl)->queryAll();
                $data[$key]['Number'] =$query[0]['number'];
            }
        }
        // var_dump($data);
        echo json_encode(array('total' => $count, 'rows' => $data ? $data : array()));
    }

    //增加修改品牌
    public function actionEdit() {
//        $error=MakeGoodsBrand::model()->find('BrandName='.$_POST['BrandName']);
//        if($error){
//            echo json_encode(array('errorMsg'=>'该品牌已存在'));
//            exit;
//        }
        $i = false;
        if ($_GET['BrandID']) {
            $result = MakeGoodsBrand::model()->findByPK($_GET['BrandID']);
            if ($result->BrandName == $_POST['BrandName']) {
                
            } else {
                $error = MakeGoodsBrand::model()->find('BrandName=:BrandName && OrganID=:OrganID', array(':BrandName' => $_POST['BrandName'],':OrganID'=>  Commonmodel::getOrganID()));
                if ($error) {
                    echo json_encode(array('errorMsg' => '该品牌已存在'));
                    exit;
                }
            }
            $_POST['UpdateTime'] = time();
            $app1 = MakeGoodsBrand::model()->updateByPk($_GET['BrandID'], $_POST);
            if ($app1)
                $i = true;
        }else {
            $error = MakeGoodsBrand::model()->find('BrandName=:BrandName && OrganID=:OrganID', array(':BrandName' => $_POST['BrandName'],':OrganID'=>  Commonmodel::getOrganID()));
            if ($error) {
                echo json_encode(array('errorMsg' => '该品牌已存在'));
                exit;
            }
            $app = new MakeGoodsBrand;
            $app->attributes = $_POST;
            $app->CreateTime = time();
            $app->OrganID = Commonmodel::getOrganID();
            $app->UserID = Yii::app()->user->id;
            $app2 = $app->save();
            if ($app2)
                $i = true;
        }
        echo json_encode(array('success' => $i, 'errorMsg' => $i > 0 ? '操作成功' : '操作失败'));
    }

    public function actionDel() {
        $result=0;
        if ($_POST['BrandIDs'])
            $str=','.$_POST['BrandIDs'].',';
            $app=  MakePromitBrand::model()->find('BrandName like "%'.$str.'%"');
            if($app){
                $errorMsg='该品牌已授权删除失败';
                echo json_encode(array('success' => false, 'errorMsg' =>$errorMsg));exit;
            }else{
                $result = MakeGoodsBrand::model()->deleteByPk($_POST['BrandIDs']);
                if($result>0){
                    $errorMsg='删除成功';
                }else{
                     $errorMsg='删除失败';
                }
                } 
        echo json_encode(array('success' => $result>0?true:false, 'errorMsg' =>$errorMsg));
    }
    
     public function actionGetpinyin() {
        $name = $_GET['name'];
        $pinyin = F::pinyin1($name);
        if ($pinyin) {
            echo json_encode($pinyin);
        } else {
            echo '';
        }
    }
}

?>
