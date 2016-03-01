<?php

/**
 * Created by PhpStorm.
 * User: YEMASKY
 * Date: 2016/1/1
 * Time: 23:36
 */
class BaseBookOrderService extends BaseService {

    public function createOrder($objRequest, $arrayUser) {

        return BaseBookOrderDao::createOrder();
    }
}