<?php if (Yii::app()->user->isDealer()) : ?>
    <div class="site-nav" >
        <div class="site-nav-info">
            <a href="javascript:void(0)" title="由你配"><img src="<?php echo Yii::app()->theme->baseUrl ?>/images/shophome/logo.jpg" class="float_l"></a>
            <div class="head-customer float_l">
                <?php //echo Yii::app()->user->getLogTitle();    ?>
                <div class="name-customer">
                    您好,<?php echo Yii::app()->user->name ?>
                    <div class="name-customer-info">
                        <ul>
                            <li><a href="javascript:void(0)">账户管理</a></li>
                            <li><a href="javascript:void(0)">公司信息管理</a></li>
                            <li><a href="javascript:void(0)">金融账户管理</a></li>
                            <li><a href="javascript:void(0)">子账户管理</a></li>
                            <li><a href="javascript:void(0)">权限管理</a></li>
                            <li class="layout">
                                <?php echo CHtml::link('退出登录', Yii::app()->createUrl('/user/logout')) ?></li>
    <!--                                <a href="<?php echo Yii::app()->createUrl('/user/logout') ?>">退出登录</a></li>             -->
                        </ul>
                    </div>
                </div>
            </div>
            <div class="head-gwc">
                <div class="wenz2 float_l">我的购物车</div>
                <a href="javascript:void(0)" > 
                    <div class="head-gwc-info  float_l">
                        <span class="amount" style="color:#fff">0</span>
                    </div>
                </a>
            </div>
            <div class="head-help float_r">

                <ul class="float_l">
                    <li class="xiaoxi" >
                        <?php $this->widget('widgets.papmall.TopNews'); ?>
                        <span style="color:#0164c1">|</span>
                    </li>
                    <li class="newpeople">
                        <a href="javascript:void(0)">新手指引</a>
                        <span style="color:#0164c1">|</span>
                    </li>
                    <li class="helpcenter">
                        <a   href="javascript:void(0)">帮助中心</a>

                    </li>
                </ul>
                <div class="float_r"> <img src="<?php echo F::themeUrl() . '/images/shophome/tel.png' ?>" class="tel-img"/></div>     
                <div class="clear"></div>
            </div>
            <div class="clear"></div>
        </div>
    </div>
    <div class="head">
        <div class="com-step1">
            <div class="float_l "><img src="<?php echo Yii::app()->theme->baseUrl ?>/images/shophome/com-step1.jpg"></div>
            <div class="float_l m_left140">
                <img src="<?php echo Yii::app()->theme->baseUrl ?>/images/shophome/cx-bg.jpg">
            </div>
            <div class="choice-cx float_l">
                <p class="p-choice" id="make-select-mall"  onclick="ajaxLoading()">
                    <?php
                    $cookie = Yii::app()->request->getCookies();
                    $car = array('make' => $cookie['mallmake']->value, 'series' => $cookie['mallseries']->value, 'year' => $cookie['mallyear']->value, 'model' => $cookie['mallmodel']->value);
                    if ($car['make']):
                        $str = MallService::getCarmodeltxt($car);
                        ?>
                        <a href="javascript:void(0)" id='veh'>更换车型</a>
                    <?php else: ?>
                        <a href="javascript:void(0)" id='veh'>选择车型</a>
                    <?php endif; ?>
                    <!--                <a href="javascript:;" id='veh'>选择车型</a>-->
                </p>

                <p class="p-choiced" style='display:none' ></p>
                <input type="hidden" id="vechileold" value="<?php echo $str ? $str : ''; ?>">
                <p class="line20 p-choice1">请先选择您的车型，我们将为您提供精准匹配车型的商品！</p>
    <!--            <p class="p-choice2 line20"><a href="javascript:;" >更换车型</a></p>-->

            </div>
            <input type="hidden" id="search_value" value="<?php echo $str; ?>">

            <div class="clear"></div>
        </div>
        <div class="com-step2">
            <div class="float_l"><img src="<?php echo Yii::app()->theme->baseUrl ?>/images/shophome/com-step2.jpg"></div>
            <div class="float_l com-step2-info">
                <div class="head-search float_l">
                    <p class="line30"><b>方式一</b>：搜索</p>
                    <div class="J_SearchTab">
                        <ul>
                            <li><a>按配件名称</a></li>
                            <li><a>按商品编号</a></li>
                            <li><a>按OE号</a></li>
                            <div class="clear"></div>
                        </ul>
                    </div>
                    <div class="search-bd sousuo">
                        <!--                        <form action="2.html" > -->
                        <div class="search-bd-info search-bd-info1 ">
                            <input class="input keyword" id="tt" value="请输入关键字|拼音搜索" name='search_keyword' style="border:none; margin-left:30px; height:18px; line-height:20px; padding:6px 3px; outline:none; background:#fff;*padding-top:5px ">
                            <input type="submit"  value="查询" class="submit" >
                        </div>
                        <div class="search-bd-info search-bd-info2 " style="display: none">
                            <input class="input goodsno" value="请输入商品编号搜索" name='search_keyword' style="border:none; margin-left:30px; height:18px; line-height:20px; padding:6px 3px; outline:none; background:#fff ;*padding-top:5px">
                            <input type="submit"  value="查询" class="submit">
                        </div>
                        <div class="search-bd-info search-bd-info3 " style="display: none">
                            <input class="input oe" value="请输入OE号搜索" name='search_keyword' style="border:none; margin-left:30px; height:18px; line-height:20px; padding:6px 3px; outline:none; background:#fff;*padding-top:5px ">
                            <input type="submit"  value="查询" class="submit">
                        </div>
                        <input type="hidden" id="cur" value="<?php echo $_GET['seatype'] ? $_GET['seatype'] : '' ?>">
                        <!--</form>-->
                    </div>
                </div>
                <p class="example  float_l"><span class="tishi">说明</span></p>
                <div class="head-nav float_l m_left20" id="default" target="default">
                    <p class="line30 m_left20"><b>方式二</b>：按汽车结构查找</p>
                    <?php if ($this->beginCache('front_homecategory')) : ?>
                        <div class="haed-nav">
                            <div class="head-nav-info">
                                <ul>
                                    <?php foreach ($bignameArr_l as $k => $val): ?>
                                        <li class="first">
                                            <a href="javascript:;"><?php echo $val ?> 
                                                <?php if (in_array($k, array(0, 1))): ?>
                                                    <img src="<?php echo F::themeUrl() . '/images/shophome/hot.png' ?>">
                                                <?php endif ?>
                                            </a>
                                            <div class="second-nav second-nav9">
                                                <div class="second-nav-info">
                                                    <div class="float_l hot w420">
                                                        <p>热门配件</p> 
                                                        <div class="hot-info">
                                                            <?php
                                                            if (!empty($MainCategory) && is_array($MainCategory)):
                                                                foreach ($MainCategory as $key => $cate):
                                                                    ?>
                                                                    <?php if ($cate["Name"] == $val): ?>
                                                                        <?php foreach ($MainCategory[$key]['children'] as $k => $v): ?>
                                                                            <div class="float_l">
                                                                                <b><?php echo $v['Name'] ?></b>
                                                                                <ul class="standname">
                                                                                    <?php
                                                                                    $stand = DefaultService::getMainCategorys($v['ID']);
                                                                                    if (is_array($stand)):
                                                                                        foreach ($stand as $sk => $sv):
                                                                                            if (in_array($sk, array(0, 1, 2))):
                                                                                                ?>
                                                                                                <li class="overflow"><a href="javascript:void(0)"  title="<?php echo $sv['Name']; ?>"><?php echo $sv['Name']; ?></a></li>
                                                                                                <?php
                                                                                            endif;
                                                                                        endforeach;
                                                                                        ?>
                                                                                    <?php endif; ?>
                                                                                    <li class="last"><a href="javascript:void(0)" >更多</a></li>
                                                                                </ul>
                                                                            </div>
                                                                        <?php endforeach; ?>
                                                                        <?php
