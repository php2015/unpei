<div class="logo-normal float-l"></div>
<div class='top-menu'>
    <?php
    /*
     * 单级菜单
     */
    $cur_url = Yii::app()->request->getUrl();
    $cur_url_arr = explode("/", trim($cur_url, "/"));
    //本地试用调用这个，上传服务器删除
    if($cur_url_arr[0]=="unipei"){
            array_splice($cur_url_arr, 0, 1); 
    }

    
    //以下菜单写死
    if($cur_url_arr[0]=='maker' && in_array($cur_url_arr[1],array('goodscategory','templatemanage'))){        
        $cur_url_arr[1] = 'salesManage';
    }    
    if($cur_url_arr[0]=='mall' &&$cur_url_arr[1] == "quotationbuy" && $cur_url_arr[2] == "index"){
        $cur_url_arr[2] = 'recevice';
    }
// 计算当前菜单与主菜单的关联度，关联度最高的主菜单为当前菜单
    $descendants = $this->getMainMenu();
    $cur_menu_url = "";
    $percent = 0;

    foreach ($descendants as $model) {
        if (empty($model->url)) {
            continue;
        }
        $percent_new = 0;

        $url_arr = explode("/", $model->url);

        $min_len = (count($cur_url_arr) > count($url_arr)) ? count($cur_url_arr) : count($url_arr);
        for ($i = 0; $i < $min_len; $i++) {
            if (strtolower($url_arr[$i]) == strtolower($cur_url_arr[$i])) {
                $percent_new++;
            }
        }
        if ($percent_new > $percent) {
            $cur_menu_url = $model->url;
            $percent = $percent_new;
        }
    }

    $count = 0;
    foreach ($descendants as $model) {
        $htmlOptions = array();
        if ((empty($cur_menu_url) || $cur_menu_url == $model->url) && $count == 0) {
            $htmlOptions = array('class' => 'icon-star active');
        } else if (!empty($cur_menu_url) && $cur_menu_url == $model->url) {
            $htmlOptions = array('class' => 'active');
        }
        $count++;
        echo CHtml::link($model->name, $model->url ? Yii::app()->request->baseUrl . '/' . $model->url : '#', $htmlOptions);
    }

    /*
     * 多级菜单
     */
// foreach ($descendants as $model) {
//     if ($model->getChildCount() > 0) {
//         $items[] = array('label' => F::t($model->name), 'url' => $model->url ? Yii::app()->request->baseUrl . '/' . $model->url : '#',
//             'items' => $model->getChildMenu(),
//             'itemOptions' => array('class' => 'dropdown'), 'submenuOptions' => array('class' => 'dropdown'));
//     } else {
//         $items[] = array('label' => F::t($model->name), 'url' => $model->url ? Yii::app()->request->baseUrl . '/' . $model->url : '#');
//     }
// }
// //print_r($items);
// $this->widget('zii.widgets.CMenu', array(
//     'htmlOptions' => array('class' => 'horizontal unstyled clearfix'),
//     'items' => $items
// ));
    ?>

    <!-- 
    <a href="<?php //echo Yii::app()->createUrl('site/index');  ?>" class="icon-star">网站首页</a>
    <a href="#">嘉配伙伴</a>
    <a href="#">服务订购</a>
    -->
</div>
