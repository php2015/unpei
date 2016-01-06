<?php

/**
 * This is the model class for table "{{dealer_cpname}}".
 *
 * The followings are the available columns in table '{{dealer_cpname}}':
 * @property integer $ID
 * @property string $CpName
 * @property integer $SubCode
 */
class DealerCpname extends CActiveRecord {

    /**
     * Returns the static model of the specified AR class.
     * @param string $className active record class name.
     * @return DealerCpname the static model class
     */
    public static function model($className = __CLASS__) {
        return parent::model($className);
    }

    /**
     * @return string the associated database table name
     */
    public function tableName() {
        return '{{dealer_cpname}}';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules() {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return array(
            array('SubCode', 'numerical', 'integerOnly' => true),
            array('CpName', 'length', 'max' => 64),
            // The following rule is used by search().
            // Please remove those attributes that should not be searched.
            array('ID, CpName, SubCode', 'safe', 'on' => 'search'),
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
            'CpName' => 'Cp Name',
            'SubCode' => 'Sub Code',
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
        $criteria->compare('CpName', $this->CpName, true);
        $criteria->compare('SubCode', $this->SubCode);

        return new CActiveDataProvider($this, array(
                    'criteria' => $criteria,
                ));
    }

    public static function getCpName($id) {
        if (empty($id)) {
            
        } else {
            $bigparts = DealerCpname::model()->find('ID=' . $id);
            return $bigparts['CpName'];
        }
    }
     /**
     * 获取配件大类的ID
     */
    public static function getCpNameID($cpname){
        $cpnameID = DealerCpname::model()->find("CpName like '%{$cpname}%'");
        return $cpnameID['ID'];
    }

}