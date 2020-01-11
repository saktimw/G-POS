<h3>Data Transaksi <?=indo_bulan($bulan).' / '.$tahun?></h3>
<br>
<a href="<?=base_url('admin/laporan_bulanan')?>" class="btn btn-success btn-sm">
    <span class="fa fa-arrow-left"></span>
    <span> Kembali</span>
</a>
<a href="<?=base_url('admin/lapbulan_pdf/'.$bulan.'-'.$tahun)?>" class="btn btn-danger btn-sm">
    <span class="fa fa-file-pdf"></span>
    <span> Export PDF</span>
</a>
<br><br>
<div class="box box-success">
    <div class="box-body">
        <table class="table table-striped table-bordered" id="detailBulanan">
            <thead>
                <tr>
                    <th>No </th>
                    <th>Nama Barang</th>
                    <th>Harga Awal</th>
                    <th>Terjual</th>
                    <th>Sub Total</th>
                    <th>Total Laba/Rugi</th>
                </tr>
            </thead>
            <tbody>
                <?php
                    $no = 1;
                    foreach ($data as $dt)
                    {
                ?>
                <tr>
                    <td><?= $no ?></td>
                    <td><?= $dt->nama_b ?></td>
                    <td><?= number_format($dt->harga_awal) ?></td>
                    <td><?= $dt->jumlah ?></td>
                    <td><?= number_format($dt->total) ?></td>
                    <td><?= number_format($dt->keuntungan) ?></td>
                </tr>

                <?php
                    $no++; 
                    } 
                ?>
            </tbody>
        </table>
    </div>
</div>

<script>
    $(window).ready(function(){
        $('#detailBulanan').DataTable()
    })
</script>