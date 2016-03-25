<?php

/**
 * Created by PhpStorm.
 * User: YEMASKY
 * Date: 2015/12/13
 * Time: 21:20
 */
class BaseTouricoImpl extends BaseService {
    private static $objBaseTouricoImpl = null;

    public static function instance() {
        if(is_object(self::$objBaseTouricoImpl)) return self::$objBaseTouricoImpl;
        self::$objBaseTouricoImpl = new BaseTouricoImpl();
        return self::$objBaseTouricoImpl;
    }

    public function touricoTemplace($arraySupplierCode, $objResponse, $m_id, $arraySearchData = null) {
        $data_product = BaseHotelService::instance()->getSupplierHotel($arraySupplierCode);
        if(empty($data_product)) {
            $objTouricoTool = new \supplier\TouricoTool();
            $objTouricoTool->disposeHotelsByHotelID(array($arraySupplierCode['h_supplier_code']));
            $data_product = BaseHotelService::instance()->getSupplierHotel($arraySupplierCode);
        }
        if(!empty($data_product)) {
            $data_product[0]['Location'] = json_decode($data_product[0]['Location'], true);
            $data_product[0]['RefPoints'] = json_decode($data_product[0]['RefPoints'], true);
            $data_product[0]['Descriptions'] = Utilities::toHtml(json_decode($data_product[0]['Descriptions'], true));
            $data_product[0]['Media'] = json_decode($data_product[0]['Media'], true);
            $data_product[0]['Amenities'] = json_decode($data_product[0]['Amenities'], true);
            $data_product[0]['RoomType'] = json_decode($data_product[0]['RoomType'], true);
            $data_product[0]['Home'] = json_decode($data_product[0]['Home'], true);
        }
        if(!empty($arraySearchData)) {
            $objHotelService = new \merchant\HotelService();
            $arrayTouricoListData = $objHotelService->searchHotelInSupplier('tourico', $arraySearchData);
            $arrayRoomType = null;
            if(isset($arrayTouricoListData['s:Body'][0]['SearchHotelsByIdResponse'][0]['SearchHotelsByIdResult'][0]['HotelList'][0]['Hotel'])) {
                $arrayRoomType = $arrayTouricoListData['s:Body'][0]['SearchHotelsByIdResponse'][0]['SearchHotelsByIdResult'][0]['HotelList'][0]['Hotel'][0]['RoomTypes'][0]['RoomType'];
            }
            $arrayRoomTypeHash = null;
            foreach($arrayRoomType as $k => $v) {
                $arrayRoomTypeHash[$v['roomId']] = $v;
            }
            unset($arrayRoomType);
            foreach($data_product[0]['RoomType'] as $k => $v) {
                if(isset($arrayRoomTypeHash[$v['roomId']])) {
                    $data_product[0]['RoomType'][$k]['is_can_book'] = 1;
                    if(isset($arrayRoomTypeHash[$v['roomId']]['Discount'])) $data_product[0]['RoomType'][$k]['Discount'] = $arrayRoomTypeHash[$v['roomId']]['Discount'];
                    $data_product[0]['RoomType'][$k]['Occupancies'] = $arrayRoomTypeHash[$v['roomId']]['Occupancies'];
                } else {
                    $data_product[0]['RoomType'][$k]['is_can_book'] = 0;
                }
            }
            //print_r( $data_product[0]['RoomType']);
            //print_r($arrayRoomType);

        }
        //print_r($data_product[0]['RoomType']);
        $arrayImages = $data_product[0]['Media'];
        $arrayImages = $arrayImages[0]['Images'][0]['Image'];
        $num = count($arrayImages);
        for($i = 0; $i < $num; $i++) {
            $arrayImagesSrc[$arrayImages[0]['path']] = $arrayImages[0]['path'];
            if(count($arrayImagesSrc) >= 19) break;
        }
        sort($arrayImagesSrc);
        $objResponse -> setTplValue('data_product_images', json_encode($arrayImagesSrc));
        $objResponse -> setTplValue('data_product', $data_product[0]);
        $objResponse -> setTplValue("__Meta", BaseCommon::getMeta('index', $data_product[0]['name'] . '-管理后台', '管理后台', '管理后台'));

    }

    public function hotelSourceProductDatePrice($arraySupplierCode, $checkdate, $m_id) {

    }

    public function formatSearchHotelList($arrayTouricoListData) {
        if(isset($arrayTouricoListData['s:Body']['0']['SearchHotelsResponse']['0']['SearchHotelsResult']['0']['HotelList'])) {
            $arrayTouricoListData = $arrayTouricoListData['s:Body']['0']['SearchHotelsResponse']['0']['SearchHotelsResult']['0']['HotelList'];
        } else {
            return null;
        }
        return $arrayTouricoListData;
    }

}