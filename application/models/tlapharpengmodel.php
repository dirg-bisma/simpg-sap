<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Tlapharpengmodel extends SB_Model 
{

	public $table = 't_lap_harian_pengolahan';
	public $primaryKey = 'id_lap_harian_pengolahan';

	public function __construct() {
		parent::__construct();
		
	}

	public static function querySelect(  ){
		
		
		return "   SELECT t_lap_harian_pengolahan.* FROM t_lap_harian_pengolahan   ";
	}
	public static function queryWhere(  ){
		
		return "  WHERE t_lap_harian_pengolahan.id_lap_harian_pengolahan IS NOT NULL   ";
	}
	
	public static function queryGroup(){
		return "   ";
	}

	public function ByHariGiling($hari_giling, $tahun)
    {
        $qry = "SELECT * FROM t_lap_harian_pengolahan WHERE hari_giling = $hari_giling AND tahun_giling = $tahun";
        $result = $this->db->query($qry);
        return $result->row();
    }

    public function ByHariGilingSd($hari_giling, $tahun)
    {
        $qry = "SELECT 
                SUM(a.jam_berhenti_a) AS sum_jam_berhenti_a,
                SUM(a.jam_berhenti_b) AS sum_jam_berhenti_b,
                SUM(a.jam_kampanye) AS sum_jam_kampanye,
                SUM(a.kis) AS sum_kis,
                SUM(a.kes) AS sum_kes,
                SUM(a.prod_gula) AS sum_prod_gula,
                SUM(a.ex_sisan_gula) AS sum_ex_sisan_gula,
                SUM(a.sisan_diolah) AS sum_sisan_diolah,
                SUM(a.prod_tetes) AS sum_prod_tetes,
                SUM(a.ex_sisan_tetes) AS sum_ex_sisan_tetes,
                SUM(a.sto_tetes) AS sum_sto_tetes,
                SUM(a.ex_repro_tll) AS sum_ex_repro_tll,
                SUM(a.bba) AS sum_bba,
                SUM(a.rupiah_bba) AS sum_rupiah_bba,
                SUM(a.gula_repro_tll) AS sum_gula_repro_tll,
                SUM(a.raw_sugar) AS sum_raw_sugar,
                SUM(a.gula_repro_th_ini) AS sum_gula_repro_th_ini,
                SUM(a.ton_ampas) AS sum_ton_ampas,
                SUM(a.persen_pol_ampas) AS sum_persen_pol_ampas,
                SUM(a.ton_blotong) AS sum_ton_blotong,
                SUM(a.persen_pol_blotong) AS sum_persen_pol_blotong,
                SUM(a.ton_pol_dlm_hasil_plus_taksasi) AS sum_ton_pol_dlm_hasil_plus_taksasi,
                SUM(a.persen_pol_dlm_hasil_plus_taksasi) AS sum_persen_pol_dlm_hasil_plus_taksasi
                FROM t_lap_harian_pengolahan AS a
                WHERE hari_giling <= $hari_giling AND tahun_giling = $tahun";
        $result = $this->db->query($qry);
        return $result->row();
    }

	public function SumLapProTs($hari){
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
                WHERE a.hari_giling <= $hari AND kat_kepemilikan = 'TS' AND kode_kat_lahan != 'TS-TR'";
        $result = $this->db->query($qry);
        return $result->row();
	}

    public function lapProTs($hari){
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
                WHERE a.hari_giling = $hari AND kat_kepemilikan = 'TS' AND kode_kat_lahan != 'TS-TR'";
        $result = $this->db->query($qry);
        return $result->row();
    }

    public function SumLapProTsSdr($hari){
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
                WHERE a.hari_giling <= $hari AND kat_kepemilikan = 'TS' AND kode_kat_lahan = 'TS-TR'";
        $result = $this->db->query($qry);
        return $result->row();
    }

    public function lapProTsSdr($hari){
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
                WHERE a.hari_giling = $hari AND kat_kepemilikan = 'TS' AND kode_kat_lahan = 'TS-TR'";
        $result = $this->db->query($qry);
        return $result->row();
    }

    public function SumLapProTr($hari){
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
                WHERE a.hari_giling <= $hari AND kat_kepemilikan = 'TR' ";
        $result = $this->db->query($qry);
        return $result->row();
    }

    public function lapProTr($hari){
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
                WHERE a.hari_giling = $hari AND kat_kepemilikan = 'TR'";
        $result = $this->db->query($qry);
        return $result->row();
    }


}

?>
