<style>
    .remind{color:red}
</style>
<?php
$this->breadcrumbs = array(
    'Menus' => array('admin'),
    'Manage',
);

        $this->menu=array(
	array('label'=>'创建菜单','icon'=>'plus','url'=>array('create')),
	array('label'=>'管理菜单','icon'=>'cog','url'=>array('admin')),
);
?>

<h1>前台菜单列表</h1>

<div class="well-large well">
        <?php
        $this->widget('CTreeView', array(
            'persist' => 'cookie',
            'animated' => 'fast',
            'url' => array('ajaxFillTree'),
            'htmlOptions' => array(
                'id' => 'coverageTree',
                'class' => 'coverageTree'
            )
        ));
        ?>
    </div>
</div>
<script>
    $(".menu_delete").live({
        click:function(){
            var ID = $(this).attr("ID");
            window.location.href="<?php echo Yii::app()->createUrl("frontmenu/delete");?>"+"/id/"+ID;
        }
    })
    
    //叶子菜单鼠标进入事件
    $(document).on("mouseenter","#coverageTree ul li:not([class*='able'])",function(){
        $(this).addClass('remind');
    })
    
    //叶子菜单鼠标离开事件
    $(document).on("mouseleave","#coverageTree ul li.remind",function(){
        $(this).removeClass('remind');
    })
    </script>