<style>
    /*    .text-omit{
            overflow: hidden;
            text-overflow: ellipsis;
            white-space: nowrap;
        }*/

</style>
<div class="zwq_splb">
    <ul class="m-top" >
        <li>
            <div class="checkbox_se"><input type="checkbox" id="<?php echo b . $data['ID'] ?>" onclick="checkbox(<?php echo $data['ID'] ?>)"/></div>
            <div class="float_l zwq_img"><a href="<?php echo yii::app()->createUrl('pap/Dealergoods/Goodsinfo', array('goods' => $data['ID'], 'status' => 1)) ?>">
                    <img style="width:80px;height: 80px;" src="<?php echo $data['MallImage']; ?> " /></a></div>
            <div class="float_l zwq_info">
<!--                    <p class="zwq_name m-top" style=" width: 400px; overflow: hidden"><?php // echo $data->Name                              ?></p>
                <p class="m-top" style=" width: 400px;">商品编号：<span class="zwq_color"><?php // echo $data->GoodsNO                              ?></span> | <span>品牌：<?php // echo $data->brand->BrandName                              ?></span> | <span>标准名称：<?php // echo $data->StandCode                              ?></span></p>
                <p class="m-top" style=" width: 400px;">拼音代码：<span><?php // echo $data->Pinyin                              ?></span> | <span>备注：<?php // echo $data->Memo                              ?></span></p>-->
                <p class="zwq_name m-top5" style=" width: 400px;height: 18px;white-space: nowrap;overflow: hidden; text-overflow: ellipsis;"><a class="zwq_name" href="<?php echo yii::app()->createUrl('pap/Dealergoods/Goodsinfo', array('goods' => $data['ID'], 'status' => 1)) ?>" title="<?php echo $data['Name'] ?>"><?php echo $data['Name'] ?></a></p>
                <div class="m-top5" style=" width: 400px;height: 17px;overflow: hidden"><div class="float_l cut width150">商品编号：<a title="<?php echo $data['GoodsNO'] ?>"><?php echo $data['GoodsNO'] ?></a><span class="zwq_color"></span></div><div class="float_l color_hui"> |</div><div class="float_l cut m_left width180"> <span>品牌：<a title="<?php echo $data['Brand'] ?>"><?php echo $data['Brand'] ?></a></span></div></div>
                <div class="m-top5" style=" width: 400px;height: 17px;overflow: hidden"><div class="float_l cut width150"> 标准名称：<a title="<?php echo $data['cpname'] ?>">
                            <?php echo $data['cpname'] ?></a></div><div class="float_l color_hui">|</div> 
                    <div class="float_l cut m_left width180">拼音代码：<a title="<?php echo $data['Pinyin'] ?>"><?php echo $data['Pinyin'] ?></a></div> </div>
                <p class="m-top5" style=" width: 360px;height: 16px;white-space: nowrap;overflow: hidden; text-overflow: ellipsis;">备注：<span><?php echo F::msubstr($data['Memo']); ?></span></p>
            </div>
            <div class="float_l zwq_price" style="width:140px">

                <?php if ($data['IsPro'] == 1) { ?>
                    <p class="m-top">促销价：<span class="zwq_color">￥<?php echo $data['ProPrice'] ?></span></p>
                    <p class="cankaojia">参考价：<span class="zwq_color">￥<?php echo $data['Price'] ?></span></p>
                <?php } else { ?>
                    <p class="m-top">参考价：<span class="zwq_color">￥<?php echo $data['Price'] ?></span></p>
                <?php } ?>



            </div>
            <div class="float_r zwq_OE" style="width: 156px;padding-top: 10px; ">
                <div class="zwq_top" style="width: 156px;height: 16px;overflow: hidden"><img src="<?php echo F::themeUrl() ?>/images/images/OE_numb.jpg"  style="float: left"/>
                    <div style="margin-left:5px;height: 16px;width: 129px;white-space: nowrap;overflow: hidden;float: right;text-overflow: ellipsis;" title="<?php echo $data['OENOS'] ?>">
                        <?php echo $data['OENOS'] ?>
                    </div>
                    <!--<span style="margin-left:5px;width: 134px;overflow: hidden;   display: block;float: right;" title="<?php echo $data['OENOS'] ?>"><?php echo $data['OENOS'] ?></span>-->
                </div>
                <!--<div class="zwq_top"><img src="<?php echo F::themeUrl() ?>/images/images/shiyong.jpg" /></div>-->
                <!--<div class="zwq_top" style="white-space: nowrap;overflow: hidden; text-overflow: ellipsis;"><a title="<?php echo $data['vehicle'] ?>"><?php echo $data['vehicle'] ?></a></div>-->
                <p style="padding-top: 5px">配件档次：
                    <span><?php
                        $PartsLevel = $data['PartsLevel'];
                        echo Yii::app()->getParams()->PartsLevel[$PartsLevel] ? Yii::app()->getParams()->PartsLevel[$PartsLevel] : '暂无'
                        ?></span>
                </p>
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
                html += "<p class='m-top5'>商品编号:<span style='color:#FF5500;font-weight:bolder'>" + data.GoodsNO + "</span> | 品牌：<span></span></p>"
                html += "<p class='m-top5'>标准名称：<span style='color:#FF5500;font-weight:bolder'>" + data.StandCode + "</span><span></span> | 拼音代码：<span>" + data.Pinyin + "</span></p>"
                html += "<p class='m-top5'>备注：<span>" + data.Memo + "</span></p>"
                html += "<br />"
                html += "<p class='m-top5' style='color:#FF5500;font-weight:bolder'> 参考价：￥" + data.Price + "</p> "
                html += "<p style='color:#FF5500;font-weight:bolder'>促销价:<input id='editpro' type='text' size='10' name='ProPrice' style='height:25px;'/></p>"
                html += " </form>";
                $('#formedit').html(html);
            }
        });
    }
</script>

