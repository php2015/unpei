<?php

class PartnerController extends Controller {
    //public $layout = '//layouts/dealer';

    /**
     * 嘉配伙伴收益分析
     * */
    /* public function actionIndex() {
      $this->pageTitle = Yii::app()->name . ' - ' . "收益分析";
      $this->render('index');
      } */

    /**
     * 查看推荐记录
     */
    public function actionShowrecommended() {
        //echo time();die;
        //if ($_POST){var_dump($_POST);die;}
        //获取表单参数
        $CompanyName = Yii::app()->request->getParam("CompanyName");
        $MobPhone = Yii::app()->request->getParam("MobPhone");
        $Email = Yii::app()->request->getParam("Email");
        $Month = Yii::app()->request->getParam("Month");
        $RecomMethod = Yii::app()->request->getParam("RecomMethod");
        $MemberStatus = Yii::app()->request->getParam("MemberStatus");

        //设置页面标题
        $this->pageTitle = Yii::app()->name . ' - ' . "推荐记录";
        $organID = Yii::app()->user->getOrganID();

        //查询语句
        $sql = 't.RecomStatus=1 and t.OrganID= ' . $organID;
        if (!empty($CompanyName)) {//机构名称
            $sql .= " and t.CompanyName like '%" . $CompanyName . "%'";
        }
        if (!empty($MobPhone)) {//手机
            $sql .= " and t.MobPhone like '%" . $MobPhone . "%'";
        }
        if (!empty($Email)) {//邮箱
            $sql .= " and t.Email like '%" . $Email . "%'";
        }
        if (!empty($Month)) {//几月前
            $sql .= " and record.RecomTime>(UNIX_TIMESTAMP(NOW())-$Month*30*24*60*60)";
        }
        if (!empty($RecomMethod)) {//推荐方式
            $sql .= " and record.RecomMethod = '$RecomMethod'";
        }
        if (!empty($MemberStatus)) {//会员状态
            $sql .= " and record.MemberStatus = " . $MemberStatus;
        }

        $criteria = new CDbCriteria();
        $criteria->select = "*";
        $criteria->with = 'record';

        $criteria->condition = $sql;
        $dataProvider = new CActiveDataProvider('RecommendList',
                        array(
                            'criteria' => $criteria,
                            'pagination' => array(
                                'pageSize' => '10'
                            ),
                ));
        $data = $dataProvider->getData();
        //无法传值到表单中    暂时用PayStatus字段保存收益
        foreach ($data as $key => $value) {
            if ($value['CompanyType'] == 1) {
                $value['CompanyType'] = '生产商';
            } elseif ($value['CompanyType'] == 2) {
                $value['CompanyType'] = '经销商';
            } else {
                $value['CompanyType'] = '服务店';
            }
        }
        $count = $dataProvider->getTotalItemCount(); //count($recmlistes);
        $this->render('showrecommended', array(
            'dataProvider' => $dataProvider,
            'count' => $count,
        ));
    }

