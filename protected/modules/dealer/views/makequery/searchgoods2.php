<div class='content-row-bnm mt1em'>
    <?php echo CHtml::beginForm(Yii::app()->createUrl('dealer/makequery/shouqgoods',array('maker_id'=>$_GET['maker_id'])), 'get'); ?>
    <p class='mt1em'>
        <label class='label label-inline-wa'>商品名称：</label>
        <input class='width168 input' type='text' name="search[name]" value="<?php echo $_GET['search']['name']?>">
        <label class='label label-inline-wa'>配件品类：</label>
        <?php $cpnames = GoodsStandard::model()->findAll();
			$cpname = CHtml::listData($cpnames,"system_type","system_type");
			$cpname = array_filter($cpname);
			echo CHtml::dropDownList('search[system_type]',$_GET['search']['system_type'],$cpname,array(
					'class'=>'width118 select',
					'empty'=>'请选择系统',
					'ajax' => array(
                            'type'=>'GET', //request type
                            'url'=> Yii::app()->request->baseUrl.'/common/Getcp_name', //url to call
                            'update'=>'#search_cpname', //lector to update
                            'data'   => 'js:"system_type="+jQuery(this).val()',)
			));
		?>		
		 <?php
		 if($_GET['search']['system_type']){
	            	$cp_data = GoodsStandard::model()->findAll("system_type=:system_type", array(":system_type" => $_GET['search']['system_type']));
	        		$cp_name_data = CHtml::listData($cp_data, "cp_name", "cp_name");
                }
           ?>
            <?php $cpName_data = $_GET['search']['system_type'] ? $cp_name_data : array();?>
		 <?php echo Chtml::dropDownList('search[cpname]',$_GET['search']['cpname'], $cpName_data,array(
		    		'class'=>'width118 select',
		    		'empty'=>'请选择品类',
		    ));?>
<!--        <input class='width168 input' type='text' name="search[cpname]" value="<?php echo $_GET['search']['cpname']?>">-->
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
        <input class='width168 input' name="search[num]" type="text" value="<?php echo $_GET['search']['num']?>"><!--
        <label class='label label-inline-wa'>适用车系：</label>
        --><?php //echo CHtml::dropDownlist('search[car]',$_GET['search']['car'],CHtml::listData($car,'car','car'),
        		//array('class'=>'width88 select','empty'=>'选择车系'))?>
        <input class='submit' type='submit' name="submit" style="margin-left: 13px;" value='查&nbsp;询'>
        <?php //if(!empty($searchs)): ?>
			<?php //echo CHtml::link('清 空',array('/dealer/makequery/shouqgoods/maker_id/'.$_GET['maker_id']),array('class'=>"btn-green btn-green-small",'style'=>'font-size: 14px;'))?>
		<?php //endif;?>
        <?php echo CHtml::endForm(); ?>
</div>
<script type="text/javascript">
    //车系车型联动下拉菜单
    $(document).ready(function(){
        $("#brand").change(function(){
            //传递厂家的参数
            var brand=$('#brand').find('option:selected').text();
            if(brand=='品牌')
            {
                $('#car').html('<option >请选车系</option>');
                return false;
            }
            var url = Yii_baseUrl+ "/dealer/salesmanage/getcar";
            $.ajax({
                url: url,
                type: "POST",
                data: {
                    'brand':brand
                },
                dataType: "json",
                success:function(data){
                    var html = "";
                    for(i=0;i<data.length;i++){
                        html += "<option  >"+data[i]['car']+"</option>"
                    }
                    $('#car').html(html);
                }
            });
            return false;
        });	
    });
</script>