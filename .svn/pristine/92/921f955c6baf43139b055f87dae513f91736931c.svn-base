
<style>
    #showImage{ width: 100px; height: 100px; float: left; margin-top: 0px; margin-right: 20px; border: 1px solid black;}
    .width50 { width: 50px;}
    .checkbox-add{ line-height: 24px;}
    #image1 img {float:left; margin-left:5px;}
    
    #goodsImage{width:100px;height: 100px; float: left; z-index: 200; position: absolute; left: 38px; top: 197px; background-color: #fff;}
    #xxx{float: right; width:10px; height: 10px; position: absolute; left: 91px; top: -5px; z-index: 300;}
    #xxx img {cursor: pointer;}
    .showimages{ margin-right: 8px; margin-top: 10px;}
    .unittext{font-size: 10px;}
</style> 
<div class="easyui-tabs" style="width:760px;height:380px">
    <div title="基本信息" style="padding:10px">
        <!--<div></div>-->
        <div id="showImage">
            <center>点击上传<br>
                <span class='width80 inputfile-input input' style="height:80px;">
                    <input type="file" name="file_upload" style="height:80px;">
                </span>
            </center>
            <span style="color:red; margin-left:20px;" id="message"></span>
        </div>
        <p class="form-row">
            &nbsp;&nbsp;&nbsp;&nbsp;<label >重量:</label>
            <input type="text" name="Weight" validType='floatnum'  class="easyui-validatebox  width50 input"><label class="unittext">千克</label>
            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
            <label >长:</label>
            <input type="text" name="Length" validType='floatnum' class="easyui-validatebox  width50 input"><label class="unittext">厘米</label>
            &nbsp;&nbsp;&nbsp;
            <label >宽:</label>
            <input type="text" name="Wide" validType='floatnum' class="easyui-validatebox  width50 input"><label class="unittext">厘米</label>
           &nbsp;<label>配件档次:</label>
            <input type="text" name="PartsLevel" class="width50 input">
        </p>
        <div class="form-row">
            &nbsp;&nbsp;&nbsp;&nbsp;<label>体积:</label>
            <input type="text" name="Volume" validType='floatnum' class="easyui-validatebox  width50 input"><label class="unittext">立方米</label>
            &nbsp; &nbsp;&nbsp;&nbsp;<label >高:</label>
            <input type="text" name="Height" validType='floatnum' class="easyui-validatebox  width50 input"><label class="unittext">厘米</label>
             
            <label>物流价:</label>
            <input type="text" name="LogisticsPrice" validType="floatnum"  class="easyui-validatebox  width50 input"><label class="unittext">元</label>
            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<label>保质期:</label>
            <input type="text" name="ValidityDate" validType="number"  class="easyui-validatebox  width50 input"><label class="unittext">天</label>
           
            
        </div> 
        <div class="form-row">
            <label>标杆企业:</label>
            <input type="text" name="BganCompany" class="width100 input">

            <label>标杆商品号:</label>
            <input type="text" name="BganGoodsNO" class="width100 input">
            <label>规格:</label>
            <input type="text" name="Specifica" class="width144 input">
        </div> 
        <div class="form-row">

        </div>
        <hr>
        <div class="form-row">
            <!--<p class="form-row">-->
<!--            <input id="goodsBrand" type="text" name="goodsBrand" class="width213 input">-->
           
            <!--            </p>-->

            <!--            <label>配件类别号:</label>
                        <input type="text" name="PartsNO" class="width100 input">-->

            <!--            <label>嘉配号:</label>
                        <input type="text" name="JiapartsNO" class="width100 input">-->
             &nbsp;&nbsp;<label>商品品牌:</label>
            <?php
            $organID = Commonmodel::getOrganID();
            $brandNames = DealerBrand::model()->findAll("OrganID = $organID");
            $brandName = CHtml::listData($brandNames, 'ID', 'BrandName');
            echo CHtml::dropDownList('goodsBrand', 'goodsBrand', $brandName, array(
                'class' => 'width110 select',
                'empty' => '选择商品品牌',
            ));
            ?>	
            <input type="hidden" name="brandID">
            <label>上架:</label>
            <select class="select" name="IsUpSale">
                <option value="1">上架</option>
                <option value="0">下架</option>
            </select>
             &nbsp;&nbsp;&nbsp;&nbsp;<label>OE　号:</label>
            <input type="text" name="OENO" id="OENOValue" class="width100 input">
            <span id='addOENO' class="btn" style="cursor:pointer">添加</span>
        </div> 
        <p class="form-row" id="showOENO" ><!-- 显示OENO -->

        </p>
        <p class="form-row">
            <label class='label'>前市场车型:</label>
            <?php $this->widget('widgets.default.WFrontModel'); ?>
            <span id='addVehcle' class="btn" style="cursor:pointer;">添加</span>
            <?php //$this->renderPartial('vehicle_mm'); ?> 
        </p>
        <p class="form-row" id="showVehicle"><!-- 显示车系车型 -->

        </p>
        <p class="form-row">
            <label >备注:</label>
            <!--<input type="text" name="Description" class="easyui-validatebox input">-->
            <textarea name="Memo" style="width:500px;height: 60px;"></textarea>
        </p>
    </div>
    <div title="包装" style="padding:10px">
        <p class="form-row">
            <label >最小包装数:</label>
            <input type="text" name="MinQuantity" class="width50 input">
        </p>
