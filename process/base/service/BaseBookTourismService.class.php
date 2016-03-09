<?php

/**
 * Created by PhpStorm.
 * User: YEMASKY
 * Date: 2016/1/1
 * Time: 18:46
 */
class BaseBookTourismService extends BaseService {
    public function create_book($objRequest, $objResponse) {
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
        $arrayTourismSupplier = \merchant\TourismService::instance('\merchant\TourismService')->getTourism($conditions, 't_supplier, t_supplier_code');
        //登录用户
        $arrLoginUser = \merchant\CommonService::getLoginUser();


        //获取用户递交信息
        $arrayOrderResult = null;
        switch($arrayTourismSupplier[0]['t_supplier']) {
            case 'bemyguest':
                $arrayOrderResult = BaseBemyguestImpl::instance()->createOrder($objRequest, $arrayUser[0]['u_id'], $arrLoginUser['m_id'], $arrLoginUser['mu_id'], $arrayTourismSupplier[0]);
                break;
            default:
                break;
        }

        return $arrayOrderResult;
    }

}