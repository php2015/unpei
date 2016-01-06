<?php

/**
 * 批量导入推荐名录
 *
 */
class GoodsImport {

    // 促销商品批量上传
    public static $GoodsRows = array(
        '商品编号(必填)' => 'GoodsNO',
        '商品名称(必填)' => 'Name',
        '拼音代码' => 'Pinyin',
        '商品品牌' => 'Brand',
//        '配件大类' => 'BigParts',
//        '配件子类' => 'SubParts',
//        '标准名称' => 'CpName',
        '配件档次' => 'PartsLevel',
        'OE号' => 'OENO',
//        '适用车系（车品牌）' => 'Make',
//        '适用车系（车系）' => 'Car',
        '参考价(必填)' => 'Price',
        '备注' => 'Memo',
    );

    //解析excel
    function parse($excelfile, $template, $data = array()) {

        try {
            //获取上传文件的文件名扩展名
            $extend = strtolower(strrchr($excelfile, '.'));
            $readerType = ($extend == '.xlsx') ? 'Excel2007' : 'Excel5';
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
                if($first_row[$col] == '商品编号')
                    $GoodsNO_col = $col;
            }
            //验证表结构，表名称和字段列表
            if (!$this->validateExcel($template, $first_row)) {
                $error = "Excel内容与模板不符合";
                //$error = $first_row;
                return array('success' => false, 'error' => $error);
            }
            //生成插入语句的头部
            $sql_header = $this->generateSqlHeader($template, $first_row);
            if ($sql_header == "") {
                $error = "SQL语句头部生成失败";
                return array('success' => false, 'error' => $error);
            }
            //生成SQL语句
            $sql = $sql_header;
            $i=0;
            $list=array();
            for ($row = 2; $row <= $highestRow; $row++) {
                //每行的第一列数据不能为空
                $first_value = $objWorksheet->getCellByColumnAndRow(0, $row)->getValue();
                $GoodsNO_value = $objWorksheet->getCellByColumnAndRow($GoodsNO_col, $row)->getValue();
                if(in_array($GoodsNO_value,$list)){
                    $success = false;
                    $error = '导入的商品编号重复';
                    return array('success' => $success, 'error' => $error);
                }
                if (empty($first_value)) {
                    continue;
                }
                $data_new = array();
                $sql_data = '(';
                ////注意highestColumnIndex的列数索引从0开始
                for ($col = 0; $col < $highestColumnIndex; $col++) {
                    $data_new[$col] = $objWorksheet->getCellByColumnAndRow($col, $row)->getValue();
                    if($col == $GoodsNO_col){
                        $criteria = new CDbCriteria();
                        $criteria->addCondition("GoodsNO = '$data_new[$col]'");
                        $criteria->addCondition("OrganID =".Commonmodel::getOrganID());
                        $criteria->addCondition("ISdelete = 1");
                       // echo Commonmodel::getOrganID();exit;
                        $bool = DealerGoods::model()->find($criteria);
                        if(!empty($bool)){
                             $success = false;
                             $error = '商品编号已存在';
                             return array('success' => $success, 'error' => $error);
                        }
                    }
//                     if($col==4){   //  大类
//                          $data_new[$col] = DealerBigparts::getBigpartsID( $data_new[$col]);
//                     }
//                     if($col==5){   // 子类
//                          $data_new[$col] = DealerSubparts::getSubpartsID($data_new[$col]);
//                     }
//                     if($col==6){   // 标准名称
//                          $data_new[$col] = DealerCpname::getCpNameID($data_new[$col]) ;
//                     }
                    $sql_data .= "'" . trim($data_new[$col]) . "',";
                }
                if ($template == "dealergoods") { //
                    $sql_data .= "'" . $data['OrganID'] . "','" . $data['UserID'] . "','" . $data['CreateTime'] . "'";
                }

                $sql_data .= ")";
                //var_dump($sql_data);exit;
                //验证数据是否正确
                //$this->validateData($data_new[$col]);			
                $sql .= $sql_data . ',';
                $list[$i] = $GoodsNO_value;
                $i++;
            }
            $sql = rtrim($sql, ",") . ";";
            //返回结果数据
            $success = false;
            if ($error == "" && $sql != "") {
                $success = true;
            }
        } catch (Exception $e) {
            $success = false;
            $error = '解析Excel出错' . $e->getMessage();
        }
//echo $sql;exit;
        return array('success' => $success, 'error' => $error, 'sql' => $sql);
    }

    //验证Excel的格式是否正确
    function validateExcel($template, $rows) {
        $templaterRows = array();
        if ($template == 'dealergoods') { // 促销商品
            $templaterRows = GoodsImport::$GoodsRows;
        }
        $keys = array_keys($templaterRows);
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
        if ($template == 'dealergoods') {  // 当模版是促销商品时
            $tablename = "tbl_dealer_goods"; //临时存放数据
            $templaterRows = GoodsImport::$GoodsRows;
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
    
    

}