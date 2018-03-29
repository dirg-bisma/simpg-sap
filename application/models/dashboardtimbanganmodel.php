<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

/**
 * Created by PhpStorm.
 * User: dirg
 * Date: 3/13/2018
 * Time: 5:02 PM
 */
class Dashboardtimbanganmodel extends CI_Model
{
    function __construct()
    {
    }

    public function AntrianTruk()
    {
        $qry = $this->QryDataSelektor() . " AND b.jenis_spta = 'TRUK' LIMIT 100";
        $result = $this->db->query($qry);
        $data = array();
        foreach ($result->result() as $tx){
            $data[] = array(
                'no' => $tx->no_urut,
                'no_spat' => $tx->no_spat,
                'no_angkutan' => $tx->no_angkutan,
                'tgl_selektor' => $tx->tgl_selektor,
                'bruto' => $tx->bruto,
                'timb_bruto_tgl' => $tx->timb_bruto_tgl,
                'waktu_tunggu' => $tx->waktu_tunggu,
                'jenis_spta' => $tx->jenis_spta,
            );
        }
        return $data;
    }

    public function AntrianLori()
    {
        $qry = $this->QryDataSelektor() . " AND b.jenis_spta = 'LORI' LIMIT 100";
        $result = $this->db->query($qry);
        $data = array();
        foreach ($result->result() as $tx){
            $data[] = array(
                'no' => $tx->no_urut,
                'no_spat' => $tx->no_spat,
                'no_angkutan' => $tx->no_angkutan,
                'tgl_selektor' => $tx->tgl_selektor,
                'no_trainstat' => $tx->no_trainstat,
                'jenis_spta' => $tx->jenis_spta,
            );
        }
        return $data;
    }

    public function DataCetakLori($trainstat, $noloko)
    {
        $qry = $this->QryDataCetakTimbang() . " AND b.jenis_spta = 'LORI' 
        AND a.no_trainstat = '$trainstat' AND c.no_loko = '$noloko'";
        $result = $this->db->query($qry)->result();
        return $result;
    }

    public function QryDataSelektor()
    {
        $qry = "SELECT a.`no_urut`, b.`no_spat`, a.`no_angkutan`,
                a.`tgl_selektor`, IFNULL(b.`timb_bruto_tgl`,'-') AS timb_bruto_tgl, IFNULL(c.`bruto`,0) AS bruto, b.`jenis_spta`,
                a.`no_trainstat`, a.`no_urut`, a.`no_urut_timbang`,
                IFNULL(CONCAT(
                FLOOR(HOUR(TIMEDIFF(NOW(), b.`timb_bruto_tgl`)) / 24), ' h ',
                MOD(HOUR(TIMEDIFF(NOW(), b.`timb_bruto_tgl`)), 24), ' j ',
                MINUTE(TIMEDIFF(NOW(), b.`timb_bruto_tgl`)), ' m'), '-') AS waktu_tunggu
                FROM t_selektor a
                INNER JOIN t_spta AS b ON b.id = a.`id_spta`
                LEFT JOIN t_timbangan AS c ON c.`id_spat` = a.`id_spta`
                WHERE NOT (b.`timb_netto_status` = 1) AND
                (a.`tgl_selektor` >= NOW() - INTERVAL 2 DAY)";

        return $qry;
    }

    public function QryDataCetakTimbang()
    {
        $qry = "SELECT a.`no_urut`, b.`no_spat`, a.`no_angkutan`,
                a.`tgl_selektor`, IFNULL(b.`timb_bruto_tgl`,'-') AS timb_bruto_tgl, 
                IFNULL(c.`bruto`,0) AS bruto,
                IFNULL(c.`tara`,0) AS tara,
                IFNULL(c.`netto`,0) AS netto,
                IFNULL(b.`timb_netto_tgl`, '-') AS timb_netto_tgl,
                b.`jenis_spta`, b.`kode_blok`, d.`deskripsi_blok`, d.`kepemilikan`, e.`nama_petani`,
                a.`no_trainstat`, c.`no_loko`, c.`no_lori`,a.`no_urut`, a.`no_urut_timbang`,
                IFNULL(CONCAT(
                FLOOR(HOUR(TIMEDIFF(b.`timb_netto_tgl`, b.`timb_bruto_tgl`)) / 24), ' hari ',
                MOD(HOUR(TIMEDIFF(b.`timb_netto_tgl`, b.`timb_bruto_tgl`)), 24), ':',
                MINUTE(TIMEDIFF(b.`timb_netto_tgl`, b.`timb_bruto_tgl`)), ''), '-') AS waktu_tunggu
                FROM t_selektor a
                INNER JOIN t_spta AS b ON b.id = a.`id_spta`
                LEFT JOIN t_timbangan AS c ON c.`id_spat` = a.`id_spta`
                INNER JOIN sap_field AS d  ON d.`kode_blok` = b.`kode_blok`
                LEFT JOIN `sap_petani` AS e ON e.`id_petani_sap` = d.`id_petani_sap` 
                WHERE (b.`timb_netto_status` = 1)  ";

        return $qry;
    }
}