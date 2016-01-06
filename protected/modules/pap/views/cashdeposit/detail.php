<?php
$this->pageTitle = Yii::app()->name . '-违规详情';
$state = Yii::app()->request->getParam('state');
$organ = Yii::app()->request->getParam('organ');
$this->breadcrumbs = array(
    '保证金管理',
    '质量保证金' => Yii::app()->createUrl('pap/cashdeposit/index/type/1/time/2'),
    '违规详情',
);
?>
<style>
    .row{margin-top: 10px;}
    .row span{margin-left: 5px;}
    .row label {display: inline-block;margin-right: 0;text-align: right;width: 110px !important;}
    .row span{margin-left: 5px;}
    .errorMessage{width: 200px;border: 0 none;display: inline;font-size: 12px;}
    .textarea {width: 540px;height: 120px;}
    .width200{width:200px;}
</style>

<!--内容部分-->
<div class="bor_back m-top">
    <p class="txxx">
        违规详情
        <span style="float:right;margin-right:10px;"><a href="<?php echo Yii::app()->createUrl("pap/cashdeposit/index", array('type' => 1, 'time' => 2)); ?>" style="font-size:14px;color:#0065bf;">返回</a></span>
    </p>
    <div class='row'>
        <label class='label'>机构名称：</label>
        <span style="margin-left:5px;"><?php echo $data['OrganName']; ?></span>
    </div>
    <div class='row'>
        <label class='label'>当前总分：</label>
        <span id="TotalScore" style="margin-left:5px;"><?php echo $TotalScore; ?>分</span>
    </div>
    <div class='row'>
        <label class='label'>违规行为：</label>
        <span style="margin-left:5px;"><?php echo $data['itemName'] . " -> " . $data['Behavior']; ?></span>
    </div>
    <div class='row'>
        <label class='label'>违规次数：</label>
        <span id="ListNumber">第<?php echo $data['ListNumber'] ?>次</span>
    </div>
    <div class='row'>
        <label class='label'>处罚方式：</label>
        <span>
            <?php echo $data['Punishment'] ?>
        </span>
    </div>
    <div class='row'>
        <label class='label'>违规时间：</label>
        <span style="margin-left:5px;"><?php echo date("Y-m-d", $data['LlegalTime']); ?></span>
    </div>
    <div class='row' style="word-break:break-all; white-space:normal;">
        <label class='label'>违规说明：</label>
        <span style="margin-left:5px;"><?php echo html_entity_decode($data['Info']); ?></span>
    </div>
    <div class='row'></div>
</div>