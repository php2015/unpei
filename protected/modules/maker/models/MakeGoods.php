<?php

/**
 * This is the model class for table "{{make_goods}}".
 *
 * The followings are the available columns in table '{{make_goods}}':
 * @property integer $id
 * @property integer $create_time
 * @property integer $updatetime
 * @property integer $organID
 * @property integer $userID
 * @property string $IsSale
 * @property string $ISdelete
 * @property string $NewVersion
 */
class MakeGoods extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return '{{make_goods}}';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('create_time, updatetime, organID, userID', 'numerical', 'integerOnly'=>true),
			array('IsSale, ISdelete', 'length', 'max'=>2),
			array('NewVersion', 'length', 'max'=>20),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, create_time, updatetime, organID, userID, IsSale, ISdelete, NewVersion', 'safe', 'on'=>'search'),
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
			'create_time' => 'Create Time',
			'updatetime' => 'Updatetime',
			'organID' => 'Organ',
			'userID' => 'User',
			'IsSale' => 'Is Sale',
			'ISdelete' => 'Isdelete',
			'NewVersion' => 'New Version',
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

		$criteria->compare('id',$this->id);
		$criteria->compare('create_time',$this->create_time);
		$criteria->compare('updatetime',$this->updatetime);
		$criteria->compare('organID',$this->organID);
		$criteria->compare('userID',$this->userID);
		$criteria->compare('IsSale',$this->IsSale,true);
		$criteria->compare('ISdelete',$this->ISdelete,true);
		$criteria->compare('NewVersion',$this->NewVersion,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return MakeGoods the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}

	protected function beforeSave()
	{
		if(parent::beforeSave())
		{
                        $userId=Yii::app()->user->id;
			if($this->isNewRecord)
			{  
                                $organID=Commonmodel::getOrganID();
				$this->create_time=time();
				$this->updatetime=time();
				$this->organID=$organID;
				$this->userID=$userId;
				$this->IsSale=0;
				$this->ISdelete=0;
			}else 
			{
				$this->updatetime=time();
                                $this->userID=$userId;
			}
			return true;
		}else {
			return false;
		}
	}
}
