<style>
    #recommandlist-grid{
        width: 95%;
    }
</style>
<?php
$this->breadcrumbs = array(
    'recommend' => array('index'),
    'Manage',
);
$this->menu=array(
//        array('label'=>'下载模板','icon'=>'list','url'=>Yii::app()->baseUrl .'/themes/default/template/recommend.xlsx'),
        array('label'=>'添加推荐','icon'=>'list','url'=>array('create')),
        )
?>
<h1>推荐名录</h1>

<form id="Recommend" enctype="multipart/form-data" method="post" action="recomupload" >
    <a style="background-color: #66ff66;float: left;height: 30px;line-height: 30px" href="<?php echo Yii::app()->baseUrl; ?>/themes/default/template/recommend.xlsx">下载模板</a>&nbsp;&nbsp;&nbsp;&nbsp;
    <sapn style=" border: 1px solid #000;width: 200px;overflow: hidden;display:block;float: left;margin-left: 20px">
       <input type="file" name="inputExcel" >  
    </sapn>
    <input type="button" id="submitRecommend" value="上传">
     <input type="button"  id="submitRe" onclick="Sendeamil()" value="代注册" style="margin-left: 50px">
<input type="hidden" name="YII_CSRF_TOKEN" value="<?php echo Yii::app()->request->csrfToken; ?>" />
</form>
<div id="messagerInfo" style="display: none">
  <?php echo $message;?>  
</div>

<?php
$this->widget('widgets.default.WGridView', array(
    'id' => 'recommandlist-grid',
    'dataProvider' => $data->search(),
    'filter' => $data,
    'ajaxUpdate' => false, //禁用AJAX分页或排序
    'columns' => array(
        array(
            'class' => 'CCheckBoxColumn',
            'headerHtmlOptions' => array('width' => '33px'),
            'checkBoxHtmlOptions' => array('name' => 'selectdel[]'),
            'selectableRows' => '2',
        //'value'=>'CHtml::encode($data->id)',
        ),
          array(
            'name' => '姓名',
            'value' => '$data->Name',
            'filter' => false,
        ),
        array(
            'name' => '电话',
            'value' => 'RecommendList::ifExietMobPhone($data->MobPhone)',
            'filter' => false,
        ),
          array(
            'name' => '机构类型',
            'value' => 'RecommendList::itemAlias("CompanyType",$data->CompanyType)',
            'filter' => false,
        ),
          array(
            'name' => '邮箱',
            'value' => 'RecommendList::ifExietEmail($data->Email)',
            'filter' => false,
        ),
          array(
            'name' => '机构名称',
            'value' => 'RecommendList::ifExietorganName($data->CompanyName)',
            'filter' => false,
             'headerHtmlOptions' => array('width' => '70px')
        ),
          array(
            'name' => '	地址',
            'value' =>'RecommendList::showAddress($data->Province,$data->City,$data->Area)' ,
            'filter' => false,
             'headerHtmlOptions' => array('width' => '170px')
        ),
            array(
            'name' => '	推荐人',
            'value' =>'RecommendList::showOrganname($data->OrganID)' ,
            'filter' => false,
        ),
            array(
            'name' => '推荐状态',
            'value' =>'未推荐',//'RecommendList::showRecomStatus($data->RecomStatus)' ,
           'filter' => false,
           'headerHtmlOptions' => array('width' => '70px')
        ),
          array(
               'header'=>'操作',
		'class'=>'bootstrap.widgets.TbButtonColumn',
                'headerHtmlOptions' => array('width' => '70px')
		),
      
    ),
));
?>
 <script type="text/javascript">
     var red=$("#recommandlist-grid").find('tr td').each(function(){
         var test=$(this).text();
         var res=test.lastIndexOf('(已存在)')
         if(res>0){
             $(this).css('color','red')
         }
     });
     
    var messager=$("#messagerInfo").text();
    messager=$.trim(messager)
    if(messager){
     alert(messager)
     if(messager=='上传成功！'){
         location=location 
     }
    }
 $("#submitRecommend").click(function(){
     $("#Recommend").submit()
     })
     
 function Sendeamil(){
     var submitRe=$("#submitRe").val();
     if(submitRe=='注册中'){
         alert('注册中，请稍后。。。')
         return false
     }
         var ids='';
         var limit=$("input[name=YII_CSRF_TOKEN]").val();
         $("#recommandlist-grid").find('tbody tr').each(function(){
             var id=$(this).find('input:checkbox[name="selectdel[]"]:checked').val();
                  if(parseInt(id)>0){
                     ids+=id+','  
                  } 
                  
         })
         if(!ids){
             alert("请选择数据")
             return false
         }
            $("#submitRe").val('注册中');
       $.ajax({
           url:'<?php echo Yii::app()->createUrl('recommend/emailandrecord')?>',
           data:{
               'ids':ids,
               'YII_CSRF_TOKEN':limit
           },
           type:'post',
           dataType:'json',
           success:function(reg){
               alert(reg.errMsg)
               $("#submitRe").val('待注册');
               if(reg.success){
                   location=location   
               }
           }
       });
      
       }


 </script>