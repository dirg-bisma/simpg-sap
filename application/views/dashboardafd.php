<section class="content" style="padding-bottom: 0px">
         
            <div class="box-footer">
              <div class="row">
                <div class="row">
            <div class="col-xs-12">
              <div class="box box-danger">
                <div class="box-header with-border">  
        
        <div class="col-md-4">
        
        <div class="box box-widget widget-user-2">
            <!-- Add the bg color to the header using any of the bg-* classes -->
            <div class="widget-user-header bg-aqua">
              <h3 class="widget-user-username" style="margin-left:10px"><i class="fa fa-qrcode"></i> Giling <?php echo CNF_TAHUNGILING;?></h3>
              <h5 class="widget-user-desc" style="margin-left:10px">Tanggal SPTA </h5><span class="pull-right"><span class="badge bg-red" id="tercet">0 Tercetak</span>&nbsp;&nbsp;<span class="badge bg-green" id="msk">0 Masuk</span></span>
                <input type="date" id="tgl" class="form-control" value="<?=date('Y-m-d');?>" onchange="getdataspta()" />
            </div>
      <hr />  
          <div class="box-footer no-padding" style="max-height:480px;min-height:480px;overflow:auto">
              <ul class="nav nav-stacked" id="listKkw">
      
              </ul>
            </div>
          </div>
      
     
        </div>
        
        <div class="col-md-8">
        <iframe src="http://devproduksi.ptpn11.co.id/simpgdbmobile/tanaman.php?id=970" style="max-height:655px;min-height:665px;overflow:auto;width: 100%" ></iframe>
        </div>
        
        
        <div style="clear:both"></div>  
        
      </div>
    </div>    
  

  </div>


</div>
				
              <!-- /.row -->
            </div>
          </div>
      
      <div class="box box-warning">
<input type="hidden" id="tgl" />
  <div class="box-header with-border">
  <div class="col-md-4 col-xs-12">
  <!--selektor-->
  <table  style="padding: 3px;margin: 3px;width: 100%;">
      <thead>
      <tr>
     <th colspan="6" style="background: #36a65a36;padding: 3px;text-align: center">SELEKTOR (UNIT)</th>
      </tr>
      </thead>
      <tbody id="selektordata"></tbody>
      </table>
  </div>
  <div class="col-md-4  col-xs-12">
  <!--timbangan-->
  <table  style="padding: 3px;margin: 3px;width: 100%;">
      <thead>
      <tr>
      <th colspan="6" style="background: #3bc0f038;padding: 3px;text-align: center">TIMBANGAN (TON)</th>
      </tr>
      
      </thead>
      <tbody id="timbangandata"></tbody>
      </table>
  </div>
  <div class="col-md-4 col-xs-12">
  <!--gilingan-->
  <table  style="padding: 3px;margin: 3px;width: 100%;">
      <thead>
      <tr>
      <th colspan="6" style="background: #dd4b393d;padding: 3px;text-align: center">GILING (TON)</th>
      </tr>
      </thead>
      <tbody id="gilingandata"></tbody>
      </table>
  </div>
   
  </div>
</div>


</section>

<script type="text/javascript">
  $(document).ready(function(){
      getdataspta();
  });

  function getdataspta(){
  $.ajax({
       type: 'POST',
          url: '<?php echo site_url('dashboard/getkuotaspta');?>/'+$("#tgl").val(), 
          dataType : 'html',
          success: function (data) { 
            
            $('#listKkw').html(data);
            getdatasptadetail();
            getdata();
          }
        });
}

function getdatasptadetail(){
  $.ajax({
       type: 'POST',
          url: '<?php echo site_url('dashboard/gettotalquota');?>/'+$("#tgl").val(), 
          dataType : 'json',
          success: function (data) { 
            
           $('#msk').html(data.total_masuk+" Masuk");
           $('#tercet').html(data.total_cetak+" Cetak");
          }
        });
}

function datadetailspta(afd){
  SximoModal('<?php echo site_url('dashboard/detailspta');?>/'+$("#tgl").val()+'/'+afd,'Detail SPTA');
}

function getdata(){
  $.ajax({
       type: 'POST',
          url: '<?php echo site_url('dashboard/gettgl');?>', 
          dataType : 'html',
          success: function (data) { 
            $("#tgl").val(data);
            getselektor();
          }
        });
}

function getselektor(){
  $.ajax({
       type: 'POST',
          url: '<?php echo site_url('dashboard/viewperjam');?>/'+$("#tgl").val()+"/1", 
          dataType : 'html',
          success: function (data) { 
            $("#selektordata").html(data);
            gettimbangan();
          }
        });
}

function gettimbangan(){
  $.ajax({
       type: 'POST',
          url: '<?php echo site_url('dashboard/viewperjam');?>/'+$("#tgl").val()+"/2", 
          dataType : 'html',
          success: function (data) { 
            $("#timbangandata").html(data);
            getgilingan();
          }
        });
}

function getgilingan(){
  $.ajax({
       type: 'POST',
          url: '<?php echo site_url('dashboard/viewperjam');?>/'+$("#tgl").val()+"/3", 
          dataType : 'html',
          success: function (data) { 
            $("#gilingandata").html(data);
          }
        });
}
</script>