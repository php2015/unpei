<style type="text/css">
    .dacategory{width: 680px;}
    .dacategory select{ margin-right: 8px;}
    .width50 { width: 50px;}
    .width30 { width: 30px;}
    .width100 { width: 100px;}

    .checkbox-add{ line-height: 20px;}
    .checkbox-add2 {
        /*    border: 1px solid;*/
        float: left;
        line-height: 18px;
        margin-bottom: 5px;
        margin-left: 5px;
        width: 150px;
        padding-right: 5px;
    }
    #fm{margin:0;padding:10px 30px;}
    .ftitle{font-size:14px; font-weight:bold; padding:5px 0;margin-bottom:10px; border-bottom:1px solid #ccc;}
    .fitem{   margin-bottom:5px;  }
    .fitem label{display:inline-block;  width:54px;  }
    .form-row{  margin:5px 0; }
    #file_upload{margin-left:60px;}
    #file_uploaddetc{margin-left:60px; margin-top:2px;}
    #showimglist img { margin-left:5px;}

    .showVehicle {
        /*border: 1px solid;*/
        display: block;
        height: auto;
        overflow: hidden;
    }

    .show_yearmodel{ height: 200px; overflow-y:scroll; display: none; position: absolute; z-index: 21000; width: 240px; left:-70px;top:205px;   background: #fff; border:1px solid green;}
    .show_yearmodel li {
        /*    border: 1px solid #FF0000;*/
        line-height: 20px;
        margin-bottom: 2px;
        padding-left: 5px;
        width: 218px; 
        overflow: hidden;
    }

</style>

<!--

<div style='width:300px'>
    <span class='checkbox-add bg-white tag-close catespan' id='car1' onclick='oncar(\"#car1\")' style='position:relative;'><span name='make'>"+make+"</span> <span name='car'>"+cart+"</span> <span id='car1a' year='"+yearval+"' model='"+modelval+"' style='visibility:hidden;position:absolute;top:20px; left:0px;width:200px'  ><span class='checkbox-add bg-white tag-close catespan'><span name='year'>"+yeart+"</span> <span name='model'>"+modelt+"</span><span onclick='xxVehicle(this)' key='0' style='cursor:pointer;font-size: 9px;font-family: Georgia;'>　X</span><input type='hidden' value="+makeval+" name='make[]'><input type='hidden' value="+carval+" name='car[]'><input type='hidden' value="+yearval+" name='year[]'><input type='hidden' value="+modelval+" name='model[]'><input type='hidden' value="+make+" name='maketext[]'><input type='hidden' value="+car+" name='cartext[]'><input type='hidden' value="+year+" name='yeartext[]'><input type='hidden' value="+model+" name='modeltext[]'></span></span></span>
</div>-->


<div id="dlg" class="easyui-dialog" style="width:830px;height:620px;padding:10px 0px 10px 5px" modal="true" closed="true" buttons="#dlg-buttons">
    <form id="fm" method="post" novalidate style="width: 730px" style="border:1px solid red">
        <div class="form-row" style="float:left; width: 200px">
            <label>商品名称:</label>
            <input name="Name" class="easyui-validatebox input" validType='length[1,30]' required="true">
        </div>

        <div class="form-row" style="float:left;width: 200px;">
            &nbsp; &nbsp;<label>商品拼音:</label>
            <input name="Pinyin" id="pinyincode" class="easyui-validatebox input  width100" value="" >
        </div>
        <div class="form-row" style=" width: 200px;float:left; ">
            <label>商品编号:</label>
            <input name="GoodsNO" id="GoodsNo" class="easyui-validatebox input width100" value="" required="true">
        </div>
        <div style=" clear: both"></div>
        <div class="form-row" style=" width: 200px;float:left;">
            <label>参考价格:</label>
            <input name="Price" class="easyui-validatebox input  width100" required="true" validType='floatnum'>
        </div>

        <div class="form-row" style=" width: 200px;float:left;">
            &nbsp; &nbsp;<label>物流价格:</label>
            <input type="text" name="LogisticsPrice" validType="floatnum" value="0.00"  class="easyui-validatebox  width50 input"><label class="unittext">元</label>
        </div> 

        <div style=" width: 150px; border: none; float: left; height: 10px; padding-top: 10px">
            &nbsp; &nbsp;&nbsp;<label>上架:</label>
            <select class="select" name="IsUpSale">
                <option value="1">上架</option>
                <option value="0">下架</option>
            </select>
        </div>     
        <div style=" clear: both"></div>     
        <p class="form-row dacategory">
            <label>配件品类:</label>
            <input id="cpname-select" name="CpNameTxt" class=" input width260" type="text" value="" style="width:260px;">
            <span id="helpcate" ><img src="<?php echo F::themeUrl() ?>/images/help.png" style=" margin-left:0px;  margin-top: 0px;cursor: pointer"></span>
            <?php // $this->widget('widgets.default.WGcategory', array('requred' => 'Y')); ?>
           <!--<input type="hidden" name="CpNameTxt" id="CpNameTxt">-->
        </p>
<!--                        <p class="fitem" id="showcpname"> 显示车系车型 
            <label class=label></label>
        </p>-->
        <p class="form-row dacategory" >
            <label>适用车系:</label>
            <?php //$this->widget('widgets.default.WFrontModel'); ?>
            <?php $this->widget('widgets.default.WGoodsModel', array('scope' => 'front', 'notlink' => 'N')); ?>
            <span id='addVehcle' class="btn" style="cursor:pointer">添加</span>
            <input type="hidden" id="make_hidden" value="0" name="make_hidden">
            <input type="hidden" id="make" name="make">
            <input type="hidden" id="car" name="car">
            <input type="hidden" id="year" name="year">
            <input type="hidden" id="model" name="model">
            <input type="hidden" id="maketxt" name="maketxt">
            <input type="hidden" id="cartxt" name="cartxt">
            <input type="hidden" id="modeltxt" name="modeltxt">
        </p>
        <p class="fitem showVehicle" id="showVehicle"><!-- 显示车系车型 -->
            <label class=label></label>
        </p>
        <p class="fitem" style=" float: left;">
            &nbsp;<label style="width: 35px;padding-left: 14px">OE号:</label>
            <input type="text" name="OENO" id="OENOValue" class="width50 input">
            <span id='addOENO' class="btn" style="cursor:pointer">添加</span>
        </p>

        <p class="fitem" style="float: left">
            &nbsp;
            <label>商品品牌:</label>
            <?php
            $organID = Commonmodel::getOrganID();
            $brandNames = DealerBrand::model()->findAll("OrganID = $organID");
            $brandName = CHtml::listData($brandNames, 'ID', 'BrandName');
            echo CHtml::dropDownList('goodsBrand', 'goodsBrand', $brandName, array(
                'class' => 'width110 select ',
                'empty' => '选择商品品牌',
            ));
            ?>	
            <input type="hidden" name="brandID">
        </p>
        <p class="fitem" >
            &nbsp;
            <label>配件级别:</label>
            <input type="text" name="PartsLevel" class="width100 input">
        </p>
        <div style="height: 5px;"></div>
        <div style=" clear: both"></div>
        <p class="fitem showVehicle" id="showOENO" ><!-- 显示OENO --></p>
        <p class="fitem" style=" float: left">
            <label>标杆品牌:</label>
            <input type="text" name="BganCompany" class="width100 input">
            &nbsp;&nbsp;
        </p>

        <p class="fitem">
            <label style=" width: 70px">标杆商品号:</label>
            <input type="text" name="BganGoodsNO" class="width100 input">
            &nbsp;&nbsp;&nbsp;<label>商品规格:</label>
            <input type="text" name="Specifica" class="width100 input">
            &nbsp;&nbsp;
        </p>
        <div style="height: 5px;"></div>
        <p class="fitem" style=" float: left">
            商品单位:
            <?php
            $organID = Commonmodel::getOrganID();
            $UnitNames = DealerGoodsUnit::model()->findAll("OrganID = $organID");
            $UnitName = CHtml::listData($UnitNames, 'UnitName', 'UnitName');
            echo CHtml::dropDownList('Unit', 'Unit', $UnitName, array(
                'class' => 'width112 select easyui-validatebox',
                'empty' => '选择商品单位',
                'required' => "true",
            ));
            ?>	
            <!--<input type="text" name="Unit" class="width50 input">-->
            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;长度:
            <input type="text" name="Length" validType='floatnum' class="easyui-validatebox  width50 input"> cm
            &nbsp;&nbsp;
        </p>
        <p class="fitem" style=" float: left">
            <label>商品重量:</label>
            <input type="text" name="Weight" validType='floatnum' class="easyui-validatebox  width50 input"> kg
            &nbsp;
        </p>
        <p class="fitem">
            保修期:
            <select class='select' name="ValidityType" id="ValidityID">
                <option value="1">不保修</option>
                <option value="2">保装车</option>
                <option value="3">保几月</option>
            </select>
            <span class="validityshow" style="display:none"><input type="text" name="ValidityDate" validType="monthss"  class="easyui-validatebox  width30 input"> 月</span>

        </p>
        <p class="fitem" style=" float: left">
            <label style="width: 30px; padding-left: 23px">宽度:</label>
            <input type="text" name="Wide" validType='floatnum' class="easyui-validatebox  width50 input"> cm
            &nbsp;&nbsp;
        </p>     
        <p class="fitem" style=" float: left; margin-left: 50px">
            &nbsp;高度:
            <input type="text" name="Height" validType='floatnum' class="easyui-validatebox  width50 input"> cm
            &nbsp;&nbsp; &nbsp;&nbsp; 
        </p>
        <p class="fitem">
            &nbsp;体积:
            <input type="text" name="Volume" validType='floatnum' class="easyui-validatebox  width50 input"> m³
            &nbsp;&nbsp;
        </p>
        <div style="height: 5px;"></div>
        <p class="fitem" style="float:left; margin-right:30px">
            <label>包装重量:</label>
            <input type="text" name="pWeight" validType='floatnum' class="easyui-validatebox  width50 input"> kg
        </p>
        <p class="fitem" style="float:left;">
            &nbsp;最小包装数:
            <input type="text" name="MinQuantity" validType="number"  class="easyui-validatebox  width50 input">
            &nbsp; 
        </p>
        <p class="fitem">
            &nbsp;&nbsp;&nbsp;&nbsp;包装体积:
            <input type="text" name="pVolume" validType='floatnum' class="easyui-validatebox  width50 input"> m³
        </p>
        <div style="height: 5px;"></div>
        <p class="fitem" style=" clear: both">
            <label >特征说明:</label>
            <textarea name="Memo" rows="2" cols="70" validType='length[1,200]' class="easyui-validatebox textarea"></textarea>
        </p>  
        <p class="fitem">
            <label style="width: 400px; padding-left: 23px; line-height: 24px;">图片:(上传的图片格式应为gif、jpg、png、jpeg,最佳大小为350px*350px)</label>
        <div class="form-row" >
            <input type='file' name='file_upload' id="file_upload">
            <input type="hidden" value="上传" id="file-upload-start">
            <input type="hidden" name="urlimg" value="" id="imgupload">
            <!--        <label>	<a class="btn"  href="javascript:$('#file_upload').uploadify('upload','*')">上   传</a>
                        <a href="javascript: $('#file_upload').uploadify('cancel','*')">清除所有</a></label>-->
            <p id='hidden_upnames'></p>
            <p class="form-row" id="showimglist" style=" position: relative;"> </p>       <!--显示上传的图片-->

        </div>
        <!--            <span id='' class="btn" style="cursor:pointer"><span style="font-size:12px">上传商品图片</span></span>-->
<!--        <span id='' class="btn" style="cursor:pointer"><span style="font-size:12px">上传检测图像</span></span>-->
        <div class="form-row" >
            <input type='file' name='file_uploaddetc' id="file_uploaddetc">
            <input type="hidden" value="上传" id="file-upload-start-detc">
            <!--        <label>	<a class="btn"  href="javascript:$('#file_upload').uploadify('upload','*')">上   传</a>
                        <a href="javascript: $('#file_upload').uploadify('cancel','*')">清除所有</a></label>-->
            <p class="form-row" id="showimglist-detc"  style=" position: relative;" > </p>       <!--显示上传的图片-->

        </div>
        </p>
    </form>
</div>
<!--<div class="show_yearmodel" id="show_yearmodel" >
    <ul id="yealmodel_list">
        <li>12312434</li>
        <li>12312434</li>
        <li>12312434</li>
    </ul>
</div>-->
<div id="dlg-buttons">
    <a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-ok" onclick="saveGoods()" id="saveGoods">保存</a>
    <!--<a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-cancel" onclick="javascript:$('#dlg').dialog('close')">取消</a>-->
    <a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-cancel" onclick="deleteGoods()">取消</a>
</div>



<script type="text/javascript" src='<?php echo F::themeUrl(); ?>/js/uploadify/jquery.uploadify.js'></script>
<link rel="stylesheet" href="<?php echo F::themeUrl(); ?>/js/uploadify/uploadify.css">
<?php include_once 'uploadimgjs.php'; ?>
<script>
    var countSelf = false;
    var goodsID = 0;
    //关闭商品的弹窗时触发
    function cleanUp(){
        car_id=0;//清除保存的前一次点击适用车系ID  
        $("#saveGoods").linkbutton('enable');//取消保存按钮的禁用
        //取消商品编号不可修改
        $('#GoodsNo').attr('onfocus','');
        //让适用车系变成默认状态
        $('#front_make').attr('value','');
        $('#front_make').change();
    }
  
    function deleteGoods(){
        $('#dlg').dialog('close');
        $('.show_yearmodel').hide();
    }
    
    $(function(){
        $("#ValidityID").change(function(){
            var vtype =  $(this).val();
            if(vtype == 3){
                $('.validityshow').show();
            } else{
                $('.validityshow').hide();
            }
        });
        
        $("input[name=Name]").blur(function(){
            var name = $(this).val();
            var url = Yii_baseUrl+'/dealer/marketing/Getpinyin';
            $.getJSON(url,{name:name},function(a){
                $("#pinyincode").val(a);
            })
        })
    });
</script>
<script type="text/javascript">
    $(document).scroll(function () {
        $('.show_yearmodel').hide();
    })
     
    $('.show_yearmodel').live('mouseleave',function(){
        $(this).hide();
    });
    $('.show_yearmodel').live('mouseover',function(){
        $(this).show();
    });
    //     $('.checkbox-add2').live('mouseout',function(){
    //        var carID = $(this).attr('carid');
    //        $("#div_"+carID).hide();
    //     });
    $('.show_yearmodel li').live('mouseover',function(){
        $(this).css({'color':'green'});
    });
    $('.show_yearmodel li').live('mouseleave',function(){
        $(this).css({'color':'grey'});
    });

        
    var addurl;
    function newGoods(){
        cleanUp();
        //  loaduploadgoods();
        //   $("#subCategory").empty();
        //  $("#subCategory").append("<option value=''>请选择子类</option>");
        //   $("#subCategory").attr('value','')
        //   $("#leafCategory").empty();
        //  $("#leafCategory").append("<option value=''>请选择标准名称</option>");
        //  $("#leafCategory").attr('value','')
        
        // $("#mainCategory").change(function(){
        //    $("#subCategory").change();
        //     $("#leafCategory").change();
        // });
        
        $("#front_series").empty();
        $("#front_series").append("<option value=''>请选择车系</option>");
        $("#front_series").attr('value','')

        
        
        $("#showVehicle").empty();
        $(".validityshow").hide();
        $("#showOENO").empty();
        $("#showimglist").empty();
        $("#showimglist-detc").empty();
        $(".inputfile-input span").html('');
        $("#goodsImage").remove();
        $('#dlg').dialog('open').dialog('setTitle','添加商品');
        $('#fm').form('reset');
        addurl = Yii_baseUrl+"/dealer/marketing/Add";
    }
    function editGoods(){
        cleanUp();
        //商品编号不可修改
        $('#GoodsNo').attr('onfocus','this.blur()');
        //         $('#GoodsNo').attr("disabled","disabled");
        // loaduploadgoods();
        $(".inputfile-input span").html('');
        //var row = $('#dg').datagrid('getSelected');
        var row = $('#dg').datagrid('getSelections');
        if(row.length <1){
            $.messager.alert('提示信息','您还没有选择数据！','error');
            return false;
        } else if(row.length>=2){
            $.messager.alert('提示信息','只能选择一条数据编辑！','error');
            return false;
        } 
        $("#front_series").empty();
        $("#front_series").append("<option value=''>请选择车系</option>");
        $("#front_series").attr('value','');
        if (row){
            if(row[0].ValidityType == 3){
                $(".validityshow").show();
            }else{
                $(".validityshow").hide();
            }
            setTimeout(" $('#dlg').dialog('open').dialog('setTitle','修改商品信息');",500);
            $("input[name=brandID]").val(row[0].Brand);
            // row[0].ImageUrl = row[0].ImageUrl;
            $('#fm').form('load',row[0]); 
            //$("#mainCategory").attr("subc",row[0].subCategory);
            //$("#mainCategory").attr("lefc",row[0].leafCategory);
            //  $("#mainCategory").change();
            // 查询该商品的车系
            $("#showVehicle").empty();
            var vehurl = Yii_baseUrl +"/dealer/marketing/Getvehbygoodsid";
            goodsID = row[0].ID;
            $.getJSON(vehurl,{id:row[0].ID},function(data){
                if(data){
                    var make_hidden =0;
                    $.each(data,function(index,val){
                        make_hidden += ',' + val['Make']; 
                        //make_hidden.push(val['Make']); 
                        var span = '';
                        span += "<span carID='"+val['CarID']+"' class='checkbox-add checkbox-add2 bg-white tag-close catespan' id='a"+val['CarID']+"' ><span name='make'>"+val['Make']+"</span> <span name='car'>"+val['Car']+"</span></span> ";
                        span +="<div class='show_yearmodel'  id=div_"+val['CarID']+">";
                        span +="<ul id=ul_"+val['CarID']+">";
                        $.each(val['Carlist'],function(index,value){
                            if(value.Year !='undefined' || value.Modeltxt !='undefined'){
                                span += "<li><span name='Year'>"+value.Year+"</span><span name='Model'>"+value.Modeltxt+"</span><span onclick='xxVehicle(this)' key='"+value.ID+"' style='padding-right:10px;float:right;cursor:pointer;font-size: 9px;font-family: Georgia;'>　X</span></li>";
                            }
                        });
                        span += "</ul>";
                        span += "</div>";
                        $("#showVehicle").append(span);
                    })
                    $("#make_hidden").val(make_hidden);
                }
                //   alert(make_hidden);
            });
            // 显示OE号
            $("#showOENO").empty();
            var oenourl = Yii_baseUrl +"/dealer/marketing/getoenobygoodsid";
            $.getJSON(oenourl,{id:row[0].ID},function(data){
                if(data){
                    $.each(data,function(index,val){
                        var span = "<span class='checkbox-add bg-green tag-close catespan'><input type='hidden' value="+val['OENO']+" name='OENOS[]'><span name='model'>"+val['OENO']+"</span><span onclick='xxOENO(this)' key="+val['ID']+" style='cursor:pointer;font-size: 9px;font-family: Georgia;'>　X</span></span>";
                        $("#showOENO").append(span);
                    })
                }
            });
            $("#goodsImage").remove();
            var themurl = "<?php echo F::themeUrl() ?>"+"/images/icons/icon-red-cross.png";
            var imgurl = " <?php echo F::uploadUrl(); // $url = F::baseUrl() . '/upload/dealer/';                    ?>";
            if(row && row[0].ImageUrl){
                $("<div id='goodsImage'> <img style='width:98px;height:98px;' src="+imgurl+row[0].ImageUrl+" ><span id='xxx'><img onclick='xximage(this)' src="+themurl+" key="+row[0].ImageUrl+"></span></div>") .appendTo("#showImage");
            }
            
            //显示图片列表 showimglist
            $("#showimglist").empty();
            var imageurl = Yii_baseUrl +"/dealer/marketing/Geturl";
            $.getJSON(imageurl,{GoodsID:row[0].ID},function(data){
                if(data){
                    $.each(data,function(index,val){
                        var span = "<span class='showimages'><img  style='width:80px;height:80px;' src="+imgurl+val['ImageUrl']+"><span onclick='xximage(this)' key="+val['ImageUrl']+" class='close icon-close-green xx' name='urlimg' imgname="+val['ImageName']+"></span></span>";
                        $("#showimglist").append(span);
                    })
                }
            });
            // 检测图片
            $("#showimglist-detc").empty();
            if(row && row[0].DetectionImg){
                var spandetc = "<span class='showimages'><img  style='width:80px;height:80px;' src="+imgurl+row[0].DetectionImg+"><span onclick='xximagedetc(this)' tag="+row[0].ID+" key="+row[0].DetectionImg+" class='close icon-close-green xx'></span></span>";
                $("#showimglist-detc").append(spandetc);
            }
            addurl =Yii_baseUrl+"/dealer/marketing/Update/id/"+row[0].ID;
        }else{
            $.messager.alert('提示信息','您还没有选择数据！','error');
        }
    }
    function saveGoods(){
        var urlimg=0;
        $("#showimglist .showimages").each(function(){
            if($(this).find('span[add=add]').attr('key')){
                urlimg += ','+$(this).find('span[name=urlimg]').attr('key');
                urlimg += ';'+$(this).find('span[name=urlimg]').attr('imgname');
            }       
        })
        $("#imgupload").val(urlimg);
        if($("#ValidityID").val() ==3){
            if(!$("input[name=ValidityDate]").val()){
                $.messager.show({title: '错误信息', msg: '保质期不能为空！'});
                return false; 
            }
        }
        //        var cpname = $("#leafCategory :selected").text();
        //        $("#CpNameTxt").val(cpname);
        //        var mainCategory = $("select[name=mainCategory]").val();
        //        if(mainCategory ==null || mainCategory == ''){
        //            $("select[name=leafCategory]").attr('title','配件品类不能为空');
        //            $.messager.show({title: '错误信息', msg: '配件品类不能为空'});
        //            return false;
        //        }
        //        var unit = $("select[name=Unit]").val();
        //        if(unit==''){
        //            $.messager.show({title: '错误信息', msg: '商品单位不能为空'});
        //            return false;
        //        }
        //        var goodsname = $("input[name=Name]").val();
        //        if(goodsname==''){
        //            $.messager.show({title: '错误信息', msg: '商品名称不能为空'});
        //            return false;
        //        }
        //        var GoodsNO = $("input[name=GoodsNO]").val();
        //        if(GoodsNO==''){
        //            $.messager.show({title: '错误信息', msg: '商品编号不能为空'});
        //            return false;
        //        }
        //        var Price = $("input[name=Price]").val();
        //        if(Price==''){
        //            $.messager.show({title: '错误信息', msg: '参考价格不能为空'});
        //            return false;
        //        }
        //        var mainCategory = $("select[name=mainCategory]").val();
        //        if(mainCategory==''){
        //            $.messager.show({title: '错误信息', msg: '配件品类不能为空'});
        //            return false;
        //        }
        //$("#saveGoods").linkbutton('disable');
        var make=0;
        var car=0;
        var year=0;
        var model=0;
        var maketxt=0;
        var cartxt=0;
        var modeltxt=0;
        $("#showVehicle li").each(function(){
            make += ','+$(this).find('span[name=make]').html();
            car += ','+$(this).find('span[name=car]').html();
            year += ','+$(this).find('span[name=year]').html();
            model += ','+$(this).find('span[name=model]').html();
            maketxt += ','+$(this).find('span[name=maketext]').html();
            cartxt += ','+$(this).find('span[name=cartext]').html();
            modeltxt += ','+$(this).find('span[name=modeltext]').html();
        })
        $("#make").val(make);
        $("#car").val(car);
        $("#year").val(year);
        $("#model").val(model);
        $("#maketxt").val(maketxt);
        $("#cartxt").val(cartxt);
        $("#modeltxt").val(modeltxt);
        //  $("#make_hidden").val(make);

        $('#fm').form('submit',{
            url: addurl,
            onSubmit: function(){ 
                var bvdate = $(this).form('validate');
                if(bvdate){
                    $("#saveGoods").linkbutton('disable');
                }
                return bvdate;
                //  return $(this).form('validate');
            },
            success: function(result){
                $("#saveGoods").linkbutton('enable');
                console.log(result);
                var result = eval('('+result+')');
                if(result.success){
                    $.messager.show({
                        title: '提示信息',
                        msg: result.errorMsg
                    });
                    car_id='aa';
                    $('#GoodsNo').attr('onfocus','');
                    $('#dlg').dialog('close'); // close the dialog
                    $('.show_yearmodel').hide();
                    //让适用车系变成默认状态
                    $('#front_make').attr('value','');
                    $('#front_make').change();
                    $('#dg').datagrid('unselectAll');
                    $('#dg').datagrid('reload');//reload the user data 
                } else {
                    $.messager.show({
                        title: '错误信息',
                        msg: result.errorMsg
                    });
                }
            }
        });
    }
    function destroyGoods(){
        // var row = $('#dg').datagrid('getSelected');
        var ids = [];
        var row = $('#dg').datagrid('getSelections');
        for(var i=0; i<row.length; i++){
            ids.push(row[i].ID);
        }
        if (row.length > 0){
            //console.log(row.ID)
            $.messager.confirm('提示信息','你确定要把选中的这条数据删除吗？',function(r){
                if (r){
                    var url = Yii_baseUrl+"/dealer/marketing/Delete";
                    $.post(url,{id:ids.join(',')},function(result){
                        if (result.success){
                            $.messager.show({ // show error message
                                title: '提示信息',
                                msg: result.errorMsg
                            });
                            $('#dg').datagrid('reload'); // reload the user data
                            $('#dg').datagrid('unselectAll');
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
    
    function saveBrand(){
        $('#fbrand').form('submit',{
            url: Yii_baseUrl+"/dealer/marketing/Addbrand",
            onSubmit: function(){
                return $(this).form('validate');
            },
            success: function(result){
                var result = eval('('+result+')');
                if(result.success){
                    //if (result.errorMsg){
                    $.messager.show({
                        title: '提示信息',
                        msg: result.errorMsg
                    });
                    $('#dlgbrand').dialog('close'); // close the dialog
                    //$('#dg').datagrid('reload');//reload the user data
                } else {
                    $.messager.show({
                        title: '错误信息',
                        msg: result.errorMsg
                    });
                }
            }
        });
    }
</script>
<script>
    var car_id=0;
    // 删除图片
    function xximage(obj){
        var xximage = obj.getAttribute("key");
        var tag = obj.getAttribute("tag");
        var xxurl = Yii_baseUrl +"/dealer/marketing/Deleteimg";
        $.getJSON(xxurl,{xximage:xximage},function(result){
            $("#goodsImage").remove(); 
        })
    }
    function xximagedetc(obj){
        var xximage = obj.getAttribute("key");
        var tag = obj.getAttribute("tag");
        var xxurl = Yii_baseUrl +"/dealer/marketing/Deleteimgdetc";
        $.getJSON(xxurl,{xximage:xximage,tag:tag},function(result){
            $("#goodsImage").remove(); 
        })
    }
    //删除主营车系
    function xxVehicle(obj){
        var cateid = obj.getAttribute("key")
        var parentID = $(obj).parent().attr('car');
        if($("#ul_"+parentID).find('li').length==1){
            $("#a"+parentID).remove();
            $("#div_"+parentID).remove();
        }
        if(cateid != 0)
        {
            var url =" <?php echo Yii::app()->createUrl('dealer/marketing/Deletepromvehicle'); ?>";
            $.getJSON(url,{cateid:cateid},function(data){
                if(data == 1)
                    $(obj).parent().remove();
            });
        }else{
            $(obj).parent().remove();
        }  
    }
    //删除主营车系
    function xxcar(obj){
        var cateid = obj.getAttribute("key");
        if(cateid != 0)
        {
            var url =" <?php echo Yii::app()->createUrl('dealer/marketing/Deletecar'); ?>";
            $.getJSON(url,{cateid:cateid},function(data){
                if(data == 1){
                    return true;
                }else{
                    return false;
                }
            });
        }
        $("#div_"+cateid).remove();
        $(obj).parent().remove();
        car_id='aa';
    }
    //删除主营车系
    function xxOENO(obj){
        var cateid = obj.getAttribute("key")
        if(cateid != 0)
        {
            var url =" <?php echo Yii::app()->createUrl('dealer/marketing/Deletegoodsoeno'); ?>";
            $.getJSON(url,{cateid:cateid},function(data){
                if(data == 1)
                    $(obj).parent().remove();
            });
        }else{
            $(obj).parent().remove();
        }
    }
    function Trimstr(str,is_global)
    {
        var result;
        result = str.replace(/(^\s+)|(\s+$)/g,"");
        if(is_global.toLowerCase()=="g")
        {
            result = result.replace(/\s/g,"");
        }
        return result;
    }
   
    $(function(){
        // 添加车系
        $("#addVehcle").click(function(){
            if($("#showVehicle span.catespan").length <100){
                var makeval =  $("#front_make").val();
                var carval =  $("#front_series").val();
                var yearval =  $("#front_year").val();
                var modelval =  $("#front_model").val();
                // 前市场车型
                var make =  $("#front_make option:selected").text();
                var car =  $("#front_series option:selected").text();
                var year =  $("#front_year option:selected").text();
                var model =  $("#front_model option:selected").text();
                var cart = car;
                var yeart = year;
                var modelt = model;
                var arr=new Array();
                var list=new Array();
                var listadd =0;
                if(make == "请选择厂家")
                {
                    $.messager.alert('提示信息','您还没有请选择厂家类别！');
                    return false;
                }
                if(car == "请选择车系")
                {
                    $.messager.alert('提示信息','您还没有请选择车系类别！');
                    return false;
                }
                //                else if(year == "请选择年款"){
                //                    $.messager.alert('提示信息','您还没有请选择年款类别！');
                //                    return false;
                //                }else if(model == "请选择车型"){
                //                    $.messager.alert('提示信息','您还没有请选择车型类别！');
                //                    return false;
                //                }
                else{
                    //                    var url = Yii_baseUrl + "/dealer/marketing/Addyearmodel"
                    //                    $.getJSON(url, {Make:makeval,Car:carval,Year:yearval,Model:modelval,Maketxt:make,Cartxt:car,Modeltxt:model,GoodsID:goodsID}, function(result){
                    //                        if(result){
                    //                            if(result.success == 1){
                    //
                    //                            }else if(result.success == 0){
                    //                                alert(result.errorMsg)
                    //                            } 
                    //                        }
                    //                    })
                    var m_hid =  $("#make_hidden").val();
                    $("#make_hidden").val(m_hid+','+make);
                    
                    if($("#showVehicle span.catespan").length==0){
                        var span = '';
                        span += "<span carID='"+carval+"' class='checkbox-add checkbox-add2 bg-white tag-close catespan' id='a"+carval+"' ><span name='make'>"+make+"</span> <span name='car'>"+cart+"</span></span> ";
                        span +="<div class='show_yearmodel'  id=div_"+carval+">";
                        span +="<ul id=ul_"+carval+">";
                        span += "</ul>";
                        span += "</div>";
                        $("#showVehicle").append(span); 
                    }else{
                        $("#showVehicle span.catespan").each(function(){
                            var cpCar=$(this).find('span[name=car]').html();
                            var cpmake=$(this).find('span[name=make]').html();
                            arr.push(cpCar+''+cpmake); 
                        })
                        if($.inArray(cart+''+make, arr)==-1){
                            var span = '';
                            span += "<span carID='"+carval+"' class='checkbox-add checkbox-add2 bg-white tag-close catespan' id='a"+carval+"' ><span name='make'>"+make+"</span> <span name='car'>"+cart+"</span></span> ";
                            span +="<div class='show_yearmodel'  id=div_"+carval+">";
                            span +="<ul id=ul_"+carval+">";
                            span += "</ul>";
                            span += "</div>";
                            $("#showVehicle").append(span);  
                        } 
                    }
                }
         
                $("#ul_"+carval+" li").each(function(){
                    var cpYear=$(this).find('span[name=Year]').html();
                    var cpModel=$(this).find('span[name=Model]').html();
                    list.push(cpYear+''+cpModel);
                })
                if(year!='请选择年款' && model!='请选择车型'){
                    if($.inArray(yearval+''+model, list)==-1){
                        var li = "<li car="+carval+"><span name=Year>"+yearval+"</span> <span name=Model>"+model+"</span><span onclick='xxVehicle(this)' key='0' style='padding-right:10px;float:right;cursor:pointer;font-size: 9px;font-family: Georgia;'>　X</span><span style='display:none' name='make'>"+makeval+"</span><span style='display:none' name='car'>"+carval+"</span><span style='display:none' name='year'>"+yearval+"</span><span style='display:none' name='model'>"+modelval+"</span><span style='display:none' name='maketext'>"+make+"</span><span style='display:none' name='cartext'>"+car+"</span><span style='display:none' name='yeartext'>"+year+"</span><span style='display:none'  name='modeltext'>"+model+"</span></li>" ; 
                        $("#ul_"+carval).append(li);  
                    }else{
                        alert('添加失败,该车系可能已经添加');
                    }
                }                            
                if(year=='请选择年款' || model=='请选择车型'){
                    var url = Yii_baseUrl + "/dealer/marketing/Getyearmodel"
                    $.getJSON(url, {carID:carval,Year:year}, function(result){
                        if(result){
                            $.each(result,function(index,value){
                                if($.inArray(value.Year+''+value.Modeltxt,list)==-1){
                                    listadd +=1;
                                }
                            });
                            if(listadd){
                                $.each(result,function(index,value){
                                    if($.inArray(value.Year+''+value.Modeltxt, list)==-1){
                                        var li = "<li  car="+carval+"><span name=Year>"+value.Year+"</span> <span name=Model>"+value.Modeltxt+"</span><span onclick='xxVehicle(this)' key='0' style='padding-right:10px;float:right;cursor:pointer;font-size: 9px;font-family: Georgia;'>　X</span><span style='display:none' name='make'>"+makeval+"</span><span style='display:none' name='car'>"+carval+"</span><span style='display:none' name='year'>"+value.Year+"</span><span style='display:none' name='model'>"+value.Model+"</span><span style='display:none' name='maketext'>"+make+"</span><span style='display:none' name='cartext'>"+car+"</span><span style='display:none' name='yeartext'>"+value.Year+"</span><span style='display:none'  name='modeltext'>"+value.Modeltxt+"</span></li>";
                                        $("#ul_"+carval).append(li);
                                    }
                                });
                            }else{
                                alert('添加失败,该车系可能已经全部添加');
                            }
                        }
                    }); 
                } 
            }else{
                $.messager.alert('提示信息', "最多只能添加100个", 'warning');
            }
        });
        // 添加OENO　号
        $("#addOENO").click(function(){
            var OENO = $("#OENOValue").val();
            if(OENO=='')
            {
                alert('请填写OE号');
                return false;
            }else{
                var al='';
                
                $("#showOENO span.catespan").each(function(){
                    var cpCode=$(this).find('span[name=model]').html();
                    if(OENO==cpCode){
                        al='此OE号您已添加，不可重复添加！';
                    }
                })
                if(al==''){
                    $("<span class='checkbox-add bg-green tag-close catespan'><span name='model'>"+OENO+"</span><input type='hidden' value="+OENO+" name='OENOS[]'><span onclick='xxOENO(this)' key='0' style='cursor:pointer;font-size: 9px;font-family: Georgia;'>　X</span></span>").appendTo("#showOENO");
                    $("#OENOValue").val('');
                }else{
                    $.messager.alert('提示信息',al);
                }
            }
        });
    })
    $(function(){
        $(".checkbox-add2").live('click',function(){
            var carID = $(this).attr('carID');
            var car = '#a'+carID;
            if(car_id != carID){
                var offset = $(this).offset();
                var left, top;
                var width = $(window).width();
                var height = $(window).height();
                //屏幕宽度大于1000
                if( width> 1000){
                    var cutwidth =  (width - 1000)/2 + 230-145;
                }else{
                    // cutwidth = 230-145;
                    $.messager.alert('温馨提示','屏幕最大窗口，界面更友好！','info');
                }
                var curheight = (height - 620)/2-24;
                //  alert(curheight+'----'+offset.top)
                left = (offset.left -cutwidth) + 'px';
                //  top = (offset.top +108 -110) + 'px';
                top = (offset.top-curheight) + 'px';
                //  var version = $.browser.version;
                //                if(version == '6.0') 
                //                {  
                //                    left = offset.left-295 + 'px';
                //                    top = offset.top -67 +'px';  
                //                }else if(version == '7.0') { 
                //                    left = offset.left-295 + 'px';
                //                    top = offset.top -67 +'px';  
                //                }else if(version == '8.0') { 
                //                    left = offset.left-304 + 'px';
                //                    top = offset.top -67 +'px';  
                //                }else if(version == '9.0' || version == '10.0' || version == '11.0') { 
                //                    left = offset.left-306 + 'px';
                //                    top = offset.top -71 +'px';  
                //                }else{
                //                    left = offset.left-297 + 'px';
                //                    top = offset.top -38 +'px';
                //                }
                $("<span id='s"+carID+"' onclick='xxcar(this)' key='"+carID+"' style='float:right;cursor:pointer;font-size: 9px;font-family: Georgia;'>　X</span>").appendTo(car);
                //            $(car).removeClass("bg-white").addClass('bg-green').siblings('.checkbox-add2').removeClass("bg-green");
                $(car).removeClass("bg-white");
                $(car).addClass("bg-green");
                if(car_id!=0 ){
                    $('#div_'+car_id).hide();
                    var car_a = '#a'+car_id;
                    var car_s ='#s'+car_id;
                    $(car_a).removeClass("bg-green");
                    $(car_a).addClass("bg-white");
                    $(car_s).remove();
                }
                //            if($("#ul_"+carID+" li").length==0){
                //                var url = Yii_baseUrl + "/dealer/marketing/Getyearmodel"
                //                $.getJSON(url, {carID:carID}, function(result){
                //                    if(result){
                //                        $.each(result,function(index,value){
                //                            var li = "<li  car="+carID+">"+value.Year+' '+value.Modeltxt+"<span onclick='xxVehicle(this)' key='"+value.ID+"' style='padding-right:10px;float:right;cursor:pointer;font-size: 9px;font-family: Georgia;'>　X</span></li>"  ;
                //                            $("#ul_"+carID).append(li);
                //                        });
                //                    }
                //                }); 
                //             }
                $('#div_'+carID).css({'top':top, 'left':left}).show();
            }else{
                $('#div_'+carID).show();
            }
            if(car_id=='aa'){
                car_id=0;
            }else{
                car_id=carID;
            }
        });
    })
    
</script>
<script>
    
    function uploadImage(){
        if($("#showimglist span.showimages").length >= 7){
            $.messager.alert('温馨提示','最多只能添加7张图片','warning');
            return false;
        }
        // $('#img_fm').form('submit',{
        var imgurl = " <?php echo F::uploadUrl(); ?>";
        $('#fm').form('submit',{
            url: Yii_baseUrl+"/dealer/marketing/Uploadimage",
            onSubmit: function(){
                return true; //$(this).form('validate');
            },
            success: function(result){
                // console.log(result);return;
                var result = eval('('+result+')');
                if(result.success){
                    $.messager.show({
                        title: '提示信息',
                        msg: result.errorMsg
                    });
                    var span = "<span class='showimages'><img  style='width:80px;height:80px;' src="+imgurl+result.imageurl+"><span onclick='xximage(this)' key="+result.imageurl+" class='close icon-close-green xx'></span></span>";
                    //                    $("<input type='hidden' value="+result.imageurl+" name='goodsImages[]'>").appendTo("#showimglist");
                    $("#showimglist").append(span);
                } else {
                    $.messager.show({
                        title: '错误信息',
                        msg: result.errorMsg
                    });
                }
            }
        });
    }
    
</script>
