<?php
$this->pageTitle = Yii::app()->name . ' - ' . "商家查询";
?>
<div class='width998 content'>
    <div class='tabs' pre='tab'>
        <a style='margin-left:-30px;'>&nbsp;</a>
        <a class='active' href='<?php echo Yii::app()->createUrl('maker/dealquery/search') ?>'>经销商</a>
    </div>
    <!-- 经销商 -->
    <div class=''>
        <div id="tab1" class="form-list">
            <?php echo CHtml::beginForm(Yii::app()->createUrl('maker/dealquery/search'), 'get'); ?>
            <p class='form-row'>
                <label class="label2" style="margin-left:10px;">主营品牌：</label>
                <?php echo CHtml::textField('search[brand]', $search['brand'], array('class' => "width260 input")); ?>
               <label class="label2" style="margin-left:10px;">地　　区：</label>
                <?php
                $province_data = Area::model()->findAll("grade=:grade", array(":grade" => 1));
                $province = CHtml::listData($province_data, "id", "name");
                ?>
                <?php
                echo CHtml::dropDownList('search[province]', $search['province'], $province, array(
                    'class' => 'width113 select',
                    'empty' => '请选择省',
                    'ajax' => array(
                        'type' => 'GET', //request type
                        'url' => Yii::app()->request->baseUrl . '/common/dynamiccity', //url to call
                        'update' => '#search_city', //selector to update
                        'data' => 'js:"province="+jQuery(this).val()',
                    )
                ));
                if ($search['province']) {
                    $city_data = Area::model()->findAll("parent_id=:parent_id", array(":parent_id" => $search['province']));
                    $city = CHtml::listData($city_data, "id", "name");
                }
                $city_update = $search['province'] ? $city : array();
                echo CHtml::dropDownList('search[city]', $search['city'], $city_update, array(
                    'class' => 'width113 select',
                    'empty' => '请选择市',
                ));
                ?>
                <?php
//                            $this->widget("widgets.default.WGcategory", array(
//                            'mainCategory' => $search['mainCategory'], 'subCategory' => $search['subCategory'], 'leafCategory' => $search['leafCategory'],'notlink'=>'N'
//                            ));
                            
                            ?>
                 <input type="hidden" value="<?php echo $search['mainCategory'] ?>" name="jpmall_maincate"  id="jpmall_maincate"/>
                <input type="hidden" value="<?php echo $search['subCategory'] ?>" name="jpmall_subcate" id="jpmall_subcate"/>
                <input type="hidden" value="<?php echo $search['leafCategory'] ?>" name="jpmall_cpname" id="jpmall_cpname"/>
                <input name="maincategory" type="hidden" value="<?php echo $search['maincategory']; ?>">
                <input name="subcategory" type="hidden" value="<?php echo $search['subcategory']; ?>">
                <input name="cpnamecategory" type="hidden" value="<?php echo $search['category']; ?>">
<!--                <input name="search[category]" type="hidden" id="category" value="<?php //echo $search['category'];?>">-->
                <?php
//                $criteria = new CDbCriteria();
//                $criteria->distinct = true;
//                $criteria->select = 'system_type';
//                $make_data = GoodsStandard::model()->findAll($criteria);
//                $system = CHtml::listData($make_data, "system_type", "system_type");
//                $system = array_filter($system);
                ?>

                <?php
//                echo CHtml::dropDownList('search[system_type]', $search['system_type'], $system, array(
//                    'class' => 'width110 select',
//                    'empty' => '请选择系统',
//                    'ajax' => array(
//                        'type' => 'GET', //request type
//                        'url' => Yii::app()->request->baseUrl . '/common/getcp_name', //url to call
//                        'update' => '#search_cp_name', //lector to update
//                        'data' => 'js:"system_type="+jQuery(this).val()',
//                    )
//                ));
                ?>
                <?php
//                if ($search['system_type']) {
//                    $cp_data = GoodsStandard::model()->findAll("system_type=:system_type", array(":system_type" => $search['system_type']));
//                    $cp_name_data = CHtml::listData($cp_data, "cp_name", "cp_name");
//                }
                ?>
                <?php //$cpName_data = $search['system_type'] ? $cp_name_data : array(); ?>
                <?php
