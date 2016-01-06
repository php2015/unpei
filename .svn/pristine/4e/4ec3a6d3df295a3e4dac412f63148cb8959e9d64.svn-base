<style>
    .errorMessage {float:left; margin-left:360px; color:red; margin-top:-30px;}
</style>
<?php
if ($model->id) {
    $this->pageTitle = Yii::app()->name . ' - ' . "修改授权经销商";
} else {
    $this->pageTitle = Yii::app()->name . ' - ' . "添加授权经销商";
}
?>
<div class='tabs' pre='tab'>
    <a class='left-indent'>&nbsp;</a>
    <?php echo CHtml::link('授权经销商列表', Yii::app()->createUrl('maker/makemarketing/empowerdealer')); ?>
    <?php if ($model->id): ?>
        <?php echo CHtml::link('修改授权经销商', Yii::app()->createUrl('maker/makemarketing/addempdea', array('id' => $_GET['id'])), array('class' => 'active')); ?>
    <?php else: ?>
        <?php echo CHtml::link('添加授权经销商', Yii::app()->createUrl('maker/makemarketing/addempdea'), array('class' => 'active')); ?>
    <?php endif; ?>
    <?php //echo CHtml::link('批量导入', Yii::app()->createUrl('maker/makeregister/batchimport/act/emp'));?>
</div>
<div class='tab-content'>
    <div class='title title-dashed'>机构信息</div>
    <?php
    $form = $this->beginWidget('CActiveForm', array(
        'id' => 'make-form',
        'enableAjaxValidation' => true,
        'enableClientValidation' => true,
        'clientOptions' => array('validateOnSubmit' => true),
        'htmlOptions' => array(
            'enctype' => 'multipart/form-data',
        ),
            ));
    ?>
    <div class='form-list'>
        <p class="form-row">
            <?php echo $form->labelEx($model, '机构名称：', array('class' => 'label')); ?>
            <?php if ($model->id): ?>
                <?php echo $form->textField($model, 'organName', array('class' => 'width213 input', 'readonly' => true)); ?>
            <?php else : ?>
                <?php echo $form->textField($model, 'organName', array('class' => 'width213 input')); ?>
            <?php endif; ?>
            <?php if (!$model->id): ?>
                <?php echo CHtml::button('选择', array('class' => 'btn-small', 'id' => 'choose')); ?>
            <?php endif; ?>
            <span class=organNameerror style='color:red'></span>
        </p>
        <p class="form-row">
            <?php echo $form->labelEx($model, '经营级别：', array('class' => 'label')); ?>
            <?php echo $form->dropDownList($model, 'grade', CHtml::listData($level, 'level', 'level'), array('class' => 'width118 select', 'empty' => '选择级别')); ?>
            <?php echo $form->error($model, 'grade', array('style' => 'color: red;')); ?>
        </p>
        <p class="form-row">
            <?php echo $form->labelEx($model, '授权品类：', array('class' => 'label')); ?>
            <?php $cate_data = MakeEmpowerCategory::model()->findAll("userID=:userID", array(":userID" => Commonmodel::getOrganID()));
            $categray = CHtml::listData($cate_data, "id", "cateName");
            ?>
            <?php echo $form->dropDownList($model, 'category', $categray, array('class' => 'width118 select', 'empty' => '选择品类')); ?>
<?php echo $form->error($model, 'category', array('style' => 'color: red;')); ?>
        </p>
        <p class="form-row">
            <?php echo $form->labelEx($model, '授权品牌：', array('class' => 'label')); ?>
            <?php
            echo $form->dropDownList($model, 'brand', array(
                'A' => 'A',
                'B' => 'B',
                'C' => 'C',
                    ), array('class' => 'width118 select', 'empty' => '选择级别'));
            ?>
            <?php echo $form->error($model, 'brand', array('style' => 'color: red;')); ?>
        </p>
            <?php if (!$model->id): ?>
            <p class="form-row">
            <?php echo CHtml::label('联系电话：', '', array('class' => 'label')); ?>
            <?php echo CHtml::textField('telephone', '', array('class' => 'width213 input')); ?>
                <span style='color: red;' id="telerror"></span>
            </p>
            <?php endif; ?>
        <p class="form-row">
            <?php echo $form->labelEx($model, '结算方式：', array('class' => 'label')); ?>
            <?php echo $form->radioButtonList($model, 'accountMethods', array('月结' => '月结', '担保交易' => '担保交易'), array('separator' => '&nbsp&nbsp')); ?>
        </p>
        <p class="form-row">
