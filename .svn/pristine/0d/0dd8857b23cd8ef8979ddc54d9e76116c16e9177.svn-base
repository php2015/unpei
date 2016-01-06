<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->theme->baseUrl ?>/css/pap/papeva.css" />
<link rel="stylesheet" href="<?php echo F::themeUrl(); ?>/css/detail/evaluation.css">
<style>
    .rev_pro li .revtit{ width:150px}
    .level .level_solid, .level .level_hollow{cursor:pointer;background-image: url("<?php echo F::themeUrl(); ?>/images/papeva/star-on-big.png");
                                              background-repeat: no-repeat;
                                              display: inline-block;
                                              float: left;
                                              height: 24px;
                                              width: 24px;}
    .level .level_hollow{background-image: url("<?php echo F::themeUrl(); ?>/images/papeva/star-off-big.png"); background-position:0}
    .level .level_solid:hover{background-image: url("<?php echo F::themeUrl(); ?>/images/papeva/star-on-big.png"); background-position:0}
    .form-row li{
        float:left; 


    }

</style>
<div class="xlc-jxs w885 " style="">
    <p class="txxx bor_back">商品评价</p>
    <div class="xlc-jxs-eva bor_back">
        <ul class="eva-head">
            <li class="w500" style=" text-indent: 5em">商品名称</li>
            <li class="w180">购买时间</li>
            <li class="w180">评价状态</li>
            <div class="clear"></div>
        </ul>
        <form style="margin-left:60px; float:left;" id="eval_fm" method="post"> 
            <input type="hidden" name="Status" id="Status">
            <input type="hidden" name="GoodsID" id="GoodsID">
            <input type="hidden" name="OrganID" id="OrganID" value="<?php echo $data[0]['OrganID']; ?>">
            <input type="hidden" name="BuyerToEvalRemark" id="BuyerToEvalRemark">      
            <input type="hidden" name="OrderStatus" value="<?php echo $OrderStatus; ?>">
            <input type="hidden" name="evalOrderID" value="<?php echo $OrderID; ?>">
            <input type="hidden" name="EvaStatus" value="<?php echo $EvaStatus; ?>">
            <?php foreach ($evarr as $ekey => $evalue): ?>
                <input type="hidden" name="evaID[<?php echo $ekey ?>]" id="evaID<?php echo $ekey ?>" value="5">
            <?php endforeach; ?>
        </form>
        <div class="eva-info">
            <?php foreach ($data as $key => $result): ?>
                <ul class="eva-body" >
                    <li class="eva-body-li">
                        <div class="eav-sp-info w500">
                            <div class="eav-sp-img w60">  <img src="<?php
                                if ($result['GoodsIMG']) {
                                    echo F::uploadUrl() . $result['GoodsIMG'];
                                } else {
                                    echo F::baseUrl() . '/upload/dealer/default-goods.png';
                                }
                                ?>" class="sp_pl" style="width:80px;height:80px">  </div>
                            <div class="eav-sp-name w400"><?php echo $result['GoodsName'] ?></div>

                            <div class="clear"></div>
                        </div>
                        <?php
                        $OrderTime = PapOrder::model()->findByPK($OrderID);
                        ?>
                        <div class="eav-buytime w180"><?php echo date('Y-m-d', $OrderTime['CreateTime']) ?></div>
                        <div class="eav-caozuo w180"><span class="eav-publish" id="eav-publish<?php echo $key ?>" onclick="chakan(<?php echo $key ?>)">展开评价</span></div>
                        <div class="clear"></div>
                        <div class="evaluation" id="evaluation<?php echo $key ?>">
                            <!--三角形-->
                            <div class="triangle-border tb-border"></div>
                            <div class="triangle-border tb-background"></div>
                            <!--星星评分-->
                            <div id="star">
                                <span><label class="color_r">*</label>评价：</span>
                                <!--                                <ul id="star_ul">
                                                                    <li class="star"><a href="javascript:;" value="1" >1</a></li>
                                                                    <li class="star"><a href="javascript:;" value="2"  >2</a></li>
                                                                    <li class="star"><a href="javascript:;" value="3"  >3</a></li>
                                                                    <li class="star"><a href="javascript:;" value="4"  >4</a></li>
                                                                    <li class="star"><a href="javascript:;" value="5" >5</a></li>
                                                                </ul>-->
                                <span style="margin-left:20px"><input style="cursor:pointer; margin-top:-12px; vertical-align: middle" type="radio" value="1" checked="checked" id="good<?php echo $key ?>"  name="<?php echo $result['GoodsID'] ?>"/><img src="<?php echo F::themeUrl() ?>/images/images/smile.png" width="21px" height="21px"><label for="good<?php echo $key ?>"></label></span>
                                <span style="margin-left:20px"> <input style="cursor:pointer; margin-top:-12px; vertical-align: middle" name="<?php echo $result['GoodsID'] ?>"  id="medium<?php echo $key ?>" type="radio" value="2"  style=" margin-top:0"/><img src="<?php echo F::themeUrl() ?>/images/images/happy.png" width="21px" height="21px"><label for="medium<?php echo $key ?>"></label></span>
                                <span style="margin-left:20px">  <input style="cursor:pointer; margin-top:-12px; vertical-align: middle" type="radio" value="3"  id="bad<?php echo $key ?>" name="<?php echo $result['GoodsID'] ?>" style="margin-top:0"/><img src="<?php echo F::themeUrl() ?>/images/images/cry.png" width="21px" height="21px"><label for="bad<?php echo $key ?>"></label></span><br>
                                <span></span>
                                <p></p>
                            </div>
                            <!--心得-->
                            <div class="eav-spirit" > 
                                <div class="w60 float_l" style="text-align:left"><label class="color_r">*</label>心得：</div>
                                <form name="" id="" action="" class="Form float_l">
                                    <textarea name="BuyerToEvalRemark" id="TextArea1" onkeyup="checkLength(this,<?php echo $key ?>);" style="width:600px;height:84px" ></textarea><br /><br />
                                    <input type="hidden" name="GoodsID" value="<?php echo $result['GoodsID'] ?>">
                                    <span class="wordage">剩余字数：<span id="sy<?php echo $key ?>" style="color:Red;">200</span></span>
                                </form>
                                <div class="clear"></div>
                            </div>
                            <div class="eav-shaid" > 
                                <div class="w60 float_l" style="text-align:left"><label class="color_r">*</label>晒单：</div>
                                <div class="w600 float_l" style="text-align:left">
                                    <input type='file' name='file_upload' id="file_upload<?php echo $key ?>"><input type="hidden" value="上传" id="file-upload-start"><span style=" margin-left:10px; color:#666">最多上传3张</span>
                                    <br />
                                </div>
                                <div class="clear"></div>
                                <div class="upload_img " >
                                    <ul>
                                        <div class="form-row" id="showimglist<?php echo $key ?>" style=" position: relative;padding-left: 60px">
                                            <?php if (!empty($organphotos)): ?>
                                                <?php foreach ($organphotos as $k => $organphoto): ?>
                                                    <li style="">
                                                        <img src="<?php echo F::uploadUrl() . $organphoto['Path']; ?>" style="width:80px;height:80px;">
                                                        <span id="delfile" keyid="<?php echo $organphoto['Path'] ?>" class="guanbi3"><img src="<?php echo F::themeUrl(); ?>/images/guanbi3.png"></span>
                                                    </li>
                                                <?php endforeach; ?>
                                            <?php endif; ?>
                                        </div>
                                        <input type='hidden' value='' id="photoId" name='photoId' class='width114 input'>
                                        <div style="clear:both"></div>
                                    </ul>
                                </div>
                            </div>

                                                                                                                                <!--<p><button class="gray">发表评论</button></p>-->
                        </div>
                    </li>
                </ul>
            <?php endforeach; ?>
        </div>
    </div>
    <!--满意度评价-->
    <p class="txxx bor_back  m-top10">满意度评价</p>
    <div class="bor_back ">
        <div class="satisfied ">
            <div class="jg-info float_l">
                <div class="triangle-border2 tb-border2"></div>
                <div class="triangle-border2 tb-background2"></div>
                <div style="padding:35px 20px">
                    <?php
                    $OrderInfo = PapOrder::model()->findByPK($OrderID);
                    $OrganInfo = Organ::model()->findByPk($OrderInfo['SellerID']);
                    $OrganPhoto = OrganPhoto::model()->find("OrganID =:organID", array(':organID' => $OrganInfo['ID']));
                    $xylevel = EvaluateService::getpets($OrganInfo['Grade']);
                    if (empty($xylevel) || !$xylevel[0] || !$xylevel[1]) {
                        $xylvstr = "<div class='xy-div' title='积分过低'><i class='seller-level0'></i></div>";
                    } else {
                        $xylvstr = '<div class = "xy-div" title = "积分：' . $OrganInfo['Grade'] . '">' . str_repeat("<i class='seller-level" . $xylevel[0] . "'></i>", $xylevel[1]) . '</div>';
                    }
                    ?>
                    <div class="eav-jg-img float_l"><img src="<?php echo F::uploadUrl() . $OrganPhoto['Path'] ?>"></div>
                    <div class="eav-jg-info float_l">
                        <p><b><?php echo $OrganInfo['OrganName'] ?></b></p>
                        <div class="xy-jg"><?php echo $xylvstr ?></div>
                        <p><?php echo Area::getCity($OrganInfo['Province']) . Area::getCity($OrganInfo['City']) . Area::getCity($OrganInfo['Area']) . $OrganInfo['Address']; ?></p>
                        <p><?php echo $OrganInfo['TelPhone'] ?></p>
                    </div>
                    <div class="clear"></div>
                </div>
            </div>
            <!--                        <div class="jg-eav float_l">
                                        <div style="width:300px; margin-left:60px; margin-top:40px ">
            <?php //foreach ($evarr as $ekey => $evalue): ?>
                                       <div class="eav-demo">
                                          <div class="float_l" style="margin-left:24px; line-height:26px; color:#666"><?php echo $evalue ?></div>
                                             <div id="function-demo" class="target-demo"></div>
                                                 <div id="function-hint" class="hint"></div>
                                           </div>
            <?php //endforeach; ?>
                                            <p align="center" class="m-top10" ><button type="button" class="gray" onclick="saveBuyto()" >提交</button></p>
                                        </div>
                                    </div>-->
            <div class="gradecon float_l" id="Addnewskill_119">
                <ul class="rev_pro clearfix">
                    <?php foreach ($evarr as $ekey => $evalue): ?>
                        <li>
                            <span class="revtit" style="float:left;width:200px;white-space:nowrap;overflow:hidden;text-overflow:ellipsis"><a href="javascript:void(0)" title="<?php echo $evalue?>"><?php echo $evalue ?></a></span>
                            <div class="revinp">
                                <span class="level">
                                    <i class="level_solid" cjmark="" onclick="on(<?php echo $ekey ?>, 1)"></i>
                                    <i class="level_solid" cjmark="" onclick="on(<?php echo $ekey ?>, 2)"></i>
                                    <i class="level_solid" cjmark="" onclick="on(<?php echo $ekey ?>, 3)"></i>
                                    <i class="level_solid" cjmark="" onclick="on(<?php echo $ekey ?>, 4)"></i>
                                    <i class="level_solid" cjmark="" onclick="on(<?php echo $ekey ?>, 5)"></i>
                                </span>
                                <!--<span class="revgrade">好评</span>-->
                            </div>
                        </li>
                    <?php endforeach; ?>
                </ul>
            </div>

            <p align="center" style=" margin-bottom: 20px;">
                <input type="button" class="submit " value="提交评论"  onclick="saveBuyto()" style="cursor:pointer"/>
                <input type="button" class="submit " value="返回"  onclick="noeva()" style="cursor:pointer"/>
            </p>
        </div>
    </div>
