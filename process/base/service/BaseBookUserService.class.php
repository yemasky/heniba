<?php

/**
 * Created by PhpStorm.
 * User: YEMASKY
 * Date: 2016/1/1
 * Time: 23:36
 */
class BaseBookUserService extends BaseService {
    public function getUserByCard_no($id_card_no) {
        $conditions = DbConfig::$db_query_conditions;
        $conditions['where'] = array('u_id_card_no'=>$id_card_no);
        return BaseBookUserDao::getUserInfo($conditions);
    }

    public function createUser($objRequest) {
        $id_card_no = $objRequest->id_card_no;
        $IdentityResult = Utilities::checkIdentity($id_card_no);
        if(!$IdentityResult) {
            throw new Exception('身份证验证出错！id_card_no:' . $id_card_no);
        }
        $uuid = uuid();
        $arrayUser['u_id_card_no'] = $id_card_no;
        $arrayUser['u_mobile'] = $objRequest->mobile;
        $arrayUser['u_email'] = $objRequest->email;
        $arrayUser['u_password'] = md5($uuid . md5($arrayUser['u_email'] . substr($arrayUser['u_id_card_no'], 10)));
        $arrayUser['u_uuid'] = $uuid;
        $arrayUser['u_add_date'] = getDateTime();;
        return BaseBookUserDao::createUser($arrayUser);
    }
}