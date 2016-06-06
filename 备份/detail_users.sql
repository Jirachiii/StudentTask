/*
Navicat MySQL Data Transfer

Source Server         : MySQL1_copy
Source Server Version : 50709
Source Host           : localhost:3306
Source Database       : studenttask

Target Server Type    : MYSQL
Target Server Version : 50709
File Encoding         : 65001

Date: 2016-06-02 13:52:04
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for detail_users
-- ----------------------------
DROP TABLE IF EXISTS `detail_users`;
CREATE TABLE `detail_users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `detail_id` int(15) NOT NULL,
  `st_id` varchar(20) NOT NULL,
  PRIMARY KEY (`id`)
) TYPE=MyISAM;
