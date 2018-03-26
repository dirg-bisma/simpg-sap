/*
SQLyog Ultimate v12.09 (64 bit)
MySQL - 5.5.44-0+deb7u1 : Database - gen_simpg_2018
*********************************************************************
*/

/*!40101 SET NAMES utf8 */;

/*!40101 SET SQL_MODE=''*/;

/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;
/*Table structure for table `tb_users` */

DROP TABLE IF EXISTS `tb_users`;

CREATE TABLE `tb_users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `group_id` int(6) DEFAULT NULL,
  `username` varchar(100) NOT NULL,
  `password` varchar(64) NOT NULL,
  `email` varchar(100) NOT NULL,
  `first_name` varchar(50) DEFAULT NULL,
  `last_name` varchar(50) DEFAULT NULL,
  `avatar` varchar(100) DEFAULT NULL,
  `active` tinyint(1) unsigned DEFAULT NULL,
  `login_attempt` tinyint(2) DEFAULT '0',
  `last_login` datetime DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT NULL,
  `reminder` varchar(64) DEFAULT NULL,
  `activation` varchar(50) DEFAULT NULL,
  `remember_token` varchar(100) DEFAULT NULL,
  `alamat` text,
  `notlp` varchar(20) DEFAULT NULL,
  `website` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE=MyISAM AUTO_INCREMENT=33 DEFAULT CHARSET=utf8 ROW_FORMAT=DYNAMIC;

/*Data for the table `tb_users` */

insert  into `tb_users`(`id`,`group_id`,`username`,`password`,`email`,`first_name`,`last_name`,`avatar`,`active`,`login_attempt`,`last_login`,`created_at`,`updated_at`,`reminder`,`activation`,`remember_token`,`alamat`,`notlp`,`website`) values (24,2,'optanaman','ae330ea92740001fc2326495f8361182','viddy@gending.co.id','optanaman','gending',NULL,1,0,'2018-03-26 13:06:37','2018-02-27 09:05:44',NULL,NULL,NULL,NULL,'','','');
insert  into `tb_users`(`id`,`group_id`,`username`,`password`,`email`,`first_name`,`last_name`,`avatar`,`active`,`login_attempt`,`last_login`,`created_at`,`updated_at`,`reminder`,`activation`,`remember_token`,`alamat`,`notlp`,`website`) values (23,8,'optimbangan','e10adc3949ba59abbe56e057f20f883e','ferdy.kruak@gmail.com','Operator Timbangan','-',NULL,1,0,'2018-03-26 13:03:43','2018-02-20 02:32:23',NULL,NULL,NULL,NULL,'','','');
insert  into `tb_users`(`id`,`group_id`,`username`,`password`,`email`,`first_name`,`last_name`,`avatar`,`active`,`login_attempt`,`last_login`,`created_at`,`updated_at`,`reminder`,`activation`,`remember_token`,`alamat`,`notlp`,`website`) values (22,1,'admin','6797f82f504379e72c59879b12594d39','m@gmail.com','Admin','SIMPG',NULL,1,0,'2018-03-26 15:26:29','2017-06-04 12:07:08',NULL,NULL,NULL,NULL,NULL,NULL,NULL);
insert  into `tb_users`(`id`,`group_id`,`username`,`password`,`email`,`first_name`,`last_name`,`avatar`,`active`,`login_attempt`,`last_login`,`created_at`,`updated_at`,`reminder`,`activation`,`remember_token`,`alamat`,`notlp`,`website`) values (25,4,'opselektor','23d6b8f2816bb99c8bcb7420be7a8e52','selektor@gending.co.id','opselektor','gending',NULL,1,0,'2018-03-26 12:20:46','2018-03-26 10:28:29',NULL,NULL,NULL,NULL,'','','');
insert  into `tb_users`(`id`,`group_id`,`username`,`password`,`email`,`first_name`,`last_name`,`avatar`,`active`,`login_attempt`,`last_login`,`created_at`,`updated_at`,`reminder`,`activation`,`remember_token`,`alamat`,`notlp`,`website`) values (26,6,'opari','48d8647ff925daa70f6c3579e19972ae','ari@gending.co.id','opari','gending',NULL,1,0,'2018-03-26 12:45:53','2018-03-26 10:30:37',NULL,NULL,NULL,NULL,'','','');
insert  into `tb_users`(`id`,`group_id`,`username`,`password`,`email`,`first_name`,`last_name`,`avatar`,`active`,`login_attempt`,`last_login`,`created_at`,`updated_at`,`reminder`,`activation`,`remember_token`,`alamat`,`notlp`,`website`) values (27,3,'opmejatebu','58eed6e38fc6e2d67c24d2c9c0183462','mejatebu@gending.co.id','opmejatebu','gending',NULL,1,0,'2018-03-26 12:43:45','2018-03-26 11:00:15',NULL,NULL,NULL,NULL,'','','');
insert  into `tb_users`(`id`,`group_id`,`username`,`password`,`email`,`first_name`,`last_name`,`avatar`,`active`,`login_attempt`,`last_login`,`created_at`,`updated_at`,`reminder`,`activation`,`remember_token`,`alamat`,`notlp`,`website`) values (28,9,'opaku','544e73ab44cb20f22ca7a74bd7c0581e','aku@gending.co.id','opaku','gending',NULL,1,0,'2018-03-26 14:40:50','2018-03-26 11:33:43',NULL,NULL,NULL,NULL,'','','');
insert  into `tb_users`(`id`,`group_id`,`username`,`password`,`email`,`first_name`,`last_name`,`avatar`,`active`,`login_attempt`,`last_login`,`created_at`,`updated_at`,`reminder`,`activation`,`remember_token`,`alamat`,`notlp`,`website`) values (29,7,'oppengolahan','1950f96514e175928f0ff52cd7258b03','pengolahan@gending.com','oppengolahan','gending',NULL,1,0,'2018-03-26 13:03:16','2018-03-26 12:49:59',NULL,NULL,NULL,NULL,'','','');
insert  into `tb_users`(`id`,`group_id`,`username`,`password`,`email`,`first_name`,`last_name`,`avatar`,`active`,`login_attempt`,`last_login`,`created_at`,`updated_at`,`reminder`,`activation`,`remember_token`,`alamat`,`notlp`,`website`) values (30,10,'manpengolahan','59dfc5a1665ceeed7286ab17a8dfbc58','pengolahan@gending.com','manpengolahan','gending',NULL,1,0,'2018-03-26 13:41:03','2018-03-26 12:50:53',NULL,NULL,NULL,NULL,'','','');
insert  into `tb_users`(`id`,`group_id`,`username`,`password`,`email`,`first_name`,`last_name`,`avatar`,`active`,`login_attempt`,`last_login`,`created_at`,`updated_at`,`reminder`,`activation`,`remember_token`,`alamat`,`notlp`,`website`) values (31,11,'mantanaman','bead0df270a51ef70dfb9c155948454b','manpengolahan@gending.com','mantanaman','gending',NULL,1,0,NULL,'2018-03-26 12:51:42',NULL,NULL,NULL,NULL,'','','');
insert  into `tb_users`(`id`,`group_id`,`username`,`password`,`email`,`first_name`,`last_name`,`avatar`,`active`,`login_attempt`,`last_login`,`created_at`,`updated_at`,`reminder`,`activation`,`remember_token`,`alamat`,`notlp`,`website`) values (32,12,'manaku','bf4dfc9c32ce7d5d739b896eb0588ac2','manaku@gending.com','manaku','manaku',NULL,1,0,NULL,'2018-03-26 12:52:09',NULL,NULL,NULL,NULL,'','','');

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
