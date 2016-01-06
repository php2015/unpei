<link rel="stylesheet" href="<?php echo Yii::app()->theme->baseUrl ?>/css/pap/fwd.css">
<?php
$this->pageTitle = Yii::app()->name . ' - 权限管理';
if (Yii::app()->user->Identity == "dealer") {
    $url = Yii::app()->createUrl("common/dealmemberlist");
} else {
    $url = Yii::app()->createUrl("common/memberlist");
}
$this->breadcrumbs = array(
    '用户中心' => $url,
    '权限管理',
);
?>
<style>
    /*    .within_hd{
           // padding-left:28px
        }*/
</style>
<div class="tab1 bor_back m-top"  id="tab1">
    <div class="menu">
        <ul>
            <li id="one1" key=''onclick="setTab('one', 1)" class="off" style="border-left:1px solid #ebebeb; margin-left:20px">角色管理</li>
            <li id="one2"  key=''onclick="setTab('one', 2)">分配角色给用户</li>
            <li id="one3" key='' onclick="setTab('one', 3)">用户角色管理</li>

        </ul>
    </div>
    <div class="menudiv">
        <div id="con_one_1">
            <div id="1"><div class="hyzx_content2 m_top10">
                    <div class="hyzx_content2a float_l">
                        <!--左边角色列表菜单-->
                        <div class="hyzx_lm" style="border-left:none"><span class="float_l" style="margin-left:20px; font-size:12px; font-weight:bold">角色</span>
                            <div class="float_r xzyc">删除</div>
                        </div>
                        <?php $this->renderPartial('left', array('treeData' => $treeData)); ?>
                    </div>
                    <div class="hyzx_content2b float_r">
                        <div class="hyzx_lm2" style="border-right:none"><span style="margin-left:20px; font-size:12px; font-weight:bold">操作权限</span><span class="float_r" style="margin-right:10px ;*margin-top:-35px">
                                <span class=" xjd2 revise2 add" style="display:inline-block ;font-weight:400; font-size:12px;  ">添加</span>
                                <?php if (isset($treeData) && !empty($treeData)): ?>
                                    <span class=" xjd2 xjd3 revise2 update" style="display:inline-block ;font-weight:400; font-size:12px;  ">修改</span>
                                <?php endif; ?>
                            </span>
                        </div>
                        <div id="fd" class="hyzx_lm2_info" style="border-right:none">
                            <!--角色管理-->
                            <?php $this->renderPartial('contentone', array('treeData' => $treeData, 'menuArr' => $menuArr, 'firstmenu' => $firstmenu)); ?>

                        </div>


                    </div>
                    <div style="clear:both"></div>

                </div>

            </div>


        </div>



        <div id="con_one_2" style="display:none;">
            <div id="1">   <div class="hyzx_content2 m_top10">
                    <div class="hyzx_content2a float_l">
                        <div class="hyzx_lm" style="border-left:none"><span class="float_l" style="margin-left:20px; font-size:12px; font-weight:bold">角色</span><div class="float_r xzyc">删除</div>
                        </div>

                        <?php $this->renderPartial('leftone', array('treeData' => $treeData)); ?>

                    </div>
                    <div class="hyzx_content2b float_r">
                        <div class="hyzx_lm2" style="border-right:none"><span style="margin-left:20px; font-size:12px; font-weight:bold">角色关联的用户</span>
                        </div>
                        <div class="hyzx_lm2_info" style="border-right:none">
                            <!--分配角色给用户-->
                            <?php $this->renderPartial('contenttwo', array('depart' => $depart)); ?>
                        </div>


                    </div>

                </div>
            </div>
            <div style="clear:both"></div>
        </div>
        <div id="con_one_3" style="display:none;">
            <div class="hyzx_content2 m_top10">
                <div class="hyzx_content2a float_l">
                    <div class="hyzx_lm"><span class="float_l" style="margin-left:20px; font-size:12px; font-weight:bold">部门</span>
                    </div>
                    <?php $this->renderPartial('lefttwo', array('depart' => $depart)); ?>
                </div>
                <div class="hyzx_content2b float_r">
                    <div class="hyzx_lm2" style="border-right:none">
                        <span style="margin-left:20px; font-size:12px; font-weight:bold">角色信息</span>
                        <span class="float_r" style="margin-right:10px ;*margin-top:-35px">
                            <?php //if(isset($depart)&&!empty($depart)):?>
                            <span class=" xjd2 xjd3 revise2" style="display:none ;font-weight:400; font-size:12px;  ">修改</span></span>
                        <?php //endif;?>
                    </div>
                    <div class="hyzx_lm2_info" id="rote_id" style="border-right:none">
                        <!--用户角色管理-->
                        <?php $this->renderPartial('contentthree', array('depart' => $depart)); ?>
                    </div>
                </div>
                <div style="clear:both"></div>

            </div>
        </div></div> 


    <div style="clear:both"></div>
    <!--content1即又半部分结束-->
