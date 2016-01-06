<?php
$this->renderPartial('head', array('organID' => $params['OrganID']));
$this->breadcrumbs = array(
    '采购管理' => Yii::app()->createUrl('common/buylist'),
    '评价管理',
);
?>
<div class="bor_back m-top">
    <div class="txxx txxx2">
        <ul class="title_lm">
            <li class="current"><a href="<?php echo Yii::app()->createUrl('pap/orderevaluate/index') ?>">对卖家的商品评价 <span class="interval">  |</span></a></li>
            <li class=""><a href="<?php echo Yii::app()->createUrl('pap/orderevaluate/evaluate') ?>">对卖家的服务评价<span class="interval">  |</span></a></li>
            <li class=""><a href="<?php echo Yii::app()->createUrl('pap/orderevaluate/receive') ?>">来自卖家的信用评价<span class="interval">  |</span></a></li>
        </ul>
    </div>
    <div class="order m-top">
        <div class="txxx_info2a m-top">
            <form method="get">
                <p>
                    <label  class="">商品信息：</label>
                    <input type="text" class="input" value="<?php echo $params['search_text'] ? $params['search_text'] : '商品编号或商品名称' ?>" style="margin-right:10px" name="search_text">
                    <label>评价星级：</label>
                    <?php
                    echo CHtml::dropDownList('Status', "{$_GET['status']}", array(
                        '1' => '好评',
                        '2' => '中评',
                        '3' => '差评'
                            ), array('class' => 'select select2 width80', 'empty' => '全部'))
                    ?>
                    <input type="checkbox" class="m_left24" name="content" <?php echo $_GET['content'] == 'reply' ? 'checked' : ''; ?>>
                    <label>已回复的评价</label>
                </p>
                <p class="m-top">
                    <label class="">评价时间：</label>
                    <?php
                    $this->widget('zii.widgets.jui.CJuiDatePicker', array(
                        'name' => 'starttime',
                        'attribute' => 'start_time',
                        'language' => 'zh_cn',
                        'value' => $params['starttime'] ? date('Y-m-d', $params['starttime']) : '',
                        'options' => array(
                            'dateFormat' => 'yy-mm-dd',
                        ),
                        'htmlOptions' => array(
                            'class' => 'input input3 width100',
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
                            'class' => 'input input3 width100',
                        )
                    ));
                    ?>
                    <input type="button" class="submit f_weight m_left24" value="搜 索" id="form_btn">
                </p>
            </form>
        </div>
        <div class="eval_table">
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
                        'headerHtmlOptions' => array('width' => '300px'),
                        'value' => '$data[content]',
                    ),
                    array(// display 'author.username' using an expression
                        'name' => '商品信息',
                        'type' => 'raw',
                        'headerHtmlOptions' => array('width' => '100px'),
                        'value' => '$data[goodsinfo]',
                    ),
                    array(// display 'author.username' using an expression
                        'name' => '卖家账号',
                        'type' => 'raw',
                        'value' => 'EvaluateService::getOrganName($data[OrganID],2)',
                    ),
//                    array(// display 'author.username' using an expression
//                        'name' => '操作',
//                        'type' => 'raw',
//                        'headerHtmlOptions' => array('width' => '60px'),
//                        'value' => '',
//                    ),
                ),
            ));
            ?>
        </div>
    </div>
</div>
<script>
    $(document).ready(function() {
        if ($('input[name=search_text]').val() === '商品编号或商品名称') {
            $('input[name=search_text]').css('color', '#ccc');
        }

        //商品名搜索
        $('input[name=search_text]').click(function() {
            if ($(this).val() === '商品编号或商品名称') {
                $(this).val('');
            }
            $(this).css({'color': '#656565;'});
        })

        $('input[name=search_text]').blur(function() {
            if ($.trim($(this).val()) === '') {
                $(this).val('商品编号或商品名称');
                $(this).css({'color': '#ccc'});
            }
        })

        $('#form_btn').live('click', function() {
            var url = getUrl();
            window.location.href = Yii_baseUrl + '/pap/orderevaluate/index' + url;
        })
    })

    function getUrl() {
        var url = '';
        if ($.trim($('input[name=search_text]').val()) !== '' && $('input[name=search_text]').val() !== '商品编号或商品名称') {
            var search = $('input[name=search_text]').val();
            search = search.replace(/\//g, "<<q");
            search = search.replace(/\\/g, "q>>");
            search = encodeURIComponent(search);
            url += '/search_text/' + search;
        }
        if ($('input[name=content]').attr('checked')) {
            url += '/content/reply';
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
</script>

