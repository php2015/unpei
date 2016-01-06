<div id="dlg" class="easyui-dialog" style="width:600px; height:300px;padding:10px 20px;"
     closed="true" buttons="#dlg-price" modal="true">
    <form id="fm" method="post">
        <p class="form-row" >
            <label>物流公司名称：</label>
            <input id="LogisticsCompany" type="text" name="LogisticsCompany"  data-options="required:true,validType:'length[1,15]'" class="easyui-validatebox  width213 input">
        </p>
        <p class="form-row" >
            <label>物流公司描述：</label>
            <input id="LogisticsDescription" type="text" name="LogisticsDescription" class="easyui-validatebox  width213 input">
        </p>
        <p class="form-row">
            <label>物流配送地区：</label>
            <?php
            $state_data = Area::model()->findAll("grade=:grade", array(":grade" => 1));
            $state = CHtml::listData($state_data, "id", "name");
            $s_default = $model->isNewRecord ? '' : $search['province'];
            echo CHtml::dropDownList('sprovince', $s_default, $state, array(
                'empty' => '请选择省',
                'class' => 'width114 select',
                'ajax' => array(
                    'type' => 'GET',
                    'url' => Yii::app()->request->baseUrl . '/common/dynamiccities',
                    'update' => '#scity',
                    'data' => 'js:"province="+jQuery(this).val()',
                    ))
            );
            $c_default = $model->isNewRecord ? '' : $search['city'];
            if (!$model->isNewRecord) {
                $city_data = Area::model()->findAll("parent_id=:parent_id", array(":parent_id" => $search['province']));
                $city = CHtml::listData($city_data, "id", "name");
            }
            $city_update = $model->isNewRecord ? array() : $city;
            echo CHtml::dropDownList('scity', $c_default, $city_update, array(
                'empty' => '请选择市',
                'class' => 'width114 select',
                'ajax' => array(
                    'type' => 'GET',
                    'url' => Yii::app()->request->baseUrl . '/common/dynamicdistrict', //url to call
                    'update' => '#sarea',
                    'data' => 'js:"city="+jQuery(this).val()',
                    ))
            );
            $d_default = $model->isNewRecord ? '' : $search['area'];
            if (!$model->isNewRecord) {
                $district_data = Area::model()->findAll("parent_id=:parent_id", array(":parent_id" => $search['city']));
                $district = CHtml::listData($district_data, "id", "name");
            }
            $district_update = $model->isNewRecord ? array() : $district;
            echo CHtml::dropDownList('sarea', $d_default, $district_update, array(
                'empty' => '请选择区',
                'class' => 'width114 select'
            ));
            ?>
            <span id='addRess' class="btn" style="cursor:pointer">添加</span>
        </p>
        <p class="fitem showAddress" id="showAddress"><!-- 显示地址 -->
            <label class=label></label>
        </p>
    </form>
    <div id="dlg-price">
        <a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-ok" id="save-btn" onclick="saveLogistics()">保存</a>
        <a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-cancel" onclick="deleteGoods()">取消</a>
    </div>
</div>
<div id="check_dlg" class="easyui-dialog" style="width:600px; height:300px;padding:10px 20px;"
     closed="true" buttons="#dlg-price" modal="true">
    <form id="fm" method="post">
        <p class="form-row" >
            <label>公司名称：</label>
            <span name="LogisticsCompany"></span>
        </p>

        <p class="form-row" >
            <label>物流描述：</label>
            <span name="LogisticsDescription"></span>
        </p>

        <p class="form-row">
            <label>配送地区：</label>
            <span name="Address"></span>
        </p>

        <p class="form-row" >
            <label>创建时间：</label>
            <span name="CreateTime"></span>
        </p>

    </form>
    <div id="dlg-price">
        <a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-cancel" onclick="deleteCheck_dlg()">取消</a>
    </div>



