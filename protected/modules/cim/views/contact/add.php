     <?php 
     $this->breadcrumbs=array(
       '业务联系人管理'=>Yii::app()->createUrl('/cim/contact/index'),
         '添加业务联系人'
     )
     ?> 
<div class="bor_back m_top10">
    <div class="txxx_info">
                          <div class="form">
                     <?php 
                    $form=$this->beginWidget('CActiveForm',array(
                        'id'=>'contactadd-form',
                         'enableAjaxValidation'=>true,
                        'enableClientValidation'=>true,
                    ));
                     ?>
                
                     <div class="row" style="padding:10px">
                     <label>机构名称：</label>
                     <?php echo $form->textField($model,'OrganName',array('class'=>'input' ,'id'=>'oname','style'=>"width:120px", "readonly"=>'readonly','value'=>$model['OrganName']))?>
                      <input type="button" id="button" value="请选择机构" >
                      <?php echo $form->hiddenField($model,'ContactID',array('id'=>'OID','value'=>$model['ContactID']))?>
                      <?php echo $form->error($model,'OrganName');?>
                     </div>
                      <div class="row"  style="padding:10px">
                     <label>姓名：</label>
                     <?php echo $form->textField($model,'Name',array('class'=>'input','style'=>"width:120px",'value'=>$model['Name']))?>
                          <?php echo $form->error($model,'Name');?>
                      <label>性别：</label>
                     <?php echo $form->dropdownlist($model,'Sex',array('男'=>'男','女'=>'女'),array('class'=>'input','style'=>"width:120px",'value'=>$model['Sex']))?>
                     </div>
                     
                      <div class="row" style="padding:10px">
                     <label>电话：</label>
                     <?php echo $form->textField($model,'Phone',array('class'=>'input','style'=>"width:120px",'value'=>$model['Phone']))?>
                         <?php echo $form->error($model,'Phone');?>
                      <label>邮箱：</label>
                     <?php echo $form->textField($model,'Email',array('class'=>'input','style'=>"width:120px",'value'=>$model['Email']))?>
                          <?php echo $form->error($model,'Email');?>
                     </div>
                     
                      <div class="row" style="padding:10px">
                     <label>微信：</label>
                     <?php echo $form->textField($model,'Weixin',array('class'=>'input','style'=>"width:120px",'value'=>$model['Weixin']))?>
                      <label>QQ&nbsp;：</label>
                     <?php echo $form->textField($model,'QQ',array('class'=>'input','style'=>"width:120px",'value'=>$model['QQ']))?>
                     </div>
                      <div class="row buttons">  
                     <?php echo CHtml::submitButton($model->isNewRecord ? '创建' : '保存',array('class'=>'submit','style'=>'margin-left:120px')); ?>  
                    </div>  
                     <?php $this->endWidget();?>
                           </div>
                 </div>
             </div>

     <?php     
$this->beginWidget('zii.widgets.jui.CJuiDialog', array(     
    'id'=>'organdialog',     
    'options'=>array(     
                'title'=>'机构列表',     
                'width'=>440,     
                'height'=>300,     
                'autoOpen'=>false,   
                'modal'=>true,
                ),     
            ));     

$this->renderPartial('contactorgan',array('organ'=>$organ));
$this->endWidget('zii.widgets.jui.CJuiDialog');     
?>     
<script type="text/javascript">
$('#button').click(function(){
   $('#organdialog').dialog('open');
})
$('#oname').blur(function()
{
    if($(this).val()!='')
        {
          $(this).removeClass('error');
          $('#Contacts_OrganName_em_').css('display','none');
        }
})
</script>      
