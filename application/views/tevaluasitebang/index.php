<link rel="stylesheet" href="<?php echo base_url();?>/adminlte/plugins/toast/toast.css">
<script src="<?php echo base_url();?>/adminlte/plugins/toast/toast.js"></script>

  <div class="modal fade" tabindex="-1" role="dialog" id="modal-details" >
  <div class="modal-dialog" role="document">
    <div class="modal-content" style="width:850px">
      <div class="modal-header">
        <h5 class="modal-title">List Data SPTA </h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form id="frmdataha" enctype="multipart/form-data">
      <div class="modal-body">
        <table class="table table-bordered" id="datax" >
        <thead>
        <tr>
            <th>No</th>
            <th><input type="checkbox" id="checkAll"></th>
            <th>No SPTA</th>
            <th>Tgl SPTA</th>
            <th>Jenis SPTA</th>
            <th>Tgl Masuk</th>
            <th>Tgl Timbang</th>
            <th>Netto</th>
            <th>Ha</th>
        </tr>
        </thead>
        <tbody id="bodylist">
            
        </tbody>
        </table>
      </div>
      <div class="modal-footer">
      <button type="button" class="btn btn-danger pull-left" onclick="setaff()" >Set Aff</button>
        <button type="submit" class="btn btn-primary" >Validasi Luas</button>
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
      </div>
    </div>
        </form>
  </div>
</div>

<section class="content-header">
          <h1>
            <?php echo $pageTitle ;?>
          </h1>
          <ol class="breadcrumb">

            <li><i class="fa fa-dashboard"></i> <a href="<?php echo site_url('dashboard') ?>">Dashboard</a></li>
            <li><a href="<?php echo site_url('tkuotaspta') ?>"><?php echo $pageTitle ?></a></li>
            <li class="active"> Detail </li>
          </ol>
        </section>

 <section class="content">
          <div class="row">
            <div class="col-xs-12">
              <div class="box box-danger">
                <div class="box-header with-border">    
                
                <div class="col-md-3">
                
                <div class="box box-widget widget-user-2">
            <!-- Add the bg color to the header using any of the bg-* classes -->
            <div class="widget-user-header bg-aqua">
              <h5 class="widget-user-username" style="margin-left:10px"><i class="fa fa-qrcode"></i> Giling <?php echo CNF_TAHUNGILING ;?></h5>
            </div><br />
            <div class="box-footer no-padding" style="max-height:450px;min-height:480px;overflow:auto">
              <ul class="nav nav-stacked" id="listKkw">
              <?php
                foreach($rowdetail as $rd){
              ?>
                <li><a href="javascript:getTables('<?php echo $rd->kode_affd;?>','<?php echo $rd->nama_afdeling.' - '.$rd->name; ?>')"><?php echo $rd->nama_afdeling.' - '.$rd->name; ?> <span class="pull-right badge bg-red"><?php echo '>>';?></span></a></li>
                <?php
                }
                ?>
              </ul>
            </div>
          </div>
          
         
                </div>
                
                <div class="col-md-9">
                <fieldset><legend>List Petak Belum Validasi - <span id="title_evaluasi"></span></legend>
                
                <div class="col-md-12">
                 <div class="table-responsive">
                <table class="table table-striped table-bordered nowrap" id="gridv">
                                        <thead>
                                        <tr>
                                            <?php foreach ($tableGrid as $k => $t) : ?>
                                                <?php if($t['view'] =='1' ): ?>
                                                    <th><?php echo $t['label'] ?></th>
                                                <?php endif; ?>
                                            <?php endforeach; ?>
                                            <th><?php echo $this->lang->line('core.btn_action'); ?></th>
                                        </tr>
                                        </thead>
                                    </table>
                </div>
                </div>
                </fieldset>
                </div>
                
                
                <div style="clear:both"></div>  
                
                 
    

    
    <div class="col-xs-12">

    <fieldset><legend>Data Produksi Petak
 <div class="box-tools pull-right">

                            <a href="<?php echo site_url('tevaluasitebang/printprotas') ?>" class="tips btn btn-xs btn-danger" target="_blank" title="Export To Excel">
                                <i class="fa fa-print"></i>&nbsp;Export To Excel </a>
                    </div>
    </legend>
    
   
                
                <div class="col-md-12">
                 <div class="table-responsive">
                <table class="table table-striped table-bordered nowrap" id="gridv1">
                                        <thead>
                                        <tr>
                                            <?php foreach ($tableGrid as $k => $t) : ?>
                                                <?php if($t['view'] =='1' ): ?>
                                                    <th><?php echo $t['label'] ?></th>
                                                <?php endif; ?>
                                            <?php endforeach; ?>
                                            <th><?php echo $this->lang->line('core.btn_action'); ?></th>
                                        </tr>
                                        </thead>
                                    </table>
                </div>
                </div>
                </fieldset>
        
    </div>
    </div>
</div>
</div>
</div>
</section>
<script>
var table='';
var table1='';
var idk = 0;
var afdx = '';
var idsptakuota = 0;

