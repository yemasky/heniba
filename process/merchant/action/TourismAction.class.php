<?php

/**
 * Created by PhpStorm.
 * User: CooC
 * Date: 2015/12/8
 * Time: 14:28
 */
class TourismAction extends BaseAction {
    protected function check($objRequest, $objResponse) {
        $objResponse->arrUserInfo = $this->objProcess->CommonService($this->objProcess)->checkLoginUser();
    }

    protected function service($objRequest, $objResponse) {
        switch($objRequest->getAction()) {
            case 'register':
                $this->admin_register($objRequest, $objResponse);
                break;
            default:
                $this->doBase($objRequest, $objResponse);
                break;
        }
    }

}