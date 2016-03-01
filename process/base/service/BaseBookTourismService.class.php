<?php

/**
 * Created by PhpStorm.
 * User: YEMASKY
 * Date: 2016/1/1
 * Time: 18:46
 */
class BaseBookTourismService extends BaseService {
    public function create_book($objRequest, $objResponse) {
        print_r($objRequest);exit();
        //创建用户
        $arrayUser = BaseBookUserService::instance('BaseBookUserService')->getUserByCard_no($objRequest->id_card_no);
        if(empty($arrayUser)) {
            $arrayUser[0]['u_id'] = BaseBookUserService::instance('BaseBookUserService')->createUser($objRequest);
            $arrayUser[0]['u_email'] = $objRequest->email;
            $arrayUser[0]['u_mobile'] = $objRequest->mobile;
        }
        //取得旅游产品
        $supplierCode = \Encrypt::instance()->decode($objRequest->supplierCode);
        if(empty($supplierCode)) {
            throw new \Exception('supplierCode is null');
        }

        $conditions = \DbConfig::$db_query_conditions;
        $conditions['condition'] = array('t_id'=>$supplierCode);
        $arrayTourism = \merchant\TourismService::instance('TourismService')->getTourism($conditions);
        $arrLoginUser = \merchant\CommonService::getLoginUser();
        $conditions = \DbConfig::$db_query_conditions;
        $conditions['condition'] = array('m_id'=>$arrLoginUser['m_id']);
        $arrMerchant = \merchant\MerchantService::instance('TourismService')->getMerchant($conditions);

        //获取用户递交信息
        switch($arrayTourism[0]['t_supplier']) {
            case 'bemyguest':
                $arrayUserBookInfo['arrivalDate'] = $objRequest->arrivalDate;
                $arrayUserBookInfo['options'] = $objRequest->options;
                $arrayUserBookInfo['pax'] = $objRequest->pax;
                $arrayUserBookInfo['salutation'] = $objRequest->salutation;
                $arrayUserBookInfo['lastName_firstName'] = $objRequest->lastName_firstName;
                $arrayUserBookInfo['email'] = $objRequest->email;
                $arrayUserBookInfo['mobile'] = $objRequest->mobile;
                $arrayUserBookInfo['message'] = $objRequest->message;
                break;
            default:
                break;
        }


        if(!empty($arrayUser)) {
            BaseBookOrderService::instance('BaseBookOrderService')->createOrder($objRequest, $arrayUser);
        }
        return $arrayUser;
    }

}