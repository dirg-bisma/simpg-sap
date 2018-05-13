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
                                    <?php
                                    function replaceKat($kat){
                                        $result = str_replace(" ", "_", $kat);
                                        $output = str_replace("-", "_", $result);
                                        return $output;
                                    }
                                    ?>
                                    <table class="tableizer-table">
                                        <thead>
                                        <tr style="background-color: #104E8B" class="tableizer-firstrow">
                                            <th style="text-align: center" rowspan="2">KATEGORI</th>
                                            <th style="text-align: center" colspan="2">HA TERTEBANG</th>
                                            <th style="text-align: center" colspan="2">QTY TERTEBANG</th>
                                            <th style="text-align: center" colspan="2">HA TERGILING</th>
                                            <th style="text-align: center" colspan="2">QTY TERGILING</th>
                                            <th style="text-align: center" colspan="2">QTY KRISTAL</th>
                                            <th style="text-align: center" colspan="2">RENDEMEN</th>
                                            <th style="text-align: center" colspan="2">QTY GULA PTR</th>
                                            <th style="text-align: center" colspan="2">QTY TETES PTR</th>
                                        </tr>
                                        <tr style="background-color: #104E8B;" class="tableizer-firstrow">
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
                                        <tbody>
                                        <?php
                                        $total_ha_ditebang = 0;
                                        $total_qty_ditebang = 0;
                                        $total_ha_digiling = 0;
                                        $total_qty_digiling = 0;
                                        $total_hablur = 0;
                                        $total_gula_ptr = 0;
                                        $total_tetes_ptr = 0;

                                        $sd_total_ha_ditebang = 0;
                                        $sd_total_qty_ditebang = 0;
                                        $sd_total_ha_digiling = 0;
                                        $sd_total_qty_digiling = 0;
                                        $sd_total_hablur = 0;
                                        $sd_total_gula_ptr = 0;
                                        $sd_total_tetes_ptr = 0;

                                        ?>
                                        <?php foreach ($kode_kat_ts as $row_kode_kat){?>
                                            <?php if($row_kode_kat->kode_kat_ptp != "TS-SP" && $row_kode_kat->kode_kat_ptp != "TS-ST" && $row_kode_kat->kode_kat_ptp != "TS-TR"){?>
                                                <input type="hidden" name="kode_kat_lahan_<?php echo replaceKat($row_kode_kat->kode_kat_ptp);?>" value="<?php echo $row_kode_kat->kat_sap; ?>">
                                                <input type="hidden" name="kat_ptpn_<?php echo replaceKat($row_kode_kat->kode_kat_ptp);?>" value="<?php echo $row_kode_kat->kode_kat_ptp; ?>">
                                                <input type="hidden" name="kat_kepemilikan_<?php echo replaceKat($row_kode_kat->kode_kat_ptp);?>" value="TS">
                                                <tr>
                                                    <td><?php echo $row_kode_kat->kode_kat_ptp;?></td>
                                                    <!----------------------HI HA TERTEBANG----------------->
                                                    <?php $ha_tertebang = 0;?>
                                                    <?php foreach ($data_lap_timb as $row_lap_timb ){?>
                                                        <?php if($row_lap_timb->kat_ptp == $row_kode_kat->kode_kat_ptp ){?>
                                                            <td style="text-align: right"><?php echo number_format($row_lap_timb->ha_tertebang_selektor, 2); ?></td>
                                                            <input type="hidden" name="ha_tertebang_<?php echo replaceKat($row_kode_kat->kode_kat_ptp);?>" value="<?php echo $row_lap_timb->ha_tertebang_selektor; ?>">
                                                            <?php $total_ha_ditebang += $row_lap_timb->ha_tertebang_selektor;?>
                                                            <?php $ha_tertebang = 1; } ?>
                                                    <?php } ?>
                                                    <?php if($ha_tertebang == 0){ echo "<td style=\"text-align: right\">0.00</td>"; }?>
                                                    <!----------------------SD HA TERTEBANG------------------>
                                                    <?php $ha_tertebang_sd = 0;?>
                                                    <?php foreach ($sum_lap_hari as $row_lap_sum ){?>
                                                        <?php if($row_lap_sum->kat_ptpn == $row_kode_kat->kode_kat_ptp ){?>
                                                            <td style="text-align: right"><?php echo number_format($row_lap_sum->sum_ha_tertebang, 2); ?></td>
                                                            <?php $sd_total_ha_ditebang += $row_lap_sum->sum_ha_tertebang;?>
                                                            <?php $ha_tertebang_sd = 1; } ?>
                                                    <?php } ?>
                                                    <?php if($ha_tertebang_sd == 0){ echo "<td style=\"text-align: right\">0.00</td>"; }?>
                                                    <!----------------------HI QTY TERTEBANG----------------->
                                                    <?php $ha_tertebang = 0;?>
                                                    <?php foreach ($data_lap_timb as $row_lap_timb ){?>
                                                        <?php if($row_lap_timb->kat_ptp == $row_kode_kat->kode_kat_ptp ){?>
                                                            <td style="text-align: right"><?php echo number_format($row_lap_timb->netto, 2); ?></td>
                                                            <input type="hidden" name="qty_tertebang_<?php echo replaceKat($row_kode_kat->kode_kat_ptp);?>" value="<?php echo $row_lap_timb->netto; ?>">
                                                            <?php $total_qty_ditebang += $row_lap_timb->netto;?>
                                                            <?php $ha_tertebang = 1; } ?>
                                                    <?php } ?>
                                                    <?php if($ha_tertebang == 0){ echo "<td style=\"text-align: right\">0.00</td>"; }?>
                                                    <!----------------------SD QTY TERTEBANG------------------>
                                                    <?php $ha_tertebang_sd = 0;?>
                                                    <?php foreach ($sum_lap_hari as $row_lap_sum ){?>
                                                        <?php if($row_lap_sum->kat_ptpn == $row_kode_kat->kode_kat_ptp ){?>
                                                            <td style="text-align: right"><?php echo number_format($row_lap_sum->sum_qty_tertebang, 2); ?></td>
                                                            <?php $sd_total_ha_ditebang += $row_lap_sum->sum_ha_tertebang;?>
                                                            <?php $ha_tertebang_sd = 1; } ?>
                                                    <?php } ?>
                                                    <?php if($ha_tertebang_sd == 0){ echo "<td style=\"text-align: right\">0.00</td>"; }?>
                                                    <!-----------------------HI HA TERGILING--------------------->
                                                    <?php $ha_tergiling = 0;?>
                                                    <?php foreach ($data_lap_ari as $row_lap_ari ){?>
                                                        <?php if($row_lap_ari->kat_ptp == $row_kode_kat->kode_kat_ptp ){?>
                                                            <td style="text-align: right"><?php echo number_format($row_lap_ari->ha_tertebang_selektor,2); ?></td>
                                                            <input type="hidden" name="ha_digiling_<?php echo replaceKat($row_kode_kat->kode_kat_ptp);?>" value="<?php echo $row_lap_ari->ha_tertebang_selektor; ?>">
                                                            <?php $total_ha_digiling += $row_lap_ari->ha_tertebang_selektor;?>
                                                            <?php $ha_tergiling = 1; } ?>
                                                    <?php } ?>
                                                    <?php if($ha_tergiling == 0){ echo "<td style=\"text-align: right\">0.00</td>"; }?>
                                                    <!----------------------SD HA TERGILING------------------------>
                                                    <?php $ha_tergiling_sd = 0;?>
                                                    <?php foreach ($sum_lap_hari as $row_lap_sum ){?>
                                                        <?php if($row_lap_sum->kat_ptpn == $row_kode_kat->kode_kat_ptp ){?>
                                                            <td style="text-align: right"><?php echo number_format($row_lap_sum->sum_ha_digiiling,2 ); ?></td>
                                                            <?php $sd_total_ha_digiling += $row_lap_sum->sum_ha_digiiling;?>
                                                            <?php $ha_tergiling_sd = 1; } ?>
                                                    <?php } ?>
                                                    <?php if($ha_tergiling_sd == 0){ echo "<td style=\"text-align: right\">0.00</td>"; }?>
                                                    <!-----------------------HI QTY TERGILING--------------------->
                                                    <?php $qty_tergiling = 0;?>
                                                    <?php foreach ($data_lap_ari as $row_lap_ari ){?>
                                                        <?php if($row_lap_ari->kat_ptp == $row_kode_kat->kode_kat_ptp ){?>
                                                            <td style="text-align: right"><?php echo number_format($row_lap_ari->netto,2); ?></td>
                                                            <input type="hidden" name="qty_digiling_<?php echo replaceKat($row_kode_kat->kode_kat_ptp);?>" value="<?php echo $row_lap_ari->netto; ?>">
                                                            <?php $total_qty_digiling += $row_lap_ari->netto;?>
                                                            <?php $qty_tergiling = 1; } ?>
                                                    <?php } ?>
                                                    <?php if($qty_tergiling == 0){ echo "<td style=\"text-align: right\">0.00</td>"; }?>
                                                    <!----------------------SD QTY TERGILING------------------------>
                                                    <?php $qty_tergiling_sd = 0;?>
                                                    <?php foreach ($sum_lap_hari as $row_lap_sum ){?>
                                                        <?php if($row_lap_sum->kat_ptpn == $row_kode_kat->kode_kat_ptp ){?>
                                                            <td style="text-align: right"><?php echo number_format($row_lap_sum->sum_qty_digiling,2 ); ?></td>
                                                            <?php $sd_total_qty_digiling += $row_lap_sum->sum_qty_digiling;?>
                                                            <?php $qty_tergiling_sd = 1; } ?>
                                                    <?php } ?>
                                                    <?php if($qty_tergiling_sd == 0){ echo "<td style=\"text-align: right\">0.00</td>"; }?>
                                                    <!-----------------------HI QTY KRISTAL--------------------->
                                                    <?php $qty_tergiling = 0;?>
                                                    <?php foreach ($data_lap_ari as $row_lap_ari ){?>
                                                        <?php if($row_lap_ari->kat_ptp == $row_kode_kat->kode_kat_ptp ){?>
                                                            <td style="text-align: right"><?php echo number_format($row_lap_ari->hablur,2); ?></td>
                                                            <input type="hidden" name="qty_kristal_<?php echo replaceKat($row_kode_kat->kode_kat_ptp);?>" value="<?php echo $row_lap_ari->hablur; ?>">
                                                            <?php $total_hablur += $row_lap_ari->hablur; ?>
                                                            <?php $qty_tergiling = 1; } ?>
                                                    <?php } ?>
                                                    <?php if($qty_tergiling == 0){ echo "<td style=\"text-align: right\">0.00</td>"; }?>
                                                    <!----------------------SD QTY KRISTAL------------------------>
                                                    <?php $qty_tergiling_sd = 0;?>
                                                    <?php foreach ($sum_lap_hari as $row_lap_sum ){?>
                                                        <?php if($row_lap_sum->kat_ptpn == $row_kode_kat->kode_kat_ptp ){?>
                                                            <td style="text-align: right"><?php echo number_format($row_lap_sum->sum_qty_kristal,2 ); ?></td>
                                                            <?php $sd_total_hablur += $row_lap_sum->sum_qty_kristal; ?>
                                                            <?php $qty_tergiling_sd = 1; } ?>
                                                    <?php } ?>
                                                    <?php if($qty_tergiling_sd == 0){ echo "<td style=\"text-align: right\">0.00</td>"; }?>
                                                    <!-----------------------HI RENDEMEN--------------------->
                                                    <?php $qty_tergiling = 0;?>
                                                    <?php foreach ($data_lap_ari as $row_lap_ari ){?>
                                                        <?php if($row_lap_ari->kat_ptp == $row_kode_kat->kode_kat_ptp ){?>
                                                            <td style="text-align: right"><?php echo number_format($row_lap_ari->rendemen_total,2); ?></td>
                                                            <input type="hidden" name="rendemen_<?php echo replaceKat($row_kode_kat->kode_kat_ptp);?>" value="<?php echo $row_lap_ari->rendemen_total; ?>">
                                                            <?php $qty_tergiling = 1; } ?>
                                                    <?php } ?>
                                                    <?php if($qty_tergiling == 0){ echo "<td style=\"text-align: right\">0.00</td>"; }?>
                                                    <!----------------------SD RENDEMEN------------------------>
                                                    <?php $qty_tergiling_sd = 0;?>
                                                    <?php foreach ($sum_lap_hari as $row_lap_sum ){?>
                                                        <?php if($row_lap_sum->kat_ptpn == $row_kode_kat->kode_kat_ptp ){?>
                                                            <td style="text-align: right"><?php echo number_format($row_lap_sum->total_rendemen,2 ); ?></td>
                                                            <?php $qty_tergiling_sd = 1; } ?>
                                                    <?php } ?>
                                                    <?php if($qty_tergiling_sd == 0){ echo "<td style=\"text-align: right\">0.00</td>"; }?>
                                                    <!-----------------------HI QTY GULA PTR--------------------->
                                                    <?php $qty_tergiling = 0;?>
                                                    <?php foreach ($data_lap_ari as $row_lap_ari ){?>
                                                        <?php if($row_lap_ari->kat_ptp == $row_kode_kat->kode_kat_ptp ){?>
                                                            <td style="text-align: right"><?php echo number_format($row_lap_ari->gula_ptr,2); ?></td>
                                                            <input type="hidden" name="qty_gula_ptr_<?php echo replaceKat($row_kode_kat->kode_kat_ptp); ?>" value="<?php echo $row_lap_ari->gula_ptr; ?>">
                                                            <?php $total_gula_ptr  += $row_lap_ari->gula_ptr; ?>
                                                            <?php $qty_tergiling = 1; } ?>
                                                    <?php } ?>
                                                    <?php if($qty_tergiling == 0){ echo "<td style=\"text-align: right\">0.00</td>"; }?>
                                                    <!----------------------SD QTY GULA PTR------------------------>
                                                    <?php $qty_tergiling_sd = 0;?>
                                                    <?php foreach ($sum_lap_hari as $row_lap_sum ){?>
                                                        <?php if($row_lap_sum->kat_ptpn == $row_kode_kat->kode_kat_ptp ){?>
                                                            <td style="text-align: right"><?php echo number_format($row_lap_sum->sum_qty_gula_ptr,2 ); ?></td>
                                                            <?php $sd_total_gula_ptr += $row_lap_sum->sum_qty_gula_ptr;?>
                                                            <?php $qty_tergiling_sd = 1; } ?>
                                                    <?php } ?>
                                                    <?php if($qty_tergiling_sd == 0){ echo "<td style=\"text-align: right\">0.00</td>"; }?>
                                                    <!-----------------------HI QTY TETES PTR--------------------->
                                                    <?php $qty_tergiling = 0;?>
                                                    <?php foreach ($data_lap_ari as $row_lap_ari ){?>
                                                        <?php if($row_lap_ari->kat_ptp == $row_kode_kat->kode_kat_ptp ){?>
                                                            <td style="text-align: right"><?php echo number_format($row_lap_ari->tetes_ptr,2); ?></td>
                                                            <input type="hidden" name="qty_tetes_ptr_<?php echo replaceKat($row_kode_kat->kode_kat_ptp);?>" value="<?php echo $row_lap_ari->tetes_ptr; ?>">
                                                            <?php $total_tetes_ptr += $row_lap_ari->tetes_ptr; ?>
                                                            <?php $qty_tergiling = 1; } ?>
                                                    <?php } ?>
                                                    <?php if($qty_tergiling == 0){ echo "<td style=\"text-align: right\">0.00</td>"; }?>
                                                    <!----------------------SD QTY TETES PTR------------------------>
                                                    <?php $qty_tergiling_sd = 0;?>
                                                    <?php foreach ($sum_lap_hari as $row_lap_sum ){?>
                                                        <?php if($row_lap_sum->kat_ptpn == $row_kode_kat->kode_kat_ptp ){?>
                                                            <td style="text-align: right"><?php echo number_format($row_lap_sum->sum_qty_tetes_ptr,2 ); ?></td>
                                                            <?php $sd_total_tetes_ptr += $row_lap_sum->sum_qty_tetes_ptr; ?>
                                                            <?php $qty_tergiling_sd = 1; } ?>
                                                    <?php } ?>
                                                    <?php if($qty_tergiling_sd == 0){ echo "<td style=\"text-align: right\">0.00</td>"; }?>
                                                </tr>
                                            <?php } ?>
                                        <?php } ?>



                                        <tr>
                                            <td style="text-align: center;background-color: #00c0ef" colspan="17">TS SAUDARA</td>
                                        </tr>
                                        <!--------------------------------------------------TS SAUDARA---------------------------------------------------->
                                        <?php foreach ($kode_kat_ts as $row_kode_kat){?>
                                            <?php if($row_kode_kat->kode_kat_ptp == "TS-TR"){?>
                                                <input type="hidden" name="kode_kat_lahan_<?php echo replaceKat($row_kode_kat->kode_kat_ptp);?>" value="<?php echo $row_kode_kat->kat_sap; ?>">
                                                <input type="hidden" name="kat_ptpn_<?php echo replaceKat($row_kode_kat->kode_kat_ptp);?>" value="<?php echo $row_kode_kat->kode_kat_ptp; ?>">
                                                <input type="hidden" name="kat_kepemilikan_<?php echo replaceKat($row_kode_kat->kode_kat_ptp);?>" value="TS">
                                                <tr>
                                                    <td><?php echo $row_kode_kat->kode_kat_ptp;?></td>
                                                    <!----------------------HI HA TERTEBANG----------------->
                                                    <?php $ha_tertebang = 0;?>
                                                    <?php foreach ($data_lap_timb as $row_lap_timb ){?>
                                                        <?php if($row_lap_timb->kat_ptp == $row_kode_kat->kode_kat_ptp ){?>
                                                            <td style="text-align: right"><?php echo number_format($row_lap_timb->ha_tertebang_selektor, 2); ?></td>
                                                            <input type="hidden" name="ha_tertebang_<?php echo replaceKat($row_kode_kat->kode_kat_ptp);?>" value="<?php echo $row_lap_timb->ha_tertebang_selektor; ?>">
                                                            <?php $total_ha_ditebang += $row_lap_timb->ha_tertebang_selektor;?>
                                                            <?php $ha_tertebang = 1; } ?>
                                                    <?php } ?>
                                                    <?php if($ha_tertebang == 0){ echo "<td style=\"text-align: right\">0.00</td>"; }?>
                                                    <!----------------------SD HA TERTEBANG------------------>
                                                    <?php $ha_tertebang_sd = 0;?>
                                                    <?php foreach ($sum_lap_hari as $row_lap_sum ){?>
                                                        <?php if($row_lap_sum->kat_ptpn == $row_kode_kat->kode_kat_ptp ){?>
                                                            <td style="text-align: right"><?php echo number_format($row_lap_sum->sum_ha_tertebang, 2); ?></td>
                                                            <?php $sd_total_ha_ditebang += $row_lap_sum->sum_ha_tertebang;?>
                                                            <?php $ha_tertebang_sd = 1; } ?>
                                                    <?php } ?>
                                                    <?php if($ha_tertebang_sd == 0){ echo "<td style=\"text-align: right\">0.00</td>"; }?>
                                                    <!----------------------HI QTY TERTEBANG----------------->
                                                    <?php $ha_tertebang = 0;?>
                                                    <?php foreach ($data_lap_timb as $row_lap_timb ){?>
                                                        <?php if($row_lap_timb->kat_ptp == $row_kode_kat->kode_kat_ptp ){?>
                                                            <td style="text-align: right"><?php echo number_format($row_lap_timb->netto, 2); ?></td>
                                                            <input type="hidden" name="qty_tertebang_<?php echo replaceKat($row_kode_kat->kode_kat_ptp);?>" value="<?php echo $row_lap_timb->netto; ?>">
                                                            <?php $total_qty_ditebang += $row_lap_timb->netto;?>
                                                            <?php $ha_tertebang = 1; } ?>
                                                    <?php } ?>
                                                    <?php if($ha_tertebang == 0){ echo "<td style=\"text-align: right\">0.00</td>"; }?>
                                                    <!----------------------SD QTY TERTEBANG------------------>
                                                    <?php $ha_tertebang_sd = 0;?>
                                                    <?php foreach ($sum_lap_hari as $row_lap_sum ){?>
                                                        <?php if($row_lap_sum->kat_ptpn == $row_kode_kat->kode_kat_ptp ){?>
                                                            <td style="text-align: right"><?php echo number_format($row_lap_sum->sum_qty_tertebang, 2); ?></td>
                                                            <?php $sd_total_ha_ditebang += $row_lap_sum->sum_ha_tertebang;?>
                                                            <?php $ha_tertebang_sd = 1; } ?>
                                                    <?php } ?>
                                                    <?php if($ha_tertebang_sd == 0){ echo "<td style=\"text-align: right\">0.00</td>"; }?>
                                                    <!-----------------------HI HA TERGILING--------------------->
                                                    <?php $ha_tergiling = 0;?>
                                                    <?php foreach ($data_lap_ari as $row_lap_ari ){?>
                                                        <?php if($row_lap_ari->kat_ptp == $row_kode_kat->kode_kat_ptp ){?>
                                                            <td style="text-align: right"><?php echo number_format($row_lap_ari->ha_tertebang_selektor,2); ?></td>
                                                            <input type="hidden" name="ha_digiling_<?php echo replaceKat($row_kode_kat->kode_kat_ptp);?>" value="<?php echo $row_lap_ari->ha_tertebang_selektor; ?>">
                                                            <?php $total_ha_digiling += $row_lap_ari->ha_tertebang_selektor;?>
                                                            <?php $ha_tergiling = 1; } ?>
                                                    <?php } ?>
                                                    <?php if($ha_tergiling == 0){ echo "<td style=\"text-align: right\">0.00</td>"; }?>
                                                    <!----------------------SD HA TERGILING------------------------>
                                                    <?php $ha_tergiling_sd = 0;?>
                                                    <?php foreach ($sum_lap_hari as $row_lap_sum ){?>
                                                        <?php if($row_lap_sum->kat_ptpn == $row_kode_kat->kode_kat_ptp ){?>
                                                            <td style="text-align: right"><?php echo number_format($row_lap_sum->sum_ha_digiiling,2 ); ?></td>
                                                            <?php $sd_total_ha_digiling += $row_lap_sum->sum_ha_digiiling;?>
                                                            <?php $ha_tergiling_sd = 1; } ?>
                                                    <?php } ?>
                                                    <?php if($ha_tergiling_sd == 0){ echo "<td style=\"text-align: right\">0.00</td>"; }?>
                                                    <!-----------------------HI QTY TERGILING--------------------->
                                                    <?php $qty_tergiling = 0;?>
                                                    <?php foreach ($data_lap_ari as $row_lap_ari ){?>
                                                        <?php if($row_lap_ari->kat_ptp == $row_kode_kat->kode_kat_ptp ){?>
                                                            <td style="text-align: right"><?php echo number_format($row_lap_ari->netto,2); ?></td>
                                                            <input type="hidden" name="qty_digiling_<?php echo replaceKat($row_kode_kat->kode_kat_ptp);?>" value="<?php echo $row_lap_ari->netto; ?>">
                                                            <?php $total_qty_digiling += $row_lap_ari->netto;?>
                                                            <?php $qty_tergiling = 1; } ?>
                                                    <?php } ?>
                                                    <?php if($qty_tergiling == 0){ echo "<td style=\"text-align: right\">0.00</td>"; }?>
                                                    <!----------------------SD QTY TERGILING------------------------>
                                                    <?php $qty_tergiling_sd = 0;?>
                                                    <?php foreach ($sum_lap_hari as $row_lap_sum ){?>
                                                        <?php if($row_lap_sum->kat_ptpn == $row_kode_kat->kode_kat_ptp ){?>
                                                            <td style="text-align: right"><?php echo number_format($row_lap_sum->sum_qty_digiling,2 ); ?></td>
                                                            <?php $sd_total_qty_digiling += $row_lap_sum->sum_qty_digiling;?>
                                                            <?php $qty_tergiling_sd = 1; } ?>
                                                    <?php } ?>
                                                    <?php if($qty_tergiling_sd == 0){ echo "<td style=\"text-align: right\">0.00</td>"; }?>
                                                    <!-----------------------HI QTY KRISTAL--------------------->
                                                    <?php $qty_tergiling = 0;?>
                                                    <?php foreach ($data_lap_ari as $row_lap_ari ){?>
                                                        <?php if($row_lap_ari->kat_ptp == $row_kode_kat->kode_kat_ptp ){?>
                                                            <td style="text-align: right"><?php echo number_format($row_lap_ari->hablur,2); ?></td>
                                                            <input type="hidden" name="qty_kristal_<?php echo replaceKat($row_kode_kat->kode_kat_ptp);?>" value="<?php echo $row_lap_ari->hablur; ?>">
                                                            <?php $total_hablur += $row_lap_ari->hablur; ?>
                                                            <?php $qty_tergiling = 1; } ?>
                                                    <?php } ?>
                                                    <?php if($qty_tergiling == 0){ echo "<td style=\"text-align: right\">0.00</td>"; }?>
                                                    <!----------------------SD QTY KRISTAL------------------------>
                                                    <?php $qty_tergiling_sd = 0;?>
                                                    <?php foreach ($sum_lap_hari as $row_lap_sum ){?>
                                                        <?php if($row_lap_sum->kat_ptpn == $row_kode_kat->kode_kat_ptp ){?>
                                                            <td style="text-align: right"><?php echo number_format($row_lap_sum->sum_qty_kristal,2 ); ?></td>
                                                            <?php $sd_total_hablur += $row_lap_sum->sum_qty_kristal; ?>
                                                            <?php $qty_tergiling_sd = 1; } ?>
                                                    <?php } ?>
                                                    <?php if($qty_tergiling_sd == 0){ echo "<td style=\"text-align: right\">0.00</td>"; }?>
                                                    <!-----------------------HI RENDEMEN--------------------->
                                                    <?php $qty_tergiling = 0;?>
                                                    <?php foreach ($data_lap_ari as $row_lap_ari ){?>
                                                        <?php if($row_lap_ari->kat_ptp == $row_kode_kat->kode_kat_ptp ){?>
                                                            <td style="text-align: right"><?php echo number_format($row_lap_ari->rendemen_total,2); ?></td>
                                                            <input type="hidden" name="rendemen_<?php echo replaceKat($row_kode_kat->kode_kat_ptp);?>" value="<?php echo $row_lap_ari->rendemen_total; ?>">
                                                            <?php $qty_tergiling = 1; } ?>
                                                    <?php } ?>
                                                    <?php if($qty_tergiling == 0){ echo "<td style=\"text-align: right\">0.00</td>"; }?>
                                                    <!----------------------SD RENDEMEN------------------------>
                                                    <?php $qty_tergiling_sd = 0;?>
                                                    <?php foreach ($sum_lap_hari as $row_lap_sum ){?>
                                                        <?php if($row_lap_sum->kat_ptpn == $row_kode_kat->kode_kat_ptp ){?>
                                                            <td style="text-align: right"><?php echo number_format($row_lap_sum->total_rendemen,2 ); ?></td>
                                                            <?php $qty_tergiling_sd = 1; } ?>
                                                    <?php } ?>
                                                    <?php if($qty_tergiling_sd == 0){ echo "<td style=\"text-align: right\">0.00</td>"; }?>
                                                    <!-----------------------HI QTY GULA PTR--------------------->
                                                    <?php $qty_tergiling = 0;?>
                                                    <?php foreach ($data_lap_ari as $row_lap_ari ){?>
                                                        <?php if($row_lap_ari->kat_ptp == $row_kode_kat->kode_kat_ptp ){?>
                                                            <td style="text-align: right"><?php echo number_format($row_lap_ari->gula_ptr,2); ?></td>
                                                            <input type="hidden" name="qty_gula_ptr_<?php echo replaceKat($row_kode_kat->kode_kat_ptp); ?>" value="<?php echo $row_lap_ari->gula_ptr; ?>">
                                                            <?php $total_gula_ptr  += $row_lap_ari->gula_ptr; ?>
                                                            <?php $qty_tergiling = 1; } ?>
                                                    <?php } ?>
                                                    <?php if($qty_tergiling == 0){ echo "<td style=\"text-align: right\">0.00</td>"; }?>
                                                    <!----------------------SD QTY GULA PTR------------------------>
                                                    <?php $qty_tergiling_sd = 0;?>
                                                    <?php foreach ($sum_lap_hari as $row_lap_sum ){?>
                                                        <?php if($row_lap_sum->kat_ptpn == $row_kode_kat->kode_kat_ptp ){?>
                                                            <td style="text-align: right"><?php echo number_format($row_lap_sum->sum_qty_gula_ptr,2 ); ?></td>
                                                            <?php $sd_total_gula_ptr += $row_lap_sum->sum_qty_gula_ptr;?>
                                                            <?php $qty_tergiling_sd = 1; } ?>
                                                    <?php } ?>
                                                    <?php if($qty_tergiling_sd == 0){ echo "<td style=\"text-align: right\">0.00</td>"; }?>
                                                    <!-----------------------HI QTY TETES PTR--------------------->
                                                    <?php $qty_tergiling = 0;?>
                                                    <?php foreach ($data_lap_ari as $row_lap_ari ){?>
                                                        <?php if($row_lap_ari->kat_ptp == $row_kode_kat->kode_kat_ptp ){?>
                                                            <td style="text-align: right"><?php echo number_format($row_lap_ari->tetes_ptr,2); ?></td>
                                                            <input type="hidden" name="qty_tetes_ptr_<?php echo replaceKat($row_kode_kat->kode_kat_ptp);?>" value="<?php echo $row_lap_ari->tetes_ptr; ?>">
                                                            <?php $total_tetes_ptr += $row_lap_ari->tetes_ptr; ?>
                                                            <?php $qty_tergiling = 1; } ?>
                                                    <?php } ?>
                                                    <?php if($qty_tergiling == 0){ echo "<td style=\"text-align: right\">0.00</td>"; }?>
                                                    <!----------------------SD QTY TETES PTR------------------------>
                                                    <?php $qty_tergiling_sd = 0;?>
                                                    <?php foreach ($sum_lap_hari as $row_lap_sum ){?>
                                                        <?php if($row_lap_sum->kat_ptpn == $row_kode_kat->kode_kat_ptp ){?>
                                                            <td style="text-align: right"><?php echo number_format($row_lap_sum->sum_qty_tetes_ptr,2 ); ?></td>
                                                            <?php $sd_total_tetes_ptr += $row_lap_sum->sum_qty_tetes_ptr; ?>
                                                            <?php $qty_tergiling_sd = 1; } ?>
                                                    <?php } ?>
                                                    <?php if($qty_tergiling_sd == 0){ echo "<td style=\"text-align: right\">0.00</td>"; }?>
                                                </tr>
                                            <?php } ?>
                                        <?php } ?>

                                        <?php require_once "ts_tr.php"; ?>
                                        <?php require_once "spt.php"; ?>



                                        <tr style="background-color: #9d9d9d">
                                            <td>TOTAL TS</td>
                                            <td style="text-align: right"><?php echo number_format($total_ha_ditebang, 2); ?></td>
                                            <td style="text-align: right"><?php echo number_format($sd_total_ha_ditebang, 2); ?></td>
                                            <td style="text-align: right"><?php echo number_format($total_qty_ditebang,2); ?></td>
                                            <td style="text-align: right"><?php echo number_format($sd_total_qty_ditebang,2); ?></td>
                                            <td style="text-align: right"><?php echo number_format($total_ha_digiling,2);?></td>
                                            <td style="text-align: right"><?php echo number_format($sd_total_ha_digiling,2); ?></td>
                                            <td style="text-align: right"><?php echo number_format($total_qty_digiling,2); ?></td>
                                            <td style="text-align: right"><?php echo number_format($sd_total_qty_digiling,2); ?></td>
                                            <td style="text-align: right"><?php echo number_format($total_hablur,2); ?></td>
                                            <td style="text-align: right"><?php echo number_format($sd_total_hablur,2); ?></td>
                                            <td style="text-align: right"><?php echo @number_format(($total_hablur/$total_qty_digiling)*100,2); ?></td>
                                            <td style="text-align: right"><?php echo @number_format(($sd_total_hablur/$sd_total_qty_digiling)*100,2); ?></td>
                                            <td style="text-align: right"><?php echo number_format($total_gula_ptr,2); ?></td>
                                            <td style="text-align: right"><?php echo number_format($sd_total_gula_ptr,2); ?></td>
                                            <td style="text-align: right"><?php echo number_format($total_tetes_ptr,2);?></td>
                                            <td style="text-align: right"><?php echo number_format($sd_total_tetes_ptr,2);?></td>
                                        </tr>

                                        <?php
                                        $total_ha_ditebang = 0;
                                        $total_qty_ditebang = 0;
                                        $total_ha_digiling = 0;
                                        $total_qty_digiling = 0;
                                        $total_hablur = 0;
                                        $total_gula_ptr = 0;
                                        $total_tetes_ptr = 0;

                                        $sd_total_ha_ditebang = 0;
                                        $sd_total_qty_ditebang = 0;
                                        $sd_total_ha_digiling = 0;
                                        $sd_total_qty_digiling = 0;
                                        $sd_total_hablur = 0;
                                        $sd_total_gula_ptr = 0;
                                        $sd_total_tetes_ptr = 0;

                                        ?>
                                        <?php foreach ($kode_kat_tr as $row_kode_kat){?>
                                            <?php if($row_kode_kat->kode_kat_ptp != "TR-TK" && $row_kode_kat->kode_kat_ptp != "TR-TM"){?>
                                                <input type="hidden" name="kode_kat_lahan_<?php echo replaceKat($row_kode_kat->kode_kat_ptp);?>" value="<?php echo $row_kode_kat->kat_sap; ?>">
                                                <input type="hidden" name="kat_ptpn_<?php echo replaceKat($row_kode_kat->kode_kat_ptp);?>" value="<?php echo $row_kode_kat->kode_kat_ptp; ?>">
                                                <input type="hidden" name="kat_kepemilikan_<?php echo replaceKat($row_kode_kat->kode_kat_ptp);?>" value="TR">
                                                <tr>
                                                    <td><?php echo $row_kode_kat->kode_kat_ptp;?></td>
                                                    <!----------------------HI HA TERTEBANG----------------->
                                                    <?php $ha_tertebang = 0;?>
                                                    <?php foreach ($data_lap_timb as $row_lap_timb ){?>
                                                        <?php if($row_lap_timb->kat_ptp == $row_kode_kat->kode_kat_ptp ){?>
                                                            <td style="text-align: right"><?php echo number_format($row_lap_timb->ha_tertebang_selektor, 2); ?></td>
                                                            <input type="hidden" name="ha_tertebang_<?php echo replaceKat($row_kode_kat->kode_kat_ptp);?>" value="<?php echo $row_lap_timb->ha_tertebang_selektor; ?>">
                                                            <?php $total_ha_ditebang += $row_lap_timb->ha_tertebang_selektor;?>
                                                            <?php $ha_tertebang = 1; } ?>
                                                    <?php } ?>
                                                    <?php if($ha_tertebang == 0){ echo "<td style=\"text-align: right\">0.00</td>"; }?>
                                                    <!----------------------SD HA TERTEBANG------------------>
                                                    <?php $ha_tertebang_sd = 0;?>
                                                    <?php foreach ($sum_lap_hari as $row_lap_sum ){?>
                                                        <?php if($row_lap_sum->kat_ptpn == $row_kode_kat->kode_kat_ptp ){?>
                                                            <td style="text-align: right"><?php echo number_format($row_lap_sum->sum_ha_tertebang, 2); ?></td>
                                                            <?php $sd_total_ha_ditebang += $row_lap_sum->sum_ha_tertebang;?>
                                                            <?php $ha_tertebang_sd = 1; } ?>
                                                    <?php } ?>
                                                    <?php if($ha_tertebang_sd == 0){ echo "<td style=\"text-align: right\">0.00</td>"; }?>
                                                    <!----------------------HI QTY TERTEBANG----------------->
                                                    <?php $ha_tertebang = 0;?>
                                                    <?php foreach ($data_lap_timb as $row_lap_timb ){?>
                                                        <?php if($row_lap_timb->kat_ptp == $row_kode_kat->kode_kat_ptp ){?>
                                                            <td style="text-align: right"><?php echo number_format($row_lap_timb->netto, 2); ?></td>
                                                            <input type="hidden" name="qty_tertebang_<?php echo replaceKat($row_kode_kat->kode_kat_ptp);?>" value="<?php echo $row_lap_timb->netto; ?>">
                                                            <?php $total_qty_ditebang += $row_lap_timb->netto;?>
                                                            <?php $ha_tertebang = 1; } ?>
                                                    <?php } ?>
                                                    <?php if($ha_tertebang == 0){ echo "<td style=\"text-align: right\">0.00</td>"; }?>
                                                    <!----------------------SD QTY TERTEBANG------------------>
                                                    <?php $ha_tertebang_sd = 0;?>
                                                    <?php foreach ($sum_lap_hari as $row_lap_sum ){?>
                                                        <?php if($row_lap_sum->kat_ptpn == $row_kode_kat->kode_kat_ptp ){?>
                                                            <td style="text-align: right"><?php echo number_format($row_lap_sum->sum_qty_tertebang, 2); ?></td>
                                                            <?php $sd_total_ha_ditebang += $row_lap_sum->sum_ha_tertebang;?>
                                                            <?php $ha_tertebang_sd = 1; } ?>
                                                    <?php } ?>
                                                    <?php if($ha_tertebang_sd == 0){ echo "<td style=\"text-align: right\">0.00</td>"; }?>
                                                    <!-----------------------HI HA TERGILING--------------------->
                                                    <?php $ha_tergiling = 0;?>
                                                    <?php foreach ($data_lap_ari as $row_lap_ari ){?>
                                                        <?php if($row_lap_ari->kat_ptp == $row_kode_kat->kode_kat_ptp ){?>
                                                            <td style="text-align: right"><?php echo number_format($row_lap_ari->ha_tertebang_selektor,2); ?></td>
                                                            <input type="hidden" name="ha_digiling_<?php echo replaceKat($row_kode_kat->kode_kat_ptp);?>" value="<?php echo $row_lap_ari->ha_tertebang_selektor; ?>">
                                                            <?php $total_ha_digiling += $row_lap_ari->ha_tertebang_selektor;?>
                                                            <?php $ha_tergiling = 1; } ?>
                                                    <?php } ?>
                                                    <?php if($ha_tergiling == 0){ echo "<td style=\"text-align: right\">0.00</td>"; }?>
                                                    <!----------------------SD HA TERGILING------------------------>
                                                    <?php $ha_tergiling_sd = 0;?>
                                                    <?php foreach ($sum_lap_hari as $row_lap_sum ){?>
                                                        <?php if($row_lap_sum->kat_ptpn == $row_kode_kat->kode_kat_ptp ){?>
                                                            <td style="text-align: right"><?php echo number_format($row_lap_sum->sum_ha_digiiling,2 ); ?></td>
                                                            <?php $sd_total_ha_digiling += $row_lap_sum->sum_ha_digiiling;?>
                                                            <?php $ha_tergiling_sd = 1; } ?>
                                                    <?php } ?>
                                                    <?php if($ha_tergiling_sd == 0){ echo "<td style=\"text-align: right\">0.00</td>"; }?>
                                                    <!-----------------------HI QTY TERGILING--------------------->
                                                    <?php $qty_tergiling = 0;?>
                                                    <?php foreach ($data_lap_ari as $row_lap_ari ){?>
                                                        <?php if($row_lap_ari->kat_ptp == $row_kode_kat->kode_kat_ptp ){?>
                                                            <td style="text-align: right"><?php echo number_format($row_lap_ari->netto,2); ?></td>
                                                            <input type="hidden" name="qty_digiling_<?php echo replaceKat($row_kode_kat->kode_kat_ptp);?>" value="<?php echo $row_lap_ari->netto; ?>">
                                                            <?php $total_qty_digiling += $row_lap_ari->netto;?>
                                                            <?php $qty_tergiling = 1; } ?>
                                                    <?php } ?>
                                                    <?php if($qty_tergiling == 0){ echo "<td style=\"text-align: right\">0.00</td>"; }?>
                                                    <!----------------------SD QTY TERGILING------------------------>
                                                    <?php $qty_tergiling_sd = 0;?>
                                                    <?php foreach ($sum_lap_hari as $row_lap_sum ){?>
                                                        <?php if($row_lap_sum->kat_ptpn == $row_kode_kat->kode_kat_ptp ){?>
                                                            <td style="text-align: right"><?php echo number_format($row_lap_sum->sum_qty_digiling,2 ); ?></td>
                                                            <?php $sd_total_qty_digiling += $row_lap_sum->sum_qty_digiling;?>
                                                            <?php $qty_tergiling_sd = 1; } ?>
                                                    <?php } ?>
                                                    <?php if($qty_tergiling_sd == 0){ echo "<td style=\"text-align: right\">0.00</td>"; }?>
                                                    <!-----------------------HI QTY KRISTAL--------------------->
                                                    <?php $qty_tergiling = 0;?>
                                                    <?php foreach ($data_lap_ari as $row_lap_ari ){?>
                                                        <?php if($row_lap_ari->kat_ptp == $row_kode_kat->kode_kat_ptp ){?>
                                                            <td style="text-align: right"><?php echo number_format($row_lap_ari->hablur,2); ?></td>
                                                            <input type="hidden" name="qty_kristal_<?php echo replaceKat($row_kode_kat->kode_kat_ptp);?>" value="<?php echo $row_lap_ari->hablur; ?>">
                                                            <?php $total_hablur += $row_lap_ari->hablur; ?>
                                                            <?php $qty_tergiling = 1; } ?>
                                                    <?php } ?>
                                                    <?php if($qty_tergiling == 0){ echo "<td style=\"text-align: right\">0.00</td>"; }?>
                                                    <!----------------------SD QTY KRISTAL------------------------>
                                                    <?php $qty_tergiling_sd = 0;?>
                                                    <?php foreach ($sum_lap_hari as $row_lap_sum ){?>
                                                        <?php if($row_lap_sum->kat_ptpn == $row_kode_kat->kode_kat_ptp ){?>
                                                            <td style="text-align: right"><?php echo number_format($row_lap_sum->sum_qty_kristal,2 ); ?></td>
                                                            <?php $sd_total_hablur += $row_lap_sum->sum_qty_kristal; ?>
                                                            <?php $qty_tergiling_sd = 1; } ?>
                                                    <?php } ?>
                                                    <?php if($qty_tergiling_sd == 0){ echo "<td style=\"text-align: right\">0.00</td>"; }?>
                                                    <!-----------------------HI RENDEMEN--------------------->
                                                    <?php $qty_tergiling = 0;?>
                                                    <?php foreach ($data_lap_ari as $row_lap_ari ){?>
                                                        <?php if($row_lap_ari->kat_ptp == $row_kode_kat->kode_kat_ptp ){?>
                                                            <td style="text-align: right"><?php echo number_format($row_lap_ari->rendemen_total,2); ?></td>
                                                            <input type="hidden" name="rendemen_<?php echo replaceKat($row_kode_kat->kode_kat_ptp);?>" value="<?php echo $row_lap_ari->rendemen_total; ?>">
                                                            <?php $qty_tergiling = 1; } ?>
                                                    <?php } ?>
                                                    <?php if($qty_tergiling == 0){ echo "<td style=\"text-align: right\">0.00</td>"; }?>
                                                    <!----------------------SD RENDEMEN------------------------>
                                                    <?php $qty_tergiling_sd = 0;?>
                                                    <?php foreach ($sum_lap_hari as $row_lap_sum ){?>
                                                        <?php if($row_lap_sum->kat_ptpn == $row_kode_kat->kode_kat_ptp ){?>
                                                            <td style="text-align: right"><?php echo number_format($row_lap_sum->total_rendemen,2 ); ?></td>
                                                            <?php $qty_tergiling_sd = 1; } ?>
                                                    <?php } ?>
                                                    <?php if($qty_tergiling_sd == 0){ echo "<td style=\"text-align: right\">0.00</td>"; }?>
                                                    <!-----------------------HI QTY GULA PTR--------------------->
                                                    <?php $qty_tergiling = 0;?>
                                                    <?php foreach ($data_lap_ari as $row_lap_ari ){?>
                                                        <?php if($row_lap_ari->kat_ptp == $row_kode_kat->kode_kat_ptp ){?>
                                                            <td style="text-align: right"><?php echo number_format($row_lap_ari->gula_ptr,2); ?></td>
                                                            <input type="hidden" name="qty_gula_ptr_<?php echo replaceKat($row_kode_kat->kode_kat_ptp); ?>" value="<?php echo $row_lap_ari->gula_ptr; ?>">
                                                            <?php $total_gula_ptr  += $row_lap_ari->gula_ptr; ?>
                                                            <?php $qty_tergiling = 1; } ?>
                                                    <?php } ?>
                                                    <?php if($qty_tergiling == 0){ echo "<td style=\"text-align: right\">0.00</td>"; }?>
                                                    <!----------------------SD QTY GULA PTR------------------------>
                                                    <?php $qty_tergiling_sd = 0;?>
                                                    <?php foreach ($sum_lap_hari as $row_lap_sum ){?>
                                                        <?php if($row_lap_sum->kat_ptpn == $row_kode_kat->kode_kat_ptp ){?>
                                                            <td style="text-align: right"><?php echo number_format($row_lap_sum->sum_qty_gula_ptr,2 ); ?></td>
                                                            <?php $sd_total_gula_ptr += $row_lap_sum->sum_qty_gula_ptr;?>
                                                            <?php $qty_tergiling_sd = 1; } ?>
                                                    <?php } ?>
                                                    <?php if($qty_tergiling_sd == 0){ echo "<td style=\"text-align: right\">0.00</td>"; }?>
                                                    <!-----------------------HI QTY TETES PTR--------------------->
                                                    <?php $qty_tergiling = 0;?>
                                                    <?php foreach ($data_lap_ari as $row_lap_ari ){?>
                                                        <?php if($row_lap_ari->kat_ptp == $row_kode_kat->kode_kat_ptp ){?>
                                                            <td style="text-align: right"><?php echo number_format($row_lap_ari->tetes_ptr,2); ?></td>
                                                            <input type="hidden" name="qty_tetes_ptr_<?php echo replaceKat($row_kode_kat->kode_kat_ptp);?>" value="<?php echo $row_lap_ari->tetes_ptr; ?>">
                                                            <?php $total_tetes_ptr += $row_lap_ari->tetes_ptr; ?>
                                                            <?php $qty_tergiling = 1; } ?>
                                                    <?php } ?>
                                                    <?php if($qty_tergiling == 0){ echo "<td style=\"text-align: right\">0.00</td>"; }?>
                                                    <!----------------------SD QTY TETES PTR------------------------>
                                                    <?php $qty_tergiling_sd = 0;?>
                                                    <?php foreach ($sum_lap_hari as $row_lap_sum ){?>
                                                        <?php if($row_lap_sum->kat_ptpn == $row_kode_kat->kode_kat_ptp ){?>
                                                            <td style="text-align: right"><?php echo number_format($row_lap_sum->sum_qty_tetes_ptr,2 ); ?></td>
                                                            <?php $sd_total_tetes_ptr += $row_lap_sum->sum_qty_tetes_ptr; ?>
                                                            <?php $qty_tergiling_sd = 1; } ?>
                                                    <?php } ?>
                                                    <?php if($qty_tergiling_sd == 0){ echo "<td style=\"text-align: right\">0.00</td>"; }?>
                                                </tr>
                                            <?php } ?>
                                        <?php } ?>
                                        <tr>
                                            <td style="text-align: center;background-color: #00c0ef" colspan="17">TR SAUDARA</td>
                                        </tr>

                                        <?php require_once "tr_tk.php";?>
                                        <?php require_once "tr_tm.php";?>

                                        <tr style="background-color: #9d9d9d">
                                            <td>TOTAL TR</td>
                                            <td style="text-align: right"><?php echo number_format($total_ha_ditebang, 2); ?></td>
                                            <td style="text-align: right"><?php echo number_format($sd_total_ha_ditebang, 2); ?></td>
                                            <td style="text-align: right"><?php echo number_format($total_qty_ditebang,2); ?></td>
                                            <td style="text-align: right"><?php echo number_format($sd_total_qty_ditebang,2); ?></td>
                                            <td style="text-align: right"><?php echo number_format($total_ha_digiling,2);?></td>
                                            <td style="text-align: right"><?php echo number_format($sd_total_ha_digiling,2); ?></td>
                                            <td style="text-align: right"><?php echo number_format($total_qty_digiling,2); ?></td>
                                            <td style="text-align: right"><?php echo number_format($sd_total_qty_digiling,2); ?></td>
                                            <td style="text-align: right"><?php echo number_format($total_hablur,2); ?></td>
                                            <td style="text-align: right"><?php echo number_format($sd_total_hablur,2); ?></td>
                                            <td style="text-align: right"><?php echo @number_format(($total_hablur/$total_qty_digiling)*100,2); ?></td>
                                            <td style="text-align: right"><?php echo @number_format(($sd_total_hablur/$sd_total_qty_digiling)*100,2); ?></td>
                                            <td style="text-align: right"><?php echo number_format($total_gula_ptr,2); ?></td>
                                            <td style="text-align: right"><?php echo number_format($sd_total_gula_ptr,2); ?></td>
                                            <td style="text-align: right"><?php echo number_format($total_tetes_ptr,2);?></td>
                                            <td style="text-align: right"><?php echo number_format($sd_total_tetes_ptr,2);?></td>
                                        </tr>
                                        </tbody>
                                    </table>


                                    <div style="clear:both"></div>
                                </div>

                                <div style="clear:both"></div>
                                <hr>
                                <div class="col-md-12">
                                    <div class='form-horizontal'>
                                        <div class="col-md-12">
                                            <div class="form-group" >
                                                <div class="toolbar-line text-center">
                                                    <a target="_blank" href="<?php echo site_url("lapproduksi/exceldwonload?hari_giling=$hari_giling");?>" class="btn btn-success">EXCEL</a>
                                                    <button type="submit" class="btn btn-primary">POSTING</button>
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