<style>
    .gs_info p{ line-height:23px; margin-top:15px}
    .gs_info span{ margin-left:10px;}
    .redremind{border:1px solid red !important;}
    .fail{color:red;display:none}
</style>
<?php
$this->pageTitle = Yii::app()->name . ' - 客服管理';
$id = Yii::app()->request->getParam('id');
if ($id) {
    $this->breadcrumbs = array(
        '营销管理' => Yii::app()->createUrl('common/marketlist'),
        '营销参数设置' => Yii::app()->createUrl('pap/discountset/index'),
        '客服管理' => Yii::app()->createUrl('pap/cs/index'),
        '修改客服'
    );
} else {
    $this->breadcrumbs = array(
        '营销管理' => Yii::app()->createUrl('common/marketlist'),
        '营销参数设置' => Yii::app()->createUrl('pap/discountset/index'),
        '客服管理' => Yii::app()->createUrl('pap/cs/index'),
        '添加客服'
    );
}
?>
<div class="bor_back m-top">
    <p class="txxx">
        客服信息
        <span style="float:right;margin-right:10px;"><a href="<?php echo Yii::app()->createUrl('pap/cs/index'); ?>" style="font-size:14px;color:#0065bf;">返回</a></span>
    </p>

    <div  style="margin-left:2px">
        <div class="txxx_info4 gs_info">  
            <div style="margin-left:20px;margin-bottom:10px;" id="cs">         
                <p>
                    <label>客服名称：</label>
                    <input type="text" class="width250 input required" maxlength="4" id="Name" value="<?php echo $datas['Name']; ?>">       
                    <span style="color:red;margin-left:3px;">(名称必填且长度不超过4个字符)</span>
                </p>
                <p>
                    <label style="margin-left:36px;">qq：</label>
                    <input type="text" maxlength="20" class="width250 input required" maxlength="20" id="QQ" value="<?php echo $datas['QQ']; ?>" check="qq">  
                    <span style="color:red;margin-left:3px;">(*)</span><span class="fail">qq号格式不正确!</span>
                </p>
                <p style="padding-left:200px;"><button class="submit" id="save">提交</button></p>
            </div>
        </div>
    </div>
</div>
<?php
$this->beginWidget('zii.widgets.jui.CJuiDialog', array(
    'id' => 'reminddg', //弹窗ID  
    'options' => array(//传递给JUI插件的参数  
        'title' => '操作提示',
        'autoOpen' => false, //是否自动打开  
        'width' => '300px', //宽度  
        'height' => 'auto', //高度  
        'buttons' => array(
            '关闭' => 'js:function(){ $(this).dialog("close");}', //关闭按钮  
        ),
    ),
));

$this->endWidget('zii.widgets.jui.CJuiDialog');
?>
<script>
    $(function(){
        //必填项提示
        $('.required').blur(function(){
            if($(this).val()==''){
                $(this).addClass('redremind');
            }else{
                $(this).removeClass('redremind');
            }    
        })
    
        //手机号验证
        $('input[check]').blur(function(){
            var value=$(this).val().replace(/^\s+|\s+$/g,"");
            var type=$(this).attr('check')
            if(value!=''){
                if(type=='qq')
                    var reg=/^[1-9]\d{4,10}$/;
                if(!reg.test(value))
                {
                    $(this).addClass('redremind');
                    $(this).nextAll('.fail').show();
                }else{
                    $(this).nextAll('.fail').hide();
                    $(this).removeClass('redremind');       
                }
            }else{
                $(this).nextAll('.fail').hide();
            }
        })
        
        //提交问题表单
        $('#save').click(function(){
            var id="<?php echo $_GET['id'];?>";
            var submit=1;
            var name=$('#Name').val();
            if(name==''){
                submit=0;
                $('#Name').addClass('redremind');
            }
            //验证qq格式是否正确
            var qq=$('#QQ').val().replace(/^\s+|\s+$/g,"");
            var reg=/^[1-9]\d{4,10}$/;  
            if(qq!='')
            {
                if(!reg.test(qq))
                {
                    submit=0;
                    $(this).addClass('redremind');
                    $(this).nextAll('.fail').show();
                }else{
                    $(this).removeClass('redremind');
                    $(this).nextAll('.fail').hide();
                }
            }else{
                submit=0;
                $('#QQ').addClass('redremind');
            }
            if(submit==0)
                return false;
            var url=Yii_baseUrl+'/pap/cs/new';
            $('#save').attr('disabled',true);
            $.ajax({
                url: url,
                dataType:'json',
                type:'post',
                data:{'id':id,'Name':name,'QQ':qq},
                success: function(res){
                    if(res.res==1){
                        $("#reminddg").html('<span class="color_blue">客服保存成功,跳转到客服列表页!</span>');
                        $("#reminddg").dialog("open");
                        var url=Yii_baseUrl+'/pap/cs/index';
                        setTimeout("window.location.href='"+url+"'",1000);
                    }else if(res.res==0){
                        $('#save').removeAttr('disabled');
                        var fail='提交失败!';
                        if(res.name==1)
                            fail+='客服名称已存在!';
                        if(res.qq==1)
                            fail+='客服QQ已存在!';
                        alert(fail);
                    }
                    else{
                        $('#save').removeAttr('disabled');
                        alert('提交失败');
                    }
                }
            })
            return false;
        })
    })
</script>