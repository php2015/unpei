<?php

/**
 * This is the model class for table "{{admin_template}}".
 *
 * The followings are the available columns in table '{{admin_template}}':
 * @property integer $ID
 * @property string $Name
 * @property integer $TypeID
 * @property string $FileUrl
 * @property string $Content
 * @property string $Describe
 * @property integer $CreateTime
 * @property integer $Status
 */
class AdminTemplate extends CActiveRecord
{
        public $keywords;
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return AdminTemplate the static model class
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
		return '{{admin_template}}';
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
			array('TypeID, CreateTime, Status, RootTypeID', 'numerical', 'integerOnly'=>true),
			array('Name', 'length', 'max'=>64),
			array('FileUrl, Content, Describe', 'length', 'max'=>255),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('ID, Name, TypeID,  Describe', 'safe', 'on'=>'search'),
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
                    'templatetype' => array(self::BELONGS_TO, 'AdminTemplateType', 'TypeID'),
                );
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'ID' => 'ID',
			'Name' => '模版名称',
			'TypeID' => 'Type',
			'FileUrl' => 'Excel模版',
			'Content' => 'Content',
			'Describe' => '描述',
			'CreateTime' => 'Create Time',
			'Status' => 'Status',
			'RootTypeID' => 'RootTypeID',
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

		$criteria->compare('ID',$this->ID);
		$criteria->compare('Name',$this->Name,true);
		$criteria->compare('TypeID',$this->TypeID);
//		$criteria->compare('FileUrl',$this->FileUrl,true);
//		$criteria->compare('Content',$this->Content,true);
		$criteria->compare('Describe',$this->Describe,true);
//		$criteria->compare('CreateTime',$this->CreateTime);
//		$criteria->compare('Status',$this->Status);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
        public function getEav($attribute) {
            $page = AdminTemplate::model()->findByPk($this->id);
           return $page->getEavAttribute($attribute);
        }
}