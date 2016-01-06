<?php

/**
 * This is the model class for table "{{make_online_store_relation}}".
 *
 * The followings are the available columns in table '{{make_online_store_relation}}':
 * @property integer $id
 * @property integer $userID
 * @property integer $onlineStoreID
 * @property string $onlineStoreUrl
 */
class MakeOnlineStoreRelation extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return MakeOnlineStoreRelation the static model class
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
		return '{{make_online_store_relation}}';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('userID, onlineStoreID', 'required'),
			array('userID, onlineStoreID', 'numerical', 'integerOnly'=>true),
			array('onlineStoreUrl', 'length', 'max'=>100),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, userID, onlineStoreID, onlineStoreUrl', 'safe', 'on'=>'search'),
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
			'userID' => 'User',
			'onlineStoreID' => 'Online Store',
			'onlineStoreUrl' => 'Online Store Url',
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
		$criteria->compare('userID',$this->userID);
		$criteria->compare('onlineStoreID',$this->onlineStoreID);
		$criteria->compare('onlineStoreUrl',$this->onlineStoreUrl,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}