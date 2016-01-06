<style>
    .fwdlists{ border:2px solid #feca9a;width:800px; margin-left:20px; margin-top:10px;background:#fff;}
    .zdyul li{width:30%; margin-left:70px; float:left; line-height:30px;}
    table{table-layout: fixed}
</style>
<?php
$this->pageTitle = Yii::app()->name . ' - 发布报价单';
$update = Yii::app()->request->getParam('update');
$sid = Yii::app()->request->getParam('sid');
$quoid = Yii::app()->request->getParam('quoid');
$draft = $_GET['draft'];
$url = array();
if ($sid)
    $url['sid'] = $sid;
if ($quoid)
    $url['quoid'] = $quoid;
if ($update == 't') {
    $title2 = '重新选择修理厂';
    $url['update'] = 't';
    $title3 = '修改报价单';
} else {
    $title2 = '选择修理厂';
    $title3 = '发送报价单';
}
if ($draft) {
    $url['draft'] = 1;
    $title1 = '报价单草稿箱';
    $returnurl = Yii::app()->createUrl('pap/quotation/draft');
} else {
    $title1 = '发布报价单';
    $returnurl = Yii::app()->createUrl('pap/quotation/index');
}
$this->breadcrumbs = array(
    '报价单管理' => Yii::app()->createUrl('common/quotationlist'),
    $title1 => Yii::app()->createUrl('pap/quotation/index'),
    $title2
);
$nexturl = Yii::app()->createUrl('pap/quotation/quoscheme', $url);
Yii::app()->clientScript->registerScript('search', '
$("#search").click(function(){
    var organname=$("#searchname").val();
    var organphoto=$("#searchphoto").val();
    $.fn.yiiGridView.update(
        "ajaxListView",
        {
            url:window.location.href,
            data:{
                 organname:organname,
                 organphoto:organphoto
            }
        }
    )
});        
');
?>


<div class="bor_back m-top" style="min-height:700px ; position:relative">
    <input type="hidden" id="serviceid" value="<?php echo $sid; ?>">
    <input type="hidden" id="ifupdate" value="<?php echo $update; ?>">
    <input type="hidden" id="quoid" value="<?php echo $quoid; ?>">
    <p class="txxx"><?php echo $title3; ?></p>
    <p class="m_top20">
        <span class=" m_left20" style="color:red" id="wraning">请先选择发送对象</span>
    </p>

    <div class="info-box">
        <div id="serviceinfo" style="display:none">
            <p class="m-top20"><b>修理厂信息</b></p>
            <ul class="zdyul m-top">
                <li>修理厂名称：<span name="name"><?php echo $service['OrganName']; ?></span></li>
                <li>联系电话：<span name="phone"><?php echo $service['Phone']; ?></span></li>
                <li style="width:650px;padding-left:30px;text-indent:-30px">地址：<span name="address"><?php echo Area::getaddress($service[Province], $service[City], $service[Area]) . $service[Address]; ?></span></li>
                <li style="width:650px;">客户类别及折扣：<span name="type"><?php echo $service['type']; ?></span></li>
                <div style="clear:both"></div>
                <p class=" m-top5"></p>
            </ul>
        </div>
        <div style="clear:both"></div>
        <p class="m-top20"><b>经销商信息</b></p>
        <ul class="zdyul m-top">
            <li>经销商名称：<span><?php echo $dealer['OrganName']; ?></span></li>
            <li>联系电话：<span><?php echo $dealer['Phone']; ?></span></li>
            <div style="clear:both"></div>
            <p class="m-top5"></p>
        </ul>

        <div class="fwdlists">
            <div class="target_list">
                <p class="f_weight target_lm">修理厂列表</p>
                <p class="m-top">
                    <span>机构名称：</span><input type="text" class="input input3" id="searchname">
                    <span class="m_left20">手机号：</span><input type="text" class="input input3" id="searchphoto">
                    <input type="submit" class="submit f_weight" value="搜 索" id="search">
                </p>
                <br/>
                <?php
                $this->widget('widgets.default.WGridView', array(
                    'id' => 'ajaxListView',
                    'dataProvider' => $dataProvider,
                    'ajaxUpdate' => true,
                    'afterAjaxUpdate' => 'function(){ $(".goto").hide(); }',
                    'columns' => array(
                        array(
                            'class' => 'CCheckBoxColumn',
                            'headerHtmlOptions' => array('width' => '5px'),
                            'checkBoxHtmlOptions' => array('name' => 'selectservice'),
                            'selectableRows' => '1',
                            'value' => '$data[ID]'
                        ),
                        array(
                            'name' => '#',
                            'headerHtmlOptions' => array('width' => '5px'),
                            'value' => 'CHtml::encode($data[rowNo])'
                        ),
                        array(
                            'name' => '机构名称',
                            'headerHtmlOptions' => array('width' => '70px'),
                            'htmlOptions' => array('style' => 'white-space:nowrap; overflow: hidden;text-overflow:ellipsis;'),
                            'value' => '$data[OrganName]'
                        ),
                        array(
                            'name' => '手机号',
                            'headerHtmlOptions' => array('width' => '40px'),
                            'value' => '$data[Phone]'
                        ),
                        array(
                            'name' => '客户级别',
                            'headerHtmlOptions' => array('width' => '55px'),
                            'value' => '$data[type]'
                        ),
                        array(
                            'name' => '折扣率',
                            'headerHtmlOptions' => array('width' => '40px'),
                            'value' => '$data[discount]'
                        ),
                        array(
                            'name' => '机构地址',
                            'value' => 'Area::getaddress($data[Province], $data[City], $data[Area]).$data[Address]',
                            'headerHtmlOptions' => array('width' => '130px'),
                            'htmlOptions' => array('style' => 'white-space:nowrap; overflow: hidden;text-overflow:ellipsis;')
                        ),
                    )
                ))
                ?>
            </div>
        </div>
        <p class=" m_top20" align="center">
            <input type="submit" class="submit f_weight" value="下一步" id="nextstep">
            <input type="submit" class="submit f_weight" value="取 消" id="cancel">
        </p>
    </div>
</div>
<script>
    $(document).ready(function() {
        var ifedit =<?php echo $edit; ?>;
        var sid = $('#serviceid').val();
        var quoid = $('#quoid').val();
        $(".goto").hide();
        if (ifedit)
        {
            $('#wraning').hide();
            $('#serviceinfo').show();
        }

        //修理厂列表单击事件
        $(document).on("click", "#ajaxListView tbody tr", function() {
            $('#ajaxListView').find('input[type="checkbox"]').removeAttr('checked');
            $(this).find('input[type="checkbox"]').attr('checked', true);
            var serviceid = $('#ajaxListView').find('input[type="checkbox"]:checked').val();
            $('#serviceid').val(serviceid);
            $('#wraning').hide();
            var objtr = $('#ajaxListView').find('input[type="checkbox"]:checked').parents('tr');
            $('#serviceinfo').find('span[name="name"]').html(objtr.find('td:eq(2)').html());
            $('#serviceinfo').find('span[name="phone"]').html(objtr.find('td:eq(3)').html());
            $('#serviceinfo').find('span[name="address"]').html(objtr.find('td:eq(6)').html());
            var type = '该客户为<span style="color:red">' + objtr.find('td:eq(4)').html() + '</span>,其商品折扣率为<span style="color:red">' + objtr.find('td:eq(5)').html() + '</span>。';
            $('#serviceinfo').find('span[name="type"]').html(type);
            $('#serviceinfo').show();
        })

        //下一步
        $('#nextstep').click(function() {
            var serviceid = $('#serviceid').val();
            if (serviceid == ''){
                alert('请先选择修理厂');
            }
            else {
                var nexturl='<?php echo $nexturl; ?>';
                if(nexturl.indexOf('/sid/')>-1){
                    nexturl=nexturl.replace(/\/sid\/\d*/,'');                    
                }
                nexturl+='/sid/'+serviceid;
                window.location.href = nexturl;
            }
        })

        //取消
        $('#cancel').click(function() {
            if (confirm('是否确定取消?'))
            {
                if (quoid) {
                    var url = Yii_baseUrl + '/pap/quotation/cancelquo';
                    $.getJSON(url, {'quoid': quoid}, function(res) {
                        if (res.count > 2) {
                            alert('取消成功');
                            window.location.href = '<?php echo $returnurl; ?>';
                        }
                        else if (res.count == -1) {
                            alert(res.msg);
                            window.location.href = '<?php echo $returnurl; ?>';
                        }
                        else {
                            alert('取消失败');
                        }
                    })
                } else
                    window.location.href = '<?php echo $returnurl; ?>';
            }
        })
    })
</script>

