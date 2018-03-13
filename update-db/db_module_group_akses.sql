/*
SQLyog Ultimate v12.09 (64 bit)
MySQL - 10.1.19-MariaDB : Database - db_simpg
*********************************************************************
*/

/*!40101 SET NAMES utf8 */;

/*!40101 SET SQL_MODE=''*/;

/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;
/*Table structure for table `tb_groups` */

DROP TABLE IF EXISTS `tb_groups`;

CREATE TABLE `tb_groups` (
  `group_id` mediumint(8) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(20) DEFAULT NULL,
  `description` varchar(100) DEFAULT NULL,
  `level` int(6) DEFAULT NULL,
  PRIMARY KEY (`group_id`) USING BTREE
) ENGINE=MyISAM AUTO_INCREMENT=14 DEFAULT CHARSET=utf8 ROW_FORMAT=DYNAMIC;

/*Data for the table `tb_groups` */

insert  into `tb_groups`(`group_id`,`name`,`description`,`level`) values (1,'Superadmin','Root Superadmin , should be as top level group',1);
insert  into `tb_groups`(`group_id`,`name`,`description`,`level`) values (2,'Op. Tanaman','Bagian Tanaman',2);
insert  into `tb_groups`(`group_id`,`name`,`description`,`level`) values (3,'Op. Meja Tebu','Operator Meja tebu',3);
insert  into `tb_groups`(`group_id`,`name`,`description`,`level`) values (4,'Op. Selektor','operator selektor',4);
insert  into `tb_groups`(`group_id`,`name`,`description`,`level`) values (6,'Op. Analisa','operator ari',4);
insert  into `tb_groups`(`group_id`,`name`,`description`,`level`) values (7,'Op. Pengolahan','pengolahan',3);
insert  into `tb_groups`(`group_id`,`name`,`description`,`level`) values (8,'Op. Timbangan','operator timbangan',4);
insert  into `tb_groups`(`group_id`,`name`,`description`,`level`) values (9,'Op. Keuangan','operator keuangan',4);
insert  into `tb_groups`(`group_id`,`name`,`description`,`level`) values (10,'Man. Pengolahan','Manajer Pengolahan',1);
insert  into `tb_groups`(`group_id`,`name`,`description`,`level`) values (11,'Man. Tanaman','Manajer Tanaman',1);
insert  into `tb_groups`(`group_id`,`name`,`description`,`level`) values (12,'Man. Aku','Manajer AKU',1);
insert  into `tb_groups`(`group_id`,`name`,`description`,`level`) values (13,'Man. QC','Manajer QC',1);

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
