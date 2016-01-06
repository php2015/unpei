<?php $this->pageTitle = Yii::app()->name . ' - ' . "授权经销商列表"; ?>
<div class='tabs' pre='tab'>
    <a class='left-indent'>&nbsp;</a>
    <?php echo CHtml::link('授权经销商列表', Yii::app()->createUrl('maker/makemarketing/empowerdealer'), array('class' => 'active')); ?>
    <?php echo CHtml::link('授权经销商登记', Yii::app()->createUrl('maker/makemarketing/addempdea')); ?>
</div>
<?php $this->renderPartial('table'); ?>
<script type="text/javascript">
    $(document).ready(function(){
        $("#dg").datagrid({
            region:'center',
            pagination:true,
            rownumbers:false,
            fitColumns:true,
            singleSelect:false,
            selectOnCheck: true,
            checkOnSelect: true,
            idField:'id',
            url:'<?php echo Yii::app()->createUrl('maker/makemarketing/empowerlist') ?>',
            method:'get',
            toolbar:'#tb',
            columns:[[
                    { field:'id',width:30,checkbox:true },
                    { field: 'organName',width:100, title: '经销商名称' },
                    { field: 'grade',width:70, title: '经营级别' },
                    { field: 'category',width:100, title: '授权品类' },
                    { field: 'brand',width:100, title: '授权品牌' },
                    { field: 'accountMethods',width:100, title: '结算方式' },
                ]]
        });
    })
</script>