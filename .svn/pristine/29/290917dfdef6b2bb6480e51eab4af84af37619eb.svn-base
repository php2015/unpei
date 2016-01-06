<?php

/*
 * 退货管理
 */

class ReturnorderService {
    /*
     * 退货首页 获取退货单列表  (seach查询方法js)
     */

    public static function getRetorderlist($Type = 0, $ID = 0) {
        $organID = Yii::app()->user->getOrganID();
        $criteria = new CDbCriteria();
        $criteria->order = "t.ID desc";
        if ($_GET) {
            $ReturnNO = Yii::app()->request->getParam('ReturnNO');
            if ($ReturnNO && $ReturnNO != '请输入退货单号') {
                $criteria->addCondition("t.ReturnNO like'%$ReturnNO%'", "AND");
            }
            $DealerName = Yii::app()->request->getParam('DealerName');

            if ($DealerName) {
                $sql = "select ID from jpd_organ where OrganName like '%$DealerName%'";
                $sqlParams = array();
                $res = Yii::app()->jpdb->createCommand($sql)->queryAll($sqlParams);
                foreach ($res as $v) {
                    $modelRow[] = $v[0];
                }
                $criteria->addInCondition('t.DealerID', $modelRow, "AND");
            }


            $start_time = Yii::app()->request->getParam('start_time');
            $end_time = Yii::app()->request->getParam('end_time');
            if (isset($start_time) && !empty($start_time)) {
                $Start_time = strtotime($start_time);
                $criteria->addCondition("t.CreateTime>=$Start_time", "AND");
            }
            if (isset($end_time) && !empty($end_time)) {
                $End_time = strtotime("{$end_time} + 1 day");
                $criteria->addCondition("t.CreateTime<=$End_time", 'AND');
            }

            $Type = Yii::app()->request->getParam('Type');
            if ($Type) {
                $criteria->addCondition("t.Type like '%$Type%'", "AND");
            }
            $Status = Yii::app()->request->getParam('Status');
            if ($Status) {
                switch ($Status) {
                    case 1;
                        $cond = "t.Status in (1,11)";
                        break;
                    case 2;
                        $cond = "t.Status = 2";
                        break;
                    case 3;
                        $cond = "t.Status in(3,13)";
                        break;
                    case 4;
                        $cond = "t.Status in(4,14)";
                        break;
                    case 5;
                        $cond = "t.Status in(5,12)";
                        break;
                    case 6;
                        $cond = "t.Status in(6,16) or t.ComplainStatus =3";
                        break;
                }
                $criteria->addCondition($cond, "AND");
            }
        }
        $criteria->addCondition(" t.ServiceID = " . $organID, "AND");
        $criteria->with = array('returngoods');
        $data = new CActiveDataProvider('PapReturnOrder', array(
            'criteria' => $criteria,
            'pagination' => array(
                'pageSize' => 4,
        )));
        return $data;
    }

    /*
     * 申请退货 获取订单列表 （seach查询方法get控制器）
     */

