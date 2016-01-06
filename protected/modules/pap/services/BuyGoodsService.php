<?php

/* 购买商品，购物车逻辑层
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

Class BuyGoodsService {

    //获取购物车商品，根据经销商分组                                                                                                                                                                                                                                                               
    public static function getcart($cartids = array(), $payment) {
        $BuyerID = Yii::app()->user->getOrganID();
        //获取买家名称
        $organinfo = F::getOrgan($BuyerID);
        if ($organinfo)
            $BuyerName = $organinfo['OrganName'];
        $cartArr = array();
        $criteria = new CDbCriteria();
        $criteria->select = "distinct SellerID,SellerName,BuyerName";
        $criteria->addCondition("BuyerID = $BuyerID");
        if (!empty($cartids)) {
            $criteria->addInCondition('ID', $cartids);
        }
        $criteria->group = 'SellerID';

        $cart = PapCart::model()->findAll($criteria);
        if ($cart) {
            foreach ($cart as $key => $val) {
                $cartArr[$key]["SellerID"] = $val->SellerID; //卖家ID
                $cartArr[$key]["BuyerID"] = $BuyerID;
                //获取卖家名称
                if ($val->SellerID) {
                    $sellid = $val->SellerID;
                    $organ = F::getOrgan($sellid);
                    $cartArr[$key]["SellerName"] = $organ['OrganName'];
                }
                $cartArr[$key]["BuyerName"] = $BuyerName;

                //获取经销商订单折扣率--商城订单
                $sellerID = $val->SellerID;
                $discount = PapOrderDiscount::model()->find(array("condition" => "OrderType = 1"));
                if (isset($discount) && !empty($discount)) {
                    if ($payment == 1) {
                        $dis = $discount['OrderAlipay'];
                    } else if ($payment == 2) {
                        $dis = $discount['OrderLogis'];
                    }
                    if (isset($dis) && !empty($dis)) {
                        $cartArr[$key]["discount"] = $dis;
                    } else {
                        $cartArr[$key]["discount"] = 100;
                    }
                } else {
                    $cartArr[$key]["discount"] = 100;
                }

                //获取经销商订单最小交易额 
                $turnover = PapOrderMinTurnover::model()->find("OrganID=:ID", array(":ID" => $val->SellerID));
                if ($turnover) {
                    $cartArr[$key]["MinTurnover"] = $turnover['MinTurnover'];  //订单最小交易额
                }


                //将经销商的商品添加到经销商的组中
                unset($criteria);
                $criteria = new CDbCriteria();
                $criteria->addCondition("BuyerID = $BuyerID");
                $criteria->addCondition("SellerID = $val->SellerID", "AND");
                if (!empty($cartids)) {
                    $criteria->addInCondition("ID", $cartids);
                }
                //商品列表
                $cartArr[$key]["GoodsList"] = PapCart::model()->findAll($criteria);
                $sum = 0;
                foreach ($cartArr[$key]["GoodsList"] as $k => $value) {

                    // echo $sum.'<br>';
                    $ispro = PapGoods::model()->findBypk($value->GoodsID);
                    //如果生产订单时，则删除下架商品
                    if (in_array($payment, array(1, 2))) {
                        if ($ispro->IsSale == 0) {
                            unset($cartArr[$key]["GoodsList"][$k]);
                            continue;
                        }
                    }
                    if (!$ispro->IsPro) {
                        $goodsinfo = MallService::getDealerGoodByID($value->GoodsID);
                        $cartArr[$key]["GoodsList"][$k]->Price = $goodsinfo['Price'];
                        $cartArr[$key]["GoodsList"][$k]->ProPrice = $goodsinfo['DisPrice'];
                        $cartArr[$key]["GoodsList"][$k]->Version = $goodsinfo['Version'];
                    }
                    if ($ispro->IsPro == 1) {
                        $cartArr[$key]["GoodsList"][$k]->ProPrice = $ispro['ProPrice'];
                    }
                    //有促销价取促销价,否则取参考价
                    $price = !empty($cartArr[$key]["GoodsList"][$k]->ProPrice) ? $cartArr[$key]["GoodsList"][$k]->ProPrice : $cartArr[$key]["GoodsList"][$k]->Price;
                    $quan = $value['Quantity'];
                    $total = $price * $quan;
                    //算出每组经销商所有商品加起来总价
                    $sum+=$total;
                }
                /* 如果总价小于最小交易金额,则不生成订单;
                 * payment0是用于区分购物车，虽小于最小交易金额，但购物车还是显示该商品
                 * payment 1,2在之内的说明跳到收货地址生成订单,需删除小于最小交易金额的该经销商商品,总价
                 * 小于最小金额不能生产订单
                 */
                //var_dump($sum);
                if (in_array($payment, array(1, 2))) {
                    $cartArr[$key]['sum'] = $sum;
                    if ($cartArr[$key]['sum'] < $cartArr[$key]['MinTurnover']) {
                        unset($cartArr[$key]);
                    }
                }
                //如果全部是下架商品，下订单则删除此商品
                if (in_array($payment, array(1, 2))) {
                    if (count($cartArr[$key]["GoodsList"]) <= 0) {
                        unset($cartArr[$key]);
                        continue;
                    }
                }
            }
        }
        return $cartArr;
    }

    //判断商品是否下架
    public static function issale($goodsid) {
        $sql = "select IsSale from pap_goods where ISdelete=1 and ID=$goodsid";
        $goods = Yii::app()->papdb->createCommand($sql)->queryRow();
        return $goods['IsSale'];
    }

    //获取购物车商品，根据经销商分组
    public static function getpurchase($purchaseids = array(), $payment) {
        $BuyerID = Yii::app()->user->getOrganID();
        $purchaseids = implode(',', $purchaseids);
        $cartArr = array();
        $sql = "select distinct jo1.ID as SellerID,jo1.OrganName as SellerName,jo2.ID as BuyerID,
        		jo2.OrganName as BuyerName from 
				pap_reserve_purchase as prp, pap_goods as pg, jpd.jpd_organ as jo1, jpd.jpd_organ as jo2
				where prp.ID in ({$purchaseids}) AND prp.GoodsID = pg.ID AND pg.OrganID = jo1.ID 
				AND prp.OrganID = jo2.ID AND prp.OrganID = '{$BuyerID}'";
        $purchase = Yii::app()->papdb->createCommand($sql)->queryAll();

        if ($purchase) {
            foreach ($purchase as $key => $val) {

                $cartArr[$key]["SellerID"] = $val['SellerID']; //卖家ID
                $cartArr[$key]["SellerName"] = $val['SellerName']; //卖家名称
                $cartArr[$key]["BuyerName"] = $val['BuyerName']; //买家名称
                //获取经销商订单折扣率--商城订单
                $sellerID = $val['SellerID'];
                $discount = PapOrderDiscount::model()->find(array("condition" => "OrderType = 1"));

                if (isset($discount) && !empty($discount)) {
                    if ($payment == 1) {
                        $dis = $discount['OrderAlipay'];
                    } else if ($payment == 2) {
                        $dis = $discount['OrderLogis'];
                    }
                    if (isset($dis) && !empty($dis)) {
                        $cartArr[$key]["discount"] = $dis;
                    } else {
                        $cartArr[$key]["discount"] = 100;
                    }
                } else {
                    $cartArr[$key]["discount"] = 100;
                }
                //获取经销商订单最小交易额 
                $turnover = PapOrderMinTurnover::model()->find("OrganID=:ID", array(":ID" => $val['SellerID']));
                if ($turnover) {
                    $cartArr[$key]["MinTurnover"] = $turnover['MinTurnover'];  //订单最小交易额
                }

                //将经销商的商品添加到经销商的组中
                $sql = "SELECT distinct  prp.ID as purchaseID, pg.ID as GoodsID, pg.Price, pg.ProPrice, 
    			pg.IsPro, prp.Num as Quantity, pg.Name as GoodsName, pg.GoodsNO as GoodsNum, 
    			pg.Brand, jg.Name as CpName, prp.CreateTime, pg.OrganID, pg.Version
		    	FROM pap_reserve_purchase AS prp , jpd.jpd_gcategory AS jg, 
		    	pap_goods AS pg
		        WHERE prp.GoodsID = pg.ID AND prp.GcategoryCode = jg.Code 
		        AND prp.OrganID = '{$BuyerID}' AND pg.OrganID = '{$val['SellerID']}' AND  prp.ID in ({$purchaseids})
        		";
                $cartArr[$key]["GoodsList"] = Yii::app()->papdb->CreateCommand($sql)->queryAll();

                foreach ($cartArr[$key]["GoodsList"] as $k => $value) {
                    $ispro = PapGoods::model()->findBypk($value['GoodsID']);
                    if (!$ispro->IsPro) {
                        $goodsinfo = MallService::getDealerGoodByID($value['GoodsID']);
                        $cartArr[$key]["GoodsList"][$k]['Price'] = $goodsinfo['Price'];
                        $cartArr[$key]["GoodsList"][$k]['ProPrice'] = $goodsinfo['DisPrice'];
                    }
                    if ($ispro->IsPro == 1) {
                        $cartArr[$key]["GoodsList"][$k]['ProPrice'] = $ispro['ProPrice'];
                    }
                }
            }
        }
        return $cartArr;
    }

    //修改购物车商品数量
    public static function updatequan($params) {
        $model = PapCart::model()->findByPk($params["ID"]);
        if ($model) {
            $model->Quantity = $params["Quantity"];
            return $model->save();
        } else {
            return false;
        }
    }

    //删除购物车车商品
    public static function delgood($params) {
        $ID = $params['ID'];
        return PapCart::model()->deleteByPk($ID);
    }

    //添加收货地址
    public static function addadress($params) {
        $model = new PapOrderAddress();
        $model->attributes = $params;
        return $model->save();
    }

    //由购物车商品结算生成订单
    public static function createorder($params) {
        $payment = $params['payment'];
        $ShipLogis = $params['ShipLogis'];
        $ship = $params['ship'];
        $usecouponID = !empty($params['usecouponID'])?$params['usecouponID']:'';
        //订单类型  1商城订单 2询价单订单  3报价单订单 
        $ordertype = $params['ordertype'] ? $params['ordertype'] : 1;
        $orderIdArr = array();
        $kd = 0;
        foreach ($params['cartsGoods'] as $k => $cart) {
            $sellerID = $cart['SellerID'];
            $min_price = isset($cart['MinTurnover']) ? $cart['MinTurnover'] : 0;
            if ($ordertype == 1) {
                //获取经销商订单折扣率--商城订单
                $discount = PapOrderDiscount::model()->find(array("condition" => " OrderType = 1"));
            } elseif ($ordertype == 2 || $ordertype == 3) {
                //获取经销商订单折扣率--询报价订单
                $discount = PapOrderDiscount::model()->find(array("condition" => " OrderType = 2"));
            }
            if (!is_null($discount)) {
                if ($payment == 1) {
                    $dis = $discount['OrderAlipay'];
                } else if ($payment == 2) {
                    $dis = $discount['OrderLogis'];
                }
                if (isset($dis) && !empty($dis)) {
                    $dis = $dis;
                } else {
                    $dis = 100;
                }
            } else {
                $dis = 100;
            }
            $orderArr = array();
            $cartIdArr = array();
            $goodsPrice = 0;
            $shipCost = 0;
            $totalPrice = 0;
            $listCount = 0;
            $count = 0;
            $amountlist = 0;
            //循环获得商品总价
            foreach ($cart["GoodsList"] as $list) {
                $listCount += $list['Quantity'];
                if ($list['ProPrice']) {
                    $count +=round($list['ProPrice'] * $dis / 100, 2) * $list['Quantity'];
                    //$count +=round($list['ProPrice'] * $list['Quantity']*$dis/100,2);
                    //$counts +=(round($list['ProPrice'] * $dis /100, 2) * $list['Quantity']);
                } else {
                    $count +=round($list['Price'] * $dis / 100, 2) * $list['Quantity'];
                    //$count +=round($list['Price'] * $list['Quantity']*$dis/100,2);
                    //$counts +=(round($list['Price'] * $dis /100, 2) * $list['Quantity']);
                }
            }
            // $amountlist +=round($count * $dis / 100, 2);
            $amountlist+=$count;
            $minus = 0;
            $order_sn = self::gen_order_sn();
            $orderArr["order"] = array(
                "OrderSN" => "DD" . $order_sn,
                "OrderName" => "嘉配订单:DD" . $order_sn,
                "SellerID" => $cart["SellerID"],
                "SellerName" => $cart["SellerName"],
                "BuyerID" => $cart['BuyerID'],
                "BuyerName" => $cart["BuyerName"],
                "Payment" => $payment,
                "OrderType" => $ordertype, //订单类型
                'Discount' => $dis,
                //物流公司
                "ShipLogis" => $ShipLogis[$kd],
                //  "ShipLogis" => $cart["ShipLogis"],
                "Status" => ($payment == 1) ? 1 : 2,
                "CreateTime" => time(),
                "UpdateTime" => time()
            );

            // 收货地址
            $orderArr["address"] = array(
                "ShippingName" => $ship['ContactName'],
                "ZipCode" => $ship['ZipCode'],
                "Mobile" => $ship['Phone'],
                "Province" => $ship['State'],
                "City" => $ship['City'],
                "Area" => $ship['District'],
                "Address" => trim($ship['Address']),
                "CreateTime" => time()
            );

            foreach ($cart["GoodsList"] as $key => $list) {

                $list['ProPrice'] = round(($list['ProPrice'] + $minus) * $dis / 100, 2);
                //获取商品oe
                $oes = PapGoods::getOENOSByGoodsID($list['GoodsID']);
                $data = array(
                    "GoodsID" => $list['GoodsID'],
                    "GoodsNum" => $list['GoodsNum'],
                    "GoodsOE" => $oes ? $oes : $list['GoodsOE'],
                    "GoodsName" => $list['GoodsName'],
                    "CpName" => $list['CpName'],
                    "Brand" => $list['Brand'],
                    "Price" => $list['Price'],
                    "ProPrice" => $list['ProPrice'],
                    "Quantity" => $list['Quantity'],
                    "ShipCost" => $list['ShipCost'] * $list['Quantity'],
                    "GoodsAmount" => $list['ProPrice'] ? ($list['ProPrice']) * $list['Quantity'] : ($list['Price']) * $list['Quantity'],
                    "CreateTime" => time(),
                    "UpdateTime" => time(),
                    'Version' => $list['Version'],
                    "MakeID" => $list['MakeID'],
                    "CarID" => $list['CarID'],
                    "Year" => $list['Year'],
                    "ModelID" => $list['ModelID']
                );
                $goodsPrice += $data['GoodsAmount'];
                $shipCost += $data['ShipCost'];
                $totalPrice = $goodsPrice + $shipCost;      //订单金额（商品总价+物流总价）
                //订单实付金额折扣率
                $amountPrice = $amountlist;
                $orderArr["goodsList"][$key] = $data;
                $cartIdArr[] = $list['ID'];
            }
            $realPrice = $amountPrice + $shipCost;     //实付金额：折后价+物流费
            $orderArr["order"]["GoodsAmount"] = $goodsPrice;
            $orderArr["order"]["ShipCost"] = $shipCost;
            $orderArr["order"]["TotalAmount"] = $totalPrice;   //实付金额
            $orderArr["order"]["RealPrice"] = $realPrice;   //订单金额
            //促销活动
            $actparam = array('total' => $totalPrice, 'payment' => $payment);
            $act_res = self::activedecre($actparam);
            if (!empty($act_res) && is_array($act_res)) {
                $orderArr["order"]['PromoID'] = intval($act_res['PromoID']);
                $orderArr["order"]['DecrAmount'] = $act_res["DecrAmount"];
                $orderArr["order"]['DecrTotal'] = $act_res["DecrTotal"];
                $orderArr['order']['Type'] = $act_res['Type'];
                $orderArr["order"]["RealPrice"] = $act_res['RealPrice'];
                $orderArr["order"]["TotalAmount"] = $act_res['RealPrice'];
                $orderArr["order"]['CouponID'] = $act_res['CouponID'];
            }
                /*  使用优惠券
                 * params $decoupon 优惠券内容,$totalPrice订单金额 $orderArr订单数组
                 */
            if (isset($usecouponID) && !empty($usecouponID)) {
                $decoupon = self::couponbyID($usecouponID);
                $orderArr = self::usecoupon($decoupon, $totalPrice, $orderArr);
            }
            //订单生成
            $orderId = OrderService::create($orderArr);
            $orderIdArr[] = $orderId;
            if ($orderId && $ordertype == 1) {
                //生成订单号，同步删除购物车中的商品信息
                self::delGoodsAfterOrder($cartIdArr);
                //移除存入session的被添加入订单的商品id
                if (Yii::app()->session['var']) {
                    unset(Yii::app()->session['var']);
                }
            }
            $kd++;
        }

        $orderIdStr = implode(',', $orderIdArr);
        return $orderIdStr;
    }

    //由预约管理采购商品结算生成订单
    public static function createorderFromPurchase($params) {
        $payment = $params['payment'];
        $ShipLogis = $params['ShipLogis'];
        $ship = $params['ship'];

        $orderIdArr = array();
        $kd = 0;
        foreach ($params['purchaseGoods'] as $k => $purchase) {
            $sellerID = $purchase['SellerID'];
            $min_price = isset($purchase['MinTurnover']) ? $purchase['MinTurnover'] : 0;
            //获取经销商订单折扣率--商城订单
            $discount = PapOrderDiscount::model()->find(array("condition" => " OrderType = 1"));
            if (!is_null($discount)) {
                if ($payment == 1) {
                    $dis = $discount['OrderAlipay'];
                } else if ($payment == 2) {
                    $dis = $discount['OrderLogis'];
                }
                if (isset($dis) && !empty($dis)) {
                    $dis = $dis;
                } else {
                    $dis = 100;
                }
            } else {
                $dis = 100;
            }
            $orderArr = array();
            $purchaseIdArr = array();
            $goodsPrice = 0;
            $shipCost = 0;
            $totalPrice = 0;
            $listCount = 0;
            $count = 0;
            $amountlist = 0;
            //循环获得商品总价
            foreach ($purchase["GoodsList"] as $list) {
                $listCount += $list['Quantity'];
                if ($list['ProPrice']) {
                    $count +=$list['ProPrice'] * $list['Quantity'];
                    $counts +=round($list['ProPrice'] * $purchase['discount'] / 100, 2) * $list['Quantity'];
                } else {
                    $count +=$list['Price'] * $list['Quantity'];
                    $counts +=round($list['Price'] * $purchase['discount'] / 100, 2) * $list['Quantity'];
                }
            }
            //生成平摊金额
            if ($min_price && round($count * $dis / 100, 2) < $min_price) {
                $minus = round(($min_price - $count) / $listCount, 2);
                //  $list['ProPrice']=$list['ProPrice']+$minus;
                $amountlist +=$count + $minus * $listCount;
                if ($amountlist < $min_price) {
                    $amountlist = $min_price;
                }
            } else {
                $amountlist +=round($count * $dis / 100, 2);
                //$list['ProPrice']=round(($list['ProPrice'] + $minus)*$dis/100,2);
                $minus = 0;
            }
            $order_sn = self::gen_order_sn();
            $orderArr["order"] = array(
                "OrderSN" => "DD" . $order_sn,
                "OrderName" => "嘉配订单:DD" . $order_sn,
                "SellerID" => $purchase["SellerID"],
                "SellerName" => $purchase["SellerName"],
                "BuyerID" => Yii::app()->user->getOrganID(),
                "BuyerName" => $purchase["BuyerName"],
                "Payment" => $payment,
                "OrderType" => 1, //订单类型
                'Discount' => $dis,
                //物流公司
                "ShipLogis" => $ShipLogis[$kd],
                "Status" => ($payment == 1) ? 1 : 2,
                "CreateTime" => time(),
                "UpdateTime" => time()
            );

            $orderArr["address"] = array(
                "ShippingName" => $ship['ContactName'],
                "ZipCode" => $ship['ZipCode'],
                "Mobile" => $ship['Phone'],
                "Province" => $ship['State'],
                "City" => $ship['City'],
                "Area" => $ship['District'],
                "Address" => $ship['Address'],
                "CreateTime" => time()
            );

            foreach ($purchase["GoodsList"] as $key => $list) {
                // $list = $list->getAttributes();
                if ($min_price && $counts < $min_price) {
                    $minus = round(($min_price - $count) / $listCount, 2);
                    $list['ProPrice'] = round($list['ProPrice'] * $dis / 100, 2);
                    //  $list['ProPrice'] = $list['ProPrice'] + $minus;
                } else {
                    $list['ProPrice'] = round(($list['ProPrice'] + $minus) * $dis / 100, 2);
                }
                //获取商品oe
                $oes = PapGoods::getOENOSByGoodsID($list['GoodsID']);
                $data = array(
                    "GoodsID" => $list['GoodsID'],
                    "GoodsNum" => $list['GoodsNum'],
                    "GoodsOE" => $oes ? $oes : $list['GoodsOE'],
                    "GoodsName" => $list['GoodsName'],
                    "CpName" => $list['CpName'],
                    "Brand" => $list['Brand'],
                    "Price" => $list['Price'],
                    "ProPrice" => $list['ProPrice'],
                    "Quantity" => $list['Quantity'],
                    "ShipCost" => $list['ShipCost'] * $list['Quantity'],
                    "GoodsAmount" => $list['ProPrice'] ? ($list['ProPrice']) * $list['Quantity'] : ($list['Price']) * $list['Quantity'],
                    "Version" => $list['Version'],
                    "CreateTime" => time(),
                    "UpdateTime" => time()
                );
                $goodsPrice += $data['GoodsAmount'];
                $shipCost += $data['ShipCost'];
                $totalPrice = $goodsPrice + $shipCost;      //订单金额（商品总价+物流总价）
                //订单实付金额折扣率
                $amountPrice = $amountlist;      //商品总价
                $orderArr['order']['Discount'] = '100%';
                if ($orderArr["goodsList"][$list['GoodsID']]) {
                    $orderArr["goodsList"][$list['GoodsID']]['GoodsAmount'] +=$data['GoodsAmount'];
                    $orderArr["goodsList"][$list['GoodsID']]['Quantity'] +=$data['Quantity'];
                } else {
                    $orderArr["goodsList"][$list['GoodsID']] = $data;
                }
                $purchaseIdArr[] = $list['purchaseID'];
            }
            $realPrice = $amountPrice + $shipCost;     //实付金额：折后价+物流费
            $orderArr["order"]["GoodsAmount"] = $goodsPrice;
            $orderArr["order"]["ShipCost"] = $shipCost;
            $orderArr["order"]["TotalAmount"] = $totalPrice;   //实付金额
            $orderArr["order"]["RealPrice"] = $realPrice;   //订单金额
            $orderId = OrderService::create($orderArr);
            $orderIdArr[] = $orderId;
            if ($orderId) {
                //将订单号添加到purchase中
                self::addOrderToPurchase($orderId, $purchaseIdArr);
            }
            $kd++;
        }

        $orderIdStr = implode(',', $orderIdArr);
        return $orderIdStr;
    }

    /*
     * 立即订购生成订单
     */

    public static function createbuynoworder($params) {
        $goods = $params['goods'];
        $payment = $params['payment'];
        $ShipLogis = $params['shiplogis'];
        $ship = $params['ship'];
        $quantity = $params['quantity'];
        $locate = $params['locate'];
        $BuyerID = Yii::app()->user->getOrganID();
        $organ = Organ::model()->findByPk($BuyerID)->attributes;
        $BuyName = $organ['OrganName'];
        $usecouponID = $params['usecouponID'];
        //获取订单最小交易额
        $turnover = PapOrderMinTurnover::model()->find("OrganID=:ID", array(":ID" => $goods['SellerID']));
        $min_price = $turnover['MinTurnover'] ? $turnover['MinTurnover'] : 0;

        //获取经销商订单折扣率--商城订单
        $discount = PapOrderDiscount::model()->find(array("condition" => " OrderType = 1"));
        if ($discount) {
            if ($payment == 1) {
                $dis = $discount['OrderAlipay'];
            } else if ($payment == 2) {
                $dis = $discount['OrderLogis'];
            }
            if (isset($dis) && !empty($dis)) {
                $dis = $dis;
            } else {
                $dis = 100;
            }
        } else {
            $dis = 100;
        }

        $orderArr = array();
        $order_sn = self::gen_order_sn();
        //array("order"=>array(),"goodsList"=> array())
        $orderArr["order"] = array(
            "OrderSN" => "DD" . $order_sn,
            "OrderName" => "嘉配订单:DD" . $order_sn,
            "SellerID" => $goods["SellerID"],
            "SellerName" => $goods["OrganName"],
            "BuyerID" => $BuyerID,
            "BuyerName" => $BuyName,
            "Payment" => $payment, //付款方式
            "OrderType" => 1, //订单类型
            "Discount" => $dis,
            //物流公司
            "ShipLogis" => $ShipLogis['0'],
            "Status" => ($payment == 1) ? 1 : 2,
            "CreateTime" => time(),
            "UpdateTime" => time()
        );
        //收货地址
        $orderArr["address"] = array(
            "ShippingName" => $ship['ContactName'],
            "ZipCode" => $ship['ZipCode'],
            "Mobile" => $ship['Phone'],
            "Province" => $ship['State'],
            "City" => $ship['City'],
            "Area" => $ship['District'],
            "Address" => $ship['Address'],
            "CreateTime" => time()
        );

        $SellPrice = $goods["ProPrice"] ? $goods["ProPrice"] : $goods["DisPrice"];
        //生成平摊金额
        $amount = round($SellPrice * $dis / 100, 2) * $quantity;
        $GoodsAmount = $amount;
        //$GoodsAmount = round($amount * $dis / 100, 2);
        $avg = 0;
        $SellPrice = round($SellPrice * $dis / 100, 2);

        //定位车系
        $locate = explode('_', $locate);
        $data[] = array(
            "GoodsID" => $goods['GoodsID'],
            "GoodsNum" => $goods['GoodsNO'],
            "GoodsOE" => $goods['OENO'],
            "GoodsName" => $goods['Name'],
            "CpName" => $goods['CpName'],
            "Brand" => $goods['BrandName'],
            "Price" => $goods['Price'],
            "ProPrice" => $SellPrice,
            "Quantity" => $quantity,
            "ShipCost" => $goods['LogisticsPrice'] * $quantity,
            "GoodsAmount" => $GoodsAmount, //商品总价
            "Version" => $goods['Version'],
            "CreateTime" => time(),
            "UpdateTime" => time(),
            "MakeID" => $locate[0],
            "CarID" => $locate[1],
            "Year" => $locate[2],
            "ModelID" => $locate[3]
        );

        $goodsPrice = $data['0']["GoodsAmount"];
        $shipCost = $data['0']["ShipCost"];
        $totalPrice = $goodsPrice + $shipCost;      //订单总价
        //订单实付金额折扣率
        $amountPrice = $GoodsAmount;    //商品总价

        $realPrice = $amountPrice + $shipCost;     //实付金额：折后价+物流费
        $orderArr["goodsList"] = $data;
        $orderArr["order"]["GoodsAmount"] = $goodsPrice;
        $orderArr["order"]["ShipCost"] = $shipCost;
        $orderArr["order"]["TotalAmount"] = $totalPrice;   //实付金额
        $orderArr["order"]["RealPrice"] = $realPrice;

        $actparam = array('total' => $totalPrice, 'payment' => $payment);
        $act_res = self::activedecre($actparam);
        if (!empty($act_res) && is_array($act_res)) {
            $orderArr["order"]['PromoID'] = intval($act_res['PromoID']);
            $orderArr["order"]['DecrAmount'] = floatval($act_res["DecrAmount"]);
            $orderArr["order"]['DecrTotal'] = floatval($act_res["DecrTotal"]);
            $orderArr['order']['Type'] = $act_res['Type'];
            $orderArr["order"]["RealPrice"] = floatval($act_res['RealPrice']);
            $orderArr["order"]["TotalAmount"] = floatval($act_res['RealPrice']);
            $orderArr["order"]['CouponID'] = $act_res['CouponID'];
        }
            /*优惠活动 使用优惠券
             * params $decoupon 优惠券内容,$totalPrice订单金额 $orderArr订单数组
             */
        if (isset($usecouponID) && !empty($usecouponID)) {
            $decoupon = self::couponbyID($usecouponID);
            $orderArr = self::usecoupon($decoupon, $totalPrice, $orderArr);

        }
        $orderId = OrderService::create($orderArr);
        return $orderId;
    }

    /**
     * 订单生成后删除购物车的商品
     * @param array $CartIDs 订单商品ID列表
     * @return type
     */
    public static function delGoodsAfterOrder($CartIDs) {
        foreach ($CartIDs as $cart) {
            $model = PapCart::model()->deleteByPk($cart);
        }
        return $model;
    }

    /**
     * 订单生成后将订单号添加到预约管理采购单表中
     * @param array $orderID 订单ID
     * @param array $purchaseIDs 采购单ID列表
     * @return type
     */
    public static function addOrderToPurchase($orderID, $purchaseIDs) {
        foreach ($purchaseIDs as $ID) {
            $time = time();
            //$model = PapCart::model()->deleteByPk($ID);
            $sql = "UPDATE pap_reserve_purchase SET OrderID = {$orderID},UpdateTime = {$time},InOrder = 1 WHERE ID = {$ID}";
            $result = Yii::app()->papdb->createCommand($sql)->execute();
        }
        return $result;
    }

    //生成订单号
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

    //获取能参与优惠活动的所有机构
    public static function activeorgan() {
        //条件 status=2开启 活动有效期  信用等级
        $sql = "select distinct a.ID from jpd.jpd_organ a ,pap.pap_promotion b "
                . "where b.target=a.UnionID  and b.Status=2  and"
                . " UNIX_TIMESTAMP(NOW())>= b.StartTime and UNIX_TIMESTAMP(NOW())<=b.EndTime";
        $res = Yii::app()->jpdb->createCommand($sql)->queryAll();
        $data = array();
        foreach ($res as $ke => $ve) {
            $data[] = $ve['ID'];
        }
        return $data;
    }

    //获取开启的优惠活动
    public static function active() {
        $organID = Yii::app()->user->getOrganID();
        $time = time();
        $sql = "select ID,Title,StartTime,EndTime,Daylimit,Type,Target,TargetLevel,"
                . "Payment,Content,Url,Status from pap_promotion a  where  Status=2  ";
//        $sql = "select a.ID,a.Title,a.StartTime,a.EndTime,a.Daylimit,a.Type,a.Target,a.TargetLevel,"
//                . " a.Payment,a.Content,a.Url,a.`Status`,b.LastTime from pap_promotion a,pap_promotion_times b"
//                . " where  a.`Status`=2  and b.OrganID=$organID and b.Num<=a.Daylimit   ";
        $act = Yii::app()->papdb->createCommand($sql)->queryRow();
        return $act;
    }

    //优惠活动
    public static function activedecre($actparam) {
        $organID = Yii::app()->user->getOrganID();
        //判断当前机构是否在活动参与对象范围内
        $data = self::activeorgan();
        //如果在
        if (in_array($organID, $data)) {
            //获取开启的优惠活动
            $act = self::active();
            $params = array();
            $act_arr = array();
            $payment = !empty($actparam['payment']) ? $actparam['payment'] + 1 : '2';
//            $in_day=OrderService::is_inday($act['LastTime']);
            $in_day = OrderService::is_inday(time());
            //判断日期是否为当天 支付方式哪一种 则为参与活动
            if (!empty($act) && is_array($act) && ($act['Payment'] == $payment || $act['Payment'] == 1) && $in_day == 1) {
                $params['PromoID'] = intval($act['ID']);
                $params['TotalAmount'] = $actparam['total'];
                $params['CouponAmount'] = $actparam['coupon'];
                $params['Type'] = $act['Type'];
                switch ($act['Type']) {
                    case 1:
                        //满减送
                        $act = self::decre($params);
                        break;
                    case 2:
                        //每满减
                        $act = self::pperdecre($params);
                        break;
                    case 3:
                        //满送优惠券
                        $act = self::coupondecre($params);
                        break;
                }
            } else {
                $act = array();
            }
        }
        return $act;
    }

    //优惠活动 满多少 减多少
    public static function decre($params) {
        //订单金额
        $totalamount = $params['TotalAmount'];
        $type = $params['Type'];
        //满减活动可以设置多个 判断是在哪个区间 100 -150,取100
        $pro_sql = "select  ID,PromoID,MinAmount,Derate,CouponPer,CouponID from pap_promotion_content where PromoID={$params['PromoID']}";
        $res = Yii::app()->papdb->createCommand($pro_sql)->queryAll();
        if (!empty($res) && is_array($res)) {
            foreach ($res as $key => $value) {
                $amou[$key] = $value['MinAmount'];
                $amouID[$key] = $value['ID'];
            }

            //排序活动金额
            asort($amou);
            $count = count($amou);
            foreach ($amou as $k => $v) {
                if ($amou[$k] < $totalamount && $totalamount < $amou[$k + 1]) {
                    //满减金额区间
                    $decrAmount = $amou[$k];
                    $decrID = $amouID[$k];
                    continue;
                } elseif ($totalamount > $amou[$count - 1]) {
                    //满减金额>最后一个金额
                    $decrID = $amouID[$count - 1];
                } else {
                    $decrID = $amouID[$k];
                }
            }

            //获取活动内容ID
            if (isset($decrID) && !empty($decrID)) {
                $sql = "select  ID,PromoID,MinAmount,Derate,CouponPer,CouponID from pap_promotion_content where ID=$decrID";
                $deres = Yii::app()->papdb->createCommand($sql)->queryRow();
                if ($deres) {
                    //订单金额减去满减金额=实际支付金额
                    if ($totalamount >= $deres['MinAmount']) {
                        $act_arr['RealPrice'] = $totalamount - $deres['Derate'];
                        //订单实付金额
                        //$act_arr['RealPrice'] = $order['RealPrice'];
                        $act_arr['DecrAmount'] = $deres['Derate'];
                        $act_arr['DecrTotal'] = $deres['Derate'];
                    } else {
                        $act_arr['RealPrice'] = $totalamount;
                        $act_arr['DecrAmount'] = 0;
                        $act_arr['DecrTotal'] = 0;
                    }
                    //活动满最下交易额
                    $act_arr['MinAmount'] = $deres['MinAmount'];
                    //活动减免金额
                    //活动ID
                    $act_arr['PromoID'] = $deres['PromoID'];
                    //活动类型
                    $act_arr['Type'] = $type;
                }
            }
        }
        return $act_arr;
    }

    //优惠活动每满减
    public static function pperdecre($params) {
        $totalamount = $params['TotalAmount'];
        $type = $params['Type'];
        //每满减
        $pro_sql = "select ID,PromoID,MinAmount,Derate,CouponPer,CouponID from pap_promotion_content where PromoID={$params['PromoID']}";
        $res = Yii::app()->papdb->createCommand($pro_sql)->queryRow();
        if (!empty($res) && is_array($res)) {
            //每满减金额
            $yhamount = sprintf("%.2f", floor(($totalamount / $res['MinAmount'])) * $res['Derate']);
            //订单金额>活动最小金额
            if ($totalamount > $res['MinAmount']) {
                //若订单100 满减50 应付100-50
                if ($totalamount > $yhamount) {
                    $act_arr['RealPrice'] = $totalamount - $yhamount;
                    //若订单100 满减150 应付100-50
                } else {
                    $act_arr['RealPrice'] = 0;
                }
                //活动减免金额
                $act_arr['DecrAmount'] = $res['Derate'];
                $act_arr['DecrTotal'] = $yhamount;
            } else {
                $act_arr['RealPrice'] = $totalamount;
                //活动减免金额
                $act_arr['DecrAmount'] = 0;
                $act_arr['DecrTotal'] = 0;
            }
        }
        //活动满最下交易额
        $act_arr['MinAmount'] = $res['MinAmount'];
        //活动ID
        $act_arr['PromoID'] = $res['PromoID'];
        //活动类型
        $act_arr['Type'] = $type;
        return $act_arr;
    }

    //优惠券
    public static function coupondecre($params) {
        $totalamount = $params['TotalAmount'];
        $type = $params['Type'];
        $pro_sql = "select ID,PromoID,MinAmount,Derate,CouponPer,CouponID from pap_promotion_content where PromoID={$params['PromoID']}";
        $res = Yii::app()->papdb->createCommand($pro_sql)->queryRow();
        if (!empty($res) && is_array($res)) {
            $act_arr['MinAmount'] = $res['MinAmount'];
            $act_arr['Type'] = $type;
            $act_arr['PromoID'] = intval($res['PromoID']);
            $act_arr['RealPrice']=$totalamount;
            $act_arr['TotalAmount']=$totalamount;
        }
        return $act_arr;
    }

    //查询我的优惠券
    public static function mycoupon() {
        $organID = Yii::app()->user->getOrganID();
        //判断优惠券是否过期
        $sql = "select ID ,CouponSn,Amount,PromoID,CreateTime,Valid from pap_coupon_manage where"
                . " IsUse=0 and OwnerID=$organID and (CreateTime+3600*24*Valid)>UNIX_TIMESTAMP(NOW())"
                . "  order by Amount DESC";
        $rawData = Yii::app()->papdb->createCommand($sql)->queryAll();
        $dataProvider = new CArrayDataProvider($rawData, array(
            'id' => 'coupon',
            'pagination' => array(
                'pageSize' => 10000,
            ),
        ));
        $data = $dataProvider->getData();
        foreach ($data as $key => $val) {
            //截止日期
            $data[$key]['EndTime'] = intval($val['CreateTime']) + 3600 * 24 * intval($val['Valid']);
        }
        $dataProvider->setData($data);
        return $dataProvider;
    }

    //根据编号查询面值金额
    public static function couponbyID($couponID) {
        if (!isset($couponID) || empty($couponID)) {
            exit();
        }
        $sql = "select ID ,CouponSn,Amount,PromoID,CreateTime,Valid from pap_coupon_manage where"
                . " ID=$couponID";
        $res = Yii::app()->papdb->createCommand($sql)->queryRow();
        return $res;
    }

    //使用优惠券
    public static function usecoupon($decoupon, $totalPrice, $orderArr) {
        if (isset($decoupon['Amount']) && !empty($decoupon['Amount'])) {
            $coupon = $decoupon['Amount'];
            //使用优惠券ID
            $orderArr['order']['UseCouponID'] = $decoupon['ID'];
            if ($coupon <= $totalPrice) {
                $orderArr["order"]["TotalAmount"] = $totalPrice - $coupon;   //实付金额
                $orderArr["order"]["RealPrice"] = $totalPrice - $coupon;   //订单金额
                //减免金额 为优惠券金额
                $orderArr["order"]['DecrTotal'] = $coupon;
            } else {
                $orderArr["order"]["TotalAmount"] = 0;
                $orderArr["order"]["RealPrice"] = 0;
                //减免金额为订单金额
                $orderArr["order"]['DecrTotal'] = $coupon;
            }
            return $orderArr;
        }
    }
    //获取抽奖金额范围和概率
    public static function get_lott_value(){
        $sql="select Valid,CreateTime,Type,MinAmount,MaxAmount,Probility from "
            . " pap_coupon where Type=2";
        $res=Yii::app()->papdb->createCommand($sql)->queryRow();
        return $res;
    }
    //抽到优惠券插入pap_coupon_manage
    public static function insert_coupon_manage($cou_arr){
       return  Yii::app()->papdb->createCommand()->insert('pap_coupon_manage', $cou_arr);
    }
    
}
