<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

Class EvaluateService {

    public static function getGoodsEval($params) {
        //    $page = $params['page'] ? $params['page'] : 1;
        $pageSize = $params['pageSize'] ? $params['pageSize'] : 3;
        $content = $params['Content'];
        $Status = $params['Status'];
        $starttime = $params['starttime'];
        $endtime = $params['endtime'];
        $OrganID = $params['OrganID'] ? $params['OrganID'] : Yii::app()->user->getOrganID();
        $seaCon = "select t.*,g.GoodsNo as GoodsNum,g.Name as GoodsName,g.Price as ProPrice,g.ID as GoodsID from pap_evaluation_goods t";
        $seaCon.= " join pap_goods g on t.GoodsID= g.ID";
        if ($params['type'] == 'buyer') {
            $seaCon.= " where BuyerID = $OrganID";
        } else {
            $seaCon.= " where g.OrganID = $OrganID";
        }
        //状态
        if ($Status && in_array($Status, array(1, 2, 3))) {
            $seaCon.=" and t.Status = $Status";
        }
        //已回复
        if ($content && $content == 'reply') {
            $seaCon.=" and t.SellerToEvalRemark != ''";
        }
        //有内容的评价        
        else if ($content == 'not_empty') {
            $seaCon.=" and t.BuyerToEvalRemark != '' and t.BuyerToEvalRemark != '0'";
        }
        //下单时间
        if ($starttime && $endtime) {
            $seaCon.=" and t.CreateTime > {$starttime} and t.CreateTime < {$endtime}+3600*24";
        } else if ($starttime) {
            $seaCon.=" and t.CreateTime > {$starttime}";
        } else if ($endtime) {
            $seaCon.=" and t.CreateTime < {$endtime}+3600*24";
        }
        if (!empty($params['search_text'])) {
            $goods = self::checkKey(urldecode($params['search_text']));
            $seaCon.=" and (g.GoodsNo like '%{$goods}%' or g.Name like '%{$goods}%')";
        }
        $seaCon.=" order by t.CreateTime DESC";
        $count = Yii::app()->papdb->createCommand(str_replace('t.*', 'count(*)', $seaCon))->queryScalar();
        $data = new CSqlDataProvider($seaCon, array(
            'totalItemCount' => $count,
            'db' => Yii::app()->papdb,
            'pagination' => array(
                'pageSize' => $pageSize,
        )));
        $datas = $data->getData();
        foreach ($datas as $k => $v) {
            $status = "<p class='sub_one'>";
            $content = "<p class='sub_two goods_eval1'>";
            switch ($v['Status']) {
                case '2':$status.="中评";
                    break;
                case '3':$status.="差评";
                    break;
                default:$status.="好评";
                    break;
            }
            $datas[$k]['Status'] = $status . "</p>";
            if ($v['BuyerToEvalRemark']) {
                $content.="<span>{$v['BuyerToEvalRemark']}</span></p><p class='goods_eval1'>";
            }

            $sql = "SELECT ImageUrl FROM {{evaluation_goods_image}} WHERE `EvalID`={$v['ID']} limit 3";
            $imgurl = Yii::app()->papdb->createCommand($sql)->queryAll();
            if (!empty($imgurl)) {
                foreach ($imgurl as $key1 => $value1) {
                    $img = F::uploadUrl() . $value1['ImageUrl'];
                    $content.="<a href='$img' target='_blank'><img src='$img' width='100px' height='100px' /></a>";
                }
            }
            $content.="</p><p class='goods_eval1 goods_time'>[" . date('Y-m-d H:i:s', $v['CreateTime']) . "]</p>";
            if ($v['SellerToEvalRemark']) {
                $content.="<p class='goods_eval2'><span style='color:red'>卖家回复：</span><span>{$v['SellerToEvalRemark']}</span></p>";
                $content.="<p class='goods_eval1 goods_time'>[" . date('Y-m-d H:i:s', $v['UpdateTime']) . "]</p>";
                $opreate = "";
            } else {
                $opreate = "<p class='sub_fiv' onclick='reply(" . $v['ID'] . ")'><a><img src='" . F::themeUrl() . '/images/papmall/eval7.png' . "' /></a></p>";
            }


            $datas[$k]['content'] = $content;
            if ($params['type'] == 'buyer') {
                $datas[$k]['goodsinfo'] = "<p class='goods_eval3'>"
                        . "<a title='{$v['GoodsName']}'>{$v['GoodsName']}</a>"
                        //  . "<a style='cursor:pointer' title='{$v['GoodsName']}' target='_blank'"
                        //  . "href='" . Yii::app()->createUrl('pap/mall/detail', array('goods' => $v['GoodsID'])) . "'>{$v['GoodsName']}</a>"
                        . "</p>";
            } else {
                $datas[$k]['goodsinfo'] = "<p class='goods_eval3'>"
                        . "<a style='cursor:pointer' title='{$v['GoodsName']}' target='_blank'"
                        . "href='" . Yii::app()->createUrl('pap/dealergoods/goodsinfo', array('goods' => $v['GoodsID'], 'status' => 1)) . "'>{$v['GoodsName']}</a>"
                        . "</p>";
            }
            $datas[$k]['goodsinfo'] .= "<p class='goods_eval3'>编号：<span><a title='{$v['GoodsNum']}'>{$v['GoodsNum']}</a></span></p>";
            $datas[$k]['goodsinfo'] .= "<p class='goods_eval3'><span style='color:#f47202;'>{$v['ProPrice']}</span>元</p>";
            $datas[$k]['reply'] = $opreate;
        }
        $data->setData($datas);
        return array('data' => $data, 'count' => $count);
    }

    //获取机构名称
    public static function getOrganName($id, $type = 1) {
        $model = Organ::model()->findByPk($id);
        $grade = $model->Grade;
        //信用等级
        $xylevel = EvaluateService::getpets($grade);
        if ($type == 2) {
            if (empty($xylevel) || !$xylevel[0] || !$xylevel[1]) {
                $str = "<div title='暂无' style='color:#888'>暂无</div>";
            } else {
                $str = '<div title = "积分：' . $grade . '">' . str_repeat("<i class='seller-level" . $xylevel[0] . "'></i>", $xylevel[1]) . '</div>';
            }
            return "<p class='eval_organ'><a href='" . Yii::app()->createUrl('servicer/uniondealer/detail', array('dealer' => $id)) . "' target='_blank'>" . $model->attributes['OrganName'] . "</a></p>"
                    . "<div>$str</div>";
        } else {
            if (empty($xylevel) || !$xylevel[0] || !$xylevel[1]) {
                $str = "<div title='暂无'>暂无</div>";
            } else {
                $str = '<div title = "积分：' . $grade . '">' . str_repeat("<i class='buyer-level" . $xylevel[0] . "'></i>", $xylevel[1]) . '</div>';
            }
            return "<p class='eval_organ'>" . $model->attributes['OrganName'] . "</p><div>$str</div>";
        }
    }

    // 对经销商的评价
    public static function getDealerEval($params) {
        $page = $params['page'] ? $params['page'] : 1;
        $pageSize = $params['pageSize'] ? $params['pageSize'] : 3;
        $starttime = $params['starttime'];
        $endtime = $params['endtime'];
        $OrganID = $params['OrganID'] ? $params['OrganID'] : Yii::app()->user->getOrganID();
        $select = " GROUP_CONCAT(JudgeID) as JudgeID,GROUP_CONCAT(Score)as Score,CreateTime,Message,Recier,OrganID";
        $seaCon = "select $select from `pap_evaluation_organ` t";
        if ($params['type'] == 'buyer') {
            $seaCon.= " where t.OrganID = $OrganID and t.Identity=2";
        } else {
            $seaCon.= " where t.Recier = $OrganID and t.Identity=2";
        }
        //下单时间
        if ($starttime && $endtime) {
            $seaCon.=" and t.CreateTime > {$starttime} and t.CreateTime < {$endtime}+3600*24";
        } else if ($starttime) {
            $seaCon.=" and t.CreateTime > {$starttime}";
        } else if ($endtime) {
            $seaCon.=" and t.CreateTime < {$endtime}+3600*24";
        }
        if (!empty($params['search_text'])) {
            $search_text = self::checkKey(urldecode($params['search_text']));
            $idstr = self::getOrgan($search_text);
            if ($params['type'] == 'buyer') {
                $seaCon.=" and t.Recier in $idstr";
            } else {
                $seaCon.=" and t.OrganID in $idstr";
            }
        }
        $count = Yii::app()->papdb->createCommand(str_replace($select, 'count(distinct OrderID)', $seaCon))->queryScalar();
        $seaCon.=" group by t.OrderID";
        $seaCon.=" order by t.CreateTime DESC";
        $data = new CSqlDataProvider($seaCon, array(
            'totalItemCount' => $count,
            'db' => Yii::app()->papdb,
            'pagination' => array(
                'pageSize' => $pageSize,
        )));
        $judgeitem = self::getevainfo(2);
        $datas = $data->getData();
        //var_dump($datas);
        foreach ($datas as $k => $v) {
            $items = explode(',', $v['JudgeID']);
            $score = explode(',', $v['Score']);
            $itemscore = array();
            foreach ($items as $m => $n) {
                $itemscore[$n] = $score[$m];
            }
            ksort($itemscore);
            $datas[$k]['evalItem'] = '';
            $datas[$k]['evalScore'] = '';
            foreach ($itemscore as $kk => $vv) {
                if (isset($judgeitem[$kk])) {
                    $datas[$k]['evalItem'].= "<p style='padding-left:20px;text-align:right'>" . $judgeitem[$kk] . "</p>";
                    $datas[$k]['evalScore'].= '<p>' . $vv . ' 分</p>';
                }
            }
            $datas[$k]['evalItem'].="<p>&nbsp;<p>";
            $datas[$k]['evalScore'].="<p style='color:#888'>[" . date('Y-m-d H:i:s', $v['CreateTime']) . "]</p>";
            $datas[$k]['Messge'] = "<p style='width:250px;word-break:break-all;padding-left:20px'>{$v['Messge']}</p>";
        }
        $data->setData($datas);
        return array('data' => $data, 'count' => $count);
    }

    //查询机构ID
    protected static function getOrgan($name) {
        $criteria = new CDbCriteria();
        $criteria->addCondition("OrganName like '%{$name}%'");
        $model = Organ::model()->findAll($criteria);
        if (!$model) {
            return "('')";
        } else {
            $idstr = '(';
            foreach ($model as $v) {
                $idstr.=$v->ID . ',';
            }
            return substr($idstr, 0, -1) . ')';
        }
    }

    //对修理厂的评价
    public static function getServiceEval($params) {
        $pageSize = $params['pageSize'] ? $params['pageSize'] : 3;
        $starttime = $params['starttime'];
        $endtime = $params['endtime'];
        $OrganID = $params['OrganID'] ? $params['OrganID'] : Yii::app()->user->getOrganID();
        $select = " GROUP_CONCAT(JudgeID) as JudgeID,GROUP_CONCAT(Score)as Score,CreateTime,Message,Recier,OrganID";
        $seaCon = "select $select from `pap_evaluation_organ` t";
        if ($params['type'] == 'dealer') {
            $seaCon.= " where t.OrganID = $OrganID and t.Identity=3";
        } else {
            $seaCon.= " where t.Recier = $OrganID and t.Identity=3";
        }
        //下单时间
        if ($starttime && $endtime) {
            $seaCon.=" and t.CreateTime > {$starttime} and t.CreateTime < {$endtime}+3600*24";
        } else if ($starttime) {
            $seaCon.=" and t.CreateTime > {$starttime}";
        } else if ($endtime) {
            $seaCon.=" and t.CreateTime < {$endtime}+3600*24";
        }
        if (!empty($params['search_text'])) {
            $search_text = self::checkKey(urldecode($params['search_text']));
            $idstr = self::getOrgan($search_text);
            if ($params['type'] == 'dealer') {
                $seaCon.=" and t.Recier in $idstr";
            } else {
                $seaCon.=" and t.OrganID in $idstr";
            }
        }
        $count = Yii::app()->papdb->createCommand(str_replace($select, 'count(distinct OrderID)', $seaCon))->queryScalar();
        $seaCon.=" group by t.OrderID";
        $seaCon.=" order by t.CreateTime DESC";
        $data = new CSqlDataProvider($seaCon, array(
            'totalItemCount' => $count,
            'db' => Yii::app()->papdb,
            'pagination' => array(
                'pageSize' => $pageSize,
        )));
        $judgeitem = self::getevainfo(3);
        $datas = $data->getData();
        foreach ($datas as $k => $v) {
            $items = explode(',', $v['JudgeID']);
            $score = explode(',', $v['Score']);
            $itemscore = array();
            foreach ($items as $m => $n) {
                $itemscore[$n] = $score[$m];
            }
            ksort($itemscore);
            $datas[$k]['evalItem'] = '';
            $datas[$k]['evalScore'] = '';
            foreach ($itemscore as $kk => $vv) {
                if ($judgeitem[$kk]) {
                    $datas[$k]['evalItem'].= "<p style='padding-left:20px;text-align:right'>" . $judgeitem[$kk] . "</p>";
                    if ($vv == 1) {
                        $datas[$k]['evalScore'].= '<p>好评</p>';
                    } else if ($vv == 0) {
                        $datas[$k]['evalScore'].= '<p>中评</p>';
                    } else if ($vv == -1) {
                        $datas[$k]['evalScore'].= '<p>差评</p>';
                    }
                }
            }
            $datas[$k]['evalItem'].="<p>&nbsp;<p>";
            $datas[$k]['evalScore'].="<p style='color:#888'>[" . date('Y-m-d H:i:s', $v['CreateTime']) . "]</p>";
            $datas[$k]['Message'] = "<p style='width:250px;word-break:break-all;padding-left:20px'>{$v['Message']}</p>";
        }
        $data->setData($datas);
        return array('data' => $data, 'count' => $count);
    }

    //获取机构名称
    public static function geteval($ID) {
        $OrganID = Yii::app()->user->getOrganID();
        $model = PapEvaluationGoods::model()->findByPk($ID, "SellerToEvalRemark ='' and OrganID=$OrganID")->attributes;
        if (!$model) {
            return array('error' => 1);
        } else {
            return $model;
        }
    }

    //获取经销商收到的评价详情
    public static function idgetdealereva() {
        $ID = Yii::app()->request->getParam('evaluate');
        $model = PapEvaluationDealer::model()->findBypk($ID);
        return $model;
    }

    //获得经销商做出的评价详情
    public static function idgetserviceeva() {
        $ID = Yii::app()->request->getParam('evaluate');
        $model = PapEvaluationService::model()->findBypk($ID);
        return $model;
    }

    //获取订单编号
    public static function getOrderSN($id, $type = '') {
        $ordersn = PapOrder::model()->findByPk($id, array('select' => 'OrderSN'))->attributes['OrderSN'];
        if ($type == 2) {
            return "<a href='" . Yii::app()->createUrl('pap/orderreview/detail', array('orderid' => $id)) . "' target='_blank'>$ordersn</a>";
        } else
            return "<a href='" . Yii::app()->createUrl('pap/sellerorder/detail', array('ID' => $id)) . "' target='_blank'>$ordersn</a>";
    }

    //转换关键字
    public static function checkKey($key) {
        $key = trim($key);
        if ($key) {
            $patterns = array('/<<q/', '/%/', '/_/', '/\[/', '/\]/', '/\'/', '/q>>/');
            $replacements = array('/', '\\\\\%', '\\\\\_', '\\\\\[', '\\\\\]', '\\\\\'', '\\\\\\\\\\');
            $keyword2 = preg_replace($patterns, $replacements, $key);
            $keyword = str_replace(' ', '%', $keyword2);
        }
        return $keyword ? $keyword : $key;
    }

    //转换关键字
    public static function changeKey($key) {
        $key = trim($key);
        if ($key) {
            $keyword2 = str_replace('q>>', '\\', $key);
            $keyword = str_replace('<<q', '/', $keyword2);
        }
        return $keyword ? $keyword : $key;
    }

    /*
     * 获取评价字段
     */

    public static function getevainfo($identity) {
        $sql = " select Item,ID from jpd_judge_item where IsDelete=0 and Identity = " . $identity;
        $evarr = Yii::app()->jpdb->createCommand($sql)->queryAll();
        $n = array_column($evarr, 'Item', 'ID');
        return $n;
    }

    //服务评价统计
    public static function getevalscore($params) {
        if ($params['OrganID']) {
            $sql = "SELECT eo.JudgeID,count(eo.ID) as count,sum(eo.score) as totalscore FROM `pap_evaluation_organ` eo 
            where eo.Recier={$params['OrganID']} and eo.Identity=2
            GROUP BY eo.JudgeID ";
            return Yii::app()->papdb->createCommand($sql)->queryAll();
        }
    }

    //商品评价统计
    public static function getevalgoods($params) {
        $m = intval($params['m']);
        $sql = "select Status,count(ID) as count from pap_evaluation_goods 
                where 1=1";
        if ($params['OrganID']) {
            $OrganID = $params['OrganID'];
            $sql.=" and OrganID=$OrganID";
        }
        if ($m) {
            $sql.=" and CreateTime>(select UNIX_TIMESTAMP(DATE_ADD(now(),interval -$m month)))";
        }
        if ($params['GoodsID']) {
            $sql.=" and GoodsID={$params['GoodsID']}";
        }
        $sql.=" GROUP BY Status";
        $res = Yii::app()->papdb->createCommand($sql)->queryAll();
        $arr = array(1 => 0, 2 => 0, 3 => 0);
        foreach ($res as $v) {
            $arr[$v['Status']] = $v['count'];
        }
        return $arr;
    }

    //返回进度条样式
    public static function getJdtCss($praise) {
        $jdt = '<div class="eval_jdtbg" style="float:left">';
        if ($praise < 0) {
            return '';
        } elseif ($praise <= 10) {
            $jdt.= "<div class='eval_jdtmid' style='width:" . $praise . "px'></div>";
        } else {
            $midw = $praise - 10;
            $jdt.= "<div class='eval_jdtleft'></div>"
                    . "<div class='eval_jdtmid' style='width:" . $midw . "px'></div>"
                    . "<div class='eval_jdtright'></div>";
        }
        $jdt.='</div>';
        return $jdt;
    }

    //修理厂信用统计
    public static function getevalservice($params) {
        $OrganID = $params['OrganID'];
        $m = intval($params['m']);
        $sql = "select Score,count(ID) as count from pap_evaluation_organ 
                where Identity=3 and Recier=$OrganID";
        if ($m) {
            $sql.=" and JudgeID=$m";
        }
        $sql.=" GROUP BY Score";
        $res = Yii::app()->papdb->createCommand($sql)->queryAll();
        $arr = array(1 => 0, 2 => 0, 3 => 0);
        foreach ($res as $v) {
            $arr[$v['Score'] + 2] = $v['count'];
        }
        return $arr;
    }

    //给修理厂信用等级赋值
    public static function setevalservice($params = array()) {
        Organ::model()->updateAll(array('Grade' => 0), 'Identity=3');
        $sql = "select Recier,sum(score) as total from pap_evaluation_organ 
                where Identity=3";
        if ($params['OrganID']) {
            $sql.=" and Recier={$params['OrganID']}";
        }
        $sql.=" GROUP BY Recier";
        $res = Yii::app()->papdb->createCommand($sql)->queryAll();
        foreach ($res as $v) {
            Organ::model()->updateByPk($v['Recier'], array('Grade' => $v['total']));
        }
    }

    //给经销商信用等级赋值
    public static function setevaldealer() {
        Organ::model()->updateAll(array('Grade' => 0), 'Identity=2');
        $sql = "select distinct OrganID from pap_evaluation_goods";
        $res = Yii::app()->papdb->createCommand($sql)->queryAll();
        foreach ($res as $vv) {
            $total = self::getevalgoods(array('OrganID' => $vv['OrganID']));
            $grade = $total[1] - $total[3];
            Organ::model()->updateByPk($vv['OrganID'], array('Grade' => $grade));
        }
    }

    //获取用户信用等级
    public static function getpets($fen) {
        $pets = array();
        if (intval($fen) <= 0) {
            return $pets;
        }
        switch (intval($fen)) {
            case $fen >= 4 && $fen <= 10;
                $pets = array(1, 1);
                break;
            case $fen >= 11 && $fen <= 40;
                $pets = array(1, 2);
                break;
            case $fen >= 41 && $fen <= 90;
                $pets = array(1, 3);
                break;
            case $fen >= 91 && $fen <= 150;
                $pets = array(1, 4);
                break;
            case $fen >= 151 && $fen <= 250;
                $pets = array(1, 5);
                break;
            case $fen >= 251 && $fen <= 500;
                $pets = array(2, 1);
                break;
            case $fen >= 501 && $fen <= 1000;
                $pets = array(2, 2);
                break;
            case $fen >= 1001 && $fen <= 2000;
                $pets = array(2, 3);
                break;
            case $fen >= 2001 && $fen <= 5000;
                $pets = array(2, 4);
                break;
            case $fen >= 5000 && $fen <= 10000;
                $pets = array(2, 5);
                break;
            case $fen >= 10001 && $fen <= 20000;
                $pets = array(3, 1);
                break;
            case $fen >= 20001 && $fen <= 50000;
                $pets = array(3, 2);
                break;
            case $fen >= 50001 && $fen <= 100000;
                $pets = array(3, 3);
                break;
            case $fen >= 100001 && $fen <= 200000;
                $pets = array(3, 4);
                break;
            case $fen >= 200001 && $fen <= 500000;
                $pets = array(3, 5);
                break;
            case $fen >= 500001 && $fen <= 1000000;
                $pets = array(4, 1);
                break;
            case $fen >= 1000001 && $fen <= 2000000;
                $pets = array(4, 2);
                break;
            case $fen >= 2000001 && $fen <= 5000000;
                $pets = array(4, 3);
                break;
            case $fen >= 5000001 && $fen <= 10000000;
                $pets = array(4, 4);
                break;
            case $fen >= 10000001;
                $pets = array(4, 5);
                break;
        }
        return $pets;
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
                        $Publishment .='扣' . $Pubarr[0]['CutPoint'] . '分,';
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
