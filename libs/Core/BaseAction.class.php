<?php
/**
 * --------------------
 * 参照于struts框架设计,作为Controller层的基类
 * 注: HttpReuqest,HttpResponse类在此文件中定义,是为了快速装载的需要.
 *
 * @author cooc <yemasky@msn.com>
 * @date 2006-06-17
 */


/**
 * 请求对象,用于在各个模块之间传递参数
 * @date 2006-06-17
 */
class HttpRequest {
	/** 分支KEY,即$_REQUEST['action'] **/
	private static $ACTION_KEY = "action";
	/** 保存从浏览器提交变量,即$_REQUEST.不可修改 **/
	private $parameters = NULL;
	/** 分支 **/
	private $actionValue = NULL;
	
	private $pname = NULL;
	
	public function __construct() {
		$this -> parameters = $_REQUEST;
		if(isset($_SERVER['argc']) && $_SERVER['argc']==2) { 
			$arrVariables = explode('&', $_SERVER['argv'][1]);
			$arrParameter = NULL;
			if(!empty($arrVariables[0])) {
				foreach($arrVariables as $k => $v) {
					$arrVariable = explode('=', $v);
					if(!isset($arrVariable[1])) $arrVariable[1] = NULL;
					$arrParameter[$arrVariable[0]] = $arrVariable[1];
				}
			}
			$this -> parameters = $arrParameter;
		} 

		if(isset($this -> parameters["param"])) {
			if($this -> parameters["param"] != NULL) {
				$this -> parameters = array_merge($this -> getParse($this -> __get("param")), $this -> parameters);
				unset($this -> parameters["param"]);
			}
		}
	}
	
	public function __get($pname) {
		if(isset($this -> parameters[$pname])) {
			if (get_magic_quotes_gpc()) {
				return $this -> parameters[$pname];
			}
			if(is_array($this -> parameters[$pname])) {
				return $this -> addArraySlashes($this -> parameters[$pname]);
			}
			return addslashes($this -> parameters[$pname]);
		} else {
			return NULL;
		}
	}
	
	public function getPost($pname = NULL) {
		if(!empty($pname)) {
			if(isset($_POST[$pname])) {
				return $this -> __get($pname);
			}
		} else {
			if (get_magic_quotes_gpc()) {
				return $_POST;
			}
			return $this -> addArraySlashes($_POST);
		}
		return NULL;
	}
	
	private function addArraySlashes($arrRs) {	
		foreach($arrRs as $k => $v) {
			if(is_array($v)) {
				$arrRs[$k] = $this -> addArraySlashes($v);
			} else {
				$arrRs[$k] = addslashes($v);
			}
		}
		return $arrRs;
	}
		
	public function __set($pname, $value) {
		if(empty($pname)){
			return false;
		} else {
			$this -> parameters[$pname] = $value;
		}
	}
	
	public function __isset($pname) {
	   return isset($this -> parameters[$pname]);
	}
	
	public function __unset($pname) {
	   unset($this -> parameters[$pname]);
	}
	
	public function getParse($arg) {
		$ret = array();
		$param = explode("/", $arg);
		foreach($param as $str) {
			$tmp = explode("-", $str);
			if(!isset($tmp[1])) $tmp[1] = '';
			$ret[$tmp[0]] = $tmp[1];
		}
		return $ret;
	}
	/**
	 * 取得内部分支
	 */
	public function getAction() {
		if($this -> actionValue == NULL) {
			if(isset($this -> parameters[self::$ACTION_KEY])) {
				$this -> actionValue = $this -> parameters[self::$ACTION_KEY];
			}
		}
		return $this -> actionValue;
	}

	/**
	 * 取得内部分支
	 */
	public function setAction($actionValue) {
		$this -> actionValue = $actionValue;
	}

}

/**
 * 响应对象,用于设置向View层传递的参数
 * @author cooc <yemasky@msn.com>
 * @date 2006-06-17
 */
class HttpResponse {
	/** 模板文件名 **/
	private $tplName = NULL;
	/** 模板参数 **/
	private $tplValues = NULL;
	
	/**
	 * 构造函数
	 */
	public function __construct() {
		$this -> tplName = NULL;
		$this -> tplValues = array();
	}

	/**
	 * 取得模板名
	 */
	public function getTplName() {
		return $this -> tplName;
	}

	/**
	 * 设定模板名
	 */
	public function setTplName($tplName) {
		$this -> tplName = $tplName;
	}

