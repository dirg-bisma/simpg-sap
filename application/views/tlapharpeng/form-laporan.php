<section class="content-header">
    <h1>
        <?php echo $pageTitle ;?> Hari Giling ke - <?php echo $hari_giling;?>
    </h1>
    <ol class="breadcrumb">
        <li><i class="fa fa-dashboard"></i><a href="<?php echo site_url('dashboard') ?>"> Dashboard </a></li>
        <li><a href="<?php echo site_url('tlapharpeng') ?>"><?php echo $pageTitle ?></a></li>
        <li class="active"> Form </li>
    </ol>
</section>


<section class="content">
    <div class="row">
        <div class="col-md-6 col-md-12">
            <div class="box box-danger">
                <div class="box-body">
                    <div class="page-content-wrapper m-t">
                        <style type="text/css">
                            table.tableizer-table {
                                font-size: 12px;
                                border: 1px solid #CCC;
                                font-family: Arial, Helvetica, sans-serif;
                                width:100%;
                            }
                            .tableizer-table td {
                                padding: 4px;
                                margin: 3px;
                                border: 1px solid #CCC;
                            }
                            .tableizer-table th {
                                background-color: #104E8B;
                                color: #FFF;
                                font-weight: bold;
                                height:25px;padding:10px;
                            }
                        </style>
                        <table class="tableizer-table">
                            <thead>
                            <tr class="tableizer-firstrow">
                                <th>KETERANGAN</th>
                                <th>HI</th>
                                <th>YLL</th>
                                <th>SD. HI</th>
                            </tr>
                            </thead>
                            <tbody>
                            <tr style="color:red;font-weight:bold">
                                <td width="250px"> HEKTAR DITEBANG </td>
                                <td></td>
                                <td></td>
                                <td></td>
                            </tr>
                            <tr>
                                <td> TS </td>
                                <td><?php echo number_format($lap_hi_ts->sum_ha_tertebang, 2); ?></td>
                                <td><?php echo number_format($lap_yl_ts->sum_ha_tertebang, 2); ?></td>
                                <td><?php echo number_format($lap_sd_ts->sum_ha_tertebang, 2); ?></td>
                            </tr>
                            <tr>
                                <td> TS SAUDARA </td>
                                <td> <?php echo number_format($lap_hi_ts_sdr->sum_ha_tertebang, 2); ?> </td>
                                <td> <?php echo number_format($lap_yl_ts_sdr->sum_ha_tertebang, 2); ?> </td>
                                <td> <?php echo number_format($lap_sd_ts_sdr->sum_ha_tertebang, 2); ?> </td>
                            </tr>
                            <tr>
                                <td> TR </td>
                                <td> <?php echo number_format($lap_hi_tr->sum_ha_tertebang,2); ?> </td>
                                <td> <?php echo number_format($lap_yl_tr->sum_ha_tertebang,2); ?> </td>
                                <td> <?php echo number_format($lap_sd_tr->sum_ha_tertebang,2); ?> </td>
                            </tr>
                            <tr bgcolor="#3c8dbc" style="color:white;font-weight:bold">
                                <td> TOTAL </td>
                                <td> <?php echo number_format(($lap_hi_ts->sum_ha_tertebang+$lap_hi_ts_sdr->sum_ha_tertebang+$lap_hi_tr->sum_ha_tertebang),2);?> </td>
                                <td> <?php echo number_format(($lap_yl_ts->sum_ha_tertebang+$lap_yl_ts_sdr->sum_ha_tertebang+$lap_yl_tr->sum_ha_tertebang),2);?> </td>
                                <td> <?php echo number_format(($lap_sd_ts->sum_ha_tertebang+$lap_sd_ts_sdr->sum_ha_tertebang+$lap_sd_tr->sum_ha_tertebang),2);?> </td>
                            </tr>
                            <tr style="color:red;font-weight:bold">
                                <td> TEBU DITEBANG </td>
                                <td>&nbsp;</td>
                                <td>&nbsp;</td>
                                <td>&nbsp;</td>
                            </tr>
                            <tr>
                                <td> TS </td>
                                <td><?php echo number_format($lap_hi_ts->sum_qty_tertebang, 2); ?></td>
                                <td><?php echo number_format($lap_yl_ts->sum_qty_tertebang, 2); ?></td>
                                <td><?php echo number_format($lap_sd_ts->sum_qty_tertebang, 2); ?></td>
                            </tr>
                            <tr>
                                <td> TS SAUDARA </td>
                                <td><?php echo number_format($lap_hi_ts_sdr->sum_qty_tertebang, 2); ?></td>
                                <td><?php echo number_format($lap_yl_ts_sdr->sum_qty_tertebang, 2); ?></td>
                                <td><?php echo number_format($lap_sd_ts_sdr->sum_qty_tertebang, 2); ?></td>
                            </tr>
                            <tr>
                                <td> TR </td>
                                <td><?php echo number_format($lap_hi_tr->sum_qty_tertebang, 2); ?></td>
                                <td><?php echo number_format($lap_yl_tr->sum_qty_tertebang, 2); ?></td>
                                <td><?php echo number_format($lap_sd_tr->sum_qty_tertebang, 2); ?></td>
                            </tr>
                            <tr bgcolor="#3c8dbc" style="color:white;font-weight:bold">
                                <td> TOTAL </td>
                                <td> <?php echo number_format(($lap_hi_ts->sum_qty_tertebang+$lap_hi_ts_sdr->sum_qty_tertebang+$lap_hi_tr->sum_qty_tertebang), 2);?> </td>
                                <td> <?php echo number_format(($lap_yl_ts->sum_qty_tertebang+$lap_yl_ts_sdr->sum_qty_tertebang+$lap_yl_tr->sum_qty_tertebang), 2);?> </td>
                                <td> <?php echo number_format(($lap_sd_ts->sum_qty_tertebang+$lap_sd_ts_sdr->sum_qty_tertebang+$lap_sd_tr->sum_qty_tertebang), 2);?> </td>
                            </tr>
                            <tr style="color:red;font-weight:bold">
                                <td> HEKTAR DIGILING </td>
                                <td>&nbsp;</td>
                                <td>&nbsp;</td>
                                <td>&nbsp;</td>
                            </tr>
                            <tr>
                                <td> TS </td>
                                <td><?php echo number_format($lap_hi_ts->sum_ha_digiiling, 2); ?></td>
                                <td><?php echo number_format($lap_yl_ts->sum_ha_digiiling, 2); ?></td>
                                <td><?php echo number_format($lap_sd_ts->sum_ha_digiiling, 2); ?></td>
                            </tr>
                            <tr>
                                <td> TS SAUDARA </td>
                                <td><?php echo number_format($lap_hi_ts_sdr->sum_ha_digiiling, 2); ?></td>
                                <td><?php echo number_format($lap_yl_ts_sdr->sum_ha_digiiling, 2); ?></td>
                                <td><?php echo number_format($lap_sd_ts_sdr->sum_ha_digiiling, 2); ?></td>
                            </tr>
                            <tr>
                                <td> TR </td>
                                <td><?php echo number_format($lap_hi_tr->sum_qty_tertebang, 2); ?></td>
                                <td><?php echo number_format($lap_yl_tr->sum_qty_tertebang, 2); ?></td>
                                <td><?php echo number_format($lap_sd_tr->sum_qty_tertebang, 2); ?></td>
                            </tr>
                            <tr bgcolor="#3c8dbc" style="color:white;font-weight:bold">
                                <td> TOTAL </td>
                                <td> <?php echo number_format(($lap_hi_ts->sum_qty_tertebang+$lap_hi_ts_sdr->sum_qty_tertebang+$lap_hi_tr->sum_qty_tertebang), 2);?> </td>
                                <td> <?php echo number_format(($lap_yl_ts->sum_qty_tertebang+$lap_yl_ts_sdr->sum_qty_tertebang+$lap_yl_tr->sum_qty_tertebang), 2);?> </td>
                                <td> <?php echo number_format(($lap_sd_ts->sum_qty_tertebang+$lap_sd_ts_sdr->sum_qty_tertebang+$lap_sd_tr->sum_qty_tertebang), 2);?> </td>
                            </tr>
                            <tr style="color:red;font-weight:bold">
                                <td> TEBU DIGILING </td>
                                <td>&nbsp;</td>
                                <td>&nbsp;</td>
                                <td>&nbsp;</td>
                            </tr>
                            <tr>
                                <td> TS </td>
                                <td><?php echo number_format($lap_hi_ts->sum_qty_digiling, 2); ?></td>
                                <td><?php echo number_format($lap_yl_ts->sum_qty_digiling, 2); ?></td>
                                <td><?php echo number_format($lap_sd_ts->sum_qty_digiling, 2); ?></td>
                            </tr>
                            <tr>
                                <td> TS SAUDARA </td>
                                <td><?php echo number_format($lap_hi_ts_sdr->sum_qty_digiling, 2); ?></td>
                                <td><?php echo number_format($lap_yl_ts_sdr->sum_qty_digiling, 2); ?></td>
                                <td><?php echo number_format($lap_sd_ts_sdr->sum_qty_digiling, 2); ?></td>
                            </tr>
                            <tr>
                                <td> TR </td>
                                <td><?php echo number_format($lap_hi_tr->sum_qty_digiling, 2); ?></td>
                                <td><?php echo number_format($lap_yl_tr->sum_qty_digiling, 2); ?></td>
                                <td><?php echo number_format($lap_sd_tr->sum_qty_digiling, 2); ?></td>
                            </tr>
                            <tr bgcolor="#3c8dbc" style="color:white;font-weight:bold">
                                <td> TOTAL </td>
                                <td> <?php echo number_format(($lap_hi_ts->sum_qty_digiling+$lap_hi_ts_sdr->sum_qty_digiling+$lap_hi_tr->sum_qty_digiling), 2);?> </td>
                                <td> <?php echo number_format(($lap_yl_ts->sum_qty_digiling+$lap_yl_ts_sdr->sum_qty_digiling+$lap_yl_tr->sum_qty_digiling), 2);?> </td>
                                <td> <?php echo number_format(($lap_sd_ts->sum_qty_digiling+$lap_sd_ts_sdr->sum_qty_digiling+$lap_sd_tr->sum_qty_digiling), 2);?> </td>
                            </tr>
                            <?php $total_qty_digiling_hi = (($lap_hi_ts->sum_qty_digiling+$lap_hi_ts_sdr->sum_qty_digiling+$lap_hi_tr->sum_qty_digiling));?>
                            <?php $total_qty_digiling_yl = (($lap_yl_ts->sum_qty_digiling+$lap_yl_ts_sdr->sum_qty_digiling+$lap_yl_tr->sum_qty_digiling));?>
                            <?php $total_qty_digiling_sd = (($lap_sd_ts->sum_qty_digiling+$lap_sd_ts_sdr->sum_qty_digiling+$lap_sd_tr->sum_qty_digiling));?>

                            <tr style="color:red;font-weight:bold">
                                <td> KRISTAL </td>
                                <td>&nbsp;</td>
                                <td>&nbsp;</td>
                                <td>&nbsp;</td>
                            </tr>
                            <tr>
                                <td> TS </td>
                                <td><?php echo number_format($lap_hi_ts->sum_qty_kristal, 2); ?></td>
                                <td><?php echo number_format($lap_yl_ts->sum_qty_kristal, 2); ?></td>
                                <td><?php echo number_format($lap_sd_ts->sum_qty_kristal, 2); ?></td>
                            </tr>
                            <tr>
                                <td> TS SAUDARA </td>
                                <td><?php echo number_format($lap_hi_ts_sdr->sum_qty_kristal, 2); ?></td>
                                <td><?php echo number_format($lap_yl_ts_sdr->sum_qty_kristal, 2); ?></td>
                                <td><?php echo number_format($lap_sd_ts_sdr->sum_qty_kristal, 2); ?></td>
                            </tr>
                            <tr>
                                <td> TR </td>
                                <td><?php echo number_format($lap_hi_tr->sum_qty_kristal, 2); ?></td>
                                <td><?php echo number_format($lap_yl_tr->sum_qty_kristal, 2); ?></td>
                                <td><?php echo number_format($lap_sd_tr->sum_qty_kristal, 2); ?></td>
                            </tr>
                            <tr bgcolor="#3c8dbc" style="color:white;font-weight:bold">
                                <td> TOTAL </td>
                                <td> <?php echo number_format(($lap_hi_ts->sum_qty_kristal+$lap_hi_ts_sdr->sum_qty_kristal+$lap_hi_tr->sum_qty_kristal), 2);?> </td>
                                <td> <?php echo number_format(($lap_yl_ts->sum_qty_kristal+$lap_yl_ts_sdr->sum_qty_kristal+$lap_yl_tr->sum_qty_kristal), 2);?> </td>
                                <td> <?php echo number_format(($lap_sd_ts->sum_qty_kristal+$lap_sd_ts_sdr->sum_qty_kristal+$lap_sd_tr->sum_qty_kristal), 2);?> </td>
                            </tr>
                            <?php $total_kristal_hi = (($lap_hi_ts->sum_qty_kristal+$lap_hi_ts_sdr->sum_qty_kristal+$lap_hi_tr->sum_qty_kristal));?>
                            <?php $total_kristal_yl = (($lap_yl_ts->sum_qty_kristal+$lap_yl_ts_sdr->sum_qty_kristal+$lap_yl_tr->sum_qty_kristal));?>
                            <?php $total_kristal_sd = (($lap_sd_ts->sum_qty_kristal+$lap_sd_ts_sdr->sum_qty_kristal+$lap_sd_tr->sum_qty_kristal));?>
                            <tr style="color:red;font-weight:bold">
                                <td> RENDEMEN </td>
                                <td>&nbsp;</td>
                                <td>&nbsp;</td>
                                <td>&nbsp;</td>
                            </tr>
                            <?php if(isset($lap_hi_ts->sum_qty_kristal) && isset($lap_hi_ts->sum_qty_digiling)){?>
                            <?php $rend_hi_ts = (($lap_hi_ts->sum_qty_kristal/$lap_hi_ts->sum_qty_digiling)*100);?>
                            <?php }else{ $rend_hi_ts = 0;}?>
                            <?php if(isset($lap_yl_ts->sum_qty_kristal) && isset($lap_yl_ts->sum_qty_digiling)){?>
                                <?php $rend_yl_ts = (($lap_yl_ts->sum_qty_kristal/$lap_yl_ts->sum_qty_digiling)*100);?>
                            <?php }else{ $rend_yl_ts = 0;}?>
                            <?php if(isset($lap_sd_ts->sum_qty_kristal) && isset($lap_sd_ts->sum_qty_digiling)){?>
                                <?php $rend_sd_ts = (($lap_hi_ts->sum_qty_kristal/$lap_sd_ts->sum_qty_digiling)*100);?>
                            <?php }else{ $rend_sd_ts = 0;}?>
                            <tr>
                                <td> TS </td>
                                <td> <?php echo round($rend_hi_ts,2); ?> </td>
                                <td> <?php echo round($rend_yl_ts,2); ?> </td>
                                <td> <?php echo round($rend_sd_ts,2); ?> </td>
                            </tr>
                            <?php if(isset($lap_hi_ts_sdr->sum_qty_kristal) && isset($lap_hi_ts_sdr->sum_qty_digiling)){?>
                                <?php $rend_hi_ts_sdr = (($lap_hi_ts_sdr->sum_qty_kristal/$lap_hi_ts_sdr->sum_qty_digiling)*100);?>
                            <?php }else{ $rend_hi_ts_sdr = 0;}?>
                            <?php if(isset($lap_yl_ts_sdr->sum_qty_kristal) && isset($lap_yl_ts_sdr->sum_qty_digiling)){?>
                                <?php $rend_yl_ts_sdr = (($lap_yl_ts_sdr->sum_qty_kristal/$lap_yl_ts_sdr->sum_qty_digiling)*100);?>
                            <?php }else{ $rend_yl_ts_sdr = 0;}?>
                            <?php if(isset($lap_sd_ts_sdr->sum_qty_kristal) && isset($lap_sd_ts_sdr->sum_qty_digiling)){?>
                                <?php $rend_sd_ts_sdr = (($lap_sd_ts_sdr->sum_qty_kristal/$lap_sd_ts_sdr->sum_qty_digiling)*100);?>
                            <?php }else{ $rend_sd_ts_sdr = 0;}?>
                            <tr>
                                <td> TS SAUDARA </td>
                                <td> <?php echo round($rend_hi_ts_sdr,2); ?> </td>
                                <td> <?php echo round($rend_yl_ts_sdr,2); ?> </td>
                                <td> <?php echo round($rend_sd_ts_sdr,2); ?> </td>
                            </tr>
                            <?php if(isset($lap_hi_tr->sum_qty_kristal) && isset($lap_hi_tr->sum_qty_digiling)){?>
                                <?php $rend_hi_tr = (($lap_hi_tr->sum_qty_kristal/$lap_hi_tr->sum_qty_digiling)*100);?>
                            <?php }else{ $rend_hi_tr = 0;}?>
                            <?php if(isset($lap_yl_tr->sum_qty_kristal) && isset($lap_yl_tr->sum_qty_digiling)){?>
                                <?php $rend_yl_tr = (($lap_hi_tr->sum_qty_kristal/$lap_yl_tr->sum_qty_digiling)*100);?>
                            <?php }else{ $rend_yl_tr = 0;}?>
                            <?php if(isset($lap_sd_tr->sum_qty_kristal) && isset($lap_sd_tr->sum_qty_digiling)){?>
                                <?php $rend_sd_tr = (($lap_sd_tr->sum_qty_kristal/$lap_sd_tr->sum_qty_digiling)*100);?>
                            <?php }else{ $rend_sd_tr = 0;}?>
                            <tr>
                                <td> TR </td>
                                <td> <?php echo round($rend_hi_tr,2); ?> </td>
                                <td> <?php echo round($rend_yl_tr,2); ?> </td>
                                <td> <?php echo round($rend_sd_tr,2); ?> </td>
                            </tr>
                            <?php if($total_kristal_hi != 0 && $total_qty_digiling_hi != 0){?>
                                <?php $total_rend_hi = (($total_kristal_hi/$total_qty_digiling_hi)*100);?>
                            <?php }else{ $total_rend_hi = 0;}?>
                            <?php if($total_kristal_yl != 0 && $total_qty_digiling_yl != 0){?>
                                <?php $total_rend_yl = (($total_kristal_yl/$total_qty_digiling_yl)*100);?>
                            <?php }else{ $total_rend_yl = 0;}?>
                            <?php if($total_kristal_sd != 0 && $total_qty_digiling_sd != 0){?>
                                <?php $total_rend_sd = (($total_kristal_sd/$total_qty_digiling_sd)*100);?>
                            <?php }else{ $total_rend_sd = 0;}?>
                            <tr bgcolor="#3c8dbc" style="color:white;font-weight:bold">
                                <td> TOTAL </td>
                                <td> <?php echo round($total_rend_hi,2); ?> </td>
                                <td> <?php echo round($total_rend_yl,2); ?> </td>
                                <td> <?php echo round($total_rend_sd,2); ?> </td>
                            </tr>

                            <tr style="color:red;font-weight:bold" >
                                <td> GULA BAGI HASIL </td>
                                <td></td>
                                <td>&nbsp;</td>
                                <td>&nbsp;</td>
                            </tr>
                            <tr>
                                <td> TS </td>
                                <td> - </td>
                                <td> 523.3 </td>
                                <td> 523.3 </td>
                            </tr>
                            <tr>
                                <td> EKS. TS SAUDARA </td>
                                <td> - </td>
                                <td> 212.2 </td>
                                <td> 212.2 </td>
                            </tr>
                            <tr>
                                <td> EKS . TR </td>
                                <td> - </td>
                                <td> 3,729.5 </td>
                                <td> 3,729.5 </td>
                            </tr>
                            <tr>
                                <td> MILIK PG </td>
                                <td> - </td>
                                <td> 4,465.0 </td>
                                <td> 4,465.0 </td>
                            </tr>
                            <tr>
                                <td> MILIK TS SAUDARA </td>
                                <td> - </td>
                                <td> - </td>
                                <td> - </td>
                            </tr>
                            <tr>
                                <td> MILIK TR </td>
                                <td> - </td>
                                <td> 7,522.4 </td>
                                <td> 7,522.4 </td>
                            </tr>
                            <tr bgcolor="#3c8dbc" style="color:white;font-weight:bold">
                                <td> TOTAL </td>
                                <td> - </td>
                                <td> 11,987.4 </td>
                                <td> 11,987.5 </td>
                            </tr>
                            <tr style="color:red;font-weight:bold">
                                <td> TEBU TERBAKAR </td>
                                <td>&nbsp;</td>
                                <td>&nbsp;</td>
                                <td>&nbsp;</td>
                            </tr>
                            <tr>
                                <td> TS </td>
                                <td><input type="text" id="tebu_terbakar_ts" name="tebu_terbakar_ts"></td>
                                <td> - </td>
                                <td> - </td>
                            </tr>
                            <tr>
                                <td> TS SAUDARA </td>
                                <td><input type="text" id="tebu_terbakar_ts_saudara" name="tebu_terbakar_ts_saudara"></td>
                                <td> 322.0 </td>
                                <td> 322.0 </td>
                            </tr>
                            <tr>
                                <td> TR </td>
                                <td><input type="text" id="tebu_terbakar_tr" name="tebu_terbakar_tr"></td>
                                <td> 7,088.02 </td>
                                <td> 7,088.02 </td>
                            </tr>
                            <tr bgcolor="#3c8dbc" style="color:white;font-weight:bold">
                                <td> TOTAL </td>
                                <td> - </td>
                                <td> 7,409.97 </td>
                                <td> 7,409.97 </td>
                            </tr>
                            <tr>
                                <td>&nbsp;</td>
                                <td>&nbsp;</td>
                                <td>&nbsp;</td>
                                <td>&nbsp;</td>
                            </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-6 col-md-12">
            <div class="box box-danger">


                <div class="box-body">

                    <div class="page-content-wrapper m-t">
                        <form action="<?php echo site_url('tlapharpeng/simpan'); ?>" method="post">
                            <table class="tableizer-table">
                                <thead>
                                <tr class="tableizer-firstrow">
                                    <th>KETERANGAN</th>
                                    <th>HI</th>
                                    <th>YLL</th>
                                    <th>SD. HI</th>
                                </tr>
                                </thead>
                                <tbody>
                                <tr>
                                    <td width="250px"> Jam berht.A </td>
                                    <td><input type="text" id="jam_berhenti_a" name="jam_berhenti_a" class='form-control input-sm' value="<?php echo @$data->jam_berhenti_a;?>"/></td>
                                    <td>
                                        <?php if(isset($data_kemarin->jam_berhenti_a_sum)){?>
                                            <?php echo @$data_kemarin->jam_berhenti_a_sum;?>
                                            <input type="text" id="jam_berhenti_a" name="jam_berhenti_a" class='form-control input-sm' value="<?php echo @$data->jam_berhenti_a;?>"/>
                                        <?php }?>
                                    </td>
                                    <td> <input type="text" class="form-control input-sm" id="jam_ber_a_sdhi" readonly/> </td>
                                </tr>
                                <tr>
                                    <td> Jam berht.B </td>
                                    <td><input type="text" id="jam_berhenti_b" name="jam_berhenti_b" class='form-control input-sm' value="<?php echo @$data->jam_berhenti_b?>"/> </td>
                                    <td> <?php echo @$data_kemarin->jam_berhenti_b_sum;?> </td>
                                    <td> <input type="text" class="form-control input-sm" id="jam_ber_b_sdhi" readonly/></td>
                                </tr>
                                <tr>
                                    <td>  A + B </td>
                                    <td> <input type="text" id="jam_a_plus_b" class="form-control input-sm" value="<?php echo @$data_kemarin->jam_berhenti_b+@$data_kemarin->jam_berhenti_a;?>" readonly/> </td>
                                    <td> <?php echo @$data_kemarin->jam_berhenti_b_sum+@$data_kemarin->jam_berhenti_a_sum;?> </td>
                                    <td> <input type="text" class="form-control input-sm" id="jam_ber_a_plus_b_sdhi" readonly/></td>
                                </tr>
                                <tr>
                                    <td>&nbsp;</td>
                                    <td>&nbsp;</td>
                                    <td>&nbsp;</td>
                                    <td>&nbsp;</td>
                                </tr>
                                <tr>
                                    <td> Jam gil. </td>
                                    <td> <input type="text" class="form-control input-sm" id="jam_gil" readonly/></td>
                                    <td> 3,491.17 </td>
                                    <td> 3,488.17 </td>
                                </tr>
                                <tr>
                                    <td> Jam kamp. </td>
                                    <td><input type="text" id="jam_kampanye" name="jam_kampanye" class='form-control input-sm' value="<?php echo @$data->jam_kampanye?>"/> </td>
                                    <td> <?php echo @$data_kemarin->jam_kampanye_sum;?></td>
                                    <td> 3,654.48 </td>
                                </tr>
                                <tr>
                                    <td>&nbsp;</td>
                                    <td>&nbsp;</td>
                                    <td>&nbsp;</td>
                                    <td>&nbsp;</td>
                                </tr>
                                <tr>
                                    <td> K.I.S. </td>
                                    <td><input type="text" id="kis" name="kis" class='form-control input-sm' value="<?php echo @$data->kis;?>"/> </td>
                                    <td> <?php echo @$data_kemarin->kis_sum;?> </td>
                                    <td> 1,163.0 </td>
                                </tr>
                                <tr>
                                    <td> K.E.S. </td>
                                    <td><input type="text" id="kes" name="kes" class='form-control input-sm' value="<?php echo @$data->kes;?>"/></td>
                                    <td> <?php echo @$data_kemarin->kes_sum;?> </td>
                                    <td> 1,218.5 </td>
                                </tr>
                                <tr>
                                    <td>&nbsp;</td>
                                    <td>&nbsp;</td>
                                    <td>&nbsp;</td>
                                    <td>&nbsp;</td>
                                </tr>
                                <tr>
                                    <td> A% J.gl. </td>
                                    <td> (66.67)</td>
                                    <td> 0.57 </td>
                                    <td> 0.63 </td>
                                </tr>
                                <tr>
                                    <td> B% J.gl. </td>
                                    <td> (100.00)</td>
                                    <td> 4.05 </td>
                                    <td> 4.14 </td>
                                </tr>
                                <tr>
                                    <td> A  +  B </td>
                                    <td> (166.67)</td>
                                    <td> 4.62 </td>
                                    <td> 4.77 </td>
                                </tr>
                                <tr>
                                    <td>&nbsp;</td>
                                    <td>&nbsp;</td>
                                    <td>&nbsp;</td>
                                    <td>&nbsp;</td>
                                </tr>
                                <tr>
                                    <td>  Prod. Gula </td>
                                    <td><input type="text" id="prod_gula" name="prod_gula" class='form-control input-sm' value="<?php echo @$data->prod_gula;?>"/> </td>
                                    <td> <?php echo @$data_kemarin->prod_gula_sum;?> </td>
                                    <td> 11,987.5 </td>
                                </tr>
                                <tr>
                                    <td>  Ex.Sisan  </td>
                                    <td><input type="text" id="ex_sisan_gula" name="ex_sisan_gula" class='form-control input-sm' value="<?php echo @$data->ex_sisan_gula;?>"/></td>
                                    <td> <?php echo @$data_kemarin->ex_sisan_gula_sum;?></td>
                                    <td> 73.4 </td>
                                </tr>
                                <tr>
                                    <td>  Jumlah </td>
                                    <td> 99.956 </td>
                                    <td> 12,060.9 </td>
                                    <td> 12,060.9 </td>
                                </tr>
                                <tr>
                                    <td> Sisan diolah </td>
                                    <td><input type="text" id="sisan_diolah" name="sisan_diolah" class='form-control input-sm' value="<?php echo @$data->sisan_diolah;?>"/></td>
                                    <td> <?php echo @$data_kemarin->sisan_diolah_sum;?> </td>
                                    <td> 87.8 </td>
                                </tr>
                                <tr>
                                    <td>&nbsp;</td>
                                    <td>&nbsp;</td>
                                    <td>&nbsp;</td>
                                    <td>&nbsp;</td>
                                </tr>
                                <tr>
                                    <td> Prod. Tetes </td>
                                    <td><input type="text" id="prod_tetes" name="prod_tetes" class='form-control input-sm' value="<?php echo @$data->prod_tetes;?>"/></td>
                                    <td> <?php echo @$data_kemarin->prod_tetes_sum;?> </td>
                                    <td> 8,328.0 </td>
                                </tr>
                                <tr>
                                    <td> Ex.Sisan  </td>
                                    <td><input type="text" id="ex_sisan_tetes" name="ex_sisan_tetes" class='form-control input-sm' value="<?php echo @$data->ex_sisan_tetes;?>"/></td>
                                    <td> <?php echo @$data_kemarin->ex_sisan_tetes_sum;?> </td>
                                    <td> 13.0 </td>
                                </tr>
                                <tr>
                                    <td> STO Tetes  </td>
                                    <td><input type="text" id="sto_tetes" name="sto_tetes" class='form-control input-sm' value="<?php echo @$data->sto_tetes;?>"/></td>
                                    <td> <?php echo @$data_kemarin->sto_tetes_sum;?> </td>
                                    <td> 1,290.2 </td>
                                </tr>
                                <tr>
                                    <td> Ex. Tetes Repro Tahun Lalu </td>
                                    <td><input type="text" id="tetes_repro_tll" name="sto_tetes" class='form-control input-sm' value="<?php echo @$data->tetes_repor_tll;?>"/></td>
                                    <td> <?php echo @$data_kemarin->sto_tetes_sum;?> </td>
                                    <td> 10.7 </td>
                                </tr>
                                <tr>
                                    <td>  Jumlah </td>
                                    <td> - </td>
                                    <td> 9,641.9 </td>
                                    <td> 9,641.9 </td>
                                </tr>
                                <tr>
                                    <td> BBA </td>
                                    <td><input type="text" id="bba" name="bba" class='form-control input-sm' value="<?php echo @$data->bba_sum;?>"/></td>
                                    <td> <?php echo @$data_kemarin->bba_sum;?> </td>
                                    <td> 5,250.3 </td>
                                </tr>
                                <tr>
                                    <td> RUPIAH BBA </td>
                                    <td><input type="text" id="rupiah_bba" name="rupiah_bba" class='form-control input-sm' value="<?php echo @$data->rupiah_bba;?>"/></td>
                                    <td> <?php echo @$data_kemarin->rupiah_bba_sum;?> </td>
                                    <td> 1,379,325 </td>
                                </tr>
                                <tr>
                                    <td>&nbsp;</td>
                                    <td>&nbsp;</td>
                                    <td>&nbsp;</td>
                                    <td>&nbsp;</td>
                                </tr>
                                <tr>
                                    <td> GULA REPRO tahun lalu </td>
                                    <td><input type="text" id="gula_repro_tll" name="gula_repro_tll" class='form-control input-sm' value="<?php echo @$data->gula_repo_ttl;?>"/></td>
                                    <td> <?php echo @$data_kemarin->gula_repo_ttl_sum;?> </td>
                                    <td> 61.10 </td>
                                </tr>
                                <tr>
                                    <td> RAW SUGAR </td>
                                    <td><input type="text" id="raw_sugar" name="raw_sugar" class='form-control input-sm' value="<?php echo @$data->raw_sugar;?>"/></td>
                                    <td> <?php echo @$data_kemarin->raw_sugar_sum;?> </td>
                                    <td> - </td>
                                </tr>
                                <tr>
                                    <td> GULA REPRO tahun ini </td>
                                    <td><input type="text" id="gula_repro_th_ini" name="gula_repro_th_ini" class='form-control input-sm' value="<?php echo @$data->gula_repro_th_ini_sum;?>"/></td>
                                    <td> <?php echo @$data_kemarin->gula_repro_th_ini_sum;?> </td>
                                    <td> 19.00 </td>
                                </tr>
                                <tr>
                                    <td>&nbsp;</td>
                                    <td>&nbsp;</td>
                                    <td>&nbsp;</td>
                                    <td>&nbsp;</td>
                                </tr>
                                <tr>
                                    <td>  TON AMPAS </td>
                                    <td><input type="text" id="ton_ampas" name="ton_ampas" class='form-control input-sm' value="<?php echo @$data->ton_ampas;?>"/></td>
                                    <td> <?php echo @$data_kemarin->ton_ampas_sum;?> </td>
                                    <td> 20.00 </td>
                                </tr>
                                <tr>
                                    <td> % Pol AMPAS </td>
                                    <td><input type="text" id="persen_pol_ampas" name="persen_pol_ampas" class='form-control input-sm' value="<?php echo @$data->persen_pol_ampas;?>"/></td>
                                    <td> <?php echo @$data_kemarin->persen_pol_ampas_sum;?> </td>
                                    <td> 21.00 </td>
                                </tr>
                                <tr>
                                    <td>&nbsp;</td>
                                    <td>&nbsp;</td>
                                    <td>&nbsp;</td>
                                    <td>&nbsp;</td>
                                </tr>
                                <tr>
                                    <td> TON BLOTONG </td>
                                    <td><input type="text" id="ton_blotong" name="ton_blotong" class='form-control input-sm' value="<?php echo @$data->ton_blotong_sum;?>"/></td>
                                    <td> <?php echo @$data_kemarin->ton_blotong_sum;?> </td>
                                    <td> 22.00 </td>
                                </tr>
                                <tr>
                                    <td> % POL BLOTONG </td>
                                    <td><input type="text" id="persen_pol_blotong" name="persen_pol_blotong" class='form-control input-sm' value="<?php echo @$data->persen_pol_blotong;?>"/></td>
                                    <td> <?php echo @$data_kemarin->persen_pol_blotong_sum;?> </td>
                                    <td> 23.00 </td>
                                </tr>
                                <tr>
                                    <td>&nbsp;</td>
                                    <td>&nbsp;</td>
                                    <td>&nbsp;</td>
                                    <td>&nbsp;</td>
                                </tr>
                                <tr>
                                    <td> TON POL DALAM HASIL + TAKSASI </td>
                                    <td><input type="text" id="ton_pol_dlm_hasil_plus_taksasi" name="ton_pol_dlm_hasil_plus_taksasi" class='form-control input-sm' value="<?php echo @$data->ton_pol_dlm_hasil_plus_taksasi;?>"/></td>
                                    <td> <?php echo @$data_kemarin->ton_pol_dlm_hasil_plus_taksasi_sum;?> </td>
                                    <td> 24.00 </td>
                                </tr>
                                <tr>
                                    <td> % POL DALAM HASIL + TAKSASI </td>
                                    <td><input type="text" id="persen_pol_dlm_hasil_plus_taksasi" name="persen_pol_dlm_hasil_plus_taksasi" class='form-control input-sm' value="<?php echo @$data->persen_pol_dlm_hasil_plus_taksasi;?>"/></td>
                                    <td> <?php echo @$data_kemarin->persen_pol_dlm_hasil_plus_taksasi_sum;?> </td>
                                    <td> 25.00 </td>
                                </tr>
                                <tr>
                                    <td>&nbsp;</td>
                                    <td>&nbsp;</td>
                                    <td>&nbsp;</td>
                                    <td></td>
                                </tr>
                                <tr>
                                    <td>&nbsp;Hari Giling</td>
                                    <td>
                                        <input type="text" id="hari_giling" name="hari_giling" class='form-control input-sm' value="<?php echo @$data->hari_giling;?>" />
                                    </td>
                                    <td>&nbsp;</td>
                                    <td></td>
                                </tr>
                                <tr>
                                    <td>&nbsp;Tahun Giling</td>
                                    <td><input type="text" id="tahun_giling" name="tahun_giling" class='form-control input-sm' value="<?php echo CNF_TAHUNGILING;?>"/></td>
                                    <td>&nbsp;</td>
                                    <td></td>
                                </tr>
                                <tr>
                                    <td>&nbsp;Tanggal</td>
                                    <td><input type="text" id="tgl" name="tgl" class='form-control date input-sm' value="<?php ?>"/></td>
                                    <td>&nbsp;</td>
                                    <td></td>
                                </tr>
                                </tbody>
                            </table>
                            <div class="toolbar-line text-center">
                                <input type="submit" name="submit" class="btn btn-primary btn-sm" value="Simpan" />
                                <a href="<?php echo site_url('tlapharpeng');?>" class="btn btn-sm btn-warning"><?php echo $this->lang->line('core.sb_cancel'); ?> </a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<script type="text/javascript">
    $(document).ready(function() {
        $( "#jam_berhenti_b" ).keyup(function() {

            jam_a_plus_b = parseInt($("#jam_berhenti_a").val())+parseInt($("#jam_berhenti_b").val());
            jam_ber_a_sdhi = parseInt('<?php echo @$data_kemarin->jam_berhenti_a_sum;?>')+parseInt($("#jam_berhenti_a").val());
            $("#jam_ber_a_sdhi").val(jam_ber_a_sdhi);
            jam_ber_b_sdhi = parseInt('<?php echo @$data_kemarin->jam_berhenti_b_sum;?>')+parseInt($("#jam_berhenti_b").val());
            $("#jam_ber_b_sdhi").val(jam_ber_b_sdhi);
            $("#jam_a_plus_b").val(jam_a_plus_b);
            jam_ber_a_plus_b_yll = '<?php echo @$data_kemarin->jam_berhenti_b_sum+@$data_kemarin->jam_berhenti_a_sum;?>';
            jam_ber_a_plus_b_sdhi = parseInt(jam_a_plus_b)+parseInt(jam_ber_a_plus_b_yll);
            $("#jam_ber_a_plus_b_sdhi").val(jam_ber_a_plus_b_sdhi);
        });

        $("#jam_kampanye").keyup(function () {
            jam_gil = parseInt($("#jam_a_plus_b").val())-parseInt($("#jam_kampanye").val());
            $("#jam_gil").val(jam_gil);
        })
    });
</script>

