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
		


		$this->data['content'] = $this->load->view('dashboard',$this->data,true);
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
