<link rel="stylesheet" href="<?php echo Yii::app()->theme->baseUrl; ?>/css/datatable.css">
<style>
    #parts_table input
    {
        border:1px solid!important;
    }
    #part{ position: relative}
    .right-box2{ position: absolute; left:695px; top:0px}
</style>
<div id="parts_table" class="checkbox-list"  >
    <table  class="partlist-table" style="cellpadding:0; cellspacing:0;table-layout:fixed; ">
        <thead>
            <tr>
                <th style="width:30px">图号</th>
                <th style="width:100px">OE号</th>
                <th style="width:100px">名称</th>
                <th style="width:30px">用量</th>
                <th style="width:50px">操作</th>
            </tr>   
        </thead>
        <tbody> 
            <?php
            $i = 1;
            foreach ($groupParts as $part) {
                ?>
                <tr>
                    <td align="center"><?php echo $part['markNo']; ?></td>
                    <td align="center"><?php echo $part['oeno'] ?></td>
                    <td align="center" style="width:100px; white-space:nowrap; overflow: hidden;text-overflow:ellipsis;"><?php echo '<a title="', $part['name'], '">', $part['name'], '</a>' ?></td>
                    <td align="center"><?php echo $part['amount'] ?></td>
                    <td align="center" class="parts_detail" partid="<?php echo $part['partId'] ?>" modelid="<?php echo $modelId ?>" hasperm="<?php echo ($hasPerm === true) ? '1' : '0'; ?>">
                        <a href="javascript:void(0);">查看详情</a>
                    </td>
                </tr>
                <?php
                // $arr_oeno = array();
                $arr_oeno[] = $part['n_oeno'];
                ?>
                <?php
                $i++;
            }
            ?>
        </tbody>
    </table>
    <div id="page">
        <?php echo $page ?>
    </div>
    <div style="clear:both"></div>

</div>
<?php if (Yii::app()->user->Identity == "servicer"): ?>
    <div class="right-box2" style="  left: 695px; position: absolute;top: -346px;">
        <?php
        // $arr_oeno = $part['oeno']; //'A11-520501-YC';
        //var_dump($arr_oeno);
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
        else:
            echo '没有商品';
        endif;
        ?>
    </div>
<?php endif; ?>
<script type="text/javascript" src='<?php echo F::themeUrl(); ?>/js/jquery.dataTables.min.js'></script>
<script>
    //datatable滚动条显示配件列表

    $('.partlist-table').dataTable({
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
    showScroll();
    function showScroll() {
        $(window).scroll(function() {
            var scrollValue = $(window).scrollTop();
            scrollValue > 100 ? $('div[class=scroll]').fadeIn() : $('div[class=scroll]').fadeOut();
        });

        $('#DataTables_Table_0_last').click(function() {
            $("html,body").animate({scrollTop: 0}, 200);
        });
        $('#DataTables_Table_0_next').click(function() {
            $("html,body").animate({scrollTop: 0}, 200);
        });
    }

</script>