	/**
	 * 设定(添加)模板参数
	 */
	public function setTplValue($name, $value) {
		if(empty($name)) {
			throw new Exception("tpl value's name cann't empty.");
		}
		$this -> tplValues[$name] = $value;
	}
	
	public function __set($name, $value) {
		if(empty($name)) {
			throw new Exception("tpl value's name cann't empty.");
		}
		$this -> tplValues[$name] = $value;
	}

	/**
	 * 取得模板中的值(返回数组)
	 */
	public function getTplValues($name = NULL) {
		if(!empty($name)) {
			if(!isset($this -> tplValues[$name])) return NULL;
			return $this -> tplValues[$name];
		}
		return $this -> tplValues;
	}
	
	public function __get($name = NULL) {
		if(!empty($name)) {
			if(!isset($this -> tplValues[$name])) return NULL;
			return $this -> tplValues[$name];
		}
		return $this -> tplValues;
	}
}

/**
 * 响应对象,保存了用于在View层显示的数据
 * @author cooc <yemasky@msn.com>
 * @date 2006-06-17
 */
abstract class BaseAction {
	private $displayDisabled = false;
	private $showErrorPage = true;
	private $isHeader = false;
	private $compiler = __COMPILE;
	private $dbrollback = false;
	private $_cache = false;
	private $_cache_id = '';
	private $_cache_time = 7200;
	private $_cache_dir = __CACHE;
	private $_renew_cachedir = true;
	private $_create_html = false;
	private $_html_name = '';
	private $_html_dir = __HTML;
	/**
	 * 检查入力参数,若是系统错误(严重错误,则抛出异常)
	 */
	protected abstract function check($objRequest, $objResponse);

	/**
	 * 执行应用逻辑
	 */
	protected abstract function service($objRequest, $objResponse);
	
	/**
	 * 资源回收
	 */
	protected function release($objRequest, $objResponse) { }
	
	/**
	 * 错误处理
	 */
	protected function tryexecute($objRequest, $objResponse) { }

	/**
	 * 错误处理
	 */
	protected function finalexecute($objRequest, $objResponse) { }
	/**
	 * 错误页面
	 */
	protected function setErrorPage($flag = false) {
		$this -> showErrorPage = $flag;
	}
	/**
	 * 禁用显示
	 */
	public function setDisplay($flag = true) {
		$this -> displayDisabled = $flag;
	}
	/**
	 * 缓存页面
	 */
	public function setCache($_cache_id = NULL, $flag = true, $_cache_time = 7200, $_cache_dir = __CACHE, $_renew_cachedir = true) {
		if(empty($_cache_id)) {
			throw new Exception("_cache_id cann't empty.");
		}
		$this -> _cache = $flag;
		$this -> _cache_id = $_cache_id;
		$this -> _cache_time = $_cache_time;
		$this -> _cache_dir = $_cache_dir;
		$this -> _renew_cachedir = $_renew_cachedir;
	}
	public function setCreateHtml($_html_name, $_html_dir = __HTML, $flag = true) {
		$this -> _create_html = $flag;
		$this -> _html_name = $_html_name;
		$this -> _html_dir = $_html_dir;
	}
	/**
	 * 事务回滚
	 */
	public function dbRollback($flag = true) {
		$this -> dbrollback = $flag;
	}
	/**
	 * 是否Header
	 */
	public function sendHeader($flag = true) {
		$this -> isHeader = $flag;
	}
	/***
	 * 受否编译模板
	 */
	public function setCompiler($flag = true) {
		$this -> compiler = $flag;
	}
	/**
	 * Controller层的调用入口函数,在scripts中调用
	 */
	public function execute($action = NULL) {
		$startTime = getMicrotime();
		try {
			$error_handler = set_error_handler("ErrorHandler");
			$objRequest = new HttpRequest();
			$objResponse = new HttpResponse();
			//指定action
			if($action != NULL) {
				$objRequest -> setAction($action);
			}
			//入力检查
			$this -> check($objRequest, $objResponse);
			$isCacheValid = false; 
			if($this -> _cache)  {
				$objDBCache = new DBCache;
				$objDBCache -> cache_dir = $this -> _cache_dir;
				$isCacheValid = $objDBCache -> isValid($this -> _cache_id, $this -> _cache_time, $this -> _renew_cachedir);
			} 
			//if(!ob_start("ob_gzhandler")) 
			ob_start();
			if(!$isCacheValid) {
				//执行方法
				$this -> service($objRequest, $objResponse);
				if($this -> displayDisabled == false) {
					$this -> display($objResponse, $this -> compiler);
					if($this -> _cache) {
						 $objDBCache -> cachePage($this -> _cache_id, json_encode(ob_get_contents()), $this -> _renew_cachedir);
					}
					if($this -> _create_html) {
						File::creatFile($this -> _html_name, ob_get_contents(), $this -> _html_dir);
					}
				}
			} else {
				echo json_decode($objDBCache -> fetch($this -> _cache_id, false, $this -> _renew_cachedir));
			}
			ob_implicit_flush(1);
			ob_end_flush();
			//资源回收
			$this->release($objRequest, $objResponse);
			//数据库事务提交(由DBQuery判断是否需要做)
			//DBQuery::instance()->commit();

		} catch (Exception $e) {
			if(__Debug) {
				print_r($e -> getMessage());
				print_r($e -> getTraceAsString());
			}
			try {
				//错误处理
				$this -> tryexecute($objRequest, $objResponse);
				//数据库事务回滚(由DBQuery判断是否需要做)
				//DBQuery::instance()->rollback();

			} catch(Exception $e) {
				logError($e -> getMessage(), __MODEL_EXCEPTION);
				if(__Debug) {
					print_r($e -> getMessage());
					print_r($e -> getTraceAsString());
				}
			}
			//错误日志
			logError($e -> getMessage(), __MODEL_EXCEPTION);
			logError($e -> getTraceAsString(), __MODEL_EMPTY);
			//重定向到错误页面
			//redirect("errorpage.htm");
			//最终处理
			$this -> finalexecute($objRequest, $objResponse);
			//set_exception_handler('exception_handler');
			if($this -> showErrorPage && __Debug == false) redirect(__WEB . "404.htm");
		}
		//debug...
		if(__Debug) {
			$endTime = getMicrotime();
			$useTime = $endTime - $startTime;
			logDebug("excute time $useTime s");
		}
	}

