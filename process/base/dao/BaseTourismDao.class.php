<?php

/**
 * Created by PhpStorm.
 * User: CooC
 * Date: 2015/12/10
 * Time: 13:13
 */
class BaseTourismDao extends BaseDao{
    private static $objBaseTourismDao = null;

    public static function instance() {
        if(is_object(self::$objBaseTourismDao)) return self::$objBaseTourismDao;
        self::$objBaseTourismDao = new BaseTourismDao();
        return self::$objBaseTourismDao;
    }

    public function getTourism($conditions, $fileid = NULL) {
        if(empty($fileid)) {
            $fileid = 't_id, tc_id, c_country_id, c_state_id, c_city_id, t_title, t_title_cn, t_description, '
                . 't_description_cn, t_images, t_latitude, t_longitude, t_currency, t_price, t_review_count, '
                . 't_review_average_score, t_supplier, t_supplier_code';
        }
        return DBQuery::instance(DbConfig::tourism_dsn_read)->setTable('tourism')->setKey('t_id')->order($conditions['order'])->limit($conditions['limit'])->getList($conditions['condition'], $fileid);
    }

    public function getTourismCount($conditions) {
        $fileid = 'COUNT(t_id)';
        return DBQuery::instance(DbConfig::tourism_dsn_read)->setTable('tourism')->getOne($conditions, $fileid);
    }

    public function getBemyguestTourism($conditions, $fileid = NULL) {
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