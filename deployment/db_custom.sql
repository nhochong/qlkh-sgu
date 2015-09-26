CREATE TABLE `loai_bieu_mau` (
  `id` INT(11) UNSIGNED NOT NULL AUTO_INCREMENT,
  `ten` VARCHAR(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `ghi_chu` TEXT,
  `order` INT(11) UNSIGNED DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=INNODB AUTO_INCREMENT=1 DEFAULT CHARSET=utf8;

ALTER TABLE `bieu_mau`   
  ADD COLUMN `ma_loai` INT(11) UNSIGNED DEFAULT 0;
  
UPDATE de_tai
SET tinh_trang = (tinh_trang + 1),cap_quan_ly = (cap_quan_ly + 1);

-- 2013-01-21 Them loai linh vuc, dung trong chuc nang import de tai
CREATE TABLE `loai_linh_vuc` (
  `id` INT(11) UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` VARCHAR(255) NOT NULL,
  `ma` VARCHAR(10) NOT NULL,
  `ten` VARCHAR(255) NULL,
  PRIMARY KEY (`id`)
) ENGINE=INNODB AUTO_INCREMENT=1 DEFAULT CHARSET=utf8;

ALTER TABLE `linh_vuc`   
  ADD COLUMN `ma_loai` INT(11) UNSIGNED DEFAULT 0;
  
-- Update Table nguoi_dung
--
-- Table structure for table `nguoi_dung`
--
DROP TABLE IF EXISTS `nguoi_dung`;
CREATE TABLE `nguoi_dung` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `ten_dang_nhap` varchar(32) COLLATE utf8_unicode_ci NOT NULL,
  `ma_quyen` tinyint(4) NOT NULL DEFAULT 4,
  `giang_vien_id` INT(11) UNSIGNED NOT NULL DEFAULT 0,
  `mat_khau` char(100) COLLATE utf8_unicode_ci NOT NULL,
  `salt` char(64) COLLATE utf8_unicode_ci NOT NULL,
  `ho` varchar(128) COLLATE utf8_unicode_ci NOT NULL,
  `ten` varchar(32) COLLATE utf8_unicode_ci NOT NULL,
  `ten_hien_thi` varchar(160) COLLATE utf8_unicode_ci NOT NULL,
  `ngay_sinh` DATE NULL DEFAULT NULL,
  `email` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `ngay_tao` datetime NOT NULL,
  `enabled` tinyint(4) NOT NULL DEFAULT '1',
  `verified` tinyint(4) NOT NULL DEFAULT '1',
  `approved` tinyint(4) NOT NULL DEFAULT '1',
  `lan_dang_nhap_cuoi` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `ten_dang_nhap` (`ten_dang_nhap`),
  UNIQUE KEY `email` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

INSERT IGNORE INTO `nguoi_dung` (`id`, `ten_dang_nhap`, `ma_quyen`, `giang_vien_id`, `mat_khau`, `salt`, `ho`, `ten`, `ten_hien_thi`, `ngay_sinh`, `email`, `ngay_tao`, `lan_dang_nhap_cuoi`) 
values('1', 'admin', 1, 0, 'e10adc3949ba59abbe56e057f20f883e', '', 'Phong Khoa hoc Cong nghe', '','Phong Khoa hoc Cong nghe','2000-01-01','p_khcn@sgu.edu.vn','2012-03-02','2013-05-09 19:35:58');


--
-- Dumping data for table `quyen`
--
DROP TABLE IF EXISTS `quyen`;
CREATE TABLE `quyen` (
	`id` tinyint(4) NOT NULL auto_increment,
	`ten` varchar(100) collate utf8_unicode_ci NOT NULL,
	`mo_ta` text collate utf8_unicode_ci,
	`loai` enum('public','user','student','teacher','moderator','admin') COLLATE utf8_unicode_ci NOT NULL DEFAULT 'user', 
	PRIMARY KEY  (`id`)
)ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci; 

insert into `quyen` (`id`, `ten`, `mo_ta`, `loai`) values
('1','Administrator',NULL,'admin'),
('2','Moderator',NULL,'moderator'),
('3','Teacher',NULL,'teacher'),
('4','Member',NULL,'user'),
('5','Guest',NULL,'public'),
('6','Student',NULL,'student');


--
-- Table structure for table `permissions`
--

CREATE TABLE IF NOT EXISTS `permissions` (
  `level_id` int(11) unsigned NOT NULL,
  `type` varchar(64) COLLATE utf8_unicode_ci NOT NULL,
  `name` varchar(16) COLLATE utf8_unicode_ci NOT NULL,
  `value` tinyint(3) NOT NULL DEFAULT '0',
  `params` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`level_id`,`type`,`name`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `permissions`
--

-- ADMIN
-- admin - moderator - view
INSERT IGNORE INTO `permissions`
  SELECT
    id as `level_id`,
    'admin' as `type`,
    'view' as `name`,
    1 as `value`,
    NULL as `params`
  FROM `quyen` WHERE `loai` IN('admin', 'moderator');

-- ADMIN, MODERATOR
-- giang vien - view, create, edit, delete
INSERT IGNORE INTO `permissions`
  SELECT
    id as `level_id`,
    'giang_vien' as `type`,
    'view' as `name`,
    1 as `value`,
    NULL as `params`
  FROM `quyen` WHERE `loai` IN('admin', 'moderator'); 

INSERT IGNORE INTO `permissions`
  SELECT
    id as `level_id`,
    'giang_vien' as `type`,
    'create' as `name`,
    2 as `value`,
    NULL as `params`
  FROM `quyen` WHERE `loai` IN('admin', 'moderator'); 

INSERT IGNORE INTO `permissions`
  SELECT
    id as `level_id`,
    'giang_vien' as `type`,
    'edit' as `name`,
    2 as `value`,
    NULL as `params`
  FROM `quyen` WHERE `loai` IN('admin', 'moderator');   
  
INSERT IGNORE INTO `permissions`
  SELECT
    id as `level_id`,
    'giang_vien' as `type`,
    'delete' as `name`,
    2 as `value`,
    NULL as `params`
  FROM `quyen` WHERE `loai` IN('admin', 'moderator');  
 
-- TEACHER
-- giang vien - view, create, edit, delete
INSERT IGNORE INTO `permissions`
  SELECT
    id as `level_id`,
    'giang_vien' as `type`,
    'view' as `name`,
    1 as `value`,
    NULL as `params`
  FROM `quyen` WHERE `loai` IN('teacher');  
  
INSERT IGNORE INTO `permissions`
  SELECT
    id as `level_id`,
    'giang_vien' as `type`,
    'create' as `name`,
    1 as `value`,
    NULL as `params`
  FROM `quyen` WHERE `loai` IN('teacher'); 

INSERT IGNORE INTO `permissions`
  SELECT
    id as `level_id`,
    'giang_vien' as `type`,
    'edit' as `name`,
    1 as `value`,
    NULL as `params`
  FROM `quyen` WHERE `loai` IN('teacher');   
  
INSERT IGNORE INTO `permissions`
  SELECT
    id as `level_id`,
    'giang_vien' as `type`,
    'delete' as `name`,
    1 as `value`,
    NULL as `params`
  FROM `quyen` WHERE `loai` IN('teacher');   
  
-- USER
-- giang vien - view, create
INSERT IGNORE INTO `permissions`
  SELECT
    id as `level_id`,
    'giang_vien' as `type`,
    'view' as `name`,
    1 as `value`,
    NULL as `params`
  FROM `quyen` WHERE `loai` IN('user');  
  
INSERT IGNORE INTO `permissions`
  SELECT
    id as `level_id`,
    'giang_vien' as `type`,
    'create' as `name`,
    1 as `value`,
    NULL as `params`
  FROM `quyen` WHERE `loai` IN('user'); 

-- Cong Thong Tin Cesti 
INSERT IGNORE INTO `permissions`
  SELECT
    id as `level_id`,
    'cong_thong_tin' as `type`,
    'view' as `name`,
    1 as `value`,
    NULL as `params`
  FROM `quyen` WHERE `loai` IN('admin', 'moderator');
  
INSERT IGNORE INTO `permissions`
  SELECT
    id as `level_id`,
    'cong_thong_tin' as `type`,
    'view' as `name`,
    1 as `value`,
    NULL as `params`
  FROM `quyen` WHERE `loai` IN('teacher'); 
  
-- Xem diem thi chuyen nganh
INSERT IGNORE INTO `permissions`
  SELECT
    id as `level_id`,
    'diem_chuyen_nganh' as `type`,
    'view' as `name`,
    1 as `value`,
    NULL as `params`
  FROM `quyen` WHERE `loai` IN('admin', 'moderator');
  
INSERT IGNORE INTO `permissions`
  SELECT
    id as `level_id`,
    'diem_chuyen_nganh' as `type`,
    'view' as `name`,
    1 as `value`,
    NULL as `params`
  FROM `quyen` WHERE `loai` IN('teacher'); 
  
INSERT IGNORE INTO `permissions`
  SELECT
    id as `level_id`,
    'diem_chuyen_nganh' as `type`,
    'view' as `name`,
    1 as `value`,
    NULL as `params`
  FROM `quyen` WHERE `loai` IN('student'); 
  
-- PUBLIC
-- giang vien - view
INSERT IGNORE INTO `permissions`
  SELECT
    id as `level_id`,
    'giang_vien' as `type`,
    'view' as `name`,
    1 as `value`,
    NULL as `params`
  FROM `quyen` WHERE `loai` IN('public');  
  
-- UPdate nam cua de tai  
  
ALTER TABLE `de_tai`   
  ADD COLUMN `nam` INT(4) DEFAULT NULL;
  
UPDATE `de_tai`
SET `nam` = IF( (`ma` IS NOT NULL AND `ma` <> ''), SUBSTRING(`ma` FROM 3 FOR 4), YEAR(`thoi_gian_bat_dau`));

-- Luu tru thong tin dang ky giang vien cua nguoi dung
DROP TABLE IF EXISTS `queue`;
CREATE TABLE `queue` (
  `queue_id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `nguoi_dung_id` INT(11) UNSIGNED NOT NULL DEFAULT 0,
  `ma_giang_vien` varchar(10) COLLATE utf8_unicode_ci DEFAULT NULL,
  `ho` varchar(128) COLLATE utf8_unicode_ci NOT NULL,
  `ten` varchar(32) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `don_vi_id` int(11) NOT NULL,
  `hoc_vi_id` int(11) NOT NULL,
  `chuc_vu` varchar(200) COLLATE utf8_unicode_ci DEFAULT NULL,
  `so_dien_thoai` varchar(32) DEFAULT NULL,
  PRIMARY KEY (`queue_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

DROP TABLE IF EXISTS `setting`;
CREATE TABLE `setting` (
  `name` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `value` longtext NOT NULL,
  PRIMARY KEY  (`name`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE utf8_unicode_ci ;


-- Update table cap quan ly cua hoi thao
UPDATE `hoi_thao`
SET `cap_quan_ly` = 2
WHERE `cap_quan_ly` = 0;

UPDATE `hoi_thao`
SET `cap_quan_ly` = 4
WHERE `cap_quan_ly` = 2;

UPDATE `hoi_thao`
SET `cap_quan_ly` = 5
WHERE `cap_quan_ly` = 3;

ALTER TABLE `hoi_thao`   
  ADD COLUMN `so_luong_dai_bieu` INT(11) DEFAULT 0;
  
ALTER TABLE `hoi_thao`   
  ADD COLUMN `dia_diem` varchar(255) DEFAULT NULL;
  
ALTER TABLE `hoi_thao`   
  ADD COLUMN `mo_ta` longtext COLLATE utf8_unicode_ci DEFAULT NULL;
  
ALTER TABLE  `hoi_thao` CHANGE  `don_vi_phu_trach`  `don_vi_id` int(11) NOT NULL;

ALTER TABLE `hoi_thao`   
  ADD COLUMN `don_vi_phu_trach` text COLLATE utf8_unicode_ci DEFAULT NULL;
  
-- Bai Bao Khoa Hoc  
DROP TABLE IF EXISTS `bai_bao`;
CREATE TABLE `bai_bao` (
  `bai_bao_id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `ten` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `don_vi_id` int(11) NOT NULL,
  `thong_tin` text COLLATE utf8_unicode_ci DEFAULT NULL,
  `noi_dang` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `ngay_dang` datetime NOT NULL,
  `so` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `chi_so` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `diem_cong_trinh` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `ten_file` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `ngay_tao` datetime NOT NULL,
  `search` tinyint(1) NOT NULL DEFAULT 1,
  PRIMARY KEY (`bai_bao_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

DROP TABLE IF EXISTS `bai_bao_tac_gia`;
CREATE TABLE `bai_bao_tac_gia` (
  `tac_gia_id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `bai_bao_id` int(11) unsigned NOT NULL,
  `giang_vien_id` int(11) unsigned NOT NULL,
  `chuc_vu` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`tac_gia_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- Hop Thu Gop Y
DROP TABLE IF EXISTS `loai_gop_y`;
CREATE TABLE `loai_gop_y` (
  `id` INT(11) UNSIGNED NOT NULL AUTO_INCREMENT,
  `ten` VARCHAR(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `ghi_chu` TEXT,
  PRIMARY KEY (`id`)
) ENGINE=INNODB AUTO_INCREMENT=1 DEFAULT CHARSET=utf8;

INSERT INTO `loai_gop_y` (`id`, `ten`, `ghi_chu`) values
(1, 'Góp ý', ''),
(2, 'Thắc mắc', ''),
(3, 'Báo lỗi', '');

DROP TABLE IF EXISTS `gop_y`;
CREATE TABLE `gop_y` (
  `gop_y_id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `loai_id` INT(11) UNSIGNED NOT NULL,
  `nguoi_dung_id` INT(11) UNSIGNED NOT NULL,
  `ten` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `mo_ta` text COLLATE utf8_unicode_ci NOT NULL,
  `ngay_tao` datetime NOT NULL,
  `tinh_trang` enum('initial','pending','failure','completed') NOT NULL default 'initial',
  `ghi_chu` text COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`gop_y_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- Bo Mon
DROP TABLE IF EXISTS `bo_mon`;
CREATE TABLE `bo_mon` (
  `bo_mon_id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `don_vi_id` INT(11) UNSIGNED NOT NULL,
  `ten` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `mo_ta` text COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`bo_mon_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

ALTER TABLE `de_tai`   
  ADD COLUMN `bo_mon_id` int(11) NOT NULL DEFAULT 0;
  
-------------------- Rebuild structure of Application ----------
DROP TABLE IF EXISTS `modules`;
CREATE TABLE IF NOT EXISTS `modules` (
  `name` varchar(64) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `title` varchar(64) NOT NULL,
  `description` text NULL,
  `version` varchar(32) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `enabled` tinyint(1) NOT NULL default '0',
  `type` enum('core','standard','extra') character set utf8 collate utf8_unicode_ci NOT NULL default 'extra',
  PRIMARY KEY  (`name`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `engine4_core_modules`
--

INSERT INTO `modules` (`name`, `title`, `description`, `version`, `enabled`, `type`) VALUES
('default', 'Default', 'The Alpha and the Omega.', '4.00', 1, 'core'),
('admin', 'Admin', 'Admin - The Alpha and the Omega.', '4.00', 1, 'core');

------------------ Add field file_id to table detai ------------
ALTER TABLE `de_tai`   
  ADD COLUMN `file_tom_tat` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL;
  
-- Nghien Cuu Sinh
DROP TABLE IF EXISTS `nghien_cuu_sinh`;
CREATE TABLE `nghien_cuu_sinh` (
  `ncs_id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `nguoi_dung_id` INT(11) UNSIGNED NOT NULL,
  `giang_vien_id` INT(11) UNSIGNED NOT NULL,
  `don_vi_id` INT(11) UNSIGNED NOT NULL,
  `ho_ten` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `ngay_sinh` DATE NULL DEFAULT NULL,
  `mo_ta` text COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`ncs_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- Gioi Thieu - Nhan Su
CREATE TABLE IF NOT EXISTS `nhan_su` (
  `nhan_su_id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `ho_ten` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `chuc_vu` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `email` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `website` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `so_dien_thoai` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `ten_file` varchar(255) DEFAULT NULL,
  `order` int(4) NOT NULL DEFAULT 0,
  PRIMARY KEY (`nhan_su_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

ALTER TABLE `hinh_anh`   
  ADD COLUMN `slideshow` tinyint(1) NOT NULL DEFAULT 0;
  
CREATE TABLE `tai_lieu` (
  `tai_lieu_id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `ten` varchar(255) NOT NULL,
  `noi_dung` text COLLATE utf8_unicode_ci DEFAULT NULL,
  `ten_file` varchar(255) DEFAULT NULL,
  `ngay_tao` DATETIME NOT NULL,
  `search` tinyint(1) NOT NULL DEFAULT 1,
  PRIMARY KEY (`tai_lieu_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

DROP TABLE IF EXISTS `noi_dung_cong_tac`;
CREATE TABLE `noi_dung_cong_tac` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `ngay` date NOT NULL,
  `buoi` tinyint(4) NOT NULL DEFAULT 1,
  `noi_dung` text COLLATE utf8_unicode_ci,
  `ghi_chu` text COLLATE utf8_unicode_ci,
  `quan_trong` tinyint(1) NOT NULL DEFAULT 0,
  `ma_cong_tac` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=0 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

ALTER TABLE `tin_tuc` ADD COLUMN `thoi_gian` date NULL DEFAULT NULL;
ALTER TABLE `tin_tuc` ADD COLUMN `quan_trong` tinyint(1) NOT NULL DEFAULT 0;

UPDATE `tin_tuc`
SET `thoi_gian` = DATE(`ngay_tao`);

DROP TABLE IF EXISTS `searchtypes`;
CREATE TABLE `searchtypes` (
  `type` varchar(255) NOT NULL,
  `title` varchar(255) NOT NULL DEFAULT '',
  `enabled` tinyint(1) NOT NULL DEFAULT 1,
  `order` int(1) DEFAULT NULL,
  PRIMARY KEY (`type`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

DROP TABLE IF EXISTS `search`;
CREATE TABLE IF NOT EXISTS `search` (
  `type` varchar(32) CHARACTER SET latin1 COLLATE latin1_general_ci NOT NULL,
  `id` int(11) unsigned NOT NULL,
  `title` varchar(255) NOT NULL,
  `description` varchar(255) NOT NULL,
  `keywords` varchar(255) NOT NULL DEFAULT '',
  `hidden` varchar(255) NOT NULL DEFAULT '',
  PRIMARY KEY  (`type`,`id`),
  FULLTEXT KEY `LOOKUP` (`title`, `description`, `keywords`, `hidden`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE utf8_unicode_ci ;

ALTER TABLE `lien_ket` ADD COLUMN `ten_file` varchar(255) DEFAULT NULL;
ALTER TABLE `lien_ket` ADD COLUMN `is_sgu` tinyint(1) NOT NULL DEFAULT 1;
ALTER TABLE `lien_ket` ADD COLUMN `order` int(4) NOT NULL DEFAULT 0;

DROP TABLE IF EXISTS `chuong_trinh`;
CREATE TABLE `chuong_trinh` (
  `chuong_trinh_id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `ten` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `noi_dung` text COLLATE utf8_unicode_ci DEFAULT NULL,
  `thoi_gian` date DEFAULT NULL,
  `dia_diem` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `ngay_tao` DATETIME NOT NULL,
  `trang_thai` tinyint(1) NOT NULL DEFAULT 1,
  `search` tinyint(1) NOT NULL DEFAULT 1,
  PRIMARY KEY (`chuong_trinh_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
  
CREATE TABLE `sinh_hoat_chuyen_de` (
  `sinh_hoat_chuyen_de_id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `ten` varchar(255) NOT NULL,
  `noi_dung` text COLLATE utf8_unicode_ci DEFAULT NULL,
  `thoi_gian` date DEFAULT NULL,
  `dia_diem` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `ten_file` varchar(255) DEFAULT NULL,
  `ngay_tao` DATETIME NOT NULL,
  PRIMARY KEY (`sinh_hoat_chuyen_de_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

DROP TABLE IF EXISTS `hinh_anh_chuyen_de`;
CREATE TABLE `hinh_anh_chuyen_de` (
  `hinh_anh_chuyen_de_id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `chuyen_de_id` int(11) NOT NULL,
  `ten_file` varchar(200) COLLATE utf8_unicode_ci NOT NULL,
  `trang_thai` tinyint(4) NOT NULL DEFAULT '1',
  PRIMARY KEY (`hinh_anh_chuyen_de_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

ALTER TABLE `bieu_mau` ADD COLUMN `search` tinyint(1) NOT NULL DEFAULT 1;
ALTER TABLE `de_tai` ADD COLUMN `search` tinyint(1) NOT NULL DEFAULT 1;
ALTER TABLE `hoi_thao` ADD COLUMN `search` tinyint(1) NOT NULL DEFAULT 1;
ALTER TABLE `qui_dinh` ADD COLUMN `search` tinyint(1) NOT NULL DEFAULT 1;
ALTER TABLE `thong_bao` ADD COLUMN `search` tinyint(1) NOT NULL DEFAULT 1;
ALTER TABLE `tin_tuc` ADD COLUMN `search` tinyint(1) NOT NULL DEFAULT 1;

INSERT IGNORE INTO `searchtypes` (`type`, `title`, `order`) VALUES
('default_de_tai', 'Đề tài khoa học', 1),
('default_tin_tuc', 'Sự kiện nổi bật', 2),
('default_thong_bao', 'Thông báo', 3),
('default_hoi_thao', 'Hội thảo - Hội nghị', 4),
('default_bai_bao', 'Bài báo khoa học', 5),
('default_tai_lieu', 'Phổ biến kiến thức', 6),
('default_bieu_mau', 'Biễu mẫu', 7),
('default_qui_dinh', 'Qui Định', 8)
('default_chuong_trinh', 'Chương trình trọng điểm', 9);

DROP TABLE IF EXISTS `loai_dao_tao`;
CREATE TABLE `loai_dao_tao` (
  `loai_dao_tao_id` INT(11) UNSIGNED NOT NULL AUTO_INCREMENT,
  `ten` VARCHAR(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `ghi_chu` TEXT DEFAULT NULL,
  PRIMARY KEY (`loai_dao_tao_id`)
) ENGINE=INNODB AUTO_INCREMENT=1 DEFAULT CHARSET=utf8;

INSERT INTO `loai_dao_tao` (`loai_dao_tao_id`, `ten`) values
(1, 'Hệ cao học hợp tác Đại Học Vinh'),
(2, 'Hệ cao học Đại học Sài Gòn');

DROP TABLE IF EXISTS `chuyen_nganh`;
CREATE TABLE `chuyen_nganh` (
  `chuyen_nganh_id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `loai_dao_tao_id` int(11) NOT NULL,
  `nam` int(11) NOT NULL,
  `khoa` int(11) NOT NULL,
  `ten` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `noi_dung` text collate utf8_unicode_ci NULL DEFAULT NULL,
  PRIMARY KEY (`chuyen_nganh_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

DROP TABLE IF EXISTS `mon_chuyen_nganh`;
CREATE TABLE `mon_chuyen_nganh` (
  `mon_chuyen_nganh_id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `chuyen_nganh_id` int(11) NOT NULL,
  `ten` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`mon_chuyen_nganh_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

DROP TABLE IF EXISTS `hoc_vien`;
CREATE TABLE `hoc_vien` (
  `hoc_vien_id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `nguoi_dung_id` int(11) NOT NULL,
  `ma` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `ho` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `ten` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `ngay_sinh` DATE NULL DEFAULT NULL,
  `email` varchar(255) NOT NULL,
  `so_dien_thoai` varchar(255) NOT NULL,
  `ngay_tao` datetime NOT NULL,
  `enabled` tinyint(1) NOT NULL DEFAULT '1',
  PRIMARY KEY (`hoc_vien_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

DROP TABLE IF EXISTS `dang_ky_chuyen_nganh`;
CREATE TABLE `dang_ky_chuyen_nganh` (
  `hoc_vien_id` int(11) NOT NULL,
  `chuyen_nganh_id` int(11) NOT NULL,
  `diem` decimal(10,2) NOT NULL DEFAULT '0.00',
  `xep_loai` enum('Giỏi', 'Khá', 'Trung Bình', 'Kém') NULL DEFAULT NULL,
  PRIMARY KEY (`hoc_vien_id`, `chuyen_nganh_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

DROP TABLE IF EXISTS `diem_chuyen_nganh`;
CREATE TABLE `diem_chuyen_nganh` (
  `hoc_vien_id` int(11) NOT NULL,
  `mon_chuyen_nganh_id` int(11) NOT NULL,
  `diem` decimal(10,2) NOT NULL DEFAULT '0.00',
  PRIMARY KEY (`hoc_vien_id`, `mon_chuyen_nganh_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

ALTER TABLE `de_tai` ADD COLUMN `ngay_gia_han` date NULL DEFAULT NULL;
  
ALTER TABLE tin_tuc CHANGE hinh file varchar(255);

ALTER TABLE `tin_tuc` ADD COLUMN `noi_bat` tinyint(1) NOT NULL DEFAULT 0;

ALTER TABLE `loai_bieu_mau` ADD COLUMN `parent_id` int(11) NOT NULL DEFAULT 0;
INSERT IGNORE INTO `loai_bieu_mau` (`id`, `ten`, `ghi_chu`, `order`, `parent_id`) VALUES
(1, 'Nghiên cứu khoa học', '', 1, 0),
(2, 'Đào tạo sau đại học', '', 2, 0),
(3, 'Lý lịch Khoa học', '', 3, 0),
(4, 'Đăng ký', '', 1, 1),
(5, 'Nghiệm thu', '', 2, 1),
(6, 'Xét duyệt', '', 3, 1),
(7, 'Đề tài nghiên cứu khoa học', '', 1, 4),
(8, 'Giáo trình - Tài liệu tham khảo', '', 2, 4);

--
-- Table structure for table `ho_so`
--

CREATE TABLE IF NOT EXISTS `ho_so` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `ten` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `ten_file` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `trang_thai` tinyint(4) NOT NULL DEFAULT '1',
  `ma_loai` int(11) unsigned DEFAULT '0',
  `search` tinyint(1) NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Table structure for table `loai_ho_so`
--

CREATE TABLE IF NOT EXISTS `loai_ho_so` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `ten` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `ghi_chu` text,
  `order` int(11) unsigned DEFAULT '0',
  `parent_id` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=9 ;

--
-- Dumping data for table `loai_ho_so`
--

INSERT IGNORE INTO `loai_ho_so` (`id`, `ten`, `ghi_chu`, `order`, `parent_id`) VALUES
(1, 'Hồ sơ học Cao học', '', 1, 0),
(2, 'Hồ sơ học Nghiên cứu sinh', '', 2, 0);

UPDATE `thong_bao`
SET `loai` = `loai` + 1;

CREATE TABLE IF NOT EXISTS `loai_thong_bao` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `ten` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `ghi_chu` text,
  `order` int(11) unsigned DEFAULT '0',
  `parent_id` int(11) NOT NULL DEFAULT '0',
  `he_cao_hoc` tinyint(1) NOT NULL DEFAULT 0,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=9 ;

--
-- Dumping data for table `loai_thong_bao`
--

INSERT INTO `loai_thong_bao` (`id`, `ten`, `ghi_chu`, `order`, `parent_id`, `he_cao_hoc`) VALUES
(1, 'Nghiên cứu khoa học', '', 1, 0, 0),
(2, 'Hội nghị - Hội thảo', '', 2, 0, 0),
(3, 'Tuyển sinh', '', 3, 0, 0),
(4, 'Lịch học', '', 4, 0, 0),
(5, 'Hệ cao học Đại học Sài Gòn', '', 5, 0, 1),
(6, 'Hệ cao học liên kết Đại học Vinh', '', 6, 0, 1);

UPDATE `thong_bao`
SET `loai` = 3
WHERE `loai` = 4;

UPDATE `loai_thong_bao`
SET `ten` = 'Đào tạo sau Đại học'
WHERE `id` = 3;

DELETE FROM `loai_thong_bao` WHERE `id` = 4;

ALTER TABLE `thong_bao` ADD COLUMN `file` varchar(255) DEFAULT NULL;
ALTER TABLE `thong_bao` ADD COLUMN `quan_trong` tinyint(1) NOT NULL DEFAULT 0;
ALTER TABLE `thong_bao` ADD COLUMN `noi_bat` tinyint(1) NOT NULL DEFAULT 0;

ALTER TABLE `loai_bieu_mau` ADD COLUMN `is_dtsdh` tinyint(1) NOT NULL DEFAULT 0;

UPDATE `loai_bieu_mau`
SET `is_dtsdh` = 1
WHERE `ten` = 'Đào tạo sau đại học';


CREATE TABLE IF NOT EXISTS `he_cao_hoc` (
  `id` int(4) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(32) COLLATE utf8_unicode_ci NOT NULL,
  `ten` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8;

INSERT INTO `he_cao_hoc` (`id`, `name`, `ten`) VALUES
(1, 'dhsg', 'Hệ cao học Đại học Sài Gòn'),
(2, 'dhvinh', 'Hệ cao học liên kết Đại học Vinh');

CREATE TABLE IF NOT EXISTS `lich_hoc` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `tieu_de` varchar(250) COLLATE utf8_unicode_ci NOT NULL,
  `noi_dung` text COLLATE utf8_unicode_ci NOT NULL,
  `ngay_tao` datetime NOT NULL,
  `so_lan_xem` int(10) NOT NULL DEFAULT '1',
  `trang_thai` tinyint(4) NOT NULL DEFAULT '1',
  `he_cao_hoc` int(4) NOT NULL,
  `file` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `quan_trong` tinyint(1) NOT NULL DEFAULT '0',
  `noi_bat` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

CREATE TABLE IF NOT EXISTS `lich_thi` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `tieu_de` varchar(250) COLLATE utf8_unicode_ci NOT NULL,
  `noi_dung` text COLLATE utf8_unicode_ci NOT NULL,
  `ngay_tao` datetime NOT NULL,
  `so_lan_xem` int(10) NOT NULL DEFAULT '1',
  `trang_thai` tinyint(4) NOT NULL DEFAULT '1',
  `he_cao_hoc` int(4) NOT NULL,
  `file` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `quan_trong` tinyint(1) NOT NULL DEFAULT '0',
  `noi_bat` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

CREATE TABLE IF NOT EXISTS `danh_sach_lop` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `tieu_de` varchar(250) COLLATE utf8_unicode_ci NOT NULL,
  `noi_dung` text COLLATE utf8_unicode_ci NOT NULL,
  `ngay_tao` datetime NOT NULL,
  `so_lan_xem` int(10) NOT NULL DEFAULT '1',
  `trang_thai` tinyint(4) NOT NULL DEFAULT '1',
  `he_cao_hoc` int(4) NOT NULL,
  `file` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `quan_trong` tinyint(1) NOT NULL DEFAULT '0',
  `noi_bat` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

INSERT IGNORE INTO `loai_ho_so` (`id`, `ten`, `ghi_chu`, `order`, `parent_id`) VALUES
(3, 'Hồ sơ xin đi dự Hội thảo / Hội nghị', '', 0, 0),
(4, 'Lý lịch Khoa học', '', 3, 0);

INSERT IGNORE INTO `ho_so` (`ten`, `ten_file`, `trang_thai`, `ma_loai`, `search`)  
  SELECT
    `ten` as `ten`,
    `ten_file` as `ten_file`,
    `trang_thai` as `trang_thai`,
    4 as `ma_loai`,
    `search` as `search`
  FROM `bieu_mau` WHERE `ma_loai` = 3;

DELETE FROM `bieu_mau`
WHERE `ma_loai` = 3;
  
DELETE FROM `loai_bieu_mau`
WHERE `id` = 3;

ALTER TABLE `thong_bao` ADD COLUMN `file_pdf` varchar(255) DEFAULT NULL;
ALTER TABLE `tin_tuc` ADD COLUMN `file_pdf` varchar(255) DEFAULT NULL;