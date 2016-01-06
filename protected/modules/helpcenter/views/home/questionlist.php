<p class="fw padding10 wz" style="border-bottom: 2px solid #CCCCCC">
    <span><a href="javascript:void(0)" onclick="goback()" style="color: #0077FF;font-size: 12px;">问题首页</a></span>>
<!--    <span><a href="javascript:void(0)" onclick="dalei(<?php echo $daleiID['ID'] ?>)"style="color: #0077FF;font-size: 12px;"><?php echo $daleiID['TypeName'] ?></a></span>
    >-->
    <span><a href="javascript:void(0)" style="color: #888888;font-size: 12px;"><?php echo $cshequesID['TypeName'] ?></a></span>
</p>
<div style="height:auto!important;overflow: hidden;clear: both">
    <p class="fw padding10 wz">常见问题</p>
    <?php if (empty($jutiques)): ?>
        <p class="fw padding10 wz">抱歉,未能找到该问题。</p>
    <?php endif; ?>
    <ul class="question">
        <?php
        foreach ($jutiques as $k => $v):
            $TypeID = CsHelpQuestion::model()->findByPk($v['ID']);
            $ID = CsHelpQuestionType::model()->findByPk($TypeID['TypeID']);
            ?>
            <li><a href="javascript:void(0)" onclick="look(<?php echo $v['ID'] . ',' . $ID['ID'] ?>)" ><?php echo $v['Title'] ?></a></li>
        <?php endforeach; ?>
        <div class="clear"></div>
    </ul>
</div>
<script>
    function look(ID,typeID){
        $("#"+typeID).parent().parent().find('span a').removeClass('ren_current');
        $("#"+typeID).parent().parent().removeClass('expandable');
        $("#"+typeID).parent().parent().addClass('collapsable');
        $("#"+typeID).parent().parent().find("div:first").removeClass('expandable-hitarea');
        $("#"+typeID).parent().parent().find("div:first").addClass('collapsable-hitarea');
        $("#"+typeID).parent().parent().find('ul').css('display','block');
        $("#"+typeID+" span a").addClass("ren_current");
        $.post(
        Yii_baseUrl+"/helpcenter/home/questiondetail",
        {ID:ID},
        function(result){
            $('#bottm_fenlei').css('display','none');
            $(".detail").html(result);
        }); 
    }
    function dalei(ID){
        $.post(
        Yii_baseUrl+"/helpcenter/home/questionlist",
        {typeid:ID},
        function(result){
            $(".hyzx_lm2_info").html(result);
        }); 
    }
    function goback(){
        var url=Yii_baseUrl+"/helpcenter/home/question";
        window.location.href=url;  
    }
</script>