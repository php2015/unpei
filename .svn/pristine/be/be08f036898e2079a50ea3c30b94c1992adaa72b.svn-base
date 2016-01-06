<?php

/*
 * 推送信息管理
 */

class PushController extends Controller {

    public $layout = '//layouts/member';

    /**
     * 推送信息管理首页
     */
    public function actionIndex() {
        $this->pageTitle = Yii::app()->name . '-' . '推送信息管理';
        $this->render('index');
    }

    public function actionGetpushmess() {
        $organID = Commonmodel::getOrganID();
        $criteria = new CDbCriteria();
        $criteria->order = "t.ID DESC "; //排序条件:t.CreateTime,t.ID倒叙
        $criteria->addCondition("t.OrganID = $organID", "AND");

        $search = $_GET['search'];
        $keyword = $_GET['keyword'];
        $sendway = $_GET['sendway'];
        $month = $_GET['month'];

        if (!empty($search)) { // 关联到另一张表，手机号，姓名
            // 1.通过姓名或手机号查到 联系人ID；
            // 2. 通过联系人ID 查到 推送信息ID；
            $sql = "select distinct PushID from tbl_push_contact_relation where ContactID in (select id  from tbl_business_contacts where name like '%{$search}%' OR phone like '%{$search}%')";
            $pushIDs = DBUtil::queryAll($sql);
            foreach ($pushIDs as $value) {
                $pushID[] = $value['PushID'];
            }
            // 3. 通过推送信息ID　查出推送信息
            $criteria->addInCondition("ID", $pushID);
        }
        if (!empty($keyword)) {  // 内容关键字
            $criteria->addSearchCondition('Content', "{$keyword}", "AND");
        }
        if (!empty($month)) {
            $recomtime = time();
            if ($month == 1) {  // 1个月
                $recomtime -= 24 * 60 * 60 * 30 * 1;
            } elseif ($month == 3) { // 3个月
                $recomtime -= 24 * 60 * 60 * 30 * 3;
            } elseif ($month == 6) { // 6个月
                $recomtime -= 24 * 60 * 60 * 30 * 6;
            } elseif ($month == 12) { // 1年
                $recomtime -= 24 * 60 * 60 * 30 * 12;
            } else {
                $recomtime -= 24 * 60 * 60 * 30 * 44;
            }
            $criteria->addCondition("t.SendTIme >= $recomtime ", 'and');
        }
        if (!empty($sendway)) {
            $criteria->addCondition("t.SendWay = $sendway", 'and');
        }
        $count = Pushmessage::model()->count($criteria);
        $pages = new CPagination($count);
        $pages->pageSize = $_GET['rows'];
        $pages->applyLimit($criteria);
        $pushmess = Pushmessage::model()->findAll($criteria);
        $pushinfo = array();
        foreach ($pushmess as $key => $pushm) {
            $pushinfo[$key]['ID'] = $pushm['ID'];
            $pushinfo[$key]['content'] = $pushm['Content'];
            $pushinfo[$key]['content2'] = F::msubstr($pushm['Content']);
            $pushinfo[$key]['sendway'] = $pushm['SendWay'] == 1 ? "邮件" : "短信";
            $pushinfo[$key]['sendtime'] = date("Y年m月d日", $pushm['SendTime']);
            $pushinfo[$key]['sendto'] = $this->getsenders($pushm['ID']) . '个';
        }
        $rs = array(
            'total' => $count,
            'rows' => $pushinfo
        );
        echo json_encode($rs);
    }

