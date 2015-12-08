<?php
/**
 * file_name 2015年11月29日
 * @author YEMASKY  yemasky@msn.com
 * Copyright 2015  
 */

class TourismDao {

	public function getTourismCategory() {
		return DBQuery::instance(DbConfig::tourism_dsn_write)->setTable('tourism_category')->getList();
	}
	

	
}