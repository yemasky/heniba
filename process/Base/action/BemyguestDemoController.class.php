<?php
/**
 * Created by PhpStorm.
 * User: CooC
 * Date: 2015/11/12
 * Time: 14:29
 */



class BemyguestDemoController extends Controller
{

    public function configDemo($demo = "")
    {
        set_time_limit(0);
        $DataBemyssguest = null;
        $DataBemyssguest = F('bemyssguest');
        //var_dump($DataBemyssguest);
        if (empty($DataBemyssguest)) {
            $url = 'https://apidemo.bemyguest.com.sg/v1/config';
            $header = "GET: HTTP/1.1\r\n";
            //$header .= "Accept-Encoding: gzip, deflate\r\n";
            //$header .= "Accept-Language: zh-cn\r\n";
            //$header .= "Host: localhost\r\n";
            //$header .= "UA-CPU: x86\r\n";
            //$header .= "User-Agent: Mozilla/4.0 (compatible; MSIE 7.0; Windows NT 5.1)\r\n";
            //$header .= "Connection: Keep-Alive\r\n";
            $header .= "X-Authorization: e8a00fcac36a19e53c6dc9b1a87aa2c5051f571f\r\n";
            //$header .= "X-Authorization: 0396f6d91697994390d7f47f0bf41b37cb2f96f0\r\n";
            //$header .= "Connection: Close\r\n\r\n";
            //$header .= "Authorization: Basic YWRtaW46MTIz\r\n";

            $opts = array(
                'http' => array(
                    'method' => "GET",
                    'header' => $header,
                    //'content'=>$content,
                )
            );

            $context = stream_context_create($opts);
            $DataBemyssguest = file_get_contents($url, 'r', $context);
            //$DataBemyssguest = $arrayBemyssguest['data'];
            F('bemyssguest', $DataBemyssguest);
        }
        if (empty($demo)) {
            print_r(json_decode($DataBemyssguest, true));
        }
        return $DataBemyssguest;

    }

