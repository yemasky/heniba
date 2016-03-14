<?php

/**
 * Created by PhpStorm.
 * User: YEMASKY
 * Date: 2015/12/6
 * Time: 10:30
 */
namespace merchant;

class CommonService extends \BaseService {
    private static $arrayMerchantRate = null;

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

    public static function getMerchantRate($m_id) {
        if(!empty(self::$arrayMerchantRate[$m_id])) return self::$arrayMerchantRate[$m_id];
        $conditions = \DbConfig::$db_query_conditions;
        $conditions['where']['m_id'] = $m_id;
        $fileid = 'm_rate_tourism, m_rate_hotel, m_rate_air_ticket, m_rate_tourism_sell, m_rate_hotel_sell, m_rate_air_ticket_sell';
        $objMerchantDao = new MerchantDao();
        $arrarRates = $objMerchantDao->DBCache(0)->getMerchant($conditions, $fileid);
        self::$arrayMerchantRate[$m_id] = $arrarRates[0];
        return self::$arrayMerchantRate[$m_id];
    }

    public static function getMerchantRatePrice($m_id, $price_source, $type) {
        $arrayMerchantRate = self::getMerchantRate($m_id);
        switch ($type) {
            case 'tourism':
                $price['wholesale'] = ceil($price_source * $arrayMerchantRate['m_rate_tourism']);//批发价
                $price['sell'] = ceil($price_source * $arrayMerchantRate['m_rate_tourism_sell']);//售卖价
                break;
            case 'hotel':
                $price['wholesale'] = ceil($price_source * $arrayMerchantRate['m_rate_hotel']);//批发价
                $price['sell'] = ceil($price_source * $arrayMerchantRate['m_rate_hotel_sell']);//售卖价
                break;
            case 'air_ticket':
                $price['wholesale'] = ceil($price_source * $arrayMerchantRate['m_rate_air_ticket']);//批发价
                $price['sell'] = ceil($price_source * $arrayMerchantRate['m_rate_air_ticket_sell']);//售卖价
                break;
        }
        return $price;
    }


}