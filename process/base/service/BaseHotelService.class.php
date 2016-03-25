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

    public function hotelTemplace($supplierCode, $objResponse, $m_id, $arraySearchData = null) {
        switch($supplierCode['h_supplier']) {
            case 'tourico':
                BaseTouricoImpl::instance()->touricoTemplace($supplierCode, $objResponse, $m_id, $arraySearchData);
                break;
            default:
                break;
        }
    }

    public function getSupplierHotel($arraySupplierCode) {
        $arraySupplierTourism = null;
        $conditions = DbConfig::$db_query_conditions;
        switch ($arraySupplierCode['h_supplier']) {
            case 'tourico':
                $conditions['where']['hotelID'] = $arraySupplierCode['h_supplier_code'];
                $objTouricDao = new \supplier\TouricoDao();
                $arraySupplierHotel = $objTouricDao->getTouricoHotel($conditions);
                break;
            default:
                break;
        }
        return $arraySupplierHotel;
    }

    public function hotelSourceProductTemplace($arraySupplierCode, $checkdate, $m_id) {
        switch($arraySupplierCode['t_supplier']) {
            case 'tourico':
                return BaseTouricoImpl::instance()->hotelSourceProductDatePrice($arraySupplierCode, $checkdate, $m_id);
                break;
            default:
                break;
        }
        return null;
    }
}