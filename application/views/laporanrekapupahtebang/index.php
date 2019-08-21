<section class="content">
          <div class="row">
            <div class="col-xs-12">
              <div class="box box-danger">
              	<div class="box-header with-border">
                  <h3 class="box-title">Laporan Rekap Upah Tebang</h3>
                  <div class="box-tools pull-right">
 	
		

                  </div>
                </div>

	 <div class="box-body">

	<div class="page-content-wrapper m-t">
    
<div class="sbox animated fadeIn">
			<div class="sbox-content" style="padding:10px" > 		
				<table witdh="100%">
					<tr>

					<td valign="center" class="period1"> Filter By tgl </td>
						<td style="padding:5px" width="200px" class="period1">
							<select id='jnstgl' rows='5' 
							class=' form-control'  required >
							<option value='1'>Timbang</option>
							<option value='2'>Giling</option>
						</select> </td>

						<td style="padding:5px;display:none" width="150px;">
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
						<td style="padding:5px" class="period">  <input type='text' class='form-control date input-sm' readonly placeholder='' value='<?php echo date('Y-m-d');?>' id='tgl2'  /> </td>


						<td valign="center"> Kategori </td>
						<td style="padding:5px" width="200px">
							<select id='kat' rows='5' 
							class=' form-control'  required >
							<option value=''>- SEMUA -</option>
							<option value='TS'>TS</option>
							<option value='TSN'>TS non TS-SP</option>
							<option value='TR'>TR</option>
							<option value='TRN'>TR & TS-SP</option>
						</select> </td>

						<td style="padding:5px" width="200px">
							<select id='angkutan' rows='5' 
							class=' form-control'  required >
							<option value=''>- SEMUA -</option>
							<option value='TRUK'>TRUK</option>
							<option value='LORI'>LORI</option>
							<option value='ODONG2'>ODONG2</option>
							<option value='TRAKTOR'>TRAKTOR</option>
						</select> </td>

						<td valign="center"> Jenis </td>
						<td style="padding:5px" width="200px">
							<select id='jns' rows='5' 
							class=' form-control' onchange="gantijns(this.value)"  required >
							<option value='1'>Per Mandor</option>
							<option value='2'>Per Transaksi</option>
							<option value='3'>Per Mandor Rekap</option>
							<option value='4'>Per Petak</option>
						</select> </td>

						

						</tr>
						<tr>
						<td valign="center" class="period1"> Petak </td>
						<td style="padding:5px" width="200px" colspan="3" class="period1"> 
						<input type='text' class='form-control input-sm' placeholder='' id='kode_blok'  /> 
						</td>

						<td valign="center" colspan="2"><input type="button" onclick="getReport()" class="btn btn-info btn-sm" value="View " />
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
		//getReport();
		$('.bulan').hide();$('.tahun').hide();
		gantijns(1);
		autocompleted();
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
	 	url 	: "<?php echo site_url('laporanrekapupahtebang/printlaporan'); ?>",
	 	data 	: {tgl1:$('#tgl1').val(),tgl2:$('#tgl2').val(),angkutan:$('#angkutan').val(),
	 	sup:$('#sup').val(),bln:$('#bln').val(),thn:$('#thn').val(),rjns:$('#rjns').val()
	 	,kat:$('#kat').val(),jns:$('#jns').val(),petak:$('#kode_blok').val(),jnstgl:$('#jnstgl').val()
	 	},
	 	success	: function(data){
	 		$('#report').html(data);
	 	}
	 });
}

function gantijns(a){
	if(a == 4){
		$('.period1').show();
	}else{
		$('.period1').hide();
	}
}

function getReportExcel(){
var myData = {tgl1:$('#tgl1').val(),tgl2:$('#tgl2').val(),angkutan:$('#angkutan').val(),
	 	sup:$('#sup').val(),bln:$('#bln').val(),thn:$('#thn').val(),rjns:$('#rjns').val()
	 	,kat:$('#kat').val(),jns:$('#jns').val(),jnstgl:$('#jnstgl').val()};
var out = [];

for (var key in myData) {
    out.push(key + '=' + encodeURIComponent(myData[key]));
}

var urlx = out.join('&');

	var url = "<?php echo site_url('laporanrekapupahtebang/printlaporan'); ?>?"+urlx+"&excel=1";
	window.open(url);

}

$(document).on({
    ajaxStart: function() { ajaxindicatorstart('loading data.. please wait..');    },
     ajaxStop: function() {ajaxindicatorstop(); }    
});


</script>