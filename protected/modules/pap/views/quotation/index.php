<?php
$this->pageTitle = Yii::app()->name . ' - 报价单列表';
$this->breadcrumbs = array(
    '报价单管理' => Yii::app()->createUrl('common/quotationlist'),
    '报价单列表'
);
?>
<div class="bor_back m-top" style="height:100px;padding-left:10px;padding-top:7px">
    <p class="txxx">报价单管理
        <span class="float_r" style="margin-right:20px ;*margin-top:-35px">
            <a href="<?php echo Yii::app()->createUrl('pap/quotation/draft'); ?>" style="text-decoration:none;border-bottom:none;" class="txxx">草稿箱</a></span>
    </p>
    <p style="margin-top:10px">
        <label class="label1">报价单编号：</label>
        <input type="text" class="input"  id='no' value='<?php echo $_GET['no']; ?>'>
        <label class="label1"  >报价单状态：</label>
        <select class="select" id='status' style="width:80px">
            <option value ="">全部</option>
            <option value ="1" <?php if ($_GET['status'] == 1) echo 'selected="selected"'; ?>>已报价待确认</option>
            <option value ="2" <?php if ($_GET['status'] == 2) echo 'selected="selected"'; ?>>已确认</option>
            <option value ="4" <?php if ($_GET['status'] == 4) echo 'selected="selected"'; ?>>已拒绝</option>
            <option value ="5" <?php if ($_GET['status'] == 5) echo 'selected="selected"'; ?>>已失效</option>
        </select>
        <label class="labell">发送时间段：</label>
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
        <span class="add m_left">
            <span class="jiahao">+</span>
        </span>
        <a href="<?php echo Yii::app()->createUrl('/pap/quotation/select'); ?>" class="color_blue alternative">新建</a>
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
                'headerHtmlOptions' => array('width' => '130px')
            ),
            array(
                'name' => '发送时间',
                'value' => 'date("Y-m-d H:i:s",$data[CreateTime])',
                'headerHtmlOptions' => array('width' => '120px'),
            ),
            array(
                'name' => '状态',
                'type' => 'raw',
                'value' => 'QuotationService::getstatus($data[Status])',
                'headerHtmlOptions' => array('width' => '110px')
            ),
            array(
                'name' => '发起人',
                'value' => '$data[from]',
                'headerHtmlOptions' => array('width' => '60px')
            ),
            array(
                'class' => 'CButtonColumn',
                'header' => '操作',
                'template' => '{update}{viewquo}{viewinq}',
                'buttons' => array(
                    'update' => array(
                        'label' => '修改',
                        'visible' => '$data[Status]==1||$data[Status]==3',
                        'url' => '$data[InquiryID]==0?(Yii::app()->createUrl("/pap/quotation/quoscheme",array("update"=>"t","quoid"=>$data[QuoID],"sid"=>$data[ServiceID]))):(Yii::app()->createUrl("/pap/inquirylist/scheme",array("update"=>"t","inqid"=>$data[InquiryID],"return"=>"quo")))'
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
                        'url' => 'Yii::app()->createUrl("/pap/inquirylist/viewquo",array("inqid"=>$data[InquiryID],"return"=>"quo"))'
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
            var url = Yii_baseUrl + '/pap/quotation/index';
            var data = {};
            data.no = encodeURIComponent($('#no').val());
            data.status = $('#status').val();
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
