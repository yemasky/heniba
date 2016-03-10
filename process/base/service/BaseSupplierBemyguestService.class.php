<?php

/**
 * Created by PhpStorm.
 * User: CooC
 * Date: 2015/12/10
 * Time: 17:20
 */
class BaseSupplierBemyguestService extends BaseService {
    private $time_out = 120;
    private $objWSClient;

    public function __construct(){
        $this->objWSClient = new WebServiceClient();
        $this->objBemyguestConfig = new \supplier\BemyguestConfig();
    }
    /*
     * 创建预订 创建一个新的预订.
     * 新创建的预订状态为 reserved。这意味着它尚未支付也未经合伙人确认但它已创建，并保留在BeMyGuest数据库.
     * 在创建预订后，合作伙伴可以执行两种方案：
     * 可确认预订 - 这意味着合作伙伴已确认收费..或取消
     * 成功请求后 - 新预订的对象状态将返回为waiting.
     * 如果你尝试使用之前相同的partnerReference值来检查新的预订， 你会得到 GEN-FORBIDDEN / 403 / Booking with this partnerReference already exists （此partnerReference的预订已经存在）错误响应信息.
     * 请注意所有的预订请求都需要提供正确的 Content-Type header.
     */
    public function createBooking($arrayUserBookInfo) {
        set_time_limit($this->time_out);
        $arrData['salutation'] = $arrayUserBookInfo['oi_user_salutation'];//"Mr.";
        $arrData['firstName'] = $arrayUserBookInfo['oi_user_firstname'];//'firstName';
        $arrData['lastName'] = $arrayUserBookInfo['oi_user_lastname'];//'lastName';
        $arrData['email'] = $arrayUserBookInfo['oi_user_email'];//'kefu@yelove.cn';
        $arrData['phone'] = $arrayUserBookInfo['oi_user_moblie'];//''+6591591923';
        $arrData['message'] = $arrayUserBookInfo['oi_user_message'];//'message';
        $arrData['productTypeUuid'] = $arrayUserBookInfo['productTypeUuid'];;
        $arrData['pax'] = $arrayUserBookInfo['oi_user_pax'];//'2';
        $arrData['children'] = '0';

        if(!empty($timeSlotUuid)) {
            $arrData['timeSlotUuid'] = $timeSlotUuid;
        } else {
            // $arrData['timeSlotUuid'] = "";
        }
        if(!empty($addonsuuid)) {
            $arrData['addons'][0]['uuid'] = $addonsuuid;
            $arrData['addons'][0]['quantity'] = '1';
        } else {
            // $arrData['addons'] = "";
        }
        $arrData['arrivalDate'] = $arrayUserBookInfo['oi_user_arrival_date'];//'2015-12-07';
        $arrData['partnerReference'] = $arrayUserBookInfo['o_order_number'];
        $arrData['usePromotion'] = false;
        $postData = json_encode($arrData);
        //---------url-----------//
        $bookings_url = $this->objBemyguestConfig->bookings_url;

        //------------------------------//
        $arrayHeader = $this->objBemyguestConfig->arrayHeader;
        $this->objWSClient->post($postData)->header($arrayHeader)->url($bookings_url);
        $arrayResult = $this->objWSClient->execute_cUrl();
        print_r($arrayResult);exit();
        //return $this->parserXml($arrayResult);
        //--------------------------------------//
        // $url = "https://private-anon-de10e2970-bemyguest.apiary-mock.com/v1/bookings";


        $header = "POST: HTTP/1.1\r\n";
        $header .= "X-Authorization: e8a00fcac36a19e53c6dc9b1a87aa2c5051f571f\r\n";
        $header .= "Content-Type: application/json\r\n";
        $header .= "Content-Length: " . strlen($postData) . "\r\n";

        $opts = array (
            'http' => array (
                'method' => "POST",
                'header' => $header,
                'content' => $postData
            )
        );

        $context = stream_context_create($opts);
        $string = file_get_contents($bookings_url, "r", $context);
        print_r($http_response_header);
        var_dump($string);
        print_r($postData);
        $string = json_decode($string, true);
        $createbookuuid = $string['data']['uuid'];
        $param = "productTypeUuid/$productTypeUuid/timeSlotUuid/$timeSlotUuid/addonsuuid/$addonsuuid/partnerReference/" . $arrData['partnerReference'] . "/createbookuuid/" . $createbookuuid;
        $url = __ROOT__ . "/index.php/Viator/BemyguestDemo/checkbooking/" . $param;
        //return array($string, json_encode($http_response_header));
        echo "\r\n<br>click  <a href='$url'>here</a> checkbooking.\r\n<br>";
        //-----------------------//

    }

