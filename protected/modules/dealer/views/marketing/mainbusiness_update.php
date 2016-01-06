<style>
    <!--
    /*.xx{width:10px;float:right: cursor:pointer; color:red; margin-left:5px;}*/
    -->
    .showbrand{ width: 300px; height:auto; position: absolute; z-index: 100; float: left; border: 1px solid #DEDEDE; background-color: #fff;}
    .checkbox-add{ line-height: 24px;}
    .label{font-weight: bold;}
    #showcpname,#showVehicle{padding:0 10px}
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
        <a <?php if ($controlerId == 'marketing' && $actionId == 'mainbusupdate') echo $active; ?> href="<?php echo Yii::app()->createUrl('dealer/marketing/mainbusupdate'); ?>">主营信息</a>
    </div>
    <div class="">
        <div class='form-list'>

            <?php if (!empty($model)): ?>
                <p class="form-row" id="showcpname"><!-- 显示车系车型 -->
                    <span style="float:left;display:block;line-height:26px;margin-left:4px;"><label class="label">主营品类：</label></span>
                    <span style="display:block;padding-left:72px">
                        <?php if (!empty($showcpnames)): ?>
                            <?php foreach ($showcpnames as $key => $showcpname): ?>
                                <?php if (isset($showcpnames[$key + 1])) { ?>
                                    <span style="line-height:24px;"><?php echo $showcpname['BigName'] ?> <?php echo $showcpname['SubName'] ?> <?php echo $showcpname['CpName'] ?>,</span>
                                <?php } else { ?> 
                                    <span style="line-height:24px;"><?php echo $showcpname['BigName'] ?> <?php echo $showcpname['SubName'] ?> <?php echo $showcpname['CpName'] ?></span>
                                <?php } ?>
                            <?php endforeach; ?>
                        <?php endif; ?>
                    </span>
                </p>
                <div style="clear:both;"></div>
                <p class="form-row" id="showVehicle"><!-- 显示车系车型 -->
                    <span style="float:left;display:block;line-height:26px;margin-left:4px;"><label class="label">主营车系：</label></span>
                    <span style="display:block;padding-left:72px">
                        <?php if (!empty($showvehicles)): ?>
                            <?php foreach ($showvehicles as $k => $showvehicle): ?>
                                <?php if (isset($showvehicles[$k + 1])) { ?>
                                    <span style="line-height:24px;"> <?php
                    $makeName = D::queryGoodsMakeInfo($showvehicle['businessMake']);
                    echo $makeName['makeName'];
                                    ?> <?php
                        $carinfo = D::queryGoodsSeriesInfo($showvehicle['businessCar']);
                        echo $carinfo['seriesName'];
                                    ?> <?php echo $showvehicle['businessYear'] ? $showvehicle['businessYear'] : ''; ?> <?php
                        $modelinfo = D::queryGoodsModelInfo($showvehicle['businessCarModel']);
                        echo!empty($modelinfo['alias']) ? $modelinfo['modelName'] . '(' . $modelinfo['alias'] . ')' : $modelinfo['modelName'];
                                    ?>,</span>
                                <?php } else { ?>
                                    <span style="line-height:24px;"> <?php
                    $makeName = D::queryGoodsMakeInfo($showvehicle['businessMake']);
                    echo $makeName['makeName'];
                                    ?> <?php
                        $carinfo = D::queryGoodsSeriesInfo($showvehicle['businessCar']);
                        echo $carinfo['seriesName'];
                                    ?> <?php echo $showvehicle['businessYear'] ? $showvehicle['businessYear'] : ''; ?> <?php
                        $modelinfo = D::queryGoodsModelInfo($showvehicle['businessCarModel']);
                        echo!empty($modelinfo['alias']) ? $modelinfo['modelName'] . '(' . $modelinfo['alias'] . ')' : $modelinfo['modelName'];
                                    ?></span>
                                <?php } ?>
                            <?php endforeach; ?>
                        <?php endif; ?>
                    </span>
                </p>
                <p class="form-row" style="margin-left: 340px; margin-bottom: 10px;">
                    <a href="<?php echo Yii::app()->createUrl('dealer/marketing/mainbusiness') ?>" class="btn">&nbsp;修改&nbsp;</a>
                    <!--<table id="dg" title="批量操作"></table>-->
                </p>
                <hr>
                <?php $this->renderPartial('addmainbrand'); ?>
            <?php else: ?>
                <p class="errormessage">对不起，您的公司信息未填写，<br> 先到 <?php echo CHtml::link("我的公司", array('/dealer/business/Index')) ?> 登记</p>
            <?php endif; ?>
        </div>
        <!-- 显示边栏 --></div>
    <div class="sidebar-show"></div>
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
                $.getJSON(url,{cpnid:cpnid},function(data){
                    if(data == 1){
                        $(obj).parent().remove();
                        alert('删除成功！');
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
        });
    
        // 添加主营品类
        $("#addcpname").click(function(){
            if($("#showcpname span.catespan").length <5)
            {
                var system_type =  $("#mainCategory option:selected").text();
                var cp_name = $("#leafCategory option:selected").text()
                if(system_type == "请选择大类" || cp_name=="请选择品类")
                {
                    alert('您还没有选择主营品类！');
                    return false;
                }else{
                    var al='';
                    $("#showcpname span.catespan").each(function(){
                        //						var systemCode=$(this).find('span[name=system]').html();
                        var cpCode=$(this).find('span[name=cp_name]').html();
                        if(cp_name==cpCode){
                            al='此品类您已添加，不可重复添加！';
                        }
                    })
                    if(al==''){
                        //$("<span class='checkbox-add bg-green tag-close catespan'><span name='cp_name'>"+cp_name+"</span><span onclick='xxVehicle(this)' key='0' class='close icon-close-green xx'>X</span><input type='hidden' value="+system_typeval+" name='system_type[]'><input type='hidden' value="+cp_nameval+" name='cp_name[]'></span>").appendTo("#showCp");
                        $("<span class='checkbox-add bg-green tag-close catespan'><span></span><span name='cp_name'>"+cp_name+"</span><span onclick='xxcpname(this)' key='0' class='close icon-close-green xx'></span></span>").appendTo("#showcpname");
                        $("<input type='hidden' value="+system_type+" name='system_t[]'><input type='hidden' value="+cp_name+" name='cp_name[]'>").appendTo("#showcpname");
                    }else{
                        alert(al);
                    }
                }
				
            }else{
                alert("最多只能添加5个");
            }
        });
	
        // 添加车系
        $("#addVehcle").click(function(){
            if($("#showVehicle span.catespan").length <100){
			
                var businessCar =  $("#Dealer_businessCar option:selected").text();
                var businessCarModel = $("#Dealer_businessCarModel option:selected").text()
                var businessCarval = $("#Dealer_businessCar").val()
                var businessCarModelval = $("#Dealer_businessCarModel").val()
                
                var makeval =  $("#front_make").val();
                var carval =  $("#front_series").val();
                var yearval =  $("#front_year").val();
                var modelval =  $("#front_model").val();
                // 前市场车型
                var make =  $("#front_make option:selected").text();
                var car =  $("#front_series option:selected").text();
                var year =  $("#front_year option:selected").text();
                var model =  $("#front_model option:selected").text();
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
                        if(model==cpCode && cpCode !=''){
                            al='此车系您已添加，不可重复添加！';
                        }
                    })
                    if(al==''){
                        if($("#showVehicle span.catespan").length % 2 != 0){
                            $("<span class='checkbox-add bg-green tag-close catespan'><span>"+make+"</span>-<span>"+car+"</span>-<span>"+year+"</span>-<span name='model'>"+model+"</span><span onclick='xxVehicle(this)' key='0' class='close icon-close-green xx'></span></span><br>").appendTo("#showVehicle");
                        }else{
                            $("<span class='checkbox-add bg-green tag-close catespan'><span>"+make+"</span>-<span>"+car+"</span>-<span>"+year+"</span>-<span name='model'>"+model+"</span><span onclick='xxVehicle(this)' key='0' class='close icon-close-green xx'></span></span>").appendTo("#showVehicle");
                        }
                        $("<input type='hidden' value="+makeval+" name='make[]'><input type='hidden' value="+carval+" name='car[]'><input type='hidden' value="+yearval+" name='year[]'><input type='hidden' value="+modelval+" name='model[]'>").appendTo("#showVehicle");
                        $("<input type='hidden' value="+make+" name='maketext[]'><input type='hidden' value="+car+" name='cartext[]'><input type='hidden' value="+year+" name='yeartext[]'><input type='hidden' value="+model+" name='modeltext[]'>").appendTo("#showVehicle");
                           
                        // $("<span class='checkbox-add bg-green tag-close catespan'><span>"+businessCar+"</span>-<span name='model'>"+businessCarModel+"</span><span onclick='xxVehicle(this)' key='0' class='close icon-close-green xx'></span></span>").appendTo("#showVehicle");
                        // $("<input type='hidden' value="+businessCarval+" name='businessCar[]'><input type='hidden' value="+businessCarModelval+" name='businessCarModel[]'>").appendTo("#showVehicle");
                    }else{
                        alert(al);
                    }
                }
			
            }else{
                alert("最多只能添加100个");
            }
        });

    })

</script>
