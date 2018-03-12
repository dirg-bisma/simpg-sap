<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Apitimbangan extends SB_Controller
{
    function __construct() {
        parent::__construct();
        $this->data = array_merge( $this->data, array(
            'pageTitle'	=> 	'Api Timbangan',
            'pageNote'	=>  'SIM PG',
            'pageModule'	=> 'apitimbangan',
        ));

        $this->load->model('usersmodel');
        $this->model = $this->usersmodel;
    }

    function index()
    {

    }

    function login()
    {
        $user = $this->input->get('username');
        $pass = md5($this->input->get('password'));
        $this->db->get_where('tb_users', array('username'=>$user, 'password' => $pass));
        $result = $this->db->count_all_results();

        if($result == 1){
            $msg = array('msg' => 'success', 'status' => 'true');
        }else{
            $msg = array('msg' => 'failure', 'status' => 'false');
        }
        echo json_encode($msg);

    }

    /**
     * @return array
     */
    function bynospat()
    {
        $no_spat = $this->input->get('no_spat');
        $this->load->model('apitimbanganmodel');
        $result = $this->apitimbanganmodel->VByNoSpat($no_spat);

        if(count($result) == 1){
            foreach ($result[0] as $key => $value) {
                if (is_null($value)) {
                    $result[0]->$key = "";
                }
            }
            $output = array(
                'result' => $result,
                'count' => count($result),
                'msg' => 'success',
                'status' => 'true'
            );
        }else{
            $output = array(
                'result' => [],
                'count' => count($result),
                'msg' => 'data not found',
                'status' => 'false'
            );
        }

        echo json_encode($output);
    }

    function bynolori()
    {
        $no_spat = $this->input->get('no_spat');
        $this->load->model('apitimbanganmodel');
        $result = $this->apitimbanganmodel->VByNoLori($no_spat);

        if(count($result) == 1){
            foreach ($result[0] as $key => $value) {
                if (is_null($value)) {
                    $result[0]->$key = "";
                }
            }
            $output = array(
                'result' => $result,
                'count' => count($result),
                'msg' => 'success',
                'status' => 'true'
            );
        }else{
            $output = array(
                'result' => [],
                'count' => count($result),
                'msg' => 'data not found',
                'status' => 'false'
            );
        }

        echo json_encode($output);
    }

    function simpandcs()
    {
        try{
            $this->db->select('id');
            $this->db->where('no_spat', $this->input->get('no_spat'));
            $this->db->from('t_spta');
            $id_spat = $this->db->row();

            $data = array(
                'id_spat' => $id_spat->id,
                'bruto' => "0",
                'tara' => "0",
                'netto' => $this->input->get('netto'),
                'netto_final' => $this->input->get('netto'),
                'tgl_netto' => date('Y-m-d H:i:s'),
                'tgl_tara' => date('Y-m-d H:i:s'),
                'tgl_bruto' => date('Y-m-d H:i:s'),
                'lokasi_timbang_1' => $this->input->get('kode_timbangan'),
                'ptgs_timbang_1' => $this->input->get('ptgs_timbang'),
            );

            if($this->input->get('transloading_status') == 1) {
                $data += array(
                    'transloading_status' => $this->input->get('transloading_status'),
                    'no_transloading' => $this->input->get('no_transloading'),
                    'ptgs_transloading' => $this->input->get('ptgs_timbang'),
                    'tgl_transloading' => date('Y-m-d H:i:s'),
                    'multi_sling' => $this->input->get('multi_sling'),
                );
            }

            $this->db->set($data);
            $this->db->insert('t_timbangan');
            $result = array(
                'msg' => $this->input->get('no_spat'),
                'status' => 'true'
            );
            echo json_encode($result);
        }catch (Exception $ex){
            $result = array(
                'msg' => $ex,
                'status' => 'false'
            );
            echo json_encode($result);
        }
    }

    function simpanbrutojembatan()
    {
        try{
            $no_spat = $this->input->get('no_spat');
            $this->load->model('apitimbanganmodel');

            $id_spat = $this->apitimbanganmodel->VByNoSpat($no_spat);

            $cek_bruto =  $this->apitimbanganmodel->CekBrutoById($id_spat->id);

            if(count($cek_bruto) == 0){
                $data = array(
                    'id_spat' => $id_spat->id,
                    'bruto' => $this->input->get('bruto'),
                    'tgl_bruto' => date('Y-m-d H:i:s'),
                    'lokasi_timbang_1' => $this->input->get('kode_timbangan'),
                    'ptgs_timbang_1' => $this->input->get('ptgs_timbang'),
                );

                $this->db->set($data);
                $this->db->insert('t_timbangan');
                $result = array(
                    'msg' => $this->input->get('no_spat'),
                    'status' => 'true'
                );
                echo json_encode($result);
            }else{
                $result = array(
                    'msg' => 'sudah pernah timbanga bruto',
                    'status' => 'false'
                );
                echo json_encode($result);
            }

        }catch (Exception $ex){
            $result = array(
                'msg' => $ex,
                'status' => 'false'
            );
            echo json_encode($result);
        }
    }

    function simpannettojembatan()
    {
        try{
            $this->db->select('id');
            $this->db->where('no_spat', $this->input->get('no_spat'));
            $this->db->from('t_spta');
            $id_spat = $this->db->row();

            $no_spat = $this->input->get('no_spat');
            $this->load->model('apitimbanganmodel');

            $status_nett = $this->apitimbanganmodel->cekStatusSpat($no_spat, array('timb_netto_status' => 1));

            if(count($status_nett) == 0){
                $data = array(
                    'id_spat' => $id_spat->id,
                    'tara' => $this->input->get('tara'),
                    'netto' => $this->input->get('netto'),
                    'netto_final' => $this->input->get('netto'),
                    'tgl_netto' => date('Y-m-d H:i:s'),
                    'tgl_tara' => date('Y-m-d H:i:s'),
                    'lokasi_timbang_2' => $this->input->get('kode_timbangan'),
                    'ptgs_timbang_2' => $this->input->get('ptgs_timbang'),
                );

                if($this->input->get('transloading_status') == 1) {
                    $data += array(
                        'transloading_status' => $this->input->get('transloading_status'),
                        'no_transloading' => $this->input->get('no_transloading'),
                        'ptgs_transloading' => $this->input->get('ptgs_timbang'),
                        'tgl_transloading' => date('Y-m-d H:i:s'),
                    );
                }

                $this->db->where('id_spat', $id_spat->id);
                $this->db->update('t_timbangan', $data);
                $result = array(
                    'msg' => $this->input->get('no_spat'),
                    'status' => 'true'
                );
                echo json_encode($result);
            }else{
                $result = array(
                    'msg' => 'Sudah melakukan penimbangan Netto',
                    'status' => 'false'
                );
                echo json_encode($result);
            }


        }catch (Exception $ex){
            $result = array(
                'msg' => $ex,
                'status' => 'false'
            );
            echo json_encode($result);
        }
    }

    function simpanlori()
    {
        try{
            $this->db->select('id');
            $this->db->where('no_spat', $this->input->get('no_spat'));
            $this->db->from('t_spta');
            $id_spat = $this->db->row();

            $no_spat = $this->input->get('no_spat');

            $this->load->model('apitimbanganmodel');
            $status_nett = $this->apitimbanganmodel->cekStatusSpat($no_spat, array('timb_netto_status' => 1));

            if(count($status_nett) == 0){

                $data = array(
                    'id_spat' => $id_spat->id,
                    'bruto' => $this->input->get('bruto'),
                    'tara' => $this->input->get('tara'),
                    'netto' => $this->input->get('netto'),
                    'netto_final' => $this->input->get('netto'),
                    'tgl_netto' => date('Y-m-d H:i:s'),
                    'tgl_tara' => date('Y-m-d H:i:s'),
                    'tgl_bruto' => date('Y-m-d H:i:s'),
                    'lokasi_timbang_1' => $this->input->get('kode_timbangan'),
                    'lokasi_timbang_2' => $this->input->get('kode_timbangan'),
                    'ptgs_timbang_1' => $this->input->get('ptgs_timbang'),
                    'ptgs_timbang_2' => $this->input->get('ptgs_timbang'),
                    'no_lori' => $this->input->get('no_lori'),
                    'train_stat' => $this->input->get('train_stat'),
                    'no_loko' => $this->input->get('no_loko')
                );

                $this->db->set($data);
                $this->db->insert('t_timbangan');
                $result = array(
                    'msg' => $this->input->get('no_spat'),
                    'status' => 'true'
                );
                echo json_encode($result);

            }else{

                $result = array(
                    'msg' => 'Sudah melakukan penimbangan',
                    'status' => 'false'
                );
                echo json_encode($result);
            }

        }catch (Exception $ex){
            $result = array(
                'msg' => $ex,
                'status' => 'false'
            );
            echo json_encode($result);
        }
    }

    function taralori($no_lori)
    {
        $this->load->model('apitimbanganmodel');
        $result = $this->apitimbanganmodel->TaraLori($no_lori);

        echo json_encode($result);
    }

    public function cetaklori($train_stat, $no_loko)
    {
        $this->load->model('apitimbanganmodel');
        $result = $this->apitimbanganmodel->VwTimbanganCetakLori($train_stat, $no_loko);

        if(count($result) > 0){
            foreach ($result[0] as $key => $value) {
                if (is_null($value)) {
                    $result[0]->$key = "";
                }
            }
            $output = array(
                'result' => $result,
                'count' => count($result),
                'msg' => 'success',
                'status' => 'true'
            );
        }else{
            $output = array(
                'result' => [],
                'count' => count($result),
                'msg' => 'data not found',
                'status' => 'false'
            );
        }

        echo json_encode($output);
    }
}