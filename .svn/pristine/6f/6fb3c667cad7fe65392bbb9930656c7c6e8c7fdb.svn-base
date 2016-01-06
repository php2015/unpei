<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <title>由你配 - 打印对账单</title>
        <link rel="stylesheet" type="text/css" href="<?php echo F::themeUrl() ?>/css/jpd/account.css"/>
    </head>
    <body>
        <div class="wrapper">
            <div class="head">
              <!-- <img src="images/logo.jpg" class="float_l">-->
                <div class="title"> <span><?php echo $params['uyear'] . "年" . $params['umonth'] . "月对账单" ?></span></div>
            </div>
            <div class="info">
                <p>亲爱的<?php echo $params['OrganName'] ?>，您好！</p>
                <p>感谢您使用由你配平台，以下是您<?php echo $params['umonth'] ?>月的平台交易明细：</p>
            </div>
            <div class="summary">
                <div class="float_l all" >
                    本月净收益： <span class="blue"><?php echo $order['count'] - $return['count'] ?></span> 元

                </div>
                <div class="float_r detial">
                    <p>本月总收入： <span class="blue f14"><?php echo $order['count'] ? $order['count'] : 0 ?> </span>元
                        <span class="m_left50">本月总支出： <span class="blue f14"><?php echo $return['count'] ? $return['count'] : 0 ?></span> 元</span></p>
                    <?php $day = date('t', $params['starttime']); ?>
                    <p>账单周期： <?php echo "{$params['uyear']}年{$params['umonth']}月01日—{$params['uyear']}年{$params['umonth']}月{$day}日" ?></p>
                </div>

            </div>
            <?php if (!empty($order['data'])): ?>
                <p class="line30"><b class="f14 blue">订单明细:</b></p>
                <table class="table" cellpadding="0"  cellspacing="0">
                    <thead>
                        <tr><td>时间</td><td>交易类型</td><td>修理厂名称</td><td>订单编号</td><td class="last">收入（元）</td></tr>
                    </thead>
                    <tbody>
                        <?php foreach ($order['data'] as $k => $v): ?>
                            <?php
                            $payment = $v['Payment'] == 1 ? '支付宝担保' : '物流代收款';
                            //$v['BuyerName'] = Organ::model()->findByPk($v['BuyerID'])->attributes['OrganName'];
                            ?>
                            <tr <?php echo $k % 2 != 0 ? 'class="blue_s"' : '' ?>><td><?php echo date('Y-m-d', $v['CreateTime']) ?></td>
                                <td><?php echo $payment ?></td>
                                <?php
                                if (!$v['BuyerName']) {
                                    $v['BuyerName'] = Organ::model()->findByPk($v['BuyerID'], array('select' => 'OrganName'))->attributes['OrganName'];
                                }
                                ?>
                                <td><?php echo $v['BuyerName'] ?></td>
                                <td><?php echo $v['No'] ?></td>
                                <td>￥<?php echo $v['Price'] ?></td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            <?php endif; ?>
            <?php if (!empty($return['data'])): ?>
                <p class="line30"><b class="f14 blue">退货明细:</b></p>
                <table class="table" cellpadding="0"  cellspacing="0">
                    <thead>
                        <tr><td>时间</td><td>退款方式</td><td>修理厂名称</td><td>退货单号</td><td class="last">支出（元）</td></tr>
                    </thead>
                    <tbody>
                        <?php foreach ($return['data'] as $k => $v): ?>
                            <?php
                            $payment = $v['Payment'] == 0 ? '支付宝担保' : '物流代收款';
                            $v['BuyerName'] = Organ::model()->findByPk($v['BuyerID'])->attributes['OrganName'];
                            ?>
                            <tr <?php echo $k % 2 != 0 ? 'class="blue_s"' : '' ?>><td><?php echo date('Y-m-d', $v['CreateTime']) ?></td>
                                <td><?php echo $payment ?></td>
                                <td><?php echo $v['BuyerName'] ?></td>
                                <td><?php echo $v['No'] ?></td>
                                <td>￥<?php echo $v['Price'] ?></td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            <?php endif; ?>
        </div>
    </body>
</html>

