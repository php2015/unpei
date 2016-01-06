<div class='width998 content'>
    <?php include 'tabs_active.php'; ?>
    <?php
    //获取汽车品牌信息
    //$brand_data=TransportMake::model()->findAll();
    //$brand=CHtml::listData($brand_data,"Code","Make");
    $brand_data = GoodsBrand::getBrand();
    $brand = CHtml::listData($brand_data, "id", "name");
    ?>
    <div class="form-list">
        <form action="<?php echo Yii::app()->createUrl("dealer/makequery/servicersearch"); ?>" method="get" name="queryForm" >
            <p class='form-row'>
                &nbsp;&nbsp;<label>关&nbsp;键&nbsp;词：</label>
                <input class="width248 input" type="text" name="keyWord" value="<?php if ($search['keyword']): echo $search['keyword'];
    else: echo "机构名称或关键词";
    endif; ?>" onfocus="if (value =='机构名称或关键词'){this.style.color='#000'; value =''}" onblur="if (value ==''){this.style.color='#999'; value='机构名称或关键词'}">
                &nbsp;&nbsp;<label >地&nbsp;&nbsp;&nbsp;区：</label>
                <?php
                $state_data = Area::model()->findAll("grade=:grade", array(":grade" => 1));
                $state = CHtml::listData($state_data, "id", "name");
                $s_default = $model->isNewRecord ? '' : $search['province'];
                echo CHtml::dropDownList('sprovince', $s_default, $state, array(
                    'empty' => '请选择省',
                    'class' => 'width114 select',
                    'ajax' => array(
                        'type' => 'GET',
                        'url' => Yii::app()->request->baseUrl . '/common/dynamiccity',
                        'update' => '#scity',
                        'data' => 'js:"province="+jQuery(this).val()',
                       // 'success'=>'function(html){jQuery("#scity").html(html);jQuery("#scity").change();}'
                    )
                        )
                );
                $c_default = $model->isNewRecord ? '' : $search['city'];
                if (!$model->isNewRecord) {
                    $city_data = Area::model()->findAll("parent_id=:parent_id", array(":parent_id" => $search['province']));
                    $city = CHtml::listData($city_data, "id", "name");
                }
                $city_update = $model->isNewRecord ? array() : $city;
                echo CHtml::dropDownList('scity', $c_default, $city_update, array(
                    'empty' => '请选择市',
                    'class' => 'width114 select',
                    'ajax' => array(
                        'type' => 'GET',
                        'url' => Yii::app()->request->baseUrl . '/common/Dynamicareas', //url to call
                        'update' => '#sarea',
                        'data' => 'js:"city="+jQuery(this).val()',
                    )
                        )
                );
                $d_default = $model->isNewRecord ? '' : $search['area'];
                if (!$model->isNewRecord) {
                    $district_data = Area::model()->findAll("parent_id=:parent_id", array(":parent_id" => $search['city']));
                    $district = CHtml::listData($district_data, "id", "name");
                }
                $district_update = $model->isNewRecord ? array() : $district;
                echo CHtml::dropDownList('sarea', $d_default, $district_update, array(
                    'empty' => '请选择区',
                    'class' => 'width114 select'
                ));
                ?>
                <!--<span class="checkbox-add">如果未选择，则系统自动默认为用户所在的市</span>-->
                <input class="submit" type="submit" name="submit" value="查  询" style="margin-left: 20px;">
                <?php //if ($search):  ?>
                <a href="<?php //echo Yii::app()->createUrl("dealer/makequery/servicersearch");?>">
                        <!--<input class="submit" type='button' name="cancel" value='取消查询'>
                    --></a>
                <?php //endif;  ?>
            </p>
        </form>	
    </div>
    <div style='height:5px'></div>
    <div class='block-shadow'></div>
</div>

<div class='width998 content content-rows'>
    <div class='postion pos-r'> <i class='icon-pos'></i>
        当前数据总量：<!-- 地区：武汉市 -->
        <span class='font-green' id='count'>(<?php echo $count; ?>)</span>
    </div>
    <div class='divers-f0'></div>
    <?php if (!empty($service)): ?>
        <div class='number-list'>
            <div class="checkbox-list">
                <div class='ctable-content'>
                    <div id="ctable1">
                        <table cellspacing=0 cellpadding=0 id="listSort">
                            <thead>
                                <tr>
                                    <td width=10>#</td>
                                    <td width=130>修理厂名称</td>
                                    <td width=110>联系方式</td>
                                    <td width=70>成立年份</td>
                                    <td width=70>店铺面积</td>
                                    <td width=60>工位数</td>
                                    <td width=60>停车数</td>
                                    <td width=60>技师数</td>
                                    <td width=180>地址</td>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $i = 0;
                                $j = 1;
                                foreach ($service as $ser): ?>
                                    <tr>
                                        <td ><?php echo $j ?></td>
                                        <td ><?php echo CHtml::link($ser['serviceName'], array('/dealer/makequery/servicedetail/id/' . $ser['userId']), array('target' => '_blank')); ?></td>
                                        <td ><?php echo $ser['serviceCellPhone']; ?>&nbsp;&nbsp;<?php echo $ser['serviceContact']; ?></td>
                                        <td ><?php echo $ser['serviceFounded']; ?>年</td>
                                        <td ><?php echo $ser['serviceStoreSize']; ?></td>
                                        <td ><?php echo $ser['servicePositionCount']; ?></td>
                                        <td ><?php echo $ser['serviceParkingDigits']; ?></td>
                                        <td ><?php echo $ser['serviceTechnicianCount']; ?></td>
                                        <td ><?php echo F::msubstr(Area::getCity($ser['serviceProvince']) . Area::getCity($ser['serviceCity']) . Area::getCity($ser['serviceArea']) . $ser['serviceAddress'], 0, 0); ?></td>
                                    </tr>
        <?php $i++;
        $j++;
    endforeach; ?>
                            </tbody>
                        </table>
                    </div>
                    <div id="ctable3">3</div>
                    <div id="ctable4"></div>
                </div>
            </div>		
        </div>
    <?php if ($count > $pagesize): ?>
            <div class="pagelist text-c">
        <?php echo $page; ?>
                <span>
                    去第
                    <input id='thepage' class='input' value='<?php echo $_GET['page'] ?>' style='width:20px' type='text'/>
                    页
                    <span id='gopage' class='btn-tiny'>GO</span>
                </span>
            </div>
        <?php endif; ?>

