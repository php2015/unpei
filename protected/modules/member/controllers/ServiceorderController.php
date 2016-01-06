<?php

class ServiceorderController extends Controller {

    public $layout = '//layouts/member';

    public function actionIndex() {
        $this->render('index');
    }

    public function actionSearchOrder() {
        //查询已订购服务列表
        $criteria = new CDbCriteria();
        $user_id = Yii::app()->user->id;
        if ($_GET) {
            $search['ProuductName'] = $_GET['ProuductName']; //服务名称
            $search['StartAmount'] = $_GET['StartAmount']; //起始价格
            $search['EndAmount'] = $_GET['EndAmount']; //终止价格
            $search['PayMethod'] = $_GET['PayMethod']; //支付方式
            $search['PurchaseDate'] = $_GET['PurchaseDate']; //购买日期
            $search['StartTime'] = $_GET['StartTime']; //购买开始时间
            $search['EndTime'] = $_GET['EndTime']; //购买结束时间
            $search['ExpirationDate'] = $_GET['ExpirationDate']; //到期日期
            $search['EStartTime'] = $_GET['EStartTime']; //到期开始时间
            $search['EEndTime'] = $_GET['EEndTime']; //到期结束时间

            $criteria = $this->getSearch($search);   //查询条件
        }

        // $model=new UserOrderservice();
        $criteria->select = "t.ID,t.ProuductName,t.Remark,t.Amount,t.PayMethod,t.OrderDate,t.EndDate";
        $criteria->order = "t.OrderDate DESC,t.ID DESC"; //排序条件:update_time,id倒叙
        $criteria->addCondition("t.UserID = {$user_id}");
        $count = UserOrderservice::model()->count($criteria);
         $pages = new CPagination($count);
        //$pages->pageSize = $_GET['rows'];
        $pages->pageSize = $_GET['rows'];
        $pages->applyLimit($criteria);
        $model = UserOrderservice::model()->findAll($criteria);
        //var_dump($model);exit;
        foreach ($model as $key => $value) {
            $data[$key]['ProuductName'] = $value["ProuductName"];
            $data[$key]['Remark'] = $value["Remark"];
            $data[$key]['Amount'] = $value["Amount"];
            switch ($value["PayMethod"]) {
                case "1": $data[$key]['PayMethod'] = "现金";
                    break;  //现金
                case "2": $data[$key]['PayMethod'] = "消费币";
                    break;  //消费币
                case "3": $data[$key]['PayMethod'] = "支付宝";
                    break;  //支付宝
                case "4": $data[$key]['PayMethod'] = "网银";
                    break;  //网银
                default: $data[$key]['PayMethod'] = "显示错误";
                    break; //
            }
            $data[$key]['OrderDate'] = date('Y-m-d H:i:s', $value['OrderDate']);
            $data[$key]['EndDate'] = date('Y-m-d H:i:s', $value['EndDate']);
        }
        $rs = array(
            'total' => $count,
            'rows' => $data ? $data : array()
        );
        echo json_encode($rs);
    }

    //续费嘉配服务
    public function ActionRenew() {
        echo json_encode(true);
    }

    /*
     * 执行查询
     */

    public function getSearch($search) {
        $now = time();
        if ($search) {
            $criteria = new CDbCriteria();
            $StartAmount = $search['StartAmount'];
            $EndAmount = $search['EndAmount'];
            $StartTime = strtotime($search['StartTime']);
            $EndTime = strtotime($search['EndTime']);
            $EStartTime = strtotime($search['EStartTime']);
            $EEndTime = strtotime($search['EEndTime']);
//			$ProuductName = string($search['ProuductName']);
            //服务名称
            if ($search['ProuductName']) {
                $criteria->addCondition("t.ProuductName='{$search['ProuductName']}'", "AND");
            }
            //金额范围
            if ($StartAmount && $EndAmount) {
                $criteria->addBetweenCondition('t.Amount', "{$StartAmount}", "{$EndAmount}", "AND"); //between $StartAmount and $EndAmount
            } elseif ($StartAmount) {
                $criteria->addCondition("t.Amount >= " . $StartAmount, "AND");
            } elseif ($EndAmount) {
                $criteria->addCondition("t.Amount <= " . $EndAmount, "AND");
            }
            //支付方式
            if ($search['PayMethod']) {
                $criteria->addCondition("t.PayMethod=" . $search['PayMethod'], "AND");
            }
            //指定查询购买时间段
            if ($search['PurchaseDate'] != 0) {
                $rs = $this->get_period_time($search['PurchaseDate']);
                $beginTime = strtotime($rs['beginTime']);
                $endTime = strtotime($rs['endTime']);
                $criteria->addBetweenCondition('t.OrderDate', "{$beginTime}", "{$endTime}", "AND");
            }
            //购买开始时间与结束时间
            if ($StartTime && $EndTime) {
                $EndTime += 24 * 60 * 60;
                $criteria->addBetweenCondition('t.OrderDate', "{$StartTime}", "{$EndTime}", "AND");
            } elseif ($StartTime) {
                $criteria->addCondition("t.OrderDate >= " . $StartTime, "AND");
            } elseif ($EndTime) {
                $criteria->addCondition("t.OrderDate <= " . $EndTime, "AND");
            }
            //指定查询过期时间段
            if ($search['ExpirationDate'] != 0) {
                $rs = $this->get_period_time($search['ExpirationDate']);
                $EbeginTime = strtotime($rs['beginTime']);
                $EendTime = strtotime($rs['endTime']);
                $criteria->addBetweenCondition('t.EndDate', "{$EbeginTime}", "{$EendTime}", "AND");
            }
            //过期开始时间与结束时间
            if ($EStartTime && $EEndTime) {
                $EEndTime += 24 * 60 * 60;
                $criteria->addBetweenCondition('t.EndDate', "{$EStartTime}", "{$EEndTime}", "AND");
            } elseif ($EStartTime) {
                $criteria->addCondition("t.EndDate >= " . $EStartTime, "AND");
            } elseif ($EEndTime) {
                $criteria->addCondition("t.EndDate <= " . $EEndTime, "AND");
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

?>