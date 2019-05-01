<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Apiselektor extends SB_Controller
{
	public $module 		= 'tselektor';

	function __construct() {
        parent::__construct();
        $this->load->model('tselektormodel');
		$this->model = $this->tselektormodel;
		$idx = $this->model->primaryKey;
		
		$this->info = $this->model->makeInfo( $this->module);
		$this->access = $this->model->validAccess($this->info['id']);	
		$this->data = array_merge( $this->data, array(
			'pageTitle'	=> 	"Selektor Desktop",
			'pageNote'	=>  "API Selektor Desktop",
			'pageModule'	=> 'tselektor',
		));
        
    }

    function login()
    {
        $user = $this->GetPost('username');
        $pass = md5($this->GetPost('password'));

        $result = $this->db->get_where('tb_users', array('username'=>$user, 'password' => $pass, 'group_id' => 4));


        if($result->num_rows() == 1){
            $msg = array('msg' => '1', 'status' => 'true');
        }else{
            $msg = array('msg' => '0', 'status' => 'false');
        }
        echo json_encode($msg);
    }



    function cekspta(){
		$arr['stt'] = 0;
		if(isset($_POST['nospta']) || isset($_POST['rfid_sticker'])){
			$cek = $this->db->query("SELECT id,kode_blok,jenis_spta,
				IF( tebang_pg = 0 AND angkut_pg = 0,'TAS',
IF( tebang_pg = 1 AND angkut_pg = 0,'TPGAS',
IF( tebang_pg = 0 AND angkut_pg = 1,'TSAPG',
IF( tebang_pg = 1 AND angkut_pg = 1,'TAPG','')))) AS kat_spta,kode_kat_lahan,kode_affd,CONCAT(tgl_spta,' 00:00:00') AS tgl_spta,tgl_expired,
IF(NOW() < CONCAT(tgl_spta,' 05:59:00'),CONCAT('SPTA Belum Berlaku, Berlaku pada ',DATE_FORMAT(tgl_spta,'%d %M %Y'),' 06:00:00'),'1') AS berlaku,IF(metode_tma=1,'MANUAL',IF(metode_tma=2,'SEMI MEKANISASI','MEKANISASI')) AS txt_metode_tma,
IF(NOW() > tgl_expired,CONCAT('SPTA sudah Expired Pada ',DATE_FORMAT(tgl_expired,'%d %M %Y Jam %H:%i')),'0') AS ed,
IF(selektor_status=0,if(retur_status=1,'SPTA Sudah di retur!',0),CONCAT('SPTA sudah Masuk Selektor Pada ',DATE_FORMAT(selektor_tgl,'%d %M %Y Jam %H:%i'))) AS stt,
metode_tma FROM t_spta WHERE (no_spat = '".$_POST['nospta']."' OR rfid_sticker = '".$_POST['rfid_sticker']."')")->row();
		$arr['stt'] = 1;
		if($cek){
			$arr['stt'] = 1;
			$arr['data'] = $cek;
		}else{
			$arr['stt'] = 0;
		}
		
		}
		echo json_encode($arr);
	}

	function caribynospta(){
		$arr['stt'] = 0;
		if(isset($_GET['nospta'])){
			$query = "SELECT id,kode_blok,jenis_spta,
			IF( tebang_pg = 0 AND angkut_pg = 0,'TAS',
IF( tebang_pg = 1 AND angkut_pg = 0,'TPGAS',
IF( tebang_pg = 0 AND angkut_pg = 1,'TSAPG',
IF( tebang_pg = 1 AND angkut_pg = 1,'TAPG','')))) AS kat_spta,kode_kat_lahan,kode_affd,CONCAT(tgl_spta,' 00:00:00') AS tgl_spta,tgl_expired,
IF(NOW() < CONCAT(tgl_spta,' 05:59:00'),CONCAT('SPTA Belum Berlaku, Berlaku pada ',DATE_FORMAT(tgl_spta,'%d %M %Y'),' 06:00:00'),'1') AS berlaku,IF(metode_tma=1,'MANUAL',IF(metode_tma=2,'SEMI MEKANISASI','MEKANISASI')) AS txt_metode_tma,
IF(NOW() > tgl_expired,CONCAT('SPTA sudah Expired Pada ',DATE_FORMAT(tgl_expired,'%d %M %Y Jam %H:%i')),'0') AS ed,
IF(selektor_status=0,if(retur_status=1,'SPTA Sudah di retur!',0),CONCAT('SPTA sudah Masuk Selektor Pada ',DATE_FORMAT(selektor_tgl,'%d %M %Y Jam %H:%i'))) AS stt,
metode_tma FROM t_spta WHERE (no_spat = '".$_GET['nospta']."')";
		$cek = $this->db->query($query)->row();
		$arr['stt'] = 1;
		if($cek){
			$arr['stt'] = 1;
			$arr['data'] = $cek;
		}else{
			$arr['stt'] = 0;
			$arr['data'] = $cek;
		}
		
		}
		echo json_encode($arr);
	}


	function datagrid(){
		$arr = array();
		$sql = $this->db->query("SELECT no_spat,tgl_selektor,no_urut,no_angkutan,ptgs_angkutan,terbakar_sel,ditolak_sel,IFNULL(open_gate,'Belum') AS open_gate FROM vw_selektor_data ORDER BY tgl_urut,no_urut DESC limit 20")->result();

		if($sql){
			$arr['stt'] = 1;
			$arr['data'] = $sql;
		}else{
			$arr['stt'] = 0;
		}
		echo json_encode($arr);
	}


	function datamandor(){
		$arr = array();
		$sql = $this->db->query("SELECT * FROM sap_m_karyawan where id_jabatan = 3")->result();

		if($sql){
			$arr['stt'] = 1;
			$arr['data'] = $sql;
		}else{
			$arr['stt'] = 0;
		}
		echo json_encode($arr);
	}

	function save()
	{
		$arr['stt'] = 0;

		$cekcard = $this->db->query("SELECT no_spat FROM t_spta WHERE rfid_card = '".$_POST['rfid_card']."' AND status = 1")->row();
		if($cekcard){
			
			$arr['stt'] = 0;
			$arr['data'] = "Kartu Masih Tertaut Dengan SPTA ".$cekcard->no_spat;

		}else{
		$rules = $this->validateForm();


		$this->form_validation->set_rules( $rules );
		if( $this->form_validation->run() )
		{
			$data = $this->validatePost();
			$data['tgl_selektor'] = date('Y-m-d H:i:s');
			$data['no_angkutan'] =  strtoupper($data['no_angkutan']);
			$data['ptgs_angkutan'] = strtoupper($data['ptgs_angkutan']);
			$data['tgl_tebang'] = $_POST['tgl_tebang'].' '.$_POST['jam_tebang'].':00';
			$data['ptgs_selektor'] = $_POST['username'];
			$data['rfid_card'] = $_POST['rfid_card'];

			
			
			$rx = $this->db->query('SELECT IFNULL(MAX(no_urut),0)+1 AS nourut,get_tgl_giling() AS tgl FROM t_selektor WHERE tgl_urut = get_tgl_giling() AND ptgs_selektor="'.$data['ptgs_selektor'].'"')->row();
			$data['no_urut'] = $rx->nourut;
			$data['tgl_urut'] = $rx->tgl;
			
			
			$ID = $this->model->insertRow($data , $this->input->get_post( 'id_selektor' , true ));

			$sql = $this->db->query("UPDATE t_spta SET rfid_card='".$_POST['rfid_card']."',rfid_card_tagging=NOW(),rfid_card_status=1 WHERE id = '".$data['id_spta']."'");
			
			// Input logs
			if( $this->input->get( 'id_selektor' , true ) =='')
			{
				$this->inputLogs("New Entry row with ID : $ID  , Has Been Save Successfull");
			} else {
				$this->inputLogs(" ID : $ID  , Has Been Changed Successfull");
			}
			// Redirect after save

			$arr['stt'] = 1;
			$arr['data'] = $ID;	
						
			
			
		} else {
			$arr['stt'] = 0;
			$arr['data'] = "Gagal Simpan ".validation_errors('', '\n');
		}
		}

		echo json_encode($arr);
	}


}