<?php

/**
 * This is the model class for table "{{menu}}".
 *
 * The followings are the available columns in table '{{menu}}':
 * @property string $ID
 * @property string $RootID
 * @property string $Name
 * @property string $Url
 * @property string $ExtraUrl
 * @property string $Icon
 * @property string $ActiveIcon
 * @property string $MenuIcon
 * @property string $ParentID
 * @property integer $IsShow
 * @property string $Memo
 * @property integer $Sort
 */
class FrontMenu extends JPDActiveRecord {
     public $type;
    /**
     * @return string the associated database table name
     */
    public function tableName() {
        return '{{front_menu}}';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules() {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return array(
            array('IsShow, Sort,IsLeaf,IsLarge,type', 'numerical', 'integerOnly' => true),
            array('RootID', 'length', 'max' => 10),
            array('Name', 'length', 'max' => 100),
            array('Url', 'length', 'max' => 128),
            array('ExtraUrl, Icon, ActiveIcon, MenuIcon', 'length', 'max' => 255),
            array('ParentID,ChildPage,MainMenuID', 'length', 'max' => 45),
            array('Memo', 'safe'),
            // The following rule is used by search().
            // @todo Please remove those attributes that should not be searched.
            array('ID, RootID, Name, Url, ExtraUrl, Icon, ActiveIcon, MenuIcon, ParentID, IsShow,IsLarge,Memo, Sort , MainMenuID,type', 'safe', 'on' => 'search'),
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
            'RootID' => 'Is Root',
            'Name' => '名称',
            'Url' => 'Url',
            'ExtraUrl' => '额外Url',
            'Icon' => '图标',
            'ActiveIcon' => '活动图标',
            'MenuIcon' => '工作站图标',
            'ParentID' => 'Parent',
            'IsShow' => '是否显示',
            'IsLeaf' => '是否为子节点',
            'IsLarge' => '大工作站',
            'ChildPage' => 'Child Page',
            'Memo' => '描述',
            'Sort' => '排序',
            'MainMenuID' => '根节点',
            'type'=>'是否为常用工具'
        );
    }

    public function scopes() {
        return array(
            'sliderbar' => array(
                'select' => 'ID,Name,Url,ExtraUrl,Icon,ActiveIcon,IsLeaf,ParentID,MainMenuID,type',
                'condition' => 'IsShow = 1',
                'order' => 'Sort ASC'
            ),
            'left'=>array(
                 'select' => 'ID,Name,Url,ExtraUrl,Icon,ActiveIcon,IsLeaf,ParentID,MainMenuID,type',
                'condition' => 'IsShow = 1',
                'condition' => 'type =0',
                'order' => 'Sort ASC'
            ),
            'nav'=>array(
                 'select' => 'ID,Name,Url,ExtraUrl,Icon,ActiveIcon,IsLeaf,ParentID,MainMenuID,type',
                'condition' => 'IsShow = 1',
                'order' => 'Sort ASC'
            ),
            'stage' => array(
                'select' => 'ID,Name,Url,ExtraUrl,MenuIcon,ParentID,ChildPage,IsLarge',
                'condition' => 'IsShow = 1',
                'order' => 'IsLarge DESC,Sort asc'
            ),
            'published' => array(
                'select' => 'ID as id,Name as text,IsLeaf as hasChildren',
            ),
        );
    }

    public function parent($parentID) {
        $this->getDbCriteria()->mergeWith(array(
            'condition' => "ParentID = $parentID",
        ));
        return $this;
    }

    /**
     * Retrieves a list of models based on the current search/filter conditions.
     *
     * Typical usecase:
     * - Initialize the model fields with values from filter form.
     * - Execute this method to get CActiveDataProvider instance which will filter
     * models according to data in model fields.
     * - Pass data provider to CGridView, CListView or any similar widget.
     *
     * @return CActiveDataProvider the data provider that can return the models
     * based on the search/filter conditions.
     */
    public function search() {
        // @todo Please modify the following code to remove attributes that should not be searched.

        $criteria = new CDbCriteria;

        $criteria->compare('ID', $this->ID, true);
        $criteria->compare('RootID', $this->RootID, true);
        $criteria->compare('Name', $this->Name, true);
        $criteria->compare('Url', $this->Url, true);
        $criteria->compare('ExtraUrl', $this->ExtraUrl, true);
        $criteria->compare('Icon', $this->Icon, true);
        $criteria->compare('ActiveIcon', $this->ActiveIcon, true);
        $criteria->compare('MenuIcon', $this->MenuIcon, true);
        $criteria->compare('ChildPage', $this->ChildPage, true);
        $criteria->compare('ParentID', $this->ParentID, true);
        $criteria->compare('IsShow', $this->IsShow);
        $criteria->compare('IsLeaf', $this->IsLeaf);
        $criteria->compare('IsLarge', $this->IsLarge);
        $criteria->compare('Memo', $this->Memo, true);
        $criteria->compare('Sort', $this->Sort);
        $criteria->compare('type', $this->type);
        $criteria->compare('MainMenuID', $this->MainMenuID);

        return new CActiveDataProvider($this, array(
                    'criteria' => $criteria,
                ));
    }

    /**
     * Returns the static model of the specified AR class.
     * Please note that you should have this exact method in all your CActiveRecord descendants!
     * @param string $className active record class name.
     * @return MenuNew the static model class
     */
    public static function model($className = __CLASS__) {
        return parent::model($className);
    }

    /**
     * 查询子节点数据
     * @param type $params
     * array(rootID => 上级ID
     *       scope  => 查询范围
     * )
     * @return boolean
     */
    public static function getChild($params) {
        $menuArr = array();
        if ($params["rootID"] && $params["scope"]) {
            //获取菜单模型
            $menuModel = FrontMenu::model();
            $scope = $params["scope"];
            //获取参数
            $model = $menuModel->$scope()->parent($params["rootID"])->findAll();
            //获取查询范围
            $scopes = $menuModel->scopes();
            $columns = explode(",", $scopes[$scope]["select"]);
            //赋值
            foreach ($model as $key => $m) {
                if (isset($params["role"]) && !in_array($m->ID, explode(',', $params["role"])) && $m->Name != "工作台") {
                    continue;
                }
                //工作台菜单如果没有菜单图标则表示不显示
                if ($scope == "stage" && !$m->MenuIcon) {
                    continue;
                }
                foreach ($columns as $column) {
                    $menuArr[$key][lcfirst($column)] = $m->$column;
                }
                //获取子菜单
                if ($scope == "sliderbar" || $scope=='nav' ) {
                    $pamArr = array(
                        "rootID" => $m->ID,
                        "scope" => $scope,
                    );
                    if (isset($params["role"])){
                        $pamArr["role"] = $params["role"];
                    }
                    $menuArr[$key]["children"] = FrontMenu::getChild($pamArr);
                }
            }
        }
        return $menuArr;
    }

    /**
     * 查询子节点数据，和getchild功能一致，加了缓存层（缓存根基点下的所有菜单）
     * @param type $params
     * array(rootID => 上级ID
     *       scope  => 查询范围
     * )
     * @return boolean
     */
    public static function getChildMenu($params) {
        //判断是否为员工帐号
        $emoloyeID = Yii::app()->user->getEmployeID();
        if ($emoloyeID) {
           //获取员工权限ID
         $jurisdiction=self::getjuri($emoloyeID);
         $params["role"]= $jurisdiction;
            //获取员工权限ID
//            $roleModel = JpdOrganRoleEmployees::model()->findByAttributes(array("EmployeeID" => $emoloyeID), 'Status=0'  );
//            $model = JpdOrganRoles::model()->findByPk($roleModel->RoleID,'Status=0');
//            $params["role"] = $model->Jurisdiction;
        }
        if ($params["role"]) {
            return $value = self::getChild($params);
        }
//        $key = "menu_" . $params["scope"] . "_" . $params["rootID"];
//       $value = Yii::app()->cache->get($key);
//       if ($value) {
//            return $value;
//        } else {
            $value = self::getChild($params);
//            Yii::app()->cache->set($key, $value);
            return $value;
     //  }
    }

    /**
     * 根据当前url查询menuID
     * @param type $params
     * @return boolean
     */
    public static function getMenuIDByRoute($route,$rootID) {
        $criteria = new CDbCriteria;
        $criteria->addCondition("(Url ='{$route}' Or ExtraUrl like '%{$route}%') and RootID=$rootID");
        return FrontMenu::model()->find($criteria);
    }
    /**
     * 子帐户权限
     * 
     */
    protected static function getjuri($emoloyeID){
        $roles = Yii::app()->jpdb->createCommand()
                ->select('RoleID')
                ->from('jpd_organ_role_employees')
                ->where('EmployeeID=:employeeid and Status=0', array(':employeeid' => $emoloyeID))
                ->queryAll();
        if (empty($roles)) {
            return false;
        }
        foreach ($roles as $val) {
            $role[] = $val['RoleID'];
        }
            $rolemenus = Yii::app()->jpdb->createCommand()
                ->select('Jurisdiction')
                ->from('jpd_organ_roles')
                ->where(array('in', 'ID', $role))
                ->queryAll();

        if (empty($rolemenus)) {
            return false;
        }
        $jurisdiction = '';
        foreach ($rolemenus as $val) {
            $jurisdiction.=$val['Jurisdiction'].',';
        }
        return $jurisdiction;
    }

}
