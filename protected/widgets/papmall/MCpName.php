<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

Class MCpName extends CWidget {

    public function run() {
        $main = $this->getMainCategorys(0);
        $main = $this->findChild($main, 0);
        $maincate = $this->findsub($main);
        // $maincate=$this->build_tree($main,0);
        $this->render('cpname', array('MainCategory' => $maincate));
    }

    /**
     * 取商品品类第一级大类
     * @return array
     */
    public function getMainCategorys($parentID) {
        $cri = new CDbCriteria(array(
            'condition' => 'ParentID =' . $parentID . ' or ParentID <=> NULL and IsShow=1',
            'order' => 'SortOrder asc',
        ));
        $categorys = Gcategory::model()->findAll($cri);

        return $categorys;
    }

    //取大类
    protected function findChild($arr, $id) {
        $childs = array();
        foreach ($arr as $k => $v) {
            if ($v['ParentID'] == $id) {
                $childs[] = $v;
            }
        }
        return $childs;
    }

//取子类
    protected function findsub($rows) {

        foreach ($rows as $k => $v) {
            $childs[$k] = $v->attributes;
            $sub = $this->getMainCategorys($v['ID']);
            $childs[$k]['children'] = $sub;
        }
        return $childs;
    }

//无限循环分类
    protected function build_tree($rows) {
        foreach ($rows as $k => $v) {
            $childs[$k] = $v->attributes;
            $sub = $this->getMainCategorys($v['ID']);
            if ($sub != '') {
                $childs[$k]['children'] = $this->build_tree($sub);
            }
        }
        return $childs;
    }

}

?>
