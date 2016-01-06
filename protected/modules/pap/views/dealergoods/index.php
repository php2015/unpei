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

    .m-top2 {
        float: right;
    }

    .checkbox_se {
        float: left;
        height: 42px;
        margin-right: 6px;
        *margin-right: 12px;
        padding-top: 38px;
        width: 5px;
    }
    .m-top3{
        color: gray;
        font-size: 15px;
        font-weight: bolder;
        width: 92px;
    }
    .cut{  height:17px; white-space: nowrap;overflow: hidden; text-overflow: ellipsis;}
    .width180{ width:180px}
    .m_left36{
        margin-left:36px
    }
</style>
<?php
$this->breadcrumbs = array(
    '商品管理' => Yii::app()->createUrl('common/goodslist'),
    '销售中的商品',
);
?>    
<div class="bor_back m-top" >
    <p class="txxx">销售中的商品 <span>(共<font style="color:#FB540E;font-size:16px;font-weight: bolder; padding:0px 2px"><?php echo $count ?></font>件商品)</span>
        <!--<a style="float:right;margin-right: 5px;cursor:pointer;*margin-top:-30px" onclick="addgoods()">发布商品</a>-->
    </p>
    <div class="txxx_info2a">
        <form method="GET"  id="search_form">
        </form>
        <input type="text"  name="Title" class=" input input3 width375 float_l" value="<?php echo $_GET['Title'] ? str_replace('<<q>>', '/', $_GET['Title']) : '商品名称/商品编号/配件品类/拼音代码/OE号/品牌 ' ?>" style="margin-left:0px">
        <input type="submit" class="submit f_weight float_l m_left" id="search_id" value="搜 索"><span class="zkss"> </span>
        <div style="clear:both"></div>
        <?php
        $get = $_GET;
        unset($get['Title']);
        unset($get['IsSale']);
        unset($get['page']);
        ?>
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
                $brandNames = DealergoodsService::dealergetbrand();
                $brandName = CHtml::listData($brandNames, 'BrandID', 'BrandName');
                echo CHtml::dropDownList('BrandID', $_GET['BrandID'], $brandName, array(
                    'class' => 'select select2',
                    'empty' => '选择商品品牌',
                ));
                ?>	
            </p>
            <p class="m-top">
                <label>配件品类：</label>
                <input id="cpname-search" readonly="readonly" type="text" class=" input input3"  value="<?php echo DealergoodsService::StandCodegetcpname($_GET['StandCode'], 'Name'); ?>">

                <label  class=" m_left24">拼音代码：</label>
                <input name="Pinyin" type="text" class=" input input3" value="<?php echo str_replace('<<q>>', '/', $_GET['Pinyin']) ?>">
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

<!--                <input name="PartsLevel" type="text" class=" input input3" value="<?php echo str_replace('<<q>>', '/', $_GET['PartsLevel']) ?>">-->
                <input type="hidden" id="code_value" name="StandCode" value=<?php echo $_GET['StandCode'] ?>>
            </p>
            <p class="m-top">
                <label>适用车型：</label>
                <input id="make-select" readonly="readonly" name="Vehicle" type="text" name="OE" class=" input input3" value="<?php echo $_GET['Vehicle'] ?>">
                <label class="m_left36">参考价：</label>
                <input name="Price" type="text" class=" input input3" value="<?php echo str_replace('<<q>>', '/', $_GET['Price']) ?>">
                <label  class=" m_left40"> OE 号：</label>
                <input type="text" name="OE" class=" input input3" value="<?php echo str_replace('<<q>>', '/', $_GET['OE']) ?>">

            </p>
        </div>
        <div style="height: 18px;padding-top: 3px;font-size: 15px">
            <span style="color: #0065bf;margin-left: 5px;cursor:pointer" onclick="addgoods()">发布商品</span>
            <span style="color: #0065bf;margin-left: 5px;cursor:pointer" onclick="dropto()">下架</span>
            <!--            <button  style="height: 25px;width: 60px;" onclick="dropto()" >下架</button>-->
            <!--            <span  style="color: #0065bf;margin-left: 5px" onclick="yjdelete()">永久删除</span>-->

        </div>


        <?php
        $this->widget('widgets.default.WListView', array(
            'dataProvider' => $data,
            'headerView' => 'goodshead',
            'itemView' => 'goodsinfo',
            'id' => 'goodslistview',
            'ajaxUpdate' => true,
            'emptyText' => '<div style="height:200px;margin:0 auto;" class="nogoods_text">
                                            <div style=" padding-top: 65px;margin:0 auto; width: 50%">
                                                <div><img style="float: left;display: block" src="' . Yii::app()->theme->baseUrl . '/images/images/nogoods.jpg"><b><span style=" color:#FF6500;float:left;display: block; font-size: 18px;margin:8px 0 0 15px">非常抱歉,没有找到相关商品!</span></b><div style="clear:both"></div></div>
                                                <div style="margin:20px 0 0 20px; *margin-top:-50px">
                                                    <b><p style="text-align:left; text-indent:40px"><span style="color:#353535; font-size: 15px;font-family: \'微软雅黑\'">您可以：</span><span style="color:#676767;font-size: 15px; font-family: \'微软雅黑\'"><a href="' . $this->createUrl("/pap/dealergoods/addinfo1") . '">发布新商品</a></span></p></b>
                                                </div>
                                            </div>
                                        </div>'
        ));
        ?>
        <?php $this->widget('widgets.default.WGoodsCarModel'); ?>
        <?php $this->widget('widgets.default.WGoodsCategoryModel'); ?>
        <p class="mbx mbx3 m-top">

        </p>
        <div id="checked_id"style="display: nones"></div>
    </div>
