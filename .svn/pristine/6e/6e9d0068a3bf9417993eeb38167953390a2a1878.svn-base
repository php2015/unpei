<?php //var_dump($data);          ?>
<div class="zwq_splb">
    <ul class="m-top" >
        <li>
            <div class="float_l zwq_img">
                <a href="<?php echo yii::app()->createUrl('pap/Dealergoods/Goodsinfo', array('goods' => $data['ID'], 'status' => 1)) ?>" target='_blank'>
                    <img style="width:80px;height: 80px;" src="<?php
                    if ($data['image']) {
                        echo $data['image'];
                    } else {
                        echo F::uploadUrl() . 'common/default-goods.png';
                    }
                    ?>" />
                </a>
            </div>
            <div class="float_l zwq_chuxiao_info" style="width:300px;">
                <p class="zwq_name m-top5" style=" width: 270px;height: 16px;white-space: nowrap;overflow: hidden; text-overflow: ellipsis;">
                    <a class="zwq_name" target='_blank' href="<?php echo yii::app()->createUrl('pap/Dealergoods/Goodsinfo', array('goods' => $data['ID'], 'status' => 1)) ?>" titlt="<?php echo $data['Name'] ?>"><?php echo $data['Name'] ?></a>
                </p>
                <div class="m-top5" style=" width: 300px;height: 17px;overflow: hidden">
                    <div class="float_l cut " style="width:130px;white-space: nowrap;overflow: hidden; text-overflow: ellipsis;">
                        商品编号：<a title="<?php echo $data['GoodsNO'] ?>"><?php echo $data['GoodsNO'] ?></a>
                        <span class="zwq_color"></span>
                    </div>
                    <div class="float_l color_hui"> |</div>
                    <div class="float_l cut m_left width120"> 
                        <span>品牌：<a title="<?php echo $data['Brand'] ?>"><?php echo $data['Brand'] ?></a></span>
                    </div>
                </div>
                <div class="m-top5" style=" width: 300px;height: 17px;overflow: hidden">
                    <div class="float_l cut " style="width:130px;white-space: nowrap;overflow: hidden; text-overflow: ellipsis;"> 标准名称：<a title="<?php echo DealergoodsService::StandCodegetcpname($data['StandCode'], 'Name'); ?>"><?php echo DealergoodsService::StandCodegetcpname($data['StandCode'], 'Name'); ?></a></div>
                    <div class="float_l color_hui">|</div>
                    <div class="float_l cut m_left" style="width:130px;white-space: nowrap;overflow: hidden; text-overflow: ellipsis;">拼音代码：<a title="<?php echo $data['Pinyin'] ?>"><?php echo $data['Pinyin'] ?></a></div> 
                </div>
                <p class="m-top5" style=" width: 270px;height: 16px;white-space: nowrap;overflow: hidden; text-overflow: ellipsis;">备注：<span><?php echo F::msubstr($data['Memo']) ?></span></p>
            </div>


            <div class="float_l zwq_price" style="width: 160px;">   
                <p class="m-top " id="cankaojia<?php echo $data['ID']; ?>">参考价：<span class="zwq_color">￥<?php echo $data['Price'] ?></span></p>

                <p class="" id="chenggong<?php echo $data['ID']; ?>" style="display:none">促销价：<span class="zwq_color"></span></p>
<!--                <p>配件档次：<span><?php
                //$PartsLevel = $data['PartsLevel'];
                //echo Yii::app()->getParams()->PartsLevel[$PartsLevel] ? Yii::app()->getParams()->PartsLevel[$PartsLevel] : '暂无'
                ?></span></p>-->
            </div>

            <div class="float_l zwq_OE m_left">
                <div class="zwq_top" style=" width:150px;height: 16px;white-space: nowrap;overflow: hidden; text-overflow: ellipsis;"><img src="<?php echo F::themeUrl() ?>/images/images/OE_numb.jpg" /><span style="margin-left:5PX"><a title="<?php echo $data['OENOS'] ?>"><?php echo $data['OENOS'] ?></a></span></div>
                <!--<div class="zwq_top"><img src="<?php //echo F::themeUrl()   ?>/images/images/shiyong.jpg" /></div>-->
                <br />
                <!--<div class="zwq_top" style=" width: 150px;height: 16px;white-space: nowrap;overflow: hidden; text-overflow: ellipsis;"><a title="<?php //echo $data['vehicle']   ?>"><?php //echo $data['vehicle']   ?></a></div>-->
                <p>配件档次：<span><?php
                        $PartsLevel = $data['PartsLevel'];
                        echo Yii::app()->getParams()->PartsLevel[$PartsLevel] ? Yii::app()->getParams()->PartsLevel[$PartsLevel] : '暂无'
                        ?></span></p>
            </div>

            <div class="cuxiao float_r cx_cz" style="width: 90px;" id="shezhi<?php echo $data['ID']; ?>">
                <span class="cxsp float_l m-top20">
                    <a href="javascript:void(0)">
                        <span  onClick="Loadedit(<?php echo $data['ID']; ?>)">设置促销</span>
                    </a>
                </span>
            </div>

            <div class="cuxiao float_r cx_cz" style="width: 90px;display: none;" id="yicuxiao<?php echo $data['ID']; ?>">
                <span class="cxsp float_l m-top20" >
                    <span style="color: #FF5500;font-weight: bold">已促销</span>
                </span>
            </div>
        </li>
    </ul>
</div>
<script type="text/javascript">

    function Loadedit(goodsID) {
        var url = Yii_baseUrl + '/pap/promotion/editgoodsinfo';
        $.ajax({
            url: url,
            type: 'POST',
            data: {'ID': goodsID},
            dataType: 'JSON',
            success: function(data)
            {
                $('#mydialog').dialog('open');
                var html = '';
                html += "<input type='hidden' id='loadedit_id' value='" + data.ID + "'/>"
                html += " <form>"
                html += "<p class='zwq_name m-top5' style='color:#3D3D3D'>" + data.Name + "</p>"
                html += "<p class='m-top5'>商品编号:<span style='color:#FF5500;font-weight:bolder'>" + data.GoodsNO + "</span> </p>"
                html += "<p class='m-top5'>标准名称：<span>" + data.StandCode + "</span><span></span> | 拼音代码：<span>" + data.Pinyin + "</span></p>"
                html += "<p class='m-top5' style=' word-break:break-all;width:350px;'>备&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;注：<span>" + data.Memo + "</span></p>"
                html += "<br />"
                html += "<p class='m-top5' style='color:#FF5500;font-weight:bolder;' id='price'> 参考价：￥" + data.Price + "</p> "
                html += "<p style='color:#FF5500;font-weight:bolder'>促销价:\n\
<input id='editpro" + goodsID + "' type='text' size='10'   price='" + data.Price + "' name='ProPrice' onBlur='addProgoodprice(this)' style='height:25px;'/></p>"

                html += " </form>";
                $('#formedit').html(html);



            }
        });
    }
</script>


