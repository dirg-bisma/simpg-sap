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
		return "   ";
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
	
}

?>
