<div class=" float_r width795 " >
    <div class="fw padding10 wz border" id="queslitttttTitle" >
        <span><a href="javascript:void(0)" onclick="goback()" style="color: #0077FF;font-size: 12px;">问题首页</a></span>>
<!--        <span><a href="javascript:void(0)" onclick="dalei(<?php echo $daleiID['ID'] ?>)"style="color: #0077FF;font-size: 12px;"><?php echo $daleiID['TypeName'] ?></a></span>
        >-->
        <span><a href="javascript:void(0)" style="color: #888888;font-size: 12px;"><?php echo $xiaoleiID['TypeName'] ?></a></span>
    </div>
    <div class=" xiangqing hyzx_lm2_info subway border"  style="height:auto!important;overflow: hidden; clear: both">
        <p class="fw padding10 wz">常见问题</p>
        <?php if (empty($jutiques)): ?>
            <p class="fw padding10 wz">抱歉,未能找到该问题。</p>
        <?php endif; ?>
        <ul class="question">
            <?php foreach ($jutiques as $k => $v): ?>
                <li ><a href="javascript:void(0)" onclick="look(<?php echo $v['ID'] ?>)" ><?php echo $v['Title'] ?></a></li>
            <?php endforeach; ?>
            <div class="clear"></div>
        </ul>
    </div>
</div>
<script>
    function look(ID){
        $.post(
        Yii_baseUrl+"/helpcenter/home/questiondetail",
        {ID:ID},
        function(result){
            $('#bottm_fenlei').css('display','none');
            $(".detail").html(result);
        }); 
    }
    function goback(){
        var url=Yii_baseUrl+"/helpcenter/home/question";
        window.location.href=url;  
    }
    function dalei(ID){
        $.post(
        Yii_baseUrl+"/helpcenter/home/questionlist",
        {typeid:ID},
        function(result){
            $('#queslitttttTitle').css('display','none'); 
            $(".hyzx_lm2_info").html(result);
        }); 
    }

    $(document).ready(function(){
        $("#coverageTree .type").live('click',function(){
            var id= $(this).parent().parent().attr('id');
            $("#coverageTree .type").removeClass("ren_current");
            $(this).addClass("ren_current");
            
            $.post(
            Yii_baseUrl+"/helpcenter/home/questionlist",
            {typeid:id},
            function(result){
                $('#queslitttttTitle').css('display','none'); //快捷菜单页面 点击树菜单 快捷页面头部标签影藏
                $('#bottm_fenlei').css('display','none');
                $(".hyzx_lm2_info").html(result);
            }); 
        });
        //点击时让输入框清空
        $("input[name=Title]").click(function(){
            var Title =$(this).val();
            if(Title=='请输入关键字'){
                $(this).val('');
            }
        })
        $("input[name=Title]").blur(function(){
            var Title =$(this).val();
            if(Title==''){
                $(this).val('请输入关键字');
            }
        })

    })
</script>