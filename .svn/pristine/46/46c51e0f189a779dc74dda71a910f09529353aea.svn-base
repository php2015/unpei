<?php
$this->pageTitle = Yii::app()->name . ' - 加入联盟';
?>
<style>
    .redremind{border:1px solid red !important;}
    .fail{color:red;display:none}
</style>

<div class="contents">
    <div class="banner">
        <div class="banner_info">
            <img src="<?php echo Yii::app()->theme->baseUrl; ?>/images/login/join.jpg">
        </div>
    </div>

    <div class="content_info m-top10">
        <div class="" style="margin: 10px 30px 20px;">
            <p><span class="title">加入联盟流程</span></p>
            <div class="sub"><img src="<?php echo Yii::app()->theme->baseUrl; ?>/images/login/liuc.jpg"></div>
            <p><span class="title">加入联盟方式</span></p>
            <div class="">
                <div class="float_l num1"></div>
                <div class="float_l subway">
                    <p class="line"><b>拨打电话申请加入</b></p>
                    <p>联系方式：</p>
                    <p class="line">崔总<span class=" m-left20">座机：0531-80676130</span><span class=" m-left20">手机：13969176130</span></p>
                    <p class="">由你配客服<span class=" m-left20">电话：027-87633218</span></p>
                </div>
                <div class="clear"></div>
            </div>

            <div class="m-top20">
                <div class="float_l num2"></div>
                <div class="float_l subway">
                    <p class="line"><b>在线填写资料申请加入</b><span style="color:red">(*号必填)</span></p>
                </div>
                <div class="clear"></div>
            </div>

            <div id="tab">
                <ul class="tab_menu">
                    <li class="selected">经销商填写</li>
                    <li>修理厂填写</li>
                </ul>
                <div class="tab_box">
                    <div>
                        <form id="dealerfm" method="post">
                            <input type="hidden" name="type" value="1">
                            <p><span class="m_left36">经销商机构名称：</span><input class="input required" name="OrganName" maxlength="50"/><span style="color:red">(*)</span></p>
                            <p><span class="m_left48">经营配件品牌：</span><input class="input required" name="Brand"/><span style="color:red">(*)</span>
                                <span style="margin-left:36px;margin-right:-7px;">店铺人数：</span>
                                <select class="select width100"  name="StaffNum">
                                    <option selected="selected" value="1-5">1-5</option>
                                    <option value="6-10">6-10</option>
                                    <option value="11-15">11-15</option>
                                    <option value="16-20">16-20</option>
                                </select>&nbsp;人</p>
                            <p><span>经营配件所覆盖的车系：</span><input class="input"  name="CarModel" maxlength="50"/>
                                <span style="margin-left:54px;margin-right:-7px">年销售额：</span>
                                <select class="select width100" name="SaleMoney">
                                    <option value="10万">10万</option>
                                    <option value="50万">50万</option>
                                    <option value="100万">100万</option>
                                    <a href="join.php"></a>
                                    <option value="200万">200万</option>
                                    <option value="500万">500万</option>
                                    <option selected="selected" value="1000万">1000万</option>
                                    <option value="3000万">3000万</option>
                                    <option value="5000万">5000万</option>
                                    <option value="8000万">8000万</option>
                                    <option value="10000万以上">10000万以上</option>
                                </select></p>
                            <p><span class="m_left60">申请人姓名：</span><input class="input required" name="Name"/><span style="color:red">(*)</span>
                                <span class="m_left60">座机：</span><input class="input width100" name="TelPhone" check="tel"/><span class="fail" >座机号码格式不正确!</span></p>
                            <p><span class="m_left96">手机：</span><input class="input required" name="Phone" check="phone"/><span style="color:red">(*)</span><span class="fail" >手机号格式不正确!</span></p>
                            <p><span class="m_left72">联系邮箱：</span><input class="input required" name="Email" check="email"/><span style="color:red">(*)</span><span class="fail" >邮箱格式不正确!</span></p>
                            <p><span class="m_left108">qq：</span><input class="input required" name="QQ" check="qq"/><span style="color:red">(*)</span><span class="fail" >QQ号格式不正确!</span></p>
                            <p><span class="m_left96">地址：</span>
                                <?php
                                $pdata = Area::model()->findAll("Grade=:grade", array(":grade" => 1));
                                $state = CHtml::listData($pdata, "ID", "Name");
                                echo CHtml::dropDownList('Province', '', $state, array(
                                    'class' => 'select width120 m-left5 required',
                                    'empty' => '请选择省份',
                                    'ajax' => array(
                                        'type' => 'GET', //request type
                                        'url' => Yii::app()->request->baseUrl . '/member/introduce/city', //url to call
                                        'data' => 'js:"province="+jQuery(this).val()',
                                        'success' => 'function(data){
                                         $("#City").html(data);
                                         $("#City").change();
                                     }'
                                        )));

                                echo CHtml::dropDownList('City', '', array(), array(
                                    'class' => 'select width120 m-left5',
                                    'empty' => '请选择城市',
                                    'ajax' => array(
                                        'type' => 'GET', //request type
                                        'url' => Yii::app()->request->baseUrl . '/member/introduce/area', //url to call
                                        'data' => 'js:"city="+jQuery(this).val()',
                                        'success' => 'function(data){
                                         $("#Area").empty();
                                         $("#Area").html(data);
                                     }'
                                        )));

                                echo CHtml::dropDownList('Area', '', array(), array(
                                    'class' => 'select width120 m-left5',
                                    'empty' => '请选择地区',
                                        )
                                );
                                ?>  
                                <input class="input width150 m-left5" name="Address" maxlength="50"/><span style="color:red">(*)</span>
                            </p>
                        </form>
                        <p align="center"><button class="button2" role="1" style="cursor:pointer">提交</button></p>
                    </div>

                    <div class="hide">
                        <div>
                            <form id="servicefm" method="post">
                                <input type="hidden" name="type" value="2"> 
                                <p><span class="">修理厂名称：</span><input class="input required" name="OrganName" maxlength="50"/><span style="color:red">(*)</span></p>
                                <p><span class="m_left12" style="margin-right:-7px;">技师人数：</span>
                                    <select class="select"  name="TechnicianNum" style="width:220px;">
                                        <option selected="selected" value="1-5">1-5</option>
                                        <option value="6-10">6-10</option>
                                        <option value="11-15">11-15</option>
                                        <option value="16-20">16-20</option>
                                    </select>&nbsp;人
                                    <span style="margin-left:54px;margin-right:-7px;">店铺人数：</span>
                                    <select class="select width100"  name="StaffNum">
                                        <option selected="selected" value="1-5">1-5</option>
                                        <option value="6-10">6-10</option>
                                        <option value="11-15">11-15</option>
                                        <option value="16-20">16-20</option>
                                    </select>&nbsp;人</p>
                                <p><span class="">申请人姓名：</span><input class="input required" name="Name" maxlength="50"/><span style="color:red">(*)</span>
                                    <span style="margin-left:67px;margin-right:-7px;">工位数：</span>
                                    <select class="select width100"  name="PositionNum">
                                        <option selected="selected" value="1-5">1-5</option>
                                        <option value="6-10">6-10</option>
                                        <option value="11-15">11-15</option>
                                        <option value="16-20">16-20</option>
                                    </select>
                                </p>
                                <p><span class="m_left36">手机：</span><input class="input required" name="Phone" check="phone"/><span style="color:red">(*)</span><span class="fail" >手机号格式不正确!</span></p>
                                <p><span class="m_left36">座机：</span><input class="input" name="TelPhone" check="tel"/><span class="fail" >座机号码格式不正确!</span></p>
                                <p><span class="m_left12">联系邮箱：</span><input class="input required" name="Email" check="email"/><span style="color:red">(*)</span><span class="fail" >邮箱格式不正确!</span></p>
                                <p><span class="m_left48">qq：</span><input class="input required" name="QQ" check="qq"/><span style="color:red">(*)</span><span class="fail" >QQ号格式不正确!</span></p>
                                <p><span class="m_left36">地址：</span>
                                    <?php
                                    echo CHtml::dropDownList('Province_s', '', $state, array(
                                        'class' => 'select width120 m-left5 required',
                                        'empty' => '请选择省份',
                                        'ajax' => array(
                                            'type' => 'GET', //request type
                                            'url' => Yii::app()->request->baseUrl . '/member/introduce/city', //url to call
                                            'data' => 'js:"province="+jQuery(this).val()',
                                            'success' => 'function(data){
                                         $("#City_s").html(data);
                                         $("#City_s").change();
                                     }'
                                            )));

                                    echo CHtml::dropDownList('City_s', '', array(), array(
                                        'class' => 'select width120 m-left5',
                                        'empty' => '请选择城市',
                                        'ajax' => array(
                                            'type' => 'GET', //request type
                                            'url' => Yii::app()->request->baseUrl . '/member/introduce/area', //url to call
                                            'data' => 'js:"city="+jQuery(this).val()',
                                            'success' => 'function(data){
                                         $("#Area_s").empty();
                                         $("#Area_s").html(data);
                                     }'
                                            )));

                                    echo CHtml::dropDownList('Area_s', '', array(), array(
                                        'class' => 'select width120 m-left5',
                                        'empty' => '请选择地区',
                                            )
                                    );
                                    ?>  
                                    <input class="input width150 m-left5" name="Address" maxlength="50"/><span style="color:red">(*)</span>
                                </p>
                            </form>
                            <p align="center" style="margin-top:51px"><button class="button2" role="2" style="cursor:pointer">提交</button></p>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script type="text/javascript" src="<?php echo Yii::app()->theme->baseUrl; ?>/js/jpd/jquery.form.js"></script>
