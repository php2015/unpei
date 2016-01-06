<!--<meta http-equiv="pragma" content="no-cache">
<meta http-equiv="Cache-Control" content="no-cache,must-revalidate">
<meta http-equiv="expires" content="Web,26 Feb 1997 08:21:57 GMT">
<meta http-equiv="expires" content="0">-->


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
    .m_left12a{
        margin-left:12px;
    }
    .m_left24a{
        margin-left:24px;
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
    '发布商品'
        )
?>
<p align="right" style="line-height:30px">
    <?php if ($StandCode['cpname']): ?>
        您选择的类目：<span class="f_weight"><?php echo $StandCode['bigname'] ?></span> > <span class="f_weight"><?php echo $StandCode['subname'] ?></span> > <span class="f_weight"><?php echo $StandCode['cpname'] ?></span>
    <?php endif; ?>
    <button class=" button2" onclick="backto()">返回重选</button>
</p>
<form id="fm" method="post">
    <div class="bor_back">
        <p class="txxx">填写基本信息</p>
        <div class="txxx_info">
            <span class="color_red" id="Name_id" style="padding-left: 3px;">*</span><span class=" f_weight">商品名称：</span>
            <input type="text" name="Name" maxlength="50" class=" input input3 width375" ><span style="color:green">(提示：商品名称最多为50个字)</span>
            <div class="txxx_info2 m-top">
                <span class="f_weight float_l p_left9">产品属性：</span>
                <div class="float_l  back_color m_left12 ">
                    <div class="txxx_info3">
                        <p><span class="color_red" id="GoodsNO_id" style="padding-left: 3px;">*</span><span>商品编号：</span>
                            <input type="text" name="GoodsNO" maxlength="20"  class=" input input3 width250" ><span style="color:green">(提示：商品编号最多为20个字)</span></p>
                        <p class="m-top"><span class="color_red" id="Pinyin_id" style="padding-left: 3px;">*</span><span>拼音代码：</span>
                            <input type="text" name="Pinyin" maxlength="50" id="pinyincode" class=" input input3 width250" ></p>
                        <p class="m-top">
                            <span class="p_left9">配件品类：</span>
                            <input id="cpname-search" name="cpname" readonly="readonly" type="text" class=" input input3 width250" value="<?php echo $StandCode['cpname'] ?>"  >
                            <input  name="StandCode" type="hidden" value="<?php echo $StandCode['code'] ?>"  >
                            <input  name="BigParts" type="hidden" value="<?php echo $StandCode['bignameid'] ?>"  >
                            <input  name="SubParts" type="hidden" value="<?php echo $StandCode['subnameid'] ?>"  >
                        </p>
                        <p class="m-top"> <span class=" p_left9">商品品牌：</span>
                            <?php
//                            $organID = Commonmodel::getOrganID();
//                            $brandNames = Brand::model()->findAll("OrganID = $organID");
//                            var_dump($brandNames);
//                            $brandName = CHtml::listData($brandNames, 'ID', 'BrandName');
//                            var_dump($brandName);
                            $brandNames = DealergoodsService::codegetbrand($StandCode['code']);
                            $brandName = $brandNames ? $brandNames : array();
                            echo CHtml::dropDownList('goodsBrand', 'goodsBrand', $brandName, array(
                                'class' => 'select select2 ',
                                'empty' => '选择商品品牌',
                            ));
                            ?>	
                            <input type="hidden" name="BrandName">
                        </p>

                        <div id="showoe"> 
                            <p class="m-top">
                                <span class="p_left33">OE号：</span>
                                <input type="text"   maxlength="20" name="OENOS[]" maxlength="20" id="oe_id" key="yes" class=" input input3 width250">
                                <span class="add m_left"><a class="jiahao"  onclick="addOENO()">+</a></span><a href="javascript:void(0)" class="add_wz" onclick="addOENO()">添加OE号</a>
                            </p>
                        </div>
                        <!--<p class="fitem showVehicle" id="showOENO" > 显示OENO </p>-->


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

                <!--显示上传的图片
                <a href="javascript:void(0);" id="file_upload" class="btn_addPic m_left"><input type="file" name="pic" class="filePrew"></a>


                
                



                </span>-->
                <span class=" f_weight" style="vertical-align:top;display: block;float: left;">产品图片：</span>
                <div style="margin-top: 15px;">
                    <div class="float_l" style="margin-left:10px;"><input type='file' name='file_upload' id="file_upload">
                        <input type="hidden" value="上传" id="file-upload-start">
                    </div>
                    <span style="line-height:25px;color:#888;margin-left: 5px;">图片最多上传5张</span><span style="line-height:25px;color:green">(提示：删除图片双击即可)</span>
                    <div style="clear:both"></div>
                </div>
                <div class="upload_img m_left65">
                    <ul>
                        <div class="form-row" id="showimglist" style=" position: relative;">
                        </div>
                        <input type="hidden" name="urlimg" value="" id="imgupload">
                        <div style="clear:both"></div>
                    </ul>
                </div>

