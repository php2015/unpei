<?php

class SettingsForm extends CFormModel {
    /*
      public $site = array(
      'name' => '',
      'domain' => '',
      'googleAPIKey' => '',
      'numSearchResults' => '',
      'defaultLanguage' => '',
      'defaultCurrency' => '',
      'about' => '',
      'statistics' => '',
      );
     */
    /*
      public $seo = array(
      'mainTitle' => '',
      'mainKwrds' => '',
      'mainDescr' => ''
      );
     */
    /*
      public $mail = array(
      'adminEmail' => '',
      'fromReply' => '',
      'fromNoReply' => '',
      'server' => '',
      'port' => '',
      'user' => '',
      'password' => '',
      'ssl' => '',
      );
     */
    /*
      public $filter = array(
      'priceLower'=>'',
      'priceUpper'=>'',
      );
     */

    public $menu = array(
        'topMenu' => '', //顶部菜单，暂无
        'defaultMainMenu' => '', //默认主导航菜单
        'makerMainMenu' => '', //生产商主导航菜单
        'dealerMainMenu' => '', //经销商主导航菜单	
        'servicerMainMenu' => '', //修理厂主导航菜单	
        'footMenu' => '', //底部导航菜单	
        'helpSiderbarMenu' => '', //帮助中心侧边菜单	
        'memberSiderbarMenu' => '', //会员中心侧边菜单	 
        'partnerSiderMenu' => '', // 嘉配伙伴
        'makermemberSiderbarMenu' => '', //生产商会员中心侧边菜单	 
        'dealermemberSiderbarMenu' => '', //经销商会员中心侧边菜单	
        'servicememberSiderbarMenu' => '', //修理厂会员中心侧边菜单	
    );
    public $cache = array(
        'menuCachingDuration' => '',
        'jpdataCachingDuration' => '',
        'defaultCachingDuration' => '',
    );

    /**
     * Declares customized attribute labels.
     * If not declared here, an attribute would have a label that is
     * the same as its name with the first letter in upper case.
     */
    public function getAttributesLabels($key) {
        $keys = array(
            'googleAPIKey' => 'Google API Key',
            'numSearchResults' => 'Number of search results at one page',
            'mainTitle' => 'Main Page Title',
            'mainKwrds' => 'Default Keywords (Meta Tag)',
            'mainDescr' => 'Default Description (Meta Tag)',
            'statistics' => 'Third-party statistical code',
            'topMenu' => '顶部菜单',
            'defaultMainMenu' => '默认主导航菜单',
            'makerMainMenu' => '生产商主导航菜单',
            'dealerMainMenu' => '经销商主导航菜单',
            'servicerMainMenu' => '修理厂主导航菜单',
            'footMenu' => '底部导航菜单',
            'helpSiderbarMenu' => '帮助中心侧边菜单',
            'memberSiderbarMenu' => '会员中心侧边菜单',
            'partnerSiderMenu' => '嘉配伙伴侧边菜单',
            'makermemberSiderbarMenu' => '生产商会员中心侧边菜单',
            'dealermemberSiderbarMenu' => '经销商会员中心侧边菜单',
            'servicememberSiderbarMenu' => '修理厂会员中心侧边菜单',
            'menuCachingDuration' => '菜单缓存时间（单位：s）',
            'jpdataCachingDuration' => 'EPC数据缓存时间（单位：s）',
            'defaultCachingDuration' => '默认缓存时间（单位：s）',
        );

        if (array_key_exists($key, $keys))
            return $keys[$key];

        $label = trim(strtolower(str_replace(array('-', '_'), ' ', preg_replace('/(?<![A-Z])[A-Z]/', ' \0', $key))));
        $label = preg_replace('/\s+/', ' ', $label);

        if (strcasecmp(substr($label, -3), ' id') === 0)
            $label = substr($label, 0, -3);

        return ucwords($label);
    }

    /**
     * Sets attribues values
     * @param array $values
     * @param boolean $safeOnly
     */
    public function setAttributes($values, $safeOnly = true) {
        if (!is_array($values))
            return;

        foreach ($values as $category => $values) {
            if (isset($this->$category)) {
                $cat = $this->$category;
                foreach ($values as $key => $value) {
                    if (isset($cat[$key])) {
                        $cat[$key] = $value;
                    }
                }
                $this->$category = $cat;
            }
        }
    }

}