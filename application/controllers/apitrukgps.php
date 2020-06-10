<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Apitrukgps extends SB_Controller
{
function detailtruck($id){
		$a = $this->db->query("SELECT *,a.nopol_truk as nopol FROM m_truk_gps a LEFT JOIN vw_spta_digital b ON b.id_truck=a.id where id_gps_server = $id")->row();
		echo json_encode($a);
	}

	function listtruck(){
		$a = $this->db->query("SELECT * FROM m_truk_gps ")->result();
		echo json_encode($a);
	}

	function detailtruckrfid($id){
		$a = $this->db->query("SELECT * FROM m_truk_gps a where rfid_sticker = $id")->row();
		echo json_encode($a);
	}
}