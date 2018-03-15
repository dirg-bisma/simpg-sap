/*
SQLyog Ultimate v12.09 (64 bit)
MySQL - 10.1.10-MariaDB : Database - simpg_ptpn
*********************************************************************
*/

/*!40101 SET NAMES utf8 */;

/*!40101 SET SQL_MODE=''*/;

/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

ALTER TABLE t_spta ADD UNIQUE INDEX (no_spat);
ALTER TABLE `t_selektor` ADD UNIQUE INDEX (id_spta);
ALTER TABLE `t_timbangan` ADD UNIQUE INDEX (id_spat);
ALTER TABLE `t_meja_tebu` ADD UNIQUE INDEX (id_spta);
ALTER TABLE `t_ari` ADD UNIQUE INDEX (id_spta);
ALTER TABLE `t_upah_tebang_detail` ADD UNIQUE INDEX (id_spta);
ALTER TABLE `t_angkutan_detail` ADD UNIQUE INDEX (id_spta);

/* Trigger structure for table `sap_field_spt` */

DELIMITER $$

/*!50003 DROP TRIGGER*//*!50032 IF EXISTS */ /*!50003 `tr_spt_insert` */$$

/*!50003 CREATE */ /*!50003 TRIGGER `tr_spt_insert` AFTER INSERT ON `sap_field_spt` FOR EACH ROW BEGIN
	update sap_field set spt_status = 1, spt_tgl = now() where kode_blok = NEW.no_petak;
    END */$$


DELIMITER ;

/* Trigger structure for table `t_ari` */

DELIMITER $$

/*!50003 DROP TRIGGER*//*!50032 IF EXISTS */ /*!50003 `tr_ari_insert` */$$

/*!50003 CREATE */ /*!50003 TRIGGER `tr_ari_insert` AFTER INSERT ON `t_ari` FOR EACH ROW BEGIN
	declare nourut int;
	SELECT IFNULL(MAX(no_urut_analisa_rendemen),0)+1 into nourut FROM t_spta b WHERE date(ari_tgl)=date(NEW.tgl_ari);
	update t_spta set ari_status=if(NEW.ditolak_ari = 1,2,1),ari_tgl=NEW.tgl_ari,
	no_urut_analisa_rendemen = if(no_urut_analisa_rendemen=0,nourut,no_urut_analisa_rendemen) where id=NEW.id_spta;
    END */$$


DELIMITER ;

/* Trigger structure for table `t_meja_tebu` */

DELIMITER $$

/*!50003 DROP TRIGGER*//*!50032 IF EXISTS */ /*!50003 `tr_mejatebu_insert` */$$

/*!50003 CREATE */ /*!50003 TRIGGER `tr_mejatebu_insert` AFTER INSERT ON `t_meja_tebu` FOR EACH ROW BEGIN
	declare nourut int;
	declare nettostatus int;
	DECLARE temp_persen DOUBLE;
	DECLARE temp_tglmejatebu DATETIME;
	DECLARE temp_noblok VARCHAR(20);
	DECLARE temp_netto_final double;
	
	
	
	SELECT IFNULL(MAX(no_urut_analisa_rendemen),0)+1,timb_netto_status into nourut,nettostatus FROM t_meja_tebu a JOIN t_spta b ON a.id_spta=b.id WHERE gilingan=NEW.gilingan AND b.hari_giling=get_hari_giling();
	update t_spta set meja_tebu_status=1,meja_tebu_tgl=NEW.tgl_meja_tebu,hari_giling=get_hari_giling(),tgl_giling=get_tgl_giling(),
	no_urut_analisa_rendemen = IF(no_urut_analisa_rendemen=0,nourut,no_urut_analisa_rendemen)
	 where id=NEW.id_spta;
	 
	 if nettostatus = 1 then
		SELECT IF(a.`rafraksi_aktif`=1,b.`persen_rafaksi`,0) INTO temp_persen FROM t_meja_tebu a INNER JOIN m_rafaksi b ON a.`kondisi_tebu`=b.`nilai` WHERE a.id_spta = NEW.id_spta;
		update t_timbangan set netto_final = (netto - (temp_persen*netto/100)),
		netto_rafaksi = (temp_persen*netto/100),
		rafaksi_prosentis = temp_persen,
		tgl_rafaksi = now() where id_spat = NEW.id_spta; 
		SELECT kode_blok INTO temp_noblok FROM t_spta WHERE id=NEW.id_spta;
		
		SElect netto_final into temp_netto_final FROM t_timbangan WHERE id_spat = NEW.id_spta; 
		UPDATE sap_field SET total_tebang = (total_tebang+temp_netto_final) WHERE kode_blok=temp_noblok;
		
		
	 end if;
	 
	 
    END */$$


DELIMITER ;

/* Trigger structure for table `t_selektor` */

DELIMITER $$

/*!50003 DROP TRIGGER*//*!50032 IF EXISTS */ /*!50003 `tr_selektor_insert` */$$

/*!50003 CREATE */ /*!50003 TRIGGER `tr_selektor_insert` AFTER INSERT ON `t_selektor` FOR EACH ROW BEGIN
    declare temp_noblok varchar(20);
	
	update t_spta set selektor_status=if(NEW.ditolak_sel=1,2,1),selektor_tgl=NEW.tgl_selektor WHERE id=NEW.id_spta;
	 
    END */$$