    function productDemo() {
        $DataBemyssguest = $this->configDemo("demo");
        $DataBemyssguest = json_decode($DataBemyssguest, true);
        $DataBemyssguest = $DataBemyssguest['data'];
        //print_r($DataBemyssguest);exit;
        $arrayType = $DataBemyssguest['types']['data'];
        $currency[0] = '3bbb5aa3-af88-5a63-bc98-19525a2df0cf';//Chinese Yuan
        $currency[1] = 'cd15153e-dfd1-5039-8aa3-115bec58e86e';// Singapore Dollars
        $locations = $DataBemyssguest['locations']['data'];
        $page = 1;
        $per_page = 25;
        //$city = '';
        //print_r($locations);
        //echo "betin:\r\n";
        $categories = $DataBemyssguest['categories']['data'];

        foreach ($locations as $k => $v) {
            $continent = $v['continent'];
            //echo "continent:" . $continent . ";\r\n";
            foreach ($v['countries']['data'] as $kk => $vv) {//echo $kk. "\r\n";
                if (!isset($vv['name'])) continue;
                $country = $vv['uuid'];
                $countryName = $vv['name'];
                //echo "country:'" . $vv['name'] . '\' ' . $vv['uuid'] . ";\r\n";
                foreach ($vv['states']['data'] as $kkk => $vvv) {
                    if($kkk > 15) {echo "more...\r\n<br>";exit;}
                    $states = $vvv['uuid'];
                    //echo "states:'" . $vvv['name'] . '\' ' . $vvv['uuid'] . ";\r\n";
                    if (!isset($vvv['cities']['data'])) {
                        $city = $vvv['name'];
                        continue;
                    }
                    foreach ($vvv['cities']['data'] as $kkkk => $vvvv) {
                        if($kkkk > 15) {echo "more...\r\n<br>";exit;}
                        if (isset($vvvv['name'])) {
                            $city = $vvvv['uuid'];
                            $cityName = $vvvv['name'];
                            //echo "city:'" . $vvvv['name'] . '\' ' . $vvvv['uuid'] . ";\r\n";
                        }
                        if (isset($vvvv['data'])) {
                            break;
                            //echo "is have city childen!!!";
                            //print_r($vvvv['data']);
                            continue;
                        }
                        foreach ($categories as $ck => $cv) {
                            if($ck > 15) {echo "more...\r\n<br>";exit;}
                            $category = $cv['uuid'];
                            $categoryName = $cv['name'];
                            if (isset($cv['children'])) {
                                foreach ($cv['children'] as $ckk => $cvv) {
                                    $category = $cvv['uuid'];
                                    //echo "category:'" . $cvv['name'] . '\' ' . $cvv['uuid'] . ";\r\n";
                                    $categoryName2 = $cvv['name'];
                                    foreach ($arrayType as $ak => $av) {
                                        $type = $av['uuid'];
                                        //echo "type: '" . $av['name'] . "' " . $type . " \r\n";
                                        $typeName = $av['name'];
                                        //$dataProducts[0] = $this->bemyssguestProduts($type, $country, $city, $category, $currency[0], $page, $per_page);
                                        $url =  __ROOT__  . "/index.php/Viator/BemyguestDemo/bemyssguestProduts/type/$type/country/$country/city/$city/category/$category/currency/$currency[0]/page/$page/per_page/$per_page";
                                        echo "<a href='$url'>product->$countryName $cityName $categoryName  $categoryName2 : $typeName</a>\r\n<br>";
                                        //$dataProducts[1] = $this->bemyssguestProduts($type, $country, $city, $category, $currency[0], $page, $per_page);
                                    }
                                }
                            } else {
                                //echo "category:'" . $cv['name'] . '\' ' . $cv['uuid'] . ";\r\n";
                                foreach ($arrayType as $ak => $av) {
                                    $type = $av['uuid'];
                                    $typeName = $av['name'];
                                    //echo "type: '" . $av['name'] . "' " . $type . " \r\n";
                                    //$dataProducts[0] = $this->bemyssguestProduts($type, $country, $city, $category, $currency[0], $page, $per_page);
                                    //$dataProducts[1] = $this->bemyssguestProduts($type, $country, $city, $category, $currency[0], $page, $per_page);
                                    $url =  __ROOT__  . "/index.php/Viator/BemyguestDemo/bemyssguestProduts/type/$type/country/$country/city/$city/category/$category/currency/$currency[0]/page/$page/per_page/$per_page";
                                    echo "<a href='$url'>product->$countryName $cityName $categoryName  $categoryName2 : $typeName</a>\r\n<br>";
                                }
                            }

                        }
                    }

                }

            }


        }

    }

    public function bemyssguestProduts($type, $country, $city, $category, $currency, $page, $per_page)
    {
        set_time_limit(0);
        $price_min = '0000000';
        $price_max = '10000000';
        $pax = 2;
        $language = 'd182fbd9-4520-5c66-a513-94fcd3d46d9b'; //chinese_simplified ZH-HANS
        $date_start = '2015-11-17';
        $date_end = '2015-12-16';
        $query = '';
        $sort = '';
        $published = 'true';
        $url = "https://apidemo.bemyguest.com.sg/v1/products?type=$type&country=$country&city=$city&price_min=$price_min&price_max=$price_max&category=$category"
            . "&pax=$pax&currency=$currency&language=$language&date_start=$date_start&date_end=$date_end&query=$query&duration_days_min=1&duration_days_max=12"
            . "&sort=$sort&page=$page&per_page=$per_page&published=$published&deleted=deleted";//&latitude=&longitude=&distance=
        $header = "GET: HTTP/1.1\r\n";
        $header .= "X-Authorization: e8a00fcac36a19e53c6dc9b1a87aa2c5051f571f\r\n";
        echo $url . "\r\n";
        $opts = array(
            'http' => array(
                'method' => "GET",
                'header' => $header,
            )
        );

        $context = stream_context_create($opts);
        $string = file_get_contents($url, 'r', $context);

        dump($string);
        exit;

    }

