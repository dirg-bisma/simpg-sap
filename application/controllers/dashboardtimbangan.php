<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

/**
 * Created by PhpStorm.
 * User: dirg
 * Date: 3/13/2018
 * Time: 3:56 PM
 */
class Dashboardtimbangan extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
    }

    function index()
    {
        $this->load->view('dashboardtimbangan/index');
    }

    function data($jenis)
    {
        $this->load->model('dashboardtimbanganmodel');
        if($jenis == "LORI"){
            $result = $this->dashboardtimbanganmodel->AntrianLori();
        }else{
            $result = $this->dashboardtimbanganmodel->AntrianTruk();
        }

        $output = array('data' => [$result]);

        echo json_encode($output);
    }
}