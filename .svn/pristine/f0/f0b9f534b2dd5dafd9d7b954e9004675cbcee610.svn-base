<style>
    .side-left li{ background:url(<?php echo F::themeUrl() ?>/images/helpcenter/tubiao.png) #fcfcfc no-repeat 10px -49px; height:29px; line-height:29px; text-indent:30px; border-bottom:1px solid #ebedec}
    .side-left li.current{ background-position:10px -19px}
    .side-left li.current a{ font-weight:bold; color:#0266bc}
    .Secondary{ border-bottom:1px solid #ebedec; display:none }
    .Secondary p{ background:url(<?php echo F::themeUrl() ?>/images/helpcenter/tubiao.png) no-repeat 20px 0px; text-indent:40px}
    .Secondary a:hover{ color:#0266bc}
    .question{ margin:0px 10px 10px; zoom:1}
    .question li{ width:48%; float:left; background:url(<?php echo F::themeUrl() ?>/images/helpcenter/tubiao.png) no-repeat 10px -230px; text-indent:25px}
    .question li a:hover{ color:#0266bc}
    .category{margin:0px 10px 10px;}
    .category dl{ float:left; width:48%; margin:5px }
    .category dl dt{ font-weight:bold}
    .category dl dd { float:left; padding:3px 20px 3px 0px}
    .category dl dd a{color:#0164c1}
    .sousuo{background:url(<?php echo F::themeUrl() ?>/images/helpcenter/tubiao.png) no-repeat #fff -188px -43px; border:1px solid #ccc;width:310px; margin:3px; height:25px; text-indent:30px ; color:#a5a5a5; outline:none; padding:1px}
    .botton{
        background:url(<?php echo F::themeUrl() ?>/images/helpcenter/tubiao.png) no-repeat -167px -84px; height:30px; width:70px; border:none; color:#fff; font-weight:bold; font-size:14px
    }

    .bumen{ text-indent:2em;  height:20px; line-height:20px;cursor:pointer;display:block; }
    .ren{ display:inline-block;text-indent:20px;height:20px; line-height:20px;color:black}
    .ren_current{color:#73a6d5;font-weight:bold  }
    .noques{
        font-size: 14px;
        font-family: '微软雅黑';
    }
</style>
<div class="contents ">
    <form method="get" target="_self"  action="<?php echo Yii::app()->createUrl('helpcenter/home/searchlist') ?>">
        <div class="box-sousuo">
            <input type="text" value="<?php echo $TitleName ? str_replace('<<q>>', '/', $TitleName) : '请输入关键字' ?>"  class="sousuo input" name="Title"/>
            <input type="submit" class="botton" value="搜 索" style="cursor:pointer"/>
        </div>
    </form>
    <div class="m_top10" style=" margin-bottom: 10px;">
        <?php if (!empty($queslist)): ?>
            <div class="float_l  width190">
                <div class="box">
                    <div class="box_lm">常见问题分类</div>
                    <div class="box_info">
                        <?php
                        $this->widget('CTreeView', array(
                            'persist' => 'cookie',
                            'animated' => 'fast',
                            'url' => array('ajaxFillTree'),
                            'htmlOptions' => array(
                                'id' => 'coverageTree',
                                'class' => 'coverageTree'
                            )
                        ));
                        ?>
                    </div>
                </div> 
            </div>
        <?php endif; ?>

        <?php if (!empty($queslist)): //如果有该问题?>
            <div class=" float_r width795  detail " >
                <div class="hyzx_lm2_info subway border" >
                    <ul>
                        <?php foreach ($queslist as $key => $value): ?>
                            <?php
                            $TypeID = CsHelpQuestion::model()->findByPk($value['ID']);
                            $ID = CsHelpQuestionType::model()->findByPk($TypeID['TypeID']);
                            ?>
                            <?php if (!empty($ID['ID'])): ?>
                                <li style="margin: 20px;">
                                    <a href="javascript:void(0)" style="color:blue; text-decoration: underline;font-family: '微软雅黑';font-size: 14px;" onclick="look1(<?php echo $value['ID'] . ',' . $ID['ID'] ?>)"><?php echo $value['Title'] ?></a>
                                    <p><span style="font-family:'微软雅黑';"><?php echo html_entity_decode($value['Answer']) ?></span></p>
                                </li>
                            <?php endif; ?>
                        <?php endforeach; ?>
                                
                        <?php //if (empty($ID['ID'])):  //如果问题的类别被删除了?>  
<!--                            <div style="margin: 20px">
                                <div class="noques" style="font-size:20px;">抱歉，您查找的问题不存在或已被删除！</div>
                                <br />
                                <div class="noques">我们建议您：</div>
                                <div class="noques">1、查看<span style="color:#4096EE;cursor:pointer" onclick="searchlist()">问题首页。</span></div>
                                <div class="noques">2、看看输入的文字是否有误。</div>
                                <div class="noques">3、去掉可能不必要的字词如“的”、“吗”等。</div>
                            </div>-->
                        <?php //endif; ?>
                    </ul>
                </div>
            </div>
            <div class="clear"></div>
        <?php else: //如果没有改问题?>
            <div style="margin: 20px">
                <div class="noques" style="font-size:20px;">抱歉没有找到相关的帮助内容。</div>
                <br />
                <div class="noques">我们建议您：</div>
                <div class="noques">1、联系在线客服。</div>
                <div class="noques">2、看看输入的文字是否有误。</div>
                <div class="noques">3、去掉可能不必要的字词如“的”、“吗”等。</div>
            </div>
        <?php endif; ?>
    </div>
</div>
<script>
    $(document).ready(function(){
        $("#coverageTree .type").live('click',function(){  //左边树桩菜单点击
            var id= $(this).parent().parent().attr('id');
            $("#coverageTree .type").removeClass("ren_current");
            $(this).addClass("ren_current");
            $.post(
            Yii_baseUrl+"/helpcenter/home/questionlist",
            {typeid:id},
            function(result){
                $('#bottm_fenlei').css('display','none');
                $(".hyzx_lm2_info").html(result);
            }); 
        });
    })
        
    function searchlist(){
        var url=Yii_baseUrl+"/helpcenter/home/question";
        window.location.href=url; 
    }
    function look1(ID,typeID){
        //    alert(typeID);return false;
        $("#"+typeID+" span a").addClass("ren_current");
        $("#"+typeID).parent().parent().removeClass('expandable');
        $("#"+typeID).parent().parent().addClass('collapsable');
        $("#"+typeID).parent().parent().find("div:first").removeClass('expandable-hitarea');
        $("#"+typeID).parent().parent().find("div:first").addClass('collapsable-hitarea');
        $("#"+typeID).parent().parent().find('ul').css('display','block');
        $.post(
        Yii_baseUrl+"/helpcenter/home/questiondetail",
        {ID:ID},
        function(result){
            $(".detail").html(result);
        }); 
    }
        
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
</script>