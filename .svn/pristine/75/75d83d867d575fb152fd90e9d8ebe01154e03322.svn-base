<style>
    #vivle{
        margin-top: 10px;
        margin-left: 92px
    }
    #dealerlist{
        margin-top: 10px 
    }

    a.s,a.a{
        background: url("<?php echo F::themeUrl() . '/images/num-control.png' ?>");
        display: inline-block;
        float: left;
        height: 22px;
        margin-left: 4px;
        width: 22px;
    }
    a.a{ background-position:center right; }

    .txxx {
        border-bottom: 1px solid #c9d5e3;
        color: #0065bf;
        font-size: 14px;
        font-weight: bold;
        height: 35px;
        line-height: 35px;
        text-indent: 15px;
    }
    .btn_addPic {
        background: url('<?php echo F::themeUrl() . '/images/sc.png' ?>') repeat scroll 0 0 rgba(0, 0, 0, 0);
        cursor: pointer;
        display: inline-block;
        height: 80px;
        overflow: hidden;
        position: relative;
        width: 80px;
    }
    .filePrew {
        cursor: pointer;
        display: block;
        height: 80px;
        left: 0;
        opacity: 0;
        position: absolute;
        top: 0;
        width: 80px;
    }
    a.jiahao {
        background: none repeat scroll 0 0 #0164c2;
        color: #fff;
        font-weight: bold;
        padding: 2px 5px;
    }
    a.jianhao {
        background: none repeat scroll 0 0 #ff5400;
    }
    #epc_make{background:#FFFFFF}
    #epc_series{background:#FFFFFF}
    #epc_year{background:#FFFFFF}
    #epc_model{background:#FFFFFF}
    .add_xjd .txxx_info{ margin:0px}
    .order_bg .state .order_step{ width:160px}
    tbody tr{
        cursor:pointer;
    }

</style>
<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->theme->baseUrl ?>/css/pap/jxs.css" />
<?php
$this->breadcrumbs = array(
    '采购管理' => Yii::app()->createUrl('common/buylist'),
    '退货管理' => Yii::app()->createUrl('pap/buyreturn/index'),
    '选择经销商',
);
?>  
<ul class="order_bg">
    <li class="<?php echo 'state' ?>" style="width:142px">
        <span class="order_step state" >选择经销商</span>
    </li>
    <li class="" style="width:142px">
        <span class="order_step state" >申请退货</span>
    </li>
    <li class="" style="width:142px">
        <span class="order_step state">审核退货</span>
    </li>
    <li class="" style="width:142px">
        <span class="order_step state">买家发货</span>
    </li>
    <li class="" style="width:142px">
        <span class="order_step state">确认收货</span>
    </li>
    <li class="step_last" style="width:142px;">
        <span class="order_step state ">退货完成</span>
    </li>
</ul> 
<?php //var_dump($data->getData());?>
<div style="clear:both"></div>
<div class="bor_back  m-top" style="border:1px solid #cccccc">
    <div class="add_xjd">
        <p class="txxx">&nbsp;&nbsp;选择经销商(双击选择经销商名称)<span class="float_r" style="*margin-top:-35px;margin-right:20px ;">
                <a href="<?php echo Yii::app()->createUrl('/pap/buyreturn/index'); ?>" style="font-weight:400">查看退货(退款)列表</a></span>
        <div>
            <div class="txxx_info cxdw_info" >
                <form method="get" action="<?php echo Yii::app()->createUrl('pap/buyreturn/addsecond') ?>"> 
                    <p style="margin: 10px 0 0 20px"> 
                        <span>&nbsp;&nbsp;经销商名称：</span>
                        <input type="text"  class=" input input3 width263"  name="SellerName" value="<?php echo $SellerName ? $SellerName : '请输入经销商名称'; ?>" onfocus="if(value=='请输入经销商名称') {value=''}" onblur="if (value=='') {value='请输入经销商名称'}" > 
                        <input type="submit" class="submit m_left f_weight"  value="搜索">
                    </p>
                </form>
                <br />
                <?php
                $this->widget('widgets.default.WGridView', array(
                    'dataProvider' => $dataProvider,
                    'columns' => array(
                        array(// display 'author.username' using an expression
                            'name' => '经销商名称',
                            'value' => '$data->SellerName',
//                            'value' => '$data->OrganName', //选择全部jpd_organ 经销商
                        ),
                        array(
                            'name' => '联系方式',
//                            'value' => '$data->Phone', 
                            'value' => 'ReturnorderService::getDealerinfo($data[SellerID])',
                        ),
                        array(
                            'name' => '地址',
//                            'value' => 'ReturnorderService::getDealerinfodizhi($data[ID])',
                            'value' => 'ReturnorderService::getDealerinfodizhi($data[SellerID])',
                        ),
                        array(
                            'name' => '主营车系',
                            'type' => 'raw',
//                value => 'RPCClient::call("InquiryorderService_getdealermainchexi", $data[ID])'
                            value => 'RPCClient::call("InquiryorderService_getdealermainchexi", $data[SellerID])'
                        ),
                        array(
                            // display a column with "view", "update" and "delete" buttons
                            'class' => 'CButtonColumn',
//                            'header' => '申请退货',
                            'template' => '{update}',
                            'buttons' => array(
                                'update' => array(
                                    'label' => '申请',
                                    'url' => 'Yii::app()->createUrl("/pap/buyreturn/addreturn",array
("id"=>$data[SellerID]))'
                                ),
                            ),
                        ),
                    ),
                ));
                ?>
<!--                <p class=" m_top20 m_left65" style="margin-left: 30%;margin-bottom:30px">
                   <input type="button" class="submit f_weight" value="确认申请" onclick="sendinquiry()" id="sendinquiry">
                   <input type="button" class="submit f_weight" value="取消">
               </p>-->
            </div>
        </div>
    </div>
</div>
<script>
    $(".grid-view").find("tr .update").css('display','none'); //申请退货按钮 影藏
    $(".grid-view").find("tr").dblclick(function(){ 
        var url= $(this).find("td:eq(4)").find('a').attr('href');
        window.location.href=url;
    });
</script>
