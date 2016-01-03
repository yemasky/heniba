<?php

/**
 * Created by PhpStorm.
 * User: YEMASKY
 * Date: 2015/12/13
 * Time: 20:46
 */
class BaseTourismTemplaceService extends BaseService {
    private static $objBaseTourismTemplaceService = null;

    public static function instance($objClass = '') {
        if(is_object(self::$objBaseTourismTemplaceService)) return self::$objBaseTourismTemplaceService;
        self::$objBaseTourismTemplaceService = new BaseTourismTemplaceService();
        return self::$objBaseTourismTemplaceService;
    }

    public function tourismTemplace($supplierCode, $objResponse) {
        switch($supplierCode['t_supplier']) {
            case 'bemyguest':
                BaseBemyguestTool::instance()->tourismTemplace($supplierCode, $objResponse);
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

    public function tourismSourceProductTemplace($supplierCode, $checkdate) {
        switch($supplierCode['t_supplier']) {
            case 'bemyguest':
                return BaseBemyguestTool::instance()->tourismSourceProductDatePrice($supplierCode, $checkdate);
                break;
            default:
                break;
        }
    }
}