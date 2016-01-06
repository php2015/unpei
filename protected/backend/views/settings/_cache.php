<?php foreach ($values as $key => $val): ?>
    <div class="control-group">
        <?php echo CHtml::label($model->getAttributesLabels($key), $key); ?>
        <?php 
            echo CHtml::textField(get_class($model) . '[' . $category . '][' . $key . ']', $val, array('class'=>'input-xxlarge','style'=>'width: 220px;')); 
            //echo CHtml::button('清除缓存', array('class' => 'btn','style'=>'margin-left:20px;'));
        ?>
        <?php echo CHtml::error($model, $category); ?>
    </div>
<?php endforeach; ?>