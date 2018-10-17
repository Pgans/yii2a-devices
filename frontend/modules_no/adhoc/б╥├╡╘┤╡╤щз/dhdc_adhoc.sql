/*
Navicat MySQL Data Transfer

Source Server         : localhost3309
Source Server Version : 50548
Source Host           : localhost:3309
Source Database       : dhdc3

Target Server Type    : MYSQL
Target Server Version : 50548
File Encoding         : 65001

Date: 2017-08-01 13:27:15
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for dhdc_adhoc
-- ----------------------------
DROP TABLE IF EXISTS `dhdc_adhoc`;
CREATE TABLE `dhdc_adhoc` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(255) DEFAULT NULL,
  `sql_report` longtext,
  `date_begin` date DEFAULT NULL,
  `date_end` date DEFAULT NULL,
  `type` varchar(255) DEFAULT NULL,
  `note1` varchar(255) DEFAULT NULL,
  `note2` varchar(255) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `created_by` varchar(255) DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `updated_by` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;


-- ----------------------------
-- Table structure for dhdc_adhoc_transform
-- ----------------------------
DROP TABLE IF EXISTS `dhdc_adhoc_transform`;
CREATE TABLE `dhdc_adhoc_transform` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `sql` longtext,
  `date_begin` date DEFAULT NULL,
  `date_end` date DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `created_by` varchar(255) DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `updated_by` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of dhdc_adhoc_transform
-- ----------------------------
