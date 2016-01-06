<?php

class StandardparamsController extends Controller {

    public $layout = '//layouts/maker';

    //标准名称参数管理
    public function actionIndex() {
        $this->render('index');
    }

    //获取标准名称参数列表
    public function actionGetstandardparamlists() {
        $organID = Commonmodel::getOrganID();
        $criteria = new CDbCriteria();
        $criteria->addCondition('organID=' . $organID);
        $criteria->addCondition('mark="U" and ISdelete="N"');
        $criteria->group = 'standard_id';
//        //查询数据总数
//        $sql='SELECT count(distinct standard_id) as count FROM `tbl_make_goods_template` where organID='.$organID.' and mark="U" and ISdelete="N"';
//        $count=Yii::app()->db->createCommand($sql)->queryAll();
//        $total=$count[0]['count'];sss
        $count = MakeGoodsTemplate::model()->count($criteria);
        $criteria->order = 'id desc';
        //分页
        $pages = new CPagination($count);
        $pages->pageSize = isset($_GET['rows']) ? intval($_GET['rows']) : 10;
        $pages->applyLimit($criteria);
        $datas = MakeGoodsTemplate::model()->findAll($criteria);
        $res = array();
        foreach ($datas as $key => $data) {
            //根据标准名称id查询标准名称
            $res[$key]['id'] = $data['standard_id'];
            $standard = Gcategory::model()->findByPk($data['standard_id']);
            $res[$key]['name'] = $standard['name'];
            $res[$key]['createtime'] = date('Y-m-d H:i:s', $data['createtime']);
            //标准名称参数对应的商品数量
            $sql='select count(b.standard_id) from tbl_make_goods a,tbl_make_goods_version b where a.ISdelete=0 and '
                 .'a.NewVersion=b.version_name and a.id=b.goods_id and b.standard_id='.$data['standard_id'].' and b.organID='.$organID;
            $result=Yii::app()->db->createCommand($sql)->queryRow();
            $res[$key]['count'] =$result['count(b.standard_id)'];
        }
        echo json_encode(array('total' => $count, 'rows' => $res));
    }

    //根据标准名称id查询参数名
    public function actionGetparams() {
        $organID = Commonmodel::getOrganID();
        $standardid = intval($_POST['id']);
        $lists = MakeGoodsTemplate::model()->findAll('organID=' . $organID . ' and mark="U" and ISdelete="N" and standard_id=' . $standardid);
        $params = array();
        foreach ($lists as $list) {
            $params[] = $list['name'];
        }
        $res['name'] = $params;
        //查询大类和子类
        if (isset($_POST['extra'])) {
            $standard = Gcategory::model()->findByPk($standardid);
            $data['subid'] = $standard['parent_id'];
            $sub = Gcategory::model()->findByPk($standard['parent_id']);
            $data['subname'] = $sub['name'];
            $data['mainid'] = $sub['parent_id'];
            $main = Gcategory::model()->findByPk($sub['parent_id']);
            $data['mainname']=$main['name'];
            $res['category'] = $data;
        }
        echo json_encode($res);
    }

    //添加标准名称参数
    public function actionAddstandardparam() {
        $organID = Commonmodel::getOrganID();
        $userId = Yii::app()->user->id;
        $standardid = intval($_POST['standardid']);
        $params = explode(',', $_POST['params']);
        $res = 1;
        foreach ($params as $param) {
            $model = new MakeGoodsTemplate;
            $model->name = $param;
            $model->organID = $organID;
            $model->userID = $userId;
            $model->createtime = time();
            $model->updatetime = time();
            $model->mark = 'U';
            $model->standard_id = $standardid;
            $model->ISdelete = 'N';
            if ($model->save()) {
                $res = 2;
            }
            unset($model);
        }
        if ($res == 2)
            echo json_encode(array('msg' => 'ok'));
    }

    //查询标准名称是否存在
    public function actionQuerystandardexist() {
        $organID = Commonmodel::getOrganID();
        $standardid = intval($_POST['standardid']);
        $data = MakeGoodsTemplate::model()->find('organID=' . $organID . ' and ISdelete="N" and standard_id=' . $standardid);
        if ($data)
            echo 1;  //存在
        else
            echo 2;   //不存在    
    }