	/**
	 * 调用View层输出
	 */
	private function display($objResponse, $compiler = true) {
		if($this -> isHeader == false) {
			header("Content-type: text/html; charset=".__CHARSET);
		}
		$tplName = $objResponse->getTplName();
		if(empty($tplName)) {
			throw new Exception("template name cann't empty.");
		}
		// dispaly
		require_once(__ROOT_PATH.'libs/Smarty/libs/Smarty.class.php');
        $smarty = new Smarty;
        $smarty->template_dir = __ROOT_TPLS_TPATH;
        $smarty->compile_dir  = __ROOT_TPLS_TPATH."templates_c/";
        $smarty->config_dir   = __ROOT_TPLS_TPATH."config_dir/";
        $smarty->cache_dir    = __ROOT_TPLS_TPATH."cache_dir/";
        //设置默认值(项目相关)
        $smarty->assign("__CHARSET", __CHARSET);
		$smarty->assign("__LANGUAGE", __LANGUAGE);
		$smarty->assign("__WEB", __WEB);
		$smarty->assign("__RESOURCE", __RESOURCE);
		$smarty->assign("__USER_IMGWEB", __USER_IMGWEB);
		$smarty->assign("__IMGWEB", __IMGWEB);
		$smarty->assign("__PIC", __PIC);
	
		// bulk assign values
		$smarty->assign($objResponse->getTplValues());
		// diplay the template
		$smarty->display($tplName.".tpl");
		/*$temp = new Template;
		$temp -> setTpl($tplName.".htm");
		$temp -> setVar($objResponse -> getTplValues());
		$temp -> setVar("__CHARSET", __CHARSET);
		$temp -> setVar("__LANGUAGE", __LANGUAGE);
		$temp -> setVar("__WEB", __WEB);
		$temp -> diapaly($compiler);*/
	}
}

class NotFound extends BaseAction {
	
	protected function check($objRequest, $objResponse) {
	}

	protected function service($objRequest, $objResponse) {
		switch($objRequest->getAction()) {
			default:
				$this->doShowPage($objRequest, $objResponse);
			break;
		}
	}

	/**
	 * 首页显示 
	 */
	protected function doShowPage($objRequest, $objResponse) {
		$objResponse -> setTplName("www/NotFound");
	}
}

class DBQuery {
	private $dsn = NULL;
	/** 已创建的连接集合 **/
	private static $instances = array();
	private static $db_ins = array();
	private $strDsn = '';
	private $_db = '';
	/**
	 * 表主键
	 */
	public $pk = 'id';
	/**
	 * 表全名
	 */
	public $tbl_name = NULL;
	
