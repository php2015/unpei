<?php

/*
 * 卖家商城首页
 * 经销商商城首页
 */

Class SellerstoreController extends PapmallController {
    /*
     * 经销商店铺
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

    public function actionIndex() {
        $this->pageTitle = Yii::app()->name . '-经销商店铺';
        $dealerid = Yii::app()->request->getParam('dealerid');
        $model = Organ::model()->findByPk($dealerid, "Identity=2");
        if (!$model) {
            $this->redirect(array('/pap/home/index'));
        }
        if (!isset($dealerid) || empty($dealerid)) {
            throw new CHttpException(404, 'Invalid request. Please do not repeat this request again.');
        }
        $orderGet = Yii::app()->request->getParam('order');
        $brandGet = Yii::app()->request->getParam('brand');
        $priceGet = Yii::app()->request->getParam('price');
        $skwd1 = urldecode(Yii::app()->request->getParam('skwd'));
        $skwd = MallService::checkKey($skwd1);
        $sub = Yii::app()->request->getParam('sub');
        $ispro = Yii::app()->request->getParam('ispro');
        $partslevel = Yii::app()->request->getParam('partslevel');

        //车型车系
        $cookie = Yii::app()->request->getCookies();
        //var_dump($cookie);
        $car['make'] = $cookie['mallmake']->value;
        $car['series'] = $cookie['mallseries']->value;
        $car['year'] = $cookie['mallyear']->value;
        $car['model'] = $cookie['mallmodel']->value;

        //获取商品品牌
        $brandparams['dealerid'] = $dealerid;
        $brandparams['type'] = 2;
        $brandparams['brand'] = $brandGet;
        $brandparams['sub'] = $sub;
        $brandparams['skwd'] = $skwd;
        $brandparams['car'] = $car;
        $brandModel = MallService::getDealerbrand($brandparams);
        //$brandModel = MallService::getBrand($brandparams);
        $brandData = $brandModel['data'];
        $brand = $brandModel['brand'];

        //价格区间
        $priceModel = MallService::getPrice(array('price' => $priceGet));
        $priceData = $priceModel['data'];
        $price = $priceModel['price'];

        //获得排序
        $orderData = $this->getOrder($orderGet);
        //获取url
        $get = $this->getSearchParams($_GET);
        $params = array(
            'order' => $orderData[0],
            'dealerid' => $dealerid, //经销商ID
            'skwd' => $skwd,
            'brand' => $brandGet,
            'price' => $price['cond'],
            'car' => $car,
            'sub' => $sub,
            'ispro' => $ispro,
            'rows' => 12,
            'resource' => "mall",
            'partslevel' => $partslevel,
            'type' => 3,
            'organID' => Yii::app()->user->getOrganID(),
        );
        //获取适用车型text
        //$carmodeltxt = MallService::getCarmodeltxt($car);
        //经销商店铺信息
        $seller = DefaultService::sellerstore($dealerid);
        //店铺积分
        $TotalScore = DefaultService::getrecord($dealerid);
        //获取大类名称
        if ($sub)
            $big = Gcategory::model()->findByPk($sub);
        //获取商品
        $goods = MallService::getGoodsData($params);
        $rows = $this->Getmaincate($dealerid);
        $cate = $this->findsub($rows);
        // var_dump($cate);exit;
        //底部分页
        //推荐商品
        //获取经销商客服列表
        $csparams['organID'] = $dealerid;
        $csparams['type'] = 1;
        $csinfo = CsService::getcslists($csparams);
        $data = array(
            'seller' => $seller,
            'csinfo' => $csinfo,
            'TotalScore' => $TotalScore,
            'dataProvider' => $goods['dataProvider'],
            'pages' => $this->getShortPage($goods["count"], $params['rows']),
            'dealerID' => $dealerid,
            'order' => $orderData,
            'get' => $get,
            'cate' => $cate,
            'displayType' => MallService::getDisplayType("seller_displayType"),
            //    'regoods' => $regoods['data'],
            'params' => array('brand' => $brand, 'price' => $price, 'ispro' => $ispro, 'partslevel' => $partslevel,),
            'brand' => $brandData, //商品品牌
            'price' => $priceData, //价格区间,
            'order' => $orderData, //排序数据
            //  'makecar' => $carmodeltxt,
            'bigid' => $big['ParentID'],
        );
        $this->render('index', $data);
    }

    protected function getShortPage($count, $rows = 10) {
        $criteria = new CDbCriteria();
        $pages = new CPagination($count);
        // 返回前一页
        $pages->pageSize = $rows;
        $pages->applyLimit($criteria);
        return $pages;
    }

    //获取经销商主营分类
    public function Getmaincate($organID) {

        $big = JpdOrganCpname::model()->findAll(array(
            'select' => 'DISTINCT BigpartsID,BigName',
            'condition' => 'OrganID=' . $organID
        ));
        return $big;
    }

    //取子类
    protected function findsub($rows) {
        foreach ($rows as $k => $v) {
            $childs[$k] = $v->attributes;
            $cri = new CDbCriteria(array(
                'condition' => 'ParentID =' . $v[BigpartsID] . ' and IsShow=1',
                'order' => 'SortOrder asc',
            ));
            $sub = Gcategory::model()->findAll($cri);
            $childs[$k]['children'] = $sub;
        }
        return $childs;
    }

    //排序类别
    public function getOrder($order) {
        switch ($order) {
            //销量升序
            case 'sales_h':$o[0] = 'sales_h';
                $o['class'][0] = 'li_current li_current_up';
                break;
            //价格降序
            case 'price_l':$o[0] = 'price_l';
                $o['class'][1] = 'li_current li_current_down';
                break;
            //价格升序
            case 'price_h':$o[0] = 'price_h';
                $o['class'][1] = 'li_current li_current_up';
                break;
            //评论数降序
            case 'comment_l':$o[0] = 'comment_l';
                $o['class'][2] = 'li_current li_comment_down';
                break;
            //评论数升序
            case 'comment_h':$o[0] = 'comment_h';
                $o['class'][2] = 'li_current li_comment_up';
                break;
            //上架时间降序
            case 'ctime_l':$o[0] = 'ctime_l';
                $o['class'][3] = 'li_current li_ctime_down';
                break;
            //上架时间升序
            case 'ctime_h':$o[0] = 'ctime_h';
                $o['class'][3] = 'li_current li_ctime_up';
                break;
            //默认销量降序
            default:$o[0] = 'sales_l';
                $o['class'][0] = 'li_current li_current_down';
        }
        $o['name'] = array(0 => '销量', 2 => '评论数');
        $o['order'][0] = $o[0] == 'sales_l' ? 'sales_h' : '';
//        $o['order'][1] = $o[0] == 'price_l' ? 'price_h' : 'price_l';
        $o['order'][2] = $o[0] == 'comment_l' ? 'comment_h' : 'comment_l';
//        $o['order'][3] = $o[0] == 'ctime_l' ? 'ctime_h' : 'ctime_l';
        return $o;
    }

    //url设置
    public function getUrlParams($dealerID, $order, $oeno) {
        $params = array();
        if ($dealerID) {
            $params['id'] = $dealerID;
        }
        if ($order && $order != 'sales_l')
            $params['order'] = $order;
//        if ($brand)
//            $params['brand'] = $brand;
//        if ($price)
//            $params['price'] = $price;
        if ($oeno)
            $params['oeno'] = $oeno;
        return $params;
    }

    /*
     * 获取分页条
     */

    public function getPagination($count, $pagesize, $page, $pageType = 1) {
        $pageData = array('total_rows' => $count,
            'now_page' => $page,
            'parameter' => '',
            'list_rows' => $pagesize,
            'page_name' => 'page',
            'ajax_func_name' => 'show',
            'method' => 'ajax');
        $page = new Pagination($pageData);
        return $page->show($pageType);
    }

    //获取url
    public function getSearchParams($parmas) {
        $res = array();
        foreach ($parmas as $k => $v) {
            if (!empty($v) && $k != 'page') {
                $res[$k] = $v;
            }
        }
        return $res;
    }

}
