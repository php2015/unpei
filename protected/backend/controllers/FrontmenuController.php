<?php

class FrontmenuController extends Controller {

    public $layout = '//layouts/system';
    protected $uploadArr = array("Icon", "ActiveIcon", "MenuIcon");

    public function actionView($id) {
        $this->render('view', array(
            'model' => $this->loadModel($id),
        ));
    }

    public function uploadIcon($file) {
        $filename = $file->getName();          //获取文件名    
        $filename = F::random_filename() . '.' . pathinfo($filename, PATHINFO_EXTENSION);
        $filesize = $file->getSize();                 //获取文件大小  
        $filetype = $file->getType();                //获取文件类型    
        $filePath = Yii::app()->params->uploadPath . "tmp/";
        if (!file_exists($filePath)) {
            mkdir($filePath, 0777);
        }
        if ($file->saveAs($filePath . $filename, true)) {
            $ftpsavepath = 'common/frontmenu/';
            $ftp = new Ftp();
            $res = $ftp->uploadfile($filePath . $filename, $ftpsavepath . $filename);
            $ftp->close();
            if ($res['success']) {
                @unlink($filePath . $filename);
                return $filename;
            } else {
                var_dump($res);
                die;
            }
        }
    }

    /**
     * Creates a new model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     */
    public function actionCreate() {
        $model = new FrontMenu;

        if (isset($_POST['FrontMenu'])) {
            $model->attributes = $_POST['FrontMenu'];
            foreach ($this->uploadArr as $column) {
                $file = CUploadedFile::getInstance($model, $column); //获取表单名为filename的上传信息 
                if ($file) {
                    $model->$column = $this->uploadIcon($file);
                }
            }
            if (!$model->ParentID) {
                $model->ParentID = 0;
            }
            if ($model->save()) {
                $this->freshMenuCache();
                $this->redirect(array('admin'));
            }
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
        $menu = $model->attributes;
        if (isset($_POST['FrontMenu'])) {
            $model->attributes = $_POST['FrontMenu'];
            foreach ($this->uploadArr as $column) {
                $file = CUploadedFile::getInstance($model, $column); //获取表单名为filename的上传信息 
                if ($file) {
                    $model->$column = $this->uploadIcon($file);
                    if ($menu[$column]) {
                        $ftp = new Ftp();
                        $res = $ftp->delete_file('common/frontmenu/' . $menu[$column]);
                        $ftp->close();
                    }
                } else
                    unset($model->$column);
            }
            if (!$model->ParentID) {
                $model->ParentID = 0;
            }
            if ($model->save()) {
                $this->freshMenuCache();
                $this->redirect(array('admin'));
            }
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
        // we only allow deletion via POST request
        $this->loadModel($id)->delete();
        $this->freshMenuCache();
        $this->redirect(array('admin'));
    }

    protected function freshMenuCache() {

        Yii::app()->cache->delete("menu_sliderbar_1");
        Yii::app()->cache->delete("menu_sliderbar_2");
        Yii::app()->cache->delete("menu_sliderbar_3");

        Yii::app()->cache->delete("menu_stage_1");
        Yii::app()->cache->delete("menu_stage_2");
        Yii::app()->cache->delete("menu_stage_3");
    }

    /**
     * Lists all models.
     */
    public function actionIndex() {
        $dataProvider = new CActiveDataProvider('Menu');
        $this->render('index', array(
            'dataProvider' => $dataProvider,
        ));
    }

    /**
     * Manages all models.
     */
    public function actionAdmin() {
        $model = new FrontMenu('search');
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
        $model = FrontMenu::model()->findByPk($id);
        if ($model === null)
            throw new CHttpException(404, 'The requested page does not exist.');
        return $model;
    }

    /**
     * Performs the AJAX validation.
     * @param CModel the model to be validated
     */
    protected function performAjaxValidation($model) {
        if (isset($_POST['ajax']) && $_POST['ajax'] === 'menu-form') {
            echo CActiveForm::validate($model);
            Yii::app()->end();
        }
    }

    /**
     * 菜单有更改时删除前后台菜单缓存文件
     */
    public function DelMenuCachefile() {
        $beforePath = dirname(Yii::app()->BasePath) . '/runtime/front/cache/';
        $file = array(
            $beforePath . 'makemenucache.txt',
            $beforePath . 'dealermenucache.txt',
            $beforePath . 'servicemenucache.txt',
            $beforePath . 'mainmenus.txt',
        );
        foreach ($file as $filename) {
            if (file_exists($filename)) {
                $result = unlink($filename);
                if (!$result)
                    throw new CHttpException(404, 'The requested page does not exist.');
            }
        }
    }

    public function actionAjaxFillTree() {
        if (!Yii::app()->request->isAjaxRequest) {
            exit();
        }
        $parentId = 'null';
        if (isset($_GET['root']) and $_GET['root'] != 'source') {
            $parentId = (int) $_GET['root'];
            $children = FrontMenu::model()->findAllByAttributes(array("ParentID" => $parentId));
        } else {
            $children = FrontMenu::model()->findAllByAttributes(array("ParentID" => 0));
        }
        $data = array();
        foreach ($children as $key => $val) {
            $option = '<span style="float:right">[' .
                    CHtml::link('更新', array('/frontmenu/update', 'id' => $val->ID)) . '][' .
                    CHtml::link('删除', '', array('id' => $val->ID, 'class' => 'menu_delete', 'style' => 'cursor:pointer', 'confirm' => 'Are you sure you want to delete this item?')) . ']</span>';
            $data[] = array(
                "text" => $val->Name . $option,
                "id" => $val->ID,
                "hasChildren" => $val->IsLeaf == 1 ? false : true,
            );
        }
        echo json_encode($data);
        Yii::app()->end();
    }

    public function actionGetChildMenu() {
        if (!Yii::app()->request->isAjaxRequest) {
            exit();
        }
        $parentId = 'null';
        if (isset($_POST['ID'])) {
            $parentId = (int) $_POST['ID'];
            $children = FrontMenu::model()->findAllByAttributes(array("ParentID" => $parentId));
        }
        $dropDownCities = "<option value=''>选择菜单</option>";
        if (is_array($children)) {
            foreach ($children as $key => $val) {
                $dropDownCities .= CHtml::tag('option', array('value' => $val->ID), CHtml::encode($val->Name), true);
            }
        }

        echo $dropDownCities;
        exit;
    }

}
