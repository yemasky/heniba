<?php
/**
 * file_name 2015年11月29日
 * @author YEMASKY  yemasky@msn.com
 * Copyright 2015  
 */

class TouricoDao {
	private $dsn = 'mysql://root:@127.0.0.1/supplier';

	public function insertDestination($arrData) {
		return DBQuery::instance($this->dsn)->setTable('tourico_destination')->insert($arrData, 'INSERT IGNORE')->getInsertId();
	}
	
}