    public static function getRetordlist($params) {
        $buyID = Yii::app()->user->getOrganID();
        $OrganID = Yii::app()->request->getParam('id');
        $criteria = new CDbCriteria();
        $criteria->addCondition("t.ReturnStatus =0", "AND");  //未退货
        $criteria->addCondition("t.SellerID = $OrganID", "AND");
        $criteria->addCondition("t.BuyerID = $buyID", "AND");
        $criteria->addCondition("t.IsDelete = 0", "AND"); //未删除
        $criteria->addCondition("t.Status = 9", "AND"); //已收货
//        $criteria->addInCondition('t.Status', array(1,2,9)); 
        if ($params['OrderSN']) {
            $criteria->addCondition("t.OrderSN like '%{$params['OrderSN']}%'", "AND");
        }
        $Title = $params['Title'];
        if ($Title) {
            $sql2 = "select a.OrderID,a.GoodsName,b.Pinyin from pap_order_goods a left join pap_goods b on a.GoodsID = b.ID  where GoodsName like '%{$Title}%'";
            $sql2 .=" or a.Brand like '%{$Title}%'";
            $sql2 .=" or a.GoodsNum like '%{$Title}%'";
            $sql2 .=" or a.GoodsOE like '%{$Title}%'";
            $sql2 .=" or b.Pinyin like '%{$Title}%'";
            $res2 = Yii::app()->papdb->createCommand($sql2)->queryAll();
            foreach ($res2 as $k1 => $v1) {
                if (!empty($v1)) {
                    $sql2 = "select * from pap_order where ID={$v1['OrderID']}";
                    $order2 = Yii::app()->papdb->createCommand($sql2)->queryAll();
                }
                if ($order2) {
                    foreach ($order2 as $ke1 => $ve1) {
                        $modelRow1[] = $ve1['ID'];
                    }
                }
            }
            $criteria->addInCondition('t.ID', $modelRow1, "AND");
        }
        $Vehicle = $params['Vehicle'];
        if ($Vehicle) {
            $Vehicle = explode(' ', $Vehicle);
            $sql = "select * from pap_goods_vehicle_relation where Marktxt = '" . $Vehicle[0] . "'";
            if ($Vehicle[1]) {
                $sql .=" and Cartxt = '" . $Vehicle[1] . "'";
            }
            if ($Vehicle[2] && $Vehicle[2] != "不确定年款") {
                $sql .=" and Year = '" . $Vehicle[2] . "'";
            }
            if ($Vehicle[3] && $Vehicle[3] != "不确定车型") {
                $sql .=" and Modeltxt = '" . $Vehicle[3] . ' ' . $Vehicle[4] . "'";
            }
            $res = Yii::app()->papdb->createCommand($sql)->queryAll();
            foreach ($res as $k => $v) {
                if (!empty($v)) {
                    $sql = "select * from pap_order_goods where MakeID= '" . $v['Make'] . "'";
                    $sql .=" and CarID = '" . $v['Car'] . "'";
                    if ($Vehicle[2] == '不确定年款') {
                        $sql .=" ";
                    } else {
                        $sql .=" and Year = '" . $v['Year'] . "'";
                    }
                    if (empty($Vehicle[3]) || $Vehicle[3] == '不确定车型') {
                        $sql .=" ";
                    } else {
                        $sql .=" and ModelID = '" . $v['Model'] . "'";
                    }
                    $order = Yii::app()->papdb->createCommand($sql)->queryAll();
                }
                if ($order) {
                    foreach ($order as $ke => $ve) {
                        $modelRow[] = $ve['OrderID'];
                    }
                }
            }
            $criteria->addInCondition('t.ID', $modelRow, "AND");
        }
        if (isset($_GET['start_time']) && !empty($_GET['start_time'])) {
            $start_time = strtotime($_GET['start_time']);
            $criteria->addCondition("t.CreateTime>=$start_time", "AND");
        }
        if (isset($_GET['end_time']) && !empty($_GET['end_time'])) {
            $end_time = strtotime("{$_GET['end_time']} + 1 day");
            $criteria->addCondition("t.CreateTime<=$end_time", 'AND');
        }
        $criteria->order = "t.CreateTime DESC";
        $criteria->with = array('goods');
        $data = new CActiveDataProvider('PapOrder', array(
            'criteria' => $criteria,
            'pagination' => array(
                'pageSize' => 4,
        )));
        return $data;
    }

    /*
     * 申请退货 获取订单里面的商品数据
     */

    public static function Getordergoodlist() {
        $ID = explode('_', Yii::app()->request->getParam('ID'));
        if (count($ID) > 5) {
            return false;
        }
        $criteria = new CDbCriteria();
        $criteria->addInCondition("t.ID", $ID);
        $criteria->with = array('goods');
        $model = PapOrder::model()->findAll($criteria);
        if (count($ID) != count($model)) {
            return false;
        }
        return $model;
    }

