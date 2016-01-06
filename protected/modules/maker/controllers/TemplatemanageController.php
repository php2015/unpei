<?php
Class TemplatemanageController extends  Controller
{
	public $layout = '//layouts/maker';
	public function actionIndex()
	{
		$criteria = new CDbCriteria();
        $model= new GoodsTemplate();
       // $manufacturer_id=Yii::app()->user->id;
        $manufacturer_id= Commonmodel::getOrganID();
        //系统模板
         $s_sql="select distinct name,id,createtime,standard_id,"
         	   ."Column1,Column2,Column3,Column4,Column5"
         	   ." from tbl_goods_template"
         	   ." where mark='S' group by name";
         $sys_result=Yii::app()->db->createCommand($s_sql)->queryAll();
         if($sys_result){
            $count=count($sys_result);
            $page=new CPagination($count);
            //设置分页页数
            $page->pageSize=10;
            $page->applyLimit($criteria);
            $result=Yii::app()->db->createCommand($s_sql." LIMIT :offset,:limit");
            //绑定分页参数
            $result->bindValue(':offset', $page->currentPage*$page->pageSize);
            $result->bindValue(':limit', $page->pageSize);
            $sys_result=$result->queryAll();             
         }        
		//用户模板
         $u_sql="select distinct name,id,createtime,standard_id,"
         		."Column1,Column2,Column3,Column4,Column5"
         		." from tbl_goods_template"
         		." where mark='U' and manufacturer_id=$manufacturer_id group by name";
         $uc_result=Yii::app()->db->createCommand($u_sql)->queryAll();
         if($uc_result){
             $count=count($uc_result);
            $pages=new CPagination($count);
            //设置分页页数
            $pages->pageSize=10;
            $pages->applyLimit($criteria);
            $result=Yii::app()->db->createCommand($u_sql." LIMIT :offset,:limit");
            //绑定分页参数
            $result->bindValue(':offset', $pages->currentPage*$pages->pageSize);
            $result->bindValue(':limit', $pages->pageSize);
            $uc_result=$result->queryAll();
             
         }
        
	$this->render('index',array('sys_result'=>$sys_result,'uc_result'=>$uc_result,'pages'=>$pages,'page'=>$page));
	}
	//模板新建
	public function actionAdd()
	{
		$model= new GoodsTemplate();
		//ajax客户端验证
		if(isset($_POST['ajax'])&& $_POST['ajax']==='templateadd-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
                
		if(isset($_POST['GoodsTemplate']))
		{
			//当前生产商ID
			//$manufacturer_id=Yii::app()->user->id;
			$manufacturer_id= Commonmodel::getOrganID();
			$model->attributes=$_POST['GoodsTemplate'];
			$model->manufacturer_id=$manufacturer_id;
			$model->mark='U';
            $model->standard_id=$_POST['GoodsTemplate']['cpname'];
			//前端验证是否成功
			if($model->validate())
			{
				//插入添加信息
				if($model->save())
				{
					Yii::app()->user->setFlash('success','模板添加成功');
					$this->refresh();
				}
				else {
					Yii::app()->user->setFlash('faield','模板添加失败');
				}
			}
		}
		//所有常用配件
		$sql="select distinct system_type,id from tbl_goods_standard where system_type is not null group by system_type";
		$parts=Yii::app()->db->createCommand($sql)->queryAll();
		//$parts=GoodsStandard::model()->findAll("consumable=:consumable",array(':consumable'=>'Y'));
		$this->render('add',array('model'=>$model,'parts'=>$parts));
	}
	//修改模板
        public function actionModify()
        {
            $id=intval($_GET['id']);
           // $manufacturer_id=Yii::app()->user->id;
            $manufacturer_id= Commonmodel::getOrganID();
            $model= New GoodsTemplate();
            if(isset($_POST['ajax'])&& $_POST['ajax']==='templatemodify-form')
            {
            	echo CActiveForm::validate($model);
            	Yii::app()->end();
            }
            $sql="select a.name,a.Column1,a.Column2,a.Column3,a.Column4,a.Column5,b.cp_name,a.standard_id,b.system_type from tbl_goods_template a,tbl_goods_standard b "
            	." where b.id=a.standard_id and a.id=$id and manufacturer_id= $manufacturer_id";
            $result=DBUtil::query($sql);
            $model->system_type=$result['system_type'];
            $model->cpname=$result['standard_id'];
            if(isset($_POST['GoodsTemplate']))
            {
                 $model->attributes=$_POST['GoodsTemplate'];
                 $name=$_POST['GoodsTemplate']['name'];
                 $Column1=$_POST['GoodsTemplate']['Column1'];
                 $Column2=$_POST['GoodsTemplate']['Column2'];
                 $Column3=$_POST['GoodsTemplate']['Column3'];
                 $Column4=$_POST['GoodsTemplate']['Column4'];
                 $Column5=$_POST['GoodsTemplate']['Column5'];
                 $standard_id=$_POST['GoodsTemplate']['cpname'];
                 $result=$model->updateByPk($id,array('name'=>$name,'Column1'=>$Column1,'Column2'=>$Column2,
                     'Column3'=>$Column3,'Column4'=>$Column4,'Column5'=>$Column5,'standard_id'=>$standard_id));
                 Yii::app()->user->setFlash('success','修改成功');
                  $this->refresh();
            }
            //所有常用配件
           $sql="select distinct system_type,id from tbl_goods_standard where system_type is not null group by system_type";
			$parts=Yii::app()->db->createCommand($sql)->queryAll();
            $this->render('modify',array('model'=>$model,'result'=>$result,'parts'=>$parts));
        }
       
        public function actionGetcpname()
        {
        	if (!empty($_GET['system_type'])){
        		$data = GoodsStandard::model()->findAll("system_type=:system_type", array(":system_type" => $_GET['system_type']));
        		$data = CHtml::listData($data, "id", "cp_name");
        		foreach ($data as $value => $name) {
        			echo CHtml::tag("option", array("value" => $value), CHtml::encode($name), true);
        		}
        	}
        	else
        	{
        		echo CHtml::tag("option", array("value" => ''), '请选择品类', true);
        	}
        }
        //客户模板删除
        public function actionDelete()
        {
            $id=intval($_POST['crowid']);
            $model=new GoodsTemplate();
            $result=$model->deleteByPk($id);
            if($result)
            {
                Yii::app()->user->setFlash('success','模板删除成功');
            }
            else
            {
                Yii::app()->user->setFlash('failed','模板删除失败');
                $this->redirect(array('templatemanage/index'));
            }
            echo json_encode($result);
        }
	//Excel导出
	public function actionImportoutexcel()
	{
		 $objectPHPExcel = new PHPExcel();
		$objectPHPExcel->setActiveSheetIndex(0);
		//当期查询出的数据
		if(intval($_GET['id']))
		{
	        $template=GoodsTemplate::model()->findAll('id=:id',array(':id'=>$_GET['id']));
 		    $n = 0;
 		    foreach ( $template as $list )
 			{
					//报表头的输出
					$objectPHPExcel->getActiveSheet()->mergeCells('B1:G1');
					$objectPHPExcel->getActiveSheet()->setCellValue('B1','商品模板表');
					 
					$objectPHPExcel->setActiveSheetIndex(0)->setCellValue('B2','商品模板表');
					$objectPHPExcel->setActiveSheetIndex(0)->setCellValue('B2','商品模板表');
					$objectPHPExcel->setActiveSheetIndex(0)->getStyle('B1')->getFont()->setSize(24);
					$objectPHPExcel->setActiveSheetIndex(0)->getStyle('B1')
					->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
					 
					$objectPHPExcel->setActiveSheetIndex(0)->setCellValue('B2','日期：'.date("Y年m月j日"));
					$objectPHPExcel->setActiveSheetIndex(0)->getStyle('E2')
					->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_RIGHT);
					 
					//表格头的输出
					
					$objectPHPExcel->setActiveSheetIndex(0)->setCellValue('B3','模板名称');
					$objectPHPExcel->getActiveSheet()->getColumnDimension('B')->setWidth(22);
					$objectPHPExcel->setActiveSheetIndex(0)->setCellValue('C3','创建时间');
					$objectPHPExcel->getActiveSheet()->getColumnDimension('C')->setWidth(22);
					$objectPHPExcel->setActiveSheetIndex(0)->setCellValue('D3','标识位（s系统/u用户）');
					$objectPHPExcel->getActiveSheet()->getColumnDimension('D')->setWidth(22);
					$objectPHPExcel->setActiveSheetIndex(0)->setCellValue('E3','参数名1');
					$objectPHPExcel->getActiveSheet()->getColumnDimension('E')->setWidth(22);
					$objectPHPExcel->setActiveSheetIndex(0)->setCellValue('F3','参数名2');
					$objectPHPExcel->getActiveSheet()->getColumnDimension('F')->setWidth(22);
					$objectPHPExcel->setActiveSheetIndex(0)->setCellValue('G3','参数名3');
					$objectPHPExcel->getActiveSheet()->getColumnDimension('G')->setWidth(22);
					$objectPHPExcel->setActiveSheetIndex(0)->setCellValue('H3','参数名4');
					$objectPHPExcel->getActiveSheet()->getColumnDimension('H')->setWidth(22);
					$objectPHPExcel->setActiveSheetIndex(0)->setCellValue('I3','参数名5');
					 
					$objectPHPExcel->getActiveSheet()->getRowDimension('1')->setRowHeight(32);
					//设置居中
					$objectPHPExcel->getActiveSheet()->getStyle('B3:I3')
					->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
					 
					//设置边框
					$objectPHPExcel->getActiveSheet()->getStyle('B3:I3' )
					->getBorders()->getTop()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
					$objectPHPExcel->getActiveSheet()->getStyle('B3:I3' )
					->getBorders()->getLeft()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
					$objectPHPExcel->getActiveSheet()->getStyle('B3:I3' )
					->getBorders()->getRight()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
					$objectPHPExcel->getActiveSheet()->getStyle('B3:I3' )
					->getBorders()->getBottom()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
					$objectPHPExcel->getActiveSheet()->getStyle('B3:I3' )
					->getBorders()->getVertical()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
					$objectPHPExcel->getActiveSheet()->getStyle('B3:I3' )
					->getBorders()->getVertical()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
					$objectPHPExcel->getActiveSheet()->getStyle('B3:I3' )
					->getBorders()->getVertical()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
					$objectPHPExcel->getActiveSheet()->getStyle('B3:I3' )
					->getBorders()->getVertical()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
					$objectPHPExcel->getActiveSheet()->getStyle('B3:I3' )
					->getBorders()->getVertical()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
					$objectPHPExcel->getActiveSheet()->getStyle('B3:I3' )
					->getBorders()->getVertical()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
					 
					//设置颜色
					$objectPHPExcel->getActiveSheet()->getStyle('B3:I3')->getFill()
					->setFillType(PHPExcel_Style_Fill::FILL_SOLID)->getStartColor()->setARGB('FF66CCCC');
  			}
				//明细的输出
				$objectPHPExcel->getActiveSheet()->setCellValue('B'.($n+4) ,$list['name']);
				$objectPHPExcel->getActiveSheet()->setCellValue('C'.($n+4) ,date('Y-m-d H:i:s',$list['createtime']));
				$objectPHPExcel->getActiveSheet()->setCellValue('D'.($n+4) ,$list['mark']);
				$objectPHPExcel->getActiveSheet()->setCellValue('E'.($n+4) ,$list['Column1']);
				$objectPHPExcel->getActiveSheet()->setCellValue('F'.($n+4) ,$list['Column2']);
				$objectPHPExcel->getActiveSheet()->setCellValue('G'.($n+4) ,$list['Column3']);
				$objectPHPExcel->getActiveSheet()->setCellValue('H'.($n+4) ,$list['Column4']);
				$objectPHPExcel->getActiveSheet()->setCellValue('I'.($n+4) ,$list['Column5']);
				//设置边框
				$currentRowNum = $n+4;
				$objectPHPExcel->getActiveSheet()->getStyle('B'.($n+4).':I'.$currentRowNum )
				->getBorders()->getTop()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
				$objectPHPExcel->getActiveSheet()->getStyle('B'.($n+4).':I'.$currentRowNum )
				->getBorders()->getLeft()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
				$objectPHPExcel->getActiveSheet()->getStyle('B'.($n+4).':I'.$currentRowNum )
				->getBorders()->getRight()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
				$objectPHPExcel->getActiveSheet()->getStyle('B'.($n+4).':I'.$currentRowNum )
				->getBorders()->getBottom()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
				$objectPHPExcel->getActiveSheet()->getStyle('B'.($n+4).':I'.$currentRowNum )
				->getBorders()->getVertical()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
				$n = $n +1;
	
			 
			//设置分页显示
			//$objectPHPExcel->getActiveSheet()->setBreak( 'I55' , PHPExcel_Worksheet::BREAK_ROW );
			$objectPHPExcel->getActiveSheet()->setBreak( 'I10' , PHPExcel_Worksheet::BREAK_COLUMN );
			//$objectPHPExcel->getActiveSheet()->getPageSetup()->setHorizontalCentered(true);
			//$objectPHPExcel->getActiveSheet()->getPageSetup()->setVerticalCentered(false);
			 
			ob_end_clean();
			ob_start();
			header('Content-Type : application/vnd.ms-excel');
			header('Content-Disposition:attachment;filename="'.'商品模板表-'.date("Y-m-d").'.xls"');
			$objWriter= PHPExcel_IOFactory::createWriter($objectPHPExcel,'Excel5');
			$objWriter->save('php://output');
	  }
	}
}