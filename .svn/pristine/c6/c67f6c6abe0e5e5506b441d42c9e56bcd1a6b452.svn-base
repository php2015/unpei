<style>
    .li_div{ background:#f7f7f7; border:1px solid #ebebeb; padding: 10px 20px; position: absolute; top:20px; left:0px; }
   .m_left12{ margin-left: 12px}
   .m_left24{ margin-left: 24px}
   .m-top5{ margin-top:5px}
   .li_div{ display: none; z-index:3}
</style>
<?php
if ($type == 1)
    $currenturl = 'pap/mall/index';
elseif ($type == 2) {
    $currenturl = 'pap/mall/search';
} elseif ($type == 3) {
    $currenturl = 'pap/sellerstore/index';
}
?>
<div class="content2b" >
    <?php if ($type == 1): ?>
        <p class="content2b_lm"><span id='goodspan' code="<?php echo $get['code']; ?>" sub="<?php echo $get['sub']; ?>"><?php echo $choose; ?></span> - 商品筛选</p>
    <?php elseif ($type == 2): ?>
        <p class="content2b_lm"><span id='goodspan' code="<?php echo $get['code']; ?>" sub="<?php echo $get['sub']; ?>"><?php echo $get['keyword'] ? $get['keyword'] : "\"\""; ?></span> - 商品筛选</p>
    <!--        <p class="content2b_lm"><span>所有分类 >></span></p>-->
    <?php elseif ($type == 3): ?>
        <p class="content2b_lm"><span>商品筛选 >></span></p>
    <?php endif; ?>
    <?php
    if ($params['brand'] || $params['price'] || $params['partslevel'] || $params['dealer']['ID']) {
        $display = 'display:block';
    } else
        $display = 'display:none';
    ?>
    <div class="store_jg" style="<?php echo $display; ?>">
        <b class="float_l" brand="<?php echo $params['brand'] ?>" price="<?php echo $params['price']['cond'] ?>" id="sx_cond">已选条件：</b>
        <ul class="float_l">
            <?php
            //品牌筛选
            if ($params['brand']):
                $pp = $get;
                unset($pp['brand']);
                ?>
                <li><span>品牌：</span><b><?php echo $params['brand'] ?></b>
                    <a href="<?php echo Yii::app()->createUrl($currenturl, $pp); ?>"><span class='gb_sx'>
                            <img src="<?php echo Yii::app()->theme->baseUrl; ?>/images/papmall/guanbi2.png"></span></a></li>
            <?php endif; ?>
            <?php
            //经销商筛选
            if ($params['dealer']['OrganName']):
                $jxssx = $get;
                unset($jxssx['dealerid']);
                ?>
                <li><span>经销商：</span><b><?php echo $params['dealer']['OrganName'] ?></b>
                    <a href="<?php echo Yii::app()->createUrl($currenturl, $jxssx); ?>"><span class='gb_sx'>
                            <img src="<?php echo Yii::app()->theme->baseUrl; ?>/images/papmall/guanbi2.png"></span></a></li>
            <?php endif; ?>              
            <?php
            //价格筛选
            if ($params['price']['val'] && $params['price']['text']):
                $jg = $get;
                unset($jg['price']);
                ?>
                <li><span>价格：</span><b><?php echo $params['price']['text'] ?></b>
                    <a href="<?php echo Yii::app()->createUrl($currenturl, $jg); ?>"><span class='gb_sx'>
                            <img src="<?php echo Yii::app()->theme->baseUrl; ?>/images/papmall/guanbi2.png"></span></a></li>
            <?php endif; ?>
            <?php
            //配件档次筛选
            if ($params['partslevel']):
                $pl9 = $get;
                unset($pl9['partslevel']);
                ?>
                <li><span>配件档次：</span><b><?php
                        $PartsLevel = $params['partslevel'];
                        echo Yii::app()->getParams()->PartsLevel[$PartsLevel];
                        ?></b>
                    <a href="<?php echo Yii::app()->createUrl($currenturl, $pl9); ?>"><span class='gb_sx'>
                            <img src="<?php echo Yii::app()->theme->baseUrl; ?>/images/papmall/guanbi2.png"></span></a></li>
            <?php endif; ?>
        </ul>
        <span class="float_r cx_sx">
            <?php
            $cx = $get;
            if($type == 3){
                unset($cx['price'], $cx['brand'], $cx['ispro'], $cx['partslevel']);
            }else{
                unset($cx['price'], $cx['brand'], $cx['ispro'], $cx['partslevel'],$cx['dealerid']);
            }
            
            ?>
            <a href="<?php echo Yii::app()->createUrl($currenturl, $cx); ?>">全部撤销</a></span>
        <div style="clear:both"></div>
    </div>

    <?php if (!$params['brand']): ?>
        <div class="sx_pp" class="">
            <span class="float_l" style="margin-left:24px;height:24px" id="brand_check">品牌：</span>
            <?php if (!empty($brand) && is_array($brand)): ?>
                <div class="float_l pp_info" style="display:block">
                    <ul>
                        <?php
                        foreach ($brand['All'] as $k => $v): $pp2 = $get;
                            $pp2['brand'] = $v;
                            if ($dealerID && $k == 24)
                                break;
                            else if ($k == 20)
                                break;
                            ?>
                            <li><a href="<?php echo Yii::app()->createUrl($currenturl, $pp2) ?>" title="<?php echo $v; ?>"><?php echo $v; ?></a></li>
                        <?php endforeach; ?>
                    </ul>
                </div>
                <!-- 隐藏部分首字母筛选-->
                <div class="float_l zm_sx" style="margin-top:-2px; margin-bottom:5px; display:none">
                    <div class="area-sub">
                        <div id="layout-t" class="tab-product tab-sub-3 ui-style-gradient">
                            <h2 class="tab-hd"> 
                                <?php foreach ($brand as $k => $v): ?>
                                    <?php if ($k == 'All'): ?>
                                        <span class="tab-hd-con current"><a href="javascript:;">全部品牌</a></span> 
                                    <?php elseif ($k == 'Sort'): ?>
                                        <?php foreach ($brand['Sort'] as $kk => $vv): ?>
                                            <span class="tab-hd-con"><a href="javascript:;"><?php echo $kk ?></a></span> 
                                        <?php endforeach; ?>
                                    <?php else: ?>
                                        <span class="tab-hd-con"><a href="javascript:;">其他</a></span> 
                                    <?php endif; ?>
                                <?php endforeach; ?>
                            </h2>
                            <div class="tab-bd dom-display">
                                <?php foreach ($brand as $k => $v): ?>
                                    <?php if ($k == 'All' || $k == 'Else'): ?>
                                        <div class="tab-bd-con <?php if ($k == 'All') echo'current' ?>"> 
                                            <ul class="special">
                                                <?php
                                                foreach ($v as $kk => $vv): $pp3 = $get;
                                                    $pp3['brand'] = $vv
                                                    ?>
                                                    <li><a href="<?php echo Yii::app()->createUrl($currenturl, $pp3) ?>" title="<?php echo $vv; ?>"><?php echo $vv ?></a></li>
                                                <?php endforeach; ?>
                                            </ul>
                                        </div>
                                    <?php endif; ?>
                                    <?php if ($k == 'Sort'): ?>
                                        <?php foreach ($brand['Sort'] as $val): ?>
                                            <div class="tab-bd-con <?php if ($k == 'All') echo'current' ?>"> 
                                                <ul class="special">
                                                    <?php
                                                    foreach ($val as $kk => $vv): $pp3 = $get;
                                                        $pp3['brand'] = $vv
                                                        ?>
                                                        <li><a href="<?php echo Yii::app()->createUrl($currenturl, $pp3) ?>" title="<?php echo $vv; ?>"><?php echo $vv ?></a></li>
                                                    <?php endforeach; ?>
                                                </ul>
                                            </div>
                                        <?php endforeach; ?>
                                    <?php endif; ?>
                                <?php endforeach; ?>
                            </div>
                        </div>
                    </div>
                </div>
                <span class="float_r more" style="font-weight: 400">更多</span>
            <?php else: ?>
                <span class="float_l" style="margin-left:24px;height:24px">暂无相关品牌</span>
            <?php endif; ?>
            <div style="clear:both"></div>
        </div>
    <?php endif; ?>
    
    <?php if (!$params['dealer'] && $type != 3): ?>
        <div class="sx_jg">
            <span class="float_l" style="margin-left:24px">经销商电商水平：</span>
            <ul class="float_l" style="width:600px;">
                <?php
                if(!empty($dealer))
                foreach ($dealer as $k => $v):
                    $jxs=$get;
                    $jxs['dealerid']=$v['ID'];
                    $jxsname=$v['OrganName'];
                    ?>
                <li class="zxq_li" style="width: 250px;position: relative;z-index:<?php echo count($dealer)-$k ?>">
                           <div> 
                               <a href="<?php echo Yii::app()->createUrl($currenturl, $jxs) ?>" style="display:block; overflow: hidden;text-overflow: ellipsis; white-space: nowrap; width:130px; float: left"><?php echo $jxsname ?></a>
                               <p style="width:100px; float: right; margin-left:10px">
                                 <?php $xinxin_html= MallService::showxinxin($v['ID']);
                                    ?>
                                   <?php echo $xinxin_html['avg'].'分';?>
                               </p>
                           </div>
                    <div class="li_div" style="">
                                <p style="text-align:center"><b><?php echo $jxsname ?></b></p>
                                <p style="border-bottom:1px solid #ccc;margin-top:5px "></p>
                                   
                                    <?php  echo $xinxin_html['PartIt'].$xinxin_html['CarRate'].$xinxin_html['GoodsLevel'].$xinxin_html['PriceLevel'];?>

                            </div>
                        </li>
                    
                <?php endforeach; ?>
            </ul>
            <div style="clear:both"></div>
        </div>
    <?php endif; ?>
    <?php if (!$params['partslevel']): ?>
        <div class="sx_jg">
            <span class="float_l" style="margin-left:24px">配件档次：</span>
            <ul class="float_l">
                <?php
                $getpl = Yii::app()->getParams()->PartsLevel;
                foreach ($getpl as $k => $v): $pl5 = $get;
                    $pl5['partslevel'] = $k
                    ?>
                    <li><a href="<?php echo Yii::app()->createUrl($currenturl, $pl5) ?>"><?php echo $v ?></a></li>
                <?php endforeach; ?>
            </ul>
            <div style="clear:both"></div>
        </div>
    <?php endif; ?>
</div>
<script>
$(document).ready(function() {
   $(".zxq_li").mouseover(function(){
       $(this).children(".li_div").css("display","block");
       $(this).siblings().children(".li_div").css("display","none");     
   }).mouseout(function(){
        $(this).children(".li_div").css("display","none");
   }) 
})
</script>