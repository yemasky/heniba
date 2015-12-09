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

/*Table structure for table `country_copy` */

DROP TABLE IF EXISTS `country_copy`;

CREATE TABLE `country_copy` (
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
  `c_type` enum('Continent','Country','State','City','CityLocation','Towns','Region') NOT NULL COMMENT '类型',
  PRIMARY KEY (`c_id`),
  UNIQUE KEY `country` (`c_continent_id`,`c_country_id`,`c_state_id`,`c_city_id`,`c_name`,`c_type`)
) ENGINE=MyISAM AUTO_INCREMENT=4431 DEFAULT CHARSET=utf8;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
