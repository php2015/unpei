<div id="agency-modify-content" style="margin-top:30px;">
	<div id="agency-modify-message" style="color:red;margin-top:10px;height:20px;"></div>
	<div style="margin-top:10px;">
		<span style="display:inline-block;width:80px;">名称:</span>
		<input class="add-input" type="hidden" value="<?php echo $agency['AgencyID'];?>" id="mod-agencyid"> 
		<input class="add-input" type="text" value="<?php echo $agency['AgencyName'];?>" id="mod-agencyname" style="width:200px;"> 
	</div>
	<div style="margin-top:10px;">
		<span style="display:inline-block;width:80px;">机构类型:</span>
		<input class="add-input" type="text" value="<?php echo $agency['AgencyType'];?>" id="mod-agencytype" style="width:200px;"> 
	</div>
	<div style="margin-top:10px;">
		<span style="display:inline-block;width:80px;">地址:</span>
		<input class="add-input" type="text" value="<?php echo $agency['Address'];?>" id="mod-address" style="width:200px;"> 
	</div>	
	<div style="margin-top:10px;">
		<span style="display:inline-block;width:80px;">法人姓名:</span>
		<input class="add-input" type="text" value="<?php echo $agency['LegalPersonName'];?>" id="mod-legalpersonname" style="width:200px;"> 
	</div>	
	<div style="margin-top:10px;">
		<span style="display:inline-block;width:80px;">联系电话:</span>
		<input class="add-input" type="text" value="<?php echo $agency['Phone'];?>" id="mod-phone" style="width:200px;"> 
	</div>	
	<div style="margin-top:10px;">
		<span style="display:inline-block;width:80px;">手机号码:</span>
		<input class="add-input" type="text" value="<?php echo $agency['Telephone'];?>" id="mod-telephone" style="width:200px;"> 
	</div>
	<div style="margin-top:10px;">
		<span style="display:inline-block;width:80px;">QQ号码:</span>
		<input class="add-input" type="text" value="<?php echo $agency['QQNum'];?>" id="mod-qqnum" style="width:200px;"> 
	</div>
	<div style="margin-top:10px;">
		<span style="display:inline-block;width:80px;">邮箱:</span>
		<input class="add-input" type="text" value="<?php echo $agency['Email'];?>" id="mod-email" style="width:200px;"> 
	</div>	
	<div style="margin-top:10px;">
		<span style="display:inline-block;width:80px;">网址:</span>
		<input class="add-input" type="text" value="<?php echo $agency['Website'];?>" id="mod-website" style="width:200px;"> 
	</div>	
		<div style="margin-top:10px;">
		<span style="display:inline-block;width:80px;">经营范围:</span>
		<input class="add-input" type="text" value="<?php echo $agency['BusinessScope'];?>" id="mod-businessscope" style="width:200px;"> 
	</div>	
		<div style="margin-top:10px;">
		<span style="display:inline-block;width:80px;">工商注册号:</span>
		<input class="add-input" type="text" value="<?php echo $agency['CommerceNo'];?>" id="mod-commerceno" style="width:200px;"> 
	</div>	
		<div style="margin-top:10px;">
		<span style="display:inline-block;width:80px;">公司介绍:</span>
		<input class="add-input" type="text" value="<?php echo $agency['Introduction'];?>" id="mod-introduction" style="width:200px;"> 
	</div>	
		<div style="margin-top:10px;">
		<span style="display:inline-block;width:80px;">工位数:</span>
		<input class="add-input" type="text" value="<?php echo $agency['StationNum'];?>" id="mod-stationnum" style="width:200px;"> 
	</div>	
		<div style="margin-top:10px;">
		<span style="display:inline-block;width:80px;">技师人数:</span>
		<input class="add-input" type="text" value="<?php echo $agency['TechnicianNum'];?>" id="mod-techniciannum" style="width:200px;"> 
	</div>	
		<div style="margin-top:10px;">
		<span style="display:inline-block;width:80px;">门店照片:</span>
		<input class="add-input" type="text" value="<?php echo $agency['Picture'];?>" id="mod-picture" style="width:200px;"> 
	</div>	
		<div style="margin-top:10px;">
		<span style="display:inline-block;width:80px;">开店日期:</span>
		 <input class="add-input" type="text" value="<?php echo $agency['OpeningDate'];?>" id="mod-openingdate" style="width:200px;">	    
	</div>	
		<div style="margin-top:10px;">
		<span style="display:inline-block;width:80px;">资质说明:</span>
		<input class="add-input" type="text" value="<?php echo $agency['QualificationDes'];?>" id="mod-qualificationdes" style="width:200px;"> 
	</div>	
	<div style="margin-top:10px;">
		<input type="submit" value="保存" id="agency-modify-submit" style="width:180px; font-weight:400; font-size:13px; cursor: pointer;">
		<!--  <input type="button" value="返回" class="back-to-lastcontent_wyy" currentid="agency-modify-content" lastid="agencyadmin-content"
			style="width:150px; font-weight:400; font-size:13px; cursor: pointer;">-->
	</div>		
	<div id="agency-modify-result" style="color:red;margin-top:10px;"></div>						