<!--                <span class=" f_weight" style="vertical-align:top;display: block;float: left;">产品图片：</span>
                <a href="javascript:void(0);" class="btn_addPic m_left" ><span id="imgload1" class="showimg"></span><input type="file" name="pic" class="filePrew" id="file_upload1"></a>
                <a href="javascript:void(0);" class="btn_addPic" ><span id="imgload2" class="showimg"></span><input type="file" name="pic" class="filePrew"  id="file_upload2"></a>
                <a href="javascript:void(0);" class="btn_addPic"><span id="imgload3" class="showimg"></span><input type="file" name="pic" class="filePrew"  id="file_upload3"></a>
                <a href="javascript:void(0);" class="btn_addPic"><span id="imgload4" class="showimg"></span><input type="file" name="pic" class="filePrew"  id="file_upload4"></a>
                <a href="javascript:void(0);" class="btn_addPic"><span id="imgload5" class="showimg"></span><input type="file" name="pic" class="filePrew"  id="file_upload5"></a>
                <span style="color:green">(提示：删除图片双击即可)</span>-->

            </div>
            <div class="txxx_info2 m-top" style="clear:both">
                <span class="f_weight float_l " style=" margin-right: 5px">详细说明：</span>
                <div class="float_l " style="width:730px; height:400px; border:1px solid #f0f0f0"> 
                    <textarea style="width:728px; height:398px; border:1px solid #f0f0f0" id="Info" name="Info"></textarea>
                </div>
                <div style="clear:both"></div>
            </div>
        </div>
    </div>
    <div class="bor_back m-top">
        <p class="txxx">适用车型数据</p>
        <div class="txxx_info">
            <span class=" f_weight"><span class="color_red" id="make_id">*</span>适用车系：</span>
            <input id="make-select" readonly="readonly" key="null_series" class="input" type="text" value="<?php echo $makecar ?>"style="width:300px">
            <span class="add m_left"><a class="jiahao" onclick="addVehcle()">+</a></span><a href="javascript:;" class="add_wz" onclick="addVehcle()">添加车系</a>
            <p class="fitem showVehicle" id="showVehicle"><!-- 显示车系车型 -->
                <input type="hidden" id="make_hidden" value="0" name="make_hidden">
                <input type="hidden" id="make" name="make">
                <input type="hidden" id="car" name="car">
                <input type="hidden" id="year" name="year">
                <input type="hidden" id="model" name="model">
                <input type="hidden" id="maketxt" name="maketxt">
                <input type="hidden" id="cartxt" name="cartxt">
                <input type="hidden" id="modeltxt" name="modeltxt">
            </p>
        </div>
    </div>

    <div class="bor_back m-top">

        <p class="txxx">商品销售信息</p>  
        <div class="txxx_info">
            <div class="txxx_info2 m-top">
                <span class="f_weight float_l m_left12a">商品属性：</span>
                <div class="float_l  back_color m_left12a ">
                    <div class="txxx_info3">
                        <p><span class="color_red" id="PartsLevel_id">*</span><span style=" margin-left: 6px;">配件档次：</span>
                            <select class='select' name="PartsLevel" id="PartsLevelID">
                                <option value="">请选择配件档次</option>
                                <?php
                                foreach (Yii::app()->getParams()->PartsLevel as $key => $value) {
                                    echo " <option value=" . $key . ">" . $value . "</option>";
                                }
                                ?>
                            </select>
                        </p>

