<script src="<?php echo base_url('assets/grocery_crud/js/jquery_plugins/jquery.chosen.min.js'); ?>"></script>
<link type="text/css" rel="stylesheet" href="<?php echo base_url('assets/grocery_crud/css/jquery_plugins/chosen/chosen.css'); ?>" />
<section class="content-header">

</section>
<section class="content">
  <div class="row">
    <div class="col-xs-12">
      <div class="box box-danger">
        <div class="box-header with-border">
          <h3 class="box-title">TSPG</h3>
          <div class="box-tools pull-right">
          </div>
        </div>
        <div class="box-body">
          <div class="page-content-wrapper m-t">
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
                      .delete-confirmation{
                        z-index: 1000;
                        padding-top: 100px;
                      }
                      .modal-backdrop.in{
                        z-index: -01;
                      }
                      .chzn-container-single .chzn-single {
                        padding: 4px 0 0 8px;
                        height: 33px;
                        width: 154px;
                    }
                    </style>
                    <script>
                      $(".modal-backdrop").remove();
                    </script>
                    
                       <?php
                       if (!empty($button)) {
                          echo $button;
                        } 
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