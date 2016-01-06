<?php

class JpaccountController extends Controller {

    public $layout = '//layouts/member';

    public function actionIndex() {
        //查询现金余额、消费币余额
        $criteria = new CDbCriteria();
        $user_id = Yii::app()->user->id;
        $criteria->select = "*";
        $criteria->addCondition("t.UserID=" . $user_id); //查询条件
        $model = new UserAccount();
        $model = $model->findAll($criteria);

        $this->render('index', array('model' => $model));
    }

    public function actionPay() {
        $criteria = new CDbCriteria();
        $user_id = Yii::app()->user->id;
        $criteria->select = "*";
        $criteria->addCondition("t.UserID=" . $user_id); //查询条件
        $model = new UserAccount();
        $model = $model->findAll($criteria);
        $this->render("pay", array('model' => $model));
    }

    public function actionSearchAccount() {
        //查询现金流水记录
        $criteria = new CDbCriteria();
        $user_id = Yii::app()->user->id;
        //form表单
        if ($_GET) {
            $search['Direction'] = $_GET['direction'];
            $search['Period'] = $_GET['period'];
            $search['start_time'] = $_GET['start_time'];
            $search['end_time'] = $_GET['end_time'];
            $criteria = $this->getSearch($search);   //查询条件
        }

        //   $model=new UserAccountCash();
        $criteria->select = "t.ID,t.Account,t.Direction,t.CreateTime,t.Remark";
        $criteria->order = "t.UpdateTime DESC,t.ID DESC"; //排序条件:update_time,id倒叙
        $criteria->addCondition("t.UserID = {$user_id}");
        $count = UserAccountCash::model()->count($criteria);

        $pages = new CPagination($count);

        $pages->pageSize = $_GET['rows'];
        $pages->applyLimit($criteria);

        $model = UserAccountCash::model()->findAll($criteria);

        foreach ($model as $key => $value) {
            $data[$key]['Account'] = $value["Account"];
            if ($value["Direction"] == 2) {
                $data[$key]['Direction'] = "支出";
                $data[$key]['Account'] = "-" . $data[$key]['Account'];
            }
            if ($value["Direction"] == 1) {
                $data[$key]['Direction'] = "收入";
            }
            $data[$key]['CreateTime'] = date('Y-m-d H:i:s', $value['CreateTime']);
            $data[$key]['Remark'] = $value["Remark"];
        }
        $rs = array(
            'total' => $count,
            'rows' => $data ? $data : array()
        );
        echo json_encode($rs);
    }

    public function actionSearchAccountCoupons() {
        //查询消费币流水记录
        $criteria = new CDbCriteria();
        $user_id = Yii::app()->user->id;
        if ($_GET) {
            $search['Direction'] = $_GET['direction'];
            $search['Period'] = $_GET['period'];
            $search['start_time'] = $_GET['start_time'];
            $search['end_time'] = $_GET['end_time'];
            $criteria = $this->getSearch($search);   //查询条件
        }

        $criteria->select = "t.ID,t.Account,t.Direction,t.CreateTime,t.Remark";
        $criteria->order = "t.UpdateTime DESC,t.ID DESC"; //排序条件:update_time,id倒叙
        $criteria->addCondition("t.UserID = {$user_id}");
        $count = UserAccountCoupons::model()->count($criteria);
        $pages = new CPagination($count);
        $pages->pageSize = $_GET['rows'];
        $pages->applyLimit($criteria);
        $model = UserAccountCoupons::model()->findAll($criteria);

        foreach ($model as $key => $value) {
            $data[$key]['Account'] = $value["Account"];
            if ($value["Direction"] == 2) {
                $data[$key]['Direction'] = "支出";
                $data[$key]['Account'] = "-" . $data[$key]['Account'];
            }
            if ($value["Direction"] == 1) {
                $data[$key]['Direction'] = "收入";
            }
            $data[$key]['CreateTime'] = date('Y-m-d H:i:s', $value['CreateTime']);
            $data[$key]['Remark'] = $value["Remark"];
        }
        $rs = array(
            'total' => $count,
            'rows' => $data ? $data : array()
        );
        echo json_encode($rs);
    }

    /*
     * 执行查询
     */

    public function getSearch($search) {
        $now = time();
        if ($search) {
            $criteria = new CDbCriteria();
            $start_time = strtotime($search['start_time']);
            $end_time = strtotime($search['end_time']);
            //资金流向
            if ($search['Direction']) {
                $criteria->addCondition("t.Direction=" . $search['Direction'], "AND");
            }
            //指定查询时间段
            if ($search['Period'] != 0) {
                $rs = $this->get_period_time($search['Period']);
                $beginTime = strtotime($rs['beginTime']);
                $endTime = strtotime($rs['endTime']);
                $criteria->addBetweenCondition('t.CreateTime', "{$beginTime}", "{$endTime}", "AND"); //between $start_time and $end_time
            }

            //开始时间与结束时间
            if ($start_time && $end_time) {
                $end_time += 24 * 60 * 60;
                $criteria->addBetweenCondition('t.CreateTime', "{$start_time}", "{$end_time}", "AND"); //between $start_time and $end_time
            } elseif ($start_time) {
                $criteria->addCondition("t.CreateTime >= " . $start_time, "AND");
            } elseif ($end_time) {
                $criteria->addCondition("t.CreateTime <= " . $end_time, "AND");
            }
            return $criteria;
        }
    }

    function get_period_time($type) {
        $rs = FALSE;
        $now = time();
        switch ($type) {
            case '1'://本周             
                $time = '1' == date('w') ? strtotime('Monday', $now) : strtotime('last Monday', $now);
                $rs['beginTime'] = date('Y-m-d 00:00:00', $time);
                $rs['endTime'] = date('Y-m-d 23:59:59', strtotime('Sunday', $now));
                break;
            case '2'://本月             
                $rs['beginTime'] = date('Y-m-d 00:00:00', mktime(0, 0, 0, date('m', $now), '1', date('Y', $now)));
                $rs['endTime'] = date('Y-m-d 23:39:59', mktime(0, 0, 0, date('m', $now), date('t', $now), date('Y', $now)));
                break;
            case '3'://最近一个月 (从当前时间往前推算一个月)	            
                $rs['beginTime'] = date('Y-m-d 23:39:59', mktime(0, 0, 0, date('m', $now) - 1, date("d"), date("Y")));
                $rs['endTime'] = date('Y-m-d 23:39:59', mktime(0, 0, 0, date("m"), date("d"), date("Y")));    //当前时间        
                break;
            case '4'://最近三个月                        
                $rs['beginTime'] = date('Y-m-d 23:39:59', mktime(0, 0, 0, date("m", $now) - 3, date("d"), date("Y")));
                $rs['endTime'] = date('Y-m-d 23:39:59', mktime(0, 0, 0, date("m"), date("d"), date("Y")));    //当前时间   
                break;
            case '5'://最近六个月                        
                $rs['beginTime'] = date('Y-m-d 23:39:59', mktime(0, 0, 0, date("m", $now) - 6, date("d"), date("Y")));
                $rs['endTime'] = date('Y-m-d 23:39:59', mktime(0, 0, 0, date("m"), date("d"), date("Y")));    //当前时间         
                break;
        }
        return $rs;
    }

}