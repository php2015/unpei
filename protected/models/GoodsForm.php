<?php
class GoodsForm extends CFormModel
{
	public $goodsname;
	public $brand;
	public $goodsno;
	public $category;
	public $oeno;
	public $car;
	public $version;
	public $price;
	public $model;
	public $days;
	public $desc;
	public $parts_level;
	public $inventory;
	public $column;
	public $template;
	public $priceA;
	public $priceB;
	public $priceC;
	//验证
	public function rules()
	{
		return  array(
		array('goodsname','required','message'=>'请输入商品名称'),
		array('goodsno','required','message'=>'请输入商品编号'),
		array('goodsno','validateGoodsno'),
		array('category','required','message'=>'请选择商品类别'),
	    array('price','required','message'=>'请输入商品价格'),
		array('oeno','required','message'=>'请输入商品OE号'),
	    array('inventory','required','message'=>'请输入库存数'),
		array('parts_level','required','message'=>'请选择配件档次'),
		array('brand','required','message'=>'请输入商品品牌'),
		array('template','required','message'=>'请选择模板'),
		//array('car','required','message'=>'请选择车系'),
		//array('model','required','message'=>'请选择车型'),
		array('days','required','message'=>'请输入发货天数'),
		array('priceA','required','message'=>'请输入A类价格'),
		array('priceB','required','message'=>'请输入B类价格'),
		array('priceC','required','message'=>'请输入C类价格'),
		);
	}
	//验证商品编号唯一
	public function validateGoodsno($attribute,$params)
	{
		$manufacturer_id=Yii::app()->user->id;
		if(!$this->hasErrors('goodsno'))
		{
			$goodsno=trim($this->goodsno);
			$result=GoodsVersion::model()->findAll('goodsno=:goodsno and manufacturer_id=:manufacturer_id',array(':goodsno'=>$goodsno,':manufacturer_id'=>$manufacturer_id));
			if($result && count($result)>0)
			{
				$this->addError('goodsno','该商品编号已使用');
			}
		}
		
	}
	
	public function attributeLabels()
	{
		return array(
			'goodsname'=>'商品名称',
			'brand'=>'品牌',
			'goodsno'=>'商品编号',
			'category'=>'商品类别',
			'oeno'=>'原厂OE号',
			'car'=>'车系',
			'model'=>'车型',
			'version'=>'版本',
			'price'=>'市场指导价',
			'parts_level'=>'配件档次',
			'inventory'=>'库存',
			'days'=>'发货天数',
			'desc'=>'备注',
			'template'=>'商品模板',
			 'priceA'=>'A类价格',
			 'priceB'=>'B类价格',
			'priceC'=>'C类价格',
				);
	}
	/**
	 * 属性输入提示.
	 */
	public function attributeTip()
	{
		return array(
				'goodsname'=>'请输入商品名称',
				'brand' => '请选择品牌',
				'goodsno' => '输入商品编号',
				'category'=>'请选择商品类别',
				'oeno'=>'请输入原厂OE号',
				'car'=>'请选择车系',
				'model'=>'请选择车型',
				'version'=> '请选择版本',
				'price' => '请输入市场价',
				'parts_level' => '请选择配件档次',
				'inventory'=>'请输入库存',
				 'days'=>'请输入发货天数',
				'template'=>'模板',
		);
	}
	/**
	 * 获取提示信息
	 */
	public function getAttributeTip($attribute){
		$tips = $this->attributeTip();
		if(isset($tips[$attribute]))
			return $tips[$attribute];
		else
			return '';
	}
}