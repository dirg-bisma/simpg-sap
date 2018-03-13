<div class="col-md-4">


 <section class="content">
          <div class="row">
            <div class="col-xs-12">
			<span style="font-size:20px;padding-bottom:10px;padding">
            <center style="padding:10px;background:<?php echo $warna_meja_tebu;?>;"><b><?php echo $pageTitle.' - '.$kode_meja_tebu ;?> </b></center>
          </span>
              <div class="box" style="border-top:3px solid <?php echo $warna_meja_tebu;?>">
              	<div class="box-header with-border">


          
          
        
		
		 <form action="<?php echo site_url('tmejatebu/save/'); ?>" class='form-vertical' 
		 parsley-validate='true' novalidate='true' method="post" enctype="multipart/form-data" > 


<div class="col-md-12">
<div class="form-group  " >
									<label for="ipt" class=" control-label "> No SPTA  <span class="asterix"> * </span>  </label>									
									  <input type='text' class='form-control input-sm' placeholder='pastikan crusor disini untuk scan barcode'  id='no_spta-<?php echo $kode_meja_tebu;?>' autocomplete="off" onkeyup="getNoSPTA<?php echo $kode_meja_tebu;?>(event,this.value)"  required /> 						
								  </div>
									
								  <div class="form-group  col-md-6" >
									<label for="ipt" class=" control-label "> Kode Blok / No Petak  <span class="asterix"> * </span>  </label>									
									  <input type='text' class='form-control input-sm' readonly  id='kode_petak-<?php echo $kode_meja_tebu;?>'  required /> 						
								  </div>
								  
								  <div class="form-group  col-md-6" >
									<label for="ipt" class=" control-label "> Kategori  <span class="asterix"> * </span>  </label>									
									  <input type='text' class='form-control input-sm' readonly  id='kategori-<?php echo $kode_meja_tebu;?>'  required /> 						
								  </div>
								  
								   					
								  <div class="form-group hidethis " style="display:none;">
									<label for="ipt" class=" control-label "> Id Spta  <span class="asterix"> * </span>  </label>									
									  <input type='text' class='form-control input-sm' name='id_spta' id='id_spta-<?php echo $kode_meja_tebu;?>'  required /> 						
								  </div> 
									
								  <div class="form-group hidethis " style="display:none;">
									<label for="ipt" class=" control-label "> Id Mejatebu    </label>									
									  <input type='text' class='form-control input-sm' name='id_mejatebu'   /> 						
								  </div> 					
								  					
								 
			
									
								  <div class="form-group  " >
								  <div class="col-md-6">
									<label for="ipt" class=" control-label ">Meja Tebu    </label>									
									  <input type='text' class='form-control input-sm' readonly name='kode_meja_tebu'    value="<?php echo $kode_meja_tebu;?>" />
									
									<input type='hidden' class='form-control input-sm' readonly name='warna_meja_tebu'    value="<?php echo $warna_meja_tebu;?>" />
									
									<input type='hidden' class='form-control input-sm' readonly name='gilingan'    value="<?php echo $this->session->userdata('gilingan');?>" />
								  </div>

								  <div class="col-md-6">
									<label for="ipt" class=" control-label ">No Lori    </label>									
									  <input type='text' class='form-control input-sm' readonly id="no_transloading" />
								
								  </div> 
								  <div class="col-md-12">
									<label for="ipt" class=" control-label "> Kondisi Tebu  <span class="asterix"> * </span>  </label>									
									  <select name='kondisi_tebu' rows='5' id='kondisi_tebu-<?php echo $kode_meja_tebu;?>' code='{$kondisi_tebu}' 
							class='form-control input-sm  ' style='width: 100%;' required  ></select> 			
							</div>		
								  <!--div class="col-md-6">
								  <label for="ipt" class=" control-label "> Daduk  <span class="asterix"> * </span>  </label>									
									  <input type='number' class='form-control input-sm' placeholder='' value='0' name='daduk'  required />  
								  </div>
								  </div>
								  <div class="form-group  " >
								  <div class="col-md-6">
									<label for="ipt" class=" control-label "><br /> Sogolan  <span class="asterix"> * </span>  </label>									
									  <input type='number' class='form-control input-sm' placeholder='' value='0' name='sogolan'  required /> 	
								  </div>
								  <div class="col-md-6">
									<label for="ipt" class=" control-label "><br /> Non Tebu  <span class="asterix"> * </span>  </label>									
									  <input type='number' class='form-control input-sm' placeholder='' value='0' name='non_tebu'  required /> 		
								  </div>
								  </div><div class="form-group  " >
								  <div class="col-md-6">
									<label for="ipt" class=" control-label "><br /> Akar Tanah  <span class="asterix"> * </span>  </label>									
									  <input type='number' class='form-control input-sm' placeholder='' value='0' name='akar_tanah'  required /> 
								  </div>
								  <div class="col-md-6">
									<label for="ipt" class=" control-label "><br /> Pucuk  <span class="asterix"> * </span>  </label>									
									  <input type='number' class='form-control input-sm' placeholder='' value='0' name='pucuk'  required /> 
								  </div-->
								</div>
								 	
								  
								  <!--div class="form-group  " >				
								  <div class="col-md-4">
								  <br />
								  <div class="checkbox" style="margin-left:-20px">
								  <label>
									<input type="checkbox" name="terbakar" value="1" > <br /> <br /><b><span style="color:white;background:red; padding:3px"> TERBAKAR</span></b>
								  </label>
								</div> 		
								</div> 
								
								<div class="col-md-4">
								<br />
								  <div class="checkbox" style="margin-left:-20px">
								  <label>
									<input type="checkbox" name="cacahan" value="1"> <br /> <br /><b><span style="color:white;background:red; padding:3px"> CACAHAN</span></b>
								  </label>
								</div> 		
								</div> 
								
								<div class="col-md-4">
								<br />
								  <div class="checkbox" style="margin-left:-20px">
								  <label>
									<input type="checkbox"  name="brondolan" value="1"><br /> <br /> <b><span style="color:white;background:red; padding:3px"> BRONDOLAN</span></b>
								  </label>
								</div> 		
								</div> 
								  </div-->
													
								   
			</div>
			
			
			
		
			<div style="clear:both"></div>	
			<hr />
				
 		<div class="toolbar-line text-center">		
			
			<input type="submit" name="submit" class="btn btn-primary btn-sm" value="<?php echo $this->lang->line('core.sb_submit'); ?>" />
			<a href="<?php echo site_url('tmejatebu');?>" class="btn btn-sm btn-warning"><?php echo $this->lang->line('core.sb_cancel'); ?> </a>
 		</div>
			  		
		</form>

	</div>
	</div>
