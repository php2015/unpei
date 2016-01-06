<div class="lis-info-list">
    <div class="float_l  m-left15"><input class="checkbox" type="checkbox" name='selectnews' value='<?php echo $data['ID']?>'></div>
    <div class="float_l m-left10 info-list <?php echo $data['HandleStatus'] == 2 ? 'info-list-readed' : '' ?>">
        <a href="<?php echo $data['LinkUrl'] ?>" target="_blank"><span class="info-time"><?php echo date('Y-m-d H:i:s', $data['CreateTime']) ?></span>
<!--            <span class="xlc-name">济南汽车修理厂</span>给您下了一个新订单，订单编号：12333333333，请尽快处理。-->
            <?php echo $data['Content'] ?>
        </a>
        <!--        <div class="jxs-name-info">
                    <p>机构名称：济南汽车修理厂</p>
                    <p>联系电话：13333333333</p>
                    <p>QQ：13333333333</p>
                    <p>邮箱：13333333333</p>
                    <p>地址：洪山区白沙洲大道白沙洲大道</p>
                </div>-->
    </div>
    <div class="clear"></div>
</div>