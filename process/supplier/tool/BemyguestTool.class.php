<?php
/**
 * file_name 2015年12月8日
 * @author YEMASKY  yemasky@msn.com
 * Copyright 2015  
 */

class BemyguestTool extends BaseTool {
	public function parserTourProduct() {
        $arrarTourProduct = $this->objProcess->BemyguestDao()->getTourProduct();
        foreach($arrarTourProduct as $k => $v) {
            print_r($v);exit();
            $tc_name = $v['typeName'];
            $arrayData['tc_id'] = $this->objProcess->TourismDao()->getTCategoryIdByName($tc_name);
            if(empty($arrayData['tc_id'])) {
                $arrayData['tc_id'] = $this->objProcess->TourismDao()->insertTCategory($tc_name);
            }
            //
            $arrayLocations = json_decode($v['locations'], true);
            $arrayResult = $this->objProcess->TourismDao()->getCountryIdByName($arrayLocations[0]['country']);
            $arrayData['c_country_id'] = $arrayResult['tc_id'];
            $arrayData['c_continent_id'] = $arrayResult['c_continent_id'];
            if(empty($arrayData['c_country_id'])) {
                throw new Exception('c_country_id is null:' . $arrayLocations[0]['country']);
            }
            $arrayResult = $this->objProcess->TourismDao()->getCountryIdByName($arrayLocations[0]['state']);
            $arrayData['c_state_id'] = $arrayResult['tc_id'];
            if(empty($arrayData['c_state_id'])) {
                $sql = 'INSERT INTO country (c_name, c_country_id, c_continent_id) VALUES(\''.addslashes($arrayLocations[0]['state']).'\','.$arrayData['c_country_id'].','.$arrayData['c_continent_id'].')';
                $arrayData['c_state_id'] = $this->objProcess->TourismDao()->insertCountry($sql);
            }
            $arrayResult = $this->objProcess->TourismDao()->getCountryIdByName($arrayLocations[0]['city']);
            $arrayData['c_city_id'] = $arrayResult['tc_id'];
            if(empty($arrayData['c_city_id'])) {
                $sql = 'INSERT INTO country (c_name, c_country_id, c_continent_id, c_state_id) VALUES(\''.addslashes($arrayLocations[0]['city']).'\','
                      .$arrayData['c_country_id'].','.$arrayData['c_continent_id'].','.$arrayData['c_state_id'].')';
                $arrayData['c_city_id'] = $this->objProcess->TourismDao()->insertCountry($sql);
            } elseif(empty($arrayResult['c_state_id'])) {
                $sql = 'UPDATE country SET c_state_id=' .$arrayData['c_state_id'] . 'WHERE c_city_id = ' . $arrayData['c_city_id'];
                $this->objProcess->TourismDao()->insertCountry($sql);
            }
            //
            $arrayData['t_title'] = $v['title'];
            $arrayData['t_title_cn'] = $v['titleTranslated'];
            $arrayData['t_description'] = $v['description'];
            $arrayData['t_description_cn'] = $v['descriptionTranslated'];
            $arrayData['t_latitude'] = $v['latitude'];
            $arrayData['t_longitude'] = $v['longitude'];
            $arrayData['t_price'] = $v['basePrice'];
            $currency = json_decode($v['currency']);
            $arrayData['currency'] = $currency['code'];
            $arrayData['t_review_count'] = $v['reviewCount'];
            $arrayData['t_review_average_score'] = $v['reviewAverageScore'];
            $arrayData['t_images'] = '';
            print_r($arrayData);exit();

        }
    }

}