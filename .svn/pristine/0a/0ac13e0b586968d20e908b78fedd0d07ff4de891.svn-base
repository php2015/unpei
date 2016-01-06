<?php

/**
 * 批量导入推荐名录
 *
 */
class MakeGoodsImport {

    // 生产商批量上传商品
    public static $GoodsRows = array();

    function GoodsHeadArr($standardid) {
        $basis = array(
            'goods_no' => '商品编号（必填）', // 商品编号
            'goods_name' => '商品名称（必填）', // 商品名称
            'brand' => '品牌', // tbl_make_goods
            'goods_oe' => 'OE号（必填,多个OE号以逗号隔开）',
            'carmodel'=>'适用车型', 
//            'category' => '配件品类',           // 配件品类
            'benchmarking_brand' => '标杆品牌', // 标杆品牌
            'benchmarking_sn' => '标杆商品号', // 标杆商品号
//            'marketprice' => '市场指导价',      // 市场指导价
//            'salesprice' => '销售价',           // 销售价
//            'discountprice' => '优惠价',        // 优惠价
            'inventory' => '库存（有/无）', // 库存
            'senddays' => '发货天数', // 发货天数
            'description' => '备注', // 备注
        );
        $organID = Commonmodel::getOrganID();
        $datas = MakeGoodsTemplate::model()->findAll('organID=' . $organID . ' and ISdelete="N" and standard_id=' . $standardid);
        $paramsname = array();  // 参数名称
        if ($datas) {
            foreach ($datas as $data) {
                $paramsname['_' . $data['id']] = $data['name'];
            }
        }
        self::$GoodsRows = array_merge($basis, $paramsname);
    }

    //解析excel
    function parse($excelfile, $template, $data = array()) {
        try {
            // 给excel头部赋值
            //  MakeGoodsImport::$GoodsRows= $this->getGoodsHead();
            //获取上传文件的文件名扩展名
            $extend = strtolower(strrchr($excelfile, '.'));
            $readerType = ($extend == '.xlsx') ? 'Excel2007' : 'Excel5';
          
            if ($extend != '.xlsx' && $extend != '.xls') {
                $error = '文件类型错误,只支持excel文件';
                return;
            }
            $objReader = new PHPExcel();
            $objReader = PHPExcel_IOFactory::createReader($readerType); //use Excel5 for 5fromat ,use excel2007 for 2007 format
           
            $objPHPExcel = $objReader->load($excelfile);
            if (!$objPHPExcel) {
                $error = '加载Excel出错';
                return array('success' => false, 'error' => $error);
            }
            $objWorksheet = $objPHPExcel->getActiveSheet(); //取得活动sheet
            if (!$objWorksheet) {
                $error = '加载Excel出错';
                return array('success' => false, 'error' => $error);
            }

            $title = $objWorksheet->getTitle();    //取得sheet名称
            $highestRow = $objWorksheet->getHighestRow(); //取得总行数

            $highestColumn = $objWorksheet->getHighestColumn(); //取得总列数
            $highestColumnIndex = PHPExcel_Cell::columnIndexFromString($highestColumn); //总列数
            //执行结果
            $error = "";
            $first_row = array();
            for ($col = 0; $col < $highestColumnIndex; $col++) {
                $first_row[$col] = $objWorksheet->getCellByColumnAndRow($col, 1)->getValue();
                if ($first_row[$col] == '商品编号') {
                    $GoodsNO_col = $col;
                }
            }

            //验证表结构，表名称和字段列表
            if (!$this->validateExcel($template, $first_row)) {
                $error = "Excel内容与模板不符合";
                //$error = $first_row;
                return array('success' => false, 'error' => $error);
            }
            //生成插入语句的头部
//            $sql_header = $this->generateSqlHeader($template, $first_row);
//            if ($sql_header == "") {
//                $error = "SQL语句头部生成失败";
//                return array('success' => false, 'error' => $error);
//            }
//            //生成SQL语句
//            $sql = $sql_header;
            $templaterRows = MakeGoodsImport::$GoodsRows;
            $templaterRows = array_flip($templaterRows);
            $columnleng = count($templaterRows);
            $i = 0;
            $list = array();
            $sheetData = $objWorksheet->toArray();
            for ($row = 2; $row <= $highestRow; $row++) {
                //每行的第一列数据不能为空
                $first_value = $objWorksheet->getCellByColumnAndRow(0, $row)->getValue();
                $GoodsNO_value = $objWorksheet->getCellByColumnAndRow($GoodsNO_col, $row)->getValue();
//                if (in_array($GoodsNO_value, $list)) {
//                    $success = false;
//                    $error = '导入的商品编号重复';
//                    return array('success' => $success, 'error' => $error);
//                }
//                if (empty($first_value)) {
//                    $success = false;
//                    $error = '商品编号不能为空';
//                    return array('success' => $success, 'error' => $error);
//                    continue;
//                }
//                $data_new = array();
//                $sql_data = '(';
                //注意highestColumnIndex的列数索引从0开始
//                for ($col = 0; $col < $highestColumnIndex; $col++) {
//                    $data_new[$col] = $objWorksheet->getCellByColumnAndRow($col, $row)->getValue();
//                    if($col == $GoodsNO_col){
//                        $criteria = new CDbCriteria();
//                        $criteria->addCondition("GoodsNO = '$data_new[$col]'");
//                        $criteria->addCondition("OrganID =".Commonmodel::getOrganID());
//                        $criteria->addCondition("ISdelete = 1");
//                       // echo Commonmodel::getOrganID();exit;
//                        $bool = DealerGoods::model()->find($criteria);
//                        if(!empty($bool)){
//                             $success = false;
//                             $error = '商品编号已存在';
//                             return array('success' => $success, 'error' => $error);
//                        }
//                    }
//                    if ($data_new[$col]) {
//                        $sql_data .= "'" . trim($data_new[$col]) . "',";
//                    }
//                }
//                if ($template == "makergoods") { //
//                    $sql_data .= "'" . $data['OrganID'] . "','" . $data['UserID'] . "','" . $data['CreateTime'] . "'";
//                }
//
//                $sql_data .= ")";
                //验证数据是否正确
                //$this->validateData($data_new[$col]);			
//                $sql .= $sql_data . ',';
                $array=$sheetData[$row - 1];
                $array=array_filter($array);
                if (!empty($array)) {
                    $Sdata[$i] = $sheetData[$row - 1];
                    $list[$i] = $GoodsNO_value;
                    $i++;
                    $success = true;
                    $error = '';
                }
            }

//            $sql = rtrim($sql, ",") . ";";
            // echo $sql;exit;
            //返回结果数据
            $success = false;
            if ($error == "" && $Sdata != "") {
                $success = true;
            }
        } catch (Exception $e) {
            $success = false;
            $error = '解析Excel出错' . $e->getMessage();
        }

//echo $sql;exit;
        return array('success' => $success, 'error' => $error, 'Sdata' => $Sdata, 'templaterRows' => $templaterRows);
    }

