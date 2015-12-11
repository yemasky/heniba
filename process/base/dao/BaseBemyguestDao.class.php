<?php

/**
 * Created by PhpStorm.
 * User: CooC
 * Date: 2015/12/11
 * Time: 18:50
 */
class BaseBemyguestDao extends BaseDao {
    private static $objBaseBemyguestDao = null;

    public static function instance($objProcess = NULL) {
        if(is_object(self::$objBaseBemyguestDao)) return self::$objBaseBemyguestDao;
        self::$objBaseBemyguestDao = new BaseBemyguestDao($objProcess);
        return self::$objBaseBemyguestDao;
    }

    public function getBemyguestTour($conditions, $fileid = NULL) {
        if(empty($fileid)) {
            $fileid = 'id, title, titleTranslated, description, descriptionTranslated, highlights, highlightsTranslated, additionalInfo, additionalInfoTranslated,'
                . 'priceIncludes, priceIncludesTranslated, priceExcludes, priceExcludesTranslated, itinerary, itineraryTranslated, warnings, warningsTranslated,'
                . 'safety, safetyTranslated, latitude, longitude, minPax, maxPax, basePrice, currency, reviewCount, reviewAverageScore, typeName, photosUrl, '
                . 'businessHoursFrom, businessHoursTo, meetingTime, meetingLocation, meetingLocationTranslated, photos, categories, productTypes, addons,'
                . 'locations';
        }
        return DBQuery::instance(DbConfig::supplier_dsn)->setTable('bemyguest_tour')->setKey('id')->order($conditions['order'])->limit($conditions['limit'])->getList($conditions['condition'], $fileid);
    }

}