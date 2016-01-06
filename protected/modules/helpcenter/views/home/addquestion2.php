<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->theme->baseUrl ?>/css/help/addquestion.css" />
<style>
    /*    .active{
            color:red;
        }*/
    .yanse{
        color:red;
    }
</style>
<div class="contents">
    <div class="box-step">
        <div class="step float_l">提交问题流程</div>
        <div class="step1 float_l ">1、选择问题类型</div>

        <div class="jg float_l"><img src="<?php echo F::themeUrl() ?>/images/helpcenter/jg.jpg"></div>
        <div class="step1 float_l current">2、选择具体问题</div>
        <div class="jg float_l"><img src="<?php echo F::themeUrl() ?>/images/helpcenter/jg.jpg"></div>
        <div class="step1 float_l">3、填写问题描述</div>


    </div>
    <div class="m_top10 padding10 border">
        <div class="fw padding10 wz bor_bottom"><span class=" float_l">1、您的问题：<em class="choice-question"><?php echo $questype['TypeName'] ?></em></span><span class="float_r editor"><a href="javascript:void(0)" onclick="goback()">返回修改问题类型</a></span><div class="clear"></div></div>
        <p class="fw padding10 wz">2、选择具体问题</p>
        <div>
            <ul class="question">
                <li><a href="" class="fw">选择您的问题：</a></li> 
                <div class="clear"></div>
            </ul>
            <div class="question-info  padding15 " style="padding-top:0px; margin-left:10px;width: 500px;">
                <ul>
                    <?php if (!empty($jutiques)): ?>
                        <?php foreach ($jutiques as $k => $v): ?>
                            <li style="width:230px;">
                                <a href="javascript:void(0)" class="<?php echo $k == 0 ? 'yanse' : '' ?>" onclick="look(<?php echo $v['ID'] ?>)" id="title_<?php echo $v['ID'] ?>"><?php echo $v['Title'] ?></a>
                            </li>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <span style="color:red">对不起,该问题类型下面没有设置问题!</span>
                    <?php endif; ?>
                    <div class="clear"></div>
                </ul>
            </div>
            <ul class="question">
                <li><a href="" class="fw">根据您的问题，我们建议您：</a></li> 
                <div class="clear"></div>
            </ul>
            <div class=" answer padding15" >
                <?php if (!empty($jutiques)): ?>
                    <?php foreach ($jutiques as $key => $v1): ?>
                        <div>
                            <span class="answerss" style="<?php if ($key != 0) echo 'display:none;' ?>" id="answer_<?php echo $v1['ID'] ?>">
                                <?php echo html_entity_decode($v1['Answer']) ?>
                            </span>
                        </div>
                    <?php endforeach; ?>
                <?php endif; ?>
            </div>
            <p class="add"><span>我们的建议没有解决您的问题?</span><button style=" cursor:pointer"class="botton botton2" onclick="gocheck('<?php echo $questype['ID'] ?>')">立即填描述，提交问题</button></p>
        </div>
    </div>  
</div>
<script>
    function goback(){   //返回修改问题类型
        var url = Yii_baseUrl+'/helpcenter/home/addquestion';
        window.location.href=url;  
    }
    function gocheck(ID){  //提交问题
        var url = Yii_baseUrl+'/helpcenter/home/addquestion3/ID/'+ID;
        window.location.href=url;  
    }
    function look(ID){
        $(".question-info").find('li a').removeClass('yanse');
        $("#title_"+ID).addClass('yanse');
        
        $(".answerss").hide();
        $('#answer_'+ID).show();
    }
    
      

</script>