    //更新标准名称参数
    public function actionUpdatestandardparam() {
        $organID = Commonmodel::getOrganID();
        $userId = Yii::app()->user->id;
        $standardid = intval($_GET['standardid']);
        $params = explode(',', $_POST['params']);
        $datas = MakeGoodsTemplate::model()->findAll('organID=' . $organID . ' and ISdelete="N" and standard_id=' . $standardid);
        $res = 1;
        //更新原来的标准名称参数名
        foreach ($datas as $key => $data) {
            if (isset($params[$key]))
                $data->name = $params[$key];
            else
                $data->ISdelete = 'Y';
            $data->userID = $userId;
            $data->updatetime = time();
            if ($data->save()) {
                $res = 2;
            }
        }
        //添加新的标准名称参数名
        if (count($datas) < count($params)) {
            $newparams = array_slice($params, count($datas));
            foreach ($newparams as $param) {
                $model = new MakeGoodsTemplate;
                $model->name = $param;
                $model->organID = $organID;
                $model->userID = $userId;
                $model->createtime = time();
                $model->updatetime = time();
                $model->mark = 'U';
                $model->standard_id = $standardid;
                $model->ISdelete = 'N';
                if ($model->save()) {
                    $res = 2;
                }
                unset($model);
            }
        }
        if ($res == 2)
            echo json_encode(array('msg' => 'ok'));
    }

    //删除标准名称参数
    public function actionDelstandardparam() {
        $organID = Commonmodel::getOrganID();
        $standardid = intval($_POST['standardid']);
        $count = MakeGoodsTemplate::model()->deleteAll('organID=' . $organID . ' and standard_id=' . $standardid);
        if ($count > 0)
            echo $count;
    }

