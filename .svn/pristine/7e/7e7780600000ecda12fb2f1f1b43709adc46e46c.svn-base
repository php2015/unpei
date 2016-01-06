<?php 
class MenuBehavior extends CBehavior
{
	public $is_init = false;
	public $mainMenu = array();
	public $sidebarMenu = array();
	public $activeMenu = array();
	
	public function init() {
		if($this->is_init) {
			return;
		}
		$mainMenu = F::sg('menu','defaultMainMenu');
		$user = Yii::app()->user;
		if($user->isMaker()){
			$mainMenu = F::sg('menu','makerMainMenu');
		}else if($user->isDealer()){
			$mainMenu = F::sg('menu','dealerMainMenu');
		}else if($user->isServicer()){
			$mainMenu = F::sg('menu','servicerMainMenu');
		}
		$main = Menu::model()->findByPk($mainMenu);
		$descendants = array();
		if($main){
			//$descendants = $main->children()->findAll("if_show=:if_show",array(":if_show"=>1));
			$descendants = $main->descendants()->findAll("if_show=:if_show",array(":if_show"=>1));
			$level = $main->level + 1;
		}
		$route = Yii::app()->getController()->getRoute();
		$activeMainItem = 0;
		$activeRouteMainItem = 0;
		$firstMainItem = 0;
		$currentMainItem = 0;
		$mainMenu = array();
		$activeSidebarItem = 0;
		$sidebarMenu = array();
		$findActive = false;
		$preLevel = 0;
		$preItem = 0;
                $active=array();
		foreach($descendants as $n=>$descendant) {
			$menu = array('label'=>$descendant->name, 'url' => $descendant->url ? Yii::app()->request->baseUrl . '/' . $descendant->url : '#',
					'active'=>false, 'level'=>$descendant->level, 'haschild'=>false);
			// 查找主菜单
			if($descendant->level == $level) {
				$currentMainItem = $descendant->id;
				// 如果子菜单URL属性与当前路径对应，表示找到当前活动子菜单，则当前的主菜单为活动主菜单
				if(!$findActive) {
					$activeMainItem = $descendant->id;
					// 每次变换主菜单，子菜单重新初始化
					$sidebarMenu = array();
					// 将主菜单加入到子菜单的第一项
					$sidebarMenu[$descendant->id] = $menu;
					$sidebarMenu[$descendant->id]['haschild'] = true;
				}
				// 如果子菜单URL属性与当前路径对应，表示找到当前活动子菜单
				if(!$findActive && $this->isItemActive($descendant,$route)) {
					$activeRouteMainItem = $descendant->id;
				}
				if($firstMainItem == 0){
					$firstMainItem = $descendant->id;
				}
				// 写主菜单组
				$mainMenu[$descendant->id] = $menu;
			}
			// 查找子菜单，
			else if($currentMainItem == $activeMainItem && $descendant->level > $level){
				// 如果子菜单URL属性与当前路径对应，表示找到当前活动子菜单
				if(!$findActive && $this->isItemActive($descendant,$route)) {
					$activeSidebarItem = $descendant->id;
					//$menu['active'] = true;
					$findActive = true;
				}
				// 子菜单如果有多级，则父级子菜单需要标注为父菜单，切删除最父主菜单
				if($descendant->level > $preLevel && $preLevel != 0) {
					$sidebarMenu[$preItem]['haschild'] = true;
					unset($sidebarMenu[$currentMainItem]);
				}
				// 写子菜单组
				$sidebarMenu[$descendant->id] = $menu;
				$preLevel = $descendant->level;
				$preItem = $descendant->id;
			}
		}
		if(!$findActive) {
			if($activeRouteMainItem > 0){
				$activeMainItem = $activeRouteMainItem;
			}
			else{
				$activeMainItem = $firstMainItem;
			}
			$sidebarMenu = array();
		}
		$mainMenu[$activeMainItem]['active'] = true;
		if($findActive) {
			$sidebarMenu[$activeSidebarItem]['active'] = true;
		}
                $active['sidebarMenu']=$activeSidebarItem;
                $active['mainMenu']=$activeMainItem;
		$this->activeMenu=$active;
		$this->mainMenu = $mainMenu;
		$this->sidebarMenu = $sidebarMenu;
		$this->is_init = true;
	}
	
        public function getActiveMenu(){
            if(!$this->is_init) {
                $this->init();
            }
            return $this->activeMenu;
        }

        public function getMainMenu() {
		if(!$this->is_init) {
			$this->init();
		}
		return $this->mainMenu;
	}
	
	public function getSidebarMenu() {
		if(!$this->is_init) {
			$this->init();
		}
		return $this->sidebarMenu;
	}
	
	protected function isItemActive($item,$route)
	{
		
		if(isset($item['url']) && !strcasecmp(trim($item['url'],'/'),$route))
		{	
			return true;
		}
		if(isset($item['extra_url']) && stripos($item['extra_url'],$route) !== false)
		{
			return true;
		}
		return false;
	}
}
?>