<?php

/**
 * Created by PhpStorm.
 * User: CooC
 * Date: 2015/12/11
 * Time: 18:14
 */
class BaseBemyguestService extends BaseService {
    public function resolveProductTypes($productTypes) {
        $arrayProductTypes = json_decode($productTypes, true);
        return $arrayProductTypes;
    }

    public function resolveProductTypesByUuid($uuid) {
        $conditions = DbConfig::$db_query_conditions;
        $conditions['condition']['uuid'] = $uuid;
        $arrayResult = BaseBemyguestDao::instance()->getBemyguestTour($conditions, 'productTypes');
        if(!empty($productTypes)) {
            return $this->resolveProductTypes($arrayResult[0]['productTypes']);
        }
    }
}