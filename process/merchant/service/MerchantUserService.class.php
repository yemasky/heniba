<?php

/**
 * Created by PhpStorm.
 * User: YEMASKY
 * Date: 2015/12/6
 * Time: 16:56
 */
class MerchantUserService extends BaseService
{
    public function checkLogin($arrayLoginInfo) {
        return $this->objProcess->MerchantUserDao()->getLoginUser($arrayLoginInfo);
    }

    public function setLoginUserCookie($arrayLoginUserInfo, $remember_me = false) {
        $cookieUser = $arrayLoginUserInfo['mu_id'] . "\t" . $arrayLoginUserInfo['m_id'] . "\t" . $arrayLoginUserInfo['mu_login_email'] . "\t" . $arrayLoginUserInfo['mu_nickname'];
        $objCookie = new Cookie();
        $time = NULL;
        $key = date("z");
        if($remember_me) {
            $time = 2592000;//一个月
            $key = $time;
        }
        $objCookie->setCookie('loginuser' . $key, $cookieUser, $time);
    }


}