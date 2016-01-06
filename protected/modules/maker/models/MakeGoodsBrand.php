<?php

/**
 * This is the model class for table "{{make_goods_brand}}".
 *
 * The followings are the available columns in table '{{make_goods_brand}}':
 * @property integer $BrandID
 * @property string $BrandName
 * @property string $Pinyin
 * @property string $Remarks
 * @property integer $OrganID
 * @property integer $UserID
 * @property integer $CreateTime
 * @property integer $UpdateTime
 */
class MakeGoodsBrand extends CActiveRecord {

    /**
     * Returns the static model of the specified AR class.
     * @param string $className active record class name.
     * @return MakeGoodsBrand the static model class
     */
    public static function model($className = __CLASS__) {
        return parent::model($className);
    }

    /**
     * @return string the associated database table name
     */
    public function tableName() {
        return '{{make_goods_brand}}';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules() {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return array(
            array('BrandName, OrganID, UserID, CreateTime', 'required'),
            array('OrganID, UserID, CreateTime, UpdateTime', 'numerical', 'integerOnly' => true),
            array('BrandName, Pinyin', 'length', 'max' => 64),
            array('Remarks', 'length', 'max' => 255),
            // The following rule is used by search().
            // Please remove those attributes that should not be searched.
            array('BrandID, BrandName, Pinyin, Remarks, OrganID, UserID, CreateTime, UpdateTime', 'safe', 'on' => 'search'),
        );
    }

    /**
     * @return array relational rules.
     */
    public function relations() {
        // NOTE: you may need to adjust the relation name and the related
        // class name for the relations automatically generated below.
        return array(
        );
    }

    /**
     * @return array customized attribute labels (name=>label)
     */
    public function attributeLabels() {
        return array(
            'BrandID' => 'Brand',
            'BrandName' => 'Brand Name',
            'Pinyin' => 'Pinyin',
            'Remarks' => 'Remarks',
            'OrganID' => 'Organ',
            'UserID' => 'User',
            'CreateTime' => 'Create Time',
            'UpdateTime' => 'Update Time',
        );
    }

    /**
     * Retrieves a list of models based on the current search/filter conditions.
     * @return CActiveDataProvider the data provider that can return the models based on the search/filter conditions.
     */
    public function search() {
        // Warning: Please modify the following code to remove attributes that
        // should not be searched.

        $criteria = new CDbCriteria;

        $criteria->compare('BrandID', $this->BrandID);
        $criteria->compare('BrandName', $this->BrandName, true);
        $criteria->compare('Pinyin', $this->Pinyin, true);
        $criteria->compare('Remarks', $this->Remarks, true);
        $criteria->compare('OrganID', $this->OrganID);
        $criteria->compare('UserID', $this->UserID);
        $criteria->compare('CreateTime', $this->CreateTime);
        $criteria->compare('UpdateTime', $this->UpdateTime);

        return new CActiveDataProvider($this, array(
                    'criteria' => $criteria,
                ));
    }

    /*
     * 取出某生产商所有品牌
     * 返回字符串：品牌1,品牌2,品牌3........
     */

    public static function getBrands($organID) {
        $models = self::model()->findAll("OrganID=:OrganID", array(":OrganID" => $organID));
        if (!empty($models)) {
            foreach ($models as $key => $val) {
                $brands.=$val->BrandName . ',';
            }
            $brands = substr($brands, 0, -1);
        }
        $brands = $brands ? $brands : '';
        return $brands;
    }

}