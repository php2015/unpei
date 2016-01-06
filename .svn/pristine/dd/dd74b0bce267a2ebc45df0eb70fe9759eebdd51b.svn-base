<?php

/*
 * 主营信息管理
 */

class MainbusinessService {

    //查询主营品类
    public static function organidgetcpname() {
        $OrganID = Yii::app()->user->getOrganID();
        $showcpname = JpdOrganCpname::model()->findAll('OrganID=:OrganID', array(':OrganID' => $OrganID));
        return $showcpname;
    }

    //查询主营车系
    public static function organidgetvehicle() {
        $OrganID = Yii::app()->user->getOrganID();
        $showvehicle = JpdDealerVehicles::model()->findAll('OrganID=:OrganID', array(':OrganID' => $OrganID));
        return $showvehicle;
    }

    //查询主营品牌
    public static function organidgetbrand() {
        $OrganID = Yii::app()->user->getOrganID();


        $criteria = new CDbCriteria();
        $criteria->addCondition('OrganID=' . $OrganID);
        $showbrand = new CActiveDataProvider('PapBrand',
                        array(
                            'criteria' => $criteria,
                            'pagination' => array(
                                'pageSize' => '10',
                                'pageVar' => 'page'
                            ),
                ));



        return $showbrand;
    }

    //根据ID查询主营品牌
    public static function idgetbrand() {
        $ID = Yii::app()->request->getParam('ID');
        $result = PapBrand::model()->findBypk($ID);
        return $result;
    }

    //添加主营品牌
    public static function dealeraddbrand() {
        $OrganID = Yii::app()->user->getOrganID();
        $UserID = Yii::app()->user->id;
        $brands = PapBrand::model()->findAll('OrganID=:OrganID and BrandName=:BrandName', array(':OrganID' => $OrganID, ':BrandName' => Yii::app()->request->getParam('BrandName')));
        if ($brands) {
            return array('success' => 0, 'errorMsg' => '该品牌已添加');
            exit;
        }
        $Brand = new PapBrand();
        $Brand->BrandName = Yii::app()->request->getParam('BrandName');
        $Brand->Pinyin = Yii::app()->request->getParam('Pinyin');
        $Brand->Description = Yii::app()->request->getParam('Description');
        $Brand->OrganID = $OrganID;
        $Brand->UserID = $UserID;
        $Brand->CreateTime = time();
        $result = $Brand->save();
        if ($result) {
            return array('success' => 1);
        } else {
            $key = 0;
            foreach ($Brand->errors as $value) {
                if ($key == 0) {
                    $errorMsg .= $value[0];
                } else {
                    $errorMsg .= '  ' . $value[0];
                }
                $key = 1;
            }
            $errorMsg = str_replace('Description', '描述', $errorMsg);
            $errorMsg = str_replace('Brand Name', '品牌名称', $errorMsg);
            $errorMsg = str_replace('Pinyin', '拼音代码', $errorMsg);
            return array('success' => 0, 'errorMsg' => $errorMsg);
        }
    }

    //修改主营品牌
    public static function dealereditbrand() {
        $ID = Yii::app()->request->getParam('ID');
        $brand = PapBrand::model()->findBypk($ID);
        $brand->BrandName = Yii::app()->request->getParam('BrandName');
        $brand->Pinyin = Yii::app()->request->getParam('Pinyin');
        $brand->Description = Yii::app()->request->getParam('Description');
        $brand->UpdateTime = time();
        $brands = PapBrand::model()->findAll('OrganID=:OrganID and BrandName=:BrandName and ID!=:ID', array(':OrganID' => $brand->OrganID, ':BrandName' => Yii::app()->request->getParam('BrandName'), ':ID' => $ID));
        if ($brands) {
            return array('success' => 0, 'errorMsg' => '该品牌已添加');
            exit;
        }
        $result = $brand->save();
        if ($result) {
            return array('success' => 1);
        } else {
            $key = 0;
            foreach ($brand->errors as $value) {
                if ($key == 0) {
                    $errorMsg .= $value[0];
                } else {
                    $errorMsg .= '  ' . $value[0];
                }
                $key = 1;
            }
            $errorMsg = str_replace('Description', '描述', $errorMsg);
            $errorMsg = str_replace('BrandName', '品牌名称', $errorMsg);
            $errorMsg = str_replace('Pinyin', '拼音代码', $errorMsg);
            return array('success' => 0, 'errorMsg' => $errorMsg);
        }
    }

    //保存主营品类
    public static function dealeraddcpname() {
        $OrganID = Yii::app()->user->getOrganID();
        $cpname = new JpdOrganCpname();
        $cpname->BigpartsID = Yii::app()->request->getParam('BigpartsID');
        $cpname->SubCodeID = Yii::app()->request->getParam('SubCodeID');
        $cpname->CpNameID = Yii::app()->request->getParam('CpNameID');
        $cpname->BigName = Yii::app()->request->getParam('BigName');
        $cpname->SubName = Yii::app()->request->getParam('SubName');
        $cpname->CpName = Yii::app()->request->getParam('CpName');
        $cpname->OrganID = $OrganID;
        $result = $cpname->save();
        if ($result) {
            return array('result' => 1, 'ID' => $cpname->attributes['ID']);
        } else {
            $key = 0;
            foreach ($cpname->errors as $value) {
                if ($key == 0) {
                    $errorMsg .= $value[0];
                } else {
                    $errorMsg .= '  ' . $value[0];
                }
                $key = 1;
            }
            return array('result' => 0, 'errorMsg' => $errorMsg);
        }
    }

    //保存主营车系
    public static function dealeraddvehcle() {
        $OrganID = Yii::app()->user->getOrganID();
        $vehcle = new JpdDealerVehicles();
        $vehcle->Make = Yii::app()->request->getParam('Make');
        $vehcle->Car = Yii::app()->request->getParam('Car');
        $vehcle->Year = Yii::app()->request->getParam('Year');
        $vehcle->Model = Yii::app()->request->getParam('Model');
        $vehcle->OrganID = $OrganID;
        $result = $vehcle->save();
        if ($result) {
            return array('result' => 1, 'ID' => $vehcle->attributes['ID']);
        } else {
            $key = 0;
            foreach ($vehcle->errors as $value) {
                if ($key == 0) {
                    $errorMsg .= $value[0];
                } else {
                    $errorMsg .= '  ' . $value[0];
                }
                $key = 1;
            }
            return array('result' => 0, 'errorMsg' => $errorMsg);
        }
    }

    //删除主营车系
    public static function iddelvehcle() {
        $ID = Yii::app()->request->getParam('ID');
        $result = JpdDealerVehicles::model()->deleteBypk($ID);
        return array('result' => $result, 'ID' => $ID);
    }

    //删除主营品类
    public static function iddelcpname() {
        $ID = Yii::app()->request->getParam('ID');
        $result = JpdOrganCpname::model()->deleteBypk($ID);
        return array('result' => $result, 'ID' => $ID);
    }

    //删除主营品牌
    public static function iddelbrand() {
        $OrganID = Yii::app()->user->getOrganID();
        $ID = Yii::app()->request->getParam('ID');
        $model = PapGoods::model()->findAll("OrganID=:OrganID and BrandID=:BrandID", array(':OrganID' => $OrganID, 'BrandID' => $ID));
        if ($model) {
            return 'nonull';
            exit;
        }
        $result = PapBrand::model()->deleteBypk($ID);
        return $result;
    }

}

?>
