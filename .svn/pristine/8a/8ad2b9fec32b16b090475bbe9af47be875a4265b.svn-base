<div class="content1c" style="height:auto">
    <div class="shop_name" style="border-bottom: 1px solid #ddd;line-height:16px;">
        <div style="float:left;width:70px;text-align: right;margin:5px 0px">卖家：</div>
        <div class="lanse float_l" style="width:140px;margin:5px 0px"><?php echo $seller['OrganName'] ?></div>
        <div style="clear:both"></div>
    </div>
    <p class="shop_pf">综合评分：<span class="shop_zhpf"></span><span class="font">9.7分</span></p>
    <p class="shop_pf">平台管理分值：<span class="font"><?php echo $TotalScore; ?>分</span></p>
    <div class="shop_info">
        <p>评分明细</p>
        <ul>
            <li>商品评分：<span class="sppf"></span></li>
            <li>服务评分：<span class="sppf"></span></li>
            <li>时效评分：<span class="sppf"></span></span></li>
        </ul>
    </div>
    <?php //if ($csinfo): ?>
<!--        <div style="border-bottom:1px  solid #f0f0f0">
            <p style="margin-left:10px;margin-top:10px;">在线客服</p>
            <?php //foreach ($csinfo as $v): ?>
                <p class="shop_kf"><span class="span1"><?php// echo $v['Name'] ?>：</span>
                    <span>
                        <a target="_blank" href="http://wpa.qq.com/msgrd?v=3&amp;uin=<?php// echo $v['QQ'] ?>&amp;site=qq&amp;menu=yes;" title="点击这里给我发消息"><img border="0" SRC=http://wpa.qq.com/pa?p=1:88888888:6 alt="点击这里给我发消息" align="absmiddle"></a>
                    </span>
                </p>
            <?php //endforeach; ?>
        </div>-->
    <?php //endif; ?>
    <?php if ($seller['Phone'] || $seller['TelPhone']): ?>
        <div style="border-bottom:1px  solid #f0f0f0">
            <p style="margin-left:10px;margin-top:10px;">联系方式</p>
            <?php if ($seller['Phone']): ?>
                <p style="margin:8px 0px"><span class="span1">手机：</span>
                    <span><?php echo $seller['Phone']; ?></span>
                </p>
            <?php endif; ?> 
            <?php if ($seller['TelPhone']): ?>
                <div style="margin:8px 0px">
                    <div style="float:left;width:70px;text-align: right;margin:0px 0px">
                        <span class="span1">电话：</span>
                    </div>
                    <ul style="float:left;text-align: left;margin:0px 0px;line-height:18px">
                        <?php
                        $tel = explode(',', $seller['TelPhone']);
                        foreach ($tel as $v):
                            ?>
                            <li><?php echo $v; ?></li>
                        <?php endforeach; ?>
                    </ul>
                    <div style="clear:both"></div>
                </div>
            <?php endif; ?>
        </div>
    <?php endif; ?>
<!--   <a target="_blank" href="http://wpa.qq.com/msgrd?v=3&amp;uin=<?php //echo $seller['QQ']                      ?>&amp;site=qq&amp;menu=yes;"><img border="0" SRC=http://wpa.qq.com/pa?p=1:88888888:6 alt="点击这里给我发消息" align="absmiddle"></a>-->
    <div class="shop_name" style="line-height:16px;">
        <div style="float:left;width:70px;text-align: right;margin:5px 0px">公司名称：</div>
        <div class="lanse float_l" style="width:140px;margin:5px 0px"><?php echo $seller['OrganName'] ?></div>
        <div style="clear:both"></div>
    </div>
    <div class="shop_addr" style="line-height:16px;">
        <div style="float:left;width:70px;text-align: right;margin:5px 0px">所 在 地：</div>
        <div class="lanse float_l" style="width:140px;margin:5px 0px"><?php echo Area::getCity($seller['Province']) . Area::getCity($seller['City']) . Area::getCity($seller['Area']) ?></div>
        <div style="clear:both"></div>
    </div>
</div>