<section class="content-header">
          <h1>
            Updates
          </h1>
          <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
            <li>List Semua Update</li>
          </ol>
        </section>
	

	<section class="content">
          <div class="row">
            <div class="col-xs-12">
              <div class="box box-danger">
              	<div class="box-header with-border">
                  <h3 class="box-title">Update Modul</h3>
 <div class="box-body">
 	<div class="page-content-wrapper">
<table class="table table-bordered display dataTable no-footer" id="gridv" role="grid" aria-describedby="gridv_info">
        <thead>
          <th>Nama File</th>
          <th>Tanggal Updates</th>
          <th>Tanggal Sinkronisasi Local</th>
        </thead>
  <?php

    foreach ($direktori as $key) {
      echo "<tr><td>".$key->nama_file."</td><td>".$key->dateadd."</td><td>".$key->datesync."</td></tr>";
    }
  ?>
  </table>
  </div>
  </div>
  </div>
  </div>
  </div>
  </div>
  </section>