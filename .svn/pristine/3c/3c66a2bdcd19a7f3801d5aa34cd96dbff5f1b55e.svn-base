<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->theme->baseUrl ?>/css/pap/papeva.css" />
<link rel="stylesheet" href="<?php echo F::themeUrl(); ?>/css/detail/evaluation.css">
<style>

    .level .level_hollow{background-image: url("<?php echo F::themeUrl(); ?>/images/papeva/star-off-big.png"); background-position:0}
</style>
<div class="xlc-jxs w885 " >
    <!--满意度评价-->
    <p class="txxx bor_back  m-top10">经销商对修理厂评价</p>
    <div class="bor_back " >
        <form style="margin-left:60px; float:left; " id="eval_fm" method="post"> 
            <input type="hidden" name="Status" id="Status" value="<?php echo $Status ?>">
            <input type="hidden" name="EvaStatus" id="EvaStatus" value="<?php echo $EvaStatus ?>">
            <input type="hidden" name="evalOrderID" value="<?php echo $OrderID ?>">
            <input type="hidden" name="BuyerID" value="<?php echo $BuyerID ?>">
            <input type="hidden" name="Evaluations" id="Evaluations">  
            <?php foreach ($evarr as $ekey => $evalue): ?>
                <input type="hidden" name="evaID[<?php echo $ekey ?>]" id="evaID<?php echo $ekey ?>" value="1">
            <?php endforeach; ?>
        </form>
        <div class="satisfied satisfied2 " style="">
            <div class="jg-info float_l jg-info2">
                <div class="triangle-border2 tb-border2"></div>
                <div class="triangle-border2 tb-background2"></div>

                <div style="padding:30px 20px">
                    <?php
                    $OrderInfo = PapOrder::model()->findByPK($OrderID);
                    $OrganInfo = Organ::model()->findByPk($OrderInfo['BuyerID']);
                    $OrganPhoto = OrganPhoto::model()->find("OrganID =:organID", array(':organID' => $OrganInfo['ID']));

                    $xylevel = EvaluateService::getpets($OrganInfo['Grade']);
                    if (empty($xylevel) || !$xylevel[0] || !$xylevel[1]) {
                        $xylvstr = "<div class='xy-div' title='积分过低'><i class='seller-level0'></i></div>";
                    } else {
                        $xylvstr = '<div class = "xy-div" title = "积分：' . $OrganInfo['Grade'] . '">' . str_repeat("<i class='seller-level" . $xylevel[0] . "'></i>", $xylevel[1]) . '</div>';
                    }
                    ?>
                    <div class="eav-jg-img float_l">
                        <?php if ($OrganPhoto['Path']) : ?>
                            <img src="<?php echo F::uploadUrl() . $OrganPhoto['Path'] ?>" width="80px" height="80px">
                        <?php else: ?>
                            <img src="<?php echo F::uploadUrl() . 'common/default-goods.png'; ?>" width="80px" height="80px">
                        <?php endif; ?>
                    </div>
                    <div class="eav-jg-info float_l">
                        <p><b><?php echo $OrganInfo['OrganName'] ?></b></p>
                        <div class="xy-jg"><?php echo $xylvstr ?></div>
                        <p><?php echo Area::getCity($OrganInfo['Province']) . Area::getCity($OrganInfo['City']) . Area::getCity($OrganInfo['Area']) . $OrganInfo['Address']; ?></p>
                        <p><?php echo $OrganInfo['TelPhone'] ?></p>


                    </div>
                    <div class="clear"></div>
                </div>
            </div>
            <div class="jg-eav float_l">
                <div style="margin-left:30px; margin-top:5px">

                    <ul class="rev_pro clearfix">
                        <?php foreach ($evarr as $ekey => $evalue): ?>
                            <li>
                                <span class="revtit"><?php echo $evalue ?></span>

                                <div class="revinp">
                                    <span class="level">
                                        <i class="level_solid" cjmark="" onclick="on(<?php echo $ekey ?>, -1)"></i>
                                        <!--<i class="level_solid" cjmark="" onclick="on(<?php echo $ekey ?>, 2)"></i>-->
                                        <i class="level_solid" cjmark="" onclick="on(<?php echo $ekey ?>, 0)"></i>
                                        <!--<i class="level_solid" cjmark="" onclick="on(<?php echo $ekey ?>, 4)"></i>-->
                                        <i class="level_solid" cjmark="" onclick="on(<?php echo $ekey ?>, 1)"></i>
                                    </span>
                                    <span class="revgrade">好评</span>
                                </div>
                            </li>
                        <?php endforeach; ?>
                    </ul>

                    <div class="eav-spirit eav-spirit2" > 
                        <div class="float_l" style="text-align:right; width:110px">心得：</div>
                        <form name="" id="" action="" class="Form float_l">
                            <textarea name="Evaluations" id="TextArea1" onkeyup="checkLength2(this);" style="width:300px;height:84px"></textarea><br />

                            <span class="wordage">剩余字数：<span id="sy" style="color:Red;">200</span></span>
                        </form>
                        <div class="clear"></div>
                    </div>
                    <p align="center" style=" margin:20px 0 20px 0;">
                        <input type="button" class="submit " value="提交评论"  onclick="saveBuyto()" style="cursor:pointer"/>
                        <input type="button" class="submit " value="返回"  onclick="nosellereva()" style="cursor:pointer"/>
                    </p>
                </div>
            </div>
        </div>
    </div>