	/**
	 * 构造函数
	 */
	public function __construct($dsn = __DEFAULT_DSN) {
		$arrDsnInfo = $this -> explodeDsn($dsn);
		if(isset(self::$db_ins[$this->strDsn])) {
			 if(is_object(self::$db_ins[$this->strDsn]) && !empty(self::$db_ins[$this->strDsn])) {
				 if($this->_db != $arrDsnInfo['database']) {
					 self::$db_ins[$this->strDsn]->selectDB($arrDsnInfo['database']);
					 $this->_db = $arrDsnInfo['database'];
				 }
				 return;
			 }
    	}
		require_once(__ROOT_PATH . 'libs/Drivers/' . $arrDsnInfo['driver'] . '.php');
		self::$db_ins[$this->strDsn] = new $arrDsnInfo['driver']($arrDsnInfo);
		$this->_db = $arrDsnInfo['database'];
	}
	
	public function setDsn($dsn = __DEFAULT_DSN) {
		$this -> __construct($dsn);
	}

	public function setTable($table) {
		$this->tbl_name = $table;
	}
	/**
	 * 执行SQL语句，相等于执行新增，修改，删除等操作。
	 *
	 * @param sql 字符串，需要执行的SQL语句
	 */
	public function query($sql){return self::$db_ins[$this->strDsn]->exec($sql);}

	/**
	 * 从数据表中查找记录
	 *
	 * @param conditions    查找条件，数组array("字段名"=>"查找值")或字符串，
	 * 请注意在使用字符串时将需要开发者自行使用escape来对输入值进行过滤
	 * @param sort    排序，等同于"ORDER BY "
	 * @param fields    返回的字段范围，默认为返回全部字段的值
	 * @param limit    返回的结果数量限制，等同于"LIMIT "，如$limit = " 3, 5"，即是从第3条记录（从0开始计算）开始获取，共获取5条记录
	 *                 如果limit值只有一个数字，则是指代从0条记录开始。
	 */
	public function getList($conditions = NULL, $sort = NULL, $fields = NULL, $limit = NULL) {
		$where = "";
		$fields = empty($fields) ? "*" : $fields;
		if(is_array($conditions)){
			$join = array();
			foreach( $conditions as $key => $condition ){
				$join[] = "`{$key}` = '{$condition}'";
			}
			$where = "WHERE ".join(" AND ",$join);
		}else{
			if(NULL != $conditions)$where = "WHERE ".$conditions;
		}
		if(NULL != $sort){
			$sort = "ORDER BY {$sort}";
		}else{
			if($this->pk != '') $sort = "ORDER BY {$this->pk} DESC";
		}
		$sql = "SELECT {$fields} FROM {$this->tbl_name} {$where} {$sort}";
		/*if(NULL != $limit)$sql = $this->_db->setlimit($sql, $limit);
		return $this->_db->getArray($sql);*/
		if(NULL != $limit)$sql = self::$db_ins[$this->strDsn]->setlimit($sql, $limit);
		return self::$db_ins[$this->strDsn]->getArray($sql);
	}
	
	/**
	 * 从数据表中查找一条记录
	 *
	 * @param conditions    查找条件，数组array("字段名"=>"查找值")或字符串，
	 * 请注意在使用字符串时将需要开发者自行使用escape来对输入值进行过滤
	 * @param sort    排序，等同于"ORDER BY "
	 * @param fields    返回的字段范围，默认为返回全部字段的值
	 */
	public function getRow($conditions = NULL, $fields = NULL) {
		if( $record = $this->getList($conditions, NULL, $fields, 1) ){
			return array_pop($record);
		}else{
			return FALSE;
		}
	}
	
	public function getOne($conditions = NULL, $fields = NULL) {
		$arrRow = $this->getRow($conditions, $fields);
		if(is_array($arrRow)) {
			$arrRow = array_values($arrRow);
			return $arrRow[0];
		}
		return false;
	}
	/**
	 * 在数据表中新增一行数据
	 *
	 * @param row 数组形式，数组的键是数据表中的字段名，键对应的值是需要新增的数据。
	 */
	public function insertData($row) {
		if(!is_array($row))return FALSE;
		if(empty($row))return FALSE;
		$cols = $vals = '';
		foreach($row as $key => $value){
			$cols .= $key . ',';
			if($value == 'NULL') {
				$vals .= "NULL" . ',';
			} else {
				$vals .= "'{$value}',";
			}
		}
		$cols = trim($cols, ',');
		$vals = trim($vals, ',');

		$sql = "INSERT INTO {$this->tbl_name} ({$cols}) VALUES ($vals)";
		if(self::$db_ins[$this->strDsn]->exec($sql)){ // 获取当前新增的ID
			if($newinserid = self::$db_ins[$this->strDsn]->newinsertid()){
				return $newinserid;
			}else{
				//return array_pop( $this->getOne($row, "{$this->pk} DESC",$this->pk) );
			}
		}
		/*if( FALSE != $this->_db->exec($sql) ){ // 获取当前新增的ID
			if( $newinserid = $this->_db->newinsertid() ){
				return $newinserid;
			}else{
				//return array_pop( $this->getOne($row, "{$this->pk} DESC",$this->pk) );
			}
		}*/
		return FALSE;
	}
	