    /*
     * 退货申请(退款)   选择经销商 
     */

    public static function getDelername2($params) { //PapOrder 经销商
        $organID = Yii::app()->user->getOrganID();
        $criteria = new CDbCriteria();
        $criteria->group = 't.SellerID';
        $criteria->select = 't.SellerID,t.SellerName ';
        $criteria->addCondition("t.BuyerID=$organID and t.SellerID!='' and t.SellerName!=''");
        if ($params['SellerName']) {
            $criteria->addCondition("t.SellerName like '%{$params['SellerName']}%'", "AND");
        }
        $dataProvider = new CActiveDataProvider('PapOrder', array(
            'criteria' => $criteria,
            'pagination' => array(
                'pageSize' => 8,
            )
        ));
        $data = $dataProvider->getData();
        foreach ($data as $key => $value) {
            $data[$key] = $value;
            $SellerID = $value['SellerID'];
            $res = F::getOrgan($SellerID);
            $data[$key]['SellerName'] = $res['OrganName'];
        }
        $data = $dataProvider->setData($data);
        return $dataProvider;
    }

    /*
     * 确认收款（申请退款）
     */

    public static function getpassprice() {
        $ID = Yii::app()->request->getParam('ID');
        $model = PapReturnOrder::model()->updateByPk($ID, array("Status" => 14));
        $lists[] = 1;
        if ($model) {
            $list = PapReturnGoods::model()->findAll("ReturnID=:ID", array(":ID" => $ID));
            foreach ($list as $v) {
                if (!in_array($v['OrderID'], $lists)) {
                    $model = PapOrder::model()->updateByPk($v['OrderID'], array("ReturnStatus" => 14)); //订单状态 退款完成
                    $lists[] = $v['OrderID'];
                }
            }
        }
        return $model;
    }

//获取经销商名称
    public static function getDealer() {
        $organID = Yii::app()->request->getParam('id');
        $data = Organ::model()->findByPk($organID);
        return $data;
    }

    public static function getDealerinfo($id) {
        $sql = 'select Phone from jpd_organ where ID="' . $id . '"';
        $result = Yii::app()->jpdb->createCommand($sql)->queryRow();
        return $result['Phone'];
    }

    public static function getDealerinfodizhi($id) {
        $sql = 'select Province,City,Area from jpd_organ where ID="' . $id . '"';
        $result = Yii::app()->jpdb->createCommand($sql)->queryRow();
        return Area::getaddress($result['Province'], $result['City'], $result['Area']);
    }

    /*
     * 通过ID获取退货单列表里的商品数据  
     */

    public static function idgetgoodsinfo($OrderID, $GoodsID, $goodsinfo) {
        $model = PapOrderGoods::model()->find("OrderID=:OrderID and GoodsID=:GoodsID", array(":OrderID" => $OrderID, ":GoodsID" => $GoodsID));
        return $model->$goodsinfo;
    }

    public static function idgetimg($ID) {
        $model = PapGoodsImageRelation::model()->findAll("GoodsID =:ID", array(":ID" => $ID));
        return $model;
    }

    /*
     * 获取机构
     */

    public static function idgetname($ID) {
        $model = Organ::model()->findByPk($ID);
        return $model->OrganName;
    }

    /*
     * 获取退货单详情
     */

    public static function getorderinfo() {
        $ID = Yii::app()->request->getParam('ID');
        $criteria = new CDbCriteria();
        $criteria->addCondition(" t.ID = " . $ID, "AND");  //查找当前获取ID
        $criteria->with = "returngoods";
        $model = PapReturnOrder::model()->find($criteria);
        return $model;
    }

    /*
     * 获取机构信息
     */

