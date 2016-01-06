<style>
    .float-m{
        float:left;   margin-left:10px;
    }
    .h400{height:350px}
    .btn{margin-top:8px;}
</style>
<?php $this->pageTitle = Yii::app()->name . ' - 修理厂查询'; ?>
<div class='width998 content_row'>
    <div class='jgcx'>
        <div class='page-title'>
            <div class='xlc-title'><?php echo $model['serviceName'] ?></div>
        </div>
        <div class='page-tel bg-white'> <i class='icon-tel'></i>
            <span class='number' style="width:150px;"><?php echo $model['serviceTelePhone'] ?></span>
        </div>
    </div>
    <div class='auto_height jgcx info content-rows15'>
        <div style="width: 600px; height:auto; min-height:375px; _height:375px; float:left; background: white">
            <div class="title title-dashed">
                基础信息 <i class='icon-arr2r-white display-ib'></i>
            </div>
            <div class='info-list'>
                <table >
                    <tr>
                        <td width="70">机构名称：</td>
                        <td colspan="3"><?php echo $model['serviceName']; ?></td>
                    </tr>
                    <tr>
                        <td>嘉 配 ID：</td>
                        <td colspan="3"><?php echo $model['serviceCellPhone']; ?></td>
                    </tr>
                    <tr>
                        <td>企业类型：</td>
                        <td colspan="3"><?php echo Companytype::Identity($model[userId]); ?></td>
                    </tr>
                    <tr>
                        <td>成立年份：</td>
                        <td width="200"><?php echo $model['serviceFounded']; ?>年</td>
                        <td width="70">工 位 数：</td>
                        <td><?php echo $model['servicePositionCount']; ?></td>
                    </tr>
                    <tr>
                        <td>技师人数：</td>
                        <td><?php echo $model['serviceTechnicianCount']; ?>人</td>
                        <td>停车位数：</td>
                        <td><?php echo $model['serviceParkingDigits']; ?></td>
                    </tr>
                    <tr>
                        <td>店铺面积：</td>
                        <td><?php echo $model['serviceStoreSize']; ?></td>
                        <td>预约模式：</td>
                        <td><?php
