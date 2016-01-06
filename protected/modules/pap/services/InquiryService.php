<?php

class InquiryService {

    //获取询价单列表
    public static function getinqlists($params) {
        $organID = Yii::app()->user->getOrganID();
        $where = ' where a.Status!=3 and a.DealerID like "%,' . $organID . ',%"';
        if ($params) {
            $where.=self::inqsql($params);
        }
        $sql = 'select a.InquiryID,a.InquirySn,a.CreateTime,a.Status,a.OrganID,a.State'
                . ' from `pap_inquiry` a' . $where;
        $sqlcount = 'select count(*) from `pap_inquiry`  a' . $where;
        $count = Yii::app()->papdb->createCommand($sqlcount)->queryScalar();
        $sql.=' order by InquiryID desc ';
        $inqlists = new CSqlDataProvider($sql, array(
            'db' => Yii::app()->papdb,
            'totalItemCount' => $count,
            'pagination' => array(
                'pageSize' => 10,
            ),
                )
        );
        $datas = $inqlists->getData();
        foreach ($datas as $k => $d) {
            $status = self::checkstatus(array('inqid' => $d['InquiryID'], 'status' => $d['Status']));
            $datas[$k]['sta'] = $status['status'];
            $datas[$k]['stamsg'] = $status['msg'];
            $datas[$k]['rowNO'] = $k + 1;
            if ($d['State'] == 1)
                $datas[$k]['from'] = '客服代发';
            else
                $datas[$k]['from'] = '修理厂';
            $datas[$k]['Info'] = "<a href='" . Yii::app()->createUrl('/pap/inquirylist/viewquo', array('inqid' => $d['InquiryID'])) . "' target='_blank'>询价单详情</a>";
        }
        $inqlists->setData($datas);
        return $inqlists;
    }

    //询价单查询sql拼装
    public static function inqsql($params) {
        $where = '';
        if ($params['no']) {
            $where.=' and a.InquirySn like "%' . urldecode(trim($params['no'])) . '%"';
        }
        if (is_numeric($params['status'])) {
            $where .= ' and a.Status=' . $params['status'];
        }
        if ($params['start'] && $t1 = strtotime(urldecode($params['start']))) {
            $where.=' and a.CreateTime>' . $t1;
        }
        if ($params['end'] && $t2 = strtotime(urldecode($params['end']))) {
            $where.=' and a.CreateTime<' . ($t2 + 3600 * 24 - 1);
        }
        return $where;
    }

    //判断询价单状态
    public static function checkstatus($params) {
        if ($params['status'] == 0)
            return array('status' => 0, 'msg' => '待报价');
        elseif ($params['status'] == 1)
            return array('status' => 1, 'msg' => '<span>已报价待确认</span>');
        elseif ($params['status'] == 2)
            return array('status' => 2, 'msg' => '<span style="color:green">已确认</span>');
        elseif ($params['status'] == 4)
            return array('status' => 4, 'msg' => '<span style="color:red">已拒绝</span>');
        elseif ($params['status'] == 5)
            return array('status' => 5, 'msg' => '<span style="color:gray">已失效</span>');
    }

    //获取询价单信息
    public static function getinqinfo($inqid) {
        $organID = Yii::app()->user->getOrganID();
        //基本信息
        $basesql = 'select OrganID,`Describe`,Status,Make,Car,Year,Model,VIN,State from pap_inquiry ' .
                'where Status!=3 and DealerID like "%,' . $organID . ',%" and InquiryID=' . $inqid;
        $baseinfo = Yii::app()->papdb->createCommand($basesql)->queryRow();
        if (!$baseinfo) {
            Controller::redirect(Yii::app()->createUrl('pap/inquirylist/index'));
        }
        if ($baseinfo['Make']) {
            $params['Make'] = $baseinfo['Make'];
            $params['Car'] = $baseinfo['Car'];
            $params['Year'] = $baseinfo['Year'];
            $params['Model'] = $baseinfo['Model'];
            $res = self::getcarmodel($params);
            if (is_array($res))
                $baseinfo = array_merge($res, $baseinfo);
        }
        $result['status'] = self::checkstatus(array('inqid' => $inqid, 'status' => $baseinfo['Status']));
        $result['files'] = self::getfiles($inqid);
        $result['parts'] = self::getparts($inqid);
        //获取报价单id
        $sql = 'select QuoID from pap_quotation where InquiryID=' . $inqid . ' and DealerID=' . $organID;
        $res = Yii::app()->papdb->createCommand($sql)->queryRow();
        $organ['organID'] = $baseinfo['OrganID'];
        $organ['identity'] = 3;
        $organ['quoid'] = $res['QuoID'];
        $result['service'] = QuotationService::getorganinfo($organ);
        $result['baseinfo'] = $baseinfo;
        return $result;
    }

