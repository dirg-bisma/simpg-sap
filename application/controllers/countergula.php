<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Countergula extends SB_Controller 
{

	function index(){
		echo 'Restrict area';
	}

	function setCount($key,$jlr,$sensor){
		$rex = false;
		$ax = array();
		if($key == md5(CNF_PLANCODE)){
			$sql = false;
			if($sensor == 'CS'){
				$re = $this->db->query("UPDATE t_counter_gula_detail SET cekscale=cekscale+1,jam_pengakuan=now(),tgl_act=now() where tgl_pengakuan=get_tgl_giling() and jalur='$jlr'");
				if($this->db->affected_rows() == 0){
					$sql = $this->db->query("INSERT t_counter_gula_detail VALUES('','$jlr',1,0,get_tgl_giling(),now(),now())");
					$rex = $sql;
				}
				
			}else if($sensor == 'CF'){
				$re = $this->db->query("UPDATE t_counter_gula_detail SET conveyor=conveyor+1,jam_pengakuan=now(),tgl_act=now() where tgl_pengakuan=get_tgl_giling() and jalur='$jlr'");
				if($this->db->affected_rows() == 0){
					$sql = $this->db->query("INSERT t_counter_gula_detail VALUES('','$jlr',0,1,get_tgl_giling(),now(),now())");
					$rex = $sql;
				}
			}else if($sensor == 'TM'){
				$sql = $this->db->query("INSERT t_counter_gula_detail VALUES('','$jlr',0,0,get_tgl_giling(),now(),now())");
				$rex = $sql;
			}else if($sensor == 'ALL'){
				$re = $this->db->query("UPDATE t_counter_gula_detail SET cekscale=cekscale+1,conveyor=conveyor+1,jam_pengakuan=now(),tgl_act=now() where tgl_pengakuan=get_tgl_giling() and jalur='$jlr'");
				if($this->db->affected_rows() == 0){
					$sql = $this->db->query("INSERT t_counter_gula_detail VALUES('','$jlr',1,1,get_tgl_giling(),now(),now())");
					$rex = $sql;
				}
			}
		
		if($rex){
			$ax['data'] = 'Berhasil Insert';
			$this->db->query("DELETE FROM t_counter_gula_detail where tgl_pengakuan < get_tgl_giling()");
			$as = $this->db->query("SELECT 
  jalur,
  tgl_pengakuan,
  DATE_FORMAT(tgl_pengakuan, '%e%c%Y') AS tgls,
  TIME_FORMAT(jam_pengakuan, '%H') AS jam,
  SUM(cekscale) AS ck,
  SUM(conveyor) AS cv 
FROM
  t_counter_gula_detail 
WHERE DATE_FORMAT(tgl_pengakuan, '%e%c%Y') = DATE_FORMAT(get_tgl_giling(), '%e%c%Y') AND TIME_FORMAT(jam_pengakuan, '%H') =  TIME_FORMAT(NOW(), '%H')
GROUP BY jalur,
  tgl_pengakuan,
  TIME_FORMAT(jam_pengakuan, '%H') 
ORDER BY tgl_act DESC ")->result();

			foreach ($as as $qr) {
				# code...
			
			$rs = $this->db->query("DELETE FROM t_counter_gula WHERE jalur = '$qr->jalur' AND tgl = '$qr->tgl_pengakuan' AND jam='$qr->jam'");

			$rb = $this->db->query("INSERT t_counter_gula VALUES('','$qr->jalur','$qr->ck','$qr->cv','$qr->tgl_pengakuan','$qr->jam',0,NOW())");
			$this->sendfirebase($qr->jalur,$qr->tgls,$qr->jam,$qr->ck,$qr->cv);
		}

			

		}else{

			$ax['data'] = 'Gagal Insert';
		}
		}else{

			$ax['data'] = 'Key Token Tidak Cocok';
		}

		echo json_encode($ax);

	}

	function sendfirebase($jalur,$tgl,$jam,$val1,$val2){
		$FIREBASE = "https://counter-pabrik.firebaseio.com/";
		$NODE_PATCH = "unit/".CNF_PLANCODE."/$jalur/$tgl/$jam.json";

		// JSON encoded
		$data = array("value1"=> (int) $val1,"value2"=>(int) $val2);
		$json = json_encode( $data );
		// Initialize cURL
		$curl = curl_init();
		curl_setopt( $curl, CURLOPT_URL, $FIREBASE . $NODE_PATCH );
		curl_setopt( $curl, CURLOPT_CUSTOMREQUEST, "PATCH" );
		curl_setopt( $curl, CURLOPT_POSTFIELDS, $json );
		// Delete
		// curl_setopt( $curl, CURLOPT_URL, $FIREBASE . $NODE_DELETE );
		// curl_setopt( $curl, CURLOPT_CUSTOMREQUEST, "DELETE" );
		// Get return value
		curl_setopt( $curl, CURLOPT_RETURNTRANSFER, true );
		$response = curl_exec( $curl );
		curl_close( $curl );
		echo $response . "\n";

	}

}
