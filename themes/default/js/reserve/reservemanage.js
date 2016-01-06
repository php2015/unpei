/**
 * 预约管理
 */
$(document).ready(function(){
    $('input[name=LicensePlate]').focus();
});

//检索车辆
$('#LicensePlate').blur(function(){
    var LicensePlateval = $('#LicensePlate').val();
    if (LicensePlateval == "") {
        $('#LicensePlate').addClass("input1");
        return false;
    }else{
        $('#LicensePlate').removeClass("input1");
    }
    var url = Yii_baseUrl + "/servicer/reserve/queryreserveinfo";
    $.ajax({
         url: url,
         type: "POST",
         data: {
             'LicensePlate': LicensePlateval
         },
         dataType: "json",
         success:function(data){
            //console.log(data);
        	 if(!data && typeof(data)!="undefined"){
        		$('input[name=Mileage]').val("");
        		$('#make-select-index').val("");
        		$('input[name=StartTime]').val("");
                        $('input[name=OwenName]').val("");
                        $('input[name=Phone]').val("");
        		$('textarea[name=Remark]').val("");
                        $("#code").val("");
                        $("#carid").val("");
                        $("#ownerid").val("");
                        $("#reserve .search-result").hide();
        		alert("未检索到车辆信息，请直接登记！");
        	 }else{
        		$('input[name=Mileage]').val(data.Mileage);
        		$('#make-select-index').val(data.carname);
        		$('input[name=StartTime]').val(data.StartTime);
                        $('input[name=OwenName]').val(data.Name);
                        $('input[name=Phone]').val(data.Phone);
        		$('textarea[name=Remark]').val(data.Remark);
                        $("#code").val(data.Code);
                        $("#carid").val(data.ID);
                        $("#ownerid").val(data.OwnerID);
                        $("#reserve .search-result").hide();
        	 }
         }
    });
    return false;
});

//提交车辆信息获取所需配件信息
$("#reserve-vehicle-search").click(function(){
	var LicensePlateval = $('input[name=LicensePlate]').val();
	var Codeval = $('#code').val();
        var carid = $('#carid').val();
        var ownerid = $('#ownerid').val();
	var carval = $('#make-select-index').val();
        var OwnerNameval = $('input[name=OwnerName]').val();
	var Phoneval = $('input[name=Phone]').val();
	var Mileageval = $('input[name=Mileage]').val();
	var StartTimeval = $('input[name=StartTime]').val();
	var ReserveTimeval = $('input[name=ReserveTime]').val();
	var BeginTimeval = $('select[name=BeginTime]').val();
	var EndTimeval = $('select[name=EndTime]').val();
        var Remarkval = $('textarea[name=Remark]').val();
	if(LicensePlateval===""){
		alert("您还未填写车牌号！");
		return false;
	}
        if(OwnerNameval===""){
		alert("您还未填写联系人！");
		return false;
	}
        if(Phoneval===""){
		alert("您还未填写联系电话！");
		return false;
	}
        if(carval==="" || carval ==="请选择汽车品牌"){
		alert("您还未选择汽车品牌！");
		return false;
	}
	if(Codeval===""){
		alert("您选择的车型暂无保养项目！");
		return false;
	}
	if(Mileageval===""){
		alert("您还未填写当前里程！");
		return false;
	}
	if(StartTimeval===""){
		alert("您还未填写新车上路时间！");
		return false;
	}
	if(ReserveTimeval===""){
		alert("您还未填写预约时间！");
		return false;
	}
	if(StartTimeval>ReserveTimeval){
		alert("错误：新车上路时间大于预约时间！");
		return false;
	}
	if(Number(BeginTimeval)>Number(EndTimeval)){
		alert("错误：预约开始时间大于预约结束时间！");
		return false;
	}
	
    var url = Yii_baseUrl + "/servicer/reserve/addreserveinfo";
    $.ajax({
         url: url,
         type: "POST",
         data: {
             'LicensePlate': LicensePlateval,
             'Car': carval,
             'CarID': carid,
             'OwnerID': ownerid,
             'OwnerName': OwnerNameval,
             'Phone': Phoneval,
             'Code': Codeval,
             'Mileage': Mileageval,
             'StartTime': StartTimeval,
             'ReserveTime': ReserveTimeval,
             'EndTime': EndTimeval,
             'BeginTime': BeginTimeval,
             'Remark': Remarkval
         },
         dataType: "html",
         success:function(data){
            //console.log(data);
    	    $("#reserve .search-result .result-content").html(data);
    	    $("#reserve .search-result").show();
         }
    });
    return false;
});

