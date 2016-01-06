<?php

/*
 * 联盟经销商
 */

Class UniondealerController extends Controller {

    public function actionIndex() {
        $type = Yii::app()->request->getParam('type');
        $state = Yii::app()->request->getParam('State');
        $city = Yii::app()->request->getParam('City');
        $homeajax = Yii::app()->request->getParam('homeajax');
        $pagesize = 12;
        if ($state === '')
            $province = 'all';
        elseif ($state === null)
            $province = '370000';   //默认山东省
        else
            $province = $state;
        $brand = Yii::app()->request->getParam('brand');
        $type = $type === null ? 1 : $type;   //1网格  2列表
        //获得联盟id
        $organID = Yii::app()->user->getOrganID();
        $unionid = MallService::getUnioninfo($organID);
        $unionid = $unionid ? $unionid : '-1';
        //联盟商品
        $dids = MallService::getUnionOrgan(array('UnionID' => $unionid, 'type' => 2));
        $where = ' where Identity=2 and IsBlack="0" and IsFreeze="0" and Status="1"';
        $where.= ' and ID in (' . $dids . ')';
        if ($homeajax == 1) {
            $province = 'all';
            $pagesize = 6;
        }
        if ($province !== 'all') {
            $where.=' and Province=' . $province;
        }
        if ($city) {
            $where.=' and City=' . $city;
        }
        if (!empty($brand)) {
            $ids = $this->getdealerbybrand($brand);
            $where.=' and ID in' . $ids;
        }
        if ($homeajax == 1) {
            //工作台首页
            $sql = ' select ID,OrganName,Logo from jpd_organ' . $where;
        } else {
            $sql = ' select * from jpd_organ' . $where;
        }
        $sqlcount = ' select count(*) from jpd_organ' . $where;
        $count = Yii::app()->jpdb->createCommand($sqlcount)->queryScalar();
        $sql.=' order by Sort ASC ';
        $dataProvider = new CSqlDataProvider($sql, array(
            'db' => Yii::app()->jpdb,
            'totalItemCount' => $count,
            'pagination' => array(
                'pageSize' => $pagesize,
            ),
                )
        );
        $organ = $dataProvider->getData();
        if ($homeajax == 1) {
            echo json_encode($organ);
            die;
        }
        if ($organ) {
            foreach ($organ as $key => $val) {
                $a = array();
                $b = array();
                $organ[$key]['OrganName'] = '<a target="_black" href="' . Yii::app()->createUrl('servicer/servicedetail/detail', array('dealer' => $val['ID'])) . '">' . $val['OrganName'] . '</a>';
                $brand = PapBrand::model()->findAll('OrganID=:organ', array(':organ' => $val['ID']));
                $brand_str = "";
                foreach ($brand as $k => $v) {
                    if ($v['BrandName'] === null) {
                        continue;
                    }
                    $a[] = $v['BrandName'];
                }
                if ($a) {
                    $brand_str = implode(',', $a);
                    $organ[$key]['brand'] = '<a title="' . $brand_str . '">' . $brand_str . '</a>';
                    $organ[$key]['firstbrand'] = '<a title="' . $brand_str . '">' . $a[0] . '</a>';
                } else {
                    $organ[$key]['brand'] = '暂无';
                    $organ[$key]['firstbrand'] = '主营品牌:暂无';
                }
                $vehicles = DealerVehicles::model()->findAll('OrganID=:organ', array(':organ' => $val['ID']));
                $str = "";
                foreach ($vehicles as $k => $v) {
                    $car = $v['Make'];
                    if ($v['Car']) {
                        $car .= ' ' . $v['Car'];
                        if ($v['Year']) {
                            $car .= ' ' . $v['Year'];
                            if ($v['Model'])
                                $car .= ' ' . $v['Model'];
                            else
                                $car .= ' ' . '全车型';
                        } else
                            $car .= ' ' . '全年款';
                    } else {
                        $car .= ' ' . '全车系';
                    }
                    $b[] = $car;
                }
                if ($b) {
                    $str = implode('; ', $b);
                    //$organ[$key]['vehicles'] = '<a title="' . $str . '">' . $str . '</a>';
                    $organ[$key]['vehicles'] = $str;
                } else {
                    $organ[$key]['vehicles'] = '暂无';
                }
                $organ[$key]['TelPhone'] = $organ[$key]['TelPhone'] ? $organ[$key]['TelPhone'] : '暂无';
            }
        }
        $dataProvider->setData($organ);
        $branddata = $this->getBrand($dids);
        $get = $this->geturlparams($_GET);
        $get['type'] = $type;
        $pages = new CPagination($count);
        $pages->pageSize = $pagesize;
        $page = $pages->getCurrentPage() + 1;
        $totalpage = $pages->getPageCount();
        $start = 1 + ($page - 1) * $pagesize;
        $end = $page < $totalpage ? ($start + $pagesize - 1) : $count;
        $footer = '<span class="zdyfooter">第 ' . $start . ' - ' . $end . ' 条, 共 ' . $count . ' 条.</span>';
        $this->render('index', array(
            'dataProvider' => $dataProvider,
            'brand' => $branddata,
            'get' => $get,
            'type' => $type,
            'province' => $province,
            'city' => $city,
            'pages' => $pages,
            'footer' => $footer
        ));
    }

    public function getBrand($dealerids) {
        $sql = "select DISTINCT BrandName,Pinyin from pap_brand where OrganID in (" . $dealerids . ")  group by BrandName order by Pinyin asc";
        $model = Yii::app()->papdb->CreateCommand($sql)->queryAll();
        $data = array();
        foreach ($model as $v) {
            $py = strtoupper(substr(self::checkFirstName($v["Pinyin"]), 0, 1));
            $data['All'][] = $v['BrandName'];
            if (!$py) {
                $data['Else'][] = $v['BrandName'];
            } else {
                $data['Sort'][$py][] = $v['BrandName'];
            }
        }
        return $data;
    }

    //检测品牌拼音
    private static function checkFirstName($subject) {
        $pattern = '/[A-Za-z]+/';
        preg_match($pattern, $subject, $matches);
        return $matches[0];
    }

    public function actionList() {
        $province = Yii::app()->request->getParam('province');
        $city = Yii::app()->request->getParam('city');
        $brand = Yii::app()->request->getParam('brand');
        $criteria = new CDbCriteria();
        $criteria->addCondition('Identity=2 and IsBlack="0" and IsFreeze="0" and Status="1"');
        if ($province) {
            $criteria->addCondition('Province=' . $province, 'AND');
        }
        if ($city) {
            $criteria->addCondition('City=' . $city, 'AND');
        }
        if (!empty($brand)) {
            $ids = $this->getdealerbybrand($brand);
            $criteria->addInCondition('ID', $ids);
        }
        $criteria->order = 'Sort ASC';
        $organ = Organ::model()->findAll($criteria);
        $organ = array();
        if (isset($organ)) {
            foreach ($organ as $key => $val) {
                $organ[$key] = $val->attributes;
                $organ[$key]['address'] = Area::getCity($val['Province']) . Area::getCity($val['City']) . Area::getCity($val['Area']);
                $brand = PapBrand::model()->find('OrganID=:organ', array(':organ' => $val['ID']));
                $organ[$key]['brandname'] = $brand['BrandName'];
            }
        }
        echo json_encode($organ);
    }

    /*
     * 获取联盟经销商（首页）
     */

    public function actionListfromindex() {
        $criteria = new CDbCriteria();
        $criteria->select = "ID,OrganName,Logo";
        $criteria->addCondition('Identity=2');
        $criteria->order = "Sort ASC";
        $organ = Organ::model()->findAll($criteria);
        $organ = array();
        if (isset($organ)) {
            foreach ($organ as $key => $val) {
                $organ[$key] = $val->attributes;
            }
        }
        echo json_encode($organ);
    }

    //获取url参数
    public function geturlparams($parmas) {
        $res = array();
        foreach ($parmas as $k => $v) {
            if ($k != 'brand' && $k != 'page')
                $res[$k] = $v;
        }
        return $res;
    }

    //根据品牌名称获取经销商id
    public function getdealerbybrand($brand) {
        $sql = 'select DISTINCT OrganID from `pap_brand` where BrandName="' . $brand . '"';
        $res = Yii::app()->papdb->createCommand($sql)->queryAll();
        $data = array();
        foreach ($res as $v) {
            $data[] = $v['OrganID'];
        }
        if ($data) {
            $ids = '(' . implode(',', $data) . ')';
        } else {
            $ids = '(0)';
        }
        return $ids;
    }

    //信息沟通
    public function actionInfo() {
        $params['organID'] = Yii::app()->user->getOrganID();
        $param['rows'] = 24;
        $params['pinyin'] = Yii::app()->request->getParam('pinyin');
        $pinyin = RemindService::getMakepin($params);
        $info = RemindService::getInfo($params);
        $pages = $this->getShortPage($info["count"], $param['rows']);
        $this->render('info', array('pinyin' => $pinyin, 'info' => $info['data'], 'pages' => $pages, 'params' => $params));
    }

    protected function getShortPage($count, $rows = 10) {
        $criteria = new CDbCriteria();
        $pages = new CPagination($count);
        // 返回前一页
        $pages->pageSize = $rows;
        $pages->applyLimit($criteria);
        return $pages;
    }

    //经销商黄页
    public function actionDetail() {
        $this->layout = "//layouts/base";
        //$model = Dealer::model()->find("userID=:userID", array(":userID" => $_GET['dealer']));
        $organID = Yii::app()->request->getParam("dealer");
        $model = Organ::model()->with('dealer')->findByPK($organID);
        //主营品牌
       // $brands = Brand::model()->findAll("OrganID = $organID");
        $brandsql="select * from pap_dealer_brand db join pap_brand b on db.brandID=b.ID where db.OrganID=$organID";
        $brandres=Yii::app()->papdb->CreateCommand($brandsql)->queryAll();
        
        //主营车系
        $dealerv = JpdDealerVehicles::model()->findAll("OrganID=:userID", array(":userID" => $organID));
        //主营品类
        $cpnames = JpdOrganCpname::model()->findAll('OrganID=:userID', array(':userID' => $organID));
        // 机构照片
        $photosql = 'select * from `{{organ_photo}}` where Purpose = 0 AND OrganID=' . $organID;
        $organphotos = Yii::app()->jpdb->createCommand($photosql)->queryAll();
        $Brand_sql = "SELECT b.BrandName, a.ID, a.url1, a.url2 FROM pap_dealer_brand AS a LEFT JOIN pap_brand AS b "
                    . "ON a.BrandID = b.ID WHERE a.OrganID = {$organID}";
        $Brandphotos = Yii::app()->papdb->createCommand($Brand_sql)->queryAll();
        $this->render("detail", array(
            'model' => $model,
            'organphotos' => $organphotos,
            'dealerv' => $dealerv,
            'showcpnames' => $cpnames,
            'brand' => $brandres,
            'Brandphotos' => $Brandphotos,
        ));
    }

}