<!--<input type="text" name="PartsLevel"  class=" input input3 width250" ></p>-->
                        <p class="m-top"><span class="m_left36a">单位：</span>
                            <?php
                            $units = GoodsUnit::model()->findAll(array('select' => '*', 'group' => 'UnitName'));
//                            var_dump($units);
//                            exit;
                            $unit = CHtml::listData($units, 'ID', 'UnitName');
                            echo CHtml::dropDownList('Unit', 'UnitName', $unit, array(
                                'class' => 'select select2 ',
                                'empty' => '选择商品单位',
                            ));
                            ?>	
                        </p>
                        <p class="m-top">
                            <span class="m_left24a">保修期：</span>   
                            <select class='select' name="ValidityType" id="ValidityID">
                                <option value="1" selected="selected" >不保修</option>
                                <option value="2">保装车</option>
                                <option value="3">保修时间</option>
                            </select>
                            <span class="validityshow" style="display:none"><input type="text" maxlength="50" name="ValidityDate" id="ValidityDateID" class="input width90">                            
                                <select class='select' name="dataday" style=" width: 40px;">
                                    <option value="月" selected="selected" >月</option>
                                    <option value="天">天</option>
                                </select>
                            </span>
                        </p>
                        <p class="m-top"><span>最小包装数：</span>
                            <input type="text" name="MinQuantity" maxlength="10" class=" input input3 width130"></p>
                        <p class="m-top"><span class="color_red" id="Price_id">*</span><span style=" margin-left: 6px;">销售价格：</span>
                            <input type="text" name="Price" class=" input input3 width130"></p>
                        <p class="m-top"> <span class="m_left12a" style="vertical-align:top">特征说明：</span>
                            <textarea name="Memo" maxlength="255"　class="textarea2" style="margin-left:5px;width: 255px;height: 80px; border:1px solid #ebebeb;resize:none"></textarea>
                        </p>
                        <p class="m-top"><span class=" m_left12a">标杆品牌：</span>
                            <input type="text" maxlength="50" name="BganCompany" class=" input input3 width250">
                        </p>
                        <p class="m-top"><span class=" m_left24a">原产地：</span>
                            <input type="text" name="Provenance" maxlength="50" class=" input input3 width250">
                        </p>
                        <p class="m-top"><span style="vertical-align:top">标杆商品号：</span>
                            <input type="text" name="BganGoodsNO" maxlength="50" class=" input input3 width250">
                        </p>
                    </div>
                </div>

                <div style="clear:both"></div>
            </div>
            <?php $this->widget('widgets.default.WGoodsCarModelSelf'); ?>
        </div>

    </div>
</form>
<p align="center" class="m-top"><input type="button" class="submit f_weight" id="addgoods" onclick="add()" value="发布商品"><button class=" button3"  onclick="preview()">预览</button><button class=" button3" id="dropgoods" onclick="adddrop()">发布下架商品</button></p>
    <?php // $this->widget('widgets.default.WGoodsCategoryModel');   ?>
<script type="text/javascript" src='<?php echo F::themeUrl(); ?>/js/uploadify/jquery.uploadify.js?ver=<?php echo rand(0, 9999); ?>'></script>
<link rel="stylesheet" href="<?php echo F::themeUrl(); ?>/js/uploadify/uploadify1.css">
<?php include_once 'uploadimgjs.php'; ?>


