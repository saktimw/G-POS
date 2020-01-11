<?php
    if ($stoknotice > 0)
    {
?>
<div class="callout callout-warning alert-dismissible">
    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
    <h4><i class="icon fa fa-exclamation-triangle"></i> Stok Minimum Barang</h4>
    <p>Terdapat <b><?=$stoknotice?></b> barang dibawah jumlah stok minimal, <a href="<?=base_url('admin/rekap_barang')?>">Lihat Detailnya..!!!</a></p>
</div>
<?php
    }
?>
<!--Data penjualan bulan ini-->
<div class="row">
    <div class="col-lg-4 col-xs-4">
        <div class="small-box bg-green">
            <div class="inner">
                <h3><?=$transaksi?></h3>
                <p>Transaksi Bulan Ini</p>
            </div>
            <div class="icon">
                <i class="ion ion-arrow-swap"></i>
            </div>
        </div>
    </div>
    <div class="col-lg-4 col-xs-4">
        <div class="small-box bg-green">
            <div class="inner">
                <h3><?=$terjual->qty ?: 0?></h3>
                <p>Barang Terjual Bulan Ini</p>
            </div>
            <div class="icon">
                <i class="ion ion-bag"></i>
            </div>
        </div>
    </div>
    <div class="col-lg-4 col-xs-4">
        <div class="small-box bg-green">
            <div class="inner">
                <h3>Rp. <?=number_format($laba->keuntungan)?></h3>
                <p>Laba / Rugi Bulan Ini</p>
            </div>
            <div class="icon">
                <i class="ion ion-cash"></i>
            </div>
        </div>
    </div>
</div>

<!--Data penjualan by tanggal-->
<div class="box box-info">
    <div class="box-body">
        <div class="row">  
            <div class="col-lg-4">
                <div class="box box-solid bg-aqua">
                    <div class="box-header">
                        <i class="fa fa-calendar"></i>
                        <h3 class="box-title">Calendar</h3>
                        <div class="box-body no-padding">
                            <div id="calendar"></div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-5">
                <div class="info-box bg-blue">
                    <div class="info-box-icon">
                        <span class="fa fa-dollar-sign"></span>
                    </div>
                    <div class="info-box-content">
                        <div class="info-box-text">TOTAL LABA / RUGI</div>
                        <div class="progress">
                            <div class="progress-bar" style="width:100%"></div>
                        </div>
                        <div class="info-box-number">
                            <span>Rp. </span>
                            <span id="untung">0</span>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-5">
                <div class="info-box bg-blue">
                    <div class="info-box-icon">
                        <span class="fa fa-exchange-alt"></span>
                    </div>
                    <div class="info-box-content">
                        <div class="info-box-text">JUMLAH TRANSAKSI</div>
                        <div class="progress">
                            <div class="progress-bar" style="width:100%"></div>
                        </div>
                        <div class="info-box-number"><span id="transaksi">0</span></div>
                    </div>
                </div>
            </div>
            <div class="col-lg-5">
                <div class="info-box bg-blue">
                    <div class="info-box-icon">
                        <span class="fa fa-box"></span>
                    </div>
                    <div class="info-box-content">
                        <div class="info-box-text">BARANG TERJUAL</div>
                        <div class="progress">
                            <div class="progress-bar" style="width:100%"></div>
                        </div>
                        <div class="info-box-number">
                            <span id="barang">0</span>
                            <span> UNIT</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    $('#calendar').datepicker("setDate" , new Date());
    var date = $('#calendar').datepicker('getFormattedDate');
    
    $.ajax({
        type : 'POST',
        url : '<?=base_url('admin/rekap_by_tanggal')?>',
        dataType : 'JSON',
        data : {date : date},
        success : function(res){
            var u = numeral(res.untung).format('0,0');
            $('#untung').html(u);
            $('#transaksi').html(res.transaksi);
            $('#barang').html(res.barang);
        }
    });

    $('#calendar').datepicker().on('changeDate', function(){
        var date = $('#calendar').datepicker('getFormattedDate');
        console.log(date);
        $.ajax({
            type : 'POST',
            url : '<?=base_url('admin/rekap_by_tanggal')?>',
            dataType : 'JSON',
            data : {date : date},
            success : function(res){
                var u = numeral(res.untung).format('0,0');
                $('#untung').html(u);
                $('#transaksi').html(res.transaksi);
                $('#barang').html(res.barang);
            }
        })
    })
</script>