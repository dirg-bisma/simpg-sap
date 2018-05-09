<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Senddatatoserver extends CI_Controller {

	public function getViewSBH($date1, $date2)
	{
		$result = $this->db->query('SELECT * FROM vw_sbh_data a WHERE a.tgl_spta BETWEEN "'.$date1.'" AND "'.$date2.'"')->result();
		$url = 'http://localhost/simpgdb/index.php/dashboard/UploadSbh';
	    $ch = curl_init($url);
	    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
	    curl_setopt($ch, CURLOPT_POST, true);
	    $post = array(
	        "data" => base64_encode(json_encode($result))
	    );
	    curl_setopt($ch, CURLOPT_POSTFIELDS, $post); 
	    $response = curl_exec($ch);
	    echo $response;
	    curl_close($ch);

	}

	public function gett_spta($date1, $date2)
	{
		$result = $this->db->query('SELECT * FROM t_spta a WHERE a.tgl_spta BETWEEN "'.$date1.'" AND "'.$date2.'"')->result();
		$t_spta= 'http://localhost/simpgdb/index.php/dashboard/Uploadt_spta';
	    $ch = curl_int_spta($url);
	    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
	    curl_setopt($ch, CURLOPT_POST, true);
	    $post = array(
	        "data" => base64_encode(json_encode($result))
	    );
	    curl_setopt($ch, CURLOPT_POSTFIELDS, $post); 
	    $response = curl_exec($ch);
	    echo $response;
	    curl_close($ch);

	}
	public function gett_selektor($date1, $date2)
		{
			$result = $this->db->query('SELECT * FROM t_selektor a WHERE DATE(a.tgl_selektor) BETWEEN "'.$date1.'" AND "'.$date2.'"')->result();
			$url = 'http://localhost/simpgdb/index.php/dashboard/Uploadt_selektor';
		    $ch = curl_init($url);
		    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		    curl_setopt($ch, CURLOPT_POST, true);
		    $post = array(
		        "data" => base64_encode(json_encode($result))
		    );
		    curl_setopt($ch, CURLOPT_POSTFIELDS, $post); 
		    $response = curl_exec($ch);
		    echo $response;
		    curl_close($ch);

		}
	public function gett_timbangan($date1, $date2)
		{
			$result = $this->db->query('SELECT * FROM t_timbangan a WHERE DATE(a.tgl_netto) BETWEEN "'.$date1.'" AND "'.$date2.'"')->result();
			$url = 'http://localhost/simpgdb/index.php/dashboard/Uploadt_timbangan';
		    $ch = curl_init($url);
		    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		    curl_setopt($ch, CURLOPT_POST, true);
		    $post = array(
		        "data" => base64_encode(json_encode($result))
		    );
		    curl_setopt($ch, CURLOPT_POSTFIELDS, $post); 
		    $response = curl_exec($ch);
		    echo $response;
		    curl_close($ch);

		}
	public function gett_meja_tebu($date1, $date2)
		{
			$result = $this->db->query('SELECT * FROM t_meja_tebu a WHERE DATE(a.tgl_meja_tebu) BETWEEN "'.$date1.'" AND "'.$date2.'"')->result();
			$url = 'http://localhost/simpgdb/index.php/dashboard/Uploadt_meja_tebu';
		    $ch = curl_init($url);
		    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		    curl_setopt($ch, CURLOPT_POST, true);
		    $post = array(
		        "data" => base64_encode(json_encode($result))
		    );
		    curl_setopt($ch, CURLOPT_POSTFIELDS, $post); 
		    $response = curl_exec($ch);
		    echo $response;
		    curl_close($ch);

		}
	public function gett_ari($date1, $date2)
		{
			$result = $this->db->query('SELECT * FROM t_ari a WHERE DATE(a.tgl_ari) BETWEEN "'.$date1.'" AND "'.$date2.'"')->result();
			$url = 'http://localhost/simpgdb/index.php/dashboard/Uploadt_ari';
		    $ch = curl_init($url);
		    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		    curl_setopt($ch, CURLOPT_POST, true);
		    $post = array(
		        "data" => base64_encode(json_encode($result))
		    );
		    curl_setopt($ch, CURLOPT_POSTFIELDS, $post); 
		    $response = curl_exec($ch);
		    echo $response;
		    curl_close($ch);

		}

}

/* End of file senddatatoserver.php */
/* Location: .//C/Users/hendrik/AppData/Local/Temp/fz3temp-1/senddatatoserver.php */