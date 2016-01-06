<?php

/*
 * 经销商发布报价单
 */

class QuotationController extends Controller {

    //报价单列表
    public function actionIndex() {
        $params = $_GET;
        $dataProvider = QuotationService::getquolists($params);
        $this->render('index', array('dataProvider' => $dataProvider));
    }

    //草稿箱
    public function actionDraft() {
        $params = $_GET;
        $params['ifsend'] = 1;
        $dataProvider = QuotationService::getquolists($params);
        $this->render('draft', array('dataProvider' => $dataProvider));
    }

    //新建报价单-选择服务店
    public function actionSelect() {
        $organID = Yii::app()->user->getOrganID();
        if (Yii::app()->request->isAjaxRequest) {
            $params = $_GET;
        } else {
            $quoid = Yii::app()->request->getParam('quoid');
            $sid = Yii::app()->request->getParam('sid');
            $edit = 0;
            $organparams['organID'] = $organID;
            $organparams['identity'] = 2;
            $dealer = QuotationService::getorganinfo($organparams);
            if ($sid) {
                $organparams['organID'] = $sid;
                $organparams['identity'] = 3;
                $service = QuotationService::getorganinfo($organparams);
                if ($service)
                    $edit = 1;
            }
        }
        $params['organID'] = $organID;
        $dataProvider = QuotationService::getservices($params);
        $this->render('select', array(
            'dealer' => $dealer,
            'dataProvider' => $dataProvider,
            'service' => $service,
            'edit' => $edit
        ));
    }

    //新建报价单-报价单方案页面(发送页面)
    public function actionQuoscheme() {
        $params['quoid'] = Yii::app()->request->getParam('quoid');
        $organparams['organID'] = Yii::app()->request->getParam('sid');
        $organparams['identity'] = 3;
        $service = QuotationService::getorganinfo($organparams);
        $schinfo = array();
        if ($params['quoid']) {
            $params['type'] = 1;
            $res = QuotationService::getschemelists($params);
            $schinfo = $res['schinfo'];
        }
        $this->render('quoscheme', array(
            'service' => $service,
            'schinfo' => $schinfo,
            'quoinfo' => $res['quoinfo']
        ));
    }

    //新建报价单-制定方案
    public function actionMakescheme() {
        $edit = 0;
        $params['sid'] = Yii::app()->request->getParam('sid');
        if (Yii::app()->request->isAjaxRequest) {
            $buy = InquiryService::getnulllists();
            $params['searchtype'] = Yii::app()->request->getParam('searchtype');
            $params['keyword'] = Yii::app()->request->getParam('keyword');
            $params['Make'] = Yii::app()->request->getParam('make');
            $params['Car'] = Yii::app()->request->getParam('car');
            $params['Year'] = Yii::app()->request->getParam('year');
            $params['Model'] = Yii::app()->request->getParam('model');
            $params['page'] = Yii::app()->request->getParam('page');
            $params['partslevel'] = Yii::app()->request->getParam('partslevel');
        } else {
            $organparams['organID'] = $params['sid'];
            $organparams['identity'] = 3;
            $service = QuotationService::getorganinfo($organparams);
            $organID = Yii::app()->user->getOrganID();
            $organparams['organID'] = $organID;
            $organparams['identity'] = 2;
            $dealer = QuotationService::getorganinfo($organparams);
            //是否编辑
            $editparams['schid'] = Yii::app()->request->getParam('schid');
            $editparams['quoid'] = Yii::app()->request->getParam('quoid');
            if ($editparams['schid'] && $editparams['quoid']) {
                //获取方案信息
                $schres = QuotationService::getschemedetails($editparams);
                $buy = $schres['buylist'];
                $edit = 1;
            } else {
                if ($editparams['schid'] == null && $editparams['quoid']) {
                    //查看已添加方案个数
                    $par['quoid'] = $editparams['quoid'];
                    $quo = QuotationService::getschemecount($par);
                    $dealer['Title'] = $quo['Title'];
                    $dealer['QuoSn'] = $quo['QuoSn'];
                    $edit = 2;
                }
                $buy = InquiryService::getnulllists();
            }
        }
        //获取商品列表
        $goodslist = QuotationService::getgoods($params);
        if (Yii::app()->request->isAjaxRequest) {
            $this->render('makescheme', array(
                'goodslist' => $goodslist,
                'buy' => $buy
            ));
        } else {
            //获取经销商最小交易金额
            $minturnover = QuotationService::getminturnover($organID);
            $this->render('makescheme', array(
                'service' => $service,
                'goodslist' => $goodslist,
                'buy' => $buy,
                'dealer' => $dealer,
                'edit' => $edit,
                'schinfo' => $schres['schinfo'],
                'minturnover' => $minturnover
            ));
        }
    }

