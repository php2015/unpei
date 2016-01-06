<?php
class GoodsController extends Controller
{
	/**
	 * 显示商品订购页面
	 */
	public function actionIndex()
	{
		$userID = Commonmodel::getOrganID();
		$sql="select distinct a.id as id,a.IsSale,b.goodsno,b.name,a.brand,b.cpname,c.name as category,a.oe,b.price,b.inventory,"
			."b.senddays,b.description,d.car,e.code from "
			." tbl_goods a, tbl_goods_version b,tbl_goods_category c,tbl_goods_brand d,tbl_parts_level e"
			. " where a.id=b.goods_id and c.id=a.category_id and b.car_id=d.id and b.parts_level = e.id and a.ISdelete='N'";
		$result=Yii::app()->db->createCommand($sql)->queryAll();
		// 临时选中商品
		$tempgoods = DealerTempGoods::model()->findAll('user_id=:userid',array(':userid'=>$userID));
		$goodsids = array();
		foreach ($tempgoods as $k => $tgoods)
		$goodsids[] = $tgoods['goods_id']; 
		
		//print_r($goodsid);
		$this->render('index',array(
			'models' => $result,
			'tempgoods' => $tempgoods,
			'goodsids' => $goodsids,
		));
	}
	/**
	 * 把添加的商品添加到临时表里
	 */
	public function actionAddtempgoods()
	{
		$goodsid = $_POST['goodsid'];
		$userID = Commonmodel::getOrganID();
		$sql="select a.id as id,b.goodsno,b.name,a.brand,c.name as category,a.oe,b.price,d.car,e.code from "
			." tbl_goods a, tbl_goods_version b,tbl_goods_category c,tbl_goods_brand d,tbl_parts_level e"
			. " where a.id=b.goods_id and c.id=a.category_id and b.car_id=d.id and b.parts_level = e.id and a.ISdelete='N' and a.id =".$goodsid;
		$result=Yii::app()->db->createCommand($sql)->queryAll();
		
		//添加  
	   $bool = Yii::app()->db->createCommand()->insert('tbl_dealer_temp_goods',   
		array(  
		    'user_id' => $userID,   
		    'goods_id' => $result[0]['id'],   
		    'goods_no' => $result[0]['goodsno'],   
		    'name' => $result[0]['name'],   
		    'brand_id' => $result[0]['brand'],  
		    'price' => $result[0]['price'],   
		    'parts_level' => $result[0]['code'],
		    'quantity' => 1,
		));
		
		$tempid =  Yii::app()->db->getLastInsertID();
		$data = array('tempid'=>$tempid,'success'=>$bool);
		echo json_encode($data);
		
		//echo $result[0]['id'];
	}
	/**
	 * ajax 清空选择的商品
	 */
	public function actionDeltempgoods()
	{
		$id = $_GET['promID'];
		$count = DealerTempGoods::model()->deleteAll('id IN (' . $id . ')');
		if($count>0)
			echo $bool = true;
		else 
		    echo $bool = false;
	}
	/**
	 * 修改数量
	 */
	public function actionUpdatetpgoods()
	{
		$id = $_GET['promID'];
		$quant = $_GET['quant'];
		$bool = DealerTempGoods::model()->updateByPk($id,array('quantity'=>$quant));
		echo $bool;
	}
	/**
	 * 创建订单
	 */
	public function actionCreateorder()
	{
		$userID = Commonmodel::getOrganID();
		$order_no = time().rand(2, 100).$userID; // 订单编号
		$make_id = '3';	// 卖家
		$dealer_id = $userID; // 买家
		$stauts = 10;
		$addtime = time();
		//生成订单
	   $bool = Yii::app()->db->createCommand()->insert('tbl_dealer_order',   
		array(  
		    'order_no' => $order_no,    // 订单编号
		    'maker_id' => $make_id,  	// 生产商ID（卖家） 
		    'dealer_id' => $dealer_id,  // 经销商ID（买家）
		    'status' => $stauts,   		// 订单状态  （初始状态 10）
		    'add_time' => $addtime,  	// 订单生成时间
		));
		// 生成的订单ID
		$orderid = Yii::app()->db->getLastInsertID();
		// 购买的商品
		$tempgoods = DealerTempGoods::model()->findAll('user_id=:userid',array(':userid'=>$userID));
		foreach ($tempgoods as $goods)
		{	//生成订单商品
			$bool = Yii::app()->db->createCommand()->insert('tbl_dealer_order_goods',   
			array(  
			    'order_id' => $orderid,   				// 订单ID
			    'goods_id' => $goods['goods_id'],		// 商品ID   
			    'goods_no' => $goods['goods_no'], 		// 商品编号ID  
			    'name' => $goods['name'],   			// 商品名称
			    'brand_id' => $goods['brand_id'], 		// 品牌 
			    'price' => $goods['price'],  			// 价格
			    'parts_level' => $goods['parts_level'], // 配件档次
			    'quantity' => $goods['quantity'], 		// 数量 
			));
		}
		if ($bool) // 清空临时表中的数据
		{
			$id = $_GET['promID'];
			$count = DealerTempGoods::model()->deleteAll('id IN (' . $id . ')');
			if($count>0)
				$bool = true;
			else 
			    $bool = false;
			}
		
		echo $bool;
	}
	
}