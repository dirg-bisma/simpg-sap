<style type="text/css">
	table.tableizer-table {
		border-collapse: collapse;
		font-size: 12px;
		border: 1px solid #CCC; 
		font-family: Arial, Helvetica, sans-serif;
		width: 100%;

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
	}
</style>
<table  style="height: 5px;font-family:Monospace;" border="0" width="100%">
<tbody>
<tr>

<td align="left"  style="font-size:11px" colspan="10" >
<b><?=CNF_NAMAPERUSAHAAN;?></b><br />
	<?=CNF_PG;?> 
	<?=CNF_ALAMAT;?>
</td>
<td align="center" style="font-size:13px" colspan="7" >
INTERNAL CHECK A.K.U<br />
<?=$title;?> 
</td>
</tr>
</table>
<table class="tableizer-table">
<thead>
			<tr>
			<th rowspan="2">NO AJUAN</th>
			<th  rowspan="2">PERIODE</th>
			<th rowspan="2">ID PETANI</th>
			<th rowspan="2">NAMA PETANI</th>
			<th rowspan="2">KODE KELOMPOK</th>
			<th colspan="3">TMA TEBU TR OLEH PG (Kg)</th>
			<th colspan="3">GULA EX TR</th>
			<th rowspan="2">GULA PG</th>
			<th rowspan="2">GULA EX TR</th>
			<th rowspan="2">TETES PG</th>
			<th rowspan="2">TETES EX TR</th>

			  </tr>
			  <tr>
			  	<th>TEBU (Kg)</th>
			<th>ANGKUT PG</th>
			<th>TEBANG PG</th>
			<th>TOTAL TMA</th>
			<th>GULA 90%</th>
			<th>GULA 10%</th>
			<th>GULA 100%</th>
			  </tr>
        </thead>
<tbody>
<?php

foreach ($rows as $key) {
	$i = 0;
	echo '<tr>';
	echo '<td>'.$key->id.'</td>';
	echo '<td>'.$key->id_ari.'</td>';
	echo '<td>'.$key->sbh_status.'</td>';
	echo '<td>'.$key->no_spat.'</td>';
	echo '<td>'.$key->kode_kat_lahan.'</td>';
	echo '<td>'.$key->kode_plant.'</td>';
	echo '<td>'.$key->kode_affd.'</td>';
	echo '<td>'.$key->kode_blok.'</td>';
	echo '<td>'.$key->tgl_spta.'</td>';
	echo '<td>'.$key->tebang_pg.'</td>';
	echo '<td>'.$key->angkut_pg.'</td>';
	echo '<td>'.$key->jenis_spta.'</td>';
	echo '<td>'.$key->no_angkutan.'</td>';
	echo '<td>'.$key->nama_petani.'</td>';
	echo '<td>'.$key->spt_status.'</td>';
	echo '<td>'.$key->natura_status.'</td>';
	echo '<td>'.$key->r_spg.'</td>';
	echo '<td>'.$key->ha_tertebang.'</td>';
	echo '<td>'.$key->deskripsi_blok.'</td>';
	echo '<td>'.$key->tgl_tebang.'</td>';
	echo '<td>'.$key->brix_sel.'</td>';
	echo '<td>'.$key->ph_sel.'</td>';
	echo '<td>'.$key->ditolak_sel.'</td>';
	echo '<td>'.$key->ditolak_alasan.'</td>';
	echo '<td>'.$key->cetak_spta_tgl.'</td>';
	echo '<td>'.$key->selektor_tgl.'</td>';
	echo '<td>'.$key->timb_netto_tgl.'</td>';
	echo '<td>'.$key->meja_tebu_tgl.'</td>';
	echo '<td>'.$key->ari_tgl.'</td>';
	echo '<td>'.$key->sbh_tgl.'</td>';
	echo '<td>'.$key->hari_giling.'</td>';
	echo '<td>'.$key->tgl_giling.'</td>';
	echo '<td>'.$key->bruto.'</td>';
	echo '<td>'.$key->tara.'</td>';
	echo '<td>'.$key->netto_final.'</td>';
	echo '<td>'.$key->kondisi_tebu.'</td>';
	echo '<td bgcolor="yellow">'.$key->persen_brix_ari.'</td>';
	echo '<td bgcolor="yellow">'.$key->persen_pol_ari.'</td>';
	echo '<td bgcolor="yellow">'.$key->ph_ari.'</td>';
	echo '<td bgcolor="yellow">'.$key->hk.'</td>';
	echo '<td bgcolor="yellow">'.$key->nilai_nira.'</td>';
	echo '<td bgcolor="yellow">'.$key->faktor_rendemen.'</td>';
	echo '<td bgcolor="yellow">'.$key->rendemen_ari.'</td>';
	echo '<td bgcolor="yellow">'.$key->hablur_ari.'</td>';
	echo '<td bgcolor="yellow">'.$key->gula_total.'</td>';
	echo '<td bgcolor="yellow">'.$key->tetes_total.'</td>';
	echo '<td bgcolor="yellow">'.$key->rendemen_ptr.'</td>';
	echo '<td bgcolor="yellow">'.$key->r_spg.'</td>';
	echo '<td bgcolor="yellow">'.$key->kopensasi_gula.'</td>';
	echo '<td bgcolor="yellow">'.$key->gula_ptr.'</td>';
	echo '<td bgcolor="yellow">'.$key->sepuluh_persen.'</td>';
	echo '<td bgcolor="yellow">'.$key->sembilanpuluh_persen.'</td>';
	echo '<td bgcolor="yellow">'.$key->tetes_ptr.'</td>';
	echo '<td bgcolor="yellow">'.$key->gula_pg.'</td>';
	echo '<td bgcolor="yellow">'.$key->tetes_pg.'</td>';
	echo '</tr>';
	
}
?>
 
 
</tbody></table>