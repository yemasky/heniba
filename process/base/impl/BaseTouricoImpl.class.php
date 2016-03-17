<?php

/**
 * Created by PhpStorm.
 * User: YEMASKY
 * Date: 2015/12/13
 * Time: 21:20
 */
class BaseTouricoImpl extends BaseService {
    private static $objBaseTouricoImpl = null;

    public static function instance() {
        if(is_object(self::$objBaseTouricoImpl)) return self::$objBaseTouricoImpl;
        self::$objBaseTouricoImpl = new BaseTouricoImpl();
        return self::$objBaseTouricoImpl;
    }

    public function touricoTemplace($arraySupplierCode, $objResponse, $m_id) {
        $tourism_product = BaseHotelService::instance()->getSupplierHotel($arraySupplierCode);

        $objResponse -> setTplValue('tourism_product', $tourism_product[0]);

        $objResponse -> setTplValue("__Meta", BaseCommon::getMeta('index', $tourism_product[0]['title'] . '-管理后台', '管理后台', '管理后台'));

    }

    public function hotelSourceProductDatePrice($arraySupplierCode, $checkdate, $m_id) {

    }

}