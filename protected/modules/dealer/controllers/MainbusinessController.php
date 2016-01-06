<?php

/*
 * 主营信息管理
 */

class MainbusinessController extends Controller {

    //主营信息管理首页
    public function actionIndex() {
        $this->render('index', array('cpname' => MainbusinessService::organidgetcpname(), 'vehicle' => MainbusinessService::organidgetvehicle(), 'brand' => MainbusinessService::organidgetbrand()));
    }

    //添加主营品牌-页面
    public function actionAddbrand() {
        $this->render('addbrand');
    }

    //添加主营车系
    public function actionAddvehcle() {
        $result = MainbusinessService::dealeraddvehcle();
        if ($result['result'] == 1) {
            $rs = array('success' => 1, 'ID' => $result['ID']);
        } else {
            $rs = array('success' => 0, 'errorMsg' => $result['errorMsg']);
        }
        echo json_encode($rs);
    }

    //添加主营品类
    public function actionAddcpname() {
        $result = MainbusinessService::dealeraddcpname();
        if ($result['result'] == 1) {
            $rs = array('success' => 1, 'ID' => $result['ID']);
        } else {
            $rs = array('success' => 0, 'errorMsg' => $result['errorMsg']);
        }
        echo json_encode($rs);
    }

    //添加主营品牌-添加
    public function actionBrandadd() {
        $result = MainbusinessService::dealeraddbrand();
        if ($result['success'] == 1) {
            $organID = Yii::app()->user->getOrganID();
            Yii::app()->cache->delete("dealer_brand_ID_$organID");
            $rs = array('success' => 1, 'errorMsg' => '主营品牌添加成功', 'status' => 'add');
        } else {
            $rs = array('success' => 0, 'errorMsg' => $result['errorMsg'], 'status' => 'add');
        }
        $this->render('addresult', array('result' => $rs));
    }

    //主营品牌-修改保存
    public function actionBrandsave() {
        $result = MainbusinessService::dealereditbrand();
        if ($result['success'] == 1) {
            $organID = Yii::app()->user->getOrganID();
            Yii::app()->cache->delete("dealer_brand_ID_$organID");
            $rs = array('success' => 1, 'status' => 'edit');
        } else {
            $rs = array('success' => 0, 'status' => 'edit', 'errorMsg' => $result['errorMsg']);
        }
        $this->render('addresult', array('result' => $rs));
    }

    //删除主营车系
    public function actionDelvehcle() {
        $result = MainbusinessService::iddelvehcle();
        echo json_encode($result);
    }

    //删除主营品类
    public function actionDelcpname() {
        $result = MainbusinessService::iddelcpname();
        echo json_encode($result);
    }

    //删除主营品牌
    public function actionDelbrand() {
        $result = MainbusinessService::iddelbrand();
        if ($result == 'nonull') {
            $organID = Yii::app()->user->getOrganID();
            Yii::app()->cache->delete("dealer_brand_ID_$organID");
            $result = array('success' => 0, 'errorMsg' => '改品牌下面还有商品，无法删除');
        } else if ($result) {
            $result = array('success' => 1, 'errorMsg' => '主营品牌删除成功！');
        } else {
            $result = array('success' => 0, 'errorMsg' => '系统异常，主营品牌删除失败！');
        }
        echo json_encode($result);
    }

    //修改主营品牌
    public function actionEditbrand() {
        $info = MainbusinessService::idgetbrand();
        $this->render('editbrand', array('info' => $info));
    }

}

?>
