<?php
class ServicemaintainController extends Controller
{
	/*
	 * 渲染保养提醒列表页面
	 */
	public function actionIndex()
	{
		$this->pageTitle = Yii::app()->name . '-' . "保养提醒管理";
	    $this->render('index');
	}
	/*
	 * 保养提醒记录
	 */
	public function actionMaintainlist()
	{
		$userID = Commonmodel::getOrganID(); 
		$criteria = new CDbCriteria();
		$criteria->with = "owners";
		if ($_GET) {
			if ($_GET['name']) {
				$remind = $this->getRecord($_GET['name']);
				$criteria->addInCondition('t.ID',$remind);   
			}
			if ($_GET['status']) {
				$criteria->addCondition("t.Status = {$_GET['status']}","AND");
			}
			if ($_GET['date']) {
				$starttime = strtotime($_GET['date']);
				$endtime = (int)(strtotime($_GET['date']) +60*60*24);
				$criteria->addBetweenCondition('t.MaintainDate',$starttime,$endtime,"AND");
			}
		}
		$criteria->order = "t.MaintainDate DESC,t.UpdateTime DESC";	//排序条件:t.MaintainDate,t.UpdateTime倒叙
		$criteria->addCondition("t.OrganID = {$userID}","AND");
		$count = MaintainRemind::model()->count($criteria);
		$pages = new CPagination($count);
	    $pages->pageSize = $_GET['rows'];
	    $pages->applyLimit($criteria);
	    $model = MaintainRemind::model()->findAll($criteria);
	    foreach($model as $key=>$value)
	    {
	    	$data[$key]['ID'] = $value['ID'];
	    	if ($value['Status'] == '1') {
	    		$data[$key]['State'] = '待发送';
	    	}
	    	elseif ($value['Status'] == '2') {
	    		$data[$key]['State'] = '已发送';
	    	}
	    	else {
	    		$data[$key]['State'] = '取消发送';
	    	}
	    	$data[$key]['Status'] = $value['Status'];
	    	$data[$key]['MaintainDate'] = date('Y-m-d',$value['MaintainDate']);
	    	$data[$key]['MaintainTime'] = $value['MaintainDate'];
	    	$data[$key]['RemindContent'] = $value['RemindContent'];
	    	$data[$key]['Content'] = F::msubstr($value['RemindContent']);
	    	foreach ($value->owners as $owners_key=>$owners_value)
	    	{
	    		$data[$key]['OldName'] .= $owners_value->Name.",";
	    		$data[$key]['Name'] = F::msubstr(substr($data[$key]['OldName'], 0, -1));
	    	}
	    }
	    $rs = array(
	    		'total' => $count,
	    		'rows' => $data ? $data : array()
	    );
	    echo json_encode($rs);
	}
	/*
	 * 通过车主姓名获取保养提醒ID
	 */
	public function getRecord($name)
	{
		$criteria = new CDbCriteria();
		$criteria->addSearchCondition('t.Name',"{$name}","AND");
		$model = MaintainOwner::model()->findAll($criteria);
		$data = array();
		foreach ($model as $key=>$value)
		{
			if(!in_array($value['RemindID'],$data)){
			   $data[] = $value['RemindID'];
			}			
		}		
		return $data;
	}
	/*
	 * 获取一条保养记录中发送的车主信息（详情）
	 */
	public function actionSendstate()
	{
		$criteria = new CDbCriteria();
		$criteria->with = "remind";
		$criteria->addCondition("t.RemindID = {$_POST['ID']}","AND");	//同一条保养记录
		$criteria->addCondition("t.Status = {$_POST['Status']}","AND"); //保养记录表状态与保养记录车主表状态相同
		$count = MaintainOwner::model()->count($criteria);
	    $model = MaintainOwner::model()->findAll($criteria);
		foreach ($model as $key=>$value)
		{
			$data[$key]=$value->attributes;
			if (empty($value['FirstRemind'])) {
				$data[$key]['FirstRemind'] = '未提醒';
			}
			else {
				$data[$key]['FirstRemind']=date('Y-m-d',$value['FirstRemind']);
			}
			if (empty($value['SecondRemind'])) {
				$data[$key]['SecondRemind'] = '未提醒';
			}
			else {
				$data[$key]['SecondRemind']=date('Y-m-d',$value['SecondRemind']);
			}
			//当前时间
			$data[$key]['CurrentDate']=date('Y-m-d',time());
			//保养日期
			$data[$key]['MaintainDate']=date('Y-m-d',$value->remind->MaintainDate);
		}
		$rs = array(
	    		'total' => $count,
	    		'rows' => $data ? $data : array()
	    );
	    echo json_encode($rs);
	}
	/*
	 * 确认发送提醒
	 */
	public function actionConfirmremind()
	{
		//更新保养提醒时间
		$remind_success = MaintainRemind::model()->updateByPk($_POST['ID'],array('UpdateTime' => time()));
		//设置车主状态--待发送
		$ids = $_POST['ids'];
		foreach ($ids as $id) 
		{
			$save_success = MaintainOwner::model()->updateByPk($id,array('Status' => 1));
		}
		/* 设置车主状态--取消发送
		 * 获取同一保养提醒中未被保存的车主信息，将其状态改为取消提醒 Status = 3
		 */
		$criteria = new CDbCriteria();
		$criteria->addCondition("RemindID = {$_POST['ID']}", "AND"); //同一条保养提醒记录
		$criteria->addNotInCondition('ID', $ids, "AND"); //未被选中发送提醒的车主
		$criteria->select = 'ID';  
		$owners = MaintainOwner::model()->findAll($criteria);
		if ($owners) {
			$model = MaintainRemind::model()->find(array(
				"condition" => "MaintainDate = {$_POST['MaintainTime']} and Status = 3"
			));
			if ($model) {//如果当天取消发送的记录存在，则获取记录ID
				$ID = $model['ID'];
			}
			else {//如果当天取消发送的记录不存在，则添加当天已取消发送的记录
				$ID = $this->insertRemind($_POST['ID']);
			}
			foreach ($owners as $key=>$value)
			{
				$cancel_success = MaintainOwner::model()->updateByPk($value['ID'],array(
					'RemindID' => $ID,
					'Status' => 3
				));
			}
		}
		if ($save_success == '1') {
			$result['success'] = "保养记录保存成功!";
			echo json_encode($result);
		}
		else if ($cancel_success == '1') {
			$result['success'] = "保养记录取消提醒成功!";
			echo json_encode($result);
		}
		else {
			$result['errorMsg'] = "系统异常,保养记录保存失败!";
			echo json_encode($result);
		}
	}
	/*
	 * 在确认时取消发送
	 */
	public function insertRemind($ID)
	{
		$remind = MaintainRemind::model()->findByPk($ID);
		//获取保养提醒信息新增保养提醒记录，且新记录的发送状态为取消发送
		$model = new MaintainRemind();
		$model->MaintainDate = $remind['MaintainDate'];
		$model->RemindContent = $remind['RemindContent'];
		$model->OrganID = $remind['OrganID'];
		$model->UserID = $remind['UserID'];
		$model->CreateTime = time();
		$model->UpdateTime = time();
		$model->Status = 3;
		$model->save();
		$ID = $model->attributes['ID'];
		return $ID;
	}
	/*
	 * 整条保养提醒取消发送
	 */
	public function actionCancel()
	{
		//修改保养提醒记录状态
		$remind_success = MaintainRemind::model()->updateByPk($_POST['ID'],array(
			"Status" => 3,
			"UpdateTime" => time()
		));
		//修改需保养提醒的车主的状态
		$owners_success = MaintainOwner::model()->updateAll(array(
			"Status"=>3
		),"RemindID=:RemindID",array(":RemindID"=>$_POST['ID']));
		if ($remind_success == '1' && $owners_success == '1') {
			$result['success'] = "保养记录发送提醒取消成功!";
			echo json_encode($result);
		}
		else{
			$result['errorMsg'] = "系统异常,保养记录发送提醒取消失败!";
			echo json_encode($result);
		}
	}
}