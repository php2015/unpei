<div id="check_detail" class="easyui-dialog" style="width:600px;height:450px;padding:10px 20px;"
     closed="true" buttons="#dlg-details" modal="true">
    <table class="dttable">
        <tr class="fitem" style="height:30px;">
            <td align="right" width="100">发送时间:</td>
            <td name="sendtime"></td>
        </tr>
        <tr class="fitem" style="height:30px;">
            <td align="right">发送方式:</td>
            <td name="sendway"></td>
        </tr>
        <tr class="fitem" style="height:30px;">
            <td align="right">发送内容:</td>
            <td name="sendcontent"style="width:200px;word-break:break-all"></td>
        </tr>

        <tr class="fitem" style="height:30px;">
            <td align="right">发送对象:</td>
            <td name="sendto">
                <div style="float:left;margin-top:20px;height:220px">
                    <table id="send_info" class="easyui-datagrid" style="width:440px;height:200px"
                           data-options="url:'<?php //echo Yii::app()->createUrl('cim/contact/contactlist') ?>',fitColumns:true,singleSelect:false,rownumbers:true">
                        <thead>
                            <tr>
                                <th data-options="field:'name',width:50">姓名</th>
                                <th data-options="field:'customercategory',width:50">客户类别</th>
                                <th data-options="field:'companyname',width:60">公司名称</th>
                                <th data-options="field:'phone',width:70">手机号</th>
                                <th data-options="field:'email',width:80">邮箱</th>
                            </tr>
                        </thead>
                    </table>
                </div>

            </td>
        </tr>
    </table>
    <div id="dlg-details">
        <a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-cancel" onclick="javascript:$('#check_detail').dialog('close')">取消</a>
    </div>
</div>