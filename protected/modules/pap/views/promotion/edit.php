<div id="formedit">
    <form>
        <p class="zwq_name m-top5"><?php echo $data->Name; ?></p>
        <p class="m-top5">商品编号：<?php echo $data->GoodsNO ?></p>
        <p class="m-top5">品牌：<?php echo $data->brand->BrandName ?></p>
        <p class="m-top5">标准名称：<span>燃油滤清器</span></p>
        <p class="m-top5">拼音代码：<span><?php echo $data->Pinyin; ?></span></p>
        <p class="m-top5">备注：<span><?php echo $data->Memo ?></span></p>
        <p class="m-top5"> 参考价：<span><?php echo $data->Price; ?></span> 
        <p>促销价:<input id="editpro" type="text" name="ProPrice"/></p>
    </form>
</div>