    /**
     * 添加推送信息
     */
    public function actionAddpush() {
        $organID = Commonmodel::getOrganID();
        $userID = Yii::app()->user->id;
        $content = trim($_POST['content']);
        $sendway = $_POST['sendway'];
        $ids = substr($_POST['ids'], 0, -1);
        $contactID = explode(',', $ids);
        $count = count($contactID);
        $sendTime = time();
        // 判断是否还有剩下的可发送数量
        $this->Iscanpush($sendway, $count, $organID);
        $pushMessage = new Pushmessage();
        $pushMessage->Content = $content;
        $pushMessage->SendWay = $sendway;
        $pushMessage->OrganID = $organID;
        $pushMessage->UserID = $userID;
        $pushMessage->SendTime = $sendTime;
        if ($pushMessage->save()) {   //如果保存成功,则发送
            $pushID = Yii::app()->db->getLastInsertID();
            for ($i = 0; $i < $count; $i++) {
                $relationcon = new PushContactRelation();
                $relationcon->PushID = $pushID;
                $relationcon->ContactID = $contactID[$i];
                $relationcon->OrganID = $organID;
                $rbool = $relationcon->save();
                if($rbool && $sendway == 1){ // 发送邮件
                    $model = $this->getBussineContact($contactID[$i]);
                    $sex = $model['sex'] =='男' ? '先生': '女士';
                    $message = "
				<p>尊敬的" . $model['name'] . $sex."，</p>
				<p>嘉配服务平台为您推送信息：$content</p>
				<p style='text-align: right;'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; 嘉配服务平台&nbsp;&nbsp;&nbsp;&nbsp;</p>
				<p style='text-align: right;'>" . date('Y年m月d日', time()) . "</p>";
                    
                    $toemail = $model['email'];
                    
                   $bool =  UserModule::sendMail($toemail, '嘉配服务平台', $message);
                }
            }
            $result['data'] =$bool;// $rbool;
        }
        echo json_encode($result);
    }
    
    /**
     * 获取业务联系人信息
     */
    public function  getBussineContact($contactID){
        $model = BusinessContacts::model()->findByPk($contactID)->attributes;
        return $model;
       // var_dump($model);
    }



    public function actionGetcontacts() {
        $pushID = $_GET['pushID'];
        $sql = "select * from tbl_business_contacts where id in (select ContactID from tbl_push_contact_relation where PushID = $pushID)";
        $models = DBUtil::queryAll($sql);
        $count = count($models);
        $data = array();
        foreach ($models as $key => $value) {
            $data[$key]['id'] = $value['id'];
            $data[$key]['companyID'] = $value['contact_user_id'];
            $data[$key]['customertype'] = $value['customertype'];
            $data[$key]['cooperationtype'] = $value['cooperationtype'];
            $data[$key]['customercategory'] = $value['customercategory'];
            $data[$key]['name'] = $value['name'];
            $data[$key]['sex'] = $value['sex'];
            $data[$key]['companyname'] = $value['companyname'];
            $data[$key]['phone'] = $value['phone'];
            $data[$key]['email'] = $value['email'];
        }
        $rs = array(
            'total' => $count,
            'rows' => $data
        );
        echo json_encode($rs);
    }

    /**
     * 我的推送服务
     */
    public function actionmypush() {
        $organID = Commonmodel::getOrganID();
        $mypushtotal = PushTotal::model()->find("OrganID=$organID");
        $this->render('mypush', array(
            'mypushtotal' => $mypushtotal
        ));
    }

    /**
     * 购买服务
     */
    public function actionBuypush() {
        $pushway = $_POST['pushway'];
        $count = $_POST['count'];
        $payway = $_POST['payway'];
        $amount = $_POST['amount'];
        $organID = Commonmodel::getOrganID();
        $userID = Yii::app()->user->id;
        //添加记录
        $pushbuy = new PushbuyRecord();
        $pushbuy->Amount = $amount;     // 金额
        $pushbuy->Count = $count;       // 数量
        $pushbuy->PayWay = $payway;     // 付款方式
        $pushbuy->PushType = $pushway;  // 服务类别
        $pushbuy->OrganID = $organID;
        $pushbuy->UserID = $userID;
        $pushbuy->CreateTime = time();
        $pushbuy->UpdateTime = time();
        if ($pushbuy->save()) {       // 保存成功
            $pushtotal = new PushTotal();
            $pushtotals = $pushtotal->model()->find("OrganID= $organID");
            if ($pushtotals) {  // 曾经购买过，添加数量
                if ($pushway == 1) {
                    $balace = $pushtotals['EmailBalance'] + $count;
                    $bool = $pushtotal->model()->updateAll(array(
                        'EmailBalance' => $balace,
                        'UpdateTime' => time()
                            ), " OrganID = " . $organID);
                } else {
                    $balace = $pushtotals['MessBalance'] + $count;
                    $bool = $pushtotal->model()->updateAll(array(
                        'MessBalance' => $balace,
                        'UpdateTime' => time()
                            ), " OrganID = " . $organID);
                }
                $rs = array('data' => $bool);
            } else {           // 第一次购买
                if ($pushway == 1) {
                    $pushtotal->EmailBalance = $count;
                } else {
                    $pushtotal->MessBalance = $count;
                }
                $pushtotal->OrganID = $organID;
                $pushtotal->UserID = $userID;
                $pushtotal->CreateTime = time();
                $pushtotal->UpdateTime = time();
                $bool = $pushtotal->save();
                $rs = array('data' => $bool);
            }
        }
        echo json_encode($rs);
    }

