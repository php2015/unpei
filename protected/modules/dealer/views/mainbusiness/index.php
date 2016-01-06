<style>
    .zdytext {
        background: none repeat scroll 0 0 #fff;
        border: 1px solid #dedede;
        width:748px;
        height: 70px;
    }
    .ylr_ul {min-height:30px;height:auto}
    .ylr_ul li {
        width:40%;float:left;margin-right:10px;
    }
</style>
<?php
$this->pageTitle = Yii::app()->name . ' - 主营信息管理';
$this->breadcrumbs = array(
    '用户中心' => Yii::app()->createUrl('common/dealmemberlist'),
    '主营信息管理',
);
if (!empty($datas['LogisticsDescription']))
    $clear = 0;
else {
    $clear = 1;
}
?>
<input type="hidden" id="logid" value="<?php echo $logid; ?>">
<div class="bor_back m-top" style=" position:relative">
    <p class="txxx">主营信息管理
    </p>

    <div  style="margin-left:2px">
        <div class="target_list">
            <p class="m-top m_left20"><span>主营品类：</span>
                <?php $this->widget("widgets.default.WGcategory", array('requred' => 'N', 'notlink' => 'N')); ?> 
                <span class="add m_left"> <a href="javascript:;" class="add_wz alternative" id="addcpname" onclick="addcpname()"><span class="jiahao">+</span></a></span>
                <a href="javascript:;" class="add_wz alternative" id="addcpname" onclick="addcpname()">添加</a></p>
            <div class="ylr">
                <b>已录入主营品类</b>
                <ul class="ylr_ul" id="cpnameul">
                    <?php if ($cpname): ?>
                        <?php foreach ($cpname as $v): ?>
                            <li id="<?php echo c . $v['ID']; ?>" BigpartsID="<?php echo $v['BigpartsID']; ?>" SubCodeID="<?php echo $v['SubCodeID']; ?>" CpNameID="<?php echo $v['CpNameID']; ?>">
                                <span style="display: block;float: left; width: 200px;white-space: nowrap;overflow: hidden; text-overflow: ellipsis;" title="<?php echo $v['BigName'] . ' ' . $v['SubName'] . ' ' . $v['CpName']; ?>"><?php echo $v['BigName'] . ' ' . $v['SubName'] . ' ' . $v['CpName']; ?></span>
                                <a class="color_blue" style="float:right" href="javascript:void(0)" onclick="delcpname(<?php echo $v['ID']; ?>)">删除</a>
                            </li>
                        <?php endforeach; ?>
                    <?php endif; ?>
                </ul>
                <div style="clear:both;"></div>
            </div>
            <p class="m-top m_left20 float_l"><span>经营车系：</span>
                <?php //$this->widget('widgets.default.WGoodsModel', array('scope' => 'front', 'notlink' => 'N')); ?>
<!--                <span class="add m_left"><a href="javascript:;" class="add_wz alternative" id="add" onclick="addVehcle()"><span class="jiahao">+</span></a></span>
                <a href="javascript:;" class="add_wz alternative" id="add" onclick="addVehcle()">添加</a>-->
            </p>
            <div class="ylr">
                <b>已录入经营车系</b>
                <ul class="ylr_ul" id="vehiclesul">
                    <?php
                    if ($vehicle):
                        ?>
                        <?php foreach ($vehicle as $v): ?>
                            <li id="<?php echo v . $v['ID']; ?>" key="<?php echo $v['ID']; ?>" make="<?php echo $v['Make']; ?>" car="<?php echo $v['Car']; ?>" year="<?php echo $v['Year']; ?>" model="<?php echo $v['Model']; ?>">
                                <span style="display: block;float: left; width: 200px;white-space: nowrap;overflow: hidden; text-overflow: ellipsis;" title="<?php
                    if ($v['Make']) {
                        echo $v['Make'];
                    }
                    if ($v['Car']) {
                        echo ' ' . $v['Car'];
                    }
                    if ($v['Year']) {
                        echo ' ' . $v['Year'];
                    }
                    if ($v['Model']) {
                        echo ' ' . $v['Model'];
                    }
                            ?>">                                <?php
                              if ($v['Make']) {
                                  echo $v['Make'];
                              }
                              if ($v['Car']) {
                                  echo ' ' . $v['Car'];
                              }
                              if ($v['Year']) {
                                  echo ' ' . $v['Year'];
                              }
                              if ($v['Model']) {
                                  echo ' ' . $v['Model'];
                              }
                            ?></span>                               
