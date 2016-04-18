<?php

/**
 * Created by PhpStorm.
 * User: YEMASKY
 * Date: 2015/12/13
 * Time: 21:20
 */
class BaseBemyguestImpl extends BaseService {
    private static $objBaseBemyguestImpl = null;

    public static function instance($objClass = '') {
        if(is_object(self::$objBaseBemyguestImpl)) return self::$objBaseBemyguestImpl;
        self::$objBaseBemyguestImpl = new BaseBemyguestImpl();
        return self::$objBaseBemyguestImpl;
    }

    //取得售卖价格
    public function tourismTemplace($arraySupplierCode, $objResponse, $m_id) {
        $tourism_product = BaseTourismService::instance()->getSupplierTourism($arraySupplierCode);
        $arrayProductPrice = $arrayProductPrice = $productTypeNum = $tourismAttr = $arrayMaxPax = NULL;
        $arrayCurrency['code'] = '';
        $class_supplier = '\supplier\\' . ucfirst($arraySupplierCode['t_supplier']) . 'Config';
        if(!empty($tourism_product)) {
            $objSupplier = new $class_supplier;
            $field_config = $objSupplier->tour_field;
            $i = 0;
            foreach ($tourism_product[0] as $k => $v) {
                if(isset($field_config[$k]) && !empty($v)) {
                    $tourismAttr[$i]['v'] = $v;
                    $tourismAttr[$i]['k'] = $k;
                    $tourismAttr[$i]['n'] = $field_config[$k];
                    $i++;
                }
            }
            $tourism_product[0]['productTypes'] = json_decode($tourism_product[0]['productTypes'], true);
            if(empty($tourism_product[0]['productTypes'])) {
                throw new Exception('productTypes is null. t_supplier:' . $arraySupplierCode['t_supplier'] . "; code:" . $arraySupplierCode['t_supplier_code']);
            }
            foreach($tourism_product[0]['productTypes'] as $k => $prices) {
                foreach($prices['prices'] as $kk => $date) {//日期
                    if(isset($date['regular']['adult'])) {//人数
                        foreach ($date['regular']['adult'] as $kkk => $price) {
                            $arrayRatePrice = \merchant\CommonService::getMerchantRatePrice($m_id, $price, 'tourism');
                            $arrayProductPrice[$kk][$kkk][$k] = $arrayRatePrice['sell'];//价格
                        }
                    }
                }
            }
            $productTypeNum = $k;
            $tourism_product[0]['locations'] = json_decode($tourism_product[0]['locations'], true);

            /*if(!empty($tourism_product[0]['titleTranslated']))
                $tourism_product[0]['title'] = $tourism_product[0]['titleTranslated'];
            if(!empty($tourism_product[0]['descriptionTranslated']))
                $tourism_product[0]['description'] = $tourism_product[0]['descriptionTranslated'];
            if(!empty($tourism_product[0]['highlightsTranslated']))
                $tourism_product[0]['highlights'] = $tourism_product[0]['highlightsTranslated'];
            if(!empty($tourism_product[0]['additionalInfoTranslated']))
                $tourism_product[0]['additionalInfo'] = $tourism_product[0]['additionalInfoTranslated'];
            if(!empty($tourism_product[0]['priceIncludesTranslated']))
                $tourism_product[0]['priceIncludes'] = $tourism_product[0]['priceIncludesTranslated'];
            if(!empty($tourism_product[0]['priceExcludesTranslated']))
                $tourism_product[0]['priceExcludes'] = $tourism_product[0]['priceExcludesTranslated'];
            if(!empty($tourism_product[0]['itineraryTranslated']))
                $tourism_product[0]['itinerary'] = $tourism_product[0]['itineraryTranslated'];
            if(!empty($tourism_product[0]['warningsTranslated']))
                $tourism_product[0]['warnings'] = $tourism_product[0]['warningsTranslated'];
            if(!empty($tourism_product[0]['safetyTranslated']))
                $tourism_product[0]['safety'] = $tourism_product[0]['safetyTranslated'];
            if(!empty($tourism_product[0]['meetingLocationTranslated']))
                $tourism_product[0]['meetingLocation'] = $tourism_product[0]['meetingLocationTranslated'];*/
            $arrayCurrency = json_decode($tourism_product[0]['currency'], true);
        }
        $objResponse -> setTplValue('tourism_product', $tourism_product[0]);
        $objResponse -> setTplValue('productprice', json_encode($arrayProductPrice));
        $objResponse -> setTplValue('productTypeNum', $productTypeNum);
        $objResponse -> setTplValue('currency', $arrayCurrency['code']);
        $objResponse -> setTplValue('tourismAttr', $tourismAttr);
		$objResponse -> setTplValue("__Meta", BaseCommon::getMeta('index', $tourism_product[0]['title'] . '-管理后台', '管理后台', '管理后台'));
    }

