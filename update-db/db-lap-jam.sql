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
/*Table structure for table `t_lap_jam` */

DROP TABLE IF EXISTS `t_lap_jam`;

CREATE TABLE `t_lap_jam` (
  `id` int(20) NOT NULL AUTO_INCREMENT,
  `jam` varchar(2) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=27 DEFAULT CHARSET=latin1;

/*Data for the table `t_lap_jam` */

insert  into `t_lap_jam`(`id`,`jam`) values (1,'06');
insert  into `t_lap_jam`(`id`,`jam`) values (2,'07');
insert  into `t_lap_jam`(`id`,`jam`) values (3,'08');
insert  into `t_lap_jam`(`id`,`jam`) values (4,'09');
insert  into `t_lap_jam`(`id`,`jam`) values (5,'10');
insert  into `t_lap_jam`(`id`,`jam`) values (6,'11');
insert  into `t_lap_jam`(`id`,`jam`) values (7,'12');
insert  into `t_lap_jam`(`id`,`jam`) values (8,'13');
insert  into `t_lap_jam`(`id`,`jam`) values (9,'14');
insert  into `t_lap_jam`(`id`,`jam`) values (10,'15');
insert  into `t_lap_jam`(`id`,`jam`) values (11,'16');
insert  into `t_lap_jam`(`id`,`jam`) values (12,'17');
insert  into `t_lap_jam`(`id`,`jam`) values (13,'18');
insert  into `t_lap_jam`(`id`,`jam`) values (14,'19');
insert  into `t_lap_jam`(`id`,`jam`) values (15,'20');
insert  into `t_lap_jam`(`id`,`jam`) values (16,'21');
insert  into `t_lap_jam`(`id`,`jam`) values (17,'22');
insert  into `t_lap_jam`(`id`,`jam`) values (18,'23');
insert  into `t_lap_jam`(`id`,`jam`) values (19,'00');
insert  into `t_lap_jam`(`id`,`jam`) values (20,'01');
insert  into `t_lap_jam`(`id`,`jam`) values (21,'02');
insert  into `t_lap_jam`(`id`,`jam`) values (22,'03');
insert  into `t_lap_jam`(`id`,`jam`) values (23,'04');
insert  into `t_lap_jam`(`id`,`jam`) values (24,'05');

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
