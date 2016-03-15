<?php

/**
 * Created by PhpStorm.
 * User: CooC
 * Date: 2015/12/10
 * Time: 13:13
 */
class BaseHotelDao extends BaseDao{
    private static $objBaseHotelDao = null;

    public static function instance() {
        if(is_object(self::$objBaseHotelDao)) return self::$objBaseHotelDao;
        self::$objBaseHotelDao = new BaseHotelDao();
        return self::$objBaseHotelDao;
    }

    public function insertHotel($arrData) {
        return DBQuery::instance(DbConfig::tourism_dsn_write)->setTable('hotel')->insert($arrData, 'INSERT IGNORE')->getInsertId();
    }

    public function getHotel($conditions, $fileid = NULL) {
        if(empty($fileid)) {
            $fileid = '*';
        }
        return DBQuery::instance(DbConfig::tourism_dsn_read)->setTable('hotel')->setKey('h_id')->order($conditions['order'])->limit($conditions['limit'])->getList($conditions['where'], $fileid);
    }

    public function getHotelCount($conditions) {
        $fileid = 'COUNT(h_id)';
        return DBQuery::instance(DbConfig::tourism_dsn_read)->setTable('hotel')->getOne($conditions, $fileid);
    }

    public function getHotelBrand($conditions, $fileid = NULL) {
        if(empty($fileid)) {
            $fileid = '*';
        }
        return DBQuery::instance(DbConfig::tourism_dsn_read)->setTable('hotel_brand')->setKey('hb_id')->order($conditions['order'])->limit($conditions['limit'])->getList($conditions['where'], $fileid);
    }

    public function insertHotelBrand($arrData) {
        return DBQuery::instance(DbConfig::tourism_dsn_write)->setTable('hotel_brand')->insert($arrData)->getInsertId();
    }

    public function getCountry($conditions, $fileid = NULL) {
        if(empty($fileid)) {
            $fileid = '*';
        }
        return DBQuery::instance(DbConfig::tourism_dsn_read)->setTable('country')->setKey('c_id')->order($conditions['order'])->limit($conditions['limit'])->getList($conditions['where'], $fileid);
    }

    public function insertCountry($arrData) {
        return DBQuery::instance(DbConfig::tourism_dsn_write)->setTable('country')->insert($arrData)->getInsertId();
    }

    public function getAttribute($conditions, $fileid = NULL) {
        if(empty($fileid)) {
            $fileid = '*';
        }
        return DBQuery::instance(DbConfig::tourism_dsn_read)->setTable('hotel_attribute')->setKey('ha_id')->order($conditions['order'])->limit($conditions['limit'])->getList($conditions['where'], $fileid);
    }

    public function insertAttribute($arrData) {
        return DBQuery::instance(DbConfig::tourism_dsn_write)->setTable('hotel_attribute')->insert($arrData)->getInsertId();
    }

    public function insertAttributeValue($arrData) {
        return DBQuery::instance(DbConfig::tourism_dsn_write)->setTable('hotel_attribute_value')->insert($arrData, 'INSERT IGNORE')->getInsertId();
    }

}