<?php
$this->pageTitle = Yii::app()->name . ' - ' . "客服平台";
$this->breadcrumbs = array(
    '客服平台' => Yii::app()->createUrl('dealer/customer/index'),
    '回答问题' => Yii::app()->createUrl('dealer/customer/index'),
    '问题详情'
);
//$returnurl = Yii::app()->request->urlReferrer;
//$returnurl = $returnurl ? $returnurl : Yii::app()->createUrl('dealer/customer/index');
$returnurl = Yii::app()->createUrl('dealer/customer/index');
?>
<style>
    th, td {vertical-align: middle;}
    .txxx {
        font-size: 14px;
        font-weight: bold;
        height: 35px;
        line-height: 35px;
        text-indent: 15px;
        color:#fb7722
    }
    .bor_back {
        //border-bottom: 1px solid #c5d2e2;
    }
    .bt-cancel{height:30px;width:80px}
    .gs_info{
        padding-left:80px;
    }
    .gs_info p {
        line-height: 23px;
        margin-top: 15px;
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
        问题状态:<?php echo $data['StateText'] ?>
        <span style=" float:right; margin-right:20px;">
            <a id="return" style="font-weight:400" href="<?php echo $returnurl; ?>">返回</a>
        </span>
    </div>
</div>

<div class="bor_back m-top">
    <!--用户信息-->
    <p class="txxx">用户信息</p>
    <?php if ($data['Promoter']): //平台用户?>
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
    <?php else: //非平台用户?>
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
    <div class="txxx_info4 gs_info">
        <p>
            <label>问题类型：</label>
            <label><?php echo $data['TypeText'] ?></label>
        </p>
        <p>
            <label>问题标题：</label>
            <label><?php echo $data['Title'] ?></label>
        </p>
        <div style="line-height:22px;margin-top:5px">
            <div style="float:left">问题描述：</div>
            <div style="float:left;word-break:break-all;word-wrap:break-word; white-space:normal;width:600px;margin-left:5px" id='pre_lms'>
                <?php echo $data['Desc'] ?>
            </div>
            <div style="clear:both"></div>
        </div>
        <p>
            <label>提交时间：</label>
            <label><?php echo date('Y-m-d H:i:s', $data['SubmitTime']); ?></label>
        </p>
    </div>
</div>

<?php if ($files): ?>
    <div class="bor_back m-top">
        <!--问题信息-->
        <p class="txxx">问题附件</p>
        <div class="txxx_info4 gs_info" style="padding-top:10px">
            <?php
            $url = F::uploadUrl();
            foreach ($files as $f):
                ?>
                <?php if ($f['filetype'] == 1): ?>
                    <span>
                        <a href="<?php echo $url . $f['Path']; ?>" target='_black' title="<?php echo $f['FileName']; ?>">
                            <img src="<?php echo $url . $f['Path']; ?>" width="140px" height="100px" onerror="javascript:this.src='<?php echo Yii::app()->baseUrl . '/themes/default/images/404.jpg'; ?>'">
                        </a>
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

<?php if ($data['State'] > 2): ?>
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

    <?php if ($data['Satisfaction'] && $data['UserType'] == 1): //反馈信息  ?>
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

<?php if ($data['State'] == 2 || $data['State'] == 5): ?>
    <?php if ($data['State'] == 5 && $data['UserType'] == 1): //反馈信息?>
        <div class="bor_back m-top">
            <p class="txxx">反馈信息</p>
            <div class="txxx_info4 gs_info">
                <p>
                    <label class="m_left24">评分：</label>
                    <label align="left"><?php echo $data['Satisfaction'] . '分(' . $data['SatisfyText'] . ')'; ?></label>
                </p>
                <p style="word-wrap:break-word; white-space:normal;">
                    <label class="m_left24">备注：</label>
                    <label><?php echo $data['SatisfactionDesc'] ?></label>
                </p>
                <p>
                    <label>反馈时间：</label>
                    <label><?php echo date('Y-m-d H:i:s', $data['SatisfactionTime']) ?></label>
                </p>
            </div>
        </div>
    <?php endif; //解答信息的操作?>
    <div class="m-top">
        <p class="txxx">问题回答</p>
        <form action="" method="post">
            <div class="txxx_info4 gs_info">
                <p>
                    <label width="200" style="text-align:right;padding-right:20px;" rowspan="2">问题回答：</label>
                    <label style="text-align:left;padding-top:10px">
                        <textarea rows="4" cols="70" name="Answer" maxlength="200" style="text-align:left"><?php echo $data['Answer'] ?></textarea>
                    </label>
                </p>
                <p>
                    <label style="text-align:left"><span id="showspan">（回答在200字以内）</span></label>
                </p>
            </div>
            <div style="margin:10px auto;text-align:center">
                <input type="submit" class="submit" value="保 存" id="save-qs">
            </div>
        </form>
    </div>
<?php endif; ?>
<form id="importform" method="post">
    <input id="fmpath" name="fileurl" type="hidden">
    <input id="fmname" name="filename" type="hidden">
</form>
<script type="text/javascript" src="<?php echo Yii::app()->theme->baseUrl; ?>/js/jpd/jquery.form.js"></script>
<script>
    $(function() {
        //下载附件
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
        });
    })
</script>

<script type="text/javascript">
    $(document).ready(function() {
        $('textarea[name=Answer]').live('input propertychange', function() {
            //showchange();
        })

        $('#save-qs').click(function() {
            var Answer = $('textarea[name=Answer]').val();   //获取修改促销价的值
            if ($.trim(Answer) == '') {
                $('#showspan').text('请填写问题答案');
                return false;
            } else if (Answer.length > 200) {
                $('#showspan').text('（回答在200字以内）');
                return false;
            }
        })
    })

    function showchange() {
        var len = parseInt($.trim($('textarea[name=Answer]').val()).length);
        if (len <= 200) {
            var sy = 200 - len;
            $('#showspan').text('还可以输入' + sy + '字');
        } else {
            var sy = len - 200;
            $('#showspan').html('已超过<font color="red">' + sy + '</font>字');
        }
    }
</script>


