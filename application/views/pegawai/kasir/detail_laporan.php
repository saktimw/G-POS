<h3>Detail Laporan Perhari</h3>
<br>
<a href="<?=base_url('kasir/laporan')?>" class="btn btn-sm btn-success">
    <span class="fa fa-arrow-left"></span>
    <span> Kembali</span>
</a>
<br><br>
<div class="box box-success">
    <div class="box-body">
        <table class="table table-striped table-bordered" id="detailLaporan">
            <thead>
                <tr>
                    <th>No </th>
                    <th>Kode Barang </th>
                    <th>Nama </th>
                    <th>Tanggal </th>
                    <th>Harga</th>
                    <th>Terjual </th>
                    <th>Total </th>
                </tr>
            </thead>
            <tbody>
                <?php
                    if ($detail == null)
                    {
                        echo "<tr>";
                        echo "<td class=\"text-center\" colspan=\"6\">Data Kosong</td>";
                        echo "</tr>";
                    }
                    $no=1;
                    foreach($detail as $dt){
                ?>
                <tr>
                    <td><?=$no?></td>
                    <td><?=$dt->kd_barang?></td>
                    <td><?=$dt->nama_b?></td>
                    <td><?=indo_date($dt->tanggal_beli)?></td>
                    <td><?='Rp. '.number_format($dt->harga_jual)?></td>
                    <td><?=$dt->qty?></td>
                    <td><?='Rp. '.number_format($dt->total)?></td>
                <?php
                    $no++;
                    }
                ?>
                </tr>
            </tbody>
        </table>
    </div>
</div>

<script>
    $(window).ready(function(){
        $('#detailLaporan').DataTable({
        });
    })
</script>
