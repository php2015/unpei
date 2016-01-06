<div class='width998 content'>
    <?php include 'tabs_active.php'; ?>
    <div>
        <!-- 经销商 -->
        <div id="tab1" class="form-list">
            <?php echo CHtml::beginForm('promotions', 'get'); ?>
            <p class="form-row" style="padding-top: 10px;">
                <label style="margin-left:15px;">关&nbsp;键&nbsp;词:</label>
                <?php if (empty($search['keywords'])) $search['keywords'] = "配件名称、配件品牌" ?>
                <?php echo CHtml::textField('keywords', $search['keywords'], array('class' => 'width230 input', 'fuc' => 's')); ?>
                <label style="margin-left:30px;">&nbsp;&nbsp;&nbsp;OE&nbsp;号:</label>
                <?php if (empty($search['OENO'])) $search['OENO'] = "输入OE号" ?>
                <?php echo CHtml::textField('OENO', $search['OENO'], array('class' => 'width150 input', 'fuc' => 's')) ?>
                <label style="margin-left:30px;">
                    配件品类:</label>
                <?php
                $cpnames = GoodsStandard::model()->findAll();
                $cpname = CHtml::listData($cpnames, "system_type", "system_type");
                $cpname = array_filter($cpname);
                echo CHtml::dropDownList('system_type', $search['system_type'], $cpname, array(
                    'class' => 'width118 select',
                    'empty' => '选择系统类别',
                    'ajax' => array(
                        'type' => 'GET', //request type
                        'url' => Yii::app()->request->baseUrl . '/common/getcp_name', //url to call
                        'update' => '#cp_name', //lector to update
                        'data' => 'js:"system_type="+jQuery(this).val()',)
                ));
                ?>		
                <?php
                if ($_GET['system_type']) {
                    $datas = GoodsStandard::model()->findAll("system_type=:system_type", array(":system_type" => $_GET['system_type']));
                    $data = CHtml::listData($datas, "cp_name", "cp_name");
                }
                $data_update = $_GET['system_type'] ? $data : array();
                ?>		
                <?php
                echo Chtml::dropDownList('cp_name', $search['cp_name'], $data_update, array(
                    'class' => 'width118 select',
                    'empty' => '主营品类',
                ));
                ?>
                <?php // echo CHtml::textField('normName',$search['normName'],array('class'=>'width63 input')); ?>

            </p>
            <p class="form-row" style="padding-bottom: 10px;">
                <!--<label class="label">所在地区：	</label>
                --><?php
                $state_data = Area::model()->findAll("grade=:grade", array(":grade" => 1));
                $state = '';
                $state = CHtml::listData($state_data, "id", "name");
                $s_default = $model->isNewRecord ? '' : $model->province;
                echo CHtml::label('所在地区:', '', array('style' => 'margin-left:15px;'));
                echo "&nbsp;" . CHtml::dropDownList('provice', $search['provice'], $state, array(
                    'class' => 'width118 select',
                    'empty' => '请选择省份',
                    'ajax' => array(
                        'type' => 'GET', //request type
                        // 'url'=>CController::createUrl('dynamiccities'), //url to call
                        'url' => Yii::app()->request->baseUrl . '/common/dynamiccity', //url to call
                        'update' => '#city', //lector to update
                        'data' => 'js:"province="+jQuery(this).val()',
                        )));
                ?>
                <?php
                if ($search['provice']) {
                    $city_data = Area::model()->findAll("parent_id=:parent_id", array(":parent_id" => $search['provice']));
                    $city = CHtml::listData($city_data, "id", "name");
                }
                $city_update = $search['provice'] ? $city : array();
                ?>
                <?php
                echo Chtml::dropDownList('city', $search['city'], $city_update, array(
                    'class' => 'width118 select',
                    'empty' => '请选择城市',
                    'ajax' => array(
                        'type' => 'GET', //request type
                        'url' => Yii::app()->request->baseUrl . '/common/dynamiccity', //url to call
                        'update' => '#Dealer_area', //lector to update
                        'data' => 'js:"city="+jQuery(this).val()',
                        )));
                ?>
                <label style="margin-left:30px;">适用车系:</label>
                <?php
                $make_data = GoodsBrand::getBrand();
                $make = CHtml::listData($make_data, "id", "name");
                ?>
                <?php
                echo CHtml::dropDownList('make', $search['make'], $make, array(
                    'class' => 'width118 select',
                    'empty' => '请选择品牌',
                    'ajax' => array(
                        'type' => 'GET', //request type
                        'url' => Yii::app()->request->baseUrl . '/common/getcarbyid', //url to call
                        'update' => '#car', //lector to update
                        'data' => 'js:"make="+jQuery(this).val()',
                    )
                ));
                ?>
                <?php
                if ($_GET['make']) {
                    $brand = GoodsBrand::model()->find('id=' . $_GET['make']);
                    $data = GoodsBrand::model()->findAll("name=:Make", array(":Make" => $brand['name']));

                    $data = CHtml::listData($data, "id", "car");
                    //  $vehicleModel_data=GoodsBrand::model()->find("id=:id",array(":id"=>$search['vehicleMake']));
                }
                ?>
                <?php $vehicleModel_update = $_GET['make'] ? $data : array(); ?>
                <?php
                echo CHtml::dropDownList('car', $_GET['car'], $vehicleModel_update, array(
                    'class' => 'width118 select',
                    'empty' => '请选择车系',
                ));
                ?>
                <input type="hidden" value="1" name='is'>
                <input type="submit" value="查 询" class="submit" style="margin-left:30px;">
                <?php //if(!empty($search['is'])): ?>
                <?php //echo CHtml::link('取消查询',array('servicequery/promotions'),array('class'=>'btn-green btn-green-small active')) ?>
                <?php //endif; ?>
            </p>
            <?php echo CHtml::endForm(); ?>
        </div>

    </div>
    <div style='height:5px'></div>
    <div class='block-shadow'></div>
