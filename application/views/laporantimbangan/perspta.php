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

<td align="left"  style="font-size:11px">
<b><?=CNF_NAMAPERUSAHAAN;?></b><br />
	<?=CNF_PG;?> 
	<?=CNF_ALAMAT;?>
</td>
<td align="center" style="font-size:13px" >
LAPORAN TIMBANGAN HARIAN PER SPTA<br />
<?=$title;?> 
</td>
</tr>
</table>
<hr />
<table class="tableizer-table">
<thead><tr class="tableizer-firstrow">
<th>NO SPTA</th><th>NOMER PETAK</th><th>KEBUN</th><th>NAMA PETANI</th><th>KATEGORI</th><th>TRUK</th><th>LORI</th><th>HEKTAR</th><th>QTY TEBU</th><th>KATEGORI TEBANG</th><th>TGL TIMBANG</th></tr></thead>
<tbody>
<?php
$truk = 0;
$lori = 0;
$ha = 0;
$netto = 0;
$tha = 0;
$kat = '';
$i=0;

$gtruk = 0;$glori = 0;$gha = 0;$gnetto = 0;$gtha = 0;
 foreach($result as $r){
	 
	 
	 if($kat != $r->stt_ta_text && $i != 0){
		?>
		<tr style="font-weight:bold;background:#3c8dbc;color:white">
<td colspan="5"> JUMLAH <?php echo $kat;?> </td><td align="center"><?php echo $truk;?></td><td align="center"><?php echo $lori;?></td><td align="right"><?php echo number_format($ha,4);?></td><td align="right"><?php echo number_format($netto,0);?></td><td></td><td align="right"></td></tr>
		<?php
		$truk = 0;$lori = 0;$ha = 0;$netto = 0;$tha = 0;$i=0;
	 }
	 
	 if($kat != $r->stt_ta_text){
		echo '<tr><td colspan="11" ><b>'.$r->stt_ta_text.'</b></td><tr>';
		$kat = $r->stt_ta_text;
	 }
	 
	 echo '<tr><td> '.$r->no_spat.' </td><td> '.$r->kode_blok.' </td><td> '.$r->deskripsi_blok.' </td><td> '.$r->nama_petani.' </td><td> '.$r->kode_kat_lahan.'</td><td align="center"> '.$r->truk.' </td><td align="center"> '.$r->lori.' </td><td align="right"> '.$r->tertebang.' </td><td align="right"> '.number_format($r->netto,0).' </td><td align="center"> '.$r->stt_ta_text.' </td><td align="right"> '.$r->timb_netto_tgl.' </td></tr>';
	 $truk += $r->truk;
	$lori += $r->lori;
	$ha += $r->tertebang;
	$netto += $r->netto;
	
	$gtruk += $r->truk;
	$glori += $r->lori;
	$gha += $r->tertebang;
	$gnetto += $r->netto;
	$i++;
 }
?>
<tr style="font-weight:bold;background:#3c8dbc;color:white">
<td colspan="5"> JUMLAH <?php echo $kat;?> </td><td align="center"><?php echo $truk;?></td><td align="center"><?php echo $lori;?></td><td align="right"><?php echo number_format($ha,4);?></td><td align="right"><?php echo number_format($netto,0);?></td><td></td><td align="right"></td></tr>
</tbody>
<tfoot><tr style="font-weight:bold;background:#104E8B;color:white">
<td colspan="5"> GRAND TOTAL </td><td align="center"><?php echo $gtruk;?></td><td align="center"><?php echo $glori;?></td><td align="right"><?php echo number_format($gha,4);?></td><td align="right"><?php echo number_format($gnetto,0);?></td><td></td><td align="right"></td></tr></tfoot>
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