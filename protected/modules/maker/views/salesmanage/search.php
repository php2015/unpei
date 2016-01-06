<div class='content-row-bnm mt1em'>
    <?php echo CHtml::beginForm('querygoods', 'get'); ?>
    <p class='mt1em'>
        <label class='label label-inline-wa'>商品名称：</label>
        <input class='width60 input' type='text' name="search[name]" value="<?php echo $_GET['search']['name']?>">
        <label class='label label-inline-wa'>配件品类：</label>
        <?php echo CHtml::dropDownList('search[system_type]',$_GET['search']['system_type'],CHtml::listData($parts,'system_type','system_type'),
	                            array('class'=>'widht110 select','empty'=>'请选择系统',
								'ajax' => array(
	                            'type'=>'GET', //request type
                                 //'url'=>Yii::app()->createUrl('maker/salsemanage/getcpname'),
	                            'url'=> Yii::app()->request->baseUrl.'/common/getcp_name', //url to call
	                            'update'=>'#search_cpname', //selector to update
	                            'data'   => 'js:"system_type="+jQuery(this).val()',
	                            )
 								));
				?>
				<?php 
				$data = GoodsStandard::model()->findAll("system_type=:system_type", array(":system_type" => $_GET['search']['system_type']));
	        	$data = CHtml::listData($data, "cp_name", "cp_name");?>
		  			<?php echo  CHtml::dropDownList('search[cpname]',$_GET['search']['cpname'], $data,
	                            array(
	                            'class'=>'width110 select',
	                            'empty'=>'请选择品类',
	                            ));?>  
        <label class='label label-inline-wa' >商品类别：</label>
        <?php echo CHtml::dropDownlist('search[category]',$_GET['search']['category'],CHtml::listData($category,'name','name'),
        		array('class'=>'width110 select','empty'=>'商品类别'))?>
   	  </p>
      <p class="mt1em">
   	  <label class='label label-inline-wa'>
          &nbsp;&nbsp;&nbsp; OE号：
        </label>
        <input class='width60 input' name="search[oenum]" type="text" value="<?php echo $_GET['search']['oenum']?>">
        <label class='label label-inline-wa'>
         	   商品编号：
        </label>
        <input class='width60 input' name="search[num]" type="text" value="<?php echo $_GET['search']['num']?>">
       
        <!--<label class='label label-inline-wa'>商品品牌：</label>-->
       <?php  //echo CHtml::dropDownlist('search[brand]',$_GET['search']['brand'],CHtml::listData($brand,'name','name'),
        	//	array('class'=>'width88 select','empty'=>'选择品牌'))?>
       <label class='label label-inline-wa'>是否上架：</label>
         <?php echo CHtml::dropDownlist('search[issale]',$_GET['search']['issale'],array('Y'=>'上架','N'=>'下架'),
        		array('class'=>'width70 select','empty'=>'是否上架'))?>
         &nbsp;&nbsp;&nbsp;<span><input class='submit' type='submit' name="submit" value='搜&nbsp;索'></span>
       </p>
<!--        <p class="mt1em">
        &nbsp;&nbsp;&nbsp;<span><input class='submit' type='submit' name="submit" value='搜&nbsp;索'></span>
        </p>-->
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
            var url = Yii_baseUrl+ "/maker/salesmanage/getcar";
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