<?php

/**
 * This is the model class for table "{{epc_part_temp}}".
 *
 * The followings are the available columns in table '{{epc_part_temp}}':
 * @property string $id
 * @property string $modelId
 * @property string $modelName
 * @property string $mainGroupId
 * @property string $mainGroupName
 * @property string $groupId
 * @property string $groupName
 * @property string $partId 
 * @property string $name
 * @property string $ename
 * @property string $oeno
 * @property string $markNo
 * @property string $amount
 * @property string $note
 * @property string $location
 * @property string $picture
 * @property string $picturePath
 * @property string $price
 * @property string $specification
 * @property string $beginyear
 * @property string $endyear
 * @property string $applicableModel
 * @property string $userId
 * @property string $organId
 * @property string $createTime
 * @property integer $updateTime
 * @property integer $status
 */
class EpcPartTemp extends JPDActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return EpcPartTemp the static model class
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
		return '{{epc_part_temp}}';
	}

	/**
	 * @return array validation rules for model 	attributes.
	 */
 	public function rules()
 	{
// 		// NOTE: you should only define rules for those attributes that
// 		// will receive user inputs.
 		return array(
  				array('ModelID,MainGroupID,GroupIG,Name,Oeno,Note','required'),
  				array('Oeno,Price,Beginyear,Endyear','length','max'=>20),
  				array('Name, Ename, Location, Specification, ApplicableModel', 'length', 'max'=>200),
   				array('MarkNo', 'length', 'max'=>50),
   				array('Amount', 'length', 'max'=>10),
 				
  				array('PartID, ModelName, MainGroupName, GroupName, Ename, MarkNo, Amount, Location, Picture, PicturePath, Price,
  					Specification, Beginyear, Endyear, ApplicableModel, UserId, OrganId, CreateTime, UpdateTime, Status',
  					'safe', 'on'=>'create'),
  				array('ID, ModelID, ModelName, MainGroupID, MainGroupName, GroupIG, GroupName, PartID, Name, Ename, Oeno, MarkNo, Amount, Note,
  					Location, Picture, PicturePath, Price, Specification, Beginyear, Endyear, ApplicableModel, UserId, OrganId,
 					CreateTime, UpdateTime, Status', 'safe', 'on'=>'search'),
// 			array('Name, Ename, Location, Specification, ApplicableModel', 'Length', 'Max'=>200),
// 			array('MarkNo', 'Length', 'Max'=>50),
// 			array('Amount', 'Length', 'Max'=>10),
// 			array('Picture', 'File',
// 				'Types' => 'jpg, jpeg, png, bmp',
// 				'MaxSize' => 1024 * 1024 * 2, // 2MB
// 				'TooLarge' => '文件超过 2MB. 请上传小一点儿的文件.',
// 				'AllowEmpty' => true
// 			),
// 			array('PartID, ModelName, MainGroupName, GroupName, Ename, MarkNo, Amount, Location, Picture, PicturePath, Price, 
// 					Specification, Beginyear, Endyear, ApplicableModel, UserID, OrganID, CreateTime, UpdateTime, Status', 
// 					'Safe', 'On'=>'create'),
// 			// The following rule is used by search().
// 			// Please remove those attributes that should not be searched.
// 			array('ID, ModelID, ModelName, MainGroupID, MainGroupName, GroupID, GroupName, PartID, Name, Ename, Oeno, MarkNo, Amount, Note, 
// 					Location, Picture, PicturePath, Price, Specification, Beginyear, Endyear, ApplicableModel, UserID, OrganID, 
// 					CreateTime, UpdateTime, Status', 'Safe', 'On'=>'search'),
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
			'MainGroupID' => '配件主组',
			'MainGroupName' => '配件主组',
			'GroupIG' => '配件子组',
			'GroupName' => '配件子组',
			'PartID' => '配件ID',
			'Name' => '配件名称',
			'Ename' => '英文名称',
			'Oeno' => 'OE编号',
			'MarkNo' => '图号',
			'Amount' => '用量',
			'Note' => '备注',
			'Location' => '安装位置',
			'Picture' => '图片',
			'PicturePath' => 'Picture Path',
			'Price' => '指导价',
			'Specification' => '规格',
			'Beginyear' => '开始年份',
			'Endyear' => '结束年份',
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
		$criteria->compare('MainGroupID',$this->MainGroupID,true);
		$criteria->compare('MainGroupName',$this->MainGroupName,true);
		$criteria->compare('GroupIG',$this->GroupIG,true);
		$criteria->compare('GroupName',$this->GroupName,true);
		$criteria->compare('PartID',$this->PartID,true);
		$criteria->compare('Name',$this->Name,true);
		$criteria->compare('Ename',$this->Ename,true);
		$criteria->compare('Oeno',$this->Oeno,true);
		$criteria->compare('MarkNo',$this->MarkNo,true);
		$criteria->compare('Amount',$this->Amount,true);
		$criteria->compare('Note',$this->Note,true);
		$criteria->compare('Location',$this->Location,true);
		$criteria->compare('Picture',$this->Picture,true);
		$criteria->compare('PicturePath',$this->PicturePath,true);
		$criteria->compare('Price',$this->Price,true);
		$criteria->compare('Specification',$this->Specification,true);
		$criteria->compare('Beginyear',$this->Beginyear,true);
		$criteria->compare('Endyear',$this->Endyear,true);
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
		$this->setAttribute('CreateTime',date('Y-m-d H:i:s',$this->getAttribute('CreateTime')));
		$this->setAttribute('UpdateTime',date('Y-m-d H:i:s',$this->getAttribute('UpdateTime')));
		$status = $this->getAttribute('Status');
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
			$keys = array('Name','Ename','ModelName','MainGroupName','GroupName','Oeno','MarkNo','Amount',
				'CreateTime','Status');
			foreach($keys as $key) {
				$fields[$key] = trim($attributeLabels[$key],':');
			}
		}
		return $fields;
	}
}