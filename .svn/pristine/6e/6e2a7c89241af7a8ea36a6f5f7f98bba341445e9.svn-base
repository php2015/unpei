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
        <span class="tab-hd-con current" style="margin-left:30px;border-right: 1px solid #e2e2e2"" key="spglkey"><a href="javascript:;">商品管理</a></span>
        <!--<span class="tab-hd-con bor_right"><a href="javascript:;">业务联系人管理</a></span>--> 
    </h2>
    <div class="tab-bd dom-display dom-display8">
        <div class="tab-bd-con spglkey" style="display:block"> 
            <form method="GET"  id="search_form">
                <p><label class="label1">商品编号：</label><input type="text" class="input  width125" name="GoodsNO">

                    <label class="label1 m_left">商品名称：</label><input type="text" class="input  width125" name="Name">
                </p>  
                <p><label class="label1" style="margin-left:24px;margin-left:20px\9;*margin-left:20px">OE号：</label><input type="text" class="input width125 " name="OE">
                    <label class="label1 m_left">配件品类：</label><input type="text" class="input width125 " id="cpname-select-index"><input type="hidden" id="code_value" name="StandCode">
                </p>
                <p>
                    <label>适用车系：</label><input id="make-select"  name="Vehicle" class="input" type="text"style="width:300px">
                </p>
                <?php $this->widget('widgets.default.WGoodsCarModel'); ?>
                <?php $this->widget('widgets.default.WGoodsCategoryModel'); ?>
                <p align="center"><input type="submit" id="dsearch-btn" value="查   询"  class="submit" /></p>
            </form>
        </div>
        <div class="tab-bd-con promotionkey" > 
            <div class="column ">
                <form>    
                    <p><label class="label1">选择商品：</label><input type="text" class="input  width200"></p>
                    <p  style="margin-top:15px; margin-left:80px">
                        <input type="button" onclick="addPromo()"  value="添加促销商品"/>
                        <!--<a class="m_left20" style="cursor:pointer; color:#444"><img src="<?php echo Yii::app()->theme->baseUrl ?>/images/jpd/quxiaotubiao.png" style="vertical-align:middle; margin-top:-2px">取消促销</a>-->
                        <input type="button" onclick="delPromo()"  value="编辑促销商品"/>
                    </p>  
                </form>
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
    $("#dsearch-btn").click(function(){
        var url = Yii_baseUrl+"/pap/dealergoods/index";
        var GoodsNO=$('input[name=GoodsNO]').val();
        if(GoodsNO){
            GoodsNO=GoodsNO.replace(/\//g,"<<q>>");
            GoodsNO = encodeURIComponent(GoodsNO);
            url +="/GoodsNO/"+GoodsNO;  
        }
        var Name=$('input[name=Name]').val();
        if(Name){
            Name=Name.replace(/\//g,"<<q>>");
            Name = encodeURIComponent(Name);
            url +="/Name/"+Name;
        }
        var OE=$('input[name=OE]').val();
        if(OE){
            OE=OE.replace(/\//g,"<<q>>");
            OE = encodeURIComponent(OE);
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
        if(!GoodsNO && !Name && !OE && !StandCode && !Vehicle){
            alert('请填写查询条件')
            return false;
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