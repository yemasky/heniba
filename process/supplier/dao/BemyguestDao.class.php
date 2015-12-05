<?php
/**
 * file_name 2015年11月29日
 * @author YEMASKY  yemasky@msn.com
 * Copyright 2015  
 */

class BemyguestDao {
	private $dsn = 'mysql://root:@127.0.0.1/supplier';

	public function insertProduct($arrData) {
		return DBQuery::instance($this->dsn)->setTable('bemyguest_tour')->insert($arrData, 'INSERT IGNORE')->getInsertId();
	}
	
}