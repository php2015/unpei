<style>
    .float-m{
        float:left;   margin-left:10px;
    }
    .h400{height:350px}
    .btn{margin-top:8px;}

    #show_organ{ width: 360px;height: 210px; border: 1px solid #35B135;background-color: #FFFFFF; display: none; position: absolute;top: 100px;left:0; z-index: 3000; }

    #show_organ p.name{
        color: #1F77E3;
        font-size: 16px;
        line-height: 40px;
        padding-left: 25px;
    }
    #show_organ p.list span{
        color: #343434;
        line-height: 26px;
        padding-left: 25px;
    }
    #show_organ p.list img{
        color: #343434;
        margin-bottom: -7px;
    }
</style>
<?php $this->pageTitle = Yii::app()->name . ' - 经销商查询'; ?>
<div class='width998 content_row'>
    <div class=' jgcx'>
        <div class='page-title'>
            <div class='jxs-title'><?php echo $model['organName'] ?></div>
        </div>
        <div class='page-tel bg-white' > <i class='icon-tel'></i>
            <span class='number' style="width:150px;"><?php echo $model['ContactPhone'] ?></span>
            <span  style="width:100px; float: right; line-height:40px; font: bold; text-decoration: underline"><a href="<?php echo Yii::app()->createUrl('mall/buy/dealerstore') . '/dealer/' . $_GET['dealer'] ?>" target="_blank"><strong>商品列表</strong></a></span>
        </div>
    </div>
    <div id="show_organ">
        <div class="tabs" style="height:35px;"><strong style="color:#323232; font-size:16px; line-height: 35px;padding-left: 25px">经销商信息</strong></div>
        <p class="name"><?php echo $model['organName'] ?></p>
        <p class="list"><span>供应等级：</span><img src="<?php echo F::themeUrl() ?>/images/icons/grade.png" /></p>
        <p class="list"><span>经营模式：</span>经销厂家</p>
        <p class="list"><span>嘉配认证：</span><img src="<?php echo F::themeUrl() ?>/images/icons/approve.png" /></p>
        <p class="list"><span>联系方式：</span><?php echo $model['Phone'] ?></p>
        <p class="list"><span>所在地区：</span><?php Area::showCity($model['province']) . Area::showCity($model['city']) . Area::showCity($model['area']); ?></p>
    </div>
    <div class='auto_height jgcx info content-rows15'>
        <div style=" width: 600px;height:375px; float:left; background: white">
            <!-- <div class='width600 h400 float-l bg-white'> 原来的样式 -->
            <div class="title title-dashed">
                基础信息 <i class='icon-arr2r-white display-ib'></i>
            </div>
            <div class='info-list'  style=" overflow: hidden ">
                <span>机构名称：</span>
                <?php echo $model['organName'] ?>
                <br>
                <span>嘉 配 ID：</span>
                <?php echo $model['jiapartsId'] ?>
                <br>
                <span>企业类型：</span>
                经销商
                <br>
                <span>成立年份：</span>
                <?php echo $model['FoudingDate'] ?>年
                <br>
                <span>店铺面积：</span>
                <?php echo $model['StoreSize'] ?>
                <br>
                <span>年销售额：</span>
                <?php echo $model['SaleMoney'] ?> 元
                <br>
                <span>经营地域：</span>
                <?php Area::showCity($model['BusinessScope']) ?>
                <br>
                <span>机构介绍：</span>
                <?php echo $model['organIntroduction'] ?>

            </div>
        </div>




        <div class='right-side float-m   bg-white' style="height:375px;width:386px">
            <div class="title title-dashed">
                联系方式
                <i class='icon-arr2r-white display-ib'></i>
            </div>
            <div class='info-list'>
                <p><span style="float:left;display: block;width: 150px;">手机：<?php echo $model['Phone'] ?></span></p>
                <p style=" clear: both"></p>
                <p><span style="float:left;display: block;width: 150px;">传真：<?php echo $model['Fax'] ?></span></p>
                <p style=" clear: both"></p>
                <p><span style="float:left;display: block;width: 150px;">电话：<?php echo $model['ContactPhone'] ?></span></p>
                <p style=" clear: both"></p>
                <p><span style="float:left;display: block;width: 150px;">QQ号：<?php echo $model['QQ'] ?></span></p>
                <p style=" clear: both"></p>
                <p>邮箱：<?php echo $model['Email'] ?></p>
                <p>地址：<?php Area::showCity($model['province']) . Area::showCity($model['city']) . Area::showCity($model['area']); ?></p>

            </div>
        </div>

    </div>


    <div class='jgcx content-rows15 bg-white' style="margin-bottom: 15px;line-height: 2em;padding: 10px">
        <div class="title title-dashed">
            主营信息
            <i class='icon-arr2r-white display-ib'></i>
        </div>
        <div class='info-list'>
            <span style="font-weight: bold">主营品类</span>：
            <?php if (!empty($showcpnames)): ?>
                <?php foreach ($showcpnames as $key => $showcpname): ?>
                    <?php if (isset($showcpnames[$key + 1])) { ?>
                        <span style="line-height:24px;"><?php echo $showcpname['BigName'] ?> <?php echo $showcpname['SubName'] ?> <?php echo $showcpname['CpName'] ?>,</span>
                    <?php } else { ?> 
                        <span style="line-height:24px;"><?php echo $showcpname['BigName'] ?> <?php echo $showcpname['SubName'] ?> <?php echo $showcpname['CpName'] ?></span>
                    <?php } ?>
                <?php endforeach; ?>
            <?php endif; ?>
            <br>
            <span style="font-weight: bold">主营车系</span>：
            <?php if (!empty($dealerv)): ?>
                <?php foreach ($dealerv as $k => $showvehicle): ?>
                    <?php $makeName = D::queryGoodsMakeInfo($showvehicle['businessMake']);
                    echo $makeName['makeName']; ?> <?php $carinfo = D::queryGoodsSeriesInfo($showvehicle['businessCar']);
            echo $carinfo['seriesName']; ?><?php echo $showvehicle['businessYear'] ? $showvehicle['businessYear'] : ''; ?><?php $modelinfo = D::queryGoodsModelInfo($showvehicle['businessCarModel']);
            echo $modelinfo['modelName'] ?>
        <?php if (isset($dealerv[$k + 1])) echo ','; ?>
                <?php endforeach; ?>         
            <?php endif; ?>
            <br>
            <span style="font-weight: bold">主营品牌</span>：
            <?php if (!empty($data)): ?>
                <?php foreach ($data as $k => $datas): ?>
                    <?php echo $datas[brandname] ?>
        <?php if (isset($data[$k + 1])) echo ','; ?>
    <?php endforeach; ?>
