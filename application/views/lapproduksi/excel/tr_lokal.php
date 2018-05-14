<?php
$total_ha_ditebang = 0;
$total_qty_ditebang = 0;
$total_ha_digiling = 0;
$total_qty_digiling = 0;
$total_qty_digiling_kg = 0;
$total_hablur = 0;
$total_hablur_kg = 0;
$total_gula_ptr = 0;
$total_tetes_ptr = 0;

$sd_total_ha_ditebang = 0;
$sd_total_qty_ditebang = 0;
$sd_total_ha_digiling = 0;
$sd_total_qty_digiling = 0;
$sd_total_qty_digiling_kg = 0;
$sd_total_hablur = 0;
$sd_total_hablur_kg = 0;
$sd_total_gula_ptr = 0;
$sd_total_tetes_ptr = 0;
?>
<tr>
    <td style="text-align: center;background-color: #00c0ef" colspan="17">TR LOKAL</td>
</tr>
<?php foreach ($kode_kat_tr as $row_kode_kat){?>
    <?php if($row_kode_kat->kode_kat_ptp != "TR-TK" && $row_kode_kat->kode_kat_ptp != "TR-TM"){?>
        <tr>
            <td><?php echo $row_kode_kat->kode_kat_ptp;?></td>
            <!----------------------HI HA TERTEBANG----------------->
            <?php $hi_nilai = 0;?>
            <?php $status = 0;?>
            <?php foreach ($data_lap_timb as $row_lap_timb ){?>
                <?php if($row_lap_timb->kat_ptp == $row_kode_kat->kode_kat_ptp ){?>
                    <td style="text-align: right"><?php echo number_format($row_lap_timb->ha_tertebang_selektor, 2); ?></td>
                    <?php $hi_nilai = $row_lap_timb->ha_tertebang_selektor;?>
                    <?php $total_ha_ditebang += $row_lap_timb->ha_tertebang_selektor;?>
                    <?php $status = 1; } ?>
            <?php } ?>
            <?php if($status == 0){ echo "<td style=\"text-align: right\">0.00</td>"; }?>
            <!----------------------SD HA TERTEBANG------------------>
            <?php $status = 0;?>
            <?php foreach ($sum_lap_hari as $row_lap_sum ){?>
                <?php if($row_lap_sum->kat_ptpn == $row_kode_kat->kode_kat_ptp ){?>
                    <td style="text-align: right"><?php echo number_format(($row_lap_sum->sum_ha_tertebang+$hi_nilai), 2); ?></td>
                    <?php $sd_total_ha_ditebang += $row_lap_sum->sum_ha_tertebang;?>
                    <?php $status = 1; } ?>
            <?php } ?>
            <?php if($status == 0){ echo "<td style=\"text-align: right\">".number_format($hi_nilai,2)."</td>"; }?>
            <!----------------------HI QTY TERTEBANG----------------->
            <?php $hi_nilai = 0;?>
            <?php $status = 0;?>
            <?php foreach ($data_lap_timb as $row_lap_timb ){?>
                <?php if($row_lap_timb->kat_ptp == $row_kode_kat->kode_kat_ptp ){?>
                    <td style="text-align: right"><?php echo number_format($row_lap_timb->netto, 2); ?></td>
                    <?php $hi_nilai = $row_lap_timb->netto;?>
                    <?php $total_qty_ditebang += $row_lap_timb->netto;?>
                    <?php $status = 1; } ?>
            <?php } ?>
            <?php if($status == 0){ echo "<td style=\"text-align: right\">0.00</td>"; }?>
            <!----------------------SD QTY TERTEBANG------------------>
            <?php $status = 0;?>
            <?php foreach ($sum_lap_hari as $row_lap_sum ){?>
                <?php if($row_lap_sum->kat_ptpn == $row_kode_kat->kode_kat_ptp ){?>
                    <td style="text-align: right"><?php echo number_format(($row_lap_sum->sum_qty_tertebang+$hi_nilai) , 2); ?></td>
                    <?php $sd_total_ha_ditebang += $row_lap_sum->sum_ha_tertebang;?>
                    <?php $status = 1; } ?>
            <?php } ?>
            <?php if($status == 0){ echo "<td style=\"text-align: right\">".number_format($hi_nilai,2)."</td>"; }?>
            <!-----------------------HI HA TERGILING--------------------->
            <?php $hi_nilai = 0;?>
            <?php $status = 0;?>
            <?php foreach ($data_lap_ari as $row_lap_ari ){?>
                <?php if($row_lap_ari->kat_ptp == $row_kode_kat->kode_kat_ptp ){?>
                    <td style="text-align: right"><?php echo number_format($row_lap_ari->ha_tertebang_selektor,2); ?></td>
                    <?php $hi_nilai = $row_lap_ari->ha_tertebang_selektor;?>
                    <?php $total_ha_digiling += $row_lap_ari->ha_tertebang_selektor;?>
                    <?php $status = 1; } ?>
            <?php } ?>
            <?php if($status == 0){ echo "<td style=\"text-align: right\">0.00</td>"; }?>
            <!----------------------SD HA TERGILING------------------------>
            <?php $status = 0;?>
            <?php foreach ($sum_lap_hari as $row_lap_sum ){?>
                <?php if($row_lap_sum->kat_ptpn == $row_kode_kat->kode_kat_ptp ){?>
                    <td style="text-align: right"><?php echo number_format(($row_lap_sum->sum_ha_digiiling+$hi_nilai),2 ); ?></td>
                    <?php $sd_total_ha_digiling += $row_lap_sum->sum_ha_digiiling;?>
                    <?php $status = 1; } ?>
            <?php } ?>
            <?php if($status == 0){ echo "<td style=\"text-align: right\">".number_format($hi_nilai,2)."</td>"; }?>
            <!-----------------------HI QTY TERGILING--------------------->
            <?php $hi_nilai = 0;?>
            <?php $status = 0;?>
            <?php $hi_qty_tergiling = 0;?>
            <?php $hi_qty_tergiling_kg = 0;?>
            <?php foreach ($data_lap_ari as $row_lap_ari ){?>
                <?php if($row_lap_ari->kat_ptp == $row_kode_kat->kode_kat_ptp ){?>
                    <td style="text-align: right"><?php echo number_format($row_lap_ari->netto,2); ?></td>
                    <?php $hi_nilai = $row_lap_ari->netto;?>
                    <?php $hi_qty_tergiling = $row_lap_ari->netto;?>
                    <?php $total_qty_digiling += $row_lap_ari->netto;?>
                    <?php $total_qty_digiling_kg += $row_lap_ari->netto_kg;?>
                    <?php $status = 1; } ?>
            <?php } ?>
            <?php if($status == 0){ echo "<td style=\"text-align: right\">0.00</td>"; }?>
            <!----------------------SD QTY TERGILING------------------------>
            <?php $status = 0;?>
            <?php $sd_qty_tergiling_sd = 0;?>
            <?php $sd_qty_tergiling_sd_kg = 0;?>
            <?php foreach ($sum_lap_hari as $row_lap_sum ){?>
                <?php if($row_lap_sum->kat_ptpn == $row_kode_kat->kode_kat_ptp ){?>
                    <td style="text-align: right"><?php echo number_format($row_lap_sum->sum_qty_digiling+$hi_nilai,2 ); ?></td>
                    <?php $sd_qty_tergiling_sd = $row_lap_sum->sum_qty_digiling;?>
                    <?php $sd_total_qty_digiling += $row_lap_sum->sum_qty_digiling;?>
                    <?php $sd_total_qty_digiling_kg += $row_lap_sum->sum_qty_digiling_kg;?>
                    <?php $status = 1; } ?>
            <?php } ?>
            <?php if($status == 0){ echo "<td style=\"text-align: right\">".number_format($hi_nilai,2)."</td>"; }?>
            <!-----------------------HI QTY KRISTAL--------------------->
            <?php $hi_nilai = 0;?>
            <?php $status = 0;?>
            <?php $hi_qty_kristal = 0;?>
            <?php $hi_qty_kristal_kg = 0;?>
            <?php foreach ($data_lap_ari as $row_lap_ari ){?>
                <?php if($row_lap_ari->kat_ptp == $row_kode_kat->kode_kat_ptp ){?>
                    <td style="text-align: right"><?php echo number_format($row_lap_ari->hablur,2); ?></td>
                    <?php $hi_nilai = $row_lap_ari->hablur;?>
                    <?php $hi_qty_kristal = $row_lap_ari->hablur;?>
                    <?php $total_hablur += $row_lap_ari->hablur; ?>
                    <?php $total_hablur_kg += $row_lap_ari->hablur_kg; ?>
                    <?php $status = 1; } ?>
            <?php } ?>
            <?php if($status == 0){ echo "<td style=\"text-align: right\">0.00</td>"; }?>
            <!----------------------SD QTY KRISTAL------------------------>
            <?php $status = 0;?>
            <?php $sd_qty_kristal_sd = 0;?>
            <?php $sd_qty_kristal_sd_kg = 0;?>
            <?php foreach ($sum_lap_hari as $row_lap_sum ){?>
                <?php if($row_lap_sum->kat_ptpn == $row_kode_kat->kode_kat_ptp ){?>
                    <td style="text-align: right"><?php echo number_format($row_lap_sum->sum_qty_kristal+$hi_nilai,2 ); ?></td>
                    <?php $sd_total_hablur += $row_lap_sum->sum_qty_kristal; ?>
                    <?php $sd_total_hablur_kg += $row_lap_sum->sum_qty_kristal_kg; ?>
                    <?php $sd_qty_kristal_sd = $row_lap_sum->sum_qty_kristal; ?>
                    <?php $status = 1; } ?>
            <?php } ?>
            <?php if($status == 0){ echo "<td style=\"text-align: right\">".number_format($hi_nilai,2)."</td>"; }?>
            <!-----------------------HI RENDEMEN--------------------->
            <?php $rendemen_hi = 0;?>
            <?php foreach ($data_lap_ari as $row_lap_ari ){?>
                <?php if($row_lap_ari->kat_ptp == $row_kode_kat->kode_kat_ptp ){?>
                    <td style="text-align: right"><?php echo $row_lap_ari->rendemen_total; ?></td>
                    <?php $rendemen_hi = 1; } ?>
            <?php } ?>
            <?php if($rendemen_hi == 0){ echo "<td style=\"text-align: right\">0.00</td>"; }?>
            <!----------------------SD RENDEMEN------------------------>
            <?php $rendemen_sd = 0;?>
            <?php foreach ($sum_lap_hari as $row_lap_sum ){?>
                <?php if($row_lap_sum->kat_ptpn == $row_kode_kat->kode_kat_ptp ){?>
                    <?php if($sd_qty_kristal_sd_kg != 0){?>
                        <?php $rend_sd = (($sd_qty_kristal_sd_kg+$hi_qty_kristal_kg)/($sd_qty_tergiling_sd_kg+$hi_qty_tergiling_kg)*100);?>
                        <?php  echo "<td style=\"text-align: right\">".number_format((float)$rend_sd,2,'.','')."</td>"; ?>
                    <?php }else{ ?>
                        <?php  echo "<td style=\"text-align: right\">0.00</td>"; ?>
                    <?php } ?>
                    <?php $rendemen_sd = 1; } ?>
            <?php } ?>
            <?php if($rendemen_sd == 0){?>
                <?php if($hi_qty_tergiling_kg != 0){ ?>
                    <?php $hi_rend = $hi_qty_kristal_kg/$hi_qty_tergiling_kg*100;?>
                    <td style="text-align: right"><?php echo number_format((float)$hi_rend,2 ,'.',''); ?></td>
                <?php }else{ ?>
                    <td style="text-align: right">0.00</td>
                <?php }?>
            <?php } ?>
            <!-----------------------HI QTY GULA PTR--------------------->
            <?php $hi_nilai = 0;?>
            <?php $status = 0;?>
            <?php foreach ($data_lap_ari as $row_lap_ari ){?>
                <?php if($row_lap_ari->kat_ptp == $row_kode_kat->kode_kat_ptp ){?>
                    <td style="text-align: right"><?php echo number_format($row_lap_ari->gula_ptr,2); ?></td>
                    <?php $hi_nilai = $row_lap_ari->gula_ptr;?>
                    <?php $total_gula_ptr  += $row_lap_ari->gula_ptr; ?>
                    <?php $status = 1; } ?>
            <?php } ?>
            <?php if($status == 0){ echo "<td style=\"text-align: right\">0.00</td>"; }?>
            <!----------------------SD QTY GULA PTR------------------------>
            <?php $status = 0;?>
            <?php foreach ($sum_lap_hari as $row_lap_sum ){?>
                <?php if($row_lap_sum->kat_ptpn == $row_kode_kat->kode_kat_ptp ){?>
                    <td style="text-align: right"><?php echo number_format($row_lap_sum->sum_qty_gula_ptr+$hi_nilai,2 ); ?></td>
                    <?php $sd_total_gula_ptr += $row_lap_sum->sum_qty_gula_ptr;?>
                    <?php $status = 1; } ?>
            <?php } ?>
            <?php if($status == 0){ echo "<td style=\"text-align: right\">".number_format($hi_nilai,2)."</td>"; }?>
            <!-----------------------HI QTY TETES PTR--------------------->
            <?php $hi_nilai = 0;?>
            <?php $status = 0;?>
            <?php foreach ($data_lap_ari as $row_lap_ari ){?>
                <?php if($row_lap_ari->kat_ptp == $row_kode_kat->kode_kat_ptp ){?>
                    <td style="text-align: right"><?php echo number_format($row_lap_ari->tetes_ptr,2); ?></td>
                    <?php $hi_nilai = $row_lap_ari->tetes_ptr;?>
                    <?php $total_tetes_ptr += $row_lap_ari->tetes_ptr; ?>
                    <?php $status = 1; } ?>
            <?php } ?>
            <?php if($status == 0){ echo "<td style=\"text-align: right\">".number_format($hi_nilai,2)."</td>"; }?>
            <!----------------------SD QTY TETES PTR------------------------>
            <?php $status = 0;?>
            <?php foreach ($sum_lap_hari as $row_lap_sum ){?>
                <?php if($row_lap_sum->kat_ptpn == $row_kode_kat->kode_kat_ptp ){?>
                    <td style="text-align: right"><?php echo number_format($row_lap_sum->sum_qty_tetes_ptr+$hi_nilai,2 ); ?></td>
                    <?php $sd_total_tetes_ptr += $row_lap_sum->sum_qty_tetes_ptr; ?>
                    <?php $status = 1; } ?>
            <?php } ?>
            <?php if($status == 0){ echo "<td style=\"text-align: right\">".number_format($hi_nilai,2)."</td>"; }?>
        </tr>
    <?php } ?>
<?php } ?>

