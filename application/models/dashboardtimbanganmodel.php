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
                'bruto' => $tx->bruto,
                'jenis_spta' => $tx->jenis_spta,
            );
        }
        return $data;
    }

    public function QryDataSelektor()
    {
        $qry = "SELECT a.`no_urut`, b.`no_spat`,a.`no_angkutan`,a.`tgl_selektor`, IFNULL(c.`bruto`,0) AS bruto, b.`jenis_spta`
                FROM t_selektor a
                INNER JOIN t_spta AS b ON b.id = a.`id_spta`
                LEFT JOIN t_timbangan AS c ON c.`id_spat` = a.`id_spta`
                WHERE NOT (b.`timb_netto_status` = 1) AND
                (a.`tgl_selektor` >= NOW() - INTERVAL 1 DAY)";

        return $qry;
    }
}