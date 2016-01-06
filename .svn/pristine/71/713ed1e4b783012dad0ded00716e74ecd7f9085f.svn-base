<?php 
	$html = '';
    $level=0;
    if(!empty($menu)){
	foreach($menu as $n=>$model) {
            if($model['show']){
		if($model['level']==$level)
			$html .= CHtml::closeTag('li')."\n";
		else if($model['level']>$level)
			$html .= CHtml::openTag('ul',array('class'=>'submenu'))."\n";
		else {
			$html .= CHtml::closeTag('li')."\n";
			for($i=$level-$model['level'];$i;$i--) {
				$html .= CHtml::closeTag('ul')."\n";
				$html .= CHtml::closeTag('li')."\n";
			}
		}
		//$html .= CHtml::openTag('li',array('data-level'=>$descendant['level'],'class'=>'f14'));
		//$html .= CHtml::encode($descendant['label']);
		//$html .= CHtml::link(F::t($model['label']), $model['url'], $htmlOptions);
		
		if($model['haschild']) {
			$html .= "<li>";
			$html .= "<h2 class='title title-green'>";
			$html .= "<a href='#' data-level=".$model['level'].">".F::t($model['label'])."</a>";
			$html .= "</h2>";
		}else {
			$activeclass = "";
			$htmlOptions = array();
			if($model['active']){
				$htmlOptions = array('class'=>'active');
				$activeclass = "active";
			}
			$html .= "<li class='f14 ".$activeclass."'>";
			$html .= CHtml::link(F::t($model['label']), $model['url'], $htmlOptions);
		}
	
		$level=$model['level'];
            }
	}
    }
	for($i=$level;$i;$i--) {
		$html .= CHtml::closeTag('li')."\n";
		$html .= CHtml::closeTag('ul')."\n";
	}        
   echo  $html;
?>        
