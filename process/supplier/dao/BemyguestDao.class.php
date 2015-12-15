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
	
	public function getSimpleBemyguestTour() {
		$field = 'typeName, locations, title, titleTranslated, description, descriptionTranslated, photosUrl, photos, latitude, '
				.'longitude, currency, basePrice, reviewCount, reviewAverageScore, categories, uuid';
		return DBQuery::instance(DbConfig::supplier_dsn)->setTable('bemyguest_tour')->getList(array('is_delete'=>'0'), $field);
	}

	public function getBemyguestTour($conditions, $fileid = NULL) {
		if(empty($fileid)) {
			$fileid = 'id, title, titleTranslated, description, descriptionTranslated, highlights, highlightsTranslated, additionalInfo, additionalInfoTranslated,'
					. 'priceIncludes, priceIncludesTranslated, priceExcludes, priceExcludesTranslated, itinerary, itineraryTranslated, warnings, warningsTranslated,'
					. 'safety, safetyTranslated, latitude, longitude, minPax, maxPax, basePrice, currency, reviewCount, reviewAverageScore, typeName, photosUrl, '
					. 'businessHoursFrom, businessHoursTo, meetingTime, meetingLocation, meetingLocationTranslated, photos, categories, productTypes, addons,'
					. 'locations, update_date';
		}
		return DBQuery::instance(DbConfig::supplier_dsn)->setTable('bemyguest_tour')->setKey('id')->order($conditions['order'])->limit($conditions['limit'])->getList($conditions['condition'], $fileid);
	}

	public function updateBemyguestTour($conditions, $arrarRow) {
		return DBQuery::instance(DbConfig::supplier_dsn)->setTable('bemyguest_tour')->update($conditions, $arrarRow);
	}
	
}