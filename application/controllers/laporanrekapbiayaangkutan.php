<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Laporanrekapbiayaangkutan extends SB_Controller 
{

	protected $layout 	= "layouts/main";
	public $module 		= 'laporanrekapupahtebang';
	public $per_page	= '10';

	function __construct() {
		parent::__construct();	

		$this->load->model('tbiayaangkutanmodel');
		$this->model = $this->tbiayaangkutanmodel;
		$idx = $this->model->primaryKey;
		
		$this->data = array_merge( $this->data, array(
			'pageTitle'	=> 	'Laporan',
			'pageNote'	=>  'SIM PG',
			'pageModule'	=> 'laporan',
		));
	}

	function index(){
		$this->data['content'] =  $this->load->view('laporanrekapbiayaangkutan/index', $this->data ,true);	  
		$this->load->view('layouts/main',$this->data);
	}

	function show() 
	{		
			error_reporting(0);
			$tgl2 = $_REQUEST['tgl2'];
			$angkutan = $_REQUEST['angkutan'];
			$kat = $_REQUEST['kat'];
			$jns = $_REQUEST['jns'];

			$whkat ="";
			$whangkut ="";
			$whvendor ="";

			if (!empty($kat)) {
				$whkat = "WHERE LEFT(a.kode_kat_lahan, 2) = '$kat' ";
			}
			if (!empty($angkutan)) {
				$whangkut = "AND a.jenis_spta = '$angkutan' ";
			}
			if (!empty($jns)) {
				$whvendor = "AND a.vendor_angkut = $jns ";
			}


			$sql = "SELECT 
					  a.id,
					  f.id AS id_angkutan,
					  a.no_spat,
					  a.kode_blok,
					  sf.`deskripsi_blok`,
					  a.vendor_angkut,
					  c.`no_angkutan`,
					  DATE_FORMAT(
					    a.timb_netto_tgl,
					    '%d/%m/%Y Jam %H:%i'
					  ) AS txt_tgl_timb,
					  a.timb_netto_tgl AS tgl_timbang,
					  b.`netto`,
					  d.`keterangan`,
					  d.`biaya` AS tarif,
					  (d.`biaya` * b.`netto`) AS jumlah,
					  e.total,
  					  f.nama_vendor 
					FROM
					  t_spta a 
					  INNER JOIN sap_field sf 
					    ON sf.`kode_blok` = a.kode_blok 
					  INNER JOIN t_selektor c 
					    ON c.`id_spta` = a.id 
					  INNER JOIN t_timbangan b 
					    ON a.id = b.`id_spat` 
					  INNER JOIN m_biaya_jarak d 
					    ON d.`id_jarak` = a.jarak_id 
					  INNER JOIN t_angkutan_detail e 
					    ON e.id_spta = a.id 
					  INNER JOIN vw_upah_angkut f 
					    ON f.vendor_id = a.vendor_angkut
					    AND f.tgl = '$tgl2'
					  $whkat
					  $whangkut  
					  $whvendor
					  GROUP BY a.id order by a.vendor_angkut";
			$data_query =  $this->db->query($sql)->result();
			$this->data['detail'] =  $data_query;

			if (!empty($data_query)) {
				$id = $data_query[0]->id_angkutan;
			}else{
				$id = null;
			}
			$row = $this->model->getRow($id);
		if($row)
		{
			$this->data['row'] =  $row;
		} else {
			$this->data['row'] = $this->model->getColumnTable('vw_upah_angkut'); 
		}
		
		$this->data['id'] = $id;	  
		$this->load->view('laporanrekapbiayaangkutan/view',$this->data);
	}
	
	function printlaporan(){
		$wh = 'WHERE 0=0';
		$wh2 = '';

		$tgl1 = $_REQUEST['tgl1'];
		$tgl2 = $_REQUEST['tgl2'];
		$bln  = $_REQUEST['bln'];
		$thn  = $_REQUEST['thn'];
		$rjns = $_REQUEST['rjns'];

		$jns = $_REQUEST['jns'];
		$kat = $_REQUEST['kat'];
		$angkutan = $_REQUEST['angkutan'];

		$this->data['title'] = "SEMUA KATEGORI ";
		if($kat != ''){
			$wh .= " AND c.kode_kat_lahan LIKE '$kat%'";
			$wh2 .= " AND b1.kode_kat_lahan LIKE '$kat%'";
			$this->data['title'] = "KATEGORI $kat ";
		}

		
		if($angkutan != ''){
			$wh .= " AND c.jenis_spta = '$angkutan'";
			$wh2 .= " AND b1.jenis_spta = '$angkutan'";
			$this->data['title'] .= "ANGKUTAN $angkutan <br />";
		}else{
			$this->data['title'] .= "SEMUA ANGKUTAN <br />";
		}

		
		
		if($rjns == 1) {
			$wh .= " AND a.tgl = '$tgl2'";
			$this->data['title'] .= 	"PERIODE TANGGAL ".SiteHelpers::datereport($tgl2).' <br />';	
		}
		


		if(isset($_REQUEST['excel']) && $_REQUEST['excel'] == 1){
				$file = "Rekapitulasi Upah Tebang - Tgl ".SiteHelpers::datereport($tgl2).".xls";
				header("Content-type: application/vnd.ms-excel");
				header("Content-Disposition: attachment; filename=$file");
			}

		
			$this->data['coldefadd'] = $this->db->query("select kodekolom,nama_pekerjaan_tma,satuan from m_pekerjaan_tma where status_pekerjaan!=2 and jenis=1 order by id_pekerjaan_tma asc")->result();
			$this->data['coldefrem'] = $this->db->query("select kodekolom,nama_pekerjaan_tma,satuan from m_pekerjaan_tma where status_pekerjaan!=2 and jenis=2 order by id_pekerjaan_tma asc")->result();

			if($jns == 1){
			$result = $this->db->query("SELECT IFNULL((SELECT SUM(a1.`total_bersih`) AS total 
				FROM t_upah_tebang_detail a1 
				INNER JOIN t_upah_tebang b1 ON a1.`id_upah_tebang`=b1.`id`
				INNER JOIN t_spta c1 ON c1.`id`=a1.`id_spta` 
				WHERE b1.persno_mandor=a.`persno_mandor` AND b1.tgl < '$tgl2' $wh2  GROUP BY b1.`persno_mandor`),0) AS ttlyl,
a.`kode_blok`,c.`no_spat`,e.`name` AS mandor_nama,f.`name` AS pta_nama,d.`no_angkutan`,b.*
 FROM t_upah_tebang a 
INNER JOIN t_upah_tebang_detail b ON a.`id`=b.`id_upah_tebang`
INNER JOIN t_spta c ON c.`id`=b.`id_spta`
INNER JOIN t_selektor d ON d.`id_spta`=c.`id` 
INNER JOIN sap_m_karyawan e ON e.`Persno`=a.`persno_mandor`
INNER JOIN sap_m_karyawan f ON f.`Persno`=c.`persno_pta` $wh
ORDER BY d.`persno_mandor_tma`")->result();
			$rt = $this->db->query("SELECT SUM(a1.`total_bersih`) AS total 
				FROM t_upah_tebang_detail a1 
				INNER JOIN t_upah_tebang b1 ON a1.`id_upah_tebang`=b1.`id` WHERE b1.tgl < '$tgl2'")->row();

			$rx = $this->db->query("SELECT SUM(a1.`total_bersih`) AS total 
				FROM t_upah_tebang_detail a1 
				INNER JOIN t_upah_tebang b1 ON a1.`id_upah_tebang`=b1.`id` WHERE b1.tgl <= '$tgl2'")->row();

			$this->data['detail'] = $result;
			$this->data['allsisalalu'] = $rt->total;
			$this->data['allsisasemua'] = $rx->total;
		$this->load->view('laporanrekapupahtebang/permandor',$this->data);
		}else{
			$result = $this->db->query("SELECT no_bukti,a.`kode_blok`,c.`no_spat`,e.`name` AS mandor_nama,f.`name` AS pta_nama,d.`no_angkutan`,b.*
 FROM t_upah_tebang a 
INNER JOIN t_upah_tebang_detail b ON a.`id`=b.`id_upah_tebang`
INNER JOIN t_spta c ON c.`id`=b.`id_spta`
INNER JOIN t_selektor d ON d.`id_spta`=c.`id` 
INNER JOIN sap_m_karyawan e ON e.`Persno`=a.`persno_mandor`
INNER JOIN sap_m_karyawan f ON f.`Persno`=c.`persno_pta`  $wh
ORDER BY a.`no_bukti`")->result();
			$this->data['detail'] = $result;
		$this->load->view('laporanrekapbiayaangkutan/pertransaksi',$this->data);


		}

		
		
		
		
		
	}
}