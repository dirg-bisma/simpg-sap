/*
SQLyog Ultimate v12.09 (64 bit)
MySQL - 10.1.19-MariaDB : Database - db_simpg
*********************************************************************
*/

/*!40101 SET NAMES utf8 */;

/*!40101 SET SQL_MODE=''*/;

/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;
/*Table structure for table `m_pekerjaan_tma` */

DROP TABLE IF EXISTS `m_pekerjaan_tma`;

CREATE TABLE `m_pekerjaan_tma` (
  `id_pekerjaan_tma` int(255) NOT NULL AUTO_INCREMENT,
  `nama_pekerjaan_tma` varchar(255) DEFAULT NULL,
  `nominal_atas` double DEFAULT NULL,
  `nominal_bawah` double DEFAULT NULL,
  `nominal_default` double DEFAULT NULL,
  `satuan` varchar(100) DEFAULT NULL,
  `tercetak_spat` smallint(1) DEFAULT NULL COMMENT '0=tidak tampil,1=tampil',
  `status_pekerjaan` smallint(1) DEFAULT NULL COMMENT '0=tidak default, 1=default (jenis pekerjaan ini harus masuk dalam paket upah tebang), 2= tidak aktif',
  `jenis` smallint(1) DEFAULT '1' COMMENT '1. biaya 2. potongan',
  `kodekolom` varchar(3) DEFAULT NULL,
  PRIMARY KEY (`id_pekerjaan_tma`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=21 DEFAULT CHARSET=latin1 ROW_FORMAT=COMPACT;

/*Data for the table `m_pekerjaan_tma` */

insert  into `m_pekerjaan_tma`(`id_pekerjaan_tma`,`nama_pekerjaan_tma`,`nominal_atas`,`nominal_bawah`,`nominal_default`,`satuan`,`tercetak_spat`,`status_pekerjaan`,`jenis`,`kodekolom`) values (1,'Upah Pokok',NULL,NULL,2000,'1',0,1,1,'k1');
insert  into `m_pekerjaan_tma`(`id_pekerjaan_tma`,`nama_pekerjaan_tma`,`nominal_atas`,`nominal_bawah`,`nominal_default`,`satuan`,`tercetak_spat`,`status_pekerjaan`,`jenis`,`kodekolom`) values (2,'Premi Bersih',NULL,NULL,100,'1',0,1,1,'k2');
insert  into `m_pekerjaan_tma`(`id_pekerjaan_tma`,`nama_pekerjaan_tma`,`nominal_atas`,`nominal_bawah`,`nominal_default`,`satuan`,`tercetak_spat`,`status_pekerjaan`,`jenis`,`kodekolom`) values (3,'Upah Mandor',NULL,NULL,0,'1',0,0,1,'k3');
insert  into `m_pekerjaan_tma`(`id_pekerjaan_tma`,`nama_pekerjaan_tma`,`nominal_atas`,`nominal_bawah`,`nominal_default`,`satuan`,`tercetak_spat`,`status_pekerjaan`,`jenis`,`kodekolom`) values (4,'Briyet Tenaga',NULL,NULL,0,'1',0,0,1,'k4');
insert  into `m_pekerjaan_tma`(`id_pekerjaan_tma`,`nama_pekerjaan_tma`,`nominal_atas`,`nominal_bawah`,`nominal_default`,`satuan`,`tercetak_spat`,`status_pekerjaan`,`jenis`,`kodekolom`) values (5,'Tarikan Sapi',NULL,NULL,0,'1',0,0,1,'k5');
insert  into `m_pekerjaan_tma`(`id_pekerjaan_tma`,`nama_pekerjaan_tma`,`nominal_atas`,`nominal_bawah`,`nominal_default`,`satuan`,`tercetak_spat`,`status_pekerjaan`,`jenis`,`kodekolom`) values (6,'Pengerahan Tenaga Tebang',NULL,NULL,0,'1',0,0,1,'k6');
insert  into `m_pekerjaan_tma`(`id_pekerjaan_tma`,`nama_pekerjaan_tma`,`nominal_atas`,`nominal_bawah`,`nominal_default`,`satuan`,`tercetak_spat`,`status_pekerjaan`,`jenis`,`kodekolom`) values (7,'Pokok Lainya',NULL,NULL,0,'1',0,0,1,'k7');
insert  into `m_pekerjaan_tma`(`id_pekerjaan_tma`,`nama_pekerjaan_tma`,`nominal_atas`,`nominal_bawah`,`nominal_default`,`satuan`,`tercetak_spat`,`status_pekerjaan`,`jenis`,`kodekolom`) values (8,'Kebun Sulit',NULL,NULL,0,'1',1,1,1,'k8');
insert  into `m_pekerjaan_tma`(`id_pekerjaan_tma`,`nama_pekerjaan_tma`,`nominal_atas`,`nominal_bawah`,`nominal_default`,`satuan`,`tercetak_spat`,`status_pekerjaan`,`jenis`,`kodekolom`) values (9,'Rayutan / Tebu Roboh',NULL,NULL,0,'1',0,1,1,'k9');
insert  into `m_pekerjaan_tma`(`id_pekerjaan_tma`,`nama_pekerjaan_tma`,`nominal_atas`,`nominal_bawah`,`nominal_default`,`satuan`,`tercetak_spat`,`status_pekerjaan`,`jenis`,`kodekolom`) values (10,'Umbalan',NULL,NULL,0,'1',1,1,1,'k10');
insert  into `m_pekerjaan_tma`(`id_pekerjaan_tma`,`nama_pekerjaan_tma`,`nominal_atas`,`nominal_bawah`,`nominal_default`,`satuan`,`tercetak_spat`,`status_pekerjaan`,`jenis`,`kodekolom`) values (11,'Tambahan Briyet',NULL,NULL,0,'1',0,0,1,'k11');
insert  into `m_pekerjaan_tma`(`id_pekerjaan_tma`,`nama_pekerjaan_tma`,`nominal_atas`,`nominal_bawah`,`nominal_default`,`satuan`,`tercetak_spat`,`status_pekerjaan`,`jenis`,`kodekolom`) values (12,'Potongan Trash',NULL,NULL,3.5,'1',1,0,2,'k12');
insert  into `m_pekerjaan_tma`(`id_pekerjaan_tma`,`nama_pekerjaan_tma`,`nominal_atas`,`nominal_bawah`,`nominal_default`,`satuan`,`tercetak_spat`,`status_pekerjaan`,`jenis`,`kodekolom`) values (13,'Nila Bahan',NULL,NULL,0,'1',0,0,1,'k13');
insert  into `m_pekerjaan_tma`(`id_pekerjaan_tma`,`nama_pekerjaan_tma`,`nominal_atas`,`nominal_bawah`,`nominal_default`,`satuan`,`tercetak_spat`,`status_pekerjaan`,`jenis`,`kodekolom`) values (14,'Lain-lain',NULL,NULL,0,'1',0,0,1,'k14');
insert  into `m_pekerjaan_tma`(`id_pekerjaan_tma`,`nama_pekerjaan_tma`,`nominal_atas`,`nominal_bawah`,`nominal_default`,`satuan`,`tercetak_spat`,`status_pekerjaan`,`jenis`,`kodekolom`) values (15,'Pot UM Penebang',NULL,NULL,0,'1',0,1,2,'k15');
insert  into `m_pekerjaan_tma`(`id_pekerjaan_tma`,`nama_pekerjaan_tma`,`nominal_atas`,`nominal_bawah`,`nominal_default`,`satuan`,`tercetak_spat`,`status_pekerjaan`,`jenis`,`kodekolom`) values (16,'-',NULL,NULL,0,'1',0,2,2,'k16');
insert  into `m_pekerjaan_tma`(`id_pekerjaan_tma`,`nama_pekerjaan_tma`,`nominal_atas`,`nominal_bawah`,`nominal_default`,`satuan`,`tercetak_spat`,`status_pekerjaan`,`jenis`,`kodekolom`) values (17,'-',NULL,NULL,0,'1',0,2,2,'k17');
insert  into `m_pekerjaan_tma`(`id_pekerjaan_tma`,`nama_pekerjaan_tma`,`nominal_atas`,`nominal_bawah`,`nominal_default`,`satuan`,`tercetak_spat`,`status_pekerjaan`,`jenis`,`kodekolom`) values (18,'-',NULL,NULL,0,'1',0,2,2,'k18');
insert  into `m_pekerjaan_tma`(`id_pekerjaan_tma`,`nama_pekerjaan_tma`,`nominal_atas`,`nominal_bawah`,`nominal_default`,`satuan`,`tercetak_spat`,`status_pekerjaan`,`jenis`,`kodekolom`) values (19,'-',NULL,NULL,0,'1',0,2,2,'k19');
insert  into `m_pekerjaan_tma`(`id_pekerjaan_tma`,`nama_pekerjaan_tma`,`nominal_atas`,`nominal_bawah`,`nominal_default`,`satuan`,`tercetak_spat`,`status_pekerjaan`,`jenis`,`kodekolom`) values (20,'-',NULL,NULL,0,'1',0,2,2,'k20');

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
