-- --------------------------------------------------------
-- Host:                         127.0.0.1
-- Server version:               5.7.11 - MySQL Community Server (GPL)
-- Server OS:                    Win32
-- HeidiSQL Version:             9.3.0.4984
-- Last Update                   30/08/2016 22:40
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8mb4 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;

-- Dumping database structure for persediaandb
DROP DATABASE IF EXISTS `persediaandb`;
CREATE DATABASE IF NOT EXISTS `persediaandb` /*!40100 DEFAULT CHARACTER SET latin1 */;
USE `persediaandb`;


-- Dumping structure for table persediaandb.mst_category
DROP TABLE IF EXISTS `mst_category`;
CREATE TABLE IF NOT EXISTS `mst_category` (
  `id` char(64) NOT NULL,
  `name` varchar(100) NOT NULL,
  `parent` char(64) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `FK_mst_category_mst_category` (`parent`),
  CONSTRAINT `FK_mst_category_mst_category` FOREIGN KEY (`parent`) REFERENCES `mst_category` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Dumping data for table persediaandb.mst_category: ~0 rows (approximately)
DELETE FROM `mst_category`;
/*!40000 ALTER TABLE `mst_category` DISABLE KEYS */;
INSERT INTO `mst_category` (`id`, `name`, `parent`) VALUES
	('42364930-6EF1-4F8C-B8B1-08BEC05CBB5C', 'Cleaning Tool', NULL),
	('6A12FB94-C8D9-4400-BE98-B2851DEE1573', 'Stationery', NULL),
	('86A391CA-FC39-4DC9-9174-1322B3C61CDA', 'Healthy Tools', NULL),
	('A7AF4D2E-6D7E-4B56-B67B-518926E8A81A', 'Drugs', NULL);
/*!40000 ALTER TABLE `mst_category` ENABLE KEYS */;


-- Dumping structure for table persediaandb.mst_item
DROP TABLE IF EXISTS `mst_item`;
CREATE TABLE IF NOT EXISTS `mst_item` (
  `id` char(64) NOT NULL,
  `categoryid` char(64) DEFAULT NULL,
  `code` char(15) NOT NULL,
  `name` varchar(100) NOT NULL,
  `stockunit` varchar(25) NOT NULL COMMENT 'unit untuk stock, bisa kg, litter, pcs dll',
  `isused` tinyint(1) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `FK_mst_item_mst_category` (`categoryid`),
  CONSTRAINT `FK_mst_item_mst_category` FOREIGN KEY (`categoryid`) REFERENCES `mst_category` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COMMENT='Barang';

-- Dumping data for table persediaandb.mst_item: ~3 rows (approximately)
DELETE FROM `mst_item`;
/*!40000 ALTER TABLE `mst_item` DISABLE KEYS */;
INSERT INTO `mst_item` (`id`, `categoryid`, `code`, `name`, `stockunit`, `isused`) VALUES
	('34FFE025-A980-463B-BC4A-12F5407B2E5F', '86A391CA-FC39-4DC9-9174-1322B3C61CDA', '', 'Kain Kasa', 'Pack', 1),
	('806E3621-C45E-409E-B9E5-B67A9F1947F4', '86A391CA-FC39-4DC9-9174-1322B3C61CDA', '', 'Infus', 'PCS', 1),
	('B06C98C3-9CD2-4B9E-BC2F-91CF3F716966', '42364930-6EF1-4F8C-B8B1-08BEC05CBB5C', '', 'Harpic', 'PCS', 1),
	('BC816C4C-6AC0-422D-8F12-00A0FCFC0C4F', '6A12FB94-C8D9-4400-BE98-B2851DEE1573', '', 'Paper A4 Sidu', 'Pack', 1),
	('BE8F7088-1919-4C3E-A4D9-BABC50EAEDA6', '86A391CA-FC39-4DC9-9174-1322B3C61CDA', '', 'Pampers', 'PCS', 1);
/*!40000 ALTER TABLE `mst_item` ENABLE KEYS */;


-- Dumping structure for table persediaandb.mst_order_detail_status
DROP TABLE IF EXISTS `mst_order_detail_status`;
CREATE TABLE IF NOT EXISTS `mst_order_detail_status` (
  `code` char(10) NOT NULL,
  `name` varchar(50) NOT NULL,
  PRIMARY KEY (`code`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Dumping data for table persediaandb.mst_order_detail_status: ~3 rows (approximately)
DELETE FROM `mst_order_detail_status`;
/*!40000 ALTER TABLE `mst_order_detail_status` DISABLE KEYS */;
INSERT INTO `mst_order_detail_status` (`code`, `name`) VALUES
	('SR', 'Stock Return'),
	('ST', 'Stock Taken'),
	('WT', 'Wait To Take');
/*!40000 ALTER TABLE `mst_order_detail_status` ENABLE KEYS */;


-- Dumping structure for table persediaandb.mst_order_status
DROP TABLE IF EXISTS `mst_order_status`;
CREATE TABLE IF NOT EXISTS `mst_order_status` (
  `code` char(5) NOT NULL,
  `name` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`code`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Dumping data for table persediaandb.mst_order_status: ~3 rows (approximately)
DELETE FROM `mst_order_status`;
/*!40000 ALTER TABLE `mst_order_status` DISABLE KEYS */;
INSERT INTO `mst_order_status` (`code`, `name`) VALUES
	('CANCE', 'Canceled'),
	('DONE', 'Done'),
	('PROC', 'Process');
/*!40000 ALTER TABLE `mst_order_status` ENABLE KEYS */;


-- Dumping structure for table persediaandb.mst_profile
DROP TABLE IF EXISTS `mst_profile`;
CREATE TABLE IF NOT EXISTS `mst_profile` (
  `id` char(64) NOT NULL,
  `unitid` char(64) DEFAULT NULL,
  `name` varchar(100) NOT NULL,
  `position` varchar(100) NOT NULL COMMENT 'jabatan',
  `title` varchar(25) NOT NULL COMMENT 'panggilan, bapak, ibu, saudara',
  `nip` varchar(50) NOT NULL DEFAULT '',
  PRIMARY KEY (`id`),
  KEY `FK_mst_profile_mst_unit` (`unitid`),
  CONSTRAINT `FK_mst_profile_mst_unit` FOREIGN KEY (`unitid`) REFERENCES `mst_unit` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Dumping data for table persediaandb.mst_profile: ~3 rows (approximately)
DELETE FROM `mst_profile`;
/*!40000 ALTER TABLE `mst_profile` DISABLE KEYS */;
INSERT INTO `mst_profile` (`id`, `unitid`, `name`, `position`, `title`, `nip`) VALUES
	('55A37333-5DC3-43F5-ACC7-731EB2ED5EC5', NULL, 'Bagus Waluyo e', '', '', ''),
	('63CC67BB-F7F1-45F2-BE59-BA58EBD424D1', NULL, 'Eko Cahyono E', '', '', ''),
	('a3ebf587-687a-11e6-a763-00aceea37ffa', NULL, 'Bima SP', 'Admin IT', 'Sdr', '');
/*!40000 ALTER TABLE `mst_profile` ENABLE KEYS */;


-- Dumping structure for table persediaandb.mst_role
DROP TABLE IF EXISTS `mst_role`;
CREATE TABLE IF NOT EXISTS `mst_role` (
  `id` char(64) NOT NULL,
  `name` varchar(50) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COMMENT='hak akses';

-- Dumping data for table persediaandb.mst_role: ~3 rows (approximately)
DELETE FROM `mst_role`;
/*!40000 ALTER TABLE `mst_role` DISABLE KEYS */;
INSERT INTO `mst_role` (`id`, `name`) VALUES
	('d45b28f4-6844-11e6-94f0-62d712d1e403', 'Admin'),
	('d45b2d0a-6844-11e6-94f0-62d712d1e403', 'Unit'),
	('d45b2dd4-6844-11e6-94f0-62d712d1e403', 'Matkes');
/*!40000 ALTER TABLE `mst_role` ENABLE KEYS */;


-- Dumping structure for table persediaandb.mst_supplier
DROP TABLE IF EXISTS `mst_supplier`;
CREATE TABLE IF NOT EXISTS `mst_supplier` (
  `id` char(64) NOT NULL,
  `name` varchar(100) NOT NULL,
  `phone` varchar(25) NOT NULL,
  `address` tinytext NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Dumping data for table persediaandb.mst_supplier: ~0 rows (approximately)
DELETE FROM `mst_supplier`;
/*!40000 ALTER TABLE `mst_supplier` DISABLE KEYS */;
/*!40000 ALTER TABLE `mst_supplier` ENABLE KEYS */;


-- Dumping structure for table persediaandb.mst_unit
DROP TABLE IF EXISTS `mst_unit`;
CREATE TABLE IF NOT EXISTS `mst_unit` (
  `id` char(64) NOT NULL,
  `name` varchar(100) NOT NULL,
  `code` char(15) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Dumping data for table persediaandb.mst_unit: ~2 rows (approximately)
DELETE FROM `mst_unit`;
/*!40000 ALTER TABLE `mst_unit` DISABLE KEYS */;
INSERT INTO `mst_unit` (`id`, `name`, `code`) VALUES
	('7DB0E571-CBF3-434C-BE7E-1DE790928494', 'TKK', 'TKK'),
	('9378C8FA-FFD1-47B4-94F9-34B06B9714A9', 'Dokter Umum MOU', 'DOKUM');
/*!40000 ALTER TABLE `mst_unit` ENABLE KEYS */;


-- Dumping structure for table persediaandb.mst_user
DROP TABLE IF EXISTS `mst_user`;
CREATE TABLE IF NOT EXISTS `mst_user` (
  `id` char(64) NOT NULL,
  `roleid` char(64) NOT NULL,
  `username` varchar(25) NOT NULL,
  `hashpassword` varchar(128) NOT NULL,
  `isactive` tinyint(1) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `FK_mst_user_mst_role` (`roleid`),
  CONSTRAINT `FK_mst_user_mst_profile` FOREIGN KEY (`id`) REFERENCES `mst_profile` (`id`),
  CONSTRAINT `FK_mst_user_mst_role` FOREIGN KEY (`roleid`) REFERENCES `mst_role` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Dumping data for table persediaandb.mst_user: ~3 rows (approximately)
DELETE FROM `mst_user`;
/*!40000 ALTER TABLE `mst_user` DISABLE KEYS */;
INSERT INTO `mst_user` (`id`, `roleid`, `username`, `hashpassword`, `isactive`) VALUES
	('55A37333-5DC3-43F5-ACC7-731EB2ED5EC5', 'd45b2d0a-6844-11e6-94f0-62d712d1e403', 'bagus123', '$2y$11$DCKJdNLUr/o788U9xvUzn.a/NjK1Pq4/0O30x9/f8Iv5oVMz1o/mW', 1),
	('63CC67BB-F7F1-45F2-BE59-BA58EBD424D1', 'd45b2dd4-6844-11e6-94f0-62d712d1e403', 'eko123', '$2y$11$YMNEbvsueUXws2ASoRf.tuW.jyq7ab0C/o4a3uL3ZagL1PfLpvxtC', 1),
	('a3ebf587-687a-11e6-a763-00aceea37ffa', 'd45b28f4-6844-11e6-94f0-62d712d1e403', 'admin', '$2y$11$eT6ZMdSv2ikzW6SrjibOLeOYqaiOwDw0dEb7/Y.VvguuqZzF0WrtW', 1);
/*!40000 ALTER TABLE `mst_user` ENABLE KEYS */;


-- Dumping structure for table persediaandb.tsc_order
DROP TABLE IF EXISTS `tsc_order`;
CREATE TABLE IF NOT EXISTS `tsc_order` (
  `id` char(64) NOT NULL,
  `tagcode` char(10) NOT NULL,
  `userid` char(64) NOT NULL,
  `orderdate` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `itemcount` int(11) NOT NULL DEFAULT '0',
  `status` char(5) NOT NULL,
  `isdeleted` tinyint(1) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `tagcode` (`tagcode`),
  KEY `FK_tsc_order_mst_profile` (`userid`),
  KEY `FK_tsc_order_mst_order_status` (`status`),
  CONSTRAINT `FK_tsc_order_mst_order_status` FOREIGN KEY (`status`) REFERENCES `mst_order_status` (`code`),
  CONSTRAINT `FK_tsc_order_mst_profile` FOREIGN KEY (`userid`) REFERENCES `mst_profile` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Dumping data for table persediaandb.tsc_order: ~2 rows (approximately)
DELETE FROM `tsc_order`;
/*!40000 ALTER TABLE `tsc_order` DISABLE KEYS */;
INSERT INTO `tsc_order` (`id`, `tagcode`, `userid`, `orderdate`, `itemcount`, `status`, `isdeleted`) VALUES
	('3C7B9B67-96A4-4792-8BD1-D6EB84FF163A', '#DIO254U', 'a3ebf587-687a-11e6-a763-00aceea37ffa', '2016-08-29 05:11:48', 2, 'CANCE', 0),
	('9678EAC0-19FC-4438-A988-C6EF8BFC1F79', '#IH26F9B', '55A37333-5DC3-43F5-ACC7-731EB2ED5EC5', '2016-08-30 06:34:42', 1, 'DONE', 0);
/*!40000 ALTER TABLE `tsc_order` ENABLE KEYS */;


-- Dumping structure for table persediaandb.tsc_order_detail
DROP TABLE IF EXISTS `tsc_order_detail`;
CREATE TABLE IF NOT EXISTS `tsc_order_detail` (
  `id` char(64) NOT NULL,
  `orderid` char(64) NOT NULL,
  `itemid` char(64) NOT NULL,
  `total` decimal(18,2) NOT NULL DEFAULT '0.00',
  `status` char(10) NOT NULL DEFAULT '0.00',
  PRIMARY KEY (`id`),
  KEY `FK__tsc_order` (`orderid`),
  KEY `FK_tsc_order_detail_mst_item` (`itemid`),
  KEY `FK_tsc_order_detail_mst_order_detail_status` (`status`),
  CONSTRAINT `FK__tsc_order` FOREIGN KEY (`orderid`) REFERENCES `tsc_order` (`id`),
  CONSTRAINT `FK_tsc_order_detail_mst_item` FOREIGN KEY (`itemid`) REFERENCES `mst_item` (`id`),
  CONSTRAINT `FK_tsc_order_detail_mst_order_detail_status` FOREIGN KEY (`status`) REFERENCES `mst_order_detail_status` (`code`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Dumping data for table persediaandb.tsc_order_detail: ~3 rows (approximately)
DELETE FROM `tsc_order_detail`;
/*!40000 ALTER TABLE `tsc_order_detail` DISABLE KEYS */;
INSERT INTO `tsc_order_detail` (`id`, `orderid`, `itemid`, `total`, `status`) VALUES
	('3A027697-597C-4DA4-B6B9-D030C358FEAE', '9678EAC0-19FC-4438-A988-C6EF8BFC1F79', '34FFE025-A980-463B-BC4A-12F5407B2E5F', 15.00, 'ST'),
	('A579B648-E8AF-40C1-AEDD-F205398F38E5', '3C7B9B67-96A4-4792-8BD1-D6EB84FF163A', 'BE8F7088-1919-4C3E-A4D9-BABC50EAEDA6', 12.00, 'WT'),
	('FD2C06E4-A921-40A8-BC2D-AA4D8679E13F', '3C7B9B67-96A4-4792-8BD1-D6EB84FF163A', '34FFE025-A980-463B-BC4A-12F5407B2E5F', 25.00, 'WT');
/*!40000 ALTER TABLE `tsc_order_detail` ENABLE KEYS */;


-- Dumping structure for table persediaandb.tsc_order_detail_return
DROP TABLE IF EXISTS `tsc_order_detail_return`;
CREATE TABLE IF NOT EXISTS `tsc_order_detail_return` (
  `id` char(64) NOT NULL,
  `reason` text NOT NULL,
  `totalreturn` decimal(18,2) NOT NULL DEFAULT '0.00',
  `returndate` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  CONSTRAINT `FK_tsc_order_detail_return_tsc_order` FOREIGN KEY (`id`) REFERENCES `tsc_order` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Dumping data for table persediaandb.tsc_order_detail_return: ~0 rows (approximately)
DELETE FROM `tsc_order_detail_return`;
/*!40000 ALTER TABLE `tsc_order_detail_return` DISABLE KEYS */;
/*!40000 ALTER TABLE `tsc_order_detail_return` ENABLE KEYS */;


-- Dumping structure for table persediaandb.tsc_order_detail_taken
DROP TABLE IF EXISTS `tsc_order_detail_taken`;
CREATE TABLE IF NOT EXISTS `tsc_order_detail_taken` (
  `id` char(64) NOT NULL,
  `note` text NOT NULL,
  `takendate` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  CONSTRAINT `FK_tsc_order_detail_taken_tsc_order_detail` FOREIGN KEY (`id`) REFERENCES `tsc_order_detail` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Dumping data for table persediaandb.tsc_order_detail_taken: ~0 rows (approximately)
DELETE FROM `tsc_order_detail_taken`;
/*!40000 ALTER TABLE `tsc_order_detail_taken` DISABLE KEYS */;
/*!40000 ALTER TABLE `tsc_order_detail_taken` ENABLE KEYS */;


-- Dumping structure for table persediaandb.tsc_stock
DROP TABLE IF EXISTS `tsc_stock`;
CREATE TABLE IF NOT EXISTS `tsc_stock` (
  `id` char(64) NOT NULL,
  `itemid` char(64) NOT NULL,
  `orderdetailid` char(64) DEFAULT NULL,
  `currentstock` decimal(18,2) NOT NULL,
  `stockdate` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `note` text NOT NULL,
  PRIMARY KEY (`id`),
  KEY `FK__mst_item` (`itemid`),
  KEY `FK_tsc_stock_tsc_order` (`orderdetailid`),
  CONSTRAINT `FK__mst_item` FOREIGN KEY (`itemid`) REFERENCES `mst_item` (`id`),
  CONSTRAINT `FK_tsc_stock_tsc_order` FOREIGN KEY (`orderdetailid`) REFERENCES `tsc_order_detail` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Dumping data for table persediaandb.tsc_stock: ~8 rows (approximately)
DELETE FROM `tsc_stock`;
/*!40000 ALTER TABLE `tsc_stock` DISABLE KEYS */;
INSERT INTO `tsc_stock` (`id`, `itemid`, `orderdetailid`, `currentstock`, `stockdate`, `note`) VALUES
	('0686E4DB-E98C-40BE-A55D-88ACAA885F67', 'BE8F7088-1919-4C3E-A4D9-BABC50EAEDA6', 'A579B648-E8AF-40C1-AEDD-F205398F38E5', 8.00, '2016-08-29 05:11:48', 'order detail'),
	('07D50F35-FE27-4197-9104-DB4268387FBF', '34FFE025-A980-463B-BC4A-12F5407B2E5F', '3A027697-597C-4DA4-B6B9-D030C358FEAE', 10.00, '2016-08-30 06:34:43', 'order detail'),
	('0C82670E-DD54-409A-BD74-181AB36AD573', '34FFE025-A980-463B-BC4A-12F5407B2E5F', NULL, 10.00, '2016-08-25 01:08:40', '<p>stok awal</p>'),
	('143591A8-FFAC-4708-8763-694837B6AA5F', 'BE8F7088-1919-4C3E-A4D9-BABC50EAEDA6', NULL, 20.00, '2016-08-25 01:10:38', '<p>stock awal</p>'),
	('4B65B6D5-7500-44BA-89FA-A4E8275810BA', '34FFE025-A980-463B-BC4A-12F5407B2E5F', 'FD2C06E4-A921-40A8-BC2D-AA4D8679E13F', 25.00, '2016-08-29 05:11:48', 'order detail'),
	('5C9CBA8D-730D-4DED-87B4-6185F6A03573', 'BE8F7088-1919-4C3E-A4D9-BABC50EAEDA6', 'A579B648-E8AF-40C1-AEDD-F205398F38E5', 20.00, '2016-08-30 08:16:57', 'order detail'),
	('646E3B6D-B2EB-4686-BD29-955B93ABC1D2', '34FFE025-A980-463B-BC4A-12F5407B2E5F', NULL, 50.00, '2016-08-25 01:11:41', '<p>stock kedua</p>'),
	('DBF7A5DA-25C9-446B-A23D-A356391D5647', '34FFE025-A980-463B-BC4A-12F5407B2E5F', 'FD2C06E4-A921-40A8-BC2D-AA4D8679E13F', 35.00, '2016-08-30 08:16:57', 'order detail');
/*!40000 ALTER TABLE `tsc_stock` ENABLE KEYS */;
/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IF(@OLD_FOREIGN_KEY_CHECKS IS NULL, 1, @OLD_FOREIGN_KEY_CHECKS) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
