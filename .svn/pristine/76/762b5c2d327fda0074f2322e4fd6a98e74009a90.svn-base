<style>
    .letter-ul{list-style-type:none;padding:10px;float:left;min-width:660px}
    .letter-ul li{float:left;padding:3px 5px;border:1px solid #ccc;margin-right:5px;
                  height: 20px;line-height: 20px;}
    .letter-ul li a{font-size:14px;font-weight:bold}
    .letter-ul li.choose-all a{font-size:12px;font-weight:normal}
    .letter-ul li.selected{background:#0164c1}
    .letter-ul li.selected a{color:#fff;}
    .list-page li{float:left}
    .make-ul{list-style-type:none;padding:5px 10px}
    .info-li{border: 1px solid #fac9a1;float: left;height: 120px;margin:0px 7px 10px 7px;padding:10px 2px;width: 274px;}
    .qq li{background:url(<?php echo F::themeUrl() ?>/images/qq.png) no-repeat -2px 1px;height:24px;line-height:24px;padding-left:22px}
    .qq a{color:#0164c1}
    .img-make{max-height:80px;display:block;float:left;max-width:80px}
    .span-make{
        display: block;float: left;text-align: left;min-width: 100px;max-width:120px;
        color:#ff6600;font-weight:bold;font-size:14px;padding-top:25px
    }
    .organ-name{height:20px;line-height:20px}
    .organ-name a{font-weight:bold}
    .pager{ float:right;clear:both}
    .pager li a,.pager .goto a{ font-family: "微软雅黑"; padding: 2px 6px; border:1px solid #eee;}
    .pager span.goto{ font-family: "微软雅黑";}
    .pager li a {display:block;}
    .pager li a:hover{border:1px solid #ff6600}
    .pager li.selected{background:none}
    .pager li.selected a{ color:#ff6600; font-weight: bold}
    .pager .spanr{display:none}
    .pager .input{margin:0; width:30px;height:22px;}
    .fenye{margin:7px 7px 2px 2px}
    .total{
        border-right: 1px solid #e7e3e7;
        font-family: verdana;
        height: 22px;
        line-height: 22px;
        padding: 2px 2px 2px 0;
    }
    .total span {
        color: #ff6600;
    }
    .total b {
        color: #ff6600;
    }
    .text {
        font-family: verdana;
        height: 22px;
        line-height: 22px;
        padding: 2px 0 2px 2px;
    }
    .text i {
        color: #ff6600;
        font-weight: bold;
    }
    .top_fenye {
        cursor: pointer;
        float: right;
        line-height: 26px;
    }
    .top_fenye ul li{ 
        margin-top:0;
        background: none repeat scroll 0 0 #fff; 
        border: 1px solid #cecbce;
        float: left;
        height: 23px;
        line-height: 25px;
        margin-left: 5px;
    }
    .top_fenye ul li a{ padding: 2px 2px}
    .subp{
    overflow: hidden;
    text-overflow: ellipsis;
    white-space: nowrap;
    width: 50px
}
.onm{ overflow: hidden;
    text-overflow: ellipsis;
    white-space: nowrap;
    width: 150px}
</style>
<?php
$this->breadcrumbs = array(
    '信息沟通' => Yii::app()->createUrl('pap/remind/info'),
);
$this->pageTitle = Yii::app()->name . ' - 信息沟通';
?>
<div class="bor_back m-top10" style='min-height:500px;height:auto'>
    <ul class='letter-ul'>
        <li class="choose-all <?php echo!$params['pinyin'] ? 'selected' : '' ?>">
            <a href="<?php echo Yii::app()->createUrl('servicer/uniondealer/info') ?>">全部</a>
        </li>
        <?php if ($pinyin):foreach ($pinyin as $k => $v): ?>
                <li class="<?php echo $params['pinyin'] == $v ? 'selected' : '' ?>">
                    <a href="<?php echo Yii::app()->createUrl('servicer/uniondealer/info', array('pinyin' => $v)) ?>">
                        <?php echo $v ?>
                    </a>
                </li>
                <?php
            endforeach;
        endif;
        ?>
        <?php
        //for ($i = 0; $i < 20; $i++):
        ?>
<!--<li><a href="<?php // echo Yii::app()->createUrl('pap/remind/info')       ?>">B</a></li>-->
        <?php //endfor; ?>
    </ul>
    <div>
        <?php
        $this->widget('widgets.default.WShortPager', array(
            'pages' => $pages, 'makeinfo' => true,
        ))
        ?>
    </div>
    <div class='clear'></div>
    <div>
        <?php
        $this->widget('widgets.default.WListView', array(
            'dataProvider' => $info,
            'itemView' => 'test',
            'id' => 'info',
        ));
        ?>
    </div>
    <div class='clear'></div>
</div>
<script>

</script>