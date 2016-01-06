<?php
/* @var $this HotWordController */
/* @var $model PapHotWord */

$this->breadcrumbs=array(
	'热词库'=>array('index'),
	'Manage',
);

$this->menu=array(
	array('label'=>'热词库列表', 'url'=>array('index')),
	array('label'=>'创建热词', 'url'=>array('create')),
);

//Yii::app()->clientScript->registerScript('search', "
//$('.search-button').click(function(){
//	$('.search-form').toggle();
//	return false;
//});
//$('.search-form form').submit(function(){
//	$('#pap-hot-word-grid').yiiGridView('update', {
//		data: $(this).serialize()
//	});
//	return false;
//});
//");
//?>

<h1>热词库管理</h1>

<!--<p>
You may optionally enter a comparison operator (<b>&lt;</b>, <b>&lt;=</b>, <b>&gt;</b>, <b>&gt;=</b>, <b>&lt;&gt;</b>
or <b>=</b>) at the beginning of each of your search values to specify how the comparison should be done.
</p>-->

<?php // echo CHtml::link('Advanced Search','#',array('class'=>'search-button')); ?>
<div class="search-form" style="display:none">
<?php $this->renderPartial('_search',array(
	'model'=>$model,
)); ?>
</div><!-- search-form -->
<?php
$this->widget('bootstrap.widgets.TbButton', array(
    'id' => 'updateall',
    'label' => '批量更新',
    'type' => 'primary', // null, 'primary', 'info', 'success', 'warning', 'danger' or 'inverse'
    'size' => 'small', // null, 'large', 'small' or 'mini'
        //	'url'=>Yii::app()->createUrl('user/admin/create')
));?>
<?php $this->widget('bootstrap.widgets.TbGridView', array(
	'id'=>'pap-hot-word-grid',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
	'columns'=>array(
		array(
                    'header'=>'ID',
                    'name'=>'ID',
                    'value'=>'$data->ID',
                    'filter' => false,
                ),
		'key',
		'value',
		array(
                  'header'=>'排序',
                  'name'=>'order',
                  'value'=>'$data->order'
                ),
		array(
                    'header'=>'商品数量',
                    'name'=>'num',
                    'value'=>'$data->num',
                    'filter'=>false
                ),
		array(
			'class'=>'bootstrap.widgets.TbButtonColumn',
		),
	),
)); ?>
<script>
    $('#updateall').click(function(){
        var con=confirm('您确定要批量更新热词库?');
        if(con==false){
            return false;
        }
      var url=Yii_baseUrl+'/backend.php/hotword/updatealls';
       $.getJSON(url,{},function(data){
           if(data.success==1){
               alert(data.message);
               location.reload();
           }
       })
    })
</script>