<?php

Class MakepriceController extends Controller {

    public $layout = '//layouts/maker';

    /**
     * 客户类别管理列表页面
     */
    public function actionIndex() {
        $this->pageTitle = Yii::app()->name . '-' . '客户类别官理';
        $OrganID = Commonmodel::getOrganID();
        $count = MakeType::model()->count("OrganID=:ID", array(":ID" => $OrganID));
        $this->render('index', array(
            "count" => $count
        ));
    }

    /*
     * 客户类别管理列表信息
     */

    public function actionTypelist() {
        $OrganID = Commonmodel::getOrganID();
        $model = MakeType::model()->findAll("OrganID=:ID", array(":ID" => $OrganID));
        $sql = "SELECT count(*) as num,CustomerType FROM `tbl_make_promit_brand` where OrganID={$OrganID} GROUP BY CustomerType";
        $result = DBUtil::queryAll($sql);
        $typeArr = array();
        foreach ($result as $v) {
            $typeArr[$v['CustomerType']] = $v['num'];
        }
        foreach ($model as $key => $value) {
            $data[$key] = $value->attributes;
            //修正客户类别表中的客户数
            if (array_key_exists($value['ID'], $typeArr)) {
                if ($value['TypeQuantity'] != $typeArr[$value['ID']]) {
                    $data[$key]['TypeQuantity'] = $typeArr[$value['ID']];
                    MakeType::model()->updateByPk($value['ID'], array('TypeQuantity' => $typeArr[$value['ID']]));
                }
            } else {
                if ($value['TypeQuantity'] != 0) {
                    $data[$key]['TypeQuantity'] = 0;
                    MakeType::model()->updateByPk($value['ID'], array('TypeQuantity' => 0));
                }
            }
            if ($value->IsDefault == 1) {
                $data[$key]['Default'] = "<a style='font-weight:bold;color:red;cursor:pointer;' title='默认类别：提供非授权经销商交易价格'>是</a>";
            } else {
                $data[$key]['Default'] = '否';
            }
        }
        $rs = array(
            'total' => count($data),
            'rows' => $data ? $data : array()
        );
        echo json_encode($rs);
    }

    /*
     * 添加客户类别
     */

    public function actionAddtype() {
        $OrganID = Commonmodel::getOrganID();
        $model = MakeType::model()->find(array("condition" => "OrganID = $OrganID AND TypeName = '{$_POST['TypeName']}'"));
        if (!empty($model)) {
            $result['errorMsg'] = "该客户类别已存在!";
        } else {
            unset($model);
            //添加客户类别
            $model = new MakeType();
            $model->attributes = $_POST;
            $model->OrganID = $OrganID;
            $model->IsDefault = isset($_POST['IsDefault']) ? $_POST['IsDefault'] : 1;
            $model->TypeQuantity = 0;      //客户数默认为0
            $model->CreateTime = time();
            $model->UpdateTime = time();
            $bool = $model->save();
            if ($bool == 1) {
                //修改默认客户类别
                $InsertID = $model->attributes['ID'];
                if ($_POST['IsDefault'] == 1) {
                    MakeType::model()->updateAll(array(
                        "IsDefault" => 0,
                        "UpdateTime" => time()
                            ), "OrganID = " . $OrganID . " AND ID != " . $InsertID);
                }
                $result['success'] = "客户类别添加成功!";
            } else {
                $result['errorMsg'] = "系统异常，客户类别添加失败!";
            }
        }
        echo json_encode($result);
    }

    /*
     * 修改客户类别
     */

    public function actionEdittype() {
        $OrganID = Commonmodel::getOrganID();
        $model = MakeType::model()->find(array("condition" => "OrganID = $OrganID AND ID != {$_GET['ID']} AND TypeName = '{$_POST['TypeName']}'"));
        if (!empty($model)) {
            $result['errorMsg'] = "该客户类别已存在!";
        } else {
            unset($model);
            if ($_POST['IsDefault'] == 1) {
                $count = MakeType::model()->find(array("condition" => "OrganID = $OrganID AND TypeName = '{$_POST['TypeName']}'"))->attributes;
                if ($count['TypeQuantity'] != 0) {
                    $result['errorMsg'] = "该客户类别已关联授权经销商，暂时无法设置默认!";
                } else {
                    $bool = MakeType::model()->updateByPk($_GET['ID'], array(
                        "TypeName" => $_POST['TypeName'],
                        "TypeDesc" => $_POST['TypeDesc'],
                        "IsDefault" => isset($_POST['IsDefault']) ? $_POST['IsDefault'] : 1,
                        "UpdateTime" => time()
                            ));
                    if ($bool == 1) {
                        //修改默认客户类别
                        MakeType::model()->updateAll(array(
                            "IsDefault" => 0,
                            "UpdateTime" => time()
                                ), "OrganID = " . $OrganID . " AND ID != " . $_GET['ID']);
                        $result['success'] = "客户类别添加成功!";
                    } else {
                        $result['errorMsg'] = "系统异常，客户类别编辑失败!";
                    }
                }
            } else {
                $bool = MakeType::model()->updateByPk($_GET['ID'], array(
                    "TypeName" => $_POST['TypeName'],
                    "TypeDesc" => $_POST['TypeDesc'],
                    "IsDefault" => isset($_POST['IsDefault']) ? $_POST['IsDefault'] : 1,
                    "UpdateTime" => time()
                        ));
                if ($bool == 1) {
                    $result['success'] = "客户类别添加成功!";
                } else {
                    $result['errorMsg'] = "系统异常，客户类别编辑失败!";
                }
            }
        }
        echo json_encode($result);
    }

    /*
     * 删除客户类别
     */

    public function actionDestorytype() {
        $bool = MakeType::model()->deleteByPk($_POST['ID'], 'TypeQuantity=:TypeQuantity and IsDefault!=:IsDefault', array('TypeQuantity' => 0, 'IsDefault' => 1));
        if ($bool == 1) {
            $result['success'] = "客户类别删除成功!";
        } else {
            $result['errorMsg'] = "系统异常，客户类别删除失败!";
        }
        echo json_encode($result);
    }

    /*
     * 客户价格管理
     */

    public function actionPrice() {
        $organID = Commonmodel::getOrganID();
        $this->pageTitle = Yii::app()->name . '-客户价格管理';
        //客户类别
        $result = $this->getCustomtype();
        foreach ($result as $v) {
            $type[$v['TypeID']] = $v;
        }
        //商品品牌
        $cate = MakeGoodsBrand::model()->findAll('OrganID=:organID and UserID=:userID', array(':organID' => $organID, 'userID' => $organID));
        $this->render('price', array('type' => $type, 'cate' => $cate));
    }

    //获取客户类别
    public function getCustomtype() {
        $organID = Commonmodel::getOrganID();
        $sql = "select ID as TypeID,TypeName from tbl_make_type where OrganID=:organID order by IsDefault desc";
        $sqlParams = array(':organID' => $organID);
        $result = DBUtil::queryAll($sql, $sqlParams);
        if (!$result) {
            echo '<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />';
            echo "<script>alert('请先设置客户类别');window.location.href='" . Yii::app()->createUrl('maker/makeprice/index') . "'</script>";
            exit;
        } else {
            return $result;
        }
    }

    //ajax调用获得客户类别
    public function actionGetctype() {
        $result = $this->getCustomtype();
        foreach ($result as $v) {
            $atype[$v['TypeID']] = $v;
        }
        if (!empty($_GET['ctype'])) {
            $result = array();
            $temp = explode(',', $_GET['ctype']);
            foreach ($atype as $k => $v) {
                if (in_array($k, $temp)) {
                    $result[$k]['TypeID'] = $k;
                    $result[$k]['TypeName'] = $atype[$k]['TypeName'];
                }
            }
        }
        echo json_encode($result);
    }

    //客户价格列表
    public function actionGetprice() {
        $ctype = $this->getCustomtype();
        $get = $this->getPriceresult();
        $pages = $get['pages'];
        $result = $get['result'];
        //客户类别搜索
        if (!empty($_GET['ctype'])) {
            $temp = explode(',', $_GET['ctype']);
            foreach ($temp as $v) {
                $type[]['TypeID'] = $v;
            }
        } else {
            $type = $ctype;
        }
        $datas = array();
        foreach ($result as $key => $val) {
            $datas[$key] = $val;
            //查询商品类别
            if (!empty($val['brand'])) {
                $brand = MakeGoodsBrand::model()->findByPK($val['brand']);
                $datas[$key]['brandname'] = $brand['BrandName'];
            }
            //查询标准名称
            if (!empty($val['standard_id'])) {
                $stand = Gcategory::model()->findByPk($val['standard_id']);
                $datas[$key]['cp_name'] = $stand['name'];
            }

            $datas[$key]['GoodsID'] = $val['goodsID'];
            $sql2 = "select Price,TypeID from tbl_make_price_relation where GoodsID={$val['goodsID']}";
            $price = DBUtil::queryAll($sql2);
            $pArr = array();
            if (!empty($price)) {
                foreach ($price as $v1) {
                    $pArr[$v1['TypeID']] = $v1['Price'];
                }
            }
            foreach ($type as $v2) {
                if (array_key_exists($v2['TypeID'], $pArr)) {
                    $datas[$key]['type' . $v2['TypeID']] = $pArr[$v2['TypeID']] !== NULL ? $pArr[$v2['TypeID']] : '';
                } else {
                    $datas[$key]['type' . $v2['TypeID']] = '';
                }
            }
        }
        echo json_encode(array('rows' => $datas, 'total' => $pages->itemCount));
    }

    //获取查询结果
    public function getPriceresult() {
        $organID = Commonmodel::getOrganID();
        $criteria = new CDbCriteria();
        $sql = "select distinct a.id as goodsID,b.goods_brand as brand,b.goods_no as goodsno,b.goods_name as goodsname,b.standard_id"
                . " from  tbl_make_goods a ,tbl_make_goods_version b"
                . '  where a.id=b.goods_id and a.NewVersion=b.version_name'
                . "  and a.ISdelete='0' and b.ISdelete=0"
                . "  and a.organID='$organID' and a.IsSale=0 and b.goods_no!=''";
        //商品品牌搜索
        if (!empty($_GET['goodsbrand'])) {
            $sql.=' and b.goods_brand=' . $_GET['goodsbrand'];
        }
        //配件品类搜索
        if (!empty($_GET['standardid'])) {
            $sql.=' and b.standard_id=' . $_GET['standardid'];
        }

        $sql.="  group by a.id order by a.id desc";
        $result1 = DBUtil::queryAll($sql);
        $count = count($result1);
        $pages = new CPagination($count);
        //设置分页页数
        $pages->pageSize = isset($_GET['rows']) ? intval($_GET['rows']) : 10;
        if ($_GET['page']) {
            $pages->currentPage = $_GET['page'] - 1;
        }
        $pages->applyLimit($criteria);
        $result = Yii::app()->db->createCommand($sql . " LIMIT :offset,:limit");
        //绑定分页参数
        $result->bindValue(':offset', $pages->currentPage * $pages->pageSize);
        $result->bindValue(':limit', $pages->pageSize);
        return array('pages' => $pages, 'result' => $result->queryAll());
    }

    //获取商品价格
    public function actionGetgprice() {
        $type = $this->getCustomtype();
        if (!$_GET['GoodsID']) {
            $this->redirect(array('makeprice/price'));
        }
        $sql2 = "select Price,TypeID from tbl_make_price_relation where GoodsID={$_GET['GoodsID']}";
        $price = DBUtil::queryAll($sql2);
        $pArr = array();
        if (!empty($price) && is_array($price)) {
            foreach ($price as $v1) {
                $pArr[$v1['TypeID']] = $v1['Price'];
            }
        }
        $key = 0;
        $datas = array();
        foreach ($type as $v2) {
            $datas[$key]['name'] = $v2['TypeName'];
            if (array_key_exists($v2['TypeID'], $pArr)) {
                $datas[$key]['type'] = 'ytype' . $v2['TypeID'];
                $datas[$key]['price'] = $pArr[$v2['TypeID']] !== NULL ? $pArr[$v2['TypeID']] : '';
            } else {
                $datas[$key]['type'] = 'ntype' . $v2['TypeID'];
                $datas[$key]['price'] = '';
            }
            $key++;
        }
        echo json_encode($datas);
    }

    //修改商品价格
    public function actionEditprice() {
        if (!$_POST['GoodsID']) {
            $this->redirect('price');
        } else {
            $goodsID = $_POST['GoodsID'];
            unset($_POST['GoodsID']);
            foreach ($_POST as $k => $v) {
                //修改价格
                if (substr($k, 0, 1) == 'y') {
                    $typeID = substr($k, 5);
                    $v = $v ? $v : NULL;
                    $u = MakePriceRelation::model()->updateAll(
                            array('Price' => $v, 'UpdateTime' => time()), "GoodsID={$goodsID} and TypeID={$typeID}"
                    );
                }
                //新增价格
                if (substr($k, 0, 1) == 'n') {
                    if ($v) {
                        $model = new MakePriceRelation;
                        $model->TypeID = substr($k, 5);
                        $model->GoodsID = $goodsID;
                        $model->Price = $v;
                        $model->CreateTime = time();
                        $s = $model->save();
                    }
                }
            }
            if ($u || $s) {
                echo 1;
            } else {
                echo 0;
            }
        }
    }

    //导出价格表
    public function actionExportprice() {
        $type = $this->getCustomtype();
        $get = $this->getPriceresult();
        $result = $get['result'];
        //客户类别搜索
        foreach ($type as $v) {
            $atype[$v['TypeID']] = $v;
        }
        if (!empty($_GET['ctype'])) {
            $type = array();
            $temp = explode(',', $_GET['ctype']);
            foreach ($atype as $k => $v) {
                if (in_array($k, $temp)) {
                    $type[$k]['TypeID'] = $k;
                    $type[$k]['TypeName'] = $atype[$k]['TypeName'];
                }
            }
        }

        //导出
        $objectPHPExcel = new PHPExcel();
        $objectPHPExcel->setActiveSheetIndex(0);

        $objectPHPExcel->getActiveSheet()->getColumnDimension('A')->setWidth(20);
        $objectPHPExcel->setActiveSheetIndex(0)->setCellValue('A3', '商品编号(必填)');
        $objectPHPExcel->getActiveSheet()->getColumnDimension('B')->setWidth(20);
        $objectPHPExcel->setActiveSheetIndex(0)->setCellValue('B3', '商品品牌');
        $objectPHPExcel->getActiveSheet()->getColumnDimension('C')->setWidth(20);
        $objectPHPExcel->setActiveSheetIndex(0)->setCellValue('C3', '标准名称');

        $cell = 'C';
        foreach ($type as $k => $v) {
            $cell++;
            $objectPHPExcel->getActiveSheet()->getColumnDimension($cell)->setWidth(20);
            $objectPHPExcel->setActiveSheetIndex(0)->setCellValue($cell . '3', $v['TypeName']);
        }

        //报表头的输出
        $objectPHPExcel->getActiveSheet()->mergeCells('A1:' . $cell . '1');
        $objectPHPExcel->getActiveSheet()->setCellValue('A1', '客户价格表');
        $objectPHPExcel->setActiveSheetIndex(0)->getStyle('A1')->getFont()->setSize(24);
        $objectPHPExcel->setActiveSheetIndex(0)->getStyle('A1')
                ->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
        $objectPHPExcel->getActiveSheet()->mergeCells('A2:' . $cell . '2');
        $objectPHPExcel->getActiveSheet()->setCellValue('A2', '*注：请勿更改表头字段，防止改价失败!可按要求添加或删除商品数据。');

        //设置行高
        $objectPHPExcel->getActiveSheet()->getDefaultRowDimension()->setRowHeight(25);
        $objectPHPExcel->getActiveSheet()->getRowDimension('1')->setRowHeight(40);
        $objectPHPExcel->getActiveSheet()->getRowDimension('2')->setRowHeight(22);
        $objectPHPExcel->getActiveSheet()->getRowDimension('3')->setRowHeight(30);
        $objectPHPExcel->getActiveSheet()->getStyle('A3:' . $cell . '3')->getFont()->setBold(true);

        //设置居中
        $objectPHPExcel->getActiveSheet()->getStyle('A3:' . $cell . '3')
                ->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
        $objectPHPExcel->getActiveSheet()->getStyle('A3:' . $cell . '3')
                ->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);

        $n = 0;
        foreach ($result as $val) {
//            $objectPHPExcel->getActiveSheet()->setCellValue('A'.($n+4) ,($n+1));
            $objectPHPExcel->getActiveSheet()->setCellValue('A' . ($n + 4), $val['goodsno']);
            //查询商品类别
            $val['brandname'] = '';
            if (!empty($val['brand'])) {
                $brand = MakeGoodsBrand::model()->findByPK($val['brand']);
                $val['brandname'] = $brand['BrandName'];
            }
            $objectPHPExcel->getActiveSheet()->setCellValue('B' . ($n + 4), $val['brandname']);
            //查询标准名称
            $val['cp_name'] = '';
            if (!empty($val['standard_id'])) {
                $stand = Gcategory::model()->findByPk($val['standard_id']);
                $val['cp_name'] = $stand['name'];
            }
            $objectPHPExcel->getActiveSheet()->setCellValue('C' . ($n + 4), $val['cp_name']);

            $sql2 = "select Price,TypeID from tbl_make_price_relation where GoodsID={$val['goodsID']}";
            $price = DBUtil::queryAll($sql2);
            $pArr = array();
            if (!empty($price)) {
                foreach ($price as $v1) {
                    $pArr[$v1['TypeID']] = $v1['Price'];
                }
            }
            $cel = 'C';
            foreach ($type as $k => $v2) {
                $cel++;
                if (array_key_exists($v2['TypeID'], $pArr)) {
                    $objectPHPExcel->getActiveSheet()->setCellValue($cel . ($n + 4), $pArr[$v2['TypeID']]);
                } else {
                    $objectPHPExcel->getActiveSheet()->setCellValue($cel . ($n + 4), '');
                }
            }

            //设置边框
            $currentRowNum = $n + 4;
            $objectPHPExcel->getActiveSheet()->getStyle('A' . ($n + 4) . ':' . $cel . $currentRowNum)
                    ->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
            $objectPHPExcel->getActiveSheet()->getStyle('A' . ($n + 4) . ':' . $cel . $currentRowNum)
                    ->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);
            $n++;
        }

        //导出为excel表格
        $objectPHPExcel->getActiveSheet()->getPageSetup()->setHorizontalCentered(true);
        $objectPHPExcel->getActiveSheet()->getPageSetup()->setVerticalCentered(false);

        ob_end_clean();
        ob_start();

        header('Content-Type : application/vnd.ms-excel');
        header('Content-Disposition:attachment;filename="' . iconv("utf-8", "gb2312", "客户价格表") . '.xls"');
        $objWriter = PHPExcel_IOFactory::createWriter($objectPHPExcel, 'Excel5');
        $objWriter->save('php://output');
    }

    //导入价格
    public function actionImportprice() {
        $organID = Commonmodel::getOrganID();
        //上传excel表格
        if ($_POST['leadExcel'] == "true") {
            $filename = iconv("utf-8", "gb2312", $_FILES['inputExcel']['name']);
            $tmp_name = $_FILES['inputExcel']['tmp_name'];
            //$filePath = dirname(Yii::app()->BasePath) . "/themes/default/uploadsfile/dealer/execl/";
            $filePath = Yii::app()->params['uploadPath'] . 'maker/excel/';
            $upload_result = UploadsFile::uploadFile($filename, $tmp_name, $filePath);
            if ($upload_result['success']) {
                //解析Excel文件，返回结果为错误消息，如果不为空则表明发生错误
                $uploadfile = $upload_result['uploadfile'];
                $extend = strtolower(strrchr($uploadfile, '.'));
                if ($extend != '.xlsx' && $extend != '.xls') {
                    unlink($uploadfile);
                    echo json_encode(array('message' => '文件类型错误,只支持excel文件', 'success' => false));
                    exit;
                }
                $readerType = ($extend == '.xlsx') ? 'Excel2007' : 'Excel5';
                $objReader = new PHPExcel();
                $objReader = PHPExcel_IOFactory::createReader($readerType); //use Excel5 for 5fromat ,use excel2007 for 2007 format

                $objPHPExcel = $objReader->load($uploadfile);
                $objWorksheet = $objPHPExcel->getActiveSheet(); //取得活动sheet
                if (!$objPHPExcel || !$objWorksheet) {
                    unlink($uploadfile);
                    echo json_encode(array('message' => '加载Excel出错,请稍后再试', 'success' => false));
                    exit;
                }

                $highestRow = $objWorksheet->getHighestRow(); //取得总行数
                $highestColumn = $objWorksheet->getHighestColumn(); //取得总列数
                $highestColumnIndex = PHPExcel_Cell::columnIndexFromString($highestColumn); //总列数
                $result = $this->getCustomtype();
                foreach ($result as $v) {
                    $type[$v['TypeID']] = $v['TypeName'];
                }
                //表头是否为商品编号
                $columnName = $objWorksheet->getCellByColumnAndRow(0, 3)->getValue();
                if ($columnName != '商品编号(必填)' || $highestColumn <= chr(ord('A') + 2) || $highestColumn > chr(ord('A') + 2 + count($type))) {
                    unlink($uploadfile);
                    echo json_encode(array('message' => '表格结构与要求不符！', 'success' => false));
                    exit;
                }
                //获取客户类别及ID
                $first_row = array();
                $typelist = array();
                for ($col = 3; $col < $highestColumnIndex; $col++) {
                    $first_row[$col]['TypeName'] = $objWorksheet->getCellByColumnAndRow($col, 3)->getValue();
                    if (in_array($first_row[$col]['TypeName'], $typelist)) {
                        unlink($uploadfile);
                        echo json_encode(array('message' => '表格内有重复的客户类别:' . $first_row[$col]['TypeName'], 'success' => false));
                        exit;
                    }
                    $first_row[$col]['TypeID'] = array_search($first_row[$col]['TypeName'], $type);
                    if (!$first_row[$col]['TypeID']) {
                        unlink($uploadfile);
                        echo json_encode(array('message' => '表格内有不存在的客户类别:' . $first_row[$col]['TypeName'], 'success' => false));
                        exit;
                    }
                    $typelist[] = $first_row[$col]['TypeName'];
                }
                //获取商品编号、ID
                $goodsnolist = array();
                $Goods_value = array();
                for ($row = 4; $row <= $highestRow; $row++) {
                    $Goods_value[$row]['goodsno'] = $objWorksheet->getCellByColumnAndRow(0, $row)->getValue();
                    if (in_array($Goods_value[$row]['goodsno'], $goodsnolist)) {
                        unlink($uploadfile);
                        echo json_encode(array('message' => '表格内有重复的商品编号:' . $Goods_value[$row]['goodsno'], 'success' => false));
                        exit;
                    }
                    $goodsnolist[] = $Goods_value[$row]['goodsno'];
                    $sql = "select goods_id from tbl_make_goods_version where organID={$organID} and goods_no='{$Goods_value[$row]['goodsno']}'and ISdelete='0'";
                    $tempArr = DBUtil::queryAll($sql);
                    if (!$tempArr) {
                        unlink($uploadfile);
                        echo json_encode(array('message' => '表格内有不存在的商品编号:' . $Goods_value[$row]['goodsno'], 'success' => false));
                        exit;
                    }
                    $Goods_value[$row]['GoodsID'] = $tempArr[0]['goods_id'];
                }
                $sql = "select ID,GoodsID,TypeID,Price from tbl_make_price_relation";
                $priceArr = DBUtil::queryAll($sql);
                $newArr = array();
                if ($priceArr) {
                    foreach ($priceArr as $v) {
                        $newArr[$v['GoodsID'] . 'a' . $v['TypeID']]['ID'] = $v['ID'];
                        $newArr[$v['GoodsID'] . 'a' . $v['TypeID']]['Price'] = $v['Price'];
                    }
                }
                $dSql = 'delete from tbl_make_price_relation where ID in(';
                $iSql = 'insert into tbl_make_price_relation(GoodsID,TypeID,Price) values';
                //将表格内的价格存到数据库
                for ($row = 4; $row <= $highestRow; $row++) {
                    $GoodsID = $Goods_value[$row]['GoodsID'];
                    for ($col = 3; $col < $highestColumnIndex; $col++) {
                        $pric = $objWorksheet->getCellByColumnAndRow($col, $row)->getValue();
                        // $price = $pric ? $pric : 'NULL';

                        $TypeID = $first_row[$col]['TypeID'];
                        $key = $GoodsID . 'a' . $TypeID;
                        //删除价格
                        if (array_key_exists($key, $newArr)) {
                            if ($pric != $newArr[$key]['Price']) {
                                $id = $newArr[$key]['ID'];
                                $dSql.="$id,";
                                $iSql.=isset($pric) ? "($GoodsID,$TypeID,$pric)," : '';
                            }
                        }
                        //插入价格
                        else if (isset($pric)) {
                            $iSql.="($GoodsID,$TypeID,$pric),";
                        }
                    }
                }
                $dSql = substr($dSql, 0, -1) . ')';
                $iSql = substr($iSql, 0, -1);
                $del = DBUtil::execute($dSql);
                $ins = DBUtil::execute($iSql);
                if ($del['result'] || $ins['result']) {
                    echo json_encode(array('message' => '商品价格修改成功！', 'success' => true));
                    unlink($uploadfile);
                } else {
                    echo json_encode(array('message' => '改价失败：没有价格变化！', 'success' => false));
                    unlink($uploadfile);
                }
            } else {
                $message = $upload_result['error'];
                echo json_encode(array('message' => $message, 'success' => false));
                exit;
            }
        } else {
            $this->redirect(array('makeprice/price'));
        }
    }

}

?>