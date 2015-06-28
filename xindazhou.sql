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

 Date: 06/28/2015 23:00:07 PM
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
  PRIMARY KEY (`id`),
  UNIQUE KEY `name_unique` (`name`)
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=latin1;

-- ----------------------------
--  Records of `think_activity`
-- ----------------------------
BEGIN;
INSERT INTO `think_activity` VALUES ('13', '幸运大抽奖', '<p>请问最可能出现的奖品是什么？你想中奖么？点击选择把！</p>', '1', '2015-06-28 10:50:17', '2015-06-28 16:57:23', '0');
COMMIT;

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
  `answer` int(11) NOT NULL,
  `create_time` datetime NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_think_activity_win` (`joiner_id`),
  KEY `fk_think_activity_win_1` (`activity_id`),
  KEY `psize_id` (`psize_id`),
  KEY `options_id` (`options_id`),
  KEY `options_id_2` (`options_id`),
  CONSTRAINT `fk_think_activity_win` FOREIGN KEY (`joiner_id`) REFERENCES `think_joiner` (`id`),
  CONSTRAINT `fk_think_activity_win_1` FOREIGN KEY (`activity_id`) REFERENCES `think_activity` (`id`),
  CONSTRAINT `fk_think_activity_win_2` FOREIGN KEY (`psize_id`) REFERENCES `think_activity_psize` (`id`),
  CONSTRAINT `fk_think_activity_win_3` FOREIGN KEY (`options_id`) REFERENCES `think_activity_options` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='中奖列表';

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
--  Records of `think_activity_options`
-- ----------------------------
BEGIN;
INSERT INTO `think_activity_options` VALUES ('31', '13', './Uploads/558fb4120d8e5.jpg'), ('32', '13', './Uploads/558fb41235764.jpg'), ('33', '13', './Uploads/558fb4125cd51.jpg'), ('34', '13', './Uploads/558fb412753d7.jpg'), ('35', '13', './Uploads/558fb4129584e.jpg'), ('36', '13', './Uploads/558fb412a61d3.jpg'), ('37', '13', './Uploads/558fb412b6ffa.jpg'), ('38', '13', './Uploads/558fb412d2701.jpg'), ('39', '13', './Uploads/558fb412ed118.jpg');
COMMIT;

-- ----------------------------
--  Table structure for `think_activity_psize`
-- ----------------------------
DROP TABLE IF EXISTS `think_activity_psize`;
CREATE TABLE `think_activity_psize` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `activity_id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL COMMENT '奖品名称',
  `thumb` varchar(255) NOT NULL COMMENT '奖品缩略图',
  `people` int(11) DEFAULT NULL,
  `create_time` datetime NOT NULL,
  `modification_time` datetime NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_think_activity_psize` (`activity_id`),
  CONSTRAINT `fk_think_activity_psize` FOREIGN KEY (`activity_id`) REFERENCES `think_activity` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=17 DEFAULT CHARSET=utf8;

-- ----------------------------
--  Records of `think_activity_psize`
-- ----------------------------
BEGIN;
INSERT INTO `think_activity_psize` VALUES ('15', '13', '摩托车使用权一年', './Uploads/558fb64653444.jpg', '1', '2015-06-28 16:54:34', '2015-06-28 16:54:34'), ('16', '13', '摩托车使用权半年', './Uploads/558fb649e887b.jpg', '2', '2015-06-28 16:54:34', '2015-06-28 16:54:34');
COMMIT;

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
--  Records of `think_address`
-- ----------------------------
BEGIN;
INSERT INTO `think_address` VALUES ('1', null, '北京市海淀区XXXX', '新大洲', '010-8888888', '0000-00-00 00:00:00', '0000-00-00 00:00:00'), ('2', null, '11', '111', '111', '2015-06-08 23:10:21', '0000-00-00 00:00:00'), ('3', '2', '111', '11111', '111', '2015-06-08 23:11:00', '0000-00-00 00:00:00');
COMMIT;

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
--  Records of `think_admin`
-- ----------------------------
BEGIN;
INSERT INTO `think_admin` VALUES ('1', 'admin', 'd033e22ae348aeb5660fc2140aec35850c4da997', '2015-06-29 08:17:32', '2015-06-24 00:00:34', '2015-06-28 16:07:15', '2130706433', '1'), ('4', 'adminbbb', 'd033e22ae348aeb5660fc2140aec35850c4da997', '2015-06-06 17:45:30', '2015-06-06 17:45:30', '2015-06-06 17:45:30', '0.0.0.0', '1');
COMMIT;

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
--  Records of `think_city`
-- ----------------------------
BEGIN;
INSERT INTO `think_city` VALUES ('1', '北京', '0', '2015-06-08 23:01:52', '2015-06-08 23:01:52'), ('2', '海淀区', '1', '2015-06-08 23:02:47', '2015-06-08 23:02:47'), ('3', '朝阳区', '1', '2015-06-08 23:14:24', '2015-06-08 23:14:24'), ('4', '上海', '0', '2015-06-08 23:14:31', '2015-06-08 23:14:31'), ('5', '浦东区', '4', '2015-06-08 23:14:40', '2015-06-08 23:14:40');
COMMIT;

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
--  Records of `think_document`
-- ----------------------------
BEGIN;
INSERT INTO `think_document` VALUES ('17', '111', '<p>1111</p>', '2015-06-06 16:38:07', '2015-06-06 16:38:07'), ('18', '222', '<p>222</p>', '2015-06-06 16:38:10', '2015-06-06 16:38:10'), ('19', '3333', '<p>33333</p>', '2015-06-06 16:38:13', '2015-06-06 16:38:13'), ('20', '444', '<p>444</p>', '2015-06-06 16:38:16', '2015-06-06 16:38:16'), ('21', '44', '<p>44</p>', '2015-06-06 16:38:19', '2015-06-06 16:38:19'), ('22', '444', '<p>444</p>', '2015-06-06 16:38:22', '2015-06-06 16:38:22'), ('23', '4444', '<p>444</p>', '2015-06-06 16:38:25', '2015-06-06 16:38:25'), ('24', '4', '<p>4</p>', '2015-06-06 16:38:29', '2015-06-06 16:38:29'), ('25', '4', '<p>4</p>', '2015-06-06 16:38:31', '2015-06-06 16:38:31'), ('26', '4', '<p>4</p>', '2015-06-06 16:38:31', '2015-06-06 16:38:31'), ('27', '4', '<p>4</p>', '2015-06-06 16:38:33', '2015-06-06 16:38:33'), ('28', '4', '<p>4</p>', '2015-06-06 16:38:36', '2015-06-06 16:38:36');
COMMIT;

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
  KEY `fk_think_joiner` (`activity_id`),
  CONSTRAINT `fk_think_joiner` FOREIGN KEY (`activity_id`) REFERENCES `think_activity` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COMMENT='参加活动者';

-- ----------------------------
--  Records of `think_joiner`
-- ----------------------------
BEGIN;
INSERT INTO `think_joiner` VALUES ('1', '13', '11111', '18500402623', '2015-06-28 12:50:01', '2015-06-28 12:50:03');
COMMIT;

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
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

-- ----------------------------
--  Records of `think_keyword`
-- ----------------------------
BEGIN;
INSERT INTO `think_keyword` VALUES ('1', '111', '1111', '111', './Uploads/558d75304757a.jpg', '11', '2015-06-26 23:52:36', '2015-06-26 23:52:36');
COMMIT;

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
--  Records of `think_menu`
-- ----------------------------
BEGIN;
INSERT INTO `think_menu` VALUES ('4', '0', '产品服务', '', '2015-06-08 22:46:44', '2015-06-08 22:46:44'), ('5', '0', '品牌文化', '', '2015-06-08 22:46:53', '2015-06-08 22:46:53'), ('6', '0', '本田专家', '', '2015-06-08 22:46:59', '2015-06-08 22:46:59'), ('7', '4', ' 跨骑车', 'http://www.baidu.com', '2015-06-08 22:47:32', '2015-06-08 22:47:32'), ('8', '4', '踏板车', 'http://www.baidu.com', '2015-06-08 22:47:45', '2015-06-08 22:47:45'), ('9', '5', '安全', 'http://www.baidu.com', '2015-06-08 22:53:45', '2015-06-08 22:53:45'), ('10', '5', '环保', 'http://www.baidu.com', '2015-06-08 22:53:54', '2015-06-08 22:53:54'), ('11', '5', '乐趣', 'http://www.baidu.com', '2015-06-08 22:54:00', '2015-06-08 22:54:00'), ('12', '5', '赛道文化', 'http://www.baidu.com', '2015-06-08 22:54:07', '2015-06-08 22:54:07'), ('13', '6', '网点查询', 'http://www.baidu.com', '2015-06-08 22:54:22', '2015-06-08 22:54:22'), ('14', '6', '保养常识', 'http://www.baidu.com', '2015-06-08 22:54:29', '2015-06-08 22:54:29');
COMMIT;

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
--  Records of `think_product`
-- ----------------------------
BEGIN;
INSERT INTO `think_product` VALUES ('5', '1111', './Uploads/5573e1d5b42fc.jpg', '<p>1111</p>', '2015-06-07 14:16:54', '2015-06-07 14:16:54', '1'), ('6', '11112', './Uploads/5573e1d5b42fc.jpg', '<p>1111222</p>', '2015-06-07 14:19:47', '2015-06-07 14:23:55', '1');
COMMIT;

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

-- ----------------------------
--  Records of `think_product_class`
-- ----------------------------
BEGIN;
INSERT INTO `think_product_class` VALUES ('1', '摩托车', '2015-06-06 16:43:19', '2015-06-07 14:32:34');
COMMIT;

SET FOREIGN_KEY_CHECKS = 1;