</div>

<!--content2结束-->


<script>
    $(document).ready(function() {
        var a =<?php echo $_GET['make'] ? $_GET['make'] : 0; ?>;
        if (a) {
            $('#jpmall_make').val(<?php echo $_GET['make'] ?>);
            $('#jpmall_series').val(<?php echo $_GET['series'] ?>);
            $('#jpmall_year').val(<?php echo $_GET['year'] ?>);
            $('#jpmall_model').val(<?php echo $_GET['model'] ?>);
        }
        // 点击输入框弹出div层
        $("#cpname-search").click(function(e) {
            cpname_search = true;
            e.stopPropagation();
            //alert(1234);
            cpnametxt = '';
            $("#cpname-search").val(cpnametxt);
            var offset = $(this).offset();
            var left, top, url, data;


            left = offset.left + 'px';
            top = (offset.top + 26) + 'px';

            // alert(offset.left);
            $("#selectBig").css({'left': left, 'top': top}).show();
            $("#ul-bigcate li:first").click();
            $("#make-car-m").hide();
        });
    });
    /*发布商品*/
    function addgoods() {
        var url = Yii_baseUrl + '/pap/dealergoods/addinfo1';
        window.location.href = url;
    }
    /*
     *下架
     */
    function dropto() {
        var ids = 0;
        $("#checked_id p").each(function() {
            ids += ',' + $(this).attr('id');
        });
        if (ids == 0) {
            alert("请选择商品");
            return false;
        }

        $("#checked_id").html('');
        $.get(Yii_baseUrl + '/pap/dealergoods/dropgoods', {id: ids}, function(result) {
            if (result.success) {
                alert('下架成功');
                window.location.reload();
            } else {
                alert('商品名为' + result.name + '的商品下架失败');
                setTimeout(function() {
                    window.location.reload();
                }, 1000);
            }
        }, 'json');
    }
    /*
     *永久删除
     */
    function yjdelete() {
        var ids = 0;
        $("#checked_id p").each(function() {
            ids += ',' + $(this).attr('id');
        })
        $("#checked_id").html('');
        $.get(Yii_baseUrl + '/pap/dealergoods/yjdelete', {id: ids}, function(result) {
            if (result.success) {
                window.location.reload();
            } else {
                alert('商品名为' + result.name + '的商品删除失败');
                setTimeout(function() {
                    window.location.reload();
                }, 1000);
            }
        }, 'json');
    }
    /*商品管理页搜索条件展开收起*/
    $(document).ready(function() {
        $(".zkss").click(function() {
            $(".zkss_info").slideToggle("slow");
            $(this).toggleClass("zkss2")
        })
        $('#search_id').click(function() {
            var Title = $.trim($('input[name=Title]').val());
            var url = Yii_baseUrl + "/pap/dealergoods/index/IsSale/1";
            if ($.trim(Title) && Title != '商品名称/商品编号/配件品类/拼音代码/OE号/品牌') {
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
            if (Title == '商品名称/商品编号/配件品类/拼音代码/OE号/品牌 ') {
                $(this).val('');
            }
        })
        $("input[name=Title]").blur(function() {
            var Title = $(this).val();
            if (Title == '') {
                $(this).val('商品名称/商品编号/配件品类/拼音代码/OE号/品牌 ');
            }
        })


        /*订单也选项卡*/
        $(".title_lm li").click(function() {
            $(this).addClass("current");
            $(this).siblings().removeClass("current");

        })
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

    //取消促销价
    $('#pro').live('click', function() {
        var bool = window.confirm('你确定要取消促销吗？');
        if (bool == false)
        {
            return false;
        }
        var goodsID = $(this).attr('key');
        var url = Yii_baseUrl + '/pap/promotion/delpromotion';
        $.ajax({
            url: url,
            type: 'POST',
            data: {'ID': goodsID},
            dataType: 'JSON',
            success: function(data)
            {
                if (data.success == 1)
                {
                    //    location.reload();
                    $.fn.yiiListView.update(
                            "goodslistview"
                            )

                }
                else
                {
                    alert(data.errorMsg);
                    return false;
                }
            }
        })
    });



    //修改促销价
    function editproprice() {
        var goodsID = $('#loadedit_id').val();  //获取修改ID
        var proprice = $('#editpro').val();   //获取修改促销价的值
        var url = Yii_baseUrl + '/pap/dealergoods/editpromotion';
        $.ajax({
            url: url,
            type: 'POST',
            data: {'ID': goodsID, 'proprice': proprice},
            dataType: 'JSON',
            success: function(data)
            {
                if (data.success == 1)
                {
                    $('#mydialog').dialog('close');
                    $.fn.yiiListView.update(
                            "goodslistview"
                            )
                }
                else
                {
                    alert(data.errorMsg);
                    return false;
                }
            }
        });
    }



</script>