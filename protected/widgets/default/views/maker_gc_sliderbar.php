<div class="sidebar">
	<ul>
		<li>
			<h2 class='title title-green'>
				<!-- 当前栏目样式 bg-green -->
				<a href="#">商品管理</a>
			</h2>
			<ul class='submenu'>
				<li class='f14 <?php if($controlerId=='goodscategory') echo 'active';?>'>
					<a href="<?php echo Yii::app()->createUrl('ds05/default/index');?>">商品类别管理</a>
				</li>
				<li class='f14 <?php if($controlerId=='goodscategory') echo 'active';?>'>
					<a href="<?php echo Yii::app()->createUrl('ds05/default/index');?>">商品模板管理</a>
				</li>
			</ul>
		</li>
		<li class='divers'>
			<p></p>
		</li>		
	</ul>
<!-- 隐藏边栏 -->
<div class="sidebar-hide"></div>
<div style='height:120px'></div>
<div class='block-shadow'></div>
</div>