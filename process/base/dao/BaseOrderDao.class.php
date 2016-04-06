<?php

/**
 * Created by PhpStorm.
 * User: CooC
 * Date: 2015/12/10
 * Time: 13:13
 */
class BaseOrderDao extends BaseDao{
    private static $objSelfDao = null;

    public static function instance() {
        if(is_object(self::$objSelfDao)) return self::$objSelfDao;
        self::$objSelfDao = new BaseOrderDao();
        return self::$objSelfDao;
    }

    public function getOrder($conditions, $fileid = NULL) {
        if(empty($fileid)) {
            $fileid = '*';
        }
        return DBQuery::instance(DbConfig::tourism_dsn_read)->setTable('order_info')->setKey('oi_id')->order($conditions['order'])->limit($conditions['limit'])->getList($conditions['where'], $fileid);
    }

    public function getOrderCount($conditions) {
        $fileid = 'COUNT(o_id)';
        return DBQuery::instance(DbConfig::tourism_dsn_read)->setTable('order_info')->getOne($conditions, $fileid);
    }

}