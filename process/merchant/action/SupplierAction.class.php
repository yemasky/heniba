<?php

/**
 * Created by PhpStorm.
 * User: YEMASKY
 * Date: 2015/12/13
 * Time: 20:34
 */
class SupplierAction extends BaseAction {
    protected function check($objRequest, $objResponse) {
        $objResponse->arrUserInfo = $this->objProcess->CommonService($this->objProcess)->checkLoginUser();
    }

    protected function service($objRequest, $objResponse) {
        switch($objRequest->getAction()) {
            case 'gettourism':
                $this->getTourism($objRequest, $objResponse);
                break;
            default:
                $this->doBase($objRequest, $objResponse);
                break;
        }
    }

    /**
     * 首页显示
     */
    protected function doBase($objRequest, $objResponse) {

    }

    protected function getTourism($objRequest, $objResponse) {
        $this->setDisplay();
        $t_id = $this->check_int($objRequest->id, 'id');
        $checkdate = $this->check_null($objRequest->checkdate, 'checkdate');
        $conditions = DbConfig::$db_query_conditions;
        $conditions['condition']['t_id'] = $t_id;
        $supplierCode = $this->objProcess->TourismService($this->objProcess)->getTourism($conditions, 't_supplier, t_supplier_code');
        if(!empty($supplierCode)) {
            BaseTourismTemplaceService::instance($this->objProcess)->tourismSourceProductTemplace($supplierCode[0], $checkdate);
        }

    }

}