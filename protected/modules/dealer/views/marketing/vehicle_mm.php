<style>
    <!--
    /*.xx{width:10px;float:right: cursor:pointer; color:red; margin-left:5px;}*/
    -->
    .search-content li
    {
        float:left;
    }
    .auto_height ul li select { width: 110px}
    .checkbox-add{ line-height: 24px;}
</style>
<div class="auto_height">
            <ul class="search-content" >
                <li>
                    <label class='label'>前市场车型</label>:
                    <!--<label>厂家</label>-->
                    <select id="front-vehicle-make-list" class="select">
                        <option value="0">请选择厂家类别</option>
                    </select>
                </li>
                <li>
                    <label>车系</label>
                    <select id="front-vehicle-car-list" class="select">
                        <option value="0">请选择车系名称</option>
                    </select>
                </li>

                <li id="year-content" >
                    <label>年款</label>
                    <select id="front-vehicle-year-list" class="select"> 
                        <option value="0">请选择车型年款</option> 
                    </select> 
                </li>

                <li id="model-content" >
                    <label>车型</label>
                    <select id="front-vehicle-model-list" class="select"> 
                        <option value="0">请选择车型名称</option> 
                    </select> 
                    <span id='addVehcle' class="btn" style="cursor:pointer;">添加</span>
                </li>
            </ul>
        </div>
<script type="text/javascript" src='<?php echo F::themeUrl(); ?>/js/jpdata/vehiclecommon.js'></script>