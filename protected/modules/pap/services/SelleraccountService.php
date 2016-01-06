<?php

//月度对账单service
class SelleraccountService {

    //订单列表
    public static function getOrder($params) {
        $select = "ID,OrderSN,CreateTime,Payment,BuyerID,RealPrice,BuyerName";
        $seaCon = self::getOrderCond($params, $select);
        $pageSize = $params['pageSize'] ? $params['pageSize'] : 20;
        // $page = $params['page'] ? $params['page'] : 1;
        $count = Yii::app()->papdb->createCommand(str_replace($select, 'count(ID)', $seaCon))->queryScalar();
        $data = new CSqlDataProvider($seaCon, array(
                    'totalItemCount' => $count,
                    'db' => Yii::app()->papdb,
                    'pagination' => array(
                        'pageSize' => $pageSize,
                        )));
        $datas = $data->getData();
        foreach ($datas as $k => $v) {
            //$datas[$k]['rowNO'] = $k + 1 + ($page - 1) * $pageSize;
            $datas[$k]['CreateTime'] = date('Y-m-d H:i:s', $v['CreateTime']);
            $datas[$k]['Payment'] = $v['Payment'] == 1 ? '支付宝担保' : '物流代收款';
            $OrganName = Organ::model()->findByPk($v['BuyerID'])->attributes['OrganName'];
            $BuyerName = $OrganName ? $OrganName : $v['BuyerName'];
            $datas[$k]['BuyerName'] = "<p class='eval_organ'>" . $BuyerName . "</p>";
        }
        $data->setData($datas);
        return $data;
    }

    //订单条件
    private static function getOrderCond($params, $select) {
        $OrganID = $params['OrganID'] ? $params['OrganID'] : Yii::app()->user->getOrganID();
        $seaCon = "select $select from pap_order t where t.Status=9";
        $seaCon.= " and SellerID = $OrganID and IsDelete = 0";
        $seaCon.=" and t.CreateTime >={$params['starttime']} and t.CreateTime < {$params['endtime']}";
        if ($params['payment'] == 1)
            $seaCon.=" and t.Payment=1";
        else if ($params['payment'] == 2)
            $seaCon.=" and t.Payment=2";
        $seaCon.=" order by CreateTime DESC";
        return $seaCon;
    }

    //退货单条件
    private static function getReturnCond($params, $select) {
        $OrganID = $params['OrganID'] ? $params['OrganID'] : Yii::app()->user->getOrganID();
        $seaCon = "select $select from pap_return_order t where t.Status in(4,14)";
        $seaCon.= " and DealerID = $OrganID";
        $seaCon.=" and t.CreateTime >={$params['starttime']} and t.CreateTime < {$params['endtime']}";
        if ($params['payment'] == 1)
            $seaCon.=" and t.PayMethod=0";
        else if ($params['payment'] == 2)
            $seaCon.=" and t.PayMethod=2";
        $seaCon.=" order by CreateTime DESC";
        return $seaCon;
    }

    //退货单列表
    public static function getReturn($params) {
        $select = "ID,ReturnNO,CreateTime,PayMethod,ServiceID,Price";
        $seaCon = self::getReturnCond($params, $select);
        $pageSize = $params['pageSize'] ? $params['pageSize'] : 20;
        // $page = $params['page'] ? $params['page'] : 1;
        $count = Yii::app()->papdb->createCommand(str_replace($select, 'count(ID)', $seaCon))->queryScalar();
        $data = new CSqlDataProvider($seaCon, array(
                    'totalItemCount' => $count,
                    'db' => Yii::app()->papdb,
                    'pagination' => array(
                        'pageSize' => $pageSize,
                        )));
        $datas = $data->getData();
        foreach ($datas as $k => $v) {
            //$datas[$k]['rowNO'] = $k + 1 + ($page - 1) * $pageSize;
            $datas[$k]['CreateTime'] = date('Y-m-d H:i:s', $v['CreateTime']);
            $datas[$k]['PayMethod'] = $v['PayMethod'] == 0 ? '支付宝担保' : '物流代收款';
            $datas[$k]['BuyerName'] = "<p class='eval_organ'>" . Organ::model()->findByPk($v['ServiceID'])->attributes['OrganName'] . "</p>";
        }
        $data->setData($datas);
        return $data;
    }

