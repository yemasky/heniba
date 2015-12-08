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
  `m_update_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `m_add_date` datetime NOT NULL,
  PRIMARY KEY (`m_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Data for the table `merchant` */

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
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

/*Data for the table `merchant_user` */

insert  into `merchant_user`(`mu_id`,`m_id`,`mu_login_mobile`,`mu_login_email`,`mu_login_password`,`mu_uuid`,`mu_nickname`,`mu_update_date`,`mu_add_date`) values (1,1,NULL,'yemasky@msn.com','111111',NULL,NULL,'0000-00-00 00:00:00','0000-00-00 00:00:00');

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

/*Data for the table `modules_authorize` */

insert  into `modules_authorize`(`ma_id`,`mu_id`,`mc_id`,`ma_field_authorize`,`ma_action_right`) values (1,1,1,NULL,'view'),(2,1,2,NULL,'view'),(3,1,3,NULL,'view'),(4,1,4,NULL,'view'),(5,1,5,NULL,'view'),(6,1,6,NULL,'view'),(7,1,7,NULL,'view'),(8,1,8,NULL,'view');

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
  PRIMARY KEY (`mc_id`)
) ENGINE=MyISAM AUTO_INCREMENT=9 DEFAULT CHARSET=utf8;

/*Data for the table `modules_config` */

insert  into `modules_config`(`mc_id`,`mc_father_id`,`mc_name`,`mc_module`,`mc_module_action`,`mc_module_action_field`,`mc_ico`,`mc_new`) values (1,1,'管理模块',NULL,NULL,NULL,'file','0'),(2,1,'旅游产品','tourism',NULL,NULL,'university','1'),(3,1,'酒店产品','hotel',NULL,NULL,'hotel','0'),(4,1,'地图查找','maps',NULL,NULL,'map-marker','0'),(5,1,'用户管理','member',NULL,NULL,'users','0'),(6,1,'订单管理',NULL,NULL,NULL,'table','0'),(7,7,'系统日志',NULL,NULL,NULL,'calendar','0'),(8,8,'表单',NULL,NULL,NULL,'pencil-square-o','0');

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
