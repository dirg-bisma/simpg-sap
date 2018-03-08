 <section class="content">
          <div class="row">
            <div class="col-xs-12">
              <div class="box box-danger">
              	<div class="box-header with-border">


		<?php echo $this->session->flashdata('message');?>
			<ul class="parsley-error-list">
				<?php echo $this->session->flashdata('errors');?>
			</ul>
		 <form action="<?php echo site_url('tbiayaangkutan/save/'.$row['id']); ?>" class='form-horizontal' 
		 parsley-validate='true' novalidate='true' method="post" enctype="multipart/form-data" > 


<div class="col-md-12">
<table style="width:100%">
<tr>
	<td style="width:50px">Kode *</td>
	<td style="width:150px"><input type='text' class='form-control input-sm' placeholder='' value='<?php echo $row['kode_tx'];?>' name='kode_tx'  required /></td>
	<td style="width:20px">&nbsp;</td>
	<td style="width:70px">Tanggal *</td>
	<td style="width:150px"><input type='text' required class='form-control input-sm date' placeholder='' value='<?php echo $row['tgl'];?>' name='tgl'   /> </td>
	<td style="width:20px">&nbsp;</td>
	<td style="width:50px">Vendor *</td>
	<td ><select name='vendor_id' rows='5' id='vendor_id' code='{$vendor_id}' 
							class='form-control input-sm select2 ' style='width: 100%;' required  ></select> </td>
	
	
</tr>
</table>
<hr />
<table><tr>
<td >Periode Timbang</td>
<td style="width:20px">&nbsp;</td>
<td style="width:150px" colspan="3"><input type='text' class='form-control input-sm date' placeholder='' value='<?php echo $row['tgl_awal'];?>' name='tgl_awal' id='tgl_awal' required  /> </td>
<td style="width:10px">&nbsp;s/d&nbsp;</td>
<td style="width:150px"><input type='text' class='form-control input-sm date' placeholder='' value='<?php echo $row['tgl_akhir'];?>' name='tgl_akhir' id='tgl_akhir' required  /> </td>
<td style="width:10px">&nbsp;</td>
<td style="width:50px">&nbsp;<a href="javascript:getDetail()" class="btn btn-sm btn-danger" style="margin-top: -20px;"><i class="fa fa-search"></i> Cari</a></td>
</tr></table>
<hr /><b>Rincian SPTA</b>
<div class="table-responsive">
    <table class="table table-bordered display" id="gridv">
        <thead>
			<tr>
				<th> <input type="checkbox"  id="select-all" name="ss"/> </th>
				<th> Timbang </th>
				<th> SPTA </th>
				<th> Kode Blok </th>
				<th> Kebun </th>
				<th> No Ken. </th>
				<th> Netto (Kg) </th>
				<th> Jarak </th>
				<th> Tarif </th>
				<th> Jumlah </th>
			  </tr>
        </thead>
		<tbody id="bodytable">
		</tbody>
		<tfoot>
			<tr>
				<th colspan="9" style="text-align:center"> J U M L A H </th>
				<th width="200px"> <input type='text' class='form-control input-sm number' placeholder='' value='<?php echo $row['total'];?>' name='total' id='total'  required readonly  /> </th>
			  </tr>
        </tfoot>

        

    </table>
	</div>
		
								  
			</div>
			
			
		
			<div style="clear:both"></div>	
			<hr />
 		<div class="toolbar-line text-center">		
			
			<input type="submit" name="submit" class="btn btn-primary btn-sm" value="<?php echo $this->lang->line('core.sb_submit'); ?>" />
			<a href="<?php echo site_url('tbiayaangkutan');?>" class="btn btn-sm btn-warning"><?php echo $this->lang->line('core.sb_cancel'); ?> </a>
 		</div>
			  		
		</form>

	</div>
	</div>
</div>		
</div>	
      </section>
			 
<script type="text/javascript">
$(document).ready(function() { 

		$("#vendor_id").jCombo("<?php echo site_url('tbiayaangkutan/comboselect?filter=m_vendor:id_vendor:nama_vendor') ?>",
		{  selected_value : '<?php echo $row["vendor_id"] ?>' });
		$('#select-all').on('ifChecked', function(){
			$('input:checkbox').not(this).prop('checked', true);
			pilihSPTA();
		});
		$('#select-all').on('ifUnchecked', function(){
			$('input:checkbox').not(this).prop('checked', false);
			pilihSPTA();
		});
		
		//$('input.number').number( true, 0 );
});

function getDetail(){
	var vendor = $('#vendor_id').val();
	var tglawal = $('#tgl_awal').val();
	var tglakhir = $('#tgl_akhir').val();
	
	$.ajax({
		 type: 'POST', 
        url: '<?php echo site_url('tbiayaangkutan/getDetail');?>', 
        data: { vendor: vendor,tglawal:tglawal,tglakhir:tglakhir }, 
        success: function (data) { 
           $('#bodytable').html(data);
        }
	});
}

function pilihSPTA(){
	var total = 0;
	$('.dataselect').each(function(i, obj) {
		if($(this).prop("checked")){
			var x = $(this).val();
			var y = x.split('||');
			total += parseInt(y[3]);
		}
	});
	$('#total').val(total);
}

</script>		 