<section class="content">
	<div class="row">
		<div class="col-xs-12">
			<div class="box box-danger">
				<div class="box-header with-border">
					<h3 class="box-title">Laporan Hasil Analisa</h3>
					<div class="box-tools pull-right">
						
						
					</div>
				</div>
				<div class="box-body">
					<div class="page-content-wrapper m-t">
						
						<div class="sbox animated fadeIn">
							<div class="sbox-content" style="padding:10px" >
								<table witdh="100%">
									<tr>
										<td style="padding:5px" width="100px">
											Tanggal Giling
										</td>
										<td>
											<input type='text' class='form-control date input-sm' readonly placeholder='' value='<?php echo date('Y-m-d');?>' id='tgl1'  />
										</td>
										<td style="padding:5px" width="120px">
											Kategori Laporan
										</td>
										<td>
											<select id="kategori" class='form-control'>
												<option value="1">AFDELING</option>
												<option value="2">SPAT</option>
											</select>
										</td>
										<td>
											&nbsp;
										</td>
										<td valign="center">
											<input type="button" onclick="getReport()" class="btn btn-info btn-sm" value="View">
											<input type="button" class="btn btn-warning btn-sm" onclick="printContent('report')"  value="Cetak ">
											<input type="button" class="btn btn-danger btn-sm" onclick="getReportExcel()"  value="Excel ">
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
});
function getReport(){
	var kat = $('#kategori').val();
	if (kat == 1) {
		url = "<?php echo site_url('laporanari/printlaporan'); ?>";
	}else{
		url = "<?php echo site_url('laporanari/printlaporanspat'); ?>";
	}
	$.ajax({
		type 	: "POST",
		datatype: "json",
		url 	: url,
		data 	: {tglgiling:$('#tgl1').val()},
		success	: function(data){
			$('#report').html(data);
		}
		});
		}

function getReportExcel(){
	var tgl = $('#tgl1').val();
	var kat = $('#kategori').val();
	if (kat == 1) {
			var url = "<?php echo site_url('laporanari/printlaporan'); ?>?tglgiling="+tgl+"&excel=1";
	}else{
		var url = "<?php echo site_url('laporanari/printlaporanspat'); ?>?tglgiling="+tgl+"&excel=1";
	}
		window.open(url);
	}

$(document).on({
ajaxStart: function() { ajaxindicatorstart('loading data.. please wait..');    },
ajaxStop: function() {ajaxindicatorstop(); }
});
</script>