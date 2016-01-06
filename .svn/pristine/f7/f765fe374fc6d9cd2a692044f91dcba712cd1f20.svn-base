<style>
    .title_lm li{ float:left; font-size:14px; color:#0164c1; text-align:center; width:100px; text-indent:0}
    .title_lm li:hover{ border-bottom:2px solid #0164c1}
    .title_lm li.current{border-bottom:2px solid #0164c1 }
    .txxx2{ border-bottom:2px solid #c5d2e2}
    .tb_head li{ float:left; color:#fff ; text-align:center}
    .tb_head .sp_info{ width:380px}
    .tb_head .price{ width:150px}
    .tb_head .shuliang{ width:95px}
    .tb_head .s_fukuan{ width:160px}
    .tb_head .caozuo{ width:90px}
    .sp_plcl a{ padding:0px 5px}
    .sp_plcl{ border:1px solid #ccc; display:inline-block; height:20px; line-height:20px;}
    .mbx4{ background:#eff4fa;}
    .mbx4 span{  color:#666}
    span.zwq_color{ color:#fb540e}
    .splb_order{ width:780px}
    .splb_order li{ height:100px; border-bottom:1px solid #ccc; border-right:1px solid #ccc}
    div.div_info{ text-align:left}
    .splb_order .price,.splb_order .shuliang,.splb_order .s_fukuan{ line-height:100px}
    .splb_order .price{ font-weight:400}
    li.last{ border-bottom:none}
    .zkss{display:inline-block; width:100px; height:26px; cursor:pointer}
    .zkss2{display:inline-block; width:100px; height:26px; cursor:pointer}
    .m_left34{margin-left:34px; margin-left:38px\9}
    .go_back{*margin-top:-35px}
    .zkss{background: url(<?php echo F::themeUrl() ?>/images/images/sszh.png) no-repeat 0px -26px;}
    .zkss2{background: url(<?php echo F::themeUrl() ?>/images/images/sszh.png) no-repeat 0px 0px;;}
    .zwq_chuxiao_info{ width:270px}
    .cuxiao{ line-height:100px; text-align:center; margin-right:5px; width:120px}
    .yicuxiao{ color:#ccc}
    .cuxiao button{ margin-top:35px}
    span.cxsp{ border:1px solid #ebebeb; margin-left:10px; padding:3px 10px; background:#fff}
    span.cxsp a{ color:#999; font-weight:400}
    .m-left5{ margin-left:5px}
    .m_left185{ margin-left:185px}
    .cx_cz span{ line-height:15px;}
    .m-top20{ margin-top:20px}
    .m_left120{ margin-left:120px}
    .cankaojia{ text-decoration:line-through}
    .submit3{background: url(<?php echo F::themeUrl() ?>/images/images/submit3.jpg) no-repeat; width:100px}
    .m-top2 { float: right;}
    .checkbox_se { float: left; height: 42px; margin-right: 6px; padding-top: 38px; width: 5px; }
    .m-top3{
        color: gray;
        font-size: 15px;
        font-weight: bolder;
        width: 92px;
    }
    .go_back{display:block;float: right;margin-right:35px;} 
    .go_back a:hover{color:#FB540E;text-decoration: underline}
</style>
<?php
$this->breadcrumbs = array(
//    '营销管理'=>Yii:app()->creatUrl(""),
    '营销管理' => Yii::app()->createUrl('common/marketlist'),
    '添加促销商品',
);
?>    
<div class="bor_back m-top" >
    <p class="txxx">销售中的商品(共<font style="color:#FB540E;font-size:16px;font-weight: bolder;padding:0 3px"><?php echo $noprogoods ?></font>件未促销商品)
        最多可添加<span style="color:#FB540E;font-size:16px;font-weight: bolder;padding:0 3px" >50</span>件促销商品(已添加<font style="color:#FB540E;font-size:16px;font-weight: bolder;padding:0 3px"><?php echo $progoods ?></font>件商品)
        <span class="go_back"><a href="javascript:void(0)"onClick="goback()">返回促销列表</a></span>
    </p>

    <div class="txxx_info2a">
        <form  method="get"  id="search_form">
        </form>
        <input type="text"  name="Title" class=" input input3 width375 float_l" value="<?php echo $_GET['Title'] ? str_replace('<<q>>', '/', $_GET['Title']) : '商品名称/商品编号/拼音代码/OE号/品牌 ' ?>" style="margin-left:0px">
        <input type="submit" class="submit f_weight float_l m_left" id="search_id" value="搜 索"><span class="zkss"> </span>
        <?php
        $get = $_GET;
        unset($get['Title']);
        unset($get['IsSale']);
        unset($get['page']);
        ?>
        <div style="clear:both"></div>
        <div class="zkss_info m-top" style="<?php if ($get) echo 'display:block' ?>">
            <p>
                <label>商品编号：</label>
                <input type="text" name="GoodsNO" class=" input input3" value="<?php echo str_replace('<<q>>', '/', $_GET['GoodsNO']) ?>">
                <label  class=" m_left24">商品名称：</label>
                <input type="text" name="Name" class=" input input3" value="<?php echo str_replace('<<q>>', '/', $_GET['Name']) ?>">
                <label  class=" m_left24">商品品牌：</label>
                <?php
//                $organID = Commonmodel::getOrganID();
//                $brandNames = PapBrand::model()->findAll("OrganID = $organID");
//                $brandName = CHtml::listData($brandNames, 'ID', 'BrandName');
                $brandNames = DealergoodsService::dealergetbrand();
                $brandName = CHtml::listData($brandNames, 'BrandID', 'BrandName');
                echo CHtml::dropDownList('BrandID', $_GET['BrandID'], $brandName, array(
                    'class' => 'select select2',
                    'empty' => '选择商品品牌',
                ));
                ?>	
            </p>
            <p class="m-top">
                <!--<label>配件品类：</label>-->
                <!--<input id="cpname-search" type="text" class=" input input3"  value="<?php //echo DealergoodsService::StandCodegetcpname($_GET['StandCode'], 'Name');      ?>">-->
                <input type="hidden" id="code_value" name="StandCode" value="<?php echo $_GET['StandCode'] ?>">
                <label  class=" ">拼音代码：</label>
                <input name="Pinyin" type="text" class=" input input3" value="<?php echo str_replace('<<q>>', '/', $_GET['Pinyin']) ?>">
                <!--                <label  class=" m_left24">配件档次：</label>
                                <input name="PartsLevel" type="text" class=" input input3" value="<?php echo str_replace('<<q>>', '/', $_GET['PartsLevel']) ?>">-->
                <label  class=" m_left24">配件档次：</label>
                <select class='select select2' name="PartsLevel">
                    <option value="">请选择配件档次</option>
                    <?php
                    foreach (Yii::app()->getParams()->PartsLevel as $key => $value) {
                        if ($key == $_GET['PartsLevel'])
                            echo " <option value=" . $key . " selected='selected'>" . $value . "</option>";
                        else
                            echo " <option value=" . $key . ">" . $value . "</option>";
                    }
                    ?>
                </select>
                <label  class=" m_left40"> OE 号：</label>
                <input type="text" name="OE" class=" input input3" value="<?php echo str_replace('<<q>>', '/', $_GET['OE']) ?>">
            </p>
            <p class="m-top">
                <label>适用车系：</label>
                <input id="make-select" name="Vehicle" type="text" name="OE" class=" input input3"value="<?php echo $_GET['Vehicle'] ?>">
                <label class="m_left24">参考价格：</label>
                <input name="Price" type="text" class=" input input3" value="<?php echo str_replace('<<q>>', '/', $_GET['Price']) ?>">

            </p>
        </div>  
    <!--<p class="m-top"><button class=" submit submit3" onClick="goback()">返回促销列表</button>-->
        <?php
        $this->widget('widgets.default.WListView', array(
            'dataProvider' => $data,
            'headerView' => 'goodshead',
            'itemView' => 'addprogoodsinfo',
            'id' => 'goodslistview',
            'emptyText' => '<div style="height:200px;margin:0 auto;" class="nogoods_text">
                                            <div style=" padding-top: 65px;margin:0 auto; width: 50%">
                                            <div><img style="float: left;display: block" src="' . Yii::app()->theme->baseUrl . '/images/images/nogoods.jpg"><b><span style=" color:#FF6500;float:left;display: block; font-size: 18px;margin:8px 0 0 15px">非常抱歉,没有找到相关商品!</span></b><div style="clear:both"></div></div>
                                                  <div style="margin:20px 0 0 20px; *margin-top:-50px">
                                                    <b><p><span style="color:#353535; font-size: 15px;font-family: \'微软雅黑\'">您可以：</span><span style="color:#676767;font-size: 15px; font-family: \'微软雅黑\'"><a href="' . $this->createUrl("/pap/promotion/index") . '">查看促销列表</a></span></p></b>
                                                </div>
                                            </div>
                                        </div>'
        ));


        $this->beginWidget('zii.widgets.jui.CJuiDialog', array(
            'id' => 'mydialog', //弹窗ID  
            'options' => array(//传递给JUI插件的参数  
                'title' => '设置促销价',
                'autoOpen' => false, //是否自动打开 
                'modal' => true, // 层级
                'width' => '410', //宽度  
                'height' => '300', //高度  
                'resizable' => false,
                'buttons' => array(
                    '确定' => 'js:function(){ setproprice();}',
                    '关闭' => 'js:function(){ $(this).dialog("close");}',
                ),
            ),
        ));
        echo "<div id='formedit'></div>";
        echo "<p id='chenggong'></p>";
        $this->endWidget('zii.widgets.jui.CJuiDialog');
        ?>
        <?php $this->widget('widgets.default.WGoodsCarModel'); ?>
        <?php $this->widget('widgets.default.WGoodsCategoryModel'); ?>
        <p class="mbx mbx3 m-top"></p>
        <div id="checked_id"style="display: nones"></div>
    </div>
</div>

<!--content2结束-->


<script>
    //设置促销价
    function setproprice() {
        var goodsID = $('#loadedit_id').val();  //获取修改ID
        var proprice = $('#editpro' + goodsID).val();   //获取修改促销价的值
        var aa = proprice;

        if (!addProgoodprice($('#editpro' + goodsID))) {
            return false;
        }
        var url = Yii_baseUrl + '/pap/promotion/setproprice';
        $.ajax({
            url: url,
            type: 'post',
            data: {'ID': goodsID, 'proprice': proprice},
            dataType: 'JSON',
            success: function(data)
            {
                if (data.success == 1) {
                    $('#mydialog').dialog('close');

                    var html = '';
                    html += "<p>促销价:<span style='color:#FF5500;font-weight:bolder'>￥" + aa + "</span></p>";
                    $('#cankaojia' + goodsID).addClass('cankaojia');
                    $('#chenggong' + goodsID).html(html).show();


                    alert('设置成功');
                    $('#shezhi' + goodsID).hide();
                    $('#yicuxiao' + goodsID).show();
                    setTimeout("location.reload();", 2000);
                }
                else
                {
                    alert(data.errorMsg);
                    return false;
                }
            }
        });
    }
    /*商品管理页搜索条件展开收起*/
    $(document).ready(function() {
        $(".zkss").click(function() {
            $(".zkss_info").slideToggle("slow");
            $(this).toggleClass("zkss2")
        })

        //品类查询
        $("#p-leafcate .li_list").live('click', function() {
            var code = $(this).attr('code');
            $('#code_value').val(code);

        });
        $("#cpname-search").click(function() {
            $('#code_value').val('');
        });

        //点击时让输入框清空
        $("input[name=Title]").click(function() {
            var Title = $(this).val();
            if (Title == '商品名称/商品编号/拼音代码/OE号/品牌 ') {
                $(this).val('');
            }
        })
        $("input[name=Title]").blur(function() {
            var Title = $(this).val();
            if (Title == '') {
                $(this).val('商品名称/商品编号/拼音代码/OE号/品牌 ');
            }
        })

        //品类查询
        $("#p-leafcate .li_list").live('click', function() {
            var code = $(this).attr('code');
            $('#code_value').val(code);

        });

        //搜索
        $('#search_id').click(function() {
            var Title = $.trim($('input[name=Title]').val());
            var url = Yii_baseUrl + "/pap/promotion/addpromotion/IsSale/1";
            if ($.trim(Title) && Title != '商品名称/商品编号/拼音代码/OE号/品牌') {
                Title = Title.replace(/\//g, "<<q>>");
                Title = encodeURIComponent(Title);
                url += "/Title/" + Title;
            }
            var GoodsNO = $.trim($('input[name=GoodsNO]').val());
            if (GoodsNO) {
                GoodsNO = GoodsNO.replace(/\//g, "<<q>>");
                GoodsNO = encodeURIComponent(GoodsNO);
                url += "/GoodsNO/" + GoodsNO;
            }
            var Name = $.trim($('input[name=Name]').val());
            if (Name) {
                Name = Name.replace(/\//g, "<<q>>");
                Name = encodeURIComponent(Name);
                url += "/Name/" + Name;
            }
            var BrandID = $.trim($('select[name=BrandID]').val());
            if (BrandID) {
                url += "/BrandID/" + BrandID;
            }
            var StandCode = $.trim($('input[name=StandCode]').val());
            if (StandCode) {
                url += "/StandCode/" + StandCode;
            }
            var Pinyin = $.trim($('input[name=Pinyin]').val());
            if (Pinyin) {
                Pinyin = Pinyin.replace(/\//g, "<<q>>");
                Pinyin = encodeURIComponent(Pinyin);
                url += "/Pinyin/" + Pinyin;
            }
            var PartsLevel = $.trim($('select[name=PartsLevel]').val());
            if (PartsLevel) {
                url += "/PartsLevel/" + PartsLevel;
            }
            var Price = $.trim($('input[name=Price]').val());
            if (Price) {
                Price = Price.replace(/\//g, "<<q>>");
                Price = encodeURIComponent(Price);
                url += "/Price/" + Price;
            }
            var OE = $.trim($('input[name=OE]').val());
            if (OE) {
                OE = OE.replace(/\//g, "<<q>>");
                OE = encodeURIComponent(OE);
                url += "/OE/" + OE;
            }
            var make = $('#jpmall_make').val();
            if (make) {
                url += "/make/" + make;
            }
            //            else if(<?php echo $_GET['make'] ? $_GET['make'] : 0 ?>){
            //                url +="/make/"+<?php echo $_GET['make'] ? $_GET['make'] : 0 ?>;
            //                if(<?php echo $_GET['make'] ? $_GET['make'] : 0 ?>){
            //                    url +="/series/"+<?php echo $_GET['series'] ? $_GET['series'] : 0 ?>;
            //                }
            //                if(<?php echo $_GET['make'] ? $_GET['make'] : 0 ?>){
            //                    url +="/year/"+<?php echo $_GET['year'] ? $_GET['year'] : 0 ?>;
            //                }
            //                if(<?php echo $_GET['make'] ? $_GET['make'] : 0 ?>){
            //                    url +="/model/"+<?php echo $_GET['model'] ? $_GET['model'] : 0 ?>;
            //                }
            //            }
            var series = $('#jpmall_series').val();
            if (series) {
                url += "/series/" + series;
            }
            var year = $('#jpmall_year').val();
            if (year) {
                url += "/year/" + year;
            }
            var model = $('#jpmall_model').val();
            if (model) {
                url += "/model/" + model;
            }
            var Vehicle = $.trim($('#make-select').val());
            if (Vehicle) {
                url += "/Vehicle/" + Vehicle;
            }
            $("#search_form").attr("action", url);
            $('#search_form').submit();
        })
    })

    $(document).ready(function() {
        /*订单也选项卡*/
        $(".title_lm li").click(function() {
            $(this).addClass("current");
            $(this).siblings().removeClass("current");

        })

        // 点击输入框弹出div层
        $("#cpname-search").click(function(e) {
            cpname_search = true;
            e.stopPropagation();
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

        /*
         *点击翻页触发事件
         */
        $(".pager a").live('click', function() {
            setTimeout(function() {
                $("#checked_id p").each(function() {
                    $('#b' + $(this).attr('id')).attr('checked', 'checked');
                })
            }, 500);
        })
    })

    //返回促销商品列表
    function goback() {
        var url = Yii_baseUrl + '/pap/promotion/index';
        window.location.href = url;
    }

    /*
     * 多选框选中
     */
    function checkbox(ID) {
        var ids = Array();
        $("#checked_id p").each(function() {
            ids.push('a' + $(this).attr('id'));
        })
        if ($.inArray('a' + ID, ids) == -1) {
            var html = "<p style='display:none' id=" + ID + "></p>";
            $("#checked_id").append(html);
        } else {
            $("#" + ID).remove();
        }

    }


    function addProgoodprice(obj) { //检测促销价
        var price = parseFloat($(obj).attr('price')).toFixed(2); //获取弹框参考价
        var val = parseFloat($(obj).val()).toFixed(2);           //获取输入的促销价(失去焦点)
        val = val - 1;
        price = price - 1;
        if (isNaN(val)) {
            alert('请输入输数字');
            return false;
        }
        else if (val <= -1) {
            alert('请输入有效数值');
            return false;
        }
        else if (val >= price) {
            alert('促销价应小于参考价');
            return false;
        }
        else {
            return true;
        }
    }


</script>
