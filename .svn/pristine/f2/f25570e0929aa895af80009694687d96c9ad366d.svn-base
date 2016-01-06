<link rel="stylesheet" href="<?php echo F::themeUrl(); ?>/css/zzhgl.css" />

<style>
    .lmsparts li {
        cursor: pointer;
        line-height: 20px;
        margin-top: 5px;
    }
    .added li .ren {
        margin-top: 2px;
    }
    .right1{
        width:70px; height:300px ; background:url(<?php echo Yii::app()->theme->baseUrl ?>/images/jpd/arrow1.jpg) center no-repeat
    }
    .right2{
        width:70px; height:300px ; background:url(<?php echo Yii::app()->theme->baseUrl ?>/images/jpd/arrow2.jpg) center no-repeat
    }
</style>
<div style="padding:10px;position:relative">
    <ul>
        <li>
            <div class="branch">

                <span class="role" id="uro"></span>
                <div style="clear:both"></div>
            </div>
            <ul class="part2"><!--
                <li><img src="<?php echo Yii::app()->theme->baseUrl ?>/images/jpd/ren.png" class="ren"><span class="m_left5">member1</span></li>
                <li><img src="<?php echo Yii::app()->theme->baseUrl ?>/images/jpd/ren.png" class="ren"><span class="m_left5">member1</span></li>



            </ul>
        </li>-->


            </ul>
            <p class="m_left40 m_top20"><button class=" button5 added_qx">添加</button></p>
            <div class="alternative_info " style="top:60px; right:60px; width:450px; display:none" id="lms_window">
                <div class="target_list" >
                    <p class="f_weight target_lm" >选择关联用户<span class="guanbi2 float_r" onclick="$('#lms_window').css('display','none')"><img src="<?php echo Yii::app()->theme->baseUrl ?>/images/jpd/guanbi2.png"></span></p>
                    <div>
                        <div class="float_l width180" >
                            <!--                            <div class="qx_search">
                                                            <input type="text" class=" float_l input4" style="width:145px" ><button class="button6 float_r"></button>
                                                        </div>-->
                            <div class="bor_back m-top" style="height:300px;overflow-y:auto">
                                <?php
                                $this->widget('CTreeView', array(
                                    'persist' => 'cookie',
                                    'animated' => 'fast',
                                    'url' => array('ajaxFillTree'),
                                    'htmlOptions' => array(
                                        'id' => 'coverageTree',
                                        'class' => 'coverageTree',
                                    )
                                ));
                                ?>




                            </div>

                        </div>
                        <div id="ad" class="right1 float_l" ></div>
                        <div class="float_l width180">
                            <p class="m-top5" style="line-height:25px"><b>已选用户</b></p>
                            <div class="bor_back m-top" style="height:300px;overflow-y:auto">
                                <ul class="added" >
<!--                                                        <li><img src="<?php //echo Yii::app()->theme->baseUrl     ?>/images/jpd/ren.png" class="ren"><span class="m_left5">member1</span><span class=" float_r"><img src="<?php //echo Yii::app()->theme->baseUrl     ?>/images/jpd/guanbi4.png" class="guanbi4"></span></li>
                                    <li><img src="<?php //echo Yii::app()->theme->baseUrl     ?>/images/jpd/ren.png" class="ren"><span class="m_left5">member1</span><span class=" float_r"><img src="<?php //echo Yii::app()->theme->baseUrl     ?>/images/jpd/guanbi4.png" class="guanbi4"></span></li>
                                    <li><img src="<?php //echo Yii::app()->theme->baseUrl     ?>/images/jpd/ren.png" class="ren"><span class="m_left5">member1</span><span class=" float_r"><img src="<?php //echo Yii::app()->theme->baseUrl     ?>/images/jpd/guanbi4.png" class="guanbi4"></span></li>-->

                                </ul>


                            </div>



                        </div>

                        <div style="clear:both"></div>
                    </div>
                    <p class=" m_top20" align="right">
                        <input type="submit" class="submit f_weight" value="保 存" onclick="savelmsrole()">
                        <input id="cancel_two" type="button" class=" submit f_weight" value="取消">
                    </p>

                </div>


            </div>

            </div>
            <script>
                var htmlcontents='';
                var employIDfindID;
                var lsnthis;
                if($("#con_one_2").find('#coverageTree')){
                    $("#coverageTree .ren").live('click',function(){
                        var employID=$(this).attr('od');
                        employIDfindID=employID;
                        var employName=$(this).text();
                        var departmentID='';
                        $('#ad').removeClass("right1");
                        $('#ad').addClass("right2");
                        if(employID && employName){
                            var contents=lmsappendhtml(employID,employName,departmentID);
                            htmlcontents=contents;
                            if(lsnthis){
                                $(lsnthis).css('color','');
                            }
                            $(this).css('color','#0065c1');
                            lsnthis=this;
                        }
                    }) 
                };
                $('#ad').live('click',function(){
                        if(!employIDfindID){
                           alert('请选择用户');
                           return false;
                        }
                        if(employIDfindID){
                          var exit=lmsfind(employIDfindID); 
                          if(!exit){
                            $(".added").append(htmlcontents);  
                          }else{
                              alert('该用户已存在');
                          }
                        }
                        $('#ad').removeClass("right2");
                        $('#ad').addClass("right1");
                });
                //点击删除
                function deletelms(obj){
                    $("#lms_role_del"+obj).remove(); 
                }
                //append 的HTML
                function lmsappendhtml(key,name,departmentID){
                    var html='';
                    html+='<li key="'+key+'"  departmentID="'+departmentID+'" id="lms_role_del'+key+'">';
                    html+='<img src="'+'<?php echo F::themeUrl() ?>'+'/images/jpd/ren.png">';
                    html+='<span class="m_left5">'+name+'</span>';
                    html+= '<span class="float_r" onclick="deletelms('+key+')" style="*margin-top:-22px"><img class="guanbi4" src="'+'<?php echo F::themeUrl() ?>'+'/images/guanbi4.png"></span></li>';
                    return html;
                }
                //判断是否存在
                function lmsfind(key){
                    var exit=false;
                    $(".added").find('li').each(function(){
                        if($(this).attr('key')===key){
                            exit=true;
                        }
                    });
                    return exit;
                }
                //保存
                function savelmsrole(){
                    var RoleID=$("#uro").attr('key');
                    var employIDs='';
                    $(".added").find('li').each(function(){
                        var id=$(this).attr('key') ;
                        if(id && id!='undefined'){
                            if(!employIDs){
                                employIDs+=id
                            }else{
                                employIDs+=','+id  
                            }   
                        }
                    })
                    $.ajax({
                        url:'<?php echo Yii::app()->createUrl('member/permission/saveemployrole') ?>',
                        data:{'RoleID':RoleID,'employIDs':employIDs},   
                        type:'post',
                        dataType:'json',
                        success:function(lms){
                            if(lms.success){
                                alert(lms.message)
                                window.location.href='';
                            }else{
                                alert(lms.message)
                            }
                        }
                    })
                }
                $("#cancel_two").click(function(){
                    $(".alternative_info").css("display","none");
                    return false;
                });
            </script>
