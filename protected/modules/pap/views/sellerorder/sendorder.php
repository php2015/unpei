<style>
    .title_lm li{ float:left; font-size:14px; color:#0164c1; text-align:center; width:100px; text-indent:0}
    .title_lm li:hover{ border-bottom:2px solid #0164c1}
    .title_lm li.current{border-bottom:2px solid #0164c1 }
    .txxx2{ border-bottom:1px solid #c5d2e2}
    .tb_head li{ float:left; color:#fff ; text-align:center}
    .tb_head .sp_info{ width:420px}
    .tb_head .price{ width:100px}
    .tb_head .shuliang{ width:100px}
    .tb_head .pn{ width:150px;}
    .tb_head .s_fukuan{ width:100px}
    .tb_head .caozuo{ width:150px}
    .sp_plcl a{ padding:0px 5px}
    .sp_plcl{ border:1px solid #ccc; display:inline-block; height:20px; line-height:20px;}
    .mbx4{ background:#eff4fa;}
    .mbx4 span{  color:#666}
    span.zwq_color{ color:#fb540e}
    .sp_div{border-bottom:1px solid #ebebeb;border-top:1px solid #ebebeb;margin-bottom:10px}
    .splb_order{ width:757px}
    .splb_order li{height:100px; border-right:1px solid #ebebeb;padding-bottom:5px}
    div.div_info{ text-align:left;width:300px}
    .div_img{width:90px}
    .div_img img{width:85px}
    .splb_order .price,.splb_order .shuliang,.splb_order .s_fukuan{ line-height:100px}
    .splb_order .price{width:105px}
    .pricett{margin-top:32px;width:105px}
    .ck_price{text-decoration:line-through;font-weight:400}
    .pro_price{margin-top:5px;color:#fb540e}
    li.last{ border-bottom:none}
    .zkss{display:inline-block; width:100px; height:26px; cursor:pointer}
    .zkss2{display:inline-block; width:100px; height:26px; cursor:pointer}
    .zkss{background: url(<?php echo F::themeUrl() ?>/images/images/sszh.png) no-repeat 0px -26px;}
    .zkss2{background: url(<?php echo F::themeUrl() ?>/images/images/sszh.png) no-repeat 0px 0px;;}
    .color_blue {color: blue;}
    .bor_back{border:2px solid #c5d2e2}
    .cancelbtn{height:30px;width:60px;cursor:pointer;line-height:24px}
    .select {width:157px}
    .pn_input{height:20px;width:120px;text-align:center;color:#aaa;margin:40px 0 5px 0}
    .goods_name a{font-size:14px;font-weight:bold}
    .goods_name{height: 20px;line-height: 20px;overflow: hidden;width: 298px;}
    .goods_attr{height: 17px;line-height: 17px;overflow: hidden;width: 298px;}
    .goods_side{display:block;float:left}
    .goods_num{max-width:120px;display:block;float:left;cursor:pointer}
    .cut{white-space: nowrap;overflow: hidden; text-overflow: ellipsis}

    .goods_show1{text-align:center;width:100px;vertical-align:middle; height:100%}
    .m_top20{ margin-top:20px}
    .mjxx li {
        width: 30%;
        float: left;
        text-align: left;
        line-height: 30px;
        margin-left: 20px;
        white-space: nowrap;
    }
</style>

<?php
$this->breadcrumbs = array(
    '销售管理' => Yii::app()->createUrl('common/saleslist'),
    '订单发货'
        )
?>
<div class="bor_back m-top">
    <div class="txxx txxx2">
        第一步&nbsp;&nbsp;确认订单信息
    </div>
    <?php
    $buyer = PapOrder::model()->findByPk($ID[0], array('select' => 'BuyerID,BuyerName'))->attributes;
    $addr = SellerorderService::getSellerOrgan($buyer['BuyerID']);
    ?>
    <ul class="mjxx m-top" style="height:40px">
        <li>机构名称：<span><?php echo $addr['OrganName'] ? $addr['OrganName'] : $buyer['BuyerName'] ?></span></li>
        <li>联系电话：<span><?php echo $addr['phone'] ?></span></li>
        <li>城市：<span><?php echo $addr['citys'] ?></span></li>
    </ul>

    <div class="mbx mbx3 m-top">
        <ul class="tb_head">
            <li class="sp_info">商品信息</li>
            <li class="price">单价（元）</li>
            <li class="shuliang">数量</li>
            <li class="pn">PN号</li>
            <li class="s_fukuan">实付款（元）</li>
        </ul>
    </div>
    <?php
    $this->widget('widgets.default.WListView', array(
        'dataProvider' => $data,
        //'headerView' => 'goodshead',
        'itemView' => 'sendorderlist',
        'id' => 'orderlistview'
    ));
    ?>

</div>
<div class="bor_back m-top">
    <div class="txxx txxx2">
        第二步&nbsp;&nbsp;确认收货地址
    </div>
    <div class="order m-top">
        <div class="txxx_info2a">
            <span style="margin-left:24px">买家收货信息：<?php echo $address ?></span>
        </div>
    </div>
</div>
<div class="bor_back m-top">
    <div class="txxx txxx2">
        第三步&nbsp;&nbsp;选择物流服务
    </div>
    <div class="order m-top">
        <div class="txxx_info2a">
            <p><label class=" m_left24"><span style="color:red">*</span>物流公司名称：</label>
                <select class="select select2" id="ShipLogis">
                    <option value ="">手动输入物流公司</option>
                    <?php
                    $display = '';
                    foreach ($logCompany as $v):
                        ?>
                        <option value ="<?php echo $v['LogisticsCompany'] ?>" <?php
                        if ($v['LogisticsCompany'] == $ShipLogis) {
                            echo 'selected';
                            $display = 'display:none';
                        }
                        ?>>
                                    <?php echo $v['LogisticsCompany'] ?>
                        </option>
                    <?php endforeach; ?>
                </select>
                <input type="hidden" value="<?php //echo $ShipLogis ?>" name="ShipLogisH">
                <span style="<?php echo $display ?>">
                    <input type="text" class=" input input3 width150" name="ShipLogis" maxlength="20">
                    <span style="color:green">（提示：不超过20个字）</span>
                </span>
            </p>
            <p class="m-top"><label style="margin-left:48px">运单号码：</label>
                <input type="text" class=" input input3 width150" name="ShipSn" maxlength="10">
                <span style="color:green">（提示：不超过10个字）</span>
            </p>
        </div>
    </div>
</div>
<div class="m-top" style="padding-left:300px">
    <input type="submit"  class="submit m_left f_weight"  value="<?php echo count($ID) > 1 ? '合并' : '' ?>发货" onclick="send()" 
           id="<?php echo implode(',', $ID); ?>">
    <input type="button"  class="cancelbtn m_left f_weight"  value="取消">
</div>
<!--content2结束-->
<!--content1即又半部分结束-->
<script>
    /*商品管理页搜索条件展开收起*/
    $(document).ready(function() {

        $('#ShipLogis').change(function() {
            if ($(this).val() != '') {
                $('input[name=ShipLogisH]').val($(this).val());
                $('input[name=ShipLogis]').parents('span').hide();
            }
            else {
                $('input[name=ShipLogisH]').val('');
                $('input[name=ShipLogis]').parents('span').show();
            }
        })

        //取消
        $('.cancelbtn').click(function() {
            if (confirm('您确定要取消发货吗？')) {
                window.history.go(-1);
                //  if(!window.history.go(-1))
                //   window.location.href=Yii_baseUrl+'/pap/sellerorder/index';
            }
        })
    })

    //PN码的函数
    var pnerror = new Array;
    function delstr(obj) {
        if (obj.value == '按逗号分隔') {
            $(obj).next('.pn_span').html('');
            obj.value = '';
        }
    }
    function pnblur(id, obj) {
        if ($.trim(obj.value) == '') {
            obj.value = '按逗号分隔';
            pnerror.splice(id, 1);
            $(obj).next('.pn_span').html('');
        }
    }
    function pnkeyup(id, num, obj) {
        if ($.trim(obj.value) == '') {
            pnerror.splice(id, 1);
            $(obj).next('.pn_span').html('');
            return true;
        }
        var val = $.trim(obj.value);
        var Regx = /^[A-Za-z0-9][A-Za-z0-9,，-]*$/;
        if (Regx.test(val)) {
            val.replace('，', ',');
            var arr = val.split(',');
            if (arr[arr.length - 1] == '') {
                num += 1;
            }
            if (arr.length > num) {
                pnerror[id] = 2;
                $(obj).next('.pn_span').html('PN号个数不正确');
                return false;
            } else {
                //                for(var i in arr){
                //                    if(arr[i].length>10){
                //                        pnerror[id]=3;
                //                        $(obj).next('.pn_span').html('PN号太长，请控制在10位以内!');
                //                        return true;
                //                    }
                //                }
                pnerror.splice(id, 1);
                $(obj).next('.pn_span').html('');
                return true;
            }
        } else if (val) {
            pnerror[id] = 1;
            $(obj).next('.pn_span').html('PN号格式不正确');
            return false;
        }
    }

    //发货
    function send() {
        var id = $('.submit').attr('id');
        if (id == undefined || id == '') {
            return false;
        }
        for (var i in pnerror) {
            if (pnerror[i]) {
                alert("请先改正错误的PN号！");
                return false;
            }
        }
        if ($('input[name=ShipLogis]').is(':visible')) {
            $('input[name=ShipLogisH]').val($('input[name=ShipLogis]').val());
        }
        var ShipLogis = $.trim($('input[name=ShipLogisH]').val());
        var ShipSn = $.trim($('input[name=ShipSn]').val());
        if (ShipLogis == '' || ShipLogis.length > 20) {
            //alert('请选择正确的物流公司！');
            $('input[name=ShipLogis]').focus();
            return false;
        }
        if (ShipSn.length > 10) {
            //alert('运单号码不超过10个字');
            $('input[name=ShipSn]').focus();
            return false;
        }
        var goodsid = [];
        var pnStr = '';
        $("input[name='PN[]']").each(function() {
            if ($(this).val() && $(this).val() != '按逗号分隔') {
                goodsid.push($(this).parents('div.pn').find("input[name='goods_id[]']").val());
                pnStr += $(this).val() + '|';
            }
        })
        $.post(Yii_baseUrl + "/pap/sellerorder/sendorder",
                {id: id, goodsid: goodsid.join(','), PN: pnStr.substring(0, pnStr.length - 1), ShipSn: ShipSn, ShipLogis: ShipLogis},
        function(result) {
            if (result.success) {
                //给修理厂发送消息
                //var news = {type: 2, identity: 3, sendstr: result.userid};
                //socket.emit("businessnews", news);
                alert('发货成功！');
                // if(!window.history.go(-1))
                window.location.href = Yii_baseUrl + '/pap/sellerorder/index/Status/3/type/3';
            }
            else {
                alert(result.msg);
                location.reload();
            }
        }, 'json');
    }
</script>