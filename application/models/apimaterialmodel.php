<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

/**
 * Created by PhpStorm.
 * User: dirg
 * Date: 3/24/2018
 * Time: 2:29 PM
 */
class apimaterialmodel extends SB_Model
{
    public function __construct() {
        parent::__construct();
    }

    public function getMaterial($search)
    {
        $sql = "SELECT a.* FROM m_material AS a WHERE a.`kode_material` LIKE '%$search%' OR a.`nama_material` LIKE '%$search%'";

        $result = $this->db->query($sql);
        return $result->result();
    }

    public function getMaterialAll()
    {
        $sql = "SELECT a.* FROM m_material AS a";

        $result = $this->db->query($sql);
        return $result->result();
    }

    public function getRelasi($search)
    {
        $sql = "SELECT a.* FROM m_relasi AS a WHERE a.`kode_relasi` LIKE '%$search%' OR a.`nama_relasi` LIKE '%$search%'";

        $result = $this->db->query($sql);
        return $result->result();
    }

    public function getRelasiAll()
    {
        $sql = "SELECT a.* FROM m_relasi AS a ";

        $result = $this->db->query($sql);
        return $result->result();
    }

    public function getTmaterialTransaksi($no_transaski, $tgl_1, $tgl_2)
    {
        $sql = "SELECT a.* FROM t_material AS a WHERE a.`no_transaksi` LIKE '%$no_transaski%'
                AND (DATE(tgl_timbang_1) BETWEEN '$tgl_1' AND '$tgl_2')";

        $result = $this->db->query($sql);
        return $result->result();
    }

    public function getTmaterialTiket($no_tiket)
    {
        $sql = "SELECT a.* FROM t_material AS a WHERE a.`no_tiket` LIKE '%$no_tiket%'";

        $result = $this->db->query($sql);
        return $result->result();
    }

    public function getTmaterialMaterial($search_material)
    {
        $sql = "SELECT a.* FROM t_material AS a WHERE a.`kode_material` LIKE '%$search_material%' OR a.nama_material LIKE '%$search_material%'";

        $result = $this->db->query($sql);
        return $result->result();
    }

    public function getTmaterialRelasi($search_relasi)
    {
        $sql = "SELECT a.* FROM t_material AS a WHERE a.`kode_relasi` LIKE '%$search_relasi%' OR a.nama_relasi LIKE '%$search_relasi%'";

        $result = $this->db->query($sql);
        return $result->result();
    }
}