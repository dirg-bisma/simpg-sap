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
    <?php $jenis_lahan_tpl = "TR"; ?>
    <?php if($row_kode_kat->kode_kat_ptp != "TR-TK" && $row_kode_kat->kode_kat_ptp != "TR-TM"){?>
        <?php include "tpl_head.php" ?>
    <?php } ?>
<?php } ?>

<?php $title_tpl = "TOTAL TR LOKAL"; ?>
<?php include "tpl_sum.php";?>

