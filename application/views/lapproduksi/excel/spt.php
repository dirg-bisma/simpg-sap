<tr>
    <td style="text-align: center;background-color: #00c0ef" colspan="17">SPT</td>
</tr>
<!--------------------------------------------------TS SPT-------------------------------------------------------->
<?php foreach ($kode_kat_ts as $row_kode_kat){?>
    <?php if($row_kode_kat->kode_kat_ptp == "TS-SP" || $row_kode_kat->kode_kat_ptp == "TS-ST"){?>
        <tr>
            <td><?php echo $row_kode_kat->kode_kat_ptp;?></td>
            <!----------------------HI HA TERTEBANG----------------->
            <?php $ha_tertebang = 0;?>
            <?php foreach ($data_lap_timb as $row_lap_timb ){?>
                <?php if($row_lap_timb->kat_ptp == $row_kode_kat->kode_kat_ptp ){?>
                    <td style="text-align: right"><?php echo number_format($row_lap_timb->ha_tertebang_selektor, 2); ?></td>

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