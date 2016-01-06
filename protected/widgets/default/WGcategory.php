<?php

/**
 * 商品品类联动
 * @author Administrator
 *
 */
class WGcategory extends CWidget
{
	// 下拉框id的后缀，例如$scope=Add,则id为 mainCategoryAdd, subCategoryAdd ...
	public $scope;
	public $mainCategory;
	public $subCategory;
	public $leafCategory;
        public $requred = 'N';        // 是否是必填项 Y：必填 N：不是必填
        public $notlink = 'Y';        // 是否联动 Y：联动 N：不联动
        public $button;               // 屏蔽添加按钮

        /**
	 * 取商品品类第一级大类
	 * @return array
	 */
    public function getMainCategorys()
    {
        $cri = new CDbCriteria(array(
                    'condition' => 'ParentID = 0 or ParentID <=> NULL', 
                    'order' => 'SortOrder asc',
                ));
        $categorys = Gcategory::model()->findAll($cri);
        return $categorys;
    }
    
    /**
	 * 取商品品类第二级子类
	 * @return array
	 */
    public function getSubCategorys()
    {
        if($this->mainCategory){
            $cri = new CDbCriteria(array(
                    'condition' => 'ParentID = '.$this->mainCategory.' and IsShow=1', 
                    'order' => 'SortOrder asc',
                ));
        }
        $categorys = Gcategory::model()->findAll($cri);
        return $categorys;
    }
    /**
	 * 取商品品类第三级标准名称
	 * @return array
	 */
    public function getLeafCategorys()
    {
        if($this->subCategory){
            $cri = new CDbCriteria(array(
                    'condition' => 'ParentID = '.$this->subCategory.' and IsShow=1', 
                    'order' => 'SortOrder asc',
                ));
        }
        $categorys = Gcategory::model()->findAll($cri);
        return $categorys;
    }
    public function run()
    {
        $this->render('gcategory');
    }
}