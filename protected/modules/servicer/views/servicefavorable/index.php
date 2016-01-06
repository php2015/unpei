<?php
$controlerId = Yii::app()->getController()->id;
$actionId = $this->getAction()->getId();
$active = "class = 'active'";
//echo $controlerId;
?>
<div class='tabs' pre='tab'>
    <a style='margin-left:-30px;'>&nbsp;</a>
    <a <?php if ($controlerId == 'servicefavorable' && $actionId == 'index') echo $active; ?> href="<?php echo Yii::app()->createUrl('servicer/servicefavorable/index'); ?>">优惠活动管理</a>
    <!--<a <?php //if($controlerId=='servicequery' && $actionId=='service' || $actionId=='serviceDetail') echo $active;      ?> href="<?php //echo Yii::app()->createUrl('servicer/servicequery/service');      ?>">合作修理厂</a>-->
</div>

<div class="easyui-layout" id="jp-layout" style="height:500px">	
    <table id="dg" class="easyui-datagrid"  style="height:500px"
           data-options="rownumbers:true,
           region:'center',
           fitColumns:true,
           pagination:true,
           singleSelect:true,
           method:'get',
           url:'<?php echo Yii::app()->createUrl('servicer/servicefavorable/list'); ?>',
           toolbar:'#toolbar'"><thead>
            <tr>
<!--                 <th data-options="field:'ck',checkbox:true">序号</th> -->
                <th data-options="field:'Title',width:80">活动主题</th>
                <th data-options="field:'Type',width:100">优惠券类型</th>
                <th data-options="field:'Rate2',width:80">优惠率</th>
                <th data-options="field:'EffectTime',width:160">有效日期</th>
                <th data-options="field:'Content',width:220">短信内容</th>
                <th data-options="field:'CreateTime',width:160">创建日期</th>
                <th data-options="field:'Status',width:60">状态</th>
            </tr>
        </thead>
    </table>
</div>
<div class="sidebar-show" style="display: none;"></div> 
<div id="toolbar">
    <a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-add" plain="true" onclick="newActive()">添加</a>
    <a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-edit" plain="true" onclick="editActive()">修改</a>
    <a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-remove" plain="true" onclick="destroyActive()">删除</a>
    <!-- <a href="javascript:void(0)" class="easyui-linkbutton"  plain="true" onclick="SendActive()">发送</a> -->
    <a href="javascript:void(0)" class="easyui-linkbutton"  plain="true" onclick="OpenActive()">开启</a>
    <a href="javascript:void(0)" class="easyui-linkbutton"  plain="true" onclick="Detail()">查看</a>
    <div style="padding-left:12px;">
        <p class="form-row">
            活动主题: <input  class="width78 input " type="text" name="title"  id="title">&nbsp;
            优惠券类型: <?php
echo CHtml::dropDownList('type', '', array('0' => '抵扣券', '1' => '折扣券', '2' => '其他'), array(
    'empty' => '全部',
    'class' => 'width88 select',
    'id' => 'type'
        )
);
?>&nbsp;	
            状态: <?php
            echo CHtml::dropDownList('status', '', array('0' => '未开启', '1' => '已关闭', '2' => '已开启'), array(
                'empty' => '全部',
                'class' => 'width88 select',
                'id' => 'status'
                    )
            );
?>	&nbsp;
            创建日期:  <input class="easyui-datebox"  style="width:88px" name="date" id="date">&nbsp;			
            <a class="btn-green" iconCls="icon-search" id="search-btn">查询</a>
        </p>
    </div>
</div>
<div id="dlgactive" class="easyui-dialog" style="width:650px;height:600px;padding:10px 20px"
     closed="true"  modal='true' buttons="#dlg-buttons" >
    <form id="fm" method="post" novalidate>
   
        <table class="dttable">
            <tr class="fitem" style="height:30px;">
                <td >活动主题：</td>
                <td colspan=3>
                    <input name="Title" class="easyui-validatebox width180 input" required="true">
                </td>
                
            </tr>
            <tr class="fitem" style="height:30px;">
                <td  width=70>优惠券类型:</td>
                <td id='types'>
                    <select class="easyui-validatebox width100 select" style="width: 140px;" name="Type" id='tp' required="true">
