<?php

/**
 * This is the model class for table "{{dealer_goods_oeno_relation}}".
 *
 * The followings are the available columns in table '{{dealer_goods_oeno_relation}}':
 * @property integer $ID
 * @property integer $OrganID
 * @property integer $GoodsID
 * @property string $OENO
 * @property integer $CreateTime
 */
class DealerGoodsOenoRelation extends CActiveRecord {

    /**
     * Returns the static model of the specified AR class.
     * @param string $className active record class name.
     * @return DealerGoodsOenoRelation the static model class
     */
    public static function model($className = __CLASS__) {
        return parent::model($className);
    }

    /**
     * @return string the associated database table name
     */
    public function tableName() {
        return '{{dealer_goods_oeno_relation}}';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules() {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return array(
            array('OrganID, GoodsID, CreateTime', 'numerical', 'integerOnly' => true),
            array('OENO', 'length', 'max' => 48),
            // The following rule is used by search().
            // Please remove those attributes that should not be searched.
            array('ID, OrganID, GoodsID, OENO, CreateTime', 'safe', 'on' => 'search'),
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
            'ID' => 'ID',
            'OrganID' => 'Organ',
            'GoodsID' => 'Goods',
            'OENO' => 'Oeno',
            'CreateTime' => 'Create Time',
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
        $criteria->compare('OrganID', $this->OrganID);
        $criteria->compare('GoodsID', $this->GoodsID);
        $criteria->compare('OENO', $this->OENO, true);
        $criteria->compare('CreateTime', $this->CreateTime);

        return new CActiveDataProvider($this, array(
                    'criteria' => $criteria,
                ));
    }

    /**
     * 获取OE号
     */
    public static function getOENOSByGoodsID($goodsID) {
        $goodsOES = DealerGoodsOenoRelation::findAll("GoodsID=$goodsID");
        $data = array();
        foreach ($goodsOES as $key => $value) {
            $data[$key]['ID'] = $value['ID'];
            $data[$key]['OENO'] = $value['OENO'];
        }
        return $data;
    }

}