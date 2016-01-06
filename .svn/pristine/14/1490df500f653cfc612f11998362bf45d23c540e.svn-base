<div id="goodscategoryadmin-content" style="margin:20px 0 50px 0;">
    <?php $this->renderPartial('goodscategoryadd'); ?>	
	<?php $this->renderPartial('goodscategorylist',array('goodscategory' => $goodscategory)); ?>
			
</div>
<script type="text/javascript">
//新增商品类别
$(document).delegate('#goodscategory-add-submit','click',function(){
	var goodsCategoryID = $.trim($('#goodscategoryid').val());
	var goodsCategoryName = $.trim($('#goodscategoryname').val());
	var goodsCategoryDesc = $.trim($('#goodscategorydesc').val());
	
	//3个参数
	//检查参数
	$('#goodscategory-add-result').html('');
	$('#goodscategory-add-message').html('');
	    if(goodsCategoryID == ''){
			$('#goodscategory-add-message').html("请输入类别代号");
			return false;
		}	
		if(goodsCategoryName == ''){
			$('#goodscategory-add-message').html("请输入商品类别名称");
			return false;
		}
		
	var url = Yii_baseUrl + "/goodscategory/addsubmit";	
    $.ajax({
    	 url: url,
    	 type: "POST",
    	 data: {   		 
        	 'goodsCategoryID': goodsCategoryID,
        	 'goodsCategoryName': goodsCategoryName,
        	 'goodsCategoryDesc': goodsCategoryDesc,
         },
         dataType: "json",        
         success:function(data){
             
			if(data.result){
				$('#goodscategory-add-result').html('提交成功');
				//刷新商品类别列表
				$('#refresh-goodscategorylist').click();
				//清除提交的数据
				$('.add-input').each(function(){ 
					$(this).val('');
				});
			}else{
				$('#goodscategory-add-result').html('提交失败<br />'+data.error);
			}
         }
    });	
});


//删除商品类别
$(document).delegate('.goodscategory-del','click',function(){
	var goodsCategoryID = $(this).attr('goodscategoryid');
	if(goodsCategoryID == ""){
		return false;
	}
	var url = Yii_baseUrl + "/goodscategory/delsubmit";
    $.ajax({
    	 url: url,
    	 type: "POST",
    	 data: {
    		 'goodsCategoryID': goodsCategoryID
         },
         dataType: "json",
         success:function(data){
             if(data.result){
             	$('#tr-'+goodsCategoryID).remove();
             }
         }
    });
    return false;	
});		

//跳转到修改商品类别
$(document).delegate('.goodscategory-to-modify','click',function(){
	var goodsCategoryID = $(this).attr('goodscategoryid');
	if(goodsCategoryID == ""){
		return false;
	}
	var url = Yii_baseUrl + "/goodscategory/toModifyGoodsCategory";
	alert(url);
    $.ajax({
    	 url: url,
    	 type: "POST",
    	 data: {
    		 'goodsCategoryID': goodsCategoryID
         },
         dataType: "html",
         success:function(html){
	       	 $('.righter .container').children('div').hide();
	    	 $('.righter .container').append(html);
         }
    });
    return false;	
});	


//刷新商品类别列表
$(document).delegate('#refresh-goodscategorylist','click',function(){
	var url = Yii_baseUrl + "/goodscategory/goodscategorylist";
    $.ajax({
    	 url: url,
    	 type: "POST",
    	 data: {},
         dataType: "html",
         success:function(html){
			$('#goodscategorylist-content').replaceWith(html);
         }
    });
    return false;	         
});	
</script>