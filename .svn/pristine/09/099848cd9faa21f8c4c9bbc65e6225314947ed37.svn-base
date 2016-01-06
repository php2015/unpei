<?php 
class MemcacheUtil{
	private $_memcache = null;
	private $_enabled = false;
	private $_servers = array();
	private $_compressed = 0;
	private $_expire = 300;
	
	//构造函数
	public function MemcacheUtil($args){
		$this->_enabled = $args['enable'];
		$this->_servers = $args['servers'];
		$this->_compressed = $args['compressed'];
		$this->_expire = $args['expire'];
		if($this->_enabled && count($this->_servers) > 0){
			$host = $this->_servers[0];
			$this->connect($host);
			$serverlist = array_slice($this->_servers,1);
			$this->addServers($serverlist);
		}
	}
	
	//连接memcache服务器
	public function connect($host){
		list ($ip, $port) = explode(":", $host);
		if(isset($ip) && !empty($ip)){
			$port = !empty($port)?$port:'11211';
			$this->_memcache = new Memcache;
			$this->_memcache->connect($ip, $port);
		}
	}
	
	//增加memcache服务器列表
	public function addServers($list){
		if($this->_memcache){
			foreach ($list as $host){
				list ($ip, $port) = explode(":", $host);
				if(isset($ip) && !empty($ip)){
					$port = !empty($port)?$port:'11211';
					$this->_memcache->addServer($ip, $port);
				}
			}
		}
	}
	
	//获取缓存
	public function getKey($key){
		if($this->_memcache){
			return $this->_memcache->get($key);
		}
		return null;
	}
	
	//设置缓存
	public function setKey($key,$value){
		if($this->_memcache && !is_null($value)){
			$this->_memcache->set($key,$value,$this->_compressed,$this->_expire);
		}
	}
	
	//关闭连接
	public function close(){
		if($this->_memcache){
			$this->_memcache->close();
		}
	}

	//依据请求串生成memcache的键值
	public static function createMemcacheKey($service,$params){
		$key = $service."_";
		foreach($params as $pkey => $pvalue){
			$key .= $pkey ."_".$pvalue;
		}
		return md5($key);
	}
}
?>