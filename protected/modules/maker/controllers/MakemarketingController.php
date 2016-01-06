<?php

class MakemarketingController extends Controller {

    public $layout = '//layouts/maker';

    /**
     * 授权经销商列表页面
     */
    public function actionEmpowerdealer() {
        $this->render('empowerdealer');
    }

    /**
     * 授权经销商列表
     */
    public function actionEmpowerlist() {
        $user_id = Commonmodel::getOrganID();
        $criteria = new CDbCriteria();
        $criteria->select = "*";
        $criteria->condition = 'up_userID=' . $user_id;
        $criteria->order = 'id DESC' ;
        $count = MakeEmpowerDealer::model()->count($criteria);
        $pages = new CPagination($count);
        $pages->pageSize = $_GET['rows'];
        $pages->applyLimit($criteria);
        $models = MakeEmpowerDealer::model()->findAll($criteria);

        foreach ($models as $key => $val) {
            $empowerdealer[$key]['id'] = $val->id;
            $empowerdealer[$key]['organName'] = F::msubstr($val->organName);
            $empowerdealer[$key]['grade'] = $val->grade;
            $empowerdealer[$key]['category'] = MakeEmpowerCategory::getcateName($val->category);
            $empowerdealer[$key]['brand'] = $val->brand;
            $empowerdealer[$key]['accountMethods'] = $val->accountMethods;
        }
        $userInfo['total'] = $count;
        $userInfo['rows'] = $empowerdealer ? $empowerdealer : array(); // $record;
        echo json_encode($userInfo);
    }

    /**
     * 添加授权经销商页面
     */
    public function actionAddempdea() {
        $manufacturer_id = Commonmodel::getOrganID();
        if ($_GET['id']) {
            $model = MakeEmpowerDealer::model()->findByPk($_GET['id']);
        } else {
            $model = new MakeEmpowerDealer();
            $model->accountMethods = '月结';
            $empowerdealers = MakeEmpowerDealer::model()->findAll('up_userID = ' . Commonmodel::getOrganID());
            foreach ($empowerdealers as $val) {
                $deal_ids[] = $val->dealer_id;
            }
            if (!empty($deal_ids)) {
                $deal_ids = implode(',', $deal_ids);
                $dealers = Dealer::model()->findAll("id not in ($deal_ids) and !ISNULL(organName)");
            } else {
                $dealers = Dealer::model()->findAll("!ISNULL(organName)");
            }
        }
        if (isset($_POST['ajax']) && $_POST['ajax'] === 'make-form') {
            echo CActiveForm::validate($model);
            Yii::app()->end();
        }
        CommonForm::Add('MakeEmpowerDealer', 'empowerdealer');
        //经营级别查询
        $result = GoodsDealerlevel::model()->findAll();
        $this->render('addempdea', array(
            'model' => $model,
            'dealers' => $dealers,
            'level' => $result,
        ));
    }

