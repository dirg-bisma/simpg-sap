<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Tpinjamanpetanimodel extends SB_Model 
{

	public $table = 't_pinjaman_petani';
	public $primaryKey = 'id';

	public function __construct() {
		parent::__construct();
		
	}

	public static function querySelect(  ){
		
		
		return "   SELECT t_pinjaman_petani.* FROM t_pinjaman_petani   ";
	}
	public static function queryWhere(  ){
		
		return "  WHERE t_pinjaman_petani.id IS NOT NULL   ";
	}
	
	public static function queryGroup(){
		return "   ";
	}
	
}

?>