<script type="text/javascript">
    var Yii_baseUrl = "<?php echo F::baseUrl(); ?>";
    $(document).ready(function(){
        var $tab_li = $('#tab ul li');
        $tab_li.click(function(){
            $(this).addClass('selected').siblings().removeClass('selected');
            var index = $tab_li.index(this);
            $('div.tab_box > div').eq(index).show().siblings().hide();
        });	
    });
    
    $(function(){
        $('.button2').click(function(){
            var type=$(this).attr('role');
            if(type==1){
                var fm=$('#dealerfm');
            }else{
                var fm=$('#servicefm');
            }
            var url=Yii_baseUrl+'/member/introduce/addapply';
            var submit=1;
            //验证是否输入
            fm.find('.required').each(function(){
                if($(this).val()==''){
                    $(this).addClass('redremind');
                    submit=0;
                }
            })
            //验证格式是否正确
            fm.find('input[check]').each(function(){
                if($(this).val()!=''){
                    var value=$(this).val().replace(/^\s+|\s+$/g,"");
                    var type=$(this).attr('check')
                    if(value!=''){
                        if(type=='phone')
                            var reg = /^(((1[1-9]{1}[0-9]{1})|159|153)+\d{8})$/;
                        else if(type=='email')
                            var reg=/^([a-zA-Z0-9]+[_|_|.]?)*[a-zA-Z0-9]+@([a-zA-Z0-9]+[_|_|.]?)*[a-zA-Z0-9]+\.(?:com|cn)$/;
                        else if(type=='tel')
                            var reg=/^0\d{2,3}-?\d{7,8}$/;
                        else if(type=='qq')
                            var reg=/^[1-9]\d{4,10}$/;
                        if(!reg.test(value))
                        {
                            submit=0;
                            $(this).nextAll('.fail').show();
                        }else{
                            $(this).nextAll('.fail').hide();
                        }
                    } 
                }
            })
            if(submit==0){
                return false;
            }
            $('.button2').attr('disabled',true);
            fm.form('submit',{
                url: url,
                success: function(result){
                    result=eval("("+result+")");  
                    if(result.res==1){
                        location.href=Yii_baseUrl+'/member/introduce/success';
                    }else{
                        $('.button2').removeAttr('disabled');
                        alert('提交失败');
                    }
                }
            });
        })
    })
</script>

<script>
    $(function(){
        //必填项提示
        $('.required').blur(function(){
            if($(this).val()==''){
                $(this).addClass('redremind');
            }else{
                $(this).removeClass('redremind');
            }    
        })
    
        //手机号验证
        $('input[check]').blur(function(){
            var value=$(this).val().replace(/^\s+|\s+$/g,"");
            var type=$(this).attr('check')
            if(value!=''){
                if(type=='phone')
                    var reg = /^(((1[1-9]{1}[0-9]{1})|159|153)+\d{8})$/;
                else if(type=='email')
                    var reg=/^([a-zA-Z0-9]+[_|_|.]?)*[a-zA-Z0-9]+@([a-zA-Z0-9]+[_|_|.]?)*[a-zA-Z0-9]+\.(?:com|cn)$/;
                else if(type=='tel')
                    var reg=/^0\d{2,3}-?\d{7,8}$/;
                else if(type=='qq')
                    var reg=/^[1-9]\d{4,10}$/;
                if(!reg.test(value))
                {
                    $(this).nextAll('.fail').show();
                }else{
                    $(this).nextAll('.fail').hide();
                }
            }
        })
    })
</script>
