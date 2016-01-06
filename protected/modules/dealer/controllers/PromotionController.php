<?php

class PromotionController extends Controller {

    public $layout = "//layouts/dealer";

    public function actionIndex() {
        $progoods = $this->procount();
        $this->pageTitle = Yii::app()->name . '-' . "促销商品管理";
        $this->render('index', array('progoods' => $progoods));
    }
   
    /**
     * 获取未设置为促销的商品
     */
    public function actionGetnoprogoods() {
        $organID = Commonmodel::getOrganID();
        $criteria = new CDbCriteria();
        $criteria->select = "*";
        $criteria->condition = "IsPro = 0 and IsSale = 1 and ISdelete = 1 and t.OrganID = " . $organID;
        $thisvalue = trim($_GET['thisValue']);

        if (!empty($thisvalue)) {
            $criteria->condition = "  Name like '%{$thisvalue}%' OR Pinyin like '%{$thisvalue}%' ";
        }

        $count = DealerGoods::model()->count($criteria);
        $pages = new CPagination($count);

        $pages->pageSize = $_GET['rows'];
        $pages->applyLimit($criteria);
        $recmlistes = DealerGoods::model()->findAll($criteria);
        //$recmlistes = RecommendRecord::model()->findAll($criteria);
        //var_dump($recmlist->record->);
        $recommends = array();
        foreach ($recmlistes as $key => $recmlist) {
            $recommends[$key]['ID'] = $recmlist['ID'];
            $recommends[$key]['Name'] = $recmlist['Name'];
            $recommends[$key]['Pinyin'] = $recmlist['Pinyin'];
            $recommends[$key]['Brand'] = $recmlist['Brand'];
            $recommends[$key]['goodsBrand'] = $recmlist['Brand'];
            $recommends[$key]['GoodsNO'] = $recmlist['GoodsNO'];
            $recommends[$key]['OENO'] = $recmlist['OENO'];
            $recommends[$key]['PartsLevel'] = $recmlist['PartsLevel'];
            $recommends[$key]['Memo'] = $recmlist['Memo'];
            $recommends[$key]['Price'] = $recmlist['Price'];
//            $recommends[$key]['BigParts'] = DealerBigparts::getBigPartsName($recmlist['BigParts']);
//            $recommends[$key]['SubParts'] = DealerSubparts::getSubPartsName($recmlist['SubParts']);
            $recommends[$key]['CpName'] =$recmlist['CpNameTxt'];// DealerCpname::getCpName($recmlist['CpName']);
            // $recommends[$key]['sutecar'] = F::msubstr($this->getcar($recmlist['ID']));
            //$recommends[$key]['cpname'] = F::msubstr($this->getcpname($recmlist['ID']));
            //$recommends[$key]['sutecar'] = F::msubstr($this->getcar($recmlist['ID']));
        }
        $rs['total'] = $count;
        $rs['rows'] = $recommends; // $record;
        echo json_encode($rs);
    }

