<form method="post" action="<?php //echo Yii::app()->createUrl("mall/buy/delivery")    ?>" id="goodsform">
    <div class=" m-top gwc_list">
        <div class="gwc_list_info">

            <div >
                <?php foreach ($carlist as $cart): ?>
                <div class="gwc_goods_list sell-<?php echo $cart['SellerID'];?>" >
                        <p class="jxs"><input type="checkbox" class=" checkAll"  style="margin-left:10px" target="<?php echo $cart['SellerID'] ?>"> 经销商：
                            <span name="organName"><a href="<?php echo Yii::app()->createUrl("servicer/uniondealer/detail/dealer"); ?>/<?php echo $cart['SellerID'] ?>" target="_blank"><?php echo isset($cart['SellerName']) ? $cart['SellerName'] : '' ?></a></span></p>
                        <input type="hidden" class="input" name="minTurnover" value="<?php echo $cart["MinTurnover"] ?>"/>
                        <ul>
                            <?php foreach ($cart["GoodsList"] as $list): ?>
                                <?php 
                                     if($list['MakeID']){
                                         $locatecarmodel=  MallService::getCarmodeltxt(array('make'=>$list['MakeID'],'series'=>$list['CarID'],'year'=>$list['Year'],'model'=>$list['ModelID']));
                                         $goodsurl=Yii::app()->createUrl('pap/mall/detail',array('goods'=>$list['GoodsID'],'cart'=>$list['ID']));
                                     }else{
                                         $goodsurl=Yii::app()->createUrl('pap/mall/detail',array('goods'=>$list['GoodsID']));
                                     }
                                ?>
                                <?php $oldTotal = $list['ProPrice'] ? $list['ProPrice'] * $list['Quantity'] : $list['Price'] * $list['Quantity'] ?>
                                <?php $subTotal = sprintf('%.2f', $oldTotal) ?>
                                <li id="li<?php echo $list['ID'] ?>">
                                    <div class="shop_company_list" id="glist<?php echo $list['ID'] ?>">
                                        <div>
                                            <input type="hidden" id="sub_<?php echo $list['ID'] ?>" name="subTotal" value="<?php echo $subTotal ?>">
                                            <input type="checkbox" name="cart[]" value="<?php echo $list['ID'] ?>" dealer="<?php echo $cart['SellerID'] ?>" class="check<?php echo $cart['SellerID'] ?> float_l " style="margin:35px 10px"></div>
                                        <div class="gwc_img float_l bo">
                                            <a href="<?php echo $goodsurl;?>"> <img src="<?php echo $list['ImageUrl'] ? F::uploadUrl() . $list['ImageUrl'] : F::uploadUrl() . 'common/default-goods.png' ?>"  width="80" height="80"/></a>
                                        </div>
                                        <div class="gwc_spxx float_l width360" >
                                            <div class="name"  >
                                                <a href="<?php echo $goodsurl;?>"  title="<?php echo $list['GoodsName']; ?>"style="color:#555;font-weight: bold;overflow: hidden; white-space: nowrap; text-overflow: ellipsis;display: block;width:120px;float:left"> <?php echo isset($list['GoodsName']) ? $list['GoodsName'] : '' ?></a>
                                                  <?php 
                                                  $issale= BuyGoodsService::issale($list['GoodsID']);
                                                  switch ($issale){
                                                      case 0:
                                                          echo '<span style="color:red;display:block;float:left;width:80px" class="unsale">商品已经下架</span>';
                                                          break;
                                                  }
                                                          
                                                  ?>
                                                <div style="clear: both"></div>
                                            </div>
                                            <p class="m-top5" style='margin-top:3px'>商品编号：<span><?php echo isset($list['GoodsNum']) ? $list['GoodsNum'] : '' ?></span></p> 
                                            <p class="m-top5" style='margin-top:3px'>品牌：<span><?php echo isset($list['Brand']) ? $list['Brand'] : '' ?></span></p>
                                            <p class="m-top5" style='margin-top:3px'>标准名称：<span><?php echo isset($list['CpName']) ? $list['CpName'] : '' ?></span></p>
                                            <?php if($locatecarmodel):?><p class="m-top5" style='margin-top:3px'>定位车型：<span><?php echo $locatecarmodel; ?></span></p><?php endif;?>
                                        </div>
                                        <div class="gwc_price float_l width120" style="padding-left:80px">
                                            <?php if ($list['ProPrice'] && $list['ProPrice'] != $list['Price']): ?>   <!-- 有优惠价且优惠价与参考价不相等时 -->
                                                <div style="height:14px;width:50px"><s>￥<?php echo $list['Price'] ?></s></div>
                                                <div style="width:50px">              <span style="color:#eb7616">￥<?php echo $list['ProPrice']; ?></span></div>
                                            <?php else: ?>
                                                <div style="width:50px"><span style="color:#eb7616">￥<?php echo $list['Price']; ?></span></div>
                                            <?php endif; ?>
                                        </div>
                                        <div class="gwc_shuliang float_l width150" style="padding-left:31px">

                                            <a href="javascript:void(0)"  onclick="decrease_quantity(<?php echo $list['ID'] ?>)"></a>
                                            <input type="input" id="input_item_<?php echo $list['ID'] ?>" class="float_l"  style="height:18px;" value="<?php echo $list['Quantity'] ?>" onkeyup="change_quantity(<?php echo $list['ID'] ?>, this);">
                                            <a href="javascript:void(0)" onClick="add_quantity(<?php echo $list['ID'] ?>)" class="s"></a>

                                        </div>
                                        <div id="total-<?php echo $list['ID'] ?>" class="gwc_xiaoji float_l width120" style="padding-left:30px" price="<?php echo $list['ProPrice'] ? $list['ProPrice'] : $list['Price'] ?>">
                                            <div style="width:50px;color:#eb7616" class="tprice<?php echo $cart['SellerID'] ?>" gid="<?php echo $list['ID'] ?>">￥<span class="tt"style="width:30px;color:#eb7616"><?php echo $subTotal ?></span></div>
                                        </div>
                                        <div class="gwc_caozuo float_l width100  m_left10" style="padding-left:49px"> <a href="javascript:void(0)" onclick="delgoods(<?php echo $list['ID']; ?>)">删除</a></div>
                                    </div>
                                </li>
                            <?php endforeach; ?>             
                        </ul>
                    </div>       

                <?php endforeach; ?>
                <p class="zongjia">合计：<label style="color:#eb7616;font-size:20px">￥</label><span>0.00</span></p>
            </div>

        </div>
        <p align="right" style=" margin-right:20px; margin-bottom:10px">
            <input type="button" class="submit button button2" onclick="goShopping()" value="继续购物" style="cursor:pointer;">
            <input type="button" onclick="checkform()" class="submit m_left20 button button2" value="结算" style="cursor:pointer;"></p>
    </div>
