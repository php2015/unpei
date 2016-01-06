<link rel="stylesheet" href="<?php echo Yii::app()->theme->baseUrl ?>/css/pap/fwd.css">
<style>
    /*.zy_prand li a{padding:3px 10px}*/
    .card_img img{*margin-top:-150px}
    .zy_prand li.currentbrand{
        border:1px solid red;
        background: url('<?php echo Yii::app()->theme->baseUrl; ?>/images/papmall/guanbi2.png') no-repeat;
        background-position:right top;
    }
    .jxs_card li{height:240px}
    table{table-layout:fixed;}
    span.more {
        background: url("<?php echo Yii::app()->theme->baseUrl; ?>/images/papmall/tubiao2.png") no-repeat scroll -42px -26px;
        cursor: pointer;
        display: block;
        height: 20px;
        width: 35px;
    }
    span.shouqi {
        background: url("<?php echo Yii::app()->theme->baseUrl; ?>/images/papmall/tubiao2.png") no-repeat scroll -1px -26px;
        cursor: pointer;
        display: block;
        height: 20px;
        width: 35px;
    }
    .pp_info{width:750px}
    .pp_info li,.tab-bd ul li{float:left;width:55px;overflow: hidden;text-overflow: ellipsis;white-space: nowrap;height:20px; line-height:17px; position:relative; border:1px solid #fff;cursor:pointer;margin-left:15px}
    .pp_info li.currentbrand,.tab-bd ul li.currentbrand{
        border:1px solid red;
        background: url('<?php echo Yii::app()->theme->baseUrl; ?>/images/papmall/guanbi2.png') no-repeat;
        background-position:right top;
    }
    .prand_name a{
        font-size: 14px;
        font-weight: bold;
        margin-top: 10px;
    }
    .zm_sx{float:left;width:750px;display:none;border:none}
    .tab-hd{height:22px;border:none}
    .tab-hd .current{height:22px;font-weight: bold;}
    .tab-hd-con{padding:0 7px;line-height:16px;height:22px;border:none}
    .tab-bd{width:750px;padding:10px 0px}
    .zdyfooter{line-height:25px;float:right;margin-right:10px;}
</style>
<?php
$this->pageTitle = Yii::app()->name . ' - 联盟经销商';
$currentbrand = Yii::app()->request->getParam('brand');
$this->breadcrumbs = array(
    '联盟经销商'
);
$url = $get;
?>
<div class="bor_back m-top">
    <p class="txxx">联盟经销商简介</p>
    <div class="txxx_info4">
        <p style="line-height:25px;text-align:left;position:relative;">&nbsp;&nbsp; 本平台所选经销商都是济南各车系优选供货商，库存大，服务意识强，价格有优势；我们希望凭借一流的互联网平台，一流的经销商，各类最具实力的生产商，
            打造国内汽车后市场的第一服务体系，为各类终端修理厂提供数据精准，价格低廉，配送及时，退换货无忧的全新服务模式！</p>
        <div style="clear:both"></div>
    </div>
    <p class="txxx">联盟经销商</p>
    <div class="txxx_info4" id="div_brand">
        <div class="float_l">主营品牌：</div>
        <?php if (!empty($brand) && is_array($brand)): ?>
            <ul class="float_l pp_info" style="display:block">
                <?php
                foreach ($brand['All'] as $k => $v):
                    $get['brand'] = $v;
                    if ($v == $currentbrand) {
                        unset($get['brand']);
                    }
                    if ($k == 40)
                        break;
                    ?>
                    <li <?php echo $v == $currentbrand ? "class='currentbrand'" : ''; ?>>
                        <a title="<?php echo $v; ?>" href="<?php echo Yii::app()->createUrl('/servicer/uniondealer/index', $get) ?>" ><?php echo $v; ?></a>
                    </li>
                <?php endforeach; ?>
            </ul>
            <!-- 隐藏部分首字母筛选-->
            <div id="layout-t" class="zm_sx">
                <h2 class="tab-hd"> 
                    <?php foreach ($brand as $k => $v): ?>
                        <?php if ($k == 'All'): ?>
                            <span class="tab-hd-con current"><a id="all" href="javascript:;" key="<?php echo Yii::app()->createUrl('/servicer/uniondealer/index', $url) ?>">全部品牌</a></span> 
                        <?php elseif ($k == 'Sort'): ?>
                            <?php foreach ($brand['Sort'] as $kk => $vv): ?>
                                <span class="tab-hd-con"><a href="javascript:;"><?php echo $kk ?></a></span> 
                            <?php endforeach; ?>
                        <?php else: ?>
                            <span class="tab-hd-con"><a href="javascript:;">其他</a></span> 
                        <?php endif; ?>
                    <?php endforeach; ?>
                </h2>
                <div class="tab-bd dom-display" style="height:100px ; overflow:auto;position:relative;">
                    <?php foreach ($brand as $k => $v): ?>
                        <?php if ($k == 'All' || $k == 'Else'): ?>
                            <ul class="tab-bd-con" style="<?php echo $k == 'All' ? 'display:block' : ''; ?>"> 
                                <?php
                                foreach ($v as $kk => $vv): $get['brand'] = $vv;
                                    if ($vv == $currentbrand)
                                        unset($get['brand']);
                                    ?>
                                    <li <?php echo $vv == $currentbrand ? "class='currentbrand'" : ''; ?>>
                                        <a href="<?php echo Yii::app()->createUrl('/servicer/uniondealer/index', $get) ?>" title="<?php echo $vv; ?>"><?php echo $vv ?></a>
                                    </li>
                                <?php endforeach; ?>
                            </ul>
                        <?php endif; ?>
                        <?php if ($k == 'Sort'): ?>
                            <?php foreach ($brand['Sort'] as $val): ?>
                                <ul class="tab-bd-con"> 
                                    <?php
                                    foreach ($val as $kk => $vv): $get['brand'] = $vv;
                                        if ($vv == $currentbrand)
                                            unset($get['brand']);
                                        ?>
                                        <li <?php echo $vv == $currentbrand ? "class='currentbrand'" : ''; ?>>
                                            <a href="<?php echo Yii::app()->createUrl('/servicer/uniondealer/index', $get) ?>" title="<?php echo $vv; ?>"><?php echo $vv ?></a>
                                        </li>
                                    <?php endforeach; ?>
                                </ul>
                            <?php endforeach; ?>
                        <?php endif; ?>
                    <?php endforeach; ?>
                </div>
            </div>
            <span class="float_r more"></span>
        <?php else: ?>
            <span class="float_l" style="margin-left:24px;height:24px">暂无相关品牌</span>
        <?php endif; ?>
        <div style="clear:both"></div>
    </div>
</div>
<div class="txxx_info5">
    <div class="jxs_area">
        <div class="float_l">
            <form name="form" id="dealerfm" >
                <span class="m_left20">地区：</span>
                <?php
                $state_data = Area::model()->findAll("Grade=:grade", array(":grade" => 1));
                $state = CHtml::listData($state_data, "ID", "Name");
                $s_default = $province;
                echo CHtml::dropDownList('State', $s_default, $state, array(
                    'empty' => '请选择省',
                    'class' => '  select',
                    'style' => 'width:100px;margin-left:5px',
                    'ajax' => array(
                        'type' => 'GET',
                        'url' => Yii::app()->request->baseUrl . '/common/dynamiccities',
                        'data' => 'js:"province="+jQuery(this).val()',
                        'success' => 'function(data){
                                   $("#City").html(data);
                                   $("<option value=' . '' . '>请选择市</option>").prependTo("#City");
                                   if($("#State").attr("city")!="undefied"){
                                       $("#City").val($("#State").attr("city"));                        
                                   }else{
                                       $("#City option:eq(0)").attr("selected","selected");
                                     }
                        }'
                        ))
                );

                $c_default = $city ? $city : '';
                if ($province) {
                    $city_data = Area::model()->findAll("ParentID=:parent_id", array(":parent_id" => $province));
                    $citylists = CHtml::listData($city_data, "ID", "Name");
                }
                echo CHtml::dropDownList('City', $city, $citylists, array(
                    'empty' => '请选择市',
                    'class' => 'width114 select',
                    'style' => 'width:100px',
                    'ajax' => array(
                        'type' => 'GET',
                        'url' => Yii::app()->request->baseUrl . '/common/dynamicdistrict',
                        'data' => 'js:"city="+jQuery(this).val()',
                        ))
                );
                ?>
                <input type="submit" class="submit" value="查询" id="search">
            </form>
        </div>
        <div class="float_r sp_xianshi">
            <ul>
                <?php if ($type == 1): ?>
                    <li><a href="<?php echo Yii::app()->createUrl('servicer/uniondealer/index', array('type' => 2)) ?>"  class="hp"></a></li>
                    <li><a href="javascript:;"  class="sp sp_current"></a></li>
                <?php else: ?>
                    <li><a class="hp hp_current"></a></li>
                    <li><a href="<?php echo Yii::app()->createUrl('servicer/uniondealer/index', array('type' => 1)) ?>" class="sp"></a></li>
                <?php endif; ?>

            </ul>
        </div>
        <div style="clear:both"></div>   
    </div> 
