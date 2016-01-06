<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->theme->baseUrl ?>/css/pap/goodsinfo.css" />
<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->theme->baseUrl ?>/css/jpd/page.css" />
<style>
    #make-car-m {border:2px solid #f2b303;}
    /*#make-car-m {border:2px solid #f2b303;left: 380px!important; top: 360px!important; }*/
    .right_A .makelist li.selected3{ background:#f2b303 }
    .right_A .makelist ul li.li_list:hover{background:#f2b303}
    .right_A .makelist ul li.li_top{color:#f2b303}
    .car_brand .left_A ul li a{color:#f2b303}
    .car_brand .left_A ul li a:hover { background:#f2b303}
    .content2a{border: none}
    .zxq_yh{width:100px}
    .content1a{width:350px; height: 435px}
    #comment_span{cursor:pointer}
    .sp_mbx {
        border-bottom: 1px dashed #ccc;
    }
    .zoomdiv{ top:0px!important; left:350px!important}
</style>
<div class="wrap-contents" style="background:#fff;width:990px;padding:5px; margin-top:5px; border:1px solid #ccc">
    <div class="contents">
        <div class="sp_mbx">
            <?php
            $cpname = DealergoodsService::StandCodegetcpname($r['StandCode']);
            $Subname = DealergoodsService::idgetgcategory($cpname['ParentID']);
            $Bigname = DealergoodsService::idgetgcategory($Subname['ParentID']);
            ?>
            <ul class="sp_mbx_ul">
            <li><b><a><?php echo $Bigname['Name'] ?></a> ></b></li>
            <li><span><a href="javascript:void(0)">
                    <?php echo $Subname['Name'] ?></a> > </span></li>
               <li> <span><a href="javascript:void(0)">
                    <?php echo $cpname['Name'] ?></a> ></span> </li>
               <li><span><a title="<?php echo $r['Name'] ?>"><?php echo $r['Name'] ?></a></span></li></ul>
        </div>
        <div class="content1">

            <div class="content1a float_l">
                <!--图片切换-->
                <div id=preview style="position: relative">
                    <div class=jqzoom id=spec-n1 >
                        <?php if ($r['Images']): ?>
                            <IMG height=350 src="<?php echo F::uploadUrl() . $r['Images'][0] ?>" jqimg="<?php echo F::uploadUrl() . str_replace('/small/', '/normal/', $r['Images'][0]) ?>" width=350>
                        <?php else: ?>
                            <IMG height=350 src="<?php echo F::uploadUrl() . 'common/goods-img-big.jpg' ?>" jqimg="<?php echo F::uploadUrl() . 'common/goods-img-big.jpg' ?>" width=350>
                        <?php endif; ?>
                    </div>
                    <div id=spec-n5>
                        <div class=control id=spec-left>
                            <img src="<?php echo Yii::app()->theme->baseUrl; ?>/images/papmall/left.gif" />
                        </div>
                        <div id=spec-list>
                            <ul class=list-h>
                                <?php if ($r['Images']):foreach ($r['Images'] as $v): ?>
                                        <li><img src="<?php echo F::uploadUrl() . $v ?>"> </li>
                                        <?php
                                    endforeach;
                                else:
                                    ?>
                                    <li><img src="<?php echo F::uploadUrl() . 'dealer/goods-img-big.jpg' ?>"> </li>
                                <?php endif; ?>
                            </ul>
                        </div>
                        <div class=control id=spec-right>
                            <img src="<?php echo Yii::app()->theme->baseUrl; ?>/images/papmall/right.gif" />
                        </div>
                    </div>
                </div> 
                <!--end-->
            </div>

            <div class="content1b float_l">
                <p class="title"><?php echo $r['Name'] ?></p>
                <input type="hidden" name="minTurnover" value="<?php echo $r['MinTurnover'] ?>">
                <?php if ($r['ProPrice'] && ($r['ProPrice'] < $r['Price'])): ?>
                    <p class="ck_price">促销价：￥<span class="cck_price"><?php echo $r['ProPrice'] ?></span></p>
                    <p class="sc_price">参考价：￥<span class="ssc_price"><?php echo $r['Price'] ?></span></p>
                <?php elseif ($r['DisPrice'] && ($r['DisPrice'] < $r['Price'])): ?>
                    <p class="ck_price">折扣价：￥<span class="cck_price"><?php echo $r['DisPrice'] ?></span></p>
                    <p class="sc_price">参考价：￥<span  class="ssc_price"><?php echo $r['Price'] ?></span></p>
                <?php else: ?>
                    <p class="ck_price">参考价：￥<span  class="cck_price"><?php echo $r['Price'] ?></span></p>
                <?php endif; ?>
                <p class="pf">商品评分：<span class="sppf"></span><span class="lanse">（已有0条评价）</span></p>
                <p class="bh">商品编号：<span><?php echo $r['GoodsNO'] ?></span></p>
                <p class="fw">标准名称：<span><?php echo $cpname['Name'] ?></span></p>
                <!--                <div>
                                    <p>适用车型：<input id="make-select"  class="input" type="text" value="<?php // echo $carmodeltext ? $carmodeltext : '请选择具体车型进行查询'              ?>"style="width:240px;margin-left:0px;background: #fff">
                                        <span id="fit_span" style="color:<?php // echo $res['success'] == 1 ? 'green' : 'red'              ?>"><?php // echo $res['fit']              ?></span></p>
                <?php // $this->widget('widgets.default.WGoodsCarModel', array('goodsID' => $r['GoodsID'])); ?>
                                    <div style="clear:both"></div>     
                                </div>-->

                <div class="p_number">
                    <span class="float_l" style="padding-left:10px"> 购买数量：</span>
                    <div class="f_l add_chose">
                        <a class="reduce_num" href="javascript:void(0)"></a>
                        <input type="text" name="qty_item_1" value="1" id="qty_item" class="text" onBlur="setAmount(this);"/>
                        <a class="add_num" href="javascript:void(0)"></a>
                    </div>
                </div>
                <p class="bh">服务：由<span class="lanse"><?php echo DealergoodsService::getnamebyorganid(Yii::app()->user->getOrganID()); ?></span>从<?php echo $r['Address'][0] . $r['Address'][1] ?>发货，并提供售后服务</span></p>
                <p class="gm" goodsid="<?php echo $r['GoodsID'] ?>"><button class="addgwc">加入购物车</button>
                    <button class="ljgm" id="quickbuy" goodsid="<?php echo $r['GoodsID']; ?>">立即购买</button></p>
            </div>
            <!--content1b结束-->
            <?php
            $Organinfo = OrderreturnService::idgetorgan(Yii::app()->user->getOrganID(), 'all');
            ?>
            <div class="content1c float_l">
                <div class="shop_name" style="border-bottom: 1px solid #f0f0f0;line-height:16px;">
                    <div style="float:left;width:70px;text-align: right;margin:5px 0px">卖家：</div>
                    <div class="lanse float_l" style="width:140px;margin:5px 0px"><?php echo $Organinfo->OrganName ?></div>
                    <div style="clear:both"></div>
                </div>
                <p class="shop_pf">综合评分：<span class="shop_zhpf"></span><span class="font">9.7分</span></p>
                <div class="shop_info">
                    <p>评分明细</p>
                    <ul>
                        <li>商品评分：<span class="sppf"></span></li>
                        <li>服务评分：<span class="sppf"></span></li>
                        <li>时效评分：<span class="sppf"></span></span></li>
                    </ul>
                </div>
                <p class="shop_name2">公司名称：<span><?php echo $Organinfo->OrganName ?></span></p>
                <div class="shop_addr" style="margin:5px 0 0 22px">
                    <div style="float:left;">所在地：</div>
                    <div style="width:130px;float: left"><?php echo $Organinfo->Area ?></div>
                </div>
                <div style="clear:both"></div>
                <p class="shop_lianjie"><a href="javascript:void(0)">进入卖家店铺</a></p>
            </div>
            <div style="clear:both"></div>
        </div>
        <div class="content2">
            <div class="content2a float_l">

                <!--content2a1结束-->
                <div class="content2a2">
                    <p class="dnss">店内分类</p>
                    <div class="shop_fenlei">
                        <p class="shop_fenlei2"><span>1080P全高清行车记录仪</span></p>
                        <div class="shop_fenlei_info">
                            <ul>
                                <li><a href="">空气滤清器</a></li>
                                <li><a href="">空气滤清器箱</a></li>
                                <li><a href="">曲轴箱通风滤清器</a>
                                <li><a href="">冷却液滤清器</a></li>
                                <li><a href="">柴油颗粒物质滤清器</a>
                                <li><a href="">机油滤清器托架</a></li> 
                                <li><a href="">燃油滤清器</a></li>
                                <li><a href="">燃油滤清器盖</a></li>
                                <li><a href="">机油滤清器</a>
                                <li><a href="">机油滤清器（转换）接头</a></li>
                                <li><a href="">机油滤清器盖</a>
                                <li><a href="">机油滤清器外壳垫片</a></li>
                                <li><a href="">动力转向液压油滤清器</a>
                                <li><a href="">自动变速箱滤清器</a></li>
                                <li><a href="">碳罐滤清器</a></li>

                            </ul>
                        </div>
                    </div>
                    <div class="shop_fenlei">
                        <p class="shop_fenlei2"><span>1080P全高清行车记录仪</span></p>
                        <div class="shop_fenlei_info">

                            <ul>
                                <li><a href="">空气滤清器</a></li>
                                <li><a href="">空气滤清器箱</a></li>
                                <li><a href="">曲轴箱通风滤清器</a>
                                <li><a href="">冷却液滤清器</a></li>
                                <li><a href="">柴油颗粒物质滤清器</a>
                                <li><a href="">机油滤清器托架</a></li> 
                                <li><a href="">燃油滤清器</a></li>
                                <li><a href="">燃油滤清器盖</a></li>
                                <li><a href="">机油滤清器</a>
                                <li><a href="">机油滤清器（转换）接头</a></li>
                                <li><a href="">机油滤清器盖</a>
                                <li><a href="">机油滤清器外壳垫片</a></li>
                                <li><a href="">动力转向液压油滤清器</a>
                                <li><a href="">自动变速箱滤清器</a></li>
                                <li><a href="">碳罐滤清器</a></li>

                            </ul>



                        </div>
                    </div>
                    <div class="shop_fenlei">
                        <p class="shop_fenlei2"><span>1080P全高清行车记录仪</span></p>
                        <div class="shop_fenlei_info">
                            <ul>
                                <li><a href="">空气滤清器</a></li>
                                <li><a href="">空气滤清器箱</a></li>
                                <li><a href="">曲轴箱通风滤清器</a>
                                <li><a href="">冷却液滤清器</a></li>
                                <li><a href="">柴油颗粒物质滤清器</a>
                                <li><a href="">机油滤清器托架</a></li> 
                                <li><a href="">燃油滤清器</a></li>
                                <li><a href="">燃油滤清器盖</a></li>
                                <li><a href="">机油滤清器</a>
                                <li><a href="">机油滤清器（转换）接头</a></li>
                                <li><a href="">机油滤清器盖</a>
                                <li><a href="">机油滤清器外壳垫片</a></li>
                                <li><a href="">动力转向液压油滤清器</a>
                                <li><a href="">自动变速箱滤清器</a></li>
                                <li><a href="">碳罐滤清器</a></li>

                            </ul>
                        </div>
                    </div>
                    <div class="shop_fenlei">
                        <p class="shop_fenlei2"><span>1080P全高清行车记录仪</span></p>
                        <div class="shop_fenlei_info">
                            <ul>
                                <li><a href="">空气滤清器</a></li>
                                <li><a href="">空气滤清器箱</a></li>
                                <li><a href="">曲轴箱通风滤清器</a>
                                <li><a href="">冷却液滤清器</a></li>
                                <li><a href="">柴油颗粒物质滤清器</a>
                                <li><a href="">机油滤清器托架</a></li> 
                                <li><a href="">燃油滤清器</a></li>
                                <li><a href="">燃油滤清器盖</a></li>
                                <li><a href="">机油滤清器</a>
                                <li><a href="">机油滤清器（转换）接头</a></li>
                                <li><a href="">机油滤清器盖</a>
                                <li><a href="">机油滤清器外壳垫片</a></li>
                                <li><a href="">动力转向液压油滤清器</a>
                                <li><a href="">自动变速箱滤清器</a></li>
                                <li><a href="">碳罐滤清器</a></li>

                            </ul>
                        </div>
                    </div>
                    <div class="shop_fenlei">
                        <p class="shop_fenlei2"><span>1080P全高清行车记录仪</span></p>
                        <div class="shop_fenlei_info">
                            <ul>
                                <li><a href="">空气滤清器</a></li>
                                <li><a href="">空气滤清器箱</a></li>
                                <li><a href="">曲轴箱通风滤清器</a>
                                <li><a href="">冷却液滤清器</a></li>
                                <li><a href="">柴油颗粒物质滤清器</a>
                                <li><a href="">机油滤清器托架</a></li> 
                                <li><a href="">燃油滤清器</a></li>
                                <li><a href="">燃油滤清器盖</a></li>
                                <li><a href="">机油滤清器</a>
                                <li><a href="">机油滤清器（转换）接头</a></li>
                                <li><a href="">机油滤清器盖</a>
                                <li><a href="">机油滤清器外壳垫片</a></li>
                                <li><a href="">动力转向液压油滤清器</a>
                                <li><a href="">自动变速箱滤清器</a></li>
                                <li><a href="">碳罐滤清器</a></li>

                            </ul>
                        </div>
                    </div>
                    <div class="shop_fenlei">
                        <p class="shop_fenlei2"><span>1080P全高清行车记录仪</span></p>
                        <div class="shop_fenlei_info">
                            <ul>
                                <li><a href="">空气滤清器</a></li>
                                <li><a href="">空气滤清器箱</a></li>
                                <li><a href="">曲轴箱通风滤清器</a>
                                <li><a href="">冷却液滤清器</a></li>
                                <li><a href="">柴油颗粒物质滤清器</a>
                                <li><a href="">机油滤清器托架</a></li> 
                                <li><a href="">燃油滤清器</a></li>
                                <li><a href="">燃油滤清器盖</a></li>
                                <li><a href="">机油滤清器</a>
                                <li><a href="">机油滤清器（转换）接头</a></li>
                                <li><a href="">机油滤清器盖</a>
                                <li><a href="">机油滤清器外壳垫片</a></li>
                                <li><a href="">动力转向液压油滤清器</a>
                                <li><a href="">自动变速箱滤清器</a></li>
                                <li><a href="">碳罐滤清器</a></li>

                            </ul>
                        </div>
                    </div>
                    <div class="shop_fenlei">
                        <p class="shop_fenlei2"><span>1080P全高清行车记录仪</span></p>
                        <div class="shop_fenlei_info">
                            <ul>
                                <li><a href="">空气滤清器</a></li>
                                <li><a href="">空气滤清器箱</a></li>
                                <li><a href="">曲轴箱通风滤清器</a>
                                <li><a href="">冷却液滤清器</a></li>
                                <li><a href="">柴油颗粒物质滤清器</a>
                                <li><a href="">机油滤清器托架</a></li> 
                                <li><a href="">燃油滤清器</a></li>
                                <li><a href="">燃油滤清器盖</a></li>
                                <li><a href="">机油滤清器</a>
                                <li><a href="">机油滤清器（转换）接头</a></li>
                                <li><a href="">机油滤清器盖</a>
                                <li><a href="">机油滤清器外壳垫片</a></li>
                                <li><a href="">动力转向液压油滤清器</a>
                                <li><a href="">自动变速箱滤清器</a></li>
                                <li><a href="">碳罐滤清器</a></li>

                            </ul>
                        </div>
                    </div>

                </div>
                <!--content2a2结束-->
                <div class="content2a3">
                    <p class="dnss">店长推荐</p>
                    <div class="dztj">
                        <div class="dztj_info">
                            <div class="tj_img img_box"><img src="<?php echo Yii::app()->theme->baseUrl; ?>/images/papmall/sp160x160.png"></div>
                            <div class="tj_name"><a href="javascript:void(0)">任E行D300行车记录仪高清光</a></div>
                            <div class="tj_price"><span>￥800.00</span></div>
                        </div>
                        <div class="dztj_info">
                            <div class="tj_img img_box"><img src="<?php echo Yii::app()->theme->baseUrl; ?>/images/papmall/sp160x160.png"></div>
                            <div class="tj_name"><a href="javascript:void(0)">任E行D300行车记录仪高清光</a></div>
                            <div class="tj_price"><span>￥800.00</span></div>
                        </div>
                        <div class="dztj_info">
                            <div class="tj_img img_box"><img src="<?php echo Yii::app()->theme->baseUrl; ?>/images/papmall/sp160x160.png"></div>
                            <div class="tj_name"><a href="javascript:void(0)">任E行D300行车记录仪高清光</a></div>
                            <div class="tj_price"><span>￥800.00</span></div>
                        </div>





                    </div>
                    <div class="dztj"></div>


                </div>
                <!--content2a3结束-->
            </div>
            <!--content2a结束-->
            <div class="content2b float_r">
                <div class="content2b1"> 
                    <div id="tab">
                        <div class="t_head">
                            <ul class="tab_menu  float_l">
                                <li class="selected">商品详情</li>
                                <li onclick="showall()">商品评价</li>
                                <li>推荐商品</li>
                            </ul>
                        </div>

                        <div style="clear:both"></div>
                        <div class="tab_box">
                            <div class="spxq">  
                                <div><ul>

                                        <li title="<?php echo $r['GoodsNO'] ?>">商品编号：<?php echo $r['GoodsNO'] ?></li>
                                        <li title="<?php echo DealergoodsService::StandCodegetcpname($r['StandCode'], 'Name'); ?>">标准名称：<?php echo DealergoodsService::StandCodegetcpname($r['StandCode'], 'Name'); ?></li>
                                        <li>品牌：<?php echo $r['BrandName'] ?></li>
                                        <li title="<?php
                                        $PartsLevel = $r['PartsLevel'];
                                        echo Yii::app()->getParams()->PartsLevel[$PartsLevel]
                                        ?> ">配件档次：<?php
                                                $PartsLevel = $r['PartsLevel'];
                                                echo Yii::app()->getParams()->PartsLevel[$PartsLevel]
                                                ?> </li>

                                        <li title="<?php echo $r['BganCompany'] ?>">标杆品牌：<?php echo $r['BganCompany'] ?></li>
                                        <li title="<?php echo $r['BganGoodsNO'] ?>">标杆商品号：<?php echo $r['BganGoodsNO'] ?></li>
                                        <?php $units = GoodsUnit::model()->find("ID=:id", array(":id" => $r['Unit'])); ?>
                                        <li>单位：<?php echo $units->UnitName ?></li>
                                        <li>最小包装数：<?php echo $r['MinQuantity'] ?></li>
                                        <?php if ($r['ValidityType'] == 3): ?>
                                            <li>保修时间：<?php echo $r['ValidityDate']; ?></li>
                                        <?php endif; ?>
                                        <div style="clear:both; padding:0px"></div>
                                    </ul>
                                    <div style="clear:both;padding:0px"></div>
                                    <p style="">OE号：<?php
                                        foreach ($r['OENOS'] as $key => $value) {
                                            if ($key == 0) {
                                                echo $value;
                                            } else {
                                                echo '、' . $value;
                                            }
                                        }
                                        ?>
                                    </p>
                                    <p style="color:#ff5500;word-break:break-all;line-height:20px">特征说明：<?php echo $r['Memo'] ?></p><br/>
                                    <div class="goods_info" style="word-wrap:break-word;padding:0px"><?php echo $r['Info'] ?></div>   
                                    <div style="clear:both"></div>
                                </div></div>

                            <div class="hide sppj">
                                <div class="column">
                                    <div style="height:40px; line-height:40px;background:#FBFCFC;  border:1px solid #e2e2e2; padding:0">                
                                        <form style="margin-left:20px; float:left"> 
                                            <input name="pl" id="all" type="radio" value="all" onclick="show('all')" checked="checked" style="vertical-align:middle; margin-top:0"/><label for="all">全部</label>
                                            <input name="pl" id="good" type="radio" value="good" onclick="show('good')"/><label for="good">好评</label>
                                            <input name="pl" id="medium" type="radio" value="medium" onclick="show('medium')"/><label for="medium">中评 </label>
                                            <input name="pl" id="bad" type="radio" value="bad" onclick="show('bad')"/><label for="bad">差评</label>
                                            <input id="evastatus" type="hidden" value="all"/>
                                            <input id="evaempty" type="hidden" value="content"/>
                                            <input id="evaorder" type="hidden" value="orderID"/>
                                            <input id="goodsid" type="hidden" value="<?php echo $r['GoodsID'] ?>"/>
                                            <input id="organid" type="hidden" value="<?php echo $r['SellerID'] ?>"/>
            <!--                                           <input name="pl" type="radio" value="" />追评<span style="color:#ccc">（37）</span>
                                                    <input name="pl" type="radio" value="" /><img src="images/tupiantubiao.png" style="vertical-align:middle; margin-top:0">图片<span style="color:#ccc">（37）</span>-->
                                        </form>
                                        <div style="float:right; height:40px; line-height:40px; *width:250px">
                                            <div style="float:left">　<input checked="checked" type="checkbox" id="content" style="vertical-align:middle;" onclick="show('content')"/><label for="content">有内容的评价</label></div>
                                         　　<span style="float:right;*margin-top:-40px"> <select style="margin:10px" class="select">
                                           　　　 <option value="" onclick="show('orderID')">推荐排序 
                                           　　　 <option value="" onclick="show('ordertimeup')">评价时间升序
                                            　　　<option value="" onclick="show('ordertimedrop')">评价时间降序 
                                          　　</select></span>
                                        </div>
                                    </div>
                                    <div class="zxq_pl">
                                        <ul class="eva-list">
                                        </ul>
                                        <div class="pagelist text-c" id="evapageid">
                                            <span class="pageeva"><?php echo $page; ?></span>
                                            <span class="pagego">去第<input type="text" style="width:20px" value="" class="input" id="evapage">页
                                                <span class="btn-tiny" id="gopage" style="cursor: pointer;">GO</span>
                                            </span>
                                        </div>
                                    </div>
                                </div>
                            </div>


                            <!--                            <div style="height:40px; line-height:40px;background:#FBFCFC;  border:1px solid #e2e2e2; padding:0">     
                                                            <form style="margin-left:20px; float:left"> 
                                                                <input name="pl" type="radio" value=""  class="middle"/>全部
                                                                <input name="pl" type="radio" value="" class="middle"/>好评<span style="color:#ccc">（37）</span>
                                                                <input name="pl" type="radio" value="" class="middle"/>中评<span style="color:#ccc">（37）</span> 
                                                                <input name="pl" type="radio" value="" class="middle"/>差评<span style="color:#ccc">（37）</span>
                                                                <input name="pl" type="radio" value="" class="middle"/>追评<span style="color:#ccc">（37）</span>
                                                                <input name="pl" type="radio" value="" class="middle"/><img src="<?php echo Yii::app()->theme->baseUrl; ?>/images/papmall/tupiantubiao.png" style="vertical-align:middle; margin-top:0">图片<span style="color:#ccc">（37）</span>
                                                            </form>
                                                            <div style="float:right; height:40px; line-height:40px; *width:250px; padding:0">
                                                                <div style="float:left; padding:0">　<input checked="checked" type="checkbox" style="vertical-align:middle;"/>有内容的评价</div>
                                         　　<div style="float:right;*margin-top:-40px"> 
                                                                    <select style="margin:10px">
                                           　　　 <option value="推荐排序">推荐排序</option> 
                                           　　　 <option value="推荐排序2">推荐排序2</option>
                                            　　　<option value="推荐排序3">推荐排序3 </option>
                                            　　　<option value="推荐排序4">推荐排序4</option>
                            
                                          　　</select></div>
                            
                                                            </div>
                                                            <div style="clear:both"></div>
      iv                                                  </div>
                                                        <div class="zxq_pl">        
                            <?php
//                                $this->widget('widgets.default.WListView', array(
//                                    'dataProvider' => $data,
//                                    // 'headerView' => 'goodshead',
//                                    'itemView' => 'goodseval',
//                                    'id' => 'goodsevalview'
//                                ));
                            ?>
                                                            <div style="clear:both"></div>
                                                        </div>-->

                            <div class="hide  sptj">
                                <div class="zxq_sp_tj m_left20" >

                                    <div class="zxq_sp_tj_tp">
                                        <img src="<?php echo Yii::app()->theme->baseUrl; ?>/images/papmall/default-goods.png">
                                    </div><br>
                                    <span class="zxq_sp_tj_mc"><a href="javascript:;">测试商品1测试</a></span>
                                </div>
                                <div style="clear:both"></div> 
                            </div>
                        </div>
                    </div>         
                </div>    
            </div>
            <div style="clear:both"></div>
        </div>  
    </div>
</div>
<?php
//最小交易额弹框
$this->beginWidget('zii.widgets.jui.CJuiDialog', array(
    'id' => 'bunow',
    'options' => array(
        'title' => '提示信息',
        'width' => 400,
        'height' => 200,
        'autoOpen' => false,
        'resizable' => false,
        'modal' => true,
        'overlay' => array(
            'backgroundColor' => '#000',
            'opacity' => '0.5'
        ),
        'buttons' => array(
            '继续采购' => 'js:function(){ window.open(Yii_baseUrl + "/pap/default/index","_blank");}',
            '立即购买' => 'js:function(){ 
                          var goodsID = $(this).attr("goodsid");
                          var quant = $("#qty_item").val();      
                          var nurl = Yii_baseUrl + "/mall/buy/buynow/goodsid/"+goodsID+"/goods_amout/"+quant+"";
                            window.open(nurl,"_blank");
                      }',
        ),
    ),
));
echo '<div id="minorder">最小交易额<div> ';
$this->endWidget('zii.widgets.jui.CJuiDialog');
?>     
<!--商品评价-->
<script id="evaTemplate" type="text/x-jquery-tmpl">  
    <li>
    <div class="float_l zxq_w100" style="height:100px">
    <div class="zxq_yh">
    <a href=""><img src="<?php echo F::uploadUrl() ?>${GoodsIMG}" class="zxq_yh_tp"></a><br><span class="zxq_yh_mc"><a href="javascript:;">${BuyerName}</a></span>
    </div>
    </div>
    <div class="float_l zxq_yh_Pl_info" style="height:85px">
    <div style="height: 60px">${BuyerToEvalRemark}</div>
    <p class="zxq_pl_xx"><span>${BCreateTime}</span><span style="margin-left:10px">${SCreateTime}</span>
    </p>
    </div>
    </li>
</script> 
<SCRIPT type=text/javascript>
    $(document).ready(function() {
        $('.xian').show();
        $('#make-select').attr("disabled", "disabled");


        //  跳转到几页
        $("#gopage").click(function() {
            if (/[\d]/.test($("#evapage").val())) {
                var page = $("#evapage").val();
                page = Math.round(page);
                if (page <= 1) {
                    page = 1;
                }
                if (/[\d]/.test($(".pageeva a").eq("-1").text())) {
                    var count = $(".pageeva a").eq("-1").text();
                } else {
                    var count = $(".pageeva a").eq("-2").text();
                }
                if (page > count) {
                    page = count;
                }
                show(page);
            } else {
                show(1);
            }
        })
    })


    function showall() {
        $("#all").click();
    }


    function getSearcheva(page) {
        if (!isNaN(page)) {
            var pages = page;
            $("#evapage").val(page);
        } else {
            $("#evapage").val('1');
            var pages = 1;
        }
        var status = $('#evastatus').val();
        var content = $('#evaempty').val();
        var order = $('#evaorder').val();
        var goodsid = $('#goodsid').val();
        var organid = $('#organid').val();
        return {
            'goodsid': goodsid,
            'organid': organid,
            // 排序
            'orderby': order,
            'content': content,
            'page': pages,
            'status': status
        };
    }

    function show(page) {
        if (page == 'all' || page == 'good' || page == 'medium' || page == 'bad') {
            $('#evastatus').val(page);
        } else if (page == 'content') {
            if ($('#evaempty').val() == 'content') {
                $('#evaempty').val('nocontent');
            } else {
                $('#evaempty').val('content');
            }
        } else if (page == 'orderID' || page == 'ordertimeup' || page == 'ordertimedrop') {
            $('#evaorder').val(page);
        }
        var data = getSearcheva(page);
        $.getJSON("<?php echo yii::app()->createUrl('pap/Mall/Geteva') ?>",
                data,
                function(data) {
                    $(".eva-list li").remove();
                    if (data.rows) {
                        $.each(data.rows, function(index, value) {
                            var html = "<li class='pl_li'>";
                            html += "<div class='float_l zxq_w100' style='height:100px'>";
                            html += "<div class='zxq_yh'>";
                            html += "<a><img src='<?php echo F::uploadUrl() ?>" + value.GoodsIMG + "' class='zxq_yh_tp'></a><br><span class='zxq_yh_mc'><a href='javascript:;'>" + value.BuyerName + "</a></span>";
                            html += "</div>";
                            html += "</div>";
                            html += "<div class='float_l zxq_yh_Pl_info'>";
                            html += "<span>" + value.BuyerToEvalRemark + "</span>";
                            html += "<p class='zxq_pl_xx'><span>" + value.BCreateTime + "</span><span class='m_left10'>" + value.SCreateTime + "</span>";
                            html += "</p>";
                            html += "</div>";
                            html += "</li>";
                            $(".eva-list").append(html);
                        });

                        $(".pageeva").html(data.page);
                        $(".pagego").show();
                    } else {
                        $(".pageeva").html('');
                        $(".pagego").hide();
                    }
                    //            $(window).resize();

                });
    }



    $(document).ready(function() {
        $(".jqzoom").jqueryzoom({
            xzoom: 400,
            yzoom: 400,
            offset: 10,
            preload: 1,
            lens: 1
        });
        $("#spec-list img").bind("mouseover", function() {
            var src = $(this).attr("src");
            $("#spec-n1 img").eq(0).attr({
                src: src.replace("\/n5\/", "\/n1\/"),
                jqimg: src.replace("\/n5\/", "\/n0\/")
            });
            $(this).css({
                "border": "2px solid #ff6600",
                "padding": "1px"
            });
            $(this).parent().siblings("").children().css({"border": "1px solid #ccc",
                "padding": "2px"});
        })
        var $tab_li = $('#tab ul li');
        $tab_li.click(function() {
            $(this).addClass('selected').siblings().removeClass('selected');
            var index = $tab_li.index(this);
            $('div.tab_box > div').eq(index).show().siblings().hide();
        });
    })

    //设置数量
    function setAmount(obj) {
        if (isNaN(obj.value)) {
            alert('请输入一个整数');
        }
        obj.value = obj.value.replace(/\D/g, '');
        if (obj.value.substr(0, 1) == '0')
            obj.value = obj.value.substr(1);
        var val = parseInt(obj.value);
        if (val < 1 || !val) {
            obj.value = 1;
        }
        if (val > 100) {
            alert('数量最多为100');
            obj.value = 100;
        }
    }

    function addGoodsToCar(goodsid, quant) {
        $.getJSON("<?php echo Yii::app()->createUrl('pap/mall/addgoodstocar') ?>",
                {goodsid: goodsid, quant: quant},
        function(data) {
            //alert(data);return false;
            //getCartCount();
            if (data) {
                alert('添加成功！');
                //getCartCount();
            }
        });
    }
</SCRIPT>

<script type='text/javascript'>
    (function($) {
        $.fn.jqueryzoom = function(options) {
            var settings = {
                xzoom: 200,
                yzoom: 200,
                offset: 10,
                position: "right",
                lens: 1,
                preload: 1};
            if (options) {
                $.extend(settings, options);
            }
            var noalt = '';
            $(this).hover(function() {
                var imageLeft = $(this).offset().left;
                var imageTop = $(this).offset().top;
                var imageWidth = $(this).children('img').get(0).offsetWidth;
                var imageHeight = $(this).children('img').get(0).offsetHeight;
                noalt = $(this).children("img").attr("alt");
                var bigimage = $(this).children("img").attr("jqimg");
                $(this).children("img").attr("alt", '');
                if ($("div.zoomdiv").get().length == 0) {
                    $(this).after("<div class='zoomdiv'><img class='bigimg' src='" + bigimage + "'/></div>");
                    $(this).append("<div class='jqZoomPup'>&nbsp;</div>");
                }
                if (settings.position == "right") {
                    if (imageLeft + imageWidth + settings.offset + settings.xzoom > screen.width) {
                        leftpos = imageLeft - settings.offset - settings.xzoom;
                    } else {
                        leftpos = imageLeft + imageWidth + settings.offset;
                    }
                } else {
                    leftpos = imageLeft - settings.xzoom - settings.offset;
                    if (leftpos < 0) {
                        leftpos = imageLeft + imageWidth + settings.offset;
                    }
                }
                $("div.zoomdiv").css({top: imageTop, left: leftpos});
                $("div.zoomdiv").width(settings.xzoom);
                $("div.zoomdiv").height(settings.yzoom);
                $("div.zoomdiv").show();
                if (!settings.lens) {
                    $(this).css('cursor', 'crosshair');
                }
                $(document.body).mousemove(function(e) {
                    mouse = new MouseEvent(e);
                    var bigwidth = $(".bigimg").get(0).offsetWidth;
                    var bigheight = $(".bigimg").get(0).offsetHeight;
                    var scaley = 'x';
                    var scalex = 'y';
                    if (isNaN(scalex) | isNaN(scaley)) {
                        var scalex = (bigwidth / imageWidth);
                        var scaley = (bigheight / imageHeight);
                        $("div.jqZoomPup").width((settings.xzoom) / (scalex * 1));
                        $("div.jqZoomPup").height((settings.yzoom) / (scaley * 1));
                        if (settings.lens) {
                            $("div.jqZoomPup").css('visibility', 'visible');
                        }
                    }
                    xpos = mouse.x - $("div.jqZoomPup").width() / 2 - imageLeft;
                    ypos = mouse.y - $("div.jqZoomPup").height() / 2 - imageTop;
                    if (settings.lens) {
                        xpos = (mouse.x - $("div.jqZoomPup").width() / 2 < imageLeft) ? 0 : (mouse.x + $("div.jqZoomPup").width() / 2 > imageWidth + imageLeft) ? (imageWidth - $("div.jqZoomPup").width() - 2) : xpos;
                        ypos = (mouse.y - $("div.jqZoomPup").height() / 2 < imageTop) ? 0 : (mouse.y + $("div.jqZoomPup").height() / 2 > imageHeight + imageTop) ? (imageHeight - $("div.jqZoomPup").height() - 2) : ypos;
                    }
                    if (settings.lens) {
                        $("div.jqZoomPup").css({top: ypos, left: xpos});
                    }
                    scrolly = ypos;
                    $("div.zoomdiv").get(0).scrollTop = scrolly * scaley;
                    scrollx = xpos;
                    $("div.zoomdiv").get(0).scrollLeft = (scrollx) * scalex;
                });
            }, function() {
                $(this).children("img").attr("alt", noalt);
                $(document.body).unbind("mousemove");
                if (settings.lens) {
                    $("div.jqZoomPup").remove();
                }
                $("div.zoomdiv").remove();
            });
            count = 0;
            if (settings.preload) {
                $('body').append("<div style='display:none;' class='jqPreload" + count + "'>360buy</div>");
                $(this).each(function() {
                    var imagetopreload = $(this).children("img").attr("jqimg");
                    var content = jQuery('div.jqPreload' + count + '').html();
                    jQuery('div.jqPreload' + count + '').html(content + '<img src=\"' + imagetopreload + '\">');
                });
            }
        }
    })(jQuery);
    function MouseEvent(e) {
        this.x = e.pageX;
        this.y = e.pageY;
    }
</script>