    /**
     * 查看推荐收益
     */
    public function actionShowrecomincome() {
        $this->pageTitle = Yii::app()->name . ' - ' . "营销收益";
        $organID = Yii::app()->user->getOrganID();

        $income = RecommendIncome::model()->findAll('OrganID=:OrganID and Year=:Year', array(':OrganID' => $organID, ':Year' => date("Y")));
        //年收益总额
        $yearin = 0;
        $month = date("m") - 1;
        foreach ($income as $val) {
            $yearin += $val['MonthIncome'];
            if ($month == $val['Month']) {
                //获取上月收益和收益接收账户
                $monthin = $val['MonthIncome'];
                $IncomeAccount = $val['IncomeAccount'];
            }
        }

        $criteria = new CDbCriteria();
        $criteria->select = "*";
//        $criteria->with = 'list';
        $criteria->addCondition('t.OrganID = ' . $organID);
        $datetime = time();
        $startdate = date('Y-m', $datetime);
        $startdate = strtotime($startdate);
        $enddate = strtotime("+1 month", $startdate);
        $criteria->addBetweenCondition('IncomeTime', $startdate, $enddate);
        $criteria->addCondition('t.OrganID = ' . $organID);
        //获取表单提交数据
        $CompanyName = Yii::app()->request->getParam('CompanyName');
        $MobPhone = Yii::app()->request->getParam('MobPhone');
        $Email = Yii::app()->request->getParam('Email');
        $sql_search='';
        if (!empty($CompanyName)) {//机构名称
        $sql_search.=' and OrganName like "%'.$CompanyName.'%" ';
//            $criteria->addSearchCondition('list.CompanyName', "{$CompanyName}");
        }
        if (!empty($MobPhone)) {//手机
        $sql_search.=' and  Phone like "%'.$MobPhone.'%" ';
//            $criteria->addSearchCondition('list.MobPhone', "{$MobPhone}");
        }
        if (!empty($Email)) {//邮箱
        $sql_search.=' and Email like "%'.$Email.'%" ';
//            $criteria->addSearchCondition('list.Email', "{$Email}");
        }
        if(!empty($sql_search)){
            $searhID='select ID from jpd_organ where 1=1'.$sql_search;
            $resultID=Yii::app()->jpdb->createCommand($searhID)->queryAll();
           
            if(!empty($resultID)){
                $explode=array();
                foreach ($resultID as $vvv){
                    $explode[]=$vvv['ID'];
                }
                $criteria->addInCondition('ServiceID',$explode);
            }else{
                 $criteria->addCondition('1>2');
            }
        }
        $dataProvider = new CActiveDataProvider('RecommendIncomeDetail',
                        array(
                            'criteria' => $criteria,
                            'pagination' => array(
                                'pageSize' => '10'
                            ),
                ));
        //获取支付宝账户
        $sql_are='select PaypalAccount from jpd_financial_paypal where OrganID='.$organID;
        $result_are=Yii::app()->jpdb->createCommand($sql_are)->queryRow();
        if($result_are){ $IncomeAccount= $result_are['PaypalAccount'];}
        $this->render('showrecomincome', array(
            'dataProvider' => $dataProvider,
            'yearin' => $yearin,
            'monthin' => $monthin,
            'IncomeAccount' => $IncomeAccount
        ));
    }

    /*
     * 收益详情
     */

    public function actionShowDetail() {
        //$endmoth = strtotime(date('Y-m'));
        $ServiceID = Yii::app()->request->getParam('ServiceID');
        $organID = Yii::app()->user->getOrganID();
        //收益百分比   暂无
        $discountRate = Settings::getValue("discountRate");
        //$discountRate = 0.02;
        $record = RecommendRecord::model()->find("DealerID=:DealerID and ServiceID=:ServiceID", array(":DealerID" => $organID, ":ServiceID" => $ServiceID));
        $criteria = new CDbCriteria;
        $criteria->select = '*';
        $criteria->addCondition('Status=9');
        $startdate = date('Y-m', time());
        $startdate = strtotime($startdate);
        $enddate = strtotime("-1 month", $startdate);
        $criteria->addBetweenCondition('ReceiptTime', $enddate, $startdate);
        //$criteria->addCondition("ReceiptTime<" . $endmoth);
        $criteria->addCondition("BuyerID=" . $ServiceID);
        if (empty($record)) {
            $criteria->addCondition("SellerID=" . $organID);
        } else {
            $criteria->addCondition("SellerID!=" . $organID);
        }

        $dataProvider = new CActiveDataProvider('Order',
                        array(
                            'criteria' => $criteria,
                            'pagination' => array(
                                'pageSize' => '10'
                            ),
                ));
        $data = $dataProvider->getData();
        //无法传值到表单中    暂时用PayStatus字段保存收益
        foreach ($data as $key => $value) {
            $data[$key]['PayStatus'] = round($data[$key]['RealPrice'] * $discountRate, 2);
            if ($data[$key]['SellerID'] == $organID) {
                $data[$key]['PayStatus'] = '-' . $data[$key]['PayStatus'];
            }
        }

        //var_dump($dataProvider);die;

        $this->render('showorderdetail', array(
            'dataProvider' => $dataProvider
        ));
    }

}

?>
