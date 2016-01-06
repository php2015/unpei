<?php

/**
 * This is the model class for table "{{dealer_goods}}".
 *
 * The followings are the available columns in table '{{dealer_goods}}':
 * @property integer $ID
 * @property string $Name
 * @property string $Pinyin
 * @property integer $BrandID
 * @property string $Brand
 * @property string $GoodsNO
 * @property string $OENO
 * @property string $Price
 * @property string $ProPrice
 * @property string $PartsLevel
 * @property string $LogisticsPrice
 * @property string $BigParts
 * @property string $SubParts
 * @property string $CpName
 * @property string $CpNameTxt
 * @property string $Memo
 * @property integer $IsPro
 * @property integer $IsSale
 * @property integer $ISdelete
 * @property integer $OrganID
 * @property integer $UserID
 * @property integer $CreateTime
 * @property integer $UpdateTime
 * @property integer $ProTime
 * @property string $Title
 * @property integer $Sales
 */
class DealerGoods extends DSPActiveRecord {

    /**
     * Returns the static model of the specified AR class.
     * @param string $className active record class name.
     * @return DealerGoods the static model class
     */
    public static function model($className = __CLASS__) {
        return parent::model($className);
    }

    /**
     * @return string the associated database table name
     */
    public function tableName() {
        return '{{dealer_goods}}';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules() {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return array(
            array('Name, GoodsNO, Price, OrganID, UserID', 'required'),
            array('BrandID, IsPro, IsSale, ISdelete, OrganID, UserID, CreateTime, UpdateTime, ProTime, Sales', 'numerical', 'integerOnly' => true),
            array('Name, Pinyin, Brand, GoodsNO, OENO, CpNameTxt', 'length', 'max' => 64),
            array('Price, ProPrice, LogisticsPrice', 'length', 'max' => 9),
            array('PartsLevel', 'length', 'max' => 24),
            array('BigParts, SubParts, CpName', 'length', 'max' => 20),
            array('Title', 'length', 'max' => 200),
            array('Memo', 'safe'),
            // The following rule is used by search().
            // Please remove those attributes that should not be searched.
            array('ID, Name, Pinyin, BrandID, Brand, GoodsNO, OENO, Price, ProPrice, PartsLevel, LogisticsPrice, BigParts, SubParts, CpName, CpNameTxt, Memo, IsPro, IsSale, ISdelete, OrganID, UserID, CreateTime, UpdateTime, ProTime, Title, Sales', 'safe', 'on' => 'search'),
        );
    }

    /**
     * @return array relational rules.
     */
    public function relations() {
        // NOTE: you may need to adjust the relation name and the related
        // class name for the relations automatically generated below.
        return array(
            'goodsspec' => array(self::HAS_ONE, 'DealerGoodsSpec', 'GoodsID'),
            'goodspack' => array(self::HAS_ONE, 'DealerGoodsPack', 'GoodsID'),
        );
    }

    /**
     * @return array customized attribute labels (name=>label)
     */
    public function attributeLabels() {
        return array(
            'ID' => 'ID',
            'Name' => 'Name',
            'Pinyin' => 'Pinyin',
            'BrandID' => 'Brand',
            'Brand' => 'Brand',
            'GoodsNO' => 'Goods No',
            'OENO' => 'Oeno',
            'Price' => 'Price',
            'ProPrice' => 'Pro Price',
            'PartsLevel' => 'Parts Level',
            'LogisticsPrice' => 'Logistics Price',
            'BigParts' => 'Big Parts',
            'SubParts' => 'Sub Parts',
            'CpName' => 'Cp Name',
            'CpNameTxt' => 'Cp Name Txt',
            'Memo' => 'Memo',
            'IsPro' => 'Is Pro',
            'IsSale' => 'Is Sale',
            'ISdelete' => 'Isdelete',
            'OrganID' => 'Organ',
            'UserID' => 'User',
            'CreateTime' => 'Create Time',
            'UpdateTime' => 'Update Time',
            'ProTime' => 'Pro Time',
            'Title' => 'Title',
            'Sales' => 'Sales',
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
        $criteria->compare('Brand', $this->Brand, true);
        $criteria->compare('GoodsNO', $this->GoodsNO, true);
        $criteria->compare('OENO', $this->OENO, true);
        $criteria->compare('Price', $this->Price, true);
        $criteria->compare('ProPrice', $this->ProPrice, true);
        $criteria->compare('PartsLevel', $this->PartsLevel, true);
        $criteria->compare('LogisticsPrice', $this->LogisticsPrice, true);
        $criteria->compare('BigParts', $this->BigParts, true);
        $criteria->compare('SubParts', $this->SubParts, true);
        $criteria->compare('CpName', $this->CpName, true);
        $criteria->compare('CpNameTxt', $this->CpNameTxt, true);
        $criteria->compare('Memo', $this->Memo, true);
        $criteria->compare('IsPro', $this->IsPro);
        $criteria->compare('IsSale', $this->IsSale);
        $criteria->compare('ISdelete', $this->ISdelete);
        $criteria->compare('OrganID', $this->OrganID);
        $criteria->compare('UserID', $this->UserID);
        $criteria->compare('CreateTime', $this->CreateTime);
        $criteria->compare('UpdateTime', $this->UpdateTime);
        $criteria->compare('ProTime', $this->ProTime);
        $criteria->compare('Title', $this->Title, true);
        $criteria->compare('Sales', $this->Sales);

        return new CActiveDataProvider($this, array(
                    'criteria' => $criteria,
                ));
    }

    public static function getGoodsByPinyin($Pinyin = '') {
        $ogranID = Commonmodel::getOrganID();
        if ($Pinyin) {
            $goodses = DealerGoods::model()->findAll("Pinyin like '%{$Pinyin}%' and ISdelete=1 and IsSale = 1");
        } else {
            $goodses = DealerGoods::model()->findAll("ISdelete=1 and IsSale = 1");
        }

        $data = array();
        foreach ($goodses as $key => $goods) {
            $data[$key]['OrganID'] = $goods['OrganID'];
            $data[$key]['ID'] = $goods['ID'];
            $data[$key]['Name'] = $goods['Name'];
            $data[$key]['Pinyin'] = $goods['Pinyin'];
            $data[$key]['Brand'] = $goods['Brand'];
            $data[$key]['goodsBrand'] = $goods['Brand'];
            $data[$key]['GoodsNO'] = $goods['GoodsNO'];
            $data[$key]['OENO'] = $goods['OENO'];
            $data[$key]['PartsLevel'] = $goods['PartsLevel'];
            $data[$key]['Memo'] = $goods['Memo'];
            $data[$key]['Price'] = $goods['Price'];                         // 参考价
            $data[$key]['LogisticsPrice'] = $goods['LogisticsPrice'];       // 物流价
            $data[$key]['ProPrice'] = empty($goods['ProPrice']) ? $goods['Price'] : $goods['ProPrice'];     // 促销价
        }
        return $data;
    }

    /**
     * 模糊循环匹配配件信息
     */
    public static function getGoodsByPartsOENO2($OENO) {
        $sql = "select * from tbl_dealer_goods where  IsSale = 1 and ISdelete = 1 ";
        $condition = 'and';
        if (!empty($OENO) && is_array($OENO)) {                   // OE号不为空，并且是数组
            $len = count($OENO);
            foreach ($OENO as $key => $value) {
                if (isset($OENO[$key + 1])) {
                    $condition .= "  OENO like '%{$value}' OR ";
                } else {
                    $condition .= "  OENO like '%{$value}' ";
                }
            }
        } elseif (!empty($OENO) && !is_array($OENO)) {           // OE号不为空，并且是不是数组
            //$criteria->addInCondition("OENO", array($OENO), "AND");    // 
            $condition .= "  OENO like '%{$OENO}' ";
        }
        $condition .= "order by ID desc limit 3";
//        echo $sql.$condition;//
        $goodses = DBUtil::queryAll($sql . $condition);
        $OrganID = Commonmodel::getOrganID();
        $data = array();
        if($goodses){
        foreach ($goodses as $key => $goods) {
            $data[$key]['ImageUrl'] = self::getGoodsImage($goods['ID']);
            $data[$key]['ID'] = $goods['ID'];
            $data[$key]['OENO'] = $goods['OENO'];
            $data[$key]['OrganID'] = $goods['OrganID'];
            $data[$key]['Name'] = $goods['Name'];
            $organInfo = self::getOrganName($goods['OrganID']);
            $data[$key]['OrganName'] = $organInfo['organName'];
            $data[$key]['ListPrice'] = $goods['Price'];
//            $data[$key]['ListPrice'] = $goods['Price'];     //参考价
            //判断当前登录角色（修理厂/经销商）
            $Identity = Commonmodel::getIdentity($OrganID);     //判断当前登录用户角色类别（经销商）
            $data[$key]['Identity'] = $Identity['identity'];    //当前登录用户觉角色
            if ($Identity['identity'] == 3) {   //修理厂
                $price = self::getContactprice($goods['OrganID'], '');
                $data[$key]['PriceRatio'] = $price['PriceRatio'] ? $price['PriceRatio'] : "100%";
                $DisPrice = sprintf("%.2f", $goods['Price'] * $data[$key]['PriceRatio'] / 100); // 折扣价,小数点后面保留两位
                if ($goods['IsPro'] == 1) {     //促销商品
                    $ProPrice = (empty($goods['ProPrice']) || $goods['ProPrice'] == 0 ) ? $DisPrice : $goods['ProPrice']; // 促销价
                    $data[$key]['Price'] = ($ProPrice < $DisPrice) ? $ProPrice : $DisPrice;
                } else {   //非促销商品
                    $data[$key]['Price'] = $DisPrice;   //折扣价
                }
            } elseif ($Identity['identity'] == 2) {     //经销商
                $data[$key]['Price'] = $goods['Price'];     //参考价
            }
        }
        }
        return $data;
    }

    /**
     * 新的
     */
    public static function getGoodsByPartsOENO($OENO) {
        $criteria = new CDbCriteria();
        $criteria->select = "*";
        $criteria->order = 'ID DESC';
        $criteria->condition = " IsSale = 1 and ISdelete = 1";  // 上架的和没有删除的商品
        $criteria->limit = "3";                                 //只取前三条数据

        $sql = "select * from tbl_dealer_goods where  IsSale = 1 and ISdelete = 1 and 1= 1";
        $condition = '';
        if (!empty($OENO) && is_array($OENO)) {                   // OE号不为空，并且是数组
            foreach ($OENO as $value) {
                $condition .= "OENO like '%{$value}'";
            }
            $criteria->addInCondition("OENO", $OENO, "AND");
        } elseif (!empty($OENO) && !is_array($OENO)) {           // OE号不为空，并且是不是数组
            //$criteria->addInCondition("OENO", array($OENO), "AND");    // 
            $criteria->addSearchCondition('OENO', $OENO, 'AND');
        }

        $goodses = DealerGoods::model()->findAll($criteria);
        $OrganID=Yii::app()->user->getOrganID();
       //$OrganID = Commonmodel::getOrganID();
        $data = array();
        foreach ($goodses as $key => $goods) {
            $data[$key]['ImageUrl'] = self::getGoodsImage($goods['ID']);
            $data[$key]['ID'] = $goods['ID'];
            $data[$key]['OENO'] = $goods['OENO'];
            $data[$key]['OrganID'] = $goods['OrganID'];
            $data[$key]['Name'] = $goods['Name'];
            $organInfo = self::getOrganName($goods['OrganID']);
            $data[$key]['OrganName'] = $organInfo['organName'];
            $data[$key]['ListPrice'] = $goods['Price'];
//            $data[$key]['ListPrice'] = $goods['Price'];     //参考价
            //判断当前登录角色（修理厂/经销商）
            $Identity = Commonmodel::getIdentity($OrganID);     //判断当前登录用户角色类别（经销商）
            $data[$key]['Identity'] = $Identity['identity'];    //当前登录用户觉角色
            if ($Identity['identity'] == 3) {   //修理厂
                $price = self::getContactprice($goods['OrganID'], '');
                $data[$key]['PriceRatio'] = $price['PriceRatio'] ? $price['PriceRatio'] : "100%";
                $DisPrice = sprintf("%.2f", $goods['Price'] * $data[$key]['PriceRatio'] / 100); // 折扣价,小数点后面保留两位
                if ($goods['IsPro'] == 1) {     //促销商品
                    $ProPrice = (empty($goods['ProPrice']) || $goods['ProPrice'] == 0 ) ? $DisPrice : $goods['ProPrice']; // 促销价
                    $data[$key]['Price'] = ($ProPrice < $DisPrice) ? $ProPrice : $DisPrice;
                } else {   //非促销商品
                    $data[$key]['Price'] = $DisPrice;   //折扣价
                }
            } elseif ($Identity['identity'] == 2) {     //经销商
                $data[$key]['Price'] = $goods['Price'];     //参考价
            }
        }
        return $data;
    }

    /**
     * 获取商品通过OE号
     */
    public static function getGoodsByOENO($OENO) {
        $criteria = new CDbCriteria();
        $criteria->select = "*";
        $criteria->order = 'ID DESC';
        $criteria->condition = " IsSale = 1 and ISdelete = 1";  // 上架的和没有删除的商品

        if (!empty($OENO) && is_array($OENO)) {                   // OE号不为空，并且是数组
            $criteria->addInCondition("OENO", $OENO, "AND");
        } elseif (!empty($OENO) && !is_array($OENO)) {           // OE号不为空，并且是不是数组
            $criteria->addInCondition("OENO", array($OENO), "AND");    // 
        }

        $goodses = DealerGoods::model()->findAll($criteria);

        $data = array();
        foreach ($goodses as $key => $goods) {
            $data[$key]['OrganID'] = $goods['OrganID'];
            $data[$key]['ID'] = $goods['ID'];
            $data[$key]['Name'] = $goods['Name'];
            $data[$key]['Pinyin'] = $goods['Pinyin'];
            $data[$key]['Brand'] = $goods['Brand'];
            $data[$key]['goodsBrand'] = $goods['Brand'];
            $data[$key]['GoodsNO'] = $goods['GoodsNO'];
            $data[$key]['OENO'] = $goods['OENO'];
            $data[$key]['PartsLevel'] = $goods['PartsLevel'];
            $data[$key]['Memo'] = $goods['Memo'];
            $data[$key]['Price'] = $goods['Price'];
            //$data[$key]['Price'] = $goods['Price'];
            $data[$key]['LogisticsPrice'] = $goods['LogisticsPrice'];       // 物流价
            $data[$key]['ProPrice'] = empty($goods['ProPrice']) ? $goods['Price'] : $goods['ProPrice'];
        }
        return $data;
    }

    /**
     * 通过GoodsID查询商品
     */
    public static function getGoodsByID($goodsID) {
        $criteria = new CDbCriteria();
        $criteria->select = "*";
        $criteria->order = 'ID DESC';
        $criteria->condition = " IsSale = 1 and ISdelete = 1";  // 上架的和没有删除的商品
        $criteria->addCondition("ID = $goodsID");
        $goodses = DealerGoods::model()->findAll($criteria);

        $data = array();
        foreach ($goodses as $key => $goods) {
            $price = self::getContactprice($goods['OrganID'], '');
            $data[$key]['PriceRatio'] = $price['PriceRatio'] ? $price['PriceRatio'] : "100%";
            $data[$key]['ID'] = $goods['ID'];
            $data[$key]['OrganID'] = $goods['OrganID'];
            $organInfo = self::getOrganName($goods['OrganID']);
            $data[$key]['OrganName'] = $organInfo['organName'];
            $data[$key]['QQ'] = $organInfo['QQ'];
            $data[$key]['Phone'] = $organInfo['Phone'];
            $data[$key]['ContactPhone'] = $organInfo['ContactPhone'];
            $data[$key]['Name'] = $goods['Name'];
            $data[$key]['Pinyin'] = $goods['Pinyin'];
            $data[$key]['Brand'] = $goods['Brand'];
            $data[$key]['goodsBrand'] = $goods['Brand'];
            $data[$key]['GoodsNO'] = $goods['GoodsNO'];
            $data[$key]['OENO'] = $goods['OENO'];
            $data[$key]['PartsLevel'] = $goods['PartsLevel'];
            $data[$key]['Memo'] = $goods['Memo'];
            $data[$key]['ListPrice'] = $goods['Price'];     //参考价
            $data[$key]['Price'] = sprintf("%.2f", $goods['Price'] * $data[$key]['PriceRatio'] / 100);    // 折扣价,小数点后面保留两位
            if ($goods['IsPro'] == 1) {
                if (empty($goods['ProPrice']) || $goods['ProPrice'] == 0) {
                    $data[$key]['ProPrice'] = $data[$key]['Price'];          // 促销价
                } else {
                    $data[$key]['ProPrice'] = $goods['ProPrice'];       // 促销价
                }
            }
            $data[$key]['LogisticsPrice'] = $goods['LogisticsPrice'];    // 物流价
            $data[$key]['BigParts'] = Commonmodel::getCategory($goods['BigParts']);
            $data[$key]['SubParts'] = Commonmodel::getCategory($goods['SubParts']);
            $data[$key]['CpName'] = Commonmodel::getCategory($goods['CpName']);
            $data[$key]['CpNameTxt'] = $goods['CpNameTxt'];
            $vehs = explode('、', self::getVehicleByGoodsID($goods['ID']));
            $data[$key]['Vehicle'] = $vehs[0];
            $data[$key]['IsSale'] = $goods['IsSale'] == 1 ? '已上架' : '已下架';
            // 商品属性
            $data[$key]['ID'] = $goods['ID'];
            $data[$key]['Weight'] = $goods->goodsspec->Weight;
            $data[$key]['Length'] = $goods->goodsspec->Length;
            $data[$key]['Wide'] = $goods->goodsspec->Wide;
            $data[$key]['Height'] = $goods->goodsspec->Height;
            $data[$key]['Volume'] = $goods->goodsspec->Volume;
            $data[$key]['ValidityDate'] = $goods->goodsspec->ValidityDate;
            $data[$key]['ValidityType'] = $goods->goodsspec->ValidityType;
            if ($data[$key]['ValidityType'] == 1) {
                $data[$key]['Validity'] = '不保修';
            }if ($data[$key]['ValidityType'] == 2) {
                $data[$key]['Validity'] = '保装车';
            }if ($data[$key]['ValidityType'] == 3) {
                $data[$key]['Validity'] = $data[$key]['ValidityDate'] . '个月';
                ;
            }
            $data[$key]['Specifica'] = $goods->goodsspec->Specifica;
            $data[$key]['Unit'] = $goods->goodsspec->Unit;
            $data[$key]['BganCompany'] = $goods->goodsspec->BganCompany;
            $data[$key]['BganGoodsNO'] = $goods->goodsspec->BganGoodsNO;
            $data[$key]['PartsNO'] = $goods->goodsspec->PartsNO;
            $data[$key]['JiapartsNO'] = $goods->goodsspec->JiapartsNO;    // 嘉配号
            $data[$key]['ImageUrl'] = $goods->goodsspec->ImageUrl;        // 图像
            $data[$key]['DetectionImg'] = $goods->goodsspec->DetectionImg; // 检测图像
            // 商品包装
            $data[$key]['pWeight'] = $goods->goodspack->Weight;
            $data[$key]['pLength'] = $goods->goodspack->Volume;
            $data[$key]['MinQuantity'] = $goods->goodspack->MinQuantity;
            // OE号
            $data[$key]['OENOS'] = self::getOENOSByGoodsID($goodsID);
            // 车型车系
            $data[$key]['Vehicles'] = self::getVehicleByGoodsID($goodsID);
            // 图片
            $data[$key]['Images'] = DealerGoods::getImagesByGoodsID($goodsID);
        }
        return $data;
    }

    /**
     * 
     * 获取商品信息
     * @param type array() $prams
     * Description 根据传入的阐述
     * 参数传入方法： array('OrganID'=>'机构ID','goodsName'=>'商品名称',...);
     *                如果需要分页，array('rows'=>'每页显示条数',...); 返回结果 获取总条数： $data[0]['count'];
     * @return array 
     * 使用方法 ： 1、DealerGoods::getGoodsInfo(); 
     *             3、DealerGoods::getGoodsInfo(array('goodsName'=>'商品001')); 等
     */
    public static function getGoodsInfo($params = '') {
        $criteria = new CDbCriteria();
        $criteria->select = "*";
        $criteria->order = "t.ID DESC"; //排序条件:update_time,id倒叙   
//        $criteria->with = array('goodsspec', 'goodspack');
        $criteria->condition = 't.ISdelete =1';
        // 查询条件
        if (is_array($params)) {
            $organID = $params['OrganID'];              // 机构ID
            $rows = $params['rows'];
            $curpage = $params['page']; // 每页显示条数
            $goodsNO = $params['goodsNO'];               // 商品编号
            $goodsName = $params['goodsName'];          // 商品名称
            $brandID = $params['BrandID'];              // 商品品牌ID
            $brand = $params['BrandName'];              // 商品品牌名
            $OENO = $params['OENO'];                    // 商品OE号
            $IsSale = $params['IsSale'];                // 是否上架
            $IsPro = $params['IsPro'];                  // 是否促销                                                                                                                                                                 
            //   $gbigparts = $params['gbigparts'];          // 大类
            //   $gsubparts = $params['gsubparts'];          // 子类
            //   $gcpname = $params['gcpname'];              // 标准名称
            $gcpnametxt = $params['gcpnametxt'];              // 标准名称
            $gmake = $params['gmake'];                  // 厂家
            $gcar = $params['gcar'];                    // 车系
            $gyear = $params['gyear'];                  // 年款
            $gmodel = $params['gmodel'];                // 车型
            if (empty($IsSale)) {       // 是否上架
                $criteria->addCondition("t.IsSale = 1", "AND");
            } elseif ($IsSale == 'all') {
                $criteria->addBetweenCondition('IsSale', 0, 1, "AND");
            } else {
                if ($IsSale == 2) {
                    $criteria->addCondition("IsSale = 0", "AND");
                } else {
                    $criteria->addCondition("t.IsSale = 1", "AND");
                }
            }if (empty($IsPro) || $IsPro == 'all') {       // 是否促销
                $criteria->addBetweenCondition('t.IsPro', 0, 1, "AND");
            } else {
                if ($IsPro == 2) {     // 不是促销的
                    $criteria->addCondition("t.IsPro = 0", "AND");
                } else {        // 是促销的
                    //   $Times = time() - 24 * 60 * 60 * 7 * 2 ;
                    $criteria->addCondition("t.IsPro = 1", "AND");
                    //  $criteria->addCondition("ProTime < $Times", "AND");
                }
            }
            if (!empty($goodsNO)) { // 商品编号
                $criteria->addSearchCondition("t.GoodsNO", "{$goodsNO}", "AND");
            }if (!empty($goodsName)) { // 商品名称
                $criteria->addSearchCondition("t.Name", "{$goodsName}", "AND");
            }if (!empty($brandID)) {  // 品牌ID
                $criteria->addCondition("t.BrandID = $brandID ", "AND");
            }if (!empty($brand)) {  // 品牌名称
                $criteria->addCondition("t.Brand = '{$brand}' ", "AND");
            }if (!empty($organID)) {    // 机构名称
                $criteria->addCondition("t.OrganID = $organID ", "AND");
            }
//            if (!empty($gbigparts)) {
//                if (!empty($gcpname)) {
//                    $criteria->addCondition("t.BigParts = $gbigparts ", "AND");
//                    $criteria->addCondition("t.CpName = $gcpname ", "AND");
//                } else {
//                    $criteria->addCondition("t.BigParts = $gcpname ", "AND");
//                }
//            }
            if (!empty($gcpnametxt) && $gcpnametxt != "请选择标准名称") {
                $criteria->addCondition("t.CpNameTxt = '{$gcpnametxt}'", "AND");
                // $criteria->addCondition("t.CpNameTxt = '空气滤清器'", "AND");
            }
            if ($OENO) {
                $OENOs = self::getOENOcondition($OENO);
                if ($OENOs) {
                    $criteria->addInCondition('t.ID', $OENOs, "AND");
                } else {
                    $criteria->addInCondition('t.ID', array(0), "AND");
                }
            } if (!empty($gmake)) { // 车型车系
                $arr = array();
                $arr['gmake'] = $gmake ? $gmake : 0;
                $arr['gcar'] = $gcar ? $gcar : 0;
                $arr['gyear'] = $gyear ? $gyear : 0;
                $arr['gmodel'] = $gmodel ? $gmodel : 0;
                $goodsIDS = self::getVehcondition($arr);
                //var_dump($goodsIDS);     exit;
                if ($goodsIDS) {
                    $criteria->addInCondition('t.ID', $goodsIDS, "AND");
                } else {
                    $criteria->addInCondition('t.ID', array(0), "AND");
                }
//                $MakeInfo = D::queryFrontMakeInfo($gmake);
//                $SeriesInfo = D::queryFrontSeriesInfo($gcar);
            }
            // var_dump($params);
        } else if (!empty($params) && !is_array($params)) {
            return '参数传入错误';
        }
        $count = DealerGoods::model()->count($criteria);
//        $rows = $rows ? $rows : 10;
//        $offset = $curpage * $rows + 1;
//        $criteria->limit = $rows;   //取1条数据，如果小于0，则不作处理  
//        $criteria->offset = $offset;
        $pages = new CPagination($count);
        $pages->pageSize = $rows ? $rows : 10;
        $pages->applyLimit($criteria);
        $goodses = DealerGoods::model()->findAll($criteria);
        // var_dump($goodses);
        $data = array();
        $data[0]['count'] = $count;

        foreach ($goodses as $key => $goods) {
            $data[$key]['ID'] = $goods['ID'];
            $data[$key]['OrganID'] = $goods['OrganID'];
            $organInfo = self::getOrganName($goods['OrganID']);
            $data[$key]['OrganName'] = $organInfo['organName'];
            $data[$key]['Name'] = $goods['Name'];
            $data[$key]['goodsName'] = F::msubstr($goods['Name'], 0, 20);
            $data[$key]['gName'] = mb_substr($goods['Name'], 0, 20, 'utf-8');
            $data[$key]['Pinyin'] = $goods['Pinyin'];
            $data[$key]['Pinyin2'] = F::msubstr($goods['Pinyin'], 0, 10);
            $data[$key]['Brand'] = self::getBrandByID($goods['BrandID']);
            $data[$key]['Brand'] = $data[$key]['Brand'] ? $data[$key]['Brand'] : $goods['Brand'];
            $data[$key]['goodsBrand'] = $goods['BrandID'];
            $data[$key]['GoodsNO'] = $goods['GoodsNO'];
            $data[$key]['OENO'] = $goods['OENO'];
            $data[$key]['OENOS'] = self::getOENOSByGoodsID($goods['ID']) ? : $goods['OENO'];
            // 车型车系
            $vehs = explode('、', self::getVehicleByGoodsID($goods['ID'])); //  'seriesName'=>'','makeId'=>'','makeName'=>'');
            //检索商品本身的适用车型，如果有子集的车型则显示有子集的车型
            $data[$key]['Vehicle'] = self::getCurrentVehicle($arr);
            $data[$key]['Vehicle'] = $data[$key]['Vehicle'] ? $data[$key]['Vehicle'] : $vehs[0];
            $data[$key]['Vehicles'] = self::getVehicleByGoodsID($goods['ID']);
            $data[$key]['PartsLevel'] = $goods['PartsLevel'];
            $data[$key]['Memo'] = $goods['Memo'];
            $data[$key]['Price'] = $goods['Price'];                         // 参考价
            if ($goods['IsPro'] == 1) {
                if (empty($goods['ProPrice']) || $goods['ProPrice'] == 0) {
                    $data[$key]['ProPrice'] = $goods['Price'];              // 促销价
                } else {
                    $data[$key]['ProPrice'] = $goods['ProPrice'];           // 促销价
                }
            }
            $data[$key]['LogisticsPrice'] = $goods['LogisticsPrice'];       // 物流价
            //$data[$key]['BigParts'] = Commonmodel::getCategory($goods['BigParts']);
            //$data[$key]['SubParts'] = Commonmodel::getCategory($goods['SubParts']);
            //$data[$key]['CpName'] = Commonmodel::getCategory($goods['CpName']);
            $data[$key]['CpNameTxt'] = $goods['CpNameTxt'];
            $data[$key]['mainCategory'] = $goods['BigParts'];
            $data[$key]['subCategory'] = $goods['SubParts'];
            $data[$key]['leafCategory'] = $goods['CpName'];
            // $data[$key]['sutecar'] = F::msubstr($this->getcar($goods['ID']));
            $data[$key]['IsSale'] = $goods['IsSale'] == 1 ? '已上架' : '已下架';
            $data[$key]['IsUpSale'] = $goods['IsSale'];
            $data[$key]['proTime'] = date("Y-m-d", $goods['ProTime']) . '--' . date("Y-m-d", $goods['ProTime'] + 60 * 60 * 24 * 14);      // 促销时间
            // 商品属性
            $data[$key]['Weight'] = "";
            $data[$key]['Length'] = "";
            $data[$key]['Wide'] = "";
            $data[$key]['Height'] = "";
            $data[$key]['Volume'] = "";
            $data[$key]['ValidityDate'] = "";
            $data[$key]['ValidityType'] = "";
            $data[$key]['Specifica'] = "";
            $data[$key]['Unit'] = "";
            $data[$key]['BganCompany'] = "";
            $data[$key]['BganGoodsNO'] = "";
            $data[$key]['PartsNO'] = "";
            $data[$key]['JiapartsNO'] = "";   // 嘉配号
            $data[$key]['ImageUrl'] = "";        // 图像名称
            $data[$key]['DetectionImg'] = ""; // 检测图像
            $cmodel = DealerGoodsSpec::model()->findByAttributes(array('GoodsID' => $goods['ID']));
            if ($cmodel) {
                $data[$key]['Weight'] = $cmodel->Weight;
                $data[$key]['Length'] = $cmodel->Length;
                $data[$key]['Wide'] = $cmodel->Wide;
                $data[$key]['Height'] = $cmodel->Height;
                $data[$key]['Volume'] = $cmodel->Volume;
                $data[$key]['ValidityType'] = $cmodel->ValidityType;
                $data[$key]['ValidityDate'] = $cmodel->ValidityDate;
                if ($cmodel->ValidityType == 1) {
                    $data[$key]['Validity'] = '不保修';
                }if ($cmodel->ValidityType == 2) {
                    $data[$key]['Validity'] = '保装车';
                }if ($cmodel->ValidityType == 3) {
                    $data[$key]['Validity'] = $cmodel->ValidityDate;
                    ;
                }

                $data[$key]['Specifica'] = $cmodel->Specifica;
                $data[$key]['Unit'] = $cmodel->Unit;
                $data[$key]['BganCompany'] = $cmodel->BganCompany;
                $data[$key]['BganGoodsNO'] = $cmodel->BganGoodsNO;
                $data[$key]['PartsNO'] = $cmodel->PartsNO;
                $data[$key]['JiapartsNO'] = $cmodel->JiapartsNO;    // 嘉配号
                $data[$key]['ImageUrl'] = $cmodel->ImageUrl;        // 图像名称
                $data[$key]['DetectionImg'] = $cmodel->DetectionImg; // 检测图像
            }

            // 商品包装
            $data[$key]['pWeight'] = "";
            $data[$key]['pVolume'] = "";
            $data[$key]['MinQuantity'] = "";
            $cmodel = DealerGoodsPack::model()->findByAttributes(array('GoodsID' => $goods['ID']));
            if ($cmodel) {
                $data[$key]['pWeight'] = $cmodel->Weight;
                $data[$key]['pVolume'] = $cmodel->Volume;
                $data[$key]['MinQuantity'] = $cmodel->MinQuantity;
            }
        }
        return $data;
    }

    /*
     * 获取业务联系人价格管理优惠
     * 通过业务联系人中合作类型信息，获取当前登录用户在该经销商店铺的优惠价格
     * A、B类客户参考价优惠是经销商在价格管理中自己定义，而C类客户则默认为100%
     * 未成为业务联系人则默认为C类客户，参考价同原参考价
     * $dealerID=>经销商ID
     * $seriveID=>修理厂ID（经销商登录使用，为询价对象ID）
     */

    public static function getContactprice($dealerID, $seriveID) {
        $criteria = new CDbCriteria();
        $criteria->select = "cooperationtype";
        $OrganID = Commonmodel::getOrganID();
        $Identity = Commonmodel::getIdentity($OrganID);     //判断当前登录用户角色类别（修理厂/经销商）
        if ($Identity['identity'] == 3) {           //修理厂角色登录
            $criteria->addCondition("t.user_id = $dealerID", "AND");            //经销商ID
            $criteria->addCondition("t.contact_user_id = $OrganID", "AND");     //当前登录的修理厂ID
            $criteria->addCondition("t.Status=0", 'AND');
        } elseif ($Identity['identity'] == 2) {     //经销商角色登录
            $criteria->addCondition("t.user_id = $OrganID", "AND");             //当前登录的经销商ID
            //  $criteria->addCondition("t.contact_user_id =$seriveID", "AND");
            $criteria->addCondition("t.contact_user_id = :seriveID", 'AND');
            $criteria->addCondition("t.Status=0", 'AND');
            $criteria->params[':seriveID'] = $seriveID;      //修理厂ID(询价对象ID)
        }
        $contact = BusinessContacts::model()->find($criteria);
        if ($contact) {
            $model = PriceManage::model()->find(array(
                "condition" => "OrganID = $dealerID AND CooperationType = '{$contact['cooperationtype']}'"
                    ));
        }
        return $model;
    }

    public static function getGoodsList($params = '') {


        $organ_ID = Commonmodel::getOrganID();
        // 查询条件
        if (is_array($params)) {
            $organID = $params['OrganID'];              // 机构ID
            $rows = $params['rows'];
            $curpage = $params['page'];                 // 每页显示条数
//            $goodsNO = $params['goodsNO'];              // 商品编号
            $goodsName = trim($params['goodsName']);          // 商品名称
//            $pinyin = $params['pinyin'];          // 商品名称
//            $brandID = $params['BrandID'];              // 商品品牌ID
//            $brand = $params['BrandName'];              // 商品品牌名
//            $OENO = $params['OENO'];                    // 商品OE号
//            $IsSale = $params['IsSale'];                // 是否上架
            $IsPro = $params['IsPro'];                  // 是否促销                                                                                                                                                                 
//            $gbigparts = $params['gbigparts'];          // 大类
//            $gsubparts = $params['gsubparts'];          // 子类
            $gcpname = $params['gcpname'];              // 标准名称
            $gmake = $params['gmake'];                  // 厂家
            $gcar = $params['gcar'];                    // 车系
            $gyear = $params['gyear'];                  // 年款
            $gmodel = $params['gmodel'];                // 车型
            $orderby = $params['orderby'];                // 排序
            if ($orderby == 'pirec_big' || $orderby == 'pirec_small') {   //总价从高到低
                $sql = "SELECT dg.*,if(dg.ProPrice,dg.ProPrice,if(discount.PriceRatio,discount.PriceRatio*dg.Price,dg.Price)) as ppp FROM tbl_dealer_goods dg left join(
                SELECT p.OrganID as OrganID, left(p.PriceRatio,char_length(p.PriceRatio)-1)/100 as PriceRatio from  tbl_price_manage AS p ,tbl_business_contacts as bc WHERE 
                p.CooperationType = bc.cooperationtype 
                AND  bc.contact_user_id = $organ_ID and bc.user_id=p.OrganID and bc.Status=0
                AND (!ISNULL(p.PriceRatio) AND p.PriceRatio !='')) as discount 
                on dg.OrganID = discount.OrganID where dg.ISdelete=1 ";
            } else {
                $sql = "SELECT dg.* FROM tbl_dealer_goods as dg where dg.ISdelete=1 ";
            }

            //商品编号、oe号
            if ($goodsName) {
                $sql.=" and (dg.Title like '%$goodsName%') ";
            }
            // 机构名称
            if (!empty($organID)) {
                $sql.=" and dg.OrganID = $organID";
            }
            //标准名称
            if ($gcpname) {
                $sql.=" and dg.CpNameTxt = '$gcpname'";
            }
            // 是否促销
            if (empty($IsPro) || $IsPro == 'all') {
                $sql.=" and dg.IsPro between 0 and 1";
            } else {
                if ($IsPro == 2) {     // 不是促销的
                    $sql.=" and dg.IsPro = 0";
                } else {        // 是促销的
                    $sql.=" and dg.IsPro = 1";
                }
            }
            // 车型车系
            if (!empty($gmake)) {
                $arr = array();
                $arr['gmake'] = $gmake ? $gmake : 0;
                $arr['gcar'] = $gcar ? $gcar : 0;
                $arr['gyear'] = $gyear ? $gyear : 0;
                $arr['gmodel'] = $gmodel ? $gmodel : 0;
                $goodsIDS = self::getVehcondition($arr);
                if ($goodsIDS) {
                    $goodsStr = implode(',', $goodsIDS);
                    $sql.=" and dg.ID in ($goodsStr)";
                } else {
                    $sql.=" and dg.ID in (0)";
                }
            }
            if ($orderby) {
                if ($orderby == 'sales') {    // 按销量排序
                    $sql.=" order by dg.Sales DESC";
                } elseif ($orderby == 'xinyong') { // 信用排序
                    $sql.=" order by dg.Name DESC";
                } elseif ($orderby == 'pirec_big') {   //总价从高到低
                    //if ($IsPro) {
                        $sql.=" order by ppp DESC";
//                    } else {
//                        $sql.=" order by discount.PriceRatio*dg.Price DESC";
//                    }
                } elseif ($orderby == 'pirec_small') { // 总价从低到高
                    //if ($IsPro) {
                        $sql.=" order by ppp ASC";
//                    } else {
//                        $sql.=" order by discount.PriceRatio*dg.Price ASC";
//                    }
                }
            }
        } else if (!empty($params) && !is_array($params)) {
            return '参数传入错误';
        }
        //echo $sql;exit;
        $count = count(DBUtil::queryAll($sql));
        $pages = new CPagination($count);
        $pages->pageSize = $rows == '' ? 12 : $rows;
        $offset = ($curpage - 1) * $pages->pageSize;
        $goodses = DBUtil::queryAll($sql . " LIMIT $offset,$pages->pageSize");
        $data = array();
        foreach ($goodses as $key => $goods) {
            $price = self::getContactprice($goods['OrganID'], $params['serviceID']);
            $data[$key]['PriceRatio'] = $price['PriceRatio'] ? $price['PriceRatio'] : "100%";
            $data[$key]['ImageUrl'] = self::getNewImage($goods['ID'], $goods['OrganID']);
            $data[$key]['ID'] = $goods['ID'];
            $data[$key]['OrganID'] = $goods['OrganID'];
            $organInfo = self::getOrganName($goods['OrganID']);
            $data[$key]['OrganName'] = $organInfo['organName'];
            $data[$key]['Name'] = $goods['Name'];
            $data[$key]['goodsName'] = F::msubstr($goods['Name'], 0, 20);
            $data[$key]['gName'] = mb_substr($goods['Name'], 0, 30, 'utf-8');
            $data[$key]['Pinyin'] = $goods['Pinyin'];
            $data[$key]['Brand'] = $goods['Brand'];
            $data[$key]['goodsBrand'] = $goods['BrandID'];
            $data[$key]['GoodsNO'] = $goods['GoodsNO'];
            $data[$key]['OENO'] = $goods['OENO'];
            $data[$key]['Sales'] = $goods['Sales'];
            $data[$key]['OENOS'] = self::getOENOSByGoodsID($goods['ID']);
            $memolen = strlen($goods['Memo']);
            if ($memolen >= 60) {
                $data[$key]['Memo'] = $goods['Memo'] ? mb_substr($goods['Memo'], 0, 26, 'utf-8') . '…' : '';
            } else {
                $data[$key]['Memo'] = $goods['Memo'] ? $goods['Memo'] : '';
            }

            // 车型车系
            $vehs = explode('、', self::getVehicleByGoodsID($goods['ID'])); //  'seriesName'=>'','makeId'=>'','makeName'=>'');
            //检索商品本身的适用车型，如果有子集的车型则显示有子集的车型
            $currv = self::getCurrentVehicle($arr, $goods['ID']);
            $data[$key]['Vehicle'] = self::getCurrentVehicle($arr, $goods['ID']);
            $data[$key]['Vehicle'] = $currv ? $currv : $vehs[0];
            $data[$key]['Vehicles'] = self::getVehicleByGoodsID($goods['ID']);
            $data[$key]['ListPrice'] = $goods['Price'];     //参考价
            $data[$key]['Price'] = sprintf("%.2f", $goods['Price'] * $data[$key]['PriceRatio'] / 100);    // 折扣价,小数点后面保留两位
            if ($goods['IsPro'] == 1) {
                if(!is_null($goods['ProPrice']) && $goods['ProPrice']){
                    $data[$key]['ProPrice'] = $data[$key]['ProPrice'];
                }
//                if (empty($goods['ProPrice']) || $goods['ProPrice'] == 0) {
//                    $data[$key]['ProPrice'] = $data[$key]['Price'];
//                    $data[$key]['Price'] = $data[$key]['Price'];
//                    // 促销价
//                } else {
//                    $data[$key]['ProPrice'] = $goods['ProPrice'];           // 促销价
//                    $data[$key]['Price'] = $goods['ProPrice'];
//                }
            }
            $data[$key]['LogisticsPrice'] = $goods['LogisticsPrice'];       // 物流价
            $data[$key]['CpName'] = $goods['CpNameTxt'];
            // 用于排序
//            $listP[$key] = $data[$key]['Price']; // 参考价
//            $disP[$key] = $data[$key]['Price'];    // 折扣价
//            $logiP[$key] = $data[$key]['LogisticsPrice'];    // 物流价
//            $proP[$key] = $data[$key]['ProPrice'];    // 物流价
            // $data[$key]['CpName'] = Commonmodel::getCategory($goods['CpName']);
            // $data[$key]['sutecar'] = F::msubstr($this->getcar($goods['ID']));
            // 商品属性
        }

//        if ($orderby == 'pirec_big') {   //总价从高到低
//            array_multisort($disP, SORT_DESC, $listP, SORT_DESC, $data, SORT_DESC);    // ,$proP,SORT_DESC
//        } elseif ($orderby == 'pirec_small') { // 总价从低到高
//            array_multisort($disP, SORT_ASC, $listP, SORT_ASC, $data, SORT_ASC);    // ,$proP,SORT_DESC
//        }
        $data[0]['count'] = $count;

//        var_dump($data);
        return $data;
    }

    private static function getNewImage($goodsID, $OrganID) {
        $criteria = new CDbCriteria();
        $criteria->addCondition("GoodsID= " . $goodsID, "AND");
        $criteria->addCondition("OrganID= " . $OrganID, "AND");
        $model = DealerGoodsImageRelation::model()->findAll($criteria);
        return $model[0]->ImageUrl;
    }

    private static function getGoodsImage($goodsID) {
        $criteria = new CDbCriteria();
        $criteria->select = "ImageUrl";
        $criteria->condition = "t.GoodsID = " . $goodsID;
        $model = DealerGoodsSpec::model()->find($criteria);
        return $model->ImageUrl;
    }

    private static function getCurrentVehicle($arr, $goodsID = null) {
        $attriutes = array();
        if ($goodsID)
            $attriutes["GoodsID"] = $goodsID;

        if ($arr && is_array($arr)) {
            foreach ($arr as $k => $v) {
                if (!$v) {
                    continue;
                }
                switch ($k) {
                    case "gmake":
                        $attriutes["Make"] = $v;
                        break;
                    case "gcar":
                        $attriutes["Car"] = $v;
                        break;
                    case "gyear":
                        $attriutes["Year"] = $v;
                        break;
                    case "gmodel":
                        $attriutes["Model"] = $v;
                        break;
                }
            }
            $model = DealerGoodsVehicleRelation::model()->findByAttributes($attriutes);
        }
        if ($model) {
            $vehicle = $model->Marktxt;
            if ($model->Cartxt) {
                $vehicle.= " " . $model->Cartxt;
            }
            if ($model->Year) {
                $vehicle.= " " . $model->Year;
            }
            if ($model->Modeltxt) {
                $vehicle.= " " . $model->Modeltxt;
            }
            return rtrim($vehicle);
        } else {
            return FALSE;
        }
    }

    private static function getOENOcondition($oeno) {
        if (is_array($oeno)) {
            $oeArr = array();
            foreach ($oeno as $oe) {
                if (!in_array($oe["oeno"], $oeArr)) {
                    $oeArr[] = "'{$oe["oeno"]}'";
                }
            }
            $sql = "select distinct GoodsID from tbl_dealer_goods_oeno_relation where OENO in (" . implode(",", $oeArr) . ") ";
        } else {
            $sql = "select distinct GoodsID from tbl_dealer_goods_oeno_relation where OENO like '%{$oeno}%' ";
        }
        $OENOS = DBUtil::queryAll($sql);
        $OE = '';
        if (!empty($OENOS)) {
            foreach ($OENOS as $value) {
                $OE[] = $value['GoodsID'];
            }
        }
        return $OE;
    }

    static function getVehcondition($params) {
        $gmake = $params['gmake'];                  // 厂家
        $gcar = $params['gcar'];                    // 车系
        $gyear = $params['gyear'];                  // 年款
        $gmodel = $params['gmodel'];                // 车型
        $goodsID = '';
        if (!empty($gmake)) {
            if (!empty($gcar)) { // 车型车系
                if (!empty($gyear)) {
                    if (!empty($gmodel)) {
                        //  $sql = "select distinct GoodsID from tbl_dealer_goods_vehicle_relation where Make= '{$gmake}' and (Car = '{$gcar}' or Car = 0) and (Year = '{$gyear}' or Year = 0) and (Model = '{$gmodel}' or Model=0)";
                        $sql = "select distinct GoodsID from tbl_dealer_goods_vehicle_relation where Make= '{$gmake}' and (Car = '{$gcar}') and (Year = '{$gyear}') and (Model = '{$gmodel}')";
                    } else {
                        $sql = "select distinct GoodsID from tbl_dealer_goods_vehicle_relation where Make= '{$gmake}' and (Car = '{$gcar}') and (Year = '{$gyear}')";
                    }
                } else {
                    $sql = "select distinct GoodsID from tbl_dealer_goods_vehicle_relation where Make= '{$gmake}' and (Car = '{$gcar}')";
                }
            } else {
                $sql = "select distinct GoodsID from tbl_dealer_goods_vehicle_relation where Make= '{$gmake}'";
            }

            $goodsIDs = DBUtil::queryAll($sql);
            if (!empty($goodsIDs)) {
                foreach ($goodsIDs as $value) {
                    $goodsID[] = $value['GoodsID'];
                }
            }
        }
        return $goodsID;
    }

    /**
     * 获取OE号
     */
    public static function getOENOSByGoodsID($goodsID) {
        $goodsOES = DealerGoodsOenoRelation::model()->findAll("GoodsID=$goodsID");
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

    /**
     * 获取图片
     */
    private static function getImagesByGoodsID($goodsID) {
        $goodsImages = DealerGoodsImageRelation::model()->findAll("GoodsID=$goodsID");
        $data = array();
        foreach ($goodsImages as $key => $value) {
            $data[$key]['ID'] = $value['ID'];
            $data[$key]['ImageUrl'] = $value['ImageUrl'];
        }
        return $data;
    }

    /**
     * 获取车型车系
     */
    public static function getVehicleByGoodsID($goodsID) {
        $goodsVehicle = DealerGoodsVehicleRelation::model()->findAll("GoodsID=$goodsID");
        $data = array();
        $Vehicles = '';
        foreach ($goodsVehicle as $key => $value) {
            $data[$key]['ID'] = $value['ID'];
            $data[$key]['Make'] = $value['Make'];
            $data[$key]['Car'] = $value['Car'];
            $data[$key]['Year'] = $value['Year'];
            $data[$key]['Model'] = $value['Model'];
            $year = $value['Year'] == 0 ? '' : $value['Year'];
            $modeltxt = $value['Modeltxt'] ? $value['Modeltxt'] : '';
            if ($key == 0)
                $Vehicles .= $value['Marktxt'] . ' ' . $value['Cartxt'] . ' ' . $year . ' ' . $modeltxt;
            // $Vehicles .= Commonmodel::getMake($value['Make']) . '/' . Commonmodel::getCar($value['Car']) . '/' . Commonmodel::getYear($value['Year']) . '/' . Commonmodel::getModel($value['Model']);
            else
                $Vehicles .= '、' . $value['Marktxt'] . ' ' . $value['Cartxt'] . ' ' . $year . ' ' . $modeltxt;
            // $Vehicles .= '、' . Commonmodel::getMake($value['Make']) . '/' . Commonmodel::getCar($value['Car']) . '/' . Commonmodel::getYear($value['Year']) . '/' . Commonmodel::getModel($value['Model']);
        }
        //return $data;
        return $Vehicles;
    }

    private static function getOrganName($ogranID) {
        $organName = Dealer::model()->find("userID = $ogranID");
        $organInfo = array();
        $organInfo['QQ'] = $organName['QQ'];
        $organInfo['organName'] = $organName['organName'];
        $organInfo['Phone'] = $organName['Phone'];
        $organInfo['ContactPhone'] = $organName['ContactPhone'];
        return $organInfo;
    }

    // 获取品牌名称
    private static function getBrandByID($brand) {
        $organID = Commonmodel::getOrganID();
        if (!$brand) {
            return '';
        }
        $sql = "SELECT BrandName FROM `tbl_dealer_brand` WHERE ID = $brand and OrganID = $organID";
        $brands = DBUtil::query($sql);
        if ($brands) {
            return $brands['BrandName'];
        } else {
            return '';
        }
    }

}