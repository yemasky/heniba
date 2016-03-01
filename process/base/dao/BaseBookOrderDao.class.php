<?php

/**
 * Created by PhpStorm.
 * User: YEMASKY
 * Date: 2016/1/3
 * Time: 16:42
 */
class BaseBookOrderDao {
    public static function createOrder($u_id, $m_id, $mu_id, $o_price_market, $o_price_sell) {
        $arrayOrderData['u_id'] =  $u_id;
        $arrayOrderData['m_id'] =  $m_id;
        $arrayOrderData['mu_id'] =  $mu_id;
        $arrayOrderData['o_price_market'] =  $o_price_market;
        $arrayOrderData['o_price_sell'] =  $o_price_sell;
        $o_id = DBQuery::instance(DbConfig::tourism_dsn_write)->setTable('order')->insert($arrayOrderData)->getInsertId();
        $o_order_number = $o_id.'0';
        for($i = strlen($o_order_number) + 1; $i<=12; $i++) {
            $o_order_number = rand(1, 9) . '' . $o_order_number;
        }
        DBQuery::instance(DbConfig::tourism_dsn_write)->setTable('order')->update(array('o_id'=>$o_id), array('o_order_number'=>$o_order_number));
        return $o_id;
    }

}