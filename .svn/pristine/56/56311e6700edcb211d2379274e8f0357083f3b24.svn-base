<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->theme->baseUrl; ?>/css/yxgl.css"  />

<?php
$this->breadcrumbs = array(
    '营销管理',
    '业务联系人管理'
        )
?>
<div class="yxgl_content1 m_top10">
    <div class="yxgl_content1a">
        <form name="form" action="<?php echo Yii::app()->createUrl('/cim/contact/index') ?>" method='get'>    
            <p>
                <label class="label1">客户姓名：</label>
                <input type="text" class="input"  name='name' value='<?php echo $_GET['name'] ?>'>
                <label class="label1"  >联系电话：</label>
                <input type="text" class="input" style="width:128px" name='phone' value="<?php echo $_GET['phone'] ?>">

                <label class="label1 m_left20" >群组：</label>
                <select class="select" name='group'>
                    <option value ="请选择授权级别">请选择群组</option>
                    <option value ="A">A</option>
                    <option value ="B">B</option>
                    <option value ="C">C</option>
                </select>
                <input type="submit" value="查   询"  class="submit m_left" >
            </p>
        </form>
    </div>
</div>
<div class="yxgl_content2 m-top">
    <ul>
        <li class="yxgl_add">
            <?php 
            echo CHtml::link(CHtml::encode('添加'),Yii::app()->createUrl('cim/contact/add'));
            ?></li>
        <!--                             <li class="yxgl_editor"><a href="">编辑</a></li>
                                     <li class="yxgl_del"><a href="">撤销</a></li>
                                     <li class="yxgl_pldr"><a href="">折扣率设置</a></li>-->
    </ul>
    <div style="clear:both"></div>
</div>
<div class="ddgl_content3 m_top10">
    <?php
    $this->widget('widgets.default.WGridView', array(
        'dataProvider' => $dataProvider,
        'columns' => array(
            array(
                'name' => '#',
                'value' => 'CHtml::encode($data->ID)'
            ),
            array(
                'name' => '机构类型',
                'value' => 'Contacts::item("Identity",$data->organ->Identity)'
            ),
            array(
                'name' => '机构名称',
                'value' => 'CHtml::encode($data->organ->OrganName)'
            ),
            array(
                'name' => '客户姓名',
                'value' => ' CHtml::encode($data->Name)'
            ),
            array(
                'name' => '手机号',
                'value' => ' CHtml::encode($data->Phone)'
            ),
            array(
                'name' => '邮箱',
                'value' => ' CHtml::encode($data->Email)'
            ),
            array(
                'class' => 'CButtonColumn',
                'header' => '操作',
                'template' => '{update}{delete}',
                'buttons' => array(
                    'update' => array(
                        'label' => '修改',
                        'url' => 'Yii::app()->createUrl("/cim/contact/update",array("id"=>$data->ID))'
                    ),
                    'delete' => array(
                        'lable' => '删除',
                    	'click' => "function(){
			         		if(!confirm('确定要删除这条数据吗？')) return false;
			            	$.ajax({
				            	url:$(this).attr('href'),
				                type:'GET',
				             	dataType:'JSON',
				            	success:function(data)
				           		{
				                	alert(data['errorMsg']);
				                	history.go(0); 
				             	}
			             	});
			        		return false;
			       		}",
                        'url' => 'Yii::app()->createUrl("/cim/contact/delete",array("id"=>$data->ID))'
                    )
                )
            )
        )
    ))
    ?>
    <div style="clear:both"></div>