    //获取对账单
    public static function getAccount($params) {
        $select1 = "ID,OrderSN as No,CreateTime,Payment,BuyerID,RealPrice as Price,BuyerName,1";
        $select2 = "ID,ReturnNO as No,CreateTime,PayMethod as Payment,ServiceID as BuyerID,-Price as Price,2";
        //只查订单
        if ($params['type'] == 1) {
            $seaCon1 = self::getOrderCond($params, $select1);
            $data1 = Yii::app()->papdb->createCommand($seaCon1)->queryAll();
        }
        //只查退货单
        else if ($params['type'] == 2) {
            $seaCon2 = self::getReturnCond($params, $select2);
            $data2 = Yii::app()->papdb->createCommand($seaCon2)->queryAll();
        } else {
            $seaCon1 = self::getOrderCond($params, $select1);
            $data1 = Yii::app()->papdb->createCommand($seaCon1)->queryAll();
            $seaCon2 = self::getReturnCond($params, $select2);
            $data2 = Yii::app()->papdb->createCommand($seaCon2)->queryAll();
        }
        $rawData = array();
        if ($data1 && $data2) {
            $rawData = array_merge($data1, $data2);
            $key1 = true;
        } else if ($data1)
            $rawData = $data1;
        else if ($data2)
            $rawData = $data2;
        $timeKey = array();
        $amount['income'] = 0;
        $amount['pay'] = 0;
        if ($rawData) {
            $key2 = true;
            foreach ($rawData as $k => $v) {
                $timeKey[] = $v['CreateTime'];
                if ($v[1] == 1) {
                    $rawData[$k]['Name'] = '订单收入';
                    $rawData[$k]['Payment'] = $v['Payment'] == 1 ? '支付宝担保' : '物流代收款';
                    $amount['income']+=$v['Price'];
                } else {
                    $rawData[$k]['Name'] = '退款支付';
                    $rawData[$k]['Payment'] = $v['Payment'] == 0 ? '支付宝担保' : '物流代收款';
                    $amount['pay']+=$v['Price'];
                }
                if (!$v['BuyerName']) {
                    $rawData[$k]['BuyerName'] = Organ::model()->findByPk($v['BuyerID'])->attributes['OrganName'];
                }
            }
        }
        $amount['total'] = $amount['income'] + $amount['pay'];
        if ($key1 && $key2)
            array_multisort($timeKey, SORT_DESC, $rawData);
        $data = new CArrayDataProvider($rawData, array(
                    'pagination' => array(
                        'pageSize' => 20,
                    ),
                ));
        return array('data' => $data, 'amount' => $amount);
    }

    //打印对账单
    public static function printAccount($params) {
        $select1 = "OrderSN as No,CreateTime,Payment,BuyerID,RealPrice as Price,BuyerName,1";
        $select2 = "ReturnNO as No,CreateTime,PayMethod as Payment,ServiceID as BuyerID,Price,2";
        if ($params['type'] == 1) {
            $seaCon1 = self::getOrderCond($params, $select1);
            $count1 = Yii::app()->papdb->createCommand(str_replace($select1, 'sum(RealPrice)', $seaCon1))->queryScalar();
            $data1 = Yii::app()->papdb->createCommand($seaCon1)->queryAll();
        } else if ($params['type'] == 2) {
            $seaCon2 = self::getReturnCond($params, $select2);
            $count2 = Yii::app()->papdb->createCommand(str_replace($select2, 'sum(Price)', $seaCon2))->queryScalar();
            $data2 = Yii::app()->papdb->createCommand($seaCon2)->queryAll();
        } else {
            $seaCon1 = self::getOrderCond($params, $select1);
            $count1 = Yii::app()->papdb->createCommand(str_replace($select1, 'sum(RealPrice)', $seaCon1))->queryScalar();
            $data1 = Yii::app()->papdb->createCommand($seaCon1)->queryAll();
            $seaCon2 = self::getReturnCond($params, $select2);
            $count2 = Yii::app()->papdb->createCommand(str_replace($select2, 'sum(Price)', $seaCon2))->queryScalar();
            $data2 = Yii::app()->papdb->createCommand($seaCon2)->queryAll();
        }

        return array('order' => array('data' => $data1, 'count' => $count1), 'return' => array('data' => $data2, 'count' => $count2));
    }

