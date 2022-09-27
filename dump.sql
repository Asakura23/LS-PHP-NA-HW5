/*
Navicat MySQL Data Transfer

Source Server         : terrenum
Source Server Version : 50562
Source Host           : 192.168.0.1:3306
Source Database       : laravel

Target Server Type    : MYSQL
Target Server Version : 50562
File Encoding         : 65001

Date: 2022-09-25 13:25:28
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for `basket`
-- ----------------------------
DROP TABLE IF EXISTS `basket`;
CREATE TABLE `basket` (
  `b_id` bigint(75) NOT NULL AUTO_INCREMENT,
  `b_owner` int(25) NOT NULL,
  `b_good` int(25) NOT NULL,
  `b_email` varchar(250) NOT NULL,
  `b_deleted` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`b_id`)
) ENGINE=InnoDB AUTO_INCREMENT=36 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of basket
-- ----------------------------
INSERT INTO `basket` VALUES ('1', '1', '1', 'hiorirm@gmail.com', '0');
INSERT INTO `basket` VALUES ('2', '1', '6', 'hiorirm@gmail.com', '0');
INSERT INTO `basket` VALUES ('3', '2', '4', '3nochi@noch.com', '0');
INSERT INTO `basket` VALUES ('4', '2', '4', '3nochi@noch.com', '0');
INSERT INTO `basket` VALUES ('5', '2', '4', '3nochi@noch.com', '0');
INSERT INTO `basket` VALUES ('6', '3', '1', 'rrr-meow@gmail.com', '0');
INSERT INTO `basket` VALUES ('7', '3', '8', 'rrr-meow@gmail.com', '0');
INSERT INTO `basket` VALUES ('8', '1', '8', 'hiorirm@gmail.com', '0');
INSERT INTO `basket` VALUES ('9', '1', '8', 'hiorirm@gmail.com', '0');
INSERT INTO `basket` VALUES ('10', '1', '5', 'hiorirm@gmail.com', '0');
INSERT INTO `basket` VALUES ('11', '1', '4', 'hiorirm@gmail.com', '0');
INSERT INTO `basket` VALUES ('12', '1', '4', 'hiorirm@gmail.com', '0');
INSERT INTO `basket` VALUES ('13', '1', '4', 'hiorirm@gmail.com', '0');
INSERT INTO `basket` VALUES ('14', '1', '4', 'hiorirm@gmail.com', '0');
INSERT INTO `basket` VALUES ('15', '1', '4', 'hiorirm@gmail.com', '0');
INSERT INTO `basket` VALUES ('16', '1', '4', 'hiorirm@gmail.com', '0');
INSERT INTO `basket` VALUES ('17', '1', '4', 'hiorirm@gmail.com', '0');
INSERT INTO `basket` VALUES ('18', '1', '4', 'hiorirm@gmail.com', '0');
INSERT INTO `basket` VALUES ('19', '1', '4', 'hiorirm@gmail.com', '0');
INSERT INTO `basket` VALUES ('20', '1', '4', 'hiorirm@gmail.com', '0');
INSERT INTO `basket` VALUES ('21', '1', '4', 'hiorirm@gmail.com', '0');
INSERT INTO `basket` VALUES ('22', '1', '4', 'hiorirm@gmail.com', '0');
INSERT INTO `basket` VALUES ('23', '1', '4', 'hiorirm@gmail.com', '0');
INSERT INTO `basket` VALUES ('24', '1', '4', 'hiorirm@gmail.com', '0');
INSERT INTO `basket` VALUES ('25', '1', '4', 'hiorirm@gmail.com', '0');
INSERT INTO `basket` VALUES ('26', '1', '4', 'hiorirm@gmail.com', '0');
INSERT INTO `basket` VALUES ('27', '1', '4', 'hiorirm@gmail.com', '0');
INSERT INTO `basket` VALUES ('28', '1', '4', 'hiorirm@gmail.com', '0');
INSERT INTO `basket` VALUES ('29', '1', '4', 'hiorirm@gmail.com', '0');
INSERT INTO `basket` VALUES ('30', '1', '4', 'hiorirm@gmail.com', '0');
INSERT INTO `basket` VALUES ('31', '1', '4', 'hiorirm@gmail.com', '0');
INSERT INTO `basket` VALUES ('32', '1', '4', 'hiorirm@gmail.com', '0');
INSERT INTO `basket` VALUES ('33', '1', '4', 'hiorirm@gmail.com', '0');
INSERT INTO `basket` VALUES ('34', '1', '4', 'hiorirm@gmail.com', '0');
INSERT INTO `basket` VALUES ('35', '1', '4', 'hiorirm@gmail.com', '0');

-- ----------------------------
-- Table structure for `categories`
-- ----------------------------
DROP TABLE IF EXISTS `categories`;
CREATE TABLE `categories` (
  `c_id` int(10) NOT NULL AUTO_INCREMENT,
  `c_name` varchar(256) NOT NULL,
  `c_description` mediumtext NOT NULL,
  `c_deleted` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`c_id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of categories
-- ----------------------------
INSERT INTO `categories` VALUES ('1', 'Action', '', '0');
INSERT INTO `categories` VALUES ('2', 'RPG', '', '0');
INSERT INTO `categories` VALUES ('3', 'Квесты', 'Описание квестовых игр', '0');
INSERT INTO `categories` VALUES ('4', 'Онлайн-игры', 'Некое описание', '0');
INSERT INTO `categories` VALUES ('5', 'Стратегии', '', '0');
INSERT INTO `categories` VALUES ('6', 'Какая-то фигня', '', '1');

-- ----------------------------
-- Table structure for `goods`
-- ----------------------------
DROP TABLE IF EXISTS `goods`;
CREATE TABLE `goods` (
  `g_id` int(25) NOT NULL AUTO_INCREMENT,
  `g_cat` int(10) NOT NULL,
  `g_name` varchar(512) NOT NULL,
  `g_image` varchar(1024) NOT NULL,
  `g_price` int(15) NOT NULL,
  `g_description` mediumtext NOT NULL,
  `g_deleted` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`g_id`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of goods
-- ----------------------------
INSERT INTO `goods` VALUES ('1', '1', 'The Witcher 3: Wild Hunt', 'game-1.jpg', '400', 'Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum. Sed ut perspiciatis unde omnis iste natus error sit voluptatem \r\n\r\nLorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit \r\n', '0');
INSERT INTO `goods` VALUES ('2', '1', 'Overwatch', 'game-2.jpg', '400', 'Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum. Sed ut perspiciatis unde omnis iste natus error sit voluptatem \r\n\r\nLorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit \r\n', '0');
INSERT INTO `goods` VALUES ('3', '2', 'Deus Ex: Mankind Divided', 'game-3.jpg', '400', 'Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum. Sed ut perspiciatis unde omnis iste natus error sit voluptatem \r\n\r\nLorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit \r\n', '0');
INSERT INTO `goods` VALUES ('4', '3', 'World of WarCraft', 'game-4.jpg', '400', 'Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum. Sed ut perspiciatis unde omnis iste natus error sit voluptatem \r\n\r\nLorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit \r\n', '0');
INSERT INTO `goods` VALUES ('5', '3', 'Call of Duty: Black ops II', 'game-5.jpg', '400', 'Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum. Sed ut perspiciatis unde omnis iste natus error sit voluptatem \r\n\r\nLorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit \r\n', '0');
INSERT INTO `goods` VALUES ('6', '6', 'Batman', 'game-1.jpg', '400', 'Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum. Sed ut perspiciatis unde omnis iste natus error sit voluptatem \r\n\r\nLorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit \r\n', '0');
INSERT INTO `goods` VALUES ('7', '3', 'Super Mario', 'game-9.jpg', '500', '', '1');
INSERT INTO `goods` VALUES ('8', '3', 'Super Mario', 'game-9.jpg', '500', 'Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum. Sed ut perspiciatis unde omnis iste natus error sit voluptatem \r\n\r\nLorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit ', '0');

-- ----------------------------
-- Table structure for `migrations`
-- ----------------------------
DROP TABLE IF EXISTS `migrations`;
CREATE TABLE `migrations` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ----------------------------
-- Records of migrations
-- ----------------------------

-- ----------------------------
-- Table structure for `users`
-- ----------------------------
DROP TABLE IF EXISTS `users`;
CREATE TABLE `users` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `isadmin` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ----------------------------
-- Records of users
-- ----------------------------
INSERT INTO `users` VALUES ('1', 'Hiori', 'hiorirm@gmail.com', null, '$2y$10$pYTHO.aS5Vl3oA7WKStKaeV5QouiZW4lat8RiDiuCx6cS4u9l5vki', 'M4WcWymKWuVkVDedBZ14yZTePYUqtcXrXb6zH4i6n7XeRR9Nh1w24aD3YJyj', '2022-09-24 16:27:03', '2022-09-24 16:27:03', '1');
INSERT INTO `users` VALUES ('2', 'Keltery', 'rrikena@gmail.com', null, '$2y$10$5bwgpqLO2STC6f8MlDVv5.gMf4P.7th9SEp9706z7lFo.0YTHBRy.', 'peucl8E0CRs5KlIgwYFAWXZaV67TnfTAY8xCYLD2DuEqh5Yw5CSbI8VZY3ZZ', '2022-09-24 16:59:35', '2022-09-24 16:59:35', '0');
INSERT INTO `users` VALUES ('4', 'Super Mario', 'njinstead@yandex.ru', null, '$2y$10$Yhr3RWrpp4jolCzzo5A/TeYBmyD5fhoXgR9PBaRH3p.OeQxYfvdXC', null, '2022-09-25 03:15:57', '2022-09-25 03:15:57', '0');
