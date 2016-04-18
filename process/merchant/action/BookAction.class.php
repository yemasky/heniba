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
            case 'savebookinfo':
                $this->create_booking($objRequest, $objResponse);
                break;
            case 'success':
                $this->book_success($objRequest, $objResponse);
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
        $this->setDisplay();
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

    public function create_booking($objRequest, $objResponse) {
        $supplierCode = $this->check_int(\Encrypt::instance()->decode($objRequest->supplierCode));
        //$this->check_numeric($objRequest->id_card_no);
        if(empty($supplierCode)) {
            throw new \Exception('supplierCode is null');
        }
        //var_dump($supplierCode);
        $arrayOrderResult = null;
        $tour_type = $objRequest->tour_type;
        switch($tour_type) {
            case 'tourism':
                $arrayOrderResult = \BaseBookTourismService::instance('\BaseBookTourismService')->create_book($objRequest, $objResponse);
                break;
            case 'hotel':
                $arrayOrderResult = \BaseBookHotelService::instance('\BaseBookHotelService')->create_book($objRequest, $objResponse);
                break;
            case 'air_ticket':
                break;
            default:
                break;
        }
        header('Cache-Control: no-cache');
        $this->redirect('index.php?model=book&action=success&successCode=' . \Encrypt::instance()->encode($arrayOrderResult[1]));

    }

    public function book_success($objRequest, $objResponse) {
        $successCode = $objRequest->successCode;
        $successCode = \Encrypt::instance()->decode($successCode);
        if(empty($successCode)) {
            $this->redirect('index.php');
        }
        $arrayOrderInfo = \BaseBookOrderService::instance('\BaseBookOrderService')->getOrder(array('o_order_number'=>$successCode));//o_id
        $payButtom = \Alipay::payButtom($arrayOrderInfo['o_order_number'], '旅游产品', 0.01, '', '');
        $objResponse -> setTplValue("order", $arrayOrderInfo);
        $objResponse -> setTplValue("payButtom", $payButtom);
        $objResponse -> setTplValue("nav", 'book_success');
        $objResponse -> setTplValue("__Meta", \BaseCommon::getMeta('index', '管理后台', '管理后台', '管理后台'));
        $objResponse -> setTplName("merchant/book/create_book");
    }

    //confirm_book 确认预订
    public function ajax_confirm_book($objRequest, $objResponse) {
        $this->setDisplay();
        $supplierCode = $this->check_int(\Encrypt::instance()->decode($objRequest->supplierCode));
        if(empty($supplierCode)) {
            throw new \Exception('supplierCode is null');
        }
        $arrayOrderResult = null;
        $tour_type = $objRequest->tour_type;
        switch($tour_type) {
            case 'tourism':
                break;
            case 'hotel':
                break;
            case 'hotel':
                break;
            default:
                break;
        }

    }

}