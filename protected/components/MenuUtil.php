<?php 
class MenuUtil
{	
	public static function initMenu($route='',$identity='unknown') {
		// 缓存时间，大于0时才缓存
		$menuCachingDuration = F::sg('cache','menuCachingDuration');
		if($menuCachingDuration > 0) {
			$cache = Yii::app()->cache;
			$menu_key = "menu_".$identity."_".$route;
			$cacheMenu = $cache->get($menu_key);
			if(!empty($cacheMenu) && (!empty($cacheMenu['mainMenu']) || !empty($cacheMenu['sidebarMenu']) 
					|| !empty($cacheMenu['sidebarMenu']))) {
				return $cacheMenu;
			}
		}
		// 不同角色有不同的主菜单
		$mainMenu = F::sg('menu','defaultMainMenu');
		if($identity=='maker'){
			$mainMenu = F::sg('menu','makerMainMenu');
		}else if($identity=='dealer'){
			$mainMenu = F::sg('menu','dealerMainMenu');
		}else if($identity=='servicer'){
			$mainMenu = F::sg('menu','servicerMainMenu');
		}

		// 主菜单信息
		//$main_key = "mainmenu_".$mainMenu;
		//$main = $cache->get($main_key);
		//if(!$main) {
			$main = Menu::model()->cache($menuCachingDuration)->findByPk($mainMenu);
		//	$cache->set($main_key,$main);
		//}
			
		if(!$main || count($main) == 0){
			return;
		}
		// 主菜单的所有子菜单信息
		$descendants = array();
		//$descendants_key = $main_key."_descendants";
		//$descendants = $cache->get($descendants_key);
		//if(!$descendants){
			//$descendants = $main->children()->findAll("if_show=:if_show",array(":if_show"=>1));
			$descendants = $main->descendants()->cache($menuCachingDuration)->findAll("if_show=:if_show",array(":if_show"=>1));
		//	$cache->set($descendants_key,$descendants);
		//}
		$level = $main->level + 1;
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
				if(!$findActive && self::isItemActive($descendant,$route)) {
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
				if(!$findActive && self::isItemActive($descendant,$route)) {
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
        
		// 设置缓存
		$dbMenu = array('activeMenu'=>$active,'mainMenu'=>$mainMenu,'sidebarMenu'=>$sidebarMenu);
		if($menuCachingDuration) {
			$cache = Yii::app()->cache;
			$cache->set($menu_key,$dbMenu);
		}
		return $dbMenu;
	}
	
    public static function getActiveMenu($route='',$identity='unknown'){
    	$menu = self::initMenu($route, $identity);
        return $menu['activeMenu'];
    }

    public static function getMainMenu($route='',$identity='unknown') {
    	$menu = self::initMenu($route, $identity);
		return $menu['mainMenu'];
	}
	
	public static function getSidebarMenu($route='',$identity='unknown') {
		$menu = self::initMenu($route, $identity);
		return $menu['sidebarMenu'];
	}
	
	public static function isItemActive($item,$route)
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