</div>
<script type="text/javascript">
    var url_eval = Yii_baseUrl + "/pap/sellerorder/Papeva";
    function on(evaid, num) {
        $("#evaID" + evaid).val(num);
    }

    //字数限制
    function checkLength2(which) {
        var maxChars = 200; //
        if (which.value.length > maxChars) {
            alert("您出入的字数超多限制!");
            // 超过限制的字数了就将 文本框中的内容按规定的字数 截取
            which.value = which.value.substring(0, maxChars);
            document.getElementById("sy").innerHTML = 0;
            return false;
        } else {
            var curr = maxChars - which.value.length; //250 减去 当前输入的
            document.getElementById("sy").innerHTML = curr.toString();
            return true;
        }
    }
    //保存评价
    function saveBuyto() {
        var Evaluation = $("textarea[name=Evaluations]").val();
        $("#Evaluations").val(Evaluation);
        $("#eval_fm").attr("action", url_eval);
        $("#eval_fm").submit();
    }

    //返回
    function nosellereva() {
        var url = Yii_baseUrl + '/pap/sellerorder/index/EvaStatus/1/type/4';
        window.location.href = url;
    }
    var degree = ['', '差评', '中评', '好评', '未评分'];
    //重新点评
    function addComment2(e, inid, opt, id) {
        $.ajax({
            url: '/siteMessage/content',
            type: 'post',
            data: 'id=' + id,
            dataType: 'json',
            success: function(data) {
                if (data.status == 1) {
                    var list = $('#Addnewskill_119');

                    list.eq(1).html(data.job);
                    list.eq(2).html(data.ms);

                    var arr = [data.total, data.expAuth, data.killAuth, data.followTime, data.formality, data.appReact];
                    var list2 = $('span.level', '#Addnewskill_119');
                    $('input[name="InterviewCommentInfoSub[opt]"]').val(opt + 1);
                    list2.each(function(i, v) {
                        var a = '';

                        if (i > 0) {
                            a = 'cjmark';
                            $(v).parents('li').find('input').val(arr[i]);
                        }
                        var str = '';
                        if (arr[i] == 6) {
                            for (var n = 0; n <= 4; n++) {
                                str += '<i ' + a + ' class="level_hollow"></i>';
                            }
                            $(v).parents('li').find('input').prop('disabled', true)
                        } else {
                            $(v).parents('li').find('input').prop('checked', true)
                            for (var n = 0; n < arr[i]; n++) {
                                str += '<i ' + a + ' class="level_solid"></i>';
                            }
                            for (var n = 0; n < (5 - arr[i]); n++) {
                                str += '<i ' + a + ' class="level_hollow"></i>';
                            }
                        }
                        $(v).html(str);
                        $(v).next().html(degree[arr[i]]);

                    })


                    create_show(119);
                } else {
                    ui.error(data.msg, 2000);
                }
            }
        })
    }
    //提交点评
    function addComment3() {
        $.ajax({
            url: '/siteMessage/commentinterview',
            type: 'post',
            data: $('form[name="comment"]').serialize(),
            dataType: 'json',
            success: function(data) {

            }

        })
    }

    //返回
    function funhui() {
        window.history.go(-1);
    }
    $('textarea[name=Evaluations]').live('keyup click keydown propertychange input', function() {
        showchange();
    })
    //长度判断
    function showchange() {
        var len = parseInt($('textarea[name=Evaluations]').val().length);
        if (len <= 50) {
            var sy = 50 - len;
            $('#showspan').text('还可以输入' + sy + '字');
        } else {
            var sy = len - 50;
            $('#showspan').html('已超过<font color="red">' + sy + '</font>字');
        }
    }
    $(function() {
        //长度判断
        $('textarea[name=Evaluations]').live('input propertychange', function() {
            showchange();
        })

        //点星星
        $(document).on('click', 'i[cjmark]', function() {
            var num = $(this).index();
            var pmark = $(this).parents('.revinp');
            var mark = pmark.prevAll('input');

            if (mark.prop('checked'))
                return false;

            var list = $(this).parent().find('i');
            for (var i = 0; i <= num; i++) {
                list.eq(i).attr('class', 'level_solid');
            }
            for (var i = num + 1, len = list.length - 1; i <= len; i++) {
                list.eq(i).attr('class', 'level_hollow');
            }
            $(this).parent().next().html(degree[num + 1]);

        })
        //点击星星
        $(document).on('click', 'i[cjmark]', function() {
            var num = $(this).index();
            var pmark = $(this).parents('.revinp');
            var mark = pmark.prevAll('input');

            if (mark.prop('checked')) {
                mark.val('');
                mark.prop('checked', false);
                mark.prop('disabled', true);
            } else {
                mark.val(num);
                mark.prop('checked', true);
                mark.prop('disabled', false);
            }
        })


    })
</script>