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
LAPORAN ANALISA ARI<br />
<?=$title;?> 
</td>
</tr>
</table>
<hr />
<table class="tableizer-table">
<thead><tr class="tableizer-firstrow">
<th>JAM</th><th>NO SPTA</th><th>NO PETAK</th><th>PETANI</th><th>QTY TEBU</th><th>TRUK</th><th>LORI</th><th>KATEGORI</th><th>% BRIX</th><th>% POL</th><th>pH</th><th>HKNPP</th><th>N.NIRA</th><th>R.ARI</th><th>HABLUR</th></tr></thead>
<tbody>
<?php
 foreach($result as $r){
	 echo '<tr><td> '.$r->tgl_analisa.' </td><td> '.$r->no_spat.' </td><td> '.$r->kode_blok.' </td><td> '.$r->nama_petani.' </td><td align="right"> '.number_format($r->netto_final,0).'</td><td align="center"> '.$r->truk.' </td><td align="center"> '.$r->lori.' </td><td align="center"> '.$r->kode_kat_lahan.' </td><td align="right"> '.number_format($r->persen_brix_ari,2).' </td><td align="right"> '.number_format($r->persen_pol_ari,2).' </td><td align="right"> '.number_format($r->ph_ari,2).' </td><td align="right"> '.number_format($r->hk,2).' </td><td align="right"> '.number_format($r->nilai_nira,2).' </td><td align="right"> '.number_format($r->rendemen_ari,2).' </td><td align="right"> '.number_format($r->hablur_ari,2).' </td></tr>';
	 
 }
?>
</tbody>
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