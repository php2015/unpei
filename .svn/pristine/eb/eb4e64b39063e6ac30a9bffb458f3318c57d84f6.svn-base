<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->theme->baseUrl ?>/css/pap/jxs.css" />
<style>
    table tr td{
        vertical-align: middle;
    }
    .form-row li{
        float:left; 
    }
</style>
<!--内容部分-->
<?php
$this->breadcrumbs = array(
    '采购管理' => Yii::app()->createUrl('common/buylist'),
    '退货管理' => Yii::app()->createUrl('pap/buyreturn'),
    '退货单申诉',
);
?>  
<div class="bor_back m-top">              
    <div  class="ddxx"><p>订单信息</p></div>
    <div class="info-box ">
        <p class=" m-top20"><b>退货原因：</b>
            <span class="m-left"><?php echo $data->Result ?></span>

        </p>   
        <?php if (!empty($data->NoResult)): ?>
            <p class=" m-top20"><b>退货未通过原因：</b>
                <span class="m-left"><?php echo $data->NoResult ?></span>
            </p>
        <?php endif; ?>
        <p class="m-top20"><b>卖家信息</b></p>
        <ul class="mjxx m-top">
            <li>机构名称：<span><?php echo ReturnorderService::getOrganinfo($data->DealerID, 'OrganName') ?></span></li>
            <li>联系电话：<span><?php echo ReturnorderService::getOrganinfo($data->DealerID, 'Phone') ?></span></li>
            <li>机构地址：<span><?php echo ReturnorderService::getOrganinfo($data->DealerID, 'all')->Area ?></span></li>
            <div style="clear:both"></div>
            <p class="m-top20"></p>
        </ul>
        <div style="clear:both"></div>
        <?php //if ($data->Status > 1 && $data->Status != 5 && $data->Status != 6): ?>
