/* 
 * 服务支持js文件
 */
$(function() {
    //选择省后获取市信息
    $('select[name=Province]').change(function(){
        $('select[name=City]').empty();
        $.post(
            Yii_baseUrl + "/servicer/servicesupport/getcity",
            {city: $(this).val()},
            function(result) {
                for(var i=0;i<result.length;i++){
                    $('select[name=City]').append('<option value="'+result[i]['ID']+'">'+result[i]['Name']+'</option>');
                }
                if($('select[name=City]').attr('tt')){
                    $('select[name=City]').val($('select[name=City]').attr('tt'));
                }
            },
            'json'
        );
    });
    
    //表格-鼠标经过背景不变色
    $("table.parts-info .djw-tr").live('mouseover',function(){
        $(this).css("background","#ffefe0");       
    });
    $("table.parts-info .djw-tr2").live('mouseover',function(){
        $(this).css("background","#fff");       
    });
    //配件登记表格
    $("table #table_body tr").live('mouseover',function(){
        $(this).css("background","#fff");       
    });
    
    //配件登记弹出窗
    $("#part_register").click(function(){
        if($("input[name=CarID]").val() !== ""){
            $.post(
                Yii_baseUrl + "/servicer/servicesupport/addpartsdialog",
                {id: "",CarID:$("input[name=CarID]").val()},
                function(html) {
                    $("#addparts").html(html);
                    $("#addparts").dialog('open');
                },
                'html'
            );
        }else{
            alert("请先通过车牌号检索车辆！");
        }
    });
    
    //修改配件登记
    $(".edit_part").live('click', function(){
        $.post(
            Yii_baseUrl + "/servicer/servicesupport/addpartsdialog",
            {id: $(this).attr('key'),CarID:$("input[name=CarID]").val()},
            function(html) {
                $("#addparts").html(html);
                $("#addparts").dialog('open');
            },
            'html'
        );
    });
    
    //删除配件登记
    $(".del_part").live('click', function(){
        if(confirm("确认删除？")){
            $.post(
                Yii_baseUrl + "/servicer/servicesupport/delpartsdata",
                {id: $(this).attr('key')},
                function(result) {
                    if(result)
                    location.href = Yii_baseUrl + '/servicer/servicesupport/index?LicensePlate=' + encodeURI(encodeURI($("#LicensePlate").val()));
                },
                'json'
            );
        }
    });
    
    //弹出窗JS  添加保养项目
    $("#tjbyxm").live("click",function() {
        $("#add_item").tmpl().appendTo("#table_body");
    });
    //添加商品
//    $(".tjsp").live('click', function() {
//        var num = Number($(this).parent().parent().find("td:first input[type=hidden]").val()) + 1;
//        $(this).parent().parent().find("td:first input[type=hidden]").val(num);
//        $(this).parent().attr("rowspan", num);
//        $(this).parent().parent().find("td:first").attr("rowspan", num);
//        var tr = $(this).parent().parent();
//        for(var i=2;i<num;i++){
//            tr = tr.next();
//        }
//        tr.after($("#add_parts").tmpl());
//    });
    $(".xjd3").live('click', function() {
        var click_div = $(this).parent().parent();
        $(this).removeClass("xjd3");
        //$(this).addClass("scsp");//html('<img class="scsp" src="'+Yii_theme_baseUrl+'/images/support/del.bmp" />');
        var num = Number(click_div.parent().find("div:first input[type=hidden]").val()) + 1;
        click_div.parent().find("div:first input[type=hidden]").val(num);
        click_div.parent().find("div:first").css("height",(27*num + 5*(num-1)));
        click_div.parent().find("div:first").css("line-height",(27*num + 5*(num-1))+"px");
        click_div.after($("#add_parts").tmpl());
    });
    
    //删除商品
    $(".scsp").live('click',function(){
        var click_div = $(this).parent().parent();
        var delID = click_div.find("div:first input[type=hidden]").val();
        var delIDs = $("#delID").val();
        if(delIDs && delID){
            $("#delID").val(delIDs+","+delID);
        }else{
            $("#delID").val(delID);
        }
        var num = Number(click_div.parent().find("div:first input[type=hidden]").val()) - 1;
        if(num === 0){
            click_div.parent().remove();
        }else{
            if($(this).prev().attr("class") !== "f_l"){
                click_div.prev().find(".parts_caozuo").find("span:first").addClass("xjd3");
            }
            click_div.parent().find("div:first input[type=hidden]").val(num);
            click_div.parent().find("div:first").css("height",(27*num + 5*(num-1)));
            click_div.parent().find("div:first").css("line-height",(27*num + 5*(num-1))+"px");
            click_div.remove();
        }
    });
    
    
    //点击添加服务支持信息
    $("#add").click(function(){
        $(".support input[type=text]").each(function(){
            $(this).val("");
        });
        $(".support select").each(function(){
            $(this).val("");
        });
        $(".dis-block").css("display","none");
        $(".dis-none").css("display","inline-block");
    });
    
    //添加服务支持信息
    $("#save_service_data").click(function(){
        var isAdd = 0;
        $.ajaxSetup({
            async : false
        });
        //表单验证
        if($("input[name=LicensePlate]").val() === ""){
            $("input[name=LicensePlate]").addClass("input1");
            alert("车牌号不能为空！");
            return false;
        }else{
            $.post(
                Yii_baseUrl + "/servicer/servicesupport/checkservicedata",
                {LicensePlate:$("input[name=LicensePlate]").val()},
                function(result){
                    if(result){
                        isAdd = 1;
                        $("input[name=LicensePlate]").addClass("input1");
                        alert("车牌号已添加，请勿重复操作！");
                    }
                },
                'json'
            );
        }
        if($("input[name=OwnerName]").val() === ""){
            $("input[name=OwnerName]").addClass("input1");
            alert("车主姓名不能为空！");
            return false;
        }
        if($("input[name=Car]").val() === ""){
            $("input[name=Car]").addClass("input1");
            alert("汽车品牌不能为空！");
            return false;
        }
        if($("input[name=BuyTime]").val() === ""){
            $("input[name=BuyTime]").addClass("input1");
            alert("购置时间不能为空！");
            return false;
        }
        if($("input[name=Mileage]").val() === ""){
            $("input[name=Mileage]").addClass("input1");
            alert("行驶里程不能为空！");
            return false;
        }
        if($("select[name=Relation]").val() === ""){
            $("select[name=Relation]").addClass("input1");
            alert("请选择服务关系！");
            return false;
        }
        if($("input[name=Email]").val()!=="" && !$("input[name=Email]").val().match(/^\w+((-\w+)|(\.\w+))*\@[A-Za-z0-9]+((\.|-)[A-Za-z0-9]+)*\.[A-Za-z0-9]+$/)){
            alert("请正确填写邮箱地址，例如:123456789@qq.com");
            return false;
        }
        if ($("input[name=QQ]").val() !== "" && !$("input[name=QQ]").val().match(/^\d{5,10}$/)) {
            alert("请正确填写QQ号码，例如:15764179");
            return false;
        }
        if($("input[name=Phone]").val() === ""){
            $("input[name=Phone]").addClass("input1");
            alert("手机号不能为空！");
            return false;
        }
        if (!$("input[name=Phone]").val().match(/^1[3|4|5|8][0-9]\d{4,8}$/)) {
            alert("请正确填写手机号码，例如:13412341234");
            return false;
        }
        if($("input[name=DrivingLicense]").val() === ""){
            $("input[name=DrivingLicense]").addClass("input1");
            alert("驾驶证号不能为空！");
            return false;
        }
        if(isAdd === 0){
            $.post(
                Yii_baseUrl + "/servicer/servicesupport/addservicedata",
                $("#service_support_form").serialize(),
                function(result){
                    alert(result.msg);
                    if(result.result){
                        location.href = Yii_baseUrl + "/servicer/servicesupport/index?LicensePlate=" + encodeURI(encodeURI($("input[name=LicensePlate]").val()));
                    }
                },
                'json'
            );
            //$("#service_support_form").submit();
        }
    });
    
    //输入框失去焦点事件
    $(".support input[type=text]").blur(function(){
        if($(this).attr('name') === "Phone"){
            if($(this).val()!=="" && !$(this).val().match(/^1[3|4|5|8][0-9]\d{4,8}$/)){
                $(this).addClass("input1");
                alert("请正确填写手机号码，例如:13412345678");
            } else {
                $(this).removeClass("input1");
            }
        }else if($(this).attr('name') === "Email"){
            if($(this).val()!=="" && !$(this).val().match(/^\w+((-\w+)|(\.\w+))*\@[A-Za-z0-9]+((\.|-)[A-Za-z0-9]+)*\.[A-Za-z0-9]+$/)){
                $(this).addClass("input1");
                alert("请正确填写邮箱地址，例如:123456789@qq.com");
            } else {
                $(this).removeClass("input1");
            }
        }else if($(this).attr('name') === "QQ"){
            if($(this).val()!=="" && !$(this).val().match(/^\d{5,10}$/)){
                $(this).addClass("input1");
                alert("请正确填写QQ号码，例如:15764179");
            } else {
                $(this).removeClass("input1");
            }
        }else{
            if($(this).val()!==""){
                $(this).removeClass("input1");
            }
        }
    });
    
    //取消添加服务支持信息
    $("#cancel_save").click(function(){
//        $(".support input[type=text]").each(function(){
//            $(this).val("");
//        });
//        $(".support select").each(function(){
//            $(this).val("");
//        });
//        $(".dis-none").css("display","none");
//        $(".dis-block").css("display","inline-block");
        location.href = Yii_baseUrl + '/servicer/servicesupport/index';
    });
    
    //添加商品数量
    $(".add_quantity").live('click',function(){
        var item = $(this).parent().find("input[type=text]");
        var orig = Number(item.val());
        item.val(orig + 1);
        item.keyup();
    });
    
    //减少商品数量
    $(".decrease_quantity").live('click',function(){
        var item = $(this).parent().find("input[type=text]");
        var orig = Number(item.val());
        if (orig > 0)
        {
            item.val(orig - 1);
            item.keyup();
        }
    });
    
    //输入商品数量
    $(".num").live('keyup',function(){
        var val = this.value;
        if (val < 0)
        {
            this.value = 0;
        }
        if (val === "")
        {
            this.value = 0;
        }
        if (val > 100)
        {
            alert('最多只能100件');
            this.value = 100;
        }
        else if (isNaN(val))
        {
            alert('只能输入数字！');
            this.value = 0;
        }
        this.value = this.value.replace(/\D/g, '');
    });
    
    $(".num").live('focus',function(){
        var val = this.value;
        if(val==0){
            $(this).attr("value","");
        }
    });
    
    $(".num").live('blur',function(){
        var val = this.value;
        if(val==""){
            $(this).attr("value",0);
        }
    });    
    
    //保存、修改配件登记
    $("#add_parts_form").live("click",function() {
        var re = 0;
        if ($("#add_parts_mileage").val() === "") {
            $("#add_parts_mileage").addClass("input1");
            return false;
        }
        $("#addparts-form :input").each(function() {
            var name = $(this).attr("name");
            if (name === "Item[]" && $(this).val() === "0") {
                $(this).parent().addClass("input1");
                re = 1;
                return false;
            } else {
                $(this).parent().removeClass("input1");
            }
            if (name === "PartName[]" && $(this).val() === "") {
                $(this).addClass("input1");
                re = 1;
                return false;
            } else {
                $(this).removeClass("input1");
            }
            if (name === "num[]" && $(this).val() === "0") {
                $(this).addClass("input1");
                re = 1;
                return false;
            } else {
                $(this).removeClass("input1");
            }
        });
        if (re === 0) {
            $("#addparts-form").submit();
        }
    });

    $("#add_parts_mileage").blur(function() {
        if ($("#add_parts_mileage").val() !== "") {
            $("#add_parts_mileage").removeClass("input1");
        }
    });
    $("select[name='Item[]']").live('change', function() {
        if ($("select[name='Item[]']").val() !== "0") {
            $(this).parent().removeClass("input1");
        }
    });
    $("input[name='PartName[]']").blur(function() {
        if ($("input[name='PartName[]']").val() !== "") {
            $("input[name='PartName[]']").removeClass("input1");
        }
    });
    $("input[name='num[]']").keyup(function() {
        if ($("input[name='num[]']").val() !== "") {
            $("input[name='num[]']").removeClass("input1");
        }
    });

    //关闭
    $("#close_dialog").live('click', function() {
        $("#addparts").dialog("close");
        ajaxLoadEnd();//关闭遮罩层
    });

    //处理IE中maxlength无用问题
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
});

