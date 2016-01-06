<?php

/**
 * This is the model class for table "{{epc_group_temp}}".
 *
 * The followings are the available columns in table '{{epc_group_temp}}':
 * @property string $id
 * @property string $modelId
 * @property string $modelName
 * @property string $groupPid
 * @property string $groupPname
 * @property string $name
 * @property string $ename
 * @property string $groupNo
 * @property string $picture
 * @property string $picturePath
 * @property string $note
 * @property string $applicableModel
 * @property string $userId
 * @property string $organId
 * @property string $createTime
 * @property integer $updateTime
 * @property integer $status
 */
class EpcGroupTemp extends JPDActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return EpcGroupTemp the static model class
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
		return '{{epc_group_temp}}';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
 	public function rules()
 	{
// 		// NOTE: you should only define rules for those attributes that
// 		// will receive user inputs.
 		return array(
 				array('ModelID,Name,GroupNo,Note','required'),
 				array('ModelID, GroupPid, GroupNo', 'length', 'max'=>20),
 				array('Name, Ename, Picture, PicturePath, Note, ApplicableModel', 'length', 'max'=>200),
 				
 				array('id, modelName, groupPname, picturePath, userId, organId, createTime, updateTime, status', 'safe', 'on'=>'create'),
// 			array('modelId, name, groupNo, note', 'required'),
// 			array('modelId, groupPid, groupNo', 'length', 'max'=>20),
// 			array('name, ename, picture, picturePath, note, applicableModel', 'length', 'max'=>200),
// 			array('picture', 'file',
// 				'types' => 'jpg, jpeg, png, bmp',
// 				'maxSize' => 1024 * 1024 * 2, // 2MB
// 				'tooLarge' => '文件超过 2MB. 请上传小一点儿的文件.',
// 				'allowEmpty' => true
// 			),
// 			array('id, modelName, groupPname, picturePath, userId, organId, createTime, updateTime, status', 'safe', 'on'=>'create'),
// 			// The following rule is used by search().
// 			// Please remove those attributes that should not be searched.
// 			array('id, modelId, modelName, groupPid, groupPname, name, ename, groupNo, picture, picturePath, note, applicableModel, userId, organId, createTime, updateTime, status', 'safe', 'on'=>'search'),
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
			'ModelID' => '车型',
			'ModelName' => '车型',				
			'GroupPid' => '父配件组',
			'GroupPName' => '父配件组',
			'Name' => '配件组名称',
			'Ename' => '英文名称',
			'GroupNo' => '组号',
			'Picture' => '图片',
			'PicturePath' => 'Picture Path',
			'Note' => '备注',
			'ApplicableModel' => '适用车型',
			'UserId' => 'User',
			'OrganId' => 'Organ',
			'CreateTime' => '创建时间',
			'UpdateTime' => 'Update Time',
			'Status' => '状态',				
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
		$criteria->compare('ModelID',$this->ModelID,true);
		$criteria->compare('ModelName',$this->ModelName,true);
		$criteria->compare('GroupPid',$this->GroupPid,true);
		$criteria->compare('GroupPName',$this->GroupPname,true);
		$criteria->compare('Name',$this->Name,true);
		$criteria->compare('Ename',$this->Ename,true);
		$criteria->compare('GroupNo',$this->GroupNo,true);
		$criteria->compare('Picture',$this->Picture,true);
		$criteria->compare('PicturePath',$this->PicturePath,true);
		$criteria->compare('Note',$this->Note,true);
		$criteria->compare('ApplicableModel',$this->ApplicableModel,true);
		$criteria->compare('UserId',$this->UserId,true);
		$criteria->compare('OrganId',$this->OrganId,true);
		$criteria->compare('CreateTime',$this->CreateTime,true);
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
				$this->UserId = Yii::app()->user->id;
				$this->OrganId = Yii::app()->user->getState('OrganId');
			}
			else
				$this->updateTime = time();
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
		$this->setAttribute('CreateTime',date('Y-m-d H:i:s',$this->getAttribute('createTime')));
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
	public function attributeFields($scope)
	{
		$attributeLabels = $this->attributeLabels();
		$fields = array();
		if($scope == 'list') {
			$keys = array('Name','Ename','ModelName','GroupPname','GroupNo','ApplicableModel','Note','CreateTime','Status');
			foreach($keys as $key) {
				$fields[$key] = trim($attributeLabels[$key],':');
			}
		}
		return $fields;
	}	
}