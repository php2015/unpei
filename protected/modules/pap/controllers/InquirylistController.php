<?php

/*
 * 经销商收到的询价单
 */

class InquirylistController extends Controller {

    //询价单列表页
    public function actionIndex() {
        $params['status'] = Yii::app()->request->getParam('status');
        $params['no'] = Yii::app()->request->getParam('no');
        $params['start'] = Yii::app()->request->getParam('start');
        $params['end'] = Yii::app()->request->getParam('end');
        //获取询价单列表
        $inqlists = InquiryService::getinqlists($params);
        $this->render('index', array('inqlists' => $inqlists));
    }

    //询价单方案页
    public function actionScheme() {
        $params['inqid'] = Yii::app()->request->getParam('inqid');
        //获取询价单信息
        $inqres = InquiryService::getinqinfo($params['inqid']);
        //查询是否已经发送报价单
        $params['type'] = 2;
        $quoid = InquiryService::ifsendquo($params);
        if ($quoid) {
            //获取报价单方案
            $schparams['quoid'] = $quoid;
            $schparams['type'] = 3;
            $res = QuotationService::getschemelists($schparams);
        }
        $this->render('scheme', array(
            'inqres' => $inqres,
            'schinfo' => $res['schinfo'],
            'quoinfo' => $res['quoinfo']
        ));
    }

    //制作询价单方案
    public function actionMakescheme() {
        $inqid = Yii::app()->request->getParam('inqid');
        //获取询价单发送方id
        $params['sid'] = InquiryService::getinq_sid($inqid);
        $edit = 0;
        if (Yii::app()->request->isAjaxRequest) {
            $buy = InquiryService::getnulllists();
            $params['searchtype'] = Yii::app()->request->getParam('searchtype');
            $params['keyword'] = Yii::app()->request->getParam('keyword');
            $params['standcode'] = Yii::app()->request->getParam('standcode');
            $params['Make'] = Yii::app()->request->getParam('make');
            $params['Car'] = Yii::app()->request->getParam('car');
            $params['Year'] = Yii::app()->request->getParam('year');
            $params['Model'] = Yii::app()->request->getParam('model');
            $params['page'] = Yii::app()->request->getParam('page');
            if ($params['Make'] && $params['standcode'])
                $params['rows'] = 5;
            $params['partslevel'] = Yii::app()->request->getParam('partslevel');
        } else {
            $this->pageTitle = Yii::app()->name . ' - 报价单 -选择商品';
            $inqres = InquiryService::getinqinfo($inqid);
            if ($inqres['baseinfo']['Make']) {
                $params['Make'] = $inqres['baseinfo']['Make'];
                $params['Car'] = $inqres['baseinfo']['Car'];
                $params['Year'] = $inqres['baseinfo']['Year'];
                $params['Model'] = $inqres['baseinfo']['Model'];
            }
            //获取经销商信息
            $organID = Yii::app()->user->getOrganID();
            $organparams['organID'] = $organID;
            $organparams['identity'] = 2;
            $dealer = QuotationService::getorganinfo($organparams);
            //是否编辑
            $editparams['schid'] = Yii::app()->request->getParam('schid');
            $getquoid['type'] = 2;
            $getquoid['inqid'] = $inqid;
            $editparams['quoid'] = InquiryService::ifsendquo($getquoid);
            if ($editparams['schid']) {
                //获取方案信息
                $schres = QuotationService::getschemedetails($editparams);
                $buy = $schres['buylist'];
                $edit = 1;
            } else {
                if ($editparams['schid'] == null && $editparams['quoid']) {
                    //查看已添加方案个数
                    $quo = QuotationService::getschemecount(array('quoid' => $editparams['quoid']));
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
                'inqres' => $inqres,
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
        $params['inqid'] = Yii::app()->request->getParam('inqid');
        $params['schid'] = Yii::app()->request->getParam('schid');
        if (!$params['schid'])
            InquiryService::newscheme($params);
        else {
            //编辑报价单方案
            InquiryService::editscheme($params);
        }
    }

    //发送报价单给服务店
    public function actionSendquo() {
        if (Yii::app()->request->isAjaxRequest) {
            $inqid = Yii::app()->request->getParam('inqid');
            InquiryService::sendquo($inqid);
        }
    }

    //取消报价单发送
    public function actionCancelquo() {
        if (Yii::app()->request->isAjaxRequest) {
            $params['inqid'] = Yii::app()->request->getParam('inqid');
            $params['type'] = 3;
            $quoid = InquiryService::ifsendquo($params);
            if ($quoid) {
                $p['quoid'] = $quoid;
                $p['inqid'] = $params['inqid'];
                QuotationService::cancelquo($p);
            }
        }
    }

    //查看报价单
    public function actionViewquo() {
        $params['inqid'] = Yii::app()->request->getParam('inqid');
        //获取询价单信息
        $inqres = InquiryService::getinqinfo($params['inqid']);
        //查询是否已经发送报价单
        $params['type'] = 1;
        $quoid = InquiryService::ifsendquo($params);
        if ($quoid) {
            //获取报价单方案
            $schparams['quoid'] = $quoid;
            $schparams['type'] = 4;
            $res = QuotationService::getschemelists($schparams);
        }
        $this->render('viewquo', array(
            'inqres' => $inqres,
            'schinfo' => $res['schinfo'],
            'quoinfo' => $res['quoinfo']
        ));
    }

}

?>
