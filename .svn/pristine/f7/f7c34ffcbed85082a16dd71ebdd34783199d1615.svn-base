<!-- 商城订单折扣率设置 -->
<?php echo $this->renderPartial('tabs'); ?>
<div id="mallorder_show" style="padding:30px; display:<?php echo $display ?>">
    <div class="fitem" style="height:30px;">
        <span>支付宝担保折扣率：</span>
        <span style="color: red;"><?php
if ($model['OrderAlipay']): echo $model['OrderAlipay'];
else: echo "未设置";
endif;
?></span>
    </div>
    <div class="fitem" style="height:30px;">
        <span>物流代收款折扣率：</span>
        <span style="color: red;"><?php
            if ($model['OrderLogis']): echo $model['OrderLogis'];
            else: echo "未设置";
            endif;
?></span>
    </div>
    <div class="fitem">
        <?php if (!$model): ?>
            <a class='btn' href="<?php echo Yii::app()->createUrl('cim/discountset/index/flag/set'); ?>" style="margin-left: 60px;">设置</a>
        <?php else: ?>
            <a class='btn' href="<?php echo Yii::app()->createUrl('cim/discountset/index/flag/set'); ?>" style="margin-left: 60px;">修改</a>
        <?php endif; ?>
    </div>
</div>
<div id="mallorder_set" style="padding:30px; display:<?php echo $display == 'none' ? 'block' : 'none'; ?>">
    <form id="mall_fm" method="post" action="<?php echo Yii::app()->createUrl("cim/discountset/mallorder");?>">
        <div class="fitem" style="height:30px;">
            <span>支付宝担保折扣率：</span>
            <span><input type="text" name="OrderAlipay" value="<?php
        if ($model['OrderAlipay']): echo $model['OrderAlipay'];
        else: echo "请输入百分比数值，如：100%";
        endif;
        ?>" class="easyui-validatebox input" required="ture" style=" width:198px"></span>
        </div>
        <div class="fitem" style="height:30px;">
            <span>物流代收款折扣率：</span>
            <span><input type="text" name="OrderLogis" value="<?php
                         if ($model['OrderLogis']): echo $model['OrderLogis'];
                         else: echo "请输入百分比数值，如：100%";
                         endif;
        ?>" class="easyui-validatebox input" required="ture" style=" width:198px"></span>
        </div>
        <div class="fitem" style="margin-top: 15px;">
            <span><input type="button" id="save" class="submit ml10" value="保存" style="margin-left: 70px;"></span>
            <span><a class='btn' href="<?php echo Yii::app()->createUrl('cim/discountset/index'); ?>">返回</a></span>
        </div>
    </form>
</div>
<script>
    $(document).ready(function(){
        //输入框提示信息
        $("input[name=OrderAlipay]").focus(function(){  if($(this).val() == "请输入百分比数值，如：100%") $(this).val('');});
        $("input[name=OrderLogis]").focus(function(){   if($(this).val() == "请输入百分比数值，如：100%") $(this).val('');});
         $("input[name=OrderAlipay]").blur(function(){  if($(this).val() == '') $(this).val("请输入百分比数值，如：100%").css("color","gray");});
        $("input[name=OrderLogis]").blur(function(){    if($(this).val() == '') $(this).val("请输入百分比数值，如：100%").css("color","gray");});
        //保存
        $("#save").click(function(){
            if(window.confirm("您确定要保存吗?")){ 
                var OrderAlipay = $("input[name=OrderAlipay]").val();
                var OrderLogis = $("input[name=OrderLogis]").val();
                if(OrderAlipay == "请输入百分比数值，如：100%" || OrderLogis == "请输入百分比数值，如：100%"){
                    $.messager.alert("提示","折扣率不能为一个空数值！","warning");
                    return false;
                }
                if(OrderAlipay && OrderLogis){
                    var firstAlipay = OrderAlipay.substring(0,OrderAlipay.length-1);
                    var lastAlipay = OrderAlipay.substring(OrderAlipay.length-1);
                    var firstLogis = OrderLogis.substring(0,OrderLogis.length-1);
                    var lastLogis = OrderLogis.substring(OrderLogis.length-1);
                    if((isNaN(firstAlipay) || lastAlipay != '%') || (isNaN(firstLogis) || lastLogis != '%')){
                        $.messager.alert("提示","格式错误，请输入一个百分比数值！","warning");
                    }
                    else if((firstAlipay > 100 || firstAlipay < 0) || (firstLogis > 100 || firstLogis < 0)){
                        $.messager.alert("提示","折扣率为一个小于等于100大于等于0的数字！","warning");
                    }
                    else{
                        $.post(Yii_baseUrl + "/cim/discountset/mallorder",{OrderAlipay:OrderAlipay,OrderLogis:OrderLogis},function(result){
                            if(result.errorMsg){
                                $.messager.alert("提示",result.errorMsg,"warning");
                            }
                            else{
                                window.location.href = Yii_baseUrl + "/cim/discountset/index";
                            }
                        });
                    }
                }
            }
        });
    });
</script>