    public function bemyssguestAllproduct($pn = 1)
    {
        ini_set('memory_limit', '5120M');
        set_time_limit(0);
        $string = '';
        $string = F('bemyssguestTest' . $pn);
        if (empty($string)) {
            $url = "https://apidemo.bemyguest.com.sg/v1/products?currency=3bbb5aa3-af88-5a63-bc98-19525a2df0cf&page=" . $pn;
            $header = "GET: HTTP/1.1\r\n";
            $header .= "X-Authorization: e8a00fcac36a19e53c6dc9b1a87aa2c5051f571f\r\n";
            echo $url . "\r\n";
            $opts = array(
                'http' => array(
                    'method' => "GET",
                    'header' => $header,
                )
            );

            $context = stream_context_create($opts);
            $string = file_get_contents($url, 'r', $context);
            if (!empty($string)) {
                F('bemyssguestTest' . $pn, $string);
            }
        }
        if (!empty($string)) {
            $string = json_decode($string, true);
            //$meta = $string['meta']['pagination'];
            //print_r($meta);
            /*for ($i = $pn; $i <= $meta['total_pages']; $i++) {
                if ($i > $meta['total_pages']) {
                    echo "over bemyssguestTest";
                    return;
                } else {
                    //$this->bemyssguestTestDiao($i);
                }
            }*/
            foreach($string['data'] as $k => $v) {
                $url =  __ROOT__  . "/index.php/Viator/BemyguestDemo/bemyssguestproduct/uuid/".$v['uuid'];
                $img = "<img src='https://bemyguestdev.s3.amazonaws.com".$v['photos'][0]['paths']['75x50']."'>";
                echo "<a href='$url'>".$v['title']."</a>\r\n<br>";
            }
        } else {
            echo "\r\n<br>is page over!";
        }

        $pre_page = ($pn - 1) > 0 ? $pn - 1 : 1;
        $next_page = $pn + 1;
        $url1 =  __ROOT__  . "/index.php/Viator/BemyguestDemo/bemyssguestAllproduct/pn/" . $pre_page;
        $url2 =  __ROOT__  . "/index.php/Viator/BemyguestDemo/bemyssguestAllproduct/pn/" . $next_page;
        echo "\r\n<br>(All product)<a href='$url1'> << pre page </a> <font color='#a52a2a'>$pn</font> <a href='$url2'> >>next page</a>\r\n<br>";
        //exit;
    }

    public function bemyssguestTestDiao($pn = 1)
    {
        ini_set('memory_limit', '5120M');
        set_time_limit(0);
        $string = '';
        $string = F('bemyssguestTest' . $pn);
        if (empty($string)) {
            $url = "https://apidemo.bemyguest.com.sg/v1/products?currency=3bbb5aa3-af88-5a63-bc98-19525a2df0cf&page=" . $pn;
            $header = "GET: HTTP/1.1\r\n";
            $header .= "X-Authorization: e8a00fcac36a19e53c6dc9b1a87aa2c5051f571f\r\n";
            echo $url . "\r\n";
            $opts = array(
                'http' => array(
                    'method' => "GET",
                    'header' => $header,
                )
            );

            $context = stream_context_create($opts);
            $string = file_get_contents($url, 'r', $context);
            if (!empty($string)) {
                F('bemyssguestTest' . $pn, $string);
            }
        }
        if (!empty($string)) {
        } else {
            print_r($string);
        }
    }

