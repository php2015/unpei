<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->theme->baseUrl ?>/css/help/addquestion.css" />
<link rel="stylesheet" href="<?php echo F::themeUrl(); ?>/js/uploadify/uploadify1.css">
<style>
    .input1{ border:1px solid #fea8a7}
    .uploadify-button-text{color:#fff}
    .ylr {
        background: none repeat scroll 0 0 #eff4fa;
        padding: 15px 10px 10px;
        margin-left:120px;
        width: 610px;
    }
    .ylr_ul {min-height:30px;height:auto}
    .ylr_ul li {width:40%;float:left;margin-right:10px;}
    .width250{
        width:250px;
    }
    .uploadalign{
        margin-top: -15px;
        margin-left: 65px;
    }
    .uploadify-queue{
        display:none;
    }
    .select{height:25px;line-height: 25px;border:1px solid #d2d2d2;}
</style>
<?php //var_dump($questype['TypeName'])?>
<div class="contents">
    <div class="box-step">
        <div class="step float_l">提交问题流程</div>
        <div class="step1 float_l ">1、选择问题类型</div>
        <div class="jg float_l"><img src="<?php echo F::themeUrl() ?>/images/helpcenter/jg.jpg"></div>
        <div class="step1 float_l ">2、选择具体问题</div>
        <div class="jg float_l"><img src="<?php echo F::themeUrl() ?>/images/helpcenter/jg.jpg"></div>
        <div class="step1 float_l current">3、填写问题描述</div>
    </div>
    <div class="m_top10 padding10 border">
        <div class="fw padding10 wz bor_bottom">
            <span class=" float_l">3、填写问题描述<em class="choice-question"></em></span>
            <span class="float_r editor"><a href="javascript:void(0)" onclick="goback('<?php echo $questype['ID'] ?>')">返回具体问题</a></span>
            <div class="clear"></div>
        </div>
        <div>
            <div class=" answer padding15" style="background:none">
                <form method="post" action="<?php echo Yii::app()->createUrl("helpcenter/home/submit"); ?>" >
                    <div class='row'>
                        <label class='label'>问题类型：</label>
                        <select class='width60 select' name="Type">
                            <option value='1' <?php echo $questype['TypeName'] == '账号问题' ? 'selected' : '' ?>>账号问题</option>
                            <option value='2' <?php echo $questype['TypeName'] == '交易问题' ? 'selected' : '' ?>>交易问题</option>
                            <option value='3' <?php echo $questype['TypeName'] == '商品问题' ? 'selected' : '' ?>>商品问题</option>
                            <option value='4' <?php echo $questype['TypeName'] == '数据问题' ? 'selected' : '' ?>>数据问题</option>
                            <option value='5' <?php echo $questype['TypeName'] == '意见和建议' ? 'selected' : '' ?>>意见和建议</option>
                            <option value='6' <?php echo $questype['TypeName'] == '其他' ? 'selected' : '' ?>>其他</option>
                        </select>
                    </div>
                    <p class=" m_top10"><span>问题标题：</span>
                        <input type="text" class="input width250" name="Title" style="height:25px;" onblur="check_title()"/>
                        <span style="color:red;display: none" id="warring_title">问题描述不能为空!</span>
                    </p>
                    <div class='m_top10'>
                        <label class='label' style="vertical-align:top;">问题描述：</label>
                        <textarea style="width:500px;" rows="5" name="Desc"  maxlength="200" size="255" onblur="check_desc()"></textarea><span id="showspan">(最多200字)</span>
                        <span style="color:red;display: none"id="warring_desc">问题描述不能为空!</span>
                    </div>

                    <div class='row'>
                        <label class='label'>上传附件：</label>
                        <input type='file' name='file_upload' id="file_upload">
                    </div>
                    <div class="row ylr" id="showfile" style="display:none">
                        <b>已上传附件</b><span style="color:red;">(最多只能上传5个附件)</span>
                        <ul class="ylr_ul" id="addul">
                        </ul>
                        <div style="clear:both;"></div>
                    </div>
                    <input name="FileName" id="FileName" type="hidden">
                    <input name="FileUrl" id="FileUrl" type="hidden">
                    <div class='row' style="padding-left:200px;margin-top:20px;">
                        <input class='submit m_left' type='submit' value='提交' style="width:80px;cursor:pointer ">
                    </div>

                </form>
            </div>
            <div style="height:80"></div>
        </div>
    </div>  
</div>
<?php $this->renderpartial('upload'); ?>
<script>

    function check_title() {
        var title = $.trim($("input[name=Title]").val());
        if (title == "") {
            $('#warring_title').show();
        } else {
            $('#warring_title').hide();
        }

    }
    function check_desc() {
        var title = $.trim($("textarea[name=Desc]").val());
        if (title == "") {
            $('#warring_desc').show();
        } else {
            $('#warring_desc').hide();
        }
    }
    function goback(ID) {
        var url = Yii_baseUrl + '/helpcenter/home/addquestion2/ID/' + ID;
        window.location.href = url;
    }
    $("input[name=Title]").blur(function() {
        if ($("input[name=Title]").val() == "") {
            $("input[name=Title]").addClass("input1");
        } else {
            $("input[name=Title]").removeClass("input1");
        }
    });
    $("textarea[name=Desc]").blur(function() {
        if ($("textarea[name=Desc]").val() == "") {
            $("textarea[name=Desc]").addClass("input1");
        } else {
            if (($("textarea[name=Desc]").val()).length > 200) {
                $("textarea[name=Desc]").addClass("input1");
            } else {
                $("textarea[name=Desc]").removeClass("input1");
            }
        }
    });
    $(document).ready(function() {
        $('textarea[name=Desc]').keyup(function() {
            var leng = $(this).val().length;
            var zihu = $('textarea[name=Desc]').val().substr(0, 200);
            if (leng > 200) {
                alert('问题描述最多200字 ');
                $('textarea[name=Desc]').value = zihu;
            }
        });

        $("#file_upload").addClass('uploadalign');
        $('textarea[name=Desc]').live('input propertychange', function() {
            showchange();
        });


        $(".submit").click(function() {
            var len = parseInt($.trim($('textarea[name=Desc]').val()).length);
            var title = $.trim($("input[name=Title]").val());
            var desc = $.trim($("textarea[name=Desc]").val());
            if (len > 200) {
                alert('问题描述最多200字');
                return false;
            }
            if (!title) {
                $('#warring_title').show();
                return false;
            } else {
                $('#warring_title').hide();
            }

            if (!desc) {
                $('#warring_desc').show();
                return false;
            } else {
                $('#warring_desc').hide();
            }


            fileaddhide();
            if ($("input[name=Title]").val() == "") {
                $("input[name=Title]").addClass("input1");
                return false;
            }
            if ($("textarea[name=Desc]").val() == "") {
                $("textarea[name=Desc]").addClass("input1");
                return false;
            }
            if (($('textarea[name=Desc]').val()).length > 200) {
                $("textarea[name=Desc]").addClass("input1");
                return false;
            }
            alert('提交问题成功！您可以去消息中心[我的问题]查看该问题信息！');
        });
    })

    function showchange() {
        var len = parseInt($.trim($('textarea[name=Desc]').val()).length);
        if (len <= 200) {
            var sy = 200 - len;
            $('#showspan').text('还可以输入' + sy + '字');
        } else {
            var sy = len - 200;
            $('#showspan').html('已超过<font color="red">' + sy + '</font>字');
        }
    }
</script>
