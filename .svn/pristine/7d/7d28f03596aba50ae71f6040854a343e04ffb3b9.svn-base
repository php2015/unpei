<?php
class SalesmanageController extends Controller
{
	/**
	 * @var string the default layout for the views. Defaults to '//layouts/column2', meaning
	 * using two-column layout. See 'protected/views/layouts/column2.php'.
	 */
	public $layout = '//layouts/maker';
	//销售管理主页
	public function actionIndex()
	{
		$this->redirect(array('salesmanage/querygoods'));
	}
	//商品内容查询
	public  function actionQuerygoods()
	{  
		//内容查询
		$page = isset($_GET['page']) ? intval($_GET['page']) : 1;
		$pageSize = 10;
		$manufacturer_id=Yii::app()->user->id;
		if(isset($_GET['submit']))
		{
			$params = $_GET['search'];
			//搜索查询字段接收
			$result = Goods::GetGoodsBySelf($manufacturer_id,$page,$pageSize,$params,null);
		}else{
			
			$result = Goods::GetGoodsBySelf($manufacturer_id,$page,$pageSize,null,null);
		}
		//搜索中的适用品牌
		$brand=$this->getbrand(0);
		//类别
		$category=$this->getcategory();
	  	$stand=$this->GetStand();
        $this->render('index',array('result'=>$result[0],'pages'=>$result[1],'brand'=>$brand,'category'=>$category,'parts'=>$stand));
		
	}
	public function GetStand()
	{
		//所有常用配件
		$sql="select distinct system_type,id from tbl_goods_standard where system_type is not null group by system_type";
		$parts=Yii::app()->db->createCommand($sql)->queryAll();
		return $parts;
	}
	public function actionMore()
	{
		$manufacturer_id=Yii::app()->user->id;
		$id=$_POST['mid'];
		$sql="select distinct c.car from tbl_goods a ,tbl_goods_vehicle b,tbl_vehicle c"
			." where a.id=b.Goods_ID and b.VehicleID=c.VehicleID and a.manufacturer_id='$manufacturer_id' and a.id='$id' ";
		$more=Yii::app()->db->createCommand($sql)->queryAll();
	   echo json_encode($more);
	}
	//商品添加
	public function actionGoodsadd()
	{
		$model= new GoodsForm();
		//ajax客户端验证
		if(isset($_POST['ajax'])&& $_POST['ajax']==='goodsadd-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
		if(isset($_POST['GoodsForm']))
		{   
		//版本选择
		$version=trim($_POST['GoodsForm']['version']);
		//商品名称
		$goodsname=trim( $_POST['GoodsForm']['goodsname']);
		//商品编号
		$goodsno=trim($_POST['GoodsForm']['goodsno']);
		//品牌
		$brand=trim($_POST['GoodsForm']['brand']);
		//类别
		$category=trim($_POST['GoodsForm']['category']);
		//OE号
		$oeno=trim($_POST['GoodsForm']['oeno']);
		$oeno=str_replace("，",",",$oeno);
		//属性值
		$column1=trim($_POST['GoodsForm']['column1']);
		$column2=trim($_POST['GoodsForm']['column2']);
		$column3=trim($_POST['GoodsForm']['column3']);
		$column4=trim($_POST['GoodsForm']['column4']);
		$column5=trim($_POST['GoodsForm']['column5']);
		//市场指导价
		$price=trim($_POST['GoodsForm']['price']);
		$priceA=trim($_POST['GoodsForm']['priceA']);
		$priceB=trim($_POST['GoodsForm']['priceB']);
		$priceC=trim($_POST['GoodsForm']['priceC']);
		//配件档次
		$part_level=$_POST['GoodsForm']['parts_level'];
		//现有库存
		$inventory=trim($_POST['GoodsForm']['inventory']);
		//发货天数
		$days=$_POST['GoodsForm']['days'];
		//备注
		$desc=$_POST['GoodsForm']['desc'];
		$time=time();
		$carid=$_POST['car'];
		$carid='1';
		//$carid=implode(',',$carid);
		//模板
		$template=$_POST['GoodsForm']['template'];
	    $manufacturer_id=Yii::app()->user->id;
		//插入商品
		$sql="insert into tbl_goods(brand,category_id,oe,manufacturer_id,create_time,IsSale,ISdelete,NewVersion)
			  values('$brand','$category','$oeno','$manufacturer_id',$time,'Y','N','001')";
		$goods_result=Yii::app()->db->createCommand($sql)->execute();
		//查出插入商品的ID
	    $goods_id=Yii::app()->db->getLastInsertID();
	    //根据选择的版本插入自定义属性
	    $values_sql="insert into tbl_goods_values(column1,column2,column3,column4,column5,manufacturer_id) values('$column1',
	    '$column2','$column3','$column4','$column5','$manufacturer_id')";
	    $values_result=Yii::app()->db->createCommand($values_sql)->execute();
		//最新插入自定义属性ID
	    $value_id=Yii::app()->db->getLastInsertID();
		//获取插入车系的条数
	    $caridlength=count($carid);
	    for($i=0;$i<$caridlength;$i++)
	    {
	    	$goods_vehicle_sql="insert into tbl_goods_vehicle values(null,'$carid[$i]','$goods_id')";
	    	$goods_vehicle_result=Yii::app()->db->createCommand($goods_vehicle_sql)->execute();
	    }
	
		//插入版本信息
		$goodversion_sql="insert into tbl_goods_version(version_name,name,goods_id,goodsno,"
				."   values_id,templet_id,manufacturer_id,price,priceA,priceB,priceC,parts_level,senddays,inventory,description,isUse) 
				     values('001','$goodsname','$goods_id',"
				. "  '$goodsno',$value_id,'$template',$manufacturer_id,'$price','$priceA','$priceB','$priceC','$part_level','$days','$inventory','$desc','N')";
		$goodsversion_result=Yii::app()->db->createCommand($goodversion_sql)->execute();
		if( $goodsversion_result)
		{
			Yii::app()->user->setFlash('success','添加商品成功');
		}
		else 
		{
			Yii::app()->user->setFlash('failed','添加商品失败');
		}
	  }
		//调用获取品牌方法
		$databrand=$this->getbrand();
		//调用获取车系类别方法
		$datacar=$this->getcar();
		//调用获取商品类别方法
		$good_category=$this->getcategory();
		//调用获取配件档次方法
		$part_level=$this->getpartlevel();
		//调用用获取模板方法
		$template=$this->gettemplate();
		$this->render('add',array('model'=>$model,'category'=>$good_category,
				      'partslevel'=>$part_level,'car'=>$datacar,'brand'=>$databrand,
				      'template'=>$template));
	}
	/** 
	 * 版本控制说明
	 * 1.改了值,没改模板
	 * 增加value 数据,增加版本
	 * 用之前的TemplateID,用增加的ValueID
	 * 2.改了模板,没改值
	 * 增加一条TemplateID,增加一条VersionID
	 * 用新的TemplateID->ValueID
	 * 3.改了模板又改了值
	 * 都新增
	 */
	//商品修改
	public function actionModify()
	{
		if(isset($_GET['id']) && empty($_GET['id']))
		{
			exit;
		}
		$id=intval($_GET['id']);
		$manufacturer_id=Yii::app()->user->id;
		$model= new GoodsForm();
		//修改时ajax 客户端验证
		if(isset($_POST['ajax'])&& $_POST['ajax']==='goodsmodify-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
		//根据ID最新版本该条数据
		$sql="select distinct a.id as id,a.IsSale,b.goodsno,b.name,b.version_name,a.brand,b.cpname,c.name as category,a.oe,b.values_id,"
			." b.price,b.inventory,b.senddays,b.description,f.code,d.Column1,d.Column2,d.Column3,d.Column4,d.Column5 , "
			." b.priceA,b.priceB,b.priceC"
			."  from tbl_goods a, tbl_goods_version b,tbl_goods_category c,tbl_goods_template d,tbl_goods_standard e,tbl_parts_level f "
			. "  where a.id=b.goods_id and a.NewVersion=b.version_name
			    and c.id=a.category_id and a.manufacturer_id=b.manufacturer_id
			    and a.manufacturer_id=c.manufacturer_id"
			."  and b.templet_id=d.id"
			."  and d.standard_id=e.id"
			."  and b.parts_level=f.id"
			."  and a.ISdelete='N' and a.id='$id'and a.IsSale='Y'  "
			."  and a.manufacturer_id='$manufacturer_id' "
			."  group by a.id order by a.id desc";
		$result=Yii::app()->db->createCommand($sql)->queryRow();
		$versionname=$result['version_name'];
		$verID=$_GET['verid'];
		//旧版本
		if($_GET['verid'])
		{
			$sql="select distinct a.id as id,a.IsSale,b.goodsno,b.name,b.version_name,a.brand,b.cpname,c.name as category,a.oe,b.values_id,"
					." b.price,b.inventory,b.senddays,b.description,f.code,d.Column1,d.Column2,d.Column3,d.Column4,d.Column5 ,b.templet_id, "
					." b.priceA,b.priceB,b.priceC"
					."  from tbl_goods a, tbl_goods_version b,tbl_goods_category c,tbl_goods_template d,tbl_goods_standard e,tbl_parts_level f "
					. "  where a.id=b.goods_id 
					    and c.id=a.category_id and a.manufacturer_id=b.manufacturer_id
				        and a.manufacturer_id=c.manufacturer_id"
					."  and b.templet_id=d.id"
					."  and d.standard_id=e.id"
					."  and b.parts_level=f.id"
					."  and a.ISdelete='N' and a.id='$id' and b.version_name='$verID' "
					."  and a.manufacturer_id='$manufacturer_id' and a.IsSale='Y'"
					."   group by a.id order by a.id desc";
			$result=Yii::app()->db->createCommand($sql)->queryRow();
		}
			//下拉列表中的该条数据
			$model->desc=$result['description'];
			$model->brand=$result['brand'];
			$model->version=$result['version_name'];
			$model->category=$result['category'];
			//$model->model=$result['VehicleID'];
			$model->parts_level=$result['parts_level'];
			$model->version=$result['version_name'];
			$model->template=$result['templet_id'];
			//$versionname=$result['version_name'];
			$value_id=$result['values_id'];
			$goodsid=$result['id'];
			$modeID=$result['VehicleID'];
			$versionID=$versionname+1;
			//var_dump($versionID);
			if(isset($_POST['GoodsForm']))
			{
				//版本选择
				$version=trim($_POST['GoodsForm']['version']);
				$result=Yii::app()->db->createCommand($sql)->queryRow();
				//商品名称
				$goodsname=trim( $_POST['GoodsForm']['goodsname']);
				//商品编号
				$goodsno=trim($_POST['GoodsForm']['goodsno']);
				//品牌
				$brand=trim($_POST['GoodsForm']['brand']);
				//类别
				$category=trim($_POST['GoodsForm']['category']);
				//OE号
				$oeno=trim($_POST['GoodsForm']['oeno']);
				$oeno=str_replace("，",",",$oeno);
				//属性值
				$column1=trim($_POST['GoodsForm']['column1']);
				$column2=trim($_POST['GoodsForm']['column2']);
				$column3=trim($_POST['GoodsForm']['column3']);
				$column4=trim($_POST['GoodsForm']['column4']);
				$column5=trim($_POST['GoodsForm']['column5']);
				//市场指导价
				$price=trim($_POST['GoodsForm']['price']);
				$priceA=trim($_POST['GoodsForm']['priceA']);
				$priceB=trim($_POST['GoodsForm']['priceB']);
				$priceC=trim($_POST['GoodsForm']['priceC']);
				//配件档次
				$part_level=$_POST['GoodsForm']['parts_level'];
				//现有库存
				$inventory=trim($_POST['GoodsForm']['inventory']);
				//发货天数
				$days=$_POST['GoodsForm']['days'];
				//备注
				$desc=$_POST['GoodsForm']['desc'];
				$vehicleID=$_POST['GoodsForm']['car'];
				$time=time();
				$carid=$_POST['car'];
				$carid='1';
				$modelid=$_POST['model'];
				//模板
				$template=$_POST['GoodsForm']['template'];
				//修改商品基础信息
				$upversion_sql="update tbl_goods_version set name='$goodsname',goodsno='$goodsno',modify_time=$time 
								where goods_id='$id'";
				$version_result=Yii::app()->db->createCommand($upversion_sql)->execute();
				//修改商品基础信息
				$goods_result=Goods::model()->updateByPk($id,array('brand'=>$brand,'category_id'=>$category,'oe'=>$oeno));
				//插入车系
				$caridlength=count($carid);
				for($i=0;$i<$caridlength;$i++)
				{
				$vehicle_sql="insert into tbl_goods_vehicle values(null,'$carid[$i]','$id')";
				$vehicles_result=Yii::app()->db->createCommand($vehicle_sql)->execute();
				}
				//$vehicle_sql="insert into tbl_goods_vehicle values(null,'$vehicleID','$id')";
				//$vehicles_result=Yii::app()->db->createCommand($vehicle_sql)->execute();
				//插入vlaue属性值
				$values_sql="insert into tbl_goods_values values(null,'$manufacturer_id','$column1','$column2','$column3','$column4','$column5')";
				$values_result=Yii::app()->db->createCommand($values_sql)->execute();
				$valuesid=Yii::app()->db->getLastInsertID();
				//改了模板没改值
		        $uptem_sql="insert into tbl_goods_version(version_name,modify_time,name,manufacturer_id,"
		        		  ." goods_id,goodsno,car_id,templet_id,values_id,isUse ,"
		        		  ." price,priceA,priceB,priceC,inventory,parts_level,senddays,description)"
		        		  ." values('00$versionID','$time','$goodsname','$manufacturer_id',"
		        		  .  " $goodsid,'$goodsno','1','$template','$valuesid',"
		        		  ." 'N','$price','$priceA','$priceB','$priceC','$inventory','$part_level','$days','$desc')"; 
		        $inve_result=Yii::app()->db->createCommand($uptem_sql)->execute();
				//商品表版本跟新到最新
		        $ver_sql="update tbl_goods set NewVersion='00$versionID' where id=$goodsid";
		        $upnew_result=Yii::app()->db->createCommand($ver_sql)->execute();
				//$upnew_result=Goods::model()->updateByPK($goodsid,array('NewVersion'=>'00'.$versionID));
				if($upnew_result)
				{
					Yii::app()->user->setFlash('success','商品信息修改成功');
				 	$this->redirect(array('salesmanage/modify','id'=>$goodsid,'verid'=>'00'.$versionID));
				}
				else 
				{
					Yii::app()->user->setFlash('failed','商品信息修改失败');
				}
		}
		//获取商品对应车系
// 		$sql="select  distinct b.car as car,b.model as model,b.VehicleID from tbl_goods_vehicle a,tbl_vehicle b,tbl_goods_version c"
// 			." where a.VehicleID=b.VehicleID and c.Goods_id=a.goods_id  "
// 			." and a.goods_id='$id' and c.version_name='$verID' order by b.car";
// 		$car_result=Yii::app()->db->createCommand($sql)->queryAll();
		//获取其他商品品牌
		$brand=$this->getbrand();
		//获取商品类别
		$category=$this->getcategory();
		//获取其他车系
		$car=$this->getcar();
		$templates=$this->gettemplate();
		$models=$this->getModifyModel($modeID);
		$vername=$this->getversion($id);
		$value_data=$this->getmodifyvalues($value_id);
		//配件级别下拉列表
		$part_level=$this->getpartlevel();
		//经销商价格级别
		//$level=GoodsDealerlevel::model()->findAll();
		$this->render('modify',array('model'=>$model,'result'=>$result,
				      'brand'=>$brand,'category'=>$category,'car'=>$car,
					  'templates'=>$templates,'models'=>$models,'values'=>$value_data,
				      'parts_level'=>$part_level,'version'=>$vername,'car_result'=>$car_result
				     // 'level'=>$level
					  ));
	}
	//修改时删除车系
	public  function actionDeletecar()
	{
		$goodid=$_POST['goodid'];
		$vehid=$_POST['vehid'];
		$sql="delete from tbl_goods_vehicle where Goods_ID='$goodid' and VehicleID='$vehid'";
		$result=Yii::app()->db->createCommand($sql)->execute();
		echo json_encode($result);
	}
	//版本
	public function GetVersion($id)
	{
		$sql="select  distinct a.version_name from tbl_goods_version a where goods_id='$id'";
		$result=Yii::app()->db->createCommand($sql)->queryAll();
		return $result;
	}
	
	//修改页面获取下拉框当前ID车型
    public function GetModifyModel($id)
    {
    	$sql="SELECT VehicleID,model FROM tbl_vehicle where VehicleID='$id' ";
    	$result=Yii::app()->db->createCommand($sql)->queryAll();
    	return $result;
    }
    //商品自定义属性值
    public function GetModifyValues($id)
    {
    	$manufacturer_id=Yii::app()->user->id;
       $sql="select b.Column1 as tc1,b.Column2 as tc2,b.Column3 as tc3,b.Column4 as tc4, b.Column5 as tc5,"
       		."c.Column1 as vc1,c.Column2 as vc2,c.Column3 as vc3,c.Column4 as vc4 ,c.Column5 as vc5 from tbl_goods_version as a,tbl_goods_template as b,tbl_goods_values as c"
            ." where a.templet_id=b.id and a.values_id=c.id and c.id='$id'"
            ." and a.manufacturer_id=b.manufacturer_id and b.manufacturer_id='$manufacturer_id'";
       $result=Yii::app()->db->createCommand($sql)->queryRow();
       return $result;
    }
   //商品删除
	public function actionDelete()
	{
		  $id=$_POST['crowid'];
		  $sql="update tbl_goods set ISdelete='Y' where id in($id)";
		  $result=Yii::app()->db->createCommand($sql)->execute();
		  if($result)
		  {
		  	Yii::app()->user->setFlash('success','删除成功');
		  }
		  else {
		  	Yii::app()->user->setFlash('failed','删除失败');
		}
		 echo json_encode($result);
	}
	//获取品牌
	public function GetBrand()
	{
		$sql="select distinct name,id from tbl_goods_brand group by name";
		$result=Yii::app()->db->createCommand($sql)->queryAll();
		return $result;
	}
	//获取车系
	public function GetCar()
	{
		$sql="select Distinct car,VehicleID FROM tbl_vehicle group by car ";
		$result=Yii::app()->db->createCommand($sql)->queryAll();
		return $result;
	}
	//获取车型
	public function actionGetmodel()
	{
		$car=$_POST['car'];
		$sql="SELECT VehicleID,model FROM tbl_vehicle "
				." WHERE car='$car' ";
		$result=Yii::app()->db->createCommand($sql)->queryAll();
		echo json_encode($result);
	}
	//获取车系
	// 	public function actionGetCar()
	// 	{
	// 		$brand=$_POST['brand'];
	// 		$sql="select distinct car from tbl_goods_brand where name='$brand'";
	// 		$result=Yii::app()->db->createCommand($sql)->queryAll();
	// 		echo json_encode($result);
	// 	}
	//获取商品类别
	public function GetCategory()
	{
		$manufacturer_id=Yii::app()->user->id;
		$sql="SELECT DISTINCT name,id  FROM tbl_goods_category where manufacturer_id=$manufacturer_id group by name";
		$result=Yii::app()->db->createCommand($sql)->queryAll();
		return $result;
	}
	//获取配件档次
	public function GetPartLevel()
	{
		$sql="SELECT DISTINCT code,id,description FROM tbl_parts_level group by code";
		$result=Yii::app()->db->createCommand($sql)->queryAll();
		return $result;
	}
	//获取模板
	public function GetTemplate()
	{	$manufacturer_id=Yii::app()->user->id;
		$sql="select distinct name,id from tbl_goods_template where  manufacturer_id=$manufacturer_id group by name";
		$result=Yii::app()->db->createCommand($sql)->queryAll();
		return $result;
	}
	public function actionGettemplatevalue()
	{
		$templateid=$_POST['template'];
		$sql="select * from tbl_goods_template where id=$templateid";
		$result=Yii::app()->db->createCommand($sql)->queryRow();
		echo json_encode($result);
	}
	//上下架管理
	public function actionIssale()
	{
		$page = isset($_GET['page']) ? intval($_GET['page']) : 1;
		$pageSize = 10;
		$manufacturer_id=Yii::app()->user->id;
		if(isset($_GET['submit']))
		{
			$params = $_GET['search'];
			//搜索查询字段接收
			$result = Goods::GetGoodsBySelf($manufacturer_id,$page,$pageSize,$params,true);
		}else{
				
			$result = Goods::GetGoodsBySelf($manufacturer_id,$page,$pageSize,"",true);
		}
		
		
		//搜索中的适用品牌
		$brand=$this->getbrand(0);
		//类别
		$category=$this->getcategory();
		$stand=$this->GetStand();
			//调用配件品类
			$stand=$this->GetStand();
		    $this->render('issale',array('result'=>$result[0],'pages'=>$result[1],'brand'=>$brand,'category'=>$category,'parts'=>$stand));
	}
	//上架
	public function actionOnsale()
	{
		$id=$_POST['crowid'];
	    $result=Goods::model()->updateAll(array('IsSale'=>'Y'),"id in ($id)");
		if($result)
		{
			Yii::app()->user->setFlash('success','商品上架成功');
		}
		else {
			Yii::app()->user->setFlash('failed','商品上架失败');
		}
		echo json_encode($result);
	}
	//商品下架
	public function actionUnsale()
	{
		$id=$_POST['crowid'];
		$sql="update tbl_goods set IsSale='N' where id in($id)";
		$result=Yii::app()->db->createCommand($sql)->execute();
		if($result)
		{
			Yii::app()->user->setFlash('success','商品下架成功');
		}
		else {
			Yii::app()->user->setFlash('failed','商品下架失败');
		}
		echo json_encode($result);
	}
	//获取更多车系
	public function actionGetmore(){
		$field=$_GET['field'];
		$goodsID=$_GET['id'];
		if ($field=='suitcartype'){
			$sql="select a.car from tbl_vehicle a where a.VehicleID in (select distinct m.VehicleID from tbl_goods_vehicle m where m.Goods_ID={$goodsID})";
			$data=Yii::app()->db->createCommand($sql)->queryAll();
			$list='';
			foreach ($data as $k=>$s){
				if ($k==0){
					$list.=$s['car'];
				}else{
					$list.=','.$s['car'];
				}
			}
			$more=explode(',', $list);
		}else {
			$mores=Yii::app()->db->createCommand("select oe from tbl_goods where id={$_GET['id']}")->queryScalar();
			$more=explode(',', $mores);
		}
		array_shift($more);
		$more=array_filter($more);
		foreach ($more as $key=>$value){
			$result[$key][$field]=$value;
		}
		echo json_encode($result);
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
}