</div>
<div class='width998 content content-rows'>
    <div class='postion pos-r'> <i class='icon-pos'></i>
        当前数据总量：
        <span class='font-green' id='count'>(<?php echo $count; ?>)</span>
    </div>
    <div class='divers-f0'></div>
    <?php if (!empty($models)): ?>
        <div class='number-list'>
            <div class="checkbox-list">
                <div class='ctable-content'>
                    <div id="ctable1">
                        <table cellspacing=0 cellpadding=0 id="listSort">
                            <thead>
                                <tr>
                                    <td width=20>#</td>
                                    <td width=120>经销商名称</td>
                                    <td width=70>成立年份</td>
                                    <td width=70>联系方式</td>
                                    <td width=80>地址</td>
                                    <td width=170>主营品类</td>
                                    <td width=170>主营车系</td>
                                    <td width=130>主营品牌</td>
                                    <td width=70>商品列表</td>
                                </tr>
                            </thead>
                            <tbody>
                                <!-- 品牌厂家查询 -->

                                <?php $i = 1;
                                foreach ($models as $model):
                                    ?>
                                    <tr class='bd-tb'>
                                        <td><?php echo $i ?></td>
                                        <td>
                                            <?php echo CHtml::link($model['organName'], array('/servicer/servicequery/detail/dealer/' . $model['userID']), array('target' => '_blank')) ?>
        <?php // echo $model['organName'] ?>
                                        </td>
                                        <td>
        <?php echo $model['FoudingDate'] != '' ? $model['FoudingDate'] . "年成立" : '未登记'; ?>
                                        </td>
                                        <td><?php echo $model['Phone']; ?></td>
                                        <td><?php $add = Area::getCity($model['province']) . Area::getCity($model['city']) . Area::getCity($model['area']);
        echo F::msubstr($add)
        ?></td>
                                        <td><?php // echo !empty($model['BusinessCate']) ? F::msubstr($model['BusinessCate'],0,0)  : "暂无"?>
                                            <?php
                                            $cpnames = MakeOrganGroupRelation::model()->findAll("userID=" . $model['userID']);
                                            //echo $model['userID'];
                                            foreach ($cpnames as $cpname) {
                                                // $cpname['father_code'].' '.
                                                $cp .= $cpname['children_code'] . ',';
                                            }
                                            echo F::msubstr($cp);
                                            $cp = '';
                                            ?>
                                        </td>
                                        <td><?php
                                            $dealerv = DealerVehicle::model()->findAll('userid =' . $model['userID']);
                                            foreach ($dealerv as $transports) {
                                                $cars .= GoodsBrand::getName($transports['businessCar']) . ' ' . GoodsBrand::getCar($transports['businessCarModel']) . ',';
                                            }

                                            echo F::msubstr($cars, 0, 0);
                                            $cars = '';
                                            ?>
                                        </td>
                                        <td>
                                            <?php echo!empty($model['BusinessBrand']) ? F::msubstr($model['BusinessBrand'], 0, 0) : "暂无" ?>
                                        </td>
                                        <td>
                                            <?php if (!empty($model['userID'])): ?>
                                                <a target="_blank" href='<?php echo Yii::app()->createUrl('servicer/servicequery/QueryProGoods/userID') ?><?php echo '/' . $model['userID'] ?>'>查看商品</a>
                                            <?php else: ?>
                                                暂无
                                    <?php endif; ?>
                                        </td>
                                    </tr>
        <?php $i++; ?>
    <?php endforeach; ?>

                            </tbody>
                        </table>
                    </div>
                    <div id="ctable3">3</div>
                    <div id="ctable4"></div>
                </div>
            </div>		
        </div>
            <?php if ($count > 10): ?>
            <div class="pagelist text-c">
        <?php echo $page; ?>
                <span>
                    去第
                    <input id='thepage' class='input' value="<?php echo $_GET['page'] ?>" style='width:20px' type='text'/>
                    页
                    <span id='gopage' class='btn-tiny'>GO</span>
                </span>
            </div>
    <?php endif; ?>
<?php else : ?>
        <center>
            <p>搜索到   <font color=red>0</font> 条数据<?php // echo CHtml::link('重新加载',array('makequery/index')) ?></p>
        </center>
<?php endif; ?>
    <div style='height:120px'></div>
    <div class='block-shadow'></div>
</div>
<script type='text/javascript'>
    $(function(){
        //	$("#keywords").click(function(){
        //		//$(this).select();
        //	});
        $("#OENO").click(function(){
            $(this).select();
        });
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
            var url = "<?php echo Yii::app()->createUrl('servicer/servicequery/promotions'); ?>";
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