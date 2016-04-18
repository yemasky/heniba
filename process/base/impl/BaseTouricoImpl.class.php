<?php

/**
 * Created by PhpStorm.
 * User: YEMASKY
 * Date: 2015/12/13
 * Time: 21:20
 */
class BaseTouricoImpl extends BaseService {
    private static $objBaseTouricoImpl = null;

    public static function instance($objClass = '') {
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
            if(isset($data_product[0]['RoomType'])) {
                foreach($data_product[0]['RoomType'] as $k => $v) {
                    if(isset($arrayRoomTypeHash[$v['roomId']])) {
                        $data_product[0]['RoomType'][$k]['is_can_book'] = 1;
                        if(isset($arrayRoomTypeHash[$v['roomId']]['Discount'])) $data_product[0]['RoomType'][$k]['Discount'] = $arrayRoomTypeHash[$v['roomId']]['Discount'];
                        $data_product[0]['RoomType'][$k]['Occupancies'] = $arrayRoomTypeHash[$v['roomId']]['Occupancies'];
                    } else {
                        $data_product[0]['RoomType'][$k]['is_can_book'] = 0;
                    }
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
        //print_r($arraySearchData);
        $arraySearchData['HotelRoomTypeId'] = $objRequest->RoomType;
        $arraySearchData['RoomsInformation'][0]['RoomId'] = $objRequest->options;
        //CheckAvailabilityAndPrices
        $arrayCheckAvailabilityAndPrices = \BaseSupplierTouricoService::instance()->CheckAvailabilityAndPrices($arraySearchData);
        //print_r($arrayCheckAvailabilityAndPrices);exit();
        if(isset($arrayCheckAvailabilityAndPrices['s:Body'][0]['CheckAvailabilityAndPricesResponse']['0']['CheckAvailabilityAndPricesResult'][0]['HotelList'][0]['Hotel'])) {
            //酒店相关
            $arrayHotel = $arrayCheckAvailabilityAndPrices['s:Body'][0]['CheckAvailabilityAndPricesResponse']['0']['CheckAvailabilityAndPricesResult'][0]['HotelList'][0]['Hotel'];
            $arrayBookInfo['RecordLocatorId'] = '0';//订单号 记录号 $b_id;
            $arrayBookInfo['HotelId'] = $arraySearchData['HotelId'][0];
            $arrayBookInfo['HotelRoomTypeId'] = $arraySearchData['HotelRoomTypeId'];
            $arrayBookInfo['CheckIn'] = $arraySearchData['CheckIn'];
            $arrayBookInfo['CheckOut'] = $arraySearchData['CheckOut'];
            //支付价格相关
            $arrayBookInfo['PaymentType'] = 'Obligo';//支付方式
            $arrayBookInfo['AgentRefNumber'] = BaseConfig::Agent;//代理号码
            $arrayBookInfo['ContactInfo'] = BaseConfig::ContactMoblie;//代理联系方式
            $arrayBookInfo['RequestedPrice'] = $arrayHotel['0']['RoomTypes'][0]['RoomType'][0]['Occupancies'][0]['Occupancy'][0]['occupPublishPrice'];
            //应付代理总价 酒店预订的要求的价格。这个价格包括所有的酒店房间，boardbases，补充（除了直接支付给酒店的费用）
            $arrayBookInfo['DeltaPrice'] = '0.01';
            //小数-指定集本币金额你愿意让我们的系统调整requestedprice为了防止订票失败。我们建议使用一个deltaprice 1%。
            //所以对于一个requestedprice 346美元预订，我们建议通过deltaprice 3.46美元。这就意味着requestedprice可以通过在349.46美元或342.54美元，和预约仍然会通过无错误。
            $arrayBookInfo['Currency'] = $arrayHotel['0']['currency'];
            $arrayBookInfo['IsOnlyAvailable'] = 'true';
            $arrayBookInfo['ConfirmationEmail'] = BaseConfig::ContactEmail;
            $arrayBookInfo['ConfirmationLogo'] = '';
            //RoomsInfo
            $arrayBookInfo['RoomsInfo'][0]['RoomId'] = $arraySearchData['RoomsInformation'][0]['RoomId'];//可选
            $arrayBookInfo['RoomsInfo'][0]['FirstName'] = $objRequest->firstName;
            $arrayBookInfo['RoomsInfo'][0]['MiddleName'] = '';
            $arrayBookInfo['RoomsInfo'][0]['LastName'] = $objRequest->lastName;
            $arrayBookInfo['RoomsInfo'][0]['HomePhone'] = $objRequest->mobile;
            $arrayBookInfo['RoomsInfo'][0]['MobilePhone'] = $objRequest->mobile;
            //RoomsInfo SelectedBoardBase
            $arrayBookInfo['RoomsInfo'][0]['Id'] = '';
            $arrayBookInfo['RoomsInfo'][0]['Price'] = '';
            //RoomsInfo SelectedSupplement
            $arrayBookInfo['RoomsInfo'][0]['suppId'] = '';
            $arrayBookInfo['RoomsInfo'][0]['supTotalPrice'] = '';
            $arrayBookInfo['RoomsInfo'][0]['suppType'] = '';
            $arrayBookInfo['RoomsInfo'][0]['suppFrom'] = '';
            $arrayBookInfo['RoomsInfo'][0]['suppTo'] = '';
            $arrayBookInfo['RoomsInfo'][0]['suppQuantity'] = '';
            $arrayBookInfo['RoomsInfo'][0]['suppPrice'] = '';
            $arrayBookInfo['RoomsInfo'][0]['Bedding'] = '';
            $arrayBookInfo['RoomsInfo'][0]['Note'] = '';
            $arrayBookInfo['RoomsInfo'][0]['AdultNum'] = $arraySearchData['AdultNum'];
            $arrayBookInfo['RoomsInfo'][0]['ChildNum'] = $arraySearchData['ChildNum'];
            $arrayBookInfo['RoomsInfo'][0]['ChildAge'] = array($arraySearchData['ChildAge']);
        }


        $arrayBookHotelV3 = \BaseSupplierTouricoService::instance()->BookHotelV3($arrayBookInfo);
        //print_r($arrayBookHotelV3['result']);exit();
        //检查商户剩余资金

        //锁定资金

        //用户订购信息
        //插入数据库
        //取得支付价格
        //订单信息
        $arrayOrder['u_id'] = $u_id;
        $arrayOrder['m_id'] = $m_id;
        $arrayOrder['mu_id'] = $mu_id;
        $arrayOrder['o_price_market'] = '1';//网上售卖价格
        $arrayOrder['o_price_sell'] = '1';//售卖价格 成交价
        $arrayOrder['o_price_wholesale'] = '1';//批发价
        $arrayOrder['o_price_original'] = '1';//进货价
        $arrayOrder['o_add_date'] = getDateTime();

        //订购
        $arrayOrderResult = BaseBookOrderDao::createOrder($arrayOrder);

        //
        $arrayUserBookInfo['o_id'] = $arrayOrderResult[0];
        $arrayUserBookInfo['o_order_number'] = $arrayOrderResult[1];
        $arrayUserBookInfo['u_id'] = $u_id;
        $arrayUserBookInfo['m_id'] = $m_id;
        $arrayUserBookInfo['mu_id'] = $mu_id;
        $arrayUserBookInfo['oi_price_market'] = '';
        $arrayUserBookInfo['oi_price_sell'] = '';
        $arrayUserBookInfo['oi_price_wholesale'] = '';
        $arrayUserBookInfo['oi_price_original'] = '';
        $arrayUserBookInfo['oi_type'] = 'hotel';
        $arrayUserBookInfo['oi_product_id'] = \Encrypt::instance()->decode($objRequest->supplierCode);
        $arrayUserBookInfo['oi_user_arrival_date'] = $arraySearchData['CheckIn'];
        $arrayUserBookInfo['oi_user_leave_date'] = $arraySearchData['CheckOut'];
        $arrayUserBookInfo['oi_add_date'] = getDateTime();
        $arrayUserBookInfo['oi_user_options'] = $objRequest->options;
        $arrayUserBookInfo['oi_user_salutation'] = $objRequest->salutation;
        $arrayUserBookInfo['oi_user_firstname'] = $objRequest->firstName;
        $arrayUserBookInfo['oi_user_lastname'] = $objRequest->lastName;
        $arrayUserBookInfo['oi_user_email'] = $objRequest->email;
        $arrayUserBookInfo['oi_user_moblie'] = $objRequest->mobile;
        $arrayUserBookInfo['oi_user_message'] = $objRequest->message;
        $arrayUserBookInfo['oi_title'] = $arrayHotel['0']['name'];
        $arrayUserBookInfo['oi_title_cn'] = '';
        $arrayUserBookInfo['oi_user_pax'] = $arraySearchData['AdultNum'];
        $arrayUserBookInfo['oi_user_childen'] = $arraySearchData['ChildNum'];
        $oi_id = BaseBookOrderDao::createOrderInfo($arrayUserBookInfo);

        //扣除锁定资金


        return $arrayOrderResult;
    }

}