	public function insertIgnoreData($row) {
		if(!is_array($row))return FALSE;
		if(empty($row))return FALSE;
		foreach($row as $key => $value){
			$cols[] = $key;
			if($value == 'NULL') {
				$vals[] = "NULL";
			} else {
				$vals[] = "'" . $value . "'";
			}
		}
		$col = join(',', $cols);
		$val = join(',', $vals);

		$sql = "INSERT IGNORE INTO {$this->tbl_name} ({$col}) VALUES ({$val})";
		if(self::$db_ins[$this->strDsn]->exec($sql)){ // 获取当前新增的ID
			if($newinserid = self::$db_ins[$this->strDsn]->newinsertid()){
				return $newinserid;
			}else{
				return NULL;
			}
		}
		return FALSE;
	}
	
	public function replaceInsertData($row) {
		if(!is_array($row))return FALSE;
		if(empty($row))return FALSE;
		foreach($row as $key => $value){
			$cols[] = $key;
			if($value == 'NULL') {
				$vals[] = "NULL";
			} else {
				$vals[] = "'" . $value . "'";
			}
		}
		$col = join(',', $cols);
		$val = join(',', $vals);

		$sql = "REPLACE INTO {$this->tbl_name} ({$col}) VALUES ({$val})";
		if(self::$db_ins[$this->strDsn]->exec($sql)){ // 获取当前新增的ID
			if($newinserid = self::$db_ins[$this->strDsn]->newinsertid()){
				return $newinserid;
			}else{
				return NULL;
			}
		}
		return FALSE;
	}
	
	public function getInsertId($dsn = __DEFAULT_DSN) {
		return self::$db_ins[$this->strDsn]->newinsertid();
	}
	/**
	 * 按条件删除记录
	 *
	 * @param conditions 数组形式，查找条件，此参数的格式用法与getOne/getList的查找条件参数是相同的。
	 */
	public function delete($conditions) {
		$where = "";
		if(is_array($conditions)){
			$join = array();
			foreach( $conditions as $key => $condition ){
				$join[] = "{$key} = '{$condition}'";
			}
			$where = "WHERE ( ".join(" AND ",$join). ")";
		}else{
			if(NULL != $conditions)$where = "WHERE ( ".$conditions. ")";
		}
		$sql = "DELETE FROM {$this->tbl_name} {$where}";
		return self::$db_ins[$this->strDsn]->exec($sql);
	}

	/**
	 * 按字段值修改一条记录
	 *
	 * @param conditions 数组形式，查找条件，此参数的格式用法与getOne/getList的查找条件参数是相同的。
	 * @param field 字符串，对应数据表中的需要修改的字段名
	 * @param value 字符串，新值
	 */
	public function updateField($conditions, $field, $value) {
		return $this->update($conditions, array($field=>$value));
	}

	/**
	 * 返回上次执行update,insertData,delete,exec的影响行数
	 */
	public function affectedRows($dsn = __DEFAULT_DSN) {
		return self::$db_ins[$this->strDsn]->affected_rows();
	}
	/**
	 * 计算符合条件的记录数量
	 *
	 * @param conditions 查找条件，数组array("字段名"=>"查找值")或字符串，
	 * 请注意在使用字符串时将需要开发者自行使用escape来对输入值进行过滤
	 */
	public function getCount($conditions = NULL) {
		$where = "";
		if(is_array($conditions)){
			$join = array();
			foreach( $conditions as $key => $condition ){
				$join[] = "{$key} = '{$condition}'";
			}
			$where = "WHERE ".join(" AND ",$join);
		}else{
			if(NULL != $conditions) $where = "WHERE ".$conditions;
		}
		$sql = "SELECT COUNT({$this->pk}) AS SP_COUNTER FROM {$this->tbl_name} {$where}";
		$result = self::$db_ins[$this->strDsn]->getArray($sql);
		return $result[0]['SP_COUNTER'];
	}

