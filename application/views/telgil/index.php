<script src="<?php echo base_url('assets/grocery_crud/js/jquery_plugins/jquery.chosen.min.js'); ?>"></script>
<link type="text/css" rel="stylesheet" href="<?php echo base_url('assets/grocery_crud/css/jquery_plugins/chosen/chosen.css'); ?>" />
<section class="content-header">
</section>
<section class="content">
  <div class="row">
    <div class="col-xs-12">
      <div class="box box-danger">
        <div class="box-header with-border">
          <h3 class="box-title">Telegram Giling</h3>
          <div class="box-tools pull-right">
          </div>
        </div>
        <div class="box-body">
          <div class="page-content-wrapper m-t">
              <a href="<?php echo site_url('telgil'); ?>" class="btn btn-default btn-sm">Daftar Telgil</a>
              <a href="<?php echo site_url('telgil/template'); ?>" class="btn btn-primary btn-sm">Download Template</a>
              <a href="<?php echo site_url('telgil/import_produksi/add'); ?>" class="btn btn-success btn-sm">Import Produksi</a>
              <a href="<?php echo site_url('telgil/import_evaluasi/add'); ?>" class="btn btn-success btn-sm">Import Evaluasi</a>
              <a href="<?php echo site_url('telgil/report_telgil/add'); ?>" class="btn btn-warning btn-sm">Report</a>
            <div class="sbox animated fadeIn">
              <div class="sbox-content">
                    <?php
                    if (isset($output->css_files)) {
                    foreach($output->css_files as $file): ?>
                    <link type="text/css" rel="stylesheet" href="<?php echo $file; ?>" />
                    <?php endforeach; }?>
                    <?php
                    if (isset($output->js_files)) {
                    foreach($output->js_files as $file): ?>
                    <script src="<?php echo $file; ?>"></script>
                    <?php endforeach; }?>
                    <style type="text/css">
                     .container{
                        width: 100%;
                      }
                    </style>
                       <?php 
                        if (!empty($render)) {
                            echo $render; 
                        }
                        if (!empty($output)) {
                            if (!empty($title)) {
                              $title = $title;
                            }else{
                              $title = "";
                            }
                           if (!empty($output->output)) {
                              echo $output->output;
                               }else{
                              echo $output;
                            }
                          echo '<hr><div id="konten" style="overflow-x:scroll;"></div></div></div>';
                           echo $style;
                           if (!empty($script)) {
                            echo $script;
                           }
                        }
                        ?>     
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>