<?php

/**
 * Created by PhpStorm.
 * User: YEMASKY
 * Date: 2015/12/13
 * Time: 20:46
 */
class BaseTourismService extends BaseService {
    private static $objBaseTourismService = null;

    public static function instance($objClass = '') {
        if(is_object(self::$objBaseTourismService)) return self::$objBaseTourismService;
        self::$objBaseTourismService = new BaseTourismService();
        return self::$objBaseTourismService;
    }

    public function tourismTemplace($supplierCode, $objResponse, $m_id) {
        switch($supplierCode['t_supplier']) {
            case 'bemyguest':
                BaseBemyguestImpl::instance()->tourismTemplace($supplierCode, $objResponse, $m_id);
                break;
            default:
                break;
        }
    }

    public function getSupplierTourism($supplierCode) {
        $arraySupplierTourism = null;
        $conditions = DbConfig::$db_query_conditions;
        switch ($supplierCode['t_supplier']) {
            case 'bemyguest':
                $conditions['condition']['uuid'] = $supplierCode['t_supplier_code'];
                $objBemyguestDao = new \supplier\BemyguestDao();
                $arraySupplierTourism = $objBemyguestDao->getBemyguestTour($conditions);
                break;
            default:
                break;
        }
        return $arraySupplierTourism;
    }

    public function tourismSourceProductTemplace($supplierCode, $checkdate, $m_id) {
        switch($supplierCode['t_supplier']) {
            case 'bemyguest':
                return BaseBemyguestImpl::instance()->tourismSourceProductDatePrice($supplierCode, $checkdate, $m_id);
                break;
            default:
                break;
        }
        return null;
    }
}