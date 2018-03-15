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
        border: 1px solid #ffffff;
    }
</style>


<section class="content">
    <div class="row">
        <div class="col-xs-12">
            <div class="box box-danger">
                <div class="box-header with-border">
                    <h3 class="box-title">Laporan Produksi</h3>
                    <div class="box-tools pull-right">



                    </div>
                </div>

                <div class="box-body">

                    <div class="page-content-wrapper m-t">

                        <div class="sbox animated fadeIn">
                            <div class="sbox-content" style="height:650px;padding:10px;overflow:auto" id="report" >

                                <table class="tableizer-table">
                                    <thead>
                                    <tr class="tableizer-firstrow">
                                        <th style="text-align: center" rowspan="2">Kategori</th>
                                        <th style="text-align: center" colspan="2">Ha. Ditebang</th>
                                        <th style="text-align: center" colspan="2">Qty. Ditebang</th>
                                        <th style="text-align: center" colspan="2">Ha. Digiling</th>
                                        <th style="text-align: center" colspan="2">Qty. Digiling</th>
                                        <th style="text-align: center" colspan="2">Qty. Kristal</th>
                                        <th style="text-align: center" colspan="2">Rendemen</th>
                                        <th style="text-align: center" colspan="2">Qty. Gula PTR</th>
                                        <th style="text-align: center" colspan="2">Qty. Tetes PTR</th>
                                    </tr>
                                    <tr class="tableizer-firstrow">
                                        <th style="text-align: center">HI</th>
                                        <th style="text-align: center">SD</th>
                                        <th style="text-align: center">HI</th>
                                        <th style="text-align: center">SD</th>
                                        <th style="text-align: center">HI</th>
                                        <th style="text-align: center">SD</th>
                                        <th style="text-align: center">HI</th>
                                        <th style="text-align: center">SD</th>
                                        <th style="text-align: center">HI</th>
                                        <th style="text-align: center">SD</th>
                                        <th style="text-align: center">HI</th>
                                        <th style="text-align: center">SD</th>
                                        <th style="text-align: center">HI</th>
                                        <th style="text-align: center">SD</th>
                                        <th style="text-align: center">HI</th>
                                        <th style="text-align: center">SD</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <?php foreach ($kode_kat_ts as $tdat_ts){?>
                                    <tr>
                                        <td ><?php echo $tdat_ts->kode_kat_ptp?> </td>
                                        <td >0.720</td>
                                        <td >6.825</td>
                                        <td >0</td>
                                        <td >608.25</td>
                                        <td >0.720</td>
                                        <td >6.825</td>
                                        <td >0</td>
                                        <td >608.25</td>
                                        <td >0.000</td>
                                        <td >54.384</td>
                                        <td >0</td>
                                        <td >8.94</td>
                                        <td >0</td>
                                        <td >0</td>
                                        <td >0</td>
                                        <td >0</td>
                                    </tr>
                                    <?php }?>
                                    <tr>
                                        <td><strong>TOTAL TS</strong></td>
                                        <td colspan="16"></td>
                                    </tr>
                                    <?php foreach ($kode_kat_tr as $tdat_tr){?>
                                        <tr>
                                            <td ><?php echo $tdat_tr->kode_kat_ptp?> </td>
                                            <td >0.720</td>
                                            <td >6.825</td>
                                            <td >0</td>
                                            <td >608.25</td>
                                            <td >0.720</td>
                                            <td >6.825</td>
                                            <td >0</td>
                                            <td >608.25</td>
                                            <td >0.000</td>
                                            <td >54.384</td>
                                            <td >0</td>
                                            <td >8.94</td>
                                            <td >0</td>
                                            <td >0</td>
                                            <td >0</td>
                                            <td >0</td>
                                        </tr>
                                    <?php }?>
                                    <tr>
                                        <td><strong>TOTAL TR</strong></td>
                                        <td colspan="16"></td>
                                    </tr>
                                    </tbody>

                                </table>
                            </div>
                        </div>


                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
