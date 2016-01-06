<?php
/**
 * TbNavbar class file.
 * @author Christoffer Niska <christoffer.niska@gmail.com>
 * @copyright Copyright &copy; Christoffer Niska 2013-
 * @license http://www.opensource.org/licenses/bsd-license.php New BSD License
 * @package bootstrap.widgets
 */

Yii::import('bootstrap.helpers.TbHtml');

/**
 * Bootstrap navbar widget.
 * @see http://twitter.github.com/bootstrap/components.html#navbar
 */
class TbNavbar extends CWidget
{
    /**
     * @var string the navbar color.
     */
    public $color;
    /**
     * @var string the brand label text.
     */
    public $brandLabel;
    /**
     * @var mixed the brand url.
     */
    public $brandUrl;
    /**
     * @var array the HTML attributes for the brand link.
     */
    public $brandOptions = array();
    /**
     * @var string nanvbar display type.
     */
    public $display = TbHtml::NAVBAR_DISPLAY_FIXEDTOP;
    /**
     * @var boolean whether the navbar spans over the whole page.
     */
    public $fluid = false;
    /**
     * @var boolean whether to enable collapsing of the navbar on narrow screens.
     */
    public $collapse = false;
    /**
     * @var array additional HTML attributes for the collapse widget.
     */
    public $collapseOptions = array();
    /**
     * @var array list of navbar item.
     */
    public $items = array();
    /**
     * @var array the HTML attributes for the navbar.
     */
    public $htmlOptions = array();

    /**
     * Initializes the widget.
     */
    public function init()
    {
        if ($this->brandLabel !== false) {
            if (!isset($this->brandLabel)) {
                $this->brandLabel = CHtml::encode(Yii::app()->name);
            }

            if (!isset($this->brandUrl)) {
                $this->brandUrl = Yii::app()->homeUrl;
            }
        }
        if (isset($this->color)) {
            TbArray::defaultValue('color', $this->color, $this->htmlOptions);
        }
        if (isset($this->display) && $this->display !== TbHtml::NAVBAR_DISPLAY_NONE) {
            TbArray::defaultValue('display', $this->display, $this->htmlOptions);
        }
    }
    /**
     * 获取菜单
     */
    public function Menudata(){
        $menu = Yii::app()->jpdb->createCommand()
                ->select('id,root,lft,rgt,level,name,url,if_show,extra_url')
                ->from('jpd_admin_menu')
                ->where('root=2 and if_show=1 and level>1')
                ->queryAll();
        $i=0;
        $menus[0]['class']='bootstrap.widgets.TbNav';
        foreach ($menu as $key1=>$val1){
            if($val1['level']==2){
                $menus[0]['items'][$i]['label']=$val1['name'];
                if(empty($val1['url'])){
                    $menus[0]['items'][$i]['url'] = '#';
                }else{
                    $menus[0]['items'][$i]['url'] = array('/'.$val1['url']);
                }
                $j=0;
                foreach ($menu as $key2=>$val2){
                    if($val2['lft']>$val1['lft'] && $val2['rgt']<$val1['rgt'] && $val2['level']==3){
                        $menus[0]['items'][$i]['items'][$j]['label']=$val2['name'];
                        if($val2['id']!=221){
                            $menus[0]['items'][$i]['items'][$j]['url'] = array('/'.$val2['url']);
                        }
                        $j++;
                    }
                }
                $menus[0]['items'][$i]['visible']=1;
                $i++;
            }
        }
        return $menus;
    }

    /**
     * Runs the widget.
     */
    public function run()
    {
        $brand = $this->brandLabel !== false
            ? TbHtml::navbarBrandLink($this->brandLabel, $this->brandUrl, $this->brandOptions)
            : '';
        ob_start();
        if(!Yii::app()->user->isGuest){
                $menus = $this->Menudata();
        }else{
            $menus[0]=array();
        }
        $menus[1]=array(
            'class' => 'bootstrap.widgets.TbNav',
            'htmlOptions' => array('class' => 'pull-right'),
            'items' => array(
                array('label' => '网站前台', 'url' => Yii::app()->request->hostInfo . Yii::app()->baseUrl),
                array('label' => '站点配置', 'url' => array('/settings/index'), 'visible' => !Yii::app()->user->isGuest),
                array('label' => '登录', 'url' => array('/site/login'), 'visible' => Yii::app()->user->isGuest),
                array('label' => Yii::app()->user->name, 'url' => '#', 'items' => array(
                    array('label' => '个人资料', 'icon' => 'user', 'url' => '#'),
                    array('label' => '退出', 'icon' => 'off', 'url' => array('/site/logout'))
                ), 'visible' => !Yii::app()->user->isGuest),
            ),
        );
        $this->items=$menus;
        foreach ($this->items as $item) {
            if (is_string($item)) {
                echo $item;
            } else {
                $widgetClassName = TbArray::popValue('class', $item);
                if ($widgetClassName !== null) {
                    $this->controller->widget($widgetClassName, $item);
                }
            }
        }
        $items = ob_get_clean();
        ob_start();
        if ($this->collapse !== false) {
            TbHtml::addCssClass('nav-collapse', $this->collapseOptions);
            ob_start();
            /* @var TbCollapse $collapseWidget */
            $collapseWidget = $this->controller->widget(
                'bootstrap.widgets.TbCollapse',
                array(
                    'toggle' => false, // navbars are collapsed by default
                    'content' => $items,
                    'htmlOptions' => $this->collapseOptions,
                )
            );
            $collapseContent = ob_get_clean();
            echo TbHtml::navbarCollapseLink('#' . $collapseWidget->getId());
            echo $brand . $collapseContent;

        } else {
            echo $brand . $items;
        }
        $containerContent = ob_get_clean();
        $containerOptions = TbArray::popValue('containerOptions', $this->htmlOptions, array());
        TbHtml::addCssClass($this->fluid ? 'container-fluid' : 'container', $containerOptions);
        ob_start();
        echo TbHtml::openTag('div', $containerOptions);
        echo $containerContent;
        echo '</div>';
        $content = ob_get_clean();
        echo TbHtml::navbar($content, $this->htmlOptions);
    }
}