<?php else : ?>
        <center><p>搜索到   <font color=red>0</font> 条数据 <?php //echo CHtml::link('重新加载',array('/dealer/makequery/servicersearch')) ?></p></center>
<?php endif; ?>
    <div style='height:120px'></div>
    <div class='block-shadow'></div>
</div>
<script type='text/javascript'>
    $(function(){
        var count= eval($("#count").text());
        count = Math.ceil(count/5);
        $("#thepage").keyup(function(){
            var thisval = $(this).val();
            if(thisval<1)
                $(this).val('1');
            else if(isNaN(thisval))
                $(this).val('1');
            else if(thisval>=count)
                $(this).val(count);
        });
	
        // 跳转到第几页
        $("#gopage").click(function(){
            var url = "<?php echo Yii::app()->createUrl('dealer/makequery/servicersearch'); ?>";
            var page = $("#thepage").val();
            //var page = parseInt(page);
            if(isNaN(page))
            {
                alert('请输入阿拉伯数字 !');
                $("#thepage").val('');
            }else{
                location.href=url+"?page="+page;
            }
        }).css('cursor','pointer');
    });
</script>
<script type='text/javascript'>
    $(document).ready(function(){
        $("#sprovince").change(function(){
            if($(this).val()){
                $("#sarea").empty();
                $("<option value=''>请选择区</option>").appendTo("#sarea");
            }
        });
        //	//日常保养
        //	$(".routine").click(function(){
        //		var routine = $(this).text();
        //		$("<input type='hidden' name='maintenance' value="+routine+">").appendTo("#routineMaintenance");
        //	});
        //	//检查诊断
        //	$(".diagnos").click(function(){
        //		var diagnos = $(this).text();
        //		$("<input type='hidden' name=diagnosis' value="+diagnos+">").appendTo("#diagnosis");
        //	});
        //	//专业修理
        //	$(".repair").click(function(){
        //		var repair = $(this).text();
        //		$("<input type='hidden' name='repair' value="+repair+">").appendTo("#professionalRepair");
        //	});
        //	//选择主营类别下级
        //	$("#category").change(function(){
        //		var category = $("#category").val();
        //		switch(category)
        //		{
        //			case "深度清洁" : $("#deepCleaning").show();$("#vehiclesBeauty").hide();$("#routineMaintenance").hide();$("#diagnosis").hide();$("#wearingParts").hide();$("#professionalRepair").hide();$("#insuranceService").hide(); break;
        //			case "车辆美容" : $("#deepCleaning").hide();$("#vehiclesBeauty").show();$("#routineMaintenance").hide();$("#diagnosis").hide();$("#wearingParts").hide();$("#professionalRepair").hide();$("#insuranceService").hide(); break;
        //			case "日常保养" : $("#deepCleaning").hide();$("#vehiclesBeauty").hide();$("#routineMaintenance").show();$("#diagnosis").hide();$("#wearingParts").hide();$("#professionalRepair").hide();$("#insuranceService").hide(); break;
        //			case "检查诊断" : $("#deepCleaning").hide();$("#vehiclesBeauty").hide();$("#routineMaintenance").hide();$("#diagnosis").show();$("#wearingParts").hide();$("#professionalRepair").hide();$("#insuranceService").hide(); break;
        //			case "易损件更换": $("#deepCleaning").hide();$("#vehiclesBeauty").hide();$("#routineMaintenance").hide();$("#diagnosis").hide();$("#wearingParts").show();$("#professionalRepair").hide();$("#insuranceService").hide(); break;
        //			case "专业修理" : $("#deepCleaning").hide();$("#vehiclesBeauty").hide();$("#routineMaintenance").hide();$("#diagnosis").hide();$("#wearingParts").hide();$("#professionalRepair").show();$("#insuranceService").hide(); break;
        //			case "车险服务" : $("#deepCleaning").hide();$("#vehiclesBeauty").hide();$("#routineMaintenance").hide();$("#diagnosis").hide();$("#wearingParts").hide();$("#professionalRepair").hide();$("#insuranceService").show(); break;
        //		}
        //	});
    })
</script>