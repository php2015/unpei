<?php 
class LogService{
	/**
	 * 用户登录日志
	 * @param $params
	 */
	/*
	public static function logUserLogin($params){
		//检查参数
		if(!isset($params["userID"]) || empty($params["userID"])){
			return null;
		}
		//参数信息
		$userID = $params["userID"];
		$ip = $params["ip"];
		$fromCookie = $params["fromCookie"];
		$logintime = time();
		if(empty($ip)){
			$ip = "255.255.255.255";
		}
		//插入数据库
		$sql = "insert into jpd_log_userlogin(userid,loginip,logintime,fromcookie)"
			." values(:userID,:ip,:logintime,:fromCookie)";
		$sqlParams = array(':userID'=>$userID,':ip'=>$ip,':logintime'=>$logintime,':fromCookie'=>$fromCookie);
		$result = DBUtil::execute($sql,$sqlParams);
		return $result;
	}
	*/
	/**
	 * epc查询日志
	 */
	public static function logQueryEpc($params)
	{
		try{
			//检查参数
			if(!isset($params["userId"]) || empty($params["userId"])){
				return null;
			}
			if(!isset($params["modelId"]) || empty($params["modelId"])){
				return null;
			}	
			if($params['querytype']==0 && (!isset($params["groupId"]) || empty($params["groupId"]))){
				return null;
			}
			if($params['querytype']==1 && (!isset($params["partId"]) || empty($params["partId"]))){
				return null;
			}			
			$userId = $params["userId"];
			$modelId = $params['modelId'];
			$querytype = $params['querytype'];
			$groupId = $params['groupId'];
			$maingroupId = $params['maingroupId'];
			$partId = $params['partId'];
			$nowtime = time();	    
			
			//插入epc日志数据
			$sql="insert into {{epc_query_log}} (userid,querytime,querytype,modelid,groupid,maingroupid,partid)
			      values(:userid,:querytime,:querytype,:modelid,:groupid,:maingroupid,:partid)";
			$sqlParams = array(':userid'=>$userId,':querytime'=>$nowtime,':querytype'=>$querytype,':modelid'=>$modelId,
					':groupid'=>$groupId,':maingroupid'=>$maingroupId,':partid'=>$partId);
		    $result = DBUtil::execute($sql,$sqlParams);
			//return $result;
		}catch(Exception $e){
		}
	}
	
	/**
	 * 前市场车型查询日志
	 */
	public static function logFrontModelQuery($params)
	{
		try{
			//检查参数
			if(!isset($params["userId"]) || empty($params["userId"])){
				return null;
			}
			if(!isset($params["modelId"]) || empty($params["modelId"])){
				return null;
			}		
			$userId = $params['userId'];
			$modelId = $params['modelId'];
			$querytype = 0;
			$nowtime = time();
	
			//插入前市场日志数据
			$sql="insert into  {{front_query_log}} (userid,querytype,querytime,modelid)
				  values(:userid,:querytype,:querytime,:modelid)	";
			$sqlParams = array(':userid'=>$userId,':querytime'=>$nowtime,':querytype'=>$querytype,':modelid'=>$modelId);		
			$result = DBUtil::execute($sql,$sqlParams);
			//return $result;
		}
		catch(Exception $e){
		}
		
	}
	/**
	 * 前市场车辆养护周期查询日志
	 */
	public static function logUserQueryMaintenance($params)
	{
		try{
			//检查参数
			if(!isset($params["userID"]) || empty($params["userID"])){
				return null;
			}
			if(!isset($params["vehicleID"]) || empty($params["vehicleID"])){
				return null;
			}
			$userID = $params['userID'];
			$vehicleID = $params['vehicleID'];
			$querytype = 0;
			$nowtime = time();
			
			//查询前市场厂家，车型
			$sql="select make,CONCAT(car ,' ',engine) as model from {{jpd_vehicle_mtc}} where vehicleMtcID = :vehicleID ";
			$sqlParams = array(':vehicleID'=>$vehicleID);
			$vehicleinfo = DBUtil::query($sql,$sqlParams);
			if($vehicleinfo){
				$make = $vehicleinfo['make'];
				$model = $vehicleinfo['model'];
			}
			//插入前市场车型数据
			$sql = "insert into {{jpd_log_userquery_mtc}}(userid,querytype,querytime,vehiclemtcid,make,model)
				  values(:userID,:querytype,:querytime,:vehicleID,:make,:model)	";
			$sqlParams = array(':userID'=>$userID,':querytime'=>$nowtime,':querytype'=>$querytype,':vehicleID'=>$vehicleID,
					':make'=>$make,':model'=>$model);		
			$result = DBUtil::execute($sql,$sqlParams);
			return $result;
		}
		catch(Exception $e){
		}
	}
}
?>