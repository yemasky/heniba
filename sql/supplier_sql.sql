/*
SQLyog Ultimate v11.24 (32 bit)
MySQL - 5.6.21 : Database - supplier
*********************************************************************
*/

/*!40101 SET NAMES utf8 */;

/*!40101 SET SQL_MODE=''*/;

/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;
CREATE DATABASE /*!32312 IF NOT EXISTS*/`supplier` /*!40100 DEFAULT CHARACTER SET utf8 */;

USE `supplier`;

/*Table structure for table `bemyguest_tour` */

DROP TABLE IF EXISTS `bemyguest_tour`;

CREATE TABLE `bemyguest_tour` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `uuid` varchar(50) NOT NULL COMMENT '产品的UUID',
  `published` varchar(5) DEFAULT NULL COMMENT 'published（发布） - 对/错 true/false',
  `title` varchar(255) DEFAULT NULL COMMENT 'title（标题）- 产品的标题。只限英语版',
  `titleTranslated` varchar(255) DEFAULT NULL COMMENT 'titleTranslated（标题翻译文） - 产品的标题-根据所选的语言。',
  `description` text COMMENT 'description（描述）- 产品的描述。只限英语版。',
  `descriptionTranslated` text COMMENT 'descriptionTranslated （描述翻译文） - 产品的描述-根据所选的语言',
  `highlights` text COMMENT 'highlights（高亮显示） - 高亮显示产品。只限英语版',
  `highlightsTranslated` text COMMENT '高亮显示翻译文 - 高亮显示产品-根据所选的语言。',
  `additionalInfo` text COMMENT '附加信息- 产品的附加信息。只限英语版',
  `additionalInfoTranslated` text COMMENT '附加信息翻译文 - 产品的附加信息-根据所选的语言。',
  `priceIncludes` text COMMENT '价格包含 - 价格包含哪些费用',
  `priceIncludesTranslated` text COMMENT '价格包含翻译文 - 价格包含的翻译文',
  `priceExcludes` text COMMENT '活动行程 - 只限于配套类型, 其他类型将空值-NULL。',
  `priceExcludesTranslated` text,
  `itinerary` text COMMENT '活动行程 - 只限于配套类型, 其他类型将空值-NULL。',
  `itineraryTranslated` text COMMENT '行程的翻译文',
  `warnings` text COMMENT '警告- 活动警告信息 (有关安全和保险)',
  `warningsTranslated` text COMMENT '警告翻译文 - 警告的翻译文。',
  `safety` text COMMENT '安全管理 - 活动安全管理信息。',
  `safetyTranslated` text COMMENT '安全管理翻译文 - 安全管理的翻译文',
  `latitude` text COMMENT '纬度',
  `longitude` text COMMENT '经度',
  `minPax` text COMMENT '最低人数',
  `maxPax` text COMMENT '最高人数',
  `basePrice` text COMMENT '基价 (不显示)',
  `currency` text COMMENT '货币',
  `reviewCount` text COMMENT '评论分数',
  `reviewAverageScore` text COMMENT '评论平均分数',
  `typeName` text COMMENT '产品的类型',
  `typeUuid` text COMMENT 'UUID的类型',
  `photosUrl` text COMMENT '照片的基础路径',
  `businessHoursFrom` text COMMENT '供应商开始营业时间',
  `businessHoursTo` text COMMENT '供应商结束营业时间',
  `meetingTime` text COMMENT '集合时间',
  `meetingLocation` text COMMENT '有关与供应商集合地点的说明',
  `meetingLocationTranslated` text COMMENT '集合地点的翻译文',
  `photos` text COMMENT '图片',
  `categories` text COMMENT '类别阵列',
  `productTypes` text COMMENT '产品类型 含主要价格',
  `addons` text COMMENT '产品加载项',
  `locations` text COMMENT '有关产品的位置信息',
  `url` text COMMENT '产品的URL网站',
  `staticUrl` text,
  `update_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP COMMENT '最后更新时间',
  PRIMARY KEY (`id`),
  UNIQUE KEY `uuid` (`uuid`)
) ENGINE=MyISAM AUTO_INCREMENT=11489 DEFAULT CHARSET=utf8;

/*Table structure for table `tourico_destination` */

DROP TABLE IF EXISTS `tourico_destination`;

CREATE TABLE `tourico_destination` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `Continent_id` int(11) DEFAULT NULL,
  `Country_id` int(11) DEFAULT NULL,
  `State_id` int(11) DEFAULT NULL,
  `City_id` int(11) DEFAULT NULL,
  `name` varchar(100) DEFAULT NULL,
  `elementType` tinyint(3) DEFAULT NULL,
  `destinationId` int(11) NOT NULL,
  `provider` tinyint(3) DEFAULT NULL,
  `status` varchar(50) DEFAULT NULL,
  `location` varchar(50) DEFAULT NULL,
  `destinationCode` varchar(5) DEFAULT NULL,
  `cityLatitude` varchar(50) DEFAULT NULL,
  `cityLongitude` varchar(50) DEFAULT NULL,
  `destination_type` enum('Continent','Country','State','City','CityLocation') NOT NULL,
  `update_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `destinationId` (`destinationId`)
) ENGINE=MyISAM AUTO_INCREMENT=4431 DEFAULT CHARSET=utf8;

/*Table structure for table `tourico_hotel` */

DROP TABLE IF EXISTS `tourico_hotel`;

CREATE TABLE `tourico_hotel` (
  `hotelID` int(11) NOT NULL,
  `name` varchar(200) DEFAULT NULL COMMENT '名字',
  `brand` varchar(100) DEFAULT NULL COMMENT '品牌',
  `brandId` int(11) DEFAULT NULL COMMENT '品牌id',
  `rooms` mediumint(5) DEFAULT NULL COMMENT '房间数',
  `provider` varchar(100) DEFAULT NULL COMMENT '提供者',
  `checkInTime` varchar(100) DEFAULT NULL COMMENT '入住',
  `checkOutTime` varchar(100) DEFAULT NULL COMMENT '退房',
  `currency` varchar(50) DEFAULT NULL COMMENT '货币',
  `thumb` varchar(255) DEFAULT NULL,
  `hotelPhone` varchar(50) DEFAULT NULL COMMENT '电话',
  `hotelFax` varchar(50) DEFAULT NULL COMMENT '传真',
  `starLevel` varchar(50) DEFAULT NULL COMMENT '星级',
  `ranking` varchar(50) DEFAULT NULL COMMENT '评分 排名 等级',
  `bestValue` varchar(50) DEFAULT NULL,
  `Location` text COMMENT '地理位置 地址 经纬度',
  `RefPoints` text COMMENT '附近的points',
  `Descriptions` text COMMENT '描述',
  `Media` text COMMENT '多媒体 图片 视频',
  `Amenities` text COMMENT '设施',
  `RoomType` text COMMENT '房型',
  `Home` text COMMENT '是否home标记',
  `update_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP COMMENT '更新时间',
  PRIMARY KEY (`hotelID`),
  UNIQUE KEY `hotelid` (`hotelID`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