    /*
     * 查验创建预订可能性的请求
     * 这个请求和正式创建预订的请求是一样的。
     * 在创建预订前，我们建议先运行此请求:
     * 它会先测试预订创建的可能性，而不改写任何BMG的数据库
     * 它将为所选服务提供正确的总金额
     * 如果合作伙伴使用缓存产品的数据库，在创建预订之前，应使用这个请求 - 任何缓存的价格（在合作伙伴方）和当前的价格差异可以被发现
     * 如果合作伙伴发现总金额有差别，那么他就可以在自己的客户端接口采取相应的行动 (例如 - 要求客户接受最终改变价格)
     * 这两者的主要区别是，预约是否在系统中创建和JSON响应对象在某些领域有NULL值。
     * 这两者的主要区别是，预约是否在系统中创建和JSON响应对象在某些领域有NULL值。
     * 如果你尝试使用之前相同的partnerReference值来检查新的预订， 你会得到 GEN-FORBIDDEN / 403 / Booking with this partnerReference already exists （此partnerReference的预订已经存在）错误响应信息
     */
    public function checkBooking() {
        ini_set('memory_limit', '5120M');
        set_time_limit(0);
        $productTypeUuid = '';
        $arrData['salutation'] = "Mr.";
        $arrData['firstName'] = 'firstName';
        $arrData['lastName'] = 'lastName';
        $arrData['email'] = 'kefu@yelove.cn';
        $arrData['phone'] = '+6591591923';
        $arrData['message'] = 'message';
        $arrData['productTypeUuid'] = $productTypeUuid;
        $arrData['pax'] = '2';
        $arrData['children'] = '0';
        if(!empty($timeSlotUuid)) {
            $arrData['timeSlotUuid'] = $timeSlotUuid;
        } else {
            // $arrData['timeSlotUuid'] = "";
        }
        if(!empty($addonsuuid)) {
            $arrData['addons'][0]['uuid'] = $addonsuuid;
            $arrData['addons'][0]['quantity'] = '1';
        } else {
            // $arrData['addons'] = "";
        }
        $arrData['arrivalDate'] = '2015-12-07';
        $arrData['partnerReference'] = time() . "";
        $arrData['usePromotion'] = false;
        $postData = json_encode($arrData);

        // $url = "https://private-anon-de10e2970-bemyguest.apiary-mock.com/v1/bookings/check";
        $url = "https://apidemo.bemyguest.com.sg/v1/bookings/check";
        $header = "POST: HTTP/1.1\r\n";
        $header .= "X-Authorization: e8a00fcac36a19e53c6dc9b1a87aa2c5051f571f\r\n";
        $header .= "Content-Type: application/json\r\n";
        $header .= "Content-Length: " . strlen($postData) . "\r\n";

        echo $arrData['partnerReference'] . ":" . $url . "\r\n";

        $opts = array (
            'http' => array (
                'method' => "POST",
                'header' => $header,
                'content' => $postData
            )
        );

        $context = stream_context_create($opts);
        $string = file_get_contents($url, "r", $context);
        print_r($http_response_header);
        var_dump($string);
        print_r($postData);
        $returnString = json_decode($string, true);

        $uuid = $createbookuuid;
        $param = "uuid/" . $uuid;
        $url = __ROOT__ . "/index.php/Viator/BemyguestDemo/getkbookingstatus/" . $param;

        echo "\r\n<br>click  <a href='$url'>here</a> getkbookingstatus.\r\n<br>";
    }

