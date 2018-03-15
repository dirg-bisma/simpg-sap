<section class="content-header">
          <h1>
            <?php echo $pageTitle ;?>
          </h1>
          <ol class="breadcrumb">
            <li><i class="fa fa-dashboard"></i><a href="<?php echo site_url('dashboard') ?>"> Dashboard </a></li>
		<li><a href="<?php echo site_url('tselektor') ?>"><?php echo $pageTitle ?></a></li>
		<li class="active"> Form </li>
          </ol>
        </section>

 <section class="content">
          <div class="row">
            <div class="col-xs-12">
              <div class="box box-danger">
              	<div class="box-header with-border">

			<ul class="parsley-error-list">
				<?php echo $this->session->flashdata('errors');?>
			</ul>
		 <form action="<?php echo site_url('tselektor/save/'); ?>" class='form-vertical' 
		 parsley-validate='true' novalidate='true' id="frmSelektor" method="post" enctype="multipart/form-data" > 


<div class="col-md-3">
								<div class="form-group  " >
									<label for="ipt" class=" control-label "> No SPTA  <span class="asterix"> * </span>  </label>									
									  <input type='text' class='form-control input-sm' placeholder='pastikan crusor disini untuk scan barcode'  id='no_spta' autocomplete="off" onkeyup="getNoSPTA(event,this.value)"  required /> 						
								  </div>
									
								  
								  
								  
								  <div class="form-group col-md-8">
									<label for="ipt" class=" control-label "> Tgl Tebang  <span class="asterix"> * </span>  </label>									
									  
				<input type='text' class='form-control input-sm date' name='tgl_tebang' value="<?php echo date('Y-m-d');?>"  required readonly /> 				
									</div>
									<div class="form-group col-md-4">
									<label for="ipt" class=" control-label "> Jam  <span class="asterix"> * </span>  </label>									
									  
				<input type='text' max="5" class='form-control input-sm' name='jam_tebang' id='jam_tebang' placeholder="06:00"  required /> 				
									</div>
								  <div class="form-group col-md-4 " >
									<label for="ipt" class=" control-label "> Brix  <span class="asterix"> * </span>  </label>									
									  <input type='number' class='form-control input-sm' name='brix_sel'  required /> 						
								  </div> 					
								  <div class="form-group  col-md-4" >
									<label for="ipt" class=" control-label "> Ph  <span class="asterix"> * </span>  </label>									
									  <input type='number' class='form-control input-sm' name='ph_sel'  required /> 						
								  </div> 					
								 
									<div class="form-group col-md-4 " >
									<label for="ipt" class=" control-label "> Ha Tebang  <span class="asterix"> * </span>  </label>									
									  <input type='number' onkeyup="cekha(this.value)" class='form-control input-sm' name='ha_tertebang' id="hektar_tertebang"  required /> 						
								  </div>
								 					
									<div class="form-group col-md-6 " >
									<label for="ipt" class=" control-label "> No Angkutan   <span class="asterix"> * </span>  </label>									
									  <input type='text' class='form-control input-sm' name='no_angkutan' style="text-transform:uppercase" placeholder="(No truk/No Lori/No traktor)" required /> 						
								  </div> 					
								  <div class="form-group  col-md-6" >
									<label for="ipt" class=" control-label "> Petugas Angkut   <span class="asterix"> * </span>  </label>									
									  <input type='text' class='form-control input-sm' style="text-transform:uppercase" name='ptgs_angkutan' placeholder="(Supir/Op. Lori/Op. Traktor)" required /> 						
								  </div> 
								  

								  
								  <div class="form-group hidethis " style="display:none;">
									<label for="ipt" class=" control-label "> Id Selektor    </label>									
									  <input type='text' class='form-control input-sm' name='id_selektor'   /> 						
								  </div> 					
								  <div class="form-group hidethis " style="display:none;">
									<label for="ipt" class=" control-label "> Id Spta  <span class="asterix"> * </span>  </label>									
									  <input type='text' class='form-control input-sm' name='id_spta' id='id_spta'  required /> 						
								  </div> 
								  
			</div>
			<div class="col-md-3">
									
								 				
								  					
								  <div class="form-group  " >
								  
									<label for="ipt" class=" control-label "> Mandor Tebang / Renteng  <span class="asterix"> * </span>  </label>									
									  <select name='persno_mandor_tma' rows='5' id='persno_mandor_tma' code='{$persno_mandor_tma}' 
							class='form-control input-sm  ' style='width: 100%;' required  ></select> 						
								  </div> 

								   <div class="form-group  " >
									<label for="ipt" class=" control-label "> No TrainStat / No Tarikan Lori    </label>									
									  <input type='text' class='form-control input-sm' placeholder=''  name='no_trainstat'  value="<?php echo  $this->session->flashdata('no_trainstat');?>"  /> 						
								  </div> 	
								  
								   <div class="form-group  " >
								  <div class="col-md-6">
								  <div class="checkbox" style="margin-left:-20px">
								  <label>
									<input type="checkbox" id="terbakar_sel1" name="terbakar_sel" value="1"> <b><span style="color:white;background:red; padding:3px"><i class="fa fa-fire"></i> TERBAKAR</span></b>
								  </label>
								</div> 		
								</div>
								<div class="col-md-6">
								  <div class="checkbox">
								  <label>
									<input type="checkbox" id="ditolak_sel1" name="ditolak_sel" value="1" > <b><span style="color:white;background:black; padding:3px"><i class="fa fa-close"></i> DITOLAK</span></b>
								  </label>
								</div> 		
								</div>
								  </div> 

								  <div class="form-group  " >
									<label for="ipt" class=" control-label "> Alasan Ditolak    </label>									
									  <textarea name='ditolak_alasan' rows='2' id='ditolak_alasan' class='form-control input-sm '></textarea> 						
								  </div> 
			</div>
			
			<div class="col-md-3">
			<div class="form-group  " >
									<label for="ipt" class=" control-label "> Kode Blok / No Petak  <span class="asterix"> * </span>  </label>									
									  <input type='text' class='form-control input-sm' readonly  id='kode_petak'  required /> 						
								  </div>
								  
								  <div class="form-group  col-md-6" >
									<label for="ipt" class=" control-label "> Kategori  <span class="asterix"> * </span>  </label>									
									  <input type='text' class='form-control input-sm' readonly  id='kategori'  required /> 						
								  </div>
								  
								  <div class="form-group  col-md-6" >
									<label for="ipt" class=" control-label "> Afdeling  <span class="asterix"> * </span>  </label>									
									  <input type='text' class='form-control input-sm' readonly  id='afdeling'  required /> 						
								  </div>
								  <div class="form-group  col-md-6" >
									<label for="ipt" class=" control-label "> Jenis Angkutan  <span class="asterix"> * </span>  </label>									
									  <input type='text' class='form-control input-sm' readonly  id='jenis_angkutan'  required /> 						
								  </div>
								  <div class="form-group  col-md-6" >
									<label for="ipt" class=" control-label "> Jenis Tebangan  <span class="asterix"> * </span>  </label>									
									  <input type='text' class='form-control input-sm' readonly  id='jenis_tebangan'  required /> 						
								  </div>

								  <div class="form-group" >
									<label for="ipt" class=" control-label "> Kategori Tebangan  <span class="asterix"> * </span>  </label>									
									  <input type='text' class='form-control input-sm' readonly  id='kat_tebangan'  required /> 						
								  </div>

								  
			</div>
			
			
			<div class="col-md-3" id="manual">
													
								  <div class="form-group  " >
									<label for="ipt" class=" control-label "> No Harvester    </label>									
									  <input type='text' class='form-control input-sm' name='no_hv'   /> 						
								  </div> 					
								  <div class="form-group  " >
									<label for="ipt" class=" control-label "> Op Harvester    </label>									
									  <input type='text' class='form-control input-sm' name='op_hv'   /> 						
								  </div> 					
								  <div class="form-group  " >
									<label for="ipt" class=" control-label "> No S.tipping    </label>									
									  <input type='text' class='form-control input-sm' name='no_stipping'   /> 						
								  </div> 					
								  <div class="form-group  " >
									<label for="ipt" class=" control-label "> Op S.tipping    </label>									
									  <input type='text' class='form-control input-sm' name='op_stipping'   /> 						
								  </div> 					
								  <div class="form-group  mekanisasi" >
									<label for="ipt" class=" control-label "> No Grab Loader    </label>									
									  <input type='text' class='form-control input-sm' name='no_gl'   /> 						
								  </div> 					
								  <div class="form-group  mekanisasi" >
									<label for="ipt" class=" control-label "> Op Grab Loader    </label>									
									  <input type='text' class='form-control input-sm' name='op_gl'   /> 						
								  </div> 
			</div>
			
			
		
			<div style="clear:both"></div>	
				
 		<div class="toolbar-line text-center">		
			
			<input type="submit" name="submit" class="btn btn-primary btn-sm" value="<?php echo $this->lang->line('core.sb_submit'); ?>" />
			<a href="<?php echo site_url('tselektor');?>" class="btn btn-sm btn-warning"><?php echo $this->lang->line('core.sb_cancel'); ?> </a>
 		</div>
			  		
		</form>

	</div>
	</div>
