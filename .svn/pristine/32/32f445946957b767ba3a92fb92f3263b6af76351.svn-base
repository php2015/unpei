<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

class MallController extends PapmallController {

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

    //商品列表页
    public function actionIndex() {
        $this->pageTitle = Yii::app()->name . '-' . "商品列表";
        $subGet = Yii::app()->request->getParam('sub');
        $codeGet = Yii::app()->request->getParam('code');
        $brandGet = Yii::app()->request->getParam('brand');
        $orderGet = Yii::app()->request->getParam('order');
        $priceGet = Yii::app()->request->getParam('price');
        $skwd1 = urldecode(Yii::app()->request->getParam('skwd'));
        $skwd = MallService::checkKey($skwd1);
        $type = Yii::app()->request->getParam('type');
        $ispro = Yii::app()->request->getParam('ispro');
        $partslevel = Yii::app()->request->getParam('partslevel');
        $dealerid = intval(Yii::app()->request->getParam('dealerid'));
        //车型车系
        $cookie = Yii::app()->request->getCookies();
        $car['make'] = $cookie['mallmake']->value;
        $car['series'] = $cookie['mallseries']->value;
        $car['year'] = $cookie['mallyear']->value;
        $car['model'] = $cookie['mallmodel']->value;

        //获得机构id
        $organID = Yii::app()->user->getOrganID();
        //联盟经销商id
        $union = MallService::getUnion($organID);

        //获取标准名称
        $key = 'mall_list_' . $subGet . '_' . $codeGet;
        $cateModel = Yii::app()->cache->get($key);
        if (!$cateModel) {
            $cateModel = MallService::getList(array('sub' => $subGet, 'code' => $codeGet));
            if (!$cateModel) {
                $this->redirect(array('/pap/home/index'));
            }
            Yii::app()->cache->set($key, $cateModel);
        }
        $sub = $cateModel['sub'];
        $code = $cateModel['code'];
        $choose = $cateModel['choose'];
        $category = $cateModel['data'];

        //获取商品品牌
        /* $brandModel = MallService::getBrand(array('sub' => $sub, 'code' => $code, 'brand' => $brandGet,
          'skwd' => $skwd, 'car' => $car, 'union' => $union));
          $brandData = $brandModel['data'];
          $brand = $brandModel['brand']; */

        //价格区间
        $priceModel = MallService::getPrice(array('price' => $priceGet));
        $priceData = $priceModel['data'];
        $price = $priceModel['price'];

        //获得排序
        $orderData = $this->getOrder($orderGet);


        //获取商品
        $param = array(
            'rows' => 12, 'sub' => $sub, 'code' => $code, 'skwd' => $skwd,
            'order' => $orderData[0], 'brand' => $brandGet, 'price' => $price['cond'],
            'page' => Yii::app()->request->getParam("page") ? Yii::app()->request->getParam("page") : 1,
            'car' => $car, 'ispro' => $ispro, 'resource' => "mall",
            'partslevel' => $partslevel,
            'organID' => $organID,
            'union' => $union
        );

        //经销商id
        if ($dealerid && $dealerid > 0) {
            $sql = "SELECT ID,OrganName FROM `jpd_organ` where UnionID=(select UnionID from jpd_organ where ID=$organID)"
                    . " and ID={$dealerid} and Identity=2";
            $res = Yii::app()->jpdb->createCommand($sql)->queryRow();
            if (!$res) {
                $param['dealerid'] = '-1';
            } else {
                $param['dealerid'] = $dealerid;
                $dealer = array('ID' => $dealerid, 'OrganName' => $res['OrganName']);
            }
        } else {
            $union = MallService::getUnion($organID);
            $param['union'] = $union;
        }
        $model = MallService::getGoodsData($param);


        //mongodb用户商品查询操作日志
        $url = 'pap/mall/index';
        $urlparams = $_GET;
        $goodsnum = $model['count'];
        $gd = F::goods_operation($url, $urlparams, $goodsnum);

        //获取一周销量排行
        //$weekSales = array(); //MallService::getWeekSales(array('sub' => $sub, 'code' => $code));
        //获取最新促销商品
        //$isprogoods = MallService::getisprogoods(array('sub' => $sub, 'code' => $code, 'car' => $car,));
        //获取url
        $get = $this->getSearchParams($_GET);
        //var_dump($model["dealerdata"]);die;
        $this->render('index', array(
            'params' => array('dealer' => $dealer, 'brand' => $brandGet, 'price' => $price, 'ispro' => $ispro, 'partslevel' => $partslevel),
            'get' => $get, //url
            'm' => $category, //标准名称
            'dataProvider' => $model['dataProvider'], //商品列表
            'weekSales' => $weekSales, //一周销售
            'choose' => $choose, //选择的字段
            'order' => $orderData, //排序数据
            'brand' => $model['branddata'], //商品品牌
            'isprogoods' => $isprogoods, //最新促销商品
            'price' => $priceData, //价格区间
            'displayType' => MallService::getDisplayType("glist_displaytype"),
            'pages' => $this->getShortPage($model["count"], $params['rows']),
            'dealer' => $model["dealerdata"], //经销商列表
        ));
    }

