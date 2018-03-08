<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Mkualitastebumodel extends SB_Model 
{

	public $table = 'm_rafaksi';
	public $primaryKey = 'nilai';

	public function __construct() {
		parent::__construct();
		
	}

	public static function querySelect(  ){
		
		
		return "   SELECT m_rafaksi.* FROM m_rafaksi   ";
	}
	public static function queryWhere(  ){
		
		return "  WHERE m_rafaksi.nilai IS NOT NULL   ";
	}
	
	public static function queryGroup(){
		return "   ";
	}
	
}

?>
