<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Telgil extends SB_Controller 
{

	protected $layout 	= "layouts/main";
	public $module 		= 'telgil';
	public $per_page	= '10';
	public $idx			= '';
	private $namapg     = CNF_PLANCODE;

	function __construct() {
		parent::__construct();
		
		$this->load->model('telgilmodel');
		$this->load->model('crud_model');
		$this->load->library('Grocery_CRUD');
		$this->model = $this->telgilmodel;
		$idx = $this->model->primaryKey;
				error_reporting(0);	
		// $this->info = $this->model->makeInfo( $this->module);
		// $this->access = $this->model->validAccess($this->info['id']);	
		// $this->data = array_merge( $this->data, array(
		// 	'pageTitle'	=> 	$this->info['title'],
		// 	'pageNote'	=>  $this->info['note'],
		// 	'pageModule'	=> 'telgil',
		// ));
		// $this->col = array();
		// $this->con = array();
		// $inf = $this->info['config']['grid'];
		// $inf = SiteHelpers::array_sort($inf, 'sortlist', SORT_ASC);
		// $in=0;
		// foreach ($inf as $key => $t) {
		// 	if($t['view'] =='1'){
				
		// 		$in++;
		// 		$this->col[$in] = $t['field'];
		// 		$this->con[$in] = $t['conn'];
				
		// 	}
			
		// }
		
		if(!$this->session->userdata('logged_in')) redirect('user/login',301);
	}


	// function index() 
	// {
	// 	if($this->access['is_view'] ==0)
	// 	{ 
	// 		$this->session->set_flashdata('error',SiteHelpers::alert('error','Your are not allowed to access the page'));
	// 		redirect('dashboard',301);
	// 	}	
		
	// 	$this->data['tableGrid'] 	= $this->info['config']['grid'];

	// 	// Group users permission
	// 	$this->data['access']		= $this->access;
	// 	// Render into template
		
	// 	$this->data['content'] = $this->load->view('telgil/index',$this->data, true );
		
 //    	$this->load->view('layouts/main', $this->data );
    
	  
	// }
	

	public function _example_output($output = null)
	{
		$this->load->view('layouts/main', $output );		
	}

	public function index()
	{
		$crud = new grocery_CRUD();
      //  $crud->set_theme('bootstrap');
		$crud->unset_jquery_ui();
		$crud->unset_jquery();
		$crud->unset_bootstrap();

        $crud->set_primary_key('id','vw_telgil_status');
		$crud->set_table('vw_telgil_status');
		$crud->set_subject('Telgil');
		$crud->columns('AKSI','KATEGORI','PERIODE','UNIT','STATUS');
		$crud->unset_add();
		$crud->unset_edit();
		$crud->unset_read();
		$crud->unset_export();
		$crud->unset_delete();
		$crud->unset_print();
		$crud->where('UNIT',$this->namapg);
		$crud->order_by('PERIODE','DESC');
		$crud->callback_column('STATUS',array($this,'callback_status'));
		$crud->callback_column('AKSI',array($this,'callback_aksi'));
		$out['output'] =  $crud->render();
		$out['title'] = "Download Template";
		$out['style'] = "<style>
						</style>
						</script>";
		$out['script'] = '<p id="demo"></p>';
		$this->data['content'] = $this->load->view('telgil/index',$out, true);				
		$this->_example_output($this->data);	
	}

	


	public function template(){
		$crud = new grocery_CRUD();

		$crud->unset_jquery_ui();
		$crud->unset_jquery();
		$crud->unset_bootstrap();
      //  $crud->set_theme('bootstrap');
      	$crud->set_primary_key('id', 'vw_template');
		$crud->set_table('vw_template');
		$crud->set_subject('Template Excel');
		$crud->unset_add();
		$crud->unset_edit();
		$crud->unset_delete();
		$crud->unset_read();
		$crud->unset_export();
		$crud->unset_print();
		$crud->callback_column('download',array($this,'callback_download'));

		$data['output'] =  $crud->render();
		$data['title'] = "Download Template";
		$data['style'] = "<style>
						</style>
						</script>";
		$data['script'] = '<p id="demo"></p>';				
		$this->data['content'] = $this->load->view('telgil/index',$data, true);				
		$this->_example_output($this->data);
	}

	public function callback_status($value, $row)
	{
		return "<span style='color:green;font-weight: bold;'>UPLOADED</span>";
	}

	public function callback_aksi($value, $row)
	{
		return "<a href='#' onclick='myFunction()' class='btn btn-danger'><i class='fa fa-trash'></i></a>
				<script>
				function myFunction() {
				    if (confirm('Hapus Data!')) {
					    delete_telgil();
				    } else {
				    }
				}
				function delete_telgil()
				{
					$.ajax({
                        url : '".site_url('telgil/remove_telgil')."/".$row->KATEGORI."/".$row->ID."',
                        type: 'GET',
                        dataType: 'html',
                        success: function(data)
                        {
							alert(data);
							location.reload();	
                        },
                        error: function (jqXHR, textStatus, errorThrown)
                        {
                            alert(textStatus);
                        }
                        });
				}
				</script>";
	}

	public function remove_telgil($kat, $id)
	{
		if ($kat == "Evaluasi") {
			$this->crud_model->delete("telgil_evaluasi",array("ID"=>$id));
		}else{
			$this->crud_model->delete("telgil_produksi",array("ID"=>$id));
			$this->crud_model->delete("telgil_fabrikasi",array("ID"=>$id));
			$this->crud_model->delete("telgil_rincian_gula",array("ID"=>$id));
		}
		echo "Hapus Sukses!";
	}

	public function callback_download($value, $row)
	{
		if ($row->id == 1) {
			$file = "telgil.xlsx";
		}else{
			$file = "evaluasi.xlsx";
		}
    	$this->load->library("excel");
		$inputFileName = './assets/uploads/files/'.$file;
		chmod('./assets/uploads/files/', 0777);
		$select = $this->db->query('select awal_giling from tb_setting')->result(); 
		//  Read your Excel workbook
		try {
		    $inputFileType = PHPExcel_IOFactory::identify($inputFileName);
		    $objReader = PHPExcel_IOFactory::createReader($inputFileType);
		    $objPHPExcel = $objReader->load($inputFileName);

	   		$sheet = $objPHPExcel->getSheet(0);
	   		if ($row->id == 1) {
	   			$sheet->getCell('B2')->setValue('LAPORAN TELEGRAM GILING TAHUN '.date('Y'));
				$sheet->getCell('C4')->setValue($this->namapg);	
				$sheet->getCell('D6')->setValue($select[0]->awal_giling);	
	   		}else{
	   			$sheet->getCell('C4')->setValue('LAPORAN EVALUASI GILING TAHUN '.date('Y'));
				$sheet->getCell('D6')->setValue($this->namapg);	
	   		}
				
	 		$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel,  'Excel2007');
			$objWriter->save($inputFileName);
		} catch(Exception $e) {
		    die('Error loading file "'.pathinfo($inputFileName,PATHINFO_BASENAME).'": '.$e->getMessage());
		}

		return "<a href='".base_url('assets/uploads/files/'.$file)."'>Download</a>";
	}

	public function report_telgil()
	{
		$crud = new grocery_CRUD();
		$state = $crud->getState();	
		$crud->unset_jquery_ui();
		$crud->unset_jquery();
		$crud->unset_bootstrap();
        $crud->set_theme('flexigrid');
		$crud->set_table('export_template');
		$crud->callback_field('PERIODE',array($this,'field_callback_periode'));
		$crud->field_type('KATEGORI','dropdown', array('1'=>'Produksi','2'=>'Evaluasi'));
		$data['output'] =  $crud->render();
		$data['title'] = "Laporan Produksi";
		$data['style'] = "<style>
							// #save-and-go-back-button{
						 //        display: none;
						 //      }
								#cancel-button{
							        display: block;
							      }
						</style>
						<script>
							$('#form-button-save').prop('type', 'button');
							$('#form-button-save').attr('id','show');
							$('#form-button-save').val('Show');

							$('#cancel-button').prop('type', 'button');
							$('#cancel-button').attr('id','print');
							$('#print').val('Cetak');

							$('#save-and-go-back-button').prop('type', 'button');
							$('#save-and-go-back-button').val('Excel');
							$('#save-and-go-back-button').attr('id','excel');

							$('#show').attr('class','btn btn-primary');
							$('#excel').attr('class','btn btn-success');
							$('#print').attr('class','btn btn-default');
							$('#show').val('Show');
							$('#show').click(myFunction2);
							$('#excel').click(myFunctionexcel);
							$('#print').click(printContent);
							function myFunction2() {
								var kategori = $('#field-KATEGORI').val();
								var periode = $('#field-PERIODE').val();
								var kat = '';
								if (kategori == 1) {
									kat = 'get_report_produksi';
								}else{
									kat = 'get_report_evaluasi';
								}
								$('#show').attr('disabled',true);
									$.ajax({
		                                url : '".site_url("telgil/")."/'+kat+'?periode='+periode+'&excel=0&kat='+kategori,
		                                type: 'GET',
		                                dataType: 'html',
		                                success: function(data)
		                                {
		                                	$('#show').attr('disabled',false);
		                                	$('#konten').html(data);	
		                                },
		                                error: function (jqXHR, textStatus, errorThrown)
		                                {
		                                	$('#show').attr('disabled',false);
		                                    alert(textStatus);
		                                }
		                                });
							}

							function myFunctionexcel() {
								var kategori = $('#field-KATEGORI').val();
								var periode = $('#field-PERIODE').val();
								var kat = '';
								if (kategori == 1) {
									kat = 'get_report_produksi';
								}else{
									kat = 'get_report_evaluasi';
								}
								$('#show').attr('disabled',true);
		                                var url = '".site_url("telgil/")."/'+kat+'?periode='+periode+'&excel=1&kat='+kategori;
		                                window.open(url);
							}
							 function printContent() {
 									var kategori = $('#field-KATEGORI').val();
									var periode = $('#field-PERIODE').val();
									var kat = '';
									if (kategori == 1) {
										kat = 'get_report_produksi';
									}else{
										kat = 'get_report_evaluasi';
									}
									$.ajax({
									url : '".site_url("telgil/")."/'+kat+'?periode='+periode+'&excel=0&kat='+kategori,
									type: 'GET',
									dataType: 'html',
									success: function(data)
									{
										$('#show').attr('disabled',false);
										$('#konten').html(data);
									   var printContents = document.getElementById('report').innerHTML;
							           var originalContents = document.body.innerHTML;

							           document.body.innerHTML = printContents;

							           window.print();
							           location.reload();	
									},
									error: function (jqXHR, textStatus, errorThrown)
									{
										$('#show').attr('disabled',false);
									    alert(textStatus);
									}
									});
					      }
						</script>";
		$data['script'] = '<p id="demo"></p>';				
		$this->data['content'] = $this->load->view('telgil/index',$data, true);				
		$this->_example_output($this->data);
	}

	function field_callback_periode($value = '', $primary_key = null)
	{
		return '<input type="date" id="field-PERIODE" value="" name="PERIODE" style="width:200px">';
	}

	public function get_report_produksi()
	{
		// $tgl1 = DateTime::createFromFormat('d/m/Y', $this->input->get('periode'));
		// $periode = $tgl1->format('Y-m-d');
		// $tgl1 = DateTime::createFromFormat('d/m/Y', $this->input->get('periode'));
		$periode = $this->input->get('periode');
		if($this->input->get('excel') == 1){
			$file = "Laporan Telgil Produksi - Periode ".date_format(date_create($periode, "d-m-Y")).".xls";
			header("Content-type: application/vnd.ms-excel");
			header("Content-Disposition: attachment; filename=$file");
		}
		$data['unit'] = $this->db->query('select namapg from masterpg where kode = "'.$this->namapg.'"')->result();
		$data['produksi'] = $this->db->query('select * from telgil_produksi where UNIT = "'.$this->namapg.'" AND PERIODE="'.$periode.'"')->result();
		$data['fabrikasi'] = $this->db->query('select * from telgil_fabrikasi where UNIT = "'.$this->namapg.'" AND PERIODE="'.$periode.'"')->result();
		$data['rincian_gula'] = $this->db->query('select * from telgil_rincian_gula where UNIT = "'.$this->namapg.'" AND PERIODE="'.$periode.'"')->result();
		$this->load->view('telgil/laporan_produksi', $data);	
	}

	public function get_report_evaluasi()
	{
		// $tgl1 = DateTime::createFromFormat('d/m/Y', $this->input->get('periode'));
		// $periode = $tgl1->format('Y-m-d');
		$periode = $this->input->get('periode');
		if($this->input->get('excel') == 1){
			$file = "Laporan Telgil Evaluasi - Periode ".date_format(date_create($periode, "d-m-Y")).".xls";
			header("Content-type: application/vnd.ms-excel");
			header("Content-Disposition: attachment; filename=$file");
		}
		$data['unit'] = $this->db->query('select namapg from masterpg where kode = "'.$this->namapg.'"')->result();
		$data['evaluasi'] = $this->db->query('select * from telgil_evaluasi where UNIT = "'.$this->namapg.'" AND PERIODE="'.$periode.'"')->result();
		$this->load->view('telgil/laporan_evaluasi', $data);	
	}

	public function import_produksi()
	{
		$this->config->grocery_crud_file_upload_allow_file_types         = 'xls|xlsx';
        $this->config->grocery_crud_file_upload_max_file_size             = '20MB';
		$crud = new grocery_CRUD();
		$state = $crud->getState();	

		$crud->unset_jquery_ui();
		$crud->unset_jquery();
		$crud->unset_bootstrap();

        $crud->set_theme('flexigrid');
		$crud->set_table('import_template');
		$crud->set_field_upload('file','assets/uploads/files');
		$crud->set_lang_string('insert_success_message',
						         'Your data has been successfully stored into the database.<br/>Please wait...
						         <script type="text/javascript">
						                window.setTimeout(function(){
								        window.location = "'.site_url('v1/'.strtolower(__CLASS__).'/'.strtolower(__FUNCTION__)).'/add";
								    }, 2000);
						         </script>
						         <div style="display:none">'
						   		);
		$crud->callback_field('unit',array($this,'field_callback_unit'));
		$data['output'] =  $crud->render();
		// $data['output'] =  "<p id='demo'></p><input name='file' type='file' id='fileinput'><button type='button'  onclick='myFunction()' id='proses'>Proses</button>";
		$data['title'] = "Import Excel";
		$data['style'] = "<style>
							#save-and-go-back-button{
						        display: block;
						      }
						    #cancel-button{
						      display:none;
						    }  
						</style>
						<script>
							$('#save-and-go-back-button').prop('type', 'button');
							$('#save-and-go-back-button').val('Show');
							$('#save-and-go-back-button').attr('id','cek');
							$('#form-button-save').prop('type', 'button');
							$('#form-button-save').attr('id','simpan');
							$('#form-button-save').val('Simpan');
							$('#simpan').attr('class','btn btn-primary');
							$('#cek').attr('class','btn btn-warning');
							$('#cek').click(myFunction2);
							function myFunction2() {
								$('#cek').attr('disabled',true);
									var x =$('input[name=file]').val();
								    // document.getElementById('demo').innerHTML = x;
								    // window.open('".site_url("telgil/")."/readexcel?file='+x+'&method=read', '_blank');
									$.ajax({
		                                url : '".site_url("telgil/")."/readexcel?file='+x+'&method=read',
		                                type: 'GET',
		                                dataType: 'html',
		                                success: function(data)
		                                {
		                                	$('#cek').attr('disabled',false);
		                                	$('#konten').html(data);	
		                                },
		                                error: function (jqXHR, textStatus, errorThrown)
		                                {
		                                	$('#cek').attr('disabled',false);
		                                    alert(textStatus);
		                                }
		                                });
							}
							$('#simpan').click(myFunction3);
							function myFunction3() {
								$('#simpan').attr('disabled',true);
									var x =$('input[name=file]').val();
								    // document.getElementById('demo').innerHTML = x;
								    // window.open('".site_url("telgil/")."/saveexcel?file='+x+'&method=read', '_blank');
					

									$.ajax({
		                                url : '".site_url("telgil/")."/saveexcel?file='+x+'&method=read',
		                                type: 'GET',
		                                dataType: 'text',
		                                success: function(data)
		                                {
		                                	$('#simpan').attr('disabled',false);
		                                	alert('SIMPAN SUKSES');	
		                                	location.reload();
		                                },
		                                error: function (jqXHR, textStatus, errorThrown)
		                                {
		                                	$('#simpan').attr('disabled',false);
		                                    alert('Error Simpan: Data yang akan disimpan terdapat periode yang sama');
		                                }
		                                });
							}
						</script>";
		$data['script'] = '<p id="demo"></p>';				
		$this->data['content'] = $this->load->view('telgil/index',$data, true);				
		$this->_example_output($this->data);				
	}

	public function import_evaluasi()
	{
		$this->config->grocery_crud_file_upload_allow_file_types         = 'xls|xlsx';
        $this->config->grocery_crud_file_upload_max_file_size             = '20MB';
		$crud = new grocery_CRUD();
		$state = $crud->getState();	
		$crud->unset_jquery_ui();
		$crud->unset_jquery();
		$crud->unset_bootstrap();
        $crud->set_theme('flexigrid');
		$crud->set_table('import_template');
		$crud->set_field_upload('file','assets/uploads/files');
		$crud->set_lang_string('insert_success_message',
						         'Your data has been successfully stored into the database.<br/>Please wait...
						         <script type="text/javascript">
						                window.setTimeout(function(){
								        window.location = "'.site_url('v1/'.strtolower(__CLASS__).'/'.strtolower(__FUNCTION__)).'/add";
								    }, 2000);
						         </script>
						         <div style="display:none">'
						   		);
		$crud->callback_field('unit',array($this,'field_callback_unit'));
		$data['output'] =  $crud->render();
		// $data['output'] =  "<p id='demo'></p><input name='file' type='file' id='fileinput'><button type='button'  onclick='myFunction()' id='proses'>Proses</button>";
		$data['title'] = "Import Excel";
		$data['style'] = "<style>
							#save-and-go-back-button{
						        display: block;
						      }
				      	  #cancel-button{
					        display: none;
					      }
						</style>
						<script>
							$('#save-and-go-back-button').prop('type', 'button');
							$('#save-and-go-back-button').val('Show');
							$('#save-and-go-back-button').attr('id','cek');
							$('#form-button-save').prop('type', 'button');
							$('#form-button-save').attr('id','simpan');
							$('#form-button-save').val('Simpan');
							$('#simpan').attr('class','btn btn-primary');
							$('#cek').attr('class','btn btn-warning');
							$('#cek').click(myFunction2);
							function myFunction2() {
								$('#cek').attr('disabled',true);
									var x =$('input[name=file]').val();
								    // document.getElementById('demo').innerHTML = x;
								    // window.open('".site_url("telgil/")."/readexcelevaluasi?file='+x+'&method=read', '_blank');
									$.ajax({
		                                url : '".site_url("telgil/")."/readexcel?file='+x+'&method=read',
		                                type: 'GET',
		                                dataType: 'html',
		                                success: function(data)
		                                {
		                                	$('#cek').attr('disabled',false);
		                                	$('#konten').html(data);	
		                                },
		                                error: function (jqXHR, textStatus, errorThrown)
		                                {
		                                	$('#cek').attr('disabled',false);
		                                    alert(textStatus);
		                                }
		                                });
							}
							$('#simpan').click(myFunction3);
							function myFunction3() {
								$('#simpan').attr('disabled',true);
									var x =$('input[name=file]').val();
								    // document.getElementById('demo').innerHTML = x;
								    // window.open('".site_url("telgil/")."/saveexcelevaluasi?file='+x+'&method=read', '_blank');
									$.ajax({
		                                url : '".site_url("telgil/")."/saveexcelevaluasi?file='+x+'&method=read',
		                                type: 'GET',
		                                dataType: 'text',
		                                success: function(data)
		                                {
		                                	$('#simpan').attr('disabled',false);
		                                	alert('SIMPAN SUKSES');	
		                                	location.reload();
		                                },
		                                error: function (jqXHR, textStatus, errorThrown)
		                                {
		                                	$('#simpan').attr('disabled',false);
		                                    alert(textStatus);
		                                }
		                                });
							}
						</script>";
		$data['script'] = '<p id="demo"></p>';
		$this->data['content'] = $this->load->view('telgil/index',$data, true);				
		$this->_example_output($this->data);	
	}

	function field_callback_unit($value = '', $primary_key = null)
	{
		return '<input type="text"  value="'.$this->namapg.'" name="unit" readonly="true" style="width:200px">';
	}
	public function downloadExcel()
    {  
        //load librarynya terlebih dahulu
        //jika digunakan terus menerus lebih baik load ini ditaruh di auto load
        $this->load->library("excel");
		        // Create new PHPExcel object
        $dok = $this->input->get('dok');
        $pab = $this->input->get('pab');
        $per = $this->input->get('per');

        $orderdate = explode('/', $per);
		$month = $orderdate[1];
		$day   = $orderdate[0];


		$year  = $orderdate[2];
		
		$date_per = $year.'-'.$month.'-'.$day;
		$v = "";
		if ($dok == 'ha_digiling' || $dok == 'ha_belum_digiling' || $dok == 'tebu_digiling' || $dok == 'hablur_digiling') {
        	$dataDok = 'ha_digiling';
        	if ($dok == 'ha_digiling') {
        		$v = "v1";
        	}else if ($dok == 'ha_belum_digiling') {
        		$v = "v2";
        	}else if ($dok == 'tebu_digiling') {
        		$v = "v3";
        	}else if ($dok == 'hablur_digiling') {
        		$v = "v4";
        	}
        	$u = "_v1";
        }else if ($dok == 'data_produksi') {
        	$dataDok = 'data_produksi_rev';
        	$u = "";
        	$sub = "_rev";
        }else if ($dok == 'rincian_gula') {
        	$dataDok = 'rincian_gula_rev';
        	$u = "";
        	$sub = "_rev";
        }
        $result = $this->crud_model->select('vw_'.$dataDok, 'COLUMN_NAME')->result();
        $data = $this->crud_model->select($dataDok, '*',array('TGL_LAP'.$u=>$date_per))->result();

		$objPHPExcel = new PHPExcel();
		// Set document properties
		$objPHPExcel->getProperties()->setCreator("Hendrik")
									 ->setLastModifiedBy("Hendrik")
									 ->setTitle("Telgil Document")
									 ->setSubject("Telgil Document")
									 ->setDescription("Telgil document for Office 2007 XLSX, generated using PHP classes.")
									 ->setKeywords("office 2007 openxml php")
									 ->setCategory("Telgil result file");
		// Add some data
			$i=0;
			$a=1;
			foreach ($result as $value) {
	            $objPHPExcel->setActiveSheetIndex(0)->setCellValue('A'.$a, $result[$i]->COLUMN_NAME);
	            $i++;
	            $a++;
			}

			$str = 'B';
			for ($j=0; $j <count($data) ; $j++) { 
				$c=0;
				$d=1;
				foreach ($result as $value) {
					if ($result[$c]->COLUMN_NAME == 'NAMAPG ' || $result[$c]->COLUMN_NAME == 'TGL LAP ' || $result[$c]->COLUMN_NAME == 'TGL MULAI GILING ' || $result[$c]->COLUMN_NAME == 'TGL AKHIR GILING ') {
						if ($c == 0 || $c == 1 || $c == 2 || $c == 3) {
							$h = 'v1';
						}
					}else{
						$h = $v;
					}
					
					$col = str_replace(' ', '_', $result[$c]->COLUMN_NAME).$h;
		            $objPHPExcel->setActiveSheetIndex(0)->setCellValue($str.$d, $data[$j]->$col);
					$c++;
		            $d++;
				}
				++$str;
			}
			foreach(range('A','ZZ') as $columnID) {
			    $objPHPExcel->getActiveSheet()->getColumnDimension($columnID)
			        ->setAutoSize(true);
			}

			$objPHPExcel->getDefaultStyle()
			    ->getBorders()
			    ->getTop()
			        ->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
			$objPHPExcel->getDefaultStyle()
			    ->getBorders()
			    ->getBottom()
			        ->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
			$objPHPExcel->getDefaultStyle()
			    ->getBorders()
			    ->getLeft()
			        ->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
			$objPHPExcel->getDefaultStyle()
			    ->getBorders()
			    ->getRight()
			        ->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
											

		// Rename worksheet
		$objPHPExcel->getActiveSheet()->setTitle('Simple');
		// Set active sheet index to the first sheet, so Excel opens this as the first sheet
		$objPHPExcel->setActiveSheetIndex(0);
		// Redirect output to a client’s web browser (Excel2007)
		header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
		header('Content-Disposition: attachment;filename="'.$dok.'-'.$per.'.xlsx"');
		header('Cache-Control: max-age=0');
		// If you're serving to IE 9, then the following may be needed
		header('Cache-Control: max-age=1');
		// If you're serving to IE over SSL, then the following may be needed
		header ('Expires: Mon, 26 Jul 1997 05:00:00 GMT'); // Date in the past
		header ('Last-Modified: '.gmdate('D, d M Y H:i:s').' GMT'); // always modified
		header ('Cache-Control: cache, must-revalidate'); // HTTP/1.1
		header ('Pragma: public'); // HTTP/1.0

		$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
		$objWriter->save('php://output');
		exit;

    }

    public function readExcel()
    {
   

    	$file = $this->input->get('file');
    	$method = $this->input->get('method');
    	// include 'PHPExcel/IOFactory.php';
    	$this->load->library("excel");

		$inputFileName = './assets/uploads/files/'.$file;

		//  Read your Excel workbook
		try {
		    $inputFileType = PHPExcel_IOFactory::identify($inputFileName);
		    $objReader = PHPExcel_IOFactory::createReader($inputFileType);
		    $objPHPExcel = $objReader->load($inputFileName);
		} catch(Exception $e) {
		    die('Error loading file "'.pathinfo($inputFileName,PATHINFO_BASENAME).'": '.$e->getMessage());
		}

		//  Get worksheet dimensions
		$sheet = $objPHPExcel->getSheet(0); 
		$highestRow = $sheet->getHighestRow(); 
		$highestColumn = $sheet->getHighestColumn();

		$arr_rowData = array();
		//  Loop through each row of the worksheet in turn
		for ($row = 1; $row <= $highestRow; $row++){ 
		    //  Read a row of data into an array
		    $rowData = $sheet->rangeToArray('A' . $row . ':' . $highestColumn . $row,
		                                    NULL,
		                                    TRUE,
		                                    FALSE);
		    array_push($arr_rowData, $rowData);
		    //  Insert row data array into your database of choice here
		}
		$data['read'] = $arr_rowData;

		if ($method == "read") {
			$this->load->view('telgil/readexcel', $data);	
		}else{
			$this->load->view('evaluasi', $data);		
		}
	
    }

    public function saveExcel()
    {
    	$file = $this->input->get('file');
    	$method = $this->input->get('method');
    	// include 'PHPExcel/IOFactory.php';
    	$this->load->library("excel");

		$inputFileName = './assets/uploads/files/'.$file;

		//  Read your Excel workbook
		try {
		    $inputFileType = PHPExcel_IOFactory::identify($inputFileName);
		    $objReader = PHPExcel_IOFactory::createReader($inputFileType);
		    $objPHPExcel = $objReader->load($inputFileName);
		} catch(Exception $e) {
		    die('Error loading file "'.pathinfo($inputFileName,PATHINFO_BASENAME).'": '.$e->getMessage());
		}

		$objPHPExcelGET = new PHPExcel();
		//  Get worksheet dimensions
		$sheet = $objPHPExcel->getSheet(0); 
		$highestRow = $sheet->getHighestRow(); 
		$highestColumn = $sheet->getHighestColumn();

		$arr_rowData = array();
		//  Loop through each row of the worksheet in turn
		for ($row = 10; $row <= 85; $row++){ 
			if ($row !=43) {
			    $rowData = $sheet->rangeToArray('E' . $row . ':E' . $row,  NULL, TRUE, FALSE);
			    array_push($arr_rowData, $rowData);
			}
		}
		for ($row = 10; $row <= 85; $row++){ 
		    if ($row !=43) {
		    $rowData = $sheet->rangeToArray('F' . $row . ':F' . $row,  NULL, TRUE, FALSE);
		    array_push($arr_rowData, $rowData);
		}
	}
		for ($row = 10; $row <= 85; $row++){ 
		    if ($row !=43) {
		    $rowData = $sheet->rangeToArray('G' . $row . ':G' . $row,  NULL, TRUE, FALSE);
		    array_push($arr_rowData, $rowData);
		}
	}
		for ($row = 10; $row <= 85; $row++){ 
		    if ($row !=43) {
		    $rowData = $sheet->rangeToArray('H' . $row . ':H' . $row,  NULL, TRUE, FALSE);
		    array_push($arr_rowData, $rowData);
		}
	}
		for ($row = 10; $row <= 85; $row++){ 
		    if ($row !=43) {
		    $rowData = $sheet->rangeToArray('I' . $row . ':I' . $row,  NULL, TRUE, FALSE);
		    array_push($arr_rowData, $rowData);
		}
	}
		for ($row = 10; $row <= 85; $row++){ 
		    if ($row !=43) {
		    $rowData = $sheet->rangeToArray('J' . $row . ':J' . $row,  NULL, TRUE, FALSE);
		    array_push($arr_rowData, $rowData);
		}
	}
		for ($row = 10; $row <= 85; $row++){ 
		    if ($row !=43) {
		    $rowData = $sheet->rangeToArray('K' . $row . ':K' . $row,  NULL, TRUE, FALSE);
		    array_push($arr_rowData, $rowData);
		}
	}

		$data['read'] = $arr_rowData;
		$arr_push_data = array();
		
		$lenghtRow = count($arr_rowData);
	      $lenghtHeader = count($arr_rowData[0][0]);
	      $row = ""; 
	      $table = $this->db->query("SELECT column_NAME FROM information_schema.COLUMNS WHERE table_name='telgil_produksi';")->result();
	          
	      $conversiAWALGILING  = PHPExcel_Style_NumberFormat::toFormattedString($sheet->getCell('D6')->getValue(),  'YYYY-MM-DD');    
	      $conversiAKHIRGILING  = PHPExcel_Style_NumberFormat::toFormattedString($sheet->getCell('G6')->getValue(),  'YYYY-MM-DD');    
	      $PERIODE  = PHPExcel_Style_NumberFormat::toFormattedString($sheet->getCell('C3')->getValue(),  'YYYY-MM-DD');
	      $AWAL_GILING  = $conversiAWALGILING;
	      $AKHIR_GILING  = $conversiAKHIRGILING;
	      $TETES  = $sheet->getCell('K6')->getValue();

	      // $ddata[$table[1]->column_NAME] = $PERIODE;
	      // $ddata[$table[2]->column_NAME] = $this->namapg;
	      // $ddata[$table[3]->column_NAME] = $AWAL_GILING;
	      // $ddata[$table[4]->column_NAME] = $AKHIR_GILING;
	      // $ddata[$table[5]->column_NAME] = $TETES;

	      // for ($j=1; $j < $lenghtRow; $j++) {
	      //           		$ddata[$table[$j+5]->column_NAME] = $arr_rowData[$j-1][0][0];
	      //           		array_push($arr_push_data, $ddata);
	      // }
	      $arr_produksi = array(
	      						"PERIODE" => $PERIODE, 
	      						"UNIT" => $this->namapg, 
	      						"MULAI_GILING" => $AWAL_GILING, 
	      						"AKHIR_GILING" => $AKHIR_GILING, 
	      						"TETES_PETANI" => $TETES, 
	      						
	      						"TSS_I_HG_HA_DIGIL" => $sheet->getCell('E10')->getValue(),
								"TSS_II_HG_HA_DIGIL" => $sheet->getCell('E11')->getValue(),
								"TSS_III_HG_HA_DIGIL" => $sheet->getCell('E12')->getValue(),
								"SUB_JUMLAHRATA_TSS_HG_HA_DIGIL" => $sheet->getCell('E13')->getValue(),
								"TST_I_HG_HA_DIGIL" => $sheet->getCell('E14')->getValue(),
								"TST_II_HG_HA_DIGIL" => $sheet->getCell('E15')->getValue(),
								"TST_III_HG_HA_DIGIL" => $sheet->getCell('E16')->getValue(),
								"SUB_JUMLAH_RATA_TST_HG_HA_DIGIL" => $sheet->getCell('E17')->getValue(),
								"SUB_JUMLAH_RATA_HG_HA_DIGIL" => $sheet->getCell('E18')->getValue(),
								"TSS_I_IP_HA_DIGIL" => $sheet->getCell('E19')->getValue(),
								"TSS_II_IP_HA_DIGIL" => $sheet->getCell('E20')->getValue(),
								"SUB_JUMLAH_RATA_TSS_IP_HA_DIGIL" => $sheet->getCell('E21')->getValue(),
								"TST_I_IP_HA_DIGIL" => $sheet->getCell('E22')->getValue(),
								"TST_II_IP_HA_DIGIL" => $sheet->getCell('E23')->getValue(),
								"SUB_JUMLAH_RATA_TST_IP_HA_DIGIL" => $sheet->getCell('E24')->getValue(),
								"TSS_I_KN_HA_DIGIL" => $sheet->getCell('E25')->getValue(),
								"TSS_II_KN_HA_DIGIL" => $sheet->getCell('E26')->getValue(),
								"SUB_JUMLAH_RATA_TSS_KN_HA_DIGIL" => $sheet->getCell('E27')->getValue(),
								"TST_I_KN_HA_DIGIL" => $sheet->getCell('E28')->getValue(),
								"TST_II_KN__HA_DIGIL" => $sheet->getCell('E29')->getValue(),
								"SUB_JUMLAH_RATA_TST_KN_HA_DIGIL" => $sheet->getCell('E30')->getValue(),
								"TSS_I_KS_HA_DIGIL" => $sheet->getCell('E31')->getValue(),
								"TSS_II_KS_HA_DIGIL" => $sheet->getCell('E32')->getValue(),
								"SUB_JUMLAH_RATA_TSS_KS_HA_DIGIL" => $sheet->getCell('E33')->getValue(),
								"TST_I_KS_HA_DIGIL" => $sheet->getCell('E34')->getValue(),
								"TST_II_KS_HA_DIGIL" => $sheet->getCell('E35')->getValue(),
								"SUB_JUMLAH_RATA_TST_KS_HA_DIGIL" => $sheet->getCell('E36')->getValue(),
								"TS_SP_HA_DIGIL" => $sheet->getCell('E37')->getValue(),
								"TS_ST_HA_DIGIL" => $sheet->getCell('E38')->getValue(),
								"SUB_JUMLAH_RATA_SPT_HA_DIGIL" => $sheet->getCell('E39')->getValue(),
								"TS_TR_HA_DIGIL" => $sheet->getCell('E40')->getValue(),
								"TS_BB_HA_DIGIL" => $sheet->getCell('E41')->getValue(),
								"JUMLAHRATA_TS_HA_DIGIL" => $sheet->getCell('E42')->getValue(),
								"TRS_I_KD_HA_DIGIL" => $sheet->getCell('E44')->getValue(),
								"TRS_II_KD_HA_DIGIL" => $sheet->getCell('E45')->getValue(),
								"SUB_JUMLAH_RATA_TRS_KD_HA_DIGIL" => $sheet->getCell('E46')->getValue(),
								"TRT_I_KD_HA_DIGIL" => $sheet->getCell('E47')->getValue(),
								"TRT_II_KD_HA_DIGIL" => $sheet->getCell('E48')->getValue(),
								"SUB_JUMLAH_RATA_TRT_KD_HA_DIGIL" => $sheet->getCell('E49')->getValue(),
								"TRS_I_KL_HA_DIGIL" => $sheet->getCell('E50')->getValue(),
								"TRS_II_KL_HA_DIGIL" => $sheet->getCell('E51')->getValue(),
								"SUB_JUMLAH_RATA_TRS_KL_HA_DIGIL" => $sheet->getCell('E52')->getValue(),
								"TRT_I_KL_HA_DIGIL" => $sheet->getCell('E53')->getValue(),
								"TRT_II_KL_HA_DIGIL" => $sheet->getCell('E54')->getValue(),
								"SUB_JUMLAH_RATA_TRT_KL_HA_DIGIL" => $sheet->getCell('E55')->getValue(),
								"TRS_I_MD_HA_DIGIL" => $sheet->getCell('E56')->getValue(),
								"TRS_II_MD_HA_DIGIL" => $sheet->getCell('E57')->getValue(),
								"SUB_JUMLAH_RATA_TRS_MD_HA_DIGIL" => $sheet->getCell('E58')->getValue(),
								"TRT_I_MD_HA_DIGIL" => $sheet->getCell('E59')->getValue(),
								"TRT_II_MD_HA_DIGIL" => $sheet->getCell('E60')->getValue(),
								"SUB_JUMLAH_RATA_TRT_MD_HA_DIGIL" => $sheet->getCell('E61')->getValue(),
								"TRS_I_ML_HA_DIGIL" => $sheet->getCell('E62')->getValue(),
								"TRS_II_ML_HA_DIGIL" => $sheet->getCell('E63')->getValue(),
								"SUB_JUMLAH_RATA_TRS_ML_HA_DIGIL" => $sheet->getCell('E64')->getValue(),
								"TRT_I_ML_HA_DIGIL" => $sheet->getCell('E65')->getValue(),
								"TRT_II_ML_HA_DIGIL" => $sheet->getCell('E66')->getValue(),
								"SUB_JUMLAH_RATA_TRT_ML_HA_DIGIL" => $sheet->getCell('E67')->getValue(),
								"TRS_I_KS_HA_DIGIL" => $sheet->getCell('E68')->getValue(),
								"TRS_II_KS_HA_DIGIL" => $sheet->getCell('E69')->getValue(),
								"SUB_JUMLAH_RATA_TRS_KS_HA_DIGIL" => $sheet->getCell('E70')->getValue(),
								"TRT_I_KS_HA_DIGIL" => $sheet->getCell('E71')->getValue(),
								"TRT_II_KS_HA_DIGIL" => $sheet->getCell('E72')->getValue(),
								"SUB_JUMLAH_RATA_TRT_KS_HA_DIGIL" => $sheet->getCell('E73')->getValue(),
								"TRS_I_MR_HA_DIGIL" => $sheet->getCell('E74')->getValue(),
								"TRS_II_MR_HA_DIGIL" => $sheet->getCell('E75')->getValue(),
								"SUB_JUMLAH_RATA_TRS_MR_HA_DIGIL" => $sheet->getCell('E76')->getValue(),
								"TRT_I_MR_HA_DIGIL" => $sheet->getCell('E77')->getValue(),
								"TRT_II_MR_HA_DIGIL" => $sheet->getCell('E78')->getValue(),
								"SUB_JUMLAH_RATA_TRT_MR_HA_DIGIL" => $sheet->getCell('E79')->getValue(),
								"TR_TK_HA_DIGIL" => $sheet->getCell('E80')->getValue(),
								"TR_TM_HA_DIGIL" => $sheet->getCell('E81')->getValue(),
								"SUB_JUMLAH_RATA_TR_TRANS_HA_DIGIL" => $sheet->getCell('E82')->getValue(),
								"JUMLAHRATA_TR_HA_DIGIL" => $sheet->getCell('E83')->getValue(),
								"JUMLAH_RATA_RATA_TS_TR_HA_DIGIL" => $sheet->getCell('E84')->getValue(),
								
								"TSS_I_HG_HA_BELUM" => $sheet->getCell('F10')->getValue(),
								"TSS_II_HG_HA_BELUM" => $sheet->getCell('F11')->getValue(),
								"TSS_III_HG_HA_BELUM" => $sheet->getCell('F12')->getValue(),
								"SUB_JUMLAHRATA_TSS_HG_HA_BELUM" => $sheet->getCell('F13')->getValue(),
								"TST_I_HG_HA_BELUM" => $sheet->getCell('F14')->getValue(),
								"TST_II_HG_HA_BELUM" => $sheet->getCell('F15')->getValue(),
								"TST_III_HG_HA_BELUM" => $sheet->getCell('F16')->getValue(),
								"SUB_JUMLAH_RATA_TST_HG_HA_BELUM" => $sheet->getCell('F17')->getValue(),
								"SUB_JUMLAH_RATA_HG_HA_BELUM" => $sheet->getCell('F18')->getValue(),
								"TSS_I_IP_HA_BELUM" => $sheet->getCell('F19')->getValue(),
								"TSS_II_IP_HA_BELUM" => $sheet->getCell('F20')->getValue(),
								"SUB_JUMLAH_RATA_TSS_IP_HA_BELUM" => $sheet->getCell('F21')->getValue(),
								"TST_I_IP_HA_BELUM" => $sheet->getCell('F22')->getValue(),
								"TST_II_IP_HA_BELUM" => $sheet->getCell('F23')->getValue(),
								"SUB_JUMLAH_RATA_TST_IP_HA_BELUM" => $sheet->getCell('F24')->getValue(),
								"TSS_I_KN_HA_BELUM" => $sheet->getCell('F25')->getValue(),
								"TSS_II_KN_HA_BELUM" => $sheet->getCell('F26')->getValue(),
								"SUB_JUMLAH_RATA_TSS_KN_HA_BELUM" => $sheet->getCell('F27')->getValue(),
								"TST_I_KN_HA_BELUM" => $sheet->getCell('F28')->getValue(),
								"TST_II_KN__HA_BELUM" => $sheet->getCell('F29')->getValue(),
								"SUB_JUMLAH_RATA_TST_KN_HA_BELUM" => $sheet->getCell('F30')->getValue(),
								"TSS_I_KS_HA_BELUM" => $sheet->getCell('F31')->getValue(),
								"TSS_II_KS_HA_BELUM" => $sheet->getCell('F32')->getValue(),
								"SUB_JUMLAH_RATA_TSS_KS_HA_BELUM" => $sheet->getCell('F33')->getValue(),
								"TST_I_KS_HA_BELUM" => $sheet->getCell('F34')->getValue(),
								"TST_II_KS_HA_BELUM" => $sheet->getCell('F35')->getValue(),
								"SUB_JUMLAH_RATA_TST_KS_HA_BELUM" => $sheet->getCell('F36')->getValue(),
								"TS_SP_HA_BELUM" => $sheet->getCell('F37')->getValue(),
								"TS_ST_HA_BELUM" => $sheet->getCell('F38')->getValue(),
								"SUB_JUMLAH_RATA_SPT_HA_BELUM" => $sheet->getCell('F39')->getValue(),
								"TS_TR_HA_BELUM" => $sheet->getCell('F40')->getValue(),
								"TS_BB_HA_BELUM" => $sheet->getCell('F41')->getValue(),
								"JUMLAHRATA_TS_HA_BELUM" => $sheet->getCell('F42')->getValue(),
								"TRS_I_KD_HA_BELUM" => $sheet->getCell('F44')->getValue(),
								"TRS_II_KD_HA_BELUM" => $sheet->getCell('F45')->getValue(),
								"SUB_JUMLAH_RATA_TRS_KD_HA_BELUM" => $sheet->getCell('F46')->getValue(),
								"TRT_I_KD_HA_BELUM" => $sheet->getCell('F47')->getValue(),
								"TRT_II_KD_HA_BELUM" => $sheet->getCell('F48')->getValue(),
								"SUB_JUMLAH_RATA_TRT_KD_HA_BELUM" => $sheet->getCell('F49')->getValue(),
								"TRS_I_KL_HA_BELUM" => $sheet->getCell('F50')->getValue(),
								"TRS_II_KL_HA_BELUM" => $sheet->getCell('F51')->getValue(),
								"SUB_JUMLAH_RATA_TRS_KL_HA_BELUM" => $sheet->getCell('F52')->getValue(),
								"TRT_I_KL_HA_BELUM" => $sheet->getCell('F53')->getValue(),
								"TRT_II_KL_HA_BELUM" => $sheet->getCell('F54')->getValue(),
								"SUB_JUMLAH_RATA_TRT_KL_HA_BELUM" => $sheet->getCell('F55')->getValue(),
								"TRS_I_MD_HA_BELUM" => $sheet->getCell('F56')->getValue(),
								"TRS_II_MD_HA_BELUM" => $sheet->getCell('F57')->getValue(),
								"SUB_JUMLAH_RATA_TRS_MD_HA_BELUM" => $sheet->getCell('F58')->getValue(),
								"TRT_I_MD_HA_BELUM" => $sheet->getCell('F59')->getValue(),
								"TRT_II_MD_HA_BELUM" => $sheet->getCell('F60')->getValue(),
								"SUB_JUMLAH_RATA_TRT_MD_HA_BELUM" => $sheet->getCell('F61')->getValue(),
								"TRS_I_ML_HA_BELUM" => $sheet->getCell('F62')->getValue(),
								"TRS_II_ML_HA_BELUM" => $sheet->getCell('F63')->getValue(),
								"SUB_JUMLAH_RATA_TRS_ML_HA_BELUM" => $sheet->getCell('F64')->getValue(),
								"TRT_I_ML_HA_BELUM" => $sheet->getCell('F65')->getValue(),
								"TRT_II_ML_HA_BELUM" => $sheet->getCell('F66')->getValue(),
								"SUB_JUMLAH_RATA_TRT_ML_HA_BELUM" => $sheet->getCell('F67')->getValue(),
								"TRS_I_KS_HA_BELUM" => $sheet->getCell('F68')->getValue(),
								"TRS_II_KS_HA_BELUM" => $sheet->getCell('F69')->getValue(),
								"SUB_JUMLAH_RATA_TRS_KS_HA_BELUM" => $sheet->getCell('F70')->getValue(),
								"TRT_I_KS_HA_BELUM" => $sheet->getCell('F71')->getValue(),
								"TRT_II_KS_HA_BELUM" => $sheet->getCell('F72')->getValue(),
								"SUB_JUMLAH_RATA_TRT_KS_HA_BELUM" => $sheet->getCell('F73')->getValue(),
								"TRS_I_MR_HA_BELUM" => $sheet->getCell('F74')->getValue(),
								"TRS_II_MR_HA_BELUM" => $sheet->getCell('F75')->getValue(),
								"SUB_JUMLAH_RATA_TRS_MR_HA_BELUM" => $sheet->getCell('F76')->getValue(),
								"TRT_I_MR_HA_BELUM" => $sheet->getCell('F77')->getValue(),
								"TRT_II_MR_HA_BELUM" => $sheet->getCell('F78')->getValue(),
								"SUB_JUMLAH_RATA_TRT_MR_HA_BELUM" => $sheet->getCell('F79')->getValue(),
								"TR_TK_HA_BELUM" => $sheet->getCell('F80')->getValue(),
								"TR_TM_HA_BELUM" => $sheet->getCell('F81')->getValue(),
								"SUB_JUMLAH_RATA_TR_TRANS_HA_BELUM" => $sheet->getCell('F82')->getValue(),
								"JUMLAHRATA_TR_HA_BELUM" => $sheet->getCell('F83')->getValue(),
								"JUMLAH_RATA_RATA_TS_TR_HA_BELUM" => $sheet->getCell('F84')->getValue(),
								
								"TSS_I_HG_TON_TEBU" => $sheet->getCell('G10')->getValue(),
								"TSS_II_HG_TON_TEBU" => $sheet->getCell('G11')->getValue(),
								"TSS_III_HG_TON_TEBU" => $sheet->getCell('G12')->getValue(),
								"SUB_JUMLAHRATA_TSS_HG_TON_TEBU" => $sheet->getCell('G13')->getValue(),
								"TST_I_HG_TON_TEBU" => $sheet->getCell('G14')->getValue(),
								"TST_II_HG_TON_TEBU" => $sheet->getCell('G15')->getValue(),
								"TST_III_HG_TON_TEBU" => $sheet->getCell('G16')->getValue(),
								"SUB_JUMLAH_RATA_TST_HG_TON_TEBU" => $sheet->getCell('G17')->getValue(),
								"SUB_JUMLAH_RATA_HG_TON_TEBU" => $sheet->getCell('G18')->getValue(),
								"TSS_I_IP_TON_TEBU" => $sheet->getCell('G19')->getValue(),
								"TSS_II_IP_TON_TEBU" => $sheet->getCell('G20')->getValue(),
								"SUB_JUMLAH_RATA_TSS_IP_TON_TEBU" => $sheet->getCell('G21')->getValue(),
								"TST_I_IP_TON_TEBU" => $sheet->getCell('G22')->getValue(),
								"TST_II_IP_TON_TEBU" => $sheet->getCell('G23')->getValue(),
								"SUB_JUMLAH_RATA_TST_IP_TON_TEBU" => $sheet->getCell('G24')->getValue(),
								"TSS_I_KN_TON_TEBU" => $sheet->getCell('G25')->getValue(),
								"TSS_II_KN_TON_TEBU" => $sheet->getCell('G26')->getValue(),
								"SUB_JUMLAH_RATA_TSS_KN_TON_TEBU" => $sheet->getCell('G27')->getValue(),
								"TST_I_KN_TON_TEBU" => $sheet->getCell('G28')->getValue(),
								"TST_II_KN__TON_TEBU" => $sheet->getCell('G29')->getValue(),
								"SUB_JUMLAH_RATA_TST_KN_TON_TEBU" => $sheet->getCell('G30')->getValue(),
								"TSS_I_KS_TON_TEBU" => $sheet->getCell('G31')->getValue(),
								"TSS_II_KS_TON_TEBU" => $sheet->getCell('G32')->getValue(),
								"SUB_JUMLAH_RATA_TSS_KS_TON_TEBU" => $sheet->getCell('G33')->getValue(),
								"TST_I_KS_TON_TEBU" => $sheet->getCell('G34')->getValue(),
								"TST_II_KS_TON_TEBU" => $sheet->getCell('G35')->getValue(),
								"SUB_JUMLAH_RATA_TST_KS_TON_TEBU" => $sheet->getCell('G36')->getValue(),
								"TS_SP_TON_TEBU" => $sheet->getCell('G37')->getValue(),
								"TS_ST_TON_TEBU" => $sheet->getCell('G38')->getValue(),
								"SUB_JUMLAH_RATA_SPT_TON_TEBU" => $sheet->getCell('G39')->getValue(),
								"TS_TR_TON_TEBU" => $sheet->getCell('G40')->getValue(),
								"TS_BB_TON_TEBU" => $sheet->getCell('G41')->getValue(),
								"JUMLAHRATA_TS_TON_TEBU" => $sheet->getCell('G42')->getValue(),
								"TRS_I_KD_TON_TEBU" => $sheet->getCell('G44')->getValue(),
								"TRS_II_KD_TON_TEBU" => $sheet->getCell('G45')->getValue(),
								"SUB_JUMLAH_RATA_TRS_KD_TON_TEBU" => $sheet->getCell('G46')->getValue(),
								"TRT_I_KD_TON_TEBU" => $sheet->getCell('G47')->getValue(),
								"TRT_II_KD_TON_TEBU" => $sheet->getCell('G48')->getValue(),
								"SUB_JUMLAH_RATA_TRT_KD_TON_TEBU" => $sheet->getCell('G49')->getValue(),
								"TRS_I_KL_TON_TEBU" => $sheet->getCell('G50')->getValue(),
								"TRS_II_KL_TON_TEBU" => $sheet->getCell('G51')->getValue(),
								"SUB_JUMLAH_RATA_TRS_KL_TON_TEBU" => $sheet->getCell('G52')->getValue(),
								"TRT_I_KL_TON_TEBU" => $sheet->getCell('G53')->getValue(),
								"TRT_II_KL_TON_TEBU" => $sheet->getCell('G54')->getValue(),
								"SUB_JUMLAH_RATA_TRT_KL_TON_TEBU" => $sheet->getCell('G55')->getValue(),
								"TRS_I_MD_TON_TEBU" => $sheet->getCell('G56')->getValue(),
								"TRS_II_MD_TON_TEBU" => $sheet->getCell('G57')->getValue(),
								"SUB_JUMLAH_RATA_TRS_MD_TON_TEBU" => $sheet->getCell('G58')->getValue(),
								"TRT_I_MD_TON_TEBU" => $sheet->getCell('G59')->getValue(),
								"TRT_II_MD_TON_TEBU" => $sheet->getCell('G60')->getValue(),
								"SUB_JUMLAH_RATA_TRT_MD_TON_TEBU" => $sheet->getCell('G61')->getValue(),
								"TRS_I_ML_TON_TEBU" => $sheet->getCell('G62')->getValue(),
								"TRS_II_ML_TON_TEBU" => $sheet->getCell('G63')->getValue(),
								"SUB_JUMLAH_RATA_TRS_ML_TON_TEBU" => $sheet->getCell('G64')->getValue(),
								"TRT_I_ML_TON_TEBU" => $sheet->getCell('G65')->getValue(),
								"TRT_II_ML_TON_TEBU" => $sheet->getCell('G66')->getValue(),
								"SUB_JUMLAH_RATA_TRT_ML_TON_TEBU" => $sheet->getCell('G67')->getValue(),
								"TRS_I_KS_TON_TEBU" => $sheet->getCell('G68')->getValue(),
								"TRS_II_KS_TON_TEBU" => $sheet->getCell('G69')->getValue(),
								"SUB_JUMLAH_RATA_TRS_KS_TON_TEBU" => $sheet->getCell('G70')->getValue(),
								"TRT_I_KS_TON_TEBU" => $sheet->getCell('G71')->getValue(),
								"TRT_II_KS_TON_TEBU" => $sheet->getCell('G72')->getValue(),
								"SUB_JUMLAH_RATA_TRT_KS_TON_TEBU" => $sheet->getCell('G73')->getValue(),
								"TRS_I_MR_TON_TEBU" => $sheet->getCell('G74')->getValue(),
								"TRS_II_MR_TON_TEBU" => $sheet->getCell('G75')->getValue(),
								"SUB_JUMLAH_RATA_TRS_MR_TON_TEBU" => $sheet->getCell('G76')->getValue(),
								"TRT_I_MR_TON_TEBU" => $sheet->getCell('G77')->getValue(),
								"TRT_II_MR_TON_TEBU" => $sheet->getCell('G78')->getValue(),
								"SUB_JUMLAH_RATA_TRT_MR_TON_TEBU" => $sheet->getCell('G79')->getValue(),
								"TR_TK_TON_TEBU" => $sheet->getCell('G80')->getValue(),
								"TR_TM_TON_TEBU" => $sheet->getCell('G81')->getValue(),
								"SUB_JUMLAH_RATA_TR_TRANS_TON_TEBU" => $sheet->getCell('G82')->getValue(),
								"JUMLAHRATA_TR_TON_TEBU" => $sheet->getCell('G83')->getValue(),
								"JUMLAH_RATA_RATA_TS_TR_TON_TEBU" => $sheet->getCell('G84')->getValue(),
								
								"TSS_I_HG_TON_HABL" => $sheet->getCell('H10')->getValue(),
								"TSS_II_HG_TON_HABL" => $sheet->getCell('H11')->getValue(),
								"TSS_III_HG_TON_HABL" => $sheet->getCell('H12')->getValue(),
								"SUB_JUMLAHRATA_TSS_HG_TON_HABL" => $sheet->getCell('H13')->getValue(),
								"TST_I_HG_TON_HABL" => $sheet->getCell('H14')->getValue(),
								"TST_II_HG_TON_HABL" => $sheet->getCell('H15')->getValue(),
								"TST_III_HG_TON_HABL" => $sheet->getCell('H16')->getValue(),
								"SUB_JUMLAH_RATA_TST_HG_TON_HABL" => $sheet->getCell('H17')->getValue(),
								"SUB_JUMLAH_RATA_HG_TON_HABL" => $sheet->getCell('H18')->getValue(),
								"TSS_I_IP_TON_HABL" => $sheet->getCell('H19')->getValue(),
								"TSS_II_IP_TON_HABL" => $sheet->getCell('H20')->getValue(),
								"SUB_JUMLAH_RATA_TSS_IP_TON_HABL" => $sheet->getCell('H21')->getValue(),
								"TST_I_IP_TON_HABL" => $sheet->getCell('H22')->getValue(),
								"TST_II_IP_TON_HABL" => $sheet->getCell('H23')->getValue(),
								"SUB_JUMLAH_RATA_TST_IP_TON_HABL" => $sheet->getCell('H24')->getValue(),
								"TSS_I_KN_TON_HABL" => $sheet->getCell('H25')->getValue(),
								"TSS_II_KN_TON_HABL" => $sheet->getCell('H26')->getValue(),
								"SUB_JUMLAH_RATA_TSS_KN_TON_HABL" => $sheet->getCell('H27')->getValue(),
								"TST_I_KN_TON_HABL" => $sheet->getCell('H28')->getValue(),
								"TST_II_KN__TON_HABL" => $sheet->getCell('H29')->getValue(),
								"SUB_JUMLAH_RATA_TST_KN_TON_HABL" => $sheet->getCell('H30')->getValue(),
								"TSS_I_KS_TON_HABL" => $sheet->getCell('H31')->getValue(),
								"TSS_II_KS_TON_HABL" => $sheet->getCell('H32')->getValue(),
								"SUB_JUMLAH_RATA_TSS_KS_TON_HABL" => $sheet->getCell('H33')->getValue(),
								"TST_I_KS_TON_HABL" => $sheet->getCell('H34')->getValue(),
								"TST_II_KS_TON_HABL" => $sheet->getCell('H35')->getValue(),
								"SUB_JUMLAH_RATA_TST_KS_TON_HABL" => $sheet->getCell('H36')->getValue(),
								"TS_SP_TON_HABL" => $sheet->getCell('H37')->getValue(),
								"TS_ST_TON_HABL" => $sheet->getCell('H38')->getValue(),
								"SUB_JUMLAH_RATA_SPT_TON_HABL" => $sheet->getCell('H39')->getValue(),
								"TS_TR_TON_HABL" => $sheet->getCell('H40')->getValue(),
								"TS_BB_TON_HABL" => $sheet->getCell('H41')->getValue(),
								"JUMLAHRATA_TS_TON_HABL" => $sheet->getCell('H42')->getValue(),
								"TRS_I_KD_TON_HABL" => $sheet->getCell('H44')->getValue(),
								"TRS_II_KD_TON_HABL" => $sheet->getCell('H45')->getValue(),
								"SUB_JUMLAH_RATA_TRS_KD_TON_HABL" => $sheet->getCell('H46')->getValue(),
								"TRT_I_KD_TON_HABL" => $sheet->getCell('H47')->getValue(),
								"TRT_II_KD_TON_HABL" => $sheet->getCell('H48')->getValue(),
								"SUB_JUMLAH_RATA_TRT_KD_TON_HABL" => $sheet->getCell('H49')->getValue(),
								"TRS_I_KL_TON_HABL" => $sheet->getCell('H50')->getValue(),
								"TRS_II_KL_TON_HABL" => $sheet->getCell('H51')->getValue(),
								"SUB_JUMLAH_RATA_TRS_KL_TON_HABL" => $sheet->getCell('H52')->getValue(),
								"TRT_I_KL_TON_HABL" => $sheet->getCell('H53')->getValue(),
								"TRT_II_KL_TON_HABL" => $sheet->getCell('H54')->getValue(),
								"SUB_JUMLAH_RATA_TRT_KL_TON_HABL" => $sheet->getCell('H55')->getValue(),
								"TRS_I_MD_TON_HABL" => $sheet->getCell('H56')->getValue(),
								"TRS_II_MD_TON_HABL" => $sheet->getCell('H57')->getValue(),
								"SUB_JUMLAH_RATA_TRS_MD_TON_HABL" => $sheet->getCell('H58')->getValue(),
								"TRT_I_MD_TON_HABL" => $sheet->getCell('H59')->getValue(),
								"TRT_II_MD_TON_HABL" => $sheet->getCell('H60')->getValue(),
								"SUB_JUMLAH_RATA_TRT_MD_TON_HABL" => $sheet->getCell('H61')->getValue(),
								"TRS_I_ML_TON_HABL" => $sheet->getCell('H62')->getValue(),
								"TRS_II_ML_TON_HABL" => $sheet->getCell('H63')->getValue(),
								"SUB_JUMLAH_RATA_TRS_ML_TON_HABL" => $sheet->getCell('H64')->getValue(),
								"TRT_I_ML_TON_HABL" => $sheet->getCell('H65')->getValue(),
								"TRT_II_ML_TON_HABL" => $sheet->getCell('H66')->getValue(),
								"SUB_JUMLAH_RATA_TRT_ML_TON_HABL" => $sheet->getCell('H67')->getValue(),
								"TRS_I_KS_TON_HABL" => $sheet->getCell('H68')->getValue(),
								"TRS_II_KS_TON_HABL" => $sheet->getCell('H69')->getValue(),
								"SUB_JUMLAH_RATA_TRS_KS_TON_HABL" => $sheet->getCell('H70')->getValue(),
								"TRT_I_KS_TON_HABL" => $sheet->getCell('H71')->getValue(),
								"TRT_II_KS_TON_HABL" => $sheet->getCell('H72')->getValue(),
								"SUB_JUMLAH_RATA_TRT_KS_TON_HABL" => $sheet->getCell('H73')->getValue(),
								"TRS_I_MR_TON_HABL" => $sheet->getCell('H74')->getValue(),
								"TRS_II_MR_TON_HABL" => $sheet->getCell('H75')->getValue(),
								"SUB_JUMLAH_RATA_TRS_MR_TON_HABL" => $sheet->getCell('H76')->getValue(),
								"TRT_I_MR_TON_HABL" => $sheet->getCell('H77')->getValue(),
								"TRT_II_MR_TON_HABL" => $sheet->getCell('H78')->getValue(),
								"SUB_JUMLAH_RATA_TRT_MR_TON_HABL" => $sheet->getCell('H79')->getValue(),
								"TR_TK_TON_HABL" => $sheet->getCell('H80')->getValue(),
								"TR_TM_TON_HABL" => $sheet->getCell('H81')->getValue(),
								"SUB_JUMLAH_RATA_TR_TRANS_TON_HABL" => $sheet->getCell('H82')->getValue(),
								"JUMLAHRATA_TR_TON_HABL" => $sheet->getCell('H83')->getValue(),
								"JUMLAH_RATA_RATA_TS_TR_TON_HABL" => $sheet->getCell('H84')->getValue(),
								
								"TSS_I_HG_TEBU_HA" => $sheet->getCell('I10')->getValue(),
								"TSS_II_HG_TEBU_HA" => $sheet->getCell('I11')->getValue(),
								"TSS_III_HG_TEBU_HA" => $sheet->getCell('I12')->getValue(),
								"SUB_JUMLAHRATA_TSS_HG_TEBU_HA" => $sheet->getCell('I13')->getValue(),
								"TST_I_HG_TEBU_HA" => $sheet->getCell('I14')->getValue(),
								"TST_II_HG_TEBU_HA" => $sheet->getCell('I15')->getValue(),
								"TST_III_HG_TEBU_HA" => $sheet->getCell('I16')->getValue(),
								"SUB_JUMLAH_RATA_TST_HG_TEBU_HA" => $sheet->getCell('I17')->getValue(),
								"SUB_JUMLAH_RATA_HG_TEBU_HA" => $sheet->getCell('I18')->getValue(),
								"TSS_I_IP_TEBU_HA" => $sheet->getCell('I19')->getValue(),
								"TSS_II_IP_TEBU_HA" => $sheet->getCell('I20')->getValue(),
								"SUB_JUMLAH_RATA_TSS_IP_TEBU_HA" => $sheet->getCell('I21')->getValue(),
								"TST_I_IP_TEBU_HA" => $sheet->getCell('I22')->getValue(),
								"TST_II_IP_TEBU_HA" => $sheet->getCell('I23')->getValue(),
								"SUB_JUMLAH_RATA_TST_IP_TEBU_HA" => $sheet->getCell('I24')->getValue(),
								"TSS_I_KN_TEBU_HA" => $sheet->getCell('I25')->getValue(),
								"TSS_II_KN_TEBU_HA" => $sheet->getCell('I26')->getValue(),
								"SUB_JUMLAH_RATA_TSS_KN_TEBU_HA" => $sheet->getCell('I27')->getValue(),
								"TST_I_KN_TEBU_HA" => $sheet->getCell('I28')->getValue(),
								"TST_II_KN__TEBU_HA" => $sheet->getCell('I29')->getValue(),
								"SUB_JUMLAH_RATA_TST_KN_TEBU_HA" => $sheet->getCell('I30')->getValue(),
								"TSS_I_KS_TEBU_HA" => $sheet->getCell('I31')->getValue(),
								"TSS_II_KS_TEBU_HA" => $sheet->getCell('I32')->getValue(),
								"SUB_JUMLAH_RATA_TSS_KS_TEBU_HA" => $sheet->getCell('I33')->getValue(),
								"TST_I_KS_TEBU_HA" => $sheet->getCell('I34')->getValue(),
								"TST_II_KS_TEBU_HA" => $sheet->getCell('I35')->getValue(),
								"SUB_JUMLAH_RATA_TST_KS_TEBU_HA" => $sheet->getCell('I36')->getValue(),
								"TS_SP_TEBU_HA" => $sheet->getCell('I37')->getValue(),
								"TS_ST_TEBU_HA" => $sheet->getCell('I38')->getValue(),
								"SUB_JUMLAH_RATA_SPT_TEBU_HA" => $sheet->getCell('I39')->getValue(),
								"TS_TR_TEBU_HA" => $sheet->getCell('I40')->getValue(),
								"TS_BB_TEBU_HA" => $sheet->getCell('I41')->getValue(),
								"JUMLAHRATA_TS_TEBU_HA" => $sheet->getCell('I42')->getValue(),
								"TRS_I_KD_TEBU_HA" => $sheet->getCell('I44')->getValue(),
								"TRS_II_KD_TEBU_HA" => $sheet->getCell('I45')->getValue(),
								"SUB_JUMLAH_RATA_TRS_KD_TEBU_HA" => $sheet->getCell('I46')->getValue(),
								"TRT_I_KD_TEBU_HA" => $sheet->getCell('I47')->getValue(),
								"TRT_II_KD_TEBU_HA" => $sheet->getCell('I48')->getValue(),
								"SUB_JUMLAH_RATA_TRT_KD_TEBU_HA" => $sheet->getCell('I49')->getValue(),
								"TRS_I_KL_TEBU_HA" => $sheet->getCell('I50')->getValue(),
								"TRS_II_KL_TEBU_HA" => $sheet->getCell('I51')->getValue(),
								"SUB_JUMLAH_RATA_TRS_KL_TEBU_HA" => $sheet->getCell('I52')->getValue(),
								"TRT_I_KL_TEBU_HA" => $sheet->getCell('I53')->getValue(),
								"TRT_II_KL_TEBU_HA" => $sheet->getCell('I54')->getValue(),
								"SUB_JUMLAH_RATA_TRT_KL_TEBU_HA" => $sheet->getCell('I55')->getValue(),
								"TRS_I_MD_TEBU_HA" => $sheet->getCell('I56')->getValue(),
								"TRS_II_MD_TEBU_HA" => $sheet->getCell('I57')->getValue(),
								"SUB_JUMLAH_RATA_TRS_MD_TEBU_HA" => $sheet->getCell('I58')->getValue(),
								"TRT_I_MD_TEBU_HA" => $sheet->getCell('I59')->getValue(),
								"TRT_II_MD_TEBU_HA" => $sheet->getCell('I60')->getValue(),
								"SUB_JUMLAH_RATA_TRT_MD_TEBU_HA" => $sheet->getCell('I61')->getValue(),
								"TRS_I_ML_TEBU_HA" => $sheet->getCell('I62')->getValue(),
								"TRS_II_ML_TEBU_HA" => $sheet->getCell('I63')->getValue(),
								"SUB_JUMLAH_RATA_TRS_ML_TEBU_HA" => $sheet->getCell('I64')->getValue(),
								"TRT_I_ML_TEBU_HA" => $sheet->getCell('I65')->getValue(),
								"TRT_II_ML_TEBU_HA" => $sheet->getCell('I66')->getValue(),
								"SUB_JUMLAH_RATA_TRT_ML_TEBU_HA" => $sheet->getCell('I67')->getValue(),
								"TRS_I_KS_TEBU_HA" => $sheet->getCell('I68')->getValue(),
								"TRS_II_KS_TEBU_HA" => $sheet->getCell('I69')->getValue(),
								"SUB_JUMLAH_RATA_TRS_KS_TEBU_HA" => $sheet->getCell('I70')->getValue(),
								"TRT_I_KS_TEBU_HA" => $sheet->getCell('I71')->getValue(),
								"TRT_II_KS_TEBU_HA" => $sheet->getCell('I72')->getValue(),
								"SUB_JUMLAH_RATA_TRT_KS_TEBU_HA" => $sheet->getCell('I73')->getValue(),
								"TRS_I_MR_TEBU_HA" => $sheet->getCell('I74')->getValue(),
								"TRS_II_MR_TEBU_HA" => $sheet->getCell('I75')->getValue(),
								"SUB_JUMLAH_RATA_TRS_MR_TEBU_HA" => $sheet->getCell('I76')->getValue(),
								"TRT_I_MR_TEBU_HA" => $sheet->getCell('I77')->getValue(),
								"TRT_II_MR_TEBU_HA" => $sheet->getCell('I78')->getValue(),
								"SUB_JUMLAH_RATA_TRT_MR_TEBU_HA" => $sheet->getCell('I79')->getValue(),
								"TR_TK_TEBU_HA" => $sheet->getCell('I80')->getValue(),
								"TR_TM_TEBU_HA" => $sheet->getCell('I81')->getValue(),
								"SUB_JUMLAH_RATA_TR_TRANS_TEBU_HA" => $sheet->getCell('I82')->getValue(),
								"JUMLAHRATA_TR_TEBU_HA" => $sheet->getCell('I83')->getValue(),
								"JUMLAH_RATA_RATA_TS_TR_TEBU_HA" => $sheet->getCell('I84')->getValue(),
								
								"TSS_I_HG_HABL_HA" => $sheet->getCell('J10')->getValue(),
								"TSS_II_HG_HABL_HA" => $sheet->getCell('J11')->getValue(),
								"TSS_III_HG_HABL_HA" => $sheet->getCell('J12')->getValue(),
								"SUB_JUMLAHRATA_TSS_HG_HABL_HA" => $sheet->getCell('J13')->getValue(),
								"TST_I_HG_HABL_HA" => $sheet->getCell('J14')->getValue(),
								"TST_II_HG_HABL_HA" => $sheet->getCell('J15')->getValue(),
								"TST_III_HG_HABL_HA" => $sheet->getCell('J16')->getValue(),
								"SUB_JUMLAH_RATA_TST_HG_HABL_HA" => $sheet->getCell('J17')->getValue(),
								"SUB_JUMLAH_RATA_HG_HABL_HA" => $sheet->getCell('J18')->getValue(),
								"TSS_I_IP_HABL_HA" => $sheet->getCell('J19')->getValue(),
								"TSS_II_IP_HABL_HA" => $sheet->getCell('J20')->getValue(),
								"SUB_JUMLAH_RATA_TSS_IP_HABL_HA" => $sheet->getCell('J21')->getValue(),
								"TST_I_IP_HABL_HA" => $sheet->getCell('J22')->getValue(),
								"TST_II_IP_HABL_HA" => $sheet->getCell('J23')->getValue(),
								"SUB_JUMLAH_RATA_TST_IP_HABL_HA" => $sheet->getCell('J24')->getValue(),
								"TSS_I_KN_HABL_HA" => $sheet->getCell('J25')->getValue(),
								"TSS_II_KN_HABL_HA" => $sheet->getCell('J26')->getValue(),
								"SUB_JUMLAH_RATA_TSS_KN_HABL_HA" => $sheet->getCell('J27')->getValue(),
								"TST_I_KN_HABL_HA" => $sheet->getCell('J28')->getValue(),
								"TST_II_KN__HABL_HA" => $sheet->getCell('J29')->getValue(),
								"SUB_JUMLAH_RATA_TST_KN_HABL_HA" => $sheet->getCell('J30')->getValue(),
								"TSS_I_KS_HABL_HA" => $sheet->getCell('J31')->getValue(),
								"TSS_II_KS_HABL_HA" => $sheet->getCell('J32')->getValue(),
								"SUB_JUMLAH_RATA_TSS_KS_HABL_HA" => $sheet->getCell('J33')->getValue(),
								"TST_I_KS_HABL_HA" => $sheet->getCell('J34')->getValue(),
								"TST_II_KS_HABL_HA" => $sheet->getCell('J35')->getValue(),
								"SUB_JUMLAH_RATA_TST_KS_HABL_HA" => $sheet->getCell('J36')->getValue(),
								"TS_SP_HABL_HA" => $sheet->getCell('J37')->getValue(),
								"TS_ST_HABL_HA" => $sheet->getCell('J38')->getValue(),
								"SUB_JUMLAH_RATA_SPT_HABL_HA" => $sheet->getCell('J39')->getValue(),
								"TS_TR_HABL_HA" => $sheet->getCell('J40')->getValue(),
								"TS_BB_HABL_HA" => $sheet->getCell('J41')->getValue(),
								"JUMLAHRATA_TS_HABL_HA" => $sheet->getCell('J42')->getValue(),
								"TRS_I_KD_HABL_HA" => $sheet->getCell('J44')->getValue(),
								"TRS_II_KD_HABL_HA" => $sheet->getCell('J45')->getValue(),
								"SUB_JUMLAH_RATA_TRS_KD_HABL_HA" => $sheet->getCell('J46')->getValue(),
								"TRT_I_KD_HABL_HA" => $sheet->getCell('J47')->getValue(),
								"TRT_II_KD_HABL_HA" => $sheet->getCell('J48')->getValue(),
								"SUB_JUMLAH_RATA_TRT_KD_HABL_HA" => $sheet->getCell('J49')->getValue(),
								"TRS_I_KL_HABL_HA" => $sheet->getCell('J50')->getValue(),
								"TRS_II_KL_HABL_HA" => $sheet->getCell('J51')->getValue(),
								"SUB_JUMLAH_RATA_TRS_KL_HABL_HA" => $sheet->getCell('J52')->getValue(),
								"TRT_I_KL_HABL_HA" => $sheet->getCell('J53')->getValue(),
								"TRT_II_KL_HABL_HA" => $sheet->getCell('J54')->getValue(),
								"SUB_JUMLAH_RATA_TRT_KL_HABL_HA" => $sheet->getCell('J55')->getValue(),
								"TRS_I_MD_HABL_HA" => $sheet->getCell('J56')->getValue(),
								"TRS_II_MD_HABL_HA" => $sheet->getCell('J57')->getValue(),
								"SUB_JUMLAH_RATA_TRS_MD_HABL_HA" => $sheet->getCell('J58')->getValue(),
								"TRT_I_MD_HABL_HA" => $sheet->getCell('J59')->getValue(),
								"TRT_II_MD_HABL_HA" => $sheet->getCell('J60')->getValue(),
								"SUB_JUMLAH_RATA_TRT_MD_HABL_HA" => $sheet->getCell('J61')->getValue(),
								"TRS_I_ML_HABL_HA" => $sheet->getCell('J62')->getValue(),
								"TRS_II_ML_HABL_HA" => $sheet->getCell('J63')->getValue(),
								"SUB_JUMLAH_RATA_TRS_ML_HABL_HA" => $sheet->getCell('J64')->getValue(),
								"TRT_I_ML_HABL_HA" => $sheet->getCell('J65')->getValue(),
								"TRT_II_ML_HABL_HA" => $sheet->getCell('J66')->getValue(),
								"SUB_JUMLAH_RATA_TRT_ML_HABL_HA" => $sheet->getCell('J67')->getValue(),
								"TRS_I_KS_HABL_HA" => $sheet->getCell('J68')->getValue(),
								"TRS_II_KS_HABL_HA" => $sheet->getCell('J69')->getValue(),
								"SUB_JUMLAH_RATA_TRS_KS_HABL_HA" => $sheet->getCell('J70')->getValue(),
								"TRT_I_KS_HABL_HA" => $sheet->getCell('J71')->getValue(),
								"TRT_II_KS_HABL_HA" => $sheet->getCell('J72')->getValue(),
								"SUB_JUMLAH_RATA_TRT_KS_HABL_HA" => $sheet->getCell('J73')->getValue(),
								"TRS_I_MR_HABL_HA" => $sheet->getCell('J74')->getValue(),
								"TRS_II_MR_HABL_HA" => $sheet->getCell('J75')->getValue(),
								"SUB_JUMLAH_RATA_TRS_MR_HABL_HA" => $sheet->getCell('J76')->getValue(),
								"TRT_I_MR_HABL_HA" => $sheet->getCell('J77')->getValue(),
								"TRT_II_MR_HABL_HA" => $sheet->getCell('J78')->getValue(),
								"SUB_JUMLAH_RATA_TRT_MR_HABL_HA" => $sheet->getCell('J79')->getValue(),
								"TR_TK_HABL_HA" => $sheet->getCell('J80')->getValue(),
								"TR_TM_HABL_HA" => $sheet->getCell('J81')->getValue(),
								"SUB_JUMLAH_RATA_TR_TRANS_HABL_HA" => $sheet->getCell('J82')->getValue(),
								"JUMLAHRATA_TR_HABL_HA" => $sheet->getCell('J83')->getValue(),
								"JUMLAH_RATA_RATA_TS_TR_HABL_HA" => $sheet->getCell('J84')->getValue(),
								
								"TSS_I_HG_REND" => $sheet->getCell('K10')->getValue(),
								"TSS_II_HG_REND" => $sheet->getCell('K11')->getValue(),
								"TSS_III_HG_REND" => $sheet->getCell('K12')->getValue(),
								"SUB_JUMLAHRATA_TSS_HG_REND" => $sheet->getCell('K13')->getValue(),
								"TST_I_HG_REND" => $sheet->getCell('K14')->getValue(),
								"TST_II_HG_REND" => $sheet->getCell('K15')->getValue(),
								"TST_III_HG_REND" => $sheet->getCell('K16')->getValue(),
								"SUB_JUMLAH_RATA_TST_HG_REND" => $sheet->getCell('K17')->getValue(),
								"SUB_JUMLAH_RATA_HG_REND" => $sheet->getCell('K18')->getValue(),
								"TSS_I_IP_REND" => $sheet->getCell('K19')->getValue(),
								"TSS_II_IP_REND" => $sheet->getCell('K20')->getValue(),
								"SUB_JUMLAH_RATA_TSS_IP_REND" => $sheet->getCell('K21')->getValue(),
								"TST_I_IP_REND" => $sheet->getCell('K22')->getValue(),
								"TST_II_IP_REND" => $sheet->getCell('K23')->getValue(),
								"SUB_JUMLAH_RATA_TST_IP_REND" => $sheet->getCell('K24')->getValue(),
								"TSS_I_KN_REND" => $sheet->getCell('K25')->getValue(),
								"TSS_II_KN_REND" => $sheet->getCell('K26')->getValue(),
								"SUB_JUMLAH_RATA_TSS_KN_REND" => $sheet->getCell('K27')->getValue(),
								"TST_I_KN_REND" => $sheet->getCell('K28')->getValue(),
								"TST_II_KN__REND" => $sheet->getCell('K29')->getValue(),
								"SUB_JUMLAH_RATA_TST_KN_REND" => $sheet->getCell('K30')->getValue(),
								"TSS_I_KS_REND" => $sheet->getCell('K31')->getValue(),
								"TSS_II_KS_REND" => $sheet->getCell('K32')->getValue(),
								"SUB_JUMLAH_RATA_TSS_KS_REND" => $sheet->getCell('K33')->getValue(),
								"TST_I_KS_REND" => $sheet->getCell('K34')->getValue(),
								"TST_II_KS_REND" => $sheet->getCell('K35')->getValue(),
								"SUB_JUMLAH_RATA_TST_KS_REND" => $sheet->getCell('K36')->getValue(),
								"TS_SP_REND" => $sheet->getCell('K37')->getValue(),
								"TS_ST_REND" => $sheet->getCell('K38')->getValue(),
								"SUB_JUMLAH_RATA_SPT_REND" => $sheet->getCell('K39')->getValue(),
								"TS_TR_REND" => $sheet->getCell('K40')->getValue(),
								"TS_BB_REND" => $sheet->getCell('K41')->getValue(),
								"JUMLAHRATA_TS_REND" => $sheet->getCell('K42')->getValue(),
								"TRS_I_KD_REND" => $sheet->getCell('K44')->getValue(),
								"TRS_II_KD_REND" => $sheet->getCell('K45')->getValue(),
								"SUB_JUMLAH_RATA_TRS_KD_REND" => $sheet->getCell('K46')->getValue(),
								"TRT_I_KD_REND" => $sheet->getCell('K47')->getValue(),
								"TRT_II_KD_REND" => $sheet->getCell('K48')->getValue(),
								"SUB_JUMLAH_RATA_TRT_KD_REND" => $sheet->getCell('K49')->getValue(),
								"TRS_I_KL_REND" => $sheet->getCell('K50')->getValue(),
								"TRS_II_KL_REND" => $sheet->getCell('K51')->getValue(),
								"SUB_JUMLAH_RATA_TRS_KL_REND" => $sheet->getCell('K52')->getValue(),
								"TRT_I_KL_REND" => $sheet->getCell('K53')->getValue(),
								"TRT_II_KL_REND" => $sheet->getCell('K54')->getValue(),
								"SUB_JUMLAH_RATA_TRT_KL_REND" => $sheet->getCell('K55')->getValue(),
								"TRS_I_MD_REND" => $sheet->getCell('K56')->getValue(),
								"TRS_II_MD_REND" => $sheet->getCell('K57')->getValue(),
								"SUB_JUMLAH_RATA_TRS_MD_REND" => $sheet->getCell('K58')->getValue(),
								"TRT_I_MD_REND" => $sheet->getCell('K59')->getValue(),
								"TRT_II_MD_REND" => $sheet->getCell('K60')->getValue(),
								"SUB_JUMLAH_RATA_TRT_MD_REND" => $sheet->getCell('K61')->getValue(),
								"TRS_I_ML_REND" => $sheet->getCell('K62')->getValue(),
								"TRS_II_ML_REND" => $sheet->getCell('K63')->getValue(),
								"SUB_JUMLAH_RATA_TRS_ML_REND" => $sheet->getCell('K64')->getValue(),
								"TRT_I_ML_REND" => $sheet->getCell('K65')->getValue(),
								"TRT_II_ML_REND" => $sheet->getCell('K66')->getValue(),
								"SUB_JUMLAH_RATA_TRT_ML_REND" => $sheet->getCell('K67')->getValue(),
								"TRS_I_KS_REND" => $sheet->getCell('K68')->getValue(),
								"TRS_II_KS_REND" => $sheet->getCell('K69')->getValue(),
								"SUB_JUMLAH_RATA_TRS_KS_REND" => $sheet->getCell('K70')->getValue(),
								"TRT_I_KS_REND" => $sheet->getCell('K71')->getValue(),
								"TRT_II_KS_REND" => $sheet->getCell('K72')->getValue(),
								"SUB_JUMLAH_RATA_TRT_KS_REND" => $sheet->getCell('K73')->getValue(),
								"TRS_I_MR_REND" => $sheet->getCell('K74')->getValue(),
								"TRS_II_MR_REND" => $sheet->getCell('K75')->getValue(),
								"SUB_JUMLAH_RATA_TRS_MR_REND" => $sheet->getCell('K76')->getValue(),
								"TRT_I_MR_REND" => $sheet->getCell('K77')->getValue(),
								"TRT_II_MR_REND" => $sheet->getCell('K78')->getValue(),
								"SUB_JUMLAH_RATA_TRT_MR_REND" => $sheet->getCell('K79')->getValue(),
								"TR_TK_REND" => $sheet->getCell('K80')->getValue(),
								"TR_TM_REND" => $sheet->getCell('K81')->getValue(),
								"SUB_JUMLAH_RATA_TR_TRANS_REND" => $sheet->getCell('K82')->getValue(),
								"JUMLAHRATA_TR_REND" => $sheet->getCell('K83')->getValue(),
								"JUMLAH_RATA_RATA_TS_TR_REND" => $sheet->getCell('K84')->getValue(),
								);
	      $arr_pabrikasi = array(
	      						"PERIODE" => $PERIODE, 
	      						"UNIT" => $this->namapg, 
	      						"AWAL_GILING" => $AWAL_GILING, 
	      						"AKHIR_GILING" => $AKHIR_GILING, 
	      						"GKP_I" => $sheet->getCell('E92')->getValue(), 
								"GKP_II" => $sheet->getCell('E93')->getValue(),
								"TETES" => $sheet->getCell('E94')->getValue(),
								"KAP_GILING_EXCL_KES" => $sheet->getCell('E7')->getValue(),
								"KAP_GILING_INCL_KIS_TNP_HR" => $sheet->getCell('E8')->getValue(),
								"KAP_GILING_INCL_KIS_DG_HR" => $sheet->getCell('E9')->getValue(),
								"PERSEN_JAM_STOP_LUAR_PG_TANPA_HR" => $sheet->getCell('E101')->getValue(),
								"PERSEN_JAM_STOP_LUAR_PG_DG_HR" => $sheet->getCell('E102')->getValue(),
								"PERSEN_JAM_STOP_DALAM_PG" => $sheet->getCell('E103')->getValue(),
								"HARI_GIL_EXCL_JAM_STOP" => $sheet->getCell('E104')->getValue(),
								"HARI_GIL_INCL_JAM_STOP_TANPA_HR" => $sheet->getCell('E105')->getValue(),
								"HARI_GIL_INCL_JAM_STOP_DG_HR" => $sheet->getCell('E106')->getValue(),
								"SABUT_PERSEN_TEBU" => $sheet->getCell('E108')->getValue(),
								"IMBIBISI_PERSEN_SABUT" => $sheet->getCell('E109')->getValue(),
								"KADAR_NIRA_TEBU" => $sheet->getCell('E110')->getValue(),
								"HPG_125" => $sheet->getCell('E111')->getValue(),
								"HPB_TOTAL" => $sheet->getCell('E112')->getValue(),
								"PSHK" => $sheet->getCell('E113')->getValue(),
								"NILAI_NIRA_NPP" => $sheet->getCell('E114')->getValue(),
								"ME" => $sheet->getCell('E115')->getValue(),
								"BHR" => $sheet->getCell('E116')->getValue(),
								"OR_PABRIKASI" => $sheet->getCell('E117')->getValue(),
								"HK_NIRA_MENTAH" => $sheet->getCell('E119')->getValue(),
								"HK_TETES" => $sheet->getCell('E120')->getValue(),
								"RENDEMEN_WINTER" => $sheet->getCell('E121')->getValue(),
								"FAKTOR_RENDEMEN" => $sheet->getCell('E122')->getValue(),
								"RENDEMEN_KETEL" => $sheet->getCell('E124')->getValue(),
								"KCALBRIX_NMENTAH" => $sheet->getCell('E125')->getValue(),
								"KG_UAPKG_TEBU" => $sheet->getCell('E126')->getValue(),
								"TON_GKP_I_LALU" => $sheet->getCell('E129')->getValue(),
								"TON_GKP_II_LALU" => $sheet->getCell('E130')->getValue(),
								"TON_GKP_I_INI" => $sheet->getCell('E132')->getValue(),
								"TON_GKP_II_INI" => $sheet->getCell('E133')->getValue(),
								"TON_TETES_INI" => $sheet->getCell('E134')->getValue(),
								"LEMBAR_KARUNG" => $sheet->getCell('E135')->getValue(),
								"KRISTAL_PG" => $sheet->getCell('E137')->getValue(),
								"KRISTAL_PETANI" => $sheet->getCell('E138')->getValue(),
								"KRISTAL_EX_TS" => $sheet->getCell('E139')->getValue()
	      					);
			$arr_rincian_gula = array(
							"PERIODE" => $PERIODE, 
							"UNIT" => $this->namapg, 
      						"AWAL_GILING" => $AWAL_GILING, 
      						"AKHIR_GILING" => $AKHIR_GILING,
							"GKP_I_EX_TEBU_SENDIRI" => $sheet->getCell('K93')->getValue(),
							"GKP_II_EX_TEBU_SENDIRI" => $sheet->getCell('K94')->getValue(),
							"JUMLAH_EX_TEBU_SENDIRI" => $sheet->getCell('K95')->getValue(),
							"GKP_I_BAGIAN_PG" => $sheet->getCell('K99')->getValue(),
							"GKP_II_BAGIAN_PG" => $sheet->getCell('K100')->getValue(),
							"JUMLAH_BAGIAN_PG" => $sheet->getCell('K101')->getValue(),
							"GKP_I_BAGIAN_PTR" => $sheet->getCell('K104')->getValue(),
							"GKP_II_BAGIAN_PTR" => $sheet->getCell('K105')->getValue(),
							"JUMLAH_BAGIAN_PTR" => $sheet->getCell('K106')->getValue(),
							"GKP_I_JUMLAH_EX_TR" => $sheet->getCell('K109')->getValue(),
							"GKP_II_JUMLAH_EX_TR" => $sheet->getCell('K110')->getValue(),
							"JUMLAH_JUMLAH_EX_TR" => $sheet->getCell('K111')->getValue(),
							"GKP_I_EX_GULA_SISAN" => $sheet->getCell('K114')->getValue(),
							"GKP_II_EX_GULA_SISAN" => $sheet->getCell('K115')->getValue(),
							"JUMLAH_EX_GULA_SISAN" => $sheet->getCell('K116')->getValue(),
							"GKP_I_EX_ROW_SUGAR" => $sheet->getCell('K119')->getValue(),
							"GKP_II_EX_ROW_SUGAR" => $sheet->getCell('K120')->getValue(),
							"JUMLAH_EX_ROW_SUGAR" => $sheet->getCell('K121')->getValue(),
							"JUMLAH" => $sheet->getCell('K122')->getValue(),
							"TETES_HAK_PETANI" => $sheet->getCell('K124')->getValue()

				);
	      $this->crud_model->insert('telgil_produksi', $arr_produksi);
	      $this->crud_model->insert('telgil_fabrikasi', $arr_pabrikasi);
	      $this->crud_model->insert('telgil_rincian_gula', $arr_rincian_gula);
	
    }

    public function saveExcelEvaluasi()
    {
    	$file = $this->input->get('file');
    	$method = $this->input->get('method');
    	// include 'PHPExcel/IOFactory.php';
    	$this->load->library("excel");

		$inputFileName = './assets/uploads/files/'.$file;

		//  Read your Excel workbook
		try {
		    $inputFileType = PHPExcel_IOFactory::identify($inputFileName);
		    $objReader = PHPExcel_IOFactory::createReader($inputFileType);
		    $objPHPExcel = $objReader->load($inputFileName);
		} catch(Exception $e) {
		    die('Error loading file "'.pathinfo($inputFileName,PATHINFO_BASENAME).'": '.$e->getMessage());
		}

		$objPHPExcelGET = new PHPExcel();
		//  Get worksheet dimensions
		$sheet = $objPHPExcel->getSheet(0); 
		$highestRow = $sheet->getHighestRow(); 
		$highestColumn = $sheet->getHighestColumn();


			$arr_evaluasi = array(
					"PERIODE" => PHPExcel_Style_NumberFormat::toFormattedString($sheet->getCell('D5')->getValue(),  'YYYY-MM-DD'),
					"UNIT" => $this->namapg,
					"TEBU_SENDIRI_LUAS_HA_INI" => $sheet->getCell('E11')->getValue(),
					"TEBU_PETANI_LUAS_HA_INI" => $sheet->getCell('E12')->getValue(),
					"JUMLAH_LUAS_HA_INI" => $sheet->getCell('E13')->getValue(),
					"TEBU_SENDIRI_TEBU_DIGILING_TON_INI" => $sheet->getCell('E15')->getValue(),
					"TEBU_PETANI_TEBU_DIGILING_TON_INI" => $sheet->getCell('E16')->getValue(),
					"JUMLAH_TEBU_DIGILING_TON_INI" => $sheet->getCell('E17')->getValue(),
					"TEBU_SENDIRI_HABLUR_HASILTON_INI" => $sheet->getCell('E19')->getValue(),
					"TEBU_PETANI_HABLUR_HASILTON_INI" => $sheet->getCell('E20')->getValue(),
					"JUMLAH_HABLUR_HASILTON_INI" => $sheet->getCell('E21')->getValue(),
					"TEBU_SENDIRI_RENDEMEN_INI" => $sheet->getCell('E23')->getValue(),
					"TEBU_PETANI_RENDEMEN_INI" => $sheet->getCell('E24')->getValue(),
					"JUMLAH_RENDEMEN_INI" => $sheet->getCell('E25')->getValue(),
					"TEBU_SENDIRI_PRODUKTIVITAS_TON_TEBUHA_INI" => $sheet->getCell('E27')->getValue(),
					"TEBU_PETANI_PRODUKTIVITAS_TON_TEBUHA_INI" => $sheet->getCell('E28')->getValue(),
					"JUMLAH_PRODUKTIVITAS_TON_TEBUHA_INI" => $sheet->getCell('E29')->getValue(),
					"TEBU_SENDIRI_HABLUR__HA_TONHA_INI" => $sheet->getCell('E31')->getValue(),
					"TEBU_PETANI_HABLUR__HA_TONHA_INI" => $sheet->getCell('E32')->getValue(),
					"JUMLAH_HABLUR__HA_TONHA_INI" => $sheet->getCell('E33')->getValue(),
					"MILIK_PG_HABLUR_MILIK_TON_INI" => $sheet->getCell('E35')->getValue(),
					"MILIK_PETANI_HABLUR_MILIK_TON_INI" => $sheet->getCell('E36')->getValue(),
					"JUMLAH_HABLUR_MILIK_TON_INI" => $sheet->getCell('E37')->getValue(),
					"MILIK_PG_GULA_MILIK_INI" => $sheet->getCell('E39')->getValue(),
					"MILIK_PETANI_GULA_MILIK_INI" => $sheet->getCell('E40')->getValue(),
					"JUMLAH_GULA_MILIK_INI" => $sheet->getCell('E41')->getValue(),
					"MILIK_PG_PRODUKSI_TETES_TON_INI" => $sheet->getCell('E43')->getValue(),
					"MILIK_PETANI_PRODUKSI_TETES_TON_INI" => $sheet->getCell('E44')->getValue(),
					"JUMLAH_PRODUKSI_TETES_TON_INI" => $sheet->getCell('E45')->getValue(),
					"PERSEN_POL_TEBU_INI" => $sheet->getCell('E46')->getValue(),
					"PERSEN_BRIX_TEBU_INI" => $sheet->getCell('E47')->getValue(),
					"NILAI_NIRA_INI" => $sheet->getCell('E48')->getValue(),
					"KADAR_NIRA_TEBU_INI" => $sheet->getCell('E49')->getValue(),
					"KECGILING_EXCL_TON_INI" => $sheet->getCell('E51')->getValue(),
					"KECGILING_INCL_TANPA_HARI_RAYA_TON_INI" => $sheet->getCell('E52')->getValue(),
					"KECGILING_INCL_HARI_RAYA_TON_INI" => $sheet->getCell('E53')->getValue(),
					"PERSEN_JAM_BERHENTI_A_TANPA_HARI_RAYA_LUAR_INI" => $sheet->getCell('E54')->getValue(),
					"PERSEN_JAM_BERHENTI_A_DENGAN_HARI_RAYA_LUAR_INI" => $sheet->getCell('E55')->getValue(),
					"PERSEN_JAM_BERHENTI_BDALAM_INI" => $sheet->getCell('E56')->getValue(),
					"JAM_BERHENTI_PERSEN_JAM_GILING_INI" => $sheet->getCell('E57')->getValue(),
					"NIRA_MENTAH_PERSEN_TEBU_INI" => $sheet->getCell('E58')->getValue(),
					"IMBIBISI_PERSEN_SABUT_INI" => $sheet->getCell('E59')->getValue(),
					"HPB_I_INI" => $sheet->getCell('E60')->getValue(),
					"HPB_TOTAL_INI" => $sheet->getCell('E61')->getValue(),
					"HPG_INI" => $sheet->getCell('E62')->getValue(),
					"HPG_125_INI" => $sheet->getCell('E63')->getValue(),
					"POL_AMPAS_INI" => $sheet->getCell('E64')->getValue(),
					"PERSEN_BAHAN_KERING_AMPAS_INI" => $sheet->getCell('E65')->getValue(),
					"SABUT_PERSEN_TEBU_INI" => $sheet->getCell('E66')->getValue(),
					"PSHK_INI" => $sheet->getCell('E67')->getValue(),
					"NIRA_ASLI_HILANG_PERSEN_SABUT_INI" => $sheet->getCell('E68')->getValue(),
					"EFISIENSI_GILINGAN_INI" => $sheet->getCell('E69')->getValue(),
					"POL_BLOTONG_INI" => $sheet->getCell('E71')->getValue(),
					"PENGASINGAN_BUKAN_GULA_INI" => $sheet->getCell('E72')->getValue(),
					"KG_AIR_DIUAPKANM2_LPJBP_INI" => $sheet->getCell('E73')->getValue(),
					"KEHILANGAN_POL_PERSEN_POL_NM_INI" => $sheet->getCell('E74')->getValue(),
					"WINTER_RENDEMEN_INI" => $sheet->getCell('E75')->getValue(),
					"BHR__INI" => $sheet->getCell('E76')->getValue(),
					"POL_HASIL_PERSEN_POL_NIRA_MENTAH_INI" => $sheet->getCell('E77')->getValue(),
					"POL_HILANG_DALAM_AMPAS_INI" => $sheet->getCell('E78')->getValue(),
					"POL_HILANG_DALAM_BLOTONG_INI" => $sheet->getCell('E79')->getValue(),
					"POL_HILANG_DALAM_TETES_INI" => $sheet->getCell('E80')->getValue(),
					"POL_HILANG_TAK_DIKETAHUI_OV_INI" => $sheet->getCell('E81')->getValue(),
					"TOTAL_KEHILANGAN_INI" => $sheet->getCell('E82')->getValue(),
					"EFFISIENSI_PABRIK_INI" => $sheet->getCell('E84')->getValue(),
					"OVERALL_RECOVERY_INI" => $sheet->getCell('E85')->getValue(),
					"FAKTOR_RENDEMEN_INI" => $sheet->getCell('E86')->getValue(),
					"RENDEMEN_EFEKTIF_INI" => $sheet->getCell('E87')->getValue(),
					"HK_NIRA_MENTAH_INI" => $sheet->getCell('E88')->getValue(),
					"KEHIL_POL_PERSEN_POL_NM_INI" => $sheet->getCell('E89')->getValue(),
					"KAPUR_KG_INI" => $sheet->getCell('E91')->getValue(),
					"KAPUR__100_TON_TEBU_INI" => $sheet->getCell('E92')->getValue(),
					"BELERANG_KG_INI" => $sheet->getCell('E93')->getValue(),
					"BELERANG__100_TON_TEBU_INI" => $sheet->getCell('E94')->getValue(),
					"ASAM_PHOSPHAT_KG_INI" => $sheet->getCell('E95')->getValue(),
					"ASAM_PHOSPHAT__100_TON_TEBU_INI" => $sheet->getCell('E96')->getValue(),
					"FLOCULANT_KG_INI" => $sheet->getCell('E97')->getValue(),
					"FLOCULANT__100_TON_TEBU_INI" => $sheet->getCell('E98')->getValue(),
					"FILTER_AID_KG_INI" => $sheet->getCell('E99')->getValue(),
					"FILTER_AID__100_TON_TEBU_INI" => $sheet->getCell('E100')->getValue(),
					"PELUNAK_KERAK_KG_INI" => $sheet->getCell('E101')->getValue(),
					"PELUNAK_KERAK__100_TON_TEBU_INI" => $sheet->getCell('E102')->getValue(),
					"MASAKAN_PERSEN_TEBU_INI_A" => $sheet->getCell('E104')->getValue(),
					"PERSEN_BRIX_MASAKAN_INI_A" => $sheet->getCell('E105')->getValue(),
					"HK_MASAKAN_INI_A" => $sheet->getCell('E106')->getValue(),
					"PURITY_DROP_INI_A" => $sheet->getCell('E107')->getValue(),
					"KRISTAL_PERSEN_POL_INI_A" => $sheet->getCell('E108')->getValue(),
					"MASAKAN_PERSEN_TEBU_INI_B" => $sheet->getCell('E110')->getValue(),
					"PERSEN_BRIX_MASAKAN_INI_B" => $sheet->getCell('E111')->getValue(),
					"HK_MASAKAN_INI_B" => $sheet->getCell('E112')->getValue(),
					"PURITY_DROP_INI_B" => $sheet->getCell('E113')->getValue(),
					"KRISTAL_PERSEN_POL_INI_B" => $sheet->getCell('E114')->getValue(),
					"MASAKAN_PERSEN_TEBU_INI_C" => $sheet->getCell('E116')->getValue(),
					"PERSEN_BRIX_MASAKAN_INI_C" => $sheet->getCell('E117')->getValue(),
					"HK_MASAKAN_INI_C" => $sheet->getCell('E118')->getValue(),
					"PURITY_DROP_INI_C" => $sheet->getCell('E119')->getValue(),
					"KRISTAL_PERSEN_POL_INI_C" => $sheet->getCell('E120')->getValue(),
					"MASAKAN_PERSEN_TEBU_INI_D" => $sheet->getCell('E122')->getValue(),
					"PERSEN_BRIX_MASAKAN_INI_D" => $sheet->getCell('E123')->getValue(),
					"HK_MASAKAN_INI_D" => $sheet->getCell('E124')->getValue(),
					"PURITY_DROP_INI_D" => $sheet->getCell('E125')->getValue(),
					"KRISTAL_PERSEN_POL_INI_D" => $sheet->getCell('E126')->getValue(),
					"JUMLAH_MASAKAN_PERSEN_TEBU_INI" => $sheet->getCell('E127')->getValue(),
					"TETES_PERSEN_TEBU_INI" => $sheet->getCell('E128')->getValue(),
					"PERSEN_BRIX_TETES_INI" => $sheet->getCell('E129')->getValue(),
					"HK_TETES_INI" => $sheet->getCell('E130')->getValue(),
					"POL_TETES_PERSEN_NIRA_MENTAH_INI" => $sheet->getCell('E131')->getValue(),
					"RENDEMEN_KETEL_INI" => $sheet->getCell('E133')->getValue(),
					"KG_UAP_KG_TEBU_INI" => $sheet->getCell('E134')->getValue(),
					"PEMAKAIAN_BBA_TON_INI" => $sheet->getCell('E135')->getValue(),
					"TEBU_TERBAKAR_TS_TON_INI" => $sheet->getCell('E137')->getValue(),
					"TEBU_TERBAKAR_TR_TON_INI" => $sheet->getCell('E138')->getValue(),
					"JUMLAH_INI" => $sheet->getCell('E139')->getValue(),
					"GULA_SISAN_EX_TAHUN_LALU_INI" => $sheet->getCell('E141')->getValue(),
					"RE_PROSES_EX_TAHUN_LALU_INI" => $sheet->getCell('E142')->getValue(),
					

					"TEBU_SENDIRI_LUAS_HA_SD_INI" => $sheet->getCell('F11')->getValue(),
					"TEBU_PETANI_LUAS_HA_SD_INI" => $sheet->getCell('F12')->getValue(),
					"JUMLAH_LUAS_HA_SD_INI" => $sheet->getCell('F13')->getValue(),
					"TEBU_SENDIRI_TEBU_DIGILING_TON_SD_INI" => $sheet->getCell('F15')->getValue(),
					"TEBU_PETANI_TEBU_DIGILING_TON_SD_INI" => $sheet->getCell('F16')->getValue(),
					"JUMLAH_TEBU_DIGILING_TON_SD_INI" => $sheet->getCell('F17')->getValue(),
					"TEBU_SENDIRI_HABLUR_HASILTON_SD_INI" => $sheet->getCell('F19')->getValue(),
					"TEBU_PETANI_HABLUR_HASILTON_SD_INI" => $sheet->getCell('F20')->getValue(),
					"JUMLAH_HABLUR_HASILTON_SD_INI" => $sheet->getCell('F21')->getValue(),
					"TEBU_SENDIRI_RENDEMEN_SD_INI" => $sheet->getCell('F23')->getValue(),
					"TEBU_PETANI_RENDEMEN_SD_INI" => $sheet->getCell('F24')->getValue(),
					"JUMLAH_RENDEMEN_SD_INI" => $sheet->getCell('F25')->getValue(),
					"TEBU_SENDIRI_PRODUKTIVITAS_TON_TEBUHA_SD_INI" => $sheet->getCell('F27')->getValue(),
					"TEBU_PETANI_PRODUKTIVITAS_TON_TEBUHA_SD_INI" => $sheet->getCell('F28')->getValue(),
					"JUMLAH_PRODUKTIVITAS_TON_TEBUHA_SD_INI" => $sheet->getCell('F29')->getValue(),
					"TEBU_SENDIRI_HABLUR__HA_TONHA_SD_INI" => $sheet->getCell('F31')->getValue(),
					"TEBU_PETANI_HABLUR__HA_TONHA_SD_INI" => $sheet->getCell('F32')->getValue(),
					"JUMLAH_HABLUR__HA_TONHA_SD_INI" => $sheet->getCell('F33')->getValue(),
					"MILIK_PG_HABLUR_MILIK_TON_SD_INI" => $sheet->getCell('F35')->getValue(),
					"MILIK_PETANI_HABLUR_MILIK_TON_SD_INI" => $sheet->getCell('F36')->getValue(),
					"JUMLAH_HABLUR_MILIK_TON_SD_INI" => $sheet->getCell('F37')->getValue(),
					"MILIK_PG_GULA_MILIK_SD_INI" => $sheet->getCell('F39')->getValue(),
					"MILIK_PETANI_GULA_MILIK_SD_INI" => $sheet->getCell('F40')->getValue(),
					"JUMLAH_GULA_MILIK_SD_INI" => $sheet->getCell('F41')->getValue(),
					"MILIK_PG_PRODUKSI_TETES_TON_SD_INI" => $sheet->getCell('F43')->getValue(),
					"MILIK_PETANI_PRODUKSI_TETES_TON_SD_INI" => $sheet->getCell('F44')->getValue(),
					"JUMLAH_PRODUKSI_TETES_TON_SD_INI" => $sheet->getCell('F45')->getValue(),
					"PERSEN_POL_TEBU_SD_INI" => $sheet->getCell('F46')->getValue(),
					"PERSEN_BRIX_TEBU_SD_INI" => $sheet->getCell('F47')->getValue(),
					"NILAI_NIRA_SD_INI" => $sheet->getCell('F48')->getValue(),
					"KADAR_NIRA_TEBU_SD_INI" => $sheet->getCell('F49')->getValue(),
					"KECGILING_EXCL_TON_SD_INI" => $sheet->getCell('F51')->getValue(),
					"KECGILING_INCL_TANPA_HARI_RAYA_TON_SD_INI" => $sheet->getCell('F52')->getValue(),
					"KECGILING_INCL_HARI_RAYA_TON_SD_INI" => $sheet->getCell('F53')->getValue(),
					"PERSEN_JAM_BERHENTI_A_TANPA_HARI_RAYA_LUAR_SD_INI" => $sheet->getCell('F54')->getValue(),
					"PERSEN_JAM_BERHENTI_A_DENGAN_HARI_RAYA_LUAR_SD_INI" => $sheet->getCell('F55')->getValue(),
					"PERSEN_JAM_BERHENTI_BDALAM_SD_INI" => $sheet->getCell('F56')->getValue(),
					"JAM_BERHENTI_PERSEN_JAM_GILING_SD_INI" => $sheet->getCell('F57')->getValue(),
					"NIRA_MENTAH_PERSEN_TEBU_SD_INI" => $sheet->getCell('F58')->getValue(),
					"IMBIBISI_PERSEN_SABUT_SD_INI" => $sheet->getCell('F59')->getValue(),
					"HPB_I_SD_INI" => $sheet->getCell('F60')->getValue(),
					"HPB_TOTAL_SD_INI" => $sheet->getCell('F61')->getValue(),
					"HPG_SD_INI" => $sheet->getCell('F62')->getValue(),
					"HPG_125_SD_INI" => $sheet->getCell('F63')->getValue(),
					"POL_AMPAS_SD_INI" => $sheet->getCell('F64')->getValue(),
					"PERSEN_BAHAN_KERING_AMPAS_SD_INI" => $sheet->getCell('F65')->getValue(),
					"SABUT_PERSEN_TEBU_SD_INI" => $sheet->getCell('F66')->getValue(),
					"PSHK_SD_INI" => $sheet->getCell('F67')->getValue(),
					"NIRA_ASLI_HILANG_PERSEN_SABUT_SD_INI" => $sheet->getCell('F68')->getValue(),
					"EFISIENSI_GILINGAN_SD_INI" => $sheet->getCell('F69')->getValue(),
					"POL_BLOTONG_SD_INI" => $sheet->getCell('F71')->getValue(),
					"PENGASINGAN_BUKAN_GULA_SD_INI" => $sheet->getCell('F72')->getValue(),
					"KG_AIR_DIUAPKANM2_LPJBP_SD_INI" => $sheet->getCell('F73')->getValue(),
					"KEHILANGAN_POL_PERSEN_POL_NM_SD_INI" => $sheet->getCell('F74')->getValue(),
					"WINTER_RENDEMEN_SD_INI" => $sheet->getCell('F75')->getValue(),
					"BHR__SD_INI" => $sheet->getCell('F76')->getValue(),
					"POL_HASIL_PERSEN_POL_NIRA_MENTAH_SD_INI" => $sheet->getCell('F77')->getValue(),
					"POL_HILANG_DALAM_AMPAS_SD_INI" => $sheet->getCell('F78')->getValue(),
					"POL_HILANG_DALAM_BLOTONG_SD_INI" => $sheet->getCell('F79')->getValue(),
					"POL_HILANG_DALAM_TETES_SD_INI" => $sheet->getCell('F80')->getValue(),
					"POL_HILANG_TAK_DIKETAHUI_OV_SD_INI" => $sheet->getCell('F81')->getValue(),
					"TOTAL_KEHILANGAN_SD_INI" => $sheet->getCell('F82')->getValue(),
					"EFFISIENSI_PABRIK_SD_INI" => $sheet->getCell('F84')->getValue(),
					"OVERALL_RECOVERY_SD_INI" => $sheet->getCell('F85')->getValue(),
					"FAKTOR_RENDEMEN_SD_INI" => $sheet->getCell('F86')->getValue(),
					"RENDEMEN_EFEKTIF_SD_INI" => $sheet->getCell('F87')->getValue(),
					"HK_NIRA_MENTAH_SD_INI" => $sheet->getCell('F88')->getValue(),
					"KEHIL_POL_PERSEN_POL_NM_SD_INI" => $sheet->getCell('F89')->getValue(),
					"KAPUR_KG_SD_INI" => $sheet->getCell('F91')->getValue(),
					"KAPUR__100_TON_TEBU_SD_INI" => $sheet->getCell('F92')->getValue(),
					"BELERANG_KG_SD_INI" => $sheet->getCell('F93')->getValue(),
					"BELERANG__100_TON_TEBU_SD_INI" => $sheet->getCell('F94')->getValue(),
					"ASAM_PHOSPHAT_KG_SD_INI" => $sheet->getCell('F95')->getValue(),
					"ASAM_PHOSPHAT__100_TON_TEBU_SD_INI" => $sheet->getCell('F96')->getValue(),
					"FLOCULANT_KG_SD_INI" => $sheet->getCell('F97')->getValue(),
					"FLOCULANT__100_TON_TEBU_SD_INI" => $sheet->getCell('F98')->getValue(),
					"FILTER_AID_KG_SD_INI" => $sheet->getCell('F99')->getValue(),
					"FILTER_AID__100_TON_TEBU_SD_INI" => $sheet->getCell('F100')->getValue(),
					"PELUNAK_KERAK_KG_SD_INI" => $sheet->getCell('F101')->getValue(),
					"PELUNAK_KERAK__100_TON_TEBU_SD_INI" => $sheet->getCell('F102')->getValue(),
					"MASAKAN_PERSEN_TEBU_SD_INI_A" => $sheet->getCell('F104')->getValue(),
					"PERSEN_BRIX_MASAKAN_SD_INI_A" => $sheet->getCell('F105')->getValue(),
					"HK_MASAKAN_SD_INI_A" => $sheet->getCell('F106')->getValue(),
					"PURITY_DROP_SD_INI_A" => $sheet->getCell('F107')->getValue(),
					"KRISTAL_PERSEN_POL_SD_INI_A" => $sheet->getCell('F108')->getValue(),
					"MASAKAN_PERSEN_TEBU_SD_INI_B" => $sheet->getCell('F110')->getValue(),
					"PERSEN_BRIX_MASAKAN_SD_INI_B" => $sheet->getCell('F111')->getValue(),
					"HK_MASAKAN_SD_INI_B" => $sheet->getCell('F112')->getValue(),
					"PURITY_DROP_SD_INI_B" => $sheet->getCell('F113')->getValue(),
					"KRISTAL_PERSEN_POL_SD_INI_B" => $sheet->getCell('F114')->getValue(),
					"MASAKAN_PERSEN_TEBU_SD_INI_C" => $sheet->getCell('F116')->getValue(),
					"PERSEN_BRIX_MASAKAN_SD_INI_C" => $sheet->getCell('F117')->getValue(),
					"HK_MASAKAN_SD_INI_C" => $sheet->getCell('F118')->getValue(),
					"PURITY_DROP_SD_INI_C" => $sheet->getCell('F119')->getValue(),
					"KRISTAL_PERSEN_POL_SD_INI_C" => $sheet->getCell('F120')->getValue(),
					"MASAKAN_PERSEN_TEBU_SD_INI_D" => $sheet->getCell('F122')->getValue(),
					"PERSEN_BRIX_MASAKAN_SD_INI_D" => $sheet->getCell('F123')->getValue(),
					"HK_MASAKAN_SD_INI_D" => $sheet->getCell('F124')->getValue(),
					"PURITY_DROP_SD_INI_D" => $sheet->getCell('F125')->getValue(),
					"KRISTAL_PERSEN_POL_SD_INI_D" => $sheet->getCell('F126')->getValue(),
					"JUMLAH_MASAKAN_PERSEN_TEBU_SD_INI" => $sheet->getCell('F127')->getValue(),
					"TETES_PERSEN_TEBU_SD_INI" => $sheet->getCell('F128')->getValue(),
					"PERSEN_BRIX_TETES_SD_INI" => $sheet->getCell('F129')->getValue(),
					"HK_TETES_SD_INI" => $sheet->getCell('F130')->getValue(),
					"POL_TETES_PERSEN_NIRA_MENTAH_SD_INI" => $sheet->getCell('F131')->getValue(),
					"RENDEMEN_KETEL_SD_INI" => $sheet->getCell('F133')->getValue(),
					"KG_UAP_KG_TEBU_SD_INI" => $sheet->getCell('F134')->getValue(),
					"PEMAKAIAN_BBA_TON_SD_INI" => $sheet->getCell('F135')->getValue(),
					"TEBU_TERBAKAR_TS_TON_SD_INI" => $sheet->getCell('F137')->getValue(),
					"TEBU_TERBAKAR_TR_TON_SD_INI" => $sheet->getCell('F138')->getValue(),
					"JUMLAH_SD_INI" => $sheet->getCell('F139')->getValue(),
					"GULA_SISAN_EX_TAHUN_LALU_SD_INI" => $sheet->getCell('F141')->getValue(),
					"RE_PROSES_EX_TAHUN_LALU_SD_INI" => $sheet->getCell('F142')->getValue(),
					

					"TEBU_SENDIRI_LUAS_HA_THN_LALU_SD_INI" => $sheet->getCell('G11')->getValue(),
					"TEBU_PETANI_LUAS_HA_THN_LALU_SD_INI" => $sheet->getCell('G12')->getValue(),
					"JUMLAH_LUAS_HA_THN_LALU_SD_INI" => $sheet->getCell('G13')->getValue(),
					"TEBU_SENDIRI_TEBU_DIGILING_TON_THN_LALU_SD_INI" => $sheet->getCell('G15')->getValue(),
					"TEBU_PETANI_TEBU_DIGILING_TON_THN_LALU_SD_INI" => $sheet->getCell('G16')->getValue(),
					"JUMLAH_TEBU_DIGILING_TON_THN_LALU_SD_INI" => $sheet->getCell('G17')->getValue(),
					"TEBU_SENDIRI_HABLUR_HASILTON_THN_LALU_SD_INI" => $sheet->getCell('G19')->getValue(),
					"TEBU_PETANI_HABLUR_HASILTON_THN_LALU_SD_INI" => $sheet->getCell('G20')->getValue(),
					"JUMLAH_HABLUR_HASILTON_THN_LALU_SD_INI" => $sheet->getCell('G21')->getValue(),
					"TEBU_SENDIRI_RENDEMEN_THN_LALU_SD_INI" => $sheet->getCell('G23')->getValue(),
					"TEBU_PETANI_RENDEMEN_THN_LALU_SD_INI" => $sheet->getCell('G24')->getValue(),
					"JUMLAH_RENDEMEN_THN_LALU_SD_INI" => $sheet->getCell('G25')->getValue(),
					"TEBU_SENDIRI_PRODUKTIVITAS_TON_TEBUHA_THN_LALU_SD_INI" => $sheet->getCell('G27')->getValue(),
					"TEBU_PETANI_PRODUKTIVITAS_TON_TEBUHA_THN_LALU_SD_INI" => $sheet->getCell('G28')->getValue(),
					"JUMLAH_PRODUKTIVITAS_TON_TEBUHA_THN_LALU_SD_INI" => $sheet->getCell('G29')->getValue(),
					"TEBU_SENDIRI_HABLUR__HA_TONHA_THN_LALU_SD_INI" => $sheet->getCell('G31')->getValue(),
					"TEBU_PETANI_HABLUR__HA_TONHA_THN_LALU_SD_INI" => $sheet->getCell('G32')->getValue(),
					"JUMLAH_HABLUR__HA_TONHA_THN_LALU_SD_INI" => $sheet->getCell('G33')->getValue(),
					"MILIK_PG_HABLUR_MILIK_TON_THN_LALU_SD_INI" => $sheet->getCell('G35')->getValue(),
					"MILIK_PETANI_HABLUR_MILIK_TON_THN_LALU_SD_INI" => $sheet->getCell('G36')->getValue(),
					"JUMLAH_HABLUR_MILIK_TON_THN_LALU_SD_INI" => $sheet->getCell('G37')->getValue(),
					"MILIK_PG_GULA_MILIK_THN_LALU_SD_INI" => $sheet->getCell('G39')->getValue(),
					"MILIK_PETANI_GULA_MILIK_THN_LALU_SD_INI" => $sheet->getCell('G40')->getValue(),
					"JUMLAH_GULA_MILIK_THN_LALU_SD_INI" => $sheet->getCell('G41')->getValue(),
					"MILIK_PG_PRODUKSI_TETES_TON_THN_LALU_SD_INI" => $sheet->getCell('G43')->getValue(),
					"MILIK_PETANI_PRODUKSI_TETES_TON_THN_LALU_SD_INI" => $sheet->getCell('G44')->getValue(),
					"JUMLAH_PRODUKSI_TETES_TON_THN_LALU_SD_INI" => $sheet->getCell('G45')->getValue(),
					"PERSEN_POL_TEBU_THN_LALU_SD_INI" => $sheet->getCell('G46')->getValue(),
					"PERSEN_BRIX_TEBU_THN_LALU_SD_INI" => $sheet->getCell('G47')->getValue(),
					"NILAI_NIRA_THN_LALU_SD_INI" => $sheet->getCell('G48')->getValue(),
					"KADAR_NIRA_TEBU_THN_LALU_SD_INI" => $sheet->getCell('G49')->getValue(),
					"KECGILING_EXCL_TON_THN_LALU_SD_INI" => $sheet->getCell('G51')->getValue(),
					"KECGILING_INCL_TANPA_HARI_RAYA_TON_THN_LALU_SD_INI" => $sheet->getCell('G52')->getValue(),
					"KECGILING_INCL_HARI_RAYA_TON_THN_LALU_SD_INI" => $sheet->getCell('G53')->getValue(),
					"PERSEN_JAM_BERHENTI_A_TANPA_HARI_RAYA_LUAR_THN_LALU_SD_INI" => $sheet->getCell('G54')->getValue(),
					"PERSEN_JAM_BERHENTI_A_DENGAN_HARI_RAYA_LUAR_THN_LALU_SD_INI" => $sheet->getCell('G55')->getValue(),
					"PERSEN_JAM_BERHENTI_BDALAM_THN_LALU_SD_INI" => $sheet->getCell('G56')->getValue(),
					"JAM_BERHENTI_PERSEN_JAM_GILING_THN_LALU_SD_INI" => $sheet->getCell('G57')->getValue(),
					"NIRA_MENTAH_PERSEN_TEBU_THN_LALU_SD_INI" => $sheet->getCell('G58')->getValue(),
					"IMBIBISI_PERSEN_SABUT_THN_LALU_SD_INI" => $sheet->getCell('G59')->getValue(),
					"HPB_I_THN_LALU_SD_INI" => $sheet->getCell('G60')->getValue(),
					"HPB_TOTAL_THN_LALU_SD_INI" => $sheet->getCell('G61')->getValue(),
					"HPG_THN_LALU_SD_INI" => $sheet->getCell('G62')->getValue(),
					"HPG_125_THN_LALU_SD_INI" => $sheet->getCell('G63')->getValue(),
					"POL_AMPAS_THN_LALU_SD_INI" => $sheet->getCell('G64')->getValue(),
					"PERSEN_BAHAN_KERING_AMPAS_THN_LALU_SD_INI" => $sheet->getCell('G65')->getValue(),
					"SABUT_PERSEN_TEBU_THN_LALU_SD_INI" => $sheet->getCell('G66')->getValue(),
					"PSHK_THN_LALU_SD_INI" => $sheet->getCell('G67')->getValue(),
					"NIRA_ASLI_HILANG_PERSEN_SABUT_THN_LALU_SD_INI" => $sheet->getCell('G68')->getValue(),
					"EFISIENSI_GILINGAN_THN_LALU_SD_INI" => $sheet->getCell('G69')->getValue(),
					"POL_BLOTONG_THN_LALU_SD_INI" => $sheet->getCell('G71')->getValue(),
					"PENGASINGAN_BUKAN_GULA_THN_LALU_SD_INI" => $sheet->getCell('G72')->getValue(),
					"KG_AIR_DIUAPKANM2_LPJBP_THN_LALU_SD_INI" => $sheet->getCell('G73')->getValue(),
					"KEHILANGAN_POL_PERSEN_POL_NM_THN_LALU_SD_INI" => $sheet->getCell('G74')->getValue(),
					"WINTER_RENDEMEN_THN_LALU_SD_INI" => $sheet->getCell('G75')->getValue(),
					"BHR__THN_LALU_SD_INI" => $sheet->getCell('G76')->getValue(),
					"POL_HASIL_PERSEN_POL_NIRA_MENTAH_THN_LALU_SD_INI" => $sheet->getCell('G77')->getValue(),
					"POL_HILANG_DALAM_AMPAS_THN_LALU_SD_INI" => $sheet->getCell('G78')->getValue(),
					"POL_HILANG_DALAM_BLOTONG_THN_LALU_SD_INI" => $sheet->getCell('G79')->getValue(),
					"POL_HILANG_DALAM_TETES_THN_LALU_SD_INI" => $sheet->getCell('G80')->getValue(),
					"POL_HILANG_TAK_DIKETAHUI_OV_THN_LALU_SD_INI" => $sheet->getCell('G81')->getValue(),
					"TOTAL_KEHILANGAN_THN_LALU_SD_INI" => $sheet->getCell('G82')->getValue(),
					"EFFISIENSI_PABRIK_THN_LALU_SD_INI" => $sheet->getCell('G84')->getValue(),
					"OVERALL_RECOVERY_THN_LALU_SD_INI" => $sheet->getCell('G85')->getValue(),
					"FAKTOR_RENDEMEN_THN_LALU_SD_INI" => $sheet->getCell('G86')->getValue(),
					"RENDEMEN_EFEKTIF_THN_LALU_SD_INI" => $sheet->getCell('G87')->getValue(),
					"HK_NIRA_MENTAH_THN_LALU_SD_INI" => $sheet->getCell('G88')->getValue(),
					"KEHIL_POL_PERSEN_POL_NM_THN_LALU_SD_INI" => $sheet->getCell('G89')->getValue(),
					"KAPUR_KG_THN_LALU_SD_INI" => $sheet->getCell('G91')->getValue(),
					"KAPUR__100_TON_TEBU_THN_LALU_SD_INI" => $sheet->getCell('G92')->getValue(),
					"BELERANG_KG_THN_LALU_SD_INI" => $sheet->getCell('G93')->getValue(),
					"BELERANG__100_TON_TEBU_THN_LALU_SD_INI" => $sheet->getCell('G94')->getValue(),
					"ASAM_PHOSPHAT_KG_THN_LALU_SD_INI" => $sheet->getCell('G95')->getValue(),
					"ASAM_PHOSPHAT__100_TON_TEBU_THN_LALU_SD_INI" => $sheet->getCell('G96')->getValue(),
					"FLOCULANT_KG_THN_LALU_SD_INI" => $sheet->getCell('G97')->getValue(),
					"FLOCULANT__100_TON_TEBU_THN_LALU_SD_INI" => $sheet->getCell('G98')->getValue(),
					"FILTER_AID_KG_THN_LALU_SD_INI" => $sheet->getCell('G99')->getValue(),
					"FILTER_AID__100_TON_TEBU_THN_LALU_SD_INI" => $sheet->getCell('G100')->getValue(),
					"PELUNAK_KERAK_KG_THN_LALU_SD_INI" => $sheet->getCell('G101')->getValue(),
					"PELUNAK_KERAK__100_TON_TEBU_THN_LALU_SD_INI" => $sheet->getCell('G102')->getValue(),
					"MASAKAN_PERSEN_TEBU_THN_LALU_SD_INI_A" => $sheet->getCell('G104')->getValue(),
					"PERSEN_BRIX_MASAKAN_THN_LALU_SD_INI_A" => $sheet->getCell('G105')->getValue(),
					"HK_MASAKAN_THN_LALU_SD_INI_A" => $sheet->getCell('G106')->getValue(),
					"PURITY_DROP_THN_LALU_SD_INI_A" => $sheet->getCell('G107')->getValue(),
					"KRISTAL_PERSEN_POL_THN_LALU_SD_INI_A" => $sheet->getCell('G108')->getValue(),
					"MASAKAN_PERSEN_TEBU_THN_LALU_SD_INI_B" => $sheet->getCell('G110')->getValue(),
					"PERSEN_BRIX_MASAKAN_THN_LALU_SD_INI_B" => $sheet->getCell('G111')->getValue(),
					"HK_MASAKAN_THN_LALU_SD_INI_B" => $sheet->getCell('G112')->getValue(),
					"PURITY_DROP_THN_LALU_SD_INI_B" => $sheet->getCell('G113')->getValue(),
					"KRISTAL_PERSEN_POL_THN_LALU_SD_INI_B" => $sheet->getCell('G114')->getValue(),
					"MASAKAN_PERSEN_TEBU_THN_LALU_SD_INI_C" => $sheet->getCell('G116')->getValue(),
					"PERSEN_BRIX_MASAKAN_THN_LALU_SD_INI_C" => $sheet->getCell('G117')->getValue(),
					"HK_MASAKAN_THN_LALU_SD_INI_C" => $sheet->getCell('G118')->getValue(),
					"PURITY_DROP_THN_LALU_SD_INI_C" => $sheet->getCell('G119')->getValue(),
					"KRISTAL_PERSEN_POL_THN_LALU_SD_INI_C" => $sheet->getCell('G120')->getValue(),
					"MASAKAN_PERSEN_TEBU_THN_LALU_SD_INI_D" => $sheet->getCell('G122')->getValue(),
					"PERSEN_BRIX_MASAKAN_THN_LALU_SD_INI_D" => $sheet->getCell('G123')->getValue(),
					"HK_MASAKAN_THN_LALU_SD_INI_D" => $sheet->getCell('G124')->getValue(),
					"PURITY_DROP_THN_LALU_SD_INI_D" => $sheet->getCell('G125')->getValue(),
					"KRISTAL_PERSEN_POL_THN_LALU_SD_INI_D" => $sheet->getCell('G126')->getValue(),
					"JUMLAH_MASAKAN_PERSEN_TEBU_THN_LALU_SD_INI" => $sheet->getCell('G127')->getValue(),
					"TETES_PERSEN_TEBU_THN_LALU_SD_INI" => $sheet->getCell('G128')->getValue(),
					"PERSEN_BRIX_TETES_THN_LALU_SD_INI" => $sheet->getCell('G129')->getValue(),
					"HK_TETES_THN_LALU_SD_INI" => $sheet->getCell('G130')->getValue(),
					"POL_TETES_PERSEN_NIRA_MENTAH_THN_LALU_SD_INI" => $sheet->getCell('G131')->getValue(),
					"RENDEMEN_KETEL_THN_LALU_SD_INI" => $sheet->getCell('G133')->getValue(),
					"KG_UAP_KG_TEBU_THN_LALU_SD_INI" => $sheet->getCell('G134')->getValue(),
					"PEMAKAIAN_BBA_TON_THN_LALU_SD_INI" => $sheet->getCell('G135')->getValue(),
					"TEBU_TERBAKAR_TS_TON_THN_LALU_SD_INI" => $sheet->getCell('G137')->getValue(),
					"TEBU_TERBAKAR_TR_TON_THN_LALU_SD_INI" => $sheet->getCell('G138')->getValue(),
					"JUMLAH_THN_LALU_SD_INI" => $sheet->getCell('G139')->getValue(),
					"GULA_SISAN_EX_TAHUN_LALU_THN_LALU_SD_INI" => $sheet->getCell('G141')->getValue(),
					"RE_PROSES_EX_TAHUN_LALU_THN_LALU_SD_INI" => $sheet->getCell('G142')->getValue(),
					

					"TEBU_SENDIRI_LUAS_HA_RKO" => $sheet->getCell('H11')->getValue(),
					"TEBU_PETANI_LUAS_HA_RKO" => $sheet->getCell('H12')->getValue(),
					"JUMLAH_LUAS_HA_RKO" => $sheet->getCell('H13')->getValue(),
					"TEBU_SENDIRI_TEBU_DIGILING_TON_RKO" => $sheet->getCell('H15')->getValue(),
					"TEBU_PETANI_TEBU_DIGILING_TON_RKO" => $sheet->getCell('H16')->getValue(),
					"JUMLAH_TEBU_DIGILING_TON_RKO" => $sheet->getCell('H17')->getValue(),
					"TEBU_SENDIRI_HABLUR_HASILTON_RKO" => $sheet->getCell('H19')->getValue(),
					"TEBU_PETANI_HABLUR_HASILTON_RKO" => $sheet->getCell('H20')->getValue(),
					"JUMLAH_HABLUR_HASILTON_RKO" => $sheet->getCell('H21')->getValue(),
					"TEBU_SENDIRI_RENDEMEN_RKO" => $sheet->getCell('H23')->getValue(),
					"TEBU_PETANI_RENDEMEN_RKO" => $sheet->getCell('H24')->getValue(),
					"JUMLAH_RENDEMEN_RKO" => $sheet->getCell('H25')->getValue(),
					"TEBU_SENDIRI_PRODUKTIVITAS_TON_TEBUHA_RKO" => $sheet->getCell('H27')->getValue(),
					"TEBU_PETANI_PRODUKTIVITAS_TON_TEBUHA_RKO" => $sheet->getCell('H28')->getValue(),
					"JUMLAH_PRODUKTIVITAS_TON_TEBUHA_RKO" => $sheet->getCell('H29')->getValue(),
					"TEBU_SENDIRI_HABLUR__HA_TONHA_RKO" => $sheet->getCell('H31')->getValue(),
					"TEBU_PETANI_HABLUR__HA_TONHA_RKO" => $sheet->getCell('H32')->getValue(),
					"JUMLAH_HABLUR__HA_TONHA_RKO" => $sheet->getCell('H33')->getValue(),
					"MILIK_PG_HABLUR_MILIK_TON_RKO" => $sheet->getCell('H35')->getValue(),
					"MILIK_PETANI_HABLUR_MILIK_TON_RKO" => $sheet->getCell('H36')->getValue(),
					"JUMLAH_HABLUR_MILIK_TON_RKO" => $sheet->getCell('H37')->getValue(),
					"MILIK_PG_GULA_MILIK_RKO" => $sheet->getCell('H39')->getValue(),
					"MILIK_PETANI_GULA_MILIK_RKO" => $sheet->getCell('H40')->getValue(),
					"JUMLAH_GULA_MILIK_RKO" => $sheet->getCell('H41')->getValue(),
					"MILIK_PG_PRODUKSI_TETES_TON_RKO" => $sheet->getCell('H43')->getValue(),
					"MILIK_PETANI_PRODUKSI_TETES_TON_RKO" => $sheet->getCell('H44')->getValue(),
					"JUMLAH_PRODUKSI_TETES_TON_RKO" => $sheet->getCell('H45')->getValue(),
					"PERSEN_POL_TEBU_RKO" => $sheet->getCell('H46')->getValue(),
					"PERSEN_BRIX_TEBU_RKO" => $sheet->getCell('H47')->getValue(),
					"NILAI_NIRA_RKO" => $sheet->getCell('H48')->getValue(),
					"KADAR_NIRA_TEBU_RKO" => $sheet->getCell('H49')->getValue(),
					"KECGILING_EXCL_TON_RKO" => $sheet->getCell('H51')->getValue(),
					"KECGILING_INCL_TANPA_HARI_RAYA_TON_RKO" => $sheet->getCell('H52')->getValue(),
					"KECGILING_INCL_HARI_RAYA_TON_RKO" => $sheet->getCell('H53')->getValue(),
					"PERSEN_JAM_BERHENTI_A_TANPA_HARI_RAYA_LUAR_RKO" => $sheet->getCell('H54')->getValue(),
					"PERSEN_JAM_BERHENTI_A_DENGAN_HARI_RAYA_LUAR_RKO" => $sheet->getCell('H55')->getValue(),
					"PERSEN_JAM_BERHENTI_BDALAM_RKO" => $sheet->getCell('H56')->getValue(),
					"JAM_BERHENTI_PERSEN_JAM_GILING_RKO" => $sheet->getCell('H57')->getValue(),
					"NIRA_MENTAH_PERSEN_TEBU_RKO" => $sheet->getCell('H58')->getValue(),
					"IMBIBISI_PERSEN_SABUT_RKO" => $sheet->getCell('H59')->getValue(),
					"HPB_I_RKO" => $sheet->getCell('H60')->getValue(),
					"HPB_TOTAL_RKO" => $sheet->getCell('H61')->getValue(),
					"HPG_RKO" => $sheet->getCell('H62')->getValue(),
					"HPG_125_RKO" => $sheet->getCell('H63')->getValue(),
					"POL_AMPAS_RKO" => $sheet->getCell('H64')->getValue(),
					"PERSEN_BAHAN_KERING_AMPAS_RKO" => $sheet->getCell('H65')->getValue(),
					"SABUT_PERSEN_TEBU_RKO" => $sheet->getCell('H66')->getValue(),
					"PSHK_RKO" => $sheet->getCell('H67')->getValue(),
					"NIRA_ASLI_HILANG_PERSEN_SABUT_RKO" => $sheet->getCell('H68')->getValue(),
					"EFISIENSI_GILINGAN_RKO" => $sheet->getCell('H69')->getValue(),
					"POL_BLOTONG_RKO" => $sheet->getCell('H71')->getValue(),
					"PENGASINGAN_BUKAN_GULA_RKO" => $sheet->getCell('H72')->getValue(),
					"KG_AIR_DIUAPKANM2_LPJBP_RKO" => $sheet->getCell('H73')->getValue(),
					"KEHILANGAN_POL_PERSEN_POL_NM_RKO" => $sheet->getCell('H74')->getValue(),
					"WINTER_RENDEMEN_RKO" => $sheet->getCell('H75')->getValue(),
					"BHR__RKO" => $sheet->getCell('H76')->getValue(),
					"POL_HASIL_PERSEN_POL_NIRA_MENTAH_RKO" => $sheet->getCell('H77')->getValue(),
					"POL_HILANG_DALAM_AMPAS_RKO" => $sheet->getCell('H78')->getValue(),
					"POL_HILANG_DALAM_BLOTONG_RKO" => $sheet->getCell('H79')->getValue(),
					"POL_HILANG_DALAM_TETES_RKO" => $sheet->getCell('H80')->getValue(),
					"POL_HILANG_TAK_DIKETAHUI_OV_RKO" => $sheet->getCell('H81')->getValue(),
					"TOTAL_KEHILANGAN_RKO" => $sheet->getCell('H82')->getValue(),
					"EFFISIENSI_PABRIK_RKO" => $sheet->getCell('H84')->getValue(),
					"OVERALL_RECOVERY_RKO" => $sheet->getCell('H85')->getValue(),
					"FAKTOR_RENDEMEN_RKO" => $sheet->getCell('H86')->getValue(),
					"RENDEMEN_EFEKTIF_RKO" => $sheet->getCell('H87')->getValue(),
					"HK_NIRA_MENTAH_RKO" => $sheet->getCell('H88')->getValue(),
					"KEHIL_POL_PERSEN_POL_NM_RKO" => $sheet->getCell('H89')->getValue(),
					"KAPUR_KG_RKO" => $sheet->getCell('H91')->getValue(),
					"KAPUR__100_TON_TEBU_RKO" => $sheet->getCell('H92')->getValue(),
					"BELERANG_KG_RKO" => $sheet->getCell('H93')->getValue(),
					"BELERANG__100_TON_TEBU_RKO" => $sheet->getCell('H94')->getValue(),
					"ASAM_PHOSPHAT_KG_RKO" => $sheet->getCell('H95')->getValue(),
					"ASAM_PHOSPHAT__100_TON_TEBU_RKO" => $sheet->getCell('H96')->getValue(),
					"FLOCULANT_KG_RKO" => $sheet->getCell('H97')->getValue(),
					"FLOCULANT__100_TON_TEBU_RKO" => $sheet->getCell('H98')->getValue(),
					"FILTER_AID_KG_RKO" => $sheet->getCell('H99')->getValue(),
					"FILTER_AID__100_TON_TEBU_RKO" => $sheet->getCell('H100')->getValue(),
					"PELUNAK_KERAK_KG_RKO" => $sheet->getCell('H101')->getValue(),
					"PELUNAK_KERAK__100_TON_TEBU_RKO" => $sheet->getCell('H102')->getValue(),
					"MASAKAN_PERSEN_TEBU_RKO_A" => $sheet->getCell('H104')->getValue(),
					"PERSEN_BRIX_MASAKAN_RKO_A" => $sheet->getCell('H105')->getValue(),
					"HK_MASAKAN_RKO_A" => $sheet->getCell('H106')->getValue(),
					"PURITY_DROP_RKO_A" => $sheet->getCell('H107')->getValue(),
					"KRISTAL_PERSEN_POL_RKO_A" => $sheet->getCell('H108')->getValue(),
					"MASAKAN_PERSEN_TEBU_RKO_B" => $sheet->getCell('H110')->getValue(),
					"PERSEN_BRIX_MASAKAN_RKO_B" => $sheet->getCell('H111')->getValue(),
					"HK_MASAKAN_RKO_B" => $sheet->getCell('H112')->getValue(),
					"PURITY_DROP_RKO_B" => $sheet->getCell('H113')->getValue(),
					"KRISTAL_PERSEN_POL_RKO_B" => $sheet->getCell('H114')->getValue(),
					"MASAKAN_PERSEN_TEBU_RKO_C" => $sheet->getCell('H116')->getValue(),
					"PERSEN_BRIX_MASAKAN_RKO_C" => $sheet->getCell('H117')->getValue(),
					"HK_MASAKAN_RKO_C" => $sheet->getCell('H118')->getValue(),
					"PURITY_DROP_RKO_C" => $sheet->getCell('H119')->getValue(),
					"KRISTAL_PERSEN_POL_RKO_C" => $sheet->getCell('H120')->getValue(),
					"MASAKAN_PERSEN_TEBU_RKO_D" => $sheet->getCell('H122')->getValue(),
					"PERSEN_BRIX_MASAKAN_RKO_D" => $sheet->getCell('H123')->getValue(),
					"HK_MASAKAN_RKO_D" => $sheet->getCell('H124')->getValue(),
					"PURITY_DROP_RKO_D" => $sheet->getCell('H125')->getValue(),
					"KRISTAL_PERSEN_POL_RKO_D" => $sheet->getCell('H126')->getValue(),
					"JUMLAH_MASAKAN_PERSEN_TEBU_RKO" => $sheet->getCell('H127')->getValue(),
					"TETES_PERSEN_TEBU_RKO" => $sheet->getCell('H128')->getValue(),
					"PERSEN_BRIX_TETES_RKO" => $sheet->getCell('H129')->getValue(),
					"HK_TETES_RKO" => $sheet->getCell('H130')->getValue(),
					"POL_TETES_PERSEN_NIRA_MENTAH_RKO" => $sheet->getCell('H131')->getValue(),
					"RENDEMEN_KETEL_RKO" => $sheet->getCell('H133')->getValue(),
					"KG_UAP_KG_TEBU_RKO" => $sheet->getCell('H134')->getValue(),
					"PEMAKAIAN_BBA_TON_RKO" => $sheet->getCell('H135')->getValue(),
					"TEBU_TERBAKAR_TS_TON_RKO" => $sheet->getCell('H137')->getValue(),
					"TEBU_TERBAKAR_TR_TON_RKO" => $sheet->getCell('H138')->getValue(),
					"JUMLAH_RKO" => $sheet->getCell('H139')->getValue(),
					"GULA_SISAN_EX_TAHUN_LALU_RKO" => $sheet->getCell('H141')->getValue(),
					"RE_PROSES_EX_TAHUN_LALU_RKO" => $sheet->getCell('H142')->getValue(),
					

					"TEBU_SENDIRI_LUAS_HA_RKAP" => $sheet->getCell('IE11')->getValue(),
					"TEBU_PETANI_LUAS_HA_RKAP" => $sheet->getCell('IE12')->getValue(),
					"JUMLAH_LUAS_HA_RKAP" => $sheet->getCell('IE13')->getValue(),
					"TEBU_SENDIRI_TEBU_DIGILING_TON_RKAP" => $sheet->getCell('IE15')->getValue(),
					"TEBU_PETANI_TEBU_DIGILING_TON_RKAP" => $sheet->getCell('IE16')->getValue(),
					"JUMLAH_TEBU_DIGILING_TON_RKAP" => $sheet->getCell('IE17')->getValue(),
					"TEBU_SENDIRI_HABLUR_HASILTON_RKAP" => $sheet->getCell('IE19')->getValue(),
					"TEBU_PETANI_HABLUR_HASILTON_RKAP" => $sheet->getCell('IE20')->getValue(),
					"JUMLAH_HABLUR_HASILTON_RKAP" => $sheet->getCell('IE21')->getValue(),
					"TEBU_SENDIRI_RENDEMEN_RKAP" => $sheet->getCell('IE23')->getValue(),
					"TEBU_PETANI_RENDEMEN_RKAP" => $sheet->getCell('IE24')->getValue(),
					"JUMLAH_RENDEMEN_RKAP" => $sheet->getCell('IE25')->getValue(),
					"TEBU_SENDIRI_PRODUKTIVITAS_TON_TEBUHA_RKAP" => $sheet->getCell('IE27')->getValue(),
					"TEBU_PETANI_PRODUKTIVITAS_TON_TEBUHA_RKAP" => $sheet->getCell('IE28')->getValue(),
					"JUMLAH_PRODUKTIVITAS_TON_TEBUHA_RKAP" => $sheet->getCell('IE29')->getValue(),
					"TEBU_SENDIRI_HABLUR__HA_TONHA_RKAP" => $sheet->getCell('IE31')->getValue(),
					"TEBU_PETANI_HABLUR__HA_TONHA_RKAP" => $sheet->getCell('IE32')->getValue(),
					"JUMLAH_HABLUR__HA_TONHA_RKAP" => $sheet->getCell('IE33')->getValue(),
					"MILIK_PG_HABLUR_MILIK_TON_RKAP" => $sheet->getCell('IE35')->getValue(),
					"MILIK_PETANI_HABLUR_MILIK_TON_RKAP" => $sheet->getCell('IE36')->getValue(),
					"JUMLAH_HABLUR_MILIK_TON_RKAP" => $sheet->getCell('IE37')->getValue(),
					"MILIK_PG_GULA_MILIK_RKAP" => $sheet->getCell('IE39')->getValue(),
					"MILIK_PETANI_GULA_MILIK_RKAP" => $sheet->getCell('IE40')->getValue(),
					"JUMLAH_GULA_MILIK_RKAP" => $sheet->getCell('IE41')->getValue(),
					"MILIK_PG_PRODUKSI_TETES_TON_RKAP" => $sheet->getCell('IE43')->getValue(),
					"MILIK_PETANI_PRODUKSI_TETES_TON_RKAP" => $sheet->getCell('IE44')->getValue(),
					"JUMLAH_PRODUKSI_TETES_TON_RKAP" => $sheet->getCell('IE45')->getValue(),
					"PERSEN_POL_TEBU_RKAP" => $sheet->getCell('IE46')->getValue(),
					"PERSEN_BRIX_TEBU_RKAP" => $sheet->getCell('IE47')->getValue(),
					"NILAI_NIRA_RKAP" => $sheet->getCell('IE48')->getValue(),
					"KADAR_NIRA_TEBU_RKAP" => $sheet->getCell('IE49')->getValue(),
					"KECGILING_EXCL_TON_RKAP" => $sheet->getCell('IE51')->getValue(),
					"KECGILING_INCL_TANPA_HARI_RAYA_TON_RKAP" => $sheet->getCell('IE52')->getValue(),
					"KECGILING_INCL_HARI_RAYA_TON_RKAP" => $sheet->getCell('IE53')->getValue(),
					"PERSEN_JAM_BERHENTI_A_TANPA_HARI_RAYA_LUAR_RKAP" => $sheet->getCell('IE54')->getValue(),
					"PERSEN_JAM_BERHENTI_A_DENGAN_HARI_RAYA_LUAR_RKAP" => $sheet->getCell('IE55')->getValue(),
					"PERSEN_JAM_BERHENTI_BDALAM_RKAP" => $sheet->getCell('IE56')->getValue(),
					"JAM_BERHENTI_PERSEN_JAM_GILING_RKAP" => $sheet->getCell('IE57')->getValue(),
					"NIRA_MENTAH_PERSEN_TEBU_RKAP" => $sheet->getCell('IE58')->getValue(),
					"IMBIBISI_PERSEN_SABUT_RKAP" => $sheet->getCell('IE59')->getValue(),
					"HPB_I_RKAP" => $sheet->getCell('IE60')->getValue(),
					"HPB_TOTAL_RKAP" => $sheet->getCell('IE61')->getValue(),
					"HPG_RKAP" => $sheet->getCell('IE62')->getValue(),
					"HPG_125_RKAP" => $sheet->getCell('IE63')->getValue(),
					"POL_AMPAS_RKAP" => $sheet->getCell('IE64')->getValue(),
					"PERSEN_BAHAN_KERING_AMPAS_RKAP" => $sheet->getCell('IE65')->getValue(),
					"SABUT_PERSEN_TEBU_RKAP" => $sheet->getCell('IE66')->getValue(),
					"PSHK_RKAP" => $sheet->getCell('IE67')->getValue(),
					"NIRA_ASLI_HILANG_PERSEN_SABUT_RKAP" => $sheet->getCell('IE68')->getValue(),
					"EFISIENSI_GILINGAN_RKAP" => $sheet->getCell('IE69')->getValue(),
					"POL_BLOTONG_RKAP" => $sheet->getCell('IE71')->getValue(),
					"PENGASINGAN_BUKAN_GULA_RKAP" => $sheet->getCell('IE72')->getValue(),
					"KG_AIR_DIUAPKANM2_LPJBP_RKAP" => $sheet->getCell('IE73')->getValue(),
					"KEHILANGAN_POL_PERSEN_POL_NM_RKAP" => $sheet->getCell('IE74')->getValue(),
					"WINTER_RENDEMEN_RKAP" => $sheet->getCell('IE75')->getValue(),
					"BHR__RKAP" => $sheet->getCell('IE76')->getValue(),
					"POL_HASIL_PERSEN_POL_NIRA_MENTAH_RKAP" => $sheet->getCell('IE77')->getValue(),
					"POL_HILANG_DALAM_AMPAS_RKAP" => $sheet->getCell('IE78')->getValue(),
					"POL_HILANG_DALAM_BLOTONG_RKAP" => $sheet->getCell('IE79')->getValue(),
					"POL_HILANG_DALAM_TETES_RKAP" => $sheet->getCell('IE80')->getValue(),
					"POL_HILANG_TAK_DIKETAHUI_OV_RKAP" => $sheet->getCell('IE81')->getValue(),
					"TOTAL_KEHILANGAN_RKAP" => $sheet->getCell('IE82')->getValue(),
					"EFFISIENSI_PABRIK_RKAP" => $sheet->getCell('IE84')->getValue(),
					"OVERALL_RECOVERY_RKAP" => $sheet->getCell('IE85')->getValue(),
					"FAKTOR_RENDEMEN_RKAP" => $sheet->getCell('IE86')->getValue(),
					"RENDEMEN_EFEKTIF_RKAP" => $sheet->getCell('IE87')->getValue(),
					"HK_NIRA_MENTAH_RKAP" => $sheet->getCell('IE88')->getValue(),
					"KEHIL_POL_PERSEN_POL_NM_RKAP" => $sheet->getCell('IE89')->getValue(),
					"KAPUR_KG_RKAP" => $sheet->getCell('IE91')->getValue(),
					"KAPUR__100_TON_TEBU_RKAP" => $sheet->getCell('IE92')->getValue(),
					"BELERANG_KG_RKAP" => $sheet->getCell('IE93')->getValue(),
					"BELERANG__100_TON_TEBU_RKAP" => $sheet->getCell('IE94')->getValue(),
					"ASAM_PHOSPHAT_KG_RKAP" => $sheet->getCell('IE95')->getValue(),
					"ASAM_PHOSPHAT__100_TON_TEBU_RKAP" => $sheet->getCell('IE96')->getValue(),
					"FLOCULANT_KG_RKAP" => $sheet->getCell('IE97')->getValue(),
					"FLOCULANT__100_TON_TEBU_RKAP" => $sheet->getCell('IE98')->getValue(),
					"FILTER_AID_KG_RKAP" => $sheet->getCell('IE99')->getValue(),
					"FILTER_AID__100_TON_TEBU_RKAP" => $sheet->getCell('I100')->getValue(),
					"PELUNAK_KERAK_KG_RKAP" => $sheet->getCell('I101')->getValue(),
					"PELUNAK_KERAK__100_TON_TEBU_RKAP" => $sheet->getCell('I102')->getValue(),
					"MASAKAN_PERSEN_TEBU_RKAP_A" => $sheet->getCell('I104')->getValue(),
					"PERSEN_BRIX_MASAKAN_RKAP_A" => $sheet->getCell('I105')->getValue(),
					"HK_MASAKAN_RKAP_A" => $sheet->getCell('I106')->getValue(),
					"PURITY_DROP_RKAP_A" => $sheet->getCell('I107')->getValue(),
					"KRISTAL_PERSEN_POL_RKAP_A" => $sheet->getCell('I108')->getValue(),
					"MASAKAN_PERSEN_TEBU_RKAP_B" => $sheet->getCell('I110')->getValue(),
					"PERSEN_BRIX_MASAKAN_RKAP_B" => $sheet->getCell('I111')->getValue(),
					"HK_MASAKAN_RKAP_B" => $sheet->getCell('I112')->getValue(),
					"PURITY_DROP_RKAP_B" => $sheet->getCell('I113')->getValue(),
					"KRISTAL_PERSEN_POL_RKAP_B" => $sheet->getCell('I114')->getValue(),
					"MASAKAN_PERSEN_TEBU_RKAP_C" => $sheet->getCell('I116')->getValue(),
					"PERSEN_BRIX_MASAKAN_RKAP_C" => $sheet->getCell('I117')->getValue(),
					"HK_MASAKAN_RKAP_C" => $sheet->getCell('I118')->getValue(),
					"PURITY_DROP_RKAP_C" => $sheet->getCell('I119')->getValue(),
					"KRISTAL_PERSEN_POL_RKAP_C" => $sheet->getCell('I120')->getValue(),
					"MASAKAN_PERSEN_TEBU_RKAP_D" => $sheet->getCell('I122')->getValue(),
					"PERSEN_BRIX_MASAKAN_RKAP_D" => $sheet->getCell('I123')->getValue(),
					"HK_MASAKAN_RKAP_D" => $sheet->getCell('I124')->getValue(),
					"PURITY_DROP_RKAP_D" => $sheet->getCell('I125')->getValue(),
					"KRISTAL_PERSEN_POL_RKAP_D" => $sheet->getCell('I126')->getValue(),
					"JUMLAH_MASAKAN_PERSEN_TEBU_RKAP" => $sheet->getCell('I127')->getValue(),
					"TETES_PERSEN_TEBU_RKAP" => $sheet->getCell('I128')->getValue(),
					"PERSEN_BRIX_TETES_RKAP" => $sheet->getCell('I129')->getValue(),
					"HK_TETES_RKAP" => $sheet->getCell('I130')->getValue(),
					"POL_TETES_PERSEN_NIRA_MENTAH_RKAP" => $sheet->getCell('I131')->getValue(),
					"RENDEMEN_KETEL_RKAP" => $sheet->getCell('I133')->getValue(),
					"KG_UAP_KG_TEBU_RKAP" => $sheet->getCell('I134')->getValue(),
					"PEMAKAIAN_BBA_TON_RKAP" => $sheet->getCell('I135')->getValue(),
					"TEBU_TERBAKAR_TS_TON_RKAP" => $sheet->getCell('I137')->getValue(),
					"TEBU_TERBAKAR_TR_TON_RKAP" => $sheet->getCell('I138')->getValue(),
					"JUMLAH_RKAP" => $sheet->getCell('I139')->getValue(),
					"GULA_SISAN_EX_TAHUN_LALU_RKAP" => $sheet->getCell('I141')->getValue(),
					"RE_PROSES_EX_TAHUN_LALU_RKAP" => $sheet->getCell('I142')->getValue()
				);
	      $this->crud_model->insert('telgil_evaluasi', $arr_evaluasi);
	
    }

}
