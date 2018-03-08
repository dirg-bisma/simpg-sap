<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

/**
 * Created by PhpStorm.
 * User: dirg
 * Date: 2/28/2018
 * Time: 11:22 AM
 */
class laporanmejatebu extends SB_Controller
{
    protected $layout 	= "layouts/main";
    public $module 		= 'laporanmejatebu';
    public $per_page	= '10';

    function __construct() {
        parent::__construct();
        $this->data = array_merge( $this->data, array(
            'pageTitle'	=> 	'Laporan',
            'pageNote'	=>  'SIM PG',
            'pageModule'	=> 'laporan',
        ));
    }

    function index(){
        $this->data['content'] =  $this->load->view('laporanmejatebu/index', $this->data ,true);
        $this->load->view('layouts/main',$this->data);
    }

    function printlaporan(){
        $wh = 'WHERE 0=0';

        $tgl1 = $_REQUEST['tgl1'];
        $tgl2 = $_REQUEST['tgl2'];
        $bln  = $_REQUEST['bln'];
        $thn  = $_REQUEST['thn'];
        $rjns = $_REQUEST['rjns'];
        //$jns  = $_REQUEST['jns'];

        if($rjns == 1) {
            $wh .= " AND date(meja_tebu_tgl) between '$tgl1' and '$tgl2'";
            $this->data['title'] = 	"PERIODE ".SiteHelpers::datereport($tgl1)." s/d ".SiteHelpers::datereport($tgl2);
        }
        if($rjns == 2) {
            $wh .= " AND MONTH(meja_tebu_tgl) = '$bln' and YEAR(a.meja_tebu_tgl) = '$thn'";
            $this->data['title'] = 	"BULAN ".SiteHelpers::blnreport($bln)." TAHUN ".$thn;
        }
        if($rjns == 3) {
            $wh .= " AND  YEAR(meja_tebu_tgl) = '$thn'";
            $this->data['title'] = 	"TAHUN ".$thn;
        }

        $sql = "SELECT 
                a.`kode_blok`,
                d.`deskripsi_blok`,
                e.`nama_petani`,
                a.`kode_kat_lahan`,
                SUM(a.`truk`) AS truk,SUM(a.`lori`) AS lori,
                d.`luas_ha`,SUM(b.ha_tertebang) AS tertebang,
                SUM(c.`netto_final`) AS netto,
                (d.luas_ha-(SUM(b.ha_tertebang))) AS sisa,
                count(if(x.kondisi_tebu='A', x.kondisi_tebu, NULL)) as A, 
                count(if(x.kondisi_tebu='B', x.kondisi_tebu, NULL)) as B, 
                count(if(x.kondisi_tebu='C', x.kondisi_tebu, NULL)) as C, 
                count(if(x.kondisi_tebu='D', x.kondisi_tebu, NULL)) as D, 
                count(if(x.kondisi_tebu='E', x.kondisi_tebu, NULL)) as E 
                FROM 
                (SELECT *,IF(jenis_spta='TRUK',1,0) AS truk,IF(jenis_spta='LORI',1,0) AS lori FROM t_spta $wh) AS a
                INNER JOIN t_selektor b ON b.`id_spta`=a.`id`
                INNER JOIN t_timbangan c ON c.`id_spat`=a.`id`
                INNER JOIN sap_field d ON d.`kode_blok`=a.`kode_blok`
                INNER JOIN t_meja_tebu x on x.id_spta = a.id
                LEFT JOIN sap_petani e ON e.`id_petani_sap`=a.`id_petani_sap` GROUP BY a.`kode_blok`";

        $result = $this->db->query($sql)->result();

        $this->data['result'] = $result;
        $this->load->view('laporanmejatebu/print',$this->data);

    }


}