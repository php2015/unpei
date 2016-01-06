<style>
    .button{
        background: none repeat scroll 0 0 #ec8051;
        border: medium none;
        color: #fff;
        font-weight: bold;
        height: 26px;
        line-height: 26px;
        margin-top: 10px;
    }
    .zwq_img img{
        margin-right: 10px
    }
      .a-button{background:#ec8051; height: 26px; line-height:26px; width:85px; text-align: center; display: block; color:#fff; font-size:14px }
</style>
<li>
    <div class="float_l zwq_img">
        <?php if ($data['img']): ?>
            <img src="<?php echo F::uploadUrl() . $data['img'][0]['ImageUrl'] ?>" title="<?php echo $data['Name'] ?>" width="80px" height="80px">
        <?php else: ?>
            <img src="<?php echo F::uploadUrl() . 'common/default-goods.png' ?>" title="<?php echo $data['Name'] ?>" width="80px" height="80px">
        <?php endif; ?>

    </div>
    <div class="float_l zwq_info m_left10" >
        <p class="zwq_name" style="width:355px;height:16px;overflow: hidden;white-space: nowrap;text-overflow: ellipsis;">
            <a class="zwq_name" target="_blank" style="font-weight:bold;font-size:14px" title="<?php echo$data['Name'] ?>" href="<?php echo Yii::app()->createUrl("pap/mall/detail", array('goods' => $data['ID'])) ?>"><?php echo$data['Name'] ?></a></p>
        <p class="m-top5" style="margin-top: 6px">商品编号：<span class="zwq_color spcl" style="color:#ff5500"><?php echo$data['GoodsNO'] ?></span> | 
            <span class="spcl">品牌：<?php echo$data['Brand'] ?></span>
        </p>
        <p class="m-top5" style="margin-top: 6px">
            <span class="spcl">标准名称：<?php echo$data['StandCodeName'] ?></span>
        </p>
        <p class="m-top5" style="color:#ff5500;width:370px;margin-top: 6px;overflow: hidden;white-space: nowrap;text-overflow: ellipsis;">特征说明：<span class="zwq_color spcl" style="color:#ff5500;" title="<?php echo$data['Memo'] ?>"><?php echo$data['Memo'] ?></span></p>
        <p class="m-top5" style="margin-top: 6px">经销商：<span class="zwq_color spcl"><a href="<?php echo Yii::app()->createUrl("servicer/uniondealer/detail", array('dealer' => $data['OrganID'])); ?>"><?php echo$data['OrganName'] ?></a></span></p>
    </div>
    <div class="float_l zwq_price">
        <?php if ($data['IsPro'] == 1): ?>
            <p style="margin-top:10px"><span class="m_left20" ><s>参考价：￥<?php echo sprintf("%.2f", $data['Price']) ?></s></span></p>
            <p style="margin-top:10px"><span class="m_left20" style="color:#ff5500" >促销价：￥<?php echo sprintf("%.2f", $data['ppp']); ?></span></p>
        <?php elseif ($data['ppp'] != $data['Price']): ?>
            <p style="margin-top:10px"><span class="m_left20" ><s>参考价：￥<?php echo sprintf("%.2f", $data['Price']) ?></s></span></p>
            <p style="margin-top:10px"><span class="m_left20" style="color:#ff5500" >折扣价：￥<?php echo sprintf("%.2f", $data['ppp']); ?></span></p>
        <?php else: ?>
            <p style="margin-top:10px"><span class="m_left20">参考价：￥<?php echo sprintf("%.2f", $data['ppp']); ?></span></p>
        <?php endif; ?>
        <p style="margin-top:10px"><span class="m_left20">配件档次：<?php
                $PartsLevel = $data['PartsLevel'];
                echo Yii::app()->getParams()->PartsLevel[$PartsLevel] ? Yii::app()->getParams()->PartsLevel[$PartsLevel] : '暂无';
                ?></span></p>
    </div>
    <!--    <div class="float_l zwq_OE">
            <div class="zwq_top" style="width:215px;height:16px;white-space: nowrap;text-overflow: ellipsis;margin-top:20px">
                <img src="<?php //echo F::themeUrl() . '/images/images/OE_numb.jpg'           ?>">
                <span style="margin-left:5PX;display: inline-block;height: 14px;margin-left: 5px;overflow: hidden;width: 100px;white-space: nowrap;text-overflow: ellipsis;">
                    <a href="javascript::void(0)" title="<?php //echo $data['OENOS']           ?>"><?php echo $data['OENOS'] ?></a>
                </span>
            </div>
             <div class="zwq_top"><img src="shiyong.jpg"></div>
            <div class="zwq_top">别克君威</div>
            
        </div>-->
    <div class="float_r zwq_buttton">
        <a href="<?php echo Yii::app()->createUrl('pap/mall/detail',array('goods'=>$data['ID']));?>" class="a-button" target="_blank">查看详情</a>
        <button class="button addgwc" goodsid="<?php echo $data['ID'] ?>" style='cursor: pointer;width:85px;font-weight:normal'>加入购物车</button>
    </div>
</li>