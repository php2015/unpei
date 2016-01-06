<div class="float_l w150 m-height500">
    <?php
    if (!empty($mesmenu) && is_array($mesmenu)):
        $route = Yii::app()->getController()->getRoute();
        ?>
        <p class="left-info <?php echo $route == 'pap/remind/index' ? 'p-current' : '' ?>">
            <a href="<?php echo Yii::app()->createUrl('pap/remind/index') ?>">业务消息</a>
        </p>
        <ul class="info-ul">
            <?php
            if (isset($mesmenu['order']) && !empty($mesmenu['order'])):
                ?>
                <li class="<?php echo $route == 'pap/remind/index' && $_GET['status'] == 1 ? 'li-current' : '' ?>">
                    <a href="<?php echo Yii::app()->createUrl('pap/remind/index', array('status' => 1)) ?>">订单</a>
                </li>
            <?php endif; ?>
            <?php if (Yii::app()->user->isServicer()) : ?>
                <?php
                if (isset($mesmenu['quo']) && !empty($mesmenu['quo'])):
                    ?>
                    <li class="<?php echo $route == 'pap/remind/index' && $_GET['status'] == 2 ? 'li-current' : '' ?>">
                        <a href="<?php echo Yii::app()->createUrl('pap/remind/index', array('status' => 2)) ?>">报价单</a>
                    </li>
                <?php endif ?>
            <?php elseif (Yii::app()->user->isDealer()) : ?>
                <?php
                if (isset($mesmenu['quo']) && !empty($mesmenu['quo'])):
                    ?>
                    <li class="<?php echo $route == 'pap/remind/index' && $_GET['status'] == 2 ? 'li-current' : '' ?>">
                        <a href="<?php echo Yii::app()->createUrl('pap/remind/index', array('status' => 2)) ?>">询价单</a>
                    </li>
                    <?php
                endif;
            endif;
            ?>
            <?php
            if (isset($mesmenu['return']) && !empty($mesmenu['return'])):
                ?>
                <li class="<?php echo $route == 'pap/remind/index' && $_GET['status'] == 3 ? 'li-current' : '' ?>">
                    <a href="<?php echo Yii::app()->createUrl('pap/remind/index', array('status' => 3)) ?>">退货单</a>
                </li>
            <?php endif ?>
        </ul>
        <p class="left-info left-info2 <?php echo $route == 'pap/remind/system' || $route == 'pap/remind/detail' ? 'left-info2-current' : '' ?>">
            <a href="<?php echo Yii::app()->createUrl('pap/remind/system') ?>">系统消息</a>
        </p>
        <ul class="info-ul">
            <li class="<?php echo ($route == 'pap/remind/system' || $route == 'pap/remind/detail') && isset($_GET['type']) && $_GET['type'] == 0 ? 'li-current' : '' ?>">
                <a href="<?php echo Yii::app()->createUrl('pap/remind/system', array('type' => 0)) ?>">系统提醒</a>
            </li>
            <li class="<?php echo ($route == 'pap/remind/system' || $route == 'pap/remind/detail') && $_GET['type'] == 1 ? 'li-current' : '' ?>">
                <a href="<?php echo Yii::app()->createUrl('pap/remind/system', array('type' => 1)) ?>">非法操作</a>
            </li>
            <li class="<?php echo ($route == 'pap/remind/system' || $route == 'pap/remind/detail') && $_GET['type'] == 2 ? 'li-current' : '' ?>">
                <a href="<?php echo Yii::app()->createUrl('pap/remind/system', array('type' => 2)) ?>">服务到期</a>
            </li>
        </ul>
        <p class="left-info left-info3 <?php echo $route == 'pap/remind/remindset' ? 'left-info3-current' : '' ?>">
            <a href="<?php echo Yii::app()->createUrl('pap/remind/remindset') ?>">消息设置</a>
        </p>
        <?php if (Yii::app()->user->isDealer()) : ?>
            <?php
            $currentarr = array('dealer/customer/index', 'dealer/customer/selfquestion', 'dealer/customer/selfquestion',
                'dealer/customer/detail',);
            ?>
            <p class="left-info left-info4 <?php echo in_array($route, $currentarr) ? 'left-info4-current' : '' ?>">
                <a href="<?php echo Yii::app()->createUrl('dealer/customer/index') ?>">我的问题</a>
            </p>
            <ul class="info-ul">
                <li class="<?php echo $route == 'dealer/customer/index' || ($route == 'dealer/customer/detail' && !$_GET['self']) ? 'li-current' : '' ?>">
                    <a href="<?php echo Yii::app()->createUrl('dealer/customer/index') ?>">收到的问题</a>
                </li>
                <li class="<?php echo $route == 'dealer/customer/selfquestion' || ($route == 'dealer/customer/detail' && $_GET['self']) ? 'li-current' : '' ?>">
                    <a href="<?php echo Yii::app()->createUrl('dealer/customer/selfquestion') ?>">提交的问题</a>
                </li>
                <li class="<?php echo $route == 'dealer/customer/submit' ? 'li-current' : '' ?>">
                    <a href="<?php echo Yii::app()->createUrl('dealer/customer/submit') ?>">新建问题</a>
                </li>
            </ul>
        <?php elseif (Yii::app()->user->isServicer()) : ?>
            <?php
            $currentarr = array('servicer/servicequestion/wait', 'servicer/servicequestion/answer', 'servicer/servicequestion/reopen',
                'servicer/servicequestion/newquestion', 'servicer/servicequestion/questiondetail');
            ?>
            <p class="left-info left-info4 <?php echo in_array($route, $currentarr) ? 'left-info4-current' : '' ?>">
                <a href="<?php echo Yii::app()->createUrl('servicer/servicequestion/wait') ?>">我的问题</a>
            </p>
            <ul class="info-ul">
                <li class="<?php echo $route == 'servicer/servicequestion/wait' || ($route == 'servicer/servicequestion/questiondetail' && $_GET['type'] == 'wc') ? 'li-current' : '' ?>">
                    <a href="<?php echo Yii::app()->createUrl('servicer/servicequestion/wait') ?>">已提交问题</a>
                </li>
                <li class="<?php echo $route == 'servicer/servicequestion/answer' || ($route == 'servicer/servicequestion/questiondetail' && $_GET['type'] == 'an') ? 'li-current' : '' ?>">
                    <a href="<?php echo Yii::app()->createUrl('servicer/servicequestion/answer') ?>">已回复问题</a>
                </li>
                <li class="<?php echo $route == 'servicer/servicequestion/reopen' || ($route == 'servicer/servicequestion/questiondetail' && $_GET['type'] == 're') ? 'li-current' : '' ?>">
                    <a href="<?php echo Yii::app()->createUrl('servicer/servicequestion/reopen') ?>">重新打开</a>
                </li>
                <li class="<?php echo $route == 'servicer/servicequestion/newquestion' ? 'li-current' : '' ?>">
                    <a href="<?php echo Yii::app()->createUrl('servicer/servicequestion/newquestion') ?>">新建问题</a>
                </li>
            </ul>
            <?php
        endif;
    endif;
    ?>
</div>