    //获取询价单适用车型
    public static function getcarmodel($params) {
        $sql = 'select `Name` from jpd_front_makes where MakeID=' . $params['Make'];
        $res = Yii::app()->jpdb->createCommand($sql)->queryRow();
        $car['mname'] = $res['Name'];
        if ($params['Car']) {
            $sql = 'select `Name` from jpd_front_series where Seriesid=' . $params['Car'];
            $res = Yii::app()->jpdb->createCommand($sql)->queryRow();
            $car['sname'] = $res['Name'];
            if ($params['Year'])
                $car['yname'] = $params['Year'];
            if ($params['Model']) {
                $sql = 'select `Name` from jpd_front_model where ModelID=' . $params['Model'];
                $res = Yii::app()->jpdb->createCommand($sql)->queryRow();
                $car['cname'] = $res['Name'];
            }
        }
        return $car;
    }

    //获取询价单附件
    public static function getfiles($inqid) {
        $sql = 'select PicName,PicPath from pap_inquiry_picfile where InquiryID=' . $inqid;
        $res = Yii::app()->papdb->createCommand($sql)->queryAll();
        $files = array();
        foreach ($res as $k => $r) {
            if (!$r['PicPath']) {
                $files[$k]['exist'] = 0;
                continue;
            }
            $files[$k] = $r;
        }
        return $files;
    }

    //获取询价单配件信息
    public static function getparts($inqid) {
        $sqlcount = 'select count(*) from pap_inquiry_category where InquiryID=' . $inqid;
        $count = Yii::app()->papdb->createCommand($sqlcount)->queryScalar();
        if ($count == 0)
            return null;
        $sql = 'select ID,MainCategory,SubCategory,LeafCategory,Number from pap_inquiry_category where InquiryID=' . $inqid;
        $countsql = 'select count(*) from pap_inquiry_category where InquiryID=' . $inqid;
        $total = Yii::app()->papdb->createCommand($countsql)->queryScalar();
        $parts = new CSqlDataProvider($sql, array(
            'db' => Yii::app()->papdb,
            'pagination' => array(
                'pageSize' => $total,
            ),
                )
        );
        return $parts;
    }

    //获取询价单配件信息下拉列表源
    public static function getpartssource($inqid) {
        $sql = 'select ID,MainCategory,SubCategory,LeafCategory,StandCode from pap_inquiry_category where InquiryID=' . $inqid;
        $res = Yii::app()->papdb->createCommand($sql)->queryAll();
        if (!$res)
            return null;
        foreach ($res as $k => $v) {
            $datas[$k]['ID'] = $v['ID'];
            $datas[$k]['standname'] = $v['LeafCategory'];
            $name = $v['MainCategory'] . '-' . $v['SubCategory'] . '-' . $v['LeafCategory'];
            $options[$v['ID']]['standcode'] = $v['StandCode'];
            $options[$v['ID']]['title'] = $name;
        }
        $cpnames = CHtml::listData($datas, 'ID', 'standname');
        $lists['cpnames'] = $cpnames;
        $lists['options'] = $options;
        return $lists;
    }

    //获取询价单发送对象id
    public static function getinq_sid($inqid) {
        $organID = Yii::app()->user->getOrganID();
        $basesql = 'select OrganID from pap_inquiry ' .
                'where Status!=3 and DealerID like "%,' . $organID . ',%" and InquiryID=' . $inqid;
        $baseinfo = Yii::app()->papdb->createCommand($basesql)->queryRow();
        if (!$baseinfo) {
            Controller::redirect(Yii::app()->createUrl('pap/inquirylist/index'));
        }
        return $baseinfo['OrganID'];
    }

