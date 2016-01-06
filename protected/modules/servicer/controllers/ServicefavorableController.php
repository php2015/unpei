<?php

class ServicefavorableController extends Controller {

    public $layout = '//layouts/service';

    public function actionIndex() {
        $this->pageTitle = Yii::app()->name . '-' . '优惠活动管理';
        $this->render('index');
    }

    public function actionList() {
        $page = isset($_GET['page']) ? intval($_GET['page']) : 1;
        $model = new Discount();
        $organID = Commonmodel::getOrganID();
        //$organID=Yii::app()->user->id;
        $criteria = new CDbCriteria();
        //查询条件
        $criteria->addCondition("UserID=:userID and OrganID=:organID ");
        $criteria->params[':userID'] = Yii::app()->user->id;
        $criteria->params[':organID'] = $organID;
        //搜索条件
        if ($_GET) {
            $search['title'] = $_GET['title'];
            $search['type'] = $_GET['type'];
            $search['status'] = $_GET['status'];
            $begintime = strtotime($_GET['dates']);
            $search['dates'] = strtotime("{$_GET['dates']}+ 1 day");
            if ($search) {
                if ($search['title']) {
                    $criteria->addSearchCondition('Title', "{$search['title']}", "AND");
                }
                if (!empty($search['status']) || $search['status'] == 0) {
                    $criteria->addSearchCondition('Status', "{$search['status']}", "AND");
                }
                if (!empty($search['type']) || $search['type'] == 0) {
                    $criteria->addSearchCondition("Type", "{$search['type']}", "AND");
                }
                if (!empty($search['dates'])) {
                    $criteria->addBetweenCondition('CreateTime', $begintime, $search['dates'], "AND");
                }
            }
        }
        $criteria->order = "CreateTime DESC,ID DESC";

        $count = $model->count($criteria);
// 		//分页类调用
        $pages = new CPagination($count);
// 		 //每页显示的行数
        $pages->pageSize = $_GET['rows'];
        $pages->applyLimit($criteria);
        $model = $model->findAll($criteria);
        // $model=$model->findAll('Status=:status',array(':status'=>'0'));
        $data = array();
        foreach ($model as $key => $value) {
            $data[$key]['ID'] = $value['ID'];
            $data[$key]['Title'] = $value["Title"];
            $data[$key]['Content'] = $value['Content'];
          //  $data[$key]['Type'] = $value['Type'];
            $data[$key]['TypeID']=$value['Type'];
            switch ($value['Type']) {
                case 0 :
                    $data[$key]['Type'] = '抵扣券';
                    break;
                case 1:
                    $data[$key]['Type'] = '折扣券';
                    break;
                case 2:
                    $data[$key]['Type'] = '其他';
                    break;
            }
            if ($value['Type'] == 0) {
                $data[$key]['Rate'] = !empty($value['Rate']) ? $value['Rate'] : '无';
                $data[$key]['Rate2']='减现'.$value['Rate'].'元';
            }
            if ($value['Type'] == 1) {
                $data[$key]['Rate'] = !empty($value['Rate']) ? $value['Rate'] : '无 ';
                $data[$key]['Rate2']='打'.$value['Rate'].'折';
            }
            if ($value['Type'] == 2) {
                $data[$key]['Rate'] = $value['Rate'];
            }
            $data[$key]['StartTime'] = date('Y/m/d H:i:s', $value['StartTime']);
            $data[$key]['EndTime'] = date('Y/m/d H:i:s', $value['EndTime']);
            $data[$key]['CreateTime'] = date('Y/m/d H:i:s', $value['CreateTime']);
            //$data[$key]['Rate']=$value['Rate'];
            $data[$key]['EffectTime'] = date('Y/m/d', $value['StartTime']) . '-' . date('Y/m/d', $value['EndTime']);
		    if($value['Status']==2)
		    {
		    	if($value['EndTime']<time())
		    	{
		    		$d=Discount::model()->updateByPk($value['ID'],array("Status"=>1));
		    	
		    	}
		    }
            switch ($value['Status']) {
                case 0:
                    $data[$key]['Status'] = '未开启';
                    break;
                case 1:
                    $data[$key]['Status'] = '已关闭';
                    break;
                case 2:
                    $data[$key]['Status'] = '已开启';
                    break;
            }
        }
        $rs = array(
            'total' => $count,
            'rows' => !empty($data)?$data:array()
        );
        echo json_encode($rs);
    }

