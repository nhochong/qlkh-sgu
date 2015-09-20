/*
SQLyog Ultimate v10.00 Beta1
MySQL - 5.5.24-log : Database - khcn
*********************************************************************
*/

/*!40101 SET NAMES utf8 */;

/*!40101 SET SQL_MODE=''*/;

/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;
CREATE DATABASE /*!32312 IF NOT EXISTS*/`khcn` /*!40100 DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci */;

USE `khcn`;

/*Table structure for table `account_reset` */

DROP TABLE IF EXISTS `account_reset`;

CREATE TABLE `account_reset` (
  `reset_id` varchar(32) COLLATE utf8_unicode_ci NOT NULL,
  `account_id` int(11) NOT NULL,
  `new_pass` varchar(10) COLLATE utf8_unicode_ci NOT NULL,
  `expiration` datetime NOT NULL,
  PRIMARY KEY (`reset_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

/*Table structure for table `backup` */

DROP TABLE IF EXISTS `backup`;

CREATE TABLE `backup` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `ten_file` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `loai` tinyint(4) NOT NULL,
  `ngay_tao` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

/*Table structure for table `bieu_mau` */

DROP TABLE IF EXISTS `bieu_mau`;

CREATE TABLE `bieu_mau` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `ten` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `ten_file` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `trang_thai` tinyint(4) NOT NULL DEFAULT '1',
  `ma_loai` int(11) unsigned DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

/*Table structure for table `bo_dem` */

DROP TABLE IF EXISTS `bo_dem`;

CREATE TABLE `bo_dem` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `dia_chi_ip` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `trinh_duyet` varchar(200) COLLATE utf8_unicode_ci NOT NULL,
  `thoi_gian` datetime NOT NULL,
  `url` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=2288 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

/*Table structure for table `cau_hinh` */

DROP TABLE IF EXISTS `cau_hinh`;

CREATE TABLE `cau_hinh` (
  `tu_khoa` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `noi_dung` text COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`tu_khoa`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

/*Table structure for table `dang_ky` */

DROP TABLE IF EXISTS `dang_ky`;

CREATE TABLE `dang_ky` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `ma_de_tai` int(11) NOT NULL,
  `ma_giang_vien` int(11) NOT NULL,
  `nhiem_vu` tinyint(4) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=1047 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

/*Table structure for table `de_tai` */

DROP TABLE IF EXISTS `de_tai`;

CREATE TABLE `de_tai` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `ma` varchar(15) COLLATE utf8_unicode_ci NOT NULL,
  `ten` varchar(200) COLLATE utf8_unicode_ci NOT NULL,
  `thoi_gian_bat_dau` date NOT NULL,
  `thoi_gian_hoan_thanh` date NOT NULL,
  `tinh_trang` tinyint(4) NOT NULL,
  `so_thang_gia_han` int(10) DEFAULT '0',
  `kinh_phi` decimal(50,0) DEFAULT '0',
  `cap_quan_ly` tinyint(4) NOT NULL,
  `xep_loai` tinyint(4) DEFAULT '0',
  `ma_linh_vuc` int(11) NOT NULL,
  `ma_hd_duyet` int(11) DEFAULT NULL,
  `ma_loai` int(11) DEFAULT '1',
  `ma_don_vi` int(11) NOT NULL,
  `ghi_chu` text COLLATE utf8_unicode_ci,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=268 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

/*Table structure for table `don_vi` */

DROP TABLE IF EXISTS `don_vi`;

CREATE TABLE `don_vi` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `ma` varchar(10) COLLATE utf8_unicode_ci DEFAULT NULL,
  `ten` varchar(250) COLLATE utf8_unicode_ci NOT NULL,
  `thuoc_sgu` tinyint(4) NOT NULL DEFAULT '1',
  `la_khoa` tinyint(4) NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`),
  UNIQUE KEY `ma` (`ma`)
) ENGINE=InnoDB AUTO_INCREMENT=59 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

/*Table structure for table `giang_vien` */

DROP TABLE IF EXISTS `giang_vien`;

CREATE TABLE `giang_vien` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `ma` varchar(10) COLLATE utf8_unicode_ci DEFAULT NULL,
  `ho` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `ten` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `so_dien_thoai` varchar(20) COLLATE utf8_unicode_ci DEFAULT NULL,
  `chuc_vu` varchar(200) COLLATE utf8_unicode_ci DEFAULT NULL,
  `trang_thai` tinyint(4) DEFAULT '1',
  `ma_don_vi` int(11) NOT NULL,
  `ma_hoc_vi` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `ma` (`ma`)
) ENGINE=InnoDB AUTO_INCREMENT=466 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

