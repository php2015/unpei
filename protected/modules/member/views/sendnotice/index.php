<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->theme->baseUrl; ?>/css/yxgl.css"  />
<?php
$this->pageTitle = Yii::app()->name . ' - 发货公告管理';
if (Yii::app()->user->Identity == "maker") {
    $url = Yii::app()->createUrl("");
} elseif (Yii::app()->user->Identity == "dealer") {
    $url = Yii::app()->createUrl("common/dealmemberlist");
} else {
    $url = Yii::app()->createUrl("common/memberlist");
}
$this->breadcrumbs = array(
    '用户中心' => $url,
    '发货公告管理',
);
?>
<!--<div class="yxgl_content2 m-top">
    <ul>
        <li class="yxgl_add"><a href="<?php //echo Yii::app()->createUrl('/member/finaccount/addpaypal');           ?>">添加</a></li>
    </ul>
    <div style="clear:both"></div>
</div>
--><div class="bor_back m_top10">
    <p class="txxx txxx3">发货公告管理
    <!--	<span id="add" class="xjd" style="float:right;background-position: 0 -153px;text-indent:25px; line-height:35px"><a style="cursor:pointer;">添加</a></span>-->

    </p>
    <?php if (!$dataProvider->getData()): ?>
        <p style="height:2px">
            <span id="add" class="xjd" style="display: block;float: right;margin-top: -34px;"><a href =<?php echo Yii::app()->createUrl("member/sendnotice/add") ?>   style="cursor:pointer;">添加</a></span>
        </p>
    <?php endif; ?>
    <div  style="margin:10px 0px">
    </div>
    <?php
    $this->widget('widgets.default.WGridView', array(
        'dataProvider' => $dataProvider,
        'columns' => array(
            array(// display 'author.username' using an expression
                'name' => '经销商',
                'value' => 'OrderreturnService::idgetorgan($data->OrganID,OrganName)',
            ),
            array(// display 'author.username' using an expression
                'name' => '发货公告',

                'type'=>'html',
                'value' => '$data->Content',             

                'type'=>'html',
                'value' => '$data->Content',

            ),
            
            array(// display 'author.username' using an expression
                'name' =>'发布时间',
                'value' => 'date("Y-m-d H:i:s",MemberService::gettime($data->CreateTime,$data->UpdateTime))',
               
            ),
            array(
                // display a column with "view", "update" and "delete" buttons
                'class' => 'CButtonColumn',
                'header' => '操作',
                'template' => '{update}{delete}',
                'buttons' => array(
                    'update' => array(
                        'label' => '修改',
                        'url' => 'Yii::app()->createUrl("/member/Sendnotice/edit",array("id"=>$data->ID))'
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
				                	location.reload(); 
				             	}
			             	});
			        		return false;
			       		}",
                        'url' => 'Yii::app()->createUrl("/member/Sendnotice/del",array("id"=>$data->ID))',
                    )
                ),
            ),
        ),
    ));
    ?>
</div>
<script>
  var content=$('.odd td:eq(1)').text();
  var contents=content.length>20?content.substring(0,20)+"...":content;
$('.odd td:eq(1)').html("<a href='javascript:void(0)' title="+content+" >"+contents+"</a>");
</script>