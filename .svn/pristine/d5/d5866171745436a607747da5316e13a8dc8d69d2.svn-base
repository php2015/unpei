<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class HomeController extends PapmallController {

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

    public function actionIndex() {
        $this->pageTitle = Yii::app()->name . '-商城首页';
        if (Yii::app()->user->isServicer()) {
            $menu = DefaultService::getmenu('修理厂菜单');
            $params['rootID'] = $menu['ID'];
            $navparams['rootID'] = $menu['ID'];
        } else {
            $this->redirect(array('/pap/sellerorder/index'));
        }
        $params["scope"] = "sliderbar"; //指定定查询范围
        //获取菜单数组
        $menuArr = FrontMenu::getChildMenu($params);
//        $navparams['scope']='sliderbar';
//        $navArr = FrontMenu::getChildMenu($navparams);
        $this->render("index", array('menuArr' => $menuArr));
    }

    public function getMainCategorys($parentID) {
        $cri = new CDbCriteria(array(
            'condition' => 'ParentID =' . $parentID . ' or ParentID <=> NULL and IsShow=1',
            'order' => 'SortOrder asc',
        ));
        $categorys = Gcategory::model()->findAll($cri);
        return $categorys;
    }

    //取大类
    protected function findChild($arr, $id) {
        $childs = array();
        foreach ($arr as $k => $v) {
            if ($v['ParentID'] == $id) {
                $childs[] = $v;
            }
        }
        return $childs;
    }

//取子类
    protected function findsub($rows) {
        foreach ($rows as $k => $v) {
            $childs[$k] = $v->attributes;
            $sub = $this->getMainCategorys($v['ID']);
            $childs[$k]['children'] = $sub;
        }
        return $childs;
    }

    //商城次数限制 - 1分钟十次 
    public function actionCheck() {
        $cookie = Yii::app()->request->getCookies();
        if ($cookie['mallcheckcode'] && $cookie['mallcheckcode']->value == 1) {
            echo json_encode(array('res' => 0, 'msg' => '请先验证'));
            exit;
        }
        $num = 10;        //规定次数
        $time_count = 60; //规定时间
        $time = $_SERVER['REQUEST_TIME'];
        $array = Yii::app()->session['mallquery'];
        if (empty($array)) {
            $array[] = $time;
            Yii::app()->session['mallquery'] = $array;
            //继续操作
            echo json_encode(array('res' => 1, 'msg' => '创建session'));
        } else {
            if (count($array) == $num) {
                $start_Time = $array[0];
                if ($time_count >= ($time - $start_Time)) {
                    //对时间进行判断，如果超过规定时间就返回错误信息，
                    $cookie = new CHttpCookie('mallcheckcode', 1);
                    $cookie->expire = time() + 60 * 60 * 24;  //有限期1个小时
                    Yii::app()->request->cookies['mallcheckcode'] = $cookie;
                    echo json_encode(array('res' => 0, 'msg' => '查询次数过多', 'first' => date("H:i:s", $start_Time), 'now' => date("H:i:s", $time), 'time' => count($array)));
                } else {
                    //如果没有超过时间，将数组删除第一个，并且将$time添加到末尾
                    array_shift($array);
                    array_push($array, $time);
                    Yii::app()->session['mallquery'] = $array;
                    //继续操作
                    echo json_encode(array('res' => 1, 'msg' => '时间未到,正在查询', 'first' => date("H:i:s", $start_Time), 'now' => date("H:i:s", $time), 'time' => count($array)));
                }
            } else {
                $array[] = $time;
                Yii::app()->session['mallquery'] = $array;
                //继续操作
                echo json_encode(array('res' => 1, 'msg' => '不到十条,正在查询', 'first' => date("H:i:s", $array[0]), 'now' => date("H:i:s", $time), 'time' => count($array)));
            }
        }
    }

    //查询车型的详细信息
    public function actionGetmodeldetail() {
        $modelId = Yii::app()->request->getParam('modelId');
        if (!$modelId) {
            return '';
            exit;
        }
        if ($modelId == 'all') {
            $modelPics = '';
        } else {
            //车型图片信息
            $sql = "select a.picId, a.title as picTitle, a.caption as picCaption, "
                    . " concat(TRIM('/' from picPath),'/',a.picName) as originPic"
                    . " from {{front_pic}} a right join {{front_model_pic}} b on a.picid = b.picid"
                    . " where b.modelid =" . $modelId
                    . " order by a.picNo";
            $modelParams = Yii::app()->jpdb->createCommand($sql)->queryAll();
            //图片URL加密
            $modelPics = $modelParams;
            $imageencode = Yii::app()->params['imgencode'];
            $imgserver = Yii::app()->params['imgserver'];
            for ($i = 0; $i < count($modelPics); $i++) {
                $vehiclepic = $modelPics[$i]['originPic'];
                $originpic = CommonUtil::generateImgUrl($vehiclepic, $imgserver, 'vehicle_origin');
                $smallpic = CommonUtil::generateImgUrl($vehiclepic, $imgserver, 'vehicle_small');
                $thumbpic = CommonUtil::generateImgUrl($vehiclepic, $imgserver, 'vehicle_thumb');
                $orgnsignurl = CommonUtil::encodeImgUrl($originpic, $imageencode);
                $smallsignurl = CommonUtil::encodeImgUrl($smallpic, $imageencode);
                $thumbsignurl = CommonUtil::encodeImgUrl($thumbpic, $imageencode);
                $modelPics[$i]['originPic'] = $orgnsignurl;
                $modelPics[$i]['smallPic'] = $smallsignurl;
                $modelPics[$i]['thumbPic'] = $thumbsignurl;
            }
        }
        if (empty($modelPics)) {
            exit;
        }
        $this->renderPartial('imagesgallery', array('car_picture' => $modelPics));
    }

    /*
     * 每日爆款
     */

    public function actionHot() {
        $this->pageTitle = Yii::app()->name . '-每日爆款';
        $carry = DealergoodsService::gethotgoods();
        if ($carry == 'false') {
            $this->redirect(array('index'));
        }
        $this->render('hot', array('GoodsInfo' => $carry));
    }

}
