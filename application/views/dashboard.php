

 <section class="content" style="padding-bottom: 0px">
          <div class="row">
            <div class="col-xs-12">
              <div class="box box-danger">
              	<div class="box-header with-border">	
					<h2>  </h2>  
				
				<div class="col-md-12">
          <!-- Widget: user widget style 1 -->
          <div class="box box-widget widget-user">
            <!-- Add the bg color to the header using any of the bg-* classes -->
            <div class="widget-user-header bg-aqua-active">
              <h3 class="widget-user-username">SIMPG</h3>
              <h5 class="widget-user-desc"><?php echo CNF_PG;?></h5>
              <?
              if($this->session->userdata('gid') < 15){
              ?>
			  <?php echo form_open('dashboard/postgantimejatebu'); ?>
			  <div class="col-md-3">
			  <select id="mejatebu" name="mejatebu" class="form-control"></select>
			  </div><div class="col-md-3">
			  <button type="submit" class="btn btn-danger"  style="height: 30px;" > Ganti Gilingan </button>
			  </div>
			  <?php echo form_close();?> 
        <?
      }
        ?>
            </div>
            <div class="widget-user-image">
              <img class="img-circle" src="<?php echo base_url('logo.png');?>" alt="SIMPG" style="width:80px;height:80px">
            </div>
            <div class="box-footer">
              <div class="row">
                
				
              <!-- /.row -->
            </div>
          </div>
          <!-- /.widget-user -->
        </div>
			
			</div>
		</div>	

		 
		</div>	
	

	</div>
</div>


</section>
 <section class="content" style="padding-top: 0px">
  <?
              if($this->session->userdata('gid') < 15){
              ?>
<div class="box box-warning">
                <div class="box-header with-border">
        
        <div class="col-lg-2 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-aqua">
            <div class="inner">
              

              <p><i><b>SPTA</b></i></p>
            </div>
            <div class="icon" style="font-size: 40px;top:-5px">
              <i class="fa fa-print"></i>
            </div>
            
          </div>
        </div>
    
    <div class="col-lg-2 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-yellow">
            <div class="inner">
              

              <p><i><b>Selektor</b></i></p>
            </div>
            <div class="icon" style="font-size: 40px;top:-5px">
              <i class="fa fa-truck"></i>
            </div>
            
          </div>
        </div>
    <?php
    if(CNF_METODE == 2){
      ?>
    <div class="col-lg-2 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-red">
            <div class="inner">
              

              <p><i><b>Core Sampler</b></i></p>
            </div>
            <div class="icon" style="font-size: 40px;top:-5px">
              <i class="fa fa-flask"></i>
            </div>
            
          </div>
        </div>
    <?php
    }
    ?>
    <div class="col-lg-2 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-aqua">
            <div class="inner">
              

              <p><i><b>Timbang</i></b></p>
            </div>
            <div class="icon" style="font-size: 40px;top:-5px">
              <i class="fa fa-tags"></i>
            </div>
            
          </div>
        </div>
    
    <div class="col-lg-2 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-blue">
            <div class="inner">
              

              <p><i><b>Meja Tebu</b></i></p>
            </div>
            <div class="icon" style="font-size: 40px;top:-5px">
              <i class="fa fa-gears"></i>
            </div>
            
          </div>
        </div>
    
    <?php
    if(CNF_METODE == 1){
      ?>
    <div class="col-lg-2 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-red">
            <div class="inner">
              

              <p><i><b>ARI</b></i></p>
            </div>
            <div class="icon" style="font-size: 40px;top:-5px">
              <i class="fa fa-flask"></i>
            </div>
            
          </div>
        </div>
    <?php
    }
    ?>
    
    <div class="col-lg-2 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-green">
            <div class="inner">
              

              <p><i><b>Bagi Hasil</b></i></p>
            </div>
            <div class="icon" style="font-size: 40px;top:-5px">
              <i class="fa fa-money"></i>
            </div>
            
          </div>
        </div>
      
      
            <!-- /.info-box-content -->
          </div>
      
      </div>
<?
}
?>
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
<script>
var table;
 $(function () {
       // $("#gridv").DataTable();
      });
	  
$(document).ready(function(){
	$("#mejatebu").jCombo("<?php echo site_url('mmejatebu/comboselect?filter=vw_master_mejatebu:id:kode|nama') ?>",
		{  selected_value : '<?php echo $this->session->userdata('gilingan');?>', initial_text : ' - Aktifkan Gilingan -' });

  getdata();
 // setInterval(getdata, 60000);
});


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
	  