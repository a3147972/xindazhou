/*
 Navicat Premium Data Transfer

 Source Server         : 127.0.0.1
 Source Server Type    : MySQL
 Source Server Version : 50624
 Source Host           : localhost
 Source Database       : xindazhou

 Target Server Type    : MySQL
 Target Server Version : 50624
 File Encoding         : utf-8

 Date: 07/05/2015 10:36:44 AM
*/

SET NAMES utf8;
SET FOREIGN_KEY_CHECKS = 0;

-- ----------------------------
--  Table structure for `think_activity`
-- ----------------------------
DROP TABLE IF EXISTS `think_activity`;
CREATE TABLE `think_activity` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) CHARACTER SET utf8 NOT NULL,
  `content` text CHARACTER SET utf8 NOT NULL,
  `answer` int(255) NOT NULL COMMENT '正确答案',
  `create_time` datetime NOT NULL,
  `modification_time` datetime NOT NULL,
  `is_lottery` int(11) NOT NULL DEFAULT '0' COMMENT '是否开奖-未开奖 1-开奖',
  `rule` text CHARACTER SET utf8,
  `status` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  UNIQUE KEY `name_unique` (`name`)
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=latin1;

-- ----------------------------
--  Table structure for `think_activity_log`
-- ----------------------------
DROP TABLE IF EXISTS `think_activity_log`;
CREATE TABLE `think_activity_log` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `joiner_id` int(11) NOT NULL,
  `activity_id` int(11) NOT NULL,
  `options_id` int(11) NOT NULL COMMENT '奖项 1-一等奖 2-参与奖',
  `psize_id` int(11) DEFAULT NULL,
  `create_time` datetime NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_think_activity_win` (`joiner_id`),
  KEY `fk_think_activity_win_1` (`activity_id`),
  KEY `psize_id` (`psize_id`),
  KEY `options_id` (`options_id`),
  KEY `options_id_2` (`options_id`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8 COMMENT='中奖列表';

-- ----------------------------
--  Table structure for `think_activity_options`
-- ----------------------------
DROP TABLE IF EXISTS `think_activity_options`;
CREATE TABLE `think_activity_options` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `activity_id` int(11) NOT NULL,
  `options` varchar(255) NOT NULL COMMENT '选项内容',
  PRIMARY KEY (`id`),
  KEY `fk_think_activity_options` (`activity_id`),
  CONSTRAINT `fk_think_activity_options` FOREIGN KEY (`activity_id`) REFERENCES `think_activity` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=40 DEFAULT CHARSET=utf8;

-- ----------------------------
--  Table structure for `think_activity_psize`
-- ----------------------------
DROP TABLE IF EXISTS `think_activity_psize`;
CREATE TABLE `think_activity_psize` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `activity_id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `prize` varchar(255) NOT NULL COMMENT '奖品名称',
  `thumb` varchar(255) NOT NULL COMMENT '奖品缩略图',
  `people` int(11) DEFAULT NULL,
  `create_time` datetime NOT NULL,
  `modification_time` datetime NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_think_activity_psize` (`activity_id`),
  CONSTRAINT `fk_think_activity_psize` FOREIGN KEY (`activity_id`) REFERENCES `think_activity` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=17 DEFAULT CHARSET=utf8;

-- ----------------------------
--  Table structure for `think_address`
-- ----------------------------
DROP TABLE IF EXISTS `think_address`;
CREATE TABLE `think_address` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `city_id` int(11) DEFAULT NULL,
  `address` varchar(200) CHARACTER SET utf8 NOT NULL COMMENT '地址',
  `company_name` varchar(500) CHARACTER SET utf8 NOT NULL COMMENT '公司名称',
  `phone` varchar(64) CHARACTER SET utf8 NOT NULL COMMENT '公司电话',
  `create_time` datetime NOT NULL,
  `modification` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

-- ----------------------------
--  Table structure for `think_admin`
-- ----------------------------
DROP TABLE IF EXISTS `think_admin`;
CREATE TABLE `think_admin` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `username` char(20) NOT NULL,
  `password` char(40) NOT NULL,
  `create_time` datetime NOT NULL,
  `modification_time` datetime NOT NULL,
  `last_login` varchar(40) NOT NULL,
  `last_ip` varchar(16) NOT NULL,
  `status` int(1) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;

-- ----------------------------
--  Table structure for `think_city`
-- ----------------------------
DROP TABLE IF EXISTS `think_city`;
CREATE TABLE `think_city` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(64) CHARACTER SET utf8 NOT NULL COMMENT '城市名称',
  `pid` int(11) NOT NULL COMMENT '1-一级地址 2-二级地址',
  `create_time` datetime NOT NULL,
  `modification_time` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=latin1 COMMENT='城市地址表';

-- ----------------------------
--  Table structure for `think_document`
-- ----------------------------
DROP TABLE IF EXISTS `think_document`;
CREATE TABLE `think_document` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(400) NOT NULL COMMENT '标题',
  `content` text NOT NULL COMMENT '内容',
  `create_time` datetime NOT NULL,
  `modification_time` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=29 DEFAULT CHARSET=utf8;

-- ----------------------------
--  Table structure for `think_joiner`
-- ----------------------------
DROP TABLE IF EXISTS `think_joiner`;
CREATE TABLE `think_joiner` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `activity_id` int(11) DEFAULT NULL,
  `openid` varchar(64) NOT NULL COMMENT '微信openid',
  `mobile` char(11) NOT NULL,
  `create_time` datetime NOT NULL,
  `modification_time` datetime NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_think_joiner` (`activity_id`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8 COMMENT='参加活动者';

-- ----------------------------
--  Table structure for `think_keyword`
-- ----------------------------
DROP TABLE IF EXISTS `think_keyword`;
CREATE TABLE `think_keyword` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `keywords` varchar(64) NOT NULL,
  `title` varchar(255) NOT NULL,
  `descption` text NOT NULL COMMENT '图文描述',
  `thumb` varchar(255) NOT NULL COMMENT '缩略图',
  `link` varchar(255) DEFAULT NULL,
  `create_time` datetime NOT NULL,
  `modification_time` datetime NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `keywords_unique` (`keywords`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

-- ----------------------------
--  Table structure for `think_menu`
-- ----------------------------
DROP TABLE IF EXISTS `think_menu`;
CREATE TABLE `think_menu` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `pid` int(11) DEFAULT NULL,
  `name` varchar(64) CHARACTER SET utf8 DEFAULT NULL,
  `url` varchar(500) DEFAULT NULL,
  `create_time` datetime DEFAULT NULL,
  `modification_time` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=latin1;

-- ----------------------------
--  Table structure for `think_product`
-- ----------------------------
DROP TABLE IF EXISTS `think_product`;
CREATE TABLE `think_product` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(128) NOT NULL COMMENT '车型名称',
  `thumb` varchar(400) NOT NULL COMMENT '缩略图',
  `content` text NOT NULL COMMENT '内容',
  `create_time` datetime NOT NULL,
  `modification_time` datetime NOT NULL,
  `class_id` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8;

-- ----------------------------
--  Table structure for `think_product_class`
-- ----------------------------
DROP TABLE IF EXISTS `think_product_class`;
CREATE TABLE `think_product_class` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(64) NOT NULL,
  `create_time` datetime NOT NULL,
  `modification_time` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

SET FOREIGN_KEY_CHECKS = 1;
