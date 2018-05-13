<?php foreach($plant_trans as $row_trans){?>
    <tr>
        <td> - <?php echo $row_trans->nama_plant." (".$row_trans->kode_plant_trasnfer.")"; ?></td>
        <input type="hidden" name="trans_kode_kat_lahan_<?php echo replaceKat("TS-TR")."_".$row_trans->kode_plant_trasnfer;?>" value="TS-TR">
        <input type="hidden" name="trans_kat_ptpn_<?php echo replaceKat("TS-TR")."_".$row_trans->kode_plant_trasnfer;?>" value="TS-TR">
        <input type="hidden" name="trans_kat_kepemilikan_<?php echo replaceKat("TS-TR")."_".$row_trans->kode_plant_trasnfer;?>" value="TS">
        <!------------------HI HA TERTEBANG TRANS----------------->
        <?php $ha_tertebang_trans = 0; ?>
        <?php foreach ($timb_trans as $row_trans_timb ){?>
            <?php if("TS-TR" == $row_trans_timb->kat_ptp && $row_trans->kode_plant_trasnfer == $row_trans_timb->kode_plant_trasnfer){?>
                <td style="text-align: right"><?php echo number_format($row_trans_timb->ha_tertebang_selektor,2 ); ?></td>
                <input type="hidden" name="trans_ha_tertebang_<?php echo replaceKat($row_trans_timb->kat_ptp)."_".$row_trans->kode_plant_trasnfer;?>" value="<?php echo $row_trans_timb->ha_tertebang_selektor; ?>">
                <?php $ha_tertebang_trans = 1; } ?>
        <?php } ?>
        <?php if($ha_tertebang_trans == 0){ echo "<td style=\"text-align: right\">0.00</td>"; }?>

        <!------------------SD HA TERTEBANG TRANS----------------->
        <?php $ha_tertebang_trans_sd = 0; ?>
        <?php foreach ($sum_trans as $row_trans_sd ){?>
            <?php if("TS-TR" == $row_trans_sd->kat_ptpn && $row_trans->kode_plant_trasnfer == $row_trans_sd->kode_plant_trasnfer){?>
                <td style="text-align: right"><?php echo number_format($row_trans_sd->sum_ha_tertebang,2 ); ?></td>
                <?php $ha_tertebang_trans_sd = 1; } ?>
        <?php } ?>
        <?php if($ha_tertebang_trans_sd == 0){ echo "<td style=\"text-align: right\">0.00</td>"; }?>

        <!------------------HI QTY TEREBANG TRANS----------------->
        <?php $qty_tertebang_trans = 0; ?>
        <?php foreach ($timb_trans as $row_trans_timb ){?>
            <?php if("TS-TR" == $row_trans_timb->kat_ptp && $row_trans->kode_plant_trasnfer == $row_trans_timb->kode_plant_trasnfer){?>
                <td style="text-align: right"><?php echo number_format($row_trans_timb->netto,2 ); ?></td>
                <input type="hidden" name="trans_qty_tertebang_<?php echo replaceKat($row_trans_timb->kat_ptp)."_".$row_trans->kode_plant_trasnfer;?>" value="<?php echo $row_trans_timb->netto; ?>">
                <?php $qty_tertebang_trans = 1; } ?>
        <?php } ?>
        <?php if($qty_tertebang_trans == 0){ echo "<td style=\"text-align: right\">0.00</td>"; }?>

        <!------------------SD QTY TERTEBANG TRANS----------------->
        <?php $qty_tertebang_trans_sd = 0; ?>
        <?php foreach ($sum_trans as $row_trans_sd ){?>
            <?php if("TS-TR" == $row_trans_sd->kat_ptpn && $row_trans->kode_plant_trasnfer == $row_trans_sd->kode_plant_trasnfer){?>
                <td style="text-align: right"><?php echo number_format($row_trans_sd->sum_qty_tertebang,2 ); ?></td>
                <?php $qty_tertebang_trans_sd = 1; } ?>
        <?php } ?>
        <?php if($qty_tertebang_trans_sd == 0){ echo "<td style=\"text-align: right\">0.00</td>"; }?>

        <!------------------HI HA TERGILING TRANS----------------->
        <?php $ha_tergiling_trans = 0; ?>
        <?php foreach ($ari_trans as $row_trans_ari ){?>
            <?php if("TS-TR" == $row_trans_ari->kat_ptp && $row_trans->kode_plant_trasnfer == $row_trans_ari->kode_plant_trasnfer){?>
                <td style="text-align: right"><?php echo number_format($row_trans_ari->ha_tertebang_selektor,2 ); ?></td>
                <input type="hidden" name="trans_ha_digiling_<?php echo replaceKat($row_trans_ari->kat_ptp)."_".$row_trans->kode_plant_trasnfer;?>" value="<?php echo $row_trans_ari->ha_tertebang_selektor; ?>">
                <?php $ha_tergiling_trans = 1; } ?>
        <?php } ?>
        <?php if($ha_tergiling_trans == 0){ echo "<td style=\"text-align: right\">0.00</td>"; }?>

        <!------------------SD HA TERGILING TRANS----------------->
        <?php $ha_tergiling_trans_sd = 0; ?>
        <?php foreach ($sum_trans as $row_trans_sd ){?>
            <?php if("TS-TR" == $row_trans_sd->kat_ptpn && $row_trans->kode_plant_trasnfer == $row_trans_sd->kode_plant_trasnfer){?>
                <td style="text-align: right"><?php echo number_format($row_trans_sd->sum_ha_digiiling,2 ); ?></td>
                <?php $ha_tergiling_trans_sd = 1; } ?>
        <?php } ?>
        <?php if($ha_tergiling_trans_sd == 0){ echo "<td style=\"text-align: right\">0.00</td>"; }?>

        <!------------------HI QTY TERGILING TRANS----------------->
        <?php $qty_tertebang_trans = 0; ?>
        <?php foreach ($ari_trans as $row_trans_ari ){?>
            <?php if("TS-TR" == $row_trans_ari->kat_ptp && $row_trans->kode_plant_trasnfer == $row_trans_ari->kode_plant_trasnfer){?>
                <td style="text-align: right"><?php echo number_format($row_trans_ari->netto,2 ); ?></td>
                <input type="hidden" name="trans_qty_digiling_<?php echo replaceKat($row_trans_ari->kat_ptp)."_".$row_trans->kode_plant_trasnfer;?>" value="<?php echo $row_trans_ari->netto; ?>">
                <?php $qty_tertebang_trans = 1; } ?>
        <?php } ?>
        <?php if($qty_tertebang_trans == 0){ echo "<td style=\"text-align: right\">0.00</td>"; }?>
        <!------------------SD QTY TERGILING TRANS----------------->
        <?php $qty_tertebang_trans_sd = 0; ?>
        <?php foreach ($sum_trans as $row_trans_sd ){?>
            <?php if("TS-TR" == $row_trans_sd->kat_ptpn && $row_trans->kode_plant_trasnfer == $row_trans_sd->kode_plant_trasnfer){?>
                <td style="text-align: right"><?php echo number_format($row_trans_sd->sum_qty_digiling,2 ); ?></td>
                <?php $ha_tertebang_trans_sd = 1; } ?>
        <?php } ?>
        <?php if($ha_tertebang_trans_sd == 0){ echo "<td style=\"text-align: right\">0.00</td>"; }?>
        <!------------------HI QTY KRISTAL TRANS----------------->
        <?php $qty_kristal_trans = 0; ?>
        <?php foreach ($ari_trans as $row_trans_ari ){?>
            <?php if("TS-TR" == $row_trans_ari->kat_ptp && $row_trans->kode_plant_trasnfer == $row_trans_ari->kode_plant_trasnfer){?>
                <td style="text-align: right"><?php echo number_format($row_trans_ari->hablur,2 ); ?></td>
                <input type="hidden" name="trans_qty_kristal_<?php echo replaceKat($row_trans_ari->kat_ptp)."_".$row_trans->kode_plant_trasnfer;?>" value="<?php echo $row_trans_ari->hablur; ?>">
                <?php $qty_kristal_trans = 1; } ?>
        <?php } ?>
        <?php if($qty_kristal_trans == 0){ echo "<td style=\"text-align: right\">0.00</td>"; }?>
        <!------------------SD QTY KRISTAL TRANS----------------->
        <?php $qty_kristal_trans_sd = 0; ?>
        <?php foreach ($sum_trans as $row_trans_sd ){?>
            <?php if("TS-TR" == $row_trans_sd->kat_ptpn && $row_trans->kode_plant_trasnfer == $row_trans_sd->kode_plant_trasnfer){?>
                <td style="text-align: right"><?php echo number_format($row_trans_sd->sum_qty_kristal,2 ); ?></td>
                <?php $qty_kristal_trans_sd = 1; } ?>
        <?php } ?>
        <?php if($qty_kristal_trans_sd == 0){ echo "<td style=\"text-align: right\">0.00</td>"; }?>
        <!------------------HI RENDEMEN TRANS----------------->
        <?php $qty_kristal_trans = 0; ?>
        <?php foreach ($ari_trans as $row_trans_ari ){?>
            <?php if("TS-TR" == $row_trans_ari->kat_ptp && $row_trans->kode_plant_trasnfer == $row_trans_ari->kode_plant_trasnfer){?>
                <?php $rendemen = ($row_trans_ari->hablur/$row_trans_ari->netto)*100;?>
                <td style="text-align: right"><?php echo number_format($rendemen,2 ); ?></td>
                <input type="hidden" name="trans_rendemen_<?php echo replaceKat($row_trans_ari->kat_ptp)."_".$row_trans->kode_plant_trasnfer;?>" value="<?php echo $rendemen; ?>">
                <?php $qty_kristal_trans = 1; } ?>
        <?php } ?>
        <?php if($qty_kristal_trans == 0){ echo "<td style=\"text-align: right\">0.00</td>"; }?>
        <!------------------SD RENDEMEN TRANS----------------->
        <?php $qty_kristal_trans_sd = 0; ?>
        <?php foreach ($sum_trans as $row_trans_sd ){?>
            <?php if("TS-TR" == $row_trans_sd->kat_ptpn && $row_trans->kode_plant_trasnfer == $row_trans_sd->kode_plant_trasnfer){?>
                <?php $rendemen_sd = ($row_trans_sd->sum_qty_kristal/$row_trans_sd->sum_qty_digiling*100);?>
                <td style="text-align: right"><?php echo number_format($rendemen_sd,2 ); ?></td>
                <?php $qty_kristal_trans_sd = 1; } ?>
        <?php } ?>
        <?php if($qty_kristal_trans_sd == 0){ echo "<td style=\"text-align: right\">0.00</td>"; }?>
        <!------------------HI GULA PTR TRANS----------------->
        <?php $qty_kristal_trans = 0; ?>
        <?php foreach ($ari_trans as $row_trans_ari ){?>
            <?php if("TS-TR" == $row_trans_ari->kat_ptp && $row_trans->kode_plant_trasnfer == $row_trans_ari->kode_plant_trasnfer){?>
                <td style="text-align: right"><?php echo number_format($row_trans_ari->gula_ptr,2 ); ?></td>
                <input type="hidden" name="trans_qty_gula_ptr_<?php echo replaceKat($row_trans_ari->kat_ptp)."_".$row_trans->kode_plant_trasnfer;?>" value="<?php echo $row_trans_ari->gula_ptr; ?>">
                <?php $qty_kristal_trans = 1; } ?>
        <?php } ?>
        <?php if($qty_kristal_trans == 0){ echo "<td style=\"text-align: right\">0.00</td>"; }?>
        <!------------------SD GULA PTR TRANS----------------->
        <?php $qty_kristal_trans_sd = 0; ?>
        <?php foreach ($sum_trans as $row_trans_sd ){?>
            <?php if("TS-TR" == $row_trans_sd->kat_ptpn && $row_trans->kode_plant_trasnfer == $row_trans_sd->kode_plant_trasnfer){?>
                <td style="text-align: right"><?php echo number_format($row_trans_sd->sum_qty_gula_ptr,2 ); ?></td>
                <?php $qty_kristal_trans_sd = 1; } ?>
        <?php } ?>
        <?php if($qty_kristal_trans_sd == 0){ echo "<td style=\"text-align: right\">0.00</td>"; }?>
        <!------------------HI TETES PTR TRANS----------------->
        <?php $qty_kristal_trans = 0; ?>
        <?php foreach ($ari_trans as $row_trans_ari ){?>
            <?php if("TS-TR" == $row_trans_ari->kat_ptp && $row_trans->kode_plant_trasnfer == $row_trans_ari->kode_plant_trasnfer){?>
                <td style="text-align: right"><?php echo number_format($row_trans_ari->tetes_ptr,2 ); ?></td>
                <input type="hidden" name="trans_qty_gula_ptr_<?php echo replaceKat($row_trans_ari->kat_ptp)."_".$row_trans->kode_plant_trasnfer;?>" value="<?php echo $row_trans_ari->tetes_ptr; ?>">
                <?php $qty_kristal_trans = 1; } ?>
        <?php } ?>
        <?php if($qty_kristal_trans == 0){ echo "<td style=\"text-align: right\">0.00</td>"; }?>
        <!------------------SD TETES PTR TRANS----------------->
        <?php $qty_kristal_trans_sd = 0; ?>
        <?php foreach ($sum_trans as $row_trans_sd ){?>
            <?php if("TS-TR" == $row_trans_sd->kat_ptpn && $row_trans->kode_plant_trasnfer == $row_trans_sd->kode_plant_trasnfer){?>
                <td style="text-align: right"><?php echo number_format($row_trans_sd->sum_qty_tetes_ptr,2 ); ?></td>
                <?php $qty_kristal_trans_sd = 1; } ?>
        <?php } ?>
        <?php if($qty_kristal_trans_sd == 0){ echo "<td style=\"text-align: right\">0.00</td>"; }?>
    </tr>
<?php } ?>