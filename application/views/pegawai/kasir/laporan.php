<h3>Laporan Harian</h3>
<br>
<div class="box box-warning">
    <div class="box-body">
        <div class="table-responsive">
            <table class="table table-striped table-bordered" id="laporan">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Tanggal Penjualan </th>
                        <th>Barang Terjual</th>
                        <th>Total Penjualan</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                        $no = 1;
                        foreach ($lap as $l)
                        {
                    ?>
                    <tr>
                        <td><?=$no?></td>
                        <td><?=indo_date($l->tgl)?></td>
                        <td><?=$l->jumlah?></td>
                        <td>Rp. <?=number_format($l->total)?></td>
                        <td>
                        <a href="<?=base_url('laporan/detail_laporan/'.$l->tgl)?>" class="btn btn-warning btn-sm"><span class="fa fa-bars"></span><span> Detail</span></a> <a href="<?=base_url('laporan/pdf_laphari/'.$l->tgl)?>" class="btn btn-primary btn-sm"><span class="fa fa-file-pdf"></span><span> Export PDF</span></a>
                        </td>
                    </tr>
                    <?php
                        $no++;
                        }
                    ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<script type="text/javascript">
 var table;
 $(document).ready(function() {
     table = $('#laporan').DataTable();
 })
</script>