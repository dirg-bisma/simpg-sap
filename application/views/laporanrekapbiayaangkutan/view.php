
				
<style type="text/css">
	table.tableizer-table {
		font-size: 12px;
		border: 1px solid #CCC; 
		font-family: Arial, Helvetica, sans-serif;
		width:100%;
	} 
	.tableizer-table td {
		padding: 3px;
		margin: 1px;
		border : 1px solid black;
	}
	.tableizer-table th {
		background-color: #104E8B; 
		color: #FFF;
		font-weight: bold;
		border: 1px solid #CCC;
		height:20px;padding:5px;
		text-align: center;
	}
	
	@media print {
  table.tableizer-table {
    font-size: 12px;
		border: 1px solid #CCC; 
		font-family: monospace;
		width:100%;
  }
  
  .tableizer-table td th{
    font-size: 12px;
		font-family: monospace;

  }
  
  table td{
    	font-size: 12px;
		font-family: monospace; 
		
  }


  
  
}
</style>
				<table style="width:100%;font-size:10px" >
				<tr>
					<td style="font-size:13px;text-align:center;"><?php echo strtoupper(CNF_NAMAPERUSAHAAN);?></td>
					
				</tr>
				<tr>
					<td style="font-size:15px;text-align:center;"><b><?php echo CNF_PG;?></b></td>
				</tr>
				<tr>
					<td style="text-align:center;">PERIODE TANGGAL <?php echo SiteHelpers::daterpt($row['tgl_awal']);?> S/D <?php echo SiteHelpers::daterpt($row['tgl_akhir']);?> </td>
				</tr>
				</table>
				<br />

				<?php 
				$par = "";
				$grandno=1;
				$grandttl = 0;
				foreach ($detail as $key => $val) {
				$par = $detail[$key-1]->vendor_angkut;
				if ($par != $val->vendor_angkut ) {
					
				?>				
				<table class="tableizer-table">
				<thead>
				<tr>
					<th>No</th>
					<th>Tgl Timbang</th>
					<th>SPTA</th>
					<th>Kode Blok</th>
					<th>Kebun</th>
					<th>No. Kend</th>
					<th>Netto (kg)</th>
					<th>Jarak</th>
					<th>Tarif</th>
					<th>Jumlah</th>
				</tr>
				<tr>
					<td colspan="2" style="text-align: center; background:red;color:#FFF;"><?php echo $val->nama_vendor;?></td>
					<td colspan="8"></td>
				</tr>
				</thead>
				<tbody>
					<?php
					$no=1;
					$ttl = 0;
						$par1 = $detail[$key]->vendor_angkut;
						foreach ($detail as $a) {
							if ($a->vendor_angkut == $par1) {
							?>
							<tr>
							<td style="text-align: center"><?php echo $no++;?></td>
							<td style="text-align: center"><?php echo $a->txt_tgl_timb;?></td>
							<td style="text-align: center"><?php echo $a->no_spat;?></td>
							<td style="text-align: center"><?php echo $a->kode_blok;?></td>
							<td><?php echo $a->deskripsi_blok;?></td>
							<td style="text-align: center"><?php echo $a->no_angkutan;?></td>
							<td style="text-align: right;"><?php echo number_format($a->netto);?></td>
							<td><?php echo $a->keterangan;?></td>
							<td style="text-align: right;"><?php echo number_format($a->tarif);?></td>
							<td style="text-align: right;"><?php echo number_format($a->total);?></td>
							<?php
							$ttl += $a->total;
						}
					}
					?>
				</tbody>
				<tr>
					<th style="text-align: center" colspan="9">JUMLAH ( <?php echo $no-1;?> TRUK/LORI )</th>
					<th style="text-align: right; "><?php echo number_format($ttl);?></th>
				</tr>
				<?php }
				$grandno++;
				$grandttl += $val->total;
				} ?>
				<tfoot>
					<tr>
						<th style="text-align: center" colspan="9">JUMLAH ( <?php echo $grandno-1;?> TRUK/LORI )</th>
						<th style="text-align: right; "><?php echo number_format($grandttl);?></th>
					</tr>
				</tfoot>
				</table>


				<i style="font-size: 10px">Dicetak Pada Tanggal <?php echo date('Y-m-d H:i:s');?></i>
				<hr />
		