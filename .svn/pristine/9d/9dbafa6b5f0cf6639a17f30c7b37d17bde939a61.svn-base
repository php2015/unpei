<?php

Class MakegoodsController extends Controller {

    public $layout = '//layouts/maker';

    //商品列表
    public function actionIndex() {
        $this->pageTitle = Yii::app()->name . '-' . '商品信息';
        $organID = Commonmodel::getOrganID();
        //获取主营品类
        $model = DealerCpname::model()->findAll("OrganID=:organID", array(':organID' => $organID));
        $data = array();
        foreach ($model as $key => $val) {
            $data[$key]['CpNameID'] = $val['CpNameID'];
            $data[$key]['CgName'] = $val['BigName'] . ' ' . $val['SubName'] . ' ' . $val['CpName'];
        }
        $category = CHtml::listData($data, 'CpNameID', 'CgName');
        $this->render('list', array('category' => $category));
    }

    //组装高级筛选参数
    public function makeMoreParams() {
        //内宽
        if (isset($_GET['expertparams']) && !empty($_GET['expertparams'])) {
            $arr = explode('/', $_GET['expertparams']);
            foreach ($arr as $key => $val) {
                $tarr = explode(',', $val);
                if (is_array($tarr) && count($tarr) > 2)
                    $arr['name'] = $tarr[0];
                $arr['value'] = $tarr[1] . ',' . $tarr[2];
                $arr['type'] = 'between';
                $params['more'][] = $arr;
            }
        }

        if (isset($_GET['standparams']) && !empty($_GET['standparams'])) {

            $arr = explode('/', $_GET['standparams']);
            foreach ($arr as $key => $v) {
                $tarr = explode(',', $v);
                if (is_array($tarr) && $tarr[0] && $tarr[1])
                    $arr['name'] = $tarr[0];
                $arr['value'] = $tarr[1];
                $arr['type'] = 'normall';
                $params['more'][] = $arr;
            }
        }


        return $params;
    }

    public function actionList() {
        $organID = Commonmodel::getOrganID();

        $cpname = DealerCpname::model()->find('OrganID=' . $organID);
        $_GET['params']['standardid'] = isset($_GET['params']['standardid']) ? $_GET['params']['standardid'] : $cpname['CpNameID'];

        if (isset($_GET['params']) && !empty($_GET['params'])) {
            $params = $_GET['params'];
            $goodsno = isset($params['goodsno']) ? trim($params['goodsno']) : '';
            $goodsname = isset($params['goodsname']) ? trim($params['goodsname']) : '';
            $oenum = isset($params['oe']) ? trim($params['oe']) : '';
            $issale = isset($params['issale']) ? trim($params['issale']) : '';
            $moreparams = $this->makeMoreParams();
            if (is_array($moreparams)) {
                $params = array_merge($params, $moreparams);
            }
        }
        $page = isset($_GET['page']) ? $_GET['page'] : null;
        $limit = isset($_GET['rows']) ? $_GET['rows'] : null;
        $result = Goods::GetGoodsByMakeID($organID, $params, $page, $limit);
        echo json_encode($result);
//         $criteria = new CDbCriteria();
//         $sql = "select distinct a.id as goodsID ,b.goods_category as category_id,b.goods_oe as OE,b.goods_brand as brand,b.organID,
// 		 	    a.NewVersion as version_name,b.goods_no as goodsno,b.goods_name as goodsname,
//                 b.benchmarking_brand,b.benchmarking_sn,b.marketprice,b.salesprice,b.discountprice,a.create_time,"
//                 . " b.inventory as inventory,b.senddays,b.description,a.IsSale,b.maincategory,b.subcategory,b.standard_id"
//                 . " from  tbl_make_goods a ,tbl_make_goods_version b ,tbl_make_goods_vehicle c"
//                 . '  where a.id=b.goods_id and a.NewVersion=b.version_name'
//                 . "  and a.ISdelete='0' and b.ISdelete=0"
//                 . "  and a.organID='$organID' ";
//         //第一个配件品类
//         $cpname = DealerCpname::model()->find('OrganID=' . $organID);
//         $_GET['params']['standardid'] = isset($_GET['params']['standardid']) ? $_GET['params']['standardid'] : $cpname['CpNameID'];
//         if (isset($_GET['params'])&&!empty ($_GET['params'])) {
//             $params = $_GET['params'];
//             $goodsno = isset($params['goodsno']) ? trim($params['goodsno']) : '';
//             $goodsname = isset($params['goodsname']) ? trim($params['goodsname']) : '';
//             $oenum = isset($params['oe']) ? trim($params['oe']) : '';
//             $issale = isset($params['issale']) ? trim($params['issale']) : '';
//             if (!empty($goodsname)) {
//                 $sql.=" and b.goods_name like'%$goodsname%'";
//             }
//             //OE号搜索
//             if (!empty($oenum)) {
//                 $sql.=" and b.goods_oe like'%$oenum%'";
//             }
//             //商品编号搜索
//             if (!empty($goodsno)) {
//                 $sql.=" and b.goods_no like '%$goodsno%'";
//             }
//             //配件品类搜索
//             if (!empty($params['standardid'])) {
//                 $sql.=' and b.standard_id=' . $params['standardid'];
//             } 
// //            elseif (!empty($params['subcategory'])) {
// //                $sql.=' and b.standard_id in( select id from tbl_gcategory where parent_id=' . $params['subcategory'] . ')';
// //            } elseif (!empty($params['maincategory'])) {
// //                $sql.=' and b.standard_id in( select id from `tbl_gcategory` where parent_id in(SELECT id FROM `tbl_gcategory` where parent_id=' . $params['maincategory'] . '))';
// //            }
// //            //添加时间查询
// //            if (!empty($params['begintime'])) {
// //                $sql.=' and a.create_time>=' . strtotime($params['begintime']);
// //            }
// //            if (!empty($params['endtime'])) {
// //                $endtime = strtotime($params['endtime']) + 3600 * 24 - 1;
// //                $sql.=' and a.create_time<=' . $endtime;
// //            }
//             //商品类别搜索
//             if (!empty($params['goodscategory'])) {
//                 $sql.=' and b.goods_category=' . $params['goodscategory'];
//             }
//             //品牌搜索
//             if (!empty($params['goodsbrand'])) {
//                 $sql.=' and b.goods_brand=' . $params['goodsbrand'];
//             }
//             //是否上架查询
//             if (is_numeric($issale)) {
//                 $sql.=" && a.IsSale='$issale'";
//             }
//             //适用车型搜索
//             if(!empty($params['carmodel']))
//             {
//                 $sql.=' and a.id=c.GoodsID and c.Name like "%'.$params['carmodel'].'%" ';
//             }
//         }
//         //高级筛选
//         if(isset($_GET['expertparams'])&&!empty($_GET['expertparams']))
//         {
//             $arr=  explode('/',$_GET['expertparams']);
//             foreach($arr as $key=>$v)
//             {
//                $sql_w.=" and exists(
//                 SELECT DISTINCT(f.goods_id) FROM `tbl_make_goods_values` f,`tbl_make_goods_template` g where 
//                 g.id=f.template_id and a.id=f.goods_id  
//                and g.organID=".$organID.' and g.standard_id='.$_GET['params']['standardid'];
//                 $a=explode(',',$v);
//                 $sql_wx=1;
//                 $sql_w.=' and (g.name="'.$a[0].'" and f.value between '.$a[1].' and '.$a[2].')) ';
//             }
//         }
//         //echo $sql_w;die;
//         //规格进出水口高级筛选
//         if(isset($_GET['standparams'])&&!empty($_GET['standparams']))
//         {
//             $arr=  explode('/',$_GET['standparams']);
//             foreach($arr as $key=>$v)
//             {
//                  $sql_n.= " and exists(
//                 SELECT DISTINCT(f.goods_id) FROM `tbl_make_goods_values` f,`tbl_make_goods_template` g where 
//                 g.id=f.template_id and a.id=f.goods_id  
//                and g.organID=".$organID.' and g.standard_id='.$_GET['params']['standardid'];
//                 $a=explode(',',$v);
//                 if($a[1])
//                 {
//                     $sql_nx=1;
//                      $sql_n.=' and (g.name="'.$a[0].'" and f.value ="'.$a[1].'"))';
//                 }
//             }
//         }
//         //安装方式
//         if(isset($_GET['installparams'])&&!empty($_GET['installparams']))
//         {
//              $sql_i.= " and exists(
//                 SELECT DISTINCT(f.goods_id) FROM `tbl_make_goods_values` f,`tbl_make_goods_template` g where 
//                 g.id=f.template_id and a.id=f.goods_id  
//                 and g.organID=".$organID.' and g.standard_id='.$_GET['params']['standardid'];
//             $arr=  explode('/',$_GET['installparams']);
//             $a=explode(',',$arr[0]);
//             if($a[1])
//             {
//                 $sql_ix=1;
//                 $sql_i.=' and g.name="'.$a[0].'" and (f.value ="'.$a[1].'" or f.value="'.$a[2].'"))';
//             }
//         }
//         if($sql_wx==1)
//             $sql.=$sql_w; 
//         if($sql_nx==1)
//             $sql.=$sql_n;
//         if($sql_ix==1)
//             $sql.= $sql_i; 
//         $sql.="  group by a.id order by a.id desc";
//         $result = Yii::app()->db->createCommand($sql)->queryAll();
//         $count = count($result);
//         $pages = new CPagination($count);
//         //设置分页页数
//         $pages->pageSize = isset($_GET['rows']) ? intval($_GET['rows']) : 10;
//         $pages->applyLimit($criteria);
//         $result = Yii::app()->db->createCommand($sql . " LIMIT :offset,:limit");
//         //绑定分页参数
//         $result->bindValue(':offset', $pages->currentPage * $pages->pageSize);
//         $result->bindValue(':limit', $pages->pageSize);
//         $result = $result->queryAll();
//         $datas = array();
//         foreach ($result as $key => $val) {
//             $datas[$key] = $val;
//             //查询商品类别
//             if (!empty($val[category_id])) {
//                 $re = MakeGoodsCategory::model()->findByPk($val[category_id]);
//                 $datas[$key]['category'] = $re['name'];
//             }
//             //查询商品类别
//             if (!empty($val['brand'])) {
//                 $brand = MakeGoodsBrand::model()->findByPK($val['brand']);
//                 $datas[$key]['brandname'] = $brand['BrandName'];
//             }
//             //查询标准名称
//             if (!empty($val['standard_id'])) {
//                 $stand = Gcategory::model()->findByPk($val['standard_id']);
//                 $datas[$key]['cp_name'] = $stand['name'];
//             }
//             //查询车型
//             $cmodel=  MakeGoodsVehicle::model()->find('GoodsID=' . $val['goodsID'] . ' and VersionName="' . $val['version_name'] . '"');
//             if($cmodel)
//                 $datas[$key]['carmodel']=$cmodel->Name;
//             $datas[$key]['GoodsID'] = $val['goodsID'];
//             $datas[$key]['OE'] = $val['OE'];
//             $datas[$key]['Brand'] = $val['brand'];
//             $datas[$key]['version_name'] = $val['version_name'];
//             $datas[$key]['GoodsNo'] = $val['goodsno'];
//             $datas[$key]['GoodsName'] = $val['goodsname'];
//             $datas[$key]['BenchBrand'] = $val['benchmarking_brand'];
//             $datas[$key]['BenchNo'] = $val['benchmarking_sn'];
//             $datas[$key]['GoodsBrand'] = $val['brand'];
//             $datas[$key]['BrandName'] = $val['brandname'];
//             $datas[$key]['GoodsCategory'] = $val['category_id'];
// //                    $datas[$key]['CategoryName']=$val['category'];
//             $datas[$key]['MarkPrice'] = $val['marketprice'];
//             $datas[$key]['SalePrice'] = $val['salesprice'];
//             $datas[$key]['DiscountPrice'] = $val['discountprice'];
//             $datas[$key]['inventory'] = $val['inventory'];
//             $datas[$key]['Days'] = $val['senddays'];
//             $datas[$key]['Desc'] = $val['description'];
//             //b.maincategory,b.subcategory,b.standard_id
//             $datas[$key]['mainCategory'] = $val['maincategory'];
//             $datas[$key]['subCategory'] = $val['subcategory'];
//             $datas[$key]['standard_id'] = $val['standard_id'];
//             $datas[$key]['create_time'] = date('Y-m-d H:i:s', $val['create_time']);
//             //获取标准名称参数值
//             if (!empty($val['standard_id'])) {
//                 $params = MakeGoodsValues::model()->findAll('standard_id=' . $val['standard_id'] . ' and goods_id=' . $val['goodsID'] . ' and version_name="' . $val['version_name'] . '"');
//                 $value = array();
//                 foreach ($params as $param) {
//                     $k = $param['template_id'];
//                     $value[$k] = $param['value'];
//                     $datas[$key][$k] = $param['value'];
//                 }
//                 $datas[$key]['paramsvalue'] = $value;
//             }
//             if ($val['IsSale'] == 0) {
//                 $datas[$key]['IsSale'] = '已上架';
//             } else {
//                 $datas[$key]['IsSale'] = '已下架';
//             }
//         }
//         echo json_encode(array('rows' => $datas, 'total' => $pages->itemCount));
        //}
    }

    //商品添加
    public function actionAdd() {
        $goodsname = Yii::app()->request->getParam('GoodsName');
        $goodsno = Yii::app()->request->getParam('GoodsNo');
        $organID = Commonmodel::getOrganID();
        //查选商品编号是否存在
        $goodsmodel = MakeGoodsVersion::model()->find('goods_no="' . $goodsno . '" and organID=' . $organID . ' and ISdelete=0');
        if ($goodsmodel) {
            echo 3;
            die;
        }
        $userId = Yii::app()->user->id;
        $oe = Yii::app()->request->getParam('OE');
        $oe = str_replace('，', ',', $oe);
        $benchbrand = Yii::app()->request->getParam('BenchBrand');
        $benchno = Yii::app()->request->getParam('BenchNo');
        $goodsbrand = Yii::app()->request->getParam('GoodsBrand');
        $goodscategory = Yii::app()->request->getParam('GoodsCategory');
//        $bigparts = Yii::app()->request->getParam('mainCategory');
//        $subparts = Yii::app()->request->getParam('subCategory');
        $standard = Yii::app()->request->getParam('leafCategory');

        $column = Yii::app()->request->getParam('column');
//        $marketprice = Yii::app()->request->getParam('MarkPrice');
//        $salesprice = Yii::app()->request->getParam('SalePrice');
//        $quoprice = Yii::app()->request->getParam('DiscountPrice');
        $inventory = Yii::app()->request->getParam('inventory');
        $carmodel = Yii::app()->request->getParam('carmodel');
        $days = Yii::app()->request->getParam('Days');
        $desc = Yii::app()->request->getParam('Desc');

        $goodmodel = new MakeGoods();
        $goodmodel->NewVersion = 'V1.0.0';
        if ($goodmodel->save()) {
            $goodsID = Yii::app()->db->getLastInsertID();
        } else {
            echo json_encode(array('msg' => 'fail'));
            Yii::app()->end();
        }
        $goodsImages = $_POST['goodsImages'];
        $imglegth = count($goodsImages);
        for ($i = 0; $i < $imglegth; $i++) {
            $goodsImg = new MakeGoodsImageRelation();
            $goodsImg->GoodsID = $goodsID;
            $goodsImg->OrganID = $organID;
            $goodsImg->ImageUrl = $goodsImages[$i];
            $goodsImg->CreateTime = time();
            $goodsImg->UpdateTime = time();
            $goodsImg->save();
        }
        //插入商品版本

        $model = new MakeGoodsVersion();
        $model->version_name = 'V1.0.0';
        $model->organID = $organID;
        $model->userID = $userId;
        $model->goods_id = $goodsID;
        $model->goods_oe = $oe;
        $model->goods_brand = $goodsbrand;
        $model->goods_category = $goodscategory;
        $model->goods_no = $goodsno;
        $model->goods_name = $goodsname;
        $model->benchmarking_brand = $benchbrand;
        $model->benchmarking_sn = $benchno;
        //$model->maincategory = $bigparts;
        //$model->subcategory = $subparts;
        $model->standard_id = $standard;
        //$model->marketprice = $marketprice;
        //$model->salesprice = $salesprice;
//        if($quoprice)
//             $model->discountprice = $quoprice;
        $model->inventory = $inventory;
        $model->description = $desc;
        $model->senddays = $days;
        $res = 1;
        //var_dump($model);die;
        if ($model->save()) {
            foreach ($column as $key => $c) {
                unset($model);
                $model = new MakeGoodsValues();
                $model->organID = $organID;
                $model->userID = $userId;
                $model->goods_id = $goodsID;
                $model->standard_id = $standard;
                $model->version_name = 'V1.0.0';
                //查询标准名称模板id
                //$tmp=  MakeGoodsTemplate::model()->find('name='.$key.' and organID='.$organID.' and standard_id='.$standard);
                $model->template_id = $key;
                $model->value = $c;
                if ($model->save())
                    $res = 2;
            }
        }
        //插入车型
        if ($res == 2) {
            $pinyin = F::pinyin1($carmodel);
            $cmodel = new MakeGoodsVehicle();
            $cmodel->OrganID = $organID;
            $cmodel->UserID = $userId;
            $cmodel->GoodsID = $goodsID;
            $cmodel->Name = $carmodel;
            $cmodel->PinYin = $pinyin;
            $cmodel->CreateTime = time();
            $cmodel->UpdateTime = time();
            if ($cmodel->save())
                $res = 3;
        }
        if ($res == 3)
            echo 1;
    }

    //修改
    public function actionEdit() {
        $olddata = $this->checkrepeat(Yii::app()->request->getParam('goodsID'), $_POST['version_name']);
        $data = array();
        foreach ($_POST as $k => $v) {
            if (is_array($v)) {
                $data[$k] = $v;
            } else {
                $data['baseinfo'][$k] = $v;
            }
        }
        $repeat = 1;
        foreach ($data as $key => $value) {
            $a = array();
            if (isset($olddata[$key])) {
                $a = array_diff($value, $olddata[$key]);
                if ($a) {
                    $repeat = 2; //不重复
                    break;
                }
            }
        }
        if ($repeat == 1) {
            //判断是否有新上传图片,有就将图片地址添加到数据库
            if ($_POST['goodsImages']) {
                $goodsImages = $_POST['goodsImages'];
                $imglegth = count($goodsImages);
                $organID = Commonmodel::getOrganID();
                $goodsID = Yii::app()->request->getParam('goodsID');
                for ($i = 0; $i < $imglegth; $i++) {
                    $goodsImg = new MakeGoodsImageRelation();
                    $goodsImg->GoodsID = $goodsID;
                    $goodsImg->OrganID = $organID;
                    $goodsImg->ImageUrl = $goodsImages[$i];
                    $goodsImg->CreateTime = time();
                    $goodsImg->UpdateTime = time();
                    $goodsImg->save();
                    unset($goodsImg);
                }
            }
            echo 2;
            die;
        }
        $organID = Commonmodel::getOrganID();
        $goodsID = Yii::app()->request->getParam('goodsID');
        $goodsname = Yii::app()->request->getParam('GoodsName');
        $goodsno = Yii::app()->request->getParam('GoodsNo');
        $version = Yii::app()->request->getParam("version");
        $oe = Yii::app()->request->getParam('OE');
        $oe = str_replace('，', ',', $oe);
        $benchbrand = Yii::app()->request->getParam('BenchBrand');
        $benchno = Yii::app()->request->getParam('BenchNo');
        $goodsbrand = Yii::app()->request->getParam('GoodsBrand');
        $goodscategory = Yii::app()->request->getParam('GoodsCategory');
        $carmodel = Yii::app()->request->getParam('carmodel');

        //$bigparts = Yii::app()->request->getParam('mainCategory');
        //$subparts = Yii::app()->request->getParam('subCategory');
        $standard = Yii::app()->request->getParam('leafCategory');

        $column = Yii::app()->request->getParam('column');
        //$marketprice = Yii::app()->request->getParam('MarkPrice');
        //$salesprice = Yii::app()->request->getParam('SalePrice');
        //$quoprice = Yii::app()->request->getParam('DiscountPrice');
        $inventory = Yii::app()->request->getParam('inventory');
        $days = Yii::app()->request->getParam('Days');
        $desc = Yii::app()->request->getParam('Desc');
        $newversion = preg_replace(array('/V/', '/\./'), '', $version);
        $newversion = intval($newversion) + 1;
        $arr = str_split((string) $newversion);
        $newversion = 'V' . $arr[0] . '.' . $arr[1] . '.' . $arr[2];
        $goodmodel = MakeGoods::model()->updateByPk($goodsID, array('NewVersion' => $newversion));
//        $goodsImages = $_POST['goodsImages'];
//        $imglegth = count($goodsImages);
//        for ($i = 0; $i < $imglegth; $i++) {
        //添加商品图片
        $urlimg = explode(',', $_POST['urlimg']); //根据逗号拆分，得到图片信息的字符串
        $sqlimg = "insert into tbl_make_goods_image_relation (OrganID,GoodsID,ImageUrl,CreateTime,ImageName) values";
        foreach ($urlimg as $k => $value) {
            if ($value) {//去掉初始值0
                $addimg = explode(';', $value); //根据分号拆分，得到图片的相关信息
                if ($k != 1) {
                    $sqlimg .=",";
                }
                $sqlimg .="(";
                $sqlimg .=$organID;
                $sqlimg .=",";
                $sqlimg .=$goodsID; //商品ID
                $sqlimg .=",'";
                $sqlimg .=$addimg[0]; //图片url
                $sqlimg .="',";
                $sqlimg .=time();
                $sqlimg .=",'";
                $sqlimg .=$addimg[1]; //图片原名
                $sqlimg .="')";
            }
        }
        DBUtil::execute($sqlimg);
//            $goodsImg = new MakeGoodsImageRelation();
//            $goodsImg->GoodsID = $goodsID;
//            $goodsImg->OrganID = $organID;
//            $goodsImg->ImageUrl = $goodsImages[$i];
//            $goodsImg->CreateTime = time();
//            $goodsImg->UpdateTime = time();
//            $goodsImg->save();
//        }
        //更新版本基础信息
        $organID = Commonmodel::getOrganID();
        $userId = Yii::app()->user->id;
        $model = new MakeGoodsVersion();
        $model->version_name = $newversion;
        $model->organID = $organID;
        $model->userID = $userId;
        $model->goods_id = $goodsID;
        $model->goods_oe = $oe;
        $model->goods_brand = $goodsbrand;
        $model->goods_category = $goodscategory;
        $model->goods_no = $goodsno;
        $model->goods_name = $goodsname;
        $model->benchmarking_brand = $benchbrand;
        $model->benchmarking_sn = $benchno;
        //$model->maincategory = $bigparts;
        //$model->subcategory = $subparts;
        $model->standard_id = $standard;
        //$model->marketprice = $marketprice;
        //$model->salesprice = $salesprice;
        //if($quoprice)
        //   $model->discountprice = $quoprice;
        $model->inventory = $inventory;
        $model->description = $desc;
        $model->senddays = $days;
        $res = 1;
        //var_dump($model);die;
        if ($model->save()) {
            foreach ($column as $key => $c) {
                unset($model);
                $model = new MakeGoodsValues();
                $model->organID = $organID;
                $model->userID = $userId;
                $model->goods_id = $goodsID;
                $model->standard_id = $standard;
                $model->version_name = $newversion;
                $model->value = $c;
                $model->template_id = $key;
                if ($model->save())
                    $res = 2;
            }
        }
        //插入车型
        if ($res == 2) {
            $pinyin = F::pinyin1($carmodel);
            $cmodel = new MakeGoodsVehicle();
            $cmodel->OrganID = $organID;
            $cmodel->UserID = $userId;
            $cmodel->GoodsID = $goodsID;
            $cmodel->VersionName = $newversion;
            $cmodel->Name = $carmodel;
            $cmodel->PinYin = $pinyin;
            $cmodel->CreateTime = time();
            $cmodel->UpdateTime = time();
            if ($cmodel->save())
                $res = 3;
        }
        if ($res == 3)
            echo 1;
    }

    //商品删除
    public function actionDelete() {
        $organID = Commonmodel::getOrganID();
        $goodsID = Yii::app()->request->getParam('goodsID');
        $goodsIDarr = explode(',', $goodsID);
        $result = MakeGoods::model()->updateByPk($goodsIDarr, array('ISdelete' => '1'));
        if ($result) {
            $model = MakeGoodsVersion::model()->updateAll(array('ISdelete' => 1), 'goods_id in(' . $goodsID . ')');
            $modelimg = MakeGoodsImageRelation::model()->deleteAll("OrganID= '$organID' and GoodsID='$goodsID'");
        }
        echo json_encode($result);
    }

    //商品上架
    public function actionOnsale() {
        $goodsID = Yii::app()->request->getParam('goodsID');
        $goodsID = explode(',', $goodsID);
        $result = MakeGoods::model()->updateByPk($goodsID, array('IsSale' => '0'));

        echo json_encode($result);
    }

    //商品上架
    public function actionUnsale() {
        $goodsID = Yii::app()->request->getParam('goodsID');
        $goodsID = explode(',', $goodsID);
        $result = MakeGoods::model()->updateByPk($goodsID, array('IsSale' => '1'));
        echo json_encode($result);
    }

    //获取标准名称参数
    public function actionGetstand() {
        $organID = Commonmodel::getOrganID();
        $standID = Yii::app()->request->getParam('standID');
        $result = MakeGoodsTemplate::model()->findAll('standard_id=:standID and organID=:userID and ISdelete="N"', array(':standID' => $standID, ':userID' => $organID));
        foreach ($result as $key => $value) {
            $data[$key]['name'] = $value['name'];
            $data[$key]['id'] = $value['id'];
        }
        echo json_encode($data);
    }

    //前市场联动获取后市场车型
    public function actionGetbcar() {
        $modelID = Yii::app()->request->getParam('modelID');
        $carID = Yii::app()->request->getParam('carID');
        if ($modelID) {
            $sql = "select distinct alias from goods_model where modelid='$modelID'";
            $data = DBUtil::query($sql);
        }
        if ($modelID == 'ALL') {
            $sql = "select distinct alias from goods_model where seriesid='$carID'";
            $data = DBUtil::queryAll($sql);
            foreach ($data as $key => $value) {
                $data[$key]['alias'] = $value['alias'];
            }
        }
        echo json_encode($data);
    }

    //根据后市场车系获取前市场所有适用车系
    public function actionAllfrontcar() {
        $alias = Yii::app()->request->getParam('alias');
        $sql = "select distinct makeid,seriesid from goods_model where alias='$alias'";
        $res = DBUtil::query($sql);
        $make_sql = "select  distinct name from goods_makes where makeid={$res['makeid']}";
        $make = DBUtil::query($make_sql);
        $car_sql = "select distinct name from goods_series where seriesid={$res['seriesid']}";
        $car = DBUtil::query($car_sql);
        $data['make'] = $make['name'];
        $data['car'] = $car['name'];

        echo json_encode($data);
    }

    //根据后市场车系，显示所有前市场车型
    public function actionShowallmodel() {
        $alias = Yii::app()->request->getParam('alias');
        $res = GoodsModel::model()->findAll('alias=:ali', array(':ali' => $alias));
        foreach ($res as $key => $value) {
            //获取年款车型
            $data[$key]['model'] = $value['name'];
            $data[$key]['year'] = $value['year'];
        }
        echo json_encode($data);
    }

    //选择后市场，下拉框显示所有后市场车系
    public function actionAllbcar() {
        $sql = "select distinct alias from goods_model";
        $res = Yii::app()->db->CreateCommand($sql)->queryAll();
//     	foreach($res as $key=>$value)
//     	{
//     		$data[$key]['alias']=$value['alias'];
//     	}
        $data = array_filter(CHtml::listData($res, 'alias', 'alias'));
        echo json_encode($data);
    }

    public function actionAddfrontmodel() {
        $year = Yii::app()->request->getParam('year');
        $model = Yii::app()->request->GetParam('model');
        $res = GoodsModel::model()->findByPk($model);
        $data['year'] = $res['year'];
        $data['model'] = $res['name'];
        echo json_encode($data);
    }

    //获取所有版本
    public function actionGetversion() {
        $goodsID = Yii::app()->request->getParam('goodsID');
        $result = MakeGoodsVersion::model()->findAll('goods_id=:goodID', array(':goodID' => $goodsID));
        foreach ($result as $key => $value) {
            $data[$key]['version_name'] = $value['version_name'];
        }
        echo json_encode($data);
    }

    //获取对应版本信息
    public function actionGetinfobyversion() {
        $organID = Commonmodel::getOrganID();
        $version_name = $_POST['version_name'];
        $goodsid = $_POST['goodsid'];
        //查询版本信息
        $versioninfo = MakeGoodsVersion::model()->find('goods_id=' . $goodsid . ' and version_name ="' . $version_name . '"');
        $data = array();
        if ($versioninfo) {
            $data['GoodsID'] = $versioninfo['goods_id'];
            $data['OE'] = $versioninfo['goods_oe'];
            //$data['Brand']=$versioninfo['goods_brand'];
            $data['version_name'] = $versioninfo['version_name'];
            $data['GoodsNo'] = $versioninfo['goods_no'];
            $data['GoodsName'] = $versioninfo['goods_name'];
            $data['BenchBrand'] = $versioninfo['benchmarking_brand'];
            $data['BenchNo'] = $versioninfo['benchmarking_sn'];
            $data['GoodsBrand'] = $versioninfo['goods_brand'];
            $data['GoodsCategory'] = $versioninfo['goods_category'];
            $data['MarkPrice'] = $versioninfo['marketprice'];
            $data['SalePrice'] = $versioninfo['salesprice'];
            $data['DiscountPrice'] = $versioninfo['discountprice'];
            $data['inventory'] = empty($versioninfo['inventory']) ? 0 : $versioninfo['inventory'];
            $data['Days'] = empty($versioninfo['senddays']) ? 0 : $versioninfo['senddays'];
            $data['Desc'] = $versioninfo['description'];
            $data['mainCategory'] = $versioninfo['maincategory'];
            $data['subCategory'] = $versioninfo['subcategory'];
            $data['leafCategory'] = $versioninfo['standard_id'];
            $data['carmodel'] = '';
            //车型
            $cmodel = MakeGoodsVehicle::model()->find('GoodsID=' . $versioninfo['goods_id'] . ' and VersionName="' . $versioninfo['version_name'] . '"');
            if ($cmodel)
                $data['carmodel'] = $cmodel->Name;
//            if($versioninfo['IsSale']==0)
//            {
//                $data['IsSale']='已上架';
//            }
//            else{
//                $data['IsSale']='已下架';
//            }
        }
        //查询参数值
        if (!empty($data['leafCategory'])) {
            $params = MakeGoodsValues::model()->findAll('standard_id=' . $data['leafCategory'] . ' and goods_id=' . $data['GoodsID'] . ' and version_name="' . $data['version_name'] . '"');

            $paramsvalue = array();
            foreach ($params as $param) {
                $k = $param['template_id'];
                $paramsvalue[$k] = $param['value'];
            }
        }
        //获取商品图片
        $goodsimage = array();
        $images = MakeGoodsImageRelation::model()->findAll('GoodsID=' . $goodsid . ' and OrganID=' . $organID);
        foreach ($images as $i) {
            if ($i['ImageUrl']) {
                $file = Yii::app()->params['uploadPath'] . $i['ImageUrl'];
                if (is_file($file)) {
                    $goodsimage[] = $i['ImageUrl'];
                }
            }
        }
        echo json_encode(array('versioninfo' => $data, 'paramsvalue' => $paramsvalue, 'imagesinfo' => $goodsimage));
    }

    public function actionGetimg() {
        $organID = Commonmodel::getOrganID();
        $goodsID = Yii::app()->request->getParam('goodsid');
        $result = MakeGoodsImageRelation::model()->findAll('GoodsID=:goodID and OrganID=:orgID', array(':goodID' => $goodsID, ':orgID' => $organID));
        foreach ($result as $key => $value) {
            $data[$key]['ID'] = $value['ID'];
            $data[$key]['ImageUrl'] = $value['ImageUrl'];
            $data[$key]['ImageName'] = $value['ImageName'];
        }
        echo json_encode($data);
    }

    public function actionDeleteimg() {
        $imageName = $_GET['xximage'];
        $goodsID = $_GET['goodsID'];
        $targetFile = Yii::app()->params['uploadPath'] . $imageName;
        $sql = "delete from tbl_make_goods_image_relation where ID= '$goodsID' ";
        $bools = DBUtil::execute($sql);
        $bool = false;
        if ($bools) {
            if (file_exists($targetFile)) {
                $bool = unlink($targetFile);
            }
            echo json_encode($bool);
            Yii::app()->end();
        } else {
            echo json_encode($bool);
            Yii::app()->end();
        }
    }

    public function actionIsdata() {
        $params = $_GET['params'];
        $datas = $this->getMakeGoods($params);
        if (empty($datas)) {
            echo json_encode(array('msg' => '对不起,无相关商品,不能导出'));
            Yii::app()->end();
        } else {
            echo json_encode(array('msg' => ''));
        }
    }

    public function actionExportgoods() {
        $params = $_GET['params'];
        $datas = $this->getMakeGoods($params);
        if (empty($datas)) {
            echo json_encode(array('msg' => '对不起,无相关商品,不能导出'));
            Yii::app()->end();
        }
        $standar = array();
        //导出excel表格
        //  $objPHPExcel = new PHPExcel();
        $sheet = 0;
        $data_goods = array();
        foreach ($datas as $key => $value) {
            if (!in_array($value['standard_id'], $standar)) {
                $standar[] = $value['standard_id'];
            }
            if (in_array($value['standard_id'], $standar)) {
                $data_goods[$value["standard_id"]][] = $value;
            }
        }
        //  var_dump($standar);
        //   var_dump($data_goods);Yii::app()->end();
        //导出excel表格
        $objPHPExcel = new PHPExcel();
        $sheet = 0;
        foreach ($data_goods as $key => $value) {
            if ($sheet == 0) {
                // 操作第一个工作表(默认是操作第一个)
                $objPHPExcel->setActiveSheetIndex($sheet);
            } else {
                $objPHPExcel->createSheet();
                $objActSheet = $objPHPExcel->setActiveSheetIndex($sheet);
            }
            //得到当前活动sheet(默认是第一个sheet)
            $objActSheet = $objPHPExcel->getActiveSheet();
            // 设置当前活动sheet的名称 
            $sheetTitle = $key;
            $objActSheet->setTitle($sheetTitle);
            // 获取要创建头部的数据
            $head = $this->goodshead($key);
            // 为每个sheet 创建头部Title
            $this->createHeader($objActSheet, $head);
            // 添加内容到excell中

            $line = 2;
            $headLen = count($head);
            foreach ($value as $goods) {     // 循环有几行数据
                $cell = 'A';
                $version_value = $this->getParamsValue($goods['goods_id'], $goods['NewVersion'], $goods['standard_id']);
                $new_goods = array_merge($goods, $version_value);
//                var_dump($new_goods);Yii::app()->end();
                foreach ($new_goods as $val) {   // 给每个单元格赋值
                    // echo $val['goods_name'].'---';Yii::app()->end();
                    $objActSheet->setCellValue($cell . $line, $val);
                    $cell++;
                }
                $line++;
//                for($i = 0; $i < $headLen; $i++){
//                     $objActSheet->setCellValue($cell .$line, $new_goods['goods_id']);
//                     $objActSheet->setCellValue($cell .$line, $new_goods['goods_no']);
//                     $objActSheet->setCellValue($cell .$line, $new_goods['goods_name']);
//                     $objActSheet->setCellValue($cell .$line, $new_goods['brand']);
//                     $objActSheet->setCellValue($cell .$line, $new_goods['cate']);
//                     $objActSheet->setCellValue($cell .$line, $new_goods['category']);
//                     $objActSheet->setCellValue($cell .$line, $new_goods['OENO']);
//                     $objActSheet->setCellValue($cell .$line, $new_goods['benchmarking_brand']);
//                     $objActSheet->setCellValue($cell .$line, $new_goods['benchmarking_sn']);
//                     $objActSheet->setCellValue($cell .$line, $new_goods['marketprice']);
//                     $objActSheet->setCellValue($cell .$line, $new_goods['salesprice']);
//                     $objActSheet->setCellValue($cell .$line, $new_goods['discountprice']);
//                     $objActSheet->setCellValue($cell .$line, $new_goods['inventory']);
//                     $objActSheet->setCellValue($cell .$line, $new_goods['senddays']);
//                     $objActSheet->setCellValue($cell .$line, $new_goods['description']);
//                     $objActSheet->setCellValue($cell .$line, $new_goods['IsSale']);
//                     $objActSheet->setCellValue($cell .$line, $new_goods['cars']);
//                     $objActSheet->setCellValue($cell .$line, $new_goods['NewVersion']);
////                     $objActSheet->setCellValue($cell .$line, $new_goods['s']);
////                     $objActSheet->setCellValue($cell .$line, $new_goods['goods_id']);
//                     $cell++;
//                }
//                 $line++;
            }

            $sheet++;
        }
        ob_end_clean();
        ob_start();
        header('Content-Type : application/vnd.ms-excel');
        $name = '导出商品-' . '库-' . date("Y-m-d");
        $name = iconv('utf-8', 'gbk', $name);
        header('Content-Disposition:attachment;filename="' . $name . '.xls"');
        $objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel5');
        $objWriter->save('php://output');



//        $objPHPExcel->setActiveSheetIndex($sheet);
//        //得到当前活动sheet(默认是第一个sheet)
//        $objActSheet = $objPHPExcel->getActiveSheet();
//        // 设置当前活动sheet的名称 
//        $objActSheet->setTitle($value['standard_id']);
//                $head = $this->goodshead($value['standard_id']);
//                $this->createHeader($objActSheet, $head);
//        ob_end_clean();
//        ob_start();
//        header('Content-Type : application/vnd.ms-excel');
//        header('Content-Disposition:attachment;filename="' . '商品-' . '模版-' . date("Y-m-d") . '.xls"');
//        $objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel5');
//        $objWriter->save('php://output');
    }

    /**
     * 标准名称不同生成不同的模版头部
     * @param type $standid
     */
    private function goodshead($standard_id) {

        $goodshead = array(
            'goods_id' => '商品ID', // 商品编号
            'goods_no' => '商品编号', // 商品编号
            'goods_name' => '商品名称', // 商品名称
            'brand' => '商品品牌', // tbl_make_goods
            'cate' => '商品类别', // tbl_make_goods
            'category' => '标准名称', // 配件品类
            'OENO' => 'OE号', // 配件品类
            'cars' => '适用车型', // 备注
            'benchmarking_brand' => '标杆品牌', // 标杆品牌
            'benchmarking_sn' => '标杆商品号', // 标杆商品号
//            'marketprice' => '市场指导价', // 市场指导价
//            'salesprice' => '销售价', // 销售价
//            'discountprice' => '优惠价', // 优惠价
            'inventory' => '库存', // 库存
            'senddays' => '发货天数', // 发货天数
            'description' => '备注', // 备注
            'IsSale' => '上/下架', // 上/下架
            'NewVersion' => '商品版本号', // 版本号
        );
        $organID = Commonmodel::getOrganID();
        $datas = MakeGoodsTemplate::model()->findAll('organID=' . $organID . ' and ISdelete="N" and standard_id=' . $this->cpnameID($standard_id));
        $paramsname = array();  // 参数名称
        if ($datas) {
            foreach ($datas as $data) {
                $paramsname['s' . $data['id']] = $data['name'];
            }
        }
        $head = array_merge($goodshead, $paramsname);
        return $head;
    }

    /*     * *
     * 创建头部Title
     */

    private function createHeader($objActSheet, $head) {
        $cell = 'A';
        foreach ($head as $k => $value) {
            //$num=4;
            //设置单元格宽度
            $objActSheet->getColumnDimension($cell)->setWidth(15);
            $objActSheet->setCellValue($cell . '1', $value);
            //设置边框
            $objActSheet->getStyle($cell . '1')->getFont()->setBold(true);
            $objActSheet->getStyle($cell . '1')->getBorders()->getTop()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
            $objActSheet->getStyle($cell . '1')->getBorders()->getBottom()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
            $objActSheet->getStyle($cell . '1')->getBorders()->getLeft()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
            $objActSheet->getStyle($cell . '1')->getBorders()->getRight()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);

            $objActSheet->getStyle($cell . '1')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
            $objActSheet->getStyle($cell . '1')->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);
            $cell++;
        }

        //设置行高
        $objActSheet->getDefaultRowDimension()->setRowHeight(25);
        // 字体加粗
        $objActSheet->getStyle('A1:' . $cell . '1')->getFont()->setBold(true);
        //设置居中
        $objActSheet->getStyle('A1:' . $cell . '1')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
        $objActSheet->getStyle('A1:' . $cell . '1')->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);
        // 设置字体颜色
        $objActSheet->getStyle('A1:' . $cell . '1')->getFont()->getColor()->setARGB(PHPExcel_Style_Color::COLOR_RED);
    }

    private function getMakeGoods($params) {
        $organID = Commonmodel::getOrganID();
        $sql = "select distinct a.id as goodsID ,b.goods_category as category_id,b.goods_oe as OE,b.goods_brand as brand,b.organID,
		 	    a.NewVersion as version_name,b.goods_no as goodsno,b.goods_name as goodsname,
                b.benchmarking_brand,b.benchmarking_sn,b.marketprice,b.salesprice,b.discountprice,a.create_time,"
                . " b.inventory as inventory,b.senddays,b.description,a.IsSale,b.maincategory,b.subcategory,b.standard_id"
                . " from  tbl_make_goods a ,tbl_make_goods_version b"
                . '  where a.id=b.goods_id and a.NewVersion=b.version_name'
                . "  and a.ISdelete='0' and b.ISdelete=0"
                . "  and a.organID='$organID' ";
        if ($params) {
            //$params = $_GET['params'];
            $goodsno = isset($params['goodsno']) ? trim($params['goodsno']) : '';
            $goodsname = isset($params['goodsname']) ? trim($params['goodsname']) : '';
            $oenum = isset($params['oe']) ? trim($params['oe']) : '';
            $issale = isset($params['issale']) ? trim($params['issale']) : '';
            if (!empty($goodsname)) {
                $sql.=" and b.goods_name like'%$goodsname%'";
            }
            //OE号搜索
            if (!empty($oenum)) {
                $sql.=" and b.goods_oe like'%$oenum%'";
            }
            //商品编号搜索
            if (!empty($goodsno)) {
                $sql.=" and b.goods_no like '%$goodsno%'";
            }
            //配件品类搜索
            if (!empty($params['standardid'])) {
                $sql.=' and b.standard_id=' . $params['standardid'];
            } elseif (!empty($params['subcategory'])) {
                $sql.=' and b.standard_id in( select id from tbl_gcategory where parent_id=' . $params['subcategory'] . ')';
            } elseif (!empty($params['maincategory'])) {
                $sql.=' and b.standard_id in( select id from `tbl_gcategory` where parent_id in(SELECT id FROM `tbl_gcategory` where parent_id=' . $params['maincategory'] . '))';
            }
            //添加时间查询
            if (!empty($params['begintime'])) {
                $sql.=' and a.create_time>=' . strtotime($params['begintime']);
            }
            if (!empty($params['endtime'])) {
                $endtime = strtotime($params['endtime']) + 3600 * 24 - 1;
                $sql.=' and a.create_time<=' . $endtime;
            }
            //商品类别搜索
            if (!empty($params['goodscategory'])) {
                $sql.=' and b.goods_category=' . $params['goodscategory'];
            }
            //品牌搜索
            if (!empty($params['goodsbrand'])) {
                $sql.=' and b.goods_brand=' . $params['goodsbrand'];
            }
            //是否上架查询
            if (is_numeric($issale)) {
                $sql.=" && a.IsSale='$issale'";
            }
        }
        $sql.="  group by a.id order by a.id desc";
        $datas = DBUtil::queryAll($sql);
        $data = array();
        foreach ($datas as $key => $value) {
            $data[$key]['goods_id'] = $value['goodsID'];
            $data[$key]['goods_no'] = $value['goodsno'];
            $data[$key]['goods_name'] = $value['goodsname'];
            $data[$key]['brand'] = $this->getgoodsBrand($value['brand']); //$value['goods_brand'];
            $data[$key]['cate'] = $this->getgoodsCate($value['category_id']); // $value['goods_category'];
            $data[$key]['standard_id'] = $this->cpname($value['standard_id']); //$value['standard_id'];
            $data[$key]['OENO'] = $value['OE'];
            $data[$key]['cars'] = $this->getmodel($organID, $value['goodsID'], $value['version_name']);
            $data[$key]['benchmarking_brand'] = $value['benchmarking_brand'];
            $data[$key]['benchmarking_sn'] = $value['benchmarking_sn'];
//            $data[$key]['marketprice'] = $value['marketprice'] ? $value['marketprice'] . '元' : '0';
//            $data[$key]['salesprice'] = $value['salesprice'] ? $value['salesprice'] . '元' : '0';
//            $data[$key]['discountprice'] = $value['discountprice'] ? $value['discountprice'] . '元' : '0';
            $data[$key]['inventory'] = $value['inventory']==1?'有':'无';
            $data[$key]['senddays'] = $value['senddays'] . '天';
            $data[$key]['description'] = $value['description'];
            $data[$key]['IsSale'] = $value['IsSale'] ? '下架' : '上架';
            $data[$key]['NewVersion'] = $value['version_name'];
        }
        return $data;
    }

    //获取车型
    private function getmodel($organID, $GoodsID, $version_name) {
        $organID = Commonmodel::getOrganID();
        $sql = "select name from tbl_make_goods_vehicle where organID=$organID and GoodsID= $GoodsID and VersionName='$version_name'";
        $data = DBUtil::query($sql);
        if ($data) {
            return $data['name'];
        } else {
            return '';
        }
    }

    // 获取标准名称值
    private function cpname($standard_id) {
        $sql = 'select name from tbl_gcategory where id=' . $standard_id;
        $data = DBUtil::query($sql);
        if ($data) {
            return $data['name'];
        } else {
            return '';
        }
    }

    // 获取标准名称ID
    private function cpnameID($standard) {
        if (!$standard) {
            return 0;
        }
        $sql = "select id from tbl_gcategory where name='{$standard}'  limit 1";
        $data = DBUtil::query($sql);
        if ($data) {
            return $data['id'];
        } else {
            return '0';
        }
    }

    // 获取品牌名称
    private function getgoodsBrand($brand_id) {
        $sql = 'select BrandName from tbl_make_goods_brand where BrandID=' . $brand_id;
        $data = DBUtil::query($sql);
        if ($data) {
            return $data['BrandName'];
        } else {
            return '';
        }
    }

    // 获取类别名称
    private function getgoodsCate($category_id) {
        $sql = 'select name from tbl_make_goods_category where id=' . $category_id;
        $data = DBUtil::query($sql);
        if ($data) {
            return $data['name'];
        } else {
            return '';
        }
    }

    // 获取参数值
    private function getParamsValue($goodsID, $vesion_id, $standard_id) {
        $standard_id = $this->cpnameID($standard_id);
        $sql = "SELECT a.value FROM tbl_make_goods_values a where a.goods_id = $goodsID and a.version_name = '{$vesion_id}' AND a.standard_id = $standard_id";
        $data = DBUtil::queryAll($sql);
        $paramsvalue = array();  // 参数名称
        if ($data) {
            foreach ($data as $value) {
                $paramsvalue[] = $value['value'];
            }
        }
        return $paramsvalue;
    }

    /**
     * 批量上传商品
     */
    public function actionUploadgoods() {
        $this->pageTitle = Yii::app()->name . '-' . "商品管理";
        //文件模板为product
        $template = "makergoods";
        $userID = Yii::app()->user->id;
        $organID = Commonmodel::getOrganID();
        //上传文件
        if ($_POST['leadExcel'] == "true") {
            $filename = rand(1000, 10000) . Yii::app()->user->id . strrchr($_FILES['inputExcel']['name'], '.');
//            $filename = iconv("utf-8", "gb2312", $_FILES['inputExcel']['name']);
            $tmp_name = $_FILES['inputExcel']['tmp_name'];
            //$filePath = dirname(Yii::app()->BasePath) . "/themes/default/uploadsfile/dealer/execl/";
            $filePath = Yii::app()->params['uploadPath'] . 'maker/excel/' . $organID . '/';
          
            $upload_result = UploadsFile::uploadFile($filename, $tmp_name, $filePath);

            //如果上传成，则解析Excel文件
            if ($upload_result['success']) {
                //解析Excel文件，返回结果为错误消息，如果不为空则表明发生错误
                $uploadfile = $upload_result['uploadfile'];
                $dataImport = new MakeGoodsImport();
                $dataImport->GoodsHeadArr(Yii::app()->request->getParam('importCategory'));
                $createtime = time();
                $data = array(
                    'OrganID' => $organID,
                    'UserID' => $userID,
                    'CreateTime' => $createtime,
                );
                $result = $dataImport->parse($uploadfile, $template, $data);
                //如果不成功则返回错误结果
                if ($result['success'] == false) {
                    echo json_encode(array('message' => $result['error'], 'success' => false));
                    Yii::app()->end();
                }
                $templaterRows = $result['templaterRows'];
                $Sdata = $result['Sdata'];
//                $bool = false;
                $message = array();

                if ($Sdata && $templaterRows) {
                    $Cpname = DealerCpname::model()->find("OrganID=:organID and CpNameID=:CpNameID", array(':organID' => $organID, ":CpNameID" => Yii::app()->request->getParam('importCategory')));
                    $com = 0;
                    $errkey = 0;

                    //调用商品编号验证唯一性
                    $res = $this->checkgoodno();
                    $version_sql = "insert into  tbl_make_goods_version (
                        version_name, organID,userID,goods_oe,
                        goods_brand,goods_id,goods_no,goods_name,benchmarking_brand,benchmarking_sn,
                        standard_id,inventory,senddays,description
                        )  values";

                    $value_sql = "insert into tbl_make_goods_values (organID,userID,standard_id,value,version_name,goods_id,template_id)
                        values";
                    $excel_no = array();
                    foreach ($Sdata as $key => $dval) {
                        $makegoods = new MakeGoods();
                        $makegoodsvesion = new MakeGoodsVersion();
                        $vesionAtt = $makegoodsvesion->attributes;
                        $arr = array();
                        $continue = false;
                        $k = 0;
                        $dval[$k] = ltrim($dval[$k]);
                        if (in_array($dval[$k], $res)) {
                            $message[$errkey] = "第" . ($com + 1) . "条数据导入失败　原因：商品编号已存在";
                            $errkey++;
                            $continue = true;
                        }
                        if (!empty($excel_no) && in_array($dval[$k], $excel_no)) {
                            $message[$errkey] = "第" . ($com + 1) . "条数据导入失败　原因：Excel表格中有重复的商品编号";
                            $errkey++;
                            $continue = true;
                        }
                        if (empty($dval[$k])&&$dval[$k]!=0) {
                            $message[$errkey] = "第" . ($com + 1) . "条数据导入失败　原因：商品编号为空";
                            $errkey++;
                            $continue = true;
                        }
                        foreach ($templaterRows as $pkey => $pval) {

//                             if ($pval == 'goods_no') {
//                                 $dval[$k] = ltrim($dval[$k]);
//                                 if (empty($dval[$k])) {
//                                     $message[$errkey] = "第" . ($com + 1) . "条数据导入失败　原因：商品编号为空";
//                                     $errkey++;
//                                     $continue = true;
//                                 } else {
//                                 	if(in_array($dval[$k],$res))
//                                 	{
//                                 		$message[$errkey] = "第" . ($com + 1) . "条数据导入失败　原因：商品编号已存在";
//                                 		$errkey++;
//                                 	    $continue = true;
//                                 	}
//                                    // $ifcontinue = MakeGoodsVersion::model()->find("goods_no=:NO and ISdelete=0 and organID=:organID", array(":NO" => $dval[$k],':organID'=>$organID));
//                                 }
//                             }
//                             if (!empty($ifcontinue)) {
//                                 $message[$errkey] = "第" . ($com + 1) . "条数据导入失败　原因：商品编号已存在";
//                                 $errkey++;
//                                 $continue = true;
//                             }
//                             $ifcontinue = "";
                            if ($pval == 'goods_name') {
                                $dval[$k] = ltrim($dval[$k]);
                                if (empty($dval[$k])&&$dval[$k]!=0) {
                                    $message[$errkey] = "第" . ($com + 1) . "条数据导入失败　原因：商品名称为空";
                                    $errkey++;
                                    $continue = true;
                                }
                            }
                            if ($pval == 'goods_oe') {
                                $dval[$k] = ltrim($dval[$k]);
                                $dval[$k] = str_replace("，", ",", $dval[$k]);
                                if (empty($dval[$k])&&$dval[$k]!=0) {
                                    $message[$errkey] = "第" . ($com + 1) . "条数据导入失败　原因：商品OE号为空";
                                    $errkey++;
                                    $continue = true;
                                }
                            }
                            if (substr($pval, 0, 1) == '_') {
                                $pval = substr($pval, 1);
                                $arr[$k]['value'] = $dval[$k];
                                $arr[$k]['template_id'] = $pval;
                            } else {
                                if ($pval == 'brand') {
                                    $vesionAtt["goods_brand"] = $this->getBrandID($dval[$k]);
                                } elseif ($pval == 'inventory') {
                                    if ($dval[$k] == '有') {
                                        $vesionAtt[$pval] = 1;
                                    } else {
                                        $vesionAtt[$pval] = 0;
                                    }
                                } else {
                                    $vesionAtt[$pval] = $dval[$k];
                                }
                            }
                            $k++;
                        }
                        $com++;
                        if ($continue) {
                            continue;
                        }
                        $excel_no[$k] = $dval[$k];
                        //$makegoodsvesion->attributes = $vesionAtt;
                        $time = time();
                        $goods_sql = "insert into tbl_make_goods (create_time,updatetime,organID,userID,NewVersion)
								value ($time,$time,$organID,$userID,'V1.0.0')";
                        $goods_res = DBUtil::execute($goods_sql);
                        $a = 1;
                        $lastGoodsID = Yii::app()->db->getLastInsertID();
                        if ($goods_res) {
                            $a = 2;
                            //执行版本表
                            $version_sql.=" ('V1.0.0',$organID,$userID,'$vesionAtt[goods_oe]','$vesionAtt[goods_brand]',$lastGoodsID,
								'$vesionAtt[goods_no]','$vesionAtt[goods_name]','$vesionAtt[benchmarking_brand]',
                        	   '$vesionAtt[benchmarking_sn]',$Cpname->CpNameID,'$vesionAtt[inventory]','$vesionAtt[senddays]'
                        	   ,'$vesionAtt[description]'),";

                            //生产参数值sql
                            foreach ($arr as $kv => $vval) {
                                $value_sql.=" ($organID,$userID,'$Cpname->CpNameID','$vval[value]','V1.0.0','$lastGoodsID','$vval[template_id]'),";
                            }
                            //插入适用车型
                            if($vesionAtt[carmodel]||$vesionAtt[carmodel]==0)
                            {
                                $pinyin=F::pinyin1($vesionAtt[carmodel]);
                                $carmodel_sql = "insert into tbl_make_goods_vehicle (CreateTime,UpdateTime,OrganID,UserID,VersionName,GoodsID,`Name`,PinYin)
                                                                    value ($time,$time,$organID,$userID,'V1.0.0',$lastGoodsID,'$vesionAtt[carmodel]','$pinyin')";
                                $carmodel_res = DBUtil::execute($carmodel_sql);
                            }
                            
                        }
                    }
                }
                if ($a == 2) {
                    $version_sql = rtrim($version_sql, ",");
                    $version_sql=  preg_replace('/\\\/', '/', $version_sql);
                    $version_res = DBUtil::execute($version_sql . ';');
                    $value_sql = rtrim($value_sql, ",");
                    $value_sql=  preg_replace('/\\\/', '/', $value_sql);
                    $value_res = DBUtil::execute($value_sql . ';');
                }
//                $insert_sql = $result['sql'];
//
//                $sql_result = DBUtil::execute($insert_sql);
                //如果SQL执行不成功则返回错误结果
                if (!empty($message)) {
//                    foreach ($message as $key => $val) {
//                        $resDa.="<span class='errcolor'>$val</span><br>";
//                        
//                    }
                    echo json_encode(array('success' => false, 'message' => $message));
                    Yii::app()->end();
                } else { // 上传成功，则把上传成功的数据展示出来
                    echo json_encode(array('success' => true, 'message' => '导入商品成功'));
                    Yii::app()->end();
                }
            } else {
                $message = $upload_result['error'];
                echo json_encode(array('success' => false, 'message' => $message));
                Yii::app()->end();
            }
        }
    }

    // 获取临时表中的数据
    public function actionGetmakegoodstemp() {
        $userID = Yii::app()->user->id;
        $organID = Commonmodel::getOrganID();
//        $userID = $_GET['userID'];
//        $organID = $_GET['OrganID'];
        $sql = "select * from tbl_make_goods_temp where OrganID = " . $organID . ' and UserID = ' . $userID;
        // echo $sql;
        $datas = DBUtil::queryAll($sql);
        $data = array();
        foreach ($datas as $key => $value) {
            $data[$key]['goods_id'] = $value['id'];
            $data[$key]['goods_no'] = $value['goods_no'];
            $data[$key]['goods_name'] = $value['goods_name'];
            $data[$key]['brand'] = $value['brand']; //$value['goods_brand'];
            $data[$key]['cate'] = $value['category']; // $value['goods_category'];
            //   $data[$key]['standard_id'] = $this->cpname($value['standard_id']); //$value['standard_id'];
            $data[$key]['benchmarking_brand'] = $value['benchmarking_brand'];
            $data[$key]['benchmarking_sn'] = $value['benchmarking_sn'];
            $data[$key]['marketprice'] = $value['marketprice'];
            $data[$key]['salesprice'] = $value['salesprice'];
            $data[$key]['discountprice'] = $value['discountprice'];
            $data[$key]['inventory'] = $value['inventory'];
            $data[$key]['senddays'] = $value['senddays'];
            $data[$key]['description'] = $value['description'];
        }
        echo json_encode($data);
    }

    // 保存修改临时表的数据
    public function actionSavecell() {
        $ID = $_GET['ID'];
        $fieldName = $_GET['fieldName'];
        $change = $_GET['change'];

        $bool = MakeGoodsTemp::model()->updateByPk($ID, array(
            $fieldName => $change,
        ));
        echo $bool;
    }

    // 把临时表的数据导入到商品表
    public function actionImportgoods() {
        $userID = Yii::app()->user->id;
        $organID = Commonmodel::getOrganID();
        $sql = "select * from tbl_make_goods_temp where OrganID = " . $organID . ' and UserID = ' . $userID;
        $datas = DBUtil::queryAll($sql);
        $bool = false;
        foreach ($datas as $value) {

            if (!empty($value['goods_no'])) {
                $res = MakeGoodsVersion::model()->findAll('goods_no=:goodsno and organID=:organID', array(':goodsno' => $value['goods_no'], ':organID' => $organID));
                if (count($res) > 0) {
                    echo json_encode(array('errMsg' => '商品编号重复,请重新填写', 'success' => false));
                    Yii::app()->end();
                }
            }

            $makegoods = new MakeGoods();
            $makegoods->NewVersion = '001';
            $makegoods->organID = $organID;
            $makegoods->userID = $userID;
            $makegoods->create_time = time();
            $makegoods->IsSale = 0;
            $makegoods->ISdelete = 0;
            if ($makegoods->save()) {
                $bool = true;
                $lastGoodsID = Yii::app()->db->getLastInsertID();
                $makegoodsvesion = new MakeGoodsVersion();
                $makegoodsvesion->version_name = '001';
                $makegoodsvesion->organID = $organID;
                $makegoodsvesion->userID = $userID;
                $makegoodsvesion->goods_id = $lastGoodsID;
                $makegoodsvesion->goods_brand = $this->getBrandID($value['brand']); //$value['brand'];
                $makegoodsvesion->goods_no = $value['goods_no'];

                $makegoodsvesion->goods_name = $value['goods_name'];
                $makegoodsvesion->benchmarking_brand = $value['benchmarking_brand'];
                $makegoodsvesion->benchmarking_sn = $value['benchmarking_sn'];
                $makegoodsvesion->standard_id = $this->cpnameID($value['category']); //$value['category'];
                $makegoodsvesion->marketprice = $value['marketprice'];
                $makegoodsvesion->salesprice = $value['salesprice'];
                $makegoodsvesion->discountprice = $value['discountprice'];
                $makegoodsvesion->inventory = $value['inventory'];
                $makegoodsvesion->senddays = $value['senddays'];
                $makegoodsvesion->description = $value['description'];
                $makegoodsvesion->ISdelete = 0;
                if ($makegoodsvesion->save()) {
                    MakeGoodsTemp::model()->deleteByPk($value['id']);
                }
            }
        }
        if ($bool) {
            echo json_encode(array('success' => $bool, 'errMsg' => '导入商品数据成功'));
        } else {
            echo json_encode(array('success' => $bool, 'errMsg' => '导入商品数据失败'));
        }
    }

    // 获取品牌ID
    private function getBrandID($baranname) {
        $organID = Commonmodel::getOrganID();
        $sql = "SELECT BrandID AS id FROM `tbl_make_goods_brand` WHERE BrandName='{$baranname}' and OrganID={$organID} limit 1";
        $data = DBUtil::query($sql);
        if ($data) {
            return $data['id'];
        } else {
            return '';
        }
    }

    // 删除临时表的数据
    public function actionDeletemakegoodstemp() {
        $userID = Yii::app()->user->id;
        $organID = Commonmodel::getOrganID();
        $sql = "delete  from tbl_make_goods_temp where OrganID = " . $organID . ' and UserID = ' . $userID;
        $bool = DBUtil::execute($sql);
        if ($bool) {
            echo json_encode(array('success' => $bool, 'errMsg' => '导入的商品没有上传到系统'));
        } else {
            echo json_encode(array('success' => $bool, 'errMsg' => '检测您导入的商品'));
        }
    }

    //修改时判断是否与最新版本相同
    public function checkrepeat($goodsid, $version) {
        $res = array();
        $verinfo = MakeGoodsVersion::model()->find('goods_id=' . $goodsid . ' and version_name="' . $version . '"');
        $column = array();
        if ($verinfo) {
            $res['BenchBrand'] = $verinfo['benchmarking_brand'];
            $res['BenchNo'] = $verinfo['benchmarking_sn'];
            $res['Days'] = $verinfo['senddays'];
            $res['Desc'] = $verinfo['description'];
            //$res['DiscountPrice']=$verinfo['discountprice'];
            $res['GoodsBrand'] = $verinfo['goods_brand'];
            $res['GoodsCategory'] = $verinfo['goods_category'];
            $res['GoodsName'] = $verinfo['goods_name'];
            $res['GoodsNo'] = $verinfo['goods_no'];
            //查询车型
            $cmodel = MakeGoodsVehicle::model()->find('GoodsID=' . $goodsid . ' and VersionName="' . $version . '"');
            $res['carmodel'] = '';
            if ($cmodel)
                $res['carmodel'] = $cmodel->Name;
            //$res['MarkPrice']=$verinfo['marketprice'];
            $res['OE'] = $verinfo['goods_oe'];
            //$res['SalePrice']=$verinfo['salesprice'];
            $res['inventory'] = $verinfo['inventory'];
            $res['leafCategory'] = $verinfo['standard_id'];
            //$res['mainCategory']=$verinfo['maincategory'];
            //$res['subCategory']=$verinfo['subcategory'];
            $res['version_name'] = $verinfo['version_name'];
            //标准名称参数
            $params = MakeGoodsValues::model()->findAll('standard_id=' . $res['leafCategory'] . ' and goods_id=' . $goodsid . ' and version_name="' . $res['version_name'] . '"');
            foreach ($params as $param) {
                $k = $param['template_id'];
                $column[$k] = $param['value'];
            }
        }
        return array('baseinfo' => $res, 'column' => $column);
    }

    // 删除预览商品
    public function actiondeleteprev() {
        $goodsID = $_GET['goodsID'];
        $bool = MakeGoodsTemp::model()->deleteByPk($goodsID);
        echo $bool;
    }

    //添加图片
    public function actionAdding() {
        $urlimg = explode(',', $_GET['urlimg']); //根据逗号拆分，得到图片信息的字符串
        $organID = Commonmodel::getOrganID();
        $sql = "insert into tbl_make_goods_image_relation (OrganID,GoodsID,ImageUrl,CreateTime,ImageName) values";
        foreach ($urlimg as $k => $value) {
            if ($value) {//去掉初始值0
                $addimg = explode(';', $value); //根据分号拆分，得到图片的相关信息
                if ($k != 1) {
                    $sql .=",";
                }
                $sql .="(";
                $sql .=$organID;
                $sql .=",";
                $sql .=$addimg[1]; //商品ID
                $sql .=",'";
                $sql .=$addimg[0]; //图片url
                $sql .="',";
                $sql .=time();
                $sql .=",'";
                $sql .=$addimg[2]; //图片原名
                $sql .="')";
            }
        }
        if (DBUtil::execute($sql)) {
            $rs = array('success' => 1, 'errorMsg' => '图片上传成功');
        } else {
            $rs = array('success' => 0, 'errorMsg' => '图片上传失败');
        }
        echo json_encode($rs);
    }

    //查询已添加的图片地址
    public function actionGeturl() {
        $organID = Commonmodel::getOrganID();
        $GoodsID = $_GET['GoodsID'];
        $sql = "select ImageUrl,ImageName from tbl_make_goods_image_relation where OrganID=" . $organID . " and GoodsID=" . $GoodsID;
//         $data = DBUtil::queryAll($sql);
        $data = DBUtil::queryAll($sql) ? DBUtil::queryAll($sql) : 0;
        echo json_encode($data);
        ;
    }

    //查询添加的图片商品ID Name
    public function actionGetID() {
        $organID = Commonmodel::getOrganID();
        $aa = explode('#', $_GET['Name']);
        $GoodsNO = $aa[0];
        $sql = "select ID as GoodsID,Name as GoodsName,GoodsNO from {{dealer_goods}} where OrganID=" . $organID . " and GoodsNO='" . $GoodsNO . "'";
        $data = DBUtil::query($sql);
        echo json_encode($data);
        ;
    }

    //根据商品删除图片
    public function actionDelImgGoods() {
        $organID = Commonmodel::getOrganID();
        $GoodsID = $_GET['goodsid'];
//         $model =  DealerGoodsImageRelation::model()->deleteAll("OrganID= '$organID' and GoodsID='$GoodsID'");
        $model = MakeGoodsImageRelation::model()->deleteAll("OrganID= '$organID' and GoodsID='$GoodsID'");
        if ($model) {
            $model = 1;
        }
        echo json_encode($model);
    }

// 删除单个图片
    public function actionDeleteimga() {
        $imageName = $_GET['xximage'];
        $targetFile = Yii::app()->params['uploadPath'] . $imageName;
        $sql = "delete from tbl_make_goods_image_relation where ImageUrl= '$imageName' ";
        $bools = DBUtil::execute($sql);
        $bool = false;
        if ($bools) {
            if (file_exists($targetFile)) {
                $bool = unlink($targetFile);
            }
            echo json_encode($bool);
            Yii::app()->end();
        } else {
            echo json_encode($bool);
            Yii::app()->end();
        }
    }

    //查询所有商品编号
    private function checkgoodno() {
        $organID = Commonmodel::getOrganID();
        $sql = "select a.id, b.goods_no from tbl_make_goods a,tbl_make_goods_version b 
    	where a.organID=$organID and a.IsSale='0' and a.ISdelete='0' 
    	and a.id=b.goods_id and a.NewVersion=b.version_name and b.organID=$organID 
    	and b.ISdelete='0'
    	";
        $datas = array();
        $res = DBUtil::queryAll($sql);
        foreach ($res as $key => $val) {
            $datas[$val['id']] = $val['goods_no'];
        }
        return $datas;
    }

}
