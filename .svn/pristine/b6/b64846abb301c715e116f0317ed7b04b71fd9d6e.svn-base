<?php
$this->pageTitle = Yii::app()->name . ' - ' . "标准名称参数管理";
?>
<div class='tabs' pre='tab'>
    <a class='left-indent'>&nbsp;</a>
    <?php echo CHtml::link('标准名称参数', Yii::app()->createUrl('maker/Standardparam/index'), array('class' => 'active')); ?>
</div>
<div class="easyui-layout" style="height:auto;margin-top:5px">	
    <table id="standardlists"  style="height:380px">
    </table>
</div>
<div id="toolbar" style="padding:5px;height:auto">
    <div style="margin-bottom:5px">
        <a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-add" plain="true" onclick="addparams()">添加</a>
        <a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-edit" plain="true" onclick="editparams()">编辑</a>
        <a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-down" plain="true" onclick="downloadparams()">下载</a>
        <a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-remove" plain="true" onclick="delparams()">删除</a>
    </div>
</div>

<!--标准名称参数显示弹框开始-->
<div id="standarddlg" class="easyui-dialog" style="width:400px;height:300px;padding:10px" closed="true"  modal='true' buttons="#standard-buttons">
    <div style="padding:10px 20px 10px 30px;" id="standarddetail">
        <div style="padding-bottom:10px;white-space:nowrap;overflow:hidden">
            <label>标准 名称:</label>
            <span id="standardname"></span>
        </div>
    </div>
</div>
<div id="standard-buttons">
    <a href="javascript:void(0)"  class="easyui-linkbutton" iconCls="icon-cancel" onclick="$('#standarddlg').dialog('close');">关闭</a>
</div>
<!--标准名称参数显示弹框结束-->
<?php
$res = Commonmodel::Getcpnames();
?>
<!--标准名称参数添加弹框开始-->
<div id="appenddlg" class="easyui-dialog" style="width:500px;height:400px;padding:10px" closed="true"  modal='true' buttons="#append-buttons">
    <form id="paramsfm">
        <div style="padding:10px 0 10px 30px;" id="appendparams">
            <div style="padding-bottom:10px">
                <label>标准 名称:</label>
                <?php echo CHtml::dropDownlist('leafCategory', '', $res['cpnames'], array('class' => 'width302 select', 'id' => 'leafCategory', 'empty' => '请选择标准名称')); ?>
            </div>
            <div style="padding-bottom:10px">
                <label>参数名称1:</label>
                <input class="easyui-validatebox input" type="text" style="width:290px" maxlength="20" validType="paramrepeat[0]">
            </div>
            <div style="padding-bottom:10px">
                <label>参数名称2:</label>
                <input class="easyui-validatebox input" type="text" style="width:290px" maxlength="20" validType="paramrepeat[1]">
            </div>
            <div style="padding-bottom:10px">
                <label>参数名称3:</label>
                <input class="easyui-validatebox input" type="text" style="width:290px" maxlength="20" validType="paramrepeat[2]">
            </div>
            <div style="padding-bottom:10px">
                <label>参数名称4:</label>
                <input class="easyui-validatebox input" type="text" style="width:290px" maxlength="20" validType="paramrepeat[3]">
            </div>
            <div style="padding-bottom:10px">
                <label>参数名称5:</label>
                <input class="easyui-validatebox input" type="text" style="width:290px" maxlength="20" validType="paramrepeat[4]">
            </div>
        </div>
    </form>
</div>
<div id="append-buttons">
    <a href="javascript:void(0)"  class="easyui-linkbutton" iconCls="icon-add" onclick="addparamname()" id="addparamname">添加属性</a>
    <a href="javascript:void(0)"  class="easyui-linkbutton" iconCls="icon-save" onclick="addsave()" id="addsave">保存</a>
    <a href="javascript:void(0)"  class="easyui-linkbutton" iconCls="icon-cancel" onclick="$('#appenddlg').dialog('close');">关闭</a>
</div>
<!--标准名称参数显示添加结束-->

<!--用于下载的form表单开始-->
<div style="display: none">
    <form id="downloadfm" method="get">
        <input type="hidden" id="downloadid" name="standardid">
    </form>
</div>
<!--用于下载的form表单结束-->