    /**
     * 品类管理页面
     */
    public function actionEmpowercate() {
        $this->render('goodscate');
    }
    /**
     * 品类列表
     */
    public function actionCatelist() {
        $user_id = Commonmodel::getOrganID();
        $criteria = new CDbCriteria();
        $criteria->select = "*";
        $criteria->condition = 'userID=' . $user_id;
        $criteria->order = 'id DESC' ;
        $count = MakeEmpowerCategory::model()->count($criteria);
        $pages = new CPagination($count);
        $pages->pageSize = $_GET['rows'];
        $pages->applyLimit($criteria);
        $models = MakeEmpowerCategory::model()->findAll($criteria);

        foreach ($models as $key => $val) {
            $cate[$key]['id'] = $val->id;
            $cate[$key]['cateName'] =  F::msubstr($val->cateName);
            $cate[$key]['remarks'] =  F::msubstr($val->remarks);
        }
        $userInfo['total'] = $count;
        $userInfo['rows'] = $cate ? $cate : array(); // $record;
        echo json_encode($userInfo);
    }
    /**
     * 品类添加页面
     */
    public function actionAddempowercate() {
        $user_id = Commonmodel::getOrganID();
        $sql = Goods::GetGoodsByMakerID($user_id);
        $searchsql = $sql;
        if ($_POST['type']) {
            if ($_POST['type'] == 'query') {
                $search = $_POST['search'];
                if ($_GET['id']) {
                    $searchsql.=" and a.id not in (select goods_id from tbl_make_empower_category_relation where cate_id={$_GET['id']})";
                }
//				if (!empty($search['num'])){
//					switch ($search['radio']){
//						case 'OE': $searchsql.=" and a.oe like '%{$search['num']}%'";break;
//						case 'goods_num': $searchsql.=" and b.goodsno like '%{$search['num']}%'";break;
//					}
//				}
                if (!empty($search['cate'])) {
                    $searchsql.=" and a.category_id = '{$search['cate']}'";
                }
//				$searchsql.="  group by a.id order by a.id desc";
                $result = Yii::app()->db->createCommand($searchsql)->queryAll();
                $post = $_POST['MakeEmpowerCategory'];
                $searchmodel = new MakeEmpowerCategory();
                $searchmodel->cateName = $post['cateName'];
                $searchmodel->remarks = $post['remarks'];
            } else {
                $post = $_POST['MakeEmpowerCategory'];
                $relation_ids = $_POST['goodscatesrelation'];
                if (!empty($relation_ids)) {
                    $inid = implode(',', $relation_ids);
                }
                if (!empty($post['cateName'])) {
                    $post['userID'] = $user_id;
                    if ($post['id']) {
                        $make = MakeEmpowerCategory::model()->findByPk($post['id']);
                        if (!empty($inid)) {
                            MakeEmpowerCategoryRelation::model()->deleteAll("cate_id={$_GET['id']} and goods_id not in ({$inid})");
                        } else {
                            MakeEmpowerCategoryRelation::model()->deleteAll("cate_id={$_GET['id']}");
                        }
                    }
                    if (empty($make)) {
                        $make = new MakeEmpowerCategory();
                    }
                    $make->attributes = $post;
                    $make->save();
                    if (!empty($inid)) {
                        $resultsid = Yii::app()->db->createCommand("select goods_id from tbl_make_empower_category_relation where cate_id = {$make->id}")->queryAll();
                        foreach ($relation_ids as $relation_id) {
                            if (!in_array($relation_id, $resultsid)) {
                                $relamodel = new MakeEmpowerCategoryRelation();
                                $relamodel->goods_id = $relation_id;
                                $relamodel->cate_id = $make->id;
                                $relamodel->save();
                            }
                        }
                    }
                    $this->redirect(array('makemarketing/empowercate'));
                }
            }
        }
        if ($_GET['id']) {
            $model = MakeEmpowerCategory::model()->findByPk($_GET['id']);
            $bindingsql = $sql . " and a.id in (select goods_id from tbl_make_empower_category_relation where cate_id={$_GET['id']})";
//			$bindingsql.="  group by a.id order by a.id desc";
            $bindingcates = Yii::app()->db->createCommand($bindingsql)->queryAll();
        } elseif ($_POST['type'] == 'query') {
            $model = $searchmodel;
        } else {
            $model = new MakeEmpowerCategory();
        }
        $cate = "select distinct name,id from tbl_goods_category where manufacturer_id={$user_id} group by name order by id desc";
        $cate_data = Yii::app()->db->createCommand($cate)->queryAll();
        $cates = CHtml::listData($cate_data, "id", "name");
        $this->render('addgoodscate', array(
            'model' => $model,
            'cates' => $cates,
            'result' => $result,
            'search' => $search,
            'bindingcates' => $bindingcates,
        ));
    }

    /**
     * 获取商品信息
     */
    public function actionGetgoodsinfo() {
        $user_id = Commonmodel::getOrganID();
        $sql = Goods::GetGoodsByMakerID($user_id);
        if ($_GET['ids']) {
            $ids = $_GET['ids'];
            $inid = implode(',', $ids);
            $sql.=" and a.id in ({$inid})";
//			$sql.="  group by a.id order by a.id desc";
            $result = Yii::app()->db->createCommand($sql)->queryAll();
        }
        echo json_encode($result);
    }

    /**
     * 联系人列表页面
     */
    public function actionContacts() {
        $user_id = Commonmodel::getOrganID();
        $conditions = "up_userID={$user_id}";
        $searchconditions = "1=1";
        if ($_POST['search']) {
            $search = $_POST['search'];
            $searchconditions.=" AND organName LIKE '%{$search}%' OR customerType LIKE '%{$search}%' OR cooperateType LIKE '%{$search}%' OR contactsName LIKE '%{$search}%' OR sex LIKE '%{$search}%' OR telephone LIKE '%{$search}%' OR email LIKE '%{$search}%' OR AddStreet LIKE '%{$search}%' OR wechat LIKE '%{$search}%' OR qq LIKE '%{$search}%' OR remarks LIKE '%{$search}%'";
            $area = Area::model()->findAll("name LIKE '%{$search}%'");
            if (!empty($area)) {
                foreach ($area as $val) {
                    $ae[] = $val->id;
                }
                $aecon = implode(',', $ae);
                $searchconditions.=" OR AddProvince IN ({$aecon}) OR AddCity IN ({$aecon}) OR AddArea IN ({$aecon})";
            }
        }
        $model = MakeContacts::model()->findAll($conditions . ' AND (' . $searchconditions . ')');
        $pagesize = 10;
        $page = !empty($_GET['page']) ? $_GET['page'] : 1;
        $page = $pagesize * ($page - 1);
        $count = count($model);
        $limit = " limit $page, $pagesize ";
        $model = MakeContacts::model()->findAll($conditions . ' AND (' . $searchconditions . ')' . ' order by id DESC' . $limit);
        $pageData = array('total_rows' => $count,
            'parameter' => '',
            'list_rows' => $pagesize,
            'page_name' => 'page',
            'ajax_func_name' => '',
            'method' => '');
        $page = new Pagination($pageData);
        $page = $page->show(1);
        $this->render('contacts', array(
            'models' => $model,
            'search' => $search,
            'page' => $page,
            'count' => $count,
            'pagesize' => $pagesize,
        ));
    }
    /**
     * 添加联系人页面
     */
    public function actionAddcontacts() {
        if ($_GET['id']) {
            $model = MakeContacts::model()->findByPk($_GET['id']);
        } else {
            $model = new MakeContacts();
        }
        if (isset($_POST['ajax']) && $_POST['ajax'] === 'make-form') {
            echo CActiveForm::validate($model);
            Yii::app()->end();
        }
        CommonForm::Add('MakeContacts', 'contacts');
        $this->render('addcontacts', array(
            'model' => $model,
        ));
    }

