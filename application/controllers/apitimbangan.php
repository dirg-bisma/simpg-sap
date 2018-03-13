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
        $this->load->model('apitimbanganmodel');
        $no_spat = 'KP11-13032018-0010';
        $status_nett = $this->apitimbanganmodel->cekStatusSpat($no_spat, array('timb_netto_status' => 1));
        var_dump($status_nett);
    }

    function login()
    {
        $user = $this->input->post('username');
        $pass = md5($this->input->post('password'));

        $result = $this->db->get_where('tb_users', array('username'=>$user, 'password' => $pass, 'group_id' => 8));


        if($result->num_rows() == 1){
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
            $no_spat = $this->input->post('no_spat');
            $this->load->model('apitimbanganmodel');

            $id_spat = $this->apitimbanganmodel->VByNoSpat($no_spat);
            $status_nett = $this->apitimbanganmodel->cekStatusSpat($no_spat, 'timb_netto_status', 1);

            if($status_nett == 0){
                $data = array(
                    'id_spat' => $id_spat[0]->id,
                    'bruto' => "0",
                    'tara' => "0",
                    'netto' => $this->input->post('netto'),
                    'netto_final' => $this->input->post('netto'),
                    'tgl_netto' => date('Y-m-d H:i:s'),
                    'tgl_tara' => date('Y-m-d H:i:s'),
                    'tgl_bruto' => date('Y-m-d H:i:s'),
                    'lokasi_timbang_1' => $this->input->post('kode_timbangan'),
                    'ptgs_timbang_1' => $this->input->post('ptgs_timbang'),
                );

                if($this->input->get('transloading_status') == 1) {
                    $data += array(
                        'transloading_status' => $this->input->post('transloading_status'),
                        'no_transloading' => $this->input->post('no_transloading'),
                        'ptgs_transloading' => $this->input->post('ptgs_timbang'),
                        'tgl_transloading' => date('Y-m-d H:i:s'),
                        'multi_sling' => $this->input->post('multi_sling'),
                    );
                }

                $this->db->set($data);
                $this->db->insert('t_timbangan');
                $result = array(
                    'msg' => $this->input->get('no_spat'),
                    'status' => 'true'
                );
                echo json_encode($result);
            }else{
                $result = array(
                    'msg' => "Sudah pernah melakukan penimbangan Netto",
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

    function simpanbrutojembatan()
    {
        try{
            $no_spat = $this->input->post('no_spat');
            $this->load->model('apitimbanganmodel');

            $id_spat = $this->apitimbanganmodel->VByNoSpat($no_spat);

            $cek_bruto =  $this->apitimbanganmodel->CekBrutoById($id_spat[0]->id);

            if($cek_bruto){
                $data = array(
                    'id_spat' => $id_spat[0]->id,
                    'bruto' => $this->input->post('bruto'),
                    'tgl_bruto' => date('Y-m-d H:i:s'),
                    'lokasi_timbang_1' => $this->input->post('kode_timbangan'),
                    'ptgs_timbang_1' => $this->input->post('ptgs_timbang'),
                );

                $this->db->set($data);
                $this->db->insert('t_timbangan');
                $result = array(
                    'msg' => $this->input->post('no_spat'),
                    'status' => 'true'
                );
                echo json_encode($result);
            }else{
                $result = array(
                    'msg' => 'sudah pernah timbang bruto',
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
            $no_spat = $this->input->post('no_spat');
            $this->load->model('apitimbanganmodel');
            $id_spat = $this->apitimbanganmodel->VByNoSpat($no_spat);
            $status_nett = $this->apitimbanganmodel->cekStatusSpat($no_spat, 'timb_netto_status', 1);

            if($status_nett == 0){
                $data_netto = array(
                    'tara' => $this->input->post('tara'),
                    'netto' => $this->input->post('netto'),
                    'netto_final' => $this->input->post('netto'),
                    'tgl_netto' => date('Y-m-d H:i:s'),
                    'tgl_tara' => date('Y-m-d H:i:s'),
                    'lokasi_timbang_2' => $this->input->post('kode_timbangan'),
                    'ptgs_timbang_2' => $this->input->post('ptgs_timbang'),
                );

                if($this->input->get('transloading_status') == 1) {
                    $data_netto += array(
                        'transloading_status' => $this->input->post('transloading_status'),
                        'no_transloading' => $this->input->post('no_transloading'),
                        'ptgs_transloading' => $this->input->post('ptgs_timbang'),
                        'tgl_transloading' => date('Y-m-d H:i:s'),
                    );
                }

                $where = array('id_spat' => $id_spat[0]->id);
                $this->apitimbanganmodel->UpdateNetto($where, $data_netto);

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
            $this->db->where('no_spat', $this->input->post('no_spat'));
            $this->db->from('t_spta');
            $id_spat = $this->db->row();

            $no_spat = $this->input->post('no_spat');

            $this->load->model('apitimbanganmodel');
            $status_nett = $this->apitimbanganmodel->cekStatusSpat($no_spat, 'timb_netto_status', 1);

            if($status_nett == 0){

                $data = array(
                    'id_spat' => $id_spat->id,
                    'bruto' => $this->input->post('bruto'),
                    'tara' => $this->input->post('tara'),
                    'netto' => $this->input->post('netto'),
                    'netto_final' => $this->input->post('netto'),
                    'tgl_netto' => date('Y-m-d H:i:s'),
                    'tgl_tara' => date('Y-m-d H:i:s'),
                    'tgl_bruto' => date('Y-m-d H:i:s'),
                    'lokasi_timbang_1' => $this->input->post('kode_timbangan'),
                    'lokasi_timbang_2' => $this->input->post('kode_timbangan'),
                    'ptgs_timbang_1' => $this->input->post('ptgs_timbang'),
                    'ptgs_timbang_2' => $this->input->post('ptgs_timbang'),
                    'no_lori' => $this->input->post('no_lori'),
                    'train_stat' => $this->input->post('train_stat'),
                    'no_loko' => $this->input->post('no_loko')
                );

                $this->db->set($data);
                $this->db->insert('t_timbangan');
                $result = array(
                    'msg' => $this->input->post('no_spat'),
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

    function noloko()
    {
        $this->load->model('apitimbanganmodel');
        $result = $this->apitimbanganmodel->NoLoko();
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