    //查询是否发送了报价单
    public static function ifsendquo($params) {
        $organID = Yii::app()->user->getOrganID();
        if ($params['type'] == 1) {
            $sql = 'select QuoID from pap_quotation where InquiryID=' . $params['inqid'] . ' and DealerID=' . $organID;
        } else if ($params['type'] == 2) {
            //已确认和已撤销的询价单不能修改 客服代发询价单不能编辑
            $inqsql = 'select Status from pap_inquiry where InquiryID=' . $params['inqid'] . ' and (Status>1 or ( Status=1 and State=1 ))';
            $inqinfo = Yii::app()->papdb->createCommand($inqsql)->queryRow();
            if ($inqinfo) {
                Controller::redirect(Yii::app()->createUrl('pap/inquirylist/index'));
            }
        } else if ($params['type'] == 3) {
            $qsql = 'select QuoID from pap_quotation where IfSend="2" and Status="2" and InquiryID=' . $params['inqid'] . ' and DealerID=' . $organID;
            $res = Yii::app()->papdb->createCommand($qsql)->queryRow();
            if ($res) {
                echo json_encode(array('failmsg' => '报价单已确认,不能取消'));
                exit;
            }
        }
        $sql = 'select QuoID from pap_quotation where InquiryID=' . $params['inqid'] . ' and DealerID=' . $organID;
        $res = Yii::app()->papdb->createCommand($sql)->queryRow();
        return $res['QuoID'];
    }

    //新建报价单方案
    public static function newscheme($params) {
        $organID = Yii::app()->user->getOrganID();
        $time = $_SERVER['REQUEST_TIME'];
        //查询是否已根据询价单建立了报价单
        $quoID = self::ifsendquo(array('inqid' => $params['inqid']));
        $params['sid'] = self::getinq_sid($params['inqid']);
        if (!$quoID) {
            //新建报价单
            $quodatas['InquiryID'] = $params['inqid'];
            $quodatas['DealerID'] = $organID;
            $quodatas['ServiceID'] = $params['sid'];
            $quodatas['SorceID'] = $params['sid'];
            $quodatas['Status'] = '1';
            $quodatas['CreateTime'] = $time;
            $quodatas['UpdateTime'] = $time;
            $quodatas['QuoSn'] = $params['quosn'];
            $quodatas['Title'] = $params['quoname'];
            $result = Yii::app()->papdb->createCommand()->insert('pap_quotation', $quodatas);
            $quoID = Yii::app()->papdb->getLastInsertID();
        } else {
            $p['type'] = 1;
            $p['quoid'] = $quoID;
            QuotationService::getschemecount($p);
            $quodatas['UpdateTime'] = $time;
            $quodatas['Title'] = $params['quoname'];
            $result = Yii::app()->papdb->createCommand()->update('pap_quotation', $quodatas, 'QuoID=' . $quoID);
        }

        //新建报价单方案
        $datas['QuoID'] = $quoID;
        $datas['TotalFee'] = $params['quoprices'];
        $datas['GoodFee'] = $params['totalprices'];
        $datas['ShipFee'] = $params['shipprices'];
        $datas['Status'] = '1';
        $datas['CreateTime'] = $time;
        $datas['UpdateTime'] = $time;
        //保存附件
        if ($params['fileurl']) {
            $datas['FileName'] = $params['filename'];
            $datas['FileUrl'] = $params['fileurl'];
        }
        $result = Yii::app()->papdb->createCommand()->insert('pap_quotation_scheme', $datas);
        $SchID = Yii::app()->papdb->getLastInsertID();
        //获取商品信息
        $goodsinfo = array();
        $goodsids = explode(',', $params['quoids']);
        $goodsnum = explode(',', $params['quonum']);
        $goodsprice = explode(',', $params['quoprice']);
        //插入报价单商品
        $sql = 'INSERT INTO `pap`.`pap_quotation_goods` (`SchID`, `GoodsID`, `Num`, `Price`,`Version`) VALUES';
        foreach ($goodsids as $key => $v) {
            if ($v) {
                $version = QuotationService::getgoodsversion($goodsids[$key]);
                $version = $version ? $version : 0;
                $sql.="($SchID,$goodsids[$key],$goodsnum[$key],$goodsprice[$key],$version),";
            }
        }
        $sql = rtrim($sql, ',') . ';';
        $res = Yii::app()->papdb->createCommand($sql)->execute();
        echo json_encode(array('quoid' => $quoID, 'count' => $res, 'schid' => $SchID, 'success' => true));
    }