    //取得售卖价格json 单个
    public function tourismSourceProductDatePrice($arraySupplierCode, $checkdate, $m_id, $result_single = false) {
        $arrayDate['date_start'] = $checkdate;//date("Y-m-d");//
        $arrayDate['date_end'] = $checkdate;
        $objBemyguestService = new \supplier\BemyguestService;
        $arrayResult = $objBemyguestService->product($arraySupplierCode['t_supplier_code'], $arrayDate);
        if($arrayResult['httpcode'] != 200) {
            throw new Exception('get bemyguest product error: uuid ' . $arraySupplierCode['t_supplier_code']);
        } else {
            $arrayProductPrice = '';
            $tourism_product = json_decode($arrayResult['result'], true);
            if(!isset($tourism_product['data']['productTypes'])) {
                //return json_encode(array());
            }
            if($result_single) return $tourism_product['data']['productTypes'];
            foreach($tourism_product['data']['productTypes'] as $k => $prices) {
                foreach($prices['prices'] as $kk => $date) {
                    if(isset($date['regular']['adult'])) {
                        foreach ($date['regular']['adult'] as $kkk => $price) {
                            $arrayRatePrice = \merchant\CommonService::getMerchantRatePrice($m_id, $price, 'tourism');
                            $arrayProductPrice[$kk][$kkk][$k] = $arrayRatePrice['sell'];
                        }
                    }
                }
            }
            echo json_encode($arrayProductPrice);
        }
    }

