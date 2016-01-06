<style>
    .news_content{text-indent:2em;word-break:break-all;margin:0 auto;line-height:22px;padding:20px 60px}
    .news_content a{text-decoration:underline;}
    .news_content a:hover{color:#f27300}
    .txxx{color:#FB7722;height: 35px;
          line-height: 35px;
          text-indent: 15px;
          border-bottom: 1px solid #dcdcdc;
          font-size: 14px;
          font-weight: bold;
    }
</style>
<?php
$this->pageTitle = Yii::app()->name . ' - 消息详情页';
?>
<p class="txxx txxx3">消息详情</p>
<p style="height:2px">
    <span style="display: block;float: right;margin-top: -26px;margin-right:12px;">
        <?php
        $linkarr = array();
        if (isset($_GET['type'])) {
            $linkarr['type'] = $_GET['type'];
        }
        ?>
        <a href="<?php echo Yii::app()->createUrl('pap/remind/system', $linkarr) ?>" style="cursor:pointer;">返回</a>
    </span>
</p>
<div style='margin:20px auto;text-align:center;font-size:22px;font-weight:bold;padding:20px;word-break:break-all'>
    <?php echo $row['Title'] ?>
</div>
<div>
    <div style="float:left;margin-left:50px">
        时间：<?php echo date('Y-m-d H:i:s', $row['CreateTime']); ?>
    </div>
    <div style="float:left;margin-left:50px">
        分类：<?php
        switch ($row['Type']) {
            case '0':default:
                echo '系统提醒';
                break;
            case '1':
                echo '非法操作';
                break;
            case '2':
                echo '服务到期';
                break;
        }
        ?>
    </div>
    <div style="clear:both"></div>
</div>
<div class='news_content'>
    <?php echo $row['Content'] ?>
    <?php
    if ($row['LinkUrl']) {
        echo "<br/>链接地址：<a href='{$row['LinkUrl']}' target='_blank'>{$row['LinkUrl']}</a>";
    }
    ?>
</div>