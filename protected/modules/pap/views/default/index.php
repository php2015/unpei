<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->theme->baseUrl . '/css/pap/index.css' ?>" />
<style>
    .usua{ float: left;font-size: 14px; text-align: center;}
    .usua a{margin:0 9px}
    .tab-bd-con ul{margin:10px 0 5px 5px}
    #make-car-m {border:2px solid #f2b303; }
    /*#make-car-m {border:2px solid #f2b303;left: 480.5px!important; top: 117px!important; }*/
    .right_A .makelist li.selected3{ background:#f2b303 }
    .right_A .makelist ul li.li_list:hover{background:#f2b303}
    .right_A .makelist ul li.li_top{color:#f2b303}
    .car_brand .left_A ul li a{color:#f2b303}
    .car_brand .left_A ul li a:hover { background:#f2b303}
    .tab-hd-con{white-space: nowrap}
    .usua{white-space: nowrap}
</style>
<div class="content1 float_l" target="default" id="default">
    <?php $this->widget('widgets.papmall.MCpName'); ?>
    <!--content1结束-->
</div>



<div class="content2 float_l">
    <div class="content2a" style="position:relative;height:636px">

        <p class="content2_lm" style="font-size:14px">事故件</p>
        <div class="area-sub">
            <div class="tab-product tab-sub-3 ui-style-gradient" id="layout-t">
                <h2 id="tab-hd1" class="tab-hd"style="height:auto"> 
                    <?php
                    if (isset($accident)) {
                        foreach ($accident as $v):
                            ?>
                            <span class="tab-hd-con" key="<?php echo $v['ID'] ?>"><a href="javascript:void(0);"><?php echo isset($v['Name']) ? $v['Name'] : '' ?></a></span> 
        <!--                    <span class="tab-hd-con current"><a href="#">保险杠及附件</a></span> 
                            <span class="tab-hd-con"><a href="#">挡风玻璃及车门</a></span> 
                            <span class="tab-hd-con"><a href="#">照明</a></span>
                            <span class="tab-hd-con"><a href="#">轮胎及附件</a></span> 
                            <span class="tab-hd-con"><a href="#">前部</a></span> 
                            <span class="tab-hd-con"><a href="#">后部</a></span>
                            <span class="tab-hd-con"><a href="#">侧面</a></span>-->
                        <?php endforeach;
                    }
                    ?>
                </h2>
                <div class="tab-bd dom-display"style="height:auto">
                    <div class="show" >
                    </div>
                </div>
            </div>

        </div>
        <div style="text-align:center;clear:both">
        </div>
        <!-- content2a结束-->
    </div> 
    <div class="content2b" style="height:636px">
        <p class="content2_lm" style="font-size:14px">常用件</p>
        <div class="area-sub">
            <div class="tab-product tab-sub-3 ui-style-gradient" id="layout-t2">
                <h2 id="tab-hd2" class="tab-hd" style="height:auto"> 
                    <?php
                    if (isset($usua)) {
                        foreach ($usua as $va):
                            ?>
                            <span class="usua" key="<?php echo $va['ID'] ?>"><a href="javascript:void(0);"><?php
                                    echo isset($va['Name']) ? $va['Name'] : '';
                                    ?></a></span> 
                        <?php endforeach;
                    }
                    ?>
                </h2>
                <div class="tab-bd dom-display" style="height:200px">
                    <div class="tab-bd-con current "> 
                        <div class="uashow" >

                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div style="text-align:center;clear:both">
        </div>
        <!--content2b结束-->
    </div>

</div>
<div class="content3 float_r">
    <div class="content3a">
<!--        <div class="content3a_info"> 
            <p><b>车系选择</b></p> 
            <input type="text" id='make-select' value="选择车型" class="input m_top10 width230 cxxz_input">
            <p class="m_top10"><input type="submit" class="submit" value="查   询" id="carmodelbutton"></p>
<?php //$this->widget('widgets.default.WGoodsCarModel'); ?>
        </div>-->
    </div>
    <div class="content3b">
        <div class="content3b_info"> 
            <p style="line-height:20px"><b style="font-size:14px">经销商推荐</b></p> 
            <ul>
                <?php
                if (isset($dealer)) {

                    foreach ($dealer as $val):
                        if (empty($val['imgpath'])) {
                            $val['imgpath'] = 'logo/default-goods.png';
                        }
                        ?>
                        <li>
                            <div class="tj_img img_box"><a href="<?php echo Yii::app()->createUrl('servicer/servicedetail/detail', array('dealer' => $val['ID'])) ?>" target="_blank"><img  src="<?php echo  Yii::app()->baseUrl . '/upload/' . $val['imgpath'] ?>" ></a></div>
                            <p class="tj_name"><a href="<?php echo Yii::app()->createUrl('servicer/servicedetail/detail', array('dealer' => $val['ID'])) ?>" target="_blank"><?php echo isset($val['OrganName']) ? $val['OrganName'] : '' ?></a></p>
                             <p style="width:160px; text-align:center; margin:0 auto;">手机号:<?php echo $val['Phone']?></p>
                   <p style="width:160px; margin:0px 15px"><a href="<?php echo Yii::app()->createUrl('pap/sellerstore/index', array('id' => $val['ID'])) ?>" target="_blank" class="float_l modelrequired" style="margin-left:15px" dealer="<?php echo $val['ID'];?>">商品订购</a>    <span class="m_left10"> |</span> <a href="<?php echo Yii::app()->createUrl('pap/inquiryorder/index') ?>" target="_blank" class="float_r" style="margin-right:25px;*margin-top:-13px"">询价报价</a></p>
<!--                            <p><a class="float_l" href="<?php //echo Yii::app()->createUrl('pap/sellerstore/index', array('id' => $val['ID'])) ?>" target="_blank" style="margin-left:5px">商品订购</a>   
                                <span style="margin-left:4px"> |</span> 
                                <a style="*margin-top:-15px;margin-right:5px;" class="float_r" href="<?php //echo Yii::app()->createUrl('pap/inquiryorder/index') ?>" target="_blank">询报价</a></p>-->
                        </li>
    <?php endforeach;
}
?>
            </ul>
            <div style="clear:both"></div>
<!--            <div style="text-align:right; margin-top:-2px"><a href="" style="color:#ec8051">更多>></a></div>-->
        </div>
    </div>

</div>
 <div style="clear:both"></div>
<script type="text/javascript">
    //事故件子类点击切换
    $('.tab-hd-con').click(function() {
        var subid = $(this).attr('key');
        $(this).css('background', '#ec8051');
        $(this).find('a').css('color', '#fff');
        $(this).siblings().css("background", "#f0f0f0");
        $(this).siblings().find('a').css('color', '#666');
        var url = Yii_baseUrl + '/pap/default/getgoods';
        $.ajax({
            url: url,
            type: 'POST',
            data: {
                'subid': subid
            },
            dataType: 'json',
            success: function(data)
            {

                if (data) {
                    var html = "";
                    html += "<div class='tab-bd-con current' >"
                    html += " <ul>"
                    $.each(data, function(k, v) {
                        html += "<li><div class='li_padding'><div class='p_img img_box'><a href='" + Yii_baseUrl + "/pap/mall/detail/goods/" + v.ID + "' target='_blank'><img style='*margin-top:-155px' src='<?php echo F::uploadUrl() ?>" + v.imageurl + "'></a></div>"
                        html += " <div class='p_name'><a title='" + v.Name + "' href='" + Yii_baseUrl + "/pap/mall/detail/goods/" + v.ID + "'  target='_blank'>" + v.Name + "</a></div>"
                        html += "<div class='p_price'><span>￥" + v.Price + "</span></div>"
                        html += "</div></li>"
                    });
                    html+="<div style='clear:both'></div>"
                    html += "</ul>"

                    html += "<div class='submore1' style='line-height:15px;text-align:right;display:none'><a href='" + Yii_baseUrl + "/pap/mall/index/sub/" + subid + "' target='_blank'style='color:#ec8051'> 更多>></a></div>"
                    html += "</div>  "
                    $('.show').html(html);
                    $(".show .current ul li").eq(11).nextAll("li").hide();
                    if ($(".show .current ul li").length >12) {
                        $('.submore1').show();
                    }else{
                         $('.submore1').hide();
                        }
                }
            }
        })
    })

    //常用件子类点击切换
    $('.usua').click(function() {
   
        $(this).css('background', '#ec8051');
        $(this).find('a').css('color', '#fff');
        $(this).siblings().css("background", "#f0f0f0");
        $(this).siblings().find('a').css('color', '#666');
        var subid = $(this).attr('key');
        var url = Yii_baseUrl + '/pap/default/getgoods';
        $.ajax({
            url: url,
            type: 'POST',
            data: {
                'subid': subid
            },
            dataType: 'json',
            success: function(data)
            {
                if (data) {
                    var html = "";
                    html += "<div class='tab-bd-con current'>"
                    html += " <ul>"
                    $.each(data, function(k, v) {
                        html += "<li><div class='li_padding'><div class='p_img img_box'><a href='" + Yii_baseUrl + "/pap/mall/detail/goods/" + v.ID + "'  target='_blank'><img  style='*margin-top:-155px' src= '<?php echo F::uploadUrl() ?>" + v.imageurl + "'></a></div>"
                        html += " <div class='p_name'><a title='" + v.Name + "' href='" + Yii_baseUrl + "/pap/mall/detail/goods/" + v.ID + "'  target='_blank'>" + v.Name + "</a></div>"
                        html += "<div class='p_price'><span>￥" + v.Price + "</span></div>"
                        html += "</div></li>"
                    });
                       html+="<div style='clear:both'></div>"
                    html += "</ul>"
                    html += "<div class='submore2' style='line-height:15px;text-align:right;display:none'><a href='" + Yii_baseUrl + "/pap/mall/index/sub/" + subid + "' target='_blank'style='color:#ec8051'> 更多>></a></div>"
                    html += "</div>"
                    $('.uashow').html(html);
                    $(".uashow .current ul li").eq(11).nextAll("li").hide();
                    if ($(".content2b .current ul li").length >12) {
                        $('.submore2').show();
                    } else {
                        $('.submore2').hide();
                    }
                }
            }
        })
    })

    $('#tab-hd1').find('span:first').trigger('click');
    $('#tab-hd2').find('span:first').trigger('click');
    $('#vehicle').click(function() {
        $(this).val('');
    });

    $(function() {
        //适用车型查询
        $('#carmodelbutton').click(function() {
            var data = {};
            data.make = $('#jpmall_make').val();
            data.series = $('#jpmall_series').val();
            data.year = $('#jpmall_year').val();
            data.model = $('#jpmall_model').val();
            var url = Yii_baseUrl + '/pap/mall/search';
            $.each(data, function(k, v) {
                if (v != '') {
                    url += '/' + k + '/' + v;
                }

            })
            location.href = url;
        })
    })
</script>