<?php

/*
 * 促销商品管理
 */

class PromotionController extends Controller {

    public function actionIndex() {
        $this->pageTitle = Yii::app()->name . '-' . "促销商品列表";
        $progoods = $this->procount();
        $_GET['IsSale'] = 1;
        $params['IsPro'] = 5;
        $model = DealergoodsService::papgetgoods($params);
        $this->render('index', array('data' => $model['model']["dataProvider"], 'progoods' => $progoods,
            'cartext' => $model['car']));
    }

    /*
     * 添加促销商品 
     */

    public function actionAddpromotion() {
        $this->pageTitle = Yii::app()->name . '-' . "添加促销商品";
        $_GET['IsSale'] = 1;
        $params['IsPro'] = 2;
        $model = DealergoodsService::papgetgoods($params);
        $progoods = $this->procount();
        $noprogoods = $this->noprocount();
        $this->render('addpromotion', array('data' => $model['model']["dataProvider"], 'progoods' => $progoods,
            'noprogoods' => $noprogoods, 'cartext' => $model['car']));
    }

    /*
     * 设置促销价格(添加促销页面)
     */

    public function actionSetproprice() {
        $bool = DealergoodsService::setProgoodsprice();
        if ($bool) {
            $GoodsID = Yii::app()->request->getParam('ID');
            $redis = DealergoodsService::newgoodsxinfo($GoodsID);
            Yii::app()->redis->set('GoodsID' . $GoodsID, json_encode($redis));
            $rs = array('success' => 1, 'errorMsg' => '促销设置成功');
        } else {
            $rs = array('success' => 0, 'errorMsg' => '促销设置失败');
        }
        echo json_encode($rs);
    }

    /*
     * 修改促销价(促销列表页面)
     */

    public function actionEditpromotion() {
        $bool = DealergoodsService::editPro();
        if ($bool) {
            $GoodsID = Yii::app()->request->getParam('ID');
            $redis = DealergoodsService::newgoodsxinfo($GoodsID);
            Yii::app()->redis->set('GoodsID' . $GoodsID, json_encode($redis));
            $rs = array('success' => 1, 'errorMsg' => '促销价修改成功');
        } else {
            $rs = array('success' => 0, 'errorMsg' => '促销价修改失败');
        }
        echo json_encode($rs);
    }

    /*
     * 取消促销商品(促销列表页面)
     */

    public function actionDelpromotion() {
        $bool = DealergoodsService::delPro();
        if ($bool) {
            $procount = $this->procount();
            $GoodsID = Yii::app()->request->getParam('ID');
            $redis = DealergoodsService::newgoodsxinfo($GoodsID);
            Yii::app()->redis->set('GoodsID' . $GoodsID, json_encode($redis));
            $result = array('success' => 1, 'errorMsg' => '取消促销成功！', 'procount' => $procount);
        } else {
            $result = array('success' => 0, 'errorMsg' => '取消促销失败！');
        }
        echo json_encode($result);
    }

    /*
     * 批量取消促销价(促销列表页面)
     */

    public function actionDelallpro() {
        $bool = DealergoodsService::deletePro();
        if ($bool) {
            $rs = array('success' => 1, 'errorMsg' => '成功');
        } else {
            $rs = array('success' => 0, 'errorMsg' => '失败');
        }
        echo json_encode($rs);
    }

    /*
     * 获取修改弹框信息
     */

    public function actionEditgoodsinfo() {
        $ID = Yii::app()->request->getParam('ID'); //获取该商品的ID
        $model = PapGoods::model()->findByPk($ID);


        //商品品类表‘Code’ 等于经销商商品表 'StandCode'
        $rool = JPDGcategory::model()->find("Code=:Code", array(':Code' => $model['StandCode']));
        $data = $model->attributes;
        $data['StandCode'] = $rool['Name']; //把商品品类表Name值给data
        echo json_encode($data);
    }

    /*
     * 计算促销数量
     */

    private function procount() {
        $organID = Yii::app()->user->getOrganID();
        $progoods = PapGoods::model()->count(array("condition" => "IsPro = 1 and IsSale = 1 and ISdelete = 1 and t.OrganID = " . $organID));
        return $progoods;
    }

    /*
     * 计算上架未促销的商品
     */

    private function noprocount() {
        $organID = Yii::app()->user->getOrganID();
        $noprogoods = PapGoods::model()->count(array("condition" => "IsPro = 0 and IsSale = 1 and ISdelete = 1 and t.OrganID = " . $organID));
        return $noprogoods;
    }

    /*
     * 促销活动-活动结算-促销减免
     */

    public function actionMoneycount() {
//        var_dump($_GET);
//        exit;
        $this->pageTitle = Yii::app()->name . '-' . "活动结算";
        $data = PromotionService::Mprogetlist();
        $this->render('moneylist', array('promotionlist' => $data));
    }

    /*
     * 促销活动-活动结算-优惠券
     */

//    public function actionCouponcount() {
//        $data = PromotionService::Cprogetlist();
//        $this->render('couponlist', array('promotionlist' => $data));
//    }
    public function actiontime() {
//        echo date('W', strtotime('2014-12-29 0:0:0'));
//        echo strtotime('2015-W53');
        echo date('Y-m-d H:i:s', strtotime('2016-W01'));
    }

}

?>
