<?php

class UnitController extends Controller {

    public $layout = "//layouts/dealer";
    
    public function actionIndex(){
        $this->pageTitle = Yii::app()->name .'-'."单位管理";
        $this->render("index");
    }
    /*
     * 获取所有单位信息
     */
    public function actionGetunit()
    {
        $organID = Commonmodel::getOrganID();
        $page = isset($_GET['page']) ? intval($_GET['page']) : 1;
        $criteria = new CDbCriteria();
        $criteria->addCondition("IsDelete = 1");
        $criteria->addCondition("OrganID = ".$organID);
        $count= DealerGoodsUnit::model()->count($criteria);
// 		//分页类调用
	$pages=new CPagination($count);
// 		//每页显示的行数
	$pages -> pageSize = $_GET['rows'];
	$pages->applyLimit($criteria);
        $units = DealerGoodsUnit::model()->findAll($criteria);
        $list = array();
        foreach ($units as $key => $value) {
            $list[$key]['id'] = $value['ID'];
            $list[$key]['UnitName'] = $value['UnitName'];
            $list[$key]['UnitMemo'] = $value['UnitMemo']=="NULL" ? '' : $value['UnitMemo'];
        }
        $rs = array(
            'total' => $count,
            'rows' => $list
        );
        echo json_encode($rs);
    }
    /*
     * 添加单位信息
     */
    public function actionAdd()
    {
        $organID = Commonmodel::getOrganID();
        $model = new DealerGoodsUnit();
//        $units = DealerGoodsUnit::model()->findAll("OrganID= $organID");
//        $list = array();
//        foreach ($units as $key => $value) {
//            $list[$key] = $value['UnitName'];
//        }
//        if(in_array($_GET['UnitName'],$list))
//        {
//            echo 9;
//            exit;
//        }  
        if(!$this->Isexist($_GET['UnitName'],0)){
             $rs = array('success' => 9, 'errorMsg' => '单位已存在！');
            echo json_encode($rs);
            Yii::app()->end();
        }
        $add['UnitName'] = $_GET['UnitName'];
        $add['UnitMemo'] = $_GET['UnitMemo']  ? $_GET['UnitMemo'] : 'NULL';
        $add['IsDelete'] = 1;
        $add['OrganID'] = $organID;
        $add['UserID'] = Yii::app()->user->id;
        $add['CreateTime'] = time();
        $model->attributes = $add;
        $bool = $model->save();
        if($bool){
             $rs = array('success' => 1, 'errorMsg' => '添加成功');
        }else{
            $rs = array('success' => 0, 'errorMsg' => '添加失败');
        }
       echo json_encode($rs);
    }
    /*
     * 修改单位信息
     */
    public function actionSave()
    {
        $add['UnitName'] = $_GET['UnitName'];
        $add['UnitMemo'] = $_GET['UnitMemo'] ? $_GET['UnitMemo'] : 'NULL';
        $add['UpdateTime'] = time();
        if($this->Isexist($_GET['UnitName'],$_GET['id'])){
             $bool = DealerGoodsUnit::model()->updateByPk($_GET['id'],$add);
        }else{
            $bool = 0;
        }
        echo $bool;
    }
    
    private function Isexist($unitName,$ID=0){
        $organID = Commonmodel::getOrganID();
        $bool = true;
        if($ID==0)// 添加
        {
            $count = DealerGoodsUnit::model()->count("OrganID= $organID and UnitName = '{$unitName}' ");
             if($count)
                 $bool=false;
        }else {// 修改
            $count = DealerGoodsUnit::model()->count("OrganID= $organID and ID!=$ID and UnitName = '{$unitName}' ");
             if($count)
                $bool=false;
        }
        return $bool;
    }
    /*
     * 删除单位信息
     */
    public function actionDel()
    {
        $ID = $_GET['ID'];
        $bool = DealerGoodsUnit::model()->deleteByPk($ID);
        echo $bool;
    }

}
?>
