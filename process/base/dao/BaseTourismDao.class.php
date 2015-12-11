<?php

/**
 * Created by PhpStorm.
 * User: CooC
 * Date: 2015/12/10
 * Time: 13:13
 */
class BaseTourismDao extends BaseDao{
    private static $objBaseTourismDao = null;

    public static function instance($objProcess = NULL) {
        if(is_object(self::$objBaseTourismDao)) return self::$objBaseTourismDao;
        self::$objBaseTourismDao = new BaseTourismDao($objProcess);
        return self::$objBaseTourismDao;
    }

    public function insertTourism($arrData) {
        return DBQuery::instance(DbConfig::tourism_dsn_write)->setTable('tourism')->insert($arrData, 'INSERT IGNORE')->getInsertId();
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

}