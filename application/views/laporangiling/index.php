<section class="content">
    <div class="row">
        <div class="col-xs-12">
            <div class="box box-danger">
                <div class="box-header with-border">
                    <h3 class="box-title">Laporan Giling</h3>
                    <div class="box-tools pull-right">



                    </div>
                </div>

                <div class="box-body">

                    <div class="page-content-wrapper m-t">

                        <div class="sbox animated fadeIn">
                            <div class="sbox-content" style="padding:10px" >
                                <table witdh="100%">
                                    <tr>
                                        <td style="padding:5px" width="150px">
                                            Pilih Hari
                                        </td>
                                        <td class="period">
                                            <input type='text' class='form-control date input-sm' readonly placeholder='' value='<?php echo date('Y-m-d');?>' id='tgl1'  />
                                        </td>
                                        <td valign="center">
                                            <input type="button" onclick="getReport()" class="btn btn-info btn-sm" value="View " />
                                            <input type="button" class="btn btn-warning btn-sm" onclick="printContent('report')"  value="Cetak " />
                                        </td>
                                    </tr>
                                </table>
                            </div>
                            <hr />
                            <div class="sbox-content" style="height:650px;padding:10px;overflow:auto" id="report" >
                            </div>
                        </div>


                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<script type="text/javascript">
    $(document).ready(function(){
        //getReport();

        $('.bulan').hide();$('.tahun').hide();
        //	$("#bln").select2("val", "<?=date('n');?>");
        //	$("#thn").select2("val", "<?=date('Y');?>");
    });

    $('#rjns').on('change',function(e){
        if($('#rjns').val()==1){
            $('.bulan').hide();$('.tahun').hide();$('.period').show();
        }else if($('#rjns').val()==2){
            $('.bulan').show();$('.tahun').show();$('.period').hide();
            $("#bln").select2("val", "<?=date('n');?>");
            $("#thn").select2("val", "<?=date('Y');?>");
        }else if($('#rjns').val()==3){
            $('.bulan').hide();$('.tahun').show();$('.period').hide();
        }
    });

    function getReport(){
        $.ajax({
            type 	: "POST",
            datatype: "json",
            url 	: "<?php echo site_url('laporangiling/printlaporan'); ?>",
            data 	: {tgl1:$('#tgl1').val(),tgl2:$('#tgl2').val(),
                sup:$('#sup').val(),jns:$('#jns').val()
                ,bln:$('#bln').val(),thn:$('#thn').val(),rjns:$('#rjns').val()},
            success	: function(data){
                $('#report').html(data);
            }
        });
    }
    $(document).on({
        ajaxStart: function() { ajaxindicatorstart('loading data.. please wait..');    },
        ajaxStop: function() {ajaxindicatorstop(); }
    });

</script>