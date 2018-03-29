/*
SQLyog Ultimate v12.09 (64 bit)
MySQL - 10.1.10-MariaDB : Database - simpg_ptpn
*********************************************************************
*/

/*!40101 SET NAMES utf8 */;

/*!40101 SET SQL_MODE=''*/;

/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;
/*Table structure for table `t_timbang_material` */

DROP TABLE IF EXISTS `t_timbang_material`;

CREATE TABLE `t_timbang_material` (
  `id_t_material` int(11) NOT NULL AUTO_INCREMENT,
  `no_tiket` varchar(50) NOT NULL DEFAULT '' COMMENT 'no tiket tergenerate otomatis',
  `kode_material` varchar(50) DEFAULT NULL COMMENT 'kode material SAP',
  `nama_material` varchar(150) DEFAULT NULL COMMENT 'ket material',
  `kode_relasi` varchar(50) DEFAULT NULL COMMENT 'kode customer/suplier',
  `nama_relasi` varchar(150) DEFAULT NULL COMMENT 'nama customer/suplier',
  `no_kendaraan` varchar(10) DEFAULT NULL COMMENT 'no kendaraan',
  `nama_supir` varchar(100) DEFAULT NULL COMMENT 'nama supir',
  `timbang_1` int(11) DEFAULT NULL,
  `timbang_2` int(11) DEFAULT NULL,
  `netto` int(11) DEFAULT NULL,
  `tgl_timbang_1` datetime DEFAULT NULL COMMENT 'tgl timbang',
  `tgl_timbang_2` datetime DEFAULT NULL COMMENT 'tgl timbang',
  `jenis_transaksi` enum('Penerimaan','Pengiriman') DEFAULT NULL COMMENT 'jenis transaksi PO/SO',
  `no_transaksi` varchar(50) DEFAULT NULL COMMENT 'no dokumen transaksi',
  `status_timbang_1` smallint(1) DEFAULT '0' COMMENT '0=belum;1=sudah',
  `status_timbang_2` smallint(1) DEFAULT '0' COMMENT '0=belum;1=sudah',
  `ptgs_timbang` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`id_t_material`,`no_tiket`)
) ENGINE=MyISAM AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

DELIMITER $$

USE `simpg_ptpn`$$

DROP TRIGGER /*!50032 IF EXISTS */ `tr_tiket_material`$$

CREATE
    TRIGGER `tr_tiket_material` BEFORE INSERT ON `t_timbang_material` 
    FOR EACH ROW BEGIN
DECLARE nilaimax INT;
	SELECT IFNULL(MAX(RIGHT(no_tiket,4))+1,1) INTO nilaimax FROM `t_timbang_material` WHERE DATE(tgl_timbang_1) = DATE(NOW());
	SET NEW.no_tiket = CONCAT(DATE_FORMAT(DATE(NEW.tgl_timbang_1),'%d%m%Y'),'-MT-',LPAD(nilaimax,4,'0'));
	
    END;
$$

DELIMITER ;
