-- --------------------------------------------------------
-- Host:                         127.0.0.1
-- Server version:               5.7.11 - MySQL Community Server (GPL)
-- Server OS:                    Win64
-- HeidiSQL Version:             9.3.0.4984
-- Last Update:                  25/08/2016 18:38
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8mb4 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;

-- Dumping database structure for persediaandb
DROP DATABASE IF EXISTS `persediaandb`;
CREATE DATABASE IF NOT EXISTS `persediaandb` /*!40100 DEFAULT CHARACTER SET latin1 */;
USE `persediaandb`;


-- Dumping structure for table persediaandb.mst_item
DROP TABLE IF EXISTS `mst_item`;
CREATE TABLE IF NOT EXISTS `mst_item` (
  `id` char(64) NOT NULL,
  `code` char(15) NOT NULL,
  `name` varchar(100) NOT NULL,
  `stockunit` varchar(25) NOT NULL COMMENT 'unit untuk stock, bisa kg, litter, pcs dll',
  `isused` tinyint(1) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COMMENT='Barang';

-- Dumping data for table persediaandb.mst_item: ~3 rows (approximately)
DELETE FROM `mst_item`;
/*!40000 ALTER TABLE `mst_item` DISABLE KEYS */;
INSERT INTO `mst_item` (`id`, `code`, `name`, `stockunit`, `isused`) VALUES
	('34FFE025-A980-463B-BC4A-12F5407B2E5F', '', 'Kain Kasa', 'Pack', 1),
	('806E3621-C45E-409E-B9E5-B67A9F1947F4', '', 'Infus', 'PCS', 1),
	('BE8F7088-1919-4C3E-A4D9-BABC50EAEDA6', '', 'Pampers', 'PCS', 1);
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
	('CANCE', 'Cancelled'),
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

-- Dumping data for table persediaandb.tsc_order: ~0 rows (approximately)
DELETE FROM `tsc_order`;
/*!40000 ALTER TABLE `tsc_order` DISABLE KEYS */;
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

-- Dumping data for table persediaandb.tsc_order_detail: ~0 rows (approximately)
DELETE FROM `tsc_order_detail`;
/*!40000 ALTER TABLE `tsc_order_detail` DISABLE KEYS */;
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

-- Dumping data for table persediaandb.tsc_stock: ~3 rows (approximately)
DELETE FROM `tsc_stock`;
/*!40000 ALTER TABLE `tsc_stock` DISABLE KEYS */;
INSERT INTO `tsc_stock` (`id`, `itemid`, `orderdetailid`, `currentstock`, `stockdate`, `note`) VALUES
	('0C82670E-DD54-409A-BD74-181AB36AD573', '34FFE025-A980-463B-BC4A-12F5407B2E5F', NULL, 10.00, '2016-08-25 01:08:40', '<p>stok awal</p>'),
	('143591A8-FFAC-4708-8763-694837B6AA5F', 'BE8F7088-1919-4C3E-A4D9-BABC50EAEDA6', NULL, 20.00, '2016-08-25 01:10:38', '<p>stock awal</p>'),
	('646E3B6D-B2EB-4686-BD29-955B93ABC1D2', '34FFE025-A980-463B-BC4A-12F5407B2E5F', NULL, 50.00, '2016-08-25 01:11:41', '<p>stock kedua</p>');
/*!40000 ALTER TABLE `tsc_stock` ENABLE KEYS */;
/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IF(@OLD_FOREIGN_KEY_CHECKS IS NULL, 1, @OLD_FOREIGN_KEY_CHECKS) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
