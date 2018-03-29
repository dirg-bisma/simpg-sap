<html>
<head>
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
</head>
<body>

<table  style="height: 5px;font-family:Monospace;" border="0" width="100%">
    <tbody>
    <tr>

        <td align="left"  style="font-size:11px">
            <b><?=CNF_NAMAPERUSAHAAN;?></b><br />
            <?=CNF_PG;?>
            <?=CNF_ALAMAT;?>
        </td>
        <td align="center" style="font-size:13px" >
            LAPORAN TIMBANGAN LORI<br />
        </td>
    </tr>
</table>
<hr />
<table style="height: 5px;font-family:Monospace;" border="0" width="20%">
    <tbody>
    <tr>
        <td>No Trainstat</td>
        <td>:</td>
        <td><?php echo @$no_trainstat; ?></td>
    </tr>
    <tr>
        <td>No Loko</td>
        <td>:</td>
        <td><?php echo @$no_loko; ?></td>
    </tr>
    </tbody>
</table>
<br>
<table class="tableizer-table">
    <thead>
    <tr class="tableizer-firstrow">
        <th>No</th>
        <th>SPTA</th>
        <th>Kategori</th>
        <th>No Petak</th>
        <th>Nama Petani</th>
        <th>No Lori</th>
        <th>Bruto</th>
        <th>Tara</th>
        <th>Netto</th>
        <th>Tgl Bruto</th>
        <th>Tgl Netto</th>
        <th>No Trainstat</th>
        <th>No Loko</th>
    </tr>
    </thead>
    <tbody>
    <?php if(isset($lori)){?>
        <?php $i=1; ?>
        <?php foreach ($lori as $loko_data){ ?>
            <tr>
                <th><?php echo $i; ?></th>
                <th><?php echo $loko_data->no_spat; ?></th>
                <th><?php echo $loko_data->kepemilikan; ?></th>
                <th><?php echo $loko_data->kode_blok; ?></th>
                <th><?php echo $loko_data->nama_petani; ?></th>
                <th><?php echo $loko_data->no_lori; ?></th>
                <th><?php echo $loko_data->bruto; ?></th>
                <th><?php echo $loko_data->tara; ?></th>
                <th><?php echo $loko_data->netto; ?></th>
                <th><?php echo $loko_data->timb_bruto_tgl; ?></th>
                <th><?php echo $loko_data->timb_netto_tgl; ?></th>
                <th><?php echo $loko_data->no_trainstat; ?></th>
                <th><?php echo $loko_data->no_loko; ?></th>
            </tr>
            <?php $i++;?>
        <?php } ?>
    <?php } ?>
    </tbody>
    <tfoot>


    </tfoot>
</table>
<hr />
<table style="width:100%">
    <tr><td style="width: 60%"><br>
            <br />
            <br />
            <br />
        </td><td style="width: 20%" >&nbsp;</td>
        <td align="center"> <?=CNF_PG.' ,'.SiteHelpers::datereport(date('Y-m-d'));?>
            <br /><br /><br />
            <br /><br />
            <br />
            <br />
            ..........................
            <br />

        </td></tr>
</table>
</body>
</html>
