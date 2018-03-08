<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Tevaluasitebangmodel extends SB_Model 
{

	public $table = 'sap_field';
	public $primaryKey = 'kode_blok';

	public function __construct() {
		parent::__construct();
		
	}

	public static function querySelect(  ){
		
		
		return "   SELECT sap_field.* FROM vw_masterfield_data as sap_field   ";
	}
	public static function queryWhere(  ){
		
		return "  WHERE sap_field.kode_blok IS NOT NULL   ";
	}
	
	public static function queryGroup(){
		return "   ";
	}
	
	public function getRowspdx( $args )
	{
		$table = $this->table;
		$key = $this->primaryKey;

		extract( array_merge( array(
			'page' 		=> '0' ,
			'limit'  	=> '0' ,
			'sort' 		=> '' ,
			'order' 	=> '' ,
			'params' 	=> '' ,
			'global'	=> '1'
		), $args ));
		
		//$offset = ($page-1) * $limit ;
		//$offset = $page-1 ;
		$limitConditional =  "LIMIT $limit , $page" ;
		$orderConditional = ($sort !='' && $order !='') ?  " ORDER BY {$sort} {$order} " : '';
		
		
		$rows = array();
		$asc = "SELECT a.id,
				a.`no_spat`,
				c.`netto_final`,
				a.kode_blok,
				d.nama_petani,
				b.ha_tertebang FROM t_spta a
				INNER JOIN t_selektor b ON a.id=b.id_spta
				INNER JOIN t_timbangan c ON c.`id_spat`=a.`id`
				left join sap_petani d ON d.id_petani_sap = a.id_petani_sap
				WHERE a.`timb_netto_status` = 1 AND b.tanaman_status = 0";
		$query = $this->db->query( $asc."
			{$params} ". $this->queryGroup() ." {$orderConditional}  {$limitConditional} ");
		$result = $query->result();
		$query->free_result();
		$key = '';
		if($key =='' ) { $key ='*'; } else { $key = $table.".".$key ; }
		$counter_select = preg_replace( '/[\s]*SELECT(.*)FROM/Usi', 'SELECT count('.$key.') as total FROM ( SELECT a.id FROM ', "".$asc."" );
		//echo 	$counter_select; exit;
		$query = $this->db->query( $counter_select .') as '.$table);
		$res = $query->result();
		// var_dump($counter_select . $this->queryWhere()." {$params} ". $this->queryGroup());exit;
		$total = $res[0]->total;

		$query = $this->db->query( $counter_select . " {$params} " . ') as '.$table);
		$res = $query->result();
		// var_dump($counter_select . $this->queryWhere()." {$params} ". $this->queryGroup());exit;
		$totalfil = $res[0]->total;
		$query->free_result();

		return $results = array('rows'=> $result , 'total' => $total, 'totalfil' => $totalfil);


	}
	
}

?>
