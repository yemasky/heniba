<?php

/**
 * Created by PhpStorm.
 * User: CooC
 * Date: 2015/12/8
 * Time: 17:07
 */
class ModulesAuthorizeDao {
    public function getMerchantUserAuthorize($mu_id) {
        $fileid = 'ma_id, mu_id, mc_id, ma_field_authorize, ma_action_right';
        return DBQuery::instance(__DEFAULT_DSN)->setTable('modules_authorize')->DBCache(1800)->getList(array('mu_id'=>$mu_id), $fileid);
    }

    public function getMerchantUserModules($arrayMc_id) {
        $fileid = 'mc_id, mc_father_id, mc_name, mc_module, mc_module_action, mc_module_action_field, mc_ico, mc_new';
        $conditions = 'mc_id in(' . implode(',', $arrayMc_id) .')';
        return DBQuery::instance(__DEFAULT_DSN)->setTable('modules_config')->DBCache(1800)->getList($conditions, $fileid);
    }
}