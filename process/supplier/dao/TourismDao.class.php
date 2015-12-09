<?php

/**
 * Created by PhpStorm.
 * User: CooC
 * Date: 2015/12/8
 * Time: 10:31
 */
class TourismDao {
    public function getTCategoryIdByName($tc_name) {
        return DBQuery::instance(DbConfig::tourism_dsn_read)->setTable('tourism_category')->getOne(array('tc_name'=>$tc_name), 'tc_id');
    }

    public function insertTCategory($tc_name) {
        return DBQuery::instance(DbConfig::tourism_dsn_write)->setTable('tourism_category')->insert(array('tc_name'=>$tc_name))->getInsertId();
    }

    public function getTouricoDestination() {
        $fileid = 'id c_id, Continent_id c_continent_id, Country_id c_country_id, City_id c_city_id, `name` c_name, '
                 .'cityLatitude c_latitude, cityLongitude c_longitude, destination_type c_type';
        return DBQuery::instance(DbConfig::supplier_dsn)->setTable('tourico_destination')->getList(NULL, $fileid);
    }

    public function insertCountry($sql) {
        return DBQuery::instance(DbConfig::tourism_dsn_write)->execute($sql)->getInsertId();
    }

    public function getCountryIdByName($conditions) {
        return DBQuery::instance(DbConfig::tourism_dsn_read)->setTable('country')->getRow($conditions, 'c_id, c_continent_id, c_state_id');
    }

    public function getTagIdByName($tt_name) {
        return DBQuery::instance(DbConfig::tourism_dsn_read)->setTable('tourism_tag')->getOne(array('tt_name'=>$tt_name), 'tt_id');
    }

    public function getTourismT_idByCode($code) {
        return DBQuery::instance(DbConfig::tourism_dsn_read)->setTable('tourism')->getOne(array('t_supplier_code'=>$code), 't_id');
    }

    public function insertTourism($arrayData) {
        return DBQuery::instance(DbConfig::tourism_dsn_write)->setTable('tourism')->insert($arrayData, 'INSERT IGNORE')->getInsertId();
    }

    public function insertTourismTagProduct($arrayData) {
        return DBQuery::instance(DbConfig::tourism_dsn_write)->setTable('tourism_tag_product')->insert($arrayData, 'INSERT IGNORE');
    }

}