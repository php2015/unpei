<?php
$this->pageTitle = Yii::app()->name . ' - ' . "经销商查询";
?>
<div class='width998 content'>
    <?php include 'tabs_active.php'; ?>
    <!-- 经销商 -->
    <div class=''>
        <div id="tab1" class="form-list">
            <?php echo CHtml::beginForm(Yii::app()->createUrl('dealer/makequery/dealersearch'), 'get'); ?>
            <!--begin-->
            <div style="height:80px; margin-top:10px;">
                <div class="edf">

                    <div class="ccc">
                        <div class="aaa">关键词：</div>
                        <div style="float:left;">
                            <?php if (!empty($search['keyword'])): ?>
                                <?php echo CHtml::textField('keyword', $search['keyword'], array('class' => "width230 input", 'flag' => 2)); ?>
                            <?php else : ?>
                                <?php echo CHtml::textField('keyword', "OE号/商品名称/商品品牌", array('class' => "width225 input", 'flag' => 1, 'style' => 'color:rgb(153,153,153)', 'fuc' => 's')); ?>
                            <?php endif; ?>
                        </div>
                        <div style="clear:both"></div>
                    </div>
                    <div class="ccc">
                        <div class="aaa">地区：</div>
                        <div style="float:left">
                            <?php
                            $province_data = Area::model()->findAll("grade=:grade", array(":grade" => 1));
                            $province = CHtml::listData($province_data, "id", "name");
                            ?>
                            <?php
                            echo CHtml::dropDownList('dprovince', $search['province'], $province, array(
                                'class' => 'width118 select',
                                'empty' => '请选择省',
                                'ajax' => array(
                                    'type' => 'GET', //request type
                                    'url' => Yii::app()->request->baseUrl . '/common/dynamiccity', //url to call
                                    'update' => '#dcity', //selector to update
                                    'data' => 'js:"province="+jQuery(this).val()',
                                )
                            ));
                            if ($search['province']) {
                                $city_data = Area::model()->findAll("parent_id=:parent_id", array(":parent_id" => $search['province']));
                                $city = CHtml::listData($city_data, "id", "name");
                            }
                            $city_update = $search['province'] ? $city : array();
                            echo CHtml::dropDownList('dcity', $search['city'], $city_update, array(
                                'class' => 'width118 select',
                                'empty' => '请选择市',
                            ));
                            ?>
                        </div>
                        <div style="clear:both"></div>
                    </div>
                </div>
                <div class="edf bbb">
                    <div class="ccc">
                        <div class="aaa">主营车系：</div>
                        <div style="float:left;">
                            <!-- <?php
//                            $this->widget('widgets.default.WGoodsModel', array('scope' => 'epc',
//                            'make' => $search['make'], 'series' => $search['series'], 'year' => $search['year'], 'model' => $search['model'],
//                            'notlink' => 'N'));
                            ?> -->
                            <input id="make-select" name="makecar" class="input " type="text" value="<?php echo $search['makecar'] ? $search['makecar'] : '请选择适用车系'; ?>" style="width:260px"><br> 
                        </div>
                        <div style="clear:both"></div>
                    </div>
                    <div class="ccc">
                        <div class="aaa">主营品类：</div>
                        <div style="float:left">
                            <input id="cpname-select" name="cpname" class=" input width260" type="text" value="<?php echo $search['cpname'] ? $search['cpname'] : '请选择配件品类'; ?>" style="width:260px;">
                            <?php
//                            $this->widget("widgets.default.WGcategory", array("scope" => "dealer",
//                            'mainCategory' => $search['mainCategory'], 'subCategory' => $search['subCategory'], 'leafCategory' => $search['leafCategory'],'notlink'=>'N'
//                            ));
                            ?>
                            <input type="hidden" value="<?php echo $search['mainCategory'] ?>" name="jpmall_maincate"  id="jpmall_maincate"/>
                            <input type="hidden" value="<?php echo $search['subCategory'] ?>" name="jpmall_subcate" id="jpmall_subcate"/>
                            <input type="hidden" value="<?php echo $search['leafCategory'] ?>" name="jpmall_cpname" id="jpmall_cpname"/>
                            <input name="maincategory" type="hidden" value="<?php echo $search['maincategory']; ?>">
                            <input name="subcategory" type="hidden" value="<?php echo $search['subcategory']; ?>">
                            <input name="cpnamecategory" type="hidden" value="<?php echo $search['category']; ?>">
                            <!--                 适用车系-->
                            <input type="hidden" name="select_make" id="select_make" value="<?php echo $search['jpmall_make'] ?>">
                            <input type="hidden" name="select_series" id="select_series" value="<?php echo $search['jpmall_series'] ?>">
                            <input type="hidden" name="select_year" id="select_year" value="<?php echo $search['jpmall_year'] ?>">
                            <input type="hidden" name="select_model" id="select_model" value="<?php echo $search['jpmall_model'] ?>">
                            <input type = "hidden" name = "category" value = "">
                            <input type = "hidden" name = 'is' value = 'true'>
                            <input class = "submit" type = 'submit' name = 'search' id="search" value = '查 询' style = "margin-left:20px;"/>

                        </div>
                        <div style="clear:both"></div>
                    </div>

                </div>
                <div style="clear:both"></div>
            </div>
            <!--end-->


            <?php echo CHtml::endForm(); ?>
        </div>
    </div>
    <div style='height:5px'></div>
    <div class='block-shadow'></div>
