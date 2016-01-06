<?php
class UploadFile{
	public function upload($upload_file,$type,$size,$url){
		$file = $_FILES[$upload_file];
// 		if ($file['error']!=0){
// 			return array('message'=>'请选择文件');
// 		}
		$uploader = new Uploader();
		if ($type){
        	$uploader->allowed_type($type); // 限制文件类型
		}
		if ($size){
			$uploader->allowed_size($size);
		}
        $uploader->addFile($file);
        if($uploader->_file['error']){
        	return array('message'=>$uploader->_file['error']);
        }
		$newName = $uploader->random_filename();
        //$uploader->root_dir(dirname(Yii::app()->BasePath));
		$uploader->root_dir(Yii::app()->params['uploadPath']);
        $uploader->save($url, $newName);
        return array('filePath'=>dirname(Yii::app()->BasePath),'file'=>$url.$newName.'.'.$uploader->_file['extension']);
	}
	public function read_exldata($filename, $attribute) {
        $inputFileName = $filename;
        $extend = strtolower(strrchr($filename,'.'));
		$readerType = ($extend == '.xlsx')?'Excel2007':'Excel5';
        $objReader = new PHPExcel();
		$objReader = PHPExcel_IOFactory::createReader($readerType);
        $objPHPExcel = $objReader->load($inputFileName);
        $sheetData = $objPHPExcel->getActiveSheet()->toArray(null, true, true, true);
		$rows = array_filter($sheetData[1]);
		$keys = array_keys($attribute);
		//比较数组长度是否一致
		if(!is_array($rows) || (count($rows) != count($keys))){
			if(file_exists($filename)){
	        	 $result=unlink($filename);
	        }
			return array('message'=>"Excel内容与模板不符合");
			exit;
		}
		//比较数组值是否一致
		$diff = array_diff($rows, $keys);
		if(count($diff) != 0){
			if(file_exists($filename)){
	        	 $result=unlink($filename);
	        }
			return array('message'=>"Excel内容与模板不符合");
			exit;
		}
		$arr = array();
		foreach ( $attribute as $key => $data) {
            foreach ($rows as $pkey => $pval) {
            	if ($key==$pval){
               		$arr[$pkey] = $data;
            	}
            }
		}
        
        $sheetData = array_reverse($sheetData);//函数将原数组中的元素顺序翻转，创建新的数组并返回。
    	array_pop($sheetData);//删除数组中的最后一个元素
    	sort($sheetData);//函数按升序对给定数组的值排序。
        foreach ($sheetData as $key => $data) {
            foreach ($arr as $pkey => $pval) {
                $changedata[$pval] = (string)$data[$pkey];
            }
            unset($sheetData[$key]);
            $sheetData[$key] = $changedata;
            unset($changedata);
        }
        $sheetData = array_filter($sheetData);
        return $sheetData;
    }
	public function getCode($province,$city,$area){
		if ($province){
			$provincesql="select * from jpd_province where province like '{$province}%'";
			$provinceID=Yii::app()->db->createCommand($provincesql)->queryAll();
			if (count($provinceID)==1){
				foreach ($provinceID as $PID)
				{
					$result['province']=$PID['provinceID'];
					if ($city){
						$citysql="select * from jpd_province_city where father='{$PID['provinceID']}' and city like '{$city}%'";
						$cityID=Yii::app()->db->createCommand($citysql)->queryAll();
						if (count($cityID)==1){
							foreach ($cityID as $CID)
							{
								$result['city']=$CID['cityID'];
								if ($area){
									$areasql="select * from jpd_province_city_area where father='{$CID['cityID']}' and area like '{$area}%'";
									$areaID=Yii::app()->db->createCommand($areasql)->queryAll();
									if (count($areaID)==1){
										foreach ($areaID as $AID)
										{
											$result['area']=$AID['areaID'];
										}
									}
								}
							}
						}
					}
				}
			}
		}
		return $result;
	}
}