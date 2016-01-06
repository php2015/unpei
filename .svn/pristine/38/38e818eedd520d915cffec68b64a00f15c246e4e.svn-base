<div class="zwq_splb">
    <ul class="m-top" >
        <li>
            <div class="checkbox_se"><input type="checkbox" id="<?php echo b . $data['ID'] ?>" onclick="checkbox(<?php echo $data['ID'] ?>)"/></div>
            <div class="float_l zwq_img">
                <a href="<?php echo yii::app()->createUrl('pap/Dealergoods/Goodsinfo', array('goods' => $data['ID'], 'status' => 0)) ?>"><img style="width:80px;height: 80px;" src="<?php echo $data['MallImage']; ?>" /></a>
            </div>
            <div class="float_l zwq_chuxiao_info">
                <p class="zwq_name m-top5" style=" width: 270px;height: 16px;white-space: nowrap;overflow: hidden; text-overflow: ellipsis;">
                    <a class="zwq_name" href="<?php echo yii::app()->createUrl('pap/Dealergoods/Goodsinfo', array('goods' => $data['ID'], 'status' => 0)) ?>" titlt="<?php echo $data['Name'] ?>"><?php echo $data['Name'] ?></a>
                </p>
                <div class="m-top5" style=" width: 270px;height: 17px;overflow: hidden">
                    <div class="float_l cut width120">
                        商品编号：<a title="<?php echo $data['GoodsNO'] ?>"><?php echo $data['GoodsNO'] ?></a>
                        <span class="zwq_color"></span>
                    </div>
                    <div class="float_l color_hui"> |</div><div class="float_l cut m_left width120"> <span>品牌：<a title="<?php echo $data['Brand'] ?>"><?php echo $data['Brand'] ?></a></span></div>
                </div>
                <div class="m-top5" style=" width: 270px;height: 17px;overflow: hidden"><div class="float_l cut width120"> 标准名称：<a title="<?php echo DealergoodsService::StandCodegetcpname($data['StandCode'], 'Name'); ?>"><?php echo DealergoodsService::StandCodegetcpname($data['StandCode'], 'Name'); ?></a></div><div class="float_l color_hui">|</div> <div class="float_l cut m_left width120">拼音代码：<a title="<?php echo $data['Pinyin'] ?>"><?php echo $data['Pinyin'] ?></a></div> </div>
                <p class="m-top5" style=" width: 270px;height: 16px;white-space: nowrap;overflow: hidden; text-overflow: ellipsis;">备注：<span><?php echo F::msubstr($data['Memo']) ?></span></p>
            </div>
            <div class="float_l zwq_price">
                <?php if ($data->IsPro) { ?>
                    <p class="m-top">促销价：<span class="zwq_color">￥<?php echo $data['ProPrice'] ?></span></p>
                    <p class="cankaojia">参考价：<span class="zwq_color">￥<?php echo $data['Price'] ?></span></p>
                <?php } else { ?>
                    <p class="m-top">参考价：<span class="zwq_color">￥<?php echo $data['Price'] ?></span></p>
                <?php } ?>
            </div>
            <div class="float_l zwq_OE m_left">
                <div class="zwq_top" style=" width: 200px;height: 16px;white-space: nowrap;overflow: hidden; text-overflow: ellipsis;"><img src="<?php echo F::themeUrl() ?>/images/images/OE_numb.jpg" /><span style="margin-left:5PX"><a title="<?php echo $data['OENOS'] ?>"><?php echo $data['OENOS'] ?></a></span></div>
                <p style="padding-top: 5px">配件档次：
                    <span><?php
                        $PartsLevel = $data['PartsLevel'];
                        echo Yii::app()->getParams()->PartsLevel[$PartsLevel] ? Yii::app()->getParams()->PartsLevel[$PartsLevel] : '暂无'
                        ?></span>
                </p>
            </div>
            <div class="cuxiao float_r cx_cz"  style="line-height:15px">
                <span class="cxsp float_l m-top20">
                    <a href="javascript:void(0)"><span onClick="Loadedit(<?php echo $data['ID']; ?>)">修改</span></a>
                </span>
                <div style="clear:both"></div>
                <div style="position:relative;padding-top:10px; padding: 3px 12px"  onmouseleave="closeinfo(<?php echo $data['ID'] ?>)" class="float_l" >
                    <div class="mouse_div" style="height:20px; line-height:20px;cursor:pointer;border: 1px solid #ebebeb;"><a href="javascript:void(0)"><span onClick="showinfo(<?php echo $data['ID'] ?>)">修改明细</span></a></div>
                    <div class="show-msg" id="follow<?php echo $data['ID'] ?>" style="right:60px">
                    </div>
                </div>



            </div>
        </li>
    </ul>
</div>