<!--                                <a class="color_blue" style="float:right" href="javascript:void(0)" onclick="delVehcle(<?php //echo $v['ID']; ?>)">删除</a>-->
                            </li>
                        <?php endforeach; ?>
                    <?php endif; ?>
                </ul>
                <div style="clear:both;"></div>
            </div>
            <p class="m-top m_left20" style="margin-bottom: 5px"><span>主营品牌：</span>
                <!--<span class="add m_left"><a href="javascript:;" class="add_wz alternative" onclick="addbrand()"><span class="jiahao">+</span></a></span>-->
                <!--<a href="javascript:;" class="add_wz alternative" onclick="addbrand()">添加</a></p>-->
                <?php
                $brand = MainbusinessService::organidgetbrand();
                $this->widget('widgets.default.WGridView', array(
                    'dataProvider' => $brand,
                    'columns' => array(
                        array(// display 'create_time' using an expression
                            'name' => '序号',
                            'value' => '$this->grid->dataProvider->pagination->currentPage*$this->grid->dataProvider->pagination->pageSize + $row+1',
                        ),
                        array(// display 'author.username' using an expression
                            'name' => '品牌名称',
                            'value' => '$data->BrandName',
                        ),
                        array(// display 'author.username' using an expression
                            'name' => '拼音',
                            'value' => '$data->Pinyin',
                        ),
                        array(// display 'author.username' using an expression
                            'name' => '描述',
                            'value' => '$data->Description',
                        ),
//                        array(
//                            // display a column with "view", "update" and "delete" buttons
//                            'class' => 'CButtonColumn',
//                            'header' => '操作',
//                            'template' => '{update}{delete}',
//                            'buttons' => array(
//                                'update' => array(
//                                    'label' => '修改',
//                                    'url' => 'Yii::app()->createUrl("/dealer/Mainbusiness/Editbrand",array("ID"=>$data->ID))'
//                                ),
//                                'delete' => array(
//                                    'lable' => '删除',
//                                    'click' => "function(){
//			         		if(!confirm('确定要删除这条数据吗？')) return false;
//			            	$.ajax({
//				            	url:$(this).attr('href'),
//				                type:'GET',
//				             	dataType:'JSON',
//				            	success:function(data)
//				           		{
//				                	alert(data['errorMsg']);
//				                	history.go(0); 
//				             	}
//			             	});
//			        		return false;
//			       		}",
//                                    'url' => 'Yii::app()->createUrl("/dealer/Mainbusiness/Delbrand",array("ID"=>$data->ID))',
//                                )
//                            ),
//                        ),
                    ),
                ));
                ?>
        </div>

    </div>
</div>

<?php
$this->beginWidget('zii.widgets.jui.CJuiDialog', array(
    'id' => 'reminddg', //弹窗ID  
    'options' => array(//传递给JUI插件的参数  
        'title' => '操作提示',
        'autoOpen' => false, //是否自动打开  
        'width' => '300px', //宽度  
        'height' => 'auto', //高度  
        'buttons' => array(
            '关闭' => 'js:function(){ $(this).dialog("close");}', //关闭按钮  
        ),
    ),
));

