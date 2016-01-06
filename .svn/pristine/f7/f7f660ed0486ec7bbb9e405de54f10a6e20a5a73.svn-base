<style>
    .selectDiv{background: #fff; width: 625px; display: none; position: absolute; z-index: 1000;border:2px solid #0065bf;}
    .selectDiv2{background: #fff; width: 625px; display: none; position: absolute; z-index: 1000;border:2px solid #0065bf;}
    .selectDiv3{background: #fff; width: 625px; display: none; position: absolute; z-index: 1000;border:2px solid #0065bf;}
    .selected3{ background:#0065bf; color: #fff;}
    .li_toped {background:#39AE39; color:white; border-bottom: 2px #39AE39 solid;}
    a{ text-decoration:none}
    .left_A ul li{ border:1px solid #e1e1e1; width:14px; height:14px; background:#eff4fa; margin-bottom:1px;}

    .left_A ul li a{color:#0065bf;font:12px Arial; padding-left:3px; display:block; float:left;width:12px; height:14px;}
    .left_A ul li a:hover{background:#0065bf; color:white}
    .right_A ul{padding:0; margin:0; list-style:none}
    .right_A ul li.li_top{ height:26px; line-height:26px; background:#F0F0F0; color:#414141; padding-left:10px; font:18px/26px Arial; margin:5px 0 2px 5px; font-weight:bold}
    .right_A ul li.li_list{ text-indent:1em; height:26px; line-height:26px; margin:1px 4px 0; overflow: hidden}
    .right_A ul li.li_list a{ color:#676767; font-size:12px;}
    .right_A ul li.selected3 a{color:#fff}
    .right_A ul li.li_list:hover{ background:#0065bf}
    .right_A ul li.li_list:hover a{ color:white}
    .makelist{ height:240px; overflow-y:scroll; float: left;}
    .chose{font:18px Arial;display:block; float:left; height:30px;line-height:30px; padding-left:10px; margin:5px 0}
    .choseXc{display:block;float:right;  margin-right: 7px;margin-top: 10px;}
    .series_title{
        width: 114px;white-space: nowrap;overflow: hidden; text-overflow: ellipsis;
    }
    .make_title{
        width: 100px;white-space: nowrap;overflow: hidden; text-overflow: ellipsis;
    }
</style>
<div class="pop">
    <div id="make-car-m" class="selectDiv active">
        <div class="selectpop ass-items" style="clear:both; overflow:auto;">
            <!---make begin -->
            <div class="car_brand" style=" clear:both; overflow:auto;">
                <span class="chose">请选择适用车系</span>
                <span class="choseXc"><a href="javascript:;" class="close_selectDiv" style="padding-left:5px;color:#ABABAB"><img src="<?php echo F::themeUrl() ?>/images/papmall/guanbi2.png"></a></span>
                <p style="clear:both"></p>
                <div class="left_A" style="float:left;">
                    <ul style="list-style:none; margin:0;padding-left:10px; height: 240px; overflow:hidden" >
                        <?php
                        $makes = D::queryGoodsMakeself();
                        ?>
                        <?php if ($makes): ?>
                            <?php foreach ($makes as $key => $value): ?>
                                <?php $piny2[] = substr($value['pinyin'], 0, 1); ?>
                            <?php endforeach; ?>
                        <?php endif; ?>
                        <?php if ($piny2): ?>
                            <?php foreach ($piny2 as $key => $value): ?>
                                <?php $PINYA[] = ord($value) ?>
                            <?php endforeach; ?>
                        <?php endif; ?>
                        <?php
                        // var_dump($PINYA);
                        // var_dump(array(ord('J'), ord('Q'))) 
                        ?>
                        <?php
                        for ($i = ord("A"); $i <= ord("Z"); $i++) {
                            if (!empty($PINYA) && in_array($i, $PINYA)) {
                                echo "<li><a href='javascript:void(0)' onclick=on('" . chr($i) . "') >" . chr($i) . "</a></li>";
                            }
                        }
                        ?>
                    </ul>
                </div>
                <div class="right_A" style="float:left;border:1px solid #DEDEDC; margin-left:5px;width:585px; margin-bottom:10px">
                    <div class="makelist" style="width:120px">

                        <ul id="ul-makes">
                            <?php $list = array(); ?>
                            <?php if ($makes): ?>
                                <?php foreach ($makes as $key => $value): ?>
                                    <?php $piny = substr($value['pinyin'], 0, 1); ?>
                                    <?php if (!in_array($piny, $list)): ?>
                                        <li class="li_top"><?php echo $piny ?></li>
                                    <?php endif; ?>
                                    <li class="li_list">
                                        <div class="make_title">
                                            <a id="<?php
                                            if (!in_array($piny, $list)) {
                                                echo $piny;
                                                $list[] = $piny;
                                            }
                                            ?>" title=<?php echo $value['name']; ?> href="javascript:void(0)" key="<?php echo $value['makeId'] ?>"><?php echo $value['name']; ?></a>
                                        </div>
                                    </li> 

                                <?php endforeach; ?>
                            <?php endif; ?>
                        </ul>
                    </div>
                    <div class="makelist " style="width:140px">
                        <ul id="ul-series">

                        </ul>

                    </div>
                    <div class="makelist " style="width:100px">
                        <ul id="ul-year">

                        </ul>

                    </div>
                    <div class="makelist " style="width:220px">
                        <ul id="ul-model">
                        </ul>



                    </div>


                </div>
            </div><!---make end -->
        </div>
        <!--    series beign
            <div class="car_brand car_list" style=" width:170px;float:left;display:block;margin-left:190px;margin-top:-297px">
                <span class="chose"></span>
                   <span class="choseXc"><a href="#" class="close_selectDiv" style="padding-left:5px;color:#ABABAB">X</a></span>
        
                <div class="right_A" style="float:left;border:1px solid #DEDEDC; margin-left:5px;width:165px;">
                    
                </div>
            </div>
             series end-
        
            series beign
            <div class="car_brand model_list" style=" width:260px;float:left;display:block;margin-left:369px;margin-top:-284px">
                   <span class="chose">请选择车型</span>
                <span class="choseXc"><a href="#" class="close_selectDiv" style="padding-left:5px;color:#ABABAB">X</a></span>
        
                <div class="right_A" style="float:left;border:1px solid #DEDEDC; margin-left:-5px;width:271px;">
                    
                </div>
            </div>-->
        <!-- series end--->
        <input type="hidden" value="<?php echo $jpmall_make ?>" name="jpmall_make"  id="jpmall_make"/>
        <input type="hidden" value="<?php echo $jpmall_series ?>" name="jpmall_series" id="jpmall_series"/>
        <input type="hidden" value="<?php echo $jpmall_year ?>" name="jpmall_year" id="jpmall_year"/>
        <input type="hidden" value="<?php echo $jpmall_model ?>" name="jpmall_model" id="jpmall_model"/>
    </div>


</div> 
<script>
    var Yii_chenhgUrl = "<?php echo F::baseUrl(); ?>";
    //判断是否为默认点击厂家
    var maketarget = true;
    //判断是否为默认点击车系
    var sericesarget = true;
    //判断是否为默认点击年款
    var yeartarget = true;
    //判断弹窗是否显示
    var isshow = false;

    function clearVechileSelect() {
        $("#make-select").val('');
        $("#make-select-index").val('');
        $("input[name=jpmall_make]").val('');
        $("input[name=jpmall_series]").val('');
        $("input[name=jpmall_year]").val('');
        $("input[name=jpmall_model]").val('');
        $("#select_make").val('');
        $("#select_series").val('');
        $("#select_year").val('');
        $("#select_model").val('');
    }

    function setSelectVechile() {
        $("#make-select").val("");
        $("#make-select-index").val('');
        var vechileName = "";
        if ($("#ul-makes .selected3").length == 1 && !maketarget) {
            vechileName = $("#ul-makes .selected3 a").text();
            $("input[name=jpmall_make]").val($("#ul-makes .selected3 a").attr("key"));
        }
        if (vechileName != "" && $("#ul-series .selected3").length == 1 && !sericesarget) {
            vechileName += " " + $("#ul-series .selected3 a").text();
            if ($("#ul-series .selected3 a").attr("key") == 'all') {
                $('#make-car-m').hide();
                isshow = false;
            }
            else
                $("input[name=jpmall_series]").val($("#ul-series .selected3 a").attr("key"));
        }
        if (vechileName != "" && $("#ul-year .selected3").length == 1 && !yeartarget) {
            vechileName += " " + $("#ul-year .selected3 a").text();
            if ($("#ul-year .selected3 a").attr("key") == 'all') {
                $('#make-car-m').hide();
                isshow = false;
            }
            else
                $("input[name=jpmall_year]").val($("#ul-year .selected3 a").attr("key"));
        }
        if (vechileName != "" && $("#ul-model .selected3").length == 1) {
            vechileName += " " + $("#ul-model .selected3 a").text();
            if ($("#ul-model .selected3 a").attr("key") != 'all')
                $("input[name=jpmall_model]").val($("#ul-model .selected3 a").attr("key"));
            $('#make-car-m').hide();
            isshow = false;

        }
        $("#make-select").val(vechileName);
        $("#make-select-index").val(vechileName);
        if ($("#make-select").text())
            $("#make-select").text(vechileName);
        $("#search_value").val(vechileName);
        if ($("#make-select-index").val())
            $("#make-select-index").val(vechileName);
        $("#make-select-index").text(vechileName);
    }

    $(function() {
        // 点击输入框弹出div层
        $("#make-select").click(function(e) {
            //判断是否为默认点击厂家
            maketarget = true;
            //判断是否为默认点击车系
            sericesarget = true;
            //判断是否为默认点击年款
            yeartarget = true;
            //判断弹窗是否显示
            isshow = true;
            e.stopPropagation();
            var offset = $(this).offset();
            var left, top, url, data;
            //            left = offset.left -210+ 'px';
            //            top = offset.top +26 + 'px';

            var width = $(window).width();
            //屏幕宽度大于1000
            if (width > 1000) {
                var cutwidth = (width - 1000) / 2;
            } else {
                cutwidth = 0;
            }
            left = offset.left + 'px';
            top = (offset.top + 26) + 'px';
            $("#make-car-m").css({'left': left, 'top': top}).show().removeClass('selectDiv2').removeClass('selectDiv3').addClass('selectDiv');
            $("#selectBig").hide();
            clearVechileSelect();
            $("#ul-makes li:eq(1)").click();
        });
        // 点击输入框弹出div层
        $("#make-select-index").click(function(e) {
            //判断是否为默认点击厂家
            maketarget = true;
            //判断是否为默认点击车系
            sericesarget = true;
            //判断是否为默认点击年款
            yeartarget = true;
            //判断弹窗是否显示
            isshow = true;
            e.stopPropagation();
            var offset = $(this).offset();
            var left, top, url, data;
            //            left = offset.left -210+58 + 'px';
            //            top = offset.top +26 + 'px';

            var width = $(window).width();
            //屏幕宽度大于1000
            if (width > 1000) {
                var cutwidth = (width - 1000) / 2;
            } else {
                cutwidth = 0;
            }

            left = (offset.left - cutwidth) + 'px';
            top = (offset.top + 26) - 322 + 'px';

            $("#make-car-m").css({'left': left, 'top': top}).show().removeClass('selectDiv2').removeClass('selectDiv3').addClass('selectDiv');
            $("#selectBig").hide();
            clearVechileSelect();
            $("#ul-makes li:eq(1)").click();
        });
        // 点击每一项 选中 makelist
        $("#ul-makes .li_list").click(function(e) {
            sericesarget = true;
            yeartarget = true;
            var clas = $(this).attr('class');
            //            var selected=clas.split(" "); //字符分割 
            //            if(selected[1] && selected['1']== 'selected'){
            //                return false;
            //            }
            e.stopPropagation();
            $(this).addClass('selected3').siblings().removeClass('selected3');
            $("#make-car-m").removeClass('selectDiv').removeClass('selectDiv3').addClass('selectDiv2');
            //    $('.model_list').hide();
            var makeId = $(this).find('a').attr('key');
            var maketxt = $(this).find('a').text();
            // 字符串
            if (!maketarget) {
                setSelectVechile();
            }
            maketarget = false;
            $("#ul-series").empty();
            $("#ul-year").empty();
            $("#ul-model").empty();

            $.getJSON(Yii_jpdataUrl + '/vehicle/goodsSerieself', {make: makeId}, function(result) {
                $('.car_list').show();
                $("#ul-series").append('<li class="li_list" id="series_first"><a  href="javascript:void(0)" key="all">所有车系</a></li>');
                if ($("#make-select").attr('key') == 'null_series' || $("#make-select-index").attr('key') == 'null_series') {
                    $("#series_first").hide();
                }
                $.each(result, function(index, value) {
                    $("#ul-series").append('<li class="li_list"><div  class="series_title"><a key=' + value.seriesId + ' href="javascript:void(0)" title=' + value.name + ' >' + value.name + '</a></div></li>');
                })
                if ($("#ul-series  li:first").length > 0)
                    sericesarget = true;
                $("#ul-series  li:eq(1)").click();
            })
        })
        // 点击每一项 选中 serieslist
        $("#ul-series .li_list").live('click', function(e) {
            yeartarget = true;
            var clas = $(this).attr('class');


            e.stopPropagation();

            $(this).addClass('selected3').siblings().removeClass('selected3');
            $("#make-car-m").removeClass('selectDiv2').addClass('selectDiv3');
            var seriesId = $(this).find('a').attr('key');
            //  goodsmaketxt = makeclick
            if (!sericesarget) {
                setSelectVechile();
            }
            if (seriesId == 'all') {
                return false;
            }
            sericesarget = false;
            //防止重复取值
            var selected = clas.split(" "); //字符分割 
            if (selected[1] && selected['1'] == 'selected') {
                return false;
            }
            $("#ul-year").empty();
            $("#ul-model").empty();
            $.getJSON(Yii_jpdataUrl + '/vehicle/goodsYear', {seriesId: seriesId}, function(result) {
                //   console.log(result)
                $('.model_list').show();
                $("#ul-year").append('<li class="li_list"><a  href="javascript:void(0)" key="all">所有年款</a></li>');
                $.each(result, function(index, year) {
                    if (index != 0) {
                        if (year.year) {
                            var li = ' <li class="li_list"><a href="javascript:void(0)" key =' + year.year + ' seriesId=' + result[0] + '>' + year.year + '款</a></li>';
                        } else {
                            var li = ' <li class="li_list"><a href="javascript:void(0)" key =' + 0 + ' >' + year.year + '款</a></li>';
                        }
                        $("#ul-year").append(li);
                        yeartarget = true;
                        //                        vehiletarget = false;
                    }
                });
                $("#ul-year .li_list:eq(1)").click();
            });
        });
        // 点击每一项 选中 serieslist
        $("#ul-year .li_list").live('click', function(e) {
            var clas = $(this).attr('class');

            e.stopPropagation();
            $(this).addClass('selected3').siblings().removeClass('selected3');
            $("#make-car-m").removeClass('selectDiv2').addClass('selectDiv3');
            var seriesId = $(this).find('a').attr('seriesId');
            var year = $(this).find('a').text();
            var yearId = $(this).find('a').attr('key');
            //  goodsmaketxt = makeclick
            if (!yeartarget) {
                setSelectVechile();
            }
            if (yearId == 'all') {
                return false;
            }
            yeartarget = false;
            var selected = clas.split(" "); //字符分割 
            if (selected[1] && selected['1'] == 'selected') {
                return false;
            }
            $.getJSON(Yii_jpdataUrl + '/vehicle/goodsYearModels', {seriesId: seriesId, year: year}, function(result) {
                //   console.log(result)
                $('.model_list').show();
                $("#ul-model").empty();
                $("#ul-model").append('<li class="li_list"><a  href="javascript:void(0)" key="all">所有车型</a></li>');
                $.each(result, function() {
                    $("#ul-model").append('<li class="li_list"><a  key=' + this.modelId + ' href="javascript:void(0)">' + this.name + '</a></li>');
                })
            })
        });

        // 点击每一项 选中 modellist
        $("#ul-model .li_list").live('click', function(e) {
            e.stopPropagation();
            $(this).addClass('selected3').siblings().removeClass('selected3');
            setSelectVechile();
            var modelId = $(this).find('a').attr('key');
            if (modelId != 'all') {
<?php if ($goodsid): ?>
                    var data = {};
                    data.goodsid =<?php echo $goodsid ?>;
                    data.make = $('#jpmall_make').val();
                    data.series = $('#jpmall_series').val();
                    data.year = $('#jpmall_year').val();
                    data.model = $('#jpmall_model').val();
                    $.post(Yii_baseUrl + '/pap/mall/checkcarfit', {data: data}, function(result) {
                        //return false;
                        if (result.success) {
                            $('#fit_span').css('color', 'green');
                            $('#fit_span').html(result.fit);
                        } else {
                            $('#fit_span').css('color', 'red');
                            $('#fit_span').html(result.fit);
                        }
                    }, 'JSON')
<?php endif; ?>
            }

        });

        $(".close_selectDiv").click(function() {
            $('#make-car-m').hide();
            isshow = false;

        });
        $("#make-car-m").live('click', function(event) { // mouseout
            var e = (event) ? event : window.event;
            if (window.event) {//IE
                e.cancelBubble = true;
                e.stopPropagation();
            } else { //火狐
                e.stopPropagation();
            }
            // e.stopPropagation();
        });
        $(document).click(function(e) {
            if ($("#make-select").val()) {
                var make_select = $("#make-select").val();
            } else {
                var make_select = $("#make-select-index").val();
                $("#make-select").val($("#search_value").val());
            }
            if (!make_select) {
                $("input[name=jpmall_make]").val('');
                $("input[name=jpmall_series]").val('');
                $("input[name=jpmall_year]").val('');
                $("input[name=jpmall_model]").val('');
                $("#select_make").val('');
                $("#select_series").val('');
                $("#select_year").val('');
                $("#select_model").val('');

                goodsmakeId = '';
                goodsseriesId = '';
                goodsyear = '';
                goodsmodelId = '';
                makeclick = '';
                goodsmaketxt = '';
                goodsseriestxt = '';
                goodsmodeltxt = '';

                vehiletarget = false;
                maketarget = false;
            } else {
                if (isshow) {
                    if ($("#make-select").val()) {
                        $("#make-select").val('请选择适用车系');
                    } else {
                        $("#make-select-index").val('请选择适用车系');
                    }
                }
            }
            if (isshow) {
                if ($("#make-select").val() == '' || $("#make-select-index").val() == '') {
                    $("#make-select").val('请选择适用车系');
                    $("#make-select-index").val('请选择适用车系');
                }
            }
            e.stopPropagation();
            $("#make-car-m").hide();
            isshow = false;

        });
    })

    function on(id) {
        $("#" + id).focus();
        $("#" + id).trigger("click");
    }
</script>

<script type="text/javascript">
    $(function() {
        //        $(document).bind("click",function(e){ 
        //            var target = $(e.target); 
        //            console.log(target)
        //            if(target.closest(".pop").length == 0){ 
        //                //$(".pop").hide(); 
        //            } 
        //        }) 
    })
</script> 