</div>
<script type="text/javascript" src="<?php echo Yii::app()->theme->baseUrl ?>/js/jpd/member.js" ></script>
<script>
    
    $(".revise2").live('click',function(){
        $('.within_info').show();
        $('#ped').hide();
        $(".name").css("display","none");
        $(".editor").css("display","inline-block");
        $(".checkbox2").css("display","inline-block");
        $("  #con_one_1 .editor_save").css("display","block");
    });
    $('#con_one_3 .revise2').live('click',function(){
        $('.within_info').show();
        $('#ped').hide();
        $(".name").css("display","none");
        $(".editor").css("display","inline-block");
        $(".checkbox2").css("display","inline-block");
        $("  #con_one_3 .editor_save").css("display","block");
    })
    function setTab(name, cursel) {
        cursel_0 = cursel;
        var links_len = $("#tab1 li").length;
        for (var i = 1; i <= links_len; i++) {
            var menu = $("#"+name+i);
            var menudiv = $("#con_" + name + "_" + i);
            if (i == cursel) {
                menu.addClass("off"); 
                menudiv.css({'display':'block'});
                menu.attr('key',i);
            }
            else {
                menu.removeClass("off"); 
                menudiv.css({'display':'none'});
            }
        }
    }
  
    $('.hyzx_lm_info').find(' .part_current').live('click',function(){
        if($('.editor_save').css('display')=='block'){
            return false;
        }
        var roleid=$(this).attr('key');
        $('.update').attr('key',roleid);
        var url=Yii_baseUrl+'/member/permission/roleinfo';
  
        $.getJSON(url,{roleid:roleid},function(data){
            if(data){
                var html='';
                $('input[name=rolename]').prev('span').html("<a title='"+ data.per.RoleName +"'>" + data.per.RoleName + "</a>");
                $('input[name=des]').prev('span').html("<a title='"+ data.per.Describe +"'>" + data.per.Describe + "</a>");
                if(data.res!=undefined)
                    $.each(data.res,function(k,v){
                        if(v.name=='工作台'){
                            v.name='';
                        }
                    html+=' <li class="within_lm">'
                    html+='<div class="float_l width100 within_hd"><span>'
                    html+='<input type="checkbox" class="checkbox2 first-child" id="'+v.iD+'"value="'+v.iD+'"><b>'+v.name+'</b></span></div>'
                    html+='<div class="float_l within_bd">'
                    html+='<ul>'
                    if(v.children!=undefined){
                        $.each(v.children,function(ke,ve){
                            html+=' <li><input type="checkbox" class="checkbox2 children-'+v.iD+'" pid="'+v.iD+'" value="'+ve.iD+'">'+ve.name+'</li>'
                        });
                    }
                    html+='</ul>'
                    html+='</div>'
                    html+='<div style="clear:both"></div>'
                    html+='</li>'
                  
                });
                //  $('.within_info').html(html);
                $('#ped').html(html);
                $('.within_info').hide();
            }
        });

   
    });

    $('.hyzx_lm_info1').find(' .part_current').live('click',function(){
        if($('.editor_save').css('display')=='block'){
            return false;
        }
        var roleid=$(this).attr('key');
        $('.update').attr('key',roleid);
        var userurl=Yii_baseUrl+'/member/permission/roleuserinfo';
        $.getJSON(userurl,{roleid:roleid},function(data){
            $(".added li").remove()//分配角色给用户
            if(data){
                $('#uro').text(data.rolename);
                $('#uro').attr('key',roleid);
                var html='';
                $.each(data,function(k,v){
                    if( v!=null && v.empinfo!=undefined){
                        //start分配角色给用户
                        var addID=v.empinfo.ID;
                        var addName=v.empinfo.Name;
                        var addDepartmentID=v.empinfo.DepartmentID;
                        var contents=lmsappendhtml(addID,addName,addDepartmentID);
                        var exit=lmsfind(addID)
                        if(!exit){
                            $(".added").append(contents)   
                        }
                        //end分配角色给用户
                        html+=' <li key="'+v.empinfo.ID+'"><img src="<?php echo Yii::app()->theme->baseUrl ?>/images/jpd/ren.png"><span class="m_left5">'+v.empinfo.Name+'</span></li>'
                        //                        html+=' <li key="'+v.empinfo.ID+'"><span class="m_left5">'+v.empinfo.Name+'</span></li>'
                    }else{
                        html+=''
                    }
                })
                $('.part2').html(html);
            
            }
        })
    });

    //$('.hyzx_lm_info2').find('ul#roleTree li').live('click',function(){
    //    alert($(this).attr('id'));
    //});

    $('.hyzx_lm_info2').find('.part_current').live('click',function(){

        if($('#con_one_3  .editor_save').css('display')=='block'){
            return false;
        }
        var type=$(this).attr('key');
        if(type==1){
            var empid=$(this).attr('od');
  
            var url=Yii_baseUrl+'/member/permission/userinfo';
            $.getJSON(url,{empid:empid},function(data){
                if(data){
                    var html='';
                    var top =0;
                    var tops =10;
                    var left =50;
                    $.each(data,function(k,v){
                        if(k%5){
                            left +=130;
                        }else{
                            top +=30;
                            tops +=30;
                            left =50;
                        }
                        if(v.per==undefined){
                            $('#con_one_3').find('.revise2').css('display','none');
                        }else{
                            $('#con_one_3').find('.revise2').css('display','block');
                        }
                        if(v!=null && v.role!=undefined ){
                            $('#memname').text(v.empname);
                            $('#memname').attr('key',v.empID);
                            if(v.root==undefined){
                                v.root='';
                            }
                            html+=' <li class="part4 part5" key='+v.ID+' style="height:30px"><input type="checkbox" value="'+v.role.ID+'" class="checkbox2"><img src="<?php echo Yii::app()->theme->baseUrl ?>/images/jpd/icon2.png" class="ren"><span class="m_left5" id="re">'+v.role.RoleName+'</span>'
                            html+='<div style="clear:both"></div> ';
                            html+='  </li>';
                            html+=' <div id=li'+v.ID+' class="within m-top roname" style="left:0px;margin-top:'+top+'px; *margin-top:'+tops+'px;z-index:100;">'
                            html+='<img src="<?php echo Yii::app()->theme->baseUrl ?>/images/jpd/sanjiao2.png" style=" position:absolute; top:-11px; left:'+left+'px"> <p class="m_left30 m_top20"><b>'+v.root+'</b></p>'
                            html+='<ul class="within_info">'
                  
                            html+='<li class="within_lm">'
                            if(v.per!= undefined){
                                $.each(v.per,function(ke,ve){
                                    if(ve.name==undefined){
                                        ve.name='';
                                    }
                                    if(ve.name=='工作台'){
                                        ve.name='';
                                    }
                                    html+='              <div class="float_l width100 within_hd"><span><b>'+ve.name+'</b></span></div>'
                                    html+='                 <div class="float_l within_bd"><ul>'
                                    if(ve.children!=undefined){
                                        $.each(ve.children,function(ks,vs){
                                            html+='    <li>'+vs.name+'</li>'
                                        });
                                    }
                                    html+='     </ul></div>'
                                    html+='                <div style="clear:both"></div>'
                                })}
                            html+=' </li>'
                            html+=' </div>'
                          
                        }else{
                            $('#memname').text(data.empname);
                        }
                    })
                    $('.rolst').html(html);
                }
            });
        }
    });
    $('.part li:first-child').addClass('part_current');
    $('.part li:first-child').trigger('click');



    $('.rolst').find('li').live('mouseover',function(){
        var id = $(this).attr('key');
        $("#rote_id .within").css("display","none");
        $("#li"+id).css("display","block");
        //        $("#li"+id).siblings().css("display","none");
    })
    //用户角色修改
    $('#con_one_3 .revise2').live('click',function(){
        $('.rolst').find('input[type=checkbox]').attr('checked',true);
    })
    $('#use-sub').click(function(){
        var crowd=[];
        $('.rolst').find('input[type=checkbox]:checked').each(function(){
            if($(this).val()!=''){
                crowd.push($(this).val());
            }
        });
        $('#con_one_3').find('input[name=use-role]').val(crowd);
        var roleid=$('#con_one_3').find('input[name=use-role]').val();
        var memid= $('#memname').attr('key');
        var url =Yii_baseUrl+'/member/permission/updateuserole';
        $.getJSON(url,{roleid:roleid,memid:memid},function(data){
            if(data==1){
                location.reload();
            }else {
                location.reload();
            }
        })
    })

    $('#one3').click(function(){
        $('.hyzx_lm_info2 ').find('ul li:first-child .member2 li:first-child').addClass('part_current');
        //$('.hyzx_lm_info2').find('ul li:first-child .part_current').trigger('click');
    });
    //删除角色
    $(' .xzyc').live('click',function(){
        var roleid=$('.hyzx_lm_info').find(' .part_current').attr('key');
        if(roleid==undefined){
            alert('请添加角色');
            return false;
        }
        var bool=confirm('您确定要删除当前角色?');
        if(bool==false){
            return false;
        }
        var url=Yii_baseUrl+'/member/permission/deleterole';
        $.getJSON(url,{roleid:roleid},function(data){
            if(data==1){
                alert('删除成功');
                location.reload();
            }
        });
    })


</script>