<?php

/**
 * This is the model class for table "{{goods}}".
 *
 * The followings are the available columns in table '{{goods}}':
 * @property integer $ID
 * @property string $Name
 * @property string $Pinyin
 * @property integer $BrandID
 * @property string $GoodsNO
 * @property string $Price
 * @property string $ProPrice
 * @property string $PartsLevel
 * @property string $StandCode
 * @property string $Memo
 * @property integer $IsPro
 * @property integer $IsSale
 * @property integer $ISdelete
 * @property integer $OrganID
 * @property integer $CreateTime
 * @property integer $UpdateTime
 * @property integer $ProTime
 * @property string $Title
 * @property integer $Sales
 * @property string $Provenance
 * @property string $Info
 * @property integer $CommentNo
 */
class PapGoods extends JPDActiveRecord {

    /**
     * Returns the static model of the specified AR class.
     * @param string $className active record class name.
     * @return PapGoods the static model class
     */
    public static function model($className = __CLASS__) {
        return parent::model($className);
    }

    /**
     * @return CDbConnection database connection
     */
    public function getDbConnection() {
        return Yii::app()->papdb;
    }

    /**
     * @return string the associated database table name
     */
    public function tableName() {
        return '{{goods}}';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules() {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return array(
            array('Name, GoodsNO, Price, OrganID', 'required'),
            array('BrandID, IsPro, IsSale, ISdelete, OrganID, CreateTime, UpdateTime, ProTime, Sales, CommentNo', 'numerical', 'integerOnly' => true),
            array('Name, Pinyin, GoodsNO , StandCode', 'length', 'max' => 64),
            array('ProPrice', 'length', 'max' => 9),
            array('Price', 'length', 'max' => 10),
            array('PartsLevel', 'length', 'max' => 24),
            array('Title', 'length', 'max' => 200),
            array('Provenance', 'length', 'max' => 50),
            array('Version,VehVersion', 'length', 'max' => 13),
            array('Memo, Info', 'safe'),
            // The following rule is used by search().
            // Please remove those attributes that should not be searched.
            array('ID, Name, Pinyin, BrandID, GoodsNO, Price, ProPrice, PartsLevel, StandCode, Memo, IsPro, IsSale, ISdelete, OrganID, CreateTime, UpdateTime, ProTime, Title, Sales, Provenance, Info, CommentNo', 'safe', 'on' => 'search'),
        );
    }

    /**
     * @return array relational rules.
     */
    public function relations() {
        // NOTE: you may need to adjust the relation name and the related
        // class name for the relations automatically generated below.
        return array(
            'PapJpbrand' => array(self::HAS_ONE, 'PapJpbrand', '', 'on' => 'PapJpbrand.ID=t.BrandID'),
//            'brand' => array(self::HAS_ONE, 'Brand', '', 'on' => 'brand.ID=t.BrandID'),
            'goodoe' => array(self::HAS_MANY, 'PapGoodsOeRelation', 'GoodsID'),
            //一对多 副表GoodsOeRelation的GoodsID等于主表PapGoods的主键（ID）
            'img' => array(self::HAS_MANY, 'PapGoodsImageRelation', 'GoodsID'),
            'vehicle' => array(self::HAS_MANY, 'PapGoodsVehicleRelation', 'GoodsID'),
            'spec' => array(self::HAS_ONE, 'PapGoodsSpec', 'GoodsID'),
            'pack' => array(self::HAS_ONE, 'PapGoodsPack', 'GoodsID'),
        );
    }

    /**
     * @return array customized attribute labels (name=>label)
     */
    public function attributeLabels() {
        return array(
            'ID' => 'ID',
            'Name' => '商品名称',
            'Pinyin' => '拼音代码',
            'BrandID' => '品牌ID',
            'GoodsNO' => '商品编号',
            'Price' => '商品价格',
            'ProPrice' => '促销价格',
            'PartsLevel' => '商品档次',
            'StandCode' => '标准名称',
            'Memo' => '特征说明',
            'IsPro' => 'Is Pro',
            'IsSale' => 'Is Sale',
            'ISdelete' => 'Isdelete',
            'OrganID' => 'Organ',
            'CreateTime' => 'Create Time',
            'UpdateTime' => 'Update Time',
            'ProTime' => 'Pro Time',
            'Title' => '关键字',
            'Sales' => 'Sales',
            'Provenance' => '原产地',
            'Info' => '详细说明',
            'CommentNo' => 'Comment No',
            'Version' => 'Version',
            'VehVersion' => 'Veh Version',
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

        $criteria->compare('ID', $this->ID);
        $criteria->compare('Name', $this->Name, true);
        $criteria->compare('Pinyin', $this->Pinyin, true);
        $criteria->compare('BrandID', $this->BrandID);
        $criteria->compare('GoodsNO', $this->GoodsNO, true);
        $criteria->compare('Price', $this->Price, true);
        $criteria->compare('ProPrice', $this->ProPrice, true);
        $criteria->compare('PartsLevel', $this->PartsLevel, true);
        $criteria->compare('StandCode', $this->StandCode, true);
        $criteria->compare('Memo', $this->Memo, true);
        $criteria->compare('IsPro', $this->IsPro);
        $criteria->compare('IsSale', $this->IsSale);
        $criteria->compare('ISdelete', $this->ISdelete);
        $criteria->compare('OrganID', $this->OrganID);
        $criteria->compare('CreateTime', $this->CreateTime);
        $criteria->compare('UpdateTime', $this->UpdateTime);
        $criteria->compare('ProTime', $this->ProTime);
        $criteria->compare('Title', $this->Title, true);
        $criteria->compare('Sales', $this->Sales);
        $criteria->compare('Provenance', $this->Provenance, true);
        $criteria->compare('Info', $this->Info, true);
        $criteria->compare('CommentNo', $this->CommentNo);
        $criteria->compare('Version', $this->Version);
        $criteria->compare('VehVersion', $this->VehVersion);

        return new CActiveDataProvider($this, array(
            'criteria' => $criteria,
        ));
    }

    /**
     * 获取OE号
     */
    public static function getOENOSByGoodsID($goodsID) {
        $goodsOES = PapGoodsOeRelation::model()->findAll("GoodsID=$goodsID");
        $data = array();
        $OENOS = '';
        foreach ($goodsOES as $key => $value) {
            $data[$key]['ID'] = $value['ID'];
            $data[$key]['OENO'] = $value['OENO'];
            if ($key == 0)
                $OENOS .= $value['OENO'];
            else
                $OENOS .= '、' . $value['OENO'];
        }
        // return $data;
        return $OENOS;
    }

}
