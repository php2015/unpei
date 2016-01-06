<style>
    .stie{float:right; margin: 20px 40px 0 0;}
    .stie a span:hover{color:#FB540E;text-decoration: underline}
    .checkbox_se {
        float: left;
        height: 42px;
        margin-right: 6px;
        padding-top: 38px;
        width: 5px;
    }
    .yellow{width:270px;white-space: nowrap;overflow: hidden; text-overflow: ellipsis;}
</style>
<?php //var_dump($data);?>
<div class="zwq_splb">
    <ul class="m-top" >
        <li>
            <div class="float_l zwq_img">
                <a href="<?php echo yii::app()->createUrl('pap/Dealergoods/Goodsinfo', array('goods' => $data['ID'], 'status' => 1)) ?>" target='_blank'>
                    <img style="width:80px;height: 80px;"  src="<?php
                    if ($data['image']) {
                        echo $data['image'];
                    } else {
                        echo F::uploadUrl() . 'common/default-goods.png';
                    }
                    ?>" />
                </a>
            </div>
            <div class="float_l zwq_chuxiao_info" style="width:280px;">
                <p class="zwq_name m-top5 yellow" style=" width: 270px;height: 16px;white-space: nowrap;overflow: hidden; text-overflow: ellipsis;">
                    <a class="zwq_name" target='_blank' href="<?php echo yii::app()->createUrl('pap/Dealergoods/Goodsinfo', array('goods' => $data['ID'], 'status' => 1)) ?>" title="<?php echo $data['Name'] ?>"><?php echo $data['Name'] ?></a>
                </p>
                <div class="m-top5" style=" width: 280px;height: 17px;overflow: hidden">
                    <div class="float_l cut " style="width:130px;white-space: nowrap;overflow: hidden; text-overflow: ellipsis;">
                        商品编号：<a title="<?php echo $data['GoodsNO'] ?>"><?php echo $data['GoodsNO'] ?></a>
                        <span class="zwq_color"></span>
                    </div>
                    <div class="float_l color_hui"> |</div>
                    <div class="float_l cut m_left width120">
                        <span>品牌：<a title="<?php echo $data['Brand'] ?>"><?php echo $data['Brand'] ?></a></span>
                    </div>
                </div>
                <div class="m-top5" style=" width: 280px;height: 17px;overflow: hidden">
                    <div class="float_l cut " style="width:130px;white-space: nowrap;overflow: hidden; text-overflow: ellipsis;"> 标准名称：<a title="<?php echo DealergoodsService::standCodegetcpname($data['StandCode'], 'Name'); ?>"><?php echo DealergoodsService::standCodegetcpname($data['StandCode'], 'Name'); ?></a></div>
                    <div class="float_l color_hui">|</div>
                    <div class="float_l cut m_left" style="width:130px;white-space: nowrap;overflow: hidden; text-overflow: ellipsis;">拼音代码：<a title="<?php echo $data['Pinyin'] ?>"><?php echo $data['Pinyin'] ?></a></div> 
                </div>
                <p class="m-top5" style=" width: 270px;height: 16px;white-space: nowrap;overflow: hidden; text-overflow: ellipsis;">备注：<span><?php echo F::msubstr($data['Memo']) ?></span></p>
            </div>
            <div class="float_l zwq_price" style="width:200px;"><p class="m-top">促销价：<span class="zwq_color">￥<?php echo $data['ProPrice'] ?></span></p><p class="cankaojia">参考价：<span class="zwq_color">￥<?php echo $data['Price'] ?></span></p><p>促销时间：<span><?php echo date("Y-m-d", $data['ProTime']) . '--' . date("Y-m-d", $data['ProTime'] + 60 * 60 * 24 * 14); ?></span></p></div>
            <div class="float_l zwq_OE m_left" style="width:130px;">
                <div class="zwq_top" style="margin-top:18px;"><img src="<?php echo F::themeUrl() ?>/images/images/OE_numb.jpg" /><span style="margin-left:5PX; display: inline-block; width:150px; overflow: hidden;white-space: nowrap;text-overflow:ellipsis "><?php echo $data['OENOS'] ?></span></div>
                <div class="zwq_top" >
                    <p>配件档次：<span><?php
                            $PartsLevel = $data['PartsLevel'];
                            echo Yii::app()->getParams()->PartsLevel[$PartsLevel] ? Yii::app()->getParams()->PartsLevel[$PartsLevel] : '暂无'
                            ?></span></p>
                </div>
            </div>
            <div class="stie">
                <p><a href="javascript:void(0)"><span  onClick="Loadedit(<?php echo $data['ID']; ?>)">修改</span></a><p>
                    <br />
                <p><a href="javascript:void(0)" ><span id="pro" key="<?php echo $data['ID'] ?>">取消</span></a><p>
            </div>
        </li>
    </ul>
</div>
<script type="text/javascript">

    function Loadedit(goodsID) {
        var url = Yii_baseUrl + '/pap/promotion/editgoodsinfo';
        $("#edit_id").val(goodsID);
        $.ajax({
            url: url,
            type: 'POST',
            data: {'ID': goodsID},
            dataType: 'JSON',
            success: function(data)
            {
                $('#mydialog').dialog('open');
                var html = '';
                html += " <form>"
                html += "<p class='zwq_name m-top5' style='color:#3D3D3D'>" + data.Name + "</p>"
                html += "<p class='m-top5'>商品编号:<span style='color:#FF5500;font-weight:bolder'>" + data.GoodsNO + "</span></p>"
                html += "<p class='m-top5'>标准名称：<span>" + data.StandCode + "</span> | 拼音代码：<span>" + data.Pinyin + "</span></p>"
                html += "<p class='m-top5' style=' word-break:break-all;width:350px;'>备&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;注：<span>" + data.Memo + "</span></p>"
                html += "<br />"
                html += "<p class='m-top5' style='color:#FF5500;font-weight:bolder'> 参考价：￥" + data.Price + "</p> "
                html += "<p style='color:#FF5500;font-weight:bolder'>促销价:\n\
            <input id='editpro" + goodsID + "' type='text' size='10' value='" + data.ProPrice + "' price='" + data.Price + "' name='ProPrice' style='height:25px;' onBlur='setProPrice(this)'/></p>"
                html += " </form>";
                $('#formedit').html(html);


            }
        });
    }
</script>

