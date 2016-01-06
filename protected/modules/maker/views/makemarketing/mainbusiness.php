<style>
    <!--
    /*.xx{width:10px;float:right: cursor:pointer; color:red; margin-left:5px;}*/
    -->
    .showbrand{ width: 300px; height:auto; position: absolute; z-index: 100; float: left; border: 1px solid #DEDEDE; background-color: #fff;}
    .checkbox-add{ line-height: 24px;}
    .label{font-weight: bold;}
</style>
<script>
    var countSelf = true;;
</script>
<div>
    <div class='tabs' pre='tab'>
        <a class='left-indent'>&nbsp;</a>
        <a class='active' href="<?php echo Yii::app()->createUrl('maker/makemarketing/mainbusiness'); ?>">主营登记</a>
    </div>
    <div class="inner-padding">
        <div class='form-list'>
            <?php if (!empty($model)): ?>
                <?php
                $form = $this->beginWidget('CActiveForm', array(
                    'id' => 'make-form',
                    'htmlOptions' => array(
                        'enctype' => 'multipart/form-data',
                    ),
                        ));
                ?>
    <!--                <p class="form-row">
                        <label class='label'> 经营品牌：</label>
                <?php //echo CHtml::textField('brand', $model->businessBrand, array('class' => 'width453 input', 'onkeyup' => "this.value=this.value.replace(/，/g, ',')")); ?>
                        <span>（每个品牌之间用“，”隔开）</span>
                    </p>-->
                <p class="form-row">
                    <label class='label'>经营品类：</label>
                    <?php
//                    $this->widget("widgets.default.WGcategory",array('requred'=>'N','notlink'=>'N'));
                    // $this->widget("widgets.default.WGcategory");
                    ?>
                    <input id="cpname-select" name="cpname" class=" input width260" type="text" value="" style="width:260px;">
                    <span id="helpcate"><img src="<?php echo F::themeUrl() ?>/images/help.png" style="cursor: pointer;vertical-align:middle;"></span>
                    <input type="hidden" value="" name="jpmall_maincate"  id="jpmall_maincate"/>
                    <input type="hidden" value="" name="jpmall_subcate" id="jpmall_subcate"/>
                    <input type="hidden" value="" name="jpmall_cpname" id="jpmall_cpname"/>
                    <input id="mainCategory" name="maincategory" type="hidden" value="<?php echo $search['maincategory']; ?>">
                    <input id="subCategory" name="subcategory" type="hidden" value="<?php echo $search['subcategory']; ?>">
                    <input id="leafCategory" name="cpnamecategory" type="hidden" value="<?php echo $search['category']; ?>">
                    <input id='addCp' type="button" class="btn" value="添加">
                </p>
                <p class="form-row" id="showcpname">
                    <label class=label></label>
                    <?php if ($showcpnames): ?>
                        <?php foreach ($showcpnames as $showcpname): ?>
                            <span class='checkbox-add bg-green tag-close catespan'><span name="BigName"><?php echo $showcpname['BigName']; ?></span> <span name='SubName'><?php echo $showcpname['SubName']; ?></span> <span name='CpName'><?php echo $showcpname['CpName'] ?></span><span onclick='delCp(this)' key="<?php echo $showcpname['ID'] ?>" style="cursor:pointer;font-size: 9px;font-family: Georgia;">　X</span></span>
                        <?php endforeach; ?>
                        <input type="hidden" name="delcpids" id="delcpids" />
                    <?php endif; ?>
                </p>
                <div id="message"></div>
                <p class="form-row">
                    <label class="label"></label>
                    <input class="submit" type='button' id="sure" value='保存资料'></input>
                </p>
                <?php $this->endWidget(); ?>
            <?php else: ?>
                <p class="errormessage">对不起，您的公司信息未填写，<br> 请先到 <?php echo CHtml::link("我的公司", array('/maker/makecompany/index')) ?> 登记</p>
            <?php endif; ?>
        </div>
    </div>
    <!-- 显示边栏 -->
    <div class="sidebar-show"></div>
    <div style='height:120px'></div>
    <div class='block-shadow'></div>
</div>
<?php $this->widget("widgets.default.WGoodsMainCategoryModel"); ?>
<?php $this->widget('widgets.default.WHelpMainGoodsCategory'); ?>
<script type="text/javascript">

    //删除主营
    function delCp(obj){
        var cateid = obj.getAttribute("key")
        if(cateid != 0)
        {
            $.getJSON(Yii_baseUrl+"/maker/makemarketing/checkdel",{cateid:cateid},function(result){
                if(result=="OK"){
                    var Cpids=$("#delcpids").val();
                    if(Cpids==''){
                        $("#delcpids").val(cateid);
                    }else{
                        $("#delcpids").val(Cpids+','+cateid);
                    }
                    $(obj).parent().remove();
                }else{
                    $.messager.alert('提示',result,'info');
                }
            });
        }else{
            $(obj).parent().remove();
        }
    }
    var message='<?php echo $message; ?>';
    if(message!=''){
        $.messager.alert('提示',message,'info');
    }
    // 可多选品类
    $(function(){
        // 添加品类
        $("#addCp").click(function(){
            if($("#showcpname span.catespan").length < 5)
            {
                // text
                
                var BigName =  $("#mainCategory").val(); 
                var SubName =  $("#subCategory").val();
                var CpName = $("#leafCategory").val();
                
                
                var BigpartsID =  $("#jpmall_maincate").val();
                var SubCodeID =  $("#jpmall_subcate").val();
                var CpNameID =  $("#jpmall_cpname").val();
                
                if(CpName==''){
                    alert('请选择标准名称！');
                    return false;
                }
                if(SubName==''){
                    alert('请选择子类！');
                    return false;
                }
                if(BigName == "")
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
                            $("<br/><span class='checkbox-add bg-green tag-close catespan'><span name='BigName'>"+BigName+"</span> <span name='SubName'>"+SubName+"</span> <span name='CpName'>"+CpName+"</span><span onclick='delCp(this)' key='0' style='cursor:pointer;font-size: 9px;font-family: Georgia;'>　X</span><input type='hidden' value="+BigName+" name='BigName[]'><input type='hidden' value="+SubName+" name='SubName[]'><input type='hidden' value="+CpName+" name='CpName[]'><input type='hidden' value="+BigpartsID+" name='BigpartsID[]'><input type='hidden' value="+SubCodeID+" name='SubCodeID[]'><input type='hidden' value="+CpNameID+" name='CpNameID[]'></span>").appendTo("#showcpname");
                        }else{
                            $("<span class='checkbox-add bg-green tag-close catespan'><span name='BigName'>"+BigName+"</span> <span name='SubName'>"+SubName+"</span> <span name='CpName'>"+CpName+"</span><span onclick='delCp(this)' key='0' style='cursor:pointer;font-size: 9px;font-family: Georgia;'>　X</span><input type='hidden' value="+BigName+" name='BigName[]'><input type='hidden' value="+SubName+" name='SubName[]'><input type='hidden' value="+CpName+" name='CpName[]'><input type='hidden' value="+BigpartsID+" name='BigpartsID[]'><input type='hidden' value="+SubCodeID+" name='SubCodeID[]'><input type='hidden' value="+CpNameID+" name='CpNameID[]'></span>").appendTo("#showcpname");
                        }
                        //$("<span class='checkbox-add bg-green tag-close catespan'><span name='cp_name'>"+cp_name+"</span><span onclick='xxVehicle(this)' key='0' class='close icon-close-green xx'>X</span><input type='hidden' value="+system_typeval+" name='system_type[]'><input type='hidden' value="+cp_nameval+" name='cp_name[]'></span>").appendTo("#showCp");
                    }else{
                        $.messager.alert('提示信息',al);
                    }
                }		
            }else{
                alert("最多只能添加5个");
            }
        });
        $("#sure").click(function(){
            $.messager.confirm("提示","您确定要保存吗?",function(result){
                if(result)
                    $('#make-form').submit();
            })
        })
    })

</script>
