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
/*Table structure for table `m_potongan_do` */

DROP TABLE IF EXISTS `m_potongan_do`;

CREATE TABLE `m_potongan_do` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `urutan` smallint(1) DEFAULT '0',
  `nama_potongan` varchar(100) DEFAULT '',
  `jenis_potongan` smallint(1) DEFAULT '0' COMMENT '0. basic 1. upah angkutan 2. upah tebangan 3. per kg tebu 4. per kg gula 90 5. per kg gula 10 6. pot auto pinjaman',
  `nominal` double(100,0) DEFAULT '0',
  `posisi` smallint(1) DEFAULT '0' COMMENT '0 kanan 1 kiri',
  `status` smallint(1) DEFAULT '1' COMMENT '1. aktif 2. non aktif',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=latin1;

/*Table structure for table `t_do` */

DROP TABLE IF EXISTS `t_do`;

CREATE TABLE `t_do` (
  `id` int(100) NOT NULL AUTO_INCREMENT,
  `no_do` varchar(120) DEFAULT '',
  `jenis_do` smallint(1) DEFAULT '0' COMMENT '0 SBH 1 SPT',
  `id_periode` int(100) DEFAULT NULL,
  `kode_blok` varchar(50) DEFAULT NULL,
  `id_petani_sap` varchar(50) DEFAULT NULL,
  `ha_tergiling` double(10,4) DEFAULT '0.0000',
  `ha_pokok` double(10,4) DEFAULT '0.0000',
  `netto_tebu` double(100,0) DEFAULT '0',
  `gula_100` double(100,2) DEFAULT NULL,
  `gula_90` double(100,2) DEFAULT NULL,
  `gula_10` double(100,0) DEFAULT NULL,
  `harga_gula` double(100,0) DEFAULT NULL,
  `berat_tetes` double(100,2) DEFAULT NULL,
  `harga_tetes` double(100,0) DEFAULT NULL,
  `total_pendapatan` double(100,0) DEFAULT NULL,
  `total_potongan` double(100,0) DEFAULT NULL,
  `total_pendapatan_bersih` double(100,0) DEFAULT NULL,
  `user_act` varchar(100) DEFAULT NULL,
  `tgl_act` datetime DEFAULT NULL,
  `status_do` smallint(1) DEFAULT '0' COMMENT '0. buat , 1. verif',
  `verif_act` varchar(100) DEFAULT NULL,
  `verif_date` datetime DEFAULT NULL,
  `cetak_do` smallint(1) DEFAULT '0',
  `tgl_cetak` datetime DEFAULT NULL,
  `is_natura` smallint(1) DEFAULT '0' COMMENT '0 tidak ada natura 1. ada natura',
  `cetak_natura` smallint(1) DEFAULT '0',
  `user_cetak_natura` varchar(100) DEFAULT NULL,
  `tgl_cetak_natura` datetime DEFAULT NULL,
  `no_bon_gudang` varchar(100) DEFAULT '' COMMENT 'otomatis generate',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Table structure for table `t_do_detail` */

DROP TABLE IF EXISTS `t_do_detail`;

CREATE TABLE `t_do_detail` (
  `id` int(50) NOT NULL AUTO_INCREMENT,
  `id_periode` int(20) DEFAULT NULL,
  `id_spta` int(100) DEFAULT NULL,
  `kode_blok` varchar(50) DEFAULT NULL,
  `kategori` varchar(5) DEFAULT NULL,
  `no_spta` varchar(50) DEFAULT NULL,
  `id_petani_sap` varchar(50) DEFAULT NULL,
  `netto_tebu` double(100,0) DEFAULT NULL,
  `tgl_spta` date DEFAULT NULL,
  `tgl_timbang` date DEFAULT NULL,
  `tgl_giling` date DEFAULT NULL,
  `no_kendaraan` varchar(100) DEFAULT NULL,
  `ha_tertebang` double(10,4) DEFAULT NULL,
  `pot_upah_tebang` double(100,0) DEFAULT NULL,
  `pot_upah_angkut` double(100,0) DEFAULT NULL,
  `kondisi_tebu` varchar(1) DEFAULT NULL,
  `rendemen` double(100,2) DEFAULT NULL,
  `gula_100` double(100,2) DEFAULT NULL,
  `gula_90` double(100,2) DEFAULT NULL,
  `gula_10` double(100,2) DEFAULT NULL,
  `tetes_ptr` double(100,2) DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `id_spta` (`id_spta`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Table structure for table `t_do_potongan` */

DROP TABLE IF EXISTS `t_do_potongan`;

CREATE TABLE `t_do_potongan` (
  `id` int(100) NOT NULL AUTO_INCREMENT,
  `id_do` int(100) DEFAULT NULL,
  `id_potongan` int(10) DEFAULT NULL,
  `nominal` double(100,0) DEFAULT NULL,
  `nama_potongan` varchar(100) DEFAULT NULL,
  `posisi` smallint(1) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Table structure for table `t_periode_do` */

DROP TABLE IF EXISTS `t_periode_do`;

CREATE TABLE `t_periode_do` (
  `id` int(100) NOT NULL AUTO_INCREMENT,
  `nama_periode` varchar(50) DEFAULT NULL,
  `tgl_awal` date DEFAULT NULL,
  `tgl_akhir` date DEFAULT NULL,
  `harga_gula` double(100,0) DEFAULT '0',
  `harga_tetes` double(100,0) DEFAULT '0',
  `fix_cost` double(100,0) DEFAULT '0',
  `variable_cost` double(100,0) DEFAULT '0',
  `netto_tebu_sbh` double(100,0) DEFAULT '0',
  `netto_tebu_spt` double(100,0) DEFAULT '0',
  `netto_tebu_total` double(100,0) DEFAULT '0',
  `gula_do_sbh` double(100,2) DEFAULT '0.00',
  `lembar_do_sbh` int(10) DEFAULT '0',
  `gula_natura_sbh` double(100,2) DEFAULT '0.00',
  `lembar_natura_sbh` int(10) DEFAULT '0',
  `gula_do_spt` double(100,2) DEFAULT '0.00',
  `lembar_do_spt` int(10) DEFAULT '0',
  `gula_natura_spt` double(100,2) DEFAULT '0.00',
  `lembar_natura_spt` int(10) DEFAULT '0',
  `rupiah_do_sbh` double(100,0) DEFAULT '0',
  `rupiah_do_spt` double(100,0) DEFAULT '0',
  `total_do` double(100,0) DEFAULT '0',
  `total_natura` double(100,0) DEFAULT '0',
  `tetes_spt` double(100,2) DEFAULT '0.00',
  `tetes_sbh` double(100,2) DEFAULT '0.00',
  `total_tetes` double(100,2) DEFAULT '0.00',
  `rupiah_total_tetes` double(100,0) DEFAULT '0',
  `tgl_act` datetime DEFAULT NULL,
  `user_act` varchar(100) DEFAULT '',
  `status` smallint(1) DEFAULT '0' COMMENT '0 open 1 close',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Table structure for table `vw_t_do` */

DROP TABLE IF EXISTS `vw_t_do`;

/*!50001 DROP VIEW IF EXISTS `vw_t_do` */;
/*!50001 DROP TABLE IF EXISTS `vw_t_do` */;

/*!50001 CREATE TABLE  `vw_t_do`(
 `id` int(100) ,
 `no_do` varchar(120) ,
 `jenis_do` smallint(1) ,
 `id_periode` int(100) ,
 `kode_blok` varchar(50) ,
 `id_petani_sap` varchar(50) ,
 `ha_tergiling` double(10,4) ,
 `ha_pokok` double(10,4) ,
 `netto_tebu` double(100,0) ,
 `gula_100` double(100,2) ,
 `gula_90` double(100,2) ,
 `gula_10` double(100,0) ,
 `harga_gula` double(100,0) ,
 `berat_tetes` double(100,2) ,
 `harga_tetes` double(100,0) ,
 `total_pendapatan` double(100,0) ,
 `total_potongan` double(100,0) ,
 `total_pendapatan_bersih` double(100,0) ,
 `user_act` varchar(100) ,
 `tgl_act` datetime ,
 `status_do` smallint(1) ,
 `verif_act` varchar(100) ,
 `verif_date` datetime ,
 `cetak_do` smallint(1) ,
 `tgl_cetak` datetime ,
 `is_natura` smallint(1) ,
 `cetak_natura` smallint(1) ,
 `user_cetak_natura` varchar(100) ,
 `tgl_cetak_natura` datetime ,
 `no_bon_gudang` varchar(100) ,
 `deskripsi_blok` varchar(255) ,
 `kepemilikan` varchar(6) ,
 `divisi` varchar(11) ,
 `nama_petani` varchar(255) ,
 `nama_periode` varchar(50) ,
 `tgl_awal` date ,
 `tgl_akhir` date 
)*/;

/*View structure for view vw_t_do */

/*!50001 DROP TABLE IF EXISTS `vw_t_do` */;
/*!50001 DROP VIEW IF EXISTS `vw_t_do` */;

/*!50001 CREATE ALGORITHM=UNDEFINED SQL SECURITY DEFINER VIEW `vw_t_do` AS (select `a`.`id` AS `id`,`a`.`no_do` AS `no_do`,`a`.`jenis_do` AS `jenis_do`,`a`.`id_periode` AS `id_periode`,`a`.`kode_blok` AS `kode_blok`,`a`.`id_petani_sap` AS `id_petani_sap`,`a`.`ha_tergiling` AS `ha_tergiling`,`a`.`ha_pokok` AS `ha_pokok`,`a`.`netto_tebu` AS `netto_tebu`,`a`.`gula_100` AS `gula_100`,`a`.`gula_90` AS `gula_90`,`a`.`gula_10` AS `gula_10`,`a`.`harga_gula` AS `harga_gula`,`a`.`berat_tetes` AS `berat_tetes`,`a`.`harga_tetes` AS `harga_tetes`,`a`.`total_pendapatan` AS `total_pendapatan`,`a`.`total_potongan` AS `total_potongan`,`a`.`total_pendapatan_bersih` AS `total_pendapatan_bersih`,`a`.`user_act` AS `user_act`,`a`.`tgl_act` AS `tgl_act`,`a`.`status_do` AS `status_do`,`a`.`verif_act` AS `verif_act`,`a`.`verif_date` AS `verif_date`,`a`.`cetak_do` AS `cetak_do`,`a`.`tgl_cetak` AS `tgl_cetak`,`a`.`is_natura` AS `is_natura`,`a`.`cetak_natura` AS `cetak_natura`,`a`.`user_cetak_natura` AS `user_cetak_natura`,`a`.`tgl_cetak_natura` AS `tgl_cetak_natura`,`a`.`no_bon_gudang` AS `no_bon_gudang`,`b`.`deskripsi_blok` AS `deskripsi_blok`,`b`.`kepemilikan` AS `kepemilikan`,`b`.`divisi` AS `divisi`,`c`.`nama_petani` AS `nama_petani`,`d`.`nama_periode` AS `nama_periode`,`d`.`tgl_awal` AS `tgl_awal`,`d`.`tgl_akhir` AS `tgl_akhir` from (((`t_do` `a` join `sap_field` `b` on((`a`.`kode_blok` = `b`.`kode_blok`))) join `sap_petani` `c` on((`c`.`id_petani_sap` = `a`.`id_petani_sap`))) join `t_periode_do` `d` on((`d`.`id` = `a`.`id_periode`)))) */;



insert into `tb_menu` ( `parent_id`, `module`, `url`, `menu_name`, `menu_type`, `role_id`, `deep`, `ordering`, `position`, `menu_icons`, `active`, `access_data`, `allow_guest`, `menu_lang`, `entry_by`) values('150','mpotongando','','Master Potongan','internal','0','0','1','sidebar','','1','{\"1\":\"1\",\"2\":\"0\",\"3\":\"0\",\"4\":\"0\",\"6\":\"0\",\"7\":\"0\",\"8\":\"0\",\"9\":\"1\",\"10\":\"0\",\"11\":\"0\",\"12\":\"1\",\"13\":\"0\",\"14\":\"0\",\"15\":\"0\",\"16\":\"0\"}','0',NULL,'22');
insert into `tb_menu` ( `parent_id`, `module`, `url`, `menu_name`, `menu_type`, `role_id`, `deep`, `ordering`, `position`, `menu_icons`, `active`, `access_data`, `allow_guest`, `menu_lang`, `entry_by`) values('150','tperiodegiling','','Pengaturan Periode','internal','0','0','2','sidebar','','1','{\"1\":\"1\",\"2\":\"0\",\"3\":\"0\",\"4\":\"0\",\"6\":\"0\",\"7\":\"0\",\"8\":\"0\",\"9\":\"1\",\"10\":\"0\",\"11\":\"0\",\"12\":\"1\",\"13\":\"0\",\"14\":\"0\",\"15\":\"0\",\"16\":\"0\"}','0',NULL,'22');
insert into `tb_menu` ( `parent_id`, `module`, `url`, `menu_name`, `menu_type`, `role_id`, `deep`, `ordering`, `position`, `menu_icons`, `active`, `access_data`, `allow_guest`, `menu_lang`, `entry_by`) values('150','tdo','','Proses Hasil','internal','0','0','3','sidebar','','1','{\"1\":\"1\",\"2\":\"0\",\"3\":\"0\",\"4\":\"0\",\"6\":\"0\",\"7\":\"0\",\"8\":\"0\",\"9\":\"1\",\"10\":\"0\",\"11\":\"0\",\"12\":\"1\",\"13\":\"0\",\"14\":\"0\",\"15\":\"0\",\"16\":\"0\"}','0',NULL,'22');

insert into `tb_groups_access` ( `group_id`, `module_id`, `access_data`) values('16','145','{\"is_global\":\"0\",\"is_view\":\"0\",\"is_detail\":\"0\",\"is_add\":\"0\",\"is_edit\":\"0\",\"is_remove\":\"0\",\"is_excel\":\"0\"}');
insert into `tb_groups_access` ( `group_id`, `module_id`, `access_data`) values('15','145','{\"is_global\":\"0\",\"is_view\":\"0\",\"is_detail\":\"0\",\"is_add\":\"0\",\"is_edit\":\"0\",\"is_remove\":\"0\",\"is_excel\":\"0\"}');
insert into `tb_groups_access` ( `group_id`, `module_id`, `access_data`) values('14','145','{\"is_global\":\"0\",\"is_view\":\"0\",\"is_detail\":\"0\",\"is_add\":\"0\",\"is_edit\":\"0\",\"is_remove\":\"0\",\"is_excel\":\"0\"}');
insert into `tb_groups_access` ( `group_id`, `module_id`, `access_data`) values('13','145','{\"is_global\":\"0\",\"is_view\":\"0\",\"is_detail\":\"0\",\"is_add\":\"0\",\"is_edit\":\"0\",\"is_remove\":\"0\",\"is_excel\":\"0\"}');
insert into `tb_groups_access` ( `group_id`, `module_id`, `access_data`) values('12','145','{\"is_global\":\"1\",\"is_view\":\"1\",\"is_detail\":\"1\",\"is_add\":\"1\",\"is_edit\":\"1\",\"is_remove\":\"1\",\"is_excel\":\"0\"}');
insert into `tb_groups_access` ( `group_id`, `module_id`, `access_data`) values('11','145','{\"is_global\":\"0\",\"is_view\":\"0\",\"is_detail\":\"0\",\"is_add\":\"0\",\"is_edit\":\"0\",\"is_remove\":\"0\",\"is_excel\":\"0\"}');
insert into `tb_groups_access` ( `group_id`, `module_id`, `access_data`) values('10','145','{\"is_global\":\"0\",\"is_view\":\"0\",\"is_detail\":\"0\",\"is_add\":\"0\",\"is_edit\":\"0\",\"is_remove\":\"0\",\"is_excel\":\"0\"}');
insert into `tb_groups_access` ( `group_id`, `module_id`, `access_data`) values('9','145','{\"is_global\":\"1\",\"is_view\":\"1\",\"is_detail\":\"1\",\"is_add\":\"1\",\"is_edit\":\"0\",\"is_remove\":\"0\",\"is_excel\":\"0\"}');
insert into `tb_groups_access` ( `group_id`, `module_id`, `access_data`) values('8','145','{\"is_global\":\"0\",\"is_view\":\"0\",\"is_detail\":\"0\",\"is_add\":\"0\",\"is_edit\":\"0\",\"is_remove\":\"0\",\"is_excel\":\"0\"}');
insert into `tb_groups_access` ( `group_id`, `module_id`, `access_data`) values('7','145','{\"is_global\":\"0\",\"is_view\":\"0\",\"is_detail\":\"0\",\"is_add\":\"0\",\"is_edit\":\"0\",\"is_remove\":\"0\",\"is_excel\":\"0\"}');
insert into `tb_groups_access` ( `group_id`, `module_id`, `access_data`) values('6','145','{\"is_global\":\"0\",\"is_view\":\"0\",\"is_detail\":\"0\",\"is_add\":\"0\",\"is_edit\":\"0\",\"is_remove\":\"0\",\"is_excel\":\"0\"}');
insert into `tb_groups_access` ( `group_id`, `module_id`, `access_data`) values('4','145','{\"is_global\":\"0\",\"is_view\":\"0\",\"is_detail\":\"0\",\"is_add\":\"0\",\"is_edit\":\"0\",\"is_remove\":\"0\",\"is_excel\":\"0\"}');
insert into `tb_groups_access` ( `group_id`, `module_id`, `access_data`) values('3','145','{\"is_global\":\"0\",\"is_view\":\"0\",\"is_detail\":\"0\",\"is_add\":\"0\",\"is_edit\":\"0\",\"is_remove\":\"0\",\"is_excel\":\"0\"}');
insert into `tb_groups_access` ( `group_id`, `module_id`, `access_data`) values('2','145','{\"is_global\":\"0\",\"is_view\":\"0\",\"is_detail\":\"0\",\"is_add\":\"0\",\"is_edit\":\"0\",\"is_remove\":\"0\",\"is_excel\":\"0\"}');
insert into `tb_groups_access` ( `group_id`, `module_id`, `access_data`) values('1','145','{\"is_global\":\"1\",\"is_view\":\"1\",\"is_detail\":\"1\",\"is_add\":\"1\",\"is_edit\":\"1\",\"is_remove\":\"1\",\"is_excel\":\"1\"}');
insert into `tb_groups_access` ( `group_id`, `module_id`, `access_data`) values('16','146','{\"is_global\":\"0\",\"is_view\":\"0\",\"is_detail\":\"0\",\"is_add\":\"0\",\"is_edit\":\"0\",\"is_remove\":\"0\",\"is_excel\":\"0\"}');
insert into `tb_groups_access` ( `group_id`, `module_id`, `access_data`) values('15','146','{\"is_global\":\"0\",\"is_view\":\"0\",\"is_detail\":\"0\",\"is_add\":\"0\",\"is_edit\":\"0\",\"is_remove\":\"0\",\"is_excel\":\"0\"}');
insert into `tb_groups_access` ( `group_id`, `module_id`, `access_data`) values('14','146','{\"is_global\":\"0\",\"is_view\":\"0\",\"is_detail\":\"0\",\"is_add\":\"0\",\"is_edit\":\"0\",\"is_remove\":\"0\",\"is_excel\":\"0\"}');
insert into `tb_groups_access` ( `group_id`, `module_id`, `access_data`) values('13','146','{\"is_global\":\"0\",\"is_view\":\"0\",\"is_detail\":\"0\",\"is_add\":\"0\",\"is_edit\":\"0\",\"is_remove\":\"0\",\"is_excel\":\"0\"}');
insert into `tb_groups_access` ( `group_id`, `module_id`, `access_data`) values('12','146','{\"is_global\":\"1\",\"is_view\":\"1\",\"is_detail\":\"1\",\"is_add\":\"1\",\"is_edit\":\"1\",\"is_remove\":\"1\",\"is_excel\":\"0\"}');
insert into `tb_groups_access` ( `group_id`, `module_id`, `access_data`) values('11','146','{\"is_global\":\"1\",\"is_view\":\"1\",\"is_detail\":\"1\",\"is_add\":\"0\",\"is_edit\":\"0\",\"is_remove\":\"0\",\"is_excel\":\"0\"}');
insert into `tb_groups_access` ( `group_id`, `module_id`, `access_data`) values('10','146','{\"is_global\":\"0\",\"is_view\":\"0\",\"is_detail\":\"0\",\"is_add\":\"0\",\"is_edit\":\"0\",\"is_remove\":\"0\",\"is_excel\":\"0\"}');
insert into `tb_groups_access` ( `group_id`, `module_id`, `access_data`) values('9','146','{\"is_global\":\"1\",\"is_view\":\"1\",\"is_detail\":\"1\",\"is_add\":\"1\",\"is_edit\":\"1\",\"is_remove\":\"1\",\"is_excel\":\"0\"}');
insert into `tb_groups_access` ( `group_id`, `module_id`, `access_data`) values('8','146','{\"is_global\":\"0\",\"is_view\":\"0\",\"is_detail\":\"0\",\"is_add\":\"0\",\"is_edit\":\"0\",\"is_remove\":\"0\",\"is_excel\":\"0\"}');
insert into `tb_groups_access` ( `group_id`, `module_id`, `access_data`) values('7','146','{\"is_global\":\"0\",\"is_view\":\"0\",\"is_detail\":\"0\",\"is_add\":\"0\",\"is_edit\":\"0\",\"is_remove\":\"0\",\"is_excel\":\"0\"}');
insert into `tb_groups_access` ( `group_id`, `module_id`, `access_data`) values('6','146','{\"is_global\":\"0\",\"is_view\":\"0\",\"is_detail\":\"0\",\"is_add\":\"0\",\"is_edit\":\"0\",\"is_remove\":\"0\",\"is_excel\":\"0\"}');
insert into `tb_groups_access` ( `group_id`, `module_id`, `access_data`) values('4','146','{\"is_global\":\"0\",\"is_view\":\"0\",\"is_detail\":\"0\",\"is_add\":\"0\",\"is_edit\":\"0\",\"is_remove\":\"0\",\"is_excel\":\"0\"}');
insert into `tb_groups_access` ( `group_id`, `module_id`, `access_data`) values('3','146','{\"is_global\":\"0\",\"is_view\":\"0\",\"is_detail\":\"0\",\"is_add\":\"0\",\"is_edit\":\"0\",\"is_remove\":\"0\",\"is_excel\":\"0\"}');
insert into `tb_groups_access` ( `group_id`, `module_id`, `access_data`) values('2','146','{\"is_global\":\"0\",\"is_view\":\"0\",\"is_detail\":\"0\",\"is_add\":\"0\",\"is_edit\":\"0\",\"is_remove\":\"0\",\"is_excel\":\"0\"}');
insert into `tb_groups_access` ( `group_id`, `module_id`, `access_data`) values('1','146','{\"is_global\":\"1\",\"is_view\":\"1\",\"is_detail\":\"1\",\"is_add\":\"1\",\"is_edit\":\"1\",\"is_remove\":\"1\",\"is_excel\":\"0\"}');
insert into `tb_groups_access` ( `group_id`, `module_id`, `access_data`) values('16','148','{\"is_global\":\"0\",\"is_view\":\"0\",\"is_detail\":\"0\",\"is_add\":\"0\",\"is_edit\":\"0\",\"is_remove\":\"0\",\"is_excel\":\"0\"}');
insert into `tb_groups_access` ( `group_id`, `module_id`, `access_data`) values('15','148','{\"is_global\":\"0\",\"is_view\":\"0\",\"is_detail\":\"0\",\"is_add\":\"0\",\"is_edit\":\"0\",\"is_remove\":\"0\",\"is_excel\":\"0\"}');
insert into `tb_groups_access` ( `group_id`, `module_id`, `access_data`) values('14','148','{\"is_global\":\"0\",\"is_view\":\"0\",\"is_detail\":\"0\",\"is_add\":\"0\",\"is_edit\":\"0\",\"is_remove\":\"0\",\"is_excel\":\"0\"}');
insert into `tb_groups_access` ( `group_id`, `module_id`, `access_data`) values('13','148','{\"is_global\":\"0\",\"is_view\":\"0\",\"is_detail\":\"0\",\"is_add\":\"0\",\"is_edit\":\"0\",\"is_remove\":\"0\",\"is_excel\":\"0\"}');
insert into `tb_groups_access` ( `group_id`, `module_id`, `access_data`) values('12','148','{\"is_global\":\"1\",\"is_view\":\"1\",\"is_detail\":\"1\",\"is_add\":\"1\",\"is_edit\":\"1\",\"is_remove\":\"1\",\"is_excel\":\"0\"}');
insert into `tb_groups_access` ( `group_id`, `module_id`, `access_data`) values('11','148','{\"is_global\":\"0\",\"is_view\":\"0\",\"is_detail\":\"0\",\"is_add\":\"0\",\"is_edit\":\"0\",\"is_remove\":\"0\",\"is_excel\":\"0\"}');
insert into `tb_groups_access` ( `group_id`, `module_id`, `access_data`) values('10','148','{\"is_global\":\"0\",\"is_view\":\"0\",\"is_detail\":\"0\",\"is_add\":\"0\",\"is_edit\":\"0\",\"is_remove\":\"0\",\"is_excel\":\"0\"}');
insert into `tb_groups_access` ( `group_id`, `module_id`, `access_data`) values('9','148','{\"is_global\":\"0\",\"is_view\":\"0\",\"is_detail\":\"0\",\"is_add\":\"0\",\"is_edit\":\"0\",\"is_remove\":\"0\",\"is_excel\":\"0\"}');
insert into `tb_groups_access` ( `group_id`, `module_id`, `access_data`) values('8','148','{\"is_global\":\"0\",\"is_view\":\"0\",\"is_detail\":\"0\",\"is_add\":\"0\",\"is_edit\":\"0\",\"is_remove\":\"0\",\"is_excel\":\"0\"}');
insert into `tb_groups_access` ( `group_id`, `module_id`, `access_data`) values('7','148','{\"is_global\":\"1\",\"is_view\":\"1\",\"is_detail\":\"1\",\"is_add\":\"1\",\"is_edit\":\"1\",\"is_remove\":\"1\",\"is_excel\":\"0\"}');
insert into `tb_groups_access` ( `group_id`, `module_id`, `access_data`) values('6','148','{\"is_global\":\"0\",\"is_view\":\"0\",\"is_detail\":\"0\",\"is_add\":\"0\",\"is_edit\":\"0\",\"is_remove\":\"0\",\"is_excel\":\"0\"}');
insert into `tb_groups_access` ( `group_id`, `module_id`, `access_data`) values('4','148','{\"is_global\":\"0\",\"is_view\":\"0\",\"is_detail\":\"0\",\"is_add\":\"0\",\"is_edit\":\"0\",\"is_remove\":\"0\",\"is_excel\":\"0\"}');
insert into `tb_groups_access` ( `group_id`, `module_id`, `access_data`) values('3','148','{\"is_global\":\"0\",\"is_view\":\"0\",\"is_detail\":\"0\",\"is_add\":\"0\",\"is_edit\":\"0\",\"is_remove\":\"0\",\"is_excel\":\"0\"}');
insert into `tb_groups_access` ( `group_id`, `module_id`, `access_data`) values('2','148','{\"is_global\":\"0\",\"is_view\":\"0\",\"is_detail\":\"0\",\"is_add\":\"0\",\"is_edit\":\"0\",\"is_remove\":\"0\",\"is_excel\":\"0\"}');
insert into `tb_groups_access` ( `group_id`, `module_id`, `access_data`) values('1','148','{\"is_global\":\"1\",\"is_view\":\"1\",\"is_detail\":\"1\",\"is_add\":\"1\",\"is_edit\":\"1\",\"is_remove\":\"1\",\"is_excel\":\"1\"}');

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
