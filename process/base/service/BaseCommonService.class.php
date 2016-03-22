<?php

/**
 * Created by PhpStorm.
 * User: YEMASKY
 * Date: 2015/12/6
 * Time: 10:58
 */
class BaseCommonService extends BaseService{

    public function searchPlace($conditions, $fileid = '') {
        if(empty($fileid)) $fileid = 'c_id, c_city_id, c_name, c_name_cn, c_type';
        return BasePlaceDao::getPlace($conditions, $fileid);
    }

    public function searchPlaceCount($place) {
        $conditions = DbConfig::$db_query_conditions;
        $conditions['where'] = "MATCH c_name  AGAINST ('" . $place . "')";
        return BasePlaceDao::getPlaceCount($conditions);
    }

}
