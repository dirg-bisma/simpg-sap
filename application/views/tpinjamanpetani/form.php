<section class="content-header">
          <h1>
            <?php echo $pageTitle ;?>
          </h1>
          <ol class="breadcrumb">
            <li><i class="fa fa-dashboard"></i><a href="<?php echo site_url('dashboard') ?>"> Dashboard </a></li>
		<li><a href="<?php echo site_url('tpinjamanpetani') ?>"><?php echo $pageTitle ?></a></li>
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
		 <form action="<?php echo site_url('tpinjamanpetani/save/'.$row['id']); ?>" class='form-vertical' 
		 parsley-validate='true' novalidate='true' method="post" enctype="multipart/form-data" > 


<div class="col-md-6">
									
								  <div class="form-group hidethis " style="display:none;">
									<label for="ipt" class=" control-label "> Id    </label>									
									  <input type='text' class='form-control input-sm' placeholder='' value='<?php echo $row['id'];?>' name='id'   /> 						
								  </div> 					
								  <div class="form-group  " >
									<label for="ipt" class=" control-label "> ID Petani SAP  <span class="asterix"> * </span>  </label>									
									  <input type='text' class='form-control input-sm' placeholder='' value='<?php echo $row['id_petani_sap'];?>' name='id_petani_sap'  required /> 						
								  </div> 					
								  <div class="form-group  " >
									<label for="ipt" class=" control-label "> Keterangan    </label>									
									  <textarea name='keterangan' rows='2' id='keterangan' class='form-control input-sm '  
				           ><?php echo $row['keterangan'] ;?></textarea> 						
								  </div> 
			</div>
			
			<div class="col-md-6">
									
								  <div class="form-group  " >
									<label for="ipt" class=" control-label "> Tgl Pencairan  <span class="asterix"> * </span>  </label>									
									  <input type='text' class='form-control input-sm' placeholder='' value='<?php echo $row['tgl_pencairan'];?>' name='tgl_pencairan'  required /> 						
								  </div> 					
								  <div class="form-group  " >
									<label for="ipt" class=" control-label "> Saldo Kredit  <span class="asterix"> * </span>  </label>									
									  <input type='text' class='form-control input-sm' placeholder='' value='<?php echo $row['saldo_kredit'];?>' name='saldo_kredit'  required /> 						
								  </div> 
			</div>
			
			
		
			<div style="clear:both"></div>	
				
 		<div class="toolbar-line text-center">		
			
			<input type="submit" name="submit" class="btn btn-primary btn-sm" value="<?php echo $this->lang->line('core.sb_submit'); ?>" />
			<a href="<?php echo site_url('tpinjamanpetani');?>" class="btn btn-sm btn-warning"><?php echo $this->lang->line('core.sb_cancel'); ?> </a>
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