$(document).ready(function(){
    // this is the id of the form
$("#frmdataha").submit(function(e) {

    var url = "<?php echo site_url('tevaluasitebang/save')?>"; 

    $.ajax({
           type: "POST",
           url: url,
           data: $("#frmdataha").serialize(), 
           beforeSend:function(){
                return confirm("Apakah anda yakin untuk memvalidasi luasan petak ini ?");
            },
           success: function(result)
           {
               //alert(data); 
               var t = result.split("*");
                for(i = 0; i < t.length-1;i++){

                var x = t[i];
                var r = x.split(".");
                if(r[0] == '1'){
                    $.toast({
                heading: 'Pemberitahuan',
                textAlign: 'center',
                text:r[1] ,
                icon: 'info',
                loader: true,        // Change it to false to disable loader
                loaderBg: '#9EC600',  
                hideAfter: 4000,
                showHideTransition: 'slide',
                position: 'top-right',  // To change the background
            });
                }else{
                    $.toast({
                heading: 'Pemberitahuan',
                textAlign: 'center',
                text:r[1] ,
                icon: 'error',
                loader: true,        // Change it to false to disable loader
                loaderBg: '#9EC600',
                hideAfter: 4000,
                showHideTransition: 'slide',
                position: 'top-right',  // To change the background
            });
                }
            }

                table.ajax.reload();
                table1.ajax.reload();
               details($('#kodeblok1').val(),$('#luasha1').val());
           }
         });

    e.preventDefault(); 
});


table1 = $('#gridv1').DataTable({
            "paging": true,
            "lengthChange": true,
            "searching": true,
            "ordering": true,
            "info": true,
            "autoWidth": true,

            "scrollCollapse": true,
            "processing": true, //Feature control the processing indicator.
            "serverSide": true, //Feature control DataTables' server-side processing mode.

            // Load data for the table's content from an Ajax source
            "ajax": {
                "url": "<?php echo site_url('tevaluasitebang/gridsLain')?>",
                "type": "POST"
            },

            //Set column definition initialisation properties.
            "columnDefs": [
                {  "targets": [3,6,7,8,9],"width": "50px" },
                {  "targets": [1,2],"width": "120px" },
                {"targets": [ -1 ], "orderable": false },
                { className: "number", "targets": [ 4,5,6,7,8 ] }
            ]
        });
    
});
function getTables(a,b){
    
    kodeafd = a;
    namaafd = b;
    $('#title_evaluasi').html(b);
    reloadgrid(a);
}




function refreshKkw(){
    var html = "";
    $.ajax({
        type: 'POST',
            url: "<?php echo site_url('tevaluasitebang/getlistkkw/');?>",
            success: function (data) {
                $('#listKkw').html(data);
                
            }
    });
}


function cekdataha(x,id){
    if(x){
        var d = parseFloat($('#ha_'+id).val());
        //alert(d);
        if(d <= 0){
            $.toast({
                heading: 'Pemberitahuan',
                textAlign: 'center',
                text:"Ha tidak boleh lebih kecil sama dengan 0 !!" ,
                icon: 'error',
                loader: true,        // Change it to false to disable loader
                loaderBg: '#9EC600',
                hideAfter: 4000,
                showHideTransition: 'slide',
                position: 'top-center',  // To change the background
            });

            $("#cek_"+id).prop("checked", false);
        }else{
            $("#ha_"+id).attr("readonly", true);
            $("#cek_"+id).val(d);
        }
    }else{
        $("#ha_"+id).attr("readonly", false);
        $("#cek_"+id).val(0);
    }
}


function reloadgrid(afd=afdx) {
        if(table!='') table.destroy();
        table = $('#gridv').DataTable({
            "paging": true,
            "lengthChange": true,
            "searching": true,
            "ordering": true,
            "info": true,
            "autoWidth": true,

            "scrollCollapse": true,
            "processing": true, //Feature control the processing indicator.
            "serverSide": true, //Feature control DataTables' server-side processing mode.

            // Load data for the table's content from an Ajax source
            "ajax": {
                "url": "<?php echo site_url('tevaluasitebang/grids')?>/"+afd,
                "type": "POST"
            },

            //Set column definition initialisation properties.
            "columnDefs": [
                {  "targets": [3,6,7,8,9],"width": "50px" },
                {  "targets": [1,2],"width": "120px" },
                {"targets": [ -1 ], "orderable": false },
                { className: "number", "targets": [ 4,5,6,7,8 ] }
            ]
        });


        
 }


 function details(kodeblok,luasha){
    $.ajax({
        url : "<?php echo site_url('tevaluasitebang/details');?>",
        method : "POST",
        data : {kode_blok:kodeblok,luasha:luasha},
        success : function(a){
            
            $('#bodylist').html(a); 
            $('#modal-details').modal('show');
        }
    });
 }

 function setaff(){
    var kodepetak = $('#kodeblok1').val();
        $.ajax({
            method  : "POST",
            url   : "<?php echo site_url('tevaluasitebang/updatesetaff');?>",
            data    : {kodepetak:kodepetak},
            beforeSend:function(){
                return confirm("Apakah anda yakin petak "+kodepetak+" sudah aff tebang ?");
            },
            success :   function(result){
                table.ajax.reload();
                table1.ajax.reload();
                alert('aff tebang petak '+kodepetak+' Berhasil');
            }
        });
    }
 

 $('#checkAll').on('ifChanged', function(event){
    $('input:checkbox').not(this).click();
    // $('input:checkbox').not(this).prop('checked', this.checked);
});

</script>
      