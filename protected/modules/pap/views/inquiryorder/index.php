<style type="text/css">
    
.jiahao {
    background: none repeat scroll 0 0 #0164c2;
    color: #fff;
    font-weight: bold;
    padding: 2px 5px;
}
</style>
<?php $this->pageTitle = Yii::app()->name . '-' . '询价单列表' ?>
<?php
$this->breadcrumbs = array(
    '询报价管理'=>Yii::app()->createUrl('common/inquerylist'),
    '询价单管理',
//    '询价单列表',
);
?>
<?php
Yii::app()->clientScript->registerScript('search', '
	$("#searchinquirybutton").click(function(){
        var startdate=$("#startdate").val();
        var enddate=$("#enddate").val();
        var status=$("select[name=status]").val();
        var inquirySn=$("input[name=inquirySn]").val();
        if(enddate){
           if(enddate<startdate){
            alert("起始时间不能大于截止时间")
            return false
        }  
        }
          var datetype = /^(\d{4})-(\d{2})-(\d{2})$/
        if(startdate && !datetype.test(startdate)){
            alert("请输入正确的时间");
             return false;
        }
       if(enddate && !datetype.test(enddate)){
            alert("请输入正确的时间");
             return false;
        }  
        $.fn.yiiGridView.update( "Inquirylist",
        {
            url:window.location.href,
             data:{
             startdate:startdate,
             enddate:enddate,
             status:status,
             inquirySn:inquirySn
            }
        }
            )
	});       
	');
?>

<div class="bor_back m-top">
    <p class="txxx">询价单管理</p>
    <div class="txxx_info4" style="margin: 15px 0 0 20px">
        <form id="searchinquiry">
            <span>询价时间：</span>
            <?php
            $this->widget('zii.widgets.jui.CJuiDatePicker', array(
                'language' => 'zh_cn',
                'name' => 'startdate',
                'options' => array(
                    'dateFormat' => 'yy-mm-dd', //database save format  
                    'yearRange' => ''
                ),
                'htmlOptions' => array(
                    'style' => 'width:120px;vertical-align:middle',
                    'class' => 'input'
                )
            ));
            ?>   <span>-</span>          <?php
            $this->widget('zii.widgets.jui.CJuiDatePicker', array(
                'language' => 'zh_cn',
                'name' => 'enddate',
                'options' => array(
                    'dateFormat' => 'yy-mm-dd', //database save format  
                    'yearRange' => ''
                ),
                'htmlOptions' => array(
                    'style' => 'width:120px;vertical-align:middle',
                    'class' => 'input'
                )
            ));
            ?> 
            <span class="m_left">状态：</span>
            <select class="select select2 td_w80" name="status" style="vertical-align:middle" >
                <option value ="">全部</option>
                <option value ="0">待报价</option>
                <option value ="1">已报价待确认</option>
                <option value ="2">已确认</option>
                <option value ="3">已撤销</option>
                <option value ="4">已拒绝</option>
                <option value ="5">已失效</option>
            </select>
            <span class="m_left">询价单编号：</span>
            <input type="text"  class=" input input3 " name="inquirySn"  style="vertical-align:middle" >
            <input type="button" value="查 询" class="submit m_left" id="searchinquirybutton" style="vertical-align:middle" >
        </form>
        <div class=" m-top add_xjd ">
        <p style="margin-top:5px"><span class="add m_left"><span class="jiahao">+</span></span>
        <a  class="add_wz alternative" href="<?php echo Yii::app()->createUrl('pap/inquiryorder/inquiryadd') ?>">新建</a>
        <a  class="add_wz alternative" onclick="returninquiry()" style="margin-left:10px;cursor:pointer">撤销</a>
        <a  class="add_wz alternative" href="javascript:void(0);" id="editinquiery" style="margin-left:10px">修改</a>
        </p>
    </div>
        <!--<p class=" m-top"><button class=" button3 button4" onclick="window.location.href='<?php echo Yii::app()->createUrl('pap/inquiryorder/inquiryadd') ?>'">新建</button><span class="m_left20"></span><a href="javascript:void(0);" class="color_blue" onclick="returninquiry()">撤销</a><span class="m_left20"></span><a href="javascript:void(0);" class="color_blue" id="editinquiery">修改</a></p>-->
    </div>
    <div class="ddgl_content3 m_top10" >
        <?php
        $this->widget('widgets.default.WGridView', array(
            'id' => 'Inquirylist',
            'ajaxUpdate' => true,
            'dataProvider' => $dataProvider,
            'columns' => array(
                array(
                    'class' => 'CCheckBoxColumn',
                    'headerHtmlOptions' => array('width' => '33px'),
                    'checkBoxHtmlOptions' => array('name' => 'selectdel[]'),
                    'selectableRows' => '1',
                    'value' => 'CHtml::encode($data->InquiryID)',
                ),
                array(
                    'name' => '询价单编号',
                    'value' => '$data->InquirySn'
                ),
                array(
                    'name' => '订单编号',
                    'value' => 'CHtml::encode($data->OrderSn)'
                ),
                array(
                    'name' => '询价时间',
                    'value' => 'date("Y-m-d H:i:s",$data->CreateTime)'
                ),
                array(
                    'name' => '状态',
                    'type' => 'raw',
                    'value' => 'PapInquiry::Showfact($data->Status,"inquiryStatus")'
                ),
                 array(
                    'name' => '来源',
                    'type' => 'raw',
                    'value' => 'InquiryorderService::getfrom($data->State)'
                ),
//                array(
//                    'class' => 'CButtonColumn',
//                    'header' => '询价单详情',
//                    'template' => '{view}',
//                    'buttons' => array(
//                        'view' => array(
//                            'label' => '询价单详情',
//                            'url' => 'Yii::app()->createUrl("/pap/inquiryorder/inquirydetail",array("inquiryID"=>$data->InquiryID))'
//                        ),
//                    )
//                )
                array(
                    'name'=>'询价单详情',
                    'type'=>'raw',
                    'value'=>'InquiryorderService::showdetail($data->InquiryID)'
                )
            )
        ))
        ?>
        <!--content1即又半部分结束-->
    </div>
</div>
<script type="text/javascript">
      $(document).ready(function(){
        $("input[name=startdate]").val('<?php echo $_GET['startdate'] ?>');
        $("input[name=enddate]").val('<?php echo $_GET['enddate'] ?>');
        $("select[name=status]").val('<?php echo $_GET['status'] ?>');
        $("input[name=inquirySn]").val('<?php echo $_GET['inquirySn'] ?>');
    })
    $("#Inquirylist tr").click(function(){
        $('#Inquirylist').find('input[type="checkbox"]').removeAttr('checked');
        $(this).find('input[name="selectdel[]"]').attr('checked',true)
    })
    //撤销询价单
    function returninquiry(){
        var InquiryID = $("#Inquirylist").find('input[name="selectdel[]"]:checked').val();
        var statu= $("#Inquirylist").find('input[name="selectdel[]"]:checked').parent('td').parent('tr');
        var status=statu.children('td').eq(4).text();
        if(status=='已撤销'){
            alert('此询价单已撤销')
            return false   
        }
        if(status=='已确认'){
            alert('已确认的询价单不可撤销')
            return false   
        }
        if(status=='已失效'){
            alert('该询价单已失效')
            return false   
        }
        if(!InquiryID){
            alert('请选择要撤销的询价单')
            return false
        }
        if(confirm('您确定要撤销此询价单吗？')){
            $.ajax({
                url:'<?php echo Yii::app()->createUrl('pap/inquiryorder/returninquiry') ?>',
                data:{'InquiryID':InquiryID},
                type:'post',
                success:function(lms){
                    if(lms==1){
                        alert('撤销成功')
                       $("#searchinquirybutton").click();
                    }else{
                        alert('撤销失败')
                    }
                }
            })    
        }
    }
    //修改询价单
    $("#editinquiery").click(function(){
    var InquiryID = $("#Inquirylist").find('input[name="selectdel[]"]:checked').val();
        var statu= $("#Inquirylist").find('input[name="selectdel[]"]:checked').parent('td').parent('tr');
        var status=statu.children('td').eq(4).text();
       
        if(status=='待报价'){
            window.location.href='<?php echo Yii::app()->baseUrl.'/pap/inquiryorder/editinquiry?inquiryID='?>'+InquiryID
        }else{
               if(!status){
              alert('请选择要修改的询价单')
              return false  
            }else{
               alert('只有待报价的询价单才可以修改')   
            }
        }
    })
</script>