<?php

/**
 * Created by PhpStorm.
 * User: YEMASKY
 * Date: 2015/12/13
 * Time: 20:46
 */
class BaseTourismTemplaceService extends BaseService {
    private static $objBaseTourismTemplaceService = null;

    public static function instance() {
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