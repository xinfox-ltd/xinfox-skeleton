/*
 Navicat Premium Data Transfer

 Source Server         : localhost
 Source Server Type    : MySQL
 Source Server Version : 50728
 Source Host           : localhost:3306
 Source Schema         : xinfox_base_skeleton

 Target Server Type    : MySQL
 Target Server Version : 50728
 File Encoding         : 65001

 Date: 02/04/2021 18:59:09
*/

SET NAMES utf8mb4;
SET FOREIGN_KEY_CHECKS = 0;

-- ----------------------------
-- Table structure for xf_token
-- ----------------------------
DROP TABLE IF EXISTS `xf_token`;
CREATE TABLE `xf_token`  (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT COMMENT 'AUTO_ID',
  `user_id` int(10) UNSIGNED NOT NULL DEFAULT 0 COMMENT '用户ID',
  `token_id` varchar(128) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL DEFAULT '' COMMENT 'Token ID',
  `created_at` int(10) UNSIGNED NOT NULL DEFAULT 0 COMMENT '创建时间',
  PRIMARY KEY (`id`) USING BTREE,
  UNIQUE INDEX `uni_user_id`(`user_id`) USING BTREE COMMENT '用户唯一'
) ENGINE = InnoDB AUTO_INCREMENT = 2 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci COMMENT = '用户token' ROW_FORMAT = Dynamic;

-- ----------------------------
-- Table structure for xf_user
-- ----------------------------
DROP TABLE IF EXISTS `xf_user`;
CREATE TABLE `xf_user`  (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT COMMENT 'AUTO_ID',
  `wechat_open_id` varchar(64) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL DEFAULT '' COMMENT '微信OPEN_ID',
  `wechat_union_id` varchar(64) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL DEFAULT '' COMMENT '微信UNION_ID',
  `phone` bigint(20) UNSIGNED NOT NULL DEFAULT 0 COMMENT '手机',
  `password` varchar(128) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL DEFAULT '' COMMENT '密码',
  `role` tinyint(1) UNSIGNED NOT NULL DEFAULT 0 COMMENT '角色（1管理员）',
  `status` tinyint(4) NOT NULL DEFAULT 0 COMMENT '状态（1正常 -1禁用）',
  `created_at` int(10) UNSIGNED NOT NULL DEFAULT 0 COMMENT '注册时间',
  `updated_at` int(10) UNSIGNED NOT NULL DEFAULT 0 COMMENT '更新时间',
  PRIMARY KEY (`id`) USING BTREE,
  UNIQUE INDEX `uni_phone`(`phone`) USING BTREE COMMENT '手机号唯一'
) ENGINE = InnoDB AUTO_INCREMENT = 7 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci COMMENT = '用户表' ROW_FORMAT = Dynamic;

SET FOREIGN_KEY_CHECKS = 1;
