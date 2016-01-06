<?php

/**
 * This is the model class for table "{{goods}}".
 *
 * The followings are the available columns in table '{{goods}}':
 * @property integer $id
 * @property string $brand
 * @property integer $category_id
 * @property string $oe
 * @property integer $create_time
 * @property integer $manufacturer_id
 * @property string $IsSale
 * @property string $ISdelete
 */
class Goods extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @return Goods the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}

	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return '{{goods}}';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('category_id', 'required'),
			array('category_id, create_time, manufacturer_id', 'numerical', 'integerOnly'=>true),
			array('brand, oe', 'length', 'max'=>20),
			array('IsSale, ISdelete', 'length', 'max'=>2),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, brand, category_id, oe, create_time, manufacturer_id, IsSale, ISdelete', 'safe', 'on'=>'search'),
		);
	}

	/**
	 * @return array relational rules.
	 */
	public function relations()
	{
		// NOTE: you may need to adjust the relation name and the related
		// class name for the relations automatically generated below.
		return array(
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'brand' => 'Brand',
			'category_id' => 'Category',
			'oe' => 'Oe',
			'create_time' => 'Create Time',
			'manufacturer_id' => 'Manufacturer',
			'IsSale' => 'Is Sale',
			'ISdelete' => 'Isdelete',
		);
	}

	/**
	 * Retrieves a list of models based on the current search/filter conditions.
	 * @return CActiveDataProvider the data provider that can return the models based on the search/filter conditions.
	 */
	public function search()
	{
		// Warning: Please modify the following code to remove attributes that
		// should not be searched.

		$criteria=new CDbCriteria;

		$criteria->compare('id',$this->id);
		$criteria->compare('brand',$this->brand,true);
		$criteria->compare('category_id',$this->category_id);
		$criteria->compare('oe',$this->oe,true);
		$criteria->compare('create_time',$this->create_time);
		$criteria->compare('manufacturer_id',$this->manufacturer_id);
		$criteria->compare('IsSale',$this->IsSale,true);
		$criteria->compare('ISdelete',$this->ISdelete,true);

		return new CActiveDataProvider(get_class($this), array(
			'criteria'=>$criteria,
		));
	}
	
	 /**
	 * //商品接口
	 *	 @param version_name 最新版本名称
	 *  @param goodname 商品名称
	 *  @param goodsno 商品编号
	 *  @param goodsprice 商品价格
	 *  @param parts_level 商品配件档次 
	 *  @param cp_name 商品标准名称
	 *  @param category 商品类别
	 *  @param car 使用车系
	 *  @param $goodsID 商品ID
	 *  @param  $manfacturerID 生产商ID
	 */
	public static function GetGoodsByID($goodsID,$manufacturer_ID)
	{
                //授权品牌
                $organID=Commonmodel::getOrganID();
                $brands=  MakePromitBrand::model()->find('DealerID='.$organID.' and OrganID='.$manufacturer_ID);
                //折扣率
                //$priceratio=  MakePromitPrice::model()->find('OrganID='.$manufacturer_ID);
                //$ratio=isset($priceratio['Level'.$brands['Level']])?$priceratio['Level'.$brands['Level']].'%':'100%';
//                 $sql2='select distinct a.id as goodsID,b.goods_oe as OE,b.goods_brand as brandid,b.version_name as verion_name,b.goods_no as goodsno,b.goods_name as goodsname,b.marketprice as marketprice,'
//                       .'b.salesprice,b.goods_category as categoryid,b.standard_id'
//                       . " from  tbl_make_goods a ,tbl_make_goods_version b"
//                       . '  where a.id=b.goods_id and a.NewVersion=b.version_name'
//                       . "  and a.ISdelete='0' and b.ISdelete=0"
//                       . "  and a.organID='$manufacturer_ID' and a.id=".$goodsID;
                
                $sql2 = "select distinct a.id as goodsID ,b.goods_category as category_id,b.goods_oe as OE,b.goods_brand as brand,b.organID,
                		 	    a.NewVersion as verion_name,b.goods_no as goodsno,b.goods_name as goodsname,
                                b.benchmarking_brand,b.benchmarking_sn,a.create_time,d.Price,"
                		. " b.inventory as inventory,b.senddays,b.description,a.IsSale,b.standard_id"
                        . " from  tbl_make_goods a ,tbl_make_goods_version b ,tbl_make_goods_vehicle c,tbl_make_price_relation d"
                        . '  where a.id=b.goods_id and a.NewVersion=b.version_name'
                        . "  and a.ISdelete='0' and b.ISdelete=0"
                        . "  and a.organID='$manufacturer_ID' and a.id=$goodsID";
	   
	    $identity=Commonmodel::getIdentity(Yii::app()->user->id);
	    if($identity['identity']==2)
	    {
	    	$sql2.=" and d.TypeID= {$brands['CustomerType']} and d.GoodsID=a.id and d.Price is not null";
	    }
	    $result=Yii::app()->db->createCommand($sql2)->queryRow();
            if($result)
            {
                //查询品牌名称
                $brandmodel=  MakeGoodsBrand::model()->findByPK($result['brand']);
                $result['brand']=$brandmodel['BrandName'];
                //商品销售价
                if($result['Price'])
                {
                	$result['goodsprice']=$result['Price'];
                }
                //$result['goodsprice']=sprintf("%.2f", $result['salesprice'] * $ratio / 100);
            }	
	    
	    return $result;
	  	
	  	
	}
	
	public static function getVehicleByOEArr($OEArr){
		$data = array();
		foreach($OEArr as $OE){
			$result=GoodsVehicle::model()->findAll('OE=:OE',array(':OE'=>$OE));
			foreach($result as $value)

			{

				$vID = $value->VehicleID;

				$strV = self::getVechileByVID($vID);

				if(!in_array($strV,$data)){

					$data[]= $strV;

				}

			}

		}
		if(!empty($data)){

			return implode(",", $data);

		}
		return null;
	}
	/**
	 * OE号查使用车系
	 */
	public static function getVehicleByOE($OE)
	{
	  $result=GoodsVehicle::model()->findAll('OE=:OE',array(':OE'=>$OE));
	  $data = array();
	  foreach($result as $key=>$value)
	  {
	  	$vID = $value->VehicleID;
	  	$strV = self::getVechileByVID($vID);
	  	if(!in_array($strV,$data)){
	  		$data[$key]= $strV;
	  	}
	  }
	  if($data){
	  	return implode(",", $data);
	  }
	  
	}
	
	public static function getVechileByVID($vid){
		$model =  GoodsBrand::model()->findByPk($vid);
		return $model->name . $model->car;
	}
	
