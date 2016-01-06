<?php 
/*require_once 'PHPExcel/PHPExcel.php';
require_once 'PHPExcel/PHPExcel/IOFactory.php';
require_once 'PHPExcel/PHPExcel/Reader/Excel5.php';
require_once 'PHPExcel/PHPExcel/Reader/Excel2007.php';
include 'PHPExcel/PHPExcel_IOFactory.php'; */
class DataImport
{	
	// 上传下属经销商
	public static $subdealer = array(
		'机构名称'=>'organName',
		'经营级别'=>'grade',
		'授权品类'=>'allowCate',
		'授权品牌'=>'allowBrand',
		'授权销售地域（省）'=>'allowProvince',
		'授权销售地域（市）'=>'allowCity',
		'联系人'=>'person',
		'联系电话'=>'phone',
		'省'=>'province',
		'市'=>'city',
		'区'=>'area',
		'详细地址'=>'address',
	);
	// 促销商品批量上传
	public static $promotionGoodsRows = array(
		'配件名称'=>'partsName',
		'配件品牌'=>'partsBrand',
		'品牌档次'=>'brandGrade',
		'类别'=>'categroy',
		'优惠说明'=>'youhui',
		'适用车系'=>'suitVehicle',
		'适用OE号'=>'suitOe',
		'关键参数'=>'keyParams',
	
	);
	//解析excel
	function parse($excelfile,$template,$data=array())
	{
		try{
			//获取上传文件的文件名扩展名
			$extend = strtolower(strrchr($excelfile,'.'));
			$readerType = ($extend == '.xlsx')?'Excel2007':'Excel5';
			$objReader = new PHPExcel();
			$objReader = PHPExcel_IOFactory::createReader($readerType);//use Excel5 for 5fromat ,use excel2007 for 2007 format
			$objPHPExcel = $objReader->load($excelfile);
			if(!$objPHPExcel){
				$error = '加载Excel出错';
				return array('success'=>false,'error'=>$error);
			}
			$objWorksheet = $objPHPExcel->getActiveSheet();	//取得活动sheet
			if(!$objWorksheet){
				$error = '加载Excel出错';
				return array('success'=>false,'error'=>$error);
			}			
			$title = $objWorksheet->getTitle();				//取得sheet名称
			$highestRow = $objWorksheet->getHighestRow();	//取得总行数
			
			$highestColumn = $objWorksheet->getHighestColumn(); //取得总列数
			$highestColumnIndex = PHPExcel_Cell::columnIndexFromString($highestColumn);	//总列数
			//执行结果
			$error = "";
			$first_row = array();
			for ($col = 0;$col<$highestColumnIndex;$col++)
			{
				$first_row[$col] = $objWorksheet->getCellByColumnAndRow($col, 1)->getValue();
			}
			//验证表结构，表名称和字段列表
			if(!$this->validateExcel($template, $first_row)){
				$error = "Excel内容与模板不符合";
				//$error = $first_row;
				return array('success'=>false,'error'=>$error);
			}
			//生成插入语句的头部
			$sql_header = $this->generateSqlHeader($template, $first_row);
			if($sql_header == ""){
				$error = "SQL语句头部生成失败";
				return array('success'=>false,'error'=>$error);
			}
			//生成SQL语句
			$sql = $sql_header;
			for ($row = 2;$row <= $highestRow; $row++)
			{
				//每行的第一列数据不能为空
				$first_value = $objWorksheet->getCellByColumnAndRow(0, $row)->getValue();
				if(empty($first_value)){
					continue;
				}
				$data_new = array();
				$sql_data = '(';
				////注意highestColumnIndex的列数索引从0开始
				for ($col = 0;$col<$highestColumnIndex;$col++)
				{
					$data_new[$col] = $objWorksheet->getCellByColumnAndRow($col, $row)->getValue();
					
					if($col == 4){
						$data_new[$col] = Area::getCode($data_new[$col]);
	 				}if($col == 5)
	 				{
						$data_new[$col] = Area::getCode($data_new[$col]);
	 				}
					if($col == 8){
						$data_new[$col] = Area::getCode($data_new[$col]);
	 				}
					if($col == 9){
						$data_new[$col] = Area::getCode($data_new[$col]);
	 				}
					if($col == 10){
						$data_new[$col] = Area::getCode($data_new[$col]);
	 				}
					$sql_data .= "'".trim($data_new[$col])."',";
					
				}
				if ($template == "promotion"){	//促销商品
					$sql_data .= "'".$data['Status']."','".$data['dealerId']."','".$data['startTime']."','".$data['endTime'] ."'";
				}
				else if($template == 'subdealer')
				{
					$sql_data .= "'".$data['flag']."','".$data['UserID']."'";
				}elseif ($template == 'groupbatch'){
					$sql_data .= "'".$data['UserID']."'";
				}
				
				
				$sql_data .= ")";
				//var_dump($sql_data);exit;
				//验证数据是否正确
				//$this->validateData($data_new[$col]);			
				$sql .= $sql_data . ','; 
			}
			$sql = rtrim($sql,",").";";
			//返回结果数据
			$success = false;
			if($error == "" && $sql != ""){
				$success = true;
			}
		}catch(Exception $e) {
			$success = false;
			$error = '解析Excel出错'.$e->getMessage();
		}
		return array('success'=>$success,'error'=>$error,'sql'=>$sql);
	}
	
