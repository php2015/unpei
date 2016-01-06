<?php

class SellerevaluateController extends Controller {

    //评价列表
    public function actionIndex() {
        $this->pageTitle = Yii::app()->name . ' - ' . "来自买家的商品评价";
        $content = Yii::app()->request->getParam('content');
        $status = Yii::app()->request->getParam('status');
        $params['starttime'] = strtotime(Yii::app()->request->getParam('starttime')) ?
                strtotime(Yii::app()->request->getParam('starttime')) : '';
        $params['endtime'] = strtotime(Yii::app()->request->getParam('endtime')) ?
                strtotime(Yii::app()->request->getParam('endtime')) : '';
        $params['OrganID'] = Yii::app()->user->getOrganID();
        $params['page'] = Yii::app()->request->getParam('page') ? Yii::app()->request->getParam('page') : '1';
        $search_text = trim(Yii::app()->request->getParam('search_text'));
        if (trim($search_text) != '' && $search_text != '商品编号或商品名称') {
            $params['search_text'] = $search_text;
        }
        //有内容
        if ($content == 'not_empty') {
            $params['Content'] = $content;
        }
        //状态
        if ($status && in_array($status, array(1, 2, 3))) {
            $params['Status'] = $status;
        }
        //评价列表
        $params['pageSize'] = 8;
        $datas = EvaluateService::getGoodsEval($params);
        //var_dump($datas);exit;
        $data = $datas['data'];
        $count = $datas['count'];
        $get = self::getParams($params);
        $get['search_text'] = EvaluateService::changeKey($search_text);
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

    //收到的店铺评价
    public function actionReceive() {
        $this->pageTitle = Yii::app()->name . ' - ' . "来自买家的服务评价";
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
        $datas = EvaluateService::getDealerEval($params);
        $data = $datas['data'];
        $count = $datas['count'];
        $get = self::getParams($params);
        $get['search_text'] = EvaluateService::changeKey($search_text);
        $this->render('receive', array('evallist' => $data, 'count' => $count, 'params' => $get,
        ));
    }
    //做出的评价
    public function actionEvaluate() {
        $this->pageTitle = Yii::app()->name . ' - ' . "对买家的信用评价";
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
        $params['type'] = 'dealer';
        $datas = EvaluateService::getServiceEval($params);
        // var_dump($datas);exit;
        $data = $datas['data'];
        $count = $datas['count'];
        $get = self::getParams($params);
        $get['search_text'] = EvaluateService::changeKey($search_text);
        $this->render('evaluate', array('evallist' => $data, 'count' => $count, 'params' => $get));
    }

    //对商品评价的回复
    public function actionGetEval() {
        $ID = Yii::app()->request->getParam('ID');
        $res = EvaluateService::geteval($ID);
        echo json_encode($res);
    }

    public function actionReply() {
//        if (!$_POST['ID']||!trim($_POST['reply'])) {
//            $this->redirect(array('index'));
//        }
        $ID = Yii::app()->request->getParam('ID');
        $reply = trim(Yii::app()->request->getParam('reply'));
        if (!$ID || mb_strlen($reply, 'utf8') < 2 || mb_strlen($reply, 'utf8') > 50) {
            echo json_encode(array('error' => '回复失败，请稍后再试！'));
            exit;
        }
        $OrganID = Yii::app()->user->getOrganID();
        $res = PapEvaluationGoods::model()->updateByPk($ID, array('SellerToEvalRemark' => htmlspecialchars($reply),
            'UpdateTime' => time()), "SellerToEvalRemark ='' and OrganID=$OrganID");
        if ($res) {
            echo json_encode(array('success' => 1));
        } else {
            echo json_encode(array('error' => '回复失败，请稍后再试！'));
        }
    }

    /*
     * 经销商收到的评价详情
     */

    public function actionReceiveinfo() {
        $this->pageTitle = Yii::app()->name . '-' . "评价详情";
        $this->render('receiveinfo', array('info' => EvaluateService::idgetdealereva()));
    }

    /*
     * 经销商做出的评价详情
     */

    public function actionEvaluateinfo() {
        $this->pageTitle = Yii::app()->name . '-' . "评价详情";
        $this->render('evaluateinfo', array('info' => EvaluateService::idgetserviceeva()));
    }

    /*
     * 机构评论违规统计
     */

    public static function addjudgerecord($JudgeID, $Score, $ReciverID, $Identity, $OrderID) {
        $viosql = "select distinct (Score) from jpd_judge_violation where JudgeID = " . $JudgeID;
        $OrganID = Yii::app()->user->getOrganID();
        $vioarr = Yii::app()->jpdb->createCommand($viosql)->queryAll();

        $countarr = 0;
        if ($vioarr && $Score < $vioarr[0]['Score']) {
            $countsql = "select * from pap_judge_record where JudgeID = " . $JudgeID . " order by Num DESC limit 1";
            $countarr = Yii::app()->papdb->createCommand($countsql)->queryAll();
            if ($countarr) {
                $Num = (int) $countarr[0]['Num'] + 1;
            } else {
                $Num = 1;
            }
            $Pubsql = "select PublishID,CutPoint from jpd_judge_violation where JudgeID = " . $JudgeID . " and Num <= " . $Num . " order by Num DESC limit 1";
            $Pubarr = Yii::app()->jpdb->createCommand($Pubsql)->queryAll();
            $PublishID = explode(',', $Pubarr[0]['PublishID']);
            foreach ($PublishID as $pvalue) {
                if ($pvalue) {
                    $Punsql = "select Item from jpd_organ_punishment where ID = " . $pvalue;
                    $Punarr = Yii::app()->jpdb->createCommand($Punsql)->queryAll();
                    if ($Punarr[0]['Item'] == '扣分') {
                        $Publishment .='扣' .$pvalue['CutPoint']. '分,';
                    } else {
                        $Publishment .=$Punarr[0]['Item'] . ',';
                    }
                }
            }
            $addsql = "insert into pap_judge_record (Identity,SendID,ReciverID,JudgeID,OrderID,Score,Num,Publishment,CreateTime) values ";
            $addsql .="(";
            $addsql .=$Identity;
            $addsql .=",";
            $addsql .=$OrganID;
            $addsql .=",";
            $addsql .=$ReciverID;
            $addsql .=",";
            $addsql .=$JudgeID;
            $addsql .=",";
            $addsql .=$OrderID;
            $addsql .=",";
            $addsql .=$Score;
            $addsql .=",";
            $addsql .=$Num;
            $addsql .=",'";
            $addsql .=$Publishment;
            $addsql .="',";
            $addsql .=time();
            $addsql .=")";
            $bool = Yii::app()->papdb->createCommand($addsql)->execute();
        }
    }

}
