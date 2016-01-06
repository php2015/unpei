<style>
    .ycbf{
        height: 210px
    }
    .left-side {

        width: 483px;
    }

    .right-side {
        width: 498px;
    }

    .left2-side{

        width: 353px;
    }
    .right2-side {
        width: 620px;

    }
    .right2-side p{
        margin: 20px 0;
    }
    .select_top{  padding-top: 22px}
    .select_top select{
        line-height: 30px;
        /*margin-bottom: 12px;*/
        margin-right: 8px;

    }

    .select_bottom select{
        line-height: 30px;
        margin-bottom: 12px;
        margin-right: 8px;

    }
    .addcss{margin-left: 65px; width: 200px;}

    .addcss2{margin-left: 65px;}
    .w220{
        width:220px;float:left;margin-right: 6px;
    }
    .w220{
        width:220px;float:left;margin-right: 6px;
    }
    .w240{
        width:240px;float:left;margin-right: 6px;
    }
    .w248{
        width:248px;float:left;
    }
    .w252{
        width:252px;float:left;
    }
    .w260{
        width:260px;float:left;margin-right: 6px;
    }
    .w266{
        width:266px;float:left;
    }
    .w235{
        width:235px;float:left;margin-right: 6px;
    }
    .w238{
        width:238px;float:left;
    }
    .h179{height:133px}
    .h180{height:130px}

    .mybacklog {
        background: none repeat scroll 0 0 #FFFDEE;
        border: 1px solid #EBB48B;
        line-height: 30px;
        margin-bottom: 10px;
        color:#46463C;
        /*        margin-top: -10px;*/
    }
    .th_organ{width: 100px; background-color: white}
    .th_organ img{ display: block;float: left;width:60px;height:50px;padding-left: 42px}
    .th_organ_text{ background-color: white;}

    .spanli{color:#E27D2D; margin-right:20px;}
    .spanli:hover{text-decoration: underline;cursor:pointer}
    .fontcolor{color:red}
    .fontcolor a{color:red}
    .button_10 {
        margin-bottom: 17px;margin-left: 5px;
    }
    .homepadding{
        padding-left: 10px;
    }
</style>
<div id="layout-t4" class="tab-product tab-sub-3 ui-style-gradient" >
    <h2 class="tab-hd"> 
        <span class="tab-hd-con current"  style="margin-left:30px;border-right: 1px solid #e2e2e2" key="inquiry"><a href="javascript:;">商品查询</a></span>
    </h2>
    <div class="tab-bd dom-display  dom-display8">
        <div class="tab-bd-con inquiry" style="display:block;"> 
            <form  id="goodssearchform"  action="<?php //echo Yii::app()->createUrl('/pap/mall/search')                  ?>"   medthod="get">
                <p class="button_10">
                    <label class='label1' style=" margin-left: 4px\9">适用车系：</label>
                    <input id="make-select-index" class="input" readonly="readonly"  type="text" value="请选择适用车系"style="width:230px"><br> 
                </p> 
                <p class="button_10">
                    <label class='label1 m_left12' style=" margin-left: 15px\9">关键字：</label>
                    <input class="input" name="keyword" type="text" value="名称|编号|拼音代码|配件品类|OE号|品牌"  style="width:230px">
                </p>
                <div style="text-align:center;margin-top: 20px">
                    <input class="submit" type='button' id="goodssearch"  value='进入商城'/>
                </div>
                <?php $this->widget('widgets.default.WGoodsCarModel'); ?>
            </form>
        </div>
    </div>
</div>
<script type="text/javascript">

    $('#tablist ul li a').click(function(){
        $('#tablist ul li a').removeClass('active');
        $(this).addClass('active');
    })
    $("input[name=keyword]").click(function(){
        if($(this).val()=='名称|编号|拼音代码|配件品类|OE号|品牌'){
            $(this).val("");
        }
    })
    $("input[name=keyword]").blur(function(){
        if($(this).val()==''){
            $(this).val('名称|编号|拼音代码|配件品类|OE号|品牌');
        } 
    })
    $('#goodssearch').click(function(){
        if($('input[name=keyword]').val()=='名称|编号|拼音代码|配件品类|OE号|品牌' && $('#make-select-index').val()=='请选择适用车系'){
               alert('请输入查询条件');
            return false;
        }
        
        if($('input[name=keyword]').val()=='名称|编号|拼音代码|配件品类|OE号|品牌' ){
            alert('请输入关键字');
            return false;
        }
        if($('#make-select-index').val()=='请选择适用车系' ){
            alert('请输入车系');
            return false;
        }
       
        
        if($('input[name=keyword]').val()!='名称|编号|拼音代码|配件品类|OE号|品牌')
            var keyword=encodeURIComponent($('input[name=keyword]').val());
        saveVechile(keyword);
    });
    
    function saveVechile(keyword) { 
        var url='';
        if(keyword){
            url+='/keyword/'+keyword; 
        }
        if($.trim($("#make-select-index").val()) && $.trim($("#make-select-index").val())!='请选择适用车系'){
            $.ajax({
                url: Yii_baseUrl + '/pap/mall/setcarmodel',
                type: 'POST',
                data: {
                    make: $('#jpmall_make').val(),
                    series: $('#jpmall_series').val(),
                    year: $('#jpmall_year').val(),
                    model: $('#jpmall_model').val()
                },
                dataType: 'json',
                success: function() {
                    location.href=Yii_baseUrl+'/pap/mall/search'+url;
                    //$('#goodssearchform').submit();
                }
            });
        }else{
            //            location.href=Yii_baseUrl+'/pap/mall/search'+url;
            //$('#goodssearchform').submit();
            alert('适用车系是必选项！请选择适用车系');
        }
    }
</script>
<!--<script type="text/javascript" src='<?php echo F::themeUrl(); ?>/js/jpdata/dealerparts.js'></script>
<script type="text/javascript" src='<?php echo F::themeUrl(); ?>/js/jpdata/vehicle.js'></script>
<script type="text/javascript" src='<?php echo F::themeUrl(); ?>/js/jpdata/servicer.js'></script>-->