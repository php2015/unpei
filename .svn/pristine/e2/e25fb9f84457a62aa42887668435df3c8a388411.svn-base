<?php

class WShortPager extends CLinkPager {

    public $maxButtonCount = 5; //最多显示的页面按钮数量
    public $makeinfo = false;

    public function init() {
        if ($this->nextPageLabel === null)
            $this->nextPageLabel = '下一页';
        if ($this->prevPageLabel === null)
            $this->prevPageLabel = '上一页';
        if (!isset($this->htmlOptions['id']))
            $this->htmlOptions['id'] = $this->getId();
        if (!isset($this->htmlOptions['class']))
            $this->htmlOptions['class'] = 'fenye float_r';
    }

    public function run() {
        $pageVar = $this->getPages()->pageVar;
        $id = $this->getId(); //分页组件 ID
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
        echo CHtml::openTag('div', array('class' => "total float_l"));
        if ($this->makeinfo === true) {
            echo "<span>共<b>$itemCount</b>条数据</span>";
        } else {
            echo "<span>共<b>$itemCount</b>个商品</span>";
        }
        echo CHtml::closeTag('div');
        $buttons = $this->createPageButtons();
        if (!empty($buttons)) {
            //当前页面
            echo CHtml::openTag('div', array("class" => "float_l text"));
            echo "<i>$currentPage</i>/$pageCount";
            echo CHtml::closeTag('div');
            //按钮
            echo CHtml::openTag('div', array("class" => "top_fenye"));
            echo CHtml::tag('ul', array('class' => 'list  float_l'), implode("\n", $buttons));
            echo CHtml::closeTag('div');
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

    protected function createPageButtons() {
        if (($pageCount = $this->getPageCount()) <= 1)
            return array();

        list($beginPage, $endPage) = $this->getPageRange();
        $currentPage = $this->getCurrentPage(false); // currentPage is calculated in getPageRange()
        $buttons = array();


        // prev page
        if (($page = $currentPage - 1) < 0)
            $page = 0;
        $buttons[] = $this->createPageButton($this->prevPageLabel, $page, self::CSS_PREVIOUS_PAGE, $currentPage <= 0, false);


        // next page
        if (($page = $currentPage + 1) >= $pageCount - 1)
            $page = $pageCount - 1;
        $buttons[] = $this->createPageButton($this->nextPageLabel, $page, self::CSS_NEXT_PAGE, $currentPage >= $pageCount - 1, false);

        return $buttons;
    }

}

?>