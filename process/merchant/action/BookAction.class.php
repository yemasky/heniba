<?php

/**
 * Created by PhpStorm.
 * User: CooC
 * Date: 2015/12/10
 * Time: 17:04
 */
namespace merchant;
class BookAction extends \BaseAction {
    protected function check($objRequest, $objResponse) {
        $objResponse->arrUserInfo = CommonService::checkLoginUser();
    }

    protected function service($objRequest, $objResponse) {
        switch($objRequest->getAction()) {
            case 'ajax_check_identity':
                $this->ajax_check_identity($objRequest, $objResponse);
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

    public function ajax_check_identity($objRequest, $objResponse) {
        $this->setDisplay();
        $arrayResult['error'] = 0;
        $id_card_no = null;
        try{
            $id_card_no = $this->check_numeric($objRequest->id_card_no, 'id_card_no');
            $arrayResult['error'] = \Utilities::checkIdentity($id_card_no) ? 0 : 1;
        } catch (Exception $e) {
            $arrayResult['error'] = 1;
        }
        if($arrayResult['error'] == 1) {
            $arrayResult['error_message'] = "身份证号码:".$id_card_no." 错误，请重新填写！";
        }
        echo json_encode($arrayResult);
    }

}