</div>
<?php if ($type == 2): ?>
    <div class="organ bor_back m-top">
        <?php
        $this->widget('widgets.default.WGridView', array(
            'dataProvider' => $dataProvider,
            'ajaxUpdate' => false,
            'columns' => array(
                array(
                    'name' => '机构名称',
                    'type' => 'raw',
                    'value' => '$data["OrganName"]'
                ),
                array(
                    'name' => '主营品牌',
                    'type' => 'raw',
                    'value' => '$data["brand"]',
                    'htmlOptions' => array('style' => 'white-space:nowrap; overflow: hidden;text-overflow:ellipsis;')
                ),
                array(
                    'name' => '经营车系',
                    'type' => 'raw',
                    'value' => '$data["vehicles"]',
                    'headerHtmlOptions' => array('style' => 'width:200px'),
                ),
                array(
                    'name' => '机构地址',
                    'value' => 'Area::getCity($data["Province"]).Area::getCity($data["City"]).Area::getCity($data["Area"]).$data["Address"]'
                ),
                array(
                    'name' => '手机号码',
                    'value' => ' CHtml::encode($data["Phone"])',
                    'headerHtmlOptions' => array('style' => 'width:60px'),
                ),
                array(
                    'name' => '座机号码',
                    'type' => 'raw',
                    'value' => '$data["TelPhone"]',
                    'htmlOptions' => array('style' => 'word-wrap: break-word; overflow: hidden;text-overflow:ellipsis')
                ),
            )
        ))
        ?>
    </div>
