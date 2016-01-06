<div class='content-row-bnm mt1em'>
    <?php echo CHtml::beginForm(Yii::app()->createUrl('dealer/makequery/empgoods',array('dealer'=>$_GET['dealer'])), 'get'); ?>
    <p class='mt1em'>
        <label class='label label-inline-wa'>商品名称：</label>
        <input class='width168 input' type='text' name="search[name]" value="<?php echo $_GET['search']['name']?>">
        <label class='label label-inline-wa'>配件品类：</label>
        <?php 
					$criteria = new CDbCriteria();
					$criteria->distinct = true;
					$criteria->select = 'system_type';
	                $make_data=  GoodsStandard::model()->findAll($criteria);
	                $system=CHtml::listData($make_data,"system_type","system_type");
	                $system=array_filter($system);
	            ?>
	            
				<?php echo CHtml::dropDownList('search[system_type]',$_GET['search']['system_type'], $system ,array(
						'class'=>'width110 select',
						'empty'=>'请选择系统',
						'ajax' => array(
	                            'type'=>'GET', //request type
	                            'url'=> Yii::app()->request->baseUrl.'/common/getcp_name', //url to call
	                            'update'=>'#search_cp_name', //lector to update
	                            'data'   => 'js:"system_type="+jQuery(this).val()',
	                    )
	            ));?>
	            <?php if($_GET['search']['system_type']){
	            	$cp_data = GoodsStandard::model()->findAll("system_type=:system_type", array(":system_type" => $_GET['search']['system_type']));
	        		$cp_name_data = CHtml::listData($cp_data, "cp_name", "cp_name");
                }?>
                <?php $cpName_data = $_GET['search']['system_type'] ? $cp_name_data : array();?>
			    <?php echo CHtml::dropDownList('search[cp_name]',$_GET['search']['cp_name'], $cpName_data,array(
			    		'class'=>'width110 select',
			    		'empty'=>'请选择品类',
			    ));?>
        <label class='label label-inline-wa' >商品类别：</label>
        <?php echo CHtml::dropDownlist('search[category]',$_GET['search']['category'],CHtml::listData($category,'name','name'),
        		array('class'=>'width118 select','empty'=>'选择分类'))?>
   	  <p class="mt1em">
   	  <label class='label label-inline-wa'>
          &nbsp;&nbsp;&nbsp; OE号：
        </label>
        <input class='width168 input' name="search[oenum]" type="text" value="<?php echo $_GET['search']['oenum']?>">
        <label class='label label-inline-wa'>
         	   商品编号：
        </label>
        <input class='width215 input' name="search[num]" type="text" value="<?php echo $_GET['search']['num']?>"><!--
        <label class='label label-inline-wa'>适用车系：</label>
        --><?php //echo CHtml::dropDownlist('search[car]',$_GET['search']['car'],CHtml::listData($car,'car','car'),
        		//array('class'=>'width88 select','empty'=>'选择车系'))?>
        <input class='submit' type='submit' style="margin-left: 13px;" value='查&nbsp;询'>
        <?php echo CHtml::endForm(); ?>
</div>
