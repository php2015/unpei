<?php

/**
 * This is the model class for table "{{make_maintain_brand}}".
 *
 * The followings are the available columns in table '{{make_maintain_brand}}':
 * @property integer $BrandID
 * @property string $Name
 * @property string $Cname
 * @property string $Ename
 */
class MakeMaintainBrand extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return MakeMaintainBrand the static model class
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
		return '{{make_maintain_brand}}';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('Name', 'required'),
			array('Name, Cname, Ename', 'length', 'max'=>50),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('BrandID, Name, Cname, Ename', 'safe', 'on'=>'search'),
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
			'BrandID' => 'Brand',
			'Name' => 'Name',
			'Cname' => 'Cname',
			'Ename' => 'Ename',
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

		$criteria->compare('BrandID',$this->BrandID);
		$criteria->compare('Name',$this->Name,true);
		$criteria->compare('Cname',$this->Cname,true);
		$criteria->compare('Ename',$this->Ename,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
	public static function showMaintainbrand($id)
	{
		$model = self::model()->find("BrandID=:id",array(":id"=>$id));
		echo $model->Name;
	}
}