<?php
if ($this->requred == 'N' && $this->notlink == 'N') { // 不是必填,不联动
    if ($this->button) {
        echo CHtml::dropDownList('mainCategory' . $this->scope, $this->mainCategory, CHtml::listData($this->getMainCategorys(), 'ID', 'Name'), array(
            'prompt' => '请选择大类',
            'class' => 'width150 select',
            'ajax' => array(
                'type' => 'POST',
                'url' => CController::createUrl('/common/dynamicSubcates2'),
                'dataType' => 'json',
                'data' => array('mainCategory' => 'js:this.value'),
                'beforeSend' => 'function(XMLHttpRequest){ $("#' . $this->button . '").linkbutton("disable");}',
                'success' => 'function(data){
                         $("#subCategory' . $this->scope . '").html(data.dropDownSubCategorys);
                         if($("#mainCategory' . $this->scope . '").attr("subc")!= undefined){
                             $("#subCategory' . $this->scope . '").val($("#mainCategory' . $this->scope . '").attr("subc"));
                         }
                         $("#leafCategory' . $this->scope . '").html(data.dropDownLeafCategorys);
                         if($("#mainCategory' . $this->scope . '").attr("lefc")!= undefined){
                             $("#leafCategory' . $this->scope . '").val($("#mainCategory' . $this->scope . '").attr("lefc"));
                         }
                         $("#' . $this->button . '").linkbutton("enable");
                    }',
                )));
        if ($this->mainCategory) {
            $sub = CHtml::listData($this->getSubCategorys(), 'ID', 'Name');
        }
        echo CHtml::dropDownList('subCategory' . $this->scope, $this->subCategory, $sub ? $sub : array(), array(
            'prompt' => '请选择子类',
            'class' => 'width150 select',
            'ajax' => array(
                'type' => 'POST',
                'url' => CController::createUrl('/common/dynamicLeafcates2'),
                'beforeSend' => 'function(XMLHttpRequest){ $("#' . $this->button . '").linkbutton("disable");}',
                'data' => array('subCategory' => 'js:this.value'),
                'success' => 'function(data){
                         $("#subCategory' . $this->scope . '").html(data.dropDownSubCategorys);
                         if($("#mainCategory' . $this->scope . '").attr("lefc")!= undefined){
                             $("#leafCategory' . $this->scope . '").val($("#mainCategory' . $this->scope . '").attr("lefc"));
                         }
                         $("#leafCategory' . $this->scope . '").html(data);
                         $("#' . $this->button . '").linkbutton("enable");
                    }',
                )));
    } else {
        echo CHtml::dropDownList('mainCategory' . $this->scope, $this->mainCategory, CHtml::listData($this->getMainCategorys(), 'ID', 'Name'), array(
            'prompt' => '请选择大类',
            'class' => 'width150 select',
            'ajax' => array(
                'type' => 'POST',
                'url' => CController::createUrl('/common/dynamicSubcates2'),
                'dataType' => 'json',
                'data' => array('mainCategory' => 'js:this.value'),
                'success' => 'function(data){
                         $("#subCategory' . $this->scope . '").html(data.dropDownSubCategorys);
                         if($("#mainCategory' . $this->scope . '").attr("subc")!= undefined){
                             $("#subCategory' . $this->scope . '").val($("#mainCategory' . $this->scope . '").attr("subc"));
                         }
                         $("#leafCategory' . $this->scope . '").html(data.dropDownLeafCategorys);
                         if($("#mainCategory' . $this->scope . '").attr("lefc")!= undefined){
                             $("#leafCategory' . $this->scope . '").val($("#mainCategory' . $this->scope . '").attr("lefc"));
                         }
                    }',
                )));
        if ($this->mainCategory) {
            $sub = CHtml::listData($this->getSubCategorys(), 'ID', 'Name');
        }
        echo CHtml::dropDownList('subCategory' . $this->scope, $this->subCategory, $sub ? $sub : array(), array(
            'prompt' => '请选择子类',
            'class' => 'width150 select',
            'ajax' => array(
                'type' => 'POST',
                'url' => CController::createUrl('/common/dynamicLeafcates2'),
//				'update'=>'#leafCategory'.$this->scope,
                'data' => array('subCategory' => 'js:this.value'),
                'success' => 'function(data){
                         $("#subCategory' . $this->scope . '").html(data.dropDownSubCategorys);
                         $("#leafCategory' . $this->scope . '").html(data);
                         if($("#mainCategory' . $this->scope . '").attr("lefc")!= undefined){
                             $("#leafCategory' . $this->scope . '").val($("#mainCategory' . $this->scope . '").attr("lefc"));
                         }
                         
                    }',
                )));
    }

    if ($this->subCategory) {
        $leaf = CHtml::listData($this->getLeafCategorys(), 'ID', 'Name');
    }
    echo CHtml::dropDownList('leafCategory' . $this->scope, $this->leafCategory, $leaf ? $leaf : array(), array('prompt' => '请选择标准名称', 'class' => 'width150 select'));
} else if ($this->requred == 'N' && $this->notlink == 'Y') { // 不是必填, 联动
    if ($this->button) {
        echo CHtml::dropDownList('mainCategory' . $this->scope, $this->mainCategory, CHtml::listData($this->getMainCategorys(), 'ID', 'Name'), array(
            'prompt' => '请选择大类',
            'class' => 'width150 select',
            'ajax' => array(
                'type' => 'POST',
                'url' => CController::createUrl('/common/dynamicSubcates'),
                'dataType' => 'json',
                'data' => array('mainCategory' => 'js:this.value'),
                'beforeSend' => 'function(XMLHttpRequest){ $("#' . $this->button . '").linkbutton("disable");}',
                'success' => 'function(data){
                         $("#subCategory' . $this->scope . '").html(data.dropDownSubCategorys);
                         if($("#mainCategory' . $this->scope . '").attr("subc")!= undefined){
                             $("#subCategory' . $this->scope . '").val($("#mainCategory' . $this->scope . '").attr("subc"));
                         }
                         $("#leafCategory' . $this->scope . '").html(data.dropDownLeafCategorys);
                         if($("#mainCategory' . $this->scope . '").attr("lefc")!= undefined){
                             $("#leafCategory' . $this->scope . '").val($("#mainCategory' . $this->scope . '").attr("lefc"));
                         }
                         $("#' . $this->button . '").linkbutton("enable");
                    }',
                )));
        if ($this->mainCategory) {
            $sub = CHtml::listData($this->getSubCategorys(), 'ID', 'Name');
        }
        echo CHtml::dropDownList('subCategory' . $this->scope, $this->subCategory, $sub ? $sub : array(), array(
            'prompt' => '请选择子类',
            'class' => 'width150 select',
            'ajax' => array(
                'type' => 'POST',
                'url' => CController::createUrl('/common/dynamicLeafcates'),
                'beforeSend' => 'function(XMLHttpRequest){ $("#' . $this->button . '").linkbutton("disable");}',
                'data' => array('subCategory' => 'js:this.value'),
                'success' => 'function(data){
                         $("#subCategory' . $this->scope . '").html(data.dropDownSubCategorys);
                         if($("#mainCategory' . $this->scope . '").attr("lefc")!= undefined){
                             $("#leafCategory' . $this->scope . '").val($("#mainCategory' . $this->scope . '").attr("lefc"));
                         }
                         $("#leafCategory' . $this->scope . '").html(data);
                         $("#' . $this->button . '").linkbutton("enable");
                    }',
                )));
    } else {
        echo CHtml::dropDownList('mainCategory' . $this->scope, $this->mainCategory, CHtml::listData($this->getMainCategorys(), 'ID', 'Name'), array(
            'prompt' => '请选择大类',
            'class' => 'width150 select',
            'ajax' => array(
                'type' => 'POST',
                'url' => CController::createUrl('/common/dynamicSubcates'),
                'dataType' => 'json',
                'data' => array('mainCategory' => 'js:this.value'),
                'success' => 'function(data){
                         $("#subCategory' . $this->scope . '").html(data.dropDownSubCategorys);
                         if($("#mainCategory' . $this->scope . '").attr("subc")!= undefined){
                             $("#subCategory' . $this->scope . '").val($("#mainCategory' . $this->scope . '").attr("subc"));
                         }
                         $("#leafCategory' . $this->scope . '").html(data.dropDownLeafCategorys);
                         if($("#mainCategory' . $this->scope . '").attr("lefc")!= undefined){
                             $("#leafCategory' . $this->scope . '").val($("#mainCategory' . $this->scope . '").attr("lefc"));
                         }
            		  $("#leafCategory' . $this->scope . '").change();
                    }',
                )));
        if ($this->mainCategory) {
            $sub = CHtml::listData($this->getSubCategorys(), 'ID', 'Name');
        }
        echo CHtml::dropDownList('subCategory' . $this->scope, $this->subCategory, $sub ? $sub : array(), array(
            'prompt' => '请选择子类',
            'class' => 'width150 select',
            'ajax' => array(
                'type' => 'POST',
                'url' => CController::createUrl('/common/dynamicLeafcates'),
//				'update'=>'#leafCategory'.$this->scope,
                'data' => array('subCategory' => 'js:this.value'),
                'success' => 'function(data){
                         $("#subCategory' . $this->scope . '").html(data.dropDownSubCategorys);
                         $("#leafCategory' . $this->scope . '").html(data);
                         if($("#mainCategory' . $this->scope . '").attr("lefc")!= undefined){
                             $("#leafCategory' . $this->scope . '").val($("#mainCategory' . $this->scope . '").attr("lefc"));
                         }
            		 $("#leafCategory' . $this->scope . '").change();
                    }',
                )));
    }

    if ($this->subCategory) {
        $leaf = CHtml::listData($this->getLeafCategorys(), 'ID', 'Name');
    }
    echo CHtml::dropDownList('leafCategory' . $this->scope, $this->leafCategory, $leaf ? $leaf : array(), array('prompt' => '请选择标准名称', 'class' => 'width150 select'));
}else {    // 是必填项
    echo CHtml::dropDownList('mainCategory' . $this->scope, $this->mainCategory, CHtml::listData($this->getMainCategorys(), 'ID', 'Name'), array(
        'prompt' => '请选择大类',
        //'class' => 'width150 select',
        'class' => 'width150 select easyui-validatebox',
        'required' => "true",
        'ajax' => array(
            'type' => 'POST',
            'url' => CController::createUrl('/common/dynamicSubcates'),
            'dataType' => 'json',
            'data' => array('mainCategory' => 'js:this.value'),
            'success' => 'function(data){
                         $("#subCategory' . $this->scope . '").html(data.dropDownSubCategorys);
                         if($("#mainCategory' . $this->scope . '").attr("subc")!= undefined){
                             $("#subCategory' . $this->scope . '").val($("#mainCategory' . $this->scope . '").attr("subc"));
                         }
                         $("#leafCategory' . $this->scope . '").html(data.dropDownLeafCategorys);
                         if($("#mainCategory' . $this->scope . '").attr("lefc")!= undefined){
                             $("#leafCategory' . $this->scope . '").val($("#mainCategory' . $this->scope . '").attr("lefc"));
                         }
                         setTimeout(function(){
                         $("#subCategory' . $this->scope . '").change();
},1000);
                         
                    }',
            )));
    if ($this->mainCategory) {
        $sub = CHtml::listData($this->getSubCategorys(), 'ID', 'Name');
    }
    echo CHtml::dropDownList('subCategory' . $this->scope, $this->subCategory, $sub ? $sub : array(), array(
        'prompt' => '请选择子类',
        'class' => 'width150 select',
        'ajax' => array(
            'type' => 'POST',
            'url' => CController::createUrl('/common/dynamicLeafcates'),
//				'update'=>'#leafCategory'.$this->scope,
            'data' => array('subCategory' => 'js:this.value'),
            'success' => 'function(data){
                         $("#subCategory' . $this->scope . '").html(data.dropDownSubCategorys);
                         $("#leafCategory' . $this->scope . '").html(data);
                         if($("#mainCategory' . $this->scope . '").attr("lefc")!= undefined){
                             $("#leafCategory' . $this->scope . '").val($("#mainCategory' . $this->scope . '").attr("lefc"));
                         }
                        
                    }',
            )));
    if ($this->subCategory) {
        $leaf = CHtml::listData($this->getLeafCategorys(), 'ID', 'Name');
    }
    echo CHtml::dropDownList('leafCategory' . $this->scope, $this->leafCategory, $leaf ? $leaf : array(), array(
        'prompt' => '请选择标准名称',
        'class' => 'width150 select',
    ));
}
?>