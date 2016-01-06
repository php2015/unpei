<?php 
// require_once 'phprpc/bigint.php';
// require_once 'phprpc/compat.php';
// require_once 'phprpc/phprpc_date.php';
// require_once 'phprpc/xxtea.php';
// require_once 'phprpc/phprpc_client.php';

class RPCClient{
	/*
	private static $client = null;
	
	//PRC调用客户端初始化
	public static function initClient(){
		if(self::$client == null){
			self::$client = new PHPRPC_Client();
			self::$client->setProxy(NULL);
			//self::$client->useService('http://localhost/JPData/queryServer/rpcserver.php');
			self::$client->useService('http://localhost/JPData/queryServer/RPCserver');
			self::$client->setKeyLength(1000);
			self::$client->setEncryptMode(3);
			self::$client->setCharset('UTF-8');
			self::$client->setTimeout(10);
		}
	}
	
	//RPC调用远程方法
	public static function call($service,$params){
		if(self::$client == null){
			self::initClient();
		}
		$args = json_encode(
			array(
				'client_ip'=>CommonUtil::getClientIP(),
				'client_id'=>'0001',
				'username'=>'jiaparts',
				'password'=>'jiaparts',
				'service'=>$service,
				'params'=>$params)
			);
		//return print_r($args);
		//return self::$client->test();
		$result = self::$client->service($args);
		$arr = json_decode($result,true);
		return $arr['result'];
	}
	*/
	
	/*
	//调用本地方法
	public static function call($service,$params=array()){
		//日志信息: 用户名 + 服务名 + 查询方式 + 是否成功 + 参数
		$logs = array('username'=>Yii::app()->user->name,'service'=>$service);
	
		//增加memcache缓存机制
		$memcache = new MemcacheUtil(Yii::app()->params['memcache']);
		$key = self::createMemcacheKey($service,$params);
		$result = $memcache->getKey($key);
		$logs['datasource'] = 'memcache';
		if(!$result){
			//依据service调用不同的方法
			$result = APIServer::executeService($service,$params);
	
			if($result && self::isCacheService($service)){
				$memcache->setKey($key,$result);
			}
			if(is_null($result)) {
				$result = array();
			}
			$logs['datasource'] = 'database';
		}
		$memcache->close();
		//记录日志信息
		$logs['result'] = is_null($result)?'result_is_null':'result_not_null';
		$logs['message'] = 'Success';
		$logs['params'] = "params:".CommonUtil::createLinkstring($params);
		$message = implode(" ", $logs);
		Yii::log($message,CLogger::LEVEL_INFO,'service.localcall');
		return $result;
	}
	*/
	
	public static function call($service,$params=array()){
		// 缓存时间，大于0时才缓存
		$queryCachingDuration = F::sg('cache','jpdataCachingDuration');
		if($queryCachingDuration > 0 && self::isCacheService($service)) {
			$cache = Yii::app()->cache;
			$cache_key = self::createCacheKey($service,$params);
			$cache_value = $cache->get($cache_key);
			if($cache_value) {
				return $cache_value;
			}
		}
		//依据service调用不同的方法
		$result = APIServer::executeService($service,$params);
		// 设置缓存
		if($queryCachingDuration > 0 && !empty($result)){
			$cache = Yii::app()->cache;
			$cache->set($cache_key,$result);
		}
		if(is_null($result)) {
			$result = array();
		}
		return $result;
	}
	
	//依据请求串生成memcache的键值
	public static function createCacheKey($service,$params){
		$key = "service=".$service."&";
		foreach($params as $pkey => $pvalue){
			$key.= $pkey."=".urlencode($pvalue)."&";
		}
		$key = substr($key,0,count($key)-2);
		//如果存在转义字符，那么去掉转义
		if(get_magic_quotes_gpc()){$key = stripslashes($key);}
		return $key;
	}
	
	//返回结果是否放入缓存
	static function isCacheService($service){
		if(strpos($service,'LogService') === 0 || strpos($service,'LogService') > 0){
			return false;
		}
		return true;
	}
}
?>