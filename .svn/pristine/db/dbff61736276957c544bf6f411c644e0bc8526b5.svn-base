<style>
     .newsnum,.newsnum span{color:#ef7400}
    .remind_link{border-right:none;text-decoration:underline;color:#f27300}
    .remind_link:hover{color:#666}
</style>
<script type="text/javascript" src="<?php echo Yii::app()->theme->baseUrl . '/js/flash/jplayer/jquery.jplayer.min.js' ?>"></script>
<script src="<?php echo Yii::app()->theme->baseUrl . '/js/ui/jquery.messager.js' ?>"></script>
<?php
$route = Yii::app()->getController()->getRoute();
$self = array(
    'pap/remind/index', 'pap/remind/system',
    'dealer/customer/index', 'dealer/customer/selfquestion',
    'dealer/customer/submit', 'dealer/customer/detail',
    'servicer/servicequestion/wait', 'servicer/servicequestion/answer',
    'servicer/servicequestion/reopen', 'servicer/servicequestion/newquestion', 'servicer/servicequestion/questiondetail'
);
if (in_array($route, $self))
    $target = '';
else
    $target = 'target="_blank"';
?>

<div class="xiaoxi"><a href="<?php echo Yii::app()->createUrl('pap/remind/index') ?>" <?php echo $target; ?>>消息中心<span id="NewsCount" style="color:#f27300">(0)</span></a>  </div>

<div class="pop-up">
    <input type = "hidden" id = "remind1" />
    <input type = "hidden" id = "remind2" />
    <input type = "hidden" id = "remind3" />
    <input type = "hidden" id = "remind4" />
    <input type = "hidden" id = "remind5" />
    <input type = "hidden" id = "systemCount" />
    <div id = "audiodemo"></div>
    <?php if (!empty($mesmenu) && is_array($mesmenu)): ?>
        <p class="m-top10 " style="border-left:2px solid #ef7400; height:15px; line-height:15px; margin-bottom:5px; margin-left:10px">
            <b>业务消息</b><span class="newsnum">(<span id="BusinessCount">0</span>)</span></p>
        <?php if (Yii::app()->user->isServicer()) : ?>
            <?php
            if (isset($mesmenu['order']) && !empty($mesmenu['order'])):
                ?>
                <dl>
                    <dt class=" float_l"><b>订单</b></dt>
                    <dd class=" float_l"><a <?php echo $target; ?> href="<?php echo Yii::app()->createUrl('pap/remind/index', array('status' => 1, 'handle' => 'un')) ?>">
                            待付款<span class="newsnum">(<span id="OrderPay">0</span>)</span></a></dd>
                    <dd class=" float_l"><a <?php echo $target; ?> href="<?php echo Yii::app()->createUrl('pap/remind/index', array('status' => 1, 'handle' => 'un')) ?>">
                            待收货<span class="newsnum">(<span id="OrderReceive">0</span>)</span></a></dd>
                    <div class="clear"></div>
                </dl>
                <div class="clear"></div>
            <?php endif; ?>
            <?php
            if (isset($mesmenu['quo']) && !empty($mesmenu['quo'])):
                ?>
                <dl>
                    <dt class=" float_l"><b>报价单</b></dt>
                    <dd class=" float_l"><a <?php echo $target; ?> href="<?php echo Yii::app()->createUrl('pap/remind/index', array('status' => 2, 'handle' => 'un')) ?>">
                            待确认<span class="newsnum">(<span id="QuoConfirm">0</span>)</span></a></dd>
                    <div class="clear"></div>
                </dl>
                <div class="clear"></div>
            <?php endif ?>
            <?php
            if (isset($mesmenu['return']) && !empty($mesmenu['return'])):
                ?>
                <dl>
                    <dt class=" float_l"><b>退货单</b></dt>
                    <dd class=" float_l"><a <?php echo $target; ?> href="<?php echo Yii::app()->createUrl('pap/remind/index', array('status' => 3, 'handle' => 'un')) ?>">
                            未通过<span class="newsnum">(<span id="ReturnFail">0</span>)</span></a></dd>
                    <dd class=" float_l"><a <?php echo $target; ?> href="<?php echo Yii::app()->createUrl('pap/remind/index', array('status' => 3, 'handle' => 'un')) ?>">
                            待发货<span class="newsnum">(<span id="ReturnSend">0</span>)</span></a></dd>
                    <div class="clear"></div>
                </dl>
                <div class="clear"></div>
            <?php endif; ?>
            <script>
                function sendRemind(i) {
                    var href = '';
                    switch (i) {
                        case 1:
                            href = "<a href=" + Yii_baseUrl + '/pap/remind/index/status/1/handle/un' + ">您有新的待付款订单提醒！</a>";
                            break;
                        case 2:
                            href = "<a href=" + Yii_baseUrl + '/pap/remind/index/status/1/handle/un' + ">您有新的待收货订单提醒！</a>";
                            break;
                        case 3:
                            href = "<a href=" + Yii_baseUrl + '/pap/remind/index/status/2/handle/un' + ">您有新的待确认报价单提醒！</a>";
                            break;
                        case 4:
                            href = "<a href=" + Yii_baseUrl + '/pap/remind/index/status/3/handle/un' + ">您有新的未通过退货单提醒！</a>";
                            break;
                        case 5:
                            href = "<a href=" + Yii_baseUrl + '/pap/remind/index/status/3/handle/un' + ">您有新的待发货退货单提醒！</a>";
                            break;
                    }
                    if (href !== '' && href !== undefined) {
                        $.messager.lays(300, 150);
                        $.messager.anim('fade', 1000);
                        $.messager.show("新消息", href, 3000);

                        //播放声音                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                       
                        $('#audiodemo').jPlayer("play");
                    }
                }
            </script>
        <?php elseif (Yii::app()->user->isDealer()): ?>
            <?php
            if (isset($mesmenu['order']) && !empty($mesmenu['order'])):
                ?>
                <dl>
                    <dt class=" float_l"><b>订单</b></dt>
                    <dd class=" float_l"><a <?php echo $target; ?> href="<?php echo Yii::app()->createUrl('pap/remind/index', array('status' => 1, 'handle' => 'un')) ?>">
                            待付款<span class="newsnum">(<span id="OrderPay">0</span>)</span></a></dd>
                    <dd class=" float_l"><a <?php echo $target; ?> href="<?php echo Yii::app()->createUrl('pap/remind/index', array('status' => 1, 'handle' => 'un')) ?>">
                            待发货<span class="newsnum">(<span id="OrderReceive">0</span>)</span></a></dd>
                    <div class="clear"></div>
                </dl>
                <div class="clear"></div>
            <?php endif; ?>
            <?php
            if (isset($mesmenu['quo']) && !empty($mesmenu['quo'])):
                ?>
                <dl>
                    <dt class=" float_l"><b>询价单</b></dt>
                    <dd class=" float_l"><a <?php echo $target; ?> href="<?php echo Yii::app()->createUrl('pap/remind/index', array('status' => 2, 'handle' => 'un')) ?>">
                            待报价<span class="newsnum">(<span id="QuoConfirm">0</span>)</span></a></dd>
                    <div class="clear"></div>
                </dl>
                <div class="clear"></div>
            <?php endif; ?>
            <?php
            if (isset($mesmenu['return']) && !empty($mesmenu['return'])):
                ?>
                <dl>
                    <dt class=" float_l"><b>退货单</b></dt>
                    <dd class=" float_l"><a <?php echo $target; ?> href="<?php echo Yii::app()->createUrl('pap/remind/index', array('status' => 3, 'handle' => 'un')) ?>">
                            待审核<span class="newsnum">(<span id="ReturnFail">0</span>)</span></a></dd>
                    <dd class=" float_l"><a <?php echo $target; ?> href="<?php echo Yii::app()->createUrl('pap/remind/index', array('status' => 3, 'handle' => 'un')) ?>">
                            待收货<span class="newsnum">(<span id="ReturnSend">0</span>)</span></a></dd>
                    <div class="clear"></div>
                </dl>
                <div class="clear"></div>
            <?php endif; ?>
            <script>
                function sendRemind(i) {
                    var href = '';
                    switch (i) {
                        case 1:
                            href = "<a href=" + Yii_baseUrl + '/pap/remind/index/status/1/handle/un' + ">您有新的待付款订单提醒！</a>";
                            break;
                        case 2:
                            href = "<a href=" + Yii_baseUrl + '/pap/remind/index/status/1/handle/un' + ">您有新的待发货订单提醒！</a>";
                            break;
                        case 3:
                            href = "<a href=" + Yii_baseUrl + '/pap/remind/index/status/2/handle/un' + ">您有新的待报价询价单提醒！</a>";
                            break;
                        case 4:
                            href = "<a href=" + Yii_baseUrl + '/pap/remind/index/status/3/handle/un' + ">您有新的待审核退货单提醒！</a>";
                            break;
                        case 5:
                            href = "<a href=" + Yii_baseUrl + '/pap/remind/index/status/3/handle/un' + ">您有新的待收货退货单提醒！</a>";
                            break;
                    }
                    if (href !== '' && href !== undefined) {
                        $.messager.lays(300, 150);
                        $.messager.anim('fade', 1000);
                        $.messager.show("新消息", href, 3000);

                        //播放声音                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                       
                        $('#audiodemo').jPlayer("play");
                    }
                }
            </script>
            <?php
        endif;
    endif;
    ?>
    <p style="border-left:2px solid #ef7400; height:15px; line-height:15px; margin-bottom:5px; margin-top:10px; margin-left:10px">
        <b>系统消息</b><span class="newsnum">(<span id="SysCount">0</span>)</span></p>
    <div id="SystemRemind"></div>
    <p align="right"><a <?php echo $target; ?> href="<?php echo Yii::app()->createUrl('pap/remind/system') ?>" class="xiaoxi-more">更多</a></p>
</div> 
<script>
    //jplayer加载
    $("#audiodemo").jPlayer({
        ready: function() {
            $(this).jPlayer("setMedia", {
                mp3: "<?php echo Yii::app()->theme->baseUrl . "/js/flash/jplayer/unread.mp3"; ?>"
            });
        },
        swfPath: "<?php echo Yii::app()->theme->baseUrl . "/js/flash/jplayer"; ?>",
        supplied: "mp3"
    });

    //ajax请求待办事数量
    $.ajax({
        url: Yii_baseUrl + "/pap/remind/getnews",
        type: 'get',
        dataType: 'json',
        success: function(res) {
            for (var m = 1; m < res.business.length; m++) {
                $("#remind" + m).val(res.business[m]);
            }
            showNews(res);
        }
    });

    window.setInterval("RemindNews()", 20000);   // 待发货的订单     

    function RemindNews()
    {
        var remind = [];
        remind[1] = Number($("#remind1").val());
        remind[2] = Number($("#remind2").val());
        remind[3] = Number($("#remind3").val());
        remind[4] = Number($("#remind4").val());
        remind[5] = Number($("#remind5").val());
        var systemCount = Number($("#systemCount").val());
        var url = Yii_baseUrl + "/pap/remind/getnews";
        $.getJSON(url, function(res) {
            //业务消息提醒
            for (var m = 1; m < res.business.length; m++) {
                if (remind[m] < res.business[m]) {
                    sendRemind(m);
                }
                $("#remind" + m).val(res.business[m]);
            }

            //系统消息提醒
            if (systemCount < res.systemCount) {
                $.messager.lays(300, 150);
                $.messager.anim('fade', 1000);
                $.messager.show("新消息", "<a href=" + Yii_baseUrl + '/pap/remind/system' + ">您有新的系统提醒！</a>", 3000);

                //播放声音                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                       
                $('#audiodemo').jPlayer("play");
            }
            showNews(res);
        });
    }

    function showNews(res) {
        $('#NewsCount').html('('+res.business[0]+')');
        $('#OrderPay').html(res.business[1]);
        $('#OrderReceive').html(res.business[2]);
        $('#QuoConfirm').html(res.business[3]);
        $('#ReturnFail').html(res.business[4]);
        $('#ReturnSend').html(res.business[5]);
        $("#systemCount").val(res.systemCount);
        //业务消息总数
        $("#BusinessCount").html(res.businessCount);
        //系统消息总数
        $("#SysCount").html(res.systemCount);
        
        var html = '';
        for (var i in res.system) {
            var typeName = setTypeName(res.system[i].Type);
            html += '<p class="m-left10" style="max-width:240px;text-overflow: ellipsis;white-space: nowrap;height:20px;overflow:hidden">' + typeName + '：';
            if (res.system[i].Title) {
                html += '<a href="' + Yii_baseUrl + '/pap/remind/detail/id/' + res.system[i].ID + '" title="' + res.system[i].Title + '" class="remind_link">' + res.system[i].Title + '</a></p>';
            } else {
                html += '<a href="' + Yii_baseUrl + '/pap/remind/detail/id/' + res.system[i].ID + '" title="' + res.system[i].Content + '" class="remind_link">' + res.system[i].Content + '</a></p>';
            }
        }
        $('#SystemRemind').html(html);
    }

    function setTypeName(type) {
        var typeName = '';
        switch (type) {
            case '0':
            default:
                typeName = '系统提醒';
                break;
            case '1':
                typeName = '非法操作';
                break;
            case '2':
                typeName = '服务到期';
                break;
        }
        return typeName;
    }
</script>