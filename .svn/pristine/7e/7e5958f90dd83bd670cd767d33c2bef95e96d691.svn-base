<?php

/*
 * 登录首页服务、联盟、嘉配介绍
 * 
 */

class IntroduceController extends Controller {

    public $layout = '//layouts/introduce';
    public $defaultAction = 'join';

    public function filters() {
        return array();
    }

    //产品与服务介绍
    public function actionService() {
        $this->render('service');
    }

    //经销商联盟介绍
    public function actionUnion() {
        //获取经销商列表
        $list = $this->getdealer();
        $this->render('union', array('list' => $list));
    }

    //加入联盟
    public function actionJoin() {
        $this->render('join');
    }

    //获取经销商数据
    public function getdealer() {
        $sql = 'select jg.ID,jg.OrganName,TelPhone from `jpd_organ` jg,`jpd_user` ju';
        $where = ' where jg.Identity=2 and jg.IsBlack="0" and jg.IsFreeze="0" and jg.Status="1"';
        $where.=' and jg.ID=ju.OrganID and ju.IsMain="1"';
        //显示山东汽配联盟
        $where.=' and jg.UnionID=1';
        $sqlcount = 'select count(*)  from `jpd_organ` jg,`jpd_user` ju'. $where;
        $count = Yii::app()->jpdb->createCommand($sqlcount)->queryScalar();
        $sql.=$where . ' order by Sort asc';
        $dealer = new CSqlDataProvider($sql, array(
            'db' => Yii::app()->jpdb,
            'totalItemCount' => $count,
            'pagination' => array(
                'pageSize' => $count,
            ),
                )
        );
        $datas = $dealer->getData();
        $list = array();
        foreach ($datas as $key => $val) {
            $a = array();
            $b = array();
            $list[$key]['OrganName'] = $val['OrganName'];
            $sql_brand = 'select a.BrandName from pap_brand as a,pap_dealer_brand as b where b.OrganID=' . $val['ID'] . ' and b.BrandID=a.ID';
            $brand = Yii::app()->papdb->createCommand($sql_brand)->queryAll();
            $brand_str = "";
            foreach ($brand as $k => $v) {
                if ($v['BrandName'] === null) {
                    continue;
                }
                $a[] = $v['BrandName'];
            }
            if ($a) {
                $brand_str = implode(',', $a);
                $list[$key]['brand'] = '<a title="' . $brand_str . '">' . $brand_str . '</a>';
            } else {
                $list[$key]['brand'] = '';
            }
            $vehicles = DealerVehicles::model()->findAll('OrganID=:organ', array(':organ' => $val['ID']));
            $str = "";
            foreach ($vehicles as $k => $v) {
                $car = $v['Make'];
                if ($v['Car']) {
                    $car .= ' ' . $v['Car'];
                    $car .= ' ' . '全年款';
                } else {
                    $car .= ' ' . '全车系';
                }
                $b[] = $car;
            }
            if ($b) {
                $str = implode(',', $b);
                $list[$key]['vehicles'] = '<a title="' . $str . '">' . $str . '</a>';
            } else {
                $list[$key]['vehicles'] = '数据更新中...';
            }
            if ($val['TelPhone']) {
                $phone = explode(',', $val['TelPhone']);
                $list[$key]['TelPhone'] = $phone[0] . '<br>' . $phone[1];
            } else {
                $list[$key]['TelPhone'] = '暂无';
            }
        }
        $dealer->setData($list);
        return $dealer;
    }

    //获取城市列表
    public function actionCity() {
        if ($_GET['province']) {
            $data = Area::model()->findAll("ParentID=:parent_id", array(":parent_id" => $_GET['province']));

            $data = CHtml::listData($data, "ID", "Name");

            foreach ($data as $value => $name) {
                echo CHtml::tag("option", array("value" => $value), CHtml::encode($name), true);
            }
        }
        if (empty($_GET['province'])) {
            echo CHtml::tag("option", array("value" => ''), '请选择城市', true);
        }
    }

    //获取地区列表
    public function actionArea() {
        if ($_GET["city"]) {
            $data = Area::model()->findAll("ParentID=:parent_id", array(":parent_id" => $_GET["city"]));

            $data = CHtml::listData($data, "ID", "Name");

            foreach ($data as $value => $name) {
                echo CHtml::tag("option", array("value" => $value), CHtml::encode($name), true);
            }
        }
        if (empty($_GET["city"])) {
            echo CHtml::tag("option", array("value" => ''), '请选择地区', true);
        }
    }

    //添加经销商、服务店申请
    public function actionAddapply() {
        if (Yii::app()->request->isPostRequest) {
            $time = $_SERVER['REQUEST_TIME'];
            $type = Yii::app()->request->getParam('type');
            if ($type == 1) {
                $model = new JpdApplyDealer;
                $types = '经销商';
            } else {
                $model = new JpdApplyService;
                $types = '修理厂';
            }
            $model->attributes = $_POST;
            $model->CreateTime = $time;
            $model->UpdateTime = $time;
            if ($type == 2) {
                $model->Province = Yii::app()->request->getParam('Province_s');
                $model->City = Yii::app()->request->getParam('City_s');
                $model->Area = Yii::app()->request->getParam('Area_s');
            }
            if ($model->save()) {
                echo json_encode(array('res' => 1));
                $subject = '由你配提醒您';
                $email = QuotationService::getsysparam('apply_remind_email');
                if (!$email) {
                    $email = Yii::app()->params->sendEmail['email'];
                } else {
                    $email=  array_filter(explode(',', $email));
                }
                $message = '<p>有用户申请加入unipei系统，申请人信息如下:</p><table>
                <tr><td>身份：</td><td>' . $types . '</td></tr>
                <tr><td>机构名称：</td><td>' . $model->OrganName . '</td></tr>
                <tr><td>店铺人数：</td><td>' . $model->StaffNum . '</td></tr>';
                if ($type == 1) {
                    $message.='<tr><td>主营品牌：</td><td>' . $model->Brand . '</td></tr>
                    <tr><td>主营车系：</td><td>' . $model->CarModel . '</td></tr>';
                } elseif ($type == 2) {
                    $message.='<tr><td>技师人数：</td><td>' . $model->TechnicianNum . '</td></tr>
                               <tr><td>工位数：</td><td>' . $model->PositionNum . '</td></tr>';
                }
                $message.='                   
                <tr><td>申请人姓名：</td><td>' . $model->Name . '</td></tr>
                <tr><td>手机：</td><td>' . $model->Phone . '</td></tr>
                <tr><td>固定电话：</td><td>' . $model->TelPhone . '</td></tr>
                <tr><td>联系邮箱：</td><td>' . $model->Email . '</td></tr>
                <tr><td>QQ：</td><td>' . $model->QQ . '</td></tr>
                <tr><td>机构所在省：</td><td>' . Area::getdatabyid($model->Province) . '</td></tr>
                <tr><td>机构所在市：</td><td>' . Area::getdatabyid($model->City) . '</td></tr>
                <tr><td>机构所在区：</td><td>' . Area::getdatabyid($model->Area) . '</td></tr>
                <tr><td>机构所在街道：</td><td>' . $model->Address . '</td></tr>
                <tr><td>申请时间：</td><td>' . date('Y-m-d H:i:s', $time) . '</td></tr>';
                $message.='</table>';
                UserModule::sendMail($email, $subject, $message);
            } else {
                echo json_encode($model->errors);
            }
        }
    }

    //申请成功页面
    public function actionSuccess() {
        $this->render('success');
    }

}

?>
