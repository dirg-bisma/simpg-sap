<style type="text/css">
	table {
		
	} 
	table td {
		font-size: 11px; 
		font-family: Arial, Helvetica, sans-serif;
		text-transform: uppercase;
	}
	.divx   { page-break-inside:avoid; } /* This is the key */
</style>
<div style="width: 99%;float: left; padding:1px;min-height:103mm" >
<table border="1" width="100%" cellspacing="0" cellpadding="0" style="font-family:;font-size:10px;">
	<tbody>
	<tr>
		<td style="text-align: center; padding:2px;height: 75px;">
			<?php
				$jnsta = '';
				if($row->tebang_pg == 0 && $row->angkut_pg == 0){
					$jnsta = 'TAS';
				}else if($row->tebang_pg == 0 && $row->angkut_pg == 1){
					$jnsta = 'TSAPG';
				}else if($row->tebang_pg == 1 && $row->angkut_pg == 0){
					$jnsta = 'TPGAS';
				}else if($row->tebang_pg == 1 && $row->angkut_pg == 1){
					$jnsta = 'TAPG';
				}
			?>
		<b><?php echo $jnsta.'<br />'.strtoupper(($row->kepemilikan)).'<br />'.$row->jenis_spta;?></b><br />
		<br />
		<span style="background-color: black;color: white; padding: 10px">CETAK ULANG</span>
		</td>
		<td style="text-align: center;padding:5px">
		
			<img src="<?php echo site_url('tkuotaspta/generateBarcode/'.$row->no_spat);?>"> 
		</td>
		<td style="width:45%" rowspan="6" valign="top" >
		
		<table border="0" width="100%" cellspacing="0" cellpadding="0" style="font-family:;font-size:10px;" >
	<tbody>
	<tr>
		<td style="text-align: center; padding:2px;height: 75px;border-bottom:1px solid black;border-right:1px solid black">
			
		<b><?php echo $jnsta.'<br />'.strtoupper(($row->kepemilikan)).'<br />'.$row->jenis_spta;?></b><br /><br />
		<span style="background-color: black;color: white; padding: 10px">CETAK ULANG</span></td>
		<td style="text-align: center;padding:2px;border-bottom:1px solid black">
		<img src="<?php echo site_url('tkuotaspta/generateBarcode/'.$row->no_spat);?>"> 
			<center>
			<b><u><?php echo strtoupper(CNF_NAMAPERUSAHAAN);?></u></b></center>
			
			<?php echo $row->deskripsi_blok;?>
		</td>
		</tr>
		</table>
		<center>
			<b><u>UNIT USAHA <?php echo strtoupper(CNF_PG);?></u></b></center>
		<table width="100%" cellspacing="0"   >
				<tr>
					<td style="width: 50%; text-align: center;" width="50%" valign="top">
						<table style="margin-left: auto; margin-right: auto;" width="95%" cellspacing="0">
							<tbody>
							<tr >
								<td style="text-align: left;"><span>Tgl SPTA&nbsp;</span></td>
								<td style="text-align: left;"><span>:&nbsp;<?php echo SiteHelpers::daterpt($row->tgl_spta);?></span></td>
							</tr>
							<tr >
								<td style="text-align: left;" width="40%"><span>No Petak&nbsp;</span></td>
								<td style="text-align: left;"><span>:&nbsp;<?php echo $row->kode_blok;?></span></td>
							</tr>
							
							
						
							</tbody>
						</table>
						</td></tr><tr>
						<td align="center" valign="top">
						<table border="1" width="90%" cellspacing="0" cellpadding="0">
							
							<tbody>
							<tr>
								<td style="padding:2px;width:20%">Ha. Tertebang</td><td> </td>
							</tr>
							<tr>
								<td style="padding:2px;width:20%">Tgl.Jam Tebang</td><td> </td>
							</tr>
							<tr>
								<td style="padding:2px;width:20%">No Lori</td><td> </td>
							</tr>
							<tr>
								<td style="padding:2px;width:20%">No Truk</td><td> </td>
							</tr>
							<tr>
								<td style="padding:2px;width:30%">Sopir</td><td> </td>
							</tr>
							<?php
								if($row->metode_tma != 1){
							?>
							<tr>
								<td style="padding:2px;width:30%">No. HV</td><td> </td>
							</tr>
							<tr>
								<td style="padding:2px;width:30%">Op. HV</td><td> </td>
							</tr>
							<?php
								}
							?>
							<?php
								if($row->metode_tma != 1){
							?>
							<tr>
								<td style="padding:2px;width:30%">No. ST</td><td> </td>
							</tr>
							<tr>
								<td style="padding:2px;width:30%">Op. ST</td><td> </td>
							</tr>
							<tr>
								<td style="padding:2px;width:30%">No. GL</td><td> </td>
							</tr>
							<tr>
								<td style="padding:2px;width:30%">Op. GL</td><td> </td>
							</tr>
							<?php
								}
							?>
							</tbody>
						</table>
						</td>
						</tr></table>
						
						
		
		
		</td>

	</tr>
	<tr>
		<td style="text-align: center;" colspan="2">
			<table width="100%" cellspacing="0" >
			<b><?php echo strtoupper(CNF_NAMAPERUSAHAAN);?></b><br />
			<b>UNIT USAHA <?php echo strtoupper(CNF_PG);?></b>
			<br />
				<tbody>
				<tr>
					<td style="width: 50%; text-align: center;" width="50%" valign="top">
						<table style="margin-left: auto; margin-right: auto;" width="95%" cellspacing="0">
							<tbody>
							<tr >
								<td style="text-align: left;"><span>Tgl SPTA&nbsp;</span></td>
								<td style="text-align: left;"><span>:&nbsp;<?php echo SiteHelpers::daterpt($row->tgl_spta);?></span></td>
							</tr>
							<tr >
								<td style="text-align: left;" width="40%"><span>No Petak&nbsp;</span></td>
								<td style="text-align: left;"><span>:&nbsp;<?php echo $row->kode_blok;?></span></td>
							</tr>
							<tr >
								<td style="text-align: left;"><span>Afdeling</span></td>
								<td style="text-align: left;"><span>:&nbsp;<?php echo $row->divisi;?></span></td>
							</tr>
							<tr >
								<td style="text-align: left;"><span>Kategori</span></td>
								<td style="text-align: left;"><span>:&nbsp;<?php echo $row->kepemilikan;?></span></td>
							</tr>
							<tr >
								<td style="text-align: left;" colspan="2"><span>Deskripsi<br /><b><?php echo $row->deskripsi_blok;?></b></span></td>
							</tr>
							<tr >
								<td style="text-align: left;"><span>Petani&nbsp;</span></td>
								<td style="text-align: left;"><span>:&nbsp;<?php echo $row->nama_petani;?></span></td>
							</tr>
							<tr >
								<td style="text-align: left;"><span>PTA</span></td>
								<td style="text-align: left;"><span>:&nbsp;<?php echo $row->nama_pta;?></span></td>
							</tr>
						
							
							<tr >
								<td style="text-align: left;"><span> Expired&nbsp;</span></td>
								<td style="text-align: left;"><span>:&nbsp;<?php echo $row->tgl_expired;?></span></td>
							</tr>
							
							</tbody>
						</table>
						<table style="width: 95%; margin-left: auto; margin-right: auto;" cellspacing="0" cellpadding="0">
										<tr style="height: 20px;" style="">
											<td align="center">Brix</td>
					<td style="border: 1px solid black;width: 25%;" >&nbsp;&nbsp;</td>
					<td align="center">&nbsp;</td>
					<td style=" width: 25%;" >&nbsp;</td>
					<td align="center">pH</td> 
					<td style="border: 1px solid black; width: 25%;" >&nbsp;&nbsp;</td>
					</tr>
									</table>
									<br />
						
						<p>&nbsp;</p>
					</td>
					<td align="center" width="50%" valign="top"><br />
						<?php
						if($jnsta != 'TAS' && $jnsta != 'TSAPG'){
						?>
						<b>PREMI</b>
						<table border="1" width="90%" style="margin-left: auto; margin-right: auto;" cellspacing="0" cellpadding="0">
						<?php
							$dt = $this->db->query("SELECT * FROM m_pekerjaan_tma WHERE tercetak_spat=1")->result();
							foreach($dt as $rt){
								?>
								<tr>
								<td style="padding:2px;width:70%;text-align:left"><?php echo strtoupper($rt->nama_pekerjaan_tma);?></td><td> </td>
							</tr>
								<?php
							}
						?>
						
						</table><?php
						}
						?>
						</td>
				</tr>
				</tbody>
			</table>
						<p style="text-align: right;font-size:8px"><i><span>dicetak pada tanggal <?php echo date('d.m.Y H:i:s')?></span> &nbsp;</i></p>
			<table border="1" width="100%" style="margin-left: auto; margin-right: auto;" cellspacing="0" cellpadding="0">
	<tr><td style="padding:2px;width:50%;text-align:center">Mandor Tebang<br /><br /><br />
	 .................. </td>
	<td style="text-align:center">Sinder/Asisten<br /><br /><br /> <b><u><?php echo $row->karyawan;?></u></b> </td></tr>
	</table>		
		</td>
		
		
	</tr>
	</tbody>
</table>

</div>
<p style="page-break-after: always;">&nbsp;</p>
