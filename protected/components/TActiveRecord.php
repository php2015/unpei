<?php 
class TActiveRecord extends CActiveRecord
{
	/**
	 * 字段别名数组，
	 * key:字段别名；
	 * value:字段名
	 *
	 * @var array
	 */
	public $_fieldsArias = array();
	
	public function __get($name) {
		if (isset($this->_fieldsArias[$name])) {
			return parent::__get($this->_fieldsArias[$name]);
		}
		else {
			return parent::__get($name);
		}
	}
	
	
	public function __set($name,$value)
	{
		if (isset($this->_fieldsArias[$name])) {
			parent::__set($this->_fieldsArias[$name],$value);
		}
		else {
			parent::__set($name,$value);
		}
	}
	
	/**
	 * 根据字段别名，返回真实字段名
	 *
	 * @param string or array $name
	 *         格式1：uid,uname
	 *         格式2：uid
	 *
	 * @return string
	 *
	 * 如果不存在指定的字段别名，则抛出异常并中止程序执行
	 */
	public function getRealFieldName($name) {
		if ( strpos($name, ',') ) {
			$arr = explode(',', $name);
			$arrResult = array();
	
			foreach ($arr as $key=>$val) {
				$arrResult[] = $this->getRealFieldName($val);
			}
	
			return implode(',', $arrResult);
		}
		elseif (isset($this->_fieldsArias[$name])) {
			return $this->_fieldsArias[$name];
		}
		else {
			throw new CHttpException(12,'非法字段别名，请核查！')    ;
		}
	}
}

?>