    public function actionAdd() {
        $userid = Commonmodel::getOrganID();
        $organid = Commonmodel::getOrganID();
        $title = $_POST['Title'];
        $rate = $_POST['Rate'];
        $type = $_POST['Type'];
        $starttime = strtotime($_POST['StartTime']);
        $endtime = strtotime($_POST['EndTime']);
        $content = $_POST['Content'];
        $time = time();
        $ownerName = $_POST['namedata'];
        $ownerName = substr($ownerName, 0, -1);
        $ownerName = explode(',', $ownerName);

        $lice = $_POST['licedata'];
        $lice = substr($lice, 0, -1);
        $lice = explode(',', $lice);

        $ownerPhone = $_POST['phonedata'];
        $ownerPhone = substr($ownerPhone, 0, -1);
        $ownerPhone = explode(',', $ownerPhone);

        $ownerID = $_POST['iddata'];
        $ownerID = substr($ownerID, 0, -1);
        $ownerID = explode(',', $ownerID);
        $carID = $_POST['cardata'];
        $carID = substr($carID, 0, -1);
        $carID = explode(',', $carID);

        $nickname = $_POST['nickdata'];
        $nickname= substr($nickname, 0, -1);
        $nickname = explode(',', $nickname);
        
        $result = Yii::app()->db->createCommand()->insert('tbl_discount', array('Title' => $title, 'Content' => $content, 'Rate' => $rate,
            'Type' => $type, 'StartTime' => $starttime, 'EndTime' => $endtime,
            'OrganID' => $organid, 'UserID' => $userid, 'CreateTime' => $time
                ));

        $discountID = Yii::app()->db->getLastInsertID();

        for ($i = 0; $i < count($ownerID); $i++) {
            $code = $this->code();
            $data = Yii::app()->db->createCommand()->insert('tbl_discount_code', array('DiscountID' => $discountID, 'OwnerID' => $ownerID[$i], 'OwnerName' => $ownerName[$i],
                'OwnerPhone' => $ownerPhone[$i], 'Code' => $code, 'LicensePlate' => $lice[$i], 'CarID' => $carID[$i],'NickName'=>$nickname[$i]
                    ));
        }
        echo json_encode($data);
    }

    public function actionUpdate() {
        $id = $_GET['id'];
        $userid = Commonmodel::getOrganID();
        $organid = Commonmodel::getOrganID();
        $title = $_POST['Title'];
        $rate = $_POST['Rate'];
        //$type=$_POST['Type'];
        $starttime = strtotime($_POST['StartTime']);
        $endtime = strtotime($_POST['EndTime']);
        $content = $_POST['Content'];
        $time = time();
        $ownerID = $_POST['iddata'];
        $ownerID = substr($ownerID, 0, -1);
        $ownerID = explode(',', $ownerID);

        $ownerName = $_POST['namedata'];
        $ownerName = substr($ownerName, 0, -1);
        $ownerName = explode(',', $ownerName);

        $lice = $_POST['licedata'];
        $lice = substr($lice, 0, -1);
        $lice = explode(',', $lice);

        $carID = $_POST['cardata'];
        $carID = substr($carID, 0, -1);
        $carID = explode(',', $carID);
        $ownerPhone = $_POST['phonedata'];
        $ownerPhone = substr($ownerPhone, 0, -1);
        $ownerPhone = explode(',', $ownerPhone);
        
        $nickname = $_POST['nickdata'];
        $nickname= substr($nickname, 0, -1);
        $nickname = explode(',', $nickname);
// 	   
        $model = Discount::model()->updateAll(array('Title' => $title, 'Content' => $content,
            'Rate' => $rate, 'StartTime' => $starttime, 'EndTime' => $endtime,
            'UpdateTime' => $time), "ID=$id");
        $result = DiscountCode::model()->findAll('DiscountID=:id', array(':id' => $id));
        if (!empty($result)) {
            foreach ($result as $value) {
                if (!in_array($value['CarID'], $carID)) {
                	if(!empty($value['CarID']))
                	{
	                    $sql = "delete from tbl_discount_code where CarID={$value['CarID']} and DiscountID={$id}";
	                    $result = Yii::app()->db->createCommand($sql)->execute();
                	}
                } else {
                    $arr[] = $value['CarID'];
                }
            }
            foreach ($carID as $val) {
                if (!in_array($val, $arr)) {
                    $code = $this->code();
                    $sql = "select a.OwnerID,b.Name,b.Phone,a.LicensePlate,b.NickName from tbl_car_info a,tbl_car_owner b
					where a.ID='$val' and a.UserID='$userid' 
			      and a.OrganID='$organid' and a.OwnerID=b.ID";
                    $result = Yii::app()->db->createCommand($sql)->queryRow();

                    $data = Yii::app()->db->createCommand()->insert('tbl_discount_code', array('DiscountID' => $id, 'CarID' => $val, 'OwnerID' => $result['OwnerID'],
                        'OwnerName' => $result['Name'], 'OwnerPhone' => $result['Phone'],
                        'Code' =>$code, 'LicensePlate' => $result['LicensePlate'],'NickName'=>$result['NickName']
                            ));
                }
            }
            echo json_encode($data);
        } else {
            for ($i = 0; $i < count($ownerID); $i++) {
                $code = $this->code();
                $data = Yii::app()->db->createCommand()->insert('tbl_discount_code', array('DiscountID' => $id, 'OwnerID' => $ownerID[$i], 'OwnerName' => $ownerName[$i],
                    'OwnerPhone' => $ownerPhone[$i], 'Code' => $code, 'LicensePlate' => $lice[$i],'NickName'=>$nickname[$i]
                        ));
            }
            echo json_encode($data);
        }
    }

