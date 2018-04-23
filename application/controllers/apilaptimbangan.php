<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

/**
 * Created by PhpStorm.
 * User: dirg
 * Date: 4/23/2018
 * Time: 11:11 PM
 */
class apilaptimbangan extends SB_Controller
{
    function __construct() {
        parent::__construct();
        $this->load->model('mmasterfieldmodel');
        $this->model = $this->mmasterfieldmodel;
        $this->data = array_merge( $this->data, array(
            'pageTitle'	=> 	'Laporan',
            'pageNote'	=>  'SIM PG',
            'pageModule'	=> 'laporan',
        ));
    }

    function index(){
        $this->data['content'] =  $this->load->view('laporantimbangan/index_timbangan', $this->data ,true);
        $this->load->view('layouts/cetak',$this->data);
    }

    function printlaporan(){
        $wh = 'WHERE 0=0';
        $wh2 = 'WHERE 0=0';

        $tgl1 = $_REQUEST['tgl1'];
        $tgl2 = $_REQUEST['tgl2'];
        $bln  = $_REQUEST['bln'];
        $thn  = $_REQUEST['thn'];
        $rjns = $_REQUEST['rjns'];
        $jns  = $_REQUEST['jns'];


        $kat  		= $_REQUEST['kat'];
        $angkutan  	= $_REQUEST['angkutan'];
        $afd  		= $_REQUEST['divisi'];
        $petak  	= $_REQUEST['kode_blok'];
        $tebangan  	= $_REQUEST['tebangan'];


        if($rjns == 1) {
            $wh .= " AND date(timb_netto_tgl) between '$tgl1' and '$tgl2'";
            $this->data['title'] = 	"PERIODE ".SiteHelpers::datereport($tgl1)." s/d ".SiteHelpers::datereport($tgl2).' <br />';
        }
        if($rjns == 2) {
            $wh .= " AND MONTH(timb_netto_tgl) = '$bln' and YEAR(a.timb_netto_tgl) = '$thn'";
            $this->data['title'] = 	"BULAN ".SiteHelpers::blnreport($bln)." TAHUN ".$thn.' <br />';
        }
        if($rjns == 3) {
            $wh .= " AND  YEAR(timb_netto_tgl) = '$thn'";
            $this->data['title'] = 	"TAHUN ".$thn.' <br />';
        }

        if($tebangan != '' && $jns != 1){
            $wh2 .= " AND  a.stt_ta = '$tebangan'";
            $kettimb = array('00'=>'TAS','11'=>'TAPG','10'=>'TPGAS','01'=>'TSAPG');
            $this->data['title'] .= 	" TEBANGAN ".$kettimb[$tebangan];
        }

        if($kat != ''){
            $wh .= " AND  kode_kat_lahan LIKE '$kat%'";
            $this->data['title'] .= 	" KATEGORI ".$kat;
        }

        if($angkutan != ''){
            $wh .= " AND  jenis_spta = '$angkutan'";
            $this->data['title'] .= 	" ANGKUTAN ".$angkutan;
        }

        if($afd != ''){
            $wh2 .= " AND  d.divisi = '$afd'";
            $this->data['title'] .= 	"<br /> AFDELING ".$afd;
        }

        if($petak != ''){
            $wh2 .= " AND  a.kode_blok = '$petak'";
            $this->data['title'] .= 	" PETAK ".$petak;
        }



        if($jns == 1){
            $sql = "SELECT a.`kode_blok`,d.`deskripsi_blok`,e.`nama_petani`,a.`kode_kat_lahan`,SUM(a.`truk`) AS truk,SUM(a.`lori`) AS lori,SUM(a.`odong2`) AS odong2,SUM(a.`traktor`) AS traktor,
d.`luas_ha`,SUM(b.ha_tertebang) AS tertebang,
SUM(c.`netto_final`) AS netto,
(d.luas_ha-(SUM(b.ha_tertebang))) AS sisa FROM 
(SELECT *,IF(jenis_spta='TRUK',1,0) AS truk,IF(jenis_spta='LORI',1,0) AS lori,IF(jenis_spta='ODONG2',1,0) AS odong2,IF(jenis_spta='TRAKTOR',1,0) AS traktor FROM t_spta $wh) AS a
INNER JOIN t_selektor b ON b.`id_spta`=a.`id`
INNER JOIN t_timbangan c ON c.`id_spat`=a.`id`
INNER JOIN sap_field d ON d.`kode_blok`=a.`kode_blok`
LEFT JOIN sap_petani e ON e.`id_petani_sap`=a.`id_petani_sap` $wh2 GROUP BY a.`kode_blok`";
            $result = $this->db->query($sql)->result();

            $this->data['result'] = $result;
            $this->load->view('laporantimbangan/perpetak',$this->data);
        }else{
            $sql = "SELECT a.no_spat,a.`kode_blok`,d.`deskripsi_blok`,d.divisi,e.`nama_petani`,a.`kode_kat_lahan`,b.no_angkutan,c.no_transloading,SUM(a.`truk`) AS truk,SUM(a.`lori`) AS lori,SUM(a.`odong2`) AS odong2,SUM(a.`traktor`) AS traktor,
d.`luas_ha`,SUM(b.ha_tertebang) AS tertebang,
SUM(c.`netto_final`) AS netto,
a.stt_ta,
IF(a.stt_ta = '11','TAPG',IF(a.stt_ta = '10','TPGAS',IF(a.stt_ta='01','TSAPG','TAS'))) AS stt_ta_text,
(d.luas_ha-(SUM(b.ha_tertebang))) AS sisa,a.`timb_netto_tgl` FROM 
(SELECT *,CONCAT(tebang_pg,angkut_pg) AS stt_ta,IF(jenis_spta='TRUK',1,0) AS truk,IF(jenis_spta='LORI',1,0) AS lori,IF(jenis_spta='ODONG2',1,0) AS odong2,IF(jenis_spta='TRAKTOR',1,0) AS traktor FROM t_spta $wh) AS a
INNER JOIN t_selektor b ON b.`id_spta`=a.`id`
INNER JOIN t_timbangan c ON c.`id_spat`=a.`id`
INNER JOIN sap_field d ON d.`kode_blok`=a.`kode_blok`
LEFT JOIN sap_petani e ON e.`id_petani_sap`=a.`id_petani_sap` $wh2 GROUP BY a.`id` ORDER BY a.stt_ta";
            $result = $this->db->query($sql)->result();

            $this->data['result'] = $result;
            $this->load->view('laporantimbangan/perspta',$this->data);
        }


    }

    function petakget(){
        $g = $_GET;
        $src = $g['term'];
        $limit = $g['limit'];
        //var_dump($src);die();
        $a = $this->db->query("SELECT kode_blok,divisi,deskripsi_blok,kepemilikan FROM sap_field WHERE 0=0 and (kode_blok like '%$src%' OR deskripsi_blok like '%$src%') limit $limit")->result();
        $suburbs = array();
        foreach ($a as $d) {
            $suburbs[] = array( 'divisi' => $d->divisi,'kode_blok' => $d->kode_blok,'kepemilikan' => $d->kepemilikan , 'deskripsi_blok'=>$d->deskripsi_blok);
        }
        echo json_encode( $suburbs );
    }
}