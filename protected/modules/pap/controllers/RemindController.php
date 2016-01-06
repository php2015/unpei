<?php

class RemindController extends Controller {

    public $layout = '//layouts/news';

    public function actionIndex() {
        $params['OrganID'] = Yii::app()->user->getOrganID();
        $params['starttime'] = strtotime(Yii::app()->request->getParam('starttime')) ?
                strtotime(Yii::app()->request->getParam('starttime')) : '';
        $params['endtime'] = strtotime(Yii::app()->request->getParam('endtime')) ?
                strtotime(Yii::app()->request->getParam('endtime')) : '';
        $params['type'] = Yii::app()->request->getParam('type');
        $params['handle'] = Yii::app()->request->getParam('handle');
        $params['status'] = Yii::app()->request->getParam('status');
        $business = RemindService::getBusinessRemind($params);
        $this->render('index', array('business' => $business, 'params' => $params));
    }

    public function actionSystem() {
        $params['OrganID'] = Yii::app()->user->getOrganID();
        $params['starttime'] = strtotime(Yii::app()->request->getParam('starttime')) ?
                strtotime(Yii::app()->request->getParam('starttime')) : '';
        $params['endtime'] = strtotime(Yii::app()->request->getParam('endtime')) ?
                strtotime(Yii::app()->request->getParam('endtime')) : '';
        $params['type'] = Yii::app()->request->getParam('type');
        $params['read'] = Yii::app()->request->getParam('read');
        $system = RemindService::getSystemRemind($params);
        $this->render('system', array('system' => $system, 'params' => $params));
    }

    //提醒设置
    public function actionRemindset() {
        $organID = Yii::app()->user->getOrganID();
        //获取子账户
        $sql='select ID,Name,Phone from jpd_organ_employees where Status=0 and OrganID='.$organID;
        $selects=Yii::app()->jpdb->createCommand($sql)->queryAll();
        $identity = Yii::app()->user->getIdentity();
        if ($identity == 'dealer') {
            $remind = Yii::app()->params['DealerRemind'];
        } else if ($identity == 'servicer') {
            $remind = Yii::app()->params['ServiceRemind'];
        } else {
            $identity = 1;
        }
        $remindsql = ' select * from `pap_remind_set` where OrganID=' . $organID;
        $remindres = Yii::app()->papdb->createCommand($remindsql)->queryAll();
        if (!$remindres) {
            $insert = 1;
            $sql = ' insert into `pap_remind_set` (`OrganID`,`RemindItem`,`Method`,`Type`) values';
        }
        if ($insert > 0) {
            foreach ($remind as $k => $v) {
                $insertsql = '';
                foreach ($v['children'] as $kk => $rr) {
                    $insertsql.=$kk . ',';
                }
                $sql.= ' (' . $organID . ',"' . rtrim($insertsql, ',') . '","1,2",' . $insert . '),';
                $insert++;
            }
            $inres = Yii::app()->papdb->createCommand(rtrim($sql, ','))->execute();
            $remindres = Yii::app()->papdb->createCommand($remindsql)->queryAll();
        }
        foreach ($remindres as $v) {
            $v['item'] = array_filter(explode(',', $v['RemindItem']));
            $v['way'] = array_filter(explode(',', $v['Method']));
            if ($v['Type'] == 1) {
                $keys = 'DD';
            } elseif ($v['Type'] == 3) {
                $keys = 'THD';
            } elseif ($v['Type'] == 2) {
                if ($identity == 'dealer') {
                    $keys = 'XJD';
                } else if ($identity == 'servicer') {
                    $keys = 'BJD';
                }
            }
            if (count($v['item']) == count($remind[$keys]['children']))
                $v['allitem'] = 1;
            else if(count($v['item'])==0)
                $v['allitem'] = -1;
            $reminds[$keys] = $v;
        }
        $this->render('set', array('items' => $remind, 'remindres' => $reminds,'selects'=>$selects));
    }

