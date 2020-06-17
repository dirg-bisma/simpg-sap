<style type="text/css">
	table.tableizer-table {
		font-size: 12px;
		border: 1px solid #CCC; 
		font-family: Arial, Helvetica, sans-serif;
		width:100%;
	} 
	.tableizer-table td {
		padding: 4px;
		margin: 3px;
		border: 1px solid #CCC;
	}
	.tableizer-table th {
		background-color: #104E8B; 
		color: #FFF;
		font-weight: bold;
		height:25px;padding:10px;
	}
</style>
<table  style="height: 5px;font-family:Monospace;" border="0" width="100%">
<tbody>
<tr>

<td align="left"  style="font-size:11px" colspan="4">
<b><?=CNF_NAMAPERUSAHAAN;?></b><br />
	<?=CNF_PG;?> 
	<?=CNF_ALAMAT;?>
</td>
<td align="center" style="font-size:13px" colspan="4">
LAPORAN KERAGAAN PABRIK HARI GILING KE <?php echo $_GET['hari']?><br />

</td>
</tr>
</table>
<hr />
<table class="tableizer-table">

<thead>
	<tr class="tableizer-firstrow">
    <th>Jam</th>
    <th>DIGILING</th>
    <th>BRIX NPP</th>
    <th>NM % TEBU</th>
    <th>UAP BARU</th>
    <th>UAP BEKAS</th>
    <th>SUHU PP I</th>
    <th>SUHU PP II</th>
    <th>SUHU PP III</th>
    <th>TURBIDITY</th>
    <th>VACUUM EVA</th>
    <th>VACUUM MASAKAN</th>
    <th>Be NK</th>
	</tr>
</thead>
<tbody>
<?php $cek = array();?>
<?php foreach($jam as $row_jam){?>
<tr style="font-weight:bold;background:#3c8dbc;color:white">
	<?php $cek_jam;?>
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
<tfoot><tr style="font-weight:bold;background:#104E8B;color:white">
    <td colspan="2"> GRAND TOTAL </td><td align="center"></td>
	<td align="center"></td>
	<td align="center"></td>
	<td align="right"></td>
	<td align="right"></td>
	<td align="right"></td>
	<td align="right"></td>
	<td align="right"></td>
	<td align="right"></td>
	<td align="right"></td>
	<td align="right"></td>
	</tr></tfoot>
</table>
<hr />
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