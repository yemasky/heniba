<?php

/**
 * Created by PhpStorm.
 * User: YEMASKY
 * Date: 2015/12/13
 * Time: 20:46
 */
class BaseHotelService extends BaseService {
    private static $objBaseHotelService = null;

    public static function instance($objClass = '') {
        if(is_object(self::$objBaseHotelService)) return self::$objBaseHotelService;
        self::$objBaseHotelService = new BaseHotelService();
        return self::$objBaseHotelService;
    }

    public function hotelTemplace($supplierCode, $objResponse, $m_id) {
        switch($supplierCode['h_supplier']) {
            case 'tourico':
                BaseTouricoImpl::instance()->touricoTemplace($supplierCode, $objResponse, $m_id);
                break;
            default:
                break;
        }
    }

    public function getSupplierHotel($arraySupplierCode) {
        $arraySupplierTourism = null;
        $conditions = DbConfig::$db_query_conditions;
        switch ($arraySupplierCode['t_supplier']) {
            case 'tourico':
                $conditions['where']['uuid'] = $arraySupplierCode['t_supplier_code'];
                $objBemyguestDao = new \supplier\BemyguestDao();
                $arraySupplierTourism = $objBemyguestDao->getBemyguestTour($conditions);
                break;
            default:
                break;
        }
        return $arraySupplierTourism;
    }

    public function tourismSourceProductTemplace($arraySupplierCode, $checkdate, $m_id) {
        switch($arraySupplierCode['t_supplier']) {
            case 'bemyguest':
                return BaseBemyguestImpl::instance()->tourismSourceProductDatePrice($arraySupplierCode, $checkdate, $m_id);
                break;
            default:
                break;
        }
        return null;
    }
}