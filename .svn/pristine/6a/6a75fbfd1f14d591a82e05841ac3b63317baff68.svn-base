<?php

class HotwordController extends Controller {

    /**
     * @var string the default layout for the views. Defaults to '//layouts/column2', meaning
     * using two-column layout. See 'protected/views/layouts/column2.php'.
     */
    public $layout = '//layouts/cms';

    /**
     * @return array action filters
     */
    public function filters() {
        return array(
            'accessControl', // perform access control for CRUD operations
            'postOnly + delete', // we only allow deletion via POST request
        );
    }

    /**
     * Specifies the access control rules.
     * This method is used by the 'accessControl' filter.
     * @return array access control rules
     */
    public function accessRules() {
        return array(
            array('allow', // allow all users to perform 'index' and 'view' actions
                'actions' => array('index', 'view'),
                'users' => array('*'),
            ),
            array('allow', // allow authenticated user to perform 'create' and 'update' actions
                'actions' => array('create', 'update', 'updateall', 'updatealls'),
                'users' => array('@'),
            ),
            array('allow', // allow admin user to perform 'admin' and 'delete' actions
                'actions' => array('admin', 'delete'),
                'users' => array('admin'),
            ),
            array('deny', // deny all users
                'users' => array('*'),
            ),
        );
    }

    /**
     * Displays a particular model.
     * @param integer $id the ID of the model to be displayed
     */
    public function actionView($id) {
        $this->render('view', array(
            'model' => $this->loadModel($id),
        ));
    }

    /**
     * Creates a new model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     */
    public function actionCreate() {
        $model = new PapHotWord;

        // Uncomment the following line if AJAX validation is needed
        // $this->performAjaxValidation($model);

        if (isset($_POST['PapHotWord'])) {
            $model->attributes = $_POST['PapHotWord'];
            if ($model->save())
                $this->redirect(array('view', 'id' => $model->ID));
        }

        $this->render('create', array(
            'model' => $model,
        ));
    }

    /**
     * Updates a particular model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id the ID of the model to be updated
     */
    public function actionUpdate($id) {
        $model = $this->loadModel($id);

        // Uncomment the following line if AJAX validation is needed
        // $this->performAjaxValidation($model);

        if (isset($_POST['PapHotWord'])) {
            $model->attributes = $_POST['PapHotWord'];
            if ($model->save())
                $this->redirect(array('view', 'id' => $model->ID));
        }

        $this->render('update', array(
            'model' => $model,
        ));
    }