<!--             <p class="form-row">
       <label >数量:</label>
       <input type="text" name="OENO" class="width50 input">厘米
       </p>-->
        <p class="form-row">
            &nbsp;&nbsp;<label >包装重量:</label>
           <input type="text" name="pWeight" class="width50 input">千克
        </p>
        <p class="form-row">
           &nbsp;&nbsp;<label >包装体积:</label>
            <input type="text" name="pVolume" class="width50 input">立方米
        </p>

    </div>
    <div title="上传图片" style="padding:10px">
        <div style="width:330px;">
            <p class="form-row">
                <label>检测图像&nbsp;</label>
                <span class='width180 inputfile-input input'>
                    <input type="file" name="DetectionImg">
                </span>
            </p>
            <hr style='width:260px;'>
            <!--<form id="img_fm2" method="get" enctype="multipart/form-data" >-->
            <p class="form-row" >
                <label>商品图片1</label>
                <span class='width180 inputfile-input input'>
                    <input type="file" name="goodsImage1">
                </span> <span id="uploadImage" onclick="uploadImage()" class="btn-small" style="cursor:pointer;">添加</span> <br><br>
                <!--                <label>商品图片2</label>
                                <span class='width180 inputfile-input input'>
                                    <input type="file" name="goodsImage2">
                                </span><br> <br>
                                <label>商品图片3</label>
                                <span class='width180 inputfile-input input'>
                                    <input type="file" name="goodsImage3">
                                </span><br><br>
                                <label>商品图片4</label>
                                <span class='width180 inputfile-input input'>
                                    <input type="file" name="goodsImage4">
                                </span><br><br>
                                <label>商品图片5</label>
                                <span class='width180 inputfile-input input'>
                                    <input type="file" name="goodsImage5">
                                </span>-->
            </p>

            <!--</form>-->
        </div>
        <div id="showimglist" style="width: 360px; border:1px dotted  green; float: right; height: 300px; margin-top: -100px;" > <!--显示图片-->

        </div>
    </div>

</div>

<script>
    
    function uploadImage(){
        if($("#showimglist span.showimages").length >= 7){
            $.messager.alert('温馨提示','最多只能添加7张图片','warning');
            return false;
        }
        // $('#img_fm').form('submit',{
        var imgurl = " <?php echo F::uploadUrl(); ?>";
        $('#fm').form('submit',{
            url: Yii_baseUrl+"/dealer/marketing/uploadImage",
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
                    $("<input type='hidden' value="+result.imageurl+" name='goodsImages[]'>").appendTo("#showimglist");
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

<script>
    $(document).ready(function(){
        //上传文件名显示
        $("input[type='file']").live('change',function(){
            var inputfile = $(this).closest('.inputfile');
            if(inputfile.length!=0){
                var after = $(inputfile).nextAll('span');
                after.length>0 && after.remove();
                $(inputfile).after('<span style="margin-left:5px;">'+$(this).val()+'</span>')
            }else{
                var inputfile_input = $(this).closest('.inputfile-input');
                if(inputfile_input.length==0){
                    return;
                }
                var before = $(this).prevAll('span');
                before.length>0 && before.remove();
                $(this).before('<span style="margin-left:5px;">'+$(this).val()+'</span>')
            }
        }); 
    }); 
</script>