  <link rel="stylesheet" href="<?php echo base_url();?>/adminlte/plugins/toast/toast.css">
<script src="<?php echo base_url();?>/adminlte/plugins/toast/toast.js"></script>

  <?php usort($tableGrid, "SiteHelpers::_sort"); ?>
   <section class="content-header">
          <h1>
            <?php echo $pageTitle ;?>
          </h1>
          <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
            <li><?php echo $pageNote ;?></li>
          </ol>
        </section>


<section class="content">
          <div class="row">
            <div class="col-xs-12">
              <div class="box box-danger">
              	<div class="box-header with-border">
                  <h3 class="box-title">&nbsp;</h3>
                  <center>
                  <div class="col-md-12">
 	  Tanggal : &nbsp;&nbsp;&nbsp;
    <input type="text" class="date" style="text-align: center" id="tgl1" readonly value="<?php echo date('Y-m-d');?>">&nbsp;s/d&nbsp;
    <input type="text" class="date" style="text-align: center" id="tgl2" readonly value="<?php echo date('Y-m-d');?>">&nbsp;&nbsp;
  PTA : &nbsp;&nbsp;&nbsp;
    <select id="pta" class="select21" style="height: 24px"></select>&nbsp;&nbsp;
    Mandor : &nbsp;&nbsp;&nbsp;
    <select id="mandor" class="select21" style="height: 24px"></select>&nbsp;&nbsp;
    </div>
    </center>
    <center>
    <div style="col-md-12">
    <hr />
    <a href="javascript:reloadGrid()" class="tips btn btn-xs btn-warning"  title="View">
    <i class="fa fa-search"></i>&nbsp;View </a>


    <a href="javascript:printreport(1)" class="tips btn btn-xs btn-danger"  title="Print">
    <i class="fa fa-print"></i>&nbsp;Print Bukti </a>


    <a href="javascript:downloadexcel()" class="tips btn btn-xs btn-info"  title="Download">
    <i class="fa fa-download"></i>&nbsp;Download Excel </a>

    <a href="<?php echo site_url('laporanrekapupahtebang');?>" target="_blank" class="tips btn btn-xs btn-success"  title="Rekap">
    <i class="fa fa-file"></i>&nbsp;Rekapitulasi </a>

    <!--a href="javascript:printreport(2)" class="tips btn btn-xs btn-success"  title="View">
    <i class="fa fa-file"></i>&nbsp;Print Rekapitulasi </a-->
		<?php if($this->access['is_add'] ==1) : ?>
		<a href="<?php echo site_url('tupahtebang/add') ?>" class="tips btn btn-xs btn-info"  title="<?php echo $this->lang->line('core.btn_new'); ?>">
		<i class="fa fa-plus"></i>&nbsp;<?php echo $this->lang->line('core.btn_new'); ?> (F2) </a>
		<?php endif;?>
                  </div>
                  </center>
                </div>

	 <div class="box-body">

	<div class="page-content-wrapper m-t">
    
<div class="sbox animated fadeIn">
	<div class="sbox-content">	

	<?php echo $this->session->flashdata('message');?>
	 <div class="table-responsive">
    <table class="table table-bordered display" id="gridv">
        <thead>
			<tr>
				<th> No </th>

				<?php foreach ($tableGrid as $k => $t) : ?>
					<?php if($t['view'] =='1'): ?>
						<th><?php echo $t['label'] ?></th>
					<?php endif; ?>
				<?php endforeach; ?>
				<th><?php echo $this->lang->line('core.btn_action'); ?></th>
			  </tr>
        </thead>

        

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

<script>
var table;
$(document).ready(function(){
  $("#pta").jCombo("<?php echo site_url('tupahtebang/comboselect?filter=sap_m_karyawan:Persno:name:id_jabatan:2') ?>",
    {  initial_text : '- Semua PTA -' });
    
    $("#mandor").jCombo("<?php echo site_url('tupahtebang/comboselect?filter=sap_m_karyawan:Persno:name:id_jabatan:3') ?>",
    {  initial_text : '- Semua Mandor -' });


  setTimeout(function(){$('.select21').select2({ width: '200px' });},1000);
});
 $(function () {
       // $("#gridv").DataTable();
        table = $('#gridv').DataTable({
          "paging": true,
          "lengthChange": true,
          "searching": true,
          "ordering": true,
          "info": true,
          "autoWidth": false,
          "processing": true, //Feature control the processing indicator.
          "serverSide": true, //Feature control DataTables' server-side processing mode.
 
        // Load data for the table's content from an Ajax source
        "ajax": {
            "url": "<?php echo site_url('tupahtebang/grids');?>/"+$('#tgl1').val()+"?tgl2="+$('#tgl2').val()+"&pta="+$('#pta').val()+"&mandor="+$('#mandor').val(),
            "type": "POST"
        },
 
        //Set column definition initialisation properties.
        "columnDefs": [
        {
          "targets": [ -1 ], //last column
          "orderable": false, //set not orderable
        },
        ],
        });
      });

 function reloadGrid(){
    table.ajax.url( "<?php echo site_url('tupahtebang/grids');?>/"+$('#tgl1').val()+"?tgl2="+$('#tgl2').val()+"&pta="+$('#pta').val()+"&mandor="+$('#mandor').val() ).load();
 }

 function printreport(a){
   if(a == 1){
      window.open("<?php echo site_url('tupahtebang/printbukti');?>/"+$('#tgl1').val()+"?tgl2="+$('#tgl2').val()+"&pta="+$('#pta').val()+"&mandor="+$('#mandor').val(),"_blank");
   }
 }

 function downloadexcel(){
   
      window.open("<?php echo site_url('tupahtebang/downloadexcel');?>/"+$('#tgl1').val()+"?tgl2="+$('#tgl2').val()+"&pta="+$('#pta').val()+"&mandor="+$('#mandor').val(),"_blank");
   
 }


 function validasiupahtebang(isx){
  if(confirm("Apakah anda yakin validasi data ini ?")){
    $.ajax({
       type: 'POST', 
          url: '<?php echo site_url('tupahtebang/validasiajax');?>/'+isx, 
          data: { id: isx }, 
          success: function (data) { 
              $.toast({
                heading: 'Pemberitahuan',
                textAlign: 'center',
                text:data  ,
                icon: 'info',
                loader: true,        // Change it to false to disable loader
                loaderBg: '#9EC600',
                hideAfter: 2000,
                showHideTransition: 'slide',
                position: 'top-right',  // To change the background
            });
          table.ajax.reload();
          }

    });
  }
}
</script>