    /**
     * 获取促销的商品
     */
    public function actionGetprogoods() {
        $organID = Commonmodel::getOrganID();
        $criteria = new CDbCriteria();
        $criteria->select = "*";
        $criteria->order = "UpdateTime desc";
        $criteria->condition = "IsPro = 1 and IsSale = 1 and ISdelete = 1 and t.OrganID = " . $organID;

//        $count = DealerGoods::model()->count($criteria);
//        $pages = new CPagination($count);
//
//        $pages->pageSize = $_GET['rows'];
//        $pages->applyLimit($criteria);
        $recmlistes = DealerGoods::model()->findAll($criteria);
        //$recmlistes = RecommendRecord::model()->findAll($criteria);
        //var_dump($recmlist->record->);
        $recommends = array();
        foreach ($recmlistes as $key => $recmlist) {
            $recommends[$key]['ID'] = $recmlist['ID'];
            $recommends[$key]['Name'] = $recmlist['Name'];
            $recommends[$key]['Pinyin'] = $recmlist['Pinyin'];
            $recommends[$key]['Brand'] = $recmlist['Brand'];
            $recommends[$key]['goodsBrand'] = $recmlist['Brand'];
            $recommends[$key]['GoodsNO'] = $recmlist['GoodsNO'];
            $recommends[$key]['OENO'] = DealerGoods::getOENOSByGoodsID($recmlist['ID']);
            $recommends[$key]['PartsLevel'] = $recmlist['PartsLevel'];
         //   $recommends[$key]['Memo'] = $recmlist['Memo'];
            $recommends[$key]['Price'] = $recmlist['Price'];
            $recommends[$key]['ProPrice'] = $recmlist['ProPrice'];
            $recommends[$key]['CpName'] =$recmlist['CpNameTxt'] ;//Commonmodel::getCategory($recmlist['CpName']);
            ;
           //$recommends[$key]['cpname'] = F::msubstr($this->getcpname($recmlist['ID']));
           // $recommends[$key]['sutecar'] = F::msubstr(DealerGoods::getVehicleByGoodsID($recmlist['ID']));
            $recommends[$key]['proTime'] = date("Y-m-d", $recmlist['ProTime']) . '--' . date("Y-m-d", $recmlist['ProTime'] + 60 * 60 * 24 * 14);      // 促销时间
        }
//        $rs['total'] = $count;
        $rs['rows'] = $recommends; // $record;
//         $params = array(
//            'OrganID' => $organID,
//            'page' => $_GET['page'] == '' ? 1 : $_GET['page'],         // 第几页
//            'rows' =>  $_GET['rows'],
//            'IsPro' =>  1,
//            
//        );
//        $recommends = DealerGoods::getGoodsInfo($params);
//         $rs['total'] = $recommends[0]['count'];
//        $rs['rows'] = $recommends[0]['count'] == 0 ? array() : $recommends; // $record;
        echo json_encode($rs);
    }

    /**
     * 添加促销商品
     */
    public function actionAddpromotion() {
        $IDs = $_GET['IDs'];
        // updateAll(array('username'=>'11111','password'=>'11111'),'password=:pass',array(':pass'=>'111
        $count = DealerGoods::model()->updateAll(
                array(
            'IsPro' => 1,
            'UpdateTime' => time(),
            'ProTime' => time(),
                ), "ID IN ( " . $IDs . " )");
        if ($count > 0) {
             $procount = $this->procount();
            $rs = array('success' => 1, 'errorMsg' => "添加促销商品成功，请修改促销价！",'procount'=>$procount);
        } else {
            $rs = array('success' => 0, 'errorMsg' => "添加促销商品失败！");
        }

        echo json_encode($rs);
    }

    /**
     * 取消促销
     */
    public function actionCancelpro() {
        $id = $_POST['id'];
        $bool = DealerGoods::model()->updateByPk($id, array(
            'IsPro' => 0,
            'UpdateTime' => time(),
            'ProTime' => '',
            'ProPrice' => NULL,
                ));
        //   $bool = DealerGoods::model()->updateAll(array('IsPro' => 0, 'UpdateTime' => time()), "ID in (" . $id . ")");
        if ($bool) {
            $procount = $this->procount();
            $result = array('success' => 1, 'errorMsg' => '取消促销成功！','procount'=>$procount);
        } else {
            $result = array('success' => 0, 'errorMsg' => '取消促销失败！');
        }
        echo json_encode($result);
    }

    public function actionSavecell() {
        $ID = $_GET['ID'];
        $fieldName = $_GET['fieldName'];
        $change = $_GET['change'];

        $bool = DealerGoods::model()->updateByPk($ID, array(
            $fieldName => $change,
            'UpdateTime' => time(),
            'ProTime' => time(),
                ));
        echo $bool;
    }

    /**
     * 获取适用车系
     */
    private function getcar($goodsID) {
        $showvehicles = DealerParts::model()->findAll('pgoods_id=' . $goodsID);
        if (!empty($showvehicles)):
            foreach ($showvehicles as $showvehicle):
                $car .= GoodsBrand::getName($showvehicle['maincate']) . '-' . GoodsBrand::getCar($showvehicle['subcate']) . ';';
            endforeach;
        endif;
        return $car;
    }

    private function procount() {
        $organID = Commonmodel::getOrganID();
        $progoods = DealerGoods::model()->count(array("condition" => "IsPro = 1 and IsSale = 1 and ISdelete = 1 and t.OrganID = " . $organID));
        return $progoods;
    }

}

?>
