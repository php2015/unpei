	<?php
	$this->pageTitle = Yii::app()->name . ' - ' . "商品模板添加";
?>
	<div pre="tab" class="tabs">
        <a class="left-indent">&nbsp;</a>
        <a  href="<?php echo Yii::app()->createUrl('maker/templatemanage/index')?>">嘉配模板库</a>
        <a href="<?php echo Yii::app()->createUrl('maker/templatemanage/add') ?>" class="active">新建模板</a>
    </div>
	<div>
    <?php if (Yii::app()->user->hasFlash('success')): ?>  
        <div class="successmessage" id='message'>
            <?php echo Yii::app()->user->getFlash('success'); ?>  
        </div>
    <?php endif ?>
    <?php if (Yii::app()->user->hasFlash('failed')): ?>  
        <div class="errormessage" id='message'>
            <?php echo Yii::app()->user->getFlash('failed'); ?>  
        </div>
    <?php endif ?>
    <?php
    $form = $this->beginWidget('CActiveForm', array(
        'id' => 'templateadd-form',
        //'enableAjaxValidation' => true,
        'enableClientValidation' => true,
        'clientOptions'=>array('validateOnSubmit'=>true),
        //'clientOptions' => Yii::app()->params['clientOptions'],
    ));
    ?>
    <div class="form form-list">
        <div class="row form-row">
            <label class="label">模板名称：</label>
            <?php echo $form->textField($model, 'name', array('class' => 'width113 input')) ?>
            <!-- <input type="text" class="width453 input" style="width: 453px;"> -->
<!--             <span class="color-red">*</span> -->
            <span class='label-inline'>配件品类</span>
  			 <?php echo $form->dropDownList($model, 'system_type',CHtml::listData($parts,'system_type','system_type'),
	                            array('class'=>'widht100 select','empty'=>'请选择系统',
								'ajax' => array(
	                            'type'=>'GET', //request type
								'url'=> Yii::app()->request->baseUrl.'/common/getcpnames',
                                //'url'=>Yii::app()->createUrl('maker/templatemanage/getcpnames'),
	                           //'url'=> Yii::app()->request->baseUrl.'/common/getcp_name', //url to call
	                            'update'=>'#GoodsTemplate_cpname', //selector to update
	                            'data'   => 'js:"system_type="+jQuery(this).val()',
	                            )
 								));
				?>
           <?php  
                $data = GoodsStandard::model()->findAll("system_type=:system_type", array(":system_type" =>$model->system_type));
                ?>
          <?php echo $form->dropDownList($model, 'cpname', CHtml::listData($data,'id','cp_name'),
	                            array(
	                            'class'=>'width115 select',
	                            'empty'=>'请选择品类',
	                            ));?>  
            <?php //echo $form->textField($model, 'cpname', array('class' => 'width115 input','readonly'=>"readonly")) ?>
