<?php if ($csinfo): ?>
    <div id="online_qq_layer">
        <div id="online_qq_tab">
            <a id="floatShow" style="display:none;outline: none" href="javascript:void(0);">收缩</a> 
            <a id="floatHide" style="display:block;outline: none" href="javascript:void(0);">展开</a>
        </div>
        <div id="onlineService" style="display:block">
            <div class="onlineMenu">
                <h3 class="tQQ">联系经销商</h3>
                <ul class="qq">
                    <?php foreach ($csinfo as $v): ?>
                        <li>
                            <a target="_blank" href="http://wpa.qq.com/msgrd?v=3&uin=<?php echo $v['QQ'] ?>&site=qq&menu=yes;" title="点击这里给我发消息">
                                <?php echo $v['Name'] ?>
                            </a>
                        </li>
                    <?php endforeach; ?>
                    <!--				<li><a href="">老崔</a></li>-->
                </ul>
                <h3 class="tli tele">电话咨询</h3>
                <?php if ($seller['TelPhone']): ?>
                    <ul class="tel">
                        <?php
                        $tel = explode(',', $seller['TelPhone']);
                        foreach ($tel as $v):
                            ?>
                        <li style="text-overflow: ellipsis;overflow: hidden;white-space: nowrap; width: 110px;" title="<?php echo $v; ?>"><?php echo $v; ?></li>
                        <?php endforeach; ?>
                    </ul>	
                <?php else: ?>
                    <ul class="tel">
                        <li></li>
                    </ul>	
                <?php endif; ?>
            </div>



        </div>
    </div>
<?php endif ?>
<script type="text/javascript">
    window.onload = function() {
        var heigh = parseInt($('#onlineService').height());//parseInt(document.getElementById("onlineService").offsetHeight);
        var top = (heigh - 120) / 2;
        $("#online_qq_tab").css("margin-top", top);
    }
    $(document).ready(function() {

        $("#floatShow").bind("click", function() {

            $("#onlineService").animate({width: "show", opacity: "show"}, "normal", function() {
                $("#onlineService").show();
            });

            $("#floatShow").attr("style", "display:none");
            $("#floatHide").attr("style", "display:block");

            return false;
        });

        $("#floatHide").bind("click", function() {

            $("#onlineService").animate({width: "hide", opacity: "hide"}, "normal", function() {
                $("#onlineService").hide();
            });

            $("#floatShow").attr("style", "display:block");
            $("#floatHide").attr("style", "display:none");

            return false;
        });

    });
</script>
