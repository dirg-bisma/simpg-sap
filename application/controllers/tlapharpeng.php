<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Tlapharpeng extends SB_Controller 
{

	protected $layout 	= "layouts/main";
	public $module 		= 'tlapharpeng';
	public $per_page	= '10';
	public $idx			= '';

	function __construct() {
		parent::__construct();
		
		$this->load->model('tlapharpengmodel');
		$this->model = $this->tlapharpengmodel;
		$idx = $this->model->primaryKey;
		
		$this->info = $this->model->makeInfo( $this->module);
		$this->access = $this->model->validAccess($this->info['id']);	
		$this->data = array_merge( $this->data, array(
			'pageTitle'	=> 	$this->info['title'],
			'pageNote'	=>  $this->info['note'],
			'pageModule'	=> 'tlapharpeng',
		));
		$this->col = array();
		$this->con = array();
		$inf = $this->info['config']['grid'];
		$inf = SiteHelpers::array_sort($inf, 'sortlist', SORT_ASC);
		$in=0;
		foreach ($inf as $key => $t) {
			if($t['view'] =='1'){
				
				$in++;
				$this->col[$in] = $t['field'];
				$this->con[$in] = $t['conn'];
				
			}
			
		}
		
		if(!$this->session->userdata('logged_in')) redirect('user/login',301);
		
	}

	function grids(){
		
		$sort = $this->model->primaryKey; 
		$order = 'asc';
		$filter = "";
		//$filter = (!is_null($this->input->get('search', true)) ? $this->buildSearch() : '');
		//order 
		if(isset($_POST['order']))
        {
            if(($_POST['order']['0']['column'])==0){
        		$sort = $this->col[($_POST['order']['0']['column'])+1];
            	$order = $_POST['order']['0']['dir'];
        	}else{
            	$sort = $this->col[($_POST['order']['0']['column'])];
            	$order = $_POST['order']['0']['dir'];
        	}

        }

        for ($i=0; $i < count($this->col) ; $i++) { 
        	
            if(isset($_POST['search']['value']) && $_POST['search']['value'] != ''){
            	if($i==0){
            		$filter .= " AND ".$this->col[$i+1]." LIKE '%".$_POST['search']['value']."%'";
            	}else{
            		$filter .= " OR ".$this->col[$i+1]." LIKE '%".$_POST['search']['value']."%'";
            	}
            }
        }

		$params = array(
			'limit'		=> $_POST['start'],
			'page'		=> $_POST['length'],
			'sort'		=> $sort ,
			'order'		=> $order,
			'params'	=> $filter,
			'global'	=> (isset($this->access['is_global']) ? $this->access['is_global'] : 0 )
		);
		// Get Query 
		$results = $this->model->getRows( $params );
		$rows = $results['rows'];
		$total = $results['total'];
		$totalfil = $results['totalfil'];
		
		//run data to view
		$data = array();$no=0;
		foreach ($rows as $dt) {
            $row = array();
            $row[] = $no+1;
            for ($i=0; $i < count($this->col) ; $i++) { 
            		$field = $this->col[$i+1];
            		if($field == 'status'){
            			if($dt->status == 1) $row[] = 'Buat';
            			else $row[] = 'Validasi';
            		}else{
            			$conn = (isset($this->con[$i+1]) ? $this->con[$i+1] : array() ) ;
						$row[] = SiteHelpers::gridDisplay($dt->$field , $field , $conn );
					}
            }
 
            //add html for action
            $btn ='';
			$idku = $this->model->primaryKey;
            if($this->access['is_detail'] ==1){
            	$btn .= '<a href='.site_url('tlapharpeng/show/'.$dt->$idku).'  class="tips "  title="view"><i class="fa  fa-search"></i>  </a> &nbsp;&nbsp;';
            }
            
            if($this->access['is_remove'] ==1 && $dt->status == 0){
            	$btn .= '<a href="#" onclick="ConfirmDelete(\''.site_url('tlapharpeng/destroy/').'\','.$dt->$idku.')"  class="tips "  title="Delete"><i class="fa  fa-trash"></i>  </a>';
            	
            }
           
 			$row[] = $btn;
            $data[] = $row;
            $no++;
        }
         $output = array(
                        "draw" => $_POST['draw'],
                        "recordsTotal" => $total,
                        "recordsFiltered" => $totalfil,
                        "data" => $data,
                );
        //output to json format
        echo json_encode($output);

	}

	function validasidata($id,$hg){
		$this->inputLogs("Validasi Laporan Harian Oleh ".$this->session->userdata('fid')." Pada Hari Giling ke ".$hg);
		$this->db->query("UPDATE t_lap_harian_pengolahan_ptpn SET status = 2,tgl_validasi=NOW(),user_validasi='".$this->session->userdata('fid')."'");
		$this->session->set_flashdata('message',SiteHelpers::alert('success','Berhasil validasi data..'));
			redirect('tlapharpeng/show/'.$id,301);
	}
	
	function index() 
	{
		if($this->access['is_view'] ==0)
		{ 
			$this->session->set_flashdata('error',SiteHelpers::alert('error','Your are not allowed to access the page'));
			redirect('dashboard',301);
		}	
		
		$this->data['tableGrid'] 	= $this->info['config']['grid'];

		// Group users permission
		$this->data['access']		= $this->access;
		// Render into template
		
		$this->data['content'] = $this->load->view('tlapharpeng/index',$this->data, true );
		
    	$this->load->view('layouts/main', $this->data );
    
	  
	}
	
	function show( $id = null) 
	{
		if($this->access['is_detail'] ==0)
		{ 
			$this->session->set_flashdata('error',SiteHelpers::alert('error','Your are not allowed to access the page'));
			redirect('dashboard',301);
	  	}		

		$row = $this->db->query("SELECT * FROM t_lap_harian_pengolahan_ptpn WHERE id='".$id."'")->row();
		if($row)
		{
			$this->data['rw'] =  $row;
		} else {
			$this->data['row'] = $this->model->getColumnTable('t_lap_harian_pengolahan'); 
		}
		
		$this->data['id'] = $id;
		$this->data['content'] =  $this->load->view('tlapharpeng/view', $this->data ,true);	  
		$this->load->view('layouts/main',$this->data);
	}


	function printxs( $id = null) 
	{
		if($this->access['is_detail'] ==0)
		{ 
			$this->session->set_flashdata('error',SiteHelpers::alert('error','Your are not allowed to access the page'));
			redirect('dashboard',301);
	  	}		


		$row = $this->db->query("SELECT * FROM t_lap_harian_pengolahan_ptpn WHERE id='".$id."'")->row();
		if($row)
		{
			$this->data['rw'] =  $row;
			$this->inputLogs("Print Laporan Harian Oleh ".$this->session->userdata('fid')." Pada Hari Giling ke ".$row->hari_giling);
		} else {
			$this->data['row'] = $this->model->getColumnTable('t_lap_harian_pengolahan'); 
		}
		
		$this->data['id'] = $id;
		echo  $this->load->view('tlapharpeng/print', $this->data ,true);	  
		
	}
  
	function add( $id = null ) 
	{
		if($id =='')
			if($this->access['is_add'] ==0) redirect('dashboard',301);

		if($id !='')
			if($this->access['is_edit'] ==0) redirect('dashboard',301);	

		$row = $this->model->getRow( $id );
		if($row)
		{
			$this->data['row'] =  $row;
		} else {
			$this->data['row'] = $this->model->getColumnTable('t_lap_harian_pengolahan'); 
		}
	
		$this->data['id'] = $id;
		$this->data['content'] = $this->load->view('tlapharpeng/form',$this->data, true );		
	  	$this->load->view('layouts/main', $this->data );
	
	}
	
	function save() {
		
		$rules = $this->validateForm();

		$this->form_validation->set_rules( $rules );
		if( $this->form_validation->run() )
		{
			$data = $_POST;
			//var_dump($data);die();
			$this->db->query("DELETE FROM t_lap_harian_pengolahan_ptpn WHERE plant_code='".$data['plant_code']."' AND hari_giling='".$data['hari_giling']."'");

			$data['tgl_created'] = date('Y-m-d H:i:s');
			$data['user_created'] = $this->session->userdata('fid');
			$ID = $this->model->insertRow($data , $this->input->get_post( 'id' , true ));
			// Input logs
			if( $this->input->get( 'id' , true ) =='')
			{
				$this->inputLogs("Generate Laporan Harian Oleh ".$this->session->userdata('fid')." Pada Hari Giling ke ".$data['hari_giling']);
			} else {
				$this->inputLogs("Generate Laporan Harian Oleh ".$this->session->userdata('fid')." Pada Hari Giling ke ".$data['hari_giling']);
			}
			// Redirect after save	
			$this->session->set_flashdata('message',SiteHelpers::alert('success'," Data has been saved succesfuly !"));
			if($this->input->post('apply'))
			{
				redirect( 'tlapharpeng/add/'.$ID,301);
			} else {
				redirect( 'tlapharpeng',301);
			}			
			
			
		} else {
			$data =	array(
					'message'	=> 'Ops , The following errors occurred',
					'errors'	=> validation_errors('<li>', '</li>')
					);			
			$this->displayError($data);
		}
	}

	function destroy()
	{
		if($this->access['is_remove'] ==0)
		{ 
			echo "err : maaf anda tidak memiliki hak untuk menghapus data";
	  	}
			
		$this->model->destroy($_POST['id']);
		$this->inputLogs("ID : ".$_POST['id']."  , Has Been Removed Successfull");
		echo "ID : ".$_POST['id']."  , berhasil dihapus !!";
		
	}


	function getharitglgiling($hg){
		if($hg != 0){
			$hg = $hg-1;
			$sql = "SELECT '".($hg+1)."' as hg,DATE_ADD(DATE(IFNULL(awal_giling,NOW())),INTERVAL ".$hg." DAY) AS tgl FROM tb_setting";
			$r = $this->db->query($sql)->row();


			$pg = CNF_PLANCODE;

			$colom = $this->db->query("SHOW COLUMNS FROM `t_lap_harian_pengolahan_ptpn`")->result();

			$sqldt = $this->db->query("SELECT
  `id`                              AS `id`,
  `company_code`                    AS `company_code`,
  `plant_code`                      AS `plant_code`,
  `hari_giling`                     AS `hari_giling`,
  `tgl_giling`                      AS `tgl_giling`,
  `thn_giling`                      AS `thn_giling`,
  `kis`                             AS `kis`,
  `kes`                             AS `kes`,
  kis_inc,
  sum(`jb_hr`) as jb_hr,
  sum(`jam_kampanye_hr`) as jam_kampanye_hr,
  sum(`ha_tebang_tr`)                    AS `ha_tebang_tr`,
  sum(`ha_tebang_ts`)                    AS `ha_tebang_ts`,
  sum(`ha_tebang_ts_saudara`)            AS `ha_tebang_ts_saudara`,
  sum(`ha_tebang_total`)                 AS `ha_tebang_total`,
  sum(`ton_tebang_tr`)                   AS `ton_tebang_tr`,
  sum(`ton_tebang_ts`)                   AS `ton_tebang_ts`,
  sum(`ton_tebang_ts_saudara`)           AS `ton_tebang_ts_saudara`,
  sum(`ton_tebang_total`)                AS `ton_tebang_total`,
  sum(`ha_giling_tr`)                    AS `ha_giling_tr`,
  sum(`ha_giling_ts`)                    AS `ha_giling_ts`,
  sum(`ha_giling_ts_saudara`)            AS `ha_giling_ts_saudara`,
  sum(`ha_giling_total`)                 AS `ha_giling_total`,
  sum(`ton_giling_tr`)                   AS `ton_giling_tr`,
  sum(`ton_giling_ts`)                   AS `ton_giling_ts`,
  sum(`ton_giling_ts_saudara`)           AS `ton_giling_ts_saudara`,
  sum(`ton_giling_total`)                AS `ton_giling_total`,
  sum(`kristal_tr`)                      AS `kristal_tr`,
  sum(`kristal_ts`)                      AS `kristal_ts`,
  sum(`kristal_ts_saudara`)              AS `kristal_ts_saudara`,
  sum(`kristal_total`)                   AS `kristal_total`,
  ROUND(((sum(`kristal_tr`)/sum(`ton_giling_tr`))*100) ,2)                     AS `rend_tr`,
  ROUND(((sum(`kristal_ts`)/sum(`ton_giling_ts`))*100) ,2)                         AS `rend_ts`,
  ROUND(((sum(`kristal_ts_saudara`)/sum(`ton_giling_ts_saudara`))*100) ,2)                 AS `rend_ts_saudara`,
  ROUND(((sum(`kristal_total`)/sum(`ton_giling_total`))*100) ,2)                      AS `rend_total`,
  sum(`gula_pg_ts`)                      AS `gula_pg_ts`,
  sum(`gula_pg_eks_ts_saudara`)          AS `gula_pg_eks_ts_saudara`,
  sum(`gula_pg_eks_tr`)                  AS `gula_pg_eks_tr`,
  sum(`gula_pg_total`)                   AS `gula_pg_total`,
  sum(`gula_tr_bagihasil`)               AS `gula_tr_bagihasil`,
  sum(`gula_tr_ts_saudara`)              AS `gula_tr_ts_saudara`,
  sum(`gula_produksi`)                   AS `gula_produksi`,
  sum(`gula_ex_sisan`)                   AS `gula_ex_sisan`,
  sum(`sisan_diolah`)                    AS `sisan_diolah`,
  sum(`raw_sugar_diolah`)                AS `raw_sugar_diolah`,
  sum(`gula_repro_thn_lalu`)             AS `gula_repro_thn_lalu`,
  sum(`gula_repro_thn_ini`)             AS `gula_repro_thn_ini`,
  `tetes_produksi`                  AS `tetes_produksi`,
  `tetes_sisan`                     AS `tetes_sisan`,
  `tetes_sto`                       AS `tetes_sto`,
  `tetes_ex_repro`                  AS `tetes_ex_repro`,
  `tetes_total`                     AS `tetes_total`,
  sum(`tebu_terbakar_tr`)                AS `tebu_terbakar_tr`,
  sum(`tebu_terbakar_ts`)                AS `tebu_terbakar_ts`,
  sum(`tebu_terbakar_ts_saudara`)        AS `tebu_terbakar_ts_saudara`,
  sum(`tebu_terbakar_total`)             AS `tebu_terbakar_total`,
  sum(`jam_berhenti_a`)                AS `jam_berhenti_a`,
  sum(`jam_berhenti_b`)                  AS `jam_berhenti_b`,
  sum(`total_jb`)                      AS `total_jb`,
  sum(`jam_giling`)                      AS `jam_giling`,
  sum(`jam_kampanye`)                   AS `jam_kampanye`,
  `jba_persen_jamgil`               AS `jba_persen_jamgil`,
  `jbb_persen_jamgil`               AS `jbb_persen_jamgil`,
  `total_persen_jamgil`             AS `total_persen_jamgil`,
  `ampas_ton`                       AS `ampas_ton`,
  `persen_pol_ampas`                AS `persen_pol_ampas`,
  `blotong_ton`                     AS `blotong_ton`,
  `persen_pol_blotong`              AS `persen_pol_blotong`,
  `pol_dlm_hasil_taksasi_ton`       AS `pol_dlm_hasil_taksasi_ton`,
  `pol_dlm_hasil_taksasi_persenpol` AS `pol_dlm_hasil_taksasi_persenpol`,
  SUM(`residu`)                         AS `residu`,
  SUM(`bba_ton`)                         AS `bba_ton`,
  SUM(`bba_rupiah`)                      AS `bba_rupiah`,
  `keterangan_jb`                   AS `keterangan_jb`,
  `icumsa`                          AS `icumsa`,
  `status`                          AS `status`
FROM `t_lap_harian_pengolahan_ptpn` WHERE hari_giling <= '".($hg)."' AND plant_code = '".$pg."'")->row();


$sqlhutanggula = "SELECT b.`kode_kat_lahan`,SUM(gula_ptr)/1000 AS gula_ptr,SUM(gula_pg)/1000 AS gulapg,SUM(a.`gula_total`)/1000 AS totalgula
FROM t_ari a INNER JOIN t_spta b ON b.`id`=a.`id_spta` 
WHERE b.`tgl_giling` <= '".$r->tgl."' 
GROUP BY b.`kode_kat_lahan`";
			$rwsqlhutang = $this->db->query($sqlhutanggula)->result();
			$gulaptr = 0;
			$gulamiliktssaudara = 0;
			$gulapgextr = 0;
			$gulapg = 0;
			$gulapgextssaudara = 0;
			foreach ($rwsqlhutang as $v) {
				if($v->kode_kat_lahan == 'TS-TR'){
					$gulamiliktssaudara += $v->gulapg;
				}else if(substr($v->kode_kat_lahan,0,2) == 'TS'){
					$gulapg += $v->gulapg;
				}else{
					$gulaptr += $v->gula_ptr;
					$gulapgextr += $v->gulapg;
				}
			}


			/*query hari ini simpg*/
			$sqlhidigiling = $this->db->query("SELECT 
IF(b.`kode_kat_lahan` = 'TS-TR','TS-TR',
IF(LEFT(b.kode_kat_lahan,2)='TS','TS','TR')) AS kode_kat_lahan,
ROUND(SUM(hablur_ari)/1000,3) AS kristal,SUM(c.`netto_final`)/1000 AS tebudigiling,
SUM(d.ha_tertebang) AS ha_digiling,
sum(IF(e.kondisi_tebu = '".CNF_MUTU_TERBAKAR."',c.netto_final,0))/1000 as tebuterbakar
 FROM t_ari a 
 INNER JOIN t_spta b ON b.`id`=a.`id_spta` 
 INNER JOIN t_timbangan c ON c.`id_spat`=b.`id`
 INNER JOIN t_selektor d ON d.id_spta = b.id
 INNER JOIN t_meja_tebu e ON e.id_spta = b.id
 WHERE b.tgl_giling ='".$r->tgl."'
GROUP BY IF(b.`kode_kat_lahan` = 'TS-TR','TS-TR',
IF(LEFT(b.kode_kat_lahan,2)='TS','TS','TR'))")->result();
			$tongilingts=0;$tongilingtr=0;$tongilingtransfer=0;
			$hagilingts=0;$hagilingtr=0;$hagilingtransfer=0;
			$hablurts=0;$hablurtr=0;$hablurtransfer=0;
			$tebuterbakarts=0;$tebuterbakartr=0;$tebuterbakartransfer=0;
			foreach ($sqlhidigiling as $k) {
				if($k->kode_kat_lahan == 'TS-TR'){
					$tongilingtransfer+= $k->tebudigiling;
					$hagilingtransfer+=$k->ha_digiling;
					$hablurtransfer+=$k->kristal;
					$tebuterbakartransfer+=$k->tebuterbakar;
				}else if($k->kode_kat_lahan == 'TS'){
					$tongilingts+= $k->tebudigiling;
					$hagilingts+=$k->ha_digiling;
					$hablurts+=$k->kristal;
					$tebuterbakarts+=$k->tebuterbakar;
				}else if($k->kode_kat_lahan == 'TR'){
					$tongilingtr+= $k->tebudigiling;
					$hagilingtr+=$k->ha_digiling;
					$hablurtr+=$k->kristal;
					$tebuterbakartr+=$k->tebuterbakar;
				}
			}

			if($hg == 0){
				$sqlhiditebang = $this->db->query("SELECT 
IF(b.`kode_kat_lahan` = 'TS-TR','TS-TR',
IF(LEFT(b.kode_kat_lahan,2)='TS','TS','TR')) AS kode_kat_lahan,SUM(c.`netto_final`)/1000 AS tebuditebang,
SUM(d.ha_tertebang) AS ha_ditebang
 FROM  t_spta b  
 INNER JOIN t_timbangan c ON c.`id_spat`=b.`id`
 INNER JOIN t_selektor d ON d.id_spta = b.id
 WHERE b.tgl_timbang <= '".$r->tgl."'
GROUP BY IF(b.`kode_kat_lahan` = 'TS-TR','TS-TR',
IF(LEFT(b.kode_kat_lahan,2)='TS','TS','TR'))")->result();
			}else{
				$sqlhiditebang = $this->db->query("SELECT 
IF(b.`kode_kat_lahan` = 'TS-TR','TS-TR',
IF(LEFT(b.kode_kat_lahan,2)='TS','TS','TR')) AS kode_kat_lahan,SUM(c.`netto_final`)/1000 AS tebuditebang,
SUM(d.ha_tertebang) AS ha_ditebang
 FROM  t_spta b  
 INNER JOIN t_timbangan c ON c.`id_spat`=b.`id`
 INNER JOIN t_selektor d ON d.id_spta = b.id
 WHERE b.tgl_timbang ='".$r->tgl."'
GROUP BY IF(b.`kode_kat_lahan` = 'TS-TR','TS-TR',
IF(LEFT(b.kode_kat_lahan,2)='TS','TS','TR'))")->result();	
			}
			
			$tontebangts=0;$tontebangtr=0;$tontebangtransfer=0;
			$hatebangts=0;$hatebangtr=0;$hatebangtransfer=0;
			foreach ($sqlhiditebang as $k) {
				if($k->kode_kat_lahan == 'TS-TR'){
					$tontebangtransfer+= $k->tebuditebang;
					$hatebangtransfer+=$k->ha_ditebang;
				}else if($k->kode_kat_lahan == 'TS'){
					$tontebangts+= $k->tebuditebang;
					$hatebangts+=$k->ha_ditebang;
				}else if($k->kode_kat_lahan == 'TR'){
					$tontebangtr+= $k->tebuditebang;
					$hatebangtr+=$k->ha_ditebang;
				}
			}

			$skgsbh = array(
				'ha_tebang_tr'=>$hatebangtr,
				'ha_tebang_ts'=>$hatebangts,
				'ha_tebang_ts_saudara'=>$hatebangtransfer,
				'ton_tebang_tr'=>$tontebangtr,
				'ton_tebang_ts'=>$tontebangts,
				'ton_tebang_ts_saudara'=>$tontebangtransfer,
				'ha_giling_tr'=>$hagilingtr,
				'ha_giling_ts'=>$hagilingts,
				'ha_giling_ts_saudara'=>$hagilingtransfer,
				'ton_giling_tr'=>$tongilingtr,
				'ton_giling_ts'=>$tongilingts,
				'ton_giling_ts_saudara'=>$tongilingtransfer,
				'tebu_terbakar_ts'=>$tebuterbakarts,
				'tebu_terbakar_tr'=>$tebuterbakartr,
				'tebu_terbakar_ts_saudara'=>$tebuterbakartransfer,
				'kristal_tr'=>$hablurtr,
				'kristal_ts'=>$hablurts,
				'kristal_ts_saudara'=>$hablurtransfer,
				'sbh_tr_sd' => $gulaptr,'sbh_tr_ts_saudara_sd' => $gulamiliktssaudara,'sbh_ts_sd' => $gulapg,'sbh_ts_tr_sd' => $gulapgextr,'sbh_ts_ts_saudara_sd' => $gulapgextssaudara);



			$sqlskg = $this->db->query("SELECT * FROM t_lap_harian_pengolahan_ptpn WHERE hari_giling = '".($hg+1)."' AND plant_code = '".$pg."'")->row();
			$arr = array('head'=>$r,'col'=>$colom,'skg'=>$sqlskg,'yl'=>$sqldt,'skgsbh'=>$skgsbh);
			echo json_encode($arr);
		}
	}


	function datacek($kode,$hg){
		$a = $this->db->query("SELECT id from t_lap_harian_pengolahan_ptpn where plant_code = '".$kode."' AND hari_giling='".$hg."' AND status != 1")->row();
		if($a){
			echo 'Data Sudah divalidasi.. Maka Tidak Bisa di edit !!';
		}else{
			echo '0';
		}
	}


}
