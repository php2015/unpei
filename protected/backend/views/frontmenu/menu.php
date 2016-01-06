<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

$dataProvider=new CActiveDataProvider('Frontmenu');

$this->widget('zii.widgets.grid.CGridView', array(
    'dataProvider'=>$dataProvider,
));
$this->widget('zii.widgets.jui.CJuiSelectable', array(
    'items'=>array(
        'id1'=>'Item 1',
        'id2'=>'Item 2',
        'id3'=>'Item 3',
    ),
    // additional javascript options for the selectable plugin
    'options'=>array(
        'delay'=>'300',
    ),
));
//$this->widget('zii.widgets.grid.CGridView', array(
//    'dataProvider'=>$dataProvider,
//    'columns'=>array(
//        array(            // display 'create_time' using an expression
//            'name'=>'create_time',
//            'value'=>'date("M j, Y", $data->create_time)',
//        ),
//        array(            // display 'author.username' using an expression
//            'name'=>'authorName',
//            'value'=>'$data->author->username',
//        ),
//        array(            // display a column with "view", "update" and "delete" buttons
//            'class'=>'CButtonColumn',
//        ),
//    ),
//));
?>
