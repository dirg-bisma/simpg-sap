<section class="content-header">
          <h1>
            <?php echo $pageTitle ;?>
          </h1>
          <ol class="breadcrumb">
            <li><i class="fa fa-dashboard"></i><a href="<?php echo site_url('dashboard') ?>"> Dashboard </a></li>
		<li><a href="<?php echo site_url('keragaanpabrik') ?>"><?php echo $pageTitle ?></a></li>
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
		 <form action="<?php echo site_url('keragaanpabrik/save/'.@$row->id); ?>" class='form-horizontal' 
		 parsley-validate='true' novalidate='true' method="post" enctype="multipart/form-data" > 


<div class="col-md-4">
									
								  <div class="form-group  " >
									<label for="Hari Giling" class=" control-label col-md-4 text-left"> Hari Giling </label>
									<div class="col-md-8">
									  <input type='number' class='form-control input-sm' autocomplete="off"   value='<?php echo @$row->hari_giling=="" ? $_GET['hari'] : $row->hari_giling;?>' style='width:150px !important;' name='hari_giling' id='hari_giling'  onkeyup="gettglGiling(this.value,event);return false;"  /> <br />
									  <innput type="hidden" name='id' value="<?php echo @$row->id;?>" id="id">
									  <i> <small></small></i>
									 </div> 
								  </div> 	
								  <div class="form-group  " >
									<label for="Tgl Giling" class=" control-label col-md-4 text-left"> Tgl Giling </label>
									<div class="col-md-8">
									  <input type='text' class='form-control input-sm '  value='<?php echo @$row->tgl_giling;?>'id='tgl_giling' name='tgl_giling' style='width:150px !important;'	readonly   /> <br />
									  <i> <small></small></i>
									 </div> 
								  </div> 				
								  <div class="form-group  " >
									<label for="Jam" class=" control-label col-md-4 text-left"> Jam </label>
									<div class="col-md-8">
									  <select name='jam' rows='5' id='jam' code='{$jam}' class='form-control input-sm' style='width: 100%;' onchange="getdatajam(this.value)" > 
									  <option>-pilih-</option>
									  <?php foreach($lap_jam as $row_jam){?>
									  	<option value="<?php echo $row_jam->jam;?>"<?php echo @$row->jam == $row_jam->jam ? "selected":"";?>><?php echo $row_jam->jam;?></option>
									  <?php }?>
									  </select>
									  <br />
									  <i> <small></small></i>
									 </div> 
								  </div>			
								  <div class="form-group  " >
									<label for="Digiling" class=" control-label col-md-4 text-left"> Digiling </label>
									<div class="col-md-8">
									  <input type='number' class='form-control input-sm'   value='<?php echo @$row->digiling;?>' id='digiling' name='digiling' readonly/> <br />
									  <i> <small></small></i>
									 </div> 
								  </div> 					
								  <div class="form-group  " >
									<label for="Brix Npp" class=" control-label col-md-4 text-left"> Brix Npp </label>
									<div class="col-md-8">
									  <input type='number' class='form-control input-sm'   value='<?php echo @$row->brix_npp;?>' name='brix_npp' id='brix_npp'   readonly/> <br />
									  <i> <small></small></i>
									 </div> 
								  </div> 					
								  					
								  			
								   
			</div>
			<div class="col-md-4">
								<div class="form-group  " >
									<label for="Nm Persen Tebu" class=" control-label col-md-4 text-left"> Nm Persen Tebu </label>
									<div class="col-md-8">
									  <input type='number' class='form-control input-sm'   value='<?php echo @$row->nm_persen_tebu;?>' name='nm_persen_tebu' id='nm_persen_tebu' /> <br />
									  <i> <small></small></i>
									 </div> 
								  </div> 
								<div class="form-group  " >
									<label for="Uap Baru" class=" control-label col-md-4 text-left"> Uap Baru </label>
									<div class="col-md-8">
									  <input type='number' class='form-control input-sm'   value='<?php echo @$row->uap_baru;?>' name='uap_baru'   /> <br />
									  <i> <small></small></i>
									 </div> 
								  </div> 		
								<div class="form-group  " >
									<label for="Uap Bekas" class=" control-label col-md-4 text-left"> Uap Bekas </label>
									<div class="col-md-8">
									  <input type='number' class='form-control input-sm'   value='<?php echo @$row->uap_bekas;?>' name='uap_bekas'   /> <br />
									  <i> <small></small></i>
									 </div> 
								  </div> 					
								  <div class="form-group  " >
									<label for="Suhu PP I" class=" control-label col-md-4 text-left"> Suhu PP I </label>
									<div class="col-md-8">
									  <input type='number' class='form-control input-sm'   value='<?php echo @$row->suhu_pp_i;?>' name='suhu_pp_i'   /> <br />
									  <i> <small></small></i>
									 </div> 
								  </div> 					
								  <div class="form-group  " >
									<label for="Suhu PP II" class=" control-label col-md-4 text-left"> Suhu PP II </label>
									<div class="col-md-8">
									  <input type='number' class='form-control input-sm'   value='<?php echo @$row->suhu_pp_ii;?>' name='suhu_pp_ii'   /> <br />
									  <i> <small></small></i>
									 </div> 
								  </div> 					
								  					
								  
			</div>

			<div class="col-md-4">
								<div class="form-group  " >
									<label for="Suhu PP III" class=" control-label col-md-4 text-left"> Suhu PP III </label>
									<div class="col-md-8">
									  <input type='number' class='form-control input-sm'   value='<?php echo @$row->suhu_pp_iii;?>' name='suhu_pp_iii'   /> <br />
									  <i> <small></small></i>
									 </div> 
								  </div> 
								<div class="form-group  " >
									<label for="TURBIDITY NM" class=" control-label col-md-4 text-left"> TURBIDITY NM </label>
									<div class="col-md-8">
									  <input type='number' class='form-control input-sm'   value='<?php echo @$row->turbidity;?>' name='turbidity'   /> <br />
									  <i> <small></small></i>
									 </div> 
								  </div> 					
								  <div class="form-group  " >
									<label for="VACUUM EVA" class=" control-label col-md-4 text-left"> VACUUM EVA </label>
									<div class="col-md-8">
									  <input type='number' class='form-control input-sm'   value='<?php echo @$row->v_eva;?>' name='v_eva'   /> <br />
									  <i> <small></small></i>
									 </div> 
								  </div> 					
								  <div class="form-group  " >
									<label for="VACUUM MASAKAN" class=" control-label col-md-4 text-left"> VACUUM MASAKAN </label>
									<div class="col-md-8">
									  <input type='number' class='form-control input-sm'   value='<?php echo @$row->v_masakan;?>' name='v_masakan'   /> <br />
									  <i> <small></small></i>
									 </div> 
								  </div> 					
								  <div class="form-group  " >
									<label for="Be NK" class=" control-label col-md-4 text-left"> Be NK </label>
									<div class="col-md-8">
									  <input type='number' class='form-control input-sm'   value='<?php echo @$row->be_nk;?>' name='be_nk'   /> <br />
									  <i> <small></small></i>
									 </div> 
								  </div>
			</div>
			
			
		
			<div style="clear:both"></div>	
				
 		<div class="toolbar-line text-center">		
			
			<input type="submit" name="submit" class="btn btn-primary btn-sm" value="<?php echo $this->lang->line('core.sb_submit'); ?>" />
			<a href="<?php echo site_url('keragaanpabrik');?>" class="btn btn-sm btn-warning"><?php echo $this->lang->line('core.sb_cancel'); ?> </a>
 		</div>
			  		
		</form>

	</div>
	</div>
