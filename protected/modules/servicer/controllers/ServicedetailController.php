<?php

class ServicedetailController extends PapmallController {

    /*
     * 经销商详细信息
     */

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
            unset($cookie['mallcheckcode']);
            unset(Yii::app()->session['mallquery']);
            echo json_encode(array('msg' => 'code success', 'success' => 1));
        } else {
            echo json_encode(array('msg' => 'code fail', 'success' => 2));
        }
    }
    
    public function actionDetail() {
        //$model = Dealer::model()->find("userID=:userID", array(":userID" => $_GET['dealer']));
        $organID = Yii::app()->request->getParam("dealer");
        $model = Organ::model()->with('dealer')->findByPK($organID);
        //主营品牌
        $brands = Brand::model()->findAll("OrganID = $organID");
        $data = array();
        foreach ($brands as $key => $brand) {
            $data[$key]['brandname'] = $brand['BrandName'];
        }
        //主营车系
        $dealerv = DealerVehicles::model()->findAll("OrganID=:userID", array(":userID" => $organID));
        //主营品类
        $cpnames = OrganCpname::model()->findAll('OrganID=:userID', array(':userID' =>$organID));
        // 机构照片
        $photosql = 'select * from `{{organ_photo}}` where OrganID=' . $organID;
        $organphotos = Yii::app()->jpdb->createCommand($photosql)->queryAll();
        $this->render("detail", array(
            'model' => $model,
            'organphotos' => $organphotos,
            'dealerv' => $dealerv,
            'showcpnames' => $cpnames,
            'data' => $data,
        ));
    }

}