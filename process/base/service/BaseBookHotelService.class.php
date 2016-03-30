<?php

/**
 * Created by PhpStorm.
 * User: YEMASKY
 * Date: 2016/1/1
 * Time: 18:46
 */
class BaseBookHotelService extends BaseService {
    public function create_book($objRequest, $objResponse) {
        //创建用户
        $arrayUser = BaseBookUserService::instance('BaseBookUserService')->getUserByCard_no($objRequest->id_card_no);
        if(empty($arrayUser)) {
            $arrayUser[0]['u_id'] = BaseBookUserService::instance('BaseBookUserService')->createUser($objRequest);
            $arrayUser[0]['u_email'] = $objRequest->email;
            $arrayUser[0]['u_mobile'] = $objRequest->mobile;
        }
        //取得旅游产品
        $supplier = \Encrypt::instance()->decode($objRequest->supplier);
        if(empty($supplier)) {
            throw new \Exception('supplier is null');
        }

        //登录用户
        $arrLoginUser = \merchant\CommonService::getLoginUser();

        //获取用户递交信息
        $arrayOrderResult = null;
        switch($supplier) {
            case 'tourico':
                $arrayOrderResult = BaseTouricoImpl::instance()->createOrder($objRequest, $arrayUser[0]['u_id'], $arrLoginUser['m_id'], $arrLoginUser['mu_id']);
                break;
            default:
                break;
        }

        return $arrayOrderResult;
    }

}