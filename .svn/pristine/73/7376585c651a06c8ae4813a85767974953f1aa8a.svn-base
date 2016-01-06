<?php

/**
 * This is the model class for table "{{distribution_business}}".
 *
 * The followings are the available columns in table '{{distribution_business}}':
 * @property integer $ID
 * @property integer $OrganID
 * @property string $Name
 * @property string $PriceRatio
 * @property string $DistributionTime
 * @property string $DistributionScope
 */
class DistributionBusiness extends DSPActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return '{{distribution_business}}';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('OrganID', 'required'),
			array('OrganID', 'numerical', 'integerOnly'=>true),
			array('Name, PriceRatio, DistributionTime', 'length', 'max'=>100),
			array('DistributionScope', 'length', 'max'=>50),
                        array('Name', 'uniqueName', 'caseSensitive'=>false),
                        array('Name, PriceRatio, DistributionTime, DistributionScope', 'required'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('ID, OrganID, Name, PriceRatio, DistributionTime, DistributionScope', 'safe', 'on'=>'search'),
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
			'ID' => 'ID',
			'OrganID' => 'Organ',
			'Name' => '配送商名称',
			'PriceRatio' => 'Price Ratio',
			'DistributionTime' => 'Distribution Time',
			'DistributionScope' => '配送范围',
		);
	}

	/**
	 * Retrieves a list of models based on the current search/filter conditions.
	 *
	 * Typical usecase:
	 * - Initialize the model fields with values from filter form.
	 * - Execute this method to get CActiveDataProvider instance which will filter
	 * models according to data in model fields.
	 * - Pass data provider to CGridView, CListView or any similar widget.
	 *
	 * @return CActiveDataProvider the data provider that can return the models
	 * based on the search/filter conditions.
	 */
	public function search()
	{
		// @todo Please modify the following code to remove attributes that should not be searched.

		$criteria=new CDbCriteria;

		$criteria->compare('ID',$this->ID);
		$criteria->compare('OrganID',$this->OrganID);
		$criteria->compare('Name',$this->Name,true);
		$criteria->compare('PriceRatio',$this->PriceRatio,true);
		$criteria->compare('DistributionTime',$this->DistributionTime,true);
		$criteria->compare('DistributionScope',$this->DistributionScope,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * @return CDbConnection the database connection used for this class
	 */
	public function getDbConnection()
	{
		return Yii::app()->dspdb;
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return DistributionBusiness the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
        
        /**
         * 自定义验证规则 机构名称不能为空
         */
        public function uniqueName(){
            if(!$this->hasErrors('Name')){
                $organID=  Commonmodel::getOrganID();
                if(!$this->ID){
                    $model=  self::model()->findAll("OrganID=:OrganID and Name=:name",array(':OrganID'=>$organID,':name'=>  $this->Name));
                }else{
                    $model=  self::model()->findAll("OrganID=:OrganID and Name=:name and ID!=:id",array(':OrganID'=>$organID,':name'=>  $this->Name,':id'=>  $this->ID));
                }
                if(!empty($model)){
                    $this->addError('Name', '该配送商名称已存在');
                }
            }
        }
}