<!--                         <option value="" selected>选择类型</option> -->
                        <option value="0">抵扣券</option>
                        <option value="1">折扣券</option>
                        <option value="2">其他</option>
                    </select></td>
                <td align="right" width=70 id='you'>优惠率:</td>
                <td width=185 id="rate" align="left">
                    <input type="text" style="width: 70px;" class="easyui-validatebox width60px input" name="Rate" required="true" ><span id="rs">元/折</span>
                </td>
            </tr>
            <tr class="fitem" style="height:30px;">
                <td >有效日期:</td>
                <td ><input class="easyui-datebox width140 input" name='StartTime' required="true" ></td>
                <td>——</td>
                 <td>   <input class="easyui-datebox" name='EndTime'  required="true"></td>
            </tr>
            <tr class="fitem" style="height:30px;">
                <td >活动内容:</td>
                <td colspan=3>
                    <textarea name="Content" style="width:450px;height:100px;"></textarea><p>
                </td>
            </tr>
        </table>
        <div >
            <?php echo $this->renderPartial('select') ?>
        </div>
    </form>
</div>
<div id="dlg-buttons">
    <a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-ok" id="ok" onclick="saveActive()">保存</a>
    <a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-ok" id="edit" onclick="editSave()">保存</a>
    <a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-cancel" onclick="addcancle()">取消</a>
</div>
<div id="dlgdetail" class="easyui-dialog" style="width:600px;height:580px;padding:10px 20px"
     closed="true"  modal='true' buttons="#dlg-button">
    <form id="fmdetail" method="post" novalidate>
        <table class="dttable">
            <tr class="fitem" style="height:30px;">
                <td >活动主题：</td>
                <td colspan=3>
                    <input name="Title" class="easyui-validatebox width190 input" readonly>
                </td>
            </tr>
            <tr class="fitem" style="height:30px;">
                <td >优惠券类型：</td>
                <td >
                    <input name="Type" class="easyui-validatebox width190 input" readonly>
                </td>
                <td id='yh'>折扣率：</td>
                <td >
                    <input name="Rate" class="easyui-validatebox width190 input" readonly><span id="name">折</span>
                </td>
            </tr>
            <tr class="fitem" style="height:30px;">
                <td >有效日期：</td>
                <td >
                    <input name="StartTime" class="easyui-datebox width190 input" readonly>
                </td>
                <td >-</td>
                <td >
                    <input name="EndTime" class="easyui-datebox width190 input" readonly>
                </td>
            </tr>
            <tr class="fitem" style="height:30px;">
                <td >活动内容：</td>
                <td colspan=3>
                    <textarea name="Content" readonly style="width:450px;height:100px;"></textarea>
                </td>
            </tr>
            <tr>
                <td>发送对象:</td>
            </tr>
            <div>
                <table id="send" data-options="rownumbers:true" style="width:500px">

                </table>
            </div>
        </table>
    </form>
</div>
<div id="dlg-button">
    <a href="javascript:void(0)" class="easyui-linkbutton" onclick="decancle()">返回</a>
</div>

<div id="dlgsend" class="easyui-dialog" style="width:650px;height:600px;padding:10px 20px"
     closed="true"  modal='true' buttons="#dlg-button">
    <form id="fmsend" method="post" novalidate>
        <table class="dttable">
            <tr class="fitem" style="height:30px;">
                <td >活动主题：</td>
                <td colspan=3>
                    <input name="Title" class="easyui-validatebox width190 input" readonly>
                </td>
            </tr>
            <tr class="fitem" style="height:30px;">
                <td >优惠券类型：</td>
                <td >
                    <input name="Type" class="easyui-validatebox width190 input" readonly>
                </td>
                <td >折扣率：</td>
                <td >
                    <input name="Rate" class="easyui-validatebox width190 input" readonly>折
                </td>
            </tr>
            <tr class="fitem" style="height:30px;">
                <td >有效日期：</td>
                <td >
                    <input name="StartTime" class="easyui-datebox width190 input" readonly>
                </td>
                <td >-</td>
                <td >
                    <input name="EndTime" class="easyui-datebox width190 input" readonly>
                </td>
            </tr>
            <tr class="fitem" style="height:30px;">
                <td >活动内容：</td>
                <td colspan=3>
                    <textarea name="Content" readonly style="width:450px;height:100px;"></textarea>
                </td>
            </tr>
            <tr>
                <td>发送对象:</td>
            </tr>
            <div>
                <div >
                    <table id="send_code" data-options="rownumbers:true, fitColumns:true" style="padding-left:20px;width:500px;">
                    </table>
                </div>
            </div>
        </table>
    </form>
