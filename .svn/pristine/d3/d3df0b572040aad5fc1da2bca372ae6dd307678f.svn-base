<?php

/**
 * This is the model class for table "{{article}}".
 *
 * The followings are the available columns in table '{{article}}':
 * @property integer $article_id
 * @property integer $category_id
 * @property integer $author_id
 * @property string $title
 * @property string $from
 * @property string $content
 * @property integer $views
 * @property integer $create_time
 * @property integer $update_time
 */
class CmsArticle extends JPDActiveRecord {

    /**
     * Returns the static model of the specified AR class.
     * @return Article the static model class
     */
    public static function model($className = __CLASS__) {
        return parent::model($className);
    }

    /**
     * @return string the associated database table name
     */
    public function tableName() {
        return '{{cms_article}}';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules() {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return array(
            array('CategoryID, Summary, Title, Content, Language', 'required'),
            array('CategoryID, Views', 'numerical', 'integerOnly' => true),
            array('Title', 'length', 'max' => 250),
            array('From', 'length', 'max' => 200),
            array('Url', 'url'),
            array('Language', 'safe'),
            // The following rule is used by search().
            // Please remove those attributes that should not be searched.
            array('ArticleID, CategoryID, AuthorID, Title, From, Content, Views, CreateTime, UpdateTime', 'safe', 'on' => 'search'),
        );
    }

    /**
     * @return array relational rules.
     */
    public function relations() {
        // NOTE: you may need to adjust the relation name and the related
        // class name for the relations automatically generated below.
        return array(
            'author' => array(self::BELONGS_TO, 'AdminUser', 'AuthorID'),
            'cmscategory' => array(self::BELONGS_TO, 'CmsCategory', 'CategoryID'),
//            'comments' => array(self::HAS_MANY, 'Comment', 'article_id', 'condition' => 'comments.status=' . Comment::STATUS_APPROVED, 'order' => 'comments.create_time DESC'),
//            'commentCount' => array(self::STAT, 'Comment', 'article_id', 'condition' => 'status=' . Comment::STATUS_APPROVED),
        );
    }

    /**
     * @return array customized attribute labels (name=>label)
     */
    public function attributeLabels() {
        return array(
            'ArticleID' => 'Article',
            'CategoryID' => '分类',
            'AuthorID' => '作者',
            'Title' => '标题',
            'Language' => '语言',
            'From' => '来源',
            'Summary' => '摘要',
            'Content' => '内容',
            'Views' => '热度',
            'CreateTime' => '发布时间',
            'UpdateTime' => '更新时间',
            'cmscategory.Name' => '分类',
            'author.UserName' => '作者',
            'Url' => '链接'
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

        $criteria->order = 'ArticleID desc';
        $criteria->compare('ArticleID', $this->ArticleID);
        $criteria->compare('CategoryID', $this->CategoryID);
        $criteria->compare('AuthorID', $this->AuthorID);
        $criteria->compare('Title', $this->Title, true);
        $criteria->compare('From', $this->From, true);
        $criteria->compare('Content', $this->Content, true);
        $criteria->compare('Views', $this->Views);
        $criteria->compare('CreateTime', $this->CreateTime);
        $criteria->compare('UpdateTime', $this->UpdateTime);

        return new CActiveDataProvider($this, array(
            'criteria' => $criteria,
        ));
    }

    public function beforeSave() {
        if (parent::beforeSave()) {
            if ($this->isNewRecord) {
                $this->CreateTime = $this->UpdateTime = time();
                $this->AuthorID = Yii::app()->user->id;
            }
            else
                $this->UpdateTime = time();
            return true;
        }
        else
            return false;
    }

    public function behaviors() {
        return array(
//             array(
//                 'class' => 'ext.seo.behaviors.SeoActiveRecordBehavior',
//                 'route' => 'article/view',
//                 'params' => array('id' => $this->article_id, 'title' => $this->title),
//             ),
        );
    }

//        public function afterFind() {
//           $retVal = parent::afterSave();
//                $this->create_time=date('m/d/Y', $this->create_time); 
//                if(!is_null($this->update_time)) {
//                        $this->update_time=date('m/d/Y', $this->update_time); 
//                } //EndIf
////                $this->author_id = $this->author->username;
////                $this->category_id = $this->cate->name;
//                return $retVal;
//        }

    /**
     * Adds a new comment to this post.
     * This method will set status and post_id of the comment accordingly.
     * @param Comment the comment to be added
     * @return boolean whether the comment is saved successfully
     */
//    public function addComment($comment) {
//        if (Yii::app()->params['commentNeedApproval'])
//            $comment->status = Comment::STATUS_PENDING;
//        else
//            $comment->status = Comment::STATUS_APPROVED;
//        $comment->article_id = $this->id;
//        return $comment->save();
//    }

    public function getUrl() {
        if (F::utf8_str($this->Title) == '1') {
            $title = str_replace('/', '-', $this->Title);
        } else {
            $pinyin = new Pinyin($this->Title);
            $title = $pinyin->full2();
            $title = str_replace('/', '-', $title);
        }

        return Yii::app()->createUrl('article/view', array(
                    'id' => $this->ArticleID,
                    'title' => $title,
        ));
    }

}