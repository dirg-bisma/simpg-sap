<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Lapproduksi extends SB_Controller
{

	protected $layout 	= "layouts/main";
	public $module 		= 'lapproduksi';
	public $per_page	= '10';
	public $idx			= '';

	function __construct() {
		parent::__construct();

		$this->load->model('lapproduksimodel');
		$this->model = $this->lapproduksimodel;
		$idx = $this->model->primaryKey;

		$this->info = $this->model->makeInfo( $this->module);
		$this->access = $this->model->validAccess($this->info['id']);
		$this->data = array_merge( $this->data, array(
			'pageTitle'	=> 	$this->info['title'],
			'pageNote'	=>  $this->info['note'],
			'pageModule'	=> 'lapproduksi',
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

	function grids(){

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
            		$filter .= " AND ".$this->col[$i+1]." LIKE '%".$_POST['search']['value']."%'";
            	}else{
            		$filter .= " OR ".$this->col[$i+1]." LIKE '%".$_POST['search']['value']."%'";
            	}
            }
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
		$results = $this->model->getRows( $params );
		$rows = $results['rows'];
		$total = $results['total'];
		$totalfil = $results['totalfil'];

		//run data to view
		$data = array();$no=0;
		foreach ($rows as $dt) {
            $row = array();
            $row[] = $no+1;
            for ($i=0; $i < count($this->col) ; $i++) {
            		$field = $this->col[$i+1];
            		$conn = (isset($this->con[$i+1]) ? $this->con[$i+1] : array() ) ;
					$row[] = SiteHelpers::gridDisplay($dt->$field , $field , $conn );
            }

            //add html for action
            $btn ='';
			$idku = $this->model->primaryKey;
            if($this->access['is_detail'] ==1){
            	$btn .= '<a href='.site_url('lapproduksi/show/'.$dt->$idku).'  class="tips "  title="view"><i class="fa  fa-search"></i>  </a> &nbsp;&nbsp;';
            }
            if($this->access['is_edit'] ==1){
            	$btn .= '<a href='.site_url('lapproduksi/add/'.$dt->$idku).'  class="tips "  title="Edit"><i class="fa  fa-edit"></i>  </a> &nbsp;&nbsp;';
            }
            if($this->access['is_remove'] ==1){
            	$btn .= '<a href="#" onclick="ConfirmDelete(\''.site_url('lapproduksi/destroy/').'\','.$dt->$idku.')"  class="tips "  title="Delete"><i class="fa  fa-trash"></i>  </a>';

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
        $hari_giling = $this->db->query("SELECT get_hari_giling() AS hari_giling");

        $this->data['hari_giling'] = $hari_giling->row();
		$this->data['content'] = $this->load->view('lapproduksi/index',$this->data, true );

    	$this->load->view('layouts/main', $this->data );


	}

	function show( $id = null)
	{
		if($this->access['is_detail'] ==0)
		{
			$this->session->set_flashdata('error',SiteHelpers::alert('error','Your are not allowed to access the page'));
			redirect('dashboard',301);
	  	}

        $this->data['tableGrid'] 	= $this->info['config']['grid'];

        // Group users permission
        $this->data['access']		= $this->access;
        // Render into template
        $this->data['access']		= $this->access;
        $this->data['kode_kat_ts'] = $this->model->getKodeKat("TS");
        $this->data['kode_kat_tr'] = $this->model->getKodeKat("TR");
        $this->data['kode_kat_by_spat'] = $this->model->getKodeKatBySpat("ksat_spat");
        // Render into template
        if($this->input->post('hari_giling') == "")
        {
            $this->session->set_flashdata('error',SiteHelpers::alert('error','Hari giling tidak ada'));
            redirect('lapproduksi',301);
        }
        $tgl_giling = $this->input->post('hari_giling');
        $this->data['hari_giling'] = $tgl_giling;


        $qry_tgl_giling = $this->db->query("SELECT (get_tgl_giling() - INTERVAL (get_hari_giling() - 18) DAY) AS tgl_giling");
        $this->data['tgl_giling'] = $qry_tgl_giling->row();

        $this->data['content'] = $this->load->view('lapproduksi/tabel',$this->data, true );

        $this->load->view('layouts/main', $this->data );
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
		} else {
			$this->data['row'] = $this->model->getColumnTable('t_lap_produksi_pengolahan');
		}

		$this->data['id'] = $id;
		$this->data['content'] = $this->load->view('lapproduksi/form',$this->data, true );
	  	$this->load->view('layouts/main', $this->data );

	}

	function save() {
        $kode_kat_all = $this->model->getKodeKatAll();
        foreach ($kode_kat_all as $kode_kat){
            if(isset($_POST['rendemen_'.$this->replaceKat($kode_kat->kode_kat_ptp)])){

                $cek = $this->model->CekLaporanExist($kode_kat->kode_kat_ptp, $this->input->post('hari_giling'));
                $data = array(
                    'tgl_laporan_produksi' => $this->input->post('tgl_laporan_produksi'),
                    'hari_giling' => $this->input->post('hari_giling'),
                    'kode_kat_lahan' => $this->input->post('kode_kat_lahan_'.$this->replaceKat($kode_kat->kode_kat_ptp)),
                    'kat_ptpn' => $this->input->post('kat_ptpn_'.$this->replaceKat($kode_kat->kode_kat_ptp)),
                    'kat_kepemilikan' => $this->input->post('kat_kepemilikan_'.$this->replaceKat($kode_kat->kode_kat_ptp)),
                    'ha_tertebang' => $this->input->post('ha_tertebang_'.$this->replaceKat($kode_kat->kode_kat_ptp)),
                    'qty_tertebang' => $this->input->post('qty_tertebang_'.$this->replaceKat($kode_kat->kode_kat_ptp)),
                    'ha_digiling' => $this->input->post('ha_digiling_'.$this->replaceKat($kode_kat->kode_kat_ptp)),
                    'qty_digiling' => $this->input->post('qty_digiling_'.$this->replaceKat($kode_kat->kode_kat_ptp)),
                    'qty_kristal' => $this->input->post('qty_kristal_'.$this->replaceKat($kode_kat->kode_kat_ptp)),
                    'rendemen' => $this->input->post('rendemen_'.$this->replaceKat($kode_kat->kode_kat_ptp)),
                    'qty_gula_ptr' => $this->input->post('qty_gula_ptr_'.$this->replaceKat($kode_kat->kode_kat_ptp)),
                    'qty_tetes_ptr' => $this->input->post('qty_tetes_ptr_'.$this->replaceKat($kode_kat->kode_kat_ptp)),
                );
                if($kode_kat->kode_kat_ptp == "TS-TR" || $kode_kat->kode_kat_ptp == "TR-TK" || $kode_kat->kode_kat_ptp == "TR-TM" || $kode_kat->kode_kat_ptp == "TR-TR"){
                    $result_plant = $this->model->PlantKategoriByTimbanganTransfer($kode_kat->kode_kat_ptp, $this->input->post('hari_giling'));
                    foreach($result_plant as $row_plant){
                        $data_trans = array(
                            'tgl_laporan_produksi_trans' => $this->input->post('tgl_laporan_produksi'),
                            'hari_giling' => $this->input->post('hari_giling'),
                            'kode_kat_lahan' => $this->input->post('trans_kode_kat_lahan_'.$this->replaceKat($kode_kat->kode_kat_ptp)."_".$row_plant->kode_plant_trasnfer),
                            'kat_ptpn' => $this->input->post('trans_kat_ptpn_'.$this->replaceKat($kode_kat->kode_kat_ptp)."_".$row_plant->kode_plant_trasnfer),
                            'kat_kepemilikan' => $this->input->post('trans_kat_kepemilikan_'.$this->replaceKat($kode_kat->kode_kat_ptp)."_".$row_plant->kode_plant_trasnfer),
                            'plant' => $row_plant->kode_plant_trasnfer,
                            'ha_tertebang' => $this->input->post('trans_ha_tertebang_'.$this->replaceKat($kode_kat->kode_kat_ptp)."_".$row_plant->kode_plant_trasnfer),
                            'qty_tertebang' => $this->input->post('trans_qty_tertebang_'.$this->replaceKat($kode_kat->kode_kat_ptp)."_".$row_plant->kode_plant_trasnfer),
                            'ha_digiling' => $this->input->post('trans_ha_digiling_'.$this->replaceKat($kode_kat->kode_kat_ptp)."_".$row_plant->kode_plant_trasnfer),
                            'qty_digiling' => $this->input->post('trans_qty_digiling_'.$this->replaceKat($kode_kat->kode_kat_ptp)."_".$row_plant->kode_plant_trasnfer),
                            'qty_kristal' => $this->input->post('trans_qty_kristal_'.$this->replaceKat($kode_kat->kode_kat_ptp)."_".$row_plant->kode_plant_trasnfer),
                            'rendemen' => $this->input->post('trans_rendemen_'.$this->replaceKat($kode_kat->kode_kat_ptp)."_".$row_plant->kode_plant_trasnfer),
                            'qty_gula_ptr' => $this->input->post('trans_qty_gula_ptr_'.$this->replaceKat($kode_kat->kode_kat_ptp)."_".$row_plant->kode_plant_trasnfer),
                            'qty_tetes_ptr' => $this->input->post('trans_qty_tetes_ptr_'.$this->replaceKat($kode_kat->kode_kat_ptp)."_".$row_plant->kode_plant_trasnfer),
                        );

                        $this->load->model('Laptransproduksimodel');
                        $cek_trans = $this->Laptransproduksimodel->CekLaporanExist($kode_kat->kode_kat_ptp, $row_plant->kode_plant_trasnfer, $this->input->post('hari_giling'));
                        if($cek_trans == 0){
                            $this->Laptransproduksimodel->Insert($data_trans);
                        }else{
                            $this->Laptransproduksimodel->Update($this->replaceKat($kode_kat->kode_kat_ptp), $row_plant->kode_plant_trasnfer, $this->input->post('hari_giling'), $data_trans);
                        }
                    }
                }

                if($cek == 0){
                    $this->model->Insert($data);

                }else{
                    $this->model->Update($this->replaceKat($kode_kat->kode_kat_ptp), $this->input->post('hari_giling'), $data);
                }
            }

        }
        $this->session->set_flashdata('message',SiteHelpers::alert('success','Data Berhasil di Simpan'));
        redirect('lapproduksi',301);
	}

    private function replaceKat($kat){
        $result = str_replace(" ", "_", $kat);
        $output = str_replace("-", "_", $result);
        return $output;
    }

	function destroy()
	{
		if($this->access['is_remove'] ==0)
		{
			echo "err : maaf anda tidak memiliki hak untuk menghapus data";
	  	}

		$this->model->destroy($_POST['id']);
		$this->inputLogs("ID : ".$_POST['id']."  , Has Been Removed Successfull");
		echo "ID : ".$_POST['id']."  , berhasil dihapus !!";

	}


}
