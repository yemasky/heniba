<?php
/**
 * file_name 2015年11月29日
 * @author YEMASKY  yemasky@msn.com
 * Copyright 2015  
 */

class BemyguestDao {

	public function insertProduct($arrData) {
		return DBQuery::instance(DbConfig::supplier_dsn)->setTable('bemyguest_tour')->insert($arrData, 'INSERT IGNORE')->getInsertId();
	}
	
	public function getTourProduct() {
		$field = 'typeName, locations, title, titleTranslated, description, descriptionTranslated, photosUrl, photos, latitude, '
				.'longitude, currency, basePrice, reviewCount, reviewAverageScore, categories, uuid';
		return DBQuery::instance(DbConfig::supplier_dsn)->setTable('bemyguest_tour')->getList(null, $field);
	}

	public function insertTourism($arrData) {
		return DBQuery::instance(DbConfig::tourism_dsn_write)->setTable('tourism')->insert($arrData, 'INSERT IGNORE')->getInsertId();
	}
	
}