/*Table structure for table `hinh_anh` */

DROP TABLE IF EXISTS `hinh_anh`;

CREATE TABLE `hinh_anh` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `ten_file` varchar(200) COLLATE utf8_unicode_ci NOT NULL,
  `trang_thai` tinyint(4) NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=17 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

/*Table structure for table `hoc_vi` */

DROP TABLE IF EXISTS `hoc_vi`;

CREATE TABLE `hoc_vi` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `ma` varchar(10) COLLATE utf8_unicode_ci NOT NULL,
  `ten` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `ghi_chu` text COLLATE utf8_unicode_ci,
  PRIMARY KEY (`id`),
  UNIQUE KEY `ma` (`ma`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci COMMENT='Xem lai length cua Ghi Chu, TenChucDanh';

/*Table structure for table `hoi_dong_duyet` */

DROP TABLE IF EXISTS `hoi_dong_duyet`;

CREATE TABLE `hoi_dong_duyet` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `ma` varchar(15) COLLATE utf8_unicode_ci DEFAULT NULL,
  `ngay_thanh_lap` date DEFAULT NULL,
  `ghi_chu` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `ma` (`ma`)
) ENGINE=InnoDB AUTO_INCREMENT=26 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

/*Table structure for table `hoi_dong_nghiem_thu` */

DROP TABLE IF EXISTS `hoi_dong_nghiem_thu`;

