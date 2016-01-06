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
    .width30{
        width:30px;
    }
</style>
<?php
$this->breadcrumbs = array(
    '商品管理' => Yii::app()->createUrl('common/goodslist'),
    '商品详情'
        )
?>
<p align="right" style="line-height:30px">
    <button class=" button2" onclick="backto('<?php echo $_GET['status'] ?>')">返回列表</button>
</p>
<form id="fm" method="post" action="" novalidate style="" style="border:1px solid red">
    <div class="bor_back">
        <p class="txxx">填写基本信息</p>
        <input type="hidden" id="GoodsID" name="GoodsID" value="<?php echo $data['ID'] ?>">

        <div class="txxx_info">
            <span class="color_red" id="Name_id">&nbsp;</span> <span class=" f_weight">商品名称：</span>
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
                <span class="f_weight float_l m_left9">产品属性：</span>
                <div class="float_l  back_color m_left12 ">
                    <div class="txxx_info3">
                        <p><span class="color_red" id="GoodsNO_id">&nbsp;</span> <span>商品编号：</span>
                            <input type="text" id="GoodsNO" name="GoodsNO"  class=" input input3 width250" value="<?php echo $data['GoodsNO'] ?>">
                            <?php if ($edit['GoodsNO']): ?>
                                <span style="color:green">(提示：商品编号有变化)</span>
                            <?php endif; ?>
                        </p>

                        <p class="m-top"><span class="color_red" id="Pinyin_id">&nbsp;</span> <span>拼音代码：</span>
                            <input type="text" id="Pinyin" name="Pinyin" id="pinyincode" class=" input input3 width250" value="<?php echo $data['Pinyin'] ?>" >
                            <?php if ($edit['Pinyin']): ?>
                                <span style="color:green">(提示：拼音代码有变化)</span>
                            <?php endif; ?>
                        </p>
                        <p class="m-top">
                            <span  class="m_left12">配件品类：</span>
                            <input id="cpname-search" type="text" class=" input input3 width250" value="<?php echo DealergoodsService::StandCodegetcpname($data['StandCode'], 'Name'); ?>"  >
                            <?php if ($edit['StandCode']): ?>
                                <span style="color:green">(提示：配件品类有变化)</span>
                            <?php endif; ?>
                        </p>
                        <p class="m-top"> <span class=" m_left12">商品品牌：</span>
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
                        <div class="m-top" id="showoe"> 
                            <p class="m-top">
                                <span class=" m_left36">OE号：</span>
                                <input type="text"  name="OENOS[]" value="<?php echo $data['oeno'][0]; ?>" class=" input input3 width250" onblur="oechange()">
                                <span class="add m_left"><a class="jiahao"  onclick="addOENO()">+</a></span><a href="javascript:;" class="add_wz" onclick="addOENO()">添加OE号</a>
                                <?php if ($edit['oeno']): ?>
                                    <span style="color:green">(提示：OE号有变化)</span>
                                <?php endif; ?>
                            </p>
                            <?php
                            if ($data['oeno']) {
                                foreach ($data['oeno'] as $key => $val) {
                                    if ($key != 0)
                                        echo "<p class='m-top'><input type='text' name='OENOS[]' value='" . $val . "' class='input input3 width250' style='margin-left:81px' onblur='oechange()'></p>";
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
<!--                <span class=" f_weight" style="vertical-align:top; margin-left:12px"><div style="float: left">产品图片： </div>    
        <a class="form-row" id="showimglist" style=" position: relative;"> </a>-->
                <input type="hidden" name="urlimg" value="" id="imgupload">
                <!--显示上传的图片
                <a href="javascript:void(0);" id="file_upload" class="btn_addPic m_left"><input type="file" name="pic" class="filePrew"></a>



<span class='showimages'><img  style='width:80px;
                                height:80px;
                                ' src="+imgurl+val['ImageUrl']+"><span onclick='xximage(this)' key="+val['ImageUrl']+" class='close icon-close-green xx' name='urlimg' imgname="+val['ImageName']+"></span></span>

                </span>-->
                <span class=" f_weight" style="vertical-align:top;display: block;float: left;">产品图片：</span>
                <?php
                $amount = 0;
                if ($data['img']) {
                    foreach ($data['img'] as $key => $val) {
                        $amount = $key + 1;
                        echo " <a href='javascript:void(0);' class='btn_addPic'><span id='imgload" . $amount . "' class='showimg'><img ondblclick='xximage(this)' name='urlimg' idkey=" . $amount . " key=" . $val['ImageUrl'] . "  imgname=" . $val['ImageName'] . " save='save' style='width:80px; height:80px;' src=" . F::uploadUrl() . $val['ImageUrl'] . "></span><input type='file' name='pic' save='save' class='filePrew'  id='file_upload" . $amount . "'></a>";
//                        echo "<span class='showimages' id='file_upload" . $amount . "'><img  style='width:80px;height:80px;' src=" . F::uploadUrl() . $val['ImageUrl . "><span onclick='xximage(this)' key=" . $val->ImageUrl . " class='close icon-close-green xx' name='urlimg' idkey=" . $amount . " imgname=" . $val->ImageName . "></span></span>";
                    }
                } else {
                    echo " <a href='javascript:void(0);' class='btn_addPic'><span id='imgload1' class='showimg'><img ondblclick='xximage(this)' name='urlimg' idkey=1    save='save' style='width:80px;height:80px;' src=" . F::baseUrl() . "/upload/dealer/default-goods.png><input type='file' name='pic' save='save' class='filePrew'  id='file_upload1'></span></a>";
                }
                ?>
            </div>

            <div class="txxx_info2 m-top" style="clear:both">
                <span class="f_weight float_l " style=" margin-right: 5px">详细说明：</span>
                <div class="float_l " style="width:730px; height:400px; border:1px solid #f0f0f0"> 
                    <textarea readonly="readonly" style="width:728px; height:398px; border:1px solid #f0f0f0" id="Info" name="Info"><?php echo $data['Info'] ?></textarea>
                </div>
                <div style="clear:both"></div>
            </div>
        </div>
    </div>

    <div class="bor_back m-top">
        <p class="txxx">适用车型数据</p>
        <div class="txxx_info">
            <span class=" f_weight">适用车系：</span>
            <input id="make-select"  class="input" type="text" value="<?php echo $makecar ?>"style="width:300px">
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
                        <p>
                            <span class="m_left12a">配件档次：</span>
                            <select class='select' name="PartsLevel" id="PartsLevel">
                                <option value="">请选择配件档次</option>
                                <?php
                                foreach (Yii::app()->getParams()->PartsLevel as $key => $value) {
                                    if ($key == $data['PartsLevel'])
                                        echo " <option valu e=" . $key . " selected='selected'>" . $value . "</option>";
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
                            $units = GoodsUnit::model()->findAll();
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
                            <span class="validityshow" <?php if ($data['spec']['ValidityType'] != 3) echo 'style = "display:none"' ?>><input type="text" id="ValidityDateID" name="ValidityDate" value="<?php echo $data['spec']['ValidityDate'] ?>" class="input width30"> </span>-->

                            <?php if ($edit['ValidityType'] || $edit['ValidityDate']): ?>
                                <span style="color:green">(提示：保修期有变化)</span>
                            <?php endif; ?>
                        </p>
                        <p class="m-top"><span>最小包装数：</span>
                            <input type="text" id="MinQuantity" name="MinQuantity" class=" input input3 width250" value="<?php echo $data['pack']['MinQuantity'] ?>" >
                            <?php if ($edit['MinQuantity']): ?>
                                <span style="color:green">(提示：最小包装数有变化)</span>
                            <?php endif; ?>
                        </p>
                        <p class="m-top"><span class="color_red" id="Price_id"></span><span class="m_left12a">销售价格：</span>
                            <input type="text" id="Price" name="Price" class=" input input3 width250" value="<?php echo $data['Price'] ?>"  >
                            <?php if ($edit['Price']): ?>
                                <span style="color:green">(提示：销售价格有变化)</span>
                            <?php endif; ?>
                        </p>
                        <p class="m-top"> <span class="m_left12a" style="vertical-align:top">特征说明：</span>
                            <textarea name="Memo" id="Memo"　class="textarea2" style="margin-left:5px;width: 255px;height: 80px; border:1px solid #ebebeb;resize:none"><?php echo $data['Memo'] ?></textarea>
                            <?php if ($edit['Memo']): ?>
                                <span style="color:green">(提示：特征说明有变化)</span>
                            <?php endif; ?>
                        </p>
                        <p class="m-top"><span class=" m_left12a">标杆品牌：</span>
                            <input type="text" id="BganCompany" name="BganCompany" class=" input input3 width250" value="<?php echo $data['spec']['BganCompany'] ?>">
                            <?php if ($edit['BganCompany']): ?>
                                <span style="color:green">(提示：标杆品牌有变化)</span>
                            <?php endif; ?>
                        </p>
                        <p class="m-top"><span class=" m_left24a">原产地：</span>
                            <input type="text" id="Provenance" name="Provenance" class=" input input3 width250" value="<?php echo $data['Provenance'] ?>">
                            <?php if ($edit['Provenance']): ?>
                                <span style="color:green">(提示：原产地有变化)</span>
                            <?php endif; ?>
                        </p>
                        <p class="m-top"><span style="vertical-align:top">标杆商品号：</span>
                            <input type="text" id="BganGoodsNO" name="BganGoodsNO" class=" input input3 width250" value="<?php echo $data['spec']['BganGoodsNO'] ?>">
                            <?php if ($edit['BganGoodsNO']): ?>
                                <span style="color:green">(提示：标杆商品号有变化)</span>
                            <?php endif; ?>
                        </p>
                    </div>
                </div>

                <div style="clear:both"></div>
            </div>
        </div>

    </div>
</form>
<form id="version" method="post" action="" novalidate  style="display: none">
    <input name="GoodsID" id="VersionGoodsID">
    <input name="Version" id="VersionNO">
</form>
<?php $this->widget('ext.kindeditor.KindEditorWidget', array('id' => 'Info')); ?>
<script>
    var editor;
    KindEditor.ready(function(K) {
        //        editor = K.create("#Info");


        editor = K.create('#Info', {
            resizeType: 2,
            //            cssPath: ['../plugins/code/prettify.css', 'index.css'],
            allowPreviewEmoticons: false,
            allowImageUpload: false,
            items: ['fontname', '|', 'bold', 'italic', 'underline',
                'removeformat', '|', 'justifyleft', 'justifycenter', 'justifyright', 'insertorderedlist',
                'insertunorderedlist']
        });
        editor.readonly(true);

    })

</script>
<script>
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
    //     $('.checkbox-add2').live('mouseout',function(){
    //        var carID = $(this).attr('carid');
    //        $("#div_"+carID).hide();
    //     });
    $('.show_yearmodel li').live('mouseover', function() {
        $(this).css({'color': 'green'});
    });
    $('.show_yearmodel li').live('mouseleave', function() {
        $(this).css({'color': 'grey'});
    });
    //取消
    $(function() {
        $('#Name').attr("disabled", "disabled");
        $('#GoodsNO').attr("disabled", "disabled");
        $('#Pinyin').attr("disabled", "disabled");
        $('#cpname-search').attr("disabled", "disabled");
        $('#goodsBrand').attr("disabled", "disabled");
        $('input[name="OENOS[]"]').attr("disabled", "disabled");
        $('input[name=pic]').attr("disabled", "disabled");
        //        $('#Info').attr("disabled","disabled");
        $('.ke-edit-iframe').attr('onfocus', 'this.blur()');
        $('#make-select').attr("disabled", "disabled");
        $('#PartsLevel').attr("disabled", "disabled");
        $('#Unit').attr("disabled", "disabled");
        $('#MinQuantity').attr("disabled", "disabled");
        $('#Price').attr("disabled", "disabled");
        $('#Memo').attr("disabled", "disabled");
        $('#BganCompany').attr("disabled", "disabled");
        $('#Provenance').attr("disabled", "disabled");
        $('#BganGoodsNO').attr("disabled", "disabled");
        $('#ValidityID').attr("disabled", "disabled");
        $('#ValidityDateID').attr("disabled", "disabled");


        //适用车系显示

        $(".checkbox-add2").live('click', function() {
            var carID = $(this).attr('carID');
            var car = '#a' + carID;
            if (car_id != carID) {
                var offset = $(this).offset();
                var left, top;
                //                var width = $(window).width();
                //                var height = $(window).height();
                //                //屏幕宽度大于1000
                //                if( width> 1000){
                //                    var cutwidth =  (width - 1000)/2 + 230-145;
                //                }else{
                //                    alert('屏幕最大窗口，界面更友好！');
                //                }               
                //                var curheight = (height - 620)/2-24;
                //                left = (offset.left -cutwidth)+85 + 'px';
                //                top = (offset.top-curheight) +57+ 'px';
                left = offset.left + 85 - 296 + 'px';
                top = offset.top + 57 - 36 + 'px';
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


    function backto(status) {
        if (status == 0) {
            var url = Yii_baseUrl + '/pap/dealergoods/drop';
        }
        if (status == 1) {
            var url = Yii_baseUrl + '/pap/dealergoods/index';
        }
        window.location.href = url;
    }



    // 添加OENO　号
    function addOENO() {
    }
    ;
    /*
     *添加车系
     */


    function addVehcle() {

    }
    ;
    /*
     *
     *删除OE 
     */
    function xxOENO(obj) {
    }

    //删除整个主营车系
    function xxcar(obj) {

    }
    //删除单个主营车系
    function xxVehicle(obj) {

    }
    //删除图片
    function xximage(obj) {
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
            if (typeof (countSelf) == 'undefined') {
                left = offset.left - 210 + 'px';
                top = offset.top + 26 + 'px';
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