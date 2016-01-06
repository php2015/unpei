<style>
    .sdds{
        vertical-align: top;
    }
</style>
<?php
$this->breadcrumbs = array(
    '用户中心' => Yii::app()->createUrl('common/dealmemberlist'),
    '主营信息管理'=> Yii::app()->createUrl('dealer/Mainbusiness/Index'),
    '添加主营品牌'
);
?>

<!--内容部分-->
<div class="bor_back m_top10">
    <p class="txxx">填写基本信息
        <span class="float_r" style="margin-right:20px ;*margin-top:-35px">
            <a href="<?php echo Yii::app()->createUrl('/dealer/Mainbusiness/index'); ?>" class="color_blue" style="font-weight:400">返回列表</a>
        </span>
    </p>
    <div class="txxx_info">
        <div class='form'>
            <form id="mainbusiness" method="post">
                <div class='row'>
                    <label class="label">品牌名称：</label>
                    <input id="BrandName" class="width213 input" type="text" maxlength="24" name="BrandName">
                </div>
                <div class='row'>
                    <label class="label">拼音代码：</label>
                    <input id="Pinyin" class="width213 input" type="text" maxlength="24" name="Pinyin">
                </div>
                <div class='row'>
                    <label class="sdds">描述：</label>
                    <textarea name="Description"　class="textarea2" style="margin-left:5px;width: 265px;height: 80px; border:1px solid #ebebeb;resize:none"></textarea>
                </div>
                <div class='row' style="padding-left:200px;margin-bottom:10px;">
                    <input class='submit' type='button' id="save" value='保存'/>
                </div>
            </form>
        </div>
    </div>
</div>
<!--内容部分结束-->

<script type="text/javascript">
    $(document).ready(function(){
        $("#save").click(function(){
            if(window.confirm("您确定要保存吗?"))
            {
                $("#mainbusiness").attr("action",Yii_baseUrl+"/dealer/Mainbusiness/Brandadd");
                $("#mainbusiness").submit();
            }
        });
        //获得拼音

        $("input[name=BrandName]").blur(function(){
            var name = $(this).val();
            var url = Yii_baseUrl+'/pap/dealergoods/Getpinyin';
            $.getJSON(url,{name:name},function(a){
                $("#Pinyin").val(a);
            })
        })
    })
</script>
