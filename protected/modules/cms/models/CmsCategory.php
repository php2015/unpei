<?php

/**
 * This is the model class for table "category".
 *
 * The followings are the available columns in table 'category':
 * @property string $id
 * @property string $root
 * @property string $lft
 * @property string $rgt
 * @property integer $level
 * @property string $name
 * @property string $url
 * @property string $pic
 * @property string $position
 * @property integer $if_show
 * @property string $memo
 */
class CmsCategory extends JPDActiveRecord {

    /**
     * Returns the static model of the specified AR class.
     * @param string $className active record class name.
     * @return Category the static model class
     */
    public static function model($className = __CLASS__) {
        return parent::model($className);
    }

    /**
     * @return string the associated database table name
     */
    public function tableName() {
        return '{{cms_category}}';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules() {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return array(
            array('Name', 'required'),
            array('Label, Level, IsShow', 'numerical', 'integerOnly' => true),
            array('Root, Lft, Rgt', 'length', 'max' => 10),
            array('Name', 'length', 'max' => 100),
            array('Url', 'length', 'max' => 255),
            array('Pic', 'file',
                'types' => 'jpg, gif, png',
                'maxSize' => 1024 * 1024 * 2, // 2MB
                'tooLarge' => '文件超过 2MB. 请上传小一点儿的文件.',
                'allowEmpty' => true,
                'on' => 'create'
            ),
            array('Pic', 'file',
                'types' => 'jpg, gif, png',
                'maxSize' => 1024 * 1024 * 2, // 2MB
                'tooLarge' => '文件超过 2MB. 请上传小一点儿的文件.',
                'allowEmpty' => true,
                'on' => 'update'
            ),
            array('Position', 'length', 'max' => 45),
            array('Memo', 'safe'),
            // The following rule is used by search().
            // Please remove those attributes that should not be searched.
            array('ID, Root, Lft, Rgt, Level, Name, Url, Pic, Position, IsSshow, Memo', 'safe', 'on' => 'search'),
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
            'Root' => 'Root',
            'Lft' => 'Lft',
            'Rgt' => 'Rgt',
            'Level' => 'Level',
            'Name' => '名称',
            'Label' => '标签',
            'Url' => 'Url',
            'Pic' => '图片',
            'Position' => '位置',
            'IsShow' => '是否显示',
            'Memo' => '备注',
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

        $criteria->compare('ID', $this->ID, true);
        $criteria->compare('Root', $this->Root, true);
        $criteria->compare('Lft', $this->Lft, true);
        $criteria->compare('Rgt', $this->rgt, true);
        $criteria->compare('Level', $this->level);
        $criteria->compare('Name', $this->name, true);
        $criteria->compare('Url', $this->url, true);
        $criteria->compare('Pic', $this->pic, true);
        $criteria->compare('Position', $this->position, true);
        $criteria->compare('IsShow', $this->if_show);
        $criteria->compare('Memo', $this->memo, true);

        return new CActiveDataProvider($this, array(
            'criteria' => $criteria,
        ));
    }

    public function behaviors() {
        return array(
            'NestedSetBehavior' => array(
                'class' => 'ext.nested-set-behavior.NestedSetBehavior',
                'leftAttribute' => 'Lft',
                'rightAttribute' => 'Rgt',
                'levelAttribute' => 'Level',
                'hasManyRoots' => true,
        ));
    }
    
    public function getThumb() {
        $img_url = '/../../upload/category/' . $this->Pic;
        $trueimage = Yii::app()->request->hostInfo.Yii::app()->baseUrl.$img_url;
        if (F::isfile($trueimage)) {
        $img_thumb = Yii::app()->request->baseUrl . ImageHelper::thumb(750, 368, $img_url, array('method' => 'resize'));
        $img_thumb_now = CHtml::image($img_thumb, $this->Name);
        return CHtml::link($img_thumb_now, $this->Url, array('title' => $this->Name));
        }else{
            return '没有图片';
        }
    }
    
    public function getLabel() {
        if($this->label == '1'){
            echo '<span class="label label-info" style="margin-right:5px">New</span>';
        }elseif($this->label == '2') {
            echo '<span class="label label-important" style="margin-right:5px">Hot!</span>';
        }
    }
    
    public function getChildCount() {
        $category = Category::model()->findByPk($this->ID);
        $descendants = $category->children()->findAll();
        return count($descendants);
    }
    
    public function getDescendantsId() {
        $category = Category::model()->findByPk($this->ID);
        $descendants = $category->descendants()->findAll();
        foreach($descendants as $descendant){
            $ids[] = $descendant->id;
        }
        $cid = $ids ?  implode(',', $ids) : NULL;
        return $cid;
    }

}