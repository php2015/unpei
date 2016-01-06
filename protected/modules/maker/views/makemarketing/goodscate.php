<?php $url = Yii::app()->request->baseUrl; ?>
<?php $this->pageTitle = Yii::app()->name . ' - ' . "品类列表";?>
<div class='tabs' pre='tab'>
    <a class='left-indent'>&nbsp;</a>
    <?php echo CHtml::link('品类列表', Yii::app()->createUrl('maker/makemarketing/empowercate'), array('class' => 'active')); ?>
    <?php echo CHtml::link('添加品类', Yii::app()->createUrl('maker/makemarketing/addempowercate')); ?>
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
//            pageSize:3,
//            pageList:[3,4,5,6,10],
            idField:'id',
            url:'<?php echo Yii::app()->createUrl('maker/makemarketing/catelist') ?>',
            method:'get',
            toolbar:'#tb',
            columns:[[
                    { field:'id',width:30,checkbox:true },
                    { field: 'cateName',width:70, title: '品类名称' },
                    { field: 'remarks',width:100, title: '备注' },
                ]]
        });
    })
</script>