public function GetGoodsBySelf($manufacturer_ID,$page,$pageSize,$params,$isSale){
	    $criteria=new CDbCriteria();
		$sql=" select distinct a.id as goodsID ,a.oe as OE,a.brand as brand,a.NewVersion as verion_name,b.goodsno as goodsno,b.name as goodsname,b.price as marketprice,"
		."b.price as goodsprice, b.priceA, b.priceB,b.priceC,b.inventory,b.senddays,b.description,a.IsSale,"
		."d.Column1,d.Column2,d.Column3,d.Column4,d.Column5,"
	    ." g.Column1 as value1,g.Column2 as value2,g.Column3 as value3,g.Column4 as value4,g.Column5 as value5,"
		." (select distinct f.code  from tbl_parts_level f where b.parts_level=f.id) as parts_level,"
		." (select distinct e.cp_name from tbl_goods_standard e where e.id=d.standard_id) as cp_name,"
		." (select distinct c.name from tbl_goods_category c where c.id=a.category_id and a.manufacturer_id=c.manufacturer_id) as category"
		."  from tbl_goods a ,tbl_goods_version b,tbl_goods_category c,tbl_goods_template d,tbl_goods_standard e,tbl_parts_level f,tbl_goods_values g"
		.'  where a.id=b.goods_id and a.NewVersion=b.version_name'
		."  and b.parts_level=f.id"
		."  and b.templet_id=d.id"
		."  and e.id=d.standard_id"
	    ."  and a.category_id=c.id"
		."  and b.values_id = g.id"
		."  and a.manufacturer_id=b.manufacturer_id"
		."  and a.ISdelete='N'"
		
		."  and a.manufacturer_id='$manufacturer_ID' ";
		if($params && is_array($params)){
		    $part=isset($params['parts'])?trim($params['parts']):'';
			$radio=isset($params['radio'])?trim($params['radio']):'';
			$radionum=isset($params['num'])?trim($params['num']):'';
			$oenum=isset($params['oenum'])?trim($params['oenum']):'';
			$category=isset($params['category'])?trim($params['category']):'';
			$cpname=isset($params['cpname'])?trim($params['cpname']):'';
			$brand=isset($params['brand'])?trim($params['brand']):'';
			$car=isset($params['car'])?trim($params['car']):'';
			$issale=isset($params['issale'])?trim($params['issale']):'';
			$goodsname=isset($params['name'])?trim($params['name']):'';
			$system_type=isset($params['system_type'])?trim($params['system_type']):'';
			//商品名称搜索
			if(!empty($goodsname))
			{
				$sql.=" and b.name like'%$goodsname%'";
			}
			//OE号搜索
			if(!empty($oenum))
			{
				$sql.=" and a.oe like'%$oenum%'";
			}
			//商品编号搜索
			if(!empty($radionum))
			{
				$sql.=" and b.goodsno like '%$radionum%'";
			}
			//商品类别搜索
			if(!empty($category)&& $category !='商品类别')
			{
				$sql.=" and c.name='$category'";
			}
			//标准名称搜索
			if(!empty($cpname ) && $cpname !='请选择品类')
			{
				$sql.="and e.cp_name like '%$cpname%'";
			}
			elseif(!empty($system_type) && $system_type !='请选择系统')
			{
				$sql.=" and e.cp_name in (select cp_name from tbl_goods_standard where system_type='$system_type')";
			}
			//品牌搜索
			if(!empty($brand)&&($brand!='品牌'))
			{
				$sql.=" and (a.brand='$brand')";
			}
			//车系搜索
			if(!empty($car)&&($car !='车系'))
			{
				$sql.=" and (n.car='$car')";
			}
			//是否上架查询
			if(!empty($issale) && ($issale !='是否上架'))
			{
				$sql.=" && a.IsSale='$issale'";
			}
		}
		if($isSale != true ){
			$sql .= "  and a.IsSale='Y'";
		}
		$sql.="  group by a.id order by a.id desc";
	
		$result=Yii::app()->db->createCommand($sql)->queryAll();
		$count=count($result);
		$pages=new CPagination($count);
		//设置分页页数
		$pages->pageSize=$pageSize?$pageSize:10;
		$pages->applyLimit($criteria);
		$result=Yii::app()->db->createCommand($sql." LIMIT :offset,:limit");
		//绑定分页参数
		$result->bindValue(':offset', $pages->currentPage*$pages->pageSize);
		$result->bindValue(':limit', $pages->pageSize);
		$result=$result->queryAll();
		
		foreach($result as $key => $val){
			  $OEArr=explode(',',$val['OE']);
			  $result[$key]["car"] = self::getVehicleByOEArr($OEArr);
		 
		}
		//return $result;
		return array($result,$pages);
		//}
		
	}
	/**
	 * 生产商最新版本的所有产品
	 * @param unknown $manufacturer_ID
	 * @return unknown
	 * @params goodsprice 商品价格
	 * @params marketprice 市场指导价
	 */
	public static function getGoodsByMDID($manufacturer_ID,$userID,$params,$page,$limit){
                //授权品牌
                $organID=Commonmodel::getOrganID();
                $identity=Commonmodel::getIdentity(Yii::app()->user->id);
                $brands=  MakePromitBrand::model()->find('DealerID='.$organID.' and OrganID='.$manufacturer_ID);
                //查询销售价格
                $criteria = new CDbCriteria();
                //找到授权经销商的客户类别
                //折扣率
              //  $priceratio=  MakePromitPrice::model()->find('OrganID='.$manufacturer_ID);
               // $ratio=isset($priceratio['Level'.$brands['Level']])?$priceratio['Level'.$brands['Level']].'%':'100%';
//                 $sql2='select distinct a.id as goodsID,b.goods_oe as OE,b.goods_brand as brandid,b.version_name as verion_name,b.goods_no as goodsno,b.goods_name as goodsname,'
//                       .' b.goods_category as categoryid,b.standard_id'
//                       . " from  tbl_make_goods a ,tbl_make_goods_version b,tbl_make_goods_vehicle c"
//                       . '  where a.id=b.goods_id and a.NewVersion=b.version_name'
//                       . "  and a.ISdelete='0' and b.ISdelete=0"
//                       . "  and a.organID='$manufacturer_ID' ";
                $sql2 = "select distinct a.id as goodsID ,b.goods_category as category_id,b.goods_oe as OE,b.goods_brand as brand,b.organID,
                          a.NewVersion as version_name,b.goods_no as goodsno,b.goods_name as goodsname,
                           b.benchmarking_brand,b.benchmarking_sn,a.create_time,";
                if ($identity['identity'] == 2) {
                    $sql2.='d.Price,';
                }
                $sql2.= " b.inventory as inventory,b.senddays,b.description,a.IsSale,b.standard_id"
                        . " from  tbl_make_goods a ,tbl_make_goods_version b ";
                 if(!empty($params['goodsvehicle']))
                {
                    $sql2.= ",tbl_make_goods_vehicle c";
                }
                if ($identity['identity'] == 2) {
                    $sql2.=',tbl_make_price_relation d';
                }
                $sql2.='  where a.id=b.goods_id and a.NewVersion=b.version_name'
                        . "  and a.ISdelete='0' and b.ISdelete=0"
                        . "  and a.organID='$manufacturer_ID' ";
                if($identity['identity']==2 && $brands['CustomerType'])
                {
                    $sql2.="and d.TypeID= {$brands['CustomerType']} and d.GoodsID=a.id and d.Price is not null";
                    $sql2.=" and a.IsSale=0"; 
                    }
                if($params && is_array($params))
                {
                	if($brands['BrandName']){
                		$sql2.=" and  b.goods_brand in (0".$brands['BrandName']."0)";
                	}
                	//商品类别搜索
                    if (!empty($params['goodscategory'])) {
                	    $sql2.=' and b.goods_category=' . $params['goodscategory'];
                	  }
                	//商品名称搜索
                	if(!empty($params['goodsname']))
                	{
                	$sql2.=" and b.goods_name like '%$params[goodsname]%'";
                	}
                	//商品编号搜索
                	if(!empty($params['goodsno']))
                	{
                    $sql2.=" and b.goods_no like '%$params[goodsno]%'";
                	}
                	//商品OE号搜索
                	if(!empty($params['oe']))
                	{
                		$sql2.=" and b.goods_oe like '%$params[oe]%'";
                	}
                	//商品品牌搜索
                	if(!empty($params['goodsbrand']))
                	{
                		$sql2.=" and b.goods_brand ='$params[goodsbrand]'";
                	}
                	//适用车型搜索
                	if(!empty($params['goodsvehicle']))
                	{
                	    $sql2.=" and c.Name  like '%$params[goodsvehicle]%' and a.id=c.GoodsID and a.NewVersion=c.VersionName";
                	}
                	//             //是否上架查询
                	if (is_numeric($params['issale'])) {
                	 $sql2.=" && a.IsSale='$params[issale]'";
                	  }
                	//配件品类
                if (!empty($params['standardid'])) {
                  $sql2.=' and b.standard_id=' . $params['standardid'];
                }
               else {
                   //经营品类
                   $standmodel=  DealerCpname::model()->findAll("OrganID=:organID",array(':organID'=>$manufacturer_ID));
                   $standids='';
                   $standarr=array();
                   foreach($standmodel as $m)
                   {
                       $standarr[]=$m['CpNameID'];
                   }
                   $standids=  implode(',', $standarr);
                   if(!$standids)
                       $standids='0';
                   $sql2.=' and b.standard_id in (' . $standids.')';
               }
           		   //高级筛选
           		   //此处 key : 查询属性 between,normall; $val['name']: 模板名称；$val["value"]：值 eg:value / value,value2
           		   if(is_array($params["more"])){
	           		   	foreach($params["more"] as $key => $val){
	           		   		$sql2.=" and exists(
	           		   		SELECT DISTINCT(f.goods_id) FROM `tbl_make_goods_values` f,`tbl_make_goods_template` g where
	           		   		g.id=f.template_id and a.id=f.goods_id
	           		   		and g.organID='$manufacturer_ID' and g.standard_id='$params[standardid]'";
	           		   		//判断查询属性
	           		   		if($val["type"] == "between"){
	           		   			//区间查询方式： $val["value"] = value,value2;

	           		   			$valArr = explode(',',  $val["value"]);
	           		   			$sql2.="and (g.name='".$val["name"]."' and f.value between $valArr[0] and $valArr[1])) ";
	           		   		}else if($val["type"] == "normall"){
	           		   			$sql2.="and (g.name='".$val["name"]."' and f.value= '".$val["value"]."')) ";
	           		   		}
	           		   	}
           		   	
           		   }

           		   
                }
               //把make_goods里面上架的查询出来(0/1/上架/下架)  不写则全部查询
                $sql2.=" group by a.id order by a.id desc";
	  	$result=Yii::app()->db->createCommand($sql2)->queryAll();
	  	if($page&& $limit)
	  	{
	  		$count = count($result);
  	        $pages = new CPagination($count);
  	        //设置分页页数
  	        $pages->setPageSize($limit);
  	        $pages->applyLimit($criteria);
  	        $result = Yii::app()->db->createCommand($sql2 . " LIMIT :offset,:limit");
  	        //绑定分页参数
   	        $offset =   $pages->currentPage * $pages->pageSize;
   	        $size = $pages->pageSize;
  	        $result->bindValue(':offset', $pages->currentPage * $pages->pageSize);
  	        $result->bindValue(':limit', (int)$limit);
  	        $result = $result->queryAll();
	  	}
              $res=array();
	  	foreach($result as $key => $val){
                        $res[$key]=$val;
	  		$OEArr=explode(',',$val['OE']);
	  		$res[$key]["car"] = self::getVehicleByOEArr($OEArr);
                        //查询品牌名称
                        $brandmodel=  MakeGoodsBrand::model()->findByPK($val['brand']);
                       
                       // $res[$key]['brand']=$brandmodel['BrandName'];
                        $res[$key]['brandname']=$brandmodel['BrandName'];
                        //查询类别名称
                        $categorymodel=MakeGoodsCategory::model()->findByPk($val['category_id']);
                        $res[$key]['category'] = $categorymodel['name'];
                       
                        //查询标准名称
                        $standardmodel=  Gcategory::model()->findByPk($val['standard_id']);
                        $res[$key]['cp_name']=$standardmodel['name'];
                        
                        //查询车型
                      $cmodel=  MakeGoodsVehicle::model()->find('GoodsID=' . $val['goodsID'] . ' and VersionName="' . $val['version_name'] . '"');
 					
                      if($cmodel)
                      {
                          $res[$key]['carmodel']=$cmodel->Name;
                      }
                      if($val['Price'])
                      {
                           $res[$key]['marketprice']=$val['Price'];
                      }
                        
                        //根据客户类别获取商品价格
//                        if($brands['CustomerType'])
//                        {
//                        $sql_price="select * from tbl_make_price_relation where TypeID= {$brands['CustomerType']} and GoodsID= $val[goodsID]";
//                        $price=DBUtil::query($sql_price);
//                        $res[$key]['marketprice']=$price['Price'];
//                        }
                        //查询标准名称对应的参数名称
//                       $temname= MakeGoodsTemplate::model()->findAll("organID=:organID and standard_id=:stand and ISdelete='N'",array(
//                        			':organID'=>$manufacturer_ID,':stand'=>$val['standard_id']));
                        //查询商品品与标准名称参数名称对应的参数值
                        $paramssql='SELECT a.id,a.name,b.value FROM `tbl_make_goods_template` a,`tbl_make_goods_values` b where a.id=b.template_id and b.goods_id='.$val['goodsID'].' and b.version_name="'.$val['version_name'].'"';
                        $paramsvalue=Yii::app()->db->createCommand($paramssql)->queryAll();
                        $res[$key]['params']='';
                        
                        foreach($paramsvalue as $p)
                        {
                            $res[$key]['params'].=$p['name'].':'.$p['value'].';';
                        }
                  
                                    $res[$key]['OE'] = $val['OE'];
                                    $res[$key]['Brand'] = $val['brand'];
                                    $res[$key]['version_name'] = $val['version_name'];
                                    $res[$key]['GoodsNo'] = $val['goodsno'];
                                    $res[$key]['GoodsName'] = $val['goodsname'];
                                    $res[$key]['BenchBrand'] = $val['benchmarking_brand'];
                                    $res[$key]['BenchNo'] = $val['benchmarking_sn'];
                                    $res[$key]['benchmarking_brand'] = $val['benchmarking_brand'];
                                    $res[$key]['benchmarking_sn'] = $val['benchmarking_sn'];
                                    $res[$key]['GoodsBrand'] = $val['brand'];
                                    $res[$key]['BrandName'] = $val['brandname'];
                                    $res[$key]['GoodsCategory'] = $val['category_id'];
                        //                    $datas[$key]['CategoryName']=$val['category'];
                                    $res[$key]['inventory'] = $val['inventory'];
                                    $res[$key]['Days'] = $val['senddays'];
                                    $res[$key]['Desc'] = $val['description'];
                                    //b.maincategory,b.subcategory,b.standard_id
                                    $res[$key]['standard_id'] = $val['standard_id'];
                                    $res[$key]['create_time'] = date('Y-m-d H:i:s', $val['create_time']);
                                    //获取标准名称参数值
                                    if (!empty($val['standard_id'])) {
                                        $params = MakeGoodsValues::model()->findAll('standard_id=' . $val['standard_id'] . ' and goods_id=' . $val['goodsID'] . ' and version_name="' . $val['version_name'] . '"');
                                        $value = array();
                                        foreach ($params as $param) {
                                            $k = $param['template_id'];
                                            $value[$k] = $param['value'];
                                            $res[$key][$k] = $param['value'];
                                        }
                                        $res[$key]['paramsvalue'] = $value;
                                    }
                                    if ($val['IsSale'] == 0) {
                                        $res[$key]['IsSale'] = '已上架';
                                    } else {
                                        $res[$key]['IsSale'] = '已下架';
                                    }
                                
	  	}
	  	if($page  && $count)
	  	{
	  		return  array('rows'=>$res,'total'=>$count);
	  	}
	  	return $res;
	  
	
	}
	
	
