/*
SQLyog Ultimate v11.27 (32 bit)
MySQL - 5.6.17 : Database - tourzu
*********************************************************************
*/

/*!40101 SET NAMES utf8 */;

/*!40101 SET SQL_MODE=''*/;

/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;
CREATE DATABASE /*!32312 IF NOT EXISTS*/`tourzu` /*!40100 DEFAULT CHARACTER SET utf8 */;

USE `tourzu`;

/*Table structure for table `hotel` */

DROP TABLE IF EXISTS `hotel`;

CREATE TABLE `hotel` (
  `h_id` bigint(20) NOT NULL AUTO_INCREMENT COMMENT 'ID',
  `h_name` varchar(255) DEFAULT NULL COMMENT '名称',
  `h_introduction` text COMMENT '介绍',
  `h_images` varchar(250) DEFAULT NULL COMMENT '图片地址',
  `h_attention` text COMMENT '注意事项',
  `h_phone` varchar(50) DEFAULT NULL COMMENT '电话',
  `h_web_address` varchar(255) DEFAULT NULL COMMENT '网址',
  `h_continent` int(11) DEFAULT NULL COMMENT '洲',
  `h_country` int(11) DEFAULT NULL COMMENT '国家',
  `h_province` int(11) DEFAULT NULL COMMENT '省',
  `h_city` int(11) DEFAULT NULL COMMENT '市',
  `h_county` int(11) DEFAULT NULL COMMENT '县',
  `h_longitude` double DEFAULT NULL COMMENT '经度',
  `h_latitude` double DEFAULT NULL COMMENT '维度',
  `h_valid` enum('0','1') DEFAULT NULL COMMENT '是否有效（是否存在）',
  `h_add_date` datetime NOT NULL COMMENT '添加时间',
  PRIMARY KEY (`h_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

/*Data for the table `hotel` */

/*Table structure for table `hotel_images` */

DROP TABLE IF EXISTS `hotel_images`;

CREATE TABLE `hotel_images` (
  `hi_id` bigint(20) NOT NULL AUTO_INCREMENT,
  `h_id` bigint(20) DEFAULT NULL COMMENT '景点地址',
  `hi_path` varchar(255) NOT NULL COMMENT '图片地址',
  `hi_add_date` datetime DEFAULT NULL COMMENT '添加时间',
  PRIMARY KEY (`hi_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Data for the table `hotel_images` */

/*Table structure for table `hotel_tag` */

DROP TABLE IF EXISTS `hotel_tag`;

CREATE TABLE `hotel_tag` (
  `h_id` bigint(20) NOT NULL,
  `t_id` bigint(20) NOT NULL,
  PRIMARY KEY (`h_id`,`t_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

/*Data for the table `hotel_tag` */

/*Table structure for table `member` */

DROP TABLE IF EXISTS `member`;

CREATE TABLE `member` (
  `m_id` bigint(20) NOT NULL AUTO_INCREMENT,
  `m_register_date` datetime NOT NULL COMMENT '注册时间',
  `m_real_name` varchar(50) DEFAULT NULL COMMENT '真实名字',
  `m_sex` enum('男','女','') DEFAULT NULL COMMENT '性别',
  `m_address` varchar(255) DEFAULT NULL COMMENT '地址',
  `m_postcode` varchar(10) DEFAULT NULL COMMENT '邮编',
  PRIMARY KEY (`m_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

/*Data for the table `member` */

/*Table structure for table `member_action` */

DROP TABLE IF EXISTS `member_action`;

CREATE TABLE `member_action` (
  `ma_id` bigint(20) NOT NULL AUTO_INCREMENT,
  `m_id` bigint(20) NOT NULL,
  `ma_action` text NOT NULL COMMENT 'json数组 用户时间轴',
  `ma_tpye` enum('发表文章') DEFAULT NULL,
  `ma_add_date` datetime NOT NULL,
  PRIMARY KEY (`ma_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

/*Data for the table `member_action` */

/*Table structure for table `member_images` */

DROP TABLE IF EXISTS `member_images`;

CREATE TABLE `member_images` (
  `mi_id` bigint(20) NOT NULL AUTO_INCREMENT,
  `m_id` bigint(20) NOT NULL DEFAULT '0',
  `s_id` bigint(20) NOT NULL DEFAULT '0' COMMENT '景点',
  `mi_path` varchar(20) NOT NULL,
  `mi_host` varchar(10) DEFAULT NULL,
  `mi_title` varchar(100) DEFAULT NULL COMMENT '标题',
  `mi_describe` text COMMENT '描述',
  `mi_add_date` timestamp NOT NULL,
  PRIMARY KEY (`mi_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

/*Data for the table `member_images` */

/*Table structure for table `member_login` */

DROP TABLE IF EXISTS `member_login`;

CREATE TABLE `member_login` (
  `m_id` bigint(20) NOT NULL AUTO_INCREMENT,
  `ml_mobile` char(11) DEFAULT NULL,
  `ml_email` varchar(50) DEFAULT NULL,
  `ml_member_name` varchar(50) DEFAULT NULL,
  `ml_member_password` varchar(250) DEFAULT NULL,
  `ml_member_uuid` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`m_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

/*Data for the table `member_login` */

/*Table structure for table `member_travel_notes` */

DROP TABLE IF EXISTS `member_travel_notes`;

CREATE TABLE `member_travel_notes` (
  `mtn_id` bigint(20) NOT NULL AUTO_INCREMENT,
  `mtnc_id` int(10) DEFAULT NULL,
  `m_id` bigint(20) NOT NULL DEFAULT '0',
  `mtn_title` varchar(255) NOT NULL,
  `mtn_contents` text,
  `mtn_add_date` datetime NOT NULL,
  `mtn_modify_date` text COMMENT 'josn 修改时间',
  PRIMARY KEY (`mtn_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

/*Data for the table `member_travel_notes` */

/*Table structure for table `member_travel_notes_class` */

DROP TABLE IF EXISTS `member_travel_notes_class`;

CREATE TABLE `member_travel_notes_class` (
  `mtnc_id` int(11) NOT NULL AUTO_INCREMENT,
  `m_id` bigint(20) DEFAULT NULL,
  `mtnc_name` varchar(20) DEFAULT NULL COMMENT '类别名称',
  `mtnc_add_date` datetime DEFAULT NULL,
  PRIMARY KEY (`mtnc_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

/*Data for the table `member_travel_notes_class` */

/*Table structure for table `member_travel_notes_images` */

DROP TABLE IF EXISTS `member_travel_notes_images`;

CREATE TABLE `member_travel_notes_images` (
  `mtni_id` bigint(20) NOT NULL AUTO_INCREMENT,
  `m_id` bigint(20) DEFAULT NULL,
  `mi_id` varchar(20) NOT NULL,
  `mi_add_date` timestamp NOT NULL,
  PRIMARY KEY (`mtni_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

/*Data for the table `member_travel_notes_images` */

/*Table structure for table `review` */

DROP TABLE IF EXISTS `review`;

CREATE TABLE `review` (
  `r_id` bigint(20) NOT NULL AUTO_INCREMENT,
  `r_title` varchar(250) DEFAULT NULL,
  `r_content` text,
  `r_type` enum('scenery','member_images','hotel','member','member_travel_notes') DEFAULT NULL,
  PRIMARY KEY (`r_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

/*Data for the table `review` */

/*Table structure for table `scenery` */

DROP TABLE IF EXISTS `scenery`;

CREATE TABLE `scenery` (
  `s_id` bigint(20) NOT NULL AUTO_INCREMENT COMMENT '景点ID',
  `s_name` varchar(255) DEFAULT NULL COMMENT '景点名称',
  `s_introduction` text COMMENT '景点介绍',
  `s_images` varchar(250) DEFAULT NULL COMMENT '图片地址',
  `s_attention` text COMMENT '注意事项',
  `s_phone` varchar(50) DEFAULT NULL COMMENT '景点电话',
  `s_web_address` varchar(255) DEFAULT NULL COMMENT '景点网址',
  `s_continent` int(11) DEFAULT NULL COMMENT '洲',
  `s_country` int(11) DEFAULT NULL COMMENT '国家',
  `s_province` int(11) DEFAULT NULL COMMENT '省',
  `s_city` int(11) DEFAULT NULL COMMENT '市',
  `s_county` int(11) DEFAULT NULL COMMENT '县',
  `s_longitude` double DEFAULT NULL COMMENT '经度',
  `s_latitude` double DEFAULT NULL COMMENT '维度',
  `s_valid` enum('0','1') DEFAULT NULL COMMENT '景点是否有效（是否存在）',
  `s_add_date` datetime NOT NULL COMMENT '添加时间',
  PRIMARY KEY (`s_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

/*Data for the table `scenery` */

/*Table structure for table `scenery_images` */

DROP TABLE IF EXISTS `scenery_images`;

CREATE TABLE `scenery_images` (
  `si_id` bigint(20) NOT NULL AUTO_INCREMENT,
  `s_id` bigint(20) DEFAULT NULL COMMENT '景点地址',
  `si_path` varchar(255) NOT NULL COMMENT '图片地址',
  `si_add_date` datetime DEFAULT NULL COMMENT '添加时间',
  PRIMARY KEY (`si_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Data for the table `scenery_images` */

/*Table structure for table `scenery_language` */

DROP TABLE IF EXISTS `scenery_language`;

CREATE TABLE `scenery_language` (
  `sl_id` bigint(20) NOT NULL AUTO_INCREMENT,
  `s_id` bigint(20) NOT NULL COMMENT '景点ID',
  `s_name` varchar(255) DEFAULT NULL COMMENT '景点名称',
  `s_introduction` text COMMENT '景点介绍',
  `s_images` varchar(250) DEFAULT NULL COMMENT '图片地址',
  `s_attention` text COMMENT '注意事项',
  `s_phone` varchar(50) DEFAULT NULL COMMENT '景点电话',
  `s_web_address` varchar(255) DEFAULT NULL COMMENT '景点网址',
  `s_continent` varchar(100) DEFAULT NULL COMMENT '洲',
  `s_country` varchar(100) DEFAULT NULL COMMENT '国家',
  `s_province` varchar(100) DEFAULT NULL COMMENT '省',
  `s_city` varchar(100) DEFAULT NULL COMMENT '市',
  `s_county` varchar(100) DEFAULT NULL COMMENT '县',
  `s_longitude` double DEFAULT NULL COMMENT '经度',
  `s_latitude` double DEFAULT NULL COMMENT '维度',
  `s_language` enum('cn','en','jp') NOT NULL DEFAULT 'cn' COMMENT '语言',
  PRIMARY KEY (`sl_id`,`s_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

/*Data for the table `scenery_language` */

/*Table structure for table `scenery_tag` */

DROP TABLE IF EXISTS `scenery_tag`;

CREATE TABLE `scenery_tag` (
  `s_id` bigint(20) NOT NULL,
  `t_id` bigint(20) NOT NULL,
  PRIMARY KEY (`s_id`,`t_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

/*Data for the table `scenery_tag` */

/*Table structure for table `tag` */

DROP TABLE IF EXISTS `tag`;

CREATE TABLE `tag` (
  `t_id` int(11) NOT NULL AUTO_INCREMENT,
  `t_name` varchar(200) NOT NULL,
  `t_add_date` timestamp NOT NULL,
  PRIMARY KEY (`t_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

/*Data for the table `tag` */

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
