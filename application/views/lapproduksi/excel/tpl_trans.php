
<?php foreach($plant_trans as $row_trans){?>
    <tr>
        <td> -- <?php echo $row_trans->nama_plant." (".$row_trans->kode_plant_trasnfer.")"; ?></td>
        <?php $hi_nilai_trans = 0;?>
        <!------------------HI HA TERTEBANG TRANS----------------->
        <?php $status = 0; ?>
        <?php $hi_nilai_trans = 0;?>
        <?php foreach ($timb_trans as $row_trans_timb ){?>
            <?php if($trans_kode_kat == $row_trans_timb->kat_ptp && $row_trans->kode_plant_trasnfer == $row_trans_timb->kode_plant_trasnfer){?>
                <td style="text-align: right"><?php echo number_format($row_trans_timb->ha_tertebang_selektor,2 ); ?></td>
                <?php $hi_nilai_trans = $row_trans_timb->ha_tertebang_selektor;?>
                <?php $status = 1; } ?>
        <?php } ?>
        <?php if($status == 0){ echo "<td style=\"text-align: right\"> 0.00</td>"; }?>

        <!------------------SD HA TERTEBANG TRANS----------------->
        <?php $status = 0; ?>
        <?php foreach ($sum_trans as $row_trans_sd ){?>
            <?php if($trans_kode_kat == $row_trans_sd->kat_ptpn && $row_trans->kode_plant_trasnfer == $row_trans_sd->kode_plant_trasnfer){?>
                <td style="text-align: right"><?php echo number_format($row_trans_sd->sum_ha_tertebang,2 ); ?></td>
                <?php $status = 1; } ?>
        <?php } ?>
        <?php if($status == 0){ echo "<td style=\"text-align: right\">".number_format($hi_nilai_trans, 2)."</td>"; }?>

        <!------------------HI QTY TEREBANG TRANS----------------->
        <?php $status = 0; ?>
        <?php $hi_nilai_trans = 0;?>
        <?php foreach ($timb_trans as $row_trans_timb ){?>
            <?php if($trans_kode_kat == $row_trans_timb->kat_ptp && $row_trans->kode_plant_trasnfer == $row_trans_timb->kode_plant_trasnfer){?>
                <td style="text-align: right"><?php echo number_format($row_trans_timb->netto,2 ); ?></td>
                <?php $hi_nilai_trans = $row_trans_timb->netto_kg; ?>
                <?php $status = 1; } ?>
        <?php } ?>
        <?php if($status == 0){ echo "<td style=\"text-align: right\">0.00</td>"; }?>

        <!------------------SD QTY TERTEBANG TRANS----------------->
        <?php $status = 0; ?>
        <?php foreach ($sum_trans as $row_trans_sd ){?>
            <?php if($trans_kode_kat == $row_trans_sd->kat_ptpn && $row_trans->kode_plant_trasnfer == $row_trans_sd->kode_plant_trasnfer){?>
                <td style="text-align: right"><?php echo number_format($row_trans_sd->sum_qty_tertebang+$hi_nilai_trans/1000,2 ); ?></td>
                <?php $status = 1; } ?>
        <?php } ?>
        <?php if($status == 0){ echo "<td style=\"text-align: right\">".number_format($hi_nilai_trans/1000, 2)."</td>"; }?>

        <!------------------HI HA TERGILING TRANS----------------->
        <?php $status = 0; ?>
        <?php $hi_nilai_trans = 0;?>
        <?php foreach ($ari_trans as $row_trans_ari ){?>
            <?php if($trans_kode_kat == $row_trans_ari->kat_ptp && $row_trans->kode_plant_trasnfer == $row_trans_ari->kode_plant_trasnfer){?>
                <td style="text-align: right"><?php echo number_format($row_trans_ari->ha_tertebang_selektor,2 ); ?></td>
                <?php $hi_nilai_trans = $row_trans_ari->ha_tertebang_selektor; ?>
                <?php $status = 1; } ?>
        <?php } ?>
        <?php if($status == 0){ echo "<td style=\"text-align: right\">0.00</td>"; }?>

        <!------------------SD HA TERGILING TRANS----------------->
        <?php $status = 0; ?>
        <?php foreach ($sum_trans as $row_trans_sd ){?>
            <?php if($trans_kode_kat == $row_trans_sd->kat_ptpn && $row_trans->kode_plant_trasnfer == $row_trans_sd->kode_plant_trasnfer){?>
                <td style="text-align: right"><?php echo number_format($row_trans_sd->sum_ha_digiiling+$hi_nilai_trans,2 ); ?></td>
                <?php $status = 1; } ?>
        <?php } ?>
        <?php if($status == 0){ echo "<td style=\"text-align: right\">".number_format($hi_nilai_trans, 2)."</td>"; }?>

        <!------------------HI QTY TERGILING TRANS----------------->
        <?php $status = 0; ?>
        <?php $hi_nilai_trans = 0;?>
        <?php $hi_tergiling_trans = 0; ?>
        <?php foreach ($ari_trans as $row_trans_ari ){?>
            <?php if($trans_kode_kat == $row_trans_ari->kat_ptp && $row_trans->kode_plant_trasnfer == $row_trans_ari->kode_plant_trasnfer){?>
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
            <?php if($trans_kode_kat == $row_trans_sd->kat_ptpn && $row_trans->kode_plant_trasnfer == $row_trans_sd->kode_plant_trasnfer){?>
                <td style="text-align: right"><?php echo number_format($row_trans_sd->sum_qty_digiling+$hi_nilai_trans/1000,2 ); ?></td>
                <?php $trans_qty_tergiling_sd = $row_trans_sd->sum_qty_digiling; ?>
                <?php $status = 1; } ?>
        <?php } ?>
        <?php if($status == 0){ echo "<td style=\"text-align: right\">".number_format($hi_nilai_trans/1000, 2)."</td>"; }?>
        <!------------------HI QTY KRISTAL TRANS----------------->
        <?php $status = 0; ?>
        <?php $hi_nilai_trans = 0;?>
        <?php $hi_qty_kristal = 0; ?>
        <?php foreach ($ari_trans as $row_trans_ari ){?>
            <?php if($trans_kode_kat == $row_trans_ari->kat_ptp && $row_trans->kode_plant_trasnfer == $row_trans_ari->kode_plant_trasnfer){?>
                <td style="text-align: right"><?php echo number_format($row_trans_ari->hablur,2 ); ?></td>
                <?php $hi_nilai_trans = $row_trans_ari->hablur_kg; ?>
                <?php $hi_qty_kristal = $row_trans_ari->hablur_kg; ?>
                <?php $status = 1; } ?>
        <?php } ?>
        <?php if($status == 0){ echo "<td style=\"text-align: right\">0.00</td>"; }?>
        <!------------------SD QTY KRISTAL TRANS----------------->
        <?php $status = 0; ?>
        <?php $trans_qty_kristal_sd = 0; ?>
        <?php foreach ($sum_trans as $row_trans_sd ){?>
            <?php if($trans_kode_kat == $row_trans_sd->kat_ptpn && $row_trans->kode_plant_trasnfer == $row_trans_sd->kode_plant_trasnfer){?>
                <td style="text-align: right"><?php echo number_format($row_trans_sd->sum_qty_kristal+$hi_qty_kristal/1000,2 ); ?></td>
                <?php $trans_qty_kristal_sd = $row_trans_sd->sum_qty_kristal; ?>
                <?php $status = 1; } ?>
        <?php } ?>
        <?php if($status == 0){ echo "<td style=\"text-align: right\">".number_format($hi_nilai_trans/1000, 2)."</td>"; }?>
        <!------------------HI RENDEMEN TRANS----------------->
        <?php $qty_kristal_trans = 0; ?>
        <?php foreach ($ari_trans as $row_trans_ari ){?>
            <?php if($trans_kode_kat == $row_trans_ari->kat_ptp && $row_trans->kode_plant_trasnfer == $row_trans_ari->kode_plant_trasnfer){?>
                <?php $rendemen = ($row_trans_ari->hablur_kg/$row_trans_ari->netto_kg)*100;?>
                <td style="text-align: right"><?php echo number_format($rendemen,2 ); ?></td>
                <?php $qty_kristal_trans = 1; } ?>
        <?php } ?>
        <?php if($qty_kristal_trans == 0){ echo "<td style=\"text-align: right\">0.00</td>"; }?>
        <!------------------SD RENDEMEN TRANS----------------->
        <?php $_rend_trans_sd = 0; ?>
        <?php foreach ($sum_trans as $row_trans_sd ){?>
            <?php if($trans_kode_kat == $row_trans_sd->kat_ptpn && $row_trans->kode_plant_trasnfer == $row_trans_sd->kode_plant_trasnfer){?>
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
            <?php if($trans_kode_kat == $row_trans_ari->kat_ptp && $row_trans->kode_plant_trasnfer == $row_trans_ari->kode_plant_trasnfer){?>
                <td style="text-align: right"><?php echo number_format($row_trans_ari->gula_ptr,2 ); ?></td>
                <?php $hi_nilai_trans = $row_trans_ari->gula_ptr_kg; ?>
                <?php $status = 1; } ?>
        <?php } ?>
        <?php if($status == 0){ echo "<td style=\"text-align: right\">0.00</td>"; }?>
        <!------------------SD GULA PTR TRANS----------------->
        <?php $status = 0; ?>
        <?php foreach ($sum_trans as $row_trans_sd ){?>
            <?php if($trans_kode_kat == $row_trans_sd->kat_ptpn && $row_trans->kode_plant_trasnfer == $row_trans_sd->kode_plant_trasnfer){?>
                <td style="text-align: right"><?php echo number_format($row_trans_sd->sum_qty_gula_ptr+$hi_nilai_trans/1000,2 ); ?></td>
                <?php $status = 1; } ?>
        <?php } ?>
        <?php if($status == 0){ echo "<td style=\"text-align: right\">".number_format($hi_nilai_trans/1000, 2)."</td>"; }?>
        <!------------------HI TETES PTR TRANS----------------->
        <?php $status = 0; ?>
        <?php $hi_nilai_trans = 0; ?>
        <?php foreach ($ari_trans as $row_trans_ari ){?>
            <?php if($trans_kode_kat == $row_trans_ari->kat_ptp && $row_trans->kode_plant_trasnfer == $row_trans_ari->kode_plant_trasnfer){?>
                <td style="text-align: right"><?php echo number_format($row_trans_ari->tetes_ptr,2 ); ?></td>
                <?php $hi_nilai_trans = $row_trans_ari->tetes_ptr_kg; ?>
                <?php $status = 1; } ?>
        <?php } ?>
        <?php if($status == 0){ echo "<td style=\"text-align: right\">0.00</td>"; }?>
        <!------------------SD TETES PTR TRANS----------------->
        <?php $status = 0; ?>
        <?php foreach ($sum_trans as $row_trans_sd ){?>
            <?php if($trans_kode_kat == $row_trans_sd->kat_ptpn && $row_trans->kode_plant_trasnfer == $row_trans_sd->kode_plant_trasnfer){?>
                <td style="text-align: right"><?php echo number_format($row_trans_sd->sum_qty_tetes_ptr+$hi_nilai_trans/1000,2 ); ?></td>
                <?php $status = 1; } ?>
        <?php } ?>
        <?php if($status == 0){ echo "<td style=\"text-align: right\">".number_format($hi_nilai_trans/1000, 2)."</td>"; }?>
    </tr>
<?php } ?>