	/**
	 * 修改数据，该函数将根据参数中设置的条件而更新表中数据
	 * 
	 * @param conditions    数组形式，查找条件，此参数的格式用法与getOne/getList的查找条件参数是相同的。
	 * @param row    数组形式，修改的数据，
	 *  此参数的格式用法与insertData的$row是相同的。在符合条件的记录中，将对$row设置的字段的数据进行修改。
	 */
	public function update($conditions, $row) {
		$where = "";
		if(empty($row))return false;
		if(is_array($conditions)){
			if(empty($conditions)) return false;
			$join = array();
			foreach( $conditions as $key => $condition ){
				$join[] = "{$key} = '{$condition}'";
			}
			$where = "WHERE ".join(" AND ",$join);
		}else{
			if(NULL != $conditions)$where = "WHERE ".$conditions;
		}
		foreach($row as $key => $value){
			$vals[] = "{$key} = '{$value}'";
		}
		$values = join(", ",$vals);
		$sql = "UPDATE {$this->tbl_name} SET {$values} {$where}";
		return self::$db_ins[$this->strDsn]->exec($sql);
	}
	
	/**
	 * 替换数据，根据条件替换存在的记录，如记录不存在，则将条件与替换数据相加并新增一条记录。
	 * 
	 * @param conditions    数组形式，查找条件，请注意，仅能使用数组作为该条件！
	 * @param row    数组形式，修改的数据
	 */
	public function replace($conditions, $row) {
		
		return false;
	}
	
	/**
	 * 为设定的字段值增加
	 * @param conditions    数组形式，查找条件，此参数的格式用法与getOne/getList的查找条件参数是相同的。
	 * @param field    字符串，需要增加的字段名称，该字段务必是数值类型
	 * @param optval    增加的值
	 */
	public function increase($conditions, $field, $optval = 1)	{
		$where = "";
		if(is_array($conditions)){
			$join = array();
			foreach( $conditions as $key => $condition ){
				$join[] = "{$key} = '{$condition}'";
			}
			$where = "WHERE ".join(" AND ",$join);
		}else{
			if(NULL != $conditions)$where = "WHERE ".$conditions;
		}
		$values = "{$field} = {$field} + {$optval}";
		$sql = "UPDATE {$this->tbl_name} SET {$values} {$where}";
		return self::$db_ins[$this->strDsn]->exec($sql);
	}
	
	public function explodeDsn($dsn) {
		//mysql://smartercn:any@192.168.100.239/smartercn_FrontEnd
		$arrValue = explode('://', $dsn);
		$arrDsn['driver'] = $arrValue[0];
		$arrValue = explode('/', $arrValue[1]);
		$arrDsn['database'] = $arrValue[1];
		$arrValue = explode('@', $arrValue[0]);
		$arrDsn['host'] = $arrValue[1];
		$arrValue = explode(':', $arrValue[0]);
		$arrDsn['login'] = $arrValue[0];
		$arrDsn['password'] = $arrValue[1];
		$this -> strDsn = $arrDsn['driver'] .'://' . $arrDsn['login'] .':' . $arrDsn['password'] . '@'. $arrDsn['host'];
		//$this -> strDsn = $dsn;
		return $arrDsn;
	}
	
	public function close($dsn = __DEFAULT_DSN) {
		self::$db_ins[$this->strDsn]->close();
		unset(self::$db_ins[$this->strDsn]);
	}
	
	/**
	 * 魔术函数，执行模型扩展类的自动加载及使用
	 */
	public function __call($name, $args) {
		//echo $name;print_r($args);
		$objCallName = new $name($args);//var_dump($objCallName);
		$objCallName -> setCallObj($this, $args);
		return $objCallName;
		/*if(in_array($name, $GLOBALS['G_SP']["auto_load_model"])){
			return spClass($name)->__input($this, $args);
		}elseif(!method_exists( $this, $name )){
			spError("方法 {$name} 未定义");
		}*/
	}
}

class DBCache {
	/**
	 * 默认的数据生存期
	 */
	public $life_time = 3600;
	public $cache_dir = __CACHE_FILE;
	/**
	 * 模型对象
	 */
	private $model_obj = null;
	
	/** 
	 * 调用时输入的参数
	 */
	private $input_args = NULL;
	
