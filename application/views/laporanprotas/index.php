<section class="content">
          <div class="row">
            <div class="col-xs-12">
              <div class="box box-danger">
              	<div class="box-header with-border">
                  <h3 class="box-title">Laporan Protas Per Petak</h3>
                  <div class="box-tools pull-right">
 	
		

                  </div>
                </div>

	 <div class="box-body">

	<div class="page-content-wrapper m-t">
    
<div class="sbox animated fadeIn">
			<div class="sbox-content" style="padding:10px" > 		
				<table witdh="100%">
					<tr>
						
						<tr>

						<td valign="center"> Afdeling </td>
						<td style="padding:5px" width="200px">
							<select id='divisi' rows='5' 
							class=' form-control'  >
						</select> </td>

						<td valign="center"> Petak </td>
						<td style="padding:5px" width="200px" colspan="3"> 
						<input type='text' class='form-control input-sm' placeholder='' id='kode_blok'  /> 
						</td>
						
					</tr>
						<tr>
						<td valign="center" colspan="2">
						<input type="button" onclick="getReport()" class="btn btn-info btn-sm" value="View " />
						<input type="button" class="btn btn-warning btn-sm" onclick="printContent('report')"  value="Cetak " />
						<input type="button" onclick="getReportExcel()" class="btn btn-danger btn-sm" value="Excel " />
			 			</td>
						
						</tr>
						
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
		$("#divisi").jCombo("<?php echo site_url('mmasterfield/comboselect?filter=sap_m_affdeling:kode_affd:kode_affd') ?>");
		autocompleted();
});


function getReport(){
	$.ajax({
	 	type 	: "POST",
	 	datatype: "json",
	 	url 	: "<?php echo site_url('laporanprotas/printlaporan'); ?>",
	 	data 	: {divisi:$('#divisi').val(),kode_blok:$('#kode_blok').val()},
	 	success	: function(data){
	 		$('#report').html(data);
	 	}
	 });
}

function getReportExcel(){
var myData = {divisi:$('#divisi').val(),kode_blok:$('#kode_blok').val()};
var out = [];

for (var key in myData) {
    out.push(key + '=' + encodeURIComponent(myData[key]));
}

var urlx = out.join('&');

	var url = "<?php echo site_url('laporanprotas/printlaporan'); ?>?"+urlx+"&excel=1";
	window.open(url);

}
$(document).on({
    ajaxStart: function() { ajaxindicatorstart('loading data.. please wait..');    },
     ajaxStop: function() {ajaxindicatorstop(); }    
});


function autocompleted(){
    
	var myData = $("#kode_blok").tautocomplete({
		width: "500px",
		id:"kode_blok",
		columns: ['Afd', 'Kode','Kategori', 'Deskripsi'],
		hide: [true,true,true,true],
		placeholder: "Cari Petak",
		theme: "white",
		norecord: "No Records Found",
		ajax: {
                        url: "<?php echo site_url('tupahtebang/petakget')?>",
                        type: "GET",
                        success: function (data) {
                        	$('#kode_blok').val('');
                            return data;
                        }
                    },
        onchange: function () {
        			var all = myData.all();
        			$('#kode_blok').val(all.Kode);
                }
	});
}

</script>