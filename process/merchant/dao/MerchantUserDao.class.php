<?php

/**
 * Created by PhpStorm.
 * User: YEMASKY
 * Date: 2015/12/6
 * Time: 16:56
 */
class MerchantUserDao
{
    public function getLoginUser($arrayLoginInfo) {
        return DBQuery::instance(__DEFAULT_DSN)->setTable('merchant_user')->getList($arrayLoginInfo, 'mu_id, m_id, mu_nickname');
    }
}