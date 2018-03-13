<?php

class Hakakses extends SB_Controller  {

	protected $layout = "layouts/main";
	 public $module = 'module';
	
	public function __construct() {
		
		parent::__construct();
		$this->load->model('sximo/modulemodel');
		$this->model = $this->modulemodel;			
		$this->data = array(
			'pageTitle'	=> 'Module Management',
			'pageNote'	=> 'Manage Setting COnfiguration'
		); 	
		if(!$this->session->userdata('logged_in')) redirect('user/login',301);
		if($this->session->userdata('gid') !=1) redirect('dashboard',301);
			
	}
	
   public function index()
    {

		if($this->input->get('t') == 'core')
		{
			
			$this->db->where('module_type','core');
			$this->db->order_by('module_title','asc');
			$rowData =  $this->db->get('tb_module')->result();  
			$type = 'core';        
		} else {
			$this->db->where('module_type','addon');
			$this->db->order_by('module_name','asc');
			$rowData =  $this->db->get('tb_module')->result();  
			$type = 'addon';
		}        

		$this->data['type']    = $type;    
		$this->data['rowData']    = $rowData;
		$this->data['content'] = $this->load->view('hakakses/index',$this->data, true );		
    	$this->load->view('layouts/main', $this->data );			
		

    }    
		
    	
		
    function permission( $id )
    {
//		echo $id;die();

		$row = $this->db->get_where('tb_module',array('module_name'=>$id))->row();
		if(count($row) <= 0) redirect('sximo/module',301);
                                   
		$this->data['row'] = $row;            
		$this->data['module'] = $this->module;
		$this->data['module_name'] = $row->module_name;
		$config = SiteHelpers::CF_decode_json($row->module_config);                         
	
		$tasks = array(
			'is_global'        => 'Global ',
			'is_view'        => 'View ',
			'is_detail'        => 'Detail',
			'is_add'        => 'Add ',
			'is_edit'        => 'Edit ',
			'is_remove'        => 'Remove ',
			'is_excel'        => 'Excel ',            
		);    
		/* Update permission global / own access new ver 1.1
		   Adding new param is_global
		   End Update permission global / own access new ver 1.1
		*/   
		if(isset($config['tasks'])) {
			foreach($config['tasks'] as $row)
			{
				$tasks[$row['item']] = $row['title'];
			}
		}
		$this->data['tasks'] = $tasks;        
		$this->data['groups'] = $this->db->get('tb_groups')->result();

		$access = array();
		foreach($this->data['groups'] as $r)        
		{
		//    $GA = $this->model->gAccessss($this->uri->rsegment(3),$row['group_id']);
			$group = ($r->group_id !=null ? "and group_id ='".$r->group_id."'" : "" );
			$GA = $this->db->query("SELECT * FROM tb_groups_access where module_id ='".$row->module_id."' $group")->row();
			if(count($GA) >=1){
				$GA = $GA;
			}
			
			$access_data = (isset($GA->access_data) ? json_decode($GA->access_data,true) : array());
			
			$rows = array();
			//$access_data = json_decode($AD,true);
			$rows['group_id'] = $r->group_id;
			$rows['group_name'] = $r->name;
			foreach($tasks as $item=>$val)
			{
				$rows[$item] = (isset($access_data[$item]) && $access_data[$item] ==1  ? 1 : 0);
			}
			$access[$r->name] = $rows;
			
			
		
		}
		//echo '<pre>';print_r($access);echo '</pre>';exit;
		$this->data['access'] = $access;                    
		$this->data['groups_access'] =$this->db->query("select * from tb_groups_access where module_id ='".$row->module_id."'")->result();
		
		$this->data['content'] = $this->load->view('hakakses/permision',$this->data, true );		
    	$this->load->view('layouts/main', $this->data );  
                               
                            
    }		


    function savePermission()
    {
	
		$id = $this->input->post('module_id');
		$row = $this->db->get_where('tb_module',array('module_id'=>$id))->row();
		if(count($row) <= 0) redirect('sximo/module',301);	
                                  
        $this->data['row'] = $row;    
        $config = SiteHelpers::CF_decode_json($row->module_config); 
        $tasks = array(
            'is_global'        => 'Global ',
            'is_view'        => 'View ',
            'is_detail'        => 'Detail',
            'is_add'        => 'Add ',
            'is_edit'        => 'Edit ',
            'is_remove'        => 'Remove ',
            'is_excel'        => 'Excel ',            
        );    
        /* Update permission global / own access new ver 1.1
           Adding new param is_global
           End Update permission global / own access new ver 1.1
        */         
        if(isset($config['tasks'])) {
            foreach($config['tasks'] as $row)
            {
                $tasks[$row['item']] = $row['title'];
            }
        }    
        
        $permission = array();

		$this->db->where('module_id',$id);
		$this->db->delete('tb_groups_access');		
		
        $groupID = $_POST['group_id'];
        for($i=0;$i<count($groupID); $i++)  
        {
            // remove current group_access             
            $group_id = $groupID[$i];
            $arr = array();
            $id = $groupID[$i];
            foreach($tasks as $t=>$v)            
            {
                $arr[$t] = (isset($_POST[$t][$id]) ? "1" : "0" );
            
            }
            $permissions = json_encode($arr); 
            
            $data = array
            (
                "access_data"    => $permissions,
                "module_id"       => $this->input->post('module_id'),                
                "group_id"        => $groupID[$i],
            );
            $this->db->insert('tb_groups_access',$data);    
        }
		
        $this->session->set_flashdata('message',SiteHelpers::alert('success','Permission Has Changed Successful.'));        
	    redirect('hakakses/permission/'.$row->module_name,301);
    }


    public function updates(){

    	$this->data['content'] = $this->load->view('hakakses/updates',null, true );		
    	$this->load->view('layouts/main', $this->data ); 
    } 


    public function databaseupdate(){

    	$directory = 'update-db/';
		$scanned_directory = array_diff(scandir($directory), array('..', '.'));

		$this->data['direktori'] = $scanned_directory;
    	$this->data['content'] = $this->load->view('hakakses/databaseupdate',$this->data, true );		
    	$this->load->view('layouts/main', $this->data ); 
    }
	
	
   
    	
	
}