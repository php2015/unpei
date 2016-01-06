<?php
class GoodsForm extends CFormModel
{
	public $name;
	public $brand;
	public $goodsno;
	
	//验证
	public function rules()
	{
		return  array(
		//array('version','required','message'=>'请选择版本'),
		//array('goodsname','required'),
		
		
		);
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