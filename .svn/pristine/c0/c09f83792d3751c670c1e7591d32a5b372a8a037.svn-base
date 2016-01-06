<?php
$controlerId = Yii::app()->getController()->id;
$actionId = $this->getAction()->getId();
$active = "class = 'active'";
$this->pageTitle = Yii::app()->name . ' - ' . "收益详情";
$this->breadcrumbs = array(
		'营销管理' => Yii::app()->createUrl('common/marketlist'),
        '联盟营销' => Yii::app()->createUrl('dealer/partner/showrecomincome'),
        '营销收益' => Yii::app()->createUrl('dealer/partner/showrecomincome'),
		'收益详情'
    );
?>
<div class="bor_back m-top">
    <p class="txxx txxx3">收益详情
		<span style=" float:right; margin-right:20px">
		<a id="return" style="font-weight:400" href="<?php echo Yii::app()->createUrl('dealer/partner/showrecomincome');?>">返回</a>
		</span>
</p>
    <div class="bor_back m_top10">
    	<?php
    	
	    $this->widget('widgets.default.WGridView', array(
	        'dataProvider' => $dataProvider,
	        'columns' => array(
	            array(
	                'name' => '订单号',
	                'value' => 'CHtml::encode($data->OrderSN)'
	            ),
	            array(
	                'name' => '订单标题',
	                'value' => 'CHtml::encode($data->OrderName)'
	            ),
	            array(
	                'name' => '经销商名称',
	                'value' => 'CHtml::encode($data->SellerName)'
	            ),
	            array(
	                'name' => '服务厂名称',
	                'value' => 'CHtml::encode($data->BuyerName)'
	            ),
	            array(
	                'name' => '订单总金额',
	                'value' => 'CHtml::encode($data->TotalAmount)'
	            ),
	            array(
	                'name' => '收益',
	                'value' => 'CHtml::encode($data->PayStatus)',
	            ),
	            array(
	                'name' => '收货时间',
	                'value' => 'CHtml::encode(date("Y-m-d",$data->ReceiptTime))'
	            ),
	        )
	    ))
	    ?>
    </div>
</div>