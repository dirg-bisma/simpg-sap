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
		else
		UPDATE t_spta SET timb_netto_status=1,timb_netto_tgl=NEW.tgl_netto WHERE id = NEW.id_spat;
		UPDATE sap_field SET total_tebang = (total_tebang+NEW.netto_final) WHERE kode_blok=temp_noblok;
		end if;
	end if;
    END */$$


DELIMITER ;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
