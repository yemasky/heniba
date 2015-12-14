<?php

/**
 * Created by PhpStorm.
 * User: YEMASKY
 * Date: 2015/12/13
 * Time: 21:20
 */
class BaseBemyguestTool extends BaseTool {
    private static $objBaseBemyguestTool = null;

    public static function instance($objProcess = NULL) {
        if(is_object(self::$objBaseBemyguestTool)) return self::$objBaseBemyguestTool;
        self::$objBaseBemyguestTool = new BaseBemyguestTool($objProcess);
        return self::$objBaseBemyguestTool;
    }

    public function tourismTemplace($supplierCode, $objResponse) {
        $tourism_product = BaseTourismService::instance($this->objProcess)->getSupplierTourism($supplierCode);
        $arrayProductPrice = $arrayProductPrice = $productTypeNum = $tourismAttr = $arrayMaxPax = NULL;
        $arrayCurrency['code'] = '';
        $supplier = ucfirst($supplierCode['t_supplier']) . 'Config';
        if(!empty($tourism_product)) {
            $objProcess = new Process('supplier');
            $field_config = $objProcess->$supplier()->tour_field;
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

            foreach($tourism_product[0]['productTypes'] as $k => $prices) {
                foreach($prices['prices'] as $kk => $date) {
                    if(isset($date['regular']['adult'])) {
                        foreach ($date['regular']['adult'] as $kkk => $price) {
                            $arrayProductPrice[$kk][$kkk][$k] = ceil($price);
                        }
                    }
                }
            }
            $productTypeNum = $k;
            $tourism_product[0]['locations'] = json_decode($tourism_product[0]['locations'], true);
            for($i = $tourism_product[0]['minPax']; $i<= $tourism_product[0]['maxPax']; $i++) {
                $arrayMaxPax[] = $i;
            }
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
        $objResponse -> setTplValue('maxPax', $arrayMaxPax);
		$objResponse -> setTplValue("__Meta", BaseCommon::getMeta('index', $tourism_product[0]['title'] . '-管理后台', '管理后台', '管理后台'));
    }

    public function tourismSourceProductDatePrice($supplierCode, $checkdate) {
        $arrayDate['date_start'] = $checkdate;
        $arrayDate['date_end'] = $checkdate;
        $objProcess = new Process('supplier');
        $arrayResult = $objProcess->BemyguestService($objProcess)->product($supplierCode['t_supplier_code'], $arrayDate);
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