 <div id="dlgs" class="easyui-dialog" style="width:800px;height:490px;padding:10px 20px"
             closed="true" buttons="#dlg-buttons">
             <form id="fm" method="post" novalidate>
                <div class="fitem" style="margin-top:10px">
                    <label>群组名称:</label>
                    <input name="GroupName" class="easyui-validatebox" required="true" style="height: 30px;">
                </div>
              <div style="margin-top:10px">  添加群成员：
                <table id="dgs" class="easyui-datagrid" 
				data-options="rownumbers:true,url:'<?php echo Yii::app()->createUrl('cim/contact/contactlist') ?>',method:'post'">
				<thead>
					<tr>
					<th data-options="field:'id',checkbox:true"></th>
					<th field="customertype" >客户类型</th>
					<th field="name" >客户姓名</th>
					<th field="customercategory">客户类别</th>
					<th field="sex" >性别</th>
					<th field="companyname" >机构名称</th>
					<th field="cooperationtype">合作类型</th>
					<th field="phone" >联系电话</th>
					<th field="jiapart_ID" >嘉配ID</th>
					</tr>
				</thead>
			</table>
</div>
                <div class="fitem" style="margin-top:10px">
                    <label>备&nbsp;&nbsp;&nbsp;&nbsp;注:</label>
                    <textarea name="Remark"></textarea>
                </div>
        </div>
        <div id="dlg-buttons">
            <a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-ok" onclick="saveUser()">保存</a>
            <a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-cancel" onclick="javascript:$('#dlg').dialog('close')">取消</a>
        </div>
    </div>