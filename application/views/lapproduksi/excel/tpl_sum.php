<tr style="background-color: #9d9d9d">
    <td><?php echo $title_tpl?> </td>
    <td style="text-align: right"><?php echo number_format($total_ha_ditebang, 2); ?></td>
    <td style="text-align: right"><?php echo $sd_total_ha_ditebang == 0 ? number_format($total_ha_ditebang, 2) : number_format($sd_total_ha_ditebang+$total_ha_ditebang, 2); ?></td>
    <td style="text-align: right"><?php echo number_format($total_qty_ditebang/1000,2); ?></td>
    <td style="text-align: right"><?php echo $sd_total_qty_ditebang == 0 ? number_format($total_qty_ditebang/1000, 2) : number_format(($sd_total_qty_ditebang+$total_qty_ditebang)/1000,2); ?></td>
    <td style="text-align: right"><?php echo number_format($total_ha_digiling,2);?></td>
    <td style="text-align: right"><?php echo $sd_total_ha_digiling == 0 ? number_format($total_ha_digiling,2) : number_format($sd_total_ha_digiling+$total_ha_digiling,2); ?></td>
    <td style="text-align: right"><?php echo number_format($total_qty_digiling/1000,2); ?></td>
    <td style="text-align: right"><?php echo $sd_total_qty_digiling == 0 ? number_format($total_qty_digiling/1000, 2) : number_format(($sd_total_qty_digiling+$total_qty_digiling)/1000,2); ?></td>
    <td style="text-align: right"><?php echo number_format($total_hablur/1000,2); ?></td>
    <td style="text-align: right"><?php echo $sd_total_hablur == 0 ? number_format($total_hablur/1000,2) : number_format(($sd_total_hablur+$total_hablur)/1000,2); ?></td>
    <td style="text-align: right"><?php echo @number_format(($total_hablur_kg/$total_qty_digiling_kg)*100, 2, '.',''); ?></td>
    <?php $hablur_sd = $sd_total_hablur_kg+$total_hablur_kg; ?>
    <?php $digiling_sd = $sd_total_qty_digiling_kg+$total_qty_digiling_kg; ?>
    <td style="text-align: right"><?php echo @number_format(($hablur_sd/$digiling_sd)*100,2,'.',''); ?></td>
    <td style="text-align: right"><?php echo number_format($total_gula_ptr/1000,2); ?></td>
    <td style="text-align: right"><?php echo $sd_total_gula_ptr == 0 ? number_format($total_gula_ptr/1000,2) : number_format(($sd_total_gula_ptr+$total_gula_ptr)/1000,2); ?></td>
    <td style="text-align: right"><?php echo number_format($total_tetes_ptr/1000,2);?></td>
    <td style="text-align: right"><?php echo $sd_total_tetes_ptr == 0 ? number_format($total_tetes_ptr/1000,2) : number_format(($sd_total_tetes_ptr+$total_tetes_ptr)/1000,2);?></td>
</tr>