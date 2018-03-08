<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Tdetailkuotakkwmodel extends SB_Model 
{

	public $table = 'sap_field';
	public $primaryKey = 'idkuotakkw';

	public function __construct() {
		parent::__construct();
		
	}

	public static function querySelect(  ){
		
		
		return "   SELECT sap_field.* FROM vw_detail_kuota_kkw as sap_field   ";
	}
	public static function queryWhere(  ){
		
		return "  WHERE sap_field.idkuotakkw IS NOT NULL   ";
	}
	
	public static function queryGroup(){
		return "   ";
	}
	
	
	public function getRowspdx( $args ,$idx)
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
		$query = $this->db->query( "SELECT * FROM (SELECT
  IFNULL(`b`.`id`,0)   AS `idkuotakkw`,
  `a`.`divisi`         AS `divisi`,
  `a`.`kode_blok`      AS `kode_blok`,
  `a`.`deskripsi_blok` AS `deskripsi_blok`,
  `a`.`kepemilikan`    AS `kepemilikan`,
  `a`.`periode`        AS `periode`,
  `a`.`luas_ha`        AS `luas_ha`,
  a.aff_tebang,
  IFNULL(`b`.`kouta_tot`,0) AS `kuota_spta`,
  id_spta_kuota_kkw,
  id_spta_kuota
FROM (`sap_field` `a`
   LEFT JOIN (SELECT * FROM `t_spta_kuota_tot` WHERE id_spta_kuota_kkw=$idx) `b`
     ON ((`a`.`kode_blok` = `b`.`kode_blok`)))) as ax WHERE 0=0 
			{$params} ". $this->queryGroup() ." {$orderConditional}  {$limitConditional} ");
		$result = $query->result();
		$query->free_result();

		if($key =='' ) { $key ='*'; } else { $key = $table.".".$key ; }
		$counter_select = preg_replace( '/[\s]*SELECT(.*)FROM/Usi', 'SELECT count('.$key.') as total FROM ( SELECT '.$key.' FROM ', $this->querySelect() );
		//echo 	$counter_select; exit;
		$query = $this->db->query( $counter_select . $this->queryWhere()." ". $this->queryGroup().') as '.$table);
		$res = $query->result();
		// var_dump($counter_select . $this->queryWhere()." {$params} ". $this->queryGroup());exit;
		$total = $res[0]->total;

		$query = $this->db->query( $counter_select . $this->queryWhere()." {$params} ". $this->queryGroup().') as '.$table);
		$res = $query->result();
		// var_dump($counter_select . $this->queryWhere()." {$params} ". $this->queryGroup());exit;
		$totalfil = $res[0]->total;
		$query->free_result();

		return $results = array('rows'=> $result , 'total' => $total, 'totalfil' => $totalfil);


	}
	
	
}

?>
