<style>
    <!--
    /*.xx{width:10px;float:right: cursor:pointer; color:red; margin-left:5px;}*/
    -->
    .showbrand{ width: 300px; height:auto; position: absolute; z-index: 100; float: left; border: 1px solid #DEDEDE; background-color: #fff;}
    .checkbox-add{ line-height: 24px;}
    .label{font-weight: bold;}
</style>
<?php 
	$controlerId = Yii::app()->getController()->id;
	$actionId = $this->getAction()->getId();
	$active = "class = 'active'";
	//echo $controlerId;
?>
<div>
    <div class='tabs' pre='tab'>
        <a class='left-indent'>&nbsp;</a>
        <a <?php if($controlerId=='marketing' && $actionId=='mainbusiness') echo $active;?> href="<?php echo Yii::app()->createUrl('dealer/marketing/mainbusiness'); ?>">修改主营信息</a>
    </div>
    <div class="inner-padding">
        <div class='form-list'>
            <?php if (!empty($model)): ?>
                <?php
                $form = $this->beginWidget('CActiveForm', array(
                    'id' => 'dealer-form',
                    'htmlOptions' => array(
                        'enctype' => 'multipart/form-data',
                    ),
                        ));
                ?>

                        <!--                <p class="form-row">
                                            <label class='label'> 主营配件品牌：</label>
                <?php // echo $form->textField($model, 'BusinessBrand', array('class' => 'width400 input', 'onkeyup' => "this.value=this.value.replace(/，/g, ',')")); ?>
                                            <span>（每个品牌之间用“，”隔开）</span>
                                        </p>-->
                <p class="form-row">
                    <label class='label'>主营品类：</label>
                    <?php // echo $form->textField($model,'BusinessCate',array('class'=>'width453 input','onkeyup'=>"this.value=this.value.replace(/，/g, ',')"));  ?>

                    <?php
                    $this->widget("widgets.default.WGcategory",array('requred'=>'N','notlink'=>'N'));
                    ?> <span id='addcpname' class="btn" style="cursor:pointer">添加</span>
                </p>
                <p class="form-row" id="showcpname"><!-- 显示车系车型 -->
                    <label class=label></label>
                    <?php if (!empty($showcpnames)): ?>
                        <?php foreach ($showcpnames as $showcpname): ?>
                            <span class='checkbox-add bg-green tag-close catespan'><span name='BigName'><?php echo $showcpname['BigName'];?></span><span name='SubName'><?php echo $showcpname['SubName'];?></span> <span name='CpName'><?php echo $showcpname['CpName'] ?></span><span onclick='xxcpname(this)' key="<?php echo $showcpname['ID'] ?>" style="cursor:pointer;font-size: 9px;font-family: Georgia;">　X</span></span>
                        <?php endforeach; ?>
                    <?php endif; ?>
                </p>
                
                
            
                <p class="form-row">
                    <label class='label'>主营车系：</label>
                    <?php //$this->widget('widgets.default.WFrontModel'); ?>
                    <?php  $this->widget('widgets.default.WGoodsModel', array('scope' => 'front','notlink'=>'N')); ?>
                    <span id='addVehcle' class="btn" style="cursor:pointer">添加</span>
                </p>
                <div class="form-row" id="showVehicle"><!-- 显示车系车型 -->
                    <?php if (!empty($showvehicles)): ?>
                        <?php foreach ($showvehicles as $showvehicle): ?>
                            <!--<span class='checkbox-add bg-green tag-close catespan'><span><?php echo Commonmodel::getMake($showvehicle['businessMake']); ?></span>-<span name='car'><?php echo Commonmodel::getCar($showvehicle['businessCar']); ?></span>-<span name='year'><?php echo Commonmodel::getYear($showvehicle['businessYear']); ?></span>-<span name='model'><?php echo Commonmodel::getModel($showvehicle['businessCarModel']); ?></span><span onclick='xxVehicle(this)' key="<?php echo $showvehicle['id'] ?>" class='close icon-close-green xx'></span></span>-->
                             <span class='checkbox-add bg-green tag-close catespan'><span name="make"><?php $makeName = D::queryGoodsMakeInfo($showvehicle['businessMake']); echo $makeName['makeName']; ?></span> <span name='car'><?php $carinfo = D::queryGoodsSeriesInfo($showvehicle['businessCar']); echo $carinfo['seriesName']; ?></span> <span name='year'><?php echo $showvehicle['businessYear'] ? $showvehicle['businessYear'] :''; ?></span><span name='model'><?php $modelinfo = D::queryGoodsModelInfo($showvehicle['businessCarModel']);echo !empty($modelinfo['alias']) ? $modelinfo['modelName'].'('.$modelinfo['alias'].')':$modelinfo['modelName']; ?></span><span onclick='xxVehicle(this)' key="<?php echo $showvehicle['id'] ?>" style="cursor:pointer;font-size: 9px;font-family: Georgia;">　X</span></span>
                        <?php endforeach; ?>
                    <?php endif; ?>
                </div>
                
                <!--<table id="dg" title="批量操作"></table>-->
                <p class="form-row" style=" margin-left: 400px;">
                    <input type="hidden" value='ok' name="returnok" >
                    <label class="label"></label>
                    <input class="submit" id="saveBusiness" type='button' value='保存资料'>
                    <a href="<?php echo Yii::app()->createUrl('dealer/marketing/mainbusupdate') ?>" class="btn">&nbsp;返回&nbsp;</a>
                </p>
                <?php $this->endWidget(); ?>
                <hr>
                <?php $this->renderPartial('addmainbrand'); ?>
            <?php else: ?>
                <p class="errormessage">对不起，您的公司信息未填写，<br> 先到 <?php echo CHtml::link("我的公司", array('/dealer/business/Index')) ?> 登记</p>
            <?php endif; ?>
        </div>
        <!-- 显示边栏 --></div>
    <div class="sidebar-show"></div>
    <!--<div style='height:120px'></div>-->
    <div class='block-shadow'></div>

</div>


<script type="text/javascript">

    //删除主营
    function xxcpname(obj){
        var bool = true;//confirm('您确定要删除这个吗?');
        if(bool){
            var cpnid = obj.getAttribute("key")
            if(cpnid != 0)
            {
                var url = Yii_baseUrl +"/dealer/marketing/deletecpname";
                $.getJSON(url,{ID:cpnid},function(data){
                    if(data == 1){
                        $(obj).parent().remove();
                       // alert('删除成功！');
                    }
                });
            }else{
                $(obj).parent().remove();
            }
        }
    }
    //删除主营车系
    function xxVehicle(obj){
        var cateid = obj.getAttribute("key")
        if(cateid != 0)
        {
            var url ="<?php echo Yii::app()->createUrl('dealer/business/deletevehicle'); ?>";
            $.getJSON(url,{cateid:cateid},function(data){
                if(data == 1)
                    $(obj).parent().remove();
            });
        }else{
            $(obj).parent().remove();
        }
    }


    // 可多选品类
    $(function(){
        $("#saveBusiness").click(function(){
            $("#dealer-form").submit();
             $("#saveBusiness").attr({"disabled":"disabled"});
        });
    
        // 添加主营品类
        $("#addcpname").click(function(){
            if($("#showcpname span.catespan").length < 150)
            {
                // text
                
                var BigName =  $("#mainCategory option:selected").text(); 
                var SubName =  $("#subCategory option:selected").text();
                var CpName = $("#leafCategory option:selected").text();
                
                
                var BigpartsID =  $("#mainCategory").val();
                var SubCodeID =  $("#subCategory").val();
                var CpNameID =  $("#leafCategory").val();
                
                if(CpName=='请选择标准名称'){
                    CpName='';
                    CpNameID = 0;
                }
                if(SubName=='请选择子类'){
                    SubName='';
                    SubCodeID = 0;
                }
                if(BigName == "请选择大类")
                {
                    alert('您还没有选择主营品类！');
                    return false;
                }else{
                    var al='';
                    $("#showcpname span.catespan").each(function(){
                        //						var systemCode=$(this).find('span[name=system]').html();
                        var bigCode=$(this).find('span[name=BigName]').html();
                        var subCode=$(this).find('span[name=SubName]').html();
                        var cpCode=$(this).find('span[name=CpName]').html();
                        if(CpName==cpCode  && BigName==bigCode && SubName==subCode){
                            al='此品类您已添加，不可重复添加！';
                        }
                        if(BigName==bigCode && cpCode=='' && (subCode==''||subCode==SubName)){
                            al='此品类您已添加，不可重复添加！';
                        }
                    })
                    if(al==''){
                        
                        if($("#showcpname span.catespan").length % 3 == 0){
                             $("<br/><span class='checkbox-add bg-green tag-close catespan'><span name='BigName'>"+BigName+"</span> <span name='SubName'>"+SubName+"</span> <span name='CpName'>"+CpName+"</span><span onclick='xxcpname(this)' key='0' style='cursor:pointer;font-size: 9px;font-family: Georgia;'>　X</span><input type='hidden' value="+BigName+" name='BigName[]'><input type='hidden' value="+SubName+" name='SubName[]'><input type='hidden' value="+CpName+" name='CpName[]'><input type='hidden' value="+BigpartsID+" name='BigpartsID[]'><input type='hidden' value="+SubCodeID+" name='SubCodeID[]'><input type='hidden' value="+CpNameID+" name='CpNameID[]'></span>").appendTo("#showcpname");
                        }else{
                             $("<span class='checkbox-add bg-green tag-close catespan'><span name='BigName'>"+BigName+"</span> <span name='SubName'>"+SubName+"</span> <span name='CpName'>"+CpName+"</span><span onclick='xxcpname(this)' key='0' style='cursor:pointer;font-size: 9px;font-family: Georgia;'>　X</span><input type='hidden' value="+BigName+" name='BigName[]'><input type='hidden' value="+SubName+" name='SubName[]'><input type='hidden' value="+CpName+" name='CpName[]'><input type='hidden' value="+BigpartsID+" name='BigpartsID[]'><input type='hidden' value="+SubCodeID+" name='SubCodeID[]'><input type='hidden' value="+CpNameID+" name='CpNameID[]'></span>").appendTo("#showcpname");
                        }
                        //$("<span class='checkbox-add bg-green tag-close catespan'><span name='cp_name'>"+cp_name+"</span><span onclick='xxVehicle(this)' key='0' class='close icon-close-green xx'>X</span><input type='hidden' value="+system_typeval+" name='system_type[]'><input type='hidden' value="+cp_nameval+" name='cp_name[]'></span>").appendTo("#showCp");
                    }else{
                        $.messager.alert('提示信息',al);
                    }
                }		
            }else{
                alert("最多只能添加150个");
            }
        });
	
        // 添加车系
        $("#addVehcle").click(function(){
            if($("#showVehicle span.catespan").length <100){
			
                var businessCar =  $("#Dealer_businessCar option:selected").text();
                var businessCarModel = $("#Dealer_businessCarModel option:selected").text();
                var businessCarval = $("#Dealer_businessCar").val();
                var businessCarModelval = $("#Dealer_businessCarModel").val();
                 
                var makeval =  $("#front_make").val();
                var carval =  $("#front_series").val();
                var yearval =  $("#front_year").val();
                var modelval =  $("#front_model").val();
                // 前市场车型
                var make =  $("#front_make option:selected").text();
                var car =  $("#front_series option:selected").text();
                var year =  $("#front_year option:selected").text();
                var model =  $("#front_model option:selected").text();
                if(carval == ''){
                    carval= 0;
                    car = '';
                }
                if(yearval == ''){
                    yearval= 0;
                    year = '';
                }if(modelval==''){
                    modelval = 0;
                    model = '';
                }
                if(make == "请选择厂家")
                {
                    alert('您还没有选择主营车系！');
                    return false;
                }else{
                    var al='';
                    $("#showVehicle span.catespan").each(function(){
                        //						var systemCode=$(this).find('span[name=system]').html();
                        var cpCode=$(this).find('span[name=model]').html();
                        var cpCar=$(this).find('span[name=car]').html();
                        var cpYear=$(this).find('span[name=year]').html();
                        var cpmake=$(this).find('span[name=make]').html();
                        if(model==cpCode && car==cpCar && year==cpYear && make==cpmake){
                            al='此车系您已添加，不可重复添加！';
                        }
                        if(cpmake==make && (cpCar==''||cpCar==car) && (cpYear==''|| cpYear==year) && cpCode==''){
                            al='此车系您已添加，不可重复添加！';
                        }         
                    });
//                    var catespan=$("#showVehicle span.catespan").length;
//                    alert(catespan);
                    if(al==''){
                        if($("#showVehicle span.catespan").length % 2 == 0){
                            $("<br><span class='checkbox-add bg-green tag-close catespan'><span name='make'>"+make+"</span> <span name='car'>"+car+"</span> <span name='year'>"+year+"</span> <span name='model'>"+model+"</span><span onclick='xxVehicle(this)' key='0'  style='cursor:pointer;font-size: 9px;font-family: Georgia;'>　X</span><input type='hidden' value="+makeval+" name='make[]'><input type='hidden' value="+carval+" name='car[]'><input type='hidden' value="+yearval+" name='year[]'><input type='hidden' value="+modelval+" name='model[]'><input type='hidden' value="+make+" name='maketext[]'><input type='hidden' value="+car+" name='cartext[]'><input type='hidden' value="+year+" name='yeartext[]'><input type='hidden' value="+model+" name='modeltext[]'></span>").appendTo("#showVehicle");
                        }else{
                            $("<span class='checkbox-add bg-green tag-close catespan'><span name='make'>"+make+"</span> <span name='car'>"+car+"</span> <span name='year'>"+year+"</span> <span name='model'>"+model+"</span><span onclick='xxVehicle(this)' key='0'  style='cursor:pointer;font-size: 9px;font-family: Georgia;'>　X</span><input type='hidden' value="+makeval+" name='make[]'><input type='hidden' value="+carval+" name='car[]'><input type='hidden' value="+yearval+" name='year[]'><input type='hidden' value="+modelval+" name='model[]'><input type='hidden' value="+make+" name='maketext[]'><input type='hidden' value="+car+" name='cartext[]'><input type='hidden' value="+year+" name='yeartext[]'><input type='hidden' value="+model+" name='modeltext[]'></span>").appendTo("#showVehicle");
                        }
//                        $("<input type='hidden' value="+makeval+" name='make[]'><input type='hidden' value="+carval+" name='car[]'><input type='hidden' value="+yearval+" name='year[]'><input type='hidden' value="+modelval+" name='model[]'>").appendTo("#showVehicle");
//                        $("<input type='hidden' value="+make+" name='maketext[]'><input type='hidden' value="+car+" name='cartext[]'><input type='hidden' value="+year+" name='yeartext[]'><input type='hidden' value="+model+" name='modeltext[]'>").appendTo("#showVehicle");
                           
                        // $("<span class='checkbox-add bg-green tag-close catespan'><span>"+businessCar+"</span>-<span name='model'>"+businessCarModel+"</span><span onclick='xxVehicle(this)' key='0' class='close icon-close-green xx'></span></span>").appendTo("#showVehicle");
                        // $("<input type='hidden' value="+businessCarval+" name='businessCar[]'><input type='hidden' value="+businessCarModelval+" name='businessCarModel[]'>").appendTo("#showVehicle");
                    }else{
                        //alert(al);
                        $.messager.alert('提示信息', al, 'warning');
                    }
                }
			
            }else{
                  $.messager.alert('提示信息', "最多只能添加100个", 'warning');
            }
        });

    })

</script>


