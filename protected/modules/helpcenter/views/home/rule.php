
<style>
    .xb_box{ background: url(<?php echo Yii::app()->theme->baseUrl; ?>/images/xb-head.jpg) repeat-x;}
    .xb_box_ul li{background: url(<?php echo Yii::app()->theme->baseUrl; ?>/images/xb.png) no-repeat 4px -37px; text-indent:20px; height:20px; line-height:20px }
    .xb_box_ul li.current{ background-position:4px 8px;color:#3f97f0}
    .detail ul li{list-style:disc;}
    /*ol,ul,li{list-style:inherit;}*/
    .detail ol li{list-style:decimal;}
    .detail ol {padding-left:20px;}
    .detail ul {padding-left:20px;}
    .width775{ width:775px}
</style>
<div class="contents">
    <div class="m_top10">
        <div class="float_l  width190">
            <div class="box">
                <div class="box_lm xb_box ">平台规则</div>
                <div class="box_info xb_box2">
                    <ul class="xb_box_ul">
                        <?php
                        foreach ($rule as $rkey => $rvalue) {
                            echo "<li style='cursor:pointer'id=name" . $rkey . " class='names' onclick=showrule(" . $rkey . ")>" . $rvalue->Name . "</li>";
//                            var_dump($rvalue);
                        }
                        ?>
                    </ul>
                </div>
            </div> 
        </div>
        <div class=" float_r width775 kuaijjie detail " style="height: 330px;overflow-y: auto">
            <?php
            foreach ($rule as $rkey => $rvalue) {
                echo "<span id=info" . $rkey . " class='ruleinfo'>" . html_entity_decode($rvalue->Info) . "</span>";
//                            var_dump($rvalue);
            }
            ?>
            <!--<span class="answer-info"><?php echo html_entity_decode($model->Info); ?></span>-->
        </div>
        <div class="clear"></div>
    </div>
</div>
<script>

    $(document).ready(function() {
        $(".ruleinfo").hide();
        $("#info0").show();
        $("#name0").addClass('current');

    })

    function showrule(id) {
        $(".ruleinfo").hide();
        $("#info" + id).show();
        $(".names").removeClass('current');
        $("#name" + id).addClass('current');


    }

</script>