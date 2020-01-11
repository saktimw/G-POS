<section class="content-header">
    <h1>Rekap Barang ( Stok - Terlaris )</h1>
</section>

<section class="content">
    <div class="row">
        <div class="col-lg-6 col-xs-6">
            <div class="box box-danger">
                <div class="box-header with-border">
                    <span class="fa fa-calendar-alt"></span>
                    <h3 class="box-title">Stock Barang Yang Hampir Habis</h3>
                </div>
                <div class="box-body">
                    <table class="table table-striped">
                    <?php
                        if ($stok->num_rows() == 0)
                        {
                    ?>
                        <td align="center"> Data Kosong</td>
                    <?php
                        }
                        else
                        {
                            $no = 1;
                            foreach ($stok->result() as $tb)
                            {
                    ?>
                            <tr>
                                <td align="center"><?=$no?></td>
                                <td><?=$tb->nama_b?></td>
                                <td align="center"><?=$tb->stok_b.' '.$tb->unit_b?></td>
                            </tr>
                    <?php
                            $no++;
                            }
                        }
                    ?>
                    </table>
                </div>
            </div>
        </div>
        <div class="col-lg-6 col-xs-6">
            <div class="box box-warning">
                <div class="box-header with-border">
                    <span class="fa fa-calendar-alt"></span>
                    <h3 class="box-title">Barang Terlaris Pada Bulan</h3>
                    <div class="box-tools pull-right">
                        <div class="form-inline">
                            <span class="fa fa-calendar"></span>&nbsp;
                            <span>
                                <input type="month" name="tgl" id="clndrBln" class="form-control" value="<?=date('Y-m', time())?>">
                            </span>
                        </div>
                    </div>
                </div>
                <div class="box-body">
                    <table class="table table-striped" id="terlarisBulan">
                    <?php
                        if ($bulan->num_rows() == 0)
                        {
                    ?>
                        <td align="center" id="NullBln"> Data Kosong</td>
                    <?php
                        }
                        else
                        {
                            $no = 1;
                            foreach ($bulan->result() as $tb)
                            {
                    ?>
                            <tr>
                                <td><?=$no?></td>
                                <td><?=$tb->nama_b?></td>
                                <td><?=$tb->terlaris?></td>
                            </tr>
                    <?php
                            $no++;
                            }
                        }
                    ?>
                    </table>
                </div>
            </div>
            <div class="box box-success">
                <div class="box-header with-border">
                    <span class="fa fa-calendar-alt"></span>
                    <h3 class="box-title">Barang Terlaris Pada Tanggal</h3>
                    <div class="box-tools pull-right">
                        <div class="form-inline">
                            <span class="fa fa-calendar"></span>&nbsp;
                            <span>
                                <input type="date" name="tgl" id="clndrTgl" class="form-control" value="<?=date('Y-m-d', time())?>">
                            </span>
                        </div>
                    </div>
                </div>
                <div class="box-body">
                <table class="table table-striped" id="terlarisHari">
                    <?php
                        if ($hari->num_rows() == 0)
                        {
                    ?>
                        <td align="center" id="NllTgl"> Data Kosong</td>
                    <?php
                        }
                        else
                        {
                            $no = 1;
                            foreach ($hari->result() as $tb)
                            {
                    ?>
                            <tr>
                                <td><?=$no?></td>
                                <td><?=$tb->nama_b?></td>
                                <td><?=$tb->terlaris?></td>
                            </tr>
                    <?php
                            $no++;
                            }
                        }
                    ?>
                    </table>
                </div>
            </div>
        </div>
    </div>
</section>

<script>
$(window).ready(function(){

    $('#clndrTgl').on('change', function(){
        var val = $(this).val();
        $.ajax({
            type : 'POST',
            data : {data : val},
            url : '<?=base_url('barang/barang_terlaris')?>',
            dataType : 'JSON',
            success : function(result){
                if (result.length > 0)
                {
                    var tb = result;
                    var tbl = $('#terlarisHari');
                    var tbody = $("<tbody>");
                    tbl.html(tbody);
                    $('#NullTgl').hide();
                    var no = 1;
                    $.each(tb, function(key, val){
                        var row = $("<tr>");
                        row.html("<td>" + no++ + "</td>" +
                                "<td>" + val.nama_b + "</td>" +
                                "<td>" + val.terlaris + "</td>");
                        tbl.append(row);
                    })
                }
                else
                {
                    var tbl = $('#terlarisHari');
                    tbl.html("<tbody><td align=\"center\" id=\"dataKosong\"> Data Kosong</td></tbody>");
                }
            }
        })
    })

    $('#clndrBln').on('change', function(){
        var val = $(this).val();
        $.ajax({
            type : 'POST',
            data : {data : val},
            url : '<?=base_url('barang/barang_terlaris_bulan')?>',
            dataType : 'JSON',
            success : function(result){
                if (result.length > 0)
                {
                    var tb = result;
                    var tbl = $('#terlarisBulan');
                    var tbody = $("<tbody>");
                    tbl.html(tbody);
                    $('#NullBln').hide();
                    var no = 1;
                    $.each(tb, function(key, val){
                        var row = $("<tr>");
                        row.html("<td>" + no++ + "</td>" +
                                "<td>" + val.nama_b + "</td>" +
                                "<td>" + val.terlaris + "</td>");
                        tbl.append(row);
                    })
                }
                else
                {
                    var tbl = $('#terlarisHari');
                    tbl.html("<tbody><td align=\"center\" id=\"dataKosong\"> Data Kosong</td></tbody>");
                }
            }
        })
    })
})
</script>