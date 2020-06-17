<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Apikeragaanpabrik extends SB_Controller
{
    function jsonperjam($tgl, $jam)
	{

        $this->load->model('keragaanpabrikmodel');
		$data = $this->keragaanpabrikmodel->rekapDataJam($tgl, $jam);
		echo json_encode($data);
	}
}