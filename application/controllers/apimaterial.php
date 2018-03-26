<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

/**
 * Created by PhpStorm.
 * User: dirg
 * Date: 3/24/2018
 * Time: 1:43 PM
 */
class Apimaterial  extends SB_Controller
{

    function __construct() {
        parent::__construct();
        $this->data = array_merge( $this->data, array(
            'pageTitle'	=> 	'Api Timbangan',
            'pageNote'	=>  'SIM PG',
            'pageModule'	=> 'apimaterial',
        ));
    }

    function carimaterial()
    {
        $search = $this->input->get('search');
        $this->load->model('apimaterialmodel');
        $result = $this->apimaterialmodel->getMaterial($search);

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

    function carirelasi()
    {
        $search = $this->input->get('search');
        $this->load->model('apimaterialmodel');
        $result = $this->apimaterialmodel->getRelasi($search);

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

    function cariTransaksi()
    {
        $search = $this->input->get('search');
        $this->load->model('apimaterialmodel');
        $result = $this->apimaterialmodel->getRelasi($search);

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