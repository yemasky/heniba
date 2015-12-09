<?php

/**
 * Created by PhpStorm.
 * User: CooC
 * Date: 2015/12/9
 * Time: 14:33
 */
class TourismDao extends BaseDao {
    public function getTourism($conditions) {
        $fileid = 't_id, tc_id, c_country_id, c_state_id, c_city_id, t_title, t_title_cn, t_description, '
                 .'t_description_cn, t_images, t_latitude, t_longitude, t_currency, t_price, t_review_count, '
                 .'t_review_average_score, t_supplier, t_supplier_code';
        return DBQuery::instance(DbConfig::tourism_dsn_read)->setTable('tourism')->setKey('t_id')->order($conditions['order'])->limit($conditions['limit'])->DBCache(1800)->getList($conditions['condition'], $fileid);
    }

    public function getTourismCount($conditions) {
        $fileid = 'COUNT(t_id)';
        return DBQuery::instance(DbConfig::tourism_dsn_read)->setTable('tourism')->DBCache(1800)->getOne($conditions['condition'], $fileid);
    }

}