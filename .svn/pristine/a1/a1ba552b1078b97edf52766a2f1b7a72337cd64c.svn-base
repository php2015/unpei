<!--[if IE 9]>
<style type="text/css" />
.select {width: 139px;}
.mm2{width:134px}
</style>
<![endif]-->
<!--[if IE 8]>
<style type="text/css" />

.mm2{width:127px}
</style>
<![endif]-->
<style>
.ui-datepicker-year{
	width:60px!important;
}
.input{width:127px;}
</style>

<?php
if (Yii::app()->user->Identity == "dealer") {
    $url = Yii::app()->createUrl("common/dealmemberlist");
} else {
    $url = Yii::app()->createUrl("common/memberlist");
}
$this->breadcrumbs = array(
    '用户中心' => $url,
    '子账户管理',
);
?>
<script type="text/javascript" src='<?php echo F::themeUrl(); ?>/js/zzhgl.js'></script>
<link rel="stylesheet" href="<?php echo F::themeUrl(); ?>/css/zzhgl.css" />
<div class="bor_back m-top">

    <p class="txxx" style="border-bottom:none">子账户管理<span class="float_r" style="margin-right:10px ;*margin-top:-35px">
            <a id="tjbm" href="javascript:void(0);">
                <span class="xjd2" style="display:inline-block ;font-weight:400; font-size:12px;  ">添加部门</span>
            </a>
            <a id="tjyg" href="javascript:void(0);">
                <span class="xjd2" style="display:inline-block ;font-weight:400; font-size:12px;  ">添加员工</span>
            </a>	
        </span></p> </div>
