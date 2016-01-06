<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->theme->baseUrl; ?>/css/newer/xygl.css"  />
<?php
//机构图片
//$goodsimg = OrganPhoto::model()->findAll("OrganID=:userID", array(":userID" => $organID));
//$imgUrl = $goodsimg[0]->Path;
$goodsimg = Organ::model()->findByPk($organID);
$imgUrl   = $goodsimg ->Logo;
$oname    = $goodsimg ->OrganName;
//好评统计
$goodsArr = EvaluateService::getevalgoods(array('OrganID' => $organID));
$goodsArr1 = EvaluateService::getevalgoods(array('OrganID' => $organID, 'm' => 1));
$goodsArr6 = EvaluateService::getevalgoods(array('OrganID' => $organID, 'm' => 6));
$goodsArr12 = EvaluateService::getevalgoods(array('OrganID' => $organID, 'm' => 12));
$total = $goodsArr[1] + $goodsArr[2] + $goodsArr[3];
$goodsscore = $goodsArr[1] - $goodsArr[3];
//信用等级
$xylevel = EvaluateService::getpets($goodsscore);
if (empty($xylevel) || !$xylevel[0] || !$xylevel[1]) {
    $xylvstr = "<div class='xy-div' title='暂无'><i style='color:#888'>暂无</i></div>";
} else {
    $xylvstr = '<div class = "xy-div" title = "积分：' . $goodsscore . '">' . str_repeat("<i class='seller-level" . $xylevel[0] . "'></i>", $xylevel[1]) . '</div>';
}
$total1 = $goodsArr1[1] + $goodsArr1[2] + $goodsArr1[3];
$total6 = $goodsArr6[1] + $goodsArr6[2] + $goodsArr6[3];
$total12 = $goodsArr12[1] + $goodsArr12[2] + $goodsArr12[3];
$praise = $total ? sprintf('%0.1f', $goodsArr[1] * 100 / $total) : 0;

//综合评分
$fwitem = EvaluateService::getevainfo(2);
$fwArr = EvaluateService::getevalscore(array('OrganID' => $organID));
$i = 0;
$sum = 0;
$ul1 = '<ul class = "s_one">';
$ul2 = '<ul class = "s_two">';
if (!empty($fwArr)) {
    foreach ($fwArr as $k => $v) {
        if (isset($fwitem[$v['JudgeID']])) {
            $ul1.="<li>" . $fwitem[$v['JudgeID']] . '：</li>';
            $score = sprintf('%0.1f', $v['totalscore'] / $v['count']);
            $fscore = floor($score);
            $hscore = ($score - $fscore) > 0 ? 1 : 0;
            $rscore = 5 - $fscore - $hscore;
            $sum+=$score;
            $i++;
            $ul2.='<li>' . str_repeat('<i class="floor"></i>', $fscore) . str_repeat('<i class="half"></i>', $hscore)
                    . str_repeat('<i class="rest"></i>', $rscore) .
                    '<a><em>' . $score . '</em>分</a></li><div class="clear"></div>';
        }
    }
    $avgscore = $i == 0 ? 0.0 : sprintf('%0.1f', $sum / $i);
} else if (!empty($fwitem)) {
    foreach ($fwitem as $v) {
        $ul1.="<li>" . $v . '：</li>';
        $ul2.='<li>' . str_repeat('<i class="rest"></i>', 5) . '<em>0</em>分</a></li>';
    }
    $avgscore = 0;
}
$ul1.="</ul>";
$ul2.="</ul>";

$jdt = EvaluateService::getJdtCss($praise);
?>
<!--信用管理-->
<div class="mywork">
    <h3>我的信用管理</h3>
    <p>信用信息</p>
    <div style="width:100%; height:108px">
        <div class="fl" style=" width:97px; height:97px; padding-left:25px;">
            <img src="<?php echo F::uploadUrl() . $imgUrl ?>"  class="flimg"/>
        </div>
        <dl class="fl">
            <dd><label style="margin-left:12px;">用户名：</label><a><?php echo Yii::app()->user->getOrganName(); ?></a></dd>
            <dd><label style="float:left">信用等级：</label><?php echo $xylvstr; ?><?php //echo $goodsscore                      ?></dd>
            <dd><label style="margin-left:12px;float:left;display:block">好评率：</label>
                <?php echo $jdt; ?>
                <span><?php echo $praise . '%' ?></span>
            </dd>
        </dl>
    </div>
    <!--商品评价统计-->
    <div class="fl goods">
        <h4><a>商品评价统计 <i><?php echo $total ?></i></a><span>好评率：<em><?php echo $praise . '%' ?></em></span></h4>
        <ul class="g_one">
            <li></li>
            <li>最近1个月</li>
            <li>最近6个月</li>
            <li>最近12个月</li>
            <li>总计</li>
        </ul>
        <ul>
            <li>好评</li>
            <li><i><?php echo $goodsArr1['1'] ?></i></li>
            <li><i><?php echo $goodsArr6['1'] ?></i></li>
            <li><i><?php echo $goodsArr12['1'] ?></i></li>
            <li><i><?php echo $goodsArr['1'] ?></i></li>
        </ul>
        <ul>
            <li>中评</li>
            <li><i><?php echo $goodsArr1['2'] ?></i></li>
            <li><i><?php echo $goodsArr6['2'] ?></i></li>
            <li><i><?php echo $goodsArr12['2'] ?></i></li>
            <li><i><?php echo $goodsArr['2'] ?></i></li>
        </ul>
        <ul>
            <li>差评</li>
            <li><i><?php echo $goodsArr1['3'] ?></i></li>
            <li><i><?php echo $goodsArr6['3'] ?></i></li>
            <li><i><?php echo $goodsArr12['3'] ?></i></li>
            <li><i><?php echo $goodsArr['3'] ?></i></li>
        </ul>
        <ul>
            <li>总计</li>
            <li><i><?php echo $total1 ?></i></li>
            <li><i><?php echo $total6 ?></i></li>
            <li><i><?php echo $total12 ?></i></li>
            <li><i><?php echo $total ?></i></li>
        </ul>
    </div>
    <!--商品评价统计结束-->
    <!--服务评价-->
    <div class="fl service">
        <h4><a>服务评价</a><span>综合评分：<em><?php echo $avgscore ?></em>分</span></h4>
        <?php echo $ul1 . $ul2; ?>
        <div style="clear:both"></div>
    </div>
    <div style="clear:both"></div>
</div>
<script>
    var infor1 = $('.goods').height();
    var infor2 = $('.service').height();
    var inforh = infor1 > infor2 ? infor1 : infor2;
    $('.goods').css('height', inforh);
    $('.service').css('height', inforh);
</script>