<?php

/**
 * Created by PhpStorm.
 * User: YEMASKY
 * Date: 2016/1/1
 * Time: 23:36
 */
class BaseBookOrderService extends BaseService {

    public function getOrder($conditions, $fields = '*') {
        if($fields == '*') {
            $fields = 'o_id, u_id, m_id, mu_id, o_order_number, o_price_market, o_price_sell, o_price_wholesale, o_price_original';
        }
        return BaseBookOrderDao::getOrder($conditions, $fields);
    }
}