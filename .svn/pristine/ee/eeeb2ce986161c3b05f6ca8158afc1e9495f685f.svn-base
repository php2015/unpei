<div style="margin:15px 10px; border:1px solid #C9D5E3">
    <p class="wlxx_lm">
        <span class="f_weight m_left20" >物流公司：</span><span class="color_blue"><?php echo $data['LogisticsCompany']; ?></span>
    </p>
    <div style="margin:10px 10px  10px 80px">
        <p class="f_weight m-top">运送到</p>
        <ul class="zdiul">
            <?php if ($data): ?>
                <?php foreach ($data['area'] as $v): ?>
                    <li>
                        <?php echo $v['address'] ?>
                    </li>
                <?php endforeach; ?>
            <?php endif; ?>
        </ul>
        <div style="clear:both;"></div>
    </div>
    <p style="margin:20px 20px  5px;word-break:break-all">备注：<span>
            <?php
            if (!empty($data['LogisticsDescription']))
                echo $data['LogisticsDescription'];
            else {
                echo '无';
            }
            ?>
        </span></p>
</div>