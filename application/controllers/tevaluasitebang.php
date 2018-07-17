<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Tevaluasitebang extends SB_Controller 
{

	protected $layout 	= "layouts/main";
	public $module 		= 'tevaluasitebang';
	public $per_page	= '10';
	public $idx			= '';

	function __construct() {
		parent::__construct();
		
		$this->load->model('tevaluasitebangmodel');
		$this->model = $this->tevaluasitebangmodel;
		$idx = $this->model->primaryKey;
		
		$this->info = $this->model->makeInfo( $this->module);
		$this->access = $this->model->validAccess($this->info['id']);	
		$this->data = array_merge( $this->data, array(
			'pageTitle'	=> 	$this->info['title'],
			'pageNote'	=>  $this->info['note'],
			'pageModule'	=> 'tevaluasitebang',
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
	
	
	function gridsLain(){
		$sort = 'id'; 
		$order = 'asc';
		$filter = "";
		//$filter = (!is_null($this->input->get('search', true)) ? $this->buildSearch() : '');
		//order 
		$this->colx[0] = 'spta';
		$this->colx[1] = 'netto_final';
		$this->colx[2] = 'ha_tertebang';
		
		if(isset($_POST['order']))
        {
            if(($_POST['order']['0']['column'])==0){
        		$sort = $this->colx[($_POST['order']['0']['column'])+1];
            	$order = $_POST['order']['0']['dir'];
        	}else{
            	$sort = $this->colx[($_POST['order']['0']['column'])];
            	$order = $_POST['order']['0']['dir'];
        	}

        }

		if(isset($_POST['search']['value']) && $_POST['search']['value'] != ''){
			$filter .= " AND (kode_blok LIKE '%".$_POST['search']['value']."%' OR no_spat LIKE '%".$_POST['search']['value']."%')";
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
		$results = $this->model->getRowspdx( $params );
		$rows = $results['rows'];
		$total = $results['total'];
		$totalfil = $results['totalfil'];
		
		//run data to view
		$data = array();$no=0;
		foreach ($rows as $dt) {
            $row = array();
            $row[] = $dt->no_spat;
            $row[] = $dt->kode_blok;
            $row[] = $dt->nama_petani;
            $row[] = $dt->netto_final;
            $row[] = "<input type='text' class='number' style='width:50px' value='".$dt->ha_tertebang."' id='ha_".$dt->id."' />";
 
            //add html for action
            $btn ='';
			$idku = 'id';
			
            	$btn .= '<a href="javascript:updatehektar('.$dt->$idku.')"  class="tips "  title="view"><i class="fa  fa-send"></i></a> &nbsp;';
            
           
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

	function grids($afd){
		
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
            	$sort = $this->col[($_POST['order']['0']['column'])+1];
            	$order = $_POST['order']['0']['dir'];
        	}

        }

        $filterx = " AND divisi = '$afd'";

        for ($i=0; $i < count($this->col) ; $i++) { 
        	
            if(isset($_POST['search']['value']) && $_POST['search']['value'] != ''){
            	if($i==0){
            		$filter .= " AND (".$this->col[$i+1]." LIKE '%".$_POST['search']['value']."%'";
            	}else{
            		$filter .= " OR ".$this->col[$i+1]." LIKE '%".$_POST['search']['value']."%'";
            	}
            }
        }

        if($filter != '')  $filter .= ')';
        $filter .= $filterx;

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
            for ($i=0; $i < count($this->col) ; $i++) { 
			
            		$field = $this->col[$i+1];
            		$conn = (isset($this->con[$i+1]) ? $this->con[$i+1] : array() ) ;
					$row[] = SiteHelpers::gridDisplay($dt->$field , $field , $conn );
					
            }
 
            //add html for action
            $btn ='';
			$idku = $this->model->primaryKey;
            if($dt->aff_tebang == 0){
            	$btn .= '<a href="javascript:setaff(\''.$dt->$idku.'\')" class="tips "  title="Set Aff Tebang"><i class="fa  fa-arrow-right"></i> Set Aff </a>';
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
		$this->data['rowdetail'] = $this->model->getafd();
		// Render into template
		
		$this->data['content'] = $this->load->view('tevaluasitebang/index',$this->data, true );
		
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
		$this->data['content'] =  $this->load->view('tevaluasitebang/view', $this->data ,true);	  
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
		$this->data['content'] = $this->load->view('tevaluasitebang/form',$this->data, true );		
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
				redirect( 'tevaluasitebang/add/'.$ID,301);
			} else {
				redirect( 'tevaluasitebang',301);
			}			
			
			
		} else {
			$data =	array(
					'message'	=> 'Ops , The following errors occurred',
					'errors'	=> validation_errors('<li>', '</li>')
					);			
			$this->displayError($data);
		}
	}

	function updatehektar()
	{
		$user = $this->session->userdata('fid');
		$tgl = date('Y-m-d H:i:s');
		$ha = $_POST['ha'];
		$id = $_POST['id'];

		$r = $this->db->query("SELECT b.kode_blok,luas_tebang,luas_ha,aff_tebang FROM t_spta a INNER JOIN sap_field b on a.kode_blok=b.kode_blok where a.id=$id")->row_array();
		$kodepetak = $r['kode_blok'];
		$luas_tebang = $r['luas_tebang'];
		$luas_ha = $r['luas_ha'];
		$aff = $r['aff_tebang'];

		if($aff == 0){
		if($luas_ha > ($luas_tebang+$ha)){
			$sql = "UPDATE t_selektor set ha_tertebang='$ha',tanaman_status=1,tanaman_user='$user',tanaman_act=now() WHERE id_spta = $id";
		$this->db->query($sql);
		echo "1.Hektar Berhasil diupdate..";
				$this->inputLogs("3.Hektar Sudah Update pada Petak ".$kodepetak." dengan tambahan ".$ha." Ha");
		}else{
			$sisa = $luas_ha-($luas_tebang+$ha);
			$sisap = ($sisa / $luas_ha)*100;

			$sisax = $luas_ha-($luas_tebang); 
			$sisapx = ($sisax / $luas_ha)*100; 

			if($sisap < 0 && $sisapx > 0){

			//	$up = $this->db->query("UPDATE sap_field set aff_tebang=1 where kode_blok = '$kodepetak'");
				echo "2.Hektar Error, Sisa Luas adalah ".number_format($luas_ha-$luas_tebang,3,',','.')." Ha ";

			}else if($sisap < 0 && $sisapx < 0){

				$up = $this->db->query("UPDATE sap_field set aff_tebang=1 where kode_blok = '$kodepetak'");
				echo "2.Hektar Error, Sisa Luas adalah ".number_format($luas_ha-$luas_tebang,3,',','.')." Ha ";
				$this->inputLogs("2.Aff otomatis karena petak ".$kodepetak." minus sisa hektarnya.");

			}else{
				$sql = "UPDATE t_selektor set ha_tertebang='$ha',tanaman_status=1,tanaman_user='$user',tanaman_act=now() WHERE id_spta = $id";
				
				$this->db->query($sql);
				$up = $this->db->query("UPDATE sap_field set aff_tebang=1 where kode_blok = '$kodepetak'");
				echo "3.Hektar Sudah Update dan Petak ".$kodepetak." Otomatis Aff Tebang.";
				$this->inputLogs("3.Hektar Sudah Update dan Petak ".$kodepetak." Otomatis Aff Tebang.");
			}
		}
	}else{
		$sql = "UPDATE t_selektor set ha_tertebang='0',tanaman_status=1,tanaman_user='$user',tanaman_act=now() WHERE id_spta = $id";
		$this->db->query($sql);
		echo "3.Master field sudah Aff, dan hektar berhasil di update";
				$this->inputLogs("3.Hektar Sudah Update pada Petak ".$kodepetak." dengan tambahan ".$ha." Ha");

	}

		$this->setupdateha($kodepetak);
		
	}

	function updatesetaff()
	{
		$id = $_POST['kodepetak'];
		$sql = "UPDATE sap_field set aff_tebang=1 where kode_blok = '$id'";
		$this->db->query($sql);
		$this->inputLogs(" ID : $id  , Set Aff Successfull");
		
	}

	function setupdateha($kodepetak){

		$sqld = $this->db->query("SELECT SUM(b.`ha_tertebang`) as hatebang FROM t_spta a INNER JOIN t_selektor b ON a.`id`=b.`id_spta` WHERE a.`kode_blok` = '$kodepetak' and b.tanaman_status=1")->row();

		$ha = $sqld->hatebang;
		$up = $this->db->query("UPDATE sap_field set luas_tebang='$ha' where kode_blok = '$kodepetak'");

	}


	function updatehaall(){
		$s = $this->db->query("SELECT kode_blok FROM sap_field WHERE luas_tebang != 0")->result();
		foreach ($s as $k) {

			$this->setupdateha($k->kode_blok);
			echo $k->kode_blok.'<br />';
		}
	}


}
