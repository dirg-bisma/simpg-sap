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
	SELECT IFNULL(MAX(no_urut_analisa_rendemen),0)+1 into nourut FROM t_meja_tebu a JOIN t_spta b ON a.id_spta=b.id WHERE gilingan=NEW.gilingan AND b.hari_giling=get_hari_giling();
	update t_spta set meja_tebu_status=1,meja_tebu_tgl=NEW.tgl_meja_tebu,hari_giling=get_hari_giling(),tgl_giling=get_tgl_giling(),
	no_urut_analisa_rendemen = IF(no_urut_analisa_rendemen=0,nourut,no_urut_analisa_rendemen)
	 where id=NEW.id_spta;
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
		UPDATE sap_field SET total_tebang = (total_tebang+NEW.netto_final) WHERE kode_blok=temp_noblok;
	elseif NEW.netto != 0 AND NEW.bruto != 0 THEN
	/*jika timbang langsung netto*/
	
	
		SELECT kode_blok INTO temp_noblok FROM t_spta WHERE id=NEW.id_spat;
		UPDATE t_spta SET timb_bruto_status=1,timb_bruto_tgl=NEW.tgl_bruto,timb_netto_status=1,timb_netto_tgl=NEW.tgl_netto WHERE id = NEW.id_spat;
		UPDATE sap_field SET total_tebang = (total_tebang+NEW.netto_final) WHERE kode_blok=temp_noblok;
	ELSEIF NEW.netto = 0 and NEW.bruto != 0 then
	/*jika timbang bruto - tara*/
		UPDATE t_spta SET timb_bruto_status=1,timb_bruto_tgl=NEW.tgl_bruto WHERE id = NEW.id_spat;
	end if;
    END */$$


DELIMITER ;

/* Trigger structure for table `t_timbangan` */

DELIMITER $$

/*!50003 DROP TRIGGER*//*!50032 IF EXISTS */ /*!50003 `tr_timbangan_update` */$$

/*!50003 CREATE */ /*!50003 TRIGGER `tr_timbangan_update` AFTER UPDATE ON `t_timbangan` FOR EACH ROW BEGIN
    DECLARE temp_noblok VARCHAR(20);
	if NEW.netto != 0 then
		SELECT kode_blok INTO temp_noblok FROM t_spta WHERE id=NEW.id_spat;
		UPDATE t_spta SET timb_netto_status=1,timb_netto_tgl=NEW.tgl_netto WHERE id = NEW.id_spat;
		UPDATE sap_field SET total_tebang = (total_tebang-OLD.netto_final)+NEW.netto_final WHERE kode_blok=temp_noblok;
	end if;
    END */$$


DELIMITER ;

/* Function  structure for function  `get_hablur_ari` */

/*!50003 DROP FUNCTION IF EXISTS `get_hablur_ari` */;
DELIMITER $$

/*!50003 CREATE FUNCTION `get_hablur_ari`(netto double,rendemen double(10,2)) RETURNS double
BEGIN
    declare hasil double;
    set hasil = netto*rendemen/100;
	return ROUND_UP(hasil,2);
    END */$$
DELIMITER ;

/* Function  structure for function  `get_hari_giling` */

/*!50003 DROP FUNCTION IF EXISTS `get_hari_giling` */;
DELIMITER $$

/*!50003 CREATE FUNCTION `get_hari_giling`() RETURNS int(11)
BEGIN
	declare hargil int;
	declare temptgl date;
	declare temphargil int;
	
	select ifnull(max(tgl_giling),get_tgl_giling()) into temptgl from t_spta;
	
	set temphargil = datediff(get_tgl_giling(),temptgl);
	if temphargil = 0 then
		set temphargil = 1;
	end if;
	
	SELECT IFNULL(MAX(hari_giling),(SELECT IFNULL(MAX(hari_giling),0) FROM t_spta)+temphargil) into hargil FROM t_spta WHERE tgl_giling=get_tgl_giling();
	return hargil;
    END */$$
DELIMITER ;

/* Function  structure for function  `get_rendemen_bagihasil_ptr` */

/*!50003 DROP FUNCTION IF EXISTS `get_rendemen_bagihasil_ptr` */;
DELIMITER $$

/*!50003 CREATE FUNCTION `get_rendemen_bagihasil_ptr`( vkat varchar(2), vrendemen double(10,2)) RETURNS double(10,4)
BEGIN
	/* jika rendemen < = 6 bagihasil = 66 % */
	/* jika rendemen >  6 bagihasil = 66 % dan < = 7.99 => 66% + (selisih dari 6 * 70%)*/
	/* jika rendemen >=  8 bagihasil =  66% + (selisih dari 6 * 75%)*/
	declare hslrendemen double(10,4);
	DECLARE temphslrendemen1 DOUBLE(10,4);
	DECLARE temphslrendemen2 DOUBLE(10,4);
	DECLARE temphslrendemen3 DOUBLE(10,4);
	declare selisih double(10,2);
	
	
	if vkat = 'TR' then
	if vrendemen <= 6 then
		set hslrendemen = vrendemen * 66 / 100;
	elseif vrendemen > 6 and vrendemen <= 8 then
		set temphslrendemen1  = 6.00 * 66 / 100;
		set selisih = vrendemen - 6.00;
		SET temphslrendemen2  = selisih * 70 / 100;
		set hslrendemen = temphslrendemen1+temphslrendemen2;
	elseif vrendemen > 8 then
		SET temphslrendemen1  = 6.00 * 66 / 100;
		set temphslrendemen2 = 2.00 * 70 / 100;
		SET selisih = vrendemen - 8.00;
		SET temphslrendemen3  = selisih * 75 / 100;
		SET hslrendemen = temphslrendemen1+temphslrendemen2+temphslrendemen3;
	end if;
	else
	 set hslrendemen = 0;
	end if;
	
	return hslrendemen;
    END */$$
DELIMITER ;

/* Function  structure for function  `get_tgl_giling` */

/*!50003 DROP FUNCTION IF EXISTS `get_tgl_giling` */;
DELIMITER $$

/*!50003 CREATE FUNCTION `get_tgl_giling`() RETURNS date
BEGIN
	DECLARE tgl date;
	SELECT IF(STR_TO_DATE(now(),'%Y-%m-%d %H:%i:%s') < STR_TO_DATE(CONCAT(DATE(now()),' 06:59:59'),'%Y-%m-%d %H:%i:%s'),
STR_TO_DATE(NOW(),'%Y-%m-%d') - INTERVAL 1 DAY, STR_TO_DATE(NOW(),'%Y-%m-%d')) into tgl;
	return tgl;
    END */$$
DELIMITER ;

/* Function  structure for function  `ROUND_UP` */

/*!50003 DROP FUNCTION IF EXISTS `ROUND_UP` */;
DELIMITER $$

/*!50003 CREATE FUNCTION `ROUND_UP`(num DECIMAL(32,16), places INT) RETURNS decimal(32,2)
    DETERMINISTIC
RETURN CASE WHEN num < 0
THEN - ceil(abs(num) * power(10, places)) / power(10, places)
ELSE ceil(abs(num) * power(10, places)) / power(10, places)
END */$$
DELIMITER ;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
