
<?php
$this->pageTitle = Yii::app()->name . ' - ' . "问题详情";
$this->breadcrumbs = array(
    '客服' => Yii::app()->createUrl('servicer/servicequestion/wait'),
    '问题详情'
);
?>
<style>
    th, td {vertical-align: middle;}
    .bt-cancel{height:30px;width:80px}
    .gs_info{
        padding-left:80px;
    }
    .gs_info p {
        line-height: 23px;
        margin-top: 15px;
    }
    .txxx {
        font-size: 14px;
        font-weight: bold;
        height: 35px;
        line-height: 35px;
        text-indent: 15px;
        color:#fb7722
    }
    #pre_lms ol li{
        list-style:decimal!important;
    }
    #pre_lms ul li{
        list-style:disc;
    }
    #pre_lms em,strong{
        font-style:oblique;
        font-weight:bold;
    }
</style>
<div class="bor_back m-top">
    <div class="txxx txxx2">
        问题状态:
            <?php
            $factstatus;
            if ($data['State'] == 1)
                $factstatus = '已提交';
            if ($data['State'] == 2)
                $factstatus = '已提交';
            if ($data['State'] == 3)
                $factstatus = '已回复';
            if ($data['State'] == 4)
                $factstatus = '已完结';
            if ($data['State'] == 5)
                $factstatus = '重新打开';
            if ($data['State'] == 6)
                $factstatus = '待回访';
            echo $factstatus;
            ?>
        <span style=" float:right; margin-right:20px;">
            <a id="return" style="font-weight:400;cursor: pointer" onclick="window.history.back()">返回</a>
        </span>
    </div>
</div>

<div class="bor_back m-top">
    <!--用户信息-->
    <p class="txxx">用户信息</p>
<?php if ($data['Promoter']): //平台用户 ?>
        <div class="txxx_info4 gs_info">
            <p>
                <label style="width:250px;text-align:right;">用户类型：</label>
                <label>平台用户</label>
            </p>
            <p>
                <label class="m_left12">发起人：</label>
                <label><?php echo $data['OrganName'] ?></label>
            </p>
        </div>
<?php else: //非平台用户 ?>
        <div class="txxx_info4 gs_info">
            <p>
                <label>用户类型：</label>
                <label>非平台用户</label>
            </p>
            <p>
                <label class="m_left12">发起人：</label>
                <label><?php echo $data['OrganName'] ?></label>
            </p>
            <p>
                <label class="m_left24">电话：</label>
                <label><?php echo $data['Phone'] ?></label>
            </p>
            <p>
                <label class="m_left24">qq号：</label>
                <label><?php echo $data['QQ'] ?></label>
            </p>
            <p>
                <label class="m_left24">邮箱：</label>
                <label><?php echo $data['Email'] ?></label>
            </p>
        </div>
<?php endif; ?>
</div>


<div class="bor_back m-top">
    <!--问题信息-->
    <p class="txxx">问题信息</p>
    <div class="txxx_info4 gs_info"  id='pre_lms'>
        <p>
            <label width="100">问题类型：</label>
            <label><?php echo $data['Type'] ?></label>
        </p>
        <p>
            <label>问题标题：</label>
            <label><?php echo $data['Title'] ?></label>
        </p>
        <p style="word-wrap:break-word; white-space:normal;">
            <label>问题描述：</label>
            <label><?php echo $data['Desc'] ?></label>
        </p>
    </div>
</div>


        <?php if ($files): ?>
    <div class="bor_back m-top">
        <!--问题信息-->
        <p class="txxx">问题附件</p>
        <div class="txxx_info4 gs_info" style="padding-top:10px">
    <?php
    $url = Yii::app()->params['ftpserver']['visiturl'];
    foreach ($files as $f):
        ?>
                    <?php if ($f['filetype'] == 1): ?>
                    <span>
                    <?php if (1 == 1): ?>
                            <a href="<?php echo $url . $f['Path']; ?>" target='_black' title="<?php echo $f['FileName']; ?>">
                                <img src="<?php echo $url . $f['Path']; ?>" width="140px" height="100px">
                            </a>
                    <?php else: ?>
                            <img src="<?php echo Yii::app()->baseUrl . '/themes/default/images/404.jpg'; ?>" width="140px" height="100px">
                    <?php endif; ?>
                    </span>
                <?php endif; ?>
            <?php endforeach; ?>
        </div>
        <div class="txxx_info4 gs_info">
    <?php
    $k = 1;
    foreach ($files as $f):
        ?>
                <?php if ($f['filetype'] != 1): ?>
                    <div>
                        文档<?php echo $k; ?>：
                        <span style="color:green;margin-left:10px" class="downfiles">
                            <a href="javascript:void(0)" url="<?php echo $f['Path']; ?>" style="border-bottom:1px blue solid;"><?php echo $f['FileName']; ?></a>
                        </span>
                    </div>
            <?php
            $k++;
        endif;
        ?>
    <?php endforeach; ?>
        </div>
    </div>
<?php endif; ?>

