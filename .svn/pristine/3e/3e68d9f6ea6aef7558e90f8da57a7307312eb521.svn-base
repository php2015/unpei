<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->theme->baseUrl ?>/css/help/addquestion.css" />
<div class="contents">
    <div class="box-step">
        <div class="step float_l">提交问题流程</div>
        <div class="step1 float_l  current">1、选择问题类型</div>

        <div class="jg float_l"><img src="<?php echo F::themeUrl() ?>/images/helpcenter/jg.jpg"></div>
        <div class="step1 float_l">2、选择具体问题</div>
        <div class="jg float_l"><img src="<?php echo F::themeUrl() ?>/images/helpcenter/jg.jpg"></div>
        <div class="step1 float_l">3、填写问题描述</div>


    </div>
    <div class="m_top10 padding10 border">
        <p class="fw padding10 wz">1、选择您的问题类型</p>
        <div class="padding15">
            <?php foreach ($questype as $v): ?>
                <div class=" float_l question-class " >
                    <a href="javascript:void(0)"  title="<?php echo $v['TypeName'] ?>"onclick="xuanze('<?php echo $v['ID'] ?>')">
                        <div class="question-info1" style="white-space: nowrap;overflow: hidden; text-overflow: ellipsis;">
                            <?php echo $v['TypeName'] ?>
                        </div>
                    </a>
                </div>
            <?php endforeach; ?>
            <div class="clear"></div>
        </div>
    </div>  
</div>
<script>
    function xuanze(ID){ 
        var url = Yii_baseUrl+'/helpcenter/home/addquestion2/ID/'+ID;
        window.location.href=url;  
    }
</script>