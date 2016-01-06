<?php

/**
 * This is the model class for table "{{dealer_vehicle}}".
 *
 * The followings are the available columns in table '{{dealer_vehicle}}':
 * @property integer $id
 * @property integer $userid
 * @property string $businessMake
 * @property string $businessCar
 * @property string $businessYear
 * @property string $businessCarModel
 */
class DealerVehicle extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return DealerVehicle the static model class
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
		return '{{dealer_vehicle}}';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('userid', 'numerical', 'integerOnly'=>true),
			array('businessMake, businessCar, businessYear, businessCarModel', 'length', 'max'=>64),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, userid, businessMake, businessCar, businessYear, businessCarModel', 'safe', 'on'=>'search'),
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
			'userid' => 'Userid',
			'businessMake' => 'Business Make',
			'businessCar' => 'Business Car',
			'businessYear' => 'Business Year',
			'businessCarModel' => 'Business Car Model',
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
		$criteria->compare('userid',$this->userid);
		$criteria->compare('businessMake',$this->businessMake,true);
		$criteria->compare('businessCar',$this->businessCar,true);
		$criteria->compare('businessYear',$this->businessYear,true);
		$criteria->compare('businessCarModel',$this->businessCarModel,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
        

    /**
     * 根据用户ID取出所有主营车系
     * Enter description here ...
     * @param unknown_type $userID
     */
    public static function getVehAll($userID) {
        $models = self::model()->findAll("userID=:userID", array(":userID" => $userID));
        $i = 1;
        $vehicle = "";
        foreach ($models as $key => $value) {
            if ($i == 1) {
                //$vehicle=TransportMake::getMake($value->businessCar).TransportCar::getCar($value->businessCarModel);
                $vehicle = GoodsBrand::getName($value->businessCar) . GoodsBrand::getCar($value->businessCarModel);
            } else {
                $vehicle.=',' . GoodsBrand::getName($value->businessCar) . GoodsBrand::getCar($value->businessCarModel);
            }
            $i++;
        }
        return $vehicle;
    }
}