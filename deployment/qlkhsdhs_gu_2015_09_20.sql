-- phpMyAdmin SQL Dump
-- version 4.0.10.7
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Sep 20, 2015 at 09:49 PM
-- Server version: 5.5.42-cll
-- PHP Version: 5.4.31

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `qlkhsdhs_gu`
--

-- --------------------------------------------------------

--
-- Table structure for table `account_reset`
--

CREATE TABLE IF NOT EXISTS `account_reset` (
  `reset_id` varchar(32) COLLATE utf8_unicode_ci NOT NULL,
  `account_id` int(11) NOT NULL,
  `new_pass` varchar(10) COLLATE utf8_unicode_ci NOT NULL,
  `expiration` datetime NOT NULL,
  PRIMARY KEY (`reset_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `account_reset`
--

INSERT INTO `account_reset` (`reset_id`, `account_id`, `new_pass`, `expiration`) VALUES
('b3dc2aeb3642c6cf1ca1257c88f095db', 7, '790ad0d99e', '2015-02-08 07:22:19'),
('ca614a5aa98767fc761497934ede0be3', 1, '27bbb1cd2e', '2012-06-06 01:29:18'),
('e66c4e2746edfedc53da416aa1217626', 1, 'a69bbac453', '2012-06-04 01:04:51');

-- --------------------------------------------------------

--
-- Table structure for table `backup`
--

CREATE TABLE IF NOT EXISTS `backup` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `ten_file` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `loai` tinyint(4) NOT NULL,
  `ngay_tao` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=38 ;

--
-- Dumping data for table `backup`
--

INSERT INTO `backup` (`id`, `ten_file`, `loai`, `ngay_tao`) VALUES
(36, '2014_10_21_17_38_49.sql', 0, '2014-10-21 17:38:50'),
(37, '2014_11_03_09_04_26.sql', 0, '2014-11-03 09:04:28');

-- --------------------------------------------------------

--
-- Table structure for table `bai_bao`
--

CREATE TABLE IF NOT EXISTS `bai_bao` (
  `bai_bao_id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `ten` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `mo_ta` text COLLATE utf8_unicode_ci,
  `thong_tin` text COLLATE utf8_unicode_ci,
  `so_luong_thanh_vien` int(4) DEFAULT NULL,
  `thang` int(4) DEFAULT NULL,
  `nam` int(4) DEFAULT NULL,
  `dot` int(4) DEFAULT NULL,
  `ten_file` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `ngay_tao` datetime NOT NULL,
  `search` tinyint(1) NOT NULL DEFAULT '1',
  PRIMARY KEY (`bai_bao_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `bai_bao_tac_gia`
--

CREATE TABLE IF NOT EXISTS `bai_bao_tac_gia` (
  `tac_gia_id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `bai_bao_id` int(11) unsigned NOT NULL,
  `giang_vien_id` int(11) unsigned NOT NULL,
  `chuc_vu` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`tac_gia_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `bieu_mau`
--

CREATE TABLE IF NOT EXISTS `bieu_mau` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `ten` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `ten_file` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `trang_thai` tinyint(4) NOT NULL DEFAULT '1',
  `ma_loai` int(11) unsigned DEFAULT '0',
  `search` tinyint(1) NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=42 ;

--
-- Dumping data for table `bieu_mau`
--

INSERT INTO `bieu_mau` (`id`, `ten`, `ten_file`, `trang_thai`, `ma_loai`, `search`) VALUES
(8, 'Nhận xét của phản biện', '1434601965_dhsgcs-08-nhan-xet-cua-phan-bien.docx', 1, 9, 1),
(9, 'Phiếu đánh giá nghiệm thu đề tài NCKH cấp trường', '1434601985_dhsgcs-09-phieu-danh-gia-hd-nghiem-thu.docx', 1, 9, 1),
(14, 'Phiếu thẩm định giáo trình 11.1', '1413425429_phieu-diem-giao-trinh.mau-11.1.docx', 1, 10, 1),
(15, 'Bản nhận xét Giáo trình 10.1', '1413425409_mau-nhan-xet-tai-lieu.-mau-10.1.docx', 1, 10, 1),
(16, 'Biên bản buổi bảo vệ giáo trình', '1341971029_bien-ban-buoi-bao-ve-giao-trinh-mau-8.doc', 0, 10, 1),
(17, 'Bản đăng ký xét thưởng công trình khoa học', '1432721134_mauxetthuong.docx', 1, 1, 1),
(20, 'Phiếu đăng ký viết Giáo trình', '1421661171_phieu-de-xuat-viet-giao-trinh.doc', 1, 8, 1),
(21, 'Mẫu báo cáo tiến độ', '1434602079_dhsg-cs-05--bao-cao-tinh-hinh-thuc-hien-de-tai.docx', 1, 1, 1),
(22, 'Mẫu trình bày báo cáo nghiệm thu', '1434602973_mau-trinh-bay-bao-cao-nghiem-thu.doc', 1, 5, 1),
(23, 'Mẫu đăng ký đề tài NCKH', '1434602240_dhsg-cs-01--dang-ki-thuyet-minh-de-tai.docx', 1, 7, 1),
(24, 'Danh sách giới thiệu thành viên Hội đồng', '1434602270_hsg-cs-14---ds-gioi-thiue-hoi-dong.docx', 1, 5, 1),
(25, 'Bổ sung thuyết minh đề tài cấp Trường', '1434602372_dhsg-cs-04--bs-thuyat-minh-de-tai.docx', 1, 4, 1),
(26, 'Mẫu danh sách công nhận hoàn thành NCKH', '1413513629_danh-sach-cong-nhan-hoan-thanh-nckh.doc', 1, 1, 1),
(27, 'Danh sách đăng ký đề tài NCKH', '1413513659_danh-sach-dang-ky-de-tai-nckh.docx', 1, 7, 1),
(28, 'Danh sách đăng ký viết Giáo trình - TLTK', '1413513684_danh-sach-dang-ky-viet-giao-trinh---tltk.doc', 1, 8, 1),
(29, 'Mẫu đăng ký hoạt động NCKH cấp khoa', '1413877984_mau-dang-ky-hoat-dong-nckh-cap-khoa.doc', 0, 1, 1),
(30, 'Đơn xin hủy đề tài NCKH cấp trường', '1428547909_mau-don-xin-huy-de-tai-chung.doc', 1, 1, 1),
(31, 'Danh sách đăng ký đề tài', '1431588757_danhsachdangky.dhsg_nckhsv_07.docx', 1, 11, 1),
(32, 'Đề xuất Hội đồng', '1431588774_dexuathoidong.dhsg.nckh_04.docx', 1, 11, 1),
(33, 'Bản tóm tắt NCKHSV', '1431588791_bantomtat.dhsg.nckhsv_03.docx', 1, 11, 1),
(34, 'Bìa báo cáo Tổng kết', '1431588816_biabaocaotongket.2a.docx', 1, 11, 1),
(35, 'Bìa phụ NCKHSV', '1431589267_biaphu.2b.docx', 1, 11, 1),
(36, 'Thuyết minh đề tài NCKHSV', '1433492083_thuyetminh.dhsg.nckhsv_01.docx', 1, 11, 1),
(37, 'Hướng dẫn trình bàybáo cáo', '1431589306_huongdantrinhbaybaocao.docx', 1, 11, 1),
(38, 'Quy trình tổ chức và tiến độ triển khai hoạt động nghiên cứu khoa học của sinh viên năm học 2015-2016', '1432609378_quy-trinh-hoat-dong-nckhsv.docx', 1, 11, 1),
(39, 'Trang bia trước khi nghiệm thu', '1434603015_djhsg-cs-12-trang-bia-truoc-nghiem-thu.docx', 1, 5, 1),
(40, 'Trang bìa sau khi nghiệm thu', '1434603031_dhsg-cs-13-trang-bia-sau-nghiem-thu.docx', 1, 5, 1),
(41, 'Đơn xin gia hạn đề tài NCKH', '1440555036_dhsg-cs-07--don-xin-gia-han-de-tai.docx', 1, 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `bo_dem`
--

CREATE TABLE IF NOT EXISTS `bo_dem` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `dia_chi_ip` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `trinh_duyet` varchar(200) COLLATE utf8_unicode_ci NOT NULL,
  `thoi_gian` datetime NOT NULL,
  `url` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `bo_mon`
--

CREATE TABLE IF NOT EXISTS `bo_mon` (
  `bo_mon_id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `don_vi_id` int(11) unsigned NOT NULL,
  `ten` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `mo_ta` text COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`bo_mon_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `cau_hinh`
--

CREATE TABLE IF NOT EXISTS `cau_hinh` (
  `tu_khoa` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `noi_dung` text COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`tu_khoa`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `cau_hinh`
--

INSERT INTO `cau_hinh` (`tu_khoa`, `noi_dung`) VALUES
('domain', 'http://khcnsgu.com'),
('gioi_thieu', '<p style="text-align: center">\r\n	&nbsp;<strong><font color="#0000ff" size="6">PH&Ograve;NG KHOA HỌC&nbsp;C&Ocirc;NG NGHỆ</font></strong></p>\r\n<div align="center" style="margin-top: 0px; margin-bottom: 0px">\r\n	&nbsp;</div>\r\n<div style="text-align: left; margin-top: 0px; margin-bottom: 0px">\r\n	<span style="font-size: 18px"><strong><span style="font-family: ''Times New Roman''">&nbsp; &nbsp;- Chi tiết li&ecirc;n lạc</span></strong></span></div>\r\n<div style="text-align: left">\r\n	<span style="font-size: 18px">&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;</span><span style="font-size: 18px">&nbsp;</span><span style="color: rgb(128,0,128)"><span style="font-size: 18px"><span style="font-family: ''Times New Roman''">Địa chỉ:</span></span></span><span style="font-size: 13pt"><span style="font-family: ''Times New Roman''"> - Ph&ograve;ng C011 - Trường Đại học S&agrave;i G&ograve;n, 273 An Dương Vương, Phường 3, Quận 5, TP.HCM</span></span></div>\r\n<div style="text-align: left; margin-top: 0px; margin-bottom: 0px">\r\n	<span style="font-size: 18px"><span style="font-family: ''Times New Roman''">&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; <span style="color: rgb(128,0,128)">Điện thoại:</span><strong><span style="color: rgb(128,0,128)"> </span>&nbsp;(08) 8.354.271 &nbsp;</strong> &nbsp;Số nội bộ: </span><strong><span style="font-family: ''Times New Roman''">166&nbsp;</span></strong></span></div>\r\n<div style="text-align: left; margin-top: 0px; margin-bottom: 0px">\r\n	<span style="font-size: 18px"><span style="font-family: ''Times New Roman''">&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;<span style="color: rgb(128,0,128)"> Email: </span></span><strong><span style="font-family: ''Times New Roman''"> <a href="mailto:p_khcn@sgu.edu.vn">p_khcn@sgu.edu.vn</a> </span></strong></span></div>\r\n<div style="text-align: left; margin-top: 0px; margin-bottom: 0px">\r\n	&nbsp;</div>\r\n<div style="text-align: left; margin-top: 0px; margin-bottom: 0px">\r\n	<strong><span style="font-size: 18px"><span style="font-family: ''Times New Roman''">&nbsp; - Chức năng &nbsp;</span></span></strong></div>\r\n<div style="text-align: left; margin-top: 0px; margin-bottom: 0px">\r\n	<span style="font-size: 13pt"><span style="font-family: ''Times New Roman''">&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; + Tham mưu v&agrave; gi&uacute;p Hiệu trưởng trong việc quản l&iacute;, đề xuất, tổ chức thực hiện v&agrave; tổng kết c&aacute;c hoạt động khoa học - c&ocirc;ng nghệ của Trường</span></span></div>\r\n<div style="text-align: left; margin-top: 0px; margin-bottom: 0px">\r\n	<span style="font-size: 13pt"><span style="font-family: ''Times New Roman''">&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; + Tư vấn v&agrave; gi&uacute;p Hiệu trưởng trong việc quản l&iacute;, tổ chức đ&agrave;o tạo bậc sau đại học theo kế hoạch của Trường</span></span></div>\r\n<div style="text-align: left; margin-top: 0px; margin-bottom: 0px">\r\n	&nbsp;</div>\r\n<div style="text-align: left; margin-top: 0px; margin-bottom: 0px">\r\n	<strong><span style="font-size: 18px"><span style="font-family: ''Times New Roman''">&nbsp; - Nhiệm vụ</span></span></strong></div>\r\n<div style="text-align: left; margin-top: 0px; margin-bottom: 0px">\r\n	<span style="font-size: 13pt"><span style="font-family: ''Times New Roman''">&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; + X&acirc;y dựng nhiệm vụ, kế hoạch hoạt động khoa học &ndash; c&ocirc;ng nghệ của Trường</span></span></div>\r\n<div style="text-align: left; margin-top: 0px; margin-bottom: 0px">\r\n	<span style="font-size: 13pt"><span style="font-family: ''Times New Roman''">&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; + Quản l&iacute; c&ocirc;ng t&aacute;c nghi&ecirc;n cứu, th&ocirc;ng tin về khoa học - c&ocirc;ng nghệ; tổ chức nghiệm thu, đ&aacute;nh gi&aacute; c&aacute;c c&ocirc;ng tr&igrave;nh nghi&ecirc;n cứu khoa học; hướng dẫn, tổ chức v&agrave; theo d&otilde;i c&aacute;c hội nghị, hội thảo khoa học; tổ chức việc tham gia c&aacute;c giải thưởng khoa học, c&ocirc;ng nghệ trong nước&nbsp;</span></span></div>\r\n<div style="text-align: left; margin-top: 0px; margin-bottom: 0px">\r\n	<span style="font-size: 13pt"><span style="font-family: ''Times New Roman''">&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; + Đề xuất phương &aacute;n, tổ chức thực hiện việc li&ecirc;n kết hợp t&aacute;c nghi&ecirc;n cứu khoa học - c&ocirc;ng nghệ với c&aacute;c địa phương, với c&aacute;c trường đại học v&agrave; c&aacute;c viện nghi&ecirc;n cứu&nbsp;</span></span></div>\r\n<div style="text-align: left; margin-top: 0px; margin-bottom: 0px">\r\n	<span style="font-size: 13pt"><span style="font-family: ''Times New Roman''">&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; + Đề xuất c&aacute;c đối t&aacute;c li&ecirc;n kết đ&agrave;o tạo; quản l&iacute; v&agrave; tổ chức c&aacute;c lớp sau đại học</span></span></div>\r\n<div style="text-align: left; margin-top: 0px; margin-bottom: 0px">\r\n	&nbsp;</div>\r\n<div style="text-align: left; margin-top: 0px; margin-bottom: 0px">\r\n	<div style="margin-top: 0px; margin-bottom: 0px">\r\n		<strong><span style="font-size: 18px"><span style="font-family: ''Times New Roman''">&nbsp; - Cơ cấu tổ chức &ndash; Nh&acirc;n sự</span></span></strong></div>\r\n	<div style="margin-top: 0px; margin-bottom: 0px">\r\n		<span style="font-size: 18px">&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; +</span><span style="font-size: 18px">&nbsp;</span><span style="font-size: 18px"><span style="font-family: ''Times New Roman''">L&atilde;nh đạo</span></span></div>\r\n	<div style="margin-top: 0px; margin-bottom: 0px">\r\n		&nbsp;</div>\r\n	<div style="margin-top: 0px; margin-bottom: 0px">\r\n		&nbsp;</div>\r\n	<div style="text-align: center; margin-top: 0px; margin-bottom: 0px">\r\n		<div align="center">\r\n			<table border="1" cellpadding="0" cellspacing="0" class="MsoTableGrid" style="border-bottom-style: none; border-right-style: none; border-top-style: none; border-left-style: none; border-image: initial">\r\n				<tbody>\r\n					<tr style="height: 24.8pt; mso-yfti-irow: 0; mso-yfti-firstrow: yes">\r\n						<td style="border-bottom: windowtext 1pt solid; border-left: windowtext 1pt solid; padding-bottom: 0cm; padding-left: 5.4pt; width: 242.4pt; padding-right: 5.4pt; background: #b6dde8; height: 24.8pt; border-top: windowtext 1pt solid; border-right: windowtext 1pt solid; padding-top: 0cm; mso-border-alt: solid windowtext .5pt; mso-background-themecolor: accent5; mso-background-themetint: 102" width="323">\r\n							<p align="center" class="MsoNormal" style="text-align: center">\r\n								<span style="font-size: 20px"><span style="font-family: ''Times New Roman''"><strong>TRƯỞNG PH&Ograve;NG</strong></span></span><o:p></o:p></p>\r\n						</td>\r\n						<td style="border-bottom: windowtext 1pt solid; border-left: medium none; padding-bottom: 0cm; padding-left: 5.4pt; width: 250.15pt; padding-right: 5.4pt; background: #b6dde8; height: 24.8pt; border-top: windowtext 1pt solid; border-right: windowtext 1pt solid; padding-top: 0cm; mso-border-alt: solid windowtext .5pt; mso-background-themecolor: accent5; mso-background-themetint: 102; mso-border-left-alt: solid windowtext .5pt" width="334">\r\n							<p align="center" class="MsoNormal" style="text-align: center">\r\n								<span style="font-size: 20px"><span style="font-family: ''Times New Roman''"><strong>PH&Oacute; TRƯỞNG PH&Ograve;NG</strong></span></span><span style="font-family: &quot;Times New Roman&quot;,&quot;serif&quot;; font-size: 13pt"><o:p></o:p></span></p>\r\n						</td>\r\n					</tr>\r\n					<tr>\r\n						<td style="border-bottom: windowtext 1pt solid; border-left: windowtext 1pt solid; padding-bottom: 0cm; padding-left: 5.4pt; width: 242.4pt; padding-right: 5.4pt; border-top: medium none; border-right: windowtext 1pt solid; padding-top: 0cm; mso-border-alt: solid windowtext .5pt; mso-border-top-alt: solid windowtext .5pt" valign="top" width="323">\r\n							<p align="center" class="MsoNormal" style="text-align: center; margin-top: 6pt">\r\n								<span style="font-size: 18px"><span style="font-family: ''Times New Roman''"><b>PGS.TS. V&Otilde; VĂN LỘC</b></span></span><b><span style="font-family: &quot;Times New Roman&quot;,&quot;serif&quot;"><o:p></o:p></span></b></p>\r\n							<p align="center" class="MsoNormal" style="text-align: center; margin-top: 6pt">\r\n								<o:p>&nbsp;</o:p><img alt="" border="0" height="214" src="http://sgu.edu.vn/images/hinhld/T_Loc.jpg" width="150" /></p>\r\n							<p align="center" class="MsoNormal" style="text-align: center">\r\n								<span style="font-size: 16px"><span style="font-family: Arial">Điện thoại: 0903984101</span></span><span style="font-family: &quot;Times New Roman&quot;,&quot;serif&quot;; font-size: 13pt"><o:p></o:p></span></p>\r\n							<p align="center" class="MsoNormal" style="text-align: center; margin-bottom: 6pt">\r\n								<span style="font-size: 16px"><span style="font-family: Arial"><a href="mailto:loc@sgu.edu.vn">loc@sgu.edu.vn</a></span></span><span style="font-family: &quot;Times New Roman&quot;,&quot;serif&quot;; font-size: 13pt"><o:p></o:p></span></p>\r\n						</td>\r\n						<td style="border-bottom: windowtext 1pt solid; border-left: medium none; padding-bottom: 0cm; padding-left: 5.4pt; width: 250.15pt; padding-right: 5.4pt; border-top: medium none; border-right: windowtext 1pt solid; padding-top: 0cm; mso-border-alt: solid windowtext .5pt; mso-border-left-alt: solid windowtext .5pt; mso-border-top-alt: solid windowtext .5pt" valign="top" width="334">\r\n							<p align="center" class="MsoNormal" style="text-align: center; margin-top: 6pt">\r\n								<span style="font-size: 18px"><span style="font-family: ''Times New Roman''"><b>ThS. NGUYỄN THỊ MINH HẰNG</b></span></span><b><span style="font-family: &quot;Times New Roman&quot;,&quot;serif&quot;; font-size: 13pt"><o:p></o:p></span></b></p>\r\n							<p align="center" class="MsoNormal" style="text-align: center; margin-top: 6pt">\r\n								<b><span style="font-family: &quot;Times New Roman&quot;,&quot;serif&quot;; font-size: 13pt"><o:p>&nbsp;</o:p></span></b></p>\r\n							<p align="center" class="MsoNormal" style="text-align: center; margin-top: 6pt">\r\n								<b><span style="font-family: &quot;Times New Roman&quot;,&quot;serif&quot;; font-size: 13pt"><o:p>&nbsp;</o:p></span></b></p>\r\n							<p align="center" class="MsoNormal" style="text-align: center; margin-top: 6pt">\r\n								&nbsp;</p>\r\n							<p align="center" class="MsoNormal" style="text-align: center; margin-top: 6pt">\r\n								&nbsp;</p>\r\n							<p align="center" class="MsoNormal" style="text-align: center; margin-top: 6pt">\r\n								&nbsp;</p>\r\n							<p align="center" class="MsoNormal" style="text-align: center; margin-top: 6pt">\r\n								<b><span style="font-family: &quot;Times New Roman&quot;,&quot;serif&quot;; font-size: 13pt"><o:p>&nbsp;</o:p></span></b></p>\r\n							<p align="center" class="MsoNormal" style="text-align: center; margin-top: 6pt">\r\n								<b><span style="font-family: &quot;Times New Roman&quot;,&quot;serif&quot;; font-size: 13pt"><o:p>&nbsp;</o:p></span></b></p>\r\n							<p align="center" class="MsoNormal" style="text-align: center">\r\n								<span style="font-size: 16px"><span style="font-family: Arial">Điện thoại: 0983969775</span></span><span style="font-family: &quot;Times New Roman&quot;,&quot;serif&quot;; font-size: 13pt"><o:p></o:p></span></p>\r\n							<p align="center" class="MsoNormal" style="text-align: center; margin-bottom: 6pt">\r\n								<span style="font-size: 16px"><span style="font-family: Arial"><a href="mailto:nguyenthiminhhang1963@gmail.com">nguyenthiminhhang1963@gmail.com</a></span></span><span style="font-family: &quot;Times New Roman&quot;,&quot;serif&quot;; font-size: 13pt"><o:p></o:p></span></p>\r\n						</td>\r\n					</tr>\r\n				</tbody>\r\n			</table>\r\n		</div>\r\n	</div>\r\n</div>\r\n<div style="text-align: left; margin-top: 0px; margin-bottom: 0px">\r\n	<div align="center">\r\n		&nbsp;</div>\r\n	<p>\r\n		<span style="font-size: 18px"><span style="font-family: ''Times New Roman''"><span style="text-align: left">&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; +</span><span style="text-align: left">&nbsp;&nbsp;</span></span></span><a href="http://www.sgu.edu.vn/index.php?option=com_content&amp;view=article&amp;id=407" target="_blank"><span style="font-size: 18px"><span style="font-family: ''Times New Roman''"><strong><font color="#800080">Danh s&aacute;ch c&aacute;n bộ, chuy&ecirc;n vi&ecirc;n.</font></strong>&nbsp;</span></span></a><span style="font-size: 18px"><span style="font-family: ''Times New Roman''">&nbsp;</span></span></p>\r\n	<p>\r\n		<span style="color: rgb(153,0,51)"><strong><span style="font-size: 16px"><span style="font-family: Arial">&nbsp; &nbsp;HOẠT ĐỘNG KHOA HỌC&nbsp;</span></span></strong></span></p>\r\n	<p style="text-align: center">\r\n		<span style="font-size: 16px"><strong><span style="font-size: 20px"><span style="font-family: ''Times New Roman''">NHIỆM VỤ KHOA HỌC - C&Ocirc;NG NGHỆ NĂM HỌC 2011-2012</span></span></strong></span></p>\r\n	<p style="text-align: center">\r\n		<strong><span style="font-size: 20px"><span style="font-family: ''Times New Roman''">V&Agrave; C&Aacute;C NĂM KẾ TIẾP</span></span></strong></p>\r\n	<p>\r\n		&nbsp;</p>\r\n	<p>\r\n		<span style="font-size: 16px"><span style="font-family: Arial">&nbsp; &nbsp; &nbsp; &nbsp; &nbsp;- Căn cứ v&agrave;o thực tiễn hoạt động khoa học - c&ocirc;ng nghệ (KHCN) của Trường Đại học S&agrave;i G&ograve;n c&aacute;c năm qua; &nbsp;</span></span></p>\r\n	<p>\r\n		<span style="font-family: Arial; font-size: 16px">&nbsp; &nbsp; &nbsp; &nbsp; &nbsp;</span><span style="font-size: 16px"><span style="font-family: Arial">- Nhằm mục đ&iacute;ch:<span class="Apple-tab-span" style="white-space: pre"> </span></span></span></p>\r\n	<p>\r\n		<span style="font-size: 16px"><span style="font-family: Arial">+ Thống nhất c&ocirc;ng t&aacute;c quản l&iacute;, tổ chức hoạt động nghi&ecirc;n cứu v&agrave; ứng dụng KHCN trong Trường Đại học S&agrave;i G&ograve;n;&nbsp;</span></span></p>\r\n	<p style="text-align: justify">\r\n		<span style="font-size: 16px"><span style="font-family: Arial">+ Tiếp tục n&acirc;ng cao chất lượng đ&agrave;o tạo, hoạt động nghi&ecirc;n cứu khoa học v&agrave; ứng dụng c&ocirc;ng nghệ; từng bước tiếp cận v&agrave; vận dụng c&aacute;c phương ph&aacute;p nghi&ecirc;n cứu khoa học mới, ti&ecirc;n tiến; đồng thời ứng dụng c&aacute;c kết quả, th&agrave;nh tựu đ&atilde; nghi&ecirc;n cứu để giải quyết một số vấn đề của khoa học v&agrave; thực tiễn trong gi&aacute;o dục v&agrave; đ&agrave;o tạo của nh&agrave; trường v&agrave; x&atilde; hội;</span></span></p>\r\n	<p>\r\n		<span style="font-size: 16px"><span style="font-family: Arial">+ Tạo tiền đề cho hoạt động KHCN của Trường Đại học S&agrave;i G&ograve;n ổn định v&agrave;&nbsp;</span></span><span style="font-size: 16px"><span style="font-family: Arial">ph&aacute;t triển;&nbsp;</span></span></p>\r\n	<p>\r\n		<span style="font-size: 16px"><span style="font-family: Arial">Trường Đại học S&agrave;i G&ograve;n triển khai nhiệm vụ hoạt động KHCN năm học 2011 &ndash; 2012 v&agrave; c&aacute;c năm kế tiếp như sau:<span class="Apple-tab-span" style="white-space: pre"> </span></span></span></p>\r\n	<p>\r\n		<span style="font-size: 16px"><strong><span style="font-family: Arial">1. Nhiệm vụ chung</span></strong></span></p>\r\n	<p>\r\n		<span style="font-size: 16px"><span style="font-family: Arial">a. Từng bước nghi&ecirc;n cứu x&acirc;y dựng triết l&iacute; gi&aacute;o dục &nbsp;- &nbsp;đ&agrave;o tạo của Trường v&agrave; của ng&agrave;nh;</span></span></p>\r\n	<p style="text-align: justify">\r\n		<span style="font-size: 16px"><span style="font-family: Arial">b. Kiện to&agrave;n bộ m&aacute;y hoạt động KHCN to&agrave;n trường v&agrave; ph&aacute;t huy hiệu quả c&aacute;c Hội đồng Khoa học v&agrave; Đ&agrave;o tạo cấp trường v&agrave; cấp đơn vị thuộc Trường;&nbsp;</span></span></p>\r\n	<p style="text-align: justify">\r\n		<span style="font-size: 16px"><span style="font-family: Arial">c. Tổ chức tổng kết hoạt động nghi&ecirc;n cứu khoa học (NCKH) 5 năm giai đoạn 2007 &ndash; 2012, khen thưởng c&aacute;c đơn vị v&agrave; c&aacute; nh&acirc;n c&oacute; th&agrave;nh t&iacute;ch ti&ecirc;u biểu trong lĩnh vực n&agrave;y;</span></span></p>\r\n	<p>\r\n		<span style="font-size: 16px"><span style="font-family: Arial">d. Đề xuất thực hiện Tuyển tập &ldquo;Đại học S&agrave;i G&ograve;n tuổi l&ecirc;n năm&rdquo; nh&acirc;n kỉ niệm 5 năm th&agrave;nh lập Trường;&nbsp;</span></span></p>\r\n	<p>\r\n		<span style="font-size: 16px"><span style="font-family: Arial">đ. Tổng hợp v&agrave; c&ocirc;ng khai tr&ecirc;n website của Trường danh mục đề t&agrave;i KHCN của Trường;</span></span></p>\r\n	<p style="text-align: justify">\r\n		<span style="font-size: 16px"><span style="font-family: Arial">e. N&acirc;ng cao chất lượng hoạt động tổ chức đăng k&iacute; v&agrave; nghiệm thu c&aacute;c đề t&agrave;i, c&aacute;c c&ocirc;ng tr&igrave;nh khoa học cấp cơ sở, c&aacute;c hoạt động hội thảo, hội nghị khoa học trong Trường;</span></span></p>\r\n	<p>\r\n		<span style="font-size: 16px"><span style="font-family: Arial">g. Tạo điều kiện t&iacute;ch cực cho c&aacute;n bộ - giảng vi&ecirc;n c&oacute; cơ hội tham dự hội nghị, hội thảo khoa học trong nước v&agrave; quốc tế;</span></span></p>\r\n	<p style="text-align: justify">\r\n		<span style="font-size: 16px"><span style="font-family: Arial">h. Kịp thời giải quyết chế độ cho c&aacute;c c&aacute;n bộ - giảng vi&ecirc;n c&oacute; c&ocirc;ng tr&igrave;nh khoa học được c&ocirc;ng bố tr&ecirc;n c&aacute;c tạp ch&iacute; khoa học c&oacute; uy t&iacute;n trong nước v&agrave; quốc tế;&nbsp;</span></span></p>\r\n	<p>\r\n		<span style="font-size: 16px"><span style="font-family: Arial">i. Hợp t&aacute;c nghi&ecirc;n cứu v&agrave; chuyển giao c&ocirc;ng nghệ c&aacute;c c&ocirc;ng tr&igrave;nh khoa học hợp t&aacute;c giữa trường với c&aacute;c cơ sở sản xuất, doanh nghiệp;</span></span></p>\r\n	<p style="text-align: justify">\r\n		<span style="font-size: 16px"><span style="font-family: Arial">k. C&oacute; kế hoạch hợp t&aacute;c với c&aacute;c cơ sở gi&aacute;o dục trong v&agrave; ngo&agrave;i nước để tổ chức c&aacute;c hoạt động chuy&ecirc;n m&ocirc;n, trao đổi giảng vi&ecirc;n &ndash; sinh vi&ecirc;n, tham quan thực tế&hellip;</span></span></p>\r\n	<p>\r\n		<span style="font-size: 16px"><span style="font-family: Arial">l. Khuyến kh&iacute;ch c&aacute;n bộ - giảng vi&ecirc;n tăng cường đăng k&iacute; đề t&agrave;i NCKH cấp Th&agrave;nh phố, cấp Bộ, cấp Nh&agrave; nước.</span></span></p>\r\n	<p>\r\n		<span style="font-size: 16px"><strong><span style="font-family: Arial">2. Nhiệm vụ của c&aacute;c đơn vị (Khoa/ Bộ m&ocirc;n)</span></strong></span></p>\r\n	<p>\r\n		<span style="font-size: 16px"><span style="font-family: Arial">a. Tiếp tục nghi&ecirc;n cứu v&agrave; cải tiến chương tr&igrave;nh đ&agrave;o tạo nhằm đ&aacute;p ứng được y&ecirc;u cầu ng&agrave;y c&agrave;ng cao của x&atilde; hội;</span></span></p>\r\n	<p>\r\n		<span style="font-size: 16px"><span style="font-family: Arial">b. Từng bước nghi&ecirc;n cứu x&acirc;y dựng triết l&iacute; gi&aacute;o dục &ndash; đ&agrave;o tạo của ng&agrave;nh;</span></span></p>\r\n	<p style="text-align: justify">\r\n		<span style="font-size: 16px"><span style="font-family: Arial">c. Những đơn vị chưa tổ chức hội nghị, hội thảo khoa học từ năm 2008 &ndash; 2011 th&igrave; cần nghi&ecirc;n cứu nội dung, y&ecirc;u cầu chuy&ecirc;n m&ocirc;n để tổ chức, qua đ&oacute; đ&uacute;c r&uacute;t kinh nghiệm, đẩy mạnh hoạt động KHCN, viết gi&aacute;o tr&igrave;nh, t&agrave;i liệu tham khảo, triển khai nhiều phương thức để ứng dụng th&agrave;nh tựu của khoa học v&agrave; c&ocirc;ng nghệ v&agrave;o hoạt động đ&agrave;o tạo. Những đơn vị đ&atilde; tổ chức hội thảo, hội nghị cần tiếp tục vận dụng, n&acirc;ng cao hiệu quả nghi&ecirc;n cứu;</span></span></p>\r\n	<p style="text-align: justify">\r\n		<span style="font-size: 16px"><span style="font-family: Arial">d. X&aacute;c định những trọng t&acirc;m của chuy&ecirc;n m&ocirc;n để đẩy mạnh việc x&acirc;y dựng đề t&agrave;i nghi&ecirc;n cứu, viết gi&aacute;o tr&igrave;nh, t&agrave;i liệu phục vụ dạy v&agrave; học. Thực hiện &ldquo;2 gắn&rdquo;: gắn đổi mới phương ph&aacute;p dạy học với NCKH (PPDH + NCKH); khuyến kh&iacute;ch giảng vi&ecirc;n viết v&agrave; c&ocirc;ng bố b&agrave;i b&aacute;o khoa học, tham gia viết gi&aacute;o tr&igrave;nh;</span></span></p>\r\n	<p>\r\n		<span style="font-size: 16px"><span style="font-family: Arial">đ. Ph&acirc;n c&ocirc;ng giảng vi&ecirc;n (c&oacute; tr&igrave;nh độ sau đại học) lần lượt thực hiện chương tr&igrave;nh&nbsp;</span></span></p>\r\n	<p>\r\n		<span style="font-size: 16px"><span style="font-family: Arial">E-Learning theo kế hoạch của Trường;</span></span></p>\r\n	<p style="text-align: justify">\r\n		<span style="font-size: 16px"><span style="font-family: Arial">e. Tăng cường chặt chẽ hơn nữa mối quan hệ giữa đơn vị đ&agrave;o tạo với cơ sở sản xuất, doanh nghiệp, cơ sở gi&aacute;o dục kh&ocirc;ng chỉ tạo điều kiện cho sinh vi&ecirc;n thực h&agrave;nh m&agrave; c&ograve;n hợp t&aacute;c NCKH, chuyển giao c&ocirc;ng nghệ;&nbsp;</span></span></p>\r\n	<p>\r\n		<span style="font-size: 16px"><span style="font-family: Arial">g. Quan t&acirc;m đến chất lượng học tập, r&egrave;n luyện phẩm chất đạo đức v&agrave; năng lực tự học, tự nghi&ecirc;n cứu của sinh vi&ecirc;n.</span></span></p>\r\n	<p>\r\n		<span style="font-size: 16px"><strong><span style="font-family: Arial">3. Nhiệm vụ của c&aacute;n bộ - giảng vi&ecirc;n&nbsp;</span></strong></span></p>\r\n	<p style="text-align: justify">\r\n		<span style="font-size: 16px"><span style="font-family: Arial">C&aacute;c hoạt động nghi&ecirc;n cứu v&agrave; ứng dụng KHCN ph&ugrave; hợp với chức năng của Trường, ph&ugrave; hợp với khả năng v&agrave; nguyện vọng của c&aacute;n bộ - giảng vi&ecirc;n v&agrave; sinh vi&ecirc;n, đảm bảo nghĩa vụ v&agrave; quyền lợi của c&aacute;n bộ - giảng vi&ecirc;n v&agrave; sinh vi&ecirc;n; tu&acirc;n thủ theo c&aacute;c văn bản ph&aacute;p quy v&agrave; quy chế của Bộ Gi&aacute;o dục v&agrave; Đ&agrave;o tạo, Bộ Khoa học v&agrave; C&ocirc;ng nghệ.</span></span></p>\r\n	<p style="text-align: justify">\r\n		<span style="font-size: 16px"><span style="font-family: Arial">a. C&aacute;c c&aacute;n bộ - giảng vi&ecirc;n, đặc biệt l&agrave; c&aacute;c c&aacute;n bộ - giảng vi&ecirc;n c&oacute; tr&igrave;nh độ sau đại học cần t&iacute;ch cực ph&aacute;t huy vai tr&ograve; tại đơn vị m&igrave;nh đang c&ocirc;ng t&aacute;c;</span></span></p>\r\n	<p style="text-align: justify">\r\n		<span style="font-size: 16px"><span style="font-family: Arial">b. Với c&aacute;c tiến sĩ, nh&agrave; trường ch&uacute; &yacute; đến &ldquo;4 gắn&rdquo;: Gắn NCKH với đổi mới phương ph&aacute;p dạy học; với viết gi&aacute;o tr&igrave;nh, t&agrave;i liệu tham khảo; với c&ocirc;ng bố b&agrave;i b&aacute;o khoa học (NCKH + PPDH + GT + BBKH).<span class="Apple-tab-span" style="white-space: pre"> </span></span></span></p>\r\n	<p>\r\n		<span style="font-size: 16px"><strong><span style="font-family: Arial">4. Phối hợp đẩy mạnh hoạt động khoa học &ndash; c&ocirc;ng nghệ&nbsp;</span></strong></span></p>\r\n	<p style="text-align: justify">\r\n		<span style="font-size: 16px"><span style="font-family: Arial">a. Để hoạt động KHCN đạt được kết quả, Nh&agrave; trường y&ecirc;u cầu c&oacute; sự phối hợp, hợp t&aacute;c chặt chẽ giữa c&aacute;c đơn vị chuy&ecirc;n m&ocirc;n, c&aacute;c đo&agrave;n thể v&agrave; c&aacute;c ph&ograve;ng, ban trong Trường;</span></span></p>\r\n	<p style="text-align: justify">\r\n		<span style="font-size: 16px"><span style="font-family: Arial">b. Phối hợp với C&ocirc;ng đo&agrave;n trong việc vận động c&ocirc;ng đo&agrave;n vi&ecirc;n t&iacute;ch cực tham gia hoạt động NCKH, ứng dụng KHCN v&agrave; c&oacute; h&igrave;nh thức khen thưởng, động vi&ecirc;n kịp thời;</span></span></p>\r\n	<p style="text-align: justify">\r\n		<span style="font-size: 16px"><span style="font-family: Arial">c. Phối hợp với Đo&agrave;n thanh ni&ecirc;n của Trường trong việc vận động đo&agrave;n vi&ecirc;n thanh ni&ecirc;n hưởng ứng cuộc vận động NCKH, s&aacute;ng tạo của Th&agrave;nh đo&agrave;n; gi&uacute;p đỡ trong việc tổ chức đ&aacute;nh gi&aacute; tập huấn những vấn đề về phương ph&aacute;p luận nghi&ecirc;n cứu s&aacute;ng tạo cho sinh vi&ecirc;n;</span></span></p>\r\n	<p style="text-align: justify">\r\n		<span style="font-size: 16px"><span style="font-family: Arial">d. Phối hợp với Trung t&acirc;m Học liệu nhằm lưu trữ v&agrave; quảng b&aacute; sản phẩm khoa học đ&atilde; được nghiệm thu, gi&uacute;p giảng vi&ecirc;n v&agrave; sinh vi&ecirc;n c&oacute; th&ecirc;m t&agrave;i liệu nghi&ecirc;n cứu;</span></span></p>\r\n	<p>\r\n		<span style="font-size: 16px"><span style="font-family: Arial">đ. Phối hợp với Tạp ch&iacute; Đại học S&agrave;i G&ograve;n để đăng tải c&aacute;c b&agrave;i b&aacute;o khoa học, hoạt động khoa học;</span></span></p>\r\n	<p style="text-align: justify">\r\n		<span style="font-size: 16px"><span style="font-family: Arial">e. Phối hợp với ph&ograve;ng Kế hoạch - T&agrave;i ch&iacute;nh để thực hiện c&aacute;c chế độ ch&iacute;nh s&aacute;ch cho c&aacute;n bộ - giảng vi&ecirc;n tham gia hoạt động khoa học, tham quan học tập trong v&agrave; ngo&agrave;i nước.&nbsp;&nbsp;</span></span></p>\r\n	<p style="text-align: justify">\r\n		<span style="color: rgb(153,0,0)"><span style="font-size: 16px"><span style="font-family: Arial"><b><span style="font-size: 13pt">&nbsp; ĐỀ T&Agrave;I NGHI&Ecirc;N CỨU KHOA HỌC</span></b></span></span></span></p>\r\n	<p style="text-align: justify">\r\n		<span style="font-size: 16px"><b><span style="font-family: &quot;Times New Roman&quot;,&quot;serif&quot;; font-size: 13pt"><o:p></o:p></span></b><span style="font-size: 16px"><span style="font-family: Arial">&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; <a href="http://www.sgu.edu.vn/index.php?option=com_content&amp;view=article&amp;id=2166">&nbsp;+ Danh mục đề t&agrave;i Nghi&ecirc;n cứu khoa học đ&atilde; được nghiệm thu</a></span></span><span style="font-family: &quot;Times New Roman&quot;,&quot;serif&quot;; font-size: 13pt"><o:p></o:p></span></span></p>\r\n	<p>\r\n		<span style="color: rgb(153,0,0)"><span style="font-size: 16px"><span style="font-family: Arial"><strong>&nbsp; &nbsp;</strong><b style="text-indent: -18pt">HỘI NGHỊ &ndash; HỘI THẢO</b></span></span></span></p>\r\n	<p>\r\n		<span style="font-size: 16px"><span style="font-family: Arial"><span style="text-align: justify">&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;&nbsp;</span></span></span><a href="http://www.sgu.edu.vn/index.php?option=com_content&amp;view=article&amp;id=2166" style="text-align: justify; font-family: Arial; font-size: 16px"><span style="font-size: 16px"><span style="font-family: Arial">&nbsp;</span></span></a><span style="font-size: 16px"><span style="font-family: Arial"><a href="http://www.sgu.edu.vn/index.php?option=com_content&amp;view=article&amp;id=2167">+ Danh mục c&aacute;c hội thảo, hội nghị khoa học quốc tế v&agrave; to&agrave;n quốc từ năm 2007</a></span></span></p>\r\n	<p class="MsoNormal" style="text-indent: -18pt; margin-left: 18pt">\r\n		<b><span style="font-family: &quot;Times New Roman&quot;,&quot;serif&quot;; font-size: 13pt"><o:p></o:p></span></b></p>\r\n	<p>\r\n		<span style="color: rgb(153,0,0)"><strong><span style="font-size: 16px"><span style="font-family: Arial">&nbsp; SAU ĐẠI HỌC</span></span></strong></span></p>\r\n	<p>\r\n		<span style="font-size: 16px"><span style="font-family: Arial">&nbsp; &nbsp; &nbsp; &nbsp; &nbsp;- &nbsp;Chương tr&igrave;nh đ&agrave;o tạo: cao học ng&agrave;nh Hồ Ch&iacute; Minh học; Khoa học Thư viện</span></span></p>\r\n	<p>\r\n		<span style="font-family: Arial; font-size: 16px">&nbsp; &nbsp; &nbsp; &nbsp; &nbsp;</span><span style="font-size: 16px"><span style="font-family: Arial">- &nbsp;Li&ecirc;n kết: Trường Đại học KHXH&amp;NV &ndash; Đại học Quốc gia H&agrave; Nội</span></span></p>\r\n	<div>\r\n		&nbsp;</div>\r\n</div>\r\n<p>\r\n	<span style="font-size: 18px"><span style="font-family: ''Times New Roman''">&nbsp;&nbsp;&nbsp; * </span></span><span style="font-size: 18px"><span style="font-family: ''Times New Roman''"><a href="http://www.sgu.edu.vn/files/Bieu mau NCKH(2).rar">Biểu mẫu Nghi&ecirc;n cứu khoa học</a></span></span></p>\r\n<p>\r\n	<span style="font-size: 18px"><span style="font-family: ''Times New Roman''">&nbsp;&nbsp; &nbsp;* </span></span><a href="http://sgu.edu.vn/files/Cac%20vb%20ve%20hd%20KHCN.zip"><span style="font-size: 18px"><span style="font-family: ''Times New Roman''">C&aacute;c văn bản về hoạt động KHCN</span></span></a></p>\r\n'),
('hieu_truong', 'PGS TS. Nguyễn Viết Ngoạn'),
('luot_truy_cap', '1440.000000'),
('smtp_email', 'hungnguyen2308@gmail.com'),
('smtp_mat_khau', 'VjJ0V2EyTXlVbGhTYTJ4cFVqTm9jbFp1Y0hOTlZteHlZVWhLVVZWVU1Eaz0='),
('ten_phong', 'Phòng Khoa học - Công nghệ - Trường Đại học Sài Gòn'),
('truong_phong', 'PGS TS. Võ Văn Lộc');

-- --------------------------------------------------------

--
-- Table structure for table `chuong_trinh`
--

CREATE TABLE IF NOT EXISTS `chuong_trinh` (
  `chuong_trinh_id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `ten` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `noi_dung` text COLLATE utf8_unicode_ci,
  `thoi_gian` date DEFAULT NULL,
  `dia_diem` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `ngay_tao` datetime NOT NULL,
  `trang_thai` tinyint(1) NOT NULL DEFAULT '1',
  `search` tinyint(1) NOT NULL DEFAULT '1',
  PRIMARY KEY (`chuong_trinh_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `chuyen_nganh`
--

CREATE TABLE IF NOT EXISTS `chuyen_nganh` (
  `chuyen_nganh_id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `loai_dao_tao_id` int(11) NOT NULL,
  `nam` int(11) NOT NULL,
  `khoa` int(11) NOT NULL,
  `ten` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `noi_dung` text COLLATE utf8_unicode_ci,
  PRIMARY KEY (`chuyen_nganh_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `dang_ky`
--

CREATE TABLE IF NOT EXISTS `dang_ky` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `ma_de_tai` int(11) NOT NULL,
  `ma_giang_vien` int(11) NOT NULL,
  `nhiem_vu` tinyint(4) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1637 ;

--
-- Dumping data for table `dang_ky`
--

INSERT INTO `dang_ky` (`id`, `ma_de_tai`, `ma_giang_vien`, `nhiem_vu`) VALUES
(4, 2, 124, 1),
(7, 3, 7, 1),
(10, 5, 6, 1),
(11, 6, 10, 1),
(12, 6, 11, 0),
(13, 6, 12, 0),
(14, 6, 13, 0),
(15, 6, 14, 0),
(16, 6, 15, 0),
(17, 7, 24, 1),
(21, 8, 16, 1),
(29, 9, 28, 1),
(94, 0, 126, 1),
(95, 0, 38, 0),
(96, 0, 63, 0),
(97, 0, 39, 0),
(98, 0, 7, 0),
(204, 31, 173, 1),
(205, 32, 180, 1),
(206, 33, 173, 1),
(207, 33, 181, 0),
(227, 39, 69, 1),
(234, 41, 124, 1),
(238, 41, 202, 0),
(239, 41, 204, 0),
(240, 41, 203, 0),
(241, 39, 124, 0),
(242, 42, 124, 1),
(243, 42, 69, 0),
(244, 42, 203, 0),
(245, 42, 204, 0),
(248, 43, 126, 1),
(249, 43, 193, 0),
(250, 44, 207, 1),
(251, 44, 204, 0),
(252, 45, 209, 1),
(253, 45, 210, 0),
(254, 46, 211, 1),
(256, 47, 53, 1),
(259, 46, 212, 0),
(260, 48, 214, 1),
(261, 48, 215, 0),
(262, 49, 25, 1),
(263, 49, 7, 0),
(264, 49, 216, 0),
(265, 49, 217, 0),
(266, 49, 218, 0),
(267, 50, 7, 1),
(268, 50, 73, 0),
(269, 50, 219, 0),
(270, 51, 220, 1),
(271, 52, 147, 1),
(272, 53, 151, 1),
(275, 54, 74, 1),
(276, 54, 79, 0),
(277, 54, 213, 0),
(278, 54, 222, 0),
(279, 54, 223, 0),
(280, 54, 224, 0),
(281, 8, 17, 0),
(282, 8, 115, 0),
(283, 8, 19, 0),
(284, 8, 20, 0),
(285, 8, 21, 0),
(286, 8, 22, 0),
(287, 8, 23, 0),
(288, 55, 42, 1),
(289, 55, 45, 0),
(290, 55, 226, 0),
(291, 55, 226, 0),
(292, 55, 227, 0),
(293, 56, 156, 1),
(294, 56, 228, 0),
(295, 57, 228, 1),
(296, 57, 156, 0),
(297, 58, 25, 1),
(298, 58, 229, 0),
(299, 58, 230, 0),
(300, 59, 229, 1),
(301, 59, 232, 0),
(302, 59, 231, 0),
(303, 59, 82, 0),
(304, 59, 78, 0),
(305, 60, 157, 1),
(307, 60, 233, 0),
(308, 61, 157, 1),
(310, 61, 234, 0),
(311, 62, 235, 1),
(312, 62, 238, 0),
(313, 63, 237, 1),
(314, 47, 209, 0),
(315, 47, 52, 0),
(316, 64, 239, 1),
(317, 64, 241, 0),
(318, 64, 242, 0),
(319, 64, 240, 0),
(320, 64, 243, 0),
(321, 64, 244, 0),
(322, 64, 245, 0),
(323, 64, 246, 0),
(324, 32, 247, 0),
(325, 32, 249, 0),
(326, 32, 248, 0),
(327, 65, 74, 1),
(329, 65, 159, 0),
(330, 66, 80, 1),
(331, 66, 158, 0),
(332, 67, 106, 1),
(333, 68, 106, 1),
(334, 69, 6, 1),
(335, 70, 37, 1),
(336, 70, 250, 0),
(337, 71, 46, 1),
(338, 72, 46, 1),
(339, 73, 251, 1),
(349, 73, 124, 0),
(350, 73, 5, 0),
(351, 73, 4, 0),
(352, 73, 252, 0),
(353, 73, 130, 0),
(354, 74, 204, 1),
(355, 74, 124, 0),
(356, 74, 2, 0),
(357, 74, 253, 0),
(358, 74, 69, 0),
(359, 75, 254, 1),
(360, 75, 124, 0),
(361, 75, 203, 0),
(362, 75, 99, 0),
(363, 75, 205, 0),
(364, 76, 80, 1),
(365, 76, 199, 0),
(366, 77, 126, 1),
(370, 78, 195, 1),
(372, 79, 256, 1),
(373, 79, 157, 0),
(374, 80, 157, 1),
(375, 80, 235, 0),
(376, 80, 257, 0),
(377, 81, 235, 1),
(380, 81, 257, 0),
(381, 82, 258, 1),
(383, 83, 257, 1),
(384, 83, 259, 0),
(385, 84, 149, 1),
(389, 85, 64, 1),
(390, 86, 96, 1),
(391, 86, 64, 0),
(392, 87, 264, 1),
(393, 88, 46, 1),
(394, 89, 265, 1),
(395, 89, 266, 0),
(396, 89, 49, 0),
(397, 89, 267, 0),
(398, 90, 49, 1),
(399, 90, 50, 0),
(400, 90, 51, 0),
(401, 91, 49, 1),
(404, 91, 50, 0),
(405, 91, 268, 0),
(406, 91, 269, 0),
(407, 92, 268, 1),
(410, 93, 50, 1),
(413, 94, 50, 1),
(414, 94, 271, 0),
(415, 93, 270, 0),
(416, 93, 271, 0),
(419, 92, 50, 0),
(420, 92, 53, 0),
(421, 95, 272, 1),
(422, 96, 69, 1),
(423, 96, 124, 0),
(424, 97, 273, 1),
(425, 98, 10, 1),
(426, 98, 13, 0),
(427, 99, 10, 1),
(428, 99, 274, 0),
(429, 99, 15, 0),
(430, 100, 196, 1),
(431, 100, 195, 0),
(432, 101, 195, 1),
(433, 101, 197, 0),
(434, 102, 126, 1),
(435, 102, 201, 0),
(436, 103, 63, 1),
(437, 104, 275, 1),
(438, 104, 276, 0),
(439, 105, 129, 1),
(440, 106, 128, 1),
(441, 106, 99, 0),
(442, 106, 164, 0),
(443, 107, 52, 1),
(445, 108, 211, 1),
(446, 108, 53, 0),
(447, 108, 277, 0),
(449, 109, 54, 1),
(450, 109, 57, 0),
(451, 109, 58, 0),
(452, 109, 278, 0),
(453, 109, 279, 0),
(454, 107, 53, 0),
(455, 110, 54, 1),
(456, 110, 55, 0),
(457, 110, 280, 0),
(458, 111, 54, 1),
(459, 111, 55, 0),
(460, 111, 56, 0),
(461, 112, 57, 1),
(462, 112, 58, 0),
(463, 112, 54, 0),
(464, 113, 7, 1),
(465, 113, 73, 0),
(466, 114, 16, 1),
(467, 114, 20, 0),
(468, 114, 115, 0),
(469, 114, 21, 0),
(470, 114, 17, 0),
(471, 114, 22, 0),
(472, 114, 19, 0),
(473, 114, 281, 0),
(474, 115, 156, 1),
(475, 115, 228, 0),
(476, 115, 282, 0),
(477, 116, 283, 1),
(479, 117, 285, 1),
(480, 118, 256, 1),
(481, 118, 286, 0),
(482, 119, 204, 1),
(483, 120, 257, 1),
(484, 121, 287, 1),
(485, 121, 288, 0),
(486, 122, 181, 1),
(487, 122, 289, 0),
(488, 122, 180, 0),
(489, 122, 290, 0),
(490, 122, 291, 0),
(491, 122, 249, 0),
(492, 123, 30, 1),
(499, 123, 32, 0),
(500, 123, 35, 0),
(501, 123, 33, 0),
(502, 123, 34, 0),
(503, 123, 293, 0),
(504, 123, 292, 0),
(505, 124, 87, 1),
(506, 124, 163, 0),
(507, 124, 164, 0),
(508, 124, 296, 0),
(509, 124, 297, 0),
(510, 124, 294, 0),
(511, 124, 295, 0),
(512, 125, 80, 1),
(513, 125, 158, 0),
(514, 125, 298, 0),
(515, 125, 299, 0),
(516, 125, 300, 0),
(517, 125, 302, 0),
(518, 125, 301, 0),
(519, 126, 80, 1),
(520, 126, 158, 0),
(521, 127, 158, 1),
(522, 127, 80, 0),
(523, 128, 303, 1),
(524, 128, 304, 0),
(525, 128, 305, 0),
(526, 129, 306, 1),
(527, 129, 307, 0),
(528, 129, 308, 0),
(532, 131, 310, 1),
(533, 132, 311, 1),
(534, 132, 312, 0),
(535, 132, 313, 0),
(536, 132, 314, 0),
(537, 132, 315, 0),
(538, 82, 256, 0),
(539, 133, 64, 1),
(540, 134, 106, 1),
(541, 135, 316, 1),
(542, 135, 317, 0),
(543, 136, 318, 1),
(544, 136, 124, 0),
(545, 136, 204, 0),
(546, 137, 126, 1),
(547, 137, 201, 0),
(548, 138, 193, 1),
(549, 138, 126, 0),
(550, 139, 319, 1),
(551, 140, 320, 1),
(552, 140, 183, 0),
(553, 140, 321, 0),
(554, 140, 322, 0),
(555, 141, 70, 1),
(558, 142, 96, 1),
(559, 143, 46, 1),
(560, 144, 124, 1),
(561, 144, 69, 0),
(562, 144, 2, 0),
(563, 145, 146, 1),
(564, 145, 5, 0),
(565, 146, 124, 1),
(568, 147, 10, 1),
(569, 147, 324, 0),
(570, 146, 203, 0),
(571, 146, 323, 0),
(572, 148, 89, 1),
(573, 149, 63, 1),
(576, 150, 157, 1),
(579, 151, 157, 1),
(582, 152, 157, 1),
(585, 153, 59, 1),
(588, 152, 285, 0),
(589, 152, 259, 0),
(590, 151, 235, 0),
(591, 151, 257, 0),
(592, 150, 235, 0),
(593, 150, 257, 0),
(594, 149, 199, 0),
(595, 149, 80, 0),
(596, 154, 59, 1),
(597, 154, 327, 0),
(598, 154, 76, 0),
(599, 154, 325, 0),
(600, 155, 320, 1),
(601, 155, 183, 0),
(602, 155, 321, 0),
(603, 155, 322, 0),
(604, 156, 65, 1),
(605, 156, 328, 0),
(606, 156, 66, 0),
(607, 156, 68, 0),
(608, 157, 151, 1),
(609, 158, 25, 1),
(610, 158, 83, 0),
(611, 7, 25, 0),
(612, 7, 27, 0),
(613, 7, 11, 0),
(614, 159, 25, 1),
(615, 159, 24, 0),
(616, 159, 11, 0),
(617, 159, 27, 0),
(618, 160, 46, 1),
(619, 161, 130, 1),
(620, 162, 124, 1),
(621, 162, 2, 0),
(622, 2, 4, 0),
(623, 2, 5, 0),
(624, 77, 128, 0),
(625, 77, 129, 0),
(626, 77, 255, 0),
(627, 163, 220, 1),
(628, 164, 330, 1),
(629, 164, 332, 0),
(630, 164, 331, 0),
(631, 164, 333, 0),
(632, 164, 334, 0),
(633, 84, 260, 0),
(634, 84, 262, 0),
(635, 84, 263, 0),
(636, 53, 150, 0),
(637, 53, 221, 0),
(638, 53, 335, 0),
(639, 165, 65, 1),
(640, 165, 328, 0),
(641, 165, 336, 0),
(643, 116, 258, 0),
(644, 166, 74, 1),
(645, 166, 159, 0),
(646, 167, 94, 1),
(647, 168, 30, 1),
(648, 168, 31, 0),
(649, 168, 32, 0),
(650, 168, 33, 0),
(651, 168, 34, 0),
(652, 168, 35, 0),
(653, 169, 80, 1),
(654, 169, 126, 0),
(655, 169, 158, 0),
(656, 170, 148, 1),
(657, 170, 337, 0),
(658, 171, 338, 1),
(659, 171, 339, 0),
(660, 172, 340, 1),
(661, 172, 341, 0),
(662, 173, 10, 1),
(663, 173, 11, 0),
(664, 173, 27, 0),
(665, 173, 87, 0),
(666, 173, 12, 0),
(667, 173, 13, 0),
(668, 173, 15, 0),
(669, 173, 14, 0),
(670, 174, 57, 1),
(671, 174, 54, 0),
(672, 174, 342, 0),
(673, 175, 54, 1),
(674, 176, 81, 1),
(675, 176, 343, 0),
(676, 176, 344, 0),
(677, 176, 345, 0),
(678, 177, 28, 1),
(680, 178, 191, 1),
(681, 179, 346, 1),
(682, 180, 84, 1),
(683, 181, 53, 1),
(684, 181, 50, 0),
(685, 181, 277, 0),
(686, 141, 71, 0),
(687, 141, 72, 0),
(688, 153, 325, 0),
(689, 153, 326, 0),
(690, 78, 196, 0),
(1000, 9, 29, 0),
(1003, 177, 183, 0),
(1142, 4, 8, 1),
(1143, 4, 9, 0),
(1146, 130, 309, 1),
(1147, 130, 260, 0),
(1162, 296, 264, 1),
(1167, 298, 49, 1),
(1168, 298, 267, 0),
(1169, 299, 49, 1),
(1170, 299, 503, 0),
(1171, 300, 271, 1),
(1172, 300, 505, 0),
(1173, 301, 268, 1),
(1174, 301, 270, 0),
(1175, 301, 50, 0),
(1176, 302, 270, 1),
(1177, 302, 268, 0),
(1178, 302, 505, 0),
(1179, 303, 506, 1),
(1189, 304, 109, 1),
(1190, 304, 446, 0),
(1191, 304, 507, 0),
(1192, 305, 508, 1),
(1193, 306, 509, 1),
(1194, 307, 13, 1),
(1195, 308, 89, 1),
(1196, 309, 50, 1),
(1197, 309, 269, 0),
(1198, 310, 510, 1),
(1199, 311, 56, 1),
(1200, 311, 54, 0),
(1201, 311, 280, 0),
(1202, 312, 277, 1),
(1203, 313, 52, 1),
(1204, 313, 211, 0),
(1205, 313, 212, 0),
(1206, 314, 53, 1),
(1207, 315, 442, 1),
(1208, 315, 57, 0),
(1209, 316, 54, 1),
(1210, 317, 441, 1),
(1211, 317, 278, 0),
(1212, 318, 58, 1),
(1213, 318, 278, 0),
(1214, 318, 441, 0),
(1215, 319, 511, 1),
(1216, 319, 54, 0),
(1217, 319, 278, 0),
(1218, 320, 106, 1),
(1219, 320, 57, 0),
(1220, 321, 211, 1),
(1221, 321, 52, 0),
(1222, 321, 342, 0),
(1223, 321, 212, 0),
(1224, 322, 63, 1),
(1225, 322, 512, 0),
(1231, 325, 275, 1),
(1232, 324, 195, 1),
(1233, 324, 196, 0),
(1234, 323, 128, 1),
(1235, 323, 513, 0),
(1236, 326, 197, 1),
(1237, 326, 276, 0),
(1238, 327, 193, 1),
(1239, 328, 258, 1),
(1240, 328, 235, 0),
(1241, 329, 235, 1),
(1242, 329, 257, 0),
(1243, 330, 283, 1),
(1244, 330, 258, 0),
(1245, 331, 385, 1),
(1246, 331, 259, 0),
(1247, 332, 514, 1),
(1248, 332, 157, 0),
(1249, 332, 235, 0),
(1250, 333, 69, 1),
(1251, 333, 124, 0),
(1252, 334, 318, 1),
(1253, 334, 204, 0),
(1254, 335, 272, 1),
(1255, 336, 476, 1),
(1256, 337, 475, 1),
(1257, 337, 205, 0),
(1258, 338, 515, 1),
(1259, 339, 493, 1),
(1260, 339, 489, 0),
(1261, 339, 487, 0),
(1265, 341, 151, 1),
(1266, 340, 229, 1),
(1267, 340, 232, 0),
(1268, 340, 516, 0),
(1269, 342, 25, 1),
(1270, 342, 168, 0),
(1271, 342, 243, 0),
(1272, 342, 99, 0),
(1273, 342, 107, 0),
(1274, 343, 299, 1),
(1275, 343, 158, 0),
(1276, 343, 195, 0),
(1277, 344, 158, 1),
(1278, 344, 80, 0),
(1279, 345, 80, 1),
(1280, 345, 158, 0),
(1281, 346, 445, 1),
(1282, 346, 218, 0),
(1283, 346, 519, 0),
(1284, 346, 520, 0),
(1285, 347, 149, 1),
(1286, 347, 340, 0),
(1287, 347, 341, 0),
(1288, 348, 239, 1),
(1289, 348, 521, 0),
(1290, 349, 484, 1),
(1291, 349, 338, 0),
(1292, 349, 483, 0),
(1293, 350, 346, 1),
(1294, 351, 148, 1),
(1295, 351, 481, 0),
(1296, 351, 479, 0),
(1297, 352, 522, 1),
(1298, 352, 523, 0),
(1299, 352, 478, 0),
(1300, 353, 524, 1),
(1301, 354, 7, 1),
(1302, 354, 73, 0),
(1303, 355, 220, 1),
(1304, 355, 73, 0),
(1305, 356, 65, 1),
(1306, 357, 35, 1),
(1307, 358, 320, 1),
(1308, 358, 326, 0),
(1309, 358, 525, 0),
(1310, 359, 498, 1),
(1311, 359, 499, 0),
(1312, 359, 526, 0),
(1313, 360, 44, 1),
(1314, 360, 527, 0),
(1315, 361, 42, 1),
(1316, 361, 227, 0),
(1317, 361, 528, 0),
(1318, 362, 529, 1),
(1319, 363, 115, 1),
(1323, 364, 305, 1),
(1324, 364, 303, 0),
(1325, 364, 304, 0),
(1326, 365, 324, 1),
(1327, 365, 71, 0),
(1328, 365, 72, 0),
(1329, 366, 530, 1),
(1330, 366, 70, 0),
(1331, 366, 531, 0),
(1332, 367, 387, 1),
(1333, 367, 108, 0),
(1334, 367, 532, 0),
(1335, 368, 533, 1),
(1339, 370, 537, 1),
(1340, 370, 282, 0),
(1341, 369, 534, 1),
(1342, 369, 535, 0),
(1343, 369, 536, 0),
(1344, 371, 291, 1),
(1345, 371, 402, 0),
(1346, 371, 247, 0),
(1347, 372, 538, 1),
(1348, 372, 173, 0),
(1349, 372, 180, 0),
(1350, 373, 401, 1),
(1351, 373, 400, 0),
(1352, 373, 171, 0),
(1353, 374, 102, 1),
(1354, 374, 289, 0),
(1355, 374, 310, 0),
(1356, 374, 540, 0),
(1357, 374, 541, 0),
(1358, 374, 539, 0),
(1359, 375, 102, 1),
(1360, 375, 290, 0),
(1361, 375, 172, 0),
(1362, 376, 96, 1),
(1364, 378, 126, 1),
(1365, 378, 38, 0),
(1366, 378, 193, 0),
(1367, 379, 124, 1),
(1368, 379, 318, 0),
(1369, 380, 515, 1),
(1370, 381, 157, 1),
(1371, 381, 259, 0),
(1372, 382, 514, 1),
(1373, 382, 257, 0),
(1374, 382, 542, 0),
(1375, 383, 383, 1),
(1376, 383, 235, 0),
(1377, 383, 283, 0),
(1378, 384, 157, 1),
(1379, 384, 285, 0),
(1380, 384, 259, 0),
(1381, 385, 94, 1),
(1382, 386, 59, 1),
(1383, 386, 327, 0),
(1384, 386, 543, 0),
(1385, 386, 544, 0),
(1386, 387, 498, 1),
(1387, 387, 545, 0),
(1388, 387, 322, 0),
(1389, 387, 499, 0),
(1390, 388, 320, 1),
(1391, 388, 183, 0),
(1392, 388, 546, 0),
(1393, 389, 545, 1),
(1394, 389, 327, 0),
(1395, 389, 59, 0),
(1396, 389, 321, 0),
(1397, 390, 24, 1),
(1398, 390, 470, 0),
(1399, 390, 472, 0),
(1400, 390, 471, 0),
(1401, 297, 46, 1),
(1402, 297, 264, 0),
(1403, 297, 501, 0),
(1404, 297, 502, 0),
(1405, 377, 273, 1),
(1432, 391, 96, 1),
(1433, 392, 264, 1),
(1434, 392, 106, 0),
(1435, 393, 264, 1),
(1436, 393, 548, 0),
(1439, 394, 46, 1),
(1440, 394, 501, 0),
(1444, 396, 49, 1),
(1445, 395, 265, 1),
(1446, 395, 49, 0),
(1447, 395, 271, 0),
(1448, 397, 270, 1),
(1449, 397, 268, 0),
(1450, 397, 269, 0),
(1451, 398, 268, 1),
(1452, 398, 271, 0),
(1453, 399, 267, 1),
(1454, 399, 266, 0),
(1455, 400, 272, 1),
(1456, 401, 475, 1),
(1462, 402, 477, 1),
(1463, 402, 476, 0),
(1464, 403, 473, 1),
(1465, 404, 69, 1),
(1466, 404, 124, 0),
(1467, 405, 318, 1),
(1468, 405, 2, 0),
(1469, 406, 476, 1),
(1470, 406, 205, 0),
(1472, 407, 467, 1),
(1476, 408, 89, 1),
(1477, 408, 466, 0),
(1478, 409, 13, 1),
(1479, 410, 7, 1),
(1480, 410, 217, 0),
(1482, 411, 220, 1),
(1483, 412, 215, 1),
(1484, 412, 260, 0),
(1485, 412, 334, 0),
(1486, 413, 340, 1),
(1487, 413, 149, 0),
(1488, 413, 341, 0),
(1489, 413, 549, 0),
(1490, 414, 148, 1),
(1491, 414, 337, 0),
(1492, 414, 479, 0),
(1493, 414, 478, 0),
(1497, 415, 330, 1),
(1498, 415, 333, 0),
(1499, 415, 332, 0),
(1504, 416, 262, 1),
(1505, 416, 482, 0),
(1506, 416, 480, 0),
(1507, 416, 481, 0),
(1508, 417, 483, 1),
(1509, 417, 338, 0),
(1510, 417, 339, 0),
(1511, 417, 484, 0),
(1518, 418, 57, 1),
(1519, 418, 58, 0),
(1520, 418, 440, 0),
(1521, 419, 278, 1),
(1522, 419, 441, 0),
(1523, 420, 442, 1),
(1524, 420, 278, 0),
(1525, 420, 279, 0),
(1526, 421, 58, 1),
(1527, 421, 54, 0),
(1528, 421, 280, 0),
(1532, 422, 56, 1),
(1533, 422, 54, 0),
(1534, 422, 441, 0),
(1537, 423, 54, 1),
(1538, 423, 511, 0),
(1539, 424, 53, 1),
(1540, 424, 277, 0),
(1541, 425, 52, 1),
(1542, 425, 211, 0),
(1543, 425, 212, 0),
(1544, 426, 211, 1),
(1545, 426, 52, 0),
(1546, 426, 342, 0),
(1549, 427, 277, 1),
(1550, 428, 106, 1),
(1551, 429, 204, 1),
(1552, 430, 63, 1),
(1553, 430, 474, 0),
(1554, 431, 126, 1),
(1555, 431, 319, 0),
(1556, 431, 199, 0),
(1557, 432, 195, 1),
(1559, 433, 367, 1),
(1560, 434, 42, 1),
(1561, 434, 388, 0),
(1562, 434, 389, 0),
(1567, 435, 118, 1),
(1568, 435, 50, 0),
(1569, 435, 328, 0),
(1570, 435, 329, 0),
(1571, 436, 418, 1),
(1572, 436, 419, 0),
(1573, 436, 67, 0),
(1574, 436, 421, 0),
(1575, 437, 320, 1),
(1576, 437, 326, 0),
(1577, 438, 385, 1),
(1578, 438, 157, 0),
(1579, 439, 258, 1),
(1580, 439, 283, 0),
(1587, 440, 256, 1),
(1588, 440, 286, 0),
(1589, 441, 465, 1),
(1590, 441, 103, 0),
(1591, 442, 156, 1),
(1592, 442, 228, 0),
(1593, 443, 537, 1),
(1594, 443, 282, 0),
(1595, 444, 65, 1),
(1599, 446, 291, 1),
(1600, 446, 400, 0),
(1601, 446, 247, 0),
(1602, 447, 173, 1),
(1603, 447, 401, 0),
(1604, 447, 172, 0),
(1605, 448, 180, 1),
(1606, 448, 402, 0),
(1607, 448, 249, 0),
(1608, 449, 290, 1),
(1609, 449, 181, 0),
(1610, 449, 403, 0),
(1613, 445, 243, 1),
(1614, 445, 245, 0),
(1615, 445, 242, 0),
(1616, 451, 218, 1),
(1617, 451, 273, 0),
(1618, 451, 324, 0),
(1619, 451, 473, 0),
(1620, 450, 50, 1),
(1621, 450, 269, 0),
(1622, 452, 158, 1),
(1623, 452, 80, 0),
(1624, 453, 213, 1),
(1625, 453, 251, 0),
(1626, 454, 170, 1),
(1627, 454, 496, 0),
(1628, 454, 497, 0),
(1629, 455, 146, 1),
(1630, 455, 5, 0),
(1631, 456, 251, 1),
(1632, 456, 4, 0),
(1633, 457, 550, 1),
(1634, 457, 69, 0),
(1635, 457, 203, 0),
(1636, 457, 323, 0);

-- --------------------------------------------------------

--
-- Table structure for table `dang_ky_chuyen_nganh`
--

CREATE TABLE IF NOT EXISTS `dang_ky_chuyen_nganh` (
  `hoc_vien_id` int(11) NOT NULL,
  `chuyen_nganh_id` int(11) NOT NULL,
  `diem` decimal(10,2) NOT NULL DEFAULT '0.00',
  `xep_loai` enum('Giỏi','Khá','Trung Bình','Kém') COLLATE utf8_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`hoc_vien_id`,`chuyen_nganh_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `danh_sach_lop`
--

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
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=2 ;

--
-- Dumping data for table `danh_sach_lop`
--

INSERT INTO `danh_sach_lop` (`id`, `tieu_de`, `noi_dung`, `ngay_tao`, `so_lan_xem`, `trang_thai`, `he_cao_hoc`, `file`, `quan_trong`, `noi_bat`) VALUES
(1, 'Danh sách học viên cao học Khoá 22 thi bổ sung tại Trường Đại học Sài Gòn', '<p>\r\n	<span style="font-size:26px;"><a href="/public/upload/files/DS%20thi%20sinh%20thi%20bo%20sung%20K22.pdf">Bấm v&agrave;o đ&acirc;y để tải danh s&aacute;ch học vi&ecirc;n bổ sung</a></span></p>\r\n', '2014-12-01 02:54:34', 436, 0, 2, NULL, 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `de_tai`
--

CREATE TABLE IF NOT EXISTS `de_tai` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
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
  `nam` int(4) DEFAULT NULL,
  `bo_mon_id` int(11) NOT NULL DEFAULT '0',
  `file_tom_tat` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `search` tinyint(1) NOT NULL DEFAULT '1',
  `ngay_gia_han` date DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=458 ;

--
-- Dumping data for table `de_tai`
--

INSERT INTO `de_tai` (`id`, `ma`, `ten`, `thoi_gian_bat_dau`, `thoi_gian_hoan_thanh`, `tinh_trang`, `so_thang_gia_han`, `kinh_phi`, `cap_quan_ly`, `xep_loai`, `ma_linh_vuc`, `ma_hd_duyet`, `ma_loai`, `ma_don_vi`, `ghi_chu`, `nam`, `bo_mon_id`, `file_tom_tat`, `search`, `ngay_gia_han`) VALUES
(2, 'CS2010-03', 'Biên soạn giáo trình: ‘Bài tập đại số tuyến tính, toán C1” dùng cho sinh viên đa ngành của ĐH Sài Gòn theo hệ thống tín chỉ.', '2009-12-03', '2010-01-18', 4, 2, '8500000', 2, 3, 6, 20, 1, 2, '', 2010, 0, NULL, 1, NULL),
(3, 'CS2010-07', 'Phát triển ngôn ngữ cho học sinh Trung học cơ sở từ lý thuyết trường đồng nghĩa từ vựng', '2009-11-10', '2011-01-31', 4, 2, '10000000', 2, 2, 4, 18, 1, 4, '', 2010, 0, NULL, 1, NULL),
(4, 'CS2010-09', 'Giáo trình Địa lý Việt Nam dùng cho sinh viên ngành Việt Nam học', '2009-11-10', '2010-11-09', 4, 5, '11950000', 2, 2, 5, 19, 1, 3, '', 2010, 0, NULL, 1, NULL),
(5, 'CS2010-04', 'Khai thác và sử dụng thiết bị nghe nhìn hiện đại phổ biến kết hợp công nghệ thông tin phục vụ dạy học', '2009-12-06', '2010-12-31', 4, 5, '14000000', 2, 4, 6, 20, 1, 20, '', 2010, 0, NULL, 1, NULL),
(6, 'CS2010-10', 'Giáo trình Lịch sử văn  minh thế giới', '2009-09-01', '2011-06-13', 4, 0, '12000000', 2, 4, 5, 19, 1, 3, NULL, 2010, 0, NULL, 1, NULL),
(7, 'CS2010-13', 'Tiếng Việt trực tuyến giai đoạn 1 (dùng cho hệ thống trực tuyến (E-learning System) của trường ĐHSG)', '2009-09-08', '2010-05-04', 4, 0, '16000000', 2, 3, 8, 22, 1, 12, '', 2010, 0, NULL, 1, NULL),
(8, 'CS2010-11', 'Định hướng phát triển bền vững công tác đào tạo của khoa Văn hóa – Du lịch ở trường Đại học Sài Gòn', '2009-09-08', '2012-05-01', 4, 0, '14000000', 2, 3, 8, 22, 1, 13, '', 2010, 0, NULL, 1, NULL),
(9, 'CS2010-27', 'Kiểm soát chi phí trong xây dựng cơ bản', '2010-10-01', '2011-03-25', 4, 5, '16000000', 2, 3, 2, 16, 1, 26, '', 2010, 0, NULL, 1, NULL),
(31, 'CS2011-60', 'Giáo trình 2 : Bóng đá futsal cơ bản', '2011-01-31', '2012-05-31', 4, 0, '19000000', 2, 3, 5, NULL, 1, 51, '', 2011, 0, NULL, 1, NULL),
(32, 'CS2011-61', 'Giáo trình bóng bàn 2-3', '2011-01-01', '2012-05-31', 4, 0, '19000000', 2, 3, 5, NULL, 1, 51, '', 2011, 0, NULL, 1, NULL),
(33, 'CS2011-59', 'Nghiên cứu đánh giá, xếp loại thể lực chung của sinh viên đầu vào Trường ĐH Sài Gòn năm 2010-2011', '2011-01-01', '2012-01-01', 4, 0, '0', 2, 0, 1, NULL, 1, 51, '', 2011, 0, NULL, 1, NULL),
(39, 'CS2011-12', 'Bài toán Parabolic ngược', '2010-12-01', '2012-04-30', 4, 0, '15000000', 2, 4, 6, NULL, 1, 2, '', 2011, 0, NULL, 1, NULL),
(41, 'CS2011-07', 'Bài toán Cauchy ngược', '2010-12-01', '2012-04-30', 4, 0, '15000000', 2, 3, 6, NULL, 1, 2, '', 2011, 0, NULL, 1, NULL),
(42, 'CS2011-09', 'Biên soạn giáo trình giải tích 1 dùng cho việc đào tạo sinh viên khoa Toán - ứng dụng và sinh viên đa ngành của Đại học Sài Gòn', '2010-12-31', '2012-04-30', 4, 0, '20000000', 2, 4, 6, NULL, 1, 2, '', 2011, 0, NULL, 1, NULL),
(43, 'CS2011-13', 'Tuyển tập các bài tập lập trình căn bản', '2010-12-01', '2012-01-01', 4, 0, '30000000', 2, 2, 1, NULL, 1, 10, '', 2011, 0, NULL, 1, NULL),
(44, 'CS2010-16', 'Giáo trình Hán - Nôm cho sinh viên ngành Việt Nam học', '2009-12-01', '2012-01-31', 4, 0, '12000000', 2, 2, 5, NULL, 1, 12, '', 2010, 0, NULL, 1, NULL),
(45, 'CS2010-20', 'Nghiên cứu xây dựng quy trình xác định BOD3 trong nước thải ngành phân bón', '2010-04-01', '2012-06-30', 4, 0, '0', 2, 0, 9, NULL, 1, 15, '', 2010, 0, NULL, 1, NULL),
(46, 'CS2010-22', 'Nghiên cứu sử dụng tảo (Chlorella sp.,  Spirulida sp.) và bèo lục bình để xử lý nguồn nước bị phú dưỡng hóa.', '2010-05-01', '2011-11-30', 4, 0, '15600000', 2, 2, 9, NULL, 1, 15, '', 2010, 0, NULL, 1, NULL),
(47, 'CS2010-19', 'Đánh giá hiện trạng và nhu cầu nhân lực ngành Môi trường ở Thành phố Hồ Chí Minh, Bình Dương và Đồng Nai', '2010-03-01', '2012-01-31', 4, 0, '16000000', 2, 5, 9, NULL, 1, 15, '', 2010, 0, NULL, 1, NULL),
(48, 'CS2008-10', 'Tổ chức hoạt động vận động cho trẻ mầm non theo hướng tích cực', '2008-06-01', '2012-05-01', 4, 12, '10000000', 2, 2, 1, NULL, 1, 5, '', 2008, 0, NULL, 1, NULL),
(49, 'CS2011-21', 'Xây dựng phương tiện ngôn ngữ để tăng cường hiệu quả dạy học Tiếng Việt cho học sinh Tiểu học (từ lớp 1 đến học kì 1 lớp 3) trên nguyên lý trường từ vựng ngữ nghĩa', '2011-01-31', '2012-02-29', 4, 0, '25000000', 2, 4, 1, NULL, 1, 26, '', 2011, 0, NULL, 1, NULL),
(50, 'CS2011-24', 'Xây dựng phương tiện ngôn ngữ để tăng cường hiệu quả dạy học Tiếng Việt cho học sinh tiểu học (từ học kì 2 lớp 3 đến lớp 5) trên nguyên lý trường từ vựng ngữ nghĩa.', '2011-01-31', '2012-02-29', 4, 0, '25000000', 2, 3, 1, NULL, 1, 4, '', 2011, 0, NULL, 1, NULL),
(51, 'CS2011-26', 'Tiếng Việt với khoa học giao tiếp', '2011-01-31', '2012-11-30', 3, 0, '25000000', 2, 0, 1, NULL, 1, 4, '', 2011, 0, NULL, 1, NULL),
(52, 'CS2011-22', 'Nghiên cứu khái niệm ban đầu về phép chia trong chương trình toán lớp 2', '2010-11-30', '2012-06-30', 3, 0, '25000000', 2, 0, 1, NULL, 1, 4, '', 2011, 0, NULL, 1, NULL),
(53, 'CS2010-26', 'Xây dựng chương trình đào tạo ngắn hạn nghề Bếp theo Mô đun tại Tp Hồ Chí Minh', '2009-12-31', '2012-04-01', 4, 0, '14000000', 2, 3, 4, NULL, 1, 6, '', 2010, 0, NULL, 1, NULL),
(54, 'CS2011-56', 'Giáo trình Kinh tế vi mô', '2011-03-31', '2011-10-01', 4, 0, '20000000', 2, 3, 5, NULL, 1, 22, '', 2011, 0, NULL, 1, NULL),
(55, 'CS2011-58', 'Biện pháp nâng cao hình ảnh khoa Quản trị kinh doanh, Trường Đại học Sài Gòn', '2010-01-31', '2013-02-28', 3, 0, '25000000', 2, 0, 4, NULL, 1, 11, '', 2011, 0, NULL, 1, NULL),
(56, 'CS2011-32', 'Đổi mới nội dung chương trình Thanh nhạc cho sinh viên năm I của Đại học Sư phạm Âm nhạc', '2011-03-31', '2012-04-30', 4, 0, '24800000', 2, 3, 1, NULL, 1, 9, '', 2011, 0, NULL, 1, NULL),
(57, 'CS2011-33', 'Thiết kế đào tạo nội dung môn Phối hợp xướng cho Đại học Sư phạm Âm nhạc', '2011-03-31', '2012-04-30', 4, 0, '24800000', 2, 3, 1, NULL, 1, 9, '', 2011, 0, NULL, 1, NULL),
(58, 'CS2011-49', 'Xây dựng chương trình đào tạo cử nhân tâm lý - giáo dục tại trường ĐHSG', '2011-03-31', '2013-03-31', 3, 0, '25000000', 2, 0, 1, NULL, 1, 26, '', 2011, 0, NULL, 1, NULL),
(59, 'CS2011-50', 'Xây dựng chương trình bồi dưỡng chuyên viên tư vấn học đường cho các trường trung học cơ sở và trung học phổ thông.', '2011-01-31', '2013-01-31', 3, 0, '25000000', 2, 0, 1, NULL, 1, 16, '', 2011, 0, NULL, 1, NULL),
(60, 'CS2011-34', 'Tối ưu hóa các tham số trong giải thuật chuyển giao mềm để tăng cường hiệu quả sử dụng tài nguyên vô tuyến trong hệ thống thông tin di động băng rộng CDMA', '2011-02-28', '2011-11-30', 4, 0, '20000000', 2, 3, 7, NULL, 1, 19, '', 2011, 0, NULL, 1, NULL),
(61, 'CS2011-37', 'Biên soạn tài liệu hệ thống thông tin điện tử vô tuyến', '2011-02-21', '2011-11-30', 4, 0, '19000000', 2, 3, 5, NULL, 1, 19, '', 2011, 0, NULL, 1, NULL),
(62, 'CS2011-43', 'Ứng dụng card Advantech PCI 1711 điều khiển khớp nối của cánh tay robot', '2011-02-28', '2012-01-31', 4, 0, '28500000', 2, 2, 7, NULL, 1, 19, '', 2011, 0, NULL, 1, NULL),
(63, 'CS2011-38', 'Nghiên cứu giải thuật điều khiển công suất tác dụng cho hệ thống pin năng lượng mặt trới sử dụng bộ biến tần Z một pha', '2011-04-30', '2012-03-31', 4, 0, '20000000', 2, 2, 7, NULL, 1, 19, '', 2011, 0, NULL, 1, NULL),
(64, 'CS2010-32', 'Thực trạng trí tuệ cảm xúc của sinh viên năm cuối trường Đại học Sài Gòn – Thành phố HCM', '2010-01-31', '2012-01-31', 4, 0, '14000000', 2, 3, 4, NULL, 1, 52, '', 2010, 0, NULL, 1, NULL),
(65, 'CS2011-64', 'Chiến lược phát triển phòng Đào tạo tại chức & Tu nghiệp giáo viên giai đọan 2011-2015', '2011-04-30', '2011-09-30', 4, 0, '15000000', 2, 4, 4, NULL, 1, 22, '', 2011, 0, NULL, 1, NULL),
(66, 'CS2011-63', 'Tác động của việc “Lấy ý kiến phản hồi từ người đọc về giảng dạy môn học” tới hoạt động giảng dạy của giảng viên', '2011-04-30', '2012-03-31', 4, 0, '15000000', 2, 3, 4, NULL, 1, 21, '', 2011, 0, NULL, 1, NULL),
(67, 'CS2011-01', 'Nghiên cứu xung ánh sáng trắng femto giây tạo bởi sợi quang học có chiều dài dưới 1cm', '2011-01-01', '2011-12-31', 3, 0, '15000000', 2, 0, 6, NULL, 1, 20, '', 2011, 0, NULL, 1, NULL),
(68, 'CS2011-02', 'Viết tài liệu tham khảo về vật lý Laser và các kĩ thuật Quang phổ', '2011-01-31', '2011-12-31', 3, 0, '20000000', 2, 0, 6, NULL, 1, 20, '', 2011, 0, NULL, 1, NULL),
(69, 'CS2011-03', 'Tài liệu hướng dẫn làm đồ dùng dạy học vật lý', '2011-01-31', '2013-12-31', 3, 0, '20000000', 2, 0, 6, NULL, 1, 20, '', 2011, 0, NULL, 1, NULL),
(70, 'CS2011-04', 'Khảo sát thành phần hóa học cao cloroform của lá cây bằng lăng Lagerstroemia speciosa (L.) Pers., Họ Tử vi (Lythraceae)', '2011-04-30', '2012-04-30', 3, 0, '30000000', 2, 0, 6, NULL, 1, 20, '', 2011, 0, NULL, 1, NULL),
(71, 'CS2011-05', 'Viết giáo trình Hóa học vô cơ – phần Phi kim', '2010-12-31', '2011-12-31', 1, 0, '19000000', 2, 0, 5, NULL, 1, 20, '', 2011, 0, NULL, 1, NULL),
(72, 'CS2011-06', 'Nghiên cứu điều chế phức lantan citrat và thử nghiệm làm chất kích thích sinh trưởng cây cà chua', '2010-12-31', '2011-12-31', 3, 0, '29000000', 2, 0, 6, NULL, 1, 20, '', 2011, 0, NULL, 1, NULL),
(73, 'CS2011-08', 'Giáo trình Đại số tuyến tính', '2010-12-31', '2012-12-31', 3, 0, '20000000', 2, 0, 5, NULL, 1, 2, '', 2011, 0, NULL, 1, NULL),
(74, 'CS2011-10', 'Bộ đề thi trắc nghiệm môn Xác suất Thống kê A', '2010-12-31', '2012-12-31', 3, 0, '25000000', 2, 0, 5, NULL, 1, 2, '', 2011, 0, NULL, 1, NULL),
(75, 'CS2011-11', 'Bộ đề thi trắc nghiệm môn Xác suất Thống kê B', '2010-02-28', '2012-12-31', 3, 0, '25000000', 2, 0, 1, NULL, 1, 2, '', 2011, 0, NULL, 1, NULL),
(76, 'CS2011-16', 'Giáo trình điện tử học phần Nhập môn máy tính', '2010-12-31', '2012-07-31', 1, 0, '20000000', 2, 3, 5, NULL, 1, 21, '', 2011, 0, NULL, 1, NULL),
(77, 'CS2010-05', 'Nghiên cứu một số mô hình hóa điển hình và ứng dụng vào giảng dạy môn phân tích thiết kế hệ thống', '2009-12-31', '2012-08-31', 4, 0, '14000000', 2, 2, 1, NULL, 1, 10, '', 2010, 0, NULL, 1, NULL),
(78, 'CS2011-14', 'Xây dựng phần mềm quản lý phân công giảng dạy cho khoa CNTT, trường ĐH Sài Gòn', '2010-12-31', '2012-08-31', 4, 0, '25000000', 2, 2, 1, NULL, 1, 10, '', 2011, 0, NULL, 1, NULL),
(79, 'CS2011-36', 'Nghiên cứu công nghệ nhận dạng bằng thẻ thông minh vô tuyến và xây dựng mô hình ứng dụng trong quản lý sinh viên tại trường ĐHSG', '2011-02-28', '2012-08-31', 4, 0, '20000000', 2, 2, 7, NULL, 1, 19, '', 2011, 0, NULL, 1, NULL),
(80, 'CS2011-39', 'Biên soạn giáo trình điện tử cơ bản', '2011-02-28', '2012-08-31', 3, 0, '20000000', 2, 0, 1, NULL, 1, 19, '', 2011, 0, NULL, 1, NULL),
(81, 'CS2011-40', 'Thiết kế các bài thí nghiệm thực hành điện tử cơ bản', '2011-02-28', '2012-07-31', 4, 0, '16000000', 2, 2, 5, NULL, 1, 19, '', 2011, 0, NULL, 1, NULL),
(82, 'CS2011-41', 'Thiết kế các chương trình VHDL điểu khiển các khối ngoại vi giao tiếp trên cơ sở kit FPGA SPARTAN 3A/3E', '2011-02-28', '2012-08-31', 4, 0, '28500000', 2, 2, 7, NULL, 1, 19, '', 2011, 0, NULL, 1, NULL),
(83, 'CS2011-42', 'Thiết kế và thi công hệ thống tự động tiếp nhận đăng ký khám bệnh bằng tin nhắn SMS', '2011-04-30', '2012-07-31', 4, 0, '28500000', 2, 3, 7, NULL, 1, 19, '', 2011, 0, NULL, 1, NULL),
(84, 'CS2010-25', 'Kỹ thuật làm rối và sáng tạo các loại rối từ nguyên vật liệu mở', '2010-01-31', '2012-12-31', 3, 0, '14000000', 2, 0, 1, NULL, 1, 5, '', 2010, 0, NULL, 1, NULL),
(85, 'CS2012-01', 'Mô phỏng và tính toán cấu trúc vùng năng lượng của điện tử trong ống Nano Carbon (6,0) biến dạng', '2012-07-01', '2013-03-31', 3, 0, '30000000', 2, 0, 6, NULL, 1, 20, '', 2012, 0, NULL, 1, NULL),
(86, 'CS2012-02', 'Nghiên cứu tính chất điện tử của ống Nano Carbon (5,5) kiểu Quinoid bằng phương pháp mô phỏng lượng tử', '2012-07-01', '2013-03-31', 3, 0, '30000000', 2, 0, 6, NULL, 1, 20, '', 2012, 0, NULL, 1, NULL),
(87, 'CS2012-03', 'Nghiên cứu cắt mạch chitosan trương trong dung dịch H2O2 bằng bức xạ gamma Co-60', '2012-07-01', '2013-03-31', 3, 0, '30000000', 2, 0, 6, NULL, 1, 20, '', 2012, 0, NULL, 1, NULL),
(88, 'CS2012-04', 'Nghiên cứu thu hồi sắt từ bã thải bùn đỏ', '2012-07-01', '2013-03-31', 3, 0, '30000000', 2, 0, 6, NULL, 1, 20, '', 2012, 0, NULL, 1, NULL),
(89, 'CS2012-05', 'Xây dựng trang web định loại các loài lưỡng cư, bò sát các tỉnh phía Tây miền Đông Nam Bộ', '2012-07-01', '2013-03-31', 3, 0, '30000000', 2, 0, 6, NULL, 1, 20, '', 2012, 0, NULL, 1, NULL),
(90, 'CS2012-06', 'Xây dựng trang web về các đặc điểm phân loại và chương trình định danh các học thực vật hạt kín ở Việt Nam', '2012-07-01', '2013-03-31', 3, 0, '30000000', 2, 0, 6, NULL, 1, 20, '', 2012, 0, NULL, 1, NULL),
(91, 'CS2012-07', 'Xây dựng quy trình tạo một bài giảng sinh học để phục vụ E-Learning', '2012-07-01', '2013-03-31', 3, 0, '26260000', 2, 0, 7, NULL, 1, 20, '', 2012, 0, NULL, 1, NULL),
(92, 'CS2012-08', 'Khảo sát vi khuẩn vùng rẻ và vi khuẩn nội sinh ở cây bắp (Zeamays) trồng tại Đông Nam Bộ', '2012-07-01', '2013-12-31', 3, 0, '29000000', 2, 0, 6, NULL, 1, 20, '', 2012, 0, NULL, 1, NULL),
(93, 'CS2012-09', 'Tìm hiểu thực trạng và giải pháp nâng cao chất lượng dạy học thực hành môn sinh học tại trường THCS, THPT', '2012-06-01', '2012-11-30', 3, 0, '28600000', 2, 0, 6, NULL, 1, 20, '', 2012, 0, NULL, 1, NULL),
(94, 'CS2012-10', 'Hoàn chỉnh, nâng cao chương trình “Thực tập nghiên cứu thiên nhiên” và kĩ năng thực tế thiên nhiên cho sinh viên ngành Sư phạm Sinh học', '2012-07-01', '2013-11-30', 3, 0, '28600000', 2, 0, 6, NULL, 1, 20, '', 2012, 0, NULL, 1, NULL),
(95, 'CS2012-11', 'Sự tồn tại nghiệm của phương trình vi - tích phân đạo hàm riêng tự tham chiếu', '2012-07-01', '2013-03-31', 3, 0, '15000000', 2, 0, 6, NULL, 1, 2, '', 2012, 0, NULL, 1, NULL),
(96, 'CS2012-12', 'Bài toán truyền nhiệt ngược với hệ số không hằng', '2012-07-01', '2013-03-31', 3, 0, '15000000', 2, 0, 6, NULL, 1, 2, '', 2012, 0, NULL, 1, NULL),
(97, 'CS2012-13', 'Nghệ thuật tiểu thuyết Việt Nam giai đoạn 1955-1975', '2012-07-01', '2013-03-31', 3, 0, '15000000', 2, 0, 4, NULL, 1, 3, '', 2012, 0, NULL, 1, NULL),
(98, 'CS2012-14', 'Chiến tranh hoá học của Mỹ ở Việt Nam và cuộc đấu tranh vì công lý của các nạn nhân chất độc da cam dioxin Việt Nam', '2012-07-01', '2012-12-31', 3, 0, '25000000', 2, 0, 4, NULL, 1, 3, '', 2012, 0, NULL, 1, NULL),
(99, 'CS2012-15', 'Lịch sử phát triển cảng Sài Gòn trong giai đoạn 1954-2010', '2012-07-01', '2013-03-31', 3, 0, '25000000', 2, 0, 4, NULL, 1, 3, '', 2012, 0, NULL, 1, NULL),
(100, 'CS2012-16', 'Xây dựng một hệ thống học tập trực tuyến cho khoa Công nghệ Thông tin - Trường Đại học Sài Gòn', '2012-07-01', '2013-03-31', 3, 0, '25000000', 2, 0, 7, NULL, 1, 10, '', 2012, 0, NULL, 1, NULL),
(101, 'CS2012-17', 'Tìm hiểu và đánh giá các thuật toán định tuyến kỹ thuật lưu lượng trong mạng tốc độ cao.', '2012-07-01', '2013-03-31', 3, 0, '25000000', 2, 0, 7, NULL, 1, 10, '', 2012, 0, NULL, 1, NULL),
(102, 'CS2012-18', 'Phần mềm quản lý công văn khoa Công nghệ Thông tin', '2012-07-01', '2013-03-31', 3, 0, '25000000', 2, 0, 7, NULL, 1, 10, '', 2012, 0, NULL, 1, NULL),
(103, 'CS2012-19', 'Áp dụng lý thuyết tập mờ để mở rộng cơ sở dữ liệu hướng đối tượng xác suất', '2012-07-01', '2013-03-31', 3, 0, '27000000', 2, 0, 7, NULL, 1, 10, '', 2012, 0, NULL, 1, NULL),
(104, 'CS2012-20', 'Xây dựng hệ thống biên dịch mã nguồn hệ điều hành Ubuntu trên kiến trúc ARM (Porting Ubuntu to ARM- Advancs RISC Machine)', '2012-07-01', '2013-03-31', 3, 0, '25000000', 2, 0, 7, NULL, 1, 10, '', 2012, 0, NULL, 1, NULL),
(105, 'CS2012-21', 'Cải tiến cây tìm kiếm đối kháng Monte Carlo', '2012-07-01', '2013-03-31', 3, 0, '27000000', 2, 0, 7, NULL, 1, 10, '', 2012, 0, NULL, 1, NULL),
(106, 'CS2012-22', 'Xây dựng website quản lí thông tin NCKH tại phòng KHCN – Trường Đại học Sài Gòn', '2012-07-01', '2013-03-31', 3, 0, '25000000', 2, 0, 7, NULL, 1, 10, '', 2012, 0, NULL, 1, NULL),
(107, 'CS2012-23', 'Khảo sát một số thành phần lý, hóa học đất ở hai mô hình canh tác đốt rơm và không đốt rơm sau thu hoạch trên vùng trồng lúa thâm canh', '2012-07-01', '2013-11-30', 3, 0, '30000000', 2, 0, 9, NULL, 1, 15, '', 2012, 0, NULL, 1, NULL),
(108, 'CS2012-24', 'Điều tra và đánh giá việc sử dụng chế phẩm sinh học để ủ phân mùn từ rơm tại huyện Cái Bè, tỉnh Tiền Giang', '2012-07-01', '2013-03-31', 3, 0, '30000000', 2, 0, 9, NULL, 1, 15, '', 2012, 0, NULL, 1, NULL),
(109, 'CS2012-25', 'Đề xuất các giải pháp quản lý môi trường theo tiêu chí Quốc gia về nông thôn mới tại xã Bình Hoà, huyện Vĩnh Cửu, tỉnh Đồng Nai', '2012-07-01', '2013-03-31', 3, 0, '30000000', 2, 0, 9, NULL, 1, 15, '', 2012, 0, NULL, 1, NULL),
(110, 'CS2012-26', 'Nghiên cứu khả năng xử lý khí NH3 bằng hệ xúc tác quang hoá TiO2', '2012-07-01', '2013-03-31', 3, 0, '30000000', 2, 0, 9, NULL, 1, 15, '', 2012, 0, NULL, 1, NULL),
(111, 'CS2012-27', 'Nghiên cứu khả năng xử lý khí COD của nước ô nhiễm bằng hệ xúc tác quang hoá TiO2', '2012-07-01', '2012-03-31', 3, 0, '30000000', 2, 0, 9, NULL, 1, 15, '', 2012, 0, NULL, 1, NULL),
(112, 'CS2012-28', 'Đánh giá rui ro chất lượng nước sông Đồng Nai phục vụ cấp nước an toàn khu vực thành phố Hồ Chí Minh (đoạn cầu Hoá An)', '2012-07-01', '2013-03-31', 3, 0, '30000000', 2, 0, 9, NULL, 1, 15, '', 2012, 0, NULL, 1, NULL),
(113, 'CS2012-29', 'Tiếp cận thi ca từ nguyên lí của Kí hiệu học', '2012-07-01', '2013-06-30', 3, 0, '15000000', 2, 0, 4, NULL, 1, 4, '', 2012, 0, NULL, 1, NULL),
(114, 'CS2012-30', 'Khảo sát xây dựng hệ thống kỹ năng trong đào tạo nghiệp vụ du lịch của khoa Văn hoá – Du lịch', '2012-07-01', '2013-03-31', 3, 0, '25000000', 2, 0, 8, NULL, 1, 13, '', 2012, 0, NULL, 1, NULL),
(115, 'CS2012-31', 'Đổi mới chương trình và nội dung giảng dạy thanh nhạc cho sinh viên đại học sư phạm năm thứ hai', '2012-07-01', '2013-03-31', 3, 0, '25000000', 2, 0, 1, NULL, 1, 9, '', 2012, 0, NULL, 1, NULL),
(116, 'CS2012-32', 'Nghiên cứu lựa chọn phần mềm mô phỏng mạch điện tử để nâng cao hiệu quả giảng dạy thí nghiệm, thực hành tại khoa Điện tử viễn thông Trường Đại học Sài Gòn', '2012-07-31', '2013-07-31', 3, 0, '19900000', 2, 0, 7, NULL, 1, 19, '', 2012, 0, NULL, 1, NULL),
(117, 'CS2012-33', 'Nghiên cứu lý thuyết xử lý điểm Poisson và ứng dụng tính toán xác suất kết nối trong mạng thông tin Ad Hoc giữa các xe', '2012-07-01', '2013-08-31', 3, 0, '24000000', 2, 0, 7, NULL, 1, 19, '', 2012, 0, NULL, 1, NULL),
(118, 'CS2012-34', 'Nghiên cứu và ứng dụng phương pháp tiếp cận CDIO (Conceive – Design – Implement - Operate) vào việc phát triển chương trình đào tạo kỹ sư ngành Công nghệ kỹ thuật điện tử, truyền thông.', '2012-07-01', '2013-06-30', 3, 0, '20000000', 2, 0, 7, NULL, 1, 19, '', 2012, 0, NULL, 1, NULL),
(119, 'CS2012-35', 'Thiết kế các bài thực hành mạch điện', '2012-07-01', '2013-05-31', 3, 0, '15000000', 2, 0, 7, NULL, 1, 2, '', 2012, 0, NULL, 1, NULL),
(120, 'CS2012-36', 'Thiết kế KIT thực hành vi xử lý và biên soạn tài liệu thực hành vi xử lý', '2012-07-01', '2013-05-31', 3, 0, '29420000', 2, 0, 7, NULL, 1, 19, '', 2012, 0, NULL, 1, NULL),
(121, 'CS2012-37', 'Nâng cao hiệu quả sử dụng phương pháp thảo luận nhóm trong giảng dạy bộ môn Những nguyên lý cơ bản của Chủ nghĩa Mác – Lênin', '2012-07-01', '2014-01-31', 3, 0, '25000000', 2, 0, 1, NULL, 1, 17, '', 2012, 0, NULL, 1, NULL),
(122, 'CS2012-38', 'Nghiên cứu lựa chọn một số bài tập thể chất nội khoá đển nâng cao thể lực cho nữ sinh viên có thể lực yếu của Trường Đại học Sài Gòn', '2012-07-01', '2013-03-31', 3, 0, '25000000', 2, 0, 1, NULL, 1, 51, '', 2012, 0, NULL, 1, NULL),
(123, 'CS2012-39', 'Khảo sát việc làm của sinh viên tốt nghiệp năm 2010 của trường Đại học Sài Gòn (Hệ Cao đẳng)', '2012-07-01', '2013-03-31', 3, 0, '25000000', 2, 0, 1, NULL, 1, 31, '', 2012, 0, NULL, 1, NULL),
(124, 'CS2012-40', 'Các biện pháp quản lí nâng cao chất lượng hoạt động thực tập sư phạm trong đào tạo giáo viên Trung học phổ thông ở trường Đại học Sài Gòn', '2012-07-01', '2013-03-31', 3, 0, '25000000', 2, 0, 1, NULL, 1, 27, '', 2012, 0, NULL, 1, NULL),
(125, 'CS2012-41', 'Đánh giá sự phát triển của Trường Đại học Sài Gòn qua công tác tự đánh giá trong 3 năm học, từ năm 2008 đến 2011', '2012-07-01', '2013-03-31', 3, 0, '25000000', 2, 0, 1, NULL, 1, 21, '', 2012, 0, NULL, 1, NULL),
(126, 'CS2012-42', 'Đánh giá tác động của văn hoá chất lượng đến hoạt động đảm bảo chất lượng giáo dục trong nhà trường', '2012-07-01', '2013-03-31', 3, 0, '25000000', 2, 0, 4, NULL, 1, 21, '', 2012, 0, NULL, 1, NULL),
(127, 'CS2012-43', 'Đánh giá mức độ phù hợp giữa chương trình đào tạo đại học khối ngành kinh tế với nhu cầu tuyển dụng của thị trường lao động (Nghiên cứu tại trường Đại học Sài Gòn)', '2012-07-01', '2013-03-31', 3, 0, '25000000', 2, 0, 1, NULL, 1, 21, '', 2012, 0, NULL, 1, NULL),
(128, 'CS2012-44', 'Ứng dụng phần mềm mã nguồn mở Dspace xây dựng bộ sưu tập thư viện số', '2012-07-01', '2013-03-31', 3, 0, '23500000', 2, 0, 7, NULL, 1, 30, '', 2012, 0, NULL, 1, NULL),
(129, 'CS2012-45', 'Nâng cao chất lượng các dịch vụ Thông tin – Thư viện tại Trung tâm học liệu Trường Đại học Sài Gòn', '2012-07-01', '2013-03-31', 3, 0, '22200000', 2, 0, 1, NULL, 1, 30, '', 2012, 0, NULL, 1, NULL),
(130, 'CS2012-46', 'Hiệu quả chương trình can thiệp phòng chống các yếu tố nguy cơ của bệnh không lây trên nhân viên văn phòng trường Đại học Sài Gòn.', '2012-07-01', '2013-03-31', 3, 0, '29500000', 2, 0, 1, NULL, 1, 46, '', 2012, 0, NULL, 1, NULL),
(131, 'CS2012-47', 'Nghiên cứu ảnh hưởng của ánh sáng và thành phần hỗn hợp ruột bầu đến sự phát triển của cây Đầu lân (Couroupita guianensis Aubl.) trong giai đoạn vườn ươm', '2012-07-01', '2013-03-31', 3, 0, '15000000', 2, 0, 6, NULL, 1, 60, '', 2012, 0, NULL, 1, NULL),
(132, 'CS2012-48', 'Nghiên cứu và ứng dụng phương pháp Dự án ( The Project method ) vào hoạt động dạy học và giáo dục kĩ năng sống cho học sinh ở trường TH Thực hành Sài Gòn', '2012-07-01', '2014-10-31', 3, 0, '25000000', 2, 0, 6, NULL, 1, 60, '', 2012, 0, NULL, 1, NULL),
(133, 'TL2012-01', 'Tài liệu tham khảo học phần Điện động lực học', '2012-07-01', '2013-03-31', 3, 0, '20000000', 2, 0, 10, NULL, 1, 20, '', 2012, 0, NULL, 1, NULL),
(134, 'TL2012-02', 'Tài liệu tham khảo Bài tập học phần Quang phổ', '2012-07-01', '2013-03-31', 3, 0, '15000000', 2, 0, 10, NULL, 1, 20, '', 2012, 0, NULL, 1, NULL),
(135, 'TL2012-03', 'Tài liệu tham khảo Hoá phân tích 1', '2012-07-01', '2013-03-31', 3, 0, '20000000', 2, 0, 10, NULL, 1, 20, '', 2012, 0, NULL, 1, NULL),
(136, 'TL2012-04', 'Bài tập Xác suất thống kê (Phần 1)', '2012-07-01', '2013-03-31', 3, 0, '20000000', 2, 0, 10, NULL, 1, 2, '', 2012, 0, NULL, 1, NULL),
(137, 'TL2012-05', 'Tài liệu tham khảo học phần Cấu trúc Dữ liệu và giải thuật', '2012-07-01', '2013-03-31', 3, 0, '20000000', 2, 0, 10, NULL, 1, 10, '', 2012, 0, NULL, 1, NULL),
(138, 'TL2012-06', 'Bài tập Cơ sở dữ liệu quan hệ', '2012-07-01', '2013-03-31', 3, 0, '20000000', 2, 0, 10, NULL, 1, 10, '', 2012, 0, NULL, 1, NULL),
(139, 'TL2012-07', 'Tài liệu tham khảo về Quản trị và bảo trì mạng', '2012-07-01', '2013-03-31', 3, 0, '20000000', 2, 0, 10, NULL, 1, 10, '', 2012, 0, NULL, 1, NULL),
(140, 'TL2012-08', 'Hệ thống câu hỏi trắc nghiệm và bài tập môn học Nguyên lý kế toán', '2012-07-01', '2013-03-31', 3, 0, '18000000', 2, 0, 10, NULL, 1, 14, '', 2012, 0, NULL, 1, NULL),
(141, 'TL2012-09', 'Tài liệu học tập bộ môn Đường lối cách mạng của Đảng Cộng sản Việt Nam', '2012-07-01', '2014-01-31', 3, 0, '20000000', 2, 0, 10, NULL, 1, 17, '', 2012, 0, NULL, 1, NULL),
(142, 'GT2012-01', 'Giáo trình môn Thiên văn học đại cương', '2012-07-01', '2013-03-31', 3, 0, '20000000', 2, 0, 5, NULL, 1, 20, '', 2012, 0, NULL, 1, NULL),
(143, 'GT2012-02', 'Giáo trình môn Phức chất trong Hoá vô cơ', '2012-07-01', '2013-03-31', 3, 0, '20000000', 2, 0, 5, NULL, 1, 20, '', 2012, 0, NULL, 1, NULL),
(144, 'GT2012-03', 'Giáo trình Giải tích 2 dùng cho việc đào tạo sinh viên khoa Toán - Ứng dụng và sinh viên đa ngành', '2012-07-01', '2013-03-31', 3, 0, '20000000', 2, 0, 5, NULL, 1, 2, '', 2012, 0, NULL, 1, NULL),
(145, 'GT2012-04', 'Giáo trình Đại số đại cương', '2012-07-01', '2013-03-31', 3, 0, '20000000', 2, 0, 5, NULL, 1, 2, '', 2012, 0, NULL, 1, NULL),
(146, 'GT2012-05', 'Giáo trình Phương trình đạo hàm riêng', '2012-07-01', '2013-12-31', 3, 0, '20000000', 2, 0, 5, NULL, 1, 2, '', 2012, 0, NULL, 1, NULL),
(147, 'GT2012-06', 'Giáo trình Lịch sử Việt Nam từ 1975 đến 2010', '2012-07-01', '2013-12-31', 3, 0, '20000000', 2, 0, 5, NULL, 1, 3, '', 2012, 0, NULL, 1, NULL),
(148, 'GT2012-07', 'Giáo trình điện tử Khoa học trái đất', '2012-07-01', '2013-03-31', 3, 0, '20000000', 2, 0, 5, NULL, 1, 3, '', 2012, 0, NULL, 1, NULL),
(149, 'GT2012-08', 'Giáo trình Tin học Văn phòng (dành cho SV không chuyên Tin học ngành Anh văn Du lịch)', '2012-07-01', '2013-03-31', 3, 0, '20000000', 2, 0, 5, NULL, 1, 10, '', 2012, 0, NULL, 1, NULL),
(150, 'GT2012-09', 'Giáo trình Giải tích mạch điện', '2012-07-01', '2013-05-31', 3, 0, '20000000', 2, 0, 5, NULL, 1, 19, '', 2012, 0, NULL, 1, NULL),
(151, 'GT2012-10', 'Giáo trình Cấu kiện điện tử', '2012-07-01', '2013-05-31', 3, 0, '20000000', 2, 0, 5, NULL, 1, 19, '', 2012, 0, NULL, 1, NULL),
(152, 'GT2012-11', 'Giáo trình Truyền dẫn vô tuyến số', '2012-07-01', '2013-08-31', 3, 0, '16000000', 2, 0, 5, NULL, 1, 19, '', 2012, 0, NULL, 1, NULL),
(153, 'GT2012-12', 'Giáo trình Thị trường tài chính', '2012-07-01', '2013-03-31', 3, 0, '20000000', 2, 0, 5, NULL, 1, 14, '', 2012, 0, NULL, 1, NULL),
(154, 'GT2012-13', 'Giáo trình Thuế', '2012-07-01', '2013-03-31', 3, 0, '20000000', 2, 0, 5, NULL, 1, 14, '', 2012, 0, NULL, 1, NULL),
(155, 'GT2012-14', 'Giáo trình Kế toán tài chính 1', '2012-07-01', '2013-04-30', 3, 0, '20000000', 2, 0, 5, NULL, 1, 14, '', 2012, 0, NULL, 1, NULL),
(156, 'GT2012-15', 'Giáo trình Pháp luật đại cương', '2012-07-01', '2013-03-31', 3, 0, '20000000', 2, 0, 5, NULL, 1, 18, '', 2012, 0, NULL, 1, NULL),
(157, 'GT2012-16', 'Giáo trình Văn hoá ẩm thực Việt Nam', '2012-07-01', '2013-10-31', 3, 0, '20000000', 2, 0, 5, NULL, 1, 6, '', 2012, 0, NULL, 1, NULL),
(158, 'CS2010-06', 'Đổi mới phương pháp dạy học theo hệ thống tín chỉ tại khoa Sư phạm khoa học xã hội trường Đại học Sài Gòn', '2009-08-01', '2010-05-31', 4, 0, '14000000', 2, 4, 1, NULL, 1, 26, '', 2010, 0, NULL, 1, NULL),
(159, 'CS2010-14', 'Tiếng Việt trực tuyến giai đoạn 2 (dùng cho hệ thống trực tuyến (E-learning System) của trường ĐHSG)', '2009-09-01', '2010-05-31', 4, 0, '16000000', 2, 3, 8, NULL, 1, 26, '', 2010, 0, NULL, 1, NULL),
(160, 'CS2010-34', 'Điều chế TiO2 bằng phương pháp axit sunfuric có áp suất từ tinh quặng Ilmenite', '2009-12-01', '2011-01-31', 4, 0, '12000000', 2, 0, 6, NULL, 1, 20, '', 2010, 0, NULL, 1, NULL),
(161, 'CS2010-01', 'Bài toán Cauchy đối với phương trình tích phân kì dị', '2009-10-01', '2011-10-31', 3, 12, '10000000', 2, 0, 6, NULL, 1, 2, '', 2010, 0, NULL, 1, NULL),
(162, 'CS2010-02', 'Chỉnh hóa và đánh giá sai số cho nghiệm của bài toán nhiệt ngược', '2009-12-01', '2011-01-31', 4, 0, '10000000', 2, 4, 6, NULL, 1, 2, '', 2010, 0, NULL, 1, NULL),
(163, 'CS2010-15', 'Phương thức tiếp cận không gian, thời gian trong thơ ca dưới góc độ ngôn ngữ học', '2009-12-01', '2011-01-31', 4, 0, '10000000', 2, 2, 4, NULL, 1, 4, '', 2010, 0, NULL, 1, NULL),
(164, 'CS2010-24', 'Hình thành kỹ năng cảm thụ âm nhạc của trẻ 5-6 tuổi thông qua nghe hát – nghe nhạc ở trường mầm non', '2010-01-01', '2012-12-31', 3, 12, '14000000', 2, 0, 1, NULL, 1, 5, '', 2010, 0, NULL, 1, NULL),
(165, 'CS2010-29', 'Xây dựng ngân hàng đề thi môn lý luận chung về Nhà nước và Pháp luật', '2009-11-01', '2010-10-31', 4, 0, '10000000', 2, 0, 1, NULL, 1, 18, '', 2010, 0, NULL, 1, NULL),
(166, 'CS2010-33', 'Đánh giá sự hài lòng của sinh viên hình thức VHVL trường Đại học Sài Gòn', '2009-12-01', '2011-01-25', 4, 0, '14000000', 2, 3, 2, NULL, 1, 22, '', 2010, 0, NULL, 1, NULL),
(167, 'CS2010-35', 'Tư liệu nghiên cứu học tập tư tưởng Hồ Chí Minh', '2009-12-01', '2011-01-20', 4, 0, '10000000', 2, 3, 1, NULL, 1, 25, '', 2010, 0, NULL, 1, NULL),
(168, 'CS2010-30', 'Khảo sát tình hình việc làm của sinh viên sau khi tốt nghiệp', '2009-12-01', '2011-04-06', 4, 0, '16000000', 2, 3, 2, NULL, 1, 31, '', 2010, 0, NULL, 1, NULL),
(169, 'CS2010-31', 'Xây dựng và đánh giá chất lượng ngân hàng đề thi “Toán rời rạc” dựa trên mô hình RASCH', '2009-12-01', '2011-04-15', 4, 0, '10000000', 2, 4, 1, NULL, 1, 21, '', 2010, 0, NULL, 1, NULL),
(170, 'CS2008-07', 'Phát triển thao tác so sánh của trẻ 5-6 tuổi trong hoạt động khám phá khoa học', '2008-04-01', '2011-05-31', 4, 0, '0', 2, 4, 1, NULL, 1, 5, '', 2008, 0, NULL, 1, NULL),
(171, 'CS2008-08', 'Sưu tầm các trò chơi phân loại cho trẻ mẫu giáo', '2008-06-01', '2011-07-26', 4, 0, '0', 2, 4, 1, NULL, 1, 5, '', 2008, 0, NULL, 1, NULL),
(172, 'CS2010-23', 'Xây dựng một số trò chơi nhằm phát triển kỹ năng xã hội của trẻ mẫu giáo 5-6 tuổi', '2010-01-01', '2012-12-31', 3, 0, '14000000', 2, 0, 1, NULL, 1, 5, '', 2010, 0, NULL, 1, NULL),
(173, 'CS2010-08', 'Lịch sử hình thành và phát triển trường Đại học Sài Gòn', '2009-11-01', '2011-11-30', 3, 0, '14250000', 2, 0, 4, NULL, 1, 3, '', 2010, 0, NULL, 1, NULL),
(174, 'CS2010-18', 'Đề xuất chương trình Sản xuất sạch hơn tại Nhà máy chế biến cao su Đại Phước Tài (Đề xuất chương trình sản xuất sạch hơn lượng nước tiêu thụ)', '2010-04-01', '2012-04-30', 3, 0, '16000000', 2, 0, 1, NULL, 1, 15, '', 2010, 0, NULL, 1, NULL),
(175, 'CS2010-17', 'Biên soạn Giáo trình Hóa Môi trường', '2010-03-01', '2011-12-31', 3, 0, '12000000', 2, 0, 9, NULL, 1, 15, '', 2010, 0, NULL, 1, NULL),
(176, 'CS2010-28', 'Chiến lược phát triển khoa Quản Trị Kinh Doanh giai đoạn 2010-2020', '2009-12-01', '2010-10-31', 3, 0, '10000000', 2, 0, 2, NULL, 1, 11, '', 2010, 0, NULL, 1, NULL),
(177, 'CS2009-01', 'Phân tích và kiểm tra kế toán nhằm phát hiện sai sót và gian lận ở các doanh nghiệp', '2009-01-01', '2010-03-31', 4, 0, '5000000', 2, 2, 2, NULL, 1, 26, '', 2009, 0, NULL, 1, NULL),
(178, 'CS2009-03', 'Phân tích nhân tố tác động rủi ro lạm phát trong kinh tế', '2009-03-01', '2010-08-31', 3, 0, '5000000', 2, 0, 2, NULL, 1, 14, '', 2009, 0, NULL, 1, NULL),
(179, 'CS2008-11', 'Hướng dẫn sinh viên hệ Cao đẳng chính quy khoa Giáo dục Mầm non lập kế hoạch dạy học tích hợp cho trẻ mẫu giáo', '2008-06-01', '2010-06-30', 3, 0, '5000000', 2, 0, 1, NULL, 1, 5, '', 2008, 0, NULL, 1, NULL),
(180, 'CS2008-09', 'Sử dụng hệ thống bài tập phát triển ngôn ngữ cho trẻ mẫu giáo ở trường Mầm non', '2008-07-01', '2010-12-31', 3, 0, '5000000', 2, 0, 1, NULL, 1, 5, '', 2008, 0, NULL, 1, NULL),
(181, 'CS2009-05', 'Khảo sát sự thay đổi nồng độ đạm, lân và BOD trong nước thải lò mổ gia súc có trồng thủy canh cỏ Vetiver (Vertiver zizianoides I…) và trong nước thải nuôi tôm thẻ chân trắng trong hồ lọc sinh học bằng', '2009-03-01', '2010-03-31', 4, 0, '5000000', 2, 2, 9, NULL, 1, 15, '', 2009, 0, NULL, 1, NULL),
(296, 'CS2014-01', 'Nghiên cứu chế tạo keo bạc Nano sử dụng Chitosan tan trong nước làm chất khử /chất ổn định', '2014-09-23', '2015-09-30', 3, 0, '40000000', 2, 0, 6, NULL, 1, 20, '', 2014, 0, NULL, 1, NULL),
(297, 'CS2014-02', 'Nghiên cứu chế tạo chitosan khối lượng phân tử thấp có hoạt tính kháng khuẩn', '2014-09-23', '2015-09-30', 3, 0, '40000000', 2, 0, 6, NULL, 1, 20, '', 2014, 0, NULL, 1, NULL),
(298, 'CS2014-03', 'Xây dựng cơ sở dữ liệu DNA vùng CR (Control Region) của DNA ty thể chó (Canis familiaris)', '2014-09-23', '2015-09-30', 3, 0, '4', 2, 0, 6, NULL, 1, 20, '', 2014, 0, NULL, 1, NULL),
(299, 'CS2014-04', 'Nghiên cứu giải trình tự vùng CR Genome ty thể chó Phú Quốc (Canis familiaris) để xác định mối quan hệ di truyền giữa 2 giống chó lưng có xoáy Phú Quốc và Thái Lan', '2014-09-23', '2015-09-30', 3, 0, '40000000', 2, 0, 6, NULL, 1, 20, '', 2014, 0, NULL, 1, NULL),
(300, 'CS2014-05', 'Xây dựng cơ sở dữ liệu một số loài thực vật bậc cao tại huyện Ninh Hải – Tỉnh Ninh Thuận', '2014-09-23', '2015-09-30', 3, 0, '40000000', 2, 0, 6, NULL, 1, 20, '', 2014, 0, NULL, 1, NULL),
(301, 'CS2014-06', 'Phân lập, tuyển chọn, định danh các vi khuẩn nội sinh trong cây Ngô (Zea mays L.) trồng trên vùng đất xám vùng Đông Nam Bộ có khả năng cố định đạm và hoà tan lân', '2014-09-23', '2015-09-30', 3, 0, '40000000', 2, 0, 1, NULL, 1, 20, '', 2014, 0, NULL, 1, NULL),
(302, 'CS2014-07', 'Xây dựng bộ tư liệu hỗ trợ dạy học học phần phương pháp dạy học sinh học THPT 2 cho sinh viên trường ĐHSG', '2014-09-23', '2015-09-30', 3, 0, '35000000', 2, 0, 6, NULL, 1, 20, '', 2014, 0, NULL, 1, NULL),
(303, 'CS2014-08', 'Đánh giá năng lực ứng dụng công nghệ thông tin của sinh viên ngành sư phạm trường Đại học Sài Gòn trong thiết kế bài dạy sinh học', '2014-09-23', '2015-09-30', 3, 0, '35000000', 2, 0, 6, NULL, 1, 20, '', 2014, 0, NULL, 1, NULL),
(304, 'CS2014-63', 'Đặc điểm thơ thiếu nhi ở TP.Hồ Chí Minh sau 1975', '2014-09-23', '2015-09-30', 3, 0, '30000000', 2, 0, 4, NULL, 1, 3, '', 2014, 0, NULL, 1, NULL),
(305, 'CS2014-64', 'Tri nhận nghiệm thân – Từ lí thuyết đến nghiên cứu trên thực tiễn tiếng Việt', '2014-09-23', '2015-09-30', 3, 0, '35000000', 2, 0, 4, NULL, 1, 3, '', 2014, 0, NULL, 1, NULL),
(306, 'CS2014-65', 'So sánh quá trình truyền bá ngôn ngữ của thực dân Anh ở Ấn Độ và thực dân Pháp ở Việt Nam', '2014-09-23', '2016-09-30', 3, 0, '3', 2, 0, 4, NULL, 1, 3, '', 2014, 0, NULL, 1, NULL),
(307, 'CS2014-66', 'Chủ nghĩa thực dân: lịch sử và hệ quả (trường hợp thực dân Pháp ở Đông Dương thế kỷ XIX-XX)', '2014-09-23', '2016-09-30', 3, 0, '35000000', 2, 0, 4, NULL, 1, 3, '', 2014, 0, NULL, 1, NULL),
(308, 'CS2014-67', 'Đổi mới kiểm tra đánh giá theo hướng tiếp cận năng lực trong dạy học Địa lí 10 - THPT', '2014-09-23', '2015-09-30', 3, 0, '40000000', 2, 0, 4, NULL, 1, 3, '', 2014, 0, NULL, 1, NULL),
(309, 'CS2014-09', 'Nghiên cứu nhân giống hoa lan Dendrobium Mini lai bằng phương pháp nuôi cây In Vitro', '2014-09-23', '2016-09-30', 3, 0, '40000000', 2, 0, 6, NULL, 1, 50, '', 2014, 0, NULL, 1, NULL),
(310, 'CS2014-10', 'Nghiên cứu sự đa dạng của chi tảo hai roi Alexandrium ở vùng biển ven bờ từ Bến Tre đến Trà Vinh', '2014-09-23', '2015-09-30', 3, 0, '40000000', 2, 0, 6, NULL, 1, 60, '', 2014, 0, NULL, 1, NULL),
(311, 'CS2014-11', 'Đánh giá rủi ro hàm lượng kim loại nặng (Pb,Cd, As, ZN) trong rau muống ở TP.HCM đến sức khoẻ con người', '2014-09-23', '2015-09-30', 3, 0, '40000000', 2, 0, 9, NULL, 1, 15, '', 2014, 0, NULL, 1, NULL),
(312, 'CS2014-12', 'Đánh giá rủi ro hàm lượng ion Cadimi, Crom và Chì trong Rau rút (Neptunia Oleracea) và Ngó sen (Nelumbo nucifera) trồng ở TP.HCM', '2014-09-23', '2015-09-30', 3, 0, '40000000', 2, 0, 9, NULL, 1, 15, '', 2014, 0, NULL, 1, NULL),
(313, 'CS2014-13', 'Khảo sát sự phú dưỡng hoá và phát sinh độc tố microcystin trong các ao hồ nuôi trồng thủy sản ở TP.HCM', '2014-09-23', '2016-09-30', 3, 0, '40000000', 2, 0, 9, NULL, 1, 15, '', 2014, 0, NULL, 1, NULL),
(314, 'CS2014-14', 'Ảnh hưởng của cách bón phân đạm đến sự phát thải khí N20 trong canh tác lúa ở Đồng bằng Sông Cửu Long', '2014-09-23', '2015-09-30', 3, 0, '40000000', 2, 0, 9, NULL, 1, 15, '', 2014, 0, NULL, 1, NULL),
(315, 'CS2014-15', 'Nghiên cứu sản xuất khí sinh học từ bùn tuyển nổi nhà máy chế biến thủy sản An Mỹ - An Giang', '2014-09-23', '2015-09-30', 3, 0, '40000000', 2, 0, 9, NULL, 1, 15, '', 2014, 0, NULL, 1, NULL),
(316, 'CS2014-16', 'Khảo sát thành phần hoá học cao cloroform và etyl acetat của cây An điền Lindley Hedyotis lindleyana Hook, họ cà phê Rubiaceae', '2014-09-23', '2015-09-30', 3, 0, '40000000', 2, 0, 9, NULL, 1, 15, '', 2014, 0, NULL, 1, NULL),
(317, 'CS2014-17', 'Đánh giá hiệu quả của chương trình thí điểm phân loại chất thải rắn sinh hoạt tại nguồn tại phường Bến Nghé, quận 1, TP.HCM (giai đoạn 1)', '2014-09-23', '2015-09-30', 3, 0, '35000000', 2, 0, 9, NULL, 1, 15, '', 2014, 0, NULL, 1, NULL),
(318, 'CS2014-18', 'Nâng cao khả năng thu thập ý kiến cộng đồng về công tác quản lí môi trường kênh rạch tại TP.HCM thông qua hệ thống câu hỏi điện tử', '2014-09-23', '2015-09-30', 3, 0, '35000000', 2, 0, 9, NULL, 1, 15, '', 2014, 0, NULL, 1, NULL),
(319, 'CS2014-19', 'Xây dựng chương trình nâng cao nhận thức cộng đồng về công tác bảo vệ môi trường kênh rạch tại TP.HCM', '2014-09-23', '2015-09-30', 3, 0, '35000000', 2, 0, 9, NULL, 1, 15, '', 2014, 0, NULL, 1, NULL),
(320, 'CS2014-20', 'Nghiên cứu kỹ thuật phổ khối lượng cảm ứng plasma và ứng dụng vào kiểm tra hàm lượng kim loại nặng trong sản phẩm chitosan được sản xuất tại phòng thí nghiệm của trường ĐHSG', '2014-09-23', '2016-09-30', 3, 0, '40000000', 2, 0, 9, NULL, 1, 15, '', 2014, 0, NULL, 1, NULL),
(321, 'CS2014-21', 'Nghiên cứu loại màu nước thải cà phê bằng phương pháp keo tụ điện hóa', '2014-09-23', '2016-09-30', 3, 0, '40000000', 2, 0, 9, NULL, 1, 15, '', 2014, 0, NULL, 1, NULL),
(322, 'CS2014-22', 'Mở rộng mô hình cơ sở dữ liệu quan hệ với giá trị tập mờ', '2014-09-23', '2015-09-30', 3, 0, '39900000', 2, 0, 6, NULL, 1, 10, '', 2014, 0, NULL, 1, NULL),
(323, 'CS2014-23', 'So sánh các thuật toán phân loại ảnh số (image classification algorithms)', '2014-09-23', '2015-09-30', 3, 0, '39000000', 2, 0, 7, NULL, 1, 10, '', 2014, 0, NULL, 1, NULL),
(324, 'CS2014-24', 'Giải quyết bài toán định tuyến có ràng buộc băng thông và độ trễ trong mạng tốc độ cao', '2014-09-23', '2015-09-30', 3, 0, '35000000', 2, 0, 7, NULL, 1, 10, '', 2014, 0, NULL, 1, NULL),
(325, 'CS2014-25', 'Triển khai tổng đài điện thoại trên kiến trúc ARM (implement voice over IP service to ARM architech)', '2014-09-23', '2015-09-30', 3, 0, '38000000', 2, 0, 7, NULL, 1, 10, '', 2014, 0, NULL, 1, NULL),
(326, 'CS2014-26', 'Cải tiến phương pháp dự đoán dấu liên kết trong mạng xã hội có dấu', '2014-09-23', '2015-09-30', 3, 0, '35000000', 2, 0, 7, NULL, 1, 10, '', 2014, 0, NULL, 1, NULL),
(327, 'CS2014-27', 'Giải pháp nâng cao chất lượng đào tạo các lớp chuyên tin tại trường THTH Sài Gòn', '2014-09-23', '2015-09-30', 3, 0, '40000000', 2, 0, 7, NULL, 1, 10, '', 2014, 0, NULL, 1, NULL),
(328, 'CS2014-28', 'Thiết kế và chế tạo các bộ thí nghiệm điện tử số', '2014-09-23', '2015-09-30', 3, 0, '40000000', 2, 0, 7, NULL, 1, 19, '', 2014, 0, NULL, 1, NULL),
(329, 'CS2014-29', 'Thiết kế và chế tạo các bộ thí nghiệm điện tử', '2014-09-23', '2015-09-30', 3, 0, '40000000', 2, 0, 7, NULL, 1, 19, '', 2014, 0, NULL, 1, NULL),
(330, 'CS2014-30', 'Thiết kế chương trình mô phỏng học phần xử lý số tín hiệu bằng Matlab', '2014-09-23', '2015-09-30', 3, 0, '35000000', 2, 0, 7, NULL, 1, 19, '', 2014, 0, NULL, 1, NULL),
(331, 'CS2014-31', 'Thiết kế và chế tạo hệ thống giám sát, điều khiển tự động nhà trạm viễn thông không người trực', '2014-09-23', '2015-09-30', 3, 0, '40000000', 2, 0, 7, NULL, 1, 19, '', 2014, 0, NULL, 1, NULL),
(332, 'CS2014-32', 'Nghiên cứu giải thuật điều khiển nâng cao máy phát điện gió không đồng bộ ba pha nguồn kép kết nối với lưới điện gió ba pha không cân bằng', '2014-09-23', '2015-09-30', 3, 0, '30000000', 2, 0, 7, NULL, 1, 19, '', 2014, 0, NULL, 1, NULL),
(333, 'CS2014-33', 'Chỉnh hoá bài toán parabolic ngược với hệ số dẫn nhiệt bị nhiễu', '2014-09-23', '2015-09-30', 3, 0, '30000000', 2, 0, 6, NULL, 1, 2, '', 2014, 0, NULL, 1, NULL),
(334, 'CS2014-34', 'Luật mạnh số lớn đối với các biến ngẫu nhiên có cấu trúc phụ thuộc', '2014-09-23', '2015-09-30', 3, 0, '30000000', 2, 0, 6, NULL, 1, 2, '', 2014, 0, NULL, 1, NULL),
(335, 'CS2014-35', 'Bài toán giá trị biên cho phương trình vi phân cấp một', '2014-09-23', '2015-09-30', 3, 0, '30000000', 2, 0, 6, NULL, 1, 2, '', 2014, 0, NULL, 1, NULL),
(336, 'CS2014-36', 'Ứng dụng kinh tế lượng trong bài toán ước lượng năng suất các yếu tố tổng hợp và xem xét sự hội tụ theo cấp độ cơ sở trong ngành dệt may Việt Nam giai đoạn 2000-2011', '2014-09-23', '2015-09-30', 3, 0, '30000000', 2, 0, 2, NULL, 1, 2, '', 2014, 0, NULL, 1, NULL),
(337, 'CS2014-37', 'Môđun chéo aben và phạm trù Picard chặt chẽ', '2014-09-23', '2015-09-30', 3, 0, '30000000', 2, 0, 6, NULL, 1, 2, '', 2014, 0, NULL, 1, NULL),
(338, 'CS2014-38', 'Nghiệm tối ưu và nghiệm tối ưu xấp xỉ của bài toán tối ưu không lồi và có vô hạn ràng buộc', '2014-09-23', '2015-09-30', 3, 0, '30000000', 2, 0, 6, NULL, 1, 25, '', 2014, 0, NULL, 1, NULL),
(339, 'CS2014-39', 'Thực trạng mức độ tương tác trên lớp giữa giảng viên và sinh viên trường Đại học Sài Gòn', '2014-09-23', '2015-09-30', 3, 0, '35000000', 2, 0, 1, NULL, 1, 16, '', 2014, 0, NULL, 1, NULL),
(340, 'CS2014-40', 'Quản lí thực tập chuyên môn trong đào tạo cử nhân Quản lí Giáo dục tại trường Đại học Sài Gòn', '2014-09-23', '2016-09-30', 3, 0, '35000000', 2, 0, 1, NULL, 1, 16, '', 2014, 0, NULL, 1, NULL),
(341, 'CS2014-41', 'Đánh giá kết quả dạy học theo dự án trong học phần Văn hoá ẩm thực, ngành Sư phạm Kinh tế gia đình, Trường Đại học Sài Gòn', '2014-09-23', '2016-09-30', 3, 0, '35000000', 2, 0, 1, NULL, 1, 16, '', 2014, 0, NULL, 1, NULL),
(342, 'CS2014-42', 'Xây dựng công cụ đánh giá năng lực nghiên cứu khoa học của giảng viên trường ĐHSG', '2014-09-23', '2016-09-30', 3, 0, '35000000', 2, 0, 1, NULL, 1, 26, '', 2014, 0, NULL, 1, NULL),
(343, 'CS2014-43', 'Xây dựng công cụ trực tuyến lấy ý kiến phản hồi từ người học về hoạt động giảng dạy của giảng viên', '2014-09-23', '2015-09-30', 3, 0, '35000000', 2, 0, 1, NULL, 1, 21, '', 2014, 0, NULL, 1, NULL),
(344, 'CS2014-44', 'Đánh giá mức độ đáp ứng công việc của SV tốt nghiệp (Nghiên cứu khối ngành Kinh tế tại trường Đại học Sài Gòn)', '2014-09-23', '2015-09-30', 3, 0, '35000000', 2, 0, 1, NULL, 1, 21, '', 2014, 0, NULL, 1, NULL),
(345, 'CS2014-45', 'Ứng dụng lý thuyết hệ thống vào xây dựng mô hình văn hoá chất lượng tại trường Đại học Sài Gòn', '2014-09-23', '2015-09-30', 3, 0, '35000000', 2, 0, 1, NULL, 1, 21, '', 2014, 0, NULL, 1, NULL),
(346, 'CS2014-46', 'Xây dựng chương trình phát triển giáo dục ở trường ĐHSG', '2014-09-23', '2015-09-30', 3, 0, '35000000', 2, 0, 1, NULL, 1, 61, '', 2014, 0, NULL, 1, NULL),
(347, 'CS2014-47', 'Thiết kế các trò chơi nâng cao khả năng sáng tạo cho trẻ mẫu giáo trong hoạt động vẽ bằng màu nước', '2014-09-23', '2016-09-30', 3, 0, '35000000', 2, 0, 1, NULL, 1, 5, '', 2014, 0, NULL, 1, NULL),
(348, 'CS2014-48', 'Thực trạng tính tích cực trong hoạt động thể dục thể thao của SV trường Đại học Sài Gòn', '2014-09-23', '2016-09-30', 3, 0, '35000000', 2, 0, 1, NULL, 1, 5, '', 2014, 0, NULL, 1, NULL),
(349, 'CS2014-49', 'Thực trạng nhận thức của sinh viên khoa GDMN về vấn đề Can thiệp sớm – Giáo dục hoà nhập trẻ khuyết tật trong trường mầm non', '2014-09-23', '2015-09-30', 3, 0, '35000000', 2, 0, 1, NULL, 1, 5, '', 2014, 0, NULL, 1, NULL),
(350, 'CS2014-50', 'Thực trạng giáo viên mầm non sử dụng thực phẩm trong giáo dục phát triển cho trẻ từ 24-48 tháng', '2014-09-23', '2015-09-30', 3, 0, '35000000', 2, 0, 1, NULL, 1, 5, '', 2014, 0, NULL, 1, NULL),
(351, 'CS2014-51', 'Thực trạng tính tích cực giao tiếp của trẻ mẫu giáo 4-5 tuổi trong hoạt động khám phá khoa học ở một số trường mầm non tại TP.HCM', '2014-09-23', '2015-09-30', 3, 0, '35000000', 2, 0, 1, NULL, 1, 5, '', 2014, 0, NULL, 1, NULL),
(352, 'CS2014-52', 'Biện pháp nâng cao khả năng khái quát hoá của trẻ mẫu giáo 5-6 tuổi trong hoạt động làm quen với môi trường xung quanh ở một số trường Mầm non tại TP.HCM', '2014-09-23', '2016-09-30', 3, 0, '35000000', 2, 0, 1, NULL, 1, 24, '', 2014, 0, NULL, 1, NULL),
(353, 'CS2014-53', 'Hình thành cho sinh viên ngành Giáo dục Tiểu học kĩ năng biến đổi các tình huống dạy học toán theo hướng tăng cường hoạt động tìm tòi, phát hiện kiến thức ở học sinh', '2014-09-23', '2015-09-30', 3, 0, '35000000', 2, 0, 1, NULL, 1, 4, '', 2014, 0, NULL, 1, NULL),
(354, 'CS2014-54', 'Bồi dưỡng kỹ năng dạy học tục ngữ, thành ngữ cho sinh viên ngành Giáo dục Tiểu học trường Đại học Sài Gòn', '2014-09-23', '2015-09-30', 3, 0, '35000000', 2, 0, 1, NULL, 1, 4, '', 2014, 0, NULL, 1, NULL),
(355, 'CS2014-55', 'Phương pháp bồi dưỡng kỹ năng sử dụng từ Hán - Việt cho sinh viên ngành Giáo dục Tiểu học trường Đại học Sài Gòn', '2014-09-23', '2015-09-30', 3, 0, '35000000', 2, 0, 1, NULL, 1, 13, '', 2014, 0, NULL, 1, NULL),
(356, 'CS2014-56', 'Pháp luật về hành vi cạnh tranh không lành mạnh của một số quốc gia trên thế giới và kinh nghiệm cho Việt Nam', '2014-09-23', '2015-09-30', 3, 0, '35000000', 2, 0, 4, NULL, 1, 18, '', 2014, 0, NULL, 1, NULL),
(357, 'CS2014-57', 'Pháp luật về cho thuê lại lao động và thực tiễn áp dụng', '2014-09-23', '2015-09-30', 3, 0, '35000000', 2, 0, 1, NULL, 1, 31, '', 2014, 0, NULL, 1, NULL),
(358, 'CS2014-58', 'Nghiên cứu hành vi điều chỉnh lợi nhuận ảnh hưởng đến chất lượng báo cáo tài chính của các công ty niêm yết tại Việt Nam', '2014-09-23', '2015-09-30', 3, 0, '35000000', 2, 0, 2, NULL, 1, 14, '', 2014, 0, NULL, 1, NULL),
(359, 'CS2014-59', 'Khảo sát hiện trạng áp dụng dự toán ngân sách trong các doanh nghiệp vừa và nhỏ ở TP.HCM hiện nay', '2014-09-23', '2015-09-30', 3, 0, '35000000', 2, 0, 2, NULL, 1, 14, '', 2014, 0, NULL, 1, NULL),
(360, 'CS2014-60', 'Tìm hiểu sự tác động của khủng hoảng kinh tế đến việc dạy và học tại trường ĐHSG trong giai đoạn hiện nay', '2014-09-23', '2016-09-30', 3, 0, '35000000', 2, 0, 2, NULL, 1, 11, '', 2014, 0, NULL, 1, NULL);
INSERT INTO `de_tai` (`id`, `ma`, `ten`, `thoi_gian_bat_dau`, `thoi_gian_hoan_thanh`, `tinh_trang`, `so_thang_gia_han`, `kinh_phi`, `cap_quan_ly`, `xep_loai`, `ma_linh_vuc`, `ma_hd_duyet`, `ma_loai`, `ma_don_vi`, `ghi_chu`, `nam`, `bo_mon_id`, `file_tom_tat`, `search`, `ngay_gia_han`) VALUES
(361, 'CS2014-61', 'Đo lường và đánh giá chất lượng dịch vụ đào tạo của SV khoa Quản trị kinh doanh trường ĐHSG', '2014-09-23', '2015-09-30', 3, 0, '35000000', 2, 0, 2, NULL, 1, 11, '', 2014, 0, NULL, 1, NULL),
(362, 'CS2014-62', 'Ảnh hưởng của suy thoái kinh tế toàn cầu đến tăng trưởng kinh tế TP.HCM (giai đoạn 2008-2013)', '2014-09-23', '2015-09-30', 3, 0, '35000000', 2, 0, 2, NULL, 1, 31, '', 2014, 0, NULL, 1, NULL),
(363, 'CS2014-68', 'Địa danh trong hệ thống tuyến điểm du lịch tiểu vùng Tây Nam Bộ', '2014-09-23', '2016-09-30', 3, 0, '40000000', 2, 0, 4, NULL, 1, 13, '', 2014, 0, NULL, 1, NULL),
(364, 'CS2014-69', 'Xây dựng, khai thác và phát triển bộ sưu tập số cho nguồn tài liệu xám tại TT Học liệu trường ĐHSG', '2014-09-23', '2016-09-30', 3, 0, '35000000', 2, 0, 1, NULL, 1, 12, '', 2014, 0, NULL, 1, NULL),
(365, 'CS2014-70', 'Phong trào Minh Tân ở Nam Kỳ đầu thế kỷ XX', '2014-09-23', '2016-09-30', 3, 0, '35000000', 2, 0, 4, NULL, 1, 17, '', 2014, 0, NULL, 1, NULL),
(366, 'CS2014-71', 'Nội dung cơ bản và ý nghĩa của nhận thức luận trong triết học Phật giáo', '2014-09-23', '2016-09-30', 3, 0, '35000000', 2, 0, 4, NULL, 1, 17, '', 2014, 0, NULL, 1, NULL),
(367, 'CS2014-72', 'Quá trình chuyển biến tư tưởng chính trị của Phan Bội Châu và ý nghĩa lịch sử của sự chuyển biến đó', '2014-09-23', '2015-09-30', 3, 0, '35000000', 2, 0, 1, NULL, 1, 17, '', 2014, 0, NULL, 1, NULL),
(368, 'CS2014-73', 'Giá trị tu từ của từ láy tượng thanh trong tiếng Việt (so sánh với tiếng Anh)', '2014-09-23', '2016-09-30', 3, 0, '35000000', 2, 0, 1, NULL, 1, 7, '', 2014, 0, NULL, 1, NULL),
(369, 'CS2014-74', 'Khảo sát thực trạng trình độ tiếng Anh đầu vào của SV không chuyên ĐHSG niên khoá 2014-2018', '2014-09-23', '2015-09-30', 3, 0, '35000000', 2, 0, 1, NULL, 1, 7, '', 2014, 0, NULL, 1, NULL),
(370, 'CS2014-75', 'Âm nhạc thế kỉ XX', '2014-09-23', '2015-09-30', 3, 0, '30000000', 2, 0, 1, NULL, 1, 9, '', 2014, 0, NULL, 1, NULL),
(371, 'CS2014-76', 'Nghiên cứu sự phát triển thể lực chung của nữ sinh viên trường ĐHSG niên khoá 2014-2015, sau khi kết thúc chương trình tự chọn môn bóng đá, bóng rổ, bóng chuyền cơ bản', '2014-09-23', '2015-09-30', 3, 0, '35000000', 2, 0, 1, NULL, 1, 51, '', 2014, 0, NULL, 1, NULL),
(372, 'CS2014-77', 'Nghiên cứu đánh giá thực trạng và xây dựng các giải pháp nâng cao hiệu quả công tác giáo dục thể chất trường ĐHSG', '2014-09-23', '2015-09-30', 3, 0, '35000000', 2, 0, 1, NULL, 1, 51, '', 2014, 0, NULL, 1, NULL),
(373, 'CS2014-78', 'Nghiên cứu một số bài tập bổ trợ phát triển sức nhanh trong chạy cự ly ngắn cho nữ SV năm thứ nhất trường ĐHSG', '2014-09-23', '2015-09-30', 3, 0, '32000000', 2, 0, 1, NULL, 1, 51, '', 2014, 0, NULL, 1, NULL),
(374, 'CS2014-79', 'Đánh giá sự phát triển thể lực của học sinh Trung học phổ thông Trường trung học Thực hành Sài Gòn qua chỉ số VO2MAX gián tiếp và cường độ vận động', '2014-09-23', '2016-09-30', 3, 0, '35000000', 2, 0, 1, NULL, 1, 30, '', 2014, 0, NULL, 1, NULL),
(375, 'CS2014-80', 'Nghiên cứu VO2MAX gián tiếp và cường độ vận động của sinh viên năm thứ nhất (2013-2014) trường Đại học Sài Gòn', '2014-09-23', '2015-09-30', 3, 0, '35000000', 2, 0, 1, NULL, 1, 30, '', 2014, 0, NULL, 1, NULL),
(376, 'GT2014-01', 'Giáo trình Vật lý chất rắn', '2014-09-23', '2015-09-30', 3, 0, '36000000', 2, 0, 5, NULL, 1, 20, '', 2014, 0, NULL, 1, NULL),
(377, 'GT2014-02', 'Giáo trình Văn học Việt Nam hiện đại 2', '2014-09-23', '2015-09-30', 3, 0, '36000000', 2, 0, 5, NULL, 1, 3, '', 2014, 0, NULL, 1, NULL),
(378, 'GT2014-03', 'Giáo trình Cơ sở Lập trình', '2014-09-23', '2015-09-30', 3, 0, '36000000', 2, 0, 5, NULL, 1, 10, '', 2014, 0, NULL, 1, NULL),
(379, 'GT2014-04', 'Giáo trình Xác suất và Thống kê', '2014-09-23', '2016-09-30', 3, 0, '48000000', 2, 0, 5, NULL, 1, 26, '', 2014, 0, NULL, 1, NULL),
(380, 'GT2014-05', 'Giáo trình Giải tích lồi và Tối ưu', '2014-09-23', '2015-09-30', 3, 0, '36000000', 2, 0, 5, NULL, 1, 25, '', 2014, 0, NULL, 1, NULL),
(381, 'GT2014-06', 'Giáo trình Kỹ thuật Thông tin quang', '2014-09-23', '2015-09-30', 3, 0, '24000000', 2, 0, 5, NULL, 1, 19, '', 2014, 0, NULL, 1, NULL),
(382, 'GT2014-07', 'Giáo trình Kỹ thuật Vi xử lý', '2014-09-23', '2015-09-30', 3, 0, '48000000', 2, 0, 5, NULL, 1, 19, '', 2014, 0, NULL, 1, NULL),
(383, 'GT2014-08', 'Giáo trình An toàn lao động', '2014-09-23', '2015-09-30', 3, 0, '24000000', 2, 0, 5, NULL, 1, 19, '', 2014, 0, NULL, 1, NULL),
(384, 'GT2014-09', 'Giáo trình truyền sóng và Anten', '2014-09-23', '2015-09-30', 3, 0, '24000000', 2, 0, 5, NULL, 1, 19, '', 2014, 0, NULL, 1, NULL),
(385, 'GT2014-10', 'Giáo trình công tác Đảng và Đoàn thể trong nhà trường', '2014-09-23', '2015-09-30', 3, 0, '24000000', 2, 0, 5, NULL, 1, 25, '', 2014, 0, NULL, 1, NULL),
(386, 'GT2014-11', 'Giáo trình Tài chính Doanh nghiệp 1', '2014-09-23', '2015-09-30', 3, 0, '36000000', 2, 0, 5, NULL, 1, 14, '', 2014, 0, NULL, 1, NULL),
(387, 'GT2014-12', 'Giáo trình Kế toán chi phí', '2014-09-23', '2015-09-30', 3, 0, '48000000', 2, 0, 5, NULL, 1, 14, '', 2014, 0, NULL, 1, NULL),
(388, 'GT2014-13', 'Giáo trình Kế toán tài chính 2', '2014-09-23', '2015-09-30', 3, 0, '48000000', 2, 0, 5, NULL, 1, 14, '', 2014, 0, NULL, 1, NULL),
(389, 'GT2014-14', 'Giáo trình Phân tích Báo cáo Tài chính Doanh nghiệp', '2014-09-23', '2015-09-30', 3, 0, '36000000', 2, 0, 5, NULL, 1, 14, '', 2014, 0, NULL, 1, NULL),
(390, 'GT2014-15', 'Giáo trình Nghiệp vụ Thư kí Văn phòng', '2014-09-23', '2015-09-30', 3, 0, '24000000', 2, 0, 5, NULL, 1, 12, '', 2014, 0, NULL, 1, NULL),
(391, 'CS2013-01', 'Áp dụng chu trình Kolb trong dạy học môn Thiên văn học đại cương tại Trường Đại học Sài Gòn', '2013-01-01', '2014-01-31', 4, 0, '25000000', 2, 4, 6, NULL, 1, 20, '', 2013, 0, NULL, 1, NULL),
(392, 'CS2013-02', 'Nghiên cứu sử dụng hydropeoxit cắt mạch chitosan trong dung dịch ở nhiệt độ phòng để chế tạo oligochitosan', '2013-01-01', '2014-01-31', 4, 0, '30000000', 2, 4, 6, NULL, 1, 20, '', 2013, 0, NULL, 1, NULL),
(393, 'CS2013-03', 'Nghiên cứu hiệu ứng đồng vận H2O2/ bức xạ gamma Coban-60 để chế tạo chitosan khối lượng phân tử thấp', '2013-01-01', '2014-01-31', 4, 0, '30000000', 2, 4, 6, NULL, 1, 20, '', 2013, 0, NULL, 1, NULL),
(394, 'CS2013-04', 'Điều chế và thử hoạt tính quang xúc tác TiO2 pha tạp gadolini', '2013-01-01', '2014-01-31', 4, 0, '30000000', 2, 4, 6, NULL, 1, 20, '', 2013, 0, NULL, 1, NULL),
(395, 'CS2013-05', 'Nghiên cứu thành phần loài và giới hạn phân bổ theo nồng độ muối của lưỡng cư ở khu dự trữ sinh quyển Cần Giờ - TP.HCM', '2013-01-01', '2014-01-31', 3, 6, '30000000', 2, 0, 6, NULL, 1, 20, '', 2013, 0, NULL, 1, '2014-10-31'),
(396, 'CS2013-06', 'Tìm hiểu sự biến đổi của trình tự protein SHV trong quá trình kháng thuốc ở vi khuẩn', '2013-01-01', '2014-01-31', 3, 6, '30000000', 2, 0, 6, NULL, 1, 20, '', 2013, 0, NULL, 1, '2014-10-31'),
(397, 'CS2013-07', 'Phân lập và tuyển chọn vi khuẩn cố định đạm, hoà tan lân trong đất vùng rễ cây ngô (Zea mays) trồng trên đất xám tỉnh Tây Ninh', '2013-01-01', '2014-01-31', 3, 0, '29000000', 2, 0, 6, NULL, 1, 20, '', 2013, 0, NULL, 1, NULL),
(398, 'CS2013-08', 'Cải tiến quy trình làm tiêu bản di truyền học ở bậc phổ thông trung học', '2013-01-01', '2014-01-31', 3, 6, '29000000', 2, 0, 6, NULL, 1, 20, '', 2013, 0, NULL, 1, '2014-12-31'),
(399, 'CS2013-09', 'Xây dựng bộ tư liệu trực quan phục vụ giảng dạy môn thực hành giải phẫu sinh lí người và động vật', '2013-01-01', '2014-01-31', 6, 0, '30', 2, 0, 6, NULL, 1, 20, '', 2013, 0, NULL, 1, NULL),
(400, 'CS2013-10', 'Bài toán giá trị đầu cho phương trình vi phân đạo hàm riêng cấp hai tự tham chiếu', '2013-01-01', '2014-01-31', 4, 0, '20000000', 2, 3, 1, NULL, 1, 2, '', 2013, 0, NULL, 1, NULL),
(401, 'CS2013-11', 'Phân lớp các phạm trù Picard phân bậc và ứng dụng', '2013-01-01', '2014-01-31', 4, 0, '20000000', 2, 4, 1, NULL, 1, 2, '', 2013, 0, NULL, 1, NULL),
(402, 'CS2013-12', 'Phân tích ứng dụng số liệu mảng', '2013-01-01', '2014-01-31', 3, 0, '20000000', 2, 0, 1, NULL, 1, 2, '', 2013, 0, NULL, 1, '2014-04-30'),
(403, 'CS2013-13', 'Điều kiện cần, đủ đạt cực trị và đối ngẫu trong bài toán tối ưu véctơ', '2013-01-01', '2014-01-31', 4, 0, '20000000', 2, 4, 1, NULL, 1, 2, '', 2013, 0, NULL, 1, NULL),
(404, 'CS2013-14', 'Bài toán nhiệt ngược với nguồn nhiệt phi tuyến', '2013-01-01', '2014-01-31', 4, 0, '20000000', 2, 4, 1, NULL, 1, 2, '', 2013, 0, NULL, 1, NULL),
(405, 'CS2013-15', 'Tốc độ hội tụ và luật số lớn đối với mảng các biến ngẫu nhiên', '2013-01-01', '2014-01-31', 4, 0, '20000000', 2, 4, 1, NULL, 1, 2, '', 2013, 0, NULL, 1, NULL),
(406, 'CS2013-16', 'Phân tích mối quan hệ giữa tỷ giá tiền tệ và tăng trưởng kinh tế', '2013-01-01', '2014-01-31', 4, 0, '20000000', 2, 3, 1, NULL, 1, 2, '', 2013, 0, NULL, 1, NULL),
(407, 'CS2013-17', 'Quan niệm văn chương của Nguyễn Trãi', '2013-01-01', '2014-01-31', 4, 0, '25000000', 2, 3, 4, NULL, 1, 3, '', 2013, 0, NULL, 1, NULL),
(408, 'CS2013-18', 'Nghiên cứu quy mô và cơ cấu lao động tại TP.HCM giai đoạn 1990 - 2012', '2013-01-01', '2014-01-31', 4, 0, '25000000', 2, 4, 4, NULL, 1, 3, '', 2013, 0, NULL, 1, NULL),
(409, 'CS2013-19', 'Quá trình "Leo thang chiến tranh" của Mỹ tại Việt Nam (1954-1969)', '2013-01-01', '2014-01-31', 4, 0, '24900000', 2, 4, 4, NULL, 1, 3, '', 2013, 0, NULL, 1, NULL),
(410, 'CS2013-20', 'Thực trạng khó khăn trong cuộc sống của sinh viên năm thứ nhất khoa GDMN - Trường ĐHSG', '2013-01-01', '2014-01-31', 4, 0, '25000000', 2, 2, 1, NULL, 1, 4, '', 2013, 0, NULL, 1, NULL),
(411, 'CS2013-21', 'Phát triển năng lực cảm thụ thơ ca cho học sinh Tiểu học từ phương diện ngôn ngữ', '2013-01-01', '2014-01-31', 4, 0, '24900000', 2, 3, 1, NULL, 1, 13, '', 2013, 0, NULL, 1, NULL),
(412, 'CS2013-22', 'Thực trạng khó khăn trong cuộc sống của sinh viên năm thứ nhất khoa GDMN - Trường ĐHSG', '2013-01-01', '2014-01-31', 3, 0, '25000000', 2, 0, 1, NULL, 1, 5, '', 2013, 0, NULL, 1, NULL),
(413, 'CS2013-23', 'Thực trạng kỹ năng xử lí tình huống sư phạm của giáo viên mầm non trong hoạt động giáo dục trẻ Mẫu giáo 5-6 tuổi', '2013-01-01', '2014-01-31', 4, 0, '25000000', 2, 2, 1, NULL, 1, 5, '', 2013, 0, NULL, 1, NULL),
(414, 'CS2013-24', 'Thực trạng kỹ năng giao tiếp sư phạm của giáo viên mầm non với trẻ MG 3-6 tuổi trong hoạt động giáo dục ở 1 số trường mầm non tại TP. HCM', '2013-01-01', '2014-01-31', 4, 0, '25000000', 2, 4, 1, NULL, 1, 5, '', 2013, 0, NULL, 1, NULL),
(415, 'CS2013-25', 'Biên soạn hệ thống trò chơi nhằm phát triển kỹ năng âm nhạc  cơ bản cho trẻ mẫu giáo 5-6 tuổi', '2013-01-01', '2015-01-31', 6, 0, '25000000', 2, 0, 1, NULL, 1, 5, '', 2013, 0, NULL, 1, NULL),
(416, 'CS2013-26', 'Thực trạng hứng thú học môn Phương pháp cho trẻ làm quen tác phẩm văn học của sinh viên khoa Giáo dục Mầm non - Trường Đại học Sài Gòn', '2013-01-01', '2014-01-31', 4, 0, '25000000', 2, 2, 1, NULL, 1, 5, '', 2013, 0, NULL, 1, NULL),
(417, 'CS2013-27', 'Thực trạng sử dụng biện pháp phát triển kĩ năng quan sát cho trẻ 5-6 tuổi trong hoạt động khám phá thiên nhiên ở trường mầm non', '2013-01-01', '2014-01-31', 4, 0, '25000000', 2, 2, 1, NULL, 1, 5, '', 2013, 0, NULL, 1, NULL),
(418, 'CS2013-28', 'Nghiên cứu phân vùng chất lượng nước sông Vàm Cỏ Đông', '2013-01-01', '2014-01-31', 3, 0, '30000000', 2, 0, 9, NULL, 1, 15, '', 2013, 0, NULL, 1, NULL),
(419, 'CS2013-29', 'Bước đầu nghiên cứu ảnh hưởng của ngập úng do mưa và triều cường đến hộ dân nghèo tại Quận 8, TP.HCM', '2013-01-01', '2014-01-31', 4, 0, '30000000', 2, 3, 9, NULL, 1, 15, '', 2013, 0, NULL, 1, NULL),
(420, 'CS2013-30', 'Thiết kế mô hình xử lý nước thải y tế quy mô nhỏ cho các phòng khám tư nhân', '2013-01-01', '2014-01-31', 4, 0, '30000000', 2, 2, 9, NULL, 1, 15, '', 2013, 0, NULL, 1, NULL),
(421, 'CS2013-31', 'Nghiên cứu khả năng xử lý độ màu nước thải dệt nhuộm bằng TiO2', '2013-01-01', '2014-01-31', 4, 0, '30000000', 2, 3, 9, NULL, 1, 15, '', 2013, 0, NULL, 1, NULL),
(422, 'CS2013-32', 'Nghiên cứu khả năng xử lý hơi fomaldehyde bằng TiO2/UV', '2013-01-01', '2014-01-31', 4, 0, '30000000', 2, 3, 9, NULL, 1, 15, '', 2013, 0, NULL, 1, NULL),
(423, 'CS2013-33', 'Khảo sát thành phần hoá học rễ cây An điền sát Hedyotis pressa Piere et Pit., họ cà phê Rubiaceae', '2013-01-01', '2014-01-31', 4, 0, '30000000', 2, 4, 9, NULL, 1, 15, '', 2013, 0, NULL, 1, NULL),
(424, 'CS2013-34', 'Nghiên cứu xử lý rơm rạ trên đồng ruộng bằng một số chế phẩm sinh học', '2013-01-01', '2014-01-31', 4, 0, '29975000', 2, 2, 9, NULL, 1, 15, '', 2013, 0, NULL, 1, NULL),
(425, 'CS2013-35', 'Nghiên cứu nhân nuôi và sử dụng vi khuẩn quang hợp Phototrophic Bacteria để xử lý chất hữu cơ và H2S trong nước nuôi thuỷ sản', '2013-01-01', '2015-01-31', 3, 0, '30000000', 2, 0, 9, NULL, 1, 15, '', 2013, 0, NULL, 1, NULL),
(426, 'CS2013-36', 'Nghiên cứu loại một số màu nhuộm trong nước thải ngành nhuộm bằng gum trích ly từ hạt cây Muồng Hoàng Yến', '2013-01-01', '2015-01-31', 3, 0, '30000000', 2, 0, 9, NULL, 1, 15, '', 2013, 0, NULL, 1, NULL),
(427, 'CS2013-37', 'Xác định hàm lượng Cadimi, Chì, Asen trong sò huyết ở một số xã thuộc huyện Cần Giờ, thành phố Hồ Chí Minh bằng phương pháp ICP-MS', '2013-01-01', '2015-01-31', 3, 0, '30000000', 2, 0, 9, NULL, 1, 15, '', 2013, 0, NULL, 1, NULL),
(428, 'CS2013-38', 'Tạo xung ánh sáng trắng femto giây bằng sợi quang tinh thể', '2013-01-01', '2014-01-31', 4, 0, '30', 2, 3, 9, NULL, 1, 15, '', 2013, 0, NULL, 1, NULL),
(429, 'CS2013-39', 'Tư tưởng Nguyễn An Ninh về tôn giáo, văn hoá, khoa học đầu thế kỷ XX ở Việt Nam', '2013-01-01', '2014-01-31', 4, 0, '25000000', 2, 4, 9, NULL, 1, 2, '', 2013, 0, NULL, 1, NULL),
(430, 'CS2013-40', 'Mở rộng CSDL quan hệ để biểu diễn và truy vấn thông tin không chắc chắn', '2013-01-01', '2014-01-31', 4, 0, '27000000', 2, 4, 7, NULL, 1, 10, '', 2013, 0, NULL, 1, NULL),
(431, 'CS2013-41', 'Tìm hiểu CDIO và thí điểm triển khai xây dựng chuẩn đầu ra cho Khoa CNTT theo cách tiếp cận CDIO', '2013-01-01', '2014-01-31', 4, 0, '20000000', 2, 2, 7, NULL, 1, 10, '', 2013, 0, NULL, 1, NULL),
(432, 'CS2013-42', 'Giải quyết bài toán định tuyến kĩ thuật lưu lượng trong mạng tốc độ cao', '2013-01-01', '2014-01-31', 4, 0, '25000000', 2, 4, 7, NULL, 1, 10, '', 2013, 0, NULL, 1, NULL),
(433, 'CS2013-43', 'Phần mềm hỗ trợ dạy học phần Ma trận và Định thức trong môn Toán Đại số Tuyến tính', '2013-01-01', '2014-01-31', 3, 12, '30', 2, 0, 1, NULL, 1, 11, '', 2013, 0, NULL, 1, '2014-02-26'),
(434, 'CS2013-44', 'Các nhân tố tác động đến lòng trung thành của khách hàng đối với nhóm sản phẩm mang nhãn hàng riêng của  siêu thị Coop Mart tại TP.HCM', '2013-01-01', '2014-01-31', 3, 12, '25000000', 2, 0, 2, NULL, 1, 11, '', 2013, 0, NULL, 1, NULL),
(435, 'CS2013-45', 'Giáo dục, phổ biến pháp luật trong sinh viên - học sinh Trường Đại học Sài Gòn', '2013-01-01', '2014-01-31', 3, 0, '25000000', 2, 0, 8, NULL, 1, 18, '', 2013, 0, NULL, 1, '2014-09-30'),
(436, 'CS2013-46', 'Xây dựng và sử dụng tình huống trong giảng dạy môn học Luật Tố tụng dân sự', '2013-01-01', '2014-01-31', 4, 0, '25000000', 2, 5, 8, NULL, 1, 18, '', 2013, 0, NULL, 1, NULL),
(437, 'CS2013-47', 'Chính sách tiền tệ ảnh hưởng đến thị trường vàng tại Việt Nam', '2013-01-01', '2014-01-31', 4, 0, '20000000', 2, 2, 2, NULL, 1, 14, '', 2013, 0, NULL, 1, NULL),
(438, 'CS2013-48', 'Thiết kế website khoa Điện tử viễn thông', '2013-01-01', '2014-01-31', 4, 0, '20000000', 2, 2, 7, NULL, 1, 19, '', 2013, 0, NULL, 1, NULL),
(439, 'CS2013-49', 'Nghiên cứu phần mềm thiết kế của hãng Synopsys và Cadance phục vụ thiết kế, mô phỏng vi mạch số', '2013-01-01', '2014-01-31', 3, 6, '24300000', 2, 0, 7, NULL, 1, 19, '', 2013, 0, NULL, 1, NULL),
(440, 'CS2013-50', 'Nghiên cứu đề xuất giải pháp góp phần nâng cao chất lượng đào tạo nhằm đạt chuẩn đầu ra cho các ngành đào tạo của khoa Điện tử viễn thông', '2013-01-01', '2014-01-31', 3, 0, '12000000', 2, 0, 7, NULL, 1, 19, '', 2013, 0, NULL, 1, NULL),
(441, 'CS2013-51', 'Cải biến câu trong tiếng Anh', '2013-01-01', '2014-01-31', 4, 0, '25000000', 2, 3, 1, NULL, 1, 7, '', 2013, 0, NULL, 1, NULL),
(442, 'CS2013-52', 'Thiết kế nội dung đào tạo môn lí thuyết âm nhạc cơ bản cho Đại học giáo dục Tiểu học', '2013-01-01', '2014-01-31', 4, 0, '25000000', 2, 2, 1, NULL, 1, 9, '', 2013, 0, NULL, 1, NULL),
(443, 'CS2013-53', 'Âm nhạc thế kỉ XIX', '2013-01-01', '2014-01-31', 4, 0, '25000000', 2, 2, 1, NULL, 1, 9, '', 2013, 0, NULL, 1, NULL),
(444, 'CS2013-54', 'Bảo vệ quyền con người trong lĩnh vực hôn nhân và gia đình theo luật Hôn nhân và gia đình hiện hành', '2013-01-01', '2014-01-31', 4, 0, '22200000', 2, 1, 8, NULL, 1, 18, '', 2013, 0, NULL, 1, NULL),
(445, 'CS2013-55', 'Thực trạng nhu cầu tham vấn tâm lí của sinh viên năm 1, ngành Sư phạm, trường ĐHSG, giai đoạn 2013-2015.', '2013-01-01', '2015-01-31', 3, 0, '24350000', 2, 0, 1, NULL, 1, 16, '', 2013, 0, NULL, 1, NULL),
(446, 'CS2013-56', 'Khảo sát thực trạng nhu cầu, động cơ và khó khăn của sinh viên khi tham gia các hoạt động thể thao ngoại khóa tại Trường Đại học Sài Gòn', '2013-01-01', '2014-01-31', 4, 0, '25000000', 2, 2, 1, NULL, 1, 51, '', 2013, 0, NULL, 1, NULL),
(447, 'CS2013-57', 'Nghiên cứu lựa chọn, sử dụng một số bài tập thể dục (với gậy, với bóng) và trò chơi vận động như một học phần tự chọn  để phát triển thể lực cho sinh viên nữ Trường Đại học Sài Gòn', '2013-01-01', '2014-01-31', 4, 0, '24880000', 2, 2, 1, NULL, 1, 51, '', 2013, 0, NULL, 1, NULL),
(448, 'CS2013-58', 'Nghiên cứu  xây dựng tiêu chuẩn thể lực cho sinh viên Trường Đại học Sài Gòn 2012-2013', '2013-01-01', '2014-01-31', 3, 12, '25000000', 2, 0, 1, NULL, 1, 51, '', 2013, 0, NULL, 1, '2014-06-01'),
(449, 'CS2013-59', 'Đánh giá hiệu quả của việc ứng dụng chương trình giảng dạy môn bóng đá Futsal trong học phần tự chọn nhằm phát triển thể lực cho nữ sinh viên Trường Đại học Sài Gòn', '2013-01-01', '2014-01-31', 4, 0, '24000000', 2, 2, 1, NULL, 1, 51, '', 2013, 0, NULL, 1, NULL),
(450, 'CS2013-60', 'Khảo sát sự hình thành và phát triển của mô sẹo từ cát cắt mỏng mô dâu tằm trắng (Morus alba L.) trên môi trường MS rắn và lỏng', '2013-01-01', '2014-01-31', 3, 12, '30000000', 2, 0, 6, NULL, 1, 50, '', 2013, 0, NULL, 1, NULL),
(451, 'CS2013-61', 'Xây dựng mô hình phát triển Tạp chí Đại học Sài Gòn (giai đoạn từ 2013-2015)', '2013-01-01', '2014-01-31', 4, 0, '25000000', 2, 4, 1, NULL, 1, 61, '', 2013, 0, NULL, 1, NULL),
(452, 'CS2013-62', 'Điều chỉnh chương trình đào tạo theo nhu cầu thị trường lao động', '2013-01-01', '2014-01-31', 4, 0, '25000000', 2, 3, 1, NULL, 1, 21, '', 2013, 0, NULL, 1, NULL),
(453, 'CS2013-63', 'Tăng cường hiệu quả Hệ thống Thông tin Trường Đại học Sài Gòn', '2013-01-01', '2014-01-31', 3, 0, '25000000', 2, 0, 1, NULL, 1, 25, '', 2013, 0, NULL, 1, NULL),
(454, 'CS2013-64', 'Nâng cao hiệu quả hoạt động thanh tra các kì thi của trường Đại học Sài Gòn', '2013-01-01', '2014-01-31', 3, 12, '22500000', 2, 0, 1, NULL, 1, 44, '', 2013, 0, NULL, 1, NULL),
(455, 'GT2013-01', 'Giảo trình Đại số đại cương (Phần 2)', '2013-01-01', '2014-01-31', 3, 0, '20', 2, 0, 5, NULL, 1, 2, '', 2013, 0, NULL, 1, NULL),
(456, 'GT2013-02', 'Giáo trình Lý thuyết số', '2013-01-01', '2014-01-31', 3, 0, '30000000', 2, 0, 5, NULL, 1, 2, '', 2013, 0, NULL, 1, NULL),
(457, 'GT2013-03', 'Giào trình Giải tích hàm nhiều biến', '2013-01-01', '2014-01-31', 3, 0, '50000000', 2, 0, 5, NULL, 1, 2, '', 2013, 0, NULL, 1, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `diem_chuyen_nganh`
--

CREATE TABLE IF NOT EXISTS `diem_chuyen_nganh` (
  `hoc_vien_id` int(11) NOT NULL,
  `mon_chuyen_nganh_id` int(11) NOT NULL,
  `diem` decimal(10,2) NOT NULL DEFAULT '0.00',
  PRIMARY KEY (`hoc_vien_id`,`mon_chuyen_nganh_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `don_vi`
--

CREATE TABLE IF NOT EXISTS `don_vi` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `ma` varchar(10) COLLATE utf8_unicode_ci DEFAULT NULL,
  `ten` varchar(250) COLLATE utf8_unicode_ci NOT NULL,
  `thuoc_sgu` tinyint(4) NOT NULL DEFAULT '1',
  `la_khoa` tinyint(4) NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`),
  UNIQUE KEY `ma` (`ma`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=63 ;

--
-- Dumping data for table `don_vi`
--

INSERT INTO `don_vi` (`id`, `ma`, `ten`, `thuoc_sgu`, `la_khoa`) VALUES
(1, 'SGU', 'Trường Đại Học Sài Gòn', 1, 0),
(2, 'TD', 'Khoa Toán - Ứng dụng', 1, 1),
(3, 'XH', 'Khoa Sư Phạm Khoa học Xã hội', 1, 1),
(4, 'GT', 'Khoa Giáo dục Tiểu học', 1, 1),
(5, 'GM', 'Khoa Giáo dục Mầm Non', 1, 1),
(6, 'KT', 'Khoa Sư Phạm Kỹ Thuật', 1, 1),
(7, 'NN', 'Khoa Ngoại Ngữ', 1, 1),
(8, 'MI', 'Khoa Mỹ Thuật', 1, 1),
(9, 'NT', 'Khoa Nghệ Thuật', 1, 1),
(10, 'CT', 'Khoa Công nghệ thông tin', 1, 1),
(11, 'QD', 'Khoa Quản trị Kinh doanh', 1, 1),
(12, 'TT', 'Khoa Thư viện Văn phòng', 1, 1),
(13, 'VD', 'Khoa Văn hóa Du lịch', 1, 1),
(14, 'TE', 'Khoa Tài chính - Kế toán', 1, 1),
(15, 'MO', 'Khoa Khoa học Môi Trường', 1, 1),
(16, 'QG', 'Khoa Giáo dục', 1, 1),
(17, 'LC', 'Khoa Giáo dục chính trị', 1, 1),
(18, 'LU', 'Khoa Luật', 1, 1),
(19, 'DV', 'Khoa Điện tử Viễn thông', 1, 1),
(20, 'TN', 'Khoa Sư Phạm Khoa học Tự nhiên', 1, 1),
(21, '15', 'Phòng Khảo thí và bảo đảm chất lượng giáo dục', 1, 0),
(22, '09', 'Phòng đào tạo tại chức và tu nghiệp giáo viên', 1, 0),
(23, '05', 'Phòng Kế hoạch Tài chính', 1, 0),
(24, '02', 'Văn phòng', 1, 0),
(25, '07', 'Phòng Quản lí Khoa học và Sau Đại học', 1, 0),
(26, '01', 'Ban giám hiệu', 1, 0),
(27, '03', 'Phòng Đào tạo', 1, 0),
(28, '04', 'Phòng Tổ chức cán bộ', 1, 0),
(29, '11', 'Trung tâm quản lý và khai thác mạng TT', 1, 0),
(30, '12', 'Trung tâm học liệu', 1, 0),
(31, '16', 'Phòng Quan hệ doanh nghiệp', 1, 0),
(32, '17', 'Trung tâm tin học', 1, 0),
(33, 'DVNT', 'Đơn vị ngoài trường', 0, 0),
(34, 'SPS', 'Trường ĐH Sư phạm TP.HCM', 0, 0),
(35, 'BTTEPC', 'Viện Kĩ thuật Nhiệt đới và Bảo vệ Mội trường TP.HCM', 0, 0),
(36, 'IESEM', 'Viện Khoa học và Quản lí Môi trường TP.HCM', 0, 0),
(37, 'UIT', 'Trường ĐH Công nghệ thông tin TP. HCM', 0, 0),
(38, 'TDMU', 'Trường ĐH Thủ Dầu Một – Bình Dương', 0, 0),
(39, 'LPS', 'Trường Đại học Luật TP.HCM', 0, 0),
(40, 'QST', 'Trường ĐH Khoa học Tự nhiên', 0, 0),
(41, 'HUFLIT', 'Trường ĐH Ngoại ngữ - Tin học TP. HCM (Hufflit)', 0, 0),
(42, 'HUI', 'Trường ĐH Công nghiệp TP.HCM', 0, 0),
(43, '06', 'Phòng Thiết bị và Phương tiện dạy học', 1, 0),
(44, '08', 'Phòng Thanh Tra', 1, 0),
(46, '13', 'Trạm Y tế', 1, 0),
(50, '20', 'Phòng Công tác Học sinh - Sinh viên', 1, 0),
(51, 'TC - AN', 'BM Giáo dục Quốc phòng - An ninh và Giáo dục Thể chất', 1, 1),
(52, 'TG', 'BM Tâm lý - Giáo dục', 1, 1),
(53, 'QP', 'Giáo dục Quốc phòng - An ninh', 1, 1),
(54, NULL, 'Trường ĐH Thể Dục Thể Thao TP.HCM', 0, 0),
(55, NULL, 'Trường ĐH Lao động Xã hội', 0, 0),
(57, NULL, 'Tạp chí Đại học Sài Gòn', 1, 0),
(58, NULL, 'Trung tâm Dịch vụ lữ hành', 1, 0),
(59, NULL, 'Công đoàn', 1, 0),
(60, NULL, 'Trung học Thực hành Sài Gòn', 1, 0),
(61, NULL, 'Trung tâm Thông tin Truyền thông và Phát triển Giáo dục Trường Đại học Sài Gòn', 1, 0),
(62, NULL, 'Ban Cơ sở hạ tầng và Xây dựng cơ bản', 1, 0);

-- --------------------------------------------------------

--
-- Table structure for table `giang_vien`
--

CREATE TABLE IF NOT EXISTS `giang_vien` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
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
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=551 ;

--
-- Dumping data for table `giang_vien`
--

INSERT INTO `giang_vien` (`id`, `ma`, `ho`, `ten`, `email`, `so_dien_thoai`, `chuc_vu`, `trang_thai`, `ma_don_vi`, `ma_hoc_vi`) VALUES
(2, '10135', 'Trần Thanh', 'Bình', NULL, NULL, NULL, 1, 2, 2),
(3, '20179', 'Đặng Đức ', 'Trọng', NULL, NULL, NULL, 1, 20, 4),
(4, '10134', 'Nguyễn Lương Thái', 'Bình', NULL, NULL, NULL, 1, 2, 2),
(5, '10167', 'Đồng Thanh', 'Triết', NULL, NULL, 'Phó Trưởng khoa Toán - Ứng dụng', 1, 2, 2),
(6, '10129', 'Hoàng Văn ', 'Xuyến', NULL, NULL, 'Trưởng Bộ môn Lý Khoa KHTN', 1, 20, 2),
(7, '10176', 'Hồ Văn', 'Hải', NULL, NULL, 'Trưởng khoa Giáo Dục - Tiểu Học', 1, 4, 3),
(8, '10186', 'Trần Thị ', 'Thục', NULL, NULL, NULL, 1, 3, 2),
(9, '10172', 'Trần Thị ', 'Tuyết', NULL, NULL, 'Phó Trưởng Khoa SP.KHXH', 1, 3, 1),
(10, '10174', 'Nguyễn Đức', 'Hòa', NULL, NULL, 'Phó trưởng khoa  SP KHXH', 1, 3, 3),
(11, '10004', 'Hoàng Văn', 'Năng', NULL, NULL, 'Phó Hiệu trưởng', 1, 26, 2),
(12, '20397', 'Đỗ Thị ', 'Hạnh', NULL, NULL, 'Phó Trưởng Khoa SP.KHXH', 1, 3, 2),
(13, '10700', 'Lê Tùng', 'Lâm', NULL, NULL, NULL, 1, 3, 2),
(14, '10193', 'Lý Thị Minh', 'Ngọc', '', '', '', 1, 3, 2),
(15, '10599', 'Đỗ Cao', 'Phúc', NULL, NULL, NULL, 1, 3, 1),
(16, '10411', 'Phạm Thị Thu', 'Nga', NULL, NULL, 'Trưởng Khoa Văn hoá - Du lịch', 1, 13, 3),
(17, '10414', 'Nguyễn Thị Hồng', 'Trang', NULL, NULL, NULL, 1, 13, 2),
(18, '10441', 'Nguyễn Việt', 'Hùng', NULL, NULL, NULL, 1, 13, 2),
(19, '10413', 'Nguyễn Mạnh ', 'Tiến', NULL, NULL, NULL, 1, 13, 2),
(20, '10737', 'Trần Anh', 'Dũng', NULL, NULL, NULL, 1, 13, 2),
(21, '10412', 'Võ Thế ', 'Khang', '', '', '', 1, 13, 2),
(22, '10415', 'Nguyễn Hữu', 'Sơn', '', '', '', 1, 13, 2),
(23, '10725', 'Nguyễn Thị Thanh', 'Tâm', NULL, NULL, NULL, 1, 13, 1),
(24, '10394', 'Nguyễn Văn', 'Bằng', NULL, NULL, 'Trưởng khoa Thư viện -Thông tin', 1, 12, 3),
(25, '10001', 'Nguyễn Viết', 'Ngoạn', '', '', 'Hiệu trưởng', 1, 26, 4),
(27, '10006', 'Lê Văn', 'Việt', NULL, NULL, 'Trưởng phòng Tổ chức – Cán bộ', 1, 26, 2),
(28, '10416', 'Nguyễn Khắc', 'Hùng', '', '', 'Phó Hiệu trưởng', 1, 26, 4),
(29, '10027', 'Huỳnh Quang', 'Phước', '', '', '', 1, 62, 2),
(30, '10070', 'Lê Anh', 'Duy', NULL, NULL, NULL, 1, 31, 3),
(31, '20363', 'Trần Minh', 'Đức', '', '', '', 1, 31, 2),
(32, '10554', 'Trần Thị Hồng', 'Trinh', '', '', '', 1, 31, 2),
(33, '10555', 'Trần Thị Mỹ', 'Linh', '', '', '', 1, 31, 1),
(34, '10674', 'Nguyễn Thành', 'Phương', '', '', '', 1, 31, 1),
(35, '10734', 'Phan Thị', 'Liên', '', '', '', 1, 31, 2),
(36, '10132', 'Nguyễn Thanh', 'Dũng', NULL, NULL, NULL, 1, 20, 2),
(37, '10128', 'Đặng Thị Kim', 'Dung', NULL, NULL, NULL, 1, 20, 2),
(38, '10042', 'Nguyễn Nhựt', 'Đông', NULL, NULL, NULL, 1, 10, 2),
(39, '10229', 'Đặng Đức', 'Văn', '', '', '', 1, 10, 2),
(40, '10187', 'Nguyễn Lê', 'Tuấn', NULL, NULL, NULL, 1, 3, 2),
(41, '10403', 'Trần Quang', 'Nam', NULL, NULL, 'Trưởng khoa QTKD', 1, 11, 3),
(42, '10742', 'Lê Nguyễn Bình ', 'Minh', NULL, NULL, NULL, 1, 11, 2),
(43, '10710', 'Võ Thụy Thanh', 'Thảo', NULL, NULL, NULL, 1, 11, 2),
(44, '10617', 'Từ Minh', 'Khai', NULL, NULL, NULL, 1, 11, 2),
(45, '10637', 'Hoàng Thị Phương', 'Thúy', NULL, NULL, NULL, 1, 11, 2),
(46, '10530', 'Võ Quang', 'Mai', NULL, NULL, 'P.Trưởng khoa SP.KHTN', 1, 20, 4),
(47, NULL, 'Lê Xuân', 'Thành', NULL, NULL, NULL, 1, 20, 4),
(48, NULL, 'Nguyễn Trọng', 'Dần', NULL, NULL, NULL, 1, 20, 2),
(49, '20523', 'Thái Kế', 'Quân', NULL, NULL, NULL, 1, 20, 2),
(50, '10127', 'Hoàng Minh', 'Tâm', '', '', 'Quyền Trưởng phòng', 1, 50, 2),
(51, '10165', 'Tạ Đình', 'Thọ', NULL, NULL, NULL, 1, 20, 1),
(52, '10400', 'Mỵ Trần Hương', 'Trà', NULL, NULL, NULL, 1, 15, 2),
(53, '10610', 'Nguyễn Xuân ', 'Dũ', NULL, NULL, NULL, 1, 15, 2),
(54, '10397', 'Phạm Nguyễn Kim', 'Tuyến', NULL, NULL, 'Trưởng Khoa Môi trường', 1, 15, 3),
(55, '20341', 'Lê Phúc', 'Nguyên', NULL, NULL, NULL, 1, 15, 3),
(56, '20264', 'Nguyễn Thị ', 'Hoa', NULL, NULL, NULL, 1, 15, 2),
(57, '10709', 'Đoàn', 'Tuân', NULL, NULL, NULL, 1, 15, 2),
(58, '20271', 'Nguyễn Thị Tuyết', 'Nam', NULL, NULL, NULL, 1, 15, 2),
(59, '20251', 'Nguyễn Văn', 'Nông', NULL, NULL, '', 1, 14, 3),
(60, NULL, 'Nguyễn Thị Hồng', 'Liên', NULL, NULL, '', 1, 14, 2),
(61, '10301', 'Trần Thị Nam', 'Trân', '', '', 'Giảng viên', 1, 17, 3),
(62, '10303', 'Trần Thị', 'Dung', NULL, NULL, NULL, 1, 16, 2),
(63, '20165', 'Nguyễn ', 'Hòa', NULL, NULL, NULL, 1, 10, 3),
(64, '10928', 'Nguyễn Ngọc ', 'Hiếu', NULL, NULL, NULL, 1, 20, 3),
(65, '10402', 'Hồ Xuân ', 'Thắng', NULL, NULL, 'Trưởng khoa Luật', 1, 18, 3),
(66, '10806', 'Nguyễn Hoàng ', 'Thịnh', NULL, NULL, NULL, 1, 18, 2),
(67, '10931', 'Nguyễn Lâm Trâm ', 'Anh', NULL, NULL, 'GV Khoa Luật', 1, 18, 2),
(68, '10794', 'Luyện Đức', 'Anh', NULL, NULL, NULL, 1, 18, 1),
(69, '10826', 'Lê Minh', 'Triết', '', '', '', 1, 2, 3),
(70, '10308', 'Phan Thị Xuân ', 'Yến', NULL, NULL, 'Phó Trưởng Khoa Giáo Dục Chính Trị', 1, 17, 3),
(71, '20351', 'Phạm Văn ', 'Phương', NULL, NULL, 'GV Khoa Giáo Dục Chính Trị', 1, 17, 2),
(72, '10307', 'Ngô Hoài  ', 'Thanh', NULL, NULL, 'GV Khoa Giáo Dục Chính Trị', 1, 17, 1),
(73, '10817', 'Nguyễn Thị Thu', 'Hằng', NULL, NULL, NULL, 1, 4, 2),
(74, '10032', 'Nguyễn Đình', 'Luận', NULL, NULL, 'Trưởng Phòng ĐTTC và Tu nghiệp Giáo viên', 1, 22, 3),
(75, '10613', 'Lê Hồng', 'Sơn', NULL, NULL, 'Phó Giám đốc TTĐTNV Kinh tế', 1, 23, 3),
(76, '10731', 'Nguyễn Ngọc ', 'Đức', NULL, NULL, 'Giám đốc TTĐTNV Kinh tế', 1, 14, 2),
(77, '10023', 'Nguyễn Thị', 'Đương', NULL, NULL, 'Phó trưởng phòng KHTC', 1, 23, 2),
(78, '10553', 'Trần Thị Hồng', 'Nhung', '', '', 'Chuyên viên', 1, 25, 2),
(79, '10005', 'Hoàng Hữu ', 'Lượng', NULL, NULL, 'Phó Hiệu trưởng', 1, 26, 2),
(80, '10061', 'Đỗ Đình', 'Thái', NULL, NULL, 'Trưởng phòng Khảo thí và Kiểm định chất lượng GD', 1, 21, 2),
(81, '10406', 'Trương Quang ', 'Dũng', NULL, NULL, 'Phó trưởng khoa QTKD', 1, 11, 3),
(82, '10060', 'Lê Thị Thanh', 'Thủy', '', '', 'Chuyên viên', 1, 25, 2),
(83, '10171', 'Trần Thị Thúy', 'Liễu', '', '', 'Nguyên Trưởng khoa', 1, 3, 2),
(84, '10278', 'Võ Phan Thu ', 'Hương', NULL, NULL, 'Giảng viên Khoa GDMN', 1, 5, 3),
(85, '10089', 'Hồ Văn', 'Bình', NULL, NULL, 'Giám đốc TT Ngoại ngữ', 1, 7, 2),
(86, '10090', 'Nguyễn Thị', 'Dung', '', '', 'Chuyên viên', 0, 25, 2),
(87, '10013', 'Mỵ Giang', 'Sơn', NULL, NULL, 'Trưởng phòng Đào tạo', 1, 27, 2),
(88, NULL, 'Nguyễn Thị', 'Tiết', NULL, NULL, 'Nguyên Giảng viên Khoa Môi trường', 1, 15, 3),
(89, '10175', 'Trịnh Duy', 'Oánh', '', '', 'Trưởng khoa', 1, 3, 3),
(90, '10136 ', 'Nguyễn Kiều', 'Dung', NULL, NULL, 'Trưởng BM Toán Khoa SP. KHTN', 1, 20, 2),
(91, '10024', 'Thái Thị Mỹ', 'Vân', NULL, NULL, 'Phó Trưởng phòng KHTC', 1, 23, 2),
(92, NULL, 'Đỗ Chiêu', 'Hà', '', '', 'Chuyên viên', 1, 25, 2),
(93, NULL, 'Nguyễn Việt', 'Bắc', NULL, NULL, 'Phó Hiệu trưởng', 1, 29, 2),
(94, '10056', 'Võ Văn', 'Lộc', '', '', 'Trợ lý Hiệu trưởng về Khoa học Công nghệ', 1, 25, 4),
(95, NULL, 'Mai Hà', 'Phương', NULL, NULL, 'Giảng viên khoa Văn hoá Du lịch', 1, 13, 3),
(96, '10125', 'Võ Thành', 'Lâm', '', '', 'Trưởng khoa SP.KHTN', 1, 20, 3),
(97, NULL, 'Nguyễn Phú ', 'Vinh', NULL, NULL, 'Trưởng khoa Khoa học cơ bản', 1, 20, 3),
(98, '10082', 'Nguyễn Minh ', 'Long', NULL, NULL, 'Giám đốc  TTKT & QLMTT', 1, 29, 2),
(99, '10058', 'Nguyễn Thị Minh', 'Hằng', '', '', 'Phó Trưởng phòng KHCN', 1, 25, 2),
(100, NULL, 'Lê Hùng ', 'Anh', NULL, NULL, 'Trưởng Bộ môn Công nghệ Môi trường ', 1, 42, 3),
(101, NULL, 'Phạm Thị Hoàng', 'Oanh', NULL, NULL, 'P.Trưởng khoa Hoá', 1, 34, 3),
(102, '10095', 'Mai Ngọc', 'Dũng', NULL, NULL, 'Chuyên viên Trung tâm Học liệu', 1, 30, 3),
(103, '10814', 'Võ Thúy ', 'Linh', '', '', 'Chuyên viên', 1, 25, 1),
(104, NULL, 'Võ Đình', 'Long', NULL, NULL, 'Trưởng khoa Quản lí Môi trường', 1, 36, 3),
(105, NULL, 'Phạm Hồng ', 'Nhật', NULL, NULL, 'Trưởng phòng Quan trắc Môi trường', 1, 35, 3),
(106, '10795', 'Lê Công', 'Nhân', '', '', 'Giảng viên', 1, 15, 3),
(107, NULL, 'Phan Thu', 'Hà', '', '', 'Chuyên viên', 1, 25, 1),
(108, '20350', 'Lê Đình', 'Lục', '', '', 'Trưởng khoa Giáo dục Chính trị', 1, 17, 3),
(109, '10179', 'Hà Minh ', 'Châu', '', '', 'Phó Trưởng khoa', 1, 3, 3),
(110, NULL, 'Vũ Thanh', 'Nguyên', NULL, NULL, 'Trưởng khoa Công nghệ Phần mềm', 1, 37, 3),
(111, NULL, 'Lư Nhật ', 'Vinh', NULL, NULL, 'Trưởng khoa Công nghệ thông tin', 1, 38, 3),
(112, NULL, 'Ngô Thanh', 'Hùng', NULL, NULL, 'GV Khoa Công nghệ thông tin', 1, 37, 3),
(113, '10086', 'Lê Hùng Thanh', 'Nhựt', NULL, NULL, 'Giám đốc  TT Tin học', 1, 32, 2),
(114, '10091', 'Phan Anh', 'Tài', NULL, NULL, 'Trưởng phòng KHTC', 1, 23, 2),
(115, '10884', 'Nguyễn Đăng', 'Khánh', NULL, NULL, 'GV khoa Văn hóa Du lịch', 1, 13, 3),
(116, '10177', 'Nguyễn Thị Thu ', 'Vân', NULL, NULL, 'GV Khoa SP.KHXH', 1, 3, 3),
(117, NULL, 'Nguyễn Văn', 'Hoa', NULL, NULL, 'Trưởng BM Vật lí hạt nhân', 1, 34, 3),
(118, '10741', 'Nguyễn Thanh', 'Bình', NULL, NULL, 'Phó trưởng Khoa Luật', 1, 18, 3),
(119, NULL, 'Nguyễn Cảnh', 'Hợp', NULL, NULL, 'Trưởng khoa Luật Hành chính', 1, 39, 4),
(120, NULL, 'Nguyễn Văn', 'Vân', NULL, NULL, 'Phó trưởng khoa Luật Thương mại', 1, 39, 3),
(121, NULL, 'Đặng Đức', 'Trọng', NULL, NULL, 'Trưởng Khoa Toán -Tin', 1, 40, 5),
(122, NULL, 'Mỵ Vinh', 'Quang', NULL, NULL, 'Trưởng Bô môn Đại số, Khoa Toán-Tin', 1, 34, 4),
(123, NULL, 'Trần Duy', 'Hiến', NULL, NULL, 'GV khoa Toán - Tin', 1, 40, 3),
(124, '10126', 'Phạm Hoàng', 'Quân', '', '', 'Phó Hiệu Trưởng', 1, 26, 4),
(125, NULL, 'Phạm Thế ', 'Dân', NULL, NULL, NULL, 1, 34, 3),
(126, '10218', 'Huỳnh Minh ', 'Trí', NULL, NULL, NULL, 1, 10, 2),
(127, '10138', 'Bùi Thị Cẩm ', 'Huệ', NULL, NULL, NULL, 1, 20, 2),
(128, '10227', 'Phùng Thái Thiên ', 'Trang', NULL, NULL, NULL, 1, 10, 2),
(129, '10600', 'Nguyễn Quốc ', 'Huy', NULL, NULL, NULL, 1, 10, 2),
(130, '10640', 'Nguyễn Tấn ', 'Hòa', NULL, NULL, NULL, 1, 2, 3),
(146, '20530', 'Tôn Thất', 'Trí', NULL, NULL, 'Phó Trưởng khoa Toán - Ứng dụng', 1, 2, 4),
(147, '10234', 'Phạm Ngọc', 'Bảo', NULL, NULL, 'Phó Trưởng Khoa Giáo Dục - Tiểu Học', 1, 4, 2),
(148, '10267', 'Trần Thị', 'Phương', NULL, NULL, 'Trưởng khoa Giáo dục  Mầm non', 1, 5, 3),
(149, '10268', 'Nguyễn Thị Bích', 'Ngọc', NULL, NULL, 'Phó Trưởng Khoa Giáo dục Mầm non', 1, 5, 2),
(150, '10194', 'Võ Duy', 'Lân', NULL, NULL, 'Trưởng khoa SPKT', 1, 6, 2),
(151, '10212', 'Nguyễn Thị Diệu', 'Thảo', '', '', 'Phó trưởng khoa', 1, 16, 3),
(152, '10195', 'Châu Ngọc', 'Thạch', NULL, NULL, 'Phó trưởng khoa SPKT', 1, 6, 2),
(153, '10324', 'Phạm Thị Hiền', 'Lương', NULL, NULL, 'Trưởng khoa Ngoại ngữ', 1, 7, 2),
(154, '10363', 'Đỗ Xuân', 'Tịnh', NULL, NULL, 'Trưởng khoa Mỹ thuật', 1, 8, 2),
(155, '10367', 'Nguyễn Xuân', 'Vinh', NULL, NULL, 'Phó trưởng khoa Mỹ thuật', 1, 8, 2),
(156, '10364', 'Lâm Trúc', 'Quyên', '', '', 'Trưởng khoa Nghệ thuật', 1, 9, 2),
(157, '10807', 'Hồ Văn', 'Cừu', NULL, NULL, 'Trưởng khoa Điện tử Viễn thông', 1, 19, 3),
(158, '10062', 'Lê Chi', 'Lan', NULL, NULL, 'Phó trưởng Phòng KT & KĐCL giáo dục', 1, 21, 2),
(159, '10033', 'Lê Thị Hiền', 'Giang', NULL, NULL, 'Phó trưởng Phòng ĐTTC & TNGV', 1, 22, 2),
(160, '10034', 'Vũ Đăng', 'Liên', NULL, NULL, 'Phó trưởng Phòng ĐTTC & TNGV', 1, 22, 2),
(161, '10040', 'Nguyễn Thị Thu', 'Hương', NULL, NULL, 'Trưởng phòng Hành chính - Tổng hợp', 1, 24, 1),
(162, '10017', 'Huỳnh Hữu', 'Đức', NULL, NULL, 'Phó trưởng phòng Hành chính - Tổng hợp', 1, 24, 8),
(163, '10014', 'Nguyễn Thị Mai', 'Dung', NULL, NULL, 'Phó trưởng phòng Đào tạo', 1, 27, 1),
(164, '10015', 'Huỳnh Tổ', 'Hạp', '', '', 'Phó trưởng phòng Đào tạo', 1, 27, 2),
(165, '10007', 'Thái Huy', 'Bảo', NULL, NULL, 'Trưởng phòng Tổ chức Cán bộ', 1, 28, 2),
(166, '10009', 'Nguyễn Thị Thu', 'Hồng', NULL, NULL, 'Phó trưởng phòng Tổ chức Cán bộ', 1, 28, 2),
(167, '10071', 'Lê', 'Thái', NULL, NULL, 'Trưởng phòng Quản Trị - Thiết Bị', 1, 43, 1),
(168, '10073', 'Trịnh Xuân', 'Thu', '', '', 'Trưởng phòng', 1, 43, 3),
(169, '10067', 'Nguyễn Thị Thu', 'Oanh', NULL, NULL, 'Trưởng phòng Thanh tra', 1, 44, 2),
(170, '10068', 'Lê Chí', 'Cường', NULL, NULL, 'Phó trưởng phòng Thanh tra', 1, 44, 2),
(171, '10443', 'Tô Quang', 'Nghĩa', NULL, NULL, 'Trưởng BM Giáo dục Thể chất', 1, 51, 1),
(172, '10444', 'Lê Ngọc', 'Long', '', '', 'Phó Trưởng BM Giáo dục Thể chất', 1, 51, 2),
(173, '10446', 'Lê Kiên', 'Giang', NULL, NULL, '', 1, 51, 2),
(174, '', 'Trần Trường', 'Sơn', NULL, NULL, 'Giảng viên Khoa GDTC', 1, 34, 2),
(175, NULL, 'Lê Nguyệt', 'Nga', NULL, NULL, 'Nguyên Phó Hiệu Trưởng Trường ĐH TDTT TP.HCM', 1, 54, 4),
(176, NULL, 'Đoàn Tiến', 'Trung', NULL, NULL, 'Giảng viên Khoa GDTC', 1, 34, 2),
(177, NULL, 'Phan Thị Lệ', 'Hằng', NULL, NULL, 'Trưởng khoa GDTC,Trường ĐH Sư Phạm TP.HCM', 1, 34, 2),
(178, NULL, 'Nguyễn Tiên', 'TIến', NULL, NULL, 'Trưởng phòng Đào tạo, Trường ĐH TDTT TP.HCM', 1, 54, 4),
(179, NULL, 'Nguyễn Văn', 'Hạ', NULL, NULL, 'Giảng viên Bộ môn GDTC-Khoa KHCB', 1, 55, 2),
(180, '10447', 'Trần Thị Xuân', 'Hương', '', '', '', 1, 51, 1),
(181, '10445', 'Trần Ngọc', 'Cương', NULL, NULL, '', 1, 51, 2),
(183, '10418', 'Hà Hoàng', 'Như', NULL, NULL, '', 1, 14, 2),
(190, '20013', 'Hồ Tấn', 'Tài', NULL, NULL, NULL, 1, 14, 2),
(191, '10420', 'Hà Lê Bích', 'Thủy', '', '', '', 1, 14, 2),
(193, '10631', 'Phan Tấn', 'Quốc', NULL, NULL, NULL, 1, 10, 2),
(195, '10220', 'Cao Thái Phương', 'Thanh', NULL, NULL, NULL, 1, 10, 2),
(196, '10223', 'Phan Thị Kim', 'Loan', NULL, NULL, NULL, 1, 10, 2),
(197, '10944', 'Nguyễn Võ Lam', 'Giang', '', '', '', 1, 10, 2),
(198, '101010', 'Nguyễn Thái', 'Hùng', 'hungnguyen2308@yahoo.com', '01696448664', '', 1, 10, 3),
(199, '10225', 'Nguyễn Đăng', 'Quan', NULL, NULL, NULL, 1, 10, 2),
(201, '10797', 'Huỳnh Thắng', 'Được', NULL, NULL, NULL, 1, 10, 2),
(202, NULL, 'Nguyễn Huy', 'Tuấn', '', '', '', 1, 2, 3),
(203, NULL, 'Phan Trung', 'Hiếu', '', '', '', 1, 2, 2),
(204, NULL, 'Trương Phúc Tuấn', 'Anh', '', '', '', 1, 2, 2),
(205, NULL, 'Nguyễn Thị Vân', 'Khánh', '', '', '', 1, 2, 2),
(206, NULL, 'Ngô Việt', 'Anh', '', '', '', 1, 25, 1),
(207, NULL, 'Phạm Thị Đoan', 'Trang', '', '', '', 1, 12, 2),
(208, NULL, 'Nguyễn Trần', 'Tiến', '', '', '', 1, 12, 1),
(209, NULL, 'Bùi Mạnh', 'Hà', '', '', '', 1, 15, 2),
(210, NULL, 'Nguyễn Huy Hoàng', 'Phi', '', '', '', 1, 15, 1),
(211, NULL, 'Dương Thị Giáng', 'Hương', '', '', '', 1, 15, 2),
(212, NULL, 'Vũ Thị', 'Thúy', '', '', '', 1, 15, 1),
(213, NULL, 'Nguyễn Văn', 'Vẹn', 'vennv@sgu.edu.vn', '', 'Phó Trưởng phòng KHCN', 1, 25, 2),
(214, NULL, 'Trần Thị Thúy', 'Nga', '', '', '', 1, 5, 2),
(215, NULL, 'Nguyễn Thị Xuân', 'Trinh', '', '', '', 1, 5, 2),
(216, NULL, 'Nguyễn Văn', 'Quyết', '', '', '', 1, 4, 2),
(217, NULL, 'Trịnh Cam', 'Ly', '', '', '', 1, 4, 2),
(218, NULL, 'Trịnh Viết', 'Toàn', '', '', 'Tổng Biên tập', 1, 61, 2),
(219, NULL, 'Nguyễn Kiên', 'Quyết', '', '', '', 1, 4, 2),
(220, NULL, 'Hoàng Thúy', 'Hà', '', '', '', 1, 13, 3),
(221, NULL, 'Nguyễn Thị Cẩm', 'Vân', '', '', '', 1, 6, 2),
(222, NULL, 'Trần Nam', 'Quốc', '', '', '', 1, 14, 2),
(223, NULL, 'Hồ Ngọc', 'Thủy', '', '', '', 1, 14, 2),
(224, NULL, 'Nguyễn Phan Thu', 'Hằng', '', '', '', 1, 14, 2),
(225, NULL, 'Hoàng Minh', 'Thơ', '', '', '', 1, 11, 2),
(226, NULL, 'Đinh Thị Kiều', 'Chinh', '', '', '', 1, 11, 2),
(227, NULL, 'Phan Phúc', 'Hạnh', '', '', '', 1, 11, 2),
(228, NULL, 'Nguyễn Xuân', 'Chiến', '', '', '', 1, 9, 2),
(229, NULL, 'Nguyễn Thị Thúy', 'Dung', '', '', 'Trưởng Khoa', 1, 16, 3),
(230, NULL, 'Bùi Thị', 'Toan', '', '', 'Nguyên Trưởng Bộ môn TLGD', 1, 16, 2),
(231, NULL, 'Hà Thúy', 'Ngọc', '', '', '', 1, 16, 2),
(232, NULL, 'Nguyễn Thị Hồng', 'Hoa', '', '', '', 1, 16, 2),
(233, NULL, 'Châu Phước', 'Khánh', '', '', '', 1, 19, 1),
(234, NULL, 'Trương Duy', 'Nhân', '', '', '', 1, 19, 7),
(235, NULL, 'Nguyễn Hữu', 'Phúc', '', '', '', 1, 19, 2),
(237, NULL, 'Trần Quang', 'Vinh', '', '', '', 1, 19, 3),
(238, NULL, 'Nguyễn Tấn', 'Hùng', '', '', '', 1, 19, 2),
(239, NULL, 'Nguyễn Ngọc Quỳnh', 'Dao', '', '', '', 1, 5, 3),
(240, NULL, 'Vũ Đắc', 'Thăng', '', '', '', 1, 16, 1),
(241, NULL, 'Lý Thị', 'Hằng', '', '', '', 1, 16, 2),
(242, NULL, 'Trần Văn', 'Luyện', '', '', '', 1, 16, 1),
(243, NULL, 'Nguyễn Thị', 'Ngọc', '', '', '', 1, 16, 2),
(244, NULL, 'Trần Đức', 'Tâm', '', '', '', 1, 16, 1),
(245, NULL, 'Nguyễn Thị', 'Trang', '', '', '', 1, 16, 2),
(246, NULL, 'Phạm Ngọc', 'Xuyến', '', '', '', 1, 16, 1),
(247, NULL, 'Lê Thành', 'Phượng', '', '', '', 1, 51, 1),
(248, NULL, 'Lê Thiện', 'Khiêm', '', '', '', 1, 51, 1),
(249, NULL, 'Nguyễn Văn', 'Nhã', '', '', '', 1, 51, 1),
(250, NULL, 'Hoàng Thị Kim', 'Ngọc', '', '', '', 1, 20, 2),
(251, NULL, 'Phan Hoàng', 'Chơn', '', '', '', 1, 2, 3),
(252, NULL, 'Trần Thị', 'Nhuận', '', '', '', 1, 2, 1),
(253, NULL, 'Trần Thị Thanh', 'Thủy', '', '', '', 1, 2, 2),
(254, NULL, 'Trần Sơn', 'Lâm', '', '', '', 1, 2, 2),
(255, NULL, 'Trần Đình', 'Nghĩa', '', '', '', 1, 10, 2),
(256, NULL, 'Phan Quốc', 'Cường', '', '', '', 1, 19, 2),
(257, NULL, 'Lê Quốc', 'Đán', '', '', '', 1, 19, 2),
(258, NULL, 'Nguyễn Thị Thu', 'Hằng', '', '', '', 1, 19, 2),
(259, NULL, 'Nguyễn Huy', 'Hùng', '', '', '', 1, 19, 2),
(260, NULL, 'Mã Thị Khánh', 'Tú', '', '', '', 1, 59, 2),
(262, NULL, 'Phan Thị', 'Hoa', '', '', '', 1, 5, 2),
(263, NULL, 'Trần Thị Hoàng', 'Phượng', '', '', '', 1, 5, 1),
(264, NULL, 'Đặng Xuân', 'Dự', '', '', '', 1, 20, 2),
(265, NULL, 'Phạm Văn', 'Hòa', '', '', '', 1, 20, 3),
(266, NULL, 'Dư Lý Thùy', 'Hương', '', '', '', 1, 20, 2),
(267, NULL, 'Ngô Đức', 'Quân', '', '', '', 1, 20, 2),
(268, NULL, 'Đặng Thị Ngọc', 'Thanh', '', '', '', 1, 20, 2),
(269, NULL, 'Phạm Thị Thu', 'Ly', '', '', '', 1, 20, 2),
(270, NULL, 'Nguyễn Thị Ngọc', 'Yến', '', '', '', 1, 20, 2),
(271, NULL, 'Lê Minh', 'Đức', '', '', '', 1, 20, 2),
(272, NULL, 'Nguyễn Thị Thanh', 'Lan', '', '', '', 1, 2, 2),
(273, NULL, 'Phạm Ngọc', 'Hiền', '', '', 'Phó Trưởng khoa SPKHXH', 1, 3, 3),
(274, NULL, 'Lý Đức', 'Hiếu', '', '', '', 1, 3, 7),
(275, NULL, 'Lê Ngọc Kim', 'Khánh', '', '', '', 1, 10, 2),
(276, NULL, 'Hoàng Mạnh', 'Hà', '', '', '', 1, 10, 2),
(277, NULL, 'Nguyễn Thị Quỳnh', 'Trang', '', '', '', 1, 15, 2),
(278, NULL, 'Nguyễn Thị Thu', 'Hằng', '', '', '', 1, 15, 2),
(279, NULL, 'Nguyễn Tuấn', 'Hải', '', '', '', 1, 15, 2),
(280, NULL, 'Đào Thanh', 'Vũ', '', '', '', 1, 15, 1),
(281, NULL, 'Nguyễn Quốc', 'Thệ', '', '', '', 1, 58, 2),
(282, NULL, 'Nguyễn Thị Thư', 'Nhường', '', '', '', 1, 9, 2),
(283, NULL, 'Nguyễn Thị', 'Hậu', '', '', '', 1, 19, 2),
(284, NULL, 'Nguyễn Hà', 'Quân', '', '', '', 1, 19, 7),
(285, NULL, 'Dương Hiển', 'Thuận', '', '', '', 1, 19, 2),
(286, NULL, 'Lê Thị Thanh Thùy', 'Mai', '', '', '', 1, 19, 1),
(288, NULL, 'Trần Thị', 'Dung', '', '', '', 1, 17, 2),
(289, NULL, 'Lã Thành', 'Trung', '', '', '', 1, 58, 2),
(290, NULL, 'Võ Lê', 'Minh', '', '', '', 1, 51, 2),
(291, NULL, 'Huỳnh Thanh', 'Sơn', '', '', '', 1, 51, 2),
(292, NULL, 'Nguyễn Thị Hải', 'Hồng', '', '', '', 1, 31, 1),
(293, NULL, 'Huỳnh Thanh', 'Trung', '', '', '', 1, 31, 1),
(294, NULL, 'Trần Minh', 'Tuấn', '', '', '', 1, 27, 1),
(295, NULL, 'Lê Xinh', 'Tươm', '', '', '', 1, 27, 1),
(296, NULL, 'Trần Thị', 'Hồng', '', '', '', 1, 27, 1),
(297, NULL, 'Nguyễn Thị', 'Hương', '', '', '', 1, 27, 1),
(298, NULL, 'Trần Lê', 'Khương', '', '', '', 1, 21, 2),
(299, NULL, 'Trần Đình', 'Nghĩa', '', '', '', 1, 21, 2),
(300, NULL, 'Lai Đình', 'Khải', '', '', '', 1, 21, 1),
(301, NULL, 'Đặng Thị Thanh', 'Hải', '', '', '', 1, 21, 1),
(302, NULL, 'Vũ Thị Phương', 'Nga', '', '', '', 1, 21, 1),
(303, NULL, 'Dương Trí', 'Trung', '', '', 'Giám đốc TT', 1, 30, 2),
(304, NULL, 'Cổ Tồn Minh', 'Đăng', '', '', 'Phó Giám đốc TT', 1, 30, 2),
(305, NULL, 'Nguyễn Thị Thanh', 'Duyên', '', '', '', 1, 12, 2),
(306, NULL, 'Trương Ngọc', 'Tú', '', '', '', 1, 30, 1),
(307, NULL, 'Hán Thành', 'Trung', '', '', '', 1, 30, 1),
(308, NULL, 'Phạm Thị', 'Thảo', '', '', '', 1, 30, 1),
(309, NULL, 'Trịnh Thị Tố', 'Quyên', '', '', '', 1, 46, 10),
(310, NULL, 'Phan Thụy Phương', 'Thảo', '', '', '', 1, 60, 2),
(311, NULL, 'Bùi Thủy', 'Ngân', '', '', '', 1, 60, 2),
(312, NULL, 'Nguyễn Long', 'Sơn', '', '', '', 1, 60, 2),
(313, NULL, 'Trần Thị', 'Ánh', '', '', '', 1, 60, 2),
(314, NULL, 'Nguyễn Thị Thanh', 'Loan', '', '', '', 1, 60, 1),
(315, NULL, 'Vũ Duy', 'Đăng', '', '', '', 1, 60, 1),
(316, NULL, 'Nguyễn Thị Thu', 'Hương', '', '', '', 1, 20, 2),
(317, NULL, 'Phạm Hoàng', 'Yến', '', '', '', 1, 20, 2),
(318, NULL, 'Nguyễn Văn', 'Huấn', '', '', '', 1, 2, 3),
(319, NULL, 'Đỗ Đình', 'Trang', '', '', '', 1, 10, 2),
(320, NULL, 'Nguyễn Anh', 'Hiền', '', '', '', 1, 14, 3),
(321, NULL, 'Hồ Xuân', 'Hữu', '', '', '', 1, 14, 2),
(322, NULL, 'Huỳnh Vũ Bảo', 'Trâm', '', '', '', 1, 14, 2),
(323, NULL, 'Hoàng Đức', 'Thắng', '', '', '', 1, 2, 1),
(324, NULL, 'Phạm Phúc', 'Vĩnh', '', '', '', 1, 17, 3),
(325, NULL, 'Nguyễn Thị Ngọc', 'Tú', '', '', '', 1, 14, 2),
(326, NULL, 'Võ Thị Thùy', 'Vân', '', '', '', 1, 14, 2),
(327, NULL, 'Trương Văn', 'Khánh', '', '', '', 1, 14, 3),
(328, NULL, 'Nguyễn Xuân', 'Cương', '', '', '', 1, 18, 2),
(329, NULL, 'Nguyễn Hoàng', 'Thịnh', '', '', '', 1, 18, 2),
(330, NULL, 'Phan Kim', 'Quí', '', '', '', 1, 5, 2),
(331, NULL, 'Nguyễn Kim', 'Hồng', '', '', '', 1, 5, 1),
(332, NULL, 'Nguyễn Phương', 'Thảo', '', '', '', 1, 5, 1),
(333, NULL, 'Hoàng Chu', 'Hiệp', '', '', '', 1, 5, 1),
(334, NULL, 'Nguyễn Thị Thanh', 'Dung', '', '', '', 1, 5, 1),
(335, NULL, 'Trần Ngọc', 'Cẩn', '', '', '', 1, 6, 7),
(336, NULL, 'Lê Học', 'Lâm', '', '', '', 1, 18, 2),
(337, NULL, 'Trần Thị', 'Thu', '', '', '', 1, 5, 1),
(338, NULL, 'Lê Thị', 'Hài', '', '', '', 1, 5, 2),
(339, NULL, 'Nguyễn Thị Kim', 'Dương', '', '', '', 1, 5, 2),
(340, NULL, 'Phạm Thị', 'Loan', '', '', '', 1, 5, 2),
(341, NULL, 'Nguyễn Thị Hải', 'Bình', '', '', '', 1, 5, 2),
(342, NULL, 'Nguyễn Thị', 'Thu', '', '', '', 1, 15, 1),
(343, NULL, 'Lê Sĩ', 'Trí', '', '', '', 1, 11, 3),
(344, NULL, 'Phan Hồng', 'Liên', '', '', '', 1, 11, 2),
(345, NULL, 'Trần Thị Kim', 'Chi', '', '', '', 1, 11, 2),
(346, NULL, 'Nguyễn Thị Hồng', 'Phượng', '', '', '', 1, 5, 3),
(355, NULL, 'NguyễnThị', 'Lan', '', '', '', 1, 4, 2),
(356, NULL, 'Trần Thế', 'Hiển', '', '', '', 1, 4, 2),
(357, NULL, 'Trần Thị', 'Lợi', '', '', '', 1, 4, 2),
(365, NULL, 'Nguyễn Trần Bảo', 'Chiêu', '', '', '', 1, 1, 2),
(366, NULL, 'Nguyễn Trần Bảo', 'Chiêu', '', '', '', 1, 11, 2),
(367, NULL, 'Phạm Hoàng', 'Vương', '', '', '', 1, 11, 2),
(368, NULL, 'Lê Đình', 'Nghi', '', '', '', 1, 11, 2),
(383, NULL, 'Nguyễn Hải', 'Bình', '', '', '', 1, 19, 3),
(384, NULL, 'Nguyễn Minh', 'Thạnh', '', '', '', 1, 19, 3),
(385, NULL, 'Trần Minh', 'Nhật', '', '', '', 1, 19, 2),
(387, NULL, 'Phạm Đào', 'Thịnh', '', '', '', 1, 17, 3),
(388, NULL, 'Trần Nam', 'Quốc', '', '', '', 1, 11, 2),
(389, NULL, 'Đinh Văn', 'Hiệp', '', '', '', 1, 11, 2),
(400, NULL, 'Nguyễn Thị Hoàng', 'Anh', '', '', '', 1, 51, 2),
(401, NULL, 'Đỗ Thụy Hội', 'Uyên', '', '', '', 1, 51, 2),
(402, NULL, 'Nguyễn Kim', 'Nga', '', '', '', 1, 51, 1),
(403, NULL, 'Nguyễn Hồng', 'Sơn', '', '', '', 1, 51, 1),
(416, NULL, 'Nguyễn Văn', 'Tiến', '', '', '', 1, 18, 2),
(417, NULL, 'Bành Quốc', 'Tuấn', '', '', '', 1, 18, 2),
(418, NULL, 'Hoàng Thị Việt', 'Anh', '', '', '', 1, 18, 2),
(419, NULL, 'Nguyễn Thị Thanh', 'Bình', '', '', '', 1, 18, 2),
(420, NULL, 'Ngô Thế', 'Tiến', '', '', '', 1, 18, 2),
(421, NULL, 'Trương Thị Tường', 'Vy', '', '', '', 1, 18, 2),
(440, NULL, 'Nguyễn Thị Kim', 'Phượng', '', '', '', 1, 15, 2),
(441, NULL, 'Vũ Thụy Hà', 'Anh', '', '', '', 1, 15, 2),
(442, NULL, 'Hồ Kỳ Quang', 'Minh', '', '', '', 1, 15, 3),
(445, NULL, 'Nguyễn Thị Kim', 'Ngân', '', '', '', 1, 61, 3),
(446, NULL, 'Nguyễn Quỳnh', 'Trang', '', '', '', 1, 3, 2),
(447, NULL, 'Phạm Lê Kim', 'Tuyến', '', '', '', 1, 7, 2),
(453, NULL, 'Hồ Văn', 'Hải', NULL, NULL, NULL, 1, 2, 3),
(454, NULL, 'Trịnh Cam', 'Ly', NULL, NULL, NULL, 1, 2, 2),
(455, NULL, 'Nguyễn Thị Thu', 'Hằng', NULL, NULL, NULL, 1, 2, 2),
(457, NULL, 'Nguyễn Thị', 'Lan', NULL, NULL, NULL, 1, 2, 2),
(458, NULL, 'Phạm Ngọc', 'Bảo', NULL, NULL, NULL, 1, 2, 2),
(459, NULL, 'Trần Thế', 'Hiển', NULL, NULL, NULL, 1, 2, 2),
(460, NULL, 'Trần Thị', 'Lợi', NULL, NULL, NULL, 1, 2, 2),
(461, NULL, 'Hồ Văn', 'Hải', NULL, NULL, NULL, 1, 4, 3),
(463, NULL, 'Nguyễn Thị', 'Lan', NULL, NULL, NULL, 1, 4, 2),
(464, NULL, 'Phạm Ngọc', 'Bảo', NULL, NULL, NULL, 1, 4, 2),
(465, NULL, 'Trương Văn', 'Ánh', '', '', '', 1, 7, 2),
(466, NULL, 'Phạm Thị Bạch', 'Tuyết', '', '', '', 1, 3, 2),
(467, NULL, 'Đặng Văn', 'Vũ', '', '', '', 1, 3, 3),
(468, NULL, 'Nguyễn Thị Hồng', 'Phượng', '', '', '', 1, 3, 2),
(469, NULL, 'Trương Thiên', 'Hương', '', '', '', 1, 3, 2),
(470, NULL, 'Đặng Thanh', 'Nam', '', '', '', 1, 12, 2),
(471, NULL, 'Lê Hùng', 'Điệp', '', '', '', 1, 12, 2),
(472, NULL, 'Nguyễn Thị Thanh', 'Tâm', '', '', '', 1, 12, 2),
(473, NULL, 'Thái Doãn', 'Chương', '', '', '', 1, 2, 3),
(474, NULL, 'Đinh Thị Ngọc', 'Loan', '', '', '', 1, 10, 2),
(475, NULL, 'Chế Thị Kim', 'Phụng', '', '', '', 1, 2, 3),
(476, NULL, 'Phan Tất', 'Hiển', '', '', '', 1, 2, 2),
(477, NULL, 'Lê Thái', 'Sơn', '', '', '', 1, 2, 2),
(478, NULL, 'Đặng Thu', 'Hiền', '', '', '', 1, 5, 1),
(479, NULL, 'Lê Thị', 'Nga', '', '', '', 1, 5, 1),
(480, NULL, 'Bùi Thị Xuân', 'Lụa', '', '', '', 1, 5, 1),
(481, NULL, 'Đào Việt', 'Cường', '', '', '', 1, 5, 2),
(482, NULL, 'Tống Thị Khánh', 'An', '', '', '', 1, 5, 2),
(483, NULL, 'Lê Thị Thu', 'Hiền', '', '', '', 1, 5, 2),
(484, NULL, 'Tôn Nữ Cẩm', 'Thành', '', '', '', 1, 5, 2),
(485, NULL, 'Nguyễn Hữu', 'Hạo', '', '', '', 1, 5, 1),
(486, NULL, 'Nguyễn Đức', 'Phương', '', '', '', 1, 16, 2),
(487, NULL, 'Nguyễn Thị Thanh', 'Hoa', '', '', '', 1, 16, 1),
(488, NULL, 'Lương Minh', 'Nhật', '', '', '', 1, 16, 1),
(489, NULL, 'Trần Văn', 'Sơn', '', '', '', 1, 16, 2),
(490, NULL, 'Phạm Thị Đoan', 'Trang', '', '', '', 1, 16, 2),
(491, NULL, 'Trương Đình Bảo', 'Hương', '', '', '', 1, 16, 2),
(492, NULL, 'Bùi Thị Thu', 'Lan', '', '', '', 1, 16, 2),
(493, NULL, 'Cao Thị', 'Nga', '', '', '', 1, 16, 2),
(494, NULL, 'Hoàng Mạnh', 'Khương', '', '', '', 1, 16, 2),
(495, NULL, 'Nguyễn Minh', 'Thủy', '', '', '', 1, 16, 1),
(496, NULL, 'Phan Anh', 'Huy', '', '', '', 1, 44, 2),
(497, NULL, 'Nguyễn Xuân', 'Hoàng', '', '', '', 1, 44, 1),
(498, NULL, 'Trần Đình', 'Phụng', '', '', '', 1, 14, 3),
(499, NULL, 'Giang Quốc', 'Tuấn', '', '', '', 1, 14, 2),
(501, NULL, 'Ngô Huyền', 'Trân', '', '', '', 1, 20, 2),
(502, NULL, 'Phạm Thị Thanh', 'Hương', '', '', '', 1, 20, 2),
(503, NULL, 'Nguyễn Văn', 'Tú', '', '', '', 1, 20, 1),
(504, NULL, 'Đỗ Gia', 'Bảo', '', '', '', 1, 20, 1),
(505, NULL, 'Phạm Thị Thanh', 'Hiền', '', '', '', 1, 20, 2),
(506, NULL, 'Nguyễn Văn', 'Thắng', '', '', '', 1, 20, 3),
(507, NULL, 'Huỳnh Thống', 'Nhất', '', '', '', 1, 4, 2),
(508, NULL, 'Trần Thị Phương', 'Lý', '', '', '', 1, 3, 3),
(509, NULL, 'Trần Thị Thanh', 'Vân', '', '', '', 1, 3, 3),
(510, NULL, 'Nguyễn Lương', 'Tùng', '', '', '', 1, 60, 2),
(511, NULL, 'Nguyễn Thị Ngọc', 'Thảo', '', '', '', 1, 15, 2),
(512, NULL, 'Nguyễn Thị Uyên', 'Nhi', '', '', '', 1, 10, 2),
(513, NULL, 'Đỗ Ngọc Như', 'Loan', '', '', '', 1, 10, 2),
(514, NULL, 'Văn Tấn', 'Lượng', '', '', '', 1, 19, 3),
(515, NULL, 'Tạ Quang', 'Sơn', '', '', '', 1, 25, 3),
(516, NULL, 'Đào Vinh', 'Xuân', '', '', '', 1, 16, 2),
(519, NULL, 'Lâm Hoàng Thúy', 'Hạnh', '', '', '', 1, 61, 1),
(520, NULL, 'Bùi Thị Hồng', 'Phúc', '', '', '', 1, 61, 1),
(521, NULL, 'Phan Thị Thanh', 'Hương', '', '', '', 1, 16, 2),
(522, NULL, 'Bùi Thị Giáng', 'Hương', '', '', '', 1, 24, 2),
(523, NULL, 'Trần Hồng Như', 'Lệ', '', '', '', 1, 5, 2),
(524, NULL, 'Phạm Thị Thanh', 'Tú', '', '', '', 1, 4, 3),
(525, NULL, 'Phạm Thanh', 'Trung', '', '', '', 1, 14, 1),
(526, NULL, 'Nguyễn Ngọc Huyền', 'Trân', '', '', '', 1, 14, 1),
(527, NULL, 'Nguyễn Thành', 'Danh', '', '', '', 1, 11, 1),
(528, NULL, 'Nguyễn Thị Thanh', 'Tâm', '', '', '', 1, 11, 1),
(529, NULL, 'Nguyễn Duy', 'Thục', '', '', '', 1, 31, 3),
(530, NULL, 'Nguyễn Thanh', 'Tân', '', '', '', 1, 17, 3),
(531, NULL, 'Trần Thanh', 'Hằng', '', '', '', 1, 17, 2),
(532, NULL, 'Nguyễn Khắc', 'Duy', '', '', '', 1, 17, 2),
(533, NULL, 'Nguyễn Quang Minh', 'Triết', '', '', '', 1, 7, 3),
(534, NULL, 'Trần Ngọc', 'Mai', '', '', '', 1, 7, 2),
(535, NULL, 'Nguyễn Thị', 'Huệ', '', '', '', 1, 7, 2),
(536, NULL, 'Doãn Thị Thúy', 'Liễu', '', '', '', 1, 7, 2),
(537, NULL, 'Trần Hoàng Thị Ái', 'Cầm', '', '', '', 1, 9, 2),
(538, NULL, 'Tô Thái', 'Hà', '', '', '', 1, 51, 2),
(539, NULL, 'Nguyễn Xuân Trí', 'Nghĩa', '', '', '', 1, 60, 1),
(540, NULL, 'Nguyễn Thị Phương', 'Hồng', '', '', '', 1, 60, 1),
(541, NULL, 'Nguyễn Thành', 'Trung', '', '', '', 1, 60, 1),
(542, NULL, 'Huỳnh Lê Minh', 'Thiện', '', '', '', 1, 19, 2),
(543, NULL, 'Võ Đức', 'Toàn', '', '', '', 1, 14, 3),
(544, NULL, 'Trầm Bích', 'Lộc', '', '', '', 1, 14, 1),
(545, NULL, 'Phạm Ngọc', 'Toàn', '', '', '', 1, 14, 3),
(546, NULL, 'Nguyễn Chương Thiên', 'Hương', '', '', '', 1, 14, 2),
(547, NULL, 'Hoàng Thúy', 'Hà', '', '', '', 1, 4, 3),
(548, NULL, 'Phạm Thị Giang', 'Anh', '', '', '', 1, 20, 2),
(549, NULL, 'Trần Thị Hoàng', 'Phượng', '', '', '', 1, 5, 1),
(550, NULL, 'Phạm Hoàng', 'Quân', '', '', 'Trưởng khoa', 1, 2, 4);

-- --------------------------------------------------------

--
-- Table structure for table `gop_y`
--

CREATE TABLE IF NOT EXISTS `gop_y` (
  `gop_y_id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `loai_id` int(11) unsigned NOT NULL,
  `nguoi_dung_id` int(11) unsigned NOT NULL,
  `ten` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `mo_ta` text COLLATE utf8_unicode_ci NOT NULL,
  `ngay_tao` datetime NOT NULL,
  `tinh_trang` enum('initial','pending','failure','completed') COLLATE utf8_unicode_ci NOT NULL DEFAULT 'initial',
  `ghi_chu` text COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`gop_y_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=2 ;

--
-- Dumping data for table `gop_y`
--

INSERT INTO `gop_y` (`gop_y_id`, `loai_id`, `nguoi_dung_id`, `ten`, `mo_ta`, `ngay_tao`, `tinh_trang`, `ghi_chu`) VALUES
(1, 1, 1, 'Hello Admin', 'Hello Admin Hello Admin Hello Admin Hello Admin Hello Admin Hello Admin Hello Admin ', '2014-03-15 14:32:55', 'initial', '');

-- --------------------------------------------------------

--
-- Table structure for table `he_cao_hoc`
--

CREATE TABLE IF NOT EXISTS `he_cao_hoc` (
  `id` int(4) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(32) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `ten` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `he_cao_hoc`
--

INSERT INTO `he_cao_hoc` (`id`, `name`, `ten`) VALUES
(1, 'dhsg', 'Hệ cao học Đại học Sài Gòn'),
(2, 'dhvinh', 'Hệ cao học liên kết Đại học Vinh');

-- --------------------------------------------------------

--
-- Table structure for table `hinh_anh`
--

CREATE TABLE IF NOT EXISTS `hinh_anh` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `ten_file` varchar(200) COLLATE utf8_unicode_ci NOT NULL,
  `trang_thai` tinyint(4) NOT NULL DEFAULT '1',
  `slideshow` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=26 ;

--
-- Dumping data for table `hinh_anh`
--

INSERT INTO `hinh_anh` (`id`, `ten_file`, `trang_thai`, `slideshow`) VALUES
(1, '1.jpg', 1, 0),
(2, '2.jpg', 1, 0),
(3, '7.jpg', 1, 0),
(4, '8.jpg', 1, 0),
(5, '9.jpg', 1, 0),
(6, '10.jpg', 1, 0),
(7, '12.jpg', 1, 0),
(8, '13.jpg', 1, 0),
(9, '3.jpg', 1, 0),
(10, '4.jpg', 1, 0),
(11, '5.jpg', 1, 0),
(12, '6.jpg', 1, 0),
(14, '14.jpg', 1, 0),
(15, '1413511929_dsc_0311.JPG', 1, 1),
(16, '1413511939_dsc_0361.JPG', 1, 1),
(17, '1413511955_dsc_0316.JPG', 1, 1),
(18, '1413511982_dsc_0131.JPG', 1, 1),
(19, '1413512011_dsc_0113.JPG', 1, 1),
(20, '1413512031_dsc_0361.JPG', 1, 1),
(21, '1416370230_nh-1.JPG', 1, 1),
(22, '1416370240_nh-3.JPG', 1, 1),
(23, '1416370248_nh-3a.JPG', 1, 1),
(24, '1416370257_nh-4.JPG', 1, 1),
(25, '1416370262_nh-5.JPG', 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `hinh_anh_chuyen_de`
--

CREATE TABLE IF NOT EXISTS `hinh_anh_chuyen_de` (
  `hinh_anh_chuyen_de_id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `chuyen_de_id` int(11) NOT NULL,
  `ten_file` varchar(200) COLLATE utf8_unicode_ci NOT NULL,
  `trang_thai` tinyint(4) NOT NULL DEFAULT '1',
  PRIMARY KEY (`hinh_anh_chuyen_de_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `hoc_vi`
--

CREATE TABLE IF NOT EXISTS `hoc_vi` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `ma` varchar(10) COLLATE utf8_unicode_ci NOT NULL,
  `ten` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `ghi_chu` text COLLATE utf8_unicode_ci,
  PRIMARY KEY (`id`),
  UNIQUE KEY `ma` (`ma`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci COMMENT='Xem lai length cua Ghi Chu, TenChucDanh' AUTO_INCREMENT=11 ;

--
-- Dumping data for table `hoc_vi`
--

INSERT INTO `hoc_vi` (`id`, `ma`, `ten`, `ghi_chu`) VALUES
(1, 'CN.', 'Cử Nhân', ''),
(2, 'ThS.', 'Thạc Sĩ', ''),
(3, 'TS.', 'Tiến Sĩ', ''),
(4, 'PGS. TS.', 'Phó Giáo Sư - Tiến Sĩ', ''),
(5, 'GS. TS.', 'Giáo Sư - Tiến Sĩ', ''),
(6, 'CNCĐ.', 'Cử Nhân CĐ', ''),
(7, 'KS.', 'Kỹ Sư', ''),
(8, 'CH.', 'Cao học', ''),
(9, '0', 'Chưa xác định', ''),
(10, 'BSCKII.', 'Bác sĩ chuyên khoa II', '');

-- --------------------------------------------------------

--
-- Table structure for table `hoc_vien`
--

CREATE TABLE IF NOT EXISTS `hoc_vien` (
  `hoc_vien_id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `nguoi_dung_id` int(11) NOT NULL,
  `ma` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `ho` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `ten` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `ngay_sinh` date DEFAULT NULL,
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `so_dien_thoai` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `ngay_tao` datetime NOT NULL,
  `enabled` tinyint(1) NOT NULL DEFAULT '1',
  PRIMARY KEY (`hoc_vien_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `hoi_dong_duyet`
--

CREATE TABLE IF NOT EXISTS `hoi_dong_duyet` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `ma` varchar(15) COLLATE utf8_unicode_ci DEFAULT NULL,
  `ngay_thanh_lap` date DEFAULT NULL,
  `ghi_chu` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `ma` (`ma`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=24 ;

--
-- Dumping data for table `hoi_dong_duyet`
--

INSERT INTO `hoi_dong_duyet` (`id`, `ma`, `ngay_thanh_lap`, `ghi_chu`) VALUES
(15, 'HDD2010-01', '2010-01-19', NULL),
(16, 'HDD2010-02', '2010-01-19', NULL),
(17, 'HDD2010-03', '2010-01-19', NULL),
(18, 'HDD2010-04', '2010-01-19', NULL),
(19, 'HDD2010-05', '2010-01-19', NULL),
(20, 'HDD2010-06', '2010-01-19', NULL),
(22, 'HDD2010-08', '2010-01-19', ''),
(23, 'HDDD2012-15', '2012-04-28', 'Hóa sinh');

-- --------------------------------------------------------

--
-- Table structure for table `hoi_dong_nghiem_thu`
--

CREATE TABLE IF NOT EXISTS `hoi_dong_nghiem_thu` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `ma` varchar(15) COLLATE utf8_unicode_ci NOT NULL,
  `ngay_thanh_lap` date DEFAULT NULL,
  `ma_de_tai` int(11) NOT NULL,
  `ghi_chu` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `ma` (`ma`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=5 ;

--
-- Dumping data for table `hoi_dong_nghiem_thu`
--

INSERT INTO `hoi_dong_nghiem_thu` (`id`, `ma`, `ngay_thanh_lap`, `ma_de_tai`, `ghi_chu`) VALUES
(1, 'HDNT2010-01', '2010-12-16', 5, ''),
(2, 'HDNT2011-01', '2012-04-09', 31, NULL),
(3, 'HDNT2011-02', '2012-04-09', 32, NULL),
(4, 'HDNT2011-03', '2012-04-09', 33, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `hoi_thao`
--

CREATE TABLE IF NOT EXISTS `hoi_thao` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `chu_de` varchar(200) COLLATE utf8_unicode_ci NOT NULL,
  `cap_quan_ly` tinyint(4) NOT NULL,
  `doi_tac` varchar(200) COLLATE utf8_unicode_ci DEFAULT NULL,
  `don_vi_id` int(11) NOT NULL,
  `ngay_to_chuc` date NOT NULL,
  `thong_cao_bao_chi` varchar(200) COLLATE utf8_unicode_ci DEFAULT NULL,
  `anh_trang_bia` varchar(200) COLLATE utf8_unicode_ci DEFAULT NULL,
  `trang_thai` tinyint(4) NOT NULL DEFAULT '1',
  `so_luong_dai_bieu` int(11) DEFAULT '0',
  `dia_diem` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `mo_ta` longtext COLLATE utf8_unicode_ci,
  `don_vi_phu_trach` text COLLATE utf8_unicode_ci,
  `search` tinyint(1) NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=17 ;

--
-- Dumping data for table `hoi_thao`
--

INSERT INTO `hoi_thao` (`id`, `chu_de`, `cap_quan_ly`, `doi_tac`, `don_vi_id`, `ngay_to_chuc`, `thong_cao_bao_chi`, `anh_trang_bia`, `trang_thai`, `so_luong_dai_bieu`, `dia_diem`, `mo_ta`, `don_vi_phu_trach`, `search`) VALUES
(1, 'Chăm sóc sức khỏe người cao tuổi và người tàn tật', 1, 'Trường Đại học ngắn hạn OSAKA Nhật Bản', 5, '2007-12-25', NULL, NULL, 1, 0, NULL, NULL, NULL, 1),
(2, 'Giáo dục Mầm Non', 1, 'Trường Đại học Ngắn hạn OSAKA Nhật Bản', 5, '2008-12-25', NULL, NULL, 1, 0, NULL, NULL, NULL, 1),
(3, 'Đào tạo nghiệp vụ Chuẩn hóa ngành TV-TT', 1, 'Hiệp hội Thư viện quốc tế', 12, '2009-02-20', NULL, NULL, 1, 0, NULL, NULL, NULL, 1),
(4, 'Đào tạo nguồn nhân lực ngành VH-DL trong xu thế hội nhập và phát triển', 4, NULL, 13, '2009-11-24', NULL, NULL, 1, 0, NULL, NULL, NULL, 1),
(5, 'Chăm sóc sức khỏe người cao tuổi và người tàn tật', 1, 'Trường Đại học Ngắn hạn OSAKA Nhật Bản', 5, '2009-12-25', NULL, NULL, 1, 0, NULL, NULL, NULL, 1),
(6, 'Đổi mới PP Giảng dạy đại học theo hệ thống tín chỉ', 4, NULL, 3, '2010-05-21', NULL, NULL, 1, 0, NULL, NULL, NULL, 1),
(7, 'Phát triển và giữ gìn sự trong sáng của tiếng Việt trong thời kì hội nhập quốc tế hiện nay', 4, 'Trường ĐH Ngoại ngữ - Tin học TP. HCM (Hufflit)', 1, '2010-06-18', NULL, NULL, 1, 0, NULL, NULL, NULL, 1),
(8, 'Hội nghị Vật lí Lí thuyết toàn quốc lần thứ 35', 4, 'Viện Vật lí Hà Nội', 20, '2010-08-02', NULL, NULL, 1, 0, NULL, NULL, NULL, 1),
(9, 'Tập huấn truy tập thông tin theo chủ đề', 1, 'Hiệp hội Thư viện quốc tế', 12, '2010-09-28', NULL, NULL, 1, 0, NULL, NULL, NULL, 1),
(10, 'Về nghiên cứu phát triển và ứng dụng công nghệ xử lí chất thải rắn', 1, 'Hiệp hội SAXUTEC và Trường ĐH Kỹ thuật Dresden, CHLB Đức', 15, '2010-10-29', 'Thong cao bao chi_Hoi thao Viet_Duc.doc', NULL, 1, 0, NULL, NULL, NULL, 1),
(11, 'Thực tiển Giáo dục Mầm non ở Việt Nam và Nhật Bản hiện nay', 1, 'Trường Đại học Ngắn hạn OSAKA Nhật Bản', 5, '2010-12-21', '', NULL, 1, 0, NULL, NULL, NULL, 1),
(12, 'Về nghiên cứu phát triển và ứng dụng công nghệ xử lí chất thải rắn (lần 3)', 1, 'Hiệp hội SAXUTEC', 1, '2011-03-30', NULL, NULL, 1, 0, NULL, NULL, NULL, 1),
(13, 'NHU CẦU SỬ DỤNG VÀ ĐÀO TẠO NHÂN LỰC NGHỀ BẾP VIỆT TẠI TP. HCM', 4, '', 6, '2011-10-21', '1335970143_thong-cao-bao-chi_hoi-thao-nghe-bep-viet.doc', '1331742140_bep.jpg', 1, 0, NULL, NULL, NULL, 1),
(14, 'Đánh giá 10 năm (2001 - 2010) xây dựng Nhà nước pháp quyền và những luận cứ khoa học cho việc tiếp tục xây dựng Nhà nước pháp quyền XHCN Việt Nam  giai đoạn 2011-2020', 4, '', 1, '2011-11-24', '1394907633_1336007936_thong-cao-bao-chi-hoi-thao-khoa-hoc-luat.doc', '', 1, 0, '', '', '', 1),
(15, 'NGHIÊN CỨU CÁC PHƯƠNG PHÁP GIẢNG DẠY HIỆU QUẢ  KỸ NĂNG NGHE VÀ ĐỌC TIẾNG ANH', 4, NULL, 1, '2014-08-22', '1412669457_thong-cao-bao-chi-hoi-thao-tieng-anh.doc', '1412669457_hoi-thao-tieng-anh.JPG', 1, 100, 'Hội trường A - Trường Đại học Sài Gòn', '<p style="text-align: center;">\r\n	<span style="color: rgb(0, 0, 255);"><strong><span style="font-size: 26px;"><span style="font-family: ''Times New Roman'';">HỘI THẢO KHOA HỌC</span></span></strong></span></p>\r\n<div style="text-align: center;">\r\n	<span style="color: rgb(0, 0, 255);"><strong><span style="font-size: 26px;"><span style="font-family: ''Times New Roman'';">&ldquo;NGHI&Ecirc;N CỨU C&Aacute;C PHƯƠNG PH&Aacute;P GIẢNG DẠY HIỆU QUẢ</span></span></strong></span></div>\r\n<div style="text-align: center;">\r\n	<span style="color: rgb(0, 0, 255);"><strong><span style="font-size: 26px;"><span style="font-family: ''Times New Roman'';">KỸ NĂNG NGHE V&Agrave; ĐỌC TIẾNG ANH&rdquo;</span></span></strong></span></div>\r\n<div>\r\n	&nbsp;</div>\r\n<div style="text-align: justify;">\r\n	<span style="font-family: Arial; font-size: 16px;">&nbsp; &nbsp; &nbsp; &nbsp; &nbsp;&nbsp;</span><span style="font-size: 16px;"><span style="font-family: Arial;">Ng&agrave;y 22/08/2014, Trường Đại học S&agrave;i G&ograve;n đ&atilde; tổ chức Hội thảo khoa học với chủ đề &ldquo;Nghi&ecirc;n cứu c&aacute;c phương ph&aacute;p giảng dạy hiệu quả c&aacute;c kỹ năng nghe v&agrave; đọc tiếng Anh&rdquo;.</span></span></div>\r\n<div style="text-align: justify;">\r\n	&nbsp;</div>\r\n<div style="text-align: justify;">\r\n	<span style="font-size: 16px;"><span style="font-family: Arial;">&nbsp; &nbsp; &nbsp; &nbsp; &nbsp;Đến tham dự Hội thảo c&oacute; PGS.TS. Phạm Ho&agrave;ng Qu&acirc;n, Ph&oacute; Hiệu trưởng Trường Đại học S&agrave;i G&ograve;n; PGS.TS. V&otilde; Văn Lộc, Trợ l&iacute; Hiệu trưởng về Khoa học &ndash; C&ocirc;ng nghệ; TS. Tạ Quang Sơn, Phụ tr&aacute;ch ph&ograve;ng Quản l&yacute; Khoa học v&agrave; Sau Đại học; ThS. Trịnh Viết To&agrave;n, Gi&aacute;m đốc Trung t&acirc;m Th&ocirc;ng tin &ndash; Truyền th&ocirc;ng &amp; Ph&aacute;t triển Gi&aacute;o dục; c&aacute;c Ph&oacute; Gi&aacute;o sư, Tiến sĩ, c&aacute;c nh&agrave; khoa học, giảng vi&ecirc;n trong v&agrave; ngo&agrave;i trường; đại diện c&aacute;c cơ quan b&aacute;o đ&agrave;i, truyền th&ocirc;ng c&ugrave;ng to&agrave;n thể c&aacute;n bộ giảng vi&ecirc;n Khoa Ngoại ngữ v&agrave; sinh vi&ecirc;n chuy&ecirc;n ng&agrave;nh Sư phạm tiếng Anh.</span></span></div>\r\n<div style="text-align: justify;">\r\n	&nbsp;</div>\r\n<div style="text-align: justify;">\r\n	<span style="font-size: 16px;"><span style="font-family: Arial;">&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; Hội thảo tập trung chủ yếu v&agrave;o việc đ&aacute;nh gi&aacute; phương ph&aacute;p giảng dạy hiệu quả c&aacute;c kỹ năng nghe v&agrave; đọc tiếng Anh đang thực hiện tại Khoa Ngoại ngữ cũng như trong v&agrave; ngo&agrave;i Trường Đại học S&agrave;i G&ograve;n; chia sẻ những kh&oacute; khăn, những vấn đề thường gặp trong qu&aacute; tr&igrave;nh giảng dạy nghe, đọc v&agrave; đ&aacute;nh gi&aacute; những vấn đề li&ecirc;n quan đến chuy&ecirc;n m&ocirc;n như y&ecirc;u cầu đ&agrave;o tạo, nội dung gi&aacute;o tr&igrave;nh, tr&igrave;nh độ sinh vi&ecirc;n&hellip; đặc biệt l&agrave; c&aacute;c giải ph&aacute;p về chuy&ecirc;n m&ocirc;n v&agrave; kỹ thuật giảng dạy kỹ năng nghe, đọc. Th&ocirc;ng qua c&aacute;c c&acirc;u hỏi phản biện v&agrave; những &yacute; kiến đ&oacute;ng g&oacute;p, c&aacute;c giảng vi&ecirc;n trong v&agrave; ngo&agrave;i trường đ&atilde; b&agrave;y tỏ sự quan t&acirc;m s&acirc;u sắc của m&igrave;nh về việc n&acirc;ng cao chất lượng giảng dạy v&agrave; học tập hiệu quả c&aacute;c kỹ năng nghe v&agrave; đọc tiếng Anh cho sinh vi&ecirc;n Khoa Ngoại ngữ n&oacute;i ri&ecirc;ng v&agrave; to&agrave;n trường n&oacute;i chung.</span></span></div>\r\n<div style="text-align: justify;">\r\n	&nbsp;</div>\r\n<div style="text-align: justify;">\r\n	<span style="font-family: Arial; font-size: 16px;">&nbsp; &nbsp; &nbsp; &nbsp; &nbsp;</span><span style="font-family: Arial; font-size: 16px;">&nbsp;</span><span style="font-size: 16px;"><span style="font-family: Arial;">Hội thảo đ&atilde; diễn ra th&agrave;nh c&ocirc;ng tốt đẹp, mang đến những triển vọng đầy hứa hẹn cho sự đổi mới v&agrave; cải tiến phương ph&aacute;p giảng dạy tiếng Anh, từ đ&oacute; gi&uacute;p tăng sự hứng th&uacute;, say m&ecirc; kh&aacute;m ph&aacute; v&agrave; học hỏi s&aacute;ng tạo trong học tập cho sinh vi&ecirc;n.</span></span></div>\r\n<div>\r\n	&nbsp;</div>\r\n<div>\r\n	<span style="font-family: Arial; font-size: 16px; text-align: justify;">&nbsp; &nbsp; &nbsp; &nbsp; &nbsp;</span><span style="font-family: Arial; font-size: 16px; text-align: justify;">&nbsp;</span><em><strong><span style="font-size: 16px;"><span style="font-family: Arial;">Một số h&igrave;nh ảnh của Hội thảo:</span></span></strong></em></div>\r\n<div>\r\n	&nbsp;</div>\r\n<div style="text-align: center;">\r\n	<span style="font-size: 16px;"><span style="font-family: Arial;"><img alt="" height="400" src="http://www.sgu.edu.vn/images/stories/02014/T9/05/Hoi%20thao%20KNN/image001.jpg" width="600" /></span></span><br />\r\n	<em><span style="font-size: 16px;"><span style="font-family: Arial;">PGS. TS. Phạm Ho&agrave;ng Qu&acirc;n ph&aacute;t biểu khai mạc Hội thảo</span></span></em></div>\r\n<div style="text-align: center;">\r\n	&nbsp;</div>\r\n<div style="text-align: center;">\r\n	<em><span style="font-size: 16px;"><span style="font-family: Arial;"><img alt="" height="398" src="http://www.sgu.edu.vn/images/stories/02014/T9/05/Hoi%20thao%20KNN/image003.jpg" width="600" /></span></span></em></div>\r\n<div style="text-align: center;">\r\n	<em><span style="font-size: 16px;"><span style="font-family: Arial;">Đo&agrave;n Chủ tịch điều khiển chương tr&igrave;nh Hội thảo</span></span></em></div>\r\n<div style="text-align: center;">\r\n	&nbsp;</div>\r\n<div style="text-align: center;">\r\n	<em><span style="font-size: 16px;"><span style="font-family: Arial;"><img alt="" height="468" src="http://www.sgu.edu.vn/images/stories/02014/T9/05/Hoi%20thao%20KNN/image005.jpg" width="600" /></span></span></em></div>\r\n<div style="text-align: center;">\r\n	<em><span style="font-size: 16px;"><span style="font-family: Arial;">ThS. L&ecirc; Th&uacute;y Hằng, giảng vi&ecirc;n Khoa Ngoại ngữ&nbsp;</span></span></em></div>\r\n<div style="text-align: center;">\r\n	<em><span style="font-size: 16px;"><span style="font-family: Arial;">tr&igrave;nh b&agrave;y b&aacute;o c&aacute;o về kỹ thuật v&agrave; chiến lược l&agrave;m b&agrave;i kỹ năng đọc</span></span></em></div>\r\n<div style="text-align: center;">\r\n	&nbsp;</div>\r\n<div style="text-align: center;">\r\n	<em><span style="font-size: 16px;"><span style="font-family: Arial;"><img alt="" height="752" src="http://www.sgu.edu.vn/images/stories/02014/T9/05/Hoi%20thao%20KNN/image007.jpg" width="500" /></span></span></em></div>\r\n<div style="text-align: center;">\r\n	<em><span style="font-size: 16px;"><span style="font-family: Arial;">ThS. Đỗ Thị Kim Thanh đến từ Trường Cao đẳng Kinh tế TP.HCM&nbsp;</span></span></em></div>\r\n<div style="text-align: center;">\r\n	<em><span style="font-size: 16px;"><span style="font-family: Arial;">b&aacute;o c&aacute;o về c&aacute;ch thực h&agrave;nh kỹ năng nghe của sinh vi&ecirc;n bằng &ldquo;Nhật k&iacute; kỹ năng nghe&rdquo;</span></span></em></div>\r\n<div style="text-align: center;">\r\n	&nbsp;</div>\r\n<div style="text-align: center;">\r\n	<em><span style="font-size: 16px;"><span style="font-family: Arial;"><img alt="" height="398" src="http://www.sgu.edu.vn/images/stories/02014/T9/05/Hoi%20thao%20KNN/image009.jpg" width="600" /></span></span></em></div>\r\n<div style="text-align: center;">\r\n	<em><span style="font-size: 16px;"><span style="font-family: Arial;">C&aacute;c giảng vi&ecirc;n tham dự tham gia thảo luận tại Hội thảo</span></span></em></div>\r\n', 'Trường Đại học Sài Gòn', 1),
(16, 'Đổi mới nội dung chương trình và phương pháp đào tạo giáo viên  bậc Trung học cơ sở', 3, NULL, 1, '2014-08-29', '1412669869_thong-cao-bao-chi-hoi-thao-thcs.doc', NULL, 1, 150, 'Hội trường cơ sở 3 - Trường Đại học Sài Gòn', '<p style="text-align: center;">\r\n	<span style="color: rgb(0, 0, 128);"><strong><span style="font-size: 26px;"><span style="font-family: ''Times New Roman'';">HỘI THẢO KHOA HỌC</span></span></strong></span><br />\r\n	<span style="color: rgb(0, 0, 128);"><strong><span style="font-size: 26px;"><span style="font-family: ''Times New Roman'';">&ldquo;ĐỔI MỚI NỘI DUNG CHƯƠNG TR&Igrave;NH V&Agrave;</span></span></strong></span><br />\r\n	<span style="color: rgb(0, 0, 128);"><strong><span style="font-size: 26px;"><span style="font-family: ''Times New Roman'';">PHƯƠNG PH&Aacute;P Đ&Agrave;O TẠO GI&Aacute;O VI&Ecirc;N TRUNG HỌC CƠ SỞ&rdquo;</span></span></strong></span></p>\r\n<div>\r\n	&nbsp;</div>\r\n<div style="text-align: justify;">\r\n	<span style="font-size: 16px;"><span style="font-family: Arial;">&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; Theo Nghị quyết số 29-NQ/TW tại Hội nghị lần thứ 8, Ban Chấp h&agrave;nh Trung ương kh&oacute;a XI về Đổi mới căn bản, to&agrave;n diện gi&aacute;o dục v&agrave; đ&agrave;o tạo; trong đ&oacute; nội dung chương tr&igrave;nh v&agrave; phương ph&aacute;p đ&agrave;o tạo gi&aacute;o vi&ecirc;n THCS tại c&aacute;c trường Sư phạm cũng phải được đổi mới. Nhằm phổ biến nội dung tr&ecirc;n v&agrave; ứng dụng hiệu quả v&agrave;o thực tiễn, Trường Đại học S&agrave;i G&ograve;n đ&atilde; tổ chức Hội thảo Khoa học &ldquo;Đổi mới nội dung chương tr&igrave;nh v&agrave; phương ph&aacute;p đ&agrave;o tạo gi&aacute;o vi&ecirc;n Trung học cơ sở&rdquo; v&agrave;o s&aacute;ng ng&agrave;y 29/8/2014 tại cơ sở của trường tr&ecirc;n đường Ng&ocirc; Thời Nhiệm, quận 3.</span></span></div>\r\n<div style="text-align: justify;">\r\n	&nbsp;</div>\r\n<div style="text-align: justify;">\r\n	<span style="font-family: Arial; font-size: 16px;">&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;</span><span style="font-family: Arial; font-size: 16px;">&nbsp;</span><span style="font-size: 16px;"><span style="font-family: Arial;">Hội thảo thu h&uacute;t sự quan t&acirc;m của nhiều nh&agrave; khoa học; c&aacute;c c&aacute;n bộ c&ocirc;ng t&aacute;c trong ng&agrave;nh gi&aacute;o dục v&agrave; nhận được số lượng lớn c&aacute;c b&agrave;i tham luận gửi về tham gia Hội thảo. Kh&aacute;ch mời tham dự gồm: ThS. Phạm Ngọc Thanh, Ph&oacute; Gi&aacute;m đốc Sở Gi&aacute;o dục &amp; Đ&agrave;o tạo TP.HCM; &Ocirc;ng Phạm Văn H&ugrave;ng, Trưởng ph&ograve;ng Gi&aacute;o dục Trung học, Sở Gi&aacute;o dục &amp; Đ&agrave;o tạo TP.HCM; &Ocirc;ng Lưu Đức Tiến, Ph&oacute; Trưởng ph&ograve;ng Gi&aacute;o dục chuy&ecirc;n nghiệp v&agrave; Đại học, Sở Gi&aacute;o dục &amp; Đ&agrave;o tạo TP.HCM; l&atilde;nh đạo một số ph&ograve;ng Gi&aacute;o dục của c&aacute;c quận, huyện tr&ecirc;n địa b&agrave;n TP.HCM; l&atilde;nh đạo một số Trường THCS tr&ecirc;n địa b&agrave;n TP.HCM; đại diện Đ&agrave;i truyền h&igrave;nh TP.HCM; đại diện B&aacute;o Gi&aacute;o dục &amp; Thời đại; đại diện B&aacute;o Gi&aacute;o dục TP.HCM; c&aacute;c t&aacute;c giả c&oacute; b&agrave;i viết. Về ph&iacute;a Trường Đại học S&agrave;i G&ograve;n c&oacute;: PGS.TS. Nguyễn Viết Ngoạn, Hiệu trưởng nh&agrave; trường; PGS.TS. Phạm Ho&agrave;ng Qu&acirc;n, Ph&oacute; Hiệu trưởng; l&atilde;nh đạo một số Ph&ograve;ng, Ban v&agrave; c&aacute;c Trưởng, Ph&oacute; khoa c&oacute; đ&agrave;o tạo Sư phạm trong Trường.</span></span></div>\r\n<div style="text-align: justify;">\r\n	&nbsp;</div>\r\n<div style="text-align: justify;">\r\n	<span style="font-family: Arial; font-size: 16px;">&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;</span><span style="font-family: Arial; font-size: 16px;">&nbsp;</span><span style="font-size: 16px;"><span style="font-family: Arial;">Ph&aacute;t biểu khai mạc Hội thảo, PGS.TS. Nguyễn Viết Ngoạn, Hiệu trưởng Trường Đại học S&agrave;i G&ograve;n mong muốn Hội thảo sẽ l&agrave; diễn đ&agrave;n của c&aacute;c nh&agrave; khoa học, c&aacute;c nh&agrave; l&agrave;m c&ocirc;ng t&aacute;c gi&aacute;o dục trao đổi về nội dung đổi mới chương tr&igrave;nh v&agrave; phương ph&aacute;p đ&agrave;o tạo gi&aacute;o vi&ecirc;n THCS, qua đ&oacute; g&oacute;p phần đổi mới v&agrave; n&acirc;ng cao chất lượng gi&aacute;o dục &ndash; đ&agrave;o tạo.</span></span></div>\r\n<div style="text-align: justify;">\r\n	&nbsp;</div>\r\n<div style="text-align: justify;">\r\n	<span style="font-family: Arial; font-size: 16px;">&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;</span><span style="font-family: Arial; font-size: 16px;">&nbsp;</span><span style="font-size: 16px;"><span style="font-family: Arial;">Tham dự Hội thảo, ThS. Phạm Ngọc Thanh, Ph&oacute; Gi&aacute;m đốc Sở Gi&aacute;o dục &amp; Đ&agrave;o tạo TP.HCM đ&atilde; gửi lời ch&uacute;c mừng v&agrave; n&ecirc;u l&ecirc;n một số &yacute; kiến g&oacute;p &yacute; cho Hội thảo.&nbsp;</span></span></div>\r\n<div style="text-align: justify;">\r\n	&nbsp;</div>\r\n<div style="text-align: justify;">\r\n	<span style="font-family: Arial; font-size: 16px;">&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;</span><span style="font-family: Arial; font-size: 16px;">&nbsp;</span><span style="font-family: Arial; font-size: 16px;">Tham gia Hội thảo, c&aacute;c nh&agrave; khoa học, c&aacute;c chuy&ecirc;n gia đến từ nhiều đơn vị trong v&agrave; ngo&agrave;i Trường Đại học S&agrave;i G&ograve;n đ&atilde; n&ecirc;u l&ecirc;n những thực trạng của gi&aacute;o dục bậc THCS n&oacute;i chung v&agrave; của gi&aacute;o vi&ecirc;n THCS ở nước ta hiện nay. Từ đ&oacute;, c&aacute;c nh&agrave; khoa học đưa ra một số đề xuất, phương hướng đổi mới từ nội dung chương tr&igrave;nh đến phương ph&aacute;p đ&agrave;o tạo gi&aacute;o vi&ecirc;n THCS. Hội thảo cũng nhận được nhiều &yacute; kiến đ&oacute;ng g&oacute;p từ c&aacute;c đại biểu tham dự với những phản hồi rất đa dạng về kiến thức chuy&ecirc;n ng&agrave;nh, kiến thức li&ecirc;n quan đến nghiệp vụ sư phạm &hellip;</span></div>\r\n<p>\r\n	&nbsp;</p>\r\n<div style="text-align: justify;">\r\n	<span style="font-family: Arial; font-size: 16px;">&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;</span><span style="font-family: Arial; font-size: 16px;">&nbsp;</span><span style="font-size: 16px;"><span style="font-family: Arial;">C&aacute;c b&agrave;i tham luận c&ugrave;ng c&aacute;c &yacute; kiến đ&oacute;ng g&oacute;p t&iacute;ch cực từ những chuy&ecirc;n gia c&oacute; kinh nghiệm v&agrave; uy t&iacute;n trong ng&agrave;nh gi&aacute;o dục đ&atilde; g&oacute;p phần l&agrave;m n&ecirc;n sự th&agrave;nh c&ocirc;ng của Hội thảo cũng như bước đầu h&igrave;nh th&agrave;nh cơ sở cho những định hướng thực tiễn theo tinh thần Nghị quyết số 29-NQ/TW.</span></span></div>\r\n<div style="text-align: justify;">\r\n	<span style="font-family: Arial; font-size: 16px;">&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;</span><span style="font-family: Arial; font-size: 16px;">&nbsp;</span></div>\r\n<div style="text-align: justify;">\r\n	<span style="font-family: Arial; font-size: 16px;">&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;</span><span style="font-family: Arial; font-size: 16px;">&nbsp;</span><em style="text-align: center;"><strong><span style="font-size: 16px;"><span style="font-family: Arial;">Sau đ&acirc;y l&agrave; một số h&igrave;nh ảnh của Hội thảo:</span></span></strong></em><span style="color: rgb(0, 0, 0);"> </span></div>\r\n<p>\r\n	&nbsp;</p>\r\n<div style="text-align: center;">\r\n	<span style="font-size: 16px;"><span style="font-family: Arial;"><img alt="" height="400" src="http://www.sgu.edu.vn/images/stories/02014/T9/05/Hoi%20thao%20THCS/image001.jpg" width="600" /></span></span></div>\r\n<p style="text-align: center;">\r\n	&nbsp;&nbsp;<span style="color: rgb(0, 0, 0);"> </span><em><span style="font-size: 16px;"><span style="font-family: Arial;">To&agrave;n cảnh Hội thảo</span></span></em><span style="color: rgb(0, 0, 0);"> </span></p>\r\n<div style="text-align: center;">\r\n	&nbsp;</div>\r\n<div style="text-align: center;">\r\n	<img alt="" height="400" src="http://www.sgu.edu.vn/images/stories/02014/T9/05/Hoi%20thao%20THCS/image003.jpg" style="font-family: Arial; font-size: 16px;" width="600" /></div>\r\n<p style="text-align: center;">\r\n	&nbsp;&nbsp;<span style="color: rgb(0, 0, 0);"> </span><em><span style="font-size: 16px;"><span style="font-family: Arial;">PGS.TS. Nguyễn Viết Ngoạn, Hiệu trưởng Trường Đại học S&agrave;i G&ograve;n&nbsp;</span></span></em><span style="color: rgb(0, 0, 0);"> </span></p>\r\n<div style="text-align: center;">\r\n	<em><span style="font-size: 16px;"><span style="font-family: Arial;">ph&aacute;t biểu khai mạc Hội thảo</span></span></em><span style="color: rgb(0, 0, 0);"> </span></div>\r\n<div style="text-align: center;">\r\n	&nbsp;</div>\r\n<div style="text-align: center;">\r\n	<img alt="" height="400" src="http://www.sgu.edu.vn/images/stories/02014/T9/05/Hoi%20thao%20THCS/image005.jpg" style="font-family: Arial; font-size: 16px;" width="600" /></div>\r\n<p>\r\n	&nbsp;</p>\r\n<div style="text-align: center;">\r\n	<em><span style="font-size: 16px;"><span style="font-family: Arial;">ThS. Phạm Ngọc Thanh ph&aacute;t biểu ch&uacute;c mừng Hội thảo</span></span></em><span style="color: rgb(0, 0, 0);"> </span></div>\r\n<div style="text-align: center;">\r\n	<em><span style="font-size: 16px;"><span style="font-family: Arial;">&nbsp;</span></span></em></div>\r\n<div style="text-align: center;">\r\n	<img alt="" height="342" src="http://www.sgu.edu.vn/images/stories/02014/T9/05/Hoi%20thao%20THCS/image007.jpg" style="font-family: Arial; font-size: 16px;" width="600" /></div>\r\n<p style="text-align: center;">\r\n	&nbsp;&nbsp;<span style="color: rgb(0, 0, 0);"> </span><em><span style="font-size: 16px;"><span style="font-family: Arial;">Đo&agrave;n Chủ tịch v&agrave; Ban Thư k&iacute; Hội thảo</span></span></em><span style="color: rgb(0, 0, 0);"> </span></p>\r\n<div style="text-align: center;">\r\n	&nbsp;</div>\r\n<div style="text-align: center;">\r\n	<img alt="" height="400" src="http://www.sgu.edu.vn/images/stories/02014/T9/05/Hoi%20thao%20THCS/image009.jpg" style="font-family: Arial; font-size: 16px;" width="600" /></div>\r\n<p style="text-align: center;">\r\n	<em><span style="font-size: 16px;"><span style="font-family: Arial;">NSƯT.TS. Ninh Văn B&igrave;nh, giảng vi&ecirc;n Khoa Gi&aacute;o dục, Trường Đại học S&agrave;i G&ograve;n,&nbsp;</span></span></em><span style="color: rgb(0, 0, 0);"> </span></p>\r\n<div style="text-align: center;">\r\n	<em><span style="font-size: 16px;"><span style="font-family: Arial;">nguy&ecirc;n Trưởng ph&ograve;ng Gi&aacute;o dục quận Ph&uacute; Nhuận tr&igrave;nh b&agrave;y tham luận tại Hội thảo</span></span></em><span style="color: rgb(0, 0, 0);"> </span></div>\r\n<div style="text-align: center;">\r\n	&nbsp;</div>\r\n<div style="text-align: center;">\r\n	<img alt="" height="400" src="http://www.sgu.edu.vn/images/stories/02014/T9/05/Hoi%20thao%20THCS/image011.jpg" style="font-family: Arial; font-size: 16px;" width="600" /></div>\r\n<p style="text-align: center;">\r\n	&nbsp;&nbsp;<span style="color: rgb(0, 0, 0);"> </span><em><span style="font-size: 16px;"><span style="font-family: Arial;">CN. Mạc Nguyệt Nhi, gi&aacute;o vi&ecirc;n Trường THCS Phạm Đ&igrave;nh Hổ, quận 6, TP.HCM&nbsp;</span></span></em>&nbsp;<span style="color: rgb(0, 0, 0);"> </span></p>\r\n<div style="text-align: center;">\r\n	<em><span style="font-size: 16px;"><span style="font-family: Arial;">tr&igrave;nh b&agrave;y tham luận tại Hội thảo</span></span></em><span style="color: rgb(0, 0, 0);"> </span></div>\r\n<div style="text-align: center;">\r\n	&nbsp;</div>\r\n<div style="text-align: center;">\r\n	<img alt="" height="400" src="http://www.sgu.edu.vn/images/stories/02014/T9/05/Hoi%20thao%20THCS/image013.jpg" style="font-family: Arial; font-size: 16px;" width="600" /></div>\r\n<p style="text-align: center;">\r\n	&nbsp;&nbsp;<span style="color: rgb(0, 0, 0);"> </span><em><span style="font-size: 16px;"><span style="font-family: Arial;">TS. Nguyễn Đ&ocirc;ng Hải, giảng vi&ecirc;n Khoa Vật l&iacute;, Trường Đại học Sư phạm TP.HCM&nbsp;</span></span></em><span style="color: rgb(0, 0, 0);"> </span></p>\r\n<div style="text-align: center;">\r\n	<em><span style="font-size: 16px;"><span style="font-family: Arial;">tr&igrave;nh b&agrave;y tham luận tại Hội thảo</span></span></em><span style="color: rgb(0, 0, 0);"> </span></div>\r\n<div style="text-align: center;">\r\n	&nbsp;</div>\r\n<div style="text-align: center;">\r\n	<img alt="" height="400" src="http://www.sgu.edu.vn/images/stories/02014/T9/05/Hoi%20thao%20THCS/image015.jpg" style="font-family: Arial; font-size: 16px;" width="600" /></div>\r\n<p>\r\n	&nbsp;</p>\r\n<div style="text-align: center;">\r\n	<em><span style="font-size: 16px;"><span style="font-family: Arial;">TS. Trần Thị Thanh V&acirc;n, giảng vi&ecirc;n Khoa Sư phạm Khoa học X&atilde; hội,&nbsp;</span></span></em><span style="color: rgb(0, 0, 0);"> </span></div>\r\n<div style="text-align: center;">\r\n	<em><span style="font-size: 16px;"><span style="font-family: Arial;">Trường Đại học S&agrave;i G&ograve;n tr&igrave;nh b&agrave;y tham luận tại Hội thảo</span></span></em><span style="color: rgb(0, 0, 0);"> </span></div>\r\n<p>\r\n	&nbsp;</p>\r\n<div style="text-align: center;">\r\n	<img alt="" height="400" src="http://www.sgu.edu.vn/images/stories/02014/T9/05/Hoi%20thao%20THCS/image017.jpg" style="font-family: Arial; font-size: 16px;" width="600" /></div>\r\n<div style="text-align: center;">\r\n	&nbsp;</div>\r\n<div style="text-align: center;">\r\n	<img alt="" height="400" src="http://www.sgu.edu.vn/images/stories/02014/T9/05/Hoi%20thao%20THCS/image019.jpg" style="font-size: 16px; font-family: Arial;" width="600" /></div>\r\n<div style="text-align: center;">\r\n	&nbsp;</div>\r\n<div style="text-align: center;">\r\n	<img alt="" height="400" src="http://www.sgu.edu.vn/images/stories/02014/T9/05/Hoi%20thao%20THCS/image021.jpg" style="font-size: 16px; font-family: Arial;" width="600" /></div>\r\n<div style="text-align: center;">\r\n	&nbsp;</div>\r\n<div style="text-align: center;">\r\n	<img alt="" height="400" src="http://www.sgu.edu.vn/images/stories/02014/T9/05/Hoi%20thao%20THCS/image023.jpg" style="font-size: 16px; font-family: Arial;" width="600" /></div>\r\n<div style="text-align: center;">\r\n	&nbsp;</div>\r\n<div style="text-align: center;">\r\n	<img alt="" height="400" src="http://www.sgu.edu.vn/images/stories/02014/T9/05/Hoi%20thao%20THCS/image025.jpg" style="font-size: 16px; font-family: Arial;" width="600" /></div>\r\n<div style="text-align: center;">\r\n	&nbsp;</div>\r\n<div style="text-align: center;">\r\n	<img alt="" height="400" src="http://www.sgu.edu.vn/images/stories/02014/T9/05/Hoi%20thao%20THCS/image027.jpg" style="font-size: 16px; font-family: Arial;" width="600" /></div>\r\n<p style="text-align: center;">\r\n	&nbsp;&nbsp;<span style="color: rgb(0, 0, 0);"> </span><em><span style="font-size: 16px;"><span style="font-family: Arial;">C&aacute;c nh&agrave; khoa học trao đổi &yacute; kiến tại Hội thảo</span></span></em><span style="color: rgb(0, 0, 0);"> </span></p>\r\n', 'Trường Đại học Sài Gòn', 1);

-- --------------------------------------------------------

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
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=25 ;

--
-- Dumping data for table `ho_so`
--

INSERT INTO `ho_so` (`id`, `ten`, `ten_file`, `trang_thai`, `ma_loai`, `search`) VALUES
(8, 'Quy trình xin đi dự Hội nghị / Hội thảo', '1428548999_quy-trinh-di-du-hnht.docx', 1, 3, 1),
(9, 'Đơn xin đi dự Hội nghị / Hội thảo', '1431589942_1428549007_don-xin-di-du-hnht.doc', 1, 3, 1),
(10, 'Lý lịch Khoa học của Tiến sĩ', '1421214229_ly-lich-khoa-hoc-cua-tien-si.doc', 1, 4, 1),
(11, 'Lý lịch Khoa học', '1428549124_ly-lich-khoa-hoc.doc', 1, 4, 1),
(12, 'Thông tin Khoa học cá nhân', '1428549133_mau-thong-tin-khoa-hoc-ca-nhan.doc', 1, 4, 1),
(13, 'Quy trình đi học Cao học', '1428548273_quy-trinh-di-hoc-cao-hoc.docx', 1, 1, 1),
(14, 'Đơn xin đi thi Cao học', '1428548307_don-xin-di-thi-cao-hoc.doc', 1, 1, 1),
(15, 'Đơn xin đi học Cao học', '1428548322_don-xin-di-hoc-cao-hoc.doc', 1, 1, 1),
(16, 'Bản cam kết dành cho học viên Cao học', '1428548333_ban-cam-ket-di-hoc.doc', 1, 1, 1),
(17, 'Đơn xin đi học theo đợt đối với học viên Cao học', '1428548345_don-xin-di-hoc-theo-dot.doc', 1, 1, 1),
(18, 'Đơn xin đi bảo vệ luận văn Thạc sĩ', '1428548360_don-xin-bao-ve-luan-van-thac-si.doc', 1, 1, 1),
(19, 'Quy trình đi học Nghiên cứu sinh', '1428548810_quy-trinh-di-hoc-ncs.docx', 1, 2, 1),
(20, 'Đơn xin dự tuyển Nghiên cứu sinh', '1428548823_don-xin-du-tuyen-ncs.doc', 1, 2, 1),
(21, 'Đơn xin đi học Nghiên cứu sinh', '1428548836_don-xin-di-hoc-ncs.doc', 1, 2, 1),
(22, 'Bản cam kết dành cho Nghiên cứu sinh', '1428548850_ban-cam-ket-di-hoc-ncs.doc', 1, 2, 1),
(23, 'Đơn xin đi học tập trung theo đợt đối với Nghiên cứu sinh', '1428548879_don-xin-di-hoc-theo-dot.doc', 1, 2, 1),
(24, 'Đơn xin đi bảo vệ luận án Tiến sĩ', '1428548894_don-xin-bao-ve-luan-an-tien-si.doc', 1, 2, 1);

-- --------------------------------------------------------

--
-- Table structure for table `lich_bieu`
--

CREATE TABLE IF NOT EXISTS `lich_bieu` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `ten` varchar(200) COLLATE utf8_unicode_ci NOT NULL,
  `ten_file` varchar(200) COLLATE utf8_unicode_ci NOT NULL,
  `trang_thai` tinyint(4) NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `lich_cong_tac`
--

CREATE TABLE IF NOT EXISTS `lich_cong_tac` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `tuan` tinyint(4) NOT NULL,
  `thang` tinyint(4) NOT NULL,
  `ngay_bat_dau` date NOT NULL,
  `ngay_ket_thuc` date NOT NULL,
  `ghi_chu` text COLLATE utf8_unicode_ci,
  `trang_thai` tinyint(4) NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=11 ;

--
-- Dumping data for table `lich_cong_tac`
--

INSERT INTO `lich_cong_tac` (`id`, `tuan`, `thang`, `ngay_bat_dau`, `ngay_ket_thuc`, `ghi_chu`, `trang_thai`) VALUES
(1, 3, 10, '2014-10-13', '2014-10-19', '', 1),
(2, 4, 10, '2014-10-20', '2014-10-26', '', 1),
(3, 5, 10, '2014-10-27', '2014-11-02', '', 1),
(4, 1, 11, '2014-11-03', '2014-11-09', '', 1),
(5, 2, 11, '2014-11-10', '2014-11-16', '', 1),
(6, 3, 11, '2014-11-17', '2014-11-23', '', 1),
(7, 4, 12, '2014-12-22', '2014-12-28', '', 1),
(8, 1, 1, '2014-12-29', '2015-01-04', '', 1),
(9, 3, 1, '2015-01-12', '2015-01-18', '', 1),
(10, 5, 1, '2015-01-26', '2015-02-01', '', 1);

-- --------------------------------------------------------

--
-- Table structure for table `lich_hoc`
--

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
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `lich_thi`
--

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
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `lien_ket`
--

CREATE TABLE IF NOT EXISTS `lien_ket` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `ten` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `url` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `ten_file` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `is_sgu` tinyint(1) NOT NULL DEFAULT '1',
  `order` int(4) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=63 ;

--
-- Dumping data for table `lien_ket`
--

INSERT INTO `lien_ket` (`id`, `ten`, `url`, `ten_file`, `is_sgu`, `order`) VALUES
(1, 'Trường Đại học Sài Gòn', 'http://sgu.edu.vn', NULL, 1, 1),
(17, 'Phòng Đào tạo', 'http://daotao.sgu.edu.vn/', NULL, 1, 2),
(18, 'Phòng Kế hoạch - Tài chính', 'http://www.sgu.edu.vn/index.php?option=com_content&view=category&layout=blog&id=42&Itemid=69', NULL, 1, 3),
(19, 'Văn phòng Trường Đại học Sài Gòn', 'http://vanphong.sgu.edu.vn/', NULL, 1, 4),
(20, 'Phòng Tổ chức Cán bộ', 'http://tccb.sgu.edu.vn/', NULL, 1, 5),
(21, 'Phòng Công tác Học sinh - Sinh viên', 'http://cthssv.sgu.edu.vn/', NULL, 1, 6),
(22, 'Phòng Thiết bị - Phương tiện dạy học', 'http://www.sgu.edu.vn/index.php?option=com_content&view=article&id=59&Itemid=72', NULL, 1, 7),
(23, 'Phòng Đào tạo Tại chức và Tu nghiệp giáo viên', 'http://www.sgu.edu.vn/index.php?option=com_content&view=article&id=61&Itemid=74', NULL, 1, 8),
(24, 'Phòng Khảo thí và Đảm bảo chất lượng giáo dục', 'http://www.sgu.edu.vn/index.php?option=com_content&view=article&id=62&Itemid=127', NULL, 1, 9),
(25, 'Phòng Quan hệ Doanh nghiệp', 'http://qhdn.sgu.edu.vn/', NULL, 1, 10),
(26, 'Phòng Thanh tra', 'http://www.sgu.edu.vn/index.php?option=com_content&view=article&id=63&Itemid=76', NULL, 1, 11),
(27, 'Phòng Hợp tác Quốc tế', 'http://www.sgu.edu.vn/index.php?option=com_content&view=article&id=1849&Itemid=639', NULL, 1, 12),
(28, 'Ban Hạ tầng và Xây dựng Cơ bản', 'http://www.sgu.edu.vn/index.php?option=com_content&view=article&id=420&Itemid=128', NULL, 1, 13),
(29, 'Khoa Sư phạm KHTN', 'http://www.sgu.edu.vn/index.php?option=com_content&view=article&id=68&Itemid=79', NULL, 1, 14),
(30, 'Khoa Toán - Ứng dụng', 'http://fma.sgu.edu.vn/', NULL, 1, 15),
(31, 'Khoa Sư phạm KHXH', 'http://ssf.sgu.edu.vn/', NULL, 1, 16),
(32, 'Khoa Giáo dục Tiểu học', 'http://www.sgu.edu.vn/index.php?option=com_content&view=article&id=154&Itemid=86', NULL, 1, 17),
(33, 'Khoa Giáo dục Mầm non', 'http://www.sgu.edu.vn/index.php?option=com_content&view=article&id=169&Itemid=87', NULL, 1, 18),
(34, 'Khoa sư phạm Kỹ thuật', 'http://www.sgu.edu.vn/index.php?option=com_content&view=article&id=259&Itemid=88', NULL, 1, 19),
(35, 'Khoa Ngoại ngữ', 'http://www.sgu.edu.vn/index.php?option=com_content&view=article&id=199&Itemid=89', NULL, 1, 20),
(36, 'Khoa Mỹ thuật', 'http://mythuat.sgu.edu.vn/', NULL, 1, 21),
(37, 'Khoa Nghệ thuật', 'http://nghethuat.sgu.edu.vn/', NULL, 1, 22),
(38, 'Khoa Công nghệ Thông tin', 'http://fit.sgu.edu.vn/drupal/', NULL, 1, 23),
(39, 'Khoa Quản trị Kinh doanh', 'http://www.sgu.edu.vn/index.php?option=com_content&view=article&id=214&Itemid=91', NULL, 1, 24),
(40, 'Khoa Thư viện - Văn phòng', 'http://tvvp.sgu.edu.vn/', NULL, 1, 25),
(41, 'Khoa Văn hoá Du lịch', 'http://www.sgu.edu.vn/index.php?option=com_content&view=article&id=244&Itemid=93', NULL, 1, 26),
(42, 'Khoa Tài chính - Kế toán', 'http://faf.sgu.edu.vn/', NULL, 1, 27),
(43, 'Khoa Khoa học Môi trường', 'http://www.fes-sgu.edu.vn/', NULL, 1, 28),
(44, 'Khoa Giáo dục', 'http://qlgd.sgu.edu.vn/', NULL, 1, 29),
(45, 'Khoa Giáo dục Chính trị', 'http://gdct.sgu.edu.vn/', NULL, 1, 30),
(46, 'Khoa Luật', 'http://www.sgu.edu.vn/index.php?option=com_content&view=article&id=842&Itemid=503', NULL, 1, 31),
(47, 'Khoa Điện tử Viễn thông', 'http://www.sgu.edu.vn/index.php?option=com_content&view=article&id=1735&Itemid=621', NULL, 1, 32),
(48, 'Bộ môn Giáo dục Quốc phòng - An ninh và Giáo dục Thể chất', 'http://www.sgu.edu.vn/index.php?option=com_content&view=article&id=463&Itemid=432', NULL, 1, 33),
(49, 'Trung tâm Tin học', 'http://itcenter.sgu.edu.vn/', NULL, 1, 34),
(50, 'Trung tâm Học liệu', 'http://lib.sgu.edu.vn/', NULL, 1, 35),
(51, 'Trung tâm Ngoại ngữ', 'http://www.sgu.edu.vn/index.php?option=com_content&view=article&id=2028&Itemid=84', NULL, 1, 36),
(52, 'Trung tâm Mỹ thuật - Ứng dụng', 'http://www.sgu.edu.vn/index.php?option=com_content&view=article&id=1884&Itemid=640', NULL, 1, 37),
(53, 'Trung tâm Thông tin Truyền thông và Phát triển Giáo dục', 'http://ttptgiaoduc.sgu.edu.vn/', NULL, 1, 38),
(54, 'Trung tâm Kỹ thuật Tài nguyên Môi trường', 'http://cer-sgu.edu.vn/', NULL, 1, 39),
(55, 'Trung tâm Dịch vụ Du lịch', 'http://dulich.sgu.edu.vn/', NULL, 1, 40),
(56, 'Trường Trung học Thực hành Sài Gòn', 'http://thuchanhsaigon.edu.vn/', NULL, 1, 41),
(57, 'Bộ Khoa học và Công nghệ', 'http://www.most.gov.vn/', '1412671100_bo-khoa-hoc-va-cong-nghe.png', 0, 42),
(58, 'Sở Khoa học Công nghệ TP.HCM', 'http://www.dost.hochiminhcity.gov.vn/default.aspx', '1412671146_so-khcn-tp-hcm.jpg', 0, 43),
(59, 'Viện Công nghệ - Bộ Công thương', 'http://www.viencongnghe.com.vn/', '1412671230_logo1.jpg', 0, 44),
(60, 'Viện Hàn lâm Khoa học và Công nghệ Việt Nam', 'http://www.vast.ac.vn', '1412671302_banner_vienkhoahoc.jpg', 0, 45),
(61, 'Liên hiệp các Hội Khoa học và Kỹ thuật Việt Nam', 'http://www.vusta.vn', '1412671380_ccmthdtvpbvgd.jpg', 0, 46),
(62, 'Viện Công nghệ Hà Nội', 'http://www.hit.edu.vn/', '1412671428_logoviencongnghehn.jpg', 0, 47);

-- --------------------------------------------------------

--
-- Table structure for table `linh_vuc`
--

CREATE TABLE IF NOT EXISTS `linh_vuc` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `ma` varchar(10) COLLATE utf8_unicode_ci NOT NULL,
  `ten` varchar(200) COLLATE utf8_unicode_ci NOT NULL,
  `mo_ta` text CHARACTER SET utf8,
  `ma_loai` int(11) unsigned DEFAULT '0',
  PRIMARY KEY (`id`),
  UNIQUE KEY `ma_linh_vuc` (`ma`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=11 ;

--
-- Dumping data for table `linh_vuc`
--

INSERT INTO `linh_vuc` (`id`, `ma`, `ten`, `mo_ta`, `ma_loai`) VALUES
(1, 'KHGD', 'Khoa học Giáo dục', '', 1),
(2, 'KHKT', 'Khoa học Kinh tế', '', 1),
(4, 'KHXH', 'Khoa học Xã hội', '', 1),
(5, 'BSGT', 'Biên soạn Giáo trình', '', 2),
(6, 'KHTN', 'Khoa học Tự nhiên', '', 1),
(7, 'KHKTh', 'Khoa học Kỹ thuật', '', 1),
(8, 'LVK', 'VH - DL, Chính trị, Luật, TV - TT', '', 1),
(9, 'KHMT', 'Khoa học Môi trường', '', 1),
(10, 'BSTL', 'Biên soạn Tài liệu tham khảo', '', 3);

-- --------------------------------------------------------

--
-- Table structure for table `loai_bieu_mau`
--

CREATE TABLE IF NOT EXISTS `loai_bieu_mau` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `ten` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `ghi_chu` text,
  `order` int(11) unsigned DEFAULT '0',
  `parent_id` int(11) NOT NULL DEFAULT '0',
  `is_dtsdh` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=12 ;

--
-- Dumping data for table `loai_bieu_mau`
--

INSERT INTO `loai_bieu_mau` (`id`, `ten`, `ghi_chu`, `order`, `parent_id`, `is_dtsdh`) VALUES
(1, 'Nghiên cứu khoa học', '', 1, 0, 0),
(2, 'Đào tạo sau đại học', '', 2, 0, 1),
(4, 'Đăng ký - Xét duyệt', '', 1, 1, 0),
(5, 'Nghiệm thu', '', 2, 1, 0),
(7, 'Đề tài nghiên cứu khoa học', '', 1, 4, 0),
(8, 'Giáo trình', '', 2, 4, 0),
(9, 'Đề tài NCKH', '', 0, 5, 0),
(10, 'Giáo trình', '', 0, 5, 0),
(11, 'Nghiên cứu Khoa học Sinh viên', '', 0, 1, 0);

-- --------------------------------------------------------

--
-- Table structure for table `loai_dao_tao`
--

CREATE TABLE IF NOT EXISTS `loai_dao_tao` (
  `loai_dao_tao_id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `ten` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `ghi_chu` text,
  PRIMARY KEY (`loai_dao_tao_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `loai_dao_tao`
--

INSERT INTO `loai_dao_tao` (`loai_dao_tao_id`, `ten`, `ghi_chu`) VALUES
(1, 'Hệ cao học hợp tác Đại Học Vinh', NULL),
(2, 'Hệ cao học Đại học Sài Gòn', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `loai_de_tai`
--

CREATE TABLE IF NOT EXISTS `loai_de_tai` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `ma` varchar(10) COLLATE utf8_unicode_ci NOT NULL,
  `ten` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `ghi_chu` text COLLATE utf8_unicode_ci,
  PRIMARY KEY (`id`),
  UNIQUE KEY `ma` (`ma`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=4 ;

--
-- Dumping data for table `loai_de_tai`
--

INSERT INTO `loai_de_tai` (`id`, `ma`, `ten`, `ghi_chu`) VALUES
(1, 'Unknown', '', NULL),
(2, 'DH', 'Đặt Hàng', NULL),
(3, 'TD', 'Trọng Điểm', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `loai_gop_y`
--

CREATE TABLE IF NOT EXISTS `loai_gop_y` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `ten` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `ghi_chu` text,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=4 ;

--
-- Dumping data for table `loai_gop_y`
--

INSERT INTO `loai_gop_y` (`id`, `ten`, `ghi_chu`) VALUES
(1, 'Góp ý', ''),
(2, 'Thắc mắc', ''),
(3, 'Báo lỗi', '');

-- --------------------------------------------------------

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
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=5 ;

--
-- Dumping data for table `loai_ho_so`
--

INSERT INTO `loai_ho_so` (`id`, `ten`, `ghi_chu`, `order`, `parent_id`) VALUES
(1, 'Hồ sơ đi học Cao học', '', 1, 0),
(2, 'Hồ sơ đi học Nghiên cứu sinh', '', 2, 0),
(3, 'Hồ sơ xin đi dự Hội nghị / Hội thảo', '', 0, 0),
(4, 'Lý lịch Khoa học', '', 3, 0);

-- --------------------------------------------------------

--
-- Table structure for table `loai_linh_vuc`
--

CREATE TABLE IF NOT EXISTS `loai_linh_vuc` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `ma` varchar(10) NOT NULL,
  `ten` varchar(255) DEFAULT NULL,
  `ds_linh_vuc` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=5 ;

--
-- Dumping data for table `loai_linh_vuc`
--

INSERT INTO `loai_linh_vuc` (`id`, `name`, `ma`, `ten`, `ds_linh_vuc`) VALUES
(1, 'co-so', 'CS', 'Nghiên Cứu Khoa Học', NULL),
(2, 'giao-trinh', 'GT', 'Giáo Trình', NULL),
(3, 'tai-lieu', 'TL', 'Tài Liệu', NULL),
(4, 'bai-giang', 'BG', 'Bài Giảng', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `loai_thong_bao`
--

CREATE TABLE IF NOT EXISTS `loai_thong_bao` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `ten` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `ghi_chu` text,
  `order` int(11) unsigned DEFAULT '0',
  `parent_id` int(11) NOT NULL DEFAULT '0',
  `he_cao_hoc` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=7 ;

--
-- Dumping data for table `loai_thong_bao`
--

INSERT INTO `loai_thong_bao` (`id`, `ten`, `ghi_chu`, `order`, `parent_id`, `he_cao_hoc`) VALUES
(1, 'Nghiên cứu khoa học', '', 1, 0, 0),
(2, 'Hội nghị - Hội thảo', '', 2, 0, 0),
(3, 'Đào tạo sau Đại học', '', 3, 0, 0),
(5, 'Hệ cao học Đại học Sài Gòn', '', 5, 0, 1),
(6, 'Hệ cao học liên kết Đại học Vinh', '', 6, 0, 1);

-- --------------------------------------------------------

--
-- Table structure for table `mail_thong_bao`
--

CREATE TABLE IF NOT EXISTS `mail_thong_bao` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `tieu_de` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `noi_dung` text COLLATE utf8_unicode_ci NOT NULL,
  `loai` tinyint(4) NOT NULL,
  `noi_nhan` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `ngay_goi` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=2 ;

--
-- Dumping data for table `mail_thong_bao`
--

INSERT INTO `mail_thong_bao` (`id`, `tieu_de`, `noi_dung`, `loai`, `noi_nhan`, `ngay_goi`) VALUES
(1, 'Thông báo lịch duyệt đề cương NCKH năm 2012-2013', '<p>\r\n	<span style="font-size:16px;">Chuẩn bị <strong><span style="color:#ff0000;">duyệt</span></strong> ,h&atilde;y chuẩn bị.</span><span style="font-size:20px;">&frac34;</span></p>\r\n', 1, '24', '2012-06-07 01:09:37');

-- --------------------------------------------------------

--
-- Table structure for table `modules`
--

CREATE TABLE IF NOT EXISTS `modules` (
  `name` varchar(64) COLLATE utf8_unicode_ci NOT NULL,
  `title` varchar(64) COLLATE utf8_unicode_ci NOT NULL,
  `description` text COLLATE utf8_unicode_ci,
  `version` varchar(32) COLLATE utf8_unicode_ci NOT NULL,
  `enabled` tinyint(1) NOT NULL DEFAULT '0',
  `type` enum('core','standard','extra') COLLATE utf8_unicode_ci NOT NULL DEFAULT 'extra',
  PRIMARY KEY (`name`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `modules`
--

INSERT INTO `modules` (`name`, `title`, `description`, `version`, `enabled`, `type`) VALUES
('admin', 'Admin', 'Admin - The Alpha and the Omega.', '4.00', 1, 'core'),
('default', 'Default', 'The Alpha and the Omega.', '4.00', 1, 'core');

-- --------------------------------------------------------

--
-- Table structure for table `mon_chuyen_nganh`
--

CREATE TABLE IF NOT EXISTS `mon_chuyen_nganh` (
  `mon_chuyen_nganh_id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `chuyen_nganh_id` int(11) NOT NULL,
  `ten` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`mon_chuyen_nganh_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `nguoi_dung`
--

CREATE TABLE IF NOT EXISTS `nguoi_dung` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `ten_dang_nhap` varchar(32) COLLATE utf8_unicode_ci NOT NULL,
  `ma_quyen` tinyint(4) NOT NULL DEFAULT '4',
  `giang_vien_id` int(11) unsigned NOT NULL DEFAULT '0',
  `mat_khau` char(100) COLLATE utf8_unicode_ci NOT NULL,
  `salt` char(64) COLLATE utf8_unicode_ci NOT NULL,
  `ho` varchar(128) COLLATE utf8_unicode_ci NOT NULL,
  `ten` varchar(32) COLLATE utf8_unicode_ci NOT NULL,
  `ten_hien_thi` varchar(160) COLLATE utf8_unicode_ci NOT NULL,
  `ngay_sinh` date DEFAULT NULL,
  `email` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `ngay_tao` datetime NOT NULL,
  `enabled` tinyint(4) NOT NULL DEFAULT '1',
  `verified` tinyint(4) NOT NULL DEFAULT '1',
  `approved` tinyint(4) NOT NULL DEFAULT '1',
  `lan_dang_nhap_cuoi` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `ten_dang_nhap` (`ten_dang_nhap`),
  UNIQUE KEY `email` (`email`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=32 ;

--
-- Dumping data for table `nguoi_dung`
--

INSERT INTO `nguoi_dung` (`id`, `ten_dang_nhap`, `ma_quyen`, `giang_vien_id`, `mat_khau`, `salt`, `ho`, `ten`, `ten_hien_thi`, `ngay_sinh`, `email`, `ngay_tao`, `enabled`, `verified`, `approved`, `lan_dang_nhap_cuoi`) VALUES
(1, 'admin', 1, 0, 'b24331b1a138cde62aa1f679164fc62f', '', 'Phong Khoa hoc Cong nghe', '', 'Phong Khoa hoc Cong nghe', '2000-01-01', 'p_khcn@sgu.edu.vn', '2012-03-02 00:00:00', 1, 1, 1, '2015-09-20 14:22:22'),
(2, 'nhochong', 3, 0, 'e10adc3949ba59abbe56e057f20f883e', '', 'Nguyen', 'Hung', 'Nguyen Hung', '1990-08-23', 'hungnguyen2308@yahoo.com', '2014-05-25 01:30:32', 1, 1, 1, '2014-07-20 06:00:12'),
(3, 'tandatlucky86', 4, 0, 'ed75cad41cf319223285de049be67e16', '', 'Hồ', 'Tấn Đạt', 'Hồ Tấn Đạt', '1986-02-26', 'tandatlucky86@gmail.com', '2014-10-22 15:48:21', 1, 1, 1, '2014-10-22 15:48:21'),
(4, 'thienhuynh', 4, 0, '8e6594d92b0d1995dd1ccd32a4eff644', '', 'Huynh', 'leminhThien', 'Huynh leminhThien', '1979-10-05', 'thien.hlm@cb.sgu.edu.vn', '2014-10-25 10:31:27', 1, 1, 1, '2014-11-03 10:43:05'),
(5, 'abc', 4, 0, '900150983cd24fb0d6963f7d28e17f72', '', 'abc', 'abc', 'abc abc', '1997-11-13', 'nguyenchithanhit@gmail.com', '2014-11-14 09:32:58', 1, 1, 1, '2014-11-14 09:32:58'),
(6, 'nguyenhuong', 4, 0, '205b74f32e4d3e555bb7d808be70404f', '', 'Nguyen Thi Huong', 'Huong', 'Nguyen Thi Huong Huong', '1981-09-14', 'hoaxuongrong1340@yahoo.com', '2014-11-24 04:20:11', 1, 1, 1, '2014-11-24 04:21:50'),
(7, 'quoctrunghh', 4, 0, '51c4d610bd07ef6ef2bd75c65fa57942', '', 'Bùi Quốc', 'Trung', 'Bùi Quốc Trung', '1981-03-02', 'quoctrunghh@gmail.com', '2014-12-06 12:40:25', 1, 1, 1, '2014-12-10 13:37:50'),
(8, 'anhanhanh', 4, 0, 'df18caac702f6bc9a17aa765c75ca615', '', 'thanh', 'anh', 'thanh anh', '1970-01-01', 'kimthanh8788@gmail.com', '2015-01-09 15:39:47', 1, 1, 1, '2015-01-09 15:39:47'),
(9, 'htp94', 4, 0, 'c7b2f4fddae6e2bd1990821b4b5fbefe', '', 'Huỳnh Thiệu', 'Phong', 'Huỳnh Thiệu Phong', '1970-01-01', 'ht.phong.94.sgu@gmail.com', '2015-02-18 13:58:12', 1, 1, 1, '2015-02-18 13:58:12'),
(10, '22601401607', 4, 0, '77f3436fb998fa61f28747697cdef508', '', 'Tăng', 'Thanh Mai', 'Tăng Thanh Mai', '1980-03-11', 'thanhmai.bupbe@gmail.com', '2015-03-01 07:22:10', 1, 1, 1, '2015-03-01 07:25:33'),
(11, '0908972020', 4, 0, '9076df81a86705f9a3842945d09ef866', '', 'nguyễn', 'Thùy', 'nguyễn Thùy', '1982-04-02', 'gvminhthuy@gmail.com', '2015-03-06 13:58:48', 1, 1, 1, '2015-03-06 13:58:48'),
(12, 'builenhuttai', 4, 0, 'b709070585ae97487b7bb42999b89463', '', 'Bùi Lê', 'Nhựt Tài', 'Bùi Lê Nhựt Tài', '1997-11-10', 'nhuttai.bui@gmail.com', '2015-03-12 09:27:23', 1, 1, 1, '2015-03-12 09:27:23'),
(13, 'dinhhien', 4, 0, '2aba0290a71df2273a75f1b2cb1de41f', '', 'TA', 'DINH HIEN', 'TA DINH HIEN', '1985-03-18', 'dhienvol@gmail.com', '2015-03-23 05:09:12', 1, 1, 1, '2015-03-23 05:09:12'),
(14, 'thuytien', 4, 0, '613aa2dbbd903cf3f195f82bc06d5842', '', 'Lê Nguyễn', 'Thủy Tiên', 'Lê Nguyễn Thủy Tiên', '1991-11-17', 'thuytien.auco@gmail.com', '2015-03-24 05:24:10', 1, 1, 1, '2015-03-24 05:24:10'),
(15, 'minhchi1403', 4, 0, '8e6a426d92afe0d40d515f140eb60054', '', 'Tran', 'Minh Chi', 'Tran Minh Chi', '1984-06-12', 'tranminhchi.thptvh@gmail.com', '2015-03-24 09:46:25', 1, 1, 1, '2015-03-24 09:46:25'),
(16, '3113420340', 4, 0, '7c40a83a32f47bcef7b41e9a740f7912', '', 'mai', 'giao', 'mai giao', '1970-01-01', 'ngocgiao1711@gmail.com', '2015-05-03 13:46:04', 1, 1, 1, '2015-05-03 13:46:04'),
(17, 'thaihaihoan', 4, 0, '76958fabd7c68557ca3987152f757ca8', '', 'Hoàng', 'Thái', 'Hoàng Thái', '1983-10-25', 'hoangdinhthai83@gmail.com', '2015-05-05 06:43:31', 1, 1, 1, '2015-05-05 06:43:31'),
(18, 'loannguyen', 4, 0, '191c29642df875a9e692a815a658fd79', '', 'nguyen', 'loan', 'nguyen loan', '1970-01-01', 'nhatbich07@yahoo.com.vn', '2015-05-10 13:34:10', 1, 1, 1, '2015-05-10 13:34:10'),
(19, 'huunam76', 4, 0, '23444bc53be3934fdca53a564c7b507f', '', 'NGUYEN HUU', 'NAM', 'NGUYEN HUU NAM', '1976-04-30', 'huunam76@gmail.com', '2015-05-14 12:48:16', 1, 1, 1, '2015-05-25 04:14:43'),
(20, 'viettuan', 4, 0, '800e636c0a24ac3767701a789a96ba89', '', 'đinh viết', 'tuấn', 'đinh viết tuấn', '1970-01-01', 'tranhoanghaonam01@yahoo.com.vn', '2015-06-08 15:36:20', 1, 1, 1, '2015-06-08 15:36:20'),
(21, 'trannamphi', 4, 0, '866ebcd612fb9d0dca4dc718fa854f93', '', 'Trần', 'Phi', 'Trần Phi', '1981-09-02', 'phphii2007@yahoo.com.vn', '2015-06-10 06:49:27', 1, 1, 1, '2015-06-11 09:32:11'),
(22, 'daihocsaigon', 4, 0, 'e10adc3949ba59abbe56e057f20f883e', '', 'dai hoc', 'Sai Gon', 'dai hoc Sai Gon', '2015-06-22', 'dhsg@gmail.com', '2015-06-14 15:32:43', 1, 1, 1, '2015-08-19 15:27:20'),
(23, 'hoangduongminhtam', 4, 0, '25b3ba6ee9a3215d8d2d854ac7f1f8a8', '', 'Hoàng Dương', 'Minh Tâm', 'Hoàng Dương Minh Tâm', '1970-01-01', 'hoangduongminhtam@gmail.com', '2015-08-08 13:53:45', 1, 1, 1, '2015-09-14 06:27:54'),
(24, 'phamthithanhnga', 4, 0, '4fd74f76e43760312e09ff029951d8f0', '', 'thanh', 'nga', 'thanh nga', '1988-07-26', 'thanhnga990077@gmail.com', '2015-08-18 09:09:42', 1, 1, 1, '2015-08-18 09:09:42'),
(25, 'oanh', 4, 0, '3a6c965d99ee7acdc940ee5110b0232a', '', 'lê', 'oanh', 'lê oanh', '1987-06-16', 'phonglantrangcm@gmail.com', '2015-08-23 09:48:43', 1, 1, 1, '2015-08-23 09:48:43'),
(26, 'chinguyenk15', 4, 0, 'e9e954d8a1ab092fcbab8bf9b7e22a59', '', 'nguyễn', 'Chí', 'nguyễn Chí', '1994-04-24', 'chinguyenpp@yahoo.com', '2015-08-28 09:49:52', 1, 1, 1, '2015-08-28 09:49:52'),
(27, 'ngocdiem', 4, 0, '53dafc44b40d0f828e8610754785a044', '', 'phạm', 'diễm', 'phạm diễm', '1991-01-15', 'phamthingocdiem@hotec.edu.vn', '2015-09-09 08:31:01', 1, 1, 1, '2015-09-09 08:31:01'),
(28, 'xuanyen1997', 4, 0, '2bb2f1e159c9f5dbeec30d83da3fba9f', '', 'Nguyen', 'Yen', 'Nguyen Yen', '1997-08-22', 'xuanyen2081997@gmail.com', '2015-09-11 14:51:58', 1, 1, 1, '2015-09-11 14:51:58'),
(29, 'ch07151012', 4, 0, 'fbe8ca2f069f63a4d8e3d58d7638c8d0', '', 'Lê Hoàng Thủy', 'Tiên', 'Lê Hoàng Thủy Tiên', '1991-05-27', 'fairy270591@gmail.com', '2015-09-16 10:52:43', 1, 1, 1, '2015-09-16 10:52:43'),
(30, 'trungnhan137', 4, 0, 'd5603a6e6cf2ce35504e2e7906c6453e', '', 'Nguyễn', 'Nhân', 'Nguyễn Nhân', '1997-07-13', 'trungnhan137@gmail.com', '2015-09-17 16:57:49', 1, 1, 1, '2015-09-17 16:57:49'),
(31, 'lehuynhbaonhan', 4, 0, '8cc40816e0862e7cb360e317eb573bde', '', 'Lê Huỳnh Bảo', 'Nhân', 'Lê Huỳnh Bảo Nhân', '1997-01-26', 'lehuynhbaonhan@gmail.com', '2015-09-18 00:41:02', 1, 1, 1, '2015-09-18 00:41:02');

-- --------------------------------------------------------

--
-- Table structure for table `nhan_su`
--

CREATE TABLE IF NOT EXISTS `nhan_su` (
  `nhan_su_id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `ho_ten` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `chuc_vu` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `email` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `website` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `so_dien_thoai` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `ten_file` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `order` int(4) NOT NULL DEFAULT '0',
  PRIMARY KEY (`nhan_su_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=13 ;

--
-- Dumping data for table `nhan_su`
--

INSERT INTO `nhan_su` (`nhan_su_id`, `ho_ten`, `chuc_vu`, `email`, `website`, `so_dien_thoai`, `ten_file`, `order`) VALUES
(1, 'TS. Tạ Quang Sơn', 'Q. Trưởng Phòng', 'taquangson@sgu.edu.vn', '', '', '1413532617_thay-son.JPG', 1),
(3, 'ThS. Nguyễn Thị Minh Hằng', 'Phó Trưởng phòng', 'mhang@sgu.edu.vn', '', '', '1420442858_img_8176.jpg', 3),
(4, 'ThS. Lê Thị Thanh Thủy', 'Chuyên viên', 'thanhthuyle@sgu.edu.vn', '', '', NULL, 4),
(5, 'Phan Thu Hà', 'Chuyên viên', 'phanthuha1212@sgu.edu.vn', '', '', NULL, 5),
(6, 'Võ Thúy Linh', 'Chuyên viên', 'vtlinh@sgu.edu.vn', '', '', NULL, 6),
(7, 'Ngô Việt Anh', 'Chuyên viên', 'nvanh@sgu.edu.vn', '', '', NULL, 7),
(8, 'ThS. Trần Thị Hồng Nhung', 'Chuyên viên', 'trannhung@sgu.edu.vn', '', '', NULL, 8),
(9, 'Vy Đình Lộc', 'Chuyên viên', 'vydinhloc@sgu.edu.vn', '', '', NULL, 9),
(10, 'ThS. Nguyễn Văn Vẹn', 'Chuyên viên', 'vennv@sgu.edu.vn', '', '', NULL, 10),
(11, 'TS. Nguyễn Văn Huấn', 'Phó Trưởng phòng', 'nguyenvanhuan@sgu.edu.vn', '', '', '1420442880_nguyen-van-huan-2014.jpg', 2),
(12, 'Ngô Tuyết Hằng', 'Chuyên viên', 'ngotuyethang@sgu.edu.vn', '', '', NULL, 11);

-- --------------------------------------------------------

--
-- Table structure for table `noi_dung_cong_tac`
--

CREATE TABLE IF NOT EXISTS `noi_dung_cong_tac` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `ngay` date NOT NULL,
  `buoi` tinyint(4) NOT NULL DEFAULT '1',
  `noi_dung` text COLLATE utf8_unicode_ci,
  `ghi_chu` text COLLATE utf8_unicode_ci,
  `quan_trong` tinyint(1) NOT NULL DEFAULT '0',
  `ma_cong_tac` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=51 ;

--
-- Dumping data for table `noi_dung_cong_tac`
--

INSERT INTO `noi_dung_cong_tac` (`id`, `ngay`, `buoi`, `noi_dung`, `ghi_chu`, `quan_trong`, `ma_cong_tac`) VALUES
(2, '2014-10-16', 1, '07g45 (Phòng họp BGH): Làm việc với Đoàn Đại biểu Quốc hội và Hội đồng Nhân dân TP.HCM', NULL, 1, 1),
(3, '2014-10-14', 1, '08g30 (KLF): Nghiệm thu đề tài NCKH cấp trường “Áp dụng chu trình Kolb trong dạy học môn Thiên văn học Đại cương tại Trường Đại học Sài Gòn” do TS. Võ Thành Lâm làm chủ nhiệm. Mã số: CS2013-01', NULL, 0, 1),
(4, '2014-10-16', 1, '08g00 (KLF): Nghiệm thu Giáo trình "Toán rời rạc".  Chủ biên: TS. Nguyễn Hòa. Mã số: GT2013-10', NULL, 0, 1),
(5, '2014-10-17', 1, '08g30 (Phòng họp Ban Giám hiệu) : Họp Ban tổ chức Hội thảo Khoa học: “Đổi mới chương trình đào tạo ngành Giáo dục Chính trị và Giáo dục Công dân”', NULL, 1, 1),
(6, '2014-10-04', 1, '9g00 (KLF): Nghiệm thu đề tài NCKH cấp trường "Khảo sát xây dựng hệ thống kỹ năng trong đào tạo nghiệp vụ du lịch của Khoa Văn hóa - Du lịch". Chủ nhiệm đề tài: TS. Phạm Thị Thu Nga. Mã số: CS2012 - 30. ', NULL, 0, 2),
(7, '2014-10-22', 1, '09g00 (KLF): Nghiệm thu đề tài NCKH cấp trường "Khảo sát xây dựng hệ thống kỹ năng trong đào tạo nghiệp vụ du lịch của Khoa Văn hóa - Du lịch". Chủ nhiệm đề tài: TS. Phạm Thị Thu Nga. Mã số: CS2012 - 30. ', NULL, 0, 2),
(8, '2014-10-22', 2, '15g00 (KLF): Nghiệm thu đề tài NCKH cấp trường “Nghiên cứu xử lý rơm rạ trên đồng ruộng bằng một số chế phẩm sinh học” do ThS. Nguyễn Xuân Dũ làm chủ nhiệm. Mã số: CS2013-34.\r\n', NULL, 0, 2),
(9, '2014-10-24', 1, '08g30 (Phòng họp BGH): Họp Ban Tổ chức Hội thảo khoa học "Đổi mới chương trình đào tạo ngành GDCT và GDCD" ', NULL, 1, 2),
(10, '2014-10-20', 2, ' 14g00 (Phòng họp BGH): Họp giao ban mở rộng', NULL, 1, 2),
(11, '2014-10-21', 1, ' 08g00 (Hội trường A): Hội nghị CBCC năm học 2014 – 2015', NULL, 1, 2),
(12, '2014-10-29', 2, '14h00 (KLF): Nghiệm thu đề tài NCKH cấp trường “Nghiên cứu lựa chọn, sử dụng một số bài tập thể dục (với gậy, với bóng) và trò chơi vận động như một học phần tự chọn để phát triển thể lực cho sinh viên nữ Trường Đại học Sài Gòn” do ThS. Lê Kiên Giang làm chủ nhiệm; Mã số: CS2013-57', NULL, 0, 3),
(13, '2014-10-30', 1, '08h00 (HB305): Hội thảo Khoa học “Đổi mới chương trình đào tạo ngành Giáo dục chính trị và Giáo dục công dân”', NULL, 1, 3),
(14, '2014-10-30', 2, '13h00 (KLF): Nghiệm thu giáo trình “Phức chất trong Hoá vô cơ” do PGS.TS. Võ Quang Mai làm chủ biên; Mã số: GT2012-02', NULL, 0, 3),
(16, '2014-10-30', 2, '14h15 (KLF): Nghiệm thu đề tài NCKH cấp trường “Điều chế và thử hoạt tính quang xúc tác TiO2 pha tạp Gadolini” do PGS.TS. Võ Quang Mai làm chủ nhiệm; Mã số: CS2013-04\r\n', NULL, 0, 3),
(17, '2014-10-30', 2, '14h00 (Phòng họp A): Nghiệm thu đề tài NCKH cấp trường “Tìm hiểu CDIO và thí điểm triển khai xây dựng chuẩn đầu ra cho khoa Công nghệ thông tin theo cách tiếp cận CDIO” do TS. Huỳnh Minh Trí làm chủ nhiệm; Mã số: CS2013-41', NULL, 0, 3),
(18, '2014-10-30', 2, '15h00 (Phòng D101): Nghiệm thu giáo trình  “Giải tích 2” do PGS. TS. Phạm Hoàng Quân làm chủ biên; Mã số: GT2012-03 ', NULL, 0, 3),
(19, '2014-10-30', 2, '15h00 (Phòng D102): Nghiệm thu giáo trình  “Tâm lý học trẻ em 2” do TS. Nguyễn Thị Hồng Phương làm chủ biên; Mã số: GT2013-07\r\n', NULL, 0, 3),
(20, '2014-10-30', 2, '15h30 (KLF): Nghiệm thu đề tài NCKH cấp trường “Khảo sát thành phần hoá học rễ cây An điền sát Hedyotis pressa Piere et Pit, họ cà phê Rubiaceae” do TS. Phạm Nguyễn Kim Tuyến làm chủ nhiệm; Mã số: CS2013-33', NULL, 0, 3),
(22, '2014-11-04', 1, '08g00 (Hội trường A): Sinh hoạt chính trị kỷ niệm 45 năm thực hiện Di chúc Bác Hồ', NULL, 1, 4),
(23, '2014-11-04', 2, '14g00 (Hội trường A): Sinh hoạt chính trị kỷ niệm 45 năm thực hiện Di chúc Bác Hồ', NULL, 1, 4),
(24, '2014-11-07', 1, '10g00 (KLF): Hội đồng nghiệm thu tài liệu: “Phương pháp nghiên cứu khoa học Lịch sử ” do TS. Phạm Phúc Vĩnh làm chủ biên\r\nMã số: TL2013-01.', NULL, 0, 4),
(25, '2014-11-04', 1, '10g00 (KLF): Hội đồng nghiệm thu đề tài NCKH cấp trường: “Bài toán giá trị đầu cho chương trình vi phân đạo hàm riêng cấp hai tự tham chiếu” do ThS. Nguyễn Thị Thanh Lan làm chủ nhiệm Mã số: CS2013-10.', NULL, 0, 4),
(26, '2014-11-13', 1, '08g00 (KLF): Nghiệm thu giáo trình: “Kế toán Quản trị” do TS. Trần Đình Phụng làm chủ biên. Mã số: GT2013-17', NULL, 0, 5),
(27, '2014-11-13', 1, '09g30 (Phòng D001): Nghiệm thu đề tài NCKH cấp Trường: “Thực trạng sử dụng biện pháp phát triển kĩ năng quan sát cho trẻ 5-6 tuổi trong hoạt động khám phá thiên nhiên ở trường mầm non” do ThS. Lê Thị Thu Hiền làm chủ nhiệm. Mã số: CS2013-27', NULL, 0, 5),
(28, '2014-11-18', 1, '08g30 (KLF): Nghiệm thu đề tài NCKH cấp Trường: “Nghiên cứu đại số gia tử đến lập luận mờ và ứng dụng vào bài toán phân lớp các loại hoa” do ThS. Lê Ngọc Hưng làm chủ nhiệm. Mã số: CS2011-15', NULL, 0, 6),
(29, '2014-11-20', 1, '11g00 (Phòng họp B): CHÀO MỪNG NGÀY NHÀ GIÁO VIỆT NAM 20-11', NULL, 1, 6),
(30, '2014-11-22', 1, '08g00 (Phòng họp A): Bảo vệ luận văn cao học ngành Khoa học Thư viện khóa 7 (chương trình liên kết đào tạo giữa Trường Đại học Sài Gòn và Trường Đại học KHXH&NV Hà Nội).\r\n\r\nTừ ngày 22 đến ngày 24/11/2014', NULL, 1, 6),
(31, '2014-12-22', 2, '14g00 (Hội trường A): Giao lưu giữa sinh viên Trường Đại học Sài Gòn và sinh viên Trường Đại học Ngắn hạn Phúc lợi Sức khỏe Osaka Nhật Bản', NULL, 1, 7),
(32, '2014-12-23', 1, '08h00 (KLF): Nghiệm thu đề tài NCKH cấp trường “Phần mềm quản lí công văn Khoa Công nghệ Thông tin” do TS. Huỳnh Minh Trí làm chủ nhiệm.\r\nMSĐT: CS2012-18', NULL, 0, 7),
(33, '2014-12-23', 1, '08h00 (Phòng D003): Nghiệm thu đề tài NCKH cấp trường “Tìm hiểu thực trạng và giải pháp nâng cao hiệu quả dạy học thực hành Sinh học ở THPT và THCS” do ThS. Hoàng Minh Tâm làm chủ nhiệm.\r\nMSĐT: CS2012-09', NULL, 0, 7),
(34, '2014-12-23', 1, '09h30 (Phòng D003): Nghiệm thu đề tài NCKH cấp trường “Hoàn chỉnh, nâng cao chương trình thực tập nghiên cứu thiên nhiên và kĩ năng thực tế thiên nhiên cho sinh viên ngành Sư phạm Sinh học” do ThS. Hoàng Minh Tâm làm chủ nhiệm.\r\nMSĐT: CS2012-10', NULL, 0, 7),
(35, '2014-12-23', 1, '10h00 (KLF): Nghiệm thu tài liệu tham khảo “Cấu trúc dữ liệu và giải thuật” do TS. Huỳnh Minh Trí làm chủ biên.\r\nMSĐT: TL2012-05', NULL, 0, 7),
(36, '2014-12-27', 1, '07h00 (PhòngD201): Thi tuyển sinh Cao học khóa 14.2 năm 2014', NULL, 1, 7),
(38, '2014-12-28', 1, '06h00 (Phòng D201): Thi tuyển sinh Cao học khóa 14.2 năm 2014', NULL, 1, 7),
(39, '2014-12-28', 2, '13h00 (Phòng D201): Thi tuyển sinh Cao học khóa 14.2 năm 2014', NULL, 1, 7),
(40, '2014-12-27', 2, '13h00 (Phòng D201): Thi tuyển sinh Cao học khóa 14.2 năm 2014', NULL, 1, 7),
(41, '2014-12-24', 1, '08h45 (Phòng họp BGH): Họp Hội đồng tuyển sinh Cao học Khóa 14.2 năm 2014', NULL, 1, 7),
(42, '2014-12-24', 1, '10h00 (Phòng họp BGH): Họp Ban coi thi và Cán bộ coi thi tuyển sinh', NULL, 1, 7),
(43, '2014-12-29', 1, '07g30 (Phòng HB305, HB406): Họp Ban chấm thi và chấm thi tuyển sinh Cao học khóa 14.2 năm 2014', NULL, 1, 8),
(44, '2014-12-30', 1, '07g30 (Phòng HB305, HB406): Chấm thi tuyển sinh Cao học khóa 14.2 năm 2014', NULL, 1, 8),
(45, '2015-01-14', 2, '15g00 (KLF): Nghiệm thu đề tài NCKH cấp trường “Xây dựng mô hình phát triển Tạp chí Đại học Sài Gòn” do ThS. Trịnh Viết Toàn làm chủ nhiệm. Mã số: CS2013-61', NULL, 0, 9),
(46, '2015-01-18', 1, '07g30 (Hội trường A): Nhập học các lớp Cao học K14.2', NULL, 1, 9),
(47, '2015-01-18', 1, '09g00 (Hội trường A): Khai giảng các lớp Cao học K14.2', NULL, 1, 9),
(48, '2015-01-18', 1, '10g00 (Hội trường A): Cao học K14.2 học quy chế', NULL, 1, 9),
(49, '2015-01-27', 1, '09h00 (KLF): Nghiệm thu đề tài NCKH cấp trường “Kinh tế vĩ mô và Bài tập” do TS. Nguyễn Đình Luận làm chủ nhiệm. MSĐT: CS2011-57', NULL, 0, 10),
(50, '2015-01-29', 1, '08h30 (KLF): Nghiệm thu đề tài NCKH cấp trường “Xây dựng phần mềm quản lí phòng máy bằng web” do ThS. Huỳnh Thắng Được làm chủ nhiệm.  MSĐT: CS2011-17', NULL, 0, 10);

-- --------------------------------------------------------

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

INSERT INTO `permissions` (`level_id`, `type`, `name`, `value`, `params`) VALUES
(1, 'admin', 'view', 1, NULL),
(1, 'cong_thong_tin', 'view', 1, NULL),
(1, 'diem_chuyen_nganh', 'view', 1, NULL),
(1, 'giang_vien', 'create', 2, NULL),
(1, 'giang_vien', 'delete', 2, NULL),
(1, 'giang_vien', 'edit', 2, NULL),
(1, 'giang_vien', 'view', 1, NULL),
(2, 'admin', 'view', 1, NULL),
(2, 'cong_thong_tin', 'view', 1, NULL),
(2, 'diem_chuyen_nganh', 'view', 1, NULL),
(2, 'giang_vien', 'create', 2, NULL),
(2, 'giang_vien', 'delete', 2, NULL),
(2, 'giang_vien', 'edit', 2, NULL),
(2, 'giang_vien', 'view', 1, NULL),
(3, 'cong_thong_tin', 'view', 1, NULL),
(3, 'diem_chuyen_nganh', 'view', 1, NULL),
(3, 'giang_vien', 'create', 1, NULL),
(3, 'giang_vien', 'delete', 1, NULL),
(3, 'giang_vien', 'edit', 1, NULL),
(3, 'giang_vien', 'view', 1, NULL),
(4, 'giang_vien', 'create', 1, NULL),
(4, 'giang_vien', 'view', 1, NULL),
(5, 'giang_vien', 'view', 1, NULL),
(6, 'diem_chuyen_nganh', 'view', 1, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `phan_cong_duyet`
--

CREATE TABLE IF NOT EXISTS `phan_cong_duyet` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `chuc_danh` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `ma_giang_vien` int(11) NOT NULL,
  `ma_hd_duyet` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=228 ;

--
-- Dumping data for table `phan_cong_duyet`
--

INSERT INTO `phan_cong_duyet` (`id`, `chuc_danh`, `ma_giang_vien`, `ma_hd_duyet`) VALUES
(15, '0', 25, 18),
(16, '1', 16, 18),
(17, '1', 83, 18),
(18, '1', 84, 18),
(19, '1', 85, 18),
(20, '2', 86, 18),
(90, '0', 121, 15),
(91, '1', 122, 15),
(92, '1', 99, 15),
(93, '1', 114, 15),
(94, '1', 123, 15),
(95, '2', 82, 15),
(127, '0', 74, 16),
(128, '1', 75, 16),
(129, '1', 76, 16),
(130, '1', 77, 16),
(131, '1', 41, 16),
(132, '2', 78, 16),
(133, '0', 79, 17),
(134, '1', 11, 17),
(135, '1', 27, 17),
(136, '1', 77, 17),
(137, '1', 80, 17),
(138, '2', 82, 17),
(139, '0', 24, 19),
(140, '1', 87, 19),
(141, '1', 88, 19),
(142, '1', 89, 19),
(143, '1', 91, 19),
(144, '2', 92, 19),
(145, '0', 93, 20),
(146, '1', 91, 20),
(147, '1', 54, 20),
(148, '1', 96, 20),
(149, '1', 97, 20),
(150, '2', 99, 20),
(216, '0', 2, 23),
(217, '1', 12, 23),
(218, '1', 53, 23),
(219, '1', 53, 23),
(220, '1', 84, 23),
(221, '2', 2, 23),
(222, '0', 94, 22),
(223, '1', 7, 22),
(224, '1', 61, 22),
(225, '1', 10, 22),
(226, '1', 77, 22),
(227, '2', 78, 22);

-- --------------------------------------------------------

--
-- Table structure for table `phan_cong_nghiem_thu`
--

CREATE TABLE IF NOT EXISTS `phan_cong_nghiem_thu` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `ma_giang_vien` int(11) NOT NULL,
  `ma_hd_nghiem_thu` int(11) NOT NULL,
  `chuc_danh` tinyint(4) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=65 ;

--
-- Dumping data for table `phan_cong_nghiem_thu`
--

INSERT INTO `phan_cong_nghiem_thu` (`id`, `ma_giang_vien`, `ma_hd_nghiem_thu`, `chuc_danh`) VALUES
(35, 175, 3, 0),
(36, 178, 3, 1),
(37, 174, 3, 2),
(38, 179, 3, 3),
(39, 177, 3, 4),
(45, 175, 4, 0),
(46, 177, 4, 1),
(47, 179, 4, 2),
(48, 174, 4, 3),
(49, 176, 4, 4),
(55, 175, 2, 0),
(56, 174, 2, 1),
(57, 176, 2, 2),
(58, 179, 2, 3),
(59, 177, 2, 4),
(60, 96, 1, 0),
(61, 125, 1, 1),
(62, 126, 1, 2),
(63, 117, 1, 3),
(64, 127, 1, 4);

-- --------------------------------------------------------

--
-- Table structure for table `quan_tri`
--

CREATE TABLE IF NOT EXISTS `quan_tri` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
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
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=5 ;

--
-- Dumping data for table `quan_tri`
--

INSERT INTO `quan_tri` (`id`, `ten_dang_nhap`, `mat_khau`, `ho`, `ten`, `ngay_sinh`, `email`, `ngay_tao`, `lan_dang_nhap_cuoi`, `trang_thai`, `ma_quyen`) VALUES
(1, 'admin', '6c486ee08f05dc5507365688d3cab248', 'Phòng Khoa học Công', 'nghệ', '2000-01-01', 'p_khcn@sgu.edu.vn', '2012-03-02', '2013-05-29 21:51:50', 1, 3),
(2, 'mod01', 'e10adc3949ba59abbe56e057f20f883e', 'Nguyễn Thái', 'Hùng', '1990-08-23', 'hungnguyen2308@yahoo.com', '2012-05-02', '2012-06-11 02:50:11', 1, 2),
(3, 'mod02', 'e10adc3949ba59abbe56e057f20f883e', 'Trần Việt', 'Anh', '1988-01-01', 'vietanh@gmail.com', '2012-05-02', '2012-05-02 14:57:42', 1, 2),
(4, 'mod03', 'e10adc3949ba59abbe56e057f20f883e', 'Nguyễn Thái', 'Hùng', '1990-08-23', 'email01@yahoo.com', '2012-05-23', '2013-03-21 21:10:23', 1, 2);

-- --------------------------------------------------------

--
-- Table structure for table `queue`
--

CREATE TABLE IF NOT EXISTS `queue` (
  `queue_id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `nguoi_dung_id` int(11) unsigned NOT NULL DEFAULT '0',
  `ma_giang_vien` varchar(10) COLLATE utf8_unicode_ci DEFAULT NULL,
  `ho` varchar(128) COLLATE utf8_unicode_ci NOT NULL,
  `ten` varchar(32) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `don_vi_id` int(11) NOT NULL,
  `hoc_vi_id` int(11) NOT NULL,
  `chuc_vu` varchar(200) COLLATE utf8_unicode_ci DEFAULT NULL,
  `so_dien_thoai` varchar(32) COLLATE utf8_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`queue_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=2 ;

--
-- Dumping data for table `queue`
--

INSERT INTO `queue` (`queue_id`, `nguoi_dung_id`, `ma_giang_vien`, `ho`, `ten`, `email`, `don_vi_id`, `hoc_vi_id`, `chuc_vu`, `so_dien_thoai`) VALUES
(1, 4, '11137', 'Huynh', 'leminhThien', 'thien.hlm@cb.sgu.edu.vn', 1, 2, 'Giảng Viên', '0974 89 22 33');

-- --------------------------------------------------------

--
-- Table structure for table `qui_dinh`
--

CREATE TABLE IF NOT EXISTS `qui_dinh` (
  `id` int(5) NOT NULL AUTO_INCREMENT,
  `ten` varchar(200) COLLATE utf8_unicode_ci NOT NULL,
  `ten_file` varchar(200) COLLATE utf8_unicode_ci DEFAULT NULL,
  `loai` tinyint(4) NOT NULL,
  `trang_thai` tinyint(4) NOT NULL DEFAULT '1',
  `search` tinyint(1) NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=13 ;

--
-- Dumping data for table `qui_dinh`
--

INSERT INTO `qui_dinh` (`id`, `ten`, `ten_file`, `loai`, `trang_thai`, `search`) VALUES
(1, 'Dai hoc SG 27 Tuoi len 5 (14-12)', 'Dai hoc SG 27 Tuoi len 5 (14-12).doc', 1, 0, 1),
(2, 'Ke hoach 5 nam (04-01) 26', 'Ke hoach 5 nam (04-01) 26.doc', 1, 0, 1),
(3, 'Nhiem vu 24  KHCN (29-12)', 'Nhiem vu 24  KHCN (29-12).doc', 1, 1, 1),
(5, 'QĐ 22Quy che KHCN (04-01)', 'QD 22Quy che KHCN (04-01).doc', 1, 1, 1),
(6, 'QĐ 23 KHCN SV (04-01)', 'QD 23 KHCN SV (04-01).doc', 1, 1, 1),
(7, 'Quy che KHCN (28-12)', 'Quy che KHCN (28-12).doc', 1, 1, 1),
(8, 'Quy che KHCN SV (04-01)', 'Quy che KHCN SV (04-01).doc', 1, 1, 1),
(9, 'Quy dinh 25 dang ki, bien soan GT (28-12)', 'Quy dinh 25 dang ki, bien soan GT (28-12).doc', 1, 1, 1),
(10, 'Thong tin hoat dong KH cua Tien si', 'Thong tin hoat dong KH cua Tien si.doc', 1, 1, 1),
(11, 'Quy định về việc học tập của Nghiên cứu sinh Trường Đại học Sài Gòn', '1414116218_quy-dinh-ve-viec-hoc-tap-cua-nghien-cuu-sinh.pdf', 1, 1, 1),
(12, 'Quy định về định mức kinh phí NCKH, biên soạn Giáo trình; khen thưởng CBGV đạt học vị, học hàm và có công trình khoa học', '1414117393_dinh-muc-kinh-phi-nckh,-bien-soan-gt,-khen-thuong-cbgv-dat-hoc-ham-hoc-vi-va-co-cong-trinh-kh.pdf', 1, 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `quyen`
--

CREATE TABLE IF NOT EXISTS `quyen` (
  `id` tinyint(4) NOT NULL AUTO_INCREMENT,
  `ten` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `mo_ta` text COLLATE utf8_unicode_ci,
  `loai` enum('public','user','student','teacher','moderator','admin') COLLATE utf8_unicode_ci NOT NULL DEFAULT 'user',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=7 ;

--
-- Dumping data for table `quyen`
--

INSERT INTO `quyen` (`id`, `ten`, `mo_ta`, `loai`) VALUES
(1, 'Administrator', NULL, 'admin'),
(2, 'Moderator', NULL, 'moderator'),
(3, 'Teacher', NULL, 'teacher'),
(4, 'Member', NULL, 'user'),
(5, 'Guest', NULL, 'public'),
(6, 'Student', NULL, 'student');

-- --------------------------------------------------------

--
-- Table structure for table `search`
--

CREATE TABLE IF NOT EXISTS `search` (
  `type` varchar(32) CHARACTER SET latin1 COLLATE latin1_general_ci NOT NULL,
  `id` int(11) unsigned NOT NULL,
  `title` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `description` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `keywords` varchar(255) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `hidden` varchar(255) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  PRIMARY KEY (`type`,`id`),
  FULLTEXT KEY `LOOKUP` (`title`,`description`,`keywords`,`hidden`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `search`
--

INSERT INTO `search` (`type`, `id`, `title`, `description`, `keywords`, `hidden`) VALUES
('default_de_tai', 2, 'bien soan giao trinh: ‘bai tap dai so tuyen tinh, toan c1” dung cho sinh vien da nganh cua dh sai gon theo he thong tin chi.', '', '', ''),
('default_de_tai', 3, 'phat trien ngon ngu cho hoc sinh trung hoc co so tu ly thuyet truong dong nghia tu vung', '', '', ''),
('default_de_tai', 4, 'giao trinh dia ly viet nam dung cho sinh vien nganh viet nam hoc', '', '', ''),
('default_de_tai', 5, 'khai thac va su dung thiet bi nghe nhin hien dai pho bien ket hop cong nghe thong tin phuc vu day hoc', '', '', ''),
('default_de_tai', 6, 'giao trinh lich su van  minh the gioi', '', '', ''),
('default_de_tai', 7, 'tieng viet truc tuyen giai doan 1 (dung cho he thong truc tuyen (e-learning system) cua truong dhsg)', '', '', ''),
('default_de_tai', 8, 'dinh huong phat trien ben vung cong tac dao tao cua khoa van hoa – du lich o truong dai hoc sai gon', '', '', ''),
('default_de_tai', 9, 'kiem soat chi phi trong xay dung co ban', '', '', ''),
('default_de_tai', 31, 'giao trinh 2 : bong da futsal co ban', '', '', ''),
('default_de_tai', 32, 'giao trinh bong ban 2-3', '', '', ''),
('default_de_tai', 33, 'nghien cuu danh gia, xep loai the luc chung cua sinh vien dau vao truong dh sai gon nam 2010-2011', '', '', ''),
('default_de_tai', 39, 'bai toan parabolic nguoc', '', '', ''),
('default_de_tai', 41, 'bai toan cauchy nguoc', '', '', ''),
('default_de_tai', 42, 'bien soan giao trinh giai tich 1 dung cho viec dao tao sinh vien khoa toan - ung dung va sinh vien da nganh cua dai hoc sai gon', '', '', ''),
('default_de_tai', 43, 'tuyen tap cac bai tap lap trinh can ban', '', '', ''),
('default_de_tai', 44, 'giao trinh han - nom cho sinh vien nganh viet nam hoc', '', '', ''),
('default_de_tai', 45, 'nghien cuu xay dung quy trinh xac dinh bod3 trong nuoc thai nganh phan bon', '', '', ''),
('default_de_tai', 46, 'nghien cuu su dung tao (chlorella sp.,  spirulida sp.) va beo luc binh de xu ly nguon nuoc bi phu duong hoa.', '', '', ''),
('default_de_tai', 47, 'danh gia hien trang va nhu cau nhan luc nganh moi truong o thanh pho ho chi minh, binh duong va dong nai', '', '', ''),
('default_de_tai', 48, 'to chuc hoat dong van dong cho tre mam non theo huong tich cuc', '', '', ''),
('default_de_tai', 49, 'xay dung phuong tien ngon ngu de tang cuong hieu qua day hoc tieng viet cho hoc sinh tieu hoc (tu lop 1 den hoc ki 1 lop 3) tren nguyen ly truong tu vung ngu nghia', '', '', ''),
('default_de_tai', 296, 'nghien cuu che tao keo bac nano su dung chitosan tan trong nuoc lam chat khu /chat on dinh', '', '', ''),
('default_de_tai', 50, 'xay dung phuong tien ngon ngu de tang cuong hieu qua day hoc tieng viet cho hoc sinh tieu hoc (tu hoc ki 2 lop 3 den lop 5) tren nguyen ly truong tu vung ngu nghia.', '', '', ''),
('default_de_tai', 51, 'tieng viet voi khoa hoc giao tiep', '', '', ''),
('default_de_tai', 52, 'nghien cuu khai niem ban dau ve phep chia trong chuong trinh toan lop 2', '', '', ''),
('default_de_tai', 53, 'xay dung chuong trinh dao tao ngan han nghe bep theo mo dun tai tp ho chi minh', '', '', ''),
('default_de_tai', 54, 'giao trinh kinh te vi mo', '', '', ''),
('default_de_tai', 55, 'bien phap nang cao hinh anh khoa quan tri kinh doanh, truong dai hoc sai gon', '', '', ''),
('default_de_tai', 56, 'doi moi noi dung chuong trinh thanh nhac cho sinh vien nam i cua dai hoc su pham am nhac', '', '', ''),
('default_de_tai', 57, 'thiet ke dao tao noi dung mon phoi hop xuong cho dai hoc su pham am nhac', '', '', ''),
('default_de_tai', 58, 'xay dung chuong trinh dao tao cu nhan tam ly - giao duc tai truong dhsg', '', '', ''),
('default_de_tai', 59, 'xay dung chuong trinh boi duong chuyen vien tu van hoc duong cho cac truong trung hoc co so va trung hoc pho thong.', '', '', ''),
('default_de_tai', 60, 'toi uu hoa cac tham so trong giai thuat chuyen giao mem de tang cuong hieu qua su dung tai nguyen vo tuyen trong he thong thong tin di dong bang rong cdma', '', '', ''),
('default_de_tai', 61, 'bien soan tai lieu he thong thong tin dien tu vo tuyen', '', '', ''),
('default_de_tai', 62, 'ung dung card advantech pci 1711 dieu khien khop noi cua canh tay robot', '', '', ''),
('default_de_tai', 63, 'nghien cuu giai thuat dieu khien cong suat tac dung cho he thong pin nang luong mat troi su dung bo bien tan z mot pha', '', '', ''),
('default_de_tai', 64, 'thuc trang tri tue cam xuc cua sinh vien nam cuoi truong dai hoc sai gon – thanh pho hcm', '', '', ''),
('default_de_tai', 65, 'chien luoc phat trien phong dao tao tai chuc & tu nghiep giao vien giai doan 2011-2015', '', '', ''),
('default_de_tai', 66, 'tac dong cua viec “lay y kien phan hoi tu nguoi doc ve giang day mon hoc” toi hoat dong giang day cua giang vien', '', '', ''),
('default_de_tai', 67, 'nghien cuu xung anh sang trang femto giay tao boi soi quang hoc co chieu dai duoi 1cm', '', '', ''),
('default_de_tai', 68, 'viet tai lieu tham khao ve vat ly laser va cac ki thuat quang pho', '', '', ''),
('default_de_tai', 69, 'tai lieu huong dan lam do dung day hoc vat ly', '', '', ''),
('default_de_tai', 70, 'khao sat thanh phan hoa hoc cao cloroform cua la cay bang lang lagerstroemia speciosa (l.) pers., ho tu vi (lythraceae)', '', '', ''),
('default_de_tai', 71, 'viet giao trinh hoa hoc vo co – phan phi kim', '', '', ''),
('default_de_tai', 72, 'nghien cuu dieu che phuc lantan citrat va thu nghiem lam chat kich thich sinh truong cay ca chua', '', '', ''),
('default_de_tai', 73, 'giao trinh dai so tuyen tinh', '', '', ''),
('default_de_tai', 74, 'bo de thi trac nghiem mon xac suat thong ke a', '', '', ''),
('default_de_tai', 75, 'bo de thi trac nghiem mon xac suat thong ke b', '', '', ''),
('default_de_tai', 76, 'giao trinh dien tu hoc phan nhap mon may tinh', '', '', ''),
('default_de_tai', 77, 'nghien cuu mot so mo hinh hoa dien hinh va ung dung vao giang day mon phan tich thiet ke he thong', '', '', ''),
('default_de_tai', 78, 'xay dung phan mem quan ly phan cong giang day cho khoa cntt, truong dh sai gon', '', '', ''),
('default_de_tai', 79, 'nghien cuu cong nghe nhan dang bang the thong minh vo tuyen va xay dung mo hinh ung dung trong quan ly sinh vien tai truong dhsg', '', '', ''),
('default_de_tai', 80, 'bien soan giao trinh dien tu co ban', '', '', ''),
('default_de_tai', 81, 'thiet ke cac bai thi nghiem thuc hanh dien tu co ban', '', '', ''),
('default_de_tai', 82, 'thiet ke cac chuong trinh vhdl dieu khien cac khoi ngoai vi giao tiep tren co so kit fpga spartan 3a/3e', '', '', ''),
('default_de_tai', 83, 'thiet ke va thi cong he thong tu dong tiep nhan dang ky kham benh bang tin nhan sms', '', '', ''),
('default_de_tai', 84, 'ky thuat lam roi va sang tao cac loai roi tu nguyen vat lieu mo', '', '', ''),
('default_de_tai', 85, 'mo phong va tinh toan cau truc vung nang luong cua dien tu trong ong nano carbon (6,0) bien dang', '', '', ''),
('default_de_tai', 86, 'nghien cuu tinh chat dien tu cua ong nano carbon (5,5) kieu quinoid bang phuong phap mo phong luong tu', '', '', ''),
('default_de_tai', 87, 'nghien cuu cat mach chitosan truong trong dung dich h2o2 bang buc xa gamma co-60', '', '', ''),
('default_de_tai', 88, 'nghien cuu thu hoi sat tu ba thai bun do', '', '', ''),
('default_de_tai', 89, 'xay dung trang web dinh loai cac loai luong cu, bo sat cac tinh phia tay mien dong nam bo', '', '', ''),
('default_de_tai', 90, 'xay dung trang web ve cac dac diem phan loai va chuong trinh dinh danh cac hoc thuc vat hat kin o viet nam', '', '', ''),
('default_de_tai', 91, 'xay dung quy trinh tao mot bai giang sinh hoc de phuc vu e-learning', '', '', ''),
('default_de_tai', 92, 'khao sat vi khuan vung re va vi khuan noi sinh o cay bap (zeamays) trong tai dong nam bo', '', '', ''),
('default_de_tai', 93, 'tim hieu thuc trang va giai phap nang cao chat luong day hoc thuc hanh mon sinh hoc tai truong thcs, thpt', '', '', ''),
('default_de_tai', 94, 'hoan chinh, nang cao chuong trinh “thuc tap nghien cuu thien nhien” va ki nang thuc te thien nhien cho sinh vien nganh su pham sinh hoc', '', '', ''),
('default_de_tai', 95, 'su ton tai nghiem cua phuong trinh vi - tich phan dao ham rieng tu tham chieu', '', '', ''),
('default_de_tai', 96, 'bai toan truyen nhiet nguoc voi he so khong hang', '', '', ''),
('default_de_tai', 97, 'nghe thuat tieu thuyet viet nam giai doan 1955-1975', '', '', ''),
('default_de_tai', 98, 'chien tranh hoa hoc cua my o viet nam va cuoc dau tranh vi cong ly cua cac nan nhan chat doc da cam dioxin viet nam', '', '', ''),
('default_de_tai', 99, 'lich su phat trien cang sai gon trong giai doan 1954-2010', '', '', ''),
('default_de_tai', 100, 'xay dung mot he thong hoc tap truc tuyen cho khoa cong nghe thong tin - truong dai hoc sai gon', '', '', ''),
('default_de_tai', 101, 'tim hieu va danh gia cac thuat toan dinh tuyen ky thuat luu luong trong mang toc do cao.', '', '', ''),
('default_de_tai', 102, 'phan mem quan ly cong van khoa cong nghe thong tin', '', '', ''),
('default_de_tai', 103, 'ap dung ly thuyet tap mo de mo rong co so du lieu huong doi tuong xac suat', '', '', ''),
('default_de_tai', 104, 'xay dung he thong bien dich ma nguon he dieu hanh ubuntu tren kien truc arm (porting ubuntu to arm- advancs risc machine)', '', '', ''),
('default_de_tai', 105, 'cai tien cay tim kiem doi khang monte carlo', '', '', ''),
('default_de_tai', 106, 'xay dung website quan li thong tin nckh tai phong khcn – truong dai hoc sai gon', '', '', ''),
('default_de_tai', 107, 'khao sat mot so thanh phan ly, hoa hoc dat o hai mo hinh canh tac dot rom va khong dot rom sau thu hoach tren vung trong lua tham canh', '', '', ''),
('default_de_tai', 108, 'dieu tra va danh gia viec su dung che pham sinh hoc de u phan mun tu rom tai huyen cai be, tinh tien giang', '', '', ''),
('default_de_tai', 109, 'de xuat cac giai phap quan ly moi truong theo tieu chi quoc gia ve nong thon moi tai xa binh hoa, huyen vinh cuu, tinh dong nai', '', '', ''),
('default_de_tai', 110, 'nghien cuu kha nang xu ly khi nh3 bang he xuc tac quang hoa tio2', '', '', ''),
('default_de_tai', 111, 'nghien cuu kha nang xu ly khi cod cua nuoc o nhiem bang he xuc tac quang hoa tio2', '', '', ''),
('default_de_tai', 112, 'danh gia rui ro chat luong nuoc song dong nai phuc vu cap nuoc an toan khu vuc thanh pho ho chi minh (doan cau hoa an)', '', '', ''),
('default_de_tai', 113, 'tiep can thi ca tu nguyen li cua ki hieu hoc', '', '', ''),
('default_de_tai', 114, 'khao sat xay dung he thong ky nang trong dao tao nghiep vu du lich cua khoa van hoa – du lich', '', '', ''),
('default_de_tai', 115, 'doi moi chuong trinh va noi dung giang day thanh nhac cho sinh vien dai hoc su pham nam thu hai', '', '', ''),
('default_de_tai', 116, 'nghien cuu lua chon phan mem mo phong mach dien tu de nang cao hieu qua giang day thi nghiem, thuc hanh tai khoa dien tu vien thong truong dai hoc sai gon', '', '', ''),
('default_de_tai', 117, 'nghien cuu ly thuyet xu ly diem poisson va ung dung tinh toan xac suat ket noi trong mang thong tin ad hoc giua cac xe', '', '', ''),
('default_de_tai', 118, 'nghien cuu va ung dung phuong phap tiep can cdio (conceive – design – implement - operate) vao viec phat trien chuong trinh dao tao ky su nganh cong nghe ky thuat dien tu, truyen thong.', '', '', ''),
('default_de_tai', 119, 'thiet ke cac bai thuc hanh mach dien', '', '', ''),
('default_de_tai', 120, 'thiet ke kit thuc hanh vi xu ly va bien soan tai lieu thuc hanh vi xu ly', '', '', ''),
('default_de_tai', 121, 'nang cao hieu qua su dung phuong phap thao luan nhom trong giang day bo mon nhung nguyen ly co ban cua chu nghia mac – lenin', '', '', ''),
('default_de_tai', 122, 'nghien cuu lua chon mot so bai tap the chat noi khoa den nang cao the luc cho nu sinh vien co the luc yeu cua truong dai hoc sai gon', '', '', ''),
('default_de_tai', 123, 'khao sat viec lam cua sinh vien tot nghiep nam 2010 cua truong dai hoc sai gon (he cao dang)', '', '', ''),
('default_de_tai', 124, 'cac bien phap quan li nang cao chat luong hoat dong thuc tap su pham trong dao tao giao vien trung hoc pho thong o truong dai hoc sai gon', '', '', ''),
('default_loai_bieu_mau', 2, 'dao tao sau dai hoc', '', '', ''),
('default_de_tai', 125, 'danh gia su phat trien cua truong dai hoc sai gon qua cong tac tu danh gia trong 3 nam hoc, tu nam 2008 den 2011', '', '', ''),
('default_de_tai', 126, 'danh gia tac dong cua van hoa chat luong den hoat dong dam bao chat luong giao duc trong nha truong', '', '', ''),
('default_de_tai', 127, 'danh gia muc do phu hop giua chuong trinh dao tao dai hoc khoi nganh kinh te voi nhu cau tuyen dung cua thi truong lao dong (nghien cuu tai truong dai hoc sai gon)', '', '', ''),
('default_de_tai', 128, 'ung dung phan mem ma nguon mo dspace xay dung bo suu tap thu vien so', '', '', ''),
('default_de_tai', 129, 'nang cao chat luong cac dich vu thong tin – thu vien tai trung tam hoc lieu truong dai hoc sai gon', '', '', ''),
('default_de_tai', 130, 'hieu qua chuong trinh can thiep phong chong cac yeu to nguy co cua benh khong lay tren nhan vien van phong truong dai hoc sai gon.', '', '', ''),
('default_de_tai', 131, 'nghien cuu anh huong cua anh sang va thanh phan hon hop ruot bau den su phat trien cua cay dau lan (couroupita guianensis aubl.) trong giai doan vuon uom', '', '', ''),
('default_de_tai', 132, 'nghien cuu va ung dung phuong phap du an ( the project method ) vao hoat dong day hoc va giao duc ki nang song cho hoc sinh o truong th thuc hanh sai gon', '', '', ''),
('default_de_tai', 133, 'tai lieu tham khao hoc phan dien dong luc hoc', '', '', ''),
('default_de_tai', 134, 'tai lieu tham khao bai tap hoc phan quang pho', '', '', ''),
('default_de_tai', 135, 'tai lieu tham khao hoa phan tich 1', '', '', ''),
('default_de_tai', 136, 'bai tap xac suat thong ke (phan 1)', '', '', ''),
('default_de_tai', 137, 'tai lieu tham khao hoc phan cau truc du lieu va giai thuat', '', '', ''),
('default_de_tai', 138, 'bai tap co so du lieu quan he', '', '', ''),
('default_de_tai', 139, 'tai lieu tham khao ve quan tri va bao tri mang', '', '', ''),
('default_de_tai', 140, 'he thong cau hoi trac nghiem va bai tap mon hoc nguyen ly ke toan', '', '', ''),
('default_de_tai', 141, 'tai lieu hoc tap bo mon duong loi cach mang cua dang cong san viet nam', '', '', ''),
('default_de_tai', 142, 'giao trinh mon thien van hoc dai cuong', '', '', ''),
('default_de_tai', 143, 'giao trinh mon phuc chat trong hoa vo co', '', '', ''),
('default_de_tai', 144, 'giao trinh giai tich 2 dung cho viec dao tao sinh vien khoa toan - ung dung va sinh vien da nganh', '', '', ''),
('default_de_tai', 145, 'giao trinh dai so dai cuong', '', '', ''),
('default_de_tai', 146, 'giao trinh phuong trinh dao ham rieng', '', '', ''),
('default_de_tai', 147, 'giao trinh lich su viet nam tu 1975 den 2010', '', '', ''),
('default_de_tai', 148, 'giao trinh dien tu khoa hoc trai dat', '', '', ''),
('default_de_tai', 149, 'giao trinh tin hoc van phong (danh cho sv khong chuyen tin hoc nganh anh van du lich)', '', '', ''),
('default_de_tai', 150, 'giao trinh giai tich mach dien', '', '', ''),
('default_de_tai', 151, 'giao trinh cau kien dien tu', '', '', ''),
('default_de_tai', 152, 'giao trinh truyen dan vo tuyen so', '', '', ''),
('default_de_tai', 153, 'giao trinh thi truong tai chinh', '', '', ''),
('default_de_tai', 154, 'giao trinh thue', '', '', ''),
('default_de_tai', 155, 'giao trinh ke toan tai chinh 1', '', '', ''),
('default_de_tai', 156, 'giao trinh phap luat dai cuong', '', '', ''),
('default_de_tai', 157, 'giao trinh van hoa am thuc viet nam', '', '', ''),
('default_de_tai', 158, 'doi moi phuong phap day hoc theo he thong tin chi tai khoa su pham khoa hoc xa hoi truong dai hoc sai gon', '', '', ''),
('default_de_tai', 159, 'tieng viet truc tuyen giai doan 2 (dung cho he thong truc tuyen (e-learning system) cua truong dhsg)', '', '', ''),
('default_de_tai', 160, 'dieu che tio2 bang phuong phap axit sunfuric co ap suat tu tinh quang ilmenite', '', '', ''),
('default_de_tai', 161, 'bai toan cauchy doi voi phuong trinh tich phan ki di', '', '', ''),
('default_de_tai', 162, 'chinh hoa va danh gia sai so cho nghiem cua bai toan nhiet nguoc', '', '', ''),
('default_de_tai', 163, 'phuong thuc tiep can khong gian, thoi gian trong tho ca duoi goc do ngon ngu hoc', '', '', ''),
('default_de_tai', 164, 'hinh thanh ky nang cam thu am nhac cua tre 5-6 tuoi thong qua nghe hat – nghe nhac o truong mam non', '', '', ''),
('default_de_tai', 165, 'xay dung ngan hang de thi mon ly luan chung ve nha nuoc va phap luat', '', '', ''),
('default_de_tai', 166, 'danh gia su hai long cua sinh vien hinh thuc vhvl truong dai hoc sai gon', '', '', ''),
('default_de_tai', 167, 'tu lieu nghien cuu hoc tap tu tuong ho chi minh', '', '', ''),
('default_de_tai', 168, 'khao sat tinh hinh viec lam cua sinh vien sau khi tot nghiep', '', '', ''),
('default_de_tai', 169, 'xay dung va danh gia chat luong ngan hang de thi “toan roi rac” dua tren mo hinh rasch', '', '', ''),
('default_de_tai', 170, 'phat trien thao tac so sanh cua tre 5-6 tuoi trong hoat dong kham pha khoa hoc', '', '', ''),
('default_de_tai', 171, 'suu tam cac tro choi phan loai cho tre mau giao', '', '', ''),
('default_de_tai', 172, 'xay dung mot so tro choi nham phat trien ky nang xa hoi cua tre mau giao 5-6 tuoi', '', '', ''),
('default_de_tai', 173, 'lich su hinh thanh va phat trien truong dai hoc sai gon', '', '', ''),
('default_de_tai', 174, 'de xuat chuong trinh san xuat sach hon tai nha may che bien cao su dai phuoc tai (de xuat chuong trinh san xuat sach hon luong nuoc tieu thu)', '', '', ''),
('default_de_tai', 175, 'bien soan giao trinh hoa moi truong', '', '', ''),
('default_de_tai', 176, 'chien luoc phat trien khoa quan tri kinh doanh giai doan 2010-2020', '', '', ''),
('default_de_tai', 177, 'phan tich va kiem tra ke toan nham phat hien sai sot va gian lan o cac doanh nghiep', '', '', ''),
('default_de_tai', 178, 'phan tich nhan to tac dong rui ro lam phat trong kinh te', '', '', ''),
('default_de_tai', 179, 'huong dan sinh vien he cao dang chinh quy khoa giao duc mam non lap ke hoach day hoc tich hop cho tre mau giao', '', '', ''),
('default_de_tai', 180, 'su dung he thong bai tap phat trien ngon ngu cho tre mau giao o truong mam non', '', '', ''),
('default_de_tai', 181, 'khao sat su thay doi nong do dam, lan va bod trong nuoc thai lo mo gia suc co trong thuy canh co vetiver (vertiver zizianoides i…) va trong nuoc thai nuoi tom the chan trang trong ho loc sinh hoc ba', '', '', ''),
('default_de_tai', 182, 'xay dung phuong tien ren ky nang lam van mieu ta cho hoc sinh tieu hoc tu nguyen ly truong tu vung ngu nghia', '', '', ''),
('default_de_tai', 201, 'phat trien nang luc cam thu tho ca cho hoc sinh tieu hoc tu phuong dien ngon ngu', '', '', ''),
('default_de_tai', 202, 'giao duc ky nang song cho sv khoa tieu hoc bang con duong day hoc vao hoc phan dao duc va phuong phap giao duc mon dao duc o truong dai hoc sai gon', '', '', ''),
('default_de_tai', 203, 'nhung rang buoc trong moi quan he giua phep chia so tu nhien va phan so trong chuong trinh toan lop 4', '', '', ''),
('default_de_tai', 204, 'xay dung quy trinh tuyen chon giang vien cho truong dai hoc sai gon den 2023', '', '', ''),
('default_de_tai', 205, 'phan mem ho tro day hoc phan ma tran va dinh thuc trong mon toan dai so tuyen tinh', '', '', ''),
('default_de_tai', 206, 'xay dung mo hinh dao tao quan tri kinh doanh chat luong cao bang tieng anh tai khoa quan tri kinh doanh truong dai hoc sai gon', '', '', ''),
('default_de_tai', 207, 'so sanh cau truc va noi dung sach giao khoa sinh hoc lop 11 viet nam voi sach giao khoa sinh hoc bac trung hoc cua bang georgia - hoa ky', '', '', ''),
('default_de_tai', 208, 'tiep can xu ly anh trong viec nhan dang bien dang ky xe', '', '', ''),
('default_de_tai', 209, 'kiem tra bao duong thiet bi dien dung tin nhan sms va mo phong phan mem labview', '', '', ''),
('default_de_tai', 210, 'thiet ke website khoa dien tu vien thong', '', '', ''),
('default_de_tai', 211, 'nghien cuu su dung tin hieu dien nao (eeg: electroencephalography) de dieu khien thiet bi', '', '', ''),
('default_de_tai', 212, 'nghien cuu phan mem thiet ke cua hang synopsys va cadance phuc vu thiet ke, mo phong vi mach so', '', '', ''),
('default_de_tai', 213, 'nghien cuu de xuat giai phap gop phan nang cao chat luong dao tao nham dat chuan dau ra dap ung nhu can xa hoi cho cac nganh dao tao cua khao dien tu vien thong', '', '', ''),
('default_de_tai', 214, 'tu tuong nguyen an ninh ve ton giao, van hoa, khoa hoc dau the ky xx o viet nam', '', '', ''),
('default_de_tai', 215, 'cac nhan to tac dong den long trung thanh cua khach hang doi voi nhom san pham mang nhan hang rieng cua sieu thi coop mart tai tp.hcm', '', '', ''),
('default_de_tai', 216, 'nhu cau, dong co va kho khan cua sinh vien khi tham gia cac hoat dong the thao ngoai khoa tai truong dai hoc sai gon', '', '', ''),
('default_de_tai', 217, 'nghien cuu lua chon, su dung mot so bai tap the duc (voi gay, voi bong) va tro choi van dong nhu mot hoc phan tu chon de phat trien the luc cho sinh vien nu truong dai hoc sai gon', '', '', ''),
('default_de_tai', 218, 'nghien cuu xay dung tieu chuan the luc cho sinh vien truong dai hoc sai gon nam hoc 2012-2013', '', '', ''),
('default_de_tai', 219, 'danh gia hieu qua cua viec ung dung chuong trinh giang day mon bong da futsal trong hoc phan tu chon de phat trien the chat cho nu sinh vien truong dai hoc sai gon', '', '', ''),
('default_de_tai', 220, 'doi moi va tang cuong hieu qua he thong thong tin truong dai hoc sai gon', '', '', ''),
('default_de_tai', 221, 'bao ve quyen con nguoi trong linh vuc hon nhan va gia dinh theo phap luat viet nam', '', '', ''),
('default_de_tai', 222, 'giao duc, pho bien phap luat trong sinh vien - hoc sinh truong dai hoc sai gon', '', '', ''),
('default_de_tai', 223, 'su dung phuong phap tinh huong trong day va hoc bo mon tu phap', '', '', ''),
('default_de_tai', 224, 'danh gia hieu qua su dung va xay dung giai phap tiet kiem nang luong dien tai truong dai hoc sai gon', '', '', ''),
('default_de_tai', 225, 'danh gia rui ro moi truong nuoc thai cong nghiep cua he thong xu ly nuoc thai kcn tan binh', '', '', ''),
('default_de_tai', 226, 'ung dung cong nghe thong tin dia ly (gis) phan vung chat luong nuoc song vam co dong (doan chay qua ben luc, tinh long an)', '', '', ''),
('default_de_tai', 227, 'buoc dau nghien cuu anh huong cua bien doi khi han den thanh pho ho chi minh thong qua viec danh gia su thay doi luong mua den van de thoat nuoc tai khu vuc', '', '', ''),
('default_de_tai', 228, 'nghien cuu giai phap xu ly nuoc thai y te quy mo nho cho cac phong kham tu nhan', '', '', ''),
('default_de_tai', 229, 'giao trinh cong nghe sinh hoc moi truong', '', '', ''),
('default_de_tai', 230, 'khao sat, phan lap mot so chung vi sinh vat trong thien nhien co kha nang len men sinh khoi thuc vat (plant lignocellulosic biomass)', '', '', ''),
('default_de_tai', 231, 'nghien cuu toi uu hoa kha nang xu ly do mau nuoc thai det nhuom bang he xuc tac tio2 dang bot', '', '', ''),
('default_de_tai', 232, 'nghien cuu kha nang xu ly hoi fomaldehyde bang phuong phap quang xuc tac tio2/uv', '', '', ''),
('default_de_tai', 233, 'khao sat thanh phan hoa hoc cay an dien lindley hedyotis lindleyama hook ex h. arn, ho ca phe rubiaceae', '', '', ''),
('default_de_tai', 234, 'khao sat thanh phan hoa hoc re cay an dien sat hedyotis pressa piere et pit., ho ca phe rubiaceae', '', '', ''),
('default_de_tai', 235, 'nghien cuu giai phap xu ly rom ra tren dong ruong bang che pham sinh hoc trong vu xuan - he o huyen cai be, tinh tien giang', '', '', ''),
('default_de_tai', 236, 'nghien cuu nhan nuoi va su dung vi khuan quang hop phototrophic bacteria de xu ly chat o nhiem trong quy mo phong thi nghiem', '', '', ''),
('default_de_tai', 237, 'nghien cuu loai mau nuoc thai nhuom hoat tinh bang phuong phap keo tu dien hoa hieu the cao', '', '', ''),
('default_de_tai', 238, 'nghien cuu tang cuong loai mot so mau hoat tinh trong nuoc thai nganh nhuom bang gum trich ly tu hat cay muong hoang yen', '', '', ''),
('default_de_tai', 239, 'dam bao chat luong trong moi quan he giua yeu cau cua nguoi su dung lao dong voi chuong trinh dao tao dai hoc khoi nganh kinh te (nghien cuu tai truong dai hoc sai gon)', '', '', ''),
('default_de_tai', 240, 'khao sat su hinh thanh va phat trien cua mo seo tu cat cat mong mo dau tam trang (morus alba) tren moi truong ran va long', '', '', ''),
('default_de_tai', 241, 'nghien cuu giai phap khac phuc hien tuong tre tin hieu tren duong truyen dan tin hieu giua trai dat va sao hoa', '', '', ''),
('default_de_tai', 243, 'de an phat trien trung tam phat trien giao duc truong dai hoc sai gon', '', '', ''),
('default_de_tai', 244, 'cai bien cau trong tieng anh', '', '', ''),
('default_de_tai', 245, 'qua trinh \\"leo thang chien tranh\\" cua my tai viet nam (1954-1969)', '', '', ''),
('default_de_tai', 246, 'nghien cuu quy mo va co cau lao dong o tp.hcm trong qua trinh cong nghiep hoa', '', '', ''),
('default_de_tai', 247, 'tim hieu mot so dia danh tieu bieu tinh tra vinh', '', '', ''),
('default_de_tai', 248, 'quan niem van chuong cua nguyen trai', '', '', ''),
('default_de_tai', 249, 'thoi xau nguoi viet nam qua thanh ngu, tuc ngu', '', '', ''),
('default_de_tai', 250, 'khai luan thi phap hoc', '', '', ''),
('default_de_tai', 251, 'giao trinh lich su viet nam tu 1945 den 1975', '', '', ''),
('default_de_tai', 252, 'tai lieu tham khao phuong phap nghien cuu khoa hoc lich su', '', '', ''),
('default_de_tai', 253, 'giao trinh quan tri hanh chinh van phong', '', '', ''),
('default_de_tai', 254, 'xay dung mo hinh phat trien tap chi dai hoc sai gon (giai doan tu 2014 den 2025)', '', '', ''),
('default_de_tai', 255, 'mo rong csdl quan he de bieu dien va truy van thong tin khong chac chan', '', '', ''),
('default_de_tai', 256, 'nghien cuu cdio va ung dung vao giang day hoc phan quan tri mang', '', '', ''),
('default_de_tai', 257, 'de xuat thuat toan dinh tuyen ki thuat luu luong trong mang toc do cao', '', '', ''),
('default_de_tai', 258, 'tai lieu tham khao bai tap co so tri tue nhan tao', '', '', ''),
('default_de_tai', 259, 'giao trinh toan roi rac', '', '', ''),
('default_de_tai', 260, 'giao trinh co so du lieu', '', '', ''),
('default_de_tai', 261, 'tai lieu tham khao lap trinh huong doi tuong', '', '', ''),
('default_de_tai', 262, 'tai lieu huong dan thuc hanh cho hoc phan phat trien ung dung tren thiet bi di dong, phan lap trinh tren windows phone', '', '', ''),
('default_de_tai', 263, 'tai lieu tham khao bai tap cau truc du lieu va giai thuat', '', '', ''),
('default_de_tai', 264, 'huong dan thuc hanh hoc phan cong nghe phan mem', '', '', ''),
('default_de_tai', 265, 'huong dan thuc hanh mon phat trien phan mem ma nguon mo (ptpm-mnm)', '', '', ''),
('default_de_tai', 266, 'bai toan gia tri dau cho phuong trinh vi phan dao ham rieng cap hai tu tham chieu', '', '', ''),
('default_de_tai', 267, 'phan lop cac pham tru picard phan bac va ung dung', '', '', ''),
('default_de_tai', 268, 'phan tich so lieu mang & ung dung - su dung voi phan mem stata', '', '', ''),
('default_de_tai', 269, 'phan tich moi quan he giua ty gia hoi doai va tang truong kinh te', '', '', ''),
('default_de_tai', 270, 'bai toan nhiet nguoc voi nguon nhiet phi tuyen', '', '', ''),
('default_de_tai', 271, 'toc do hoi tu va luat so lon doi voi mang cac bien ngan nhien', '', '', ''),
('default_de_tai', 272, 'giao trinh giai tich ham nhieu bien', '', '', ''),
('default_de_tai', 273, 'bai tap xac suat thong ke', '', '', ''),
('default_de_tai', 274, 'giao trinh dai so dai cuong (phan 2)', '', '', ''),
('default_de_tai', 275, 'giao trinh ly thuyet so', '', '', ''),
('default_de_tai', 276, 'giao trinh hinh hoc affine va hinh hoc euclide (phan 1)', '', '', ''),
('default_de_tai', 277, 'dieu kien can, du cuc tri va doi ngau trong bai toan toi uu vecto', '', '', ''),
('default_de_tai', 278, 'hoat dong tu hoc mon tam ly hoc tre em cua sinh vien khoa gdmn - thuc trang va giai phap', '', '', ''),
('default_de_tai', 279, 'thuc trang ky nang xu ly tinh huong su pham cua giao vien mam non trong hoat dong giao duc tre mau giao 4-5 tuoi', '', '', ''),
('default_de_tai', 280, 'thuc trang ky nang giao tiep su pham cua giao vien voi tre 4-5 tuoi o mot so truong mam non tai tp.hcm', '', '', ''),
('default_de_tai', 281, 'bien soan he thong tro choi nham phat trien mot so ky nang am nhac cho tre mau giao 5-6 tuoi', '', '', ''),
('default_de_tai', 282, 'thuc trang khac phuc kho khan tam ly trong hoat dong hoc tap cua sinh vien nam thu nhat khoa gdmn - truong dai hoc sai gon khi dao tao theo he thong tin chi', '', '', ''),
('default_de_tai', 283, 'thuc trang hung thu hoc mon phuong phap lam quen voi van hoc cua sinh vien khoa giao duc mam non truong dai hoc sai gon', '', '', ''),
('default_de_tai', 284, 'bien phap phat trien nang luc quan sat cho tre 5-6 tuoi trong hoat dong kham pha thien nhien', '', '', ''),
('default_de_tai', 285, 'giao trinh tam li hoc tre em -2', '', '', ''),
('default_de_tai', 286, 'giao trinh giao tiep su pham mam non', '', '', ''),
('default_de_tai', 287, 'giao trinh van hoc tre em va nghe thuat doc dien cam', '', '', ''),
('default_de_tai', 288, 'thuc trang nhu cau tham van tam ly cua sinh vien nam nhat, nganh su pham truong dai hoc sai gon giai doan 2013-2015', '', '', ''),
('default_de_tai', 289, 'tai lieu giang day va hoc tap hoc phan to chuc hoat dong day hoc va giao duc o truong trung hoc co so', '', '', ''),
('default_de_tai', 290, 'tai lieu giang day va hoc tap hoc phan to chuc hoat dong day hoc va giao duc o truong trung hoc pho thong', '', '', ''),
('default_de_tai', 291, 'tai lieu giang day va hoc tap hoc phan to chuc hoat dong day hoc va giao duc o truong tieu hoc', '', '', ''),
('default_de_tai', 292, 'quy trinh thuc hien va giai phap nang cao chat luong hoat dong thanh', '', '', ''),
('default_de_tai', 293, 'phan tich cac nhan to tac dong den thu nhap cua sinh vien truong dai hoc sai gon khoa tai chinh ke toan', '', '', ''),
('default_de_tai', 294, 'chinh sach tien te anh huong den thi truong vang tai viet nam', '', '', ''),
('default_de_tai', 295, 'giao trinh ke toan quan tri', '', '', ''),
('default_tin_tuc', 2, 'truong dai hoc khoa hoc ung dung tay bac thuy si hop tac dao tao “chuyen de boi duong sau dai hoc nganh hanh chinh cong” voi truong dhsg', '', '', ''),
('default_tin_tuc', 7, 'truong dai hoc sai gon to chuc  hoi nghi ve chuong trinh - giao trinh', '', '', ''),
('default_thong_bao', 0, 'Tối ưu hóa các tham số trong giải thuật chuyển giao mềm để tăng cường hiệu quả sử dụng tài nguyên vô tuyến trong hệ thống thông tin di động băng rộng CDMA', 'Tối ưu h&oacute;a c&aacute;c tham số trong giải thuật chuyển giao mềm để tăng cường hiệu quả sử dụng t&agrave;i nguy&ecirc;n v&ocirc; tuyến trong hệ thống th&ocirc;ng tin di động băng rộng CDMA', '', ''),
('default_hoi_thao', 16, 'doi moi noi dung chuong trinh va phuong phap dao tao giao vien  bac trung hoc co so', 'hoi thao khoa hoc\r\n	&ldquo;doi moi noi dung chuong tr&igrave;nh v&agrave;\r\n	phuong ph&aacute;p d&agrave;o tao gi&aacute;o vi&ecirc;n trung hoc co so&rdquo;\r\n\r\n	&nbsp;\r\n\r\n	&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; theo nghi quy', '', ''),
('default_tin_tuc', 8, 'thong bao moi tham gia hoi thao khoa hoc "nguyen dong chi - nha van hoa"', '', '', ''),
('default_thong_bao', 34, 'moi tham gia hoi thao khoa hoc "nguyen dong chi - nha van hoa"', '&nbsp;\r\n\r\n	&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;moi download phieu tham du hoi thao', '', ''),
('default_hoi_thao', 15, 'nghien cuu cac phuong phap giang day hieu qua  ky nang nghe va doc tieng anh', 'hoi thao khoa hoc\r\n\r\n	&ldquo;nghi&ecirc;n cuu c&aacute;c phuong ph&aacute;p giang day hieu qua\r\n\r\n	ky nang nghe v&agrave; doc tieng anh&rdquo;\r\n\r\n	&nbsp;\r\n\r\n	&nbsp; &nbsp; &nbsp; &nbsp; &nbsp;&nbsp;ng&agrave;y 22/08/2014, truo', '', ''),
('default_thong_bao', 35, 'ke hoach giang day thang 10 he cao hoc dai hoc vinh k22 (dot 2) va mau ly lich hoc vien cao hoc', '&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;&nbsp;bam v&agrave;o d&acirc;y de tai mau l&yacute; lich hoc vi&ecirc;n cao hoc\r\n\r\n	&nbsp;', '', ''),
('default_tin_tuc', 9, 'tuyen sinh sau dai hoc khoa 14.2 nam 2014 dai hoc sai gon', '', '', ''),
('default_hoi_thao', 1, 'cham soc suc khoe nguoi cao tuoi va nguoi tan tat', '', '', ''),
('default_hoi_thao', 2, 'giao duc mam non', '', '', ''),
('default_hoi_thao', 3, 'dao tao nghiep vu chuan hoa nganh tv-tt', '', '', ''),
('default_hoi_thao', 4, 'dao tao nguon nhan luc nganh vh-dl trong xu the hoi nhap va phat trien', '', '', ''),
('default_hoi_thao', 5, 'cham soc suc khoe nguoi cao tuoi va nguoi tan tat', '', '', ''),
('default_hoi_thao', 6, 'doi moi pp giang day dai hoc theo he thong tin chi', '', '', ''),
('default_hoi_thao', 7, 'phat trien va giu gin su trong sang cua tieng viet trong thoi ki hoi nhap quoc te hien nay', '', '', ''),
('default_hoi_thao', 8, 'hoi nghi vat li li thuyet toan quoc lan thu 35', '', '', ''),
('default_hoi_thao', 9, 'tap huan truy tap thong tin theo chu de', '', '', ''),
('default_hoi_thao', 10, 've nghien cuu phat trien va ung dung cong nghe xu li chat thai ran', '', '', ''),
('default_hoi_thao', 11, 'thuc tien giao duc mam non o viet nam va nhat ban hien nay', '', '', ''),
('default_hoi_thao', 12, 've nghien cuu phat trien va ung dung cong nghe xu li chat thai ran (lan 3)', '', '', ''),
('default_hoi_thao', 13, 'nhu cau su dung va dao tao nhan luc nghe bep viet tai tp. hcm', '', '', ''),
('default_hoi_thao', 14, 'danh gia 10 nam (2001 - 2010) xay dung nha nuoc phap quyen va nhung luan cu khoa hoc cho viec tiep tuc xay dung nha nuoc phap quyen xhcn viet nam  giai doan 2011-2020', '', '', ''),
('default_lien_ket', 17, 'phong dao tao', '', '', ''),
('default_lien_ket', 22, 'phong thiet bi - phuong tien day hoc', '', '', ''),
('default_lien_ket', 18, 'phong ke hoach - tai chinh', '', '', ''),
('default_lien_ket', 19, 'van phong truong dai hoc sai gon', '', '', ''),
('default_lien_ket', 20, 'phong to chuc can bo', '', '', ''),
('default_lien_ket', 21, 'phong cong tac hoc sinh - sinh vien', '', '', ''),
('default_qui_dinh', 6, 'qd 23 khcn sv (04-01)', '', '', ''),
('default_qui_dinh', 7, 'quy che khcn (28-12)', '', '', ''),
('default_qui_dinh', 8, 'quy che khcn sv (04-01)', '', '', ''),
('default_qui_dinh', 9, 'quy dinh 25 dang ki, bien soan gt (28-12)', '', '', ''),
('default_qui_dinh', 10, 'thong tin hoat dong kh cua tien si', '', '', ''),
('default_qui_dinh', 1, 'dai hoc sg 27 tuoi len 5 (14-12)', '', '', ''),
('default_qui_dinh', 2, 'ke hoach 5 nam (04-01) 26', '', '', ''),
('default_qui_dinh', 3, 'nhiem vu 24  khcn (29-12)', '', '', ''),
('default_de_tai', 382, 'giao trinh ky thuat vi xu ly', '', '', ''),
('default_qui_dinh', 5, 'qd 22quy che khcn (04-01)', '', '', ''),
('default_bieu_mau', 23, 'mau dang ky de tai nckh', '', '', ''),
('default_bieu_mau', 22, 'mau trinh bay bao cao nghiem thu', '', '', ''),
('default_bieu_mau', 21, 'mau bao cao tien do', '', '', ''),
('default_bieu_mau', 8, 'nhan xet cua phan bien', '', '', ''),
('default_bieu_mau', 9, 'phieu danh gia nghiem thu de tai nckh cap truong', '', '', ''),
('default_loai_bieu_mau', 8, 'giao trinh', '', '', ''),
('default_bieu_mau', 20, 'phieu dang ky viet giao trinh', '', '', ''),
('default_bieu_mau', 26, 'mau danh sach cong nhan hoan thanh nckh', '', '', ''),
('default_bieu_mau', 14, 'phieu tham dinh giao trinh 11.1', '', '', ''),
('default_bieu_mau', 15, 'ban nhan xet giao trinh 10.1', '', '', ''),
('default_bieu_mau', 16, 'bien ban buoi bao ve giao trinh', '', '', ''),
('default_bieu_mau', 17, 'ban dang ky xet thuong cong trinh khoa hoc', '', '', ''),
('default_bieu_mau', 19, 'ly lich khoa hoc', '', '', ''),
('default_loai_bieu_mau', 0, 'xxxxx', '', '', ''),
('default_lien_ket', 23, 'phong dao tao tai chuc va tu nghiep giao vien', '', '', ''),
('default_lien_ket', 24, 'phong khao thi va dam bao chat luong giao duc', '', '', ''),
('default_lien_ket', 25, 'phong quan he doanh nghiep', '', '', ''),
('default_lien_ket', 26, 'phong thanh tra', '', '', ''),
('default_lien_ket', 27, 'phong hop tac quoc te', '', '', ''),
('default_lien_ket', 28, 'ban ha tang va xay dung co ban', '', '', ''),
('default_lien_ket', 29, 'khoa su pham khtn', '', '', ''),
('default_lien_ket', 30, 'khoa toan - ung dung', '', '', ''),
('default_lien_ket', 31, 'khoa su pham khxh', '', '', ''),
('default_lien_ket', 32, 'khoa giao duc tieu hoc', '', '', ''),
('default_lien_ket', 33, 'khoa giao duc mam non', '', '', ''),
('default_lien_ket', 34, 'khoa su pham ky thuat', '', '', ''),
('default_lien_ket', 35, 'khoa ngoai ngu', '', '', ''),
('default_lien_ket', 36, 'khoa my thuat', '', '', ''),
('default_lien_ket', 37, 'khoa nghe thuat', '', '', ''),
('default_lien_ket', 38, 'khoa cong nghe thong tin', '', '', ''),
('default_lien_ket', 39, 'khoa quan tri kinh doanh', '', '', ''),
('default_lien_ket', 40, 'khoa thu vien - van phong', '', '', ''),
('default_lien_ket', 41, 'khoa van hoa du lich', '', '', ''),
('default_lien_ket', 42, 'khoa tai chinh - ke toan', '', '', ''),
('default_lien_ket', 43, 'khoa khoa hoc moi truong', '', '', ''),
('default_lien_ket', 44, 'khoa giao duc', '', '', ''),
('default_lien_ket', 45, 'khoa giao duc chinh tri', '', '', ''),
('default_lien_ket', 46, 'khoa luat', '', '', ''),
('default_lien_ket', 47, 'khoa dien tu vien thong', '', '', ''),
('default_lien_ket', 48, 'bo mon giao duc quoc phong - an ninh va giao duc the chat', '', '', ''),
('default_lien_ket', 49, 'trung tam tin hoc', '', '', ''),
('default_lien_ket', 50, 'trung tam hoc lieu', '', '', ''),
('default_lien_ket', 51, 'trung tam ngoai ngu', '', '', ''),
('default_lien_ket', 52, 'trung tam my thuat - ung dung', '', '', ''),
('default_lien_ket', 53, 'trung tam thong tin truyen thong va phat trien giao duc', '', '', ''),
('default_lien_ket', 54, 'trung tam ky thuat tai nguyen moi truong', '', '', ''),
('default_lien_ket', 55, 'trung tam dich vu du lich', '', '', ''),
('default_lien_ket', 56, 'truong trung hoc thuc hanh sai gon', '', '', ''),
('default_lien_ket', 57, 'bo khoa hoc va cong nghe', '', '', ''),
('default_lien_ket', 58, 'so khoa hoc cong nghe tp.hcm', '', '', ''),
('default_lien_ket', 59, 'vien cong nghe - bo cong thuong', '', '', ''),
('default_lien_ket', 60, 'vien han lam khoa hoc va cong nghe viet nam', '', '', ''),
('default_lien_ket', 61, 'lien hiep cac hoi khoa hoc va ky thuat viet nam', '', '', ''),
('default_lien_ket', 62, 'vien cong nghe ha noi', '', '', ''),
('default_loai_bieu_mau', 9, 'de tai nckh', '', '', ''),
('default_loai_bieu_mau', 10, 'giao trinh', '', '', ''),
('default_de_tai', 297, 'nghien cuu che tao chitosan khoi luong phan tu thap co hoat tinh khang khuan', '', '', ''),
('default_de_tai', 298, 'xay dung co so du lieu dna vung cr (control region) cua dna ty the cho (canis familiaris)', '', '', ''),
('default_de_tai', 299, 'nghien cuu giai trinh tu vung cr genome ty the cho phu quoc (canis familiaris) de xac dinh moi quan he di truyen giua 2 giong cho lung co xoay phu quoc va thai lan', '', '', ''),
('default_de_tai', 300, 'xay dung co so du lieu mot so loai thuc vat bac cao tai huyen ninh hai – tinh ninh thuan', '', '', ''),
('default_de_tai', 301, 'phan lap, tuyen chon, dinh danh cac vi khuan noi sinh trong cay ngo (zea mays l.) trong tren vung dat xam vung dong nam bo co kha nang co dinh dam va hoa tan lan', '', '', ''),
('default_de_tai', 302, 'xay dung bo tu lieu ho tro day hoc hoc phan phuong phap day hoc sinh hoc thpt 2 cho sinh vien truong dhsg', '', '', ''),
('default_de_tai', 303, 'danh gia nang luc ung dung cong nghe thong tin cua sinh vien nganh su pham truong dai hoc sai gon trong thiet ke bai day sinh hoc', '', '', ''),
('default_don_vi', 25, 'phong quan li khoa hoc va sau dai hoc', '', '', ''),
('default_don_vi', 61, 'trung tam thong tin truyen thong va phat trien giao duc truong dai hoc sai gon', '', '', ''),
('default_de_tai', 304, 'dac diem tho thieu nhi o tp.ho chi minh sau 1975', '', '', ''),
('default_de_tai', 305, 'tri nhan nghiem than – tu li thuyet den nghien cuu tren thuc tien tieng viet', '', '', ''),
('default_de_tai', 306, 'so sanh qua trinh truyen ba ngon ngu cua thuc dan anh o an do va thuc dan phap o viet nam', '', '', ''),
('default_de_tai', 307, 'chu nghia thuc dan: lich su va he qua (truong hop thuc dan phap o dong duong the ky xix-xx)', '', '', ''),
('default_ho_so', 17, 'don xin di hoc theo dot doi voi hoc vien cao hoc', '', '', ''),
('default_loai_bieu_mau', 4, 'dang ky - xet duyet', '', '', ''),
('default_de_tai', 308, 'doi moi kiem tra danh gia theo huong tiep can nang luc trong day hoc dia li 10 - thpt', '', '', ''),
('default_ho_so', 16, 'ban cam ket danh cho hoc vien cao hoc', '', '', ''),
('default_ho_so', 15, 'don xin di hoc cao hoc', '', '', ''),
('default_ho_so', 14, 'don xin di thi cao hoc', '', '', ''),
('default_ho_so', 13, 'quy trinh di hoc cao hoc', '', '', ''),
('default_noi_dung_cong_tac', 3, '', '08g30 (klf): nghiem thu de tai nckh cap truong “ap dung chu trinh kolb trong day hoc mon thien van hoc dai cuong tai truong dai hoc sai gon” do ts. vo thanh lam lam chu nhiem. ma so: cs2013-01', '', ''),
('default_noi_dung_cong_tac', 2, '', '07g45 (phong hop bgh): lam viec voi doan dai bieu quoc hoi va hoi dong nhan dan tp.hcm', '', ''),
('default_noi_dung_cong_tac', 4, '', '08g00 (klf): nghiem thu giao trinh "toan roi rac".  chu bien: ts. nguyen hoa. ma so: gt2013-10', '', ''),
('default_noi_dung_cong_tac', 5, '', '08g30 (phong hop ban giam hieu) : hop ban to chuc hoi thao khoa hoc: “doi moi chuong trinh dao tao nganh giao duc chinh tri va giao duc cong dan”', '', ''),
('default_bieu_mau', 18, 'ly lich khoa hoc cua tien si', '', '', ''),
('default_thong_bao', 38, 'thong bao ve dien dan "nhung ngay khoa hoc nga tai viet nam"', 'th&ocirc;ng b&aacute;o ve dien d&agrave;n &quot;nhung ng&agrave;y khoa hoc nga tai viet nam&quot;', '', ''),
('default_thong_bao', 39, 'thu moi viet bai hoi thao "day hoc tich hop va day hoc phan hoa o truong trung hoc"', 'thu moi viet b&agrave;i hoi thao &quot;day hoc t&iacute;ch hop v&agrave; day hoc ph&acirc;n h&oacute;a o truong trung hoc&quot;', '', ''),
('default_tin_tuc', 10, 'thong bao nop hoc phi dot 2 cao hoc khoa 21 dai hoc vinh', '', '', ''),
('default_de_tai', 309, 'nghien cuu nhan giong hoa lan dendrobium mini lai bang phuong phap nuoi cay in vitro', '', '', ''),
('default_bieu_mau', 24, 'danh sach gioi thieu thanh vien hoi dong', '', '', ''),
('default_bieu_mau', 25, 'bo sung thuyet minh de tai cap truong', '', '', ''),
('default_bieu_mau', 27, 'danh sach dang ky de tai nckh', '', '', ''),
('default_bieu_mau', 28, 'danh sach dang ky viet giao trinh - tltk', '', '', ''),
('default_loai_bieu_mau', 11, 'nghien cuu khoa hoc sinh vien', '', '', ''),
('default_thong_bao', 40, 'thu moi viet tham luan hoi thao quoc te "viet nam 40 nam (1975-2015): thong nhat, hoi nhap va phat trien"', '', '', ''),
('default_thong_bao', 41, 'thu moi viet bai cho hoi thao "nang cao vai tro cua co van hoc tap trong dao tao theo hoc che tin chi tai cac truong dai hoc - cao dang viet nam', '', '', ''),
('default_noi_dung_cong_tac', 6, '', '9g00 (klf): nghiem thu de tai nckh cap truong "khao sat xay dung he thong ky nang trong dao tao nghiep vu du lich cua khoa van hoa - du lich". chu nhiem de tai: ts. pham thi thu nga. ma so: cs2012 - 3', '', ''),
('default_noi_dung_cong_tac', 7, '', '09g00 (klf): nghiem thu de tai nckh cap truong "khao sat xay dung he thong ky nang trong dao tao nghiep vu du lich cua khoa van hoa - du lich". chu nhiem de tai: ts. pham thi thu nga. ma so: cs2012 - ', '', ''),
('default_noi_dung_cong_tac', 8, '', '15g00 (klf): nghiem thu de tai nckh cap truong “nghien cuu xu ly rom ra tren dong ruong bang mot so che pham sinh hoc” do ths. nguyen xuan du lam chu nhiem. ma so: cs2013-34.', '', ''),
('default_noi_dung_cong_tac', 9, '', '08g30 (phong hop bgh): hop ban to chuc hoi thao khoa hoc "doi moi chuong trinh dao tao nganh gdct va gdcd"', '', ''),
('default_noi_dung_cong_tac', 10, '', '14g00 (phong hop bgh): hop giao ban mo rong', '', ''),
('default_noi_dung_cong_tac', 11, '', '08g00 (hoi truong a): hoi nghi cbcc nam hoc 2014 – 2015', '', ''),
('default_de_tai', 310, 'nghien cuu su da dang cua chi tao hai roi alexandrium o vung bien ven bo tu ben tre den tra vinh', '', '', ''),
('default_don_vi', 15, 'khoa khoa hoc moi truong', '', '', ''),
('default_don_vi', 16, 'khoa giao duc', '', '', ''),
('default_de_tai', 311, 'danh gia rui ro ham luong kim loai nang (pb,cd, as, zn) trong rau muong o tp.hcm den suc khoe con nguoi', '', '', ''),
('default_de_tai', 312, 'danh gia rui ro ham luong ion cadimi, crom va chi trong rau rut (neptunia oleracea) va ngo sen (nelumbo nucifera) trong o tp.hcm', '', '', ''),
('default_de_tai', 313, 'khao sat su phu duong hoa va phat sinh doc to microcystin trong cac ao ho nuoi trong thuy san o tp.hcm', '', '', ''),
('default_de_tai', 314, 'anh huong cua cach bon phan dam den su phat thai khi n20 trong canh tac lua o dong bang song cuu long', '', '', ''),
('default_de_tai', 315, 'nghien cuu san xuat khi sinh hoc tu bun tuyen noi nha may che bien thuy san an my - an giang', '', '', ''),
('default_de_tai', 316, 'khao sat thanh phan hoa hoc cao cloroform va etyl acetat cua cay an dien lindley hedyotis lindleyana hook, ho ca phe rubiaceae', '', '', ''),
('default_de_tai', 317, 'danh gia hieu qua cua chuong trinh thi diem phan loai chat thai ran sinh hoat tai nguon tai phuong ben nghe, quan 1, tp.hcm (giai doan 1)', '', '', ''),
('default_de_tai', 318, 'nang cao kha nang thu thap y kien cong dong ve cong tac quan li moi truong kenh rach tai tp.hcm thong qua he thong cau hoi dien tu', '', '', ''),
('default_de_tai', 319, 'xay dung chuong trinh nang cao nhan thuc cong dong ve cong tac bao ve moi truong kenh rach tai tp.hcm', '', '', ''),
('default_de_tai', 320, 'nghien cuu ky thuat pho khoi luong cam ung plasma va ung dung vao kiem tra ham luong kim loai nang trong san pham chitosan duoc san xuat tai phong thi nghiem cua truong dhsg', '', '', ''),
('default_de_tai', 321, 'nghien cuu loai mau nuoc thai ca phe bang phuong phap keo tu dien hoa', '', '', ''),
('default_de_tai', 322, 'mo rong mo hinh co so du lieu quan he voi gia tri tap mo', '', '', ''),
('default_de_tai', 323, 'so sanh cac thuat toan phan loai anh so (image classification algorithms)', '', '', ''),
('default_de_tai', 324, 'giai quyet bai toan dinh tuyen co rang buoc bang thong va do tre trong mang toc do cao', '', '', ''),
('default_thong_bao', 42, 'thong bao ve viec moi viet bai tham gia hoi thao khoa hoc: “doi moi chuong trinh dao tao nganh giao duc chinh tri va giao duc cong dan”', 'hien nay, chuong tr&igrave;nh d&agrave;o tao ng&agrave;nh gi&aacute;o duc ch&iacute;nh tri v&agrave; ng&agrave;nh gi&aacute;o duc c&ocirc;ng d&acirc;n o c&aacute;c truong dai hoc v&agrave; cao dang d&atilde; c&oacute; nhieu d', '', ''),
('default_tin_tuc', 11, 'thong bao ve viec moi viet bai tham gia hoi thao khoa hoc: “doi moi chuong trinh dao tao nganh giao duc chinh tri va giao duc cong dan”', '', '', ''),
('default_de_tai', 325, 'trien khai tong dai dien thoai tren kien truc arm (implement voice over ip service to arm architech)', '', '', ''),
('default_de_tai', 326, 'cai tien phuong phap du doan dau lien ket trong mang xa hoi co dau', '', '', ''),
('default_de_tai', 327, 'giai phap nang cao chat luong dao tao cac lop chuyen tin tai truong thth sai gon', '', '', ''),
('default_de_tai', 328, 'thiet ke va che tao cac bo thi nghiem dien tu so', '', '', ''),
('default_de_tai', 329, 'thiet ke va che tao cac bo thi nghiem dien tu', '', '', ''),
('default_de_tai', 330, 'thiet ke chuong trinh mo phong hoc phan xu ly so tin hieu bang matlab', '', '', ''),
('default_de_tai', 331, 'thiet ke va che tao he thong giam sat, dieu khien tu dong nha tram vien thong khong nguoi truc', '', '', ''),
('default_de_tai', 332, 'nghien cuu giai thuat dieu khien nang cao may phat dien gio khong dong bo ba pha nguon kep ket noi voi luoi dien gio ba pha khong can bang', '', '', ''),
('default_de_tai', 333, 'chinh hoa bai toan parabolic nguoc voi he so dan nhiet bi nhieu', '', '', ''),
('default_de_tai', 334, 'luat manh so lon doi voi cac bien ngau nhien co cau truc phu thuoc', '', '', ''),
('default_bieu_mau', 29, 'mau dang ky hoat dong nckh cap khoa', '', '', ''),
('default_de_tai', 335, 'bai toan gia tri bien cho phuong trinh vi phan cap mot', '', '', ''),
('default_de_tai', 336, 'ung dung kinh te luong trong bai toan uoc luong nang suat cac yeu to tong hop va xem xet su hoi tu theo cap do co so trong nganh det may viet nam giai doan 2000-2011', '', '', ''),
('default_de_tai', 337, 'modun cheo aben va pham tru picard chat che', '', '', ''),
('default_de_tai', 338, 'nghiem toi uu va nghiem toi uu xap xi cua bai toan toi uu khong loi va co vo han rang buoc', '', '', ''),
('default_de_tai', 339, 'thuc trang muc do tuong tac tren lop giua giang vien va sinh vien truong dai hoc sai gon', '', '', ''),
('default_de_tai', 340, 'quan li thuc tap chuyen mon trong dao tao cu nhan quan li giao duc tai truong dai hoc sai gon', '', '', ''),
('default_de_tai', 341, 'danh gia ket qua day hoc theo du an trong hoc phan van hoa am thuc, nganh su pham kinh te gia dinh, truong dai hoc sai gon', '', '', ''),
('default_don_vi', 43, 'phong thiet bi va phuong tien day hoc', '', '', ''),
('default_don_vi', 51, 'bm giao duc quoc phong - an ninh va giao duc the chat', '', '', ''),
('default_de_tai', 342, 'xay dung cong cu danh gia nang luc nghien cuu khoa hoc cua giang vien truong dhsg', '', '', ''),
('default_de_tai', 343, 'xay dung cong cu truc tuyen lay y kien phan hoi tu nguoi hoc ve hoat dong giang day cua giang vien', '', '', ''),
('default_de_tai', 344, 'danh gia muc do dap ung cong viec cua sv tot nghiep (nghien cuu khoi nganh kinh te tai truong dai hoc sai gon)', '', '', ''),
('default_nguoi_dung', 2, 'hung', '', '', ''),
('default_de_tai', 345, 'ung dung ly thuyet he thong vao xay dung mo hinh van hoa chat luong tai truong dai hoc sai gon', '', '', ''),
('default_de_tai', 346, 'xay dung chuong trinh phat trien giao duc o truong dhsg', '', '', ''),
('default_thong_bao', 47, 'thong bao ve viec doi ngay hoc chuyen doi, on thi va tuyen sinh cac lop cao hoc k14.2 truong dai hoc sai gon nam 2014', 'lich hoc chuyen doi:&nbsp;tu 08/11 den 30/11/2014.\r\n		\r\n			&ocirc;n thi:&nbsp;tu 01/12 den 26/12/2014.\r\n		\r\n			ng&agrave;y thi du kien:&nbsp;27, 28/12/2014\r\n	\r\n\r\n\r\n	&nbsp;', '', ''),
('default_de_tai', 347, 'thiet ke cac tro choi nang cao kha nang sang tao cho tre mau giao trong hoat dong ve bang mau nuoc', '', '', '');
INSERT INTO `search` (`type`, `id`, `title`, `description`, `keywords`, `hidden`) VALUES
('default_de_tai', 348, 'thuc trang tinh tich cuc trong hoat dong the duc the thao cua sv truong dai hoc sai gon', '', '', ''),
('default_de_tai', 349, 'thuc trang nhan thuc cua sinh vien khoa gdmn ve van de can thiep som – giao duc hoa nhap tre khuyet tat trong truong mam non', '', '', ''),
('default_de_tai', 350, 'thuc trang giao vien mam non su dung thuc pham trong giao duc phat trien cho tre tu 24-48 thang', '', '', ''),
('default_de_tai', 351, 'thuc trang tinh tich cuc giao tiep cua tre mau giao 4-5 tuoi trong hoat dong kham pha khoa hoc o mot so truong mam non tai tp.hcm', '', '', ''),
('default_de_tai', 352, 'bien phap nang cao kha nang khai quat hoa cua tre mau giao 5-6 tuoi trong hoat dong lam quen voi moi truong xung quanh o mot so truong mam non tai tp.hcm', '', '', ''),
('default_de_tai', 353, 'hinh thanh cho sinh vien nganh giao duc tieu hoc ki nang bien doi cac tinh huong day hoc toan theo huong tang cuong hoat dong tim toi, phat hien kien thuc o hoc sinh', '', '', ''),
('default_de_tai', 354, 'boi duong ky nang day hoc tuc ngu, thanh ngu cho sinh vien nganh giao duc tieu hoc truong dai hoc sai gon', '', '', ''),
('default_de_tai', 355, 'phuong phap boi duong ky nang su dung tu han - viet cho sinh vien nganh giao duc tieu hoc truong dai hoc sai gon', '', '', ''),
('default_de_tai', 356, 'phap luat ve hanh vi canh tranh khong lanh manh cua mot so quoc gia tren the gioi va kinh nghiem cho viet nam', '', '', ''),
('default_de_tai', 357, 'phap luat ve cho thue lai lao dong va thuc tien ap dung', '', '', ''),
('default_de_tai', 358, 'nghien cuu hanh vi dieu chinh loi nhuan anh huong den chat luong bao cao tai chinh cua cac cong ty niem yet tai viet nam', '', '', ''),
('default_de_tai', 359, 'khao sat hien trang ap dung du toan ngan sach trong cac doanh nghiep vua va nho o tp.hcm hien nay', '', '', ''),
('default_de_tai', 360, 'tim hieu su tac dong cua khung hoang kinh te den viec day va hoc tai truong dhsg trong giai doan hien nay', '', '', ''),
('default_de_tai', 361, 'do luong va danh gia chat luong dich vu dao tao cua sv khoa quan tri kinh doanh truong dhsg', '', '', ''),
('default_de_tai', 362, 'anh huong cua suy thoai kinh te toan cau den tang truong kinh te tp.hcm (giai doan 2008-2013)', '', '', ''),
('default_de_tai', 363, 'dia danh trong he thong tuyen diem du lich tieu vung tay nam bo', '', '', ''),
('default_de_tai', 364, 'xay dung, khai thac va phat trien bo suu tap so cho nguon tai lieu xam tai tt hoc lieu truong dhsg', '', '', ''),
('default_nguoi_dung', 3, 'tan dat', '', '', ''),
('default_tin_tuc', 12, 'nghien cuu khoa hoc cap truong', '', '', ''),
('default_tin_tuc', 13, 'nghien cuu khoa hoc cap truong', '', '', ''),
('default_de_tai', 365, 'phong trao minh tan o nam ky dau the ky xx', '', '', ''),
('default_de_tai', 366, 'noi dung co ban va y nghia cua nhan thuc luan trong triet hoc phat giao', '', '', ''),
('default_de_tai', 367, 'qua trinh chuyen bien tu tuong chinh tri cua phan boi chau va y nghia lich su cua su chuyen bien do', '', '', ''),
('default_de_tai', 368, 'gia tri tu tu cua tu lay tuong thanh trong tieng viet (so sanh voi tieng anh)', '', '', ''),
('default_de_tai', 369, 'khao sat thuc trang trinh do tieng anh dau vao cua sv khong chuyen dhsg nien khoa 2014-2018', '', '', ''),
('default_de_tai', 370, 'am nhac the ki xx', '', '', ''),
('default_de_tai', 371, 'nghien cuu su phat trien the luc chung cua nu sinh vien truong dhsg nien khoa 2014-2015, sau khi ket thuc chuong trinh tu chon mon bong da, bong ro, bong chuyen co ban', '', '', ''),
('default_de_tai', 372, 'nghien cuu danh gia thuc trang va xay dung cac giai phap nang cao hieu qua cong tac giao duc the chat truong dhsg', '', '', ''),
('default_de_tai', 373, 'nghien cuu mot so bai tap bo tro phat trien suc nhanh trong chay cu ly ngan cho nu sv nam thu nhat truong dhsg', '', '', ''),
('default_de_tai', 374, 'danh gia su phat trien the luc cua hoc sinh trung hoc pho thong truong trung hoc thuc hanh sai gon qua chi so vo2max gian tiep va cuong do van dong', '', '', ''),
('default_de_tai', 375, 'nghien cuu vo2max gian tiep va cuong do van dong cua sinh vien nam thu nhat (2013-2014) truong dai hoc sai gon', '', '', ''),
('default_de_tai', 376, 'giao trinh vat ly chat ran', '', '', ''),
('default_de_tai', 377, 'giao trinh van hoc viet nam hien dai 2', '', '', ''),
('default_de_tai', 378, 'giao trinh co so lap trinh', '', '', ''),
('default_de_tai', 379, 'giao trinh xac suat va thong ke', '', '', ''),
('default_de_tai', 380, 'giao trinh giai tich loi va toi uu', '', '', ''),
('default_de_tai', 381, 'giao trinh ky thuat thong tin quang', '', '', ''),
('default_qui_dinh', 11, 'quy dinh ve viec hoc tap cua nghien cuu sinh truong dai hoc sai gon', '', '', ''),
('default_qui_dinh', 12, 'quy dinh ve dinh muc kinh phi nckh, bien soan giao trinh; khen thuong cbgv dat hoc vi, hoc ham va co cong trinh khoa hoc', '', '', ''),
('default_de_tai', 383, 'giao trinh an toan lao dong', '', '', ''),
('default_noi_dung_cong_tac', 12, '', '14h00 (klf): nghiem thu de tai nckh cap truong “nghien cuu lua chon, su dung mot so bai tap the duc (voi gay, voi bong) va tro choi van dong nhu mot hoc phan tu chon de phat trien the l', '', ''),
('default_noi_dung_cong_tac', 13, '', '08h00 (hb305): hoi thao khoa hoc “doi moi chuong trinh dao tao nganh giao duc chinh tri va giao duc cong dan”', '', ''),
('default_noi_dung_cong_tac', 14, '', '13h00 (klf): nghiem thu giao trinh “phuc chat trong hoa vo co” do pgs.ts. vo quang mai lam chu bien; ma so: gt2012-02', '', ''),
('default_noi_dung_cong_tac', 16, '', '14h15 (klf): nghiem thu de tai nckh cap truong “dieu che va thu hoat tinh quang xuc tac tio2 pha tap gadolini” do pgs.ts. vo quang mai lam chu nhiem; ma so: cs2013-04', '', ''),
('default_noi_dung_cong_tac', 17, '', '14h00 (phong hop a): nghiem thu de tai nckh cap truong “tim hieu cdio va thi diem trien khai xay dung chuan dau ra cho khoa cong nghe thong tin theo cach tiep can cdio” do ts. huynh minh tri lam chu nhi', '', ''),
('default_noi_dung_cong_tac', 18, '', '15h00 (phong d101): nghiem thu giao trinh  “giai tich 2” do pgs. ts. pham hoang quan lam chu bien; ma so: gt2012-03', '', ''),
('default_noi_dung_cong_tac', 19, '', '15h00 (phong d102): nghiem thu giao trinh  “tam ly hoc tre em 2” do ts. nguyen thi hong phuong lam chu bien; ma so: gt2013-07', '', ''),
('default_noi_dung_cong_tac', 20, '', '15h30 (klf): nghiem thu de tai nckh cap truong “khao sat thanh phan hoa hoc re cay an dien sat hedyotis pressa piere et pit, ho ca phe rubiaceae” do ts. pham nguyen kim tuyen lam chu nhiem; ma so: cs2013-33', '', ''),
('default_de_tai', 384, 'giao trinh truyen song va anten', '', '', ''),
('default_de_tai', 385, 'giao trinh cong tac dang va doan the trong nha truong', '', '', ''),
('default_de_tai', 386, 'giao trinh tai chinh doanh nghiep 1', '', '', ''),
('default_de_tai', 387, 'giao trinh ke toan chi phi', '', '', ''),
('default_de_tai', 388, 'giao trinh ke toan tai chinh 2', '', '', ''),
('default_de_tai', 389, 'giao trinh phan tich bao cao tai chinh doanh nghiep', '', '', ''),
('default_de_tai', 390, 'giao trinh nghiep vu thu ki van phong', '', '', ''),
('default_nguoi_dung', 4, 'leminhthien', '', '', ''),
('default_queue', 1, 'leminhthien', '', '', ''),
('default_thong_bao', 43, 'lich hoc va phong hoc trong thang 11 cac lop cao hoc khoa 22 dai hoc vinh', 'bam v&agrave;o d&acirc;y de tai lich hoc chi tiet', '', ''),
('default_thong_bao', 44, 'lich hoc va phong hoc trong thang 11 cac lop cao hoc khoa 22 dai hoc vinh', 'bam v&agrave;o d&acirc;y de tai lich hoc chi tiet', '', ''),
('default_thong_bao', 45, 'hoi thao lan thu nhat ve toan roi rac do vien nghien cuu cao cap ve toan phoi hop voi dai hoc nanyang to chuc', '&nbsp; &nbsp; &nbsp; &nbsp; tu ng&agrave;y 27/12 den 31/12/2014, vien nghi&ecirc;n cuu cao cap ve to&aacute;n phoi hop voi dai hoc nanyang de to chuc hoi thao lan thu nhat ve to&aacute;n roi rac. hoi thao', '', ''),
('default_thong_bao', 46, 'thong bao tuyen sinh cao hoc khoa 14.2 truong dai hoc sai gon nam 2014', '', '', ''),
('default_noi_dung_cong_tac', 25, '', '10g00 (klf): hoi dong nghiem thu de tai nckh cap truong: “bai toan gia tri dau cho chuong trinh vi phan dao ham rieng cap hai tu tham chieu” do ths. nguyen thi thanh lan lam chu nhiem ma so: cs2013-10', '', ''),
('default_noi_dung_cong_tac', 22, '', '08g00 (hoi truong a): sinh hoat chinh tri ky niem 45 nam thuc hien di chuc bac ho', '', ''),
('default_noi_dung_cong_tac', 23, '', '14g00 (hoi truong a): sinh hoat chinh tri ky niem 45 nam thuc hien di chuc bac ho', '', ''),
('default_noi_dung_cong_tac', 24, '', '10g00 (klf): hoi dong nghiem thu tai lieu: “phuong phap nghien cuu khoa hoc lich su ” do ts. pham phuc vinh lam chu bien\r\nma so: tl2013-01.', '', ''),
('default_thong_bao', 48, 'thong bao thoi khoa bieu hoc chuyen doi cao hoc khoa 14.2 truong dai hoc sai gon nam 2014, chuyen nganh: quan ly giao duc va tai chinh - ngan hang', 'thoi kho&aacute; bieu ng&agrave;nh quan l&yacute; gi&aacute;o duc\r\n\r\n	thoi kho&aacute; bieu ng&agrave;nh t&agrave;i ch&iacute;nh - ng&acirc;n h&agrave;ng', '', ''),
('default_nguoi_dung', 5, 'abc', '', '', ''),
('default_noi_dung_cong_tac', 26, '', '08g00 (klf): nghiem thu giao trinh: “ke toan quan tri” do ts. tran dinh phung lam chu bien. ma so: gt2013-17', '', ''),
('default_noi_dung_cong_tac', 27, '', '09g30 (phong d001): nghiem thu de tai nckh cap truong: “thuc trang su dung bien phap phat trien ki nang quan sat cho tre 5-6 tuoi trong hoat dong kham pha thien nhien o truong mam non” do ths. le thi', '', ''),
('default_noi_dung_cong_tac', 28, '', '08g30 (klf): nghiem thu de tai nckh cap truong: “nghien cuu dai so gia tu den lap luan mo va ung dung vao bai toan phan lop cac loai hoa” do ths. le ngoc hung lam chu nhiem. ma so: cs2011-15', '', ''),
('default_noi_dung_cong_tac', 29, '', '11g00 (phong hop b): chao mung ngay nha giao viet nam 20-11', '', ''),
('default_noi_dung_cong_tac', 30, '', '08g00 (phong hop a): bao ve luan van cao hoc nganh khoa hoc thu vien khoa 7 (chuong trinh lien ket dao tao giua truong dai hoc sai gon va truong dai hoc khxh&nv ha noi).\r\n\r\ntu ngay 22 den ngay 24', '', ''),
('default_loai_ho_so', 3, 'ho so xin di du hoi nghi / hoi thao', '', '', ''),
('default_ho_so', 8, 'quy trinh xin di du hoi nghi / hoi thao', '', '', ''),
('default_ho_so', 9, 'don xin di du hoi nghi / hoi thao', '', '', ''),
('default_thong_bao', 49, 'dang ky tham gia hoi thao cdio nam 2014 voi chu de "dao tao theo cdio: tu thi diem den dai tra"', 'bam v&agrave;o d&acirc;y de tai th&ocirc;ng b&aacute;o', '', ''),
('default_nguoi_dung', 6, 'huong', '', '', ''),
('default_thong_bao', 50, 'lich on thi tuyen sinh cao hoc dai hoc sai gon khoa 14.2 nam 2014', 'lich &ocirc;n thi ng&agrave;nh to&aacute;n giai t&iacute;ch\r\n\r\n	lich &ocirc;n thi ng&agrave;nh t&agrave;i ch&iacute;nh ng&acirc;n h&agrave;ng\r\n\r\n	lich &ocirc;n thi ng&agrave;nh ng&ocirc;n ngu hoc\r\n\r\n	lich &ocirc;n thi ng&agrave;nh quan l&y', '', ''),
('default_thong_bao', 51, 'thong bao lich thi cac mon chuyen doi cho tuyen sinh cao hoc dai hoc sai gon khoa 14.2 nam 2014', 'lich thi c&aacute;c m&ocirc;n chuyen doi cho tuyen sinh cao hoc kh&oacute;a 14.2', '', ''),
('default_danh_sach_lop', 1, 'danh sach hoc vien cao hoc khoa 22 thi bo sung tai truong dai hoc sai gon', 'bam v&agrave;o d&acirc;y de tai danh s&aacute;ch hoc vi&ecirc;n bo sung', '', ''),
('default_thong_bao', 52, 'danh sach hoc vien cao hoc thi bo sung va lich thi khoa 22  tai truong dai hoc sai gon', 'bam v&agrave;o d&acirc;y de tai danh s&aacute;ch bo sung\r\n\r\n	bam v&agrave;o d&acirc;y de tai lich thi', '', ''),
('default_thong_bao', 53, 'lich thi cao hoc vinh khoa 21', 'bam v&agrave;o d&acirc;y de tai lich thi', '', ''),
('default_thong_bao', 54, 'lich on thi tuyen sinh cao hoc dai hoc sai gon khoa 14.2 nam 2014 co chinh sua', 'lich &ocirc;n thi ng&agrave;nh to&aacute;n giai t&iacute;ch\r\n\r\n	lich &ocirc;n thi ng&agrave;nh t&agrave;i ch&iacute;nh ng&acirc;n h&agrave;ng\r\n\r\n	lich &ocirc;n thi ng&agrave;nh ng&ocirc;n ngu hoc\r\n\r\n	lich &ocirc;n thi ng&agrave;nh quan l&y', '', ''),
('default_thong_bao', 55, 'de cuong on thi cao hoc dai hoc sai gon khoa 14.2 nam 2014', 'de cuong &ocirc;n tap m&ocirc;n giai t&iacute;ch h&agrave;m\r\n\r\n	de cuong &ocirc;n tap m&ocirc;n giai t&iacute;ch v&agrave; dai so\r\n\r\n	de cuong &ocirc;n tap m&ocirc;n logic hoc\r\n\r\n	de cuong &ocirc;n tap m&ocirc;n ng&o', '', ''),
('default_nguoi_dung', 7, 'trung', '', '', ''),
('default_thong_bao', 56, 'thong bao ve viec nop hoc phi va kinh phi dao tao xa dot 3 cua hoc vien cao hoc khoa 21 (2013-2015) truong dai hoc vinh lien ket dao tao tai truong dai hoc sai gon', 'bam v&agrave;o d&acirc;y de tai th&ocirc;ng b&aacute;o', '', ''),
('default_thong_bao', 57, 'thong bao ve thi het mon cao hoc vinh khoa 21 va khoa 22 ngay 18, 19/12/2014', 'thoi gian hoc vi&ecirc;n tap trung:\r\n\r\n	&nbsp; &nbsp; &nbsp; &nbsp;- s&aacute;ng: 7 gio 30\r\n\r\n	&nbsp; &nbsp; &nbsp; &nbsp;- chieu: 13 gio 30\r\n\r\n	&nbsp; &nbsp; &nbsp; &nbsp;khi v&agrave;o ph&ograve;ng thi, hoc vi&ecirc;n phai xuat tr&igra', '', ''),
('default_noi_dung_cong_tac', 31, '', '14g00 (hoi truong a): giao luu giua sinh vien truong dai hoc sai gon va sinh vien truong dai hoc ngan han phuc loi suc khoe osaka nhat ban', '', ''),
('default_noi_dung_cong_tac', 32, '', '08h00 (klf): nghiem thu de tai nckh cap truong “phan mem quan li cong van khoa cong nghe thong tin” do ts. huynh minh tri lam chu nhiem.\r\nmsdt: cs2012-18', '', ''),
('default_noi_dung_cong_tac', 33, '', '08h00 (phong d003): nghiem thu de tai nckh cap truong “tim hieu thuc trang va giai phap nang cao hieu qua day hoc thuc hanh sinh hoc o thpt va thcs” do ths. hoang minh tam lam chu nhiem.\r\nmsdt: cs2012-09', '', ''),
('default_noi_dung_cong_tac', 34, '', '09h30 (phong d003): nghiem thu de tai nckh cap truong “hoan chinh, nang cao chuong trinh thuc tap nghien cuu thien nhien va ki nang thuc te thien nhien cho sinh vien nganh su pham sinh hoc” do ths. hoang mi', '', ''),
('default_noi_dung_cong_tac', 35, '', '10h00 (klf): nghiem thu tai lieu tham khao “cau truc du lieu va giai thuat” do ts. huynh minh tri lam chu bien.\r\nmsdt: tl2012-05', '', ''),
('default_noi_dung_cong_tac', 36, '', '07h00 (phongd201): thi tuyen sinh cao hoc khoa 14.2 nam 2014', '', ''),
('default_noi_dung_cong_tac', 40, '', '13h00 (phong d201): thi tuyen sinh cao hoc khoa 14.2 nam 2014', '', ''),
('default_noi_dung_cong_tac', 38, '', '06h00 (phong d201): thi tuyen sinh cao hoc khoa 14.2 nam 2014', '', ''),
('default_noi_dung_cong_tac', 39, '', '13h00 (phong d201): thi tuyen sinh cao hoc khoa 14.2 nam 2014', '', ''),
('default_noi_dung_cong_tac', 41, '', '08h45 (phong hop bgh): hop hoi dong tuyen sinh cao hoc khoa 14.2 nam 2014', '', ''),
('default_noi_dung_cong_tac', 42, '', '10h00 (phong hop bgh): hop ban coi thi va can bo coi thi tuyen sinh', '', ''),
('default_noi_dung_cong_tac', 43, '', '07g30 (phong hb305, hb406): hop ban cham thi va cham thi tuyen sinh cao hoc khoa 14.2 nam 2014', '', ''),
('default_noi_dung_cong_tac', 44, '', '07g30 (phong hb305, hb406): cham thi tuyen sinh cao hoc khoa 14.2 nam 2014', '', ''),
('default_thong_bao', 58, 'lich hoc va phong hoc cac lop cao hoc lien ket dai hoc vinh khoa 22 thang 1 nam 2015', 'bam v&agrave;o d&acirc;y de tai lich hoc', '', ''),
('default_thong_bao', 59, 'ket qua diem thi tuyen sinh cao hoc khoa 14.2 nam 2014', '&nbsp;\r\n\r\n	&nbsp;', '', ''),
('default_thong_bao', 60, 'thong bao tuyen sinh dao tao trinh do thac si dot 1 nam 2015 lien ket voi truong dai hoc vinh tai truong dai hoc sai gon', '', '', ''),
('default_thong_bao', 61, 'thong bao ket qua thi chinh thuc, diem chuan, phuc khao diem cua ky thi tuyen sinh va lich khai giang cao hoc khoa 14.2', '&nbsp;\r\n\r\n	\r\n		\r\n			\r\n				\r\n					ubnd tp. ho ch&iacute; minh\r\n				\r\n					truong dai hoc s&agrave;i g&ograve;n\r\n				\r\n					hoi dong tuyen sinh cao hoc\r\n				\r\n					\r\n			\r\n			\r\n				\r\n					&nbsp;&nbsp;&nbsp;&nbsp; cong h&ograve;a x&atilde', '', ''),
('default_thong_bao', 62, 'huong dan nhap hoc cao hoc khoa 14.2 nam 2014', '&nbsp; &nbsp; &nbsp;uy ban nh&acirc;n d&acirc;n&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&n', '', ''),
('default_thong_bao', 63, 'danh sach de tai nckh cap truong cua sinh vien nam hoc 2014-2015', '', '', ''),
('default_thong_bao', 64, 'lich thi ket thuc hoc phan cao hoc vinh khoa 21 va khoa 22 ngay 29, 30/01', 'bam v&agrave;o d&acirc;y de tai lich thi cao hoc kh&oacute;a 21\r\n\r\n	bam v&agrave;o d&acirc;y de tai lich thi cao hoc kh&oacute;a 22\r\n\r\n	bam v&agrave;o d&acirc;y de tai danh s&aacute;ch thi bo sung, thi lai kh&oacute;a 2', '', ''),
('default_nguoi_dung', 8, 'anh', '', '', ''),
('default_noi_dung_cong_tac', 45, '', '15g00 (klf): nghiem thu de tai nckh cap truong “xay dung mo hinh phat trien tap chi dai hoc sai gon” do ths. trinh viet toan lam chu nhiem. ma so: cs2013-61', '', ''),
('default_noi_dung_cong_tac', 46, '', '07g30 (hoi truong a): nhap hoc cac lop cao hoc k14.2', '', ''),
('default_noi_dung_cong_tac', 47, '', '09g00 (hoi truong a): khai giang cac lop cao hoc k14.2', '', ''),
('default_noi_dung_cong_tac', 48, '', '10g00 (hoi truong a): cao hoc k14.2 hoc quy che', '', ''),
('default_ho_so', 10, 'ly lich khoa hoc cua tien si', '', '', ''),
('default_ho_so', 12, 'thong tin khoa hoc ca nhan', '', '', ''),
('default_thong_bao', 65, 'thong bao cung cap thong tin khoa hoc ca nhan', '', '', ''),
('default_tin_tuc', 14, 'thong bao cung cap thong tin khoa hoc ca nhan', '', '', ''),
('default_tin_tuc', 15, 'quy dinh ve dinh muc kinh phi nghien cuu khoa hoc; bien soan giao trinh; khen thuong cbgv dat hoc vi, hoc ham va co cong trinh khoa hoc', '', '', ''),
('default_thong_bao', 66, 'quy dinh ve dinh muc kinh phi nghien cuu khoa hoc; bien soan giao trinh; khen thuong cbgv dat hoc vi, hoc ham va co cong trinh khoa hoc', '', '', ''),
('default_thong_bao', 67, 'thong bao ve viec thuong kinh phi de tai nckh cap truong (dot 1 nam 2015)', '', '', ''),
('default_tin_tuc', 16, 'thong bao ve viec thuong kinh phi de tai nckh cap truong (dot 1 nam 2015)', '', '', ''),
('default_bieu_mau', 30, 'don xin huy de tai nckh cap truong', '', '', ''),
('default_thong_bao', 68, 'lich hoc cao hoc khoa 14.2 mon triet hoc va tieng anh', 'bam v&agrave;o d&acirc;y de tai lich hoc ng&agrave;nh to&aacute;n - giai t&iacute;ch\r\n\r\n	bam v&agrave;o d&acirc;y de tai lich hoc ng&agrave;nh ng&ocirc;n ngu hoc\r\n\r\n	bam v&agrave;o d&acirc;y de tai lich hoc ng&agr', '', ''),
('default_thong_bao', 69, 'thong bao ve viec nhan dang ky nhiem vu nckh nam hoc 2015-2016', '', '', ''),
('default_tin_tuc', 17, 'thong bao ve viec nhan dang ky nhiem vu nckh nam hoc 2015-2016', '', '', ''),
('default_thong_bao', 70, 'danh sach tac gia/dong tac gia duoc thuong cong trinh khoa hoc dot  4', 'bam v&agrave;o d&acirc;y de tai danh s&aacute;ch', '', ''),
('default_tin_tuc', 18, 'danh sach tac gia/dong tac gia duoc thuong cong trinh khoa hoc dot  4', '', '', ''),
('default_thong_bao', 71, 'danh sach phong thi ket thuc hoc phan cao hoc vinh khoa 21 va khoa 22', 'hoc vi&ecirc;n xem ky danh s&aacute;ch ph&ograve;ng thi theo tung m&ocirc;n v&agrave; c&oacute; mat tai ph&ograve;ng thi d&uacute;ng thoi gian quy dinh\r\n\r\n	bam v&agrave;o d&acirc;y de tai danh s&aacute;ch du thi kho&aacute; 21\r\n\r', '', ''),
('default_noi_dung_cong_tac', 49, '', '09h00 (klf): nghiem thu de tai nckh cap truong “kinh te vi mo va bai tap” do ts. nguyen dinh luan lam chu nhiem. msdt: cs2011-57', '', ''),
('default_noi_dung_cong_tac', 50, '', '08h30 (klf): nghiem thu de tai nckh cap truong “xay dung phan mem quan li phong may bang web” do ths. huynh thang duoc lam chu nhiem.  msdt: cs2011-17', '', ''),
('default_ho_so', 11, 'ly lich khoa hoc', '', '', ''),
('default_thong_bao', 72, 'nhung dieu can biet danh cho hoc vien cao hoc vinh', 'bam v&agrave;o d&acirc;y de tai danh s&aacute;ch m&atilde; so hoc vi&ecirc;n', '', ''),
('default_nguoi_dung', 9, 'phong', '', '', ''),
('default_thong_bao', 73, 'lich hoc va phong hoc cac lop cao hoc lien ket dai hoc vinh khoa 22 thang 3 nam 2015', 'bam v&agrave;o d&acirc;y de tai lich hoc', '', ''),
('default_thong_bao', 74, 'ke hoach boi duong va thi chung chi tieng anh b1 cao hoc khoa 21 dai hoc vinh', 'tb', '', ''),
('default_thong_bao', 75, 'hoc phi va le phi lop boi duong tieng anh b1 cao hoc khoa 21', 'tb', '', ''),
('default_thong_bao', 76, 'thong bao moi tham gia hoi thao khoa hoc "40 nam dai thang mua xuan (30/04/1975) - nhin tu goc do lich su, van hoa"', 'bam v&agrave;o d&acirc;y de tai th&ocirc;ng b&aacute;o', '', ''),
('default_tin_tuc', 19, 'thong bao moi tham gia hoi thao khoa hoc "40 nam dai thang mua xuan (30/04/1975) - nhin tu goc do lich su, van hoa"', '', '', ''),
('default_nguoi_dung', 10, 'thanh mai', '', '', ''),
('default_thong_bao', 77, 'de cuong on thi tuyen sinh trinh do thac sy lien ket dai hoc vinh dot 1 nam 2015 (cap nhat)', 'tai de cuong &ocirc;n tap c&aacute;c m&ocirc;n:\r\n\r\n	\r\n		tieng anh\r\n	\r\n		gdct, ct_chu nghia xhkh\r\n	\r\n		gi&aacute;o duc hoc\r\n	\r\n		co so lthh v&agrave; cau tao chat\r\n	\r\n		ll&amp;ppdhbm vat l&yacute;\r\n	\r\n		l&yacute; luan van h', '', ''),
('default_thong_bao', 78, 'lich thi ket thuc hoc phan triet hoc va tieng anh cao hoc khoa 14.2', '.', '', ''),
('default_thong_bao', 79, 'thong bao ve viec hoc cac hoc phan bo sung kien thuc doi voi thi sinh du thi tuyen sinh cao hoc dot 1 nam 2015', '.', '', ''),
('default_nguoi_dung', 11, 'thuy', '', '', ''),
('default_thong_bao', 80, 'thong bao tuyen sinh sau dai hoc lien ket voi dai hoc vinh dot 1 nam 2015', '.', '', ''),
('default_thong_bao', 81, 'moi viet bai va tham gia hoi thao "phuong phap day hoc tich cuc trong giang day tieng anh o truong dai hoc, cao dang"', '.', '', ''),
('default_loai_ho_so', 1, 'ho so di hoc cao hoc', '', '', ''),
('default_loai_ho_so', 2, 'ho so di hoc nghien cuu sinh', '', '', ''),
('default_ho_so', 18, 'don xin di bao ve luan van thac si', '', '', ''),
('default_ho_so', 19, 'quy trinh di hoc nghien cuu sinh', '', '', ''),
('default_ho_so', 20, 'don xin du tuyen nghien cuu sinh', '', '', ''),
('default_ho_so', 21, 'don xin di hoc nghien cuu sinh', '', '', ''),
('default_ho_so', 22, 'ban cam ket danh cho nghien cuu sinh', '', '', ''),
('default_ho_so', 23, 'don xin di hoc tap trung theo dot doi voi nghien cuu sinh', '', '', ''),
('default_ho_so', 24, 'don xin di bao ve luan an tien si', '', '', ''),
('default_nguoi_dung', 12, 'nhut tai', '', '', ''),
('default_thong_bao', 82, 'danh sach phong thi ki thi ket thuc hoc phan triet hoc va anh van', 'tai danh s&aacute;ch ph&ograve;ng thi:\r\n\r\n	danh s&aacute;ch ph&ograve;ng thi m&ocirc;n tri&ecirc;t hoc\r\n\r\n	danh s&aacute;ch ph&ograve;ng thi m&ocirc;n anh van', '', ''),
('default_thong_bao', 83, 'thong bao hoi nghi khoa hoc quoc gia lan thu viii "nghien cuu co ban va ung dung cong nghe thong tin"', 'nham g&oacute;p phan th&uacute;c day nghi&ecirc;n cuu co ban v&agrave; ung dung ve c&ocirc;ng nghe th&ocirc;ng tin tai viet nam, li&ecirc;n hiep c&aacute;c hoi khoa hoc v&agrave; ky thuat viet&nbsp; nam, dai hoc qu', '', ''),
('default_tin_tuc', 20, 'thong bao hoi nghi khoa hoc quoc gia lan thu viii "nghien cuu co ban va ung dung cong nghe thong tin"', '', '', ''),
('default_de_tai', 391, 'ap dung chu trinh kolb trong day hoc mon thien van hoc dai cuong tai truong dai hoc sai gon', '', '', ''),
('default_de_tai', 392, 'nghien cuu su dung hydropeoxit cat mach chitosan trong dung dich o nhiet do phong de che tao oligochitosan', '', '', ''),
('default_de_tai', 393, 'nghien cuu hieu ung dong van h2o2/ buc xa gamma coban-60 de che tao chitosan khoi luong phan tu thap', '', '', ''),
('default_de_tai', 394, 'dieu che va thu hoat tinh quang xuc tac tio2 pha tap gadolini', '', '', ''),
('default_de_tai', 395, 'nghien cuu thanh phan loai va gioi han phan bo theo nong do muoi cua luong cu o khu du tru sinh quyen can gio - tp.hcm', '', '', ''),
('default_de_tai', 396, 'tim hieu su bien doi cua trinh tu protein shv trong qua trinh khang thuoc o vi khuan', '', '', ''),
('default_de_tai', 397, 'phan lap va tuyen chon vi khuan co dinh dam, hoa tan lan trong dat vung re cay ngo (zea mays) trong tren dat xam tinh tay ninh', '', '', ''),
('default_de_tai', 398, 'cai tien quy trinh lam tieu ban di truyen hoc o bac pho thong trung hoc', '', '', ''),
('default_de_tai', 399, 'xay dung bo tu lieu truc quan phuc vu giang day mon thuc hanh giai phau sinh li nguoi va dong vat', '', '', ''),
('default_de_tai', 400, 'bai toan gia tri dau cho phuong trinh vi phan dao ham rieng cap hai tu tham chieu', '', '', ''),
('default_de_tai', 401, 'phan lop cac pham tru picard phan bac va ung dung', '', '', ''),
('default_de_tai', 402, 'phan tich ung dung so lieu mang', '', '', ''),
('default_de_tai', 403, 'dieu kien can, du dat cuc tri va doi ngau trong bai toan toi uu vecto', '', '', ''),
('default_de_tai', 404, 'bai toan nhiet nguoc voi nguon nhiet phi tuyen', '', '', ''),
('default_de_tai', 405, 'toc do hoi tu va luat so lon doi voi mang cac bien ngau nhien', '', '', ''),
('default_de_tai', 406, 'phan tich moi quan he giua ty gia tien te va tang truong kinh te', '', '', ''),
('default_de_tai', 407, 'quan niem van chuong cua nguyen trai', '', '', ''),
('default_de_tai', 408, 'nghien cuu quy mo va co cau lao dong tai tp.hcm giai doan 1990 - 2012', '', '', ''),
('default_de_tai', 409, 'qua trinh "leo thang chien tranh" cua my tai viet nam (1954-1969)', '', '', ''),
('default_de_tai', 410, 'thuc trang kho khan trong cuoc song cua sinh vien nam thu nhat khoa gdmn - truong dhsg', '', '', ''),
('default_de_tai', 411, 'phat trien nang luc cam thu tho ca cho hoc sinh tieu hoc tu phuong dien ngon ngu', '', '', ''),
('default_de_tai', 412, 'thuc trang kho khan trong cuoc song cua sinh vien nam thu nhat khoa gdmn - truong dhsg', '', '', ''),
('default_de_tai', 413, 'thuc trang ky nang xu li tinh huong su pham cua giao vien mam non trong hoat dong giao duc tre mau giao 5-6 tuoi', '', '', ''),
('default_de_tai', 414, 'thuc trang ky nang giao tiep su pham cua giao vien mam non voi tre mg 3-6 tuoi trong hoat dong giao duc o 1 so truong mam non tai tp. hcm', '', '', ''),
('default_de_tai', 415, 'bien soan he thong tro choi nham phat trien ky nang am nhac  co ban cho tre mau giao 5-6 tuoi', '', '', ''),
('default_de_tai', 416, 'thuc trang hung thu hoc mon phuong phap cho tre lam quen tac pham van hoc cua sinh vien khoa giao duc mam non - truong dai hoc sai gon', '', '', ''),
('default_de_tai', 417, 'thuc trang su dung bien phap phat trien ki nang quan sat cho tre 5-6 tuoi trong hoat dong kham pha thien nhien o truong mam non', '', '', ''),
('default_de_tai', 418, 'nghien cuu phan vung chat luong nuoc song vam co dong', '', '', ''),
('default_de_tai', 419, 'buoc dau nghien cuu anh huong cua ngap ung do mua va trieu cuong den ho dan ngheo tai quan 8, tp.hcm', '', '', ''),
('default_de_tai', 420, 'thiet ke mo hinh xu ly nuoc thai y te quy mo nho cho cac phong kham tu nhan', '', '', ''),
('default_de_tai', 421, 'nghien cuu kha nang xu ly do mau nuoc thai det nhuom bang tio2', '', '', ''),
('default_de_tai', 422, 'nghien cuu kha nang xu ly hoi fomaldehyde bang tio2/uv', '', '', ''),
('default_de_tai', 423, 'khao sat thanh phan hoa hoc re cay an dien sat hedyotis pressa piere et pit., ho ca phe rubiaceae', '', '', ''),
('default_de_tai', 424, 'nghien cuu xu ly rom ra tren dong ruong bang mot so che pham sinh hoc', '', '', ''),
('default_de_tai', 425, 'nghien cuu nhan nuoi va su dung vi khuan quang hop phototrophic bacteria de xu ly chat huu co va h2s trong nuoc nuoi thuy san', '', '', ''),
('default_de_tai', 426, 'nghien cuu loai mot so mau nhuom trong nuoc thai nganh nhuom bang gum trich ly tu hat cay muong hoang yen', '', '', ''),
('default_de_tai', 427, 'xac dinh ham luong cadimi, chi, asen trong so huyet o mot so xa thuoc huyen can gio, thanh pho ho chi minh bang phuong phap icp-ms', '', '', ''),
('default_de_tai', 428, 'tao xung anh sang trang femto giay bang soi quang tinh the', '', '', ''),
('default_de_tai', 429, 'tu tuong nguyen an ninh ve ton giao, van hoa, khoa hoc dau the ky xx o viet nam', '', '', ''),
('default_de_tai', 430, 'mo rong csdl quan he de bieu dien va truy van thong tin khong chac chan', '', '', ''),
('default_de_tai', 431, 'tim hieu cdio va thi diem trien khai xay dung chuan dau ra cho khoa cntt theo cach tiep can cdio', '', '', ''),
('default_de_tai', 432, 'giai quyet bai toan dinh tuyen ki thuat luu luong trong mang toc do cao', '', '', ''),
('default_de_tai', 433, 'phan mem ho tro day hoc phan ma tran va dinh thuc trong mon toan dai so tuyen tinh', '', '', ''),
('default_de_tai', 434, 'cac nhan to tac dong den long trung thanh cua khach hang doi voi nhom san pham mang nhan hang rieng cua  sieu thi coop mart tai tp.hcm', '', '', ''),
('default_de_tai', 435, 'giao duc, pho bien phap luat trong sinh vien - hoc sinh truong dai hoc sai gon', '', '', ''),
('default_de_tai', 436, 'xay dung va su dung tinh huong trong giang day mon hoc luat to tung dan su', '', '', ''),
('default_thong_bao', 84, 'thoi khoa bieu hoc ki 1 cao hoc khoa 14.2 (cap nhat)', 'tai thoi kh&oacute;a bieu c&aacute;c m&ocirc;n co so c&aacute;c chuy&ecirc;n ng&agrave;nh cao hoc kh&oacute;a 14.2\r\n\r\n	thoi kh&oacute;a bieu chuy&ecirc;n ng&agrave;nh ng&ocirc;n ngu hoc\r\n\r\n	thoi kh&oacute;a bieu chuy&ecirc;n ng&agra', '', ''),
('default_de_tai', 437, 'chinh sach tien te anh huong den thi truong vang tai viet nam', '', '', ''),
('default_de_tai', 438, 'thiet ke website khoa dien tu vien thong', '', '', ''),
('default_de_tai', 439, 'nghien cuu phan mem thiet ke cua hang synopsys va cadance phuc vu thiet ke, mo phong vi mach so', '', '', ''),
('default_de_tai', 440, 'nghien cuu de xuat giai phap gop phan nang cao chat luong dao tao nham dat chuan dau ra cho cac nganh dao tao cua khoa dien tu vien thong', '', '', ''),
('default_de_tai', 441, 'cai bien cau trong tieng anh', '', '', ''),
('default_de_tai', 442, 'thiet ke noi dung dao tao mon li thuyet am nhac co ban cho dai hoc giao duc tieu hoc', '', '', ''),
('default_thong_bao', 85, 'thong bao so 1: hoi thao kh can bo tre cac truong dhsp toan quoc lan thu v - nam 2015 tai truong dai hoc su pham ha noi 2', 'noi tiep th&agrave;nh c&ocirc;ng cua&nbsp;hoi thao khoa hoc c&aacute;n bo tre c&aacute;c truong dai hoc su pham to&agrave;n quoc lan thu iv, truong dai hoc su pham h&agrave; noi 2 tien h&agrave;nh dang cai', '', ''),
('default_tin_tuc', 21, 'thong bao so 1: hoi thao kh can bo tre cac truong dhsp toan quoc lan thu v - nam 2015 tai truong dai hoc su pham ha noi 2', '', '', ''),
('default_de_tai', 443, 'am nhac the ki xix', '', '', ''),
('default_de_tai', 444, 'bao ve quyen con nguoi trong linh vuc hon nhan va gia dinh theo luat hon nhan va gia dinh hien hanh', '', '', ''),
('default_thong_bao', 86, 'thong bao tuyen sinh dao tao trinh do thac si khoa 15.1 nam 2015', '.', '', ''),
('default_de_tai', 445, 'thuc trang nhu cau tham van tam li cua sinh vien nam 1, nganh su pham, truong dhsg, giai doan 2013-2015.', '', '', ''),
('default_de_tai', 446, 'khao sat thuc trang nhu cau, dong co va kho khan cua sinh vien khi tham gia cac hoat dong the thao ngoai khoa tai truong dai hoc sai gon', '', '', ''),
('default_de_tai', 447, 'nghien cuu lua chon, su dung mot so bai tap the duc (voi gay, voi bong) va tro choi van dong nhu mot hoc phan tu chon  de phat trien the luc cho sinh vien nu truong dai hoc sai gon', '', '', ''),
('default_de_tai', 448, 'nghien cuu  xay dung tieu chuan the luc cho sinh vien truong dai hoc sai gon 2012-2013', '', '', ''),
('default_de_tai', 449, 'danh gia hieu qua cua viec ung dung chuong trinh giang day mon bong da futsal trong hoc phan tu chon nham phat trien the luc cho nu sinh vien truong dai hoc sai gon', '', '', ''),
('default_de_tai', 450, 'khao sat su hinh thanh va phat trien cua mo seo tu cat cat mong mo dau tam trang (morus alba l.) tren moi truong ms ran va long', '', '', ''),
('default_de_tai', 451, 'xay dung mo hinh phat trien tap chi dai hoc sai gon (giai doan tu 2013-2015)', '', '', ''),
('default_de_tai', 452, 'dieu chinh chuong trinh dao tao theo nhu cau thi truong lao dong', '', '', ''),
('default_de_tai', 453, 'tang cuong hieu qua he thong thong tin truong dai hoc sai gon', '', '', ''),
('default_de_tai', 454, 'nang cao hieu qua hoat dong thanh tra cac ki thi cua truong dai hoc sai gon', '', '', ''),
('default_thong_bao', 87, 'to chuc on thi tuyen sinh dao tao trinh do thac si lien ket dai hoc vinh tai truong dai hoc sai gon dot 1 nam 2015', 'i. lich &ocirc;n thi\r\n\r\n	&nbsp; &nbsp;- m&ocirc;n tieng anh: 27-29/3/2015;\r\n\r\n	&nbsp; &nbsp;- m&ocirc;n dai so: 30/3 -01/4/2015;\r\n\r\n	&nbsp; &nbsp;- m&ocirc;n giai t&iacute;ch, to&aacute;n cho h&oacute;a, to&aacute;n cho vat l&yacute;: 02/4-05', '', ''),
('default_de_tai', 455, 'giao trinh dai so dai cuong (phan 2)', '', '', ''),
('default_de_tai', 456, 'giao trinh ly thuyet so', '', '', ''),
('default_de_tai', 457, 'giao trinh giai tich ham nhieu bien', '', '', ''),
('default_nguoi_dung', 13, 'dinh hien', '', '', ''),
('default_nguoi_dung', 14, 'thuy tien', '', '', ''),
('default_nguoi_dung', 15, 'minh chi', '', '', ''),
('default_thong_bao', 88, 'thong bao lich on thi  mon tieng anh cao hoc lien ket dai hoc vinh', '- thoi gian hoc:\r\n\r\n	&nbsp; &nbsp;tu 27/3/2015 den 29/3/2015.&nbsp;\r\n\r\n	&nbsp; &nbsp;s&aacute;ng bat dau tu 07g30. chieu bat dau tu 13g30.\r\n\r\n	- ph&ograve;ng hoc: ph&ograve;ng d205 truong dai hoc s&agrave;i g&ograve;n 27', '', ''),
('default_thong_bao', 89, 'thong bao lan 2 ve viec to chuc va moi viet bai hoi thao khoa hoc quoc te thuong nien lan thu 32 cua hiep hoi kinh doanh pan-pacific', 'hiep hoi kinh doanh ch&acirc;u &aacute; - th&aacute;i b&igrave;nh duong (pan pacific business association) se phoi hop voi truong dai hoc kinh te quoc d&acirc;n to chuc hoi thao quoc te thuong ni&ecirc;n pan-pacifi', '', ''),
('default_tin_tuc', 22, 'thong bao lan 2 ve viec to chuc va moi viet bai hoi thao khoa hoc quoc te thuong nien lan thu 32 cua hiep hoi kinh doanh pan-pacific', '', '', ''),
('default_thong_bao', 90, 'thoi khoa bieu cac lop hoc bo sung kien thuc khoa 15.1', 'thoi kh&oacute;a bieu hoc bo sung kien thuc ng&agrave;nh t&agrave;i ch&iacute;nh - ng&acirc;n h&agrave;ng\r\n\r\n	thoi kh&oacute;a bieu hoc bo sung kien thuc ng&agrave;nh quan l&iacute; gi&aacute;o duc', '', ''),
('default_thong_bao', 91, 'thong bao lich thi va phong thi cap chung chi b1 cao hoc lien ket dai hoc vinh', 'lich thi cap chung chi b1\r\n\r\n	danh s&aacute;ch ph&ograve;ng thi', '', ''),
('default_thong_bao', 92, 'thong bao lich thi ket thuc hoc phan cao hoc lien ket dai hoc vinh khoa 22 ngay 23, 24/04/2015', 'lich thi ket th&uacute;c hoc phan', '', ''),
('default_thong_bao', 93, 'thoi khoa bieu hoc ki 1 cao hoc nganh quan li giao duc khoa 14.2', 'thoi kh&oacute;a bieu chuy&ecirc;n ng&agrave;nh quan l&iacute; gi&aacute;o duc\r\n\r\n	danh s&aacute;ch lop chuy&ecirc;n ng&agrave;nh quan l&iacute; gi&aacute;o duc', '', ''),
('default_thong_bao', 94, 'lich thi tuyen sinh sau dai hoc lien ket dai hoc vinh dot 1 nam 2015', '.', '', ''),
('default_thong_bao', 95, 'bang diem hoc phan triet hoc va tieng anh cac lop cao hoc k14.2', 'bang diem hoc phan triet hoc\r\n\r\n	bang diem hoc phan tieng anh', '', ''),
('default_thong_bao', 96, 'danh sach du thi ket thuc hoc phan dot 3 cao hoc lien ket dai hoc vinh khoa 22', 'tai danh s&aacute;ch', '', ''),
('default_thong_bao', 97, 'thoi khoa bieu cac lop hoc bo sung kien thuc chuyen nganh ngon ngu hoc khoa 15.1', '.', '', ''),
('default_thong_bao', 99, 'thong bao viet tham luan hoi thao khoa hoc "tin dung den tai tp. ho chi minh - thuc trang va giai phap"', 'thuc hien nhiem vu nghi&ecirc;n cuu khoa hoc nam 2015, trong khu&ocirc;n kho de t&agrave;i cap so khoa hoc c&ocirc;ng nghe tp.hcm: &quot;t&iacute;n dung den tai tp. ho ch&iacute; minh - thuc trang v&agrave; giai ph&a', '', ''),
('default_tin_tuc', 23, 'thong bao viet tham luan hoi thao khoa hoc "tin dung den tai tp. ho chi minh - thuc trang va giai phap"', '', '', ''),
('default_thong_bao', 100, 'thong bao viet bai hoi thao khoa hoc "quan ly nha nuoc ve hoi nhap quoc te trong linh vuc khoa hoc va cong nghe o viet nam - thuc trang va giai phap"', 'hoc vien h&agrave;nh ch&iacute;nh quoc gia co so tai th&agrave;nh pho ho ch&iacute; minh du kien to chuc hoi thao khoa hoc voi chu de &quot;quan l&yacute; nh&agrave; nuoc ve hoi nhap quoc te trong linh v', '', ''),
('default_tin_tuc', 24, 'thong bao viet bai hoi thao khoa hoc "quan ly nha nuoc ve hoi nhap quoc te trong linh vuc khoa hoc va cong nghe o viet nam - thuc trang va giai phap"', '', '', ''),
('default_thong_bao', 101, 'lich thi ket thuc hoc phan bo sung kien thuc du thi tuyen sinh cao hoc k15.1', '.', '', ''),
('default_thong_bao', 102, 'thong bao moi viet bai hoi thao "hoan thien he thong chi tieu ke hoach phat trien kinh te - xa hoi"', '&nbsp;&nbsp;', '', ''),
('default_tin_tuc', 25, 'thong bao moi viet bai hoi thao "hoan thien he thong chi tieu ke hoach phat trien kinh te - xa hoi"', '', '', ''),
('default_thong_bao', 103, 'thong bao moi viet bao cao va tham du hoi nghi khoa hoc quoc te "ky nghe tri thuc va he thong - kse 2015"', '&nbsp; &nbsp;', '', ''),
('default_tin_tuc', 26, 'thong bao moi viet bao cao va tham du hoi nghi khoa hoc quoc te "ky nghe tri thuc va he thong - kse 2015"', '', '', ''),
('default_thong_bao', 104, 'lich hoc cao hoc vinh khoa 22 thang 5', 'ke hoach giang day cao hoc k22 dot 1\r\n\r\n	ke hoac giang day cao hoc k22 dot 1 v&agrave; dot 2\r\n\r\n	lich hoc v&agrave; ph&ograve;ng hoc k22 th&aacute;ng 5 dot 1', '', ''),
('default_thong_bao', 105, 'ket qua thi tuyen sinh sau dai hoc lien ket dai hoc vinh dot 1 nam 2015', 'th&ocirc;ng b&aacute;o ph&uacute;c khao:\r\n\r\n	http://www.vinhuni.edu.vn/vinhuni/donvi/display/102/0/9833/donvi.htm', '', ''),
('default_nguoi_dung', 16, 'giao', '', '', ''),
('default_nguoi_dung', 17, 'thai', '', '', ''),
('default_thong_bao', 106, 'thoi khoa bieu on thi tuyen sinh cao hoc khoa 15.1 (cap nhat 7 chuyen nganh)', 'thoi kh&oacute;a bieu &ocirc;n thi tuyen sinh cao hoc k15.1 chuy&ecirc;n ng&agrave;nh van hoc viet nam\r\n\r\n	thoi kh&oacute;a bieu &ocirc;n thi tuyen sinh cao hoc k15.1 chuy&ecirc;n ng&agrave;nh ng&ocirc;n ngu hoc \r\n\r\n	thoi kh&oac', '', ''),
('default_thong_bao', 107, 'diem chuan thi tuyen sinh sau dai hoc dot 1 nam 2015 cao hoc lien ket dai hoc vinh', 'th&ocirc;ng b&aacute;o ve viec ph&uacute;c khao ket qua thi tuyen sinh cao hoc dot 1, nam 2015 truong dai hoc vinh', '', ''),
('default_tin_tuc', 27, 'thong bao moi viet bai hoi thao "qua trinh phat trien nha o cho nguoi thu nhap thap 30 nam qua tai tp.hcm - thuc trang va giai phap"', '', '', ''),
('default_thong_bao', 108, 'thong bao moi viet bai hoi thao "qua trinh phat trien nha o cho nguoi thu nhap thap 30 nam qua tai tp.hcm - thuc trang va giai phap"', 'moi c&aacute;c thay c&ocirc;, nh&agrave; nghi&ecirc;n cuu quan t&acirc;m viet b&agrave;i v&agrave; tham du hoi thao&nbsp;&quot;qu&aacute; tr&igrave;nh ph&aacute;t trien nh&agrave; o cho nguoi thu nhap thap 30 nam qua tai tp.hcm', '', ''),
('default_tin_tuc', 28, 'thong bao moi viet bai hoi thao khoa hoc quoc te "giao duc va toan cau hoa"', '', '', ''),
('default_thong_bao', 109, 'thong bao moi viet bai hoi thao khoa hoc quoc te "giao duc va toan cau hoa"', 'moi c&aacute;c thay c&ocirc;, nh&agrave; nghi&ecirc;n cuu quan t&acirc;m viet b&agrave;i v&agrave; tham du&nbsp;hoi thao khoa hoc quoc te &quot;gi&aacute;o duc v&agrave; to&agrave;n cau h&oacute;a&quot;', '', ''),
('default_tin_tuc', 29, 'thong bao moi viet bai hoi thao khoa hoc - cong nghe toan quoc ve co khi lan thu iv', '', '', ''),
('default_thong_bao', 110, 'thong bao moi viet bai hoi thao khoa hoc - cong nghe toan quoc ve co khi lan thu iv', 'moi c&aacute;c thay c&ocirc;, nh&agrave; nghi&ecirc;n cuu quan t&acirc;m viet b&agrave;i v&agrave; tham du&nbsp;hoi thao khoa hoc - c&ocirc;ng nghe to&agrave;n quoc ve co kh&iacute; lan thu iv', '', ''),
('default_thong_bao', 111, 'danh sach trung tuyen thi tuyen sinh sau dai hoc dot 1 nam 2015 cao hoc lien ket dai hoc vinh', '.', '', ''),
('default_nguoi_dung', 18, 'loan', '', '', ''),
('default_thong_bao', 112, 'quyet dinh trung tuyen - huong dan nhap hoc - mau ly lich hoc vien k23 cao hoc lien ket dai hoc vinh', 'quyet dinh tr&uacute;ng tuyen \r\n\r\n	huong dan nhap hoc\r\n\r\n	mau l&yacute; lich hoc vi&ecirc;n', '', ''),
('default_thong_bao', 113, 'thoi khoa bieu hoc phan giai tich phuc lop cao hoc toan giai tich k14.2', '.', '', ''),
('default_bieu_mau', 31, 'danh sach dang ky de tai', '', '', ''),
('default_bieu_mau', 32, 'de xuat hoi dong', '', '', ''),
('default_bieu_mau', 33, 'ban tom tat nckhsv', '', '', ''),
('default_bieu_mau', 34, 'bia bao cao tong ket', '', '', ''),
('default_bieu_mau', 35, 'bia phu nckhsv', '', '', ''),
('default_bieu_mau', 36, 'thuyet minh de tai nckhsv', '', '', ''),
('default_bieu_mau', 37, 'huong dan trinh baybao cao', '', '', ''),
('default_tin_tuc', 30, 'thong bao moi viet bai tham du hoi thao khoa hoc nam 2015 "gia tri va phuong phap giang day cac mon khoa hoc xa hoi trong nha truong pho thong"', '', '', ''),
('default_nguoi_dung', 19, 'nam', '', '', ''),
('default_thong_bao', 114, 'thong bao moi viet bai tham du hoi thao khoa hoc nam 2015 "gia tri va phuong phap giang day cac mon khoa hoc xa hoi trong nha truong pho thong"', '&nbsp;&nbsp;', '', ''),
('default_thong_bao', 115, 'ke hoach giang day thang 5 nam 2015 cac lop cao hoc lien ket dai hoc vinh k.23', '.', '', ''),
('default_thong_bao', 116, 'lich thi ket thuc hoc phan cao hoc k14.2 (nam 2015 dot 2)', '.', '', ''),
('default_tin_tuc', 31, 'thong bao viet tham luan cho hoi thao khoa hoc "nhung van de gioi va gia dinh o nam bo trong boi canh toan cau hoa"', '', '', ''),
('default_thong_bao', 117, 'thong bao viet tham luan cho hoi thao khoa hoc "nhung van de gioi va gia dinh o nam bo trong boi canh toan cau hoa"', '&nbsp; &nbsp;', '', ''),
('default_thong_bao', 118, 'tb doi phong hoc lop qlg1421 chuyen nganh quan ly giao duc (cap nhat: gv cho lop nghi)', 'ph&ograve;ng d&agrave;o tao sau dai hoc th&ocirc;ng b&aacute;o: \r\n\r\n	s&aacute;ng thu 7, ng&agrave;y 30/5/2015, lop cao hoc qlg1421 chuy&ecirc;n ng&agrave;nh quan l&yacute; gi&aacute;o duc nghi hoc (giang vi&ecirc;n b&aacute;o ngh', '', ''),
('default_thong_bao', 119, 'ket qua hoc bo sung kien thuc tham du ki thi tuyen sinh dao tao trinh do thac si khoa 15.1', '.', '', ''),
('default_thong_bao', 120, 'danh sach thi sinh du dieu kien tham du ki thi tuyen sinh dao tao trinh do thac si khoa 15.1', '.', '', ''),
('default_bieu_mau', 38, 'quy trinh to chuc va tien do trien khai hoat dong nghien cuu khoa hoc cua sinh vien nam hoc 2015-2016', '', '', ''),
('default_thong_bao', 121, 'lich thi tuyen sinh dao tao trinh do thac si khoa 15.1 nam 2015', '.', '', ''),
('default_thong_bao', 122, 'lich hoc cao hoc  lien ket dai hoc vinh khoa 22 thang 6 nam 2015', 'lich hoc chuy&ecirc;n ng&agrave;nh dai so v&agrave; l&yacute; thuyet so\r\n\r\n	lich hoc chuy&ecirc;n ng&agrave;nh gi&aacute;o duc hoc\r\n\r\n	lich hoc chuy&ecirc;n ng&agrave;nh h&oacute;a v&ocirc; co\r\n\r\n	lich hoc chuy&ecirc;n ng&agr', '', ''),
('default_nguoi_dung', 20, 'tuan', '', '', ''),
('default_nguoi_dung', 21, 'phi', '', '', ''),
('default_thong_bao', 123, 'danh sach phong thi ky thi ket thuc hoc phan cao hoc k14.2 (dot 2)', '.', '', ''),
('default_thong_bao', 124, 'phat hanh bang diem bo sung kien thuc ky thi tuyen sinh sau dai hoc khoa 15.1 nam 2015', '&nbsp; &nbsp;bang diem kh&oacute;a hoc bo sung kien thuc tham du ky thi tuyen sinh d&agrave;o tao tr&igrave;nh do thac si kh&oacute;a 15.1 nam 2015 d&atilde; bat dau duoc ph&aacute;t h&agrave;nh. anh chi hoc vi&e', '', ''),
('default_nguoi_dung', 22, 'sai gon', '', '', ''),
('default_tin_tuc', 32, 'thong bao nhan bai cong bo tren ban tin khoa hoc tre, so 01, nam 2015, issn 2354-1105', '', '', ''),
('default_thong_bao', 125, 'thong bao nhan bai cong bo tren ban tin khoa hoc tre, so 01, nam 2015, issn 2354-1105', '&nbsp;&nbsp;&nbsp;', '', ''),
('default_thong_bao', 126, 'lich thi ket thuc hoc phan cao hoc k14.2 dot 2 nam 2015', '.', '', ''),
('default_tin_tuc', 33, 'thong bao so 2 hoi nghi khoa hoc cong nghe toan quoc ve co khi lan thu iv', '', '', ''),
('default_thong_bao', 127, 'thong bao so 2 hoi nghi khoa hoc cong nghe toan quoc ve co khi lan thu iv', '&nbsp;&nbsp;&nbsp;', '', ''),
('default_bieu_mau', 39, 'trang bia truoc khi nghiem thu', '', '', ''),
('default_bieu_mau', 40, 'trang bia sau khi nghiem thu', '', '', ''),
('default_thong_bao', 128, 'ket qua tuyen sinh dao tao trinh do thac si khoa 15.1 nam 2015', 'ket qua tuyen sinh chuy&ecirc;n ng&agrave;nh ng&ocirc;n ngu hoc\r\n\r\n	ket qua tuyen sinh chuy&ecirc;n ng&agrave;nh to&aacute;n giai t&iacute;ch\r\n\r\n	ket qua tuyen sinh chuy&ecirc;n ng&agrave;nh t&agrave;i ch&iacute;nh - ng&acirc;n h&a', '', ''),
('default_thong_bao', 129, 'thong bao tuyen sinh cao hoc lien ket dai hoc vinh dot 2 nam 2015', '.', '', ''),
('default_thong_bao', 130, 'lich hoc cao hoc lien ket dai hoc vinh khoa 22 thang 7,8,9 nam 2015', 'lich hoc ng&agrave;nh ch&iacute;nh tri hoc\r\n\r\n	lich hoc ng&agrave;nh dai so v&agrave; l&yacute; thuyet so\r\n\r\n	lich hoc ng&agrave;nh gi&aacute;o duc hoc\r\n\r\n	lich hoc ng&agrave;nh h&oacute;a huu co\r\n\r\n	lich hoc ng&agr', '', ''),
('default_thong_bao', 131, 'quyet dinh va danh sach thi sinh trung tuyen dao tao trinh do thac si  khoa 15.1 nam 2015', '.', '', ''),
('default_thong_bao', 132, 'thong bao phuc khao ket qua thi tuyen sinh dao tao trinh do thac si khoa 15.1', '.', '', ''),
('default_thong_bao', 133, 'huong dan nhap hoc cao hoc khoa 15.1', 'mau l&yacute; lich hoc vi&ecirc;n cao hoc', '', ''),
('default_tin_tuc', 34, 'hoi thao khoa hoc lan i – nam 2015: “chien luoc phat trien cac truong dai hoc va ket qua nghien cuu khoa hoc” tai kien giang', '', '', ''),
('default_thong_bao', 134, 'hoi thao khoa hoc lan i – nam 2015: “chien luoc phat trien cac truong dai hoc va ket qua nghien cuu khoa hoc” tai kien giang', 'ph&ograve;ng quan l&yacute; khoa hoc th&ocirc;ng b&aacute;o den c&aacute;c giang vi&ecirc;n, cbvc ve hoi thao khoa hoc lan i &ndash; nam 2015: &ldquo;chien luoc ph&aacute;t trien c&aacute;c truong dai hoc v&agrave; ket', '', ''),
('default_tin_tuc', 35, 'thu moi viet tham luan hoi thao khoa hoc tu tuong ho chi minh voi su nghiep doi moi cua dan toc', '', '', ''),
('default_thong_bao', 135, 'thu moi viet tham luan hoi thao khoa hoc tu tuong ho chi minh voi su nghiep doi moi cua dan toc', '&nbsp; &nbsp;&nbsp;', '', ''),
('default_tin_tuc', 36, 'thu moi viet bai tham gia hoi thao khoa hoc "quan he viet nam va trung quoc trong boi canh moi"', '', '', ''),
('default_thong_bao', 136, 'thu moi viet bai tham gia hoi thao khoa hoc "quan he viet nam va trung quoc trong boi canh moi"', '&nbsp; &nbsp;', '', ''),
('default_tin_tuc', 37, 'thu moi viet bai tham luan hoi thao khoa hoc "hoat dong bao lanh tin dung cho doanh nghiep nho va vua tren dia ban tp.hcm"', '', '', ''),
('default_thong_bao', 137, 'thu moi viet bai tham luan hoi thao khoa hoc "hoat dong bao lanh tin dung cho doanh nghiep nho va vua tren dia ban tp.hcm"', '&nbsp; &nbsp;', '', ''),
('default_thong_bao', 138, 'thoi khoa bieu hoc ky 1 - dot 1, cao hoc khoa 15.1', 'thoi kh&oacute;a bieu nh&oacute;m chuy&ecirc;n ng&agrave;nh to&aacute;n giai t&iacute;ch, h&oacute;a huu co\r\n\r\n	thoi kh&oacute;a bieu chuy&ecirc;n ng&agrave;nh quan l&yacute; gi&aacute;o duc\r\n\r\n	thoi kh&oacute;a bieu nh&oacute;m chuy&', '', ''),
('default_thong_bao', 139, 'lich hoc bo sung kien thuc tuyen sinh cao hoc lien ket dai hoc vinh', '.', '', ''),
('default_thong_bao', 140, 'thoi khoa bieu hoc ky 2 - dot 1, cao hoc khoa 14.2', 'thoi kh&oacute;a bieu chuy&ecirc;n ng&agrave;nh ng&ocirc;n ngu hoc\r\n\r\n	thoi kh&oacute;a bieu chuy&ecirc;n ng&agrave;nh t&agrave;i ch&iacute;nh - ng&acirc;n h&agrave;ng&nbsp;(cap nhat ng&agrave;y 01/9/2015)\r\n\r\n	thoi kh&oacute;a bieu chu', '', ''),
('default_thong_bao', 141, 'quy dinh ve doi tuong uu tien tuyen sinh dao tao trinh do thac si khoa 15.2 nam 2015', '.', '', ''),
('default_thong_bao', 142, 'quy dinh ve doi tuong mien thi ngoai ngu tuyen sinh dao tao trinh do thac si khoa 15.2 nam 2015', '.', '', ''),
('default_thong_bao', 143, 'thong bao tuyen sinh dao tao trinh do thac si khoa 15.2 nam 2015', '.', '', ''),
('default_thong_bao', 144, 'lich thi ket thuc hoc phan hoc ky 1 dot 1, cao hoc khoa 15.1', '.', '', ''),
('default_tin_tuc', 38, 'danh sach chi tiet cac hoi dong xet duyet de tai nckh dot 1 nam hoc 2015-2016', '', '', ''),
('default_nguoi_dung', 23, 'minh tam', '', '', ''),
('default_thong_bao', 145, 'tb ve lich hoc hoc ky 2 nam hoc 2015-2016 va hoc phi dot 2 nam hoc 2014-2015', '.', '', ''),
('default_thong_bao', 146, 'thong bao tuyen sinh dao tao trinh do thac si khoa 15.2 nam 2015', '.', '', ''),
('default_tin_tuc', 39, 'thong bao so 1 hoi nghi khoa hoc toan quoc ve nghien cuu va giang day sinh hoc o viet nam lan thu hai thang 5 - 2016', '', '', ''),
('default_thong_bao', 147, 'de cuong on thi cao hoc vinh dot 2 nam 2015', 'de cuong &ocirc;n thi chuy&ecirc;n ng&agrave;nh ch&iacute;nh tri hoc\r\n\r\n	de cuong &ocirc;n thi chuy&ecirc;n ng&agrave;nh dai so v&agrave; l&yacute; thuyet so\r\n\r\n	de cuong &ocirc;n thi chuy&ecirc;n ng&agrave;nh gi&aacute;o duc', '', ''),
('default_thong_bao', 148, 'huong dan hoc vien cao hoc vinh truy cap tai khoan ca nhan tren trang web dai hoc vinh', '.', '', ''),
('default_nguoi_dung', 24, 'nga', '', '', ''),
('default_thong_bao', 149, 'thoi khoa bieu hoc bo sung kien thuc ky thi tuyen sinh dao tao trinh do thac si khoa 15.2', 'chuy&ecirc;n ng&agrave;nh quan l&yacute; gi&aacute;o duc', '', ''),
('default_thong_bao', 150, 'thoi khoa bieu hoc ky 1 - dot 2, cao hoc khoa 15.1', 'chuy&ecirc;n ng&agrave;nh t&agrave;i ch&iacute;nh - ng&acirc;n h&agrave;ng\r\n\r\n	chuy&ecirc;n ng&agrave;nh to&aacute;n giai t&iacute;ch&nbsp;(cap nhat 01/9/2015)\r\n\r\n	chuy&ecirc;n ng&agrave;nh lich su viet nam\r\n\r\n	chuy&ecirc;n ng&agrave;nh ng&oci', '', '');
INSERT INTO `search` (`type`, `id`, `title`, `description`, `keywords`, `hidden`) VALUES
('default_thong_bao', 151, 'thoi khoa bieu hoc bo sung kien thuc ky thi tuyen sinh dao tao trinh do thac si khoa 15.2', 'chuy&ecirc;n ng&agrave;nh quan l&yacute; gi&aacute;o duc&nbsp;(cap nhat ng&agrave;y 01/9/2015)\r\n\r\n	chuy&ecirc;n ng&agrave;nh t&agrave;i ch&iacute;nh - ng&acirc;n h&agrave;ng', '', ''),
('default_thong_bao', 152, 'thong bao tuyen sinh dao tao trinh do thac si khoa 15.2 nam 2015', '.', '', ''),
('default_nguoi_dung', 25, 'oanh', '', '', ''),
('default_bieu_mau', 41, 'don xin gia han de tai nckh', '', '', ''),
('default_thong_bao', 153, 'danh sach hoc vien du thi ky thi ket thuc hoc phan hoc ky 1 - dot 1, cao hoc khoa 15.1', 'chuy&ecirc;n ng&agrave;nh quan l&yacute; gi&aacute;o duc - lop qlg1511\r\n\r\n	chuy&ecirc;n ng&agrave;nh quan l&yacute; gi&aacute;o duc - lop qlg1512\r\n\r\n	chuy&ecirc;n ng&agrave;nh t&agrave;i ch&iacute;nh - ng&acirc;n h&agrave;ng\r\n\r\n	chuy&ecirc;n n', '', ''),
('default_thong_bao', 154, 'thong bao lich thi tuyen sinh cao hoc dot 2 nam 2015 cua dai hoc vinh', '.', '', ''),
('default_thong_bao', 155, 'thong bao ve ke hoach on thi tuyen sinh cao hoc vinh dot 2 nam 2015 tai truong dai hoc sai gon', '.', '', ''),
('default_thong_bao', 157, 'thong bao ve viec dang ky hoc lai doi voi hoc vien cao hoc khoa 14.2', 'th&ocirc;ng b&aacute;o ve viec dang k&yacute; hoc lai doi voi hoc vi&ecirc;n cao hoc kh&oacute;a 14.2\r\n\r\n	mau don dang k&yacute; hoc lai', '', ''),
('default_nguoi_dung', 26, 'chi', '', '', ''),
('default_thong_bao', 158, 'lich thi ket thuc hoc phan hoc ky 2 - dot 1, cao hoc khoa 14.2', '.', '', ''),
('default_nguoi_dung', 27, 'diem', '', '', ''),
('default_tin_tuc', 40, 'thu moi viet bai cho toa dam khoa hoc ve nang cao chat luong giang day cac mon ly luan chinh tri', '', '', ''),
('default_tin_tuc', 41, 'thong bao so 1 ve viec to chuc hoi thao quoc gia "boi duong nang luc cho giang vien cac truong su pham"', '', '', ''),
('default_nguoi_dung', 28, 'yen', '', '', ''),
('default_thong_bao', 159, 'thong bao ve viec nop hoc phi dot 2 cua hoc vien cao hoc vinh khoa 22', '.........', '', ''),
('default_thong_bao', 160, 'thoi khoa bieu on thi tuyen sinh dao tao trinh do thac si khoa 15.2', 'chuy&ecirc;n ng&agrave;nh quan l&yacute; gi&aacute;o duc', '', ''),
('default_thong_bao', 161, 'lich thi ket thuc hoc phan bo tuc kien thuc du thi tuyen sinh dao tao trinh do thac si khoa 15.2', '...............', '', ''),
('default_nguoi_dung', 29, 'tien', '', '', ''),
('default_nguoi_dung', 30, 'nhan', '', '', ''),
('default_nguoi_dung', 31, 'nhan', '', '', '');

-- --------------------------------------------------------

--
-- Table structure for table `searchtypes`
--

CREATE TABLE IF NOT EXISTS `searchtypes` (
  `type` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `title` varchar(255) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `enabled` tinyint(1) NOT NULL DEFAULT '1',
  `order` int(1) DEFAULT NULL,
  PRIMARY KEY (`type`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `searchtypes`
--

INSERT INTO `searchtypes` (`type`, `title`, `enabled`, `order`) VALUES
('default_bai_bao', 'Bài báo khoa học', 1, 5),
('default_bieu_mau', 'Biễu mẫu', 1, 7),
('default_chuong_trinh', 'Chương trình trọng điểm', 1, 9),
('default_de_tai', 'Đề tài khoa học', 1, 1),
('default_hoi_thao', 'Hội thảo - Hội nghị', 1, 4),
('default_qui_dinh', 'Qui Định', 1, 8),
('default_tai_lieu', 'Phổ biến kiến thức', 1, 6),
('default_thong_bao', 'Thông báo', 1, 3),
('default_tin_tuc', 'Sự kiện nổi bật', 1, 2);

-- --------------------------------------------------------

--
-- Table structure for table `setting`
--

CREATE TABLE IF NOT EXISTS `setting` (
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `value` longtext COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`name`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `setting`
--

INSERT INTO `setting` (`name`, `value`) VALUES
('cesti.info', '<h2 style="padding: 0px; margin: 0.35em 0px 0.8em; color: rgb(0, 0, 0); font-family: Arial, Helvetica, sans-serif; line-height: 18px; text-align: center;">\r\n	<span style="color:#0000ff;"><span style="font-size:26px;">CSDL ProQuest, CSDL SpringerLink, CSDL Wipsglobal, CSDL</span></span></h2>\r\n<h2 style="padding: 0px; margin: 0.35em 0px 0.8em; color: rgb(0, 0, 0); font-family: Arial, Helvetica, sans-serif; line-height: 18px; text-align: center;">\r\n	<span style="color:#0000ff;"><span style="font-size:26px;">Kết quả nghi&ecirc;n cứu Việt Nam, </span></span></h2>\r\n<h2 style="padding: 0px; margin: 0.35em 0px 0.8em; color: rgb(0, 0, 0); font-family: Arial, Helvetica, sans-serif; line-height: 18px; text-align: center;">\r\n	<span style="color:#0000ff;"><span style="font-size:26px;">CSDL kết quả nghi&ecirc;n cứuTP.HCM,&nbsp;</span></span><span style="font-size: 26px; color: rgb(0, 0, 255);">b&agrave;i tr&iacute;ch tiếng Việt</span></h2>\r\n<p style="padding: 0px; margin: 0.35em 0px 0.8em; color: rgb(0, 0, 0); font-family: Arial, Helvetica, sans-serif; line-height: 18px; text-align: center;">\r\n	&nbsp;</p>\r\n<p style="padding: 0px; margin: 0.35em 0px 0.8em; color: rgb(0, 0, 0); font-family: Arial, Helvetica, sans-serif; line-height: 18px;">\r\n	<span style="color: rgb(34, 34, 34); font-family: Arial; font-size: 13px;">&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;&nbsp;</span><span style="font-size: 20px;"><span style="font-family: ''Times New Roman'';"><span style="color: rgb(34, 34, 34);">&nbsp;</span><span style="color: rgb(34, 34, 34);">1. CSDL ProQuest, CSDL SpringerLink,&nbsp;CSDL Kết quả nghi&ecirc;n cứu Việt Nam, CSDL kết quả nghi&ecirc;n cứu TP.HCM, tạp ch&iacute; chuy&ecirc;n ng&agrave;nh KH&amp;CN</span></span></span></p>\r\n<div style="font-family: arial, sans-serif; font-size: 13px;">\r\n	<span style="font-size: 20px;"><span style="font-family: ''Times New Roman'';">&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; Truy cập tra cứu c&aacute;c CSDL th&ocirc;ng qua website của Trung t&acirc;m&nbsp;</span></span></div>\r\n<div style="font-family: arial, sans-serif; font-size: 13px;">\r\n	<strong><span style="font-size:20px;">http://www.cesti.gov.vn/trang-chu-thu-vien/</span></strong><strong><span style="font-size: 20px;"><span style="font-family: ''Times New Roman'';"> </span></span></strong><span style="font-size: 20px;"><span style="font-family: ''Times New Roman'';">với t&agrave;i khoản v&agrave; mật khẩu:&nbsp;<strong>dhsg</strong></span></span></div>\r\n<div style="font-family: arial, sans-serif; font-size: 13px;">\r\n	&nbsp;</div>\r\n<div style="font-family: arial, sans-serif; font-size: 13px;">\r\n	<div>\r\n		<span style="font-size: 20px;"><span style="font-family: ''Times New Roman'';">&nbsp; &nbsp; &nbsp; &nbsp; 2. CSDL IEEE truy cập th&ocirc;ng qua link:</span></span></div>\r\n	<div>\r\n		<strong><font face="Arial" size="2"><span style="line-height: 16.8666667938232px; font-family: Calibri, sans-serif; font-size: 11pt;"><span style="font-size: 20px;"><span style="font-family: ''Times New Roman'';"><span style="line-height: 19.9333343505859px;">http://ieeexplore.ieee.org.</span></span></span></span></font></strong><font face="Arial"><span style="line-height: 16.8666667938232px; font-family: Calibri, sans-serif; font-size: 11pt;"><span style="line-height: 19.9333343505859px; font-family: ''Times New Roman'', serif; font-size: 13pt;"><wbr /><strong><span style="font-size: 20px;"><span style="font-family: ''Times New Roman'';">dbonline.cesti.gov.vn/Xplore/</span></span></strong><wbr /></span></span></font><strong><span style="font-size: 20px;"><font face="Arial"><span style="line-height: 16.8666667938232px; font-family: Calibri, sans-serif;"><span style="font-family: ''Times New Roman'';"><span style="line-height: 19.9333343505859px;">home.jsp</span></span></span><span style="font-family: ''Times New Roman'';"><span style="line-height: 19.9333343505859px;">&nbsp;</span></span></font></span></strong></div>\r\n	<div>\r\n		<span style="font-size: 20px;"><font face="Arial"><span style="font-family: ''Times New Roman'';"><span style="line-height: 19.9333343505859px;">&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; với t&agrave;i khoản v&agrave; mật khẩu:&nbsp;<strong>dhsgieee</strong></span></span></font></span></div>\r\n	<div>\r\n		&nbsp;</div>\r\n	<div>\r\n		<span style="font-size: 20px;"><span style="font-family: ''Times New Roman'';">&nbsp; &nbsp; &nbsp; V</span></span><span style="text-align: justify; font-size: 20px;"><span style="font-family: ''Times New Roman'';">ới t&agrave;i liệu tiếng Việt xem online kh&ocirc;ng được download về m&aacute;y (cần download t&agrave;i liệu n&agrave;o&nbsp;trường m&igrave;nh&nbsp;vui l&ograve;ng gửi mail về địa chỉ&nbsp;</span></span><strong style="text-align: justify;"><span style="font-size: 20px;"><span style="font-family: ''Times New Roman'';">&nbsp;<a href="mailto:thuanhth@cesti.gov.vn" style="text-decoration: none; outline: none; color: rgb(0, 120, 159); padding: 5px 20px 5px 0px; background: url(http://www.sgu.edu.vn/templates/jsn_epic_pro/images/icon-link-mailto.png) 100% 50% no-repeat transparent;">thuanhth@cesti.gov.vn</a>&nbsp;</span></span></strong><span style="text-align: justify; font-size: 20px;"><span style="font-family: ''Times New Roman'';">, Trung t&acirc;m</span></span><span style="text-align: justify; font-size: 20px;"><span style="font-family: ''Times New Roman'';">&nbsp;</span></span><span style="text-align: justify; font-family: ''Times New Roman''; font-size: 20px;">sẽ gửi to&agrave;n văn hỗ trợ miễn ph&iacute;.)</span></div>\r\n	<div align="justify">\r\n		<span style="font-size: 20px;"><span style="font-family: ''Times New Roman'';">&nbsp; &nbsp; + Cung cấp t&agrave;i liệu to&agrave;n văn miễn ph&iacute; trong CSDL&nbsp;<b>Sciencedirect</b>&nbsp;th&ocirc;ng qua&nbsp; website:&nbsp;</span></span><strong><span style="font-size: 20px;"><span style="font-family: ''Times New Roman'';">www.sciencedirect.com</span></span></strong></div>\r\n	<div align="justify">\r\n		&nbsp;</div>\r\n	<div>\r\n		<span style="font-size: 20px;"><span style="font-family: ''Times New Roman'';">&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; Trong qu&aacute; tr&igrave;nh truy cập tra cứu t&agrave;i liệu c&oacute; vấn đề g&igrave; qu&yacute; thầy c&ocirc; li&ecirc;n hệ địa chỉ mail</span></span>&nbsp;<strong><span style="font-size: 20px;"><span style="font-family: ''Times New Roman'';">&nbsp;<a href="mailto:thuanhth@cesti.gov.vn" style="text-decoration: none; outline: none; color: rgb(0, 120, 159); padding: 5px 20px 5px 0px; background: url(http://www.sgu.edu.vn/templates/jsn_epic_pro/images/icon-link-mailto.png) 100% 50% no-repeat transparent;">thuanhth@cesti.gov.vn</a></span></span></strong>&nbsp;<span style="font-size: 20px;"><span style="font-family: ''Times New Roman'';">để được hỗ trợ.</span></span></div>\r\n</div>\r\n<div style="font-family: arial, sans-serif; font-size: 13px;">\r\n	<div>\r\n		&nbsp;</div>\r\n	<div>\r\n		&nbsp;</div>\r\n	<div>\r\n		<span style="font-size: 22px;"><span style="font-family: ''Times New Roman'';">&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; - &nbsp; &nbsp;<a href="http://www.sgu.edu.vn/files/p_KHCN/HuongDanCongThongTin/Tra%20cuu%20CSDL%20Springer%20link.pdf" style="text-decoration: none; outline: none; color: rgb(0, 120, 159); padding: 5px 20px 5px 0px; background: url(http://www.sgu.edu.vn/templates/jsn_epic_pro/images/icon-link-pdf.png) 100% 50% no-repeat transparent;">Hướng dẫn tra cứu CSDL SPRINGERLINK</a></span></span><br />\r\n		&nbsp;</div>\r\n	<div>\r\n		<span style="font-family: ''Times New Roman''; font-size: 22px;">&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; - &nbsp; &nbsp;<a href="http://www.sgu.edu.vn/files/p_KHCN/HuongDanCongThongTin/Tra%20cuu%20CSDL%20tieng%20Viet.pdf" style="text-decoration: none; outline: none; color: rgb(0, 120, 159); padding: 5px 20px 5px 0px; background: url(http://www.sgu.edu.vn/templates/jsn_epic_pro/images/icon-link-pdf.png) 100% 50% no-repeat transparent;">Hướng dẫn tra cứu CSDL Tiếng Việt</a></span><br />\r\n		&nbsp;</div>\r\n	<div>\r\n		<span style="font-family: ''Times New Roman''; font-size: 22px;">&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; - &nbsp; &nbsp;<a href="http://www.sgu.edu.vn/files/p_KHCN/HuongDanCongThongTin/TRA%20CUU%20CSDL%20PROQUEST.pdf" style="text-decoration: none; outline: none; color: rgb(0, 120, 159); padding: 5px 20px 5px 0px; background: url(http://www.sgu.edu.vn/templates/jsn_epic_pro/images/icon-link-pdf.png) 100% 50% no-repeat transparent;">Hướng dẫn tra cứu CSDL PROQUEST</a></span><br />\r\n		&nbsp;</div>\r\n	<p style="padding: 0px; margin: 0.35em 0px 0.8em 80px;">\r\n		<span style="font-size: 20px;"><span style="font-family: ''Times New Roman'';">&nbsp; - &nbsp; &nbsp;<a href="http://www.sgu.edu.vn/files/p_KHCN/HuongDanCongThongTin/HDSD%20IEEE%20%20(1).docx" style="text-decoration: none; outline: none; color: rgb(0, 120, 159);">Hướng dẫn tra cứu CSDL IEEE</a></span></span></p>\r\n</div>\r\n<p>\r\n	&nbsp;</p>\r\n'),
('core.mail.contact', 'admin@khcnsgu.com'),
('core.mail.from', 'no-reply@localhost'),
('core.mail.name', 'Phòng Khoa học Công nghệ'),
('domain', 'http://qlkh-sdh-sgu.com'),
('gioi.thieu', '<p style="text-align: center">\r\n	&nbsp;<strong><font color="#0000ff" size="6">PH&Ograve;NG QUẢN L&Yacute; KHOA HỌC &amp; SĐH</font></strong></p>\r\n<div align="center" style="margin-top: 0px; margin-bottom: 0px">\r\n	&nbsp;</div>\r\n<div style="text-align: left; margin-top: 0px; margin-bottom: 0px">\r\n	<span style="font-size: 18px"><strong><span style="font-family: ''Times New Roman''">&nbsp; &nbsp;- Chi tiết li&ecirc;n lạc</span></strong></span></div>\r\n<div style="text-align: left">\r\n	<span style="font-size: 18px">&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;&nbsp;</span><span style="color: rgb(128,0,128)"><span style="font-size: 18px"><span style="font-family: ''Times New Roman''">Địa chỉ:</span></span></span><span style="font-size: 13pt"><span style="font-family: ''Times New Roman''"> - Ph&ograve;ng C010, C011 - Trường Đại học S&agrave;i G&ograve;n, 273 An Dương Vương, Phường 3, Quận 5, TP.HCM</span></span></div>\r\n<div style="margin-top: 0px; margin-bottom: 0px; margin-left: 120px;">\r\n	<span style="font-size: 18px"><span style="font-family: ''Times New Roman''">&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; </span></span></div>\r\n<div style="margin-top: 0px; margin-bottom: 0px; margin-left: 120px;">\r\n	<span style="font-size: 18px"><span style="font-family: ''Times New Roman''"><span style="color: rgb(128,0,128)">Email:&nbsp;</span></span><strong><span style="font-family: ''Times New Roman''">Ban Quản l&yacute; Khoa học: &nbsp;&nbsp;&nbsp; qlkh@sgu.edu.vn</span></strong></span></div>\r\n<div style="margin-top: 0px; margin-bottom: 0px; margin-left: 160px;">\r\n	<span style="font-size: 18px"><strong><span style="font-family: ''Times New Roman''">&nbsp; &nbsp; Ban Sau Đại học: &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; sdh@sgu.edu.vn</span></strong></span></div>\r\n<div style="text-align: left; margin-top: 0px; margin-bottom: 0px; margin-left: 80px;">\r\n	&nbsp;</div>\r\n<div style="text-align: left; margin-top: 0px; margin-bottom: 0px; margin-left: 80px;">\r\n	&nbsp;</div>\r\n<div style="text-align: left; margin-top: 0px; margin-bottom: 0px; margin-left: 80px;">\r\n	<span style="font-size: 18px"><span style="font-family: ''Times New Roman''"><span style="font-size: 18px"><span style="font-family: ''Times New Roman''"><span style="color: rgb(128,0,128)">Điện thoại: </span></span></span></span></span><span style="font-size: 18px"><strong style="font-family: ''times new roman'', times, serif;">Ban Sau Đại hoc: </strong><span style="font-family: &quot;times new roman&quot;,times,serif;">(08) 38.30.3108;</span></span></div>\r\n<div style="text-align: left; margin-top: 0px; margin-bottom: 0px; margin-left: 160px;">\r\n	<span style="font-size: 18px"><strong style="font-family: ''times new roman'', times, serif;">Ban Quản l&yacute; Khoa học:</strong><strong style="font-family: ''times new roman'', times, serif;">&nbsp;</strong><span style="font-family: &quot;times new roman&quot;,times,serif;"> (08) 38.35.4271 - (08) 38.33.9710</span></span></div>\r\n<div style="text-align: left; margin-top: 0px; margin-bottom: 0px; margin-left: 80px;">\r\n	<span style="font-size: 18px"><strong style="font-family: ''times new roman'', times, serif;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; </strong></span></div>\r\n<div style="text-align: left; margin-top: 0px; margin-bottom: 0px">\r\n	<strong><span style="font-size: 18px"><span style="font-family: ''Times New Roman''">&nbsp; - Chức năng &nbsp;</span></span></strong></div>\r\n<div style="text-align: left; margin-top: 0px; margin-bottom: 0px">\r\n	<span style="font-size: 13pt"><span style="font-family: ''Times New Roman''">&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; + Tham mưu v&agrave; gi&uacute;p Hiệu trưởng trong việc quản l&iacute;, đề xuất, tổ chức thực hiện v&agrave; tổng kết c&aacute;c hoạt động khoa học - c&ocirc;ng nghệ của Trường</span></span></div>\r\n<div style="text-align: left; margin-top: 0px; margin-bottom: 0px">\r\n	<span style="font-size: 13pt"><span style="font-family: ''Times New Roman''">&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; + Tư vấn v&agrave; gi&uacute;p Hiệu trưởng trong việc quản l&iacute;, tổ chức đ&agrave;o tạo bậc sau đại học theo kế hoạch của Trường</span></span></div>\r\n<div style="text-align: left; margin-top: 0px; margin-bottom: 0px">\r\n	&nbsp;</div>\r\n<div style="text-align: left; margin-top: 0px; margin-bottom: 0px">\r\n	<strong><span style="font-size: 18px"><span style="font-family: ''Times New Roman''">&nbsp; - Nhiệm vụ</span></span></strong></div>\r\n<div style="text-align: left; margin-top: 0px; margin-bottom: 0px">\r\n	<span style="font-size: 13pt"><span style="font-family: ''Times New Roman''">&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; + X&acirc;y dựng kế hoạch hoạt động khoa học &ndash; c&ocirc;ng nghệ của Trường</span></span></div>\r\n<div style="text-align: left; margin-top: 0px; margin-bottom: 0px">\r\n	<span style="font-size: 13pt"><span style="font-family: ''Times New Roman''">&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; + Quản l&iacute; c&ocirc;ng t&aacute;c nghi&ecirc;n cứu, th&ocirc;ng tin về khoa học - c&ocirc;ng nghệ; tổ chức nghiệm thu, đ&aacute;nh gi&aacute; c&aacute;c c&ocirc;ng tr&igrave;nh nghi&ecirc;n cứu khoa học; hướng dẫn, tổ chức v&agrave; theo d&otilde;i c&aacute;c hội nghị, hội thảo khoa học; tổ chức việc tham gia c&aacute;c giải thưởng khoa học, c&ocirc;ng nghệ trong nước; Tổ chức thực hiện việc li&ecirc;n kết hợp t&aacute;c nghi&ecirc;n cứu khoa học - c&ocirc;ng nghệ với c&aacute;c địa phương, với c&aacute;c trường đại học v&agrave; c&aacute;c viện nghi&ecirc;n cứu; </span></span></div>\r\n<div style="text-align: left; margin-top: 0px; margin-bottom: 0px">\r\n	<span style="font-size: 13pt"><span style="font-family: ''Times New Roman''">&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; + Đề xuất c&aacute;c đối t&aacute;c li&ecirc;n kết đ&agrave;o tạo Sau Đại học; </span></span></div>\r\n<div style="text-align: left; margin-top: 0px; margin-bottom: 0px">\r\n	<span style="font-size: 13pt"><span style="font-family: ''Times New Roman''">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; + Quản l&iacute; v&agrave; tổ chức c&aacute;c lớp Sau Đại học.</span></span></div>\r\n<div style="text-align: left; margin-top: 0px; margin-bottom: 0px">\r\n	&nbsp;</div>\r\n<div style="text-align: left; margin-top: 0px; margin-bottom: 0px">\r\n	<div style="margin-top: 0px; margin-bottom: 0px">\r\n		<strong><span style="font-size: 18px"><span style="font-family: ''Times New Roman''">&nbsp; - Cơ cấu tổ chức &ndash; Nh&acirc;n sự</span></span></strong></div>\r\n	<div style="margin-top: 0px; margin-bottom: 0px">\r\n		<span style="font-size: 18px">&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; +</span><span style="font-size: 18px">&nbsp;</span><span style="font-size: 18px"><span style="font-family: ''Times New Roman''">L&atilde;nh đạo:</span></span></div>\r\n	<div style="margin-top: 0px; margin-bottom: 0px">\r\n		<table align="center" border="2" cellpadding="1" cellspacing="1" height="342" width="312">\r\n			<tbody>\r\n				<tr>\r\n					<td style="text-align: center;">\r\n						<p>\r\n							<strong><span style="font-size:20px;"><span style="font-family: &quot;Times New Roman&quot;;">Q. TRƯỞNG PH&Ograve;NG</span></span></strong></p>\r\n					</td>\r\n				</tr>\r\n				<tr>\r\n					<td>\r\n						<div style="margin-top: 0px; margin-bottom: 0px; text-align: center;">\r\n							<span style="font-size: 18px"><span style="font-family: ''Times New Roman''"><img alt="" height="283" src="http://www.sgu.edu.vn/images/stories/02014/T5/28/TQS.jpg" width="225" /></span></span></div>\r\n						<div style="margin-top: 0px; margin-bottom: 0px; text-align: center;">\r\n							<strong><span style="font-size: 18px"><span style="font-family: ''Times New Roman''">TS. Tạ Quang Sơn</span></span></strong></div>\r\n						<div style="margin-top: 0px; margin-bottom: 0px; text-align: center;">\r\n							<span style="font-size:14px;"><span style="font-family: times new roman,times,serif;">Email: <span style="font-size:16px;"><a href="mailto:taquangson@sgu.edu.vn">taquangson@sgu.edu.vn</a></span></span></span></div>\r\n					</td>\r\n				</tr>\r\n			</tbody>\r\n		</table>\r\n	</div>\r\n	<div style="text-align: center; margin-top: 0px; margin-bottom: 0px">\r\n		&nbsp;</div>\r\n</div>\r\n<div style="text-align: left; margin-top: 0px; margin-bottom: 0px">\r\n	<div align="center">\r\n		<table align="center" border="1" cellpadding="1" cellspacing="1" height="263" width="528">\r\n			<tbody>\r\n				<tr>\r\n					<td style="text-align: center;">\r\n						<p>\r\n							<span style="font-family:times new roman,times,serif;"><strong><span style="font-size: 20px;">PH&Oacute; TRƯỞNG PH&Ograve;NG</span></strong></span></p>\r\n					</td>\r\n					<td style="text-align: center;">\r\n						<p>\r\n							<span style="font-family:times new roman,times,serif;"><strong><span style="font-size: 20px;">PH&Oacute; TRƯỞNG PH&Ograve;NG</span></strong></span></p>\r\n					</td>\r\n				</tr>\r\n				<tr>\r\n					<td>\r\n						<p style="text-align: center;">\r\n							<span style="font-family:times new roman,times,serif;"><span style="font-size: 18px;"><strong>TS. Nguyễn Văn Huấn</strong></span></span></p>\r\n						<p style="text-align: center;">\r\n							<span style="font-family:times new roman,times,serif;"><span style="font-size: 18px;"><strong><img alt="" src="/public/upload/images/Nguyen%20Van%20Huan%202014.jpg" style="width: 189px; height: 283px;" /></strong></span></span></p>\r\n						<p style="text-align: center;">\r\n							&nbsp;</p>\r\n						<p style="text-align: center;">\r\n							<span style="font-size: 14px; font-family: ''times new roman'', times, serif;">Email: </span><a href="mailto:nguyenvanhuan@hotmail.com.vn" style="font-size: 14px; font-family: ''times new roman'', times, serif;">nguyenvanhuan@sgu.edu.vn</a></p>\r\n					</td>\r\n					<td>\r\n						<p style="text-align: center;">\r\n							<span style="font-family:times new roman,times,serif;"><span style="font-size: 18px;"><strong>ThS. Nguyễn Thị Minh Hằng</strong></span></span></p>\r\n						<p style="text-align: center;">\r\n							<img alt="" src="/public/upload/images/IMG_8176.jpg" style="height: 283px; width: 189px;" /></p>\r\n						<p style="text-align: center;">\r\n							&nbsp;</p>\r\n						<p style="text-align: center;">\r\n							<span style="font-family:times new roman,times,serif;"><span style="font-size:14px;">Email: <a href="mailto:nguyenthiminhhang1963@gmail.com">mhang@sgu.edu.vn</a></span></span></p>\r\n					</td>\r\n				</tr>\r\n			</tbody>\r\n		</table>\r\n	</div>\r\n	<p>\r\n		<span style="font-size: 18px"><span style="font-family: ''Times New Roman''"><span style="text-align: left">&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; +</span><span style="text-align: left">&nbsp;&nbsp;</span></span></span><span style="font-size: 18px"><span style="font-family: ''Times New Roman''"><strong><font color="#800080">Danh s&aacute;ch c&aacute;n bộ, chuy&ecirc;n vi&ecirc;n:</font></strong></span></span><span style="font-size: 18px"><span style="font-family: ''Times New Roman''"> </span></span></p>\r\n	<table align="center" border="1" cellpadding="0" cellspacing="0" width="98%">\r\n		<tbody>\r\n			<tr>\r\n				<td colspan="3" style="width:638px;">\r\n					<p>\r\n						<strong>QUẢN L&Yacute; KHOA HỌC</strong></p>\r\n				</td>\r\n			</tr>\r\n			<tr>\r\n				<td style="width:213px;">\r\n					<p>\r\n						ThS. L&ecirc; Thị Thanh Thủy</p>\r\n				</td>\r\n				<td style="width:213px;">\r\n					<p>\r\n						Chuy&ecirc;n vi&ecirc;n</p>\r\n				</td>\r\n				<td style="width:213px;">\r\n					<p>\r\n						<a href="mailto:thanh_thuy150380@yahoo.com">thanhthuyle@sgu.edu.vn</a></p>\r\n				</td>\r\n			</tr>\r\n			<tr>\r\n				<td style="width:213px;">\r\n					<p>\r\n						Phan Thu H&agrave;</p>\r\n				</td>\r\n				<td style="width:213px;">\r\n					<p>\r\n						Chuy&ecirc;n vi&ecirc;n</p>\r\n				</td>\r\n				<td style="width:213px;">\r\n					<p>\r\n						<a href="mailto:phanthuha1212@yahoo.com">phanthuha1212@sgu.edu.vn</a></p>\r\n				</td>\r\n			</tr>\r\n			<tr>\r\n				<td style="width:213px;">\r\n					<p>\r\n						V&otilde; Th&uacute;y Linh</p>\r\n				</td>\r\n				<td style="width:213px;">\r\n					<p>\r\n						Chuy&ecirc;n vi&ecirc;n</p>\r\n				</td>\r\n				<td style="width:213px;">\r\n					<p>\r\n						<a href="mailto:thuylinh1109@gmail.com">vtlinh@sgu.edu.vn</a></p>\r\n				</td>\r\n			</tr>\r\n			<tr>\r\n				<td style="width:213px;">\r\n					<p>\r\n						Ng&ocirc; Việt Anh</p>\r\n				</td>\r\n				<td style="width:213px;">\r\n					<p>\r\n						Chuy&ecirc;n vi&ecirc;n</p>\r\n				</td>\r\n				<td style="width:213px;">\r\n					<p>\r\n						<a href="mailto:vietanh.ngosgu@gmail.com">nvanh@sgu.edu.vn</a></p>\r\n				</td>\r\n			</tr>\r\n			<tr>\r\n				<td colspan="3" style="width:638px;">\r\n					<p>\r\n						<strong>SAU ĐẠI HỌC</strong></p>\r\n				</td>\r\n			</tr>\r\n			<tr>\r\n				<td style="width:213px;">\r\n					<p>\r\n						ThS. Trần T. Hồng Nhung</p>\r\n				</td>\r\n				<td style="width:213px;">\r\n					<p>\r\n						Chuy&ecirc;n vi&ecirc;n</p>\r\n				</td>\r\n				<td style="width:213px;">\r\n					<p>\r\n						<a href="mailto:nhungsgu@gmail.com">trannhung@sgu.edu.vn</a></p>\r\n				</td>\r\n			</tr>\r\n			<tr>\r\n				<td style="width:213px;">\r\n					<p>\r\n						Vy Đ&igrave;nh Lộc</p>\r\n				</td>\r\n				<td style="width:213px;">\r\n					<p>\r\n						Chuy&ecirc;n vi&ecirc;n</p>\r\n				</td>\r\n				<td style="width:213px;">\r\n					<p>\r\n						<a href="mailto:Vy.loc0607@gmail.com">vydinhloc@sgu.edu.vn</a></p>\r\n				</td>\r\n			</tr>\r\n			<tr>\r\n				<td style="width:213px;">\r\n					<p>\r\n						ThS. Nguyễn Văn Vẹn</p>\r\n				</td>\r\n				<td style="width:213px;">\r\n					<p>\r\n						Chuy&ecirc;n vi&ecirc;n</p>\r\n				</td>\r\n				<td style="width:213px;">\r\n					<p>\r\n						<a href="mailto:vennv@sgu.edu.vn">vennv@sgu.edu.vn</a></p>\r\n				</td>\r\n			</tr>\r\n			<tr>\r\n				<td style="width:213px;">\r\n					<p>\r\n						Ng&ocirc; Tuyết Hằng</p>\r\n				</td>\r\n				<td style="width:213px;">\r\n					Chuy&ecirc;n vi&ecirc;n</td>\r\n				<td style="width:213px;">\r\n					<a href="mailto:ngotuyethang12@gmail.com">ngotuyethang@sgu.edu.vn</a></td>\r\n			</tr>\r\n		</tbody>\r\n	</table>\r\n	<div style="clear:both;">\r\n		&nbsp;</div>\r\n</div>\r\n<p>\r\n	&nbsp;</p>\r\n'),
('hieu.truong', 'PGS TS. Nguyễn Viết Ngoạn'),
('lien.he', '<p>\r\n	<span style="font-family:times new roman,times,serif;"><strong>Địa chỉ : </strong> Trường Đại học S&agrave;i G&ograve;n, 273 An Dương Vương, Phường 3, Quận 5, TP.HCM - <span style="font-family:times new roman,times,serif;">Ph&ograve;ng C010, </span>Ph&ograve;ng C011</span></p>\r\n<p>\r\n	<span style="font-family:times new roman,times,serif;"><strong>Điện thoại :&nbsp;</strong></span><strong style="font-family: ''times new roman'', times, serif;"><span style="font-size: 14px;">Ban Sau Đại hoc: </span></strong><span style="font-family: ''times new roman'', times, serif;">(08) 38.30.3108</span>; <strong style="font-family: ''times new roman'', times, serif;"><span style="font-size: 14px;">Ban Quản l&yacute; Khoa học:</span></strong><strong style="font-family: ''times new roman'', times, serif;">&nbsp;</strong><span style="font-family: ''times new roman'', times, serif;"> (08) 38.35.4271 - (08) 38.33.9710</span></p>\r\n<p>\r\n	<span style="font-family:times new roman,times,serif;"><strong>Email :&nbsp;</strong><strong><span style="font-size:14px;">Ban Sau Đại hoc:&nbsp; </span></strong><span style="font-size:14px;">sdh@sgu.edu.vn</span></span>; <span style="font-family:times new roman,times,serif;"><strong><span style="font-size:14px;">Ban Quản l&yacute; Khoa học:</span>&nbsp; </strong><span style="font-size:14px;">qlkh@sgu.edu.vn </span></span></p>\r\n<p>\r\n	&nbsp;</p>\r\n'),
('ten.phong', 'Phòng Quản lý Khoa học và Sau đại học - Trường Đại học Sài Gòn'),
('truong.phong', 'TS. Tạ Quang Sơn');

-- --------------------------------------------------------

--
-- Table structure for table `sinh_hoat_chuyen_de`
--

CREATE TABLE IF NOT EXISTS `sinh_hoat_chuyen_de` (
  `sinh_hoat_chuyen_de_id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `ten` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `noi_dung` text COLLATE utf8_unicode_ci,
  `thoi_gian` date DEFAULT NULL,
  `dia_diem` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `ten_file` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `ngay_tao` datetime NOT NULL,
  PRIMARY KEY (`sinh_hoat_chuyen_de_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `tai_lieu`
--

CREATE TABLE IF NOT EXISTS `tai_lieu` (
  `tai_lieu_id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `ten` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `noi_dung` text COLLATE utf8_unicode_ci,
  `ten_file` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `ngay_tao` datetime NOT NULL,
  `search` tinyint(1) NOT NULL DEFAULT '1',
  PRIMARY KEY (`tai_lieu_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `thong_bao`
--

CREATE TABLE IF NOT EXISTS `thong_bao` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `tieu_de` varchar(250) COLLATE utf8_unicode_ci NOT NULL,
  `noi_dung` text COLLATE utf8_unicode_ci NOT NULL,
  `ngay_tao` datetime NOT NULL,
  `so_lan_xem` int(10) NOT NULL DEFAULT '1',
  `trang_thai` tinyint(4) NOT NULL DEFAULT '1',
  `ma_quan_tri` int(11) NOT NULL,
  `loai` tinyint(4) NOT NULL,
  `search` tinyint(1) NOT NULL DEFAULT '1',
  `file` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `quan_trong` tinyint(1) NOT NULL DEFAULT '0',
  `noi_bat` tinyint(1) NOT NULL DEFAULT '0',
  `file_pdf` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=162 ;

--
-- Dumping data for table `thong_bao`
--

INSERT INTO `thong_bao` (`id`, `tieu_de`, `noi_dung`, `ngay_tao`, `so_lan_xem`, `trang_thai`, `ma_quan_tri`, `loai`, `search`, `file`, `quan_trong`, `noi_bat`, `file_pdf`) VALUES
(34, 'Mời tham gia hội thảo khoa học "Nguyễn Đổng Chi - Nhà văn hóa"', '<p style="text-align: center;">\r\n	<img alt="" src="http://www.sgu.edu.vn/images/stories/02014/T10/07/Nguyen%20Dong%20Chi-1.jpg" style="width: 600px; height: 907px;" /></p>\r\n<p style="text-align: center;">\r\n	<img alt="" src="http://www.sgu.edu.vn/images/stories/02014/T10/07/Nguyen%20Dong%20Chi%20-2.jpg" style="width: 600px; height: 759px;" /></p>\r\n<p style="text-align: left;">\r\n	&nbsp;</p>\r\n<p style="text-align: left;">\r\n	&nbsp; &nbsp; &nbsp; &nbsp; <span style="font-size: 22px;"><span style="font-family: ''Times New Roman'';">&nbsp; &nbsp;<strong><a href="http://www.sgu.edu.vn/files/02014/T10/07/Phieu%20dang%20ky%20tham%20gia%20Hoi%20thao.doc">Mời download phiếu tham dự Hội thảo</a></strong></span></span></p>\r\n', '2014-10-07 07:48:07', 386, 1, 1, 2, 1, NULL, 0, 0, NULL),
(35, 'Kế hoạch giảng dạy tháng 10 hệ Cao học Đại học Vinh K22 (Đợt 2) và mẫu Lý lịch học viên Cao học', '<p>\r\n	<span style="font-size: 16px;"><span style="font-family: Arial;"><img alt="" src="http://www.sgu.edu.vn/images/stories/02014/T9/29/CaoHocVinh_22.jpg" style="width: 650px; height: 551px;" /></span></span></p>\r\n<p>\r\n	<span style="font-size: 16px;"><span style="font-family: Arial;">&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;&nbsp;<a href="http://www.sgu.edu.vn/files/02014/T9/26/Ly%20lich%20hoc%20vien%20CH%20K22%20__t%202.pdf">Bấm v&agrave;o đ&acirc;y để tải mẫu L&yacute; lịch học vi&ecirc;n Cao học</a></span></span></p>\r\n<p>\r\n	<span class="article_separator">&nbsp;</span></p>\r\n', '2014-10-07 10:42:16', 577, 1, 1, 3, 1, NULL, 0, 0, NULL),
(38, 'Thông báo về Diễn đàn "Những ngày Khoa học Nga tại Việt Nam"', '<p>\r\n	<img alt="" src="/public/upload/images/Scan%20213.jpg" style="width: 600px; height: 792px;" /></p>\r\n<p>\r\n	<a href="http://www.moet.gov.vn/?page=1.7&amp;view=409"><span style="font-size:16px;"><span style="font-family: times new roman,times,serif;">Th&ocirc;ng b&aacute;o về Diễn đ&agrave;n &quot;Những ng&agrave;y Khoa học Nga tại Việt Nam&quot;</span></span></a></p>\r\n', '2014-10-16 03:57:14', 191, 1, 1, 2, 1, NULL, 0, 0, NULL),
(39, 'Thư mời viết bài hội thảo "Dạy học tích hợp và dạy học phân hóa ở trường trung học"', '<p>\r\n	<img alt="" src="/public/upload/images/Scan%20214.jpg" style="width: 600px; height: 851px;" /></p>\r\n<p>\r\n	<img alt="" src="/public/upload/images/Scan%20215.jpg" style="width: 600px; height: 840px;" /></p>\r\n<p>\r\n	<a href="http://www.ier.edu.vn/content/view/748/166/"><span style="font-size:16px;"><span style="font-family: times new roman,times,serif;">Thư mời viết b&agrave;i hội thảo &quot;Dạy học t&iacute;ch hợp v&agrave; dạy học ph&acirc;n h&oacute;a ở trường trung học&quot;</span></span></a></p>\r\n', '2014-10-16 03:58:38', 377, 1, 1, 2, 1, NULL, 0, 0, NULL),
(40, 'Thư mời viết tham luận Hội thảo Quốc tế "Việt Nam 40 năm (1975-2015): Thống nhất, Hội nhập và Phát triển"', '<p>\r\n	<img alt="" src="/public/upload/images/Scan%20216.jpg" style="width: 600px; height: 803px;" /></p>\r\n<p>\r\n	<img alt="" src="/public/upload/images/Scan%20217.jpg" style="width: 600px; height: 841px;" /></p>\r\n', '2014-10-17 03:47:34', 930, 1, 1, 2, 1, NULL, 0, 0, NULL),
(41, 'Thư mời viết bài cho Hội thảo "Nâng cao vai trò của cố vấn học tập trong đào tạo theo học chế tín chỉ tại các trường Đại học - Cao đẳng Việt Nam', '<p>\r\n	<img alt="" src="/public/upload/images/Scan%20218.jpg" style="width: 600px; height: 776px;" /></p>\r\n<p>\r\n	<img alt="" src="/public/upload/images/Scan%20219.jpg" style="width: 600px; height: 790px;" /></p>\r\n<p>\r\n	<img alt="" src="/public/upload/images/Scan%20220.jpg" style="width: 600px; height: 724px;" /></p>\r\n', '2014-10-17 03:57:28', 280, 1, 1, 2, 1, NULL, 0, 0, NULL),
(42, 'Thông báo về việc mời viết bài tham gia Hội thảo Khoa học: “Đổi mới chương trình đào tạo ngành Giáo dục chính trị và Giáo dục công dân”', '<p>\r\n	Hiện nay, chương tr&igrave;nh đ&agrave;o tạo ng&agrave;nh Gi&aacute;o dục ch&iacute;nh trị v&agrave; ng&agrave;nh Gi&aacute;o dục c&ocirc;ng d&acirc;n ở c&aacute;c trường đại học v&agrave; cao đẳng đ&atilde; c&oacute; nhiều đổi mới. Tuy nhi&ecirc;n, vấn đề đổi mới n&agrave;y vẫn đang được tranh luận với nhiều luồng &yacute; kiến kh&aacute;c nhau. Hơn nữa, năm 2013, Hội Nghị lần thứ 8 Ban Chấp h&agrave;nh Trung ương Đảng Cộng sản Việt Nam kho&aacute; XI quyết định &ldquo;Đổi mới căn bản, to&agrave;n diện gi&aacute;o dục v&agrave; đ&agrave;o tạo&rdquo;. Theo đ&oacute;, c&aacute;c ng&agrave;nh đ&agrave;o tạo đại học v&agrave; cao đẳng phải đổi mới mạnh mẽ &ldquo;căn bản, to&agrave;n diện&rdquo; để đ&aacute;p ứng y&ecirc;u cầu ng&agrave;y c&agrave;ng cao của c&ocirc;ng cuộc x&acirc;y dựng đất nước. Xuất ph&aacute;t từ thực tế đ&oacute;, Trường &nbsp;Đại học S&agrave;i G&ograve;n tổ chức Hội thảo khoa học &ldquo;Đổi mới Chương tr&igrave;nh đ&agrave;o tạo ng&agrave;nh Gi&aacute;o dục ch&iacute;nh trị v&agrave; Gi&aacute;o dục c&ocirc;ng d&acirc;n&rdquo;.&nbsp;</p>\r\n<div>\r\n	&nbsp;</div>\r\n<div>\r\n	<strong>&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;&nbsp;1. Mục đ&iacute;ch Hội thảo</strong></div>\r\n<div>\r\n	&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;&nbsp;Luận b&agrave;n, trao đổi về chương tr&igrave;nh gi&aacute;o dục ch&iacute;nh trị l&iacute; tưởng (ở c&aacute;c cấp độ kh&aacute;c nhau), chương tr&igrave;nh hiện nay, về việc tổ chức thực tập, kiến tập của sinh vi&ecirc;n, hoạt động kiểm tra, đ&aacute;nh gi&aacute; chất lượng học tập v&agrave; c&aacute;c thay đổi căn bản cần được tiến h&agrave;nh, c&aacute;c m&ocirc;n học cần được lược bỏ, bổ sung hoặc thay đổi t&iacute;nh chất,&hellip; nhằm tiến đến chỉnh l&iacute; v&agrave; x&acirc;y dựng một chương tr&igrave;nh đ&agrave;o tạo chuy&ecirc;n ng&agrave;nh Gi&aacute;o dục ch&iacute;nh trị mới đ&aacute;p ứng y&ecirc;u cầu &ldquo;Đổi mới căn bản, to&agrave;n diện gi&aacute;o dục v&agrave; đ&agrave;o tạo&rdquo; hiện nay.</div>\r\n<div>\r\n	&nbsp;</div>\r\n<div>\r\n	<strong>&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;&nbsp;2. Chủ đề hội thảo</strong></div>\r\n<div>\r\n	&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;&nbsp;<strong>&nbsp; &nbsp; &nbsp;&ldquo;Đổi mới chương tr&igrave;nh đ&agrave;o tạo ng&agrave;nh Gi&aacute;o dục ch&iacute;nh trị v&agrave; Gi&aacute;o dục c&ocirc;ng d&acirc;n&rdquo;&nbsp;</strong></div>\r\n<div>\r\n	&nbsp;</div>\r\n<div>\r\n	<strong>&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;&nbsp;3. C&aacute;c nội dung ch&iacute;nh của Hội thảo</strong></div>\r\n<div>\r\n	&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;&nbsp;Hội thảo tập trung v&agrave;o c&aacute;c nội dung ch&iacute;nh sau:</div>\r\n<div>\r\n	&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;&nbsp;1. Đ&aacute;nh gi&aacute;, g&oacute;p &yacute; về chương tr&igrave;nh đ&agrave;o tạo ng&agrave;nh Gi&aacute;o dục ch&iacute;nh trị v&agrave; Gi&aacute;o dục c&ocirc;ng d&acirc;n v&agrave; ở c&aacute;c trường đại học v&agrave; cao đẳng hiện nay.</div>\r\n<div>\r\n	&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;&nbsp;- Ưu điểm v&agrave; nhược điểm của chương tr&igrave;nh đ&agrave;o tạo ng&agrave;nh Gi&aacute;o dục ch&iacute;nh trị v&agrave; Gi&aacute;o dục c&ocirc;ng d&acirc;n của c&aacute;c trường đại học, cao đẳng</div>\r\n<div>\r\n	&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;&nbsp;- Những kinh nghiệm v&agrave; b&agrave;i học từ việc triển khai đ&agrave;o tạo chuy&ecirc;n ng&agrave;nh Gi&aacute;o dục ch&iacute;nh trị v&agrave; Gi&aacute;o dục c&ocirc;ng d&acirc;n trong thời gian qua</div>\r\n<div>\r\n	&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;&nbsp;2. X&acirc;y dựng chương tr&igrave;nh mới c&aacute;c ng&agrave;nh Gi&aacute;o dục ch&iacute;nh trị v&agrave; Gi&aacute;o dục C&ocirc;ng d&acirc;n đ&aacute;p ứng y&ecirc;u cầu của Nghị Quyết VIII BCH TƯ Đảng.</div>\r\n<div>\r\n	&nbsp;</div>\r\n<div>\r\n	&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;&nbsp;- Y&ecirc;u cầu của x&atilde; hội đối với cử nh&acirc;n c&aacute;c ng&agrave;nh Gi&aacute;o dục Ch&iacute;nh trị, Gi&aacute;o dục&nbsp;c&ocirc;ng d&acirc;n</div>\r\n<div>\r\n	&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;&nbsp;- Mục đ&iacute;ch đ&agrave;o tạo, chuẩn đầu ra của c&aacute;c ng&agrave;nh Gi&aacute;o dục ch&iacute;nh trị v&agrave; Gi&aacute;o dục c&ocirc;ng d&acirc;n</div>\r\n<div>\r\n	&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;&nbsp;- Thời lượng v&agrave; nội dung chương tr&igrave;nh; hoạt động kiến tập, thực tập của sinh vi&ecirc;n</div>\r\n<div>\r\n	&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;&nbsp;- Kiểm tra, đ&aacute;nh gi&aacute; chất lượng học tập v&agrave; vấn đề t&agrave;i liệu tham khảo cho sinh vi&ecirc;n</div>\r\n<div>\r\n	&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;&nbsp;- &nbsp;&nbsp;C&aacute;c kiến nghị, đề xuất sửa đổi, bổ sung v&agrave; ho&agrave;n thiện chương tr&igrave;nh theo tinh thần của Nghị quyết Hội Nghị lần thứ VIII Ban Chấp h&agrave;nh Trung ương Đảng Cộng sản Việt Nam kho&aacute; XI.</div>\r\n<div>\r\n	&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;&nbsp;- Một số vấn đề kh&aacute;c li&ecirc;n quan đến chủ đề của hội thảo.</div>\r\n<div>\r\n	&nbsp;</div>\r\n<div>\r\n	<strong>&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;&nbsp;4. Đối tượng tham dự</strong></div>\r\n<div>\r\n	&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;&nbsp;C&aacute;c nh&agrave; khoa học, giảng vi&ecirc;n, c&aacute;n bộ Trường Đại học S&agrave;i G&ograve;n v&agrave; c&aacute;c trường bạn: Trường Đại học Sư phạm TP. Hồ Ch&iacute; Minh, Trường Đại học KHXH&amp;NV - ĐHQG TP. Hồ Ch&iacute; Minh, Trường Đại học Đồng Th&aacute;p, Trường Đại học Cần Thơ, Trường Đại học An Giang, Trường Đại học Sư phạm - Đại học Huế,&hellip;&nbsp;</div>\r\n<div>\r\n	&nbsp;</div>\r\n<div>\r\n	<strong>&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;&nbsp;5. Thời gian v&agrave; địa điểm tổ chức Hội thảo</strong></div>\r\n<div>\r\n	&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;&nbsp;- Thời hạn đăng k&iacute; đề t&agrave;i v&agrave; gửi t&oacute;m tắt b&aacute;o c&aacute;o: <strong>10/</strong><strong>08/2014</strong> (theo mẫu v&agrave; gửi qua email: <a href="mailto:k_gdct@sgu.edu.vn">k_gdct@sgu.edu.vn</a> ).</div>\r\n<div>\r\n	&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;&nbsp;- Thời hạn nộp tham luận: <strong>10/</strong><strong>10/2014</strong> (xin gửi qua email)</div>\r\n<div>\r\n	&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;&nbsp;- Thời gian tổ chức Hội thảo: Thứ s&aacute;u, ng&agrave;y 30 th&aacute;ng 10 năm 2014.</div>\r\n<div>\r\n	&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;&nbsp;- Địa điểm: Trường Đại học S&agrave;i G&ograve;n &ndash; 273 An Dương Vương, P.3, Q.5,&nbsp;Th&agrave;nh phố Hồ Ch&iacute; Minh.</div>\r\n<div>\r\n	&nbsp;</div>\r\n<div>\r\n	<strong>&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;&nbsp;6. Quy c&aacute;ch văn bản</strong></div>\r\n<div>\r\n	&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;&nbsp;- Sử dụng m&atilde; chữ Unicode, font: Times New Roman, cỡ chữ 13.&nbsp;</div>\r\n<div>\r\n	&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;&nbsp;- C&aacute;ch d&ograve;ng đơn, chừa lề tự động, d&agrave;i kh&ocirc;ng qu&aacute; 10 trang.</div>\r\n<div>\r\n	&nbsp;</div>\r\n<div>\r\n	<strong>&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;&nbsp;7. Địa chỉ li&ecirc;n hệ&nbsp;</strong></div>\r\n<div>\r\n	&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;&nbsp;- Ph&ograve;ng Quản l&yacute; Khoa học v&agrave; Sau đại học - Trường Đại học S&agrave;i G&ograve;n,&nbsp;273 An Dương Vương, Quận 5, TP. Hồ Ch&iacute; Minh -ĐT: 08 38354271</div>\r\n<div>\r\n	&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;&nbsp;- Khoa Gi&aacute;o dục ch&iacute;nh trị - Trường Đại học S&agrave;i G&ograve;n./.</div>\r\n<div>\r\n	&nbsp;</div>\r\n<div>\r\n	<strong>&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;KT.HIỆU TRƯỞNG</strong></div>\r\n<div>\r\n	<p>\r\n		&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;<strong>PH&Oacute;</strong> <strong>HIỆU TRƯỞNG</strong></p>\r\n	<p style="text-align: center;">\r\n		&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; (Đ&atilde; k&yacute;)</p>\r\n</div>\r\n<div>\r\n	&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; <strong>PGS.TS. Phạm Ho&agrave;ng Qu&acirc;n</strong></div>\r\n', '2014-10-21 03:00:51', 509, 1, 1, 2, 1, NULL, 0, 0, NULL),
(43, 'Lịch học và phòng học trong tháng 11 các lớp cao học Khóa 22 Đại học Vinh', '<p>\r\n	<a href="/public/upload/files/Lich%20hoc%20va%20phong%20hoc%20K22%20Cao%20hoc%20Vinh.rar"><span style="font-size:28px;"><span style="font-family:times new roman,times,serif;">Bấm v&agrave;o đ&acirc;y để tải lịch học chi tiết</span></span></a></p>\r\n', '2014-10-25 14:53:34', 862, 1, 1, 6, 1, '1414463243_lich-hoc-thang-11.JPG', 0, 0, NULL),
(44, 'Lịch học và phòng học trong tháng 11 các lớp cao học Khóa 22 Đại học Vinh', '<p>\r\n	<font color="#8099a8" face="Tahoma, Arial, Helvetica, sans-serif"><span style="border-color: rgb(234, 234, 234); font-size: 28px;">Bấm v&agrave;o đ&acirc;y để tải lịch học chi tiết</span></font></p>\r\n', '2014-10-25 14:55:31', 616, 1, 1, 3, 1, '1414463109_lich-hoc-thang-11.JPG', 0, 0, NULL),
(45, 'Hội thảo lần thứ nhất về Toán rời rạc do Viện Nghiên cứu cao cấp về Toán phối hợp với Đại học Nanyang tổ chức', '<p style="text-align: justify;">\r\n	<span style="font-size:18px;"><span style="font-family:times new roman,times,serif;">&nbsp; &nbsp; &nbsp; &nbsp; <span id="yui_3_16_0_1_1414332023834_3513">Từ ng&agrave;y 27/12 đến 31/12/2014, Viện Nghi&ecirc;n cứu cao cấp về To&aacute;n phối hợp với Đại học Nanyang để tổ chức Hội thảo lần thứ nhất về To&aacute;n rời rạc. Hội thảo sẽ mời c&aacute;c nh&agrave; khoa học của Singapore v&agrave; Việt Nam tr&igrave;nh b&agrave;y c&aacute;c kết quả nghi&ecirc;n cứu trong lĩnh vực To&aacute;n rời rạc - một lĩnh vực c&agrave;ng ng&agrave;y c&agrave;ng gắn kết với nhiều chuy&ecirc;n ng&agrave;nh to&aacute;n học kh&aacute;c như đại số, h&igrave;nh học, x&aacute;c xuất vv, v&agrave; c&oacute; nhiều ứng dụng s&acirc;u rộng trong c&aacute;c khoa học kh&aacute;c cũng như trong cuộc sống. Hội thảo sẽ tạo điều kiện v&agrave; th&uacute;c đẩy c&aacute;c trao đổi khoa học v&agrave; tiến tới thiết lập c&aacute;c hợp t&aacute;c giữa c&aacute;c nh&oacute;m nghi&ecirc;n cứu.</span></span></span></p>\r\n<p style="text-align: justify;">\r\n	<br />\r\n	<span style="font-size:18px;"><span style="font-family:times new roman,times,serif;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; <span id="yui_3_16_0_1_1414332023834_3497">Chương tr&igrave;nh bao gồm 3 b&aacute;o c&aacute;o mời to&agrave;n thể do c&aacute;c chuy&ecirc;n gia trong lĩnh vực l&yacute; thuyết đồ thị v&agrave; lĩnh vực mật m&atilde; tr&igrave;nh b&agrave;y. C&aacute;c b&aacute;o c&aacute;o mời của c&aacute;c nh&agrave; khoa học&nbsp; Singapore v&agrave; Việt nam sẽ gồm nhiều lĩnh vực của To&aacute;n rời rạc v&agrave; ứng dụng như&nbsp; m&atilde; h&oacute;a, tổ hợp đếm, đồ thị, đại số tổ hợp, l&yacute; thuyết thuật to&aacute;n, tối ưu tổ hợp, m&ocirc; h&igrave;nh h&oacute;a v&agrave; m&ocirc; phỏng.&nbsp;</span></span></span></p>\r\n<p style="text-align: justify;">\r\n	&nbsp;</p>\r\n<p id="yui_3_16_0_1_1414332023834_3521" style="text-align: justify;">\r\n	<span style="font-size:18px;"><span style="font-family:times new roman,times,serif;"><span id="yui_3_16_0_1_1414332023834_3520">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; Viện Nghi&ecirc;n cứu cao cấp về To&aacute;n tr&acirc;n trọng k&iacute;nh mời Qu&yacute; vị tham dự chương tr&igrave;nh.</span></span></span></p>\r\n<p style="text-align: justify;">\r\n	&nbsp;</p>\r\n<p id="yui_3_16_0_1_1414332023834_3523" style="text-align: justify;">\r\n	<span style="font-size:18px;"><span style="font-family:times new roman,times,serif;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; Để đăng k&yacute; tham dự, qu&yacute; vị vui l&ograve;ng mở đường link:</span></span></p>\r\n<p id="yui_3_16_0_1_1414332023834_3524" style="text-align: justify;">\r\n	<span style="font-size:18px;"><span style="font-family:times new roman,times,serif;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; <a href="http://viasm.edu.vn/hdkh/jwvsdm/dang-ky/" target="_blank">http://viasm.edu.vn/hdkh/jwvsdm/dang-ky/</a></span></span></p>\r\n<p style="text-align: justify;">\r\n	&nbsp;</p>\r\n<p id="yui_3_16_0_1_1414332023834_3525" style="text-align: justify;">\r\n	<span style="font-size:18px;"><span style="font-family:times new roman,times,serif;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; Để xem th&ocirc;ng tin chi tiết của chương tr&igrave;nh:</span></span></p>\r\n<p id="yui_3_16_0_1_1414332023834_3526" style="text-align: justify;">\r\n	<span style="font-size:18px;"><span style="font-family:times new roman,times,serif;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; <a href="http://viasm.edu.vn/hdkh/jwvsdm/chuong-trinh/" target="_blank">http://viasm.edu.vn/hdkh/jwvsdm/chuong-trinh/</a></span></span></p>\r\n<p style="text-align: justify;">\r\n	&nbsp;</p>\r\n<p id="yui_3_16_0_1_1414332023834_3536" style="margin-left: 40px; text-align: justify;">\r\n	<span style="font-size:18px;"><span style="font-family:times new roman,times,serif;">Tr&acirc;n trọng,</span></span></p>\r\n<p>\r\n	&nbsp;</p>\r\n', '2014-10-26 14:02:09', 174, 1, 1, 2, 1, NULL, 0, 0, NULL),
(46, 'Thông báo tuyển sinh cao học khoá 14.2 Trường Đại học Sài Gòn năm 2014', '<p style="text-align: center;">\r\n	<img alt="" src="/public/upload/images/Scan%20232.jpg" style="width: 600px; height: 822px;" /></p>\r\n<p style="text-align: center;">\r\n	<img alt="" src="/public/upload/images/Scan%20233.jpg" style="width: 600px; height: 775px;" /></p>\r\n<p style="text-align: center;">\r\n	<img alt="" src="/public/upload/images/Scan%20234.jpg" style="width: 600px; height: 878px;" /></p>\r\n<p style="text-align: center;">\r\n	<img alt="" src="/public/upload/images/Scan%20235.jpg" style="width: 600px; height: 870px;" /></p>\r\n<p style="text-align: center;">\r\n	<img alt="" src="/public/upload/images/Scan%20236.jpg" style="width: 600px; height: 867px;" /></p>\r\n', '2014-10-28 03:58:32', 1634, 1, 1, 5, 1, '1414468712_cao-hoc-k14.1.JPG', 0, 1, NULL),
(47, 'Thông báo về việc dời ngày học chuyển đổi, ôn thi và tuyển sinh các lớp cao học K14.2 Trường Đại học Sài Gòn năm 2014', '<div style="font-family: arial, sans-serif; font-size: 13px;">\r\n	<ul>\r\n		<li style="margin: 3pt 0cm 2pt 7.1pt; text-align: justify;">\r\n			<span style="font-size:22px;">Lịch học chuyển đổi:&nbsp;<b>Từ 08/11 đến 30/11/2014.</b></span></li>\r\n		<li style="margin: 3pt 0cm 2pt 7.1pt; text-align: justify;">\r\n			<span style="font-size:22px;">&Ocirc;n thi:<b>&nbsp;Từ 01/12 đến 26/12/2014.</b></span></li>\r\n		<li style="margin: 3pt 0cm 2pt 7.1pt; text-align: justify;">\r\n			<span style="font-size:22px;">Ng&agrave;y thi dự kiến:&nbsp;<b>27, 28/12/2014</b></span></li>\r\n	</ul>\r\n</div>\r\n<p>\r\n	&nbsp;</p>\r\n', '2014-11-02 03:21:28', 1081, 1, 1, 5, 1, NULL, 0, 0, NULL),
(48, 'Thông báo thời khoá biểu học chuyển đổi cao học khoá 14.2 Trường Đại học Sài Gòn năm 2014, chuyên ngành: Quản lý Giáo dục và Tài chính - Ngân hàng', '<p>\r\n	<span style="font-size:20px;"><a href="/public/upload/files/Quan%20ly%20giao%20duc%20-%20TKB%20hoc%20chuyen%20doi%20cao%20hoc%20K14.2.pdf">Thời kho&aacute; biểu ng&agrave;nh Quản l&yacute; Gi&aacute;o dục</a></span></p>\r\n<p>\r\n	<span style="font-size:20px;"><a href="/public/upload/files/TC%20-%20NH%20-%20TKB%20hoc%20chuyen%20doi%20cao%20hoc%20K14.2.pdf">Thời kho&aacute; biểu ng&agrave;nh T&agrave;i ch&iacute;nh - Ng&acirc;n h&agrave;ng</a></span></p>\r\n', '2014-11-06 10:45:28', 1249, 1, 1, 5, 1, NULL, 0, 1, NULL),
(49, 'Đăng ký tham gia Hội thảo CDIO năm 2014 với chủ đề "Đào tạo theo CDIO: Từ thí điểm đến đại trà"', '<p>\r\n	<img alt="" src="/public/upload/images/Scan%20240.jpg" style="width: 600px; height: 908px;" /></p>\r\n<p>\r\n	<img alt="" src="/public/upload/images/Scan%20241.jpg" style="width: 600px; height: 340px;" /></p>\r\n<p>\r\n	<img alt="" src="/public/upload/images/Scan%20242.jpg" style="width: 600px; height: 387px;" /></p>\r\n<p>\r\n	<img alt="" src="/public/upload/images/Scan%20243.jpg" style="width: 600px; height: 968px;" /></p>\r\n<p>\r\n	<a href="/public/upload/files/Thong%20bao%20moi%20viet%20bai%20Hoi%20thao%20CDIO.doc"><span style="font-size:22px;">Bấm v&agrave;o đ&acirc;y để tải th&ocirc;ng b&aacute;o</span></a></p>\r\n', '2014-11-21 08:04:46', 139, 1, 1, 2, 1, NULL, 0, 0, NULL),
(50, 'LỊCH ÔN THI TUYỂN SINH CAO HỌC ĐẠI HỌC SÀI GÒN KHÓA 14.2 NĂM 2014', '<p>\r\n	<span style="font-size:28px;"><a href="/public/upload/files/TOAN%20GT%20ON%20THI.pdf">Lịch &ocirc;n thi ng&agrave;nh To&aacute;n Giải t&iacute;ch</a></span></p>\r\n<p>\r\n	<span style="font-size:28px;"><a href="/public/upload/files/TCNH%20ON%20THI.pdf">Lịch &ocirc;n thi ng&agrave;nh T&agrave;i ch&iacute;nh Ng&acirc;n h&agrave;ng</a></span></p>\r\n<p>\r\n	<span style="font-size:28px;"><a href="/public/upload/files/NGON%20NGU%20HOC%20ON%20THI.pdf">Lịch &ocirc;n thi ng&agrave;nh Ng&ocirc;n ngữ học</a></span></p>\r\n<p>\r\n	<span style="font-size:28px;"><a href="/public/upload/files/QLGD%20ON%20THI.pdf">Lịch &ocirc;n thi ng&agrave;nh Quản l&yacute; Gi&aacute;o dục</a></span></p>\r\n', '2014-11-27 10:52:27', 1298, 1, 1, 5, 1, NULL, 0, 0, NULL),
(51, 'THÔNG BÁO LỊCH THI CÁC MÔN CHUYỂN ĐỔI CHO TUYỂN SINH CAO HỌC ĐẠI HỌC SÀI GÒN KHÓA 14.2 NĂM 2014', '<p>\r\n	<span style="font-size:26px;"><a href="/public/upload/files/lich%20thi.pdf">Lịch thi c&aacute;c m&ocirc;n chuyển đổi cho tuyển sinh cao học kh&oacute;a 14.2</a></span></p>\r\n', '2014-11-27 10:54:25', 1175, 1, 1, 5, 1, NULL, 0, 0, NULL),
(52, 'Danh sách học viên cao học thi bổ sung và lịch thi Khoá 22  tại Trường Đại học Sài Gòn', '<p>\r\n	<span style="font-size:26px;"><a href="/public/upload/files/DS%20thi%20sinh%20thi%20bo%20sung%20K22.pdf">Bấm v&agrave;o đ&acirc;y để tải danh s&aacute;ch bổ sung</a></span></p>\r\n<p>\r\n	<span style="font-size:26px;"><a href="/public/upload/files/Lich%20thi%20cao%20hoc%20Vinh%20khoa%2022.pdf">Bấm v&agrave;o đ&acirc;y để tải Lịch thi</a></span></p>\r\n', '2014-12-01 02:59:50', 1090, 1, 1, 6, 1, NULL, 0, 0, NULL),
(53, 'Lịch thi Cao học Vinh Khoá 21', '<p>\r\n	<span style="font-size:26px;"><a href="/public/upload/files/Lich%20thi%20cao%20hoc%20Vinh%20Khoa%2021.pdf">Bấm v&agrave;o đ&acirc;y để tải lịch thi</a></span></p>\r\n', '2014-12-01 03:01:03', 841, 1, 1, 6, 1, NULL, 0, 0, NULL),
(54, 'LỊCH ÔN THI TUYỂN SINH CAO HỌC ĐẠI HỌC SÀI GÒN KHÓA 14.2 NĂM 2014 CÓ CHỈNH SỬA', '<p>\r\n	<span style="font-size:28px;"><a href="/public/upload/files/TOAN%20GT%20ON%20THI.pdf">Lịch &ocirc;n thi ng&agrave;nh To&aacute;n Giải t&iacute;ch</a></span></p>\r\n<p>\r\n	<span style="font-size:28px;"><a href="/public/upload/files/Lich%20on%20thi%20cao%20hoc%20TC-NH%20co%20chinh%20sua.pdf">Lịch &ocirc;n thi ng&agrave;nh T&agrave;i ch&iacute;nh Ng&acirc;n h&agrave;ng</a></span></p>\r\n<p>\r\n	<span style="font-size:28px;"><a href="/public/upload/files/Lich%20on%20thi%20cao%20hoc%20Ngon%20ngu%20hoc%20co%20chinh%20sua.pdf">Lịch &ocirc;n thi ng&agrave;nh Ng&ocirc;n ngữ học</a></span></p>\r\n<p>\r\n	<span style="font-size:28px;"><a href="/public/upload/files/QLGD%20ON%20THI.pdf">Lịch &ocirc;n thi ng&agrave;nh Quản l&yacute; Gi&aacute;o dục</a></span></p>\r\n', '2014-12-04 01:18:11', 1070, 1, 1, 5, 1, NULL, 0, 0, NULL),
(55, 'ĐỀ CƯƠNG ÔN THI CAO HỌC ĐẠI HỌC SÀI GÒN KHÓA 14.2 NĂM 2014', '<p>\r\n	<span style="font-size:26px;"><a href="/public/upload/files/De%20cuong%20on%20tap%20cao%20hoc%20mon%20Giai%20tich%20ham.pdf">Đề cương &ocirc;n tập m&ocirc;n Giải t&iacute;ch h&agrave;m</a></span></p>\r\n<p>\r\n	<span style="font-size:26px;"><a href="/public/upload/files/De%20cuong%20on%20tap%20cao%20hoc%20mon%20Giai%20tich%20va%20Dai%20so.pdf">Đề cương &ocirc;n tập m&ocirc;n Giải t&iacute;ch v&agrave; Đại số</a></span></p>\r\n<p>\r\n	<span style="font-size:26px;"><a href="/public/upload/files/De%20cuong%20on%20tap%20mon%20Logic%20hoc.pdf">Đề cương &ocirc;n tập m&ocirc;n Logic học</a></span></p>\r\n<p>\r\n	<span style="font-size:26px;"><a href="/public/upload/files/De%20cuong%20on%20tap%20cao%20hoc%20mon%20Ngon%20ngu%20hoc.pdf">Đề cương &ocirc;n tập m&ocirc;n Ng&ocirc;n ngữ học</a></span></p>\r\n<p>\r\n	<span style="font-size:26px;"><a href="/public/upload/files/De%20cuong%20on%20tap%20cao%20hoc%20mon%20Toan%20kinh%20te.pdf">Đề cương &ocirc;n tập m&ocirc;n To&aacute;n kinh tế</a></span></p>\r\n<p>\r\n	<a href="/public/upload/files/De%20cuong%20on%20tap%20cao%20hoc%20mon%20Triet%20hoc.pdf"><span style="font-size:26px;">Đề cương &ocirc;n tập m&ocirc;n Triết học</span></a></p>\r\n', '2014-12-04 03:01:09', 2379, 1, 1, 5, 1, NULL, 0, 0, NULL),
(56, 'Thông báo về việc nộp học phí và kinh phí đào tạo xa đợt 3 của học viên cao học khoá 21 (2013-2015) Trường Đại học Vinh liên kết đào tạo tại Trường Đại học Sài Gòn', '<p>\r\n	<img alt="" src="/public/upload/images/001.jpg" style="width: 600px; height: 865px;" /></p>\r\n<p>\r\n	<a href="/public/upload/files/Thong%20bao%20hoc%20phi%20K21.jpg"><span style="font-size:28px;">Bấm v&agrave;o đ&acirc;y để tải th&ocirc;ng b&aacute;o</span></a></p>\r\n', '2014-12-17 03:06:19', 636, 1, 1, 6, 1, NULL, 0, 0, NULL),
(57, 'Thông báo về thi hết môn cao học Vinh Khóa 21 và Khóa 22 ngày 18, 19/12/2014', '<div>\r\n	<span class="im" style="color: rgb(80, 0, 80); font-family: arial, sans-serif; font-size: 13px;">Thời gian học vi&ecirc;n tập trung:</span></div>\r\n<div>\r\n	<span class="im" style="color: rgb(80, 0, 80); font-family: arial, sans-serif; font-size: 13px;">&nbsp; &nbsp; &nbsp; &nbsp;- S&aacute;ng: 7 giờ 30</span></div>\r\n<div>\r\n	<span class="im" style="color: rgb(80, 0, 80); font-family: arial, sans-serif; font-size: 13px;">&nbsp; &nbsp; &nbsp; &nbsp;- Chiều: 13 giờ 30</span></div>\r\n<div style="font-family: arial, sans-serif; font-size: 13px;">\r\n	&nbsp; &nbsp; &nbsp; &nbsp;Khi v&agrave;o ph&ograve;ng thi, học vi&ecirc;n phải xuất tr&igrave;nh thẻ học vi&ecirc;n hoặc chứng minh nh&acirc;n d&acirc;n (c&aacute;c giấy tờ thay thế hợp lệ kh&aacute;c).</div>\r\n<div style="font-family: arial, sans-serif; font-size: 13px;">\r\n	&nbsp;</div>\r\n<div style="font-family: arial, sans-serif; font-size: 13px;">\r\n	&nbsp;</div>\r\n<div style="font-family: arial, sans-serif; font-size: 13px;">\r\n	<span style="font-size:24px;"><a href="/public/upload/files/DS%20Phong%20thi%20Khoa%2021.rar">Bấm v&agrave;o đ&acirc;y để tải danh s&aacute;ch ph&ograve;ng thi K21</a></span></div>\r\n<div style="font-family: arial, sans-serif; font-size: 13px;">\r\n	<a href="/public/upload/files/DS%20Phong%20thi%20K22%20Anh%20van.rar"><span style="font-size: 24px;">Bấm v&agrave;o đ&acirc;y để tải danh s&aacute;ch ph&ograve;ng thi K22 Anh văn</span></a></div>\r\n<div style="font-family: arial, sans-serif; font-size: 13px;">\r\n	<a href="/public/upload/files/DS%20Phong%20thi%20K22%20Triet.rar"><span style="font-size: 24px;">Bấm v&agrave;o đ&acirc;y để tải danh s&aacute;ch ph&ograve;ng thi K22 Triết</span></a></div>\r\n', '2014-12-17 10:39:23', 575, 1, 1, 6, 1, NULL, 0, 0, NULL),
(58, 'Lịch học và phòng học các lớp Cao học liên kết Đại học Vinh Khóa 22 tháng 1 năm 2015', '<p>\r\n	<a href="/public/upload/files/Lich%20hoc%20cao%20hoc%20Vinh%20Khoa%2022%20thang%201.rar"><span style="font-size:28px;">Bấm v&agrave;o đ&acirc;y để tải lịch học</span></a></p>\r\n', '2014-12-29 07:11:31', 693, 1, 1, 6, 1, NULL, 0, 0, NULL),
(59, 'KẾT QUẢ ĐIỂM THI TUYỂN SINH CAO HỌC KHÓA 14.2 NĂM 2014', '<p>\r\n	<img alt="" src="/public/upload/images/scan0001.jpg" style="width: 600px; height: 862px;" /></p>\r\n<p>\r\n	<img alt="" src="/public/upload/images/scan0002.jpg" style="width: 600px; height: 860px;" /></p>\r\n<p>\r\n	<img alt="" src="/public/upload/images/scan0003.jpg" style="width: 600px; height: 866px;" /></p>\r\n<p>\r\n	<img alt="" src="/public/upload/images/scan0004.jpg" style="width: 600px; height: 866px;" /></p>\r\n<p>\r\n	<img alt="" src="/public/upload/images/scan0005.jpg" style="width: 600px; height: 862px;" /></p>\r\n<p>\r\n	<img alt="" src="/public/upload/images/scan0006.jpg" style="width: 600px; height: 863px;" /></p>\r\n<p>\r\n	<img alt="" src="/public/upload/images/scan0007.jpg" style="width: 600px; height: 850px;" /></p>\r\n<p>\r\n	<img alt="" src="/public/upload/images/scan0008.jpg" style="width: 600px; height: 862px;" /></p>\r\n<p>\r\n	<img alt="" src="/public/upload/images/scan0009.jpg" style="width: 600px; height: 860px;" /></p>\r\n<p>\r\n	<img alt="" src="/public/upload/images/scan0010.jpg" style="width: 600px; height: 862px;" /></p>\r\n<p>\r\n	&nbsp;</p>\r\n<p>\r\n	&nbsp;</p>\r\n', '2015-01-01 04:41:26', 1374, 1, 1, 5, 1, '1420087285_scan0001.jpg', 0, 1, NULL),
(60, 'Thông báo tuyển sinh đào tạo trình độ Thạc sĩ đợt 1 năm 2015 liên kết với Trường Đại học Vinh tại Trường Đại học Sài Gòn', '<p>\r\n	<img alt="" src="/public/upload/images/001%281%29.jpg" style="width: 700px; height: 964px;" /></p>\r\n<p>\r\n	<img alt="" src="/public/upload/images/002.jpg" style="width: 700px; height: 964px;" /></p>\r\n<p>\r\n	<img alt="" src="/public/upload/images/003.jpg" style="width: 700px; height: 964px;" /></p>\r\n<p>\r\n	<img alt="" src="/public/upload/images/004.jpg" style="width: 700px; height: 964px;" /></p>\r\n<p>\r\n	<img alt="" src="/public/upload/images/005.jpg" style="width: 700px; height: 964px;" /></p>\r\n<p>\r\n	<img alt="" src="/public/upload/images/006.jpg" style="width: 700px; height: 964px;" /></p>\r\n<p>\r\n	<img alt="" src="/public/upload/images/007.jpg" style="width: 700px; height: 964px;" /></p>\r\n<p>\r\n	<img alt="" src="/public/upload/images/008.jpg" style="width: 700px; height: 964px;" /></p>\r\n<p>\r\n	<img alt="" src="/public/upload/images/009.jpg" style="width: 700px; height: 964px;" /></p>\r\n', '2015-01-06 08:54:08', 5835, 1, 1, 6, 1, NULL, 1, 1, NULL),
(61, 'Thông báo kết quả thi chính thức, điểm chuẩn, phúc khảo điểm của kỳ thi Tuyển sinh và Lịch khai giảng Cao học Khóa 14.2', '<p>\r\n	&nbsp;</p>\r\n<table border="0" cellpadding="0" cellspacing="0" style="width:671px;" width="671">\r\n	<tbody>\r\n		<tr>\r\n			<td style="width:284px;">\r\n				<p align="center">\r\n					UBND TP. HỒ CH&Iacute; MINH</p>\r\n				<p align="center">\r\n					TRƯỜNG ĐẠI HỌC S&Agrave;I G&Ograve;N</p>\r\n				<p align="center">\r\n					<strong>HỘI ĐỒNG TUYỂN SINH CAO HỌC</strong></p>\r\n				<p align="center">\r\n					<img height="2" src="file:///C:/Users/MYPC~1/AppData/Local/Temp/msohtmlclip1/01/clip_image001.png" width="115" /></p>\r\n			</td>\r\n			<td style="width:387px;">\r\n				<p align="center">\r\n					<strong>&nbsp;&nbsp;&nbsp;&nbsp; CỘNG H&Ograve;A X&Atilde; HỘI CHỦ NGHĨA VIỆT NAM</strong></p>\r\n				<p align="center">\r\n					<strong>&nbsp;&nbsp;&nbsp;&nbsp; Độc lập - Tự do - Hạnh ph&uacute;c</strong></p>\r\n				<p align="center">\r\n					<img height="2" src="file:///C:/Users/MYPC~1/AppData/Local/Temp/msohtmlclip1/01/clip_image002.png" width="210" /></p>\r\n			</td>\r\n		</tr>\r\n		<tr>\r\n			<td style="width:284px;">\r\n				<p align="center">\r\n					&nbsp;</p>\r\n				<p align="center">\r\n					&nbsp;</p>\r\n			</td>\r\n			<td style="width:387px;">\r\n				<p align="center" style="margin-left:-10.75pt;">\r\n					<em>&nbsp;Th&agrave;nh phố Hồ Ch&iacute; Minh, ng&agrave;y 31 th&aacute;ng 12 năm 2014</em></p>\r\n			</td>\r\n		</tr>\r\n	</tbody>\r\n</table>\r\n<p align="center">\r\n	<strong>TH&Ocirc;NG B&Aacute;O KẾT QUẢ THI CH&Iacute;NH THỨC, ĐIỂM CHUẨN, </strong></p>\r\n<p align="center">\r\n	<strong>PH&Uacute;C KHẢO ĐIỂM CỦA KỲ THI TUYỂN SINH V&Agrave; </strong></p>\r\n<p style="text-align: center;">\r\n	<strong>LỊCH KHAI GIẢNG CAO HỌC KH&Oacute;A 14.2&nbsp;</strong></p>\r\n<p>\r\n	<strong>I. Ti&ecirc;u chuẩn x&eacute;t tr&uacute;ng tuyển</strong></p>\r\n<p>\r\n	Th&iacute; sinh được x&eacute;t tr&uacute;ng tuyển nếu thỏa m&atilde;n hai điều kiện sau đ&acirc;y:</p>\r\n<p>\r\n	1. Điểm thi m&ocirc;n cơ sở v&agrave; m&ocirc;n cơ bản đạt từ 5 điểm trở l&ecirc;n, điểm m&ocirc;n Ngoại ngữ (Anh văn) đạt từ 50 điểm trở l&ecirc;n;</p>\r\n<p>\r\n	2. Tổng điểm thi của m&ocirc;n cơ sở v&agrave; m&ocirc;n cơ bản kh&ocirc;ng thấp hơn mức điểm chuẩn. Dưới đ&acirc;y l&agrave; mức điểm chuẩn cho c&aacute;c chuy&ecirc;n ng&agrave;nh:</p>\r\n<table align="center" border="1" cellpadding="0" cellspacing="0">\r\n	<tbody>\r\n		<tr>\r\n			<td style="width:47px;">\r\n				<p align="center">\r\n					<strong>STT</strong></p>\r\n			</td>\r\n			<td style="width:186px;">\r\n				<p align="center">\r\n					<strong>Chuy&ecirc;n ng&agrave;nh</strong></p>\r\n			</td>\r\n			<td style="width:112px;">\r\n				<p align="center">\r\n					<strong>M&atilde; số</strong></p>\r\n			</td>\r\n			<td style="width:153px;">\r\n				<p align="center">\r\n					<strong>Mức điểm chuẩn</strong></p>\r\n			</td>\r\n		</tr>\r\n		<tr>\r\n			<td style="width:47px;">\r\n				<p align="center">\r\n					1</p>\r\n			</td>\r\n			<td style="width:186px;">\r\n				<p>\r\n					Quản l&yacute; gi&aacute;o dục</p>\r\n			</td>\r\n			<td style="width:112px;">\r\n				<p align="center">\r\n					60140114</p>\r\n			</td>\r\n			<td style="width:153px;">\r\n				<p align="center">\r\n					12</p>\r\n			</td>\r\n		</tr>\r\n		<tr>\r\n			<td style="width:47px;">\r\n				<p align="center">\r\n					2</p>\r\n			</td>\r\n			<td style="width:186px;">\r\n				<p>\r\n					T&agrave;i ch&iacute;nh - Ng&acirc;n h&agrave;ng</p>\r\n			</td>\r\n			<td style="width:112px;">\r\n				<p align="center">\r\n					60340201</p>\r\n			</td>\r\n			<td style="width:153px;">\r\n				<p align="center">\r\n					12</p>\r\n			</td>\r\n		</tr>\r\n		<tr>\r\n			<td style="width:47px;">\r\n				<p align="center">\r\n					3</p>\r\n			</td>\r\n			<td style="width:186px;">\r\n				<p>\r\n					To&aacute;n Giải t&iacute;ch</p>\r\n			</td>\r\n			<td style="width:112px;">\r\n				<p align="center">\r\n					60460102</p>\r\n			</td>\r\n			<td style="width:153px;">\r\n				<p align="center">\r\n					10</p>\r\n			</td>\r\n		</tr>\r\n		<tr>\r\n			<td style="width:47px;">\r\n				<p align="center">\r\n					4</p>\r\n			</td>\r\n			<td style="width:186px;">\r\n				<p>\r\n					Ng&ocirc;n ngữ học</p>\r\n			</td>\r\n			<td style="width:112px;">\r\n				<p align="center">\r\n					60220240</p>\r\n			</td>\r\n			<td style="width:153px;">\r\n				<p align="center">\r\n					11</p>\r\n			</td>\r\n		</tr>\r\n	</tbody>\r\n</table>\r\n<div style="clear:both;">\r\n	&nbsp;</div>\r\n<p>\r\n	<strong>II. Danh s&aacute;ch th&iacute; sinh tr&uacute;ng tuyển </strong>(<a href="/public/upload/files/Danh%20sach%20trung%20tuyen.pdf"><strong>bấm v&agrave;o &nbsp;đ&acirc;y để t&agrave;i</strong></a>)</p>\r\n<p>\r\n	Th&iacute; sinh tr&uacute;ng tuyển đến nhận trực tiếp Giấy b&aacute;o nhập học tại Ph&ograve;ng Quản l&yacute; Khoa học v&agrave; Sau đại học (ph&ograve;ng C010, Số 273 An Dương Vương, Phường 3, Quận 5, TP. Hồ Ch&iacute; Minh) v&agrave;o c&aacute;c ng&agrave;y 07 v&agrave; 08/01/2015.</p>\r\n<p>\r\n	Sau ng&agrave;y 08/01/2015, đối với những th&iacute; sinh chưa đến nhận Giấy b&aacute;o nhập học, Hội đồng tuyển sinh sẽ gửi Giấy b&aacute;o nhập học theo đường bưu điện tới địa chỉ ghi trong Hồ sơ dự thi.</p>\r\n<p>\r\n	<strong>III. Ph&uacute;c khảo điểm</strong></p>\r\n<p>\r\n	Hội đồng tuyển sinh cao học nhận Đơn đăng k&yacute; ph&uacute;c khảo từ ng&agrave;y ra th&ocirc;ng b&aacute;o đến trước 15h00 ng&agrave;y 12/01/2015.</p>\r\n<p>\r\n	- Mẫu Đơn đăng k&yacute; ph&uacute;c khảo (<strong><a href="/public/upload/files/Don%20dang%20ky%20phuc%20khao.doc">bấm v&agrave;o đ&acirc;y để tải</a></strong>);</p>\r\n<p>\r\n	- Th&iacute; sinh nộp trực tiếp Đơn đăng k&yacute; ph&uacute;c khảo v&agrave; lệ ph&iacute; tại Ph&ograve;ng Quản l&yacute; Khoa học v&agrave; Sau đại học</p>\r\n<p>\r\n	(ph&ograve;ng C010, Số 273 An Dương Vương, Phường 3, Quận 5, TP. Hồ Ch&iacute; Minh);</p>\r\n<p>\r\n	- Mức thu lệ ph&iacute; chấm ph&uacute;c khảo: 50.000 đồng/m&ocirc;n thi; số tiền n&agrave;y sẽ ho&agrave;n trả lại cho th&iacute; sinh trong trường hợp c&oacute; sự ch&ecirc;nh lệch điểm giữa kết quả chấm ph&uacute;c khảo v&agrave; kết quả thi đ&atilde; c&ocirc;ng bố;</p>\r\n<p>\r\n	- Kết quả chấm ph&uacute;c khảo sẽ được c&ocirc;ng bố sau ng&agrave;y 12/01/2015 (th&iacute; sinh xem tr&ecirc;n trang web của Ph&ograve;ng QLKH&amp;SĐH,</p>\r\n<p>\r\n	Trường Đại học S&agrave;i G&ograve;n).</p>\r\n<p>\r\n	<strong>IV. Lịch khai giảng</strong></p>\r\n<p>\r\n	Th&iacute; sinh tr&uacute;ng tuyển đến l&agrave;m thủ tục nhập học từ 7giờ 30 v&agrave; dự lễ khai giảng l&uacute;c 9 giờ s&aacute;ng ng&agrave;y 18/01/2015 (chủ nhật) tại Hội trường A, Trường Đại học S&agrave;i G&ograve;n, Số 273 An Dương Vương, Phường 3, Quận 5, TP. Hồ Ch&iacute; Minh.</p>\r\n<p>\r\n	Khi đi, th&iacute; sinh nhớ mang theo giấy b&aacute;o tr&uacute;ng tuyển v&agrave; nhập học./.</p>\r\n<p>\r\n	&nbsp;</p>\r\n<p>\r\n	<strong>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;KT. CHỦ TỊCH HỘI ĐỒNG TUYỂN SINH </strong></p>\r\n<p style="margin-left: 80px;">\r\n	<strong>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;PH&Oacute; CHỦ TỊCH</strong></p>\r\n<p>\r\n	&nbsp;</p>\r\n<p style="margin-left: 80px;">\r\n	&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; (Đ&atilde; k&yacute;)&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</p>\r\n<p>\r\n	&nbsp;</p>\r\n<p style="margin-left: 360px;">\r\n	&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;<strong>PH&Oacute; HIỆU TRƯỞNG</strong></p>\r\n<p style="margin-left: 80px;">\r\n	<strong>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; PGS.TS. Phạm Ho&agrave;ng Qu&acirc;n</strong></p>\r\n', '2015-01-07 07:27:00', 1438, 1, 1, 5, 1, NULL, 0, 0, NULL);
INSERT INTO `thong_bao` (`id`, `tieu_de`, `noi_dung`, `ngay_tao`, `so_lan_xem`, `trang_thai`, `ma_quan_tri`, `loai`, `search`, `file`, `quan_trong`, `noi_bat`, `file_pdf`) VALUES
(62, 'HƯỚNG DẪN NHẬP HỌC CAO HỌC KHÓA 14.2 NĂM 2014', '<p style="margin-left: 40px;">\r\n	&nbsp; &nbsp; &nbsp;UỶ BAN NH&Acirc;N D&Acirc;N&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<strong>CỘNG H&Ograve;A X&Atilde; HỘI CHỦ NGHĨA VIỆT NAM</strong></p>\r\n<p>\r\n	&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;TH&Agrave;NH PHỐ HỒ CH&Iacute; MINH &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;&nbsp;<strong><u>Độc lập &ndash; Tự do &ndash; Hạnh ph&uacute;c</u></strong></p>\r\n<p>\r\n	<strong>&nbsp; &nbsp; &nbsp; &nbsp; &nbsp;TRƯỜNG ĐẠI HỌC S&Agrave;I G&Ograve;N &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;&nbsp;</strong></p>\r\n<p>\r\n	&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<em>Th&agrave;nh phố Hồ Ch&iacute; Minh, ng&agrave;y 05 th&aacute;ng 01 năm 2015</em></p>\r\n<p align="center">\r\n	<strong>HƯỚNG DẪN NHẬP HỌC CAO HỌC KH&Oacute;A 14.2 NĂM 2014</strong></p>\r\n<p style="margin-left:35.45pt;">\r\n	<strong>I.</strong><strong>ĐỊA ĐIỂM NHẬP HỌC:</strong></p>\r\n<p>\r\n	&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; Tại Trường Đại học S&agrave;i G&ograve;n, số 273, An Dương Vương, Phường 3, Quận 5, &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Th&agrave;nh phố Hồ Ch&iacute; Minh.</p>\r\n<p style="margin-left:35.45pt;">\r\n	<strong>II.</strong><strong>THỜI GIAN NHẬP HỌC: </strong>Ng&agrave;y 18 th&aacute;ng 01 năm 2015 tại Hội trường A.</p>\r\n<p style="margin-left: 40px;">\r\n	- Từ 7h30 đến 9h: L&agrave;m thủ tục nhập học;</p>\r\n<p style="margin-left: 40px;">\r\n	- Từ 9h đến 10h: Tham dự lễ khai giảng Cao học kh&oacute;a 14.2 năm 2014;</p>\r\n<p style="margin-left: 40px;">\r\n	- Từ 10h đến11h30: Học quy chế đ&agrave;o tạo.</p>\r\n<p style="margin-left:35.45pt;">\r\n	<strong>III.</strong><strong>&nbsp;&nbsp;QUY TR&Igrave;NH NHẬP HỌC:</strong></p>\r\n<p>\r\n	&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; Học vi&ecirc;n Kh&oacute;a 14.2 đến l&agrave;m thủ tục nhập học cần thực hiện c&aacute;c việc sau:</p>\r\n<p style="margin-left: 40px;">\r\n	- Tr&igrave;nh giấy b&aacute;o nhập học;</p>\r\n<p style="margin-left: 40px;">\r\n	- Nộp 01 bản photocopy c&oacute; c&ocirc;ng chứng Bằng tốt nghiệp Đại học v&agrave; tr&igrave;nh bản gốc;</p>\r\n<p style="margin-left: 40px;">\r\n	- Nộp 04 ảnh cỡ 3x4 (ghi r&otilde; họ t&ecirc;n, ng&agrave;y th&aacute;ng năm sinh, chuy&ecirc;n ng&agrave;nh v&agrave;o sau ảnh);</p>\r\n<p style="margin-left: 40px;">\r\n	- Nhận mẫu L&yacute; lịch học vi&ecirc;n để k&ecirc; khai v&agrave; nộp lại;</p>\r\n<p style="margin-left: 40px;">\r\n	- Kinh ph&iacute; học tập nạp theo từng năm học. Năm 2014-2015 thu 2 đợt.</p>\r\n<table border="1" cellpadding="0" cellspacing="0" width="643">\r\n	<tbody>\r\n		<tr>\r\n			<td rowspan="2" style="width:141px;">\r\n				<p align="center">\r\n					<strong>Loại ph&iacute;</strong></p>\r\n			</td>\r\n			<td colspan="2" style="width:237px;">\r\n				<p align="center">\r\n					<strong>Ng&ocirc;n ngữ học, Quản l&yacute; GD, </strong></p>\r\n				<p align="center">\r\n					<strong>T&agrave;i ch&iacute;nh-Ng&acirc;n h&agrave;ng</strong></p>\r\n			</td>\r\n			<td colspan="2" style="width:265px;">\r\n				<p align="center">\r\n					<strong>To&aacute;n Giải t&iacute;ch</strong></p>\r\n			</td>\r\n		</tr>\r\n		<tr>\r\n			<td style="width:114px;">\r\n				<p align="center">\r\n					<strong>Đợt 1</strong></p>\r\n			</td>\r\n			<td style="width:123px;">\r\n				<p align="center">\r\n					<strong>Đợt 2</strong></p>\r\n			</td>\r\n			<td style="width:132px;">\r\n				<p align="center">\r\n					<strong>Đợt 1</strong></p>\r\n			</td>\r\n			<td style="width:132px;">\r\n				<p align="center">\r\n					<strong>Đợt 2</strong></p>\r\n			</td>\r\n		</tr>\r\n		<tr>\r\n			<td style="width:141px;">\r\n				<p>\r\n					Học ph&iacute;</p>\r\n			</td>\r\n			<td style="width:114px;">\r\n				<p>\r\n					<strong>&nbsp;&nbsp; 4.000.000đ</strong></p>\r\n			</td>\r\n			<td style="width:123px;">\r\n				<p align="center">\r\n					4.250.000đ</p>\r\n			</td>\r\n			<td style="width:132px;">\r\n				<p align="center">\r\n					<strong>4.500.000đ</strong></p>\r\n			</td>\r\n			<td style="width:132px;">\r\n				<p align="center">\r\n					5.250.000đ</p>\r\n			</td>\r\n		</tr>\r\n		<tr>\r\n			<td style="width:141px;">\r\n				<p>\r\n					Kinh ph&iacute; hỗ trợ đ&agrave;o tạo</p>\r\n			</td>\r\n			<td style="width:114px;">\r\n				<p>\r\n					<strong>&nbsp;&nbsp; 1.500.000đ</strong></p>\r\n			</td>\r\n			<td style="width:123px;">\r\n				<p align="center">\r\n					2.000.000đ</p>\r\n			</td>\r\n			<td style="width:132px;">\r\n				<p align="center">\r\n					<strong>1.500.000đ</strong></p>\r\n			</td>\r\n			<td style="width:132px;">\r\n				<p align="center">\r\n					2.000.000đ</p>\r\n			</td>\r\n		</tr>\r\n		<tr>\r\n			<td style="width:141px;">\r\n				<p>\r\n					Lệ ph&iacute; tổ chức lễ khai giảng, l&agrave;m thủ tục nhập học, l&agrave;m thẻ học vi&ecirc;n</p>\r\n			</td>\r\n			<td style="width:114px;">\r\n				<p>\r\n					<strong>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; 600.000đ</strong></p>\r\n			</td>\r\n			<td style="width:123px;">\r\n				<p align="center">\r\n					&nbsp;</p>\r\n			</td>\r\n			<td style="width:132px;">\r\n				<p align="center">\r\n					<strong>600.000đ</strong></p>\r\n			</td>\r\n			<td style="width:132px;">\r\n				<p align="center">\r\n					&nbsp;</p>\r\n			</td>\r\n		</tr>\r\n		<tr>\r\n			<td style="width:141px;">\r\n				<p>\r\n					<strong>Tổng cộng</strong></p>\r\n			</td>\r\n			<td style="width:114px;">\r\n				<p>\r\n					<strong>&nbsp;&nbsp; 6.100.000đ</strong></p>\r\n			</td>\r\n			<td style="width:123px;">\r\n				<p align="center">\r\n					6.250.000đ</p>\r\n			</td>\r\n			<td style="width:132px;">\r\n				<p align="center">\r\n					<strong>6.600.000đ</strong></p>\r\n			</td>\r\n			<td style="width:132px;">\r\n				<p align="center">\r\n					7.250.000đ</p>\r\n			</td>\r\n		</tr>\r\n	</tbody>\r\n</table>\r\n<p>\r\n	&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;<strong>TL. HIỆU TRƯỞNG</strong></p>\r\n<p>\r\n	&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; <strong>Q. TRƯỞNG PH&Ograve;NG QLKH&amp;SĐH</strong></p>\r\n<p>\r\n	&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp; (Đ&atilde;&nbsp; k&yacute;)</p>\r\n<p>\r\n	&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp; <strong>TS. Tạ Quang Sơn</strong></p>\r\n<p>\r\n	&nbsp;</p>\r\n<p>\r\n	&nbsp;</p>\r\n<p>\r\n	<em>Ghi ch&uacute;:&nbsp; Nếu c&oacute; g&igrave; chưa r&otilde;, Anh (Chị) li&ecirc;n hệ với Ph&ograve;ng QLKH&amp;SĐH Trường Đại học S&agrave;i G&ograve;n, 273 An Dương Vương, Phường 3, Quận 5, TP. Hồ Ch&iacute; Minh &ndash; ĐT: 08. 38303108.</em></p>\r\n', '2015-01-08 04:10:36', 957, 1, 1, 5, 1, NULL, 0, 0, NULL),
(63, 'Danh sách đề tài NCKH cấp trường của Sinh viên năm học 2014-2015', '<p>\r\n	<img alt="" src="/public/upload/images/001%282%29.jpg" style="width: 700px; height: 964px;" /></p>\r\n<p>\r\n	<img alt="" src="/public/upload/images/002%281%29.jpg" style="width: 700px; height: 508px;" /></p>\r\n<p>\r\n	<img alt="" src="/public/upload/images/003%281%29.jpg" style="width: 700px; height: 508px;" /></p>\r\n<p>\r\n	<img alt="" src="/public/upload/images/004%281%29.jpg" style="width: 700px; height: 508px;" /></p>\r\n<p>\r\n	<img alt="" src="/public/upload/images/005%281%29.jpg" style="width: 700px; height: 508px;" /></p>\r\n<p>\r\n	<img alt="" src="/public/upload/images/006%281%29.jpg" style="width: 700px; height: 508px;" /></p>\r\n<p>\r\n	<img alt="" src="/public/upload/images/007%281%29.jpg" style="width: 700px; height: 508px;" /></p>\r\n', '2015-01-08 07:41:24', 370, 1, 1, 1, 1, NULL, 0, 1, NULL),
(64, 'LỊCH THI KẾT THÚC HỌC PHẦN CAO HỌC VINH KHÓA 21 VÀ KHÓA 22 NGÀY 29, 30/01', '<p>\r\n	<a href="/public/upload/files/Lich-thi-CH21_Dot4-tai-SG.pdf"><span style="font-size:28px;">Bấm v&agrave;o đ&acirc;y để tải lịch thi cao học Kh&oacute;a 21</span></a></p>\r\n<p>\r\n	<a href="/public/upload/files/Lich-thi-CH22_Dot2-tai-SG.pdf"><span style="font-size:28px;">Bấm v&agrave;o đ&acirc;y để tải lịch thi cao học Kh&oacute;a 22</span></a></p>\r\n<p>\r\n	<a href="/public/upload/files/Danh%20sach%20thi%20bo%20sung-thi%20lai_21%20SG_D1.pdf"><span style="font-size:28px;">Bấm v&agrave;o đ&acirc;y để tải danh s&aacute;ch thi bổ sung, thi lại Kh&oacute;a 21</span></a></p>\r\n', '2015-01-09 11:37:40', 1020, 1, 1, 6, 1, NULL, 1, 1, NULL),
(65, 'Thông báo cung cấp thông tin khoa học cá nhân', '<p>\r\n	<img alt="" src="/public/upload/images/001%283%29.jpg" style="width: 700px; height: 964px;" /></p>\r\n', '2015-01-15 09:17:01', 580, 1, 1, 1, 1, '1421313419_001.jpg', 1, 1, NULL),
(66, 'Quy định về định mức kinh phí nghiên cứu khoa học; biên soạn giáo trình; khen thưởng CBGV đat học vị, học hàm và có công trình khoa học', '<p>\r\n	<img alt="" src="/public/upload/images/Scan%20228.jpg" style="width: 700px; height: 997px;" /></p>\r\n<p>\r\n	<img alt="" src="/public/upload/images/Scan%20229.jpg" style="width: 700px; height: 902px;" /></p>\r\n<p>\r\n	<img alt="" src="/public/upload/images/Scan%20230.jpg" style="width: 700px; height: 963px;" /></p>\r\n<p>\r\n	<img alt="" src="/public/upload/images/Scan%20231.jpg" style="width: 700px; height: 968px;" /></p>\r\n', '2015-01-16 09:10:58', 312, 1, 1, 1, 1, '1421399457_scan-228.jpg', 0, 1, NULL),
(67, 'Thông báo về việc thưởng kinh phí đề tài NCKH cấp trường (Đợt 1 năm 2015)', '<p>\r\n	<img alt="" src="/public/upload/images/001%284%29.jpg" style="width: 700px; height: 964px;" /></p>\r\n<p>\r\n	<img alt="" src="/public/upload/images/002%282%29.jpg" style="width: 700px; height: 508px;" /></p>\r\n<p>\r\n	<img alt="" src="/public/upload/images/003%282%29.jpg" style="width: 700px; height: 508px;" /></p>\r\n<p>\r\n	<img alt="" src="/public/upload/images/004%282%29.jpg" style="width: 700px; height: 508px;" /></p>\r\n', '2015-01-19 08:46:02', 299, 1, 1, 1, 1, '1421657160_001.jpg', 0, 1, NULL),
(68, 'LỊCH HỌC CAO HỌC KHÓA 14.2 MÔN TRIẾT HỌC VÀ TIẾNG ANH', '<p>\r\n	<span style="font-size:26px;"><a href="/public/upload/files/Lich%20hoc%20cao%20hoc%20K14.2%20Toan%20Giai%20tich.rar">Bấm v&agrave;o đ&acirc;y để tải lịch học ng&agrave;nh To&aacute;n - Giải t&iacute;ch</a></span></p>\r\n<p>\r\n	<span style="font-size:26px;"><a href="/public/upload/files/Lich%20hoc%20cao%20hoc%20K14.2%20Ngon%20ngu%20hoc.rar">Bấm v&agrave;o đ&acirc;y để tải lịch học ng&agrave;nh Ng&ocirc;n ngữ học</a></span></p>\r\n<p>\r\n	<span style="font-size:26px;"><a href="/public/upload/files/Lich%20hoc%20cao%20hoc%20K14.2%20Tai%20chinh%20-%20Ngan%20hang.rar">Bấm v&agrave;o đ&acirc;y để tải lịch học ng&agrave;nh T&agrave;i ch&iacute;nh - Ng&acirc;n h&agrave;ng</a></span></p>\r\n<p>\r\n	<span style="font-size:26px;"><a href="/public/upload/files/Lich%20hoc%20cao%20hoc%20K14.2%20Quan%20li%20giao%20duc.rar">Bấm v&agrave;o đ&acirc;y để tải lịch học ng&agrave;nh Quản l&iacute; Gi&aacute;o dục</a></span></p>\r\n', '2015-01-19 10:00:22', 983, 1, 1, 5, 1, NULL, 1, 1, NULL),
(69, 'Thông báo về việc nhận đăng ký nhiệm vụ NCKH năm học 2015-2016', '<p>\r\n	<img alt="" src="/public/upload/images/001%285%29.jpg" style="width: 700px; height: 964px;" /></p>\r\n', '2015-01-20 03:43:49', 320, 1, 1, 1, 1, '1421725427_001.jpg', 0, 1, NULL),
(70, 'DANH SÁCH TÁC GIẢ/ĐỒNG TÁC GIẢ ĐƯỢC THƯỞNG CÔNG TRÌNH KHOA HỌC ĐỢT  4', '<p>\r\n	<span style="font-size:26px;"><a href="/public/upload/files/Danh%20s%C3%A1ch%20b%C3%A0i%20b%C3%A1o%20%C4%91%E1%BB%A3t%204.pdf">Bấm v&agrave;o đ&acirc;y để tải danh s&aacute;ch</a></span></p>\r\n', '2015-01-23 01:08:54', 480, 1, 1, 1, 1, NULL, 0, 1, '1421975334_danh-sach-bai-bao-dot-4.pdf'),
(71, 'DANH SÁCH PHÒNG THI KẾT THÚC HỌC PHẦN CAO HỌC VINH KHÓA 21 VÀ KHÓA 22', '<p>\r\n	<span style="font-size:20px;"><span style="font-family: arial, sans-serif;">Học vi&ecirc;n xem kỹ danh s&aacute;ch ph&ograve;ng thi theo từng m&ocirc;n v&agrave; c&oacute; mặt tại ph&ograve;ng thi đ&uacute;ng thời gian quy định</span></span></p>\r\n<p>\r\n	<span style="font-size:24px;"><a href="/public/upload/files/Danh%20sach%20du%20thi%20K21.rar">Bấm v&agrave;o đ&acirc;y để tải Danh s&aacute;ch dự thi Kho&aacute; 21</a></span></p>\r\n<p>\r\n	<span style="font-size:24px;"><a href="/public/upload/files/K22%20Phan%201.rar">Bấm v&agrave;o đ&acirc;y để tải Danh s&aacute;ch dự thi Kho&aacute; 22 Phần 1</a></span></p>\r\n<p>\r\n	<span style="font-size:24px;"><a href="/public/upload/files/K22%20Phan%202.rar">Bấm v&agrave;o đ&acirc;y để tải Danh s&aacute;ch dự thi Kho&aacute; 22 Phần 2</a></span></p>\r\n', '2015-01-23 10:24:46', 774, 1, 1, 6, 1, NULL, 1, 1, NULL),
(72, 'NHỮNG ĐIỀU CẦN BIẾT DÀNH CHO HỌC VIÊN CAO HỌC VINH', '<p>\r\n	<span style="font-size:22px;"><a href="/public/upload/files/DS%20Ma%20so%20hoc%20vien%20Khoa%2022%20dot%202.pdf">Bấm v&agrave;o đ&acirc;y để tải Danh s&aacute;ch M&atilde; số học vi&ecirc;n</a></span></p>\r\n', '2015-02-04 04:59:45', 1636, 1, 1, 6, 1, NULL, 1, 1, '1423025985_nhung-dieu-can-biet-cho-hoc-vien-cao-hoc-vinh.pdf'),
(73, 'Lịch học và phòng học các lớp Cao học liên kết Đại học Vinh Khóa 22 tháng 3 năm 2015', '<p>\r\n	<a href="/public/upload/files/Lich%20hoc%20va%20phong%20hoc%20cao%20hoc%20K22%20thang%203.rar" style="padding: 0px; margin: 0px; border-color: rgb(234, 234, 234); font-family: Tahoma, Arial, Helvetica, sans-serif; text-decoration: none; color: rgb(128, 153, 168); font-size: 14px;"><span style="color:#008080;"><span style="padding: 0px; margin: 0px; border-color: rgb(234, 234, 234); font-family: tahoma, arial, verdana, sans-serif; font-size: 28px;">Bấm v&agrave;o đ&acirc;y để tải lịch học</span></span></a></p>\r\n', '2015-02-24 04:59:51', 1156, 1, 1, 6, 1, NULL, 1, 1, NULL),
(74, 'Kế hoạch bồi dưỡng và thi chứng chỉ tiếng Anh B1 Cao học khóa 21 Đại học Vinh', '<p>\r\n	TB</p>\r\n', '2015-02-27 02:38:22', 566, 1, 1, 6, 1, NULL, 1, 1, '1425004702_thong-bao-ke-hoach-b1-cao-hoc-vinh.pdf'),
(75, 'Học phí và lệ phí lớp bồi dưỡng tiếng Anh B1 Cao học khóa 21', '<p>\r\n	TB</p>\r\n', '2015-02-27 02:40:48', 962, 1, 1, 6, 1, NULL, 1, 1, '1425004848_thong-bao-kinh-phi-b1-cao-hoc-vinh.pdf'),
(76, 'Thông báo mời tham gia Hội thảo khoa học "40 NĂM ĐẠI THẮNG MÙA XUÂN (30/04/1975) - NHÌN TỪ GÓC ĐỘ LỊCH SỬ, VĂN HOÁ"', '<p>\r\n	<span style="font-size:26px;"><a href="/public/upload/files/Thong%20bao%20tham%20gia%20Hoi%20thao%2040%20nam%20dai%20thang%20mua%20xuan.pdf">Bấm v&agrave;o đ&acirc;y để tải th&ocirc;ng b&aacute;o</a></span></p>\r\n', '2015-02-27 02:58:02', 318, 1, 1, 2, 1, NULL, 1, 1, '1425005882_thong-bao-tham-gia-hoi-thao-40-nam-dai-thang-mua-xuan.pdf'),
(77, 'Đề cương ôn thi tuyển sinh trình độ thạc sỹ liên kết Đại học Vinh đợt 1 năm 2015 (cập nhật)', '<p>\r\n	<strong><span style="font-size:14px;">Tải đề cương &ocirc;n tập c&aacute;c m&ocirc;n:</span></strong></p>\r\n<ul>\r\n	<li>\r\n		<a href="/public/upload/files/De%20cuong%20mon%20thi%20tieng%20Anh.pdf"><span style="font-size:14px;">Tiếng Anh</span></a></li>\r\n	<li>\r\n		<a href="/public/upload/files/GDCT%2C%20CT_%20Chu%20nghia%20XHKH.doc"><span style="font-size: 14px;">GDCT, CT_Chủ nghĩa XHKH</span></a></li>\r\n	<li>\r\n		<a href="/public/upload/files/Giao%20duc%20hoc.doc"><span style="font-size: 14px;">Gi&aacute;o dục học</span></a></li>\r\n	<li>\r\n		<a href="/public/upload/files/Hoa_Co%20so%20LTHH%20va%20cau%20tao%20chat.doc"><span style="font-size: 14px;">Cơ sở LTHH v&agrave; cấu tạo chất</span></a></li>\r\n	<li>\r\n		<a href="/public/upload/files/LL%26PPDHBM%20Vat%20li.pdf"><span style="font-size: 14px;">LL&amp;PPDHBM Vật l&yacute;</span></a></li>\r\n	<li>\r\n		<a href="/public/upload/files/Ly%20luan%20van%20hoc.doc"><span style="font-size: 14px;">L&yacute; luận văn học</span></a></li>\r\n	<li>\r\n		<a href="/public/upload/files/Quang%20hoc.pdf"><span style="font-size: 14px;">Quang học</span></a></li>\r\n	<li>\r\n		<a href="/public/upload/files/Sinh%20hoc_Sinh%20hoc%20co%20so.doc"><span style="font-size: 14px;">Sinh học cơ sở</span></a></li>\r\n	<li>\r\n		<a href="/public/upload/files/Sinh%20hoc_Toan%20cho%20Sinh%20va%20NN.doc"><span style="font-size: 14px;">To&aacute;n cho Sinh v&agrave; NN</span></a></li>\r\n	<li>\r\n		<span style="font-size: 14px;"><a href="/public/upload/files/Toan_Dai%20so.doc">Đại s</a>ố&nbsp;</span></li>\r\n	<li>\r\n		<a href="/public/upload/files/Toan_Giai%20tich.doc"><span style="font-size: 14px;">Giải t&iacute;ch</span></a></li>\r\n	<li>\r\n		<a href="/public/upload/files/Triet%20hoc%20chuyen.doc"><span style="font-size: 14px;">Triết học chuy&ecirc;n</span></a></li>\r\n	<li>\r\n		<span style="font-size: 14px;"><a href="/public/upload/files/Triet%20hoc%20khong%20chuyen.doc">Triết học kh&ocirc;ng chuy&ecirc;</a>n</span></li>\r\n	<li>\r\n		<a href="/public/upload/files/Ho%C3%A1%20v%C3%B4%20c%C6%A1.pdf"><span style="font-size: 14px;">H&oacute;a v&ocirc; cơ</span></a></li>\r\n	<li>\r\n		<span style="font-size: 14px;"><a href="/public/upload/files/Ho%C3%A1%20h%E1%BB%AFu%20c%C6%A1.pdf">H&oacute;a hữu c</a>ơ</span></li>\r\n</ul>\r\n<p>\r\n	<span style="font-size: 14px;">T&agrave;i liệu &ocirc;n tập</span></p>\r\n<ul>\r\n	<li>\r\n		<a href="/public/upload/files/TLOT%20Tieng%20Anh%282%29.pdf"><span style="font-size: 14px;">Tiếng Anh</span></a></li>\r\n	<li>\r\n		<a href="/public/upload/files/TLOT%20Ly%20luan%20van%20hoc.pdf"><span style="font-size: 14px;">L&yacute; luận văn học</span></a></li>\r\n</ul>\r\n<ul>\r\n	<li>\r\n		&nbsp;</li>\r\n	<li>\r\n		&nbsp;</li>\r\n	<li>\r\n		&nbsp;</li>\r\n</ul>\r\n', '2015-03-02 08:54:18', 4933, 1, 1, 6, 1, NULL, 1, 1, NULL),
(78, 'Lịch thi kết thúc học phần Triết học và Tiếng Anh Cao học Khóa 14.2', '<p>\r\n	<span style="color:#ffffff;">.</span></p>\r\n', '2015-03-02 08:56:34', 813, 1, 1, 5, 1, NULL, 1, 1, '1425294815_lich-thi-triet-hoc,-ta-k14.2.pdf'),
(79, 'Thông báo về việc học các học phần bổ sung kiến thức đối với thí sinh dự thi Tuyển sinh Cao học đợt 1 năm 2015', '<p>\r\n	<span style="color:#ffffff;">.</span></p>\r\n', '2015-03-05 04:05:01', 2283, 1, 1, 5, 1, NULL, 1, 1, '1425528301_tb-hoc-chuyen-doi0001.pdf'),
(80, 'Thông báo tuyển sinh sau đại học liên kết với Đại học Vinh đợt 1 năm 2015', '<p>\r\n	<span style="color:#ffffff;">.</span></p>\r\n', '2015-03-11 02:38:44', 2215, 1, 1, 6, 1, NULL, 1, 1, '1426041568_tb-doi-ngay-tuyen-sinh.pdf'),
(81, 'Mời viết bài và tham gia hội thảo "Phương pháp dạy học tích cực trong giảng dạy tiếng Anh ở trường Đại học, Cao đẳng"', '<p>\r\n	<span style="color:#ffffff;">.</span></p>\r\n', '2015-03-11 04:29:49', 199, 1, 1, 2, 1, NULL, 1, 1, '1426048189_hoi-thao-day-hoc-tieng-anh-dh-dong-nai.pdf'),
(82, 'Danh sách phòng thi Kì thi kết thúc học phần Triết học và Anh văn', '<p>\r\n	<strong><span style="font-size:16px;">Tải danh s&aacute;ch ph&ograve;ng thi:</span></strong></p>\r\n<p>\r\n	<a href="/public/upload/files/DS%20phong%20thi%20Triet%20hoc%20K14.2.pdf"><span style="font-size:14px;">Danh s&aacute;ch ph&ograve;ng thi m&ocirc;n Tri&ecirc;t học</span></a></p>\r\n<p>\r\n	<a href="/public/upload/files/DS%20phong%20thi%20Anh%20van%20K14.2.pdf"><span style="font-size:14px;">Danh s&aacute;ch ph&ograve;ng thi m&ocirc;n Anh văn</span></a></p>\r\n', '2015-03-13 03:09:22', 802, 1, 1, 5, 1, NULL, 1, 1, NULL),
(83, 'Thông báo Hội nghị Khoa học quốc gia lần thứ VIII "Nghiên cứu cơ bản và ứng dụng Công nghệ thông tin"', '<p>\r\n	<span style="padding: 0px; margin: 0px; border-color: rgb(234, 234, 234); font-family: tahoma, arial, verdana, sans-serif; font-size: 13px; line-height: 19.5px; color: rgb(0, 0, 0);"><span style="padding: 0px; margin: 0px; border-color: rgb(234, 234, 234); font-size: 16px;"><span style="padding: 0px; margin: 0px; border-color: rgb(234, 234, 234); font-family: ''times new roman'', times, serif;">Nhằm g&oacute;p phần th&uacute;c đẩy nghi&ecirc;n cứu cơ bản v&agrave; ứng dụng về C&ocirc;ng nghệ th&ocirc;ng tin tại Việt Nam, Li&ecirc;n hiệp c&aacute;c Hội Khoa học v&agrave; Kỹ thuật Việt&nbsp; Nam, Đại học Quốc gia H&agrave; Nội c&ugrave;ng phối hợp với c&aacute;c cơ quan khoa học, c&aacute;c nh&agrave; khoa học từ c&aacute;c viện nghi&ecirc;n cứu, c&aacute;c trường đại học tổ chức Hội nghị quốc gia lần thứ VIII &quot;Nghi&ecirc;n cứu cơ bản v&agrave; ứng dụng C&ocirc;ng nghệ th&ocirc;ng tin&quot;.&nbsp;</span></span></span><span style="padding: 0px; margin: 0px; border-color: rgb(234, 234, 234); font-family: ''times new roman'', times, serif; line-height: 19.5px; font-size: 16px; color: rgb(0, 0, 0);">T&ecirc;n hội nghị được gọi tắt l&agrave; FAIR - Fundamental and Applied IT Research. Mọi th&ocirc;ng tin xin li&ecirc;n hệ website ch&iacute;nh thức của Hội nghị:&nbsp;</span><span style="padding: 0px; margin: 0px; border-color: rgb(234, 234, 234); color: rgb(0, 0, 0); font-size: 13px; line-height: 19.5px;"><span style="padding: 0px; margin: 0px; border-color: rgb(234, 234, 234); font-size: 12px;"><a href="http://fair.conf.vn/2015/" style="font-family: Tahoma, Arial, Helvetica, sans-serif; padding: 0px; margin: 0px; border-color: rgb(234, 234, 234); text-decoration: none; color: rgb(128, 153, 168); font-size: 13px;">http://fair.conf.vn/2015/</a><font face="times new roman, times, serif">&nbsp;</font></span></span></p>\r\n<p>\r\n	<span style="font-size: 16px;"><span style="font-family: ''times new roman'', times, serif;"><span style="padding: 0px; margin: 0px; border-color: rgb(234, 234, 234); line-height: 19.5px;">H&agrave; Nội 9-10/07/2015</span></span></span></p>\r\n', '2015-03-16 08:24:05', 90, 1, 1, 2, 1, NULL, 0, 1, NULL),
(84, 'Thời khóa biểu học kì 1 Cao học khóa 14.2 (cập nhật)', '<p>\r\n	<span style="font-size:16px;"><strong>Tải thời kh&oacute;a biểu c&aacute;c m&ocirc;n cơ sở c&aacute;c chuy&ecirc;n ng&agrave;nh Cao học kh&oacute;a 14.2</strong></span></p>\r\n<p>\r\n	<span style="font-size:14px;"><a href="/public/upload/files/TKB%20HK1%20Ng%C3%B4n%20ng%E1%BB%AF%20h%E1%BB%8Dc%281%29.pdf">Thời kh&oacute;a biểu chuy&ecirc;n ng&agrave;nh Ng&ocirc;n ngữ học</a></span></p>\r\n<p>\r\n	<span style="font-size:14px;"><a href="/public/upload/files/TKB%20HK1%20Toan%20Giai%20tich%282%29.pdf">Thời kh&oacute;a biểu chuy&ecirc;n ng&agrave;nh To&aacute;n giải t&iacute;ch</a></span></p>\r\n<p>\r\n	<span style="font-size:14px;"><a href="/public/upload/files/TKB%20HK1%20TCNH%20K14.2.rar">Thời kh&oacute;a biểu chuy&ecirc;n ng&agrave;nh T&agrave;i ch&iacute;nh - Ng&acirc;n h&agrave;ng</a>&nbsp; &nbsp; &nbsp;&nbsp;</span></p>\r\n<p>\r\n	<a href="/public/upload/files/TKB%20HK1%20QLGD%20K14.2%281%29.rar"><span style="font-size: 14px;">Thời kh&oacute;a biểu chuy&ecirc;n ng&agrave;nh Quản l&iacute; gi&aacute;o dục</span></a></p>\r\n<p>\r\n	&nbsp;</p>\r\n', '2015-03-18 10:24:07', 2363, 1, 1, 5, 1, NULL, 1, 1, NULL),
(85, 'Thông báo số 1: Hội thảo KH Cán bộ trẻ các trường ĐHSP toàn quốc lần thứ V - năm 2015 tại Trường Đại học Sư phạm Hà Nội 2', '<p>\r\n	<span style="margin: 0px; padding: 0px; font-family: Arial; font-size: 12.7272720336914px; text-align: justify; line-height: 19.0909080505371px; color: rgb(0, 0, 0);">Nối tiếp th&agrave;nh c&ocirc;ng của&nbsp;Hội thảo Khoa học C&aacute;n bộ trẻ c&aacute;c trường Đại học Sư phạm to&agrave;n quốc lần thứ IV, Trường Đại học Sư phạm H&agrave; Nội 2 tiến h&agrave;nh đăng cai tổ chức&nbsp;</span><span style="margin: 0px; padding: 0px; font-family: Arial; font-size: 12.7272720336914px; text-align: justify; line-height: 19.0909080505371px; color: rgb(0, 0, 0);">&nbsp;Hội thảo Khoa học C&aacute;n bộ trẻ c&aacute;c trường&nbsp;<span style="font-size: 12.7272720336914px; line-height: 19.0909080505371px;">Đại học Sư phạm</span>&nbsp;to&agrave;n quốc lần thứ V - 2015 với mục đ&iacute;ch: Hội thảo l&agrave; diễn đ&agrave;n để c&aacute;c nh&agrave; khoa học, nghi&ecirc;n cứu, giảng vi&ecirc;n trẻ của c&aacute;c trường&nbsp;<span style="font-size: 12.7272720336914px; line-height: 19.0909080505371px;">Đại học Sư phạm</span>, c&aacute;c trường c&oacute; đ&agrave;o tạo sư phạm tr&ecirc;n to&agrave;n quốc c&ocirc;ng bố v&agrave; trao đổi c&aacute;c kết quả nghi&ecirc;n cứu mới, xu hướng KHCN trong tương lai....</span></p>\r\n<p>\r\n	<strong style="margin: 0px; padding: 0px; color: rgb(0, 0, 0); font-family: Arial; font-size: 12.7272720336914px; line-height: 19.0909080505371px; text-align: justify;">Th&agrave;nh phần tham dự:</strong><span style="color: rgb(0, 0, 0); font-family: Arial; font-size: 12.7272720336914px; line-height: 19.0909080505371px; text-align: justify;">&nbsp;C&aacute;c c&aacute;n bộ, giảng vi&ecirc;n trẻ c&oacute; tuổi kh&ocirc;ng qu&aacute; 35. </span></p>\r\n<p>\r\n	<span style="color: rgb(0, 0, 0); font-family: Arial; font-size: 12.7272720336914px; line-height: 19.0909080505371px; text-align: justify;"><strong>Chi ttiết th&ocirc;ng tin về hội thảo:</strong> Vui l&ograve;ng xem <a href="/public/upload/files/thong%20bao%20Hoi%20thao.pdf">file đ&iacute;nh k&egrave;m</a>.</span></p>\r\n<p>\r\n	&nbsp;</p>\r\n', '2015-03-19 09:44:11', 126, 1, 1, 2, 1, '1426758251_scan0001.jpg', 0, 1, NULL),
(86, 'Thông báo tuyển sinh đào tạo trình độ thạc sĩ khóa 15.1 năm 2015', '<p>\r\n	<span style="color:#ffffff;">.</span></p>\r\n', '2015-03-20 03:03:52', 3493, 1, 1, 5, 1, NULL, 1, 1, '1426825671_tbts-15.1-w.pdf'),
(87, 'Tổ chức ôn thi tuyển sinh đào tạo trình độ thạc sĩ liên kết Đại học Vinh tại Trường Đại học Sài Gòn đợt 1 năm 2015', '<p>\r\n	<strong><span style="font-size:14px;"><span style="font-family:times new roman,times,serif;">I. Lịch &ocirc;n thi</span></span></strong></p>\r\n<p>\r\n	<span style="font-size:14px;"><span style="font-family:times new roman,times,serif;">&nbsp; &nbsp;- M&ocirc;n Tiếng Anh: 27-29/3/2015;</span></span></p>\r\n<p>\r\n	<span style="font-size:14px;"><span style="font-family:times new roman,times,serif;">&nbsp; &nbsp;- M&ocirc;n Đại số: 30/3 -01/4/2015;</span></span></p>\r\n<p>\r\n	<span style="font-size:14px;"><span style="font-family:times new roman,times,serif;">&nbsp; &nbsp;- M&ocirc;n Giải t&iacute;ch, To&aacute;n cho H&oacute;a, To&aacute;n cho Vật l&yacute;: 02/4-05/4/2015.</span></span></p>\r\n<p>\r\n	<span style="font-size:14px;"><span style="font-family:times new roman,times,serif;">&nbsp; &nbsp;Đăng k&yacute; &ocirc;n thi tại Ph&ograve;ng Quản l&yacute; Khoa học v&agrave; Sau đại học Trường Đại học S&agrave;i G&ograve;n (ph&ograve;ng C010).</span></span></p>\r\n<p>\r\n	<span style="font-size:14px;"><span style="font-family:times new roman,times,serif;">&nbsp; &nbsp;Ph&ograve;ng học chi tiết sẽ ni&ecirc;m yết tại Bảng th&ocirc;ng b&aacute;o Ph&ograve;ng Quản l&yacute; Khoa học v&agrave; Sau đại học.</span></span></p>\r\n<p>\r\n	<strong><span style="font-size:14px;"><span style="font-family:times new roman,times,serif;">II. Lệ ph&iacute; &ocirc;n thi</span></span></strong></p>\r\n', '2015-03-20 11:11:51', 2051, 1, 1, 6, 1, NULL, 1, 1, '1426849911_kinh-phi-on-tap-ts-ch-vinh-k230001.pdf'),
(88, 'Thông báo lịch ôn thi  môn Tiếng Anh cao học liên kết Đại học Vinh', '<p>\r\n	<span style="font-size:16px;"><span style="font-family:times new roman,times,serif;">- Thời gian học:</span></span></p>\r\n<p>\r\n	<span style="font-size:16px;"><span style="font-family:times new roman,times,serif;">&nbsp; &nbsp;Từ 27/3/2015 đến 29/3/2015.&nbsp;</span></span></p>\r\n<p>\r\n	<span style="font-size:16px;"><span style="font-family:times new roman,times,serif;">&nbsp; &nbsp;S&aacute;ng bắt đầu từ 07g30. Chiều bắt đầu từ 13g30.</span></span></p>\r\n<p>\r\n	<span style="font-size:16px;"><span style="font-family:times new roman,times,serif;">- Ph&ograve;ng học: Ph&ograve;ng D205 Trường Đại học S&agrave;i G&ograve;n 273 An Dương Vương, P3, Q5, TP. Hồ Ch&iacute; Minh</span></span></p>\r\n', '2015-03-26 07:31:03', 679, 1, 1, 6, 1, NULL, 1, 1, NULL),
(89, 'Thông báo lần 2 về việc tổ chức và mời viết bài Hội thảo khoa học quốc tế thường niên lần thứ 32 của Hiệp hội kinh doanh Pan-Pacific', '<p>\r\n	<span style="font-size:16px;"><span style="font-family:times new roman,times,serif;">Hiệp hội Kinh doanh Ch&acirc;u &Aacute; - Th&aacute;i B&igrave;nh Dương (Pan Pacific Business Association) sẽ phối hợp với Trường Đại học Kinh tế Quốc d&acirc;n tổ chức Hội thảo quốc tế thường ni&ecirc;n Pan-Pacific lần thứ 32 tại H&agrave; Nội với chủ đề &quot;Đổi mới doanh nghiệp trong thời đại kỹ thuật số&quot;.&nbsp;</span></span></p>\r\n<p>\r\n	<span style="font-size:16px;"><span style="font-family:times new roman,times,serif;"><strong>Thời gian:</strong> Từ ng&agrave;y 01/06/2015 đến 04/06/2015</span></span></p>\r\n<p>\r\n	<span style="font-size:16px;"><span style="font-family:times new roman,times,serif;"><strong>Địa điểm:</strong> Kh&aacute;ch sạn Melia H&agrave; Nội</span></span></p>\r\n<p>\r\n	<span style="font-size:16px;"><span style="font-family:times new roman,times,serif;"><strong>Th&agrave;nh phần tham dự:</strong> Gồm c&aacute;c nh&agrave; khoa học, nh&agrave; hoạch định ch&iacute;nh s&aacute;ch, l&atilde;nh đạo doanh nghiệp, giảng vi&ecirc;n v&agrave; nghi&ecirc;n cứu sinh đến từ c&aacute;c quốc gia như Mỹ, H&agrave;n Quốc, Trung Quốc, Việt Nam... v&agrave; c&aacute;c học vi&ecirc;n nghi&ecirc;n cứu sinh quan t&acirc;m viết b&agrave;i tham dự Hội thảo.</span></span></p>\r\n<p>\r\n	<span style="font-size:16px;"><span style="font-family:times new roman,times,serif;"><strong>Chi tiết th&ocirc;ng tin về Hội thảo: </strong>Vui l&ograve;ng xem <a href="/public/upload/files/Thong%20bao%20Pan-Pacific.pdf">file đ&iacute;nh k&egrave;m</a></span></span></p>\r\n', '2015-03-26 09:06:33', 123, 1, 1, 2, 1, NULL, 0, 1, NULL),
(90, 'Thời khóa biểu các lớp học bổ sung kiến thức khóa 15.1', '<p>\r\n	<span style="font-size:14px;"><span style="font-family:times new roman,times,serif;"><a href="/public/upload/files/TKB%20BSKT%20TCNH%2015.1.pdf">Thời kh&oacute;a biểu học bổ sung kiến thức ng&agrave;nh T&agrave;i ch&iacute;nh - Ng&acirc;n h&agrave;ng</a></span></span></p>\r\n<p>\r\n	<span style="font-size:14px;"><span style="font-family:times new roman,times,serif;"><a href="/public/upload/files/TKB%20BSKT%20QLGD%2015.1%281%29.pdf">Thời kh&oacute;a biểu học bổ sung kiến thức ng&agrave;nh Quản l&iacute; gi&aacute;o dục</a></span></span></p>\r\n', '2015-03-27 03:20:15', 1401, 1, 1, 5, 1, NULL, 1, 1, NULL),
(91, 'Thông báo Lịch thi và phòng thi cấp chứng chỉ B1 cao học liên kết Đại học Vinh', '<p>\r\n	<span style="font-size:18px;"><a href="/public/upload/files/LICH%20THI%20CAP%20CHUNG%20CHI%20B1%281%29.pdf"><span style="font-family:times new roman,times,serif;">Lịch thi cấp chứng chỉ B1</span></a></span></p>\r\n<p>\r\n	<span style="font-size:18px;"><a href="/public/upload/files/Danh%20sach%20phong%20thi%20B1.rar"><span style="font-family: ''times new roman'', times, serif;">Danh s&aacute;ch ph&ograve;ng thi</span></a></span></p>\r\n', '2015-03-28 13:18:13', 617, 1, 1, 6, 1, NULL, 1, 1, NULL),
(92, 'Thông báo Lịch thi kết thúc học phần cao học liên kết Đại học Vinh Khóa 22 ngày 23, 24/04/2015', '<p>\r\n	<span style="font-size:18px;"><span style="font-family:times new roman,times,serif;"><a href="/public/upload/files/Lich-thi-CH22_Dot3-tai-SG.pdf">Lịch thi kết th&uacute;c học phần</a></span></span></p>\r\n', '2015-03-28 13:19:04', 816, 1, 1, 6, 1, NULL, 1, 1, NULL),
(93, 'Thời khóa biểu học kì 1 Cao học ngành Quản lí giáo dục khóa 14.2', '<p>\r\n	<a href="/public/upload/files/TKB%20HK1%20QLGD_new2.pdf"><span style="font-size:18px;"><span style="font-family:times new roman,times,serif;">Thời kh&oacute;a biểu chuy&ecirc;n ng&agrave;nh Quản l&iacute; gi&aacute;o dục</span></span></a></p>\r\n<p>\r\n	<a href="/public/upload/files/DS%202%20lop%20QLGD.pdf"><span style="font-size:16px;"><span style="font-family:times new roman,times,serif;">Danh s&aacute;ch lớp chuy&ecirc;n ng&agrave;nh Quản l&iacute; gi&aacute;o dục</span></span></a></p>\r\n', '2015-03-30 11:45:54', 1482, 1, 1, 5, 1, NULL, 1, 1, NULL),
(94, 'Lịch thi tuyển sinh sau đại học liên kết Đại học Vinh đợt 1 năm 2015', '<p>\r\n	<span style="color:#ffffff;">.</span></p>\r\n', '2015-04-07 08:55:55', 1239, 1, 1, 6, 1, NULL, 1, 1, '1428396954_2015-04-07-(5).pdf'),
(95, 'Bảng điểm học phần Triết học và Tiếng Anh các lớp cao học K14.2', '<p>\r\n	<span style="font-size:18px;"><span style="font-family: times new roman,times,serif;"><a href="/public/upload/files/Diem%20HP%20Triet%20hoc0001.pdf">Bảng điểm học phần Triết học</a></span></span></p>\r\n<p>\r\n	<span style="font-size:18px;"><a href="/public/upload/files/Diem%20HP%20Anh%20van0001%281%29.pdf"><span style="font-family: times new roman,times,serif;">Bảng điểm học phần Tiếng Anh</span></a></span></p>\r\n', '2015-04-10 09:19:44', 1709, 1, 1, 5, 1, NULL, 1, 1, NULL),
(96, 'Danh sách dự thi kết thúc học phần đợt 3 cao học liên kết Đại học Vinh khóa 22', '<p>\r\n	<a href="/public/upload/files/Danh%20sach%20phong%20thi_22sg-d3%20%282%29.rar"><span style="font-size:18px;"><span style="font-family: times new roman,times,serif;">Tải danh s&aacute;ch</span></span></a></p>\r\n', '2015-04-13 01:01:10', 910, 1, 1, 6, 1, NULL, 1, 1, NULL),
(97, 'Thời khóa biểu các lớp học bổ sung kiến thức chuyên ngành Ngôn ngữ học khóa 15.1', '<p>\r\n	<span style="color:#ffffff;">.</span></p>\r\n', '2015-04-15 15:36:04', 522, 1, 1, 5, 1, NULL, 1, 1, '1429112343_tkb-bskt-nnh-15.1.pdf'),
(99, 'Thông báo viết tham luận Hội thảo Khoa học "Tín dụng đen tại TP. Hồ Chí Minh - Thực trạng và giải pháp"', '<p>\r\n	<span style="font-size:16px;"><span style="font-family:times new roman,times,serif;">Thực hiện nhiệm vụ Nghi&ecirc;n cứu khoa học năm 2015, trong khu&ocirc;n khổ đề t&agrave;i cấp Sở Khoa học C&ocirc;ng nghệ TP.HCM: &quot;T&iacute;n dụng đen tại TP. Hồ Ch&iacute; Minh - Thực trạng v&agrave; giải ph&aacute;p&quot; do Viện Khoa học X&atilde; hội V&ugrave;ng Nam bộ l&agrave; cơ quan chủ tr&igrave;, Hội thảo với chủ đề &quot;hoạt động Ng&acirc;n h&agrave;ng ch&iacute;nh thức v&agrave; phi ch&iacute;nh thức tại TP.HCM&quot; dự kiến sẽ được tổ chức tại Hội trường Viện KHXH v&ugrave;ng Nam bộ.</span></span></p>\r\n<p>\r\n	<span style="font-size:16px;"><span style="font-family:times new roman,times,serif;">K&iacute;nh mời c&aacute;c thầy c&ocirc;, giảng vi&ecirc;n quan t&acirc;m viết b&agrave;i tham dự, mọi th&ocirc;ng tin về viết b&agrave;i tham dự Hội thảo <a href="/public/upload/files/Hoi%20thao%20khoa%20hoc%20Tin%20dung%20den.pdf">tải về tại đ&acirc;y</a>.</span></span></p>\r\n<p>\r\n	&nbsp;</p>\r\n', '2015-04-20 08:52:11', 70, 1, 1, 2, 1, NULL, 0, 1, '1429519931_hoi-thao-khoa-hoc-tin-dung-den.pdf'),
(100, 'Thông báo viết bài Hội thảo khoa học "Quản lý nhà nước về hội nhập quốc tế trong lĩnh vực khoa học và công nghệ ở Việt Nam - Thực trạng và giải pháp"', '<p>\r\n	Học viện H&agrave;nh ch&iacute;nh Quốc gia cơ sở tại Th&agrave;nh phố Hồ Ch&iacute; Minh dự kiến tổ chức Hội thảo Khoa học với chủ đề &quot;Quản l&yacute; nh&agrave; nước về hội nhập quốc tế trong lĩnh vực khoa học v&agrave; c&ocirc;ng nghệ ở Việt Nam - Thực trạng v&agrave; giải ph&aacute;p&quot; v&agrave;o trung tuần th&aacute;ng 06 năm 2015, k&iacute;nh mời c&aacute;c thầy c&ocirc;ng, giảng vi&ecirc;n quan t&acirc;m viết b&agrave;i tham dự.</p>\r\n<p>\r\n	Mọi th&ocirc;ng tin viết b&agrave;i tham gia Hội thảo <a href="/public/upload/files/Hoi%20thao%20khoa%20hoc%20Quan%20ly%20nha%20nuoc.pdf">tải về tại đ&acirc;y</a>.</p>\r\n', '2015-04-20 09:00:08', 113, 1, 1, 2, 1, NULL, 0, 1, '1429520408_hoi-thao-khoa-hoc-quan-ly-nha-nuoc.pdf'),
(101, 'Lịch thi kết thúc học phần bổ sung kiến thức dự thi tuyển sinh cao học K15.1', '<p>\r\n	<span style="color:#ffffff;">.</span></p>\r\n', '2015-04-22 04:22:47', 905, 1, 1, 5, 1, NULL, 1, 1, '1429686769_lich-thi-bskt-15.10002.pdf'),
(102, 'Thông báo mời viết bài Hội thảo "Hoàn thiện hệ thống chỉ tiêu kế hoạch phát triển kinh tế - xã hội"', '<p>\r\n	&nbsp;&nbsp;</p>\r\n', '2015-04-23 10:22:05', 96, 1, 1, 2, 1, NULL, 0, 1, '1429784580_hoi-thao-hoan-thien-he-thong-chi-tieu-ke-hoach-phat-trien-kinh-te---xa-hoi.pdf'),
(103, 'Thông báo mời viết báo cáo và tham dự Hội nghị Khoa học Quốc tế "Kỹ nghệ tri thức và hệ thống - KSE 2015"', '<p>\r\n	&nbsp; &nbsp;</p>\r\n', '2015-04-23 10:25:43', 97, 1, 1, 2, 1, '1429784740_001.jpg', 0, 1, '1429784743_hoi-thao-kse.pdf'),
(104, 'Lịch học cao học Vinh Khóa 22 tháng 5', '<p>\r\n	<span style="font-size:16px;"><span style="font-family: times new roman,times,serif;"><a href="/public/upload/files/K22_Dot%201_Ke%20hoach%20giang%20day%20cao%20hoc.pdf">Kế hoạch giảng dạy cao học K22 đợt 1</a></span></span></p>\r\n<p>\r\n	<span style="font-size:16px;"><span style="font-family: times new roman,times,serif;"><a href="/public/upload/files/K22_Dot%201%20va%20Dot%202_Ke%20hoach%20giang%20day%20cao%20hoc.pdf">Kế hoạc giảng dạy cao học K22 đợt 1 v&agrave; đợt 2</a></span></span></p>\r\n<p>\r\n	<span style="font-size:16px;"><span style="font-family: times new roman,times,serif;"><a href="/public/upload/files/Lich%20hoc%20va%20phong%20hoc%20cao%20hoc%20K22%20thang%205%20%28Dot%201%29.rar">Lịch học v&agrave; ph&ograve;ng học K22 th&aacute;ng 5 đợt 1</a></span></span></p>\r\n', '2015-05-02 09:14:35', 1642, 1, 1, 6, 1, NULL, 1, 1, NULL),
(105, 'Kết quả thi tuyển sinh Sau đại học liên kết Đại học Vinh đợt 1 năm 2015', '<p>\r\n	<span style="font-size:14px;"><span style="font-family:times new roman,times,serif;">Th&ocirc;ng b&aacute;o ph&uacute;c khảo:</span></span></p>\r\n<p>\r\n	<span style="font-size:14px;"><span style="font-family:times new roman,times,serif;"><a href="http://www.vinhuni.edu.vn/Vinhuni/Donvi/Display/102/0/9833/donvi.htm" style="color: rgb(17, 85, 204); font-family: arial, sans-serif; font-size: 12.8000001907349px;" target="_blank">http://www.vinhuni.edu.vn/<wbr />Vinhuni/Donvi/Display/102/0/<wbr />9833/donvi.htm</a></span></span></p>\r\n', '2015-05-02 09:16:45', 2719, 1, 1, 6, 1, NULL, 1, 1, '1430558205_2015-04-27-(10).pdf'),
(106, 'Thời khóa biểu ôn thi tuyển sinh cao học khóa 15.1 (cập nhật 7 chuyên ngành)', '<p>\r\n	<a href="/public/upload/files/TKB%20on%20thi%20TS%2015.1_VHVN.pdf"><span style="font-size:16px;"><span style="font-family: times new roman,times,serif;">Thời kh&oacute;a biểu &ocirc;n thi tuyển sinh cao học K15.1 chuy&ecirc;n ng&agrave;nh Văn học Việt Nam</span></span></a></p>\r\n<p>\r\n	<span style="font-size:16px;"><span style="font-family: times new roman,times,serif;"><a href="/public/upload/files/TKB%20on%20thi%20TS%2015.1_NNH%282%29.pdf">Thời kh&oacute;a biểu &ocirc;n thi tuyển sinh cao học K15.1 chuy&ecirc;n ng&agrave;nh Ng&ocirc;n ngữ học </a></span></span></p>\r\n<p>\r\n	<span style="font-size:16px;"><span style="font-family: times new roman,times,serif;"><a href="/public/upload/files/TKB%20on%20thi%20TS%2015.1_TCNH%282%29.pdf">Thời kh&oacute;a biểu &ocirc;n thi tuyển sinh cao học K15.1 chuy&ecirc;n ng&agrave;nh T&agrave;i ch&iacute;nh - Ng&acirc;n h&agrave;ng</a></span></span></p>\r\n<p>\r\n	<span style="font-size:16px;"><span style="font-family: times new roman,times,serif;"><a href="/public/upload/files/TKB%20on%20thi%20TS%2015.1_QLGD%282%29.pdf">Thời kh&oacute;a biểu &ocirc;n thi tuyển sinh cao học K15.1 chuy&ecirc;n ng&agrave;nh Quản l&iacute; gi&aacute;o dục</a></span></span></p>\r\n<p>\r\n	<span style="font-size:16px;"><span style="font-family: times new roman,times,serif;"><a href="/public/upload/files/TKB%20on%20thi%20TS%2015.1_LSVN%283%29.pdf">Thời kh&oacute;a biểu &ocirc;n thi tuyển sinh cao học K15.1 chuy&ecirc;n ng&agrave;nh Lịch sử Việt Nam</a></span></span></p>\r\n<p>\r\n	<span style="font-size:16px;"><span style="font-family: times new roman,times,serif;"><a href="/public/upload/files/TKB%20on%20thi%20TS%2015.1_TGT%282%29.pdf">Thời kh&oacute;a biểu &ocirc;n thi tuyển sinh cao học K15.1 chuy&ecirc;n ng&agrave;nh To&aacute;n giải t&iacute;ch</a></span></span></p>\r\n<p>\r\n	<a href="/public/upload/files/TKB%20on%20thi%20TS%2015.1_HHC.pdf"><span style="font-size:16px;"><span style="font-family: times new roman,times,serif;">Thời kh&oacute;a biểu &ocirc;n thi tuyển sinh cao học K15.1 chuy&ecirc;n ng&agrave;nh H&oacute;a hữu cơ</span></span></a></p>\r\n', '2015-05-05 11:29:25', 2323, 1, 1, 5, 1, NULL, 1, 1, NULL),
(107, 'Điểm chuẩn thi tuyển sinh Sau đại học đợt 1 năm 2015 cao học liên kết Đại học Vinh', '<p>\r\n	<a href="/public/upload/files/TB%20phuc%20khao%20tuyen%20sinh%20CH%20Vinh%20dot%201%2020150001.pdf"><span style="font-size:16px;"><span style="font-family:times new roman,times,serif;">Th&ocirc;ng b&aacute;o về việc ph&uacute;c khảo kết quả thi tuyển sinh Cao học đợt 1, năm 2015 Trường Đại học Vinh</span></span></a></p>\r\n', '2015-05-07 04:37:07', 1996, 1, 1, 6, 1, NULL, 1, 1, '1430973427_diem-chuan-ch-vinh-dot-1-20150001.pdf'),
(108, 'Thông báo mời viết bài Hội thảo "Quá trình phát triển nhà ở cho người thu nhập thấp 30 năm qua tại TP.HCM - Thực trạng và giải pháp"', '<p>\r\n	<span style="color: rgb(85, 85, 85); font-family: ''Times New Roman'', Georgia, Times, serif; font-size: 14px;">Mời c&aacute;c thầy c&ocirc;, nh&agrave; nghi&ecirc;n cứu quan t&acirc;m viết b&agrave;i v&agrave; tham dự Hội thảo&nbsp;&quot;Qu&aacute; tr&igrave;nh ph&aacute;t triển nh&agrave; ở cho người thu nhập thấp 30 năm qua tại TP.HCM - Thực trạng v&agrave; giải ph&aacute;p&quot;</span></p>\r\n', '2015-05-07 09:45:18', 128, 1, 1, 2, 1, '1430991912_001.jpg', 0, 1, '1430991918_hoi-thao-nha-thu-nhap-thap.pdf'),
(109, 'Thông báo mời viết bài Hội thảo Khoa học Quốc tế "Giáo dục và Toàn cầu hóa"', '<p>\r\n	<span style="padding: 0px; margin: 0px; border-color: rgb(234, 234, 234); font-family: ''Times New Roman'', Georgia, Times, serif; color: rgb(85, 85, 85); font-size: 14px;">Mời c&aacute;c thầy c&ocirc;, nh&agrave; nghi&ecirc;n cứu quan t&acirc;m viết b&agrave;i v&agrave; tham dự&nbsp;</span><span style="color: rgb(85, 85, 85); font-family: ''Times New Roman'', Georgia, Times, serif; font-size: 14px;">Hội thảo Khoa học Quốc tế &quot;Gi&aacute;o dục v&agrave; To&agrave;n cầu h&oacute;a&quot;</span></p>\r\n', '2015-05-07 09:47:41', 142, 1, 1, 2, 1, '1430992058_001.jpg', 0, 1, '1430992061_hoi-thao-toan-cau-hoa.pdf'),
(110, 'Thông báo mời viết bài Hội thảo Khoa học - Công nghệ Toàn quốc về Cơ khí lần thứ IV', '<p>\r\n	<span style="padding: 0px; margin: 0px; border-color: rgb(234, 234, 234); font-family: ''Times New Roman'', Georgia, Times, serif; color: rgb(85, 85, 85); font-size: 14px;">Mời c&aacute;c thầy c&ocirc;, nh&agrave; nghi&ecirc;n cứu quan t&acirc;m viết b&agrave;i v&agrave; tham dự&nbsp;</span><span style="color: rgb(85, 85, 85); font-family: ''Times New Roman'', Georgia, Times, serif; font-size: 14px;">Hội thảo Khoa học - C&ocirc;ng nghệ To&agrave;n quốc về Cơ kh&iacute; lần thứ IV</span></p>\r\n', '2015-05-07 09:50:10', 126, 1, 1, 2, 1, '1430992207_003.jpg', 0, 1, '1430992210_hoi-thao-co-khi-lan-thu-iv.pdf'),
(111, 'Danh sách trúng tuyển thi tuyển sinh sau đại học đợt 1 năm 2015 cao học liên kết Đại học Vinh', '<p>\r\n	<span style="color:#ffffff;">.</span></p>\r\n', '2015-05-08 11:08:09', 2250, 1, 1, 6, 1, NULL, 1, 1, '1431083289_ds-trung-tuyen-ch-vinh-dot-1-20150001.pdf'),
(112, 'Quyết định trúng tuyển - Hướng dẫn nhập học - Mẫu lý lịch học viên K23 Cao học liên kết Đại học Vinh', '<p>\r\n	<a href="/public/upload/files/Q%C4%90%20trung%20tuyen%20dot%201%2020150001.pdf"><span style="font-size:16px;"><span style="font-family: times new roman,times,serif;">Quyết định tr&uacute;ng tuyển </span></span></a></p>\r\n<p>\r\n	<span style="font-size:16px;"><span style="font-family: times new roman,times,serif;"><a href="/public/upload/files/Huong%20dan%20nhap%20hoc%20K230001.pdf">Hướng dẫn nhập học</a></span></span></p>\r\n<p>\r\n	<a href="/public/upload/files/Ly%20lich%20hoc%20vien%20K230001.pdf"><span style="font-size:16px;"><span style="font-family: times new roman,times,serif;">Mẫu l&yacute; lịch học vi&ecirc;n</span></span></a></p>\r\n', '2015-05-12 03:35:14', 1868, 1, 1, 6, 1, NULL, 1, 1, NULL),
(113, 'Thời khóa biểu học phần Giải tích phức lớp cao học Toán giải tích K14.2', '<p>\r\n	<span style="color:#ffffff;">.</span></p>\r\n', '2015-05-14 01:37:43', 458, 1, 1, 5, 1, NULL, 1, 1, '1431573831_tkb-hk1-tgt_giai-tich-phuc.pdf');
INSERT INTO `thong_bao` (`id`, `tieu_de`, `noi_dung`, `ngay_tao`, `so_lan_xem`, `trang_thai`, `ma_quan_tri`, `loai`, `search`, `file`, `quan_trong`, `noi_bat`, `file_pdf`) VALUES
(114, 'Thông báo mời viết bài tham dự Hội thảo Khoa học năm 2015 "Giá trị và Phương pháp giảng dạy các môn Khoa học Xã hội trong nhà trường phổ thông"', '<p>\r\n	&nbsp;&nbsp;</p>\r\n', '2015-05-15 07:08:31', 137, 1, 1, 2, 1, NULL, 0, 1, '1431673711_hoi-thao-gia-tri-va-phuong-phap-giang-day-cac-mon-khxh.pdf'),
(115, 'Kế hoạch giảng dạy tháng 5 năm 2015 các lớp cao học liên kết Đại học Vinh K.23', '<p>\r\n	<span style="color:#ffffff;">.</span></p>\r\n', '2015-05-15 09:39:38', 1064, 1, 1, 6, 1, NULL, 1, 1, '1431682778_k23_thoi-khoa-bieu-triet-hoc-va-ngoai-ngu.pdf'),
(116, 'Lịch thi kết thúc học phần cao học K14.2 (năm 2015 đợt 2)', '<p>\r\n	<span style="color:#ffffff;">.</span></p>\r\n', '2015-05-20 04:30:45', 771, 0, 1, 5, 1, NULL, 1, 1, '1432096245_lich-thi-hoc-phan-14.2-(dot-2-2015)0001.pdf'),
(117, 'Thông báo viết tham luận cho Hội thảo Khoa học "Những vấn đề giới và gia đình ở Nam Bộ trong bối cảnh toàn cầu hóa"', '<p>\r\n	&nbsp; &nbsp;</p>\r\n', '2015-05-22 02:54:54', 202, 1, 1, 2, 1, '1432263291_001.jpg', 0, 1, '1432263294_hoi-thao-nhung-van-de-gioi-va-gia-dinh.pdf'),
(118, 'TB đổi phòng học lớp QLG1421 chuyên ngành Quản lý giáo dục (cập nhật: GV cho lớp nghỉ)', '<p>\r\n	<span style="font-size:16px;"><span style="font-family:times new roman,times,serif;">Ph&ograve;ng Đ&agrave;o tạo Sau đại học th&ocirc;ng b&aacute;o: </span></span></p>\r\n<p>\r\n	<span style="font-family: ''times new roman'', times, serif; font-size: 16px;">S&aacute;ng thứ 7, ng&agrave;y 30/5/2015, l</span><span style="font-size:16px;"><span style="font-family:times new roman,times,serif;">ớp cao học QLG1421 chuy&ecirc;n ng&agrave;nh Quản l&yacute; gi&aacute;o dục nghỉ học (Giảng vi&ecirc;n b&aacute;o nghỉ).</span></span></p>\r\n<p>\r\n	<span style="font-size:16px;"><span style="font-family:times new roman,times,serif;">Tr&acirc;n trọng.</span></span></p>\r\n', '2015-05-25 08:27:27', 274, 1, 1, 5, 1, NULL, 1, 1, NULL),
(119, 'Kết quả học bổ sung kiến thức tham dự kì thi tuyển sinh đào tạo trình độ thạc sĩ khóa 15.1', '<p>\r\n	<span style="color:#ffffff;">.</span></p>\r\n', '2015-05-26 02:17:46', 1144, 1, 1, 5, 1, NULL, 1, 1, '1432606666_kq-bskt-15.10001.compressed.pdf'),
(120, 'Danh sách thí sinh đủ điều kiện tham dự kì thi tuyển sinh đào tạo trình độ thạc sĩ khóa 15.1', '<p>\r\n	<span style="color:#ffffff;">.</span></p>\r\n', '2015-05-26 02:19:03', 2107, 1, 1, 5, 1, NULL, 1, 1, '1432695154_ds-du-dieu-kien-15.10001.pdf'),
(121, 'Lịch thi tuyển sinh đào tạo trình độ thạc sĩ khóa 15.1 năm 2015', '<p>\r\n	<span style="color:#ffffff;">.</span></p>\r\n', '2015-05-26 09:47:17', 2022, 1, 1, 5, 1, NULL, 1, 1, '1432633636_lich-thi-ts-15.10001.pdf'),
(122, 'Lịch học cao học  liên kết đại học Vinh Khóa 22 tháng 6 năm 2015', '<p>\r\n	<a href="/public/upload/files/K22_Dai%20so%20va%20Ly%20thuyet%20so_Lich%20hoc%20thang%206.pdf">Lịch học chuy&ecirc;n ng&agrave;nh Đại số v&agrave; L&yacute; thuyết số</a></p>\r\n<p>\r\n	<a href="/public/upload/files/K22_GD%20hoc_Lich%20hoc%20thang%206.pdf">Lịch học chuy&ecirc;n ng&agrave;nh Gi&aacute;o dục học</a></p>\r\n<p>\r\n	<a href="/public/upload/files/K22_Hoa%20vo%20co_Lich%20hoc%20thang%206.pdf">Lịch học chuy&ecirc;n ng&agrave;nh H&oacute;a v&ocirc; cơ</a></p>\r\n<p>\r\n	<a href="/public/upload/files/K22_PPDH%20BM%20GD%20Chinh%20tri_Lich%20hoc%20thang%206.pdf">Lịch học chuy&ecirc;n ng&agrave;nh PPDH BM GD Ch&iacute;nh trị</a></p>\r\n<p>\r\n	<a href="/public/upload/files/K22_PPDH%20BM%20Sinh%20hoc_Lich%20hoc%20thang%206.pdf">Lịch học chuy&ecirc;n ng&agrave;nh PPDH BM Sinh học</a></p>\r\n<p>\r\n	<a href="/public/upload/files/K22_Quang%20hoc_Lich%20hoc%20thang%206.pdf">Lịch học chuy&ecirc;n ng&agrave;nh Quang học</a></p>\r\n<p>\r\n	<a href="/public/upload/files/K22_Van%20hoc%20Viet%20Nam_Lich%20hoc%20thang%206.pdf">Lịch học chuy&ecirc;n ng&agrave;nh Văn học Việt Nam</a></p>\r\n', '2015-06-04 07:33:52', 1618, 1, 1, 6, 1, NULL, 1, 1, NULL),
(123, 'Danh sách phòng thi kỳ thi kết thúc học phần cao học K14.2 (đợt 2)', '<p>\r\n	<span style="color:#ffffff;">.</span></p>\r\n', '2015-06-11 09:57:16', 808, 1, 1, 5, 1, NULL, 1, 1, '1434016636_ds-phong-thi.pdf'),
(124, 'Phát hành Bảng điểm bổ sung kiến thức kỳ thi tuyển sinh sau đại học khóa 15.1 năm 2015', '<p>\r\n	<span style="font-size:16px;"><span style="font-family:times new roman,times,serif;">&nbsp; &nbsp;Bảng điểm kh&oacute;a học bổ sung kiến thức tham dự kỳ thi tuyển sinh đ&agrave;o tạo tr&igrave;nh độ thạc sĩ kh&oacute;a 15.1 năm 2015 đ&atilde; bắt đầu được ph&aacute;t h&agrave;nh. Anh chị học vi&ecirc;n c&oacute; nhu cầu nhận Bảng điểm vui l&ograve;ng li&ecirc;n hệ Ph&ograve;ng Đ&agrave;o tạo Sau đại học (gặp chuy&ecirc;n vi&ecirc;n Ng&ocirc; Tuyết Hằng).</span></span></p>\r\n<p>\r\n	<span style="font-size:16px;"><span style="font-family:times new roman,times,serif;">&nbsp; &nbsp;Tr&acirc;n trọng.</span></span></p>\r\n', '2015-06-12 03:04:59', 1256, 1, 1, 5, 1, NULL, 1, 1, NULL),
(125, 'Thông báo nhận bài công bố trên Bản tin Khoa học trẻ, số 01, năm 2015, ISSN 2354-1105', '<p>\r\n	&nbsp;&nbsp;&nbsp;</p>\r\n', '2015-06-16 02:47:17', 90, 1, 1, 2, 1, '1434422834_001.jpg', 0, 1, '1434422836_ban-tin-khoa-hoc-tre.pdf'),
(126, 'Lịch thi kết thúc học phần cao học K14.2 đợt 2 năm 2015', '<p>\r\n	<span style="color:#ffffff;">.</span></p>\r\n', '2015-06-17 02:37:19', 819, 1, 1, 5, 1, NULL, 1, 1, '1434508639_1432096245_lich-thi-hoc-phan-14.2-(dot-2-2015)0001.pdf'),
(127, 'Thông báo số 2 Hội nghị Khoa học Công nghệ toàn quốc về Cơ khí lần thứ IV', '<p>\r\n	&nbsp;&nbsp;&nbsp;</p>\r\n', '2015-06-17 10:05:32', 63, 1, 1, 2, 1, '1434535530_001.jpg', 0, 1, '1434535532_hoi-nghi-khcn-toan-quoc-ve-co-khi.pdf'),
(128, 'Kết quả tuyển sinh đào tạo trình độ thạc sĩ khoá 15.1 năm 2015', '<p>\r\n	<span style="font-size:16px;"><a href="/public/upload/files/Diem%20TS%20NNH0001.pdf"><span style="font-family:times new roman,times,serif;">Kết quả tuyển sinh chuy&ecirc;n ng&agrave;nh Ng&ocirc;n ngữ học</span></a></span></p>\r\n<p>\r\n	<a href="/public/upload/files/Diem%20TS%20TGT0001.pdf"><span style="font-size:16px;"><span style="font-family:times new roman,times,serif;">Kết quả tuyển sinh chuy&ecirc;n ng&agrave;nh To&aacute;n giải t&iacute;ch</span></span></a></p>\r\n<p>\r\n	<a href="/public/upload/files/Diem%20TS%20TCNH0001.pdf"><span style="font-size:16px;"><span style="font-family:times new roman,times,serif;">Kết quả tuyển sinh chuy&ecirc;n ng&agrave;nh T&agrave;i ch&iacute;nh - Ng&acirc;n h&agrave;ng</span></span></a></p>\r\n<p>\r\n	<a href="/public/upload/files/Diem%20TS%20QLGD0001.pdf"><span style="font-size:16px;"><span style="font-family:times new roman,times,serif;">Kết quả tuyển sinh chuy&ecirc;n ng&agrave;nh Quản l&yacute; gi&aacute;o dục</span></span></a></p>\r\n<p>\r\n	<a href="/public/upload/files/Diem%20TS%20HHC0001.pdf"><span style="font-size:16px;"><span style="font-family:times new roman,times,serif;">Kết quả tuyển sinh chuy&ecirc;n ng&agrave;nh Ho&aacute; hữu cơ</span></span></a></p>\r\n<p>\r\n	<a href="/public/upload/files/Diem%20TS%20LSVN0001.pdf"><span style="font-size:16px;"><span style="font-family:times new roman,times,serif;">Kết quả tuyển sinh chuy&ecirc;n ng&agrave;nh Lịch sử Việt Nam</span></span></a></p>\r\n<p>\r\n	<a href="/public/upload/files/Diem%20TS%20VHVN0001.pdf"><span style="font-size:16px;"><span style="font-family:times new roman,times,serif;">Kết quả tuyển sinh chuy&ecirc;n ng&agrave;nh Văn học Việt Nam</span></span></a></p>\r\n<p>\r\n	&nbsp;</p>\r\n<p>\r\n	<a href="/public/upload/files/thong%20bao%20phuc%20khao0001%281%29.pdf"><span style="font-size:16px;"><span style="font-family:times new roman,times,serif;">Th&ocirc;ng b&aacute;o ph&uacute;c khảo</span></span></a></p>\r\n<p>\r\n	<a href="/public/upload/files/Don%20dk%20phuc%20khao0001%281%29.pdf"><span style="font-size:16px;"><span style="font-family:times new roman,times,serif;">Mẫu đơn xin ph&uacute;c khảo</span></span></a></p>\r\n', '2015-06-18 04:53:11', 4525, 1, 1, 5, 1, NULL, 1, 1, NULL),
(129, 'Thông báo tuyển sinh cao học liên kết Đại học Vinh đợt 2 năm 2015', '<p>\r\n	<span style="color:#ffffff;">.</span></p>\r\n', '2015-06-26 09:45:25', 3808, 1, 1, 6, 1, NULL, 1, 1, '1435311924_thong-bao-tuyen-sinh-cao-hoc-vinh-dot-2-nam-2015.pdf'),
(130, 'Lịch học cao học liên kết đại học Vinh Khóa 22 tháng 7,8,9 năm 2015', '<p>\r\n	<span style="font-size:16px;"><span style="font-family:times new roman,times,serif;"><a href="/public/upload/files/K22_Chinh%20tri%20hoc_Lich%20hoc%20thang%209.pdf">Lịch học ng&agrave;nh Ch&iacute;nh trị học</a></span></span></p>\r\n<p>\r\n	<span style="font-size:16px;"><span style="font-family:times new roman,times,serif;"><a href="/public/upload/files/K22_Dai%20so%20va%20Ly%20thuyet%20so_Lich%20hoc%20thang%207%20va%208.pdf">Lịch học ng&agrave;nh Đại số v&agrave; L&yacute; thuyết số</a></span></span></p>\r\n<p>\r\n	<span style="font-size:16px;"><span style="font-family:times new roman,times,serif;"><a href="/public/upload/files/K22_GD%20hoc_Lich%20hoc%20thang%207%20va%208.pdf">Lịch học ng&agrave;nh Gi&aacute;o dục học</a></span></span></p>\r\n<p>\r\n	<span style="font-size:16px;"><span style="font-family:times new roman,times,serif;"><a href="/public/upload/files/K22_Hoa%20huu%20co_Lich%20hoc%20thang%209.pdf">Lịch học ng&agrave;nh H&oacute;a hữu cơ</a></span></span></p>\r\n<p>\r\n	<span style="font-size:16px;"><span style="font-family:times new roman,times,serif;"><a href="/public/upload/files/K22_Hoa%20vo%20co_Lich%20hoc%20thang%207%20va%208.pdf">Lịch học ng&agrave;nh H&oacute;a v&ocirc; cơ</a></span></span></p>\r\n<p>\r\n	<span style="font-size:16px;"><span style="font-family:times new roman,times,serif;"><a href="/public/upload/files/K22_Lich%20su%20Viet%20Nam_Lich%20hoc%20thang%209.pdf">Lịch học ng&agrave;nh Lịch sử Việt Nam</a></span></span></p>\r\n<p>\r\n	<span style="font-size:16px;"><span style="font-family:times new roman,times,serif;"><a href="/public/upload/files/K22_LL%26PPDH%20Hoa_Lich%20hoc%20thang%209.pdf">Lịch học ng&agrave;nh LL&amp;PPDH H&oacute;a</a></span></span></p>\r\n<p>\r\n	<span style="font-size:16px;"><span style="font-family:times new roman,times,serif;"><a href="/public/upload/files/K22_LL%26PPDH%20Hoa_Lich%20hoc%20thang%209.pdf">Lịch học ng&agrave;nh LL&amp;PPDH&nbsp;</a><a href="/public/upload/files/K22_LL%26PPDH%20Toan_Lich%20hoc%20thang%209.pdf">To&aacute;n</a></span></span></p>\r\n<p>\r\n	<span style="font-size:16px;"><span style="font-family:times new roman,times,serif;"><a href="/public/upload/files/K22_LL%26PPDH%20Hoa_Lich%20hoc%20thang%209.pdf">Lịch học ng&agrave;nh LL&amp;PPDH&nbsp;</a><a href="/public/upload/files/K22_LL%26PPDH%20Van%20va%20TV_Lich%20hoc%20thang%209%281%29.pdf">Văn v&agrave; Tiếng Việt</a></span></span></p>\r\n<p>\r\n	<span style="font-size:16px;"><span style="font-family:times new roman,times,serif;"><a href="/public/upload/files/K22_LL%26PPDH%20Hoa_Lich%20hoc%20thang%209.pdf">Lịch học ng&agrave;nh LL&amp;PPDH&nbsp;</a><a href="/public/upload/files/K22_LL%26PPDH%20Vat%20ly_Lich%20hoc%20thang%209.pdf">Vật l&yacute;</a></span></span></p>\r\n<p>\r\n	<span style="font-size:16px;"><a href="/public/upload/files/K22_PPDH%20BM%20GD%20Chinh%20tri_Lich%20hoc%20thang%207%20va%208%281%29.pdf"><span style="font-family:times new roman,times,serif;">Lịch học ng&agrave;nh&nbsp;</span></a><span style="font-family:times new roman,times,serif;"><a href="/public/upload/files/K22_PPDH%20BM%20GD%20Chinh%20tri_Lich%20hoc%20thang%207%20va%208.pdf">PPDH BM Gi&aacute;o dục ch&iacute;nh trị</a></span></span></p>\r\n<p>\r\n	<span style="font-size:16px;"><a href="/public/upload/files/K22_PPDH%20BM%20Sinh%20hoc_Lich%20hoc%20thang%207%20va%208%281%29.pdf"><span style="font-family:times new roman,times,serif;">Lịch học ng&agrave;nh&nbsp;</span></a><span style="font-family:times new roman,times,serif;"><a href="/public/upload/files/K22_PPDH%20BM%20Sinh%20hoc_Lich%20hoc%20thang%207%20va%208.pdf">PPDH BM Sinh học</a></span></span></p>\r\n<p>\r\n	<span style="font-size:16px;"><a href="/public/upload/files/K22_Quang%20hoc_Lich%20hoc%20thang%207%20va%208%281%29.pdf"><span style="font-family: ''times new roman'', times, serif;">Lịch học ng&agrave;nh&nbsp;</span></a><span style="font-family:times new roman,times,serif;"><a href="/public/upload/files/K22_Quang%20hoc_Lich%20hoc%20thang%207%20va%208.pdf">Quang học</a></span></span></p>\r\n<p>\r\n	<span style="font-size:16px;"><a href="/public/upload/files/K22_Toan%20GT_Lich%20hoc%20thang%209%281%29.pdf"><span style="font-family: ''times new roman'', times, serif;">Lịch học ng&agrave;nh&nbsp;</span></a><span style="font-family:times new roman,times,serif;"><a href="/public/upload/files/K22_Toan%20GT_Lich%20hoc%20thang%209.pdf">To&aacute;n g</a></span><a href="/public/upload/files/K22_Toan%20GT_Lich%20hoc%20thang%209%281%29.pdf"><span style="font-family:times new roman,times,serif;">iải t&iacute;ch</span></a></span></p>\r\n<p>\r\n	<span style="font-size:16px;"><a href="/public/upload/files/K22_Van%20hoc%20Viet%20Nam_Lich%20hoc%20thang%207%20va%208%281%29.pdf"><span style="font-family: ''times new roman'', times, serif;">Lịch học ng&agrave;nh&nbsp;</span></a><span style="font-family:times new roman,times,serif;"><a href="/public/upload/files/K22_Van%20hoc%20Viet%20Nam_Lich%20hoc%20thang%207%20va%208.pdf">Văn học V</a></span><a href="/public/upload/files/K22_Van%20hoc%20Viet%20Nam_Lich%20hoc%20thang%207%20va%208%281%29.pdf"><span style="font-family:times new roman,times,serif;">iệt Nam</span></a></span></p>\r\n', '2015-06-29 03:05:27', 2487, 1, 1, 6, 1, NULL, 1, 1, NULL),
(131, 'QUYẾT ĐỊNH VÀ DANH SÁCH THÍ SINH TRÚNG TUYỂN ĐÀO TẠO TRÌNH ĐỘ THẠC SĨ  KHÓA 15.1 NĂM 2015', '<p>\r\n	<span style="background-color:#ffffff;">.</span></p>\r\n', '2015-07-12 11:31:59', 1593, 1, 1, 5, 1, NULL, 1, 1, '1436700716_quyet-dinh-va-danh-sach-trung-tuyen-k15.1.compressed.pdf'),
(132, 'THÔNG BÁO PHÚC KHẢO KẾT QUẢ THI TUYỂN SINH ĐÀO TẠO TRÌNH ĐỘ THẠC SĨ KHÓA 15.1', '<p>\r\n	<span style="background-color:#ffffff;">.</span></p>\r\n', '2015-07-12 11:33:52', 866, 1, 1, 5, 1, NULL, 1, 1, '1436700832_ket-qua-phuc-khao-15.1-(1).pdf'),
(133, 'Hướng dẫn nhập học cao học khóa 15.1', '<p>\r\n	<a href="/public/upload/files/Ly%20lich%20hoc%20vien%20cao%20hoc%281%29.doc"><span style="font-size:16px;"><span style="font-family:times new roman,times,serif;">Mẫu L&yacute; lịch học vi&ecirc;n cao học</span></span></a></p>\r\n', '2015-07-13 01:39:32', 1206, 1, 1, 5, 1, NULL, 1, 1, '1436751599_huong-dan-nhap-hoc-cao-hoc-k15.1.pdf'),
(134, 'Hội thảo khoa học lần I – năm 2015: “Chiến lược phát triển các trường đại học và kết quả nghiên cứu khoa học” tại Kiên Giang', '<p style="padding: 0px; margin: 0.5em 0px; border-color: rgb(234, 234, 234); font-family: Tahoma; font-size: 10.6666669845581px; color: rgb(75, 75, 75); line-height: 18px;">\r\n	<span style="padding: 0px; margin: 0px; border-color: rgb(234, 234, 234); font-family: tahoma, arial, verdana, sans-serif; font-size: 20px;"><span style="padding: 0px; margin: 0px; border-color: rgb(234, 234, 234); font-family: ''times new roman'', times, serif;">Ph&ograve;ng Quản l&yacute; khoa học th&ocirc;ng b&aacute;o đến c&aacute;c giảng vi&ecirc;n, CBVC về Hội thảo khoa học lần I &ndash; năm 2015: &ldquo;Chiến lược ph&aacute;t triển c&aacute;c trường đại học v&agrave; kết quả nghi&ecirc;n cứu khoa học&rdquo; tại Ki&ecirc;n Giang</span></span></p>\r\n<p style="padding: 0px; margin: 0.5em 0px; border-color: rgb(234, 234, 234); font-family: Tahoma; font-size: 10.6666669845581px; color: rgb(75, 75, 75); line-height: 18px;">\r\n	<span style="padding: 0px; margin: 0px; border-color: rgb(234, 234, 234); font-family: tahoma, arial, verdana, sans-serif; font-size: 20px;"><span style="padding: 0px; margin: 0px; border-color: rgb(234, 234, 234); font-family: ''times new roman'', times, serif;">Thời gian v&egrave; địa điểm tổ chức: trong 1 ng&agrave;y, dự kiến v&agrave;o khoảng ng&agrave;y 25-30/10/2015 tại Trường Đại học Ki&ecirc;n Giang</span></span></p>\r\n<p style="padding: 0px; margin: 0.5em 0px; border-color: rgb(234, 234, 234); font-family: Tahoma; font-size: 10.6666669845581px; color: rgb(75, 75, 75); line-height: 18px;">\r\n	<span style="padding: 0px; margin: 0px; border-color: rgb(234, 234, 234); font-family: tahoma, arial, verdana, sans-serif; font-size: 20px;"><span style="padding: 0px; margin: 0px; border-color: rgb(234, 234, 234); font-family: ''times new roman'', times, serif;">Thời hạn gửi b&agrave;i:</span></span></p>\r\n<p style="padding: 0px; margin: 0.5em 0px; border-color: rgb(234, 234, 234); font-family: Tahoma; font-size: 10.6666669845581px; color: rgb(75, 75, 75); line-height: 18px;">\r\n	<span style="padding: 0px; margin: 0px; border-color: rgb(234, 234, 234); font-family: tahoma, arial, verdana, sans-serif; font-size: 20px;"><span style="padding: 0px; margin: 0px; border-color: rgb(234, 234, 234); font-family: ''times new roman'', times, serif;">+ Gửi t&oacute;m tắt tham luận trước ng&agrave;y 30/7/2015</span></span></p>\r\n<p style="padding: 0px; margin: 0.5em 0px; border-color: rgb(234, 234, 234); font-family: Tahoma; font-size: 10.6666669845581px; color: rgb(75, 75, 75); line-height: 18px;">\r\n	<span style="padding: 0px; margin: 0px; border-color: rgb(234, 234, 234); font-family: tahoma, arial, verdana, sans-serif; font-size: 20px;"><span style="padding: 0px; margin: 0px; border-color: rgb(234, 234, 234); font-family: ''times new roman'', times, serif;">+ Gửi to&agrave;n văn b&agrave;i tham luận trước ng&agrave;y 30/8/2015</span></span></p>\r\n<p style="padding: 0px; margin: 0.5em 0px; border-color: rgb(234, 234, 234); font-family: Tahoma; font-size: 10.6666669845581px; color: rgb(75, 75, 75); line-height: 18px;">\r\n	<span style="padding: 0px; margin: 0px; border-color: rgb(234, 234, 234); font-family: tahoma, arial, verdana, sans-serif; font-size: 20px;"><span style="padding: 0px; margin: 0px; border-color: rgb(234, 234, 234); font-family: ''times new roman'', times, serif;">Địa chỉ gửi b&agrave;i tham luận: gửi về email: qlkhhtqt@vnkgu.edu.vn&nbsp;</span></span></p>\r\n<p style="padding: 0px; margin: 0.5em 0px; border-color: rgb(234, 234, 234); font-family: Tahoma; font-size: 10.6666669845581px; color: rgb(75, 75, 75); line-height: 18px;">\r\n	<span style="padding: 0px; margin: 0px; border-color: rgb(234, 234, 234); font-family: tahoma, arial, verdana, sans-serif; font-size: 20px;"><span style="padding: 0px; margin: 0px; border-color: rgb(234, 234, 234); font-family: ''times new roman'', times, serif;">Để r&otilde; hơn chi tiết, qu&yacute; giảng vi&ecirc;n, CBVC vui l&ograve;ng tham khảo th&ocirc;ng t&iacute;n đ&iacute;nh k&egrave;m:&nbsp;<a href="http://qlkh-sdh.sgu.edu.vn/public/upload/files/Ke%20hoach%20Hoi%20thao%20lan%20I%20-%20DHKG.pdf" style="padding: 0px; margin: 0px; border-color: rgb(234, 234, 234); font-family: Tahoma, Arial, Helvetica, sans-serif; text-decoration: none; color: rgb(128, 153, 168); font-size: inherit;">Bấm v&agrave;o đ&acirc;y để tải</a></span></span></p>\r\n', '2015-07-15 02:27:54', 70, 1, 1, 2, 1, NULL, 0, 1, '1436927274_thong-bao-hoi-thao-lan-i---dhkg.pdf'),
(135, 'Thư mời viết tham luận Hội thảo Khoa học Tư tưởng Hồ CHí Minh với sự nghiệp đổi mới của dân tộc', '<p>\r\n	&nbsp; &nbsp;&nbsp;</p>\r\n', '2015-07-15 02:33:02', 90, 1, 1, 2, 1, NULL, 0, 1, '1436927582_hoi-thao-tu-tuong-hcm.pdf'),
(136, 'Thư mời viết bài tham gia Hội thảo khoa học "Quan hệ Việt Nam và Trung Quốc trong bối cảnh mới"', '<p>\r\n	&nbsp; &nbsp;</p>\r\n', '2015-07-15 02:34:50', 61, 1, 1, 2, 1, NULL, 0, 1, '1436927690_hoi-thao-quan-he-viet-nam-va-tq.pdf'),
(137, 'Thư mời viết bài tham luận Hội thảo khoa học "Hoạt động bảo lãnh tín dụng cho doanh nghiệp nhỏ và vừa trên địa bàn TP.HCM"', '<p>\r\n	&nbsp; &nbsp;</p>\r\n', '2015-07-15 02:37:18', 64, 1, 1, 2, 1, NULL, 0, 1, '1436927838_hoi-thao-hoat-dong-bao-lanh-tin-dung.pdf'),
(138, 'THỜI KHOÁ BIỂU HỌC KỲ 1 - ĐỢT 1, CAO HỌC KHÓA 15.1', '<p>\r\n	<a href="/public/upload/files/TKB%2015.1%20HK1%20dot%201%20-%20L1511%281%29.pdf"><span style="font-size:16px;"><span style="font-family:times new roman,times,serif;">Thời kh&oacute;a biểu nh&oacute;m chuy&ecirc;n ng&agrave;nh To&aacute;n giải t&iacute;ch, H&oacute;a hữu cơ</span></span></a></p>\r\n<p>\r\n	<a href="/public/upload/files/TKB%2015.1%20HK1%20dot%201%20-%20L1512%282%29.pdf"><span style="font-size:16px;"><span style="font-family:times new roman,times,serif;">Thời kh&oacute;a biểu chuy&ecirc;n ng&agrave;nh Quản l&yacute; gi&aacute;o dục</span></span></a></p>\r\n<p>\r\n	<a href="/public/upload/files/TKB%2015.1%20HK1%20dot%201%20-%20L1513%282%29.pdf"><span style="font-size:16px;"><span style="font-family:times new roman,times,serif;">Thời kh&oacute;a biểu nh&oacute;m chuy&ecirc;n ng&agrave;nh Ng&ocirc;n ngữ học, Văn học Việt Nam, Lịch sử Việt Nam, T&agrave;i ch&iacute;nh - Ng&acirc;n h&agrave;ng</span></span></a></p>\r\n', '2015-07-16 07:44:23', 2128, 1, 1, 5, 1, NULL, 1, 1, NULL),
(139, 'Lịch học bổ sung kiến thức tuyển sinh cao học liên kết Đại học Vinh', '<p>\r\n	<span style="color:#ffffff;">.</span></p>\r\n', '2015-07-23 14:22:06', 1258, 1, 1, 6, 1, NULL, 1, 1, '1437754210_lich-hoc-bo-sung-sai-gon-(chinh-thuc)-(1).pdf'),
(140, 'THỜI KHOÁ BIỂU HỌC KỲ 2 - ĐỢT 1, CAO HỌC KHÓA 14.2', '<p>\r\n	<span style="font-size:16px;"><span style="font-family:times new roman,times,serif;"><a href="/public/upload/files/TKB%2014.2%20HK2%20dot%201%20-%20NNH142%281%29.pdf">Thời kh&oacute;a biểu chuy&ecirc;n ng&agrave;nh Ng&ocirc;n ngữ học</a></span></span></p>\r\n<p>\r\n	<a href="/public/upload/files/TKB%2014.2%20HK2%20dot%201%20-%20TNH142%20-%20010915.pdf"><span style="font-size:16px;"><span style="font-family:times new roman,times,serif;">Thời kh&oacute;a biểu chuy&ecirc;n ng&agrave;nh T&agrave;i ch&iacute;nh - Ng&acirc;n h&agrave;ng&nbsp;(cập nhật ng&agrave;y 01/9/2015)</span></span></a></p>\r\n<p>\r\n	<a href="/public/upload/files/TKB%2014.2%20HK2%20dot%201%20-%20TGT142%20-%20010915.pdf"><span style="font-size:16px;"><span style="font-family:times new roman,times,serif;">Thời kh&oacute;a biểu chuy&ecirc;n ng&agrave;nh To&aacute;n giải t&iacute;ch&nbsp;(cập nhật ng&agrave;y 01/9/2015)</span></span></a></p>\r\n<p>\r\n	<span style="font-size:16px;"><span style="font-family:times new roman,times,serif;"><a href="/public/upload/files/TKB%2014.2%20HK2%20dot%201%20-%20QLG1421.pdf">Thời kh&oacute;a biểu chuy&ecirc;n ng&agrave;nh Quản l&yacute; gi&aacute;o dục - Lớp QLG1421</a></span></span></p>\r\n<p>\r\n	<span style="font-size:16px;"><span style="font-family:times new roman,times,serif;"><a href="/public/upload/files/TKB%2014.2%20HK2%20dot%201%20-%20QLG1422%281%29%281%29.pdf">Thời kh&oacute;a biểu chuy&ecirc;n ng&agrave;nh Quản l&yacute; gi&aacute;o dục - Lớp QLG1422</a></span></span></p>\r\n<p>\r\n	&nbsp;</p>\r\n<p>\r\n	&nbsp;</p>\r\n', '2015-07-29 09:47:13', 2148, 1, 1, 5, 1, NULL, 1, 1, NULL),
(141, 'Quy định về đối tượng ưu tiên tuyển sinh đào tạo trình độ thạc sĩ khóa 15.2 năm 2015', '<p>\r\n	<span style="color:#ffffff;">.</span></p>\r\n', '2015-07-30 10:25:08', 616, 1, 1, 5, 1, NULL, 0, 1, '1438251908_quy-dinh-doi-tuong-uu-tien.pdf'),
(142, 'Quy định về đối tượng miễn thi ngoại ngữ tuyển sinh đào tạo trình độ thạc sĩ khóa 15.2 năm 2015', '<p>\r\n	<span style="color:#ffffff;">.</span></p>\r\n', '2015-07-30 10:25:51', 852, 1, 1, 5, 1, NULL, 0, 1, '1438251951_quy-dinh-doi-tuong-mien-thi-dau-vao-nn.pdf'),
(143, 'Thông báo tuyển sinh đào tạo trình độ thạc sĩ khóa 15.2 năm 2015', '<p>\r\n	<span style="color:#ffffff;">.</span></p>\r\n', '2015-07-30 10:30:04', 1511, 0, 1, 5, 1, NULL, 1, 1, '1438252304_tbts-15.2.pdf'),
(144, 'Lịch thi kết thúc học phần học kỳ 1 đợt 1, cao học khóa 15.1', '<p>\r\n	<span style="color:#ffffff;">.</span></p>\r\n', '2015-08-04 01:52:00', 1070, 1, 1, 5, 1, NULL, 1, 1, '1438653120_lich-thi-triet-va-av-15.10001.pdf'),
(145, 'TB về lịch học học kỳ 2 năm học 2015-2016 và học phí đợt 2 năm học 2014-2015', '<p>\r\n	<span style="color:#ffffff;">.</span></p>\r\n', '2015-08-10 01:23:22', 1386, 1, 1, 5, 1, NULL, 1, 1, '1439169802_tb-hoc-phi-dot-2-14.2.pdf'),
(146, 'Thông báo tuyển sinh đào tạo trình độ thạc sĩ khóa 15.2 năm 2015', '<p>\r\n	<span style="color:#ffffff;">.</span></p>\r\n', '2015-08-10 01:25:34', 1462, 0, 1, 5, 1, NULL, 1, 1, '1439169934_tbts-15.2.pdf'),
(147, 'Đề cương ôn thi cao học Vinh đợt 2 năm 2015', '<p>\r\n	<a href="/public/upload/files/Chinh%20tri%20hoc_De%20cuong%20on%20thi.pdf"><span style="font-size:16px;"><span style="font-family:times new roman,times,serif;">Đề cương &ocirc;n thi chuy&ecirc;n ng&agrave;nh Ch&iacute;nh trị học</span></span></a></p>\r\n<p>\r\n	<a href="/public/upload/files/Dai%20so%20va%20LT%20so_De%20cuong%20on%20thi.pdf"><span style="font-size:16px;"><span style="font-family:times new roman,times,serif;">Đề cương &ocirc;n thi chuy&ecirc;n ng&agrave;nh Đại số v&agrave; L&yacute; thuyết số</span></span></a></p>\r\n<p>\r\n	<a href="/public/upload/files/GD%20hoc%20%28bac%20Tieu%20hoc%29_De%20cuong%20on%20thi.pdf"><span style="font-size:16px;"><span style="font-family:times new roman,times,serif;">Đề cương &ocirc;n thi chuy&ecirc;n ng&agrave;nh Gi&aacute;o dục học (bậc Tiểu học)</span></span></a></p>\r\n<p>\r\n	<a href="/public/upload/files/LL%26PPDH%20Hoa_De%20cuong%20on%20thi.pdf"><span style="font-size:16px;"><span style="font-family:times new roman,times,serif;">Đề cương &ocirc;n thi chuy&ecirc;n ng&agrave;nh LL&amp;PPDH H&oacute;a</span></span></a></p>\r\n<p>\r\n	<a href="/public/upload/files/LL%26PPDHBM%20Sinh%20hoc_De%20cuong%20on%20thi.pdf"><span style="font-size:16px;"><span style="font-family:times new roman,times,serif;">Đề cương &ocirc;n thi chuy&ecirc;n ng&agrave;nh LL&amp;PPDH Sinh</span></span></a></p>\r\n<p>\r\n	<a href="/public/upload/files/Quang%20hoc_De%20cuong%20on%20thi.pdf"><span style="font-size:16px;"><span style="font-family:times new roman,times,serif;">Đề cương &ocirc;n thi chuy&ecirc;n ng&agrave;nh Quang học</span></span></a></p>\r\n<p>\r\n	<a href="/public/upload/files/De%20cuong%20mon%20thi%20tieng%20Anh%281%29.pdf"><span style="font-size:16px;"><span style="font-family:times new roman,times,serif;">Đề cương &ocirc;n thi m&ocirc;n Tiếng Anh</span></span></a></p>\r\n', '2015-08-18 07:17:32', 1721, 1, 1, 6, 1, NULL, 1, 1, NULL),
(148, 'Hướng dẫn học viên cao học Vinh truy cập tài khoản cá nhân trên trang web Đại học Vinh', '<p>\r\n	<span style="color:#ffffff;">.</span></p>\r\n', '2015-08-18 07:18:32', 878, 1, 1, 6, 1, NULL, 1, 1, '1439882312_huong-dan-truy-cap-website-dhv.pdf'),
(149, 'Thời khóa biểu học bổ sung kiến thức kỳ thi tuyển sinh đào tạo trình độ thạc sĩ khóa 15.2', '<p>\r\n	<a href="/public/upload/files/Tkb%20BSKT%2015.2%20QLGD.pdf"><span style="font-size:16px;"><span style="font-family:times new roman,times,serif;">Chuy&ecirc;n ng&agrave;nh Quản l&yacute; gi&aacute;o dục</span></span></a></p>\r\n', '2015-08-21 07:55:48', 19, 0, 1, 5, 1, NULL, 1, 1, '1440143748_tkb-bskt-15.2-qlgd.pdf'),
(150, 'THỜI KHOÁ BIỂU HỌC KỲ 1 - ĐỢT 2, CAO HỌC KHÓA 15.1', '<p>\r\n	<a href="/public/upload/files/TKB%20HK1%20Dot%202%20K151%20-%20TCNH.pdf" style="line-height: 107%; font-family: ''times new roman'', times, serif; font-size: 16px;">Chuy&ecirc;n ng&agrave;nh T&agrave;i ch&iacute;nh - Ng&acirc;n h&agrave;ng</a></p>\r\n<p>\r\n	<span style="font-size:16px;"><span style="font-family:times new roman,times,serif;"><a href="/public/upload/files/TKB%20HK1%20Dot%202%20K151%20-%20TGT151%20-%20010915.pdf">Chuy&ecirc;n ng&agrave;nh To&aacute;n giải t&iacute;ch&nbsp;(cập nhật 01/9/2015)</a></span></span></p>\r\n<p>\r\n	<span style="font-size:16px;"><span style="font-family:times new roman,times,serif;"><a href="/public/upload/files/TKB%20HK1%20Dot%202%20K151%20-%20LSV151%281%29.pdf">Chuy&ecirc;n ng&agrave;nh Lịch sử Việt Nam</a></span></span></p>\r\n<p>\r\n	<span style="font-size:16px;"><span style="font-family:times new roman,times,serif;"><a href="/public/upload/files/TKB%20HK1-%C4%91%E1%BB%A3t%202%20K15.1%20-%20NNH151.pdf">Chuy&ecirc;n ng&agrave;nh Ng&ocirc;n ngữ học</a></span></span></p>\r\n<p>\r\n	<span style="font-size:16px;"><span style="font-family:times new roman,times,serif;"><a href="/public/upload/files/TKB%20HK1%20Dot%202%20K151%20-%20VHV151%20-%20Updated%20110915.pdf">Chuy&ecirc;n ng&agrave;nh Văn học Việt Nam&nbsp;(cập nhật ng&agrave;y 11/9/2015)</a></span></span></p>\r\n<p>\r\n	<span style="font-size:16px;"><span style="font-family:times new roman,times,serif;"><a href="/public/upload/files/TKB%20HK1%20Dot%202%20K151%20-%20HHC%20-%20Updated%20110915.pdf">Chuy&ecirc;n ng&agrave;nh H&oacute;a hữu cơ&nbsp;(cập nhật ng&agrave;y 11/9/2015)</a></span></span></p>\r\n<p>\r\n	<span style="font-size:16px;"><span style="font-family:times new roman,times,serif;"><a href="/public/upload/files/Thoi%20khoa%20bieu%20QLG15110001.pdf">Chuy&ecirc;n ng&agrave;nh Quản l&yacute; gi&aacute;o dục - Lớp QLG1511</a></span></span></p>\r\n<p>\r\n	<span style="font-size:16px;"><span style="font-family:times new roman,times,serif;"><a href="/public/upload/files/Thoi%20khoa%20bieu%20QLG15120001.pdf">Chuy&ecirc;n ng&agrave;nh Quản l&yacute; gi&aacute;o dục - Lớp QLG1512</a></span></span></p>\r\n', '2015-08-21 08:02:13', 3406, 1, 1, 5, 1, NULL, 1, 1, NULL),
(151, 'Thời khóa biểu học bổ sung kiến thức kỳ thi tuyển sinh đào tạo trình độ thạc sĩ khóa 15.2', '<p>\r\n	<a href="/public/upload/files/TKB%20BSKT%2015.2-QLGD%20-%20010915.pdf"><span style="font-size:16px;"><span style="font-family:times new roman,times,serif;">Chuy&ecirc;n ng&agrave;nh Quản l&yacute; gi&aacute;o dục&nbsp;(cập nhật ng&agrave;y 01/9/2015)</span></span></a></p>\r\n<p>\r\n	<a href="/public/upload/files/TCNH%20-%20TKB%20hoc%20Bo%20tuc%20kien%20thuc%20K15.2.pdf"><span style="font-family: ''times new roman'', times, serif; font-size: 16px;">Chuy&ecirc;n ng&agrave;nh T&agrave;i ch&iacute;nh - Ng&acirc;n h&agrave;ng</span></a></p>\r\n', '2015-08-21 08:18:13', 1843, 1, 1, 5, 1, NULL, 1, 1, NULL),
(152, 'Thông báo tuyển sinh đào tạo trình độ thạc sĩ khóa 15.2 năm 2015', '<p>\r\n	<span style="color:#ffffff;">.</span></p>\r\n', '2015-08-21 08:28:45', 2385, 1, 1, 5, 1, NULL, 1, 1, '1440145725_tbts-15.2.pdf'),
(153, 'Danh sách học viên dự thi kỳ thi kết thúc học phần học kỳ 1 - đợt 1, cao học khóa 15.1', '<p>\r\n	<span style="font-size:16px;"><span style="font-family:times new roman,times,serif;"><a href="/public/upload/files/Phong%20thi%20-%20QLG1511.pdf">Chuy&ecirc;n ng&agrave;nh Quản l&yacute; gi&aacute;o dục - Lớp QLG1511</a></span></span></p>\r\n<p>\r\n	<span style="font-size:16px;"><span style="font-family:times new roman,times,serif;"><a href="/public/upload/files/Phong%20thi%20-%20QLG1512.pdf">Chuy&ecirc;n ng&agrave;nh Quản l&yacute; gi&aacute;o dục - Lớp QLG1512</a></span></span></p>\r\n<p>\r\n	<span style="font-size:16px;"><span style="font-family:times new roman,times,serif;"><a href="/public/upload/files/Phong%20thi%20-%20TNH.pdf">Chuy&ecirc;n ng&agrave;nh T&agrave;i ch&iacute;nh - Ng&acirc;n h&agrave;ng</a></span></span></p>\r\n<p>\r\n	<span style="font-size:16px;"><span style="font-family:times new roman,times,serif;"><a href="/public/upload/files/Ph%C3%B2ng%20thi%20-%20TGT.pdf">Chuy&ecirc;n ng&agrave;nh To&aacute;n giải t&iacute;ch</a></span></span></p>\r\n<p>\r\n	<span style="font-size:16px;"><span style="font-family:times new roman,times,serif;"><a href="/public/upload/files/Phong%20thi%20-%20NNH.pdf">Chuy&ecirc;n ng&agrave;nh Ng&ocirc;n ngữ học</a></span></span></p>\r\n<p>\r\n	<span style="font-size:16px;"><span style="font-family:times new roman,times,serif;"><a href="/public/upload/files/Phong%20thi-VHV.pdf">Chuy&ecirc;n ng&agrave;nh Văn học Việt Nam</a></span></span></p>\r\n<p>\r\n	<span style="font-size:16px;"><span style="font-family:times new roman,times,serif;"><a href="/public/upload/files/Phong%20thi-LSV.pdf">Chuy&ecirc;n ng&agrave;nh Lịch sử Việt Nam</a></span></span></p>\r\n<p>\r\n	<span style="font-size:16px;"><span style="font-family:times new roman,times,serif;"><a href="/public/upload/files/Phong%20thi%20-%20HHC.pdf">Chuy&ecirc;n ng&agrave;nh H&oacute;a hữu cơ</a></span></span></p>\r\n', '2015-08-27 07:15:46', 776, 0, 1, 5, 1, NULL, 1, 1, NULL),
(154, 'Thông báo lịch thi tuyển sinh cao học đợt 2 năm 2015 của Đại học Vinh', '<p>\r\n	<span style="background-color:#ffffff;"><img alt="" src="/public/upload/images/TB%20lich%20thi%20tuyen%20sinh%20CH%20%C4%90H%20Vinh.jpg" style="width: 650px; height: 893px;" />.</span></p>\r\n', '2015-08-27 10:56:48', 1570, 1, 1, 6, 1, '1440673008_tb-lich-thi-tuyen-sinh-ch-dh-vinh.jpg', 1, 1, NULL),
(155, 'Thông báo về kế hoạch ôn thi tuyển sinh cao học Vinh đợt 2 năm 2015 tại trường Đại học Sài Gòn', '<p>\r\n	<span style="background-color:#ffffff;">.</span></p>\r\n', '2015-08-28 04:08:00', 1658, 1, 1, 6, 1, NULL, 1, 1, '1440734880_thong-bao-on-thi-ts-k230001.pdf'),
(157, 'Thông báo về việc đăng ký học lại đối với học viên cao học khóa 14.2', '<p>\r\n	<a href="/public/upload/files/Thong%20bao%20ve%20dang%20ki%20hoc%20lai0001%281%29.pdf"><span style="font-size:16px;"><span style="font-family:times new roman,times,serif;">Th&ocirc;ng b&aacute;o về việc đăng k&yacute; học lại đối với học vi&ecirc;n cao học kh&oacute;a 14.2</span></span></a></p>\r\n<p>\r\n	<a href="/public/upload/files/HVHL02-Don%20xin%20hoc%20lai%281%29.doc"><span style="font-size:16px;"><span style="font-family:times new roman,times,serif;">Mẫu đơn đăng k&yacute; học lại</span></span></a></p>\r\n', '2015-08-28 07:24:34', 697, 1, 1, 5, 1, NULL, 1, 1, NULL),
(158, 'Lịch thi kết thúc học phần Học kỳ 2 - đợt 1, Cao học khóa 14.2', '<p>\r\n	<span style="color:#ffffff;">.</span></p>\r\n', '2015-09-03 10:02:19', 727, 1, 1, 5, 1, NULL, 1, 1, '1441334122_lich-thi-hk2-dot-1-14.20001.pdf'),
(159, 'Thông báo về việc nộp học phí đợt 2 của học viên cao học Vinh khóa 22', '<p>\r\n	<span style="color:#ffffff;">.........</span></p>\r\n', '2015-09-14 08:11:33', 419, 1, 1, 6, 1, NULL, 1, 1, '1442218443_thong-bao-hp-cao-hoc-vinh-k22-dot-20001.pdf'),
(160, 'Thời khóa biểu ôn thi tuyển sinh đào tạo trình độ thạc sĩ Khóa 15.2', '<p>\r\n	<a href="/public/upload/files/QLGD_Lich%20on%20thi%20tuyen%20sinh%20Khoa%2015.2.pdf"><span style="font-size:16px;"><span style="font-family:times new roman,times,serif;">Chuy&ecirc;n ng&agrave;nh Quản l&yacute; Gi&aacute;o dục</span></span></a></p>\r\n', '2015-09-14 10:16:25', 1286, 1, 1, 5, 1, NULL, 1, 1, NULL),
(161, 'Lịch thi kết thúc học phần Bổ túc kiến thức dự thi tuyển sinh đào tạo trình độ thạc sĩ khóa 15.2', '<p>\r\n	<span style="color:#ffffff;">...............</span></p>\r\n', '2015-09-16 04:08:18', 342, 1, 1, 5, 1, NULL, 1, 1, '1442376498_lich-thi-btkt-15.20001.pdf');

-- --------------------------------------------------------

--
-- Table structure for table `tin_tuc`
--

CREATE TABLE IF NOT EXISTS `tin_tuc` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `tieu_de` varchar(250) COLLATE utf8_unicode_ci NOT NULL,
  `mo_ta_tom_tat` text COLLATE utf8_unicode_ci NOT NULL,
  `mo_ta_chi_tiet` text COLLATE utf8_unicode_ci NOT NULL,
  `ngay_tao` datetime NOT NULL,
  `so_lan_xem` int(10) NOT NULL DEFAULT '1',
  `trang_thai` tinyint(4) NOT NULL DEFAULT '1',
  `file` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `ma_quan_tri` int(11) NOT NULL,
  `quan_trong` tinyint(1) NOT NULL DEFAULT '0',
  `search` tinyint(1) NOT NULL DEFAULT '1',
  `noi_bat` tinyint(1) NOT NULL DEFAULT '0',
  `file_pdf` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=42 ;

--
-- Dumping data for table `tin_tuc`
--

INSERT INTO `tin_tuc` (`id`, `tieu_de`, `mo_ta_tom_tat`, `mo_ta_chi_tiet`, `ngay_tao`, `so_lan_xem`, `trang_thai`, `file`, `ma_quan_tri`, `quan_trong`, `search`, `noi_bat`, `file_pdf`) VALUES
(2, 'Trường Đại học Khoa học Ứng dụng Tây Bắc Thụy Sĩ hợp tác đào tạo “Chuyên đề Bồi dưỡng sau Đại học ngành Hành chính công” với Trường ĐHSG', 'Hơn 2 tháng sau ngày kí biên bản ghi nhớ hợp tác giữa Trường ĐHSG và Trường Đại học Khoa học Ứng dụng Tây Bắc Thụy Sĩ tại Diễn đàn Giáo dục Đào tạo Việt Nam – Thụy Sĩ lần thứ 1 vào ngày 12/10/2011, nhân kỉ niệm 40 năm quan hệ ngoại giao Việt Nam – Thụy sĩ (1971 - 2011).', '<p style="text-align: center">\r\n	<span style="color: rgb(0,0,128)"><span style="font-size: 24px"><span style="font-family: ''Times New Roman''">TRƯỜNG ĐẠI HỌC KHOA HỌC ỨNG DỤNG T&Acirc;Y BẮC THỤY SĨ HỢP T&Aacute;C Đ&Agrave;O TẠO </span></span></span></p>\r\n<p style="text-align: center">\r\n	<span style="color: rgb(0,0,255)"><strong><span style="font-size: 24px"><span style="font-family: ''Times New Roman''">&ldquo;CHUY&Ecirc;N ĐỀ BỒI DƯỠNG SAU ĐẠI HỌC NG&Agrave;NH H&Agrave;NH CH&Iacute;NH C&Ocirc;NG&rdquo;</span></span></strong></span><span style="color: rgb(0,0,128)"><span style="font-size: 24px"><span style="font-family: ''Times New Roman''"> </span></span></span></p>\r\n<p style="text-align: center">\r\n	<span style="color: rgb(0,0,128)"><span style="font-size: 24px"><span style="font-family: ''Times New Roman''">VỚI TRƯỜNG ĐẠI HỌC S&Agrave;I G&Ograve;N</span></span></span></p>\r\n<div>\r\n	&nbsp;</div>\r\n<div style="text-align: justify">\r\n	&nbsp; &nbsp; &nbsp; &nbsp;<span style="font-size: 16px"><span style="font-family: Arial"> &nbsp; Hơn 2 th&aacute;ng sau ng&agrave;y k&iacute; bi&ecirc;n bản ghi nhớ hợp t&aacute;c giữa Trường Đại học S&agrave;i G&ograve;n v&agrave; Trường Đại học Khoa học Ứng dụng T&acirc;y Bắc Thụy Sĩ tại Diễn đ&agrave;n Gi&aacute;o dục Đ&agrave;o tạo Việt Nam &ndash; Thụy Sĩ lần thứ 1 v&agrave;o ng&agrave;y 12/10/2011, nh&acirc;n kỉ niệm 40 năm quan hệ ngoại giao Việt Nam &ndash; Thụy sĩ (1971 - 2011). S&aacute;ng 28/12/2011, Trường Đại học Khoa học Ứng dụng T&acirc;y Bắc Thụy Sĩ đ&atilde; đến thăm, l&agrave;m việc v&agrave; k&iacute; k&iacute; kết văn bản thoả thuận hợp t&aacute;c đ&agrave;o tạo &ldquo;Chuy&ecirc;n đề Bồi dưỡng sau Đại học ng&agrave;nh H&agrave;nh ch&iacute;nh c&ocirc;ng&rdquo; với Trường Đại học S&agrave;i G&ograve;n.</span></span></div>\r\n<div style="text-align: justify">\r\n	<span style="font-size: 16px"><span style="font-family: Arial">&nbsp; &nbsp; &nbsp; &nbsp; &nbsp;&nbsp;Tiếp đo&agrave;n c&oacute; PGS.TS. Nguyễn Viết Ngoạn, B&iacute; thư Đảng ủy, Hiệu trưởng Trường; ThS. L&ecirc; Văn Việt, Ph&oacute; B&iacute; thư Đảng ủy, Ph&oacute; Hiệu trưởng; TS. L&ecirc; Hồng Sơn, Trưởng ph&ograve;ng Quan hệ Quốc tế; B&agrave; Nguyễn Thị Thu Hương, Trưởng ph&ograve;ng H&agrave;nh ch&iacute;nh Tổng hợp v&agrave; B&agrave; Nguyễn Thị Đương, Kế to&aacute;n trưởng Trường.</span></span></div>\r\n<div style="text-align: justify">\r\n	<span style="font-size: 16px"><span style="font-family: Arial">Về ph&iacute;a đối t&aacute;c c&oacute; GS.TS. Markus Freiburghaus, Th&agrave;nh vi&ecirc;n Ban Gi&aacute;m đốc Trường Đại học Khoa học Ứng dụng T&acirc;y Bắc Thụy Sĩ; ThS. Đinh Thị Ngọc Li&ecirc;n, giảng vi&ecirc;n của trường; TS. L&ecirc; Thị Hiệp Thương, Viện trưởng Viện Nghi&ecirc;n cứu v&agrave; Quản l&iacute; Gi&aacute;o dục Tp. Hồ Ch&iacute; Minh.</span></span></div>\r\n<div style="text-align: justify">\r\n	<span style="font-size: 16px"><span style="font-family: Arial">&nbsp; &nbsp; &nbsp; &nbsp; &nbsp;&nbsp;Mở đầu buổi l&agrave;m việc, PGS. TS. Nguyễn Viết Ngoạn, B&iacute; thư Đảng ủy, Hiệu trưởng Trường ch&agrave;o mừng c&aacute;c vị kh&aacute;ch đ&atilde; đến thăm, l&agrave;m việc tại trường v&agrave; giới thiệu sơ lược về Trường Đại học S&agrave;i G&ograve;n.&nbsp;</span></span></div>\r\n<div style="text-align: justify">\r\n	<span style="font-size: 16px"><span style="font-family: Arial">&nbsp; &nbsp; &nbsp; &nbsp; &nbsp;&nbsp;Ph&aacute;t biểu tại buổi tiếp, GS.TS. Markus Freiburghaus, Th&agrave;nh vi&ecirc;n Ban Gi&aacute;m đốc Trường Đại học Khoa học Ứng dụng T&acirc;y Bắc Thụy Sĩ đ&atilde; giới thiệu về trường, c&aacute;c chương tr&igrave;nh đ&agrave;o tạo, giảng dạy v&agrave; nghi&ecirc;n cứu của trường. &Ocirc;ng cũng cho rằng, cần đẩy mạnh quan hệ hợp t&aacute;c với Trường Đại học S&agrave;i G&ograve;n v&igrave; hai trường c&oacute; nhiều điểm tương đồng.</span></span></div>\r\n<div>\r\n	<span style="font-size: 16px"><span style="font-family: Arial">&nbsp; &nbsp; &nbsp; &nbsp; &nbsp;&nbsp;Dự kiến kho&aacute; đ&agrave;o tạo &ldquo;Chuy&ecirc;n đề Bồi dưỡng sau Đại học ng&agrave;nh H&agrave;nh ch&iacute;nh c&ocirc;ng&rdquo; sẽ chi&ecirc;u sinh v&agrave;o đầu năm 2012.</span></span></div>\r\n<div>\r\n	&nbsp;</div>\r\n<div>\r\n	<span style="text-align: justify; line-height: 24px; font-family: Arial; font-size: 16px">&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; <a href="http://sgu.edu.vn/sgu1/index.php?option=com_content&amp;view=article&amp;id=1961:din-an-giao-dc-i-hc-vit-nam-thy-s-&amp;catid=88:newsevent&amp;Itemid=610">Diễn đ&agrave;n Gi&aacute;o dục Đại học Việt nam- Thụy Sĩ lần thứ nhất tại H&agrave; Nội (</a></span><a href="http://sgu.edu.vn/sgu1/index.php?option=com_content&amp;view=article&amp;id=1961:din-an-giao-dc-i-hc-vit-nam-thy-s-&amp;catid=88:newsevent&amp;Itemid=610"><span style="font-family: Arial; font-size: 16px">ng&agrave;y 12/10/2011</span><span style="text-align: justify; line-height: 24px; font-family: Arial; font-size: 16px">)</span></a></div>\r\n<div>\r\n	&nbsp;</div>\r\n<div>\r\n	<span style="font-size: 16px"><span style="font-family: Arial">&nbsp; &nbsp; &nbsp;</span><strong><span style="font-family: Arial"> &nbsp; &nbsp;&nbsp;Sau đ&acirc;y l&agrave; một số h&igrave;nh ảnh cuộc họp:</span></strong></span></div>\r\n<div style="text-align: center">\r\n	&nbsp;</div>\r\n<div style="text-align: center">\r\n	<img alt="" src="/public/upload/images/tin_tuc/image001.jpg" style="width: 550px; " /></div>\r\n<div style="text-align: center">\r\n	<span style="font-size: 16px"><em><span style="font-size: 14px"><span style="font-family: Arial">To&agrave;n cảnh buổi l&agrave;m việc</span></span></em></span></div>\r\n<div style="text-align: center">\r\n	&nbsp;</div>\r\n<div style="text-align: center">\r\n	<em><span style="font-size: 14px"><span style="font-family: Arial"><img alt="" src="/public/upload/images/tin_tuc/image003.jpg" style="width: 550px; " /></span></span></em></div>\r\n<div style="text-align: center">\r\n	<em><span style="font-size: 14px"><span style="font-family: Arial">PGS.TS Nguyễn Viết Ngoạn, Hiệu trưởng Trường Đại học S&agrave;i G&ograve;n, ph&aacute;t biểu trong cuộc họp</span></span></em></div>\r\n<div style="text-align: center">\r\n	&nbsp;</div>\r\n<div style="text-align: center">\r\n	<img alt="" src="/public/upload/images/tin_tuc/image005.jpg" style="width: 550px; height: 376px; " /></div>\r\n<div style="text-align: center">\r\n	<em><span style="font-size: 14px"><span style="font-family: Arial">GS.TS. Markus Freiburghaus, Th&agrave;nh vi&ecirc;n Ban Gi&aacute;m đốc Trường Đại học Khoa học Ứng dụng T&acirc;y Bắc Thụy Sĩ, t</span></span></em></div>\r\n<div style="text-align: center">\r\n	<em><span style="font-size: 14px"><span style="font-family: Arial">rao đổi &yacute; kiến với Trường Đại học S&agrave;i G&ograve;n</span></span></em></div>\r\n<div style="text-align: center">\r\n	&nbsp;</div>\r\n<div style="text-align: center">\r\n	<img alt="" src="/public/upload/images/tin_tuc/image007.jpg" style="width: 550px; height: 406px; " /></div>\r\n<div style="text-align: center">\r\n	<em><span style="font-size: 14px"><span style="font-family: Arial">Đại diện 2 trường k&yacute; kết hợp t&aacute;c đ&agrave;o tạo</span></span></em></div>\r\n<div style="text-align: center">\r\n	&nbsp;</div>\r\n<div style="text-align: left">\r\n	&nbsp;</div>\r\n<div style="text-align: right">\r\n	&nbsp;</div>\r\n<div style="text-align: right">\r\n	<em><strong><span style="font-size: 16px"><span style="font-family: Arial">Tin: Như Quỳnh</span></span></strong></em></div>\r\n<div style="text-align: right">\r\n	<em><strong><span style="font-size: 16px"><span style="font-family: Arial">Ảnh: Việt Anh</span></span></strong></em></div>\r\n<p>\r\n	&nbsp;</p>\r\n', '2011-10-20 00:00:00', 131, 0, 'image_2.jpg', 1, 0, 1, 0, NULL),
(7, 'TRƯỜNG ĐẠI HỌC SÀI GÒN TỔ CHỨC  HỘI NGHỊ VỀ CHƯƠNG TRÌNH - GIÁO TRÌNH', 'Ngày 17/05/2012, Phòng Đào tạo phối hợp cùng Phòng Khoa học – Công nghệ Trường Đại học Sài Gòn tổ chức Hội nghị về Chương trình – Giáo trình.', '<p>\r\n	&nbsp;</p>\r\n<p>\r\n	&nbsp;</p>\r\n<table class="contentpaneopen">\r\n	<tbody>\r\n		<tr>\r\n			<td valign="top">\r\n				<p style="text-align: center; ">\r\n					<span style="color: rgb(0, 0, 255); "><strong><span style="font-size: 24px; "><span style="font-family: ''Times New Roman''; ">TRƯỜNG ĐẠI HỌC S&Agrave;I G&Ograve;N TỔ CHỨC</span></span></strong></span></p>\r\n				<div style="text-align: center; ">\r\n					<span style="color: rgb(0, 51, 102); "><strong><span style="font-size: 24px; "><span style="font-family: ''Times New Roman''; ">HỘI NGHỊ VỀ CHƯƠNG TR&Igrave;NH - GI&Aacute;O TR&Igrave;NH</span></span></strong></span></div>\r\n				<div style="text-align: center; ">\r\n					&nbsp;</div>\r\n				<div style="text-align: justify; ">\r\n					&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<span style="font-size: 16px; "><span style="font-family: Arial; ">S&aacute;ng ng&agrave;y 17 th&aacute;ng 05 năm 2012, Ph&ograve;ng Đ&agrave;o tạo phối hợp c&ugrave;ng Ph&ograve;ng Khoa học &ndash; C&ocirc;ng nghệ Trường Đại học S&agrave;i G&ograve;n tổ chức Hội nghị về Chương tr&igrave;nh &ndash; Gi&aacute;o tr&igrave;nh.&nbsp;</span></span></div>\r\n				<div style="text-align: justify; ">\r\n					&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<span style="font-size: 16px; "><span style="font-family: Arial; ">Tham dự Hội nghị c&oacute;: PGS. TS. Nguyễn Viết Ngoạn, B&iacute; thư Đảng uỷ, Hiệu trưởng; c&aacute;c Ph&oacute; Hiệu trưởng: ThS. L&ecirc; Văn Việt; ThS. Ho&agrave;ng Văn Năng; PGS. TS. Nguyễn Khắc H&ugrave;ng; c&ugrave;ng c&aacute;c trưởng, ph&oacute; khoa, ph&ograve;ng, ban, trung t&acirc;m, tổ trưởng bộ m&ocirc;n v&agrave; c&aacute;c tiến sĩ của Trường Đại học S&agrave;i G&ograve;n.&nbsp;</span></span></div>\r\n				<div style="text-align: justify; ">\r\n					&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<span style="font-size: 16px; "><span style="font-family: Arial; ">Mở đầu Hội nghị, PGS. TS. Nguyễn Viết Ngoạn n&ecirc;u mục đ&iacute;ch của việc tổ chức hội nghị v&agrave; mong muốn c&aacute;c đại biểu đ&oacute;ng g&oacute;p &yacute; kiến thiết thực cho việc x&acirc;y dựng chương tr&igrave;nh v&agrave; bi&ecirc;n soạn gi&aacute;o tr&igrave;nh của trường. ThS. Mỵ Giang Sơn, Trưởng ph&ograve;ng Đ&agrave;o tạo b&aacute;o c&aacute;o về việc&nbsp;<em>x&acirc;y dựng v&agrave; ph&aacute;t triển chương tr&igrave;nh đ&agrave;o tạo</em>. PGS. TS. V&otilde; Văn Lộc, Trợ l&iacute; Hiệu trưởng về Khoa học &ndash; C&ocirc;ng nghệ b&aacute;o c&aacute;o về việc&nbsp;<em>X&acirc;y dựng gi&aacute;o tr&igrave;nh gi&aacute;o dục đại học</em>.&nbsp;</span></span></div>\r\n				<div style="text-align: justify; ">\r\n					&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<span style="font-size: 16px; "><span style="font-family: Arial; ">PGS.TS. Nguyễn Khắc H&ugrave;ng ph&aacute;t biểu n&ecirc;u định hướng về việc x&acirc;y dựng chương tr&igrave;nh v&agrave; bi&ecirc;n soạn gi&aacute;o tr&igrave;nh. Tiếp đ&oacute; l&agrave; những ph&aacute;t biểu, tr&igrave;nh b&agrave;y của đại diện l&atilde;nh đạo của c&aacute;c đơn vị: Thư viện &ndash; Văn ph&ograve;ng, Văn ho&aacute; &ndash; Du lịch, &nbsp;Sư phạm Kỹ thuật, Trung t&acirc;m học liệu, Ph&ograve;ng Kế hoạch &ndash; T&agrave;i ch&iacute;nh.</span></span></div>\r\n				<div style="text-align: justify; ">\r\n					&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<span style="font-size: 16px; "><span style="font-family: Arial; ">Đ&acirc;y l&agrave; hội nghị nhằm định hướng cho việc ho&agrave;n thiện chương tr&igrave;nh đ&agrave;o tạo sao cho khoa học, ph&ugrave; hợp. Hội nghị cũng nhằm đi đến việc thống nhất v&agrave; đổi mới thực sự trong việc bi&ecirc;n soạn gi&aacute;o tr&igrave;nh của Trường Đại học S&agrave;i G&ograve;n. Gi&aacute;o tr&igrave;nh phải đảm bảo được t&iacute;nh khoa học, hiện đại, sư phạm để sau đ&oacute;, giảng vi&ecirc;n, sinh vi&ecirc;n c&ugrave;ng chuy&ecirc;n ng&agrave;nh c&oacute; thể sử dụng. Hơn nữa, gi&aacute;o tr&igrave;nh phải xứng với tầm cỡ ph&aacute;t triển của Trường Đại học S&agrave;i G&ograve;n.&nbsp;</span></span></div>\r\n				<div style="text-align: justify; ">\r\n					&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<span style="font-size: 16px; "><span style="font-family: Arial; ">Qua hội nghị, l&atilde;nh đạo c&aacute;c đơn vị cũng đ&atilde; c&oacute; trao đổi về những bất cập của chương tr&igrave;nh v&agrave; gi&aacute;o tr&igrave;nh, mong muốn được l&atilde;nh đạo Nh&agrave; trường c&oacute; hướng dẫn chỉ đạo cụ thể, gi&uacute;p sinh vi&ecirc;n được tiếp cận một c&aacute;ch tốt nhất v&agrave; c&oacute; hiệu quả nhất về chương tr&igrave;nh v&agrave; gi&aacute;o tr&igrave;nh trong thời gian học ở Trường. Thay mặt l&atilde;nh đạo Nh&agrave; trường, Hiệu trưởng đồng &yacute; xem x&eacute;t, th&aacute;o gỡ những kh&oacute; khăn ở một số khoa trong qu&aacute; tr&igrave;nh giảng dạy thực tế.</span></span></div>\r\n				<div style="text-align: justify; ">\r\n					<span style="font-size: 16px; "><span style="font-family: Arial; "><font face="Times New Roman">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</font></span></span><span style="font-family: Arial; font-size: 16px; ">Kết th&uacute;c Hội nghị, PGS. TS Nguyễn Viết Ngoạn nhấn mạnh: bi&ecirc;n soạn v&agrave; sử dụng gi&aacute;o tr&igrave;nh l&agrave; vấn đề cấp thiết m&agrave; Trường Đại học S&agrave;i G&ograve;n chủ trương phải tiến h&agrave;nh, năng động, quyết liệt v&agrave; sẽ đưa v&agrave;o thực hiện cho năm học sau. &nbsp;</span></div>\r\n				<div style="text-align: justify; ">\r\n					&nbsp;</div>\r\n				<p style="text-align: left; ">\r\n					<span style="text-align: justify; ">&nbsp;&nbsp;</span><em style="text-align: justify; "><strong><span style="font-size: 16px; "><span style="font-family: Arial; ">Sau đ&acirc;y l&agrave; một số h&igrave;nh ảnh Hội nghị:</span></span></strong></em><em style="text-align: justify; "><strong><span style="font-size: 16px; "><span style="font-family: Arial; ">&nbsp;</span></span></strong></em></p>\r\n				<div style="text-align: justify; ">\r\n					&nbsp;</div>\r\n				<div style="text-align: center; ">\r\n					<font face="Arial"><img alt="" src="/public/upload/images/tin_tuc/22_5_12_ChuongtrinhGiaotrinh/1.jpg" style="width: 550px; height: 350px; " /></font></div>\r\n				<div style="text-align: center; ">\r\n					<em style="font-size: 16px; "><span style="font-size: 14px; "><span style="font-family: Arial; ">To&agrave;n &nbsp;cảnh hội nghị</span></span></em></div>\r\n				<div style="text-align: center; ">\r\n					<br />\r\n					<em><span style="font-size: 14px; "><span style="font-family: Arial; "><img alt="" src="/public/upload/images/tin_tuc/22_5_12_ChuongtrinhGiaotrinh/2.jpg" style="width: 550px; height: 350px; " /></span></span></em></div>\r\n				<div style="text-align: center; ">\r\n					<em><span style="font-size: 14px; "><span style="font-family: Arial; ">PGS. TS. Nguyễn Viết Ngoạn, Hiệu trưởng, ph&aacute;t biểu khai mạc Hội nghị</span></span></em></div>\r\n				<div style="text-align: center; ">\r\n					&nbsp;</div>\r\n				<div style="text-align: center; ">\r\n					<em><span style="font-size: 14px; "><span style="font-family: Arial; "><img alt="" src="/public/upload/images/tin_tuc/22_5_12_ChuongtrinhGiaotrinh/3.jpg" style="width: 550px; height: 350px; " /></span></span></em></div>\r\n				<div style="text-align: center; ">\r\n					<em><span style="font-size: 14px; "><span style="font-family: Arial; ">&nbsp;</span></span></em><em><span style="font-size: 14px; "><span style="font-family: Arial; ">PGS. TS. Nguyễn Khắc H&ugrave;ng, Ph&oacute; Hiệu trưởng n&ecirc;u định hướng về việc</span></span></em></div>\r\n				<div style="text-align: center; ">\r\n					<em><span style="font-size: 14px; "><span style="font-family: Arial; ">x&acirc;y dựng chương tr&igrave;nh v&agrave; bi&ecirc;n soạn gi&aacute;o tr&igrave;nh.</span></span></em></div>\r\n				<div>\r\n					&nbsp;</div>\r\n				<div style="text-align: center; ">\r\n					&nbsp;</div>\r\n				<div style="text-align: center; ">\r\n					<em><font face="Arial"><span style="font-size: 14px; "><img alt="" src="/public/upload/images/tin_tuc/22_5_12_ChuongtrinhGiaotrinh/4.jpg" style="width: 550px; height: 350px; " /></span></font></em></div>\r\n				<div style="text-align: center; ">\r\n					<em><span style="font-size: 14px; "><span style="font-family: Arial; ">PGS. TS. V&otilde; Văn Lộc b&aacute;o c&aacute;o về việc x&acirc;y dựng gi&aacute;o tr&igrave;nh gi&aacute;o dục đại học</span></span></em></div>\r\n				<div style="text-align: center; ">\r\n					&nbsp;</div>\r\n				<div style="text-align: center; ">\r\n					<em><font face="Arial"><span style="font-size: 14px; "><img alt="" src="/public/upload/images/tin_tuc/22_5_12_ChuongtrinhGiaotrinh/5.jpg" style="width: 550px; height: 350px; " /></span></font></em></div>\r\n				<div style="text-align: center; ">\r\n					<div>\r\n						<em><span style="font-size: 14px; "><span style="font-family: Arial; ">ThS. Mỵ Giang Sơn b&aacute;o c&aacute;o về việc x&acirc;y dựng v&agrave; ph&aacute;t triển&nbsp;</span></span></em></div>\r\n					<div>\r\n						<em><span style="font-size: 14px; "><span style="font-family: Arial; ">chương tr&igrave;nh gi&aacute;o dục đại học.</span></span></em></div>\r\n				</div>\r\n				<div style="text-align: right; ">\r\n					&nbsp;</div>\r\n				<div style="text-align: right; ">\r\n					<strong><em><span style="font-size: 16px; "><span style="font-family: Arial; ">Tin: Thu H&agrave;</span></span></em></strong></div>\r\n				<div style="text-align: right; ">\r\n					<strong><em><span style="font-size: 16px; "><span style="font-family: Arial; ">Ảnh: Th&agrave;nh Huy</span></span></em></strong></div>\r\n				<div style="text-align: right; ">\r\n					&nbsp;</div>\r\n				<div style="text-align: right; ">\r\n					&nbsp;</div>\r\n			</td>\r\n		</tr>\r\n	</tbody>\r\n</table>\r\n<p>\r\n	&nbsp;</p>\r\n', '2012-05-25 01:07:07', 192, 0, '1337882827_4.jpg', 1, 0, 1, 0, NULL),
(8, 'Thông báo mời tham gia Hội thảo Khoa học "Nguyễn Đổng Chi - Nhà văn hoá"', 'Thông báo mời tham gia Hội thảo Khoa học "Nguyễn Đổng Chi - Nhà văn hoá"', '<p style="text-align: center;">\r\n	<img alt="" src="http://www.sgu.edu.vn/images/stories/02014/T10/07/Nguyen%20Dong%20Chi-1.jpg" style="width: 600px; height: 900px;" /></p>\r\n<p style="text-align: center;">\r\n	<img alt="" src="http://www.sgu.edu.vn/images/stories/02014/T10/07/Nguyen%20Dong%20Chi%20-2.jpg" style="width: 600px; height: 759px;" /></p>\r\n<p style="text-align: left;">\r\n	&nbsp; &nbsp; &nbsp; &nbsp; <span style="font-size:28px;"><span style="font-family: &quot;Times New Roman&quot;;">&nbsp; &nbsp;<a href="http://www.sgu.edu.vn/files/02014/T10/07/Phieu%20dang%20ky%20tham%20gia%20Hoi%20thao.doc"><strong>Mời download phiếu tham dự Hội thảo</strong></a></span></span></p>\r\n<p style="text-align: left;">\r\n	&nbsp;</p>\r\n', '2014-10-07 07:44:54', 401, 1, '1412702662_nguyen-dong-chi-1.jpg', 1, 1, 1, 1, NULL),
(9, 'Tuyển sinh Sau Đại học Khoá 14.2 năm 2014 Đại học Sài Gòn', 'Thông tin tuyển sinh Sau Đại học Khoá 14.2 năm 2014', '<h1>\r\n	<span style="font-size:24px;"><span style="font-family: Arial;">&nbsp; &nbsp; &nbsp; &nbsp; <a href="http://www.sgu.edu.vn/files/02014/T10/03/TB_TS_SauDH_2014.pdf">Bấm v&agrave;o đ&acirc;y để xem th&ocirc;ng b&aacute;o</a></span></span></h1>\r\n', '2014-10-07 11:31:00', 1377, 1, '1413454782_cao-hoc-k14.1.JPG', 1, 0, 1, 1, NULL),
(10, 'Thông báo nộp học phí đợt 2 cao học Khoá 21 Đại học Vinh', 'Về việc nộp học phí và kinh phí đào tạo đợt 2 của học viên cao học khoá 21 (2013-2015) tại Trường Đại học Sài Gòn', '<p align="center">\r\n	<strong>TH&Ocirc;NG B&Aacute;O </strong></p>\r\n<p align="center">\r\n	<strong>Về việc nộp học ph&iacute; v&agrave; kinh ph&iacute; đ&agrave;o tạo đợt 2</strong></p>\r\n<p align="center">\r\n	<strong>của học vi&ecirc;n cao học kh&oacute;a 21 (2013-2015)</strong></p>\r\n<p align="center">\r\n	<strong>tại Trường Đại học S&agrave;i G&ograve;n</strong></p>\r\n<p>\r\n	&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</p>\r\n<p>\r\n	&nbsp;</p>\r\n<p>\r\n	&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; Thời gian thu học ph&iacute;:<strong> từ ng&agrave;y ra th&ocirc;ng b&aacute;o đến hết ng&agrave;y 31/10/2014</strong></p>\r\n<p>\r\n	&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; Mức thu (học ph&iacute; v&agrave; kinh ph&iacute; đ&agrave;o tạo) đợt 2:</p>\r\n<p>\r\n	&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; C&aacute;c ng&agrave;nh Khoa học X&atilde; hội: 15.000.000đ/1 học vi&ecirc;n</p>\r\n<p>\r\n	&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; + Học ph&iacute;: &nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; 8.500.000đ/1 học vi&ecirc;n</p>\r\n<p>\r\n	&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; + KP đ&agrave;o tạo xa:&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; 6.500.000đ/1 học vi&ecirc;n</p>\r\n<p>\r\n	&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; C&aacute;c ng&agrave;nh Khoa học Tự nhi&ecirc;n: 15.000.000đ/ 1 học vi&ecirc;n</p>\r\n<p>\r\n	&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; + Học ph&iacute;: &nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; 9.750.000đ/1 học vi&ecirc;n</p>\r\n<p>\r\n	&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; + KP đ&agrave;o tạo xa:&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; 5.250.000đ/1 học vi&ecirc;n</p>\r\n<p>\r\n	&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; Địa điểm thu học ph&iacute;: Quầy thu ng&acirc;n Ph&ograve;ng Kế hoạch &ndash; T&agrave;i ch&iacute;nh Trường Đại học S&agrave;i G&ograve;n.</p>\r\n<p>\r\n	&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; Đề nghị c&aacute;c học vi&ecirc;n c&aacute;c lớp cao học kho&aacute; 21 thực hiện nộp học ph&iacute; v&agrave; kinh ph&iacute; đ&agrave;o tạo đầy đủ theo đ&uacute;ng kế hoạch tr&ecirc;n.</p>\r\n<p>\r\n	<br />\r\n	&nbsp;</p>\r\n', '2014-10-16 07:51:44', 1040, 1, '1413448801_hoc_phi_kinh_phi_dao_tao_dot_2_original.jpg', 1, 0, 1, 1, NULL),
(11, 'Thông báo về việc mời viết bài tham gia Hội thảo Khoa học: “Đổi mới chương trình đào tạo ngành Giáo dục chính trị và Giáo dục công dân”', 'Hiện nay, chương trình đào tạo ngành Giáo dục chính trị và ngành Giáo dục công dân ở các trường đại học và cao đẳng đã có nhiều đổi mới. Tuy nhiên, vấn đề đổi mới này vẫn đang được tranh luận với nhiều luồng ý kiến khác nhau. Hơn nữa, năm 2013, Hội Nghị lần thứ 8 Ban Chấp hành Trung ương Đảng Cộng sản Việt Nam khoá XI quyết định “Đổi mới căn bản, toàn diện giáo dục và đào tạo”. Theo đó, các ngành đào tạo đại học và cao đẳng phải đổi mới mạnh mẽ “căn bản, toàn diện” để đáp ứng yêu cầu ngày càng cao của công cuộc xây dựng đất nước. Xuất phát từ thực tế đó, Trường  Đại học Sài Gòn tổ chức Hội thảo khoa học “Đổi mới Chương trình đào tạo ngành Giáo dục chính trị và Giáo dục công dân”.', '<p>\r\n	Hiện nay, chương tr&igrave;nh đ&agrave;o tạo ng&agrave;nh Gi&aacute;o dục ch&iacute;nh trị v&agrave; ng&agrave;nh Gi&aacute;o dục c&ocirc;ng d&acirc;n ở c&aacute;c trường đại học v&agrave; cao đẳng đ&atilde; c&oacute; nhiều đổi mới. Tuy nhi&ecirc;n, vấn đề đổi mới n&agrave;y vẫn đang được tranh luận với nhiều luồng &yacute; kiến kh&aacute;c nhau. Hơn nữa, năm 2013, Hội Nghị lần thứ 8 Ban Chấp h&agrave;nh Trung ương Đảng Cộng sản Việt Nam kho&aacute; XI quyết định &ldquo;Đổi mới căn bản, to&agrave;n diện gi&aacute;o dục v&agrave; đ&agrave;o tạo&rdquo;. Theo đ&oacute;, c&aacute;c ng&agrave;nh đ&agrave;o tạo đại học v&agrave; cao đẳng phải đổi mới mạnh mẽ &ldquo;căn bản, to&agrave;n diện&rdquo; để đ&aacute;p ứng y&ecirc;u cầu ng&agrave;y c&agrave;ng cao của c&ocirc;ng cuộc x&acirc;y dựng đất nước. Xuất ph&aacute;t từ thực tế đ&oacute;, Trường &nbsp;Đại học S&agrave;i G&ograve;n tổ chức Hội thảo khoa học &ldquo;Đổi mới Chương tr&igrave;nh đ&agrave;o tạo ng&agrave;nh Gi&aacute;o dục ch&iacute;nh trị v&agrave; Gi&aacute;o dục c&ocirc;ng d&acirc;n&rdquo;.&nbsp;</p>\r\n<div>\r\n	&nbsp;</div>\r\n<div>\r\n	<strong>&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;&nbsp;1. Mục đ&iacute;ch Hội thảo</strong></div>\r\n<div>\r\n	&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;&nbsp;Luận b&agrave;n, trao đổi về chương tr&igrave;nh gi&aacute;o dục ch&iacute;nh trị l&iacute; tưởng (ở c&aacute;c cấp độ kh&aacute;c nhau), chương tr&igrave;nh hiện nay, về việc tổ chức thực tập, kiến tập của sinh vi&ecirc;n, hoạt động kiểm tra, đ&aacute;nh gi&aacute; chất lượng học tập v&agrave; c&aacute;c thay đổi căn bản cần được tiến h&agrave;nh, c&aacute;c m&ocirc;n học cần được lược bỏ, bổ sung hoặc thay đổi t&iacute;nh chất,&hellip; nhằm tiến đến chỉnh l&iacute; v&agrave; x&acirc;y dựng một chương tr&igrave;nh đ&agrave;o tạo chuy&ecirc;n ng&agrave;nh Gi&aacute;o dục ch&iacute;nh trị mới đ&aacute;p ứng y&ecirc;u cầu &ldquo;Đổi mới căn bản, to&agrave;n diện gi&aacute;o dục v&agrave; đ&agrave;o tạo&rdquo; hiện nay.</div>\r\n<div>\r\n	&nbsp;</div>\r\n<div>\r\n	<strong>&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;&nbsp;2. Chủ đề hội thảo</strong></div>\r\n<div>\r\n	&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;&nbsp;<strong>&nbsp; &nbsp; &nbsp;&ldquo;Đổi mới chương tr&igrave;nh đ&agrave;o tạo ng&agrave;nh Gi&aacute;o dục ch&iacute;nh trị v&agrave; Gi&aacute;o dục c&ocirc;ng d&acirc;n&rdquo;&nbsp;</strong></div>\r\n<div>\r\n	&nbsp;</div>\r\n<div>\r\n	<strong>&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;&nbsp;3. C&aacute;c nội dung ch&iacute;nh của Hội thảo</strong></div>\r\n<div>\r\n	&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;&nbsp;Hội thảo tập trung v&agrave;o c&aacute;c nội dung ch&iacute;nh sau:</div>\r\n<div>\r\n	&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;&nbsp;1. Đ&aacute;nh gi&aacute;, g&oacute;p &yacute; về chương tr&igrave;nh đ&agrave;o tạo ng&agrave;nh Gi&aacute;o dục ch&iacute;nh trị v&agrave; Gi&aacute;o dục c&ocirc;ng d&acirc;n v&agrave; ở c&aacute;c trường đại học v&agrave; cao đẳng hiện nay.</div>\r\n<div>\r\n	&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;&nbsp;- Ưu điểm v&agrave; nhược điểm của chương tr&igrave;nh đ&agrave;o tạo ng&agrave;nh Gi&aacute;o dục ch&iacute;nh trị v&agrave; Gi&aacute;o dục c&ocirc;ng d&acirc;n của c&aacute;c trường đại học, cao đẳng</div>\r\n<div>\r\n	&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;&nbsp;- Những kinh nghiệm v&agrave; b&agrave;i học từ việc triển khai đ&agrave;o tạo chuy&ecirc;n ng&agrave;nh Gi&aacute;o dục ch&iacute;nh trị v&agrave; Gi&aacute;o dục c&ocirc;ng d&acirc;n trong thời gian qua</div>\r\n<div>\r\n	&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;&nbsp;2. X&acirc;y dựng chương tr&igrave;nh mới c&aacute;c ng&agrave;nh Gi&aacute;o dục ch&iacute;nh trị v&agrave; Gi&aacute;o dục C&ocirc;ng d&acirc;n đ&aacute;p ứng y&ecirc;u cầu của Nghị Quyết VIII BCH TƯ Đảng.</div>\r\n<div>\r\n	&nbsp;</div>\r\n<div>\r\n	&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;&nbsp;- Y&ecirc;u cầu của x&atilde; hội đối với cử nh&acirc;n c&aacute;c ng&agrave;nh Gi&aacute;o dục Ch&iacute;nh trị, Gi&aacute;o dục&nbsp;c&ocirc;ng d&acirc;n</div>\r\n<div>\r\n	&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;&nbsp;- Mục đ&iacute;ch đ&agrave;o tạo, chuẩn đầu ra của c&aacute;c ng&agrave;nh Gi&aacute;o dục ch&iacute;nh trị v&agrave; Gi&aacute;o dục c&ocirc;ng d&acirc;n</div>\r\n<div>\r\n	&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;&nbsp;- Thời lượng v&agrave; nội dung chương tr&igrave;nh; hoạt động kiến tập, thực tập của sinh vi&ecirc;n</div>\r\n<div>\r\n	&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;&nbsp;- Kiểm tra, đ&aacute;nh gi&aacute; chất lượng học tập v&agrave; vấn đề t&agrave;i liệu tham khảo cho sinh vi&ecirc;n</div>\r\n<div>\r\n	&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;&nbsp;- &nbsp;&nbsp;C&aacute;c kiến nghị, đề xuất sửa đổi, bổ sung v&agrave; ho&agrave;n thiện chương tr&igrave;nh theo tinh thần của Nghị quyết Hội Nghị lần thứ VIII Ban Chấp h&agrave;nh Trung ương Đảng Cộng sản Việt Nam kho&aacute; XI.</div>\r\n<div>\r\n	&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;&nbsp;- Một số vấn đề kh&aacute;c li&ecirc;n quan đến chủ đề của hội thảo.</div>\r\n<div>\r\n	&nbsp;</div>\r\n<div>\r\n	<strong>&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;&nbsp;4. Đối tượng tham dự</strong></div>\r\n<div>\r\n	&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;&nbsp;C&aacute;c nh&agrave; khoa học, giảng vi&ecirc;n, c&aacute;n bộ Trường Đại học S&agrave;i G&ograve;n v&agrave; c&aacute;c trường bạn: Trường Đại học Sư phạm TP. Hồ Ch&iacute; Minh, Trường Đại học KHXH&amp;NV - ĐHQG TP. Hồ Ch&iacute; Minh, Trường Đại học Đồng Th&aacute;p, Trường Đại học Cần Thơ, Trường Đại học An Giang, Trường Đại học Sư phạm - Đại học Huế,&hellip;&nbsp;</div>\r\n<div>\r\n	&nbsp;</div>\r\n<div>\r\n	<strong>&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;&nbsp;5. Thời gian v&agrave; địa điểm tổ chức Hội thảo</strong></div>\r\n<div>\r\n	&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;&nbsp;- Thời hạn đăng k&iacute; đề t&agrave;i v&agrave; gửi t&oacute;m tắt b&aacute;o c&aacute;o: <strong>10/</strong><strong>08/2014</strong> (theo mẫu v&agrave; gửi qua email: <a href="mailto:k_gdct@sgu.edu.vn">k_gdct@sgu.edu.vn</a> ).</div>\r\n<div>\r\n	&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;&nbsp;- Thời hạn nộp tham luận: <strong>10/</strong><strong>10/2014</strong> (xin gửi qua email)</div>\r\n<div>\r\n	&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;&nbsp;- Thời gian tổ chức Hội thảo: Thứ s&aacute;u, ng&agrave;y 30 th&aacute;ng 10 năm 2014.</div>\r\n<div>\r\n	&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;&nbsp;- Địa điểm: Trường Đại học S&agrave;i G&ograve;n &ndash; 273 An Dương Vương, P.3, Q.5,&nbsp;Th&agrave;nh phố Hồ Ch&iacute; Minh.</div>\r\n<div>\r\n	&nbsp;</div>\r\n<div>\r\n	<strong>&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;&nbsp;6. Quy c&aacute;ch văn bản</strong></div>\r\n<div>\r\n	&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;&nbsp;- Sử dụng m&atilde; chữ Unicode, font: Times New Roman, cỡ chữ 13.&nbsp;</div>\r\n<div>\r\n	&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;&nbsp;- C&aacute;ch d&ograve;ng đơn, chừa lề tự động, d&agrave;i kh&ocirc;ng qu&aacute; 10 trang.</div>\r\n<div>\r\n	&nbsp;</div>\r\n<div>\r\n	<strong>&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;&nbsp;7. Địa chỉ li&ecirc;n hệ&nbsp;</strong></div>\r\n<div>\r\n	&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;&nbsp;- Ph&ograve;ng Quản l&yacute; Khoa học v&agrave; Sau đại học - Trường Đại học S&agrave;i G&ograve;n,&nbsp;273 An Dương Vương, Quận 5, TP. Hồ Ch&iacute; Minh -ĐT: 08 38354271</div>\r\n<div>\r\n	&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;&nbsp;- Khoa Gi&aacute;o dục ch&iacute;nh trị - Trường Đại học S&agrave;i G&ograve;n./.</div>\r\n<div>\r\n	&nbsp;</div>\r\n<div>\r\n	<strong>&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;KT.HIỆU TRƯỞNG</strong></div>\r\n<div>\r\n	<p>\r\n		&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;<strong>PH&Oacute;</strong> <strong>HIỆU TRƯỞNG</strong></p>\r\n	<p style="text-align: center;">\r\n		&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; (Đ&atilde; k&yacute;)</p>\r\n</div>\r\n<div>\r\n	&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; <strong>PGS.TS. Phạm Ho&agrave;ng Qu&acirc;n</strong></div>\r\n', '2014-10-21 03:05:05', 226, 1, NULL, 1, 0, 1, 0, NULL),
(12, 'Nghiên cứu Khoa học cấp trường', 'Bảo vệ đề tài NCKH cấp trường "Khảo sát xây dựng hệ thống kỹ năng trong đào tạo nghiệp vụ du lịch của Khoa Văn hóa - Du lịch"; Chủ nhiệm đề tài: TS. Phạm Thị Thu Nga; Mã số đề tài: CS2012 – 30', '<p>\r\n	&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; Bảo vệ đề t&agrave;i NCKH cấp trường &quot;Khảo s&aacute;t x&acirc;y dựng hệ thống kỹ năng trong đ&agrave;o tạo nghiệp vụ du lịch của Khoa Văn h&oacute;a - Du lịch&quot;; Chủ nhiệm đề t&agrave;i: TS. Phạm Thị Thu Nga; M&atilde; số đề t&agrave;i: CS2012 &ndash; 30.</p>\r\n<p>\r\n	&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; Thời gian: 09g00, ng&agrave;y 22/10/2014.</p>\r\n<p>\r\n	&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; Địa điểm: Ph&ograve;ng E-learning, Trung t&acirc;m Học liệu, Trường Đại học S&agrave;i G&ograve;n</p>\r\n<p>\r\n	&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; Sau đ&acirc;y l&agrave; một số h&igrave;nh ảnh của buổi vệ:</p>\r\n<p align="center">\r\n	<img alt="" src="/public/upload/images/image%281%29.jpeg" style="width: 600px; height: 448px;" /></p>\r\n<p align="center">\r\n	<img alt="" src="/public/upload/images/image.jpeg" style="width: 600px; height: 448px;" /></p>\r\n<p align="center">\r\n	&nbsp;</p>\r\n', '2014-10-23 07:24:57', 245, 1, '1414049097_hinh-bao-ve.jpg', 1, 0, 1, 1, NULL),
(13, 'Nghiên cứu Khoa học cấp trường', 'Bảo vệ đề tài NCKH cấp trường "Nghiên cứu xử lý rơm rạ trên đồng ruộng bằng một số chế phẩm sinh học"; Chủ nhiệm đề tài: ThS. Nguyễn Xuân Dũ; Mã số đề tài: CS2013 – 34.', '<p>\r\n	Bảo vệ đề t&agrave;i NCKH cấp trường &quot;Nghi&ecirc;n cứu xử l&yacute; rơm rạ tr&ecirc;n đồng ruộng bằng một số chế phẩm sinh học&quot;; Chủ nhiệm đề t&agrave;i: ThS. Nguyễn Xu&acirc;n Dũ; M&atilde; số đề t&agrave;i: CS2013 &ndash; 34.</p>\r\n<p>\r\n	&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; Thời gian: 15g00, ng&agrave;y 22/10/2014.</p>\r\n<p>\r\n	&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; Địa điểm: Ph&ograve;ng E-learning, Trung t&acirc;m Học liệu, Trường Đại học S&agrave;i G&ograve;n</p>\r\n<p>\r\n	&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; Sau đ&acirc;y l&agrave; một số h&igrave;nh ảnh của buổi vệ:</p>\r\n<p style="text-align: center;">\r\n	<img alt="" src="/public/upload/images/20141022_15010528.jpg" style="width: 600px; height: 450px;" /></p>\r\n<p style="text-align: center;">\r\n	<img alt="" src="/public/upload/images/20141022_152532790.jpg" style="width: 600px; height: 450px;" /></p>\r\n', '2014-10-23 07:28:15', 312, 1, '1414049295_20141022_15010528.jpg', 1, 0, 1, 1, NULL),
(14, 'Thông báo cung cấp thông tin khoa học cá nhân', '', '<p>\r\n	<img alt="" src="/public/upload/images/001(3).jpg" style="width: 700px; height: 964px;" /></p>\r\n', '2015-01-15 09:18:19', 231, 1, '1421313497_001.jpg', 1, 0, 1, 1, NULL),
(15, 'Quy định về định mức kinh phí nghiên cứu khoa học; biên soạn giáo trình; khen thưởng CBGV đat học vị, học hàm và có công trình khoa học', '', '<p>\r\n	<img alt="" src="/public/upload/images/Scan%20228.jpg" style="width: 700px; height: 997px;" /></p>\r\n<p>\r\n	<img alt="" src="/public/upload/images/Scan%20229.jpg" style="width: 700px; height: 902px;" /></p>\r\n<p>\r\n	<img alt="" src="/public/upload/images/Scan%20230.jpg" style="width: 700px; height: 963px;" /></p>\r\n<p>\r\n	<img alt="" src="/public/upload/images/Scan%20231.jpg" style="width: 700px; height: 968px;" /></p>\r\n', '2015-01-16 09:07:35', 365, 1, '1421399254_scan-228.jpg', 1, 0, 1, 1, NULL),
(16, 'Thông báo về việc thưởng kinh phí đề tài NCKH cấp trường (Đợt 1 năm 2015)', '', '<p>\r\n	<img alt="" src="/public/upload/images/001(4).jpg" style="width: 700px; height: 964px;" /></p>\r\n<p>\r\n	<img alt="" src="/public/upload/images/002(2).jpg" style="width: 700px; height: 508px;" /></p>\r\n<p>\r\n	<img alt="" src="/public/upload/images/003(2).jpg" style="width: 700px; height: 508px;" /></p>\r\n<p>\r\n	<img alt="" src="/public/upload/images/004(2).jpg" style="width: 700px; height: 508px;" /></p>\r\n', '2015-01-19 08:58:15', 353, 1, '1421657892_001.jpg', 1, 0, 1, 1, NULL),
(17, 'Thông báo về việc nhận đăng ký nhiệm vụ NCKH năm học 2015-2016', '', '<p>\r\n	<img alt="" src="/public/upload/images/001(5).jpg" style="width: 700px; height: 964px;" /></p>\r\n', '2015-01-20 03:44:35', 301, 1, '1421725473_001.jpg', 1, 0, 1, 1, NULL),
(18, 'DANH SÁCH TÁC GIẢ/ĐỒNG TÁC GIẢ ĐƯỢC THƯỞNG CÔNG TRÌNH KHOA HỌC ĐỢT  4', '', '<p>\r\n	<a href="http://qlkh-sdh.sgu.edu.vn/public/upload/files/Danh%20s%C3%A1ch%20b%C3%A0i%20b%C3%A1o%20%C4%91%E1%BB%A3t%204.pdf" style="padding: 0px; margin: 0px; border-color: rgb(234, 234, 234); font-family: Tahoma, Arial, Helvetica, sans-serif; text-decoration: none; color: rgb(128, 153, 168); font-size: 26px;">Bấm v&agrave;o đ&acirc;y để tải danh s&aacute;ch</a></p>\r\n', '2015-01-23 01:10:08', 409, 1, NULL, 1, 0, 1, 1, NULL),
(19, 'Thông báo mời tham gia Hội thảo khoa học "40 NĂM ĐẠI THẮNG MÙA XUÂN (30/04/1975) - NHÌN TỪ GÓC ĐỘ LỊCH SỬ, VĂN HOÁ"', '', '<p>\r\n	<span style="font-size:26px;"><a href="/public/upload/files/Thong%20bao%20tham%20gia%20Hoi%20thao%2040%20nam%20dai%20thang%20mua%20xuan.pdf">Bấm v&agrave;o đ&acirc;y để tải th&ocirc;ng b&aacute;o</a></span></p>\r\n', '2015-02-27 03:00:59', 297, 1, '1425006095_001.jpg', 1, 0, 1, 1, '1425006059_thong-bao-tham-gia-hoi-thao-40-nam-dai-thang-mua-xuan.pdf'),
(20, 'Thông báo Hội nghị Khoa học quốc gia lần thứ VIII "Nghiên cứu cơ bản và ứng dụng Công nghệ thông tin"', '', '<p>\r\n	<span style="padding: 0px; margin: 0px; border-color: rgb(234, 234, 234); font-family: tahoma, arial, verdana, sans-serif; font-size: 13px; line-height: 19.5px; color: rgb(0, 0, 0);"><span style="padding: 0px; margin: 0px; border-color: rgb(234, 234, 234); font-size: 16px;"><span style="padding: 0px; margin: 0px; border-color: rgb(234, 234, 234); font-family: ''times new roman'', times, serif;">Nhằm g&oacute;p phần th&uacute;c đẩy nghi&ecirc;n cứu cơ bản v&agrave; ứng dụng về C&ocirc;ng nghệ th&ocirc;ng tin tại Việt Nam, Li&ecirc;n hiệp c&aacute;c Hội Khoa học v&agrave; Kỹ thuật Việt&nbsp; Nam, Đại học Quốc gia H&agrave; Nội c&ugrave;ng phối hợp với c&aacute;c cơ quan khoa học, c&aacute;c nh&agrave; khoa học từ c&aacute;c viện nghi&ecirc;n cứu, c&aacute;c trường đại học tổ chức Hội nghị quốc gia lần thứ VIII &quot;Nghi&ecirc;n cứu cơ bản v&agrave; ứng dụng C&ocirc;ng nghệ th&ocirc;ng tin&quot;.&nbsp;</span></span></span><span style="padding: 0px; margin: 0px; border-color: rgb(234, 234, 234); font-family: ''times new roman'', times, serif; line-height: 19.5px; font-size: 16px; color: rgb(0, 0, 0);">T&ecirc;n hội nghị được gọi tắt l&agrave; FAIR - Fundamental and Applied IT Research. Mọi th&ocirc;ng tin xin li&ecirc;n hệ website ch&iacute;nh thức của Hội nghị:&nbsp;</span><span style="padding: 0px; margin: 0px; border-color: rgb(234, 234, 234); text-decoration: none; color: rgb(0, 0, 0); font-size: 13px; line-height: 19.5px;"><span style="padding: 0px; margin: 0px; border-color: rgb(234, 234, 234); font-size: 12px;"><a href="http://fair.conf.vn/2015/" style="font-family: Tahoma, Arial, Helvetica, sans-serif; padding: 0px; margin: 0px; border-color: rgb(234, 234, 234); text-decoration: none; color: rgb(128, 153, 168); font-size: 13px; line-height: 19.5px;">http://fair.conf.vn/2015/</a><font face="times new roman, times, serif">&nbsp;</font></span></span></p>\r\n<p>\r\n	<span style="font-size:16px;"><span style="font-family:times new roman,times,serif;"><span style="padding: 0px; margin: 0px; border-color: rgb(234, 234, 234); text-decoration: none; line-height: 19.5px;"><span style="padding: 0px; margin: 0px; border-color: rgb(234, 234, 234);">H&agrave; Nội 9-10/07/2015</span></span></span></span></p>\r\n', '2015-03-16 08:24:58', 100, 1, NULL, 1, 0, 1, 0, NULL),
(21, 'Thông báo số 1: Hội thảo KH Cán bộ trẻ các trường ĐHSP toàn quốc lần thứ V - năm 2015 tại Trường Đại học Sư phạm Hà Nội 2', '', '<p style="padding: 0px; margin: 0.5em 0px; border-color: rgb(234, 234, 234); font-family: ''Times New Roman'', Georgia, Times, serif; font-size: 14px; color: rgb(85, 85, 85);">\r\n	<span style="padding: 0px; margin: 0px; border-color: rgb(234, 234, 234); font-family: Arial; font-size: 12.7272720336914px; text-align: justify; line-height: 19.0909080505371px; color: rgb(0, 0, 0);">Nối tiếp th&agrave;nh c&ocirc;ng của&nbsp;Hội thảo Khoa học C&aacute;n bộ trẻ c&aacute;c trường Đại học Sư phạm to&agrave;n quốc lần thứ IV, Trường Đại học Sư phạm H&agrave; Nội 2 tiến h&agrave;nh đăng cai tổ chức&nbsp;</span><span style="padding: 0px; margin: 0px; border-color: rgb(234, 234, 234); font-family: Arial; font-size: 12.7272720336914px; text-align: justify; line-height: 19.0909080505371px; color: rgb(0, 0, 0);">&nbsp;Hội thảo Khoa học C&aacute;n bộ trẻ c&aacute;c trường&nbsp;<span style="padding: 0px; margin: 0px; border-color: rgb(234, 234, 234); font-family: tahoma, arial, verdana, sans-serif; font-size: 12.7272720336914px; line-height: 19.0909080505371px;">Đại học Sư phạm</span>&nbsp;to&agrave;n quốc lần thứ V - 2015 với mục đ&iacute;ch: Hội thảo l&agrave; diễn đ&agrave;n để c&aacute;c nh&agrave; khoa học, nghi&ecirc;n cứu, giảng vi&ecirc;n trẻ của c&aacute;c trường&nbsp;<span style="padding: 0px; margin: 0px; border-color: rgb(234, 234, 234); font-family: tahoma, arial, verdana, sans-serif; font-size: 12.7272720336914px; line-height: 19.0909080505371px;">Đại học Sư phạm</span>, c&aacute;c trường c&oacute; đ&agrave;o tạo sư phạm tr&ecirc;n to&agrave;n quốc c&ocirc;ng bố v&agrave; trao đổi c&aacute;c kết quả nghi&ecirc;n cứu mới, xu hướng KHCN trong tương lai....</span></p>\r\n<p style="padding: 0px; margin: 0.5em 0px; border-color: rgb(234, 234, 234); font-family: ''Times New Roman'', Georgia, Times, serif; font-size: 14px; color: rgb(85, 85, 85);">\r\n	<strong style="padding: 0px; margin: 0px; border-color: rgb(234, 234, 234); font-family: Arial; color: rgb(0, 0, 0); font-size: 12.7272720336914px; line-height: 19.0909080505371px; text-align: justify;">Th&agrave;nh phần tham dự:</strong><span style="padding: 0px; margin: 0px; border-color: rgb(234, 234, 234); font-family: Arial; color: rgb(0, 0, 0); font-size: 12.7272720336914px; line-height: 19.0909080505371px; text-align: justify;">&nbsp;C&aacute;c c&aacute;n bộ, giảng vi&ecirc;n trẻ c&oacute; tuổi kh&ocirc;ng qu&aacute; 35.</span></p>\r\n<p style="padding: 0px; margin: 0.5em 0px; border-color: rgb(234, 234, 234); font-family: ''Times New Roman'', Georgia, Times, serif; font-size: 14px; color: rgb(85, 85, 85);">\r\n	<span style="padding: 0px; margin: 0px; border-color: rgb(234, 234, 234); font-family: Arial; color: rgb(0, 0, 0); font-size: 12.7272720336914px; line-height: 19.0909080505371px; text-align: justify;"><strong style="padding: 0px; margin: 0px; border-color: rgb(234, 234, 234); font-family: tahoma, arial, verdana, sans-serif;">Chi ttiết th&ocirc;ng tin về hội thảo:</strong>&nbsp;Vui l&ograve;ng xem&nbsp;<a href="http://qlkh-sdh.sgu.edu.vn/public/upload/files/thong%20bao%20Hoi%20thao.pdf" style="padding: 0px; margin: 0px; border-color: rgb(234, 234, 234); font-family: Tahoma, Arial, Helvetica, sans-serif; text-decoration: none; color: rgb(128, 153, 168); font-size: inherit;">file đ&iacute;nh k&egrave;m</a>.</span></p>\r\n', '2015-03-19 09:45:57', 133, 1, '1426758356_scan0001.jpg', 1, 0, 1, 0, NULL);
INSERT INTO `tin_tuc` (`id`, `tieu_de`, `mo_ta_tom_tat`, `mo_ta_chi_tiet`, `ngay_tao`, `so_lan_xem`, `trang_thai`, `file`, `ma_quan_tri`, `quan_trong`, `search`, `noi_bat`, `file_pdf`) VALUES
(22, 'Thông báo lần 2 về việc tổ chức và mời viết bài Hội thảo khoa học quốc tế thường niên lần thứ 32 của Hiệp hội kinh doanh Pan-Pacific', '', '<p style="padding: 0px; margin: 0.5em 0px; border-color: rgb(234, 234, 234); font-family: ''Times New Roman'', Georgia, Times, serif; font-size: 14px; color: rgb(85, 85, 85);">\r\n	<span style="padding: 0px; margin: 0px; border-color: rgb(234, 234, 234); font-family: tahoma, arial, verdana, sans-serif; font-size: 16px;"><span style="padding: 0px; margin: 0px; border-color: rgb(234, 234, 234);">Hiệp hội Kinh doanh Ch&acirc;u &Aacute; - Th&aacute;i B&igrave;nh Dương (Pan Pacific Business Association) sẽ phối hợp với Trường Đại học Kinh tế Quốc d&acirc;n tổ chức Hội thảo quốc tế thường ni&ecirc;n Pan-Pacific lần thứ 32 tại H&agrave; Nội với chủ đề &quot;Đổi mới doanh nghiệp trong thời đại kỹ thuật số&quot;.&nbsp;</span></span></p>\r\n<p style="padding: 0px; margin: 0.5em 0px; border-color: rgb(234, 234, 234); font-family: ''Times New Roman'', Georgia, Times, serif; font-size: 14px; color: rgb(85, 85, 85);">\r\n	<span style="padding: 0px; margin: 0px; border-color: rgb(234, 234, 234); font-family: tahoma, arial, verdana, sans-serif; font-size: 16px;"><span style="padding: 0px; margin: 0px; border-color: rgb(234, 234, 234);"><strong style="padding: 0px; margin: 0px; border-color: rgb(234, 234, 234); font-family: tahoma, arial, verdana, sans-serif;">Thời gian:</strong>&nbsp;Từ ng&agrave;y 01/06/2015 đến 04/06/2015</span></span></p>\r\n<p style="padding: 0px; margin: 0.5em 0px; border-color: rgb(234, 234, 234); font-family: ''Times New Roman'', Georgia, Times, serif; font-size: 14px; color: rgb(85, 85, 85);">\r\n	<span style="padding: 0px; margin: 0px; border-color: rgb(234, 234, 234); font-family: tahoma, arial, verdana, sans-serif; font-size: 16px;"><span style="padding: 0px; margin: 0px; border-color: rgb(234, 234, 234);"><strong style="padding: 0px; margin: 0px; border-color: rgb(234, 234, 234); font-family: tahoma, arial, verdana, sans-serif;">Địa điểm:</strong>&nbsp;Kh&aacute;ch sạn Melia H&agrave; Nội</span></span></p>\r\n<p style="padding: 0px; margin: 0.5em 0px; border-color: rgb(234, 234, 234); font-family: ''Times New Roman'', Georgia, Times, serif; font-size: 14px; color: rgb(85, 85, 85);">\r\n	<span style="padding: 0px; margin: 0px; border-color: rgb(234, 234, 234); font-family: tahoma, arial, verdana, sans-serif; font-size: 16px;"><span style="padding: 0px; margin: 0px; border-color: rgb(234, 234, 234);"><strong style="padding: 0px; margin: 0px; border-color: rgb(234, 234, 234); font-family: tahoma, arial, verdana, sans-serif;">Th&agrave;nh phần tham dự:</strong>&nbsp;Gồm c&aacute;c nh&agrave; khoa học, nh&agrave; hoạch định ch&iacute;nh s&aacute;ch, l&atilde;nh đạo doanh nghiệp, giảng vi&ecirc;n v&agrave; nghi&ecirc;n cứu sinh đến từ c&aacute;c quốc gia như Mỹ, H&agrave;n Quốc, Trung Quốc, Việt Nam... v&agrave; c&aacute;c học vi&ecirc;n nghi&ecirc;n cứu sinh quan t&acirc;m viết b&agrave;i tham dự Hội thảo.</span></span></p>\r\n<p style="padding: 0px; margin: 0.5em 0px; border-color: rgb(234, 234, 234); font-family: ''Times New Roman'', Georgia, Times, serif; font-size: 14px; color: rgb(85, 85, 85);">\r\n	<span style="padding: 0px; margin: 0px; border-color: rgb(234, 234, 234); font-family: tahoma, arial, verdana, sans-serif; font-size: 16px;"><span style="padding: 0px; margin: 0px; border-color: rgb(234, 234, 234);"><strong style="padding: 0px; margin: 0px; border-color: rgb(234, 234, 234); font-family: tahoma, arial, verdana, sans-serif;">Chi tiết th&ocirc;ng tin về Hội thảo:&nbsp;</strong>Vui l&ograve;ng xem&nbsp;<a href="http://qlkh-sdh.sgu.edu.vn/public/upload/files/Thong%20bao%20Pan-Pacific.pdf" style="padding: 0px; margin: 0px; border-color: rgb(234, 234, 234); font-family: Tahoma, Arial, Helvetica, sans-serif; text-decoration: none; color: rgb(128, 153, 168); font-size: inherit;">file đ&iacute;nh k&egrave;m</a></span></span></p>\r\n', '2015-03-26 09:07:12', 172, 1, NULL, 1, 0, 1, 1, NULL),
(23, 'Thông báo viết tham luận Hội thảo Khoa học "Tín dụng đen tại TP. Hồ Chí Minh - Thực trạng và giải pháp"', '', '<p style="padding: 0px; margin: 0.5em 0px; border-color: rgb(234, 234, 234); font-family: ''Times New Roman'', Georgia, Times, serif; font-size: 14px; color: rgb(85, 85, 85);">\r\n	<span style="padding: 0px; margin: 0px; border-color: rgb(234, 234, 234); font-family: tahoma, arial, verdana, sans-serif; font-size: 16px;"><span style="padding: 0px; margin: 0px; border-color: rgb(234, 234, 234); font-family: ''times new roman'', times, serif;">Thực hiện nhiệm vụ Nghi&ecirc;n cứu khoa học năm 2015, trong khu&ocirc;n khổ đề t&agrave;i cấp Sở Khoa học C&ocirc;ng nghệ TP.HCM: &quot;T&iacute;n dụng đen tại TP. Hồ Ch&iacute; Minh - Thực trạng v&agrave; giải ph&aacute;p&quot; do Viện Khoa học X&atilde; hội V&ugrave;ng Nam bộ l&agrave; cơ quan chủ tr&igrave;, Hội thảo với chủ đề &quot;hoạt động Ng&acirc;n h&agrave;ng ch&iacute;nh thức v&agrave; phi ch&iacute;nh thức tại TP.HCM&quot; dự kiến sẽ được tổ chức tại Hội trường Viện KHXH v&ugrave;ng Nam bộ.</span></span></p>\r\n<p style="padding: 0px; margin: 0.5em 0px; border-color: rgb(234, 234, 234); font-family: ''Times New Roman'', Georgia, Times, serif; font-size: 14px; color: rgb(85, 85, 85);">\r\n	<span style="padding: 0px; margin: 0px; border-color: rgb(234, 234, 234); font-family: tahoma, arial, verdana, sans-serif; font-size: 16px;"><span style="padding: 0px; margin: 0px; border-color: rgb(234, 234, 234); font-family: ''times new roman'', times, serif;">K&iacute;nh mời c&aacute;c thầy c&ocirc;, giảng vi&ecirc;n quan t&acirc;m viết b&agrave;i tham dự, mọi th&ocirc;ng tin về viết b&agrave;i tham dự Hội thảo&nbsp;<a href="http://qlkh-sdh.sgu.edu.vn/public/upload/files/Hoi%20thao%20khoa%20hoc%20Tin%20dung%20den.pdf" style="padding: 0px; margin: 0px; border-color: rgb(234, 234, 234); font-family: Tahoma, Arial, Helvetica, sans-serif; text-decoration: none; color: rgb(128, 153, 168); font-size: inherit;">tải về tại đ&acirc;y</a>.</span></span></p>\r\n', '2015-04-20 08:53:22', 69, 1, '1429520000_001.jpg', 1, 0, 1, 1, NULL),
(24, 'Thông báo viết bài Hội thảo khoa học "Quản lý nhà nước về hội nhập quốc tế trong lĩnh vực khoa học và công nghệ ở Việt Nam - Thực trạng và giải pháp"', '', '<p style="padding: 0px; margin: 0.5em 0px; border-color: rgb(234, 234, 234); font-family: ''Times New Roman'', Georgia, Times, serif; font-size: 14px; color: rgb(85, 85, 85);">\r\n	<span style="font-size:16px;"><span style="font-family:times new roman,times,serif;">Học viện H&agrave;nh ch&iacute;nh Quốc gia cơ sở tại Th&agrave;nh phố Hồ Ch&iacute; Minh dự kiến tổ chức Hội thảo Khoa học với chủ đề &quot;Quản l&yacute; nh&agrave; nước về hội nhập quốc tế trong lĩnh vực khoa học v&agrave; c&ocirc;ng nghệ ở Việt Nam - Thực trạng v&agrave; giải ph&aacute;p&quot; v&agrave;o trung tuần th&aacute;ng 06 năm 2015, k&iacute;nh mời c&aacute;c thầy c&ocirc;ng, giảng vi&ecirc;n quan t&acirc;m viết b&agrave;i tham dự.</span></span></p>\r\n<p style="padding: 0px; margin: 0.5em 0px; border-color: rgb(234, 234, 234); font-family: ''Times New Roman'', Georgia, Times, serif; font-size: 14px; color: rgb(85, 85, 85);">\r\n	<span style="font-size:16px;"><span style="font-family:times new roman,times,serif;">Mọi th&ocirc;ng tin viết b&agrave;i tham gia Hội thảo&nbsp;<a href="http://qlkh-sdh.sgu.edu.vn/public/upload/files/Hoi%20thao%20khoa%20hoc%20Quan%20ly%20nha%20nuoc.pdf" style="padding: 0px; margin: 0px; border-color: rgb(234, 234, 234); font-family: Tahoma, Arial, Helvetica, sans-serif; text-decoration: none; color: rgb(128, 153, 168); font-size: inherit;">tải về tại đ&acirc;y</a>.</span></span></p>\r\n', '2015-04-20 09:01:43', 81, 1, NULL, 1, 0, 1, 1, '1429520503_hoi-thao-khoa-hoc-quan-ly-nha-nuoc.pdf'),
(25, 'Thông báo mời viết bài Hội thảo "Hoàn thiện hệ thống chỉ tiêu kế hoạch phát triển kinh tế - xã hội"', '', '<p>\r\n	&nbsp; &nbsp; &nbsp;</p>\r\n', '2015-04-23 10:23:36', 80, 1, '1429784655_001.jpg', 1, 0, 1, 1, '1429784616_hoi-thao-hoan-thien-he-thong-chi-tieu-ke-hoach-phat-trien-kinh-te---xa-hoi.pdf'),
(26, 'Thông báo mời viết báo cáo và tham dự Hội nghị Khoa học Quốc tế "Kỹ nghệ tri thức và hệ thống - KSE 2015"', '', '<p>\r\n	&nbsp; &nbsp;&nbsp;</p>\r\n', '2015-04-23 10:27:10', 84, 1, '1429784827_001.jpg', 1, 0, 1, 1, '1429784830_hoi-thao-kse.pdf'),
(27, 'Thông báo mời viết bài Hội thảo "Quá trình phát triển nhà ở cho người thu nhập thấp 30 năm qua tại TP.HCM - Thực trạng và giải pháp"', '', '<p>\r\n	Mời c&aacute;c thầy c&ocirc;, nh&agrave; nghi&ecirc;n cứu quan t&acirc;m viết b&agrave;i v&agrave; tham dự Hội thảo&nbsp;&quot;Qu&aacute; tr&igrave;nh ph&aacute;t triển nh&agrave; ở cho người thu nhập thấp 30 năm qua tại TP.HCM - Thực trạng v&agrave; giải ph&aacute;p&quot;</p>\r\n', '2015-05-07 09:43:58', 91, 1, '1430991834_001.jpg', 1, 0, 1, 1, '1430991838_hoi-thao-nha-thu-nhap-thap.pdf'),
(28, 'Thông báo mời viết bài Hội thảo Khoa học Quốc tế "Giáo dục và Toàn cầu hóa"', '', '<p>\r\n	<span style="color: rgb(85, 85, 85); font-family: ''Times New Roman'', Georgia, Times, serif; font-size: 14px;">Mời c&aacute;c thầy c&ocirc;, nh&agrave; nghi&ecirc;n cứu quan t&acirc;m viết b&agrave;i v&agrave; tham dự&nbsp;</span>Hội thảo Khoa học Quốc tế &quot;Gi&aacute;o dục v&agrave; To&agrave;n cầu h&oacute;a&quot;</p>\r\n', '2015-05-07 09:46:41', 163, 1, '1430991999_001.jpg', 1, 0, 1, 1, '1430992001_hoi-thao-toan-cau-hoa.pdf'),
(29, 'Thông báo mời viết bài Hội thảo Khoa học - Công nghệ Toàn quốc về Cơ khí lần thứ IV', '', '<p>\r\n	<span style="padding: 0px; margin: 0px; border-color: rgb(234, 234, 234); font-family: ''Times New Roman'', Georgia, Times, serif; color: rgb(85, 85, 85); font-size: 14px;">Mời c&aacute;c thầy c&ocirc;, nh&agrave; nghi&ecirc;n cứu quan t&acirc;m viết b&agrave;i v&agrave; tham dự&nbsp;</span>Hội thảo Khoa học - C&ocirc;ng nghệ To&agrave;n quốc về Cơ kh&iacute; lần thứ IV</p>\r\n', '2015-05-07 09:49:04', 85, 1, '1430992142_003.jpg', 1, 0, 1, 1, '1430992144_hoi-thao-co-khi-lan-thu-iv.pdf'),
(30, 'Thông báo mời viết bài tham dự Hội thảo Khoa học năm 2015 "Giá trị và Phương pháp giảng dạy các môn Khoa học Xã hội trong nhà trường phổ thông"', '', '<p>\r\n	&nbsp;&nbsp;</p>\r\n', '2015-05-14 09:29:43', 252, 1, '1431595781_001.jpg', 1, 0, 1, 1, '1431595783_hoi-thao-gia-tri-va-phuong-phap-giang-day-cac-mon-khxh.pdf'),
(31, 'Thông báo viết tham luận cho Hội thảo Khoa học "Những vấn đề giới và gia đình ở Nam Bộ trong bối cảnh toàn cầu hóa"', '', '<p>\r\n	&nbsp; &nbsp;</p>\r\n', '2015-05-22 02:53:33', 152, 1, '1432263211_001.jpg', 1, 0, 1, 1, '1432263213_hoi-thao-nhung-van-de-gioi-va-gia-dinh.pdf'),
(32, 'Thông báo nhận bài công bố trên Bản tin Khoa học trẻ, số 01, năm 2015, ISSN 2354-1105', '', '<p>\r\n	&nbsp;&nbsp;&nbsp;&nbsp;</p>\r\n', '2015-06-16 02:46:06', 169, 1, '1434422764_001.jpg', 1, 0, 1, 1, '1434422766_ban-tin-khoa-hoc-tre.pdf'),
(33, 'Thông báo số 2 Hội nghị Khoa học Công nghệ toàn quốc về Cơ khí lần thứ IV', '', '<p>\r\n	&nbsp;&nbsp;&nbsp;</p>\r\n', '2015-06-17 10:04:39', 76, 1, '1434535474_001.jpg', 1, 0, 1, 1, '1434535478_hoi-nghi-khcn-toan-quoc-ve-co-khi.pdf'),
(34, 'Hội thảo khoa học lần I – năm 2015: “Chiến lược phát triển các trường đại học và kết quả nghiên cứu khoa học” tại Kiên Giang', '', '<p style="color: rgb(75, 75, 75); font-family: Tahoma; font-size: 10.6666669845581px; line-height: 18px;">\r\n	<span style="font-size:20px;"><span style="font-family:times new roman,times,serif;">Ph&ograve;ng Quản l&yacute; khoa học th&ocirc;ng b&aacute;o đến c&aacute;c giảng vi&ecirc;n, CBVC về Hội thảo khoa học lần I &ndash; năm 2015: &ldquo;Chiến lược ph&aacute;t triển c&aacute;c trường đại học v&agrave; kết quả nghi&ecirc;n cứu khoa học&rdquo; tại Ki&ecirc;n Giang</span></span></p>\r\n<p style="color: rgb(75, 75, 75); font-family: Tahoma; font-size: 10.6666669845581px; line-height: 18px;">\r\n	<span style="font-size:20px;"><span style="font-family:times new roman,times,serif;">Thời gian v&egrave; địa điểm tổ chức: trong 1 ng&agrave;y, dự kiến v&agrave;o khoảng ng&agrave;y 25-30/10/2015 tại Trường Đại học Ki&ecirc;n Giang</span></span></p>\r\n<p style="color: rgb(75, 75, 75); font-family: Tahoma; font-size: 10.6666669845581px; line-height: 18px;">\r\n	<span style="font-size:20px;"><span style="font-family:times new roman,times,serif;">Thời hạn gửi b&agrave;i:</span></span></p>\r\n<p style="color: rgb(75, 75, 75); font-family: Tahoma; font-size: 10.6666669845581px; line-height: 18px;">\r\n	<span style="font-size:20px;"><span style="font-family:times new roman,times,serif;">+ Gửi t&oacute;m tắt tham luận trước ng&agrave;y 30/7/2015</span></span></p>\r\n<p style="color: rgb(75, 75, 75); font-family: Tahoma; font-size: 10.6666669845581px; line-height: 18px;">\r\n	<span style="font-size:20px;"><span style="font-family:times new roman,times,serif;">+ Gửi to&agrave;n văn b&agrave;i tham luận trước ng&agrave;y 30/8/2015</span></span></p>\r\n<p style="color: rgb(75, 75, 75); font-family: Tahoma; font-size: 10.6666669845581px; line-height: 18px;">\r\n	<span style="font-size:20px;"><span style="font-family:times new roman,times,serif;">Địa chỉ gửi b&agrave;i tham luận: gửi về email: qlkhhtqt@vnkgu.edu.vn&nbsp;</span></span></p>\r\n<p style="color: rgb(75, 75, 75); font-family: Tahoma; font-size: 10.6666669845581px; line-height: 18px;">\r\n	<span style="font-size:20px;"><span style="font-family:times new roman,times,serif;">Để r&otilde; hơn chi tiết, qu&yacute; giảng vi&ecirc;n, CBVC vui l&ograve;ng tham khảo th&ocirc;ng t&iacute;n đ&iacute;nh k&egrave;m: <a href="/public/upload/files/Ke%20hoach%20Hoi%20thao%20lan%20I%20-%20DHKG.pdf">Bấm v&agrave;o đ&acirc;y để tải</a></span></span></p>\r\n', '2015-07-15 02:25:27', 71, 1, NULL, 1, 0, 1, 1, '1436927127_thong-bao-hoi-thao-lan-i---dhkg.pdf'),
(35, 'Thư mời viết tham luận Hội thảo Khoa học Tư tưởng Hồ CHí Minh với sự nghiệp đổi mới của dân tộc', '', '<p>\r\n	&nbsp;&nbsp;</p>\r\n', '2015-07-15 02:32:02', 150, 1, NULL, 1, 0, 1, 1, '1436927522_hoi-thao-tu-tuong-hcm.pdf'),
(36, 'Thư mời viết bài tham gia Hội thảo khoa học "Quan hệ Việt Nam và Trung Quốc trong bối cảnh mới"', '', '<p>\r\n	&nbsp; &nbsp;&nbsp;</p>\r\n', '2015-07-15 02:34:20', 109, 1, NULL, 1, 0, 1, 1, '1436927659_hoi-thao-quan-he-viet-nam-va-tq.pdf'),
(37, 'Thư mời viết bài tham luận Hội thảo khoa học "Hoạt động bảo lãnh tín dụng cho doanh nghiệp nhỏ và vừa trên địa bàn TP.HCM"', '', '<p>\r\n	&nbsp; &nbsp;</p>\r\n', '2015-07-15 02:36:53', 68, 1, NULL, 1, 0, 1, 1, '1436927813_hoi-thao-hoat-dong-bao-lanh-tin-dung.pdf'),
(38, 'Danh sách chi tiết các Hội đồng xét duyệt đề tài NCKH đợt 1 năm học 2015-2016', '', '<p>\r\n	<a href="/public/upload/files/Danh%20sach%20chi%20tiet%20cac%20Hoi%20dong%20xet%20duyet%20de%20tai%20NCKH%20dot%201%20nam%20hoc%202015-2016%287%29.xls"><span style="font-size:22px;"><span style="font-family:times new roman,times,serif;">Bấm v&agrave;o đ&acirc;y để tải danh s&aacute;ch</span></span></a></p>\r\n', '2015-08-07 08:52:52', 566, 1, NULL, 1, 1, 1, 1, NULL),
(39, 'Thông báo số 1 Hội nghị khoa học toàn quốc về Nghiên cứu và Giảng dạy Sinh học ở Việt Nam lần thứ hai Tháng 5 - 2016', '', '<p>\r\n	&nbsp; &nbsp;</p>\r\n', '2015-08-17 09:57:09', 74, 1, '1439805427_001.jpg', 1, 0, 1, 1, '1439805429_hoi-nghi-ve-nghien-cuu-va-giang-day-sinh-hoc-lan-thu-hai.pdf'),
(40, 'Thư mời viết bài cho Tọa đàm Khoa học về nâng cao chất lượng giảng dạy các môn Lý luận Chính trị', '', '<p>\r\n	&nbsp;&nbsp;</p>\r\n', '2015-09-11 07:53:39', 38, 1, '1441958016_003.jpg', 1, 0, 1, 1, '1441958019_giay-moi-tham-du-va-viet-bai-cho-toa-dam-nang-cao-chat-luong-giang-day-mon-ly-luan-chinh-tri.pdf'),
(41, 'Thông báo số 1 về việc tổ chức Hội thảo Quốc gia "Bồi dưỡng năng lực cho giảng viên các trường sư phạm"', '', '<p>\r\n	&nbsp;&nbsp;</p>\r\n', '2015-09-11 07:54:52', 50, 1, '1441958090_001.jpg', 1, 0, 1, 1, '1441958092_thong-bao-so-1---hoi-thao-boi-duong-nang-luc-cho-giang-vien-cac-truong-su-pham.pdf');

-- --------------------------------------------------------

--
-- Table structure for table `tuyen_sinh`
--

CREATE TABLE IF NOT EXISTS `tuyen_sinh` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `ten` varchar(200) COLLATE utf8_unicode_ci NOT NULL,
  `ten_file` varchar(200) COLLATE utf8_unicode_ci NOT NULL,
  `trang_thai` tinyint(4) NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1 ;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
