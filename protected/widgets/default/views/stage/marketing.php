<style>
    .dom-display4 {
        padding: 0;
    }
    .dom-display {
        padding: 0;
    }
    .width125{
        width: 125px;
    }
</style>
<div id="layout-t4" class="tab-product tab-sub-3 ui-style-gradient" >
    <h2 class="tab-hd"> 
        <span class="tab-hd-con current"  style="margin-left:30px;border-right: 1px solid #e2e2e2"  key="promotionkey"><a href="javascript:;">促销商品管理</a></span>
        <!--<span class="tab-hd-con bor_right"><a href="javascript:;">业务联系人管理</a></span>--> 
    </h2>
    <div class="tab-bd dom-display dom-display8">
        <div class="tab-bd-con promotionkey" style="display:block"> 
            <div class="column ">
                <?php
                $organID = Yii::app()->user->getOrganID();
                $progoods = PapGoods::model()->count(array("condition" => "IsPro = 1 and IsSale = 1 and ISdelete = 1 and t.OrganID = " . $organID));
                ?>
                <p class="txxx">促销中的商品(共<font style="color:#FB540E;font-size:14px;font-weight: bolder;padding:0 3px"><?php echo $progoods ?></font>件商品)&nbsp;&nbsp;
                    您还可以添加<font style="color:#FB540E;font-size:14px;font-weight:bolder;padding: 0 3px"><?php echo 50 - $progoods ?></font>件促销商品
                </p>
                <p  style="margin-top:15px; margin-left: 40px;">
                    <input type="submit" onclick="addPromo()" value="添加促销"  class="submit" />
                    <input type="submit" onclick="delPromo()" value="编辑促销"  class="submit" />
                </p>  
            </div>
        </div>
        <!--        <div class="tab-bd-con"> 
                    <div class="special">
                        <form>    
                            <p><label class="label1">客户姓名：</label><input type="text" class="input"></p>
        
                            <p><label class="label1">联系电话：</label><input type="text" class="input">
                            </p>  
                            <p><label class="label1" style="margin-left:12px">关键词：</label><input type="text" class="input"/></p>
                            <p><label class="label1 m_left24">群主：</label><select class="select">
                                    <option value ="主组">主组</option>
                                    <option value ="支架">1</option>
                                    <option value ="框架">2</option><option value ="螺栓">4</option>
                                    <option value ="螺栓">3</option>
                                </select></p>
                            <p><input type="submit" value="查   询"  class="submit m_left65"></p>
                        </form>
                    </div>
                </div>-->

    </div>
</div>
<script>
    //品类查询
    $("#p-leafcate .li_list").live('click',function(){
        var code = $(this).attr('code');
        $('#code_value').val(code); 

    });


    // 点击输入框弹出div层
    $("#cpname-search").click(function(e){
        cpname_search = true;
        e.stopPropagation();
        cpnametxt ='';
        $("#cpname-search").val(cpnametxt);
        var offset = $(this).offset();
        var left, top,url,data;
        $("#selectBig").css({ 'left':left, 'top':top }).show();
        $("#ul-bigcate li:first").click();
        $("#make-car-m").hide();
    });
    
    //搜索
    $("#search-btn").click(function(){
        var url = Yii_baseUrl+"/pap/dealergoods/index";
        var GoodsNO=$('input[name=GoodsNO]').val();
        if(GoodsNO){
            url +="/GoodsNO/"+GoodsNO;
        }
        var Name=$('input[name=Name]').val();
        if(Name){
            url +="/Name/"+Name;
        }
        var OE=$('input[name=OE]').val();
        if(OE){
            url +="/OE/"+OE;
        }
        var StandCode=$('input[name=StandCode]').val();
        if(StandCode){
            url +="/StandCode/"+StandCode;
        }
        var Vehicle=$('input[name=Vehicle]').val();
        if(Vehicle){
            url +="/Vehicle/"+Vehicle;
        }
        $("#search_form").attr("action",url);
        $('#search_form').submit();
    });
    
    function addPromo(){
        var url = Yii_baseUrl+'/pap/promotion/addpromotion';
        window.location.href=url; 
    }
    function delPromo(){
        var url = Yii_baseUrl+'/pap/promotion';
        window.location.href=url;
    }
    // 点击每一项 选中 cpname
    $("#p-leafcate .li_list").live('click',function(){
        $("#selectBig").hide();
    });
</script>