<style>
    .selectDiv4,.selectDiv22,.selectDiv33{background: #fff; width: 850px;;margin:10px auto}
    .selected3{ background:#0065bf; color: #fff;}
    .li_toped {background:#39AE39; color:white; border-bottom: 2px #39AE39 solid;}


    a{ text-decoration:none}
    .left_AA ul li{ border:1px solid #e1e1e1; width:14px; height:14px; background:#eff4fa; margin-bottom:1px;}

    .left_AA ul li a{color:#0065bf;font:12px Arial; padding-left:3px; display:block; float:left ;width:12px; height:14px;}
    .left_AA ul li a:hover{background:#0065bf; color:white}
    .right_A ul{padding:0; margin:0; list-style:none}

    .right_A ul li.li_top{ height:26px; line-height:26px; background:#F0F0F0; color:#414141; padding-left:10px; font:18px/26px Arial; margin:5px 0 2px 5px; font-weight:bold}
    .right_A ul li.li_list{ text-indent:1em; height:26px; line-height:26px; margin:1px 4px 0; overflow: hidden}
    .right_A ul li.li_list a{ color:#676767; font-size:12px;}
    .right_A ul li.selected3 a{color:#fff}
    .right_A ul li.li_list:hover{ background:#0065bf}
    .right_A ul li.li_list:hover a{ color:white}

    .makelist{ height:200px; overflow-y:scroll; float: left;}

    .chose{font:13px Arial;display:block; float:left; height:25px;line-height:30px; padding-left:10px; margin:2px 0}
    .choseXc{display:block;float:right;  margin-right: 7px;margin-top: 10px;} /*border:1px solid #e1e1e1;width:20px;height:20px;*/
    .series_title{
        width: 200px;white-space: nowrap;overflow: hidden; text-overflow: ellipsis;
    }
</style>
<div class="pop">
    <div id="make-car-m" class="selectDiv4 active" >
        <div class="selectpop ass-items" style="clear:both; overflow:auto;">
            <div class="car_brand" style=" clear:both; overflow:auto;">
                <span class="chose">请选择适用车系</span>
                <p style="clear:both"></p>
                <div class="left_AA" style="float:left;">
                    <ul style="list-style:none; margin:0;padding-left:10px; height: 200px; overflow:hidden" >
                        <?php
                        $makes = D::queryGoodsMakes();
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
                        for ($i = ord("A"); $i <= ord("Z"); $i++) {
                            if (!empty($PINYA) && in_array($i, $PINYA)) {
                                echo "<li><a href='javascript:void(0)' onclick=on('" . chr($i) . "') >" . chr($i) . "</a></li>";
                            }
                        }
                        ?>
                    </ul>
                </div>
                <div class="right_A" style="float:left;border:1px solid #DEDEDC; margin-left:5px; margin-bottom:10px">
                    <div class="makelist" style="width:200px">

                        <ul id="ul-makes">
                            <?php $list = array(); ?>
                            <?php if ($makes): ?>
                                <?php foreach ($makes as $key => $value): ?>
                                    <?php $piny = substr($value['pinyin'], 0, 1); ?>
                                    <?php if (!in_array($piny, $list)): ?>
                                        <li class="li_top"><?php echo $piny ?></li>
                                    <?php endif; ?>
                                    <li class="li_list">
                                        <a id="<?php
                            if (!in_array($piny, $list)) {
                                echo $piny;
                                $list[] = $piny;
                            }
                                    ?>" href="javascript:void(0)" key="<?php echo $value['makeId'] ?>"><?php echo $value['name']; ?></a>
                                    </li> 

                                <?php endforeach; ?>
                            <?php endif; ?>
                        </ul>
                    </div>
                    <div class="makelist " style="width:220px">
                        <ul id="ul-series">

                        </ul>

                    </div>
                    <div class="makelist " style="width:120px">
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
        <input type="hidden" value="<?php echo $jpmall_make ?>" name="jpmall_make"  id="jpmall_make"/>
        <input type="hidden" value="<?php echo $jpmall_series ?>" name="jpmall_series" id="jpmall_series"/>
        <input type="hidden" value="<?php echo $jpmall_year ?>" name="jpmall_year" id="jpmall_year"/>
        <input type="hidden" value="<?php echo $jpmall_model ?>" name="jpmall_model" id="jpmall_model"/>
    </div>


</div> 
<script>
    var Yii_chenhgUrl = "<?php echo F::baseUrl(); ?>";
    //判断是否为默认点击厂家
    var maketarget_m = true;
    //判断是否为默认点击车系
    var sericesarget_m = true;
    //判断是否为默认点击年款
    var yeartarget_m = true;
    //判断弹窗是否显示
    var isshow_m = false;
    var checkcode=0;  //是否需要输入验证码,0不需要1需要

    function setSelectVechile() {
    }

    $(function() {
        // 点击每一项 选中 makelist
        $("#ul-makes .li_list").click(function(e) {
            sericesarget_m = true;
            yeartarget_m = true;
            var clas = $(this).attr('class');
            e.stopPropagation();
            $(this).addClass('selected3').siblings().removeClass('selected3');
            $("#make-car-m").removeClass('selectDiv4').removeClass('selectDiv33').addClass('selectDiv22');
            var makeId = $(this).find('a').attr('key');
            var maketxt = $(this).find('a').text();
            if (!maketarget_m) {
                setSelectVechile();
            }
            maketarget_m = false;
            $("#ul-series").empty();
            $("#ul-year").empty();
            $("#ul-model").empty();  
            checktime(1);
            if(checkcode==1)
                return false;
            $.getJSON(Yii_jpdataUrl + '/vehicle/goodsSeries', {make: makeId}, function(result) {
                $('.car_list').show();
                if ($("#make-select").attr('key') == 'null_series' || $("#make-select-index").attr('key') == 'null_series') {
                    $("#series_first").hide();
                }
                $.each(result, function(index, value) {
                    $("#ul-series").append('<li class="li_list"><div  class="series_title"><a key=' + value.seriesId + ' href="javascript:void(0)" title='+value.name+' >' + value.name + '</a></div></li>');
                })
                if ($("#ul-series  li:first").length > 0)
                    sericesarget_m = true;
                if(global_vehicle.series=='')
                    $("#ul-series  li:eq(0)").click();
                else{
                    $("#ul-series .li_list").find('a[key="'+global_vehicle.series+'"]').focus().click();
                    global_vehicle.series='';
                }
            })
        })
        // 点击每一项 选中 serieslist
        $("#ul-series .li_list").live('click', function(e) {
            yeartarget_m = true;
            var clas = $(this).attr('class');
            e.stopPropagation();
            $(this).addClass('selected3').siblings().removeClass('selected3');
            $("#make-car-m").removeClass('selectDiv22').addClass('selectDiv33');
            var seriesId = $(this).find('a').attr('key');
            $("#ul-year").empty();
            $("#ul-model").empty();
            if (!sericesarget_m) {
                setSelectVechile();
                checktime(2);
                if(checkcode==1)
                    return false;
            }
            if (seriesId == 'all') {
                return false;
            }       
            sericesarget_m = false;
            //防止重复取值
            var selected = clas.split(" "); //字符分割 
            if (selected[1] && selected['1'] == 'selected') {
                return false;
            }
            $.getJSON(Yii_jpdataUrl + '/vehicle/goodsYear', {seriesId: seriesId}, function(result) {
                $('.model_list').show();
                $.each(result, function(index, year) {
                    if (index != 0) {
                        if (year.year) {
                            var li = ' <li class="li_list"><a href="javascript:void(0)" key =' + year.year + ' seriesId=' + result[0] + '>' + year.year + '</a></li>';
                        } else {
                            var li = ' <li class="li_list"><a href="javascript:void(0)" key =' + 0 + ' >' + year.year + '</a></li>';
                        }
                        $("#ul-year").append(li);
                        yeartarget_m = true;
                    }
                })
                if(global_vehicle.year=='')
                    $("#ul-year .li_list:eq(0)").click();
                else{
                    $("#ul-year .li_list").find('a[key="'+global_vehicle.year+'"]').focus().click();
                    global_vehicle.year='';
                }
            })
        });
        
        // 点击每一项 选中 serieslist
        $("#ul-year .li_list").live('click', function(e) {
            var clas = $(this).attr('class');
            e.stopPropagation();
            $(this).addClass('selected3').siblings().removeClass('selected3');
            $("#make-car-m").removeClass('selectDiv22').addClass('selectDiv33');
            var seriesId = $(this).find('a').attr('seriesId');
            var year = $(this).find('a').text();
            var yearId = $(this).find('a').attr('key');
            $("#ul-model").empty();
            if (!yeartarget_m) {
                setSelectVechile();
                checktime(3);
                if(checkcode==1)
                    return false;
            }
            if (yearId == 'all') {
                return false;
            }
            yeartarget_m = false;
            var selected = clas.split(" "); //字符分割 
            if (selected[1] && selected['1'] == 'selected') {
                return false;
            }
            $.getJSON(Yii_jpdataUrl + '/vehicle/goodsYearModels', {seriesId: seriesId, year: year}, function(result) {
                $('.model_list').show();
                $("#ul-model").empty();
                $.each(result, function(k,v) {
                    $("#ul-model").append('<li class="li_list"><a  key=' + this.modelId + ' href="javascript:void(0)">' + this.name + '</a></li>');
                })
                if(global_vehicle.model!=''){
                    $("#ul-model .li_list").find('a[key="'+global_vehicle.model+'"]').focus().click();
                    global_vehicle.model='';
                }
                
            })
        });

        // 点击每一项 选中 modellist
        $("#ul-model .li_list").live('click', function(e) {
            var code=0;
            if($(this).hasClass('selected3')==true){
                return false;
            }
            e.stopPropagation();
            $(this).addClass('selected3').siblings().removeClass('selected3');
            setSelectVechile();
            var modelId = $(this).find('a').attr('key');
            var url = Yii_jpdata_baseUrl + "/vehicle/frontModelInfo";
            if(modelId){       
                checktime(4);
                if(checkcode==1)
                    return false;
                $.ajax({
                    url: url,
                    type: "POST",
                    data: {
                        'modelId': modelId
                    },
                    dataType: "html",
                    success:function(html){
                        $('.zoomContainer').remove();
                        $(".code-content").html(html);
                        $(".result-title ").show();
                        get_height_align('.sidebar','.content');
                    }
                }); 
            }
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
    })

    function on(id) {
        $("#" + id).focus();
        $("#" + id).trigger("click");
    }
    
    //验证查询次数
    function checktime(type){
        $('#checktype').val(type);
        $.ajax({
            url:Yii_jpdata_baseUrl + "/vehicle/check",
            type: "POST",
            async:false,
            dataType: "json",
            success:function(res){
                if(res.res==0){
                    //输入验证码后才能继续查询
                    checkcode=1;
                    $('#checkcode').find('[name="code"]').val('');
                    $('#codewarning').hide();
                    $('#checkcode').find('a').trigger('click');  //更换验证码
                    if(global_vehicle.make!=''){
                        setTimeout('$("#checkcode").dialog("open")',500); 
                        global_vehicle.make='';
                    }
                    else{
                        $("#checkcode").dialog("open");
                    }
                }else{
                    //可以继续查询
                    checkcode=0;
                }
            }
        }); 
    }
</script>

