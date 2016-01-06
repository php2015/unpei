<style>
    .row label {
        display: inline-block;
        margin-right: 0;
        text-align: right;
        width: 110px !important;
    }
</style>
<?php
$this->breadcrumbs = array(
    '营销管理' => Yii::app()->createUrl('common/marketlist'),
    '营销参数设置' => Yii::app()->createUrl('pap/discountset/turnover'),
    '修改订单最小金额',
);
?>

<!--内容部分-->
<div class="bor_back m_top10">
    <p class="txxx">修改订单最小金额</p>
    <div class="txxx_info">
        <div class='form'>
            <?php
            $form = $this->beginWidget('CActiveForm', array(
                'id' => 'financial-form',
                'enableAjaxValidation' => true,
                'enableClientValidation' => true,
                    // 'clientOptions' => array('validateOnSubmit' => true)
                    ));
            ?>
            <div class='row'>
                <?php echo $form->labelEx($model, '订单最小金额(元)：', array('class' => 'label')); ?>
                <?php
                echo $form->textField($model, 'MinTurnover', array(
                    'onblur' => 'this.v()',
                    'onkeyup' => "(this.v=function(){this.value=this.value.replace(/[^0-9.]+/,'');}).call(this)",
                    'id' => 'text', 'class' => 'width213 input'));
                ?>
                <?php echo $form->error($model, 'MinTurnover', array('style' => 'color: red;')); ?>
                
            </div>
            <div class='row' style="padding-left:200px;">
                <?php if ($model->ID): ?>
                    <?php echo $form->hiddenField($model, 'ID'); ?>
                <?php endif; ?>
                <input class='submit' type='button' id="save" value='保存'/>
                <input class='submit' type='button' id="nosave" value='返回'/>
            </div>
        </div>
    </div>
    <?php $this->endWidget(); ?>
</div>

<?php
$this->beginWidget('zii.widgets.jui.CJuiDialog', array(
    'id' => 'reminddg', //弹窗ID  
    'options' => array(//传递给JUI插件的参数  
        'title' => '操作提示',
        'autoOpen' => false, //是否自动打开  
        'width' => '200', //宽度  
        'height' => '100', //高度  
    ),
));

$this->endWidget('zii.widgets.jui.CJuiDialog');
?>
<!--内容部分结束-->

<script type="text/javascript">
    $(document).ready(function(){
        
        
        
        $("#save").click(function(){
            var text =$('input[id=text]').val();
            if(isNaN(text)){
                alert('请填写有效数值');
                return false; 
            }
            var str=text;
            var pattern = /^\d{0,7}(\.\d{0,2})?$/g
            if(!pattern.test(str)){
                alert("请输入数字(例:0.00),最高保留两位小数");
                text.focus();
                return false;
            }
            $("#financial-form").submit();
            $("#reminddg").html('<span style="color:blue">修改成功</span>');
            $("#reminddg").dialog("open");
            var url=Yii_baseUrl+'/pap/discountset/turnover';
            setTimeout("window.location.href='"+url+"'",3000); 
        });
            
        $('#nosave').click(function(){
            window.location.href=Yii_baseUrl+"/pap/discountset/turnover";
        })
    })
</script>

