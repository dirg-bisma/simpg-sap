<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Ws extends SB_Controller
{
	function __construct() {
        parent::__construct();
        
    }

    function masterfield(){
    	$a = $this->db->query("SELECT count(*) FROM sap_field")->result();
    	echo json_encode($a,true);
    }
}
