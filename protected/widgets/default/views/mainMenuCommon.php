<div class="logo-normal float-l"></div>
<div class='top-menu'>
    <?php
    if (!empty($mainMenu)) {
        foreach ($mainMenu as $n => $model) {
            if (!Yii::app()->user->isGuest) {   //登陆后样式
                if ($model['label'] == '首页' || $model['show']) {
                    $htmlOptions = array();
                    if ($model['active']) {
                        $htmlOptions = array('class' => 'active');
                    }
                    echo CHtml::link($model['label'], $model['url'], $htmlOptions);
                }
            }
        }
    }
    ?>
</div>