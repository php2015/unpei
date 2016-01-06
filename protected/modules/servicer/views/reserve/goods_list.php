<li>
    <div class="float_l zwq_img">
        <img src="<?php echo $data['image'] ?>" title="<?php echo $data['Name'] ?>" width="80px" height="80px">

    </div>
    <div class="float_l zwq_info m_left10" >
    	<input id="goodsid" type="hidden" value="<?php echo $data['ID']?>">
        <p class="zwq_name" style="width:355px;height:16px;overflow: hidden;white-space: nowrap;text-overflow: ellipsis;"><a class="zwq_name"  style="font-weight:bold;font-size:14px" title="<?php echo $data['Name'] ?>" href="<?php echo Yii::app()->createUrl("pap/mall/detail", array('goods' => $data['ID'])) ?>"><?php echo$data['Name'] ?></a></p>
        <p class="m-top5">商品编号：<span class="zwq_color spcl" style="color:#ff5500"><?php echo$data['GoodsNO'] ?></span> | 
            <span class="spcl">品牌：<?php echo$data['BrandName'] ?></span>
        </p>
        <span class="spcl" >标准名称：<?php echo$data['cpname'] ?></span>
        <p class="m-top5" style="color:#ff5500;width:370px; height:15px;overflow: hidden;white-space: nowrap;text-overflow: ellipsis;">特征说明：<span class="zwq_color spcl" style="color:#ff5500;"><?php echo $data['Memo'] ?></span></p>
        <p class="m-top5" >经销商：<span class="zwq_color spcl"><?php echo$data['dealername'] ?></span></p>


    </div>
    <div class="float_l zwq_price">
        <?php if ($data['IsPro'] == 1 && $data['ProPrice'] != $data['Price']): ?>
            <p style="margin-top:10px"><span class="m_left20" ><s>参考价：￥<?php echo sprintf("%.2f", $data['Price']) ?></s></span></p>
            <p style="margin-top:10px"><span class="m_left20 price" style="color:#ff5500" >促销价：￥<?php echo sprintf("%.2f", $data['ppp']); ?></span></p>
        <?php elseif ($data['ppp'] != $data['Price']): ?>
            <p style="margin-top:10px"><span class="m_left20" ><s>参考价：￥<?php echo sprintf("%.2f", $data['Price']) ?></s></span></p>
            <p style="margin-top:10px"><span class="m_left20 price" style="color:#ff5500" >折扣价：￥<?php echo sprintf("%.2f", $data['ppp']); ?></span></p>
        <?php else: ?>
            <p style="margin-top:10px"><span class="m_left20 price">参考价：￥<?php echo sprintf("%.2f", $data['ppp']); ?></span></p>
        <?php endif;
        ?>
        <p style="margin-top:10px"><span id="pjdc" class="m_left20">配件档次：<?php
        $PartsLevel = $data['PartsLevel'];
        echo Yii::app()->getParams()->PartsLevel[$PartsLevel] ? Yii::app()->getParams()->PartsLevel[$PartsLevel] : '暂无';
        ?></span></p>
    </div>
    <div class="float_l zwq_OE">
        <div class="zwq_top" style="width:215px;height:16px;white-space: nowrap;text-overflow: ellipsis;">
            <img src="OE_numb.jpg">
            <span style="margin-left:5PX;display: inline-block;height: 14px;margin-left: 5px;overflow: hidden;width: 100px;white-space: nowrap;text-overflow: ellipsis;">
                <a href="javascript::void(0)" title="<?php echo $data['OENOS'] ?>"><?php echo $data['OENOS'] ?></a>
            </span>
        </div>
<!--         <div class="zwq_top"><img src="shiyong.jpg"></div>
        <div class="zwq_top">别克君威</div>
        -->
    </div>
    <div class="float_r zwq_buttton">
    	<input type="hidden" value="<?php echo $data['StandCode']?>">
        <button class="button addcgd" goodsid="<?php echo $data['ID'] ?>" style='cursor: pointer;font-weight:normal; margin:30px 0px'>采购配件</button>
    </div>
    <div style="clear:both"></div>
</li>