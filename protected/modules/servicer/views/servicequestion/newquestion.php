<link rel="stylesheet" href="<?php echo F::themeUrl(); ?>/js/uploadify/uploadify1.css">
<style>
    .gs_info p{ line-height:23px; margin-top:15px}
    .gs_info span{ margin-left:10px;}
    .visitor{display:none;}
    .redremind{border:1px solid red !important;}
    .fail{color:red;display:none}
    .ylr {
        background: none repeat scroll 0 0 #eff4fa;
        padding: 15px 10px 10px;
        margin-left:70px;
        width: 660px;
    }
    .ylr_ul {min-height:30px;height:auto}
    .ylr_ul li {width:40%;float:left;margin-right:10px;}
    .uploadify-queue{display:none}
    .txxx {
        height: 35px;
        line-height: 35px;
        text-indent: 15px;
        border-bottom: 1px solid #c9d5e3;
        font-size: 14px;
        font-weight: bold;
    }
</style>
<?php
$this->pageTitle = Yii::app()->name . ' - 新建问题';
$this->breadcrumbs = array(
    '客服' => Yii::app()->createUrl('servicer/servicequestion/wait'),
    '新建问题'
);
//经销商列表
$dealersql = 'select ID,OrganName from jpd_organ where Identity=2';
$dealer = Yii::app()->jpdb->createCommand($dealersql)->queryAll();
$dealerlists = CHtml::listData($dealer, "ID", "OrganName");

//服务店列表
$servicesql = 'select ID,OrganName from jpd_organ where Identity=3';
$service = Yii::app()->jpdb->createCommand($servicesql)->queryAll();
$servicelists = CHtml::listData($service, "ID", "OrganName");
?>
<input name="CompanyName" id="CompanyName" type="hidden">
<input name="FileName" id="FileName" type="hidden">
<input name="FileUrl" id="FileUrl" type="hidden">
<div class="bor_back m-top" style="margin:20px 0px 0px 20px">

    <div class="m_left80 gs_info" style="margin-bottom:10px;">         
        <p>
            <label>问题类型：</label>
            <select  name="Type" class="select" style="width:258px;background:#ffffff">
                <option value="1">帐号问题</option>
                <option value="2">交易问题</option>
                <option value="3">商品问题</option>
                <option value="4">数据问题</option>
                <option value="5">意见和建议</option>
                <option value="6">其它</option>
            </select>                       
        </p>
        <p>
            <label style="margin-left:23px;">标题：</label>
            <input type="text" name="Title" maxlength="20" class="width250 input required">  
            <span style="color:red;margin-left:3px;">(*)</span>
        </p>
        <p>
            <label style="vertical-align:top">问题描述：</label>
            <textarea id="Desc" name="Desc" class="textarea" style="width:670px;height:100px;" maxlength="200" size="255"></textarea>
        </p>
        <div style="margin-top: 15px;">
            <div class="float_l" style="vertical-align:top">附件：</div>
            <div class="float_l" style="margin-left:10px">
                <input type='file' name='file_upload' id="file_upload">
            </div>
        </div>
        <div style="clear:both"></div>
        <div class="ylr" id="showfile" style="display:none;">
            <b>已上传附件</b><span style="color:red;">(最多只能上传5个附件)</span>
            <ul class="ylr_ul" id="addul">
            </ul>
            <div style="clear:both;"></div>
        </div>
        <p style="padding-left:200px;"><button class="submit" id="save">保存</button></p>
    </div>  
</div>
<?php
$this->beginWidget('zii.widgets.jui.CJuiDialog', array(
    'id' => 'reminddg', //弹窗ID  
    'options' => array(//传递给JUI插件的参数  
        'title' => '操作提示',
        'autoOpen' => false, //是否自动打开  
        'width' => '300px', //宽度  
        'height' => 'auto', //高度  
        'buttons' => array(
            '关闭' => 'js:function(){ $(this).dialog("close");}', //关闭按钮  
        ),
    ),
));

$this->endWidget('zii.widgets.jui.CJuiDialog');
?>
<?php
$this->widget('ext.kindeditor.KindEditorWidget', array(
    'id' => 'Desc',
));
?>
<script type="text/javascript" src="<?php echo Yii::app()->theme->baseUrl; ?>/js/jpd/jquery.form.js"></script>
<script>
    var editor;
    KindEditor.ready(function(K) {
        editor = K.create('#Desc', {
            resizeType: 2,
            //            cssPath: ['../plugins/code/prettify.css', 'index.css'],
            allowPreviewEmoticons: false,
            allowImageUpload: false,
            items: [
                //                'fontname', 'fontsize', '|', 'forecolor', 'hilitecolor', 'bold', 'italic', 'underline',
                //                'removeformat', '|', 'justifyleft', 'justifycenter', 'justifyright', 'insertorderedlist',
                //                'insertunorderedlist']
                'fontname', '|', 'bold', 'italic', 'underline',
                'removeformat', '|', 'justifyleft', 'justifycenter', 'justifyright', 'insertorderedlist',
                'insertunorderedlist']

        });
    })
</script>
<script>
    $(function() {
        //必填项提示
        $('.required').blur(function() {
            if ($(this).val() == '') {
                $(this).addClass('redremind');
            } else {
                $(this).removeClass('redremind');
            }
        })
    })

    $("#save").click(function() {
        editor.sync();
        var Type = $("select[name=Type]").val();
        var Title = $("input[name=Title]").val();
        var Desc = $("#Desc").val();
        if (!Title) {
            $("input[name=Title]").addClass('redremind');
            return false;
        }
        if (!Desc) {
            alert('请输入问题描述')
            return false;
        }
        if (!Title || !Desc) {
            return false
        }
        var files = new Array();
        var exitfile = false;
        $("#addul").find('li').each(function(r, g) {
            if ($(this).text()) {
                exitfile = true
            }
            var names = $(this).find('a').attr('filename');
            var fileurl = $(this).find('a').attr('path')
            var huancun = new Array();
            huancun.push(names);
            huancun.push(fileurl);
            files.push(huancun);
        })
        if (exitfile == false) {
            files = '';
        }
        //        $("#save").attr("disabled","true");
        $("#save").attr({"disabled": "disabled"})
        $.ajax({
            url: '<?php echo Yii::app()->createUrl('servicer/servicequestion/savequestion') ?>',
            data: {'Type': Type, 'Title': Title, 'Desc': Desc, 'files': files},
            type: 'post',
            dataType: 'json',
            success: function(reg) {
                if (reg.success == true) {
                    window.location.href = '<?php echo Yii::app()->baseUrl . '/servicer/servicequestion/wait' ?>'
                }
            }
        })
        $("#save").removeAttr("disabled");
    })
</script>
<?php $this->renderpartial('upload'); ?>