<?php

/**
 * This is the model class for table "{{goods_version}}".
 *
 * The followings are the available columns in table '{{goods_version}}':
 * @property integer $id
 * @property string $version_name
 * @property integer $modify_time
 * @property string $name
 * @property string $picture
 * @property integer $manufacturer_id
 * @property integer $goods_id
 * @property string $goodsno
 * @property string $cpname
 * @property string $model_id
 * @property string $car_id
 * @property integer $templet_id
 * @property integer $values_id
 * @property string $isUse
 * @property string $file
 * @property string $price
 * @property string $priceA
 * @property string $quotedprice
 * @property string $priceB
 * @property string $priceC
 * @property string $inventory
 * @property string $parts_level
 * @property string $senddays
 * @property string $description
 */
class GoodsVersion extends CActiveRecord {

    /**
     * Returns the static model of the specified AR class.
     * @return GoodsVersion the static model class
     */
    public static function model($className = __CLASS__) {
        return parent::model($className);
    }

    public function getDbConnection() {
        return Yii::app()->papdb;
    }

    /**
     * @return string the associated database table name
     */
    public function tableName() {
        return '{{goods_version}}';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules() {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return array(
            array('version_name, goods_id', 'required'),
            array('modify_time, manufacturer_id, goods_id, templet_id, values_id', 'numerical', 'integerOnly' => true),
            array('version_name, name, picture, goodsno, cpname, model_id, car_id, file', 'length', 'max' => 20),
            array('isUse, description', 'length', 'max' => 255),
            array('price, priceA, quotedprice, priceB, priceC', 'length', 'max' => 7),
            array('inventory, parts_level, senddays', 'length', 'max' => 10),
            // The following rule is used by search().
            // Please remove those attributes that should not be searched.
            array('id, version_name, modify_time, name, picture, manufacturer_id, goods_id, goodsno, cpname, model_id, car_id, templet_id, values_id, isUse, file, price, priceA, quotedprice, priceB, priceC, inventory, parts_level, senddays, description', 'safe', 'on' => 'search'),
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
            'id' => 'ID',
            'version_name' => 'Version Name',
            'modify_time' => 'Modify Time',
            'name' => 'Name',
            'picture' => 'Picture',
            'manufacturer_id' => 'Manufacturer',
            'goods_id' => 'Goods',
            'goodsno' => 'Goodsno',
            'cpname' => 'Cpname',
            'model_id' => 'Model',
            'car_id' => 'Car',
            'templet_id' => 'Templet',
            'values_id' => 'Values',
            'isUse' => 'Is Use',
            'file' => 'File',
            'price' => 'Price',
            'priceA' => 'Price A',
            'quotedprice' => 'Quotedprice',
            'priceB' => 'Price B',
            'priceC' => 'Price C',
            'inventory' => 'Inventory',
            'parts_level' => 'Parts Level',
            'senddays' => 'Senddays',
            'description' => 'Description',
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

        $criteria->compare('id', $this->id);
        $criteria->compare('version_name', $this->version_name, true);
        $criteria->compare('modify_time', $this->modify_time);
        $criteria->compare('name', $this->name, true);
        $criteria->compare('picture', $this->picture, true);
        $criteria->compare('manufacturer_id', $this->manufacturer_id);
        $criteria->compare('goods_id', $this->goods_id);
        $criteria->compare('goodsno', $this->goodsno, true);
        $criteria->compare('cpname', $this->cpname, true);
        $criteria->compare('model_id', $this->model_id, true);
        $criteria->compare('car_id', $this->car_id, true);
        $criteria->compare('templet_id', $this->templet_id);
        $criteria->compare('values_id', $this->values_id);
        $criteria->compare('isUse', $this->isUse, true);
        $criteria->compare('file', $this->file, true);
        $criteria->compare('price', $this->price, true);
        $criteria->compare('priceA', $this->priceA, true);
        $criteria->compare('quotedprice', $this->quotedprice, true);
        $criteria->compare('priceB', $this->priceB, true);
        $criteria->compare('priceC', $this->priceC, true);
        $criteria->compare('inventory', $this->inventory, true);
        $criteria->compare('parts_level', $this->parts_level, true);
        $criteria->compare('senddays', $this->senddays, true);
        $criteria->compare('description', $this->description, true);

        return new CActiveDataProvider(get_class($this), array(
                    'criteria' => $criteria,
                ));
    }

}