</div>		
</div>	
      </section>
			 
<script type="text/javascript">
$(document).ready(function() { 
var idselektor = '<?php echo $this->session->flashdata('idselektor')?>';
		if(idselektor != ''){
			window.open('<?php echo site_url('tselektor/cetak')?>/'+idselektor,'_blank');
		}
		$(".sidebar-toggle").trigger("click");
		$('#manual').hide();
		$("#persno_mandor_tma").jCombo("<?php echo site_url('tselektor/comboselect?filter=sap_m_karyawan:Persno:Persno|name:id_jabatan:3') ?>",
		{  selected_value : '' });
	
	$('form input').on('keypress', function(e) {
		return e.which !== 13;
	});
    $('#no_spta').focus();
    <?php
    $idx = $this->session->flashdata('idselektor');
    	if(isset($dx) && $idx != ''){
    		?>
    			window.open('<?php echo site_url('tselektor/cetak/'.$idx);?>','_blank');
    		<?php
    	}
    ?>
//	getev();
	
	
});


function getNoSPTA(e,nospta){
	nospta = nospta.toUpperCase();
	
	if(e.keyCode == 13 && nospta != ''){
		var x = nospta.split("-");
		if(x[0] == '<?php echo CNF_PLANCODE;?>' && nospta.length == 18){
			$.ajax({
            type: 'POST',
            url: "<?php echo site_url('tselektor/cekspta');?>",
            data: {nospta:nospta},
			dataType: 'json',
            success: function (dat) {
				if(dat.stt == 1){
					if(dat.data.berlaku == 1 && dat.data.ed == 0 && dat.data.stt == 0){
						$('#afdeling').val(dat.data.kode_affd);
						$('#kode_petak').val(dat.data.kode_blok);
						$('#id_spta').val(dat.data.id);
						$('#kategori').val(dat.data.kode_kat_lahan);
						$('#jenis_tebangan').val(dat.data.txt_metode_tma);
						$('#jenis_angkutan').val(dat.data.jenis_spta);
						$('#kat_tebangan').val(dat.data.kat_spta);
						$('#no_spta').attr('readonly',true);
						$('#jam_tebang').focus();
						if(dat.data.metode_tma == 2){
							$('#manual').show();
							$('.mekanisasi').hide();
						}else if(dat.data.metode_tma == 3){
							$('#manual').show();
							$('.mekanisasi').show();
						}if(dat.data.metode_tma == 1){
							$('#manual').hide();
						}
					}else{
						if(dat.data.berlaku == 1){
							var al = dat.data.ed;
							if(dat.data.ed == 0){
								al = dat.data.stt;
							}
							alert(al);
						}else{
							alert(dat.data.berlaku);
						}
						$('#no_spta').val('');
					}
					
				}else{
					alert('Data SPTA '+nospta+' Tidak ditemukan dalam database kami! silahkan hubungi Bagian Tanaman <?php echo CNF_PG;?>');
					$('#no_spta').val('');
				}
            }
        });
		}else{
			alert('No SPTA tidak sesuai format / tidak dikeluarkan oleh <?php echo CNF_PG;?>');
			$('#no_spta').val('');
		}
	}
}

function cekha(a){
	if(a > 0.15){
		alert('Hektar tidak boleh melebihi 0.15 hektar');
		$('#hektar_tertebang').val(0);
	}
}


</script>		 