    /*
     * 获取预订状态
     * 获取预订状态信息
     * reserved - 预订已创建，但未经合伙人证实
     * waiting - 预订已被合作伙伴确认 (例如：合作伙伴已确认收费)
     * approved - 供应商已批准客人预订
     * cancelled - 合作伙伴或BeMyGuest取消预订
     * expired - 供应商或BeMyGuest没有任何行动，预订已过期
     * rejected - 供应商拒绝预订
     */
    public function getBookingStatus($uuid) {
        set_time_limit(0); //
        $string = '';

        // $url = "https://apidemo.bemyguest.com.sg/v1/bookings/uuid";
        $url = "https://apidemo.bemyguest.com.sg/v1/bookings/" . $uuid;
        $header = "GET: HTTP/1.1\r\n";
        $header .= "X-Authorization: e8a00fcac36a19e53c6dc9b1a87aa2c5051f571f\r\n";
        echo $url . "\r\n";
        $opts = array (
            'http' => array (
                'method' => "GET",
                'header' => $header
            )
        );

        $context = stream_context_create($opts);
        $string = file_get_contents($url, 'r', $context);

        $string = json_decode($string, true);
        print_r($string);
        print_r($http_response_header);
        $param = "uuid/" . $uuid . "/status/";
        $url1 = __ROOT__ . "/index.php/Viator/BemyguestDemo/updatekbookingstatus/" . $param . "confirm";
        $url2 = __ROOT__ . "/index.php/Viator/BemyguestDemo/updatekbookingstatus/" . $param . "cancel";
        ;

        echo "\r\n<br>click  <a href='$url1'>confirm the booking</a> \r\n<br>";
        echo "\r\n<br>click  <a href='$url2'>cancel the booking</a> \r\n<br>";
    }

    /*
     * 更新预订状态
     * 更新预订状态信息。 状态 新创建的预订状态为 reserved。此状态尚未在BeMyGuest库存表中的产品数量扣除。 改变预订的状态，从reserved到waiting后, 库存将被锁定。(confirm提交动作)。
     * 在第一次创建预订时，它被标记为reserved。库存没有任何更改。一旦合作伙伴决定确认该预订, 库存状态将从reserved改为waiting状态。
     * 在预订日期后的5天， 所有被标记为waiting的库存状态将被标记为expired
     * 第三个是自选提交动作，你可以利用resend的调用动作。 如果confirmationEmailSentAt的值不是null那么系统将会再次发送确认邮件给合作伙伴。此字段的时间戳值将被更新。
     */
    public function updateBookingStatus($uuid, $status) {
        set_time_limit(0); //
        $string = '';

        // $url = "https://private-anon-de10e2970-bemyguest.apiary-mock.com/v1/bookings/uuid/status";
        $url = "https://apidemo.bemyguest.com.sg/v1/bookings/" . $uuid . "/" . $status;
        $header = "PUT: HTTP/1.1\r\n";
        $header .= "Content-Type: application/json\r\n";
        $header .= "X-Authorization: e8a00fcac36a19e53c6dc9b1a87aa2c5051f571f\r\n";
        echo $url . "\r\n";
        $opts = array (
            'http' => array (
                'method' => "PUT",
                'header' => $header
            )
        );

        $context = stream_context_create($opts);
        $string = file_get_contents($url, 'r', $context);

        var_dump($string);
        print_r($http_response_header);

        /*
         * $string = file_put_contents($url, 'r', $context);
         *
         * $string = json_decode($string, true);
         * var_dump($string);
         * print_r($http_response_header);
         *
         * return $string;
         */
    }
}