
<?php foreach ($values as $key => $val): ?>
    <div class="control-group">
        <?php echo CHtml::label($model->getAttributesLabels($key), $key); ?>
        <?php 
        	if($key == 'helpSiderbarMenu'){
            	$this->renderPartial( '_categoryselect', 
                	array('key' =>$key, 'val' => $val)
              	);
			}else{
				$this->renderPartial( '_menuselect',
					array('key' =>$key, 'val' => $val)
				);
			}
 
        ?>
        <?php echo CHtml::error($model, $category); ?>
    </div>
<?php endforeach; ?>