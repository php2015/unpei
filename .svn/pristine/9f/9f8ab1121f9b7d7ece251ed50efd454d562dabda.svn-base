<?php
$this->pageTitle = Yii::app()->name . ' - 收到的询价单';
$status = Yii::app()->request->getParam('sta');
$this->breadcrumbs = array(
    '报价单管理' => Yii::app()->createUrl('common/quotationlist'),
    '收到的询价单'
);
?>
<div class="bor_back m-top" style="height:100px;padding-left:10px;padding-top:7px;*height:110px">
    <p class="txxx">收到的询价单</p>
    <p style="margin-top:10px">
        <label class="label1">询价单编号：</label>
        <input type="text" class="input"  id='no' style="vertical-align:middle" value='<?php echo $_GET['no'];?>'>
        <label class="label1"  >询价单状态：</label>
        <select class="select" id='status' style="vertical-align:middle;width:80px">
            <option value ="">全部</option>
            <option value ="0" <?php if($_GET['status']==='0') echo 'selected="selected"';?>>待报价</option>
            <option value ="1" <?php if($_GET['status']==1) echo 'selected="selected"';?>>已报价待确认</option>
            <option value ="2" <?php if($_GET['status']==2) echo 'selected="selected"';?>>已确认</option>
            <option value ="4" <?php if($_GET['status']==4) echo 'selected="selected"';?>>已拒绝</option>
            <option value ="5" <?php if($_GET['status']==5) echo 'selected="selected"';?>>已失效</option>
        </select>
        <label class="labell">发送时间段：</label>
        <?php
        $this->widget('zii.widgets.jui.CJuiDatePicker', array(
            'language' => 'zh_cn',
            'name' => 'start',
            'value'=>$_GET['start'],
            'options' => array(
                'dateFormat' => 'yy-mm-dd',
                'changeMonth'=>true,
                'changeYear'=>true
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
            'value'=>$_GET['end'],
            'options' => array(
                'dateFormat' => 'yy-mm-dd',
                'changeMonth'=>true,
                'changeYear'=>true
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
        <a href="javascript:void(0)" id="quotation" class="color_blue alternative">报价</a>
    </p>
</div>
<div class="ddgl_content3  bor_back">
    <?php
    $this->widget('widgets.default.WGridView', array(
        'id' => 'inqlists',
        'dataProvider' => $inqlists,
        'columns' => array(
            array(
                'class' => 'CCheckBoxColumn',
                'headerHtmlOptions' => array('width' => '33px'),
                'checkBoxHtmlOptions' => array('name' => 'selectinq'),
                'selectableRows' => '1',
                'value' => '$data[InquiryID]'
            ),
            array(
                'name' => '询价单编号',
                'value' => '$data[InquirySn]',
                'headerHtmlOptions' => array('width' => '170px')
            ),
            array(
                'name' => '修理厂名称',
                'value' => 'QuotationService::getservicename($data[OrganID])',
                'headerHtmlOptions' => array('width' => '170px'),
            ),
            array(
                'name' => '发送时间',
                'type' => 'raw',
                'value' => 'date("Y-m-d H:i:s",$data[CreateTime])',
                'headerHtmlOptions' => array('width' => '120px')
            ),
            array(
                'name' => '来源',
                'type' => 'raw',
                'value' => '$data[from]',
                'headerHtmlOptions' => array('width' => '100px'),
            ),
            array(
                'name' => '状态',
                'type' => 'raw',
                'value' => '$data[stamsg]',
                'headerHtmlOptions' => array('width' => '100px'),
            ),
            array(
                'class' => 'CButtonColumn',
                'header' => '操作',
                'headerHtmlOptions' => array('width' => '50px'),
                'template' => '{update}{view}',
                'buttons' => array(
                    'update' => array(
                        'label' => '修改报价单',
                        'visible' => '$data[sta]==1&&$data[State]!=1',
                        'url' => 'Yii::app()->createUrl("/pap/inquirylist/scheme",array("update"=>"t","inqid"=>$data[InquiryID]))'
                    ),
                    'view' => array(
                        'lable' => '详情',
                        'url' => 'Yii::app()->createUrl("/pap/inquirylist/viewquo",array("inqid"=>$data[InquiryID]))'
                    )
                )
            )
        )
    ))
    ?>
</div>
<script>
    $(function() {
        //报价
        $('#quotation').click(function() {
            var obj = $('#inqlists').find('[type=checkbox]:checked');
            if (obj.length == 0)
            {
                alert('请选择一条询价单数据');
                return false;
            }
            var objtr = obj.parents('tr');
            if (objtr.find('td:eq(5)').text() != '待报价')
            {
                alert('请选择待报价的询价单数据');
                return false;
            }
            window.location.href = Yii_baseUrl + '/pap/inquirylist/scheme/inqid/' + obj.val();
        })

        //询价单列表单击事件
        $(document).on("click", "#inqlists tbody tr", function() {
            $('#inqlists').find('input[type="checkbox"]').removeAttr('checked');
            $(this).find('input[type="checkbox"]').attr('checked', true);
        })

        //搜索
        $('#search').click(function() {
            var url = Yii_baseUrl + '/pap/inquirylist/index';
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
