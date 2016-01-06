<style>
<!--
.tabs-panels{border:0;}
-->
</style>
<div class='tabs' pre='tab'>
    <a class='left-indent'>&nbsp;</a>
    <?php echo CHtml::link('权限管理', Yii::app()->createUrl('member/jurisdiction/index'),array('class'=>'active'));?>
</div>
<?php if(!empty($organID)):?>
<div class="easyui-layout" style="width:100%;height:500px;" id="jp-layout">
	<div data-options="region:'north'" style="height:35px">
		<a href="javascript:void(0);" class="easyui-linkbutton" data-options="iconCls:'icon-add',plain:true" id="addroles">添加</a>
		<a href="javascript:void(0);" class="easyui-linkbutton" data-options="iconCls:'icon-save',plain:true" id="saves">保存</a>
		<a href="javascript:void(0);" class="easyui-linkbutton" data-options="iconCls:'icon-remove',plain:true" id="removeroles">删除</a>
	</div>
        <div id="ttabs" class="easyui-tabs" data-options="region:'center',border:false,fit:true">
                <div title="角色管理">
                        <?php $this->renderPartial('rolemanage');?>
                </div>
                <div title="分配角色给用户">
                        <?php $this->renderPartial('allocationrole');?>
                </div>
                <div title="用户角色管理">
                        <?php $this->renderPartial('userrole');?>
                </div>
        </div>
</div>
<script type="text/javascript">
<?php include 'jurisdiction.js';?>
</script>
<?php else:?>
    <?php if($identity==1):?>
        <p class="errormessage">对不起，您的公司信息未填写，<br> 请先到 <?php echo CHtml::link("我的公司",array('/maker/makecompany/index'))?> 登记</p>
    <?php elseif($identity==2):?>
        <p class="errormessage">对不起，您的公司信息未填写，<br> 请先到 <?php echo CHtml::link("我的公司",array('/dealer/business/index'))?> 登记</p>
    <?php else:?>
        <p class="errormessage">对不起，您的修理厂信息未填写，<br> 请先到 <?php echo CHtml::link("我的修理厂",array('/servicer/servicemain/index'))?> 登记</p>
    <?php endif;?>
<?php endif;?>