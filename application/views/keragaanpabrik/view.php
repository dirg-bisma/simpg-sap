<style type="text/css">
	table.tableizer-table {
		font-size: 12px;
		border: 1px solid #000000; 
		font-family: Arial, Helvetica, sans-serif;
		width:100%;
		margin	: 2px;
	} 
	.tableizer-table td {
		padding: 3px;
		margin: 2px;
		border: 1px solid #000000;

	}
	.tableizer-table th {
		background-color: #5499C7; 
		color: #000000;
		font-weight: bold;
		height:25px;padding:10px;
		border: 1px solid #000000;
	}
</style>
<table  style="height: 5px;font-family:Monospace;" border="0" width="100%" >
<tbody>
<tr>

<td align="left"  style="font-size:11px" colspan="4">
<b><?=CNF_NAMAPERUSAHAAN;?></b><br />
	<?=CNF_PG;?> 
	<?=CNF_ALAMAT;?>
</td>
<td align="center" style="font-size:13px" colspan="4">
LAPORAN KERAGAAN PABRIK HARI GILING KE <?php echo $_GET['hari']?><br />
TANGGAL <?php echo $hg->hg;?>

</td>
</tr>
</table>
<hr />
<table class="tableizer-table">

<thead>
	<tr class="tableizer-firstrow">
    <th align="center">Jam</th>
    <th align="center">DIGILING</th>
    <th align="center">BRIX NPP</th>
    <th align="center">NM % TEBU</th>
    <th align="center">UBA</th>
    <th align="center">UBE</th>
    <th align="center">SUHU PP I</th>
    <th align="center">SUHU PP II</th>
    <th align="center">SUHU PP III</th>
    <th align="center">TURBIDITY</th>
    <th align="center">V. EVA</th>
    <th align="center">V. MASAKAN</th>
    <th align="center">Be NK</th>
	</tr>
</thead>
<tbody>
<?php $cek = array();?>
<?php foreach($jam as $row_jam){?>
<tr>
	<?php $cek_jam = "";?>
	<?php foreach($row as $r){?>		
		<?php if($r->jam == $row_jam->jam){?>	
		<?php $cek_jam = $r->jam;?>	
		<td align="center"><?php echo $row_jam->jam;?></td>		
		<td align="right"><?php echo $r->digiling;?></td>
		<td align="right"><?php echo $r->brix_npp;?></td>
		<td align="right"><?php echo $r->nm_persen_tebu;?></td>
		<td align="right"><?php echo $r->uap_baru;?></td>
		<td align="right"><?php echo $r->uap_bekas;?></td>
		<td align="right"><?php echo $r->suhu_pp_i;?></td>
		<td align="right"><?php echo $r->suhu_pp_ii;?></td>
		<td align="right"><?php echo $r->suhu_pp_iii;?></td>
		<td align="right"><?php echo $r->turbidity;?></td>
		<td align="right"><?php echo $r->v_eva;?></td>
		<td align="right"><?php echo $r->v_masakan;?></td>
		<td align="right"><?php echo $r->be_nk;?></td>		
		<?php }?>
	<?php }?>
	<?php array_push($cek, $cek_jam);?>
	<?php if(!in_array($row_jam->jam, $cek)){?>
		<td align="center"><?php echo $row_jam->jam;?></td>
		<td align="right">-</td>
		<td align="right">-</td>
		<td align="right">-</td>
		<td align="right">-</td>
		<td align="right">-</td>
		<td align="right">-</td>
		<td align="right">-</td>
		<td align="right">-</td>
		<td align="right">-</td>
		<td align="right">-</td>
		<td align="right">-</td>
		<td align="right">-</td>
	<?php }?>

</tr>
<?php }?>
</tbody>
<tfoot><tr>
    <td > AVERAGE </td>
	<td align="right"><?php echo $avg->digiling;?></td>
	<td align="right"><?php echo $avg->brix_npp;?></td>
	<td align="right"><?php echo $avg->nm_persen_tebu;?></td>
	<td align="right"><?php echo $avg->uap_baru;?></td>
	<td align="right"><?php echo $avg->uap_bekas;?></td>
	<td align="right"><?php echo $avg->suhu_pp_i;?></td>
	<td align="right"><?php echo $avg->suhu_pp_ii;?></td>
	<td align="right"><?php echo $avg->suhu_pp_iii;?></td>
	<td align="right"><?php echo $avg->turbidity;?></td>
	<td align="right"><?php echo $avg->v_eva;?></td>
	<td align="right"><?php echo $avg->v_masakan;?></td>
	<td align="right"><?php echo $avg->be_nk;?></td>
	</tr></tfoot>
