<style type="text/css">
    fieldset.test {
        padding:5px;
        margin:10px;
        width:700px;
        border:#d4d4d4 solid 2px ;
    } 
    legend {
        color:#39af39;
        padding:5px 10px;
        font-weight:800; 

    }
    
#first_div {
    margin-top: -20px;
}

.first_label {
    margin-left: 140px;
}

</style>
<div id="makegoodactive" 
     class="easyui-dialog" 
     style="width:800px;
     height:640px;
     padding:10px 20px"
     data-options="
     closed:true, 
     modal:true,
     buttons:'#buttons'">
    <!-- 基础信息 -->
    <form id="fm_add"  name="fm" method="post" novalidate>
        <fieldset id="version" class="test" style="display:none"> 
            <legend>版本信息</legend> 
            <p class="form-row" style="padding-left:20px; width: 200px;float:left" >
                <label>版本信息:</label>
                <?php echo CHtml::dropDownlist('version_name', '', array('001' => '001'), array('class' => 'width110 select', 'empty' => '请选择版本'))
                ?>
            </p>
        </fieldset>
        <fieldset class="test"> 
            <legend>基础信息</legend> 
            <p class="form-row" style="padding-left:20px; width: 200px;float:left">
                <label>商品名称:</label>
                <input name="GoodsName" class="easyui-validatebox width213 input" style="width:100px"  required="true">
            </p>
            <p class="form-row" style="padding-left:20px; width: 200px;float:left">
                <label>商品编号:</label>
                <input id="GoodsNo" name="GoodsNo" class=" easyui-validatebox width213 input" style="width:100px" required="true">
            </p>
            <p class="form-row" style="padding-left:20px; width: 200px;float:left">
                <label>OE号:</label>
                <input name="OE" class=" easyui-validatebox input" style="width:100px" required="true"> <span>(如有多个OE号,请用‘,’隔开)</span>
            </p>
            <p class="form-row" style="padding-left:20px; width: 200px;float:left">
                <label>标杆品牌:</label>
                <input name="BenchBrand" class=" easyui-validatebox input" style="width:100px"> 
            </p>
            <p class="form-row" style="padding-left:20px; width: 200px;float:left">
                <label>标杆号:　</label>
                <input name="BenchNo" class=" easyui-validatebox input" style="width:100px">
            </p>
            <p class="form-row" style="padding-left:20px; width: 200px;float:left">
                <label>适用车型:</label>
                <input name="carmodel" class=" easyui-validatebox input" style="width:100px" required="true">
            </p>
            <?php
            $organID = Commonmodel::getOrganID();
            $cate = MakeGoodsBrand::model()->findAll('OrganID=:organID and UserID=:userID', array(':organID' => $organID, 'userID' => $organID));
            $result = MakeGoodsCategory::model()->findAll('organID=:organID and userID=:userID', array(':organID' => $organID, ':userID' => $organID));
            $res=  Commonmodel::Getcpnames();
            ?>
            <p class="form-row" style="padding-left:20px; width: 200px;float:left" >
                <label>商品品牌:</label>
                <?php echo CHtml::dropDownlist('GoodsBrand', '', CHtml::listData($cate, 'BrandID', 'BrandName'), array('class' => 'width110 select  easyui-validatebox', 'empty' => '请选择品牌', 'required' => true))
                ?>
            </p>
            <p class="form-row" style="padding-left:20px; width: 200px;float:left" >
                <label>商品类别:</label>
                <?php echo CHtml::dropDownlist('GoodsCategory', '', CHtml::listData($result, "id", "name"), array('class' => 'width110 select easyui-validatebox', 'empty' => '请选择类别', 'required' => true))
                ?>
            </p>
        </fieldset>
        <!-- 参数信息 -->
        <fieldset> 
            <legend>标准名称参数信息</legend> 
            <p class="form-row" style="padding-left:20px;">
                <label>&nbsp;&nbsp;配件品类:</label>
                 <?php echo CHtml::dropDownlist('leafCategory',$res['firstcpname'],$res['cpnames'],array('class' => 'width250 select', 'id' => 'leafCategory','empty'=>'请选择配件品类'));
            ?> 
            </p>
            <div id="param" >

            </div>
        </fieldset>
        <!-- 销售信息 -->
        <fieldset class="test"> 
            <legend>销售信息</legend> 
            <p class="form-row" style="padding-left:20px; width:120px;float:left">
                <label>库存：</label>
                <select name="inventory" class="select" style="width:60px">
                    <option value="1" selected="selected">有</option>
                    <option value="0">无</option>
                </select>
            </p>
            <p class="form-row" style="padding-left:20px; width: 200px;float:left">
                <label>发货天数：</label>
                <input name="Days" class=" easyui-validatebox input" style="width:100px" validtype="znumber">天
            </p>
            <p  style="padding-left:20px; width: 600px; clear:both; float:none;">
                <label>备注：</label>
                <textarea name="Desc"style="width:500px;height:80px" maxlength="200" size="200" id="textdesc"></textarea>
            </p>
        </fieldset> 
        <fieldset class="test" > 
            <legend>商品图片上传</legend> 
            <label class="first_label">(上传的图片格式应为gif、jpg、png、jpeg,最佳大小为350px*350px)</label>
            <div class="form-row" id="first_div">
                <input type='file' name='file_upload' id="file_upload">
                <input type="hidden" value="上传" id="file-upload-start">
                <input type="hidden" name="urlimg" value="" id="imgupload">
                <p id='hidden_upnames'></p>
                <p class="form-row" id="showimglist" style=" position: relative;"> </p>       <!--显示上传的图片-->

            </div>
        </fieldset> 
    </form>
</div>
<div id="buttons">
    <a href="javascript:void(0)" class="btn-green" iconCls="icon-ok"  onclick="Save()">确定</a>
    <a href="javascript:void(0)" class="btn" iconCls="icon-cancel" onclick="addcancle()">取消</a>
</div>
<script type="text/javascript" src='<?php echo F::themeUrl(); ?>/js/uploadify/jquery.uploadify.js'></script>
<link rel="stylesheet" href="<?php echo F::themeUrl(); ?>/js/uploadify/uploadify.css">
<?php // include_once 'uploadimgjs.js'; ?>
<?php include_once 'uploadimgjs.php'; ?>