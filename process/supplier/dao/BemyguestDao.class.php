<?php
/**
 * file_name 2015年11月29日
 * @author YEMASKY  yemasky@msn.com
 * Copyright 2015  
 */

class BemyguestDao {

	public function insertProduct($arrData) {
		return DBQuery::instance(DbConfig::$supplier_dsn)->setTable('bemyguest_tour')->insert($arrData, 'INSERT IGNORE')->getInsertId();
	}
	
}