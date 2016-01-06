<ul>
	<li>
		<h2 class='title title-green'>
			<!-- 当前栏目样式 bg-green -->
			<a href="#">
				<?php echo F::t($this->getMenuTitle()); ?>
			</a>
		</h2>
		<ul class='submenu'>
		<?php
		$cur_url = Yii::app()->request->getUrl();
		$descendants = $this->getMenu();
		foreach ($descendants as $model) {
			$activeclass = "";
			$htmlOptions = array();                        
			if(!empty($model->url) && stripos(strtolower($cur_url),  strtolower($model->url)) != false){
				$htmlOptions = array('class'=>'active');
				$activeclass = "active";
			}
			echo "<li class='f14 ".$activeclass."'>";
		    echo CHtml::link(F::t($model->name), $model->url ? Yii::app()->request->baseUrl.'/'.$model->url : '#', $htmlOptions);
			echo '</li>';
		}
		?>		
		</ul>	
	</li>
	<li class='divers'>
		<p></p>
	</li>
</ul>