    //保存提醒项目、提醒方式
    public function actionSave() {
        if (Yii::app()->request->isAjaxRequest) {
            $organID = Yii::app()->user->getOrganID();
            $items = Yii::app()->request->getParam('itemids');
            $types = Yii::app()->request->getParam('typeids');
            $type = Yii::app()->request->getParam('types');
            $extras = Yii::app()->request->getParam('extras');
            $items = array_filter(explode('-', $items));
            $types = array_filter(explode('-', $types));
            $type = array_filter(explode('-', $type));
            $extras = array_filter(explode('-', $extras));
            foreach ($type as $k => $v) {
                if($extras[$k]){
                    $e=explode(',', $extras[$k]);
                }else{
                    $e=array();
                }
                $sql = ' update  `pap_remind_set` set RemindItem="' . $items[$k] . '",Method="' . $types[$k] .'",IfSend='.$e[0].',SonID="'.$e[1].'",OtherPhone="'.$e[2].'"'
                        . ' where OrganID=' . $organID . ' and Type=' . $v;
                Yii::app()->papdb->createCommand($sql)->execute();
            }
            echo json_encode(array('res' => 1));
        }
    }

    public function actionGetRemind() {
        $OrganID = Yii::app()->user->getOrganID();
        //业务提醒数量
        $sql1 = "select count(*) from pap_remind_business where HandleStatus in(0,1) and OrganID=$OrganID";
        $business = Yii::app()->papdb->createCommand($sql1)->queryScalar();
        //系统提醒数量
        $sql2 = "select count(*) from pap_remind_system where OrganID=$OrganID";
        $system = Yii::app()->papdb->createCommand($sql2)->queryScalar();

        echo json_encode(array('business' => $business, 'system' => $system));
    }

    public function actionGetNews() {
        if (Yii::app()->request->isAjaxRequest) {
            $OrganID = Yii::app()->user->getOrganID();
            $change = Yii::app()->request->getParam('change');
            $type = Yii::app()->request->getParam('type');
            if ($change == 'sys' && in_array($type, array(0, 1, 2))) {
                $sql = "SELECT ID,Type,Title,Content FROM `pap_remind_system` where OrganID=$OrganID and ReadStatus=0 and Type=$type ORDER BY CreateTime desc limit 1";
                $system = Yii::app()->papdb->createCommand($sql)->queryRow();
                echo json_encode(array('system' => $system));
                exit;
            }
            //业务消息数量
            $res = array(0, 0, 0, 0, 0, 0);
            $sql1 = "SELECT HandleType,count(*) as count FROM `pap_remind_business` where OrganID=$OrganID and HandleStatus=0 GROUP BY HandleType";
            $business = Yii::app()->papdb->createCommand($sql1)->queryAll();
            foreach ($business as $v) {
                $res[$v['HandleType']] = $v['count'];
            }
            //系统消息项目
            $system = array();
            for ($i = 0; $i < 3; $i++) {
                $sql2 = "SELECT ID,Type,Title,Content FROM `pap_remind_system` where OrganID=$OrganID and ReadStatus=0 and Type=$i ORDER BY CreateTime desc limit 1";
                $res2 = Yii::app()->papdb->createCommand($sql2)->queryRow();
                if (!empty($res2)) {
                    $system[$i] = $res2;
                }
            }
            //业务数量
            $sql3 = "SELECT count(*) as count FROM `pap_remind_business` where OrganID=$OrganID and HandleStatus=0";
            $businessCount = Yii::app()->papdb->createCommand($sql3)->queryScalar();
            //系统数量
            $sql4 = "SELECT count(*) as count FROM `pap_remind_system` where OrganID=$OrganID and ReadStatus=0";
            $systemCount = Yii::app()->papdb->createCommand($sql4)->queryScalar();
            $res[0] = intval($businessCount) + intval($systemCount);
            echo json_encode(array('business' => $res, 'system' => $system, 'businessCount' => $businessCount, 'systemCount' => $systemCount));
        }
    }