    public function actionDelete() {
        $id = $_GET['id'];
        $result = Yii::app()->db->createCommand()->delete('tbl_discount', 'id=:id', array(':id' => $id));
        echo json_encode($result);
    }

    public function actionOpen() {
        $ids = substr($_POST['ids'], 0, -1);
        $sql = " UPDATE `tbl_discount` SET `Status`=2 WHERE id in($ids)";
        $result = Yii::app()->db->CreateCommand($sql)->execute();
        echo json_encode($result);
    }

    public function actionDiscountcode() {
        $id = $_GET['id'];
        $sql = "select distinct a.ID,a.OwnerName,a.OwnerPhone,a.Code,a.Status,b.LicensePlate,a.NickName"
                . " from tbl_discount_code a ,tbl_car_info b,tbl_discount c"
                . " where a.OwnerID=b.OwnerID and c.ID=a.DiscountID and c.ID=$id group by a.ID";
        $result = Yii::app()->db->createCommand($sql)->queryAll();
        foreach ($result as $key => $value) {
            $data[$key]['ID'] = $value['ID'];
            $data[$key]['OwnerName'] = $value['OwnerName'];
            $data[$key]['NickName']=$value['NickName'];
            $data[$key]['Code'] = $value['Code'];
            $data[$key]['OwnerPhone'] = $value['OwnerPhone'];
            switch ($value['Status']) {
                case 0:
                    $data[$key]['Status'] = '未使用';
                    break;
                case 1:
                    $data[$key]['Status'] = '已使用';
                    break;
                case 2:
                    $data[$key]['Status'] = '已作废';
                    break;
            }
            $data[$key]['LicensePlate'] = $value['LicensePlate'];
        }
        if ($data) {
            $rs = array(
                'total' => 1,
                'rows' => $data
            );
        }
        echo json_encode($rs);
// 		$model=new DiscountCode();
// 		$criteria = new CDbCriteria();
// 		//查询条件
// 		$criteria->order = "ID DESC";
// 		$count=$model->count($criteria);
// 		//分页类调用
// 		$pages=new CPagination($count);
// 		//每页显示的行数
// 		$pages -> pageSize = 10;
// 		$pages->applyLimit($criteria);
// 		$model=$model->findAll($criteria);
// 		foreach($model as $key=>$value)
// 		{
// 			$data[$key]['ID']=$value['ID'];
// 			$data[$key]['OwnerName']=$value['OwnerName'];
// 			$data[$key]['Code']=$value['Code'];
// 			$data[$key]
// 		}
    }

