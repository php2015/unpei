<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->theme->baseUrl; ?>/css/yxgl.css"  />
<?php
$this->pageTitle = Yii::app()->name . ' - 金融帐号管理';
if (Yii::app()->user->Identity == "maker") {
    $url = Yii::app()->createUrl("");
} elseif (Yii::app()->user->Identity == "dealer") {
    $url = Yii::app()->createUrl("common/dealmemberlist");
} else {
    $url = Yii::app()->createUrl("common/memberlist");
}
$this->breadcrumbs = array(
    '用户中心' => $url,
    '金融账户管理',
);
?>
<div class="bor_back m_top10">
    <p class="txxx txxx3">金融账户管理</p>
    <p style="height:2px">
        <span id="add" class="xjd" style="display: block;float: right;margin-top: -34px;"><a style="cursor:pointer;">添加</a></span>
    </p>
    <div  style="margin:10px 0px">
    </div>
    <?php
    $this->widget('widgets.default.WGridView', array(
        'dataProvider' => $dataProvider,
        'columns' => array(
            array(
                'name' => '序号',
                'value' => '$this->grid->dataProvider->pagination->currentPage*$this->grid->dataProvider->pagination->pageSize + $row+1',
                'headerHtmlOptions' => array('width' => '40px'),
            ),
            array(
                'name' => '支付宝账户',
                'value' => '$data->PaypalAccount',
            ),
            array(
                'name' => '姓名',
                'value' => '$data->OwnerName',
            ),
            array(
                'name' => '用途',
                'value' => '$data->Uses',
            ),
            array(
                'class' => 'CButtonColumn',
                'header' => '操作',
                'template' => '{update}{delete}',
                'buttons' => array(
                    'update' => array(
                        'label' => '修改',
                        'url' => 'Yii::app()->createUrl("/member/finaccount/editpaypal",array("id"=>$data->ID))'
                    ),
                    'delete' => array(
                        'lable' => '删除',
                        'click' => "function(){
                                        if(check==1){
                                            if(!confirm('确定要删除这条数据吗？')) return false;
                                            $('#dg').dialog('open');
                                            return false;
                                        }			                
			            	$.ajax({
				            url:$(this).attr('href'),
				            type:'GET',
				            dataType:'JSON',
				            success:function(data){
				                    alert(data['errorMsg']);
				                    history.go(0); 
				             	    }
			             	        });
			                return false;
			       		}",
                        'url' => 'Yii::app()->createUrl("/member/finaccount/delpaypal",array("id"=>$data->ID))',
                    )
                ),
            ),
        ),
    ));
    ?>
</div>
<?php $this->renderpartial('code', array('handle' => 'delete','codename'=>'paypal_code')); ?>
<script type="text/javascript">
    var check = 1;
    $(document).ready(function() {
        $("#add").click(function() {
            $.post(
                    Yii_baseUrl + "/member/finaccount/isone/",
                    function(result) {
                        if (result == 0) {
                            location.href = Yii_baseUrl + "/member/finaccount/addpaypal";
                        } else {
                            alert("系统暂时仅支持一个金融账户！");
                            return false;
                        }
                    },
                    'json'
                    );
        });
    })
</script>