	public function __construct() {
	}
	/** 
	 * 函数式使用模型辅助类的输入函数
	 */
    public function setCallObj(& $obj, $args){
		$this->model_obj = $obj;//var_dump($args);
		$this->input_args = $args;
		return $this;
	}
	/** 
	 * 魔术函数，支持多重函数式使用类的方法 不支持自定义缓存文件夹，系统将自动生成缓存文件夹
	 */
	public function __call($func_name, $func_args){
		$md5id = isset($this->input_args[1]) ? $this->input_args[1] : '';
		$cache_id = md5(get_class($this->model_obj) . $func_name . json_encode($func_args) . $md5id);
		if($this->input_args[0] == -1) return $this -> deleteCache($cache_id);
		if($this->input_args[0] > 0) {
			$this -> life_time = $this->input_args[0];
			$this -> cache_dir = $this -> cache_dir . $this -> life_time . '/';
		}
		$display = isset($this->input_args[2]) ? $this->input_args[2] : false;
		if($this->isValid($cache_id, $this -> life_time)) return $this->fetch($cache_id, $display);
		return $this->cache_obj($cache_id, call_user_func_array(array($this->model_obj, $func_name), $func_args));
	}
	/** 
	 */
	public function cache_obj($cache_id, $run_result, $renew_cachedir = true){
		$this->cachePage($cache_id,  $run_result, $renew_cachedir);
		return $run_result;
	}
	
	public function deleteCache($cacheID, $renew_cachedir = true) {
		$filepath = PathManager::getCacheDir($cacheID, $this -> cache_dir, $renew_cachedir);
		return @unlink($filepath);
	}
	
 	public function fetch($cacheID, $display = false, $renew_cachedir = true) {
		$filepath = PathManager::getCacheDir($cacheID, $this -> cache_dir, $renew_cachedir);
 		$_contents = File::readFile($cacheID, $filepath);
 		if ($display) {
 			echo json_decode($_contents, true);
			return;
 		}
 		return json_decode($_contents, true);
 	}
 	
 	public function isValid($cacheID, $cacheTime, $renew_cachedir = true) {
		$filepath = PathManager::getCacheDir($cacheID, $this -> cache_dir, $renew_cachedir);
 		$_cacheFile = $filepath . $cacheID;
 		if (!is_readable($_cacheFile)) {
			return false;
 		} //clearstatcache(); //clearn filemtime function cache
		$now = time();
		$fileMTime = filemtime($_cacheFile);
		return ($now - $fileMTime) < $cacheTime; 
 	}
 	
 	public function cachePage($cacheID, $contents, $renew_cachedir = true) {
		$filepath = PathManager::createCacheDir($cacheID, $this -> cache_dir, $renew_cachedir);
		$contents = json_encode($contents);
		return File::creatFile($cacheID, $contents, $filepath);
 	}
}

class File {
	public static function deleteFile($file, $pathfile = __CACHE) {
		if(!file_exists($pathfile.$file)) {
			return true;
		}
		if(!unlink($pathfile.$file)) {
			throw new Exception(".error: can't delete file:".$pathfile.$file);
		}
	}
	
	public static function moveFile($srcFile, $dstFile, $mode = 0777, $destExistIngore=false) {
		if(file_exists($dstFile)) {
			if($destExistIngore == false) {
				return false;
			}
			self::deleteFile($dstFile);
		}
		if(!copy($srcFile, $dstFile)) {
			throw new Exception(".error: can't copy file:$srcFile to $dstFile.");
		}
		chmod($dstFile, $mode);
		return self::deleteFile($srcFile);
	}
	
	public static function createDir($dir = __CACHE, $mode = 0777) {
		if(is_dir($dir)){
			return;
		} 
		if(mkdir($dir) == false) {
			throw new Exception(".error: can't create dir $dir.");
		}
		return chmod($dir, $mode);
	}
		
	public static function creatFile($filename, $contant, $dir = __CACHE, $mode = 0777) {
		if(!is_dir($dir)){
			self::createDir($dir);
		}
		$filename = $dir.$filename;
		if (!($fp = fopen($filename, 'wb'))) {
			throw new Exception(".error: can't write $filename.");
 		}
		flock($fp, 2);
		fwrite($fp, stripslashes(str_replace("\x0d\x0a", "\x0a", addslashes($contant))));
		fclose($fp);
		return chmod($filename, $mode);
	}
	
