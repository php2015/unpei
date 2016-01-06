<?php include 'tabs_active_contacts.php'; ?>
<div class='tab-content'>
    <div id="tab1">
        <div class="checkbox-list">
            <div class='auto_height'>
                <?php echo CHtml::hiddenField(count, count($models), array('class' => 'width100 count')); ?>
                <?php echo CHtml::button('添加客户类别', array('class' => 'submit', 'id' => 'addCategory')); ?>
                <?php echo CHtml::label('', '', array('class' => "count_error")); ?>
            </div>
            <div id="message"></div><!-- 显示操作信息 -->
            <div class='mt1em'></div>
            <?php if (!empty($models)): ?>
                <table cellspacing=0 cellpadding=0 >
                    <thead>
                        <tr>
                            <td width=150>客户类别</td>
                            <td width=60>操作</td>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($models as $model): ?>
                            <tr>
                                <td><?php echo $model['category']; ?></td>
                                <td><?php echo CHtml::link('修改', 'javascript:void(0)', array('class' => 'modifyCategory', 'key' => $model['id'])); ?>
                                    <?php echo CHtml::link('删除', 'javascript:void(0)', array('id' => 'delete', 'deleteid' => $model['id'])); ?></td>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            <?php else: ?>
                <p>搜索到&nbsp;<font color=red>0</font>&nbsp;条数据&nbsp;&nbsp;<span style="text-decoration: underline"><?php echo CHtml::link('重新加载', array('contact/businessContacts')); ?></span></p>
            <?php endif; ?>
        </div>
    </div>
</div>
<!-- 添加/编辑客户类别(BEGIN) -->
<?php
$this->beginWidget('zii.widgets.jui.CJuiDialog', array(
    'id' => 'mydialog',
    'options' => array(
        'title' => Yii::t('query', '添加客户类别'),
        'autoOpen' => false,
        'modal' => 'true',
        'width' => '450px',
        'height' => 'auto'
    )
));
?>
<div class='tab-content'>
<?php echo CHtml::label('', '', array('class' => 'label')); ?>
            <?php echo CHtml::label('', '', array('class' => 'input_error')); ?>
    <div class='form-list'>
        <p class="form-row">
<?php echo CHtml::label('客户类别:', '', array('class' => 'label')); ?>
            <?php echo CHtml::textField('category', '', array('class' => 'width213 input category')); ?>
        </p>
        <p class="form-row">
            <?php echo CHtml::label('', '', array('class' => 'label')); ?>
<?php echo CHtml::hiddenField('id', '', array('class' => 'width130 input category_id')); ?>
<?php echo CHtml::button('保存', array('id' => 'save', 'class' => 'submit', 'style' => "cursor:pointer")); ?>
        </p>	
    </div>
</div>
<?php $this->endWidget('zii.widgets.jui.CJuiDialog'); ?>
<!-- 添加/编辑客户类别(END) -->
<script>
    $(document).ready(function(){
        //新增客户类别
        $("#addCategory").click(function(){
            var count = $(".count").val();
            if(count >= 4){
                $('.count_error').text('最多可添加4种客户类别').css('color','red');
            }
            else{
                $('.count_error').text('');
                $("#ui-dialog-title-mydialog").text('添加客户类别');
                $("#mydialog").dialog("open");
            }
        });
        //修改客户类别
        $(".modifyCategory").click(function(){
            $("#ui-dialog-title-mydialog").text('修改客户类别');
            $("#mydialog").dialog('open');
            var id = $(this).attr('key');
            $.getJSON(Yii_baseUrl + "/cim/contact/getCategory",{id:id},function(data){
                $(".category").val(data.category);
                $(".category_id").val(data.id);	//当前需要修改的记录ID
            });
        });
        $("#save").click(function(){
            if(confirm("您确定要保存吗？")){
                var id = $(".category_id").val();
                var category = $(".category").val();
                if(category){				
                    $.getJSON(Yii_baseUrl+'/cim/contact/processCategory',{id:id,category:category},function(data){
                        if(data==1){
                            $("<div class='successmessage' style='text-align: center;'>更新成功</div>").insertAfter($("#message")).animate({opacity: 1.0}, 500).fadeOut("slow",function(){
                                //隐藏时把元素删除
                                $(this).remove();
                            });
                            setTimeout("location.reload()",10);
                            $("#mydialog").dialog('close');
						
                        }
                        else{
                            $("<div class='errormessage' style='text-align: center;'>更新失败，请联系管理员！</div>").insertAfter($("#message")).animate({opacity: 1.0}, 500).fadeOut("slow",function(){
                                //隐藏时把元素删除
                                $(this).remove();
                            }); 
                            setTimeout("location.reload()",10);
                            $("#mydialog").dialog('close');
                        }			
                    });	
                }
                else{
                    $(".input_error").html("客户类别 不可为空白.").css('color','red');
                }
            }	
        });
        $("#delete").live('click',function(){		
            var id = $(this).attr("deleteid");
            var url = Yii_baseUrl + "/cim/contact/deleteCategory";
            if(window.confirm("您确定要删除吗?"))
            {
                $.getJSON(url,{id:id},function(result){
                    if(result==1){
                        $("<div class='successmessage' style='text-align: center;'>删除成功</div>").insertAfter($("#message")).animate({opacity: 1.0}, 2000).fadeOut("slow",function(){
                            //隐藏时把元素删除
                            $(this).remove();
                        }); 
                        setTimeout("location.reload()",100);
                        $("a[deleteid="+id+"]").parents("tr").remove();
                    }else{
                        $("<div class='errormessage' style='text-align: center;'>删除失败</div>").insertAfter($("#message")).animate({opacity: 1.0}, 2000).fadeOut("slow",function(){
                            //隐藏时把元素删除
                            $(this).remove();
                        }); 
                    }
                })
            }
        });
    })
</script>