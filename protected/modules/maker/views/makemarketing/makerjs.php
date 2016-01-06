<script type="text/javascript">       
    var actionID='<?php echo $this->getAction()->getId(); ?>';
    $(document).ready(function(){
        $("#delAll").click(function(){
            var ids=new Array();
            var selected=$("#dg").datagrid("getSelections");
            if(selected.length>0){
                $.messager.confirm('提示框', '您确定要删除吗?',function(result){
                    if(result){
                        var i=0;
                        $.each(selected,function(key,val){
                            ids[i]=val.id;
                            i++;
                        });
                        var key=$("#delAll").attr("key");
                        $.getJSON("<?php echo Yii::app()->createUrl('common/delAll'); ?>",{ids:ids,key:key},function(result){
                            if(result==selected.length){
                                $.messager.alert('提示', '删除成功！',"info");
                                $("#dg").datagrid("reload");
                            }else{
                                $.messager.alert('提示', '删除失败！',"info");
                            }
                        })
                    }
                })
            }else{
                if(actionID=='empowerdealer'){
                    $.messager.alert('提示', '请选择经销商！',"info");
                }else if(actionID=='empowercate'){
                    $.messager.alert('提示', '请选择品类！',"info");
                }else if(actionID=='contacts'){
                    $.messager.alert('提示', '请选择联系人！',"info");
                }
            }
        });
        $("#modify").live('click',function(){
            var selected=$("#dg").datagrid("getSelections");
            if(selected.length>0){
                if(selected.length>1){
                    $.messager.alert('提示', '每次只能编辑一条数据！',"error");
                }else{
                    $.messager.confirm('提示框', '您确定要编辑吗?',function(result){
                        if(result){
                            var selected=$("#dg").datagrid("getSelected");
                            if(actionID=='empowerdealer'){
                                window.location.href="<?php echo Yii::app()->createUrl('maker/makemarketing/addempdea'); ?>/id/"+selected.id;
                            }else{
                                window.location.href="<?php echo Yii::app()->createUrl('maker/makemarketing/add'); ?>"+actionID+"/id/"+selected.id;
                            }
                        }
                    })
                }
            }else{
                if(actionID=='empowerdealer'){
                    $.messager.alert('提示', '请选择经销商！',"info");
                }else if(actionID=='empowercate'){
                    $.messager.alert('提示', '请选择品类！',"info");
                }else if(actionID=='contacts'){
                    $.messager.alert('提示', '请选择联系人！',"info");
                }
            }
        })
    })
</script>