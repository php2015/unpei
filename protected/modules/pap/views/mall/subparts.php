<div class="content1a">
    <?php foreach ($m as $v): ?>
        <div class="content1a_info">
            <?php
            if ($sub == $v['ID']) {
                $class = "yjlm_current";
                $block = 'display:block';
            } else {
                $class = 'yjlm';
                $block = '';
            }
            ?>
            <a href="<?php echo yii::app()->createUrl('pap/mall/index', array('sub' => $v['ID'])) ?>"><p class="<?php echo $class ?>"><?php echo $v['Name'] ?></p></a>
            <div class="ejlm" style="<?php echo $block ?>">
                <?php if (!empty($v['code']) && is_array($v['code'])): ?>
                    <ul>
                        <?php foreach ($v['code'] as $vv): ?>
                            <li>
                                <a style="<?php echo $code == $vv['Code'] ? 'color:#ec8051' : ''; ?>" href="<?php echo yii::app()->createUrl('pap/mall/index', array('sub' => $v['ID'], 'code' => $vv['Code'])) ?>"><?php echo $vv['Name'] ?>
                                </a>
                            </li>
                        <?php endforeach; ?>
                    </ul>
                <?php endif; ?>
            </div>
        </div>
    <?php endforeach; ?>
</div>