    //商品搜索列表页
    public function actionSearch() {
        //获取商品
        $this->pageTitle = Yii::app()->name . '-' . "商品搜索";
        $searchtype = Yii::app()->request->getParam('seatype');
        $keyword1 = Yii::app()->request->getParam('keyword');
        $keyword = MallService::checkKey($keyword1);
        $keyword = str_replace('/', ' ', $keyword);
        $keyword = str_replace('-', ' ', $keyword);
        $skwd1 = urldecode(Yii::app()->request->getParam('skwd'));
        $skwd = MallService::checkKey($skwd1);
        $subGet = Yii::app()->request->getParam('sub');
        $codeGet = Yii::app()->request->getParam('code');
        $brandGet = Yii::app()->request->getParam('brand');
        $dealerid = intval(Yii::app()->request->getParam('dealerid'));
        $orderGet = Yii::app()->request->getParam('order');
        $priceGet = Yii::app()->request->getParam('price');
        $ispro = Yii::app()->request->getParam('ispro');
        $partslevel = Yii::app()->request->getParam('partslevel');
        //你要找的是不是
        $keywordtwo = Yii::app()->request->getParam('keyword');
        if ($keywordtwo) {
            $keywordtwo = trim($keywordtwo);
            $keywordtwo = str_replace(' ', '%', $keywordtwo);
            $keywordtwo = strtoupper($keywordtwo);
        }
        $organID = Yii::app()->user->getOrganID();
        $organ = F::getOrgan($organID);
        $province = $organ['Province'];
        $sql = "select DISTINCT( `value`) as title,alias from `pap_search_word` where `key` like '%$keyword%' and `order`=1 and area=$province";
        $huoqq = Yii::app()->papdb->createCommand($sql)->queryAll();
        if (!empty($huoqq) && is_array($huoqq)) {
            foreach ($huoqq as $key => $val) {
                $title = $val['title'];
                $val['alias'] = str_replace($keywordtwo, "<span style='color:red'>$keywordtwo</span>", $val['alias']);
                $alias = $val['alias'];
                $huoqq[$key]['titles'] = $val['title'] . '/' . $alias;
                $huoqq[$key]['title'] = $val['title'];
            }
        }
        //车型车系
        $cookie = Yii::app()->request->getCookies();
        $car['make'] = $cookie['mallmake']->value;
        $car['series'] = $cookie['mallseries']->value;
        $car['year'] = $cookie['mallyear']->value;
        $car['model'] = $cookie['mallmodel']->value;

        //价格区间
        $priceModel = MallService::getPrice(array('price' => $priceGet));
        $priceData = $priceModel['data'];
        $price = $priceModel['price'];

        //获得排序
        $orderData = $this->getOrder($orderGet);
        $param = array(
            'rows' => 12, 'keyword' => $keyword, 'skwd' => $skwd, 'type' => 1,
            'page' => Yii::app()->request->getParam("page") ? Yii::app()->request->getParam("page") : 1,
            'brand' => $brandGet, 'price' => $price['cond'], 'order' => $orderData[0], //排序数据
            'code' => $codeGet, 'sub' => $subGet, 'car' => $car,
            'ispro' => $ispro, 'resource' => "mall",
            'partslevel' => $partslevel,
            'organID' => $organID,
            'searchtype' => $searchtype
        );
        //经销商id
        if ($dealerid && $dealerid > 0) {
            $sql = "SELECT ID,OrganName FROM `jpd_organ` where UnionID=(select UnionID from jpd_organ where ID=$organID)"
                    . " and ID={$dealerid} and Identity=2";
            $res = Yii::app()->jpdb->createCommand($sql)->queryRow();
            if (!$res) {
                $param['dealerid'] = '-1';
            } else {
                $param['dealerid'] = $dealerid;
                $dealer = array('ID' => $dealerid, 'OrganName' => $res['OrganName']);
            }
        } else {
            $union = MallService::getUnion($organID);
            $param['union'] = $union;
        }
        $model = MallService::getGoodsData($param);
        //mongodb用户商品查询操作日志
        $url = 'pap/mall/search';
        $urlparams = $_GET;
        $goodsnum = $model['count'];
        $gd = F::goods_operation($url, $urlparams, $goodsnum);
        $pages = $this->getShortPage($model["count"], $param['rows']);
        //var_dump($pages);exit;
        //获取url
        $get = $this->getSearchParams($_GET);
        $this->render('search', array(
            'dataProvider' => $model["dataProvider"],
            'pages' => $pages,
            'huoqq' => $huoqq,
            'displayType' => MallService::getDisplayType("allgoods_displayType"),
            'params' => array('dealer' => $dealer, 'brand' => $brandGet, 'price' => $price,
                'ispro' => $ispro, 'partslevel' => $partslevel),
            'get' => $get, //url
            'brand' => $model["branddata"], //商品品牌
            'dealer' => $model["dealerdata"], //经销商列表
            'price' => $priceData, //价格区间,
            'order' => $orderData, //排序数据
            'm' => $model["codedata"], //标准名称
        ));
    }

