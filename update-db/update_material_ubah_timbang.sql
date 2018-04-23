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
/*Table structure for table `t_transaksi_material` */

DROP TABLE IF EXISTS `t_transaksi_material`;

CREATE TABLE `t_transaksi_material` (
  `id_transaksi` int(255) NOT NULL AUTO_INCREMENT,
  `no_transaksi` varchar(255) NOT NULL,
  `keterangan_transaksi` text,
  `jenis_transaksi` enum('Penerimaan','Pengiriman') DEFAULT NULL,
  PRIMARY KEY (`id_transaksi`,`no_transaksi`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

/* Trigger structure for table `t_ubah_timbangan` */

DELIMITER $$

/*!50003 DROP TRIGGER*//*!50032 IF EXISTS */ /*!50003 `tr_no_ajuan_timbangan` */$$

/*!50003 CREATE */ /*!50003 TRIGGER `tr_no_ajuan_timbangan` BEFORE INSERT ON `t_ubah_timbangan` FOR EACH ROW BEGIN
DECLARE nilaimax INT;
	SELECT IFNULL(MAX(RIGHT(no_ajuan,4))+1,1) INTO nilaimax FROM `t_ubah_timbangan` WHERE DATE(tgl_perubahan) = DATE(NOW());
	SET NEW.no_ajuan = CONCAT('PG-',DATE_FORMAT(DATE(Now()),'%d%m%Y'),'-AJN-',LPAD(nilaimax,4,'0'));
	SET new.tgl_perubahan = NOW();
    END */$$


DELIMITER ;

/* Trigger structure for table `t_timbang_material` */

DELIMITER $$

/*!50003 DROP TRIGGER*//*!50032 IF EXISTS */ /*!50003 `tr_tiket_material` */$$

/*!50003 CREATE */ /*!50003 TRIGGER `tr_tiket_material` BEFORE INSERT ON `t_timbang_material` FOR EACH ROW BEGIN
DECLARE nilaimax INT;
	SELECT IFNULL(MAX(RIGHT(no_tiket,4))+1,1) INTO nilaimax FROM `t_timbang_material` WHERE DATE(tgl_timbang_1) = DATE(NOW());
	SET NEW.no_tiket = CONCAT(DATE_FORMAT(DATE(NEW.tgl_timbang_1),'%d%m%Y'),'-MT-',LPAD(nilaimax,4,'0'));
	
    END */$$


DELIMITER ;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
