<?php

/**
 * This is the model class for table "area".
 *
 * The followings are the available columns in table 'area':
 * @property string $id
 * @property string $language
 * @property string $parent_id
 * @property string $path
 * @property integer $grade
 * @property string $name
 */
class Area extends JPDActiveRecord {

    /**
     * Returns the static model of the specified AR class.
     * @param string $className active record class name.
     * @return Area the static model class
     */
    public static function model($className = __CLASS__) {
        return parent::model($className);
    }

    /**
     * @return string the associated database table name
     */
    public function tableName() {
        return '{{area}}';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules() {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return array(
            array('Name', 'required'),
            array('Grade', 'numerical', 'integerOnly' => true),
            array('Language', 'length', 'max' => 20),
            array('ParentID', 'length', 'max' => 10),
            array('Path', 'length', 'max' => 255),
            array('Name', 'length', 'max' => 50),
            // The following rule is used by search().
            // Please remove those attributes that should not be searched.
            array('ID, Language, ParentID, Path, Grade, Name', 'safe', 'on' => 'search'),
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
            'Language' => '语言',
            'ParentID' => '上级',
            'Path' => '路径',
            'Grade' => '等级',
            'Name' => '地名',
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

        $criteria->compare('ID', $this->id, true);
        $criteria->compare('Language', $this->language, true);
        $criteria->compare('ParentID', $this->parent_id, true);
        $criteria->compare('Path', $this->path, true);
        $criteria->compare('Grade', $this->grade);
        $criteria->compare('Name', $this->name, true);

        return new CActiveDataProvider($this, array(
            'criteria' => $criteria,
        ));
    }

    public static function showCity($id) {
        $model = self::model()->find("ID=:id", array(":id" => $id));
        echo $model->Name;
    }

    public static function getCity($id) {
        $model = self::model()->find("ID=:id", array(":id" => $id));
        return $model->Name;
    }

    public static function getParent_id($id) {
        $model = self::model()->find("ID=:id", array(":id" => $id));
        return $model->ParentID;
    }

    public static function getCode($name, $grade = 0) {
        if ($grade == 0) {
            $model = Area::model()->find(array('select' => 'ID', 'condition' => 'Name LIKE :name', 'params' => array(':name' => "%$name%")));
        } else {
            $model = Area::model()->find(array('select' => 'ID', 'condition' => 'name Name :name and Grade=:grade', 'params' => array(':name' => "%$name%", ':grade' => $grade)));
        }
        return $model->ID;
    }

    //根据id查询地址
    public static function getaddress($province = NULL, $city = NULL, $area = NULL) {
        $address = null;
        if ($province) {
            $provinceinfo = Area::model()->findByPk($province);
            if ($provinceinfo) {
                $address.=$provinceinfo['Name'];
                if ($city) {
                    $cityinfo = Area::model()->findByPk($city);
                    if ($cityinfo) {
                        $address.=$cityinfo['Name'];
                        if ($area) {
                            $areainfo = Area::model()->findByPk($area);
                            $address.=$areainfo['Name'];
                        }
                    }
                }
            }
        }
        return $address;
    }
    
    //根据id获取数据
    public static function getdatabyid($id){
        if(!is_numeric($id))
            return;
        $sql='select `Name` from jpd_area where ID='.$id;
        $res=Yii::app()->jpdb->createCommand($sql)->queryRow();
        return $res['Name'];
    }

}