<!--             <a class='font-green' href="javascript:;" id='show-jpmbk-win'>点击选择</a> -->
            <?php echo $form->error($model, 'name') ?>
              <?php echo $form->error($model, 'cpname') ?>
        </div>
  </div>
    <div class='input-list'>
        <table cellspacing=0 cellpadding=0>
            <thead>
                <tr>
                    <td width='300'>参数名</td>
                    <td></td>
                </tr>
            </thead>
            <tbody>
                <tr class="form form-list">
                    <td class="row form-row">
                    <label class="label">参数名1：</label>
                        <?php echo $form->textField($model, 'Column1', array('class' => 'width113 input')) ?>
                    </td>
                    <td>
  					<?php echo $form->error($model, 'Column1',array('style'=>'color:#B94A48;display:inline')) ?>
                    </td>
                </tr>
                <tr class="form form-list">
                    <td class="row form-row">
                    <label class="label">参数名2：</label>
                        <?php echo $form->textField($model, 'Column2', array('class' => 'width113 input')) ?>
                    </td>
                    <td>
                     <?php echo $form->error($model, 'Column2',array('style'=>'color:#B94A48')) ?> 
                    </td>
                </tr>
               <tr class="form form-list">
                    <td class="row form-row">
                    <label class="label">参数名3：</label>
                        <?php echo $form->textField($model, 'Column3', array('class' => 'width113 input')) ?>
                    </td>
                    <td>
                    <?php echo $form->error($model, 'Column3',array('style'=>'color:#B94A48')) ?>
                    </td>
                </tr>
                <tr class="form form-list">
                    <td class="row form-row">
                    <label class="label">参数名4：</label>
                        <?php echo $form->textField($model, 'Column4', array('class' => 'width113 input')) ?>
                    </td>
                    <td>
                      <?php echo $form->error($model, 'Column4',array('style'=>'color:#B94A48')) ?>
                    </td>
                </tr>
                <tr class="form form-list">
                    <td class="row form-row">
                    <label class="label">参数名5：</label>
                        <?php echo $form->textField($model, 'Column5', array('class' => 'width113 input')) ?>
                    </td>
                    <td>
                      <?php echo $form->error($model, 'Column5',array('style'=>'color:#B94A48')) ?>
                    </td>
                </tr>
            </tbody>
        </table>
    </div>
    <div class='tab-content' style="margin-left:100px">
        <input class='btn-green btn-green-large' type='submit' value='保存模板' id="submit">
    </div>
    <?php $this->endWidget(); ?>
</div>
<!-- 嘉配模板库弹窗 -->
<div id='jpmbk-win' class='width800 pos-a bg-white border-green display-n' style="  z-index: 1111; position: absolute; visibility: visible; top: 46px; left: 135px;">
    <div class='title bg-green'>
        <span class='float-r bg-green' id="choose">[确定]</span>
        请选择标准名称
    </div>
    <!-- 已选配件 -->
    <div class='checked p2em auto_height mt1em'>
        <div class='width80 float-l lh30'> <strong>已选配件：</strong>
        </div>
        <div class='width669 float-l'>
        </div>
    </div>
    <div id="tab-container" class='tab-container'  pre='ctable'>
        <ul class='etabs'>
            <li class='tab' class="active"><a href="#tabs1">基础信息</a></li>
            <li class='tab'><a href="#tabs2">规格参数</a></li>
            <li class='tab'><a href="#tabs3">销售信息</a></li>
        </ul>
        <div class='panel-container'>
            <div id="tabs1">
                <div id="jpmbkwin1" class='p2em'>
                    <!-- 常用配件 -->
                    <div class='checked auto_height mt1em'>
                        <div class='width80 float-l lh30'> <strong>常用配件：</strong>
                        </div>
                        <div class='width670 float-l'>
                            <?php foreach ($parts as $value): ?>
                                <a class="nowarp display-ib lh30" href='javascript:;' cpid="<?php echo $value['id'] ?>"><?php echo $value['cp_name'] ?></a>
                            <?php endforeach; ?>
                        </div>
                    </div>
                </div>
            </div>
            <div id="tabs2">
            </div>
            <div id="tabs3">
            </div>
        </div>
    </div>
    <div class='form-row divers-dashed'></div>
    <!-- 首字母查询 -->
    <div class='checked auto_height mt1em'>
        <div class='initial-list auto_height'>
            <div class='width80 float-l lh30'>
                <strong>首字母查询：</strong>
            </div>
            <div class='width670 float-l uppercase'>
                <a class="lh30 f14-b active" href='javascript:;'>a</a>
                <a class="lh30 f14-b" href='javascript:;'>b</a>
                <a class="lh30 f14-b" href='javascript:;'>c</a>
                <a class="lh30 f14-b" href='javascript:;'>d</a>
                <a class="lh30 f14-b" href='javascript:;'>e</a>
                <a class="lh30 f14-b" href='javascript:;'>f</a>
                <a class="lh30 f14-b" href='javascript:;'>g</a>
                <a class="lh30 f14-b" href='javascript:;'>h</a>
                <a class="lh30 f14-b" href='javascript:;'>i</a>
                <a class="lh30 f14-b" href='javascript:;'>j</a>
                <a class="lh30 f14-b" href='javascript:;'>k</a>
                <a class="lh30 f14-b" href='javascript:;'>l</a>
                <a class="lh30 f14-b" href='javascript:;'>m</a>
                <a class="lh30 f14-b" href='javascript:;'>n</a>
                <a class="lh30 f14-b" href='javascript:;'>o</a>
                <a class="lh30 f14-b" href='javascript:;'>p</a>
                <a class="lh30 f14-b" href='javascript:;'>q</a>
                <a class="lh30 f14-b" href='javascript:;'>r</a>
                <a class="lh30 f14-b" href='javascript:;'>s</a>
                <a class="lh30 f14-b" href='javascript:;'>t</a>
                <a class="lh30 f14-b" href='javascript:;'>u</a>
                <a class="lh30 f14-b" href='javascript:;'>v</a>
                <a class="lh30 f14-b" href='javascript:;'>w</a>
                <a class="lh30 f14-b" href='javascript:;'>x</a>
                <a class="lh30 f14-b" href='javascript:;'>y</a>
                <a class="lh30 f14-b" href='javascript:;'>z</a>
            </div>
        </div>
        <div class='initial-list-a auto_height mt1em'>
            <div class='width80 float-l lh30 text-c'>
                <strong class='uppercase'>a</strong>
            </div>
            <div class='width670 float-l'>
                <a class="nowarp display-ib lh30" href='javascript:;'>机油滤清器</a>
                <a class="nowarp display-ib lh30" href='javascript:;'>机油滤清器</a>
                <a class="nowarp display-ib lh30" href='javascript:;'>机油滤清器</a>
            </div>
        </div>
        <div class='initial-list-b auto_height mt1em'>
            <div class='width80 float-l lh30 text-c'>
                <strong class='uppercase'>b</strong>
            </div>
            <div class='width670 float-l'>
                <a class="nowarp display-ib lh30" href='javascript:;'>机油滤清器</a>
                <a class="nowarp display-ib lh30" href='javascript:;'>机油滤清器</a>
                <a class="nowarp display-ib lh30" href='javascript:;'>机油滤清器</a>
            </div>
        </div>
    </div>
