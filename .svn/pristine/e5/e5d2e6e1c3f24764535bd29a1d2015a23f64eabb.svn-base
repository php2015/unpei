<script>
    /*
     * 修理厂--主营登记
     */
    $(document).ready(function(){
        var routine = $("#showMain").html();
        var diagnos = $("#showDiagnos").html();
        var parts = $("#showParts").html();
        var repairs = $("#showRepair").html();
        //选择显示服务类型
        $("input[name='OrganType']").click(function(){
            var type=$(this).val();
            $("input[name=NewType]").val(type); //获取点击切换后的机构类型
            switch (type) {
                case '1': $("#deepclean").show(); $("#roumain").show(); $("#wearparts").show();
                    $("#carbeauty").hide(); $("#diagnos").hide(); $("#prorepair").hide();
                    $("#autoservice").hide(); break;
                case '2': $("#deepclean").show(); $("#carbeauty").show(); $("#roumain").show();
                    $("#wearparts").hide(); $("#diagnos").hide(); $("#prorepair").hide();
                    $("#autoservice").hide(); break;
                case '3': $("#deepclean").show(); $("#roumain").show(); $("#wearparts").show();
                    $("#diagnos").show(); $("#prorepair").show(); $("#autoservice").show();
                    $("#carbeauty").hide(); break;
                case '4': $("#deepclean").show(); $("#roumain").show(); $("#wearparts").show();
                    $("#diagnos").show(); $("#prorepair").show(); $("#autoservice").show();
                    $("#carbeauty").hide(); break;
            }
        });
        //选择添加或移除class样式
        $("input[name='OrganType']").click(function(){
            var type=$(this).val();
            var data=$("input[name=DataType]").val();
            if (type != data) {
                $(".clean").removeClass("bg-green");		//深度清洁
                $(".beauty").removeClass("bg-green");		//车辆美容
                $(".routine").removeClass("bg-green");		//日常保养-全车系
                $(".diagnos").removeClass("bg-green");		//检查诊断-全车系
                $(".parts").removeClass("bg-green");		//易损件更换-全车系
                $(".repair").removeClass("bg-green");		//专业修理-全车系
                $("#showMain div.mainspan").remove();		//日常保养-定向车系
                $("#showDiagnos div.diagspan").remove();       //检查诊断-定向车系
                $("#showParts div.partspan").remove();		//易损件更换-定向车系
                $("#showRepair div.repairspan").remove();      //专业修理-定向车系
                $("#partsname").combogrid("setValue","");	//易损件更换-易损件类别
                $("#reparange").combogrid("setValue","");	//专业修理-修理范围
                $("select[name=InsurType]").val("");		//车险服务-服务类别
                $("#insurance").combogrid("setValue","");	//车险服务-险企名称
                //清空select下拉框及combogrid文本框
                $("select").val("请选择品牌");
                $("#maincar").combogrid("setValue","");
                $("#diagcar").combogrid("setValue","");
                $("#partscar").combogrid("setValue","");
                $("#repaircar").combogrid("setValue","");
            }
            else {
                //清空select下拉框及combogrid文本框
                $("select").val("请选择品牌");
                $("#maincar").combogrid("setValue","");
                $("#diagcar").combogrid("setValue","");
                $("#partscar").combogrid("setValue","");
                $("#repaircar").combogrid("setValue","");
                var clean=$("input[name=DeepClean]").val();	    //深度清洁
                if (clean==$(".fdeep").text()) $(".fdeep").addClass("bg-green");
                if (clean==$(".sdeep").text()) $(".sdeep").addClass("bg-green");
                if (clean==$(".tdeep").text()) $(".tdeep").addClass("bg-green");
                var beauty=$("input[name=CarBeauty]").val();	//车辆美容
                if (beauty==$(".ficar").text()) $(".ficar").addClass("bg-green");
                if (beauty==$(".secar").text()) $(".secar").addClass("bg-green");
                if (beauty==$(".thcar").text()) $(".thcar").addClass("bg-green");
                if (beauty==$(".focar").text()) $(".focar").addClass("bg-green");
                var main=$("input[name=RouMain]").val();		//日常保养-全车系
                if (main==$(".routine").text()) $(".routine").addClass("bg-green");
                var diago=$("input[name=Diagnos]").val();		//检查诊断-全车系
                if (diago==$(".diagnos").text()) $(".diagnos").addClass("bg-green");
                var part=$("input[name=WearParts]").val();		//易损件更换-全车系
                if (part==$(".parts").text()) $(".parts").addClass("bg-green");
                var repair=$("input[name=ProRepair]").val();	//专业修理-全车系
                if (repair==$(".repair").text()) $(".repair").addClass("bg-green");
                $("#showMain").html(routine);           //日常保养-定向车系
                $("#showDiagnos").html(diagnos);	//检查诊断-定向车系
                $("#showParts").html(parts);            //易损件更换-定向车系
                $("#showRepair").html(repairs);          //专业修理-定向车系
                var partscate=$("input[name=partscate]").val(); //易损件更换-易损件类别
                $("#partsname").combogrid("setValue",partscate);	
                var repairrange=$("input[name=repairrange]").val();//专业修理-修理范围
                $("#reparange").combogrid("setValue",repairrange);
                var carinsur=$("input[name=carinsur]").val();	//车险服务-服务类别
                $("select[name=InsurType]").val(carinsur);		
                var insurname=$("input[name=insurname]").val();	//车险服务-险企名称
                $("#insurance").combogrid("setValue",insurname);
            }
        });
        $("#mainmake").change(function(){
            $("#maincar").combogrid("setValue","");     //品牌改变后，清空车系文本框
            var mainid = $(this).val();
            var url =  Yii_baseUrl+'/jpdata/vehicle/GoodsSeries';
            $.getJSON(url,{make:mainid},function(data){
                if(data){
                    $("#maincar").combogrid("grid").datagrid("loadData",data);
                }
            });
        });
        $("#diagmake").change(function(){
            $("#diagcar").combogrid("setValue","");     //品牌改变后，清空车系文本框
            var diagid = $(this).val();
            var url =  Yii_baseUrl+'/jpdata/vehicle/GoodsSeries';
            $.getJSON(url,{make:diagid},function(data){
                if(data)
                    $("#diagcar").combogrid("grid").datagrid("loadData",data);
            });
        });
        $("#partsmake").change(function(){
            $("#partscar").combogrid("setValue","");    //品牌改变后，清空车系文本框
            var partsid = $(this).val();
            var url =  Yii_baseUrl+'/jpdata/vehicle/GoodsSeries';
            $.getJSON(url,{make:partsid},function(data){
                if(data)
                    $("#partscar").combogrid("grid").datagrid("loadData",data);
            });
        });
        $("#repairmake").change(function(){
            $("#repaircar").combogrid("setValue","");   //品牌改变后，清空车系文本框
            var repairid = $(this).val();
            var url =  Yii_baseUrl+'/jpdata/vehicle/GoodsSeries';
            $.getJSON(url,{make:repairid},function(data){
                if(data)
                    $("#repaircar").combogrid("grid").datagrid("loadData",data);
            });
        });
        //添加日常保养品牌车系数据
        $("#addMain").click(function(){
            var make = $("#mainmake option[value='"+$("#mainmake").val()+"']").text();
            var car = $("#maincar").combogrid('getValues');
            if (make=="请选择品牌" || car=="请选择车系") {
                $.messager.alert("提示", "请选择品牌车系","warning");
                return false;
            } else if (make=="" || car=="") {
                $.messager.alert("提示", "请选择品牌车系","warning");
                return false;
            } else {
                var msg='';
                $("#showMain div").each(function(){
                    var makecp=$(this).find('span[name=mainmake]').html();
                    var carcp=$(this).find('span[name=maincar]').html();
                    if (make==makecp){	//相同品牌下对车系进行比较
                        var cararr = carcp.split(',');
                        for(var i=0;i<=cararr.length;i++)
                        {
                            if($.inArray(car[i],cararr)>=0){
                                msg='该车系已存在，请勿重复添加!';
                            }
                        }
                    }
                });
                if (msg=='') {
                    $("<div class='checkbox-add bg-green tag-close mainspan' style='margin-top:1px;'>"+
                        "<span name='mainmake'>"+make+"</span>: <span name='maincar'>"+car+"</span>"+　
                        "<i class='close icon-close-green' onclick='delMain(this)' key='0'></i>"+
                        "<input type='hidden' value='"+make+";"+car+"' name='main[]' len='main'></div>").appendTo("#showMain");
                } else {
                    $.messager.alert("提示", msg,"error");
                }
            }
        });
        //添加检测诊断品牌车系数据
        $("#addDiagnos").click(function(){
            var make = $("#diagmake option[value='"+$("#diagmake").val()+"']").text();
            var car = $("#diagcar").combogrid('getValues');
            if (make=="请选择品牌" || car=="请选择车系") {
                $.messager.alert("提示", "请选择品牌车系","warning");
                return false;
            } else if (make=="" || car=="") {
                $.messager.alert("提示", "请选择品牌车系","warning");
                return false;
            } else {
                var msg='';
                $("#showDiagnos div.diagspan").each(function(){
                    var makecp=$(this).find('span[name=diagmake]').html();
                    var carcp=$(this).find('span[name=diagcar]').html();
                    if (make==makecp){	//相同品牌下对车系进行比较
                        var cararr = carcp.split(',');
                        for(var i=0;i<=cararr.length;i++)
                        {
                            if($.inArray(car[i],cararr)>=0){
                                msg='该车系已存在，请勿重复添加!';
                            }
                        }
                    }
                });
                if (msg=='') {
                    $("<div class='checkbox-add bg-green tag-close diagspan' style='margin-top:1px;'>"+
                        "<span name='diagmake'>"+make+"</span>: <span name='diagcar'>"+car+"</span>"+　
                        "<i class='close icon-close-green' onclick='delDiag(this)' key='0'></i>"+
                        "<input type='hidden' value='"+make+";"+car+"' name='diag[]' len='diag'></div>").appendTo("#showDiagnos");
                } else {
                    $.messager.alert("提示", msg,"error");
                }
            }
        });
        //添加易损件更换品牌车系数据
        $("#addParts").click(function(){
            var make = $("#partsmake option[value='"+$("#partsmake").val()+"']").text();
            var car = $("#partscar").combogrid('getValues');
            if (make=="请选择品牌" || car=="请选择车系") {
                $.messager.alert("提示", "请选择品牌车系","warning");
                return false;
            } else if (make=="" || car=="") {
                $.messager.alert("提示", "请选择品牌车系","warning");
                return false;
            } else {
                var msg='';
                $("#showParts div.partspan").each(function(){
                    var makecp=$(this).find('span[name=partmake]').html();
                    var carcp=$(this).find('span[name=partcar]').html();
                    if (make==makecp){	//相同品牌下对车系进行比较
                        var cararr = carcp.split(',');
                        for(var i=0;i<=cararr.length;i++)
                        {
                            if($.inArray(car[i],cararr)>=0){
                                msg='该车系已存在，请勿重复添加!';
                            }
                        }
                    }
                });
                if (msg=='') {
                    $("<div class='checkbox-add bg-green tag-close partspan' style='margin-top:1px;'>"+
                        "<span name='partmake'>"+make+"</span>: <span name='partcar'>"+car+"</span>"+　
                        "<i class='close icon-close-green' onclick='delParts(this)' key='0'></i>"+
                        "<input type='hidden' value='"+make+";"+car+"' name='parts[]' len='part'></div>").appendTo("#showParts");
                } else {
                    $.messager.alert("提示", msg,"error");
                }
            }
        });
        //添加专业修理品牌车系数据
        $("#addRepair").click(function(){
            var make = $("#repairmake option[value='"+$("#repairmake").val()+"']").text();
            var car = $("#repaircar").combogrid('getValues');
            if (make=="请选择品牌" || car=="请选择车系") {
                $.messager.alert("提示", "请选择品牌车系","warning");
                return false;
            } else if (make=="" || car=="") {
                $.messager.alert("提示", "请选择品牌车系","warning");
                return false;
            } else {
                var msg='';
                $("#showRepair div.repairspan").each(function(){
                    var makecp=$(this).find('span[name=repairmake]').html();
                    var carcp=$(this).find('span[name=repaircar]').html();
                    if (make==makecp){	//相同品牌下对车系进行比较
                        var cararr = carcp.split(',');
                        for(var i=0;i<=cararr.length;i++)
                        {
                            if($.inArray(car[i],cararr)>=0){
                                msg='该车系已存在，请勿重复添加!';
                            }
                        }
                    }
                });
                if (msg=='') {
                    $("<div class='checkbox-add bg-green tag-close repairspan' style='margin-top:1px;'>"+
                        "<span name='repairmake'>"+make+"</span>: <span name='repaircar'>"+car+"</span>"+　
                        "<i class='close icon-close-green' onclick='delRepair(this)' key='0'></i>"+
                        "<input type='hidden' value='"+make+";"+car+"' name='repair[]' len='repair'></div>").appendTo("#showRepair");
                } else {
                    $.messager.alert("提示", msg,"error");
                }
            }
        });
        //深度清洁
        $(".clean").click(function(){
            var clean =  $(this).text();
            $("#DeepClean").val(clean);
        });
        //车辆美容
        $(".beauty").click(function(){
            var beauty =  $(this).text();
            $("#CarBeauty").val(beauty);		
        });
        //日常保养
        $(".routine").click(function(){
            var routine = $(this).text();
            $("#RouMain").val(routine);
        });
        //检测诊断
        $(".diagnos").click(function(){
            var diagnos = $(this).text();
            $("#Diagnos").val(diagnos);
        });
        //易损件更换
        $(".parts").click(function(){
            var parts = $(this).text();
            $("#WearParts").val(parts);
        });
        //专业修理
        $(".repair").click(function(){
            var repair = $(this).text();
            $("#ProRepair").val(repair);
        });
    });
    //删除日常保养
    function delMain(obj){
        var id = obj.getAttribute("key");
        if(id != 0) {
            var url = Yii_baseUrl + '/servicer/servicemaininfo/deletemain';
            $.getJSON(url,{id:id},function(data){
                if(data == 1)
                    $(obj).parent().remove();
            });
        } else {
            $(obj).parent().remove();
        }
    }
    //删除检测诊断
    function delDiag(obj){
        var id = obj.getAttribute("key");
        if(id != 0) {
            var url = Yii_baseUrl + '/servicer/servicemaininfo/deletediagnos';
            $.getJSON(url,{id:id},function(data){
                if(data == 1)
                    $(obj).parent().remove();
            });
        } else {
            $(obj).parent().remove();
        }
    }
    //删除易损件更换
    function delParts(obj){
        var id = obj.getAttribute("key");
        if(id != 0) {
            var url = Yii_baseUrl + '/servicer/servicemaininfo/deleteparts';
            $.getJSON(url,{id:id},function(data){
                if(data == 1)
                    $(obj).parent().remove();
            });
        } else {
            $(obj).parent().remove();
        }
    }
    //删除专业修理
    function delRepair(obj){
        var id = obj.getAttribute("key");
        if(id != 0) {
            var url = Yii_baseUrl + '/servicer/servicemaininfo/deleterepair';
            $.getJSON(url,{id:id},function(data){
                if(data == 1)
                    $(obj).parent().remove();
            });
        } else {
            $(obj).parent().remove();
        }
    }
</script>
