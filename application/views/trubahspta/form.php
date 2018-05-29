<section class="content-header">
          <h1>
            <?php echo $pageTitle ;?>
          </h1>
          <ol class="breadcrumb">
            <li><i class="fa fa-dashboard"></i><a href="<?php echo site_url('dashboard') ?>"> Dashboard </a></li>
		<li><a href="<?php echo site_url('trubahspta') ?>"><?php echo $pageTitle ?></a></li>
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
		 <form action="<?php echo site_url('trubahspta/save/'.$row['id']); ?>" class='form-vertical' 
		 parsley-validate='true' novalidate='true' method="post" enctype="multipart/form-data" > 


<div class="col-md-6">
									
								  <div class="form-group hidethis " style="display:none;">
									<label for="ipt" class=" control-label "> Id    </label>									
									  <input type='text' class='form-control input-sm' placeholder='' value='<?php echo $row['id'];?>' name='id'   /> 						
								  </div> 					
								  <div class="form-group hidethis " style="display:none;">
									<label for="ipt" class=" control-label "> Id Spta  <span class="asterix"> * </span>  </label>									
									  <input type='text' class='form-control input-sm' placeholder='' value='<?php echo $row['id_spta'];?>' name='id_spta' id='id_spta'  required /> 						
								  </div> 					
								  <div class="form-group  " >
									<label for="ipt" class=" control-label "> No SPTA  <span class="asterix"> * </span>  </label>									
									  <input type='text' class='form-control input-sm' placeholder='' value='<?php echo $row['no_spta'];?>' autocomplete="off" name='no_spta' id='no_spta' onkeyup="getNoSPTA(event,this.value)" required <?php if($row['no_spta'] != '') echo 'readonly';?> /> 						
								  </div> 					
								  <div class="form-group col-md-6 " >
									<label for="ipt" class=" control-label "> Tebang PG  <span class="asterix"> * </span>  </label>									
									  <input type='text' class='form-control input-sm' placeholder='' value='<?php echo $row['tebang_pg'];?>' name='tebang_pg' id='tebang_pg'  required readonly /> 						
								  </div> 					
								  <div class="form-group col-md-6 " >
									<label for="ipt" class=" control-label "> Angkut PG  <span class="asterix"> * </span>  </label>									
									  <input type='text' class='form-control input-sm' placeholder='' value='<?php echo $row['angkut_pg'];?>' name='angkut_pg' id='angkut_pg'  required readonly /> 						
								  </div> 					
								  <div class="form-group  " >
									<label for="ipt" class=" control-label "> Vendor    </label>									
									  <select name='vendor' rows='5' id='vendor' code='{$vendor}' 
							class='form-control input-sm  ' style='width: 100%;' readonly  ></select> 						
								  </div> 
			</div>
			
			<div class="col-md-6">
									
								  <div class="form-group  " >
									<label for="ipt" class=" control-label "> No Ba  <span class="asterix"> * </span>  </label>									
									  <input type='text' class='form-control input-sm' placeholder='' value='<?php echo $row['no_ba'];?>' name='no_ba' readonly  required /> 						
								  </div> 					
								  <div class="form-group col-md-6 " >
									<label for="ipt" class=" control-label "> Rubah Tebang PG  <span class="asterix"> * </span>  </label>									
									  
					<?php $rubah_tebang_pg = explode(',',$row['rubah_tebang_pg']);
					$rubah_tebang_pg_opt = array( '0' => 'Tidak' ,  '1' => 'Ya' , ); ?>
					<select name='rubah_tebang_pg' id='rubah_tebang_pg' rows='5' required  class='form-control input-sm ' style='width: 100%;' > 
						<?php 
						foreach($rubah_tebang_pg_opt as $key=>$val)
						{
							echo "<option  value ='$key' ".($row['rubah_tebang_pg'] == $key ? " selected='selected' " : '' ).">$val</option>"; 						
						}						
						?></select> 						
								  </div> 					
								  <div class="form-group col-md-6 " >
									<label for="ipt" class=" control-label "> Rubah Angkut PG  <span class="asterix"> * </span>  </label>									
									  
					<?php $tubah_angkut_pg = explode(',',$row['tubah_angkut_pg']);
					$tubah_angkut_pg_opt = array( '0' => 'Tidak' ,  '1' => 'Ya' , ); ?>
					<select name='tubah_angkut_pg' id='tubah_angkut_pg' rows='5' required  class='form-control input-sm ' style='width: 100%;' > 
						<?php 
						foreach($tubah_angkut_pg_opt as $key=>$val)
						{
							echo "<option  value ='$key' ".($row['tubah_angkut_pg'] == $key ? " selected='selected' " : '' ).">$val</option>"; 						
						}						
						?></select> 						
								  </div> 					
								  <div class="form-group  " >
									<label for="ipt" class=" control-label "> Rubah Vendor    </label>									
									  <select name='rubah_vendor' rows='5' id='rubah_vendor' code='{$rubah_vendor}' 
							class='form-control input-sm  ' style='width: 100%;'   ></select> 						
								  </div>
								  <div class="form-group  " >
									<label for="ipt" class=" control-label "> Alasan <span class="asterix"> * </span>  </label>									
									  <input type="text" name="alasan" class='form-control input-sm' value='<?php echo $row['alasan'];?>' required>						
								  </div> 
			</div>
			
			
		
			<div style="clear:both"></div>	
				
 		<div class="toolbar-line text-center">		
			
			<input type="submit" name="submit" class="btn btn-primary btn-sm" value="<?php echo $this->lang->line('core.sb_submit'); ?>" />
			<a href="<?php echo site_url('trubahspta');?>" class="btn btn-sm btn-warning"><?php echo $this->lang->line('core.sb_cancel'); ?> </a>
 		</div>
			  		
		</form>

	</div>
	</div>