//                echo CHtml::dropDownList('search[cp_name]', $search['cp_name'], $cpName_data, array(
//                    'class' => 'width110 select',
//                    'empty' => '请选择品类',
//                ));
                ?>
            </p>
            <p class="form-row">
                  <label class="label2" style="margin-left:10px;">主营品类：</label>
                 <input id="cpname-select" name="cpname" class=" input width260" type="text" value="<?php echo $search['cpname']? $search['cpname'] : '请选择配件品类'; ?>" style="width:260px;">
               
                
                <label style="margin-left:10px;">显　　示：</label>
                <?php
                $deal = array(
                    '1' => '全部经销商',
                    '2' => '未授权经销商',
                    '3' => '授权经销商',
                );
                ?>
                <?php echo CHtml::dropDownList('search[payway]', $search['payway'], $deal, array('class' => 'width110 select')); ?>

                <input class="submit" id="submit" type='submit' value='查 询' style="margin-left:20px;"/>
            </p>
            <?php echo CHtml::endForm(); ?>
        </div>
    </div>
    <div style='height:5px'></div>
    <div class='block-shadow'></div>
</div>
<?php $this->widget("widgets.default.WGoodsMainCategoryModel"); ?>
<div class='width998 content content-rows'>
    <div class='postion pos-r'> <i class='icon-pos'></i>
        当前数据总量<span class='font-green'>(<?php echo $count; ?>)</span>
    </div>
    <div class='divers-f0'></div>
    <div class="checkbox-list">
        <?php if (!empty($dealers)): ?>
            <table cellspacing=0 cellpadding=0 >
                <thead>
                    <tr>
                        <td width=15>#</td>
                        <td width=120>机构名称</td>
                        <td width=120>机构地址</td>
                        <td width=90>经营地域</td>
                        <td width=80>联系方式</td>
                        <td width=120>主营品牌</td>
                        <td width=120>主营车系</td>
                        <td width=120>主营品类</td>
                    </tr>
                </thead>
                <tbody>
                    <?php $i = 1; ?>
                    <?php foreach ($dealers as $dealer): ?>
                        <tr>
                            <td><div class="number-col y-align-t display-ib"><span><?php echo $i; ?></span></div></td>
                            <td><?php echo CHtml::link($dealer['organName'], array('/maker/dealquery/detail/dealer/' . $dealer['userID']), array('target' => '_blank')) ?></td>
                            <td><?php Area::showCity($dealer['province']) . Area::showCity($dealer['city']) . Area::showCity($dealer['area']) ?><?php echo $dealer['address'] ?></td>
                            <td><?php echo Area::showCity($dealer['BusinessScope']) ?></td>
                            <td><?php echo $dealer['Phone'] ?></td>
                            <td><?php $data = DealerBrand::model()->findAll("OrganID = " . $dealer['userID']); ?>
                                <?php foreach ($data as $k => $datas): ?>
                                    <?php $brands .= $datas['BrandName'] ?>
                                    <?php if (isset($data[$k + 1])) $brands .= '、'; ?>
                                <?php endforeach; ?>
                                <?php
                                echo F::msubstr($brands);
                                $brands = '';
                                ?>
                            </td>
                            <td>
                                <?php
                                $dealerid = $dealer['userID'];
                                if (!empty($dealerid)) {
                                    $dealerv = DealerVehicle::model()->findAll('userid =' . $dealerid);
                                    ?>
                                    <?php if (!empty($dealerv)): ?>
                                        <?php foreach ($dealerv as $k => $showvehicle): ?>
                                            <?php
                                            $makeName = D::queryGoodsMakeInfo($showvehicle['businessMake']);
                                            $carsinfo .= $makeName['makeName'] . ' ';
                                            ?> <?php
                        $carinfo = D::queryGoodsSeriesInfo($showvehicle['businessCar']);
                        $carsinfo .= $carinfo['seriesName'] . ' ';
                                            ?><?php $carsinfo .= $showvehicle['businessYear'] ? $showvehicle['businessYear'] . ' ' : ''; ?>
                                            <?php
                                            $modelinfo = D::queryGoodsModelInfo($showvehicle['businessCarModel']);
                                            //  $carsinfo .= $modelinfo['modelName'];
                                            $carsinfo .=!empty($modelinfo['alias']) ? $modelinfo['modelName'] . '(' . $modelinfo['alias'] . ')' : $modelinfo['modelName'];
                                            ?>
                                            <?php if (isset($dealerv[$k + 1])) $carsinfo .= '、'; ?>
                                        <?php endforeach; ?>         
                                    <?php endif; ?>
                                    <?php
                                    echo F::msubstr($carsinfo, 0, 0);
                                    $carsinfo = '';
                                }
                                ?>
                            </td>
                            <td>
                                <?php
                                if (!empty($dealer['userID'])) {
                                    // $cpnames = DealerCpname::model()->findAll("OrganID = " . $dealer['userID']);   
                                    $cpnames = DealerCpname::model()->findAll("OrganID = " . $dealer['userID']);
                                    //var_dump($cpnames);
                                    $k = 1;
                                    foreach ($cpnames as $cpname) {
                                        if ($k == 1) {
                                            $cp .= $cpname['BigName'] . ' ' . $cpname['SubName'] . ' ' . $cpname['CpName'];
                                        } else {
                                            $cp .= ',' . $cpname['BigName'] . ' ' . $cpname['SubName'] . ' ' . $cpname['CpName'];
                                        }
                                        $k++;
                                    }
                                    echo F::msubstr($cp);
                                    $cp = '';
                                }
                                ?>
                            </td>
                            <!--<td><?php //echo CHtml::link('授权商品清单', array('/dealer/makequery/empgoods/dealer/' . $dealer['id']), array('target' => '_blank'))        ?></td>-->
                        </tr>
                        <?php $i++; ?>
                    <?php endforeach; ?>
                </tbody>
            </table>
        <?php else : ?>
            <center>
                <p>搜索到&nbsp;<font color=red>0</font>&nbsp;条数据 &nbsp;&nbsp;<span style="text-decoration: underline"><?php //echo CHtml::link('重新加载',array('dealquery/search'))    ?></span></p>
            </center>
        <?php endif; ?>
    </div>
    <div class="pagelist text-c">
        <?php if ($count > $pagesize): ?>
            <?php echo $page; ?>
            <span>
                去第
                <input id='thepage' class='input' value='1' style='width:20px' type='text'/>
                页
                <span id='gopage' class='btn-tiny'>GO</span>
            </span>
        <?php endif; ?>
    </div>
    <div style='height:120px'></div>
    <div class='block-shadow'></div>
