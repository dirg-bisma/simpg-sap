<section class="content-header">
          <h1>
            <?php echo $pageTitle ;?>
          </h1>
          <ol class="breadcrumb">

          	<li><i class="fa fa-dashboard"></i> <a href="<?php echo site_url('dashboard') ?>">Dashboard</a></li>
			<li><a href="<?php echo site_url('keragaanpabrik') ?>"><?php echo $pageTitle ?></a></li>
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
						<td width='30%' class='label-view text-right'>Hari Giling</td>
						<td><?php echo $row['hari_giling'] ;?> </td>
						
					</tr>
				
					<tr>
						<td width='30%' class='label-view text-right'>Tgl Giling</td>
						<td><?php echo $row['tgl_giling'] ;?> </td>
						
					</tr>
				
					<tr>
						<td width='30%' class='label-view text-right'>Jam</td>
						<td><?php echo $row['jam'] ;?> </td>
						
					</tr>
				
					<tr>
						<td width='30%' class='label-view text-right'>Digiling(ton)</td>
						<td><?php echo $row['digiling'] ;?> </td>
						
					</tr>
				
					<tr>
						<td width='30%' class='label-view text-right'>Brix NPP</td>
						<td><?php echo $row['brix_npp'] ;?> </td>
						
					</tr>
				
					<tr>
						<td width='30%' class='label-view text-right'>NM Persen Tebu</td>
						<td><?php echo $row['nm_persen_tebu'] ;?> </td>
						
					</tr>
				
					<tr>
						<td width='30%' class='label-view text-right'>Uap Baru</td>
						<td><?php echo $row['uap_baru'] ;?> </td>
						
					</tr>
				
					<tr>
						<td width='30%' class='label-view text-right'>Uap Bekas</td>
						<td><?php echo $row['uap_bekas'] ;?> </td>
						
					</tr>
				
					<tr>
						<td width='30%' class='label-view text-right'>Suhu PP I</td>
						<td><?php echo $row['suhu_pp_i'] ;?> </td>
						
					</tr>
				
					<tr>
						<td width='30%' class='label-view text-right'>Suhu PP II</td>
						<td><?php echo $row['suhu_pp_ii'] ;?> </td>
						
					</tr>
				
					<tr>
						<td width='30%' class='label-view text-right'>Suhu PP III</td>
						<td><?php echo $row['suhu_pp_iii'] ;?> </td>
						
					</tr>
				
					<tr>
						<td width='30%' class='label-view text-right'>TURBIDITY NM</td>
						<td><?php echo $row['turbidity'] ;?> </td>
						
					</tr>
				
					<tr>
						<td width='30%' class='label-view text-right'>VACUUM EVA</td>
						<td><?php echo $row['v_eva'] ;?> </td>
						
					</tr>
				
					<tr>
						<td width='30%' class='label-view text-right'>VACUUM MASAKAN</td>
						<td><?php echo $row['v_masakan'] ;?> </td>
						
					</tr>
				
					<tr>
						<td width='30%' class='label-view text-right'>Be NK</td>
						<td><?php echo $row['be_nk'] ;?> </td>
						
					</tr>
				
						</tbody>	
					</table>    
				</div>
				<a href="<?php echo site_url('keragaanpabrik');?>" class="btn btn-sm btn-warning"> << Back </a>
			</div>
		</div>		
	

	</div>
</div>
</section>
	  