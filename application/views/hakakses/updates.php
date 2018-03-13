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
  <?php

    function execPrint($command) {
    $result = array();
    exec($command, $result);
    foreach ($result as $line) {
        print($line . "\n");
    }
}
// Print the exec output inside of a pre element
print("<pre>" . execPrint("git pull")."</pre>");

  ?>
  </div>
  </div>
  </div>
  </div>
  </div>
  </div>
  </section>