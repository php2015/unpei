//全局变量信息
var global_parts = {
    "hashPrefix":"#parts/",
    "make":"",
    "series":"",
    "year":"",
    "model":"",
    "maingroup":"",
    "subgroup":"",
    "status":0
};
var global_oe = {
    "hashPrefix":"#search/oe/",
    "oeno":"",
    "make":"",
    "status":0
};
var global_name = {
    "hashPrefix":"#search/name/",
    "name":"",
    "make":"",
    "series":"",
    "year":"",
    "model":"",
    "status":0
};

$(document).ready(function(){
    //通过location.hash控制页面刷新问题
    //配件查询
    var hashPrefix = global_parts.hashPrefix;
    var hash = window.location.hash;
    if (hash && hash.substr(0,hashPrefix.length) == hashPrefix){
        var paramsStr = hash.substr(hashPrefix.length);
        var paramsArr = paramsStr.split('-');
        global_parts.make = paramsArr[0];
        global_parts.series = paramsArr[1];
        global_parts.year = paramsArr[2];
        global_parts.model = paramsArr[3];
        global_parts.maingroup = paramsArr[4];
        global_parts.subgroup = paramsArr[5];
        global_parts.status++;
        $('#tab-head-group').click();
    }
	
    //按OE号搜索
    var hashPrefix = global_oe.hashPrefix;
    var hash = window.location.hash;
    if (hash && hash.substr(0,hashPrefix.length) == hashPrefix){
        var paramsStr = hash.substr(hashPrefix.length);
        var paramsArr = paramsStr.split('__');
        global_oe.oeno = paramsArr[0];
        if(!paramsArr[1]){
            global_oe.make = 0;
        }else{
            global_oe.make = paramsArr[1];
        }
        global_oe.status++;
        $('#tab-head-oeno').click();
    }
	
    //按配件名称搜索
    var hashPrefix = global_name.hashPrefix;
    var hash = window.location.hash;
    if (hash && hash.substr(0,hashPrefix.length) == hashPrefix){
        var paramsStr = hash.substr(hashPrefix.length);
        var paramsArr = paramsStr.split('-');
        global_name.name = paramsArr[0];
        global_name.make = paramsArr[1];
        global_name.series = paramsArr[2];
        global_name.year = paramsArr[3];
        global_name.model = paramsArr[4];
        global_name.status++;
        $('#tab-head-partname').click();
    }
	
    //厂家信息
    var url = Yii_jpdata_baseUrl + "/vehicle/epcMakes";
    $.ajax({
        url: url,
        type: "POST",
        data: {},
        dataType: "json",
        success:function(data){
            var html = "<option value=''>--请选择厂家类别</option>";
            if(data && typeof(data)=='object'){
                for(i=0;i<data.length;i++){
                    html += "<option value='"+data[i]['makeId']+"'>"+data[i]['name']+"</option>"
                }
            }
            $('#vehicle-make-list').html(html);
            $('#oeno-search-make-list').html(html);
            $('#search-make-list').html(html);
            if(global_parts.make && global_parts.status++ == 1){
                $("#vehicle-make-list").val(global_parts.make);
                $("#vehicle-make-list").change();
            }else if(global_oe.oeno && global_oe.status++ == 1){
                // tab切换
                $("ul.nav-tabs").find("li").removeClass('active');
                $("ul.nav-tabs").find("li.parts-search-tab").addClass('active');
                var pane_id = $("li.parts-search-tab").find('a').attr('href');
                $('.tab-pane').removeClass('active');
                $(''+pane_id).addClass('active');
                // oe查询
                $('#oeno').val(global_oe.oeno);
                $('#oeno').change();
            }else if(global_name.name && global_name.status++ == 1){
                $("ul.nav-tabs").find("li").removeClass('active');
                $("ul.nav-tabs").find("li.parts-search-tab").addClass('active');
                var pane_id = $("li.parts-search-tab").find('a').attr('href');
                $('.tab-pane').removeClass('active');
                $(''+pane_id).addClass('active');
                // 名称查询
                $("#partname").val(global_name.name);
                //$("#partname").change();
                if(global_name.make && global_name.status++ == 2){
                    $("#search-make-list").val(global_name.make);
                }
                $('#search-make-list').change();
            }
        }
    });

    //改变厂家时获取车系信息
    $("#vehicle-make-list").change(function(){
        //判断如果厂家的值为0,则全部显示--请选择样式
        var makeId = $('#vehicle-make-list').val();
        if(!makeId)
        {
            $("#vehicle-year-list").attr("disabled",false);
            $('#vehicle-series-list').html("<option value=''>--请选择车系名称</option>");
            $('#vehicle-model-list').html("<option value=''>--请选择车型名称</option>");
            $('#vehicle-year-list').html("<option value=''>--请选择车型年款</option>");
            $('#vehicle-maingroup').html("<option value=''>--请选择车型主组</option>");
            $('#vehicle-group').html("<option value=''>--请选择车型子组</option>");
            return false;
        }
        var url = Yii_jpdata_baseUrl + "/vehicle/epcSeries";
        $.ajax({
            url: url,
            type: "POST",
            data: {
                'make': makeId
            },
            dataType: "json",
            success:function(data){
                var html = "";
                if(data && typeof(data)=='object'){
                    for(i=0;i<data.length;i++){
                        html += "<option value='"+data[i]['seriesId']+"'>"+data[i]['name']+"</option>"
                    }
                }
                $('#vehicle-series-list').html(html);
                if(global_parts.series && global_parts.status++ == 2){
                    $("#vehicle-series-list").val(global_parts.series);
                }
                $('#vehicle-series-list').change();
            }
        });
        return false;
    });	 

    //车系改变时获取年款信息
    $("#vehicle-series-list").change(function()
    {
        //判断车系为空时,全部为空
        var seriesId = $('#vehicle-series-list').val();
        if(!seriesId)
        {
            $("#vehicle-year-list").attr("disabled",false);
            $('#vehicle-series-list').html("<option></option>");
            $('#vehicle-model-list').html("<option></option>");
            $('#vehicle-year-list').html("<option></option>");
            $('#vehicle-maingroup').html("<option></option>");
            $('#vehicle-group').html("<option></option>");
            return false;
        }
        var url = Yii_jpdata_baseUrl + "/vehicle/epcSeriesYears";
        var makeId = $('#vehicle-make-list').val();
        $.ajax({
            url: url,
            type: "POST",
            data: {
                'make': makeId,
                'series': seriesId
            },
            dataType: "json",
            success:function(data){
                var html = " ";
                if(data && typeof(data)=='object'){
                    for(i=0;i<data.length;i++){
                        if(data[i]['year']){
                            html += "<option value='"+data[i]['year']+"'>"+data[i]['year']+"款"+"</option>";
                        }else{
                            html += "<option value=''></option>";
                        }
                    }
                }
                $('#vehicle-year-list').html(html);
                if(global_parts.status++  == 3 && global_parts.year ){
                    $("#vehicle-year-list").val(global_parts.year);
                }
                $('#vehicle-year-list').change();
            }
        });
        return false;
    });
	
    //年款信息改变获取车型信息
    $("#vehicle-year-list").change(function()
    {
        var yeartext = $('#vehicle-year-list').find("option").text();
        if(!yeartext){
            $("#vehicle-year-list").attr("disabled",true);
        }else{
            $("#vehicle-year-list").attr("disabled",false);
        }
		
        var url = Yii_jpdata_baseUrl + "/vehicle/epcModels";
        //判断如果厂家或车系为空,则下面全部为空
        var makeId = $('#vehicle-make-list').val();
        var seriesId = $('#vehicle-series-list').val();
        var year = $('#vehicle-year-list').val();
        if(!seriesId)
        {
            $('#vehicle-model-list').html("<option></option>");
            $('#vehicle-year-list').html("<option></option>");
            $('#vehicle-maingroup').html("<option></option>");
            return false;
        }
        $.ajax({
            url: url,
            type: "POST",
            data: {
                'make': makeId,
                'series': seriesId,
                'year':year
            },
            dataType: "json",
            success:function(data){
                var html = " ";
                if(data && typeof(data)=='object'){
                    for(i=0;i<data.length;i++){
                        html += "<option value="+data[i]['modelId']+">"+data[i]['name']+"</option>"
                    }
                }
                $('#vehicle-model-list').html(html);
                if(global_parts.model && global_parts.status++ == 4){
                    $("#vehicle-model-list").val(global_parts.model);
                }
                $('#vehicle-model-list').change();
            }
        });
        return false;
    });
	
    //主组查询
    $("#vehicle-model-list").change(function()
    { 
        //如果车型为空,则主组为空
        var modelId = $('#vehicle-model-list').val();
        if(!modelId){
            $('#vehicle-maingroup').html("<option></option>");
            return false;
        }
        var url = Yii_jpdata_baseUrl + "/parts/partChildGroups";
        $.ajax({
            url: url,
            type: "POST",
            data: {
                'modelId': modelId
            },
            dataType: "json",
            success:function(data){
                var html = " ";
                if(data && typeof(data)=='object'){
                    for(i=0;i<data.length;i++){
                        html += "<option value="+data[i]['groupId']+">"+data[i]['name']+"</option>"
                    }
                }
                $('#vehicle-maingroup').html(html);
                if(global_parts.maingroup && global_parts.status++ == 5){
                    $("#vehicle-maingroup").val(global_parts.maingroup);
                }
                $('#vehicle-maingroup').change();
            }
        });
        return false;
    });
	 
    //子组
    $("#vehicle-maingroup").change(function(){
        //如果主组值为null,子组显示无数据,禁止查询按钮(灰掉)
        var maingroupId = $('#vehicle-maingroup').val();
        if(!maingroupId)
        {
            $('#vehicle-group').html("<option></option>");
            $("#mm-vehicle-search").attr("disabled",true);
            return false;
        }
        else
        {
            $("#mm-vehicle-search").attr("disabled",false); 
        }
        var url = Yii_jpdata_baseUrl + "/parts/partChildGroups";
        var modelId = $('#vehicle-model-list').val();
          
        $.ajax({
            url: url,
            type: "POST",
            data: {
                'modelId': modelId,
                'groupId': maingroupId
            },
            dataType: "json",
            success:function(data){
                var html = " ";
                if(data && typeof(data)=='object'){
                    for(i=0;i<data.length;i++){
                        html += "<option value="+data[i]['groupId']+">"+data[i]['name']+"</option>"
                    }
                }
                $('#vehicle-group').html(html);
                if(global_parts.subgroup && global_parts.status++ == 6){
                    $("#vehicle-group").val(global_parts.subgroup);
                    $("#mm-vehicle-search").click();
                }
                var url=window.location.href;
                if(url.indexOf('-fromshouye')>0)
                {
                	  
                    $('#mm-vehicle-search').trigger('click');
                }
            }
        });
        return false;
    });
		
    //显示配件信息
    $("#mm-vehicle-search").click(function(){
    	  
        //删除放大效果层
        //$('.zoomContainer').remove();
        var makeId = $('#vehicle-make-list').val();
        var seriesId = $('#vehicle-series-list').val();
        var yearId = $('#vehicle-year-list').val();
        var modelId=$('#vehicle-model-list').val();
        var mainGroupId = $('#vehicle-maingroup').val();
        var groupId = $('#vehicle-group').val();
        if(!makeId || !modelId || !groupId || !mainGroupId){
            alert('请先选择厂家类别!');
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
                //$('#info-group').html(html);
                $("#tab-group .search-result .result-content").html(html);
                $("#tab-group .search-result").show();
                get_height_align('.sidebar','.content');
                window.location.hash = global_parts.hashPrefix + makeId + "-" + seriesId + "-" + yearId + "-" 
                + modelId + "-" + mainGroupId + "-" + groupId;
            }
        });
        return false;
    });

    //当输入的oe号包含*号时需要选择厂家
    $('#oeno').change(function(){
        var oeno = $.trim($('#oeno').val());
        if(oeno.indexOf('*') >= 0){
            $('#oeno-search-make-list').parent().show();
            // 选择厂家
            if(global_oe.make && global_oe.status == 2){
                $('#oeno-search-make-list').val(global_oe.make);
            }
        }else{
            $('#oeno-search-make-list').find("option[value='']").attr("selected","true");
            $('#oeno-search-make-list').parent().hide();
        }
        if(global_oe.status++ == 2){
            $('#oeno-search').click();
        }
    }).focus(function(){
        $('#oeno').prev('span').find('b').css({
            color:""
        });
    });
	
    //OE号查询
    $('#oeno-search').click(function(){
        var oeno = $.trim($('#oeno').val());
        var makeId = "";
        if(oeno == ''){
            alert('请输入OE号!');
            return false;
        }
        //如果oe号中带有*，则为部分匹配，需要选择厂商
        if(oeno.indexOf('*') >= 0){
            $('#oeno-search-make-list').parent().show();
            if(oeno.replace(/\*/g,'').length < 3){
                $('#oeno').nextAll('b').css({
                    color:"red"
                });
                return false;
            }
            makeId = $('#oeno-search-make-list').val();
            if(!makeId){
                return false;	
            }
        }else{
            $('#oeno-search-make-list').find("option[value='']").attr("selected","true");
            $('#oeno-search-make-list').parent().hide();
            if(oeno.length < 3){
                $('#oeno').nextAll('b').css({
                    color:"red"
                });
                $("#tab-oeno").find('.search-result').hide();
                return false;
            }
        }
        var url = Yii_jpdata_baseUrl + "/parts/searchPartsByOeno";
        $.ajax({
            url: url,
            type: "POST",
            data: {
                'oeno': oeno,
                'make': makeId
            },
            dataType: "html",
            success:function(html){
                //$('#info-oeno').html(html);
                //                $("#tab-oeno").find('.search-result').show();
                $("#tab-oeno .search-result").show();
                $("#tab-oeno .search-result .result-content").html(html);
                get_height_align('.sidebar','.content');
                var locationHash = global_oe.hashPrefix + oeno;
                if(makeId && makeId != '0') {
                    locationHash += "__" + makeId;
                }
                window.location.hash = locationHash;
            }
        });
        return false;
    });

    //配件名称改变时改变厂家
    $("#partname").change(function(){
        var partname = $.trim($('#partname').val());
        if(partname==''){
            $("#search-make-list").val("");
            //$('#search-make-list').html("<option value=''>--请选择厂家类别</option>");
            $('#search-series-list').html("<option value=''>--请选择车系名称</option>");
            $('#search-year-list').html("<option value=''>--请选择车型年款</option>");
            $('#search-model-list').html("<option value=''>--请选择车型名称</option>");	
            $("#search-make-list").attr("disabled",false);
            $('#search-series-list').attr("disabled",false);
            $('#search-year-list').attr("disabled",false);
            $('#search-model-list').attr("disabled",false);		
            return false;
        }
        if(partname.length < 2){
            $('#partname').parent().find('b').css({
                color:"red"
            });
            return false;
        }
    /*
 			var url = Yii_jpdata_baseUrl + "/vehicle/epcMakesWithPartname";
 		    $.ajax({
 		    	 url: url,
 		    	 type: "POST",
 		       	 data: {
 		       		 'partname': partname
 	   	   		 },
 		         dataType: "json",
 		         success:function(data){
 			         var html = "";
 			         if(data && typeof(data)=='object'){
 			         for(i=0;i<data.length;i++){
 			        	 html += "<option value='"+data[i]['makeId']+"'>"+data[i]['name']+"</option>"
 			         }
 			         }
 			         $('#search-make-list').html(html);
 			         if(global_name.make && global_name.status++ == 2){
 			        	 $("#search-make-list").val(global_name.make);
 			         }
    			     $('#search-make-list').change();
 		         }
 		    });
 		    return false;
 		    */
    }).focus(function(){
        //$('#partname').prev('span').find('b').css({color:""});
        $('#partname').parent().find('b').css({
            color:""
        });
    });
 	
    //改变厂家时获取车系信息
    $("#search-make-list").change(function(){
        /*
		var partname = $.trim($('#partname').val());
		if(partname==''){
			return false;
		}
		*/
        //判断如果厂家的值为0,则全部显示--请选择样式
        var makeId = $('#search-make-list').val();
        if(!makeId){
            $("#search-year-list").attr("disabled",false);
            $('#search-series-list').html("<option></option>");
            $('#search-year-list').html("<option></option>");
            $('#search-model-list').html("<option></option>");				
            return false;
        }
        //传递厂家的参数
        //var url = Yii_jpdata_baseUrl + "/vehicle/epcSeriesWithPartname";
        var url = Yii_jpdata_baseUrl + "/vehicle/epcSeries";
        $.ajax({
            url: url,
            type: "POST",
            data: {
                'make': makeId
            //'partname': partname
            },
            dataType: "json",
            success:function(data){
                var html = "";
                if(data && typeof(data)=='object'){
                    for(i=0;i<data.length;i++){
                        html += "<option value='"+data[i]['seriesId']+"'>"+data[i]['name']+"</option>"
                    }
                }
                $('#search-series-list').html(html);
                if(global_name.series && global_name.status++ == 3){
                    $("#search-series-list").val(global_name.series);
                }
                $('#search-series-list').change();
            }
        });
        return false;
    });	 

    //车系改变时获取年款信息
    $("#search-series-list").change(function(){
        /*
		var partname = $.trim($('#partname').val());
		if(partname==''){
			return false;
		}		
		*/	
        //判断车系为空时,全部为空
        var makeId = $('#search-make-list').val();
        var seriesId = $('#search-series-list').val();
        if(!seriesId){
            $("#search-year-list").attr("disabled",false);
            $('#search-year-list').html("<option></option>");
            $('#search-model-list').html("<option></option>");				
            return false;
        }
        //var url = Yii_jpdata_baseUrl + "/vehicle/epcSeriesYearsWithPartname";
        var url = Yii_jpdata_baseUrl + "/vehicle/epcSeriesYears";
        $.ajax({
            url: url,
            type: "POST",
            data: {
                'make': makeId,
                'series': seriesId
            //'partname': partname
            },
            dataType: "json",
            success:function(data){
                var html = " ";
                if(data && typeof(data)=='object'){
                    for(i=0;i<data.length;i++){
                        if(data[i]['year']){
                            html += "<option value='"+data[i]['year']+"'>"+data[i]['year']+"款"+"</option>";
                        }else{
                            html += "<option value=''></option>";
                        }
                    }
                }
                $('#search-year-list').html(html);
                if(global_name.year && global_name.status++ == 4){
                    $("#search-year-list").val(global_name.year);
                }
                $('#search-year-list').change();
            }
        });
        return false;
    });

    //年款信息改变获取车型信息
    $("#search-year-list").change(function(){
        /*
		var partname = $.trim($('#partname').val());
		if(partname==''){
			return false;
		}			
		*/
        var yeartext = $('#search-year-list').find("option").text();
        if(!yeartext){
            $("#search-year-list").attr("disabled",true);
        }else{
            $("#search-year-list").attr("disabled",false);
        }
		
        //var url = Yii_jpdata_baseUrl + "/vehicle/epcModelsWithPartname";
        var url = Yii_jpdata_baseUrl + "/vehicle/epcModels";
        //判断如果厂家或车系为空,则下面全部为空
        var makeId = $('#search-make-list').val();
        var seriesId = $('#search-series-list').val();
        var year = $('#search-year-list').val();
        if(!makeId || !seriesId){
            $('#search-model-list').html("<option></option>");
            return false;
        }
        $.ajax({
            url: url,
            type: "POST",
            data: {
                'make': makeId,
                'series': seriesId,
                'year':year
            //'partname': partname
            },
            dataType: "json",
            success:function(data){
                var html = " ";
                if(data && typeof(data)=='object'){
                    for(i=0;i<data.length;i++){
                        html += "<option value="+data[i]['modelId']+">"+data[i]['name']+"</option>"
                    }
                }
                $('#search-model-list').html(html);
                if(global_name.model && global_name.status++ == 5){
                    $("#search-model-list").val(global_name.model);
                    $('#partname-search').click();
                }
            }
        });
        return false;
    });

    //按名称搜索配件信息
    $('#partname-search').click(function(){
        var partname = $.trim($('#partname').val());
        if(partname==''){
            alert('请输入配件名称!');
            return false;
        }
        if(partname.length < 2){
            $('#partname').prev('span').find('b').css({
                color:"red"
            });
            return false;
        }
        var modelId = $('#search-model-list').val();
        if(!modelId || modelId=='0' || modelId==undefined){
            alert('请选择厂家类别!!');
            return false;
        }
        var makeval = $('#search-make-list').val();
        var seriesval = $('#search-series-list').val();
        var yearval = $('#search-year-list').val();
        var modelval = $('#search-model-list').val();
        // 显示加载信息
        $("#tab-partname .search-result").show();
        $("#tab-partname .search-result .result-content").html("");
        $("#tab-partname .search-result .result-loading").show();
        var url = Yii_jpdata_baseUrl + "/parts/searchPartsByPartname";
        $.ajax({
            url: url,
            type: "POST",
            data: {
                'modelId': modelId,
                'partname': partname
            },
            dataType: "html",
            success:function(html){
                //$('#info-partname').html(html);
                $("#tab-partname .search-result .result-loading").hide();
                $("#tab-partname .search-result").show();
                $("#tab-partname .search-result .result-content").html(html);
                get_height_align('.sidebar','.content');
                window.location.hash = global_name.hashPrefix + partname + "-" + makeval + "-" + seriesval + "-" + yearval + "-" + modelval;
            }
        });
        return false;
    });
});

