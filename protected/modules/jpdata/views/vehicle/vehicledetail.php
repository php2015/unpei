<style>
    .arguments2{
        border: 1px solid #cfcfcf;
        color: #666666;
        margin-left: 9px;
        overflow: hidden;
        padding: 9px;
    }
    .arguments2 span {
        color: #4e4242;
        font-size: 15px;
        font-weight: bold;
        margin-left: 15px;
    }
    .arguments2 .all_arg li {
        line-height: 20px;
        word-wrap: break-word;
    }
    .vehicle_detail .details{ height:auto!important}
</style>
<div id="vehicledetail-content" style="margin-top:0px;">
    <div class="vehicle_detail">
        <div class="details">
            <div class="imgs">
                <?php
                if ($modelPics && count($modelPics) > 0) {
                    $this->renderPartial('imagesgallery', array('pictures' => $modelPics));
                } else {
                    ?>
                    <div>暂无图片</div>
                    <?php
                }
                ?>
            </div>
            <div style="float:left;width: 42%;">
                <div class="arguments2">
                    <span>车型参数</span>
                    <input type="hidden" id="makeId" value="<?php echo $modelParams['makeId']; ?>">
                    <input type="hidden" id="seriesId" value="<?php echo $modelParams['seriesId']; ?>">
                    <input type="hidden" id="yearId" value="<?php echo $modelParams['yearId']; ?>">
                    <input type="hidden" id="modelId" value="<?php echo $modelParams['modelId']; ?>">
                    <ul class="all_arg">
                        <li>车型编码：<?php echo $modelParams['modelCode']; ?></li>
                        <li>生产厂家：<?php echo $modelParams['makeName']; ?></li>
                        <li>车系名称：<?php echo $modelParams['seriesName']; ?></li>
                        <li>年款：<?php echo $modelParams['yearId'].'款'; ?></li>
                        <li>车型名称：<?php echo $modelParams['modelName']; ?></li>
                        <li>车型代码：<?php echo $modelParams['modelCode']; ?></li>
                        <li>发动机排量（ml）：<?php echo $modelParams['engineCapacity']; ?></li>
                        <li>吸气方式：<?php echo $modelParams['aspiration']; ?></li>
                        <li>变速箱：<?php echo $modelParams['gearbox']; ?></li>
                        <li>变速箱档位数（档）：<?php echo $modelParams['gearboxStalls']; ?></li>
                        <li>车身形式：<?php echo $modelParams['bodyForm']; ?></li>
                        <li>前轮胎规格：<?php echo $modelParams['frontTiresWidth']; ?></li>
                        <li>后轮胎规格：<?php echo $modelParams['rearTiresWidth']; ?></li>
                        <li>天窗：<?php echo $modelParams['skylight']; ?></li>
                        <li>车身颜色：<?php echo $modelParams['bodyColor']; ?></li>
                        <li>座椅材质：<?php echo $modelParams['seatMaterial']; ?></li>
                        <li>后排独立空调：<?php echo $modelParams['rearAirConditioner']; ?></li>
                    </ul>
                </div>
                <div style="margin-top:10px;text-align:center;">
                    <?php if (Yii::app()->user->isServicer()&&$modelParams['modelId']): ?>
                       <input id="buygoods" class="submit" type="submit" value="车型询价">
                    <?php endif; ?>
                </div>
            </div>
            <div style="clear: both"></div>
        </div>	 
    </div>
</div>