    //新建报价单-保存报价单方案
    public function actionSavescheme() {
        $params['quoname'] = Yii::app()->request->getParam('quoname');
        $params['quosn'] = Yii::app()->request->getParam('quosn');
        $params['totalprices'] = Yii::app()->request->getParam('totalprices');
        $params['shipprices'] = 0;
        $params['quoprices'] = $params['totalprices'];
        $params['filename'] = Yii::app()->request->getParam('filename');
        $params['fileurl'] = Yii::app()->request->getParam('fileurl');
        $params['quoids'] = Yii::app()->request->getParam('quoids');
        $params['quoprice'] = Yii::app()->request->getParam('quoprice');
        $params['quonum'] = Yii::app()->request->getParam('quonum');
        $params['sid'] = Yii::app()->request->getParam('sid');
        $params['quoid'] = Yii::app()->request->getParam('quoid');
        $params['schid'] = Yii::app()->request->getParam('schid');
        if (!$params['schid']) {
            if ($params['quoid'])
                QuotationService::getschemecount(array('type' => 1, 'quoid' => $params['quoid']));
            QuotationService::newscheme($params);
        } else {
            //编辑报价单方案
            QuotationService::editscheme($params);
        }
    }

    //查看报价单详情
    public function actionViewquo() {
        $quoID = Yii::app()->request->getParam('quoID');
        $result = QuotationService::getschemelists(array('quoid' => $quoID, 'type' => 2));
        $schinfo = $result['schinfo'];
        $quoinfo = $result['quoinfo'];
        $organparams['organID'] = $quoinfo['ServiceID'];
        $organparams['identity'] = 3;
        $organparams['quoid'] = $quoID;
        $service = QuotationService::getorganinfo($organparams);
        $organparams['organID'] = $quoinfo['DealerID'];
        $organparams['identity'] = 2;
        $dealer = QuotationService::getorganinfo($organparams);
        $this->render('quodetails', array(
            'service' => $service,
            'schinfo' => $schinfo,
            'dealer' => $dealer,
            'quoinfo' => $quoinfo,
        ));
    }

    //删除报价单方案
    public function actionDelscheme() {
        if (Yii::app()->request->isAjaxRequest) {
            $schid = Yii::app()->request->getParam('schid');
            QuotationService::delscheme($schid);
        }
    }

    //发送报价单给服务店
    public function actionSendquo() {
        if (Yii::app()->request->isAjaxRequest) {
            $params=$_GET;
            if ($params['sid'] && $params['quoid'])
                QuotationService::sendquo($params);
        }
    }

    //取消报价单发送
    public function actionCancelquo() {
        if (Yii::app()->request->isAjaxRequest) {
            $params['quoid'] = Yii::app()->request->getParam('quoid');
            if ($params['quoid'])
                QuotationService::cancelquo($params);
        }
    }

