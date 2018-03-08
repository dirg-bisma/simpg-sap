<style type="text/css">
	table.tableizer-table {
		font-size: 12px;
		border-collapse: collapse;
		border: 1px solid #CCC; 
		font-family: Arial, Helvetica, sans-serif;
		width:100%;
	} 
	.tableizer-table td {
		padding: 2px;
		margin: 1px;
	}
	.tableizer-table th {
		background-color: #104E8B; 
		color: #FFF;
		font-weight: bold;
		border: 1px solid #CCC;
		height:20px;padding:2px;
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
					<td style="width:10%;">Petak</td><td> : </td><td style="width:20%;"><?php echo $row['kode_blok'];?></td>
					<td style="font-size:13px;text-align:center;border-left:1px solid black;border-right:1px solid black;"><?php echo strtoupper(CNF_NAMAPERUSAHAAN);?></td>
					<td style="width:8%;padding-left:10px;">Jml. Ha</td><td> : </td><td style="width:15%;"><?php echo $row['luas_ha'];?></td>
				</tr>
				<tr>
					<td>Kebun</td><td> : </td><td><?php echo $row['deskripsi_blok'];?></td>
					<td style="font-size:15px;text-align:center;border-left:1px solid black;border-right:1px solid black;"><?php echo CNF_PG;?></td>
					<td style="padding-left:10px;">PTA</td><td> : </td><td><?php echo $row['pta'];?></td>
				</tr>
				<tr>
					<td>Kategori</td><td> : </td><td><?php echo $row['kepemilikan'];?></td>
					<td style="text-align:center;border-left:1px solid black;border-right:1px solid black;">DAFTAR UPAH HARIAN</td>
					<td style="padding-left:10px;">Mandor</td><td> : </td><td><?php echo $row['mandor'];?></td>
				</tr>
				<tr>
					<td>Petani</td><td> : </td><td><?php echo $row['nama_petani'];?></td>
					<td style="text-align:center;border-left:1px solid black;border-right:1px solid black;">PERIODE TANGGAL <?php echo SiteHelpers::daterpt($row['tgl']);?></td>
					<td style="padding-left:10px;">-</td><td> - </td><td></td>
				</tr>
				</table>
				<table class="tableizer-table">
				<thead><tr>
					<th>No</th>
					<th>SPTA</th>
					<th>No Truk/Lori</th>
					<th>Tebu (kg)</th>
					<?php
						foreach($coldefadd as $kol1)
						{
							echo '<th>'.$kol1->nama_pekerjaan_tma.'</th>';
						}
					?>
					<th>Jumlah</th>
					<?php
						foreach($coldefrem as $kol1)
						{
							echo '<th>'.$kol1->nama_pekerjaan_tma.'</th>';
						}
					?>
					<th>Bersih</th>
					<th>Tgl Timbang</th></tr>
				<thead>
				<tbody>
				<?php
				$no = 0;
				$jnetto = 0;
				$jadd = 0;
				$jrem = 0;
				$jbersih = 0;
						$arradd = array(array());
						$arrrem = array(array());
					foreach($detail as $d){
						$no++;
						$add = 0;
						$rem = 0;
						$bersih = 0;
						$jnetto += $d->netto;
						?>
						<tr>
					<td><?php echo $no;?></td>
					<td><?php echo $d->no_spat;?></td>
					<td><?php echo $d->no_angkutan;?></td>
					<td style="text-align:right"><?php echo number_format($d->netto);?></td>
					<?php
						foreach($coldefadd as $kol1)
						{
							$nm = $kol1->kodekolom;
							if($kol1->satuan == 1){
								$add += ($d->$nm*$d->netto);
								$arradd[$nm][] = $d->$nm*$d->netto;
							echo '<td style="text-align:right">'.number_format($d->$nm*$d->netto).'</td>';
							}else{
								$add += ($d->$nm);
								$arradd[$nm][] = $d->$nm;
							echo '<td style="text-align:right">'.number_format($d->$nm).'</td>';
							}
							
						}
						$jadd += $add;
					?>
					<td style="text-align:right"><?php echo number_format($add);?></td>
					<?php
						foreach($coldefrem as $kol1)
						{
							$nm = $kol1->kodekolom;
							if($kol1->satuan == 1){
								$rem += ($d->$nm*$d->netto);
								$arrrem[$nm][] = $d->$nm*$d->netto;
							echo '<td style="text-align:right">'.number_format($d->$nm*$d->netto).'</td>';
							}else{
								$rem += ($d->$nm);
								$arrrem[$nm][] = $d->$nm;
							echo '<td style="text-align:right">'.number_format($d->$nm).'</td>';
							}
							//$rem += ($d->$nm*$d->netto);
							//$arrrem[$nm][] = $d->$nm*$d->netto;
						}
						
						$jbersih += ($add-$rem);
					?>
					<td style="text-align:right"><?php echo number_format($add-$rem);?></td>
					<td style="text-align:center"><?php echo $d->timb_netto_tgl;?></td>
					</tr>
						<?php
					}
				?>
					
				</tbody>
				<tfoot>
					<tr>
						<th colspan="2"> JUMLAH </th>
						<th style="text-align:center"><?php echo $no;?> TRUK/LORI</th>
					<th style="text-align:right"><?php echo number_format($jnetto);?></th>
					<?php
						foreach($coldefadd as $kol1)
						{
							$nm = $kol1->kodekolom;
							$ttl = 0;
							foreach($arradd[$nm] as $rx=>$val){
								$ttl += $val;
							}
							echo '<th style="text-align:right">'.number_format($ttl).'</th>';
						}
					?>
					<th style="text-align:right"><?php echo number_format($jadd);?></th>
					<?php
						foreach($coldefrem as $kol1)
						{
							$nm = $kol1->kodekolom;
							$ttl = 0;
							foreach($arrrem[$nm] as $rx=>$val){
								$ttl += $val;
							}
							echo '<th style="text-align:right">'.number_format($ttl).'</th>';
						}
					?>
					<th style="text-align:right"><?php echo number_format($jbersih);?></th>
					<th style="text-align:right"></th>
					</tr>
				</tfoot>
				</table>

				
				<hr />
				
				<i style="font-size: 10px">Dicetak Pada Tanggal <?php echo date('Y-m-d H:i:s');?></i>
				<div style="width:50%;float: left;">
				<table style="width:100%">
					<?php
					$tambahantotal = 0;
					foreach($detailx as $d){ 
						echo '';
					foreach($colnondefadd as $kol1)
						{
							$nm = $kol1->kodekolom;
							$ttl = 0;
							echo '<tr><td style="text-align:left">'.$kol1->nama_pekerjaan_tma.'</td>';
						if($kol1->satuan == 2){
							echo '<td style="text-align:left"> : '.number_format($no).' Truk/Lori</td>';
						}else{
							echo '<td style="text-align:left"> : '.number_format($jnetto).' Kg</td>';
						}
							echo '<td style="text-align:center"> x </td>
							<td style="text-align:right">'.number_format($d->$nm).'</td>
							<td style="text-align:center"> = </td>';
						if($kol1->satuan == 1){
							echo '<td style="text-align:right"> '.number_format($jnetto*($d->$nm)).' </td>
							</tr>';
							$tambahantotal += $jnetto*($d->$nm);
						}else{
							echo '<td style="text-align:right"> '.number_format($no*($d->$nm)).' </td>
							</tr>';
							$tambahantotal += $no*($d->$nm);
						}
							
						}
						}
						
					
					?>
					<tr style="border-top:1px solid black">
					<td colspan="5"> JUMLAH TAMBAHAN <hr /></td>
					<td style="text-align:right"><?php echo number_format($tambahantotal);?><hr /></td>
				</table>
				
				<table style="width:100%">
					<?php
					$kurangtotal = 0;
					foreach($detailx as $d){
						echo '';
					foreach($colnondefrem as $kol1)
						{
							$nm = $kol1->kodekolom;
							$ttl = 0;
							echo '<tr><td style="text-align:left">'.$kol1->nama_pekerjaan_tma.'</td>';
						if($kol1->satuan == 2){
							echo '<td style="text-align:left"> : '.number_format($no).' Truk/Lori</td>';
						}else{
							echo '<td style="text-align:left"> : '.number_format($jnetto).' Kg</td>';
						}
							echo '<td style="text-align:center"> x </td>
							<td style="text-align:right">'.number_format($d->$nm).'</td>
							<td style="text-align:center"> = </td>';
						if($kol1->satuan == 1){
							echo '<td style="text-align:right"> '.number_format($jnetto*($d->$nm)).' </td>
							</tr>';
							$kurangtotal += $jnetto*($d->$nm);
						}else{
							echo '<td style="text-align:right"> '.number_format($no*($d->$nm)).' </td>
							</tr>';
							$kurangtotal += $no*($d->$nm);
						}
							
						}
						
					}
					?>
					<tr style="border-top:1px solid black">
					<td colspan="5"> JUMLAH PENGURANGAN <hr /></td>
					<td style="text-align:right"><?php echo number_format($kurangtotal);?><hr /></td>

					<tr style="font-size:15px;font-weight:bold">
					<td colspan="5" style="border-top:1px solid black;"> TOTAL </td>
					<td style="text-align:right;border-top:1px solid black;"><?php echo number_format($jbersih+$tambahantotal-$kurangtotal);?></td>
				</table>
				</div>
				<div style="width:50%;float: left;">

				<i style="font-size: 10px">Dicetak Pada Tanggal <?php echo date('Y-m-d H:i:s');?></i>
				<table style="width:100%">
				<tr><td style="text-align:center">PETUGAS UPAH TEBANG<br />
				<?php echo SiteHelpers::daterpt($row['tgl']);?>
				<br />
				<br />
				<br />
				<br />
				<br />
				..................................
				</td></tr>
				</table>
				</div>
				<p style="page-break-after: always;">&nbsp;</p>
			