<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Tanalisarendemen extends SB_Controller 
{

	protected $layout 	= "layouts/main";
	public $module 		= 'tanalisarendemen';
	public $per_page	= '10';
	public $idx			= '';

	function __construct() {
		parent::__construct();
		
		$this->load->model('tanalisarendemenmodel');
		$this->model = $this->tanalisarendemenmodel;
		$idx = $this->model->primaryKey;
		
		$this->info = $this->model->makeInfo( $this->module);
		$this->access = $this->model->validAccess($this->info['id']);	
		$this->data = array_merge( $this->data, array(
			'pageTitle'	=> 	$this->info['title'],
			'pageNote'	=>  $this->info['note'],
			'pageModule'	=> 'tanalisarendemen',
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
	
	function gridMejaTebu(){
		$result = $this->db->query('SELECT a.id,a.`no_spat`,a.`meja_tebu_tgl`,b.`warna_meja_tebu`,b.`kode_meja_tebu` FROM t_spta  a INNER JOIN t_meja_tebu b ON a.`id`=b.`id_spta` WHERE meja_tebu_status = 1 AND ari_status = 0 AND b.gilingan = "'.$this->session->userdata('gilingan').' LIMIT 15 ORDER BY a.`meja_tebu_tgl` ASC"')->result();
		$data = array();
		foreach ($result as $dt) {
			$spta = $dt->no_spat;
			$row = array();
            $row[] = '<span style="background:'.$dt->warna_meja_tebu.';padding:5px">'.$dt->kode_meja_tebu.'</span>';
            $row[] = $spta;
            $row[] = $dt->meja_tebu_tgl;
			
			$btn = '<a href="#" onclick="getDataSPTA(\''.$spta.'\')"  class="tips "  title="Get Data"><i class="fa  fa-arrow-circle-right"></i>  </a>';
			$row[] = $btn;
			$data[] = $row;
		}
		
		$output = array(
                        "draw" => $_POST['draw'],
                        "recordsTotal" => 10,
                        "recordsFiltered" => 0,
                        "data" => $data,
                );
        //output to json format
        echo json_encode($output);
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
            		$conn = (isset($this->con[$i+1]) ? $this->con[$i+1] : array() ) ;
					$row[] = SiteHelpers::gridDisplay($dt->$field , $field , $conn );
            }
 
            //add html for action
            $btn ='';
			$idku = $this->model->primaryKey;
            
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
		
		
		
		if(CNF_METODE == 1){
		
		$this->data['content'] = $this->load->view('tanalisarendemen/formAri',$this->data, true );
		}else{
		$this->data['content'] = $this->load->view('tanalisarendemen/form',$this->data, true );
		}
		$this->data['content'] .= $this->load->view('tanalisarendemen/index',$this->data, true );
		
    	$this->load->view('layouts/main', $this->data );
    
	  
	}
	
	function show( $id = null) 
	{
		if($this->access['is_detail'] ==0)
		{ 
			$this->session->set_flashdata('error',SiteHelpers::alert('error','Your are not allowed to access the page'));
			redirect('dashboard',301);
	  	}		

		$row = $this->model->getRow($id);
		if($row)
		{
			$this->data['row'] =  $row;
		} else {
			$this->data['row'] = $this->model->getColumnTable('t_ari'); 
		}
		
		$this->data['id'] = $id;
		$this->data['content'] =  $this->load->view('tanalisarendemen/view', $this->data ,true);	  
		$this->load->view('layouts/main',$this->data);
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
			$this->data['row'] = $this->model->getColumnTable('t_ari'); 
		}
	
		$this->data['id'] = $id;
		$this->data['content'] = $this->load->view('tanalisarendemen/form',$this->data, true );		
	  	$this->load->view('layouts/main', $this->data );
	
	}
	
	function save() {
		
		$rules = $this->validateForm();

		$this->form_validation->set_rules( $rules );
		if( $this->form_validation->run() )
		{
			$data = $this->validatePost();
			$data['tgl_ari'] = $_POST['tgl_ari'].' '.$_POST['jam_ari'];
			$data['ptgs_ari'] = $this->session->userdata('fid');
			$hk = ($_POST['persen_pol_ari'] / $_POST['persen_brix_ari']) * 100;
			$nilai_nira = $_POST['persen_pol_ari'] - ( 0.4 * ($_POST['persen_brix_ari'] - $_POST['persen_pol_ari']));
			$faktor_rendemen = 0.68;
			$rendemen_ari = $nilai_nira * $faktor_rendemen;
			
			$data['hk'] = $hk;
			$data['nilai_nira'] = $nilai_nira;
			$data['faktor_rendemen'] = $faktor_rendemen;
			$data['rendemen_ari'] = $rendemen_ari;
			
			
			$ID = $this->model->insertRow($data , $this->input->get_post( 'id_ari' , true ));
			// Input logs
			if( $this->input->get( 'id_ari' , true ) =='')
			{
				$this->inputLogs("New Entry row with ID : $ID  , Has Been Save Successfull");
			} else {
				$this->inputLogs(" ID : $ID  , Has Been Changed Successfull");
			}
			// Redirect after save	
			$this->session->set_flashdata('message',SiteHelpers::alert('success'," Data has been saved succesfuly !"));
			
			redirect( 'tanalisarendemen',301);
						
			
			
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
	
	function cekspta(){
		$arr['stt'] = 0;
		if(isset($_POST['nospta'])){
			
			
			if(CNF_METODE == 2){
			/**core sampler
				- cek status selektor diterima jika status = 1 (0 belum selektor,2 ditolak selektor)
				- cek ari sudah pernah diinput belum
			**/
			$cek = $this->db->query("SELECT id,kode_blok,kode_kat_lahan,kode_affd,
IF(selektor_status = 2,CONCAT('SPTA Ditolak SELEKTOR pada tanggal ',DATE_FORMAT(selektor_tgl,'%D %M %Y %H:%i')),IF(selektor_status=1,1,'SPTA belum di SELEKTOR ')) AS point_cek,
IF(ari_status = 1,CONCAT('SPTA Sudah di ANALISA tanggal ',DATE_FORMAT(ari_tgl,'%D %M %Y %H:%i')),IF(ari_status=2,CONCAT('SPTA ditolak di ANALISA ARI tanggal ',DATE_FORMAT(ari_tgl,'%D %M %Y %H:%i')),0)) AS stt FROM t_spta WHERE no_spat = '".$_POST['nospta']."'")->row();

			}else if(CNF_METODE == 1){
			/** ari
				- cek meja tebu sudah masuk belum
				- cek ari sudah pernah diinput belum
			**/
				$cek = $this->db->query("SELECT t_spta.id,t_meja_tebu.kondisi_tebu,kode_blok,kode_kat_lahan,kode_affd,
IF(meja_tebu_status = 1,1,'SPTA Belum Masuk MASUK MEJA !!') AS point_cek,
IF(ari_status = 1,CONCAT('SPTA Sudah di ANALISA tanggal ',DATE_FORMAT(ari_tgl,'%D %M %Y %H:%i')),IF(ari_status=2,CONCAT('SPTA ditolak di ANALISA ARI tanggal ',DATE_FORMAT(ari_tgl,'%D %M %Y %H:%i')),0)) AS stt 
FROM t_spta INNER JOIN t_meja_tebu ON t_spta.id=t_meja_tebu.id_spta WHERE no_spat = '".$_POST['nospta']."'")->row();
			
			
			}
			
			
		$arr['stt'] = 1;
		if($cek){
			$arr['stt'] = 1;
			$arr['data'] = $cek;
		}else{
			$arr['stt'] = 0;
		}
		
		}
		echo json_encode($arr);
	}


}
