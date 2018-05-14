
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
    <td style="text-align: center;background-color: #00c0ef" colspan="17">TR SAUDARA</td>
</tr>
<?php foreach ($kode_kat_tr as $row_kode_kat){?>
    <?php if($row_kode_kat->kode_kat_ptp === "TR-TK"){?>
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
                    <input type="hidden" name="qty_tertebang_<?php echo replaceKat($row_kode_kat->kode_kat_ptp);?>" value="<?php echo $row_lap_timb->netto; ?>">
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
<!-----------------------------------------TR-TTK------------------------------------------------------>

<?php foreach($plant_trans as $row_trans){?>
    <tr>
        <td> -- <?php echo $row_trans->nama_plant." (".$row_trans->kode_plant_trasnfer.")"; ?></td>
        <?php $hi_nilai_trans = 0;?>
        <!------------------HI HA TERTEBANG TRANS----------------->
        <?php $status = 0; ?>
        <?php foreach ($timb_trans as $row_trans_timb ){?>
            <?php if("TR-TK" == $row_trans_timb->kat_ptp && $row_trans->kode_plant_trasnfer == $row_trans_timb->kode_plant_trasnfer){?>
                <td style="text-align: right"><?php echo number_format($row_trans_timb->ha_tertebang_selektor,2 ); ?></td>
                <input type="hidden" name="trans_ha_tertebang_<?php echo replaceKat($row_trans_timb->kat_ptp)."_".$row_trans->kode_plant_trasnfer;?>" value="<?php echo $row_trans_timb->ha_tertebang_selektor; ?>">
                <?php $hi_nilai_trans = $row_trans_timb->ha_tertebang_selektor;?>
                <?php $status = 1; } ?>
        <?php } ?>
        <?php if($status == 0){ echo "<td style=\"text-align: right\"> 0.00</td>"; }?>

        <!------------------SD HA TERTEBANG TRANS----------------->
        <?php $status = 0; ?>
        <?php foreach ($sum_trans as $row_trans_sd ){?>
            <?php if("TR-TK" == $row_trans_sd->kat_ptpn && $row_trans->kode_plant_trasnfer == $row_trans_sd->kode_plant_trasnfer){?>
                <td style="text-align: right"><?php echo number_format($row_trans_sd->sum_ha_tertebang,2 ); ?></td>
                <?php $status = 1; } ?>
        <?php } ?>
        <?php if($status == 0){ echo "<td style=\"text-align: right\">".number_format($hi_nilai_trans, 2)."</td>"; }?>

        <!------------------HI QTY TEREBANG TRANS----------------->
        <?php $status = 0; ?>
        <?php foreach ($timb_trans as $row_trans_timb ){?>
            <?php if("TR-TK" == $row_trans_timb->kat_ptp && $row_trans->kode_plant_trasnfer == $row_trans_timb->kode_plant_trasnfer){?>
                <td style="text-align: right"><?php echo number_format($row_trans_timb->netto,2 ); ?></td>
                <?php $hi_nilai_trans = $row_trans_timb->netto; ?>
                <?php $status = 1; } ?>
        <?php } ?>
        <?php if($status == 0){ echo "<td style=\"text-align: right\">0.00</td>"; }?>

        <!------------------SD QTY TERTEBANG TRANS----------------->
        <?php $status = 0; ?>
        <?php foreach ($sum_trans as $row_trans_sd ){?>
            <?php if("TR-TK" == $row_trans_sd->kat_ptpn && $row_trans->kode_plant_trasnfer == $row_trans_sd->kode_plant_trasnfer){?>
                <td style="text-align: right"><?php echo number_format($row_trans_sd->sum_qty_tertebang,2 ); ?></td>
                <?php $status = 1; } ?>
        <?php } ?>
        <?php if($status == 0){ echo "<td style=\"text-align: right\">".number_format($hi_nilai_trans, 2)."</td>"; }?>

        <!------------------HI HA TERGILING TRANS----------------->
        <?php $status = 0; ?>
        <?php foreach ($ari_trans as $row_trans_ari ){?>
            <?php if("TR-TK" == $row_trans_ari->kat_ptp && $row_trans->kode_plant_trasnfer == $row_trans_ari->kode_plant_trasnfer){?>
                <td style="text-align: right"><?php echo number_format($row_trans_ari->ha_tertebang_selektor,2 ); ?></td>
                <?php $hi_nilai_trans = $row_trans_ari->ha_tertebang_selektor; ?>
                <?php $status = 1; } ?>
        <?php } ?>
        <?php if($status == 0){ echo "<td style=\"text-align: right\">0.00</td>"; }?>

        <!------------------SD HA TERGILING TRANS----------------->
        <?php $status = 0; ?>
        <?php foreach ($sum_trans as $row_trans_sd ){?>
            <?php if("TR-TK" == $row_trans_sd->kat_ptpn && $row_trans->kode_plant_trasnfer == $row_trans_sd->kode_plant_trasnfer){?>
                <td style="text-align: right"><?php echo number_format($row_trans_sd->sum_ha_digiiling,2 ); ?></td>
                <?php $status = 1; } ?>
        <?php } ?>
        <?php if($status == 0){ echo "<td style=\"text-align: right\">".number_format($hi_nilai_trans, 2)."</td>"; }?>

        <!------------------HI QTY TERGILING TRANS----------------->
        <?php $status = 0; ?>
        <?php $hi_tergiling_trans = 0; ?>
        <?php foreach ($ari_trans as $row_trans_ari ){?>
            <?php if("TR-TK" == $row_trans_ari->kat_ptp && $row_trans->kode_plant_trasnfer == $row_trans_ari->kode_plant_trasnfer){?>
                <td style="text-align: right"><?php echo number_format($row_trans_ari->netto,2 ); ?></td>
                <?php $hi_nilai_trans = $row_trans_ari->netto; ?>
                <?php $hi_tergiling_trans = $row_trans_ari->netto; ?>
                <?php $status = 1; } ?>
        <?php } ?>
        <?php if($status == 0){ echo "<td style=\"text-align: right\">0.00</td>"; }?>
        <!------------------SD QTY TERGILING TRANS----------------->
        <?php $status = 0; ?>
        <?php $trans_qty_tergiling_sd = 0; ?>
        <?php foreach ($sum_trans as $row_trans_sd ){?>
            <?php if("TR-TK" == $row_trans_sd->kat_ptpn && $row_trans->kode_plant_trasnfer == $row_trans_sd->kode_plant_trasnfer){?>
                <td style="text-align: right"><?php echo number_format($row_trans_sd->sum_qty_digiling,2 ); ?></td>
                <?php $trans_qty_tergiling_sd = $row_trans_sd->sum_qty_digiling; ?>
                <?php $status = 1; } ?>
        <?php } ?>
        <?php if($status == 0){ echo "<td style=\"text-align: right\">".number_format($hi_nilai_trans, 2)."</td>"; }?>
        <!------------------HI QTY KRISTAL TRANS----------------->
        <?php $status = 0; ?>
        <?php $hi_qty_kristal = 0; ?>
        <?php foreach ($ari_trans as $row_trans_ari ){?>
            <?php if("TR-TK" == $row_trans_ari->kat_ptp && $row_trans->kode_plant_trasnfer == $row_trans_ari->kode_plant_trasnfer){?>
                <td style="text-align: right"><?php echo number_format($row_trans_ari->hablur,2 ); ?></td>
                <?php $hi_nilai_trans = $row_trans_ari->hablur; ?>
                <?php $hi_qty_kristal = $row_trans_ari->hablur; ?>
                <?php $status = 1; } ?>
        <?php } ?>
        <?php if($status == 0){ echo "<td style=\"text-align: right\">0.00</td>"; }?>
        <!------------------SD QTY KRISTAL TRANS----------------->
        <?php $status = 0; ?>
        <?php $trans_qty_kristal_sd = 0; ?>
        <?php foreach ($sum_trans as $row_trans_sd ){?>
            <?php if("TR-TK" == $row_trans_sd->kat_ptpn && $row_trans->kode_plant_trasnfer == $row_trans_sd->kode_plant_trasnfer){?>
                <td style="text-align: right"><?php echo number_format($row_trans_sd->sum_qty_kristal,2 ); ?></td>
                <?php $trans_qty_kristal_sd = $row_trans_sd->sum_qty_kristal; ?>
                <?php $status = 1; } ?>
        <?php } ?>
        <?php if($status == 0){ echo "<td style=\"text-align: right\">".number_format($hi_nilai_trans, 2)."</td>"; }?>
        <!------------------HI RENDEMEN TRANS----------------->
        <?php $qty_kristal_trans = 0; ?>
        <?php foreach ($ari_trans as $row_trans_ari ){?>
            <?php if("TR-TK" == $row_trans_ari->kat_ptp && $row_trans->kode_plant_trasnfer == $row_trans_ari->kode_plant_trasnfer){?>
                <?php $rendemen = ($row_trans_ari->hablur/$row_trans_ari->netto)*100;?>
                <td style="text-align: right"><?php echo number_format($rendemen,2 ); ?></td>
                <?php $qty_kristal_trans = 1; } ?>
        <?php } ?>
        <?php if($qty_kristal_trans == 0){ echo "<td style=\"text-align: right\">0.00</td>"; }?>
        <!------------------SD RENDEMEN TRANS----------------->
        <?php $_rend_trans_sd = 0; ?>
        <?php foreach ($sum_trans as $row_trans_sd ){?>
            <?php if("TR-TK" == $row_trans_sd->kat_ptpn && $row_trans->kode_plant_trasnfer == $row_trans_sd->kode_plant_trasnfer){?>
                <?php if($sd_qty_kristal_sd != 0){?>
                    <?php $rend_sd_trans = (($trans_qty_kristal_sd+$hi_qty_kristal)/($trans_qty_tergiling_sd+$hi_tergiling_trans)*100);?>
                    <td style="text-align: right"><?php echo number_format($rend_sd_trans,2 ); ?></td>
                    <?php $_rend_trans_sd = 1; } ?>
            <?php } ?>
        <?php } ?>
        <?php if($_rend_trans_sd == 0){?>
            <?php if($hi_tergiling_trans != 0){ ?>
                <?php $hi_rend = $hi_qty_kristal/$hi_tergiling_trans*100;?>
                <td style="text-align: right"><?php echo number_format($hi_rend,2 ); ?></td>
            <?php }else{ ?>
                <td style="text-align: right">0.00</td>
            <?php }?>
        <?php } ?>
        <!------------------HI GULA PTR TRANS----------------->
        <?php $status = 0; ?>
        <?php $hi_nilai_trans = 0; ?>
        <?php foreach ($ari_trans as $row_trans_ari ){?>
            <?php if("TR-TK" == $row_trans_ari->kat_ptp && $row_trans->kode_plant_trasnfer == $row_trans_ari->kode_plant_trasnfer){?>
                <td style="text-align: right"><?php echo number_format($row_trans_ari->gula_ptr,2 ); ?></td>
                <?php $hi_nilai_trans = $row_trans_ari->gula_ptr; ?>
                <?php $status = 1; } ?>
        <?php } ?>
        <?php if($status == 0){ echo "<td style=\"text-align: right\">0.00</td>"; }?>
        <!------------------SD GULA PTR TRANS----------------->
        <?php $status = 0; ?>
        <?php foreach ($sum_trans as $row_trans_sd ){?>
            <?php if("TR-TK" == $row_trans_sd->kat_ptpn && $row_trans->kode_plant_trasnfer == $row_trans_sd->kode_plant_trasnfer){?>
                <td style="text-align: right"><?php echo number_format($row_trans_sd->sum_qty_gula_ptr,2 ); ?></td>
                <?php $status = 1; } ?>
        <?php } ?>
        <?php if($status == 0){ echo "<td style=\"text-align: right\">".number_format($hi_nilai_trans, 2)."</td>"; }?>
        <!------------------HI TETES PTR TRANS----------------->
        <?php $status = 0; ?>
        <?php $hi_nilai_trans = 0; ?>
        <?php foreach ($ari_trans as $row_trans_ari ){?>
            <?php if("TR-TK" == $row_trans_ari->kat_ptp && $row_trans->kode_plant_trasnfer == $row_trans_ari->kode_plant_trasnfer){?>
                <td style="text-align: right"><?php echo number_format($row_trans_ari->tetes_ptr,2 ); ?></td>
                <?php $hi_nilai_trans = $row_trans_ari->tetes_ptr; ?>
                <?php $status = 1; } ?>
        <?php } ?>
        <?php if($status == 0){ echo "<td style=\"text-align: right\">0.00</td>"; }?>
        <!------------------SD TETES PTR TRANS----------------->
        <?php $status = 0; ?>
        <?php foreach ($sum_trans as $row_trans_sd ){?>
            <?php if("TR-TK" == $row_trans_sd->kat_ptpn && $row_trans->kode_plant_trasnfer == $row_trans_sd->kode_plant_trasnfer){?>
                <td style="text-align: right"><?php echo number_format($row_trans_sd->sum_qty_tetes_ptr,2 ); ?></td>
                <?php $status = 1; } ?>
        <?php } ?>
        <?php if($status == 0){ echo "<td style=\"text-align: right\">".number_format($hi_nilai_trans, 2)."</td>"; }?>
    </tr>
<?php } ?>

<?php require_once "tr_tm.php"; ?>
