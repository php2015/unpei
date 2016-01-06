<?php
$this->pageTitle=Yii::app()->name.' - 账户信息管理';
if (Yii::app()->user->Identity=="maker"){
	$url = Yii::app()->createUrl("");
}elseif (Yii::app()->user->Identity=="dealer"){
	$url = Yii::app()->createUrl("common/dealmemberlist");
}else {
	$url = Yii::app()->createUrl("common/memberlist");
}
$this->breadcrumbs = array(
    '用户中心' => $url,
    '账户信息管理',
);
?>
<style>
    .jg_show { margin:10px 20px}
    .jg_show ul li{ float:left; margin:10px; border:1px solid #ebebeb; padding:5px }
    .jg_show ul li img{ width:200px; height:150px}
    .row {line-heigh:25px;margin:10px 10px 5px 0px;}
	.gs_info{margin:30px}
</style>
<link rel="stylesheet" href="<?php echo F::themeUrl(); ?>/css/companymanage.css">
<div class="bor_back m-top" style="height:850px">
    <p class="txxx txxx3">账户信息管理</p>
    <div class="txxx_info4">
        <div  style="border-bottom:1px solid #cbd7e5; padding-bottom:20px; margin:10px 20px">
            <div class="float_l"><img width="100" height="100" src="<?php echo F::uploadUrl() . ($model->organ->Logo ? $model->organ->Logo : 'logo/touxiang.jpg'); ?>"></div>
            <div class="float_l m_left20">
                <p class="f_weight">用户名：<span><?php echo $model->UserName; ?></span></p>
                <ul  class="membership">
                    <li class="mem_leibie">账户类别：<span><?php echo $model->organ->Type; ?></span></li>
                    <li class="mem_effective">账户有效期：<span><?php echo date("Y-m-d H:i:s", $model->organ->CreateTime) . " 至 " .($model->organ->ExpirationTime?date("Y-m-d H:i:s", $model->organ->ExpirationTime): '2020-01-01') ?></span></li>
                    <li class="mem_status">认证状态：<span class="renzheng"><?php echo $model->organ->IsAuth ? "已认证" : "未认证" ?></span></li>
                    <li class="mem_effective">上次登录：<span><?php echo date("Y-m-d H:i:s", $lasttime); ?></span></li>
                </ul>



            </div>

            <div style="clear:both"></div>
        </div>
        <div class="essential m-top20 m_left24">
            <ul style="background:#f3f3f3; height:30px">
                <li class="current touxiang_tm" id="jbxx" style="margin-left:10px"><span class="title">基本信息</span>
                    
                </li>
                <li class="touxiang_tm" id="logo"><span class="title">logo设置</span>
                    
                </li>
                <div style="clear:both"></div>                   
            </ul>
            <div class="gs_info" style="margin-top:35px;" >
                        <?php
                        $form = $this->beginWidget('CActiveForm', array(
                            'id' => 'infomanager-form',
                            'enableAjaxValidation' => true,
                            'enableClientValidation' => true,
                            'action' => Yii::app()->createUrl("member/infomanager/update"),
                            'clientOptions' => array('validateOnSubmit' => true)
                                ));
                        ?>
                        <div class="row"><label class="m_left12">用户名：</label><span><?php echo $model->UserName; ?></span></div>
                        <?php
                        if ($model->organ->Identity == 1) {
                            $userType = "生产商";
                        } elseif ($model->organ->Identity == 2) {
                            $userType = "经销商";
                        } elseif ($model->organ->Identity == 3) {
                            $userType = "修理厂";
                        }
                        ?>
                        <div class="row">
                            <label>机构类型：</label>
                            <span><?php echo $userType; ?></span>
                        </div>
                        <div class="row">
                            <label>机构名称：</label>
                            <span class="name" style="width:auto"><?php echo $model->organ->OrganName; ?></span>
                            <?php echo $form->textField($model['organ'], 'OrganName', array('class' => 'width200 input editor')); ?>
                            <span class="color_red editor">*</span>
                            <?php echo $form->error($model['organ'], 'OrganName', array('class' => 'editor', 'style' => 'color: red;')); ?>
                        </div>
                        <div class="row">
                            <label class="m_left24">邮箱：</label>
                            <span class="name"><?php echo $model->organ->Email ?></span>
                            <?php echo $form->textField($model['organ'], 'Email', array('class' => 'width200 input editor')); ?>
                            <span class="color_red editor">*</span>
                            <?php echo $form->error($model['organ'], 'Email', array('class' => 'editor', 'style' => 'color: red;')); ?>
                        </div>
                        <div class="row">
                            <label class="m_left24">qq号：</label>
                            <span class="name"><?php echo $model->organ->QQ ?></span>
                            <?php echo $form->textField($model['organ'], 'QQ', array('class' => 'width200 input editor')); ?>
                            <?php echo $form->error($model['organ'], 'QQ', array('class' => 'editor', 'style' => 'color: red;')); ?>
                        </div>
                        <div class="row">
                            <label class="m_left24">手机：</label>
                            <span class="name"><?php echo $model->organ->Phone ?></span>
                            <?php echo $form->textField($model['organ'], 'Phone', array('class' => 'width200 input editor')); ?>
                            <span class="color_red editor">*</span>
                            <?php echo $form->error($model['organ'], 'Phone', array('class' => 'editor', 'style' => 'color: red;')); ?>
                        </div>
                        <div class="row">
                            <label class="m_left24">传真：</label>
                            <span class="name"><?php echo $model->organ->Fax ?></span>
                            <?php echo $form->textField($model['organ'], 'Fax', array('class' => 'width200 input editor')); ?>
                            <?php echo $form->error($model['organ'], 'Fax', array('class' => 'editor', 'style' => 'color: red;')); ?>
                        </div>
                        <div class="row editor">
                            <label class="m_left12 editor">验证码：
                                <?php
                                $this->widget('CCaptcha', array(
                                    'showRefreshButton' => true,
                                    'clickableImage' => true,
                                    'id' => 'abcd',
                                    'buttonLabel' => '换一张',
                                    'imageOptions' => array('align' => 'absmiddle'),
                                ));
                                ?></label>
                            <?php echo $form->textField($model['organ'], 'verifyCode', array('class' => 'input editor', 'style' => 'width: 80px')); ?>
                            <?php echo $form->error($model['organ'], 'verifyCode', array('class' => 'editor', 'style' => 'color: red;')); ?>
                        </div>
                        <?php $this->endWidget(); ?>
                        <p><button class="button3 editorbutton" >修改</button></p>
                        <p class="save_editor"><input id="save" type="submit" value="保存"  class="submit f_weight" ><button id="cancel" class="button3" >取消</button></p>
                    </div>
                    <div class="jg_show" style="display:none;margin-top:35px;">
                        <form action="<?php echo Yii::app()->createUrl("member/infomanager/editlogo"); ?>" method="post" enctype="multipart/form-data">
                            <input class="upload" name="Logo" id="files" type="file">
                            <p><button id="submit" type="submit" class="button" >上传</button></p>
                        </form> 

                    </div>
        </div>
    </div>


</div>
<script>
    $(document).ready(function(){	
        //判断机构名称不能为空
    	$("#Organ_OrganName").blur(function(){
        	if($("#Organ_OrganName").val()==""){
                alert("机构名称不能为空");
                $("#Organ_OrganName").addClass("input1");
                return false;
            }else{
            	$("#Organ_OrganName").removeClass("input1");
            }
        })

        //LOGO上传不为空验证
        $("#submit").live('click',function(){
            if($("#files").val()==""){
                alert("还未选择LOGO图片！");
                return false;
            }else{
                var arr = ["jpg","jpeg","gif","png"];
                if($.inArray($("#files").val().split(".").pop(), arr)==-1){
                    //格式不正确
                    alert("LOGO暂时只支持jpg,gif,png格式图片！");
                    return false;
                }
            }
        })
        $("#cancel").click(function(){
            $(".editor").css("display","none"); 
            $(".name").css("display","inline-block"); 
            $(".editorbutton").css("display","block"); 
            $(".save_editor").css("display","none");

        })
        $("#save").click(function(){
            var code=$('#Organ_verifyCode').val();
            if(code==''){
                alert('请输入验证码!');
                return false;
            }
            //验证验证码是否正确
            var url=Yii_baseUrl + "/member/infomanager/checkcode";
            $.getJSON(url,{'code':code},function(res){
                if(res.success===1){
                    if($("#Organ_OrganName").val()===""){
                        alert("机构名称不能为空");
                        $("#Organ_OrganName").addClass("input1");
                        return false;
                    }else{
                    	$("#Organ_OrganName").removeClass("input1");
                    }
                    $("#infomanager-form").submit();
                }
                else if(res.success===2){
                    $('#Organ_verifyCode').val('');
                    var img = new Image;
                    img.onload=function(){
                        $('#abcd').trigger('click');
                    }
                    img.src = $('#abcd').attr('src');
                    alert('验证码错误');
                }
            })
        })
        function avatar_success()
        {
            alert("头像保存成功"); 
            location.href="./";
        }
        $("#jbxx").click(function(){
    		  $(".gs_info").css("display","block"); 
    		  $(".jg_show").css("display","none"); 
    		  $(this).addClass("current");
    		  $("#logo").removeClass("current");

    	})
    	$("#logo").click(function(){
    		  $(".jg_show").css("display","block"); 
    		  $(".gs_info").css("display","none"); 
    		  $(this).addClass("current");
    		  $("#jbxx").removeClass("current");

    	})
    	$("p .editorbutton").click(function(){ 
    	 $(".editor").css("display","inline-block"); 
    	 $(".name").css("display","none"); 
    	 $(this).css("display","none"); 
    	 $(".save_editor").css("display","block");

		})
    })
    
    $(function(){
        //页面刷新验证码也改变
        var img = new Image;
        img.onload=function(){
            $('#abcd').trigger('click');
        }
        img.src = $('#abcd').attr('src');
    })
</script>