<?php
$this->pageTitle = Yii::app()->name . ' - 帐号管理';
$this->breadcrumbs = array(
    '帐号管理',
    '修改密码',
);
?>
<div class="bor_back m-top" style="height:500px; position:relative">
    <p class="txxx">帐号管理 -- 密码修改</p>

    <div style="margin-top: 50px" class="bg-white pos-r">
        <div class="form">
            <div style="margin-left: 220px" class="row">
                <label>请输入原密码</label>：<input type="password" maxlength="20" id="old">
            </div>
            <div style="margin-left: 220px" class="row">
                <label>请输入新密码</label>：<input type="password" maxlength="20" id="newly">
            </div>
            <div style="margin-left: 220px" class="row">
                <label>请重复新密码</label>：<input type="password" maxlength="20" id="repeat">
            </div>
            <p style="margin-left: 430px" class="row">
                <input type="submit" value="保存" name="yt0" class="submit" id="save">
            </p>
        </div>
        </form>
    </div>
</div>
<script>
    $(function(){
        //密码保存操作
        $('#save').click(function(){
            var old=$('#old').val();
            var newly=$('#newly').val();
            var repeat=$('#repeat').val();
            if(old==''){
                alert('请输入原密码');
                return false;
            }
            if(newly==''){
                alert('请输入新密码');
                return false;
            }
            if(newly.length<6){
                $('#newly').val('');
                alert('密码长度最小6位');
                return false;
            }
            if(newly!=repeat){
                $('#newly').val('');
                $('#repeat').val('');
                alert('两次密码不一样,请重新输入');
                return false;
            }
            if(newly==old){
                $('#newly').val('');
                $('#repeat').val('');
                alert('新密码不能和原密码一样');
                return false;
            }
            var url=Yii_baseUrl+'/member/infomanager/updatepasseord';
            if(confirm('密码修改成功后会重新登录,是否继续?')){
                $.post(url,{'old':old,'newly':newly},function(res){
                    if(res.res==1){
                        alert('修改成功');
                    }else{
                        alert(res.msg);
                    }    
                },'json')
            }
        
        })
        
        $("input:password").keypress(function(e){
            if(e.which==32){
                $(this).val('');
                alert('不允许输入空格');
                return false;
                //
            }
        });
    })
</script>