</div>		
</div>	
      </section>
			 
<script type="text/javascript">
$(document).ready(function() { 

		$("#vendor").jCombo("<?php echo site_url('trubahspta/comboselect?filter=m_vendor:id_vendor:nama_vendor') ?>",
		{  selected_value : '<?php echo $row["vendor"] ?>' });
		
		$("#rubah_vendor").jCombo("<?php echo site_url('trubahspta/comboselect?filter=m_vendor:id_vendor:nama_vendor') ?>",
		{  selected_value : '<?php echo $row["rubah_vendor"] ?>' });

		$('form input').on('keypress', function(e) {
            return e.which !== 13;
        });
        $('#no_spta').focus();


        if($('#no_spta').val() !== ""){
            setNoSPTA($('#no_spta').val());
        }
		 	 
});


function getNoSPTA(e,nospta){
        nospta = nospta.toUpperCase();

        if(e.keyCode == 13 && nospta != ''){
            var x = nospta.split("-");
            if(x[0] == '<?php echo CNF_PLANCODE;?>' && nospta.length == 18){
                $.ajax({
                    type: 'POST',
                    url: "<?php echo site_url('trubahspta/cekspta');?>",
                    data: {nospta:nospta},
                    dataType: 'json',
                    success: function (dat) {
                        if(dat.stt == 1){
                            $('#tebang_pg').val(dat.data.tebang_pg);
                            $('#angkut_pg').val(dat.data.angkut_pg);
                            $('#vendor').val(dat.data.vendor_angkut);
                            $('#id_spta').val(dat.data.id);

                            $('#rubah_tebang_pg').val(dat.data.tebang_pg);
                            $('#tubah_angkut_pg').val(dat.data.angkut_pg);
                            $('#rubah_vendor').val(dat.data.vendor_angkut);
                        }else{
                            alert('data dengan No SPTA '+nospta+' tidak boleh diedit lagi');
                        }

                    }
                });

            }else{
                alert('No SPTA tidak sesuai format / tidak dikeluarkan oleh <?php echo CNF_PG;?>');
                $('#no_spta').val('');
            }
        }
    }
</script>		 