//修改预约登记信息
$("#edit_reserve").click(function(){
        var id = $("#reserveid").val();
	var LicensePlateval = $('input[name=LicensePlate]').val();
	var Codeval = $('#code').val();
	var carval = $('#make-select-index').val();
	var Mileageval = $('input[name=Mileage]').val();
        var OwnerNameval = $('input[name=OwnerName]').val();
	var Phoneval = $('input[name=Phone]').val();
	var StartTimeval = $('input[name=StartTime]').val();
	var ReserveTimeval = $('input[name=ReserveTime]').val();
	var BeginTimeval = $('select[name=BeginTime]').val();
	var EndTimeval = $('select[name=EndTime]').val();
        var Remarkval = $('textarea[name=Remark]').val();
        alert(Remarkval);
	if(LicensePlateval===""){
		alert("车牌号不能为空！");
		return false;
	}
	if(Codeval===""){
		alert("您选择的车型暂无保养项目！");
		return false;
	}
        if(OwnerNameval===""){
		alert("联系人不能为空！");
		return false;
	}
        if(Phoneval===""){
		alert("联系电话不能为空！");
		return false;
	}
        if(carval==="" || carval ==="请选择汽车品牌"){
		alert("您还未选择汽车品牌！");
		return false;
	}
	if(Mileageval===""){
		alert("当前里程数不能为空！");
		return false;
	}
	if(StartTimeval===""){
		alert("新车上路时间不能为空！");
		return false;
	}
	if(ReserveTimeval===""){
		alert("预约时间不能为空！");
		return false;
	}
	if(StartTimeval>ReserveTimeval){
		alert("错误：新车上路时间大于预约时间！");
		return false;
	}
	if(Number(BeginTimeval)>Number(EndTimeval)){
		alert("错误：预约开始时间大于预约结束时间！");
		return false;
	}
	
    var url = Yii_baseUrl + "/servicer/reserve/editreserveinfo";
    $.ajax({
         url: url,
         type: "POST",
         data: {
             'id': id,
             'LicensePlate': LicensePlateval,
             'Car': carval,
             'Code': Codeval,
             'Mileage': Mileageval,
             'OwnerName': OwnerNameval,
             'Phone': Phoneval,
             'StartTime': StartTimeval,
             'ReserveTime': ReserveTimeval,
             'EndTime': EndTimeval,
             'BeginTime':BeginTimeval,
             'Remark': Remarkval
         },
         dataType: "json",
         success:function(data){
    	    location.href=Yii_baseUrl + "/servicer/reserve/index";
         }
    });
    return false;
});

//搜索商品
$("#reserve-goods-search").live('click',function(){
    var url = $(this).attr('src');
    $.ajax({
         url: url,
         type: "GET",
         dataType: "html",
         success:function(data){
        	 $('#goodsdata').html(data);
        	 $('#goodsdata').dialog('open');
         }
    });
    return false;
});

//添加商品
$('.addcgd').live('click',function(){
	html = '商品名称：'+$(this).parent().parent().find('.zwq_info a').attr('title')+"  |  ";
	html += $(this).parent().parent().find('.zwq_price .price').text()+"  |  ";
	html += $("#pjdc").text();
	$("#"+$(this).parent().find('input').val()).next().find('input[type=hidden]').val($(this).attr('goodsid'));
	$("#"+$(this).parent().find('input').val()).html(html);
	$("#input_item_"+$(this).parent().find('input').val()).val(1);
	$("#goodsdata").dialog("close");
});

//删除商品
$('.goodsinfo').live('click', function(){
	$(this).text("");
	$(this).next().find("input[type=hidden]").val("");
	$("#input_item_"+$(this).attr("id")).val(0);
});

//添加采购单
$('#reserve-purchase-add').live('click',function(){
	var url = Yii_baseUrl + '/servicer/reserve/addpurchase';
    $.ajax({
         url: url,
         type: "post",
         data: $('#purchase-form').serialize(),
         dataType: "json",
         success:function(data){
        	 if(data['result']==1){
        		 window.location.href = Yii_baseUrl + '/servicer/purchase/index';
        	 }else{
        		 alert(data['msg']);
        	 }
         }
    });
    return false;
});

//限制IE文本域最大输入数
$("textarea[maxlength]").keyup(function() {
    var area = $(this);
    var max = parseInt(area.attr("maxlength"), 10); //获取maxlength的值
    if (max > 0) {
        if (area.val().length > max) { //textarea的文本长度大于maxlength
            area.val(area.val().substr(0, max)); //截断textarea的文本重新赋值
        }
    }
});
//复制的字符处理问题
$("textarea[maxlength]").blur(function() {
    var area = $(this);
    var max = parseInt(area.attr("maxlength"), 10); //获取maxlength的值
    if (max > 0) {
        if (area.val().length > max) { //textarea的文本长度大于maxlength
            area.val(area.val().substr(0, max)); //截断textarea的文本重新赋值
        }
    }
});