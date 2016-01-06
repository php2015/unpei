<?php

class FinaccountController extends Controller {

    public function actionIndex() {
        $criteria = new CDbCriteria();
        $criteria->addCondition("t.Status = 0");
        $criteria->addCondition("t.OrganID = " . Yii::app()->user->getOrganID());
        $dataProvider = new CActiveDataProvider('FinancialPaypal', array(
            'criteria' => $criteria,
            'pagination' => array(
                'pageSize' => '10'
            ),
                )
        );
        $this->render('index', array('dataProvider' => $dataProvider)); //支付宝账户页面
    }

    protected function performAjaxValidation($model) {
        if (isset($_POST['ajax']) && $_POST['ajax'] === 'financial-form') {
            echo CActiveForm::validate($model);
            Yii::app()->end();
        }
    }

    /*
     * 添加支付宝账号
     */

    public function actionAddpaypal() {
        $model = new FinancialPaypal();
        $this->performAjaxValidation($model);

        $FinancialPaypal = Yii::app()->request->getParam("FinancialPaypal");
        if (isset($FinancialPaypal)) {
            $model->OwnerName = $FinancialPaypal['OwnerName'];
            $model->PaypalAccount = $FinancialPaypal['PaypalAccount'];
            $model->Uses = $FinancialPaypal['Uses'];
            $model->OrganID = Yii::app()->user->getOrganID();
            $model->UserID = Yii::app()->user->id;
            $model->CreateTime = time();
            $model->UpdateTime = time();

            if ($model->save()) {
                $this->redirect(array('index'));
            }
        }
        $this->render('addpaypal', array(
            'model' => $model,
        ));
    }

    /*
     * 修改支付宝账号
     */

    public function actionEditpaypal() {
        $id = Yii::app()->request->getParam("id");
        //添加支付宝账户
        $model = FinancialPaypal::model()->findByPk($id);
        $this->performAjaxValidation($model);

        $FinancialPaypal = Yii::app()->request->getParam("FinancialPaypal");
        if (isset($FinancialPaypal)) {
            $model->OwnerName = $FinancialPaypal['OwnerName'];
            $model->PaypalAccount = $FinancialPaypal['PaypalAccount'];
            $model->Uses = $FinancialPaypal['Uses'];
            $model->OrganID = Yii::app()->user->getOrganID();
            $model->UserID = Yii::app()->user->id;
            $model->CreateTime = time();
            $model->UpdateTime = time();

            if ($model->save()) {
                $this->redirect(array('index'));
            }
        }
        $this->render('editpaypal', array(
            'model' => $model,
        ));
    }

    /*
     * 判断支付宝账号是否已添加
     */

    public function actionIsone() {
        $OrganID = Yii::app()->user->getOrganID();
        $count = FinancialPaypal::model()->count(array("condition" => "OrganID = $OrganID AND Status = 0"));
        echo json_encode($count);
    }

    /**
     * 支付宝账号删除
     */
    public function actionDelpaypal() {

        //判断该账户是否有未完成支付宝订单
        $OrganID = Yii::app()->user->getOrganID();
        $order = PapOrder::model()->count(array(
            "condition" => "SellerID = $OrganID AND Payment = 1 AND Status = 1 AND AlipayTN != ''"
        ));
        if (empty($order)) {
            //删除支付宝账户
            $ID = Yii::app()->request->getParam("id");
            $success = FinancialPaypal::model()->deleteByPK($ID);
            if ($success) {
                $result = array('success' => 1, 'errorMsg' => '账号删除成功！');
            } else {
                $result = array('success' => 0, 'errorMsg' => '系统异常，账号删除失败！');
            }
        } else {
            $result = array('success' => 0, 'errorMsg' => '该账户还有' . $order . '条未付款的支付宝担保交易，账户删除失败！');
        }
        echo json_encode($result);
    }

    //手机发送验证码
    public function actionSendcode() {
        if (Yii::app()->request->isAjaxRequest) {
            $codename = $_POST['codename'];
            $phone = Yii::app()->user->getOrganPhone();
            $organname = Yii::app()->user->getOrganName();
            $organid = Yii::app()->user->getOrganID();
            $code = rand(100000, 999999);
            $msg = '尊敬的' . $organname . '客户，您正在通过【unipei.com】修改支付宝默认金融账户，验证码为：' . $code . '。如果不是本人操作请尽快联系嘉配客服';
            $res=F::sendSMS(array('msg'=>$msg,'phone'=>$phone));
            if ($res && $res['code'] == 0) {
                Yii::app()->redis->set($organid . '_'.$codename, $code, 120);
                echo json_encode(array('res' => 1, 'msg' => '已向' . $phone . '发送验证码,请注意查收'));
            } else {
                echo json_encode(array('res' => 0, 'msg' => '验证码发送失败!' . $res['SMS']));
            }
        }
    }

    //检验验证码是否正确
    public function actionCheckcode() {
        if (Yii::app()->request->isAjaxRequest) {
            $organid = Yii::app()->user->getOrganID();
            $code = $_POST['code'];
            $codename = $_POST['codename'];
            $rediscode = Yii::app()->redis->get($organid . '_'.$codename);
            if ($rediscode == $code) {
                echo json_encode(array('res' => 1));
            } else {
                echo json_encode(array('res' => 0, 'msg' => '验证码错误'));
            }
        }
    }

}
