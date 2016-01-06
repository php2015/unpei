<?php if (!empty($inquiryinfo)): ?>
    <div class="bor_back m-top">
        <p class="txxx" id="clickp">询报价详情

            <span id="slide" style="margin-right:20px ;*margin-top:-35px" class="float_r">
                <span class="slide1" id="up"><img src="<?php echo F::themeUrl(); ?>/images/sanjiao2.png"></span>
                <span class="slide2" id="down"><img src="<?php echo F::themeUrl(); ?>/images/daosanjiao2.png"></span>
            </span>
        </p>
        <div id="slidediv" class="m-top20">
            <p  style="margin: 20px 0 0 10px"><b>车型信息</b></p>
            <div class="xlcxx m-top" style="border-bottom: 1px solid #ebebeb;">
                <?php if ($inquiryinfo['VIN']): ?>
                    <div style="margin:20px 0 0 70px;">VIN码定位：　<?php echo CHtml::encode($inquiryinfo['VIN']) ?></div>
                <?php endif; ?>
                <div style="margin:20px 0 0 70px;">适用车系：<?php echo $res['mname'] ? $res['mname'] : '全厂家' ?>&nbsp;<?php echo $res['sname'] ? $res['sname'] : '全车型' ?>&nbsp;<?php echo $res['yname'] ? $res['yname'] : '全年款' ?>&nbsp;<?php echo $res['cname'] ? $res['cname'] : '全车系' ?></div>
                <div style="clear:both"></div>
                <p class=" m-top5"></p>
            </div>
            <?php if ($inquiryinfo['Describe']): ?>
                <p class="m-top20" style="margin: 20px 0 0 10px"><b>采购描述</b></p>
                <div style="width:100%">
                    <ul class="descript_lms"> 
                        <li><div style="word-wrap: break-word;display: block;" id="lms_csss">
                                <?php echo $inquiryinfo['Describe'] ?>
                            </div></li>
                        <div style="clear:both"></div>
                        <p class=" m-top5"></p>
                    </ul>
                </div>
            <?php endif; ?>
            <?php if ($imsgs): ?>
                <div style="margin: 20px 0 0 10px"><b>附件：</b></div>
                <?php $this->renderPartial('/inquiryorder/gellerira', array('imsgs' => $imsgs)) ?>
            <?php endif; ?>
            <div style="clear:both"></div>
            <?php if (!empty($category)): ?>

                <p class="m-top20" style="margin: 20px 0 0 10px"><b>配件信息</b></p>
                <ul class="descript_lms"> 
                    <?php
                    $this->widget('widgets.default.WGridView', array(
                        'id' => 'Inquirylist',
                        'dataProvider' => $category,
                        'emptyText' => '未找到数据',
                        'columns' => array(
                            array(
                                'name' => '大类',
                                'value' => '$data["MainCategory"]'
                            ),
                            array(
                                'name' => '子类',
                                'value' => 'CHtml::encode($data["SubCategory"])'
                            ),
                            array(
                                'name' => '标准名称',
                                'value' => '$data["LeafCategory"]'
                            ),
                            array(
                                'name' => '数量',
                                'type' => 'raw',
                                'value' => '$data["Number"]'
                            ),
                        )
                    ))
                    ?>
                    <div style="clear:both"></div>
                    <p class=" m-top5"></p>
                </ul>
            <?php endif; ?>
            <div style="clear:both"></div>
        </div>
    </div>
<?php endif; ?>