<!--            <p class=" m-top20"><b>收货地址：</b>
                <span class="m-left">
                    <?php //echo isset($returnaddress['ShippingName']) ? $returnaddress['ShippingName'] : '' ?>，
                    <?php //echo isset($returnaddress['Mobile']) ? $returnaddress['Mobile'] : '' ?>  ，
                    <?php //echo Area::getCity($returnaddress['Province']) . Area::getCity($returnaddress['City']) . Area::getCity($returnaddress['Area']) . $returnaddress['Address'] ?>，
                    <?php //echo $returnaddress['ZipCode']; ?>
                </span>
            </p>-->
        <?php //endif; ?>
        <div style="clear:both"></div>
        <p class="m-top20"><b>订单信息</b></p>
        <ul class="mjxx m-top last">
            <li>订单类型：

                <?php if ($data->Type == 1): ?>
                    <span style="color:red">     
                        未收货退货订单(无退款)&nbsp;
                    </span>
                <?php else : ?>
                    <span>
                        已收货订单&nbsp;
                    </span>
                <?php endif; ?>

            </li>
            <li>退货单编号：<span><?php echo $data->ReturnNO ?></span></li>
            <li>成交时间：<span><?php echo date('Y-m-d H:i:s', $data->CreateTime) ?></span></li>
            <div style="clear:both"></div>
            <p class="m-top20"></p>
        </ul>
        <div style="clear:both"></div>
        <table class="m-top20 order_table">
            <thead>
                <tr class="order_state_hd"><td>商品信息</td><td>单价</td><td>数量</td><td>PN号</td><td>状态</td><td>退货单总价(元)</td></tr>
            </thead> 
            <tbody>
                <?php
                if ($data->returngoods): $count = count($data->returngoods);
                    foreach ($data->returngoods as $k => $value):
                        ?>
                        <?php
                        $goods = DealergoodsService::getmongoversion($value['GoodsID'], $value['Version']);
                        ?>
                        <tr class="order_bd">
                            <td>
                                <div class="div_img float_l m_left12" style="margin-top: 15px;">
                                    <a title="" class="order_goods" href="<?php echo Yii::app()->CreateUrl('pap/orderreview/ordergoods', array('goods' => $value['GoodsID'])) ?>" order="<?php echo $value['OrderID'] ?>" version="<?php echo $value['Version'] ?>" target='_blank'>
                                        <img src="
                                        <?php
                                        if ($goods['GoodsInfo']['img'][0]['ImageUrl']) {
                                            echo F::uploadUrl() . $goods['GoodsInfo']['img'][0]['ImageUrl'];
                                        } else {
                                            echo F::uploadUrl() . 'common/default-goods.png';
                                        }
                                        ?>" style="width: 90px;height: 100px;">
                                    </a>
                                </div> 
                                <div class="div_info float_l m_left m-top5" style="width:375px">
                                    <div style="float:left;text-align:left;width: 240px;"><a target='_blank' class="order_goods" order="<?php echo $value['OrderID'] ?>"version="<?php echo $value['Version'] ?>"  href="<?php echo Yii::app()->CreateUrl('pap/orderreview/ordergoods', array('goods' => $value['GoodsID'])) ?>" title="<?php echo $goods['GoodsInfo']['Name'] ?>"><b style="font-size:14px"><?php echo $goods['GoodsInfo']['Name'] ?></b></a></div>
                                    <div style="">订单编号：<?php echo OrderreturnService::orderIDgetorder($value['OrderID'], 'OrderSN'); ?></div>
                                    <div style="clear:both;height:0px"></div>
                                    <p class="">商品编号：<span class="zwq_color"><?php echo $goods['GoodsInfo']['GoodsNO'] ?></span> | 品牌：<span><?php echo $goods['GoodsInfo']['Brand'] ?></span></p>
                                    <p class="">标准名称：<span><?php echo $goods ? Gcategory::model()->find(array('select' => 'Name', 'condition' => "Code='{$goods['GoodsInfo']['StandCode']}'"))->attributes['Name'] : ReturnorderService::idgetgoodsinfo($value['OrderID'], $value['GoodsID'], 'CpName'); ?></span> | 拼音代码：<span><?php echo $goods['GoodsInfo']['Pinyin']; ?></span>
                                    <p>配件档次：<span><?php echo $goods['GoodsInfo']['PartsLevelName'] ?></span></p>

                                    <?php
                                    $orderGoods = PapOrderGoods::model()->find("OrderID=:OrderID and GoodsID=:GoodsID", array(":OrderID" => $value['OrderID'], ":GoodsID" => $goods['GoodsInfo']['ID']));
                                    ?>
                                    <p>定位车型：<span><?php echo MallService::getCarmodeltxt(array('make' => $orderGoods['MakeID'], 'series' => $orderGoods['CarID'], 'year' => $orderGoods['Year'], 'model' => $orderGoods['ModelID'])); ?></span></p>
                                    <p style="width:300px;height: 18px;white-space: nowrap;overflow: hidden; text-overflow: ellipsis;"> OE号：<span><?php
                                            if ($goods['GoodsInfo']['oeno']) {
                                                foreach ($goods['GoodsInfo']['oeno'] as $key => $v) {
                                                    if ($key) {
                                                        echo '、' . $v;
                                                    } else {
                                                        echo $v;
                                                    }
                                                }
                                            } if (!$goods) {
                                                echo ReturnorderService::idgetgoodsinfo($value['OrderID'], $value['GoodsID'], 'GoodsOE');
                                            }
                                            ?></span> </p>
                                </div>                                                     
                            </td>               
                            <td> <span class="zwq_color"><?php echo $value->Price ?></span></td> 
                            <td><span ><?php echo $value->Amount ?></span></td>    
                            <td><span ><?php echo $value->PIN ?></span></td>    
                            <?php if ($k == 0): ?>
                                <td rowspan="<?php echo $count ?>"> <span><?php echo ReturnorderService::getStatus($data->Status) ?></span></td>               
                                <td rowspan="<?php echo $count ?>">  <div class="zwq_color"><?php echo $data->Price ?></div></td>
                            <?php endif; ?>
                        </tr>
                        <?php
                    endforeach;
                endif;
                ?>
            </tbody>                 
        </table>



        <p class="m-top20"><b>申诉信息</b></p>
        <br />
        <span class='f14' style='vertical-align: top;'>申诉描述:</span>
        <textarea name="ComplainText" id="ComplainText" onkeyup="Checkshensu(this)" style="width:600px;height:84px" ></textarea>
        <span class="wordage">剩余字数：<span id="sy" style="color:Red;">200</span></span>

        <div class="eav-shaid" style=" margin-top: 10px"> 
            <div class="w60 float_l" style="text-align:left"><label class="color_r"></label>上传附件： &nbsp;</div>
            <div class="w600 float_l" style="text-align:left">
                <input type='file' name='file_upload' id="file_upload"><input type="hidden" value="上传" id="file-upload-start"><span style=" margin-left:10px; color:#666">只能上传1张附件</span>
                <br />
            </div>
            <div class="clear"></div>
            <div class="upload_img " >
                <ul>
                    <div class="form-row" id="showimglist" style=" position: relative;padding-left: 60px">
                        <?php if (!empty($organphotos)): ?>
                            <?php foreach ($organphotos as $k2 => $organphoto): ?>
                                <li style="">
                                    <img src="<?php echo F::uploadUrl() . $organphoto['Path']; ?>" style="width:80px;height:80px;">
                                    <span id="delfile" keyid="<?php echo $organphoto['Path'] ?>" class="guanbi3"><img src="<?php echo F::themeUrl(); ?>/images/guanbi3.png"></span>
                                </li>
                            <?php endforeach; ?>
                        <?php endif; ?>
                    </div>
                    <input type='hidden' value='' id="photoId" name='photoId' class='width114 input'>
                    <div style="clear:both"></div>
                </ul>
            </div>
        </div>
        <br />
        <br />
        <form id="complain_fm" action="" method="post" style="margin-left:60px; float:left;" > 
            <input type="hidden" name="ReturnNO" id="ReturnNO" value="<?php echo $data->ReturnNO ?>">
            <input type="hidden" name="ReturnID" id="ReturnID" value="<?php echo $data->ID ?>">
            <input type="hidden" name="DealerID" id="DealerID" value="<?php echo $data->DealerID ?>">
            <input type="hidden" name="ServiceID" id="ServiceID" value="<?php echo $data->ServiceID ?>">
            <input type="hidden" name="ComplainText" id="ComplainTexts">      
        </form>
        <div style="text-align:right">
            <input type="button" class="submit " value="提交申诉"  onclick="saveComplain()" style="cursor:pointer"/>
            <input type="button"  class="submit"id="goback" value="返回列表" />
        </div>

    </div>
