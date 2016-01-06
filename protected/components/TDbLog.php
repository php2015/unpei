<?php 
class TDbLog
{
	public static $logTableName='tbl_log';
	
	public static function info($category,$userId,$action,$params,$message)
	{
		$level = 'info';
		$logtime = time();
		if(is_array($params)){
			if(!is_null($params) && count($params) > 0) {
				$params = json_encode($params);
			}else {
				$params = '';
			}
		}else if(!is_string($params)){
			$params = "format error";
		}

		$log = array($message,$level,$category,$logtime,$userId,$action,$params);
		self::processLog($log);
	}
	
	public static function processLog($log)
	{
		$sql="
		INSERT INTO ".self::$logTableName."
		(level, category, logtime, message, userId, action, params) VALUES
		(:level, :category, :logtime, :message, :userId, :action,:params)
		";
		$command=Yii::app()->db->createCommand($sql);
		$command->bindValue(':level',$log[1]);
		$command->bindValue(':category',$log[2]);
		$command->bindValue(':logtime',(int)$log[3]);
		$command->bindValue(':message',$log[0]);
		$command->bindValue(':userId',$log[4]);
		$command->bindValue(':action',$log[5]);
		$command->bindValue(':params',$log[6]);
		$command->execute();
	}
}