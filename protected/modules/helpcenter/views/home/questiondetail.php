<style>
.answer-info em{  font-style:italic }
.answer-info strong em{  font-style:italic;font-weight:bold; }
.answer-info ol li{ list-style:decimal}
.answer-info ul li{ list-style:disc}
</style>
<div class=" float_r width795">
    <div class="fw padding10 wz border" id="detailTitle" >
        <span><a href="javascript:void(0)" onclick="goback()" style="color: #0077FF;font-size: 12px;">问题首页</a></span>>
<!--<span><a href="javascript:void(0)" onclick="dalei(<?php echo $daleiID['ID'] ?>)"style="color: #0077FF;font-size: 12px;"><?php echo $daleiID['TypeName'] ?></a></span>
-->        
<span><a href="javascript:void(0)" onclick="xiaolei(<?php echo $xiaoleiID['ID'] ?>)"style="color: #0077FF;font-size: 12px;"><?php echo $xiaoleiID['TypeName'] ?></a></span>>
        <span><a href="javascript:void(0)" style="color: #888888;font-size: 12px;"><?php echo $detail['Title'] ?></a></span>
    </div>
    <div class=" xiangqing hyzx_lm2_info subway border" style="height:auto!important;overflow: hidden;clear: both ">
        <div style="font-size:20px;font-weight: bolder;font-family: '微软雅黑';text-align: center">
            <p style="margin-top: 20px;"><?php echo $detail['Title'] ?></p>
        </div>
        <br />
        <div style=" text-indent: 10px; margin:10px 30px" class="answer-info">
            <?php echo html_entity_decode($detail['Answer']) ?>
            <?php // echo preg_replace('/(<img src=\"?.+)(\/unipei_help\/)(.+\.(jpg|gif|bmp|bnp|png)\"?.+>)/i',"\${1}".Yii::app()->params['helpPath']."\${3}",html_entity_decode($detail['Answer'])); ?>
        </div>
    </div>
    <div class="subway border m_top10" id="bottm_fenlei" style="display:none">
        <div  class="category">
            <?php foreach ($select as $key => $val): ?>
                <dl>
                    <dt><?php echo $val['text'] ?></dt> 
                    <?php if (!empty($val['children'])): ?>
                        <?php foreach ($val['children'] as $k => $v): ?>
                            <dd>
                                <span id="type_<?php echo $v['id'] ?>">
                                    <?php echo $v['text'] ?>
                                </span>
                            </dd>
                        <?php endforeach; ?>
                    <?php endif; ?>
                </dl>
            <?php endforeach; ?>
            <div class="clear"></div>
        </div>
    </div>
</div>
<script>
    function goback(){
        var url=Yii_baseUrl+"/helpcenter/home/question";
        window.location.href=url;  
    }
    function dalei(ID){
        $.post(
        Yii_baseUrl+"/helpcenter/home/questionlist",
        {typeid:ID},
        function(result){
            $('#detailTitle').css('display','none'); //详情页点击树菜单 详情页的头部导航影藏
            $(".hyzx_lm2_info").html(result);
        }); 
    }
    function xiaolei(ID){
        $("#"+ID).parent().parent().removeClass('expandable');
        $("#"+ID).parent().parent().addClass('collapsable');
        $("#"+ID).parent().parent().find("div:first").removeClass('expandable-hitarea');
        $("#"+ID).parent().parent().find("div:first").addClass('collapsable-hitarea');
        $("#"+ID).parent().parent().find('ul').css('display','block');
        $("#"+ID+" span a").addClass("ren_current");
        $.post(
        Yii_baseUrl+"/helpcenter/home/questionlist",
        {typeid:ID},
        function(result){
            $('#detailTitle').css('display','none'); //详情页点击树菜单 详情页的头部导航影藏
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
                //                $('#type_'+id).css('color','red');
                //                $('#bottm_fenlei').css('display','none');
                $('#detailTitle').css('display','none'); //详情页点击树菜单 详情页的头部导航影藏
                $(".hyzx_lm2_info").html(result);
            }); 
        });
        //点击时让输入框清空
        $("input[name=Title]").click(function(){
            var Title =$(this).val();
            if(Title=='输入关键字'){
                $(this).val('');
            }
        })
        $("input[name=Title]").blur(function(){
            var Title =$(this).val();
            if(Title==''){
                $(this).val('输入关键字');
            }
        })

    })
</script>