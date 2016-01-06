<?php 
class CommonUtil
{
	/**
	 * 获取客户端IP地址
	 * @return $client_ip
	 */
	public static function getClientIP(){
		$client_ip = ($_SERVER["HTTP_VIA"]) ? $_SERVER["HTTP_X_FORWARDED_FOR"] : $_SERVER["REMOTE_ADDR"];
		$client_ip = ($client_ip) ? $client_ip : $_SERVER["REMOTE_ADDR"];
		return 	$client_ip;
	}

	/**
	 * 合并参数数组
	 * @param $para
	 * @return string
	 */
	public static function createLinkstring($para) {
		$arg  = "";
		while (list ($key, $val) = each ($para)) {
			$arg.=$key."=".$val."&";
		}
		//去掉最后一个&字符
		$arg = substr($arg,0,count($arg)-2);
	
		//如果存在转义字符，那么去掉转义
		if(get_magic_quotes_gpc()){$arg = stripslashes($arg);}
	
		return $arg;
	}
	
	/**
	 * 
	 * @param $imgpath 图片相对路径
	 * @param $imgserver 图片服务器信息
	 * @param $imgtype 图片类型
	 */
	public static function generateImgUrl($imgpath, $imgserver=array(), $imgtype){
		$url = '';
		if(empty($imgpath)){
			return $url;
		}
		if(!$imgserver || count($imgserver) == 0){
			return $url;
		}
		$domain = $imgserver['domain'];
		$path = $imgserver['path'];
		if(!empty($imgtype)){
			$info = $imgserver[$imgtype];
			if($info){
				if(!empty($info['path'])){
					$path = $info['path'];
				}
				if(!empty($info['domain'])){
					$domain = $info['domain'];
				}
			}
		}
		$domain = rtrim($domain,"/");
		$path = trim($path,"/");
		$imgpath = ltrim($imgpath,"/");
		if(empty($path)){
			$url = $domain.'/'.$imgpath;
		}else{
			$url = $domain.'/'.$path.'/'.$imgpath;
		}
		return $url;
	}
	
	/**
	 * 图片url加密
	 * @param $url 图片URL
	 * @param $params 加密参数
	 */
	public static function encodeImgUrl($url,$params=array()){
		// 参数为空，则不进行URL加密
		if(empty($url)){
			return $url;
		}
		//$url = Yii::app()->params['imgdomain'].ltrim($url,"/");
		// 加密功能是否启动
		if(empty($params) || !($params['enable'] === true)){
			return $url;
		}
		// 图片根目录
		$dir = $params['dir'];
		// 加密密钥
		$key = $params['key'];
		// 加密串过期时间，单位秒
		$expiry = (int)$params['expiry'];
		// 变化密钥的长度，大于0时每次生产的加密串都不同
		$ckey_len = (int)$params['ckey_len'];
		// 加密串前缀
		$prefix = $params['prefix'];
		// 取图片主路径 http://zzz//主目录
		$url_tmp = str_replace('http://','',$url);
		$pos = stripos($url_tmp, $dir);
		$signurl = "";
		if(!($pos===false)){
			$signurl = 'http://'.substr($url_tmp,0,$pos).$dir;
		}
		// 图片后缀
		$suffixPos = strrpos($url,".");
		$suffix = "";
		if(!($suffixPos===false)){
			$suffix = ".".substr($url,$suffixPos+1);
		}
		$sign = CommonUtil::authcode($url,'ENCODE',$key,$expiry,$ckey_len);
		// 加密串中 /转换为 !, +转换为 - ，因为/ + 两个特殊字符会影响后续的解码
		$sign = str_replace("/", "!", $sign);
		$sign = str_replace("+", "-", $sign);
		//$sign = urlencode($sign);
		// 组合最后的图片URL
		$signurl = rtrim($signurl,"/")."/".$prefix.$sign.$suffix;
		return $signurl;
	}
	
	/**
	 * 加密/解密算法
	 * @param $string： 明文 或 密文
	 * @param $operation：DECODE表示解密,其它表示加密
	 * @param $key： 密匙
	 * @param $expiry：密文有效期
	 * @return string
	 */
	public static function authcode($string, $operation = 'DECODE', $key = '', $expiry = 0, $ckey_len = 0) {
	
		// 动态密匙长度，相同的明文会生成不同密文就是依靠动态密匙
		$ckey_length = $ckey_len;
	
		// 密匙
		$key = md5($key);
	
		// 密匙a会参与加解密
		$keya = md5(substr($key, 0, 16));
	
		// 密匙b会用来做数据完整性验证
		$keyb = md5(substr($key, 16, 16));
	
		// 密匙c用于变化生成的密文
		$keyc = $ckey_length ? ($operation == 'DECODE' ? substr($string, 0, $ckey_length): substr(md5(microtime()), -$ckey_length)) : '';
	
		// 参与运算的密匙
		$cryptkey = $keya.md5($keya.$keyc);
		$key_length = strlen($cryptkey);
	
		// 明文，前10位用来保存时间戳，解密时验证数据有效性，10到26位用来保存$keyb(密匙b)，解密时会通过这个密匙验证数据完整性
		// 如果是解码的话，会从第$ckey_length位开始，因为密文前$ckey_length位保存 动态密匙，以保证解密正确
		$string = $operation == 'DECODE' ? base64_decode(substr($string, $ckey_length)) : sprintf('%010d', $expiry ? $expiry + time() : 0).substr(md5($string.$keyb), 0, 16).$string;
		$string_length = strlen($string);
		$result = '';
		$box = range(0, 255);
		$rndkey = array();
	
		// 产生密匙簿
		for($i = 0; $i <= 255; $i++) {
			$rndkey[$i] = ord($cryptkey[$i % $key_length]);
		}
	
		// 用固定的算法，打乱密匙簿，增加随机性，好像很复杂，实际上对并不会增加密文的强度
		for($j = $i = 0; $i < 256; $i++) {
			$j = ($j + $box[$i] + $rndkey[$i]) % 256;
			$tmp = $box[$i];
			$box[$i] = $box[$j];
			$box[$j] = $tmp;
		}
	
		// 核心加解密部分
		for($a = $j = $i = 0; $i < $string_length; $i++) {
			$a = ($a + 1) % 256;
			$j = ($j + $box[$a]) % 256;
			$tmp = $box[$a];
			$box[$a] = $box[$j];
			$box[$j] = $tmp;
			// 从密匙簿得出密匙进行异或，再转成字符
			$result .= chr(ord($string[$i]) ^ ($box[($box[$a] + $box[$j]) % 256]));
		}
	
		if($operation == 'DECODE') {
			// substr($result, 0, 10) == 0 验证数据有效性
			// substr($result, 0, 10) - time() > 0 验证数据有效性
			// substr($result, 10, 16) == substr(md5(substr($result, 26).$keyb), 0, 16) 验证数据完整性
			// 验证数据有效性，请看未加密明文的格式
			if((substr($result, 0, 10) == 0 || substr($result, 0, 10) - time() > 0) && substr($result, 10, 16) == substr(md5(substr($result, 26).$keyb), 0, 16)) {
				return substr($result, 26);
			} else {
				return '';
			}
		} else {
			// 把动态密匙保存在密文里，这也是为什么同样的明文，生产不同密文后能解密的原因
			// 因为加密后的密文可能是一些特殊字符，复制过程可能会丢失，所以用base64编码
			return $keyc.str_replace('=', '', base64_encode($result));
		}
	}
}