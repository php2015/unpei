<?php
	$this->pageTitle = Yii::app()->name . ' - ' . "商品模板管理";
?>
<div class="content jpmbk" style="margin-left:0px">
    
    <div pre="tab" class="tabs">
        <a class="left-indent">&nbsp;</a>
        <a class="active" href="#">嘉配模板库</a>
        <a href="<?php echo Yii::app()->createUrl('maker/templatemanage/add') ?>">新建模板</a>
    </div>
    <div class="auto_height" >
        <?php if (Yii::app()->user->hasFlash('success')): ?>  
            <div class="successmessage" id='message'>
                <?php echo Yii::app()->user->getFlash('success'); ?>  
            </div>
        <?php endif ?>
        <?php if (Yii::app()->user->hasFlash('failed')): ?>  
            <div class="errormessage" id='message'>
                <?php echo Yii::app()->user->getFlash('failed'); ?>  
            </div>
        <?php endif ?>
        <div id="tab1" class='tab-content'>
            <div class="title">嘉配模板库</div>
            <div class='normal-list'>
                <table cellspacing=0 cellpadding=0>
                	<?php if (!empty($sys_result)) { ?>
                    <thead style="line-height: 22px">
                        <tr>
                            <td width='70'>模板名称</td>
                            <td width='70'>创建时间</td>
                            <td width='70'>操作</td>
                        </tr>
                    </thead>
                        <tbody>
                            <?php foreach ($sys_result as $value): ?>
                                <tr>
                                    <td><?php echo $value['name'] ?></td>
                                    <td><?php echo date('Y-m-d H:i:s', $value['createtime']) ?></td>
                                    <td>
                                        <a href="<?php echo Yii::app()->createUrl('maker/templatemanage/modify', array('id' => $value['id'])) ?>">编辑</a>
                                        <a href="<?php echo Yii::app()->createUrl('maker/templatemanage/ImportOutExcel', array('id' => $value['id'])) ?>">下载</a>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    <?php }else { ?>
                        <tr><td colspan="3" align="center">搜索到&nbsp;<font color=red>0</font>&nbsp;条数据 &nbsp;&nbsp;</td></tr>
                    <?php } ?>
                </table>
                <div class="pagelist text-c">
    				 <?php $this->widget('widgets.default.WLinkPager', array(
    				 'pages' => $page,
    				 )) ?>
				</div>
            </div>
            <div style="height:60px"></div>
            <div class="title">用户模板库</div>
            <div class='normal-list'>
                <table cellspacing=0 cellpadding=0>
                <?php if (!empty($uc_result)) { ?>
                    <thead>
                        <tr>
                            <td width='70'>模板名称</td>
                            <td width=70>创建时间</td>
                            <td width=70>操作</td>
                        </tr>
                    </thead>
                        <tbody>
                            <?php foreach ($uc_result as $value): ?>
                                <tr>
                                    <td><?php echo $value['name'] ?></td>
                                    <td><?php echo date('Y-m-d H:i:s', $value['createtime']) ?></td>
                                    <td>
                                        <a href="<?php echo Yii::app()->createUrl('maker/templatemanage/modify', array('id' => $value['id'])) ?>">编辑</a>
                                        <span  class="ids" crowid="<?php echo $value['id']?>" style="cursor:pointer"> 删除</span>
                                        <a href="<?php echo Yii::app()->createUrl('maker/templatemanage/ImportOutExcel', array('id' => $value['id'])) ?>">下载</a>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    <?php }else { ?>
                        <tr><td colspan="3" align="center">搜索到&nbsp;<font color=red>0</font>&nbsp;条数据 &nbsp;&nbsp;</td></tr>
                    <?php } ?>
                </table>
                  <div class="pagelist text-c">
    				 <?php $this->widget('widgets.default.WLinkPager', array(
    				 'pages' => $pages,
    				 )) ?>
				</div>	
            </div>
          
            <div style="height:120px"></div>
            <div class="block-shadow"></div>
        </div>
    </div>
</div>
<?php 
 //这是一段,在显示后定里消失的JQ代码,已集成至Yii中.
Yii::app()->clientScript->registerScript(
'myHideEffect',
'$("#message").animate({opacity: 1.0}, 2000).fadeOut("slow");',
CClientScript::POS_READY
);
?>
<script type="text/javascript">
       $('.ids').click(function(){
	 	var crowid=$(this).attr('crowid');
		 if(crowid=='')
		 {
			 return false;
		 }
		 var confm=confirm('确定要删除所选择数据?');
			if(confm==false)
			{
				return false;
			}
			var url=Yii_baseUrl +"/maker/templatemanage/delete";
			$.ajax({
		    url: url,
		    type:"POST",
		    data:{
		         crowid: crowid
		         },
		     dataType: "json",
		     success: function(data)
		     {
		        if(data)
		          {
		        	location.href="<?php echo Yii::app()->createUrl('/maker/templatemanage/index');?>";
		          }
		     }
			});
	 });
</script>