    //邮件发送对账单
    public static function sendAccount($params) {
        $select1 = "OrderSN as No,CreateTime,Payment,BuyerID,RealPrice as Price,BuyerName,1";
        $select2 = "ReturnNO as No,CreateTime,PayMethod as Payment,ServiceID as BuyerID,Price,2";
        if ($params['type'] == 1) {
            $seaCon1 = self::getOrderCond($params, $select1);
            $data1 = Yii::app()->papdb->createCommand($seaCon1)->queryAll();
            $count1 = Yii::app()->papdb->createCommand(str_replace($select1, 'sum(RealPrice)', $seaCon1))->queryScalar();
        } else if ($params['type'] == 2) {
            $seaCon2 = self::getReturnCond($params, $select2);
            $data2 = Yii::app()->papdb->createCommand($seaCon2)->queryAll();
            $count2 = Yii::app()->papdb->createCommand(str_replace($select2, 'sum(Price)', $seaCon2))->queryScalar();
        } else {
            $seaCon1 = self::getOrderCond($params, $select1);
            $data1 = Yii::app()->papdb->createCommand($seaCon1)->queryAll();
            $count1 = Yii::app()->papdb->createCommand(str_replace($select1, 'sum(RealPrice)', $seaCon1))->queryScalar();
            $seaCon2 = self::getReturnCond($params, $select2);
            $data2 = Yii::app()->papdb->createCommand($seaCon2)->queryAll();
            $count2 = Yii::app()->papdb->createCommand(str_replace($select2, 'sum(Price)', $seaCon2))->queryScalar();
        }
        $count1 = $count1 ? $count1 : 0;
        $count2 = $count2 ? $count2 : 0;
        $gain = $count1 - $count2;
        $day = date('t', $params['starttime']);
        $organ = Organ::model()->findByPk($params['OrganID'], array('select' => 'OrganName,Email'))->attributes;

        $email = $organ['Email'];
        $subject = '由你配 - ' . $params['uyear'] . '年' . $params['umonth'] . '月对账单';
        $message = "
            <!DOCTYPE html PUBLIC '-//W3C//DTD XHTML 1.0 Transitional//EN' 'http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd'>
        <html xmlns='http://www.w3.org/1999/xhtml'>
         <head>
        <meta http-equiv='Content-Type' content='text/html; charset=utf-8' />
        <title>由你配 - 打印对账单</title>
        </head>
         <body>
        <link rel='stylesheet' type='text/css' href='" . F::themeUrl() . "/css/jpd/account.css'/>
        <div class='wrapper' style='width:700px; background:#fff; margin:0 auto'>
            <div class='head' style='height:55px; line-height:55px; border-bottom:1px solid #0566c2; background:url(\"http://192.168.2.29:8000/themes/default/images/jpd/logo_account.jpg\") #1f76c8 no-repeat'>
                <div class='title' style='margin:0 auto; text-align:center'>
                <span style='font-family:微软雅黑; font-size:24px; font-weight: bold; color:#fff; word-spacing:8px; letter-spacing: 1.5px;'>" . $params['uyear'] . "年" . $params['umonth'] . "月对账单</span>
                </div>
            </div>
            <div class='info' style='padding:0 20px; font-size:12px; color:#343434'>
                <p style='margin:0px; line-height:28px'>亲爱的" . $organ['OrganName'] . "，您好！</p>
                <p style='margin:0px; line-height:28px'>感谢您使用由你配平台，以下是您" . $params['umonth'] . "月的平台交易明细：</p>
            </div>
            <div class='summary' style=' height:60px; line-height:30px; border-bottom:2px solid #c9c7c7; border-top:2px solid #c9c7c7; background:#f2f2f2; padding:0 30px'>
                <div class='float_l all' style='font-size:14px; font-weight:bold; color:#565656; line-height:60px;float:left'>
                    本月净收益： <span class='blue' style='color:#1f76c8'>" . $gain . "</span> 元

                </div>
                <div class='float_r detial' style='font-size:12px; font-weight:bold; line-height:30px;float:right'>
                    <p style='margin:0px; line-height:28px'>本月总收入： <span class='blue f14' style='color:#1f76c8;font-size:14px'>" . $count1 . "</span>元
                        <span class='m_left50' style='margin-left:50px'>本月总支出： 
                        <span class='blue f14' style='color:#1f76c8;font-size:14px'>" . $count2 . "</span>元</span></p>
                    <p style='margin:0px; line-height:28px'>账单周期：" . $params['uyear'] . "年" . $params['umonth'] . "月01日—" . $params['uyear'] . "年" . $params['umonth'] . "月" . $day . "日</p>
        </div>
        </div>";
        if (!empty($data1)) {
            $message.="<p class='line30' style='line-height:35px; margin:0px; margin-left:7px'><b class='f14 blue' style='color:#1f76c8;font-size:14px'>订单明细:</b></p>
        <table class='table' cellpadding='0'  cellspacing='0' style='width:685px; text-align:center; border:1px solid #c9c7c7; border-top:none; margin:0 auto; border-right:none; border-bottom:none'>
            <thead>
                <tr style='background:#5783ad; line-height:35px; color:#fff; font-weight:bold; font-size:14px; letter-spacing:1px'>
                <td>时间</td><td>交易类型</td><td>修理厂名称</td><td>订单编号</td><td class='last'>收入（元）</td></tr>
            </thead>
            <tbody>";
            foreach ($data1 as $k => $v) {
                $payment = $v['Payment'] == 1 ? '支付宝担保' : '物流代收款';
                $class = $k % 2 != 0 ? ';background:#eef6fd' : '';
                $message.="<tr style='line-height:30px" . $class . "'><td style='border-bottom:1px solid #c9c7c7; border-right:1px solid #c9c7c7; font-size:12px; color:#343434'>" . date('Y-m-d', $v['CreateTime']) . "</td>
                    <td style='border-bottom:1px solid #c9c7c7; border-right:1px solid #c9c7c7; font-size:12px; color:#343434'>" . $payment . "</td>
                    <td style='border-bottom:1px solid #c9c7c7; border-right:1px solid #c9c7c7; font-size:12px; color:#343434'>" . $v['BuyerName'] . "</td>
                    <td style='border-bottom:1px solid #c9c7c7; border-right:1px solid #c9c7c7; font-size:12px; color:#343434'>" . $v['No'] . "</td>
                    <td style='border-bottom:1px solid #c9c7c7; border-right:1px solid #c9c7c7; font-size:12px; color:#343434'>￥" . $v['Price'] . "</td>
                </tr>";
            }
            $message.="</tbody></table>";
        }
        if (!empty($data2)) {
            $message.="<p class='line30' style='line-height:35px; margin:0px; margin-left:7px'><b class='f14 blue' style='color:#1f76c8;font-size:14px'>退货明细:</b></p>
        <table class='table' cellpadding='0'  cellspacing='0' style='width:685px; text-align:center; border:1px solid #c9c7c7; border-top:none; margin:0 auto; border-right:none; border-bottom:none'>
            <thead>
                <tr style='background:#5783ad; line-height:35px; color:#fff; font-weight:bold; font-size:14px; letter-spacing:1px'>
                <td>时间</td><td>退款方式</td><td>修理厂名称</td><td>退货单号</td><td class='last'>支出（元）</td></tr>
            </thead>
            <tbody>";
            foreach ($data2 as $k => $v) {
                $payment = $v['Payment'] == 0 ? '支付宝担保' : '物流代收款';
                $v['BuyerName'] = Organ::model()->findByPk($v['BuyerID'], array('select' => 'OrganName'))->attributes['OrganName'];
                $class = $k % 2 != 0 ? ';background:#eef6fd' : '';
                $message.="<tr style='line-height:30px" . $class . "'><td style='border-bottom:1px solid #c9c7c7; border-right:1px solid #c9c7c7; font-size:12px; color:#343434'>" . date('Y-m-d', $v['CreateTime']) . "</td>
                    <td style='border-bottom:1px solid #c9c7c7; border-right:1px solid #c9c7c7; font-size:12px; color:#343434'>" . $payment . "</td>
                    <td style='border-bottom:1px solid #c9c7c7; border-right:1px solid #c9c7c7; font-size:12px; color:#343434'>" . $v['BuyerName'] . "</td>
                    <td style='border-bottom:1px solid #c9c7c7; border-right:1px solid #c9c7c7; font-size:12px; color:#343434'>" . $v['No'] . "</td>
                    <td style='border-bottom:1px solid #c9c7c7; border-right:1px solid #c9c7c7; font-size:12px; color:#343434'>￥" . $v['Price'] . "</td>
                </tr>";
            }
            $message.="</tbody></table>";
        }
        $message.="</div></body></html>";
        return UserModule::sendMail($email, $subject, $message);
    }

