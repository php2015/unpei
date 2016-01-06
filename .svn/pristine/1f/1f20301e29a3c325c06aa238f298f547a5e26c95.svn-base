<?php foreach ($menu as $m): ?>
    <div class="mukuai float_l zxq <?php if ($m["isLarge"] == 1) echo "mukuai2" ?>">
        <div class="cx">
            <div class="float_l width150" style="height:51px"><img src="<?php echo F::uploadUrl() . 'common/frontmenu/' . $m["menuIcon"] ?>"></div> 
            <!--删除-->                      
            <!--            <div class="float_r sc">
                            <div class="sc_info"></div>
                        </div>-->
            <!--隐藏-->
            <div style="border:none" class="float_r yc"> 
                <div class="yc_info"></div>
            </div>
        </div>
        <div class="<?php if ($m["isLarge"] == 1) echo "ycbf2"; else echo "ycbf"; ?>"> 
            <div class="<?php if ($m["isLarge"] == 1) echo "xsgl_info"; else echo "ddgl_info"; ?>">
                <!--内容开始调用不同的页面-->
                <?php
                $page = "stage/" . $m["childPage"];
                if ($m["childPage"]) {
                    $this->render($page);
                } else {
                    $this->render("stage/default");
                }
                ?>
            </div>
        </div>

    </div>
<?php endforeach; ?>
