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
        $user = $this->GetPost('username');
        $pass = md5($this->GetPost('password'));

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

    function bynolori($no_lori)
    {
        $this->load->model('apitimbanganmodel');
        $result = $this->apitimbanganmodel->VByNoLori($no_lori);


        if(count($result) == 1){
            foreach ($result as $key => $value) {
                if (is_null($value)) {
                    $result->$key = "";
                }
            }
            $output = array(
                'result' => [$result],
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
            $no_spat = $this->GetPost('no_spat');
            $this->load->model('apitimbanganmodel');

            $id_spat = $this->apitimbanganmodel->VByNoSpat($no_spat);
            $status_nett = $this->apitimbanganmodel->cekStatusSpat($no_spat, 'timb_netto_status', 1);

            if($status_nett == 0){
                $data = array(
                    'id_spat' => $id_spat[0]->id,
                    'bruto' => "0",
                    'tara' => "0",
                    'netto' => $this->GetPost('netto'),
                    'netto_final' => $this->GetPost('netto'),
                    'tgl_netto' => date('Y-m-d H:i:s'),
                    'tgl_tara' => date('Y-m-d H:i:s'),
                    'tgl_bruto' => date('Y-m-d H:i:s'),
                    'lokasi_timbang_1' => $this->GetPost('kode_timbangan'),
                    'lokasi_timbang_2' => $this->GetPost('kode_timbangan'),
                    'ptgs_timbang_1' => $this->GetPost('ptgs_timbang'),
                    'ptgs_timbang_2' => $this->GetPost('ptgs_timbang'),
                );

                if($this->GetPost('no_transloading') != "") {
                    $data += array(
                        'transloading_status' => $this->GetPost('transloading_status'),
                        'no_transloading' => $this->GetPost('no_transloading'),
                        'ptgs_transloading' => $this->GetPost('ptgs_timbang'),
                        'tgl_transloading' => date('Y-m-d H:i:s'),
                        'multi_sling' => $this->GetPost('multi_sling'),
                    );
                }

                $this->db->set($data);
                $this->db->insert('t_timbangan');
                $result = array(
                    'msg' => $this->GetPost('no_spat'),
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
            $no_spat = $this->GetPost('no_spat');
            $this->load->model('apitimbanganmodel');

            $id_spat = $this->apitimbanganmodel->VByNoSpat($no_spat);

            $cek_bruto =  $this->apitimbanganmodel->CekBrutoById($id_spat[0]->id);

            if($cek_bruto){
                $data = array(
                    'id_spat' => $id_spat[0]->id,
                    'bruto' => $this->GetPost('bruto'),
                    'tgl_bruto' => date('Y-m-d H:i:s'),
                    'lokasi_timbang_1' => $this->GetPost('kode_timbangan'),
                    'ptgs_timbang_1' => $this->GetPost('ptgs_timbang'),
                );

                $this->db->set($data);
                $this->db->insert('t_timbangan');
                $result = array(
                    'msg' => $this->GetPost('no_spat'),
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
            $no_spat = $this->GetPost('no_spat');
            $this->load->model('apitimbanganmodel');
            $id_spat = $this->apitimbanganmodel->VByNoSpat($no_spat);
            $status_nett = $this->apitimbanganmodel->cekStatusSpat($no_spat, 'timb_netto_status', 1);

            if($status_nett == 0){
                $data_netto = array(
                    'tara' => $this->GetPost('tara'),
                    'netto' => $this->GetPost('netto'),
                    'netto_final' => $this->GetPost('netto'),
                    'tgl_netto' => date('Y-m-d H:i:s'),
                    'tgl_tara' => date('Y-m-d H:i:s'),
                    'lokasi_timbang_2' => $this->GetPost('kode_timbangan'),
                    'ptgs_timbang_2' => $this->GetPost('ptgs_timbang'),
                );

                if($this->GetPost('no_transloading') != "") {
                    $data_netto += array(
                        'transloading_status' => $this->GetPost('transloading_status'),
                        'no_transloading' => $this->GetPost('no_transloading'),
                        'ptgs_transloading' => $this->GetPost('ptgs_timbang'),
                        'tgl_transloading' => date('Y-m-d H:i:s'),
                    );
                }

                $where = array('id_spat' => $id_spat[0]->id);
                $this->apitimbanganmodel->UpdateNetto($where, $data_netto);

                $result = array(
                    'msg' => $this->GetPost('no_spat'),
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
            $no_spat =  $this->GetPost('no_spat');
            $this->load->model('apitimbanganmodel');
            $id_spat = $this->apitimbanganmodel->VByNoSpat($no_spat);

            if(count($id_spat) == 1){
                $status_nett = $this->apitimbanganmodel->cekStatusSpat($no_spat, 'timb_netto_status', 1);


                $bruto = $this->GetPost('bruto');
                $tara = $this->GetPost('tara');
                $netto = $this->GetPost('netto');
                $lokasi_timbang_1 = $this->GetPost('kode_timbangan');
                $ptgs_timbang_1 = $this->GetPost('ptgs_timbang');
                $no_lori = $this->GetPost('no_lori');
                $train_stat = $this->GetPost('train_stat');
                $no_loko = $this->GetPost('no_loko');

                if($status_nett == 0){
                    $data = array(
                        'id_spat' => $id_spat[0]->id,
                        'bruto' => $bruto,
                        'tara' => $tara,
                        'netto' => $netto,
                        'netto_final' => $netto,
                        'tgl_netto' => date('Y-m-d H:i:s'),
                        'tgl_tara' => date('Y-m-d H:i:s'),
                        'tgl_bruto' => date('Y-m-d H:i:s'),
                        'lokasi_timbang_1' => $lokasi_timbang_1,
                        'lokasi_timbang_2' => $lokasi_timbang_1,
                        'ptgs_timbang_1' => $ptgs_timbang_1,
                        'ptgs_timbang_2' => $ptgs_timbang_1,
                        'no_lori' => $no_lori,
                        'train_stat' => $train_stat,
                        'no_loko' => $no_loko
                    );

                    $this->db->set($data);
                    $this->db->insert('t_timbangan');
                    $result = array(
                        'msg' => "SPAT $no_spat Tersimpan",
                        'status' => 'true'
                    );
                    echo json_encode($result);

                }else{

                    $result = array(
                        'msg' => "SPAT $no_spat Sudah melakukan penimbangan",
                        'status' => 'false'
                    );
                    echo json_encode($result);

                }
            }else{
                $result = array(
                    'msg' => "No SPAT $no_spat tidak ditemukan",
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

    function simpantaralori()
    {

        $no_lori = $this->GetPost('no_lori');
        $tara = $this->GetPost('tara');
        $ptgs_timbang = $this->GetPost('ptgs_timbang');

        if($no_lori !== "" && $tara !== "" && $ptgs_timbang !== ""){
            $this->load->model('apitimbanganmodel');
            $result = $this->apitimbanganmodel->TaraLori($no_lori);

            try{
                if(count($result) > 0){
                    $where = array('nolori' => $no_lori);
                    $this->db->where($where);
                    $this->db->update('m_lori', array(
                        'tara' => $tara,
                        'usertara' => $ptgs_timbang,
                        'taradate' => date('Y-m-d H:i:s')
                    ));
                }else{
                    $this->db->set(array(
                        'nolori' => $no_lori,
                        'tara' => $tara,
                        'usertara' => $ptgs_timbang,
                        'taradate' => date('Y-m-d H:i:s')
                    ));
                    $this->db->insert('m_lori');
                }
                $result = array(
                    'msg' => "Berhasil simpan data Lori : $no_lori Tara : $tara",
                    'status' => 'false'
                );
                echo json_encode($result);
            }catch (Exception $ex){
                $result = array(
                    'msg' => $ex,
                    'status' => 'false'
                );
                echo json_encode($result);
            }
        }else{
            $result = array(
                'msg' => 'parameter tidak lengkap',
                'status' => 'false'
            );
            echo json_encode($result);
        }

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