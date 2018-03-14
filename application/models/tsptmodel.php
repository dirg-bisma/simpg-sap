<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Tsptmodel extends SB_Model 
{

	public $table = 'sap_field_spt';
	public $primaryKey = 'no_petak';

	public function __construct() {
		parent::__construct();
		
	}

	public static function querySelect(  ){
		
		
		return "   SELECT sap_field_spt.* FROM vw_spt_data as sap_field_spt   ";
	}
	public static function queryWhere(  ){
		
		return "  WHERE 0=0  ";
	}
	
	public static function queryGroup(){
		return "   ";
	}
	
}

?>
