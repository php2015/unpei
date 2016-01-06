<?php

class WLinkPager extends CLinkPager {

    public $maxButtonCount = 5; //最多显示的页面按钮数量

    public function init() {
        if ($this->nextPageLabel === null)
            $this->nextPageLabel = '下一页';
        if ($this->prevPageLabel === null)
            $this->prevPageLabel = '上一页';
        if ($this->firstPageLabel === null)
            $this->firstPageLabel = '首页';
        if ($this->lastPageLabel === null)
            $this->lastPageLabel = '末页';

        if (!isset($this->htmlOptions['id']))
            $this->htmlOptions['id'] = $this->getId();
        if (!isset($this->htmlOptions['class']))
            $this->htmlOptions['class'] = 'pagination auto_height';
    }

    public function run() {
        $pageVar = $this->getPages()->pageVar;
        $id = $this->getId(); //分页组件 ID
        $firstpageUrl = $this->createPageUrl(0); //首页链接
        $itemCount = $this->getItemCount(); // 总数量
        $pageCount = $this->getPageCount(); // 总页数
        $currentPage = $this->getCurrentPage(false) + 1; //当前页数
        // 无数据时不显示
        if ($itemCount <= 0) {
            return;
        }
        // 显示分页信息
        echo $this->header;
        echo CHtml::openTag('div', $this->htmlOptions);
        $buttons = $this->createPageButtons();
        if (!empty($buttons)) {
            echo CHtml::tag('ul', array('class' => 'list  float_l'), implode("\n", $buttons));
            echo CHtml::openTag('span', array("class" => 'goto  float_l'));
            echo "
			共&nbsp;" . $pageCount . "&nbsp;页&nbsp;&nbsp; 
			去第
			<input id='" . $id . "-thepage' class='input' value='' type='text'  style=' *height:20px; *line-height:20px'/>
			页
			<a id='" . $id . "-gopage' class='btn-tiny' style='cursor:pointer; *height:22px; *line-height:21px'>GO</a>
			";
            echo CHtml::closeTag('span');
            Yii::app()->getClientScript()->registerScript("gotopage", "
				// 跳转到第几页
                                $(document).on('click','#" . $id . "-gopage',function(){
				//$('#" . $id . "-gopage').click(function(){
					var page = $('#" . $id . "-thepage').val();
					var pageCount = $pageCount;
					var currentPage = $currentPage;
					if(isNaN(page) || page > pageCount || page <= 0 || page == currentPage)
					{
						$('#" . $id . "-thepage').val('');
					}else{
						var url = '" . $firstpageUrl . "/$pageVar/' + page;
						location.href = url;
					}
				});
			");
        } else {
            /**
              //没有则不显示
              echo "<span class='total_count'>";
              echo "共&nbsp;".$itemCount."&nbsp;条";
              echo "</span>";
             * */
        }
        echo CHtml::closeTag('div');
        echo $this->footer;
    }

}

?>