<div>
    <div class="part-img">
        <?php if ($groupInfo && !empty($groupInfo['picture'])) { ?>
            <img  class="zoom-img" src="<?php echo $groupInfo['picture'] ?>" style='width:400px;height:300px;' alt="子组图片" title="子组图片">
            <script type="text/javascript">
                //zoom图片放大
                /*
            $(document).ready(function(){
                    $('.zoomContainer').remove();
                    $('.zoom-img').click(function(){
                            $(this).elevateZoom({ 
                                    cursor: 'crosshair', 
                                    zoomTintFadeOut: false
                            });
                    });
            });
                 */
            </script>
        <?php } else { ?>
            <div style="font-size:16px;text-align:center;margin-top:140px;">无子组图片</div>
        <?php } ?>
    </div>
    <div>
        <?php if ($groupInfo && !empty($groupInfo['note'])) { ?>
            <span>备注：<?php echo $groupInfo['note']; ?></span>
            <br />
        <?php } ?>
        <?php if ($groupInfo && !empty($groupInfo['applicableModel'])) { ?>
            <span>适用车型：<?php echo $groupInfo['applicableModel']; ?></span>
        <?php } ?>
    </div>
    <div style="margin-top:20px;">
        <a class="font-green" href="javascript:void(0)" id="dlg-group" onclick='newgroup()'>新增配件组</a>
        &nbsp;&nbsp;<a class="font-green" href="javascript:void(0)" onclick='newparts()' >新增配件</a>
    </div>
    <div id="part" style="margin-top:10px;">
        <!-- 
        <span class="result-title">配件列表</span>
        -->
        <?php if ($groupParts && count($groupParts) > 0) { ?>
            <?php $this->renderPartial('partsinfo', array('groupParts' => $groupParts, 'modelId' => $modelId, 'hasPerm' => $hasPerm)); ?>
        <?php } else { ?><!--
                       <div style="font-size:14px;margin-top:20px;">无相关数据</div>
            --><center><p>搜索到&nbsp; <font color=red>0</font>&nbsp;条数据&nbsp;&nbsp;
                    <span style="text-decoration: underline;"></span></p></center>
                <?php } ?>
    </div>
</div>