    //报价单方案编辑
    public static function editscheme($params) {
        $organID = Yii::app()->user->getOrganID();
        $time = $_SERVER['REQUEST_TIME'];
        //更新报价单
        $quoID = self::ifsendquo(array('inqid' => $params['inqid']));
        $quodatas['UpdateTime'] = $time;
        $quodatas['Title'] = $params['quoname'];
        $result = Yii::app()->papdb->createCommand()->update('pap_quotation', $quodatas, 'QuoID=' . $quoID);
        $SchID = $params['schid'];
        $datas['TotalFee'] = $params['quoprices'];
        $datas['GoodFee'] = $params['totalprices'];
        $datas['ShipFee'] = $params['shipprices'];
        $datas['ShipFee'] = $params['shipprices'];
        $datas['UpdateTime'] = $time;
        //保存附件
        if ($params['fileurl']) {
            $datas['FileName'] = $params['filename'];
            $datas['FileUrl'] = $params['fileurl'];
            //删除之前附件
            $quo_data = PapQuotationScheme::model()->findByPk($SchID);
            if (!empty($quo_data['FileName'])) {
                $ftp = new Ftp();
                $res = $ftp->delete_file($quo_data->FileUrl);
                $ftp->close();
            }
        }
        $result = Yii::app()->papdb->createCommand()->update('pap_quotation_scheme', $datas, 'SchID=:SchID', array(':SchID' => $SchID));
        //获取商品信息
        $goodsinfo = array();
        $goodsids = explode(',', $params['quoids']);
        $goodsnum = explode(',', $params['quonum']);
        $goodsprice = explode(',', $params['quoprice']);
        //获取以前的商品信息
        $oldgoodsinfo = PapQuotationGoods::model()->findAll('SchID=' . $SchID);
        $newgoodsinfo = array();
        foreach ($goodsids as $key => $v) {
            if ($v) {
                $newgoodsinfo[$key]['GoodsID'] = $goodsids[$key];
                $newgoodsinfo[$key]['Num'] = $goodsnum[$key];
                $newgoodsinfo[$key]['Price'] = $goodsprice[$key];
                $version = QuotationService::getgoodsversion($goodsids[$key]);
                $newgoodsinfo[$key]['Version'] = $version ? $version : 0;
            }
        }
        $insertid = array();
        //将报价单商品插入报价单商品表中
        if ($SchID) {
            foreach ($newgoodsinfo as $nkey => $new) {
                $newids[] = $new['GoodsID'];
            }
            if ($oldgoodsinfo) {
                foreach ($oldgoodsinfo as $okey => $old) {
                    $oldids[] = $old['GoodsID'];
                }
            } else {
                $oldids = array();
            }
            foreach ($oldids as $id) {
                if (!in_array($id, $newids)) {
                    //删除商品
                    $delcount = Yii::app()->papdb->createCommand()->delete('pap_quotation_goods', 'SchID=:SchID and GoodsID=:goodsid', array(':SchID' => $SchID, ':goodsid' => $id));
                }
            }
            foreach ($newids as $key => $id) {
                if (in_array($id, $oldids)) {
                    //更新商品
                    $update['Num'] = $newgoodsinfo[$key]['Num'];
                    $update['Price'] = $newgoodsinfo[$key]['Price'];
                    $update['Version'] = $newgoodsinfo[$key]['Version'];
                    $result = Yii::app()->papdb->createCommand()->update('pap_quotation_goods', $update, 'SchID=:SchID and GoodsID=:goodsid', array(':SchID' => $SchID, ':goodsid' => $id));
                    if ($result == 1) {
                        $res = 1;
                    }
                } else {
                    //插入商品
                    $goodsdatas['SchID'] = $SchID;
                    $goodsdatas['GoodsID'] = $newgoodsinfo[$key]['GoodsID'];
                    $goodsdatas['Num'] = $newgoodsinfo[$key]['Num'];
                    $goodsdatas['Price'] = $newgoodsinfo[$key]['Price'];
                    $goodsdatas['Version'] = $newgoodsinfo[$key]['Version'];
                    $result = Yii::app()->papdb->createCommand()->insert('pap_quotation_goods', $goodsdatas);
                    $insertid[] = Yii::app()->papdb->getLastInsertID();
                }
            }
        }
        if ($res = 1 || count($insertid) > 0 || $delcount > 0)
            echo json_encode(array('count' => 1, 'schid' => $SchID, 'success' => true));
        else {
            echo json_encode(array('count' => 0));
        }
    }

