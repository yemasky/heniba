<?php
/**
 * file_name 2015年12月8日
 * @author YEMASKY  yemasky@msn.com
 * Copyright 2015  
 */

class BemyguestTool extends BaseTool {
	public function parserTourProduct() {
        $arrarTourProduct = $this->objProcess->BemyguestDao()->getSimpleBemyguestTour();
        foreach($arrarTourProduct as $k => $v) {
            //print_r($v);exit;
            $arrayPhoto = json_decode($v['photos'], true);
            $arrayData['t_images'] = "";//最多5张图片
            foreach($arrayPhoto as $kphoto => $photos) {
                if($kphoto >= 5) break;
                $arrayData['t_images'][$kphoto] = $v['photosUrl'] . $photos['paths']['175x112'];
            }
            $categories = json_decode($v['categories'], true);
            //print_r($categories);
            $arrayTagData =  array();
            if(!empty($categories)) {
	            foreach($categories as $kc => $categorie) {
	                $arrayTagData[$categorie['name']]['tt_id'] = $this->objProcess->TourismDao()->getTagIdByName($categorie['name']);
	                if(empty($arrayTagData[$categorie['name']]['tt_id'])) {
	                    $sql = "INSERT INTO tourism_tag (tt_name) VALUES ('".addslashes($categorie['name'])."')";
	                    $arrayTagData[$categorie['name']]['tt_id'] = $this->objProcess->TourismDao()->insertCountry($sql);
	                }
	                //*echo "tag over:".$arrayTagData[$categorie['name']]['tt_id']."\r\n<br>";
	            }
	            sort($arrayTagData);
            }
            //print_r($arrayTagData);
            //exit();
            $arrayData['t_images'] = json_encode($arrayData['t_images']);
            $tc_name = $v['typeName'];
            $arrayData['tc_id'] = $this->objProcess->TourismDao()->getTCategoryIdByName($tc_name);
            if(empty($arrayData['tc_id'])) {
                $arrayData['tc_id'] = $this->objProcess->TourismDao()->insertTCategory($tc_name);
            }
            //*echo "Category over:".$arrayData['tc_id']."\r\n<br>";
            //
            $arrayLocations = json_decode($v['locations'], true);
            $destinationAliasConfig = DestinationAliasConfig::$destinationAliasConfig;
            $arrayLocations[0]['country'] = isset($destinationAliasConfig[$arrayLocations[0]['country']]) ? $destinationAliasConfig[$arrayLocations[0]['country']] : $arrayLocations[0]['country'];
            $conditions = array('c_name'=>$arrayLocations[0]['country']);
            $arrayResult = $this->objProcess->TourismDao()->getCountryIdByName($conditions);
            $arrayData['c_country_id'] = $arrayResult['c_id'];
            $arrayData['c_continent_id'] = $arrayResult['c_continent_id'];
            //print_r($arrayData);

            if(empty($arrayData['c_country_id'])) {
            	print_r($arrayLocations);
                throw new Exception('c_country_id is null:' . $arrayLocations[0]['country'] . ";uuid:" . $v['uuid']);
            }

            $conditions = array('c_name'=>addslashes($arrayLocations[0]['state']), 'c_country_id'=>$arrayData['c_country_id']);
            $arrayResult = $this->objProcess->TourismDao()->getCountryIdByName($conditions);
            $arrayData['c_state_id'] = $arrayResult['c_id'];
            if(empty($arrayData['c_state_id'])) {
                $sql = 'INSERT INTO country (c_name, c_country_id, c_continent_id, c_type) VALUES(\''.addslashes($arrayLocations[0]['state']).'\',\''
                      .$arrayData['c_country_id'].'\',\''.$arrayData['c_continent_id'].'\',\'State\')';
                $arrayData['c_state_id'] = $this->objProcess->TourismDao()->insertCountry($sql);
                //echo $sql;
            }
            //*echo "c_state_id over:".$arrayData['c_state_id']."\r\n<br>";
            $conditions = array('c_name'=>addslashes($arrayLocations[0]['city']), 'c_country_id'=>$arrayData['c_country_id'], 'c_state_id'=>$arrayData['c_state_id']);
            $arrayResult = $this->objProcess->TourismDao()->getCountryIdByName($conditions);
            //*echo $arrayLocations[0]['city'] . "<br>";
            //*print_r($arrayResult);
            //print_r($v);
            $arrayData['c_city_id'] = $arrayResult['c_id'];
            //*var_dump($arrayData['c_city_id']);
            if(empty($arrayData['c_city_id'])) {
                $sql = 'INSERT INTO country (c_name, c_country_id, c_continent_id, c_state_id, c_type) VALUES(\''.addslashes($arrayLocations[0]['city']).'\','
                      .$arrayData['c_country_id'].','.$arrayData['c_continent_id'].','.$arrayData['c_state_id'].',\'City\')';
                $arrayData['c_city_id'] = $this->objProcess->TourismDao()->insertCountry($sql);
            } elseif(empty($arrayResult['c_state_id'])) {
                $sql = 'UPDATE country SET c_state_id=' .$arrayData['c_state_id'] . ' WHERE c_city_id = ' . $arrayData['c_city_id'];
                $this->objProcess->TourismDao()->insertCountry($sql);
                //*echo "UPDATE over:".$arrayData['c_state_id']."\r\n<br>";
            }
            //*echo "c_city_id over:".$arrayData['c_city_id']."\r\n<br>";
            //exit;
            //
            $arrayData['t_title'] = addslashes($v['title']);
            if (preg_match("/^[\x{4e00}-\x{9fa5}]+$/u", $v['titleTranslated'])) {
                $arrayData['t_title_cn'] = addslashes($v['titleTranslated']);
            } else {
                $arrayData['t_title_cn'] = '';
            }

            $arrayData['t_description'] = addslashes($v['description']);
            if (preg_match("/^[\x{4e00}-\x{9fa5}]+$/u", $v['descriptionTranslated'])) {
                $arrayData['t_description_cn'] = addslashes($v['descriptionTranslated']);
            } else {
                $arrayData['t_description_cn'] = '';
            }

            $arrayData['t_latitude'] = $v['latitude'];
            $arrayData['t_longitude'] = $v['longitude'];
            $arrayData['t_price'] = $v['basePrice'];
            $currency = json_decode($v['currency'], true);
            //print_r($currency);exit;
            $arrayData['t_currency'] = $currency['code'];
            $arrayData['t_review_count'] = $v['reviewCount'];
            $arrayData['t_review_average_score'] = $v['reviewAverageScore'];
            $arrayData['t_supplier'] = 'bemyguest';
            $arrayData['t_supplier_code'] = $v['uuid'];
            $arrayData['t_add_date'] = getDateTime();
            unset($arrayData['c_continent_id']);
            //print_r($arrayData);exit;
            $t_id = $this->objProcess->TourismDao()->insertTourism($arrayData);
            if(empty($t_id)) {
                $t_id = $this->objProcess->TourismDao()->getTourismT_idByCode($v['uuid']);
            }
            if(!empty($arrayTagData)) {
	            foreach($arrayTagData as $tagk => $tagv) {
	                $this->objProcess->TourismDao()->insertTourismTagProduct(array('tt_id'=>$tagv['tt_id'], 't_id'=>$t_id));
	            }
            }
            //echo "over :" . $t_id .  "\r\n<br>";
            ob_flush();
            flush();
            //exit;
            //print_r($arrayData);exit();

        }
        echo "over";
    }

}