<?php
$this->breadcrumbs=array(
	'Logger'=>array('index'),
	'Logger',
);
?>

<h3>日志信息</h3>

<?php
echo CHtml::beginForm();
?>
<ul class="nav nav-tabs" id="site-logger">
<?php
 
$tabs = array();
$i = 0;
    foreach ($logs as $category => $path):?>
        <li<?php echo !$i?' class="active"':''?>><a href="#<?php echo $category?>" data-toggle="tab"><?php echo ucfirst($category)?></a></li>
    <?php 
    $i ++;
    endforeach;?>
</ul>
<?php 
echo CHtml::dropDownList('line',$line,array(
	'100'=>100,'200'=>200,'300'=>300,'500'=>500,'1000'=>1000,
	));
?>
    <div class="tab-content">
        <?php 
        $i = 0;
        foreach ($logs as $category => $path):?>
            <div class="tab-pane<?php echo !$i?' active':''?>" id="<?php echo $category?>">
                <?php
                $this->renderPartial(
						'_logger',
                        //'_'.$category, 
                        array('path' => $path, 'category' => $category, 'line' => $line)
                    );
                ?>
            </div>
        <?php 
        $i ++;
        endforeach;?>
    </div>
<?php
echo CHtml::submitButton('Refresh', array('class' => 'btn'));
echo CHtml::endForm();