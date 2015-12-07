/*
SQLyog Ultimate v11.27 (32 bit)
MySQL - 5.6.17 : Database - heniba
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
  `c_id` int(11) DEFAULT NULL COMMENT 'id',
  `c_continent_id` int(11) DEFAULT NULL COMMENT '洲',
  `c_country_id` int(11) DEFAULT NULL COMMENT '国家、地区',
  `c_region_id` int(11) DEFAULT NULL COMMENT '大区域',
  `c_state_id` int(11) DEFAULT NULL COMMENT '州、省',
  `c_city_id` int(11) DEFAULT NULL COMMENT '市、直辖市',
  `c_county_id` int(11) DEFAULT NULL COMMENT '县、郡；直辖市的区',
  `c_towns_id` int(11) DEFAULT NULL COMMENT '村庄',
  `c_name` varchar(100) DEFAULT NULL COMMENT '名称',
  `c_type` enum('towns','county','city','state','region','country','continent') DEFAULT NULL COMMENT '类型'
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

/*Data for the table `country` */

/*Table structure for table `tourism` */

DROP TABLE IF EXISTS `tourism`;

CREATE TABLE `tourism` (
  `t_id` bigint(19) NOT NULL AUTO_INCREMENT COMMENT 'id',
  `c_id` int(11) DEFAULT NULL COMMENT '类别id',
  `c_country_id` int(11) DEFAULT NULL COMMENT '国家',
  `c_city_id` int(11) DEFAULT NULL COMMENT '城市',
  `c_county_id` int(11) DEFAULT NULL COMMENT '县、郡；直辖市的区',
  `t_title` varchar(200) NOT NULL COMMENT '标题',
  `t_title_cn` varchar(200) DEFAULT NULL COMMENT '中文标题',
  `t_description` text COMMENT '短描述',
  `t_description_cn` text COMMENT '短中文描述',
  `t_images` varchar(255) DEFAULT NULL COMMENT '图片',
  `t_latitude` varchar(100) DEFAULT NULL,
  `t_longitude` varchar(100) DEFAULT NULL,
  `t_currency` varchar(50) DEFAULT NULL COMMENT '货币',
  `t_price` float DEFAULT NULL COMMENT '价格',
  `t_review_count` mediumint(8) DEFAULT NULL COMMENT '评论数',
  `t_review_average_score` mediumint(8) DEFAULT NULL COMMENT '平均分',
  `t_supplier` varchar(20) DEFAULT NULL COMMENT '供应商',
  `t_supplier_code` varchar(50) DEFAULT NULL,
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
  `t_update_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`t_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

/*Data for the table `tourism` */

/*Table structure for table `tourism_attribute` */

DROP TABLE IF EXISTS `tourism_attribute`;

CREATE TABLE `tourism_attribute` (
  `ta_id` int(11) NOT NULL AUTO_INCREMENT,
  `tc_id` int(11) NOT NULL DEFAULT '0',
  `ta_title` varchar(250) NOT NULL,
  `ta_main_attr` enum('0','1') NOT NULL DEFAULT '0',
  `ta_isfilter` enum('0','1') NOT NULL DEFAULT '0',
  `ta_order` int(11) DEFAULT NULL,
  PRIMARY KEY (`ta_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

/*Data for the table `tourism_attribute` */

/*Table structure for table `tourism_attribute_value` */

DROP TABLE IF EXISTS `tourism_attribute_value`;

CREATE TABLE `tourism_attribute_value` (
  `tc_id` int(11) DEFAULT NULL,
  `t_id` int(11) DEFAULT NULL,
  `ta_id` int(11) DEFAULT NULL,
  `tav_value` varchar(100) DEFAULT NULL,
  UNIQUE KEY `pid` (`t_id`,`ta_id`),
  KEY `atrid` (`ta_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

/*Data for the table `tourism_attribute_value` */

/*Table structure for table `tourism_category` */

DROP TABLE IF EXISTS `tourism_category`;

CREATE TABLE `tourism_category` (
  `tc_id` bigint(19) NOT NULL AUTO_INCREMENT,
  `tc_parent_id` bigint(19) NOT NULL DEFAULT '0',
  `tc_title` varchar(100) DEFAULT NULL COMMENT '标题',
  PRIMARY KEY (`tc_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

/*Data for the table `tourism_category` */

/*Table structure for table `tourism_review` */

DROP TABLE IF EXISTS `tourism_review`;

CREATE TABLE `tourism_review` (
  `tr_id` bigint(19) NOT NULL AUTO_INCREMENT,
  `t_id` bigint(19) NOT NULL,
  `u_id` varchar(11) NOT NULL,
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

/*Data for the table `tourism_review` */

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
