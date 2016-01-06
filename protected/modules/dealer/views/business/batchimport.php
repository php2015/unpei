<div class='content'>
	<?php include 'tabs_active.php';?>
	<div class='tab-content'>
		<div id='tab1'>
			<div class='form-list'>
			<form action="<?php echo Yii::app()->createUrl('dealer/business/SubdealerUpload');?>" method="post" enctype="multipart/form-data">
				<p class="form-row">
					<label class='label'>模板下载：</label>
					<select class='width144 select'>
						<option>下属机构商模板</option>
					</select>
					<a href="<?php echo Yii::app()->theme->baseUrl; ?>/template/subdealer.xlsx"><input class='submit' type='button' value='下载模板'/></a>
				</p>
				<p class="form-row">
					<label class='label'>选择文件：</label>
					<span class='width288 inputfile-input input'>
						<input type="hidden" name="leadExcel" value="true">
						<input type="file" name="inputExcel">
					</span>
					<input class='submit' type='submit' value='上传表格'></p>
				</form>
			</div>
		</div>
	</div>
	<?php echo $message?>
	<div style='height:120px'></div>
	<div class='block-shadow'></div>
	<div class='shadow-show'></div>

</div>
<script type="text/javascript">
$(document).ready(function(){
	//上传文件名显示
	$("input[type='file']").on('change',function(){
		var inputfile = $(this).closest('.inputfile');
		if(inputfile.length!=0){
			var after = $(inputfile).nextAll('span');
			after.length>0 && after.remove();
			$(inputfile).after('<span style="margin-left:5px;">'+$(this).val()+'</span>')
		}else{
			var inputfile_input = $(this).closest('.inputfile-input');
			if(inputfile_input.length==0){
				return;
			}
			var before = $(this).prevAll('span');
			before.length>0 && before.remove();
			$(this).before('<span style="margin-left:5px;">'+$(this).val()+'</span>')
		}
	}); 
}); 
</script>