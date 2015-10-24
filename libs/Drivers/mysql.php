<?php

/**
 *  MySQL数据库的驱动支持 
 */

class SQLException extends Exception { }
class mysql {
	/**
	 * 数据库链接句柄
	 */
	private $conn;
	
	/**
	 * 构造函数
	 *
	 * @param dbConfig  数据库配置
	 */
	public function __construct($dbConfig) {
		$this->conn = mysql_connect($dbConfig['host'], $dbConfig['login'], $dbConfig['password']);
		if($this->conn == false) {
			throw new SQLException("数据库链接错误: " . mysql_error()); 
		}
		if(mysql_select_db($dbConfig['database'], $this->conn)){
		} else {
			 throw new SQLException("无法找到数据库，请确认数据库名称正确！");
		}//		$this -> query();
		$this->exec('SET NAMES UTF8;');
	}

	public function selectDB($databases) {
		if(mysql_select_db($databases, $this->conn)){
		} else {
			 throw new SQLException("无法找到数据库，请确认数据库名称正确！");
		}
	}
	/**
	 * 按SQL语句获取记录结果，返回数组
	 * 
	 * @param sql  执行的SQL语句
	 */
	public function getArray($sql) {
		$result = $this->exec($sql);
		$rows = array();
		while($rows[] = mysql_fetch_array($result,MYSQL_ASSOC)){}
		mysql_free_result($result);
		//array_pop($rows);
		return $rows;
	}
	
	/**
	 * 返回当前插入记录的主键ID
	 */
	public function newinsertid() {
		return mysql_insert_id($this->conn);
	}
	
	/**
	 * 格式化带limit的SQL语句
	 */
	public function setlimit($sql, $limit) {
		return $sql. " LIMIT {$limit}";
	}

	/**
	 * 执行一个SQL语句
	 * 
	 * @param sql 需要执行的SQL语句
	 */
	public function exec($sql) {
		if($result = mysql_query($sql, $this->conn) ){
			return $result;
		}else{
			//print_r( mysql_error());
			throw new SQLException("{$sql}<br />执行错误:" . mysql_error());
		}
	}
	
	/**
	 * 返回影响行数
	 */
	public function affected_rows()	{
		return mysql_affected_rows($this->conn);
	}

	/**
	 * 获取数据表结构
	 *
	 * @param tbl_name  表名称
	 */
	public function getTable($tbl_name)	{
		return $this->getArray("DESCRIBE {$tbl_name}");
	}

	/**
	 * 析构函数
	 */
	public function __destruct() {
		mysql_close($this->conn);
	}
}

