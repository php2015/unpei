<style>
    .button-hui{ background:#999}
</style>
<div style="display:none">
    <?php
    $this->beginWidget('zii.widgets.jui.CJuiDialog', array(
        'id' => 'dg',
        'options' => array(
            'title' => '支付宝账号修改-验证码验证',
            'autoOpen' => false,
            'width' => '400px',
            'height' => 'auto',
            'modal' => true,
            'buttons' => array(
                '关闭' => 'js:function(){ $(this).dialog("close");}',
            ),
        ),
    ));
    ?>

    <div style="margin-top: 15px;">
        <span class='label label-inline'>验证码：</span>
        <input id="checkcode" class="width213 input" type="text"  maxlength="6" >
        <input class='submit ml60 m_left' type='submit' id="sendcode" value='发送验证码' time="60">
    </div>
    <div style="margin-left:70px;margin-top:11px">
        <input class='submit ml60 m_left' type='submit' id="ok" value='确认'>
    </div>

    <?php $this->endWidget('zii.widgets.jui.CJuiDialog'); ?>
</div>
<script>
    var sh;
    $(document).ready(function() {
        //发送验证码
        $('#sendcode').click(function() {
            var url = Yii_baseUrl + '/member/finaccount/sendcode';
            $('#sendcode').attr('disabled', true);
            $.ajax({
                url: url,
                type: 'post',
                dataType: 'json',
                data:{'codename':'<?php echo $codename;?>'},
                success: function(res) {
                    if (res.res == 1) {
                        $('#sendcode').addClass('button-hui');
                        $('#sendcode').val('60秒后重发');
                        sh = setInterval(countdown, 1000);
                        alert(res.msg);
                    }
                    else if (res.res == 0) {
                        $('#sendcode').attr('time', 60);
                        $('#sendcode').removeAttr('disabled');
                        $('#sendcode').val('发送验证码');
                        $('#sendcode').removeClass('button-hui');
                        alert(res.msg);
                    }
                }
            })
        })

        //确认
        $('#ok').click(function() {
            var checkcode = $('#checkcode').val();
            if (checkcode == '') {
                alert('验证码不为空');
                return false;
            }
            var url = Yii_baseUrl + '/member/finaccount/checkcode';
            $('#ok').attr('disabled', true);
            $.ajax({
                url: url,
                type: 'post',
                data: {'codename':'<?php echo $codename;?>','code': checkcode},
                dataType: 'json',
                success: function(res) {
                    if (res.res == 1) {
                        var handle = '<?php echo $handle; ?>';
                        if (handle == 'edit') {
                            $("#financial-form").submit();
                        }
                        else if (handle == 'delete') {
                            check = 0;
                            $('#yw0 .delete').trigger('click');
                        }
                    }
                    else if (res.res == 0) {
                        $('#ok').removeAttr('disabled');
                        alert(res.msg);
                    }
                }
            })
        })
    })

    function countdown() {
        var time = parseInt($('#sendcode').attr('time')) - 1;
        $('#sendcode').val(time + '秒后重发');
        $('#sendcode').attr('time', time);
        if (time == 0) {
            $('#sendcode').attr('time', 60);
            $('#sendcode').removeAttr('disabled');
            $('#sendcode').val('发送验证码');
            $('#sendcode').removeClass('button-hui');
            clearInterval(sh);
        }
    }
</script>