/*
SQLyog Ultimate v11.24 (32 bit)
MySQL - 5.6.21 : Database - merchant
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
  `m_add_date` datetime NOT NULL,
  PRIMARY KEY (`m_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

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
  `mu_add_date` datetime NOT NULL,
  PRIMARY KEY (`mu_id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
