<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Dashmonitor extends SB_Controller {

    protected $layout 	= "layouts/main";
	public $module 		= 'penjualan';
	public $per_page	= '10';

	function __construct() {
		parent::__construct();
		
		
		if(!$this->session->userdata('logged_in')) redirect('user/login',301);
		
	}

	public function index()
	{

		echo $this->data['content'] = $this->load->view('dashmonitor',$this->data,true);
		//$this->load->view('layouts/main',$this->data);
	}
	
	
	
	
	
}
