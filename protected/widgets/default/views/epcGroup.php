<?php 
if($this->cascade == 1){
	echo CHtml::dropDownList($mainGroupLabel["name"],$this->mainGroup,
		CHtml::listData($this->getGroups(),'groupId','name'),
		array('id'=>$mainGroupLabel["id"],'prompt'=>'请选择主组','class'=>'width100 select'));
}else if($this->cascade > 1){
	echo CHtml::dropDownList($mainGroupLabel["name"],$this->mainGroup,
		CHtml::listData($this->getGroups(),'groupId','name'),
		array(
			'id'=>$mainGroupLabel["id"],
			'prompt'=>'请选择主组',
			'class'=>'width100 select',
			'live'=>false,				
			'ajax'=>array(
				'type'=>'POST',
				'url'=>CController::createUrl('/jpdata/parts/partChildGroups'),
				'dataType'=>'json',
				'data'=>array('groupId'=>'js:this.value','modelId'=>'js:$("#' . $modelLabel["id"] . '").val()'),
				'success'=>'function(data){
					var html = "<option value=\"\">请选择子组</option>";
					//var html = "";
					if(data && typeof(data)=="object"){
				        for(i=0;i<data.length;i++){
				        	html += "<option value=\'"+data[i]["groupId"]+"\'>"+data[i]["name"]+"</option>"
				         }
				    }
                    $("#' . $groupLabel["id"] . '").html(html);
            }',
	)));
}
if($this->cascade==2){	
	echo CHtml::dropDownList($groupLabel["name"],$this->group,
		CHtml::listData($this->getGroups($this->mainGroup),'groupId','name'),
		array('id'=>$groupLabel["id"],'prompt'=>'请选择子组','class'=>'width100 select'));
}
?>