    /**
     * Deletes a particular model.
     * If deletion is successful, the browser will be redirected to the 'admin' page.
     * @param integer $id the ID of the model to be deleted
     */
    public function actionDelete($id) {
        $this->loadModel($id)->delete();

        // if AJAX request (triggered by deletion via admin grid view), we should not redirect the browser
        if (!isset($_GET['ajax']))
            $this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('admin'));
    }

    /**
     * Lists all models.
     */
    public function actionIndex() {
        $model = new PapHotWord('search');
        $model->unsetAttributes();  // clear any default values
        if (isset($_GET['PapHotWord']))
            $model->attributes = $_GET['PapHotWord'];

        $this->render('admin', array(
            'model' => $model,
        ));
    }

    /**
     * Manages all models.
     */
    public function actionAdmin() {
        $model = new PapHotWord('search');
        $model->unsetAttributes();  // clear any default values
        if (isset($_GET['PapHotWord']))
            $model->attributes = $_GET['PapHotWord'];

        $this->render('admin', array(
            'model' => $model,
        ));
    }

    /**
     * Returns the data model based on the primary key given in the GET variable.
     * If the data model is not found, an HTTP exception will be raised.
     * @param integer $id the ID of the model to be loaded
     * @return PapHotWord the loaded model
     * @throws CHttpException
     */
    public function loadModel($id) {
        $model = PapHotWord::model()->findByPk($id);
        if ($model === null)
            throw new CHttpException(404, 'The requested page does not exist.');
        return $model;
    }

    /**
     * Performs the AJAX validation.
     * @param PapHotWord $model the model to be validated
     */
    protected function performAjaxValidation($model) {
        if (isset($_POST['ajax']) && $_POST['ajax'] === 'pap-hot-word-form') {
            echo CActiveForm::validate($model);
            Yii::app()->end();
        }
    }

    protected function pinyin($name) {
        $pinyin = new Pinyin($name);
        $py = $pinyin->full();
        return $py;
    }

    protected function getBrand($code) {
        $b_sql = 'select distinct(b.BrandName),a.BrandID,b.Pinyin
               from pap_goods a,pap_brand b where a.StandCode="' . $code . '" 
               and a.IsSale=1 and a.ISdelete=1 and a.BrandID=b.ID group by b.BrandName';
        $res = Yii::app()->papdb->createCommand($b_sql)->queryAll();
        return $res;
    }

    public function actionUpdatealls() {
        $t1 = microtime(true);
        $sql = "select Code,PinYin,Name from jpd_gcategory where Code!='' and IsShow=1";
        $insql = 'insert into pap_hot_word(`key`,`value`,`order`) values ';
        $vsql = '';
        $res = Yii::app()->jpdb->createCommand($sql)->queryAll();
        $count = 0;
        foreach ($res as $key => $value) {
            $pin = $this->pinyin($value['Name']);
            //拼音首字母
            if ($this->check($value['Name'], $value['Name'])) {
                $vsql.='("' . $value['PinYin'] . '","' . $value['Name'] . '",2),';
                $vsql.='("' . $pin . '","' . $value['Name'] . '",2),';
                $vsql.='("' . $value['Name'] . '","' . $value['Name'] . '",2),';
            }

            $brand = $this->getBrand($value['Code']);
            foreach ($brand as $k => $v) {
                $piny = $this->pinyin($v['BrandName']);
                //品牌
                if ($this->check($v['BrandName'], $v['BrandName'])) {
                    $vsql.='("' . $v['Pinyin'] . '","' . $v['BrandName'] . '",3),';
                    $vsql.='("' . $piny . '","' . $v['BrandName'] . '",3),';
                    $vsql.='("' . $v['BrandName'] . '","' . $v['BrandName'] . '",3),';
                }

                //配件名称 + 品牌
                if ($this->check($value['Name'] . ' ' . $v['BrandName'], $value['Name'] . ' ' . $v['BrandName'])) {
                    $vsql.='("' . $value['PinYin'] . ' ' . $v['Pinyin'] . '","' . $value['Name'] . ' ' . $v['BrandName'] . '",4),';
                    $vsql.='("' . $pin . ' ' . $piny . '","' . $value['Name'] . ' ' . $v['BrandName'] . '",4),';
                    $vsql.='("' . $value['Name'] . ' ' . $v['BrandName'] . '","' . $value['Name'] . ' ' . $v['BrandName'] . '",4),';
                }
            }
            $exesql = $insql . rtrim($vsql, ',');
            if ($vsql) {
                $count+=Yii::app()->papdb->createCommand($exesql)->execute();
                $vsql = '';
            }
//            if ($key % 500 == 0 && $key > 0&&$vsql) {
//                $exec = 1;
//                $exesql = $insql . rtrim($vsql, ',');
//                $count+=Yii::app()->papdb->createCommand($exesql)->execute();
//                $vsql = '';
//            }
        }
//        if ($exec == 0 && $vsql) {
//            $exesql = $insql . rtrim($vsql, ',');
//            $count+=Yii::app()->papdb->createCommand($exesql)->execute();
//        }
        if ($count) {
            echo json_encode(array('success' => 1, 'message' => '执行成功'));
        }else{
            echo json_encode(array('success' => 0, 'message' => '没有新数据'));
        }
//        $t2 = microtime(true);
//        echo '耗时' . round($t2 - $t1, 3) . '秒。';
//        echo '共插入' . $count . '条数据';
    }

    public function check($key, $value) {
        $sql = 'select ID from `pap_hot_word` where `key`="' . $key . '" and `value`="' . $value . '"';
        $res = Yii::app()->papdb->createCommand($sql)->queryRow();
        if ($res)
            return 0;
        else
            return 1;
    }

}