</div>
<?php $this->widget('widgets.default.WGoodsCarModel'); ?>
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
                        <td width=80>联系方式</td>
                        <td width=120>主营品牌</td>
                        <td width=120>主营车系</td>
                        <td width=120>主营品类</td>
                        <!--<td width=80>商品清单</td>-->
                    </tr>
                </thead>
                <tbody>

                    <?php $i = 1; ?>
                    <?php foreach ($dealers as $dealer): ?>
                        <tr>
                            <td><div class="number-col y-align-t display-ib"><span><?php echo $i; ?></span></div></td>
                            <td><?php echo CHtml::link($dealer['organName'], array('/dealer/makequery/detail/dealer/' . $dealer['userID']), array('target' => '_blank')) ?></td>
                            <td><?php Area::showCity($dealer['province']) . Area::showCity($dealer['city']) . Area::showCity($dealer['area']) ?><?php echo $dealer['address'] ?></td>
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
                            <!--<td><?php //echo CHtml::link('授权商品清单', array('/dealer/makequery/empgoods/dealer/' . $dealer['id']), array('target' => '_blank'))          ?></td>-->
                        </tr>
                        <?php $i++; ?>
                    <?php endforeach; ?>
                </tbody>
            </table>
        <?php else : ?>
            <center>
                <p>搜索到&nbsp;<font color=red>0</font>&nbsp;条数据 &nbsp;&nbsp;<span style="text-decoration: underline"><?php // echo CHtml::link('重新加载',array('/dealer/makequery/dealersearch'))         ?></span></p>
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

<script>
    //给适用车系赋值
    $("#search").click(function(){
        $("#select_make").val( $("#jpmall_make").val());
        $("#select_series").val($("#jpmall_series").val());
        $("#select_year").val($("#jpmall_year").val());
        $("#select_model").val($("#jpmall_model").val());
    })
    $(function(){
        //        $("#mainCategorydealer").change(function(){
        //            $("#subCategorydealer").change();
        //        });
        //        
        //        $("input[name = search]").click(function(){
        //            //查询主营品类
        //            var category = $("#leafCategorydealer option[value='"+$("#leafCategorydealer").val()+"']").text();
        //            $("input[name=category]").val(category);
        //            //查询主营车系
        //            var make = $("#jpmall_make").val();
        //            var series = $("#jpmall_series").val();
        //            var year = $("#jpmall_year").val();
        //            var model = $("#jpmall_model").val();
        //            $("input[name=make]").val(make);
        //            $("input[name=series]").val(series);
        //            $("input[name=year]").val(year);
        //            $("input[name=model]").val(model);
        //        })
        //        $("#keyword").click(function(){
        //            $(this).select();
        //        });
        //        var count = eval($("#count").text());
        //        count = Math.ceil(count/5);
        //        $("#thepage").keyup(function(){
        //            //alert(123);
        //            var thisval = $(this).val();
        //            if(thisval<1)
        //                $(this).val('1');
        //            else if(isNaN(thisval))
        //                $(this).val('1');
        //            else if(thisval>=count)
        //                $(this).val(count);
        //        });
        //
        //        // 跳转到第几页
        //        $("#gopage").click(function(){
        //            var url = "<?php echo Yii::app()->createUrl('dealer/makequery/dealersearch'); ?>";
        //            var page = $("#thepage").val();
        //            //var page = parseInt(page);
        //            if(isNaN(page))
        //            {
        //                alert('请输入阿拉伯数字 !');
        //                $("#thepage").val('');
        //            }else{
        //                location.href = url+"?page="+page;
        //            }
        //        }).css('cursor', 'pointer');
    });
</script>