<tr style="background-color: #9d9d9d">
    <td>TOTAL TR LOKAL</td>
    <td style="text-align: right"><?php echo number_format($total_ha_ditebang, 2); ?></td>
    <td style="text-align: right"><?php echo $sd_total_ha_ditebang == 0 ? number_format($total_ha_ditebang, 2) : number_format($sd_total_ha_ditebang+$total_ha_ditebang, 2); ?></td>
    <td style="text-align: right"><?php echo number_format($total_qty_ditebang,2); ?></td>
    <td style="text-align: right"><?php echo $sd_total_qty_ditebang == 0 ? number_format($total_qty_ditebang, 2) : number_format($sd_total_qty_ditebang+$total_qty_ditebang,2); ?></td>
    <td style="text-align: right"><?php echo number_format($total_ha_digiling,2);?></td>
    <td style="text-align: right"><?php echo $sd_total_ha_digiling == 0 ? number_format($total_ha_digiling,2) : number_format($sd_total_ha_digiling+$total_ha_digiling,2); ?></td>
    <td style="text-align: right"><?php echo number_format($total_qty_digiling,2); ?></td>
    <td style="text-align: right"><?php echo $sd_total_qty_digiling == 0 ? number_format($total_qty_digiling, 2) : number_format($sd_total_qty_digiling+$total_qty_digiling,2); ?></td>
    <td style="text-align: right"><?php echo number_format($total_hablur,2); ?></td>
    <td style="text-align: right"><?php echo $sd_total_hablur == 0 ? number_format($total_hablur,2) : number_format($sd_total_hablur+$total_hablur,2); ?></td>
    <td style="text-align: right"><?php echo @number_format(($total_hablur_kg/$total_qty_digiling_kg)*100, 2, '.',''); ?></td>
    <?php $hablur_sd = $sd_total_hablur_kg+$total_hablur_kg; ?>
    <?php $digiling_sd = $sd_total_qty_digiling_kg+$total_qty_digiling_kg; ?>
    <td style="text-align: right"><?php echo @number_format(($hablur_sd/$digiling_sd)*100,2,'.',''); ?></td>
    <td style="text-align: right"><?php echo number_format($total_gula_ptr,2); ?></td>
    <td style="text-align: right"><?php echo $sd_total_gula_ptr == 0 ? number_format($total_gula_ptr,2) : number_format($sd_total_gula_ptr+$total_gula_ptr,2); ?></td>
    <td style="text-align: right"><?php echo number_format($total_tetes_ptr,2);?></td>
    <td style="text-align: right"><?php echo $sd_total_tetes_ptr == 0 ? number_format($total_tetes_ptr,2) : number_format($sd_total_tetes_ptr+$total_tetes_ptr,2);?></td>
</tr>