<?php endif; ?>
            <br>

        </div>
    </div>



    <div class=' jgcx photos content-rows15 bg-white'>
        <div class='title'>&nbsp;&nbsp;机构照片</div>
        <div class='pos-r'>
            <a href='javascript:;' class="arr-l scroll-left"></a>
            <div class="photos-list">
                <ul>
<?php if (!empty($organphotos)): ?>
    <?php foreach ($organphotos as $organphoto): ?>
                            <li><?php $src = F::uploadUrl() . $organphoto['photoName']; ?>
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
<script>
    $(document).ready(function(){
        $("select").css({'width':'148px','margin-right':'5px'});
        $(".jxs-title").mouseover(function(event){
             event.stopPropagation();
            var offset = $(event.target).offset();
            $("#show_organ").css({top:offset.top+$(event.target).height()-2+"px",left:offset.left});
            $("#show_organ").show();
        })
         
         $("#show_organ").mouseover(function(event){
//             event.stopPropagation();
//            var offset = $(event.target).offset();
//            $("#show_organ").css({top:offset.top+$(event.target).height()+"px",left:offset.left});
            $("#show_organ").show();
        })
         $("#show_organ").mouseout(function(event){
              $("#show_organ").hide();
         })
           $(".jxs-title").mouseleave(function(){
                $("#show_organ").hide();
           })
        
    })
    
//    $("#btnShow").click(function(event){
//            event.stopPropagation();
//            var offset = $(event.target).offset();
//            $("#divPop").css({top:offset.top+$(event.target).height()+"px",left:offset.left});
//            $("#divPop").show(speed);          
//
//        });
</script>