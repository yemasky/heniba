<?php
/**
 * file_name 2015年11月29日
 * @author YEMASKY  yemasky@msn.com
 * Copyright 2015  
 */
namespace supplier;

class TouricoDao {

	public function insertDestination($arrData) {
		return \DBQuery::instance(\DbConfig::supplier_dsn)->setTable('tourico_destination')->insert($arrData, 'INSERT IGNORE')->getInsertId();
	}
	
	public function insertHotel($arrData) {
		return \DBQuery::instance(\DbConfig::supplier_dsn)->setTable('tourico_hotel')->insert($arrData, 'INSERT IGNORE');
	}

	public function getTouricoHotel($conditions, $fileid = '*') {
		return \DBQuery::instance(\DbConfig::supplier_dsn)->setTable('tourico_hotel')->limit($conditions['limit'])->getList($conditions['where'], $fileid);
	}
	
}