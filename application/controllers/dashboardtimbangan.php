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

        if(count($result) > 0){
            $output = array('data' => $result);
        }else{
            $output = array('data' => array());
        }

        echo json_encode($output);
    }

    function indexlori()
    {
        $this->load->view('dashboardtimbangan/indexlori');
    }

    function formcetaklori()
    {
        $sql_loko = "SELECT * FROM m_no_loko";
        $query = $this->db->query($sql_loko);
        $data['loko'] = $query->result();
        $this->load->view('dashboardtimbangan/formcetaklori', $data);
    }

    function printlori()
    {
        $no_trainstat = $this->GetPost('no_trainstat');
        $no_loko = $this->GetPost('no_loko');
        $this->load->model('dashboardtimbanganmodel');
        $result = $this->dashboardtimbanganmodel->PrintDataCetakLori($no_trainstat, $no_loko);
        $data['lori'] = $result;
        $data['no_trainstat'] = $no_trainstat;
        $data['no_loko'] = $no_loko;
       // var_dump($data);
        $this->load->view('dashboardtimbangan/printlori', $data);
    }

    function datalori()
    {
        $no_trainstat = $this->GetPost('no_trainstat');
        $no_loko = $this->GetPost('no_loko');
        $tgl_timbang = $this->GetPost('tgl_timbang');
        $this->load->model('dashboardtimbanganmodel');
        $result = $this->dashboardtimbanganmodel->DataCetakLori($no_trainstat, $no_loko, $tgl_timbang);

        if(count($result) > 0){
            $output = array('data' => $result);
        }else{
            $output = array('data' => array());
        }

        echo json_encode($output);
    }


    private function GetPost($input){
        if($this->input->get($input)){
            $output = $this->input->get($input);
        }elseif($this->input->post($input)){
            $output = $this->input->post($input);
        }else{
            $output = "";
        }
        return $output;
    }
}