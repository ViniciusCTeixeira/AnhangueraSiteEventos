/*
 Navicat Premium Data Transfer

 Source Server         : Localhost MySQL
 Source Server Type    : MySQL
 Source Server Version : 80021
 Source Host           : localhost:3306
 Source Schema         : eventos

 Target Server Type    : MySQL
 Target Server Version : 80021
 File Encoding         : 65001

 Date: 12/06/2022 17:16:12
*/

SET NAMES utf8mb4;
SET FOREIGN_KEY_CHECKS = 0;

-- ----------------------------
-- Table structure for event_participants
-- ----------------------------
DROP TABLE IF EXISTS `event_participants`;
CREATE TABLE `event_participants`  (
  `id` int NOT NULL AUTO_INCREMENT,
  `created` datetime NOT NULL,
  `modified` datetime NOT NULL,
  `cert` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `status` tinyint NOT NULL DEFAULT 0,
  `event_id` int NOT NULL,
  `participant_id` int NOT NULL,
  PRIMARY KEY (`id`) USING BTREE,
  INDEX `participant_id`(`participant_id`) USING BTREE,
  INDEX `event_id`(`event_id`) USING BTREE,
  CONSTRAINT `event_participants_ibfk_1` FOREIGN KEY (`participant_id`) REFERENCES `participants` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `event_participants_ibfk_2` FOREIGN KEY (`event_id`) REFERENCES `events` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE = InnoDB CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of event_participants
-- ----------------------------

-- ----------------------------
-- Table structure for events
-- ----------------------------
DROP TABLE IF EXISTS `events`;
CREATE TABLE `events`  (
  `id` int NOT NULL AUTO_INCREMENT,
  `created` datetime NOT NULL,
  `modified` datetime NOT NULL,
  `name` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `title` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `description` longtext CHARACTER SET utf8 COLLATE utf8_general_ci NULL,
  `date_time_start` datetime NOT NULL,
  `date_time_end` datetime NOT NULL,
  `status` tinyint NOT NULL DEFAULT 0,
  `type` tinyint NOT NULL DEFAULT 0 COMMENT ' ',
  `url` text CHARACTER SET utf8 COLLATE utf8_general_ci NULL,
  `address` text CHARACTER SET utf8 COLLATE utf8_general_ci NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of events
-- ----------------------------

-- ----------------------------
-- Table structure for participants
-- ----------------------------
DROP TABLE IF EXISTS `participants`;
CREATE TABLE `participants`  (
  `id` int NOT NULL AUTO_INCREMENT,
  `created` datetime NOT NULL,
  `modified` datetime NOT NULL,
  `name` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `email` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `cpf` int NULL DEFAULT NULL,
  `ra` int NULL DEFAULT NULL,
  `type` tinyint NOT NULL DEFAULT 0 COMMENT '0 = aluno, 1 = outros',
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of participants
-- ----------------------------

-- ----------------------------
-- Table structure for speakers
-- ----------------------------
DROP TABLE IF EXISTS `speakers`;
CREATE TABLE `speakers`  (
  `id` int NOT NULL AUTO_INCREMENT,
  `created` datetime NOT NULL,
  `modified` datetime NOT NULL,
  `name` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `email` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `phone` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `img` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of speakers
-- ----------------------------

-- ----------------------------
-- Table structure for speeche_participants
-- ----------------------------
DROP TABLE IF EXISTS `speeche_participants`;
CREATE TABLE `speeche_participants`  (
  `id` int NOT NULL AUTO_INCREMENT,
  `created` datetime NOT NULL,
  `modified` datetime NOT NULL,
  `cert` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `status` tinyint NOT NULL DEFAULT 0,
  `speeche_id` int NOT NULL,
  `participant_id` int NOT NULL,
  PRIMARY KEY (`id`) USING BTREE,
  INDEX `participant_id`(`participant_id`) USING BTREE,
  INDEX `event_id`(`speeche_id`) USING BTREE,
  CONSTRAINT `speeche_participants_ibfk_1` FOREIGN KEY (`participant_id`) REFERENCES `participants` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `speeche_participants_ibfk_2` FOREIGN KEY (`speeche_id`) REFERENCES `speeches` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE = InnoDB CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of speeche_participants
-- ----------------------------

-- ----------------------------
-- Table structure for speeches
-- ----------------------------
DROP TABLE IF EXISTS `speeches`;
CREATE TABLE `speeches`  (
  `id` int NOT NULL AUTO_INCREMENT,
  `created` datetime NOT NULL,
  `modified` datetime NOT NULL,
  `name` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `title` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `description` longtext CHARACTER SET utf8 COLLATE utf8_general_ci NULL,
  `date_time_start` datetime NOT NULL,
  `date_time_stop` datetime NOT NULL,
  `status` tinyint NOT NULL COMMENT '0 = aquardando confirmação, 1 = comfirmado, 2 = concluido, 3 = cancelado',
  `type` tinyint NOT NULL DEFAULT 0 COMMENT ' ',
  `url` text CHARACTER SET utf8 COLLATE utf8_general_ci NULL,
  `address` text CHARACTER SET utf8 COLLATE utf8_general_ci NULL,
  `speaker_id` int NOT NULL,
  PRIMARY KEY (`id`) USING BTREE,
  INDEX `speaker_id`(`speaker_id`) USING BTREE,
  CONSTRAINT `speeches_ibfk_1` FOREIGN KEY (`speaker_id`) REFERENCES `speakers` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE = InnoDB AUTO_INCREMENT = 1 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of speeches
-- ----------------------------

-- ----------------------------
-- Table structure for users
-- ----------------------------
DROP TABLE IF EXISTS `users`;
CREATE TABLE `users`  (
  `id` int NOT NULL AUTO_INCREMENT,
  `created` datetime NOT NULL,
  `modified` datetime NOT NULL,
  `name` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `email` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `password` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `role` tinyint NOT NULL DEFAULT 0 COMMENT '0 = admin, 1 = user',
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 1 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of users
-- ----------------------------
INSERT INTO `users` VALUES (1, '2022-04-11 21:00:16', '2022-04-11 21:00:16', 'Admin', 'admin@gmail.com', '$2y$10$y2/oZj2h/pwmTVVDZ2P3TOvoyNt9xaNS4ZOq33FKRfmI9Tx8aF1Ca', 0);

SET FOREIGN_KEY_CHECKS = 1;
