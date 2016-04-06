<?php

/**
 * Created by PhpStorm.
 * User: YEMASKY
 * Date: 2016/1/3
 * Time: 16:42
 */
class BaseBookOrderDao extends BaseDao{
    private static $objDao = null;

    public static function instance() {
        if(is_object(self::$objDao)) return self::$objDao;
        self::$objDao = new BaseBookOrderDao();
        return self::$objDao;
    }

    public static function createOrder($arrayOrder) {
        $o_id = DBQuery::instance(DbConfig::tourism_dsn_write)->setTable('order')->insert($arrayOrder)->getInsertId();
        $o_order_number = '0' . $o_id;
        for($i = strlen($o_order_number) + 1; $i<=12; $i++) {//12位订单号
            $o_order_number = rand(1, 9) . '' . $o_order_number;
        }
        DBQuery::instance(DbConfig::tourism_dsn_write)->setTable('order')->update(array('o_id'=>$o_id), array('o_order_number'=>$o_order_number));
        return array($o_id, $o_order_number);
    }

    public static function createOrderInfo($arrayOrderInfo) {
        return DBQuery::instance(DbConfig::tourism_dsn_write)->setTable('order_info')->insert($arrayOrderInfo)->getInsertId();
    }

    public static function insertOrderReturnlog($arrarOrderReturnLog) {
        return DBQuery::instance(DbConfig::tourism_dsn_write)->setTable('order_return_log')->insert($arrarOrderReturnLog)->getInsertId();
    }

    public static function getOrder($conditions, $fields = '*') {
        return DBQuery::instance(DbConfig::tourism_dsn_read)->setTable('order')->getRow($conditions, $fields);
    }

    public function getOrderCount($conditions) {
        $fileid = 'COUNT(o_id)';
        return DBQuery::instance(DbConfig::tourism_dsn_read)->setTable('order')->getOne($conditions, $fileid);
    }


}