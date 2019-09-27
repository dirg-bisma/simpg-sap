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
                  <h3 class="box-title">Filter Data</h3>
                  <div class="box-body">

  <div class="page-content-wrapper m-t">
    
<div class="sbox animated fadeIn">
  <div class="sbox-content">
  <div class="col-md-3"> 
    <div class="form-group  " >
                  <label for="ipt" class=" control-label "> Jenis Do    </label>                  
                    <select class="form-control" id="jenis_do">
                      <option value="x">SEMUA</option>
                      <option value="0">SBH</option>
                      <option value="1">SPT</option>
                    </select>            
                  </div>
                  </div>        
                  <div class="col-md-3">  
                  <div class="form-group  " >
                  <label for="ipt" class=" control-label "> Periode    </label>                  
                    <select class="form-control" id="periode">
                      <option value="x">SEMUA</option>
                      <?php
                      $s = $this->db->query("SELECT * FROM t_periode_do order by id")->result();
                      foreach($s as $d){
                        ?>
                        <option value="<?php echo $d->id;?>"><?php echo $d->nama_periode;?></option>
                        <?
                      }
                      ?>
                      
                    </select>             
                  </div>     
                  </div> 
                  <div class="col-md-3">     
                  <div class="form-group  " >
                  <label for="ipt" class=" control-label "> Kode Blok    </label>                 
                    <input type='text' class='form-control input-sm' placeholder='' id='kode_blok'   />             
                  </div>
                </div>
                <div class="col-md-3"> 
                  <div class="form-group  " >
                  <label for="ipt" class=" control-label "> ID Petani SAP    </label>                 
                    <input type='text' class='form-control input-sm' placeholder=''  id='id_petani_sap'   />             
                  </div> 
                  </div> 

                  <div class="col-md-12 text-center">    
      <a href="javascript:exporttoexcel()" class="btn btn-sm btn-danger"><i class="fa fa-download"></i> Export Excel </a>
      <a href="javascript:reloaddata()" class="btn btn-sm btn-warning"><i class="fa fa-desktop"></i> Tampilkan Data </a>
      <!--a href="javascript:cetakdo(1)" class="btn btn-sm btn-info"><i class="fa fa-print"></i> Print DO 90% </a-->
      <a href="javascript:cetakdo(2)" class="btn btn-sm btn-primary"><i class="fa fa-print"></i> Print Natura </a>
      <a href="javascript:cetakdo(3)" class="btn btn-sm btn-warning"><i class="fa fa-print"></i> Print Bukti </a>
      <a href="javascript:cetakdo(4)" class="btn btn-sm btn-info"><i class="fa fa-print"></i> Print Lampiran </a>
    </div>
                </div>
  
</div>
</div>
                </div>
              </div>
            </div>
          </div>
        </div>

        <div class="row">
            <div class="col-xs-12">

              <div class="box box-danger">
              	<div class="box-header with-border">
                  <h3 class="box-title">List Data</h3>
                  <div class="box-tools pull-right">
 	
		<?php if($this->access['is_add'] ==1) : ?>
		<a href="<?php echo site_url('tdo/add') ?>" class="tips btn btn-xs btn-info"  title="Proses Detail DO">
		<i class="fa fa-cogs"></i>&nbsp;Proses Detail DO </a>
		<?php endif;?>
                  </div>
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
            "url": "<?php echo site_url('tdo/grids')?>/x/x?idpetani=kosong",
            "type": "POST"
        },
 
        //Set column definition initialisation properties.
        "columnDefs": [
        {
          "targets": [ -1 ], //last column
          "orderable": false, //set not orderable
        },{ className: "number", "targets": [ 6,7,8,9,10 ] },
        ],
        });
      });

 function reloaddata(){
  table.ajax.url( "<?php echo site_url('tdo/grids')?>/"+$('#jenis_do').val()+'/'+$('#periode').val()+'?idpetani='+$('#id_petani_sap').val()+'&kodeblok='+$('#kode_blok').val() ).load();
 }

 function cetakdo(a){
    if($('#periode').val() != 'x'){
      if(a == 1)  window.open("<?=site_url('tdo/printall90');?>/"+$('#periode').val());
      else if(a == 2) window.open("<?=site_url('tdo/printall10');?>/"+$('#periode').val());
      else if(a == 3) window.open("<?=site_url('tdo/printallkwt');?>/"+$('#periode').val());
      else if(a == 4) window.open("<?=site_url('tdo/printalllampiran');?>/"+$('#periode').val());
  }else{
    alert("Pilih periode DO terlebih dahulu !!");
   }
  }

  function exporttoexcel(){
   // alert('a')
    if($('#periode').val() != 'x'){
        window.open("<?php echo site_url('tdo/exporttoexcel')?>?jenis="+$('#jenis_do').val()+'&periode='+$('#periode').val()+'&idpetani='+$('#id_petani_sap').val()+'&kodeblok='+$('#kode_blok').val());
    }else{
    alert("Pilih periode DO terlebih dahulu !!");
   }
  }
</script>
