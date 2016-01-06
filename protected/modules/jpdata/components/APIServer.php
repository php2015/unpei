<?php
class APIServer{
	/*
	//服务方法入口
	static function service($request) {
		$request_arr = json_decode($request,true);
		$client_id = $request_arr['client_id'];
		$username = $request_arr['username'];
		$password = $request_arr['password'];
		$service = $request_arr['service'];
		$params = $request_arr['params'];
		
		//日志信息
		$current_time = date('Y-m-d H:i:s');
		$log_arr = array_merge(array('current_time'=>$current_time),$request_arr,
					array('params'=>json_encode($params)));
		
		//验证用户名密码
		$auth = new RPCAuth($username,$password,$client_id);
		if(!$auth->authenticate()){
			$log_arr['message'] = 'Authenticate Error';
			RPCLog::error($log_arr);
			return json_encode(array('result'=>false,'errno'=>$auth->errorCode,'errstr'=>'认证失败'));
		}
		
		//增加memcache缓存机制
		$memcache = new MemcacheUtil(Yii::app()->params['memcache']);
		$key = MemcacheUtil::createMemcacheKey($service,$params);
		$result = $memcache->getKey($key);
		$log_arr['datasource'] = 'memcache';
		if(!$result){
			//依据service调用不同的方法
			$result = APIServer::executeService($service,$params);
			
			if(!is_null($result) && self::isCacheService($service)){
				$memcache->setKey($key,$result);
			}
			$log_arr['datasource'] = 'database';
		}
		$memcache->close();
		
		//记录日志信息
		$log_arr['message'] = 'Success';
		RPCLog::access($log_arr);
		
		return json_encode(array('result'=>$result));
	}
	*/
	//调用具体服务方法
	static function executeService($serviceName, $params){
		$service_arr = explode("_", $serviceName);
		$className = $service_arr[0];
		$funcName = $service_arr[1];
		
		$result = call_user_func(array($className, $funcName),$params);
		return $result;
	}
	
	//PRC远程调用测试方法
	static function test(){
		return 'server ok!';
	}
}
?>