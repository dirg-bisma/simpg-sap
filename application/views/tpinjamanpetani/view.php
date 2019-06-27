<section class="content-header">
          <h1>
            <?php echo $pageTitle ;?>
          </h1>
          <ol class="breadcrumb">

          	<li><i class="fa fa-dashboard"></i> <a href="<?php echo site_url('dashboard') ?>">Dashboard</a></li>
			<li><a href="<?php echo site_url('tpinjamanpetani') ?>"><?php echo $pageTitle ?></a></li>
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
						<td width='30%' class='label-view text-right'>Tgl Pencairan</td>
						<td><?php echo $row['tgl_pencairan'] ;?> </td>
						
					</tr>
				
					<tr>
						<td width='30%' class='label-view text-right'>ID Petani SAP</td>
						<td><?php echo $row['id_petani_sap'] ;?> </td>
						
					</tr>
				
					<tr>
						<td width='30%' class='label-view text-right'>Saldo Pinjaman</td>
						<td><?php echo $row['saldo_kredit'] ;?> </td>
						
					</tr>
				
					<tr>
						<td width='30%' class='label-view text-right'>Keterangan</td>
						<td><?php echo $row['keterangan'] ;?> </td>
						
					</tr>
				
					<tr>
						<td width='30%' class='label-view text-right'>Last Update</td>
						<td><?php echo $row['last_update'] ;?> </td>
						
					</tr>
				
					<tr>
						<td width='30%' class='label-view text-right'>User Update</td>
						<td><?php echo $row['user_update'] ;?> </td>
						
					</tr>
				
						</tbody>	
					</table>    
				</div>
				<a href="<?php echo site_url('tpinjamanpetani');?>" class="btn btn-sm btn-warning"> << Back </a>
			</div>
		</div>		
	

	</div>
</div>
</section>
	  