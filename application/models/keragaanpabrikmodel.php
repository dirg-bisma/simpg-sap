<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Keragaanpabrikmodel extends SB_Model 
{

	public $table = 'vw_keragaan_pabrik';
	public $primaryKey = 'id';

	public function __construct() {
		parent::__construct();
		
	}

	public static function querySelect(  ){
		
		
		return "   SELECT vw_keragaan_pabrik.* FROM vw_keragaan_pabrik   ";
	}
	public static function queryWhere(  ){
		
		return "  WHERE vw_keragaan_pabrik.id IS NOT NULL   ";
	}
	
	public static function queryGroup(){
		return "  ";
	}

	public function insertData($data)
	{
		$data_insert = [
			'hari_giling' => $data['hari_giling'],
			'tgl_giling' => $data['tgl_giling'],
			'jam' => $data['jam'],
			'digiling' => $data['digiling'],
			'brix_npp' => $data['brix_npp'],
			'nm_persen_tebu' => $data['nm_persen_tebu'],
			'uap_baru' => $data['uap_baru'],
			'uap_bekas' => $data['uap_bekas'],
			'suhu_pp_i' => $data['suhu_pp_i'],
			'suhu_pp_ii' => $data['suhu_pp_ii'],
			'suhu_pp_iii' => $data['suhu_pp_iii'],
			'turbidity' => $data['turbidity'],
			'v_eva' => $data['v_eva'],
			'v_masakan' => $data['v_masakan'],
			'be_nk' => $data['be_nk'],
		];

		$this->db->insert('t_keragaan_pabrik',$data_insert);
		return $this->db->insert_id();
	}

	public function updateData($id, $data)
	{
		$data_update = [
			'hari_giling' => $data['hari_giling'],
			'tgl_giling' => $data['tgl_giling'],
			'jam' => $data['jam'],
			'digiling' => $data['digiling'],
			'brix_npp' => $data['brix_npp'],
			'nm_persen_tebu' => $data['nm_persen_tebu'],
			'uap_baru' => $data['uap_baru'],
			'uap_bekas' => $data['uap_bekas'],
			'suhu_pp_i' => $data['suhu_pp_i'],
			'suhu_pp_ii' => $data['suhu_pp_ii'],
			'suhu_pp_iii' => $data['suhu_pp_iii'],
			'turbidity' => $data['turbidity'],
			'v_eva' => $data['v_eva'],
			'v_masakan' => $data['v_masakan'],
			'be_nk' => $data['be_nk'],
		];
		$this->db->where('id', $id);
		$this->db->update('t_keragaan_pabrik', $data_update);
	}

	public function rekapData($hari)
	{
		$sql = "SELECT
		b.jam AS jam_lap,
		a.id,
		a.hari_giling,
		a.tgl_giling,
		a.jam,
		format(ifnull(a.digiling/100,0), 0) as digiling,
		format(ifnull(a.brix_npp,0), 2) as brix_npp,
		format(ifnull(a.nm_persen_tebu,0), 2) as nm_persen_tebu,
		format(ifnull(a.uap_baru,0), 2) as uap_baru,
		format(ifnull(a.uap_bekas,0), 2) as uap_bekas,
		format(ifnull(a.suhu_pp_i,0), 2) as suhu_pp_i,
		format(ifnull(a.suhu_pp_ii,0), 2) as suhu_pp_ii,
		format(ifnull(a.suhu_pp_iii,0), 2) as suhu_pp_iii,
		format(ifnull(a.turbidity,0), 2) as turbidity,
		format(ifnull(a.v_eva,0), 2) as v_eva,
		format(ifnull(a.v_masakan,0), 2) as v_masakan,
		format(ifnull(a.be_nk,0), 2) as be_nk,
		a.kp
		FROM
		t_keragaan_pabrik AS a
		JOIN t_lap_jam AS b ON b.jam = a.jam
		WHERE hari_giling = $hari";
		$data = $this->db->query($sql)->result();
		return $data;
	}
	
	public function rekapDataJam($tgl, $jam)
	{
		$sql = "SELECT
		b.jam AS jam_lap,
		a.id,
		a.hari_giling,
		a.tgl_giling,
		a.jam,
		format(ifnull(a.digiling/100,0), 0) as digiling,
		format(ifnull(a.brix_npp,0), 2) as brix_npp,
		format(ifnull(a.nm_persen_tebu,0), 2) as nm_persen_tebu,
		format(ifnull(a.uap_baru,0), 2) as uap_baru,
		format(ifnull(a.uap_bekas,0), 2) as uap_bekas,
		format(ifnull(a.suhu_pp_i,0), 2) as suhu_pp_i,
		format(ifnull(a.suhu_pp_ii,0), 2) as suhu_pp_ii,
		format(ifnull(a.suhu_pp_iii,0), 2) as suhu_pp_iii,
		format(ifnull(a.turbidity,0), 2) as turbidity,
		format(ifnull(a.v_eva,0), 2) as v_eva,
		format(ifnull(a.v_masakan,0), 2) as v_masakan,
		format(ifnull(a.be_nk,0), 2) as be_nk,
		a.kp
		FROM
		t_keragaan_pabrik AS a
		JOIN t_lap_jam AS b ON b.jam = a.jam
		WHERE tgl_giling = '$tgl' and a.jam='$jam'";
		$data = $this->db->query($sql)->row();
		return $data;
	}

	function hitungRekap($hari, $param, $standart)
	{
		$sql = "SELECT
		count(id) as jumlah_id,
		$param,
		sum( IF ( $param = $standart, 1, 0 ) ) AS normal,
		sum( IF ( $param > $standart, 1, 0 ) ) AS over,
		sum( IF ( $param < $standart, 1, 0 ) ) AS under,
	  		sum( IF ( $param = $standart, 1, 0 ) )+
		    sum( IF ( $param > $standart, 1, 0 ) )+
		    sum( IF ( $param < $standart, 1, 0 ) ) as total	
		FROM
			t_keragaan_pabrik 
		WHERE
			hari_giling = $hari";
		
		$data = $this->db->query($sql)->row();
		return $data;
	}

	function gethg($hg)
	{
		$hg = $hg-1;
		$sql = "SELECT '".($hg+1)."' as hg,DATE_ADD(DATE(IFNULL(awal_giling,NOW())),INTERVAL ".$hg." DAY) AS tgl FROM tb_setting";
		$r = $this->db->query($sql)->row();
		return $r;
	}
}

?>
