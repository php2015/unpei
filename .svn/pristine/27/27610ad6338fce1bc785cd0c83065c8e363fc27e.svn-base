<style>
    .area-sub {
        clear: both;
    }

    .cx {
        height: 53px;
    }
    #dealernews_show .pager{
        display: none;
    }
    .indexmore{
        padding-left: 400px;
        padding-top: 5px; 
        display: block;
        color: #0065bf;
        padding-bottom: 10px;

    }
    .ordershow{background: #fff; width: 885px; display: none; position: absolute; z-index: 1000;border:3px solid #ec8051;}
    .ordershow2{background: #fff; width: 885px; display: none; position: absolute; z-index: 1000;border:3px solid #ec8051;}
    .ordershow3{background: #fff; width: 885px; display: none; position: absolute; z-index: 1000;border:3px solid #ec8051;}
    .selected3{ background:#0065bf; color: #fff;}
    #ordershow1 p,#ordershow2 p{margin:0;margin-top:0px}
</style>
<div class="area-sub" id="dealernews_show" style="display:none;z-index: 1002">
    <div class="tab-product tab-sub-3 ui-style-gradient">
        <div class="tab-hd"> 
            <span id="dealershow1" style="margin-left:30px" class="tab-hd-con current remindspan" onclick="current(1)"><a href="javascript:;">业务提醒</a></span> 
<!--            <span id="dealershow2" class="tab-hd-con " onclick="current(2)"><a href="javascript:;">待发货的订单</a></span> -->
            <span id="dealershow2" class="tab-hd-con remindspan" onclick="current(2)"  style="border-right: 1px solid #e2e2e2"><a href="javascript:;">系统提醒</a></span>
            <div style="clear:both"></div>
            <!--<span class="tab-hd-con bor_right" key="current4"><a href="javascript:;">异常订单</a></span>--> 
        </div>
        <?php $organID = Yii::app()->user->getOrganID(); ?>
        <div class="tab-bd dom-display dom-display8">
            <div class="tab-bd-con current remindgrid" id="ordershow1"> 
                <?php
                $this->widget('widgets.default.WGridView', array(
                    'dataProvider' => RemindService::getBusinessRemind(array(
                        'OrganID' => $organID, 'HandleStatus' => '0,1',
                    )),
                    'pager' => false,
                    'id' => 'businesslist',
                    'ajaxUpdate' => true,
                    'columns' => array(
                        array(// display 'create_time' using an expression
                            'name' => '#',
                            'value' => '$data[NO]',
                            'headerHtmlOptions' => array('width' => '20px'),
                        ),
                        array(// display 'author.username' using an expression
                            'name' => '提醒时间',
                            'value' => 'date("Y-m-d H:i:s",$data["CreateTime"])',
                            'headerHtmlOptions' => array('width' => '150px'),
                        ),
                        array(// display 'create_time' using an expression
                            'name' => '提醒内容',
                            'type' => 'raw',
                            'value' => '$data[Content]',
                        ),
                        array(// display 'author.username' using an expression
                            'name' => '查看处理',
                            'type' => 'raw',
                            'value' => '$data[Link]',
                            'headerHtmlOptions' => array('width' => '100px'),
                        ),
                    ),
                ));
                ?>
                <div style="height:30px"><a  style="height:30px;line-height: 30px;" class="indexmore" href="<?php echo Yii::app()->createUrl("pap/remind/index") ?>">查看更多</a></div>
            </div>
            <div class="tab-bd-con remindgrid" style="display: none;" id="ordershow2"> 
                <?php
                $this->widget('widgets.default.WGridView', array(
                    'dataProvider' => RemindService::getSystemRemind(array(
                        'OrganID' => $organID, 'ReadStatus' => 0
                    )),
                    'pager' => false,
                    'id' => 'systemlist',
                    'ajaxUpdate' => true,
                    'columns' => array(
                        array(// display 'create_time' using an expression
                            'name' => '#',
                            'value' => '$data[NO]',
                            'headerHtmlOptions' => array('width' => '20px'),
                        ),
                        array(// display 'author.username' using an expression
                            'name' => '提醒时间',
                            'value' => 'date("Y-m-d H:i:s",$data["CreateTime"])',
                            'headerHtmlOptions' => array('width' => '150px'),
                        ),
                        array(// display 'create_time' using an expression
                            'name' => '提醒类型',
                            'type' => 'raw',
                            'value' => '$data[typeName]',
                            'headerHtmlOptions' => array('width' => '80px'),
                        ),
                        array(// display 'create_time' using an expression
                            'name' => '提醒内容',
                            'type' => 'raw',
                            'value' => '$data[Content]',
                        ),
                        array(// display 'author.username' using an expression
                            'name' => '查看处理',
                            'type' => 'raw',
                            'value' => '$data[Link]',
                            'headerHtmlOptions' => array('width' => '100px'),
                        ),
                    ),
                ));
                ?>
                <div style="height:30px">
                    <a  style="height:30px;line-height: 30px;" class="indexmore" href="<?php echo Yii::app()->createUrl("pap/remind/index") ?>">查看更多</a>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
    function businessRemind() {
        $.fn.yiiGridView.update('businesslist')
    }

    function systemRemind() {
        $.fn.yiiGridView.update('systemlist')
    }

    function current(current) {
        $('.remindspan').removeClass("current");
        $('.remindgrid').hide();
        $('#dealershow' + current).addClass("current");
        $('#ordershow' + current).show();
    }

    $(function() {
        $("#RemindColumn").click(function(e) {
            //判断是否为默认点击厂家
            maketarget = true;
            //判断是否为默认点击车系
            sericesarget = true;
            //判断是否为默认点击年款
            yeartarget = true;
            //判断弹窗是否显示
            isshow = true;
            e.stopPropagation();
            var offset = $(this).offset();
            var left, top, url, data;
            //            left = offset.left -210+ 'px';
            //            top = offset.top +26 + 'px';

            var width = $(window).width();
            //屏幕宽度大于1000
            if (width > 885) {
                var left = (width - 885) / 2 + 'px';
            } else {
                left = 150 + 'px';
            }
            // left = cutwidth ;
            top = (offset.top + 26) + 'px';
            $("#dealernews_show").css({'left': left, 'top': top}).show().removeClass('ordershow2').removeClass('ordershow3').addClass('ordershow');
            ;
            var current = $('#RemindColumn').attr('key');
            if (current != undefined) {
                $('.remindspan').removeClass("current");
                $('.remindgrid').hide();
                $('#dealershow' + current).addClass("current");
                $('#ordershow' + current).show();
            }
            $('#dealernews_show').show();
        });
    })

    $("#dealernews_show").live('click', function(event) { // mouseout
        var e = (event) ? event : window.event;
        if (window.event) {//IE
            e.cancelBubble = true;
            e.stopPropagation();
        } else { //火狐
            e.stopPropagation();
        }
        // e.stopPropagation();
    });

    $(document).click(function(event) {
        //    alert(2)
        event.stopPropagation();
        $("#dealernews_show").hide();
        ajaxLoadEnd();
    })

    function ajaxLoadEnd() {
        $(".datagrid-mask").remove();
    }
</script>
