<style>
    .catespan {
        background: #fff;
        border: 1px solid gray;
        color: #39ae39;
        display: block;
        float: left;
        height: 20px;
        line-height: 20px;
        margin: 3px 0 0 3px;
        padding-left: 5px;
        width: 190px;
        padding-right: 2px
    }
    .xxOENO {
        display: block;
        float: right;
        margin-right: 7px;
    }
    .xxVehicle{
        display: block;
        float: right;
        margin-right: 7px;
    }
    .uploadify{
        float: left;
    }
    .showimages{
        display: block;
        float: left;
        height: 80px;
        margin-right: 3px;
        width: 80px;
    }

    .showVehicle {
        /*border: 1px solid;*/
        display: block;
        height: auto;
        overflow: hidden;
    }
    .show_yearmodel{ height: 200px; overflow-y:scroll; display: none; position: absolute; z-index: 21000; width: 240px; left:-70px;top:205px;   background: #fff; border:1px solid #0065bf;}
    .show_yearmodel li {
        /*    border: 1px solid #FF0000;*/
        line-height: 20px;
        margin-bottom: 2px;
        padding-left: 5px;
        width: 218px; 
        overflow: hidden;
    }
    /**隐藏进度条**/
    .uploadify-queue{ display: none;} 

    .icon-close-green {
        background: url("<?php echo Yii::app()->theme->baseUrl; ?>/images/icons/icon-close-green.png") no-repeat scroll 0 0 rgba(0, 0, 0, 0);
        cursor: pointer;
        height: 9px;
        position: absolute;
        width: 9px;
    }
    .pager{
        display:none;
    }
    .add a:hover{
        color:white;
    }
    .m_left9{
        margin-left: 12px;
        margin-left:9px\9;
        *margin-left: 9px;
    }
    .m_left12{
        margin-left: 9px\9;
        *margin-left: 9px;
    }
    .m_left36{
        margin-left:36px;
        margin-left:30px\9;
        *margin-left:30px;

    }
    .m_left24a{
        margin-left:24px;
    }
    .m_left12a{
        margin-left:12px;
    }
    .m_left36a{
        margin-left:36px;
    }
    .width90{
        width:90px;
    }
    .p_left9{
        padding-left:9px;
    }
    .p_left33{
        padding-left:33px;
    }
</style>
<?php
$this->breadcrumbs = array(
    '商品管理' => Yii::app()->createUrl('common/goodslist'),
    '修改商品'
        )
?>

<form id="fm" method="post" action="" novalidate style="" style="border:1px solid red">
    <div class="bor_back">
        <p class="txxx">填写基本信息</p>
        <input type="hidden" id="GoodsID" name="GoodsID" value="<?php echo $data['ID'] ?>">
        <div class="txxx_info">
            <span class="color_red" id="Name_id" style="padding-left: 9px"></span><span class=" f_weight">商品名称：</span>
            <input type="text" name="Name" id="Name" class=" input input3 width375" value="<?php echo $data['Name'] ?>" >
            <?php if ($edit['Name']): ?>
                <span style="color:green">(提示：商品名称有变化)</span>
            <?php endif; ?>
            <?php if ($data['Version']): ?>
                <div class="txxx_info2 m-top">
                    <span class="f_weight float_l m_left9">版本信息：</span>
                    <div class="float_l  back_color m_left12 ">
                        <div class="txxx_info3">
                            <p>  
                                <span class="color_red" id="GoodsNO_id">&nbsp;</span> <span>当前版本：</span>
                                <input type="text" class=" input input3 width250" value="<?php echo date('Y-m-d H:i:s', $data['Version']) ?>">
                            </p>     
                            <p class="m-top">
                                <span class="color_red" id="Pinyin_id">&nbsp;</span> <span>历史版本：</span>
                                <select id="verselect" class='select'>
                                    <?php
                                    $Version = DealergoodsService::getgoodsversion($data['ID']);
                                    foreach ($Version as $Verk => $Verv) {
                                        if ($data['Version'] == $Verv) {
                                            echo " <option selected='selected' version='" . $Verv . "' goodsid='" . $data['ID'] . "'>" . date('Y-m-d H:i:s', $Verv) . "</option>";
                                        } else {
                                            echo " <option version='" . $Verv . "' goodsid='" . $data['ID'] . "'>" . date('Y-m-d H:i:s', $Verv) . "</option>";
                                        }
                                    }
                                    ?>
                                </select>
                            </p>
                        </div>
                    </div>
                    <div style="clear:both"></div>
                </div>
            <?php endif; ?>
            <div class="txxx_info2 m-top">
                <span class="f_weight float_l p_left9">产品属性：</span>
                <div class="float_l  back_color m_left12 ">
                    <div class="txxx_info3">
                        <p><span class="color_red" id="GoodsNO_id" style="padding-left: 9px;"></span> <span>商品编号：</span>
                            <input type="text" id="GoodsNO" name="GoodsNO"  class=" input input3 width250" value="<?php echo $data['GoodsNO'] ?>">
                            <?php if ($edit['GoodsNO']): ?>
                                <span style="color:green">(提示：商品编号有变化)</span>
                            <?php endif; ?>
                        </p>
                        <p class="m-top"><span class="color_red" id="Pinyin_id"  style="padding-left: 9px;"></span> <span>拼音代码：</span>
                            <input type="text"  maxlength="50"  id="Pinyin" name="Pinyin" id="pinyincode" class=" input input3 width250" value="<?php echo $data['Pinyin'] ?>" >
                            <?php if ($edit['Pinyin']): ?>
                                <span style="color:green">(提示：拼音代码有变化)</span>
                            <?php endif; ?>
                        </p>
                        <p class="m-top">
                            <span  class="p_left9">配件品类：</span>
                            <input id="cpname-search" type="text" class=" input input3 width250" value="<?php echo DealergoodsService::StandCodegetcpname($data['StandCode'], 'Name'); ?>"  >
                            <?php if ($edit['StandCode']): ?>
                                <span style="color:green">(提示：配件品类有变化)</span>
                            <?php endif; ?>
                            <input type="hidden" name="bignameid" id="bignameid_value"/>
                            <input type="hidden" name="subnameid" id="subnameid_value"/>
                        </p>
                        <p class="m-top"> <span class=" p_left9">商品品牌：</span>
                            <?php
//                            $organID = Commonmodel::getOrganID();
//                            $brandNames = Brand::model()->findAll("OrganID = $organID");
//                            $brandName = CHtml::listData($brandNames, 'ID', 'BrandName');
//                            $selected = $data['BrandID'];


                            $selected = $data['BrandID'];
                            $brandNames = DealergoodsService::codegetbrand($data['StandCode']);
                            $brandName = $brandNames ? $brandNames : array();
                            echo CHtml::dropDownList('goodsBrand', $selected, $brandName, array(
                                'class' => 'select select2 ',
                                'empty' => '选择商品品牌',
                            ));
                            ?>	
                            <?php if ($edit['Brand']): ?>
                                <span style="color:green">(提示：商品品牌有变化)</span>
                            <?php endif; ?>
                            <input type="hidden" name="BrandName">

                        </p>
<!--                        <p class="m-top">
                            <span class=" m_left34">OE号：</span>
                            <input type="text" id="OENOValue" value="<?php echo $data->goodoe[0]['OENO']; ?>" class=" input input3 width250">
                            <span class="add m_left"><a class="jiahao"  onclick="addOENO()">+</a></span><a href="javascript:;" class="add_wz" onclick="addOENO()">添加OE号</a>
                        </p>-->
                        <div id="showoe"> 
                            <p class="m-top">
                                <span class=" p_left33">OE号：</span>
                                <input type="text"  name="OENOS[]" value="<?php echo $data['oeno'][0]; ?>" class=" input input3 width250" onblur="oechange()">
                                <span class="add m_left"><a class="jiahao"  onclick="addOENO()">+</a></span><a href="javascript:void(0)" class="add_wz" onclick="addOENO()">添加OE号</a>
                                <?php if ($edit['oeno']): ?>
                                    <span style="color:green">(提示：OE号有变化)</span>
                                <?php endif; ?>
                            </p>
                            <?php
                            if ($data['oeno']) {
                                foreach ($data['oeno'] as $key => $val) {
                                    if ($key != 0)
                                        echo "<p class='m-top'><input type='text' maxlength='20' name='OENOS[]' value='" . $val . "' class='input input3 width250' style='margin-left:81px' onblur='oechange()'></p>";
                                }
                            }
                            ?>
                        </div>


                    </div>
                </div>
                <div style="clear:both"></div>
            </div>

        </div>
    </div>
    <div class="bor_back m-top">
        <p class="txxx">图片和详细说明</p>
        <div class="txxx_info">
            <div id="uploadify">


                <span class=" f_weight" style="vertical-align:top;display: block;float: left;">产品图片：</span>
                <div style="margin-top: 15px;">
                    <div class="float_l" style="margin-left:10px;"><input type='file' name='file_upload' id="file_upload">
                        <input type="hidden" value="上传" id="file-upload-start">
                    </div>
                    <span style="line-height:25px;color:#888">图片最多上传5张</span><span style="line-height:25px;color:green">(提示：删除图片双击即可)</span>
                    <div style="clear:both"></div>
                </div>
                <div class="upload_img m_left65">
                    <ul>
                        <div class="form-row" id="showimglist" style=" position: relative;">
                            <?php
                            if ($data['img']) {
                                foreach ($data['img'] as $val) {
                                    echo " <li class='float_l' style='margin-right:5px;'><img ondblclick='xximage(this)' name='urlimg' key=" . $val['ImageUrl'] . "  imgname=" . $val['ImageName'] . " add='save' style='width:80px;height:80px;' src=" . F::uploadUrl() . $val['ImageUrl'] . "></li>";
                                }
                            }
                            ?>


                        </div>
                        <input type="hidden" name="urlimg" value="" id="imgupload">
                        <div style="clear:both"></div>
                    </ul>
                </div>
            </div>
            <div class="txxx_info2 m-top" style="clear:both">
                <span class="f_weight float_l " style=" margin-right: 5px">详细说明：</span>
                <div class="float_l " style="width:730px; height:400px; border:1px solid #f0f0f0"> 
                    <textarea style="width:728px; height:398px; border:1px solid #f0f0f0" id="Info" name="Info"><?php echo $data['Info'] ?></textarea>
                </div>
                <div style="clear:both"></div>
            </div>
        </div>
    </div>

    <div class="bor_back m-top">
        <p class="txxx">适用车型数据</p>
        <div class="txxx_info">
            <span class=" f_weight">适用车系：</span>
            <input id="make-select" readonly="readonly" key="null_series"  class="input" type="text" value="<?php echo $makecar ?>"style="width:300px">
            <span class="add m_left"><a class="jiahao" onclick="addVehcle()">+</a></span><a href="javascript:;" class="add_wz" onclick="addVehcle()">添加车系</a>
            <?php if ($edit['vehicle']): ?>
                <span style="color:green">(提示：适用车系有变化)</span>
            <?php endif; ?>
            <div class="fitem showVehicle" id="showVehicle"><!-- 显示车系车型 -->
                <?php
                $list = array();
                $make_hidden = 0;
                if ($data['vehicle']) {
                    foreach ($data['vehicle'] as $val) {
                        if (in_array($val['Make'] . ' ' . $val['Car'], $list)) {
                            $html[b . $val['Make'] . ' ' . $val['Car']].= "<li carid=" . $val['Car'] . "><span name='Year'>" . $val['Year'] . "</span>&nbsp<span name='Model'>" . $val['Modeltxt'] . "</span><span onclick='xxVehicle(this)' key='" . $val['ID'] . "' style='padding-right:10px;float:right;cursor:pointer;font-size: 9px;font-family: Georgia;'>　X</span></li>";
                        } else {
                            $html[a . $val['Make'] . ' ' . $val['Car']] .= "<span carID='" . $val['Car'] . "' class='checkbox-add checkbox-add2 bg-white tag-close catespan' id='a" . $val['Car'] . "' ><span name='make'>" . $val['Marktxt'] . "</span> <span name='car'>" . $val['Cartxt'] . "</span></span> ";
                            $html[a . $val['Make'] . ' ' . $val['Car']] .="<div class='show_yearmodel'  id=div_" . $val['Car'] . ">";
                            $html[a . $val['Make'] . ' ' . $val['Car']] .="<ul  id=ul_" . $val['Car'] . ">";
                            $html[a . $val['Make'] . ' ' . $val['Car']] .= "<li car=" . $val['Car'] . "><span name='Year'>" . $val['Year'] . "</span>&nbsp<span name='Model'>" . $val['Modeltxt'] . "</span><span onclick='xxVehicle(this)' key='" . $val['ID'] . "' style='padding-right:10px;float:right;cursor:pointer;font-size: 9px;font-family: Georgia;'>　X</span></li>";

                            $html[c . $val['Make'] . ' ' . $val['Car']].= "</ul>";
                            $html[c . $val['Make'] . ' ' . $val['Car']].= "</div>";
                            $list[] = $val['Make'] . ' ' . $val['Car'];
                            $make_hidden .=', ' . $val['Modeltxt'];
                        }
                    }
                }

                echo " <input type='hidden' id='make_hidden' name='make_hidden' value=" . $make_hidden . ">
                <input type='hidden' id='make' name='make'>
                <input type='hidden' id='car' name='car'>
                <input type='hidden' id='year' name='year'>
                <input type='hidden' id='model' name='model'>
                <input type='hidden' id='maketxt' name='maketxt'>
                <input type='hidden' id='cartxt' name='cartxt'>
                <input type='hidden' id='modeltxt' name='modeltxt'>";
                if ($data['vehicle']) {
                    foreach ($list as $val) {
                        echo $html[a . $val] . $html[b . $val] . $html[c . $val];
                    }
                }
                ?>

            </div>
        </div>
    </div>

    <div class="bor_back m-top">

        <p class="txxx">商品销售信息</p>  
        <div class="txxx_info">
            <div class="txxx_info2 m-top">
                <span class="f_weight float_l m_left12a">商品属性：</span>
                <div class="float_l  back_color m_left12a ">
                    <div class="txxx_info3">
                        <p><span class="color_red" id="PartsLevel_id" style="padding-left: 6px"></span><span style=" margin-left: 6px;">配件档次：</span>
                            <select class='select' name="PartsLevel" id="PartsLevelID">
                                <option value="">请选择配件档次</option>
                                <?php
                                foreach (Yii::app()->getParams()->PartsLevel as $key => $value) {
                                    if ($key == $data['PartsLevel'])
                                        echo " <option value=" . $key . " selected='selected'>" . $value . "</option>";
                                    else
                                        echo " <option value=" . $key . ">" . $value . "</option>";
                                }
                                ?>
                            </select>
                            <?php if ($edit['PartsLevel']): ?>
                                <span style="color:green">(提示：配件档次有变化)</span>
                            <?php endif; ?>
                        </p>
                        <p class="m-top"><span class="m_left36a">单位：</span>
                            <?php
                            $units = GoodsUnit::model()->findAll(array('select' => '*', 'group' => 'UnitName'));
                            $unit = CHtml::listData($units, 'ID', 'UnitName');
                            $unitID = $data['spec']['Unit'];
                            echo CHtml::dropDownList('Unit', $unitID, $unit, array(
                                'class' => 'select select2 ',
                                'empty' => '选择商品单位',
                            ));
                            ?>	
                            <?php if ($edit['Unit']): ?>
                                <span style="color:green">(提示：单位有变化)</span>
                            <?php endif; ?>
                        </p>
                        <p class="m-top">

                            <span class="m_left24a">保修期：</span>   
                            <select class='select' name="ValidityType" id="ValidityID">
                                <option value="1"  <?php if ($data['spec']['ValidityType'] == 1) echo 'selected="selected"' ?>>不保修</option>
                                <option value="2" <?php if ($data['spec']['ValidityType'] == 2) echo 'selected="selected"' ?>>保装车</option>
                                <option value="3" <?php if ($data['spec']['ValidityType'] == 3) echo 'selected="selected"' ?>>保修时间</option>
                            </select>
                            <?php
                            $dataday = mb_substr($data['spec']['ValidityDate'], -1, 1, 'utf-8');
                            $length = strlen($data['spec']['ValidityDate']);
                            $ValidityDate = mb_substr($data['spec']['ValidityDate'], 0, $length - 3, 'utf-8');
                            ?>
                            <span class="validityshow" <?php if ($data['spec']['ValidityType'] != 3) echo 'style="display:none"' ?>><input type="text" maxlength="50"  name="ValidityDate" id="ValidityDateID" value="<?php echo $ValidityDate ?>" class="input width90">
                                <select class='select' name="dataday" style=" width: 40px;">
                                    <option <?php if ($dataday == '月') echo "selected='selected'" ?> value="月"  >月</option>
                                    <option <?php if ($dataday == '天') echo "selected='selected'" ?> value="天">天</option>
                                </select>

                            </span>






<!--                            <span class="m_left24a">保修期：</span>   
                            <select class='select' name="ValidityType" id="ValidityID">
                                <option value="1"  <?php if ($data['spec']['ValidityType'] == 1) echo 'selected = "selected"' ?>>不保修</option>
                                <option value="2" <?php if ($data['spec']['ValidityType'] == 2) echo 'selected = "selected"' ?>>保装车</option>
                                <option value="3" <?php if ($data['spec']['ValidityType'] == 3) echo 'selected = "selected"' ?>>保修时间</option>

                            </select>
                            <span class="validityshow" <?php if ($data['spec']['ValidityType'] != 3) echo 'style = "display:none"' ?>><input type="text" maxlength="50" id="ValidityDateID" name="ValidityDate" value="<?php echo $data['spec']['ValidityDate'] ?>" class="input width30"> </span>-->
                            <?php if ($edit['ValidityType'] || $edit['ValidityDate']): ?>
                                <span style="color:green">(提示：保修期有变化)</span>
                            <?php endif; ?>
                        </p>
                        <p class="m-top"><span>最小包装数：</span>
                            <input type="text"  maxlength="10" name="MinQuantity" class=" input input3 width250" value="<?php echo $data->pack->MinQuantity ?>" >
                            <?php if ($edit['MinQuantity']): ?>
                                <span style="color:green">(提示：最小包装数有变化)</span>
                            <?php endif; ?>
                        </p>
                        <p class="m-top"><span class="color_red" id="Price_id" style="padding-left: 6px"></span><span style=" margin-left: 6px;">销售价格：</span>
                            <input type="text" name="Price" class=" input input3 width250" value="<?php echo $data['Price'] ?>"  >
                            <?php if ($edit['Price']): ?>
                                <span style="color:green">(提示：销售价格有变化)</span>
                            <?php endif; ?>
                        </p>
                        <p class="m-top"> <span class="m_left12a" style="vertical-align:top">特征说明：</span>
                            <textarea name="Memo" maxlength="255" 　class="textarea2" style="margin-left:5px;width: 255px;height: 80px; border:1px solid #ebebeb;resize:none"><?php echo $data['Memo'] ?></textarea>
                            <?php if ($edit['Memo']): ?>
                                <span style="color:green">(提示：特征说明有变化)</span>
                            <?php endif; ?>
                        </p>
                        <p class="m-top"><span class=" m_left12a">标杆品牌：</span>
                            <input type="text" name="BganCompany" maxlength="50" class=" input input3 width250" value="<?php echo $data['spec']['BganCompany'] ?>">
                            <?php if ($edit['BganCompany']): ?>
                                <span style="color:green">(提示：标杆品牌有变化)</span>
                            <?php endif; ?>
                        </p>
                        <p class="m-top"><span class=" m_left24a">原产地：</span>
                            <input type="text" name="Provenance" maxlength="50" class=" input input3 width250" value="<?php echo $data['Provenance'] ?>">
                            <?php if ($edit['Provenance']): ?>
                                <span style="color:green">(提示：原产地有变化)</span>
                            <?php endif; ?>
                        </p>
                        <p class="m-top"><span style="vertical-align:top">标杆商品号：</span>
                            <input type="text"  maxlength="50" name="BganGoodsNO" class=" input input3 width250" value="<?php echo $data['spec']['BganGoodsNO'] ?>">
                            <?php if ($edit['BganGoodsNO']): ?>
                                <span style="color:green">(提示：标杆商品号有变化)</span>
                            <?php endif; ?>
                        </p>
                    </div>
                </div>

                <div style="clear:both"></div>
            </div>
            <?php $this->widget('widgets.default.WGoodsCarModel'); ?>
        </div>

    </div>
</form>
<p align="center" class="m-top"><button class=" button3" id="savegoods" onclick="save()">保存</button><button class=" button3" onclick="cancel()">取消</button></p>
<form id="version" method="post" action="" novalidate  style="display: none">
    <input name="GoodsID" id="VersionGoodsID">
    <input name="Version" id="VersionNO">
</form>
<?php $this->widget('widgets.default.WGoodsCategoryModel'); ?>
<script type="text/javascript" src='<?php echo F::themeUrl(); ?>/js/uploadify/jquery.uploadify.js?ver=<?php echo rand(0, 9999); ?>'></script>
<link rel="stylesheet" href="<?php echo F::themeUrl(); ?>/js/uploadify/uploadify1.css">
<?php include_once 'uploadimgjs.php'; ?>
<?php $this->widget('ext.kindeditor.KindEditorWidget', array('id' => 'Info')); ?>
<script>
    var editor;
    KindEditor.ready(function(K) {
        editor = K.create('#Info', {
            resizeType: 2,
            //            cssPath: ['../plugins/code/prettify.css', 'index.css'],
            allowPreviewEmoticons: false,
            allowImageUpload: false,
            items: [
                //                'fontname', 'fontsize', '|', 'forecolor', 'hilitecolor', 'bold', 'italic', 'underline',
                //                'removeformat', '|', 'justifyleft', 'justifycenter', 'justifyright', 'insertorderedlist',
                //                'insertunorderedlist']
                'fontname', '|', 'bold', 'italic', 'underline',
                'removeformat', '|', 'justifyleft', 'justifycenter', 'justifyright', 'insertorderedlist',
                'insertunorderedlist']
        });
    })

</script>
<script>
    $('#make-select').click(function() {
        $('.show_yearmodel').hide();
    });
    $(document).click(function(e) {
        e.stopPropagation();
        $("#selectBig").hide();
    })



    //适用车系显示隐藏
    var car_id = 0;
    $(document).scroll(function() {
        $('.show_yearmodel').hide();
    })
    $('.show_yearmodel').live('mouseleave', function() {
        $(this).hide();
    });
    $('.show_yearmodel').live('mouseover', function() {
        $(this).show();
    });
    $('.show_yearmodel li').live('mouseover', function() {
        $(this).css({'color': 'green'});
    });
    $('.show_yearmodel li').live('mouseleave', function() {
        $(this).css({'color': 'grey'});
    });
    //取消
    function cancel() {
        var url = Yii_baseUrl + '/pap/dealergoods/drop';
        window.location.href = url;
    }
    $(function() {



        //适用车系显示
        $(".checkbox-add2").live('click', function() {
            var carID = $(this).attr('carID');
            var car = '#a' + carID;
            if (car_id != carID) {
                var offset = $(this).offset();
                var left, top;
                left = (offset.left) + 'px';
                top = (offset.top) - 35 + 57 + 'px';
                $("<span id='s" + carID + "' onclick='xxcar(this)' key='" + carID + "' style='float:right;cursor:pointer;font-size: 9px;font-family: Georgia;'>　X</span>").appendTo(car);
                $(car).removeClass("bg-white");
                $(car).addClass("bg-green");
                if (car_id != 0) {
                    $('#div_' + car_id).hide();
                    var car_a = '#a' + car_id;
                    var car_s = '#s' + car_id;
                    $(car_a).removeClass("bg-green");
                    $(car_a).addClass("bg-white");
                    $(car_s).remove();
                }
                $('#div_' + carID).css({'top': top, 'left': left}).show();
            } else {
                $('#div_' + carID).show();
            }
            if (car_id == 'aa') {
                car_id = 0;
            } else {
                car_id = carID;
            }
        });
    })
    //返回重选品类
    function backto() {
        var url = Yii_baseUrl + '/pap/dealergoods/addinfo1';
        window.location.href = url;
    }
    //发布
    function save() {
<?php $prices = DealergoodsService::getmaxprice(); ?>
        var maxprice =<?php echo $prices['maxprice']; ?>;
        var maxnum =<?php echo $prices['maxnum']; ?>;
        //获得详情
        editor.sync();
        //获得品牌名称
        var brand = $("#goodsBrand :selected").text();
        $("input[name=BrandName]").val(brand);
        //拼图片
        var urlimg = 0;
        $("#showimglist li").each(function() {
            if ($(this).find('img').attr('add') == 'add') {
                urlimg += ',^' + $(this).find('img[name=urlimg]').attr('key');
                urlimg += ';' + $(this).find('img[name=urlimg]').attr('imgname');
            }
        });
        $("#imgupload").val(urlimg);
        //拼适用车系
        var make = 0;
        var car = 0;
        var year = 0;
        var model = 0;
        var maketxt = 0;
        var cartxt = 0;
        var modeltxt = 0;
        var veh = 0;
        $("#showVehicle li").each(function() {
            if ($(this).find('span[name=make]').html()) {
                make += ',' + $(this).find('span[name=make]').html();
                car += ',' + $(this).find('span[name=car]').html();
                year += ',' + $(this).find('span[name=year]').html();
                model += ',' + $(this).find('span[name=model]').html();
                maketxt += ',' + $(this).find('span[name=maketext]').html();
                cartxt += ',' + $(this).find('span[name=cartext]').html();
                modeltxt += ',' + $(this).find('span[name=modeltext]').html();
            }
            veh++;
        })
        $("#make").val(make);
        $("#car").val(car);
        $("#year").val(year);
        $("#model").val(model);
        $("#maketxt").val(maketxt);
        $("#cartxt").val(cartxt);
        $("#modeltxt").val(modeltxt);
        if (!$('select[name=PartsLevel]').val()) {
            alert("请为您的商品填写配件档次");
            return false;
        }
        if (!veh) {
            alert("请为您的商品选择适用车系");
            return false;
        }
        if (!make) {
            alert("请为您的商品选择适用车系");
            return false;
        }
        if (!$('input[name=Name]').val()) {
            alert("请为您的商品填写商品名称");
            return false;
        }
        if ($('input[name=Name]').val().length > 20) {
            alert('商品名称太长');
            return false;
        }
        if (!$('input[name=Price]').val()) {
            alert("请为您的商品填写销售价格");
            return false;
        } else {
            var Price = $('input[name=Price]').val();
            var reg = new RegExp("^[0-9]{1," + maxnum + "}([.]{1,1}[0-9]{1,2})?$");
            if (!reg.test(Price)) {
                alert('请输入小于' + maxprice + '的数。正确格式 ：123.00，123');
                return false;
            }
        }
        if (!$('input[name=GoodsNO]').val()) {
            alert("请为您的商品填写商品编号");
            return false;
        }
        if ($('input[name=GoodsNO]').val().length > 20) {
            alert("商品编号太长");
            return false;
        }
        if (!$('input[name=Pinyin]').val()) {
            alert("请为您的商品填写拼音代码");
            return false;
        }
        $("#fm").attr("action", Yii_baseUrl + "/pap/dealergoods/save");
        car_id = 'aa';
        $("#fm").submit();
        $('#savegoods').attr("disabled", "disabled");
    }
    //保质期正则
    function vdreg() {
        var ValidityDate = $("input[name=ValidityDate]").val();
        var reg = /^(0?[[0-9]|1[0-2])$/;

        if (!reg.test(ValidityDate)) {
            alert('请输入正确月份');
            return false;
        } else {
            return true;
        }
    }
    $(function() {
<?php $prices = DealergoodsService::getmaxprice(); ?>
        var maxprice =<?php echo $prices['maxprice']; ?>;
        var maxnum =<?php echo $prices['maxnum']; ?>;
        //保修期 显示判断
        $("#ValidityID").change(function() {
            var vtype = $(this).val();
            if (vtype == 3) {
                $('.validityshow').show();
            } else {
                $('.validityshow').hide();
            }
        });

        //配件档次 *显示判断
        $("#PartsLevelID").change(function() {
            var ptype = $(this).val();
            if (ptype != '') {
                $('#PartsLevel_id').html('');
                $('#PartsLevel_id').attr('style', 'padding-left:6px');
            } else {
                $('#PartsLevel_id').html('*');
                $('#PartsLevel_id').attr('style', 'padding-left:0px');
            }
        });
        //姓名 *显示判断 并获得拼音 
        $("input[name=Name]").blur(function() {
            var name = $(this).val();
            if (name.length > 20) {
                alert('商品名称太长');
                return false;
            }
            if (name) {
                $('#Name_id').html('');
                $('#Name_id').attr('style', 'padding-left:12px');
            } else {
                $('#Name_id').html('*');
                $('#Name_id').attr('style', 'padding-left:0px');
            }
            var url = Yii_baseUrl + '/pap/dealergoods/Getpinyin';
            $.getJSON(url, {name: name}, function(a) {
                $("#pinyincode").val(a);
                if (a) {
                    $('#Pinyin_id').html('');
                    $('#Pinyin_id').attr('style', 'padding-left:12px');
                } else {
                    $('#Pinyin_id').html('*');
                    $('#Pinyin_id').attr('style', 'padding-left:0px');
                }

            })
        })
        //商品编号 *显示判断
        $("input[name=GoodsNO]").blur(function() {
            var GoodsNO = $(this).val();
            var reg = /^[A-Za-z0-9-]+$/;
            if (!reg.test(GoodsNO)) {
                alert('商品编号必填，且不能为汉字');
                return false;
            }
            if (GoodsNO) {
                $('#GoodsNO_id').html('');
                $('#GoodsNO_id').attr('style', 'padding-left:12px');
            } else {
                $('#GoodsNO_id').html('*');
                $('#GoodsNO_id').attr('style', 'padding-left:0px');
            }
        })
        //参考价格 *显示判断
        $("input[name=Price]").blur(function() {
            var Price = $(this).val();
            var reg = new RegExp("^[0-9]{1," + maxnum + "}([.]{1,1}[0-9]{1,2})?$");
            if (!reg.test(Price)) {
                alert('价格必填，请输入小于' + maxprice + '的数。正确格式 ：123.00，123');
            }
            if (Price <= 0) {
                alert('价格必须大于0');
                return false;
            }
            if (Price) {
                $('#Price_id').html('');
                $('#Price_id').attr('style', 'padding-left:6px');
            } else {
                $('#Price_id').html('*');
                $('#Price_id').attr('style', 'padding-left:0px');
            }
        })
    });
    // 添加OENO　号
    function addOENO() {
        var status = $('#oe_id').attr('key');
        if (status == 'no') {
            alert('OE号重复');
            return false;
        }
        var OE_empty = 0;
        $("#showoe p").each(function() {
            var OE = $(this).find('input[type=text]').val();
            if (!OE)
            {
                OE_empty += 1;
            }
        })
        if (OE_empty) {
            alert('请填写空的输入框');
            return false;
        }
        var al = "<p class='m-top'><input type='text' name='OENOS[]' class='input input3 width250' style='margin-left:81px' onblur='oechange()'></p>";
        $("#showoe").append(al);
    }
    ;

    //oe号重复判断
    function oechange() {
        var OEs = new Array();
        var same = 0;
        $("#showoe p").each(function() {
            var OE = $(this).find('input[type=text]').val();
            if ($.inArray(OE, OEs) == -1) {
                OEs.push(OE);
            } else {
                same = 1;
            }

        })
        if (same == 1) {
            alert('OE号重复');
            $('#oe_id').attr('key', 'no')
            return false;
        } else {
            $('#oe_id').attr('key', 'yes')
            return true;
        }
    }

    /*
     *添加车系
     */


    function addVehcle() {
        if ($("#make-select").val() == '请选择适用车系') {
            alert('您还没有请选择厂家类别！');
            return false;
        }
        if ($("#showVehicle span.catespan").length < 100) {
            var makeval = $("#ul-makes li.selected3 a").attr("key")
            var carval = $("#ul-series li.selected3 a").attr("key")
            var yearval = $("#ul-year li.selected3 a").attr("key")
            var modelval = $("#ul-model li.selected3 a").attr("key")
            // 前市场车型
            var make = $("#ul-makes li.selected3 a").html();
            var car = $("#ul-series li.selected3 a").html();
            var year = $("#ul-year li.selected3 a").html();
            var model = $("#ul-model li.selected3 a").html();
            if (!make) {
                make = '请选择厂家'
            }
            if (!car || car == '所有车系') {
                car = '请选择车系'
            }
            if (!year || year == '所有年款') {
                year = '请选择年款'
            }
            if (!model || model == '所有车型') {
                model = '请选择车型'
            }
            var cart = car;
            var yeart = year;
            var modelt = model;
            var arr = new Array();
            var list = new Array();
            var listadd = 0;
            if (make == "请选择厂家")
            {
                alert('您还没有请选择厂家类别！');
                return false;
            }
            if (car == "请选择车系")
            {
                alert('您还没有请选择车系类别！');
                return false;
            }
            else {
                var m_hid = $("#make_hidden").val();
                $("#make_hidden").val(m_hid + ',' + make);

                if ($("#showVehicle span.catespan").length == 0) {
                    var span = '';
                    span += "<span carID='" + carval + "' class='checkbox-add checkbox-add2 bg-white tag-close catespan' id='a" + carval + "' ><span name='make'>" + make + "</span> <span name='car'>" + cart + "</span></span> ";
                    span += "<div class='show_yearmodel'  id=div_" + carval + ">";
                    span += "<ul id=ul_" + carval + ">";
                    span += "</ul>";
                    span += "</div>";
                    $("#showVehicle").append(span);
                } else {
                    $("#showVehicle span.catespan").each(function() {
                        var cpCar = $(this).find('span[name=car]').html();
                        var cpmake = $(this).find('span[name=make]').html();
                        arr.push(cpCar + '' + cpmake);
                    })
                    if ($.inArray(cart + '' + make, arr) == -1) {
                        var span = '';
                        span += "<span carID='" + carval + "' class='checkbox-add checkbox-add2 bg-white tag-close catespan' id='a" + carval + "' ><span name='make'>" + make + "</span> <span name='car'>" + cart + "</span></span> ";
                        span += "<div class='show_yearmodel'  id=div_" + carval + ">";
                        span += "<ul id=ul_" + carval + ">";
                        span += "</ul>";
                        span += "</div>";
                        $("#showVehicle").append(span);
                    }
                }
            }
            $("#ul_" + carval + " li").each(function() {
                var cpYear = $(this).find('span[name=Year]').html();
                var cpModel = $(this).find('span[name=Model]').html();
                list.push(cpYear + '' + cpModel);
            })
            if (year != '请选择年款' && model != '请选择车型') {
                if ($.inArray(yearval + '' + model, list) == -1) {
                    var li = "<li car=" + carval + "><span name=Year>" + yearval + "</span> <span name=Model>" + model + "</span><span onclick='xxVehicle(this)' key='0' class='xxVehicle' style=';float:right;cursor:pointer;font-size: 9px;font-family: Georgia;'>　X</span><span style='display:none' name='make'>" + makeval + "</span><span style='display:none' name='car'>" + carval + "</span><span style='display:none' name='year'>" + yearval + "</span><span style='display:none' name='model'>" + modelval + "</span><span style='display:none' name='maketext'>" + make + "</span><span style='display:none' name='cartext'>" + car + "</span><span style='display:none' name='yeartext'>" + year + "</span><span style='display:none'  name='modeltext'>" + model + "</span></li>";
                    $("#ul_" + carval).append(li);
                    alert('添加成功')
                } else {
                    alert('添加失败,该车系可能已经添加');
                }
            }
            if (year == '请选择年款' || model == '请选择车型') {
                var url = Yii_baseUrl + "/pap/Dealergoods/Getyearmodel"
                $.getJSON(url, {carID: carval, Year: year}, function(result) {
                    if (result) {
                        $.each(result, function(index, value) {
                            if ($.inArray(value.Year + '' + value.Modeltxt, list) == -1) {
                                listadd += 1;
                            }
                        });
                        if (listadd) {
                            $.each(result, function(index, value) {
                                if ($.inArray(value.Year + '' + value.Modeltxt, list) == -1) {
                                    var li = "<li  car=" + carval + "><span name=Year>" + value.Year + "</span> <span name=Model>" + value.Modeltxt + "</span><span onclick='xxVehicle(this)' key='0' style='padding-right:10px;float:right;cursor:pointer;font-size: 9px;font-family: Georgia;'>　X</span><span style='display:none' name='make'>" + makeval + "</span><span style='display:none' name='car'>" + carval + "</span><span style='display:none' name='year'>" + value.Year + "</span><span style='display:none' name='model'>" + value.Model + "</span><span style='display:none' name='maketext'>" + make + "</span><span style='display:none' name='cartext'>" + car + "</span><span style='display:none' name='yeartext'>" + value.Year + "</span><span style='display:none'  name='modeltext'>" + value.Modeltxt + "</span></li>";
                                    $("#ul_" + carval).append(li);
                                }
                            });
                            alert('添加成功')
                        } else {
                            alert('添加失败,该车系可能已经全部添加');
                        }
                    }
                });
            }
        } else {
            $.messager.alert('提示信息', "最多只能添加100个", 'warning');
        }
    }
    ;
    /*
     *
     *删除OE 
     */
    function xxOENO(obj) {
        var cateid = obj.getAttribute("key")
        if (cateid != 0)
        {
            var url = " <?php echo Yii::app()->createUrl('pap/dealergoods/Deletegoodsoe'); ?>";
            $.getJSON(url, {cateid: cateid}, function(data) {
                if (data == 1)
                    $(obj).parent().remove();
            });
        } else {
            $(obj).parent().remove();
        }
    }

    //删除整个主营车系
    function xxcar(obj) {
        var cateid = obj.getAttribute("key");
        var goodsid = $("#GoodsID").val();
        if (cateid != 0)
        {
            var url = " <?php echo Yii::app()->createUrl('pap/dealergoods/Deletecar'); ?>";
            $.getJSON(url, {cateid: cateid, goodsid: goodsid}, function(data) {
                if (data == 1) {
                    return true;
                } else {
                    return false;
                }
            });
        }
        $("#div_" + cateid).remove();
        $(obj).parent().remove();
        car_id = 'aa';
    }
    //删除单个主营车系
    function xxVehicle(obj) {
        var cateid = obj.getAttribute("key")
        var parentID = $(obj).parent().attr('car');
        if ($("#ul_" + parentID).find('li').length == 1) {
            $("#a" + parentID).remove();
            $("#div_" + parentID).remove();
        }
        if (cateid != 0)
        {
            var url = " <?php echo Yii::app()->createUrl('pap/dealergoods/Deletevehicle'); ?>";
            $.getJSON(url, {cateid: cateid}, function(data) {
                if (data == 1)
                    $(obj).parent().remove();
            });
        } else {
            $(obj).parent().remove();
        }
    }
    //删除图片
    function xximage(obj) {
        var add = $(obj).attr('add');
        var path = $(obj).attr('key');
        if (add === 'add') {
            var url = Yii_baseUrl + '/upload/FtpDelfile';
            $.post(url, {'path': path}, function(res) {
                if (res.res === 1) {
                    $(obj).parent().remove();
                    $("#file_upload").uploadify('disable', false);
                } else {
                    alert('删除失败');
                }
            }, 'json');
        }
        if (add === 'save') {
            var delimg = $('#delurlimg').val();
            if (delimg) {
                $('#delurlimg').val(delimg + ',^' + path);
            } else {
                $('#delurlimg').val(path);
            }
            $(obj).parent().remove();
            $("#file_upload").uploadify('disable', false);
        }


    }

    $(document).ready(function() {

        $("#uploadify .showimg").each(function() {
            if ($(this).find('img[save=save]')) {
                var idkey = $(this).find('img[name=urlimg]').attr('idkey');
                $("#file_upload" + idkey).hide();
            }
        })


        $("#p-leafcate .li_list").live('click', function() {
            var bignameid = $("#ul-bigcate .selected2 a").attr('key');
            $('#bignameid_value').val(bignameid);
            var subnameid = $("#ul-subcate .selected2 a").attr('key');
            $('#subnameid_value').val(subnameid);
            var code = $(this).attr('code');
            $('#code_value').val(code);
        });
        // 点击输入框弹出div层
        $("#cpname-search").click(function(e) {
            cpname_search = true;
            e.stopPropagation();
            //alert(1234);
            cpnametxt = '';
            $("#cpname-search").val(cpnametxt);
            var offset = $(this).offset();
            var left, top, url, data;
            //            if(typeof(countSelf) == 'undefined'){
            //                left = offset.left -210+ 'px';
            //                top = offset.top +26 + 'px';
            //            }
            //            else{
            var width = $(window).width();
            //屏幕宽度大于1000
            if (width > 1000) {
                var cutwidth = (width - 1000) / 2;
            } else {
                cutwidth = 0;
            }

            left = (offset.left - cutwidth) + 'px';
            top = (offset.top + 26) + 'px';
            //            }
            // alert(offset.left);
            $("#selectBig").css({'left': left, 'top': top}).show();
            $("#ul-bigcate li:first").click();
            $("#make-car-m").hide();
        });
    });
    //版本跳转
    $(function() {
        $('#verselect').change(function() {
            //            alert($('#verselect option:selected').attr('version'));
            $("#VersionGoodsID").val($('#verselect option:selected').attr('goodsid'));
            $("#VersionNO").val($('#verselect option:selected').attr('version'));

            $("#version").submit();
        })
    })
</script>