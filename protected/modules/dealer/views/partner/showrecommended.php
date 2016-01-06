
<style>
    .title_lm li a {
        color: #0164C1;
        float: left;
        font-size: 14px;
        text-align: center;
    }
</style>
<?php
$controlerId = Yii::app()->getController()->id;
$actionId = $this->getAction()->getId();
$active = "class = 'active'";
$this->breadcrumbs = array(
    '营销管理' => Yii::app()->createUrl('common/marketlist'),
    '联盟营销' => Yii::app()->createUrl('dealer/partner/showrecomincome'),
    '推荐记录'
);
?>
<div class="bor_back m-top">
    <div class="txxx txxx2">
        <ul class="title_lm">
            <li ><a href="<?php echo Yii::app()->createUrl('dealer/partner/showrecomincome') ?>">营销收益 </a><span class="zwq_color"></span><span class="interval">  |</span></li>
            <li class="current"><a href="<?php echo Yii::app()->createUrl('dealer/partner/showrecommended') ?>">推荐记录 </a><span class="interval">  |</span></li>
        </ul>
    </div>

    <div id="tb" style="padding:5px 20px;height:auto">
        <div style='margin:10px 0px;'>
            <b>我的推荐会员：</b>
            截止到目前 <?php echo date('Y-m-d', time()) ?>，总推荐数量 <span style="color:#fb540e"><?php echo $count ?></span> 个
        </div>
        <div class="m-top">
            <form action="<?php echo Yii::app()->createUrl("/dealer/partner/showrecommended"); ?>" method="post">
                <p class='form-row'>
                    <span class='label-inline-wa label'>机构名称：</span>
                    <input class='width114 input' name="CompanyName" value="<?php echo $_POST['CompanyName'] ? $_POST['CompanyName'] : '' ?>">
                    <span class='label label-inline m_left34'>手机：</span>
                    <input class='width98 input' name="MobPhone" value="<?php echo $_POST['MobPhone'] ? $_POST['MobPhone'] : '' ?>">
                    <span class='label label-inline m_left24'>&nbsp;&nbsp;邮箱：</span>
                    <input class='width98 input' name="Email" value="<?php echo $_POST['Email'] ? $_POST['Email'] : '' ?>">
    <!--                <span class='label'>&nbsp;机构类型：</span>
                    <select class='width88 select' id="CompanyType" name="CompanyType">
                        <option value='0'>显示全部</option>
                        <option value=1>生产商</option>
                        <option value=2>经销商</option>
                        <option value=3>修理厂</option>
                    </select>-->
                </p><p class='form-row m-top5'>
                    <span class='label label-inline-wa'>按月显示：</span>
                    <select class='width90 select' id="Month" name='Month'>
                        <option value='0' >显示全部</option>
                        <option value='1' <?php if ($_POST['Month'] == 1) echo "selected=selected" ?> >最近一个月</option>
                        <option value='3' <?php if ($_POST['Month'] == 3) echo "selected=selected" ?>>最近三个月</option>
                        <option value='6' <?php if ($_POST['Month'] == 6) echo "selected=selected" ?>>最近六个月</option>
                        <option value='12'<?php if ($_POST['Month'] == 12) echo "selected=selected" ?>>一年</option>

                    </select>
                    <!--<span class='label label-inline'>&nbsp;&nbsp;推荐方式：</span>
                    <select class='width93 select' id='RecomMethod' name="RecomMethod">
                        <option value="0">显示全部</option>
                        <option value="提供推荐名录">提供推荐名录</option>
                        <option value="发送推荐连接">发送推荐连接</option>
                        <option value="代注册推荐">代注册推荐</option>
                    </select>
                    <span class='label label-inline-wa m_left'>会员状态：</span>
                    <select class='width88 select' id="MemberStatus" name="MemberStatus">
                        <option value=''>显示全部</option>
                        <option value='1'>正式会员</option>
                        <option value='2'>试用会员</option>
                        <option value='3'>未激活</option>
                        <option value='4'>未注册</option>
                    </select>
    
                    --><span class='label'></span>
                    <input class='submit ml10 m_left' type='submit' id="search-btn" value='查询'>
                </p>
            </form>
        </div>
    </div>
    <div class="bor_back m_top10">
        <?php
        $this->widget('widgets.default.WGridView', array(
            'dataProvider' => $dataProvider,
            'columns' => array(
                array(
                    'name' => '机构类别',
                    'value' => 'CHtml::encode($data->CompanyType)'
                ),
                array(
                    'name' => '机构名称',
                    'value' => 'CHtml::encode($data->CompanyName)'
                ),
                array(
                    'name' => '姓名',
                    'value' => 'CHtml::encode($data->Name)'
                ),
                array(
                    'name' => '手机',
                    'value' => 'CHtml::encode($data->MobPhone)'
                ),
                array(
                    'name' => '邮箱',
                    'value' => 'CHtml::encode($data->Email)'
                ),
                array(
                    'name' => '推荐时间',
                    'value' => 'CHtml::encode(date("Y-m-d",$data->record->RecomTime))'
                ),
//                array(
//                    'name' => '正式会员时间',
//                    'value' => 'CHtml::encode(date("Y-m-d",$data->record->BeFormalTime))'
//                ),
            /*
              array(
              'name' => '推荐方法',
              'value' => 'CHtml::encode($data->record->RecomMethod)'
              ),
              array(
              'name' => '会员状态',
              'value' => 'CHtml::encode($data->record->MemberStatus?"正式会员":"试用会员")'
              ), */
            )
        ))
        ?>
    </div>

</div>
<script>
    /*$(document).ready(function(){
        $('#search-btn').click(function(){
            var url = Yii_baseUrl + '/partner/partner/getrecomrecord';
            var CompanyName = $("input[name=CompanyName]").val();
            var MobPhone = $("input[name=MobPhone]").val();
            var Email = $("input[name=Email]").val();	
            var CompanyType = $("select[name=CompanyType]").val();	
            var Month = $("select[name=Month]").val();	
            var RecomMethod = $("select[name=RecomMethod]").val();	
            var MemberStatus = $("select[name=MemberStatus]").val();	
            // var MemberStatus = $("#MemberStatus").val();	
            // alert(MobPhone);
            $('#dg').datagrid({ url:url,queryParams:{
                    'CompanyName':CompanyName,
                    'MobPhone':MobPhone,
                    'Email':Email,    	
                    'CompanyType':CompanyType,    	
                    'Month':Month,    	
                    'RecomMethod':RecomMethod,    	
                    'MemberStatus':MemberStatus,    	
                },method:"get"});
        });		
    });*/
</script>