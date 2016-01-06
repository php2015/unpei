<?php $url = Yii::app()->request->baseUrl; ?>
<?php $this->pageTitle = Yii::app()->name . ' - ' . "联系人列表";?>
<div class='tabs' pre='tab'>
    <a class='left-indent'>&nbsp;</a>
    <?php echo CHtml::link('联系人列表', Yii::app()->createUrl('maker/makemarketing/contacts'), array('class' => 'active')); ?>
    <?php echo CHtml::link('添加联系人', Yii::app()->createUrl('maker/makemarketing/addcontacts')); ?>
    <?php //echo CHtml::link('批量导入', Yii::app()->createUrl('maker/makemarketing/batchimport/act/cont'));?>
</div>
<div class='tab-content'>
    <div id='tab1'>
        <!--<div class="search">
            <?php //echo CHtml::beginForm('#', 'post',array('id'=>'searchform')); ?>
            <?php //if ($search): ?>
                <?php //echo CHtml::textField('search', $search, array('class' => 'width198 input y-align-t')); ?>
            <?php //else: ?>
                <?php //echo CHtml::textField('search', '所有字段的模糊查询', array('class' => 'width198 input y-align-t')); ?>
            <?php //endif; ?>
            <?php //echo CHtml::submitButton('查询', array('class' => "submit btn-green-small")) ?>
            <?php //echo CHtml::endForm(); ?>
        </div>-->
        <div class="checkbox-list">
            <?php if (!empty($models)): ?>
            <div class="control">
                <?php echo CHtml::checkBox('all', false, array('class' => 'float-l', 'key' => 'cont')); ?>
                <?php echo CHtml::link('全选', 'javascript:void(0)', array('style' => 'font-weight:bold;', 'id' => 'checkall')); ?>
                <?php echo CHtml::link('删除', 'javascript:void(0)', array('id' => 'delAll')); ?>
                <?php echo CHtml::link('添加联系人', Yii::app()->createUrl('maker/makemarketing/addcontacts')); ?>
            </div>
			<div id="message"></div>
                <table cellspacing=0 cellpadding=0 >
                    <thead>
                        <tr>
                            <td width=27>&nbsp;</td>
                            <td width=100>机构信息</td>
                            <td width=100>联系人信息</td>
                            <td width=64>合作类型</td>
                            <td width=90>备注</td>
                            <td width=78>客户类别</td>
                            <td width=55>操作</td>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($models as $model): ?>
                            <tr>
                                <td><?php echo CHtml::checkBox('id', false, array('value' => $model->id)); ?></td>
                                <td>
                                    <?php echo F::msubstr($model->organName); ?>
                                </td>
                                <td >
                                    <?php echo F::msubstr($model->contactsName.' '.$model->telephone); ?>
                                </td>
                                <td ><?php echo $model->cooperateType; ?></td>
                                <td ><?php echo F::msubstr($model->remarks); ?></td>
                                <td ><?php echo $model->customerType; ?></td>
                                <td >
                                    <?php echo CHtml::link('修改','javascript:void(0)',array('id'=>'modify','modelid'=>$model->id));?>||<?php echo CHtml::link('删除','javascript:void(0)',array('id'=>'delete','modelid'=>$model->id,'key'=>'cont'));?>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
                <?php else:?>
                <center>
					<p>搜索到&nbsp;<font color=red>0</font>&nbsp;条数据 &nbsp;&nbsp;<span style="text-decoration: underline"><?php //echo CHtml::link('重新加载',array('makemarketing/contacts'))?></span></p>
				</center>
                <?php endif; ?>
            </div>
      	<div class="pagelist text-c">
        <?php if ($count>$pagesize):?>
			<?php echo $page ;?>
			<span>
				去第
				<input id='thepage' class='input' value='1' style='width:20px' type='text'/>
				页
				<span id='gopage' class='btn-tiny'>GO</span>
			</span>
		<?php endif;?>
		</div>
    </div>
</div><?php include 'makerjs.php';?>
<script type="text/javascript">
    $(document).ready(function(){
    	$("#modify").live('click',function(){
    		if(window.confirm("您确定要修改吗?"))
    		{
    			var id=$(this).attr("modelid");
    			window.location.href="<?php echo Yii::app()->createUrl('maker/makemarketing/addcontacts');?>/id/"+id;
    		}
    	})
    	// 跳转到第几页
    	$("#gopage").click(function(){
    		var url = "<?php echo Yii::app()->createUrl('maker/makemarketing/contacts'); ?>";
    		var page = $("#thepage").val();
    		if(isNaN(page))
    		{
    			alert('请输入阿拉伯数字 !');
    			$("#thepage").val('');
    		}else{
    			location.href=url+"?page="+page;
    		}
    	}).css('cursor','pointer');
    })
</script>