<?php if ($data['State'] > 2): //解答信息   ?>
    <div class="bor_back m-top">
        <p class="txxx">解答信息</p>
        <div class="txxx_info4 gs_info">
            <p>
                <label style="margin-left:-13px;">解答人类型：</label>
                <label><?php echo $data['ExecutorType'] == 1 ? '嘉配客服' : '经销商'; ?></label>
            </p>
            <p>
                <label class="m_left12">解答人：</label>
                <label><?php echo $data['ExecutorName']; ?></label>
            </p>
            <div style="line-height:22px;margin-top:5px">
                <div style="float:left">问题答案：</div>
                <div style="float:left;word-break:break-all;word-wrap:break-word; white-space:normal;width:700px;padding-left:5px">
    <?php echo $data['Answer'] ?>
                </div>
                <div style="clear:both"></div>
            </div>
            <p>
                <label>解答时间：</label>
                <label><?php echo date('Y-m-d H:i:s', $data['AnswerTime']) ?></label>
            </p>
        </div>
    </div>

    <?php if ($data['Satisfaction'] && $data['UserType'] == 1): //反馈信息   ?>
        <div class="bor_back m-top">
            <p class="txxx">反馈信息</p>
            <div class="txxx_info4 gs_info">
                <p>
                    <label class="m_left24">评分：</label>
                    <input type="hidden" id="satisfydesc" value="<?php echo $data['SatisfyText'] . '(' . $data['Satisfaction'] . '分)'; ?>">
                    <label><?php echo $data['SatisfyText'] . '(' . $data['Satisfaction'] . '分)'; ?></label>
                </p>
                <p>
                    <label class="m_left24">备注：</label>
                    <label><?php echo $data['SatisfactionDesc'] ?></label>
                </p>
                <p>
                    <label>反馈时间：</label>
                    <label><?php echo date('Y-m-d H:i:s', $data['SatisfactionTime']) ?></label>
                </p>
            </div>
        </div>
    <?php endif; ?>
<?php endif; ?>



<?php if ($data['State'] == 3): ?>
    <div class="bor_back m-top">
        <p class="txxx">用户反馈</p>
        <div class="txxx_info4 gs_info">
            <p>
                <label class="m_left24">评分：</label>
                <input name="satisfy" type="radio" value="1" class="satify-radio">1分(非常不满意)
                <input name="satisfy" type="radio" value="2" class="satify-radio">2分(不满意)
                <input name="satisfy" type="radio" value="3" class="satify-radio">3分(一般)
                <input name="satisfy" type="radio" value="4" class="satify-radio">4分(满意)
                <input name="satisfy" type="radio" value="5" class="satify-radio">5分(非常满意)
                <span id="valspan" style="color:red"></span>
            </p>
            <p>
                <label class="m_left24">备注：</label>
                <label>
                    <input type="text" class="input" style="width:400px" name="SatisDesc">
                    <span id="descspan">（备注不超过30字）</span>
                </label>
            </p>
        </div>
        <div style="margin:10px auto 20px auto;text-align:center">
            <input type="submit" class="submit" value="保 存" id="save_satisfy">
        </div>
    </div>
<?php endif; ?>



<form id="importform" method="post">
    <input id="fmpath" name="fileurl" type="hidden">
    <input id="fmname" name="filename" type="hidden">
</form>
<script type="text/javascript" src="<?php echo Yii::app()->theme->baseUrl; ?>/js/jpd/jquery.form.js"></script>
<script type="text/javascript">
            $("#save_satisfy").click(function() {
                var satisfy = $("input[name=satisfy]:checked").val();
                if (!satisfy) {
                    $("#valspan").html('(请先选择评分)')
                    return false
                }
                var SatisDesc = $("input[name=SatisDesc]").val();
                if (SatisDesc.length > 30) {
                    $("#descspan").html('备注已超过30字')
                    return false
                }
                var ID = '<?php echo $data['ID'] ?>';
                $.ajax({
                    url: '<?php echo Yii::app()->createUrl('servicer/servicequestion/savexin') ?>',
                    data: {'ID': ID, 'satisfy': satisfy, 'SatisDesc': SatisDesc},
                    type: 'post',
                    dataType: 'json',
                    success: function(reg) {
                        if (reg.success) {
                            window.location.href = window.location.href;
                        } else {
                            alert(reg.message)
                        }
                    }
                })
            })

            $(".downfiles").click(function() {
                $('#fmpath').val($(this).find('a').attr('url'));
                $('#fmname').val($(this).find('a').text());
                $('#importform').form({
                    url: Yii_baseUrl + '/upload/ftpdownload',
                    success: function(data) {
                        var result = eval('(' + data + ')');
                        if (result.res == 0)
                            alert(result.msg)
                    }
                });
                $('#importform').submit();
            })
            //重新打开
            // $("#cxdk").click(function(){
            //     var ID='<?php echo $data['ID'] ?>';
            //     if(!confirm('确认重新打开？')){
            //         return false
            //     }
            //     $.ajax({
            //         url:'<?php echo Yii::app()->createUrl('servicer/servicequestion/cxdk') ?>',
            //         type:'post',
            //         dataType:'json',
            //         data:{'ID':ID},
            //         success:function(reg){
            //             alert(reg.message)
            //         }
            //     })
            // })

</script>