//配件详细信息页面
$(document).delegate('.parts_detail','click',function(){   
    var infoobj = $(this).parents('.result-content');
    var modelId = $(this).attr('modelid');
    if(!modelId){
        return false;
    }
    var partId = $(this).attr('partid');
    if(!partId)
    {
        return false;
    }
    var hasPerm = $(this).attr('hasperm');
    if(hasPerm == '0'){
        alert("请购买相应的数据服务！");
        return false;
    }
    var url=Yii_jpdata_baseUrl+"/parts/partInfo";
    $.ajax({
        url: url,
        type: 'POST',
        data:{
            'partId': partId,
            'modelId':modelId
        },
        dataType: "html",
        success:function(html)
        {
            //$('#back-group').show();
            //$('#info-group').children('div').hide();
            //$('#img-part').hide();
            //$('#info-group').append(html);
            infoobj.parent().find('.info-back').show();
            infoobj.children('div').hide();
            infoobj.append(html);
        }
    });
});

//配件组详细信息页面
$(document).delegate('.group-detail','click',function(){   
    var infoobj = $(this).parents('.result-content');
    var modelId = $(this).attr('modelid');
    if(!modelId){
        return false;
    }
    var groupId = $(this).attr('groupid');
    if(!groupId)
    {
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
            //$('#back-oeno').show();
            //$('#info-oeno').children('div').hide();
            //$('#info-oeno').append(html);
            infoobj.parent().find('.info-back').show();
            infoobj.children('div').hide();
            infoobj.append(html);
        }
    });
    return false;
});

