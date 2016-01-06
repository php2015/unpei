<ul>
	<li>
		<?php if($this->getMenuTitle()): ?>
		<h2 class='title title-green'>
			<!-- 当前栏目样式 bg-green -->
			<a href="#"><?php echo F::t($this->getMenuTitle()); ?></a>
		</h2>
		<?php endif;?>
		<ul class='submenu'>
		<?php
		$count = 0;
		$descendants = $this->getMenu();
		$cur_url = Yii::app()->request->getUrl();
		foreach ($descendants as $model) {
			$activeclass = "";
			$htmlOptions = array();
			if(!empty($model->url) && stripos($cur_url,$model->url) !== false){
				$activeclass = "active";
			}
			echo "<li class='f14 ".$activeclass."'>";
			if($model->getChildCount() == 0){
		    	echo CHtml::link(F::t($model->name), $model->url ? Yii::app()->request->baseUrl.'/'.$model->url : '#', $htmlOptions);
			}
			else{
				$main = Menu::model()->findByPk($model['id']);
				$child_descendants = array();
				if($main){
					$child_descendants = $main->children()->findAll();
				}
				if(count($child_descendants) > 0) {
				    echo "<h2 class='title title-green'>";
				    echo "<a href='#'>";
				    echo F::t($model->name);
				    echo "</a>";
				    echo "</h2>";
					echo "<ul class='submenu'>";
					foreach ($child_descendants as $child_model) {
						$activeclass = "";
						$htmlOptions = array();
						if(!empty($child_model->url) && stripos($cur_url,$child_model->url) !== false){
							$activeclass = "active";
						}
						echo "<li class='f14 ".$activeclass."'>";
						echo "　". CHtml::link(F::t($child_model->name), $child_model->url ? Yii::app()->request->baseUrl.'/'.$child_model->url : '#', $htmlOptions);
						echo '</li>';
					}
					echo "</ul>	";
				}
			}
			echo '</li>';
		}
		?>		
		</ul>	
	</li>
	<li class='divers'>
		<p></p>
	</li>
</ul>