</div>		
</div>	
<!------------------------------------------------------------------>
<div class="row">
            <div class="col-xs-12">
              <div class="box box-danger">
              	<div class="box-header with-border">
                  <div class="box-tools pull-right">
 	
		<a href="<?php echo site_url('keragaanpabrik/add/?hari='.$_GET['hari']) ?>" class="tips btn btn-xs btn-info"  title="<?php echo $this->lang->line('core.btn_new'); ?>" onclick="filterCetak()">
		<i class="fa fa-plus"></i>&nbsp;<?php echo $this->lang->line('core.btn_new'); ?> (F2) </a>
		</div>
                </div>

	 <div class="box-body">

	<div class="page-content-wrapper m-t">
    
<div class="sbox animated fadeIn">
	<div class="sbox-content">	

	 <div class="table-responsive">
    <table class="table table-bordered display" id="gridv">
        <thead>
			<tr>
				<th> No </th>

				<?php foreach ($tableGrid as $k => $t) : ?>
					<?php if($t['view'] =='1'): ?>
						<?php if($t['label']!= 'Jumlah') {?>
						<th><?php echo $t['label'] ?></th>
						<?php }?>
					<?php endif; ?>
				<?php endforeach; ?>
				<th><?php echo $this->lang->line('core.btn_action'); ?></th>
			  </tr>
        </thead>
		<?php foreach($data_keragaan as $row_keragaan){?>			
			<tr>
				<?php foreach($tableGrid as $k => $t){?>				
				<td><?php echo $row_keragaan->$t['field']?></td>
				<?php }?>
				<td><a href='<?php echo site_url('keragaanpabrik/add/?hari='.$row_keragaan->hari_giling.'&id='.$row_keragaan->id);?>'  class="tips "  title="Edit"><i class="fa  fa-edit"></i>  </a> &nbsp;&nbsp;</td>
			</tr>
		
		<?php }?>
        

    </table>
	</div>
	
	</div>
</div>


	</div>
</div>
</div>
          </div>
          </div>
      </section>
			 
<script type="text/javascript">
$(document).ready(function() { 
	$(window).keydown(function(event){
    if(event.keyCode == 13) {
      event.preventDefault();
      return false;
    }
  });	
  
  loadTglGiling(); 	 
});

function loadTglGiling()
{
	hg = $('#hari_giling').val();
	$.ajax({
	type: 'POST',
		url: '<?php echo site_url('keragaanpabrik/getharitglgiling');?>/'+hg, 
		dataType : 'json',
		success: function (data) {
				$('#tgl_giling').val(data.tgl);
			}
	});
}

function gettglGiling(hg,e){
	var plan = "<?php echo CNF_PLANCODE;?>";
	if(e.keyCode == 13) {
	$.ajax({
	type: 'POST',
		url: '<?php echo site_url('keragaanpabrik/getharitglgiling');?>/'+hg, 
		dataType : 'json',
		success: function (data) {
				$('#tgl_giling').val(data.tgl);
			}
		});
	}
}

function getdatajam(jam)
{
	var plan = "<?php echo CNF_PLANCODE;?>";
	hg = $('#tgl_giling').val();
	
	$.ajax({
	type: 'POST',
		url: '<?php echo site_url('keragaanpabrik/gettergiling');?>/'+hg+'/'+jam, 
		dataType : 'json',
		success: function (data) {
				$('#digiling').val(data.ttl);
				$('#brix_npp').val(data.npp_brix);
			}
		});
	
}


</script>		 