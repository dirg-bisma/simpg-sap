<?php foreach ($kode_kat_tr as $row_kode_kat){?>
    <?php $jenis_lahan_tpl = "TR"; ?>
    <?php if($row_kode_kat->kode_kat_ptp === "TR-TM"){?>
        <?php include "tpl_head.php";?>
    <?php } ?>
<?php } ?>
<!-----------------------------------------TR-TTK------------------------------------------------------>
<?php $trans_kode_kat = "TR-TM";?>
<?php $jenis_lahan_tpl = "TR"; ?>
<?php include "tpl_trans.php";?>

<?php $title_tpl = "TOTAL TR SAUDARA"?>
<?php include "tpl_sum.php";?>

