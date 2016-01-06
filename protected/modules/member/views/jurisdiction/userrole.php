<div class="easyui-layout" style="height:433px;">
	<div data-options="region:'west',split:true" style="width:160px;">
		<ul id="urdepartID"></ul>
	</div>
	<div data-options="region:'center'">
		<form id="userroleform" action="<?php echo Yii::app()->createUrl('member/jurisdiction/saveuserrole');?>" method="post">
			<div class="easyui-layout" style="width:604px;height:415px;border:0;">
				<div data-options="region:'north'" style="height:40px">
					<div class="fitem" style="height:20px;margin-top:10px;">
			    		<label>　用户名：</label><span id="username" style="color:blue;"></span>
			    		<input id="roleids" name="roleids" type="hidden">
			    		<input id="userid" name="userid" type="hidden">
					</div>
				</div>
				<div data-options="region:'center'">
					<div class="easyui-layout" style="width:602px;height:369px;border:0;">
						<div data-options="region:'west'" style="width:160px">
							<ul id="userrolelist"></ul>
						</div>
						<div data-options="region:'center'">
							<ul id="authtree"></ul>
						</div>
					</div>
				</div>
			</div>
		</form>
	</div>
</div>