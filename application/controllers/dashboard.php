<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Dashboard extends SB_Controller {

    protected $layout 	= "layouts/main";
	public $module 		= 'penjualan';
	public $per_page	= '10';

	function __construct() {
		parent::__construct();
		
		
		if(!$this->session->userdata('logged_in')) redirect('user/login',301);
		
	}

	public function index()
	{
		$this->data = array();
		

		if($this->session->userdata('gid') != 2 && $this->session->userdata('gid') != 11 && $this->session->userdata('gid') != 22){
			$this->data['content'] = $this->load->view('dashboard',$this->data,true);
		}else{
			$this->data['content'] = $this->load->view('dashboardafd',$this->data,true);
		}
		$this->load->view('layouts/main',$this->data);
	}

	public function viewari()
	{
		$this->data = array();
		


		//$this->data['content'] = $this->load->view('layouts/dashari',$this->data,true);
		$this->load->view('layouts/dashari',$this->data);
	}


	public function viewpabrik()
	{
		$this->data = array();
		


		//$this->data['content'] = $this->load->view('layouts/dashari',$this->data,true);
		$this->load->view('layouts/dashpabrik',$this->data);
	}
	
	public function postgantimejatebu(){
		$this->session->set_userdata(array(
				'gilingan'		=> $_POST['mejatebu']
			));
		redirect('dashboard');
	}

	public function getDevGiling(){
        $qry_hargil = "SELECT get_tgl_giling() AS tgl_giling";
        $result = $this->db->query($qry_hargil)->row();
        $hargil = $result->tgl_giling;
        $c = curl_init('http://devproduksi.ptpn11.co.id/simpgdb/index.php/Apigiling/gilingperjam?tgl='.$hargil.'&CC='.CNF_COMPANYCODE.'&PC='.CNF_PLANCODE);
        curl_setopt($c, CURLOPT_RETURNTRANSFER, true);
        $html = curl_exec($c);
        echo $html;
    }

    public function gettgl(){
    	$a = $this->db->query("SELECT get_tgl_giling() AS tgl ")->row();
    	echo $a->tgl;
    }

    public function getlastari(){
    	$a = $this->db->query("SELECT * FROM t_ari order by id_ari desc limit 1")->row();
    	if($a){
    		echo json_encode(array('dtt'=>$a));
    	}else{
    		echo json_encode(array('dtt'=>0));
    	}
    }

    public function gettotalquota($tgl){
    	$rx = $this->db->query("SELECT ifnull(count(id),0) as total_cetak,ifnull(sum(selektor_status),0) as total_masuk from t_spta where tgl_spta = '$tgl'")->row();

    	echo json_encode($rx);
    }

    public function getkuotaspta($tgl){
    	//$tgl = $_REQUEST['tgl'];
    	$rx = $this->db->query("SELECT 
a.kode_affd,b.`name`,IFNULL(total_cetak_lori,0) AS total_cetak_lori,IFNULL(total_cetak_truk,0) AS total_cetak_truk,IFNULL(masuk_truk,0) AS masuk_truk,IFNULL(masuk_lori,0) AS masuk_lori FROM sap_m_affdeling a 
INNER JOIN sap_m_karyawan b ON a.`Persno`=b.`Persno`
LEFT JOIN (SELECT kode_affd,SUM(IF(jenis_spta = 'TRUK',1,0)) AS total_cetak_truk,SUM(IF(jenis_spta = 'LORI',1,0)) AS total_cetak_lori,SUM(IF(selektor_status = 1 AND jenis_spta = 'TRUK',1,0)) AS masuk_truk,SUM(IF(selektor_status = 1 AND jenis_spta = 'LORI',1,0)) AS masuk_lori FROM t_spta WHERE tgl_spta = '$tgl' GROUP BY kode_affd) AS c ON c.kode_affd=a.kode_affd
ORDER BY a.`kode_affd`")->result();
    	$ht ='';
    	foreach ($rx as $rd) {
    		$ht .= ' <li><a href="javascript:datadetailspta(\''.$rd->kode_affd.'\')">'.$rd->kode_affd.' - '.$rd->name.'
    		<br />TRUK : <span class="badge bg-red">'.$rd->total_cetak_truk.'</span>&nbsp;&nbsp;<span class="badge bg-green">'.$rd->masuk_truk.'</span> LORI : <span class="badge bg-red">'.$rd->total_cetak_lori.'</span>&nbsp;&nbsp;<span class="badge bg-green">'.$rd->masuk_lori.'</span></a></li>';
    	}
    	echo $ht;
    }

    public function detailspta($tgl,$afd){
    	$sqla = "SELECT a.`no_spat`,b.`kode_blok`,b.`deskripsi_blok`,c.`name`,count(id) as ttl FROM t_spta a 
INNER JOIN sap_field b ON a.`kode_blok`=b.`kode_blok` 
INNER JOIN sap_m_karyawan c ON c.`Persno`=a.`persno_pta`
WHERE kode_affd = '$afd' AND tgl_spta = '$tgl' AND selektor_status = 0 GROUP BY kode_blok,persno_pta";
		$th1 = $this->db->query($sqla)->result();
		$isi1 = '';
		foreach ($th1 as $k) {
			$isi1 .= '<tr><td><span class="badge bg-red">'.$k->ttl.'</span> '.$k->kode_blok.'<br />'.$k->deskripsi_blok.'</td><td>'.$k->name.'</td></tr>';
		}

		$sqla = "SELECT a.`no_spat`,b.`kode_blok`,b.`deskripsi_blok`,c.no_angkutan,c.tgl_selektor FROM t_spta a 
INNER JOIN sap_field b ON a.`kode_blok`=b.`kode_blok` 
INNER JOIN t_selektor c on c.id_spta=a.id
WHERE kode_affd = '$afd' AND tgl_spta = '$tgl' AND selektor_status = 1";
		$th1 = $this->db->query($sqla)->result();
		$isi2 = '';
		foreach ($th1 as $k) {
			$isi2 .= '<tr><td>'.$k->no_spat.'</td><td>'.$k->kode_blok.'<br />'.$k->deskripsi_blok.'</td><td>'.$k->no_angkutan.'<br />'.$k->tgl_selektor.'</td></tr>';
		}

    	$htm = '<div class="page-content-wrapper m-t">
	<ul class="nav nav-tabs">
	  <li class="active"><a href="#blmmasuk"  data-toggle="tab" aria-expanded="true">Belum Masuk </a></li>
	  <li class=""><a href="#selektor"  data-toggle="tab" aria-expanded="false">Sudah Selektor </a></li>
	</ul>	
	<br />
	<div class="tab-content">
	  <div class="tab-pane m-t active" id="blmmasuk">
	  <table class="table table-bordered display dataTable no-footer" id="blmsk">
	  <thead>
	  <tr>
	  <th>Petak Blok</th>
	  <th>PTA</th>
	  </tr>
	  </thead>'.$isi1.'</table>
	  </div>
	  <div class="tab-pane m-t " id="selektor">
	  <table class="table table-bordered display dataTable no-footer" id="selek">
	  <thead>
	  <tr>
	  <th>No SPTA</th>
	  <th>Petak Blok</th>
	  <th>Tgl Masuk</th>
	  </tr>
	  <thead>
	  '.$isi2.'</table>
	  </div>
	  </div></div>';
	  $htm .= '';
	  echo $htm;
    }


    public function viewperjam($tgl,$jns){
		//jns 1 selektor,2 timbangan, 3 gilingan
		$tgl = str_replace('%20', '', $tgl);
		$cc = CNF_COMPANYCODE;
		echo $tgl;
		$leftjoin = '';
		$fieldj = "";
		if($jns == 1){
			if($cc == 'N011' || $cc == 'N009' || $cc == 'N002'){
				$htm = '<table class="table ">
                            <thead>
                              <tr>
                                <th>Jam</th>
                                <th class="text-right" >Truk</th>
                                <th class="text-right" >Lori</th>
                                <th class="text-right" >Total</th>
                              </tr>
                            </thead>';
			}else{
				$htm = '<table class="table ">
                            <thead>
                              <tr>
                                <th>Jam</th>
                                <th class="text-right" >Truk</th>
                                <th class="text-right" >Odong2</th>
                                <th class="text-right" >Traktor</th>
                                <th class="text-right" >Total</th>
                              </tr>
                            </thead>';
			}
			
			$fieldj = "jm.`jam` as jjm,selektor.*";
			$leftjoin = "LEFT JOIN (SELECT COUNT(id_spta) AS ttl,SUM(IF(b.`jenis_spta`='TRUK',1,0)) AS truk,SUM(IF(b.`jenis_spta`='LORI',1,0)) AS lori,SUM(IF(b.`jenis_spta`='ODONG2',1,0)) AS odong2,SUM(IF(b.`jenis_spta`='TRAKTOR',1,0)) AS traktor,CONVERT(DATE_FORMAT(a.tgl_selektor,'%H') USING utf8) AS jam FROM t_selektor a
INNER JOIN t_spta b ON a.`id_spta`=b.`id` WHERE a.`tgl_urut`='$tgl' AND a.`ditolak_sel` = 0
GROUP BY DATE_FORMAT(a.tgl_selektor,'%H')) AS selektor ON selektor.jam=jm.jam";
		}else if($jns == 2){
			if($cc == 'N011' || $cc == 'N009'  || $cc == 'N002'){
				$htm = '<table class="table ">
                            <thead>
                              <tr>
                                <th>Jam</th>
                                <th class="text-right" >Truk</th>
                                <th class="text-right" >Lori</th>
                                <th class="text-right" >Total</th>
                              </tr>
                            </thead>';
			}else{
				$htm = '<table class="table ">
                            <thead>
                              <tr>
                                <th>Jam</th>
                                <th class="text-right" >Truk</th>
                                <th class="text-right" >Odong2</th>
                                <th class="text-right" >Traktor</th>
                                <th class="text-right" >Total</th>
                              </tr>
                            </thead>';
			}
			$fieldj = "jm.`jam` as jjm,timbangan.*";
			$leftjoin = "LEFT JOIN (SELECT SUM(a.`netto_final`) AS ttl,SUM(IF(b.`jenis_spta`='TRUK',a.`netto_final`,0)) AS truk,SUM(IF(b.`jenis_spta`='LORI',a.`netto_final`,0)) AS lori,SUM(IF(b.`jenis_spta`='ODONG2',a.`netto_final`,0)) AS odong2,SUM(IF(b.`jenis_spta`='TRAKTOR',a.`netto_final`,0)) AS traktor,CONVERT(DATE_FORMAT(b.timb_netto_tgl,'%H') USING utf8) AS jam FROM t_timbangan a
INNER JOIN t_spta b ON a.`id_spat`=b.`id` WHERE b.`tgl_timbang`='$tgl'
GROUP BY DATE_FORMAT(b.timb_netto_tgl,'%H')) AS timbangan ON timbangan.jam=jm.jam";
		}else{ 
			$htm = '<table class="table ">
                            <thead>
                              <tr>
                                <th>Jam</th>
                                <th class="text-right" >Gil 1</th>
                                <th class="text-right" >Gil 2</th>
                                <th class="text-right" >Total</th>
                              </tr>
                            </thead>';
			$fieldj = "jm.`jam` as jjm,giling.*";
			$leftjoin = "LEFT JOIN (SELECT SUM(a.`netto_final`) AS ttl,SUM(IF(c.`gilingan`='1',a.`netto_final`,0)) AS gil1,SUM(IF(c.`gilingan`='5',a.`netto_final`,0)) AS gil2,CONVERT(DATE_FORMAT(b.`meja_tebu_tgl`,'%H') USING utf8) AS jam FROM t_timbangan a
INNER JOIN t_spta b ON a.`id_spat`=b.`id` 
INNER JOIN t_meja_tebu c ON c.id_spta = b.`id` WHERE b.`tgl_giling`='$tgl'
GROUP BY DATE_FORMAT(b.`meja_tebu_tgl`,'%H')) AS giling ON giling.jam=jm.jam";
		}
		$sql = $this->db->query("SELECT $fieldj FROM t_lap_jam jm
				$leftjoin
 ORDER BY jm.`id`")->result();
		$ttltruk=0;$ttllori=0;$ttlodong2=0;$ttltraktor=0;$ttlall=0;
		$ttlgil1=0;$ttlgil2=0;
		foreach($sql as $r){
			if($jns == 1){
				if($cc == 'N011' || $cc == 'N009'  || $cc == 'N002'){
					$htm .="<tr>
					<td style='text-align:left;color:blue;font-weight:bold'>".$r->jjm.":00</td>
					<td style='text-align:right;'>".number_format($r->truk)."</td>
					<td style='text-align:right;'>".number_format($r->lori)."</td>
					<td style='text-align:right;color:red;font-weight:bold'>".number_format($r->ttl)."</td></tr>";
				}else{
										$htm .="<tr>
					<td style='text-align:left;color:blue;font-weight:bold'>".$r->jjm.":00</td>
					<td style='text-align:right;'>".number_format($r->truk)."</td>
					<td style='text-align:right;'>".number_format($r->odong2)."</td>
					<td style='text-align:right;'>".number_format($r->traktor)."</td>
					<td style='text-align:right;color:red;font-weight:bold'>".number_format($r->ttl)."</td></tr>";

				}
				
				$ttltruk += $r->truk;
				$ttllori += $r->lori;
				$ttlodong2 += $r->odong2;
				$ttltraktor += $r->traktor;
				$ttlall += $r->ttl;
				
			}else if($jns == 2){
				if($cc == 'N011' || $cc == 'N009'  || $cc == 'N002'){
					$htm .="<tr>
				<td style='text-align:left;color:blue;font-weight:bold'>".$r->jjm.":00</td>
				<td style='text-align:right;'>".number_format($r->truk/1000,2)."</td>
				<td style='text-align:right;'>".number_format($r->lori/1000,2)."</td>
				<td style='text-align:right;color:red;font-weight:bold'>".number_format($r->ttl/1000,2)."</td></tr>";
				}else{
					$htm .="<tr>
				<td style='text-align:left;color:blue;font-weight:bold'>".$r->jjm.":00</td>
				<td style='text-align:right;'>".number_format($r->truk/1000,2)."</td>
				<td style='text-align:right;'>".number_format($r->odong2/1000,2)."</td>
				<td style='text-align:right;'>".number_format($r->traktor/1000,2)."</td>
				<td style='text-align:right;color:red;font-weight:bold'>".number_format($r->ttl/1000,2)."</td></tr>";
				}
				
				$ttltruk += $r->truk;
				$ttllori += $r->lori;
				$ttlodong2 += $r->odong2;
				$ttltraktor += $r->traktor;
				$ttlall += $r->ttl;
				
			}else{
				$htm .="<tr>
				<td style='text-align:left;color:blue;font-weight:bold'>".$r->jjm.":00</td>
				<td style='text-align:right;'>".number_format($r->gil1/1000,2)."</td>
				<td style='text-align:right;'>".number_format($r->gil2/1000,2)."</td>
				<td style='text-align:right;color:red;font-weight:bold'>".number_format($r->ttl/1000,2)."</td></tr>";
				$ttlgil1 += $r->gil1;
				$ttlgil2 += $r->gil2;
				$ttlall += $r->ttl;
			}
		}
		
		if($jns == 1){
			if($cc == 'N011' || $cc == 'N009'  || $cc == 'N002'){
				$htm .= "<tr style='background:black;color:white'><td>TOTAL</td><td align='right'>".number_format($ttltruk)."</td><td align='right'>".number_format($ttllori)."</td><td align='right'>".number_format($ttlall)."</td></tr>";
			}else{
				$htm .= "<tr style='background:black;color:white'><td>TOTAL</td><td align='right'>".number_format($ttltruk)."</td><td align='right'>".number_format($ttlodong2)."</td><td align='right'>".number_format($ttltraktor)."</td><td align='right'>".number_format($ttlall)."</td></tr>";
			}
			
		}else if($jns == 2){
			if($cc == 'N011' || $cc == 'N009'  || $cc == 'N002'){
				$htm .= "<tr style='background:black;color:white'><td>TOTAL</td><td align='right'>".number_format($ttltruk/1000,2)."</td><td align='right'>".number_format($ttllori/1000,2)."</td><td align='right'>".number_format($ttlall/1000,2)."</td></tr>";
			}else{
				$htm .= "<tr style='background:black;color:white'><td>TOTAL</td><td align='right'>".number_format($ttltruk/1000,2)."</td><td align='right'>".number_format($ttlodong2/1000,2)."</td><td align='right'>".number_format($ttltraktor/1000,2)."</td><td align='right'>".number_format($ttlall/1000,2)."</td></tr>";
			}
		}else{
			$htm .= "<tr style='background:black;color:white'><td>TOTAL</td><td align='right'>".number_format($ttlgil1/1000,2)."</td><td align='right'>".number_format($ttlgil2/1000,2)."</td><td align='right'>".number_format($ttlall/1000,2)."</td></tr>";
		}
		
		echo $htm.'</table>';
 
	}

	
	
	
	
	
	
}
