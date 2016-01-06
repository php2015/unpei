<?php
$this->breadcrumbs = array(
    '用户中心' => Yii::app()->createUrl('common/memberlist'),
    '消息中心',
);
$this->pageTitle = Yii::app()->name . ' - 业务消息列表';
?>
<style>
    .pager li {
        float: left;
        height: 24px;
        line-height: 24px;
        margin-left: 10px;
    }
    .pager li.next{background:none;height:auto;width:auto;min-height:24px}
    .goto {margin-left: 10px;margin-top: -3px;}
    .spanr{margin-left:20px;}
</style>
<div class="cont over-hidden">		
    <div class="lis-bar lis-bar-top ">
        <table>
            <tbody><tr>
                    <td class="masg-col1"><input class="checkbox" type="checkbox" id='select_all'></td>
                    <td class="masg-col2">
                        <a href="javascript:;" class="masg-mark ui-btn ui-btn-mini m-left10" onclick='handlenews("sign")'>标记所选为已处理</a>
                        <a href="javascript:;" class="masg-del ui-btn ui-btn-mini" onclick='handlenews("del")'>删除所选</a>
                        <a href="javascript:;" class="masg-clear ui-btn ui-btn-mini" onclick='handlenews("clear")'>清空所有</a>
                    </td>
                    <?php
                    $linkarr = array();
                    if (isset($params['status'])) {
                        $linkarr['status'] = $params['status'];
                    }
                    ?>
                    <td class="masg-col3">
                        <?php if ($params['handle'] == 'un'): ?>
                            未处理 <span class="masg-num-unread"><?php echo $business['uncount'] ?></span>/
                            <a href="<?php echo Yii::app()->createUrl('pap/remind/index', $linkarr) ?>" class="noread">
                                全部 <span class="masg-num-total"><?php echo $business['count'] ?></span>
                            </a>
                        <?php else: ?>
                            <?php $linkarr['handle'] = 'un'; ?>
                            <a href="<?php echo Yii::app()->createUrl('pap/remind/index', $linkarr) ?>" class="noread">
                                未处理 <span class="masg-num-unread"><?php echo $business['uncount'] ?></span>
                            </a> 
                            /全部 <span class="masg-num-total"><?php echo $business['count'] ?></span>
                        <?php endif; ?>
                    </td>
                </tr>
            </tbody>
        </table>
    </div>
    <div class="lis-info">
        <?php
        $this->widget('widgets.default.WListView', array(
            'dataProvider' => $business['data'],
            'itemView' => 'businesslist',
            'id' => 'remindbusiness',
        ));
        ?>
    </div>
</div> 
<script type="text/javascript">
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
                        //var index=i;
                        send.splice(i, 1);
                    }
                }
            }
        });
    });

    function handlenews(str) {
        if ($.inArray(str, ['sign', 'del', 'clear']) === -1) {
            return false;
        }
        if (send.length <= 0 && str !== 'clear') {
            alert('请先选择一条消息记录！');
            return false;
        }
        var status = '<?php echo $params['status'] ?>';
        var handle = '<?php echo $params['handle'] ?>';
        var sendstr = send.join(',');
        var url = Yii_baseUrl + '/pap/remind/handlenews';
        $.ajax({
            url: url,
            type: 'POST',
            data: {sendstr: sendstr, str: str, status: status, handle: handle},
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
                    var href = Yii_baseUrl + '/pap/remind/index';
                    if (status !== '' && status !== undefined) {
                        href += '/status/' + status;
                    }
                    if (handle !== '' && handle !== undefined) {
                        href += '/handle/' + handle;
                    }
                    window.location.href = href;
                }
            }
        });
    }
</script>