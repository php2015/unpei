<?php

class PromitdealerController extends Controller {

    public $layout = '//layouts/maker';

    public function actionIndex() {
//        $dealer = Dealer::model()->findAll();
        $this->render('index');
    }

    public function actionIndexdata() {
        $criteria = new CDbCriteria;
        $criteria->select = 'ID,DealerID,BrandName,PromitArea,Level,CustomerType,Settlement';
        $criteria->addCondition('OrganID=' . Commonmodel::getOrganID());
        if (!empty($_GET['PromitArea'])) {
            $criteria->addSearchCondition('PromitArea', ',' . $_GET['PromitArea'] . ',');
        }
        if (!empty($_GET['BrandName'])) {
            // $arr=  MakeGoodsBrand::model()->find('BrandName='.'"'.$_POST['BrandName'].'"');
            $criteria->addSearchCondition('BrandName', ',' . $_GET['BrandName'] . ',');
        }
        if (!empty($_GET['organName'])) {
            $sql = 'SELECT userID FROM `tbl_dealer` where organName LIKE ' . '"%' . $_GET['organName'] . '%"';
            $arr2 = Yii::app()->db->createCommand($sql)->queryAll();
            $userIDs = array();
            if ($arr2)
                foreach ($arr2 as $v) {
                    $userIDs[] = $v['userID'];
                }
            $criteria->addInCondition('DealerID', $userIDs);
        }
        if (!empty($_GET['Level'])) {
            $level = $_GET['Level'];
            $level = '"' . $level . '"';
            $criteria->addCondition('level=' . $level);
        }
        if (!empty($_GET['Phone'])) {
            $QQ = 'select userID from tbl_dealer  where Phone like "%' . $_GET['Phone'] . '%"';
            $apple = Yii::app()->db->createCommand($QQ)->queryAll();
            $phonein = array();
            if ($apple) {
                foreach ($apple as $ke) {
                    $phonein[] = $ke['userID'];
                }
            }
            $criteria->addInCondition('DealerID', $phonein);
//            $arr3 = Dealer::model()->find('Phone=' . $_GET['Phone']);
//            $criteria->addCondition('dealerID=' . $arr3->userID);
        }
        $criteria->order = 'CreateTime desc';
        $res = MakePromitBrand::model()->findAll($criteria);
        $count = count($res);
        $page = new CPagination($count);
        $page->pageSize = $_GET['rows'];
        $page->applyLimit($criteria);
        $res = MakePromitBrand::model()->findAll($criteria);
        $data = array();
        if ($res) {
            foreach ($res as $key => $val) {
                $data[$key] = $val->attributes;
                $data[$key]['name'] = $val->BrandName;
                $data[$key]['provice'] = $val->PromitArea;
                $data[$key]['BrandName'] = $this->Getbrand($val->BrandName);
                $data[$key]['PromitArea'] = $this->Getarea($val->PromitArea);
                if (!empty($val->CustomerType)) {
                    $data[$key]['Category'] = $this->Gettype($val->CustomerType);
                }
                if (!empty($val->Settlement)) {
                    $data[$key]['Payment'] = $this->Getpayment($val->Settlement);
                }
                $app = '';
                $app = Dealer::model()->find('userID=' . $val->DealerID);
                $data[$key]['organName'] = $app->organName;
                $data[$key]['Phone'] = $app->Phone;
            }
        }
        echo json_encode(array('total' => $count, 'rows' => $data));
    }

    //经销商table数据
    public function actionGetdealers() {
        $criteria = new CDbCriteria;
        $criteria->select = 'userID,organName,Phone';
        if (!empty($_GET['Pinyin'])) {
            $criteria->addSearchCondition('Pinyin', $_GET['Pinyin']);
        }
        $criteria2 = new CDbCriteria;
        $criteria2->select = 'DealerID';
        $criteria2->addCondition('OrganID=' . Commonmodel::getOrganID());
        $criteria2->distinct = true;
        $result = MakePromitBrand::model()->findAll($criteria2);
        $userIDs = array();
        if ($result) {
            foreach ($result as $vel) {
                $userIDs[] = $vel->DealerID;
            }
        }
        $criteria->addNotInCondition('userID', $userIDs);
        if (!empty($_GET['Pinyin'])) {
            
        }
        $res = Dealer::model()->findAll($criteria);
        $count = count($res);
        $page = new CPagination($count);
        $page->pageSize = $_GET['rows'];
        $page->applyLimit($criteria);
        $res = Dealer::model()->findAll($criteria);
        $data = array();
        if ($res) {
            foreach ($res as $v) {
                $data[] = $v->attributes;
            }
        }
        echo json_encode(array('total' => $count, 'rows' => $data));
    }

    //获取经销商信息
    public function actionDealerinfo() {
        if ($_GET['userID']) {
            $arr = Dealer::model()->find('userID=' . $_GET['userID']);
            echo json_encode($arr->attributes);
        }
    }

