<section class="content-header">
          <h1>
            <?php echo $pageTitle ;?>
          </h1>
          <ol class="breadcrumb">

          	<li><i class="fa fa-dashboard"></i> <a href="<?php echo site_url('dashboard') ?>">Dashboard</a></li>
			<li><a href="<?php echo site_url('tspt') ?>"><?php echo $pageTitle ?></a></li>
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
						<td width='30%' class='label-view text-right'>No Petak</td>
						<td><?php echo $row['no_petak'] ;?> </td>
						
					</tr>
				
					<tr>
						<td width='30%' class='label-view text-right'>No Surat</td>
						<td><?php echo $row['no_surat'] ;?> </td>
						
					</tr>
				
					<tr>
						<td width='30%' class='label-view text-right'>H Brix Kebun</td>
						<td><?php echo $row['h_brix_kebun'] ;?> </td>
						
					</tr>
				
					<tr>
						<td width='30%' class='label-view text-right'>H Brix</td>
						<td><?php echo $row['h_brix'] ;?> </td>
						
					</tr>
				
					<tr>
						<td width='30%' class='label-view text-right'>H Pol</td>
						<td><?php echo $row['h_pol'] ;?> </td>
						
					</tr>
				
					<tr>
						<td width='30%' class='label-view text-right'>H Fk</td>
						<td><?php echo $row['h_fk'] ;?> </td>
						
					</tr>
				
					<tr>
						<td width='30%' class='label-view text-right'>H Kp</td>
						<td><?php echo $row['h_kp'] ;?> </td>
						
					</tr>
				
					<tr>
						<td width='30%' class='label-view text-right'>H Kdt</td>
						<td><?php echo $row['h_kdt'] ;?> </td>
						
					</tr>
				
					<tr>
						<td width='30%' class='label-view text-right'>H Tscore</td>
						<td><?php echo $row['h_tscore'] ;?> </td>
						
					</tr>
				
					<tr>
						<td width='30%' class='label-view text-right'>Tgl Analisa</td>
						<td><?php echo $row['h_tglanalisa'] ;?> </td>
						
					</tr>
				
					<tr>
						<td width='30%' class='label-view text-right'>Keterangan</td>
						<td><?php echo $row['keterangan'] ;?> </td>
						
					</tr>
				
					<tr>
						<td width='30%' class='label-view text-right'>User</td>
						<td><?php echo $row['user_act'] ;?> </td>
						
					</tr>
				
					<tr>
						<td width='30%' class='label-view text-right'>Tgl Buat</td>
						<td><?php echo $row['tgl_act'] ;?> </td>
						
					</tr>
				
					<tr>
						<td width='30%' class='label-view text-right'>Status</td>
						<td><?php echo $row['status'] ;?> </td>
						
					</tr>
				
						</tbody>	
					</table>    
				</div>
				<a href="<?php echo site_url('tspt');?>" class="btn btn-sm btn-warning"> << Back </a>
			</div>
		</div>		
	

	</div>
</div>
</section>
	  