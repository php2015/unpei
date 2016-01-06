
	<form id="employeeform"  action="<?php echo Yii::app()->createUrl('member/employee/saveemployee');?>" method="post" style="display: none">
	    <div style="padding:10px 0 10px 30px;">
	    	<div class="fitem" style="height:40px;">
	    		<label>　　姓名：</label>
				<input id="truename" name="Profiles[truename]" type="text" class="easyui-validatebox width98 input" data-options="required:true" maxlength="20">
	    		<label style="margin-left:20px;">　　称呼：</label>
	    		<input id="nickname" name="Profiles[nickname]" type="text" class="easyui-validatebox width98 input" maxlength="20">
	    		<label style="margin-left:20px;"></label>
	    		<input id="Validity" type="checkbox" checked>有效性
	    		<input type="hidden" name="Profiles[Validity]" value="Y" id="vali">
			</div>
<!--								<b class="ftitle">工作信息</b>-->
			<div class="fitem" style="height:40px;">
	    		<label>　用户名：</label>
			<input id="username" name="User[username]" type="text" class="easyui-validatebox width98 input" data-options="required:true" validtype="loginName">
	    		<label style="margin-left:20px;">　　密码：</label>
	    		<input id="password" name="User[password]" type="password" class="easyui-validatebox width98 input" data-options="required:true" maxlength="100">
			</div>
			<div class="fitem" style="height:40px;">
	    		<label>过期日期：</label>
	    		<input id="ExpirationDate" name="Profiles[ExpirationDate]" type="text" class="input" validType="datainfoformat">
	    		<label style="margin-left:20px;">　　工号：</label>
	    		<input id="EmployeeNum" name="Profiles[EmployeeNum]" type="text" class="easyui-validatebox width98 input" maxlength="30">
			</div>
<!--								<b class="ftitle">基础信息</b>-->
			<div class="fitem" style="height:40px;">
	    		<label>　　生日：</label>
	    		<input id="Birthday" name="Profiles[Birthday]" type="text" class="input" validType="datainfoformat">
	    		<label style="margin-left:20px;">　　性别：</label>
	    		<select class="easyui-combobox input" id="Sex" name="Profiles[Sex]" panelHeight="42" panelwidth="140" width="140px" editable="false"><option value="0">男</option><option value="1">女</option></select>
			</div>
			<div class="fitem" style="height:40px;">
	    		<label>　　部门：</label>
				<select id="parID" class="easyui-combotree" url="<?php echo Yii::app()->createUrl('member/employee/getdepartmenu'); ?>" name="parID" style="width:158px;"></select>
				<label style="margin-left:20px;">　　职位：</label>
	    		<input id="Position" name="Profiles[Position]" type="text" class="easyui-validatebox width98 input">
			</div>
			<div class="fitem" style="height:40px;">
	    		<label>　　手机：</label>
	    		<input id="phone" name="Profiles[phone]" type="text" class="easyui-validatebox width98 input" validType="mobile" maxlength="20">
				<label style="margin-left:20px;">办公电话：</label>
	    		<input id="OPH" name="Profiles[OPH]" type="text" class="easyui-validatebox width98 input" maxlength="100">
			</div>
			<div class="fitem" style="height:40px;">
	    		<label>电子邮箱：</label>
	    		<input id="email" name="User[email]" type="text" class="easyui-validatebox width98 input" validType="email" data-options="required:true" maxlength="100">
				<label style="margin-left:20px;">　　备注：</label>
	    		<input id="Remark" name="Profiles[Remark]" type="text" class="easyui-validatebox width98 input" maxlength="200">
			</div>
			<input id="employeeid" name="employeeid" type="hidden" class="easyui-validatebox">
    	</div>
	</form>