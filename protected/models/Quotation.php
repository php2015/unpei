<?php

/**
 * This is the model class for table "{{quotation}}".
 *
 * The followings are the available columns in table '{{quotation}}':
 * @property string $id
 * @property string $user_id
 * @property string $order_num
 * @property string $quotation_name
 * @property integer $quotation_status
 * @property integer $pay_status
 * @property integer $ship_status
 * @property integer $unusual_status
 * @property integer $assess_status
 * @property string $quotation_fee
 * @property string $ship_fee
 * @property string $pay_fee
 * @property string $contract_url
 * @property string $pay_method
 * @property integer $receiver_id
 * @property string $pay_time
 * @property string $account_time
 * @property string $create_time
 * @property string $update_time
 * @property string $memo
 */
class Quotation extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return Quotation the static model class
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
		return '{{quotation}}';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('receiver_id, quotation_name, quotation_fee', 'required'),
			array('quotation_fee', 'numerical', 'min'=> 0, 'max'=>99999999),
			array('quotation_status, pay_status, ship_status, unusual_status, assess_status, receiver_id', 'numerical', 'integerOnly'=>true),
			array('user_id, quotation_fee, ship_fee, pay_fee', 'length', 'max'=>10),
			array('order_num, quotation_name', 'length', 'max'=>64),
			array('contract_url', 'length', 'max'=>255),
			array('pay_method', 'length', 'max'=>45),
			array('pay_time, account_time, create_time, update_time, memo', 'safe'),
			array('contract_url', 'file',
                'types' => 'doc, docx',
                'maxSize' => 1024 * 1024 * 2, // 2MB
                'tooLarge' => '文件超过 2MB. 请上传小一点儿的文件.',
                'allowEmpty' => false,
                'on' => 'create',
            ),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, user_id, order_num, quotation_name, quotation_status, pay_status, ship_status, unusual_status, assess_status, quotation_fee, ship_fee, pay_fee, contract_url, pay_method, receiver_id, pay_time, account_time, create_time, update_time, memo', 'safe', 'on'=>'search'),
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
			//'contact' => array(self::BELONGS_TO,'DealerBusinessContact','', 'on' => 'contact.contact_user_id = t.receiver_id'),	
			'seller' => array(self::BELONGS_TO,'User','user_id'),
			'buyer' => array(self::BELONGS_TO,'User','receiver_id'),
			'ship' => array(self::HAS_ONE,'QuotationShipping','quotation_id'),
			'log' => array(self::HAS_MANY,'QuotationLog','quotation_id','order'=>'action_time desc'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => '报价单ID',
			'user_id' => '发件人',
			'order_num' => '报价单编号',
			'quotation_name' => '报价单名称',
			'quotation_status' => '报价单状态',
			'pay_status' => '付款状态',
			'ship_status' => '物流状态',
			'unusual_status' => '异常状态',
			'assess_status' => '评价状态',
			'quotation_fee' => '报价单金额',
			'ship_fee' => '物流金额',
			'pay_fee' => '付款金额',
			'contract_url' => '合同',
			'pay_method' => '付款方式',
			'receiver_id' => '收件人',
			'pay_time' => '付款时间',
			'account_time' => '到账时间',
			'create_time' => '创建时间',
			'update_time' => '更新时间',
			'memo' => '备注',
		);
	}

	public static function itemAlias($type, $code = NULL) {
		$_items = array(
			'sell_quotation_status' => array(
				'0' => '待同意',
				'1' => '同意',
				'2' => '拒绝',
				'3' => '废弃',
				'9' => '成功',
			),
			'sell_unusual_status' => array(
				'1' => '异常',
		        '2' => '已废除',
			),
			'sell_pay_status' => array(
				'0' => '待付款',
				'1' => '已担保',
			),
			'ship_status' => array(
				'0' => '待发货',
				'1' => '已发货',
		        '2' => '确认收货',
			),
			'unusual_status' => array(
				'0' => '正常订单',
				'1' => '异常',
		        '2' => '已废除',
			),
			'assess_status' => array(
				'0' => '评价',
				'1' => '已评价',
			),
			'quotation_status' => array(
				'0' => '',
				'1' => '同意',
				'2' => '拒绝',
			    '3' => '废除',
			    '9' => '成功交易',
			),
			'pay_method' => array(
			    '0' => '月结',
			    '1' => '支付宝',
			),
		);
		if (isset($code))
			return isset($_items[$type][$code]) ? $_items[$type][$code] : false;
		else
			return isset($_items[$type]) ? $_items[$type] : false;
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

		$criteria->compare('id',$this->id,true);
		$criteria->compare('user_id',$this->user_id,true);
		$criteria->compare('order_num',$this->order_num,true);
		$criteria->compare('quotation_name',$this->quotation_name,true);
		$criteria->compare('quotation_status',$this->quotation_status);
		$criteria->compare('pay_status',$this->pay_status);
		$criteria->compare('ship_status',$this->ship_status);
		$criteria->compare('unusual_status',$this->unusual_status);
		$criteria->compare('assess_status',$this->assess_status);
		$criteria->compare('quotation_fee',$this->quotation_fee,true);
		$criteria->compare('ship_fee',$this->ship_fee,true);
		$criteria->compare('pay_fee',$this->pay_fee,true);
		$criteria->compare('contract_url',$this->contract_url,true);
		$criteria->compare('pay_method',$this->pay_method,true);
		$criteria->compare('receiver_id',$this->receiver_id);
		$criteria->compare('pay_time',$this->pay_time,true);
		$criteria->compare('account_time',$this->account_time,true);
		$criteria->compare('create_time',$this->create_time,true);
		$criteria->compare('update_time',$this->update_time,true);
		$criteria->compare('memo',$this->memo,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
	/**
     * 得到文件地址
     * @return type
     */
    public function getFilePath() 
    {
		return '/upload/quotation/'. $this->contract_url;
    }
    
    /**
     * 得到文件URL
     * @return type
     */
    public function getFileUrl() 
    {
		return F::baseUrl() . $this->getFilePath();
    }
    
    /**
	 * 收到的报价单状态
	 */
	public static function orderStauts()
	{
		return array(
				'' => '请选择',
				'4' => '待同意',
				'5' => '待付款',
			);
			
	}
    /**
	 * 失败交易报价单状态
	 */
	public static function failOrderStauts()
	{
		return array(
				'' => '请选择',
				'2' => '已拒绝',
				'3' => '已废除',
			);
			
	}
}