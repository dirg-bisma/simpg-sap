<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Tcancelselektor extends SB_Controller 
{

	protected $layout 	= "layouts/main";
	public $module 		= 'tcancelselektor';
	public $per_page	= '10';
	public $idx			= '';

	function __construct() {
		parent::__construct();
		
		$this->load->model('tcancelselektormodel');
		$this->model = $this->tcancelselektormodel;
		$idx = $this->model->primaryKey;
		
		$this->info = $this->model->makeInfo( $this->module);
		$this->access = $this->model->validAccess($this->info['id']);	
		$this->data = array_merge( $this->data, array(
			'pageTitle'	=> 	$this->info['title'],
			'pageNote'	=>  $this->info['note'],
			'pageModule'	=> 'tcancelselektor',
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
		$ar = array('1'=>'Diajukan','2'=>'Disetujui');
		foreach ($rows as $dt) {
            $row = array();
            $row[] = $no+1;
            for ($i=0; $i < count($this->col) ; $i++) { 
            		$field = $this->col[$i+1];
            		if($field =='status'){
            			$row[] = $ar[$dt->$field];
            		}else{
            		$conn = (isset($this->con[$i+1]) ? $this->con[$i+1] : array() ) ;
					$row[] = SiteHelpers::gridDisplay($dt->$field , $field , $conn );
					}
            }
 
            //add html for action
            $btn ='';
			$idku = $this->model->primaryKey;
            if($this->access['is_detail'] ==1){
            	$btn .= '<a href='.site_url('tcancelselektor/show/'.$dt->$idku).'  class="tips "  title="view"><i class="fa  fa-search"></i>  </a> &nbsp;&nbsp;';
            }
            if($this->access['is_edit'] ==1  && $dt->status == 1){
            	$btn .= '<a href='.site_url('tcancelselektor/add/'.$dt->$idku).'  class="tips "  title="Edit"><i class="fa  fa-edit"></i>  </a> &nbsp;&nbsp;';
            }
            if($this->access['is_remove'] ==1 && $dt->status == 1){
            	$btn .= '<a href="#" onclick="ConfirmDelete(\''.site_url('tcancelselektor/destroy/').'\','.$dt->$idku.')"  class="tips "  title="Delete"><i class="fa  fa-trash"></i>  </a>';
            	
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
		
		$this->data['content'] = $this->load->view('tcancelselektor/index',$this->data, true );
		
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
			$this->data['row'] = $this->model->getColumnTable('t_cancel_selektor'); 
		}
		
		$this->data['id'] = $id;
		$this->data['content'] =  $this->load->view('tcancelselektor/view', $this->data ,true);	  
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
			$this->data['row'] = $this->model->getColumnTable('t_cancel_selektor'); 
		}
	
		$this->data['id'] = $id;
		$this->data['content'] = $this->load->view('tcancelselektor/form',$this->data, true );		
	  	$this->load->view('layouts/main', $this->data );
	
	}
	
	function save() {
		
		$rules = $this->validateForm();

		$this->form_validation->set_rules( $rules );
		if( $this->form_validation->run() )
		{
			$data = $this->validatePost();
			$user = $this->session->userdata('fid');
			$tgl = date('Y-m-d H:i:s');
			if($_POST['status'] == '1'){
				$data['status'] = 1;
				$data['user_add'] = $user;
				$data['tgl_add'] = $tgl;
			}else{
				$data['status'] = 2;
				$data['user_appr'] = $user;
				$data['tgl_appr'] = $tgl;

				$this->db->query("UPDATE t_selektor SET ditolak_sel=1,ditolak_alasan='".$_POST['alasan']."' WHERE id_spta='".$_POST['id_spta']."' ");
			}


			$ID = $this->model->insertRow($data , $this->input->get_post( 'id' , true ));
			// Input logs
			if( $this->input->get( 'id' , true ) =='')
			{
				$this->inputLogs("Ajuan Cancel Selektor oleh $user SPTA no ".$_POST['no_spta']);
			} else {
				$this->inputLogs("Approval Cancel Selektor oleh $user SPTA no ".$_POST['no_spta']);
			}
			// Redirect after save	
			$this->session->set_flashdata('message',SiteHelpers::alert('success'," Data has been saved succesfuly !"));
			if($this->input->post('apply'))
			{
				redirect( 'tcancelselektor/add/'.$ID,301);
			} else {
				redirect( 'tcancelselektor',301);
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
		$this->inputLogs("ID : ".$_POST['id']."  , Ajuan Cancel Selektor Dibatalkan");
		echo "ID : ".$_POST['id']."  , berhasil dihapus !!";
		
	}

	function cekspta($ax){
		$arr['stt'] = 0;
		
		if(isset($_POST['nospta'])){
			if($ax == 1){
			$cek = $this->db->query("SELECT a.*,no_angkutan,selektor_tgl FROM t_spta a INNER JOIN t_selektor b on a.id=b.id_spta WHERE no_spat = '".$_POST['nospta']."' AND b.`ditolak_sel`=0 AND DATEDIFF(DATE(NOW()),DATE(a.selektor_tgl)) > 7 AND timb_bruto_status = 0 AND a.id NOT IN (SELECT id_spta FROM t_cancel_selektor)")->row();
		}else{
			$cek = $this->db->query("SELECT a.*,no_angkutan,selektor_tgl FROM t_spta a INNER JOIN t_selektor b on a.id=b.id_spta WHERE no_spat = '".$_POST['nospta']."'")->row();
		}
		$arr['stt'] = 1;
		if($cek){
			$arr['stt'] = 1;
			$htm = 'No Petak : <b>'.$cek->kode_blok.'</b><br /> Kategori : <b>'.$cek->kode_kat_lahan.'</b><br />
			SPTA : <b>'.$cek->jenis_spta.'</b><br />No Angkutan : <b>'.$cek->no_angkutan.'</b><br />Tgl Selektor : <b>'.$cek->selektor_tgl.'</b>';
			$arr['data'] = $cek;
			$arr['hasil'] = $htm;
		}else{
			$arr['stt'] = 0;
		}
		
		}
		echo json_encode($arr);
	}


}