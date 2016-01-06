<style>
    .per_part{ position:relative; margin-left:30px; height:25px; width:100px}
</style>
<div style="padding:10px">
    <?php
    if (isset($treeData) && !empty($treeData)) {
        echo "<input type='hidden' name='treedata' value='1'>";
    } else {
        echo "<input type='hidden' name='treedata' value='0'>";
    }
    ?>
    <form name="form" method="post" action="<?php echo Yii::app()->createUrl('member/permission/addroles'); ?>">
        <p style="height:40px;border-bottom:1px solid #c4d1e1; line-height:40px">
            <span class="m_left20" style="display:inline-block; float: left; line-height:40px; font-weight: bold">角色名：</span>
            <span class="name  float_l" style="overflow:hidden; height:40px; white-space: nowrap; text-overflow: ellipsis">无</span>
            <input type="text" class="input editor float_l" name="rolename" style="margin-top:5px">
            <span class="errorMessage" style="color:red"></span>
            <span class="m_left " style="display:inline-block; float: left;line-height: 40px; font-weight: bold">描述：</span>
            <span class="name float_l" style="overflow:hidden;height:40px; white-space: nowrap; text-overflow: ellipsis">无</span>
            <input type="text" class="input editor float_l" name="des" style="margin-top:5px"></p>    
        <p class="m-top"><b class=" color_blue f_weight m_left20" >权限操作</b></p>
        <ul> <li class="m-top per_part">
                <input type="radio" value="<?php echo $firstmenu['ID'] ?>" style="vertical-align:middle" checked="checked">&nbsp;<?php echo $firstmenu['Name'] ?>

                <div class="within m-top" style="display:block; *margin-top:30px">
                    <img src="<?php echo Yii::app()->theme->baseUrl ?>/images/jpd/sanjiao2.png" style=" position:absolute; top:-11px; left:32px">       
<!--                    <p class="m_left30 m_top20">
                        <input type="checkbox" class="checkbox2" id="checkall" value="<?php //echo $firstmenu['ID'] ?>">
                        <b><?php //echo "所有".$firstmenu['Name'] ?></b></p>-->
                    <ul class="within_info">
                            <?php foreach ($menuArr as $key => $menu): ?>
                            <li class="within_lm">
    <?php if ($menu['name'] != '工作台'): ?>
                                    <div class="float_l width100 within_hd"><span>
                                            <input type="checkbox" class="checkbox2 first-child" id='fc<?php echo $menu['iD'] ?>' value="<?php echo $menu['iD'] ?>"><b><?php echo $menu['name'] ?></b></span></div>
    <?php endif; ?>
                                <div class="float_l within_bd">
                                    <ul class="list-per">
                                        <?php if (is_array($menu['children'])):
                                            foreach ($menu['children'] as $child):
                                                ?>
                                                <li class="chd<?php echo $menu['iD'] ?>">
                                                    <input type="checkbox" class="checkbox2 children-<?php echo $menu['iD'] ?>" pid='<?php echo $menu['iD'] ?>'value="<?php echo $child['iD'] ?>"><?php echo $child['name'] ?></li>
        <?php endforeach;
    endif; ?>
                                    </ul>
                                </div>
                                <div style="clear:both"></div>
                            </li>
<?php endforeach; ?>
                    </ul>
                    <ul id="ped">

                    </ul>
                </div></li>
        </ul>
        <input type="hidden" name="per" value="">
        <input type="hidden" name="edit" value="">
        <p class=" editor_save" align="center" style=" margin-top:375px"><input type="submit" id="submit" class="submit f_weight" value="保存">
            <input type="button" class="button3" value="取消"></p>
    </form>
</div>
<script>
    $(document).ready(function(){
      
        var treedata= $('input[name=treedata]').val();
        if(treedata==0){
            $(".name").css("display","none");
            $(".editor").css("display","inline-block");
            $(".checkbox2").css("display","inline-block");
            $(".editor_save").css("display","block");
	
        };
        $('.add').click(function(){
            $('.within_info').show();
            $('#ped').hide();
        });
        //修改
        $('#con_one_1 .update').live('click',function(){

            var roleid=$(this).attr('key');
            $('input[name=edit]').val(roleid);
            var url=Yii_baseUrl+'/member/permission/getroleid';
            $.getJSON(url,{roleid:roleid},function(data){
                if(data){
                    $('input[name=rolename]').val(data.RoleName);
                    $('input[name=des]').val(data.Describe);
                    var arr=data.Jurisdiction.split(',');
                    $(' #fd .within_info').find("input[type=checkbox]").each(function(){
                        if($.inArray($(this).val(), arr)>0){
      
                            $(this).attr('checked',true);
                            $('.within_info ul  li').find('input[type=checkbox]:checked').each(function(){
                                var pid=$(this).attr('pid');
                                $('#fc'+pid).attr('checked',true);
                            });
                        }
                    });
                }
            });
        })
 


        //全选
        $('#checkall').click(function(){
            if($(this).attr('checked')==undefined){
                $('input[type=checkbox]').attr('checked',false);
            }else{
                $('input[type=checkbox]').attr('checked',true);
            }
        });
   
        //主菜单选中/取消操作
        $('.first-child').click(function(){
            var target=$(this).val();
            if($(this).attr('checked')==undefined){
                $('.children-'+target).attr('checked',false);
            }else{
                $('.children-'+target).attr('checked',true);
            }
        })
   
        //子菜单选中/取消操作
        
        $('.within_info ul  li').find('input[type=checkbox]').click(function(){
            var pid=$(this).attr('pid');
//            var select=0;
//            var arr=new Array();
            var i=0;
            $('.children-'+pid).each(function(){
               if( $(this).attr('checked')=='checked'){
                   i++
               }
            })
            if(i>0){
                $('#fc'+pid).attr('checked',true);
            }else{
                $('#fc'+pid).attr('checked',false);
            }
        })
  
        //提交表单
        $('#submit').click(function(){
            var rolename=$('input[name=rolename]').val();
            if(rolename==''){
                $('.errorMessage').text('角色名不能为空');
                return false;
            }
            var crowd=[];//声明存取复选框值的数组
            $('.within_info').find("input:checkbox:checked").each(function(){
                if(this.value!='')
                {
                    crowd.push(this.value);
                }
            });
            $('#fd').find("input[name=per]").val(crowd);
            $('.submit').submit();
    
        })
      
        $('.input[name=rolename]').blur(function(){
            if($(this).val()==''){
                $('.errorMessage').text('角色名不能为空');
                return false;
            }else{
                $('.errorMessage').text('');
            }
        });
        //
        $('.button3').click(function(){
            location.href=Yii_baseUrl+'/member/permission/index';
        });
   
    })
  
</script>