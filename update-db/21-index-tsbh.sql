ALTER TABLE `t_selektor` CHANGE `id_selektor` `id_selektor` INT(11) NOT NULL AUTO_INCREMENT COMMENT ' ', ADD INDEX (`persno_mandor_tma`), ADD INDEX (`no_angkutan`);
ALTER TABLE `t_spta` DROP INDEX `join`, ADD INDEX `join` (`persno_pta`), ADD INDEX (`id_petani_sap`); 
ALTER TABLE `t_meja_tebu` ADD INDEX (`kondisi_tebu`);
ALTER TABLE `t_spta` ADD INDEX (`selektor_tgl`), ADD INDEX (`timb_netto_tgl`), ADD INDEX (`meja_tebu_tgl`); 
ALTER TABLE `m_rafaksi` ADD INDEX (`nilai`), ADD INDEX (`persen_rafaksi`); 