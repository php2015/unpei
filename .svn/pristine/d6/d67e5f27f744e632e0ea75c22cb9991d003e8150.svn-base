<?php
$this->pageTitle = Yii::app()->name . ' - ' . "公司信息管理";
$this->breadcrumbs = array(
    '会员中心' => Yii::app()->createUrl("common/memberlist"),
    '公司信息管理',
);
$goodsArr = EvaluateService::getevalgoods(array('OrganID' => $model['ID']));
$total = $goodsArr[1] + $goodsArr[2] + $goodsArr[3];
$goodsscore = $goodsArr[1] - $goodsArr[3];
//信用等级
$xylevel = EvaluateService::getpets($goodsscore);
if (empty($xylevel) || !$xylevel[0] || !$xylevel[1]) {
    $xylvstr = "<div class='xy-div' title='暂无'><i style='color: #f27300;'>暂无</i></div>";
} else {
    $xylvstr = '<div class = "xy-div" title = "积分：' . $goodsscore . '">' . str_repeat("<i class='seller-level" . $xylevel[0] . "'></i>", $xylevel[1]) . '</div>';
}
$praise = $total ? sprintf('%0.1f', $goodsArr[1] * 100 / $total) : 0;
$jdt = EvaluateService::getJdtCss($praise);
?>
<style>
    .txxx_info4{ margin:15px 10px 15px  20px} 
    .uploadify-button-text{color:#fff}
    .m_left68{ margin-left:68px;}
    .gim h3{ height:38px; width:100%; border-bottom:3px solid #f27300; font-size:16px; text-indent:18px; line-height:38px; color:#f27300; font-weight:bold}
    .gim li i{ font-weight:500;}
    span.guanbi4{ position:absolute; z-index:10; right:0px; cursor:pointer;top:-4px}
    span.guanbi5 {position: absolute;z-index: 10;right: -2px;cursor: pointer;top: 0px;}
    .uploadify-queue{display:none}
    .hy-jxsname {font-family: "微软雅黑";font-size: 24px;font-weight: bold;color: #444;letter-spacing: 1.5px;line-height: 30px;padding-top: 30px;}
    .hy-jxstel {font-family: "微软雅黑";font-size: 18px;font-weight: bold;color: #00458b;line-height: 30px;}
    .mywork dl {height: 98px;color: #444;padding-top:10px;}
    .mywork dl dd {width:240px;height: 26px;padding-top: 6px;}
    .eval_jdtbg{margin-top: 10px;}
    .hy-hd-y {position: absolute;top: 0px;z-index: 10;width: 142px;height: 142px; left:0px ;}
    .ba .pho {width: 134px;height: 134px;position: absolute;left: 40px;top: 10px;z-index: 9;}
</style>
<link type="text/css" rel="stylesheet" href="<?php echo F::themeUrl(); ?>/css/inma.css" />
<link rel="stylesheet" href="<?php echo F::themeUrl(); ?>/css/companymanage.css">
<script type="text/javascript" src="<?php echo F::themeUrl(); ?>/js/companymanage.js"></script>
<div class="contents2">
    <div id="show" class="gim">
        <div class="ba bj2">
            <div class="pho">
                <img src="<?php echo F::uploadUrl() . ($model->Logo ? $model->Logo : 'logo/touxiang.jpg'); ?>" width="142px" height="142px" />
                <img src="<?php echo F::themeUrl(); ?>/images/company/zhezhao.png" class="hy-hd-y"/>
            </div>
            <div class="mywork sjname">
                <dl class="float_l">
                    <dd class="hy-jxsname float_l">
                        <?php echo $model['OrganName']; ?>
                    </dd>
                    <dd class="float_r" style="line-height: 30px;margin-right: 50px;color: #f27300;">
                        <label style="float:left;font-size: 14px;">信用：</label><?php echo $xylvstr; ?>
                    </dd>
                    <dd class="hy-jxstel float_l">
                    联系电话：<?php echo $model['Phone']; ?>
                    </dd>
                    <dd class="float_r" style="line-height: 30px;margin-right: 50px;color: #f27300;">
                        <label style="float:left;display:block;font-size: 14px;">好评率：</label>
                        <?php echo $jdt; ?>
                        <?php echo $praise . '%' ?>
                    </dd>
                </dl>
                
                
            </div>
            <div id="modif" class="mlink">
                <a >修改</a>
            </div>
        </div>
        <div class="ba2">
            <!--基本信息-->
            <div class="ba2_1 babj">
                <h3>基本信息</h3>
                <div class="fl" style="padding:10px;">
                    <?php if (!empty($organphotos[0])): ?>
                        <?php $this->renderPartial('imagesgallery', array("id" => "galleria", "pictures" => $organphotos[0])); ?>
                    <?php else: ?>
                        <img src="<?php echo F::baseUrl() . '/upload/dealer/'; ?>goods-img-big.jpg" width="235" height="155" />
                    <?php endif ?>  
                </div>
                <div class="xxi">
                    <ul>
                        <li>成立年份：<i><?php echo $model['FoundDate']; ?>年</i></li>
                        <?php if ($identity == 3) { ?>
                        <li>修理厂级别：<i><?php echo $model['service']['ServiceType']; ?></i></li>
                        <li>店铺面积：<i><?php echo $model['service']['ShopArea']; ?></i></li>
                        <li>工位数：<i><?php echo $model['service']['PositionCount']; ?></i></li>
                        <li>技师人数：<i><?php echo $model['service']['TechnicianCount']; ?></i></li>
                        <li>停车位数：<i><?php echo $model['service']['ParkingDigits']; ?></i></li>
                        <?php } elseif ($identity == 2) { ?>
                        <li>员工人数：<i><?php echo $model['StoreSize']; ?></i></li>
                        <li>年销售额：<i><?php echo $model['dealer']['SaleMoney']; ?></i></li>
                        <li>经营面积：<i><?php echo $model['dealer']['ShopArea']; ?></i></li>
                        <?php } elseif ($identity == 1) { ?>
                        <?php }; ?>
                        <div class="clear" style="clear:both"></div>
                              <li style="font-weight:600;word-break:break-all; white-space:normal; width:360px">
                        机构简介：<span style="font-weight:500; line-height:22px;word-break:break-all; white-space:normal;"><?php echo $model['Introduction']; ?></span>
                    </li>
                    </ul>
                     <div class="clear"  style="clear:both"></div>
              
                </div>
            </div>
            <!--联系方式-->
            <div class="ba2_2 babj">
                <h3>联系方式</h3>
                <ul>
                    <li>手 机：<i><?php echo $model->Phone; ?></i></li>
                    <li>邮 箱：<i><?php echo $model->Email; ?></i></li>
                    <li>传 真：<i><?php echo $model->Fax; ?></i></li>
                    <li>qq 号：<i><?php echo $model->QQ; ?></i></li>
                    <li>座 机：<i><?php echo $model->TelPhone; ?></i></li>
                    <li>地 址：<i><?php echo Area::showCity($model['Province']) . Area::showCity($model['City']) . Area::showCity($model['Area']) . $model->Address; ?></i></li>
                </ul>
            </div>
        </div>
        <div class="ba3">
            <!--品牌授权书-->
            <div class="ba3_1 babj">
                <?php if ($identity == 3) { ?>
                <h3>门店照片</h3>

                <div class="bmove">
                    <div class="licon" style="position:absolute; left:-28px; top:56px; z-index:9; opacity:0.1;"><img src="<?php echo F::themeUrl(); ?>/images/company/lefticon.png"/></div>
                    <div class="ricon" style="position:absolute; right:-8px; top:56px; z-index:9;"><img src="<?php echo F::themeUrl(); ?>/images/company/righticon.png" /></div>
                    <div class="bmove_sub">
                        <ul>
                            <?php if(!empty($organphotos[2])):?>
                            <?php foreach($organphotos[2] as $key=>$val):?>
                            <li><img src="<?php echo F::uploadUrl().$val['Path']; ?>" width="160px" height="124px" /></li>
                            <?php endforeach;?>
                            <?php endif;?>
                        </ul>
                    </div>
                </div>
                <?php } elseif ($identity == 2) { ?>
                <h3>品牌授权书</h3>

                <div class="bmove">
                    <div class="licon" style="position:absolute; left:-28px; top:56px; z-index:9; opacity:0.1;"><img src="<?php echo F::themeUrl(); ?>/images/company/lefticon.png"/></div>
                    <div class="ricon" style="position:absolute; right:-8px; top:56px; z-index:9;"><img src="<?php echo F::themeUrl(); ?>/images/company/righticon.png" /></div>
                    <div class="bmove_sub">
                        <ul>
                            <?php if(!empty($organphotos[1])):?>
                            <?php foreach($organphotos[1] as $key=>$val):?>
                            <?php if(!empty($val['url1'])): ?>
                            <li><img src="<?php echo F::uploadUrl().$val['url1']; ?>" width="160px" height="124px" /></li>
                            <?php 
                                    endif;
                                    if (!empty($val['url2'])) : 
                            ?>
                            <li><img src="<?php echo F::uploadUrl().$val['url2']; ?>" width="160px" height="124px" /></li>
                            <?php endif; ?>
                            <?php endforeach;?>
                            <?php endif;?>
<!--                            <li><img src="<?php //echo F::themeUrl(); ?>/images/company/shouqan.png" width="160px" height="124px" /></li>-->
                        </ul>
                    </div>
                </div>
                <?php } elseif ($identity == 1) { ?>
                <?php } ?>
            </div>
            <!--营业执照-->
            <div class="ba3_2 babj">
                <h3>营业执照</h3>
                <ul><li>注 册 号：<i><?php echo $model['Registration']; ?></i></li></ul>
                <div class="ba3_2_p">
                    <a class="fl">照片：</a>
                    <?php if (!empty($model['BLPoto'])): ?>
                        <img src="<?php echo F::uploadUrl() . $model['BLPoto']; ?>" style="width:158px;height:116px;"/>
                    <?php else: ?>
                        <img src="data:image/jpeg;base64,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" style="width:158px;height:116px;"/>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>
    <!-- -----------------------------------以上为信息展示--------------------------------------- -->
    <?php echo $this->renderPartial("edit", array("model" => $model, "organphotos" => $organphotos, "identity" => $identity)); ?>
</div>
<script type="text/javascript" src='<?php echo F::themeUrl(); ?>/js/uploadify/jquery.uploadify.js'></script>
<link rel="stylesheet" href="<?php echo F::themeUrl(); ?>/js/uploadify/uploadify1.css">
<script type="text/javascript"><!--
    $(document).ready(function() {
        var bm =$('.bmove');
	var ou =$('.bmove_sub').find('ul');
	var liwd =$('.bmove_sub').find('li').width();
	var onum =$('.bmove_sub').find('li').length;
	ou.width((liwd+14)*onum);
	var i=1;
	if(onum-3<0){
		$('.licon').css('display','none')
		$('.ricon').css('display','none')};
	$('.ricon').click(function(){
		if(i<onum-3){
			ou.animate({'left':-(liwd+14)*i})
			i++;
			$('.ricon').css('opacity','1');
			}else if(i=onum-3){
				ou.animate({'left':-(liwd+14)*i})
				i++;
				$('.ricon').css('opacity','0.1')}
		$('.licon').css('opacity','1');
		});
	$('.licon').click(function(){
		if(i>2){
			ou.animate({'left':-(liwd+14)*(i-2)})
			i--;
			$('.licon').css('opacity','1');
			}else if(i=2){
				ou.animate({'left':-(liwd+14)*(i-2)})
				i--;
				$('.licon').css('opacity','0.1')}
		$('.ricon').css('opacity','1');
		});	
                
        var j = "<?php echo $j; ?>";
        $("#addTel").click(function() {
            if (j == 0)
                j = 1;
            if (j >= 4) {
                alert("座机号码最多只能添加4个！");
                return false;
            }
            $("input:text[key=" + j + "]").css('display', 'inline-block');
            j++;
        });
        $("#Organ_Province").change(function() {
            if ($(this).val()) {
                var province = $(this).val();
                $.getJSON(Yii_baseUrl + '/common/dynamicarea', {province: province}, function(data) {
                    if (data != '') {
                        $("#Organ_Area").empty();
                        $.each(data, function(key, val) {
                            jQuery("<option value='" + key + "'>" + val + "</option>").appendTo("#Organ_Area");
                        });
                    }
                });
            } else {
                $("#Organ_Area").empty();
                $("<option value=''>请选择地区</option>").appendTo("#Organ_Area");
            }
        });
    });
--></script>
<script>
    $(function() {
        //var fileClass =  <?php echo Yii::app()->user->getOrganID(); ?>;
        //var identity=<?php echo Yii::app()->user->identity; ?>;
<?php $path = Yii::app()->user->getIdentity() . '/' . Yii::app()->user->getOrganID() . '/BLPhoto/'; ?>
        var path = "<?php echo $path; ?>";
        $("#file_upload").uploadify({
            'auto': true,
            'queueId': 'some_file+queue',
            'swf': Yii_theme_baseUrl + '/js/uploadify/uploadify.swf',
            'uploader': Yii_baseUrl + '/upload/ftpupload',
            'buttonText': '上传机构图片',
            'height': 25, //flash高
            'method': 'post',
            'formData': {'path': path},
            'fileTypeExts': '*.gif; *.jpg; *.png; *.jpeg',
            'queueSizeLimit': 1, //上传数量  
            'fileSizeLimit': '2MB', //上传文件的大小限制
            'onSWFReady': function() {
                if ($("#showimglist").find("li").length >= 5) {
                    $("#file_upload").uploadify('disable', true);
                }
            },
            'onUploadSuccess': function(file, data, response) {//每个文件上传完成时执行的函数 response是服务器返回的数据
                var responeseDataObj = eval("(" + data + ")");
                var errorinfo = '';
                if (responeseDataObj && responeseDataObj.code == 200) {
                    var src_1 = "<?php echo F::uploadUrl() ?>";
                    var src = src_1 + responeseDataObj.fileurl;
                    var span = "<li><img  style='width:80px;height:80px;' src=" + src + "><span id='delfile' keyid=" + responeseDataObj.fileurl + " class='guanbi3'><img src='<?php echo F::themeUrl(); ?>/images/guanbi3.png'></span><input type='hidden' name='goodsImages[]' value=" + responeseDataObj.fileurl + "></li>";
                    $("#showimglist").append(span);
                } else {
                    errorinfo += '文件上传失败！错误原因：' + responeseDataObj.msg + '<br />';
                    $("#file-upload-errorinfo").show();
                    $("#file-upload-errorinfo span").append(errorinfo);
                }
                if ($("#showimglist").find("li").length == 5) {
                    $("#file_upload").uploadify('disable', true);
                }
            }
        });
    });

</script>