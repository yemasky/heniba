<?php

/**
 * Created by PhpStorm.
 * User: YEMASKY
 * Date: 2015/12/6
 * Time: 10:30
 */
namespace merchant;

class CommonService extends \BaseService {

    public static function getLoginUser($objCookie = NULL, $isSession = false) {
        if(!is_object($objCookie) && $isSession == false){
            $objCookie = new \Cookie;
        }
        $loginKey = 'loginuser' . date("z");
        if($isSession == false) {
            $loginuser = $objCookie -> $loginKey;
            if(empty($loginuser)) {//只针对cookie用户 session保存1个月占服务器太长时间
                $loginKey = 'loginuser' . 2592000;//一个月
                $loginuser = $objCookie -> $loginKey;
            }
        } else {
            $objSession = new \Session();
            $loginuser = $objSession -> $loginKey;
        }

        if(!empty($loginuser)) {
            $arrUser = explode("\t", $loginuser);
            $arrUserInfo['mu_id'] = $arrUser[0];
            $arrUserInfo['m_id'] = $arrUser[1];
            $arrUserInfo['mu_login_email'] = $arrUser[2];
            $arrUserInfo['mu_nickname'] = $arrUser[3];
            return $arrUserInfo;
        }
        return NULL;
    }

    public static function checkLoginUser($objCookie = NULL, $isSession = false) {
        if(!is_object($objCookie) && $isSession == false){
            $objCookie = new \Cookie();
        }
        if($isSession == false) {
            $arrUserInfo = self::getLoginUser($objCookie);
        } else {
            $arrUserInfo = self::getLoginUser(NULL, true);
        }
        if(empty($arrUserInfo)) redirect(__WEB . 'index.php?action=login');
        return $arrUserInfo;
    }
    
    public static function setLoginUserCookie($arrayLoginUserInfo, $remember_me = false) {
    	$cookieUser = $arrayLoginUserInfo['mu_id'] . "\t" . $arrayLoginUserInfo['m_id'] . "\t" . $arrayLoginUserInfo['mu_login_email'] . "\t" . $arrayLoginUserInfo['mu_nickname'];
    	$objCookie = new \Cookie();
    	$time = NULL;
    	$key = date("z");
    	if($remember_me) {
    		$time = 2592000;//一个月
    		$key = $time;
    	}
    	$objCookie->setCookie('loginuser' . $key, $cookieUser, $time);
    }
    
    public static function logout() {
    	$objCookie = new \Cookie();
    	$loginKey = 'loginuser' . 2592000;//一个月
    	unset($objCookie->$loginKey);
    	$loginKey = 'loginuser' . date("z");
    	unset($objCookie->$loginKey);
    }

    public static function getMerchantUserAuthorize($mu_id) {
        $objModulesAuthorizeDao = new ModulesAuthorizeDao();
        return $objModulesAuthorizeDao->DBCache(1800)->getMerchantUserAuthorize($mu_id);
    }

    public static function getMerchantMenu($mu_id) {
        $arrayUserModels = NULL;
        $arrayAuthorize = self::getMerchantUserAuthorize($mu_id);
        if(!empty($arrayAuthorize)) {
            $arrayMc_id = array();
            foreach($arrayAuthorize as $k => $v) {
                $arrayMc_id[] = $v['mc_id'];
            }
            $objModulesAuthorizeDao = new ModulesAuthorizeDao();
            $arrayUserModels = $objModulesAuthorizeDao->DBCache(1800)->getMerchantUserModules($arrayMc_id);
        }
        return $arrayUserModels;
    }

}