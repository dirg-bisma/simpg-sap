<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Tsbh extends SB_Controller 
{

	protected $layout 	= "layouts/main";
	public $module 		= 'tsbh';
	public $per_page	= '10';
	public $idx			= '';

	function __construct() {
		parent::__construct();
		
		$this->load->model('tsbhmodel');
		$this->model = $this->tsbhmodel;
		$idx = $this->model->primaryKey;
		
		$this->info = $this->model->makeInfo( $this->module);
		$this->access = $this->model->validAccess($this->info['id']);	
		$this->data = array_merge( $this->data, array(
			'pageTitle'	=> 	$this->info['title'],
			'pageNote'	=>  $this->info['note'],
			'pageModule'	=> 'tsbh',
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

	function grids($stt,$tgl1,$tgl2){
		
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
		
		if($stt != 0){
			$tx = $stt-1;
			$filter .= " AND sbh_status IN ($tx,$stt) AND tgl_giling BETWEEN '$tgl1' AND '$tgl2'";
		}else{
			$filter .= " AND  tgl_giling BETWEEN '$tgl1' AND '$tgl2'";
		}
         
        	
            if(isset($_POST['search']['value']) && $_POST['search']['value'] != ''){
				$term = $_POST['search']['value'];
            	$filter .= " AND (no_spat like '%$term%' OR kode_kat_lahan like '%$term%' OR kode_blok  like '%$term%' OR kode_blok  like '%$term%' OR jenis_spta  like '%$term%')";
            }
        

		$params = array(
			'limit'		=> $_POST['start'],
			'page'		=> $_POST['length'],
			'sort'		=> $sort ,
			'order'		=> $order,
			'params'	=> $filter,
			'global'	=> (isset($this->access['is_global']) ? $this->access['is_global'] : 0 )
		);
		// Get Query 
		$results = $this->model->getRowspdx( $params );
		$rows = $results['rows'];
		$total = $results['total'];
		$totalfil = $results['totalfil'];
		
		//run data to view
		$data = array();$no=0;
		foreach ($rows as $dt) {
            $row = array();
            for ($i=0; $i < count($this->col) ; $i++) { 
            		$field = $this->col[$i+1];
					$st = array('0'=>'ARI','1'=>'SBH','2'=>'PENGOLAHAN','3'=>'TANAMAN','4'=>'A.K.U');
					if($field == 'sbh_status'){
						$dt->$field = $st[$dt->$field];
					}
            		$conn = (isset($this->con[$i+1]) ? $this->con[$i+1] : array() ) ;
					$row[] = SiteHelpers::gridDisplay($dt->$field , $field , $conn );
            }
 
            
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
		
		$this->data['content'] = $this->load->view('tsbh/index',$this->data, true );
		
    	$this->load->view('layouts/main', $this->data );
    
	  
	}

	function add(){

		echo $this->load->view('tsbh/form',null, true );
	}
	
	function upload() 
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
		
		$this->data['content'] = $this->load->view('tsbh/indexupload',$this->data, true );
		
    	$this->load->view('layouts/main', $this->data );
    
	  
	}
	
	function pengolahan() 
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
		
		$this->data['content'] = $this->load->view('tsbh/indexpengolahan',$this->data, true );
		
    	$this->load->view('layouts/main', $this->data );
    
	  
	}
	
	function tanaman() 
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
		
		$this->data['content'] = $this->load->view('tsbh/indextanaman',$this->data, true );
		
    	$this->load->view('layouts/main', $this->data );
    
	  
	}
	
	function aku() 
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
		
		$this->data['content'] = $this->load->view('tsbh/indexaku',$this->data, true );
		
    	$this->load->view('layouts/main', $this->data );
    
	  
	}

	function downloaded($jns,$tgl1,$tgl2){
		$sort = $this->model->primaryKey; 
		$order = 'asc';

		$filter = " AND  tgl_giling BETWEEN '$tgl1' AND '$tgl2'";
		if($jns == 2){
			$filter .= " AND sbh_status < 2";	
		}
		if($jns == 3){
			$filter .= " AND sbh_status = 1";
		} 
		$params = array(
			'limit'		=> 0,
			'page'		=> 0,
			'sort'		=> $sort ,
			'order'		=> $order,
			'params'	=> $filter,
			'global'	=> (isset($this->access['is_global']) ? $this->access['is_global'] : 0 )
		);
		// Get Query 
		$results = $this->model->getRowspdx( $params );
		$this->data['rows'] = $results['rows'];
		//$total = $results['total'];
		//$totalfil = $results['totalfil'];
		$this->data['tableGrid'] 	= $this->info['config']['grid'];
		//var_dump($this->data['tableGrid']);die();
		if($jns == 1){
		$this->data['title'] = 'PERIODE '.SiteHelpers::daterpt($tgl1).' S/D '.SiteHelpers::daterpt($tgl2);
		$file = "SBH-".$this->data['title'].".xls";
			header("Content-type: application/vnd.ms-excel");
			header("Content-Disposition: attachment; filename=$file");
		echo $this->load->view('tsbh/downloadreport',$this->data, true );
		}

		if($jns == 2){
		$this->data['title'] = 'TEMPLATE PERIODE '.SiteHelpers::daterpt($tgl1).' S/D '.SiteHelpers::daterpt($tgl2);
		$file = "SBH-".$this->data['title'].".xls";
			header("Content-type: application/vnd.ms-excel");
			header("Content-Disposition: attachment; filename=$file");
		echo $this->load->view('tsbh/downloadtemplate',$this->data, true );
		}

		if($jns == 3){
		$this->data['title'] = 'PERIODE '.SiteHelpers::daterpt($tgl1).' S/D '.SiteHelpers::daterpt($tgl2);
		echo $this->load->view('tsbh/cetakapprovesbh',$this->data, true );
		}

		//var_dump($rows);
	}


	function uploadsend(){
		 //var_dump($_FILES);die();
		ini_set('memory_limit', '4048M');
		// include APPPATH."/third_party/PHPExcel/IOFactory.php";

		//include (APPPATH.'/third_party/php-excel-reader/excel_reader2.php');
		include (APPPATH.'/third_party/SpreadsheetReader.php');
		$file = 'TEMP_SBH.xlsx';

		if(move_uploaded_file($_FILES['template_sbh']['tmp_name'], $file)){
		chmod($file, 0777);
try
	{
		$files = $file;
		$Spreadsheet = new SpreadsheetReader($files);

		$Sheets = $Spreadsheet -> Sheets();
		$BaseMem = memory_get_usage();
		$Spreadsheet -> ChangeSheet(0);
		$totdata = 0;
		if($Sheets[0] == 'SBH-TEMPLATE'){
			//var_dump($Spreadsheet);
			foreach ($Spreadsheet as $Key => $Row)
			{
				if($Key > 2){
						$tempdataari = array(
					'id_ari'	 	=> trim($Row[1]), 
					'id_spta' 		=> trim($Row[0]), 
					'persen_brix_ari' 		=> trim($Row[34]), 
					'persen_pol_ari' 		=> trim($Row[35]), 
					'ph_ari' 		=> trim($Row[36]), 
					'hk' 			=> trim($Row[37]), 
					'nilai_nira' 	=> trim($Row[38]), 
					'faktor_rendemen' 		=> trim($Row[39]), 
					'rendemen_ari' 	=> trim($Row[40]), 
					'hablur_ari' 	=> trim($Row[41]), 
					'gula_total' 	=> trim($Row[42]), 
					'tetes_total' 	=> trim($Row[43]), 
					'rendemen_ptr' 	=> trim($Row[44]), 
					'gula_ptr' 		=> trim($Row[45]), 
					'tetes_ptr' 	=> trim($Row[46]), 
					'gula_pg' 		=> trim($Row[47]), 
					'tetes_pg' 		=> trim($Row[48]),
					'sbh_ari_status'				=> '1',
					'sbh_ari_user'				=> $this->session->userdata('fid'),
					'sbh_ari_tgl'				=> date('Y-m-d H:i:s')
				);

			$tempspta = array(
					'sbh_status' => '1',
					'sbh_tgl'	=> date('Y-m-d H:i:s')
				);

			$this->db->where('id_ari', trim($Row[1]));
			$this->db->where('id_spta', trim($Row[0]));
			$this->db->where('pengolahan_status', '0');
			$this->db->update('t_ari', $tempdataari);


			$this->db->where('id', trim($Row[0]));
			$this->db->where('sbh_status < ', 2);
			$this->db->update('t_spta', $tempspta);
			$totdata++;
					}
				}

				echo ($totdata)." Data SBH Berhasil Diupload Silahkan cek di Table Sebelum di approve !!";
			
		}else{
			echo "Nama Sheet Template File Excel Salah..";
		}
		}
	catch (Exception $E)
	{
		echo $E -> getMessage();
	}
}


		/*

		 $cacheMethod = PHPExcel_CachedObjectStorageFactory::cache_to_phpTemp;
		 	$cacheSettings = array( 'memoryCacheSize' => '8MB');
			PHPExcel_Settings::setCacheStorageMethod($cacheMethod, $cacheSettings); 

		$target = basename($_FILES['template_sbh']['name']) ;
    
		if(move_uploaded_file($_FILES['template_sbh']['tmp_name'], $target)){
			chmod($target,0777);

		

		try {
		$objPHPExcel = PHPExcel_IOFactory::load($target);
		} catch(ErrorException $e) {
			die('Error loading file "'.pathinfo($inputFileName,PATHINFO_BASENAME).'": '.$e->getMessage());
			exit();
		}

	$allDataInSheet = $objPHPExcel->getActiveSheet()->toArray(null,true,true,true);
		$arrayCount = count($allDataInSheet);  // Here get total count of row in that Excel sheet
		$totupload  = 0;
		$totdecline = 0;
		//var_dump(trim($allDataInSheet[3]["A"]));
		if($allDataInSheet[3]["A"] == 'ID SPTA' &&  $allDataInSheet[3]["B"] == 'ID ARI'){
		for($i=4;$i<=$arrayCount;$i++){
			$tempdataari = array(
					'id_ari'	 	=> trim($allDataInSheet[$i]["B"]), 
					'id_spta' 		=> trim($allDataInSheet[$i]["A"]), 
					'persen_brix_ari' 		=> trim($allDataInSheet[$i]["AI"]), 
					'persen_pol_ari' 		=> trim($allDataInSheet[$i]["AJ"]), 
					'ph_ari' 		=> trim($allDataInSheet[$i]["AK"]), 
					'hk' 			=> trim($allDataInSheet[$i]["AL"]), 
					'nilai_nira' 	=> trim($allDataInSheet[$i]["AM"]), 
					'faktor_rendemen' 		=> trim($allDataInSheet[$i]["AN"]), 
					'rendemen_ari' 	=> trim($allDataInSheet[$i]["AO"]), 
					'hablur_ari' 	=> trim($allDataInSheet[$i]["AP"]), 
					'gula_total' 	=> trim($allDataInSheet[$i]["AQ"]), 
					'tetes_total' 	=> trim($allDataInSheet[$i]["AR"]), 
					'rendemen_ptr' 	=> trim($allDataInSheet[$i]["AS"]), 
					'gula_ptr' 		=> trim($allDataInSheet[$i]["AT"]), 
					'tetes_ptr' 	=> trim($allDataInSheet[$i]["AU"]), 
					'gula_pg' 		=> trim($allDataInSheet[$i]["AV"]), 
					'tetes_pg' 		=> trim($allDataInSheet[$i]["AW"]),
					'sbh_ari_status'				=> '1',
					'sbh_ari_user'				=> $this->session->userdata('fid'),
					'sbh_ari_tgl'				=> date('Y-m-d H:i:s')
				);

			$tempspta = array(
					'sbh_status' => '1',
					'sbh_tgl'	=> date('Y-m-d H:i:s')
				);

			$this->db->where('id_ari', trim($allDataInSheet[$i]["B"]));
			$this->db->where('id_spta', trim($allDataInSheet[$i]["A"]));
			$this->db->where('pengolahan_status', '0');
			$this->db->update('t_ari', $tempdataari);


			$this->db->where('id', trim($allDataInSheet[$i]["A"]));
			$this->db->where('sbh_status < ', 2);
			$this->db->update('t_spta', $tempspta);

			//var_dump($tempdataari);
		}
		echo ($i-4)." Data SBH Berhasil Diupload Silahkan cek di Table Sebelum di approve !!";
	}else{
		echo "Format tempate salah !! Silahakan Download template SBH dari SIMPG !!";
	}
	}*/
}
	
	

	function approved(){
		$stt = $_POST['stt'];
		$tgl1 = $_POST['tgl1'];
		$tgl2 = $_POST['tgl2'];
		if($stt == 1){
			//pengolahan
			$sql = "UPDATE t_ari a 
INNER JOIN t_spta b ON a.`id_spta`=b.`id`
SET a.`pengolahan_status`=1,a.`pengolahan_tgl`=NOW(),b.`sbh_status`=2,b.`sbh_tgl`=NOW(),a.`pengolahan_user`='".$this->session->userdata('fid')."'
WHERE b.`tgl_giling` BETWEEN '".$tgl1."' AND '".$tgl2."' AND b.`sbh_status`=1";
		}

		if($stt == 2){
			//tanaman
			$sql = "UPDATE t_ari a 
INNER JOIN t_spta b ON a.`id_spta`=b.`id`
SET a.`tanaman_status`=1,a.`tanaman_tgl`=NOW(),b.`sbh_status`=3,b.`sbh_tgl`=NOW(),a.`tanaman_user`='".$this->session->userdata('fid')."'
WHERE b.`tgl_giling` BETWEEN '".$tgl1."' AND '".$tgl2."' AND b.`sbh_status`=2";
		}

		if($stt == 3){
			//aku
			$sql = "UPDATE t_ari a 
INNER JOIN t_spta b ON a.`id_spta`=b.`id`
SET a.`aku_status`=1,a.`aku_tgl`=NOW(),b.`sbh_status`=4,b.`sbh_tgl`=NOW(),a.`aku_user`='".$this->session->userdata('fid')."'
WHERE b.`tgl_giling` BETWEEN '".$tgl1."' AND '".$tgl2."' AND b.`sbh_status`=3";
		}

		$this->db->query($sql);
		$afftectedRows = $this->db->affected_rows();
		echo ($afftectedRows/2).' Berhasil di Approve !!';
	}


}
