<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Tlapharpengmodel extends SB_Model 
{

	public $table = 't_lap_harian_pengolahan';
	public $primaryKey = 'id_lap_harian_pengolahan';

	public function __construct() {
		parent::__construct();
		
	}

	public static function querySelect(  ){
		
		
		return "   SELECT t_lap_harian_pengolahan.* FROM t_lap_harian_pengolahan   ";
	}
	public static function queryWhere(  ){
		
		return "  WHERE t_lap_harian_pengolahan.id_lap_harian_pengolahan IS NOT NULL   ";
	}
	
	public static function queryGroup(){
		return "   ";
	}

	public function HaDitebang(){
		$qry = "SELECT 
				SUBSTRING(c.kepemilikan, 1, 2) as jenis_kepemilikan, 
				sum(a.ha_tertebang) as ha_ditebang from t_selektor as a
				inner join t_spta as b on b.id = a.id_spta
				inner join sap_field as c on c.kode_blok = b.kode_blok
				GROUP BY SUBSTRING(c.kepemilikan, 1, 2)";
	}

	public function TebuDitebang()
	{
		$qry = "SELECT 
				SUBSTRING(c.kepemilikan, 1, 2) as jenis_kepemilikan, 
				sum(a.netto_final) as tebu_ditebang from t_timbangan as a
				inner join t_spta as b on b.id = a.id_spat
				inner join sap_field as c on c.kode_blok = b.kode_blok
				GROUP BY SUBSTRING(c.kepemilikan, 1, 2)";
	}

	public function TebuDigiling()
	{
		$qry = "SELECT 
				SUBSTRING(c.kepemilikan, 1, 2) as jenis_kepemilikan, 
				sum(a.netto_final) as tebu_ditebang from t_timbangan as a
				inner join t_spta as b on b.id = a.id_spat
				inner join sap_field as c on c.kode_blok = b.kode_blok
				WHERE b.meja_tebu_status = 1
				GROUP BY SUBSTRING(c.kepemilikan, 1, 2)";
	}
}

?>