<!--    <p class="txxx bor_back  m-top10">评价说明</p>
    <div class="eav-assessment bor_back">
        <p>1.这里是文字钱这里是文字钱女子这里是文字钱女子这里是文字钱女子这里是文字钱女子这里是文字钱女子这里是文字钱女子女子</p>
        <p>2.这里是文字钱这里是文字钱女子这里是文字钱女子这里是文字钱女子这里是文字钱女子这里是文字钱女子这里是文字钱女子女子</p>
        <p>3.这里是文字钱这里是文字钱女子这里是文字钱女子这里是文字钱女子这里是文字钱女子这里是文字钱女子这里是文字钱女子女子</p>
        <p>4.这里是文字钱这里是文字钱女子这里是文字钱女子这里是文字钱女子这里是文字钱女子这里是文字钱女子这里是文字钱女子女子</p>
    </div>-->
</div>

<?php $this->renderPartial("uploadimgjs", array('key' => count($data))); ?>
<script type="text/javascript" src='<?php echo F::themeUrl(); ?>/js/uploadify/jquery.uploadify.js'></script>
<link rel="stylesheet" href="<?php echo F::themeUrl(); ?>/js/uploadify/uploadify1.css">
<script src="<?php echo Yii::app()->theme->baseUrl . '/js/pap/papeva.js' ?>"></script>
<script>
//                $(".eav-publish").click(function() {
//                    $(this).parent().next().next(".evaluation").css("display", "block");
//                }

