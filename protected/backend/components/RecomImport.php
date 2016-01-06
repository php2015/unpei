<?php

/**
 * 批量导入推荐名录
 *
 */
class RecomImport {
    public static $_userID;
    // 促销商品批量上传
    public static $recommedRows = array(
        '姓名(必填)' => 'Name',
        '手机(必填)' => 'MobPhone',
	'机构类型(必填)'=>'CompanyType',
        '邮箱(必填)' => 'Email',
        '机构名称(必填)' => 'CompanyName',
        '地址（省）(必填)' => 'Province',
        '地址（市）(必填)' => 'City',
        '详细地址(必填)' => 'Address',
        '推荐人(必填)' => 'OrganID',
        '固定电话' => 'TelePhone',
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
            $val='';
            $datas=$objWorksheet->toArray();
            for ($row = 2; $row <= $highestRow; $row++) {
                $arrays=array_filter($datas[$row-1]);
                if(!$arrays){
                    continue;
                }
                //每行的第一列数据不能为空
                $first_value = $objWorksheet->getCellByColumnAndRow(0, $row)->getValue();
                if (empty($first_value)) {
                     $error = "有姓名未填写，上传失败";
                return array('success' => false, 'error' => $error);
                exit;
//                    continue;
                }
                  $second_value = $objWorksheet->getCellByColumnAndRow(1, $row)->getValue();
                if (empty($second_value)) {
                     $error = "有手机未填写，上传失败";
                return array('success' => false, 'error' => $error);
                exit;
//                    continue;
                }
                   $eight_value = $objWorksheet->getCellByColumnAndRow(8, $row)->getValue();
                if (empty($eight_value)) {
                      $error = "有推荐人未填写，上传失败";
                return array('success' => false, 'error' => $error);
                exit;
//                    continue;
                }else{
                   $apl=$this->GetOrganID($eight_value);
                   if(!$apl){
                           $error = "推荐人“".$eight_value."”不存在，上传失败";
                    return array('success' => false, 'error' => $error);
                    exit; 
                   }
                }
                $data_new = array();
                $sql_data = '(';
                ////注意highestColumnIndex的列数索引从0开始
                for ($col = 0; $col < $highestColumnIndex; $col++) {
                    $data_new[$col] = $objWorksheet->getCellByColumnAndRow($col, $row)->getValue();
                    if($col==2){	// 机构类别
						$data_new[$col] = self::companyType($data_new[$col]);
					}
                 
                    if ($col == 5) { // 省
                        if (!empty($data_new[$col])) {
                            $data_new[$col] = self::getCode($data_new[$col], 1);
                        } else {
                            $data_new[$col] = '';
                        }
                    }
                    if ($col == 6) { // 市
                        if (!empty($data_new[$col - 1]) && !empty($data_new[$col])) {
                            $city = self::getCode($data_new[$col], 2);
                            $privince = Area::getParent_id($city);
                            if ($privince == $data_new[$col - 1]) {
                                $data_new[$col] = self::getCode($data_new[$col], 2);
                            } else {
                                $data_new[$col] = '';
                            }
                        } else {
                            $data_new[$col] = '';
                        }
                    }
                    if($col ==8){
                        $userID=$this->GetOrganID($data_new[$col]);
                        $this->_userID=$userID;
                        $data_new[$col]=$userID;
                    }

                    $sql_data .= "'" . trim($data_new[$col]) . "',";
                }
                if ($template == "recommend") { //
                    $sql_data .= "'" . $data['RecomStatus'] . "','"  . time(). "','". '' . "'";
                }

                $sql_data .= ")";
                //验证数据是否正确
                //$this->validateData($data_new[$col]);			
                $val .= $sql_data . ',';
            }
            if(!empty($val)){
                $sql=$sql.$val;
            }else{
                  $error = "上传文件无数据，上传失败";
                return array('success' => false, 'error' => $error);
                exit;  
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

        return array('success' => $success, 'error' => $error, 'sql' => $sql);
    }

    //验证Excel的格式是否正确
    function validateExcel($template, $rows) {
        $templaterRows = array();
        if ($template == 'recommend') { // 促销商品
            $templaterRows = RecomImport::$recommedRows;
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
        if ($template == 'recommend') {  // 当模版是促销商品时
            $tablename = "jpd_recommend_list"; 
            $templaterRows = RecomImport::$recommedRows;
            $sql_header = "INSERT INTO `$tablename` (";
            for ($i = 0; $i < count($rows); $i++) {
                //取列名称
                $column = $templaterRows[$rows[$i]];
                $sql_header .= '`' . $column . '`';
                if ($i < count($rows) - 1) {
                    $sql_header .= ',';
                }
            }
            $sql_header .= ',`RecomStatus`,`CreateTime`,`UpdateTime` ';
            $sql_header .= ') values ';
        }
        return $sql_header;
    }

    public static function companyType($companyType) {
        if ($companyType == "生产商" || $companyType == "生产") {
            return 1;
        } elseif ($companyType == "经销商") {
            return 2;
        } elseif ($companyType == "修理厂") {
            return 3;
        } else {
            return 1;
        }
    }
    public static function GetOrganID($Organname){
        $sql="select ID from jpd_organ where organName ='{$Organname}'"; //like "%'.$Organname.'%"';
        $result=Yii::app()->jpdb->createCommand($sql)->queryAll();
        return $result[0]['ID'];
    }

    public static function getCode($name,$grade=0){
                if($grade==0){
                    $model = Area::model()->find( array('select' => 'ID', 'condition'=> 'Name LIKE :name','params'=> array (':name' =>"%$name%" )));
                }else{
                    $model = Area::model()->find( array('select' => 'ID', 'condition'=> 'Name LIKE :name and Grade=:grade','params'=> array (':name' =>"%$name%",':grade'=>$grade)));
                }
		return $model->ID;
	}
}