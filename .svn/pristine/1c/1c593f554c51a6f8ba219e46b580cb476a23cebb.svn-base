<link rel="stylesheet" type="text/css" href="<?php echo F::themeUrl() ?>/css/newhome/hy.css"/>
<link type="text/css" rel="stylesheet" href="<?php echo F::themeUrl(); ?>/css/inma.css" />
<!--<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->theme->baseUrl ?>/css/pap/goodsinfo.css" />-->
<style>
    .bmove {width: 665px;height: 180px;position: relative;margin-left: 30px;}
    .bmove_sub {width: 640px;height: 180px;position: absolute;left: 2px;top: 15px;overflow: hidden;}
    .bmove li {width: 200px;height: 155px;padding: 1px;border: 1px solid #ccc;float: left;margin: 5px;}
    .hy-con3{width: 720px;height: 260px;}
    .hy-con4{width: 260px;height: 260px;}
    .hy-con4 ul {padding: 20px;}
</style>

<?php
$this->pageTitle = Yii::app()->name . ' - 查看经销商';
//$organimg = $organphotos[0]['Path'];
//$imgarr=getimagesize(F::uploadUrl().$organimg);
//var_dump($imgarr);
//$defaultimg = "data:image/jpeg;base64,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";
?>
<div class="hy-head">
    <div class="w1000">
        <div class="p-t17">
            <div class="float_l hy-headimg">
                <img src="<?php echo F::uploadUrl() . ($model->Logo ? $model->Logo : 'logo/touxiang.jpg'); ?>"/>
                <?php //if (!empty($model['Logo'])): ?>
                    <!--<img src="<?php //echo F::uploadUrl() . ($model->Logo ? $model->Logo : 'logo/touxiang.jpg');  ?>"/>-->
                <?php //else: ?>
                    <!--<img src="<?php //echo $defaultimg  ?>" jqimg="<?php //echo $defaultimg  ?>"/>-->
                <?php //endif; ?>
                <div class="hy-hd-y"></div>
            </div> 
            <div class="float_l hy-name">
                <p class="hy-jxsname"><?php echo $model['OrganName']; ?></p>
                <p class="hy-jxstel">联系电话：<?php echo $model->Phone; ?></p>
            </div>
        </div>
    </div>
</div>
<div class="hy-jxscon m-top">
    <div class="hy-jxs-info">
        <div class="float_l hy-con hy-con1">
            <p class="hy-title">基本信息</p>
            <!--            <div class="float_l">
            <?php //if (!empty($organphotos)): ?>
            <?php //$this->renderPartial('imagesgallery', array("pictures" => $organphotos)); ?>
            <?php //else: ?>
                                            <img src="<?php //echo F::baseUrl() . '/upload/dealer/';            ?>goods-img-big.jpg" width="459" height="345" />
            <?php //endif ?>   
                        </div>-->
            <div id=preview>
                <div class=jqzoom id=spec-n1 >
                    <?php if (!empty($organphotos) && is_array($organphotos)): ?>
                        <img src="<?php echo F::uploadUrl() . $organphotos[0]['Path'] ?>" jqimg="<?php echo F::uploadUrl() . $organphotos[0]['Name'] ?>" width=320/>
                    <?php else: ?>
                        <img src="<?php echo $defaultimg ?>" jqimg="<?php echo $defaultimg ?>" width=320/>
                    <?php endif; ?>
                </div>
                <div id=spec-n5>
                    <div class=control id=spec-left>
                        <img src="<?php echo Yii::app()->theme->baseUrl; ?>/images/papmall/left.gif" />
                    </div>
                    <div id=spec-list>
                        <ul class=list-h>
                            <?php if (!empty($organphotos) && is_array($organphotos)):foreach ($organphotos as $v): ?>
                                    <li><img src="<?php echo F::uploadUrl() . $v['Path'] ?>" > </li>
                                    <?php
                                endforeach;
                            else:
                                ?>
                                <li>
                                    <img src="<?php echo $defaultimg ?>"/>
                                </li>
                            <?php endif; ?>
                        </ul>
                    </div>
                    <div class=control id=spec-right>
                        <img src="<?php echo Yii::app()->theme->baseUrl; ?>/images/papmall/right.gif" />
                    </div>
                </div>
            </div> 
            <div class="float_l hy-jcinfo">
                <ul>
                    <li><b>成立年份：</b><span><?php echo $model['FoundDate']; ?></span></li>
                    <li><b>年销售额：</b><span><?php echo $model['dealer']['SaleMoney']; ?></span></li>
                    <li><b>经营面积：</b><span><?php echo $model['dealer']['ShopArea']; ?></span></li>
                    <li><b>公司规模：</b><span><?php echo $model['StoreSize']; ?></span></li>
                </ul>
                <div class="clear"></div>
                <div class="hy-jg">
                    <b>机构简介：</b><span>
                        <?php echo $model['Introduction']; ?>
                    </span>   
                </div>
            </div>
        </div>
        <div class="float_r hy-con hy-con2">
            <p class="hy-title">联系方式</p>
            <ul>
                <li><b>手 机：</b><span><?php echo $model->Phone; ?></span></li>
                <li><b>邮 箱：</b><span><?php echo $model->Email; ?></span></li>
                <li><b>传 真：</b><span><?php echo $model->Fax; ?></span></li>
                <li><b>qq 号：</b><span><?php echo $model->QQ; ?></span></li>
                <li><div class="float_l w100" ><b>座 机：</b></div>
                    <div class="float_l w220"><span>
                            <?php
                            $tel = array();
                            if ($model->TelPhone) {
                                $tel = explode(',', $model->TelPhone);
                            }
                            $counttel = count($tel) - 1;
                            foreach ($tel as $k => $v) {
                                //$br = $k % 2 == 0 && $k != 0 ? '<br/>' : '';
                                echo $k % 2 == 1 ? $v . '<br/>' : ($counttel != $k ? $v . ',' : $v);
                                //echo $v;
                            }
                            ?>
                        </span></div>
                    <div style="clear:both"></div>
                </li>
                <li><b>地 址：</b><span><?php echo Area::showCity($model['Province']) . Area::showCity($model['City']) . Area::showCity($model['Area']) . $model->Address; ?></span></li>
            </ul>
        </div>
        <div class="clear"></div>
    </div>
    <div class="hy-jsx-zy  hy-con m-top">
        <p class="hy-title">主营信息</p>
        <div class=" line30 padding20">
            <!--            <div class="main-info"><b class="float_l">主营品类：</b>
            <?php
//                foreach ($showcpnames as $key => $val) {
//                    $dh = $key != (count($showcpnames) - 1) ? ',' : '';
//                    echo '<li>' . $val['BigName'] . ' ' . $val['SubName'] . ' ' . $val['CpName'] . $dh . '</li>';
//                }
            ?>
                        </div>-->
            <div class="clear"></div>
            <div class="main-info"><b class="float_l">主营车系：</b>
                <?php
                foreach ($dealerv as $key => $val) {
                    $dh = $key != (count($dealerv) - 1) ? ',' : '';
                    if (empty($val['Car'])) {
                        echo '<li>' . $val['Make'] . ' 全车系' . $dh . '</li>';
                    } elseif (empty($val['Year'])) {
                        echo '<li>' . $val['Make'] . ' ' . $val['Car'] . ' 全年款' . $dh . '</li>';
                    } elseif (empty($val['Model'])) {
                        echo '<li>' . $val['Make'] . ' ' . $val['Car'] . ' ' . $val['Year'] . ' 全车型' . $dh . '</li>';
                    } else {
                        echo '<li>' . $val['Make'] . ' ' . $val['Car'] . ' ' . $val['Year'] . ' ' . $val['Model'] . $dh . '</li>';
                    }
                }
                ?>
            </div>
            <div class="clear"></div>
            <div class="main-info"><b class="float_l">主营品牌：</b>
                <?php
                foreach ($brand as $key => $val) {
                    $dh = $key != (count($brand) - 1) ? ',' : '';
                    echo '<li>' . $val['BrandName'] . $dh . '</li>';
                }
                ?>
            </div>
            <div class="clear"></div>
        </div>
    </div>
    <div class="hy-jxs-info">
        <div class="float_l hy-con hy-con3">
            <p class="hy-title">品牌授权书</p>
            <div class="bmove">
                <div class="licon" style="position:absolute; left:-28px; top:70px; z-index:9; opacity:0.1;"><img src="<?php echo F::themeUrl(); ?>/images/company/lefticon.png"/></div>
                <div class="ricon" style="position:absolute; right:-8px; top:70px; z-index:9;"><img src="<?php echo F::themeUrl(); ?>/images/company/righticon.png" /></div>
                <div class="bmove_sub">
                    <ul>
                        <?php if (!empty($Brandphotos)): ?>
                            <?php foreach ($Brandphotos as $key => $val): ?>
                                <?php if (!empty($val['url1'])): ?>
                                    <li><img src="<?php echo F::uploadUrl() . $val['url1']; ?>" width="200px" height="155px" /></li>
                                    <?php
                                endif;
                                if (!empty($val['url2'])) :
                                    ?>
                                    <li><img src="<?php echo F::uploadUrl() . $val['url2']; ?>" width="200px" height="155px" /></li>
                                <?php endif; ?>
                            <?php endforeach; ?>
                        <?php endif; ?>
<!--                            <li><img src="<?php //echo F::themeUrl();  ?>/images/company/shouqan.png" width="160px" height="124px" /></li>-->
                    </ul>
                </div>
            </div>
        </div>
        <div class="float_r hy-con hy-con4">
            <p class="hy-title">营业执照</p>
            <ul>
                <li><b>注 册 号：</b><span><?php echo $model['Registration']; ?></span></li>
            </ul>
            <div class="ba3_2_p">
                <a class="fl">照片：</a>
                <?php if (!empty($model['BLPoto'])): ?>
                    <img src="<?php echo F::uploadUrl() . $model['BLPoto']; ?>" style="width:180px;height:126px;"/>
                <?php else: ?>
                    <img src="data:image/jpeg;base64,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" style="width:180px;height:126px;"/>
                <?php endif; ?>
            </div>
        </div>
        <div class="clear"></div>
    </div>
</div>
<script type=text/javascript>
    $(document).ready(function() {
        var bm =$('.bmove');
	var ou =$('.bmove_sub').find('ul');
	var liwd =$('.bmove_sub').find('li').width();
	var onum =$('.bmove_sub').find('li').length;
	ou.width((liwd+14)*onum);
	var i=1;
	if(onum-3<0){
		$('.licon').css('display','none')
		$('.ricon').css('display','none')};
	$('.ricon').click(function(){
		if(i<onum-3){
			ou.animate({'left':-(liwd+14)*i})
			i++;
			$('.ricon').css('opacity','1');
			}else if(i=onum-3){
				ou.animate({'left':-(liwd+14)*i})
				i++;
				$('.ricon').css('opacity','0.1')}
		$('.licon').css('opacity','1');
		});
	$('.licon').click(function(){
		if(i>2){
			ou.animate({'left':-(liwd+14)*(i-2)})
			i--;
			$('.licon').css('opacity','1');
			}else if(i=2){
				ou.animate({'left':-(liwd+14)*(i-2)})
				i--;
				$('.licon').css('opacity','0.1')}
		$('.ricon').css('opacity','1');
		});	
                
        $("#spec-list img").bind("mouseover", function() {
            var src = $(this).attr("src");
            $("#spec-n1 img").eq(0).attr({
                src: src.replace("\/n5\/", "\/n1\/"),
                jqimg: src.replace("\/n5\/", "\/n0\/")
            });
            $(this).css({
                "border": "2px solid #ff6600",
                "padding": "1px"
            });
            $(this).parent().siblings("").children().css({"border": "1px solid #ccc",
                "padding": "2px"});
        })
    })
</script>
<script type='text/javascript'>
            (function($) {
                $.fn.jqueryzoom = function(options) {
                    var settings = {
                        xzoom: 200,
                        yzoom: 200,
                        offset: 10,
                        position: "right",
                        lens: 1,
                        preload: 1};
                    if (options) {
                        $.extend(settings, options);
                    }
                    var noalt = '';
                    $(this).hover(function() {
                        var imageLeft = $(this).offset().left;
                        var imageTop = $(this).offset().top;
                        var imageWidth = $(this).children('img').get(0).offsetWidth;
                        var imageHeight = $(this).children('img').get(0).offsetHeight;
                        noalt = $(this).children("img").attr("alt");
                        var bigimage = $(this).children("img").attr("jqimg");
                        $(this).children("img").attr("alt", '');
                        if ($("div.zoomdiv").get().length == 0) {
                            $(this).after("<div class='zoomdiv' style='margin-left:130px'><img class='bigimg' src='" + bigimage + "'/></div>");
                            $(this).append("<div class='jqZoomPup'>&nbsp;</div>");
                        }
                        if (settings.position == "right") {
                            if (imageLeft + imageWidth + settings.offset + settings.xzoom > screen.width) {
                                leftpos = imageLeft - settings.offset - settings.xzoom;
                            } else {
                                leftpos = imageLeft + imageWidth + settings.offset;
                            }
                        } else {
                            leftpos = imageLeft - settings.xzoom - settings.offset;
                            if (leftpos < 0) {
                                leftpos = imageLeft + imageWidth + settings.offset;
                            }
                        }
                        $("div.zoomdiv").css({top: imageTop, left: leftpos});
                        $("div.zoomdiv").width(settings.xzoom);
                        $("div.zoomdiv").height(settings.yzoom);
                        $("div.zoomdiv").show();
                        if (!settings.lens) {
                            $(this).css('cursor', 'crosshair');
                        }
                    }, function() {
                        $(this).children("img").attr("alt", noalt);
                        $(document.body).unbind("mousemove");
                        if (settings.lens) {
                            $("div.jqZoomPup").remove();
                        }
                        $("div.zoomdiv").remove();
                    });
                    count = 0;
                    if (settings.preload) {
                        $('body').append("<div style='display:none;' class='jqPreload" + count + "'>360buy</div>");
                        $(this).each(function() {
                            var imagetopreload = $(this).children("img").attr("jqimg");
                            var content = jQuery('div.jqPreload' + count + '').html();
                            jQuery('div.jqPreload' + count + '').html(content + '<img src=\"' + imagetopreload + '\">');
                        });
                    }
                }
            })(jQuery);
    function MouseEvent(e) {
        this.x = e.pageX;
        this.y = e.pageY;
    }
</script>