    //导出为excel
    public static function exportAccount($params) {
        $select1 = "OrderSN as No,CreateTime,Payment,BuyerID,RealPrice as Price,BuyerName,1";
        $seaCon1 = self::getOrderCond($params, $select1);
        $data1 = Yii::app()->papdb->createCommand($seaCon1)->queryAll();
        $select2 = "ReturnNO as No,CreateTime,PayMethod as Payment,ServiceID as BuyerID,-Price as Price,2";
        $seaCon2 = self::getReturnCond($params, $select2);
        $data2 = Yii::app()->papdb->createCommand($seaCon2)->queryAll();
        $data = array_merge($data1, $data2);

        $timeKey = array();
        foreach ($data as $v) {
            $timeKey[] = $v['CreateTime'];
        }
        array_multisort($timeKey, SORT_DESC, $data);

        //导出
        $objectPHPExcel = new PHPExcel();
        $objectPHPExcel->setActiveSheetIndex(0);
        //excel表头的输出
        $objectPHPExcel->getActiveSheet()->mergeCells('A1:F1');
        $objectPHPExcel->getActiveSheet()->setCellValue('A1', '月度账单表');
        $objectPHPExcel->setActiveSheetIndex(0)->getStyle('A1')->getFont()->setSize(24);
        $objectPHPExcel->setActiveSheetIndex(0)->getStyle('A1')
                ->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
        $time = $params['uyear'] . '年' . $params['umonth'] . '月';
        $objectPHPExcel->getActiveSheet()->mergeCells('A2:F2');
        $objectPHPExcel->getActiveSheet()->setCellValue('A2', $time);
        $objectPHPExcel->setActiveSheetIndex(0)->getStyle('A2')->getFont()->setSize(14);
        $objectPHPExcel->setActiveSheetIndex(0)->getStyle('A2')
                ->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_LEFT);
        $objectPHPExcel->getActiveSheet()->getStyle('A2:F2')
                ->getBorders()->getTop()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);

        //表格头的输出
        $objectPHPExcel->getActiveSheet()->getColumnDimension('A')->setWidth(30);
        $objectPHPExcel->setActiveSheetIndex(0)->setCellValue('A4', '时间');
        $objectPHPExcel->getActiveSheet()->getColumnDimension('B')->setWidth(25);
        $objectPHPExcel->setActiveSheetIndex(0)->setCellValue('B4', '交易类型');
        $objectPHPExcel->getActiveSheet()->getColumnDimension('C')->setWidth(20);
        $objectPHPExcel->setActiveSheetIndex(0)->setCellValue('C4', '名称');
        $objectPHPExcel->getActiveSheet()->getColumnDimension('D')->setWidth(40);
        $objectPHPExcel->setActiveSheetIndex(0)->setCellValue('D4', '修理厂名称');
        $objectPHPExcel->getActiveSheet()->getColumnDimension('E')->setWidth(30);
        $objectPHPExcel->setActiveSheetIndex(0)->setCellValue('E4', '订单/退货单编号');
        $objectPHPExcel->getActiveSheet()->getColumnDimension('F')->setWidth(20);
        $objectPHPExcel->setActiveSheetIndex(0)->setCellValue('F4', '收入/支出');

        //设置行高
        $objectPHPExcel->getActiveSheet()->getDefaultRowDimension()->setRowHeight(20);
        $objectPHPExcel->getActiveSheet()->getRowDimension('1')->setRowHeight(40);
        $objectPHPExcel->getActiveSheet()->getRowDimension('2')->setRowHeight(20);
        $objectPHPExcel->getActiveSheet()->getRowDimension('3')->setRowHeight(30);
        $objectPHPExcel->getActiveSheet()->getStyle('A4:F4')->getFont()->setBold(true);

        //设置居中
        $objectPHPExcel->getActiveSheet()->getStyle('A4:F4')
                ->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
        $objectPHPExcel->getActiveSheet()->getStyle('A4:F4')
                ->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);

        $income = 0;
        $pay = 0;
        $n = 1;
        foreach ($data as $product) {
            if ($product[1] == 1) {
                $name = '订单收入';
                $payment = $product['Payment'] == 1 ? '支付宝担保' : '物流代收款';
                $income+=$product['Price'];
            } else {
                $name = '退款支付';
                $payment = $product['Payment'] == 0 ? '支付宝担保' : '物流代收款';
                $pay+=$product['Price'];
            }
            if (!$product['BuyerName']) {
                $product['BuyerName'] = Organ::model()->findByPk($product['BuyerID'])->attributes['OrganName'];
            }
            //明细的输出
            $objectPHPExcel->getActiveSheet()->setCellValue('A' . ($n + 4), date('Y-m-d H:i:s', $product['CreateTime']));
            $objectPHPExcel->getActiveSheet()->setCellValue('B' . ($n + 4), $payment);
            $objectPHPExcel->getActiveSheet()->setCellValue('C' . ($n + 4), $name);
            $objectPHPExcel->getActiveSheet()->setCellValue('D' . ($n + 4), $product['BuyerName']);
            $objectPHPExcel->getActiveSheet()->setCellValue('E' . ($n + 4), $product['No']);
            $objectPHPExcel->getActiveSheet()->setCellValue('F' . ($n + 4), $product['Price']);

            $objectPHPExcel->getActiveSheet()->getStyle('A' . ($n + 4) . ':F' . ($n + 4))
                    ->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
//            $objectPHPExcel->getActiveSheet()->getStyle('A' . ($n + 4) . ':F' . ($n + 4))
//                    ->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);

            $n+=1;
        }
        $total = $income + $pay;
        $objectPHPExcel->getActiveSheet()->mergeCells('A3:B3');
        $objectPHPExcel->getActiveSheet()->setCellValue('A3', '收入：' . $income);

        $objectPHPExcel->getActiveSheet()->mergeCells('C3:D3');
        $objectPHPExcel->getActiveSheet()->setCellValue('C3', '支出：' . $pay);

        $objectPHPExcel->getActiveSheet()->mergeCells('E3:F3');
        $objectPHPExcel->getActiveSheet()->setCellValue('E3', '合计：' . $total);

        $objectPHPExcel->setActiveSheetIndex(0)->getStyle('A3:F3')
                ->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
        $objectPHPExcel->getActiveSheet()->getStyle('A3:F3')
                ->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);
        $objectPHPExcel->getActiveSheet()->getStyle('A3:F3')
                ->getBorders()->getBottom()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
        $objectPHPExcel->getActiveSheet()->getPageSetup()->setHorizontalCentered(true);
        $objectPHPExcel->getActiveSheet()->getPageSetup()->setVerticalCentered(false);

        ob_end_clean();
        ob_start();

        header('Content-Type : application/vnd.ms-excel');
        header('Content-Disposition:attachment;filename="' . iconv("utf-8", "gb2312", $time . "账单表-") . '.xls"');
        $objWriter = PHPExcel_IOFactory::createWriter($objectPHPExcel, 'Excel5');
        $objWriter->save('php://output');
    }

}

?>
