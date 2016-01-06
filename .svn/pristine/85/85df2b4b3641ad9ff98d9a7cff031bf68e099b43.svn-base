<ul>
    <?php foreach($this->getHelp() as $h){
    ?>
    <li>
	    <h2 class='title title-green'>
			<a href="#"><?php echo F::t($h->name); ?></a>
		</h2>
		<ul class='submenu'>
	    <?php 
	    $cur_url = Yii::app()->request->getUrl();
	    $cri = new CDbCriteria(array(
	                    'condition' => 'category_id = '.$h->id,
	                ));
	    
	    $helpChilds = Page::model()->findAll($cri);
	    foreach($helpChilds as $hc){
	    ?>
	    <?php 
	    		$activeclass = "";
				if(!empty($hc->key) && stripos($cur_url,$hc->key) !== false){
					$activeclass = "active";
				}
				?>
		    <li class='f14 <?php echo $activeclass;?>'>
		    <?php echo CHtml::link(F::t($hc->title), array('/page/index', 'key'=>$hc->key)); ?>
		    </li>
		<?php }?>    
	    </ul>
	</li>
	<li class='divers'>
		<p></p>
	</li>    
    <?php } ?>
</ul>    