<?php

class GoodscategoryController extends Controller
{
	/**
	 * @var string the default layout for the views. Defaults to '//layouts/column2', meaning
	 * using two-column layout. See 'protected/views/layouts/column2.php'.
	 */
    /**
	 * @var string the default layout for the views. Defaults to '//layouts/column2', meaning
	 * using two-column layout. See 'protected/views/layouts/column2.php'.
	 */
	public $layout = '//layouts/maker';
	//商品类别管理
	public function actionIndex()
	{
		$this->redirect(array('goodscategory/querygoodscategory'));
	}
	//商品类别列表
	public  function actionQuerygoodscategory()
	{
                $this->render('index');
	}
        
        //eayui获取商品分类列表
        public  function actionGetcategorylists()
	{
		$criteria = new CDbCriteria();
		$model= new GoodsCategory();
                $organID=Commonmodel::getOrganID();
		//$manufacturer_id=Yii::app()->user->id;
		$sql="select distinct a.name,a.id as categoryID,a.code,a.desc,"
		        ."(select count(distinct(b.id)) from tbl_make_goods b,tbl_make_goods_version c where  c.goods_id=b.id and c.goods_category=a.id and b.organID=a.organID and b.ISdelete='0' and b.NewVersion=c.version_name) as count"
                        ." from tbl_make_goods_category a"
			." where a.organID='$organID' group by a.name";
                $sql.=' order by id desc';
                //echo $sql;
		$result = DBUtil::queryAll($sql);
                $total=0;
                if($result){
                    $count=count($result);
                    $pages=new CPagination($count);
                    //设置分页页数
                    $pages->pageSize=isset($_GET['rows'])?intval($_GET['rows']):10;
                    $pages->applyLimit($criteria);
                    $result=Yii::app()->db->createCommand($sql." LIMIT :offset,:limit");
                    //绑定分页参数
                    $result->bindValue(':offset', $pages->currentPage*$pages->pageSize);
                    $result->bindValue(':limit', $pages->pageSize);
                    $result=$result->queryAll();
                    $total=$pages->itemcount;
                }
                //系统生成类别代号
                unset($criteria );
                $criteria = new CDbCriteria();
                $criteria->addCondition("organID=".$organID);
                $criteria->order = 'id desc' ;
                $model=  MakeGoodsCategory::model()->find($criteria);
                if($model)
                {
                    preg_match('/\d+/', $model['code'], $res);
                    $lastcode=intval($res[0]);
                    if($lastcode<9)
                        $code='00'.($lastcode+1);
                    elseif($lastcode<99)
                        $code='0'.($lastcode+1);
                    else {
                        $code=$lastcode+1;
                    }       
                }
                else
                    $code='001';
                $data['total']=$total;
                $data['rows']=is_null($result)?'':$result;
                $data['code']=$code;
                echo json_encode($data);
	}
        
        //添加商品分类
        public function actionAddcategory()
        {
            $model= new MakeGoodsCategory();
            $organID=Commonmodel::getOrganID();
            $userID = Yii::app()->user->id;
            if(isset($_POST))
            {
                //查询商品分类名称是否存在
                $data=  MakeGoodsCategory::model()->find('name="'.$_POST['name'].'" and organID='.$organID);
                if($data)
                {
                    echo json_encode(array('msg'=>'nameexist'));
                    exit;
                }
                $model->attributes=$_POST;
                $model->organID=$organID;
                $model->userID=$userID;
                $model->createtime=time();
                $model->updatetime=time();
                if($model->save())
                {
                    echo json_encode(array('msg'=>'ok'));
                }
                else {
                     echo json_encode(array('msg'=>'fail'));
                }
            }
        }
        
        //修改商品分类
        public function actionEditcategory()
        {
            $organID=Commonmodel::getOrganID();
            $categoryid=intval($_GET['id']);
            $userID = Yii::app()->user->id;
            $model=MakeGoodsCategory::model()->find('name="'.$_POST['name'].'" and organID='.$organID.' and id!='.$categoryid);
            if($model)
            {
                echo json_encode(array('msg'=>'nameexist'));
                exit;
            }
            unset($model);
            $model=MakeGoodsCategory::model()->findByPk($categoryid);
            $model->attributes=$_POST;
            $model->userID=$userID;
            $model->updatetime=time();
            if($model->save())
            {
                echo json_encode(array('msg'=>'ok'));
            }
            else {
                 echo json_encode(array('msg'=>'fail'));
            }   
        }
        
	//商品类别删除
	public function actionDelete()
	{
		$id=$_POST['crowid'];
		$sql="delete from tbl_make_goods_category  where id in($id)";
		$result=Yii::app()->db->createCommand($sql)->execute();
		echo json_encode($result);
	 }
}