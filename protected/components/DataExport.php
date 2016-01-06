<?php 
require_once 'PHPExcel/PHPExcel.php';
require_once 'PHPExcel/PHPExcel/IOFactory.php';
require_once 'PHPExcel/PHPExcel/Reader/Excel5.php';
require_once 'PHPExcel/PHPExcel/Reader/Excel2007.php';
include_once 'PHPExcel/PHPExcel/Writer/IWriter.php' ;		//导出
include_once 'PHPExcel/PHPExcel/Writer/Excel5.php' ;
include_once 'PHPExcel/PHPExcel/Writer/Excel2007.php' ;
class DataExport
{	

	
	/**
     * excel导出函数
     * $data为从数据库中获取到的数据
     * $excelFileName下载的excel的文件名称
     * $sheetTitle第一个工作区的名称
     *  excel_export($arr,"快递单","快递发送记录");
    */
	function excel_export($data,$excelFileName,$sheetTitle){
    
    
    /* 实例化类 */
    $objPHPExcel = new PHPExcel();
    
    /* 设置输出的excel文件为2007兼容格式 */
    //$objWriter=new PHPExcel_Writer_Excel5($objPHPExcel);//非2007格式
    $objWriter = new PHPExcel_Writer_Excel2007($objPHPExcel);
    
    /* 设置当前的sheet */
    $objPHPExcel->setActiveSheetIndex(0);
    
    $objActSheet = $objPHPExcel->getActiveSheet();
    
    /* sheet标题 */
    $objActSheet->setTitle($sheetTitle);
    $i = 1;
    foreach($data as $value)
    {
        /* excel文件内容 */
        $j = 'A';
        foreach($value as $value2)
        {
            //$value2=iconv("gbk","utf-8",$value2);
            $objActSheet->setCellValue($j.$i,$value2);
            $j++;
        }
        $i++;
    }
    
    /* 生成文件 */
    /* $putPutFileName = "test.xlsx";
    $objWriter->save($putPutFileName); */
   // $objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');   //通过PHPExcel_IOFactory的写函数将上面数据写出来
 	//$objWriter->save($excelFileName.'.xlsx');     //设置以什么格式保存，及保存位置
    
    /* 生成到浏览器，提供下载 */
    header("Pragma: public");
    header("Expires: 0");
    header("Cache-Control:must-revalidate,post-check=0,pre-check=0");
    header("Content-Type:application/force-download");
    header("Content-Type:application/vnd.ms-execl");
    header("Content-Type:application/octet-stream");
    header("Content-Type:application/download");
    header('Content-Disposition:attachment;filename="'.$excelFileName.'.xlsx"');
    header("Content-Transfer-Encoding:binary");
    $objWriter->save('php://output');
    
    /*
    	设置excel的属性：
    
    //设置当前的sheet
    $objPHPExcel->setActiveSheetIndex(0);
    
    //设置sheet的name
    $objPHPExcel->getActiveSheet()->setTitle(’Simple’);
    
    //创建人
    $objPHPExcel->getProperties()->setCreator(”Maarten Balliauw”);
    
    //最后修改人
    $objPHPExcel->getProperties()->setLastModifiedBy(”Maarten Balliauw”);
    
    //标题
    $objPHPExcel->getProperties()->setTitle(”Office 2007 XLSX Test Document”);
    
    //题目
    $objPHPExcel->getProperties()->setSubject(”Office 2007 XLSX Test Document”);
    
    //描述
    $objPHPExcel->getProperties()->setDescription(”Test document for Office 2007 XLSX, generated using PHP classes.”);
    
    //关键字
    $objPHPExcel->getProperties()->setKeywords(”office 2007 openxml php”);
    
    //种类
    $objPHPExcel->getProperties()->setCategory(”Test result file”);
    
    ——————————————————————————————————————–
    
    //设置单元格的值
     //$t=$key+1
    $objPHPExcel->getActiveSheet()->setCellValue(’A$t′, ‘String’);
    $objPHPExcel->getActiveSheet()->setCellValue(’A2′, 12);
    $objPHPExcel->getActiveSheet()->setCellValue(’A3′, true);
    $objPHPExcel->getActiveSheet()->setCellValue(’C5′, ‘=SUM(C2:C4)’);
    $objPHPExcel->getActiveSheet()->setCellValue(’B8′, ‘=MIN(B2:C5)’);
    
    //合并单元格
    $objPHPExcel->getActiveSheet()->mergeCells(’A18:E22′);
    
    //分离单元格
    $objPHPExcel->getActiveSheet()->mergeCells(’A18:E22′);
    $objPHPExcel->getActiveSheet()->mergeCells(’A28:B28′);
    $objPHPExcel->getActiveSheet()->unmergeCells(’A28:B28′);
    
    //保护cell
    $objPHPExcel->getActiveSheet()->getProtection()->setSheet(true); // Needs to be set to true in order to enable any worksheet protection!
    $objPHPExcel->getActiveSheet()->protectCells(’A3:E13′, ‘PHPExcel’);
    
    //设置格式
    // Set cell number formats
    echo date(’H:i:s’) . ” Set cell number formats\n”;
    $objPHPExcel->getActiveSheet()->getStyle(’E4′)->getNumberFormat()->setFormatCode(PHPExcel_Style_NumberFormat::FORMAT_CURRENCY_EUR_SIMPLE);
    $objPHPExcel->getActiveSheet()->duplicateStyle( $objPHPExcel->getActiveSheet()->getStyle(’E4′), ‘E5:E13′ );
    
    //设置宽width
    // Set column widths
    $objPHPExcel->getActiveSheet()->getColumnDimension(’B')->setAutoSize(true);
    $objPHPExcel->getActiveSheet()->getColumnDimension(’D')->setWidth(12);
    
    //设置font
    $objPHPExcel->getActiveSheet()->getStyle(’B1′)->getFont()->setName(’Candara’);
    $objPHPExcel->getActiveSheet()->getStyle(’B1′)->getFont()->setSize(20);
    $objPHPExcel->getActiveSheet()->getStyle(’B1′)->getFont()->setBold(true);
    $objPHPExcel->getActiveSheet()->getStyle(’B1′)->getFont()->setUnderline(PHPExcel_Style_Font::UNDERLINE_SINGLE);
    $objPHPExcel->getActiveSheet()->getStyle(’B1′)->getFont()->getColor()->setARGB(PHPExcel_Style_Color::COLOR_WHITE);
    $objPHPExcel->getActiveSheet()->getStyle(’E1′)->getFont()->getColor()->setARGB(PHPExcel_Style_Color::COLOR_WHITE);
    $objPHPExcel->getActiveSheet()->getStyle(’D13′)->getFont()->setBold(true);
    $objPHPExcel->getActiveSheet()->getStyle(’E13′)->getFont()->setBold(true);
    
    //设置align
    $objPHPExcel->getActiveSheet()->getStyle(’D11′)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_RIGHT);
    $objPHPExcel->getActiveSheet()->getStyle(’D12′)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_RIGHT);
    $objPHPExcel->getActiveSheet()->getStyle(’D13′)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_RIGHT);
    $objPHPExcel->getActiveSheet()->getStyle(’A18′)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_JUSTIFY);
    
    //垂直居中
    $objPHPExcel->getActiveSheet()->getStyle(’A18′)->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);
    
    //设置column的border
    $objPHPExcel->getActiveSheet()->getStyle(’A4′)->getBorders()->getTop()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
    $objPHPExcel->getActiveSheet()->getStyle(’B4′)->getBorders()->getTop()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
    $objPHPExcel->getActiveSheet()->getStyle(’C4′)->getBorders()->getTop()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
    $objPHPExcel->getActiveSheet()->getStyle(’D4′)->getBorders()->getTop()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
    $objPHPExcel->getActiveSheet()->getStyle(’E4′)->getBorders()->getTop()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
    
    //设置border的color
    $objPHPExcel->getActiveSheet()->getStyle(’D13′)->getBorders()->getLeft()->getColor()->setARGB(’FF993300′);
    $objPHPExcel->getActiveSheet()->getStyle(’D13′)->getBorders()->getTop()->getColor()->setARGB(’FF993300′);
    $objPHPExcel->getActiveSheet()->getStyle(’D13′)->getBorders()->getBottom()->getColor()->setARGB(’FF993300′);
    $objPHPExcel->getActiveSheet()->getStyle(’E13′)->getBorders()->getTop()->getColor()->setARGB(’FF993300′);
    $objPHPExcel->getActiveSheet()->getStyle(’E13′)->getBorders()->getBottom()->getColor()->setARGB(’FF993300′);
    $objPHPExcel->getActiveSheet()->getStyle(’E13′)->getBorders()->getRight()->getColor()->setARGB(’FF993300′);
    
    //设置填充颜色
    $objPHPExcel->getActiveSheet()->getStyle(’A1′)->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID);
    $objPHPExcel->getActiveSheet()->getStyle(’A1′)->getFill()->getStartColor()->setARGB(’FF808080′);
    $objPHPExcel->getActiveSheet()->getStyle(’B1′)->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID);
    $objPHPExcel->getActiveSheet()->getStyle(’B1′)->getFill()->getStartColor()->setARGB(’FF808080′);
    
    //加图片
    $objDrawing = new PHPExcel_Worksheet_Drawing();
    $objDrawing->setName(’Logo’);
    $objDrawing->setDescription(’Logo’);
    $objDrawing->setPath(’./images/officelogo.jpg’);
    $objDrawing->setHeight(36);
    $objDrawing->setWorksheet($objPHPExcel->getActiveSheet());
    $objDrawing = new PHPExcel_Worksheet_Drawing();
    $objDrawing->setName(’Paid’);
    $objDrawing->setDescription(’Paid’);
    $objDrawing->setPath(’./images/paid.png’);
    $objDrawing->setCoordinates(’B15′);
    $objDrawing->setOffsetX(110);
    $objDrawing->setRotation(25);
    $objDrawing->getShadow()->setVisible(true);
    $objDrawing->getShadow()->setDirection(45);
    $objDrawing->setWorksheet($objPHPExcel->getActiveSheet());

    //在默认sheet后，创建一个worksheet
    echo date(’H:i:s’) . ” Create new Worksheet object\n”;
    $objPHPExcel->createSheet();
     */
	}
}
?>