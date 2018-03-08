<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Laporantimbangan extends SB_Controller 
{

	protected $layout 	= "layouts/main";
	public $module 		= 'laporantimbangan';
	public $per_page	= '10';

	function __construct() {
		parent::__construct();	
		$this->data = array_merge( $this->data, array(
			'pageTitle'	=> 	'Laporan',
			'pageNote'	=>  'SIM PG',
			'pageModule'	=> 'laporan',
		));
	}

	function index(){
		$this->data['content'] =  $this->load->view('laporantimbangan/index', $this->data ,true);	  
		$this->load->view('layouts/main',$this->data);
	}
	
	function printlaporan(){
		$wh = 'WHERE 0=0';

		$tgl1 = $_REQUEST['tgl1'];
		$tgl2 = $_REQUEST['tgl2'];
		$bln  = $_REQUEST['bln'];
		$thn  = $_REQUEST['thn'];
		$rjns = $_REQUEST['rjns'];
		$jns  = $_REQUEST['jns'];
		
		
		if($rjns == 1) {
			$wh .= " AND date(timb_netto_tgl) between '$tgl1' and '$tgl2'";
			$this->data['title'] = 	"PERIODE ".SiteHelpers::datereport($tgl1)." s/d ".SiteHelpers::datereport($tgl2);	
		}
		if($rjns == 2) {
			$wh .= " AND MONTH(timb_netto_tgl) = '$bln' and YEAR(a.timb_netto_tgl) = '$thn'";
			$this->data['title'] = 	"BULAN ".SiteHelpers::blnreport($bln)." TAHUN ".$thn;
		}
		if($rjns == 3) {
			$wh .= " AND  YEAR(timb_netto_tgl) = '$thn'";
			$this->data['title'] = 	"TAHUN ".$thn;
		}
		
		if($jns == 1){
		$sql = "SELECT a.`kode_blok`,d.`deskripsi_blok`,e.`nama_petani`,a.`kode_kat_lahan`,SUM(a.`truk`) AS truk,SUM(a.`lori`) AS lori,
d.`luas_ha`,SUM(b.ha_tertebang) AS tertebang,
SUM(c.`netto_final`) AS netto,
(d.luas_ha-(SUM(b.ha_tertebang))) AS sisa FROM 
(SELECT *,IF(jenis_spta='TRUK',1,0) AS truk,IF(jenis_spta='LORI',1,0) AS lori FROM t_spta $wh) AS a
INNER JOIN t_selektor b ON b.`id_spta`=a.`id`
INNER JOIN t_timbangan c ON c.`id_spat`=a.`id`
INNER JOIN sap_field d ON d.`kode_blok`=a.`kode_blok`
LEFT JOIN sap_petani e ON e.`id_petani_sap`=a.`id_petani_sap` GROUP BY a.`kode_blok`";
$result = $this->db->query($sql)->result();
		
		$this->data['result'] = $result;
		$this->load->view('laporantimbangan/perpetak',$this->data);
		}else{
			$sql = "SELECT a.no_spat,a.`kode_blok`,d.`deskripsi_blok`,e.`nama_petani`,a.`kode_kat_lahan`,SUM(a.`truk`) AS truk,SUM(a.`lori`) AS lori,
d.`luas_ha`,SUM(b.ha_tertebang) AS tertebang,
SUM(c.`netto_final`) AS netto,
a.stt_ta,
IF(a.stt_ta = '11','TAPG',IF(a.stt_ta = '10','TPGAS',IF(a.stt_ta='01','TSAPG','TAS'))) AS stt_ta_text,
(d.luas_ha-(SUM(b.ha_tertebang))) AS sisa,a.`timb_netto_tgl` FROM 
(SELECT *,CONCAT(tebang_pg,angkut_pg) AS stt_ta,IF(jenis_spta='TRUK',1,0) AS truk,IF(jenis_spta='LORI',1,0) AS lori FROM t_spta $wh) AS a
INNER JOIN t_selektor b ON b.`id_spta`=a.`id`
INNER JOIN t_timbangan c ON c.`id_spat`=a.`id`
INNER JOIN sap_field d ON d.`kode_blok`=a.`kode_blok`
LEFT JOIN sap_petani e ON e.`id_petani_sap`=a.`id_petani_sap` GROUP BY a.`id` ORDER BY a.stt_ta";
$result = $this->db->query($sql)->result();
		
		$this->data['result'] = $result;
		$this->load->view('laporantimbangan/perspta',$this->data);
		}
		
		
	}
}