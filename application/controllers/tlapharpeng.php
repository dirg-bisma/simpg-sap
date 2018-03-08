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
            'pageModule'	=> 'laporan',
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
            	$btn .= '<a href='.site_url('tlapharpeng/show/'.$dt->$idku).'  class="tips "  title="view"><i class="fa  fa-search"></i>  </a> &nbsp;&nbsp;';
            }
            if($this->access['is_edit'] ==1){
            	$btn .= '<a href='.site_url('tlapharpeng/add/'.$dt->$idku).'  class="tips "  title="Edit"><i class="fa  fa-edit"></i>  </a> &nbsp;&nbsp;';
            }
            if($this->access['is_remove'] ==1){
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
	
	function index() 
	{
		if($this->access['is_view'] ==0)
		{ 
			$this->session->set_flashdata('error',SiteHelpers::alert('error','Your are not allowed to access the page'));
			redirect('dashboard',301);
		}

		$this->load->model('Settinggilingmodel');
		$this->data['hari_giling'] = $this->Settinggilingmodel->getHariGilingKe();

        $this->data['content'] =  $this->load->view('tlapharpeng/index', $this->data ,true);
        $this->load->view('layouts/main', $this->data );
	}

	function formlaporan()
    {
        if($this->access['is_view'] == 0)
        {
            $this->session->set_flashdata('error',SiteHelpers::alert('error','Your are not allowed to access the page'));
            redirect('dashboard',301);
        }

        $this->db->where('tahun_giling', CNF_TAHUNGILING);
        $this->db->select('*');
        $this->data['data_kemarin'] = $this->db->get('vw_lap_har_pengolahan_sum')->row();


        $this->data['content'] =  $this->load->view('tlapharpeng/form-laporan', $this->data ,true);
        $this->load->view('layouts/main', $this->data );
    }

	function simpan()
    {

        $data = array(
            'jam_berhenti_a' => $this->input->post('jam_berhenti_a'),
            'jam_berhenti_b' => $this->input->post('jam_berhenti_b'),
            'jam_kampanye' => $this->input->post('jam_kampanye'),
            'kis' => $this->input->post('kis'),
            'kes' => $this->input->post('kes'),
            'prod_gula' => $this->input->post('prod_gula'),
            'ex_sisan_gula' => $this->input->post('ex_sisan_gula'),
            'sisan_diolah' => $this->input->post('sisan_diolah'),
            'prod_tetes' => $this->input->post('prod_tetes'),
            'ex_sisan_tetes' => $this->input->post('ex_sisan_tetes'),
            'sto_tetes' => $this->input->post('sto_tetes'),
            'ex_repro_tll' => $this->input->post('ex_repro_tll'),
            'bba' => $this->input->post('bba'),
            'rupiah_bba' => $this->input->post('rupiah_bba'),
            'gula_repro_tll' => $this->input->post('gula_repro_tll'),
            'raw_sugar' => $this->input->post('raw_sugar'),
            'gula_repro_th_ini' => $this->input->post('gula_repro_th_ini'),
            'ton_ampas' => $this->input->post('ton_ampas'),
            'persen_pol_ampas' => $this->input->post('persen_pol_ampas'),
            'ton_blotong' => $this->input->post('ton_blotong'),
            'persen_pol_blotong' => $this->input->post('persen_pol_blotong'),
            'ton_pol_dlm_hasil_plus_taksasi' => $this->input->post('ton_pol_dlm_hasil_plus_taksasi'),
            'persen_pol_dlm_hasil_plus_taksasi' => $this->input->post('persen_pol_dlm_hasil_plus_taksasi'),
        );

        $this->db->where('tahun_giling', CNF_TAHUNGILING);
        $this->db->where('hari_giling', $this->input->post('hari_giling'));
        $this->db->select('id_lap_harian_pengolahan');
        $data_lap = $this->db->get('t_lap_harian_pengolahan')->row();

        if(isset($data_lap->id_lap_harian_pengolahan)){
            $this->db->where('tahun_giling', CNF_TAHUNGILING);
            $this->db->where('hari_giling', $this->input->post('hari_giling'));
            $this->db->update('t_lap_harian_pengolahan', $data);
            $this->inputLogs(" ID : $data_lap->id_lap_harian_pengolahan  , Has Been Changed Successfull");
            $this->session->set_flashdata('message',SiteHelpers::alert('success'," Data has been saved succesfuly !"));
        }else{
            $data +=  array(
                'hari_giling' => $this->input->post('hari_giling'),
                'tahun_giling' => $this->input->post('tahun_giling'),
                'tgl' => $this->input->post('tgl'));
            //array_push($data, $data_push);
            $ID = $this->db->insert('t_lap_harian_pengolahan', $data);
            $this->inputLogs("New Entry row with ID : $ID  , Has Been Save Successfull");
            $this->session->set_flashdata('message',SiteHelpers::alert('success'," Data has been update succesfuly !"));
        }
        redirect( 'tlapharpeng',301);

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
			$this->data['row'] = $this->model->getColumnTable('t_lap_harian_pengolahan'); 
		}
		
		$this->data['id'] = $id;
		$this->data['content'] =  $this->load->view('tlapharpeng/view', $this->data ,true);	  
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
			$data = $this->validatePost();
			$ID = $this->model->insertRow($data , $this->input->get_post( 'id_lap_harian_pengolahan' , true ));
			// Input logs
			if( $this->input->get( 'id_lap_harian_pengolahan' , true ) =='')
			{
				$this->inputLogs("New Entry row with ID : $ID  , Has Been Save Successfull");
			} else {
				$this->inputLogs(" ID : $ID  , Has Been Changed Successfull");
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


}
