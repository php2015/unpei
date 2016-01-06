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
            <li><a href="<?php echo Yii::app()->createUrl('pap/orderevaluate/index') ?>">对卖家的商品评价 <span class="interval">  |</span></a></li>
            <li><a href="<?php echo Yii::app()->createUrl('pap/orderevaluate/evaluate') ?>">对卖家的服务评价<span class="interval">  |</span></a></li>
            <li class="current"><a href="<?php echo Yii::app()->createUrl('pap/orderevaluate/receive') ?>">来自卖家的信用评价<span class="interval">  |</span></a></li>
        </ul>
    </div>
    <div class="order m-top">
        <div class="txxx_info2a m-top">
            <form method="get">
                <p class="m-top">
                    <label  class="">评价机构：</label>
                    <input type="text" class="input" value="<?php echo $params['search_text'] ?>" style="margin-right:10px" name="search_text">
                    <label  class="m_left24">评价时间：</label>
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
    </div>
    <div class="eval_table">
        <?php
        $this->widget('widgets.default.WGridView', array(
            'dataProvider' => $evallist,
            'columns' => array(
                array(// display 'create_time' using an expression
                    'name' => '评价内容',
                    'type' => 'raw',
                    'headerHtmlOptions' => array('width' => '150px'),
                    'value' => '$data[evalItem]',
                ),
                array(// display 'author.username' using an expression
                    'name' => '评价',
                    'type' => 'raw',
                    'headerHtmlOptions' => array('width' => '150px'),
                    'value' => '$data[evalScore]',
                ),
//            array(// display 'author.username' using an expression
//                'name' => '评价时间',
//                'value' => 'date("Y-m-d H:i:s",$data[CreateTime])',
//            ),
                array(// display 'author.username' using an expression
                    'name' => '评价心得',
                    'type' => 'raw',
                    'headerHtmlOptions' => array('width' => '250px'),
                    'value' => '$data[Message]',
                ),
                array(// display 'author.username' using an expression
                    'name' => '卖家账号',
                    'type' => 'raw',
                    'value' => 'EvaluateService::getOrganName($data[OrganID],2)',
                ),
            ),
        ));
        ?>
    </div>
</div>
<script>
    $(document).ready(function() {
        $('#form_btn').live('click', function() {
            var url = getUrl();
            window.location.href = Yii_baseUrl + '/pap/orderevaluate/receive' + url;
        })
    })

    function getUrl() {
        var url = '';
        if ($.trim($('input[name=search_text]').val()) !== '') {
            var search = $('input[name=search_text]').val();
            search = search.replace(/\//g, "<<q");
            search = search.replace(/\\/g, "q>>");
            search = encodeURIComponent(search);
            url += '/search_text/' + search;
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

