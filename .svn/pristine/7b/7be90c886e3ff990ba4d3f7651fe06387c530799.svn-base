/*公司信息管理*/

$(document).ready(function(){	
	$("span.guanbi3").click(function(){ $(this).parent().css("display","none");

	})
     $("p .editorbutton").click(function(){ 
    	 $(".editor").css("display","inline-block"); 
    	 $(".name").css("display","none"); 
    	 $(this).css("display","none"); 
    	 $(".save_editor").css("display","block");

	});
	 $("li.touxiang_tm").click(function(){
		  $(this).children().css("display","block"); 
		  $(this).siblings().children("div").css("display","none"); 
		  $(this).addClass("current");
		  $(this).siblings().removeClass("current");

	});
	
	/*
	 * 公司信息修改
	 */
	$("#modif").click(function(){
		$("#show").hide();
		$("#edit").show();
	});
        
        //限制IE文本域最大输入数
        $("textarea[maxlength]").keyup(function(){
            var area=$(this);
            var max=parseInt(area.attr("maxlength"),10); //获取maxlength的值
            if(max>0){
                if(area.val().length>max){ //textarea的文本长度大于maxlength
                    area.val(area.val().substr(0,max)); //截断textarea的文本重新赋值
                }
            }
        });
        //复制的字符处理问题
        $("textarea[maxlength]").blur(function(){
            var area=$(this);
            var max=parseInt(area.attr("maxlength"),10); //获取maxlength的值
            if(max>0){
                if(area.val().length>max){ //textarea的文本长度大于maxlength
                    area.val(area.val().substr(0,max)); //截断textarea的文本重新赋值
                }
            }
        }); 
        
        $("#save").click(function(){
            var name=$("#Organ_OrganName").val();
            var mobilephone=$("#Organ_Phone").val();
            var email=$("#Organ_Email").val();
            var qq = $("#Organ_QQ").val();
            $.getJSON(Yii_baseUrl+'/member/company/checkorgan',{
                name:name,
                mobilephone:mobilephone,
                email:email,
                qq:qq
            },function(result){
                if(result.result){
                    if($("#Organ_OrganName").val()==""){
                        alert("机构名称不能为空！");
                        return false;
                    }
                    if($("#Organ_Introduction").val()==""){
                        alert("机构简介不能为空！");
                        return false;
                    }
                    if ($("#showimglist").find("li").length == 0) {
                        alert("您还没有上传机构图片！");
                        return false;
                    }
                    if($("#Organ_Phone").val()==""){
                        alert("手机号码不能为空！");
                        return false;
                    }
                    if(!$("#Organ_Phone").val().match(/^1[3|4|5|8][0-9]\d{4,8}$/)){
                        alert("请正确填写手机号码，例如:13412341234");
                        return false;
                    }
                    if($("#Organ_Email").val()==""){
                        alert("邮箱地址不能为空！");
                        return false;
                    }
                    if(!$("#Organ_Email").val().match(/^\w+((-\w+)|(\.\w+))*\@[A-Za-z0-9]+((\.|-)[A-Za-z0-9]+)*\.[A-Za-z0-9]+$/)){
                        alert("请正确填写邮箱地址，例如:123456789@qq.com");
                        return false;
                    }
                    var num = 0;
                    $(".telPhone").each(function(){
                        if($(this).val() == ""){
                            num++;
                        }
                    });
                    if(num == 4){
                        alert("至少填写一个座机号码！");
                        return false;
                    }
                    if($("#Organ_Area").val()==""){
                        alert("地址不能为空！");
                        return false;
                    }
                    if(!$("#Organ_QQ").val()=="" && !$("#Organ_QQ").val().match(/^\d{5,12}$/)){
                        alert("请正确填写QQ号码，例如:15764179");
                        return false;
                    }
                    if(!$("#Organ_Fax").val()=="" && !$("#Organ_Fax").val().match(/^[+]{0,1}(\d){1,3}[ ]?([-]?((\d)|[ ]){1,12})+$/)){
                        alert("请正确填写传真号,例如：10-88888888");
                        return false;
                    }
                    if(!$("#Organ_Registration").val()=="" && !$("#Organ_Registration").val().match(/^\d{12,18}$/)){
                        alert("请填写12-18位的数字注册号()，例如:123451234512345");
                        return false;
                    }
                    if(!confirm('你确定要保存吗？')) return false;
                    $("#organdataform").submit();
                }else{
                    alert(result.message);
                }
            });
            
        });
        //删除图片事件
        $("#delfile").live('click',function(){
        	$("#file_upload").uploadify('disable',false);
            var photoId=$(this).attr('keyid');
            if(typeof(photoId) != "undefined"){
                var phIds=$("#photoId").val();
                if(phIds!=''){
                    var photoIds=phIds+','+photoId;
                }else{
                    var photoIds=photoId;
                }
                $("#photoId").val(photoIds);
            }
            $(this).parent().remove();
        });
});