<style>
    .ui-dialog-content .submit{display:none}
</style>
<?php
$this->pageTitle = Yii::app()->name . ' - 配件查询';
if (Yii::app()->user->Identity == "dealer") {
    $url = Yii::app()->createUrl("/common/dealjplist");
} else {
    $url = Yii::app()->createUrl("/common/jplist");
}
$this->breadcrumbs = array(
    '汽配数据' => $url,
    '配件查询',
);
?>
<?php if (Yii::app()->user->hasFlash('fail')): ?>  
    <div id="divbox"  class="mbx" style="height:25px;margin-top:10px;color:#fff;padding-left:400px">
        <script language="javascript">
            function codefans() {
                var box = document.getElementById("divbox");
                box.style.display = "none";
            }
            setTimeout("codefans()", 1000);//2秒，可以改动
        </script>
        <?php echo Yii::app()->user->getFlash('fail'); ?> 
    </div>
<?php endif; ?>

<?php if (Yii::app()->user->hasFlash('success')): ?>  
    <div id="divbox"  class="mbx" style="height:25px;margin-top:10px;color:#fff;padding-left:400px">
        <script language="javascript">
            function codefans() {
                var box = document.getElementById("divbox");
                box.style.display = "none";
            }
            setTimeout("codefans()", 2000);//2秒，可以改动
        </script>
        <?php echo Yii::app()->user->getFlash('success'); ?> 
    </div>
<?php endif; ?>
<div class=" bor_back  m-top">
    <div id="tab-container" class="tabs tabs2 " pre='tab'>
        <!-- 	<a class="left-indent">&nbsp;</a>	 -->
        <ul class="pjcx_ul">
            <li id="tab-parts-query" class='float-l' style="margin-left: 40px;border-left:1px solid #e2e2e2">
                <a id="tab-head-group" href="#tab-group" >配件查询</a>
            </li>
            <li class='float-l' style="margin-left:0px;border-left:1px solid #e2e2e2">
                <a id="tab-head-oeno" href="#tab-oeno" >OE号查询</a>
            </li>
            <li class='float-l' style="margin-left:0px; border-left:1px solid #e2e2e2">
                <a id="tab-head-partname" href="#tab-partname" >配件名称查询</a>
            </li>
        </ul>
    </div>	
    <div class='panel-container tab-content auto_height' >
        <div id="tab-group">
            <?php $this->renderPartial("search_group"); ?>
        </div>
        <div id="tab-oeno">
            <?php $this->renderPartial("search_oeno"); ?>
        </div>	
        <div id="tab-partname">	
            <?php $this->renderPartial("search_partname"); ?>
        </div>
    </div></div>

<script type="text/javascript" src='<?php echo F::themeUrl(); ?>/js/jquery.idTabs.min.js'></script>
<script type="text/javascript" src='<?php echo F::themeUrl(); ?>/js/jpdata/parts.js'></script>
<?php
$this->beginWidget('zii.widgets.jui.CJuiDialog', array(
    'id' => 'reminddg', //弹窗ID  
    'options' => array(//传递给JUI插件的参数  
        'title' => '修正配件信息',
        'autoOpen' => false, //是否自动打开  
        'width' => '800px',
        'modal' => true,
        'height' => 'auto', //高度  
        'buttons' => array(
            '创建' => 'js:function(){ savePart("EpcPartTempedit");}', //关闭按钮 
            '关闭' => 'js:function(){ $(this).dialog("close");}', //关闭按钮 
        ),
    ),
));

$this->endWidget('zii.widgets.jui.CJuiDialog');
?>
<script type="text/javascript" src="<?php echo Yii::app()->theme->baseUrl; ?>/js/jpd/jquery.form.js"></script>
<script>
            $("#tab-container ul").idTabs();
            $(function() {
                //没有选择车型不能查看商品详情
                $('.requirecarmodel').live('click', function() {
                    if ($('#search_value').val() == '') {
                        alert('请先选择车型才能查看详情!');
                        return false;
                    }
                })
            })

            //配件信息修正
            function editPart(param, type) {
                var purl = location.href;
                var url = Yii_jpdata_baseUrl + "/epcPartTemp/create";
                if (param) {
                    if (type == '0') { // 新增配件
                        url += "?ep_gp=" + param;
                        partDlgTitle = "新增配件";
                    } else { // 修改配件信息
                        url += "?ep_pt=" + param;
                        partDlgTitle = "配件信息修正";
                    }
                }
                $.ajax({
                    url: url,
                    type: 'POST',
                    data: {'purl': purl},
                    dateType: 'html',
                    success: function(html) {
                        $("#reminddg").html(html);
                        $("#reminddg").dialog("open");
                    }
                })
            }
</script>
<script>
    $(function() {
        $('.ui-dialog-content :submit').hide();
    })

    function savePart(form) {
        console.log(Math.random())
        $('#' + form).form('submit', {
            //url:url,
            onSubmit: function() {
                console.log(Math.random()+'   ssss')
                return true;
            },
            success: function(result) {
                if (result == 'success') {
                    $('#mydialog').dialog('close');
                    $('#mydialogs').dialog('close');
                    $('#mydialogss').dialog('close');
                    $('#reminddg').dialog('close');
                    alert('信息已经成功提交，感谢您的支持！');
                } else {
                    if (form == 'epc-model-temp-form')
                        $('#mydialog').find('.form:first').replaceWith(result);
                    else if (form == 'epc-group-temp-form')
                        $('#mydialogs').find('.form:first').replaceWith(result);
                    else if (form == 'EpcPartTemp')
                    {
                        $('#mydialogss').find('.form:first').replaceWith(result);
                    }
                    else if (form == 'EpcPartTempedit')
                    {
                        $('#reminddg').find('.form:first').replaceWith(result);
                    }
                }
            }
        });
        return true;
    }

    //新增车型
    function newmodel() {
        $('#epc-model-temp-form').find('input[type=text]').val('');
        $('#epc-model-temp-form').find('textarea').val('');
        $('.error').removeClass('error');
        $('.errorMessage').hide();
        $("#mydialog").dialog("open");
    }

    //新增配件组
    function newgroup() {
        $('#epc-group-temp-form').find('input[type=text]').val('');
        $('#epc-group-temp-form').find('textarea').val('');
        $('.error').removeClass('error');
        $('.errorMessage').hide();
        $("#mydialogs").dialog("open")
    }

    //新增配件
    function newparts() {
        $('#EpcPartTemp').find('input[type=text]').val('');
        $('#EpcPartTemp').find('textarea').val('');
        $('.error').removeClass('error');
        $('.errorMessage').hide();
        $("#mydialogss").dialog("open")
    }
</script>