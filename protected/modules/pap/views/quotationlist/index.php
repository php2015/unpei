<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->theme->baseUrl; ?>/css/yxgl.css"  />
<style>
    .content2{
        padding: 0 !important;
    }
</style>
    <?php
$this->pageTitle = Yii::app()->name . ' - 收到的报价单';
$status = Yii::app()->request->getParam('sta');
$this->breadcrumbs = array(
    '询报价管理' => Yii::app()->createUrl('common/inquerylist'),
    '收到的报价单', // => Yii::app()->createUrl('pap/quotationlist/index'),
//    '报价单列表'
);

Yii::app()->clientScript->registerScript('search', '
$("#search").click(function(){
    var no=$("#no").val();
    var status=$("#status").val();
    var start=$("#starttime").val().replace(/-/g,"");
    var end=$("#endtime").val().replace(/-/g,"");
    if(start>end&&start!=""&&end!="")
    {
        alert("请输入正确的时间段");
        $("#endtime").val("");
        return false;
    }
     var datetype = /^(\d{4})-(\d{2})-(\d{2})$/
    if($("#starttime").val() && !datetype.test($("#starttime").val())){
        alert("请输入正确的时间");
         return false;
    }
   if($("#endtime").val() && !datetype.test($("#endtime").val())){
        alert("请输入正确的时间");
         return false;
    }
    $.fn.yiiGridView.update("quolists",
        {
            url:window.location.href,
            data:{
                 no:no,
                 status:status,
                 start:start,
                 end:end
            }
        }
    )
});        
');
?>

<div class="bor_back m-top" >
    <p class="txxx">收到的报价单</p>
    <p style="height:40px;padding-left:10px;padding-top:7px">
        <label class="label1">报价单编号：</label>
        <input type="text" class="input"  id='no'>
        <label class="label1"  >报价单状态：</label>
        <select class="select" id='status'>
            <option value ="">全部</option>
            <option value ="1" >已报价待确认</option>
            <option value ="2" >已确认</option>
            <option value ="4" >已拒绝</option>
            <option value ="5" >已失效</option>
        </select>
        <label class="labell">发送时间段：</label>
        <?php
        $this->widget('zii.widgets.jui.CJuiDatePicker', array(
            'language' => 'zh_cn',
            'name' => 'starttime',
            'options' => array(
                'dateFormat' => 'yy-mm-dd', //database save format  
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
            'name' => 'endtime',
            'options' => array(
                'dateFormat' => 'yy-mm-dd', //database save format  
            ),
            'htmlOptions' => array(
                'style' => 'width:90px;',
                'class' => 'input'
            )
        ));
        ?>  
        <input type="submit" value="查   询"  class="submit m_left" id="search">
    </p>
</div>

<div class="ddgl_content3 m_top10 bor_back2">
    <?php
    $this->widget('widgets.default.WGridView', array(
        'id' => 'quolists',
        'dataProvider' => $lists,
        'ajaxUpdate' => true,
        'columns' => array(
//            array(
//                'class' => 'CCheckBoxColumn',
//                'headerHtmlOptions' => array('width' => '33px'),
//                'checkBoxHtmlOptions' => array('name' => 'selectinq'),
//                'selectableRows' => '1',
//                'value' => '$data[QuoID]'
//            ),
            array(
                'name' => '报价单编号',
                'value' => '$data[QuoSn]',
                'headerHtmlOptions' => array('width' => '170px')
            ),
            array(
                'name' => '报价单名称',
                'value' => '$data[Title]',
                'headerHtmlOptions' => array('width' => '170px')
            ),
            array(
                'name' => '经销商名称',
                'value' => 'QuotationService::getservicename($data[DealerID])',
                'headerHtmlOptions' => array('width' => '170px'),
            ),
            array(
                'name' => '发送时间',
                'type' => 'raw',
                'value' => 'date("Y-m-d H:i:s",$data[CreateTime])',
                'headerHtmlOptions' => array('width' => '120px')
            ),
            array(
                'name' => '状态',
                'type' => 'raw',
                'value' => 'QuotationService::getstatus($data[Status])',
                'headerHtmlOptions' => array('width' => '100px'),
            ),
            array(
                'class' => 'CButtonColumn',
                'header' => '操作',
                'headerHtmlOptions' => array('width' => '50px'),
                'template' => '{view}',
                'buttons' => array(
                    'view' => array(
                        'lable' => '详情',
                        'url' => 'Yii::app()->createUrl("/pap/quotationlist/viewquo",array("quoid"=>$data[QuoID]))'
                    )
                )
            )
        )
    ))
    ?>
</div>
<script>
    $(document).ready(function(){
        var status="<?php echo $status ?>";
        $('#status').val(status);
        $("#no").val('<?php echo $_GET['no'] ?>');
        //$("#status").val('<?php echo $_GET['status'] ?>');
        $("#starttime").val('<?php echo $_GET['start'] ?>');
        $("#endtime").val('<?php echo $_GET['end'] ?>');
    })
    $(function(){
        //报价
        $('#quotation').click(function(){
            var obj=$('#inqlists').find('[type=checkbox]:checked');
            if(obj.length==0)
            {
                alert('请选择一条询价单数据');
                return false;
            }
            var objtr=obj.parents('tr');
            if(objtr.find('td:eq(4)').text()!='待报价')
            {
                alert('请选择待报价的询价单数据');
                return false;
            }
            window.location.href=Yii_baseUrl+'/pap/inquirylist/scheme/inqid/'+obj.val();
        })
        
        //询价单列表单击事件
        $(document).on("click","#inqlists tbody tr",function(){
            $('#inqlists').find('input[type="checkbox"]').removeAttr('checked');
            $(this).find('input[type="checkbox"]').attr('checked',true);
        })
    })
</script>
