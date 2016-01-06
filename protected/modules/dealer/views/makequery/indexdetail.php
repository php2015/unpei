<style>
    .float-m{
        float:left;   margin-left:10px;
    }
    .h400{height:350px}
    .btn{margin-top:8px;}
</style>
<?php
$this->pageTitle = Yii::app()->name . ' - ' . "授权品牌厂家";
?>
<div class='width998 content_row'>

    <div class='jgcx'>
        <div class='page-title'>
            <div class='jxs-title'><?php echo $model['name']; ?></div>
        </div>
        <div class='page-tel bg-white'> <i class='icon-tel'></i>
            <span style="background:url('');width:150px;" class='number'><?php echo $model['telephone']; ?></span>
            <!--			<a class="float-r btn"  onclick="js:window.history.go(-1)">返回上一页</a>-->
        </div>
    </div>
    <div class='auto_height jgcx info content-rows15'>
        <div style=" width: 600px;height:390px; float:left; background: white">
            <div class="title title-dashed">
                基础信息 <i class='icon-arr2r-white display-ib'></i>
            </div>
            <div class='info-list'>
                <span>机构名称：</span>
                <?php echo $model['name']; ?>
                <br>
                <span>嘉 配 ID：</span>
                <?php echo $model['jiapartsID']; ?>
                <br>
                <span>企业类型：</span>
                <?php echo "品牌厂家"; ?>
                <br>
                <span>成立年份：</span>
                <?php if ($model['establish_year']): ?>
                    <?php echo $model['establish_year'] . '年'; ?>
                <?php endif; ?>
                <br>
                <span>年销售额：</span>
                <?php echo $model['year_sales_volume']; ?>
                <br>
                <span>公司规模：</span>
                <?php echo $model['company_scale']; ?>
                <br>
                <span>经营地域：</span>
                <?php echo Area::getCity($model['operate_region']); // $txtprovince['operate_region'];?>
                <br>
                <span style="display:block;float:left;width:70px;">机构简介：</span>
                <span style=" word-break: break-all;display: block;float: left;width: 470px;overflow:auto;"><?php echo $model['synopsis']; ?></span>
            </div>
        </div>
        <div class='right-side h400 float-m  bg-white' style="width:386px;height:390px; margin-bottom: 15px">
            <div class="title title-dashed">
                联系方式
                <i class='icon-arr2r-white display-ib'></i>
            </div>
            <div class='info-list'>
                <span>手　　机：</span>
                <?php echo $model['mobile_phone']; ?>
                <br>
                <span>固定电话：</span>
                <?php echo $model['telephone']; ?>
                <br>
                <span>传　　真：</span>
                <?php echo $model['fax']; ?>
                <br>
                <span>QQ 号 码：</span>
                <?php echo $model['qq']; ?>
                <br>
                <span>邮　　箱：</span>
                <?php echo $model['email']; ?>
                <br>
                <span>官网网址：</span>
                <?php echo $model['url']; ?>
                <br>
                <span>网店网址：</span>
                <?php echo $model['storeUrl']; ?>
                <br/>
                <span>地　　址：</span>
                <?php
                Area::showCity($model['province']);
                Area::showCity($model['city']);
                Area::showCity($model['area']);
                ?>
            </div>
        </div>
    </div>
    <div class=' jgcx photos content-rows15 bg-white'>
        <div class='title'>&nbsp;&nbsp;&nbsp;机构照片</div>
        <div class='pos-r'>
            <a href='javascript:;' class="arr-l scroll-left"></a>
            <div class="photos-list">
                <ul>
                    <?php if (!empty($makerpic)): ?>
                        <?php foreach ($makerpic as $pic): ?>
                            <li><?php $src = F::uploadUrl() . $pic['picture_file']; ?>
                                <a href="#"><img src="<?php echo $src ?>"></a>
                                <!--<div class='text-c mt1em'><a href="#">说明文字</a></div>-->
                            </li>
                        <?php endforeach; ?>
                    <?php endif; ?>
                </ul>
            </div>
            <a href='javascript:;' class="arr-r scroll-right"></a>
        </div>
    </div>
</div>