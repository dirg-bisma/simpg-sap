<style type="text/css">
    table.tableizer-table {
        font-size: 12px;
        border: 1px solid #CCC;
        font-family: Arial, Helvetica, sans-serif;
        width:100%;
    }
    .tableizer-table td {
        padding: 4px;
        margin: 3px;
        border: 1px solid #CCC;
    }
    .tableizer-table th {
        background-color: #104E8B;
        color: #FFF;
        font-weight: bold;
        height:25px;padding:10px;
        border: 1px solid #ffffff;
    }
</style>


<section class="content">
    <div class="row">
        <div class="col-xs-12">
            <div class="box box-danger">
                <div class="box-header with-border">
                    <h3 class="box-title">Laporan Produksi Hari Giling ke <?php echo $hari_giling;?></h3>
                    <div class="box-tools pull-right">



                    </div>
                </div>

                <div class="box-body">

                    <div class="page-content-wrapper m-t">

                        <div class="sbox animated fadeIn">
                            <div class="sbox-content" style="height:650px;padding:10px;overflow:auto" id="report" >
                            <form action="<?php echo site_url("lapproduksi/save");?>" method="post">
                                <div class="table-responsive">
                                <table class="tableizer-table">
                                    <thead>
                                    <tr class="tableizer-firstrow">
                                        <th style="text-align: center" rowspan="2">Kategori</th>
                                        <th style="text-align: center" colspan="2">Ha. Ditebang</th>
                                        <th style="text-align: center" colspan="2">Qty. Ditebang</th>
                                        <th style="text-align: center" colspan="2">Ha. Digiling</th>
                                        <th style="text-align: center" colspan="2">Qty. Digiling</th>
                                        <th style="text-align: center" colspan="2">Qty. Kristal</th>
                                        <th style="text-align: center" colspan="2">Rendemen</th>
                                        <th style="text-align: center" colspan="2">Qty. Gula PTR</th>
                                        <th style="text-align: center" colspan="2">Qty. Tetes PTR</th>
                                    </tr>
                                    <tr class="tableizer-firstrow">
                                        <th style="text-align: center">HI</th>
                                        <th style="text-align: center">SD</th>
                                        <th style="text-align: center">HI</th>
                                        <th style="text-align: center">SD</th>
                                        <th style="text-align: center">HI</th>
                                        <th style="text-align: center">SD</th>
                                        <th style="text-align: center">HI</th>
                                        <th style="text-align: center">SD</th>
                                        <th style="text-align: center">HI</th>
                                        <th style="text-align: center">SD</th>
                                        <th style="text-align: center">HI</th>
                                        <th style="text-align: center">SD</th>
                                        <th style="text-align: center">HI</th>
                                        <th style="text-align: center">SD</th>
                                        <th style="text-align: center">HI</th>
                                        <th style="text-align: center">SD</th>
                                    </tr>
                                    </thead>
                                    <?php
                                    $ci =&get_instance();
                                    $ci->load->model('lapproduksimodel');
                                    ?>
                                    <?php
                                    $total_ha_ditebang_ts = 0;
                                    $total_qty_ditebang_ts = 0;
                                    $total_ha_digiling_ts = 0;
                                    $total_qty_digiling_ts = 0;
                                    $total_hablur_ts = 0;
                                    $total_gula_ptr_ts = 0;
                                    $total_tetes_ptr_ts = 0;
                                    function replaceKat($kat){
                                        $result = str_replace(" ", "_", $kat);
                                        $output = str_replace("-", "_", $result);
                                        return $output;
                                    }
                                    ?>
                                    <tbody>
                                    <?php foreach ($kode_kat_ts as $tdat_ts){
                                        ?>
                                        <?php
                                        $data_lap_timb_ts = $ci->lapproduksimodel->VwByKategoriByTimbangan($tdat_ts->kode_kat_ptp, $hari_giling);
                                        $data_lap_ari_ts = $ci->lapproduksimodel->VwByKategoriByAri($tdat_ts->kode_kat_ptp, $hari_giling);
                                        $sum_lap_ts = $ci->lapproduksimodel->SumLap($tdat_ts->kode_kat_ptp, $hari_giling);
                                        ?>
                                        <tr>
                                            <td><?php echo $tdat_ts->kode_kat_ptp; ?>
                                                <input type="hidden" name="kode_kat_lahan_<?php echo replaceKat($tdat_ts->kode_kat_ptp);?>" value="<?php echo $tdat_ts->kat_sap; ?>">
                                                <input type="hidden" name="kat_ptpn_<?php echo replaceKat($tdat_ts->kode_kat_ptp);?>" value="<?php echo $tdat_ts->kode_kat_ptp; ?>">
                                                <input type="hidden" name="kat_kepemilikan_<?php echo replaceKat($tdat_ts->kode_kat_ptp);?>" value="TS">
                                            </td>
                                            <td>
                                                <?php echo isset($data_lap_timb_ts->ha_tertebang_field) ? number_format($data_lap_timb_ts->ha_tertebang_field, 4) : "-"; ?>
                                                <?php if(isset($data_lap_timb_ts->ha_tertebang_field)){ ?>
                                                    <input type="hidden" name="ha_tertebang_<?php echo replaceKat($tdat_ts->kode_kat_ptp);?>" value="<?php echo $data_lap_timb_ts->ha_tertebang_field; ?>">
                                                    <?php $total_ha_ditebang_ts += $data_lap_timb_ts->ha_tertebang_field; } ?>
                                            </td>
                                            <td><?php echo $sum_lap_ts->sum_ha_tertebang; ?></td>
                                            <td>
                                                <?php echo isset($data_lap_timb_ts->netto) ? number_format($data_lap_timb_ts->netto) : "-"; ?>
                                                <?php if(isset($data_lap_timb_ts->netto)){ ?>
                                                    <input type="hidden" name="qty_tertebang_<?php echo replaceKat($tdat_ts->kode_kat_ptp);?>" value="<?php echo $data_lap_timb_ts->netto; ?>">
                                                    <?php $total_qty_ditebang_ts += $data_lap_timb_ts->netto;} ?>
                                            </td>
                                            <td><?php echo $sum_lap_ts->sum_qty_tertebang; ?></td>
                                            <td>
                                                <?php echo isset($data_lap_ari_ts->ha_tertebang_field) ? number_format($data_lap_ari_ts->ha_tertebang_field, 4) : "-"; ?>
                                                <?php if(isset($data_lap_ari_ts->ha_tertebang_field)){ ?>
                                                    <input type="hidden" name="ha_digiling_<?php echo replaceKat($tdat_ts->kode_kat_ptp);?>" value="<?php echo $data_lap_ari_ts->ha_tertebang_field; ?>">
                                                    <?php  $total_ha_digiling_ts += $data_lap_ari_ts->ha_tertebang_field;} ?>
                                            </td>
                                            <td><?php echo $sum_lap_ts->sum_ha_digiiling; ?></td>
                                            <td>
                                                <?php echo isset($data_lap_ari_ts->netto) ? number_format($data_lap_ari_ts->netto) : "-"; ?>
                                                <?php if(isset($data_lap_ari_ts->netto)){ ?>
                                                    <input type="hidden" name="qty_digiling_<?php echo replaceKat($tdat_ts->kode_kat_ptp);?>" value="<?php echo $data_lap_ari_ts->netto; ?>">
                                                    <?php $total_qty_digiling_ts += $data_lap_ari_ts->netto;} ?>
                                            </td>
                                            <td><?php echo $sum_lap_ts->sum_qty_digiling; ?></td>
                                            <td>
                                                <?php echo isset($data_lap_ari_ts->hablur) ? number_format($data_lap_ari_ts->hablur) : "-"; ?>
                                                <?php if(isset($data_lap_ari_ts->hablur)){ ?>
                                                    <input type="hidden" name="qty_kristal_<?php echo replaceKat($tdat_ts->kode_kat_ptp);?>" value="<?php echo $data_lap_ari_ts->hablur; ?>">
                                                    <?php $total_hablur_ts += $data_lap_ari_ts->hablur;} ?>
                                            </td>
                                            <td><?php echo $sum_lap_ts->sum_qty_kristal; ?></td>
                                            <td>
                                                <?php echo isset($data_lap_ari_ts->rendemen_total) ? number_format($data_lap_ari_ts->rendemen_total,2) : "-"; ?>
                                                <?php if(isset($data_lap_ari_ts->rendemen_total)){ ?>
                                                    <input type="hidden" name="rendemen_<?php echo replaceKat($tdat_ts->kode_kat_ptp);?>" value="<?php echo $data_lap_ari_ts->rendemen_total; ?>">
                                                    <?php } ?>
                                            </td>
                                            <td><?php echo $sum_lap_ts->total_rendemen; ?></td>
                                            <td>
                                                <?php echo isset($data_lap_ari_ts->gula_ptr) ? number_format($data_lap_ari_ts->gula_ptr) : "-"; ?>
                                                <?php if(isset($data_lap_ari_ts->gula_ptr)){ ?>
                                                    <input type="hidden" name="qty_gula_ptr_<?php echo replaceKat($tdat_ts->kode_kat_ptp);?>" value="<?php echo $data_lap_ari_ts->gula_ptr; ?>">
                                                    <?php $total_gula_ptr_ts += $data_lap_ari_ts->gula_ptr;} ?>
                                            </td>
                                            <td><?php echo $sum_lap_ts->sum_qty_gula_ptr; ?></td>
                                            <td>
                                                <?php echo isset($data_lap_ari_ts->tetes_ptr) ? number_format($data_lap_ari_ts->tetes_ptr) : "-"; ?>
                                                <?php if(isset($data_lap_ari_ts->tetes_ptr)){ ?>
                                                    <input type="hidden" name="qty_tetes_ptr_<?php echo replaceKat($tdat_ts->kode_kat_ptp);?>" value="<?php echo $data_lap_ari_ts->tetes_ptr; ?>">
                                                    <?php $total_tetes_ptr_ts += $data_lap_ari_ts->tetes_ptr;} ?>
                                            </td>
                                            <td><?php echo $sum_lap_ts->sum_qty_tetes_ptr; ?></td>
                                        </tr>
                                    <?php } ?>
                                    <tr style="background-color: #9d9d9d">
                                        <td><strong>TOTAL TS</strong></td>
                                        <td><strong><?php echo number_format($total_ha_ditebang_ts, 4); ?></strong></td>
                                        <td><strong>-</strong></td>
                                        <td><strong><?php echo number_format($total_qty_ditebang_ts);?></strong></td>
                                        <td><strong>-</strong></td>
                                        <td><strong><?php echo number_format($total_ha_digiling_ts, 4); ?></strong></td>
                                        <td><strong>-</strong></td>
                                        <td><strong><?php echo number_format($total_qty_digiling_ts); ?></strong></td>
                                        <td><strong>-</strong></td>
                                        <td><strong><?php echo number_format($total_hablur_ts); ?></strong></td>
                                        <td><strong>-</strong></td>
                                        <td><strong><?php echo @number_format(($total_hablur_ts/$total_qty_digiling_ts)*100,2); ?></strong></td>
                                        <td><strong>-</strong></td>
                                        <td><strong><?php echo number_format($total_gula_ptr_ts); ?></strong></td>
                                        <td><strong>-</strong></td>
                                        <td><strong><?php echo number_format($total_tetes_ptr_ts); ?></strong></td>
                                        <td><strong>-</strong></td>
                                    </tr>
                                    <?php
                                    $total_ha_ditebang_tr = 0;
                                    $total_qty_ditebang_tr = 0;
                                    $total_ha_digiling_tr = 0;
                                    $total_qty_digiling_tr = 0;
                                    $total_hablur_tr = 0;
                                    $total_gula_ptr_tr = 0;
                                    $total_tetes_ptr_tr = 0;
                                    ?>
                                    <?php foreach ($kode_kat_tr as $tdat_tr){ ?>
                                        <?php
                                        $data_lap_timb_tr = $ci->lapproduksimodel->VwByKategoriByTimbangan($tdat_tr->kode_kat_ptp, $hari_giling);
                                        $data_lap_ari_tr = $ci->lapproduksimodel->VwByKategoriByAri($tdat_tr->kode_kat_ptp, $hari_giling);
                                        $sum_lap_tr = $ci->lapproduksimodel->SumLap($tdat_tr->kode_kat_ptp, $hari_giling);
                                        ?>
                                        <tr>
                                            <td><?php echo $tdat_tr->kode_kat_ptp;?>
                                                <input type="hidden" name="kode_kat_lahan_<?php echo replaceKat($tdat_tr->kode_kat_ptp);?>" value="<?php echo $tdat_tr->kat_sap; ?>">
                                                <input type="hidden" name="kat_ptpn_<?php echo replaceKat($tdat_tr->kode_kat_ptp);?>" value="<?php echo $tdat_tr->kode_kat_ptp; ?>">
                                                <input type="hidden" name="kat_kepemilikan_<?php echo replaceKat($tdat_tr->kode_kat_ptp);?>" value="TR">
                                            </td>
                                            <td>
                                                <?php echo isset($data_lap_timb_tr->ha_tertebang_field) ? number_format($data_lap_timb_tr->ha_tertebang_field, 4) : "-"; ?>
                                                <?php if(isset($data_lap_timb_tr->ha_tertebang_field)){ ?>
                                                    <input type="hidden" name="ha_tertebang_<?php echo replaceKat($tdat_tr->kode_kat_ptp);?>" value="<?php echo $data_lap_timb_tr->ha_tertebang_field; ?>">
                                                    <?php $total_ha_ditebang_tr += $data_lap_timb_tr->ha_tertebang_field;} ?>
                                            </td>
                                            <td><?php echo $sum_lap_tr->sum_ha_tertebang; ?></td>
                                            <td>
                                                <?php echo isset($data_lap_timb_tr->netto) ? number_format($data_lap_timb_tr->netto) : "-"; ?>
                                                <?php if(isset($data_lap_timb_tr->netto)){ ?>
                                                    <input type="hidden" name="qty_tertebang_<?php echo replaceKat($tdat_tr->kode_kat_ptp);?>" value="<?php echo $data_lap_timb_tr->netto; ?>">
                                                    <?php $total_qty_ditebang_tr += $data_lap_timb_tr->netto;} ?>
                                            </td>
                                            <td><?php echo $sum_lap_tr->sum_qty_tertebang; ?></td>
                                            <td>
                                                <?php echo isset($data_lap_ari_tr->ha_tertebang_field) ? number_format($data_lap_ari_tr->ha_tertebang_field, 4) : "-"; ?>
                                                <?php if(isset($data_lap_ari_tr->ha_tertebang_field)){ ?>
                                                    <input type="hidden" name="ha_digiling_<?php echo replaceKat($tdat_tr->kode_kat_ptp);?>" value="<?php echo $data_lap_ari_tr->ha_tertebang_field; ?>">
                                                    <?php  $total_ha_digiling_tr += $data_lap_ari_tr->ha_tertebang_field;} ?>
                                            </td>
                                            <td><?php echo $sum_lap_tr->sum_ha_digiiling; ?></td>
                                            <td>
                                                <?php echo isset($data_lap_ari_tr->netto) ? number_format($data_lap_ari_tr->netto) : "-"; ?>
                                                <?php if(isset($data_lap_ari_tr->netto)){ ?>
                                                    <input type="hidden" name="qty_digiling_<?php echo replaceKat($tdat_tr->kode_kat_ptp);?>" value="<?php echo $data_lap_ari_tr->netto; ?>">
                                                    <?php $total_qty_digiling_tr += $data_lap_ari_tr->netto;} ?>
                                            </td>
                                            <td><?php echo $sum_lap_tr->sum_qty_digiling; ?></td>
                                            <td>
                                                <?php echo isset($data_lap_ari_tr->hablur) ? number_format($data_lap_ari_tr->hablur) : "-"; ?>
                                                <?php if(isset($data_lap_ari_tr->hablur)){ ?>
                                                    <input type="hidden" name="qty_kristal_<?php echo replaceKat($tdat_tr->kode_kat_ptp);?>" value="<?php echo $data_lap_ari_tr->hablur; ?>">
                                                    <?php $total_hablur_tr += $data_lap_ari_tr->hablur;} ?>
                                            </td>
                                            <td><?php echo $sum_lap_tr->sum_qty_kristal; ?></td>
                                            <td>
                                                <?php echo isset($data_lap_ari_tr->rendemen_total) ? number_format($data_lap_ari_tr->rendemen_total,2) : "-"; ?>
                                                <?php if(isset($data_lap_ari_tr->rendemen_total)){ ?>
                                                    <input type="hidden" name="rendemen_<?php echo replaceKat($tdat_tr->kode_kat_ptp);?>" value="<?php echo $data_lap_ari_tr->rendemen_total; ?>">
                                                <?php } ?>
                                            </td>
                                            <td><?php echo $sum_lap_tr->total_rendemen; ?></td>
                                            <td>
                                                <?php echo isset($data_lap_ari_tr->gula_ptr) ? number_format($data_lap_ari_tr->gula_ptr) : "-"; ?>
                                                <?php if(isset($data_lap_ari_tr->gula_ptr)){ ?>
                                                    <input type="hidden" name="qty_gula_ptr_<?php echo replaceKat($tdat_tr->kode_kat_ptp);?>" value="<?php echo $data_lap_ari_tr->gula_ptr; ?>">
                                                    <?php $total_gula_ptr_tr += $data_lap_ari_tr->gula_ptr;} ?>
                                            </td>
                                            <td><?php echo $sum_lap_tr->sum_qty_gula_ptr; ?></td>
                                            <td>
                                                <?php echo isset($data_lap_ari_tr->tetes_ptr) ? number_format($data_lap_ari_tr->tetes_ptr) : "-"; ?>
                                                <?php if(isset($data_lap_ari_tr->tetes_ptr)){ ?>
                                                    <input type="hidden" name="qty_tetes_ptr_<?php echo replaceKat($tdat_tr->kode_kat_ptp);?>" value="<?php echo $data_lap_ari_tr->tetes_ptr; ?>">
                                                    <?php $total_tetes_ptr_tr += $data_lap_ari_tr->tetes_ptr;} ?>
                                            </td>
                                            <td><?php echo $sum_lap_tr->sum_qty_tetes_ptr; ?></td>
                                        </tr>
                                    <?php } ?>
                                    <tr style="background-color: #9d9d9d">
                                        <td><strong>TOTAL TR</strong></td>
                                        <td><strong><?php echo number_format($total_ha_ditebang_tr, 4); ?></strong></td>
                                        <td><strong>-</strong></td>
                                        <td><strong><?php echo number_format($total_qty_ditebang_tr); ?></strong></td>
                                        <td><strong>-</strong></td>
                                        <td><strong><?php echo number_format($total_ha_digiling_tr, 4); ?></strong></td>
                                        <td><strong>-</strong></td>
                                        <td><strong><?php echo number_format($total_qty_digiling_tr); ?></strong></td>
                                        <td><strong>-</strong></td>
                                        <td><strong><?php echo number_format($total_hablur_tr); ?></strong></td>
                                        <td><strong>-</strong></td>
                                        <td><strong><?php echo @number_format(($total_hablur_tr/$total_qty_digiling_tr)*100,2); ?></strong></td>
                                        <td><strong>-</strong></td>
                                        <td><strong><?php echo number_format($total_gula_ptr_tr); ?></strong></td>
                                        <td><strong>-</strong></td>
                                        <td><strong><?php echo number_format($total_tetes_ptr_tr); ?></strong></td>
                                        <td><strong>-</strong></td>
                                    </tr>
                                    </tbody>
                                </table>
                                    <div style="clear:both"></div>
                                </div>

                                <div style="clear:both"></div>
                                <hr>
                                <div class="col-md-12">
                                    <div class='form-horizontal'>
                                        <div class="col-md-6">
                                        <div class="form-group" >
                                            <label for="Tgl Laporan Produksi" class=" control-label col-md-4 text-left"> Tgl Lap. Produksi </label>
                                            <div class="col-md-8">
                                                <input type='text' class='form-control input-sm date' placeholder='' value='<?php echo $tgl_giling->tgl_giling; ?>' name='tgl_laporan_produksi'/> <br />
                                                <input type='hidden' class='form-control input-sm date' placeholder='' value='<?php echo $hari_giling; ?>' name='hari_giling'/> <br />
                                                <i> <small></small></i>
                                            </div>
                                        </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group" >
                                                <div class="toolbar-line text-center">
                                                    <button type="submit" class="btn btn-primary">SIMPAN</button>
                                                </div>
                                            </div>
                                        </div>

                                    </div>

                                </div>
                            </form>

                            </div>
                        </div>


                    </div>
                </div>
            </div>
        </div>
    </div>
</section>