<?php
$this->breadcrumbs=array(
	'Recommend'=>array('index'),
	$model->Name,
);
?>
<?php $this->widget('bootstrap.widgets.TbDetailView',array(
	'data'=>$model,
	'attributes'=>array(
		'ID',
            array(
                'name'=>'姓名',
                'value'=>$model->Name
            ),
            array(
                'name'=>'电话',
                'value'=>$model->MobPhone
            ),
                  array(
                    'name' => '客户类别',
                    'value' => RecommendList::itemAlias("CompanyType",$model->CompanyType),
                ),
            array(
                'name'=>'邮箱',
                'value'=>$model->Email
            ),
             array(
                'name'=>'机构名称',
                'value'=>$model->CompanyName
            ),
            array(
                    'name' => '推荐人',
                    'value' => RecommendList::showOrganname($model->OrganID),
                ),
                 array(
                    'name' => 'Address',
                    'value' => RecommendList::showAddress($model->Province,$model->City,$model->Area),
                ),
	),
)); ?>
