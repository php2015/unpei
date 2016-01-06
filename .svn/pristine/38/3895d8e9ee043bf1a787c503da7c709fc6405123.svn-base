//全局变量信息
var global_mtc = {"hashPrefix":"#maint/","make":"","car":"","engine":"","status":0};

$(document).ready(function(){

	//通过location.hash控制页面刷新问题
	var hashPrefix = global_mtc.hashPrefix;
	var hash = window.location.hash;
	if (hash && hash.substr(0,hashPrefix.length) == hashPrefix){
		var paramsStr = hash.substr(hashPrefix.length);
		var paramsArr = paramsStr.split('-');
		global_mtc.make = paramsArr[0];
		global_mtc.car = paramsArr[1];
		global_mtc.engine = paramsArr[2];
		global_mtc.status++;
	}
	
	//初始化厂家信息
	var url = Yii_jpdata_baseUrl + "/vehicle/querymtcmake";
    $.ajax({
    	 url: url,
    	 type: "POST",
       	 data: {},
         dataType: "json",
         success:function(data){
	         var html = "<option value='0'>--请选择厂家类别</option>";
	         if(data && typeof(data)=='object'){
		         for(i=0;i<data.length;i++){
		        	 html += "<option value='"+(i+1)+"'>"+data[i]['make']+"</option>"
		         }
	         }
	         $('#front-vehicle-make-list').html(html);
	         if(global_mtc.make && global_mtc.status++ == 1){
	        	 $("#front-vehicle-make-list").val(global_mtc.make);
	        	 $("#front-vehicle-make-list").change();
	         }
         }
    });
});

//改变厂家时获取车系信息
$("#front-vehicle-make-list").change(function(){
	//判断如果厂家的值为0,则全部显示--请选择样式
	var makeval = $('#front-vehicle-make-list').val();
	if(makeval == '0'){
		$('#front-vehicle-car-list').html("<option value='0'>--请选择车系名称</option>");
		$('#front-vehicle-engine-list').html("<option value='0'>--请选择车型发动机</option>");	
		return false;
	}
	//传递厂家的参数
	var make = $('#front-vehicle-make-list').find("option:selected").text();
	var url = Yii_jpdata_baseUrl + "/vehicle/querymtccarbymake";
    $.ajax({
    	 url: url,
    	 type: "POST",
       	 data: {
	       	 'make': make
       	 },
         dataType: "json",
         success:function(data){
	         var html = "";
	         if(data && typeof(data)=='object'){
		         for(i=0;i<data.length;i++){
		        	 html += "<option value='"+(i+1)+"'>"+data[i]['car']+"</option>"
		         }
	         }
	         $('#front-vehicle-car-list').html(html);
	         if(global_mtc.car && global_mtc.status++ == 2){
	        	 $("#front-vehicle-car-list").val(global_mtc.car);
	         }
	         $('#front-vehicle-car-list').change();
         }
    });
    return false;
});	 

//车系改变时获取发动机信息
$("#front-vehicle-car-list").change(function()
{
	//判断车系为空时,全部为空
	var car = $('#front-vehicle-car-list').find("option:selected").text();
	if(car=='')
	{
		$('#front-vehicle-car-list').html("<option></option>");
		$('#front-vehicle-engine-list').html("<option></option>");
		return false;
	}
	var url = Yii_jpdata_baseUrl + "/vehicle/querymtcenginebymake";
	var make = $('#front-vehicle-make-list').find("option:selected").text();
	var car = $('#front-vehicle-car-list').find("option:selected").text();
    $.ajax({
    	 url: url,
    	 type: "POST",
       	 data: {
			'make': make,
			'car': car
	     },
         dataType: "json",
         success:function(data){
	         var html = " ";
	         if(data && typeof(data)=='object'){
		         for(i=0;i<data.length;i++){
		        	 html += "<option value="+data[i]['vehicleMtcID']+">"+data[i]['engine']+"</option>"
		         }
	         }
	         $('#front-vehicle-engine-list').html(html);
	         if(global_mtc.engine && global_mtc.status++ == 3){
	        	 $("#front-vehicle-engine-list").val(global_mtc.engine);
	        	 $("#front-vehicle-maintenance-search").click();
	         }
         }
    });
    return false;
});

//显示车型养护周期信息
$("#front-vehicle-maintenance-search").click(function(){
    var modelval = $('#front-vehicle-engine-list').val();
    if( !modelval || modelval == '0')
    {
        return false;
    }
    var makeval = $('#front-vehicle-make-list').val();
	var carval = $('#front-vehicle-car-list').val();
    var url = Yii_jpdata_baseUrl + "/maintenance/queryfrontvehiclemaintenance";
    $.ajax({
         url: url,
         type: "POST",
         data: {
             'vehicleID': modelval
         },
         dataType: "html",
         success:function(html){
         	//$('.maincontent').html(html);
    	    $("#tab-mtc .search-result .result-content").html(html);
    	    $("#tab-mtc .search-result").show();
    	  //  get_height_align('.sidebar','.content');
         	window.location.hash = global_mtc.hashPrefix + makeval + "-" + carval + "-" + modelval;
         }
    });
    return false;
});