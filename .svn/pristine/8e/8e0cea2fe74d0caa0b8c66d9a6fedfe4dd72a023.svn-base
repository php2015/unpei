<div id="parts_details"  style=" position: relative">
    <?php if ($hasPerm !== true) { ?>
        <div>请购买相应的数据服务！</div>
    <?php } else { ?>
        <div style="display:block;float:left;margin-right:10px;width:350px;height:370px;overflow:hidden;">
            <?php if ($part && !empty($part['picture'])) { ?>
                <img class="zoom-img" src="<?php echo $part['picture'] ?>" style='width:350px;height:370px;' alt="配件图片" title="配件图片">
            <?php } else { ?>
                <div style="font-size:16px;text-align:center;line-height:370px;">无配件图片</div>
            <?php } ?>
        </div>
        <div class="arguments" >
            <ul class="all_arg">
                <li> <h4><?php echo $part['name']; ?></h4></li>	
                <li>图号：<?php echo $part['markNo']; ?></li>
                <li>OE号：<?php echo $part['oeno']; ?></li>
                <li>名称：<?php echo $part['name']; ?></li>
                <li>用量：<?php echo $part['amount']; ?></li>
                <li>规格：<?php echo $part['specification']; ?></li>
                <li>起始年：<?php echo $part['beginyear']; ?></li>
                <li>结束年：<?php echo $part['endyear']; ?></li>
                <li>适用车型：<?php echo $part['applicableModel']; ?></li>
                <li>备注：<?php echo $part['note']; ?></li>
                <li>

                    <a style="color: #39af39;" href="javascript:void(0)" onclick="editPart('<?php echo $part['partId']; ?>', '1')">配件信息修正</a>
                </li>
            </ul>
        </div>    
        <?php if (Yii::app()->user->Identity == "servicer"): ?>
            <div class="right-box2" style="  left: 695px; position: absolute;top: 0px;">
                <?php
                $arr_oeno = $part['oeno']; 
                $goods = DealergoodsService::getGoodsByPartsOENO($arr_oeno);
                ?>
                <?php
                if ($goods):
                    foreach ($goods as $goodsv):
                        ?>

                        <div class="rbox-img">
                            <dl>
                                <?php if ($goodsv['ImageUrl']): ?>
                                    <?php if ($goodsv['Identity'] == '3'): ?><!-- 修理厂(商品图片、商品名称)-添加链接，跳转至商品详情页 -->
                                        <dt>
                                        <a class="requirecarmodel" href="<?php echo Yii::app()->createUrl('pap/mall/detail'); ?>/goods/<?php echo $goodsv['ID'] ?> " target="_blank">
                                            <img class="zoom-img" src="<?php echo F::uploadUrl() . $goodsv['ImageUrl']; ?>" style='width:140px;height:150px; border: 1px solid #e1e1e1' onerror="javascript:this.src='<?php echo F::uploadUrl() . 'dealer/default-goods.png'; ?>'">
                                        </a>
                                        </dt>
                                        <dd>
                                            <a class="requirecarmodel" href="<?php echo Yii::app()->createUrl('pap/mall/detail'); ?>/goods/<?php echo $goodsv['ID'] ?>" target="_blank" style="color:green" title="<?php echo $goodsv['Name'] ?>">
                                                <?php
                                                echo mb_substr($goodsv['Name'], 0, 10, 'utf-8');
                                                if (F::getStringLength($goodsv['Name']) > 10):echo"...";
                                                endif;
                                                ?></a>
                                        </dd>


                                    <?php elseif ($goodsv['Identity'] == '2'): ?><!-- 经销商-无图片-无链接 -->
                                        <dt><img class="zoom-img" src="<?php echo F::uploadUrl() . $goodsv['ImageUrl']; ?>" style='width:140px;height:150px; border: 1px solid #e1e1e1'></dt>
                                        <dd><?php
                                            echo '<a title="', $goodsv['Name'], '" style="color:green">', mb_substr($goodsv['Name'], 0, 5, 'utf-8');
                                            if (F::getStringLength($goodsv['Name']) > 5):echo"...";
                                            endif;
                                            ?></dd>
                                    <?php endif; ?>
                                <?php else: ?>
                                        <?php if ($goodsv['Identity'] == '3'): ?>   <!--修理厂 无图片 有链接 -->
                                        <dt><a class="requirecarmodel" href="<?php echo Yii::app()->createUrl('pap/mall/detail'); ?>/goods/<?php echo $goodsv['ID'] ?> " target="_blank"><img class="zoom-img" src="<?php echo F::uploadUrl() . 'dealer/default-goods.png'; ?>" style='width:140px;height:150px; border: 1px solid #e1e1e1'></a></dt>
                                        <dd><a class="requirecarmodel" href="<?php echo Yii::app()->createUrl('pap/mall/detail'); ?>/goods/<?php echo $goodsv['ID'] ?>" target="_blank" style="color:green" title="<?php echo $goodsv['Name'] ?>">
                                                <?php
                                                echo '<a title="', $goodsv['Name'], '"', 'href="', Yii::app()->createUrl('pap/mall/detail', array('goods' => $goodsv['ID'])), '" style="color:green" target="_blank">', mb_substr($goodsv['Name'], 0, 5, 'utf-8');
                                                if (F::getStringLength($goodsv['Name']) > 5):echo"...";
                                                endif;
                                                ?></a>
                                        </dd>
                                    <?php elseif ($goodsv['Identity'] == '2'): ?>
                                        <dt><img class="zoom-img" src="<?php echo F::uploadUrl() . 'dealer/default-goods.png'; ?>" style='width:140px;height:150px; border: 1px solid #e1e1e1'></dt>
                                        <dd><?php
                                            echo '<a title="', $goodsv['Name'], '" style="color:green">', mb_substr($goodsv['Name'], 0, 5, 'utf-8');
                                            if (F::getStringLength($goodsv['Name']) > 5):echo"...";
                                            endif;
                                            ?></dd>
                                    <?php endif; ?>    
                                <?php endif; ?>    
                                <dd><span style="color:#FF7220">￥<?php echo $goodsv['Price'] ?></span></dd>
                                <dd><span style="color:#606060"><?php echo $goodsv['OrganName'] ?></span></dd>
                            </dl>
                        </div>
                        <?php
                    endforeach;
                else :
                    echo '没有商品';
                endif;
                ?>
            </div>
        <?php endif; ?>
    <?php } ?>
</div>

