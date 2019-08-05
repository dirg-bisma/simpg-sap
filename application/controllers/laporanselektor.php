<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Laporanselektor extends SB_Controller 
{

	protected $layout 	= "layouts/main";
	public $module 		= 'laporanselektor';
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
		$this->data['content'] =  $this->load->view('laporanselektor/index', $this->data ,true);	  
		$this->load->view('layouts/main',$this->data);
	}
	
	function printlaporan(){
		$wh = 'WHERE 0=0';

		$tgl1 = $_REQUEST['tgl1'];
		$tgl2 = $_REQUEST['tgl2'];
		$bln  = $_REQUEST['bln'];
		$thn  = $_REQUEST['thn'];
		$rjns = $_REQUEST['rjns'];


		$kat  		= $_REQUEST['kat'];
		$angkutan  	= $_REQUEST['angkutan'];
		$afd  		= $_REQUEST['divisi'];
		$petak  	= $_REQUEST['kode_blok'];
		
		
		if($rjns == 1) {
			$wh .= " AND date(tgl_urut) between '$tgl1' and '$tgl2'";
			$this->data['title'] = 	"PERIODE ".SiteHelpers::datereport($tgl1)." s/d ".SiteHelpers::datereport($tgl2).' <br />';	
		}
		if($rjns == 2) {
			$wh .= " AND MONTH(tgl_urut) = '$bln' and YEAR(a.tgl_urut) = '$thn'";
			$this->data['title'] = 	"BULAN ".SiteHelpers::blnreport($bln)." TAHUN ".$thn.' <br />';
		}
		if($rjns == 3) {
			$wh .= " AND  YEAR(tgl_urut) = '$thn'";
			$this->data['title'] = 	"TAHUN ".$thn.' <br />';
		}


		if($kat != ''){
			$wh .= " AND  b.kode_kat_lahan LIKE '$kat%'";
			$this->data['title'] .= 	" KATEGORI ".$kat;
		}

		if($angkutan != ''){
			$wh .= " AND  b.jenis_spta = '$angkutan'";
			$this->data['title'] .= 	" ANGKUTAN ".$angkutan;
		}

		if($afd != ''){
			$wh .= " AND  e.divisi = '$afd'";
			$this->data['title'] .= 	"<br /> AFDELING ".$afd;
		}

		if($petak != ''){
			$wh .= " AND  e.kode_blok = '$petak'";
			$this->data['title'] .= 	" PETAK ".$petak;
		}

		if(isset($_REQUEST['excel']) && $_REQUEST['excel'] == 1){
				$file = "Laporan Selektor - PERIODE ".SiteHelpers::datereport($tgl1)." s/d ".SiteHelpers::datereport($tgl2).".xls";
				header("Content-type: application/vnd.ms-excel");
				header("Content-Disposition: attachment; filename=$file");
			}

		$sql = "SELECT
  `b`.`no_spat`           AS `no_spat`,
  `b`.`kode_blok`         AS `kode_blok`,
  `e`.`deskripsi_blok`    AS `deskripsi_blok`,
  `b`.`kode_kat_lahan`    AS `kode_kat_lahan`,
  `c`.`name`              AS `mandor`,
   f.name as pta,
   b.`timb_bruto_tgl`,
   b.`timb_netto_tgl`,
   b.`jenis_spta`,
   b.kode_affd,
   a.*
FROM `t_selektor` `a`
     INNER JOIN `t_spta` `b` ON `a`.`id_spta` = `b`.`id`
     INNER JOIN `sap_m_karyawan` `c`  ON `c`.`Persno` = CONVERT(`a`.`persno_mandor_tma` USING utf8)
	 INNER JOIN `sap_m_karyawan` `f`  ON `f`.`Persno` = CONVERT(`b`.`persno_pta` USING utf8)
     INNER JOIN `sap_field` `e` ON `e`.`kode_blok` = `b`.`kode_blok` $wh GROUP BY b.`id`
ORDER BY `a`.`tgl_selektor` ASC";
$result = $this->db->query($sql)->result();
		
		$this->data['result'] = $result;
		$this->load->view('laporanselektor/perspta',$this->data);
		
		
		
	}
}