//返回上一级
$(document).delegate('.info-back','click',function(){
    var info = $(this).parents('.search-result').find('.result-content');
    if(info.children('div').length > 1){
        info.children('div:last').remove();
        info.children('div:last').show();
    }
    //是否隐藏返回按钮
    if(info.children('div').length <= 1){
        $(this).hide();
    }
});

//高度对齐函数
function get_height_align(ele1,ele2,$){
    var $ = $ || jQuery;
    var ele1 = $(ele1);
    if(!ele1 || ele1.length==0){
        return;
    }
    var ele2 = $(ele2);
    ele1.css({
        'height':'auto'
    }).addClass("auto_height");
    ele2.css({
        'height':'auto'
    }).addClass("auto_height");
    var e1_h = ele1.height(),
    e2_h = ele2.height();
    var lh = e1_h>e2_h?e1_h:e2_h;
    ele2.css({
        "min-height":lh
    });
    ele1.css({
        "min-height":lh
    });
    var fstat = $('.footer').css('position');
    if(fstat=='static' && $('body').height()<$(window).height()){
        $('.footer').css({
            position:'absolute',
            bottom:'0px',
            width:'100%',
            "z-index":-1
        });
    }else if(fstat=='absolute' && $('body').height()+100>$(window).height()){
        $('.footer').css({
            position:'static'
        });
    }
}