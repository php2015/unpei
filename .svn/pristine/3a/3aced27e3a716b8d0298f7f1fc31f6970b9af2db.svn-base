<style>
    .row label {
        display: inline-block;
        margin-right: 0;
        text-align: right;
        width: 110px !important;
    }
</style>
<?php
$this->breadcrumbs = array(
    '营销管理' => Yii::app()->createUrl('common/marketlist'),
    '客户管理',
);
?>

<!--内容部分-->
<div class="bor_back m_top10">
    <p class="txxx">修改基本信息</p>
    <div class="txxx_info">
        <div class='form'>
            <form method="post">
                <div class='row'>
                    机构名称
                    <input type="text" name="" readonly value="<?php echo $organname['OrganName'] ?>">
                </div>
                <div class='row'>
                    客户级别
                    <select class="select select2" id="testSelect" >
                        <option name="Cooperationtype" value ="A" <?php echo $model['Cooperationtype'] == 'A' ? 'selected' : '' ?>>A</option>
                        <option name="Cooperationtype" value ="B" <?php echo $model['Cooperationtype'] == 'B' ? 'selected' : '' ?>>B</option>
                        <?php if (empty($model)): ?>
                            <option name="Cooperationtype"value ="C" selected>C</option>
                        <?php else: ?>
                            <option name="Cooperationtype"value ="C" <?php echo $model['Cooperationtype'] == 'C' ? 'selected' : '' ?>>C</option>
                        <?php endif; ?>
                    </select>
                </div>
                <div class='row' style="padding-left:200px;">
                    <input class='submit' type='button' id="save" value='保存'/>
                    <input class='submit' type='button' id="nosave" value='取消'/>
                    <input  type='hidden' id="ServiceID" value='<?php echo $organname['ID'] ?>'/>
                </div>
            </form>
        </div>
    </div>
</div>
<!--内容部分结束-->

<script type="text/javascript">
    $(document).ready(function(){
        $("#save").click(function(){
            if(window.confirm("您确定要保存吗?"))
            {
                var ServiceID=$('#ServiceID').val();
                var Cooperationtype=$('#testSelect option:selected') .val();
                var url="<?php echo Yii::app()->createUrl('pap/contact/editclient') ?>";
                $.post(url, {
                    ServiceID: ServiceID,
                    Cooperationtype: Cooperationtype
                }, function(data) {
                    if (data.success) {
                        window.location.href = Yii_baseUrl + "/pap/contact/index";
                    } 
                }, 'json');
            }
        });
        
        $('#nosave').click(function(){
            window.location.href=Yii_baseUrl+"/pap/contact/index";
        })
    })
</script>