if ($model['serviceReservationMode'] == "1"): echo "需要担保";
else: echo "不需要担保";
endif;
?></td>
                    </tr>
                    <tr>
                        <td>营业时间：</td>
                        <td colspan="3"><?php $serviceOpenTime = explode(',', $model->serviceOpenTime); //营业时间         ?>
                            <?php echo $serviceOpenTime[0] . "至" . $serviceOpenTime[1] . "（" . $serviceOpenTime[2] . "-" . $serviceOpenTime[3] . "）"; ?></td>
                    </tr>
                    <tr>
                        <td>经营地域：</td>
                        <td colspan="3"><?php echo Area::showCity($model['serviceRegionProvince']) . Area::showCity($model['serviceRegionCity']) . Area::showCity($model['serviceRegionArea']); ?></td>
                    </tr>
                    <tr>
                        <td>机构介绍：</td>
                        <td colspan="3"><?php echo $model['serviceIntro']; ?></td>
                    </tr>
                </table>
            </div>
        </div>
        <?php if (empty($employs)): ?>
            <div class='right-side float-m bg-white' style="height:auto; min-height:375px; _height:375px; width:386px">
                <div class="title title-dashed">
                    联系方式
                    <i class='icon-arr2r-white display-ib'></i>
                </div>
                <div class='info-list'>
                    <span>联 系 人：</span>
                    <?php echo $model['serviceContact']; ?>
                    <br> 	
                    <span>手　　机：</span>
                    <?php echo $model['serviceCellPhone']; ?>
                    <br>
                    <span>固定电话：</span>
                    <?php echo $model['serviceTelePhone']; ?>
                    <br>
                    <span>QQ 号 码：</span>
                    <?php echo $model['serviceQQ']; ?>
                    <br>
                    <span>邮　　箱：</span>
                    <?php echo $model['serviceEmail']; ?>
                    <br>
                    <span>地　　址：</span>
                    <?php echo Area::showCity($model['serviceProvince']) . Area::showCity($model['serviceCity']) . Area::showCity($model['serviceArea']) . $model['serviceAddress']; ?>
                </div>
            </div>
        <?php else: ?>
            <div class='right-side float-m bg-white' style="height:auto; min-height:150px; _height:150px; width:386px">
                <div class="title title-dashed">
                    联系方式
                    <i class='icon-arr2r-white display-ib'></i>
                </div>
                <div class='info-list'>
                    <table >
                        <tr>
                            <td width="70" style="float:right">联 系 人：</td>
                            <td width="100"><?php echo $model['serviceContact']; ?></td>
                            <td width="70">手　　机：</td>
                            <td><?php echo $model['serviceCellPhone']; ?></td>
                        </tr>
                        <tr>
                            <td>固定电话：</td>
                            <td width="100"><?php echo $model['serviceTelePhone']; ?></td>
                            <td width="70">QQ 号 码：</td>
                            <td><?php echo $model['serviceQQ']; ?></td>
                        </tr>
                        <tr>
                            <td>邮　　箱：</td>
                            <td width="100"><?php echo $model['serviceEmail']; ?></td>
                        </tr>
                        <tr>
                            <td>地　　址：</td>
                            <td colspan="3"><?php echo Area::showCity($model['serviceProvince']) . Area::showCity($model['serviceCity']) . Area::showCity($model['serviceArea']) . $model['serviceAddress']; ?></td>
                        </tr>
                    </table>
                </div>
            </div>
            <div class='right-side float-m bg-white' style="height:auto; min-height:200px; _height:200px; width:386px;margin-top: 10px">
                <div class="title title-dashed">
                    员工信息
                    <i class='icon-arr2r-white display-ib'></i>
                </div>
                <div class='info-list'>
                    <table >
                        <?php foreach ($employs as $key => $val): ?>
                            <tr>
                                <td width="70" style="float:right">员工姓名：</td>
                                <td width="100"><?php echo $val['truename']; ?></td>
                                <td width="70">联系电话：</td>
                                <td><?php echo $val['phone']; ?></td>
                            </tr>
                        <?php endforeach; ?>
                    </table>
                </div>
            </div>
        <?php endif; ?>
    </div>
    <div class='jgcx content-rows15 bg-white' style="margin-bottom: 15px;line-height: 2em;padding: 10px">
        <div class="title title-dashed">
            主营信息
            <i class='icon-arr2r-white display-ib'></i>
        </div>
        <div class='info-list' style="padding: 10px;">
            <span><strong>机构类型：</strong></span>
            <?php
            switch ($main['OrganType']) {
                case '1': echo "快修店";
                    break;
                case '2': echo "美容店";
                    break;
                case '3': echo "车系专修厂";
                    break;
                case '4': echo "全修厂";
                    break;
            }
            ?>
            <br>
            <span><strong>服务类别：</strong></span>
            <br>
            <?php if (!empty($main['DeepClean'])) { ?>
                <span style="margin-left:30px;">&nbsp;深度清洁:</span>
                <?php echo $main['DeepClean']; ?>
                <br>
            <?php } ?>
            <?php if (!empty($main['CarBeauty'])) { ?>
                <span style="margin-left:30px;">&nbsp;车辆美容：</span>
                <?php echo $main['CarBeauty']; ?>
                <br>
            <?php } ?>
            <?php if (!empty($main['RouMain'])) { ?>
                <div class="form-row" style="margin-left: 30px; clear: both; overflow: auto;">
                    <div style=" width: 65px;float: left;padding-top: 3px;">&nbsp;日常保养:</div>
                    <div style=" margin-left: 65px; line-height: 20px;">
                        <?php
                        if ($main['RouMain'] == "全车系") {
                            echo $main['RouMain'];
                        } else {
                            if ($routine):
                                foreach ($routine as $rou):
                                    echo $rou['Make'] . ":" . $rou['Car'] . "&nbsp;&nbsp;&nbsp;&nbsp;";
                                endforeach;
                            endif;
                        }
                        ?></div>
                </div>
            <?php } ?>
            <?php if (!empty($main['Diagnos'])) { ?>
                <div class="form-row" style="margin-left: 30px; clear: both; overflow: auto;">
                    <div style=" width: 65px;float: left;padding-top: 3px;">&nbsp;检查诊断:</div>
                    <div style=" margin-left: 65px; line-height: 20px;">
                        <?php
                        if ($main['Diagnos'] == "全车系") {
                            echo $main['Diagnos'];
                        } else {
                            if ($diagno):
                                foreach ($diagno as $dia):
                                    echo $dia['Make'] . ":" . $dia['Car'] . "&nbsp;&nbsp;&nbsp;&nbsp;";
                                endforeach;
                            endif;
                        }
                        ?></div>
                </div>
            <?php } ?>
            <?php if (!empty($main['WearParts'])) { ?>
                <div class="form-row" style="margin-left: 30px; clear: both; overflow:auto; ">
                    <div style="width: 67px;float:left; padding-top: 3px; ">易损件更换:</div>
                    <div style="line-height: 20px;  margin-left: 68px ">
                        <?php
                        $Wearpart = explode(',', $main['WearParts']);
                        $Category = implode(array_splice($Wearpart, 1), ',');
                        if ($Wearpart[0] == "全车系") {
                            if ($Category) {
                                echo $Category . " | ";
                            }
                            echo $Wearpart[0];
                        } else {
                            if ($Category) {
                                echo $Category . " | ";
                            }
                            if ($part):
                                foreach ($part as $par):
                                    echo $par['Make'] . ":" . $par['Car'] . "&nbsp;&nbsp;&nbsp;&nbsp;";
                                endforeach;
                            endif;
                        }
                        ?></div>
                </div>
            <?php } ?>
            <?php if (!empty($main['ProRepair'])) { ?>
                <div class="form-row" style="margin-left: 30px; clear: both; overflow:auto; ">
                    <div style="width: 67px;float:left; padding-top: 3px; ">&nbsp;专业修理:</div>
                    <div style="line-height: 20px;  margin-left: 68px ">
                        <?php
                        $Prorepair = explode(',', $main['ProRepair']);
                        $Range = implode(array_splice($Prorepair, 1), ',');
                        if ($Prorepair[0] == "全车系") {
                            if ($Range) {
                                echo $Range . " | ";
                            }
                            echo $Prorepair[0];
                        } else {
                            if ($Range) {
                                echo $Range . " | ";
                            }
                            if ($repair):
                                foreach ($repair as $rep):
                                    echo $rep['Make'] . ":" . $rep['Car'] . "&nbsp;&nbsp;&nbsp;&nbsp;";
                                endforeach;
                            endif;
                        }
                        ?></div>
                </div>
            <?php } ?>
            <?php if (!empty($main['AutoService'])) { ?>
                <div class="form-row" style="margin-left: 30px; clear: both; overflow:auto; ">
                    <div style="width: 67px;float:left; padding-top: 3px; ">&nbsp;车险服务:</div>
                    <div style="line-height: 20px;  margin-left: 68px ">
                        <?php
                        $Autoservice = explode(',', $main['AutoService']);
                        $Name = implode(array_splice($Autoservice, 1), ',');
                        echo $Autoservice[0] . " | ";
                        if ($Name) {
                            echo $Name;
                        }
                        ?></div>
                </div>
            <?php } ?>
        </div>
    </div>
    <div class='jgcx photos content-rows15 bg-white'>
        <div class='title'>&nbsp;&nbsp;机构照片</div>
        <div class='pos-r'>
            <a href='javascript:;' class="arr-l scroll-left"></a>
            <div class="photos-list">
                <ul>
                    <?php if (!empty($photo)): ?>
                        <?php foreach ($photo as $value): ?>
                            <li><?php $src = F::uploadUrl() . $value['photoName']; ?>
                                <a href="#"><img src="<?php echo $src ?>"></a>
                                <!--<div class='text-c mt1em'><a href="#">说明文字</a></div>-->
                            </li>
                        <?php endforeach; ?>
                    <?php endif; ?>
                </ul>
            </div>
            <a href='javascript:;' class="arr-r scroll-right"></a>
        </div>
    </div>
</div>
<script>
    $(document).ready(function(){
        $("table tbody tr").removeClass("bg-green-light");
        $("table tbody tr").live({
            mouseout: function() {
                $(this).removeClass("tr-hover");
            },
            mouseover: function() {
                $(this).removeClass("tr-hover");
            }
        });
    })
</script>