    public static function getOrganinfo($ID, $Name = '') {
        $criteria = new CDbCriteria();
        $criteria->addCondition("ID = $ID");
        $model = Organ::model()->find($criteria);
        if ($Name == 'Address') {
            return Area::getCity($model->Province) . Area::getCity($model->City) . Area::getCity($model->Area) . $model->Address;
        } else if ($Name == 'all') {
            $model->Area = Area::getCity($model->Province) . Area::getCity($model->City) . Area::getCity($model->Area);
            return $model;
        } else {
            return $model->$Name;
        }
    }

    /*
     * 获取退货状态
     */

    public static function getStatus($Status) {
        if ($Status == 1) {
            return '退货待审核';
        } else if ($Status == 2) {
            return '退货待发货';
        } else if ($Status == 3) {
            return '退货待收货';
        } else if ($Status == 4) {
            return '退货完成';
        } else if ($Status == 5) {
            return '退货未通过';
        } else if ($Status == 6) {
            return '退货已取消';
        } else if ($Status == 11) {
            return '退款待审核';
        } else if ($Status == 12) {
            return '退款未通过';
        } else if ($Status == 13) {
            return '退款待收款';
        } else if ($Status == 14) {
            return '退款完成';
        } else if ($Status == 16) {
            return '退款已取消';
        }
    }

    /*
     * 获取退货单申诉状态
     */

    public static function getComplainStatus($ComplainStatus) {
        if ($ComplainStatus == 1) {
            return "申诉中";
        }
        if ($ComplainStatus == 2) {
            return "申诉已处理";
        }
        if ($ComplainStatus == 3) {
            return "申诉已取消";
        }
    }

    /*
     * 获取申诉单处理状态
     */

    public static function getHandleStatus($ReturnNO) {
        $sql = "select * from pap_complain where ReturnNO = '$ReturnNO'";
        $result = Yii::app()->papdb->createCommand($sql)->queryRow();
        return $result['HandleStatus'];
    }

    //发送提醒
    public static function sendRemind($params) {
        $time = $_SERVER['REQUEST_TIME'];
        $insert = ' insert into pap_remind_system (OrganID,OrganType,Type,LinkUrl,Title,Content,CreateTime,PromoterID) values(';
        $insert.="$params[OrganID],$params[OrganType],0,'$params[LinkUrl]','$params[Title]','$params[Content]',$time,$params[UserID])";
        $count = Yii::app()->papdb->createCommand($insert)->execute();
        return $count;
    }

    /*
     * 获得退货订单不同状态数量
     */

    public static function papreturnstatus($Status) {
        $organID = Yii::app()->user->getOrganID();
        $criteria = new CDbCriteria();
        $criteria->addCondition(" t.Status in($Status)", "AND");
        $criteria->addCondition(" t.ServiceID = " . $organID, "AND");
        $count = PapReturnOrder::model()->count($criteria);
        return $count;
    }

    public static function papgetComplainStatus($ComplainStatus) {
        $organID = Yii::app()->user->getOrganID();
        $criteria = new CDbCriteria();
        $criteria->addCondition(" t.ServiceID = " . $organID, "AND");
        $criteria->addCondition(" t.ComplainStatus = " . $ComplainStatus, "AND");
        $count = PapReturnOrder::model()->count($criteria);
        return $count;
    }

    public static function gen_order_sn() {
        /* 选择一个随机的方案 */
        mt_srand((double) microtime() * 1000000);
        $timestamp = time() - date('Z');
        $y = date('y', $timestamp);
        $z = date('z', $timestamp);
        $order_sn = $y . str_pad($z, 3, '0', STR_PAD_LEFT) . str_pad(mt_rand(1, 99999), 5, '0', STR_PAD_LEFT);

        $orders = PapOrder::model()->find('OrderSN=' . $order_sn);
        if (empty($orders)) {
            /* 否则就使用这个订单号 */
            return $order_sn;
        }

        /* 如果有重复的，则重新生成 */
        return $this->gen_order_sn();
    }

}

?>
