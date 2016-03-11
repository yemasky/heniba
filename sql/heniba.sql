/*
SQLyog Ultimate v11.27 (32 bit)
MySQL - 10.1.9-MariaDB : Database - heniba
*********************************************************************
*/

/*!40101 SET NAMES utf8 */;

/*!40101 SET SQL_MODE=''*/;

/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;
CREATE DATABASE /*!32312 IF NOT EXISTS*/`heniba` /*!40100 DEFAULT CHARACTER SET utf8 */;

USE `heniba`;

/*Table structure for table `country` */

DROP TABLE IF EXISTS `country`;

CREATE TABLE `country` (
  `c_id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'id',
  `c_continent_id` int(11) DEFAULT NULL COMMENT '洲',
  `c_country_id` int(11) DEFAULT NULL COMMENT '国家、地区',
  `c_region_id` int(11) DEFAULT NULL COMMENT '大区域',
  `c_state_id` int(11) DEFAULT NULL COMMENT '州、省',
  `c_city_id` int(11) DEFAULT NULL COMMENT '市、直辖市',
  `c_county_id` int(11) DEFAULT NULL COMMENT '县、郡；直辖市的区',
  `c_towns_id` int(11) DEFAULT NULL COMMENT '村庄',
  `c_name` varchar(100) DEFAULT NULL COMMENT '名称',
  `c_name_cn` varchar(100) DEFAULT NULL,
  `c_latitude` varchar(50) DEFAULT NULL COMMENT '纬度',
  `c_longitude` varchar(50) DEFAULT NULL COMMENT '经度',
  `c_type` enum('Continent','Country','State','City','CityLocation','Towns','Region') DEFAULT NULL COMMENT '类型',
  PRIMARY KEY (`c_id`),
  UNIQUE KEY `country` (`c_continent_id`,`c_country_id`,`c_state_id`,`c_city_id`,`c_name`,`c_type`)
) ENGINE=MyISAM AUTO_INCREMENT=5472 DEFAULT CHARSET=utf8;

/*Table structure for table `hotel` */

DROP TABLE IF EXISTS `hotel`;

CREATE TABLE `hotel` (
  `h_id` bigint(18) NOT NULL AUTO_INCREMENT,
  `hb_id` int(11) DEFAULT NULL,
  `c_country_id` int(11) DEFAULT NULL,
  `c_state_id` int(11) DEFAULT NULL,
  `c_city_id` int(11) DEFAULT NULL,
  `c_county_id` int(11) DEFAULT NULL COMMENT '市的区 或县',
  `h_name` varchar(100) NOT NULL COMMENT '酒店名称',
  `h_rooms` tinyint(5) DEFAULT NULL COMMENT '房间数',
  `h_check_in` datetime NOT NULL,
  `h_check_out` datetime DEFAULT NULL,
  `h_currency` varchar(10) DEFAULT NULL,
  `h_price` float DEFAULT NULL,
  `h_images` text,
  `h_phone` varchar(100) DEFAULT NULL,
  `h_fax` varchar(100) DEFAULT NULL,
  `h_address` varchar(255) DEFAULT NULL,
  `h_zip` varchar(10) DEFAULT NULL,
  `h_start_level` tinyint(4) DEFAULT NULL COMMENT '星级',
  `h_rank` float DEFAULT NULL COMMENT '评分 排名 等级',
  `h_latitude` float DEFAULT NULL COMMENT '纬度',
  `h_longitude` float DEFAULT NULL COMMENT '经度',
  `h_description` text,
  `h_description_cn` text,
  `h_home` enum('0','1') DEFAULT NULL,
  `h_supplier` varchar(50) DEFAULT NULL,
  `h_supplier_code` varchar(100) DEFAULT NULL,
  `h_attr1` int(11) DEFAULT NULL,
  `h_attr1_value` varchar(100) DEFAULT NULL,
  `h_attr2` int(11) DEFAULT NULL,
  `h_attr2_value` varchar(100) DEFAULT NULL,
  `h_attr3` int(11) DEFAULT NULL,
  `h_attr3_value` varchar(100) DEFAULT NULL,
  `h_attr4` int(11) DEFAULT NULL,
  `h_attr4_value` varchar(100) DEFAULT NULL,
  `h_attr5` int(11) DEFAULT NULL,
  `h_attr5_value` varchar(100) DEFAULT NULL,
  `h_attr6` int(11) DEFAULT NULL,
  `h_attr6_value` varchar(100) DEFAULT NULL,
  `h_attr7` int(11) DEFAULT NULL,
  `h_attr7_value` varchar(100) DEFAULT NULL,
  `h_attr8` int(11) DEFAULT NULL,
  `h_attr8_value` varchar(100) DEFAULT NULL,
  `h_attr9` int(11) DEFAULT NULL,
  `h_attr9_value` varchar(100) DEFAULT NULL,
  `h_attr10` int(11) DEFAULT NULL,
  `h_attr10_value` varchar(100) DEFAULT NULL,
  `h_attr11` int(11) DEFAULT NULL,
  `h_attr11_value` varchar(100) DEFAULT NULL,
  `h_attr12` int(11) DEFAULT NULL,
  `h_attr12_value` varchar(100) DEFAULT NULL,
  `h_attr13` int(11) DEFAULT NULL,
  `h_attr13_value` varchar(100) DEFAULT NULL,
  `h_attr14` int(11) DEFAULT NULL,
  `h_attr14_value` varchar(100) DEFAULT NULL,
  `h_attr15` int(11) DEFAULT NULL,
  `h_attr15_value` varchar(100) DEFAULT NULL,
  `h_is_valid` enum('0','1') DEFAULT NULL COMMENT '是否有效',
  `h_add_date` datetime NOT NULL,
  `h_update_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`h_id`,`h_check_in`),
  FULLTEXT KEY `hotel` (`h_name`,`h_attr1_value`,`h_attr2_value`,`h_attr3_value`,`h_attr4_value`,`h_attr5_value`,`h_attr6_value`,`h_attr7_value`,`h_attr8_value`,`h_attr9_value`,`h_attr10_value`,`h_attr11_value`,`h_attr12_value`,`h_attr13_value`,`h_attr14_value`,`h_attr15_value`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

/*Table structure for table `hotel_attribute` */

DROP TABLE IF EXISTS `hotel_attribute`;

CREATE TABLE `hotel_attribute` (
  `ha_id` int(11) NOT NULL AUTO_INCREMENT COMMENT '属性ID',
  `hc_id` int(11) NOT NULL DEFAULT '0' COMMENT '类别ID',
  `ha_name` varchar(50) NOT NULL COMMENT '属性名称',
  `ha_name_cn` varchar(50) DEFAULT NULL COMMENT '属性名称',
  `ha_main_attr` enum('0','1') NOT NULL DEFAULT '0' COMMENT '是否主类',
  `ha_isfilter` enum('0','1') NOT NULL DEFAULT '0' COMMENT '是否筛选',
  `ha_order` int(11) DEFAULT NULL COMMENT '排序',
  PRIMARY KEY (`ha_id`),
  UNIQUE KEY `ta_name` (`hc_id`,`ha_name`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

/*Table structure for table `hotel_attribute_value` */

DROP TABLE IF EXISTS `hotel_attribute_value`;

CREATE TABLE `hotel_attribute_value` (
  `hc_id` int(11) DEFAULT NULL COMMENT '类别ID',
  `h_id` int(11) NOT NULL COMMENT '酒店ID',
  `ha_id` int(11) DEFAULT NULL COMMENT '属性ID',
  `hav_value` varchar(100) DEFAULT NULL COMMENT '属性值',
  `hav_value_cn` varchar(100) DEFAULT NULL,
  UNIQUE KEY `pid` (`h_id`,`ha_id`),
  KEY `atrid` (`ha_id`),
  KEY `hav_value` (`hav_value`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

/*Table structure for table `hotel_brand` */

DROP TABLE IF EXISTS `hotel_brand`;

CREATE TABLE `hotel_brand` (
  `hb_id` int(11) NOT NULL AUTO_INCREMENT,
  `hb_name` varchar(100) DEFAULT NULL COMMENT '品牌名称',
  `hb_name_cn` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`hb_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

/*Table structure for table `hotel_category` */

DROP TABLE IF EXISTS `hotel_category`;

CREATE TABLE `hotel_category` (
  `hc_id` bigint(19) NOT NULL AUTO_INCREMENT COMMENT '类别ID',
  `hc_parent_id` bigint(19) NOT NULL DEFAULT '0' COMMENT '父类ID',
  `hc_name` varchar(100) DEFAULT NULL COMMENT '名称',
  `hc_name_cn` varchar(100) DEFAULT NULL COMMENT '中文名称',
  PRIMARY KEY (`hc_id`),
  UNIQUE KEY `tc_name` (`hc_name`)
) ENGINE=MyISAM AUTO_INCREMENT=14 DEFAULT CHARSET=utf8;

/*Table structure for table `hotel_review` */

DROP TABLE IF EXISTS `hotel_review`;

CREATE TABLE `hotel_review` (
  `hr_id` bigint(19) NOT NULL AUTO_INCREMENT,
  `h_id` bigint(19) NOT NULL,
  `u_id` varchar(11) NOT NULL COMMENT '用户ID',
  `hr_title` varchar(250) DEFAULT NULL,
  `hr_good` varchar(250) DEFAULT NULL,
  `hr_bad` varchar(250) DEFAULT NULL,
  `hr_contents` varchar(500) DEFAULT NULL,
  `hr_is_help` int(11) DEFAULT '0' COMMENT '有帮助',
  `hr_no_help` int(11) DEFAULT '0' COMMENT '无帮助',
  `hr_point` int(11) DEFAULT '0' COMMENT '评分',
  `b_billno` bigint(19) DEFAULT NULL,
  `hr_ip` varchar(250) DEFAULT NULL,
  `hr_show` enum('0','1') NOT NULL DEFAULT '0',
  `hr_add_date` datetime DEFAULT NULL,
  `hr_is_valid` enum('0','1') DEFAULT NULL,
  `hr_delete_date` datetime DEFAULT NULL COMMENT '删除时间',
  PRIMARY KEY (`hr_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

/*Table structure for table `hotel_tag` */

DROP TABLE IF EXISTS `hotel_tag`;

CREATE TABLE `hotel_tag` (
  `tt_id` int(11) NOT NULL AUTO_INCREMENT,
  `tt_name` varchar(100) DEFAULT NULL COMMENT '标签名',
  PRIMARY KEY (`tt_id`),
  UNIQUE KEY `tt_name` (`tt_name`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

/*Table structure for table `hotel_tag_product` */

DROP TABLE IF EXISTS `hotel_tag_product`;

CREATE TABLE `hotel_tag_product` (
  `t_id` bigint(19) NOT NULL,
  `tt_id` int(11) NOT NULL,
  UNIQUE KEY `t_t_product` (`t_id`,`tt_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

/*Table structure for table `order` */

DROP TABLE IF EXISTS `order`;

CREATE TABLE `order` (
  `o_id` bigint(19) NOT NULL AUTO_INCREMENT,
  `u_id` bigint(19) NOT NULL COMMENT '订单用户ID',
  `m_id` int(11) NOT NULL DEFAULT '0' COMMENT '下单的企业',
  `mu_id` int(11) NOT NULL DEFAULT '0' COMMENT '下单的企业的用户',
  `o_order_number` bigint(19) DEFAULT NULL COMMENT '订单号',
  `o_price_market` float DEFAULT NULL COMMENT '网站上售卖的价格',
  `o_price_sell` float DEFAULT NULL COMMENT '售卖价格，用户实际支付价格',
  `o_price_wholesale` float DEFAULT NULL COMMENT '批发价',
  `o_price_original` float DEFAULT NULL COMMENT '进货价',
  `o_pay` enum('0','1') NOT NULL DEFAULT '0' COMMENT '0 未支付 1已支付',
  `o_add_date` datetime DEFAULT NULL COMMENT '订单产生时间',
  `o_update_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP COMMENT '订单修改时间',
  PRIMARY KEY (`o_id`)
) ENGINE=MyISAM AUTO_INCREMENT=8 DEFAULT CHARSET=utf8;

/*Table structure for table `order_info` */

DROP TABLE IF EXISTS `order_info`;

CREATE TABLE `order_info` (
  `oi_id` bigint(19) NOT NULL AUTO_INCREMENT,
  `o_id` bigint(19) DEFAULT NULL COMMENT '订单号',
  `u_id` bigint(19) DEFAULT NULL,
  `m_id` int(11) DEFAULT NULL COMMENT '下单的企业',
  `mu_id` int(11) DEFAULT NULL COMMENT '下单的企业的用户',
  `oi_price_market` float DEFAULT NULL COMMENT '网站上售卖的价格',
  `oi_price_sell` float DEFAULT NULL COMMENT '售卖价格，用户实际支付价格',
  `oi_price_wholesale` float DEFAULT NULL COMMENT '批发价',
  `oi_price_original` float DEFAULT NULL COMMENT '进货价',
  `oi_pay` enum('0','1') NOT NULL DEFAULT '0' COMMENT '0 未支付 1已支付',
  `oi_type` enum('tourism','hotel','air_ticket') DEFAULT NULL COMMENT '旅游 机票 酒店',
  `oi_product_id` bigint(19) DEFAULT NULL COMMENT '提供的商品ID',
  `oi_status` enum('确认中','已确认','已完成','已退款','申请退款') DEFAULT NULL COMMENT '订单状态',
  `oi_user_moblie` int(11) DEFAULT NULL COMMENT '用户手机',
  `oi_user_email` varchar(50) DEFAULT NULL COMMENT '用户email',
  `oi_user_salutation` enum('Mr.','Ms.','Mrs.') DEFAULT NULL COMMENT '用户称呼',
  `oi_user_arrival_date` datetime NOT NULL COMMENT '到达时间',
  `oi_user_message` varchar(200) DEFAULT NULL COMMENT '用户刘阳',
  `oi_user_options` varchar(10) DEFAULT NULL,
  `oi_user_pax` varchar(5) DEFAULT NULL COMMENT '人数',
  `oi_user_firstname` varchar(50) DEFAULT NULL,
  `oi_user_lastname` varchar(50) DEFAULT NULL,
  `oi_book_status` enum('0','1','2') DEFAULT NULL COMMENT '预定成功1 失败2',
  `oi_update_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP COMMENT '订单修改时间',
  `oi_add_date` datetime DEFAULT NULL COMMENT '订单产生时间',
  PRIMARY KEY (`oi_id`)
) ENGINE=MyISAM AUTO_INCREMENT=8 DEFAULT CHARSET=utf8;

/*Table structure for table `order_return_log` */

DROP TABLE IF EXISTS `order_return_log`;

CREATE TABLE `order_return_log` (
  `oil_id` bigint(19) NOT NULL AUTO_INCREMENT,
  `oi_id` bigint(19) DEFAULT NULL COMMENT '订单详细编号',
  `o_id` bigint(19) DEFAULT NULL COMMENT '订单编号',
  `title` varchar(200) DEFAULT NULL,
  `centents` text,
  `http_response_header` text,
  `add_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`oil_id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

/*Table structure for table `tourism` */

DROP TABLE IF EXISTS `tourism`;

CREATE TABLE `tourism` (
  `t_id` bigint(19) NOT NULL AUTO_INCREMENT COMMENT 'id',
  `tc_id` int(11) DEFAULT NULL COMMENT '类别id',
  `c_country_id` int(11) DEFAULT NULL COMMENT '国家',
  `c_state_id` int(11) DEFAULT NULL COMMENT '州省',
  `c_city_id` int(11) DEFAULT NULL COMMENT '城市',
  `c_county_id` int(11) DEFAULT NULL COMMENT '县、郡；直辖市的区',
  `t_title` varchar(200) NOT NULL COMMENT '标题',
  `t_title_cn` varchar(200) DEFAULT NULL COMMENT '中文标题',
  `t_description` text COMMENT '短描述',
  `t_description_cn` text COMMENT '短中文描述',
  `t_images` text COMMENT '图片数组',
  `t_latitude` varchar(100) DEFAULT NULL COMMENT '纬度',
  `t_longitude` varchar(100) DEFAULT NULL COMMENT '经度',
  `t_currency` varchar(50) DEFAULT NULL COMMENT '货币',
  `t_price` float DEFAULT NULL COMMENT '价格',
  `t_review_count` mediumint(8) DEFAULT NULL COMMENT '评论数',
  `t_review_average_score` mediumint(8) DEFAULT NULL COMMENT '平均分',
  `t_supplier` varchar(50) DEFAULT NULL COMMENT '供应商',
  `t_supplier_code` varchar(100) DEFAULT NULL,
  `t_attr1` int(11) DEFAULT NULL,
  `t_attr1_value` varchar(100) DEFAULT NULL,
  `t_attr2` int(11) DEFAULT NULL,
  `t_attr2_value` varchar(100) DEFAULT NULL,
  `t_attr3` int(11) DEFAULT NULL,
  `t_attr3_value` varchar(100) DEFAULT NULL,
  `t_attr4` int(11) DEFAULT NULL,
  `t_attr4_value` varchar(100) DEFAULT NULL,
  `t_attr5` int(11) DEFAULT NULL,
  `t_attr5_value` varchar(100) DEFAULT NULL,
  `t_attr6` int(11) DEFAULT NULL,
  `t_attr6_value` varchar(100) DEFAULT NULL,
  `t_attr7` int(11) DEFAULT NULL,
  `t_attr7_value` varchar(100) DEFAULT NULL,
  `t_attr8` int(11) DEFAULT NULL,
  `t_attr8_value` varchar(100) DEFAULT NULL,
  `t_attr9` int(11) DEFAULT NULL,
  `t_attr9_value` varchar(100) DEFAULT NULL,
  `t_attr10` int(11) DEFAULT NULL,
  `t_attr10_value` varchar(100) DEFAULT NULL,
  `t_attr11` int(11) DEFAULT NULL,
  `t_attr11_value` varchar(100) DEFAULT NULL,
  `t_attr12` int(11) DEFAULT NULL,
  `t_attr12_value` varchar(100) DEFAULT NULL,
  `t_attr13` int(11) DEFAULT NULL,
  `t_attr13_value` varchar(100) DEFAULT NULL,
  `t_attr14` int(11) DEFAULT NULL,
  `t_attr14_value` varchar(100) DEFAULT NULL,
  `t_attr15` int(11) DEFAULT NULL,
  `t_attr15_value` varchar(100) DEFAULT NULL,
  `t_is_valid` enum('0','1') DEFAULT NULL COMMENT '是否有效',
  `t_add_date` datetime NOT NULL COMMENT '添加时间',
  `t_update_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`t_id`),
  UNIQUE KEY `t_supplier_code` (`t_supplier`,`t_supplier_code`),
  KEY `location` (`tc_id`,`c_country_id`,`c_state_id`,`c_city_id`,`c_county_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

/*Table structure for table `tourism_attribute` */

DROP TABLE IF EXISTS `tourism_attribute`;

CREATE TABLE `tourism_attribute` (
  `ta_id` int(11) NOT NULL AUTO_INCREMENT,
  `tc_id` int(11) NOT NULL DEFAULT '0',
  `ta_name` varchar(50) NOT NULL COMMENT '属性名称',
  `ta_name_cn` varchar(50) DEFAULT NULL COMMENT '属性名称',
  `ta_main_attr` enum('0','1') NOT NULL DEFAULT '0',
  `ta_isfilter` enum('0','1') NOT NULL DEFAULT '0',
  `ta_order` int(11) DEFAULT NULL,
  PRIMARY KEY (`ta_id`),
  UNIQUE KEY `ta_name` (`tc_id`,`ta_name`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

/*Table structure for table `tourism_attribute_value` */

DROP TABLE IF EXISTS `tourism_attribute_value`;

CREATE TABLE `tourism_attribute_value` (
  `tc_id` int(11) DEFAULT NULL COMMENT '类别ID',
  `t_id` int(11) DEFAULT NULL COMMENT 'tourism id',
  `ta_id` int(11) DEFAULT NULL COMMENT '属性id',
  `tav_value` varchar(100) DEFAULT NULL COMMENT '属性值',
  `tav_value_cn` varchar(100) DEFAULT NULL,
  UNIQUE KEY `pid` (`t_id`,`ta_id`),
  KEY `atrid` (`ta_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

/*Table structure for table `tourism_category` */

DROP TABLE IF EXISTS `tourism_category`;

CREATE TABLE `tourism_category` (
  `tc_id` bigint(19) NOT NULL AUTO_INCREMENT,
  `tc_parent_id` bigint(19) NOT NULL DEFAULT '0',
  `tc_name` varchar(100) DEFAULT NULL COMMENT '名称',
  `tc_name_cn` varchar(100) DEFAULT NULL COMMENT '中文名称',
  PRIMARY KEY (`tc_id`),
  UNIQUE KEY `tc_name` (`tc_name`)
) ENGINE=MyISAM AUTO_INCREMENT=7 DEFAULT CHARSET=utf8;

/*Table structure for table `tourism_copy` */

DROP TABLE IF EXISTS `tourism_copy`;

CREATE TABLE `tourism_copy` (
  `t_id` bigint(19) NOT NULL AUTO_INCREMENT COMMENT 'id',
  `tc_id` int(11) DEFAULT NULL COMMENT '类别id',
  `c_country_id` int(11) DEFAULT NULL COMMENT '国家',
  `c_state_id` int(11) DEFAULT NULL COMMENT '州省',
  `c_city_id` int(11) DEFAULT NULL COMMENT '城市',
  `c_county_id` int(11) DEFAULT NULL COMMENT '县、郡；直辖市的区',
  `t_title` varchar(200) NOT NULL COMMENT '标题',
  `t_title_cn` varchar(200) DEFAULT NULL COMMENT '中文标题',
  `t_description` text COMMENT '短描述',
  `t_description_cn` text COMMENT '短中文描述',
  `t_images` text COMMENT '图片数组',
  `t_latitude` varchar(100) DEFAULT NULL COMMENT '纬度',
  `t_longitude` varchar(100) DEFAULT NULL COMMENT '经度',
  `t_currency` varchar(50) DEFAULT NULL COMMENT '货币',
  `t_price` float DEFAULT NULL COMMENT '价格',
  `t_review_count` mediumint(8) DEFAULT NULL COMMENT '评论数',
  `t_review_average_score` mediumint(8) DEFAULT NULL COMMENT '平均分',
  `t_supplier` varchar(50) DEFAULT NULL COMMENT '供应商',
  `t_supplier_code` varchar(100) DEFAULT NULL,
  `t_attr1` int(11) DEFAULT NULL,
  `t_attr1_value` varchar(100) DEFAULT NULL,
  `t_attr2` int(11) DEFAULT NULL,
  `t_attr2_value` varchar(100) DEFAULT NULL,
  `t_attr3` int(11) DEFAULT NULL,
  `t_attr3_value` varchar(100) DEFAULT NULL,
  `t_attr4` int(11) DEFAULT NULL,
  `t_attr4_value` varchar(100) DEFAULT NULL,
  `t_attr5` int(11) DEFAULT NULL,
  `t_attr5_value` varchar(100) DEFAULT NULL,
  `t_attr6` int(11) DEFAULT NULL,
  `t_attr6_value` varchar(100) DEFAULT NULL,
  `t_attr7` int(11) DEFAULT NULL,
  `t_attr7_value` varchar(100) DEFAULT NULL,
  `t_attr8` int(11) DEFAULT NULL,
  `t_attr8_value` varchar(100) DEFAULT NULL,
  `t_attr9` int(11) DEFAULT NULL,
  `t_attr9_value` varchar(100) DEFAULT NULL,
  `t_attr10` int(11) DEFAULT NULL,
  `t_attr10_value` varchar(100) DEFAULT NULL,
  `t_attr11` int(11) DEFAULT NULL,
  `t_attr11_value` varchar(100) DEFAULT NULL,
  `t_attr12` int(11) DEFAULT NULL,
  `t_attr12_value` varchar(100) DEFAULT NULL,
  `t_attr13` int(11) DEFAULT NULL,
  `t_attr13_value` varchar(100) DEFAULT NULL,
  `t_attr14` int(11) DEFAULT NULL,
  `t_attr14_value` varchar(100) DEFAULT NULL,
  `t_attr15` int(11) DEFAULT NULL,
  `t_attr15_value` varchar(100) DEFAULT NULL,
  `t_is_valid` enum('0','1') DEFAULT NULL COMMENT '是否有效',
  `t_add_date` datetime NOT NULL COMMENT '添加时间',
  `t_update_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`t_id`),
  UNIQUE KEY `t_supplier_code` (`t_supplier`,`t_supplier_code`),
  KEY `location` (`tc_id`,`c_country_id`,`c_state_id`,`c_city_id`,`c_county_id`)
) ENGINE=MyISAM AUTO_INCREMENT=11488 DEFAULT CHARSET=utf8;

/*Table structure for table `tourism_review` */

DROP TABLE IF EXISTS `tourism_review`;

CREATE TABLE `tourism_review` (
  `tr_id` bigint(19) NOT NULL AUTO_INCREMENT,
  `t_id` bigint(19) NOT NULL,
  `u_id` varchar(11) NOT NULL COMMENT '用户ID',
  `tr_title` varchar(250) DEFAULT NULL,
  `tr_good` varchar(250) DEFAULT NULL,
  `tr_bad` varchar(250) DEFAULT NULL,
  `tr_contents` varchar(500) DEFAULT NULL,
  `tr_is_help` int(11) DEFAULT '0' COMMENT '有帮助',
  `tr_no_help` int(11) DEFAULT '0' COMMENT '无帮助',
  `tr_point` int(11) DEFAULT '0' COMMENT '评分',
  `b_billno` bigint(19) DEFAULT NULL,
  `tr_ip` varchar(250) DEFAULT NULL,
  `tr_show` enum('0','1') NOT NULL DEFAULT '0',
  `tr_add_date` datetime DEFAULT NULL,
  PRIMARY KEY (`tr_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

/*Table structure for table `tourism_tag` */

DROP TABLE IF EXISTS `tourism_tag`;

CREATE TABLE `tourism_tag` (
  `tt_id` int(11) NOT NULL AUTO_INCREMENT,
  `tt_name` varchar(100) DEFAULT NULL COMMENT '标签名',
  PRIMARY KEY (`tt_id`),
  UNIQUE KEY `tt_name` (`tt_name`)
) ENGINE=MyISAM AUTO_INCREMENT=79 DEFAULT CHARSET=utf8;

/*Table structure for table `tourism_tag_product` */

DROP TABLE IF EXISTS `tourism_tag_product`;

CREATE TABLE `tourism_tag_product` (
  `t_id` bigint(19) NOT NULL,
  `tt_id` int(11) NOT NULL,
  UNIQUE KEY `t_t_product` (`t_id`,`tt_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

/*Table structure for table `tourism_tag_product_copy` */

DROP TABLE IF EXISTS `tourism_tag_product_copy`;

CREATE TABLE `tourism_tag_product_copy` (
  `t_id` bigint(19) NOT NULL,
  `tt_id` int(11) NOT NULL,
  UNIQUE KEY `t_t_product` (`t_id`,`tt_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

/*Table structure for table `user` */

DROP TABLE IF EXISTS `user`;

CREATE TABLE `user` (
  `u_id` int(11) NOT NULL AUTO_INCREMENT,
  `u_name` varchar(50) DEFAULT NULL COMMENT '用户姓名',
  `u_email` varchar(50) NOT NULL,
  `u_mobile` bigint(11) DEFAULT NULL,
  `u_password` varchar(255) NOT NULL,
  `u_id_card_no` varchar(255) DEFAULT NULL COMMENT '用户身份证',
  `u_add_date` datetime DEFAULT NULL,
  `u_update_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `u_uuid` varchar(50) NOT NULL,
  PRIMARY KEY (`u_id`),
  UNIQUE KEY `u_uuid` (`u_uuid`),
  UNIQUE KEY `u_id_card_no` (`u_id_card_no`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