<div class="hyzx_content2 m_top10">
    <div class="hyzx_content2a float_l">
        <div class="hyzx_lm"><span class="float_l" style="margin-left:20px; font-size:12px; font-weight:bold">部门</span><a id="del" href=""><div class="float_r xzyc">删除</div></a>
        </div>
        <div class="hyzx_lm_info">
            <?php
            $this->widget('CTreeView', array(
                'persist' => 'cookie',
                'animated' => 'fast',
                'url' => array('ajaxFillTree'),
                'htmlOptions' => array(
                    'id' => 'coverageTree',
                    'class' => 'coverageTree'
                )
            ));
            ?>
        </div>
    </div>
    <div class="hyzx_content2b float_r">
        <div class="hyzx_lm2"><span style="margin-left:20px; font-size:12px; font-weight:bold">部门信息</span>
        </div>
        <div class="hyzx_lm2_info">
            <p id="edit" style="text-align:right"><span class="hyzx_editor li_icon"><a id="edit" href="javascript:;" class="revise">修改</a></span></p>
            <div class="bmxx_info">

                <form id="department_form" action="<?php echo Yii::app()->createUrl('/member/employee/editdepart') ?>" method="post" target="_self" class="m-top"> 
                    <p><label class="label1">部门名称：</label>
                        <span id="DepartmentName" class="name" ><?php echo $department[0]['DepartmentName'] ?></span>
                        <input id="editDepartmentName" name="DepartmentName" type="text" class="input editor" value="<?php echo $department[0]['DepartmentName'] ?>">
                        <span class="color_red editor">*</span>
                    </p>

                    <p><label class="label1">上级部门：</label>
                        <span id="ParentID" class="name"></span> 
                        <select id="editParentID" name="ParentID" class="select editor">
                            <option value="0"></option>
                            <?php foreach ($department as $key => $val) { ?>
                                <option value ="<?php echo $val['ID'] ?>"><?php echo $val['DepartmentName'] ?></option>
                            <?php } ?>
                        </select>
                    </p>
                    <p style="word-break:break-all; white-space:normal;"><label class="label1 m_left24" style="vertical-align:top">描述：</label>
                        <span id="Describe" class="name"><?php echo $department[0]['Describe'] ?></span> 
                        <textarea id="editDescribe" name="Describe" class="textarea editor" style="height:50px; width:200px"><?php echo $department[0]['Describe'] ?></textarea>

                    </p>        
                    <input id="departID" type="hidden" name="id" value="<?php echo $department[0]['ID'] ?>">  
                </form>
                <p class="editor_save m_left80" style="display:none;"><input id="savedepart" type="submit" class="submit f_weight" value="保 存"><button class="button3">取消</button></p>
            </div>
            <div class="ygxx_info">
                <form id="empolyees_form" method="post" target="_self" class="m-top">
                    <p><label class="label1" style="margin-left:24px">姓名：</label>
                        <span id="Name" class="name" ></span> 
                        <input id="editName" type="text" class=" input editor" name="Name">
                        <span class="color_red editor">*</span>
                        <label class="label1" style="margin-left:22px">生日：</label> 
                        <span id="Birth" class="name" ></span> 
                        <?php
                        $this->widget('zii.widgets.jui.CJuiDatePicker', array(
                            'language' => 'zh_cn',
                            //'value'=>'aaaa',//date("Y-m-d",$model->BuyTime),//设置默认值
                            'name' => 'editBirth',
                            'options' => array(
                                'dateFormat' => 'yy-mm-dd',
                        		'changeYear' => true,
                        		'yearRange'=>'-70:+0'
                            ),
                            'htmlOptions' => array(
                                'class' => 'input editor',
                            ),
                        ));
                        ?>
                    </p>
                    <p><label class="label1" style="margin-left:12px">用户名：</label>
                        <span id="UserName" class="name" ></span> 
                        <input id="editUserName" type="text" class=" input editor" name="UserName">
                        <span class="color_red editor">*</span>
                        <label class="label1" style="margin-left:22px">密码：</label> 
                        <span id="PassWord" class="name" ></span> 
                        <input id="editPassWord" type="password" class=" input editor mm2" name="PassWord" style="*width:127px;">
                        <span class="color_red editor">*</span>
                    </p>
                    <p><label class="label1">过期日期：</label>
                        <span id="ExpireTime" class="name" ></span> 
                        <?php
                        $this->widget('zii.widgets.jui.CJuiDatePicker', array(
                            'language' => 'zh_cn',
                            //'value'=>'aaaa',//date("Y-m-d",$model->BuyTime),//设置默认值
                            'name' => 'editExpireTime',
                            'options' => array(
                                'minDate' => 'new Date()',
                                'dateFormat' => 'yy-mm-dd',
                        		'changeYear' => true,
                        		'yearRange'=>'-0:+50'
                            ),
                            'htmlOptions' => array(
                                'class' => 'input editor',
                            ),
                        ));
                        ?>
                        <label class="label1 m_left34" >工号：</label>
                        <span id="JobNum" class="name" ></span> 
                        <input id="editJobNum" type="text" class=" input editor" name="JobNum">
                    </p>
                    <p><label class="label1 m_left24">部门：</label>
                        <span id="DepartmentID" class="name" ></span>  
                        <select id="editDepartmentID" name="DepartmentID" class="select editor" style="">
                            <?php foreach ($department as $key => $val) { ?>
                                <option value ="<?php echo $val['ID'] ?>"><?php echo $val['DepartmentName'] ?></option>
                            <?php } ?>
                        </select>
                        <label class="label1 m_left34">性别：</label> 
                        <span id="Sex" class="name" ></span> 
                        <select id="editSex" name="Sex" class="select editor" style=""> 
                            <option value="男" selected="selected">男</option>
                            <option value="女">女</option>
                        </select>
                    </p> <p>
                        <label class="label1 m_left24">职位：</label> 
                        <span id="Job" class="name" ></span> 
                        <input id="editJob" name="Job" type="text" class=" input editor" >
                        <label class="label1 m_left">办公电话：</label>
                        <span id="TelPhone" class="name" ></span> 
                        <input id="editTelPhone" name="TelPhone" type="text" class=" input editor" >
                    </p>
                    <p>
                        <label class="label1 m_left24">手机：</label>
                        <span id="Phone" class="name" ></span> 
                        <input id="editPhone" name="Phone" type="text" class=" input editor" >
                        <label class="label1 m_left">电子邮箱：</label> 
                        <span id="Email" class="name" ></span> 
                        <input id="editEmail" maxlength="30" name="Email" type="text" class=" input editor" >
                        <span class="color_red editor">*</span>
                    </p>       
                    <p style="height:50px;">
                        <label class="label1 m_left24" style="vertical-align:top">备注：</label> 
                        <span id="Remark" class="name" ></span> 
                        <textarea id="editRemark" name="Remark" class="textarea editor" style="height:50px; width:260px"><?php echo $department[0]['Describe'] ?></textarea>
                    </p>
                    <input id="employID" type="hidden" name="id">
                </form>
                <p class="editor_save m_left80" style="display:none;">
                    <input id="saveempoly" type="button" class="submit f_weight" value="保 存">
                    <button class="button3">取消</button>
                </p>
            </div>
        </div>
    </div>
</div>
<script>
    $(document).ready(function(){
        $('#editRemark').keyup(function(){
            var leng=$(this).val().length;
            var zihu=$('#editRemark').val().substr(0,25);
            if(leng>25){
                alert('备注信息不能超过25个字符 ');
                document.getElementById("editRemark").value = zihu;
            }
        }); 
        $('#editDescribe').keyup(function(){
            var leng=$(this).val().length;
            var zihu=$('#editDescribe').val().substr(0,25);
            if(leng>25){
                alert('描述信息不能超过25个字符 ');
                document.getElementById("editDescribe").value = zihu;
            }
        });
        $('#editJob').keyup(function(){
            var leng=$(this).val().length;
            var zihu=$('#editJob').val().substr(0,10);
            if(leng>10){
                alert('职位名称不能超过10个字符 ');
                document.getElementById("editJob").value = zihu;
            }
        });
        $('#editJobNum').keyup(function(){
            var leng=$(this).val().length;
            var zihu=$('#editJobNum').val().substr(0,10);
            if(leng>10){
                alert('工号不能超过10个字符 ');
                document.getElementById("editJobNum").value = zihu;
            }
        });
    });
</script>