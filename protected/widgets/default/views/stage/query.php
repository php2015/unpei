<style>
    .area-sub {
        clear: both;
    }

    .cx {
        height: 53px;
    }
    .pager{
        display: none;
    }
    .indexmore{
        padding-left: 400px;
        padding-top: 5px; 
        display: block;
        color: #0065bf;
    }
</style>
<div class="area-sub">
    <div class="tab-product tab-sub-3 ui-style-gradient" id="layout-t6">
        <h2 class="tab-hd"> 
            <span style="margin-left:30px" class="tab-hd-con current"  key="makesearch"><a href="javascript:;">配件查询</a></span> 
            <span class="tab-hd-con " key="oesearch"><a href="javascript:;">OE号查询</a></span>
            <span class="tab-hd-con "  style="border-right: 1px solid #e2e2e2"  key="vehiclesearch"><a href="javascript:;">前市场车型查询</a></span>
        </h2>
        <div class="tab-bd dom-display dom-display8">
            <div class="tab-bd-con makesearch current"> 
                <p><label class="label1">厂家：</label>
                    <select class="select" id="vehicle-make-list">
                        <option value="">--请选择厂家类别</option>
                    </select>
                    <label class="label1">车系：</label>
                    <select class="select" id="vehicle-series-list">
                        <option value="">--请选择车系名称</option>
                    </select>
                </p>
                <p>
                    <label class="label1">年款：</label>
                    <select class="select" id="vehicle-year-list">
                        <option value="">--请选择车型年款</option>
                    </select>
                    <label class="label1">车型：</label>
                    <select class="select" id="vehicle-model-list">
                        <option value="">--请选择车型名称</option>
                    </select>
                </p>
                <p>
                    <label class="label1">主组：</label>
                    <select class="select" id="vehicle-maingroup">
                        <option value="">--请选择主组</option>
                    </select>
                    <label class="label1">子组：</label>
                    <select class="select" id="vehicle-group">
                        <option value="">--请选择子组</option>
                    </select>
                </p>   
                <p align="center"><input type="submit" value="查   询"  class="submit" id="part-search"></p>
            </div>
            <div class="tab-bd-con oesearch" style="display: none;"> 
                <p><label class="label1">OE号：</label>
                    <input type="text" id="oeno" class="input width250">
                <p style="margin-top:20px; margin-left:45px">  
                    (可输入带*的部分OE号，但至少3位非*字符)
                </p> 
                <p style="display:none;margin-top:20px" class="width650" >
                    <label>厂家：</label>
                    <select id="oeno-search-make-list" class="width150 select">
                        <option value="0">--请选择厂家类别</option>
                    </select>
                </p>

                <p align="center" style="margin-top:30px"><input type="submit" value="查   询"  class="submit"  id="oe-search"></p>
            </div>
            <div class="tab-bd-con vehiclesearch" style="display: none;"> 
                <p>
                    <label>厂家：</label>
                    <select id="front-vehicle-make-list" 　 class="width140 select" style="width:130px">
                        <option value="">--请选择厂家类别</option>
                    </select>
                    <label>车系：</label>
                    <select id="front-vehicle-series-list" 　 class="width140 select"  style="width:130px">
                        <option value="">--请选择车系名称</option>
                    </select>
                </p>
                <p>
                    <label >年款：</label>
                    <select id="front-vehicle-year-list" 　 class="width140 select"  style="width:130px"> 
                        <option value="">--请选择车型年款</option> 
                    </select> 
                    <label >车型：</label>
                    <select id="front-vehicle-model-list" 　 class="width140 select"  style="width:130px"> 
                        <option value="">--请选择车型名称</option> 
                    </select> 
                </p>
                <p style="padding-left:132px">
                    <input type="submit" value="查 询" id="front-search" class="submit">
                </p>  
            </div>
        </div>

    </div>
