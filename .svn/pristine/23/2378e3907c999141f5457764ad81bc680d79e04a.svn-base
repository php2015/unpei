<?php

/**
 * This is the model class for table "{{epc_model_temp}}".
 *
 * The followings are the available columns in table '{{epc_model_temp}}':
 * @property string $id
 * @property string $make
 * @property string $series
 * @property string $year
 * @property string $model
 * @property string $content
 * @property string $fileName
 * @property string $filePath
 * @property string $userId
 * @property string $organId
 * @property string $createTime
 * @property integer $updateTime
 * @property integer $status
 */
class EpcModelTemp extends JPDActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return EpcModelTemp the static model class
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
		return '{{epc_model_temp}}';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('Make,Series,Model,Content','required'),
			array('Make','length','max'=>50),
			array('Series,Model,FileName,FilePath','length','max'=>200),
			array('Year','length','max'=>20),
 				array('FileName','file',
 				'types'=>'doc,docx,xls,xlsx',
				'maxSize'=>1024 * 1024 * 2, //2MB
				'tooLarge'=>'文件超过2M，请上传小一点的文件。',
				'allowEmpty' => true

 		),
			array('ID, FilePath, UserID, OrganID, CreateTime, UpdateTime, Status', 'safe', 'on'=>'create'),
			array('ID,Make,Series,Year,Model,Content,FileName,FilePath,UserID,OrganID,CreateTime,UpdateTime,Status','safe','on'=>'search'),
// 			array('FileName', 'File',
// 				'yypes' => 'doc, docx, xls, xlsx',
// 				'maxSize' => 1024 * 1024 * 2, // 2MB
// 				'tooLarge' => '文件超过 2MB. 请上传小一点儿的文件.',
// 				'allowEmpty' => true
// 			),
// 			array('ID, FilePath, UserID, OrganID, CreateTime, UpdateTime, Status', 'safe', 'on'=>'create'),
// 			// The following rule is used by search().
// 			// Please remove those attributes that should not be searched.

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
			'Make' => '厂家',
			'Series' => '车系',
			'Year' => '年款',
			'Model' => '车型',
			'Content' => '描述',
			'FileName' => '附件',
			'FilePath' => 'File Path',
			'UserID' => 'User',
			'OrganID' => 'Organ',
			'CreateTime' => 'Create Time',
			'UpdateTime' => 'Update Time',
			'Status' => 'Status',
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
		$criteria->compare('Make',$this->Make,true);
		$criteria->compare('Series',$this->Series,true);
		$criteria->compare('Year',$this->Year,true);
		$criteria->compare('Model',$this->Model,true);
		$criteria->compare('Content',$this->Content,true);
		$criteria->compare('FileName',$this->FileName,true);
		$criteria->compare('FilePath',$this->FilePath,true);
		$criteria->compare('UserId',$this->UserID,true);
		$criteria->compare('OrganId',$this->OrganID,true);
		$criteria->compare('CreateTime',$this->CreateTisme,true);
		$criteria->compare('UpdateTime',$this->UpdateTime);
		$criteria->compare('Status',$this->Status);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
	
	public function beforeSave() 
	{
		if (parent::beforeSave()) {
			if ($this->isNewRecord) {
				$this->CreateTime = $this->UpdateTime = time();
				$this->Status = '0';
				$this->UserID = Yii::app()->user->id;
				$this->OrganID = Yii::app()->user->getState('OrganID');
			}
			else
				$this->UpdateTime = time();
			return true;
		}
		else
			return false;
	}
	
	public function afterFind()
	{
		parent::afterFind();
		// 修改时间格式
		//if(self::model()->scenario == 'list') {
		$this->setAttribute('GreateTime',date('Y-m-d H:i:s',$this->getAttribute('createTime')));
		$this->setAttribute('UpdateTime',date('Y-m-d H:i:s',$this->getAttribute('updateTime')));
		$status = $this->getAttribute('status');
		$this->setAttribute('Status',($status=='0'?'待审核':($status=='1'?'审核通过':($status=='2'?'审核未通过':'其他'))));
		//}
	}
	
	/**
	 * 页面显示的表单列
	 * @param unknown $scope
	 * @return multitype:Ambigous <string>
	 */
	public static function attributeFields($scope)
	{
		$attributeLabels = array(
			'Make' => '厂家',
			'Series' => '车系',
			'Year' => '年款',
			'Model' => '车型',
			'Content' => '描述',
			'FileName' => '附件',
			'FilePath' => 'File Path',
			'CreateTime' => '提交时间',
			'UpdateTime' => 'Update Time',
			'Status' => '状态',
		);
		$fields = array();
		if($scope == 'list') {
			$keys = array('Make','Series','Year','Model','Content','CreateTime','Status');
			foreach($keys as $key) {
				$fields[$key] = $attributeLabels[$key];
			}
		}
		return $fields;
	}
}