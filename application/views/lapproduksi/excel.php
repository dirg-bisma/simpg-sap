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
                                        <input type="hidden" name="hari_giling" value="<?php echo $hari_giling; ?>">
                                        <table class="tableizer-table">
                                            <thead>
                                            <tr style="background-color: #104E8B" class="tableizer-firstrow">
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

                                            $sd_total_ha_ditebang_ts = 0;
                                            $sd_total_qty_ditebang_ts = 0;
                                            $sd_total_ha_digiling_ts = 0;
                                            $sd_total_qty_digiling_ts = 0;
                                            $sd_total_hablur_ts = 0;
                                            $sd_total_gula_ptr_ts = 0;
                                            $sd_total_tetes_ptr_ts = 0;
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

                                                    </td>
                                                    <td>
                                                        <?php echo isset($data_lap_timb_ts->ha_tertebang_selektor) ? number_format($data_lap_timb_ts->ha_tertebang_selektor, 4) : "-"; ?>
                                                        <?php if(isset($data_lap_timb_ts->ha_tertebang_selektor)){ ?>

                                                            <?php $total_ha_ditebang_ts += $data_lap_timb_ts->ha_tertebang_selektor; } ?>
                                                    </td>
                                                    <td><?php echo number_format($sum_lap_ts->sum_ha_tertebang,2); ?></td>
                                                    <?php $sd_total_ha_ditebang_ts +=$sum_lap_ts->sum_ha_tertebang;?>
                                                    <td>
                                                        <?php echo isset($data_lap_timb_ts->netto) ? number_format($data_lap_timb_ts->netto) : "-"; ?>
                                                        <?php if(isset($data_lap_timb_ts->netto)){ ?>

                                                            <?php $total_qty_ditebang_ts += $data_lap_timb_ts->netto;} ?>
                                                    </td>
                                                    <td><?php echo number_format($sum_lap_ts->sum_qty_tertebang,2); ?></td>
                                                    <?php $sd_total_qty_ditebang_ts += $sum_lap_ts->sum_qty_tertebang; ?>
                                                    <td>
                                                        <?php echo isset($data_lap_ari_ts->ha_tertebang_field) ? number_format($data_lap_ari_ts->ha_tertebang_field, 4) : "-"; ?>
                                                        <?php if(isset($data_lap_ari_ts->ha_tertebang_field)){ ?>

                                                            <?php  $total_ha_digiling_ts += $data_lap_ari_ts->ha_tertebang_field;} ?>
                                                    </td>
                                                    <td><?php echo number_format($sum_lap_ts->sum_ha_digiiling,2); ?></td>
                                                    <?php  $sd_total_ha_digiling_ts += $sum_lap_ts->sum_ha_digiiling; ?>
                                                    <td>
                                                        <?php echo isset($data_lap_ari_ts->netto) ? number_format($data_lap_ari_ts->netto) : "-"; ?>
                                                        <?php if(isset($data_lap_ari_ts->netto)){ ?>

                                                            <?php $total_qty_digiling_ts += $data_lap_ari_ts->netto;} ?>
                                                    </td>
                                                    <td><?php echo number_format($sum_lap_ts->sum_qty_digiling,2); ?></td>
                                                    <?php $sd_total_qty_digiling_ts += $sum_lap_ts->sum_qty_digiling; ?>
                                                    <td>
                                                        <?php echo isset($data_lap_ari_ts->hablur) ? number_format($data_lap_ari_ts->hablur) : "-"; ?>
                                                        <?php if(isset($data_lap_ari_ts->hablur)){ ?>

                                                            <?php $total_hablur_ts += $data_lap_ari_ts->hablur;} ?>
                                                    </td>
                                                    <td><?php echo number_format($sum_lap_ts->sum_qty_kristal,2); ?></td>
                                                    <?php $sd_total_hablur_ts += $sum_lap_ts->sum_qty_kristal; ?>
                                                    <td>
                                                        <?php echo isset($data_lap_ari_ts->rendemen_total) ? number_format($data_lap_ari_ts->rendemen_total,2) : "-"; ?>
                                                        <?php if(isset($data_lap_ari_ts->rendemen_total)){ ?>

                                                        <?php } ?>
                                                    </td>
                                                    <td><?php echo number_format($sum_lap_ts->total_rendemen,2); ?></td>
                                                    <td>
                                                        <?php echo isset($data_lap_ari_ts->gula_ptr) ? number_format($data_lap_ari_ts->gula_ptr) : "-"; ?>
                                                        <?php if(isset($data_lap_ari_ts->gula_ptr)){ ?>

                                                            <?php $total_gula_ptr_ts += $data_lap_ari_ts->gula_ptr;} ?>
                                                    </td>
                                                    <td><?php echo number_format($sum_lap_ts->sum_qty_gula_ptr,2); ?></td>
                                                    <?php $sd_total_gula_ptr_ts += $sum_lap_ts->sum_qty_gula_ptr; ?>
                                                    <td>
                                                        <?php echo isset($data_lap_ari_ts->tetes_ptr) ? number_format($data_lap_ari_ts->tetes_ptr) : "-"; ?>
                                                        <?php if(isset($data_lap_ari_ts->tetes_ptr)){ ?>

                                                            <?php $total_tetes_ptr_ts += $data_lap_ari_ts->tetes_ptr;} ?>
                                                    </td>
                                                    <td><?php echo number_format($sum_lap_ts->sum_qty_tetes_ptr,2); ?></td>
                                                    <?php $sd_total_tetes_ptr_ts += $sum_lap_ts->sum_qty_tetes_ptr; ?>
                                                </tr>
                                                <?php if($tdat_ts->kode_kat_ptp == "TS-TR"){?>
                                                    <?php
                                                    $data_group_plant = $ci->lapproduksimodel->GroupPlant($tdat_ts->kode_kat_ptp);
                                                    ?>
                                                    <?php foreach($data_group_plant as $row_plant) {?>
                                                        <?php
                                                        $ari_transfer = $ci->lapproduksimodel->VwKategoriByAriTransfer($tdat_ts->kode_kat_ptp, $row_plant->kode_plant_trasnfer, $hari_giling);
                                                        $timb_transfer = $ci->lapproduksimodel->VwKategoriByTimbanganTransfer($tdat_ts->kode_kat_ptp, $row_plant->kode_plant_trasnfer, $hari_giling);
                                                        $sum_transfer = $ci->lapproduksimodel->SumLapTrans($tdat_ts->kode_kat_ptp, $row_plant->kode_plant_trasnfer, $hari_giling);

                                                        ?>

                                                        <tr>
                                                            <td> -- <?php echo $row_plant->nama_plant." (".$row_plant->kode_plant_trasnfer.")"; ?>

                                                            </td>
                                                            <td><?php echo isset($timb_transfer->ha_tertebang_selektor) ? number_format($timb_transfer->ha_tertebang_selektor,2) : "-"; ?>
                                                                <?php if(isset($timb_transfer->ha_tertebang_selektor)){?>

                                                                <?php }?>
                                                            </td>
                                                            <td><?php echo isset($sum_transfer->sum_ha_tertebang) ? number_format($sum_transfer->sum_ha_tertebang,2) : "-"; ?></td>
                                                            <td><?php echo isset($timb_transfer->netto) ? number_format($timb_transfer->netto) : "-"; ?>
                                                                <?php if(isset($timb_transfer->netto)){?>

                                                                <?php } ?>
                                                            </td>
                                                            <td><?php echo isset($sum_transfer->sum_qty_tertebang) ? number_format($sum_transfer->sum_qty_tertebang,2) : "-"; ?></td>
                                                            <td><?php echo isset($ari_transfer->ha_tertebang_field) ? number_format($ari_transfer->ha_tertebang_field,2) : "-"; ?>
                                                                <?php if(isset($ari_transfer->ha_tertebang_field)){?>

                                                                <?php } ?>
                                                            </td>
                                                            <td><?php echo isset($sum_transfer->sum_ha_digiiling) ? number_format($sum_transfer->sum_ha_digiiling,2) : "-"; ?></td>
                                                            <td><?php echo isset($ari_transfer->netto) ? number_format($ari_transfer->netto) : "-"; ?>
                                                                <?php if(isset($ari_transfer->netto)){?>

                                                                <?php } ?>
                                                            </td>
                                                            <td><?php echo isset($sum_transfer->sum_qty_digiling) ? number_format($sum_transfer->sum_qty_digiling,2) : "-"; ?></td>
                                                            <td><?php echo isset($ari_transfer->hablur) ? number_format($ari_transfer->hablur) : "-"; ?>
                                                                <?php if(isset($ari_transfer->hablur)){?>

                                                                <?php } ?>
                                                            </td>
                                                            <td><?php echo isset($sum_transfer->sum_qty_kristal) ? number_format($sum_transfer->sum_qty_kristal,2) : "-  "; ?></td>
                                                            <td><?php echo isset($ari_transfer->rendemen_total) ? number_format($ari_transfer->rendemen_total,2) : "-"; ?>
                                                                <?php if(isset($ari_transfer->rendemen_total)){?>

                                                                <?php } ?>
                                                            </td>
                                                            <td><?php echo isset($sum_transfer->total_rendemen) ? number_format($sum_transfer->total_rendemen,2) : "-"; ?></td>
                                                            <td><?php echo isset($ari_transfer->gula_ptr) ? number_format($ari_transfer->gula_ptr) : "-"; ?>
                                                                <?php if(isset($ari_transfer->gula_ptr)){?>

                                                                <?php } ?>
                                                            </td>
                                                            <td><?php echo isset($sum_transfer->sum_qty_gula_ptr) ? number_format($sum_transfer->sum_qty_gula_ptr,2) : "-"; ?></td>
                                                            <td><?php echo isset($ari_transfer->tetes_ptr) ? number_format($ari_transfer->tetes_ptr) : "-"; ?>
                                                                <?php if(isset($ari_transfer->tetes_ptr)){?>

                                                                <?php } ?>
                                                            </td>
                                                            <td><?php echo isset($sum_transfer->sum_qty_tetes_ptr) ? number_format($sum_transfer->sum_qty_tetes_ptr,2) : "-"; ?></td>
                                                        </tr>
                                                    <?php }?>
                                                <?php }?>
                                            <?php } ?>
                                            <tr style="background-color: #9d9d9d">
                                                <td><strong>TOTAL TS</strong></td>
                                                <td><strong><?php echo number_format($total_ha_ditebang_ts, 4); ?></strong></td>
                                                <td><strong><?php echo number_format($sd_total_ha_ditebang_ts, 4); ?></strong></td>
                                                <td><strong><?php echo number_format($total_qty_ditebang_ts);?></strong></td>
                                                <td><strong><?php echo number_format($sd_total_qty_ditebang_ts);?></strong></td>
                                                <td><strong><?php echo number_format($total_ha_digiling_ts, 4); ?></strong></td>
                                                <td><strong><?php echo number_format($sd_total_ha_digiling_ts, 4); ?></strong></td>
                                                <td><strong><?php echo number_format($total_qty_digiling_ts); ?></strong></td>
                                                <td><strong><?php echo number_format($sd_total_qty_digiling_ts); ?></strong></td>
                                                <td><strong><?php echo number_format($total_hablur_ts); ?></strong></td>
                                                <td><strong><?php echo number_format($sd_total_hablur_ts); ?></strong></td>
                                                <td><strong><?php echo @number_format(($total_hablur_ts/$total_qty_digiling_ts)*100,2); ?></strong></td>
                                                <td><strong><?php echo @number_format(($sd_total_hablur_ts/$sd_total_qty_digiling_ts)*100,2); ?></strong></td>
                                                <td><strong><?php echo number_format($total_gula_ptr_ts); ?></strong></td>
                                                <td><strong><?php echo number_format($sd_total_gula_ptr_ts); ?></strong></td>
                                                <td><strong><?php echo number_format($total_tetes_ptr_ts); ?></strong></td>
                                                <td><strong><?php echo number_format($sd_total_tetes_ptr_ts); ?></strong></td>
                                            </tr>
                                            <?php
                                            $total_ha_ditebang_tr = 0;
                                            $total_qty_ditebang_tr = 0;
                                            $total_ha_digiling_tr = 0;
                                            $total_qty_digiling_tr = 0;
                                            $total_hablur_tr = 0;
                                            $total_gula_ptr_tr = 0;
                                            $total_tetes_ptr_tr = 0;

                                            $sd_total_ha_ditebang_tr = 0;
                                            $sd_total_qty_ditebang_tr = 0;
                                            $sd_total_ha_digiling_tr = 0;
                                            $sd_total_qty_digiling_tr = 0;
                                            $sd_total_hablur_tr = 0;
                                            $sd_total_gula_ptr_tr = 0;
                                            $sd_total_tetes_ptr_tr = 0;
                                            ?>
                                            <?php foreach ($kode_kat_tr as $tdat_tr){ ?>
                                                <?php
                                                $data_lap_timb_tr = $ci->lapproduksimodel->VwByKategoriByTimbangan($tdat_tr->kode_kat_ptp, $hari_giling);
                                                $data_lap_ari_tr = $ci->lapproduksimodel->VwByKategoriByAri($tdat_tr->kode_kat_ptp, $hari_giling);
                                                $sum_lap_tr = $ci->lapproduksimodel->SumLap($tdat_tr->kode_kat_ptp, $hari_giling);
                                                ?>
                                                <tr>
                                                    <td><?php echo $tdat_tr->kode_kat_ptp;?>

                                                    </td>
                                                    <td>
                                                        <?php echo isset($data_lap_timb_tr->ha_tertebang_selektor) ? number_format($data_lap_timb_tr->ha_tertebang_selektor, 4) : "-"; ?>
                                                        <?php if(isset($data_lap_timb_tr->ha_tertebang_selektor)){ ?>

                                                            <?php $total_ha_ditebang_tr += $data_lap_timb_tr->ha_tertebang_field;} ?>
                                                    </td>
                                                    <td><?php echo number_format($sum_lap_tr->sum_ha_tertebang,2); ?></td>
                                                    <?php $sd_total_ha_ditebang_tr += $sum_lap_tr->sum_ha_tertebang; ?>
                                                    <td>
                                                        <?php echo isset($data_lap_timb_tr->netto) ? number_format($data_lap_timb_tr->netto) : "-"; ?>
                                                        <?php if(isset($data_lap_timb_tr->netto)){ ?>

                                                            <?php $total_qty_ditebang_tr += $data_lap_timb_tr->netto;} ?>
                                                    </td>
                                                    <td><?php echo number_format($sum_lap_tr->sum_qty_tertebang,2); ?></td>
                                                    <?php $sd_total_qty_ditebang_tr += $sum_lap_tr->sum_qty_tertebang;; ?>
                                                    <td>
                                                        <?php echo isset($data_lap_ari_tr->ha_tertebang_field) ? number_format($data_lap_ari_tr->ha_tertebang_field, 4) : "-"; ?>
                                                        <?php if(isset($data_lap_ari_tr->ha_tertebang_field)){ ?>

                                                            <?php  $total_ha_digiling_tr += $data_lap_ari_tr->ha_tertebang_field;} ?>
                                                    </td>
                                                    <td><?php echo number_format($sum_lap_tr->sum_ha_digiiling,2); ?></td>
                                                    <?php  $sd_total_ha_digiling_tr += $sum_lap_tr->sum_ha_digiiling; ?>
                                                    <td>
                                                        <?php echo isset($data_lap_ari_tr->netto) ? number_format($data_lap_ari_tr->netto) : "-"; ?>
                                                        <?php if(isset($data_lap_ari_tr->netto)){ ?>

                                                            <?php $total_qty_digiling_tr += $data_lap_ari_tr->netto;} ?>
                                                    </td>
                                                    <td><?php echo number_format($sum_lap_tr->sum_qty_digiling,2); ?></td>
                                                    <?php $sd_total_qty_digiling_tr += $sum_lap_tr->sum_qty_digiling; ?>
                                                    <td>
                                                        <?php echo isset($data_lap_ari_tr->hablur) ? number_format($data_lap_ari_tr->hablur) : "-"; ?>
                                                        <?php if(isset($data_lap_ari_tr->hablur)){ ?>

                                                            <?php $total_hablur_tr += $data_lap_ari_tr->hablur;} ?>
                                                    </td>
                                                    <td><?php echo number_format($sum_lap_tr->sum_qty_kristal,2); ?></td>
                                                    <?php $sd_total_hablur_tr += $sum_lap_tr->sum_qty_kristal; ?>
                                                    <td>
                                                        <?php echo isset($data_lap_ari_tr->rendemen_total) ? number_format($data_lap_ari_tr->rendemen_total,2) : "-"; ?>
                                                        <?php if(isset($data_lap_ari_tr->rendemen_total)){ ?>

                                                        <?php } ?>
                                                    </td>
                                                    <td><?php echo number_format($sum_lap_tr->total_rendemen,2); ?></td>
                                                    <td>
                                                        <?php echo isset($data_lap_ari_tr->gula_ptr) ? number_format($data_lap_ari_tr->gula_ptr) : "-"; ?>
                                                        <?php if(isset($data_lap_ari_tr->gula_ptr)){ ?>

                                                            <?php $total_gula_ptr_tr += $data_lap_ari_tr->gula_ptr;} ?>
                                                    </td>
                                                    <td><?php echo number_format($sum_lap_tr->sum_qty_gula_ptr,2); ?></td>
                                                    <?php $sd_total_gula_ptr_tr += $sum_lap_tr->sum_qty_gula_ptr; ?>
                                                    <td>
                                                        <?php echo isset($data_lap_ari_tr->tetes_ptr) ? number_format($data_lap_ari_tr->tetes_ptr) : "-"; ?>
                                                        <?php if(isset($data_lap_ari_tr->tetes_ptr)){ ?>

                                                            <?php $total_tetes_ptr_tr += $data_lap_ari_tr->tetes_ptr;} ?>
                                                    </td>
                                                    <td><?php echo number_format($sum_lap_tr->sum_qty_tetes_ptr,2); ?></td>
                                                    <?php $sd_total_tetes_ptr_tr += $sum_lap_tr->sum_qty_tetes_ptr; ?>
                                                </tr>

                                                <?php if($tdat_tr->kode_kat_ptp == "TR-TR"){?>
                                                    <?php
                                                    $data_group_plant = $ci->lapproduksimodel->GroupPlant($tdat_tr->kode_kat_ptp);
                                                    ?>
                                                    <?php foreach($data_group_plant as $row_plant) { ?>
                                                        <?php
                                                        $timb_transfer = $ci->lapproduksimodel->VwKategoriByTimbanganTransfer($tdat_tr->kode_kat_ptp, $row_plant->kode_plant_trasnfer, $hari_giling);
                                                        $ari_transfer = $ci->lapproduksimodel->VwKategoriByAriTransfer($tdat_tr->kode_kat_ptp, $row_plant->kode_plant_trasnfer, $hari_giling);
                                                        $sum_transfer = $ci->lapproduksimodel->SumLapTrans($tdat_tr->kode_kat_ptp, $row_plant->kode_plant_trasnfer, $hari_giling);
                                                        ?>
                                                        <tr>
                                                            <td> -- <?php echo $row_plant->nama_plant." (".$row_plant->kode_plant_trasnfer.")"; ?></td>

                                                            <td><?php echo isset($timb_transfer->ha_tertebang_selektor) ? $timb_transfer->ha_tertebang_selektor : "-"; ?>

                                                            </td>
                                                            <td><?php echo isset($sum_transfer->sum_ha_tertebang) ? number_format($sum_transfer->sum_ha_tertebang,2) : "-"; ?></td>
                                                            <td><?php echo isset($timb_transfer->netto) ? number_format($timb_transfer->netto) : "-"; ?>

                                                            </td>
                                                            <td><?php echo isset($sum_transfer->sum_qty_tertebang) ? number_format($sum_transfer->sum_qty_tertebang,2) : "-"; ?></td>
                                                            <td><?php echo isset($ari_transfer->ha_tertebang_field) ? $ari_transfer->ha_tertebang_field : "-"; ?>

                                                            </td>
                                                            <td><?php echo isset($sum_transfer->sum_ha_digiiling) ? number_format($sum_transfer->sum_ha_digiiling,2) : "-"; ?></td>
                                                            <td><?php echo isset($ari_transfer->netto) ? number_format($ari_transfer->netto) : "-"; ?>

                                                            </td>
                                                            <td><?php echo isset($sum_transfer->sum_qty_digiling) ? number_format($sum_transfer->sum_qty_digiling,2) : "-"; ?></td>
                                                            <td><?php echo isset($ari_transfer->hablur) ? number_format($ari_transfer->hablur) : "-"; ?>

                                                            </td>
                                                            <td><?php echo isset($sum_transfer->sum_qty_kristal) ? number_format($sum_transfer->sum_qty_kristal,2) : "-"; ?></td>
                                                            <td><?php echo isset($ari_transfer->rendemen_total) ? number_format($ari_transfer->rendemen_total,2) : "-"; ?>

                                                            </td>
                                                            <td><?php echo isset($sum_transfer->total_rendemen) ? number_format($sum_transfer->total_rendemen,2) : "-"; ?></td>
                                                            <td><?php echo isset($ari_transfer->gula_ptr) ? number_format($ari_transfer->gula_ptr) : "-"; ?>

                                                            </td>
                                                            <td><?php echo isset($sum_transfer->sum_qty_gula_ptr) ? number_format($sum_transfer->sum_qty_gula_ptr,2) : "-"; ?></td>
                                                            <td><?php echo isset($ari_transfer->tetes_ptr) ? number_format($ari_transfer->tetes_ptr) : "-"; ?>

                                                            </td>
                                                            <td><?php echo isset($sum_transfer->sum_qty_tetes_ptr) ? number_format($sum_transfer->sum_qty_tetes_ptr,2) : "-"; ?></td>
                                                        </tr>
                                                    <?php }?>
                                                <?php } ?>

                                                <?php if($tdat_tr->kode_kat_ptp == "TR-TK"){?>
                                                    <?php
                                                    $data_group_plant = $ci->lapproduksimodel->GroupPlant($tdat_tr->kode_kat_ptp);
                                                    ?>
                                                    <?php foreach($data_group_plant as $row_plant) { ?>
                                                        <?php
                                                        $timb_transfer = $ci->lapproduksimodel->VwKategoriByTimbanganTransfer($tdat_tr->kode_kat_ptp, $row_plant->kode_plant_trasnfer, $hari_giling);
                                                        $ari_transfer = $ci->lapproduksimodel->VwKategoriByAriTransfer($tdat_tr->kode_kat_ptp, $row_plant->kode_plant_trasnfer, $hari_giling);
                                                        $sum_transfer = $ci->lapproduksimodel->SumLapTrans($tdat_tr->kode_kat_ptp, $row_plant->kode_plant_trasnfer, $hari_giling);
                                                        ?>
                                                        <tr>
                                                            <td> -- <?php echo $row_plant->nama_plant." (".$row_plant->kode_plant_trasnfer.")"; ?></td>

                                                            <td><?php echo isset($timb_transfer->ha_tertebang_selektor) ? number_format($timb_transfer->ha_tertebang_selektor) : "-"; ?>

                                                            </td>
                                                            <td><?php echo isset($sum_transfer->sum_ha_tertebang) ? number_format($sum_transfer->sum_ha_tertebang,2) : "-"; ?></td>
                                                            <td><?php echo isset($timb_transfer->netto) ? number_format($timb_transfer->netto) : "-"; ?>

                                                            </td>
                                                            <td><?php echo isset($sum_transfer->sum_qty_tertebang) ? number_format($sum_transfer->sum_qty_tertebang,2) : "-"; ?></td>
                                                            <td><?php echo isset($ari_transfer->ha_tertebang_field) ? number_format($ari_transfer->ha_tertebang_field,2) : "-"; ?>

                                                            </td>
                                                            <td><?php echo isset($sum_transfer->sum_ha_digiiling) ? number_format($sum_transfer->sum_ha_digiiling,2) : "-"; ?></td>
                                                            <td><?php echo isset($ari_transfer->netto) ? number_format($ari_transfer->netto) : "-"; ?>

                                                            </td>
                                                            <td><?php echo isset($sum_transfer->sum_qty_digiling) ? number_format($sum_transfer->sum_qty_digiling,2) : "-"; ?></td>
                                                            <td><?php echo isset($ari_transfer->hablur) ? number_format($ari_transfer->hablur) : "-"; ?>

                                                            </td>
                                                            <td><?php echo isset($sum_transfer->sum_qty_kristal) ? number_format($sum_transfer->sum_qty_kristal,2) : "-"; ?></td>
                                                            <td><?php echo isset($ari_transfer->rendemen_total) ? number_format($ari_transfer->rendemen_total,2) : "-"; ?>

                                                            </td>
                                                            <td><?php echo isset($sum_transfer->total_rendemen) ? number_format($sum_transfer->total_rendemen,2) : "-"; ?></td>
                                                            <td><?php echo isset($ari_transfer->gula_ptr) ? number_format($ari_transfer->gula_ptr) : "-"; ?>

                                                            </td>
                                                            <td><?php echo isset($sum_transfer->sum_qty_gula_ptr) ? number_format($sum_transfer->sum_qty_gula_ptr,2) : "-"; ?></td>
                                                            <td><?php echo isset($ari_transfer->tetes_ptr) ? number_format($ari_transfer->tetes_ptr) : "-"; ?>

                                                            </td>
                                                            <td><?php echo isset($sum_transfer->sum_qty_tetes_ptr) ? number_format($sum_transfer->sum_qty_tetes_ptr,2) : "-"; ?></td>
                                                        </tr>
                                                    <?php }?>
                                                <?php }?>

                                                <?php if($tdat_tr->kode_kat_ptp == "TR-TM"){?>
                                                    <?php
                                                    $data_group_plant = $ci->lapproduksimodel->GroupPlant($tdat_tr->kode_kat_ptp);
                                                    ?>
                                                    <?php foreach($data_group_plant as $row_plant) { ?>
                                                        <?php
                                                        $timb_transfer = $ci->lapproduksimodel->VwKategoriByTimbanganTransfer($tdat_tr->kode_kat_ptp, $row_plant->kode_plant_trasnfer, $hari_giling);
                                                        $ari_transfer = $ci->lapproduksimodel->VwKategoriByAriTransfer($tdat_tr->kode_kat_ptp, $row_plant->kode_plant_trasnfer, $hari_giling);
                                                        $sum_transfer = $ci->lapproduksimodel->SumLapTrans($tdat_tr->kode_kat_ptp, $row_plant->kode_plant_trasnfer, $hari_giling);
                                                        ?>
                                                        <tr>
                                                            <td> -- <?php echo $row_plant->nama_plant." (".$row_plant->kode_plant_trasnfer.")"; ?></td>

                                                            <td><?php echo isset($timb_transfer->ha_tertebang_selektor) ? $timb_transfer->ha_tertebang_selektor : "-"; ?>

                                                            </td>
                                                            <td><?php echo isset($sum_transfer->sum_ha_tertebang) ? number_format($sum_transfer->sum_ha_tertebang,2) : "-"; ?></td>
                                                            <td><?php echo isset($timb_transfer->netto) ? number_format($timb_transfer->netto) : "-"; ?>

                                                            </td>
                                                            <td><?php echo isset($sum_transfer->sum_qty_tertebang) ? number_format($sum_transfer->sum_qty_tertebang,2) : "-"; ?></td>
                                                            <td><?php echo isset($ari_transfer->ha_tertebang_field) ? number_format($ari_transfer->ha_tertebang_field,2) : "-"; ?>

                                                            </td>
                                                            <td><?php echo isset($sum_transfer->sum_ha_digiiling) ? number_format($sum_transfer->sum_ha_digiiling,2) : "-"; ?></td>
                                                            <td><?php echo isset($ari_transfer->netto) ? number_format($ari_transfer->netto) : "-"; ?>

                                                            </td>
                                                            <td><?php echo isset($sum_transfer->sum_qty_digiling) ? number_format($sum_transfer->sum_qty_digiling,2) : "-"; ?></td>
                                                            <td><?php echo isset($ari_transfer->hablur) ? number_format($ari_transfer->hablur) : "-"; ?>

                                                            </td>
                                                            <td><?php echo isset($sum_transfer->sum_qty_kristal) ? number_format($sum_transfer->sum_qty_kristal,2) : "-"; ?></td>
                                                            <td><?php echo isset($ari_transfer->rendemen_total) ? number_format($ari_transfer->rendemen_total,2) : "-"; ?>

                                                            </td>
                                                            <td><?php echo isset($sum_transfer->total_rendemen) ? number_format($sum_transfer->total_rendemen,2) : "-"; ?></td>
                                                            <td><?php echo isset($ari_transfer->gula_ptr) ? number_format($ari_transfer->gula_ptr) : "-"; ?>

                                                            </td>
                                                            <td><?php echo isset($sum_transfer->sum_qty_gula_ptr) ? number_format($sum_transfer->sum_qty_gula_ptr,2) : "-"; ?></td>
                                                            <td><?php echo isset($ari_transfer->tetes_ptr) ? number_format($ari_transfer->tetes_ptr) : "-"; ?>

                                                            </td>
                                                            <td><?php echo isset($sum_transfer->sum_qty_tetes_ptr) ? number_format($sum_transfer->sum_qty_tetes_ptr,2) : "-"; ?></td>
                                                        </tr>
                                                    <?php }?>
                                                <?php }?>

                                            <?php } ?>
                                            <tr style="background-color: #9d9d9d">
                                                <td><strong>TOTAL TR</strong></td>
                                                <td><strong><?php echo number_format($total_ha_ditebang_tr, 4); ?></strong></td>
                                                <td><strong><?php echo number_format($sd_total_ha_ditebang_tr, 4); ?></strong></td>
                                                <td><strong><?php echo number_format($total_qty_ditebang_tr); ?></strong></td>
                                                <td><strong><?php echo number_format($sd_total_qty_ditebang_tr); ?></strong></td>
                                                <td><strong><?php echo number_format($total_ha_digiling_tr, 4); ?></strong></td>
                                                <td><strong><?php echo number_format($sd_total_ha_digiling_tr, 4); ?></strong></td>
                                                <td><strong><?php echo number_format($total_qty_digiling_tr); ?></strong></td>
                                                <td><strong><?php echo number_format($sd_total_qty_digiling_tr); ?></strong></td>
                                                <td><strong><?php echo number_format($total_hablur_tr); ?></strong></td>
                                                <td><strong><?php echo number_format($sd_total_hablur_tr); ?></strong></td>
                                                <td><strong><?php echo @number_format(($total_hablur_tr/$total_qty_digiling_tr)*100,2); ?></strong></td>
                                                <td><strong><?php echo @number_format(($sd_total_hablur_tr/$sd_total_qty_digiling_tr)*100,2); ?></strong></td>
                                                <td><strong><?php echo number_format($total_gula_ptr_tr); ?></strong></td>
                                                <td><strong><?php echo number_format($sd_total_gula_ptr_tr); ?></strong></td>
                                                <td><strong><?php echo number_format($total_tetes_ptr_tr); ?></strong></td>
                                                <td><strong><?php echo number_format($sd_total_tetes_ptr_tr); ?></strong></td>
                                            </tr>
                                            </tbody>
                                        </table>
                                        <div style="clear:both"></div>
                                    </div>

                                    <div style="clear:both"></div>
                                    <hr>

                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>