<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->theme->baseUrl; ?>/css/yxgl.css"  />
<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->theme->baseUrl; ?>/css/newer/buyer.css"  />
<style>
    
 .infor2 ul li b.c1{width:110px}
 .infor2 ul li b{ width:85px}
</style>
<?php
//机构图片
//$goodsimg = Organ::model()->findByPk("ID=:userID", array(":userID" => $organID));
$goodsimg = Organ::model()->findByPk($organID);
$imgUrl   = $goodsimg ->Logo;
$oname    = $goodsimg ->OrganName;
//var_dump($imgUrl);die;
//获取买家信用统计
$items = EvaluateService::getevainfo(3);
$tr = '';
if (!empty($items)) {
    foreach ($items as $k => $v) {
        $servicescore = EvaluateService::getevalservice(array('OrganID' => $organID, 'm' => $k));
        $totalrow = $servicescore['3'] + $servicescore['2'] + $servicescore['1'];
        $tr.="<p class='imain'><b class='c1'>$v</b><b>{$servicescore['3']}</b><b>{$servicescore['2']}</b><b>{$servicescore['1']}</b></p>";
    }
}
$total = EvaluateService::getevalservice(array('OrganID' => $organID));
$totalall = $total['3'] + $total['2'] + $total['1'];
$totalxy = $total['3'] - $total['1'];
//信用等级
$xylevel = EvaluateService::getpets($totalxy);
if (empty($xylevel) || !$xylevel[0] || !$xylevel[1]) {
    $levelstr = "<div title='暂无' style='color:#888'>暂无</div>";
} else {
    $levelstr = '<div title = "积分：' . $totalxy . '">' . str_repeat("<i class='buyer-level" . $xylevel[0] . "'></i>", $xylevel[1]) . '</div>';
}
$praise = $totalall ? sprintf('%0.1f', $total['3'] * 100 / $totalall) : 0;
$jdt = EvaluateService::getJdtCss($praise);
$tr.="<p class='imain last'><b class='c1'>总计</b><b>{$total['3']}</b><b>{$total['2']}</b><b>{$total['1']}</b></p>";
?>
<div class="main1">
    <h3>我的信用管理</h3>
    <div class="infor1 fl">
        <h4>信用信息</h4>
        <dl>
            <dt class="fl"><a><img src="<?php echo F::uploadUrl() . '/' . $imgUrl; ?>" /></a></dt>
            <dd class="fr">
                <p>公司名称：<b><?php echo $oname; ?></b></p>
                <div style="margin-bottom: 20px;"><label style="float:left">信用等级：</label><?php echo $levelstr; ?></div>
                <div><label style="float:left;display:block">好评率：</label><?php echo $jdt ?>
                    <i style="display:block;color:#ec6b32;float:left;font-style:normal;font-weight:bold"><?php echo $praise . '%' ?></i></div>
            </dd>
        </dl>
    </div>
    <div class="infor2 fr">
        <div class="intitle" style="height:32px">
            <b class="fl" style="font-size:14px; margin-left:10px">买家信用 <span><?php echo $totalxy ?></span></b>
            <span class="fr">好评率：<i><?php echo $praise ?>%</i></span>
            <div style="clear:both"></div>
        </div>
        <div>
            <p class="ititle"><b class="c1" style=""></b><b>好评</b><b>中评</b><b>差评</b></p>
            <?php echo $tr; ?>
        </div>
    </div>
    <div style='clear:both'></div>
</div>
<script>
    var infor1 = $('.infor1').height();
    var infor2 = $('.infor2').height();
    var inforh = infor1 > infor2 ? infor1 : infor2;
    $('.infor1').css('height', inforh);
    $('.infor2').css('height', inforh);
</script>
