<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <title>新手入门指引</title>
        <link href="<?php echo Yii::app()->theme->baseUrl; ?>/css/newer/style.css" rel="stylesheet" type="text/css" />
        <script src="<?php echo Yii::app()->theme->baseUrl; ?>/js/newer/jquery-1.7.2.min.js" type="text/javascript"></script>
        <script src="<?php echo Yii::app()->theme->baseUrl; ?>/js/newer/script.js" type="text/javascript"></script>
        <style>

            .width1000{ display:none}
        </style>
    </head>
    <body>

        <div class="head">
            <div class="header">

                <a href="http://www.unipei.com" class="logo fleft"><img src="<?php echo Yii::app()->theme->baseUrl; ?>/images/newer/logo.png" /></a>

                <div class="nav fleft">

                    <ul>
                        <!--账户登录-->
                        <li class="nav_i ">
                            <span><a href="<?php echo yii::app()->createUrl('servicer/default/newer', array('goto' => 'newerindex')) ?>">账户登录</a></span>
                            <div class="nav2">
                                <ul>
                                    <li class="r_i_xuan_z"><a href="<?php echo yii::app()->createUrl('servicer/default/newer', array('goto' => 'newerindex')) ?><?php echo yii::app()->createUrl('servicer/default/newer', array('goto' => 'newerindex')) ?>">第一步</a></li>
                                    <li class=""><a href="<?php echo yii::app()->createUrl('servicer/default/newer', array('goto' => 'login-step2')) ?>">第二步</a></li>
                                </ul>
                            </div>
                        </li>
                        <!--挑选商品-->
                        <li class="nav_i    r_ind_nav ">
                            <span><a href="<?php echo yii::app()->createUrl('servicer/default/newer', array('goto' => 'choice1')) ?>">挑选商品</a></span>
                            <div class="nav2">
                                <ul>
                                    <li><a href="<?php echo yii::app()->createUrl('servicer/default/newer', array('goto' => 'choice1')) ?>">方式1：通过商城下单</a></li>
                                    <li class="r_i_xuan_z"><a href="<?php echo yii::app()->createUrl('servicer/default/newer', array('goto' => 'choice2')) ?>">方式2：通过询价单生成订单</a></li>	
                                </ul>
                            </div>  
                        </li>
                        <!--提交订单-->	
                        <li class="nav_i">
                            <span><a href="<?php echo yii::app()->createUrl('servicer/default/newer', array('goto' => 'submit-step1')) ?>">提交订单</a></span>
                            <div class="nav2">
                                <ul>
                                    <li><a href="<?php echo yii::app()->createUrl('servicer/default/newer', array('goto' => 'submit-step1')) ?>">第一步</a></li>
                                    <li><a href="<?php echo yii::app()->createUrl('servicer/default/newer', array('goto' => 'submit-step2')) ?>">第二步</a></li>
                                    <li><a href="<?php echo yii::app()->createUrl('servicer/default/newer', array('goto' => 'submit-step3')) ?>">第三步</a></li>
                                    <li><a href="<?php echo yii::app()->createUrl('servicer/default/newer', array('goto' => 'submit-step4')) ?>">第四步</a></li>
                                    <li><a href="<?php echo yii::app()->createUrl('servicer/default/newer', array('goto' => 'submit-step5')) ?>">第五步</a></li>
                                </ul>
                            </div>
                        </li>

                        <li class="nav_i">
                            <span><a href="<?php echo yii::app()->createUrl('servicer/default/newer', array('goto' => 'check-step1')) ?>">查看订单状态</a></span>
                            <div class="nav2">
                                <ul>
                                    <li><a href="<?php echo yii::app()->createUrl('servicer/default/newer', array('goto' => 'check-step1')) ?>">第一步</a></li>
                                    <li><a href="<?php echo yii::app()->createUrl('servicer/default/newer', array('goto' => 'check-step2')) ?>">第二步</a></li>
                                    <li><a href="<?php echo yii::app()->createUrl('servicer/default/newer', array('goto' => 'check-step3')) ?>">第三步</a></li>
                                    <li><a href="<?php echo yii::app()->createUrl('servicer/default/newer', array('goto' => 'check-step4')) ?>">第四步</a></li>
                                    <li><a href="<?php echo yii::app()->createUrl('servicer/default/newer', array('goto' => 'check-step5')) ?>">第五步</a></li>
                                </ul>
                            </div>
                        </li>
                        <li class="nav_i ">
                            <span><a href="<?php echo yii::app()->createUrl('servicer/default/newer', array('goto' => 'assess-step1')) ?>">收货及评价</a></span>
                            <div class="nav2">
                                <ul>
                                    <li><a href="<?php echo yii::app()->createUrl('servicer/default/newer', array('goto' => 'assess-step1')) ?>">第一步	</a></li>
                                    <li><a href="<?php echo yii::app()->createUrl('servicer/default/newer', array('goto' => 'assess-step2')) ?>">第二步</a></li>
                                    <li><a href="<?php echo yii::app()->createUrl('servicer/default/newer', array('goto' => 'assess-step3')) ?>">第三步</a></li>
