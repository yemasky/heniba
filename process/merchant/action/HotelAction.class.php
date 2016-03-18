<?php

/**
 * Created by PhpStorm.
 * User: CooC
 * Date: 2015/12/8
 * Time: 14:28
 */
namespace merchant;

class HotelAction extends \BaseAction {
    protected function check($objRequest, $objResponse) {
        $objResponse->arrUserInfo = CommonService::checkLoginUser();
    }

    protected function service($objRequest, $objResponse) {
        switch($objRequest->getAction()) {
            case 'product':
                $this->hotel_product($objRequest, $objResponse);
                break;
            case 'ajax_get_place':
                $this->ajax_getPlace($objRequest, $objResponse);
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
        $place = $objRequest->place;
        //
        //设置类别
        $pn = $objRequest->pn;
        $pn = empty($pn) ? 1 : $pn;
        $list_count = $objRequest->list_count;
        $list_count = empty($list_count) ? 20 : $list_count;
        $conditions = \DbConfig::$db_query_conditions;
        $conditions['limit'] = (($pn - 1) * $list_count) . ", $list_count";
        $conditions['where'] = null;
        $conditions['order'] = 'h_images DESC, h_id DESC';
        $objHotelService = new HotelService();
        $count = $objHotelService->getHotelCount($conditions['where']);
        $arrayListData = $objHotelService->getHotel($conditions, null, $objResponse->arrUserInfo['m_id']);
        //
        $objResponse -> nav = 'index';
        $objResponse -> setTplValue('place', $place);
        $objResponse -> setTplValue('hotel_list', $arrayListData);
        $objResponse -> setTplValue('page', page($pn, ceil($count/$list_count)));
        $objResponse -> setTplValue('pn', $pn);
        $objResponse -> setTplValue('model', 'hotel');
        $objResponse -> setTplValue('show_pages', 10);
        $objResponse -> setTplValue('merchantMenu', $objResponse->arrMerchantMenu);
        //设置Meta
        $objResponse -> setTplValue("__Meta", \BaseCommon::getMeta('index', '管理后台', '管理后台', '管理后台'));
        $objResponse -> setTplName("merchant/hotel_list");
    }

    protected function hotel_product($objRequest, $objResponse) {

        $h_id = $this->check_int($objRequest->id, 'id');
        $conditions = \DbConfig::$db_query_conditions;
        $conditions['where']['h_id'] = $h_id;
        $objHotelService = new HotelService();
        $supplierCode = $objHotelService->getHotel($conditions, 'h_supplier, h_supplier_code');
        if(!empty($supplierCode)) {
            \BaseHotelService::instance()->hotelTemplace($supplierCode[0], $objResponse, $objResponse->arrUserInfo['m_id']);
        }

        $conditions = \DbConfig::$db_query_conditions;
        $conditions['where'] = "h_id > ".($h_id - 5)." AND h_id < " . ($h_id + 50) . ' AND h_id != ' . $h_id;
        $conditions['limit'] = "0, 10";
        $relation_hotel = $objHotelService->getHotel($conditions, 'h_id, h_name, h_images');
        $objResponse -> setTplValue('hotel_supplier_tpl', 'hotel_' . $supplierCode[0]['h_supplier']);
        $objResponse -> setTplValue('h_id', $h_id);
        $objResponse -> setTplValue('supplierCode', \Encrypt::instance()->encode($h_id));
        $objResponse -> setTplValue('today', substr(getDateTime(), 0, 10));
        $objResponse -> setTplValue('relation_hotel', $relation_hotel);
        $objResponse -> setTplName("merchant/hotel_product");
    }

    protected function ajax_getPlace($objRequest, $objResponse) {
        $place = trim($objRequest->place);
        $arrayPlace = NULL;
        if(!empty($place)) {
            $arrayPlace = \BaseCommonService::instance('BaseCommonService')->searchPlace($place, 1);
        }
        $objResponse -> setTplValue('arrayPlace', $arrayPlace);
        $objResponse -> setTplName("merchant/supplier_tpl/place_list");

    }

}