<?php

/**
 * Created by PhpStorm.
 * User: CooC
 * Date: 2015/12/10
 * Time: 17:04
 */
class BookAction extends BaseAction {
    protected function check($objRequest, $objResponse) {
        $objResponse->arrUserInfo = $this->objProcess->CommonService($this->objProcess)->checkLoginUser();
    }

    protected function service($objRequest, $objResponse) {
        switch($objRequest->getAction()) {
            case 'ajax_create_booking':
                $this->ajax_create_booking($objRequest, $objResponse);
                break;
            case 'ajax_check_booking':
                $this->ajax_create_booking($objRequest, $objResponse);
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
        $book_type = $this->check_null($objRequest->book_type);
        $book_id = $this->check_int($objRequest->id);
    }

}