<!--                                    <li><a href="<?php //echo yii::app()->createUrl('servicer/default/newer', array('goto' => 'assess-step4')) ?>">第四步</a></li>
                                    <li><a href="<?php //echo yii::app()->createUrl('servicer/default/newer', array('goto' => 'assess-step5')) ?>">第五步</a></li>
                                    <li><a href="<?php //echo yii::app()->createUrl('servicer/default/newer', array('goto' => 'assess-step6')) ?>">第六步</a></li>
                                    <li><a href="<?php //echo yii::app()->createUrl('servicer/default/newer', array('goto' => 'assess-step7')) ?>">第七步</a></li>-->
                                </ul>
                            </div>
                        </li>
                        <li class="nav_i ">
                            <span><a href="<?php echo yii::app()->createUrl('servicer/default/newer', array('goto' => 'return-step1')) ?>">申请退换货</a></span>
                            <div class="nav2  padding20">
                                <ul>
                                    <li><a href="<?php echo yii::app()->createUrl('servicer/default/newer', array('goto' => 'return-step1')) ?>">第一步</a></li>
                                    <li><a href="<?php echo yii::app()->createUrl('servicer/default/newer', array('goto' => 'return-step2')) ?>">第二步</a></li>
                                    <li><a href="<?php echo yii::app()->createUrl('servicer/default/newer', array('goto' => 'return-step3')) ?>">第三步</a></li>
                                    <li><a href="<?php echo yii::app()->createUrl('servicer/default/newer', array('goto' => 'return-step4')) ?>">第四步</a></li>
                                    <li><a href="<?php echo yii::app()->createUrl('servicer/default/newer', array('goto' => 'return-step5')) ?>">第五步</a></li>
                                    <li><a href="<?php echo yii::app()->createUrl('servicer/default/newer', array('goto' => 'return-step6')) ?>">第六步</a></li>
                                    <li><a href="<?php echo yii::app()->createUrl('servicer/default/newer', array('goto' => 'return-step7')) ?>">第七步</a></li>

                                </ul>
                            </div>
                        </li>
                    </ul>
                </div>


            </div>
        </div>
        <div class="head-nav">
            <div class="head-nav-info">
                <ul>
                    <li class="active">第一步</li>
                    <li>第二步</li>
                    <li>第三步</li>
                    <li>第四步</li>
                    <li>第五步</li>
<!--                    <li>第六步</li>-->


                </ul>
            </div>
        </div>
        <div class="shade"></div>

        <div class="info">

            <div id="x2" class="chioce_s chioce_s1" style="display:block"></div>
            <div  class="width1000" style="display:block">
                <div class="light-div chioce_light1" >
                    <span><a href="javascript:;" class="link next " ><img src="<?php echo Yii::app()->theme->baseUrl; ?>/images/newer/下一步.jpg"></a></span>    
                </div>
            </div>

            <div class="chioce_s chioce_s2" ></div>
            <div  class="width1000">
                <div class="light-div chioce_light2" >
                    <span><a href="javascript:;" class="link  next" ><img src="<?php echo Yii::app()->theme->baseUrl; ?>/images/newer/下一步.jpg"></a></span>    
                </div>
            </div>

            <div class="chioce_s chioce_s3"></div>
            <div  class="width1000">
                <div class="light-div chioce_light3" >
                    <span><a href="javascript:;" class="link next " ><img src="<?php echo Yii::app()->theme->baseUrl; ?>/images/newer/下一步.jpg"></a></span>    
                </div>
            </div>

            <div class="chioce_s chioce_s4"></div>
            <div  class="width1000">
                <div class="light-div chioce_light4" >
                    <span><a href="javascript:;" class="link next" ><img src="<?php echo Yii::app()->theme->baseUrl; ?>/images/newer/下一步.jpg"></a></span>    
                </div>
            </div>

            <div class="chioce_s chioce_s5" ></div>
            <div  class="width1000">
                <div class="light-div chioce_light5" >
                   <span><a href="<?php echo yii::app()->createUrl('servicer/default/newer', array('goto' => 'submit-step1')) ?>" class="link next " ><img src="<?php echo Yii::app()->theme->baseUrl; ?>/images/newer/下一步.jpg"></a></span>
                </div>
            </div>

<!--            <div class="chioce_s chioce_s6"></div>
            <div  class="width1000">
                <div class="light-div chioce_light6" >
                    <span><a href="<?php // echo yii::app()->createUrl('servicer/default/newer', array('goto' => 'submit-step1')) ?>" class="link next " ><img src="<?php echo Yii::app()->theme->baseUrl; ?>/images/newer/下一步.jpg"></a></span>        
                </div>
            </div>-->



        </div>




    </body>
</html>
