<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->theme->baseUrl ?>/css/newhome/com.css"/>
<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->theme->baseUrl ?>/css/newhome/top.css"/>
<script src="<?php echo Yii::app()->theme->baseUrl . '/js/newhome/style.js' ?>"></script>
<?php
$bignameArr_l = array("事故件", "常用件", "制动、转向及悬挂系统", "车身及附件", "冷热交换系统");
$bignameArr_r = array("发动机", "传动及驱动系统", "排气及排放系统", "燃油供给系统", "电子电器及线束",);
$dcount = count($dealer);
$controller = Yii::app()->controller->id;
$route = Yii::app()->getController()->getRoute();
?>
<style>
    .handinput{color:#000 !important}
    .chosedveh{background:none;color: #0164c1;padding:0}
    .p-bgnone{background:none}
    .cuts {overflow: hidden;text-overflow: ellipsis; white-space: nowrap;}
</style>
<?php $this->widget('widgets.papmall.PrivateChat'); ?>
<!--灰色信息栏-->
<?php if (Yii::app()->user->isServicer()) : ?>
    <div class="site-nav" >
        <div class="site-nav-info">
            <a href="<?php echo Yii::app()->createUrl('pap/home/index'); ?>" title="由你配"><img src="<?php echo Yii::app()->theme->baseUrl ?>/images/shophome/logo.jpg" class="float_l"></a>
            <?php
            //如果是消息中心，添加消息中心logo
            if (in_array($controller, array('remind', 'servicequestion'))):
                ?>
                <img src="<?php echo Yii::app()->theme->baseUrl ?>/images/shophome/xxzx.png" class="float_l logo-xxxz" />
            <?php endif; ?>
            <div class="head-customer float_l">
                <div class="name-customer cuts" title="<?php echo Yii::app()->user->name ?>">
                    您好,<?php echo Yii::app()->user->name ?>
                    <div class="name-customer-info">
                        <ul>
                            <?php
                            if (!empty($permenu) && is_array($permenu)):
                                foreach ($permenu as $key => $val):
                                    foreach ($val['children'] as $k => $v):
                                        ?>
                                        <li><a href="<?php echo!empty($v['url']) ? Yii::app()->createUrl($v['url']) : 'javascript:void(0)' ?>"><?php echo $v['name'] ?></a></li>
                                        <?php
                                    endforeach;
                                endforeach;
                            endif;
                            ?>
                            <li class="layout">
                                <?php echo CHtml::link('退出登录', Yii::app()->createUrl('/user/logout')) ?>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="float_l" style="margin-top:23px; color:#999">|</div>
            <div  class="float_l">
                <ul>
                    <li class="xiaoxi" >
                        <?php $this->widget('widgets.papmall.TopNews'); ?>
                    </li>
                </ul>
            </div>
            <div class="head-gwc float_l" style="*position: relative;*top:0px;z-index: 102;*left:60px">
                <div class="wenz2 float_l">我的购物车</div>
                <a href="<?php echo Yii::app()->createUrl('pap/buyorder/cart') ?>" > 
                    <div class="head-gwc-info  float_l">
                        <span class="amount" style="color:#fff">0</span>
                    </div>
                </a>
            </div>

            <div class="head-help float_r">
                <ul class="float_l">
                    <li class="newpeople">
                        <a href="<?php echo Yii::app()->createUrl('servicer/default/newer/goto/newerindex') ?>" target="_blank">新手指引</a>
                        <span style="color:#0164c1">|</span>
                    </li>
                    <li class="helpcenter">
                        <?php $this->widget('widgets.papmall.MHelpcenter') ?>
                    </li>
                    <li class="helpcontact">

                        <div class="helpcontact"><a href="<?php echo Yii::app()->createUrl('helpcenter/home/index') ?>" target="_blank">在线客服</a></div>
                        <?php $this->widget('widgets.papmall.MPhoneCall') ?>
                    </li>
                </ul>
                <div class="float_r"> <img src="<?php echo F::themeUrl() . '/images/shophome/tel.png' ?>" class="tel-img"/></div>     
                <div class="clear"></div>
            </div>
            <div class="clear"></div>
        </div>
    </div>
    <?php
    //如果是消息中心则不显示头部
    if (!in_array($controller, array('remind', 'servicequestion')) && $route != 'servicer/uniondealer/detail' && $route != 'pap/orderreview/ordergoods'):
        ?>
        <div class="head">
            <div class="com-step1">
                <div class="float_l "><img src="<?php echo Yii::app()->theme->baseUrl ?>/images/shophome/com-step1.jpg"></div>
                <div class="float_l m_left140">
                    <img src="<?php echo Yii::app()->theme->baseUrl ?>/images/shophome/cx-bg.jpg">
                </div>
                <div class="choice-cx float_l">
                    <?php
                    $cookie = Yii::app()->request->getCookies();
                    $car = array('make' => $cookie['mallmake']->value, 'series' => $cookie['mallseries']->value, 'year' => $cookie['mallyear']->value, 'model' => $cookie['mallmodel']->value);
                    if ($car['make']):
                        $str = MallService::getCarmodeltxt($car);
                        ?>
                        <p class="p-choice p-bgnone" id="make-select-mall"  onclick="ajaxLoadings()">
                            <a href="javascript:;" id='veh' class="chosedveh">更换车型</a>
                        </p>
                        <p class="pp-choice p-choiced"><?php echo $str ?></p>
                    <?php else: ?>
                        <p class="p-choice" id="make-select-mall"  onclick="ajaxLoadings()">
                            <a href="javascript:;" id='veh' class="chosedno">选择车型</a>
                        </p>
                        <p class="pp-choice line20">请先选择您的车型，我们将为您提供精准匹配车型的商品！</p>
                    <?php endif; ?>
                    <input type="hidden" id="vechileold" value="<?php echo $str ? $str : ''; ?>">
                    <input type="hidden" id="cookie_mallmake" value="<?php echo $cookie['mallmake']->value; ?>">
                    <input type="hidden" id="cookie_mallseries" value="<?php echo $cookie['mallseries']->value; ?>"> 
                    <input type="hidden" id="cookie_mallyear" value="<?php echo $cookie['mallyear']->value; ?>">
                    <input type="hidden" id="cookie_mallmodel" value="<?php echo $cookie['mallmodel']->value; ?>">
                </div>
                <input type="hidden" id="search_value" value="<?php echo $str; ?>">
                <div class="clear"></div>
            </div>
            <div class="com-step2">
                <div class="float_l"><img src="<?php echo Yii::app()->theme->baseUrl ?>/images/shophome/com-step2.jpg"></div>
                <div class="float_l com-step2-info">
                    <div class="head-search float_l">
                        <p class="line30"><b>方式一</b>：搜索</p>
                        <div class="J_SearchTab">
                            <ul>
                                <li><a>按配件名称</a></li>
                                <li><a>按商品编号</a></li>
                                <li><a>按OE号</a></li>
                                <div class="clear"></div>
                            </ul>
                        </div>
                        <div class="search-bd sousuo">
                            <!--                        <form action="2.html" target="_new"> -->
                            <div class="search-bd-info search-bd-info1 " key='0'>
                                <input maxlength="80" type='text' class="input keyword <?php if ($_GET['seatype'] == '按关键字' && $_GET['keyword'] != '请输入关键字|拼音搜索') echo 'handinput'; ?>" id="tt" value="请输入关键字|拼音搜索" name='search_keyword' style="border:none; margin-left:30px; height:20px; line-height:20px\9;*line-height:20px; padding:3px 3px; outline:none; background:#fff;*padding-top:5px ">
                                <input type="button"  value="查询" class="submit searchsubmit" >
                            </div>
                            <div class="search-bd-info search-bd-info2 " style="display: none" key='1'>
                                <input maxlength="80" type='text'class="input goodsno <?php if ($_GET['seatype'] == '按商品编号' && $_GET['keyword'] != '请输入商品编号搜索') echo 'handinput'; ?>" value="请输入商品编号搜索"  name='search_keyword' style="border:none; margin-left:30px; height:20px; line-height:20px\9;*line-height:20px; padding:3px 3px; outline:none; background:#fff ;*padding-top:5px">
                                <input type="button"  value="查询" class="submit searchsubmit">
                            </div>
                            <div class="search-bd-info search-bd-info3 " style="display: none" key='2'>
                                <input maxlength="80" type='text' class="input oe <?php if ($_GET['seatype'] == '按OE号' && $_GET['keyword'] != '请输入OE号搜索') echo 'handinput'; ?>" value="请输入OE号搜索" name='search_keyword' style="border:none; margin-left:30px; height:20px; line-height:20px\9;*line-height:20px;  padding:3px 3px; outline:none; background:#fff;*padding-top:5px ">
                                <input type="button"  value="查询" class="submit searchsubmit">
                            </div>
                            <input type="hidden" id="cur" value="<?php echo $_GET['seatype'] ? $_GET['seatype'] : '' ?>">
                            <!--</form>-->
                        </div>
                    </div>
                    <p class="example  float_l"><span class="tishi">说明</span></p>
                    <div class="head-nav float_l m_left20" id="default" target="default">
                        <p class="line30 m_left20"><b>方式二</b>：按汽车结构查找</p>
                        <?php if ($this->beginCache('front_homecategory')) : ?>
                            <div class="haed-nav">
                                <div class="head-nav-info" style='*position:relative;*z-index:255'>
                                    <ul>
                                        <?php foreach ($bignameArr_l as $k => $val): ?>
                                            <li class="first">
                                                <a href="javascript:;"><?php echo $val ?> 
                                                    <?php if (in_array($k, array(0, 1))): ?>
                                                        <img src="<?php echo F::themeUrl() . '/images/shophome/hot.png' ?>">
                                                    <?php endif ?>
                                                </a>
                                                <div class="second-nav second-nav9">
                                                    <div class="second-nav-info">
                                                        <div class="float_l hot w420">
                                                            <p>热门配件</p> 
                                                            <div class="hot-info">
                                                                <?php
                                                                if (!empty($MainCategory) && is_array($MainCategory)):
                                                                    foreach ($MainCategory as $key => $cate):
                                                                        ?>
                                                                        <?php if ($cate["Name"] == $val): ?>
                                                                            <?php foreach ($MainCategory[$key]['children'] as $k => $v): ?>
                                                                                <div class="float_l">
                                                                                    <b><?php echo $v['Name'] ?></b>
                                                                                    <ul class="standname">
                                                                                        <?php
                                                                                        $stand = DefaultService::getMainCategorys($v['ID']);
                                                                                        if (is_array($stand)):
                                                                                            foreach ($stand as $sk => $sv):
                                                                                                if (in_array($sk, array(0, 1, 2))):
                                                                                                    ?>
                                                                                                    <li class="overflow"><a href="<?php echo Yii::app()->createUrl('pap/mall/index', array('sub' => $v['ID'], 'code' => $sv['Code'])) ?>" target="_new" title="<?php echo $sv['Name']; ?>"><?php echo $sv['Name']; ?></a></li>
                                                                                                    <?php
                                                                                                endif;
                                                                                            endforeach;
                                                                                            ?>
                                                                                        <?php endif; ?>
                                                                                        <li class="last"><a href="<?php echo Yii::app()->createUrl('pap/mall/index', array('sub' => $v['ID'])) ?>" target="_blank">更多</a></li>
                                                                                    </ul>
                                                                                </div>
                                                                            <?php endforeach; ?>
                                                                            <?php
//                                                            unset($MainCategory[$key]);
//                                                            break;
                                                                            ?>
                                                                        <?php endif; ?>
                                                                        <?php
                                                                    endforeach;
                                                                endif
                                                                ?>
                                                                <div class="clear"></div>
                                                            </div>
                                                        </div>
                                                        <div class="float_r all">
                                                            <p>所有分类</p>
                                                            <ul>
                                                                <?php
                                                                if (!empty($MainCategory) && is_array($MainCategory)):
                                                                    foreach ($MainCategory as $key => $cate):
                                                                        ?>
                                                                        <?php if ($cate["Name"] == $val): ?>
                                                                            <?php foreach ($MainCategory[$key]['children'] as $k => $v): ?>
                                                                                <li><a href="<?php echo Yii::app()->createUrl('pap/mall/index', array('sub' => $v['ID'])) ?>" target='_blank' title='<?php echo $v['Name'] ?>'><?php echo $v['Name'] ?></a></li>
                                                                                <?php
                                                                            endforeach;
                                                                        endif;
                                                                    endforeach;
                                                                endif;
                                                                ?>
                                                            </ul>
                                                        </div>
                                                        <div class="clear"></div>
                                                    </div>
                                                    <div class="clear"></div>
                                                </div>
                                            </li>
                                        <?php endforeach; ?>
                                    </ul>
                                </div>
                                <div class="head-nav-info" style='*position:relative;*z-index:252'>
                                    <ul>
                                        <?php foreach ($bignameArr_r as $k => $val): ?>
                                            <li class="first">
                                                <a href="javascript:;"><?php echo $val ?></a>
                                                <div class="second-nav second-nav9">
                                                    <div class="second-nav-info">
                                                        <div class="float_l hot w420">
                                                            <p>热门配件</p> 
                                                            <div class="hot-info">
                                                                <?php
                                                                if (!empty($MainCategory) && is_array($MainCategory)):
                                                                    foreach ($MainCategory as $key => $cate):
                                                                        ?>
                                                                        <?php if ($cate["Name"] == $val): ?>
                                                                            <?php foreach ($MainCategory[$key]['children'] as $k => $v): ?>
                                                                                <div class="float_l">
                                                                                    <b class='overflow'><?php echo $v['Name'] ?></b>
                                                                                    <ul class="standname">
                                                                                        <?php
                                                                                        $stand = DefaultService::getMainCategorys($v['ID']);
                                                                                        if (is_array($stand)):
                                                                                            foreach ($stand as $sk => $sv):
                                                                                                if (in_array($sk, array(0, 1, 2))):
                                                                                                    ?>
                                                                                                    <li class='overflow'><a href="<?php echo Yii::app()->createUrl('pap/mall/index', array('sub' => $v['ID'], 'code' => $sv['Code'])) ?>" target="_new" title='<?php echo $sv['Name'] ?>'><?php echo $sv['Name'] ?></a></li>
                                                                                                    <?php
                                                                                                endif;
                                                                                            endforeach;
                                                                                            ?>
                                                                                        <?php endif; ?>
                                                                                        <li class="last"><a href="<?php echo Yii::app()->createUrl('pap/mall/index', array('sub' => $v['ID'])) ?>" targe='_blank'>更多</a></li>
                                                                                    </ul>
                                                                                </div>
                                                                            <?php endforeach; ?>
                                                                            <?php
//                                                            unset($MainCategory[$key]);
//                                                            break;
                                                                            ?>
                                                                        <?php endif; ?>
                                                                        <?php
                                                                    endforeach;
                                                                endif;
                                                                ?>
                                                                <div class="clear"></div>
                                                            </div>
                                                        </div>
                                                        <div class="float_r all">
                                                            <p>所有分类</p>
                                                            <ul>
                                                                <?php
                                                                if (!empty($MainCategory) && is_array($MainCategory)):
                                                                    foreach ($MainCategory as $key => $cate):
                                                                        ?>
                                                                        <?php if ($cate["Name"] == $val): ?>
                                                                            <?php foreach ($MainCategory[$key]['children'] as $k => $v): ?>
                                                                                <li class='overflow'><a href="<?php echo Yii::app()->createUrl('pap/mall/index', array('sub' => $v['ID'])) ?>" target='_blank' title='<?php echo $v['Name'] ?>'><?php echo $v['Name'] ?></a></li>
                                                                                <?php
                                                                            endforeach;
                                                                        endif;
                                                                    endforeach;
                                                                endif;
                                                                ?>
                                                            </ul>
                                                        </div>
                                                        <div class="clear"></div>
                                                    </div>
                                                </div>
                                            </li>
                                        <?php endforeach; ?>   
                                        <div class="clear"></div>
                                    </ul>
                                </div>
                            </div>   
                            <?php $this->endCache(); ?>
                        <?php endif; ?> 
                    </div>
                    <div class="promtion" >
                        <table class="table" cellpadding="1" cellspacing="0" style="padding:5px">
                            <thead><tr class="table-hd"><td width="150px">搜索类型</td><td width="300px" style="border-right:none">输入</td></tr></thead>
                            <tbody>
                                <tr><td>配件名称</td><td style="border-right:none">散热器或水箱</td></tr>
                                <tr><td>配件名称拼音首字母</td><td style="border-right:none">srq或sx</td></tr>
                                <tr><td>配件名称全拼</td><td style="border-right:none">sanreqi或shuixiang或suixiang</td></tr>
                                <tr><td>OE号</td><td style="border-right:none">S21-8107310</td></tr>
                                <tr><td>商品编号</td><td style="border-right:none">S21-8107310-KY</td></tr>
                                <tr><td>商品编号+品牌</td><td style="border-right:none">S21-8107310-KY 科越</td></tr>
                                <tr><td>配件名称+品牌</td><td style="border-right:none">散热器 科越或sanreqi 科越或srq 科越或shuixiang 科越或suixiang 科越或sx 科越</td></tr>
                            </tbody>
                        </table>
                    </div>
                    <div class="clear"></div>
                </div>
                <div class="clear"></div>
            </div>
            <div class="clear"></div>
            <div class="com-zk">隐藏</div>
        </div>
        <?php
    endif;
endif;
?>
<?php
//经销商商品预览页面
include('dealertop.php');
?>

<?php
$head_arr = array('pap/home/index', 'pap/home/hot');
if (in_array($route, $head_arr)):
    ?>
    <div class="text-nav">
        <div class="text-nav-info">
            <div class="float_l index-nav" style="width:109px">
                <a href="<?php echo Yii::app()->createUrl('/pap/home/index') ?>">首页</a>
            </div>
            <ul class="float_l text-nav-ul">
                <li class="sj" style=" width: 60px"><a href="<?php echo Yii::app()->createUrl('/pap/home/hot') ?>">每日促销</a></li>           
                <div class="clear"></div>
            </ul>
            <div class="clear"></div>
        </div>   
        <div class="clear"></div>
    </div>
<?php endif ?>
<!--<div class="xian" style="display:none"></div>-->
<!--加载车型弹框-->
<?php $this->widget('widgets.papmall.MCarModel', array('mallSearch' => $_GET['sub'] || $_GET['id'] ? true : '')); ?>
<script src="<?php echo Yii::app()->theme->baseUrl . '/js/pap/jquery.bigautocomplete.js' ?>"></script>
<script>
<?php
$xian_arr = array('home', 'mall', 'buyorder', 'sellerstore', 'servicedetail', 'remind', 'servicequestion');
if (in_array($controller, $xian_arr) || $route == 'servicer/uniondealer/detail' || $route == 'pap/orderreview/ordergoods'):
    ?>
                                $('.xian').show();
<?php else: ?>
                                $('.xian').hide();
<?php endif ?>
                            //遮盖
                            function ajaxLoading() {
                                var height = $("body").height();
                                $("<div class=\"datagrid-mask\"></div>").css({display: "block", width: "100%", height: height}).appendTo(".wrapper");

                            }
                            function ajaxLoadEnd() {
                                $(".datagrid-mask").remove();

                            }
                            //遮盖
                            function ajaxLoadings() {
                                var height = $("body").height();
                                $("<div class=\"datagrid-masks\"></div>").css({display: "block", width: "100%", height: height}).appendTo(".wrapper");
                            }
                            function ajaxLoadEnds() {
                                $(".datagrid-masks").remove();

                            }
                            //联想功能
</script>
<script>
    var checkcode = 0;//是否需要输入验证码,0不需要1需要
    $(function() {
        //车型必选
        $('.modelrequired').click(function() {
            var carmodel = $('#veh').text().replace(/^\s+|\s+$/g, "");
            if (carmodel != '更换车型') {
                //alert('请先选择适用车型');
                $('#make-select-mall').trigger('click');
                return false;
            } else {
                var openurl = 1;
                if (typeof ($(this).attr("dealer")) != "undefined") {
                    openurl = 0;
                    var url = Yii_baseUrl + '/pap/mall/dealer';
                    $.ajax({
                        url: url,
                        type: 'POST',
                        async: false,
                        dataType: 'json',
                        data: {'dealerid': $(this).attr('dealer')},
                        success: function(res) {
                            if (res.res == 0) {
                                alert('您已选车型不在此经销商主营车系范围内,请重新选择!');
                                return false;
                            } else {
                                openurl = 1;
                            }
                        }
                    })
                }
                if (openurl == 1) {
                    checktime($(this).attr('href'), '_blank');
                    if (checkcode == 1)
                        return false;
                    window.open($(this).attr('href'));
                }
                return false;
            }
        })
    })

    //验证查询次数
    function checktime(url, target) {
        return;
        $('#url').val(url);
        $('#url').attr('tar', target);
        $.ajax({
            url: Yii_baseUrl + "/pap/home/check",
            type: "POST",
            async: false,
            dataType: "json",
            success: function(res) {
                if (res.res == 0) {
                    //输入验证码后才能继续查询
                    checkcode = 1;
                    $('#checkcode').find('[name="code"]').val('');
                    $('#codewarning').hide();
                    $('#checkcode').find('a').trigger('click');  //更换验证码
                    $('#dialogdiv').show();
                    $("#checkcode").dialog("open");
                } else {
                    //可以继续查询
                    checkcode = 0;
                }
            }
        });
    }
</script>
<script>
    //点击子类判断是否选择了车型
    $('.second-nav ').click(function() {
        var veh = $('#veh').text();
        if (veh == '选择车型') {
            $('#make-select-mall').trigger('click');
            return false;
        }
    });
    //联想功能
    $("#tt").bigAutocomplete({
        width: 289,
        url: Yii_baseUrl + '/pap/mall/hotword/'
    });
    $("#bigAutocompleteContent").delegate("tr", "click", function() {
        $('.search-bd-info1').find('.searchsubmit').trigger('click');
    });


    //判断商品编号输入位数
    $('.search-bd-info2 ').find('.searchsubmit').click(function() {
        var keyword = $('.search-bd-info2').find('input[type=text]').val();
        var regex = /^[\da-z-\/ A-Z]{3,20}$/;
        if (!regex.test(keyword)) {
            alert('商品编号请输入3-20位(含字母数字-/非中文字符)');
            return false;
        } else {
            $('.search-bd-info1').find('.searchsubmit').trigger('click');
        }
    });
    //判断OE号输入位数
    $('.search-bd-info3 ').find('.searchsubmit').click(function() {
        var keyword = $('.search-bd-info3').find('input[type=text]').val();
        var regex = /^[\da-z-\/ A-Z]{5,20}$/;
        if (!regex.test(keyword)) {
            alert('OE号请输入5-20位(含字母数字-/非中文字符))');
            return false;
        } else {
            $('.search-bd-info1').find('.searchsubmit').trigger('click');
        }
    });
    //点击搜索按钮
    $('.search-bd-info1').find('.searchsubmit').click(function() {
        var carmodel = $('#veh').text().replace(/^\s+|\s+$/g, "");
        if (carmodel != '更换车型') {
            $('#make-select-mall').trigger('click');
            return false;
        }
        var data = {};
        var key = $.trim($('.sousuo').find('.active').find('input:first-child').val());
        if ((key != '请输入关键字|拼音搜索' && key != '请输入商品编号搜索' && key != '请输入OE号搜索') && key != '')
        {
            data.keyword = key;
            data.keyword = data.keyword.replace(/\//g, "<<q>>");
            data.keyword = data.keyword.replace(/\\/g, "<<p>>");
            data.keyword = encodeURIComponent(data.keyword);
            data.seatype = $('.sousuo').find('.active').attr('key');
            if (data.seatype == 0) {
                data.seatype = '按关键字';
            } else if (data.seatype == 1) {
                data.seatype = '按商品编号';
            }
            else if (data.seatype == 2) {
                data.seatype = '按OE号';
            }
        }
        else {
            alert('请输入查询内容！');
            return false;
        }
        var url = Yii_baseUrl + '/pap/mall/search';
        $.each(data, function(k, v) {

            if (v != '') {
                url += '/' + k + '/' + v;
            }
        });
        if ($('#defaults').attr('target') == 'search') {
            window.open(url, '_self');
        }
        else {
            window.open(url, "_blank");
        }
    });

    $(function() {
        if ($(".amount").length > 0) {
            getCartCount();
        }
    });
    //购物车数量
    function getCartCount() {
        $.getJSON("<?php echo Yii::app()->createUrl("pap/buyorder/getcount") ?>", function(data) {
            $(".amount").text(data);
        })
    }
    function saveVechile(data, select) {
        var key = $.trim($('.sousuo').find('.active').find('input:first-child').val());
        var controller = '<?php
if (in_array($controller, array('mall', 'sellerstore'))) {
    echo '1';
}
?>';
        $.ajax({
            url: Yii_baseUrl + '/pap/mall/setcarmodel',
            type: 'POST',
            data: {
                make: data.makeid,
                series: data.seriesid,
                year: data.yearid,
                model: data.modelid
            },
            dataType: 'json',
            success: function() {
                $("#make-select-mall").change();
                if (controller == '1') {
                    location.reload();
                }
                //$('#vechileold').val($("#make-select-mall").html());
                changeChose(select);
                closeChose();
            }
        });
    }
    function issale(goodsid) {
        $.getJSON(Yii_baseUrl + '/pap/mall/issale',
                {goodsid: goodsid},
        function(data) {
            //getCartCount();
            if (data) {
                alert(data.message);
                return false;
            }
        });
    }

    function changeChose(select) {
        $('.p-choice').addClass('p-bgnone');
        $('#veh').removeClass('chosedno').addClass('chosedveh').text('更换车型');
        $('.pp-choice').removeClass('line20').addClass('p-choiced');
        if (select == 'year') {
            var vihcle = $("#selectcar").attr('makename') + ' ' + $("#selectcar").attr('seriesname') + ' ' + '不确定年款';
        } else if (select == 'model') {
            var vihcle = $("#selectyear").attr('makename') + ' ' + $("#selectyear").attr('seriesname') + ' ' + $("#selectyear").attr('yearid') + '款' + ' ' + $("#selectyear").attr('modelname');
        }
        $('.pp-choice').text(vihcle);
    }
</script>