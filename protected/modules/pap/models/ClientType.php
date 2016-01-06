<?php

/**
 * This is the model class for table "{{client_type}}".
 *
 * The followings are the available columns in table '{{client_type}}':
 * @property string $ID
 * @property integer $DealerID
 * @property integer $ServiceID
 * @property string $Cooperationtype
 */
class ClientType extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return ClientType the static model class
	 */
    public $OrganName;
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}

	/**
	 * @return CDbConnection database connection
	 */
	public function getDbConnection()
	{
		return Yii::app()->papdb;
	}

	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return '{{client_type}}';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('DealerID, ServiceID, Cooperationtype', 'required'),
			array('DealerID, ServiceID', 'numerical', 'integerOnly'=>true),
			array('Cooperationtype', 'length', 'max'=>50),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('ID, DealerID, ServiceID, Cooperationtype', 'safe', 'on'=>'search'),
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
                //     'service_name' => array(self::HAS_ONE, 'Organ', '', 'on' => 'service_name.ID=t.ServiceID'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'ID' => 'ID',
			'DealerID' => 'Dealer',
			'ServiceID' => 'Service',
			'Cooperationtype' => 'Cooperationtype',
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

		$criteria->compare('ID',$this->ID,true);
		$criteria->compare('DealerID',$this->DealerID);
		$criteria->compare('ServiceID',$this->ServiceID);
		$criteria->compare('Cooperationtype',$this->Cooperationtype,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}