<?php 
class MaintenanceService{
	
	//查询车型的保养周期信息
	public static function queryFrontVehicleMaintenanceinfo($params){
		//检查参数
		if(!isset($params["vehicleID"]) || empty($params["vehicleID"])){
			exit;
		}
			
		//查询参数
		$vehicleID = (int)$params["vehicleID"];
	
		//车型保养周期信息息
		$sql="select b.FirstMileage, b.FirstPeriod, b.SecondMileage, b.SecondPeriod, b.IntervalMileage, b.IntervalPeriod"
			." from {{vehicle_to_maintenance_config}} a,{{maintenance_config}} b"
			." where a.MaintenanceConfigID = b.MaintenanceConfigID"
		    ."   and a.vehicleid = :vehicleID";
		$sqlParams = array(':vehicleID'=>$vehicleID);
		$result = DBUtil::query($sql,$sqlParams);
		return  $result;
	}

	//查询车型的保养项目信息
	public static function queryFrontVehicleMaintenanceIteminfo($params){
		//检查参数
		if(!isset($params["vehicleID"]) || empty($params["vehicleID"])){
			exit;
		}
			
		//查询参数
		$vehicleID = (int)$params["vehicleID"];
	
		//车型保养周期信息息
		$sql="select c.ItemName, b.Mileage, b.Period, b.Desc, b.InFirst, b.InSecond"
			." from {{vehicle_to_maintenance_config}} a, {{maintenance_config_to_item}} b, {{maintenance_item}} c"
			." where a.MaintenanceConfigID = b.MaintenanceConfigID"
			."   and b.ItemID = c.ItemID"					
		    ."   and a.vehicleid = :vehicleID";
		$sqlParams = array(':vehicleID'=>$vehicleID);
		$result = DBUtil::queryAll($sql,$sqlParams);
		return  $result;
	}

	//查询车型的易损件更换周期信息
	public static function queryFrontVehicleWearpartinfo($params){
		//检查参数
		if(!isset($params["vehicleID"]) || empty($params["vehicleID"])){
			exit;
		}
			
		//查询参数
		$vehicleID = (int)$params["vehicleID"];
	
		//车型易损件更换周期信息
		$sql="select c.WearpartName, b.ChangeMileage, b.ChangePeriod, b.ChangeAddition, b.ChangeNum, b.OENO, b.Specification"
			." from {{vehicle_to_wearpart_config}} a,{{wearpart_config_to_item}} b, {{wearpart_item}} c"
			." where a.WearpartConfigID = b.WearpartConfigID"
			."   and b.WearpartID = c.WearpartID"
		    ."   and a.vehicleid = :vehicleID";
		$sqlParams = array(':vehicleID'=>$vehicleID);
		$result = DBUtil::queryAll($sql,$sqlParams);
		
		return  $result;
	}
}
?>