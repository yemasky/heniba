/*
SQLyog Ultimate v11.27 (32 bit)
MySQL - 10.1.9-MariaDB : Database - merchant
*********************************************************************
*/

/*!40101 SET NAMES utf8 */;

/*!40101 SET SQL_MODE=''*/;

/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;
CREATE DATABASE /*!32312 IF NOT EXISTS*/`merchant` /*!40100 DEFAULT CHARACTER SET utf8 */;

USE `merchant`;

/*Table structure for table `merchant` */

DROP TABLE IF EXISTS `merchant`;

CREATE TABLE `merchant` (
  `m_id` int(11) NOT NULL AUTO_INCREMENT,
  `m_name` varchar(200) DEFAULT NULL COMMENT '商户名称',
  `m_mobile` varchar(200) DEFAULT NULL COMMENT '商户移动电话',
  `m_phone` varchar(200) DEFAULT NULL COMMENT '商户电话',
  `m_country_id` mediumint(8) DEFAULT NULL,
  `m_state_id` mediumint(8) DEFAULT NULL,
  `m_city_id` mediumint(8) DEFAULT NULL,
  `m_county_id` mediumint(8) DEFAULT NULL,
  `m_address` varchar(255) DEFAULT NULL COMMENT '商户地址',
  `m_rate_tourism` float NOT NULL DEFAULT '1.1' COMMENT '商户基本利率 旅游产品',
  `m_rate_hotel` float NOT NULL DEFAULT '1.1' COMMENT '商户基本利率 酒店',
  `m_rate_air_ticket` float NOT NULL DEFAULT '1.1' COMMENT '商户基本利率 机票',
  `m_rate_tourism_sell` float DEFAULT '1.5' COMMENT '商户售卖利率 旅游产品',
  `m_rate_hotel_sell` float DEFAULT '1.5' COMMENT '商户售卖利率 酒店',
  `m_rate_air_ticket_sell` float DEFAULT '1.5' COMMENT '商户售卖利率 机票',
  `m_update_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `m_add_date` datetime NOT NULL,
  PRIMARY KEY (`m_id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

/*Table structure for table `merchant_user` */

DROP TABLE IF EXISTS `merchant_user`;

CREATE TABLE `merchant_user` (
  `mu_id` int(11) NOT NULL AUTO_INCREMENT,
  `m_id` int(11) DEFAULT NULL,
  `mu_login_mobile` int(11) DEFAULT NULL,
  `mu_login_email` varchar(50) DEFAULT NULL,
  `mu_login_password` varchar(50) NOT NULL,
  `mu_uuid` varchar(50) DEFAULT NULL,
  `mu_nickname` varchar(50) DEFAULT NULL COMMENT '昵称',
  `mu_update_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `mu_add_date` datetime NOT NULL,
  PRIMARY KEY (`mu_id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

/*Table structure for table `modules_authorize` */

DROP TABLE IF EXISTS `modules_authorize`;

CREATE TABLE `modules_authorize` (
  `ma_id` int(11) NOT NULL AUTO_INCREMENT,
  `mu_id` int(11) DEFAULT NULL,
  `mc_id` int(11) DEFAULT NULL,
  `ma_field_authorize` text COMMENT 'field 授权',
  `ma_action_right` enum('view','edit','delete') NOT NULL DEFAULT 'view' COMMENT 'action的权限查看 编辑 删除',
  PRIMARY KEY (`ma_id`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8;

/*Table structure for table `modules_config` */

DROP TABLE IF EXISTS `modules_config`;

CREATE TABLE `modules_config` (
  `mc_id` int(11) NOT NULL AUTO_INCREMENT,
  `mc_father_id` int(11) DEFAULT NULL COMMENT '父ID',
  `mc_name` varchar(100) DEFAULT NULL COMMENT '模块名称',
  `mc_module` varchar(100) DEFAULT NULL COMMENT '模块',
  `mc_module_action` varchar(100) DEFAULT NULL COMMENT '模块action',
  `mc_module_action_field` text COMMENT '模块action field权限',
  `mc_ico` varchar(50) DEFAULT NULL COMMENT '图标',
  `mc_new` enum('0','1') NOT NULL DEFAULT '0',
  `mc_show` enum('0','1') NOT NULL DEFAULT '1' COMMENT '是否显示在菜单中',
  PRIMARY KEY (`mc_id`)
) ENGINE=MyISAM AUTO_INCREMENT=9 DEFAULT CHARSET=utf8;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