<?php if ($model->id): ?>
    <?php echo $form->hiddenField($model, 'id'); ?>
<?php endif; ?>
            <label class='label'></label>
            <input class='submit' type='button' id='save' value='保存'/>
        </p>
    </div>
<?php $this->endWidget(); ?>
</div>
<?php
$this->beginWidget('zii.widgets.jui.CJuiDialog', array(
    'id' => 'mydialog',
    'options' => array(
        'title' => Yii::t('query', '选择经销商'),
        'autoOpen' => false,
        'modal' => 'true',
        'width' => '620px',
        'height' => 'auto'
    ),
));
?>
<div class="checkbox-list">
    <div style="width:600px;height:300px;overflow-y:scroll">
        <table cellspacing="0" cellpadding="0" width="400px">
<?php if (!empty($dealers)): ?>
                <thead>
                    <tr>
                        <td width="15">#</td>
                        <td width="100">机构名称</td>
                        <td width="100">联系方式</td>
                        <td width="180">机构地址</td>
                        <td width="40">操作</td>
                    </tr>
                </thead>
                <tbody>
    <?php $i = 1; ?>
    <?php foreach ($dealers as $dealer): ?>
                        <tr class='bg-green-light'>	
                            <td><?php echo $i; ?></td>
                            <td name='organName'><?php echo $dealer->organName; ?></td>
                            <td name='Phone'><?php echo $dealer->Phone; ?></td>
                            <td><?php Area::showCity($dealer->province) . Area::showCity($dealer->city) . Area::showCity($dealer->area); ?></td>
                            <td><?php echo CHtml::button('选择', array('class' => 'btn-small', 'id' => 'opt')); ?></td>
                        </tr>
        <?php $i++; ?>
                <?php endforeach; ?>
                </tbody>
<?php else : ?>
                <tr><td colspan="5" align="center">
                        <p>搜索到&nbsp;<font color=red>0</font>&nbsp;条数据 &nbsp;&nbsp;<span style="text-decoration: underline"><?php //echo CHtml::link('重新加载',array('makemarketing/addempdea')) ?></span></p>
                    </td></tr>
<?php endif; ?>
        </table>
    </div>
</div>
<?php
$this->endWidget('zii.widgets.jui.CJuiDialog');
?>
<script type="text/javascript">
    $(document).ready(function(){
        $("#choose").click(function(){
            $("#mydialog").dialog("open");
        });
        $("#opt").live('click',function(){
            var organName=$(this).parents('tr').find('td[name=organName]').html();
            var Phone=$(this).parents('tr').find('td[name=Phone]').html();
            $("#MakeEmpowerDealer_organName").val(organName);
            $("#telephone").val(Phone);
            $("#mydialog").dialog("close");
        });
        $("#save").click(function(){
            var organName=$('#MakeEmpowerDealer_organName').val();
            if(organName){
                if($("#telephone").length>0){
                    var telephone=$('#telephone').val();
                    if(telephone){
                        var par=/^1[3|4|5|8][0-9]\d{4,8}$/;
                        if(par.test($('#telephone').val())){
                            $.getJSON("<?php echo Yii::app()->createUrl('maker/makemarketing/checkorgan'); ?>",{telephone:telephone,organName:organName},function(result){
                                $("#telerror").html('');
                                $(".organNameerror").html("");
                                if(result==100){
                                    if(window.confirm("您确定要保存吗?"))
                                    {
//                                        $("#save").attr("disabled",true);
                                        $("#make-form").submit();
                                    }
                                }else{
                                    if(result==1){
                                        $("#telerror").html("此号码绑定的经销商与您填写的经销商名称不一致");
                                    }else if(result==2){
                                        $(".organNameerror").html("此机构绑定的手机号与您填写的不一致");
                                    }else{
                                        $(".organNameerror").html("此机构您已添加");
                                    }
                                }
                            })
                        }else{
                            $("#telerror").html("联系电话格式错误");
                        }
                    }else{
                        $("#telerror").html("联系电话 不可为空白.");
                    }
                }else{
                    if(window.confirm("您确定要保存吗?"))
                    {
                        $("#make-form").submit();
                    }
                }
            }else{
                $(".organNameerror").html("机构名称 不可为空白.");
            }
        });
        $("#telephone").focus(function(){
            $("#telerror").html("");
        });
        $("#MakeEmpowerDealer_organName").focus(function(){
            $(".organNameerror").html("");
        });
    })
</script>
<div style='height:60px'></div>
<div class='block-shadow'></div>