    //搜索
    public function actionHotword() {
        $keyword = Yii::app()->request->getParam('keyword');
        if ($keyword) {
            $keyword = trim($keyword);
            $keyword = str_replace(' ', '%', $keyword);
            $keyword = strtoupper($keyword);
        }
        $address = Yii::app()->user->getOrganAddress();
        $sql = 'select DISTINCT( `value`) as title,length(`value`) as len,alias,`key`,`order` from `pap_search_word` where `key` like "%' . $keyword . '%"'
                . ' and ((`order`=1 and area=' . $address['Province'] . ') or (`order`=2)) '
                . ' order by `order`,len asc limit 0,10';
        $datas = Yii::app()->papdb->createCommand($sql)->queryAll();
        $lists = array();
        $header = '<div class="float_l autohide" style="width:70%">';
        $middle = '</div><div class="float_r autohide" style="width:29%">';
        $tail = '</span></div><div style="clear:both"></div>';
        foreach ($datas as $key => $val) {
            if ($val['order'] == 1) {
                //别名
                $keys = explode('/', $val['key']);
                foreach ($keys as $v) {
                    if (stripos($v, $keyword) !== false) {
                        $alias = explode(' ', $v);
                        $lists[] = array(
                            "val" => $val['title'],
                            "data" => $header . $alias[0] . $middle . '<span style="color:#f17400">' . $val['title'] . $tail);
                    }
                }
            } elseif ($val['order'] == 2) {
                //标准名称
                $lists[] = array(
                    "val" => $val['title'],
                    "data" => $header . $val['title'] . $middle . '<span style="color:#999">标准名称' . $tail);
            }
        }
        if (($count = count($lists)) > 10) {
            $lists = array_slice($lists, 0, 10);
        } elseif ($count < 10) {
            $count = 10 - $count;
            $organID = Yii::app()->user->getOrganID();
            $goodssql = 'select distinct `Name`,Pinyin from pap_goods '
                    . ' where IsSale=1 and ISdelete=1 and OrganID=' . $organID . ' and (`Name` like "%' . $keyword . '%" or Pinyin like "%' . $keyword . '%") limit ' . $count;
            $goodses = Yii::app()->papdb->createCommand($goodssql)->queryAll();
            foreach ($goodses as $goods) {
                $lists[] = array(
                    "val" => $goods['Name'],
                    "data" => $header . $goods['Name'] . $middle . '<span style="color:#999">商品名称' . $tail);
            }
        }
        echo json_encode($lists);
    }

    //附件下载
    public function actionImport() {
        $fileurl = Yii::app()->request->getParam('fileurl');
        $filename = Yii::app()->request->getParam('filename');
        if ($fileurl) {
            $file = Yii::app()->params['uploadPath'] . $fileurl;
            if (is_file($file)) {
                $ua = $_SERVER["HTTP_USER_AGENT"];
                $encoded_filename = urlencode($filename);
                $encoded_filename = str_replace("+", "%20", $encoded_filename);
                header('Content-Type: application/octet-stream');
                if (preg_match("/MSIE/", $ua) || preg_match("/Trident\/7.0/", $ua)) {
                    header('Content-Disposition: attachment; filename="' . $encoded_filename . '"');
                } else if (preg_match("/Firefox/", $ua)) {
                    header('Content-Disposition: attachment; filename*="utf8\'\'' . $filename . '"');
                } else {
                    header('Content-Disposition: attachment; filename="' . $filename . '"');
                }
                readfile($file);
                exit;
            } else {
                echo json_encode(array('fail' => "文件不存在或路径错误！"));
            }
        } else {
            echo json_encode(array('fail' => "文件不存在或路径错误！"));
        }
    }

    //保存编辑
    public function actionSaveedit() {
        $data = $_POST;
        $data['quoprices'] = $data['totalprices'];
        $data['shipprices'] = 0;
        if ($data['type'] == 1) {
            //报价单
            if ($data['quoid']&&$data['schid']) {
                //修改
                QuotationService::editscheme($data);
            } else {
                //新建
                QuotationService::newscheme($data);
            }
        } else {
            //询价单
            if ($data['schid']) {
                //修改
                InquiryService::editscheme($data);
            } else {
                //新建
                InquiryService::newscheme($data);
            }
        }
    }

}

?>
