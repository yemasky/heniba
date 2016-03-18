<?php

/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2016/3/17
 * Time: 11:10
 */
class BasePlaceDao {
    public static function getPlace($conditions, $fileid = NULL) {
        if(empty($fileid)) {
            $fileid = '*';
        }
        return DBQuery::instance(DbConfig::tourism_dsn_read)->setTable('country')->setKey('c_id')->order($conditions['order'])->limit($conditions['limit'])->getList($conditions['where'], $fileid);
    }

    public static function getPlaceCount($conditions) {
        return DBQuery::instance(DbConfig::tourism_dsn_read)->setTable('country')->setKey('c_id')->getCount($conditions['where']);

    }

    public static function updatePlaceCnName($where, $arrayData) {
        return DBQuery::instance(DbConfig::tourism_dsn_write)->setTable('country')->update($where, $arrayData);
    }


}