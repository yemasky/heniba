<?php

/**
 *  PDO MySQL数据驱动类
 */
class pdo_driver extends PDO {
	private $conn;
	public function __construct($dbConfig) {
		$this->conn = new PDO("mysql:host=".$dbConfig['host'].";dbname=".$dbConfig['database'],$dbConfig['login'],$dbConfig['password']);
	}

	public function selectDB($databases) {

	}

	public function getQueryArrayResult($sql)
	{
		$rs = $this->conn->query($sql);
		while ($row[] = $rs->fetch()) {
		}
		return $row;
	}

	public function getInsertid() {
		return $this->conn->lastInsertId();
	}

	public function execute($sql) {
		return $this->conn->exec($sql);
	}

	public function affected_rows()	{

	}

	public function getTableDescribe($tbl_name)	{

	}

	public function setlimit($sql, $limit) {
		return $sql. " LIMIT {$limit}";
	}

	public function __destruct() {
		mysql_close($this->conn);
	}
}

