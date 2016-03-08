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
        //取得经销商及经销商的唯一编号
        $arrayTourism = \merchant\TourismService::instance('TourismService')->getTourism($conditions, 't_supplier, t_supplier_code');
        //登录用户
        $arrLoginUser = \merchant\CommonService::getLoginUser();
        $conditions = \DbConfig::$db_query_conditions;
        $conditions['condition'] = array('m_id'=>$arrLoginUser['m_id']);
        $arrMerchant = \merchant\MerchantService::instance('TourismService')->getMerchant($conditions);
        //计算支付价格
        $payPrice = $arrayTourism[0][''];

        //插入order表
        $arrayOrder['u_id'] = $arrayUser[0]['u_id'];
        $arrayOrder['m_id'] = $arrLoginUser['m_id'];
        $arrayOrder['mu_id'] = $arrLoginUser['mu_id'];
        $arrayOrder['o_price_market'] = $arrayUser[0]['u_id'];
        $arrayOrder['o_price_sell'] = $arrayUser[0]['u_id'];
        $arrayOrder['o_add_date'] = getDateTime();
        //$o_id = BaseBookUserService::instance('BaseBookUserService')->createUser($objRequest);
        //产生订单号
        $o_order_number = order_number($o_id);
        //$o_id = BaseBookUserService::instance('BaseBookUserService')->createUser($objRequest);

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