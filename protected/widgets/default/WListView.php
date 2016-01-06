<?php

/**
 * TbListView class file.
 * @author Christoffer Niska <christoffer.niska@gmail.com>
 * @copyright Copyright &copy; Christoffer Niska 2013-
 * @license http://www.opensource.org/licenses/bsd-license.php New BSD License
 * @package bootstrap.widgets
 */
Yii::import('zii.widgets.CListView');

/**
 * Bootstrap Zii list view.
 */
class WListView extends CListView {

    /**
     * @var string the CSS class name for the pager container. Defaults to 'pagination'.
     */
    public $pagerCssClass = 'pagination';

    /**
     * @var array the configuration for the pager.
     * Defaults to <code>array('class'=>'ext.bootstrap.widgets.TbPager')</code>.
     */
    public $pager = array('class' => 'widgets.default.WLinkPager');

    /**
     * @var string the URL of the CSS file used by this detail view.
     * Defaults to false, meaning that no CSS will be included.
     */
    public $cssFile = false;
    public $ajaxUpdate = false;

    /**
     * @var string the template to be used to control the layout of various sections in the view.
     */
    public $template = "{items}\n<div class='pager'><div class=\"row-fluid\"><div class=\"spanl\">{pager}</div><div class=\"spanr\">{summary}</div></div></div>";
    public $headerView = "";

    /**
     * Renders the empty message when there is no data.
     */
    public function renderEmptyText() {
        $emptyText = $this->emptyText === null ? Yii::t('zii', 'No results found.') : $this->emptyText;
        echo TbHtml::tag('div', array('class' => 'empty', 'span' => 12), $emptyText);
    }

    function renderItems() {

        echo CHtml::openTag($this->itemsTagName, array('class' => $this->itemsCssClass)) . "\n";
        $data = $this->dataProvider->getData();
        //如果有头页面则展示头页面
        $owner = $this->getOwner();
        $render = $owner instanceof CController ? 'renderPartial' : 'render';
        if ($this->headerView) {
            $owner->$render($this->headerView);
        }
        if (($n = count($data)) > 0) {
            $j = 0;
            foreach ($data as $i => $item) {
                $data = $this->viewData;
                $data['index'] = $i;
                $data['data'] = $item;
                $data['widget'] = $this;
                $owner->$render($this->itemView, $data);
                if ($j++ < $n - 1)
                    echo $this->separator;
            }
        }
        else
            $this->renderEmptyText();
        echo CHtml::closeTag($this->itemsTagName);
    }

}
