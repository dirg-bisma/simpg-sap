<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Countergula extends SB_Controller 
{

	function index(){
		echo 'Restrict area';
	}

	function setCount($key,$jlr,$sensor){
		
		$ax = array();
		if($key == md5(CNF_PLANCODE)){
			$sql = false;
			if($sensor == 'CS'){
				$sql = $this->db->query("INSERT t_counter_gula_detail VALUES('','$jlr',1,0,get_tgl_giling(),now(),now())");
			}else if($sensor == 'CF'){
				$sql = $this->db->query("INSERT t_counter_gula_detail VALUES('','$jlr',0,1,get_tgl_giling(),now(),now())");
			}
		
		if($sql){
			$ax['data'] = 'Berhasil Insert';

			$qr = $this->db->query("SELECT jalur,tgl_pengakuan,TIME_FORMAT(jam_pengakuan,'%H') as jam,SUM(cekscale) as ck,SUM(conveyor) as cv FROM t_counter_gula_detail GROUP BY 	jalur,tgl_pengakuan,TIME_FORMAT(jam_pengakuan,'%H') ORDER BY tgl_act DESC LIMIT 1")->row();
			$rs = $this->db->query("DELETE FROM t_counter_gula WHERE jalur = '$qr->jalur' AND tgl = '$qr->tgl_pengakuan' AND jam='$qr->jam'");

			$rb = $this->db->query("INSERT t_counter_gula VALUES('','$qr->jalur','$qr->ck','$qr->cv','$qr->tgl_pengakuan','$qr->jam',0,NOW())");

		}else{

			$ax['data'] = 'Gagal Insert';
		}
		}else{

			$ax['data'] = 'Key Token Tidak Cocok';
		}

		echo json_encode($ax);

	}

}
