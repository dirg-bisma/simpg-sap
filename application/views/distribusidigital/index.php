<section class="content">
          <div class="row">
            <div class="col-xs-12">
              <div class="box box-danger">
              	<div class="box-header with-border">
                  <h3 class="box-title">Distribusi Digital SPTA</h3>
                  <div class="box-tools pull-right">
 	
                  </div>
                </div>

	 <div class="box-body">

	<div class="page-content-wrapper m-t">
    
<div class="sbox animated fadeIn">
	<div class="sbox-content">	

	 <div class="col-xs-12">
	 	<input type="date" name="tgl_spta" id="tgl" class="form-control input-sm" value="<?=date('Y-m-d');?>">
	 	<br />
	 	<input type="text" placeholder="Filter by kode blok / nama blok" name="kode_blok" id="filter" class="form-control input-sm" autocomplete="off">
	 	<br />
	 	<a href="javascript:filterdata(5)" class="btn btn-danger" style="width: 100%"><i class="fa fa-filter"></i> Cari</a>
	 <hr />
	 </div>
	 <center>
	 <div class="nav-tabs-custom" >
            <ul class="nav nav-tabs" >
              <li class="active" style="width: 45%"><a href="#tab_1" data-toggle="tab"  onclick="filterdata(0)" aria-expanded="true"><b>Belum</b></a></li>
              <li class="" style="width: 45%"><a href="#tab_2" onclick="filterdata(1)" data-toggle="tab" aria-expanded="false"><b>Sudah</b></a></li>
          </ul>
      </div>
  </center>
	 <div class="table-responsive">
    <table class="table table-bordered display" id="gridv">
        <thead>
			<tr>
				<th> List SPTA </th>
				<th style="width: 20px"> Action </th>
			  </tr>
        </thead>
        <tbody id="dataList">
        	
        </tbody>

        

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
<script type="text/javascript">
	//var jenis = 0;
	function filterdata(jns){
		
		if(jns == 5){
			if(!localStorage.jns){
				localStorage.jns = 0;
			}
		}else{
			if(!localStorage.jns){
				localStorage.jns = 0;
			}else{
				localStorage.jns = jns;
			}
		}

		$('#dataList').html('<tr><td colspan="2">Loading..</td></tr>');
		$.ajax({
		type: 'POST',
            url: "<?php echo site_url('distribusidigital/dataList');?>",
			data:{tgl:$('#tgl').val(),filter:$('#filter').val(),jenis:localStorage.jns},
			dataType:'html',
            success: function (data) {
                $('#dataList').html(data);
            },
             error: function (request, status, error) {
		$('#dataList').html('<tr><td colspan="2">error Ulangi lagi ..</td></tr>');
    }
	});
	}

	function formDistribusi(id){
		SximoModal('<?php echo site_url("distribusidigital/form");?>/'+id,"Distribusi Digital");
	}

	function viewDistribusi(id){
		SximoModal('<?php echo site_url("distribusidigital/view");?>/'+id,"Distribusi Digital");
	}
</script>