    public function bemyssguestproduct($uuid)
    {
        set_time_limit(0);//
        $string = '';
        $string = F('bemyssguestproduct' . $uuid);
        if (empty($string)) {
            $url = "https://apidemo.bemyguest.com.sg/v1/products/$uuid/?currency=3bbb5aa3-af88-5a63-bc98-19525a2df0cf&language=ZH-HANS";
            $header = "GET: HTTP/1.1\r\n";
            $header .= "X-Authorization: e8a00fcac36a19e53c6dc9b1a87aa2c5051f571f\r\n";
            //echo $url . "\r\n";
            $opts = array(
                'http' => array(
                    'method' => "GET",
                    'header' => $header,
                )
            );

            $context = stream_context_create($opts);
            $string = file_get_contents($url, 'r', $context);
            if (!empty($string)) {
                F('bemyssguestproduct' . $uuid, $string);
            }
        }
        $string = json_decode($string, true);
        //$this->checksaveProduct($string['data']);
        $arrData['salutation'] = "Mr.";
        $arrData['firstName'] = 'firstName';
        $arrData['lastName'] = 'lastName';
        $arrData['email'] = 'kefu@yelove.cn';
        $arrData['phone'] = '+6591591923';
        $arrData['message'] = 'message';
        $arrData['pax'] = '2';
        $arrData['children'] = '0';
        $arrData['addons'][0]['quantity'] = '1';
        $arrData['arrivalDate'] = '2015-12-07';
        $arrData['usePromotion'] = "false";
        $arrData['partnerReference'] = 'REF-001';

        $addonsuuid = isset($string['data']['addons']) ? $string['data']['uuid'] : 0;
        $timeSlotsUuid = isset($string['data']['productTypes'][0]['timeSlots'][0]['uuid']) ? $string['data']['productTypes'][0]['timeSlots'][0]['uuid'] : 0;
        $param = 'productTypeUuid/'.$string['data']['productTypes'][0]['uuid'].'/timeSlotUuid/'. $timeSlotsUuid . '/addonsuuid/' . $addonsuuid;

        $url =  __ROOT__  . "/index.php/Viator/BemyguestDemo/createbooking/".$param;
        echo "<a href='$url'>createbooking this product: " .$string['data']['title']."</a>\r\n<br>";
        header("");
        echo "booking info:";
        print_r($arrData);
        print_r($string);
        return $string;
    }

    public function checksaveProduct($arrData)
    {
        ini_set('memory_limit', '5120M');
        set_time_limit(0);
        $ViatorModel = D('bemyssguest');

        if (!empty($arrData)) {
            foreach ($arrData as $k => $v) {
                if (is_array($v)) {
                    $arrData[$k] = json_encode($v);
                }
            }
            $is_data = $ViatorModel->field('id')->where("uuid='" . $arrData['uuid'] . "'")->select();
            if (!empty($is_data) && isset($is_data[0]['id'])) {
                echo "continue :" . $arrData['uuid'] . ', id:' . $is_data[0]['id'] . "\r\n";
            } else {
                $ViatorModel->add($arrData);
                $id = $ViatorModel->getLastInsID();
                echo "\r\n add code :" . $arrData['uuid'] . ', id:' . $id . "\r\n";
            }

        }
        echo "over !";
    }

    public function createbooking($productTypeUuid, $timeSlotUuid, $addonsuuid)
    {
        ini_set('memory_limit', '5120M');
        set_time_limit(0);

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
            //$arrData['timeSlotUuid'] = "";
        }
        if(!empty($addonsuuid)) {
            $arrData['addons'][0]['uuid'] = $addonsuuid;
            $arrData['addons'][0]['quantity'] = '1';
        } else {
            //$arrData['addons'] = "";
        }
        $arrData['arrivalDate'] = '2015-12-07';
        $arrData['partnerReference'] = time() . "";
        $arrData['usePromotion'] = false;
        $postData = json_encode($arrData);

        //$url = "https://private-anon-de10e2970-bemyguest.apiary-mock.com/v1/bookings";
        $url = "https://apidemo.bemyguest.com.sg/v1/bookings";

        $header = "POST: HTTP/1.1\r\n";
        $header .= "X-Authorization: e8a00fcac36a19e53c6dc9b1a87aa2c5051f571f\r\n";
        $header .= "Content-Type: application/json\r\n";
        $header .= "Content-Length: ".strlen($postData)."\r\n";

        echo $arrData['partnerReference'] . ":" . $url . "\r\n";

        $opts = array(
            'http' => array(
                'method' => "POST",
                'header' => $header,
                'content' => $postData,
            )
        );

        $context = stream_context_create($opts);
        $string = file_get_contents($url, "r", $context);
        print_r($http_response_header);
        var_dump($string);
        print_r($postData);
        $string = json_decode($string, true);
        $createbookuuid = $string['data']['uuid'];
        $param = "productTypeUuid/$productTypeUuid/timeSlotUuid/$timeSlotUuid/addonsuuid/$addonsuuid/partnerReference/" . $arrData['partnerReference'] . "/createbookuuid/" . $createbookuuid;
        $url =  __ROOT__  . "/index.php/Viator/BemyguestDemo/checkbooking/".$param;