    //添加修改授权
    public function actionEditpromit() {
        $data = $_POST['hide'];
        $OrganID = Commonmodel::getOrganID();
        $newType = MakeType::model()->find(array("condition" => "OrganID = $OrganID AND ID = {$data['CustomerType']}"));
        $newCount = $newType['TypeQuantity'];
        $PromitBrand = MakePromitBrand::model()->findByPk($data['ID']);
        if ($PromitBrand['CustomerType']) {
            $oldType = MakeType::model()->find(array("condition" => "OrganID = $OrganID AND ID = {$PromitBrand['CustomerType']}"));
            $oldCount = $oldType['TypeQuantity'];
        }
        $messager = '';
        $success = false;
        if ($data['ID']) {
            $data['UpdateTime'] = time();
            $result = MakePromitBrand::model()->updateByPK($data['ID'], $data);
            if ($result) {
                //修改客户类别管理中客户数  添加客户类别数
                MakeType::model()->updateAll(array(
                    "TypeQuantity" => $newCount + 1,
                    "UpdateTime" => time()
                        ), array("condition" => "OrganID = $OrganID AND ID = {$data['CustomerType']}"));
                if ($oldCount != 0) {
                    //修改客户类别管理中客户数  减少客户类别数
                    MakeType::model()->updateAll(array(
                        "TypeQuantity" => $oldCount - 1,
                        "UpdateTime" => time()
                            ), array("condition" => "OrganID = $OrganID AND ID = {$PromitBrand['CustomerType']}"));
                }
                $success = true;
                $messager = '修改成功';
            } else {
                $messager = '修改失败';
            }
        } else {
            $app = new MakePromitBrand;
            $app->attributes = $_POST['hide'];
            $app->CreateTime = time();
            $app->OrganID = Commonmodel::getOrganID();
            $app->UserID = Yii::app()->user->id;
            if ($app->save()) {
                //修改客户类别管理中客户数
                MakeType::model()->updateAll(array(
                    "TypeQuantity" => $newCount + 1,
                    "UpdateTime" => time()
                        ), array("condition" => "OrganID = $OrganID AND ID = {$data['CustomerType']}"));
                $success = true;
                $messager = '保存成功';
            } else {
                $messager = '保存失败';
            }
        }
        echo json_encode(array('success' => $success, 'messager' => $messager));
    }

    //删除授权
    public function actionDelpromit() {
        $OrganID = Commonmodel::getOrganID();
        if (!empty($_POST['ids'])) {

            $ids = explode(',', $_POST['ids']);
            $ids = array_filter($ids);
            $count = count($ids);
            $i = 0;
            if (is_array($ids)) {
                foreach ($ids as $v) {
                    $PromitBrand = MakePromitBrand::model()->findByPk($v);
                    $result = MakePromitBrand::model()->deleteByPK($v);

                    if ($PromitBrand['CustomerType']) {
                        $oldType = MakeType::model()->find(array("condition" => "OrganID = $OrganID AND ID = {$PromitBrand['CustomerType']}"));
                        $oldCount = $oldType['TypeQuantity'];
                        MakeType::model()->updateAll(array(
                            "TypeQuantity" => $oldCount - 1,
                            "UpdateTime" => time()
                                ), array("condition" => "OrganID = $OrganID AND ID = {$PromitBrand['CustomerType']}"));
                    }

                    if ($result) {
                        $i = $i + $result;
                    }
                }
            }
            $messager = '';
            //   if ($count == $i) {
            if ($i) {
                $messager = '删除成功';
            } else {
                $messager = '删除失败';
            }
            echo json_encode($messager);
        }
    }

    //获取生产商的折扣率
    public function actionGetpriceinfo() {
        $arr = MakePromitPrice::model()->find('OrganID=' . Commonmodel::getOrganID());
        $price = array('A' => $arr->LevelA, 'B' => $arr->LevelB, 'ID' => $arr->ID);
        echo json_encode($price);
    }

    //修改生产商的折扣率
    public function actionEditprice() {
        $res = 0;
        if (!empty($_POST['ID'])) {
            $_POST['UpdateTime'] = time();
            $res = MakePromitPrice::model()->updateByPK($_POST['ID'], $_POST);
        } else {
            $arr = new MakePromitPrice;
            $arr->attributes = $_POST;
            $arr->CreateTime = time();
            $arr->OrganID = Commonmodel::getOrganID();
            $arr->UserID = Yii::app()->user->id;
            $res = $arr->save();
        }
        echo $res;
    }

    public function Getbrand($data) {
        $ids = explode(',', $data);
        $ids = array_filter($ids);
        $substr = '';
        if (is_array($ids)) {
            foreach ($ids as $v) {
                $app = MakeGoodsBrand::model()->find('BrandID=' . $v);
                if ($substr)
                    $substr.=',' . $app->BrandName; //$substr.().',';
                else
                    $substr.=$app->BrandName;
            }
            $substr = '<a title="' . $substr . '">' . $substr . '</a>';
        }
        return $substr;
    }

    //获取品牌
    public function Getarea($data) {
        $ids = explode(',', $data);
        $ids = array_filter($ids);
        $substr = '';
        if (is_array($ids)) {
            foreach ($ids as $v) {
                if ($substr)
                    $substr .= ',' . $this->showCity($v);
                else
                    $substr .= $this->showCity($v);
            }
            $substr = '<a title="' . $substr . '">' . $substr . '</a>';
        }
        return $substr;
    }

    public function showCity($id) {
        $model = Area::model()->find("id=:id", array(":id" => $id));
        return $model['name'];
    }

    /*
     * 获取客户类别
     */

    public function Gettype($type) {
        $OrganID = Commonmodel::getOrganID();
        $model = MakeType::model()->find(array(
            "condition" => "OrganID = $OrganID AND ID = $type"
                ));
        return $model['TypeName'];
    }

    /*
     * 获取结算方式
     */

    public function Getpayment($payment) {
        switch ($payment) {
            case '1': return "支付宝担保";
                break;
            case '2': return "物流代收款";
                break;
            case '3': return "月结";
                break;
            case '4': return "预付款";
                break;
            case '5': return '打款再提货';
                break;
        }
    }

    public function actionGetType() {
        $type_data = MakeType::model()->findAll(array("condition" => "OrganID = " . Commonmodel::getOrganID() ));//. " AND IsDefault = 0"
        foreach ($type_data as $key => $type) {
            $data[$key]['ID'] = $type->ID;
            $data[$key]['TypeName'] = $type->TypeName;
        }
        echo json_encode($data);
    }
}

?>
