//全局变量信息
var global_vehicle = {
    "hashPrefix":"#front/",
    "make":"",
    "series":"",
    "year":"",
    "model":"",
    "status":0
};

//页面加载完成后执行
$(document).ready(function(){
	
    //通过location.hash控制页面刷新问题
    var hashPrefix = global_vehicle.hashPrefix;
    var hash = window.location.hash;
    
    if (hash && hash.substr(0,hashPrefix.length) == hashPrefix){
        var paramsStr = hash.substr(hashPrefix.length);
        var paramsArr = paramsStr.split('-');
        global_vehicle.make = paramsArr[0];
        global_vehicle.series = paramsArr[1];
        global_vehicle.year = paramsArr[2];
        global_vehicle.model = paramsArr[3];
        global_vehicle.status++;
    }
	
    //初始化厂家信息
    var url = Yii_jpdataUrl + "/vehicle/frontMakes";
    $.ajax({
        url: url,
        type: "POST",
        data: {},
        dataType: "json",
        success:function(data){
            var html = "<option value='0'>--请选择厂家类别</option>";
            if(data && typeof(data)=='object'){
                for(i=0;i<data.length;i++){
                    html += "<option value='"+data[i]['makeId']+"'>"+data[i]['name']+"</option>"
                }
            }
            $('#front-vehicle-make-list').html(html);
            if(global_vehicle.make && global_vehicle.status++ == 1){
                $("#front-vehicle-make-list").val(global_vehicle.make);
                $("#front-vehicle-make-list").change();
            }
        }
    });
});

//改变厂家时获取车系信息
$("#front-vehicle-make-list").change(function(){
    //判断如果厂家的值为0,则全部显示--请选择样式
    var makeval = $('#front-vehicle-make-list').val();
    if(!makeval){
        $('#front-vehicle-series-list').html("<option value='0'>--请选择车系名称</option>");
        $('#front-vehicle-year-list').html("<option value='0'>--请选择车型年款</option>");	
        $('#front-vehicle-model-list').html("<option value='0'>--请选择车型名称</option>");
        return false;
    }
    var url = Yii_jpdataUrl + "/vehicle/frontSeries";
    $.ajax({
        url: url,
        type: "POST",
        data: {
            'make': makeval
        },
        dataType: "json",
        success:function(data){
            var html = "";
            if(data && typeof(data)=='object'){
                for(i=0;i<data.length;i++){
                    html += "<option value='"+data[i]['seriesId']+"'>"+data[i]['name']+"</option>"
                }
            }
            $('#front-vehicle-series-list').html(html);
            if(global_vehicle.series && global_vehicle.status++ == 2){
                $("#front-vehicle-series-list").val(global_vehicle.series);
            }
            $('#front-vehicle-series-list').change();
        }
    });
    return false;
});	 

//车系改变时获取年款信息
$("#front-vehicle-series-list").change(function(){
    //判断车系为空时,全部为空
    var makeval = $('#front-vehicle-make-list').val();
    var seriesval = $('#front-vehicle-series-list').val();
    if(!seriesval)
    {
        $('#front-vehicle-series-list').html("<option></option>");
        $('#front-vehicle-year-list').html("<option></option>");		
        $('#front-vehicle-model-list').html("<option></option>");
        return false;
    }
    var url = Yii_jpdataUrl + "/vehicle/frontSeriesYears";
    $.ajax({
        url: url,
        type: "POST",
        data: {
            'make': makeval,
            'series': seriesval
        },
        dataType: "json",
        success:function(data){
            var html = "";
            if(data && typeof(data)=='object'){
                for(i=0;i<data.length;i++){
                    if(data[i]['year']){
                        html += "<option value='"+data[i]['year']+"'>"+data[i]['year']+"款"+"</option>";
                    }else{
                        html += "<option value=''></option>";
                    }
                }
            }
            $('#front-vehicle-year-list').html(html);
            if(global_vehicle.year && global_vehicle.status++ == 3){
                $("#front-vehicle-year-list").val(global_vehicle.year);
            }
            $('#front-vehicle-year-list').change();
        }
    });
    return false;
});

//年款信息改变获取车型信息
$("#front-vehicle-year-list").change(function(){	
    var makeval = $('#front-vehicle-make-list').val();
    var seriesval = $('#front-vehicle-series-list').val();
    if(!makeval || !seriesval)
    {
        $('#front-vehicle-model-list').html("<option></option>");
        $('#front-vehicle-year-list').html("<option></option>");
        return false;
    }
    
    var year = $('#front-vehicle-year-list').val();
    var yeartext = $('#front-vehicle-year-list').find("option").text();
    //var yearnum = $('#front-vehicle-year-list').find("option").length;
    if(!yeartext){
        $("#front-vehicle-year-list").attr("disabled",true);
    }else{
        $("#front-vehicle-year-list").attr("disabled",false);
    }
    var url = Yii_jpdataUrl + "/vehicle/frontModels";
    $.ajax({
        url: url,
        type: "POST",
        data: {
            'make': makeval,
            'series': seriesval,
            'year': year
        },
        dataType: "json",
        success:function(data){
            var html = "";
            if(data && typeof(data)=='object'){
                for(i=0;i<data.length;i++){
                    html += "<option value="+data[i]['modelId']+">"+data[i]['name']+"</option>"
                }
            }
            $('#front-vehicle-model-list').html(html);
            if(global_vehicle.model && global_vehicle.status++ == 4){
                $("#front-vehicle-model-list").val(global_vehicle.model);
                $("#front-vehicle-search").click();
            }
            $('#front-vehicle-model-list').change();
        }
    });
    return false;
});

//显示车型信息
$("#front-vehicle-search").click(function(){
    var makeval = $('#front-vehicle-make-list').val();
    var seriesval = $('#front-vehicle-series-list').val();
    var yearval = $('#front-vehicle-year-list').val();
    var modelval = $('#front-vehicle-model-list').val();
    if(!modelval){
        return false;
    }
    var url = Yii_jpdataUrl + "/vehicle/frontModelInfo";
    $.ajax({
        url: url,
        type: "POST",
        data: {
            'modelId': modelval
        },
        dataType: "html",
        success:function(html){
            $('.zoomContainer').remove();
            //$('.maincontent').html(html);
            //$('#info').html(html);
            $("#tab-mm .search-result .result-content").html(html);
            $("#tab-mm .search-result").show();
            get_height_align('.sidebar','.content');
            window.location.hash = global_vehicle.hashPrefix + makeval + "-" + seriesval + "-" + yearval + "-" + modelval;
        }
    });
    return false;
});