//                )

                    function chakan(ID) {
//                    $(this).parent().next().next().text($("#evaluation" + ID).is(":hidden") ? "收起搜索条件" : "展开搜索条件");
                        if ($("#evaluation" + ID).is(":hidden")) {
                            $("#eav-publish" + ID).text("收起评价");
                        }
                        if ($("#evaluation" + ID).is(":visible")) {
                            $("#eav-publish" + ID).text("展开评价");
                        }
                        $("#evaluation" + ID).slideToggle();

                    }

                    var url_eval = Yii_baseUrl + "/pap/Orderreview/saveevaluation";
                    function on(evaid, num) {
                        $("#evaID" + evaid).val(num);
                    }
                    //保存评价
                    function saveBuyto() {
                        var status = 0;
                        var BuyerToEvalRemark = 0;
                        var GoodsID = 0;
                        var OrganID = 0;
                        $('.eva-info .evaluation').each(function() {
                            status += ',' + $(this).find('input[type=radio]:checked').val();
                            BuyerToEvalRemark += ',' + $(this).find('textarea[name=BuyerToEvalRemark]').val();
                            GoodsID += ',' + $(this).find('input[name=GoodsID]').val();
                        })
                        $("#Status").val(status);
                        $("#GoodsID").val(GoodsID);
                        $("#BuyerToEvalRemark").val(BuyerToEvalRemark);
                        $("#eval_fm").attr("action", url_eval);
                        $("#eval_fm").submit();
                    }
                    //删除图片事件
                    $("#delfile").live('click', function() {
                        //$("#file_upload").uploadify('disable', false);
                        $(this).parent().parent().parent().parent().prev().prev().find(".uploadify").uploadify('disable', false);
                        $("#eval_fm").find('input[value="' + $(this).attr('keyid') + '"]').remove();
                        var photoId = $(this).attr('keyid');
                        $.post(
                                Yii_baseUrl + "/pap/orderreview/delpto",
                                {imageid: photoId},
                        function(result) {
                            if (result.success) {
                                alert("删除成功！");
                            }
                        },
                                'json');
                        $(this).parent().remove();
                    });
                    //返回
                    function noeva() {
                        var url = Yii_baseUrl + '/pap/orderreview/index/orderstype/4/evastatus/1';
                        window.location.href = url;
                    }
                    //字数限制
                    function checkLength(which, ID) {
                        var maxChars = 200; //
                        if (which.value.length > maxChars) {
                            alert("您出入的字数超多限制!");
                            // 超过限制的字数了就将 文本框中的内容按规定的字数 截取
                            which.value = which.value.substring(0, maxChars);
                            document.getElementById("sy" + ID).innerHTML = 0;
                            return false;
                        } else {
                            var curr = maxChars - which.value.length; //250 减去 当前输入的
                            document.getElementById("sy" + ID).innerHTML = curr.toString();
                            return true;
                        }
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

                    var degree = ['', '很差', '差', '中', '良', '优', '未评分'];
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


</script>



<script type="text/javascript">
    window.onload = function() {

        var oStar = document.getElementById("star");
        var aLi = oStar.getElementsByTagName("li");
        var oUl = oStar.getElementsByTagName("ul")[0];
        var oSpan = oStar.getElementsByTagName("span")[1];
        var oP = oStar.getElementsByTagName("p")[0];
        var i = iScore = iStar = 0;
        var aMsg = [
            "很不满意|差得太离谱，与卖家描述的严重不符，非常不满",
            "不满意|部分有破损，与卖家描述的不符，不满意",
            "一般|质量一般，没有卖家描述的那么好",
            "满意|质量不错，与卖家描述的基本一致，还是挺满意的",
            "非常满意|质量非常好，与卖家描述的完全一致，非常满意"
        ]

        for (i = 1; i <= aLi.length; i++) {
            aLi[i - 1].index = i;

            //鼠标移过显示分数
            aLi[i - 1].onmouseover = function() {
                fnPoint(this.index);
                //浮动层显示
                oP.style.display = "block";
                //计算浮动层位置
                oP.style.left = oUl.offsetLeft + this.index * this.offsetWidth - 104 + "px";
                //匹配浮动层文字内容
                oP.innerHTML = "<em><b>" + this.index + "</b> 分 " + aMsg[this.index - 1].match(/(.+)\|/)[1] + "</em>" + aMsg[this.index - 1].match(/\|(.+)/)[1]
            };

            //鼠标离开后恢复上次评分
            aLi[i - 1].onmouseout = function() {
                fnPoint();
                //关闭浮动层
                oP.style.display = "none"
            };

            //点击后进行评分处理
            aLi[i - 1].onclick = function() {
                iStar = this.index;
                oP.style.display = "none";
                oSpan.innerHTML = "<strong>" + (this.index) + " 分</strong> (" + aMsg[this.index - 1].match(/\|(.+)/)[1] + ")"
            }
        }

        //评分处理
        function fnPoint(iArg) {
            //分数赋值
            iScore = iArg || iStar;
            for (i = 0; i < aLi.length; i++)
                aLi[i].className = i < iScore ? "on" : "";
        }

    };
</script>
<!--满意度评价-->
<script type="text/javascript">
//    $(function() {
//        $.fn.raty.defaults.path = 'lib/img';
//        $('#function-demo').raty({
//            number: 5, //多少个星星设置		
//            targetType: 'hint', //类型选择，number是数字值，hint，是设置的数组值
////            path: '../../images/papeva/',
//            path: '<?php echo F::themeUrl() ?>/images/papeva/',
//            hints: ['差', '一般', '好'],
//            cancelOff: 'cancel-off-big.png',
//            cancelOn: 'cancel-on-big.png',
//            size: 24,
//            starHalf: 'star-half-big.png',
//            starOff: 'star-off-big.png',
//            starOn: 'star-on-big.png',
//            // target    : '#function-hint',
//            cancel: false,
//            targetKeep: true,
//            //targetText: '请选择评分',
//
//            /*  click: function(score, evt) {
//             alert('ID: ' + $(this).attr('id') + "\nscore: " + score + "\nevent: " + evt.type);
//             }*/
//        });
//
//        $('#function-demo1').raty({
//            number: 5, //多少个星星设置
//            score: 2, //初始值是设置
//            targetType: 'number', //类型选择，number是数字值，hint，是设置的数组值
//            path: 'images',
//            cancelOff: 'cancel-off-big.png',
//            cancelOn: 'cancel-on-big.png',
//            size: 24,
//            starHalf: 'star-half-big.png',
//            starOff: 'star-off-big.png',
//            starOn: 'star-on-big.png',
//            // target    : '#function-hint1',
//            cancel: false,
//            targetKeep: true,
//            precision: false, //是否包含小数
//            /* click: function(score, evt) {
//             alert('ID: ' + $(this).attr('id') + "\nscore: " + score + "\nevent: " + evt.type);
//             }*/
//        });
//        $('#function-demo2').raty({
//            number: 5, //多少个星星设置
//            score: 2, //初始值是设置
//            targetType: 'number', //类型选择，number是数字值，hint，是设置的数组值
//            path: 'images',
//            cancelOff: 'cancel-off-big.png',
//            cancelOn: 'cancel-on-big.png',
//            size: 24,
//            starHalf: 'star-half-big.png',
//            starOff: 'star-off-big.png',
//            starOn: 'star-on-big.png',
//            // target    : '#function-hint2',
//            cancel: false,
//            targetKeep: true,
//            precision: false, //是否包含小数
//            /* click: function(score, evt) {
//             alert('ID: ' + $(this).attr('id') + "\nscore: " + score + "\nevent: " + evt.type);
//             }*/
//        });
//    });
</script>