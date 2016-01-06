<?php
$this->renderPartial('head', array('organID' => $params['OrganID']));
$this->breadcrumbs = array(
    '销售管理' => Yii::app()->createUrl('common/saleslist'),
    '商品交易评价',
);
?>
<!--买家评价-->
<div class="appraise">
    <ul class="apptop">
        <li class="on"><a href="<?php echo Yii::app()->createUrl('pap/sellerevaluate/index') ?>">来自买家的商品评价</a></li>
        <li><a href="<?php echo Yii::app()->createUrl('pap/sellerevaluate/receive') ?>">来自买家的服务评价</a></li>
        <li><a href="<?php echo Yii::app()->createUrl('pap/sellerevaluate/evaluate') ?>">对买家的信用评价</a></li>
    </ul>
    <!--买家商品评价-->
    <div class="subapp">
        <p class="m-top">
            <label>商品信息：</label>
            <input type="text" placeholder="商品编号或商品名称" name="search_text">
            <label>评价等级：</label>
            <?php
            echo CHtml::dropDownList('Status', "{$_GET['status']}", array(
                '1' => '好评',
                '2' => '中评',
                '3' => '差评'
                    ), array('class' => 'select select2 width80', 'empty' => '全部'))
            ?>
            <input type="checkbox" style="margin-left:20px; height:18px;" name="content"
                   <?php echo $_GET['content'] == 'not_empty' ? 'checked' : ''; ?>/> 有评价内容
        </p>
        <p class="m-top">
            <label>评价时间：</label>
            <?php
            $this->widget('zii.widgets.jui.CJuiDatePicker', array(
                'name' => 'starttime',
                'attribute' => 'start_time',
                'language' => 'zh_cn',
                'value' => $params['starttime'] ? date('Y-m-d', $params['starttime']) : '',
                'options' => array(
                    'dateFormat' => 'yy-mm-dd',
                // 'changeYear' => true,
                // 'yearRange' => '-70:+0'
                ),
                'htmlOptions' => array(
                    'class' => 'tcal',
                )
            ));
            ?>
            &nbsp;到&nbsp;<?php
            $this->widget('zii.widgets.jui.CJuiDatePicker', array(
                'name' => 'endtime',
                'attribute' => 'end_time',
                'language' => 'zh_cn',
                'value' => $params['endtime'] ? date('Y-m-d', $params['endtime']) : '',
                'options' => array(
                    'dateFormat' => 'yy-mm-dd',
                ),
                'htmlOptions' => array(
                    'class' => 'tcal',
                )
            ));
            ?>
            <input type="submit" value="搜 索"  id="form_btn" style="background:#f2b303; line-height:22px; border-radius:3px; color:#fff; width:83px; height:28px; border:none; font-size:14px; cursor:pointer; margin-left:20px;">
        </p>
        <div class="eval_tabel">
            <?php
            $this->widget('widgets.default.WGridView', array(
                'dataProvider' => $evallist,
                'columns' => array(
                    array(// display 'author.username' using an expression
                        'name' => '评价',
                        'type' => 'raw',
                        'headerHtmlOptions' => array('width' => '40px'),
                        'value' => '$data[Status]',
                    ),
                    array(// display 'author.username' using an expression
                        'name' => '评价心得',
                        'type' => 'raw',
                        'value' => '$data[content]',
                    ),
                    array(// display 'author.username' using an expression
                        'name' => '商品信息',
                        'type' => 'raw',
                        'headerHtmlOptions' => array('width' => '100px'),
                        'value' => '$data[goodsinfo]',
                    ),
                    array(// display 'author.username' using an expression
                        'name' => '买方名称',
                        'type' => 'raw',
                        'value' => 'EvaluateService::getOrganName($data[BuyerID])',
                    ),
                    array(
                        'name' => '操作',
                        'type' => 'raw',
                        'value' => '$data[reply]',
                    )
                ),
            ));
            ?>
        </div>
        <!--        <ul class="ultop">
                    <li class="sub_one">评价</li>
                    <li class="sub_two">留言</li>
                    <li class="sub_thr">商品信息</li>
                    <li class="sub_fou">买家账号</li>
                    <li class="sub_fiv">操作</li>
                </ul>
                <ul class="user">
                    <li class="sub_one">好评</li>
                    <li class="sub_two">
                        <p>还没装，先好评</p>
                        <span>[2015-01-07 16:07:13]</span>
                    </li>
                    <li class="sub_thr">
                        <span>博世舒适型前后刹车片…</span></br>
                        <em>编号：<i>15655262333</i></em></br>
                        <i>29.55</i>元
                    </li>
                    <li class="sub_fou"><a><em>平原小张</em></br><img src="images/6.png"/></a></li>
                    <li class="sub_fiv"><a><img src="images/7.png" /></a>
                        回复弹窗
                        <div class="reply">
                            <p><span class="fr"><img src="images/close.png" /></span></p>
                            <textarea></textarea>
                            <p style="width:600px; padding-top:6px; margin:0px auto;"><span class="fr"><img src="images/fabiao.png" /></span></p>
                            <div class="notice"><a>500字</a></div>
                        </div>
                        回复弹窗结束
                    </li>
                    <div class="clear"></div>
                </ul>
                评价列表结束
                列表翻页
                <div class="fr applist">
                    <ul>
                        <li class="listone on"><em>&lt;&lt;上一页</em></li> 
                        <li class="on"><em>1</em></li>
                        <li><em>2</em></li>
                        <li><em>3</em></li>
                        <li style=" border: none;"><em>…</em></li>
                        <li style=" border:1px solid #c5d2e2;"><em>下一页&gt;&gt;</em></li>
                    </ul>
                </div>
                <div class="clear"></div>-->
        <!--列表翻页结束-->
    </div>
    <!--买家商品评价结束-->
