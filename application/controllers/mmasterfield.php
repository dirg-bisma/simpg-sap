<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Mmasterfield extends SB_Controller 
{

	protected $layout 	= "layouts/main";
	public $module 		= 'mmasterfield';
	public $per_page	= '10';
	public $idx			= '';

	function __construct() {
		parent::__construct();
		
		$this->load->model('mmasterfieldmodel');
		$this->model = $this->mmasterfieldmodel;
		$idx = $this->model->primaryKey;
		
		$this->info = $this->model->makeInfo( $this->module);
		$this->access = $this->model->validAccess($this->info['id']);	
		$this->data = array_merge( $this->data, array(
			'pageTitle'	=> 	$this->info['title'],
			'pageNote'	=>  $this->info['note'],
			'pageModule'	=> 'mmasterfield',
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
            		$conn = (isset($this->con[$i+1]) ? $this->con[$i+1] : array() ) ;
					$row[] = SiteHelpers::gridDisplay($dt->$field , $field , $conn );
            }
 
            //add html for action
            $btn ='';
			$idku = $this->model->primaryKey;
            if($this->access['is_detail'] ==1){
            	$btn .= '<a href='.site_url('mmasterfield/show/'.$dt->$idku).'  class="tips "  title="view"><i class="fa  fa-search"></i>  </a> &nbsp;&nbsp;';
            }
            if($this->access['is_edit'] ==1){
            	$btn .= '<a href='.site_url('mmasterfield/add/'.$dt->$idku).'  class="tips "  title="Edit"><i class="fa  fa-edit"></i>  </a> &nbsp;&nbsp;';
            }
            if($this->access['is_remove'] ==1){
            	$btn .= '<a href="#" onclick="ConfirmDelete(\''.site_url('mmasterfield/destroy/').'\','.$dt->$idku.')"  class="tips "  title="Delete"><i class="fa  fa-trash"></i>  </a>';
            	
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
		
		$this->data['content'] = $this->load->view('mmasterfield/index',$this->data, true );
		
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
			$this->data['row'] = $this->model->getColumnTable('sap_field'); 
		}
		
		$this->data['id'] = $id;
		$this->data['content'] =  $this->load->view('mmasterfield/view', $this->data ,true);	  
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
			$this->data['row'] = $this->model->getColumnTable('sap_field'); 
		}
	
		$this->data['id'] = $id;
		$this->data['content'] = $this->load->view('mmasterfield/form',$this->data, true );		
	  	$this->load->view('layouts/main', $this->data );
	
	}
	
	function save() {
		
		$rules = $this->validateForm();

		$this->form_validation->set_rules( $rules );
		if( $this->form_validation->run() )
		{
			$data = $this->validatePost();
			$ID = $this->model->insertRow($data , $this->input->get_post( 'id_field' , true ));
			// Input logs
			if( $this->input->get( 'id_field' , true ) =='')
			{
				$this->inputLogs("New Entry row with ID : $ID  , Has Been Save Successfull");
			} else {
				$this->inputLogs(" ID : $ID  , Has Been Changed Successfull");
			}
			// Redirect after save	
			$this->session->set_flashdata('message',SiteHelpers::alert('success'," Data has been saved succesfuly !"));
			if($this->input->post('apply'))
			{
				redirect( 'mmasterfield/add/'.$ID,301);
			} else {
				redirect( 'mmasterfield',301);
			}			
			
			
		} else {
			$data =	array(
					'message'	=> 'Ops , The following errors occurred',
					'errors'	=> validation_errors('<li>', '</li>')
					);			
			$this->displayError($data);
		}
	}
	
	function upload(){
		include APPPATH."/third_party/PHPExcel/IOFactory.php";
		try {
		$objPHPExcel = PHPExcel_IOFactory::load($_FILES['master_field']['tmp_name']);
		} catch(ErrorException $e) {
			die('Error loading file "'.pathinfo($inputFileName,PATHINFO_BASENAME).'": '.$e->getMessage());
			exit();
		}

	$allDataInSheet = $objPHPExcel->getActiveSheet()->toArray(null,true,true,true);
		$arrayCount = count($allDataInSheet);  // Here get total count of row in that Excel sheet
		$totupload  = 0;
		$totdecline = 0;
		for($i=2;$i<=$arrayCount;$i++){
			 
			
			if(trim($allDataInSheet[$i]["C"]) == CNF_COMPANYCODE && trim($allDataInSheet[$i]["D"]) == CNF_PLANCODE){
				$tempdata = array(
					'kode_komoditas' => trim($allDataInSheet[$i]["B"]), 
					'company_code' 	=> trim($allDataInSheet[$i]["C"]), 
					'kode_plant' 	=> trim($allDataInSheet[$i]["D"]), 
					'divisi' 		=> trim($allDataInSheet[$i]["E"]), 
					'kode_blok' 		=> trim($allDataInSheet[$i]["F"]), 
					'valid_from' 	=> trim($allDataInSheet[$i]["G"]), 
					'valid_to' 		=> trim($allDataInSheet[$i]["H"]), 
					'tanggal_mulai' 	=> trim($allDataInSheet[$i]["I"]), 
					'sampai' 		=> trim($allDataInSheet[$i]["J"]), 
					'project_definition' => trim($allDataInSheet[$i]["K"]), 
					'land_clearing' 	=> trim($allDataInSheet[$i]["L"]), 
					'immature' 		=> trim($allDataInSheet[$i]["M"]), 
					'mature' 		=> trim($allDataInSheet[$i]["N"]), 
					'others' 		=> trim($allDataInSheet[$i]["O"]), 
					'deskripsi_blok' => trim($allDataInSheet[$i]["P"]), 
					'luas_tanam' 	=> trim($allDataInSheet[$i]["Q"]), 
					'tahun_tanam' 	=> trim($allDataInSheet[$i]["R"]), 
					'periode' 		=> trim($allDataInSheet[$i]["S"]), 
					'status_blok' 	=> trim($allDataInSheet[$i]["T"]), 
					'kepemilikan' 	=> trim($allDataInSheet[$i]["U"]), 
					'id_petani_sap' 	=> trim($allDataInSheet[$i]["W"]), 
					'jenis_tanah' 	=> trim($allDataInSheet[$i]["X"]), 
					'total_pokok' 	=> trim($allDataInSheet[$i]["Y"]), 
					'luas_ha' 		=> trim($allDataInSheet[$i]["Z"]), 
					'kondisi_areal' 	=> trim($allDataInSheet[$i]["AA"]), 
					'kode_varietas' 	=> trim($allDataInSheet[$i]["AB"]), 
					'gis_id' 		=> trim($allDataInSheet[$i]["AC"]), 
					'total_pokok_produktif' 	=> trim($allDataInSheet[$i]["AD"]), 
					'jarak_blok_ke_pabrik' 	=> trim($allDataInSheet[$i]["AW"]), 
					'jml_batang_juring' 		=> trim($allDataInSheet[$i]["AY"]), 
					'jml_juring_ha' 			=> trim($allDataInSheet[$i]["AX"]), 
					'taksasi_pandang' 		=> trim($allDataInSheet[$i]["AV"]), 
					'berat_per_m' 			=> trim($allDataInSheet[$i]["AU"]), 
					'rata_tgi_batang' 		=> trim($allDataInSheet[$i]["AT"])
				);
				//var_dump($tempdata);
				$ID = $this->model->insertRowUpdate($tempdata , trim($allDataInSheet[$i]["F"]));
				$totupload++;
			}else{
				$totdecline++;
			}
		}
			$this->inputLogs(" Upload data master field oleh ".$this->session->userdata('fid').' dengan data '.$totupload.' Berhasil dan '.$totdecline.' Gagal keupload');
			
			$this->session->set_flashdata('message',SiteHelpers::alert('success'," Upload data master field oleh ".$this->session->userdata('fid').' dengan data '.$totupload.' Berhasil dan '.$totdecline.' Gagal keupload karena beda plan'));
			
			redirect( 'mmasterfield',301);
			
		
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


}
