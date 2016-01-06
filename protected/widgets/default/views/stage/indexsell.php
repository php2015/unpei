<style>
    .area-sub {
        clear: both;
    }

    .cx {
        height: 53px;
    }
    .pager{
        display: none;
    }
    .indexmore{
        padding-left: 400px;
        padding-top: 5px; 
        display: block;
        color: #0065bf;
        padding-bottom: 10px;

    }
</style>
<div class="area-sub">
    <div class="tab-product tab-sub-3 ui-style-gradient" id="layout-t6">
        <div class="tab-hd"> 
            <span style="margin-left:30px" class="tab-hd-con current"  key="current1"><a href="javascript:;">收到的询价单</a></span> 
            <span class="tab-hd-con " key="current2"><a href="javascript:;">待报价的询价单</a></span> 
            <span class="tab-hd-con"  style="border-right: 1px solid #e2e2e2"  key="current3"><a href="javascript:;">待发货的订单</a></span>
            <div style="clear:both"></div>
            <!--<span class="tab-hd-con bor_right" key="current4"><a href="javascript:;">异常订单</a></span>--> 
        </div>
        <div class="tab-bd dom-display dom-display8">
            <div class="tab-bd-con current1"> 
                <?php
//                var_dump(InquiryService::getinqlists($params));
                $this->widget('widgets.default.WGridView', array(
                    'dataProvider' => InquiryService::getinqlists(array()),
//                'pager' => false,
                    'columns' => array(
                        array(// display 'create_time' using an expression
                            'name' => '#',
                            'value' => '$data[rowNO]',
                        ),
                        array(// display 'create_time' using an expression
                            'name' => '询价单编号',
                            'value' => ' $data["InquirySn"]',
                        ),
                        array(// display 'author.username' using an expression
                            'name' => '发起方',
                            'value' => 'QuotationService::getservicename($data["OrganID"])',
                        ),
                        array(// display 'author.username' using an expression
                            'name' => '询价时间',
                            'value' => 'date("Y-m-d H:i:s",$data["CreateTime"])',
                        ),
                        array(// display 'author.username' using an expression
                            'name' => '状态',
                            'type' => 'raw',
                            'value' => '$data["stamsg"]',
                        ),
                        array(// display 'author.username' using an expression
                            'name' => '询价单详情',
                            'type' => 'raw',
                            'value' => '$data["Info"]',
                        ),
//                        array(// display 'author.username' using an expression 
//                            'header' => '询价单详情',
//                            'class' => 'CButtonColumn',
//                            'template' => '{view}',
//                            'buttons' => array(
//                                'view' => array(
//                                    'lable' => '详情',
//                                    'url' => 'Yii::app()->createUrl("/pap/inquirylist/viewquo",array("inqid"=>$data[InquiryID]))'
//                                )
//                            )
//                        ),
//                    array(// display a column with "view", "update" and "delete" buttons
//                        'class' => 'CButtonColumn',
//                    ),
                    ),
                ));
                ?>
                <div><a class="indexmore" href="<?php echo Yii::app()->createUrl("pap/inquirylist/index") ?>">查看更多</a></div>
            </div>
            <div class="tab-bd-con current2" style="display: none;"> 
                <?php
                $this->widget('widgets.default.WGridView', array(
                    'dataProvider' => InquiryService::getinqlists(array('status' => 0)),
                    'columns' => array(
                        array(// display 'create_time' using an expression
                            'name' => '#',
                            'value' => '$data[rowNO]',
                        ),
                        array(// display 'create_time' using an expression
                            'name' => '询价单编号',
                            'value' => ' $data["InquirySn"]',
                        ),
                        array(// display 'author.username' using an expression
                            'name' => '发起方',
                            'value' => 'QuotationService::getservicename($data["OrganID"])',
                        ),
                        array(// display 'author.username' using an expression
                            'name' => '询价时间',
                            'value' => 'date("Y-m-d H:i:s",$data["CreateTime"])',
                        ),
                        array(// display 'author.username' using an expression
                            'name' => '状态',
                            'type' => 'raw',
                            'value' => '$data["stamsg"]',
                        ),
                        array(// display 'author.username' using an expression
                            'name' => '询价单详情',
                            'type' => 'raw',
                            'value' => '$data["Info"]',
                        ),
//                        array(// display 'author.username' using an expression
//                            'header' => '询价单详情',
//                            'class' => 'CButtonColumn',
//                            'template' => '{view}',
//                            'buttons' => array(
//                                'view' => array(
//                                    'lable' => '详情',
//                                    'url' => 'Yii::app()->createUrl("/pap/inquirylist/viewquo",array("inqid"=>$data[InquiryID]))'
//                                )
//                            )
//                        ),
                    ),
                ));
                ?>
                <div><a class="indexmore" href="<?php echo Yii::app()->createUrl("pap/inquirylist/index/sta/0") ?>">查看更多</a></div>
            </div>
            <div class="tab-bd-con current3" style="display: none;"> 
                <?php
//                var_dump(SellerorderService::getSellOrderList(array('Status' => 2, 'pageSize' => 10)));
                $Orderlist = SellerorderService::getSellOrderList(array('Status' => 2, 'pageSize' => 10, 'starttime' => 1));
                // var_dump($Orderlist);exit;
                $this->widget('widgets.default.WGridView', array(
                    'dataProvider' => $Orderlist['dataProvider'],
//                'pager' => false,
                    'columns' => array(
                        array(// display 'create_time' using an expression
                            'name' => '#',
                            'value' => '$data[rowNO]',
                        ),
                        array(// display 'author.username' using an expression
                            'name' => '下单时间',
                            'value' => 'SellerorderService::returnTime($data[CreateTime])',
                        ),
                        array(// display 'author.username' using an expression
                            'name' => '订单编号',
                            'value' => '$data[OrderSN]',
                        ),
                        array(// display 'author.username' using an expression
                            'name' => '机构名称',
                            'value' => '$data[BuyerName]',
                        ),
                        array(// display 'author.username' using an expression
                            'name' => '总金额',
                            'value' => '￥.$data[RealPrice]',
                        ),
                        array(// display 'author.username' using an expression
                            'name' => '订单详情',
                            'type' => 'raw',
                            'value' => '$data[Info]',
                        ),
                    ),
                ));
                ?>
                <div><a class="indexmore" href="<?php echo Yii::app()->createUrl("pap/sellerorder/index", array('Status' => 2, 'type' => 2)) ?>">查看更多</a></div>
            </div>
        </div>

    </div>
</div>