</div>
<?php
$this->beginWidget('zii.widgets.jui.CJuiDialog', array(
    'id' => 'mydialog', //弹窗ID  
    'options' => array(//传递给JUI插件的参数  
        'title' => '回复评价',
        'autoOpen' => false, //是否自动打开 
        'modal' => true, // 层级
        'width' => '450', //宽度  
        'height' => 'auto', //高度  
        // 'style' => 'min-height:400px',
        'resizable' => false,
        'buttons' => array(
            '回复' => 'js:function(){ replyeval();}',
            '取消' => 'js:function(){ $(this).dialog("close");}',
        ),
    ),
));
?>
<div id="formedit"></div>
<?php
$this->endWidget('zii.widgets.jui.CJuiDialog');
?>
<!--买家评价结束-->
<script>
    $(document).ready(function() {
//        if ($('input[name=search_text]').val() == '商品编号或商品名称') {
//            $('input[name=search_text]').css('color', '#ccc');
//        }
//
//        //商品名搜索
//        $('input[name=search_text]').click(function() {
//            if ($(this).val() == '商品编号或商品名称') {
//                $(this).val('');
//            }
//            $(this).css({'color': '#000'});
//        })
//
//        $('input[name=search_text]').blur(function() {
//            if ($.trim($(this).val()) == '') {
//                $(this).val('商品编号或商品名称');
//                $(this).css({'color': '#ccc'});
//            }
//        })

        $('#form_btn').click(function() {
            var url = getUrl();
            window.location.href = Yii_baseUrl + '/pap/sellerevaluate/index' + url;
        })

        //        $('textarea[name=reply]').live('input propertychange', function() {
        //            showchange();
        //        })
        $('textarea[name=reply]').live('keyup click keydown propertychange input', function() {
            showchange();
        });
    })

    function getUrl() {
        var url = '';
        var search = $('input[name=search_text]').val();
        if ($.trim(search) !== '' && search !== '商品编号或商品名称') {
            search = search.replace(/\//g, "<<q");
            search = search.replace(/\\/g, "q>>");
            search = encodeURIComponent(search);
            url += '/search_text/' + search;
        }
        if ($('input[name=content]').attr('checked')) {
            url += '/content/not_empty';
        }
        if ($('select[name=Status]').val()) {
            url += '/status/' + $('select[name=Status]').val();
        }
        if ($.trim($('input[name=starttime]').val()) !== '') {
            url += '/starttime/' + $('input[name=starttime]').val();
        }
        if ($.trim($('input[name=endtime]').val()) !== '') {
            url += '/endtime/' + $('input[name=endtime]').val();
        }
        return url;
    }

    function reply(id) {
        var url = Yii_baseUrl + '/pap/sellerevaluate/geteval';
        $.ajax({
            url: url,
            type: 'POST',
            data: {'ID': id},
            dataType: 'JSON',
            success: function(data)
            {
                if (data.error) {
                    alert('该评论已回复！');
                    location.reload();
                }
                else {
                    $('#mydialog').dialog('open');
                    var html = "<table style='border-collapse: separate;'>";
                    html += "<tr><td width='80' style='text-align:right'>买方评价：</td><td style='text-align:left;word-break:break-all'>";
                    if (data.BuyerToEvalRemark != '0') {
                        html += data.BuyerToEvalRemark;
                    } else if (data.Status == 1) {
                        html += '好评！';
                    } else if (data.Status == 2) {
                        html += '中评！';
                    } else if (data.Status == 3) {
                        html += '差评！';
                    }
                    html += "</td></tr>";
                    html += "<tr class='m_top'><td class='test' style='text-align:right'>您的回复：</td>";
                    html += "<td style='text-align:left'><textarea rows='5' cols='40' name='reply' style='width:320px'>" + data.SellerToEvalRemark + "</textarea></td></tr>";
                    html += "</table><div style='float:right' id='showspan'>（回复不少于2字，不超过50字）</div>"
                    html += "<input type='hidden' name='eval' value='" + id + "'>";
                    $('#formedit').html(html);
                }
            }
        });
    }

    function showchange() {
        var len = parseInt($.trim($('textarea[name=reply]').val()).length);
        //alert($.trim($('textarea[name=reply]').val()));
        if (len <= 50) {
            var sy = 50 - len;
            $('#showspan').text('还可以输入' + sy + '字');
        } else {
            var sy = len - 50;
            $('#showspan').html('已超过<font color="red">' + sy + '</font>字');
        }
    }

    //提交评价回复
    function replyeval() {
        var ID = $('input[name=eval]').val();  //获取修改ID
        var reply = $.trim($('textarea[name=reply]').val());
        var len = parseInt(reply.length);
        if (len < 2) {
            $('#showspan').text('（回复不少于2字，不超过50字）');
            return false;
        }
        if (len > 50) {
            var sy = len - 50;
            $('#showspan').html('已超过<font color="red">' + sy + '</font>字');
            return false;
        }
        var url = Yii_baseUrl + '/pap/sellerevaluate/reply';
        $.ajax({
            url: url,
            type: 'POST',
            data: {'ID': ID, 'reply': reply},
            dataType: 'JSON',
            success: function(data)
            {
                $('#mydialog').dialog('close');
                if (data.success == 1)
                {
                    alert('回复成功！');
                    window.location.reload();
                }
                else
                {
                    alert(data.error);
                }
            }
        });
    }
</script>
<script>
    //处理IE中maxlength无用问题
    $(document).on("keyup", "textarea[maxlength]", function() {
        var area = $(this);
        var max = parseInt(area.attr("maxlength"), 10); //获取maxlength的值
        if (max > 0) {
            if (area.val().length > max) { //textarea的文本长度大于maxlength
                area.val(area.val().substr(0, max)); //截断textarea的文本重新赋值
            }
        }
    })

    //复制的字符处理问题
    $(document).on("blur", "textarea[maxlength]", function() {
        var area = $(this);
        var max = parseInt(area.attr("maxlength"), 10); //获取maxlength的值
        if (max > 0) {
            if (area.val().length > max) { //textarea的文本长度大于maxlength
                area.val(area.val().substr(0, max)); //截断textarea的文本重新赋值
            }
        }
    })
</script>