//	public static function getGoodsByDearID($dearID){
//	    //1.获取此经销商的授权厂家
//	    //2.取出厂家ID
//	    //3.传输厂家ID和$dearID到getGoodsByMDID；
//	    //4.整合数据返回
//	    $dealerID=Dealer::model()->findByPk($dearID);
//	    $makers=MakeEmpowerDealer::model()->findAll('dealer_id=:dealer_id',array(':dealer_id'=>$dearID));
//	    foreach ($makers as $make){
//	    	$results=self::getGoodsByMDID($make->up_userID, $dealerID->userID);
//	    	foreach ($results as $key=>$val){
//	    		$result[]=$val;
//	    	}
//	    }
//	    return $result;
//	}
	public static function getGoodsByDearID($daearID,$params,$page,$pageSize){
	    $criteria=new CDbCriteria();
  		$sql=" select distinct a.id as goodsID ,a.NewVersion as verion_name,b.goodsno as goodsno,b.name as goodsname,b.price as goodsprice, a.brand as brand,a.oe as OENO,"
	  		." (select distinct f.code  from tbl_parts_level f where b.parts_level=f.id) as parts_level,"
	  		." (select distinct e.cp_name from tbl_goods_standard e where e.id=d.standard_id) as cp_name,"
	  		." (select distinct c.name from tbl_goods_category c where c.id=a.category_id and a.manufacturer_id=c.manufacturer_id) as category"
	  		."  from tbl_goods a ,tbl_goods_version b,tbl_goods_template d,tbl_goods_category c,tbl_goods_standard e"
			.'  where a.id=b.goods_id and a.NewVersion=b.version_name'
			."  and b.templet_id=d.id and e.id=d.standard_id"
			."  and a.manufacturer_id=b.manufacturer_id"
			."  and c.id=a.category_id and a.manufacturer_id=c.manufacturer_id"
			."  and a.ISdelete='N' and a.IsSale='Y'  "
	  		."  and a.id in (select distinct c.goods_id  "
  			."	from tbl_make_empower_dealer a, "
  			."  tbl_make_empower_category b, "
  			."  tbl_make_empower_category_relation c  "
  			."  where a.category=c.cate_id and a.category=b.id and c.cate_id=b.id "
  			."  and b.userID=a.up_userID and a.dealer_id = ".$_GET['dealer'].") ";
	  	if($params)
		{
			//搜索查询字段接收
			$radionum=isset($params['num'])?trim($params['num']):'';
			$oenum=isset($params['oenum'])?trim($params['oenum']):'';
			$category=isset($params['category'])?trim($params['category']):'';
			$system=isset($params['system_type'])?trim($params['system_type']):'';
			$cpname=isset($params['cp_name'])?trim($params['cp_name']):'';
			$goodsname=isset($params['name'])?trim($params['name']):'';
			
			//商品名称搜索
			if(!empty($goodsname))
			{
				$sql.=" and b.name like'%".$goodsname."%'";
			}
			//OE号搜索
			if(!empty($oenum))
			{
				$sql.=" and a.oe like '%".$oenum."%'";
			}
			//商品编号搜索
			if(!empty($radionum))
			{
				$sql.=" and b.goodsno like '%".$radionum."%'";
			}
			//商品类别搜索
			if(!empty($category)&& $category !='商品类别')
			{
				$sql.=" and c.name='".$category."'";
			}
			//配件品类搜索
			if(!empty($cpname))
			{
				$sql.=" and e.cp_name = '".$cpname."'";
			}elseif (!empty($system)){
				$sql.=" and e.cp_name in (select cp_name from tbl_goods_standard where system_type='".$system."')";
			}
		}
		$sql.=" group by a.id order by a.id desc";
		$results=Yii::app()->db->createCommand($sql)->queryAll();
		$count=count($results);
		$pages=new CPagination($count);
		
		//设置分页页数
		$pages->pageSize=10;
		$pages->applyLimit($criteria);
		$results=Yii::app()->db->createCommand($sql." LIMIT :offset,:limit");
		//绑定分页参数
		$results->bindValue(':offset', $pages->currentPage*$pages->pageSize);
		$results->bindValue(':limit', $pages->pageSize);
		$results=$results->queryAll();
	    foreach($results as $key => $val){	
	  		$OEArr=explode(',',$val['OENO']);
	  		$results[$key]["car"] = self::getVehicleByOEArr($OEArr);
	  		
	  	}
		return array($results,$pages);
	
	}
	
	  public static function GetGoodsByMakeID($manufacturer_ID,$params,$page=null,$limit=10)
	  {
	  	
	  	return self::getGoodsByMDID($manufacturer_ID,Yii::app()->user->id,$params,$page,$limit);
	  }
	  /**
	   * 
	   * @param 商品SQL
	   * goodsno商品编号,OE:OE号,
	   * 商品名称:goodsname
	   * 商品类别:category,商品品牌:brand
	   * 商品描述:description,适用车系:car,标准名称:cp_name
	   */
	  public static function GetGoodsBySql($manufacturer_ID,$userID) 
	  {
	  		//$userID=Yii::app()->user->id;
	  		$sql=" select distinct a.id as goodsID ,a.NewVersion as verion_name,b.goodsno as goodsno,b.name as goodsname,b.price as goodsprice,"
	  			." a.oe as OE,a.brand as brand,b.description,"

	  			." (select distinct f.code  from tbl_parts_level f where b.parts_level=f.id) as parts_level,"

	  			." (select distinct e.cp_name from tbl_goods_standard e where e.id=d.standard_id) as cp_name,"

	  			." (select distinct c.name from tbl_goods_category c where c.id=a.category_id and a.manufacturer_id=c.manufacturer_id) as category,"

	  			." (select distinct n.car from tbl_goods_vehicle m where m.Goods_ID=a.id and n.VehicleID in (m.VehicleID)) as car"

	  			."  from tbl_goods a ,tbl_goods_version b,tbl_goods_template d,tbl_vehicle n,tbl_goods_category c,tbl_goods_standard e"

	  			.'  where e.id=d.standard_id and c.id=a.category_id and a.manufacturer_id=c.manufacturer_id and a.id=b.goods_id and a.NewVersion=b.version_name'

	  			."  and b.templet_id=d.id"

	  			."  and a.manufacturer_id=b.manufacturer_id"

	  			."  and a.ISdelete='N' and a.IsSale='Y'  "

	  			."  and a.manufacturer_id=$manufacturer_ID "

	  		    ."  and a.id in (select goods_id from tbl_make_empower_category_relation g, "

	  		  	." tbl_make_empower_dealer h,tbl_dealer j where h.up_userID=$manufacturer_ID"

	  			."  and h.dealer_id=j.id and j.userID=$userID and category=g.cate_id)";
	  		return $sql;
	  }
	  /**

	   * 商品编号接口

	   */

	  public static function GetGoodsByGoodsNo($goodsno,$manufacturer_ID)

	  {

	  	try{

	  		//$userID=Yii::app()->user->id;
		//$dealerID=Dealer::model()->find('userID=:userID',array(':userID'=>$userID));

		//$grade=MakeEmpowerDealer::model()->find('up_userID=:up_userID and dealer_id=:dealer_id',array(':up_userID'=>$manufacturer_ID,':dealer_id'=>$dealerID->id));
//	  $sql=" select distinct a.id as goodsID,a.oe as OE, a.brand as brand ,a.NewVersion as verion_name,b.goodsno as goodsno,b.name as goodsname,b.price as makretprice,"
//		."b.price".$grade->grade." as goodsprice,"
//		." (select f.code  from tbl_parts_level f where b.parts_level=f.id) as parts_level,"
//		." (select e.cp_name from tbl_goods_standard e where e.id=d.standard_id) as cp_name,"
//		." (select c.name from tbl_goods_category c where c.id=a.category_id and a.manufacturer_id=c.manufacturer_id) as category"
//		//." (select n.car from tbl_goods_vehicle m,tbl_vehicle n where m.Goods_ID='$goodsID' and n.VehicleID in (m.VehicleID)) as car"
//		."  from tbl_goods a ,tbl_goods_version b,tbl_goods_template d,tbl_vehicle n"
//		.'  where a.id=b.goods_id and a.NewVersion=b.version_name'
//		."  and b.templet_id=d.id"
//		."  and a.manufacturer_id=b.manufacturer_id"
//		."  and a.ISdelete='N' and a.IsSale='Y'  "
//		."  and a.manufacturer_id=$manufacturer_ID "
//		."  and a.id=$goodsID"
//		."  group by a.id order by a.id desc";
//$sql=" select distinct a.id as goodsID ,a.oe as OE,a.brand as brand,a.NewVersion as verion_name,b.goodsno as goodsno,b.name as goodsname,b.price as marketprice,"
//		."b.price".$grade->grade." as goodsprice,"
//		." (select distinct f.code  from tbl_parts_level f where b.parts_level=f.id) as parts_level,"
//		." (select distinct e.cp_name from tbl_goods_standard e where e.id=d.standard_id) as cp_name,"
//		." (select distinct c.name from tbl_goods_category c where c.id=a.category_id and a.manufacturer_id=c.manufacturer_id) as category"
//		."  from tbl_goods a ,tbl_goods_version b,tbl_goods_category c,tbl_goods_template d,tbl_goods_standard e,tbl_parts_level f,tbl_goods_values g"
//		.'  where a.id=b.goods_id and a.NewVersion=b.version_name'
//		."  and b.parts_level=f.id"
//		."  and b.templet_id=d.id"
//		."  and e.id=d.standard_id"
//		."  and a.category_id=c.id"
//		."  and b.values_id = g.id"
//		."  and a.manufacturer_id=b.manufacturer_id"
//		."  and a.ISdelete='N' and a.IsSale='Y'"
//		."  and a.manufacturer_id='$manufacturer_ID' ";
//		$sql.="  and b.goodsno='{$goodsno}'";
//		$sql.="  group by a.id order by a.id desc";
            //授权品牌
                $organID=Commonmodel::getOrganID();
                $brands=  MakePromitBrand::model()->find('DealerID='.$organID.' and OrganID='.$manufacturer_ID);  
            $sql2 = "select distinct a.id as goodsID ,b.goods_category as category_id,b.goods_oe as OE,b.goods_brand as brand,b.organID,
                		 	    a.NewVersion as verion_name,b.goods_no as goodsno,b.goods_name as goodsname,
                                b.benchmarking_brand,b.benchmarking_sn,a.create_time,d.Price,"
                    . " b.inventory as inventory,b.senddays,b.description,a.IsSale,b.standard_id"
                    . " from  tbl_make_goods a ,tbl_make_goods_version b ,tbl_make_goods_vehicle c,tbl_make_price_relation d"
                    . '  where a.id=b.goods_id and a.NewVersion=b.version_name'
                    . "  and a.ISdelete='0' and b.ISdelete=0"
                    . "  and a.organID='$manufacturer_ID' and b.goods_no='$goodsno'";

            $identity = Commonmodel::getIdentity(Yii::app()->user->id);
            if ($identity['identity'] == 2&&$brands['CustomerType']) {
                $sql2.=" and d.TypeID= {$brands['CustomerType']} and d.GoodsID=a.id and d.Price is not null and a.IsSale=0";
                
            }
            $result = Yii::app()->db->createCommand($sql2)->queryRow();
            if ($result) {
                //查询品牌名称
                $brandmodel = MakeGoodsBrand::model()->findByPK($result['brand']);
                $result['brand'] = $brandmodel['BrandName'];
                //商品销售价
                if ($result['Price']) {
                    $result['goodsprice'] = $result['Price'];
                }
                //$result['goodsprice']=sprintf("%.2f", $result['salesprice'] * $ratio / 100);
            }

            return $result;
	  	}catch(CDbException $e){

	  	throw CDbException($e);
	  				}
	  }
	  public static function GetGoodsByMakerID($userID){
             $sql= " select distinct a.id as goodsID ,a.oe,a.brand as brand,a.NewVersion as verion_name,b.goodsno as goodsno,b.name as goodsname,b.price as goodsprice,"
		." (select distinct f.code  from tbl_parts_level f where b.parts_level=f.id) as parts_level,"
		." (select distinct e.cp_name from tbl_goods_standard e where e.id=d.standard_id) as cp_name,"
		." (select distinct c.name from tbl_goods_category c where c.id=a.category_id and a.manufacturer_id=c.manufacturer_id) as category"
		."  from tbl_goods a ,tbl_goods_version b,tbl_goods_category c,tbl_goods_template d,tbl_goods_standard e,tbl_parts_level f,tbl_goods_values g"
		.'  where a.id=b.goods_id and a.NewVersion=b.version_name'
		."  and b.parts_level=f.id"
		."  and b.templet_id=d.id"
		."  and e.id=d.standard_id"
		."  and a.category_id=c.id"
		."  and b.values_id = g.id"
		."  and a.manufacturer_id=b.manufacturer_id"
		."  and a.ISdelete='N' and a.IsSale='Y'"
		."  and a.manufacturer_id='$userID' ";
            return $sql;
          }
}