<?php
echo '<select id="SettingsForm_menu_'.$key.'" name="SettingsForm[menu]['.$key.']">';
$menu = CmsCategory::model()->roots()->findAll();
$level = 1;
echo '<option value="0">请选择分类</option>';
foreach ($menu as $n => $m) {
    if ($val) {
        if ($val == $m->ID) {
            $selected = 'selected';
            echo '<option value="' . $m->ID . '" selected="' . $selected . '">' . $m->Name . '</option>';
        } else {
            echo '<option value="' . $m->ID . '">' . $m->Name . '</option>';
        }
    } else {
        echo '<option value="' . $m->ID . '">' . $m->Name . '</option>';
    }

    $children = $m->descendants()->findAll();
    foreach ($children as $child) {
        $string = '&nbsp;&nbsp;';
        $string .= str_repeat('&nbsp;&nbsp;', 2*($child->Level - $level));
        $string .= $child->Name;
        if ($val) {
            if ($val == $child->ID) {
                $selected = 'selected';

                echo '<option value="' . $child->ID . '" selected="' . $selected . '">' . $string . '</option>';
            } else {
                echo '<option value="' . $child->ID . '" >' . $string . '</option>';
            }
        } else {
            echo '<option value="' . $child->ID . '" >' . $string . '</option>';
        }
    }
}
echo '</select>';
?>