        echo "\r\n<br>click  <a href='$url'>here</a> checkbooking.\r\n<br>";


    }

    public function checkbooking($productTypeUuid, $timeSlotUuid, $addonsuuid, $partnerReference, $createbookuuid)
    {
        ini_set('memory_limit', '5120M');
        set_time_limit(0);

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
            //$arrData['timeSlotUuid'] = "";
        }
        if(!empty($addonsuuid)) {
            $arrData['addons'][0]['uuid'] = $addonsuuid;
            $arrData['addons'][0]['quantity'] = '1';
        } else {
            //$arrData['addons'] = "";
        }
        $arrData['arrivalDate'] = '2015-12-07';
        $arrData['partnerReference'] = time() . "";
        $arrData['usePromotion'] = false;
        $postData = json_encode($arrData);

        //$url = "https://private-anon-de10e2970-bemyguest.apiary-mock.com/v1/bookings/check";
        $url = "https://apidemo.bemyguest.com.sg/v1/bookings/check";
        $header = "POST: HTTP/1.1\r\n";
        $header .= "X-Authorization: e8a00fcac36a19e53c6dc9b1a87aa2c5051f571f\r\n";
        $header .= "Content-Type: application/json\r\n";
        $header .= "Content-Length: ".strlen($postData)."\r\n";

        echo $arrData['partnerReference'] . ":" . $url . "\r\n";

        $opts = array(
            'http' => array(
                'method' => "POST",
                'header' => $header,
                'content' => $postData,
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
        $url =  __ROOT__  . "/index.php/Viator/BemyguestDemo/getkbookingstatus/".$param;

        echo "\r\n<br>click  <a href='$url'>here</a> getkbookingstatus.\r\n<br>";

    }

    public function getkbookingstatus($uuid)
    {
        set_time_limit(0);//
        $string = '';

        //$url = "https://apidemo.bemyguest.com.sg/v1/bookings/uuid";
        $url = "https://apidemo.bemyguest.com.sg/v1/bookings/" . $uuid;
        $header = "GET: HTTP/1.1\r\n";
        $header .= "X-Authorization: e8a00fcac36a19e53c6dc9b1a87aa2c5051f571f\r\n";
        echo $url . "\r\n";
        $opts = array(
            'http' => array(
                'method' => "GET",
                'header' => $header,
            )
        );

        $context = stream_context_create($opts);
        $string = file_get_contents($url, 'r', $context);


        $string = json_decode($string, true);
        print_r($string);
        print_r($http_response_header);
        $param = "uuid/" . $uuid . "/status/";
        $url1 =  __ROOT__  . "/index.php/Viator/BemyguestDemo/updatekbookingstatus/".$param . "confirm";
        $url2 =  __ROOT__  . "/index.php/Viator/BemyguestDemo/updatekbookingstatus/".$param . "cancel";;

        echo "\r\n<br>click  <a href='$url1'>confirm the booking</a> \r\n<br>";
        echo "\r\n<br>click  <a href='$url2'>cancel the booking</a> \r\n<br>";
    }

    public function updatekbookingstatus($uuid, $status)
    {
        set_time_limit(0);//
        $string = '';

        //$url = "https://private-anon-de10e2970-bemyguest.apiary-mock.com/v1/bookings/uuid/status";
        $url = "https://apidemo.bemyguest.com.sg/v1/bookings/".$uuid."/".$status;
        $header = "PUT: HTTP/1.1\r\n";
        $header .= "Content-Type: application/json\r\n";
        $header .= "X-Authorization: e8a00fcac36a19e53c6dc9b1a87aa2c5051f571f\r\n";
        echo $url . "\r\n";
        $opts = array(
            'http' => array(
                'method' => "PUT",
                'header' => $header,
            )
        );

        $context = stream_context_create($opts);
        $string = file_get_contents($url, 'r', $context);

        var_dump($string);
        print_r($http_response_header);


        /*$string = file_put_contents($url, 'r', $context);

        $string = json_decode($string, true);
        var_dump($string);
        print_r($http_response_header);

        return $string;*/

    }


}

