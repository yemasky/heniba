<?php

/**
 * Created by PhpStorm.
 * User: CooC
 * Date: 2015/12/8
 * Time: 10:31
 */
class TourismDao {
    public function getTCategoryIdByName($tc_name) {
        return DBQuery::instance(DbConfig::tourism_dsn_read)->setTable('tourism_category')->getRow(array('tc_name'=>$tc_name), 'tc_id');
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

    public function getCountryIdByName($c_name) {
        return DBQuery::instance(DbConfig::tourism_dsn_read)->setTable('country')->getOne(array('c_name'=>$c_name), 'c_id, c_continent_id, c_state_id');
    }



}