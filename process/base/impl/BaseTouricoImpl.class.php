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
            $arrayRoomType = $arrayRoomTypeHash = null;
            if(isset($arrayTouricoListData['s:Body'][0]['SearchHotelsByIdResponse'][0]['SearchHotelsByIdResult'][0]['HotelList'][0]['Hotel'])) {
                $arrayRoomType = $arrayTouricoListData['s:Body'][0]['SearchHotelsByIdResponse'][0]['SearchHotelsByIdResult'][0]['HotelList'][0]['Hotel'][0]['RoomTypes'][0]['RoomType'];
                $arrayRoomTypeHash = null;
                foreach($arrayRoomType as $k => $v) {
                    $arrayRoomTypeHash[$v['roomId']] = $v;
                }
                unset($arrayRoomType);
            }

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

    public function createOrder($objRequest, $u_id, $m_id, $mu_id) {
        //print_r($objRequest);
        //预订数据
        $arraySearchData  = json_decode(\Encrypt::instance()->decode($objRequest->searchData), true);
        print_r($arraySearchData);
        $arraySearchData['HotelRoomTypeId'] = $objRequest->RoomType;
        $arraySearchData['RoomsInformation'][0]['RoomId'] = $objRequest->options;
        //CheckAvailabilityAndPrices
        $arrayCheckAvailabilityAndPrices = \BaseSupplierTouricoService::instance()->CheckAvailabilityAndPrices($arraySearchData);
        print_r($arrayCheckAvailabilityAndPrices);exit();
        if(isset($arrayCheckAvailabilityAndPrices['s:Body'][0]['CheckAvailabilityAndPricesResponse']['0']['CheckAvailabilityAndPricesResult'][0]['HotelList'][0]['Hotel'])) {
            $arrayHotel = $arrayCheckAvailabilityAndPrices['s:Body'][0]['CheckAvailabilityAndPricesResponse']['0']['CheckAvailabilityAndPricesResult'][0]['HotelList'][0]['Hotel'];
            $arrayBookInfo['RecordLocatorId'] = '';
            $arrayBookInfo['HotelId'] = '';
            $arrayBookInfo['HotelRoomTypeId'] = '';
            $arrayBookInfo['CheckIn'] = '';
            $arrayBookInfo['CheckOut'] = '';
            $arrayBookInfo['PaymentType'] = '';
            $arrayBookInfo['AgentRefNumber'] = '';
            $arrayBookInfo['ContactInfo'] = '';
            $arrayBookInfo['RequestedPrice'] = '';
            $arrayBookInfo['DeltaPrice'] = '';
            $arrayBookInfo['Currency'] = '';
            $arrayBookInfo['IsOnlyAvailable'] = '';
            $arrayBookInfo['ConfirmationEmail'] = '';
            $arrayBookInfo['ConfirmationLogo'] = '';
            //RoomsInfo
            $arrayBookInfo['ConfirmationLogo'][0]['RoomId'] = '';
            $arrayBookInfo['ConfirmationLogo'][0]['FirstName'] = '';
            $arrayBookInfo['ConfirmationLogo'][0]['MiddleName'] = '';
            $arrayBookInfo['ConfirmationLogo'][0]['LastName'] = '';
            $arrayBookInfo['ConfirmationLogo'][0]['HomePhone'] = '';
            $arrayBookInfo['ConfirmationLogo'][0]['MobilePhone'] = '';
            //RoomsInfo SelectedBoardBase
            $arrayBookInfo['ConfirmationLogo'][0]['Id'] = '';
            $arrayBookInfo['ConfirmationLogo'][0]['Price'] = '';
            $arrayBookInfo['ConfirmationLogo'][0]['suppId'] = '';
            $arrayBookInfo['ConfirmationLogo'][0]['supTotalPrice'] = '';
            $arrayBookInfo['ConfirmationLogo'][0]['suppType'] = '';
            $arrayBookInfo['ConfirmationLogo'][0]['suppFrom'] = '';
            $arrayBookInfo['ConfirmationLogo'][0]['suppTo'] = '';
            $arrayBookInfo['ConfirmationLogo'][0]['suppQuantity'] = '';
            $arrayBookInfo['ConfirmationLogo'][0]['suppPrice'] = '';
            $arrayBookInfo['ConfirmationLogo'][0]['Bedding'] = '';
            $arrayBookInfo['ConfirmationLogo'][0]['Note'] = '';
            $arrayBookInfo['ConfirmationLogo'][0]['AdultNum'] = '';
            $arrayBookInfo['ConfirmationLogo'][0]['ChildNum'] = '';
            $arrayBookInfo['ConfirmationLogo'][0]['ChildAge'] = array();
        }


        $arrayBookHotelV3 = \BaseSupplierTouricoService::instance()->BookHotelV3($arraySearchData);
        //print_r($arrayBookHotelV3);exit();
        //检查商户剩余资金

        //锁定资金

        //用户订购信息
        //插入数据库
        $arrayUserBookInfo['oi_user_arrival_date'] = $arraySearchData['CheckIn'];
        $arrayUserBookInfo['oi_user_leave_date'] = $arraySearchData['CheckOut'];
        $arrayUserBookInfo['oi_user_options'] = $objRequest->options;
        $arrayUserBookInfo['oi_user_pax'] = $arraySearchData['AdultNum'];
        $arrayUserBookInfo['oi_user_childen'] = $arraySearchData['AdultNum'];
        $arrayUserBookInfo['oi_user_salutation'] = $objRequest->salutation;
        $arrayUserBookInfo['oi_user_firstname'] = $objRequest->firstName;
        $arrayUserBookInfo['oi_user_lastname'] = $objRequest->lastName;
        $arrayUserBookInfo['oi_user_email'] = $objRequest->email;
        $arrayUserBookInfo['oi_user_moblie'] = $objRequest->mobile;
        $arrayUserBookInfo['oi_user_message'] = $objRequest->message;
        //取得支付价格
        //订单信息
        $arrayOrder['u_id'] = $u_id;
        $arrayOrder['m_id'] = $m_id;
        $arrayOrder['mu_id'] = $mu_id;
        $arrayOrder['o_price_market'] = '';//网上售卖价格
        $arrayOrder['o_price_sell'] = '';//售卖价格 成交价
        $arrayOrder['o_price_wholesale'] = '';//批发价
        $arrayOrder['o_price_original'] = '';//进货价
        $arrayOrder['o_add_date'] = getDateTime();

        //订购


        //扣除锁定资金


        return $arrayOrderResult;
    }

}