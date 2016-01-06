//全局变量信息
var global_mtc = {"hashPrefix":"#maint/","make":"","car":"","engine":"","status":0};

$(document).ready(function(){
    //养护周期初始化厂家信息
    var url3 = Yii_jpdata_baseUrl + "/vehicle/querymtcmake";
    $.ajax({
         url: url3,
         type: "POST",
         data: {},
         dataType: "json",
         success:function(data){
                 var html = "<option value='0'>厂家</option>";
                 if(data && typeof(data)=='object'){
                         for(i=0;i<data.length;i++){
                                 html += "<option value='"+(i+1)+"'>"+data[i]['make']+"</option>"
                         }
                 }
                 $('#front-vehicle-makes-list').html(html);
         }
    });
})
//养护周期改变厂家时获取车系信息
$("#front-vehicle-makes-list").change(function(){
    //判断如果厂家的值为0,则全部显示--请选择样式
    var makeval = $('#front-vehicle-makes-list').val();
    if(makeval == '0'){
            $('#front-vehicle-car-list').html("<option value='0'>车系</option>");
            $('#front-vehicle-engine-list').html("<option value='0'>发动机</option>");	
            return false;
    }
    //传递厂家的参数
    var make = $('#front-vehicle-makes-list').find("option:selected").text();
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
    var make = $('#front-vehicle-makes-list').find("option:selected").text();
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
                 $('#front-vehicle-engine-list').change();
         }
    });
    return false;
});

//配件查询
$('#partnames-search').click(function(){
      var makeId = $('#vehicle-make-list').val();
      var seriesId = $('#vehicle-series-list').val();
      var yearId = $('#vehicle-year-list').val();
      var modelId=$('#vehicle-model-list').val();
      var mainGroupId = $('#vehicle-maingroup').val();
      var groupId = $('#vehicle-group').val();
      if(!makeId || !modelId || !groupId || !mainGroupId){
          return false;
      }
      var url = Yii_jpdata_baseUrl + "/parts/groupInfo";
      $.ajax({
           url: url,
           type: "POST",
           data: {
               'modelId': modelId,
               'groupId': groupId
           },
           dataType: "html",
           success:function(html){
               var part_hash = global_parts.hashPrefix + makeId + "-" + seriesId + "-" + yearId + "-" 
                            + modelId + "-" + mainGroupId + "-" + groupId+'/fromshouye/';
                window.location.href=Yii_baseUrl+'/jpdata/parts/index'+part_hash;
           }
       });	
});

//前市场车型查询
$("#front-vehicles-search").click(function(){
    var makeval = $('#front-vehicle-make-list').val();
    var seriesval = $('#front-vehicle-series-list').val();
    var yearval = $('#front-vehicle-year-list').val();
    var modelval = $('#front-vehicle-model-list').val();
    if(!modelval){
        return false;
    }
    var url = Yii_jpdata_baseUrl + "/vehicle/frontModelInfo";
    $.ajax({
         url: url,
         type: "POST",
         data: {
             'modelId': modelval
         },
         dataType: "html",
         success:function(html){
                var front_hash = global_vehicle.hashPrefix + makeval + "-" + seriesval + "-" + yearval + "-" + modelval;
                window.location.href=Yii_baseUrl+'/jpdata/vehicle/index'+front_hash;
         }
    });
    return false;
});

//养护周期查询
$("#front-vehicle-maintenance-search").click(function(){
    var modelval = $('#front-vehicle-engine-list').val();
    if( !modelval || modelval == '0')
    {
        return false;
    }
    var makeval = $('#front-vehicle-makes-list').val();
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
            var hashhtml = global_mtc.hashPrefix + makeval + "-" + carval + "-" + modelval;
            window.location.href=Yii_baseUrl+'/jpdata/maintenance/index'+hashhtml;
         }
    });
    return false;
});