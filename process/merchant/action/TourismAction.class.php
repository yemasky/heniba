<?php

/**
 * Created by PhpStorm.
 * User: CooC
 * Date: 2015/12/8
 * Time: 14:28
 */
namespace merchant;

class TourismAction extends \BaseAction {
    protected function check($objRequest, $objResponse) {
        $objResponse->arrUserInfo = CommonService::checkLoginUser();
    }

    protected function service($objRequest, $objResponse) {
        switch($objRequest->getAction()) {
            case 'product':
                $this->tour_product($objRequest, $objResponse);
                break;
            default:
                $this->doBase($objRequest, $objResponse);
                break;
        }
    }

    /**
     * 首页显示
     */
    protected function doBase($objRequest, $objResponse) {
        $place = $objRequest->place;
        //
        //设置类别
        $pn = $objRequest->pn;
        $pn = empty($pn) ? 1 : $pn;
        $list_count = $objRequest->list_count;
        $list_count = empty($list_count) ? 20 : $list_count;
        $conditions = \DbConfig::$db_query_conditions;
        $conditions['limit'] = (($pn - 1) * $list_count) . ", $list_count";
        $conditions['where'] = null;
        $page_ext_url = '';
        if(!empty($place)) {
            $conditions['where'] = "t_title_cn like '%$place%'";
            $page_ext_url = '&place=' . $place;
        }
        $objTourismService = new TourismService();
        $tourismCount = $objTourismService->getTourismCount($conditions['where']);
        $arrayTourism = $objTourismService->getTourism($conditions, null, $objResponse->arrUserInfo['m_id']);
        //
        $objResponse -> nav = 'index';
        $objResponse -> setTplValue('tourism', $arrayTourism);
        $objResponse -> setTplValue('page', page($pn, ceil($tourismCount/$list_count)));
        $objResponse -> setTplValue('pn', $pn);
        $objResponse -> setTplValue('page_ext_url', $page_ext_url);
        $objResponse -> setTplValue('model', 'tourism');
        $objResponse -> setTplValue('show_pages', 10);
        $objResponse -> setTplValue('merchantMenu', $objResponse->arrMerchantMenu);
        $objResponse -> setTplValue('place', $place);
        //设置Meta
        $objResponse -> setTplValue("__Meta", \BaseCommon::getMeta('index', '管理后台', '管理后台', '管理后台'));
        $objResponse -> setTplName("merchant/tourism_list");
    }

    protected function tour_product($objRequest, $objResponse) {
        $t_id = $this->check_int($objRequest->id, 'id');
        $conditions = \DbConfig::$db_query_conditions;
        $conditions['where']['t_id'] = $t_id;
        $objTourismService = new TourismService();
        $supplierCode = $objTourismService->getTourism($conditions, 't_supplier, t_supplier_code');
        if(!empty($supplierCode)) {
            \BaseTourismService::instance()->tourismTemplace($supplierCode[0], $objResponse, $objResponse->arrUserInfo['m_id']);
        }

        $conditions = \DbConfig::$db_query_conditions;
        $conditions['where'] = "t_id > ".($t_id - 5)." AND t_id < " . ($t_id + 50) . ' AND t_id != ' . $t_id;
        $conditions['limit'] = "0, 10";
        $relation_tourism = $objTourismService->getTourism($conditions, 't_id, t_title, t_title_cn, t_images');
        $objResponse -> setTplValue('tourism_supplier_tpl', 'tour_' . $supplierCode[0]['t_supplier']);
        $objResponse -> setTplValue('t_id', $t_id);
        $objResponse -> setTplValue('supplierCode', \Encrypt::instance()->encode($t_id));
        $objResponse -> setTplValue('today', substr(getDateTime(), 0, 10));
        $objResponse -> setTplValue('relation_tourism', $relation_tourism);
        $objResponse -> setTplName("merchant/tourism_product");
    }

}