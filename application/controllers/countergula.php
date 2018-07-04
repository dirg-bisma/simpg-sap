<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Countergula extends SB_Controller 
{

	function index(){
		echo 'Restrict area';
	}

	function setCount($key,$jlr,$sensor){
		
		$ax = array();
		if($key == md5(CNF_PLANCODE)){
		$sql = $this->db->query("INSERT t_counter_gula_detail VALUES('','$jlr','$sensor',1,get_tgl_giling(),now(),now())");
		if($sql){
			$ax['data'] = 'Berhasil Insert';
		}else{

			$ax['data'] = 'Gagal Insert';
		}
		}else{

			$ax['data'] = 'Key Token Tidak Cocok';
		}

		echo json_encode($ax);

	}

}
