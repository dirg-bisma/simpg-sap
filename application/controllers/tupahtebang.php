<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Tupahtebang extends SB_Controller 
{

	protected $layout 	= "layouts/main";
	public $module 		= 'tupahtebang';
	public $per_page	= '10';
	public $idx			= '';

	function __construct() {
		parent::__construct();
		
		$this->load->model('tupahtebangmodel');
		$this->model = $this->tupahtebangmodel;
		$idx = $this->model->primaryKey;
		
		$this->info = $this->model->makeInfo( $this->module);
		$this->access = $this->model->validAccess($this->info['id']);	
		$this->data = array_merge( $this->data, array(
			'pageTitle'	=> 	$this->info['title'],
			'pageNote'	=>  $this->info['note'],
			'pageModule'	=> 'tupahtebang',
		));
		$this->col = array();
		$this->con = array();
		$inf = $this->info['config']['grid'];
		$inf = SiteHelpers::array_sort($inf, 'sortlist', SORT_ASC);
		$in=0;
		foreach ($inf as $key => $t) {
			if($t['view'] =='1'){
				
				$in++;
				$this->col[$in] = $t['field'];
				$this->con[$in] = $t['conn'];
				
			}
			
		}
		
		if(!$this->session->userdata('logged_in')) redirect('user/login',301);
		
	}

	function grids($tgl){
		
		$sort = $this->model->primaryKey; 
		$order = 'asc';
		$filter = "";
		//$filter = (!is_null($this->input->get('search', true)) ? $this->buildSearch() : '');
		//order 
		if(isset($_POST['order']))
        {
            if(($_POST['order']['0']['column'])==0){
        		$sort = $this->col[($_POST['order']['0']['column'])+1];
            	$order = $_POST['order']['0']['dir'];
        	}else{
            	$sort = $this->col[($_POST['order']['0']['column'])];
            	$order = $_POST['order']['0']['dir'];
        	}

        }

        for ($i=0; $i < count($this->col) ; $i++) { 
        	
            if(isset($_POST['search']['value']) && $_POST['search']['value'] != ''){
            	if($i==0){
            		$filter .= " AND (".$this->col[$i+1]." LIKE '%".$_POST['search']['value']."%'";
            	}else{
            		$filter .= " OR ".$this->col[$i+1]." LIKE '%".$_POST['search']['value']."%'";
            	}
            }
        }

        if($filter != '') $filter .= ')';

        $tgl2 = $_GET['tgl2'];
		$filter .= " AND tgl BETWEEN '$tgl' AND '$tgl2' ";
        
        $pta = $_GET['pta'];
        $mandor = $_GET['mandor'];

        if($pta != '') $filter .= " AND persno_pta = '$pta'";
        if($mandor != '') $filter .= " AND persno_mandor = '$mandor'";


		$params = array(
			'limit'		=> $_POST['start'],
			'page'		=> $_POST['length'],
			'sort'		=> $sort ,
			'order'		=> $order,
			'params'	=> $filter,
			'global'	=> (isset($this->access['is_global']) ? $this->access['is_global'] : 0 )
		);
		// Get Query 
		$results = $this->model->getRows( $params );
		$rows = $results['rows'];
		$total = $results['total'];
		$totalfil = $results['totalfil'];
		
		//run data to view
		$data = array();$no=0;$stt = array('0'=>'Buat','1'=>'Validasi','2'=>'SAP');
		foreach ($rows as $dt) {
            $row = array();
            $row[] = $no+1;
            for ($i=0; $i < count($this->col) ; $i++) { 
            		$field = $this->col[$i+1];
            		if($field == 'status') {
            			$row[] = $stt[$dt->status];
            		}else{
            		$conn = (isset($this->con[$i+1]) ? $this->con[$i+1] : array() ) ;
					$row[] = SiteHelpers::gridDisplay($dt->$field , $field , $conn );
				}
            }
 
            //add html for action
            $btn ='';
			$idku = $this->model->primaryKey;
            if($this->access['is_detail'] ==1){
            	$btn .= '<a href='.site_url('tupahtebang/show/'.$dt->$idku).'  class="tips "  title="view"><i class="fa  fa-search"></i>  </a> &nbsp;&nbsp;';
            }
            if($this->access['is_edit'] ==1 && $dt->status == 0){
            	$btn .= '<a href='.site_url('tupahtebang/add/'.$dt->$idku).'  class="tips "  title="Edit"><i class="fa  fa-edit"></i>  </a> &nbsp;&nbsp;';
            }
            if($this->access['is_remove'] ==1 && $dt->status == 0){
            	$btn .= '<a href="#" onclick="ConfirmDelete(\''.site_url('tupahtebang/destroy/').'\','.$dt->$idku.')"  class="tips "  title="Delete"><i class="fa  fa-trash"></i>  </a>';
            	
            }
           
 			$row[] = $btn;
            $data[] = $row;
            $no++;
        }
         $output = array(
                        "draw" => $_POST['draw'],
                        "recordsTotal" => $total,
                        "recordsFiltered" => $totalfil,
                        "data" => $data,
                );
        //output to json format
        echo json_encode($output);

	}

	function validasi($id){
		if($id != ''){
			$this->db->query('UPDATE t_upah_tebang SET status=1 WHERE id='.$id);
			redirect('tupahtebang/show/'.$id,301);	
		}else{
			redirect('tupahtebang',301);
		}
	}
	
	function index() 
	{
		if($this->access['is_view'] ==0)
		{ 
			$this->session->set_flashdata('error',SiteHelpers::alert('error','Your are not allowed to access the page'));
			redirect('dashboard',301);
		}	
		
		$this->data['tableGrid'] 	= $this->info['config']['grid'];

		// Group users permission
		$this->data['access']		= $this->access;
		// Render into template
		
		$this->data['content'] = $this->load->view('tupahtebang/index',$this->data, true );
		
    	$this->load->view('layouts/main', $this->data );
    
	  
	}
	function printbukti($tgl){

        $tgl2 = $_GET['tgl2'];
		$filter = " WHERE 0=0 AND tgl BETWEEN '$tgl' AND '$tgl2'";
        
        $pta = $_GET['pta'];
        $mandor = $_GET['mandor'];
        $tgl2 = $_GET['tgl2'];

        if($pta != '') $filter .= " AND persno_pta = '$pta'";
        if($mandor != '') $filter .= " AND persno_mandor = '$mandor'";

        $sql =$this->db->query("SELECT id FROM t_upah_tebang $filter")->result();
        $htm = '';
        foreach ($sql as $key) {
        	$htm .= $this->printoutbukti($key->id);
        }

        $this->data['content'] = $htm;
        $this->data['title'] = 'Cetak Bukti Upah Tebang';
		$this->load->view('layouts/kosongCetakulang', $this->data );
	}

	function printoutbukti( $id = null) 
	{
		
		$row = $this->model->getRow($id);
		$this->data['coldefadd'] = $this->db->query("select kodekolom,nama_pekerjaan_tma,satuan from m_pekerjaan_tma where status_pekerjaan=1 and jenis=1 order by id_pekerjaan_tma asc")->result();
			$this->data['coldefrem'] = $this->db->query("select kodekolom,nama_pekerjaan_tma,satuan from m_pekerjaan_tma where status_pekerjaan=1 and jenis=2 order by id_pekerjaan_tma asc")->result();
			$this->data['colnondefadd'] = $this->db->query("select kodekolom,nama_pekerjaan_tma,satuan from m_pekerjaan_tma where status_pekerjaan=0 and jenis=1 order by id_pekerjaan_tma asc")->result();
			$this->data['colnondefrem'] = $this->db->query("select kodekolom,nama_pekerjaan_tma,satuan from m_pekerjaan_tma where status_pekerjaan=0 and jenis=2 order by id_pekerjaan_tma asc")->result();
		if($row)
		{
			$this->data['row'] =  $row;
			$this->data['detail'] = $this->db->query("SELECT b.`no_spat`,b.timb_netto_tgl,c.`no_angkutan`,a.* FROM `t_upah_tebang_detail` a
INNER JOIN t_spta b ON a.`id_spta`=b.`id`
INNER JOIN t_selektor c ON c.`id_spta`=b.`id` WHERE a.id_upah_tebang=$id")->result();

			$this->data['detailx'] = $this->db->query("SELECT a.* FROM `t_upah_tebang_detail` a WHERE a.id_upah_tebang=$id GROUP BY a.`id_upah_tebang`")->result();
		} 
		
		$this->data['id'] = $id;
		return $this->load->view('tupahtebang/printout', $this->data ,true);	  
		
	}


	function printoutrekap(){
		
	}

	function show( $id = null) 
	{
		if($this->access['is_detail'] ==0)
		{ 
			$this->session->set_flashdata('error',SiteHelpers::alert('error','Your are not allowed to access the page'));
			redirect('dashboard',301);
	  	}		

		$row = $this->model->getRow($id);
		$this->data['coldefadd'] = $this->db->query("select kodekolom,nama_pekerjaan_tma,satuan from m_pekerjaan_tma where status_pekerjaan=1 and jenis=1 order by id_pekerjaan_tma asc")->result();
			$this->data['coldefrem'] = $this->db->query("select kodekolom,nama_pekerjaan_tma,satuan from m_pekerjaan_tma where status_pekerjaan=1 and jenis=2 order by id_pekerjaan_tma asc")->result();
			$this->data['colnondefadd'] = $this->db->query("select kodekolom,nama_pekerjaan_tma,satuan from m_pekerjaan_tma where status_pekerjaan=0 and jenis=1 order by id_pekerjaan_tma asc")->result();
			$this->data['colnondefrem'] = $this->db->query("select kodekolom,nama_pekerjaan_tma,satuan from m_pekerjaan_tma where status_pekerjaan=0 and jenis=2 order by id_pekerjaan_tma asc")->result();
		if($row)
		{
			$this->data['row'] =  $row;
			$this->data['detail'] = $this->db->query("SELECT b.`no_spat`,b.timb_netto_tgl,c.`no_angkutan`,a.* FROM `t_upah_tebang_detail` a
INNER JOIN t_spta b ON a.`id_spta`=b.`id`
INNER JOIN t_selektor c ON c.`id_spta`=b.`id` WHERE a.id_upah_tebang=$id")->result();

			$this->data['detailx'] = $this->db->query("SELECT a.* FROM `t_upah_tebang_detail` a WHERE a.id_upah_tebang=$id GROUP BY a.`id_upah_tebang`")->result();
		} else {
			
			$this->data['row'] = $this->model->getColumnTable('t_upah_tebang'); 
		}
		
		$this->data['id'] = $id;
		$this->data['content'] =  $this->load->view('tupahtebang/view', $this->data ,true);	  
		$this->load->view('layouts/main',$this->data);
	}
  
	function add( $id = null ) 
	{
		if($id =='')
			if($this->access['is_add'] ==0) redirect('dashboard',301);

		if($id !='')
			if($this->access['is_edit'] ==0) redirect('dashboard',301);	

		$row = $this->model->getRow( $id );
		if($row)
		{
			$this->data['row'] =  $row;
			$a = "SELECT a.`no_spat`,a.`jenis_spta`,b.no_angkutan,b.terbakar_sel,d.* FROM t_spta a
INNER JOIN sap_field a1 ON a1.`kode_blok`=a.`kode_blok`
INNER JOIN t_selektor b ON a.id=b.id_spta
INNER JOIN t_timbangan c ON c.`id_spat`=a.`id`
INNER JOIN t_upah_tebang_detail d ON d.`id_spta`=a.`id` WHERE d.id_upah_tebang=$id";
		$b = $this->db->query($a)->result();
			$this->data['detail'] =  $b;
		} else {
			$this->data['row'] = $this->model->getColumnTable('t_upah_tebang'); 
		}
		
		$this->data['row']['tgl'] = date('Y-m-d');
		$this->data['id'] = $id;
		$this->data['content'] = $this->load->view('tupahtebang/form',$this->data, true );		
	  	$this->load->view('layouts/main', $this->data );
	
	}
	
	function save() {
		//var_dump($_POST);die();
		$rules = $this->validateForm();

		$this->form_validation->set_rules( $rules );
		if( $this->form_validation->run() )
		{
			$t = $this->db->query("SELECT * FROM m_pekerjaan_tma where status_pekerjaan != 2 ORDER BY id_pekerjaan_tma ASC")->result();
			
			$data = $this->validatePost();
			$data['tgl_act'] = date('Y-m-d H:i:s');
			$data['user_act'] = $this->session->userdata('fid');
			$data['ttl_item'] = count($_POST['idx']);

			$ID = $this->model->insertRow($data , $this->input->get_post( 'id' , true ));
			$this->db->query("DELETE FROM t_upah_tebang_detail where id_upah_tebang = '".$ID."'");
			$this->db->query("UPDATE t_spta a SET a.`upah_tebang_status`=0,a.`upah_tebang_tgl` = NULL WHERE a.`upah_tebang_status`='".$ID."'");
			$ax = array();
			$arr = array();
			foreach ($_POST['idx'] as $in => $idspta) {
				
				$ax = array(
				'id_upah_tebang'=>$ID,
				'id_spta' => $_POST['idx'][$in],
				'netto'	=> $_POST['netto'][$in]
				);
				
				foreach($t as $re){
					$arr = array(
					$re->kodekolom => $_POST[$re->kodekolom][$in]
					);
					$ax = array_merge($ax,$arr);
				}
				$this->db->insert( 't_upah_tebang_detail',$ax);
			}
			
			// Input logs
			if( $this->input->get( 'id' , true ) =='')
			{
				$this->inputLogs("New Entry row with ID : $ID  , Has Been Save Successfull");
			} else {
				$this->inputLogs(" ID : $ID  , Has Been Changed Successfull");
			}

			$this->db->query("UPDATE t_spta a INNER JOIN t_upah_tebang_detail b ON a.`id`=b.`id_spta`
SET a.`upah_tebang_status`=".$ID.",a.`upah_tebang_tgl` = NOW() WHERE b.`id_upah_tebang`='".$ID."'");
			// Redirect after save	
			$this->session->set_flashdata('message',SiteHelpers::alert('success'," Data has been saved succesfuly !"));
			if($this->input->post('apply'))
			{
				redirect( 'tupahtebang/add/'.$ID,301);
			} else {
				redirect( 'tupahtebang',301);
			}			
			
			
		} else {
			$data =	array(
					'message'	=> 'Ops , The following errors occurred',
					'errors'	=> validation_errors('<li>', '</li>')
					);			
			$this->displayError($data);
		}
	}

	function destroy()
	{
		if($this->access['is_remove'] ==0)
		{ 
			echo "err : maaf anda tidak memiliki hak untuk menghapus data";
	  	}
			
		$this->model->destroy($_POST['id']);
		$this->db->query("DELETE FROM t_upah_tebang_detail where id_upah_tebang = '".$_POST['id']."'");
		$this->inputLogs("ID : ".$_POST['id']."  , Has Been Removed Successfull");
		echo "ID : ".$_POST['id']."  , berhasil dihapus !!";
		
	}


	
	function getlistTimbangan(){
		$kodeblok = $_POST['kode_blok'];
		$pta = $_POST['pta'];
		$mandor = $_POST['mandor'];
		$tgla = $_POST['tgla'];
		$tglb = $_POST['tglb'];
		
		$wh = " AND a.kode_blok='$kodeblok' AND a.persno_pta='$pta' and b.persno_mandor_tma='$mandor' and date(a.timb_netto_tgl) BETWEEN '$tgla' and '$tglb'";
		
		$sql = "SELECT a.id,a.`persno_pta`,a.kode_blok,b.persno_mandor_tma,a.`no_spat`,a.`kode_kat_lahan`,c.`netto_final`, b.no_angkutan,a1.`deskripsi_blok`,date(a.`timb_netto_tgl`) as tgl_timb,a.`jenis_spta`,a.upah_tebang_status,b.terbakar_sel FROM t_spta a
INNER JOIN sap_field a1 ON a1.`kode_blok`=a.`kode_blok`
INNER JOIN t_selektor b ON a.id=b.id_spta
INNER JOIN t_timbangan c ON c.`id_spat`=a.`id`
WHERE a.`timb_netto_status` = 1 AND a.`tebang_pg`=1 $wh";
		
		$th = $this->db->query($sql)->result();
		$htm = "";
		$arter = array('1'=>'Ya','0'=>'Tidak');
		foreach($th as $tb){

			$r = 'javascript:addrow("'.$tb->id.'","'.$tb->no_spat.'","'.$tb->no_angkutan.'","'.$tb->jenis_spta.'","'.$tb->netto_final.'","'.$arter[$tb->terbakar_sel].'")';
			$htm .= "<tr>";
			if($tb->upah_tebang_status == 0){
				$htm .= "<td><a href='".$r."'><i class='fa fa-send'></i></a></td>";
			}else{
				$htm .= "<td>-</td>";
			}
				
				$htm .=  "<td>".$tb->kode_blok."</td>
				<td>".$tb->no_spat."</td>
				<td>".$tb->no_angkutan."</td>
				<td>".$tb->tgl_timb."</td>
				<td>".$tb->netto_final."</td>
				<td>".$tb->kode_kat_lahan."</td>
				<td>".$tb->jenis_spta."</td>
				<td>".$arter[$tb->terbakar_sel]."</td>
			</tr>";
		}
		
		echo $htm;
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