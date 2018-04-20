<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

/**
 * Created by PhpStorm.
 * User: dirg
 * Date: 3/20/2018
 * Time: 4:16 PM
 */
class Apisapsbhmodel extends SB_Model
{
    public function __construct() {
        parent::__construct();

    }

    function getSbhBeetwen($tgl1, $tgl2)
    {
        $qry = $this->QueryStrSbh() . " AND date(tgl_giling) BETWEEN '$tgl1' AND '$tgl2'";
        $result = $this->db->query($qry);
        return $result->result();
    }

    function getSbh($tgl)
    {
        $qry = $this->QueryStrSbh() . " AND date(a.tgl_giling) = '$tgl'";
        $result = $this->db->query($qry);
        return $result->result();
    }

    private function QueryStrSbh(){
        $company_code = CNF_COMPANYCODE;
        $sql = "SELECT
                a.no_spat, a.kode_kat_lahan, a.kode_plant, '$company_code' AS company_code, a.kode_affd, a.kode_blok, a.tgl_spta, a.`cetak_spta_tgl`, a.tebang_pg,
                a.angkut_pg, a.jenis_spta, a.no_angkutan, b.`no_transloading`, a.id_petani, a.nama_petani, a.deskripsi_blok, a.luas_ha, a.ha_tertebang, a.tgl_tebang,
                a.brix_sel, a.ph_sel, a.selektor_tgl, a.timb_netto_tgl, a.`meja_tebu_tgl` AS tgl_jam_giling, a.tgl_giling,a.`hari_giling`, a.bruto,
                a.tara, a.netto_final, a.kondisi_tebu, DATE(a.aku_tgl) AS tgl_periode, 
                a.terbakar, a.cacahan, a.brondolan, a.persen_brix_ari, a.persen_pol_ari, a.ph_ari, a.hk, a.nilai_nira, a.faktor_rendemen,
                a.rendemen_ari, a.hablur_ari, a.gula_total, a.tetes_total, a.rendemen_ptr, a.gula_ptr, a.tetes_ptr, a.gula_pg, a.tetes_pg
                FROM
                vw_sbh_data AS a
                INNER JOIN t_timbangan AS b ON b.`id_spat` = a.`id`
                WHERE sbh_status = 4";
        return $sql;
    }
}