    //商品详情页
    public function actionDetail() {
        $serviceID = Yii::app()->user->getOrganID();
        $goodsid = Yii::app()->request->getParam('goods');
        $result = MallService::getredis($goodsid);
        //$payment = 1;
        //$result = MallService::getGoodByID($goodsid, $payment, 'mall');
        if ($result == 'null') {
            echo '<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />';
            echo "<script>alert('该商品不存在！');window.location.href='" . Yii::app()->createUrl('pap/mall/index') . "'</script>";
            exit;
        } else if ($result == 'nosale') {
            echo '<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />';
            echo "<script>alert('该商品已下架！');window.location.href='" . Yii::app()->createUrl('pap/mall/index') . "'</script>";
            exit;
        }

        $result['GoodsID'] = $result['ID'];
        $result['CommentNo'] = PapGoods::model()->findByPk($result['ID'])->attributes['CommentNo'];
        //商品折扣价
        if ($result['IsPro'] != 1) {
            $PriceRatio = MallService::getDisprice($result['OrganID'], $serviceID);
            if ($PriceRatio > 0 && $PriceRatio < 100) {
                $result['DisPrice'] = sprintf('%.2f', $result['Price'] * $PriceRatio / 100);
            }
        }

        $cookie = Yii::app()->request->getCookies();
        $car = array('make' => $cookie['mallmake']->value, 'series' => $cookie['mallseries']->value, 'year' => $cookie['mallyear']->value, 'model' => $cookie['mallmodel']->value);
        $carmodeltext = MallService::getCarmodeltxt($car);
        $res = array();
        if ($car['make'] && $car['series'] && $car['year'] && $car['model']) {
            $params = $car;
            $params['goodsid'] = $goodsid;
            $res = MallService::checkCarfit($params);
        }

        //店内分类
        $rows = $this->Getmaincate($result['OrganID']);
        $cate = $this->findsub($rows);

        //获取经销商客服列表
        $csparams['organID'] = $result['OrganID'];
        $csparams['type'] = 1;
        $csinfo = CsService::getcslists($csparams);

        //大类、子类、标准名称
        if (is_array($result['gcategory']) && !$result['gcategory']['BigName']) {
            $result['BigName'] = $result['gcategory']['BigName'];
            $result['SubName'] = $result['gcategory']['SubName'];
            $result['sub'] = $result['gcategory']['SubParts'];
        } else {
            $cpArr = MallService::getCategory($result['StandCode']);
            $result['BigName'] = $cpArr['BigParts'];
            $result['SubName'] = $cpArr['SubParts'];
            $result['sub'] = $cpArr['sub'];
        }

        //公告信息
        $model = new PapGoodsSendnotice;
        $sellerID = $result['OrganID'];
        $notice = $model->find("OrganID = $sellerID");
        //var_dump($data);die;
        //店家积分
        $result['TotalScore'] = DefaultService::getrecord($result['OrganID']);
        //店家信息
        $organInfo = Organ::model()->findByPk($result['OrganID'])->attributes;
        $result['Address'] = array(Area::getCity($organInfo['Province']), Area::getCity($organInfo['City']), Area::getCity($organInfo['Area']));

        $result['spec']['UnitName'] = GoodsUnit::model()->findByPk($result['spec']['Unit'])->attributes['UnitName']; //单位
        //最小交易金额
        $result['MinTurnover'] = PapOrderMinTurnover::model()->find("OrganID=:ID", array(":ID" => $result['OrganID']))->attributes['MinTurnover'];
        $this->pageTitle = Yii::app()->name . '-' . "商品详情";
        $this->render('detail', array('r' => $result, 'cate' => $cate, 'carmodeltext' => $carmodeltext, 'res' => $res, 'csinfo' => $csinfo, 'car' => $car, 'data' => $notice));
    }

