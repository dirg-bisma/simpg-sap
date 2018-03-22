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

    function getSbh($tgl)
    {
        $qry = $this->QueryStrSbh() . " AND date(a.aku_tgl) = '$tgl'";
        $result = $this->db->query($qry);
        return $result->result();
    }

    private function QueryStrSbh(){
        $company_code = CNF_COMPANYCODE;
        $sql = "SELECT
                a.no_spat, a.kode_kat_lahan, a.kode_plant, '$company_code' as company_code, a.kode_affd, a.kode_blok, a.tgl_spta, a.tebang_pg,
                a.angkut_pg, a.jenis_spta, a.no_angkutan, a.id_petani, a.nama_petani, a.deskripsi_blok, a.luas_ha, a.ha_tertebang, a.tgl_tebang,
                a.brix_sel, a.ph_sel, a.selektor_tgl, a.timb_netto_tgl, a.`meja_tebu_tgl` AS tgl_giling, a.tgl_giling, a.bruto,
                a.tara, a.netto_final, a.kondisi_tebu, date(a.aku_tgl) as tgl_periode, 
                a.terbakar, a.cacahan, a.brondolan, a.persen_brix_ari, a.persen_pol_ari, a.ph_ari, a.hk, a.nilai_nira, a.faktor_rendemen,
                a.rendemen_ari, a.hablur_ari, a.gula_total, a.tetes_total, a.rendemen_ptr, a.gula_ptr, a.tetes_ptr, a.gula_pg, a.tetes_pg
                FROM
                vw_sbh_data as a
                where sbh_status = 4";
        return $sql;
    }
}