<?php

/**
 * This is the model class for table "{{make_distribution_business}}".
 *
 * The followings are the available columns in table '{{make_distribution_business}}':
 * @property integer $id
 * @property integer $up_userID
 * @property string $name
 * @property string $priceratio
 * @property string $distributionTime
 * @property string $distributionScope
 */
class MakeDistributionBusiness extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return MakeDistributionBusiness the static model class
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
		return '{{make_distribution_business}}';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('up_userID', 'numerical', 'integerOnly'=>true),
			array('name', 'uniqueName', 'caseSensitive'=>false),
                    
			array('name, priceratio, distributionTime, distributionScope', 'required'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, up_userID, name, priceratio, distributionTime, distributionScope', 'safe', 'on'=>'search'),
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
			'up_userID' => 'Up User',
			'name' => '配送商名称',
			'priceratio' => 'Priceratio',
			'distributionTime' => 'Distribution Time',
			'distributionScope' => '配送范围',
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
		$criteria->compare('up_userID',$this->up_userID);
		$criteria->compare('name',$this->name,true);
		$criteria->compare('priceratio',$this->priceratio,true);
		$criteria->compare('distributionTime',$this->distributionTime,true);
		$criteria->compare('distributionScope',$this->distributionScope,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
	
	public static function showshipping($id)
	{
		$model = self::model()->find("id=:id",array(":id"=>$id));
		echo $model['name'];
	}
	public static function retshipping($id)
	{
		$model = self::model()->find("id=:id",array(":id"=>$id));
		return $model['name'];
	}
        /**
         * 自定义验证规则 机构名称不能为空
         */
        public function uniqueName(){
            if(!$this->hasErrors('name')){
                $organID=  Commonmodel::getOrganID();
                if(!$this->id){
                    $model=  self::model()->findAll("up_userID=:userID and name=:name",array(':userID'=>$organID,':name'=>  $this->name));
                }else{
                    $model=  self::model()->findAll("up_userID=:userID and name=:name and id!=:id",array(':userID'=>$organID,':name'=>  $this->name,':id'=>  $this->id));
                }
                if(!empty($model)){
                    $this->addError('name', '该名称已存在');
                }
            }
        }
}