</div>
<script type="text/javascript">
    $(document).ready(function(){
        var count= <?php echo $count; ?>;
        var pagesize= <?php echo $pagesize; ?>;
        count = Math.ceil(count/pagesize);
        $("#thepage").keyup(function(){
            var thisval = $(this).val();
            if(thisval<1){
                $(this).val('1');
            }else if(isNaN(thisval)){
                $(this).val('1');         
            }else if(thisval>=count){
                $(this).val(count);
            }else if(!isNaN(thisval)){
                var reg =  /^\+?[1-9][0-9]*$/;　　//正整数 
                if(!reg.test(thisval)){
                    $(this).val(1);
                }
            }
        });
//        $("#submit").click(function(){
//            if($("#leafCategory").val()){
//                $("#category").val($("#leafCategory option:selected").text());
//            }else{
//                $("#category").val('');
//            }
////            $("#querymake").submit();
//        });
        // 跳转到第几页
        $("#gopage").click(function(){
            var url = "<?php echo Yii::app()->createUrl('maker/dealquery/search'); ?>";
            var page = $("#thepage").val();
            if(isNaN(page))
            {
                alert('请输入阿拉伯数字 !');
                $("#thepage").val('');
            }else{
                location.href=url+"?page="+page;
            }
        }).css('cursor','pointer');
    })
</script>