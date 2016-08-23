-- --------------------------------------------------------
-- Host:                         127.0.0.1
-- Server version:               5.7.11 - MySQL Community Server (GPL)
-- Server OS:                    Win64
-- HeidiSQL Version:             9.3.0.4984
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8mb4 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;

-- Dumping database structure for persediaandb
CREATE DATABASE IF NOT EXISTS `persediaandb` /*!40100 DEFAULT CHARACTER SET latin1 */;
USE `persediaandb`;


-- Dumping structure for table persediaandb.mst_item
CREATE TABLE IF NOT EXISTS `mst_item` (
  `id` char(64) NOT NULL,
  `code` char(15) NOT NULL,
  `name` varchar(100) NOT NULL,
  `stockunit` varchar(25) NOT NULL COMMENT 'unit untuk stock, bisa kg, litter, pcs dll',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COMMENT='Barang';

-- Dumping data for table persediaandb.mst_item: ~0 rows (approximately)
DELETE FROM `mst_item`;
/*!40000 ALTER TABLE `mst_item` DISABLE KEYS */;
/*!40000 ALTER TABLE `mst_item` ENABLE KEYS */;


-- Dumping structure for table persediaandb.mst_order_detail_status
CREATE TABLE IF NOT EXISTS `mst_order_detail_status` (
  `code` char(10) NOT NULL,
  `name` varchar(50) NOT NULL,
  PRIMARY KEY (`code`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Dumping data for table persediaandb.mst_order_detail_status: ~5 rows (approximately)
DELETE FROM `mst_order_detail_status`;
/*!40000 ALTER TABLE `mst_order_detail_status` DISABLE KEYS */;
INSERT INTO `mst_order_detail_status` (`code`, `name`) VALUES
	('IN', 'Inquiry'),
	('OS', 'Out of stock'),
	('SR', 'Stock Return'),
	('SS', 'Sufficient Stock'),
	('ST', 'Stock Taken');
/*!40000 ALTER TABLE `mst_order_detail_status` ENABLE KEYS */;


-- Dumping structure for table persediaandb.mst_order_status
CREATE TABLE IF NOT EXISTS `mst_order_status` (
  `code` char(5) NOT NULL,
  `name` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`code`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Dumping data for table persediaandb.mst_order_status: ~3 rows (approximately)
DELETE FROM `mst_order_status`;
/*!40000 ALTER TABLE `mst_order_status` DISABLE KEYS */;
INSERT INTO `mst_order_status` (`code`, `name`) VALUES
	('DONE', 'Done'),
	('PEND', 'Pending'),
	('PROC', 'Process');
/*!40000 ALTER TABLE `mst_order_status` ENABLE KEYS */;


-- Dumping structure for table persediaandb.mst_profile
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

-- Dumping data for table persediaandb.mst_profile: ~4 rows (approximately)
DELETE FROM `mst_profile`;
/*!40000 ALTER TABLE `mst_profile` DISABLE KEYS */;
INSERT INTO `mst_profile` (`id`, `unitid`, `name`, `position`, `title`, `nip`) VALUES
	('55A37333-5DC3-43F5-ACC7-731EB2ED5EC5', NULL, 'Bagus', '', '', ''),
	('63CC67BB-F7F1-45F2-BE59-BA58EBD424D1', NULL, 'Eko Cahyono', '', '', ''),
	('a3ebf587-687a-11e6-a763-00aceea37ffa', NULL, 'Bima SP', 'Admin IT', 'Sdr', ''),
	('BDE60B18-23FF-4083-B27C-4AD0231BF183', NULL, 'Cahyadi', '', '', '');
/*!40000 ALTER TABLE `mst_profile` ENABLE KEYS */;


-- Dumping structure for table persediaandb.mst_role
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
CREATE TABLE IF NOT EXISTS `mst_unit` (
  `id` char(64) NOT NULL,
  `name` varchar(100) NOT NULL,
  `code` char(15) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Dumping data for table persediaandb.mst_unit: ~0 rows (approximately)
DELETE FROM `mst_unit`;
/*!40000 ALTER TABLE `mst_unit` DISABLE KEYS */;
/*!40000 ALTER TABLE `mst_unit` ENABLE KEYS */;


-- Dumping structure for table persediaandb.mst_user
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

-- Dumping data for table persediaandb.mst_user: ~4 rows (approximately)
DELETE FROM `mst_user`;
/*!40000 ALTER TABLE `mst_user` DISABLE KEYS */;
INSERT INTO `mst_user` (`id`, `roleid`, `username`, `hashpassword`, `isactive`) VALUES
	('55A37333-5DC3-43F5-ACC7-731EB2ED5EC5', 'd45b2d0a-6844-11e6-94f0-62d712d1e403', 'bagus123', '$2y$11$YguaxtCp7yE6.PJTUPWXbuZGtB1Fc9wrr5hkqsCDfcTOPMg5moIVm', 1),
	('63CC67BB-F7F1-45F2-BE59-BA58EBD424D1', 'd45b2dd4-6844-11e6-94f0-62d712d1e403', 'eko123', '$2y$11$YMNEbvsueUXws2ASoRf.tuW.jyq7ab0C/o4a3uL3ZagL1PfLpvxtC', 1),
	('a3ebf587-687a-11e6-a763-00aceea37ffa', 'd45b28f4-6844-11e6-94f0-62d712d1e403', 'admin', '$2y$11$eT6ZMdSv2ikzW6SrjibOLeOYqaiOwDw0dEb7/Y.VvguuqZzF0WrtW', 1),
	('BDE60B18-23FF-4083-B27C-4AD0231BF183', 'd45b2dd4-6844-11e6-94f0-62d712d1e403', 'yadi123', '$2y$11$6SHCfNo6XDULSGlE4URZGeJHwFM.a/vAOq4cFKUhyZwaM4MxH9w0a', 1);
/*!40000 ALTER TABLE `mst_user` ENABLE KEYS */;


-- Dumping structure for table persediaandb.tsc_order
CREATE TABLE IF NOT EXISTS `tsc_order` (
  `id` char(64) NOT NULL,
  `tagcode` char(10) NOT NULL,
  `userid` char(64) NOT NULL,
  `orderdate` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `itemcount` int(11) NOT NULL DEFAULT '0',
  `grandtotal` decimal(18,2) NOT NULL DEFAULT '0.00',
  `status` char(5) NOT NULL,
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
CREATE TABLE IF NOT EXISTS `tsc_stock` (
  `id` char(64) NOT NULL,
  `itemid` char(64) NOT NULL,
  `currentstock` decimal(18,2) NOT NULL,
  `stockdate` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `FK__mst_item` (`itemid`),
  CONSTRAINT `FK__mst_item` FOREIGN KEY (`itemid`) REFERENCES `mst_item` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Dumping data for table persediaandb.tsc_stock: ~0 rows (approximately)
DELETE FROM `tsc_stock`;
/*!40000 ALTER TABLE `tsc_stock` DISABLE KEYS */;
/*!40000 ALTER TABLE `tsc_stock` ENABLE KEYS */;
/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IF(@OLD_FOREIGN_KEY_CHECKS IS NULL, 1, @OLD_FOREIGN_KEY_CHECKS) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