<?php
$this->widget('ext.kindeditor.KindEditorWidget', array(
    'id' => 'Info',
));
?>
<!--<link rel="stylesheet" href="<?php echo F::themeUrl(); ?>/js/uploadify/uploadify1.css">-->
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
    $(document).ready(function() {
        //品类禁用
        //        $('#cpname-search').attr("disabled","disabled");
    });
    //适用车系显示隐藏
    var car_id = 0;
    $(document).scroll(function() {
        $('.show_yearmodel').hide();
    });

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
    $(function() {
        $("#goodsBrand").change(function() {
            var brand = $("#goodsBrand :selected").text();
            // alert(brand);
            $("input[name=BrandName]").val(brand);
        })


        $(".checkbox-add2").live('click', function() {
            var carID = $(this).attr('carID');
            var car = '#a' + carID;
            if (car_id != carID) {
                var offset = $(this).offset();
                var left, top;
                var width = $(window).width();
                var height = $(window).height();
                left = offset.left + 'px';
                top = (offset.top) - 36 + 57 + 'px';
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
    function add() {
        //发布公共部分-对数据进行拼接和判断
        if (!common_add() || !oechange()) {
            return false;
        }
        $("#fm").attr("action", Yii_baseUrl + "/pap/dealergoods/add");
        car_id = 'aa';
        $("#fm").attr("target", "_self");
        $("#fm").submit();
        $('#addgoods').attr("disabled", "disabled");
    }
    //发布
    function adddrop() {
        //发布公共部分-对数据进行拼接和判断
        if (!common_add() || !oechange()) {
            return false;
        }
        $("#fm").attr("action", Yii_baseUrl + "/pap/dealergoods/adddrop");
        car_id = 'aa';
        $("#fm").attr("target", "_self");
        $("#fm").submit();
        $('#dropgoods').attr("disabled", "disabled");
    }
    //预览
    function preview() {
        //发布公共部分-对数据进行拼接和判断
        if (!common_add() || !oechange()) {
            return false;
        }
        $("#fm").attr("action", Yii_baseUrl + "/pap/Dealergoods/preview");
        $("#fm").attr("target", "_blank");
        $("#fm").submit();
    }
    //发布公共部分
    function common_add() {
<?php $prices = DealergoodsService::getmaxprice(); ?>
        var maxprice =<?php echo $prices['maxprice']; ?>;
        var maxnum =<?php echo $prices['maxnum']; ?>;
        //获得详情
        //        var info = editor.html();
        //        $("textarea[name=Info]").html(info);

        editor.sync();
        //        alert($("textarea[name=Info]").val());
        //拼图片
        var urlimg = 0;
        $("#showimglist li").each(function() {
            if ($(this).find('img[add=add]').attr('key')) {
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
        $("#showVehicle li").each(function() {
            make += ',' + $(this).find('span[name=make]').html();
            car += ',' + $(this).find('span[name=car]').html();
            year += ',' + $(this).find('span[name=year]').html();
            model += ',' + $(this).find('span[name=model]').html();
            maketxt += ',' + $(this).find('span[name=maketext]').html();
            cartxt += ',' + $(this).find('span[name=cartext]').html();
            modeltxt += ',' + $(this).find('span[name=modeltext]').html();
        })
        $("#make").val(make);
        $("#car").val(car);
        $("#year").val(year);
        $("#model").val(model);
        $("#maketxt").val(maketxt);
        $("#cartxt").val(cartxt);
        $("#modeltxt").val(modeltxt);
        if (!make) {
            alert("请为您的商品选择适用车系");
            return false;
        }
        if (!$('input[name=Name]').val()) {
            alert("请为您的商品填写商品名称");
            return false;
        }
        if (!$('select[name=PartsLevel]').val()) {
            alert("请为您的商品填写配件档次");
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
        return true;
    }
    //保质期正则
    function vdregadd() {
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
                $('#Name_id').attr('style', 'padding-left:9px');
            } else {
                $('#Name_id').html('*');
                $('#Name_id').attr('style', 'padding-left:3px');
            }
            var url = Yii_baseUrl + '/pap/dealergoods/Getpinyin';
            $.getJSON(url, {name: name}, function(a) {
                $("#pinyincode").val(a);
                if (a) {
                    $('#Pinyin_id').html('');
                    $('#Pinyin_id').attr('style', 'padding-left:9px');
                } else {
                    $('#Pinyin_id').html('*');
                    $('#Pinyin_id').attr('style', 'padding-left:3px');
                }

            })
        })
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
                $('#GoodsNO_id').attr('style', 'padding-left:9px');
            } else {
                $('#GoodsNO_id').html('*');
                $('#GoodsNO_id').attr('style', 'padding-left:3px');
            }
        })
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
                    return false;
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
        var al = "<p class='m-top'><input type='text'  maxlength='20' name='OENOS[]' class='input input3 width250' style='margin-left:81px' onblur='oechange()'></p>";
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
                            alert('添加成功');
                        } else {
                            alert('添加失败,该车系可能已经全部添加');
                        }
                    }
                });
            }
            var makess = 0;
            $("#showVehicle li").each(function() {
                makess += ',' + $(this).find('span[name=make]').html();
            })
            if (makess) {
                $("#make_id").html('&nbsp;');
            } else {
                $("#make_id").html('*');
            }


        } else {
            $.messager.alert('提示信息', "最多只能添加100个", 'warning');
        }
    }
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

    //删除主营车系
    function xxcar(obj) {
        var cateid = obj.getAttribute("key");
        if (cateid != 0)
        {
            var url = " <?php echo Yii::app()->createUrl('dealer/marketing/Deletecar'); ?>";
            $.getJSON(url, {cateid: cateid}, function(data) {
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
    //删除主营车系
    function xxVehicle(obj) {
        var cateid = obj.getAttribute("key")
        var parentID = $(obj).parent().attr('car');
        if ($("#ul_" + parentID).find('li').length == 1) {
            $("#a" + parentID).remove();
            $("#div_" + parentID).remove();
            car_id = 'aa';
        }
        if (cateid != 0)
        {
            var url = " <?php echo Yii::app()->createUrl('dealer/marketing/Deletepromvehicle'); ?>";
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

        var path = $(obj).attr('key');
        var url = Yii_baseUrl + '/upload/FtpDelfile';
        $.post(url, {'path': path}, function(res) {
            if (res.res == 1) {
                $(obj).parent().remove();
                $("#file_upload").uploadify('disable', false);
            } else {
                alert('删除失败');
            }
        }, 'json');
    }

    //          $(document).ready(function() {
    //        // 点击输入框弹出div层
    //        $("#cpname-search").click(function(e){
    //            cpname_search = true;
    //            e.stopPropagation();
    //            //alert(1234);
    //            cpnametxt ='';
    //            $("#cpname-search").val(cpnametxt);
    //            var offset = $(this).offset();
    //            var left, top,url,data;
    //            if(typeof(countSelf) == 'undefined'){
    //                left = offset.left -210+ 'px';
    //                top = offset.top +26 + 'px';
    //            }
    //            else{
    //                var width = $(window).width();
    //                //屏幕宽度大于1000
    //                if( width> 1000){
    //                    var cutwidth =  (width - 1000)/2 + 230;
    //                }else{
    //                    cutwidth = 230;
    //                }
    //                
    //                left = (offset.left -cutwidth) -210+ 'px';
    //                top = (offset.top +26 -110) + 'px';
    //            }
    //            // alert(offset.left);
    //            $("#selectBig").css({ 'left':left, 'top':top }).show();
    //            $("#ul-bigcate li:first").click();
    //            $("#make-car-m").hide();
    //        });
    //    });
</script>