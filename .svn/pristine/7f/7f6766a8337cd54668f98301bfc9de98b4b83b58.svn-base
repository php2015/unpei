<div class="auto_height">
    <ul class="search-content" style="height:105px;">
        <p style="margin-top:25px">
            <label class="m_left40">OE号：</label>
            <input type="text" class="width148 input" id="oeno" value="" style="margin-bottom:5px"/>
            <span style="display:none" class="width650">
                <label>厂家：</label>
                <select id="oeno-search-make-list" style="margin-bottom:5px;">
                    <option value="0">--请选择厂家类别</option>
                </select>
            </span>
            <b style="padding-left: 20px;">(可输入带*的部分OE号，但至少有3位非*字符)</b>
        </p>
        <p align="center" style="clear:both; margin-top:5px">
            <input class="submit" type="submit" value="查&nbsp;&nbsp;询" id="oeno-search">
        </p>
    </ul>
    <div class="search-result auto_height" style="min-height: 700px;" style="position:relative">
        <div class="result-title auto_height" style=" position: relative;">
            <span class="title ">配件信息</span>
            <?php if (Yii::app()->user->Identity == "servicer"): ?>
                <span class="title" style="float:right; padding-right: 137px; padding-left: 10px; border-left:1px solid #fff; *margin-top:-30px">商品信息</span>
            <?php endif; ?>
            <span class="info-back" style="cursor: pointer; float: right; color:#fff;*margin-top:-30px">返回</span>
        </div>
        <!-- 配件信息 -->
        <!-- 配件信息 -->
        <?php if (Yii::app()->user->Identity == "servicer"): ?>
            <div class="result-content auto_height" style="width:660px; float:left; margin:10px; position: relative;"></div>
        <?php elseif (Yii::app()->user->Identity == "dealer"): ?>
            <div class="result-content auto_height" style="width:860px; float:left; margin:10px"></div>
        <?php endif; ?>
        <div style="clear:both"></div>
    </div>
</div>