<script>
    $.extend($.fn.validatebox.defaults.rules, { 
        paramrepeat: {
            validator:function(value,param){
                var params=new Array();
                var bool=true;
                $('#appendparams').find('input').each(function(k,v){
                    if($(this).val()!=''&&k<param[0])
                    {
                        params.push($(this).val());
                        if($.inArray(value,params)>-1)
                        {
                            bool=false;
                            return false;
                        }
                    }
                })
                return bool;
            },
            message:'参数名重复'
        }
           
    });
    //easyui datagrid无数据时显示默认值
    var datagridemptyview = $.extend({},$.fn.datagrid.defaults.view,{
        onAfterRender:function(target){
            $.fn.datagrid.defaults.view.onAfterRender.call(this,target);
            var opts = $(target).datagrid('options');
            var vc = $(target).datagrid('getPanel').children('div.datagrid-view');
            vc.children('div.datagrid-empty').remove();
            if (!$(target).datagrid('getRows').length){
                var d = $('<div class="datagrid-empty"></div>').html(opts.emptyMsg || 'no records').appendTo(vc);
                d.css({
                    position:'absolute',
                    left:0,
                    top:50,
                    width:'100%',
                    textAlign:'center'
                });
            }
        }
    });

    //加载标准名称参数列表
    $('#standardlists').datagrid({
        rownumbers:true,
        pagination:true,
        fitColumns:true,
        singleSelect:true,
        url:Yii_baseUrl +'/maker/standardparams/getstandardparamlists',
        method:'get',
        toolbar:'#toolbar',
        columns:[[
                {field:'name',title:'模板名称',width:100,formatter:function(value,row,index)
                    {
                        return '<a href=javascript:void(0) onclick=showparams('+row.id+',"'+row.name+'")>'+value+'</a>';
                    }},
                {field:'createtime',title:'创建时间',width:100}
            ]],
        view: datagridemptyview,
        emptyMsg: '暂无数据'
    })

    //显示标准名称参数
    function showparams(id,name)
    {
        //根据标准名称id查询标准名称参数
        $.ajax({
            url:Yii_baseUrl +'/maker/standardparams/getparams',
            dataType:'json',
            type:'POST',
            data:{'id':id,'extra':'extra'},
            success:function(res){
                var names=res.category.mainname+' - '+res.category.subname+' - '+name;
                var namehtml='<a title="'+names+'">'+names+'</a>';
                $('#standardname').html(namehtml);
                var html='';
                $.each(res.name,function(k,v){
                    html+='<div style="padding-bottom:10px"><label>参数名称'+(k+1)+':</label>&nbsp;<span>'+v+'</span></div>';
                })
                $('#standarddetail').append(html);
                //console.log(html);
            }
        })
        $('#standarddlg').dialog({
            title:'标准名称参数详情',
            closed:false
        })
    }

    //标准名称详情弹框关闭事件
    $('#standarddlg').dialog({
        onClose:function(){
            $("#standarddetail div").eq(0).nextAll().remove();
        }
    })

    //标准名称改变事件
    $('#leafCategory').change(function(){
        $('.easyui-dialog select').css('color','black');
        var standardid=$('#leafCategory').val();
        //查询标准名称是否存在
        $.ajax({
            url:Yii_baseUrl +'/maker/standardparams/querystandardexist',
            data:{'standardid':standardid},
            type:'POST',
            success:function(res){
                if(res==1)
                {
                    $.messager.alert('操作提示','标准名称参数已存在,请选择其他标准名称!','info');
                    $('#addparamname').linkbutton('disable');
                    $('#addsave').linkbutton('disable');
                }
                else
                {
                    $('#addparamname').linkbutton('enable');
                    $('#addsave').linkbutton('enable');    
                }
            }
        })
    })

    //添加标准名称参数弹框
    function addparams()
    {
        $('#appenddlg').dialog({
            title:'添加标准名称参数',
            closed:false,
            iconCls: 'icon-add'
        })    
        url=Yii_baseUrl +'/maker/standardparams/addstandardparam';
    }

    //添加标准名称参数个数
    function addparamname()
    {
        var add=1;//添加
        $('#appendparams').find('input').each(function(k,v){
            if($(this).val()=='')
            {
                $.messager.alert('操作提示','请先添加完页面参数名称!','info');
                add=2;//不添加
                return false;
            }
        })
        //表单验证
        if($('#paramsfm').form('validate')==false)
            return;
        if(add==2)
            return;
        var divcount=$('#appendparams').find('div').length;
        var html='';
        html+='<div style="padding-bottom:10px" id="div'+divcount+'"><label>参数名称'+divcount+':</label>&nbsp;<input class="easyui-validatebox input" type="text" style="width:290px;color:black" maxlength="20"></div>';
        $('#appendparams').append(html); 
        $('#div'+divcount+' input').validatebox({         
            validType:'paramrepeat['+(divcount-1)+']'
        }); 
    }

    //添加标准名称参数名弹框关闭事件
    $('#appenddlg').dialog({
        onClose:function(){
            $('#appendparams').find('input').val('');
            //标准名称设置选中
            $('#leafCategory').val('');
            $('#leafCategory').attr('disabled',false); 
            $('#addparamname').linkbutton('enable');
            $('#addsave').linkbutton('enable'); 
            $('#appendparams').find('input').removeClass('validatebox-invalid');
            if($("#appendparams div").length>6)
            {
                $("#appendparams div").eq(5).nextAll().remove();
            }
        },
        onOpen:function(){
            $('#appenddlg input').css('color','black');
        }
    })

    //保存标准名称参数
    function addsave()
    {
        //var standardname=$('#leafCategory').find("option:selected").text();
        var standardid=$('#leafCategory').val();
        if(standardid=='')
        {
            $.messager.alert('操作提示','请选择标准名称!','info');
            return false;
        }
        //表单验证
        if($('#paramsfm').form('validate')==false)
            return;
        var params=new Array();
        $('#appendparams').find('input').each(function(k,v){
            if($(this).val()!='')
            {
                params.push($(this).val());   
            }    
        })
        if(params.length==0)
        {
            $.messager.alert('操作提示','至少要填写一个参数名称!','info');
            return false;
        }
        var data=params.join(',');
        //保存参数名称
        $.ajax({
            url:url,
            dataType:'json',
            data:{'params':data,'standardid':standardid},
            type:'POST',
            success:function(res){
                if(res.msg=='ok')
                {
                    $.messager.show({
                        title:'操作提示',
                        msg:'添加成功!',
                        timeout:2000,
                        showType:'slide'
                    });
                    $('#appenddlg').dialog('close');
                    $('#standardlists').datagrid('reload'); 
                }
                else
                    $.messager.alert('操作提示','添加失败!','info');
                
            }
        })
    
    }

    //编辑标准名称参数
    var url;
    function editparams()
    {
        var row=$('#standardlists').datagrid('getSelected');
        if(!row)
        {
            $.messager.alert('操作提示','请先选中一条标准名称参数!','info');
            return;
        }
        $('#appenddlg').dialog({
            title:'编辑标准名称参数',
            closed:false,
            iconCls: 'icon-edit'
        })  
        //根据标准名称id查询标准名称参数
        $.ajax({
            url:Yii_baseUrl +'/maker/standardparams/getparams',
            dataType:'json',
            type:'POST',
            data:{'id':row.id,'extra':'extra'},
            success:function(res){
                $('#leafCategory').val(row.id).css('color','black').attr('disabled',true);
                if(res.name.length>5)
                {
                    var addcount=res.name.length-1;
                    for(var i=5;i<res.name.length;i++)
                    {
                        var html='';
                        var divcount=i+1;
                        html+='<div style="padding-bottom:10px" id="div'+divcount+'"><label>参数名称'+divcount+':</label>&nbsp;<input class="easyui-validatebox input" type="text" style="width:290px;color:black" maxlength="20"></div>';
                        $('#appendparams').append(html); 
                        $('#div'+divcount+' input').validatebox({         
                            validType:'paramrepeat['+(divcount-1)+']'
                        }); 
                    }
                }
                $('#appendparams').find('input').each(function(k,v){
                    $(this).val(res.name[k]);
                })
            }
        })
        url=Yii_baseUrl +'/maker/standardparams/updatestandardparam?standardid='+row.id;
    }

    //删除标准名称参数
    function delparams()
    {
        var row=$('#standardlists').datagrid('getSelected');
        if(!row)
        {
            $.messager.alert('操作提示','请先选中一条标准名称参数!','info');
            return;
        }
        if(row.count>0)
        {
            $.messager.alert('操作提示','此标准名称参数有对应商品无法删除!','info');
            return;
        }
        $.messager.confirm('操作提示','确定删除选中的标准名称参数',function(res){
            if(res)
            {
                $.ajax({
                    url:Yii_baseUrl +'/maker/standardparams/delstandardparam',
                    data:{'standardid':row.id},
                    type:'POST',
                    success:function(res)
                    {
                        if(res>0)
                        {
                            $.messager.show({
                                title:'操作提示',
                                msg:'删除成功!',
                                timeout:2000,
                                showType:'slide'
                            });
                            $('#standardlists').datagrid('reload'); 
                        }
                        else
                        {
                            $.messager.alert('操作提示','删除失败!','info');
                        }
                    }
                })
            }
        });
    
    }

    //    //下载标准名称参数
    //    function downloadparams()
    //    {
    //        var row=$('#standardlists').datagrid('getSelected');
    //        if(!row)
    //        {
    //            result=Yii_baseUrl +'/maker/standardparams/Download?standardid='+row.id;   
    //        }   
    //   
    //    if(result.length>0)
    //    {
    //        window.open(result,"_self");
    //    }  
    
    
    //下载标准名称参数
    function downloadparams()
    {
        var row=$('#standardlists').datagrid('getSelected');
        if(!row)
        {
            $.messager.alert('操作提示','请先选中一条标准名称参数!','info');
            return;
        }
        //ajax下载
        var result="";
        //        $.ajax({
        //            //  url:Yii_baseUrl +'/maker/standardparams/Downloadtemplate',
        //            url:Yii_baseUrl +'/maker/standardparams/Downgoodstemp',
        //            data:{'standardid':row.id,'name':row.name},
        //            type:'GET',
        //            async:false ,
        //            success:function(res)
        //            {
        //                result=Yii_baseUrl +'/maker/standardparams/Downgoodstemp?standardid='+row.id+'&name='+row.name;   
        //            }   
        //        })
        //        if(result.length>0)
        //        {
        //            window.open(result,"_self");
        //        }  
    
        //第二种:表单提交下载
        $('#downloadid').val(row.id);
        $('#downloadfm').form('submit',{
            url:Yii_baseUrl +'/maker/standardparams/downgoodstemp/name/'+row.name
        })
    
    }
</script>
