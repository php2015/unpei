<style>
    #checkcode{display:none;}
</style>
<?php
$this->pageTitle = Yii::app()->name . ' - 前市场车型查询';
?>
<?php
$this->breadcrumbs = array(
   '汽配数据'=>Yii::app()->createUrl('common/jplist'),
    '前市场车型查询'
);
?>
<div class="bor_back" style="margin-top:10px;height:auto;">
    <div id="tab-container" class="tabs tabs2" pre='tab'>
        <ul class="pjcx_ul">
            <li id="tab-parts-query"  style="margin-left: 20px;border-left:1px solid #e2e2e2">
                <a id="tab-head-group" href="#"  class="selected">前市场车型查询</a>
            </li>
            <li class='float-l' style="margin-left: 0px;border-left:1px solid #e2e2e2">
                <a id="tab-head-code" href="<?php echo Yii::app()->createUrl('/jpdata/vehicle/code') ?>" >前市场车型编码查询</a>
            </li>
        </ul>
    </div>
    <div class='panel-container tab-content auto_height'>
        <div id="tab-mm">
            <?php $this->renderPartial("search_mm"); ?>
        </div>
    </div>
</div>
<script type="text/javascript" src='<?php echo F::themeUrl(); ?>/js/jpdata/vehicle.js'></script>
<?php $this->renderPartial("checkcode"); ?>