DELIMITER ;

/* Trigger structure for table `t_selektor` */

DELIMITER $$

/*!50003 DROP TRIGGER*//*!50032 IF EXISTS */ /*!50003 `tr_selektor_update` */$$

/*!50003 CREATE */ /*!50003 TRIGGER `tr_selektor_update` AFTER UPDATE ON `t_selektor` FOR EACH ROW BEGIN
    DECLARE temp_noblok VARCHAR(20);
    if NEW.tanaman_status = 1 then
	SELECT kode_blok INTO temp_noblok FROM t_spta WHERE id=NEW.id_spta;
	UPDATE sap_field SET luas_tebang = luas_tebang+NEW.ha_tertebang WHERE kode_blok=temp_noblok;
    end if;
    END */$$


DELIMITER ;

/* Trigger structure for table `t_spta` */

DELIMITER $$

/*!50003 DROP TRIGGER*//*!50032 IF EXISTS */ /*!50003 `tr_gen_no_spta` */$$

/*!50003 CREATE */ /*!50003 TRIGGER `tr_gen_no_spta` BEFORE INSERT ON `t_spta` FOR EACH ROW BEGIN
	DECLARE nilaimax INT;
	SELECT IFNULL(MAX(RIGHT(no_spat,4))+1,1) into nilaimax FROM `t_spta` WHERE tgl_spta = NEW.tgl_spta;
	SET NEW.no_spat = CONCAT(NEW.kode_plant,'-',DATE_FORMAT(DATE(NEW.tgl_spta),'%d%m%Y'),'-',LPAD(nilaimax,4,'0'));
    END */$$


DELIMITER ;

/* Trigger structure for table `t_timbangan` */

DELIMITER $$

/*!50003 DROP TRIGGER*//*!50032 IF EXISTS */ /*!50003 `tr_timbangan_insert` */$$

/*!50003 CREATE */ /*!50003 TRIGGER `tr_timbangan_insert` AFTER INSERT ON `t_timbangan` FOR EACH ROW BEGIN
    DECLARE temp_noblok VARCHAR(20);
	if NEW.netto != 0 and NEW.bruto = 0 then
	/*jika timbang langsung netto*/
		SELECT kode_blok INTO temp_noblok FROM t_spta WHERE id=NEW.id_spat;
		update t_spta set timb_bruto_status=1,timb_bruto_tgl=NEW.tgl_bruto,timb_netto_status=1,timb_netto_tgl=NEW.tgl_netto where id = NEW.id_spat;
		
	elseif NEW.netto != 0 AND NEW.bruto != 0 THEN
	/*jika timbang langsung netto*/
		SELECT kode_blok INTO temp_noblok FROM t_spta WHERE id=NEW.id_spat;
		UPDATE t_spta SET timb_bruto_status=1,timb_bruto_tgl=NEW.tgl_bruto,timb_netto_status=1,timb_netto_tgl=NEW.tgl_netto WHERE id = NEW.id_spat;
		
	ELSEIF NEW.netto = 0 and NEW.bruto != 0 then
	/*jika timbang bruto - tara*/
		UPDATE t_spta SET timb_bruto_status=1,timb_bruto_tgl=NEW.tgl_bruto WHERE id = NEW.id_spat;
	end if;
    END */$$


DELIMITER ;

/* Trigger structure for table `t_timbangan` */

DELIMITER $$

/*!50003 DROP TRIGGER*//*!50032 IF EXISTS */ /*!50003 `tr_timbangan_update` */$$

/*!50003 CREATE */ /*!50003 TRIGGER `tr_timbangan_update` BEFORE UPDATE ON `t_timbangan` FOR EACH ROW BEGIN
    DECLARE temp_noblok VARCHAR(20);
    declare temp_persen double;
    declare temp_tglmejatebu datetime;
    DECLARE statusmejatebu int;
	if NEW.netto != 0 then
		SELECT kode_blok,meja_tebu_tgl,meja_tebu_status INTO temp_noblok,temp_tglmejatebu,statusmejatebu FROM t_spta WHERE id=NEW.id_spat;
		
		if statusmejatebu = 1 then
		SELECT IF(a.`rafraksi_aktif`=1,b.`persen_rafaksi`,0) into temp_persen FROM t_meja_tebu a INNER JOIN m_rafaksi b ON a.`kondisi_tebu`=b.`nilai` where a.id_spta = NEW.id_spat;
		UPDATE t_spta SET timb_netto_status=1,timb_netto_tgl=NEW.tgl_netto WHERE id = NEW.id_spat;
		set NEW.rafaksi_prosentis = temp_persen;
		SET NEW.netto_rafaksi = (NEW.netto*temp_persen)/100;
		set NEW.netto_final = NEW.netto -  (NEW.netto*temp_persen)/100;
		SET NEW.tgl_rafaksi = temp_tglmejatebu;
		UPDATE sap_field SET total_tebang = (total_tebang+NEW.netto_final) WHERE kode_blok=temp_noblok;
		end if;
	end if;
    END */$$


DELIMITER ;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