	//验证Excel的格式是否正确
	function validateExcel($template, $rows){
		$templaterRows = array();
		if ($template == 'promotion')	// 促销商品
		{
			$templaterRows = DataImport::$promotionGoodsRows;
		}else if($template == 'subdealer'){
			$templaterRows = DataImport::$subdealer;
		}else if($template == 'groupbatch'){
			$templaterRows = DataImport::$groupbatch;
		}
		
		$keys = array_keys($templaterRows);
		//比较数组长度是否一致
		if(!is_array($rows) || (count($rows) != count($keys))){
			return false;
		}
		//比较数组值是否一致
		$diff = array_diff($rows, $keys);
		if(count($diff) != 0){
			return false;
		}
		return true;
	}
	
	//依据Excel的第一行构建插入的SQL语句头部
	function generateSqlHeader($template, $rows){
		$tablename = "";
		if ($template == 'promotion'){	 // 当模版是促销商品时
		
			$tablename = "jpd_promotion_goods";	//临时存放数据
			$templaterRows = DataImport::$promotionGoodsRows;
			$sql_header = "INSERT INTO `$tablename` (";
			for($i=0; $i<count($rows); $i++){
				//取列名称
				$column = $templaterRows[$rows[$i]];
				$sql_header .= '`'.$column.'`';
				if($i < count($rows)-1){
					$sql_header .= ',';
				}
			}
			$sql_header .= ',`Status`,`dealerId`,`startTime`, `endTime`';
			$sql_header .= ') values ';	
		}elseif ($template == 'subdealer'){
			
			$tablename = 'tbl_dealer_subdealer';
			$templaterRows = DataImport::$subdealer;
			//var_dump($templaterRows);exit;
			$sql_header = "INSERT INTO `$tablename` (";
			for($i=0; $i<count($rows); $i++){
				//取列名称
				$column = $templaterRows[$rows[$i]];
				
				$sql_header .= '`'.$column.'`';
				if($i < count($rows)-1){
					$sql_header .= ',';
				}
			}
			$sql_header .= ',`flag`,`UserID`';
			$sql_header .= ') values ';
		}elseif ($template == 'groupbatch'){
			
			$tablename = 'jpd_largegroup_branch';
			$templaterRows = DataImport::$groupbatch;
			$sql_header = "INSERT INTO `$tablename` (";
			for($i=0; $i<count($rows); $i++){
				//取列名称
				$column = $templaterRows[$rows[$i]];
				$sql_header .= '`'.$column.'`';
				if($i < count($rows)-1){
					$sql_header .= ',';
				}
			}
			$sql_header .= ',`UserID`';
			$sql_header .= ') values ';
		}
		return $sql_header;
	}
}