CREATE TABLE `hoi_dong_nghiem_thu` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `ma` varchar(15) COLLATE utf8_unicode_ci NOT NULL,
  `ngay_thanh_lap` date DEFAULT NULL,
  `ma_de_tai` int(11) NOT NULL,
  `ghi_chu` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `ma` (`ma`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

/*Table structure for table `hoi_thao` */

DROP TABLE IF EXISTS `hoi_thao`;

CREATE TABLE `hoi_thao` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `chu_de` varchar(200) COLLATE utf8_unicode_ci NOT NULL,
  `cap_quan_ly` tinyint(4) NOT NULL,
  `doi_tac` varchar(200) COLLATE utf8_unicode_ci DEFAULT NULL,
  `don_vi_phu_trach` tinyint(4) NOT NULL,
  `ngay_to_chuc` date NOT NULL,
  `thong_cao_bao_chi` varchar(200) COLLATE utf8_unicode_ci DEFAULT NULL,
  `anh_trang_bia` varchar(200) COLLATE utf8_unicode_ci DEFAULT NULL,
  `trang_thai` tinyint(4) NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

/*Table structure for table `khcn_core_settings` */

DROP TABLE IF EXISTS `khcn_core_settings`;

CREATE TABLE `khcn_core_settings` (
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `value` longtext COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`name`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

/*Table structure for table `khcn_default_levels` */

DROP TABLE IF EXISTS `khcn_default_levels`;

CREATE TABLE `khcn_default_levels` (
  `level_id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `description` text COLLATE utf8_unicode_ci NOT NULL,
  `type` enum('public','user','teacher','moderator','admin') COLLATE utf8_unicode_ci NOT NULL DEFAULT 'user',
  `flag` enum('default','superadmin','public') COLLATE utf8_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`level_id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

/*Table structure for table `khcn_default_users` */

DROP TABLE IF EXISTS `khcn_default_users`;

CREATE TABLE `khcn_default_users` (
  `user_id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `email` varchar(128) COLLATE utf8_unicode_ci NOT NULL,
  `username` varchar(128) COLLATE utf8_unicode_ci DEFAULT NULL,
  `displayname` varchar(128) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `photo_id` int(11) unsigned NOT NULL DEFAULT '0',
  `password` char(32) COLLATE utf8_unicode_ci NOT NULL,
  `salt` char(64) COLLATE utf8_unicode_ci NOT NULL,
  `language` varchar(8) CHARACTER SET latin1 COLLATE latin1_general_ci NOT NULL DEFAULT 'en_US',
  `search` tinyint(1) NOT NULL DEFAULT '1',
  `level_id` int(11) unsigned NOT NULL,
  `enabled` tinyint(1) NOT NULL DEFAULT '1',
  `verified` tinyint(1) NOT NULL DEFAULT '0',
  `approved` tinyint(1) NOT NULL DEFAULT '1',
  `creation_date` datetime NOT NULL,
  `modified_date` datetime NOT NULL,
  `lastlogin_date` datetime DEFAULT NULL,
  `update_date` int(11) DEFAULT NULL,
  `view_count` int(11) unsigned NOT NULL DEFAULT '0',
  `creation_ip` varbinary(16) NOT NULL,
  `lastlogin_ip` varbinary(16) DEFAULT NULL,
  PRIMARY KEY (`user_id`),
  UNIQUE KEY `EMAIL` (`email`),
  UNIQUE KEY `USERNAME` (`username`),
  KEY `CREATION_DATE` (`creation_date`),
  KEY `search` (`search`),
  KEY `enabled` (`enabled`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

/*Table structure for table `lich_bieu` */

DROP TABLE IF EXISTS `lich_bieu`;

CREATE TABLE `lich_bieu` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `ten` varchar(200) COLLATE utf8_unicode_ci NOT NULL,
  `ten_file` varchar(200) COLLATE utf8_unicode_ci NOT NULL,
  `trang_thai` tinyint(4) NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

/*Table structure for table `lich_cong_tac` */

DROP TABLE IF EXISTS `lich_cong_tac`;

CREATE TABLE `lich_cong_tac` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `tuan` tinyint(4) NOT NULL,
  `thang` tinyint(4) NOT NULL,
  `ngay_bat_dau` date NOT NULL,
  `ngay_ket_thuc` date NOT NULL,
  `ghi_chu` text COLLATE utf8_unicode_ci,
  `trang_thai` tinyint(4) NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

/*Table structure for table `lien_ket` */

DROP TABLE IF EXISTS `lien_ket`;

CREATE TABLE `lien_ket` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `ten` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `url` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

/*Table structure for table `linh_vuc` */

DROP TABLE IF EXISTS `linh_vuc`;

CREATE TABLE `linh_vuc` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `ma` varchar(10) COLLATE utf8_unicode_ci NOT NULL,
  `ten` varchar(200) COLLATE utf8_unicode_ci NOT NULL,
  `mo_ta` text CHARACTER SET utf8,
  `ma_loai` int(11) unsigned DEFAULT '0',
  PRIMARY KEY (`id`),
  UNIQUE KEY `ma_linh_vuc` (`ma`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

/*Table structure for table `loai_bieu_mau` */

DROP TABLE IF EXISTS `loai_bieu_mau`;

CREATE TABLE `loai_bieu_mau` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `ten` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `ghi_chu` text,
  `order` int(11) unsigned DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

/*Table structure for table `loai_de_tai` */

DROP TABLE IF EXISTS `loai_de_tai`;

CREATE TABLE `loai_de_tai` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `ma` varchar(10) COLLATE utf8_unicode_ci NOT NULL,
  `ten` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `ghi_chu` text COLLATE utf8_unicode_ci,
  PRIMARY KEY (`id`),
  UNIQUE KEY `ma` (`ma`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

/*Table structure for table `loai_linh_vuc` */

DROP TABLE IF EXISTS `loai_linh_vuc`;

CREATE TABLE `loai_linh_vuc` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `ma` varchar(10) NOT NULL,
  `ten` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;

/*Table structure for table `mail_thong_bao` */

DROP TABLE IF EXISTS `mail_thong_bao`;

CREATE TABLE `mail_thong_bao` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `tieu_de` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `noi_dung` text COLLATE utf8_unicode_ci NOT NULL,
  `loai` tinyint(4) NOT NULL,
  `noi_nhan` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `ngay_goi` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

/*Table structure for table `nguoi_dung` */

DROP TABLE IF EXISTS `nguoi_dung`;

CREATE TABLE `nguoi_dung` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `ten_dang_nhap` varchar(32) COLLATE utf8_unicode_ci NOT NULL,
  `mat_khau` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `ho` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `ten` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `ngay_sinh` date NOT NULL,
  `email` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `ngay_tao` datetime NOT NULL,
  `trang_thai` tinyint(4) NOT NULL DEFAULT '1',
  `ma_quyen` tinyint(4) NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`),
  UNIQUE KEY `ten_dang_nhap` (`ten_dang_nhap`),
  UNIQUE KEY `email` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

/*Table structure for table `noi_dung_cong_tac` */

DROP TABLE IF EXISTS `noi_dung_cong_tac`;

CREATE TABLE `noi_dung_cong_tac` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `ngay` date NOT NULL,
  `sang` text COLLATE utf8_unicode_ci,
  `chieu` text COLLATE utf8_unicode_ci,
  `ghi_chu` text COLLATE utf8_unicode_ci,
  `ma_cong_tac` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=59 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

/*Table structure for table `phan_cong_duyet` */

DROP TABLE IF EXISTS `phan_cong_duyet`;

CREATE TABLE `phan_cong_duyet` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `chuc_danh` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `ma_giang_vien` int(11) NOT NULL,
  `ma_hd_duyet` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=258 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

/*Table structure for table `phan_cong_nghiem_thu` */

DROP TABLE IF EXISTS `phan_cong_nghiem_thu`;

CREATE TABLE `phan_cong_nghiem_thu` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `ma_giang_vien` int(11) NOT NULL,
  `ma_hd_nghiem_thu` int(11) NOT NULL,
  `chuc_danh` tinyint(4) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=65 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

/*Table structure for table `quan_tri` */

DROP TABLE IF EXISTS `quan_tri`;

CREATE TABLE `quan_tri` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `ten_dang_nhap` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `mat_khau` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `ho` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `ten` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `ngay_sinh` date NOT NULL,
  `email` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `ngay_tao` date NOT NULL,
  `lan_dang_nhap_cuoi` datetime DEFAULT NULL,
  `trang_thai` tinyint(4) NOT NULL DEFAULT '1',
  `ma_quyen` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `ten_dang_nhap` (`ten_dang_nhap`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

/*Table structure for table `qui_dinh` */

DROP TABLE IF EXISTS `qui_dinh`;

CREATE TABLE `qui_dinh` (
  `id` int(5) unsigned NOT NULL AUTO_INCREMENT,
  `ten` varchar(200) COLLATE utf8_unicode_ci NOT NULL,
  `ten_file` varchar(200) COLLATE utf8_unicode_ci DEFAULT NULL,
  `loai` tinyint(4) NOT NULL,
  `trang_thai` tinyint(4) NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

/*Table structure for table `quyen` */

DROP TABLE IF EXISTS `quyen`;

CREATE TABLE `quyen` (
  `id` tinyint(4) NOT NULL AUTO_INCREMENT,
  `ten` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `mo_ta` text COLLATE utf8_unicode_ci,
  `loai` enum('public','user','teacher','moderator','admin') COLLATE utf8_unicode_ci NOT NULL DEFAULT 'user',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

/*Table structure for table `thong_bao` */

DROP TABLE IF EXISTS `thong_bao`;

CREATE TABLE `thong_bao` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `tieu_de` varchar(250) COLLATE utf8_unicode_ci NOT NULL,
  `noi_dung` text COLLATE utf8_unicode_ci NOT NULL,
  `ngay_tao` datetime NOT NULL,
  `so_lan_xem` int(10) NOT NULL DEFAULT '1',
  `trang_thai` tinyint(4) NOT NULL DEFAULT '1',
  `ma_quan_tri` int(11) NOT NULL,
  `loai` tinyint(4) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=41 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

/*Table structure for table `tin_tuc` */

DROP TABLE IF EXISTS `tin_tuc`;

CREATE TABLE `tin_tuc` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `tieu_de` varchar(250) COLLATE utf8_unicode_ci NOT NULL,
  `mo_ta_tom_tat` text COLLATE utf8_unicode_ci NOT NULL,
  `mo_ta_chi_tiet` text COLLATE utf8_unicode_ci NOT NULL,
  `ngay_tao` datetime NOT NULL,
  `so_lan_xem` int(10) NOT NULL DEFAULT '1',
  `trang_thai` tinyint(4) NOT NULL DEFAULT '1',
  `hinh` varchar(200) COLLATE utf8_unicode_ci NOT NULL,
  `ma_quan_tri` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

/*Table structure for table `tuyen_sinh` */

DROP TABLE IF EXISTS `tuyen_sinh`;

CREATE TABLE `tuyen_sinh` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `ten` varchar(200) COLLATE utf8_unicode_ci NOT NULL,
  `ten_file` varchar(200) COLLATE utf8_unicode_ci NOT NULL,
  `trang_thai` tinyint(4) NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;


/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
