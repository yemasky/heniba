<?php

/**
 * Created by PhpStorm.
 * User: YEMASKY
 * Date: 2016/1/3
 * Time: 16:42
 */
class BaseBookUserDao {
    public static function getUserInfo($conditions, $fileid = 'u_id, u_email, u_mobile') {
        return DBQuery::instance(DbConfig::tourism_dsn_read)->setTable('user')->setKey('u_id')->order($conditions['order'])->limit($conditions['limit'])->getList($conditions['where'], $fileid);
    }
    /*
     * return u_id
     */
    public static function createUser($arrayUserData) {
        return DBQuery::instance(DbConfig::tourism_dsn_write)->setTable('user')->insert($arrayUserData)->getInsertId();
    }

}