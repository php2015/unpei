<style>
    input,select{color: black}
</style>
<?php
$this->pageTitle = Yii::app()->name . ' - ' . "授权经销商管理";
?>

<div class='tabs' pre='tab'>
    <a class='left-indent'>&nbsp;</a>
    <?php echo CHtml::link('授权经销商列表', Yii::app()->createUrl('maker/promitdealer/index'), array('class' => 'active')) ?>

</div>
<div style="height: 10px"></div>
<table id="dg"  class="easyui-datagrid" style="height:480px"
       data-options='url:"<?php echo Yii::app()->createUrl('maker/promitdealer/indexdata') ?>",
       region:"center",
       toolbar:"#toolbar" ,
       rownumbers:true,
       fitColumns:false,
       singleSelect:false,
       method:"get",
       pagination:true'
       >
    <thead>
        <tr>   
            <th field="ID" checkbox="true"></th>    
            <th field="organName" width="100">机构名称</th>    
            <th field="Level" width="80">授权级别</th>  
            <th field="Category" width="80">客户类别</th>  
            <th field="Payment" width="80">结算方式</th>  
            <th field="BrandName" width="120" align="left">授权品牌</th>    
            <th field="PromitArea" width="120">授权地域</th>    
            <th field="Phone" width="100">联系电话</th>    
        </tr>    
    </thead>
</table>

<div id="toolbar">
    <div style="padding-left:12px;">
        <!--<form id="searchpromit" method="post">-->
        <p class="form-row">
            <span>机构名称：<input type="text" name="searchorganName"  class="width108 input "/></span>
            <span style="margin-left:30px">授权品牌：
            <?php
            $barnd = MakeGoodsBrand::model()->findAll('OrganID=:OrganID', array(':OrganID' => Commonmodel::getOrganID()));
            $operate_region = CHtml::listData($barnd, "BrandID", "BrandName");
            ?>
            <?php echo CHtml::dropDownList('searchBrandName', '', $operate_region, array('class' => 'width120 select', 'empty' => '请选择授权品牌')); ?></span>
            <span style="margin-left:30px">授权地域：<?php
            $operate_data = Area::model()->findAll("grade=:grade", array(":grade" => 1));
            $operate_region = CHtml::listData($operate_data, "id", "name");
            ?>
            <?php echo CHtml::dropDownList('searchPromitArea', '', $operate_region, array('class' => 'width120 select', 'empty' => '请选择授权地域')); ?></span>
        </p>
        <p class="form-row">
            <span>联系电话：<input name="searchPhone" type="text"  class="width108 input "/></span>
            <span style="margin-left:30px">授权级别：
            <select name="searchlevel" class="width120 select"><option value="">请选择授权级别</option><option value="A">A</option><option value="B">B</option><option value="C">C</option></select></span>
            <span style="margin-left:100px"><a  class="btn-green" iconcls="icon-search" href="javascript:void(0)" onclick="Search()">查询</a></span>
        </p>
        <!--</form>-->
    </div>
    <a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-add" plain="true" onclick="newPromit()">添加</a>
    <a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-edit" plain="true" onclick="editPromit()">编辑</a>
    <a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-remove" plain="true" onclick="destroyPromit()">删除</a>
    <a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-edit" plain="true" onclick="set()">设置折扣率</a>
</div>
<?php $this->renderPartial('edit'); ?>
<div  id="setprice"  class="easyui-dialog"  title="折扣率设置" style="width:300px;" modal="true" closed="true"> 
    <div style="padding:10px 0 10px 20px">
        <form id="ff" method="post">
            <table style="margin-left: 20px">
                <input type="hidden" name="ID" value=""/>
                <tr>
                    <td>级别A：</td>
                    <td><input class="easyui-validatebox input "  style="width:50px" validType="ruleprice" type="text" name="LevelA" data-options="required:true" value="">%</td>
                </tr>
                <tr>
                    <td>级别B：</td>
                    <td><input class="easyui-validatebox input " style="width:50px" validType="ruleprice" type="text" name="LevelB" data-options="required:true" value="">%</td>
                </tr>
                <tr>
                    <td>级别C：</td>
                    <td>100%</td>
                </tr>
            </table>
        </form>
    </div>
   <div style="text-align:center;padding:5px">
            <a href="javascript:void(0)" class="easyui-linkbutton" onclick="submitForm()">保存</a>
            <a href="javascript:void(0)" class="easyui-linkbutton" onclick="$('#setprice').dialog('close')">关闭</a>
        </div>
