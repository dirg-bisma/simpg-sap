<input type="hidden" name="kode_kat_lahan_<?php echo replaceKat($row_kode_kat->kode_kat_ptp);?>" value="<?php echo $row_kode_kat->kat_sap; ?>">
<input type="hidden" name="kat_ptpn_<?php echo replaceKat($row_kode_kat->kode_kat_ptp);?>" value="<?php echo $row_kode_kat->kode_kat_ptp; ?>">
<input type="hidden" name="kat_kepemilikan_<?php echo replaceKat($row_kode_kat->kode_kat_ptp);?>" value="<?php echo $jenis_lahan_tpl;?>">
<tr>
    <td><?php echo $row_kode_kat->kode_kat_ptp;?></td>
    <!----------------------HI HA TERTEBANG----------------->
    <?php $hi_nilai = 0;?>
    <?php $status = 0;?>
    <?php foreach ($data_lap_timb as $row_lap_timb ){?>
        <?php if($row_lap_timb->kat_ptp == $row_kode_kat->kode_kat_ptp ){?>
            <td style="text-align: right"><?php echo number_format($row_lap_timb->ha_tertebang_selektor, 2); ?></td>
            <input type="hidden" name="ha_tertebang_<?php echo replaceKat($row_kode_kat->kode_kat_ptp);?>" value="<?php echo $row_lap_timb->ha_tertebang_selektor; ?>">
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
            <input type="hidden" name="qty_tertebang_<?php echo replaceKat($row_kode_kat->kode_kat_ptp);?>" value="<?php echo $row_lap_timb->netto_kg; ?>">
            <?php $hi_nilai = $row_lap_timb->netto_kg;?>
            <?php $total_qty_ditebang += $row_lap_timb->netto_kg;?>
            <?php $status = 1; } ?>
    <?php } ?>
    <?php if($status == 0){ echo "<td style=\"text-align: right\">0.00</td>"; }?>
    <!----------------------SD QTY TERTEBANG------------------>
    <?php $status = 0;?>
    <?php foreach ($sum_lap_hari as $row_lap_sum ){?>
        <?php if($row_lap_sum->kat_ptpn == $row_kode_kat->kode_kat_ptp ){?>
            <td style="text-align: right"><?php echo number_format((($row_lap_sum->sum_qty_tertebang+$hi_nilai/1000)) , 2); ?></td>
            <?php $sd_total_ha_ditebang += $row_lap_sum->sum_ha_tertebang;?>
            <?php $status = 1; } ?>
    <?php } ?>
    <?php if($status == 0){ echo "<td style=\"text-align: right\">".number_format($hi_nilai/1000,2)."</td>"; }?>
    <!-----------------------HI HA TERGILING--------------------->
    <?php $hi_nilai = 0;?>
    <?php $status = 0;?>
    <?php foreach ($data_lap_ari as $row_lap_ari ){?>
        <?php if($row_lap_ari->kat_ptp == $row_kode_kat->kode_kat_ptp ){?>
            <td style="text-align: right"><?php echo number_format($row_lap_ari->ha_tertebang_selektor,2); ?></td>
            <input type="hidden" name="ha_digiling_<?php echo replaceKat($row_kode_kat->kode_kat_ptp);?>" value="<?php echo $row_lap_ari->ha_tertebang_selektor; ?>">
            <?php $hi_nilai = $row_lap_ari->ha_tertebang_selektor;?>
            <?php $total_ha_digiling += $row_lap_ari->ha_tertebang_selektor;?>
            <?php $status = 1; } ?>
    <?php } ?>
    <?php if($status == 0){ echo "<td style=\"text-align: right\">0.00</td>"; }?>
    <!----------------------SD HA TERGILING------------------------>
    <?php $status = 0;?>
    <?php foreach ($sum_lap_hari as $row_lap_sum ){?>
        <?php if($row_lap_sum->kat_ptpn == $row_kode_kat->kode_kat_ptp ){?>
            <td style="text-align: right"><?php echo number_format(($row_lap_sum->sum_ha_digiiling+$hi_nilai/1000),2 ); ?></td>
            <?php $sd_total_ha_digiling += $row_lap_sum->sum_ha_digiiling;?>
            <?php $status = 1; } ?>
    <?php } ?>
    <?php if($status == 0){ echo "<td style=\"text-align: right\">".number_format($hi_nilai/1000,2)."</td>"; }?>
    <!-----------------------HI QTY TERGILING--------------------->
    <?php $hi_nilai = 0;?>
    <?php $status = 0;?>
    <?php $hi_qty_tergiling = 0;?>
    <?php $hi_qty_tergiling_kg = 0;?>
    <?php foreach ($data_lap_ari as $row_lap_ari ){?>
        <?php if($row_lap_ari->kat_ptp == $row_kode_kat->kode_kat_ptp ){?>
            <td style="text-align: right"><?php echo number_format($row_lap_ari->netto,2); ?></td>
            <input type="hidden" name="qty_digiling_<?php echo replaceKat($row_kode_kat->kode_kat_ptp);?>" value="<?php echo $row_lap_ari->netto_kg; ?>">
            <?php $hi_nilai = $row_lap_ari->netto_kg;?>
            <?php $hi_qty_tergiling = $row_lap_ari->netto_kg;?>
            <?php $total_qty_digiling += $row_lap_ari->netto_kg;?>
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
            <td style="text-align: right"><?php echo number_format(($row_lap_sum->sum_qty_digiling+$hi_nilai/1000),2 ); ?></td>
            <?php $sd_qty_tergiling_sd = $row_lap_sum->sum_qty_digiling;?>
            <?php $sd_total_qty_digiling += $row_lap_sum->sum_qty_digiling;?>
            <?php $sd_total_qty_digiling_kg += $row_lap_sum->sum_qty_digiling;?>
            <?php $status = 1; } ?>
    <?php } ?>
    <?php if($status == 0){ echo "<td style=\"text-align: right\">".number_format($hi_nilai/1000,2)."</td>"; }?>
    <!-----------------------HI QTY KRISTAL--------------------->
    <?php $hi_nilai = 0;?>
    <?php $status = 0;?>
    <?php $hi_qty_kristal = 0;?>
    <?php $hi_qty_kristal_kg = 0;?>
    <?php foreach ($data_lap_ari as $row_lap_ari ){?>
        <?php if($row_lap_ari->kat_ptp == $row_kode_kat->kode_kat_ptp ){?>
            <td style="text-align: right"><?php echo number_format($row_lap_ari->hablur,2); ?></td>
            <input type="hidden" name="qty_kristal_<?php echo replaceKat($row_kode_kat->kode_kat_ptp);?>" value="<?php echo $row_lap_ari->hablur_kg; ?>">
            <?php $hi_nilai = $row_lap_ari->hablur_kg;?>
            <?php $hi_qty_kristal = $row_lap_ari->hablur_kg;?>
            <?php $total_hablur += $row_lap_ari->hablur_kg; ?>
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
            <td style="text-align: right"><?php echo number_format(($row_lap_sum->sum_qty_kristal+$hi_nilai/1000),2 ); ?></td>
            <?php $sd_total_hablur += $row_lap_sum->sum_qty_kristal; ?>
            <?php $sd_total_hablur_kg += $row_lap_sum->sum_qty_kristal; ?>
            <?php $sd_qty_kristal_sd = $row_lap_sum->sum_qty_kristal; ?>
            <?php $status = 1; } ?>
    <?php } ?>
    <?php if($status == 0){ echo "<td style=\"text-align: right\">".number_format($hi_nilai/1000,2)."</td>"; }?>
    <!-----------------------HI RENDEMEN--------------------->
    <?php $rendemen_hi = 0;?>
    <?php foreach ($data_lap_ari as $row_lap_ari ){?>
        <?php if($row_lap_ari->kat_ptp == $row_kode_kat->kode_kat_ptp ){?>
            <td style="text-align: right"><?php echo $row_lap_ari->rendemen_total; ?></td>
            <input type="hidden" name="rendemen_<?php echo replaceKat($row_kode_kat->kode_kat_ptp);?>" value="<?php echo $row_lap_ari->rendemen_total; ?>">
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
            <input type="hidden" name="qty_gula_ptr_<?php echo replaceKat($row_kode_kat->kode_kat_ptp); ?>" value="<?php echo $row_lap_ari->gula_ptr_kg; ?>">
            <?php $hi_nilai = $row_lap_ari->gula_ptr_kg;?>
            <?php $total_gula_ptr  += $row_lap_ari->gula_ptr_kg; ?>
            <?php $status = 1; } ?>
    <?php } ?>
    <?php if($status == 0){ echo "<td style=\"text-align: right\">0.00</td>"; }?>
    <!----------------------SD QTY GULA PTR------------------------>
    <?php $status = 0;?>
    <?php foreach ($sum_lap_hari as $row_lap_sum ){?>
        <?php if($row_lap_sum->kat_ptpn == $row_kode_kat->kode_kat_ptp ){?>
            <td style="text-align: right"><?php echo number_format($row_lap_sum->sum_qty_gula_ptr+$hi_nilai/1000,2 ); ?></td>
            <?php $sd_total_gula_ptr += $row_lap_sum->sum_qty_gula_ptr;?>
            <?php $status = 1; } ?>
    <?php } ?>
    <?php if($status == 0){ echo "<td style=\"text-align: right\">".number_format($hi_nilai/1000,2)."</td>"; }?>
    <!-----------------------HI QTY TETES PTR--------------------->
    <?php $hi_nilai = 0;?>
    <?php $status = 0;?>
    <?php foreach ($data_lap_ari as $row_lap_ari ){?>
        <?php if($row_lap_ari->kat_ptp == $row_kode_kat->kode_kat_ptp ){?>
            <td style="text-align: right"><?php echo number_format($row_lap_ari->tetes_ptr,2); ?></td>
            <input type="hidden" name="qty_tetes_ptr_<?php echo replaceKat($row_kode_kat->kode_kat_ptp);?>" value="<?php echo $row_lap_ari->tetes_ptr_kg; ?>">
            <?php $hi_nilai = $row_lap_ari->tetes_ptr_kg;?>
            <?php $total_tetes_ptr += $row_lap_ari->tetes_ptr_kg; ?>
            <?php $status = 1; } ?>
    <?php } ?>
    <?php if($status == 0){ echo "<td style=\"text-align: right\">0.00</td>"; }?>
    <!----------------------SD QTY TETES PTR------------------------>
    <?php $status = 0;?>
    <?php foreach ($sum_lap_hari as $row_lap_sum ){?>
        <?php if($row_lap_sum->kat_ptpn == $row_kode_kat->kode_kat_ptp ){?>
            <td style="text-align: right"><?php echo number_format(($row_lap_sum->sum_qty_tetes_ptr+$hi_nilai/1000),2 ); ?></td>
            <?php $sd_total_tetes_ptr += $row_lap_sum->sum_qty_tetes_ptr; ?>
            <?php $status = 1; } ?>
    <?php } ?>
    <?php if($status == 0){ echo "<td style=\"text-align: right\">".number_format($hi_nilai/1000,2)."</td>"; }?>
</tr>