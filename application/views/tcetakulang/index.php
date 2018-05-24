  <?php usort($tableGrid, "SiteHelpers::_sort"); ?>
   <section class="content-header">
          <h1>
            Cetak Ulang dan Retur SPTA
          </h1>
          <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
            <li>Cetak Ulang dan Retur SPTA</li>
          </ol>
        </section>


<section class="content">
          <div class="row">
            <div class="col-xs-12">
              <div class="box box-danger">
              	<div class="box-header with-border">
                  <table>
				  <tr>
				  <td style="width:100px"> Tanggal SPTA </td><td> 
				  <input type="text" id="tgl_spta" class="form-control date" readonly value="<?php echo date('Y-m-d');?>" /></td>
				  <td style="width:50px">&nbsp;</td>
				  <td style="width:70px"> Afdeling </td>
				  <td style="width:250px"><select id="afdeling" class="form-control"></select></td>
				  <td style="width:10px">&nbsp;</td>
				  <td><a href="javascript:cari()" class="btn btn-sm btn-info"> <i class="fa fa-search"></i> Cari </a></td>
          <td style="width:10px">&nbsp;</td>
          <td><a href="javascript:ReturModal()" class="btn btn-sm btn-danger"> <i class="fa fa-check"></i> Retur </a></td>
          <td style="width:10px">&nbsp;</td>
          <td><a href="javascript:cetaklist(1)" class="btn btn-sm btn-warning"> <i class="fa fa-print"></i> Cetak List SPTA </a></td>

          <td style="width:10px">&nbsp;</td>
          <td><a href="javascript:cetaklist(2)" class="btn btn-sm btn-success"> <i class="fa fa-download"></i> Excel List SPTA </a></td>
				  </tr>
				  </table>
                  
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
				<th> x </th>

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
$(document).ready(function() { 
		$(".sidebar-toggle").trigger("click");
		$("#afdeling").jCombo("<?php echo site_url('tcetakulang/comboselect?filter=vw_master_afdeling:kode_affd:kode_affd|karyawan') ?>",
		{  selected_value : '' });
		
		generateTable($('#tgl_spta').val(),$('#afdeling').val());
});
var table;

function cari(){
	table.destroy();
	generateTable($('#tgl_spta').val(),$('#afdeling').val());
}

function generateTable(tgl,afd=''){
		if(afd == null ) afd = 0;
        table = $('#gridv').DataTable({
          "lengthMenu": [ [25, 50, 100, 500], [25, 50, 100, 500] ],
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
            "url": "<?php echo site_url('tcetakulang/grids')?>/"+tgl+"/"+afd,
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
}

function ReturModal(){
    var res = [];
    $('.cekretur').each(function(i,obj){
        if($(this).prop('checked')){
          res.push($(this).val());
        }
    });

    SximoModal('<?php echo site_url('tcetakulang/retur');?>?tgl='+$('#tgl_spta').val()+'&id='+res,'Retur SPTA');
}

function cetaklist(ax){
  var a = $('#tgl_spta').val();
  var b = $('#afdeling').val();
  url = "<?php echo site_url('tcetakulang/printlist');?>?jenis="+ax+"&tgl="+a+"&afd="+b;
  window.open(url);
}



</script>