    //获取车型
    public function actiongetvehicle() {
        $data = Yii::app()->request->getParam('data');
        $vehicle = MallService::getCarmodeltxt($data);
        $vehicle = explode(' ', $vehicle);
        $datas['make'] = $vehicle[0];
        $datas['car'] = $vehicle[1];
        $datas['year'] = $data['year'];
        $datas['model'] = $data['model'];
        echo json_encode($datas);
    }

    //排序类别
    public function getOrder($order) {
        switch ($order) {
            //销量降序
            case 'sales_l':$o[0] = 'sales_l';
                $o['class'][0] = 'li_current li_current_down';
                break;
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
            default:$o[0] = '';
                $o['class'][5] = 'li_current';
        }
        $o['name'] = array(5 => '默认', 0 => '销量', 2 => '评论数');
        $o['order'][0] = $o[0] == 'sales_l' ? 'sales_h' : 'sales_l';
        $o['order'][1] = $o[0] == 'price_l' ? 'price_h' : 'price_l';
        $o['order'][2] = $o[0] == 'comment_l' ? 'comment_h' : 'comment_l';
        $o['order'][3] = $o[0] == 'ctime_l' ? 'ctime_h' : 'ctime_l';
        return $o;
    }

    //url设置
    public function getUrlParams($sub, $code, $skwd, $order, $brand, $price, $type, $ispro, $partslevel) {
        $params = array();
        if ($sub)
            $params['sub'] = $sub;
        if ($code)
            $params['code'] = $code;
        if ($skwd && $skwd != '名称|编号|拼音|配件品类|OE号|品牌')
            $params['skwd'] = $skwd;
        if ($order && $order != 'sales_l')
            $params['order'] = $order;
        if ($brand)
            $params['brand'] = $brand;
        if ($price)
            $params['price'] = $price;
        if ($type)
            $params['type'] = $type;
        if ($ispro)
            $params['ispro'] = $ispro;
        if ($partslevel)
            $params['partslevel'] = $partslevel;
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

    //添加到购物车
    public function actionAddgoodstocar() {
        $goodsId = Yii::app()->request->getParam("goodsid");
        $quant = Yii::app()->request->getParam("quant");        //商品数量
        $locate = Yii::app()->request->getParam("locate");      //定位车型
        if ($quant) {
            $goodscount = $quant;
        } else {
            $goodscount = 1;
        }
        if (!$goodsId) {
            echo false;
        }
        $payment = 1;
        //通过商品ID获取商品信息
        $goods = MallService::getGoodByID($goodsId, $payment);
        if (!$goods) {
            echo false;
        }
        if ($goods["ProPrice"]) {   //促销价大于折扣价，则折扣价作为销售价存入购物车表
            $SellPrice = $goods["ProPrice"];
        } else if ($goods['DisPrice']) {
            $SellPrice = $goods["DisPrice"];
        } else {
            $SellPrice = $goods['Price'];
        }
        //定位车系
        $cookie = Yii::app()->request->getCookies();
        if ($locate) {
            $locate = explode('_', $locate);
            $make = $locate[0];
            $series = $locate[1];
            $year = $locate[2];
            $model = $locate[3];
        } else {
            $make = $cookie['mallmake']->value;
            $series = $cookie['mallseries']->value;
            $year = $cookie['mallyear']->value;
            $model = $cookie['mallmodel']->value;
        }
        //提出商品信息中需要加入购物车中的字段
        $params = array(
            "GoodsID" => $goodsId,
            //"GoodsOE" => $goods[0]["OENO"],
            "GoodsName" => $goods["Name"],
            "CpName" => $goods["CpName"],
            "GoodsNum" => $goods["GoodsNO"],
            "Brand" => $goods["BrandName"],
            "ImageUrl" => $goods['Images'][0]["ImageUrl"],
            "Price" => $goods["Price"], //参考价
            "ProPrice" => $SellPrice ? $SellPrice : $goods["Price"], //实际销售价（促销价/折扣价）
            //"ShipCost" => $goods[0]["LogisticsPrice"],
            "BuyerID" => Yii::app()->user->getOrganID(),
            "BuyerName" => Yii::app()->user->getOrganName(),
            "SellerID" => $goods["SellerID"],
            "SellerName" => $goods["OrganName"],
            "CreateTime" => time(),
            "UpdateTime" => time(),
            "Quantity" => $goodscount,
            "MakeID" => $make,
            "CarID" => $series,
            "Year" => $year,
            "ModelID" => $model
        );
        //var_dump($params);exit;
        echo MallService::addtocart($params);
    }

    //获得评价
    public function actionGeteva() {
        $goodsid = $_GET['goodsid'];
        $organid = $_GET['organid'];
        $page = $_GET['page'];
        $criteria = new CDbCriteria();
        //过滤有图片的评论
        if ($_GET['status'] == 'pic') {
            $sql = "select Group_Concat(DISTINCT EvalID) as eval FROM `pap_evaluation_goods_image` where GoodsID=$goodsid";
            $res = Yii::app()->papdb->createCommand($sql)->queryRow();
            if ($res && !is_null($res['eval'])) {
                $criteria->addCondition("ID in({$res['eval']})", "AND");
            } else {
                $criteria->addCondition("ID in('')", "AND");
            }
        }
        //评价好坏过滤
        else if ($_GET['status'] == 'good') {
            $criteria->addCondition("Status=1 ", "AND");
        } else if ($_GET['status'] == 'medium') {
            $criteria->addCondition("Status=2 ", "AND");
        } else if ($_GET['status'] == 'bad') {
            $criteria->addCondition("Status=3 ", "AND");
        }
        //评价有无内容过滤
        if ($_GET['content'] == 'content')
            $criteria->addCondition("BuyerToEvalRemark != '0' and BuyerToEvalRemark != '' ", "AND");
        //评价排序
        if ($_GET['orderby'] == 'orderID') {
            $criteria->order = "id DESC";
        } elseif ($_GET['orderby'] == 'ordertimeup') {
            $criteria->order = "CreateTime ASC";
        } elseif ($_GET['orderby'] == 'ordertimedrop') {
            $criteria->order = "CreateTime DESC";
        }

        $criteria->addCondition("t.GoodsID= " . $goodsid, "AND");
        $criteria->addCondition("t.OrganID= " . $organid, "AND");
        $criteria->addCondition("OrderID!=''", "AND");
//        $criteria->select = 't.*';
//        $criteria->join = "join pap_evaluation_goods_image b on t.ID=b.EvalID";
        //分页
        $count = PapEvaluationGoods::model()->count($criteria);
        $pages = new CPagination($count);
        $pages->pageSize = 5;
        $pages->applyLimit($criteria);
        $model = PapEvaluationGoods::model()->findAll($criteria);
        $data = array();
        $zi = 1500;
        foreach ($model as $key => $value) {
            $data[$key]['BuyerToEvalRemark'] = !empty($value["BuyerToEvalRemark"]) ? $value["BuyerToEvalRemark"] : '';
            $data[$key]['SellerToEvalRemark'] = $value["SellerToEvalRemark"];
            $data[$key]['BCreateTime'] = date("Y-m-d H:i:s", $value["CreateTime"]);
            $data[$key]['UpdateTime'] = date('Y-m-d H:i:s', $value['UpdateTime']);
            $sql = "select MakeID,CarID,Year,ModelID from pap_order_goods where OrderID={$value['OrderID']} and GoodsID={$value['GoodsID']}";
            $res = Yii::app()->papdb->createCommand($sql)->queryRow();
            $carstr = MallService::getCarmodeltxt(array('make' => $res['MakeID'], 'series' => $res['CarID'], 'year' => $res['Year'], 'model' => $res['ModelID']));
            $data[$key]['CarmodelText'] = $carstr ? $carstr : '无';
            //获得图片
            //   $goodsimg = OrganPhoto::model()->findAll("OrganID=:userID", array(":userID" => $userID));
            //  $data[$key]['GoodsIMG'] = $goodsimg[0]->Path;
            switch ($value['Status']) {
                case '2':$data[$key]['Eval'] = '中评';
                    break;
                case '3':$data[$key]['Eval'] = '差评';
                    break;
                default:$data[$key]['Eval'] = '好评';
                    break;
            }
            $data[$key]['BuyerID'] = $value["BuyerID"];
            $buyerinfo = Organ::model()->findByPk($value["BuyerID"]);
            $data[$key]['BuyerName'] = $buyerinfo->OrganName;
            $data[$key]['Grade'] = $buyerinfo->Grade;
            $data[$key]['zindex'] = $zi--;
            //信用等级
            $xylevel = EvaluateService::getpets($data[$key]['Grade']);
            if (empty($xylevel) || !$xylevel[0] || !$xylevel[1]) {
                $data[$key]['Xylv'] = "<div title='积分：暂无' style='color:#888;text-indent:0px;float:left'>暂无</div>";
            } else {
                $data[$key]['Xylv'] = '<div class="showlv" title = "积分：' . $data[$key]['Grade'] . '">' . str_repeat("<i class='buyer-level" . $xylevel[0] . "'></i>", $xylevel[1]) . '</div>';
            }
            //获取评论图片
            if ($value->image) {
                foreach ($value->image as $k => $v) {
                    $data[$key]['Picture'][$k]['ImageUrl'] = $v['ImageUrl'];
                }
            }
        }
        $rs['rows'] = $data;
        //获得分页
        $rs['page'] = $this->getPagination($count, $pages->pageSize, $page);
        echo json_encode($rs);
        yii::app()->end();
    }

    //获取买家信息
    public function actionGetBuyer() {
        if (Yii::app()->request->isAjaxRequest) {
            $buyerid = Yii::app()->request->getParam('buyerid');
            //获取买家信用统计
            $items = EvaluateService::getevainfo(3);
            $totalrow = array();
            if (!empty($items)) {
                foreach ($items as $k => $v) {
                    $servicescore = EvaluateService::getevalservice(array('OrganID' => $buyerid, 'm' => $k));
                    //   $totalnum = $servicescore['3'] + $servicescore['2'] + $servicescore['1'];
                    $totalrow[$k][0] = $v;
                    $totalrow[$k][1] = $servicescore['3'];
                    $totalrow[$k][2] = $servicescore['2'];
                    $totalrow[$k][3] = $servicescore['1'];
//                    $totalrow[$k][1] = $totalnum ? floor($servicescore['3'] * 100 / $totalnum) : '0';
//                    $totalrow[$k][2] = $totalnum ? floor($servicescore['2'] * 100 / $totalnum) : '0';
//                    $totalrow[$k][3] = $totalnum ? floor($servicescore['1'] * 100 / $totalnum) : '0';
                }
            }
            $total = EvaluateService::getevalservice(array('OrganID' => $buyerid));
            $totalall = $total['3'] + $total['2'] + $total['1'];
            $praise = $totalall ? sprintf('%0.1f', $total['3'] * 100 / $totalall) : 0;
            $jdt = EvaluateService::getJdtCss($praise);
            echo json_encode(array('jdt' => array('jdt' => $jdt, 'rate' => $praise), 'row' => $totalrow));
        }
    }

    public function getSearchParams($parmas) {
        $res = array();
        foreach ($parmas as $k => $v) {
            if (!empty($v) && $k != 'page')
                $res[$k] = $v;
        }
        return $res;
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

    //检测车型是否适用
    public function actionCheckcarfit() {
        $res = MallService::checkcarfit($_POST['data']);
        echo json_encode($res);
    }

    //cookie存储适用车型
    public function actionSetCarModel() {
        $car['make'] = Yii::app()->request->getParam('make');
        $car['series'] = Yii::app()->request->getParam('series');
        $car['year'] = Yii::app()->request->getParam('year');
        $car['model'] = Yii::app()->request->getParam('model');
        $car = MallService::setCarModel($car);
    }

    //删除适用车型cookie 
    public function actionClearCarModel() {
        $cookie = Yii::app()->request->getCookies();
        unset($cookie['mallmake'], $cookie['mallseries'], $cookie['mallyear'], $cookie['mallmodel']);
    }

    //热词搜索
    public function actionhotword() {
        $keyword = Yii::app()->request->getParam('keyword');
        if ($keyword) {
            $keyword = trim($keyword);
            $keyword = str_replace(' ', '%', $keyword);
            $keyword = strtoupper($keyword);
        }
        $organID = Yii::app()->user->getOrganID();
        $organ = F::getOrgan($organID);
        $province = $organ['Province'];
        $address = Yii::app()->user->getOrganAddress();
        $sql = 'select DISTINCT( `value`) as title,length(`value`) as len,alias,`key`,`order` from `pap_search_word` where `key` like "%' . $keyword . '%"'
                . ' and ((`order`=1 and area=' . $address['Province'] . ') or (`order`!=1)) '
                . ' order by `order`,len asc limit 0,10';
        $datas = Yii::app()->papdb->createCommand($sql)->bindParam(':keyword', $keyword)->queryAll();
        $lists = array();
        $header = '<div class="float_l" style="width：70%">';
        $middle = '</div><div class="float_r" style="width：30%">';
        $tail = '</sapn></div>';
        foreach ($datas as $key => $val) {
            if ($val['order'] == 1) {
                //别名
                $keys = explode('/', $val['key']);
                foreach ($keys as $v) {
                    if (stripos($v, $keyword) !== false) {
                        $alias = explode(' ', $v);
                        $lists[]['title'] = $header . $alias[0] . $middle . '<span style="color:#f17400" val="' . $val['title'] . '">' . $val['title'] . $tail;
                    }
                }
            } elseif ($val['order'] == 2) {
                //标准名称
                $lists[]['title'] = $header . $val['title'] . $middle . '<span style="color:#999" val="' . $val['title'] . '">标准名称' . $tail;
            } elseif ($val['order'] == 3) {
                //品牌         
                $lists[]['title'] = $header . $val['title'] . $middle . '<span style="color:#999" val="' . $val['title'] . '">品牌' . $tail;
            } elseif ($val['order'] == 4) {
                //标准名称+品牌
                $lists[]['title'] = $header . $val['title'] . $middle . '<span style="color:#999" val="' . $val['title'] . '">标准名称+品牌' . $tail;
            }
        }
        if (count($lists) > 10)
            $lists = array_slice($lists, 0, 10);
        echo json_encode(array('data' => $lists));
    }

    //检查经销商是否主营已选车系
    public function actionDealer() {
        $cookie = Yii::app()->request->getCookies();
        $dealerid = Yii::app()->request->getParam('dealerid');
        $params['Make'] = $cookie['mallmake']->value;
        $params['Car'] = $cookie['mallseries']->value;
        $params['Year'] = $cookie['mallyear']->value;
        $params['Model'] = $cookie['mallmodel']->value;
        //$car = InquiryService::getcarmodel($params);
        $sql = 'select ID from jpd_dealer_vehicles where OrganID=' . $dealerid . ' and MakeID ="' . $params['Make']
                . '" and (CarID="0" or CarID="' . $params['Car'] . '")';
        $res = Yii::app()->jpdb->createCommand($sql)->queryRow();
        if ($res) {
            echo json_encode(array('res' => 1));
        } else {
            echo json_encode(array('res' => 0));
        }
    }

    public function actionIssale() {
        $goodsid = Yii::app()->request->getParam('goodsid');
        $res = MallService::getunsale($goodsid);
        if ($res == 0) {
            echo json_encode(array('message' => '商品已下架'));
        }
    }

}

?>