$this->endWidget('zii.widgets.jui.CJuiDialog');
?>
<script>
    //添加主营品牌
    function addbrand(){
        window.location.href ="<?php echo Yii::app()->createUrl("dealer/Mainbusiness/Addbrand"); ?>";
    }
    //添加主营品类
    function addcpname(){
        if($("#cpnameul li").length < 150)
        { 
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
                var status = 'add';
                var delID=new Array();
                $("#cpnameul li").each(function(){
                    var bigCode = $(this).attr('bigpartsid');
                    var subCode = $(this).attr('subcodeid');
                    var cpCode = $(this).attr('cpnameid');
                    if(CpNameID==cpCode  && SubCodeID== subCode&& BigpartsID==bigCode){
                        al='此品类您已添加，不可重复添加！';
                    }
                    if(BigpartsID==bigCode && cpCode==0 && (subCode==0||subCode==SubCodeID)){
                        al='此品类您已添加，不可重复添加！';
                    }
                    if(BigpartsID==bigCode && CpNameID==0 && (SubCodeID==0||subCode==SubCodeID)){
                        status = 'update';
                        delID.push($(this).attr('key')); 
                    }
                })
                if(al==''){
                    var url =" <?php echo Yii::app()->createUrl('dealer/Mainbusiness/Addcpname'); ?>";
                    $.getJSON(url,{BigpartsID:BigpartsID,SubCodeID:SubCodeID,CpNameID:CpNameID,BigName:BigName,SubName:SubName,CpName:CpName},function(data){
                        if(data.success==1){  
                            var html ="<li id='c"+data.ID+"'  key="+data.ID+" BigpartsID="+BigpartsID+" SubCodeID="+SubCodeID+" CpNameID="+CpNameID+">"
                            html +="<span style='display: block;float: left; width: 200px;white-space: nowrap;overflow: hidden; text-overflow: ellipsis;' Title='"+BigName+" "+SubName+" "+CpName+"'>"+BigName+" "+SubName+" "+CpName+"<\/span>";
                            html +="<a class='color_blue' style='float:right' href='javascript:void(0)' onclick='delcpname("+data.ID+")'>删除</a>";
                            html +="<\/li>";
                            $("#cpnameul").append(html);
                            if(status=='update'){
                                for(var i=0;i<delID.length;i++){
                                    var url ="<?php echo Yii::app()->createUrl('dealer/Mainbusiness/Delcpname'); ?>";
                                    $.getJSON(url,{ID:delID[i]},function(data){
                                        if(data.result == 1)
                                            $("#c"+data.ID).remove();
                                    });
                                }
                            }
                        }else{
                            alert('添加失败'+data.errorMsg)
                        }
                    });
                }else{
                    alert(al);
                }
            }		
        }else{
            alert("最多只能添加150个");
        }
    }
    
    // 添加车系
    function addVehcle(){
        if($("#vehiclesul li").length <100){
            var makeval =  $("#front_make").val();
            var carval =  $("#front_series").val();
            var yearval =  $("#front_year").val();
            var modelval =  $("#front_model").val();

            // 前市场车型
            var make =  $("#front_make option:selected").text();
            var car =  $("#front_series option:selected").text();
            var year =  $("#front_year option:selected").text();
            var model =  $("#front_model option:selected").text();
            //            alert(make+'|'+carval+'|'+year+'|'+model)
            if(carval == ''||carval=='ALL'){
                carval= 0;
                car = 0;
            }
            if(yearval == ''||yearval=='ALL'){
                yearval= 0;
                year = 0;
            }if(modelval==''||modelval=='ALL'){
                modelval = 0;
                model = 0;
            }
            if(make == "请选择厂家")
            {
                alert('您还没有选择主营车系！');
                return false;
            }else{
                var al='';
                var status = 'add';
                var delID=new Array();
                $("#vehiclesul li").each(function(){
                    var cpCode=$(this).attr('model');
                    var cpCar=$(this).attr('car');
                    var cpYear=$(this).attr('year');
                    var cpmake=$(this).attr('make');
                    if(model==cpCode && car==cpCar && year==cpYear && make==cpmake){
                        al='此车系您已添加，不可重复添加！';
                    }
                    if(cpmake==make && (cpCar==0||cpCar==car) && (cpYear==0|| cpYear==year) && cpCode==0){
                        al='此车系您已添加，不可重复添加！';
                    }
                    if(cpmake==make && (car==0||cpCar==car) && (year==0|| cpYear==year) && model==0){
                        status = 'update';
                        delID.push($(this).attr('key')); 
                    } 
                });
                if(al==''){
                    var url =" <?php echo Yii::app()->createUrl('dealer/Mainbusiness/Addvehcle'); ?>";
                    $.getJSON(url,{Make:make,Car:car,Year:year,Model:model},function(data){
                        if(data.success==1){  
                            var html ="<li id='v"+data.ID+"' key="+data.ID+" make='"+make+"' car='"+car+"' year='"+year+"' model='"+model+"'>";
                            html +="<span style='display: block;float: left; width: 200px;white-space: nowrap;overflow: hidden; text-overflow: ellipsis;' Title='";
                            if(make){
                                html += make;
                            }
                            if(car){
                                html += ' '+car;
                            }
                            if(year){
                                html += ' '+year;
                            }
                            if(model){
                                html += ' '+model;
                            }
                            html +="'>";
                            if(make){
                                html += make;
                            }
                            if(car){
                                html += ' '+car;
                            }
                            if(year){
                                html += ' '+year;
                            }
                            if(model){
                                html += ' '+model;
                            }
                            html +="<\/span>";
                            html +=  " <a class='color_blue' style='float:right' href='javascript:void(0)' onclick='delVehcle("+data.ID+")'>删除</a>"
                            html +="<\/li>";
                            $("#vehiclesul").append(html);
                            if(status=='update'){
                                for(var i=0;i<delID.length;i++){
                                    var url ="<?php echo Yii::app()->createUrl('dealer/Mainbusiness/Delvehcle'); ?>";
                                    $.getJSON(url,{ID:delID[i]},function(data){
                                        if(data.result == 1){
                                            $("#v"+data.ID).remove();
                                        }
                                    });
                                }
                            }
                        }else{
                            alert('添加失败'+data.errorMsg)
                        }
                    });
                }else{
                    alert( al);
                }
            }
			
        }else{
            alert("最多只能添加100个");
        }
    }
    
    //删除主营车系
    function delVehcle(ID){
        var url ="<?php echo Yii::app()->createUrl('dealer/Mainbusiness/Delvehcle'); ?>";
        $.getJSON(url,{ID:ID},function(data){
            if(data.result == 1)
                $("#v"+ID).remove();
        });
    }
    //删除主营品类
    function delcpname(ID){
        var url ="<?php echo Yii::app()->createUrl('dealer/Mainbusiness/Delcpname'); ?>";
        $.getJSON(url,{ID:ID},function(data){
            if(data.result == 1)
                $("#c"+ID).remove();
        });
    }
</script>
