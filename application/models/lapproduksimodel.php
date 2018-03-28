<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Lapproduksimodel extends SB_Model
{

    public $table = 't_lap_produksi_pengolahan';
    public $primaryKey = 'id_laporan_produksi';

    public function __construct() {
        parent::__construct();

    }

    public static function querySelect(  ){


        return "   SELECT t_lap_produksi_pengolahan.* FROM t_lap_produksi_pengolahan   ";
    }
    public static function queryWhere(  ){

        return "  WHERE t_lap_produksi_pengolahan.id_laporan_produksi IS NOT NULL   ";
    }

    public static function queryGroup(){
        return "   ";
    }

    public function Insert($data)
    {
        $this->db->set($data);
        $this->db->insert('t_lap_produksi_pengolahan');
    }

    public function Update($kat, $hari_giling, $data)
    {
        $where = array(
            'hari_giling' => $hari_giling,
            'kat_ptpn' => $kat
        );
        $this->db->where($where);
        $this->db->update('t_lap_produksi_pengolahan', $data);
    }

    public function CekLaporanExist($kat, $hari_giling)
    {
        $sql = "SELECT COUNT(a.`id_laporan_produksi`) AS jumlah FROM `t_lap_produksi_pengolahan`AS a
                WHERE a.hari_giling = '$hari_giling' AND a.kat_ptpn = '$kat'";
        $result = $this->db->query($sql);
        $count = $result->row();
        return $count->jumlah;
    }

    public function getKodeKatBySpat($jenis)
    {
        $sql = "SELECT 
                  a.`kat_ptp` AS kode_kat_ptp
                FROM
                  `vw_spta_luas_field_sap_kat_ptp` AS a 
                WHERE a.`kat_ptp` IS NOT NULL AND  SUBSTRING(a.`kat_ptp`, 1, 2) = '$jenis'
                GROUP BY a.`kat_ptp` ";
        $result = $this->db->query($sql);
        return $result->result();
    }

    public function getKodeKatBySpatJenis($jenis)
    {
        $sql = "SELECT 
                  a.`kat_ptp` AS kode_kat_ptp
                FROM
                  `vw_spta_luas_field_sap_kat_ptp` AS a 
                WHERE a.`kat_ptp` IS NOT NULL AND  a.`kat_ptp` = '$jenis'
                GROUP BY a.`kat_ptp` ";
        $result = $this->db->query($sql);
        return $result->result();
    }

    public function getKodeKatAll()
    {
        $sql = "SELECT * FROM `m_kat_lahan_ptp`   
				ORDER BY id_kat_ptp";
        $result = $this->db->query($sql);
        return $result->result();
    }

    public function getKodeKat($jenis)
    {
        $sql = "SELECT * FROM `m_kat_lahan_ptp` 
				WHERE tipe_kat_lahan = '$jenis'    
				ORDER BY id_kat_ptp";
        $result = $this->db->query($sql);
        return $result->result();
    }

    public function getKodeKatNot($jenis)
    {
        $sql = "SELECT * FROM `m_kat_lahan_ptp` 
				WHERE tipe_kat_lahan = '$jenis' AND NOT (kode_kat_ptp = 'TS-TR' AND 
				kode_kat_ptp = 'TR-TK' AND 
				kode_kat_ptp = 'TR-TM')   
				ORDER BY id_kat_ptp";
        $result = $this->db->query($sql);
        return $result->result();
    }


    public function VwByKategoriByTimbangan($kategori, $hari)
    {
        $sql = "SELECT 
				a.kat_ptp,
				a.`hari_giling`,
				SUM(a.ha_tertebang_selektor) AS ha_tertebang_selektor,
				SUM(a.`luas_ditebang_field`) AS ha_tertebang_field,
				SUM(a.netto) AS netto
				FROM vw_spta_luas_field_sap_kat_ptp AS a
				WHERE a.`kat_ptp` = '$kategori' AND a.`hari_giling` = '$hari'
				AND a.timb_netto_status = 1
				GROUP BY kat_ptp";
        $result = $this->db->query($sql);
        return $result->row();
    }

    public function VwByKategoriByAri($kategori, $hari)
    {
        $sql = "SELECT 
				a.kat_ptp,
				SUM(a.ha_tertebang_selektor) AS ha_tertebang_selektor,
				SUM(a.`luas_ditebang_field`) AS ha_tertebang_field,
				a.`hari_giling`,
				SUM(a.netto) AS netto,
				SUM(a.gula_ptr) AS gula_ptr,
				SUM(a.tetes_ptr) AS tetes_ptr,
				SUM(a.hablur_ari) AS hablur,
                ROUND(((SUM(a.`hablur_ari`)/SUM(a.`netto`))*100), 2) AS rendemen_total
				FROM vw_spta_luas_field_sap_kat_ptp AS a
				WHERE a.`kat_ptp` = '$kategori' AND a.`hari_giling` = '$hari'
				AND a.ari_status = 1
				GROUP BY kat_ptp";
        $result = $this->db->query($sql);
        return $result->row();
    }

    public function SumLap($kat, $hari)
    {
        $qry = "SELECT 
                SUM(a.`ha_tertebang`) AS sum_ha_tertebang,
                SUM(a.`qty_tertebang`) AS sum_qty_tertebang,
                SUM(a.`ha_digiling`) AS sum_ha_digiiling,
                SUM(a.`qty_digiling`) AS sum_qty_digiling,
                SUM(a.`qty_kristal`) AS sum_qty_kristal,
                ROUND(((SUM(a.`qty_kristal`)/SUM(a.`qty_digiling`))*100), 2) AS total_rendemen,
                SUM(a.`qty_gula_ptr`) AS sum_qty_gula_ptr,
                SUM(a.qty_tetes_ptr) AS sum_qty_tetes_ptr
                 FROM `t_lap_produksi_pengolahan` AS a
                WHERE a.hari_giling < $hari AND a.kat_ptpn = '$kat'";
        $result = $this->db->query($qry);
        return $result->row();
    }
}

?>