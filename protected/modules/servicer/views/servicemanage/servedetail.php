<?php 
$this->pageTitle = Yii::app()->name . ' - ' . "查看服务管理"; 
$this->breadcrumbs = array(
    '服务管理' => Yii::app()->createUrl('/common/servicelist'),
	'服务管理' => Yii::app()->createUrl("servicer/servicemanage/index"),
	'查看服务管理'
);
?>
<style>
.gsxx{ width:800px; margin:0 auto; line-height:30px}
.a_r{ text-align:right}
.a_l{text-align:left}
.a_c{ text-align:right}
.txxx3{ border-bottom:1px dashed #c9d5e3}
</style>
	<div class="bor_back m-top">
 		<p class="txxx txxx3"><?php echo $data['OperateType']?>配件</p>
		<p>
			<span style="display:block;float: right;margin-top: -25px;margin-right: 15px;">
			<a id="back" style="font-weight:400" href="javascript:void(0)">返回</a>
			</span>
		</p>
            <div class="txxx_info4">
             <div class="gsxx" style="margin-bottom:20px;">
                <p>
                   <span class="a_c">服务日期：</span>
                   <span class="a_l"><?php echo date("Y-m-d", $data['CreateTime']); ?></span>
                </p>
                <p>
                   <span class="a_c m_left24">配件：</span>
                   <span class="a_l"><?php echo $data['PartName']; ?></span>
                </p>
                <p>
                   <span class="a_c m_left24">品牌：</span>
                   <span class="a_l"><?php echo $data['Brand']; ?></span>
                </p>
                <?php if ($data['OperateType']=="更换"){?>
                <p>
                   <span class="a_c m_left24">数量：</span>
                   <span class="a_l"><?php echo $data['Num']; ?></span>
                </p>
                <p>
                   <span class="a_c m_left24">oe号：</span>
                   <span class="a_l"><?php echo $data['OE']; ?></span>
                </p>
                <?php }else {?>
                <p>
                   <span class="a_c">技师名称：</span>
                   <span class="a_l"><?php echo $data['TechnicianName']; ?></span>
                </p>
                <p>
                   <span class="a_c">维修原因：</span>
                   <span class="a_l"><?php echo $data['RepairCause']; ?></span>
                </p>
                <p>
                   <span class="a_c">修后说明：</span>
                   <span class="a_l"><?php echo $data['RevisedNote']; ?></span>
                </p>
                <?php }?>
             </div>
            </div>
	</div>
	
<script type="text/javascript">
$(document).ready(function(){
	$('#back').click(function(){
		history.go(-1);
		});
})
</script>