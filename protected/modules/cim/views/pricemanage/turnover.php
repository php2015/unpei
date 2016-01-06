<div>
    <div class="tabs" pre="tab">
        <a class="left-indent">&nbsp;</a>
        <a href="<?php echo Yii::app()->createUrl("cim/pricemanage/index"); ?>">价格管理列表</a>
        <a href="<?php echo Yii::app()->createUrl("cim/pricemanage/turnover"); ?>" class="active">订单最小交易额</a>
    </div>
    <div id="turnover_show" style="padding:30px; display:<?php echo $display ?>">
        <div class="fitem" style="height:30px;">
            <span>订单最小交易额（元）：</span>
            <span style="color: red;"><?php if($model['MinTurnover']): echo "￥" . $model['MinTurnover']; else: echo "未设置"; endif; ?></span>
        </div>
        <div class="fitem">
            <?php if(!$model['MinTurnover']):?>
            <a class='btn' href="<?php echo Yii::app()->createUrl('cim/pricemanage/turnover/flag/set'); ?>" style="margin-left: 60px;">设置</a>
            <?php else: ?>
            <a class='btn' href="<?php echo Yii::app()->createUrl('cim/pricemanage/turnover/flag/set'); ?>" style="margin-left: 60px;">修改</a>
            <?php endif;?>
        </div>
    </div>
    <div id="turnover_set" style="padding:30px; display:<?php echo $display == 'none' ? 'block' : 'none'; ?>">
        <form id="turnover_fm" method="post" action="<?php echo Yii::app()->createUrl("cim/pricemanage/setturnover"); ?>">
            <div class="fitem" style="height:30px;">
                <span>订单最小交易额（元）：</span>
                <span>￥<input type="text" name="MinTurnover" value="<?php if($model['MinTurnover']): echo $model['MinTurnover']; endif;?>" class="easyui-validatebox input" required="ture"></span>
            </div>
            <div class="fitem" style="margin-top: 15px;">
                <span><input type="button" id="save" class="submit ml10" value="保存" style="margin-left: 70px;"></span>
                <span><a class='btn' href="<?php echo Yii::app()->createUrl('cim/pricemanage/turnover'); ?>">返回</a></span>
            </div>
        </form>
    </div>
</div>
<script>
    $(document).ready(function(){
        $("#save").click(function(){
            if(window.confirm("您确定要保存吗?")){
                 var MinTurnover = $("input[name=MinTurnover]").val();
                 if(isNaN(MinTurnover)){
                     $.messager.alert("提示","格式错误！请输入数字值！","warning");
                 }
                 else{
                     $.post(Yii_baseUrl + "/cim/pricemanage/setturnover",{MinTurnover:MinTurnover},function(result){
                         if(result.errorMsg){
                             $.messager.alert("提示",result.errorMsg,"warning");
                         }
                         else{
                             window.location.href = Yii_baseUrl + "/cim/pricemanage/turnover";
                         }
                     });
                 }
            }
        });
    });
</script>