<tr>
    <td style="text-align: center;background-color: #00c0ef" colspan="17">SPT</td>
</tr>
<!--------------------------------------------------TS SPT-------------------------------------------------------->
<?php foreach ($kode_kat_ts as $row_kode_kat){?>
    <?php if($row_kode_kat->kode_kat_ptp == "TS-SP" || $row_kode_kat->kode_kat_ptp == "TS-ST" ){?>
        <input type="hidden" name="kode_kat_lahan_<?php echo replaceKat($row_kode_kat->kode_kat_ptp);?>" value="<?php echo $row_kode_kat->kat_sap; ?>">
        <input type="hidden" name="kat_ptpn_<?php echo replaceKat($row_kode_kat->kode_kat_ptp);?>" value="<?php echo $row_kode_kat->kode_kat_ptp; ?>">
        <input type="hidden" name="kat_kepemilikan_<?php echo replaceKat($row_kode_kat->kode_kat_ptp);?>" value="TS">
        <tr>
            <td><?php echo $row_kode_kat->kode_kat_ptp;?></td>
            <?php $hi_nilai = 0;?>
            <!----------------------HI HA TERTEBANG----------------->
            <?php $ha_tertebang = 0;?>
            <?php foreach ($data_lap_timb as $row_lap_timb ){?>
                <?php if($row_lap_timb->kat_ptp == $row_kode_kat->kode_kat_ptp ){?>
                    <td style="text-align: right"><?php echo number_format($row_lap_timb->ha_tertebang_selektor, 2); ?></td>
                    <input type="hidden" name="ha_tertebang_<?php echo replaceKat($row_kode_kat->kode_kat_ptp);?>" value="<?php echo $row_lap_timb->ha_tertebang_selektor; ?>">
                    <?php $hi_nilai = $row_lap_timb->ha_tertebang_selektor;?>
                    <?php $total_ha_ditebang += $row_lap_timb->ha_tertebang_selektor;?>
                    <?php $total_ha_ditebang_trans += $row_lap_timb->ha_tertebang_selektor;?>
                    <?php $ha_tertebang = 1; } ?>
            <?php } ?>
            <?php if($ha_tertebang == 0){ echo "<td style=\"text-align: right\">0.00</td>"; }?>
            <!----------------------SD HA TERTEBANG------------------>
            <?php $ha_tertebang_sd = 0;?>
            <?php foreach ($sum_lap_hari as $row_lap_sum ){?>
                <?php if($row_lap_sum->kat_ptpn == $row_kode_kat->kode_kat_ptp ){?>
                    <td style="text-align: right"><?php echo number_format(($row_lap_sum->sum_ha_tertebang+$hi_nilai), 2); ?></td>
                    <?php $sd_total_ha_ditebang += $row_lap_sum->sum_ha_tertebang;?>
                    <?php $sd_total_ha_ditebang_trans += $row_lap_sum->sum_ha_tertebang;?>
                    <?php $ha_tertebang_sd = 1; } ?>
            <?php } ?>
            <?php if($ha_tertebang_sd == 0){ echo "<td style=\"text-align: right\">".number_format($hi_nilai,2)."</td>"; }?>
            <!----------------------HI QTY TERTEBANG----------------->
            <?php $ha_tertebang = 0;?>
            <?php foreach ($data_lap_timb as $row_lap_timb ){?>
                <?php if($row_lap_timb->kat_ptp == $row_kode_kat->kode_kat_ptp ){?>
                    <td style="text-align: right"><?php echo number_format($row_lap_timb->netto, 2); ?></td>
                    <input type="hidden" name="qty_tertebang_<?php echo replaceKat($row_kode_kat->kode_kat_ptp);?>" value="<?php echo $row_lap_timb->netto; ?>">
                    <?php $hi_nilai = $row_lap_timb->netto;?>
                    <?php $total_qty_ditebang += $row_lap_timb->netto;?>
                    <?php $total_qty_ditebang_trans += $row_lap_timb->netto;?>
                    <?php $ha_tertebang = 1; } ?>
            <?php } ?>
            <?php if($ha_tertebang == 0){ echo "<td style=\"text-align: right\">0.00</td>"; }?>
            <!----------------------SD QTY TERTEBANG------------------>
            <?php $ha_tertebang_sd = 0;?>
            <?php foreach ($sum_lap_hari as $row_lap_sum ){?>
                <?php if($row_lap_sum->kat_ptpn == $row_kode_kat->kode_kat_ptp ){?>
                    <td style="text-align: right"><?php echo number_format(($row_lap_sum->sum_qty_tertebang+$hi_nilai) , 2); ?></td>
                    <?php $sd_total_ha_ditebang += $row_lap_sum->sum_ha_tertebang;?>
                    <?php $sd_total_ha_ditebang_trans += $row_lap_sum->sum_ha_tertebang;?>
                    <?php $ha_tertebang_sd = 1; } ?>
            <?php } ?>
            <?php if($ha_tertebang_sd == 0){ echo "<td style=\"text-align: right\">".number_format($hi_nilai,2)."</td>"; }?>
            <!-----------------------HI HA TERGILING--------------------->
            <?php $ha_tergiling = 0;?>
            <?php foreach ($data_lap_ari as $row_lap_ari ){?>
                <?php if($row_lap_ari->kat_ptp == $row_kode_kat->kode_kat_ptp ){?>
                    <td style="text-align: right"><?php echo number_format($row_lap_ari->ha_tertebang_selektor,2); ?></td>
                    <input type="hidden" name="ha_digiling_<?php echo replaceKat($row_kode_kat->kode_kat_ptp);?>" value="<?php echo $row_lap_ari->ha_tertebang_selektor; ?>">
                    <?php $hi_nilai = $row_lap_ari->ha_tertebang_selektor;?>
                    <?php $total_ha_digiling += $row_lap_ari->ha_tertebang_selektor;?>
                    <?php $total_ha_digiling_trans += $row_lap_ari->ha_tertebang_selektor;?>
                    <?php $ha_tergiling = 1; } ?>
            <?php } ?>
            <?php if($ha_tergiling == 0){ echo "<td style=\"text-align: right\">0.00</td>"; }?>
            <!----------------------SD HA TERGILING------------------------>
            <?php $ha_tergiling_sd = 0;?>
            <?php foreach ($sum_lap_hari as $row_lap_sum ){?>
                <?php if($row_lap_sum->kat_ptpn == $row_kode_kat->kode_kat_ptp ){?>
                    <td style="text-align: right"><?php echo number_format(($row_lap_sum->sum_ha_digiiling+$hi_nilai),2 ); ?></td>
                    <?php $sd_total_ha_digiling += $row_lap_sum->sum_ha_digiiling;?>
                    <?php $sd_total_ha_digiling_trans += $row_lap_sum->sum_ha_digiiling;?>
                    <?php $ha_tergiling_sd = 1; } ?>
            <?php } ?>
            <?php if($ha_tergiling_sd == 0){ echo "<td style=\"text-align: right\">".number_format($hi_nilai,2)."</td>"; }?>
            <!-----------------------HI QTY TERGILING--------------------->
            <?php $qty_tergiling = 0;?>
            <?php $hi_qty_tergiling = 0;?>
            <?php foreach ($data_lap_ari as $row_lap_ari ){?>
                <?php if($row_lap_ari->kat_ptp == $row_kode_kat->kode_kat_ptp ){?>
                    <td style="text-align: right"><?php echo number_format($row_lap_ari->netto,2); ?></td>
                    <input type="hidden" name="qty_digiling_<?php echo replaceKat($row_kode_kat->kode_kat_ptp);?>" value="<?php echo $row_lap_ari->netto; ?>">
                    <?php $hi_nilai = $row_lap_ari->netto;?>
                    <?php $hi_qty_tergiling = $row_lap_ari->netto;?>
                    <?php $total_qty_digiling += $row_lap_ari->netto;?>
                    <?php $total_qty_digiling_trans += $row_lap_ari->netto;?>
                    <?php $qty_tergiling = 1; } ?>
            <?php } ?>
            <?php if($qty_tergiling == 0){ echo "<td style=\"text-align: right\">0.00</td>"; }?>
            <!----------------------SD QTY TERGILING------------------------>
            <?php $qty_tergiling_sd = 0;?>
            <?php $sd_qty_tergiling_sd = 0;?>
            <?php foreach ($sum_lap_hari as $row_lap_sum ){?>
                <?php if($row_lap_sum->kat_ptpn == $row_kode_kat->kode_kat_ptp ){?>
                    <td style="text-align: right"><?php echo number_format($row_lap_sum->sum_qty_digiling+$hi_nilai,2 ); ?></td>
                    <?php $sd_qty_tergiling_sd = $row_lap_sum->sum_qty_digiling;?>
                    <?php $sd_total_qty_digiling += $row_lap_sum->sum_qty_digiling;?>
                    <?php $sd_total_qty_digiling_trans += $row_lap_sum->sum_qty_digiling;?>
                    <?php $qty_tergiling_sd = 1; } ?>
            <?php } ?>
            <?php if($qty_tergiling_sd == 0){ echo "<td style=\"text-align: right\">".number_format($hi_nilai,2)."</td>"; }?>
            <!-----------------------HI QTY KRISTAL--------------------->
            <?php $qty_kristal = 0;?>
            <?php $hi_qty_kristal = 0;?>
            <?php foreach ($data_lap_ari as $row_lap_ari ){?>
                <?php if($row_lap_ari->kat_ptp == $row_kode_kat->kode_kat_ptp ){?>
                    <td style="text-align: right"><?php echo number_format($row_lap_ari->hablur,2); ?></td>
                    <input type="hidden" name="qty_kristal_<?php echo replaceKat($row_kode_kat->kode_kat_ptp);?>" value="<?php echo $row_lap_ari->hablur; ?>">
                    <?php $hi_nilai = $row_lap_ari->hablur;?>
                    <?php $hi_qty_kristal = $row_lap_ari->hablur;?>
                    <?php $total_hablur += $row_lap_ari->hablur; ?>
                    <?php $total_hablur_trans += $row_lap_ari->hablur; ?>
                    <?php $qty_kristal = 1; } ?>
            <?php } ?>
            <?php if($qty_kristal == 0){ echo "<td style=\"text-align: right\">0.00</td>"; }?>
            <!----------------------SD QTY KRISTAL------------------------>
            <?php $qty_kristal_sd = 0;?>
            <?php $sd_qty_kristal_sd = 0;?>
            <?php foreach ($sum_lap_hari as $row_lap_sum ){?>
                <?php if($row_lap_sum->kat_ptpn == $row_kode_kat->kode_kat_ptp ){?>
                    <td style="text-align: right"><?php echo number_format($row_lap_sum->sum_qty_kristal+$hi_nilai,2 ); ?></td>
                    <?php $sd_total_hablur += $row_lap_sum->sum_qty_kristal; ?>
                    <?php $sd_total_hablur_trans += $row_lap_sum->sum_qty_kristal; ?>
                    <?php $sd_qty_kristal_sd = $row_lap_sum->sum_qty_kristal; ?>
                    <?php $qty_kristal_sd = 1; } ?>
            <?php } ?>
            <?php if($qty_kristal_sd == 0){ echo "<td style=\"text-align: right\">".number_format($hi_nilai,2)."</td>"; }?>
            <!-----------------------HI RENDEMEN--------------------->
            <?php $rendemen_hi = 0;?>
            <?php foreach ($data_lap_ari as $row_lap_ari ){?>
                <?php if($row_lap_ari->kat_ptp == $row_kode_kat->kode_kat_ptp ){?>
                    <td style="text-align: right"><?php echo number_format($row_lap_ari->rendemen_total,2); ?></td>
                    <input type="hidden" name="rendemen_<?php echo replaceKat($row_kode_kat->kode_kat_ptp);?>" value="<?php echo $row_lap_ari->rendemen_total; ?>">
                    <?php $rendemen_hi = 1; } ?>
            <?php } ?>
            <?php if($rendemen_hi == 0){ echo "<td style=\"text-align: right\">0.00</td>"; }?>
            <!----------------------SD RENDEMEN------------------------>
            <?php $rendemen_sd = 0;?>
            <?php foreach ($sum_lap_hari as $row_lap_sum ){?>
                <?php if($row_lap_sum->kat_ptpn == $row_kode_kat->kode_kat_ptp ){?>
                    <?php if($sd_qty_kristal_sd != 0){?>
                        <?php $rend_sd = (($sd_qty_kristal_sd+$hi_qty_kristal)/($sd_qty_tergiling_sd+$hi_qty_tergiling)*100);?>
                        <?php  echo "<td style=\"text-align: right\">".number_format($rend_sd,2)."</td>"; ?>
                    <?php }else{ ?>
                        <?php  echo "<td style=\"text-align: right\">0.00</td>"; ?>
                    <?php } ?>
                    <?php $rendemen_sd = 1; } ?>
            <?php } ?>
            <?php if($rendemen_sd == 0){?>
                <?php if($hi_qty_tergiling != 0){ ?>
                    <?php $hi_rend = $hi_qty_kristal/$hi_qty_tergiling*100;?>
                    <td style="text-align: right"><?php echo number_format($hi_rend,2 ); ?></td>
                <?php }else{ ?>
                    <td style="text-align: right">0.00</td>
                <?php }?>
            <?php } ?>
            <!-----------------------HI QTY GULA PTR--------------------->
            <?php $qty_tergiling = 0;?>
            <?php foreach ($data_lap_ari as $row_lap_ari ){?>
                <?php if($row_lap_ari->kat_ptp == $row_kode_kat->kode_kat_ptp ){?>
                    <td style="text-align: right"><?php echo number_format($row_lap_ari->gula_ptr,2); ?></td>
                    <input type="hidden" name="qty_gula_ptr_<?php echo replaceKat($row_kode_kat->kode_kat_ptp); ?>" value="<?php echo $row_lap_ari->gula_ptr; ?>">
                    <?php $hi_nilai = $row_lap_ari->gula_ptr;?>
                    <?php $total_gula_ptr  += $row_lap_ari->gula_ptr; ?>
                    <?php $total_gula_ptr_trans  += $row_lap_ari->gula_ptr; ?>
                    <?php $qty_tergiling = 1; } ?>
            <?php } ?>
            <?php if($qty_tergiling == 0){ echo "<td style=\"text-align: right\">0.00</td>"; }?>
            <!----------------------SD QTY GULA PTR------------------------>
            <?php $qty_tergiling_sd = 0;?>
            <?php foreach ($sum_lap_hari as $row_lap_sum ){?>
                <?php if($row_lap_sum->kat_ptpn == $row_kode_kat->kode_kat_ptp ){?>
                    <td style="text-align: right"><?php echo number_format($row_lap_sum->sum_qty_gula_ptr,2 ); ?></td>
                    <?php $sd_total_gula_ptr += $row_lap_sum->sum_qty_gula_ptr;?>
                    <?php $sd_total_gula_ptr_trans += $row_lap_sum->sum_qty_gula_ptr;?>
                    <?php $qty_tergiling_sd = 1; } ?>
            <?php } ?>
            <?php if($qty_tergiling_sd == 0){ echo "<td style=\"text-align: right\">".number_format($hi_nilai,2)."</td>"; }?>
            <!-----------------------HI QTY TETES PTR--------------------->
            <?php $qty_tetes = 0;?>
            <?php foreach ($data_lap_ari as $row_lap_ari ){?>
                <?php if($row_lap_ari->kat_ptp == $row_kode_kat->kode_kat_ptp ){?>
                    <td style="text-align: right"><?php echo number_format($row_lap_ari->tetes_ptr,2); ?></td>
                    <input type="hidden" name="qty_tetes_ptr_<?php echo replaceKat($row_kode_kat->kode_kat_ptp);?>" value="<?php echo $row_lap_ari->tetes_ptr; ?>">
                    <?php $hi_nilai = $row_lap_ari->tetes_ptr;?>
                    <?php $total_tetes_ptr += $row_lap_ari->tetes_ptr; ?>
                    <?php $total_tetes_ptr_trans += $row_lap_ari->tetes_ptr; ?>
                    <?php $qty_tetes = 1; } ?>
            <?php } ?>
            <?php if($qty_tetes == 0){ echo "<td style=\"text-align: right\">".number_format($hi_nilai,2)."</td>"; }?>
            <!----------------------SD QTY TETES PTR------------------------>
            <?php $qty_tergiling_sd = 0;?>
            <?php foreach ($sum_lap_hari as $row_lap_sum ){?>
                <?php if($row_lap_sum->kat_ptpn == $row_kode_kat->kode_kat_ptp ){?>
                    <td style="text-align: right"><?php echo number_format($row_lap_sum->sum_qty_tetes_ptr,2 ); ?></td>
                    <?php $sd_total_tetes_ptr += $row_lap_sum->sum_qty_tetes_ptr; ?>
                    <?php $sd_total_tetes_ptr_trans += $row_lap_sum->sum_qty_tetes_ptr; ?>
                    <?php $qty_tergiling_sd = 1; } ?>
            <?php } ?>
            <?php if($qty_tergiling_sd == 0){ echo "<td style=\"text-align: right\">".number_format($hi_nilai,2)."</td>"; }?>
        </tr>
    <?php } ?>
<?php } ?>

