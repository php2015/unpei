<!--商品列表开始-->
<div class="content2d">
    <ul id="goods_ul">
        <?php
        $this->widget('widgets.default.WListView', array(
            'dataProvider' => $goodsdata["dataProvider"],
            'ajaxUpdate' => true,
            'itemView' => 'goods_list', // refers to the partial view named '_post'
            'summaryText' => '',
            'emptyText' => '
                     <div class="nogoods_text" style="height:200px;margin:0 auto;">
                <div style=" padding-top: 65px;margin:0 auto; width: 50%">
                    <img src="' . Yii::app()->theme->baseUrl . '/images/images/nogoods.jpg" style="float: left;display: block"/><b><span style=" color:#FF6500;float:left;display: block; font-size: 18px;margin:8px 0 0 15px">非常抱歉,商品持续更新中!</span></b>
                    <div style="margin:60px 0 0 50px">
                        <b><p><span style="color:#353535; font-size: 15px;font-family: \'微软雅黑\'">您可以：</span><span style="color:#676767;font-size: 15px; font-family: \'微软雅黑\'">查看其他商品</span></p></b>
                    </div>
                </div>
            </div>'
        ))
        ?>
    </ul>


    <div style="clear:both"></div>
</div>
<!--商品列表结束-->