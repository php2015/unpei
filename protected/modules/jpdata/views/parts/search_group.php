<style>
    .right-box{width: 160px; border: 1px solid #e1e1e1;float: right; overflow: auto;background: #fff;position: absolute;top:289px;left:586px}
    .rbox-img{ border-bottom: 1px solid #e1e1e1; }
    .right-box dd{height: 18px; line-height: 18px}
    .rbox-img dl{margin: 5px 0 3px 9px}
    .search-content{overflow:hidden;}
    .search-content li { float: left;}
</style>

<div class="auto_height">
    <ul class="search-content">
        <li>
            <label>厂家：</label>
            <select id="vehicle-make-list">
                <option value="">--请选择厂家类别</option>
            </select>
        </li>
        <li>
            <label>车系：</label>
            <select id="vehicle-series-list">
                <option value="">--请选择车系名称</option>
            </select>
        </li>
        <li>
            <label>年款：</label>
            <select id="vehicle-year-list">
                <option value="">--请选择车型年款</option>
            </select>
        </li>
        <li>
            <label>车型：</label>
            <select id="vehicle-model-list">
                <option value="">--请选择车型名称</option>
            </select>
        </li>
        <li>
            <label>主组：</label>
            <select id="vehicle-maingroup">
                <option value="">--请选择主组</option>
            </select>
        </li>
        <li>
            <label>子组：</label>
            <select id="vehicle-group">
                <option value="">--请选择子组</option>
            </select>
        </li>
        <div  style="clear:both;"></div>

    </ul>
    <p align="center" style="clear:both; margin-top:5px"><input class="submit" type="submit" value="查&nbsp;&nbsp;询" id="mm-vehicle-search"></p>
    <p style="margin-bottom:5px;">&nbsp;&nbsp;&nbsp;&nbsp;<a class="font-green" href="javascript:void(0)" onclick='newmodel()'>新增车型</a></p>

    <div class="search-result auto_height" style="min-height: 690px;">
        <div class="result-title auto_height" style="position：relative">
            <span class="title ">配件信息</span>
            <?php if (Yii::app()->user->Identity == "servicer"): ?>
                <span class="title" style="float:right; padding-right: 137px; padding-left: 10px; border-left:1px solid #fff" >商品信息</span>
            <?php endif; ?>
            <span class="info-back" style="cursor: pointer; float: right; color:#fff;*margin-top:-33px">返回</span>
        </div>

        <!-- 配件信息 -->
        <?php if (Yii::app()->user->Identity == "servicer"): ?>
            <div class="result-content auto_height" style=" width: 660px; float: left;margin:10px "></div>
        <?php elseif (Yii::app()->user->Identity == "dealer"): ?>
            <div class="result-content auto_height" style=" width: 860px; float: left;margin:10px "></div>
        <?php endif; ?>
        <div style="clear:both"></div>

    </div>
</div>
<div style="display:none">
<?php
$model = new EpcModelTemp('create');
$this->beginWidget('zii.widgets.jui.CJuiDialog', array(
    'id' => 'mydialog',
    // additional javascript options for the dialog plugin
    'options' => array(
        'title' => '新增车型',
        'autoOpen' => false,
        'width' => '800px',
        'padding' => '10px 20px',
        'closed' => "true",
        'modal' => true,
        'buttons' => array(
            '创建' => 'js:function(){ savePart("epc-model-temp-form");}', //关闭按钮 
            '关闭' => 'js:function(){ $(this).dialog("close");}', //关闭按钮 
        ),
    ),
));

$this->renderPartial('application.modules.jpdata.views.epcModelTemp._form', array('model' => $model));


$this->endWidget('zii.widgets.jui.CJuiDialog');

// the link that may open the dialog
echo CHtml::link('', '#', array(
    'onclick' => '$("#mydialog").dialog("open"); return false;',
));
?>

<?php
$model = new EpcGroupTemp('create');
$this->beginWidget('zii.widgets.jui.CJuiDialog', array(
    'id' => 'mydialogs',
    // additional javascript options for the dialog plugin
    'options' => array(
        'title' => '新增配件组',
        'autoOpen' => false,
        'width' => '800px',
        'modal' => true,
        'buttons' => array(
            '创建' => 'js:function(){ savePart("epc-group-temp-form");}', //关闭按钮 
            '关闭' => 'js:function(){ $(this).dialog("close");}', //关闭按钮 
        ),
    ),
));

$this->renderPartial('application.modules.jpdata.views.epcGroupTemp._form', array('model' => $model));


$this->endWidget('zii.widgets.jui.CJuiDialog');

// the link that may open the dialog
echo CHtml::link('', '#', array(
));
?>
<?php
$model = new EpcPartTemp('create');
$this->beginWidget('zii.widgets.jui.CJuiDialog', array(
    'id' => 'mydialogss',
    // additional javascript options for the dialog plugin
    'options' => array(
        'title' => '新增配件',
        'autoOpen' => false,
        'width' => '800px',
        'modal' => true,
        'buttons' => array(
            '创建' => 'js:function(){ savePart("EpcPartTemp");}', //关闭按钮 
            '关闭' => 'js:function(){ $(this).dialog("close");}', //关闭按钮 
        ),
    ),
));

$this->renderPartial('application.modules.jpdata.views.epcPartTemp._form', array('model' => $model));


$this->endWidget('zii.widgets.jui.CJuiDialog');

// the link that may open the dialog
echo CHtml::link('', '#', array(
));
?>
</div>