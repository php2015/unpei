<div style=" overflow:scroll">
<?php if(Yii::app()->user->hasFlash('success')):?>  
<div class="successmessage" id="message">
<?php echo Yii::app()->user->getFlash('success'); ?>  
</div>
<?php endif?>
<?php if(Yii::app()->user->hasFlash('failed')):?>  
<div class="errormessage" id="message">
<?php echo Yii::app()->user->getFlash('failed'); ?>  
</div>
<?php endif?>
<?php if(!empty($result)){?>

<table cellspacing=0 cellpadding=0 style="padding:0px" >
	<thead>
		<tr>
			<td width=27>&nbsp;</td>
			<td width=75>商品编号</td>
			<td width=110>商品名称</td>
			<td width=74>商品品牌</td>
			<td width=74>配件品类</td>
			<td width=78>商品类别</td>
			<td width=108>参数1</td>
			<td width=108>参数2</td>
			<td width=108>参数3</td>
			<td width=108>参数4</td>
			<td width=108>参数5</td>
			<td width=34>操作</td>
			</tr>
	</thead>
	<tbody>
	<?php foreach($result as $goods):?>
		<tr class='bd-tb'>
			<td>
				<input type='checkbox' class="checkbox" name="checkbox[]" value="<?php echo $goods['id']?>">
			</td>
			<td>
				<?php echo F::msubstr($goods['goodsno'])?>
			</td>
			<td>
				<div class='pos-r'>
					<?php echo F::msubstr($goods['goodsname'])?>
					<i class='icon-new pos-a'></i>
				</div>
			</td>
			<td ><?php echo $goods['brand']?></td>
			<td ><?php echo $goods['cp_name']?></td>
			<td ><?php echo $goods['category']?></td>
			<td >
				<?php echo F::msubstr($goods['Column1'])?>
				<?php 
				if(isset($goods['value1']) && !empty($goods['value1'])) {
				?>
			<?php echo ":&nbsp;". $goods['value1'] ?>
				<?php }?>
			</td>
			<td >
				<?php echo F::msubstr($goods['Column2'])?>
				<?php 
				if(isset($goods['value2']) && !empty($goods['value2'])) {
				?>
				<?php echo ":&nbsp;".$goods['value2'] ?>
				<?php }?>
			</td>
			<td >
				<?php echo F::msubstr($goods['Column3'])?>
				<?php 
				if(isset($goods['value3']) && !empty($goods['value3'])) {
				?>
				<?php echo ":&nbsp;".$goods['value3'] ?>
				<?php }?>
			</td>
			<td >
				<?php echo F::msubstr($goods['Column4'])?>
				<?php 
				if(isset($goods['value4']) && !empty($goods['value4'])) {
				?>
				<?php echo ":&nbsp;".$goods['value4'] ?>
				<?php }?>
			</td>
			<td >
				<?php echo F::msubstr($goods['Column5'])?>
				<?php 
				if(isset($goods['value5'])  && !empty($goods['value5'])) {
				?>
				<?php echo ":&nbsp;".  $goods['value5'] ?>
				<?php }?>
			</td>
			<td >
				<a class='y-align-m' href="<?php echo Yii::app()->createUrl('maker/salesmanage/modify',array('id'=>$goods['goodsID']))?>"><i class='icon-pencil-green display-ib'></i></a>
				<a class='y-align-m' href="<?php echo  Yii::app()->createUrl('maker/salesmanage/delete',array('id'=>$goods['goodsID']));?>"><i class='icon-red-cross display-ib' ></i></a>
			</td>
		</tr>
		<?php endforeach;?>
			</tbody>
		</table>
<?php }else {?>
<center>
	<p >搜索到&nbsp;<font color=red>0</font>&nbsp;条数据 &nbsp;&nbsp;<span style="text-decoration: underline"><?php //echo CHtml::link('重新加载',array('makemarketing/empowercate'))?></span></p>
</center>
<?php }?>
</div>