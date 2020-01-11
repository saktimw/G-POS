<h3>Detail Laporan Perhari</h3>
<table class="table table-striped table-bordered" id="detailLaporan">
    <thead>
        <tr>
            <th>No </th>
            <th>Kode Barang </th>
            <th>Nama </th>
            <th>Tanggal </th>
            <th>Harga Awal </th>
            <th>Harga Jual </th>
            <th>Terjual </th>
            <th>Total </th>
            <th>Keuntungan </th>
        </tr>
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
            <td><?=$dt->tgl_penjualan?></td>
            <td><?=$dt->harga_awal_b?></td>
            <td><?=$dt->harga_jual_b?></td>
            <td><?=$dt->jumlah?></td>
            <td><?=$dt->sub_total?></td>
            <td><?=$dt->keuntungan?></td>
        <?php
            $no++;
            }
        ?>
        </tr>
    </thead>
</table>
