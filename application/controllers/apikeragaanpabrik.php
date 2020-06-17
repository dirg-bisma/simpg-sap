<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Apikeragaanpabrik extends SB_Controller
{
    function jsonperjam($tgl, $jam)
	{

        $this->load->model('keragaanpabrikmodel');
		$data = $this->keragaanpabrikmodel->rekapDataJam($tgl, $jam);
		echo json_encode($data);
    }
    
    function htmlperjam($tgl, $jam)
    {
        $this->load->model('keragaanpabrikmodel');
        $data = $this->keragaanpabrikmodel->rekapDataJam($tgl, $jam);
        $html = '';
		$html .= '<tr style="font-size:14px"><td>T. Masuk</td>
		<td align="right"><b>'.@$data->digiling.'</b></td>
		<td align="right"><b>0</b></td>
		<td align="right"><b>0</b></td>
		</tr>';
		
		$html .= '<tr style="font-size:14px"><td>T. Giling</td>
		<td align="right"><b>'.@$data->digiling.'</b></td>
		<td align="right"><b>0</b></td>
		<td align="right"><b>0</b></td>
		</tr>';
		$html .= '<tr style="font-size:14px"><td>Sisa Tebu</td>
		<td align="right"><b>0</b></td>
		<td align="right"><b>0</b></td>
		<td align="right"><b>0</b></td>
		</tr>';
		$html .= '<tr style="font-size:14px"><td>Prod. Gula</td>
		<td align="right"><b>0</b></td>
		<td align="right"><b>0</b></td>
		<td align="right"><b>0</b></td>
		</tr>';
		
		$html .= '<tr style="font-size:8px;background:red"><td colspan="4" style="padding:0px">&nbsp;</td></tr>';
		
		$html .= '<tr style="font-size:14px"><td>Brix NPP</td>
		<td align="right"><b>'.@$data->brix_npp.'</b></td>
		<td align="right"><b>0</b></td>
		<td align="right"><b>0</b></td>
		</tr>';
		$html .= '<tr style="font-size:14px"><td>NM % TEBU</td>
		<td align="right"><b>'.@$data->nm_persen_tebu.'</b></td>
		<td align="right"><b>0</b></td>
		<td align="right"><b>0</b></td>
		</tr>';
		$html .= '<tr style="font-size:14px"><td>UAP BARU</td>
		<td align="right"><b>'.@$data->uap_baru.'</b></td>
		<td align="right"><b>0</b></td>
		<td align="right"><b>0</b></td>
		</tr>';
		$html .= '<tr style="font-size:14px"><td>UAP BEKAS</td>
		<td align="right"><b>'.@$data->uap_bekas.'</b></td>
		<td align="right"><b>0</b></td>
		<td align="right"><b>0</b></td>
		</tr>';
		$html .= '<tr style="font-size:14px"><td>SUHU PP I</td>
		<td align="right"><b>'.@$data->suhu_pp_i.'</b></td>
		<td align="right"><b>0</b></td>
		<td align="right"><b>0</b></td>
		</tr>';
		$html .= '<tr style="font-size:14px"><td>SUHU PP II</td>
		<td align="right"><b>'.@$data->suhu_pp_ii.'</b></td>
		<td align="right"><b>0</b></td>
		<td align="right"><b>0</b></td>
		</tr>';
		$html .= '<tr style="font-size:14px"><td>SUHU PP III</td>
		<td align="right"><b>'.@$data->suhu_pp_iii.'</b></td>
		<td align="right"><b>0</b></td>
		<td align="right"><b>0</b></td>
		</tr>';
		$html .= '<tr style="font-size:14px"><td>TURBIDITY</td>
		<td align="right"><b>'.@$data->turbidity.'</b></td>
		<td align="right"><b>0</b></td>
		<td align="right"><b>0</b></td>
		</tr>';
		$html .= '<tr style="font-size:14px"><td>V. EVA</td>
		<td align="right"><b>'.@$data->v_eva.'</b></td>
		<td align="right"><b>0</b></td>
		<td align="right"><b>0</b></td>
		</tr>';
		$html .= '<tr style="font-size:14px"><td>V. MASAKAN</td>
		<td align="right"><b>'.@$data->v_masakan.'</b></td>
		<td align="right"><b>0</b></td>
		<td align="right"><b>0</b></td>
		</tr>';
		$html .= '<tr style="font-size:14px"><td>Be NK</td>
		<td align="right"><b>'.@$data->be_nk.'</b></td>
		<td align="right"><b>0</b></td>
		<td align="right"><b>0</b></td>
        </tr>';
        echo $html;
    }
}