    public function createOrder($objRequest, $u_id, $m_id, $mu_id, $arraySupplierCode) {
        //检查商户剩余资金

        //锁定资金

        //用户订购信息
        $arrayUserBookInfo['oi_user_arrival_date'] = $objRequest->arrivalDate;
        $arrayUserBookInfo['oi_user_options'] = $objRequest->options;
        $arrayUserBookInfo['oi_user_pax'] = $objRequest->pax;
        $arrayUserBookInfo['oi_user_salutation'] = $objRequest->salutation;
        $arrayUserBookInfo['oi_user_firstname'] = $objRequest->firstName;
        $arrayUserBookInfo['oi_user_lastname'] = $objRequest->lastName;
        $arrayUserBookInfo['oi_user_email'] = $objRequest->email;
        $arrayUserBookInfo['oi_user_moblie'] = $objRequest->mobile;
        $arrayUserBookInfo['oi_user_message'] = $objRequest->message;
        //取得支付价格
        $tourism_product = BaseTourismService::instance()->getSupplierTourism($arraySupplierCode);
        $tourism_product[0]['productTypes'] = json_decode($tourism_product[0]['productTypes'], true);
        if(empty($tourism_product[0]['productTypes'])) {
            throw new Exception('productTypes is null. t_supplier:' . $arraySupplierCode['t_supplier'] . "; code:" . $arraySupplierCode['t_supplier_code']);
        }
        $arraySelectTourism = $tourism_product[0]['productTypes'][$arrayUserBookInfo['oi_user_options']];
        if(isset($arraySelectTourism['prices'][$arrayUserBookInfo['oi_user_arrival_date']]['regular']['adult'][$arrayUserBookInfo['oi_user_pax']])) {
            $price = $arraySelectTourism['prices'][$arrayUserBookInfo['oi_user_arrival_date']]['regular']['adult'][$arrayUserBookInfo['oi_user_pax']];
            $arrayRatePrice = \merchant\CommonService::getMerchantRatePrice($m_id, $price, 'tourism');
        } else {
            $arraySelectTourism = $this->tourismSourceProductDatePrice($arraySupplierCode, $arrayUserBookInfo['oi_user_arrival_date'], $m_id, true);
            $arraySelectTourism = $arraySelectTourism[$arrayUserBookInfo['oi_user_options']];
            if(isset($arraySelectTourism['prices'][$arrayUserBookInfo['oi_user_arrival_date']]['regular']['adult'][$arrayUserBookInfo['oi_user_pax']])) {
                $price = $arraySelectTourism['prices'][$arrayUserBookInfo['oi_user_arrival_date']]['regular']['adult'][$arrayUserBookInfo['oi_user_pax']];
                $arrayRatePrice = \merchant\CommonService::getMerchantRatePrice($m_id, $price, 'tourism');
            }
        }
        $tourism_uuid = $arraySelectTourism['uuid'];

        //订单信息
        $arrayOrder['u_id'] = $u_id;
        $arrayOrder['m_id'] = $m_id;
        $arrayOrder['mu_id'] = $mu_id;
        $arrayOrder['o_price_market'] = $arrayRatePrice['sell'];//网上售卖价格
        $arrayOrder['o_price_sell'] = $arrayRatePrice['sell'];//售卖价格 成交价
        $arrayOrder['o_price_wholesale'] = $arrayRatePrice['wholesale'];//批发价
        $arrayOrder['o_price_original'] = $price;//进货价
        $arrayOrder['o_add_date'] = getDateTime();
        $arrayOrderResult = BaseBookOrderDao::createOrder($arrayOrder);
        //
        $arrayUserBookInfo['o_id'] = $arrayOrderResult[0];
        $arrayUserBookInfo['o_order_number'] = $arrayOrderResult[1];
        $arrayUserBookInfo['u_id'] = $u_id;
        $arrayUserBookInfo['m_id'] = $m_id;
        $arrayUserBookInfo['mu_id'] = $mu_id;
        $arrayUserBookInfo['oi_price_market'] = $arrayRatePrice['sell'];
        $arrayUserBookInfo['oi_price_sell'] = $arrayRatePrice['sell'];
        $arrayUserBookInfo['oi_price_wholesale'] = $arrayRatePrice['wholesale'];
        $arrayUserBookInfo['oi_price_original'] = $price;
        $arrayUserBookInfo['oi_type'] = 'tourism';
        $arrayUserBookInfo['oi_product_id'] = \Encrypt::instance()->decode($objRequest->supplierCode);
        //$arrayUserBookInfo['oi_user_arrival_date'] = $objRequest->arrivalDate;
        $arrayUserBookInfo['oi_user_leave_date'] = '';
        $arrayUserBookInfo['oi_add_date'] = getDateTime();
        //
        $arrayUserBookInfo['oi_title'] = $tourism_product[0]['title'];
        $arrayUserBookInfo['oi_title_cn'] = $tourism_product[0]['titleTranslated'];
        $oi_id = BaseBookOrderDao::createOrderInfo($arrayUserBookInfo);
        //
        $arrayUserBookInfo['productTypeUuid'] = $tourism_uuid;
        $objBaseSupplierBemyguestService = new BaseSupplierBemyguestService();
        $arraySupplierResult = $objBaseSupplierBemyguestService->createBooking($arrayUserBookInfo);
        //print_r($arraySupplierResult);exit();
        $arrarOrderReturnLog['oi_id'] = $oi_id;
        $arrarOrderReturnLog['o_id'] = $arrayUserBookInfo['o_id'];
        $arrarOrderReturnLog['title'] = '订购旅游产品';
        $arrarOrderReturnLog['centents'] = $arraySupplierResult[0];
        $arrarOrderReturnLog['http_response_header'] = $arraySupplierResult[1];
        BaseBookOrderDao::insertOrderReturnlog($arrarOrderReturnLog);

        //订购


        //扣除锁定资金


        return $arrayOrderResult;
    }

}