</div>
<script type="text/javascript" src='<?php echo F::themeUrl(); ?>/js/jpdata/vehicle.js'></script>
<!--<script type="text/javascript" src='<?php echo F::themeUrl(); ?>/js/jpdata/dealerparts.js'></script>-->
<script type="text/javascript" src='<?php echo F::themeUrl(); ?>/js/jpdata/parts.js'></script>
<script>
    $(document).ready(function(){
        //前市场查询
        $('#front-search').click(function(){
            if(!$('#front-vehicle-make-list').val() && !$('#front-vehicle-series-list').val()  && !$('#front-vehicle-year-list').val() && !$('#front-vehicle-model-list').val()){
                alert('请填写查询条件')
                return false;
            }
        });
        
        //前市场车型查询
        $("#front-search").click(function(){
            var makeval = $('#front-vehicle-make-list').val();
            var seriesval = $('#front-vehicle-series-list').val();
            var yearval = $('#front-vehicle-year-list').val();
            var modelval = $('#front-vehicle-model-list').val();
            if(!modelval){
                return false;
            }
            var url = Yii_baseUrl + "/jpdata/vehicle/frontModelInfo";
            $.ajax({
                url: url,
                type: "POST",
                data: {
                    'modelId': modelval
                },
                dataType: "html",
                success:function(html){
                    var front_hash = global_vehicle.hashPrefix + makeval + "-" + seriesval + "-" + yearval + "-" + modelval;
                    window.location.href=Yii_baseUrl+'/jpdata/vehicle/index'+front_hash;
                }
            });
            return false;
        });
        
        
        //配件查询
        $('#part-search').click(function(){
            var makeId = $('#vehicle-make-list').val();
            var seriesId = $('#vehicle-series-list').val();
            var yearId = $('#vehicle-year-list').val();
            var modelId=$('#vehicle-model-list').val();
            var mainGroupId = $('#vehicle-maingroup').val();
            var groupId = $('#vehicle-group').val();
            if(!makeId || !modelId || !groupId || !mainGroupId){
                alert('请输入查询条件')
                return false;
            }
            var url = Yii_jpdata_baseUrl + "/parts/groupInfo";
            $.ajax({
                url: url,
                type: "POST",
                data: {
                    'modelId': modelId,
                    'groupId': groupId
                },
                dataType: "html",
                success:function(html){ 
                    window.location.hash = global_parts.hashPrefix + makeId + "-" + seriesId + "-" + yearId + "-" 
                        + modelId + "-" + mainGroupId + "-" + groupId+'-fromshouye';
                    location.href=Yii_baseUrl+'/jpdata/parts/index'+window.location.hash;
                }
            });
		
        });   
        
        
        
        
        
        //OE号查询
        $('#oe-search').click(function(){
            var oeno = $.trim($('#oeno').val());
            var makeId = "";
            if(oeno == ''){
                alert('请输入查询条件');
                return false;
            }
            //如果oe号中带有*，则为部分匹配，需要选择厂商
            if(oeno.indexOf('*') >= 0){
                $('#oeno-search-make-list').parent().show();
                if(oeno.replace(/\*/g,'').length < 3){
                    $('#oeno').nextAll('span').find('b').css('color','red');
                    return false;
                }
                makeId = $('#oeno-search-make-list').val();
                if(!makeId){
                    return false;	
                }
            }else{
                $('#oeno-search-make-list').find("option[value='']").attr("selected","true");
                $('#oeno-search-make-list').parent().hide();
                if(oeno.length < 3){
                    $('#oeno').nextAll('span').find('b').css('color','red');
                    return false;
                }
            }
            var url = Yii_jpdata_baseUrl + "/parts/searchPartsByOeno";
            $.ajax({
                url: url,
                type: "POST",
                data: {
                    'oeno': oeno,
                    'make': makeId
                },
                dataType: "html",
                success:function(html){
                    var locationHash = global_oe.hashPrefix + oeno;
                    if(makeId && makeId != '0') {
                        locationHash += "__" + makeId;
                    }
                    window.location.hash = locationHash;
                    location.href=Yii_baseUrl+'/jpdata/parts/index'+window.location.hash;
                }
            });
            return false;
        });
    })
</script>