</div>
<script>
    var url="";
    $("#sprovince").change(function(){
        if($(this).val()){
            var province=$(this).val();
            $.getJSON(Yii_baseUrl+'/common/dynamicarea',{province:province},function(data){
                if(data!=''){
                    $("#sarea").empty();
                    $.each(data, function(key,val){      
                        jQuery("<option value='"+key+"'>"+val+"</option>").appendTo("#sarea");
                    }); 
                }
            });
        }else{
            $("#sarea").empty();
            $("<option value=''>请选择地区</option>").appendTo("#sarea");
        }
    });
    //添加地址按钮
    function newLogistics(){ 
        $('#fm').form('reset');
        $("#showAddress").empty();
        $("select[name=scity]").empty();
        $("select[name=scity]").html("<option>请选择市</option>");
        $("select[name=sarea]").empty();
        $("select[name=sarea]").html("<option>请选择区</option>");
        url = Yii_baseUrl+"/cim/logistics/addlogistics";
        $('#dlg').dialog('open').dialog('setTitle','添加物流');
    }
    //保存添加
    function saveLogistics(){
        var address = $("#showAddress").find("span").text();
        if( address == ''){
            $.messager.alert("提示", "请添加物流配送地区!", "warning");
            return false;
        }
        $('#fm').form('submit',{
            url:url,
            onSubmit: function(){
                return $(this).form('validate');
            },
            success: function(result){
                var result = eval('('+result+')'); 
                if(result.success){
                    $.messager.show({ title: '提示信息',msg: result.errorMsg});
                    $('#dlg').dialog('close'); 
                    $('#dg').datagrid('reload');
                } else {
                    $.messager.show({ title: '提示信息',msg: result.errorMsg});
                }
            }
        }); 
    }
    //取消添加
    function deleteGoods(){
        $('#dlg').dialog('close');
    }   
    //取消查看详情
    function deleteCheck_dlg(){
        $('#check_dlg').dialog('close');
    }   
    //删除地址
    function delLogistics(){ 
        var ids = [];
        var row = $('#dg').datagrid('getSelections');
        for(var i=0; i<row.length; i++){
            //alert(i);
            ids.push(row[i].ID);
        }
        if (row.length > 0){
            $.messager.confirm('提示信息','你确定要把选中的这条数据删除吗？',function (r){
                if (r){
                    var url = Yii_baseUrl+"/cim/logistics/Deletelogistics";
                    $.getJSON(url,{ID:ids.join(',')},function(result){
                        if (result.success){
                            $.messager.show({ // show error message
                                title: '提示信息',
                                msg: result.errorMsg
                            });
                            $('#dg').datagrid('reload'); // reload the user data
                        } else {
                            $.messager.show({ // show error message
                                title: '提示信息',
                                msg: result.errorMsg
                            });
                        }
                    },'json');
                }
            });
        }else{
            $.messager.alert('提示信息','您还没有选择数据！','error');
        }
    }
    //编辑物流信息
    function editLogistics(){ 
        var row = $('#dg').datagrid('getSelections');
        if(row.length <1){
            $.messager.alert('提示信息','您还没有选择数据！','error');
            return false;
        } else if(row.length>=2){
            $.messager.alert('提示信息','只能选择一条数据编辑！','error');
            return false;
        } 
        if (row){
            $('#dlg').dialog('open').dialog('setTitle','修改物流信息');
            $('#fm').form('load',row[0]);
            url =Yii_baseUrl+"/cim/logistics/updatelogistics/ID/"+row[0].ID; //获取要编辑的id数据
            $("#showAddress").empty();
            var geturl = Yii_baseUrl +"/cim/logistics/Getaddlogs";   //获取弹框的地址
            $.getJSON(geturl,{ID:row[0].ID},function(data){
                if(data){
                    $.each(data,function(index,val){
                        var span = "<span  class='showAddressleng checkbox-add checkbox-add2 bg-green tag-close catespan' style='display:block;float:left;height:15px;line-height:15px;margin-bottom:3px;'>"+val.add+"<span onclick='xxADDRESS(this)' key="+val.ID+" style='cursor:pointer;font-size: 9px;font-family: Georgia;'>&nbsp;&nbsp;&nbsp;X</span></span> ";
                        $("#showAddress").append(span); 
                    })
                }
            });
        }else{
            $.messager.alert('提示信息','您还没有选择数据！','error');
        }
    } 
    //查看详情
    function checkDetails(){ 
        var row = $('#dg').datagrid('getSelections');
        
        if(row.length <1){
            $.messager.alert('提示信息','您还没有选择数据！','error');
            return false;
        } else if(row.length>=2){
            $.messager.alert('提示信息','只能选择一条数据查看！','error');
            return false;
        } 
        
        if (row) {
            var ID = row[0].ID.toString();
            $('#check_dlg').dialog('open').dialog('setTitle','查看物流信息');
            $("span[name=LogisticsCompany]").text(row[0].LogisticsCompany);
            $("span[name=LogisticsDescription]").text(row[0].LogisticsDescription);
            $("span[name=Address]").text(row[0].AddressDetail);
            $("span[name=CreateTime]").text(row[0].CreateTime); 
        }
        else {
            $.messager.show({
                title: '警告',
                msg: '请选择您要查看的物流信息!'
            });
        }	
    } 
    //弹框添加地区
    $('#addRess').click(function(){ 
        var provinceval = $("#sprovince").val(); //下拉框的数字值 120000
        var cityval =  $("#scity").val();
        var areaval=  $("#sarea").val();
        var sprovince=$("#sprovince option:selected").text(); //下拉框文本值
        var scity=$("#scity option:selected").text();
        var sarea=$("#sarea option:selected").text();
        if(sprovince=="请选择省"){
            $.messager.alert('提示信息','请选择省份！');
            return false;
        }
        else if(scity=="请选择市"){
            $.messager.alert('提示信息','请选择市！');
            return false;
        }
        else if(sarea=="请选择区"){
            $.messager.alert('提示信息','请选择区！');
            return false;   
        }
        else{  
            var al='';
            $("#showAddress span.catespan").each(function(){
                var add=$(this).find('span[name=sarea]').html();
                if(sarea==add){
                    al='此地址您已添加，不可重复添加！';
                }
            })
            if(al == ''){
                var span = '';
                span += "<span class='checkbox-add checkbox-add2 bg-green tag-close catespan' id='a"+provinceval+"' style='display:block;float:left;height:15px;line-height:15px;margin-bottom:3px;'> <span name='sprovince'>"+sprovince+"</span>  <span name='scity'>"+scity+"</span>  <span name='sarea'>"+sarea+"</span>  <input type='hidden' value="+provinceval+" name='province[]'><input type='hidden' value="+cityval+" name='city[]'><input type='hidden' value="+areaval+" name='area[]'>  <span onclick='xxADDRESS(this)' key='0' style='cursor:pointer;font-size: 9px;font-family: Georgia;'>　X</span></span> ";
                $("#showAddress").append(span);
            }else{
                alert(al);
            }       
        }
    })
    //删除弹框地址
    function xxADDRESS(obj){
        var ID = obj.getAttribute("key");
        ID = parseInt(ID);
        if(ID){
            var url ="<?php echo Yii::app()->createUrl('cim/logistics/Deletelogaddress'); ?>";
            $.getJSON(url,{ID:ID},function(data){
                if(data == 1)
                    $(obj).parent().remove();
            });
        }else{
            $(obj).parent().remove();
        }
    }
</script>