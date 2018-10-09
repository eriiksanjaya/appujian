/*
 Navicat Premium Data Transfer

 Source Server         : local
 Source Server Type    : MariaDB
 Source Server Version : 100134
 Source Host           : localhost:3306
 Source Schema         : appujian

 Target Server Type    : MariaDB
 Target Server Version : 100134
 File Encoding         : 65001

 Date: 09/10/2018 23:07:33
*/

SET NAMES utf8mb4;
SET FOREIGN_KEY_CHECKS = 0;

-- ----------------------------
-- Table structure for ujian_menu
-- ----------------------------
DROP TABLE IF EXISTS `ujian_menu`;
CREATE TABLE `ujian_menu`  (
  `menu_id` int(11) NOT NULL AUTO_INCREMENT,
  `menu_icon` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `menu_nama` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `menu_url` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `menu_isadmin` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `menu_isguru` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `menu_issiswa` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `menu_status` enum('0','1') CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT '1',
  `menu_sort` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  PRIMARY KEY (`menu_id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 10 CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = Compact;

-- ----------------------------
-- Records of ujian_menu
-- ----------------------------
INSERT INTO `ujian_menu` VALUES (1, 'fa fa-home', 'Beranda', '?q=beranda', '1', '1', '1', '1', NULL);
INSERT INTO `ujian_menu` VALUES (2, 'fa fa-user', 'Profil', '?q=profil', '1', '1', '1', '1', NULL);
INSERT INTO `ujian_menu` VALUES (3, 'fa fa-database', 'Master Data', '', '1', '', '', '1', NULL);
INSERT INTO `ujian_menu` VALUES (4, 'fa fa-gear', 'Pengaturan', NULL, '1', '1', NULL, '1', NULL);
INSERT INTO `ujian_menu` VALUES (5, 'fa fa-laptop', 'Tugas', NULL, NULL, '1', '', '1', NULL);
INSERT INTO `ujian_menu` VALUES (6, 'fa fa-laptop', 'Tugas', '?q=pilih-soal', NULL, NULL, '1', '1', NULL);
INSERT INTO `ujian_menu` VALUES (7, 'fa fa-clone', 'Nilai', '?q=lihat-nilai', NULL, NULL, '1', '1', NULL);
INSERT INTO `ujian_menu` VALUES (8, 'fa fa-laptop', 'Endtask', '?q=endtask', '1', '', '', '1', NULL);
INSERT INTO `ujian_menu` VALUES (9, 'fa fa-sign-out', 'Keluar', 'logout.php', '1', '1', '1', '1', NULL);

SET FOREIGN_KEY_CHECKS = 1;