</div>
<div id="jpmbkwin2" class='display-n p2em'>jpmbkwin2</div>
<div id="jpmbkwin3" class='display-n p2em'>jpmbkwin3</div>
<div style="height:50px"></div>
<?php
//这是一段,在显示后定里消失的JQ代码,已集成至Yii中.
Yii::app()->clientScript->registerScript(
        'myHideEffect', '$("#message").animate({opacity: 1.0}, 2000).fadeOut("slow");', CClientScript::POS_READY
);
?>
<script type="text/javascript">
//点击选择隐藏显示
   /* $('#show-jpmbk-win').click(function() {
        $('#jpmbk-win').toggle();
    });
//tab菜单切换
    $('#tab-container').easytabs({animate: false});
    $('#jpmbk-win .initial-list .uppercase a').click(function() {
        $(this).addClass('active').siblings().removeClass('active');
    });
//添加选择商品
    $('.width670').find('.nowarp').click(function() {
        var name = $(this).text();
        var nameval = $(this).attr('cpid');
        var html = "<span class='nowarp display-ib lh30'>\
                <input class='checkbox' type='checkbox' checked='checked'id='cid' name='"+nameval+"'>\
                <span class='checkbox-add'>" + name + "</span></span>";
        $('.width669').empty().append(html);
    });
    $(document).delegate('.width669 .nowarp .checkbox', 'change', function() {
        if (!$(this).prop('checked')) {
            $(this).closest('.nowarp').remove();
        }
    });
//勾选模板名称
    $('#jpmbk-win #choose').css({cursor: 'pointer'});
    $('#jpmbk-win #choose').click(function() {
         var cpid=$("#cid").attr('name');
        $('#jpmbk-win').hide();
        var checkbox = $('.width669').find('.checkbox').hide();
        checkbox.length > 0 && $('#templateadd-form .width115').val($('.width669').find('.checkbox-add').text()).after(checkbox);
      $('#cpnameID').val(cpid);
    });
    */

</script>