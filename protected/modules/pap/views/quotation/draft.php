<?php
$this->pageTitle = Yii::app()->name . ' - 草稿箱列表';
$this->breadcrumbs = array(
    '报价单管理' => Yii::app()->createUrl('common/quotationlist'),
    '报价单草稿箱列表'
);
?>
<div class="bor_back m-top" style="height:100px;padding-left:10px;padding-top:7px">
    <p class="txxx">报价单管理-草稿箱</p>
    <p style="margin-top:10px">
        <label class="label1">报价单编号：</label>
        <input type="text" class="input"  id='no' value='<?php echo $_GET['no']; ?>'>
        <label class="labell">创建时间：</label>
        <?php
        $this->widget('zii.widgets.jui.CJuiDatePicker', array(
            'language' => 'zh_cn',
            'name' => 'start',
            'value' => $_GET['start'],
            'options' => array(
                'dateFormat' => 'yy-mm-dd',
                'changeMonth' => true,
                'changeYear' => true
            ),
            'htmlOptions' => array(
                'style' => 'width:90px;',
                'class' => 'input'
            )
        ));
        ?>  
        至
        <?php
        $this->widget('zii.widgets.jui.CJuiDatePicker', array(
            'language' => 'zh_cn',
            'name' => 'end',
            'value' => $_GET['end'],
            'options' => array(
                'dateFormat' => 'yy-mm-dd',
                'changeMonth' => true,
                'changeYear' => true
            ),
            'htmlOptions' => array(
                'style' => 'width:90px;',
                'class' => 'input'
            )
        ));
        ?>  
        <input type="submit" value="查   询"  class="submit m_left" id="search">
    </p>
    <p style="margin-top:5px">

    </p>
</div>
<div class="ddgl_content3 bor_back">
    <?php
    $this->widget('widgets.default.WGridView', array(
        'id' => 'quolists',
        'dataProvider' => $dataProvider,
        'columns' => array(
            array(
                'name' => '报价单名称',
                'type' => 'raw',
                'value' => '$data[Title]',
                'headerHtmlOptions' => array('width' => '170px')
            ),
            array(
                'name' => '报价单编号',
                'type' => 'raw',
                'value' => '$data[QuoSn]',
                'headerHtmlOptions' => array('width' => '170px')
            ),
            array(
                'name' => '发送对象',
                'value' => 'QuotationService::getservicename($data[ServiceID])',
                'headerHtmlOptions' => array('width' => '150px')
            ),
            array(
                'name' => '发起人',
                'value' => '$data[from]',
                'headerHtmlOptions' => array('width' => '60px')
            ),
            array(
                'name' => '创建时间',
                'value' => 'date("Y-m-d H:i:s",$data[CreateTime])',
                'headerHtmlOptions' => array('width' => '140px'),
            ),
            array(
                'class' => 'CButtonColumn',
                'header' => '操作',
                'template' => '{updatequo}{updateinq}{viewquo}{viewinq}',
                'buttons' => array(
                    'updatequo' => array(
                        'label' => '修改',
                        'imageUrl' => Yii::app()->theme->baseUrl . '/images/update.png',
                        'visible' => '$data[InquiryID]==0&&$data[Status]==1',
                        'url' => 'Yii::app()->createUrl("/pap/quotation/quoscheme",array("update"=>"t","quoid"=>$data[QuoID],"sid"=>$data[ServiceID],"draft"=>1))'
                    ),
                    'updateinq' => array(
                        'label' => '修改',
                        'imageUrl' => Yii::app()->theme->baseUrl . '/images/update.png',
                        'visible' => '$data[InquiryID]!=0&&$data[Status]==1',
                        'url' => 'Yii::app()->createUrl("/pap/inquirylist/scheme",array("inqid"=>$data[InquiryID],"draft"=>1))'
                    ),
                    'viewquo' => array(
                        'label' => '详情',
                        'visible' => '$data[InquiryID]==0',
                        'imageUrl' => Yii::app()->theme->baseUrl . '/images/view.png',
                        'url' => 'Yii::app()->createUrl("/pap/quotation/viewquo",array("quoID"=>$data[QuoID]))'
                    ),
                    'viewinq' => array(
                        'label' => '详情',
                        'visible' => '$data[InquiryID]!=0',
                        'imageUrl' => Yii::app()->theme->baseUrl . '/images/view.png',
                        'url' => 'Yii::app()->createUrl("/pap/inquirylist/viewquo",array("inqid"=>$data[InquiryID],"draft"=>1))'
                    )
                )
            )
        )
    ))
    ?>
</div>
<script>
    $(function() {
        //搜索
        $('#search').click(function() {
            var url = Yii_baseUrl + '/pap/quotation/draft';
            var data = {};
            data.no = encodeURIComponent($('#no').val());
            data.start = encodeURIComponent($('#start').val());
            data.end = encodeURIComponent($('#end').val());
            $.each(data, function(k, v) {
                if (v != '')
                    url += '/' + k + '/' + v;
            })
            window.location.href = url;
        })
    })
</script>
