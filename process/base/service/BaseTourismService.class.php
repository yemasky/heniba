<?php

/**
 * Created by PhpStorm.
 * User: CooC
 * Date: 2015/12/10
 * Time: 13:34
 */
class BaseTourismService extends  BaseService{
    private static $objBaseTourismService = null;

    public static function instance() {
        if(is_object(self::$objBaseTourismService)) return self::$objBaseTourismService;
        self::$objBaseTourismService = new BaseTourismService();
        return self::$objBaseTourismService;
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


}