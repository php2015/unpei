<?php

class EpcModelTempController extends Controller {

    /**
     * @var string the default layout for the views. Defaults to '//layouts/column2', meaning
     * using two-column layout. See 'protected/views/layouts/column2.php'.
     */
    public $layout = '//layouts/jpdata';

    /**
     * Lists all models.
     */
    public function actionIndex() {
        $model = new EpcModelTemp('create');
        $this->render('index', array(
            'model' => $model,
        ));
    }

    /**
     * Displays a particular model.
     * @param integer $id the ID of the model to be displayed
     */
    public function actionList() {
        $criteria = new CDbCriteria();
        //$criteria->index = "id";
        $criteria->order = "id desc";
        $count = EpcModelTemp::model()->count($criteria);
        $pages = new CPagination($count);
        $pages->pageSize = $_GET['rows'];
        $pages->applyLimit($criteria);
        //EpcModelTemp::model()->scenario='list';
        $models = EpcModelTemp::model()->findAll($criteria);
        // 转换成数组
        $rows = array();
        foreach ($models as $model) {
            $rows[] = $model->attributes;
        }
        $rs = array('total' => $count, 'rows' => $rows);
        echo CJSON::encode($rs);
    }

    /**
     * Displays a particular model.
     * @param integer $id the ID of the model to be displayed
     */
    public function _actionView($id) {
        $this->render('view', array(
            'model' => $this->loadModel($id),
        ));
    }

    /**
     * Creates a new model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     */
    public function actionCreate() {
        $model = new EpcModelTemp('create');
        $action = 'epc/model';
        $form = Yii::app()->request->getParam('form');

        if (isset($_POST['EpcModelTemp'])) {
            $model->attributes = $_POST['EpcModelTemp'];
            $imageUploadFile = CUploadedFile::getInstance($model, 'fileName');
            if ($imageUploadFile !== null) { // only do if file is really uploaded
                $imageFileExt = $imageUploadFile->extensionName;

                $save_path = dirname(Yii::app()->basePath) . '/upload/' . $action . '/';
                if (!file_exists($save_path)) {
                    mkdir($save_path, 0777, true);
                }
                $ymd = date("Ymd");
                $save_path .= $ymd . '/';
                if (!file_exists($save_path)) {
                    mkdir($save_path, 0777, true);
                }
                $img_prefix = date("YmdHis") . '_' . rand(10000, 99999);
                $imageFileName = $img_prefix . '.' . $imageFileExt;
                $model->fileName = $imageFileName;
                $model->filePath = 'upload/' . $action . '/' . $ymd;
                $save_path .= $imageFileName;
            }

            if ($model->save()) {

                if ($imageUploadFile !== null) { // validate to save file
                    $imageUploadFile->saveAs($save_path);
                }
                echo 'success';
                die;
                Yii::app()->user->setFlash('success', "提交成功");
                $this->redirect(array('parts/index'));

                //Yii::app()->end();
            } 
        }
        //这是一段,在显示后定里消失的JQ代码,已集成至Yii中.
//        Yii::app()->clientScript->registerScript(
//        );
        Yii::app()->clientScript->scriptMap['jquery.js'] = false;
        Yii::app()->clientScript->scriptMap['jquery.min.js'] = false;

        $this->renderPartial('_form', array(
            'action' => Yii::app()->createUrl('jpdata/epcModelTemp/create'),
            'model' => $model,
                ), false, true);
    }

    /**
     * Updates a particular model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id the ID of the model to be updated
     */
    public function _actionUpdate($id) {
        $model = $this->loadModel($id);

        // Uncomment the following line if AJAX validation is needed
        // $this->performAjaxValidation($model);

        if (isset($_POST['EpcModelTemp'])) {
            $model->attributes = $_POST['EpcModelTemp'];
            if ($model->save())
                $this->redirect(array('view', 'id' => $model->id));
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
    public function _actionDelete($id) {
        if (Yii::app()->request->isPostRequest) {
            // we only allow deletion via POST request
            $this->loadModel($id)->delete();

            // if AJAX request (triggered by deletion via admin grid view), we should not redirect the browser
            if (!isset($_GET['ajax']))
                $this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('admin'));
        }
        else
            throw new CHttpException(400, 'Invalid request. Please do not repeat this request again.');
    }

    /**
     * Manages all models.
     */
    public function _actionAdmin() {
        $model = new EpcModelTemp('search');
        $model->unsetAttributes();  // clear any default values
        if (isset($_GET['EpcModelTemp']))
            $model->attributes = $_GET['EpcModelTemp'];

        $this->render('admin', array(
            'model' => $model,
        ));
    }

    /**
     * Returns the data model based on the primary key given in the GET variable.
     * If the data model is not found, an HTTP exception will be raised.
     * @param integer the ID of the model to be loaded
     */
    public function loadModel($id) {
        $model = EpcModelTemp::model()->findByPk($id);
        if ($model === null)
            throw new CHttpException(404, 'The requested page does not exist.');
        return $model;
    }

    /**
     * Performs the AJAX validation.
     * @param CModel the model to be validated
     */
    protected function performAjaxValidation($model) {
        if (isset($_POST['ajax']) && $_POST['ajax'] === 'epc-model-temp-form') {
            echo CActiveForm::validate($model);
            Yii::app()->end();
        }
    }

}
