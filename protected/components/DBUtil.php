<?php 
class DBUtil
{
	/**
	 * 获取数据库连接实例
	 */
	public static function getDbCon () 
	{
		$db_con = '';
		if(isset(Yii::app()->controller->module->db)){
			$db_con = Yii::app()->controller->module->db;
		}
		if(!$db_con){
			$db_con = 'jpdb';
		}
		return Yii::app()->getComponent($db_con);
	}
	
	//执行事务，包含多条语句    注意：需要进行事务处理时必须更改表引擎为InnoDB，当前为MyISAM
	public static function executeTransaction($sqlArr=array()){
		//执行SQL
		if(!is_array($sqlArr) || count($sqlArr) == 0){
			return false;
		}
		$error = "";
		$result = false;
		$connection = self::getDbCon();
		$transaction=$connection->beginTransaction();
		try
		{
			foreach($sqlArr as $sql){
				if(!empty($sql)){
					$connection->createCommand($sql)->execute();
				}
			}
			$transaction->commit();
			$result = true;
		} catch(Exception $e) {
			$transaction->rollBack();
			$error .= '数据库执行异常：'.$e->__toString();
			$result = false;
		}
		//返回处理结果
		return array('result' => $result,'error' => $error);
	}

	//执行语句
	public static function execute($sql,$params=array()){
		if(empty($sql)){
			return false;
		}
		$error = "";
		$result = false;
		try
		{
			$connection = self::getDbCon();
			$result = $connection->createCommand($sql)->execute($params);
			$result = true;
		} catch(Exception $e) {
			$error .= '数据库执行异常：'.$e->__toString();
			$result = false;
		}
		//返回处理结果
		return array('result' => $result,'error' => $error);
	}
	
	//执行查询，返回列表
	public static function queryAll($sql,$params=array(),$queryCachingDuration=0,$dependency=null){
		if(empty($sql)){
			return null;
		}
		$result = null;
		try
		{
			$connection = self::getDbCon();
	    	$command = $connection->cache($queryCachingDuration, $dependency)->createCommand($sql);
	    	$command->prepare();
	    	foreach($params as $key => $value){
	    		$command->bindParam($key,$params[$key]);
	    	}
			$result = $command->queryAll();
		}catch(Exception $e) {
			$result = null;
		}
		return $result;
	}
	
	//执行查询，返回单条数据
	public static function query($sql,$params=array(),$queryCachingDuration=0,$dependency=null){
		if(empty($sql)){
			return null;
		}
		$result = null;
		try
		{
			$connection = self::getDbCon();
			$command = $connection->cache($queryCachingDuration, $dependency)->createCommand($sql);
			$command->prepare();
			//不能使用bindParam($key,$value)
			foreach($params as $key => $value){
				$command->bindParam($key,$params[$key]);
			}
			$result = $command->queryRow();
			/*
			$resultlist = $command->queryAll();
			if($resultlist && count($resultlist) > 0){
				$result = $resultlist[0];
			}
			*/
		}catch(Exception $e) {
			$result = null;
		}
		return $result;
	}	
}