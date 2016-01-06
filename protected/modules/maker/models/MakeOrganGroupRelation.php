<?php

/**
 * This is the model class for table "{{make_organ_group_relation}}".
 *
 * The followings are the available columns in table '{{make_organ_group_relation}}':
 * @property integer $id
 * @property integer $userID
 * @property string $father_code
 * @property string $children_code
 */
class MakeOrganGroupRelation extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return MakeOrganGroupRelation the static model class
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
		return '{{make_organ_group_relation}}';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('userID', 'required'),
			array('userID', 'numerical', 'integerOnly'=>true),
			array('father_code, children_code', 'length', 'max'=>64),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, userID, father_code, children_code', 'safe', 'on'=>'search'),
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
			'userID' => 'User',
			'father_code' => 'Father Code',
			'children_code' => 'Children Code',
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
		$criteria->compare('userID',$this->userID);
		$criteria->compare('father_code',$this->father_code,true);
		$criteria->compare('children_code',$this->children_code,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
	/**
	 * 根据用户ID取出所有主营品类
	 * Enter description here ...
	 * @param unknown_type $userID
	 */
	public static function getGroAll($userID){
		$models=self::model()->findAll("userID=:userID",array(":userID"=>$userID));
		$i=1;
		$groups="";
		foreach ($models as $key=>$value){
			if ($i==1){
				$groups=$value->children_code;
			}else {
				$groups.=','.$value->children_code;
			}
			$i++;
		}
		return $groups;
	} 
}