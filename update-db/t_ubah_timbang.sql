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
/*Table structure for table `t_ubah_timbangan` */

DROP TABLE IF EXISTS `t_ubah_timbangan`;

CREATE TABLE `t_ubah_timbangan` (
  `id_ubah_timbangan` int(11) NOT NULL,
  `id_spat` int(11) DEFAULT NULL,
  `no_spat` int(11) DEFAULT NULL,
  `netto_awal` int(11) DEFAULT NULL,
  `netto_perubahan` int(11) DEFAULT NULL,
  `tara_awal` int(11) DEFAULT NULL,
  `tara_perubahan` int(11) DEFAULT NULL,
  `bruto_awal` int(11) DEFAULT NULL,
  `bruto_perubahan` int(11) DEFAULT NULL,
  `tgl_perubahan` datetime DEFAULT NULL,
  `alasan_perubahan` text,
  `user_pengajuan` varchar(50) DEFAULT NULL,
  `user_validator` varchar(50) DEFAULT NULL,
  `status_validasi` smallint(1) DEFAULT '0' COMMENT '0=belum;1=sudah;2=ditolak',
  `tgl_validasi` datetime DEFAULT NULL,
  PRIMARY KEY (`id_ubah_timbangan`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
