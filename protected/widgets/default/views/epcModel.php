<?php 
if($this->notlink == 'N'){
	echo CHtml::dropDownList($makeLabel['name'],$this->make,
	CHtml::listData($this->getMakes(),'makeId','name'),
	array(
		'id'=>$makeLabel['id'],
		'prompt'=>'请选择厂家',
		'class'=>'width100 select',
		'live'=>false,	
		'ajax'=>array(
			'type'=>'POST',
			'url'=>CController::createUrl('/jpdata/vehicle/epcSeries'),
			'dataType'=>'json',
			'data'=>array('make'=>'js:this.value'),
			'success'=>'function(data){
                                         var  html = "<option value=\"\">请选择车系</option>";
					//var html = "";
					if(data && typeof(data)=="object"){
				        for(i=0;i<data.length;i++){
				        	html += "<option value=\'"+data[i]["seriesId"]+"\'>"+data[i]["name"]+"</option>"
				        }
				    }
					if(!html) {
						html = "<option value=\"\">请选择车系</option>";
					}
                    $("#' . $seriesLabel["id"] . '").html(html);
					$("#' . $seriesLabel["id"] . '").change();
			}',
)));         
}else{
    echo CHtml::dropDownList($makeLabel['name'],$this->make,
	CHtml::listData($this->getMakes(),'makeId','name'),
	array(
		'id'=>$makeLabel['id'],
		'prompt'=>'请选择厂家',
		'class'=>'width100 select',
		'live'=>false,	
		'ajax'=>array(
			'type'=>'POST',
			'url'=>CController::createUrl('/jpdata/vehicle/epcSeries'),
			'dataType'=>'json',
			'data'=>array('make'=>'js:this.value'),
			'success'=>'function(data){
					var html = "";
					if(data && typeof(data)=="object"){
				        for(i=0;i<data.length;i++){
				        	html += "<option value=\'"+data[i]["seriesId"]+"\'>"+data[i]["name"]+"</option>"
				        }
				    }
					if(!html) {
						html = "<option value=\"\">请选择车系</option>";
					}
                    $("#' . $seriesLabel["id"] . '").html(html);
					$("#' . $seriesLabel["id"] . '").change();
			}',
)));      
}
if($this->cascade == 2){
	echo CHtml::dropDownList($seriesLabel['name'],$this->series,
	CHtml::listData($this->getSeries(),'seriesId','name'),
		array('id'=>$seriesLabel['id'],
		'prompt'=>'请选择车系',
		'class'=>'width100 select'));
}else if($this->cascade > 2 && $this->notlink == 'Y') {
	echo CHtml::dropDownList($seriesLabel['name'],$this->series,
	CHtml::listData($this->getSeries(),'seriesId','name'),
	array(
		'id'=>$seriesLabel['id'],
		'prompt'=>'请选择车系',
		'class'=>'width100 select',
		'live'=>false,
		'ajax'=>array(
			'type'=>'POST',
			'url'=>CController::createUrl('/jpdata/vehicle/epcSeriesYears'),
			'dataType'=>'json',
			'data'=>array('series'=>'js:this.value','make'=>'js:$("#' . $makeLabel["id"] . '").val()'),
			'success'=>'function(data){
					//var html = "<option value=\"\">请选择年款</option>";
					var html = "";
					if(data && typeof(data)=="object"){
				        for(i=0;i<data.length;i++){
				        	html += "<option value=\'"+data[i]["year"]+"\'>"+data[i]["year"]+"</option>"
				         }
				    }
                    $("#' . $yearLabel["id"] . '").html(html);
					$("#' . $yearLabel["id"] . '").change();
            }',
		)));
}else if($this->cascade > 2 && $this->notlink == 'N') {
	echo CHtml::dropDownList($seriesLabel['name'],$this->series,
	CHtml::listData($this->getSeries(),'seriesId','name'),
	array(
		'id'=>$seriesLabel['id'],
		'prompt'=>'请选择车系',
		'class'=>'width100 select',
		'live'=>false,
		'ajax'=>array(
			'type'=>'POST',
			'url'=>CController::createUrl('/jpdata/vehicle/epcSeriesYears'),
			'dataType'=>'json',
			'data'=>array('series'=>'js:this.value','make'=>'js:$("#' . $makeLabel["id"] . '").val()'),
			'success'=>'function(data){
					var html = "<option value=\"\">请选择年款</option>";
					//var html = "";
					if(data && typeof(data)=="object"){
				        for(i=0;i<data.length;i++){
				        	html += "<option value=\'"+data[i]["year"]+"\'>"+data[i]["year"]+"</option>"
				         }
				    }
                    $("#' . $yearLabel["id"] . '").html(html);
					$("#' . $yearLabel["id"] . '").change();
            }',
		)));
}
if($this->cascade == 3){
	echo CHtml::dropDownList($yearLabel['name'],$this->year,
	CHtml::listData($this->getSeriesYears(),'year','year'),
	array('id'=>$yearLabel["id"],
		'prompt'=>'请选择年款',
		'class'=>'width100 select'));
}else if($this->cascade > 3 && $this->notlink == 'Y') {
	echo CHtml::dropDownList($yearLabel['name'],$this->year,
	CHtml::listData($this->getSeriesYears(),'year','year'),
	array(
		'id'=>$yearLabel["id"],
		'prompt'=>'请选择年款',
		'class'=>'width100 select',
		'live'=>false,			
		'ajax'=>array(
			'type'=>'POST',
			'url'=>CController::createUrl('/jpdata/vehicle/epcModels'),
			'dataType'=>'json',
			'data'=>array('year'=>'js:this.value','series'=>'js:$("#' . $seriesLabel["id"] . '").val()',
					'make'=>'js:$("#' . $makeLabel["id"] . '").val()'),
			'success'=>'function(data){
					//var html = "<option value=\"\">请选择车型</option>";
					var html = "";
					if(data && typeof(data)=="object"){
				        for(i=0;i<data.length;i++){
				        	html += "<option value=\'"+data[i]["modelId"]+"\'>"+data[i]["name"]+"</option>"
				         }
				    }
                    $("#' . $modelLabel["id"] . '").html(html);
					$("#' . $modelLabel["id"] . '").change();
            }',
		)));
}else if($this->cascade > 3 && $this->notlink == 'N') {
	echo CHtml::dropDownList($yearLabel['name'],$this->year,
	CHtml::listData($this->getSeriesYears(),'year','year'),
	array(
		'id'=>$yearLabel["id"],
		'prompt'=>'请选择年款',
		'class'=>'width100 select',
		'live'=>false,			
		'ajax'=>array(
			'type'=>'POST',
			'url'=>CController::createUrl('/jpdata/vehicle/epcModels'),
			'dataType'=>'json',
			'data'=>array('year'=>'js:this.value','series'=>'js:$("#' . $seriesLabel["id"] . '").val()',
					'make'=>'js:$("#' . $makeLabel["id"] . '").val()'),
			'success'=>'function(data){
					var html = "<option value=\"\">请选择车型</option>";
					//var html = "";
					if(data && typeof(data)=="object"){
				        for(i=0;i<data.length;i++){
				        	html += "<option value=\'"+data[i]["modelId"]+"\'>"+data[i]["name"]+"</option>"
				         }
				    }
                    $("#' . $modelLabel["id"] . '").html(html);
					$("#' . $modelLabel["id"] . '").change();
            }',
		)));
}

if($this->cascade == 4){
	echo CHtml::dropDownList($modelLabel["name"],$this->model,
	CHtml::listData($this->getModels(),'modelId','name'),
		array('id'=>$modelLabel["id"],
			'prompt'=>'请选择车型',
			'class'=>'width100 select'));
}else if($this->cascade > 4){
	echo CHtml::dropDownList($modelLabel["name"],$this->model,
	CHtml::listData($this->getModels(),'modelId','name'),
		array(
			'id'=>$modelLabel["id"],
			'prompt'=>'请选择车型',
			'class'=>'width100 select',
			'live'=>false,
			'ajax'=>array(
				'type'=>'POST',
				'url'=>CController::createUrl('/jpdata/parts/partChildGroups'),
				'dataType'=>'json',
				'data'=>array('modelId'=>'js:this.value'),
				'success'=>'function(data){
					var html = "<option value=\"\">请选择主组</option>";
					//var html = "";
					if(data && typeof(data)=="object"){
				        for(i=0;i<data.length;i++){
				        	html += "<option value=\'"+data[i]["groupId"]+"\'>"+data[i]["name"]+"</option>"
				         }
				    }
                    $("#' . $mainGroupLabel["id"] . '").html(html);
            }',
	)));
}
?>

