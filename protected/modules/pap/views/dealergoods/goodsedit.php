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
    /*.uploadify-queue{ display: none;}*/ 

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
    .show-msg{   background: none repeat scroll 0 0 #fff;
                 border: 1px solid #73a6d5;
                 border-radius: 1px;
                 box-shadow: 0 0 2px 2px #eee;
                 display: none;
                 line-height: 22px;
                 min-height: 183px;
                 padding: 9px;
                 position: absolute;
                 right: 88px;
                 text-align: left;
                 top: -20px;
                 width: 450px;
                 z-index: 10;}   
    .od_time {
        display: block;
        float: left;
        width: 112px;
        font-size: 12px;
    }
    .txxx span{

        font-size:12px;
        font-weight:normal;
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
        <div class="txxx">填写基本信息
            <!--<span class="bijiao" style="color:black;font-weight: 400;">比较</span>-->

            <div style="  float: right;
                 height: 25px;
                 line-height: 25px;
                 padding: 3px 24px;
                 position: relative;
                 width: 80px;
                 font-size: 12px;"  onmouseleave="closeinfo(<?php echo $data['ID'] ?>)" >
                <div class="mouse_div" style="width:100%;height:20px;cursor:pointer;text-align: left;"><a href="javascript:void(0)"><span onClick="showinfo(<?php echo $data['ID'] ?>)">修改明细</span></a></div>
                <div class="show-msg" id="follow<?php echo $data->ID ?>" style=" font-weight: normal">
                </div>
            </div>

        </div>
        <input type="hidden" id="GoodsID" name="GoodsID" value="<?php echo $data->ID ?>">
        <div class="txxx_info">
            <span class="color_red" id="Name_id" style="padding-left: 9px"></span><span class=" f_weight">商品名称：</span>
            <input type="text" name="Name" maxlength="50" class=" input input3 width375" value="<?php echo $data->Name ?>" ><span style="color:green;font-size:12px;font-weight: 400;">(提示：商品名称最多为50个字)</span>
            <?php if ($data->Version): ?>
                <div class="txxx_info2 m-top">
                    <span class="f_weight float_l m_left9">版本信息：</span>
                    <div class="float_l  back_color m_left12 ">
                        <div class="txxx_info3">
                            <p>
                                <span class="color_red" id="GoodsNO_id">&nbsp;</span> <span>最新版本：</span>
                                <input type="text" class=" input input3 width250" value="<?php echo date('Y-m-d H:i:s', $data->Version) ?>">
                            </p>
                            <p class="m-top">
                                <span class="color_red" id="Pinyin_id">&nbsp;</span> <span>历史版本：</span>
                                <select id="verselect" class='select'>
                                    <?php
                                    $Version = DealergoodsService::getgoodsversion($data->ID);
                                    foreach ($Version as $Verk => $Verv) {
                                        if ($data->Version == $Verv) {
                                            echo " <option selected='selected' version='" . $Verv . "' goodsid='" . $data->ID . "'>" . date('Y-m-d H:i:s', $Verv) . "</option>";
                                        } else {
                                            echo " <option version='" . $Verv . "' goodsid='" . $data->ID . "'>" . date('Y-m-d H:i:s', $Verv) . "</option>";
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
                            <input type="text" disabled="disabled"  class=" input input3 width250" value="<?php echo $data->GoodsNO ?>">
                            <input type="hidden" name="GoodsNO"  class=" input input3 width250" value="<?php echo $data->GoodsNO ?>">
                        </p>
                        <p class="m-top"><span class="color_red" id="Pinyin_id"  style="padding-left: 9px;"></span> <span>拼音代码：</span>
                            <input type="text" name="Pinyin" id="pinyincode" maxlength="50" class=" input input3 width250" value="<?php echo $data->Pinyin ?>" ></p>
                        <p class="m-top">
                            <span  class="p_left9">配件品类：</span>
                            <?php $cpname = DealergoodsService::StandCodegetcpname($data->StandCode, 'Name'); ?>
                            <input id="cpname-search" name="cpname" readonly="readonly" type="text" class=" input input3 width250" value="<?php echo $cpname; ?>"  >
                            <input type="hidden" name="StandCode" id="code_value" value="<?php echo $data->StandCode ?>"/>
                            <input type="hidden" name="bignameid" id="bignameid_value"/>
                            <input type="hidden" name="subnameid" id="subnameid_value"/>
                        </p>
                        <p class="m-top"> <span class=" p_left9">商品品牌：</span>
                            <?php
                            $selected = $data->BrandID;
                            $brandNames = DealergoodsService::codegetbrand($data->StandCode);
                            $brandName = $brandNames ? $brandNames : array();
                            echo CHtml::dropDownList('goodsBrand', $selected, $brandName, array(
                                'class' => 'select select2 ',
                                'empty' => '选择商品品牌',
                            ));
                            ?>	
                            <input type="hidden" name="BrandName">

                        </p>
                        <div id="showoe"> 
                            <p class="m-top">
                                <span class=" p_left33">OE号：</span>
                                <input type="text"  maxlength="20" id="oe_id"  key="yes" name="OENOS[]" value="<?php echo $data->goodoe[0]['OENO']; ?>" class=" input input3 width250" onblur="oechange()">
                                <span class="add m_left"><a class="jiahao"  onclick="addOENO()">+</a></span><a href="javascript:void(0)" class="add_wz" onclick="addOENO()">添加OE号</a>
                            </p>
                            <?php
                            foreach ($data->goodoe as $key => $val) {
                                if ($key != 0)
                                    echo "<p class='m-top'><input maxlength='20' type='text' name='OENOS[]' value='" . $val['OENO'] . "' class='input input3 width250' style='margin-left:81px' onblur='oechange()'></p>";
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
                            foreach ($data->img as $val) {
                                echo " <li class='float_l' style='margin-right:5px;'><img ondblclick='xximage(this)' name='urlimg' key=" . $val['ImageUrl'] . "  imgname=" . $val['ImageName'] . " add='save' style='width:80px;height:80px;' src=" . F::uploadUrl() . $val['ImageUrl'] . "></li>";
                            }
                            ?>
                        </div>
                        <input type="hidden" name="delimg" value="" id="delurlimg">
                        <input type="hidden" name="urlimg" value="" id="imgupload">
                        <div style="clear:both"></div>
                    </ul>
                </div>
            </div>
            <div class="txxx_info2 m-top" style="clear:both">
                <span class="f_weight float_l " style=" margin-right: 5px">详细说明：</span>
                <div class="float_l " style="width:730px; height:400px; border:1px solid #f0f0f0"> 
                    <textarea style="width:728px; height:398px; border:1px solid #f0f0f0" id="Info" name="Info"><?php echo $data->Info ?></textarea>
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
            <div class="fitem showVehicle" id="showVehicle"><!-- 显示车系车型 -->
                <?php
                $list = array();
                $make_hidden = 0;
                foreach ($data->vehicle as $val) {
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
                        $make_hidden .=',' . $val['Modeltxt'];
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
                foreach ($list as $val) {
                    echo $html[a . $val] . $html[b . $val] . $html[c . $val];
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
                                    if ($key == $data->PartsLevel)
                                        echo " <option value=" . $key . " selected='selected'>" . $value . "</option>";
                                    else
                                        echo " <option value=" . $key . ">" . $value . "</option>";
                                }
                                ?>
                            </select>
                        </p>
                        <p class="m-top"><span class="m_left36a">单位：</span>
                            <?php
                            $units = GoodsUnit::model()->findAll(array('select' => '*', 'group' => 'UnitName'));
                            $unit = CHtml::listData($units, 'ID', 'UnitName');
                            $unitID = $data->spec->Unit;
                            echo CHtml::dropDownList('Unit', $unitID, $unit, array(
                                'class' => 'select select2 ',
                                'empty' => '选择商品单位',
                            ));
                            ?>	
                        </p>
                        <p class="m-top">
                            <span class="m_left24a">保修期：</span>   
                            <select class='select' name="ValidityType" id="ValidityID">
                                <option value="1"  <?php if ($data->spec->ValidityType == 1) echo 'selected="selected"' ?>>不保修</option>
                                <option value="2" <?php if ($data->spec->ValidityType == 2) echo 'selected="selected"' ?>>保装车</option>
                                <option value="3" <?php if ($data->spec->ValidityType == 3) echo 'selected="selected"' ?>>保修时间</option>
                            </select>
                            <?php
                            $dataday = mb_substr($data->spec->ValidityDate, -1, 1, 'utf-8');
                            $length = strlen($data->spec->ValidityDate);
                            $ValidityDate = mb_substr($data->spec->ValidityDate, 0, $length - 3, 'utf-8');
                            ?>
                            <span class="validityshow" <?php if ($data->spec->ValidityType != 3) echo 'style="display:none"' ?>><input type="text" maxlength="50"  name="ValidityDate" id="ValidityDateID" value="<?php echo $ValidityDate ?>" class="input width90">
                                <select class='select' name="dataday" style=" width: 40px;">
                                    <option <?php if ($dataday == '月') echo "selected='selected'" ?> value="月"  >月</option>
                                    <option <?php if ($dataday == '天') echo "selected='selected'" ?> value="天">天</option>
                                </select>

                            </span>
                        </p>
                        <p class="m-top"><span>最小包装数：</span>
                            <input type="text" name="MinQuantity" maxlength="10" class=" input input3 width250" value="<?php echo $data->pack->MinQuantity ?>" ></p>
                        <p class="m-top"><span class="color_red" id="Price_id" style="padding-left: 6px"></span><span style=" margin-left: 6px;">销售价格：</span>
                            <input type="text" name="Price" class=" input input3 width250" value="<?php echo $data->Price ?>"  ></p>
                        <p class="m-top"> <span class="m_left12a" style="vertical-align:top">特征说明：</span>
                            <textarea name="Memo"　class="textarea2" maxlength="255" style="margin-left:5px;width: 255px;height: 80px; border:1px solid #ebebeb;resize:none"><?php echo $data->Memo ?></textarea>
                        </p>
                        <p class="m-top"><span class=" m_left12a">标杆品牌：</span>
                            <input type="text" name="BganCompany" maxlength="50" class=" input input3 width250" value="<?php echo $data->spec->BganCompany ?>">
                        </p>
                        <p class="m-top"><span class=" m_left24a">原产地：</span>
                            <input type="text" name="Provenance" maxlength="50" class=" input input3 width250" value="<?php echo $data->Provenance ?>">
                        </p>
                        <p class="m-top"><span style="vertical-align:top">标杆商品号：</span>
                            <input type="text" name="BganGoodsNO" maxlength="50" class=" input input3 width250" value="<?php echo $data->spec->BganGoodsNO ?>">
                        </p>
                    </div>
                </div>
                <div style="clear:both"></div>
            </div>
            <?php $this->widget('widgets.default.WGoodsCarModelSelf'); ?>
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
//        var url = Yii_baseUrl + '/pap/dealergoods/drop';
//        window.location.href = url;
        window.history.go(-1);
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
    });
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
        });
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
        if (!$('input[name=Name]').val()) {
            alert("请为您的商品填写商品名称");
            return false;
        }
        if ($('input[name=Name]').val().length > 50) {
            alert('商品名称太长');
            return false;
        }
        if (isNaN($('#ValidityDateID').val()) && $('#ValidityID').val() == 3) {
            alert('保修时间必须为数字');
            return false;
        }
        if (!$('input[name=Price]').val()) {
            alert("请为您的商品填写销售价格");
            return false;
        } else {
            var Price = $('input[name=Price]').val();
            var reg = new RegExp("^[0-9]{1," + maxnum + "}([.]{1,1}[0-9]{1,2})?$");
            if (!reg.test(Price)) {
                alert('价格必填，请输入小于' + maxprice + '的数。正确格式 ：123.00，123');
                return false;
            }
            if (Price <= 0) {
                alert('价格必须大于0');
                return false;
            }
        }
        if (!$('input[name=GoodsNO]').val()) {
            alert("请为您的商品填写商品编号");
            return false;
        } else {
            var GoodsNO = $('input[name=GoodsNO]').val();
            var reg = /^[A-Za-z0-9- ]+$/;
            if (!reg.test(GoodsNO)) {
                alert('商品编号应由字母数字空格-组成');
                return false;
            }
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
        //判断保修时间为数字
        $("#ValidityDateID").blur(function() {
            if (isNaN($('#ValidityDateID').val())) {
                alert('保修时间必须为数字');
                return false;
            }
        })
        //姓名 *显示判断 并获得拼音 
        $("input[name=Name]").blur(function() {
            var name = $(this).val();
            if (name.length > 50) {
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

            });
        });
        //商品编号 *显示判断
        $("input[name=GoodsNO]").blur(function() {
            var GoodsNO = $(this).val();
            if (GoodsNO) {
                var reg = /^[A-Za-z0-9- ]+$/;
                if (!reg.test(GoodsNO)) {
                    alert('商品编号应由字母数字空格-组成');
                    return false;
                }
                $('#GoodsNO_id').html('');
                $('#GoodsNO_id').attr('style', 'padding-left:12px');
            } else {
                $('#GoodsNO_id').html('*');
                $('#GoodsNO_id').attr('style', 'padding-left:0px');
            }
        });
        //参考价格 *显示判断
        $("input[name=Price]").blur(function() {
            var Price = $(this).val();
            if (Price <= 0) {
                alert('价格必须大于0');
                return false;
            }
            if (Price) {
                var reg = new RegExp("^[0-9]{1," + maxnum + "}([.]{1,1}[0-9]{1,2})?$");
                if (!reg.test(Price)) {
                    alert('价格必填，请输入小于' + maxprice + '的数。正确格式 ：123.00，123');
                }
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
        if ($("#showoe p").length >= 5) {
            alert("OE号最多只能添加5个");
            return false;
        }
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
        var al = "<p class='m-top'><input  maxlength='20' type='text' name='OENOS[]' class='input input3 width250' style='margin-left:81px' onblur='oechange()'></p>";
        $("#showoe").append(al);
    }
    ;
    //oe号重复判断
    function oechange() {
        var OEs = new Array();
        var same = 0;
        $("#showoe p").each(function() {
            var OE = $(this).find('input[type=text]').val();
            if (OE) {
                if ($.inArray(OE, OEs) == -1) {
                    OEs.push(OE);
                } else {
                    same = 1;
                }
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
            });
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

        //        $("#uploadify .showimg").each(function() {
        //            if ($(this).find('img[save=save]')) {
        //                var idkey = $(this).find('img[name=urlimg]').attr('idkey');
        //                $("#file_upload" + idkey).hide();
        //            }
        //        });


        $("#p-leafcate .li_list").live('click', function() {
            var bignameid = $("#ul-bigcate .selected2 a").attr('key');
            $('#bignameid_value').val(bignameid);
            var subnameid = $("#ul-subcate .selected2 a").attr('key');
            $('#subnameid_value').val(subnameid);
            var code = $(this).attr('code');
            $('#code_value').val(code);
        });
    });
    //版本跳转
    $(function() {
        $('#verselect').change(function() {
            //            alert($('#verselect option:selected').attr('version'));
            $("#VersionGoodsID").val($('#verselect option:selected').attr('goodsid'));
            $("#VersionNO").val($('#verselect option:selected').attr('version'));
            $("#version").submit();
        });
    });
    //比较
    function showinfo(id) {
        if ($('#follow' + id).attr('load') == 'loaded') {
            $('#follow' + id).show();
            return false;
        }
        var url = Yii_baseUrl + '/pap/Dealergoods/Haveversion';
        $.ajax({
            url: url,
            type: 'POST',
            data: {'GoodsID': id},
            dataType: 'JSON',
            success: function(data)
            {

                var html = '<div style="font-weight:bold;border-bottom:1px solid #73a6d5;padding-bottom:5px">';
                html += '<label style="padding-right:60px">更改字段</label><label>更改信息</label>';
                html += '<a onclick="closeinfo(' + id + ')" style="float:right;padding-right:2px;*margin-top:-30px">×</a></div>';
                html += '<div style="height:165px;overflow-y:auto;">';
                if (data.empty === 0) {
                    for (var i = 0, n = data.edit.goodslog.length; i < n; i++)
                    {
                        if (data.edit.goodslog[i].Name) {
                            html += '<p><span class="od_time">商品名称</span>由<span style="color:red">' + data.edit.goodslog[i].Name.old + '</span>改为<span style="color:red">' + data.edit.goodslog[i].Name.news + '</span></p>';
                        }
                        if (data.edit.goodslog[i].Pinyin) {
                            html += '<p><span class="od_time">商品拼音</span>由<span style="color:red">' + data.edit.goodslog[i].Pinyin.old + '</span>改为<span style="color:red">' + data.edit.goodslog[i].Pinyin.news + '</span></p>';
                        }
                        if (data.edit.goodslog[i].GoodsNO) {
                            html += '<p><span class="od_time">商品编号</span>由<span style="color:red">' + data.edit.goodslog[i].GoodsNO.old + '</span>改为<span style="color:red">' + data.edit.goodslog[i].GoodsNO.news + '</span></p>';
                        }
                        if (data.edit.goodslog[i].Price) {
                            html += '<p><span class="od_time">商品价格</span>由<span style="color:red">' + data.edit.goodslog[i].Price.old + '</span>改为<span style="color:red">' + data.edit.goodslog[i].Price.news + '</span></p>';
                        }
                        if (data.edit.goodslog[i].PartsLevel) {
                            html += '<p><span class="od_time">商品档次</span>由<span style="color:red">' + data.edit.goodslog[i].PartsLevelName.old + '</span>改为<span style="color:red">' + data.edit.goodslog[i].PartsLevelName.news + '</span></p>';
                        }
                        if (data.edit.goodslog[i].Unit) {
                            if (!data.edit.goodslog[i].Unit.old && data.edit.goodslog[i].Unit.news) {
                                html += '<p><span class="od_time">商品单位</span>添加<span style="color:green">' + data.edit.goodslog[i].Unit.news + '</span></p>';
                            } else if (data.edit.goodslog[i].Unit.old && !data.edit.goodslog[i].Unit.news) {
                                html += '<p><span class="od_time">商品单位</span>删除<span style="color:red">' + data.edit.goodslog[i].Unit.old + '</span></p>';
                            } else {
                                html += '<p><span class="od_time">商品单位</span>由<span style="color:red">' + data.edit.goodslog[i].Unit.old + '</span>改为<span style="color:red">' + data.edit.goodslog[i].Unit.news + '</span></p>';
                            }
                        }
                        if (data.edit.goodslog[i].Brand) {
                            if (!data.edit.goodslog[i].Brand.old && data.edit.goodslog[i].Brand.news) {
                                html += '<p><span class="od_time">商品品牌</span>添加<span style="color:green">' + data.edit.goodslog[i].Brand.news + '</span></p>';
                            } else if (data.edit.goodslog[i].Brand.old && !data.edit.goodslog[i].Brand.news) {
                                html += '<p><span class="od_time">商品品牌</span>删除<span style="color:red">' + data.edit.goodslog[i].Brand.old + '</span></p>';
                            } else {
                                html += '<p><span class="od_time">商品品牌</span>由<span style="color:red">' + data.edit.goodslog[i].Brand.old + '</span>改为<span style="color:red">' + data.edit.goodslog[i].Brand.news + '</span></p>';
                            }
                        }

                        if (data.edit.goodslog[i].ValidityType) {
                            if (!data.edit.goodslog[i].ValidityType.old && data.edit.goodslog[i].ValidityType.news) {
                                html += '<p><span class="od_time">商品保修期</span>添加<span style="color:green">' + data.edit.goodslog[i].ValidityType.news + '</span></p>';
                            } else if (data.edit.goodslog[i].ValidityType.old && !data.edit.goodslog[i].ValidityType.news) {
                                html += '<p><span class="od_time">商品保修期</span>删除<span style="color:red">' + data.edit.goodslog[i].ValidityType.old + '</span></p>';
                            } else {
                                html += '<p><span class="od_time">商品保修期</span>由<span style="color:red">' + data.edit.goodslog[i].ValidityType.old + '</span>改为<span style="color:red">' + data.edit.goodslog[i].ValidityType.news + '</span></p>';
                            }
                        }
                        if (data.edit.goodslog[i].MinQuantity) {
                            if (!data.edit.goodslog[i].MinQuantity.old && data.edit.goodslog[i].MinQuantity.news) {
                                html += '<p><span class="od_time">商品最小包装数</span>添加<span style="color:green">' + data.edit.goodslog[i].MinQuantity.news + '</span></p>';
                            } else if (data.edit.goodslog[i].MinQuantity.old && !data.edit.goodslog[i].MinQuantity.news) {
                                html += '<p><span class="od_time">商品最小包装数</span>删除<span style="color:red">' + data.edit.goodslog[i].MinQuantity.old + '</span></p>';
                            } else {
                                html += '<p><span class="od_time">商品最小包装数</span>由<span style="color:red">' + data.edit.goodslog[i].MinQuantity.old + '</span>改为<span style="color:red">' + data.edit.goodslog[i].MinQuantity.news + '</span></p>';
                            }
                        }
                        if (data.edit.goodslog[i].BganCompany) {
                            if (!data.edit.goodslog[i].BganCompany.old && data.edit.goodslog[i].BganCompany.news) {
                                html += '<p><span class="od_time">商品标杆品牌</span>添加<span style="color:green">' + data.edit.goodslog[i].BganCompany.news + '</span></p>';
                            } else if (data.edit.goodslog[i].BganCompany.old && !data.edit.goodslog[i].BganCompany.news) {
                                html += '<p><span class="od_time">商品标杆品牌</span>删除<span style="color:red">' + data.edit.goodslog[i].BganCompany.old + '</span></p>';
                            } else {
                                html += '<p><span class="od_time">商品标杆品牌</span>由<span style="color:red">' + data.edit.goodslog[i].BganCompany.old + '</span>改为<span style="color:red">' + data.edit.goodslog[i].BganCompany.news + '</span></p>';
                            }
                        }

                        if (data.edit.goodslog[i].Provenance) {
                            if (!data.edit.goodslog[i].Provenance.old && data.edit.goodslog[i].Provenance.news) {
                                html += '<p><span class="od_time">商品原产地</span>添加<span style="color:green">' + data.edit.goodslog[i].Provenance.news + '</span></p>';
                            } else if (data.edit.goodslog[i].Provenance.old && !data.edit.goodslog[i].Provenance.news) {
                                html += '<p><span class="od_time">商品原产地</span>删除<span style="color:red">' + data.edit.goodslog[i].Provenance.old + '</span></p>';
                            } else {
                                html += '<p><span class="od_time">商品原产地</span>由<span style="color:red">' + data.edit.goodslog[i].Provenance.old + '</span>改为<span style="color:red">' + data.edit.goodslog[i].Provenance.news + '</span></p>';
                            }
                        }

                        if (data.edit.goodslog[i].BganGoodsNO) {
                            if (!data.edit.goodslog[i].BganGoodsNO.old && data.edit.goodslog[i].BganGoodsNO.news) {
                                html += '<p><span class="od_time">商品标杆商品号</span>添加<span style="color:green">' + data.edit.goodslog[i].BganGoodsNO.news + '</span></p>';
                            } else if (data.edit.goodslog[i].BganGoodsNO.old && !data.edit.goodslog[i].BganGoodsNO.news) {
                                html += '<p><span class="od_time">商品标杆商品号</span>删除<span style="color:red">' + data.edit.goodslog[i].BganGoodsNO.old + '</span></p>';
                            } else {
                                html += '<p><span class="od_time">商品标杆商品号</span>由<span style="color:red">' + data.edit.goodslog[i].BganGoodsNO.old + '</span>改为<span style="color:red">' + data.edit.goodslog[i].BganGoodsNO.news + '</span></p>';
                            }
                        }
                        if (data.edit.goodslog[i].oeno) {
                            if (data.edit.goodslog[i].oeno.old && !data.edit.goodslog[i].oeno.news) {
                                for (var j = 0, n = data.edit.goodslog[i].oeno.old.length; j < n; j++)
                                {
                                    html += '<p><span class="od_time">商品OE号</span>删除oe号<span style="color:red">' + data.edit.goodslog[i].oeno.old[j] + '</span></p>';
                                }
                            } else if (!data.edit.goodslog[i].oeno.old && data.edit.goodslog[i].oeno.news) {
                                for (var j = 0, n = data.edit.goodslog[i].oeno.news.length; j < n; j++)
                                {
                                    html += '<p><span class="od_time">商品OE号</span>添加OE号<span style="color:green">' + data.edit.goodslog[i].oeno.news[j] + '</span></p>';
                                }
                            } else {
                                if (data.edit.goodslog[i].oeno.old.length >= data.edit.goodslog[i].oeno.news.length) {
                                    for (var j = 0, n = data.edit.goodslog[i].oeno.old.length; j < n; j++)
                                    {
                                        if (!data.edit.goodslog[i].oeno.news[j])
                                            data.edit.goodslog[i].oeno.news[j] = ' ';
                                        if (data.edit.goodslog[i].oeno.old[j] !== data.edit.goodslog[i].oeno.news[j])
                                            html += '<p><span class="od_time">商品OE号</span>由<span style="color:red">' + data.edit.goodslog[i].oeno.old[j] + '</span>改为<span style="color:red">' + data.edit.goodslog[i].oeno.news[j] + '</span></p>';
                                    }

                                }
                                if (data.edit.goodslog[i].oeno.old.length < data.edit.goodslog[i].oeno.news.length) {
                                    for (var j = 0, n = data.edit.goodslog[i].oeno.news.length; j < n; j++)
                                    {
                                        if (!data.edit.goodslog[i].oeno.old[j])
                                            data.edit.goodslog[i].oeno.old[j] = ' ';
                                        if (data.edit.goodslog[i].oeno.old[j] !== data.edit.goodslog[i].oeno.news[j])
                                            html += '<p><span class="od_time">商品OE号</span>由<span style="color:red">' + data.edit.goodslog[i].oeno.old[j] + '</span>改为<span style="color:red">' + data.edit.goodslog[i].oeno.news[j] + '</span></p>';
                                    }

                                }
                            }
                        }
                        if (data.edit.goodslog[i].img) {
                            if (data.edit.goodslog[i].img.add) {
                                html += '<p><span class="od_time">商品图片</span>添加图片<span style="color:green">' + data.edit.goodslog[i].img.add[0] + '</span></p>';
                                if (data.edit.goodslog[i].img.add.length > 1) {
                                    for (var b = 1, imgaddn = data.edit.goodslog[i].img.add.length; b < imgaddn; b++) {
                                        html += '<p><span class="od_time">商品图片</span>添加图片<span style="color:green">' + data.edit.goodslog[i].img.add[b] + '</span></p>';
                                    }
                                }
                            }
                            if (data.edit.goodslog[i].img.del) {
                                html += '<p><span class="od_time">商品图片</span>删除图片<span style="color:red">' + data.edit.goodslog[i].img.del[0] + '</span></p>';
                                if (data.edit.goodslog[i].img.del.length > 1) {
                                    for (var a = 1, imgdeln = data.edit.goodslog[i].img.del.length; a < imgdeln; a++) {
                                        html += '<p><span class="od_time">商品图片</span>删除图片<span style="color:red">' + data.edit.goodslog[i].img.del[a] + '</span></p>';
                                    }
                                }
                            }
                        }
                    }
                    for (var i = 0, n = data.edit.vehlog.length; i < n; i++)
                    {
                        if (data.edit.vehlog[i].Type == 'add') {
                            html += '<p><span class="od_time">商品适用车系</span>添加车系<span style="color:green">' + data.edit.vehlog[i].Marktxt + ' ' + data.edit.vehlog[i].Cartxt + ' ' + data.edit.vehlog[i].Year + ' ' + data.edit.vehlog[i].Modeltxt + '</span></p>';
                        }
                        if (data.edit.vehlog[i].Type == 'del') {
                            html += '<p><span class="od_time">商品适用车系</span>删除车系<span style="color:red">' + data.edit.vehlog[i].Marktxt + ' ' + data.edit.vehlog[i].Cartxt + ' ' + data.edit.vehlog[i].Year + ' ' + data.edit.vehlog[i].Modeltxt + '</span></p>';
                        }
                    }
                }
                html += '</div>';
                $('#follow' + id).html(html);
                $('#follow' + id).attr('load', 'loaded');
                $('#follow' + id).show();
            }
        });
    }
    function closeinfo(id) {
        $('#follow' + id).hide();
    }
    $(document).ready(function() {
        // 点击输入框弹出div层
        $("#cpname-search").click(function(e) {
            cpname_search = true;
            e.stopPropagation();
            //alert(1234);
            cpnametxt = '';
            $("#cpname-search").val(cpnametxt);
            var offset = $(this).offset();
            var left, top, url, data;
            if (typeof (countSelf) == 'undefined') {
                left = offset.left+ 'px';
                top = offset.top + 15 + 'px';
            }
            else {
                var width = $(window).width();
                //屏幕宽度大于1000
                if (width > 1000) {
                    var cutwidth = (width - 1000) / 2 + 230;
                } else {
                    cutwidth = 230;
                }

                left = (offset.left - cutwidth) - 210 + 'px';
                top = (offset.top + 26 - 110) + 'px';
            }
            $("#selectBig").css({'left': left, 'top': top}).show();
            $("#ul-bigcate li:first").click();
            $("#make-car-m").hide();
        });
    });
</script>