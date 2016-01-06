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
            $('#front-vehicle-make-lists').html(html);
            if(global_vehicle.make && global_vehicle.status++ == 1){
                $("#front-vehicle-make-lists").val(global_vehicle.make);
                $("#front-vehicle-make-lists").change();
            }
        }
    });
});

//改变厂家时获取车系信息
$("#front-vehicle-make-lists").change(function(){
    //判断如果厂家的值为0,则全部显示--请选择样式
    var makeval = $('#front-vehicle-make-lists').val();
    if(!makeval){
        $('#front-vehicle-series-lists').html("<option value='0'>--请选择车系名称</option>");
        $('#front-vehicle-year-lists').html("<option value='0'>--请选择车型年款</option>");	
        $('#front-vehicle-model-lists').html("<option value='0'>--请选择车型名称</option>");
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
            $('#front-vehicle-series-lists').html(html);
            if(global_vehicle.series && global_vehicle.status++ == 2){
                $("#front-vehicle-series-lists").val(global_vehicle.series);
            }
            //车主车辆管理--编辑车系
            $("#front-vehicle-series-lists").find("option").each(function(){
                if($(this).text()==$("#front-vehicle-make-lists").attr("carkey")){
                    $("#front-vehicle-series-lists").val($(this).val());
                    return false;
                }
            });
            $('#front-vehicle-series-lists').change();
        }
    });
    return false;
});	 

//车系改变时获取年款信息
$("#front-vehicle-series-lists").change(function(){
    //判断车系为空时,全部为空
    var makeval = $('#front-vehicle-make-lists').val();
    var seriesval = $('#front-vehicle-series-lists').val();
    if(!seriesval)
    {
        $('#front-vehicle-series-lists').html("<option></option>");
        $('#front-vehicle-year-lists').html("<option></option>");		
        $('#front-vehicle-model-lists').html("<option></option>");
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
            $('#front-vehicle-year-lists').html(html);
            if(global_vehicle.year && global_vehicle.status++ == 3){
                $("#front-vehicle-year-lists").val(global_vehicle.year);
            }
            //车主车辆管理--编辑年款
            $("#front-vehicle-year-lists").find("option").each(function(){
                if($(this).text()==$("#front-vehicle-series-lists").attr("carkey")){
                    $("#front-vehicle-year-lists").val($(this).val());
                    return false;
                }
            });
            $('#front-vehicle-year-lists').change();
        }
    });
    return false;
});

//年款信息改变获取车型信息
$("#front-vehicle-year-lists").change(function(){	
    var makeval = $('#front-vehicle-make-lists').val();
    var seriesval = $('#front-vehicle-series-lists').val();
    if(!makeval || !seriesval)
    {
        $('#front-vehicle-model-lists').html("<option></option>");
        $('#front-vehicle-year-lists').html("<option></option>");
        return false;
    }
    
    var year = $('#front-vehicle-year-lists').val();
    var yeartext = $('#front-vehicle-year-lists').find("option").text();
    //var yearnum = $('#front-vehicle-year-lists').find("option").length;
    if(!yeartext){
        $("#front-vehicle-year-lists").attr("disabled",true);
    }else{
        $("#front-vehicle-year-lists").attr("disabled",false);
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
            $('#front-vehicle-model-lists').html(html);
            if(global_vehicle.model && global_vehicle.status++ == 4){
                $("#front-vehicle-model-lists").val(global_vehicle.model);
                $("#front-vehicle-search").click();
            }
            //车主车辆管理--编辑车型
            $("#front-vehicle-model-lists").find("option").each(function(){
                if($(this).text()==$("#front-vehicle-year-lists").attr("carkey")){
                    $("#front-vehicle-model-lists").val($(this).val());
                    return false;
                }
            });
        }
    });
    return false;
});

//显示车型信息
$("#front-vehicle-search").click(function(){
    var makeval = $('#front-vehicle-make-lists').val();
    var seriesval = $('#front-vehicle-series-lists').val();
    var yearval = $('#front-vehicle-year-lists').val();
    var modelval = $('#front-vehicle-model-lists').val();
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