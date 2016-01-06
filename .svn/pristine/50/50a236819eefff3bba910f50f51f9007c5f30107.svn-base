<style>
    .row label {
        display: inline-block;
        margin-right: 0;
        text-align: right;
        width: 110px !important;
    }
</style>

<?php
$this->pageTitle = Yii::app()->name . ' - 发货公告管理';
if (Yii::app()->user->Identity == "maker") {
    $url = Yii::app()->createUrl("");
} elseif (Yii::app()->user->Identity == "dealer") {
    $url = Yii::app()->createUrl("common/dealmemberlist");
} else {
    $url = Yii::app()->createUrl("common/memberlist");
}
$this->breadcrumbs = array(
    '用户中心' => $url,
    '发货公告管理' => Yii::app()->createUrl('member/sendnotice/index'),
    '添加发货公告'
);
?>

<!--内容部分-->
<div class="bor_back m_top10">
    <p class="txxx">填写基本信息
        <span style="float:right; margin-right:20px;*margin-top:-35px">
            <a id="return" style="font-weight:400" href="javascript:void(0)">返回</a>
        </span>
    </p>
    <div class="txxx_info">
        <div class='form'>
            <form action="<?php echo Yii::app()->createUrl('member/sendnotice/addsave'); ?>" method="post">
                <div class='row' style="display:none">
                    <input name="OrganID" value="<?php echo Yii::app()->user->getOrganID() ?>"/>
                </div>
                <div class="txxx_info2 m-top" style="clear:both">
                    <span class="f_weight float_l " style=" margin-right: 5px">详细说明：</span>
                    <div class="float_l " style="width:730px; height:400px; border:1px solid #f0f0f0"> 
                        <textarea style="width:728px; height:398px; border:1px solid #f0f0f0" id="Info" name="Content"></textarea>
                    </div>
                    <div style="clear:both"></div>
                </div>
                <div class='row' style="padding-left:200px;margin-bottom:10px;">
                    <input class='submit' type='submit' id="save" value='保存'/>
                </div>
            </form>
        </div>
    </div>

</div>
<!--内容部分结束-->
<script type="text/javascript">
    $(document).ready(function() {
//        $("#save").click(function() {
//
////            $('#save').attr('disabled', 'disabled');
//            //$("#financial-form").submit();
//
//        });

        $("#return").live('click', function() {
            window.location.href = "<?php echo Yii::app()->createUrl('member/Sendnotice/index'); ?>";
        });
    })
</script>
<?php
$this->widget('ext.kindeditor.KindEditorWidget', array(
    'id' => 'Info',
));
?>

<script>
    var editor;
    KindEditor.ready(function(K) {
        editor = K.create('#Info', {
            resizeType: 2,
            //            cssPath: ['../plugins/code/prettify.css', 'index.css'],
            allowPreviewEmoticons: false,
            allowImageUpload: false,
            items: [
                //                'fontname', 'fontsize', '|', 'forecolor', 'hilitecolor', 'bold', 'italic', 'underline',
                //                'removeformat', '|', 'justifyleft', 'justifycenter', 'justifyright', 'insertorderedlist',
                //                'insertunorderedlist']
                'fontname', 'fontsize', '|', 'bold', 'italic', 'underline',
                'removeformat', '|', 'justifyleft', 'justifycenter', 'justifyright', 'insertorderedlist',
                'insertunorderedlist']
        });
    })

</script>