</div>
<script type="text/javascript">
    $.extend($.fn.validatebox.defaults.rules, {
        ruleprice: {
            validator: function (value, param) {
                return /^([1-9]\d?|[0][1-9]){1}$/.test(value);
                // return /^(\d)?\d(\.*\d{1,2})?$/.test(value);
            },
            message: '请输入1-99内数字'
        }
    });
    function submitForm(){
         if($("input[name=LevelA]").val() && $("input[name=LevelB]").val()){
                        if(parseInt($("input[name=LevelA]").val())>= parseInt($("input[name=LevelB]").val())){
                            $.messager.alert('提示','级别A的折扣率必须小于级别B的折扣率','warning');
                            return false;
                        }    
                    }
                   
                    $("#ff").form({
                        url:'<?php echo Yii::app()->baseUrl; ?>/maker/promitdealer/editprice',
                        success:function(reg){
                            if(reg>0){
                                $.messager.show({
                                    title:'提示',
                                    msg:'修改成功'
                                })
                                $("#setprice").dialog('close')
                            }else  {
                                $.messager.show({
                                    title:'提示',
                                    msg:'修改失败'
                                })
                            }
                        }
                    })
                    $("#ff").submit();  
    }
    
    function Search(){
        var Url='<?php echo Yii::app()->baseUrl; ?>/maker/promitdealer/indexdata';
        var obj=new Object;
        obj.organName=$("input[name=searchorganName]").val();
        obj.BrandName=$("#searchBrandName").val();
        obj.Phone=$("input[name=searchPhone]").val();
        obj.PromitArea=$("#searchPromitArea").val();
        obj.Level=$("select[name=searchlevel]").val();
        $("#dg").datagrid({
            url:Url,
            queryParams:obj
        })
    }
    function newPromit(){
        $("#dialog").dialog('open')
        $.post(Yii_baseUrl + "/maker/promitdealer/gettype",function(result){
            result = eval("("+result+")");
            $("select[name=CustomerType]").empty();
            $("select[name=CustomerType]").append("<option value=''>请选择客户类别</option>");
            $.each(result,function(key,value){
                $("select[name=CustomerType]").append("<option value=\""+value.ID+"\">"+value.TypeName+"</option>");
            });
        });
        $("#editpromit").form('clear')
        $("input[name=organName]").val('')
        $("#BrandName").val('')
        $("#PromitArea").val('')
        $("input[name=Phone]").val('')
        $("select[name=level]").val('')
        $("#CustomerType").val('')
        $("select[name=Settlement]").val('')
        $("#appendrow").empty();
    }
    function editPromit(){
        var selects=$("#dg").datagrid('getSelections');
        if(selects.length==0){$.messager.alert('提示','请选择一条数据','info'); return false}
        if(selects.length>1){$.messager.alert('提示','只能选择一条数据进行编辑','info');return false}
        if(selects.length==1){
            var select=$("#dg").datagrid('getSelected');
            $("input[name=organName]").val(select.organName)
            $("input[name=Phone]").val(select.Phone)
            $("select[name=level]").val(select.Level)
            $("select[name=CustomerType]").val(select.CustomerType)
            $("select[name=Settlement]").val(select.Settlement)
            $.post(Yii_baseUrl + "/maker/promitdealer/gettype",function(result){
                result = eval("("+result+")");
                $("select[name=CustomerType]").empty();
                $("select[name=CustomerType]").append("<option value=''>请选择客户类别</option>");
                $.each(result,function(key,value){
                    $("select[name=CustomerType]").append("<option value=\""+value.ID+"\">"+value.TypeName+"</option>");
                    if(select.CustomerType == value.ID){
                        $("select[name=CustomerType]").find("option[value=\""+value.ID+"\"]").attr("selected",true);
                    }
                });
            });
            var provice=select.provice
            provice=provice.split(',')
            $.each(provice,function(i,row){
                if(row.length>0){
                    provice= row
                }
            })
            
            $("#PromitArea").val(provice)
            $("#hiddenID").val(select.ID)
            $("#hiddendealerID").val(select.DealerID)
            $("#hiddenBrandName").val(select.name)
            $("#appendrow").empty();
            var barndid=select.name.split(',')
            var brandname=select.BrandName;
            brandname=$(brandname).text();
            brandname=brandname.split(',');
            $.each(barndid,function(i,row){
                if(row.length>0){
                    $.each(brandname,function(m,n){
                        m=m+1;
                        if(m==i){
                            var str2 = '<span id='+row+'><font color="green">'+n+'</font><a href="javascript:void(0)" onclick="Remove('+row+')">&nbsp;<font color="green">×</font></a>&nbsp;&nbsp;</span>';
                            $("#appendrow").append(str2);   
                        }   
                    })  
                }
            })
            //            str= $("#BrandName").find('option[value='+val+']').html();

            $("#dialog").dialog('open')   
        }
    }
    function destroyPromit(){
    
        var select=$("#dg").datagrid('getSelections');
        if(select.length==0){
            $.messager.alert('提示','请选择数据','info') 
            return false
        }
        $.messager.confirm('提示','您确定要执行删除操作吗？',function(r){
            if(r){
                var ids='';
                $.each(select,function(n,m){
                    ids+= m.ID+',';
                })
                $.ajax({
                    url:'<?php echo Yii::app()->baseUrl ?>/maker/promitdealer/delpromit',
                    type:'post',
                    data:{'ids':ids},
                    dataType:'json',
                    success:function(reg){
                        $.messager.show({
                            title:'提示',
                            msg:reg
                        })
                        $("#dg").datagrid('reload')
                        $('#dg').datagrid('unselectAll');
                    }
                })   
            }
        })
        
    }
    
    function set(){
        $("#setprice").dialog('open')
        $.ajax({
            url:'<?php echo Yii::app()->baseUrl ?>/maker/promitdealer/getpriceinfo',
            dataType:'json',
            success:function(msg){
                $("input[name=ID]").val(msg.ID);
                $("input[name=LevelA]").val(msg.A);
                $("input[name=LevelB]").val(msg.B);
                $("input[name=LevelA]").validatebox('validate');
                $("input[name=LevelB]").validatebox('validate');
            }
        })
    }
</script>