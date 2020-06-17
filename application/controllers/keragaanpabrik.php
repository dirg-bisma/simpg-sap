<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Keragaanpabrik extends SB_Controller 
{

	protected $layout 	= "layouts/main";
	public $module 		= 'keragaanpabrik';
	public $per_page	= '10';
	public $idx			= '';

	function __construct() {
		parent::__construct();
		
		$this->load->model('keragaanpabrikmodel');
		$this->model = $this->keragaanpabrikmodel;
		$idx = $this->model->primaryKey;
		
		$this->info = $this->model->makeInfo( $this->module);
		$this->access = $this->model->validAccess($this->info['id']);	
		$this->data = array_merge( $this->data, array(
			'pageTitle'	=> 	$this->info['title'],
			'pageNote'	=>  $this->info['note'],
			'pageModule'	=> 'keragaanpabrik',
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
            	$btn .= '<a href='.site_url('keragaanpabrik/show/?hari='.$dt->hari_giling).'  class="tips "  title="view"><i class="fa  fa-search"></i>  </a> &nbsp;&nbsp;';
            }
            if($this->access['is_edit'] ==1){
            	$btn .= '<a href='.site_url('keragaanpabrik/add/?hari='.$dt->hari_giling).'  class="tips "  title="Edit"><i class="fa  fa-edit"></i>  </a> &nbsp;&nbsp;';
			}
			/*
            if($this->access['is_remove'] ==1){
            	$btn .= '<a href="#" onclick="ConfirmDelete(\''.site_url('keragaanpabrik/destroy/').'\','.$dt->$idku.')"  class="tips "  title="Delete"><i class="fa  fa-trash"></i>  </a>';
            	
            }*/
           
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
		
		$this->data['content'] = $this->load->view('keragaanpabrik/index',$this->data, true );
		
    	$this->load->view('layouts/main', $this->data );
    
	  
	}
	
	function show( $id = null) 
	{
		if($this->access['is_detail'] ==0)
		{ 
			$this->session->set_flashdata('error',SiteHelpers::alert('error','Your are not allowed to access the page'));
			redirect('dashboard',301);
	  	}		

		$hari = $_GET['hari'];  
		$row = $this->model->rekapData($hari);
		$sql_jam = "SELECT * FROM t_lap_jam";
		$jam = $this->db->query($sql_jam)->result();
		$this->data['row'] =  $row;
		$this->data['jam'] = $jam;
		$this->data['id'] = $id;
		$this->data['content'] =  $this->load->view('keragaanpabrik/view', $this->data ,true);	  
		$this->load->view('layouts/main',$this->data);
	}
  
	function add( $id = null ) 
	{
		if($id =='')
			if($this->access['is_add'] ==0) redirect('dashboard',301);

		if($id !='')
			if($this->access['is_edit'] ==0) redirect('dashboard',301);	
		if(isset($_GET['id'])){
			$id= $_GET['id'];
		}

		$sql_keragaan_jam = "SELECT * FROM t_keragaan_pabrik WHERE id='$id'";
		$row = $this->db->query($sql_keragaan_jam)->row();
		if($row)
		{
			$this->data['row'] =  $row;
		} else {
			$this->data['row'] = $this->model->getColumnTable('t_keragaan_pabrik'); 
		}
		$this->data['tableGrid'] 	= $this->info['config']['grid'];


		if(isset($_POST['hari_giling'])){
			$hari = $_POST['hari_giling'];
		}else{
			$hari = $_GET["hari"];
		}

		$sql_lap_jam = "SELECT * FROM t_lap_jam";
		$lap_jam = $this->db->query($sql_lap_jam)->result();
		
		$sql_data = "SELECT a.* FROM t_keragaan_pabrik as a
		inner join t_lap_jam as b on a.jam = b.jam
		WHERE hari_giling = '$hari' ORDER BY b.id";
		$data_keragaan = $this->db->query($sql_data)->result();

		$this->data['lap_jam'] = $lap_jam;
		$this->data['data_keragaan'] = $data_keragaan;
				
		$this->data['id'] = $id;
		$this->data['content'] = $this->load->view('keragaanpabrik/form',$this->data, true );		
	  	$this->load->view('layouts/main', $this->data );
	
	}
	
	function save($id = null) {
		
		$rules = $this->validateForm();

		$this->form_validation->set_rules( $rules );
		if( $this->form_validation->run() )
		{
			
			$data['hari_giling'] = $_POST['hari_giling'];
			$data['tgl_giling'] = $_POST['tgl_giling'];
			$data['jam'] = $_POST['jam'];
			$data['digiling'] = $_POST['digiling'];
			$data['brix_npp'] = $_POST['brix_npp'];
			$data['nm_persen_tebu'] = $_POST['nm_persen_tebu'];
			$data['uap_baru'] = $_POST['uap_baru'];
			$data['uap_bekas'] = $_POST['uap_bekas'];
			$data['suhu_pp_i'] = $_POST['suhu_pp_i'];
			$data['suhu_pp_ii'] = $_POST['suhu_pp_ii'];
			$data['suhu_pp_iii'] = $_POST['suhu_pp_iii'];
			$data['turbidity'] = $_POST['turbidity'];
			$data['v_eva'] = $_POST['v_eva'];
			$data['v_masakan'] = $_POST['v_masakan'];
			$data['be_nk'] = $_POST['be_nk'];
			//$id = $_GET['id'];
			$sqlCek = "SELECT * FROM t_keragaan_pabrik WHERE id='$id' ";
			$cekData = $this->db->query($sqlCek)->row();
			//var_dump($cekData);		
			
			if($cekData){
				$this->model->updateData($id,$data);				
			}else{
				$ID = $this->model->insertData($data);
			}
			
			
			// Input logs
			if( $this->input->get( 'id' , true ) =='')
			{
				$this->inputLogs("New Entry row with ID : $ID  , Has Been Save Successfull");
			} else {
				$this->inputLogs(" ID : $ID  , Has Been Changed Successfull");
			}
			// Redirect after save	
			$this->session->set_flashdata('message',SiteHelpers::alert('success'," Data has been saved succesfuly !"));
			if($this->input->post('apply'))
			{
				redirect( 'keragaanpabrik/add/?hari='.$_POST['hari_giling'].'?id='.$ID,301);
			} else {
				redirect( 'keragaanpabrik/add/?hari='.$_POST['hari_giling'],301);
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

	function getharitglgiling($hg)
	{
		if($hg != 0){
			$hg = $hg-1;
			$sql = "SELECT '".($hg+1)."' as hg,DATE_ADD(DATE(IFNULL(awal_giling,NOW())),INTERVAL ".$hg." DAY) AS tgl FROM tb_setting";
			$r = $this->db->query($sql)->row();
		echo json_encode($r);
		}
	}

	function gettergiling($tgl, $jam)
	{	
			$sql = "SELECT
			jm.jam AS jjm,
			ifnull(sum(giling.ttl),0) as ttl,
			ifnull(sum(giling.ton_brix),0) as ton_brix,
			ifnull(FORMAT(((sum(giling.ton_brix)/100)/sum(giling.ttl))*100,2),0) as npp_brix
		FROM
			t_lap_jam jm
			LEFT JOIN (
		SELECT
		  b.no_spat as spta,
			a.netto_final AS ttl,
			d.persen_brix_ari AS brix,
			d.persen_brix_ari*a.netto_final as ton_brix,
			CONVERT(DATE_FORMAT(b.meja_tebu_tgl, '%H') USING utf8 ) AS jam 
		FROM
			t_timbangan a
			INNER JOIN t_spta b ON a.id_spat = b.id
			INNER JOIN t_meja_tebu c ON c.id_spta = b.id
		  INNER JOIN t_ari d on d.id_spta = b.id	
		WHERE
			b.tgl_giling = '$tgl'  
			) AS giling ON giling.jam = jm.jam 
		WHERE
			jm.jam = '$jam'";
			$r = $this->db->query($sql)->row();
		echo json_encode($r);
		
	}


}
