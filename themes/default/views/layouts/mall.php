<?php  $this->beginContent('//layouts/main'); ?>
<div class="warp box-mid auto_height">
	<div class="sidebar">
		<?php $this->widget('widgets.default.WSidebarMenuCommon'); ?>
		<?php //$this->widget('widgets.default.WSidebarMallCenter'); ?>
		<!-- 隐藏边栏 -->
		<div class="sidebar-hide"></div>
		<div style='height:120px'></div>
		<div class='block-shadow'></div>
	</div>	
	<!-- content -->
	<div class='content'>
		<?php echo $content; ?>
		<div class="sidebar-show" style="display: none;"></div>		
	</div><!-- content -->
</div>
<?php $this->endContent(); ?>