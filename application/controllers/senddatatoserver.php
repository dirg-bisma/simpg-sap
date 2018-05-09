<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Senddatatoserver extends CI_Controller {

	public function syncByLog()
	{
		$result = $this->db->query('SELECT * FROM tb_logs_sync_process where t_status = 0')->result();
		foreach ($result as $key => $value) {
			if ($value->t_table === "t_spta") {
				$this->gett_spta($value->t_id);
			}else if ($value->t_table === "t_selektor") {
				$this->gett_selektor($value->t_id);
			}else if ($value->t_table === "t_timbangan") {
				$this->gett_timbangan($value->t_id);
			}else if ($value->t_table === "t_meja_tebu") {
				$this->gett_meja_tebu($value->t_id);
			}else if ($value->t_table === "t_ari") {
				$this->gett_ari($value->t_id);
			}
		$this->db->update('tb_logs_sync_process', array('t_status'=>1), array('id'=>$value->id));
		}

	}

	public function getViewSBH($id)
	{
		$result = $this->db->query('SELECT * FROM vw_sbh_data where id='.$id)->result();
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

	public function gett_spta($id)
	{
		$result = $this->db->query('SELECT * FROM t_spta where id='.$id)->result();
		$url= 'http://localhost/simpgdb/index.php/dashboard/Uploadt_spta';
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
	public function gett_selektor($id)
		{
			$result = $this->db->query('SELECT * FROM t_selektor where id_spta='.$id)->result();
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
	public function gett_timbangan($id)
		{
			$result = $this->db->query('SELECT * FROM t_timbangan where id_spat='.$id)->result();
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
	public function gett_meja_tebu($id)
		{
			$result = $this->db->query('SELECT * FROM t_meja_tebu where id_spat='.$id)->result();
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
	public function gett_ari($id)
		{
			$result = $this->db->query('SELECT * FROM t_ari where id_spat='.$id)->result();
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