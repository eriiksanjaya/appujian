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

 Date: 12/12/2018 07:45:57

 Erik Sanjaya
 eriiksanjaya@gmail.com
 0896-7205-7180

*/

SET NAMES utf8mb4;
SET FOREIGN_KEY_CHECKS = 0;


-- ----------------------------
-- Table structure for berita
-- ----------------------------
DROP TABLE IF EXISTS `berita`;
CREATE TABLE `berita`  (
  `berita_id` int(11) NOT NULL AUTO_INCREMENT,
  `berita_judul` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `berita_konten` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL,
  `berita_createby` int(11) NULL DEFAULT NULL,
  `berita_isdelete` enum('0','1') CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT '0',
  `berita_createdate` datetime(0) NULL DEFAULT NULL,
  `berita_lastupdate` datetime(0) NULL DEFAULT NULL,
  PRIMARY KEY (`berita_id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 1 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = Compact;


-- ----------------------------
-- Table structure for learning
-- ----------------------------
DROP TABLE IF EXISTS `learning`;
CREATE TABLE `learning`  (
  `learning_id` int(11) NOT NULL AUTO_INCREMENT,
  `learning_userid` int(11) NULL DEFAULT NULL,
  `learning_kelasid` int(11) NULL DEFAULT NULL,
  `learning_mapelid` int(11) NULL DEFAULT NULL,
  `learning_judul` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `learning_konten` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL,
  `learning_isdelete` enum('0','1') CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT '0',
  `learning_createdate` datetime(0) NULL DEFAULT NULL,
  `learning_lastupdate` datetime(0) NULL DEFAULT NULL,
  PRIMARY KEY (`learning_id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 1 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = Compact;

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
  `menu_sort` int(11) NULL DEFAULT NULL,
  PRIMARY KEY (`menu_id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 12 CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = Compact;

-- ----------------------------
-- Records of ujian_menu
-- ----------------------------
INSERT INTO `ujian_menu` VALUES (1, 'fa fa-home', 'Beranda', '?q=beranda', '1', '1', '1', '1', 1);
INSERT INTO `ujian_menu` VALUES (2, 'fa fa-user', 'Profil', '?q=profil', '1', '1', '1', '1', 2);
INSERT INTO `ujian_menu` VALUES (3, 'fa fa-database', 'Master Data', '', '1', '', '', '1', 2);
INSERT INTO `ujian_menu` VALUES (4, 'fa fa-gear', 'Pengaturan', NULL, '1', '1', NULL, '1', 3);
INSERT INTO `ujian_menu` VALUES (5, 'fa fa-laptop', 'Tugas', NULL, NULL, '1', '', '1', 4);
INSERT INTO `ujian_menu` VALUES (6, 'fa fa-laptop', 'Tugas', '?q=pilih-soal', NULL, NULL, '1', '1', 6);
INSERT INTO `ujian_menu` VALUES (7, 'fa fa-clone', 'Nilai', '?q=lihat-nilai', NULL, NULL, '1', '1', 7);
INSERT INTO `ujian_menu` VALUES (8, 'fa fa-laptop', 'Endtask', '?q=endtask', '1', '', '', '1', 4);
INSERT INTO `ujian_menu` VALUES (9, 'fa fa-sign-out', 'Keluar', 'logout.php', '1', '1', '1', '1', 10);
INSERT INTO `ujian_menu` VALUES (10, 'fa fa-laptop', 'Learning', '?q=learning', NULL, '1', '1', '1', 9);
INSERT INTO `ujian_menu` VALUES (11, 'fa fa-laptop', 'Berita', '?q=berita', '1', '1', '1', '1', 10);

DROP VIEW IF EXISTS `vw_learning`;
CREATE VIEW `vw_learning` AS select `l`.`learning_id` AS `learning_id`,`l`.`learning_judul` AS `learning_judul`,`l`.`learning_konten` AS `learning_konten`,`l`.`learning_userid` AS `learning_userid`,`l`.`learning_kelasid` AS `learning_kelasid`,`l`.`learning_mapelid` AS `learning_mapelid`,`l`.`learning_isdelete` AS `learning_isdelete`,`l`.`learning_createdate` AS `learning_createdate`,`g`.`nama` AS `guru_nama`,`k`.`kelas` AS `kelas_nama`,`m`.`mata_pelajaran` AS `mapel_nama` from (((`learning` `l` left join `tb_guru` `g` on((`l`.`learning_userid` = `g`.`guru_id`))) left join `tb_kelas` `k` on((`l`.`learning_kelasid` = `k`.`kelas_id`))) left join `tb_mapel` `m` on((`l`.`learning_mapelid` = `m`.`mapel_id`)));

DROP VIEW IF EXISTS `vw_user`;
CREATE VIEW `vw_user` AS select `s`.`siswa_id` AS `user_id`,`s`.`nama` AS `nama`,`s`.`panggilan` AS `panggilan`,`k`.`kelas_id` AS `kelas_id`,`s`.`kelas_sub_id` AS `kelas_sub_id`,`s`.`id` AS `id`,`s`.`nis` AS `nomor`,'' AS `email`,`s`.`pass` AS `pass`,'siswa' AS `level` from ((`tb_siswa` `s` left join `tb_kelas_sub` `ks` on((`s`.`kelas_sub_id` = `ks`.`kelas_sub_id`))) left join `tb_kelas` `k` on((`ks`.`kelas_id` = `k`.`kelas_id`))) union select `g`.`guru_id` AS `user_id`,`g`.`nama` AS `nama`,'' AS `panggilan`,'' AS `kelas_id`,'' AS `kelas_sub_id`,'' AS `id`,`g`.`nip` AS `nomor`,'' AS `email`,`g`.`pass` AS `pass`,'guru' AS `level` from `tb_guru` `g` union select `a`.`admin_id` AS `user_id`,`a`.`nama` AS `nama`,'' AS `panggilan`,'' AS `kelas_id`,'' AS `kelas_sub_id`,'' AS `id`,'' AS `nomor`,`a`.`email` AS `email`,`a`.`pass` AS `pass`,`a`.`level` AS `level` from `tb_admin` `a`;

SET FOREIGN_KEY_CHECKS = 1;