    //发送报价单给服务店
    public static function sendquo($inqid) {
        $time = $_SERVER['REQUEST_TIME'];
        //查看询价单是否是客服代发
        $inqsql = ' select InquiryID,`State`,OrganID,Payment,AddressID,DealerID  from `pap_inquiry` where InquiryID=' . $inqid;
        $res = Yii::app()->papdb->createCommand($inqsql)->queryRow();
        $quoid = self::ifsendquo(array('inqid' => $inqid));
        //更新报价单状态
        if ($res['State'] == 1) {
            //生成确认码
            $checksn = self::getCheckSn($res['OrganID']);
            $sql = 'update pap_quotation set Status="1",IfSend="2",CheckSn="' . $checksn . '",UpdateTime=' . $time
                    . ' where QuoID=' . $quoid;
        } else {
            $sql = 'update pap_quotation set Status="1",IfSend="2",UpdateTime=' . $time
                    . ' where QuoID=' . $quoid;
        }
        $count = Yii::app()->papdb->createCommand($sql)->execute();
        //更新询价单状态
        $inqsql = 'update pap_inquiry set Status=1,UpdateTime=' . $time . ' where InquiryID=' . $inqid . ' and Status=0';
        Yii::app()->papdb->createCommand($inqsql)->execute();
        if ($res['State'] == 1 && $count > 0) {
            //客服代发询价单制作报价单后用短信通知修理厂
            $sms = self::remindService(array_merge($res, array('quoID' => $quoid, 'checkSN' => $checksn)));
            if ($sms['code'] == 0) {
                $msg = '短信提醒发送失败';
            } else {
                $msg = '短信提醒发送失败!' . $sms['SMS'];
            }
            //给修理厂发送提醒  但是不发送短信
            $link = Yii::app()->createUrl('pap/inquiryorder/inquirydetail', array('inquiryID' => $inqid));
            $params = array('OrganID' => $res['OrganID'], 'OrganType' => 3, 'HandleID' => $quoid, 'link' => $link);
            $params['type'] = array('name' => 'BJD', 'key' => 3);
            $r = RemindService::sendRemind($params);
        } elseif ($count > 0) {
            //给修理厂发送提醒
            $link = Yii::app()->createUrl('pap/inquiryorder/inquirydetail', array('inquiryID' => $inqid));
            $params = array('OrganID' => $res['OrganID'], 'OrganType' => 3, 'HandleID' => $quoid, 'link' => $link);
            $params['type'] = array('name' => 'BJD', 'key' => 3);
            $r = RemindService::sendRemind($params);
        }
        if ($count > 0) {
            //更改询价单待报价状态为已处理
            $organID = Yii::app()->user->getOrganID();
            $sql = 'update pap_remind_business set HandleStatus=2 where HandleID=' . $inqid . ' and OrganID=' . $organID;
            Yii::app()->papdb->createCommand($sql)->execute();
        }
        echo json_encode(array('count' => $count, 'msg' => $msg));
    }

    //商品清单获取空数据
    public static function getnulllists() {
        $lists = new CSqlDataProvider('select ID from pap_goods where 1>2', array(
            'db' => Yii::app()->papdb,
            'pagination' => array(
                'pageSize' => 1,
            ),
                )
        );
        return $lists;
    }

    //客服代发询价单制作报价单时生成短信确认码
    public static function getCheckSn($serviceid) {
        $time = $_SERVER['REQUEST_TIME'];
        $today = strtotime(date('Y-m-d', $time));
        //查询修理当日客服代发询价单并已报价数
        $sql = ' select count(*) as count from `pap_inquiry` where State=1 and Status=1 and UpdateTime>=' . $today . ' and OrganID=' . $serviceid;
        $res = Yii::app()->papdb->createCommand($sql)->queryRow();
        $count = intval($res['count']);
        //判断确认码是否已存在
        $exist = false;
        while (!$exist) {
            $check = 'B' . date('d', $time);
            $count++;
            $check.=$count;
            $exist = self::checkexist(array('serviceid' => $serviceid, 'check' => $check));
        }
        return $check;
    }

    //判断确认码是否存在
    public static function checkexist($params) {
        $today = strtotime(date('Y-m-d', $_SERVER['REQUEST_TIME']));
        $sql = ' select QuoID from `pap_quotation` where ServiceID=' . $params['serviceid'] . ' and Status="1" and IfSend="2" and UpdateTime>=' . $today . ' and CheckSn="' . $params['check'] . '"';
        $res = Yii::app()->papdb->createCommand($sql)->queryRow();
        if ($res) {
            return false;  //存在返回false并判断下一个确认码是否可用
        } else {
            return true;
        }
    }