</table>
<hr />
<br>
<table class="tableizer-table" style="width:70%">
	<thead>
	<tr style="font-weight:bold;background:#104E8B;color:white">
		<th rowspan="2" style="text-align:center;vertical-align:middle">URAIAN</th>
		<th rowspan="2" style="text-align:center;vertical-align:middle">STANDART</th>
		<th rowspan="2" style="text-align:center;vertical-align:middle">Satuan</th>
		<th rowspan="2" style="text-align:center;vertical-align:middle">Rata-2</th>
		<th rowspan="2" style="text-align:center;vertical-align:top">SESUAI<br> STANDART<br> per JAM</th>
		<th rowspan="2" style="text-align:center;vertical-align:top">DI ATAS<br> STANDART<br> per JAM</th>
		<th rowspan="2" style="text-align:center;vertical-align:top">UNDER <br>STANDART <br>PER JAM</th>
	</tr>
	</thead>
	<tbody>
	<tr>
		<td>Digiling</td>
		<td style="text-align:right;"><?php echo $standart->digiling;?></td>
		<td style="text-align:center;">Kui</td>
		<td align="right"><?php echo $avg->digiling;?></td>
		<td align="right"><?php echo $std_digiling->normal;?> Jam</td>
		<td align="right"><?php echo $std_digiling->over;?> Jam</td>
		<td align="right"><?php echo $std_digiling->under;?> Jam</td>
	</tr>
	<tr>
		<td>Brix NPP</td>
		<td style="text-align:right;"><?php echo $standart->brix_npp;?></td>
		<td style="text-align:center;">%</td>
		<td align="right"><?php echo $avg->brix_npp;?></td>
		<td align="right"><?php echo $std_brix_npp->normal;?> Jam</td>
		<td align="right"><?php echo $std_brix_npp->over;?> Jam</td>
		<td align="right"><?php echo $std_brix_npp->under;?> Jam</td>
	</tr>
	<tr>
		<td>NM % TEBU</td>
		<td style="text-align:right;"><?php echo $standart->nm_persen_tebu;?></td>
		<td style="text-align:center;">%</td>
		<td align="right"><?php echo $avg->nm_persen_tebu;?></td>
		<td align="right"><?php echo $std_nm_persen_tebu->normal;?> Jam</td>
		<td align="right"><?php echo $std_nm_persen_tebu->over;?> Jam</td>
		<td align="right"><?php echo $std_nm_persen_tebu->under;?> Jam</td>
	</tr>
	<tr>
		<td>UAP BARU</td>
		<td style="text-align:right;"><?php echo $standart->uap_baru;?></td>
		<td style="text-align:center;">Ato</td>
		<td align="right"><?php echo $avg->uap_baru;?></td>
		<td align="right"><?php echo $std_uap_baru->normal;?> Jam</td>
		<td align="right"><?php echo $std_uap_baru->over;?> Jam</td>
		<td align="right"><?php echo $std_uap_baru->under;?> Jam</td>
	</tr>
	<tr>
		<td>UAP BEKAS</td>
		<td style="text-align:right;"><?php echo $standart->uap_bekas;?></td>
		<td style="text-align:center;">Ato</td>
		<td align="right"><?php echo $avg->uap_bekas;?></td>
		<td align="right"><?php echo $std_uap_bekas->normal;?> Jam</td>
		<td align="right"><?php echo $std_uap_bekas->over;?> Jam</td>
		<td align="right"><?php echo $std_uap_bekas->under;?> Jam</td>
	</tr>
	<tr>
		<td>SUHU PP I</td>
		<td style="text-align:right;"><?php echo $standart->suhu_pp_i;?></td>
		<td style="text-align:center;">&ordm;C</td>
		<td align="right"><?php echo $avg->suhu_pp_i;?></td>
		<td align="right"><?php echo $std_suhu_pp_i->normal;?> Jam</td>
		<td align="right"><?php echo $std_suhu_pp_i->over;?> Jam</td>
		<td align="right"><?php echo $std_suhu_pp_i->under;?> Jam</td>
	</tr>
	<tr>
		<td>SUHU PP II</td>
		<td style="text-align:right;"><?php echo $standart->suhu_pp_ii;?></td>
		<td style="text-align:center;">&ordm;C</td>
		<td align="right"><?php echo $avg->suhu_pp_ii;?></td>
		<td align="right"><?php echo $std_suhu_pp_ii->normal;?> Jam</td>
		<td align="right"><?php echo $std_suhu_pp_ii->over;?> Jam</td>
		<td align="right"><?php echo $std_suhu_pp_ii->under;?> Jam</td>
	</tr>
	<tr>
		<td>SUHU PP III</td>
		<td style="text-align:right;"><?php echo $standart->suhu_pp_iii;?></td>
		<td style="text-align:center;">&ordm;C</td>
		<td align="right"><?php echo $avg->suhu_pp_iii;?></td>
		<td align="right"><?php echo $std_suhu_pp_iii->normal;?> Jam</td>
		<td align="right"><?php echo $std_suhu_pp_iii->over;?> Jam</td>
		<td align="right"><?php echo $std_suhu_pp_iii->under;?> Jam</td>
	</tr>
	<tr>
		<td>Turbidity</td>
		<td style="text-align:right;"><?php echo $standart->turbidity;?></td>
		<td style="text-align:center;">ppm</td>		
		<td align="right"><?php echo $avg->turbidity;?></td>
		<td align="right"><?php echo $std_turbidity->normal;?> Jam</td>
		<td align="right"><?php echo $std_turbidity->over;?> Jam</td>
		<td align="right"><?php echo $std_turbidity->under;?> Jam</td>
	</tr>
	<tr>
		<td>Vacuum Eva</td>
		<td style="text-align:right;"><?php echo $standart->v_eva;?></td>
		<td style="text-align:center;">CmHg</td>
		<td align="right"><?php echo $avg->v_eva;?></td>
		<td align="right"><?php echo $std_v_eva->normal;?> Jam</td>
		<td align="right"><?php echo $std_v_eva->over;?> Jam</td>
		<td align="right"><?php echo $std_v_eva->under;?> Jam</td>
	</tr>
	<tr>
		<td>Vacuum Masakan</td>
		<td style="text-align:right;"><?php echo $standart->v_msk;?></td>
		<td style="text-align:center;">CmHg</td>
		<td align="right"><?php echo $avg->v_masakan;?></td>
		<td align="right"><?php echo $std_v_masakan->normal;?> Jam</td>
		<td align="right"><?php echo $std_v_masakan->over;?> Jam</td>
		<td align="right"><?php echo $std_v_masakan->under;?> Jam</td>
	</tr>
	<tr>
		<td>Be NK</td>
		<td style="text-align:right;"><?php echo $standart->be_nk;?></td>
		<td style="text-align:center;">&ordm;Be</td>
		<td align="right"><?php echo $avg->be_nk;?></td>
		<td align="right"><?php echo $std_be_nk->normal;?> Jam</td>
		<td align="right"><?php echo $std_be_nk->over;?> Jam</td>
		<td align="right"><?php echo $std_be_nk->under;?> Jam</td>
	</tr>
	</tbody>
</table>
<br>
<table style="width:100%">
<tr><td style="width: 60%"><br>
			<br />	
			<br />	
			<br />
			</td><td style="width: 20%" >&nbsp;</td>
			<td align="center"> <?=CNF_PG.' ,'.SiteHelpers::datereport(date('Y-m-d'));?>
			<br /><br /><br />
			<br /><br />	
			<br />	
			<br />
			..........................
			<br />	

			</td></tr>
		</table>