//                                                            unset($MainCategory[$key]);
//                                                            break;
                                                                        ?>
                                                                    <?php endif; ?>
                                                                    <?php
                                                                endforeach;
                                                            endif
                                                            ?>
                                                            <div class="clear"></div>
                                                        </div>
                                                    </div>
                                                    <div class="float_r all">
                                                        <p>所有分类</p>
                                                        <ul>
                                                            <?php
                                                            if (!empty($MainCategory) && is_array($MainCategory)):
                                                                foreach ($MainCategory as $key => $cate):
                                                                    ?>
                                                                    <?php if ($cate["Name"] == $val): ?>
                                                                        <?php foreach ($MainCategory[$key]['children'] as $k => $v): ?>
                                                                            <li><a href="javascript:void(0)"  title='<?php echo $v['Name'] ?>'><?php echo $v['Name'] ?></a></li>
                                                                            <?php
                                                                        endforeach;
                                                                    endif;
                                                                endforeach;
                                                            endif;
                                                            ?>
                                                        </ul>
                                                    </div>
                                                    <div class="clear"></div>
                                                </div>
                                                <div class="clear"></div>
                                            </div>
                                        </li>
                                    <?php endforeach; ?>

                                    <?php foreach ($bignameArr_r as $k => $val): ?>
                                        <li class="first">
                                            <a href="javascript:;"><?php echo $val ?></a>
                                            <div class="second-nav second-nav9">
                                                <div class="second-nav-info">
                                                    <div class="float_l hot w420">
                                                        <p>热门配件</p> 
                                                        <div class="hot-info">
                                                            <?php
                                                            if (!empty($MainCategory) && is_array($MainCategory)):
                                                                foreach ($MainCategory as $key => $cate):
                                                                    ?>
                                                                    <?php if ($cate["Name"] == $val): ?>
                                                                        <?php foreach ($MainCategory[$key]['children'] as $k => $v): ?>
                                                                            <div class="float_l">
                                                                                <b class='overflow'><?php echo $v['Name'] ?></b>
                                                                                <ul class="standname">
                                                                                    <?php
                                                                                    $stand = DefaultService::getMainCategorys($v['ID']);
                                                                                    if (is_array($stand)):
                                                                                        foreach ($stand as $sk => $sv):
                                                                                            if (in_array($sk, array(0, 1, 2))):
                                                                                                ?>
                                                                                                <li class='overflow'><a href="javascript:void(0)"  title='<?php echo $sv['Name'] ?>'><?php echo $sv['Name'] ?></a></li>
                                                                                                <?php
                                                                                            endif;
                                                                                        endforeach;
                                                                                        ?>
                                                                                    <?php endif; ?>
                                                                                    <li class="last"><a href="javascript:void(0)" targe='_blank'>更多</a></li>
                                                                                </ul>
                                                                            </div>
                                                                        <?php endforeach; ?>
                                                                        <?php