    //下载标准名称参数模板
    public function actionDownloadtemplate() {
        $organID = Commonmodel::getOrganID();
        $standardid = intval($_GET['standardid']);
        $datas = MakeGoodsTemplate::model()->findAll('organID=' . $organID . ' and ISdelete="N" and standard_id=' . $standardid);
        $paramsname = array();
        $list = array();
        foreach ($datas as $data) {
            $paramsname[] = $data['name'];
        }
        //其他数据
        if ($datas) {
            //标准名称
            $standarddata = Gcategory::model()->findByPk($standardid);
            $list['name'] = $standarddata['name'];
            $list['createtime'] = date('Y-m-d H:i:s', $datas[0]['createtime']);
            $list['mark'] = $datas[0]['mark'];
        }
        //导出excel表格
        $objPHPExcel = new PHPExcel();
        // 操作第一个工作表(默认是操作第一个)
        $objPHPExcel->setActiveSheetIndex(0);
        //得到当前活动sheet(默认是第一个sheet)
        $objActSheet = $objPHPExcel->getActiveSheet();
        // 设置当前活动sheet的名称 
        $objActSheet->setTitle('标准名称参数模板表');
        //设置某列宽度自动大小
        //$objActSheet->getColumnDimension('E')->setAutoSize(true); 
        //设置某列宽度
        $objActSheet->getColumnDimension('B')->setWidth(20);
        $objActSheet->getColumnDimension('C')->setWidth(20);
        $objActSheet->getColumnDimension('D')->setWidth(20);

        //合并B1-G2
        //$objActSheet->mergeCells('B1:G2');
        //设置B1的值为 '标准名称参数模板'
        $objActSheet->setCellValue('B1', '标准名称参数模板');
        //设置 B1 样式居中
        $objActSheet->getStyle('B1')
                ->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
        //设置 B1字体大小
        $objActSheet->getStyle('B1')->getFont()->setSize(24);
        //设置颜色
        //$objActSheet->getStyle('A3')->getFont()->getColor()->setARGB(PHPExcel_Style_Color::COLOR_RED);
        //设置某列宽度自动大小
        //$objActSheet->getColumnDimension($a)->setAutoSize(true);
        $objActSheet->setCellValue('B3', '日期: ' . date('Y年m月d日', time()));

        $objActSheet->setCellValue('B4', '模版名称');
        $objActSheet->setCellValue('B5', $list['name']);
        $objActSheet->setCellValue('C4', '创建时间');
        $objActSheet->setCellValue('c5', $list['createtime']);
        $objActSheet->setCellValue('D4', '标识符(S系统/U用户)');
        $objActSheet->setCellValue('D5', $list['mark']);
        $cell = 'D';
        foreach ($paramsname as $k => $v) {
            $cell++;
            $num = 4;
            //设置单元格宽度
            $objActSheet->getColumnDimension($cell)->setWidth(15);
            ;
            $objActSheet->setCellValue($cell . $num, '参数名称' . ($k + 1));
            $objActSheet->setCellValue($cell . ($num + 1), $v);
        }
        //设置填充的样式和背景色
        $objActSheet->getStyle('B4:' . $cell . '4')->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID);
        $objActSheet->getStyle('B4:' . $cell . '4')->getFill()->getStartColor()->setARGB('FF66CCCC');
        //合并单元格
        $objActSheet->mergeCells('B1:' . $cell . '2');

//        //添加一个新的worksheet     
//        $objPHPExcel->createSheet();
//        //得到第二个sheet
//        $secondsheet=$objPHPExcel->getSheet(1);     
//        $secondsheet->setTitle('测试sheet2');
//        //保护单元格     
//        $secondsheet->getProtection()->setSheet(true);     
//        $secondsheet->protectCells('A1:C22', 'PHPExcel');   
        //输出
        header('Content-Type : application/vnd.ms-excel');
        header('Content-Disposition:attachment;filename="' . '标准名称参数模板表-' . $list['name'] . '-' . date("Y-m-d") . '.xls"');
        $objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel5');
        $objWriter->save('php://output');
    }
    public function actionDownload()
    {
        $organID=  Commonmodel::getOrganID();
        $standardid=  intval($_GET['standardid']);
        //标准名称
        $standarddata=  Gcategory::model()->findByPk($standardid);
        //查询标准名称参数名
        $datas=MakeGoodsTemplate::model()->findAll('organID='.$organID.' and ISdelete="N" and standard_id='.$standardid);
        $paramsname=array();
        $list=array();
        //其他数据
        $columnnames=array();
        if($datas)
        {
            $columnnames=array('商品ID','商品编号（必填）','商品名称（必填）','商品品牌','标准名称','OE号','标杆品牌','标杆商品号','市场指导价',
                              '销售价','优惠价','库存（有/无）','发货天数','备注','上下架','适用车系','商品版本号');
        }
        foreach ($datas as $data)
        {
            $columnnames[]=$data['name'];
        }
        //导出excel表格
        $objPHPExcel = new PHPExcel();
        // 操作第一个工作表(默认是操作第一个)
        $objPHPExcel->setActiveSheetIndex(0);
        //得到当前活动sheet(默认是第一个sheet)
        $objActSheet = $objPHPExcel->getActiveSheet(); 
        // 设置当前活动sheet的名称 
        $objActSheet->setTitle($standarddata['name'].'-模板表');
        //设置B1的值为 '标准名称参数模板'
        $objActSheet->setCellValue('B1','标准名称参数模板');
        //设置颜色
        //$objActSheet->getStyle('A3')->getFont()->getColor()->setARGB(PHPExcel_Style_Color::COLOR_RED);
        $num=1;
        foreach($columnnames as $k=>$v)
        {
            $cell=PHPExcel_Cell::stringFromColumnIndex($k);
            $objActSheet->getColumnDimension($cell)->setWidth(20); 
            $excelstyle=$objActSheet->getStyle($cell.$num); 
            $excelstyle->getFont()->getColor()->setARGB(PHPExcel_Style_Color::COLOR_RED);
            $excelstyle->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);  
            $excelstyle->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER); 
            $objActSheet->setCellValue($cell.$num,$v);
        }
        //设置填充的样式和背景色
        //$objActSheet->getStyle('A1:'.$cell.'1')->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID);
        //$objActSheet->getStyle('A1:'.$cell.'1')->getFill()->getStartColor()->setARGB(PHPExcel_Style_Color::COLOR_RED);
          
        //输出
        header('Content-Type : application/vnd.ms-excel');
        header('Content-Disposition:attachment;filename="'.'标准名称参数模板表-'.$standarddata['name'].'-'.date("Y-m-d").'.xls"');
        $objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel5');
        $objWriter->save('php://output');    
    }
    

    public function actionDowngoodstemp() {
//        模版字段        
//        商品编号、商品名称、商品品牌、配件品类（选择标准名称）、标杆品牌、
//        标杆商品号、市场指导价、销售价、优惠价、现有库存、发货天数、配送说明、
//        备注、参数名称1、参数名称2、参数名称3、参数名称4、参数名称5…
        // 模版基础字段
        $basis = array(
            'goods_no' => '商品编号（必填）',           // 商品编号
            'goods_name' => '商品名称（必填）',         // 商品名称
            'brand' => '品牌',      // tbl_make_goods
            'goods_oe'=>'OE号（必填,多个OE号以逗号隔开）',   
            'carmodel'=>'适用车型', 
//            'category' => '配件品类',           // 配件品类
            'benchmarking_brand' => '标杆品牌', // 标杆品牌
            'benchmarking_sn' => '标杆商品号',  // 标杆商品号
//            'marketprice' => '市场指导价',      // 市场指导价
//            'salesprice' => '销售价',           // 销售价
//            'discountprice' => '优惠价',        // 优惠价
            'inventory' => '库存（有/无）',              // 库存
            'senddays' => '发货天数',           // 发货天数
            'description' => '备注',            // 备注
        );
        
        // 嘉配样式数据
        $jiapartsdatas = array(
            'goods_no' => 'JP00001',        // 商品编号
            'goods_name' => '嘉配样品',     // 商品名称
            'brand' => '奇瑞',              // tbl_make_goods
            'goods_oe' => 'OE001,OE002',              // tbl_make_goods
            'carmodel' => 'ST1',              // 适用车型
//            'category' => '出水管',        // 配件品类
            'benchmarking_brand' => '奇瑞', // 标杆品牌
            'benchmarking_sn' => 'QR00001', // 标杆商品号
//            'marketprice' => '1100',        // 市场指导价
//            'salesprice' => '1000',         // 销售价
//            'discountprice' => '999',       // 优惠价
            'inventory' => '有',           // 库存
            'senddays' => '2',            // 发货天数
            'description' => '批量导入时请删掉 嘉配样品 数据', // 备注
        );

        $organID = Commonmodel::getOrganID();
       // $standardid = intval($_GET['standardid']);
       $standardid =  Yii::app()->request->getParam('standardid');
       $name =  Yii::app()->request->getParam('name');
       // $standardid = 1201221;
        $datas = MakeGoodsTemplate::model()->findAll('organID=' . $organID . ' and ISdelete="N" and standard_id=' . $standardid);
        $paramsname = array();  // 参数名称
        if ($datas) {
            foreach ($datas as $data) {
                $paramsname['_'.$data['id']] = $data['name'];
            }
        }
        //  var_dump($paramsname);
         $goodstemps = array_merge($basis, $paramsname);
//        $goodstemps = array_merge($basis);
        $jiapartsdataseg = array_merge($jiapartsdatas, $paramsname);
//        $jiapartsdataseg = array_merge($jiapartsdatas);
       //    var_dump($goodstemps); exit;
        //导出excel表格
        $objPHPExcel = new PHPExcel();
        // 操作第一个工作表(默认是操作第一个)
        $objPHPExcel->setActiveSheetIndex(0);
        //得到当前活动sheet(默认是第一个sheet)
        $objActSheet = $objPHPExcel->getActiveSheet();
        // 设置当前活动sheet的名称 
        $objActSheet->setTitle('标准名称参数模板');
        $cell = 'A';
        foreach ($goodstemps as $k => $value) {
            //$num=4;
            //设置单元格宽度
            $objActSheet->getColumnDimension($cell)->setWidth(15);
            $objActSheet->setCellValue($cell . '1', $value);
            //设置边框
             //设置边框
            $objActSheet->getStyle($cell . '1')->getFont()->setBold(true);
            $objActSheet->getStyle($cell . '1')->getBorders()->getTop()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
            $objActSheet->getStyle($cell . '1')->getBorders()->getBottom()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
            $objActSheet->getStyle($cell . '1')->getBorders()->getLeft()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
            $objActSheet->getStyle($cell . '1')->getBorders()->getRight()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
            
            $objActSheet->getStyle( $cell . '1')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
            $objActSheet->getStyle($cell . '1')->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);

            $cell++;
        }
        $cell = 'A';
        foreach ($jiapartsdataseg as $k => $value) {
            //$num=4;
            //设置单元格宽度
            $objActSheet->getColumnDimension($cell)->setWidth(15);
            $objActSheet->setCellValue($cell . '2', $value);
            
            $cell++;
        }
        $cell=ord($cell);
        $cell--;
        $cell=chr($cell);
        //设置行高
        $objActSheet->getDefaultRowDimension()->setRowHeight(25);
        // 字体加粗
        $objActSheet->getStyle('A1:' . $cell . '1')->getFont()->setBold(true);
        //设置居中
        $objActSheet->getStyle('A1:' . $cell . '1')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
        $objActSheet->getStyle('A1:' . $cell . '1')->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);
        // 设置字体颜色
        $objActSheet->getStyle('A1:' . $cell . '1')->getFont()->getColor()->setARGB(PHPExcel_Style_Color::COLOR_RED);

        //设置填充的样式和背景色
        //  $objActSheet->getStyle('A1:' . $cell . '1')->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID);
        // $objActSheet->getStyle('A1:' . $cell . '1')->getFill()->getStartColor()->setARGB('FF66CCCC');
        ob_end_clean();
        ob_start();
        header('Content-Type : application/vnd.ms-excel');
        $name='商品-' . $name . '模版-' . date("Y-m-d");
        $name=iconv('utf-8','gbk',$name);
        header('Content-Disposition:attachment;filename="' . $name . '.xls"');
        $objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel5');
        $objWriter->save('php://output');
    }

}