</form>


<script type="text/javascript">
    //减少数量
    function decrease_quantity(rec_id)
    {
        var item = $('#input_item_' + rec_id);
        var orig = Number(item.val());
        if (orig > 1)
        {
            item.val(orig - 1);
            item.keyup();
        }
    }
    //添加数量
    function add_quantity(rec_id)
    {
        var item = $('#input_item_' + rec_id);
        var orig = Number(item.val());
        item.val(orig + 1);
        item.keyup();
    }
    //输入商品数量
    function change_quantity(rec_id, orig)
    {
        var item = $('#input_item_' + rec_id);
        var val = orig.value;
        if (val < 1)
        {
            orig.value = 1;
        }
        if (val > 100)
        {
            alert('最多只能100件');
            orig.value = 100;
        }
        else if (isNaN(val))
        {
            alert('只能输入数字！');
            orig.value = 1;
        }
        orig.value = orig.value.replace(/\D/g, '');
        update_quantity(rec_id, orig.value);
    }
    //修改数量
    function update_quantity(id, quant)
    {
        var url = Yii_baseUrl + '/pap/buyorder/editquan';
        $.get(url, {ID: id, Quantity: quant}, function(data) {
            var price = $('#total-' + id).attr('price');
            quant = parseInt(quant);
            price = parseFloat(price);
            //解决JS浮点问题
            var priceAll = (price * 1000 * quant / 1000).toFixed(2);
            //将修改数量后重新获取的小计价格放入隐藏框，用于验证订单最小交易额
            $("#sub_" + id).val(priceAll);
            $("#total-" + id + ">:first-child").find('span').text(priceAll);
            countAllPrice();
        });

    }
    //合计
    function countAllPrice()
    {
        var priceAll = 0;
        var price = 0;
        $('input[type=checkbox]').each(function() {
            if ($(this).attr("target") == undefined) {
                var id = $(this).attr('dealer');
                if ($(this).attr("checked") != undefined) {
                    price = $(this).parents(".shop_company_list").find("span[class=tt]").text();
                    if(price=='')
                    {
                        price=0;
                    }
                    priceAll = parseFloat(price) * 1000 + priceAll;
                }
            }
        });

        priceAll = (priceAll / 1000).toFixed(2);
        $(".zongjia span").text(priceAll);
    }

    //全选/反选
    $(document).ready(function() {
     
        $('.allcheck').click(function(){
            var target = $(this).attr("target");
            if ($(this).attr("checked") == undefined) {
                $('input[type=checkbox]').attr('checked',false);
                countAllPrice();
            } else {
                $('input[type=checkbox]').attr('checked',true);
                countAllPrice();
            }
        });
        //全部全选
        if($('.allcheck').attr('checked')==undefined)
        {
            $('.allcheck').attr('checked',true);   
            $('input[type=checkbox]').attr('checked',true);
            countAllPrice();
         
        }
        //单个经销商商品全选
        $(".checkAll").click(function() {
            var target = $(this).attr("target");
            if ($(this).attr("checked") == undefined) {
                $(".check" + target).attr("checked", false);
                 allcheck();
            } else {
                $(".check" + target).attr("checked", true);
                allcheck();
            }
            countAllPrice();
        });
        $("input[type=checkbox]").click(function() {
            if ($(this).attr("target") == undefined) {
                countAllPrice();
            }
        });
    });
    $('.gwc_goods_list').find("input[type=checkbox]").click(function(){
        if($(this).attr('checked')==undefined){
              $('.allcheck').attr('checked',false);
        }else{
             $('.allcheck').attr('checked',true);
        }
    });
    function allcheck(){
    $('.gwc_list_info').find('input[type=checkbox]').each(function(){
       if($(this).attr('checked')==undefined){
          $('.allcheck').attr('checked',false);
       }
    });
    }
    //删除
    
    function delgoods(ID){
        var bool=confirm('您确定要删除这件商品?');
        if(bool==true)
        {
            $.getJSON("<?php echo Yii::app()->createUrl("pap/buyorder/delgoods") ?>",{ID:ID},function(data){  
                if($("#glist"+ID).parents(".gwc_goods_list").find(".shop_company_list").length <= 1){ 
                    $("#glist"+ID).parents(".gwc_goods_list").remove();
                    // $("#glist"+ID).parents(".gwc_goods_list").remove();
                }
            
                var shop_goods=$(".gwc_goods_list");  
                if(shop_goods.length<=0){
                    $(".gwc_goods_list").remove();
                    setTimeout("location.reload()",1);
                }
            
                $("#li"+ID).remove();
                countAllPrice();
                getCartCount();
            })
        }
    }
    //结算
    function checkform(){
        var num = 0;
        var result = new Array();
        var result2 = new Array();
        var i = 0;
        $("input[name='cart[]']").each(function(){
            if($(this).attr("checked") != undefined){
                num++;
                var id = $(this).val();
                var dealer = $(this).attr("dealer");
                var subtotal = $(this).parents(".shop_company_list").find("input[name=subTotal]").val();
                result[i] = dealer + "," + id + "," + subtotal;
            }
            i++;
        });
        //点击结算时验证订单最小交易额
        result = $.grep(result, function(n) {return $.trim(n).length > 0;});    //删除数组中的空值
        var keyid = 0;
        $.each(result, function(key,val){
            if(key == 0){
                var resarr = result[key].split(",");
                result2[keyid] = resarr[0] + "," + resarr[2];
                keyid++;
            }
            else{
                var resarr = result[key].split(",");
                var ret = true;
                $.each(result2,function(key1,val1){
                    var resarr1 = val1.split(",");
                    if(resarr[0] == resarr1[0]){
                        var newPrice = parseFloat(resarr[2]) + parseFloat(resarr1[1]);
                        result2[keyid-1] = resarr1[0] + "," + newPrice;
                        ret = false;
                    }
                })
                if(ret){
                    result2[keyid] = resarr[0] + "," + resarr[2];
                    keyid++;
                }
            }
        })
        var list=[];
        var go=0;
        var to=0;
        $.each(result2,function(key1,val1){
            var resarr1 = val1.split(",");
            var organName = $("input[target="+resarr1[0]+"]").parents('.gwc_goods_list').find("span[name=organName]").text();
            var minTurnover = parseFloat($("input[target="+resarr1[0]+"]").parents('.gwc_goods_list').find("input[name=minTurnover]").val()); //获取订单最小交易额
            if(resarr1[1] < minTurnover){
                go++; 
            }
            to++;
        })
//        if(go==0 && to!=0){
//           // $("#goodsform").submit();
//        }
        var min;
        var ss;
        $.each(result2,function(key1,val1){
            var resarr1 = val1.split(",");
             var sarr=new Array();
             var sellenth=$('.sell-'+resarr1[0]).find('ul li').length;
             $('.sell-'+resarr1[0]).find('ul li .unsale').each(function(){
                 //console.log($(this).text());
                 sarr.push($(this).text());
             })
         if(sellenth==sarr.length){
               var organName = $("input[target="+resarr1[0]+"]").parents('.gwc_goods_list').find("span[name=organName]").text();
               var html='';
                html+="<div style='margin-top:10px;line-height:15px;'><p class='warn' style='padding-left:20px;color:red;line-height:14px'>对不起,您购买的"+organName+"的商品已全部下架，将不能生产订单.</p></div>"
                $('#minorder').html(html);
                //$('#mymodal').dialog('open');
                min=1;
                
         }else{
            var organcount=$('.gwc_goods_list').size();
            var organName = $("input[target="+resarr1[0]+"]").parents('.gwc_goods_list').find("span[name=organName]").text()
            var minTurnover = parseFloat($("input[target="+resarr1[0]+"]").parents('.gwc_goods_list').find("input[name=minTurnover]").val()); //获取订单最小交易额
             if(resarr1[1] < minTurnover&& organcount==1){
                 $('.ui-dialog-buttonset button:eq(1)').hide();
             }else{
                 $('.ui-dialog-buttonset button:eq(1)').show();
             }
            if(resarr1[1] < minTurnover){
                var html='';
                html+="<div style='margin-top:10px'><p class='warn' style='color:red;font-size:12px;line-height:14px'>&nbsp;&nbsp;&nbsp;&nbsp;对不起,您购买的"+organName+"商品须超过最小交易金额￥"+minTurnover+"元，才能生成订单！</p></div>"
                $('#minorder').html(html);
                //$('#mymodal').dialog('open');
                min=1;
            }
            }
        });
        if(min==1){
            $('#mymodal').dialog('open');
        }else if(min!=1&&go==0 && to!=0){
            $("#goodsform").submit();
        }
        if(num <= 0){
            alert('请勾选要结算的商品');
        }
    } 
    function goShopping()
    {
        $('input[type=checkbox]').attr('checked',false);
        location.href=Yii_baseUrl+'/pap/home/index';
    }
</script>
<?php
//最小交易额弹框
$this->beginWidget('zii.widgets.jui.CJuiDialog', array(
    'id' => 'mymodal',
    'options' => array(
        'title' => '提示信息',
        'width' => 400,
        'height' => 200,
        'autoOpen' => false,
        'resizable' => false,
        'modal' => true,
        'overlay' => array(
            'backgroundColor' => '#000',
            'opacity' => '0.5'
        ),
        'buttons' => array(
            '继续采购' => 'js:function(){ window.open(Yii_baseUrl + "/pap/home/index","_black");}',
            '立即购买' => 'js:function(){ $("#goodsform").submit();$(this).dialog("close");}',
        ),
    ),
));
echo '<div id="minorder">最小交易额</div> ';
$this->endWidget('zii.widgets.jui.CJuiDialog');
?>     