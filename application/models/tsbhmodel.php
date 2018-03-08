<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Tsbhmodel extends SB_Model 
{

	public $table = 't_ari';
	public $primaryKey = 'id_ari';

	public function __construct() {
		parent::__construct();
		
	}

	public static function querySelect(  ){
		
		
		return "   SELECT t_ari.* FROM vw_sbh_data as t_ari   ";
	}
	public static function queryWhere(  ){
		
		return "  WHERE t_ari.id_ari IS NOT NULL   ";
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
		//$limitConditional =  "LIMIT $limit , $page" ;
		$limitConditional = '';
		$orderConditional = ($sort !='' && $order !='') ?  " ORDER BY {$sort} {$order} " : '';
		
		
		$rows = array();
		$query = $this->db->query( "SELECT * FROM (SELECT   a.sbh_status,f.id_ari,id,no_spat,a.kode_kat_lahan,a.kode_plant,a.kode_affd,a.kode_blok,tgl_spta,tebang_pg,angkut_pg,jenis_spta,c.`no_angkutan`,g.`nama_petani`,b.`deskripsi_blok`,b.`luas_ha`,c.`ha_tertebang`,
c.`tgl_tebang`,c.`brix_sel`,c.`ph_sel`,c.`ditolak_sel`,c.`ditolak_alasan`
,cetak_spta_tgl,selektor_tgl,timb_netto_tgl,meja_tebu_tgl,
ari_tgl,sbh_tgl,hari_giling,tgl_giling,
d.`bruto`,d.`tara`,d.`netto_final`,e.`kondisi_tebu`,e.daduk,e.`sogolan`,e.`pucuk`,e.`akar_tanah`,e.`non_tebu`,e.`terbakar`,e.`cacahan`,e.`brondolan`,
f.persen_brix_ari,f.persen_pol_ari,f.ph_ari,f.hk,f.nilai_nira,f.faktor_rendemen,f.rendemen_ari,
ROUND(IF(f.hablur_ari=0,(f.rendemen_ari*d.`netto_final`)/100,f.hablur_ari),2) AS hablur_ari,
ROUND(IF(f.gula_total=0,(IF(f.hablur_ari=0,ROUND(IF(f.hablur_ari=0,f.rendemen_ari*d.`netto_final`/100,f.hablur_ari),2),f.hablur_ari)*1.003),f.gula_total),2) AS gula_total, 
(IF(tetes_total=0,ROUND((4.5 * d.netto_final / 100),2),tetes_total)) AS tetes_total,
IF(rendemen_ptr = 0,`get_rendemen_bagihasil_ptr`(LEFT(a.kode_kat_lahan,2),f.rendemen_ari),rendemen_ptr) AS rendemen_ptr,
ROUND(IF(gula_ptr = 0,(d.`netto_final` * IF(rendemen_ptr = 0,`get_rendemen_bagihasil_ptr`(LEFT(a.kode_kat_lahan,2),f.rendemen_ari),rendemen_ptr) / 100)*1.003,gula_ptr),2) AS gula_ptr,
ROUND(IF(tetes_ptr = 0,3*d.`netto_final`/100,tetes_ptr),2) AS tetes_ptr,
ROUND(IF(gula_pg = 0,(ROUND(IF(f.gula_total=0,(IF(f.hablur_ari=0,ROUND(IF(f.hablur_ari=0,f.rendemen_ari*d.`netto_final`/100,f.hablur_ari),2),f.hablur_ari)*1.003),f.gula_total),2)) - ROUND((IF(gula_ptr = 0,(d.`netto_final` * IF(rendemen_ptr = 0,`get_rendemen_bagihasil_ptr`(LEFT(a.kode_kat_lahan,2),f.rendemen_ari),rendemen_ptr) / 100)*1.003,gula_ptr)),2),gula_pg),2) AS gula_pg,
ROUND(IF(tetes_pg = 0,(IF(tetes_total=0,(4.5 * d.netto_final / 100),tetes_total))-(IF(tetes_ptr = 0,3*d.`netto_final`/100,tetes_ptr)),tetes_pg),2) AS tetes_pg
FROM t_spta a 
INNER JOIN sap_field b ON a.kode_blok = b.`kode_blok`
INNER JOIN t_selektor c ON c.`id_spta`=a.id
INNER JOIN t_timbangan d ON d.`id_spat`=a.id
INNER JOIN t_meja_tebu e ON e.`id_spta`=a.id
INNER JOIN t_ari f ON f.id_spta=a.id
LEFT JOIN sap_petani g ON g.`id_petani_sap`=b.`id_petani_sap` GROUP BY a.id) as ax WHERE 0=0 
			{$params} ". $this->queryGroup() ." {$orderConditional}  {$limitConditional} ");
		$result = $query->result();
		$query->free_result();

		if($key =='' ) { $key ='*'; } else { $key = $table.".".$key ; }
		$counter_select = "SELECT count(id) as total from t_spta  WHERE 0=0 {$params}";
		//echo 	$counter_select; exit;
		$query = $this->db->query( $counter_select );
		$res = $query->result();
		// var_dump($counter_select . $this->queryWhere()." {$params} ". $this->queryGroup());exit;
		$total = $res[0]->total;

		$query = $this->db->query( $counter_select);
		$res = $query->result();
		// var_dump($counter_select . $this->queryWhere()." {$params} ". $this->queryGroup());exit;
		$totalfil = $res[0]->total;
		$query->free_result();

		return $results = array('rows'=> $result , 'total' => $total, 'totalfil' => $totalfil);


	}
	
}

?>