    //验证Excel的格式是否正确
    function validateExcel($template, $rows) {

        $templaterRows = array();
        if ($template == 'makergoods') { // 促销商品
            $templaterRows = MakeGoodsImport::$GoodsRows;
            $templaterRows = array_flip($templaterRows);
        }
        $keys = array_keys($templaterRows);
        //$rows=array_filter($rows);
        //比较数组长度是否一致
        if (!is_array($rows) || (count($rows) != count($keys))) {
            return false;
        }
        //比较数组值是否一致
        $diff = array_diff($rows, $keys);
        if (count($diff) != 0) {
            return false;
        }
        return true;
    }

    //依据Excel的第一行构建插入的SQL语句头部
    function generateSqlHeader($template, $rows) {
        $tablename = "";
        if ($template == 'makergoods') {  // 当模版是促销商品时
            $tablename = "tbl_make_goods_temp"; //临时存放数据
            $templaterRows = MakeGoodsImport::$GoodsRows;
            //  交换键值
            $templaterRows = array_flip($templaterRows);
            //$rows=array_filter($rows);
            $sql_header = "INSERT INTO `$tablename` (";
            for ($i = 0; $i < count($rows); $i++) {
                //取列名称
                $column = $templaterRows[$rows[$i]];
                $sql_header .= '`' . $column . '`';
                if ($i < count($rows) - 1) {
                    $sql_header .= ',';
                }
            }
            $sql_header .= ',`OrganID`,`UserID`,`CreateTime` ';
            $sql_header .= ') values ';
        }
        return $sql_header;
    }

    /**
     * 获取导入商品的头部
     * @param $cp_name  标准名称
     */
    private function getGoodsHead($cp_name = 'null') {
        // 基本的参数字段
        $basis = array(
            'goods_no' => '商品编号（必填）', // 商品编号
            'goods_name' => '商品名称（必填）', // 商品名称
            'brand' => '品牌', // tbl_make_goods
            'category' => '配件品类', // 配件品类
            'benchmarking_brand' => '标杆品牌', // 标杆品牌
            'benchmarking_sn' => '标杆商品号', // 标杆商品号
            'marketprice' => '市场指导价', // 市场指导价
            'salesprice' => '销售价', // 销售价
            'discountprice' => '优惠价', // 优惠价
            'inventory' => '库存', // 库存
            'senddays' => '发货天数', // 发货天数
            'description' => '备注', // 备注
        );
        // 参数名列
        //   $ColumnParams = $this->getParamName($cp_name); 
        // 合并成商品批量导入的Head
        //    $GoodsHeadTitle = array_merge($basis, $ColumnParams);
        return $basis;
        //   return $GoodsHeadTitle;
    }

    /**
     * 获取参数名称列名
     * @param type $cp_name 标准名称
     */
    private function getParamName($cp_name) {
        $standardid = $this->cpnameID($cp_name);
        $organID = Commonmodel::getOrganID();
        $datas = MakeGoodsTemplate::model()->findAll('organID=' . $organID . ' and ISdelete="N" and standard_id=' . $standardid);
        $paramsname = array();  // 参数名称
        if ($datas) {
            foreach ($datas as $data) {
                $paramsname['_' . $data['id']] = $data['name'];
            }
        }

        return $paramsname;
    }

    // 获取标准名称ID
    private function cpnameID($standard) {
        $sql = "select id from tbl_gcategory where name='{$standard}'  limit 1";
        $data = DBUtil::query($sql);
        if ($data) {
            return $data['id'];
        } else {
            return '';
        }
    }

}