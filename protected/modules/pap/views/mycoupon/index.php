<style>
    .uploadify {
    position: relative;
    margin-bottom: 1em;
}
.uploadify-button {
    background-color: #f3b302;
   background-position: center top;
    background-repeat: no-repeat;
    color: #FFF;
    font: bold 12px Arial, Helvetica, sans-serif;
    text-align: center;
    text-shadow: 0 -1px 0 rgba(0,0,0,0.25);
    width: 100%;
}

.uploadify-button.disabled {
    background-color: #D0D0D0;
    color: #808080;
}
.uploadify-queue {
    margin-bottom: 1em;
}
.uploadify-queue-item {
    background-color: #F5F5F5;
    -webkit-border-radius: 3px;
    -moz-border-radius: 3px;
    border-radius: 3px;
    font: 11px Verdana, Geneva, sans-serif;
    margin-top: 5px;
    max-width: 350px;
    padding: 10px;
}
.uploadify-error {
    background-color: #FDE5DD !important;
}
.uploadify-queue-item .cancel a {
    background: url('../img/uploadify-cancel.png') 0 0 no-repeat;
    float: right;
    height:	16px;
    text-indent: -9999px;
    width: 16px;
}
.uploadify-queue-item.completed {
    background-color: #E5E5E5;
}
.uploadify-progress {
    background-color: #E5E5E5;
    margin-top: 10px;
    width: 100%;
}
.uploadify-progress-bar {
    background-color: #0099FF;
    height: 3px;
    width: 1px;
}
    table{table-layout: fixed}
    input#OrganName{height: 27px;    line-height: 27px;}
    input#ID{height: 27px;    line-height: 27px;}
    input#Title{height: 27px;    line-height: 27px;}
</style>
<?php
$this->breadcrumbs = array(
    '我的优惠券' => Yii::app()->createUrl('pap/mycoupon/index'),
);
$this->pageTitle = Yii::app()->name . ' - 我的优惠券管理';
?>
<div class="bor_back m-top" style="height:auto; position:relative">
    <div class="txxx_info2a m-top">
        <form action='<?php echo Yii::app()->createUrl('pap/mycoupon/index') ?>' method="get">
            <p>
                <label style="margin-left:6px">优惠券号：</label>
                <input type="test" value="<?php echo $_GET['ID']; ?>" name='ID' id='ID'>
                <label style="margin-left:6px">优惠券状态：</label>
                <?php
                echo CHtml::dropDownList('IsUse', $_GET['IsUse'], CHtml::listData($op, 'ID', 'Name'), array('empty' => '请选择', 'class' => 'select', 'style' => 'width:106px'));
                ?>
                
               <input type="button" class="submit f_weight m_left" value="查 询" id="form_btn">
            </p>

        </form>
    </div>    

    <div class="txxx_info5">       
        <?php
        $this->widget('widgets.default.WGridView', array(
            'dataProvider' => $lists,
            'columns' => array(
                
                array(
                    'name' => '优惠券号',
                    'value' => '$data[CouponSn]',
                    'headerHtmlOptions' => array('width' => '60px')
                ),
               array(
                    'name' => '金额（￥）',
                    'type'=>'raw',
                    'value' => '$data[Amount]',
                    'headerHtmlOptions' => array('width' => '70px')
                ),
                
                array(
                    'name' => '活动标题',
                    'type'=>'raw',
                    'value' => '$data[Title]',
                    'headerHtmlOptions' => array('width' => '110px')
                ),
                array(
                    'name' => '优惠券领取日期',
                    'type'=>'raw',
                    'value' => 'date("Y-m-d H:i:s",$data[CreateTime])',
                    'headerHtmlOptions' => array('width' => '100px')
                ),
                array(
                    'name' => '优惠券截止日期',
                    'type'=>'raw',
                    'value' => 'date("Y-m-d H:i:s",$data[EndTime])',
                    'headerHtmlOptions' => array('width' => '100px','class'=>'m')
                ),
                array(
                    'name' => '使用状态',
                    'type'=>'raw',
                    'value' => '$data[IsUse]',
                    'headerHtmlOptions' => array('width' => '50px','class'=>'m'),
                ),
                
            )
        ));
        ?>
    </div>
</div>
<script>
    $(document).ready(function() {
        $('#form_btn').live('click', function() {
            var url = getUrl();
            window.location.href = Yii_baseUrl + '/pap/mycoupon/index' + url;
        })
     
    })

    function getUrl() {
        var url = '?';
        var id = $('input[name=ID]').val();
        var IsUse = $('select[name=IsUse]').val();
        if (id)
            url += 'ID=' + id+'&';
        if (IsUse)
            url += 'IsUse=' + IsUse;
         return url;
    }
    
</script>