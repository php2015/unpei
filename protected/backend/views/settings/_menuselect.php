<?php
//if ($val) {
	//$menu_check = Menu::model()->findByPk($val);
	//$parent = $menu_check->parent()->find();
//}

echo '<select id="SettingsForm_menu_'.$key.'" name="SettingsForm[menu]['.$key.']">';
$menu = Menu::model()->roots()->findAll();
$level = 1;
echo '<option value="0">请选择分类</option>';
foreach ($menu as $n => $m) {
    if ($val) {
        if ($val == $m->id) {
            $selected = 'selected';
            echo '<option value="' . $m->id . '" selected="' . $selected . '">' . $m->name . '</option>';
        } else {
            echo '<option value="' . $m->id . '">' . $m->name . '</option>';
        }
    } else {
        echo '<option value="' . $m->id . '">' . $m->name . '</option>';
    }

    $children = $m->descendants()->findAll();
    foreach ($children as $child) {
        $string = '&nbsp;&nbsp;';
        $string .= str_repeat('&nbsp;&nbsp;', 2*($child->level - $level));
//        if ($child->isLeaf() && !$child->next()->find()) {
//            $string .= '';
//        } else {
//
//            $string .= '';
//        }
        $string .= $child->name;
//		echo $string;
        if ($val) {
            if ($val == $child->id) {
                $selected = 'selected';

                echo '<option value="' . $child->id . '" selected="' . $selected . '">' . $string . '</option>';
            } else {
                echo '<option value="' . $child->id . '" >' . $string . '</option>';
            }
        } else {
            echo '<option value="' . $child->id . '" >' . $string . '</option>';
        }
    }
}
echo '</select>';
?>