    /**
     * 获取购买服务记录
     */
    public function actionGetpushbuyrecord() {
        $organID = Commonmodel::getOrganID();
        $criteria = new CDbCriteria();
        $criteria->order = "ID DESC";
        $criteria->condition = "OrganID = $organID";
        $payway = $_GET['payway'];
        $sendway = $_GET['sendway'];
        $month = $_GET['month'];
        if (!empty($month)) {
            $recomtime = time();
            if ($month == 1) {  // 1个月
                $recomtime -= 24 * 60 * 60 * 30 * 1;
            } elseif ($month == 3) { // 3个月
                $recomtime -= 24 * 60 * 60 * 30 * 3;
            } elseif ($month == 6) { // 6个月
                $recomtime -= 24 * 60 * 60 * 30 * 6;
            } elseif ($month == 12) { // 1年
                $recomtime -= 24 * 60 * 60 * 30 * 12;
            } else {
                $recomtime -= 24 * 60 * 60 * 30 * 44;
            }
            $criteria->addCondition("t.CreateTime >= $recomtime ", 'and');
        }
        if (!empty($sendway)) {
            $criteria->addCondition("t.PushType = $sendway", 'and');
        }
        if (!empty($payway)) {
            $criteria->addCondition("t.PayWay = $payway", 'and');
        }
        $count = PushbuyRecord::model()->count($criteria);
        $pages = new CPagination($count);
        $pages->pageSize = $_GET['rows'];
        $pages->applyLimit($criteria);
        $pushrecords = PushbuyRecord::model()->findAll($criteria);
        $pushrecord = array();
        foreach ($pushrecords as $key => $value) {
            $pushrecord[$key]['ID'] = $value['ID'];
            $pushrecord[$key]['PushType'] = $value['PushType'] == 1 ? '邮件' : '短信';
            $pushrecord[$key]['Count'] = $value['Count'];
            $pushrecord[$key]['PayWay'] = $this->payway($value['PayWay']);
            $pushrecord[$key]['Amount'] = '￥ ' . $value['Amount'];
            $pushrecord[$key]['CreateTime'] = date('Y年m月d日', $value['CreateTime']);
        }
        $rs = array('total' => $count, 'rows' => $pushrecord);
        echo json_encode($rs);
    }

    /**
     * 获取有多少个发送对象
     */
    private function getsenders($pushID) {

        $contacts = PushContactRelation::model()->findAll("PushID=" . $pushID);
        if (count($contacts) > 0) {
            return count($contacts);
        } else {
            return 0;
        }
    }

    private function payway($payway) {
        if ($payway == 1) {
            return '消费券';
        } elseif ($payway == 2) {
            return '现金';
        } elseif ($payway == 3) {
            return '支付宝';
        } elseif ($payway == 4) {
            return '银行转账';
        }
    }

    private function Iscanpush($sendway, $count, $organID) {
        $pushtotal = new PushTotal();
        $pushtotals = $pushtotal->model()->find("OrganID= $organID");
        if ($pushtotals) {  // 曾经购买过，添加数量
            if ($sendway == 1) {
                if ($pushtotals['EmailBalance'] > $count) {
                    $balace = $pushtotals['EmailBalance'] - $count;
                    $bool = $pushtotal->model()->updateAll(array(
                        'EmailBalance' => $balace,
                        'UpdateTime' => time()
                            ), " OrganID = " . $organID);
                } else {
                    echo json_encode(array('data' => 0, 'errMsg' => '可发送数不足,请<a href="mypush">购买推送服务</a>'));
                    exit;
                }
            } else {
                if ($pushtotals['MessBalance'] > $count) {
                    $balace = $pushtotals['MessBalance'] - $count;
                    $bool = $pushtotal->model()->updateAll(array(
                        'MessBalance' => $balace,
                        'UpdateTime' => time()
                            ), " OrganID = " . $organID);
                } else {
                    echo json_encode(array('data' => 0, 'errMsg' => '可发送数不足,请<a href="mypush">购买推送服务</a>'));
                    exit;
                }
            }
        } else {
            echo json_encode(array('data' => 0, 'errMsg' => '请<a href="mypush">购买推送服务</a>'));
            exit;
        }
    }

}

?>
