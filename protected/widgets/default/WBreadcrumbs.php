<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
Yii::import('zii.widgets.CBreadcrumbs');

class WBreadcrumbs extends CBreadcrumbs
{
    public $tagName='p';
    
    public $htmlOptions=array('class'=>'mbx bor_back2');
    
    public $separator=' <span>&gt;&gt;</span> ';
    
   public function run()
	{
		if(empty($this->links))
			return;

		echo CHtml::openTag($this->tagName,$this->htmlOptions)."\n";
		$links=array();
                echo '<span class="m_left20">当前位置：</span>';
                
		if($this->homeLink===null)
			$links[]=CHtml::link("工作台",Yii::app()->homeUrl);
		else if($this->homeLink!==false)
			$links[]=$this->homeLink;
		foreach($this->links as $label=>$url)
		{
			if(is_string($label) || is_array($url))
				$links[]= CHtml::link($this->encodeLabel ? CHtml::encode($label) : $label, $url);
			else
				$links[]='<span>'.($this->encodeLabel ? CHtml::encode($url) : $url).'</span>';
		}
		echo implode($this->separator,$links);
		echo CHtml::closeTag($this->tagName);
	}
}
?>
