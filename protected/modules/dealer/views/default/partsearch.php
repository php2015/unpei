<div class="auto_height">
    <ul class="search-content" style="height:140px;">
        <li>
            <label>选择车型：</label>
        </li>
  　　　　<li style="height:30px;">
            <select id="vehicle-make-list" class="width114 select">
                <option value="0">厂家</option>
            </select>
            <select id="vehicle-series-list" class="width114 select">
                <option value="0">车系</option>
            </select>
        </li>
        <li style="height:30px;">
            <select id="vehicle-year-list" class="width114 select">
                <option value="0">年款</option>
            </select>
            <select id="vehicle-model-list" class="width114 select">
                <option value="0">车型</option>
            </select>
        </li>
        <li style="height:30px;">
            <select id="vehicle-maingroup" class="width114 select">
                <option value="">主组</option>
            </select>
            <select id="vehicle-group" class="width114 select">
                <option value="">子组</option>
            </select>
        </li>

        <li class="query-btn" style="margin-left:74px; margin-top:10px">
            <input class="btn-green" type="submit" value="查&nbsp;&nbsp;询" id="partname-search" />
        </li>
    </ul>
</div>
<script type="text/javascript" src='<?php echo F::themeUrl(); ?>/js/jpdata/dealerparts.js'></script>
<script>
    $('#partname-search').click(function(){
        var makeId = $('#vehicle-make-list').val();
        var seriesId = $('#vehicle-series-list').val();
        var yearId = $('#vehicle-year-list').val();
        var modelId=$('#vehicle-model-list').val();
        var mainGroupId = $('#vehicle-maingroup').val();
        var groupId = $('#vehicle-group').val();
        if(!makeId || !modelId || !groupId || !mainGroupId){
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
</script>