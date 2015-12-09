<?php

/**
 * Created by PhpStorm.
 * User: CooC
 * Date: 2015/12/8
 * Time: 14:28
 */
class TourismAction extends BaseAction {
    protected function check($objRequest, $objResponse) {
        $objResponse->arrUserInfo = $this->objProcess->CommonService($this->objProcess)->checkLoginUser();
    }

    protected function service($objRequest, $objResponse) {
        switch($objRequest->getAction()) {
            case 'register':
                $this->admin_register($objRequest, $objResponse);
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
        //赋值
        //设置类别
        $pn = $objRequest->pn;
        $pn = empty($pn) ? 1 : $pn;
        $list_count = $objRequest->list_count;
        $list_count = empty($list_count) ? 20 : $list_count;
        $conditions['order'] = null;
        $conditions['limit'] = ($pn - 1) . ", $list_count";
        $conditions['condition'] = null;
        $objResponse -> setTplValue('tourism', $this->objProcess->TourismDao()->getTourism($conditions));
        $tourismCount = $this->objProcess->TourismDao()->getTourismCount($conditions);
        //
        $objResponse -> nav = 'index';
        $objResponse -> setTplValue('page', page($pn, ceil($tourismCount/$list_count)));
        $objResponse -> setTplValue('pn', $pn);
        $objResponse -> setTplValue('show_pages', 10);
        $objResponse -> setTplValue('merchantMenu', $objResponse->arrMerchantMenu);
        //设置Meta(共通)
        $objResponse -> setTplValue("__Meta", BaseCommon::getMeta('index', '管理后台', '管理后台', '管理后台'));
        $objResponse -> setTplName("merchant/tourism_list");
    }

}