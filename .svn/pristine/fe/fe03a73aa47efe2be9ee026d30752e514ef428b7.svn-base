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
    .cuxiao{ line-height:100px; text-align:center; width:100px}
    .yicuxiao{ color:#ccc}
    .cuxiao button{ margin-top:35px}
    span.cxsp{ border:1px solid #ebebeb; margin-left:13px; padding:3px 10px; background:#fff}
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
    .cut{  height:20px; white-space: nowrap;overflow: hidden; text-overflow: ellipsis;}
    .width120{ width:120px}
    .m_left36{
        margin-left:36px
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
    }
</style>
<?php
$this->breadcrumbs = array(
    '商品管理' => Yii::app()->createUrl('common/goodslist'),
    '已下架的商品',
);
?>
<div class="bor_back m-top" >
    <p class="txxx">已下架的商品 <span>(共<font style="color:#FB540E;font-size:16px;font-weight: bolder"><?php echo $count ?></font>件商品)</span>
        <!--<a style="float:right;margin-right: 5px;cursor:pointer; *margin-top:-30px" onclick="addgoods()">发布商品</a>-->
    </p>
    <div class="txxx_info2a">
        <form  method="get"  id="search_form">
        </form>
        <input type="text"  name="Title" class=" input input3 width375 float_l" value="<?php echo $_GET['Title'] ? str_replace('<<q>>', '/', $_GET['Title']) : '商品名称/商品编号/配件品类/拼音代码/OE号/品牌' ?>" style="margin-left:0px">
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
//                var_dump($brandNames);
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
                <input id="cpname-search" type="text"  readonly="readonly" class=" input input3"  value="<?php echo DealergoodsService::StandCodegetcpname($_GET['StandCode'], 'Name'); ?>">       
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
                <!--<input name="PartsLevel" type="text" class=" input input3" value="<?php echo str_replace('<<q>>', '/', $_GET['PartsLevel']) ?>">-->
                <input type="hidden" id="code_value" name="StandCode" value=<?php echo $_GET['StandCode'] ?>>
            </p>
            <p class="m-top">
                <label>适用车型：</label>
                <input id="make-select" name="Vehicle"  readonly="readonly" type="text" name="OE" class=" input input3" value="<?php echo $_GET['Vehicle'] ? $_GET['Vehicle'] : '请选择适用车系' ?>">
                <label class="m_left36">参考价：</label>
                <input name="Price" type="text" class=" input input3" value="<?php echo str_replace('<<q>>', '/', $_GET['Price']) ?>">
                <label  class=" m_left40"> OE 号：</label>
                <input type="text" name="OE" class=" input input3" value="<?php echo str_replace('<<q>>', '/', $_GET['OE']) ?>">

            </p>
        </div>
        <div style="height: 18px;padding-top: 3px;font-size: 15px">
            <span style="color: #0065bf;margin-left: 5px;cursor:pointer" onclick="addgoods()">发布商品</span>
            <span style="color: #0065bf;margin-left: 5px;cursor:pointer" onclick="topto()">上架</span>
            <span style="color: #0065bf;margin-left: 5px;cursor:pointer" onclick="yjdelete()">永久删除</span>
            <!--<button  style="height: 25px;width: 60px" onclick="topto()">上架</button>-->
            <!--<span  style="color: #0065bf;margin-left: 5px;cursor:pointer" onclick="yjdelete()">永久删除</span>-->
        </div>


        <?php
        $this->widget('widgets.default.WListView', array(
            'dataProvider' => $data,
            'headerView' => 'dropgoodshead',
            'itemView' => 'dropgoodsinfo',
            'id' => 'goodslistview',
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


        //品类查询
        $("#p-leafcate .li_list").live('click', function() {
            var code = $(this).attr('code');
            $('#code_value').val(code);
        });
        $('#search_id').click(function() {
            var Title = $.trim($('input[name=Title]').val());
            var url = Yii_baseUrl + "/pap/dealergoods/drop/IsSale/0";
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
            if (Vehicle && Vehicle != '请选择适用车系') {
                url += "/Vehicle/" + Vehicle;
            }
            $("#search_form").attr("action", url);
            $('#search_form').submit();
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
                left = offset.left + 'px';
                top = offset.top + 26 + 'px';
            } else {
                var width = $(window).width();
                //屏幕宽度大于1000
                if (width > 1000) {
                    var cutwidth = (width - 1000) / 2 + 230;
                } else {
                    cutwidth = 230;
                }

                left = (offset.left - cutwidth) + 'px';
                top = (offset.top + 26 - 110) + 'px';
            }
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
     *上架
     */
    function topto() {
        var ids = 0;
        $("#checked_id p").each(function() {
            ids += ',' + $(this).attr('id');
        });
        if (ids == 0) {
            alert("请选择商品");
            return false;
        }
        $("#checked_id").html('');
        $.get(Yii_baseUrl + '/pap/dealergoods/topgoods', {id: ids}, function(result) {
            if (result.success) {
                alert('上架成功');
                window.location.reload();
            } else {
                alert('商品名为' + result.name + '的商品上架失败');
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
        });
        if (ids == 0) {
            alert("请选择商品");
            return false;
        }
        $("#checked_id").html('');
        $.get(Yii_baseUrl + '/pap/dealergoods/yjdelete', {id: ids}, function(result) {
            if (result.success) {
                window.location.reload();
            } else {
                alert('商品名为' + result.name + '的商品删除失败，该商品可能已经被删除');
                setTimeout(function() {
                    window.location.reload();
                }, 1000);
            }
        }, 'json');
    }
    /*商品管理页搜索条件展开收起*/
    $(document).ready(function() {
        //点击时让输入框清空
        $("input[name=Title]").click(function() {
            var Title = $(this).val();
            if (Title == '商品名称/商品编号/配件品类/拼音代码/OE号/品牌') {
                $(this).val('');
            }
        })
        $("input[name=Title]").blur(function() {
            var Title = $(this).val();
            if (Title == '') {
                $(this).val('商品名称/商品编号/配件品类/拼音代码/OE号/品牌');
            }
        })

        $("#cpname-search").click(function() {
            $('#code_value').val('');
        });
        $(".zkss").click(function() {
            $(".zkss_info").slideToggle("slow");
            $(this).toggleClass("zkss2")
        })
    })

    $(document).ready(function() {
        /*订单也选项卡*/
        $(".title_lm li").click(function() {
            $(this).addClass("current");
            $(this).siblings().removeClass("current");
        });
        /*
         *点击翻页触发事件
         */
        $(".pager a").live('click', function() {
            setTimeout(function() {
                $("#checked_id p").each(function() {
                    $('#b' + $(this).attr('id')).attr('checked', 'checked');
                });
            }, 500);
        });
    });

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
        var goodsID = $('#loadedit_id').val(); //获取修改ID
        var proprice = $('#editpro').val(); //获取修改促销价的值
        var url = Yii_baseUrl + '/pap/dalergoods/editpromotion';
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
        }
        );
    }

    function closeinfo(id) {
        $('#follow' + id).hide();
    }
    function Loadedit(goodsID) {
        var make = <?php
        if ($make[0]['MakeID'])
            echo 1;
        else
            echo 0;
        ?>;
        if (make == 0) {
            alert('您还没有添加主营车系或数据存在问题，请联系客服');
            return false;
        }
        var url = Yii_baseUrl + '/pap/dealergoods/edit/goodsid/' + goodsID;
        window.location.href = url;
    }
</script>