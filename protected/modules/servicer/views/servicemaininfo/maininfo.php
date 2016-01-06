<div>
    <div class="tabs">
        <a class="left-indent">&nbsp;</a>
        <a href="<?php echo Yii::app()->createUrl("servicer/servicemaininfo/index"); ?>">服务报价列表</a>
        <a href="<?php echo Yii::app()->createUrl("servicer/servicemaininfo/business"); ?>" class="active">主营类别管理</a>
    </div>
    <div class="dttable" style="margin:30px 25px;">
        <p class="form-row" style="height:25px;">
            <label class="label"><strong>&nbsp;机构类型:</strong></label>
            <label class="label">
                <?php
                switch ($model['OrganType']) {
                    case '1': echo "快修店";
                        break;
                    case '2': echo "美容店";
                        break;
                    case '3': echo "车系专修厂";
                        break;
                    case '4': echo "全修厂";
                        break;
                }
                ?></label>
        </p>
        <p class="form-row" style="height:25px;">
            <label class="label"><strong>&nbsp;服务类别:</strong></label>
        </p>
        <?php if (!empty($model['DeepClean'])) { ?>
            <p class="form-row" style="margin-left: 30px;">
                <label class="label">&nbsp;深度清洁:</label>
                <label class="label"><?php echo $model['DeepClean']; ?></label>
            </p>
        <?php } ?>
        <?php if (!empty($model['CarBeauty'])) { ?>
            <p class="form-row" style="margin-left: 30px;">
                <label class="label">&nbsp;车辆美容:</label>
                <label class="label"><?php echo $model['CarBeauty']; ?></label>
            </p>
        <?php } ?>
        <?php if (!empty($model['RouMain'])) { ?>
            <div class="form-row" style="margin-left: 30px; clear: both; overflow: auto;">
                <div style=" width: 65px;float: left;padding-top: 3px;">&nbsp;日常保养:</div>
                <div style=" margin-left: 65px; line-height: 20px;">
                    <?php
                    if ($model['RouMain'] == "全车系") {
                        echo $model['RouMain'];
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
        <?php if (!empty($model['Diagnos'])) { ?>
            <div class="form-row" style="margin-left: 30px; clear: both; overflow: auto;">
                <div style=" width: 65px;float: left;padding-top: 3px;">&nbsp;检查诊断:</div>
                <div style=" margin-left: 65px; line-height: 20px;">
                    <?php
                    if ($model['Diagnos'] == "全车系") {
                        echo $model['Diagnos'];
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
        <?php if (!empty($model['WearParts'])) { ?>
            <div class="form-row" style="margin-left: 30px; clear: both; overflow:auto; ">
                <div style="width: 67px;float:left; padding-top: 3px; ">易损件更换:</div>
                <div style="line-height: 20px;  margin-left: 68px ">
                    <?php
                    $Wearpart = explode(',', $model['WearParts']);
                    $Category = implode(array_splice($Wearpart, 1), ',');
                    if ($Wearpart[0] == "全车系") {
                        if (empty($Category) && $Wearpart[0]) {
                            echo $Wearpart[0];
                        }
                        if ($Category && $Wearpart[0]) {
                            echo $Category . " | " . $Wearpart[0];
                        }
                    } else {
                        if ($Category && empty($part)) {
                            echo $Category;
                        } elseif (empty($Category) && $part) {
                            foreach ($part as $par) {
                                echo $par['Make'] . ":" . $par['Car'] . "&nbsp;&nbsp;&nbsp;&nbsp;";
                            }
                        } elseif ($Category && $part) {
                            foreach ($part as $par) {
                                echo $Category . " | " . $par['Make'] . ":" . $par['Car'] . "&nbsp;&nbsp;&nbsp;&nbsp;";
                            }
                        }
                    }
                    ?>
                </div>
            </div>
        <?php } ?>
        <?php if (!empty($model['ProRepair'])) { ?>
            <div class="form-row" style="margin-left: 30px; clear: both; overflow:auto; ">
                <div style="width: 67px;float:left; padding-top: 3px; ">&nbsp;专业修理:</div>
                <div style="line-height: 20px;  margin-left: 68px ">
                    <?php
                    $Prorepair = explode(',', $model['ProRepair']);
                    $Range = implode(array_splice($Prorepair, 1), ',');
                    if ($Prorepair[0] == "全车系") {
                        if (empty($Range) && $Prorepair[0]) {
                            echo $Prorepair[0];
                        }
                        if ($Range && $Prorepair[0]) {
                            echo $Range . " | " . $Prorepair[0];
                        }
                    } else {
                        if ($Range && empty($repair)) {
                            echo $Range;
                        } elseif (empty($Range) && $repair) {
                            foreach ($repair as $rep) {
                                echo $rep['Make'] . ":" . $rep['Car'] . "&nbsp;&nbsp;&nbsp;&nbsp;";
                            }
                        } elseif ($Range && $repair) {
                            foreach ($repair as $rep) {
                                echo $Range . " | " . $rep['Make'] . ":" . $rep['Car'] . "&nbsp;&nbsp;&nbsp;&nbsp;";
                            }
                        }
                    }
                    ?></div>
            </div>
        <?php } ?>
        <?php if (!empty($model['AutoService'])) { ?>
            <div class="form-row" style="margin-left: 30px; clear: both; overflow:auto; ">
                <div style="width: 67px;float:left; padding-top: 3px; ">&nbsp;车险服务:</div>
                <div style="line-height: 20px;  margin-left: 68px ">
                    <?php
                    $Autoservice = explode(',', $model['AutoService']);
                    $Name = implode(array_splice($Autoservice, 1), ',');
                    if ($Autoservice[0] && empty($Name)) {
                        echo $Autoservice[0];
                    } elseif (empty($Autoservice[0]) && $Name) {
                        echo $Autoservice[0] . " | " . $Name;
                    } elseif ($Autoservice[0] && $Name) {
                        echo $Autoservice[0] . " | " . $Name;
                    }
                    ?></div>
            </div>
        <?php } ?>
        <p class="form-row" style="height:30px;">
            <?php if (empty($model)): ?>
                <a class='btn' href="<?php echo Yii::app()->createUrl('servicer/servicemaininfo/business'); ?>" style="margin-left: 95px;">添加</a>
            <?php else: ?>
                <a class='btn' href="<?php echo Yii::app()->createUrl('servicer/servicemaininfo/business'); ?>" style="margin-left: 95px;">修改</a>
            <?php endif; ?>
        </p>   
    </div>
</div>