    //发送对象
    public function actionSendcar() {
        $userid = Commonmodel::getOrganID();
        $sql = "select a.ID,a.Name,b.ID as carID,a.Phone,b.LicensePlate,a.NickName"
                . " from tbl_car_owner a,tbl_car_info b"
                . " where  b.OwnerID=a.ID and a.UserID='$userid' and a.OrganID='$userid'";
        $result = Yii::app()->db->createCommand($sql)->queryAll();
        foreach ($result as $key => $value) {
            $data[$key]['ID'] = $value['ID'];
            $data[$key]['CarID'] = $value['carID'];
            $data[$key]['OwnerName'] = $value['Name'];
            $data[$key]['NickName']=$value['NickName'];
            $data[$key]['LicensePlate'] = $value['LicensePlate'];
            $data[$key]['OwnerPhone'] = $value['Phone'];
        }
        $rs = array(
            'total' => 1,
            'rows' => $data ? $data : array()
        );
        echo json_encode($rs);
    }

    public function actionDissendcar() {
        $discountid = $_GET['id'];
        $userID = Commonmodel::getOrganID();
// 		$sql="select  distinct b.ID,c.ID as disID,c.OwnerID,a.Name,a.Phone,b.LicensePlate from tbl_car_owner a,tbl_car_info b,tbl_discount_code c
// 		    where  a.ID=b.OwnerID 
// 			and  b.OwnerID=c.OwnerID
// 			and c.DiscountID='$discountid'
// 		    and b.UserID='$userID' group by c.ID";
// 		echo $sql;
// 		exit;
        //$model=Yii::app()->db->createCommand($sql)->queryAll();
        $model = DiscountCode::model()->findAll('DiscountID=:discountid', array(':discountid' => $discountid));
        if (!empty($model)) {
            foreach ($model as $key => $value) {

                $data[$key]['ID'] = $value['ID'];
                $data[$key]['CarID'] = $value['CarID'];
                $data[$key]['NickName']=$value['NickName'];
                $data[$key]['OwnerName'] = $value['OwnerName'];
                $data[$key]['LicensePlate'] = $value['LicensePlate'];
                $data[$key]['OwnerPhone'] = $value['OwnerPhone'];
            }
            $rs = array(
                'total' => 1,
                'rows' => $data ? $data : array()
            );
            echo json_encode($rs);
        }
    }

    //生产优惠码
    public function code() {
        srand((double) microtime() * 1000000); //create a random number feed.
        $ychar = "0,1,2,3,4,5,6,7,8,9,A,B,C,D,E,F,G,H,I,J,K,L,M,N,O,P,Q,R,S,T,U,V,W,X,Y,Z";
        $list = explode(",", $ychar);
        for ($i = 0; $i < 6; $i++) {
            $randnum = rand(0, 35); // 10+26;
            $authnum.=$list[$randnum];
        }
        return $authnum;
    }

    public function actionEditsend() {
        //exit;
        $disid = $_GET['id'];
        $userID = Commonmodel::getOrganID();
        $model = DiscountCode::model()->findAll('DiscountID=:disid', array(':disid' => $disid));

        foreach ($model as $key => $val) {
            $ownID = $val['OwnerID'];
            $carID = $val['CarID'];
            $sql = "select b.ID,b.Name,b.Phone,a.LicensePlate,a.ID as CarID,b.NickName from tbl_car_info a,tbl_car_owner b 
				  where a.ID not in(select  CarID from tbl_discount_code where DiscountID='$disid') and b.ID=a.OwnerID
					and a.UserID='$userID'";
            $result = Yii::app()->db->createCommand($sql)->queryAll();
        }
        foreach ($result as $key => $value) {

            $data[$key]['ID'] = $value['ID'];
            $data[$key]['CarID'] = $value['CarID'];
            $data[$key]['NickName']=$value['NickName'];
            $data[$key]['OwnerName'] = $value['Name'];
            $data[$key]['LicensePlate'] = $value['LicensePlate'];
            $data[$key]['OwnerPhone'] = $value['Phone'];
        }
        $rs = array(
            'total' => 1,
            'rows' => $data ? $data : array()
        );
        echo json_encode($rs);
    }

}