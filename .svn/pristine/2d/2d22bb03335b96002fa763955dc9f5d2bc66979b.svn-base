<?php

class OrderevaluateController extends Controller {

    //商品评价列表
    public function actionIndex() {
        EvaluateService::setevaldealer();
        EvaluateService::setevalservice();
        $this->pageTitle = Yii::app()->name . ' - ' . "对卖家的商品评价";
        $content = Yii::app()->request->getParam('content');
        $status = Yii::app()->request->getParam('status');
        $params['starttime'] = strtotime(Yii::app()->request->getParam('starttime')) ?
                strtotime(Yii::app()->request->getParam('starttime')) : '';
        $params['endtime'] = strtotime(Yii::app()->request->getParam('endtime')) ?
                strtotime(Yii::app()->request->getParam('endtime')) : '';
        $params['OrganID'] = Yii::app()->user->getOrganID();
        $params['page'] = Yii::app()->request->getParam('page') ? Yii::app()->request->getParam('page') : '1';
        $search = Yii::app()->request->getParam('search_text');
        if (trim($search) != '' && $search != '商品编号或商品名称') {
            $params['search_text'] = $search;
        }
        //已回复
        if ($content == 'reply') {
            $params['Content'] = $content;
        }
        //状态
        if ($status && in_array($status, array(1, 2, 3))) {
            $params['Status'] = $status;
        }
        //订单列表
        $params['pageSize'] = 10;
        $params['type'] = 'buyer';
        $datas = EvaluateService::getGoodsEval($params);
        $data = $datas['data'];
        $count = $datas['count'];
        $get = self::getParams($params);
        $get['search_text'] = EvaluateService::changeKey($search);
        $this->render('index', array('evallist' => $data, 'count' => $count, 'params' => $get,
                //'type' => $typeArr, 'status' => $statusArr,
        ));
    }

    //参数方法
    protected function getParams($params) {
        $arr = array();
        foreach ($params as $k => $v) {
            if ($v) {
                $arr[$k] = $v;
            }
        }
        return $arr;
    }

    //对店铺的评价
    public function actionEvaluate() {
        $this->pageTitle = Yii::app()->name . ' - ' . "对卖家的服务评价";
        $params['starttime'] = strtotime(Yii::app()->request->getParam('starttime')) ?
                strtotime(Yii::app()->request->getParam('starttime')) : '';
        $params['endtime'] = strtotime(Yii::app()->request->getParam('endtime')) ?
                strtotime(Yii::app()->request->getParam('endtime')) : '';
        $params['OrganID'] = Yii::app()->user->getOrganID();
        $params['page'] = Yii::app()->request->getParam('page') ? Yii::app()->request->getParam('page') : '1';
        $search_text = trim(Yii::app()->request->getParam('search_text'));
        if (trim($search_text) != '') {
            $params['search_text'] = $search_text;
        }
        //订单列表
        $params['pageSize'] = 10;
        $params['type'] = 'buyer';
        $datas = EvaluateService::getDealerEval($params);
        // var_dump($datas);exit;
        $data = $datas['data'];
        $count = $datas['count'];
        $get = self::getParams($params);
        $get['search_text'] = EvaluateService::changeKey($search_text);
        $this->render('evaluate', array('evallist' => $data, 'count' => $count, 'params' => $get,
        ));
    }

    //收到的评价
    public function actionReceive() {
        $this->pageTitle = Yii::app()->name . ' - ' . "来自卖家的信用评价";
        $params['starttime'] = strtotime(Yii::app()->request->getParam('starttime')) ?
                strtotime(Yii::app()->request->getParam('starttime')) : '';
        $params['endtime'] = strtotime(Yii::app()->request->getParam('endtime')) ?
                strtotime(Yii::app()->request->getParam('endtime')) : '';
        $params['OrganID'] = Yii::app()->user->getOrganID();
        $params['page'] = Yii::app()->request->getParam('page') ? Yii::app()->request->getParam('page') : '1';
        $search_text = trim(Yii::app()->request->getParam('search_text'));
        if (trim($search_text) != '') {
            $params['search_text'] = $search_text;
        }
        //订单列表
        $params['pageSize'] = 10;
        $datas = EvaluateService::getServiceEval($params);
        // var_dump($datas);exit;
        $data = $datas['data'];
        $count = $datas['count'];
        $get = self::getParams($params);
        $get['search_text'] = EvaluateService::changeKey($search_text);
        $this->render('receive', array('evallist' => $data, 'count' => $count, 'params' => $get,
        ));
    }

    /*
     * 修理厂做出的评价
     */

    public function actionEvaluateinfo() {
        $this->pageTitle = Yii::app()->name . ' - ' . "评价详情";
        $this->render('evaluateinfo', array('info' => EvaluateService::idgetdealereva()));
    }

    /*
     * 修理厂做出的评价
     */

    public function actionReceiveinfo() {
        $this->pageTitle = Yii::app()->name . ' - ' . "评价详情";
        $this->render('receiveinfo', array('info' => EvaluateService::idgetserviceeva()));
    }

}
