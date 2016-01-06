<div class="easyui-layout" style="height:433px;">
	<div data-options="region:'west',split:true" style="width:130px;">
		<ul id="manegelist"></ul>
	</div>
	<div data-options="region:'center'">
		<form id="roleform" action="<?php echo Yii::app()->createUrl('member/jurisdiction/saverole');?>" method="post">
			<div class="easyui-layout" style="width:630px;height:415px;">
				<div data-options="region:'north'" style="height:60px">
					<div class="fitem" style="height:34px;margin-top:4px;">
			    		<label>　角色名：</label>
						<input id="rolename" name="rolename" type="text" class="easyui-validatebox input" style="width:150px" data-options="required:true">
						<label>　　描述：</label>
						<input id="describe" name="describe" type="text" class="easyui-validatebox input" style="width:280px" maxlength="200">
						<input id="jurisdiction" name="jurisdiction" type="hidden">
						<input id="roleid" name="roleid" type="hidden">
					</div>
					操作权限
				</div>
				<div data-options="region:'center'">
					<ul id="menutree"></ul>
				</div>
			</div>
		</form>
	</div>
</div>