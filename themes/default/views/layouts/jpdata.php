<?php $this->beginContent('//layouts/main'); ?>
<?php 
// $cs = Yii::app()->clientScript;
// $cs->registerCssFile(F::themeUrl().'/css/jpdata.css');
// $cs->registerCssFile(F::themeUrl().'/css/datatable.css');
?>
<link rel='stylesheet' href='<?php echo Yii::app()->theme->baseUrl.'/css/jpdata.css'?>'/>
<link rel='stylesheet' href='<?php echo Yii::app()->theme->baseUrl.'/css/datatable.css'?>'/>
<script type="text/javascript">
var Yii_jpdata_baseUrl = "<?php echo Yii::app()->createUrl('/jpdata');?>";
//var Yii_theme_baseUrl = "<?php //echo $this->module->assetsUrl;?>";
</script>
<!-- content -->
<div class='content auto_height'>
	<?php echo $content; ?>
	<div class="sidebar-show" style="display: none;"></div>	
</div><!-- content -->

<?php $this->endContent(); ?>