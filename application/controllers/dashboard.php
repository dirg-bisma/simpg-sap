<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Dashboard extends SB_Controller {

    protected $layout 	= "layouts/main";
	public $module 		= 'penjualan';
	public $per_page	= '10';

	function __construct() {
		parent::__construct();
		
		
		if(!$this->session->userdata('logged_in')) redirect('user/login',301);
		
	}

	public function index()
	{
		$this->data = array();
		


		$this->data['content'] = $this->load->view('dashboard',$this->data,true);
		$this->load->view('layouts/main',$this->data);
	}
	
	public function postgantimejatebu(){
		$this->session->set_userdata(array(
				'gilingan'		=> $_POST['mejatebu']
			));
		redirect('dashboard');
	}

	public function getDashGiling()
	{
		$sql = "SELECT get_tgl_giling() AS tgl,jm.jam,IFNULL(ylsltruk.ttl,0) AS ylstruk,IFNULL(ylsllori.ttl,0) AS ylslori,IFNULL(sltruk.ttl,0) AS struk,IFNULL(sllori.ttl,0) AS slori,
IFNULL(yltimtruk.ttl,0) AS yltimtruk,IFNULL(yltimlori.ttl,0) AS yltimlori,IFNULL(timtruk.ttl,0) AS timtruk,IFNULL(timlori.ttl,0) AS timlori,
IFNULL(ylgiltruk.ttl,0) AS ylgiltruk,IFNULL(ylgillori.ttl,0) AS ylgillori,IFNULL(giltruk.ttl,0) AS giltruk,IFNULL(gillori.ttl,0) AS gillori FROM t_lap_jam jm 
LEFT JOIN (SELECT COUNT(id_spta) AS ttl,CONVERT(DATE_FORMAT(a.tgl_selektor,'%H') USING utf8) AS jam FROM t_selektor a
INNER JOIN t_spta b ON a.`id_spta`=b.`id` WHERE a.`tgl_urut`=get_tgl_giling() AND b.`jenis_spta`='TRUK' 
GROUP BY DATE_FORMAT(a.tgl_selektor,'%H')) AS sltruk ON sltruk.jam=jm.jam
LEFT JOIN (SELECT COUNT(id_spta) AS ttl,CONVERT(DATE_FORMAT(a.tgl_selektor,'%H') USING utf8) AS jam FROM t_selektor a
INNER JOIN t_spta b ON a.`id_spta`=b.`id` WHERE a.`tgl_urut`=get_tgl_giling() AND b.`jenis_spta`='LORI' 
GROUP BY DATE_FORMAT(a.tgl_selektor,'%H')) AS sllori ON sllori.jam=jm.jam 
LEFT JOIN (SELECT COUNT(id_spta) AS ttl,CONVERT(DATE_FORMAT(a.tgl_selektor,'%H') USING utf8) AS jam FROM t_selektor a
INNER JOIN t_spta b ON a.`id_spta`=b.`id` WHERE a.`tgl_urut`=DATE_ADD(get_tgl_giling(),INTERVAL -1 DAY) AND b.`jenis_spta`='TRUK' 
GROUP BY DATE_FORMAT(a.tgl_selektor,'%H')) AS ylsltruk ON ylsltruk.jam=jm.jam
LEFT JOIN (SELECT COUNT(id_spta) AS ttl,CONVERT(DATE_FORMAT(a.tgl_selektor,'%H') USING utf8) AS jam FROM t_selektor a
INNER JOIN t_spta b ON a.`id_spta`=b.`id` WHERE a.`tgl_urut`=DATE_ADD(get_tgl_giling(),INTERVAL -1 DAY) AND b.`jenis_spta`='LORI' 
GROUP BY DATE_FORMAT(a.tgl_selektor,'%H')) AS ylsllori ON ylsllori.jam=jm.jam 
LEFT JOIN (SELECT SUM(netto_final) AS ttl,CONVERT(DATE_FORMAT(b.timb_netto_tgl,'%H') USING utf8) AS jam FROM t_timbangan a
INNER JOIN t_spta b ON a.`id_spat`=b.`id` WHERE IF(STR_TO_DATE(timb_netto_tgl,'%Y-%m-%d %H:%i:%s') < STR_TO_DATE(CONCAT(DATE(timb_netto_tgl),' 06:59:59'),'%Y-%m-%d %H:%i:%s'),
STR_TO_DATE(timb_netto_tgl,'%Y-%m-%d') - INTERVAL 1 DAY, STR_TO_DATE(timb_netto_tgl,'%Y-%m-%d'))=get_tgl_giling() AND b.`jenis_spta`='TRUK' 
GROUP BY DATE_FORMAT(b.timb_netto_tgl,'%H')) AS timtruk ON timtruk.jam=jm.jam
LEFT JOIN (SELECT SUM(netto_final) AS ttl,CONVERT(DATE_FORMAT(b.timb_netto_tgl,'%H') USING utf8) AS jam FROM t_timbangan a
INNER JOIN t_spta b ON a.`id_spat`=b.`id` WHERE IF(STR_TO_DATE(timb_netto_tgl,'%Y-%m-%d %H:%i:%s') < STR_TO_DATE(CONCAT(DATE(timb_netto_tgl),' 06:59:59'),'%Y-%m-%d %H:%i:%s'),
STR_TO_DATE(timb_netto_tgl,'%Y-%m-%d') - INTERVAL 1 DAY, STR_TO_DATE(timb_netto_tgl,'%Y-%m-%d'))=get_tgl_giling() AND b.`jenis_spta`='LORI' 
GROUP BY DATE_FORMAT(b.timb_netto_tgl,'%H')) AS timlori ON timlori.jam=jm.jam
LEFT JOIN (SELECT SUM(netto_final) AS ttl,CONVERT(DATE_FORMAT(b.timb_netto_tgl,'%H') USING utf8) AS jam FROM t_timbangan a
INNER JOIN t_spta b ON a.`id_spat`=b.`id` WHERE IF(STR_TO_DATE(timb_netto_tgl,'%Y-%m-%d %H:%i:%s') < STR_TO_DATE(CONCAT(DATE(timb_netto_tgl),' 06:59:59'),'%Y-%m-%d %H:%i:%s'),
STR_TO_DATE(timb_netto_tgl,'%Y-%m-%d') - INTERVAL 1 DAY, STR_TO_DATE(timb_netto_tgl,'%Y-%m-%d'))=DATE_ADD(get_tgl_giling(),INTERVAL -1 DAY) AND b.`jenis_spta`='TRUK' 
GROUP BY DATE_FORMAT(b.timb_netto_tgl,'%H')) AS yltimtruk ON yltimtruk.jam=jm.jam
LEFT JOIN (SELECT SUM(netto_final) AS ttl,CONVERT(DATE_FORMAT(b.timb_netto_tgl,'%H') USING utf8) AS jam FROM t_timbangan a
INNER JOIN t_spta b ON a.`id_spat`=b.`id` WHERE IF(STR_TO_DATE(timb_netto_tgl,'%Y-%m-%d %H:%i:%s') < STR_TO_DATE(CONCAT(DATE(timb_netto_tgl),' 06:59:59'),'%Y-%m-%d %H:%i:%s'),
STR_TO_DATE(timb_netto_tgl,'%Y-%m-%d') - INTERVAL 1 DAY, STR_TO_DATE(timb_netto_tgl,'%Y-%m-%d'))=DATE_ADD(get_tgl_giling(),INTERVAL -1 DAY) AND b.`jenis_spta`='LORI' 
GROUP BY DATE_FORMAT(b.timb_netto_tgl,'%H')) AS yltimlori ON yltimlori.jam=jm.jam
LEFT JOIN (SELECT SUM(netto_final) AS ttl,CONVERT(DATE_FORMAT(b.timb_netto_tgl,'%H') USING utf8) AS jam FROM t_timbangan a
INNER JOIN t_spta b ON a.`id_spat`=b.`id` WHERE b.`tgl_giling`=get_tgl_giling() AND b.`jenis_spta`='TRUK' 
GROUP BY DATE_FORMAT(meja_tebu_tgl,'%H')) AS giltruk ON giltruk.jam=jm.jam
LEFT JOIN (SELECT SUM(netto_final) AS ttl,CONVERT(DATE_FORMAT(b.timb_netto_tgl,'%H') USING utf8) AS jam FROM t_timbangan a
INNER JOIN t_spta b ON a.`id_spat`=b.`id` WHERE b.`tgl_giling`=get_tgl_giling() AND b.`jenis_spta`='LORI' 
GROUP BY DATE_FORMAT(meja_tebu_tgl,'%H')) AS gillori ON gillori.jam=jm.jam
LEFT JOIN (SELECT SUM(netto_final) AS ttl,CONVERT(DATE_FORMAT(b.timb_netto_tgl,'%H') USING utf8) AS jam FROM t_timbangan a
INNER JOIN t_spta b ON a.`id_spat`=b.`id` WHERE b.`tgl_giling`=DATE_ADD(get_tgl_giling(),INTERVAL -1 DAY) AND b.`jenis_spta`='TRUK' 
GROUP BY DATE_FORMAT(meja_tebu_tgl,'%H')) AS ylgiltruk ON ylgiltruk.jam=jm.jam
LEFT JOIN (SELECT SUM(netto_final) AS ttl,CONVERT(DATE_FORMAT(b.timb_netto_tgl,'%H') USING utf8) AS jam FROM t_timbangan a
INNER JOIN t_spta b ON a.`id_spat`=b.`id` WHERE b.`tgl_giling`=DATE_ADD(get_tgl_giling(),INTERVAL -1 DAY) AND b.`jenis_spta`='LORI' 
GROUP BY DATE_FORMAT(meja_tebu_tgl,'%H')) AS ylgillori ON ylgillori.jam=jm.jam
 GROUP BY jm.`jam` ORDER BY jm.id ASC";

 		$ax = $this->db->query($sql)->result();
 		$htm = '';
 		foreach ($ax as $rw) {
 			$htm .= '
 			<tr>
 			<td style="text-align:center">'.$rw->jam.':00'.'</td>
 			<td style="text-align:center">'.$rw->ylstruk.'</td>
 			<td style="text-align:center">'.$rw->ylslori.'</td>
 			<td style="text-align:center">'.($rw->ylstruk+$rw->ylslori).'</td>
 			<td style="text-align:center">'.$rw->struk.'</td>
 			<td style="text-align:center">'.$rw->slori.'</td>
 			<td style="text-align:center">'.($rw->struk+$rw->slori).'</td>
 			<td style="text-align:center">'.number_format($rw->yltimtruk/1000,3).'</td>
 			<td style="text-align:center">'.number_format($rw->yltimlori/1000,3).'</td>
 			<td style="text-align:center">'.number_format(($rw->yltimlori+$rw->yltimtruk)/1000,3).'</td>
 			<td style="text-align:center">'.number_format($rw->timtruk/1000,3).'</td>
 			<td style="text-align:center">'.number_format($rw->timlori/1000,3).'</td>
 			<td style="text-align:center">'.number_format(($rw->timlori+$rw->timtruk)/1000,3).'</td>
 			<td style="text-align:center">'.number_format($rw->ylgiltruk/1000,3).'</td>
 			<td style="text-align:center">'.number_format($rw->ylgillori/1000,3).'</td>
 			<td style="text-align:center">'.number_format(($rw->ylgillori+$rw->ylgiltruk)/1000,3).'</td>
 			<td style="text-align:center">'.number_format($rw->giltruk/1000,3).'</td>
 			<td style="text-align:center">'.number_format($rw->gillori/1000,3).'</td>
 			<td style="text-align:center">'.number_format(($rw->giltruk+$rw->gillori)/1000,3).'</td></tr>';
 		}

 		echo $htm;
	}
	
	
	
	
	
}