//                                                            unset($MainCategory[$key]);
//                                                            break;
                                                                        ?>
                                                                    <?php endif; ?>
                                                                    <?php
                                                                endforeach;
                                                            endif;
                                                            ?>
                                                            <div class="clear"></div>
                                                        </div>
                                                    </div>
                                                    <div class="float_r all">
                                                        <p>所有分类</p>
                                                        <ul>
                                                            <?php
                                                            if (!empty($MainCategory) && is_array($MainCategory)):
                                                                foreach ($MainCategory as $key => $cate):
                                                                    ?>
                                                                    <?php if ($cate["Name"] == $val): ?>
                                                                        <?php foreach ($MainCategory[$key]['children'] as $k => $v): ?>
                                                                            <li class='overflow'><a href="javascript:void(0)"  title='<?php echo $v['Name'] ?>'><?php echo $v['Name'] ?></a></li>
                                                                            <?php
                                                                        endforeach;
                                                                    endif;
                                                                endforeach;
                                                            endif;
                                                            ?>
                                                        </ul>
                                                    </div>
                                                    <div class="clear"></div>
                                                </div>
                                            </div>
                                        </li>
                                    <?php endforeach; ?>   
                                    <div class="clear"></div>
                                </ul>
                            </div>
                        </div>   
                        <?php $this->endCache(); ?>
                    <?php endif; ?> 
                </div>
                <div class="promtion" >
                    <table class="table" cellpadding="1" cellspacing="0" style="padding:5px">
                        <thead><tr class="table-hd"><td width="150px">搜索类型</td><td width="300px" style="border-right:none">输入</td></tr></thead>
                        <tbody>
                            <tr><td>配件名称</td><td style="border-right:none">散热器或水箱</td></tr>
                            <tr><td>配件名称拼音首字母</td><td style="border-right:none">srq或sx</td></tr>
                            <tr><td>配件名称全拼</td><td style="border-right:none">sanreqi或shuixiang或suixiang</td></tr>
                            <tr><td>OE号</td><td style="border-right:none">S21-8107310</td></tr>
                            <tr><td>商品编号</td><td style="border-right:none">S21-8107310-KY</td></tr>
                            <tr><td>商品编号+品牌</td><td style="border-right:none">S21-8107310-KY 科越</td></tr>
                            <tr><td>配件名称+品牌</td><td style="border-right:none">散热器 科越或sanreqi 科越或srq 科越或shuixiang 科越或suixiang 科越或sx 科越</td></tr>
                        </tbody>
                    </table>
                </div>
                <div class="clear"></div>
            </div>
            <div class="clear"></div>
        </div>
        <div class="clear"></div>
        <div class="com-zk">隐藏</div>
    </div>
<?php endif; ?>