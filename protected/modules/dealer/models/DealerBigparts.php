<?php

/**
 * This is the model class for table "{{dealer_bigparts}}".
 *
 * The followings are the available columns in table '{{dealer_bigparts}}':
 * @property integer $ID
 * @property string $BigParts
 * @property integer $BigCode
 */
class DealerBigparts extends CActiveRecord {

    /**
     * Returns the static model of the specified AR class.
     * @param string $className active record class name.
     * @return DealerBigparts the static model class
     */
    public static function model($className = __CLASS__) {
        return parent::model($className);
    }

    /**
     * @return string the associated database table name
     */
    public function tableName() {
        return '{{dealer_bigparts}}';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules() {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return array(
            array('BigCode', 'numerical', 'integerOnly' => true),
            array('BigParts', 'length', 'max' => 64),
            // The following rule is used by search().
            // Please remove those attributes that should not be searched.
            array('ID, BigParts, BigCode', 'safe', 'on' => 'search'),
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
            'BigParts' => 'Big Parts',
            'BigCode' => 'Big Code',
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
        $criteria->compare('BigParts', $this->BigParts, true);
        $criteria->compare('BigCode', $this->BigCode);

        return new CActiveDataProvider($this, array(
                    'criteria' => $criteria,
                ));
    }

    public static function getBigPartsName($id) {
        if (empty($id)) {
            return ' ';
        } else {
            $bigparts = DealerBigparts::model()->find('ID= ' . $id);
            return $bigparts['BigParts'];
        }
    }
    
    /**
     * 获取配件大类的ID
     */
    public static function getBigpartsID($bigparts){
        $bigpartsID = DealerBigparts::model()->find("BigParts like '%{$bigparts}%'");
        return $bigpartsID['BigCode'];
    }
    

}