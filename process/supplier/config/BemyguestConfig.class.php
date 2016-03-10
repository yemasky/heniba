<?php

/**
 * Created by PhpStorm.
 * User: YEMASKY
 * Date: 2015/12/12
 * Time: 1:06
 */
namespace supplier;
class BemyguestConfig {
	/*public $config_url = "https://api.bemyguest.com.sg/v1/config";
	public $bookings_url = "https://api.bemyguest.com.sg/v1/bookings";
	public $allproduct_url = "https://api.bemyguest.com.sg/v1/products?language=en&currency=CNY&per_page=100&page=";
	public $product_url = "https://api.bemyguest.com.sg/v1/products/";
	public $arrayHeader = array (
		'X-Authorization' => '0396f6d91697994390d7f47f0bf41b37cb2f96f0',
		'Content-Type' => 'application/json');*/

	public $config_url = "https://apidemo.bemyguest.com.sg/v1/config";
	public $bookings_url = "https://apidemo.bemyguest.com.sg/v1/bookings";
	public $allproduct_url = "https://apidemo.bemyguest.com.sg/v1/products?language=en&currency=CNY&per_page=100&page=";
	public $product_url = "https://apidemo.bemyguest.com.sg/v1/products/";
	public $arrayHeader = array (
			'X-Authorization' => 'e8a00fcac36a19e53c6dc9b1a87aa2c5051f571f',
			'Content-Type' => 'application/json');
	public $tour_field = array('additionalInfo'=>'产品的附加信息','priceIncludes'=>'价格包含','itinerary'=>'活动行程','warnings'=>'活动警告信息',
			'safety'=>'活动安全管理信息','businessHoursFrom'=>'开始营业时间','businessHoursTo'=>'结束营业时间',
			'meetingTime'=>'集合时间','meetingLocation'=>'集合地点说明','durationDays'=>'持续时间以天数','durationHours'=>'持续时间小时数','durationMinutes'=>'持续时间分钟',
			'daysInAdvance'=>'提前至少多少天完成预订','voucherUse'=>'如何使用优惠券','voucherRedemptionAddress'=>'优惠券兑换网址');
}