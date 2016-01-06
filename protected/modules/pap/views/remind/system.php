<?php
$this->breadcrumbs = array(
    '用户中心' => Yii::app()->createUrl('common/memberlist'),
    '消息中心',
);
$this->pageTitle = Yii::app()->name . ' - 系统消息列表';
?>
<div class="cont over-hidden">		
    <div class="lis-bar lis-bar-top ">
        <table>
            <tbody>
                <tr>
                    <td class="masg-col1"><input class="checkbox" type="checkbox" id='select_all'></td>
                    <td class="masg-col2">
                        <a href="javascript:;" class="masg-mark ui-btn ui-btn-mini m-left10" onclick='handlenews()'>标记所选为已读</a>
                    </td>
                    <?php
                    $linkarr = array();
                    if (isset($params['type'])) {
                        $linkarr['type'] = $params['type'];
                    }
                    ?>
                    <td class="masg-col3">
                        <?php if ($params['read'] == 'un'): ?>
                            未读 <span class="masg-num-unread"><?php echo $system['uncount'] ?></span>/
                            <a href="<?php echo Yii::app()->createUrl('pap/remind/system', $linkarr) ?>" class="noread">
                                全部 <span class="masg-num-total"><?php echo $system['count'] ?></span>
                            </a>
                        <?php else: ?>
                            <?php $linkarr['read'] = 'un'; ?>
                            <a href="<?php echo Yii::app()->createUrl('pap/remind/system', $linkarr) ?>" class="noread">
                                未读 <span class="masg-num-unread"><?php echo $system['uncount'] ?></span>
                            </a> 
                            /全部 <span class="masg-num-total"><?php echo $system['count'] ?></span>
                        <?php endif; ?>
                    </td>
                </tr>
            </tbody>
        </table>
    </div>
    <div class="lis-info">
        <?php
        $this->widget('widgets.default.WListView', array(
            'dataProvider' => $system['data'],
            'itemView' => 'systemlist',
            'id' => 'remindsystem',
        ));
        ?>
    </div>
</div> 
<script type="text/javascript">
    //标记所选为已读
    var send = [];
    $(document).ready(function() {
        //全选
        $('#select_all').live('click', function() {
            var checked = $(this).attr('checked');
            $("input[name=selectnews]").each(function() {
                $(this).attr('checked', checked ? checked : false);
                var val = $(this).val();
                if ($(this).attr('checked') === 'checked') {
                    if ($.inArray(val, send) === -1 && !isNaN(val)) {
                        send.push(val);
                    }
                } else {
                    for (var i in send) {
                        if (send[i] === val) {
                            send.splice(i, 1);
                        }
                    }
                }
            });
        });
        //单选
        $('input[name=selectnews]').live('click', function() {
            $('#select_all').attr('checked', $("input[name=selectnews]").length === $("input[name=selectnews]:checked").length ? true : false);
            var val = $(this).val();
            if ($(this).attr('checked') === 'checked') {
                if ($.inArray(val, send) === -1 && !isNaN(val)) {
                    send.push(val);
                }
            } else {
                for (var i in send) {
                    if (send[i] === val) {
                        send.splice(i, 1);
                    }
                }
            }
        });
        //更改读取状态
        $('.system-title').click(function() {
            //已读
            if ($(this).attr('class').indexOf('info-list-readed') === -1) {
                var id = $(this).attr('id').substr(4);
                var url = Yii_baseUrl + '/pap/remind/changenews';
                $.ajax({
                    url: url,
                    type: 'POST',
                    data: {id: id},
                    dataType: 'JSON',
                    success: function(data)
                    {
                        if (data.success)
                        {
                            $('#news' + id).remove();
                            $('#hidenews' + id).show();
                        }
                    }
                });
            }
        });

        $('.open_news').click(function() {
            var href = Yii_baseUrl + '/pap/remind/detail/id/' + $(this).attr('key');
            var type = '<?php echo $params['type'] ?>';
            var read = '<?php echo $params['read'] ?>';
            if (type !== '' && type !== undefined) {
                href += '/type/' + type;
            }
            if (read !== '' && read !== undefined) {
                href += '/read/' + read;
            }
            window.location.href = href;
        });
    });
    function handlenews() {
        if (send.length <= 0) {
            alert('请先选择一条消息记录！');
            return false;
        }
        var sendstr = send.join(',');
        var url = Yii_baseUrl + '/pap/remind/readnews';
        $.ajax({
            url: url,
            type: 'POST',
            data: {sendstr: sendstr},
            dataType: 'JSON',
            success: function(data)
            {
                if (data.error)
                {
                    alert(data.msg);
                }
                else if (data.success)
                {
                    alert(data.msg);
                    var href = Yii_baseUrl + '/pap/remind/system';
                    var type = '<?php echo $params['type'] ?>';
                    var read = '<?php echo $params['read'] ?>';
                    if (type !== '' && type !== undefined) {
                        href += '/type/' + type;
                    }
                    if (read !== '' && read !== undefined) {
                        href += '/read/' + read;
                    }
                    window.location.href = href;
                }
            }
        });
    }
</script>