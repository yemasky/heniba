<?php

/**
 * Created by PhpStorm.
 * User: CooC
 * Date: 2015/12/8
 * Time: 14:28
 */
class TourismAction extends BaseAction {
    protected function check($objRequest, $objResponse) {
        $objResponse->arrUserInfo = $this->objProcess->CommonService($this->objProcess)->checkLoginUser();
    }

    protected function service($objRequest, $objResponse) {
        switch($objRequest->getAction()) {
            case 'product':
                $this->tour_product($objRequest, $objResponse);
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
        //
        //设置类别
        $pn = $objRequest->pn;
        $pn = empty($pn) ? 1 : $pn;
        $list_count = $objRequest->list_count;
        $list_count = empty($list_count) ? 20 : $list_count;
        $conditions = DbConfig::$db_query_conditions;
        $conditions['limit'] = (($pn - 1) * $list_count) . ", $list_count";
        $objResponse -> setTplValue('tourism', $this->objProcess->TourismService($this->objProcess)->getTourism($conditions));
        $tourismCount = $this->objProcess->TourismService($this->objProcess)->getTourismCount($conditions['condition']);
        //
        $objResponse -> nav = 'index';
        $objResponse -> setTplValue('page', page($pn, ceil($tourismCount/$list_count)));
        $objResponse -> setTplValue('pn', $pn);
        $objResponse -> setTplValue('show_pages', 10);
        $objResponse -> setTplValue('merchantMenu', $objResponse->arrMerchantMenu);
        //设置Meta
        $objResponse -> setTplValue("__Meta", BaseCommon::getMeta('index', '管理后台', '管理后台', '管理后台'));
        $objResponse -> setTplName("merchant/tourism_list");
    }

    protected function tour_product($objRequest, $objResponse) {
        $t_id = $this->check_int($objRequest->id, 'id');
        $conditions = DbConfig::$db_query_conditions;
        $conditions['condition']['t_id'] = $t_id;
        $supplierCode = $this->objProcess->TourismService($this->objProcess)->getTourism($conditions, 't_supplier, t_supplier_code');
        $tourism_product[0] = null;
        if(!empty($supplierCode)) {
            $tourism_product = BaseTourismService::instance($this->objProcess)->getSupplierTourism($supplierCode[0]);
            $supplier = ucfirst($supplierCode[0]['t_supplier']) . 'Config';
            if(!empty($tourism_product)) {
            	$objProcess = new Process('supplier');
            	$field_config = $objProcess->$supplier()->tour_field;
            	$tourismAttr = array();
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
                $arrayProductPrice = array();
                foreach($tourism_product[0]['productTypes'] as $k => $prices) {
                    foreach($prices['prices'] as $kk => $date) {
                        if(isset($date['regular']['adult'])) {
                            foreach ($date['regular']['adult'] as $kkk => $price) {
                                $arrayProductPrice[$kk][$kkk][$k] = $price;
                            }
                        }
                    }
                }
                $tourism_product[0]['locations'] = json_decode($tourism_product[0]['locations'], true);
                $arrayMaxPax = null;
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
            }
        }

        $conditions = DbConfig::$db_query_conditions;
        $conditions['condition'] = "t_id > $t_id AND t_id < " . (($t_id + 50));
        $conditions['limit'] = "0, 10";
        $relation_tourism = $this->objProcess->TourismService($this->objProcess)->getTourism($conditions, 't_id, t_title, t_title_cn, t_images');
        $objResponse -> setTplValue('tourism_supplier_tpl', 'tour_' . $supplierCode[0]['t_supplier']);
        $objResponse -> setTplValue('tourism_product', $tourism_product[0]);
        $objResponse -> setTplValue('productprice', json_encode($arrayProductPrice));
        $objResponse -> setTplValue('tourismAttr', $tourismAttr);
        $objResponse -> setTplValue('maxPax', $arrayMaxPax);
        $objResponse -> setTplValue('today', substr(getDateTime(), 0, 10));
        $objResponse -> setTplValue('relation_tourism', $relation_tourism);
        $objResponse -> setTplValue("__Meta", BaseCommon::getMeta('index', '管理后台', '管理后台', '管理后台'));
        $objResponse -> setTplName("merchant/tourism_product");
    }

}