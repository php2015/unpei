<?php
	$this->pageTitle = Yii::app()->name . ' - ' . "商品管理";
?>
<!-- 商品信息列表 菜单 {-->
<?php $this->renderPartial('tab'); ?>
<!-- } -->
<div class='tab-content auto_height'>
    <!-- search菜单{ -->
    <?php $this->renderPartial('search', array('brand' => $brand,'category'=>$category,'car'=>$car,'parts'=>$parts)); ?>
    <!-- } -->
</div>
<div class="checkbox-list">
    <!-- content{ -->
    <div class="control">
        <?php echo CHtml::checkBox('all', false, array('class' => 'float-l', 'key' => 'emca','id'=>"allcheck")); ?>
        <?php echo CHtml::link('全选', 'javascript:void(0)', array('style' => 'font-weight:bold;', 'id' => 'checkall')); ?>
        <?php echo CHtml::link('删除', 'javascript:void(0)', array('id' => 'delAll')); ?>
        <?php echo CHtml::link('添加商品', Yii::app()->createUrl('maker/salesmanage/goodsadd')); ?>
    </div>
    <div id="tab-container" class='tab-container'  pre='ctable'>
        <ul class='etabs'>
            <li class='tab'><?php echo CHtml::link('基础信息', '#tabs1'); ?></li>
            <li class='tab'><?php echo CHtml::link('规格参数', '#tabs2'); ?></li>
            <li class='tab'><?php echo CHtml::link('销售信息', '#tabs3'); ?></li>
            <li class='tab'><?php echo CHtml::link('关联信息', '#tabs4'); ?></li>
        </ul>
        <div class='panel-container'>
            <div id="tabs1">
                <?php $this->renderPartial('content', array('result' => $result, 'pages' => $pages,)); ?>
            </div>
            <div id="tabs2">
                <?php $this->renderPartial('paramsinfo', array('result' => $result, 'pages' => $pages)) ?>
            </div>
            <div id="tabs3">
                <?php $this->renderPartial('salesinfo', array('result' => $result, 'pages' => $pages)) ?>
            </div>
            <div id="tabs4">
                <?php $this->renderPartial('relationinfo', array('result' => $result, 'pages' => $pages)) ?>
            </div>
        </div>
    </div>
    <div class="pagelist text-c">
<?php $this->widget('widgets.default.WLinkPager', array(
     'pages' => $pages,
     )) ?>
 </div>
</div>

<!-- 显示边栏 -->
<div class="sidebar-show"></div>
<div ></div>
<div class='block-shadow' style="height:0px"></div>
<!-- 缩略图弹窗 -->
<div id='imgThumb' class='pos-a display-n'>
    <i class='icon-close-s hide'></i>
    <img width=210 height=150 src=""/>
    <div class='thumb-list'>
        <ul>
            <li class='float-l mg pos-r'>
                <i class='icon-green-arr-top'></i>
                <img width=50 height=50 src="">
            </li>
            <li class='float-l mg pos-r'>
                <i class='icon-green-arr-top'></i>
                <img width=50 height=50 src="">
            </li>
            <li class='float-l mg pos-r'>
                <i class='icon-green-arr-top'></i>
                <img width=50 height=50 src="">
            </li>
            <li class='float-l pos-r'>
                <i class='icon-green-arr-top'></i>
                <img width=50 height=50 src="">
            </li>
        </ul>
    </div>
</div>
<!-- OE弹窗 -->
<div id='OEmore' class='pos-a display-n'>
    <i class='icon-close-s hide'></i>
    <ul>
        <li>OE233</li>
        <li>OE23202</li>
        <li>OE454323478</li>
    </ul>
</div>
<!-- 车型弹窗 -->
<div id='Modelmore' class='pos-a display-n'>
	<i class='icon-close-s hide'></i>
	<ul>
		<li>奥迪A4</li>
		<li>别克凯越</li>
		<li>别克林荫大道</li>
	</ul>
</div>
<?php 
 //这是一段,在显示后定里消失的JQ代码,已集成至Yii中.
Yii::app()->clientScript->registerScript(
'myHideEffect',
'$("#message").animate({opacity: 1.0}, 2000).fadeOut("slow");',
CClientScript::POS_READY
);
?>
<script type="text/javascript">
    $(document).ready( function() {
        $('#tab-container').easytabs({animate:false});
        get_height_left('.sidebar','.content');
        //全选
        $("#allcheck").click(function () {
       	    if ($("input[type='checkbox']").attr("checked")) {                  
       	        $("input[type='checkbox']").attr("checked", true);                  
       	          }                  
       	    else {                  
       	           $("input[type='checkbox']").attr("checked", false); 
       	         }  
       	 });
        //checkbox多选删除
      	 $('#delAll').click(function(){
      		 var crowd=[];//声明存取复选框值的数组
      		  	$(".checkbox:input:checkbox:checked").each(function(){
         		  	 if(this.value!='')
          		  	 {
      		   		  crowd.push(this.value);
          		  	 }
      			});
      			var crowid= crowd.join(',');
      			if(crowid==null ||crowid.length==0)
      			{
          			alert('请勾选要删除的数据');
      				return false;
      			}
      			var confm=confirm('确定要删除所选择数据?');
      			if(confm==false)
      			{
      				return false;
      			}
      			var url=Yii_baseUrl +"/maker/salesmanage/delete";

      			$.ajax({
      		    url: url,
      		    type:"POST",
      		    data:{
      		         crowid: crowid
      		         },
      		     dataType: "json",
      		     success: function(data)
      		     {
      		        if(data)
      		          {
      		        	location.href="<?php echo Yii::app()->createUrl('/maker/salesmanage/querygoods');?>";
      		          }
      		     }
      			});
      	 });
      	 //单条ajax删除数据
    	 $('.icon-red-cross').click(function(){
    		 var crowid=$(this).attr('crowid');
    		 if(crowid=='')
    		 {
    			 return false;
    		 }
    		 var confm=confirm('确定要删除所选择数据?');
    			if(confm==false)
    			{
    				return false;
    			}
    			var url=Yii_baseUrl +"/maker/salesmanage/delete";
    			$.ajax({
    		    url: url,
    		    type:"POST",
    		    data:{
    		         crowid: crowid
    		         },
    		     dataType: "json",
    		     success: function(data)
    		     {
    		        if(data)
    		          {
    		        	location.href="<?php echo Yii::app()->createUrl('/maker/salesmanage/querygoods');?>";
    		          }
    		     }
    			});
    	 });
    });
</script>

