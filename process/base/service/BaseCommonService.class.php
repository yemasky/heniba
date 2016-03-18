<?php

/**
 * Created by PhpStorm.
 * User: YEMASKY
 * Date: 2015/12/6
 * Time: 10:58
 */
class BaseCommonService extends BaseService{

    public function searchPlace($place, $pn) {
        $conditions = DbConfig::$db_query_conditions;
        $pn = empty($pn) ? 1 : $pn;
        $list_count = 50;
        $conditions = \DbConfig::$db_query_conditions;
        $conditions['limit'] = (($pn - 1) * $list_count) . ", $list_count";
        $conditions['where'] = "c_name_cn like  '%" . $place . "%'";
        $fileid = 'c_id, c_name, c_name_cn, c_type';
        return BasePlaceDao::getPlace($conditions, $fileid);
    }

    public function searchPlaceCount($place) {
        $conditions = DbConfig::$db_query_conditions;
        $conditions['where'] = "MATCH c_name  AGAINST ('" . $place . "')";
        return BasePlaceDao::getPlaceCount($conditions);
    }

}