</div>
<?php $this->renderPartial("uploadimgjs"); ?>
<script type="text/javascript" src='<?php echo F::themeUrl(); ?>/js/uploadify/jquery.uploadify.js'></script>
<link rel="stylesheet" href="<?php echo F::themeUrl(); ?>/js/uploadify/uploadify1.css">
<form action="" method="POST" id="goodsform" target="_blank">
    <input type="hidden" name="Version">
    <input type="hidden" name="Order">
</form>
<script>
                $(document).ready(function() {
                    //商品详情
                    $('.order_goods').bind('click', function() {
                        var url = this.href;
                        $('input[name=Version]').val($(this).attr('version'));
                        $('input[name=Order]').val($(this).attr('order'));
                        $('#goodsform').attr('action', url);
                        $('#goodsform').submit();
                        return false;
                    });
                    $("table tbody tr").mouseover(function() {
                        $(this).css("background", "white"); //取消table覆盖样式

                    });
                    var status = $('i.step-point').attr('status');
                    switch (status) {
                        case '1':
                            $('i.step-point').css({'left': '30%'});
                            break; //审核退货
                        case '2':
                            $('i.step-point').css({'left': '50%'});
                            break; //退货待发货
                        case '3':
                            $('i.step-point').css({'left': '68%'});
                            break; //退货待收货
                        case '4':
                            $('i.step-point').css({'left': '88%'});
                            break; //已完成
                        case '5':
                            $('i.step-point').css({'left': '11%'});
                            break; //审核未通过
                        case '6':
                            $('i.step-point').css({'left': '45%'});
                            break; //已取消
                    }
                });


//                var ComplainUrl = Yii_baseUrl + "/pap/buyreturn/subcomplain";
//                //保存申诉
//                function saveComplain() {
//                    $("#ComplainTexts").val($('textarea[name=ComplainText]').val());
//                    $("#complain_fm").attr("action", ComplainUrl);
//                    $("#complain_fm").submit();
//                }

                function saveComplain() {
                    var bool = window.confirm("确定提交吗?");
                    var ReturnNO = $('input[name=ReturnNO]').val();
                    var ComplainText = $('textarea[name=ComplainText]').val();
                    var DealerID = $('input[name=DealerID]').val();
                    var ServiceID = $('input[name=ServiceID]').val();
                    var goodsImages = $('input[name=goodsImages]').val();
                    var url = Yii_baseUrl + "/pap/buyreturn/subcomplain";
                    if (bool) {
                        $.post(url, {
                            ReturnNO: ReturnNO,
                            ComplainText: ComplainText,
                            DealerID: DealerID,
                            ServiceID: ServiceID,
                            goodsImages: goodsImages
                        }, function(data) {
                            if (data.success == 1) {
                                alert('申诉成功!');
                                window.location.href = Yii_baseUrl + "/pap/buyreturn/index";
                            }
                        }, 'json');
                    }
                }


                $('#goback').click(function() {
                    var url = Yii_baseUrl + '/pap/buyreturn';
                    window.location.href = url;
                });
                //字数限制
                function Checkshensu(which) {
                    var maxChars = 200; //
                    if (which.value.length > maxChars) {
                        alert("您出入的字数超多限制!");
                        // 超过限制的字数了就将 文本框中的内容按规定的字数 截取
                        which.value = which.value.substring(0, maxChars);
                        document.getElementById("sy").innerHTML = 0;
                        return false;
                    } else {
                        var curr = maxChars - which.value.length; //250 减去 当前输入的
                        document.getElementById("sy").innerHTML = curr.toString();
                        return true;
                    }
                }

                //删除图片事件
                $("#delfile").live('click', function() {
                    //$("#file_upload").uploadify('disable', false);
                    $(this).parent().parent().parent().parent().prev().prev().find(".uploadify").uploadify('disable', false);
                    $("#complain_fm").find('input[value="' + $(this).attr('keyid') + '"]').remove();
                    var photoId = $(this).attr('keyid');
                    $.post(
                            Yii_baseUrl + "/pap/buyreturn/delpto",
                            {imageid: photoId},
                    function(result) {
                        if (result.success) {
                            alert("删除成功！");
                        }
                    },
                            'json');
                    $(this).parent().remove();
                });

</script>

