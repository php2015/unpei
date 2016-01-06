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
    .dom-display {
        padding: 0px;
    }
</style>

<!--<div class="area-sub">-->
<div id="layout-t4" class="tab-product tab-sub-3 ui-style-gradient" >
    <h2 class="tab-hd"> 
        <span class="tab-hd-con current" style="margin-left:30px" key="group"><a href="javascript:;">配件查询</a></span> 
        <span class="tab-hd-con " key="vehicle"><a href="javascript:;">前市场车型查询</a></span> 
        <span class="tab-hd-con" style="border-right: 1px solid #e2e2e2" key="tenance"><a href="javascript:;">养护周期查询</a></span> 
    </h2>
    <div class="tab-bd dom-display dom-display8">
        <div class="tab-bd-con group current"> 
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
            <p align="center"><input type="submit" value="查   询"  class="submit" id="partnames-search"></p>
        </div>
        <div class="tab-bd-con vehicle" style="display: none;"> 
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
                <input type="submit" value="查 询" id="front-vehicles-search" class="submit">
            </p>   
            <!--<p align="center"><input type="submit" value="查   询"  class="submit" id="partnames-search"></p>-->
        </div>
        <div class="tab-bd-con tenance" style="display: none;"> 
            <p>
                <label>选择车系：</label>
                <select id="front-vehicle-makes-list"  class="width150 select">
                    <option value="0">厂家</option>
                </select>
                <select id="front-vehicle-car-list"  class="width150 select">
                    <option value="0">车系</option>
                </select>
            </p>
            <p>
                <label style="padding-left:12px">发动机：</label>
                <select id="front-vehicle-engine-list"  class="width150 select"> 
                    <option value="0">发动机</option> 
                </select> 
            </p>
            <p style="padding-left:132px">
                <input type="submit" value="查 询" id="front-vehicle-maintenance-search" class="submit">
            </p>
        </div>
    </div>

</div>
<!--</div>-->
<!--<script type="text/javascript" src='<?php echo F::themeUrl(); ?>/js/jpdata/dealerparts.js'></script>-->
<script type="text/javascript" src='<?php echo F::themeUrl(); ?>/js/jpdata/parts.js'></script>
<script type="text/javascript" src='<?php echo F::themeUrl(); ?>/js/jpdata/vehicle.js'></script>
<script type="text/javascript" src='<?php echo F::themeUrl(); ?>/js/jpdata/servicer.js'></script>
<script>
    $(document).ready(function(){
        //配件查询
        $('#partnames-search').click(function(){
            if(!$('#vehicle-make-list').val()){
                alert('请填写查询条件')
                return false;
            }
        });
        //前市场查询
        $('#front-vehicles-search').click(function(){
            if(!$('#front-vehicle-make-list').val() ){
                alert('请填写查询条件')
                return false;
            }
        });
        //养护周期查询
        $('#front-vehicle-maintenance-search').click(function(){
            if($('#front-vehicle-makes-list').val()==0){
                alert('请填写查询条件')
                return false;
            }
        });
        
        
        
        

    })
</script>