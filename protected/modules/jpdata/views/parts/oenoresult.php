<style>
    .right-box{width: 160px; border: 1px solid #e1e1e1;float: right; overflow: auto; position:absolute;top:289px;left:586px;background: #fff;}
    .rbox-img{ border-bottom: 1px solid #e1e1e1;}
    .right-box dd{height: 18px; line-height: 18px}
    .rbox-img dl{margin: 5px 0 3px 9px}
    .right-box2 {

    }

</style>
<div >
    <div id="partslist-content" class="checkbox-list">
        <!--    <div class="con_rows_table auto_height ">-->
        <table class="OElist-table" style="cellpadding:0; cellspacing:0;" >
            <thead>
                <tr>
                    <th>厂商</th>
                    <th>车型名称</th>
                    <th>主组名称</th>
                    <th>子组名称</th>
                    <th>零件名称</th>
                    <th>操作</th>
                </tr>   
            </thead>
            <tbody>
                <?php $count = 0; ?>
                <?php foreach ($parts as $element): ?>
                    <?php
                    $count++;
                    if ($count > 50) {
                        break;
                    }
                    ?>
                    <tr>
                        <td><?php echo $element['makeName']; ?></td>
                        <td><?php echo $element['modelName']; ?></td>
                        <td><?php echo $element['mainGroupName']; ?></td>
                        <td>
                            <a href="" class="group-detail" groupid="<?php echo $element['subGroupId']; ?>" modelid="<?php echo $element['modelId'] ?>">
                                <?php echo $element['subGroupName']; ?>
                            </a>
                        </td>
                        <td><?php echo $element['partName']; ?></td>
                        <td class="parts_detail" partid="<?php echo $element['partId'] ?>" modelid="<?php echo $element['modelId'] ?>" hasperm="1">
                            <a href="javascript:void(0);">查看详情</a>
                        </td>
                    </tr>
                    <?php $arr_oeno[] = $element['n_oeno'] ?>
                <?php endforeach; ?>  
            </tbody>
        </table>
        <?php if ($count == 0): ?>
            <div style="margin-top:10px;">
                OE号不存在，无查询结果！
            </div>
        <?php endif; ?>
        <?php if ($count > 50): ?>
            <div style="margin-top:10px;">
                查询结果太多，部分结果未显示，请输入更精确的OE号！
            </div>
        <?php endif; ?>
    </div>
    <?php if (Yii::app()->user->Identity == "servicer"): ?>
        <div class="right-box2"  style="background: none repeat scroll 0 0 #fff;
             border: 1px solid #e1e1e1;
             float: right;
             left: 700px;
             overflow: auto;
             position: absolute;
             top: 0;
             width: 160px;">
             <?php
             //$arr_oeno = $element['oeno']; //'A11-520501-YC';
             if ($arr_oeno) {
                 //   var_dump($arr_oeno);
                 $goods = DealergoodsService::getGoodsByPartsOENO($arr_oeno);
             }
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
</div>




<!--</div>	-->
<script type="text/javascript" src='<?php echo F::themeUrl(); ?>/js/jquery.dataTables.min.js'></script>
<script type="text/javascript">
    $('.OElist-table').dataTable({
        'bPaginate': true, //不显示分页
        "bRetrieve": true,
        'bSort': false, //开关，是否让各列具有按列排序功能
        'bScrollInfinite': false, //开关，以指定是否无限滚动
        'bScrollCollapse': true,
        'iScrollLoadGap': 50, //表格高度50以内不显示滚动条
        // "sScrollY": 300 , //表格高度超过200显示滚动条
        "bFilter": true, //开启搜索功能
        "iDisplayLength": 10, //显示分页条数20
        "oLanguage": {
            "sLengthMenu": "每页显示 _MENU_ 条记录",
            "sZeroRecords": "抱歉， 没有找到",
            "sInfo": "从 _START_ 到 _END_ /共 _TOTAL_ 条数据",
            "sInfoEmpty": "没有数据",
            "sInfoFiltered": "(从 _MAX_ 条数据中检索)",
            "sZeroRecords": "没有检索到数据",
                    "sSearch": "全局搜索:",
            "oPaginate": {
                "sFirst": "首页",
                "sPrevious": "上一页",
                "sNext": "下一页",
                "sLast": "末页"
            }
        },
        'sPaginationType': 'full_numbers'
    });
</script>
