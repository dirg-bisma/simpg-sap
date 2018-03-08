<section class="content">
          <div class="row">
            <div class="col-xs-12">
              <div class="box box-danger">
              	<div class="box-header with-border">
                  <h3 class="box-title">Laporan Harian Timbangan</h3>
                  <div class="box-tools pull-right">
 	
		

                  </div>
                </div>

	 <div class="box-body">

	<div class="page-content-wrapper m-t">
    
<div class="sbox animated fadeIn">
			<div class="sbox-content" style="padding:10px" > 		
				<table witdh="100%">
					<tr>
						<td style="padding:5px" width="150px">
							<select id="rjns" class=" form-control">
								<option value="1">PERIODE</option>
								<option value="2">BULANAN</option>
								<option value="3">TAHUNAN</option>
							</select>
						</td>
						<td class="bulan" style="padding:5px" width="150px">
							<select id="bln" class=" form-control">
								<option value="1">Jan</option>
								<option value="2">Feb</option>
								<option value="3">Mar</option>
								<option value="4">Apr</option>
								<option value="5">Mei</option>
								<option value="6">Jun</option>
								<option value="7">Jul</option>
								<option value="8">Ags</option>
								<option value="9">Sep</option>
								<option value="10">Okt</option>
								<option value="11">Nov</option>
								<option value="12">Des</option>
							</select>
						</td>
						<td class="tahun" style="padding:5px" width="150px">
							<select id="thn" class=" form-control">
								<option value="2015">2015</option>
								<option value="2016">2016</option>
								<option value="2017">2017</option>
								<option value="2018">2018</option>
								<option value="2019">2019</option>
							</select>
						</td>
						<td class="period">
							<input type='text' class='form-control date input-sm' readonly placeholder='' value='<?php echo date('Y-m-d');?>' id='tgl1'  /> </td><td class="period"> s/d </td>
						<td style="padding:5px" class="period"><input type='text' class='form-control date input-sm' readonly placeholder='' value='<?php echo date('Y-m-d');?>' id='tgl2'  /> </td>

						

						<td valign="center"> Jenis Laporan </td><td> : </td>
						<td style="padding:5px" width="200px">
							<select id='jns' rows='5' 
							class=' form-control'  required >
							<option value='1'>Per Petak</option>
							<option value='2'>Per SPTA</option>
						</select> </td>
						
						<td valign="center"><input type="button" onclick="getReport()" class="btn btn-info btn-sm" value="View " />
							<input type="button" class="btn btn-warning btn-sm" onclick="printContent('report')"  value="Cetak " />
			 </td>
					</tr>	
				</table>		 
			</div>
			<hr />
			<div class="sbox-content" style="height:650px;padding:10px;overflow:auto" id="report" > 
			</div>
		</div>		
	

	</div>
</div>
</div>
          </div>
          </div>
        </section>

<script type="text/javascript">
$(document).ready(function(){
		//getReport();

		$('.bulan').hide();$('.tahun').hide();
	//	$("#bln").select2("val", "<?=date('n');?>"); 
	//	$("#thn").select2("val", "<?=date('Y');?>"); 
});

$('#rjns').on('change',function(e){
	if($('#rjns').val()==1){
		$('.bulan').hide();$('.tahun').hide();$('.period').show();
	}else if($('#rjns').val()==2){
		$('.bulan').show();$('.tahun').show();$('.period').hide();
		$("#bln").select2("val", "<?=date('n');?>"); 
		$("#thn").select2("val", "<?=date('Y');?>"); 
	}else if($('#rjns').val()==3){
		$('.bulan').hide();$('.tahun').show();$('.period').hide();
	}
});

function getReport(){
	$.ajax({
	 	type 	: "POST",
	 	datatype: "json",
	 	url 	: "<?php echo site_url('laporantimbangan/printlaporan'); ?>",
	 	data 	: {tgl1:$('#tgl1').val(),tgl2:$('#tgl2').val(),
	 	sup:$('#sup').val(),jns:$('#jns').val()
	 	,bln:$('#bln').val(),thn:$('#thn').val(),rjns:$('#rjns').val()},
	 	success	: function(data){
	 		$('#report').html(data);
	 	}
	 });
}
$(document).on({
    ajaxStart: function() { ajaxindicatorstart('loading data.. please wait..');    },
     ajaxStop: function() {ajaxindicatorstop(); }    
});

</script>