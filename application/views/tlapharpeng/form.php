<section class="content-header">
          <h1>
            <?php echo $pageTitle ;?>
          </h1>
          <ol class="breadcrumb">
            <li><i class="fa fa-dashboard"></i><a href="<?php echo site_url('dashboard') ?>"> Dashboard </a></li>
		<li><a href="<?php echo site_url('tlapharpeng') ?>"><?php echo $pageTitle ?></a></li>
		<li class="active"> Form </li>
          </ol>
        </section>

 <section class="content">
          <div class="row">
            <div class="col-xs-12">
              <div class="box box-danger">
              	<div class="box-header with-border">


		<?php echo $this->session->flashdata('message');?>
			<ul class="parsley-error-list">
				<?php echo $this->session->flashdata('errors');?>
			</ul>
		 <form action="<?php echo site_url('tlapharpeng/save/'.$row['id_lap_harian_pengolahan']); ?>" class='form-horizontal' 
		 parsley-validate='true' novalidate='true' method="post" enctype="multipart/form-data" > 


<div class="col-md-12">
									
								  <div class="form-group  " >
									<label for="Id Lap Harian Pengolahan" class=" control-label col-md-4 text-left"> Id Lap Harian Pengolahan </label>
									<div class="col-md-8">
									  <input type='text' class='form-control input-sm' placeholder='' value='<?php echo $row['id_lap_harian_pengolahan'];?>' name='id_lap_harian_pengolahan'   /> <br />
									  <i> <small></small></i>
									 </div> 
								  </div> 					
								  <div class="form-group  " >
									<label for="Jam Berhenti A" class=" control-label col-md-4 text-left"> Jam Berhenti A </label>
									<div class="col-md-8">
									  <input type='text' class='form-control input-sm' placeholder='' value='<?php echo $row['jam_berhenti_a'];?>' name='jam_berhenti_a'   /> <br />
									  <i> <small></small></i>
									 </div> 
								  </div> 					
								  <div class="form-group  " >
									<label for="Jam Berhenti B" class=" control-label col-md-4 text-left"> Jam Berhenti B </label>
									<div class="col-md-8">
									  <input type='text' class='form-control input-sm' placeholder='' value='<?php echo $row['jam_berhenti_b'];?>' name='jam_berhenti_b'   /> <br />
									  <i> <small></small></i>
									 </div> 
								  </div> 					
								  <div class="form-group  " >
									<label for="Jam Kampanye" class=" control-label col-md-4 text-left"> Jam Kampanye </label>
									<div class="col-md-8">
									  <input type='text' class='form-control input-sm' placeholder='' value='<?php echo $row['jam_kampanye'];?>' name='jam_kampanye'   /> <br />
									  <i> <small></small></i>
									 </div> 
								  </div> 					
								  <div class="form-group  " >
									<label for="Kis" class=" control-label col-md-4 text-left"> Kis </label>
									<div class="col-md-8">
									  <input type='text' class='form-control input-sm' placeholder='' value='<?php echo $row['kis'];?>' name='kis'   /> <br />
									  <i> <small></small></i>
									 </div> 
								  </div> 					
								  <div class="form-group  " >
									<label for="Kes" class=" control-label col-md-4 text-left"> Kes </label>
									<div class="col-md-8">
									  <input type='text' class='form-control input-sm' placeholder='' value='<?php echo $row['kes'];?>' name='kes'   /> <br />
									  <i> <small></small></i>
									 </div> 
								  </div> 					
								  <div class="form-group  " >
									<label for="Prod Gula" class=" control-label col-md-4 text-left"> Prod Gula </label>
									<div class="col-md-8">
									  <input type='text' class='form-control input-sm' placeholder='' value='<?php echo $row['prod_gula'];?>' name='prod_gula'   /> <br />
									  <i> <small></small></i>
									 </div> 
								  </div> 					
								  <div class="form-group  " >
									<label for="Ex Sisan Gula" class=" control-label col-md-4 text-left"> Ex Sisan Gula </label>
									<div class="col-md-8">
									  <input type='text' class='form-control input-sm' placeholder='' value='<?php echo $row['ex_sisan_gula'];?>' name='ex_sisan_gula'   /> <br />
									  <i> <small></small></i>
									 </div> 
								  </div> 					
								  <div class="form-group  " >
									<label for="Sisan Diolah" class=" control-label col-md-4 text-left"> Sisan Diolah </label>
									<div class="col-md-8">
									  <input type='text' class='form-control input-sm' placeholder='' value='<?php echo $row['sisan_diolah'];?>' name='sisan_diolah'   /> <br />
									  <i> <small></small></i>
									 </div> 
								  </div> 					
								  <div class="form-group  " >
									<label for="Prod Tetes" class=" control-label col-md-4 text-left"> Prod Tetes </label>
									<div class="col-md-8">
									  <input type='text' class='form-control input-sm' placeholder='' value='<?php echo $row['prod_tetes'];?>' name='prod_tetes'   /> <br />
									  <i> <small></small></i>
									 </div> 
								  </div> 					
								  <div class="form-group  " >
									<label for="Ex Sisan Tetes" class=" control-label col-md-4 text-left"> Ex Sisan Tetes </label>
									<div class="col-md-8">
									  <input type='text' class='form-control input-sm' placeholder='' value='<?php echo $row['ex_sisan_tetes'];?>' name='ex_sisan_tetes'   /> <br />
									  <i> <small></small></i>
									 </div> 
								  </div> 					
								  <div class="form-group  " >
									<label for="Sto Tetes" class=" control-label col-md-4 text-left"> Sto Tetes </label>
									<div class="col-md-8">
									  <input type='text' class='form-control input-sm' placeholder='' value='<?php echo $row['sto_tetes'];?>' name='sto_tetes'   /> <br />
									  <i> <small></small></i>
									 </div> 
								  </div> 					
								  <div class="form-group  " >
									<label for="Ex Repro Tll" class=" control-label col-md-4 text-left"> Ex Repro Tll </label>
									<div class="col-md-8">
									  <input type='text' class='form-control input-sm' placeholder='' value='<?php echo $row['ex_repro_tll'];?>' name='ex_repro_tll'   /> <br />
									  <i> <small></small></i>
									 </div> 
								  </div> 					
								  <div class="form-group  " >
									<label for="Bba" class=" control-label col-md-4 text-left"> Bba </label>
									<div class="col-md-8">
									  <input type='text' class='form-control input-sm' placeholder='' value='<?php echo $row['bba'];?>' name='bba'   /> <br />
									  <i> <small></small></i>
									 </div> 
								  </div> 					
								  <div class="form-group  " >
									<label for="Rupiah Bba" class=" control-label col-md-4 text-left"> Rupiah Bba </label>
									<div class="col-md-8">
									  <input type='text' class='form-control input-sm' placeholder='' value='<?php echo $row['rupiah_bba'];?>' name='rupiah_bba'   /> <br />
									  <i> <small></small></i>
									 </div> 
								  </div> 					
								  <div class="form-group  " >
									<label for="Gula Repro Tll" class=" control-label col-md-4 text-left"> Gula Repro Tll </label>
									<div class="col-md-8">
									  <input type='text' class='form-control input-sm' placeholder='' value='<?php echo $row['gula_repro_tll'];?>' name='gula_repro_tll'   /> <br />
									  <i> <small></small></i>
									 </div> 
								  </div> 					
								  <div class="form-group  " >
									<label for="Raw Sugar" class=" control-label col-md-4 text-left"> Raw Sugar </label>
									<div class="col-md-8">
									  <input type='text' class='form-control input-sm' placeholder='' value='<?php echo $row['raw_sugar'];?>' name='raw_sugar'   /> <br />
									  <i> <small></small></i>
									 </div> 
								  </div> 					
								  <div class="form-group  " >
									<label for="Gula Repro Th Ini" class=" control-label col-md-4 text-left"> Gula Repro Th Ini </label>
									<div class="col-md-8">
									  <input type='text' class='form-control input-sm' placeholder='' value='<?php echo $row['gula_repro_th_ini'];?>' name='gula_repro_th_ini'   /> <br />
									  <i> <small></small></i>
									 </div> 
								  </div> 					
								  <div class="form-group  " >
									<label for="Ton Ampas" class=" control-label col-md-4 text-left"> Ton Ampas </label>
									<div class="col-md-8">
									  <input type='text' class='form-control input-sm' placeholder='' value='<?php echo $row['ton_ampas'];?>' name='ton_ampas'   /> <br />
									  <i> <small></small></i>
									 </div> 
								  </div> 					
								  <div class="form-group  " >
									<label for="Persen Pol Ampas" class=" control-label col-md-4 text-left"> Persen Pol Ampas </label>
									<div class="col-md-8">
									  <input type='text' class='form-control input-sm' placeholder='' value='<?php echo $row['persen_pol_ampas'];?>' name='persen_pol_ampas'   /> <br />
									  <i> <small></small></i>
									 </div> 
								  </div> 					
								  <div class="form-group  " >
									<label for="Ton Blotong" class=" control-label col-md-4 text-left"> Ton Blotong </label>
									<div class="col-md-8">
									  <input type='text' class='form-control input-sm' placeholder='' value='<?php echo $row['ton_blotong'];?>' name='ton_blotong'   /> <br />
									  <i> <small></small></i>
									 </div> 
								  </div> 					
								  <div class="form-group  " >
									<label for="Persen Pol Blotong" class=" control-label col-md-4 text-left"> Persen Pol Blotong </label>
									<div class="col-md-8">
									  <input type='text' class='form-control input-sm' placeholder='' value='<?php echo $row['persen_pol_blotong'];?>' name='persen_pol_blotong'   /> <br />
									  <i> <small></small></i>
									 </div> 
								  </div> 					
								  <div class="form-group  " >
									<label for="Ton Pol Dlm Hasil Plus Taksasi" class=" control-label col-md-4 text-left"> Ton Pol Dlm Hasil Plus Taksasi </label>
									<div class="col-md-8">
									  <input type='text' class='form-control input-sm' placeholder='' value='<?php echo $row['ton_pol_dlm_hasil_plus_taksasi'];?>' name='ton_pol_dlm_hasil_plus_taksasi'   /> <br />
									  <i> <small></small></i>
									 </div> 
								  </div> 					
								  <div class="form-group  " >
									<label for="Persen Pol Dlm Hasil Plus Taksasi" class=" control-label col-md-4 text-left"> Persen Pol Dlm Hasil Plus Taksasi </label>
									<div class="col-md-8">
									  <input type='text' class='form-control input-sm' placeholder='' value='<?php echo $row['persen_pol_dlm_hasil_plus_taksasi'];?>' name='persen_pol_dlm_hasil_plus_taksasi'   /> <br />
									  <i> <small></small></i>
									 </div> 
								  </div> 					
								  <div class="form-group  " >
									<label for="Hari Giling" class=" control-label col-md-4 text-left"> Hari Giling </label>
									<div class="col-md-8">
									  <input type='text' class='form-control input-sm' placeholder='' value='<?php echo $row['hari_giling'];?>' name='hari_giling'   /> <br />
									  <i> <small></small></i>
									 </div> 
								  </div> 					
								  <div class="form-group  " >
									<label for="Tahun Giling" class=" control-label col-md-4 text-left"> Tahun Giling </label>
									<div class="col-md-8">
									  <input type='text' class='form-control input-sm' placeholder='' value='<?php echo $row['tahun_giling'];?>' name='tahun_giling'   /> <br />
									  <i> <small></small></i>
									 </div> 
								  </div> 					
								  <div class="form-group  " >
									<label for="Tgl" class=" control-label col-md-4 text-left"> Tgl </label>
									<div class="col-md-8">
									  <input type='text' class='form-control input-sm' placeholder='' value='<?php echo $row['tgl'];?>' name='tgl'   /> <br />
									  <i> <small></small></i>
									 </div> 
								  </div> 
			</div>
			
			
		
			<div style="clear:both"></div>	
				
 		<div class="toolbar-line text-center">		
			
			<input type="submit" name="submit" class="btn btn-primary btn-sm" value="<?php echo $this->lang->line('core.sb_submit'); ?>" />
			<a href="<?php echo site_url('tlapharpeng');?>" class="btn btn-sm btn-warning"><?php echo $this->lang->line('core.sb_cancel'); ?> </a>
 		</div>
			  		
		</form>

	</div>
	</div>
</div>		
</div>	
      </section>
			 
<script type="text/javascript">
$(document).ready(function() { 
 	 
});
</script>		 