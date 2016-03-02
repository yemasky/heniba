<?php

/**
 * Created by PhpStorm.
 * User: YEMASKY
 * Date: 2015/12/13
 * Time: 21:20
 */
class BaseBemyguestTool extends BaseTool {
    private static $objBaseBemyguestTool = null;

    public static function instance() {
        if(is_object(self::$objBaseBemyguestTool)) return self::$objBaseBemyguestTool;
        self::$objBaseBemyguestTool = new BaseBemyguestTool();
        return self::$objBaseBemyguestTool;
    }

    public function tourismTemplace($supplierCode, $objResponse) {
        $tourism_product = BaseTourismService::instance()->getSupplierTourism($supplierCode);
        $arrayProductPrice = $arrayProductPrice = $productTypeNum = $tourismAttr = $arrayMaxPax = NULL;
        $arrayCurrency['code'] = '';
        $class_supplier = '\supplier\\' . ucfirst($supplierCode['t_supplier']) . 'Config';
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
                throw new Exception('productTypes is null. t_supplier:' . $supplierCode['t_supplier'] . "; code:" . $supplierCode['t_supplier_code']);
            }
            foreach($tourism_product[0]['productTypes'] as $k => $prices) {
                foreach($prices['prices'] as $kk => $date) {//日期
                    if(isset($date['regular']['adult'])) {//人数
                        foreach ($date['regular']['adult'] as $kkk => $price) {
                            $arrayProductPrice[$kk][$kkk][$k] = ceil($price);//价格
                        }
                    }
                }
            }
            $productTypeNum = $k;
            $tourism_product[0]['locations'] = json_decode($tourism_product[0]['locations'], true);

            if(!empty($tourism_product[0]['titleTranslated']))
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
                $tourism_product[0]['meetingLocation'] = $tourism_product[0]['meetingLocationTranslated'];
            $arrayCurrency = json_decode($tourism_product[0]['currency'], true);
        }
        $objResponse -> setTplValue('tourism_product', $tourism_product[0]);
        $objResponse -> setTplValue('productprice', json_encode($arrayProductPrice));
        $objResponse -> setTplValue('productTypeNum', $productTypeNum);
        $objResponse -> setTplValue('currency', $arrayCurrency['code']);
        $objResponse -> setTplValue('tourismAttr', $tourismAttr);
		$objResponse -> setTplValue("__Meta", BaseCommon::getMeta('index', $tourism_product[0]['title'] . '-管理后台', '管理后台', '管理后台'));
    }

    public function tourismSourceProductDatePrice($supplierCode, $checkdate) {
        $arrayDate['date_start'] = $checkdate;//date("Y-m-d");//
        $arrayDate['date_end'] = $checkdate;
        $objBemyguestService = new \supplier\BemyguestService;
        $arrayResult = $objBemyguestService->product($supplierCode['t_supplier_code'], $arrayDate);
        if($arrayResult['httpcode'] != 200) {
            throw new Exception('get bemyguest product error: uuid ' . $supplierCode['t_supplier_code']);
        } else {
            $arrayProductPrice = '';
            $tourism_product = json_decode($arrayResult['result'], true);
            foreach($tourism_product['data']['productTypes'] as $k => $prices) {
                foreach($prices['prices'] as $kk => $date) {
                    if(isset($date['regular']['adult'])) {
                        foreach ($date['regular']['adult'] as $kkk => $price) {
                            $arrayProductPrice[$kk][$kkk][$k] = ceil($price);
                        }
                    }
                }
            }
            echo json_encode($arrayProductPrice);
        }
    }
}