</div>
<script type="text/javascript">
//修改修理厂
$(document).delegate('#agency-modify-submit','click',function(){
	var agencyID = $.trim($('#mod-agencyid').val());
	var agencyName = $.trim($('#mod-agencyname').val());
	var agencyType = $.trim($('#mod-agencytype').val());
	var address = $.trim($('#mod-address').val());
	var legalPersonName = $.trim($('#mod-legalpersonname').val());
	var phone = $.trim($('#mod-phone').val());
	var telephone = $.trim($('#mod-telephone').val());
	var qqNum = $.trim($('#mod-qqnum').val());
	var email = $.trim($('#mod-email').val());	
	var website = $.trim($('#mod-website').val());
	var businessScope = $.trim($('#mod-businessscope').val());
	var commerceNo = $.trim($('#mod-commerceno').val());
	var introduction = $.trim($('#mod-introduction').val());
	var stationNum = $.trim($('#mod-stationnum').val());	
	var technicianNum = $.trim($('#mod-techniciannum').val());
	var picture = $.trim($('#mod-picture').val());
	var openingDate = $.trim($('#mod-openingdate').val());	
	var qualificationDes = $.trim($('#mod-qualificationdes').val());			
	
	//检查参数
	$('#agency-modify-result').html('');
	$('#agency-modify-message').html('');
	if(agencyName == ''){
		$('#agency-modify-message').html("请输入修理厂名称");
		return false;
	}
	if(agencyType == ''){
		$('#agency-modify-message').html("请输入机构类型");
		return false;
	}
	if(address == ''){
		$('#agency-modify-message').html("请输入地址");
		return false;
	}
	if(legalPersonName == ''){
		$('#agency-modify-message').html("请输入法人姓名");
		return false;
	}
	if(phone == ''){
		$('#agency-modify-message').html("请输入联系电话");
		return false;
	}
	if(businessScope == ''){
		$('#agency-modify-message').html("请输入经营范围");
		return false;
	}
	if(commerceNo == ''){
		$('#agency-modify-message').html("请输入工商注册号");
		return false;
	}
	if(qualificationDes == ''){
		$('#agency-modify-message').html("请输入资质说明");
		return false;
	}
	
	var url = Yii_baseUrl + "/agency/modifyAgency";
    $.ajax({
    	 url: url,
    	 type: "POST",
    	 data: {
    		 'agencyID': agencyID,
        	 'agencyName': agencyName,
        	 'agencyType': agencyType,
        	 'address': address,
        	 'legalPersonName': legalPersonName,
        	 'phone': phone,
        	 'telephone': telephone,
        	 'qqNum': qqNum,
        	 'email': email,
        	 'website': website,
        	 'businessScope': businessScope,
        	 'commerceNo': commerceNo,
        	 'introduction': introduction,
        	 'stationNum': stationNum,
        	 'technicianNum': technicianNum,
        	 'picture': picture,
        	 'openingDate': openingDate,
        	 'qualificationDes': qualificationDes
         },
         dataType: "json",
         success:function(data){
			if(data.result){
				$('#agency-modify-result').html('提交成功');
				$('.back-to-lastcontent').click();
			}else{
				$('#agency-modify-result').html('提交失败<br />'+data.error);
			}
         }
    });	
});
</script>