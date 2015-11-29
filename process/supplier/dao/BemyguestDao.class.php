<?php
/**
 * file_name 2015年11月29日
 * @author YEMASKY  yemasky@msn.com
 * Copyright 2015  
 */

class BemyguestDao {
	private static $dsn = 'mysql://root:@127.0.0.1/bemyguest';

	public static function insertProduct($arrData) {
		return DBQuery::instance(self::$dsn)->setTable('product')->insert($arrData, 'INSERT IGNORE')->getInsertId();
	}
	
}