<?php
class TemplateController extends Controller {
    public $layout='//layouts/cms';
    public function actionIndex(){
        $model = new AdminTemplate('search');
        $model->unsetAttributes();  // clear any default values
        if (isset($_GET['Page']))
            $model->attributes = $_GET['Page'];

        $this->render('index', array(
            'model' => $model,
        ));
    }
    public function actionShort(){
       $dataProvider=new CActiveDataProvider('AdminTemplate',array(
            'criteria'=>array(
                'condition'=>'t.RootTypeID=1',
                'order'=>'t.ID DESC',
                'with'=>array('templatetype'),
           )
        ));
        $this->render('short',array(
            'dataProvider'=>$dataProvider,
        ));
    }
    public function actionEmailtemp(){
        $dataProvider=new CActiveDataProvider('AdminTemplate',array(
            'criteria'=>array(
                'condition'=>'t.RootTypeID=2',
                'order'=>'t.ID DESC',
                'with'=>array('templatetype'),
           )
        ));
        $this->render('emailtemp',array(
            'dataProvider'=>$dataProvider,
        ));
    }
    public function actionGoodstemp(){
        $dataProvider=new CActiveDataProvider('AdminTemplate',array(
            'criteria'=>array(
                'condition'=>'t.RootTypeID=3',
                'order'=>'t.ID DESC',
                'with'=>array('templatetype'),
           )
        ));
        $this->render('goodstemp',array(
            'dataProvider'=>$dataProvider,
        ));
    }
    public function actionCustomer(){
        $dataProvider=new CActiveDataProvider('AdminTemplate',array(
            'criteria'=>array(
                'condition'=>'t.RootTypeID=4',
                'order'=>'t.ID DESC',
                'with'=>array('templatetype'),
           )
        ));
        $this->render('customer',array(
            'dataProvider'=>$dataProvider,
        ));
    }
    public function actionUptemp(){
        if (isset($_POST['ajax']) && $_POST['ajax'] === 'make-form') {
            echo CActiveForm::validate($model);
            Yii::app()->end();
        }
        $model=new AdminTemplate();
        $template=$_POST['AdminTemplate'];
        if(!empty($_FILES['FileUrl']['name'])){
            $upload_file = new UploadFile();
            $url = "/upload/template/backend/" . $user_id . "/images/" . $user_id . "/";
            $type = 'xls|xlsx|csv';
            $size = 2 * 1024 * 1024;
            $file = $upload_file->upload('FileUrl', $type, $size, $url);
            if (!$file['message']) {
                $template['FileUrl']=$file['file'];
            }else{
                $filemessage=$file['message'];
                $this->render('uptemp',array('model'=>$model,'message'=>$filemessage));
                exit;
            }
        }
        $this->render('uptemp',array('model'=>$model));
    }
}
?>