    //发送短信通知修理厂
    public static function remindService($params) {
        $service = ' select OrganName,Phone from jpd_organ where ID=' . $params['OrganID'];
        $serviceres = Yii::app()->jpdb->createCommand($service)->queryRow();

        $scheme = 'SELECT SchID FROM `pap_quotation_scheme` where QuoID=' . $params['quoID'];
        $schemeres = Yii::app()->papdb->createCommand($scheme)->queryRow();
        //获取支付方式折扣率
        $discount = PapOrderDiscount::model()->find('OrderType=:OrderType', array(':OrderType' => 2));
        if ($discount) {
            if ($params['Payment'] == 1) {
                $factdiscount = $discount['OrderAlipay'] ? $discount['OrderAlipay'] : 100;
            } else if ($params['Payment'] == 2) {
                $factdiscount = $discount['OrderLogis'] ? $discount['OrderLogis'] : 100;
            }
        } else {
            $factdiscount = 100;
        }
        $totalprices = self::Getsumprices($schemeres['SchID'], $factdiscount, trim($params['DealerID'], ','));
        $msg = '尊敬的' . $serviceres['OrganName'] . '客户,您的报价单方案已生成,总计' . $totalprices . '元。回复 ' . $params['checkSN'] . 'Y 确认、' . $params['checkSN'] . 'N 拒绝。详情：';
        $dealerinfo = QuotationService::getorganinfo(array('organID' => trim($params['DealerID'], ','), 'identity' => 2));

        //收货地址
        $addressql = ' select  ContactName,State,City,District,Address from jpd_receive_address where ID=' . $params['AddressID'];
        $address = Yii::app()->jpdb->createCommand($addressql)->queryRow();
        $address['site'] = Area::getaddress($address['State'], $address['City'], $address['District']) . $address['Address'];
        //获取报价单商品
        $goodssql = ' SELECT GoodsID,Num from pap_quotation_goods where SchID=' . $schemeres['SchID'];
        $goodses = Yii::app()->papdb->createCommand($goodssql)->queryAll();
        foreach ($goodses as $g) {
            $sql = ' select Name from pap_goods where ID=' . $g['GoodsID'];
            $gres = Yii::app()->papdb->createCommand($sql)->queryRow();
            $msg.=$gres['Name'] . ',' . $g['Num'] . '个；';
        }
        $msg.='收货地址：' . $address['site'] . '；收货人:' . $address['ContactName'] . '。若有疑问请联系经销商：' . $dealerinfo['OrganName'] . ',电话：' . $dealerinfo['Phone'] . '。';
        $res = F::sendSMS(array('msg' => $msg, 'phone' => $serviceres['Phone']));
        if ($res['code'] == 0) {
            //发送成功,添加报价单短信确认数据
            $time = $_SERVER['REQUEST_TIME'];
            $insertsql = ' insert into pap_quotation_confirm (QuoID,DealerID,ServiceID,CreateTime) values(' . $params['quoID'] . $params['DealerID'] . $params['OrganID'] . ',' . $time . ')';
            $count = Yii::app()->papdb->createCommand($insertsql)->execute();
        }
        return $res;
    }

    //计算报价单价格
    public static function Getsumprices($schID, $factdiscount, $dealerID) {
        $sql = 'select * from pap_quotation_goods where SchID=' . $schID;
        $goodsinfo = Yii::app()->papdb->createCommand($sql)->queryAll();
        $total = 0;
        $totalnum = 0;
        foreach ($goodsinfo as $kk => $value) {
            $total+=round($value['Price'] * $value['Num'] * $factdiscount / 100, 2);
            $totalnum+= $value['Num'];
        }
        //获取经销商最小价格
        $min_price = PapOrderMinTurnover::model()->find('OrganID=:OrganID', array(':OrganID' => $dealerID));
        $min_price = $min_price['MinTurnover'];
        //生成平摊金额
        $amountlist = 0;
        $minus = 0;
        if ($min_price && $min_price > $total) {
            $minus = round(($min_price - $total) / $totalnum, 2);
            $amountlist = $total + $minus * $totalnum;
            if ($amountlist < $min_price) {
                $amountlist = $min_price;
            }
        } else {
            $amountlist +=$total;
        }
        return $amountlist;
    }

}

?>
