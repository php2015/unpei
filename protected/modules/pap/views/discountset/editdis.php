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
    '营销参数设置' => Yii::app()->createUrl('pap/discountset/index'),
    '合作类型价格比设置',
);
?>

<!--内容部分-->
<div class="bor_back m_top10">
    <p class="txxx">修改合作类型价格比</p>
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
                <?php echo $form->labelEx($model, '合作类型：', array('class' => 'label')); ?>
                <span style="">&nbsp;<?php echo $form->labelEx($model, $cooperationType, array('class' => 'label')); ?></span>
                <?php //echo $form->textField($model, 'CooperationType', array('class' => 'width213 input')); ?>
                <?php //echo $form->error($model, 'CooperationType', array('style' => 'color: red;')); ?>
            </div>

            <?php if ($model['CooperationType'] == "C"): ?>
                <div class='row'>
                    <?php echo $form->labelEx($model, '价格比：', array('class' => 'label')); ?>
                    <?php echo $form->textField($model, 'PriceRatio', array('class' => 'width213 input', 'id' => 'text', 'readonly' => 'ture')); ?>
                    <?php echo $form->error($model, 'PriceRatio', array('style' => 'color: red;')); ?>
                    <span>(普通客户价格比不可修改)</span>
                </div>

            <?php else: ?>
                <div class='row'>
                    <?php echo $form->labelEx($model, '价格比：', array('class' => 'label')); ?>
                    <?php if ($model['CooperationType'] == "A"): ?>
                        <?php
                        echo $form->textField($model, 'PriceRatio', array(
                            'onblur' => 'this.v()',
                            'onkeyup' => "(this.v=function(){this.value=this.value.replace(/[^0-9.]+/,'');}).call(this)",
                            'class' => 'width213 input',
                            'id' => 'text_a',
                        ));
                        ?>
                    <?php elseif ($model['CooperationType'] == "B"): ?>
                        <?php
                        echo $form->textField($model, 'PriceRatio', array(
                            'onblur' => 'this.v()',
                            'onkeyup' => "(this.v=function(){this.value=this.value.replace(/[^0-9.]+/,'');}).call(this)",
                            'class' => 'width213 input',
                            'id' => 'text_b'));
                        ?>
                    <?php endif ?>
                </div>

            <?php endif; ?>

            <div class='row' style="padding-left:200px;">
                <?php if ($model->ID): ?>
                    <?php echo $form->hiddenField($model, 'ID'); ?>
                <?php endif; ?>
                <?php if ($model['CooperationType'] == "C"): ?>
                    <input class='submit' type='button' id="nosave" value='返回'/>
                <?php else: ?>
                    <input class='submit' type='button' id="save" value='保存'/>
                    <input class='submit' type='button' id="nosave" value='返回'/>
                <?php endif; ?>
                <input type="hidden" id="aid" value="<?php echo $aa['PriceRatio'] ?>">
                <input type="hidden" id="bid" value="<?php echo $bb['PriceRatio'] ?>">
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
        var aaa=parseFloat($('input[id=aid]').val());  //数据库的值
        var bbb=parseFloat($('input[id=bid]').val());
        if($('#text_a').length>0){
            $('#text_a').focus();
        }else{
            $('#text_b').focus();
        }
        $('#text_a').blur(function(){
            var i=$(this).val();
            if(i>=bbb){
                alert('设置有误(A类应该比B类小)');
                return false;
            }else if(i>=100){
                alert('设置有误(填写1-100有效数值)');
                return false;
            }
            $("#save").click(function(){
                $("#financial-form").submit();
                $("#reminddg").html('<span style="color:blue">修改成功</span>');
                $("#reminddg").dialog("open");
                var url=Yii_baseUrl+'/pap/discountset/editdis';
                setTimeout("window.location.href='"+url+"'",3000); 
            });
        }); 
        
        $('#text_b').blur(function(){
            var j=$(this).val();
            if(j<=aaa){
                alert('设置有误(B类应该比A类大)');
                return false;
            }else if(j>=100){
                alert('设置有误(填写1-100有效数值)');
                return false;
            }
            $("#save").click(function(){
                $("#financial-form").submit();
                $("#reminddg").html('<span style="color:blue">修改成功</span>');
                $("#reminddg").dialog("open");
                var url=Yii_baseUrl+'/pap/discountset/editdis';
                setTimeout("window.location.href='"+url+"'",3000); 
            });
        }); 

        $('#nosave').click(function(){
            window.location.href=Yii_baseUrl+"/pap/discountset/index";
        })
    })
</script>


