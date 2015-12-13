<?php

/**
 * Created by PhpStorm.
 * User: YEMASKY
 * Date: 2015/12/13
 * Time: 20:46
 */
class BaseTourismTemplaceService extends BaseService {
    private static $objBaseTourismTemplaceService = null;

    public static function instance($objProcess = NULL) {
        if(is_object(self::$objBaseTourismTemplaceService)) return self::$objBaseTourismTemplaceService;
        self::$objBaseTourismTemplaceService = new BaseTourismTemplaceService($objProcess);
        return self::$objBaseTourismTemplaceService;
    }

    public function tourismTemplace($supplierCode, $objResponse) {
        switch($supplierCode['t_supplier']) {
            case 'bemyguest':
                BaseBemyguestTool::instance($this->objProcess)->tourismTemplace($supplierCode, $objResponse);
                break;
            default:
                break;
        }
    }

    public function tourismSourceProductTemplace($supplierCode, $checkdate) {
        switch($supplierCode['t_supplier']) {
            case 'bemyguest':
                return BaseBemyguestTool::instance($this->objProcess)->tourismSourceProductDatePrice($supplierCode, $checkdate);
                break;
            default:
                break;
        }
    }
}