</div>		
</div>	
      </section>
			 
<script type="text/javascript">
$(document).ready(function() { 
		$(".sidebar-toggle").trigger("click");
		$('#no_spta-<?php echo $kode_meja_tebu;?>').focus();
		$('form input').on('keypress', function(e) {
		return e.which !== 13;
	});
	
		$("#kondisi_tebu-<?php echo $kode_meja_tebu;?>").jCombo("<?php echo site_url('tmejatebu/comboselect?filter=m_rafaksi:nilai:nilai') ?>",
		{  selected_value : '' });
	

});

function getNoSPTA<?php echo $kode_meja_tebu;?>(e,nospta){
	nospta = nospta.toUpperCase();
	
	if(e.keyCode == 13 && nospta != ''){
		var x = nospta.split("-");
		if(x[0] == '<?php echo CNF_PLANCODE;?>' && nospta.length == 18){
			$.ajax({
            type: 'POST',
            url: "<?php echo site_url('tmejatebu/cekspta');?>",
            data: {nospta:nospta},
			dataType: 'json',
            success: function (dat) {
				if(dat.stt == 1){
					if(dat.data.ed == 0 && dat.data.stt == 1){
						$('#kode_petak-<?php echo $kode_meja_tebu;?>').val(dat.data.kode_blok);
						$('#id_spta-<?php echo $kode_meja_tebu;?>').val(dat.data.id);
						$('#kategori-<?php echo $kode_meja_tebu;?>').val(dat.data.kode_kat_lahan);
						$('#no_spta-<?php echo $kode_meja_tebu;?>').attr('readonly',true);
						
					}else{
						
							var al = dat.data.ed;
							if(dat.data.ed == 0){
								al = dat.data.stt;
							}
							alert(al);
						
						$('#no_spta-<?php echo $kode_meja_tebu;?>').val('');
					}
					
				}else{
					alert('Data SPTA '+nospta+' Tidak ditemukan dalam database kami! silahkan hubungi Bagian Tanaman <?php echo CNF_PG;?>');
					$('#no_spta-<?php echo $kode_meja_tebu;?>').val('');
				}
            }
        });
		}else{
			alert('No SPTA tidak sesuai format / tidak dikeluarkan oleh <?php echo CNF_PG;?>');
			$('#no_spta-<?php echo $kode_meja_tebu;?>').val('');
		}
	}
}


</script>	
</div>	 