    /**
     * 检查授权经销商登记使用的手机号是否存在
     */
    public function actionCheckorgan() {
        $telephone = $_GET['telephone'];
        $organName = $_GET['organName'];
        $user_id = Commonmodel::getOrganID();
        $model = Dealer::model()->findAll("Phone='{$telephone}' and organName!='{$organName}'");
        if (!empty($model)) {
            $result = 1;
        } else {
            $model2 = Dealer::model()->findAll("Phone!='{$telephone}' and organName='{$organName}'");
            if (!empty($model2)) {
                $result = 2;
            } else {
                $model1 = MakeEmpowerDealer::model()->findAll("organName='{$organName}' and up_userID = $user_id");
                if (!empty($model1)) {
                    $result = 3;
                } else {
                    $dealer = Dealer::model()->find("Phone='{$telephone}' and organName='{$organName}'");
                    $model3 = MakeEmpowerDealer::model()->findAll("dealer_id='$dealer->id' and up_userID = $user_id");
                    if (!empty($model3)) {
                        $result = 4;
                    } else {
                        $result = 100;
                    }
                }
            }
        }
        echo json_encode($result);
    }

    /**
     * 主营信息管理
     */
    public function actionMainbusiness() {
        $this->pageTitle = Yii::app()->name . '-' . "主营登记";
        $userID = Commonmodel::getOrganID();
        if ($_POST['brand'] || $_POST['cp_name']||$_POST['delcpids']) {
            $message = "保存成功";
        } else {
            $message = '';
        }
//        if (!empty($_POST['brand'])) {
//            $model = MakeOrgan::model()->updateAll(array('businessBrand' => $_POST['brand']), 'userID=:userID', array(':userID' => $userID));
//        }
        if ($_POST) {
            $BigName = $_POST['BigName'];
            $SubName = $_POST['SubName'];
            $CpName = $_POST['CpName'];
            $BigpartsID = $_POST['BigpartsID'];
            $SubCodeID = $_POST['SubCodeID'];
            $CpNameID = $_POST['CpNameID'];
            
            $cplegth = count($BigpartsID);
            if($cplegth>0){
            for ($j = 0; $j < $cplegth; $j++) {
                $mogr = new DealerCpname();
                $mogr->OrganID = $userID;
                $mogr->BigName = $BigName[$j];
                $mogr->SubName = $SubName[$j];
                $mogr->CpName = $CpName[$j];
                $mogr->BigpartsID = $BigpartsID[$j];
                $mogr->SubCodeID = $SubCodeID[$j];
                $mogr->CpNameID = $CpNameID[$j];
                $mogr->save();
            }
            }
        }
        if (!empty($_POST['delcpids'])) {
            $result = DealerCpname::model()->deleteAll("ID in ({$_POST['delcpids']})");
        }
        $model = MakeOrgan::model()->find('userID=:userID', array(':userID' => $userID));
        $showcpname = DealerCpname::model()->findAll('OrganID=:userID', array(':userID' => $userID));
        $this->render('mainbusiness', array(
            'model' => $model,
            'showcpnames' => $showcpname,
            'message' => $message
        ));
    }
    public function actionCheckdel(){
        $cateid=$_GET['cateid'];
        $organID = Commonmodel::getOrganID();
        $Cpid=  DealerCpname::model()->findByPk($cateid);
        if(!empty($Cpid->CpNameID)){
            $template= MakeGoodsTemplate::model()->find("organID=:organID and standard_id=:cpid and ISdelete='N'",array(":organID"=>$organID,":cpid"=>$Cpid->CpNameID));
            if(!empty($template)){
                echo json_encode("此品类中已有参数模版，不可删除！");
            }else{
                $goods=  MakeGoodsVersion::model()->findAll("organID=:organID and goods_category=:cpid and ISdelete=0",array(":organID"=>$organID,":cpid"=>$Cpid->CpNameID));
                if(!empty($goods)){
                    echo json_encode("此品类中已有商品，不可删除！");
                }else{
                    echo json_encode("OK");
                }
            }
        }else{
            echo json_encode("false");
        }
    }
}