    public function actionHandlenews() {
        if (Yii::app()->request->isAjaxRequest) {
            $sendstr = Yii::app()->request->getParam('sendstr');
            $str = Yii::app()->request->getParam('str');
            $organID = Yii::app()->user->getOrganID();
            if ($str == 'sign') {
                $sql = "update pap_remind_business set HandleStatus=2 where OrganID=$organID and ID in($sendstr) and HandleStatus=0";
            } else if ($str == 'del') {
                $sql = "delete from pap_remind_business where OrganID=$organID and ID in($sendstr)";
            } else if ($str == 'clear') {
                $status = Yii::app()->request->getParam('status');
                $choose = Yii::app()->request->getParam('handle');
                $sql = "delete from pap_remind_business where OrganID=$organID";
                if ($status == 1) {
                    $sql.=" and HandleType in(1,2)";
                } else if ($status == 2) {
                    $sql.=" and HandleType in(3)";
                } else if ($status == 3) {
                    $sql.=" and HandleType in(4,5)";
                }
                if ($choose == 'un') {
                    $sql.=" and HandleStatus =0";
                }
            }
            $handle = Yii::app()->papdb->createCommand($sql)->execute();
            if ($handle > 0) {
                echo json_encode(array('success' => 1, 'msg' => '操作成功!'));
            } else if ($handle == 0) {
                if ($str == 'clear') {
                    echo json_encode(array('error' => 1, 'msg' => '没有要清空的消息!'));
                } else {
                    echo json_encode(array('error' => 2, 'msg' => '没有未处理的消息!'));
                }
            } else {
                echo json_encode(array('error' => 3, 'msg' => '操作失败!'));
            }
        }
    }

    public function actionReadnews() {
        if (Yii::app()->request->isAjaxRequest) {
            $sendstr = Yii::app()->request->getParam('sendstr');
            $organID = Yii::app()->user->getOrganID();
            $sql = "update pap_remind_system set ReadStatus=1 where OrganID=$organID and ID in($sendstr) and ReadStatus=0";
            $read = Yii::app()->papdb->createCommand($sql)->execute();
            if ($read > 0) {
                echo json_encode(array('success' => 1, 'msg' => '操作成功!'));
            } else if ($read == 0) {
                echo json_encode(array('error' => 1, 'msg' => '没有未读的消息!'));
            } else {
                echo json_encode(array('error' => 2, 'msg' => '操作失败!'));
            }
        }
    }

    public function actionDetail() {
        $id = Yii::app()->request->getParam('id');
        $organID = Yii::app()->user->getOrganID();
        $sql2 = "select * from pap_remind_system where OrganID=$organID and ID=$id";
        $res = Yii::app()->papdb->createCommand($sql2)->queryRow();
        if ($res['ReadStatus'] == 0) {
            $userid = Yii::app()->user->id;
            $sql = "update pap_remind_system set ReadStatus=1,ReaderID=$userid where OrganID=$organID and ID=$id and ReadStatus=0";
            Yii::app()->papdb->createCommand($sql)->execute();
        }
        $this->render('detail', array('row' => $res));
    }

    public function actionGetBusiness() {
        $params['OrganID'] = Yii::app()->user->getOrganID();
        $data = RemindService::getBusinessRemind($params);
        $this->render('remind', array('data' => $data));
    }

    //聊天消息 chatsession
    public function actionChatsession() {
        $params['userid'] = Yii::app()->request->getParam('userid');
        $params['touserid'] = Yii::app()->request->getParam('touserid');
        $params['sessionid'] = Yii::app()->request->getParam('sessionid');
        $params['hasnew'] = Yii::app()->request->getParam('hasnew');
        $chat = RemindService::chat_session($params);
        echo json_encode($chat);
    }

    //聊天消息记录表
    public function actionChatrecord() {
        $params['sessionid'] = Yii::app()->request->getParam('sessionid');
        $params['userid'] = Yii::app()->request->getParam('userid');
        $params['touserid'] = Yii::app()->request->getParam('touserid');
        $params['name'] = Yii::app()->request->getParam('name');
        $params['msg'] = Yii::app()->request->getParam('msg');
        $params['isread'] = Yii::app()->request->getParam('isread');
        $record = RemindService::record($params);
        echo json_encode($record);
    }

    //聊天消息 获取sessionid
    public function actionGetchat() {
        $userid = Yii::app()->request->getParam('userid');
        $rs = Yii::app()->chatmongodb->getDbInstance()->chat_sessions->find(array("userid" => $userid));
        foreach ($rs as $ks => $v) {
            $data[$ks] = $v['sessionid'];
        }
        echo json_encode($data);
    }

    //获取sessionid用户机构信息
    public function actionUserinfo() {
        $data = RemindService::userinfo();
        echo json_encode($data);
    }

}

?>
