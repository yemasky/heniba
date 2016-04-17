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
            case 'search':
                $this->searchHotel($objRequest, $objResponse);
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

    protected function ajax_getPlace($objRequest, $objResponse) {
        $place = trim($objRequest->place);
        $arrayPlace = NULL;
        if(!empty($place)) {
            $pn = $objRequest->pn;
            $pn = empty($pn) ? 1 : $pn;
            $list_count = 50;
            $conditions = \DbConfig::$db_query_conditions;
            $conditions['limit'] = (($pn - 1) * $list_count) . ", $list_count";
            $conditions['where'] = "c_name_cn like  '%" . $place . "%' AND c_country_id > 0";
            $arrayPlace = \BaseCommonService::instance('BaseCommonService')->searchPlace($conditions);
        }
        $objResponse -> setTplValue('arrayPlace', $arrayPlace);
        $objResponse -> setTplName("merchant/supplier_tpl/place_list");

    }

    protected function searchHotel($objRequest, $objResponse) {
        $place = $objRequest->place;
        $arraySearchData['city'] = $objRequest->city;//city_id
        $arraySearchData['place_type'] = $objRequest->place_type;
        $arraySearchData['place_en_name'] = $objRequest->place_en_name;
        $arraySearchData['CheckIn'] = $objRequest->CheckIn;
        $arraySearchData['CheckOut'] = $objRequest->CheckOut;
        $arraySearchData['RoomsNum'] = $objRequest->RoomsNum;
        $arraySearchData['AdultNum'] = $objRequest->AdultNum;
        $arraySearchData['ChildNum'] = $objRequest->ChildNum;
        $arraySearchData['ChildAge'] = $objRequest->ChildAge > 0 ? $objRequest->ChildAge : 15;
        $search_data_url = http_build_query($arraySearchData);
        //计算房间数
        $avg_AdultNum = floor($arraySearchData['AdultNum'] / $arraySearchData['RoomsNum']);//平均每间房多少人住
        $mod__AdultNum = $arraySearchData['AdultNum'] % $arraySearchData['RoomsNum'];//取余
        $avg_ChildNum = $arraySearchData['ChildNum'];
        for($i = 0; $i < $arraySearchData['RoomsNum']; $i++) {
            if($mod__AdultNum > 0) {
                $arraySearchData['RoomsInformation'][$i]['AdultNum'] = $avg_AdultNum + 1;
                $mod__AdultNum--;
            } else {
                $arraySearchData['RoomsInformation'][$i]['AdultNum'] = $avg_AdultNum;
            }
            if($avg_ChildNum > 0) {
                $arraySearchData['RoomsInformation'][$i]['ChildNum'] = 1;
                $arraySearchData['RoomsInformation'][$i]['ChildAge'][0] = 15;
                $avg_ChildNum--;
            } else {
                $arraySearchData['RoomsInformation'][$i]['ChildNum'] = 0;
                $arraySearchData['RoomsInformation'][$i]['ChildAge'][0] = 0;
            }
        }
        //print_r($arraySearchData);exit();
        //$arraySearchData['RoomsInformation'][0]['AdultNum'] = $objRequest->AdultNum;
        //$arraySearchData['RoomsInformation'][0]['ChildNum'] = $objRequest->ChildNum;
        //$arraySearchData['RoomsInformation'][0]['ChildAge'][0] = $objRequest->ChildAge > 0 ? $objRequest->ChildAge : 15;

        //
        //设置类别
        $arrayListData = null;
        $pn = $objRequest->pn;
        $pn = empty($pn) ? 1 : $pn;
        $list_count = $objRequest->list_count;
        $list_count = empty($list_count) ? 20 : $list_count;

        $objHotelService = new HotelService();
        $arrayTouricoListData = $objHotelService->searchHotelInSupplier('tourico', $arraySearchData);
        $tourico = 0;
        if(!empty($arrayTouricoListData)) {
            if(isset($arrayTouricoListData['httpcode']) && $arrayTouricoListData['httpcode'] != 200) {
                $arrayListData = $arrayTouricoListData['result']['s:Body']['0']['s:Fault']['0']['faultstring'];
                $tourico = '-1';
            } else {
                $tourico = '1';
                $arrayListData = \BaseTouricoImpl::instance()->formatSearchHotelList($arrayTouricoListData);
            }
        }
        //print_r($arrayListData);
        $count = count($arrayListData);
        //
        $objResponse -> nav = 'index';
        //产品模板
        $objResponse -> setTplValue('tourico', $tourico);
        //
        $objResponse -> setTplValue('search_data_url', $search_data_url);
        $objResponse -> setTplValue('place', $place);
        $objResponse -> setTplValue('arraySearchData', $arraySearchData);
        $objResponse -> setTplValue('hotel_list', $arrayListData);
        $objResponse -> setTplValue('page', page($pn, ceil($count/$list_count)));
        $objResponse -> setTplValue('pn', $pn);
        $objResponse -> setTplValue('model', 'hotel');
        $objResponse -> setTplValue('show_pages', 10);
        $objResponse -> setTplValue('merchantMenu', $objResponse->arrMerchantMenu);
        //设置Meta
        $objResponse -> setTplValue("__Meta", \BaseCommon::getMeta('index', '管理后台', '管理后台', '管理后台'));
        $objResponse -> setTplName("merchant/hotel_list_search");
    }

    protected function hotel_product($objRequest, $objResponse) {
        $supplierCode[0]['h_supplier'] = $objRequest->supplier_code;
        $h_id = $this->check_int($objRequest->id, 'id');
        //
        $place = $objRequest->place;
        $arraySearchData['city'] = $objRequest->city;//city_id
        $arraySearchData['place_type'] = $objRequest->place_type;
        $arraySearchData['place_en_name'] = $objRequest->place_en_name;
        $arraySearchData['CheckIn'] = $objRequest->CheckIn;
        $arraySearchData['CheckOut'] = $objRequest->CheckOut;
        $arraySearchData['RoomsNum'] = $objRequest->RoomsNum;
        $arraySearchData['AdultNum'] = $objRequest->AdultNum;
        $arraySearchData['ChildNum'] = $objRequest->ChildNum;
        $arraySearchData['ChildAge'] = $objRequest->ChildAge > 0 ? $objRequest->ChildAge : 15;
        $arraySearchData['HotelId'][0] = $h_id;
        //
        $conditions = \DbConfig::$db_query_conditions;
        $objHotelService = new HotelService();
        if(!empty($supplierCode[0]['h_supplier'])) {
            $supplierCode[0]['h_supplier_code'] = $h_id;
        } else {
            $conditions['where']['h_id'] = $h_id;
            $supplierCode = $objHotelService->getHotel($conditions, 'h_supplier, h_supplier_code');
        }
        if(!empty($supplierCode)) {
            if(!empty($arraySearchData['CheckIn']) && !empty($arraySearchData['CheckOut']) && !empty($arraySearchData['AdultNum'])) {
                //$arraySearchData['RoomsInformation'][0]['AdultNum'] = $objRequest->AdultNum;
                //$arraySearchData['RoomsInformation'][0]['ChildNum'] = $objRequest->ChildNum;
                //$arraySearchData['RoomsInformation'][0]['ChildAge'][0] = $objRequest->ChildAge > 0 ? $objRequest->ChildAge : 15;
                //计算房间数
                $avg_AdultNum = floor($arraySearchData['AdultNum'] / $arraySearchData['RoomsNum']);//平均每间房多少人住
                $mod__AdultNum = $arraySearchData['AdultNum'] % $arraySearchData['RoomsNum'];//取余
                $avg_ChildNum = $arraySearchData['ChildNum'];
                for($i = 0; $i < $arraySearchData['RoomsNum']; $i++) {
                    if($mod__AdultNum > 0) {
                        $arraySearchData['RoomsInformation'][$i]['AdultNum'] = $avg_AdultNum + 1;
                        $mod__AdultNum--;
                    } else {
                        $arraySearchData['RoomsInformation'][$i]['AdultNum'] = $avg_AdultNum;
                    }
                    if($avg_ChildNum > 0) {
                        $arraySearchData['RoomsInformation'][$i]['ChildNum'] = 1;
                        $arraySearchData['RoomsInformation'][$i]['ChildAge'][0] = 15;
                        $avg_ChildNum--;
                    } else {
                        $arraySearchData['RoomsInformation'][$i]['ChildNum'] = '';
                        $arraySearchData['RoomsInformation'][$i]['ChildAge'][0] = 0;
                    }
                }

                \BaseHotelService::instance()->hotelTemplace($supplierCode[0], $objResponse, $objResponse->arrUserInfo['m_id'], $arraySearchData);
                //$arrayTouricoListData = $objHotelService->searchHotelInSupplier('tourico', $arraySearchData);
                //if(isset($arrayTouricoListData['s:Body'][0]['SearchHotelsByIdResponse'][0]['SearchHotelsByIdResult'][0]['HotelList'][0]['Hotel']));
                //print_r($arrayTouricoListData);
                //exit();
            } else {
                \BaseHotelService::instance()->hotelTemplace($supplierCode[0], $objResponse, $objResponse->arrUserInfo['m_id']);
            }
        }

        $conditions['where'] = "h_id > ".($h_id - 5)." AND h_id < " . ($h_id + 50) . ' AND h_id != ' . $h_id;
        $conditions['limit'] = "0, 10";
        $relation_hotel = $objHotelService->getHotel($conditions, 'h_id, h_name, h_images');
        $objResponse -> setTplValue('hotel_supplier_tpl', 'hotel_' . $supplierCode[0]['h_supplier']);
        $objResponse -> setTplValue('h_id', $h_id);
        $objResponse -> setTplValue('supplierCode', \Encrypt::instance()->encode($h_id));
        $objResponse -> setTplValue('supplier', \Encrypt::instance()->encode($supplierCode[0]['h_supplier']));
        $objResponse -> setTplValue('HotelId', $supplierCode[0]['h_supplier_code']);
        $objResponse -> setTplValue('today', substr(getDateTime(), 0, 10));
        $objResponse -> setTplValue('arraySearchData', $arraySearchData);
        $objResponse -> setTplValue('searchData', \Encrypt::instance()->encode(json_encode($arraySearchData)));
        $objResponse -> setTplValue('relation_hotel', $relation_hotel);
        $objResponse -> setTplName("merchant/hotel_product");
    }


}