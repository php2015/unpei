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

</style>
<!--<link rel="stylesheet" href="<?php echo F::themeUrl(); ?>/css/jpd/jxs.css" />-->
<div class="contents">
    <form method="get" target="_self"  action="<?php echo Yii::app()->createUrl('helpcenter/home/searchlist') ?>">
        <div class="box-sousuo">
            <input type="text" value="请输入关键字"  class="sousuo input" name="Title"/>
            <input type="submit" class="botton" value="搜 索" />
        </div>
    </form>

    <div class="m_top10">
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
        <div class=" float_r width795 kuaijjie detail " >
            <div class=" xiangqing hyzx_lm2_info subway border">
                <p class="fw padding10 wz">热门问题</p>
                <ul class="question">
                    <?php foreach ($hotques as $key => $value): ?>
                        <?php
                        $TypeID = CsHelpQuestion::model()->findByPk($value['ID']);  //问题表 TypeID
                        $ID = CsHelpQuestionType::model()->findByPk($TypeID['TypeID']); //类型表ID
                        ?>
                        <?php if (!empty($ID['ID'])): ?>
                            <li style="float:left;"><a href="javascript:void(0)" onclick="look(<?php echo $value['ID'] . ',' . $ID['ID'] ?>)" ><?php echo $value['Title'] ?></a></li>
                        <?php endif; ?>
                    <?php endforeach; ?>
                    <div class="clear"></div>
                </ul>
            </div>
            <div class="subway border m_top10" id="bottm_fenlei">
                <div  class="category">
                    <?php foreach ($select as $key => $val): ?>
                        <dl>
                            <dt><?php echo $val['text'] ?></dt> 
                            <?php if (!empty($val['children'])): ?>
                                <?php foreach ($val['children'] as $k => $v): ?>
                                    <dd>
                                        <span id="type_<?php echo $v['id'] ?>">
                                            <a href="javascript:void(0)" onclick="changjian(<?php echo $v['id'] ?>)"><?php echo $v['text'] ?></a>
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
        <div class="clear"></div>
    </div>
</div>
<script>
    function changjian(ID){
        //        var url=Yii_baseUrl+"/helpcenter/home/questionlisttt/typeid/"+ID;
        //        //        alert(ID);
        $("#"+ID).parent().parent().removeClass('expandable');
        $("#"+ID).parent().parent().addClass('collapsable');
        $("#"+ID).parent().parent().find("div:first").removeClass('expandable-hitarea');
        $("#"+ID).parent().parent().find("div:first").addClass('collapsable-hitarea');
        $("#"+ID).parent().parent().find('ul').css('display','block');
        $("#"+ID+" span a").addClass("ren_current");
        $.post(
        Yii_baseUrl+"/helpcenter/home/questionlisttt",
        {typeid:ID},
        function(result){
            $('#bottm_fenlei').css('display','none');
            $(".kuaijjie").html(result);
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
    function look(ID,typeID){      
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
    
</script>