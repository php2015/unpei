<div>
    <ul class="search-content">
        <p class="width600 m-top">
            <label>配件名称：  </label>
            <input type="text" class="width248 input" id="partname" value="" />
            <b>(至少2个汉字)</b>
        </p>
        <p class="m-top">
            <label class="m_left24" style="margin-right:5px;">厂家：</label>
            <select id="search-make-list" class="select" >
                <option value="0">--请选择厂家类别</option>
            </select>

            <label class="m_left">车系：</label>
            <select id="search-series-list" class="select">
                <option value="0">--请选择车系名称</option>
            </select>
            <label class="m_left">年款：</label>
            <select id="search-year-list" class="select">
                <option value="0">--请选择车型年款</option>
            </select>

            <label class="m_left">车型：</label>
            <select id="search-model-list" class="select">
                <option value="0">--请选择车型名称</option>
            </select>
        </p>
        <p class="m-top" align="center">
            <input class="submit" type="submit" value="查&nbsp;&nbsp;询" id="partname-search">
        </p>
    </ul>


    <div class="search-result auto_height " style="min-height: 700px;">
        <div class="result-title auto_height" style=" position: relative;">
            <span class="title ">配件信息</span>
            <?php if (Yii::app()->user->Identity == "servicer"): ?>
                <span class="title" style="float:right; padding-right: 137px; padding-left: 10px; border-left:1px solid #fff" >商品信息</span>
            <?php endif; ?>
            <span class="info-back" style="cursor: pointer; float: right;color:#fff">返回</span>
        </div>
        <!-- 配件信息 -->
        <?php if (Yii::app()->user->Identity == "servicer"): ?>
            <div class="result-content auto_height"  style="width:660px; float:left; margin:10px"></div>
        <?php elseif (Yii::app()->user->Identity == "dealer"): ?>
            <div class="result-content auto_height"  style="width:860px; float:left; margin:10px"></div>
        <?php endif; ?>
        <!-- 正在加载 -->
        <div class="result-loading auto_height"  style="width:550px; float:left">
            <span class="loading-text">数据加载中,请等待...</span>
        </div>
        <div style="clear:both"></div>
    </div>
</div>