<?php else: ?>   
    <div id="list" class="bor_back">
        <?php $lists = $dataProvider->getData(); ?>
        <ul class="jxs_card">
            <?php foreach ($lists as $v): ?>
                <li>
                    <div class="jxs_card_info">
                        <div class=" img_box card_img"><a target="_blank" href="<?php echo Yii::app()->createUrl('servicer/servicedetail/detail', array('dealer' => $v['ID'])) ?>">
                               <?php if($v['Logo']):?>
                                <img src="<?php echo F::uploadUrl() . $v['Logo']; ?>">
                                <?php else:?>
                                  <img src="<?php echo F::uploadUrl() . 'common/default-goods.png'; ?>">
                                <?php endif;?>
                            </a></div> 
                        <p class="prand_name"><?php echo $v['firstbrand']; ?></p> 
                        <p class="m-top5 jxs_name"><?php echo $v['OrganName']; ?></p>
                        <div style="width:145px;margin-left:20px;margin-top:5px;color:#888">
                            <span>
                                <a target="_blank" href="<?php echo Yii::app()->createUrl('servicer/servicedetail/detail', array('dealer' => $v['ID'])) ?>">公司黄页</a>
                                <span style="padding:0px 3px">|</span><a target="_blank" href="<?php echo Yii::app()->baseUrl;?>/pap/inquiryorder/index">询报价</a>
                            </span>
                        </div>
                        <p class="jxs_tel m-top5">手机：<?php echo $v['Phone']; ?></p> 
                        <div style="height:auto" class="jxs_addr m-top5">
                            <div style="width:145px;margin-left:40px; text-indent:0px;color:#888">地址：<?php echo Area::getCity($v['Province']) . Area::getCity($v['City']) . Area::getCity($v['Area']); ?><br>
                                <span style=""><?php echo $v['Address']; ?></span>
                            </div>
                        </div>  
                    </div>
                </li>
            <?php endforeach; ?>
            <div style="clear:both"></div>
        </ul>
        <div style="clear:both"></div>
        <div class="pager">
            <?php
            $this->widget('widgets.default.WLinkPager', array(
                'footer' => $footer,
                'pages' => $pages,
                'maxButtonCount' => 5, //分页数量
                    )
            );
            ?>
        </div>
    </div>
<?php endif; ?>

<script>
    $(".more").click(function(){
        $(".pp_info").toggle()
        $(".zm_sx").toggle()
        $(this).toggleClass("shouqi");
    });
    
    $(".tab-hd span:first").addClass("current");
    $("#layout-t .tab-bd-con:gt(0)").hide();
    $(".tab-hd span").mouseover(function(){//mouseover 改为 click 将变成点击后才显示，mouseover是滑过就显示
        $(this).addClass("current").siblings("span").removeClass("current");
        $("#layout-t .tab-bd-con:eq("+$(this).index()+")").show().siblings(".tab-bd-con").hide();
    });
     
    //搜索
    $('#search').click(function(){
        var data=new Object;
        data.State=$('#State').val();
        data.City=$('#City').val();
        data.brand='<?php echo $currentbrand; ?>';
        data.type='<?php echo $type; ?>';
        var url=Yii_baseUrl+'/servicer/uniondealer/index';
        $.each(data,function(k,v){
            url+='/'+k+'/'+v;
        })
        window.location.href=url;
        return false;
    })
    
    //品牌点击
    $('#div_brand li').click(function(){
        if($(this).attr('class')=="currentbrand"){
            $(this).removeClass('currentbrand');
        }else{
            $('#div_brand li').removeClass('currentbrand');
            $(this).addClass('currentbrand');
        } 
        var link=$(this).find('a').attr("href");
        window.location.href=link;
    })
    
    //全部品牌
    $('#all').click(function(){
        $('#div_brand .currentbrand').removeClass('currentbrand');
        window.location.href=$(this).attr('key');
        return false;
    })
</script>
