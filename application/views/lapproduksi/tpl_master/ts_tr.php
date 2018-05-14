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
    <td style="text-align: center;background-color: #00c0ef" colspan="17">TS SAUDARA</td>
</tr>

<!--------------------------------------------------TS SAUDARA---------------------------------------------------->
<?php foreach ($kode_kat_ts as $row_kode_kat){?>
    <?php $jenis_lahan_tpl = "TS"; ?>
    <?php if($row_kode_kat->kode_kat_ptp == "TS-TR"){?>
        <?php include "tpl_head.php";?>
    <?php } ?>
<?php } ?>
<?php $trans_kode_kat = "TS-TR";?>
<?php $jenis_lahan_tpl = "TS"; ?>
<?php include "tpl_trans.php";?>

<?php $title_tpl = "TOTAL TS SAUDARA"?>
<?php include "tpl_sum.php";?>
