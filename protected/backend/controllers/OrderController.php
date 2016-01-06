<?php

class OrderController extends Controller {

    /**
     * @var string the default layout for the views. Defaults to '//layouts/column2', meaning
     * using two-column layout. See 'protected/views/layouts/column2.php'.
     */
    public $layout = '//layouts/user';
    
    public  function ActionList(){
      $model=new PapOrder('search');
        if (isset($_GET['PapOrder']))
        $model->attributes = $_GET['PapOrder'];
        $dataProvider=$model->search();
        $data=$dataProvider->getData();
        
       foreach($data as $key=>$val){
           
           $data[]=$val->attributes;
           $buy=$this->getOrgan($val['BuyerID']);
           $seller=$this->getOrgan($val['SellerID']);
           $data[$key]['BuyerPhone']=$buy['Phone'];
           $data[$key]['SellerPhone']=$seller['Phone'];
       }
       //$dataProvider=$dataProvider->setData($data);
      $this->render('list',array('model'=>$model,'dataProvider'=>$dataProvider));  
 }
  public function getOrgan($id){
      $organ=Organ::model()->findByPk($id);
      return $organ;
 }

}
