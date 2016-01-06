<?php
$this->pageTitle = Yii::app()->name . ' - ' . "客服平台";
$this->breadcrumbs = array(
    '客服平台' => Yii::app()->createUrl('dealer/customer/index'),
    '提交问题'
);
?>
<link rel="stylesheet" href="<?php echo F::themeUrl(); ?>/js/uploadify/uploadify1.css">
<style>
    .uploadify-button-text{color:#fff}
    .title_lm li a {
        color: #0164C1;
        float: left;
        font-size: 14px;
        text-align: center;
    }
    .row {
        margin:8px 0px;
    }
    .row label {
        display: inline-block;
        margin-right: 0;
        text-align: right;
        width: 110px !important;
    }
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
        margin-left: 120px;
    }
    .uploadify-queue{
        display:none;
    }
    .txxx {
        height: 35px;
        line-height: 35px;
        text-indent: 15px;
        border-bottom: 1px solid #c9d5e3;
        font-size: 14px;
        font-weight: bold;
    }
</style>
<div class="bor_back m-top">
    <div style="margin:10px 0px"> </div>
    <div class="m_top10" style="margin:10px 20px;">
        <form action="<?php echo Yii::app()->createUrl("dealer/customer/submit"); ?>" method="post">
            <div class='row'>
                <label class='label'>标&nbsp;&nbsp;&nbsp;&nbsp;题：</label>
                <input class='width250 input' name="Title" maxlength="20">
                <span style="color:red">*</span>
            </div>
            <div class='row'>
                <label class='label'>问题类型：</label>
                <select class='width60 select' name="Type">
                    <option value='1'>账号问题</option>
                    <option value='2'>交易问题</option>
                    <option value='3'>商品问题</option>
                    <option value='4'>数据问题</option>
                    <option value='5'>意见和建议</option>
                    <option value='6'>其他</option>
                </select>
                 <span style="color:red">*</span>
            </div>
            <div class='row'>
                <label class='label' style="vertical-align:top;">描&nbsp;&nbsp;&nbsp;&nbsp;述：</label>
                <textarea style="width:500px;margin-left:5px;" rows="5" name="Desc"  maxlength="200" size="255"></textarea><span id="showspan">(最多200字)</span>
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
                <input class='m_left submit' type='submit' value="保存">
            </div>
        </form>
    </div>
</div>
<?php $this->renderpartial('upload'); ?>
<script>
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
        $("#file_upload").addClass('uploadalign');
//        $('textarea[name=Desc]').live('input propertychange', function() {
//            showchange();
//        })

        $(".submit").click(function() {
            fileaddhide();
            if ($("input[name=Title]").val() == "") {
                alert("标题不能为空！");
                $("input[name=Title]").addClass("input1");
                return false;
            }
            if ($("textarea[name=Desc]").val() == "") {
                alert("描述不能为空！");
                $("textarea[name=Desc]").addClass("input1");
                return false;
            }
            if (($('textarea[name=Desc]').val()).length > 200) {
                $("textarea[name=Desc]").addClass("input1");
                return false;
            }
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