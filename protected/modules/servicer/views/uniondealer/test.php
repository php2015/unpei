<div class='info-li'>
    <div style='width:204px;float:left;text-align:center'>
        <div style='height:80px;'>
            <img src="<?php echo F::uploadUrl() . $data['CarLogo'] ?>" class="img-make"/>
            <span class="span-make"><?php echo $data['name'] ?></span>
        </div>
        <div class='organ-name onm'>
            <a href="<?php echo Yii::app()->createUrl('servicer/uniondealer/detail', array('dealer' => $data['OrganID'])) ?>" title="<?php echo $data['OrganName'] ?>"><?php echo $data['OrganName'] ?>
            </a>
        </div>
        <?php if ($data['Phone']): ?>
            <div style='height:20px;line-height:20px'>手机：<?php echo $data['Phone'] ?></div>
        <?php endif; ?>
    </div>
    <?php
    if ($data['qq']):
        $qq = explode(',', $data['qq']);
        $qqname = explode(',', $data['qqname']);
        ?>
        <ul style='width:70px;float:right' class='qq'>
            <?php
            foreach ($qqname as $k => $v) {
                echo "<li class='subp'>"
                . "<a target='_blank'  href='http://wpa.qq.com/msgrd?v=3&uin=" . $qq[$k] . "&site=qq&menu=yes;' title='点击这里给".$v."发消息'>{$v}</a>"
                . "</li>";
            }
            ?>
        </ul>
    <?php endif; ?>
</div>