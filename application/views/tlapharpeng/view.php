<section class="content-header">
          <h1>
            <?php echo $pageTitle ;?>
          </h1>
          <ol class="breadcrumb">

          	<li><i class="fa fa-dashboard"></i> <a href="<?php echo site_url('dashboard') ?>">Dashboard</a></li>
			<li><a href="<?php echo site_url('tlapharpeng') ?>"><?php echo $pageTitle ?></a></li>
			<li class="active"> Detail </li>
          </ol>
        </section>

 <section class="content">
          <div class="row">
            <div class="col-xs-12">
              <div class="box box-danger">
              	<div class="box-header with-border">	
				<div class="table-responsive">
					<table class="table table-striped table-bordered" >
						<tbody>	
					
					<tr>
						<td width='30%' class='label-view text-right'>Id Lap Harian Pengolahan</td>
						<td><?php echo $row['id_lap_harian_pengolahan'] ;?> </td>
						
					</tr>
				
					<tr>
						<td width='30%' class='label-view text-right'>Jam Berhenti A</td>
						<td><?php echo $row['jam_berhenti_a'] ;?> </td>
						
					</tr>
				
					<tr>
						<td width='30%' class='label-view text-right'>Jam Berhenti B</td>
						<td><?php echo $row['jam_berhenti_b'] ;?> </td>
						
					</tr>
				
					<tr>
						<td width='30%' class='label-view text-right'>Jam Kampanye</td>
						<td><?php echo $row['jam_kampanye'] ;?> </td>
						
					</tr>
				
					<tr>
						<td width='30%' class='label-view text-right'>Kis</td>
						<td><?php echo $row['kis'] ;?> </td>
						
					</tr>
				
					<tr>
						<td width='30%' class='label-view text-right'>Kes</td>
						<td><?php echo $row['kes'] ;?> </td>
						
					</tr>
				
					<tr>
						<td width='30%' class='label-view text-right'>Prod Gula</td>
						<td><?php echo $row['prod_gula'] ;?> </td>
						
					</tr>
				
					<tr>
						<td width='30%' class='label-view text-right'>Ex Sisan Gula</td>
						<td><?php echo $row['ex_sisan_gula'] ;?> </td>
						
					</tr>
				
					<tr>
						<td width='30%' class='label-view text-right'>Sisan Diolah</td>
						<td><?php echo $row['sisan_diolah'] ;?> </td>
						
					</tr>
				
					<tr>
						<td width='30%' class='label-view text-right'>Prod Tetes</td>
						<td><?php echo $row['prod_tetes'] ;?> </td>
						
					</tr>
				
					<tr>
						<td width='30%' class='label-view text-right'>Ex Sisan Tetes</td>
						<td><?php echo $row['ex_sisan_tetes'] ;?> </td>
						
					</tr>
				
					<tr>
						<td width='30%' class='label-view text-right'>Sto Tetes</td>
						<td><?php echo $row['sto_tetes'] ;?> </td>
						
					</tr>
				
					<tr>
						<td width='30%' class='label-view text-right'>Ex Repro Tll</td>
						<td><?php echo $row['ex_repro_tll'] ;?> </td>
						
					</tr>
				
					<tr>
						<td width='30%' class='label-view text-right'>Bba</td>
						<td><?php echo $row['bba'] ;?> </td>
						
					</tr>
				
					<tr>
						<td width='30%' class='label-view text-right'>Rupiah Bba</td>
						<td><?php echo $row['rupiah_bba'] ;?> </td>
						
					</tr>
				
					<tr>
						<td width='30%' class='label-view text-right'>Gula Repro Tll</td>
						<td><?php echo $row['gula_repro_tll'] ;?> </td>
						
					</tr>
				
					<tr>
						<td width='30%' class='label-view text-right'>Raw Sugar</td>
						<td><?php echo $row['raw_sugar'] ;?> </td>
						
					</tr>
				
					<tr>
						<td width='30%' class='label-view text-right'>Gula Repro Th Ini</td>
						<td><?php echo $row['gula_repro_th_ini'] ;?> </td>
						
					</tr>
				
					<tr>
						<td width='30%' class='label-view text-right'>Ton Ampas</td>
						<td><?php echo $row['ton_ampas'] ;?> </td>
						
					</tr>
				
					<tr>
						<td width='30%' class='label-view text-right'>Persen Pol Ampas</td>
						<td><?php echo $row['persen_pol_ampas'] ;?> </td>
						
					</tr>
				
					<tr>
						<td width='30%' class='label-view text-right'>Ton Blotong</td>
						<td><?php echo $row['ton_blotong'] ;?> </td>
						
					</tr>
				
					<tr>
						<td width='30%' class='label-view text-right'>Persen Pol Blotong</td>
						<td><?php echo $row['persen_pol_blotong'] ;?> </td>
						
					</tr>
				
					<tr>
						<td width='30%' class='label-view text-right'>Ton Pol Dlm Hasil Plus Taksasi</td>
						<td><?php echo $row['ton_pol_dlm_hasil_plus_taksasi'] ;?> </td>
						
					</tr>
				
					<tr>
						<td width='30%' class='label-view text-right'>Persen Pol Dlm Hasil Plus Taksasi</td>
						<td><?php echo $row['persen_pol_dlm_hasil_plus_taksasi'] ;?> </td>
						
					</tr>
				
					<tr>
						<td width='30%' class='label-view text-right'>Hari Giling</td>
						<td><?php echo $row['hari_giling'] ;?> </td>
						
					</tr>
				
					<tr>
						<td width='30%' class='label-view text-right'>Tahun Giling</td>
						<td><?php echo $row['tahun_giling'] ;?> </td>
						
					</tr>
				
					<tr>
						<td width='30%' class='label-view text-right'>Tgl</td>
						<td><?php echo $row['tgl'] ;?> </td>
						
					</tr>
				
						</tbody>	
					</table>    
				</div>
				<a href="<?php echo site_url('tlapharpeng');?>" class="btn btn-sm btn-warning"> << Back </a>
			</div>
		</div>		
	

	</div>
</div>
</section>
	  