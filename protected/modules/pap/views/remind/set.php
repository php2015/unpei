<style>
    .within {background: none repeat scroll 0 0 #eff4fa;border: 2px solid #0164c1;left: 200px;position: absolute;width: 660px;}
    .within_info {margin: 10px 20px;}
    .within_hd {line-height: 30px; margin-top: 10px}
    .within_bd {width: 495px;}
    .within_bd ul li {float: left;line-height: 25px; margin-left: 35px;}
    .within_lm{ border-bottom:1px dashed #868686;padding-bottom:20px;width:600px}
    .remindway{margin-top: 15px}
    .m_top10{margin-top:15px}
    .redremind{border:1px solid red !important;}
</style>
<?php
$this->breadcrumbs = array(
    '用户中心' => Yii::app()->createUrl('common/memberlist'),
    '消息中心'
);
$this->pageTitle = Yii::app()->name . ' - 消息提醒设置';
?>
<div class="cont over-hidden">
    <div class="padding20 bor-bottom" style="border-bottom:none">
        <ul class="within_info" style="display: block;">
            <?php if ($items):$i = 0; ?>
                <?php
                foreach ($items as $k => $item):$set = $remindres[$k];
                    $i++;
                    ?>
                    <li class="within_lm" type="<?php echo $i; ?>" keys="<?php echo $k; ?>">
                        <div class=" width100 within_hd">
                            <span><input type="checkbox" value="<?php echo $k; ?>" id="fc<?php echo $k; ?>" class="checkbox first-child" style="display: inline-block;" <?php if ($set['allitem'] == 1) echo 'checked="checked"'; ?>><b><?php echo $item['Name']; ?></b></span>
                        </div>
                        <div class=" within_bd">
                            <ul class="list-per">
                                <?php foreach ($item['children'] as $kk => $v): ?>
                                    <li><span><input type="checkbox" value="<?php echo $kk; ?>" pid="<?php echo $k; ?>" class="checkbox children-<?php echo $k; ?>" style="display: inline-block;" <?php if (in_array($kk, $set['item'])) echo 'checked="checked"'; ?>><?php echo $v; ?></span></li>
                                <?php endforeach; ?>
                                <div class="clear"></div>
                            </ul>
                        </div>         
                        <div class="remindway">
                            <span class="m_left30 m_top7">消息发送方式：</span>
                            <input type="checkbox" class="checkbox m_left10 systemremind"  <?php if ($set['allitem'] != -1) echo 'checked="checked"'; ?> onclick="return false" disabled>系统发送
                            <input value=1 type="checkbox" class="checkbox m_left20"  <?php if (in_array(1, $set['way'])) echo 'checked="checked"'; ?>>邮件发送
                            <input value=2 type="checkbox" class="checkbox m_left20"  name="sms" <?php if (in_array(2, $set['way'])) echo 'checked="checked"'; ?>>短信发送
                        </div>
                        <div class="m_top10 smsobj" style="padding:5px 0px 5px 0px;<?php if (!in_array(2, $set['way'])) echo 'display:none'; ?>">
                            <span class="m_left30">短信发送对象：</span>
                            <input value=1 type="checkbox" class="checkbox m_left10" name="boss" <?php if ($set['IfSend']) echo 'checked="checked"'; ?>>老板
                            <input value=2 type="checkbox" soncount="<?php echo count($selects); ?>" class="checkbox m_left20" name="son" <?php if ($set['SonID']) echo 'checked="checked"'; ?>>子账户
                            <span style="<?php if (!$set['SonID']) echo 'display:none'; ?>">
                                <select class="select" name="sonselect" style="width:100px">
                                    <option value="0">请选择子账户</option>
                                    <?php foreach ($selects as $v): ?>
                                        <option <?php if ($set['SonID'] == $v['ID']) echo 'selected="selected"'; ?> value="<?php echo $v['ID']; ?>" phone="<?php echo $v['Phone'] ? 1 : 0; ?>"><?php echo $v['Name'].($v['Phone']?('('.$v['Phone'].')'):''); ?></option>
                                    <?php endforeach; ?>
                                </select>
                            </span>
                            <input value=3 type="checkbox" class="checkbox m_left20" name="other" <?php if ($set['OtherPhone']) echo 'checked="checked"'; ?>>其他
                            <input type="text"  class="input" style="<?php if (!$set['OtherPhone']) echo 'display:none'; ?>" name="otherphone" value="<?php echo $set['OtherPhone']; ?>">
                        </div>
                        <div class="m_top10 m_left30 remind" style="color:red"></div>
                    </li>
                <?php endforeach; ?>
            <?php else: ?>
                <li class="within_lm"><div class="float_l within_hd" style="width:150px;margin-top:3px;">暂时没有配置提醒项目</div></li>
            <?php endif; ?>

        </ul>
    </div>

    <?php if ($items): ?>
        <p align="center" class="w600"><button class="submit" id="save">保 存</button></p>
    <?php endif; ?>
</div>

<script>
    $(function() {
        $('[name=otherphone]').blur(function() {
            var reg = /^(((1[1-9]{1}[0-9]{1})|159|153)+\d{8})$/;
            var phone = $(this).val().replace(/\s+/g, "");
            if (reg.test(phone)) {
                $(this).removeClass('redremind');
                $(this).parents('li').find('.remind').html('');
            } else {
                $(this).addClass('redremind');
                $(this).parents('li').find('.remind').html('请填写正确的手机号');
            }
        })

        $('.smsobj :checkbox').click(function() {
            $(this).parents('.smsobj ').removeClass('redremind');
            $(this).parents('li').find('.remind').html('');
        })

        //子账户改变事件
        $('[name=sonselect]').change(function() {
            if ($(this).find('option:selected').attr('phone') == 0) {
                $(this).find('option:eq(0)').attr('selected', true);
                alert('选择无效,子账户未添加手机号码');
            } else {
                $(this).removeClass('redremind');
                $(this).parents('li').find('.remind').html('');
            }
        })

        //短信提醒点击事件
        $(':checkbox[name=sms]').click(function() {
            if ($(this).parents('li').find(':checkbox[pid]:checked').length == 0) {
                return false;
            }
            if ($(this).attr('checked') == 'checked') {
                $(this).parents('li').find(':checkbox[name=boss]').attr('checked', true);
                $(this).parents('li').find('.smsobj').show();
            } else {
                $(this).parents('li').find('.smsobj').hide();
            }
        })

        //子账户点击事件
        $(':checkbox[name=son]').click(function() {
            if ($(this).attr('soncount') == 0) {
                alert('子账户列表为空');
                return false;
            }
            if ($(this).attr('checked') == 'checked') {
                $(this).next('span').show();
            } else {
                $(this).next('span').hide();
                if ($(this).parent('.smsobj').find(':checkbox:checked').length == 0) {
                    $(this).parent('.smsobj').find(':checkbox[name=boss]').attr('checked', true);
                }
            }
        })

        //其他点击事件
        $(':checkbox[name=other]').click(function() {
            if ($(this).attr('checked') == 'checked') {
                $(this).next('input').show();
            } else {
                $(this).next('input').hide();
                if ($(this).parent('.smsobj').find(':checkbox:checked').length == 0) {
                    $(this).parent('.smsobj').find(':checkbox[name=boss]').attr('checked', true);
                }
            }
        })

        //提醒方式点击事件
        $('.remindway :checkbox').click(function() {
            if ($(this).parents('li').find(':checkbox[pid]:checked').length == 0) {
                alert('请先选择提醒项目!');
                return false;
            }
        })

        //提醒项目类别点击事件
        $('.first-child').click(function() {
            var checked = $(this).attr('checked');
            var fid = $(this).val();
            var childclass = '.children-' + fid;
            if (checked === 'checked') {
                $(this).parents('li').find('.systemremind').attr('checked', 'checked');
                $(childclass).attr('checked', 'checked');
            } else {
                $(this).parents('li').find(':checkbox').attr('checked', false);
                $(this).parents('li').find('.smsobj').hide();
            }
        });

        //提醒项目点击事件
        $(':checkbox[pid]').click(function() {
            var checked = $(this).attr('checked');
            var pid = $(this).attr('pid');
            var fid = '#fc' + pid;
            var childclass = '.children-' + pid;
            if (checked == 'checked') {
                $(fid).parents('li').find('.systemremind').attr('checked', 'checked');
                var all = 1;
                $(childclass).each(function() {
                    if ($(this).attr('checked') == undefined) {
                        all = 0;
                        return false;
                    }
                })
                if (all == 1)
                    $(fid).attr('checked', 'checked');
            } else {
                $(fid).attr('checked', false);
                if ($(fid).parents('li').find(':checkbox[pid]:checked').length == 0) {
                    $(fid).parents('li').find(':checkbox').attr('checked', false);
                }
            }
        })

        //提醒定制保存
        $('#save').click(function() {
            var Identity = "<?php echo Yii::app()->user->getIdentity(); ?>";
            var url = Yii_baseUrl + '/pap/remind/save';
            var reg = /^(((1[1-9]{1}[0-9]{1})|159|153)+\d{8})$/;
            var itemids = '', typeids = '', types = '', extras = '';
            var status = 0;
            var keys;
            $('.within_lm').each(function() {
                var itemid = '';
                var typeid = '';
                var extra = '';
                var pid = $(this).attr('keys');
                types += $(this).attr('type') + '-';
                keys = $(this).attr('type');
                $(':checkbox[pid="' + pid + '"]').each(function() {
                    if ($(this).attr('checked') == 'checked') {
                        itemid += $(this).val() + ',';
                    }
                })
                $(this).find('.remindway :checkbox:checked').each(function() {
                    if (!$(this).hasClass('systemremind')) {
                        typeid += $(this).val() + ',';
                    }
                })
                var sms = $(this).find('.remindway :checkbox:checked[name=sms]').length;
                var check = 0;
                if ($(this).find(':checkbox[name=boss]').attr('checked') == 'checked') {
                    check = 1;
                    extra += 1 + ',';
                } else {
                    extra += 0 + ',';
                }
                if ($(this).find(':checkbox[name=son]').attr('checked') == 'checked') {
                    check = 1;
                    if ($(this).find('[name=sonselect]').val() == 0)
                        check = 2;
                    else
                        extra += $(this).find('[name=sonselect]').val() + ',';
                } else {
                    extra += ',';
                }
                if (check != 2 && $(this).find(':checkbox[name=other]').attr('checked') == 'checked') {
                    check = 1;
                    if ($(this).find('[name=otherphone]').val() != '') {
                        var phone = $(this).find('[name=otherphone]').val().replace(/\s+/g, "");
                        if (reg.test(phone)) {
                            extra += phone + ',';
                        } else {
                            check = 3;
                        }
                    }
                    else
                        check = 3;
                } else {
                    extra += ',';
                }
                if (sms == 1 && check == 0) {
                    status = 1;
                    return false;
                } else if (sms == 1 && check == 2) {
                    status = 2;
                    return false;
                } else if (sms == 1 && check == 3) {
                    status = 3;
                    return false;
                }
                itemids += itemid.substr(0, itemid.length - 1) + '-';
                typeids += typeid.substr(0, typeid.length - 1) + '-';
                extras += extra.substr(0, extra.length - 1) + '-';
            })
            var item;
            if (keys == 1) {
                item = $('.within_lm:eq(0)');
            } else if (keys == 2) {
                item = $('.within_lm:eq(1)');
            } else if (keys == 3) {
                item = $('.within_lm:eq(2)');
            }
            if (status == 1) {
                item.find('.smsobj').addClass('redremind');
                item.find('.remind').html('请选择短信提醒对象!');
                return false;
            }
            if (status == 2) {
                item.find('[name=sonselect]').addClass('redremind');
                item.find('.remind').html('请选择子账户发送对象!');
                return false;
            } else if (status == 3) {
                item.find('[name=otherphone]').addClass('redremind');
                item.find('.remind').html('请填写正确的手机号!');
                return false;
            }
            var data = {};
            data.itemids = itemids.substr(0, itemids.length - 1);
            data.typeids = typeids.substr(0, typeids.length - 1);
            data.types = types.substr(0, types.length - 1);
            data.extras = extras.substr(0, extras.length - 1);
            $(this).attr('disabled', true);
            $.post(url, data, function(res) {
                if (res.res == 1) {
                    alert('保存成功');
                    $('#save').removeAttr('disabled');
                } else {
                    alert('保存失败');
                }
            }, 'json')
        })
    })
</script>