</div>
<div id="dlg-button">
    <a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-ok" onclick="javascript:alert('功能正在完善中...');$('#dlgsend').dialog('close')">确认发送</a>
    <a href="javascript:void(0)" class="easyui-linkbutton" onclick="cancle()">返回</a>
</div>
<script type="text/javascript">
    $('#tp').change(function(){
   	   if($(this).val()==0)
   	   {
   	   	   $('#you').text('减现');
   	   	   $('#rs').text('元');
   	   }
   	   else
   	   {
      		$('#you').text('优惠率');
 	   	   $('#rs').text('元/折');
   	   }
   	   if($(this).val()==1)
   	   {
    		$('#you').text('打');
      		$('#rs').text('折');
   	   }
   	   if($(this).val()==2)
        {
            $('#rate').hide();
            $('#you').hide();
        }
       
        else
        {
            $('#rate').show();
            $('#you').show();
        }
    });
    var url;
    function newActive(){
        var row = $('#dg').datagrid('getSelected');
        var data=new Array();
        data['total']=0;
        data['rows']=Array();
        $('#dlgactive').dialog('open').dialog('setTitle','创建活动');
        $("#tp").prop("disabled", false);
        $('#ok').show();
        $('#edit').hide();
        $('#fm').form('clear');
        url = Yii_baseUrl + "/servicer/servicefavorable/add";
        $('#send_car').datagrid({
            url:'<?php echo Yii::app()->createUrl('servicer/servicefavorable/sendcar') ?>'
        });
   		$('#select2').datagrid('loadData',data);
    }

    function editActive() {
        $('#ok').hide();
        $('#edit').show();
        var row = $('#dg').datagrid('getSelected');
        if(row)
        {
            if(row.Status=='已开启' || row.Status=='已关闭')
            {
                $.messager.alert('提示信息','该活动正进行或关闭状态,不能修改!','warning');
            }
            if (row.Status=='未开启') {
                $('#dlgactive').dialog('open').dialog('setTitle', '编辑');
                $('#fm').form('load', row);
                $('#tp').val(row.TypeID).change();
                $("#tp").attr("disabled", true);
                url = Yii_baseUrl + "/servicer/servicefavorable/update?id="+row.ID;
                $('#send_car').datagrid({
                    // url:'<?php //echo Yii::app()->createUrl('servicer/servicefavorable/sendcar')      ?>'
                    url : Yii_baseUrl + "/servicer/servicefavorable/editsend?id="+row.ID,
                });
                $('#select2').datagrid({
                    url:Yii_baseUrl + "/servicer/servicefavorable/Dissendcar?id="+row.ID,
                    onLoadSuccess:function(data)
                    {
                   	 var iddata='';
                     var namedata='';
                     var phonedata='';
                     var  licedata='';
                     var cardata='';
                     var nickdata='';
                  	  var row2=$('#select2').datagrid('getRows');
             	     $.each(row2,function(index,value){
             	    	 iddata=iddata+value.ID+',';
             			 namedata=namedata+value.OwnerName+',';
             			 phonedata=phonedata+value.OwnerPhone+',';
             			 licedata=licedata+value.LicensePlate+',';
             			 cardata=cardata+value.CarID+',';
             			 nickdata=nickdata+value.NickName+',';
             	     });
             	    $('#iddata').val(iddata);
             	    $("#namedata").val(namedata);
             	    $("#phonedata").val(phonedata);
             	    $("#licedata").val(licedata);
             	    $("#cardata").val(cardata);
             	    $('#nickdata').val(nickdata);
                    }
                    });
            }
        }
        else
        {
            $.messager.alert('提示信息','请先勾选数据!','warning');
        }
        
    }
    function editSave()
    {
        $('#fm').form('submit',{
            url: url,
            onSubmit: function(){
            	var date = new Date();
            	var y = date.getFullYear();
            	var m = date.getMonth()+1;
            	var d = date.getDate();
            	var endtimes=y+'-'+m+'-'+d;
                //判段有效日期
                var starttime=$('#fm').find("input[name=StartTime]").val();
                var start=new Date(starttime.replace("-", "/").replace("-", "/"));
                var endTime=$('#fm').find("input[name=EndTime]").val(); 
                var end=new Date(endTime.replace("-", "/").replace("-", "/"));
              //  var endtimes=$('#EndTimes').val(); 
                var system=new Date(endtimes.replace("-", "/").replace("-", "/"));
                if(end<start){  
                    $.messager.alert('提示信息','开始日期不能小于截止日期!','warning');
                    return false;  
                }  
                if(end<system){  
                    $.messager.alert('提示信息','活动日期不能小于当前日期!','warning');
                    return false;  
                }  
                return $(this).form('validate');
            },
            success: function(result) {
                if (result) {
                    $.messager.alert("提示信息", "操作成功");
                    $("#dlgactive").dialog("close");
                    $("#dg").datagrid("reload");
                    //location.reload();
                }
                else {
                    $.messager.alert("提示信息", "操作失败");
                }
            }
        });
    }
    function saveActive(){
        $('#fm').form('submit',{
            url: url,
            onSubmit: function(){
            	var date = new Date();
            	var y = date.getFullYear();
            	var m = date.getMonth()+1;
            	var d = date.getDate();
            	var endtimes=y+'-'+m+'-'+d;
                  //判段有效日期
                var starttime=$('#fm').find("input[name=StartTime]").val();
                var start=new Date(starttime.replace("-", "/").replace("-", "/"));
                var endTime=$('#fm').find("input[name=EndTime]").val(); 
                var end=new Date(endTime.replace("-", "/").replace("-", "/")); 
                //                 var endtimes=$('#EndTimes').val();
                var system=new Date(endtimes.replace("-", "/").replace("-", "/"));
                if(end<start){  
                    $.messager.alert('提示信息','开始日期不能小于截止日期!','warning');
                    return false;  
                }  
                if(end<system){  
                    $.messager.alert('提示信息','活动日期不能小于当前日期!','warning');
                    return false;  
                }  
               if($('#tp').val()==null)
               {
            	   $.messager.alert('提示信息','请选择优惠券类型','info');
                   return false;
               }
                return $(this).form('validate');
            },
            success: function(result) {
                if(result.errorMsg)
                {
                    $.messager.alert("提示信息", "有效时间错误");
                    $("#dlgactive").dialog("close");
                    $("#dg").datagrid("load");
                }
                if (result == '1') {
                    $.messager.alert("提示信息", "操作成功");
                    $("#dlgactive").dialog("close");
                    $("#dg").datagrid("reload");
                }
                else {
                    $.messager.alert("提示信息", "操作失败");
                    $("#dg").datagrid("reload");
                }
            }
        });
    }
    function destroyActive() {
        var row = $('#dg').datagrid('getSelected');
        if(row){
            if(row.Status=='已开启' || row.Status=='已关闭')
            {
                $.messager.alert("提示信息", "该活动正进行或关闭状态,不能删除!",'error'); 
                return false;
            }
            if (row.Status=='未开启') {
                $.messager.confirm('提示信息', '您确定想要删除该数据?', function(r) {
                    if (r) {
                        $.get(Yii_baseUrl + "/servicer/servicefavorable/delete", {id: row.ID}, function(result) {
                            if (result) {
                                $.messager.alert("提示信息", "操作成功");
                                $("#dlgactive").dialog("close");
                                $("#dg").datagrid("load");
                            }
                            else {
                                $.messager.alert("提示信息", "操作失败");
                            }
                        }, 'json');
                    }
                });
            }
        }else
        {
            $.messager.alert('提示信息','请先勾选数据!','warning');
        }
    }
    function OpenActive()
    {
        var ids='';
        var rows=$('#dg').datagrid('getSelected');
        if(rows)
        {
        var row=$('#dg').datagrid('getChecked');
       
      //  var row=$('#dg').datagrid('getSelected');
        if(row){
            $.messager.confirm('提示信息', '是否确定开启活动?', function(r) {
                if (r) {
                    $($("#dg").datagrid("getChecked")).each(function(){
                        ids=ids+this.ID+',';
                    });
                    $.ajax({
                        url: Yii_baseUrl + "/servicer/servicefavorable/open",
                        type:'post',
                        data:{
                            ids:ids
                        },
                        dataType: "json",
                        success:function(result)
                        {
                            if(result)
                            {
                                $.messager.alert("提示信息", "开启成功");
                                $('#dg').datagrid('load');
                            }
                            else
                            {
                                $.messager.alert("提示信息", "活动已开启");
                                $('#dg').datagrid('load');
                            }
                        }
                    });
                }
            });
        }
        }else{
            $.messager.alert('提示信息','请先勾选数据!','warning');
        }
    }
    function Detail()
    {
        var row = $('#dg').datagrid('getSelected');
        if(row)
        {
            $('#dlgdetail').dialog('open').dialog('setTitle', '查看');
            $('#fmdetail').form('load', row);
            if(row.Type=='抵扣券')
            {
                $('#yh').text('优惠');
                $('#name').text('元');
            }
            $('#send').datagrid({
                url: Yii_baseUrl + "/servicer/servicefavorable/discountcode?id="+row.ID,
                columns:[[
                        {field:'OwnerName',title:'姓名',width:60},
                        {field:'NickName',title:'昵称',width:60},
                        {field:'OwnerPhone',title:'手机号',width:100},
                        {field:'LicensePlate',title:'车牌号',width:100},
                        {field:'Code',title:'优惠码',width:60},
                        {field:'Status',title:'使用状态',width:80}
                    ]]
            });
        }else{
            $.messager.alert('提示信息','请先勾选数据!','warning');
        }
    }
    //发送
    function SendActive()
    {
        var row = $('#dg').datagrid('getSelected');
        if(row)
        {
		  
            $('#dlgsend').dialog('open').dialog('setTitle', '编辑');
            $('#fmsend').form('load', row);
            $('#send_code').datagrid({
                url: Yii_baseUrl + "/servicer/servicefavorable/discountcode?id="+row.ID,
                columns:[[
                        {field:'OwnerName',title:'姓名',width:60},
                        {field:'NickName',title:'昵称',width:60},
                        {field:'OwnerPhone',title:'手机号',width:100},
                        {field:'LicensePlate',title:'车牌号',width:100},
                        {field:'Code',title:'优惠码',width:60}
                    ]]
            });
        }else{
            $.messager.alert('提示信息','请先勾选数据!','warning');
        }
    }
    $('#search-btn').click(function(){
        var url= Yii_baseUrl + "/servicer/servicefavorable/list";
        var title = $('#title').val().toString();
        var type = $('#type').val();
        var status = $("#status").val();
        var dates = $("#date").datebox("getValue");
        $('#dg').datagrid({ url:url,queryParams:{
                'title':title,
                'type':type,
                'status':status,
                'dates': dates 
            },method:"get"});
    });
    function cancle()
    {
        $('#dlgsend').dialog('close');
        $('#dg').datagrid('reload');
    }
    function decancle()
    {
        $('#dlgdetail').dialog('close');
        $('#dg').datagrid('reload');
      
    }
    function addcancle()
    {
        $('#dlgactive').dialog('close');
       // $('#dg').datagrid('load');
        //location.reload();
    }
        
</script>