	public static function readFile($filename, $dir = __CACHE) {
		$filename = $dir.$filename;
		if (!($fp = fopen($filename, 'rb'))) {
			throw new Exception(".error: can't open file:$filename");
		}
		flock($fp, LOCK_SH);
		if(!($content = fread($fp, filesize($filename)))) {
			throw new Exception(".error: can't read file:$filename");
		}
		fclose($fp);
		return $content;
	}
	public static function readContents($filename, $dir = __CACHE) {
		if(!($content = file_get_contents($dir.$filename))) {
			throw new Exception(".error: can't get contents file:$filename");
		}
		return $content;
	}
	public static function isFile($filename, $dir = __CACHE) {
		return file_exists($dir.$filename);
	}

	public static function getFileCreatedTime($filename, $dir = __CACHE) {
		if(self::isFile($filename, $dir)) {
			return filemtime($dir.$filename);
		}
		return 0;
	}
	public static function getDir($dir) {
		$arrDir = array();
		if ($handle = opendir($dir)) {
			while (false !== ($file = readdir($handle))) {
				if ($file != "." && $file != ".." && !is_file($dir . $file)) {
					$arrDir[$file] = $file;
				}
			}
			closedir($handle);
		}
		return $arrDir;
	}
	public static function getAllFile($dir) {
		$arrFile = array();
		if ($handle = opendir($dir)) {
			while (false !== ($file = readdir($handle))) {
				if ($file != "." && $file != ".." && is_file($dir . $file)) {
					$arrFile[$file] = $file;
				}
			}
			closedir($handle);
		}
		return $arrFile;
	}
}

class Session {

	public function __construct() {
		$this -> sesstionStar();
	}

    private function sesstionStar() {
		if(!session_id()) {
			session_start();
		}
    	//if(function_exists(session_cache_limiter)) {
    	    //session_cache_limiter("private, must-revalidate");
       // }	
    }

	public function __set($name, $value) {
	    $_SESSION[md5(__WEB.$name)] = encode($value);
	}
	
	public function __get($name) {
		if(isset($_SESSION[md5(__WEB.$name)])) {
			return decode($_SESSION[md5(__WEB.$name)]);
		} 
		return NULL;
	}
	
	public function __unset($name) {
		unset($_SESSION[md5(__WEB.$name)]);
	}
		
	public function clean() {
		session_unset();
		foreach ($_SESSION as $key=>$value) {
			unset ($_SESSION[$key]);
		}
	}
	
}

class Cookie {
	public static $objEncrypt = NULL;
	public $arrCookie = NULL;
	public $arrHash   = NULL;
	public function __construct() {
		if(!is_object(self::$objEncrypt)) self::$objEncrypt = new Encrypt;
		if(!empty($_COOKIE)) {
			foreach($_COOKIE as $k => $v) {
				$name  = self::$objEncrypt -> decode($k);
				$value = self::$objEncrypt -> decode($v);
				$this->arrCookie[$name] = $value;
				$this->arrHash[$name]   = $k;
			}
		}
	}
	public function setCookie($name, $value = NULL, $time = NULL, $path = "", $domain = "", $secure = false, $httponly = true) {
		if(!is_object(self::$objEncrypt)) self::$objEncrypt = new Encrypt;
		if($time != NULL) {
			$time = time() + $time;
		}
		$name = isset($this->arrHash[md5(__WEB.$name)]) ? $this->arrHash[md5(__WEB.$name)] : self::$objEncrypt -> encode(md5(__WEB.$name));
		setcookie($name, self::$objEncrypt -> encode($value), $time, $path, $domain, $secure, $httponly); 
	}
	
	public function __set($name, $value) {
		$this -> setCookie($name, $value); 
    }
	
	public function __get($name) {
		if(isset($this->arrCookie[md5(__WEB.$name)])) {
			return $this->arrCookie[md5(__WEB.$name)];
		}
		return NULL;
    }

	public function __isset($name) {
		return isset($this->arrCookie[md5(__WEB.$name)]);
    }
	
	public function __unset($name) {
		setcookie($this->arrHash[md5(__WEB.$name)], '', time() - 3600); 
	}
	
	public function delSimpleCookie($name) {
		setcookie($name, '', time() - 3600); 
	}
	
	public function setSimpleCookie($name, $value = NULL, $time = NULL, $path = "", $domain = "", $secure = false, $httponly = false) {
	    if(empty($name)) {
			return false;
		}
		if($time != NULL) {
			$time = time() + $time;
		}
		setcookie($name, $value, $time, $path, $domain, $secure, $httponly); 
    }
	
	public function getSimpleCookie($name) {
		if(isset($_COOKIE[$name])) {
	    	return $_COOKIE[$name];
		}
    }
}

?>