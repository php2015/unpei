<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->theme->baseUrl; ?>/css/yxgl.css"  />
<?php
$this->breadcrumbs = array(
    '用户中心',
    '技术服务点管理'
);
?>
<!--内容部分-->
<div class="bor_back m_top10">
<p class="txxx txxx3">技术服务点管理
	<span id="add" class="xjd" style="float:right;background-position: 0 -153px;text-indent:25px; line-height:35px"><a href="<?php echo Yii::app()->createUrl('/maker/makecompany/addtechnique'); ?>">添加</a></span>
</p>
<div  style="margin:10px 0px">
    <?php
    $this->widget('widgets.default.WGridView', array(
        'dataProvider' => $dataProvider,
        'columns' => array(
            array(
                'name' => '机构名称',
                'value' => 'CHtml::encode($data->OrganName)'
            ),
            array(
                'name' => '服务项目',
                'value' => 'CHtml::encode($data->ServiceProject)'
            ),
            array(
                'name' => '服务时间',
                'value' => 'CHtml::encode($data->ServiceTime)'
            ),
            array(
                'name' => '服务地区',
                'value' => ' CHtml::encode(Area::getCity($data->ServiceProvince).Area::getCity($data->ServiceCity))'
            ),
            array(
                'name' => '联系方式',
                'value' => '  CHtml::encode($data->Telephone)'
            ),
            array(
                'name' => '机构地址',
                'value' => 'CHtml::encode(Area::getCity($data->AddProvince).Area::getCity($data->AddCity).Area::getCity($data->AddArea).$data->AddStreet)'
            ),
            array(
                'class' => 'CButtonColumn',
                'header' => '操作',
                'template' => '{update}{delete}',
                'buttons' => array(
                    'update' => array(
                        'label' => '修改',
                        'url' => 'Yii::app()->createUrl("/maker/makecompany/addtechnique",array("id"=>$data->ID))'
                    ),
                    'delete' => array(
                        'lable' => '删除',
                        'url' => 'Yii::app()->createUrl("/maker/makecompany/deltechnique",array("id"=>$data->ID))'
                    )
                )
            )
        )
    ))
    ?>
    <!--content1即又半部分结束-->
</div>
