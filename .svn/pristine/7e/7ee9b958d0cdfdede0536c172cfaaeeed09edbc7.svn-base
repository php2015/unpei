

<div class='width998 content'>
    <?php include 'tabs_active.php'; ?>
    <div>
        <!-- 经销商 -->
        <div id="tab1" class="form-list">
            <?php echo CHtml::beginForm('index', 'get', array('id' => "querymake")); ?>
            <div style="height:80px; margin-top:10px;">
                <div class="edf">

                    <div class="ccc">
                        <div class="aaa"><label>经营品牌：</label></div>
                        <div style="float:left;"> <?php echo CHtml::textField('keywords', $search['keywords'], array('class' => 'width260 input', 'func' => 's')); ?></div>
                        <div style="clear:both"></div>
                    </div>
                    <div class="ccc">
                        <div class="aaa"><label>地区：</label></div>
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
                        <div class="aaa"><label>经营品类：</label></div>
                        <div style="float:left;">
                            <input id="cpname-select" name="cpname" class=" input width260" type="text" value="<?php echo $search['cpname'] ?>" style="width:260px;">
                            <?php
//                            $this->widget("widgets.default.WGcategory", array(
//                                'mainCategory' => $search['mainCategory'],
//                                'subCategory' => $search['subCategory'],
//                                'leafCategory' => $search['leafCategory']
//                            ));
                            ?>
                            <input type="hidden" value="<?php echo $jpmall_maincate ?>" name="jpmall_maincate"  id="jpmall_maincate"/>
                            <input type="hidden" value="<?php echo $jpmall_subcate ?>" name="jpmall_subcate" id="jpmall_subcate"/>
                            <input type="hidden" value="<?php echo $jpmall_cpname ?>" name="jpmall_cpname" id="jpmall_cpname"/>
                            <input name="maincategory" type="hidden" value="<?php echo $search['maincategory']; ?>">
                            <input name="subcategory" type="hidden" value="<?php echo $search['subcategory']; ?>">
                            <input name="cpnamecategory" type="hidden" value="<?php echo $search['category']; ?>">
                        </div>
                        <div style="clear:both"></div>
                    </div>
                    <div class="ccc">
                        <div class="aaa"> <label>显示：</label></div>
                        <div style="float:left">
                            <?php
                            $deal = array(
                                '1' => '全部生产商',
                                '2' => '未获授权的生产商',
                                '3' => '已获授权的生产商',
                            );
                            ?>
                            <?php echo CHtml::dropDownList('payway', $search['payway'], $deal, array('class' => 'width100 select')); ?>

                            <input type="submit" value="查 询" id="submit" class="submit" style="margin-left: 20px;">

                        </div>
                        <div style="clear:both"></div>
                    </div>

                </div>
                <div style="clear:both"></div>
            </div>
            <?php echo CHtml::endForm(); ?>

        </div>

    </div>
    <div style='height:5px'></div>
    <div class='block-shadow'></div>
</div>
<?php $this->widget("widgets.default.WGoodsMainCategoryModel"); ?>
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
                                    <td width=10>#</td>
                                    <td width=120>品牌厂家名称</td>
                                    <td width=70>成立年份</td>
                                    <td width=60>年销售额</td>
                                    <td width=120>经营品牌</td>
                                    <td width=130>经营车系</td>
                                    <td width=130>经营品类</td>
                                    <td width=70>联系方式</td>
                                    <td width=110>地址</td>
<!--                                    <td width=70>商品清单</td>-->
                                </tr>
                            </thead>
                            <tbody>
                                <!-- 品牌厂家查询 -->
                                <?php
                                $i = 1;
                                foreach ($models as $model):
                                    ?>
                                    <tr>
                                        <td ><?php echo $i ?></td>
                                        <td ><a  target="_blank" title="<?php echo $model['name'] ?>" href='<?php echo Yii::app()->createUrl("dealer/makequery/indexdetail/maker_id/" . $model['userID']) ?>'><?php echo $model['name'] ?></a></td>
                                        <td ><?php echo $model['establish_year']; ?>年成立</td>
                                        <td ><?php echo '￥     ' . $model['year_sales_volume']; ?></td>
                                        <td><?php echo F::msubstr(MakeGoodsBrand::getBrands($model['userID'])) ?></td>
                                        <td>
                                            <?php
                                            //echo $model['userID'];
                                            $cars = MakeOrganCarRelation::model()->findAll('userID =' . $model['userID']);
                                            $k = 1;
                                            foreach ($cars AS $car) {
                                                if ($k == 1) {
                                                    $makecar .= TransportMake::getMake($car['makeCode']) . ' ' . TransportCar::getCar($car['carCode']);
                                                } else {
                                                    $makecar .= ',' . TransportMake::getMake($car['makeCode']) . ' ' . TransportCar::getCar($car['carCode']);
                                                }
                                                $k++;
                                            }
                                            echo F::msubstr($makecar);
                                            $makecar = '';
                                            ?>
                                        </td>
                                        <td>
                                        <?php
                                            if (!empty($model['userID'])) {
                                                // $cpnames = DealerCpname::model()->findAll("OrganID = " . $dealer['userID']);   
                                                $cpnames = DealerCpname::model()->findAll("OrganID = " . $model['userID']);
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
                                        <td ><?php echo $model['mobile_phone']; ?> <?php echo $model['contactName']; ?></td>
                                        <td ><?php
                                    Area::showCity($model['province']);
                                    Area::showCity($model['city']);
                                    Area::showCity($model['area']);
                                    echo $model['address']
                                            ?></td>
<!--                                        <td ><a target="_blank" href='<?php //echo Yii::app()->createUrl("dealer/makequery/shouqgoods/maker_id/" . $model['userID']) ?>'>商品清单</a></td>-->
                                    </tr>
                                    <?php
                                    $i++;
                                endforeach;
                                ?>
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
            <p>搜索到   <font color=red>0</font> 条数据<?php // echo CHtml::link('重新加载',array('makequery/index'))      ?></p>
        </center>
    <?php endif; ?>
    <div style='height:120px'></div>
    <div class='block-shadow'></div>
</div>
<script>
    $(function(){
        
        $("#mainCategory").change(function(){
            $("#subCategory").change();
        });
        //alert(count);
        $("#keywords").click(function(){
            $(this).select();
        });
        var count= eval($("#count").text());
        count = Math.ceil(count/5);
        $("#thepage").keyup(function(){
            //alert(123);
            var thisval = $(this).val();
            if(thisval<1)
                $(this).val('1');
            else if(isNaN(thisval))
                $(this).val('1');
            else if(thisval>=count)
                $(this).val(count);
        });
        //        $("#submit").click(function(){
        //            if($("#leafCategory").val()){
        //                $("input[name=category]").val($("#leafCategory option:selected").text());
        //            }else{
        //                $("input[name=category]").val('');
        //            }
        //            //            $("#querymake").submit();
        //        });
        // 跳转到第几页
        $("#gopage").click(function(){
            var url = "<?php echo Yii::app()->createUrl('dealer/makequery/index'); ?>";
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
    })
</script>